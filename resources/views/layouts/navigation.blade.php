
<link rel="stylesheet" href="{{ asset('CSS/app.css') }}">



<div class="navbar">
    <div class="navbar_items">

    <nav>
    <ul>
        @if(Auth::check())
            @php
                $user = Auth::user();
                $role = \App\Models\Role::where('role', $user->role)->first();
                $access = $role->access_level;
            @endphp

            <!-- admin Links (access_level 1) -->
            @if($access === 1)
                <li><a href="{{ route('adminHome') }}">Admin Home</a></li>
                <li><a href="{{ route('adminRoles') }}">Manage Roles</a></li>
                <li><a href="{{ route('admin.payment.show') }}">Patient Payment</a></li>

            @endif

            <!-- Supervisor Links (access_level 2) -->
            @if($access == 2)
                <li><a href="{{ route('supervisorHome') }}">Supervisor Home</a></li>
            @endif

            <!-- Doctor Links (access_level 3) -->
            @if($access == 3)
                <li><a href="{{ route('doctorHome') }}">Doctor Home</a></li>
                <li><a href="{{ route('shifts.index') }}">Roster</a></li>
            @endif

            <!-- Caregiver Links (access_level 4) -->
            @if($access == 4)
                <li><a href="{{ route('caregiverHome', ['id' => $user->id]) }}">Caregiver Home</a></li>
                <li><a href="{{ route('shifts.index') }}">Roster</a></li>
            @endif

            <!-- Patient Links (access_level 5) -->
            @if($access == 5)
                <li><a href="{{ route('patientHome', ['id' => $user->id]) }}">Patient Home</a></li>
                <li><a href="{{ route('shifts.index') }}">Roster</a></li>
            @endif

            <!-- family Member Links (access_level 6) -->
            @if($access == 6)
                <li><a href="{{ route('familyHome', ['id' => $user->id]) }}">Home</a></li>
            @endif

            <!-- access for admins and Supervisors -->
            @if(in_array($access, [1, 2]))
                <li><a href="{{ route('admin.pending') }}">Accounts Status</a></li>
                <li><a href="{{ route('shifts.index') }}">Roster</a></li>
                <li><a href="{{ route('adminList') }}">Employee & Patient List</a></li>
                <li><a href="{{ route('appointment.create') }}">Schedule Doctor's Appointment</a></li>
                <li><a href="{{ route('admin.report') }}">Reports</a></li>

            @endif
        @endif
    </ul>
</nav>

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









