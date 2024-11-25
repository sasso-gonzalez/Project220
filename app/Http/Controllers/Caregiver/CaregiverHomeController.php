<?php

namespace App\Http\Controllers\Caregiver;

use App\Http\Controllers\Controller;////////////////

class CaregiverHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showCaregiverHome()
    {
        $patients = Patient::all(); // Fetch patients from the database
        return view('caregiver_home', compact('patients'));
    }
    public function caregiverHome()
    {
        return view('caregiverHome'); // A Blade view for Caregiver Home
    }
}
