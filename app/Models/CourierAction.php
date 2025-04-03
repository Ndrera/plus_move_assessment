<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourierAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'courier_id',
        'action_date',
        'remarks',
        'status_id',
        'updated_by',
        'deleted_at'
    ];

}
