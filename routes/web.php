<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/dashboard', [UserController::class, 'index'] )->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('admin')->group(function(){
    Route::get('/add-category', [AdminController::class, 'addCategory'])->name('admin.addcategory');
    Route::post('/add-category', [AdminController::class, 'postAddCategory'])->name('admin.postaddcategory');

    Route::get('/view-category', [AdminController::class, 'viewCategory'])->name('admin.viewcategory');
    Route::delete('/delete-category/{id}', [AdminController::class, 'deleteCategory'])->name('admin.deletecategory');

    Route::get('/update-category/{id}', [AdminController::class, 'updateCategory'])->name('admin.updatecategory');
    Route::post('/update-category/{id}', [AdminController::class, 'postUpdateCategory'])->name('admin.postupdatecategory');

    Route::get('/add-product', [AdminController::class, 'addProduct'])->name('admin.addproduct');
    Route::post('/add-product', [AdminController::class, 'postAddProduct'])->name('admin.postaddproduct');


    Route::get('/view-product', [AdminController::class, 'viewProduct'])->name('admin.viewproduct');
    Route::delete('/delete-product/{id}', [AdminController::class, 'deleteProduct'])->name('admin.deleteproduct');

    Route::get('/update-product/{id}', [AdminController::class, 'updateProduct'])->name('admin.updateproduct');
    Route::post('/update-product/{id}', [AdminController::class, 'postUpdateProduct'])->name('admin.postupdateproduct');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
