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
    <h1>Edit Shift</h1>
    <form method="POST" action="{{ route('shifts.update', $shift->id) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="emp_id">Assign Employee</label>
            <select name="emp_id" id="emp_id" onchange="updateRole()" required>
                <option value="" disabled>Select an Employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->emp_id }}" 
                        data-role="{{ $employee->user->role ?? '' }}"
                        {{ $shift->emp_id == $employee->emp_id ? 'selected' : '' }}>
                        {{ $employee->user->first_name ?? 'N/A' }} {{ $employee->user->last_name ?? 'N/A' }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="role">Role</label>
            <input type="text" name="role" id="role" value="{{ $shift->employee->user->role ?? '' }}" readonly>
        </div>
        <div id="caregroup-div" style="display: {{ $shift->employee->user->role == 'Caregiver' ? 'block' : 'none' }};">
            <label for="caregroup">Caregiver Group</label>
            <select name="caregroup" id="caregroup">
                <!-- <option value="" disabled>Select a Group</option> -->
                <option value="">Select a Group</option>
                <option value="Group A" {{ $shift->caregroup == 'Group A' ? 'selected' : '' }}>Group A</option>
                <option value="Group B" {{ $shift->caregroup == 'Group B' ? 'selected' : '' }}>Group B</option>
                <option value="Group C" {{ $shift->caregroup == 'Group C' ? 'selected' : '' }}>Group C</option>
                <option value="Group D" {{ $shift->caregroup == 'Group D' ? 'selected' : '' }}>Group D</option>
            </select>
        </div>
        <div>
            <label for="shift_start">Shift Start</label>
            <input type="datetime-local" name="shift_start" id="shift_start" value="{{ $shift->shift_start }}" required>
        </div>
        <div>
            <label for="shift_end">Shift End</label>
            <input type="datetime-local" name="shift_end" id="shift_end" value="{{ $shift->shift_end }}" required>
        </div>
        <button type="submit">Update Shift</button>
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
        caregroupSelect.selectedIndex = 0; // Reset the caregroup dropdown
        }
    }
</script>
@endsection
