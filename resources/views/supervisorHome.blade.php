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

        </div>
    </div>
    <div class="container">
        <h1>Welcome, Supervisor!</h1>
        <p>This is the Supervisor Dashboard.</p>
    </div>
@endsection
