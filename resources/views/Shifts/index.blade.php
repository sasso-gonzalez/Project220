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
        @if(auth()->user()->hasRole(['admin', 'Supervisor']))
            <a href="{{ route('shifts.create') }}" class="btn btn-primary">Add Shift</a>
        @endif

        <!-- Date search/filter -->
        <form action="{{ route('shifts.index') }}" method="GET" class="mb-4">
            <div class="form-group">
                <label for="date">Search Shifts by Date:</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <form method="GET" action="{{ route('shifts.index') }}">
            @csrf
            <button type="submit">Show All</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Shift Date</th>
                    <!-- <th>Shift End</th> -->
                    <th>Role</th>
                    <th>Caregroup</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shifts as $shift)
                    <tr>
                        <td>{{ $shift->employee->user->first_name }} {{ $shift->employee->user->last_name }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($shift->shift_start)->format('M d, Y h:i A') }} - 
                            {{ \Carbon\Carbon::parse($shift->shift_end)->format('h:i A') }}
                        </td>
                        <td>{{ $shift->employee->user->role }}</td>
                        <td>{{ $shift->caregroup ?? '' }}</td>
                        <td>
                            @if(auth()->user()->hasRole(['admin', 'Supervisor']))
                                <a href="{{ route('shifts.edit', $shift->id) }}" class="btn btn-secondary">Edit</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection