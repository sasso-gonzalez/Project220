<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'appointment_id',
        'patient_id',
        'doctor_id',
        'app_notes',
        'app_date',
    ];
}
