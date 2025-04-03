<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'package_id',
        'tracking_no',
        'sender_name',
        'sender_contact',
        'sender_email',
        'sender_address',
        'sender_city',
        'sender_province',
        'sender_pin',
        'sender_country',
        'recipient_name',
        'recipient_contact',
        'recipient_email',
        'recipient_address',
        'recipient_city',
        'recipient_province',
        'recipient_pin',
        'recipient_country',
        'courier_desc',
        'weight',
        'length',
        'width',
        'height',
        'price',
        'created_by',
        'updated_by',
        'deleted_at'
    ];

}
