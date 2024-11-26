<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\User; // Ensure you import the User model
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $user = User::findOrFail($id);
        return view('patientHome', compact('user'));
    }
    
    //admin/supervisor can edit/add additional details for each patient (only once per patient) -serena/isaiah 
    public function patientDetails(Request $request, $id)
    {
        $patient = Patient::with('user')->where('patient_id', $id)->firstOrFail();
        return view('additionalInfo', compact('patient'));
    }

public function updatingDetails(Request $request, $id)
{
    // validating the incoming request data
    $request->validate([
        'patient_id' => 'required|exists:patients,patient_id',
        'caregroup' => 'required|string',
        'admission_date' => 'required|date',
    ]);

    // retrieving the patient record using patient_id
    $patient = Patient::where('patient_id', $id)->first();

    // check if the patient record exists
    if (!$patient) {
        return redirect()->back()->withErrors(['error' => 'Patient not found.']);
    }

    $patient->caregroup = $request->caregroup;
    $patient->admission_date = $request->admission_date;
    $patient->save();

    return redirect()->route('adminList')->with('success', 'Patient details updated successfully.');
}


}

?>
