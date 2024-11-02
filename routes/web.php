<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/users-owner', function () {
//     return view('owner.pages.users');
// });
Route::get('/cashiers-owner', function () {
    return view('owner.pages.cashiers');
});
Route::get('/members-owner', function () {
    return view('owner.pages.members');
});

Route::get('/dashboard-owner', function () {
    return view('owner.index');
});

Route::get('/users-owner', [UserController::class, 'index'])->name('users.index');
// Route untuk menampilkan form edit
Route::get('/users-owner/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
// Route untuk proses update
Route::put('/users-owner/{id}', [UserController::class, 'update'])->name('users.update');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
