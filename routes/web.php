<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\ProductController; 

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

Route::get('/', [ProductController::class, 'index'])->name('home');


Route::prefix('product')->name('product.')->group(function () {
    Route::post('product/images', [ProductController::class, 'uploadImage'])->name('images');
    Route::get('search_product', [ProductController::class, 'searchProductByBrand'])->name('search');
    Route::get('search_product_filter', [ProductController::class, 'searchProductByFilter'])->name('search.product.filter');
    Route::get('search/{page}/{sku}', [ProductController::class, 'show'])->name('search.detail');
});

Route::get('/locale/{lang}', function ($lang) {
    if (!in_array($lang, ['en', 'th'])) {
        abort(400); 
    }
    Session::put('locale', $lang);
    App::setLocale($lang);
    return redirect()->back(); 
});
