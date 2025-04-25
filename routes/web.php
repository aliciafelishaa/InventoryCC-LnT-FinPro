<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

Route::get('/', [InventoryController::class, 'viewHome'])->name('view');

//Credential
Route::middleware(['auth', 'role:admin'])-> get('/admin-dashboard', [InventoryController::class, 'viewAdminDashboard'])->name('admin.dashboard');
Route::middleware(['auth', 'role:user'])-> get('/user-dashboard', [InventoryController::class, 'viewUserDashboard'])->name('user.dashboard');
Route::get('/signin', [AuthController::class, 'signInPage'])->name('signin.page');
Route::get('/signup', [AuthController::class, 'signUpPage'])->name('signup.page');
Route::post('/signin-user', [AuthController::class, 'signInUser'])->name('signin.post');
Route::post('/signup-user', [AuthController::class, 'signUpUser'])->name('signup.post');
Route::post('/signout', [AuthController::class, 'signOutUser'])->name('signout');

//User
Route::get('/user-dashboard', [InventoryController::class, 'viewUserDashboard'])->name('user.dashboard');

//Admin
Route::get('/category-page', [CategoryController::class, 'categoryCreatePage'])->name('category.page');
Route::post('/category-create', [CategoryController::class, 'createCategory'])->name('create.category');
Route::get('/create-product-page', [InventoryController::class, 'createPage'])->name('create.page');
Route::post('/product-create', [InventoryController::class, 'createProduct'])->name('create.product');
Route::get('/list-product', [InventoryController::class, 'viewProduct'])->name('product.view.all');
Route::get('/list-product-filter/{id}', [InventoryController::class, 'viewProductByCategory'])->name('product.view.filter');
Route::get('/update-page/{id}', [InventoryController::class, 'updateProductPage'])->name('update.page');
Route::put('/update-product/{id}', [InventoryController::class, 'updateProduct'])->name('update.product');
Route::delete('/delete/{id}', [InventoryController::class, 'deleteProduct'])->name('delete.product');

//User
Route::get('/list-product-user', [UserController::class, 'viewProduct'])->name('product.view.all.user');
Route::get('/filter-user/{id}', [UserController::class, 'viewProductByCategory'])->name('product.view.filter.user');
Route::get('/cart-page', [CartsController::class, 'cartPage'])->name('cart.page');
//
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartsController::class, 'index'])->name('cart.index');
    Route::get('/cart/add/{productId}', [CartsController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{cartId}', [CartsController::class, 'update'])->name('cart.update');
    Route::get('/cart/remove/{cartId}', [CartsController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [CartsController::class, 'clear'])->name('cart.clear');
});

