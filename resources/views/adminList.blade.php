@extends('layouts.app')
@include('layouts.navigation')
<br><br><br><br><br><br><br><br>

@section('content')
    <div class="container">
        <table> 
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($adminPatientList as $user)
                    <tr>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->role }}</td>
                        @php
                            $patientDetail = $patientDetails->firstWhere('user_id', $user->id);
                        @endphp
                        <td>
                            @if ($patientDetail && $patientDetail->caregroup == null)
                                <a href="{{ route('additionalInfo', ['id'=>$patientDetail->patient_id]) }}">Additional Details</a>
                            @elseif ($patientDetail)
                                {{ $patientDetail->caregroup }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> 
        <br><br>
        <table> 
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                @foreach($adminEmployeeList as $user)
                    <tr>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <div>
                            <form action="{{ route('admin.submitSalary', ['id' => $user->employee->emp_id]) }}" method="POST">
                        @csrf
                        @if ($user->role === 'admin')
                        <div>
                            <input type="number" id="salary-{{ $user->employee->emp_id }}" 
                                   value="{{ $user->employee->salary ?? '' }}" 
                                   name="salary" 
                                   required 
                                   min="0">
                            <button type="submit">Submit</button>
                        </div>
                        @else
                            <td>{{ $user->employee->salary ?? '' }}</td>
                        @endif

                    </form>
                            </div>
                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection