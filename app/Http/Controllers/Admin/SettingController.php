<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingRequest $request)
    {
        $this->authorize('create', Auth::user());

        try {
            $data = $request->validated();

            $validSettings = [];
            $groups = ['company', 'address', 'api-payment'];

            foreach ($data as $group => $settings) {

                $mappedGroup = $group === 'payments' ? 'api-payment' : $group;

                foreach ($settings as $key => $value) {

                    $keyFormatted = str_replace('_', '-', $key);

                    $validSettings[] = $mappedGroup . '|' . $keyFormatted;

                    // se veio vazio → remove
                    if ($value === null || $value === '') {
                        Setting::where('group', $mappedGroup)
                            ->where('name', $keyFormatted)
                            ->delete();
                        continue;
                    }

                    Setting::updateOrCreate(
                        ['group' => $mappedGroup, 'name' => $keyFormatted],
                        ['body' => $value]
                    );
                }
            }

            $existingSettings = Setting::whereIn('group', $groups)->get();

            foreach ($existingSettings as $setting) {
                $key = $setting->group . '|' . $setting->name;

                if (!in_array($key, $validSettings)) {
                    $setting->delete();
                }
            }

            return redirect()
                ->route('admin.configuracoes.create')
                ->with('success', 'Configurações criadas com sucesso!');

        } catch (\Exception $e) {

            return redirect()
                ->route('admin.configuracoes.create')
                ->with('danger', 'Não foi possível criar as configurações!');
        }
    }
}
