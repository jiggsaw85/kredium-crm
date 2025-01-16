<?php

use App\Http\Controllers\CashLoanController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeLoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Clients
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{client}/update', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');

    // Loans
    Route::post('/cash-loans', [CashLoanController::class, 'store'])->name('cash_loans.store');
    Route::post('/home-loans', [HomeLoanController::class, 'store'])->name('home_loans.store');
    Route::put('/cash-loans/{id}', [CashLoanController::class, 'update'])->name('cash_loans.update');
    Route::put('/home-loans/{id}', [HomeLoanController::class, 'update'])->name('home_loans.update');

    // Reports
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
});

require __DIR__.'/auth.php';
