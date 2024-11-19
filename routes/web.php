<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\Supervisor\SupervisorHomeController;
use App\Http\Controllers\Doctor\DoctorHomeController;
use App\Http\Controllers\Caregiver\CaregiverHomeController;
use App\Http\Controllers\Patient\PatientHomeController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () { //do we honestly need either of these?? -serena
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Account Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/pending_accounts', [AdminAccountController::class, 'index'])->name('admin.pending');
    Route::post('/admin/approve/{id}', [AdminAccountController::class, 'approve'])->name('admin.approve');
    Route::post('/admin/deny/{id}', [AdminAccountController::class, 'deny'])->name('admin.deny');
    Route::get('/admin/home', [AdminAccountController::class, 'adminHome'])->name('adminHome');
});

// Supervisor Routes
Route::middleware(['auth', 'supervisor'])->group(function () {
    // Route::get('/supervisor/home', [SupervisorHomeController::class, 'index'])->name(''); //not working
    Route::get('/supervisor/home', [SupervisorHomeController::class, 'supervisorHome'])->name('supervisorHome');

});

// Doctor Routes
Route::middleware(['auth', 'Doctor'])->group(function () {
    // Route::get('/doctor/home', [DoctorHomeController::class, 'index'])->name(''); //not working
    Route::get('/doctor/home', [DoctorHomeController::class, 'doctorHome'])->name('doctorHome');
    // Route::get('/doctor/patients', [DoctorHomeController::class, 'patients'])->name('doctor.patients');
    // Route::get('/doctor/patient/{id}', [DoctorHomeController::class, 'patient'])->name('doctor.name');
    // Route::get('/doctor/notes/{id}', [DoctorHomeController::class, 'notes'])->name('doctor.notes');
    // Route::post('/doctor/notes/{id}', [DoctorHomeController::class, 'addNote'])->name('doctor.notes');
    // Route::get('/doctor/schedule', [DoctorHomeController::class, 'schedule'])->name('doctor.schedule');
});

// Caregiver Routes
Route::middleware(['auth', 'Caregiver'])->group(function () {
    // Route::get('/cargiver/home', [CaregiverHomeController::class, 'index'])->name(''); //not working
    Route::get('/caregiver/home', [CaregiverHomeController::class, 'caregiverHome'])->name('caregiverHome');
});

// Patient Routes
Route::middleware(['auth', 'Patient'])->group(function () {
    // Route::get('/patient/home', [PatientHomeController::class, 'index'])->name(''); //not working
    Route::get('/patient/home', [PatientHomeController::class, 'patientHome'])->name('patientHome');
});












// Role-specific Routes
Route::middleware(['auth', 'role:Doctor'])->group(function () {
    Route::get('/doctor/home', [DoctorHomeController::class, 'doctorHome'])->name('doctorHome');
});

Route::middleware(['auth', 'role:Supervisor'])->group(function () {
    Route::get('/supervisor/home', [SupervisorHomeController::class, 'supervisorHome'])->name('supervisorHome');
});


Route::middleware(['auth', 'role:Caregiver'])->group(function () {
    Route::get('/caregiver/home', [CaregiverHomeController::class, 'caregiverHome'])->name('caregiverHome');
});

Route::middleware(['auth', 'role:Patient'])->group(function () {
    Route::get('/patient/home', [PatientHomeController::class, 'patientHome'])->name('patientHome');
});




Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);


require __DIR__.'/auth.php';



// use App\Http\Controllers\Auth\RegisteredUserController;
// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\AdminHomeController; //Supposed to be homeController??????
// use App\Http\Controllers\DoctorController;
// use App\Http\Controllers\PatientController;
// use App\Http\Controllers\CaregiverController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


// // Admin Account Routes //XD
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin/pending-accounts', [AdminAccountController::class, 'index'])->name('admin.pending');
//     Route::post('/admin/approve/{id}', [AdminAccountController::class, 'approve'])->name('admin.approve');
//     Route::post('/admin/deny/{id}', [AdminAccountController::class, 'deny'])->name('admin.deny');
// });

// Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
// Route::post('/register', [RegisteredUserController::class, 'store']);

// // Admin Route
// Route::middleware('auth')->group(function () {
//     Route::get('/admin/home', [AdminHomeController::class, 'adminHome'])->name('adminHome'); 
// });

// // Doctor Route
// Route::middleware('auth')->group(function () {
//     Route::get('/doctor/home', [DoctorController::class, 'doctorHome'])->name('doctorHome');
// });

// // Patient Route
// Route::middleware('auth')->group(function () {
//     Route::get('/patient/home', [PatientController::class, 'patientHome'])->name('patientHome');
// });

// // Caregiver Route
// Route::middleware('auth')->group(function () {
//     Route::get('/caregiver/home', [CaregiverController::class, 'caregiverHome'])->name('caregiverHome');
// });

// // Supervisor Route
// Route::middleware('auth')->group(function () {
//     Route::get('/supervisor/home', [SupervisorController::class, 'supervisorHome'])->name('supervisorHome');
// });



// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/home', [AdminHomeController::class, 'adminHome'])->name('adminHome');
// });

// Route::middleware(['auth', 'role:doctor'])->group(function () {
//     Route::get('/doctor/home', [DoctorController::class, 'doctorHome'])->name('doctorHome');
// });

// Route::middleware(['auth', 'role:patient'])->group(function () {
//     Route::get('/patient/home', [PatientController::class, 'patientHome'])->name('patientHome');
// });

// Route::middleware(['auth', 'role:caregiver'])->group(function () {
//     Route::get('/caregiver/home', [CaregiverController::class, 'caregiverHome'])->name('caregiverHome');
// });


// require __DIR__.'/auth.php';
