<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_name',
        'branch_email',
        'branch_phone',
        'branch_address',
        'branch_city',
        'branch_province',
        'branch_country',
        'deleted_at'
    ];

}
