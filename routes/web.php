<?php

use App\Http\Controllers\CustomerManagerController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\PaymentConstroller;
use App\Http\Controllers\TesterController;
use Illuminate\Support\Facades\Route;

//Dashboard

Route::redirect('/','/dashboard');
Route::get('/dashboard', [DasboardController::class,'view'])->name('dashboard');
Route::get('/customers', [CustomerManagerController::class,'view'])->name('customer.list');
Route::get('/customers/add', [CustomerManagerController::class,'view'])->name('customer.add');
Route::get('/customers/edit', [CustomerManagerController::class,'view'])->name('customer.edit');


Route::get('/payment/view/{customer:id}', [PaymentConstroller::class,'view'])->name('payment.view');
Route::get('/payment/view/{customer:id}/{index}', [PaymentConstroller::class,'view'])->name('payment.view.image');


Route::prefix('/api')->group(function (){
    // DEV
    Route::get('/test',[TesterController::class,'mainTest']);
    Route::post('/test',[TesterController::class,'mainPost']);
    //PROD
    Route::post('/customers/add',[CustomerManagerController::class,'store'])->name('api.customer.add');
    Route::post('/customers/add',[CustomerManagerController::class,'store'])->name('api.customer.add');
    Route::post('/customers/edit',[CustomerManagerController::class,'store'])->name('api.customer.edit');
    Route::post('/customers/remove',[CustomerManagerController::class,'store'])->name('api.customer.remove');
    Route::post('/customers/remove/en',[CustomerManagerController::class,'store'])->name('api.customer.remove.encrypt');

    Route::post('/payment/add',[PaymentConstroller::class,'store'])->name('api.payment.add');
    Route::post('/payment/delete',[PaymentConstroller::class,'store'])->name('api.payment.delete');
    // END

});

Route::prefix('auth')->group(function (){
    Route::get('/login', function (){
        return view('login');
    });

    Route::get('/register', function (){
        return view('register');
    });
});



