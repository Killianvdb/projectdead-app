<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;


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
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user/{id}', [Usercontroller::class, 'show'])->name('user.show');
    Route::get('/user/{id}/promote', [Usercontroller::class, 'promoteToAdmin'])->name('user.promote');
    Route::get('/user/{id}/demote', [Usercontroller::class, 'demoteFromAdmin'])->name('user.demote');

});
Route::middleware('auth','auth.admin')->group(function () {
  
Route::get('profile/admin', [AdminController::class, 'index'])->name('profile.admin');
    
});

Route::get('/about', function () {
    return view('Profile/about');
})->name('about');

require __DIR__.'/auth.php';
