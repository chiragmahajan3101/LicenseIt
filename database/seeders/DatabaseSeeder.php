<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Admin User
        User::create([
            'name' =>     "Admin LicenseIt",
            'email' => "adminlicenseit@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('Licenseit@123'),
            'role' => 1,
            'mobile_no' => 9820098200,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' =>     "Chirag Mahajan",
            'email' => "chiragmahajan3101@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('chirag3101'),
            'role' => 0,
            'mobile_no' => 9067893300,
            'remember_token' => Str::random(10),
        ]);
    }
}
