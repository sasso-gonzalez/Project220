@extends('layouts.app')
@include('layouts.navigation')
<br><br><br><br><b><br><br><br><br>

@section('content')
    <div class="container">
        <h1>Caregiver Home</h1>
        <form action="{{ route('caregiver.saveSchedule') }}" method="POST">
            @csrf
            @foreach($patients as $patient)
                {{ $patient->patient_id }}
            @endforeach
            @foreach($patientSchedules as $schedule)
                {{ $schedule->schedule_id }}
            @endforeach
            <button type="submit" class="btn btn-primary">Save Schedule</button>
        </form>
    </div>
@endsection
