<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\GymNewsController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\BlogController;



Route::get('/locale/{locale}', [LocaleController::class, 'setLocale'])->name('locale.set');


Route::get('/', function () {
    return view('welcome');
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Құпия сөзді қалпына келтіру
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware('auth')->group(function () {


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  
    Route::middleware('permission:view workouts')->group(function () {
        Route::get('/workouts', [WorkoutController::class, 'index'])->name('workouts.index');
    });

    Route::middleware('permission:create workouts')->group(function () {
        Route::get('/workouts/create', [WorkoutController::class, 'create'])->name('workouts.create');
        Route::post('/workouts', [WorkoutController::class, 'store'])->name('workouts.store');
    });

    Route::middleware('permission:edit workouts')->group(function () {
        Route::get('/workouts/{id}/edit', [WorkoutController::class, 'edit'])->name('workouts.edit');
        Route::patch('/workouts/{id}', [WorkoutController::class, 'update'])->name('workouts.update');
    });

    Route::middleware('permission:delete workouts')->group(function () {
        Route::delete('/workouts/{id}', [WorkoutController::class, 'destroy'])->name('workouts.destroy');
    });

    
    Route::middleware('permission:view gym-news')->group(function () {
        Route::get('/gym-news', [GymNewsController::class, 'index'])->name('gym-news.index');
    });

    Route::middleware('permission:create gym-news')->group(function () {
        Route::get('/gym-news/create', [GymNewsController::class, 'create'])->name('gym-news.create');
        Route::post('/gym-news', [GymNewsController::class, 'store'])->name('gym-news.store');
    });

    Route::middleware('permission:edit gym-news')->group(function () {
        Route::get('/gym-news/{id}/edit', [GymNewsController::class, 'edit'])->name('gym-news.edit');
        Route::patch('/gym-news/{id}', [GymNewsController::class, 'update'])->name('gym-news.update');
    });

    Route::middleware('permission:delete gym-news')->group(function () {
        Route::delete('/gym-news/{id}', [GymNewsController::class, 'destroy'])->name('gym-news.destroy');
    });

    // ===== Admin Panel — тек admin және super-admin =====
    Route::middleware('role:admin|super-admin')->group(function () {
        Route::get('/admin/panel', [DashboardController::class, 'adminPanel'])->name('admin.panel');
    });

    // ===== Пайдаланушыларды басқару — тек super-admin =====
    Route::middleware('permission:manage users')->group(function () {
        Route::delete('/admin/users/{id}', [DashboardController::class, 'destroyUser'])->name('admin.users.destroy');
        Route::patch('/admin/users/{id}/role', [DashboardController::class, 'updateUserRole'])->name('admin.users.role');
    });

    // ===== Аналитика — рұқсат бойынша =====
    Route::middleware('permission:view analytics')->group(function () {
        Route::get('/admin/analytics', [DashboardController::class, 'analytics'])->name('admin.analytics');
    });

    // ===== Файлды жүктеу (File Upload) — тек белгілі рөлдерге =====
    Route::middleware('role:super-admin|admin|moderator')->group(function () {
        Route::get('/upload', [UploadFileController::class, 'index'])->name('upload.index');
        Route::post('/upload', [UploadFileController::class, 'store'])->name('upload.store');
    });

    // ===== Пошта жіберу (Email Sending) =====
    Route::get('/send-email', [MailController::class, 'sendEmail'])->name('email.send');

    // ===== Блог (Admin CRUD) =====
    Route::middleware('role:admin|super-admin')->group(function () {
        Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
        Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
        Route::patch('/blog/{id}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('/blog/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
    });
});

// ===== Блог (Public) =====
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

