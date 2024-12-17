<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Fundraisers\FundraisersController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/admin', function () {
    return view('dashboardAdmin');
})->middleware(['auth', 'verified'])->name('dashboardAdmin');

// Route::get('/fundraisers', function () {
//     return view('fundraisers');
// })->middleware(['auth', 'verified'])->name('fundraisers');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::resource()
    Route::prefix('fundraisers')->name('fundraisers.')->group(function (){
        Route::resource('fundraisers', FundraisersController::class)->middleware('role:fundraisers');
    });

     Route::prefix('admin')->name('admin.')->group(function (){
        // Route::resource('admin', FundraisersController::class)->middleware('role:fundraiser');
    });
});

Route::get('/fundraisings', function () {
    return view('fundraisings');
})->middleware(['auth', 'verified'])->name('fundraisings');

require __DIR__.'/auth.php';
