<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\AdminRolesController;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role', 
        'access_level'
    ];

}
