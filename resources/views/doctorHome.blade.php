@extends('layouts.app')
@include('layouts.navigation')
<br><br><br><br><br>
@section('content')
    <div class="container">
        <h1>Welcome, Doctor!</h1>
        <p>This is the Doctor Dashboard.</p>

        <h2>Past Appointments</h2>
        <table>
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Appointment Date</th>
                    <th>Morning Medication</th>
                    <th>Afternoon Medication</th>
                    <th>Night Medication</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pastAppointments as $appointment)
                    @foreach($appointment->prescriptions as $prescription)
                        <tr>
                            <td>{{ $appointment->patient->user->first_name }} {{ $appointment->patient->user->last_name }}</td>
                            <td>{{ $appointment->app_date }}</td>
                            <td>{{ $prescription->m_med }}</td>
                            <td>{{ $prescription->a_med }}</td>
                            <td>{{ $prescription->n_med }}</td>
                            <td>
                                <form method="GET" action="{{ route('patientOfDoctor', ['appointment' => $appointment->appointment_id]) }}">
                                    <button type="submit">View Details</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <h2>Current and Future Appointments</h2>
        <form method="GET" action="{{ route('doctorAppointments') }}">
            <label for="tillDate">Select End Date:</label>
            <input type="date" id="tillDate" name="tillDate" value="{{ request('tillDate', date('Y-m-d', strtotime('+1 month'))) }}">
            <button type="submit">Search</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Appointment Date</th>
                    <th>Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach($currentAppointments as $appointment)
                    <tr>
                        <td>{{ $appointment->patient->user->first_name }} {{ $appointment->patient->user->last_name }}</td>
                        <td>{{ $appointment->app_date }}</td>
                        <td>
                            <form method="GET" action="{{ route('patientOfDoctor', ['appointment' => $appointment->appointment_id]) }}">
                                <button type="submit">View Details</button>
                            </form>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection