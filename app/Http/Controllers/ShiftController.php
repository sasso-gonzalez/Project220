<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shift;
use App\Models\Employee; //changed from User to employee
use Illuminate\Http\Request;


class ShiftController extends Controller
{
    /**
     * Display a listing of shifts.
     */
    public function index(Request $request)
    {
        $query = Shift::with('employee.user');
    
        if ($request->has('date')) {
            $date = $request->input('date');
            $query->whereDate('shift_start', $date);
        }
    
        $shifts = $query->orderBy('shift_start', 'asc')->get();
    
        return view('shifts.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new shift.
     */
    public function create()
    {
        // Fetch all employees and eager load their related user (to get the role and name)
        $employees = Employee::with('user')->get(); // This will include the user's data (name, role, etc.)
        
        return view('shifts.create', compact('employees'));
    }

    /**
     * Store a new shift in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'emp_id' => 'required|exists:employees,emp_id',
            'shift_start' => 'required|date',
            'shift_end' => 'required|date|after:shift_start',
            'caregroup' => 'nullable|string|max:255',
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
        $employees = Employee::all();
        return view('shifts.edit', compact('shift', 'employees'));
    }
    
    

    /**
     * Update an existing shift in the database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'emp_id' => 'required|exists:employees,emp_id',
            'shift_start' => 'required|date',
            'shift_end' => 'required|date|after:shift_start',
            'caregroup' => 'nullable|string|max:255',
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
