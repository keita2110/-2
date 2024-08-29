<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>店詳細ページ</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
    <x-app-layout>
        <x-slot name="header">
        　Show
        </x-slot>
        <h1 class="name">{{ $shop->name }}</h1>
        
        <div class="review">
            <h2>＜　評価　＞</h2>
            {{ $shop->review_avg }}
        </div>
        
        <div class="shop_information">
        <h2>＜　店情報　＞</h2>
            <div class="reserve">
                <h3>予約可否：　</h3>{{ $shop->reserve }}
            </div>
            
            <div class="address">
                <h3>住所：　</h3>{{ $shop->location->address }}
            </div>
            
            <div class="time">
                <h3>営業時間：　</h3>{{ $shop->open_time }}～{{ $shop->close_time }}
            </div>
            
            <div class="phone">
                <h3>電話番号：　</h3>{{ $shop->phone }}
            </div>
            
            <div class="price">
                <h3>料金：　</h3>{{ $shop->min_price }}円～{{ $shop->max_price }}円
            </div>  
            
            <div class="category">
                <h3>ラーメンの系統：　</h3>{{ $shop->shop_category->name }}
            </div>
            
            <div class="tag">
                <h3>ラーメンの種類：　</h3>
                @foreach($shop->ramen_tags as $tag)
                    {{ $tag->name }}@if(!$loop->last), @endif
                @endforeach
            </div>
        </div>
        
        <div class="menu">
            <h2>＜　メニュー　＞</h2>
            {{ $shop->menu }}
        </div>
        
        <div class="map">{{--編集--}}
            
        </div>
        
        <div class="image">
            <h2>＜　画像　＞</h2>
            <img src="{{ $shop->shop_image_url }}" alt="画像の投稿はありません。">
        </div>
        
        <div class="comment">
            <h2>＜　口コミ　＞</h2>
            @foreach($shop->reviews as $review)
                <p>投稿者：{{ $review->user->name }}</p>
                <p>{{ $review->body }}</p>
                <p>いいねの数：{{ $review->likes->count() }}</p>
                <form action="/reviews/{{ $review->id }}/like" method="POST">
                    @csrf
                    <button type="submit">
                        @if($review->likeBy(Auth::user()))
                            いいねを消す
                        @else
                            いいね
                        @endif
                    </button>
                </form>
            @endforeach
        </div>
        
        <a href="/reviews/create/{{$shop->id}}">評価と口コミを書く</a>
        
         <div class="footer">
            <a href="/search">戻る</a>
        </div>
        
    </x-app-layout>
    </body>
</html>