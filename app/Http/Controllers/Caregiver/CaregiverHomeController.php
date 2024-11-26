<?php

namespace App\Http\Controllers\Caregiver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\PatientSchedule;
use App\Models\Shift;

class CaregiverHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showCaregiverHome(Request $request)
    {
        // Fetch caregiver ID from authenticated user
        $caregiverId = auth()->user()->employee->emp_id;
    
        // Fetch patient schedules for the caregiver for today
        $patientSchedules = PatientSchedule::with('patient')
            ->where('caregiver_id', $caregiverId)
            ->whereDate('particular_date', now()->format('Y-m-d'))
            ->whereHas('patient', function ($query) {
                $query->where('admission_date', '<=', now()->format('Y-m-d'));
            })
            ->get();
    
        // Extract patients from the schedules
        $patients = $patientSchedules->map(function ($schedule) {
            return $schedule->patient;
        });
    
        return view('caregiverHome', compact('patientSchedules', 'patients'));
    }

    public function savePatientSchedule(Request $request)
    {
        $caregiverId = auth()->user()->employee->emp_id;

        // Validate the incoming data
        $validated = $request->validate([
            'patient_id' => 'required|array',
            'm_med' => 'array',
            'a_med' => 'array',
            'n_med' => 'array',
            'breakfast' => 'array',
            'lunch' => 'array',
            'dinner' => 'array',
        ]);

        foreach ($validated['patient_id'] as $patientId) {
            PatientSchedule::updateOrCreate(
                [
                    'caregiver_id' => $caregiverId,
                    'patient_id' => $patientId,
                    'particular_date' => now()->format('Y-m-d'),
                ],
                [
                    'm_med' => in_array($patientId, $validated['m_med'] ?? []),
                    'a_med' => in_array($patientId, $validated['a_med'] ?? []),
                    'n_med' => in_array($patientId, $validated['n_med'] ?? []),
                    'breakfast' => in_array($patientId, $validated['breakfast'] ?? []),
                    'lunch' => in_array($patientId, $validated['lunch'] ?? []),
                    'dinner' => in_array($patientId, $validated['dinner'] ?? []),
                ]
            );
        }

        return redirect()->route('caregiverHome')->with('success', 'Schedule updated successfully!');
    }
}

