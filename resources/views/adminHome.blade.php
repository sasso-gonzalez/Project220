@extends('layouts.app')
@include('layouts.navigation')
<br><br><br><br><b><br><br><br><br>

@section('content') 
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


                        