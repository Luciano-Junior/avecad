<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AssociateController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AssociateController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Associates
    Route::get('/associates', [AssociateController::class, 'index'])->name('associate.index');
    Route::get('/associates/register', [AssociateController::class, 'create'])->name('associate.register');
    Route::post('/associates', [AssociateController::class, 'store'])->name('associate.create');
    Route::get('/associates/edit/{id}', [AssociateController::class, 'edit'])->name('associate.edit');
    Route::put('/associates/update/{id}', [AssociateController::class, 'update'])->name('associate.update');
    Route::get('/associates/view/{associate}', [AssociateController::class, 'show'])->name('associate.show');

    //Accounts
    Route::get('/accounts', [AccountController::class, 'index'])->name('account.index');
    Route::get('/accounts/register', [AccountController::class, 'create'])->name('account.register');
    Route::post('/accounts', [AccountController::class, 'store'])->name('account.create');
    Route::get('/accounts/edit/{id}', [AccountController::class, 'edit'])->name('account.edit');
    Route::put('/accounts/update/{id}', [AccountController::class, 'update'])->name('account.update');

    //Transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/transactions/register', [TransactionController::class, 'create'])->name('transaction.register');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transaction.create');
    Route::get('/transactions/edit/{id}', [TransactionController::class, 'edit'])->name('transaction.edit');
    Route::put('/transactions/update/{id}', [TransactionController::class, 'update'])->name('transaction.update');

    //Configurations
    Route::get('/configurations', [ConfigurationController::class, 'index'])->name('configuration.index');
    Route::post('/configurations/register', [ConfigurationController::class, 'create'])->name('configuration.register');
});

require __DIR__.'/auth.php';
