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
    <h1>Welcome, Doctor!</h1>
    <p>This is the Doctor Dashboard.</p>
    <br><br><br>    <!-- <form method="GET" action=""> -->
        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" class="" type="text" name="first_name" :value="old('first_name')" required autofocus />

            <x-input-label for="date">Date:</x-input-label>
            <input type="date" name="date" id="date" value="{{ request('date') }}">

            <x-input-label for="comment">Comment:</x-input-label>
            <input type="text" name="comment" id="comment" value="{{ request('comment') }}">
            

            <x-input-label for="morning_med">Morning Med:</x-input-label>
            <input type="text" name="morning_med" id="morning_med" value="{{ request('morning_med') }}">

            <x-input-label for="afternoon_med">Afternoon Med:</x-input-label>
            <input type="text" name="afternoon_med" id="afternoon_med" value="{{ request('afternoon_med') }}">

            <x-input-label for="night_med">Night Med:</x-input-label>
            <input type="text" name="night_med" id="night_med" value="{{ request('night_med') }}">

            <button type="submit">
            {{ __('Search') }}
            </button>
        </div>
        </div>
    <!-- </form> -->
</div>


@endsection