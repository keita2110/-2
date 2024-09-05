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

// ShopController に関連するルート
Route::controller(ShopController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index'); // トップページ
    Route::get('/shops/create', 'create')->name('create'); // 店舗作成ページ
    Route::post('/shops', 'store')->name('shop_store'); // 店舗情報の保存
    Route::get('/shops/{shop}/show/', 'showEdit')->name('shop_show_show'); // 店舗詳細編集ページ
    Route::get('/search/result', 'searchResults')->name('search.results'); // 検索結果ページ
    Route::get('/search/second', 'search')->name('shops.search'); // 検索ページ
    Route::get('/search/map-results', 'mapResults')->name('shops.mapResults'); // マップ検索結果ページ
    Route::post('/map-search', 'mapSearch')->name('distance'); // マップ検索結果取得（JSON形式）
    Route::get('/shops/{shop}', 'show')->name('shops.show'); // 店舗詳細ページ
    Route::get('/shops/{shop}/edit', 'edit')->name('shop_edit'); // 店舗編集ページ    
    Route::put('/shops/{shop}/show/', 'update')->name('shop_update'); // 店舗情報の更新
    Route::delete('/shops/{shop}', 'delete')->name('shop_delete'); // 店舗の削除
});

// ReviewController に関連するルート
Route::controller(ReviewController::class)->middleware(['auth'])->group(function(){
    Route::get('/reviews/create/{shop}', 'create')->name('review.create'); // レビュー作成ページ
    Route::post('/reviews', 'store')->name('review.store'); // レビュー情報の保存
    Route::get('/reviews/{review}/show/', 'reviewEdit')->name('review.show'); // レビュー詳細編集ページ
    Route::get('/shops/{shop}/reviews', 'reviewShow')->name('reviews.show2');
    Route::get('/reviews/{review}/edit', 'edit2')->name('review.edit'); // レビュー編集ページ
    Route::put('/reviews/{review}/show/', 'update2')->name('review.update'); // レビュー情報の更新
    Route::delete('/reviews/{review}', 'delete2')->name('review.delete'); // レビューの削除
});

// LocationController に関連するルート
Route::controller(LocationController::class)->middleware(['auth'])->group(function(){
    Route::get('/search', 'search')->name('shop.search'); // 店舗検索ページ
    Route::post('/distance', 'getNearRamen')->name('search.distance'); // 近くのラーメン店検索
});

// LikeController に関連するルート
Route::controller(LikeController::class)->middleware(['auth'])->group(function(){
    Route::post('/reviews/{review}/like', 'toggleLike')->name('like'); // レビューへの「いいね」切り替え
});

// ダッシュボードのルート
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ユーザープロファイル関連のルート
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // プロフィール編集ページ
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // プロフィール情報の更新
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // プロフィールの削除
});

// 認証関連のルート
require __DIR__.'/auth.php';
