<x-app-layout>
    <h1 class="text-6xl font-bold m-4">{{ $shop->name }}</h1>

    <div class="flex flex-wrap gap-4 m-4">
        <div class="bg-white border border-gray-300 p-4 rounded-lg shadow-lg flex-1 min-w-[300px]">
            <div class="bg-white border border-gray-300 p-4 rounded-lg shadow-lg flex-1 min-w-[300px] m-2">
                <h2 class="text-2xl font-semibold mb-2">＜ 評価 ＞</h2>
                <p class="text-lg">{{ $shop->review_avg }}</p>
            </div>
    
            <div class="bg-white border border-gray-300 p-4 rounded-lg shadow-lg flex-1 min-w-[300px] m-2">
                <h2 class="text-2xl font-semibold mb-2">＜ メニュー ＞</h2>
                <p>{{ $shop->menu }}</p>
            </div>
            <div class="bg-white border border-gray-300 p-4 rounded-lg shadow-md flex-1 min-w-[300px]">
                <h2 class="text-2xl font-semibold mb-2">＜ 店情報 ＞</h2>
                <div class="mb-2">
                    <span class="font-semibold">予約可否：</span>{{ $shop->reserve }}
                </div>
                <div class="mb-2">
                    <span class="font-semibold">住所：</span>{{ $shop->location->address }}
                </div>
                <div class="mb-2">
                    <span class="font-semibold">営業時間：</span>{{ $shop->open_time }}～{{ $shop->close_time }}
                </div>
                <div class="mb-2">
                    <span class="font-semibold">電話番号：</span>{{ $shop->phone }}
                </div>
                <div class="mb-2">
                    <span class="font-semibold">料金：</span>{{ $shop->min_price }}円～{{ $shop->max_price }}円
                </div>
                <div class="mb-2">
                    <span class="font-semibold">ラーメンの系統：</span>{{ $shop->shop_category->name }}
                </div>
                <div class="mb-2">
                    <span class="font-semibold">ラーメンの種類：</span>
                    @foreach($shop->ramen_tags as $tag)
                        {{ $tag->name }}@if(!$loop->last), @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="bg-white border border-gray-300 p-4 rounded-lg shadow-md m-4">
            <h2 class="text-2xl font-semibold mb-2">＜ 画像 ＞</h2>
            <img src="{{ $shop->shop_image_url }}" alt="店の画像" style="width:900px; heigth:900px;" class="rounded-lg">
        </div>
    </div>
    
    <div class="bg-white border border-gray-300 p-4 rounded-lg shadow-md m-4">
            <h2 class="text-2xl font-semibold m-4">＜ 地図 ＞</h2>
            <div id="shop-map" class="h-[500px] w-full border border-gray-300 rounded-lg shadow-md"></div>
    </div>

    <div class="bg-white border border-gray-300 p-4 rounded-lg shadow-md m-4">
        <h2 class="text-2xl font-semibold mb-2">＜ 口コミ ＞</h2>
        @if($shop->reviews->isNotEmpty())
            @foreach($shop->reviews as $review)
                <div class="flex flex-col md:flex-row items-start gap-4 mb-4">
                    <div class="flex-1">
                        <p class="font-semibold">投稿者：{{ $review->user->name }}</p>
                        <div class="ml-4">
                            <p>{{ $review->body }}</p>
                        </div>
                        <div class="flex flex-wrap px-4">
                            <p class="text-gray-600 m-2">👍：{{ $review->likes_count }}</p>
                            <form action="/reviews/{{ $review->id }}/like" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    @if($review->likeBy(Auth::user()))
                                        👍を消す
                                    @else
                                        👍
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                    @if($review->review_image_url)
                        <img src="{{ $review->review_image_url }}" alt="口コミの画像" class="review-image">
                    @endif
                </div>
            @endforeach
            <a href="/shops/{{$shop->id}}/reviews"
               class="inline-block px-6 py-3 text-white bg-blue-500 rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300 ease-in-out">
               もっと口コミを見る
            </a>

        @else
            <p>投稿されている口コミはないです</p>
        @endif
    </div>
    
    <div class="flex flex-wrap p-4 m-4">
        <a href="/reviews/create/{{$shop->id}}"
           class="inline-block px-6 py-3 text-white bg-blue-500 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-300 ease-in-out mb-4">
           評価と口コミを書く
        </a>
        
        <div class="mb-4">
            <button onclick="window.history.back()"
                    class="inline-block px-6 py-3 ml-3 text-white bg-gray-500 rounded-lg shadow-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 transition duration-300 ease-in-out">
                戻る
            </button>
        </div>
    </div>

    <script>
        var map;
        var shopMarker;
        var userMarker;

        function initMap() {
            var shopLocation = { lat: {{ $latitude }}, lng: {{ $longitude }} };
            var mapOptions = {
                center: shopLocation,
                zoom: 15,
            };

            map = new google.maps.Map(document.getElementById('shop-map'), mapOptions);

            shopMarker = new google.maps.Marker({
                position: shopLocation,
                map: map,
                title: '{{ $shop->name }}',
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };

                    userMarker = new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        title: '現在地',
                        icon: 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png',
                    });

                    map.setCenter(userLocation);
                    map.setZoom(14);

                }, function() {
                    alert('位置情報の取得に失敗しました。');
                });
            } else {
                alert('このブラウザは位置情報をサポートしていません。');
            }
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ $api_key }}&callback=initMap" async defer></script>
</x-app-layout>
