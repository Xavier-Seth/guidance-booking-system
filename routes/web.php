<?php

use App\Http\Controllers\Student\AppointmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    return redirect()->to(
        $role === 'counselor' ? '/counselor-dashboard' : '/student-dashboard'
    );
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Student-only routes
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student-dashboard', fn() => view('dashboard-student'))->name('student-dashboard');
    Route::get('/appointments/status', [AppointmentController::class, 'index'])->name('appointments.status');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
});

// ✅ Counselor-only routes
Route::middleware(['auth', 'role:counselor'])->group(function () {
    Route::get('/counselor-dashboard', fn() => view('dashboard-counselor'))->name('counselor-dashboard');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/students', [AppointmentController::class, 'index'])->name('students.index');
    Route::post('/appointments/{id}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');

    // ✅ Add calendar route inside here
    Route::get('/calendar/appointments', [CalendarController::class, 'fetchAppointments'])->name('calendar.appointments');
});



require __DIR__ . '/auth.php';
