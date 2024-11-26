<?php


    use App\Http\Controllers\Auth\RegisteredUserController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\AdminAccountController;
    use App\Http\Controllers\Supervisor\SupervisorHomeController;
    use App\Http\Controllers\Doctor\DoctorHomeController;
    use App\Http\Controllers\Caregiver\CaregiverHomeController;
    use App\Http\Controllers\Patient\PatientController;
    use App\Http\Controllers\AdminRolesController;
    use App\Http\Controllers\ShiftController;
    use App\Http\Controllers\AppointmentController;

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/unauthorized', function () {
        return view('unauthorized');
    })->name('unauthorized');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Route::middleware('auth')->group(function () {
    //     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // });

    // Admin Account Routes
    Route::middleware(['auth', 'role:1'])->group(function () {
        Route::get('/admin/home', [AdminAccountController::class, 'adminHome'])->name('adminHome');
        Route::get('/admin/roles', [AdminRolesController::class, 'index'])->name('adminRoles');
        Route::post('/admin/store', [AdminRolesController::class, 'store'])->name('admin.store');
        Route::post('/admin/submitSalary/{id}', [AdminAccountController::class, 'submitSalary'])->name('admin.submitSalary');    
    });

    // Supervisor Routes
    Route::middleware(['auth', 'role:2'])->group(function () {
        Route::get('/supervisor/home', [SupervisorHomeController::class, 'supervisorHome'])->name('supervisorHome');
    });

    // Doctor Routes
    Route::middleware(['auth', 'role:3'])->group(function () {
        Route::get('/doctor/home', [DoctorHomeController::class, 'doctorHome'])->name('doctorHome');
    });

    // Caregiver Routes
    Route::middleware(['auth', 'role:4'])->group(function () {
        Route::get('/caregiver/home/{id}', [CaregiverHomeController::class, 'showCaregiverHome'])->name('caregiverHome');
        Route::post('/caregiver/schedule/save', [CaregiverHomeController::class, 'savePatientSchedule'])->name('caregiver.saveSchedule');
    });


    // Patient Routes
    Route::middleware(['auth', 'role:5'])->group(function () {
        Route::get('/patient/home/{id}', [PatientController::class, 'patientHome'])->name('patientHome');
    });

    // Roster related routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/shifts/index', [ShiftController::class, 'index'])->name('shifts.index');
        Route::post('/shifts/store', [ShiftController::class, 'store'])->name('shifts.store');
        Route::get('/shifts/{id}/edit', [ShiftController::class, 'edit'])->name('shifts.edit');
    });

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);






    // Roster creation and management routes for specific roles
    Route::middleware(['auth', 'role:1, 2'])->group(function () {
        //account approval
        Route::get('/admin/pending_accounts', [AdminAccountController::class, 'index'])->name('admin.pending');
        Route::post('/admin/approve/{id}', [AdminAccountController::class, 'approve'])->name('admin.approve');
        Route::post('/admin/deny/{id}', [AdminAccountController::class, 'deny'])->name('admin.deny');

        //shifts
        Route::get('/shifts/create', [ShiftController::class, 'create'])->name('shifts.create');
        Route::get('/shifts', [ShiftController::class, 'index'])->name('shifts.index');//probably dont need this here -serena
        Route::post('/shifts', [ShiftController::class, 'store'])->name('shifts.store');
        Route::get('/shifts/{id}/edit', [ShiftController::class, 'edit'])->name('shifts.edit');
        Route::put('/shifts/{id}', [ShiftController::class, 'update'])->name('shifts.update');
        
        //List of Patient/addditionalifo and employees/salary. Accessable to both admin/supervisor (supervisor cant change salary however) -serena
        Route::get('/additionalInfo/{id}', [PatientController::class, 'patientDetails'])->name('additionalInfo');
        Route::post('/additionalInfo/{id}', [PatientController::class, 'updatingDetails'])->name('updatingDetails');
        Route::get('/list', [AdminAccountController::class, 'adminList'])->name('adminList');

        //appointments
        Route::get('/appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');
        Route::post('/appointment/store', [AppointmentController::class, 'store'])->name('appointment.store');
        Route::get('/patients/{id}', [AppointmentController::class, 'getPatient']);
        Route::get('/doctors/scheduled/{date}', [AppointmentController::class, 'getScheduledDoctors']);

    });

    Route::get('/roster', [ShiftController::class, 'roster'])->name('roster');
    

    Route::get('/shifts', [ShiftController::class, 'index'])->name('shifts.index');


    require __DIR__.'/auth.php';