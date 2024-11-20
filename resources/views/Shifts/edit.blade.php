@extends('layouts.app')

@section('content')
<div class="navbar">
    <div class="navbar_items">

        <!-- <div>{{ Auth::user()->name }}</div> -->
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
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="container mt-5">
    <h1>Edit Shift</h1>
    <form method="POST" action="{{ route('shifts.update', $shift->role) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="role">Role</label>
            <input type="text" name="role" id="role" value="{{ $shift->role }}" readonly>
        </div>
        <div>
            <label for="user_id">Assign User</label>
            <select name="user_id" id="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $shift->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $shift->name }}" required>
        </div>
        <div>
            <label for="shift_start">Shift Start</label>
            <input type="datetime-local" name="shift_start" id="shift_start" value="{{ $shift->shift_start }}" required>
        </div>
        <div>
            <label for="shift_end">Shift End</label>
            <input type="datetime-local" name="shift_end" id="shift_end" value="{{ $shift->shift_end }}" required>
        </div>
        <div>
            <label for="patient_group">Patient Group</label>
            <input type="text" name="patient_group" id="patient_group" value="{{ $shift->patient_group }}">
        </div>
        <button type="submit">Update Shift</button>
    </form>
</div>
