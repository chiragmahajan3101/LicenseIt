<?php

namespace Database\Seeders;

use App\Models\Software;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DateTime;

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

        $chirag = User::create([
            'name' =>     "Chirag Mahajan",
            'email' => "chiragmahajan3101@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('chirag3101'),
            'role' => 0,
            'mobile_no' => 9067893300,
            'remember_token' => Str::random(10),
        ]);

        Software::factory(10)->create();

        $GLOBALS['buyDate'] = [new DateTime('2021-09-20'), new DateTime('2021-11-25'), new DateTime('2020-01-10'), new DateTime('2021-01-03'), new DateTime('2021-05-17')];
        // $GLOBALS['activationdate'] = [new DateTime('2021-09-25'), new DateTime('2021-11-25'), new DateTime('2020-01-15'), new DateTime('2021-01-04'), new DateTime('2021-05-20')];
        // $GLOBALS['expiryDate'] = [new DateTime('2022-09-25'), new DateTime('2022-05-25'), new DateTime('2020-09-15'), new DateTime('2021-11-04'), new DateTime('2021-10-20')];

        for ($i = 0; $i < rand(2, 4); $i++) {
            $j = rand(0, 4);
            $chirag->licenses()->create([
                'software_id' => rand(1, 10),
                'buy_date' => $GLOBALS['buyDate'][$j],
                'amount' => rand(350, 1500),
                'active_status' => random_int(0, 1),
                'activation_code' => Str::random(6),
                'hardware_id' => Str::random(9),
                'transaction_id' => Str::random(10),
                'notes' => Str::random(4)
            ]);
        }
        User::factory(8)->create()->each(function (User $user) {
            for ($i = 0; $i < rand(2, 4); $i++) {
                $j = rand(0, 4);
                $user->licenses()->create([
                    'software_id' => rand(1, 10),
                    'buy_date' => $GLOBALS['buyDate'][$j],
                    'amount' => rand(350, 1500),
                    'active_status' => random_int(0, 1),
                    'activation_code' => Str::random(6),
                    'hardware_id' => Str::random(9),
                    'transaction_id' => Str::random(10),
                    'notes' => Str::random(4)
                ]);
            }
        });
    }
}
