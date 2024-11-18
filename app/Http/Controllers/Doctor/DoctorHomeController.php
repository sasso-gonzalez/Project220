<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;

class DoctorHomeController extends Controller
{
    public function __construct() //this might've been the problem but idk...-serena
    { 
        $this->middleware('auth');
    }
    
    public function index()
    {
        $listUsers = User::where('role', 'Patient')->get();

        return view('patientList', ['listingPatients' => $listingPatients]); 

    }

    public function doctorHome()
    {
        return view('doctorHome'); // A Blade view for Doctor Home
    } 
}