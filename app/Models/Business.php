<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'business_name',
        // 'cat_id',
        // 'sub_cat_id',
        'address',
        'road',
        'town',
        'city',
        'post_code',
        'tel',
        'mobile',
        'email',
        'web',
        'facebook',
        'instagram',
        'contact_them',
        'notes',
    ];


    public function customer(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function jobs(){
        return $this->hasMany(Job::class,'business_id');
    }

    public function notes(){
        return $this->belongsTo(Note::class,'notes_id');
    }
}
