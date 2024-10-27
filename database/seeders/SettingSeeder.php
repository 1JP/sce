<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'name' => 'sandbox-payment',
            'body' => 1,
            'group' => 'api-payment'
        ]);

        Setting::create([
            'name' => 'url-sanbox-payment',
            'body' => 'https://sandbox.api.assinaturas.pagseguro.com/',
            'group' => 'api-payment'
        ]);

        Setting::create([
            'name' => 'url-prod-payment',
            'body' => 'https://api.assinaturas.pagseguro.com/',
            'group' => 'api-payment'
        ]);

        Setting::create([
            'name' => 'token-payment',
            'body' => '',
            'group' => 'api-payment'
        ]);

        Setting::create([
            'name' => 'public-key-payment',
            'body' => '',
            'group' => 'api-payment'
        ]);
    }
}
