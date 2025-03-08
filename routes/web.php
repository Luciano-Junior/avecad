<?php

use App\Http\Controllers\AssociateController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('associate.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Associates
    Route::get('/associates', [AssociateController::class, 'index'])->name('associate.index');
    Route::get('/associates/register', [AssociateController::class, 'create'])->name('associate.register');
    Route::post('/associates', [AssociateController::class, 'store'])->name('associate.create');
    Route::get('/associates/edit/{id}', [AssociateController::class, 'edit'])->name('associate.edit');
});

require __DIR__.'/auth.php';
