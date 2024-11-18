<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Http\Middleware\CheckAge;
use App\Http\Middleware\Admin;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/medicines', function () {
    return view('medicines');
});

Route::get('/medicine-buy', function () {
    return view('medicineBuy'); // This should match the name of your blade file without the .blade.php extension
})->name('medicineBuy');

Route::get('/doctors', function () {
    return view('doctors');
});

Route::get('/services', function () {
    return view('services');
});

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

});

Route::middleware('isAdmin:admin')->group(function(){
    Route::get('/contact-list', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contact/create', [ContactController::class, 'create'])->name('contact');
    Route::get('/contact/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');
    Route::get('/contacts/{id}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('/contacts/{id}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::delete('/contacts/{id}/confirmed', [ContactController::class, 'destroyConfirmed'])->name('contacts.destroy.confirmed');
});

