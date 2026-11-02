<?php
// routing

use App\Http\Controllers\UserController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\SubscriptionPackageController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
// use App\Models\SubscriptionPackage;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     $subscriptionPackages = SubscriptionPackage::all();

//     return view('home', compact('subscriptionPackages'));
// })->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/search', [UserController::class, 'search'])->name('search');
Route::get('/category/{bookCategory}', [UserController::class, 'category'])->name('category');

// Kelommpok route yang gaboleh di akses kalau udah login
Route::middleware(['IsGuest'])->group(function() {
    Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [UserController::class, 'register'])->name('register.store');

Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.store');

});


// kelompok route yang boleh diakses hanya setelah melakukan login
Route::middleware(['IsLoggedIn'])->group(function() {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});


Route::middleware(['IsAdmin'])->group(function() {
    Route::prefix('admin')->name('admin.')->group(function() {
        Route::get('/dashboard', function() {
            return view('admin.dashboard');
        })->name('dashboard');

        // Route::resources artinya sudah menyediakan semua method yang di perlukan (CRUD)
        Route::resource('book-categories', BookCategoryController::class);
        Route::resource('subscription-packages', SubscriptionPackageController::class);
        Route::resource('books', BookController::class);
    });
});