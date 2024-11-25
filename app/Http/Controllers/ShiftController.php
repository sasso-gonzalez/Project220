<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shift;
use App\Models\Employee;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of shifts.
     */
    public function index(Request $request)
    {
        $query = Shift::with('employee.user'); // Eager load employee and user
    
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
        $assignedCaregivers = Shift::where('shift_date', now()->toDateString())
            ->whereHas('employee.user', function ($query) {
                $query->where('role', 'Caregiver');
            })
            ->pluck('emp_id')
            ->toArray();

        $assignedCaregroups = Shift::where('shift_date', now()->toDateString())
            ->pluck('caregroup')
            ->toArray();

        $employees = Employee::with('user')
            ->whereNotIn('emp_id', $assignedCaregivers)
            ->get();

        $allCaregroups = ['A', 'B', 'C', 'D'];
        $availableCaregroups = array_diff($allCaregroups, $assignedCaregroups);

        return view('shifts.create', compact('employees', 'availableCaregroups'));
    }

    /**
     * Store a new shift in the database.
     */

     public function store(Request $request)
     {
         $request->validate([
             'shift_date' => 'required|date',
             'shift_start' => 'required|date',
             'shift_end' => 'required|date|after:shift_start',
             'caregroup' => 'nullable|string',
             'emp_id' => [
                 'required',
                 'exists:employees,emp_id',
                 function ($attribute, $value, $fail) use ($request) {
                     $employee = Employee::with('user')->where('emp_id', $value)->first();
                     if ($employee) {
                         // Check if the employee is already scheduled for a different care group on the same day
                         $exists = Shift::where('shift_date', $request->shift_date)
                             ->where('emp_id', $value)
                             ->where('caregroup', '<>', $request->caregroup)
                             ->exists();
                         if ($exists) {
                             $fail('This employee is already scheduled for a different care group on this date.');
                         }
                     }
                 },
             ],
         ]);
     
         Shift::create($request->all());
     
         return redirect()->route('shifts.index')->with('success', 'Shift created successfully.');
     }



     
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'shift_date' => 'required|date',
    //         'shift_start' => 'required|date',
    //         'shift_end' => 'required|date|after:shift_start',
    //         'caregroup' => 'nullable|string',
    //         'emp_id' => [
    //             'required',
    //             'exists:employees,emp_id',
    //             function ($attribute, $value, $fail) use ($request) {
    //                 $employee = Employee::with('user')->where('emp_id', $value)->first();
    //                 if ($employee && $employee->user->role === 'Caregiver' && $request->caregroup) {
    //                     $exists = Shift::where('shift_date', $request->shift_date)
    //                         ->where('caregroup', $request->caregroup)
    //                         ->whereHas('employee.user', function ($query) {
    //                             $query->where('role', 'Caregiver');
    //                         })
    //                         ->exists();
    //                     if ($exists) {
    //                         $fail('Only one Caregiver can work with this patient group on this date.');
    //                     }
    //                 }
    //             },
    //         ],
    //     ]);
    
    //     Shift::create($request->all());
    
    //     return redirect()->route('shifts.index')->with('success', 'Shift created successfully.');
    // }

    /**
     * Show the form for editing an existing shift.
     */
    public function edit($id)
    {
        $shift = Shift::findOrFail($id);

        $assignedCaregivers = Shift::where('shift_date', $shift->shift_date)
            ->where('id', '<>', $id)
            ->whereHas('employee.user', function ($query) {
                $query->where('role', 'Caregiver');
            })
            ->pluck('emp_id')
            ->toArray();

        $assignedCaregroups = Shift::where('shift_date', $shift->shift_date)
            ->where('id', '<>', $id)
            ->pluck('caregroup')
            ->toArray();

        $employees = Employee::with('user')
            ->whereNotIn('emp_id', $assignedCaregivers)
            ->get();

        $allCaregroups = ['A', 'B', 'C', 'D'];
        $availableCaregroups = array_diff($allCaregroups, $assignedCaregroups);

        return view('shifts.edit', compact('shift', 'employees', 'availableCaregroups'));
    }

    /**
     * Update an existing shift in the database.
     */


     public function update(Request $request, $id)
{
    $request->validate([
        'shift_date' => 'required|date',
        'shift_start' => 'required|date',
        'shift_end' => 'required|date|after:shift_start',
        'caregroup' => 'nullable|string',
        'emp_id' => [
            'required',
            'exists:employees,emp_id',
            function ($attribute, $value, $fail) use ($request, $id) {
                $employee = Employee::with('user')->where('emp_id', $value)->first();
                if ($employee) {
                    // Check if the employee is already scheduled for a different care group on the same day
                    $exists = Shift::where('shift_date', $request->shift_date)
                        ->where('emp_id', $value)
                        ->where('caregroup', '<>', $request->caregroup)
                        ->where('id', '<>', $id) // Exclude the current shift
                        ->exists();
                    if ($exists) {
                        $fail('This employee is already scheduled for a different care group on this date.');
                    }
                }
            },
        ],
    ]);

    $shift = Shift::findOrFail($id);
    $shift->update($request->all());

    return redirect()->route('shifts.index')->with('success', 'Shift updated successfully.');
}
//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'shift_date' => 'required|date',
//             'shift_start' => 'required|date',
//             'shift_end' => 'required|date|after:shift_start',
//             'caregroup' => 'nullable|string',
//             'emp_id' => [
//                 'required',
//                 'exists:employees,emp_id',
//                 function ($attribute, $value, $fail) use ($request, $id) {
//                     $employee = Employee::with('user')->where('emp_id', $value)->first();
//                     if ($employee && $employee->user->role === 'Caregiver' && $request->caregroup) {
//                         $exists = Shift::where('shift_date', $request->shift_date)
//                             ->where('caregroup', $request->caregroup)
//                             ->whereHas('employee.user', function ($query) {
//                                 $query->where('role', 'Caregiver');
//                             })
//                             ->where('id', '<>', $id) // Exclude the current shift
//                             ->exists();
//                         if ($exists) {
//                             $fail('Only one Caregiver can work with this patient group on this date.');
//                         }
//                     }
//                 },
//             ],
//         ]);
    
//         $shift = Shift::findOrFail($id);
//         $shift->update($request->all());
    
//         return redirect()->route('shifts.index')->with('success', 'Shift updated successfully.');
//     }

}





