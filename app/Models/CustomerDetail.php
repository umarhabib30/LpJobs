<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'address',
        'road',
        'town',
        'city',
        'post_code',
        'mobile',
    ];
}
