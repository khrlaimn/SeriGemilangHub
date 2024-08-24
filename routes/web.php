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
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CommunicateController;
use App\Http\Controllers\TeacherWhereaboutsController;
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

// Homepage
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'login']);
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
        Route::get('list', [AssignHomeroomTeacherController::class, 'list'])->name('admin.assign_homeroom_teacher.list');
        Route::get('add', [AssignHomeroomTeacherController::class, 'add'])->name('admin.assign_homeroom_teacher.add');
        Route::post('add', [AssignHomeroomTeacherController::class, 'insert'])->name('admin.assign_homeroom_teacher.insert');
        Route::get('edit/{id}', [AssignHomeroomTeacherController::class, 'edit'])->name('admin.assign_homeroom_teacher.edit');
        Route::put('edit/{id}', [AssignHomeroomTeacherController::class, 'update'])->name('admin.assign_homeroom_teacher.update');
        Route::get('delete/{id}', [AssignHomeroomTeacherController::class, 'delete'])->name('admin.assign_homeroom_teacher.delete');
    });


    // Student Attendance
    Route::prefix('admin/attendance')->group(function () {
        Route::get('student', [AttendanceController::class, 'AttendanceStudent'])->name('attendance.student');
        Route::post('student/save', [AttendanceController::class, 'AttendanceStudentSubmit'])->name('attendance.student.save');
        Route::get('report', [AttendanceController::class, 'AttendanceReport'])->name('attendance.report');
        Route::post('report_export_excel', [AttendanceController::class, 'AttendanceReportExportExcel'])->name('attendance.report_export_excel');
    });

    // Teacher Whereabouts
    Route::prefix('admin/whereabouts')->group(function () {
        Route::get('list', [TeacherWhereaboutsController::class, 'list']);
        // Route::get('add', [TeacherWhereaboutsController::class, 'add']);
        Route::post('add', [TeacherWhereaboutsController::class, 'insert']);
        Route::get('edit/{id}', [TeacherWhereaboutsController::class, 'editByAdmin']);
        Route::post('edit/{id}', [TeacherWhereaboutsController::class, 'updateByAdmin']);
        Route::get('delete/{id}', [TeacherWhereaboutsController::class, 'delete']);
    });


    // Communicate
    Route::prefix('admin/communicate/notice_board')->group(function () {
        Route::get('', [CommunicateController::class, 'NoticeBoard']);
        Route::get('add', [CommunicateController::class, 'AddNoticeBoard']);
        Route::post('add', [CommunicateController::class, 'InsertNoticeBoard']);
        Route::get('edit/{id}', [CommunicateController::class, 'EditNoticeBoard']);
        Route::post('edit/{id}', [CommunicateController::class, 'UpdateNoticeBoard']);
        Route::get('delete/{id}', [CommunicateController::class, 'DeleteNoticeBoard']);
    });

    // Change Password
    Route::get('admin/change_password', [UserController::class, 'change_password']);
    Route::post('admin/change_password', [UserController::class, 'update_change_password']);
});

