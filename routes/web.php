<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\VolunteerHourController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PasswordResetOtpController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Models\Opportunity;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root Landing Page
Route::get('/', function () {
    $locale = session('locale', 'ar');

    App::setLocale($locale);

    $featuredOpportunities = Opportunity::query()
        ->where('is_active', true)
        ->latest()
        ->take(3)
        ->get();

    return view('welcome', compact('featuredOpportunities'));
});


// Locale Switcher Route
Route::get('/language/{locale}', function (string $locale) {

    if (! in_array($locale, ['en', 'ar'])) {
        abort(404);
    }

    Session::put('locale', $locale);

    App::setLocale($locale);

    return redirect()->back();

})->name('language.switch');


// Role-Based Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// Reports & Statistics - Admin Only
Route::get('/reports', [ReportController::class, 'index'])
    ->middleware(['auth', 'verified', 'role:Admin'])
    ->name('reports.index');


// Breeze Profile Management
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


// Resource Routes

Route::resource('teams', TeamController::class)
    ->middleware(['auth', 'verified']);

Route::resource('opportunities', OpportunityController::class)
    ->middleware(['auth', 'verified']);

Route::resource('applications', ApplicationController::class)
    ->middleware(['auth', 'verified']);

Route::resource('volunteer-hours', VolunteerHourController::class)
    ->middleware(['auth', 'verified']);

    // Public Certificate Verification
Route::get('/verify-certificate/{certificateCode}', [CertificateController::class, 'verify'])
    ->name('certificates.verify');

Route::resource('certificates', CertificateController::class)
    ->middleware(['auth', 'verified']);

Route::resource('announcements', AnnouncementController::class)
    ->middleware(['auth', 'verified']);

Route::resource('team-members', TeamMemberController::class)
    ->middleware(['auth', 'verified']);


// User Management
// Admin only + recent password confirmation
Route::middleware([
    'auth',
    'verified',
    'password.confirm',
])->group(function () {

    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit');

    Route::patch('/users/{user}', [UserController::class, 'update'])
        ->name('users.update');

});


// Password Reset with OTP
//
// This replaces the default Breeze password-reset flow.
// The OTP system works for Admin, Team Manager,
// and Member accounts.

Route::middleware('guest')->group(function () {

    // Forgot Password - show email form
    Route::get('/forgot-password', [PasswordResetOtpController::class, 'create'])
        ->name('password.request');

    // Generate OTP
    Route::post('/forgot-password', [PasswordResetOtpController::class, 'store'])
        ->name('password.otp.send');

    // Verify OTP page
    Route::get('/verify-otp', [PasswordResetOtpController::class, 'showVerify'])
        ->name('password.otp.verify');

    // Verify OTP
    Route::post('/verify-otp', [PasswordResetOtpController::class, 'verify'])
        ->name('password.otp.check');

    // New password page
    Route::get('/reset-password', [PasswordResetOtpController::class, 'showReset'])
        ->name('password.otp.reset');

    // Update password
    Route::post('/reset-password', [PasswordResetOtpController::class, 'resetPassword'])
        ->name('password.otp.update');

});


// Import Breeze Authentication Routes
require __DIR__.'/auth.php';