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
use App\Http\Controllers\AdminPasswordResetController;
use App\Http\Controllers\Auth\PasswordResetOtpController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Models\Opportunity;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


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


// Reports & Statistics - Admin, Super Admin & Demo Admin (View Only)
Route::get('/reports', [ReportController::class, 'index'])
    ->middleware(['auth', 'verified', 'role:Super Admin|Admin|Demo Admin'])
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
Route::get(
    '/verify-certificate/{certificateCode}',
    [CertificateController::class, 'verify']
)->name('certificates.verify');

Route::resource('certificates', CertificateController::class)
    ->middleware(['auth', 'verified']);

Route::resource('announcements', AnnouncementController::class)
    ->middleware(['auth', 'verified']);

Route::resource('team-members', TeamMemberController::class)
    ->middleware(['auth', 'verified']);


// User Management - View Only (Includes Demo Admin)
Route::middleware([
    'auth',
    'verified',
    'role:Super Admin|Admin|Demo Admin',
])->group(function () {

    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');

});


// User Management - Create & Edit Actions (Super Admin & Admin Only + Password Confirmation)
Route::middleware([
    'auth',
    'verified',
    'role:Super Admin|Admin',
    'password.confirm',
])->group(function () {

    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create');

    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit');

    Route::patch('/users/{user}', [UserController::class, 'update'])
        ->name('users.update');

});


// ========================================================================
// Admin Password Reset Requests - View Only for Demo Admin
// ========================================================================
Route::middleware([
    'auth',
    'verified',
    'role:Super Admin|Admin|Demo Admin',
])->group(function () {

    // View pending password reset requests (Demo Admin can view)
    Route::get(
        '/admin/password-reset-requests',
        [AdminPasswordResetController::class, 'index']
    )->name('admin.password-reset-requests.index');

});


// ========================================================================
// Admin Password Reset Requests - Actions (Super Admin & Admin Only)
// ========================================================================
Route::middleware([
    'auth',
    'verified',
    'role:Super Admin|Admin',
])->group(function () {

    // Approve password reset request
    Route::post(
        '/admin/password-reset-requests/{passwordResetRequest}/approve',
        [AdminPasswordResetController::class, 'approve']
    )->name('admin.password-reset-requests.approve');

    // Reject password reset request
    Route::post(
        '/admin/password-reset-requests/{passwordResetRequest}/reject',
        [AdminPasswordResetController::class, 'reject']
    )->name('admin.password-reset-requests.reject');

});


// ========================================================================
// Password Recovery
// ========================================================================
//
// Demo Member:
//     Forgot Password → Visible Demo OTP
//
// Other accounts:
//     Forgot Password → Admin Approval Request
//

Route::middleware('guest')->group(function () {

    // Forgot Password - show email form
    Route::get(
        '/forgot-password',
        [PasswordResetOtpController::class, 'create']
    )->name('password.request');

    // Password recovery request
    Route::post(
        '/forgot-password',
        [PasswordResetOtpController::class, 'store']
    )->name('password.otp.send');

    // Demo Member OTP verification page
    Route::get(
        '/verify-otp',
        [PasswordResetOtpController::class, 'showVerify']
    )->name('password.otp.verify');

    // Verify Demo Member OTP
    Route::post(
        '/verify-otp',
        [PasswordResetOtpController::class, 'verify']
    )->name('password.otp.check');

    // Demo Member new password page
    Route::get(
        '/reset-password',
        [PasswordResetOtpController::class, 'showReset']
    )->name('password.otp.reset');

    // Demo Member update password
    Route::post(
        '/reset-password',
        [PasswordResetOtpController::class, 'resetPassword']
    )->name('password.otp.update');

});


// ========================================================================
// Temporary Setup Route (قم بحذف هذا المسار بعد الدخول إليه لمرة واحدة فقط)
// ========================================================================
Route::get('/setup-demo-accounts', function () {
    // 1. التأكد من إنشاء الأدوار الأساسية إن لم تكن موجودة
    $roles = ['Super Admin', 'Admin', 'Demo Admin', 'Team Manager', 'Member'];
    foreach ($roles as $roleName) {
        Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
    }

    // 2. ترقية حساب الأدمن الرئيسي إلى Super Admin
    $superAdmin = User::where('email', 'admin@volunteams.com')->first();
    if ($superAdmin) {
        $superAdmin->syncRoles(['Super Admin']);
    }

    // 3. إنشاء حساب المعاينة الإدارية (Demo Admin)
    $demoAdmin = User::updateOrCreate(
        ['email' => 'demo.admin@volunteams.com'],
        [
            'name' => 'Demo Admin',
            'password' => Hash::make('DemoAdmin@2026'),
            'email_verified_at' => now(),
            'is_demo_member' => true,
        ]
    );
    $demoAdmin->syncRoles(['Demo Admin']);

    // 4. إنشاء حساب المسؤول الإداري (Admin / Dean)
    $deanAdmin = User::updateOrCreate(
        ['email' => 'dean.admin@volunteams.com'],
        [
            'name' => 'Dean Admin',
            'password' => Hash::make('DeanAdmin@2026'),
            'email_verified_at' => now(),
            'is_demo_member' => true,
        ]
    );
    $deanAdmin->syncRoles(['Admin']);

    // 5. إنشاء حساب مدير فريق تطوعي (Team Manager)
    $demoManager = User::updateOrCreate(
        ['email' => 'demo.manager@volunteams.com'],
        [
            'name' => 'Demo Team Manager',
            'password' => Hash::make('DemoManager@2026'),
            'email_verified_at' => now(),
            'is_demo_member' => true,
        ]
    );
    $demoManager->syncRoles(['Team Manager']);

    // 6. إنشاء حساب طالب متطوع (Member)
    $demoMember = User::updateOrCreate(
        ['email' => 'demo.member@volunteams.com'],
        [
            'name' => 'Demo Member',
            'password' => Hash::make('DemoMember@2026'),
            'email_verified_at' => now(),
            'is_demo_member' => true,
        ]
    );
    $demoMember->syncRoles(['Member']);

    return "تم إنشاء وتحديث كافة الحسابات والأدوار المطلوبة للعمادة بنجاح تام! يمكنك الآن تسجيل الدخول بالبيانات الموجودة في البطاقة.";
});


// Import Breeze Authentication Routes
require __DIR__.'/auth.php';