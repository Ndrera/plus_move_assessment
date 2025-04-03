<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoadManagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'courier_id',
        'status_id',
        'deleted_at'
    ];

}
