<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return 'pong';
}); 
Route::post('/register', [AuthController::class, 'register'])->withoutMiddleware('web');
Route::post('/login', [AuthController::class, 'login'])->withoutMiddleware('web');

Route::middleware('auth:api')->group(function () {
    // Account Management
    Route::post('/accounts', [AccountController::class, 'store']);
    Route::get('/accounts', [AccountController::class, 'index']);
    Route::get('/accounts/{account}', [AccountController::class, 'show']);

    // Transaction Handling
    Route::post('/accounts/{account}/transactions', [TransactionController::class, 'store']);
    Route::get('/accounts/{account}/transactions', [TransactionController::class, 'index']);
});
