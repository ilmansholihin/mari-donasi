<?php

use App\Models\Fundraisers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDonatursController;
use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\Admin\AdminFundraisersController;
use App\Http\Controllers\Admin\FundraisersControllerAdmin;
use App\Http\Controllers\Admin\AdminFundraisingsController;
use App\Http\Controllers\Fundraisers\FundraisersController;
use App\Http\Controllers\Fundraisers\FundraisersWithdrawalController;
use App\Http\Controllers\Fundraisers\FundraisersFundraisingController;

Route::get('/admin', function () {
    return view('welcome');
});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard/admin', function () {
//     return view('dashboardAdmin');
// })->middleware(['auth', 'verified'])->name('dashboardAdmin');

// Route::get('/fundraisers', function () {
//     return view('fundraisers');
// })->middleware(['auth', 'verified'])->name('fundraisers');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // route untuk admin
    Route::prefix('admin')->name('admin.')->group(function (){
        Route::resource('admins',  AdminController::class)->middleware('role:superAdmin');
        Route::resource('fundraisers',  AdminFundraisersController::class)->middleware('role:superAdmin');
        Route::resource('categories', AdminCategoriesController::class)->parameters(['categories' => 'category:slug'])->middleware('role:superAdmin');
        Route::resource('donaturs', AdminDonatursController::class)->middleware('role:superAdmin');
        Route::resource('fundraising', AdminFundraisingsController::class)->middleware('role:superAdmin');
        Route::put('fundraising/{id}', [AdminFundraisingsController::class, 'update'])->name('admin.fundraising.update');

    });

    // Route untuk fundraisers
    Route::prefix('fundraisers')->name('fundraisers.')->group(function (){
        Route::resource('fundraisers', FundraisersController::class)->middleware('role:fundraisers');
        Route::post('fundraisers/cancel', [FundraisersController::class, 'cancel'])->name('fundraisers.cancel')->middleware('role:fundraisers');
        Route::resource('fundraisings', FundraisersFundraisingController::class)->middleware('role:fundraisers');
        Route::resource('withdrawal', FundraisersWithdrawalController::class)->middleware('role:fundraisers');
    });

     Route::prefix('admin')->name('admin.')->group(function (){
        // Route::resource('admin', FundraisersController::class)->middleware('role:fundraiser');
    });
});

// 
Route::resource('/donaturs', DonaturController::class);
Route::get('donaturs/categori/{slug}', [DonaturController::class, 'showCategory'])->name('donaturs.showCategory');
Route::get('donaturs/create/{fundraising_id}', [DonaturController::class, 'create'])->name('donaturs.create');
Route::post('donaturs/store/{fundraising_id}', [DonaturController::class, 'store'])->name('donaturs.store');
Route::get('donaturs/{id}/payment/{snapToken}', [DonaturController::class, 'payment'])->name('donaturs.payment');
Route::post('midtrans-notification', [DonaturController::class, 'success'])->name('midtrans.notification');


Route::get('/fundraisings', function () {
    return view('fundraisings');
})->middleware(['auth', 'verified'])->name('fundraisings');

require __DIR__.'/auth.php';
