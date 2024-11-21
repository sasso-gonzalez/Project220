<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientSchedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'schedule_id',
        'patient_id',
        'caregiver_id',
        'particular_date',
        'm_med',
        'a_med',
        'n_med',
        'breakfeast',
        'lunch',
        'dinner',
    ];
}
