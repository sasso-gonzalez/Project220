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
<div class="container mt-5">
        <h1>Role Management</h1>
        <p>This page is accessed by Admin only.</p>

        <table class="table">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Access Level</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->role }}</td>
                        <td>{{ $role->access_level }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    <h1>Role Management</h1>
    <p>This page is accessed by Admin only.</p>
    
    <form method="GET" class="mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Access Level</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->role }}</td>
                        <td>{{ $role->access_level }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary">Edit</a>
                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>

<div>
    <thead>
        <tr>
            <th>Role</th>
            <th>Access Level</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td>{{ $role->role }}</td>
                <td>{{ $role->access_level }}</td>
            </tr>
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <x-input-label for="role_name" class="form-label">New Role</x-input-label>
                <input type="text" id="role_name" name="role_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="access_level" class="form-label">Access Level</label>
                <input type="text" id="access_level" name="access_level" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">OK</button>
            <button type="reset" class="btn btn-danger">Cancel</button>
        </form>
    </tbody>
</div>
