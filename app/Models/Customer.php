<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable=[
        'business_name',
        'cat_id',
        'sub_cat_id',
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
        'notes_id',
        'contact_them',
    ];

    public function category(){
        return $this->belongsTo(Category::class,'cat_id');
    }

    public function notes(){
        return $this->belongsTo(Note::class,'notes_id');
    }
}
