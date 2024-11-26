@extends('layouts.app')
@include('layouts.navigation')
<br><br><br><br><br><br><br>
@section('content')
<div class="container">
    <h1>Additional Information of Patient</h1>
    <form action="{{ route('updatingDetails', ['id' => $patient->patient_id]) }}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="patient_id" class="col-sm-2 col-form-label">Patient ID</label>
            <div class="col-sm-4">
                <input 
                    type="text" 
                    value="{{ $patient->patient_id }}"
                    class="form-control" 
                    id="patient_id" 
                    name="patient_id" 
                    readonly>
            </div>

            <label for="patient_name" class="col-sm-2 col-form-label">Patient Name</label>
            <div class="col-sm-4">
                <input 
                    type="text" 
                    value="{{ $patient->user->first_name }} {{ $patient->user->last_name }}"
                    class="form-control" 
                    id="patient_name" 
                    name="patient_name" 
                    readonly>
            </div>
        </div>

        <div class="form-group row">
            <label for="caregroup" class="col-sm-2 col-form-label">Caregroup</label>
            <div class="col-sm-10">
                <select class="form-control" id="caregroup" name="caregroup" required>
                    <option value="A" {{ $patient->caregroup == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ $patient->caregroup == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ $patient->caregroup == 'C' ? 'selected' : '' }}>C</option>
                    <option value="D" {{ $patient->caregroup == 'D' ? 'selected' : '' }}>D</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="admission_date" class="col-sm-2 col-form-label">Admission Date</label>
            <div class="col-sm-10">
                <input 
                    type="date" 
                    class="form-control" 
                    id="admission_date" 
                    name="admission_date" 
                    value="{{ $patient->admission_date }}" 
                    required>
            </div>
        </div>

        <p class="text-muted">
            This page is accessed by Admin and Supervisor after the registration is approved for a student.
        </p>

        <div class="form-group row">
            <div class="col-sm-12 text-right">
                <button type="submit" class="btn btn-success">Ok</button>
                <a href="{{ route('adminList') }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection