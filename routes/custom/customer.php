<?php

use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard',[HomeController::class,'index'])->name('user.dashboard.index');
Route::prefix('booking')->group(function () {

    Route::post('/store', [BookingController::class,'store'])->name('user.booking.store');
   
});



?>