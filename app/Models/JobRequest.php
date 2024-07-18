<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_id',
        'requested_by',
        'employee_id',
        'assigned',
    ];

    public function employee(){
        return $this->belongsTo(User::class,'employee_id');
    }
    public function requestedBy(){
        return $this->belongsTo(User::class,'requested_by');
    }
    public function job(){
        return $this->belongsTo(Job::class,'job_id');
    }
}
