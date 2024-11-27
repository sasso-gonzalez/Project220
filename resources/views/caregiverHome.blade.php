@extends('layouts.app')
@include('layouts.navigation')
<br><br><br><br><b><br><br><br><br>

@section('content')
    <div class="container">
        <h1>Caregiver Home</h1>

        <!-- Table for Patients and Their Schedule -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Patient ID</th>
                    <th>Patient Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patients as $patient)
                    <tr>
                        <td>{{ $patient->patient_id }}</td>
                        <td>{{ $patient->user->first_name }} {{ $patient->user->last_name }}</td>
                        <td>
                            <a href="{{ route('caregiver.schedule', ['id' => $patient->patient_id]) }}" class="btn btn-primary">Go to Schedule</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No patients found for this caregiver.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection