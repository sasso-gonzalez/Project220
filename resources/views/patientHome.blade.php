@extends('layouts.app')
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
            <form method="GET" action="{{ route('patientHome') }}"> 
                @csrf
                <button type="submit">{{ __('Home') }}</button>
            </form>

        </div>
    </div>

@section('content')
<div class="container">
    <h1>Welcome, Patient!</h1>
    <p>This is the Patient Dashboard.</p>
</div>
@endsection
