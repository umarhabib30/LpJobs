<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = [
        'note',
        'job_id',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
