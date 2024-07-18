<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable=[
        'customer_id',
        'size_id',
        'quantity',
        'item_id',
        'material',
        'price',
        'file',
        'user_id',
        'status_id',
    ];

    public function notes(){
        return $this->hasMany(Note::class,'job_id')->latest();
    }
    public function business(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function size(){
        return $this->belongsTo(Size::class,'size_id');
    }
    public function item(){
        return $this->belongsTo(Item::class,'item_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function status(){
        return $this->belongsTo(JobStatus::class,'status_id');
    }

    public function statusUpdates(){
        return $this->hasMany(JobStatusUpdates::class,'job_id')->latest();
    }
    public function employeeUpdates(){
        return $this->hasMany(JobAssignmentUpdates::class,'job_id');
    }

    public function images(){
        return $this->hasMany(JobImage::class,'job_id');
    }
}
