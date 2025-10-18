<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\WebController;

// صفحات الزوار (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect('/login');
    });
    
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    
    // معالجة التسجيل والدخول
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

// صفحات المستخدمين المسجلين (Authenticated)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/expenses', function () {
        return view('expenses.index');
    })->name('expenses.index');
    
    Route::get('/expenses/create', function () {
        return view('expenses.create');
    })->name('expenses.create');
    
    Route::post('/expenses', [App\Http\Controllers\ExpenseController::class, 'store'])->name('expenses.store');
    
    Route::get('/expenses/{expense}/edit', [App\Http\Controllers\ExpenseController::class, 'edit'])->name('expenses.edit');
    
    Route::put('/expenses/{expense}', [App\Http\Controllers\ExpenseController::class, 'update'])->name('expenses.update');
    
    Route::delete('/expenses/{expense}', [App\Http\Controllers\ExpenseController::class, 'destroy'])->name('expenses.destroy');
    
    Route::get('/summary', function () {
        return view('expenses.summary');
    })->name('summary');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});