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
    <br><br><br>
    <div class="container">
        <h1>Shift Roster</h1>
        
        <!-- Display the Add Shift button for authorized users -->
        @if(auth()->user()->hasRole(['admin', 'Supervisor']))
            <a href="{{ route('shifts.create') }}" class="btn btn-primary mb-3">Add Shift</a>
        @endif

        <!-- Table to display the shifts -->
        <table class="table">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Shift Start</th>
                    <th>Shift End</th>
                    <th>Patient Group</th>
                    @if(auth()->user()->hasRole(['admin', 'Supervisor']))
                        <th>Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($shifts as $shift)
                    <tr>
                        <td>{{ $shift->role }}</td>
                        <td>{{ $shift->name }}</td>
                        <td>{{ $shift->shift_start }}</td>
                        <td>{{ $shift->shift_end }}</td>
                        <td>{{ $shift->patient_group }}</td>
                        @if(auth()->user()->hasRole(['admin', 'Supervisor']))
                            <td>
                                <a href="{{ route('shifts.edit', $shift->role) }}" class="btn btn-sm btn-warning">Edit</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

