<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MedicineController;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Middleware\CheckAge;
use App\Http\Middleware\Admin;
use App\Http\Controllers\ForumController;


Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/doctors', function () {
    return view('doctors');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines.index');
Route::resource('medicines', MedicineController::class);
Route::get('/create', [MedicineController::class, 'create'])->name('medicines.create');
Route::post('/medicines', [MedicineController::class, 'store'])->name('medicines.store');
Route::get('/medicines/{id}/show', [MedicineController::class, 'show'])->name('medicine.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');

    Route::get('/appointment', function () {
        return view('appointment'); // Return a view
    })->name('appointment');

    Route::get('/padala', function () {
        return view('padala'); // Return a view
    })->name('padala');

    Route::get('/inquiry', function () {
        return view('inquiry'); // Return a view
    })->name('inquiry');

    Route::get('/contact', function () {
        return view('contact');
    });
    Route::get('/user-contacts', [ContactController::class, 'myContacts'])->name('user-contacts');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

    Route::post('/checkout/process', [OrderController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/payment', [OrderController::class, 'showPaymentPage'])->name('payment.show');
});

Route::middleware('isAdmin:admin')->group(function(){
    Route::get('/contact-list', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contact', [ContactController::class, 'create'])->name('contact');
    Route::get('/contact/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');
    Route::get('/contacts/{id}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts/{id}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::delete('/contacts/{id}/confirmed', [ContactController::class, 'destroyConfirmed'])->name('contacts.destroy.confirmed');

    Route::get('/medicines/{id}/edit', [MedicineController::class, 'edit'])->name('medicines.edit');
    Route::put('/medicines/{id}', [MedicineController::class, 'update'])->name('medicines.update');
    Route::delete('/medicines/{id}', [MedicineController::class, 'destroy'])->name('medicines.destroy');

    Route::get('/forum/admin', [ForumController::class, 'adminIndex'])->name('forum.adminIndex');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{post}/edit', [ForumController::class, 'edit'])->name('forum.edit');
    Route::put('/forum/{post}', [ForumController::class, 'update'])->name('forum.update');
    Route::delete('/forum/{id}', [ForumController::class, 'destroy'])->name('forum.destroy');
    Route::post('/posts/{post}/comments', [ForumController::class, 'commentStore'])->name('forum.comment.store');
    Route::delete('/comments/{id}', [ForumController::class, 'commentDestroy'])->name('forum.comment.destroy');
    Route::get('/forum/{post}', [ForumController::class, 'show'])->name('forum.show');
});

