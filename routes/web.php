<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::redirect('/','/books');
Route::controller(LoginController::class)->group(function(){
    Route::get('register','register')->name('register');
    Route::post('store','store')->name('store');
    Route::get('login','login')->name('login');
    Route::post('authenticate','authenticate')->name('authenticate');
    Route::get('logout','logout')->name('logout');
});
Route::resource('books',BookController::class)->except('show')->middleware('auth');
Route::get('admin',[BookController::class,'admin'])->name('admin')->middleware('role');
