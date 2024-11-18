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


        </div>
    </div>
    <div class="container">
        <h1>Welcome, Admin!</h1>
        <p>This is the Admin Dashboard.</p>

        <!-- Success/Error messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
@endsection


                        