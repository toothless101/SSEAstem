<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin/login', [AuthController::class, 'login'])->name('admin_login');
Route::get('/admin/register', [AuthController::class, 'register'])->name('admin_register');
Route::post('/admin/register', [AuthController::class, 'registerAdmin'])->name('register_admin');
Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('login_admin');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin_logout');
//dashboard
Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin_dashboard');

//OFFICER
Route::get('/admin/manage/officer', [AuthController::class, 'officer'])->name('manage_officer');
Route::post('/admin/manage/officer/create', [AuthController::class, 'createOfficer'])->name('create_officer');
Route::get('officer/{user}/show', [AuthController::class, 'showOfficer'])->name('officer_show');
