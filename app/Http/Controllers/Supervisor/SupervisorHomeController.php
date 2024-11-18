<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function supervisorHome()
    {
        return view('supervisorHome'); // A Blade view for Supervisor Home
    }
}

