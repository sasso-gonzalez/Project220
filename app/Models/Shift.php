<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ShiftController; //not sure if this is necessary.

class Shift extends Model
{
    use HasFactory;

    // The primary key is 'role'
    protected $primaryKey = 'role';
    public $incrementing = false; // Since 'role' is not an integer and not auto-incrementing
    protected $keyType = 'string';

    // Fillable attributes for mass assignment
    protected $fillable = [
        'role',
        'user_id',
        'name',
        'shift_start',
        'shift_end',
        'patient_group',
    ];

    // Define relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
