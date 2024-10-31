<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Dashboard
Route::middleware(['auth','ceklevel:admin,teknisi'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard', [DashboardController::class, 'AddTask'])->name('AddTask');
    Route::patch('/task/update_status/{id}', [TaskController::class, 'updateStatus'])->name('task.update_status');
    Route::post('/comments/{task}', [CommentController::class, 'store'])->name('comments.store');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    
    Route::get('/edit/{id}', [DashboardController::class, 'loadEditForm'])->name('edit');
    Route::post('/edit/user', [DashboardController::class, 'EditUser'])->name('EditUser');
});

Route::middleware(['auth','ceklevel:admin'])->group(function () {    
    Route::post('/laporan/download-pdf', [LaporanController::class, 'downloadPdf'])->name('download.pdf');

    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan');
    Route::post('/task/approve/{id}', [PengajuanController::class, 'approveTask'])->name('task.approve');
    Route::post('/task/reject/{id}', [PengajuanController::class, 'rejectTask'])->name('task.reject');
    
    Route::get('/tambah', [DashboardController::class, 'tambah'])->name('tambah');
    Route::post('/tambah',[DashboardController::class,'AddUser'])->name('AddUser');
});