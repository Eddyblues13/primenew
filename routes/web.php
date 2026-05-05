<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDepositController;
use App\Http\Controllers\Admin\AdminDepositMethodController;
use App\Http\Controllers\Admin\AdminInvestmentController;
use App\Http\Controllers\Admin\AdminKycController;
use App\Http\Controllers\Admin\AdminManageController;
use App\Http\Controllers\Admin\AdminPlanController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminWithdrawalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\KycController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\WithdrawalController;
use App\Models\InvestmentPlan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $teslaPlans = InvestmentPlan::where('type', 'tesla')->get();
    $cryptoPlans = InvestmentPlan::where('type', 'crypto')->get();

    return view('welcome', compact('teslaPlans', 'cryptoPlans'));
})->name('home');

Route::get('/products', [FrontendController::class, 'products'])->name('frontend.products');
Route::get('/features', [FrontendController::class, 'features'])->name('frontend.features');
Route::get('/markets', [FrontendController::class, 'markets'])->name('frontend.markets');
Route::get('/learn', [FrontendController::class, 'learn'])->name('frontend.learn');
Route::get('/company', [FrontendController::class, 'company'])->name('frontend.company');
Route::get('/blog/{slug?}', [FrontendController::class, 'blogArticle'])->name('frontend.blog.article');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('user')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/deposits', [DepositController::class, 'index'])->name('deposits.index');
    Route::get('/deposits/{method}', [DepositController::class, 'show'])->name('deposits.show');
    Route::post('/deposits/{method}', [DepositController::class, 'store'])->name('deposits.store');

    Route::get('/investments/tesla', [InvestmentController::class, 'tesla'])->name('investments.tesla');
    Route::get('/investments/crypto', [InvestmentController::class, 'crypto'])->name('investments.crypto');
    Route::get('/investments/history', [InvestmentController::class, 'history'])->name('investments.history');
    Route::post('/investments/{plan}', [InvestmentController::class, 'store'])->name('investments.store');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::post('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');

    Route::get('/withdrawals', [WithdrawalController::class, 'index'])->name('withdrawals.index');
    Route::post('/withdrawals', [WithdrawalController::class, 'store'])->name('withdrawals.store');
    Route::get('/withdrawals/history', [WithdrawalController::class, 'history'])->name('withdrawals.history');

    Route::get('/kyc', [KycController::class, 'index'])->name('kyc.index');
    Route::post('/kyc', [KycController::class, 'store'])->name('kyc.store');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
        Route::post('/users/{user}/balance', [AdminUserController::class, 'updateBalance'])->name('users.balance');
        Route::post('/users/{user}/profit', [AdminUserController::class, 'updateProfit'])->name('users.profit');
        Route::post('/users/{user}/login-as', [AdminUserController::class, 'loginAs'])->name('users.loginAs');
        Route::post('/users/{user}/mail', [AdminUserController::class, 'sendMail'])->name('users.mail');
        
        // KYC Routes
        Route::get('/kyc', [AdminKycController::class, 'index'])->name('kyc.index');
        Route::get('/kyc/{kyc}', [AdminKycController::class, 'show'])->name('kyc.show');
        Route::post('/kyc/{kyc}/approve', [AdminKycController::class, 'approve'])->name('kyc.approve');
        Route::post('/kyc/{kyc}/reject', [AdminKycController::class, 'reject'])->name('kyc.reject');

        Route::get('/deposits', [AdminDepositController::class, 'index'])->name('deposits.index');

        // Deposit Methods CRUD
        Route::get('/deposit-methods', [AdminDepositMethodController::class, 'index'])->name('deposit-methods.index');
        Route::post('/deposit-methods', [AdminDepositMethodController::class, 'store'])->name('deposit-methods.store');
        Route::put('/deposit-methods/{depositMethod}', [AdminDepositMethodController::class, 'update'])->name('deposit-methods.update');
        Route::delete('/deposit-methods/{depositMethod}', [AdminDepositMethodController::class, 'destroy'])->name('deposit-methods.destroy');
        Route::get('/withdrawals', [AdminWithdrawalController::class, 'index'])->name('withdrawals.index');
        Route::get('/investments', [AdminInvestmentController::class, 'index'])->name('investments.index');

        // Investment Plans CRUD
        Route::get('/plans', [AdminPlanController::class, 'index'])->name('plans.index');
        Route::post('/plans', [AdminPlanController::class, 'store'])->name('plans.store');
        Route::put('/plans/{plan}', [AdminPlanController::class, 'update'])->name('plans.update');
        Route::delete('/plans/{plan}', [AdminPlanController::class, 'destroy'])->name('plans.destroy');

        // Manage Admins
        Route::get('/admins', [AdminManageController::class, 'index'])->name('admins.index');
        Route::post('/admins', [AdminManageController::class, 'store'])->name('admins.store');
        Route::delete('/admins/{admin}', [AdminManageController::class, 'destroy'])->name('admins.destroy');

        // Send Mail (broadcast)
        Route::get('/sendmail', [AdminSettingsController::class, 'sendMailForm'])->name('sendmail');
        Route::post('/sendmail', [AdminSettingsController::class, 'sendMail'])->name('sendmail.send');

        // Settings
        Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings');
        Route::post('/settings/profile', [AdminSettingsController::class, 'updateProfile'])->name('settings.profile');
        Route::post('/settings/password', [AdminSettingsController::class, 'updatePassword'])->name('settings.password');
    });
});
