<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        //
        \DB::table('branches')->insert([
            'branch_name' => 'Head Office',
            'branch_email' => 'head@ourmails.co.za',
            'branch_phone' => '0115671234',
            'branch_address' => 'NO.46 Nelson Road, Southdale, Johannesburg, Gauteng, 2091  Johannesburg',
            'branch_city' => 'Johannesburg',
            'branch_province' => 'Gauteng',
            'branch_country' => 'South Africa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('branches')->insert([
            'branch_name' => 'Durban Branch',
            'branch_email' => 'durban@ourmails.co.za',
            'branch_phone' => '0318901234',
            'branch_address' => 'NO.46 Nelson Road, Southdale, Durban, KwaZulu Natal, 2091',
            'branch_city' => 'Durban',
            'branch_province' => 'KwaZulu Natal',
            'branch_country' => 'South Africa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('branches')->insert([
            'branch_name' => 'Limpopo Branch',
            'branch_email' => 'limpopo@ourmails.co.za',
            'branch_phone' => '0115671234',
            'branch_address' => 'NO.46 Nelson Road, Bayede',
            'branch_city' => 'Polokwane',
            'branch_province' => 'Limpopo',
            'branch_country' => 'South Africa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \DB::table('branches')->insert([
            'branch_name' => 'Corporate Branch',
            'branch_email' => 'corporate@ourmails.co.za',
            'branch_phone' => '0115671234',
            'branch_address' => 'NO.56 Norwood, Johannesburg, 2023',
            'branch_city' => 'Johannessburg',
            'branch_province' => 'Gauteng',
            'branch_country' => 'South Africa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
