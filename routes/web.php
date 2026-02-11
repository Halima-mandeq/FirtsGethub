<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\DB;

// Dashboard-ka weyn - Waxaan u bixinnay magaca 'dashboard'
Route::get('/', function () {
    $studentCount = DB::table('students')->count();
    $teacherCount = DB::table('teachers')->count();
    $courseCount = DB::table('courses')->count();
    $enrollmentCount = DB::table('enrollments')->count();
    $attendanceCount = DB::table('attendances')->count();

    return view('dashboard', compact(
        'studentCount', 
        'teacherCount', 
        'courseCount', 
        'enrollmentCount', 
        'attendanceCount'
    ));
})->name('dashboard');

// CRUD-yada (Resource Routes)
Route::resource('students', StudentController::class);
Route::resource('teachers', TeacherController::class);
Route::resource('courses', CourseController::class);
Route::resource('enrollments', EnrollmentController::class);
Route::resource('attendances', AttendanceController::class);

// Login/Logout Routes (Si badhanka Logout uusan error u bixin)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');