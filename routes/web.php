<?php

use App\Http\Controllers\CashierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\TreatmentController;
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

Route::get('/home', function () {
    return view('user.pages.home');
});
Route::get('/shop', function () {
    return view('user.pages.shop');
});
Route::get('/treatment', function () {
    return view('user.pages.treatment');
});
Route::get('/user.pages.home', function () {
    return view('user.pages.home');
});
Route::get('/about', function () {
    return view('user.pages.about');
});
Route::get('/sign-up', function () {
    return view('user.pages.signup');
});
Route::get('/sign-in', function () {
    return view('user.pages.signin');
});
Route::get('/checkout', function () {
    return view('user.pages.checkout');
});
Route::get('/verification', function () {
    return view('user.pages.verif-email');
});




Route::get('/products', [ProductController::class, 'userIndex'])->name('user.pages.products');
Route::get('/products/{product_slug}', [ProductController::class, 'showProduct'])->name('products.show');


Route::get('/treatment', [TreatmentController::class, 'showTreatments'])->name('user.pages.treatment');
Route::get('/treatment/{treatment_slug}', [TreatmentController::class, 'showTreatment'])->name('treatment.show');

Route::get('/course', [CourseController::class, 'userIndex'])->name('user.pages.course');
Route::get('/course/{course_slug}', [CourseController::class, 'showCourse'])->name('course.show');
Route::post('/course-registrations', [CourseRegistrationController::class, 'store'])->name('course-registrations.store');

Route::get('/promo', [PromoController::class, 'showPromos'])->name('user.pages.promo');
Route::get('/promo/{promo_slug}', [PromoController::class, 'showPromo'])->name('promo.show');


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

//owner-product
Route::get('/products-owner', [ProductController::class, 'index'])->name('products.index');
// Route untuk menampilkan form create products
Route::get('/products-owner/create', [ProductController::class, 'create'])->name('products.create');
// Route untuk menyimpan Products
Route::post('/products-owner', [ProductController::class, 'store'])->name('products.store');
// Route untuk menampilkan form edit
Route::get('/products-owner/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Route untuk proses update
Route::put('/products-owner/{id}', [ProductController::class, 'update'])->name('products.update');
// Route untuk menghapus
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

//owner-treatment
Route::get('/treatments-owner', [TreatmentController::class, 'index'])->name('treatments.index');
// Route untuk menampilkan form create treatments
Route::get('/treatments-owner/create', [TreatmentController::class, 'create'])->name('treatments.create');
// Route untuk menyimpan treatments
Route::post('/treatments-owner', [TreatmentController::class, 'store'])->name('treatments.store');
// Route untuk menampilkan form edit
Route::get('/treatments-owner/{id}/edit', [TreatmentController::class, 'edit'])->name('treatments.edit');
// Route untuk proses update
Route::put('/treatments-owner/{id}', [TreatmentController::class, 'update'])->name('treatments.update');
// Route untuk menghapus
Route::delete('/treatments/{id}', [TreatmentController::class, 'destroy'])->name('treatments.destroy');

//owner-course
Route::get('/courses-owner', [CourseController::class, 'index'])->name('courses.index');
// Route untuk menampilkan form create courses
Route::get('/courses-owner/create', [CourseController::class, 'create'])->name('courses.create');
// Route untuk menyimpan courses
Route::post('/courses-owner', [CourseController::class, 'store'])->name('courses.store');
// Route untuk menampilkan form edit
Route::get('/courses-owner/{course_id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
// Route untuk proses update
Route::put('/courses-owner/{course_id}', [CourseController::class, 'update'])->name('courses.update');
// Route untuk menghapus
Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');

//owner-promo
Route::get('/promos-owner', [PromoController::class, 'index'])->name('promos.index');
// Route untuk menampilkan form create promos
Route::get('/promos-owner/create', [PromoController::class, 'create'])->name('promos.create');
// Route untuk menyimpan promos
Route::post('/promos-owner', [PromoController::class, 'store'])->name('promos.store');
// Route untuk menampilkan form edit
Route::get('/promos-owner/{promo_id}/edit', [PromoController::class, 'edit'])->name('promos.edit');
// Route untuk proses update
Route::put('/promos-owner/{promo_id}', [PromoController::class, 'update'])->name('promos.update');
// Route untuk menghapus
Route::delete('/promos/{id}', [PromoController::class, 'destroy'])->name('promos.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
