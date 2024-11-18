<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaregiverController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function caregiverHome()
    {
        return view('caregiverHome'); // A Blade view for Caregiver Home
    }
}
