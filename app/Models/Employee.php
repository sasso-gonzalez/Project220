<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\EmployeeController;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_id',
        'user_id', 
        'salary',
    ];
}
