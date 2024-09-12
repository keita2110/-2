<x-app-layout>
    <x-slot name="header">
        検索結果
    </x-slot>
    
    <div class="search-form">
        <form action="/search/result" method="GET">
            <input type="text" name="keyword" placeholder="店名検索" value="{{ old('keyword', $keyword) }}" required>
            <button type="submit">検索</button>
        </form>
    </div>
    
    <h1>検索ワード: "{{ $keyword }}"</h1>

    @if($shops->isEmpty())
        <p>該当するラーメン店はありませんでした。</p>
    @else
        @foreach($shops as $shop)
            <div class="shop-item">
                <h3>{{ $shop->name }}</h3>
                <p>評価： {{ $shop->review_avg }}</p>
                <p>ジャンル： {{ $shop->shop_category->name }}</p>
                <p>営業時間： {{ $shop->open_time }} - {{ $shop->close_time }}</p>
                <p>料金： ¥{{ $shop->min_price }} - ¥{{ $shop->max_price }}</p>
                <p>住所: {{ $shop->location->address }}</p>
                <a href="/shops/{{ $shop->id }}">詳細を見る</a>
            </div>
        @endforeach
    @endif

    <div class="footer">
        <a href="/">戻る</a>
    </div>
</x-app-layout>