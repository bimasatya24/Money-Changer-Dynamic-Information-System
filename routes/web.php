<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\CustomerController;
use App\Models\Upload;
use Illuminate\Support\Facades\Route;

Route::get('/lang/{locale}', [LanguageController::class, 'switchLang'])->name('lang.switch');


Route::get('/', function () {
    $allUpload = Upload::all();

    return view('home', compact('allUpload'));
})->name('home');

Route::get('/admin/login', function () {
    return view('admin.login.index');
})->name('login');

Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');

Route::resource('admin', UploadController::class)->middleware('auth');

Route::get('/display', function () {
    $allUpload = Upload::all();

    $lastUpdated = Upload::latest('updated_at')->first()?->updated_at?->translatedFormat('d F Y H:i');

    return view('display.index', compact('allUpload', 'lastUpdated'));
})->name('display.index');

Route::get('/api/rates', function () {
    return response()->json(Upload::all());
})->name('api.rates');

Route::get('/pesan-antar', function() {
    return view('pesan-antar');
})->name('pesan-antar');

// =========================
// AUTH PELANGGAN
// =========================

Route::get('/register', function () {
    return view('auth.register');
})->name('customer.register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('customer.register.post');

Route::get('/login', function () {
    return view('auth.login');
})->name('customer.login');

Route::post('/login', [AuthController::class, 'customerLogin'])
    ->name('customer.login.post');

Route::post('/logout', [AuthController::class, 'customerLogout'])
    ->name('customer.logout');

// =========================
// PESAN ANTAR - PELANGGAN
// =========================

Route::middleware('auth')->group(function () {

    Route::get('/pesan-antar/ktp', [CustomerController::class, 'ktp'])
        ->name('customer.ktp');

    Route::post('/pesan-antar/ktp', [CustomerController::class, 'saveKtp'])
        ->name('customer.ktp.save');

    Route::get('/pesan-antar/lokasi', [CustomerController::class, 'location'])
        ->name('customer.location');

    Route::post('/pesan-antar/lokasi', [CustomerController::class, 'saveLocation'])
        ->name('customer.location.save');

    Route::get('/pesan-antar/pesanan', [CustomerController::class, 'order'])
        ->name('customer.order');    

    Route::post('/pesan-antar/pesanan', [CustomerController::class, 'saveOrder'])
        ->name('customer.order.save');

    Route::get('/pesan-antar/konfirmasi', [CustomerController::class, 'confirmation'])
        ->name('customer.order.confirmation');

    Route::post('/pesan-antar/konfirmasi', [CustomerController::class, 'confirmOrder'])
        ->name('customer.order.confirm');

    Route::get('/pesan-antar/berhasil', [CustomerController::class, 'success'])
    ->name('customer.order.success');    
});