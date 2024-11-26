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
        // Route::get('/admin/pending_accounts', [AdminAccountController::class, 'index'])->name('admin.pending');
        // Route::post('/admin/approve/{id}', [AdminAccountController::class, 'approve'])->name('admin.approve');
        // Route::post('/admin/deny/{id}', [AdminAccountController::class, 'deny'])->name('admin.deny');
        Route::get('/admin/roles', [AdminRolesController::class, 'index'])->name('adminRoles');
        Route::post('/admin/store', [AdminRolesController::class, 'store'])->name('admin.store');
        // Route::get('/admin/list', [AdminAccountController::class, 'adminList'])->name('adminList');
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
        Route::get('/caregiver/home', [CaregiverHomeController::class, 'caregiverHome'])->name('caregiverHome');
    });

    // Patient Routes
    Route::middleware(['auth', 'role:5'])->group(function () {
        Route::get('/patient/home', [PatientController::class, 'index'])->name('patientHome');
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


    });

    Route::get('/roster', [ShiftController::class, 'roster'])->name('roster');
    

    Route::get('/shifts', [ShiftController::class, 'index'])->name('shifts.index');
    

    require __DIR__.'/auth.php';








// use App\Http\Controllers\Auth\RegisteredUserController;
// use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\AdminAccountController;
// use App\Http\Controllers\Supervisor\SupervisorHomeController;
// use App\Http\Controllers\Doctor\DoctorHomeController;
// use App\Http\Controllers\Caregiver\CaregiverHomeController;
// use App\Http\Controllers\Patient\PatientHomeController;
// use App\Http\Controllers\AdminRolesController;
// use App\Http\Controllers\ShiftController;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/unauthorized', function () {
//     return view('unauthorized');
// })->name('unauthorized');

// Route::get('/dashboard', function () { //do we honestly need either of these?? -serena
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// // Admin Account Routes
// Route::middleware(['auth', 'admin'])->group(function () {
//     //home page
//     Route::get('/admin/home', [AdminAccountController::class, 'adminHome'])->name('adminHome');
//     //pending acounts page
//     Route::get('/admin/pending_accounts', [AdminAccountController::class, 'index'])->name('admin.pending');
//     Route::post('/admin/approve/{id}', [AdminAccountController::class, 'approve'])->name('admin.approve');
//     Route::post('/admin/deny/{id}', [AdminAccountController::class, 'deny'])->name('admin.deny');

//     Route::get('/admin/roles', [AdminRolesController::class, 'index'])->name('adminRoles');
//     Route::post('/admin/store', [AdminRolesController::class, 'store'])->name('admin.store');

//     Route::get('/admin/list', [AdminAccountController::class, 'adminList'])->name('adminList');
//     Route::post('/admin/submit-salary/{id}', [AdminAccountController::class, 'submitSalary'])->name('admin.submitSalary');

    
// });



// // Supervisor Routes
// Route::middleware(['auth', 'supervisor'])->group(function () {
//     // Route::get('/supervisor/home', [SupervisorHomeController::class, 'index'])->name(''); //not working
//     Route::get('/supervisor/home', [SupervisorHomeController::class, 'supervisorHome'])->name('supervisorHome');

// });

// // Doctor Routes
// Route::middleware(['auth', 'Doctor'])->group(function () {
//     // Route::get('/doctor/home', [DoctorHomeController::class, 'index'])->name(''); //not working
//     Route::get('/doctor/home', [DoctorHomeController::class, 'doctorHome'])->name('doctorHome');
//     // Route::get('/doctor/patients', [DoctorHomeController::class, 'patients'])->name('doctor.patients');
//     // Route::get('/doctor/patient/{id}', [DoctorHomeController::class, 'patient'])->name('doctor.name');
//     // Route::get('/doctor/notes/{id}', [DoctorHomeController::class, 'notes'])->name('doctor.notes');
//     // Route::post('/doctor/notes/{id}', [DoctorHomeController::class, 'addNote'])->name('doctor.notes');
//     // Route::get('/doctor/schedule', [DoctorHomeController::class, 'schedule'])->name('doctor.schedule');
// });

// // Caregiver Routes
// Route::middleware(['auth', 'Caregiver'])->group(function () {
//     // Route::get('/cargiver/home', [CaregiverHomeController::class, 'index'])->name(''); //not working
//     Route::get('/caregiver/home', [CaregiverHomeController::class, 'caregiverHome'])->name('caregiverHome');
// });

// // Patient Routes
// Route::middleware(['auth', 'Patient'])->group(function () {
//     // Route::get('/patient/home', [PatientHomeController::class, 'index'])->name(''); //not working
//     Route::get('/patient/home', [PatientHomeController::class, 'patientHome'])->name('patientHome');
// });












// //Role-specific Routes
// Route::middleware(['auth', 'role:Doctor'])->group(function () {
//     Route::get('/doctor/home', [DoctorHomeController::class, 'doctorHome'])->name('doctorHome');
// });

// Route::middleware(['auth', 'role:Supervisor'])->group(function () {
//     Route::get('/supervisor/home', [SupervisorHomeController::class, 'supervisorHome'])->name('supervisorHome');
// });


// Route::middleware(['auth', 'role:Caregiver'])->group(function () {
//     Route::get('/caregiver/home', [CaregiverHomeController::class, 'caregiverHome'])->name('caregiverHome');
// });

// Route::middleware(['auth', 'role:Patient'])->group(function () {
//     Route::get('/patient/home', [PatientHomeController::class, 'patientHome'])->name('patientHome');
// });

// // Route::middleware(['auth', 'role:Admin'])->group(function () {
// //     Route::get('/admin/home', [AdminHomeController::class, 'adminHome'])->name('adminHome');
// // });

// //Roster related routes
// Route::middleware(['auth'])->group(function () {
//     Route::get('/shifts/index', [ShiftController::class, 'index'])->name('shifts.index');
//     Route::post('/shifts/store', [ShiftController::class, 'store'])->name('shifts.store');
//     Route::get('/shifts/{id}/edit', [ShiftController::class, 'edit'])->name('shifts.edit');

// });

// Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
// Route::post('/register', [RegisteredUserController::class, 'store']);


// // Roster stuff
// Route::middleware(['auth', 'role:admin,Supervisor'])->group(function () {
//     Route::get('/shifts/create', [ShiftController::class, 'create'])->name('shifts.create');
//     Route::get('/shifts', [ShiftController::class, 'index'])->name('shifts.index');
//     Route::post('/shifts', [ShiftController::class, 'store'])->name('shifts.store');
//     Route::get('/shifts/{id}/edit', [ShiftController::class, 'edit'])->name('shifts.edit');
//     Route::put('/shifts/{id}', [ShiftController::class, 'update'])->name('shifts.update');
// });

// Route::get('/shifts', [ShiftController::class, 'index'])->name('shifts.index');


// require __DIR__.'/auth.php';
