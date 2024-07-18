<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobAssignmentUpdates extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'job_id',
        'updated_by',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
