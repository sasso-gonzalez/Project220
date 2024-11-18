<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function patientHome()
    {
        return view('patientHome'); // A Blade view for patient Home
    }
}