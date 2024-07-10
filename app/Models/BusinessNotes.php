<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessNotes extends Model
{
    use HasFactory;
    protected $fillable =[
        'notes','customer_id'
    ];
}
