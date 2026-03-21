<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Mail\MemberAccess;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Auth::user());

        $ths = [
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'Nome'],
            ['class' => 'text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2', 'name' => 'E-mail'],
            ['class' => 'text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7', 'name' => 'Telefone'],
            ['class' => 'text-secondary opacity-7', 'name' => '']
        ];

        return view('admin.member.index', compact('ths'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberRequest $request)
    {
        $this->authorize('create', Auth::user());

        try {
            $validated = $request->validated();
            $validated['password'] = Hash::make($validated['password']);
            $user = User::create($validated);
            $user->assignRole('Membros');
            
            Auth::user()->client->members()->syncWithoutDetaching($user->id);

            $this->sendEmail($user->email);

            return redirect()->route('admin.membros.index')->with('success', 'Membro criada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.membros.index')->with('danger', 'Não foi possível criar a Membro!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberRequest $request, User $member)
    {
        $this->authorize('update', Auth::user());

        try {
            $validated = $request->validated();

            $member->update(Arr::except($validated, ['password']));

            return redirect()->route('admin.membros.index')->with('success', 'Membro alterado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('admin.membros.index')->with('danger', 'Não foi possível alterar o Membro!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $member)
    {
        $this->authorize('delete', Auth::user());

        try {
            $user = Auth::user();

            $members = $user->client->members()->where('id', $member->id)->first();

            if($members){
                $user->client->members()->detach($member->id);
                $member->removeRole('Membros');
                $member->assignRole('Usuario');
                return redirect()->route('admin.membros.index')->with('success', 'Membro excluido com sucesso!');
            }

            return redirect()->route('admin.membros.index')->with('danger', 'Você não tem permissão para acessar este recurso.');
        } catch (\Exception $e) {
            return redirect()->route('admin.membros.index')->with('danger', 'Não foi possível excluir o Membro!');
        }
    }

    /**
     * Sends an access email to a new member.
     *
     * This function generates a random token, stores it (hashed) in the
     * PasswordResetToken table associated with the member's email, and
     * then sends an email containing the token using the MemberAccess mailable.
     *
     * @param string $email The email address of the member to receive the token.
     */
    private function sendEmail(string $email)
    {
        $token = Str::random(32);

        PasswordResetToken::create([
            'token' => Hash::make($token),
            'email' => $email
        ]);

        Mail::to($email)
            ->send(new MemberAccess($email, $token));
    }
    
}
