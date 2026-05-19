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

    // Fetch live news from CoinTelegraph RSS feed (Free, no rate limits)
    $liveNews = Illuminate\Support\Facades\Cache::remember('homepage_live_news_rss', 3600, function () {
        try {
            $rssContent = @file_get_contents('https://cointelegraph.com/rss');
            if ($rssContent) {
                $xml = simplexml_load_string($rssContent);
                $news = [];
                if ($xml && isset($xml->channel->item)) {
                    $items = $xml->channel->item;
                    $count = 0;
                    foreach ($items as $item) {
                        if ($count >= 6) break;
                        
                        $image = '';
                        $namespaces = $xml->getNamespaces(true);
                        if (isset($namespaces['media'])) {
                            $media = $item->children($namespaces['media']);
                            if (isset($media->content)) {
                                foreach ($media->content->attributes() as $k => $v) {
                                    if ($k == 'url') $image = (string)$v;
                                }
                            }
                        }
                        
                        if (empty($image) && isset($item->enclosure)) {
                            foreach ($item->enclosure->attributes() as $k => $v) {
                                if ($k == 'url') $image = (string)$v;
                            }
                        }

                        $news[] = [
                            'title' => (string)$item->title,
                            'url' => (string)$item->link,
                            'source_info' => ['name' => 'CoinTelegraph'],
                            'published_on' => strtotime((string)$item->pubDate),
                            'imageurl' => $image,
                            'body' => strip_tags((string)$item->description)
                        ];
                        $count++;
                    }
                    return $news;
                }
            }
        } catch (\Exception $e) {
            // Silently fail and return empty array if RSS is down
        }
        return [];
    });

    // Populate Featured Cars from public/cars/cars directory
    $featuredCars = [];
    $carFolders = [1, 2, 3, 4, 5, 7];
    $carNames = [
        1 => 'Tesla Model S Plaid',
        2 => 'Tesla Model 3 Performance',
        3 => 'Tesla Model X Long Range',
        4 => 'Tesla Model Y Dual Motor',
        5 => 'Cybertruck Tri-Motor',
        7 => 'Tesla Roadster SpaceX'
    ];
    $carSpecs = [
        1 => ['range' => 396, 'zero_to_sixty' => 1.99, 'top_speed' => 200, 'price' => 89990],
        2 => ['range' => 315, 'zero_to_sixty' => 3.1, 'top_speed' => 162, 'price' => 50990],
        3 => ['range' => 348, 'zero_to_sixty' => 3.8, 'top_speed' => 149, 'price' => 98490],
        4 => ['range' => 330, 'zero_to_sixty' => 4.8, 'top_speed' => 135, 'price' => 47990],
        5 => ['range' => 500, 'zero_to_sixty' => 2.9, 'top_speed' => 130, 'price' => 69900],
        7 => ['range' => 620, 'zero_to_sixty' => 1.9, 'top_speed' => 250, 'price' => 200000]
    ];

    foreach ($carFolders as $folder) {
        $path = public_path("cars/cars/{$folder}");
        $image = 'images/logo.png';
        if (file_exists($path)) {
            $files = array_values(array_filter(scandir($path), function($f) {
                return !in_array($f, ['.', '..']);
            }));
            if (!empty($files)) {
                $image = "cars/cars/{$folder}/" . $files[0];
            }
        }
        
        $featuredCars[] = new class($carNames[$folder], $carSpecs[$folder], $image) {
            public $name;
            public $range_miles;
            public $zero_to_sixty;
            public $top_speed_mph;
            public $price;
            private $image;

            public function __construct($name, $specs, $image) {
                $this->name = $name;
                $this->range_miles = $specs['range'];
                $this->zero_to_sixty = $specs['zero_to_sixty'];
                $this->top_speed_mph = $specs['top_speed'];
                $this->price = $specs['price'];
                $this->image = $image;
            }

            public function getPrimaryImage() {
                return $this->image;
            }
        };
    }

    return view('welcome', compact('teslaPlans', 'cryptoPlans', 'liveNews', 'featuredCars'));
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
        Route::post('/users/{user}/bonus', [AdminUserController::class, 'updateBonus'])->name('users.bonus');
        Route::post('/users/{user}/amounts', [AdminUserController::class, 'updateAmounts'])->name('users.amounts');

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
