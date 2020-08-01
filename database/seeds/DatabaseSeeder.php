<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name'              => $faker->name,
            'email'             => 'admin@management.com',
            'email_verified_at' => now(),
            'role'              => 'admin',
            'status'            => 'active',
            'address'           => $faker->address,
            'country'           => $faker->country,
            'postal_code'       => $faker->postcode,
            'contact'           => $faker->phoneNumber,
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ]);

        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name'              => $faker->name,
            'email'             => 'rider@management.com',
            'email_verified_at' => now(),
            'role'              => 'rider',
            'status'            => 'active',
            'address'           => $faker->address,
            'country'           => $faker->country,
            'postal_code'       => $faker->postcode,
            'contact'           => $faker->phoneNumber,
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ]);

        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name'              => $faker->name,
            'email'             => 'customer@management.com',
            'email_verified_at' => now(),
            'role'              => 'customer',
            'status'            => 'active',
            'address'           => $faker->address,
            'country'           => $faker->country,
            'postal_code'       => $faker->postcode,
            'contact'           => $faker->phoneNumber,
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ]);
    }
}
