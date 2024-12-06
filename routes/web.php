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
use App\Http\Livewire\SearchResult;
use App\Livewire\AboutPage;
use App\Livewire\AccountSettings;
use App\Livewire\ChangePassword;
use App\Livewire\CheckoutCourse;
use App\Livewire\CheckoutPage;
use App\Livewire\CourseDetailPage;
use App\Livewire\CoursePage;
use App\Livewire\DeleteAccount;
use App\Livewire\HistoryCoursePage;
use App\Livewire\HistoryCourseDetailPage;
use App\Livewire\HistoryOrderDetailPage;
use App\Livewire\HistoryOrderPage;
use App\Livewire\HomePage;
use App\Livewire\PaymentPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductPage;
use App\Livewire\PromoDetailPage;
use App\Livewire\PromoPage;
use App\Livewire\SearchPage;
use App\Livewire\SuccessPage;
use App\Livewire\TreatmentDetailPage;
use App\Livewire\TreatmentPage;
// use App\Livewire\SuccessPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use SebastianBergmann\CodeCoverage\Test\TestStatus\Success;
use App\Livewire\SettingsPage;
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/users-owner', function () {
//     return view('owner.pages.users');
// });
Route::middleware(['role:Cashier'])->group(function () {
    Route::get('/cashiers', [CashierController::class, 'cashierProduct'])->name('cashier.index');
    Route::post('/cashier/process', [CashierController::class, 'process'])->name('cashier.process');
    Route::get('/pesanan-online', [CashierController::class, 'pesananOnline'])->name('cashier.pesananOnline');
    Route::get('/member', [CashierController::class, 'member'])->name('cashier.pesananOnline');
    Route::post('/members', [CashierController::class, 'storeMember'])->name('members.store');
    Route::put('/members/{member}', [CashierController::class, 'updateMember'])->name('members.update');
    Route::put('/users/update-phone', [UserController::class, 'updatePhone'])->name('users.updatePhone');

    Route::delete('/members/{member}', [CashierController::class, 'destroyMember'])->name('members.destroy');

    Route::post('/update-order-status', [CashierController::class, 'updateOrderStatus'])->name('updateOrderStatus');
    Route::post('/update-refund-status', [CashierController::class, 'updateRefundStatus'])->name('updateRefundStatus');
    Route::post('/refunds/{refund}/upload', [CashierController::class, 'uploadAdminFile'])->name('refunds.upload');
    Route::post('/process-invoice-cashier', [CashierController::class, 'processInvoiceCashier']);

});




Route::get('/user.pages.home', function () {
    return view('user.pages.home');
});

Route::get('/verification', function () {
    return view('user.pages.verif-email');
});

Route::get('/order-detail', function () {
    return view('user.pages.order-detail');
});

Route::get('/', HomePage::class)->name('home');
Route::get('/products', ProductPage::class);
Route::get('/treatment', TreatmentPage::class);
Route::get('/promo', PromoPage::class);
Route::get('/course', CoursePage::class);
Route::get('/about', AboutPage::class);
Route::get('/search', SearchPage::class)->name('search');

Route::middleware(['role:User'])->group(function () {
    Route::get('/settings', SettingsPage::class)->name('settings');
    Route::get('/settings/account', AccountSettings::class)->name('settings.account');
    Route::get('/settings/change-password', ChangePassword::class)->name('settings.change-password');
    Route::get('/settings/delete-account', DeleteAccount::class)->name('settings.delete-account');
});
// User Livewire
Route::middleware(['role:User', 'verified'])->group(function () {

    Route::get('/products/{product_slug}', ProductDetailPage::class);
    Route::get('/treatment/{treatment_slug}', TreatmentDetailPage::class);
    Route::get('/promo/{promo_slug}', PromoDetailPage::class);
    Route::get('/course/{course_slug}', CourseDetailPage::class);
    Route::get('/checkout', CheckoutPage::class)->name('checkout');
    Route::get('/payment/{invoiceId}', PaymentPage::class)->name('payment.upload');
    Route::get('/checkoutCourse/{course_slug}', CheckoutCourse::class)->name('checkoutCourse');
    Route::get('/success/{invoiceId}', SuccessPage::class)->name('success');
    Route::get('/my-orders', HistoryOrderPage::class)->name('historyOrder');
    Route::get('/my-orders/{invoiceId}', HistoryOrderDetailPage::class)->name('detailInvoice');
    Route::get('/course-history', HistoryCoursePage::class)->name('course.history');
    Route::get('/course-history/{invoiceCode}', HistoryCourseDetailPage::class)->name('detailCourse');


});



Route::middleware(['role:Admin'])->group(function () {
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

    Route::get('/course-registration', [CourseController::class, 'courseRegistration'])->name('course.registration');

    Route::get('/course-registration/{registration_id}', [CourseController::class, 'viewCourseHistory'])->name('course.history.view');
    Route::put('/course-registration/{invoiceId}/update-status', [CourseController::class, 'updateStatus'])->name('invoice.updateStatus');
    Route::put('/course-registration/{registrationId}/update-session-plus', [CourseController::class, 'updateSessionPlus'])->name('course.updateSessionPlus');
    Route::put('/course-registration/{registrationId}/update-session-minus', [CourseController::class, 'updateSessionMinus'])->name('course.updateSessionMinus');
    


});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
