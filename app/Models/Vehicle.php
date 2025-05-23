<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_name',
        'vehicle_model',
        'vehicle_registration',
        'vin_no',
        'vehicle_mileage',
        'deleted_at'
    ];

}
