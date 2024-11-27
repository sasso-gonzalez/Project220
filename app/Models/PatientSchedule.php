<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientSchedule extends Model
{
    use HasFactory;

    // Define the custom primary key
    protected $primaryKey = 'schedule_id';

    // Set to false if your primary key is not auto-incrementing
    public $incrementing = true;

    // Specify the primary key type
    protected $keyType = 'int';

    // Allow mass assignment for the required columns
    protected $fillable = [
        'caregiver_id', 
        'patient_id', 
        'particular_date', 
        'm_med', 
        'a_med', 
        'n_med', 
        'breakfast', 
        'lunch', 
        'dinner'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'patient_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'caregiver_id', 'emp_id');
    }
}
