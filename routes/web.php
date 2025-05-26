<?php

use App\Http\Controllers\AssociateController;
use App\Http\Controllers\ProfileController;
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
});

require __DIR__.'/auth.php';
