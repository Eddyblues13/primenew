<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    $teslaPlans = \App\Models\InvestmentPlan::where('type', 'tesla')->get();
    $cryptoPlans = \App\Models\InvestmentPlan::where('type', 'crypto')->get();
    return view('welcome', compact('teslaPlans', 'cryptoPlans'));
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/deposits', [\App\Http\Controllers\DepositController::class, 'index'])->name('deposits.index');
    Route::get('/deposits/{method}', [\App\Http\Controllers\DepositController::class, 'show'])->name('deposits.show');
    Route::post('/deposits/{method}', [\App\Http\Controllers\DepositController::class, 'store'])->name('deposits.store');

    Route::get('/investments/tesla', [\App\Http\Controllers\InvestmentController::class, 'tesla'])->name('investments.tesla');
    Route::get('/investments/crypto', [\App\Http\Controllers\InvestmentController::class, 'crypto'])->name('investments.crypto');
    Route::get('/investments/history', [\App\Http\Controllers\InvestmentController::class, 'history'])->name('investments.history');
    Route::post('/investments/{plan}', [\App\Http\Controllers\InvestmentController::class, 'store'])->name('investments.store');

    Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/profile', [\App\Http\Controllers\SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::post('/settings/password', [\App\Http\Controllers\SettingsController::class, 'updatePassword'])->name('settings.password');

    Route::get('/withdrawals', [\App\Http\Controllers\WithdrawalController::class, 'index'])->name('withdrawals.index');
    Route::post('/withdrawals', [\App\Http\Controllers\WithdrawalController::class, 'store'])->name('withdrawals.store');
    Route::get('/withdrawals/history', [\App\Http\Controllers\WithdrawalController::class, 'history'])->name('withdrawals.history');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Admin\AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Admin\AdminAuthController::class, 'login']);
    Route::post('/logout', [\App\Http\Controllers\Admin\AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/users', [\App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [\App\Http\Controllers\Admin\AdminUserController::class, 'show'])->name('users.show');
        Route::delete('/users/{user}', [\App\Http\Controllers\Admin\AdminUserController::class, 'destroy'])->name('users.destroy');
        Route::post('/users/{user}/balance', [\App\Http\Controllers\Admin\AdminUserController::class, 'updateBalance'])->name('users.balance');
        Route::post('/users/{user}/login-as', [\App\Http\Controllers\Admin\AdminUserController::class, 'loginAs'])->name('users.loginAs');
        Route::post('/users/{user}/mail', [\App\Http\Controllers\Admin\AdminUserController::class, 'sendMail'])->name('users.mail');
        Route::get('/deposits', [\App\Http\Controllers\Admin\AdminDepositController::class, 'index'])->name('deposits.index');
        Route::get('/withdrawals', [\App\Http\Controllers\Admin\AdminWithdrawalController::class, 'index'])->name('withdrawals.index');
        Route::get('/investments', [\App\Http\Controllers\Admin\AdminInvestmentController::class, 'index'])->name('investments.index');

        // Investment Plans CRUD
        Route::get('/plans', [\App\Http\Controllers\Admin\AdminPlanController::class, 'index'])->name('plans.index');
        Route::post('/plans', [\App\Http\Controllers\Admin\AdminPlanController::class, 'store'])->name('plans.store');
        Route::put('/plans/{plan}', [\App\Http\Controllers\Admin\AdminPlanController::class, 'update'])->name('plans.update');
        Route::delete('/plans/{plan}', [\App\Http\Controllers\Admin\AdminPlanController::class, 'destroy'])->name('plans.destroy');

        // Manage Admins
        Route::get('/admins', [\App\Http\Controllers\Admin\AdminManageController::class, 'index'])->name('admins.index');
        Route::post('/admins', [\App\Http\Controllers\Admin\AdminManageController::class, 'store'])->name('admins.store');
        Route::delete('/admins/{admin}', [\App\Http\Controllers\Admin\AdminManageController::class, 'destroy'])->name('admins.destroy');

        // Send Mail (broadcast)
        Route::get('/sendmail', [\App\Http\Controllers\Admin\AdminSettingsController::class, 'sendMailForm'])->name('sendmail');
        Route::post('/sendmail', [\App\Http\Controllers\Admin\AdminSettingsController::class, 'sendMail'])->name('sendmail.send');

        // Settings
        Route::get('/settings', [\App\Http\Controllers\Admin\AdminSettingsController::class, 'index'])->name('settings');
        Route::post('/settings/profile', [\App\Http\Controllers\Admin\AdminSettingsController::class, 'updateProfile'])->name('settings.profile');
        Route::post('/settings/password', [\App\Http\Controllers\Admin\AdminSettingsController::class, 'updatePassword'])->name('settings.password');
    });
});
