<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AssignHomeroomTeacherController;

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

// Authentication routes
Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'logout']);

// Password reset routes
Route::get('forgot-password', [AuthController::class, 'forgotpassword'])->name('forgot-password');
Route::post('forgot-password-act', [AuthController::class, 'forgot_password_act'])->name('forgot-password-act');
Route::get('reset/{token}', [AuthController::class, 'reset'])->name('reset');
Route::post('reset/{token}', [AuthController::class, 'PostReset'])->name('PostReset');

// Admin routes
Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);


    // Edit Profile
    Route::prefix('admin')->group(function () {
        Route::get('account', [UserController::class, 'MyAccount']);
        Route::post('account', [UserController::class, 'UpdateMyAccountAdmin']);
    });

    // Admin Management
    Route::prefix('admin/admin')->group(function () {
        Route::get('list', [AdminController::class, 'list']);
        Route::get('add', [AdminController::class, 'add']);
        Route::post('add', [AdminController::class, 'insert']);
        Route::get('edit/{id}', [AdminController::class, 'edit']);
        Route::post('edit/{id}', [AdminController::class, 'update']);
        Route::get('delete/{id}', [AdminController::class, 'delete']);
    });

    // Teacher Management
    Route::prefix('admin/teacher')->group(function () {
        Route::get('list', [TeacherController::class, 'list']);
        Route::get('add', [TeacherController::class, 'add']);
        Route::post('add', [TeacherController::class, 'insert']);
        Route::get('edit/{id}', [TeacherController::class, 'edit']);
        Route::post('edit/{id}', [TeacherController::class, 'update']);
        Route::get('delete/{id}', [TeacherController::class, 'delete']);
    });

    // Student Management
    Route::prefix('admin/student')->group(function () {
        Route::get('list', [StudentController::class, 'list']);
        Route::get('add', [StudentController::class, 'add']);
        Route::post('add', [StudentController::class, 'insert']);
        Route::get('edit/{id}', [StudentController::class, 'edit']);
        Route::post('edit/{id}', [StudentController::class, 'update']);
        Route::get('delete/{id}', [StudentController::class, 'delete']);
    });

    // Class Management
    Route::prefix('admin/class')->group(function () {
        Route::get('list', [ClassController::class, 'list']);
        Route::get('add', [ClassController::class, 'add']);
        Route::post('add', [ClassController::class, 'insert']);
        Route::get('edit/{id}', [ClassController::class, 'edit']);
        Route::post('edit/{id}', [ClassController::class, 'update']);
        Route::get('delete/{id}', [ClassController::class, 'delete']);
    });

    // Assign Homeroom Teacher
    Route::prefix('admin/assign_homeroom_teacher')->group(function () {
        Route::get('list', [AssignHomeroomTeacherController::class, 'list']);
        Route::get('add', [AssignHomeroomTeacherController::class, 'add']);
        Route::post('add', [AssignHomeroomTeacherController::class, 'insert']);
        Route::get('edit/{id}', [AssignHomeroomTeacherController::class, 'edit']);
        Route::post('edit/{id}', [AssignHomeroomTeacherController::class, 'update']);
        Route::get('delete/{id}', [AssignHomeroomTeacherController::class, 'delete']);
    });

    // Change Password
    Route::get('admin/change_password', [UserController::class, 'change_password']);
    Route::post('admin/change_password', [UserController::class, 'update_change_password']);
});

// Teacher routes
Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);

    // Change Password
    Route::get('teacher/change_password', [UserController::class, 'change_password']);
    Route::post('teacher/change_password', [UserController::class, 'update_change_password']);

    // Edit Profile
    Route::get('teacher/account', [UserController::class, 'MyAccount']);
    Route::post('teacher/account', [UserController::class, 'UpdateMyAccount']);

    // My Student
    Route::get('teacher/my_student', [StudentController::class, 'MyStudent']);
});

// Student routes
Route::group(['middleware' => 'student'], function () {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);

    // Change Password
    Route::get('student/change_password', [UserController::class, 'change_password']);
    Route::post('student/change_password', [UserController::class, 'update_change_password']);
});
