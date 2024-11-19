<?php

namespace App\Http\Controllers\Caregiver;

use App\Http\Controllers\Controller;////////////////

class CaregiverHomeController extends Controller
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
