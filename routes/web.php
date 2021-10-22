<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\MainController;



Route::get('/', [MainController::class, 'home']);


Route::group(['middleware' => 'auth'], function () {
    Route::prefix('links')->group(function () {
        Route::get('/', [LinkController::class, 'index'])->name('links');
        Route::get('create', [LinkController::class, 'create'])->name('create-link');
        Route::post('store', [LinkController::class, 'store'])->name('store-link');
        Route::get('edit/{id}', [LinkController::class, 'edit'])->name('edit-link');
        Route::put('update/{id}', [LinkController::class, 'update'])->name('update-link');
        Route::match(['get', 'put'], 'cs/{id}', [LinkController::class, 'changeState'])->name('cs-link');
        Route::match(['delete', 'get'], 'remove/{id}', [LinkController::class, 'remove'])->name('remove-link');
    });
});

Route::get('/link/{linkid}', [LinkController::class, 'show']);
























Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
