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

<br><br><br><br><br>

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
                            <form action=" route('admin.submitSalary', ['id' => $employee->id]) " method="POST">
                                @csrf
                                <div>
                                    <input type="number" id="salary" value="{{ $user->employee->salary }}" name="salary" required><button type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </td> 
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection