<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ShiftController; //not sure if this is necessary.

class Shift extends Model
{
    use HasFactory;


    // public $incrementing = false; // Since 'role' is not an integer and not auto-incrementing
    protected $keyType = 'string';
    protected $primaryKey = 'id'; 

    // Fillable attributes for mass assignment
    protected $fillable = [
        'emp_id',
        'caregroup', //added this - serena
        'shift_start',
        'shift_end',
    ];

    // Define relationship with the User model
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
}
