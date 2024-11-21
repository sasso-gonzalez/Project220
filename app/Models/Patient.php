<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'user_id',
        'family_code',
        'caregroup',
        'amount_due',
        'payment_date'
    ];
}
