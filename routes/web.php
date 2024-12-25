<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\CustomerBoatController;
use App\Http\Controllers\Auth\AuthenticationController;

Route::get('/', [AuthenticationController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthenticationController::class, 'showSignupForm'])->name('register');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login_post');
Route::post('/register/post', [AuthenticationController::class, 'RegisterPost'])->name('register_post');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
Route::get('/tasks-export', [TaskController::class, 'export'])->name('tasks.export');
Route::post('/tasks-import', [TaskController::class, 'import'])->name('tasks.import');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/notifications/mark-as-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    });


    Route::get('/tasks/detail/{task}', function (Task $task) {
        return $task->load(['invoices']);
    });

    Route::middleware(['custom.role:Admin,Manager,Customer'])->group(function () {
        Route::resource('customer_boats', CustomerBoatController::class);
    });

    Route::middleware(['custom.role:Admin,Manager'])->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::resource('tasks', TaskController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('financials', FinancialController::class);

    Route::middleware(['role:Worker'])->prefix('worker')->name('worker.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'WorkerDashboard'])->name('dashboard');
        Route::get('/your-tasks', [WorkerController::class, 'YourTasks'])->name('tasks.assign');
        Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');

    });

});
