<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Auth::user());

        $settings = Setting::all();

        return SettingResource::collection($settings);
    }

    public function links()
    {
        $settings = Setting::whereIn('name', ['facebook', 'twitter', 'youtube', 'instagram'])->get();

        return SettingResource::collection($settings);
    }
}
