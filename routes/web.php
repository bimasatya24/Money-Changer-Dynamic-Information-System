<?php

use App\Http\Controllers\UploadController;
use App\Models\Upload;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    $allUpload = Upload::all();
    
    return view('home', compact('allUpload'));
})->name('home');

Route::get('/admin/login', function() {
    return view('admin.login.index');
})->name('admin.login');

Route::get('/display', function () {
    $allUpload = Upload::all();

    $lastUpdated = Upload::latest('updated_at')->first()?->updated_at?->translatedFormat('d F Y H:i');

    return view('display.index', compact('allUpload', 'lastUpdated'));
})->name('display.index');

Route::resource('admin', UploadController::class);