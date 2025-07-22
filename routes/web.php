<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Redirect user to their appropriate dashboard after login
Route::get('/redirect', function () {
    return ''; // Middleware handles the redirect logic
})->middleware(['auth', 'checkrole']);

// Admin Dashboard (only accessible by admins)
Route::get('/admin/dashboard', function () {
    return 'Welcome Admin';
})->middleware(['auth', 'ensurerole:admin'])->name('admin.dashboard');

// Organizer Dashboard
Route::get('/organizer/dashboard', function () {
    return 'Welcome Organizer';
})->middleware(['auth', 'ensurerole:organizer'])->name('organizer.dashboard');

// Customer Dashboard
Route::get('/customer/dashboard', function () {
    return 'Welcome Customer';
})->middleware(['auth', 'ensurerole:customer'])->name('customer.dashboard');


//this route group protects all event routes so only logged-in organizers can access them.
Route::middleware(['auth', 'role:organizer'])->group(function () {
    Route::resource('events', EventController::class);
});

require __DIR__.'/auth.php';
