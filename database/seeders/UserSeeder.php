<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('users')->insert([
            'role_id' => 1,
            'branch_id' => 1,
            'name' => 'River',
            'email' => 'river@ourmails.co.za',
            'address' => 'NO.20 Nelson Road, Southdale, Johannessburg, 2091',
            'city' => 'Johannesburg',
            'province' => 'Gauteng',
            'country' => 'South Africa',
            'phone' => '0760001111',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        \DB::table('users')->insert([
            'role_id' => 2,
            'branch_id' => 1,
            'name' => 'Water',
            'email' => 'water@ourmails.co.za',
            'address' => 'NO.30 Nelson Road, Southdale, Johannessburg, 2091',
            'city' => 'Johannesburg',
            'province' => 'Gauteng',
            'country' => 'South Africa',
            'phone' => '0760002222',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('users')->insert([
            'role_id' => 3,
            'branch_id' => 1,
            'name' => 'Lake',
            'email' => 'lake@ourmails.co.za',
            'address' => 'NO.40 Nelson Road, Southdale, Johannessburg, 2091',
            'city' => 'Johannesburg',
            'province' => 'Gauteng',
            'country' => 'South Africa',
            'phone' => '0760003333',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('users')->insert([
            'role_id' => 4,
            'branch_id' => 4,
            'name' => 'Blue Inc',
            'email' => 'blue@ourmails.co.za',
            'address' => 'NO.121 Nelson Road, Waterland, Johannessburg, 2091',
            'city' => 'Johannesburg',
            'province' => 'Gauteng',
            'country' => 'South Africa',
            'phone' => '0760004444',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);



    }
}
