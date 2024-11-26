<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Shift;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_id',
        'user_id',
        'salary',
    ];

    protected $primaryKey = 'emp_id';

    // public $incrementing = false; //for something like roles where it tries to increment strings/letters -serena

    /**
     * Relationship with User model
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relationship with Shift model
     */
    public function shifts()
    {
        return $this->hasMany(Shift::class, 'emp_id', 'emp_id');
    }

    /**
     * Scope for filtering by role
     */
    public function scopeByRole($query, $role)
    {
        return $query->whereHas('user', function ($q) use ($role) {
            $q->where('role', $role);
        });
    }
    
    public function patientSchedules()
    {
        return $this->hasMany(PatientSchedule::class, 'caregiver_id', 'emp_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'emp_id', 'emp_id');
    }

}

