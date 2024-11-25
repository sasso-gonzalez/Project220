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
    <form method="POST" action="{{ route('shifts.store') }}">
        @csrf
        <div>
            <label for="emp_id">Assign Employee</label>
            <select name="emp_id" id="emp_id" onchange="updateRole()" required>
                <option value="" disabled selected>Select an Employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->emp_id }}" 
                        data-role="{{ $employee->user->role ?? '' }}">
                        {{ $employee->user->first_name ?? 'N/A' }} {{ $employee->user->last_name ?? 'N/A' }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="role">Role</label>
            <input type="text" name="role" id="role" readonly>
        </div>
        <div id="caregroup-div" style="display: none;">
            <label for="caregroup">Caregiver Group</label>
            <select name="caregroup" id="caregroup">
                <option value="" disabled selected>Select a Group</option>
                <option value="Group A">Group A</option>
                <option value="Group B">Group B</option>
                <option value="Group C">Group C</option>
            </select>
        </div>
        <div>
            <label for="shift_start">Shift Start</label>
            <input type="datetime-local" name="shift_start" id="shift_start" required>
        </div>
        <div>
            <label for="shift_end">Shift End</label>
            <input type="datetime-local" name="shift_end" id="shift_end" required>
        </div>
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
</script>
@endsection
