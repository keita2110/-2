<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReviewContrller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(ShopController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');//トップページ
    
    Route::get('/shops/create','create')->name('create');//店紹介
    Route::post('/shops','store')->name('shop_store');//店紹介の保存
    
    Route::get('/reviews/create', 'review')->name('review');//口コミ投稿
    Route::post('/reviews','store2')->name('review_store');//口コミ投稿の保存
    
    // Route::get('/reviews/create2','create2')->name('review2');
    // Route::post('/reviews','store3')->name('review_store2');
    
    Route::get('/reviews/{review}/edit','edit2')->name('review_edit');//口コミの編集
    Route::put('/reviews/{review}','update2')->name('review_update');
    Route::get('/reviews/{review}/show','reviewEdit')->name('review_edit_show');
    Route::delete('/reviews/{review}','delete2')->name('review_delete');
    //Route::get('/search', )->name('search');//編集
    
    Route::get('/shops/{shop}/edit','edit')->name('shop_edit');//店紹介の編集
    Route::put('/shops/{shop}','update')->name('shop_update');//店情報の更新
    Route::get('/shops/{shop}/show','showEdit')->name('shop_edit_show');
    Route::delete('/shops/{shop}','delete')->name('shop_delete');
    
    Route::get('/shops/{shop}','show')->name('shops_show');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
