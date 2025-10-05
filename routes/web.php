<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProfileController;

Route::get('/', [UserController::class, 'home'])->name('index');

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

    Route::any('/search-product', [AdminController::class, 'postSearchProduct'])->name('admin.searchproduct');

    Route::get('/view-orders', [AdminController::class, 'viewOrder'])->name('admin.vieworders');

    Route::post('/change-order-status/{id}', [AdminController::class, 'postChangeOrderStatus'])->name('admin.changeorderstatus');


    Route::get('/downloadpdf/{id}', [AdminController::class, 'downloadPDF'])->name('admin.downloadpdf');


});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('addtocart/{id}', [UserController::class, 'addToCart'])->name('addtocart');
    Route::get('cart-products', [UserController::class, 'cartProducts'])->name('cart.products');
    Route::delete('/delete-cart/{id}', [UserController::class, 'deleteCart'])->name('delete.cart');
    Route::post('confirm-order', [UserController::class, 'confirmOrder'])->name('confirm.order');

    Route::get('myorders', [UserController::class, 'myOrders'])->name('myorders');

});


Route::get('/product/{id}', [UserController::class, 'ProductDetails'])->name('product');

Route::get('view-allproducts', [UserController::class, 'allProducts'])->name('view.allproducts');

Route::resource('coupons', CouponController::class);


require __DIR__.'/auth.php';
