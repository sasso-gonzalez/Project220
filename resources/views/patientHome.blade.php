@extends('layouts.app')
@include('layouts.navigation')

@section('content')
<div class="container">
    <h1>Welcome, {{ $user->first_name }}</h1>
    <p>This is the Patient Dashboard.</p>
    <table>
        <tr>
            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
        </tr>
    </table>
</div>
@endsection
