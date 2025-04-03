<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //
        \DB::table('rates')->insert([
            'per_kg_rate' => '100',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
