<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\StudentReportController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Http\Controllers\Teacher\FeedbackController;
use App\Http\Controllers\Admin\QuizManagementController;

Route::get('/', fn() => view('home'))->name('home');
Route::get('/about-us', fn() => view('about-us'))->name('about-us');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout']);

// ─── Authenticated routes (all roles) ─────────────────────────────────────────
Route::middleware(['auth'])->group(function () {
    // Learning modules
    Route::get('/materi', [ModuleController::class, 'publicIndex'])->name('materi');
    Route::get('/materi/{module}', [ModuleController::class, 'publicShow'])->name('materi.show');

    Route::get('/simulasi', fn() => view('simulation'))->name('simulasi');

    // Quizzes (students play)
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');

    // Student report
    Route::get('/report', [StudentReportController::class, 'index'])->name('student.report');
});

// ─── Teacher routes ────────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:teacher,admin'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');
    Route::get('/students/{student}', [TeacherDashboardController::class, 'showStudent'])->name('student.show');
    Route::post('/students/{student}/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::delete('/students/{student}/feedback', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
});

// ─── Admin only routes ─────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('dashboard.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('admin');

    Route::resource('modules', ModuleController::class);

    // Quiz management CRUD
    Route::resource('quizzes', QuizManagementController::class);
    Route::post('quizzes/{quiz}/questions', [QuizManagementController::class, 'storeQuestion'])->name('quizzes.questions.store');
    Route::delete('questions/{question}', [QuizManagementController::class, 'destroyQuestion'])->name('questions.destroy');
});
