<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;////////////////

class PatientHomeController extends Controller
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

?>
