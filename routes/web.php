<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin/auth/login');
});

Route::get('/', [AuthController::class, 'login'])->name('admin_login');
Route::get('/admin/register', [AuthController::class, 'register'])->name('admin_register');
Route::post('/admin/register', [AuthController::class, 'registerAdmin'])->name('register_admin');
Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('login_admin');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin_logout');

//ADMIN MIDDLWARE
Route::middleware([AdminAuth::class])->group(function(){
    //dashboard
    Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin_dashboard');

    //School Year
    Route::get('/admin/manage/schoolyear', [SchoolYearController::class, 'schoolyear'])->name('manage_schoolyear');

    //OFFICER
    Route::get('/admin/manage/officer', [AuthController::class, 'officer'])->name('manage_officer');
    Route::post('/admin/manage/officer/create', [AuthController::class, 'createOfficer'])->name('create_officer');
    Route::get('/officer/edit/{user}', [AuthController::class, 'editOfficer'])->name('edit_officer');
    Route::get('/officer/show{user}', [AuthController::class, 'showOfficer'])->name('officer_show');
    Route::put('/officer/update/{user}', [AuthController::class, 'updateOfficer'])->name('update_officer');
    Route::delete('/officer/delete/{user}', [AuthController::class, 'deleteOfficer'])->name('delete_officer');
    Route::get('/officer/profile/{user}', [OfficerController::class, 'officerProfile'])->name('officer_profile');
    Route::get('/admin/manage/admin', [AuthController::class, 'adminPage'])->name('admin_page');

    //Event Management
    Route::get('/admin/manage/event', [EventController::class, 'event'])->name('manage_event');
    Route::post('/admin/manage/event/create', [EventController::class, 'createEvent'])->name('create_event');
    Route::get('/event/show/{event_id}', [EventController::class, 'showEvent'])->name('event_show');
    Route::get('/event/assign-officer/{event_id}', [EventController::class, 'showAssignOfficerForm'])->name('assign_officer_form');
    Route::post('/event/assigning-officer/{event_id}', [EventController::class, 'assignOfficer'])->name('assign_officer_store');
});


//Student Officer Side
// Route::get('/login', [OfficerController::class, 'officerLogin'])->name('officer_login');