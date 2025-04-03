<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //
        \DB::table('locations')->insert([
            'location_name' => 'Gauteng',
            'location_abbreviation' => 'GP',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('locations')->insert([
            'location_name' => 'KwaZulu Natal',
            'location_abbreviation' => 'KZN',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('locations')->insert([
            'location_name' => 'Limpopo',
            'location_abbreviation' => 'LP',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('locations')->insert([
            'location_name' => 'Eastern Cape',
            'location_abbreviation' => 'EC',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('locations')->insert([
            'location_name' => 'Free State',
            'location_abbreviation' => 'FS',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        
        \DB::table('locations')->insert([
            'location_name' => 'Mpumalanga',
            'location_abbreviation' => 'MP',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('locations')->insert([
            'location_name' => 'Northern Cape',
            'location_abbreviation' => 'NC',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('locations')->insert([
            'location_name' => 'North West',
            'location_abbreviation' => 'NW',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('locations')->insert([
            'location_name' => 'Western Cape',
            'location_abbreviation' => 'WC',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


    }
}
