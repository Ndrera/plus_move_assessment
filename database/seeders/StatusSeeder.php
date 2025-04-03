<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //
        \DB::table('statuses')->insert([
            'status_name' => 'Picked',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('statuses')->insert([
            'status_name' => 'Received',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('statuses')->insert([
            'status_name' => 'Shipping',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('statuses')->insert([
            'status_name' => 'Delayed',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('statuses')->insert([
            'status_name' => 'Returned',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('statuses')->insert([
            'status_name' => 'Delivered',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('statuses')->insert([
            'status_name' => 'Corporate',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
