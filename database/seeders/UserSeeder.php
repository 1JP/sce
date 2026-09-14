<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->sharedLock()->truncate();
        DB::table('model_has_roles')->sharedLock()->truncate();

        User::updateOrCreate([
            'name' => 'Root SCE',
            'email' => 'rootsce@gmail.com'
        ],[
            'name' => 'Root SCE',
            'email' => 'rootsce@gmail.com',
            'password' => bcrypt('NR^A2zRgtmyG^f#!cj@Z'),
            'email_verified_at' => now(),
            'street' => $faker->streetName(),
            'number' => $faker->buildingNumber(),
            'locality' => $faker->streetName(),
            'city' => $faker->city(),
            'region_code' => 'MG',
            'postal_code' => '99999999',
            'complement' => $faker->secondaryAddress(),
            'birth_date' => $faker->date(),
            'cpf' => fake()->unique()->text(11),
            'country' => '55',
            'area' => '31',
            'phone' => '999884412',
            'created_at' => now(),
        ])->assignRole('Root');

        User::updateOrCreate([
            'name' => 'Usuario SCE',
            'email' => 'usuario@gmail.com',
        ],[
            'name' => 'Usuario SCE',
            'email' => 'usuario@gmail.com',
            'password' => bcrypt('@Tt!&TSt^6F%#Py5kh70'),
            'email_verified_at' => now(),
            'street' => $faker->streetName(),
            'number' => $faker->buildingNumber(),
            'locality' => $faker->streetName(),
            'city' => $faker->city(),
            'region_code' => 'MG',
            'postal_code' => '99999999',
            'complement' => $faker->secondaryAddress(),
            'birth_date' => $faker->date(),
            'cpf' => fake()->unique()->text(11),
            'country' => '55',
            'area' => '31',
            'phone' => '999884412',
            'created_at' => now(),
        ])->assignRole('Usuario');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
