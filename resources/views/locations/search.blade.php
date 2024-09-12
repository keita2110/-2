<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold">検索結果</h1>
    </x-slot>

    <h2 class="text-xl font-semibold text-center py-4">＜ 地図 ＞</h2>
    <div id="map" class="h-[500px] w-full mb-4 border border-gray-300 rounded-lg shadow-md"></div>

    <div id="ramen-list" class="space-y-4 p-4"></div>

    <script>
        var map;
        var markers = [];
        var highlightedMarker = null;
        var userLocation = null;

        window.initMap = function() {
            var defaultLocation = { lat: 35.681236, lng: 139.767125 };

            var mapOptions = {
                center: defaultLocation,
                zoom: 12,
            };

            map = new google.maps.Map(document.getElementById('map'), mapOptions);

            // 位置情報のマーカーを追加
            @foreach ($locations as $location)
                @if(!empty($location->latitude) && !empty($location->longitude))
                    var marker = new google.maps.Marker({
                        position: { lat: {{ $location->latitude }}, lng: {{ $location->longitude }} },
                        map: map,
                        title: '{{ $location->address }}',
                    });
                    markers.push(marker);
                @endif
            @endforeach

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };

                    map.setCenter(userLocation);
                    map.setZoom(15);

                    new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        title: '現在地',
                        icon: 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png',
                    });

                    fetch('/distance', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            latitude: userLocation.lat,
                            longitude: userLocation.lng,
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        var ramenList = document.getElementById('ramen-list');
                        ramenList.innerHTML = ''; 
                        markers = []; 
                    
                        data.forEach(ramen => {
                            ramen.shops.forEach(shop => {
                                var reviewText = shop.review_avg > 0 ? shop.review_avg : '評価無し';
                    
                                var ramenItem = document.createElement('div');
                                ramenItem.classList.add('bg-white', 'border', 'border-gray-300', 'p-4', 'rounded-lg', 'shadow-md');
                                ramenItem.innerHTML = `
                                    <h3 class="text-lg font-semibold mb-2">${shop.name || ''}</h3>
                                    <p class="text-gray-700">評価: ${reviewText}</p>
                                    <p class="text-gray-700">ジャンル: ${shop.category_name || ''}</p>
                                    <p class="text-gray-700">営業時間: ${shop.open_time || ''} - ${shop.close_time || ''}</p>
                                    <p class="text-gray-700">料金: ¥${shop.min_price || ''} - ¥${shop.max_price || ''}</p>
                                    <p class="text-gray-700">住所: ${ramen.address || ''}</p>
                                    <p class="text-gray-700">距離: ${parseFloat(ramen.distance).toFixed(2)} km</p> <!-- ここで距離を表示 -->
                                    <a href="/shops/${shop.id}" class="text-blue-500 hover:underline">詳細ページへ</a><br>
                                    <button onclick="highlightLocation(${ramen.latitude}, ${ramen.longitude})" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">位置を見る</button>
                                `;
                                ramenList.appendChild(ramenItem);
                    
                                var ramenMarker = new google.maps.Marker({
                                    position: { lat: ramen.latitude, lng: ramen.longitude },
                                    map: map,
                                    title: shop.name || 'ラーメン店'
                                });
                                markers.push(ramenMarker);
                            });
                        });
                    })
                    .catch(error => {
                        console.error('エラー:', error);
                    });

                }, function() {
                    alert('位置情報の取得に失敗しました。');
                });
            } else {
                alert('このブラウザは位置情報をサポートしていません。');
            }
        };

        function highlightLocation(lat, lng) {
            markers.forEach(marker => marker.setIcon(null));

            if (highlightedMarker) {
                highlightedMarker.setMap(null);
            }
            highlightedMarker = new google.maps.Marker({
                position: { lat: lat, lng: lng },
                map: map,
                title: '強調表示地点',
                icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png', 
            });

            map.setCenter({ lat: lat, lng: lng });
            map.setZoom(15);
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ $api_key }}&callback=initMap" async defer></script>
</x-app-layout>
