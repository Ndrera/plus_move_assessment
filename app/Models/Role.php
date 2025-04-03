<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
        'deleted_at'
    ];


    public function user(){
        return $this->belongsTo('App\User', 'role_id');
    }

}
