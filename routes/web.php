<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LocationController;

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
    Route::get('/shops/{shop}/show/','showEdit')->name('shop_show_show');
    
    Route::get('/shops/{shop}','show')->name('shops.show');
    Route::get('/shops/{shop}/edit','edit')->name('shop_edit');    
    Route::put('/shops/{shop}/show/','update')->name('shop_update');
    Route::delete('/shops/{shop}','delete')->name('shop_delete');
});

Route::controller(ReviewController::class)->middleware(['auth'])->group(function(){
    Route::get('/reviews/create/{shop}', 'create')->name('review.create'); 
    Route::post('/reviews', 'store')->name('review.store');
    Route::get('/reviews/{review}/show/', 'reviewEdit')->name('review.show'); 
    
    Route::get('/reviews/{review}/edit', 'edit2')->name('review.edit'); 
    Route::put('/reviews/{review}/show/', 'update2')->name('review.update'); 
    Route::delete('/reviews/{review}', 'delete2')->name('review.delete'); 
});

Route::controller(LocationController::class)->middleware(['auth'])->group(function(){
    Route::get('/search','search')->name('shop.search');
    Route::post('/distance','getNearRamen')->name('search.distance');
});

Route::controller(LikeController::class)->middleware(['auth'])->group(function(){
    Route::post('/reviews/{review}/like','toggleLike')->name('like');
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
