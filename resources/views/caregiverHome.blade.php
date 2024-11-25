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
            <form method="GET" action="{{ route('caregiverHome') }}"> 
                @csrf
                <button type="submit">{{ __('Home') }}</button>
            </form>

        </div>
    </div>
    <div class="container">
    <h1>Caregiver's Home</h1>
    <p>This page is accessed by the caregiver who logged in.</p>

    <!-- List of Patients Duty Button -->
    <!-- <a href=" route('patients.duty') " class="btn btn-primary mb-3">List of Patients duty today</a> -->

    <!-- Table of Medications and Meals -->
    <table class="table table-bordered">
        <thead class="bg-light">
            <tr>
                <th>Name</th>
                <th>Morning Medicine</th>
                <th>Afternoon Medicine</th>
                <th>Night Medicine</th>
                <th>Breakfast</th>
                <th>Lunch</th>
                <th>Dinner</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through patients -->
            <!-- foreach ($patients as $patient) -->
            <tr>
                <!-- <td> $patient->name </td> -->
                <td>
                    <!-- <input type="checkbox" name="morning_medicine[ $patient->id }}]" value="1" /> -->
                </td>
                <td>
                    <!-- <input type="checkbox" name="afternoon_medicine[ $patient->id }}]" value="1" /> -->
                </td>
                <td>
                    <!-- <input type="checkbox" name="night_medicine[ $patient->id }}]" value="1" /> -->
                </td>
                <td>
                    <!-- <input type="checkbox" name="breakfast[ $patient->id }}]" value="1" /> -->
                </td>
                <td>
                    <!-- <input type="checkbox" name="lunch[ $patient->id }}]" value="1" /> -->
                </td>
                <td>
                    <!-- <input type="checkbox" name="dinner[ $patient->id }}]" value="1" /> -->
                </td>
            </tr>
            <!-- endforeach -->
        </tbody>
    </table>

    <!-- Submit and Cancel Buttons -->
    <div class="d-flex justify-content-end mt-3">
        <button class="btn btn-success me-2" type="submit">Ok</button>
        <button class="btn btn-secondary" type="button" onclick="window.location.href='{{ url()->previous() }}'">Cancel</button>
    </div>
</div>
@endsection
