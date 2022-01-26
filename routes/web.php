<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('send');
});

Route::get('update',[App\Http\Controllers\TelegramController::class , 'update'])->name('update');
Route::post('store',[App\Http\Controllers\TelegramController::class , 'store'])->name('store');
Route::post('store-photo',[App\Http\Controllers\TelegramController::class , 'storePhoto'])->name('store-photo');
