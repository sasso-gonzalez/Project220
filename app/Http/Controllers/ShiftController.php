<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of shifts.
     */
    public function index()
    {
        $shifts = Shift::all();
        return view('shifts.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new shift.
     */
    public function create()
    {
        $users = User::all(); // Get all users to select for the shift
        return view('shifts.create', compact('users'));
    }

    /**
     * Store a new shift in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|string|unique:shifts',
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'shift_start' => 'required|date',
            'shift_end' => 'required|date|after:shift_start',
            'patient_group' => 'nullable|string|max:255',
        ]);

        Shift::create($request->all());

        return redirect()->route('shifts.index')->with('success', 'Shift created successfully!');
    }

    /**
     * Show the form for editing an existing shift.
     */
    public function edit($id)
    {
        $shift = Shift::findOrFail($id);
        $users = User::all(); // Get all users to select for the shift
        return view('shifts.edit', compact('shift', 'users'));
    }

    /**
     * Update an existing shift in the database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|string|unique:shifts,role,' . $id,
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'shift_start' => 'required|date',
            'shift_end' => 'required|date|after:shift_start',
            'patient_group' => 'nullable|string|max:255',
        ]);

        $shift = Shift::findOrFail($id);
        $shift->update($request->all());

        return redirect()->route('shifts.index')->with('success', 'Shift updated successfully!');
    }
}


// namespace App\Http\Controllers;

// use App\Models\Shift;
// use App\Models\User;
// use Illuminate\Http\Request;

// class ShiftController extends Controller
// {
//     /**
//      * Display a listing of shifts.
//      */
//     public function index(Request $request)
//     {
//         $shifts = Shift::all();
//         return view('shifts.index', compact('shifts'));
//     }

//     /**
//      * Store a new shift in the database.
//      */
//     public function store(Request $request)
//     {
//         $request->validate([
//             'role' => 'required|string|unique:shifts',
//             'user_id' => 'required|exists:users,id',
//             'name' => 'required|string|max:255',
//             'shift_start' => 'required|date',
//             'shift_end' => 'required|date|after:shift_start',
//             'patient_group' => 'nullable|string|max:255',
//         ]);

//         Shift::create($request->all());

//         return redirect()->back()->with('success', 'Shift created successfully!');
//     }
// }
