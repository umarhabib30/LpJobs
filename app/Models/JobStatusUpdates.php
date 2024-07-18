<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobStatusUpdates extends Model
{
    use HasFactory;
    protected $fillable = [
        'status_id',
        'job_id',
        'updated_by',
    ];

    public function status()
    {
        return $this->belongsTo(JobStatus::class, 'status_id');
    }

    public function updatedBy(){
        return $this->belongsTo(User::class,'updated_by');
    }
}
