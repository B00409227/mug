<?php

// Import necessary controller classes
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MugController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\AdminMugController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminMerchantController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home page route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Protected routes for authenticated users
Route::middleware(['auth'])->group(function () {
    // Shopping cart related routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{mug}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

// Admin routes - requires both authentication and admin role
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Admin dashboard and resource management routes
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('users', AdminUserController::class);        // CRUD for users
    Route::resource('merchants', AdminMerchantController::class); // CRUD for merchants
    Route::resource('mugs', AdminMugController::class);          // CRUD for mugs
});

// Merchant routes - requires both authentication and merchant role
Route::middleware(['auth', 'merchant'])->prefix('merchant')->name('merchant.')->group(function () {
    // Merchant dashboard and mug management
    Route::get('/dashboard', [MerchantController::class, 'dashboard'])->name('dashboard');
    Route::resource('mugs', MugController::class);              // CRUD for merchant's mugs
});

// Public routes for viewing mugs
Route::get('/mugs', [MugController::class, 'index'])->name('mugs.index');
Route::get('/mugs/{mug}', [MugController::class, 'show'])->name('mugs.show');

// User profile routes
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Include authentication routes from separate file
require __DIR__.'/auth.php';
