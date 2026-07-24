<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\ProductImportController;
use App\Http\Controllers\Admin\BlogController;

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/kategori/{slug}', [FrontendController::class, 'categoryShow'])->name('category.show');
Route::get('/urun/{slug}', [FrontendController::class, 'productShow'])->name('product.show');
Route::get('/yayinlar', [FrontendController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/{slug}', [FrontendController::class, 'blogShow'])->name('blog.show');
Route::get('/hakkimizda', [FrontendController::class, 'about'])->name('about');
Route::get('/iletisim', [FrontendController::class, 'contact'])->name('contact');
Route::get('/gizlilik-politikasi', [FrontendController::class, 'privacyPolicy'])->name('privacyPolicy');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('/product-import', [ProductImportController::class, 'import'])->name('products.import');
});
