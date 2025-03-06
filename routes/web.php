<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendeesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

// Redirect default 'login' route to 'admin_login'
Route::get('/login', function () {
    return redirect()->route('admin_login');
})->name('login');

Route::get('/', [AuthController::class, 'login'])->name('admin_login');
Route::get('/admin/register', [AuthController::class, 'register'])->name('admin_register');
Route::post('/admin/register', [AuthController::class, 'registerAdmin'])->name('register_admin');
Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('login_admin');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin_logout');

//ADMIN MIDDLWARE
Route::middleware(['auth', 'admin'])->group(function(){
    //dashboard
    Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin_dashboard');

    //School Year
    Route::get('/admin/manage/schoolyear', [SchoolYearController::class, 'schoolyear'])->name('manage_schoolyear');
    Route::post('/admin/manage/schoolyear/create', [SchoolYearController::class, 'createSchoolYear'])->name('create_schoolyear');
    Route::get('/schoolyear/show/{schoolyear}', [SchoolYearController::class, 'showSchoolYear'])->name('schoolyear_show');
    Route::get('/schoolyear/edit/{schoolyear}', [SchoolYearController::class, 'editSchoolYear'])->name('edit_schoolyear');
    Route::put('/schoolyear/update/{schoolyear}', [SchoolYearController::class, 'updateSchoolYear'])->name('update_schoolyear');
    Route::patch('/schoolyear/active/{schoolyear}', [SchoolYearController::class, 'toggleActive'])->name('toggle_active');
    
    //OFFICER
    Route::get('/admin/manage/officer', [OfficerController::class, 'officer'])->name('manage_officer');
    Route::post('/admin/manage/officer/create', [OfficerController::class, 'createOfficer'])->name('create_officer');
    Route::get('/officer/edit/{user}', [OfficerController::class, 'editOfficer'])->name('edit_officer');
    Route::get('/officer/show{user}', [OfficerController::class, 'showOfficer'])->name('officer_show');
    Route::put('/officer/update/{user}', [OfficerController::class, 'updateOfficer'])->name('update_officer');
    Route::delete('/officer/delete/{user}', [OfficerController::class, 'deleteOfficer'])->name('delete_officer');
    Route::get('/officer/profile/{user}', [OfficerController::class, 'officerProfile'])->name('officer_profile');

    //AdminController
    Route::get('/admin/manage/admin', [AdminController::class, 'adminPage'])->name('admin_page');
    Route::post('admin/manage/admin/create', [AdminController::class, 'createAdmin'])->name('create_admin');

    //Event Management
    Route::get('/admin/manage/event', [EventController::class, 'event'])->name('manage_event');
    Route::post('/admin/manage/event/create', [EventController::class, 'createEvent'])->name('create_event');
    Route::get('/event/show/{event_id}', [EventController::class, 'showEvent'])->name('event_show');
    Route::get('/event/edit/{event_id}', [EventController::class, 'editEvent'])->name('edit_event');

    //ATTENDEES/STUDENT
    Route::get('/admin/manage/attendees', [AttendeesController::class, 'attendees'])->name('manage_attendees');
    Route::post('/admin/manage/attendees/create', [AttendeesController::class, 'createAttendees'])->name('create_attendees');
    Route::get('/atendees/rollno', [AttendeesController::class, 'displayRollNo'])->name('attendees_rollno');
    Route::get('/generate-qrcode/{rollno}', [QRCodeController::class, 'generateQrCode'])->name('generateQrCode');

    //ATTENDANCE
    Route::get('/admin/manage/attendance', [AttendanceController::class, 'attendance'])->name('manage_attendance');
    Route::post('/admin/attendance/store', [AttendanceController::class, 'storeAttendance'])->name('get_attendance');
});


//Student Officer Side
Route::get('/login', [AuthController::class, 'studentAuthForm'])->name('login');
Route::post('/student-officer/login', [AuthController::class, 'studentOfficerLogin'])->name('student_officer_login');
Route::get('/student-officer/logout', [AuthController::class, 'studentOfficerLogout'])->name('student_officer_logout');
//Student Officer Middleware
Route::middleware(['auth', 'student_officer'])->group(function(){
    Route::get('/student-officer/dashboard', [AuthController::class, 'student_officer_dashboard'])->name('student_officer_dashboard');
});