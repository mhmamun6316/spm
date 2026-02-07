<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\HomeContentController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\GlobalPartnerController;
use App\Http\Controllers\Admin\SatisfiedClientController;
use App\Http\Controllers\Admin\CertificationController;
use Illuminate\Support\Facades\Route;



// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// ============================================
// FRONTEND ROUTES (Public)
// ============================================
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/sustainability', [FrontendController::class, 'sustainability'])->name('sustainability');
Route::get('/ethical-sourcing', [FrontendController::class, 'ethicalSourcing'])->name('ethical-sourcing');
Route::get('/manufacturing-excellence', [FrontendController::class, 'manufacturingExcellence'])->name('manufacturing-excellence');
Route::get('/about/board-of-directors', [FrontendController::class, 'boardOfDirectors'])->name('about.board-of-directors');



Route::get('/category/{slug?}', [FrontendController::class, 'category'])->name('category');
Route::get('/service/{slug}', [FrontendController::class, 'service'])->name('service.show');

// ============================================
// ADMIN ROUTES (Protected)
// ============================================
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // User Management Routes
    Route::resource('users', UserController::class);
    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::post('/users/{user}/approve', [UserController::class, 'approve'])->name('users.approve');
    Route::post('/users/{user}/reject', [UserController::class, 'reject'])->name('users.reject');

    // Role Management Routes
    Route::resource('roles', RoleController::class);

    // Product Category Management Routes
    Route::resource('product-categories', ProductCategoryController::class);
    Route::post('/product-categories/{productCategory}/toggle-status', [ProductCategoryController::class, 'toggleStatus'])->name('product-categories.toggle-status');

    // Product Management Routes
    Route::resource('products', ProductController::class);
    Route::post('/products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');

    // Hero Slider Routes
    Route::resource('hero-sliders', HeroSliderController::class);
    Route::post('/hero-sliders/{heroSlider}/toggle-status', [HeroSliderController::class, 'toggleStatus'])->name('hero-sliders.toggle-status');

    // Text Content Routes
    // Home Content Routes
    Route::resource('home-contents', HomeContentController::class);
    Route::post('/home-contents/{homeContent}/toggle-status', [HomeContentController::class, 'toggleStatus'])->name('home-contents.toggle-status');

    // Page Content Routes (Mission, Values, Footer)
    Route::get('/page-contents/edit', [PageContentController::class, 'edit'])->name('page-contents.edit');
    Route::put('/page-contents', [PageContentController::class, 'update'])->name('page-contents.update');

    // Service Routes
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
    Route::post('/services/{service}/toggle-status', [App\Http\Controllers\Admin\ServiceController::class, 'toggleStatus'])->name('services.toggle-status');

    // Global Partners Routes
    Route::resource('global-partners', GlobalPartnerController::class);
    Route::post('/global-partners/{globalPartner}/toggle-status', [GlobalPartnerController::class, 'toggleStatus'])->name('global-partners.toggle-status');
    
    Route::resource('certifications', CertificationController::class);
    Route::post('/certifications/{certification}/toggle-status', [CertificationController::class, 'toggleStatus'])->name('certifications.toggle-status');

    // Satisfied Clients Routes
    Route::resource('satisfied-clients', SatisfiedClientController::class);
    Route::post('/satisfied-clients/{satisfiedClient}/toggle-status', [SatisfiedClientController::class, 'toggleStatus'])->name('satisfied-clients.toggle-status');

    // Board Members (About Us)
    Route::resource('board-members', App\Http\Controllers\Admin\BoardMemberController::class);
    Route::post('board-members/{boardMember}/toggle-status', [App\Http\Controllers\Admin\BoardMemberController::class, 'toggleStatus'])->name('board-members.toggle-status');

    // Office Locations (Footer)
    Route::resource('office-locations', App\Http\Controllers\Admin\OfficeLocationController::class);
    Route::post('office-locations/{officeLocation}/toggle-status', [App\Http\Controllers\Admin\OfficeLocationController::class, 'toggleStatus'])->name('office-locations.toggle-status');
});
