<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'meds_id',
        'appointment_id',
        'doctor_id',
        'doc_notes',
        'm_med',
        'a_med',
        'n_med',
    ];
}
