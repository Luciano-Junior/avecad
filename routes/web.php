<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AssociateController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CategoryAssociateController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypeAssociateController;
use App\Http\Controllers\TypeCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/check-db', function () {
    return DB::connection()->getPdo()->query('select version()')->fetch();
});


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

    //Users
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::post('/user/register', [UserController::class, 'create'])->name('user.register');
    Route::get('/user/view/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/user/register', [UserController::class, 'create'])->name('user.register');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');

    //Categories
    Route::get('/categories', [CategoriesController::class, 'index'])->name('category.index');
    Route::get('/categories/register', [CategoriesController::class, 'create'])->name('category.register');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('category.create');
    Route::get('/categories/edit/{id}', [CategoriesController::class, 'show'])->name('category.edit');
    Route::put('/categories/update/{id}', [CategoriesController::class, 'update'])->name('category.update');
    Route::delete('/categories/delete/{id}', [CategoriesController::class, 'destroy'])->name('category.delete');

    Route::get('/category-associate', [CategoryAssociateController::class, 'index'])->name('category-associate.index');
    Route::get('/type-associate', [TypeAssociateController::class, 'index'])->name('type-associate.index');
    Route::get('/type-category', [TypeCategoryController::class, 'index'])->name('type-category.index');

    Route::get('/version', function(){
        return "1.0.0";
    })->name('version');
});

require __DIR__.'/auth.php';
