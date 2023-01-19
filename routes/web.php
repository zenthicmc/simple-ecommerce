<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Payment\TransactionController;
use App\Http\Controllers\Payment\TripayCallbackController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/product/{slug}', [FrontController::class, 'detail'])->name('detail');
Route::get('/checkout/{id_product}/{quantity}', [FrontController::class, 'checkout'])->name('checkout');
Route::post('/transaction', [TransactionController::class, 'store'])->name('transaction.store');
Route::get('/redirect/{reference}', [FrontController::class, 'redirect'])->name('redirect');
Route::get('/success/{merchantref}', [FrontController::class, 'success'])->name('success');
Route::post('/tripay/callback', [TripayCallbackController::class, 'handle'])->name('callback');

Route::get('/api/product/{filter}', [FrontController::class, 'api_product'])->name('api_product');
Route::post('/review_store/{code}', [FrontController::class, 'review_store'])->name('review_store');
Route::get('/review/success', [FrontController::class, 'review_success'])->name('review.success');
Route::get('/review/{code}', [FrontController::class, 'review'])->name('review.write');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('/dashboard/profile', [DashboardController::class, 'profile_update'])->name('profile_update');

    Route::get('/dashboard/invoice', [DashboardController::class, 'invoice'])->name('invoice');
    Route::get('/dashboard/purchase', [DashboardController::class, 'purchase'])->name('purchase');
    Route::get('/dashboard/purchase/{reference}', [DashboardController::class, 'purchase_view'])->name('purchase_view');
    
    
    Route::group(['middleware' => 'isAdmin'], function () {
        // Invoice Routes
        Route::get('/dashboard/admin/invoice', [InvoiceController::class, 'index'])->name('admin.invoice');
        Route::get('dashboard/admin/invoice/edit/{reference}', [InvoiceController::class, 'edit'])->name('admin.invoice.edit');
        Route::put('dashboard/admin/invoice/edit/{reference}', [InvoiceController::class, 'edit_store'])->name('admin.invoice.edit_store');
        Route::delete('dashboard/admin/invoice/delete/{reference}', [InvoiceController::class, 'delete'])->name('admin.invoice.delete');


        // purchase Routes
        Route::get('/dashboard/admin/purchase', [PurchaseController::class, 'index'])->name('admin.purchase');
        Route::get('dashboard/admin/purchase/edit/{reference}', [PurchaseController::class, 'edit'])->name('admin.purchase.edit');
        Route::put('dashboard/admin/purchase/edit/{reference}', [PurchaseController::class, 'edit_store'])->name('admin.purchase.edit_store');
        Route::delete('dashboard/admin/purchase/delete/{reference}', [PurchaseController::class, 'delete'])->name('admin.purchase.delete');


        // Users Routes
        Route::get('/dashboard/admin/users', [UserController::class, 'index'])->name('users');
        Route::get('/dashboard/admin/users/new', [UserController::class, 'create'])->name('users_new');
        Route::post('/dashboard/admin/users/new', [UserController::class, 'create_store'])->name('users_new_store');
        Route::get('/dashboard/admin/users/edit/{id}', [UserController::class, 'edit'])->name('users_edit');
        Route::put('/dashboard/admin/users/edit/{id}', [UserController::class, 'edit_store'])->name('users_edit_store');
        Route::delete('/dashboard/admin/users/delete/{id}', [UserController::class, 'delete'])->name('users_delete');
    
        // Category Routes
        Route::get('/dashboard/admin/category', [CategoryController::class, 'index'])->name('category');
        Route::get('/dashboard/admin/category/new', [CategoryController::class, 'create'])->name('category_new');
        Route::post('/dashboard/admin/category/new', [CategoryController::class, 'create_store'])->name('category_new_store');
        Route::get('/dashboard/admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('category_edit');
        Route::put('/dashboard/admin/category/edit/{id}', [CategoryController::class, 'edit_store'])->name('category_edit_store');
        Route::delete('/dashboard/admin/category/delete/{id}', [CategoryController::class, 'delete'])->name('category_delete');
    
        // Product Routes
        Route::get('/dashboard/admin/product', [ProductController::class, 'index'])->name('product');
        Route::get('/dashboard/admin/product/new', [ProductController::class, 'create'])->name('product_new');
        Route::post('/dashboard/admin/product/new', [ProductController::class, 'create_store'])->name('product_new_store');
        Route::get('/dashboard/admin/product/edit/{id}', [ProductController::class, 'edit'])->name('product_edit');
        Route::put('/dashboard/admin/product/edit/{id}', [ProductController::class, 'edit_store'])->name('product_edit_store');
        Route::delete('/dashboard/admin/product/delete/{id}', [ProductController::class, 'delete'])->name('product_delete');
    
        // Stock Routes
        Route::get('/dashboard/admin/stock', [StockController::class, 'index'])->name('stock');
        Route::get('/dashboard/admin/stock/new', [StockController::class, 'create'])->name('stock_new');
        Route::post('/dashboard/admin/stock/new', [StockController::class, 'create_store'])->name('stock_new_store');
        Route::get('/dashboard/admin/stock/edit/{id}', [StockController::class, 'edit'])->name('stock_edit');
        Route::put('/dashboard/admin/stock/edit/{id}', [StockController::class, 'edit_store'])->name('stock_edit_store');
        Route::delete('/dashboard/admin/stock/delete/{id}', [StockController::class, 'delete'])->name('stock_delete');
    
        // Review Routes
        Route::get('/dashboard/admin/review', [ReviewController::class, 'index'])->name('review');
        Route::get('/dashboard/admin/review/new', [ReviewController::class, 'create'])->name('review_new');
        Route::post('/dashboard/admin/review/new', [ReviewController::class, 'create_store'])->name('review_new_store');
        Route::get('/dashboard/admin/review/edit/{id}', [ReviewController::class, 'edit'])->name('review_edit');
        Route::put('/dashboard/admin/review/edit/{id}', [ReviewController::class, 'edit_store'])->name('review_edit_store');
        Route::delete('/dashboard/admin/review/delete/{id}', [ReviewController::class, 'delete'])->name('review_delete');
    });
});

require __DIR__.'/auth.php';
