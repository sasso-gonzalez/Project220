@extends('layouts.app')

@section('content')
<div class="navbar">
    <div class="navbar_items">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault();
                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>
        <form method="GET" action="{{ route('admin.pending') }}">
            @csrf
            <button type="submit">{{ __('Account Status') }}</button>
        </form>
        <form method="GET" action="{{ route('adminHome') }}">
            @csrf
            <button type="submit">{{ __('Home') }}</button>
        </form>
        <form method="GET" action="{{ route('adminRoles') }}">
            @csrf
            <button type="submit">{{ __('Roles') }}</button>
        </form>
        <form method="GET" action="{{ route('shifts.index') }}">
            @csrf
            <button type="submit">{{ __('Work Shifts') }}</button>
        </form>
        <form method="GET" action="{{ route('adminList') }}">
            @csrf
            <button type="submit">{{ __('Patients/Employee List') }}</button>
        </form>
    </div>
</div>
<br><br><br><br>
<div class="container">
    <h1>Create Shift</h1>
    <form action="{{ route('shifts.store') }}" method="POST">
        @csrf
        <input type="date" name="shift_date" required>
        <input type="datetime-local" name="shift_start" required>
        <input type="datetime-local" name="shift_end" required>
        <div id="caregroup-div">
            <label for="caregroup">Care Group:</label>
            <select name="caregroup" id="caregroup" required>
                @foreach ($availableCaregroups as $caregroup)
                    <option value="{{ $caregroup }}">{{ $caregroup }}</option>
                @endforeach
            </select>
        </div>
        <label for="emp_id">Employee:</label>
        <select name="emp_id" id="emp_id" required onchange="updateRole()">
            <option value="">Select Employee</option>
            @foreach ($employees as $employee)
                <option value="{{ $employee->emp_id }}" data-role="{{ $employee->user->role }}">
                    {{ $employee->user->first_name }} {{ $employee->user->last_name }}
                </option>
            @endforeach
        </select>
        <input type="hidden" id="role" name="role">
        <button type="submit">Create Shift</button>
    </form>
</div>

<script>
    function updateRole() {
        const selectedOption = document.querySelector('#emp_id option:checked');
        const role = selectedOption.getAttribute('data-role');
        document.getElementById('role').value = role;

        // Show or hide caregiver group dropdown based on role
        const caregroupDiv = document.getElementById('caregroup-div');
        if (role === 'Caregiver') {
            caregroupDiv.style.display = 'block';
        } else {
            caregroupDiv.style.display = 'none';
        }
    }

    // Initialize the form based on the selected employee
    document.addEventListener('DOMContentLoaded', function() {
        updateRole();
    });
</script>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection
