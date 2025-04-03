<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //
        \DB::table('vehicles')->insert([
            'vehicle_name' => 'Toyota',
            'vehicle_model' => 'Etios',
            'vehicle_registration' => 'SWE 123 GP',
            'vin_no' => '12312312',
            'vehicle_mileage' => '90000',
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        \DB::table('vehicles')->insert([
            'vehicle_name' => 'VW',
            'vehicle_model' => 'Vivo',
            'vehicle_registration' => 'PUX 345 GP',
            'vin_no' => '333111',
            'vehicle_mileage' => '45000',
            'created_at' => now(),
            'updated_at' => now(),

        ]);

        \DB::table('vehicles')->insert([
            'vehicle_name' => 'BMW',
            'vehicle_model' => '1 Series',
            'vehicle_registration' => 'GH 678 GP',
            'vin_no' => '444555',
            'vehicle_mileage' => '24000',
            'created_at' => now(),
            'updated_at' => now(),

        ]);

    }
}
