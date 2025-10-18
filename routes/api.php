<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SummaryController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('expenses', ExpenseController::class);
    Route::get('/expenses/summary', [SummaryController::class, 'summary']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});