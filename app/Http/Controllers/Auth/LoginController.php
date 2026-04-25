<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function forgotPassword()
    {
        return view('auth.passwords.forgot-password');
    }

    /**
     * Method to authenticate an user.
     *
     * @throws BindingResolutionException
     * @throws RouteNotFoundException
     */
    public function store(SignInRequest $request): RedirectResponse
    {
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            session()->put('validation', Crypt::encrypt($request->password));

            if (session()->has('pending_action')) {
                $pending = session()->pull('pending_action');

                return redirect()->route('pending.execute');
            }

            return redirect()->intended($this->redirectPath());
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Method to logout an user.
     *
     *
     * @throws BindingResolutionException
     * @throws RouteNotFoundException
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('login');
    }
    
    /**
     * * The username string to use for authentication.
     */
    public function username(): string
    {
        return 'email';
    }
}
