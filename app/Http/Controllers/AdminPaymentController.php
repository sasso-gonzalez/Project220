<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    public function show()
    {
        return view('adminPayment'); //.blade file i guess -serena
    }

    public function submit(Request $request) //gotta figure this out - serena
    {
        // Logic to handle form submission
        // For example, save payment details to the database
        return redirect()->route('admin.payment.show')->with('success', 'Payment submitted successfully!');
    }

    public function cancel()//gotta figure this out - serena
    {
        // Logic to handle cancel action
        return redirect()->route('admin.payment.show');
    }
}
