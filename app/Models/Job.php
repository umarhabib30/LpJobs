<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable=[
        'customer',
        'size',
        'quantity',
        'item',
        'material',
        'price',
        'file',
        'user',
        'status',
    ];

    public function notes(){
        return $this->hasMany(Note::class,'job_id');
    }
}
