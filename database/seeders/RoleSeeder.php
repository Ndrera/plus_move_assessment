<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //
        \DB::table('roles')->insert([
            'role_name' => 'Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('roles')->insert([
            'role_name' => 'Warehouse',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('roles')->insert([
            'role_name' => 'Driver',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('roles')->insert([
            'role_name' => 'Client',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
