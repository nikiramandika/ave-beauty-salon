<?php

use App\Http\Controllers\CashierController;
use App\Http\Controllers\CategoryController;
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

//owner-users
Route::get('/users-owner', [UserController::class, 'index'])->name('users.index');
// Route untuk menampilkan form edit
Route::get('/users-owner/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
// Route untuk proses update
Route::put('/users-owner/{id}', [UserController::class, 'update'])->name('users.update');
// Route untuk menghapus
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

//owner-member
Route::get('/members-owner', [MemberController::class, 'index'])->name('members.index');
// Route untuk menampilkan form edit
Route::get('/members-owner/{id}/edit', [MemberController::class, 'edit'])->name('members.edit');
// Route untuk proses update
Route::put('/members-owner/{id}', [MemberController::class, 'update'])->name('members.update');
// Route untuk menghapus
Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('members.destroy');

//owner-cashier
Route::get('/cashiers-owner', [CashierController::class, 'index'])->name('cashiers.index');
// Route untuk menampilkan form edit
Route::get('/cashiers-owner/{id}/edit', [CashierController::class, 'edit'])->name('cashiers.edit');
// Route untuk proses update
Route::put('/cashiers-owner/{id}', [CashierController::class, 'update'])->name('cashiers.update');
// Route untuk menghapus
Route::delete('/cashiers/{id}', [CashierController::class, 'destroy'])->name('cashiers.destroy');

// Route untuk menampilkan daftar kategori
Route::get('/categories-owner', [CategoryController::class, 'index'])->name('categories.index');
// Route untuk menampilkan form create kategori
Route::get('/categories-owner/create', [CategoryController::class, 'create'])->name('categories.create');
// Route untuk menyimpan kategori baru
Route::post('/categories-owner', [CategoryController::class, 'store'])->name('categories.store');
// Route untuk menampilkan form edit
Route::get('categories-owner/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
// Route untuk proses update
Route::put('/categories-owner/{id}', [CategoryController::class, 'update'])->name('categories.update');
// Route untuk menghapus kategori
Route::delete('/categories-owner/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