// Teacher routes
Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('teacher/attendance-chart-data', [AttendanceController::class, 'getAttendanceChartData']);

    //  Student Attendance
    Route::middleware(['auth'])->prefix('teacher/attendance')->group(function () {
        Route::get('student', [AttendanceController::class, 'AttendanceStudentTeacher'])->name('teacher.attendance.student');
        Route::post('student/save', [AttendanceController::class, 'TeacherAttendanceStudentSubmit'])->name('teacher.attendance.student.save');
        Route::get('report', [AttendanceController::class, 'AttendanceReportTeacher'])->name('teacher.attendance.report');
        Route::post('report_export_excel', [AttendanceController::class, 'AttendanceReportExportExcel'])->name('attendance.report_export_excel');
    });

    // Teacher Whereabouts
    Route::prefix('teacher/whereabouts')->group(function () {
        Route::get('list', [TeacherWhereaboutsController::class, 'getTeacherWhereaboutsByUser'])->name('teacher.whereabouts.list');
        Route::get('add', [TeacherWhereaboutsController::class, 'add'])->name('teacher.whereabouts.add');
        Route::post('add', [TeacherWhereaboutsController::class, 'insert'])->name('teacher.whereabouts.insert');
        Route::get('edit/{id}', [TeacherWhereaboutsController::class, 'edit'])->name('teacher.whereabouts.edit');
        Route::put('edit/{id}', [TeacherWhereaboutsController::class, 'update'])->name('teacher.whereabouts.update'); // Changed to PUT
        Route::delete('delete/{id}', [TeacherWhereaboutsController::class, 'delete'])->name('teacher.whereabouts.delete'); // Changed to DELETE
    });

    // Change Password
    Route::get('teacher/change_password', [UserController::class, 'change_password']);
    Route::post('teacher/change_password', [UserController::class, 'update_change_password']);

    // Edit Profile
    Route::get('teacher/account', [UserController::class, 'MyAccount']);
    Route::post('teacher/account', [UserController::class, 'UpdateMyAccount']);

    // My Student
    Route::get('teacher/my_student', [StudentController::class, 'MyStudent'])->name('teacher.my_student');
    Route::get('teacher/my_student_details/{id}', [StudentController::class, 'MyStudentDetails'])->name('teacher.my_student_details');


    // Communicate
    Route::get('teacher/my_notice_board', [CommunicateController::class, 'MyNoticeBoardTeacher']);
});

//Headmaster routes
Route::group(['middleware' => 'headmaster'], function () {
    Route::get('headmaster/dashboard', [DashboardController::class, 'dashboard']);

    // Teacher Whereabouts
    Route::prefix('headmaster/whereabouts')->group(function () {
        Route::get('list', [TeacherWhereaboutsController::class, 'listHeadmaster']);
        Route::get('edit/{id}', [TeacherWhereaboutsController::class, 'editByHeadmaster']);
        Route::post('edit/{id}', [TeacherWhereaboutsController::class, 'updateByHeadmaster']);
        Route::get('delete/{id}', [TeacherWhereaboutsController::class, 'delete']);
    });

    // Communicate
    Route::get('headmaster/my_notice_board', [CommunicateController::class, 'NoticeBoardHeadmaster']);

    // Edit Profile
    Route::get('headmaster/account', [UserController::class, 'MyAccount']);
    Route::post('headmaster/account', [UserController::class, 'UpdateMyAccount']);

    // Change Password
    Route::get('headmaster/change_password', [UserController::class, 'change_password']);
    Route::post('headmaster/change_password', [UserController::class, 'update_change_password']);
});

//STAD Routes
Route::group(['middleware' => 'stad'], function () {
    Route::get('stad/dashboard', [DashboardController::class, 'dashboard']);

    // Student Attendance
    Route::prefix('stad')->group(function () {
        Route::get('attendance_report', [AttendanceController::class, 'StadAttendanceReport'])->name('attendance.report');
        Route::post('report_export_excel', [AttendanceController::class, 'AttendanceReportExportExcel'])->name('attendance.report_export_excel');
    });

    // Communicate
    Route::get('stad/my_notice_board', [CommunicateController::class, 'NoticeBoardStad']);

    // Edit Profile
    Route::get('stad/account', [UserController::class, 'MyAccount']);
    Route::post('stad/account', [UserController::class, 'UpdateMyAccount']);

    // Change Password
    Route::get('stad/change_password', [UserController::class, 'change_password']);
    Route::post('stad/change_password', [UserController::class, 'update_change_password']);
});

// Student routes
// Route::group(['middleware' => 'student'], function () {
//     Route::get('student/dashboard', [DashboardController::class, 'dashboard']);

//     // Change Password
//     Route::get('student/change_password', [UserController::class, 'change_password']);
//     Route::post('student/change_password', [UserController::class, 'update_change_password']);
// });
