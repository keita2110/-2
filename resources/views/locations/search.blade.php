<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- CSRF トークンを追加 -->

    <title>Search</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        #ramen-list {
            margin-top: 20px;
            font-family: Arial, sans-serif;
        }
        .ramen-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        Search
    </x-slot>
    <h1>＜ 地図 ＞</h1>

    <!-- マップ表示部分 -->
    <div id="map"></div>

    <div id="ramen-list"></div>

    <script>
        // グローバルスコープで関数を定義
        window.initMap = function() {
            // デフォルトで東京を中心に設定（取得が不可だったときの予備）
            var defaultLocation = { lat: 35.681236, lng: 139.767125 };

            // マップのオプション
            var mapOptions = {
                center: defaultLocation,
                zoom: 12,
            };

            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            // ユーザの位置情報を取得
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                    };

                    // ユーザの位置に地図の中心を設定
                    map.setCenter(userLocation);

                    // ズームレベルを調整
                    map.setZoom(15);

                    // ユーザの位置にマーカーを追加
                    new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        title: '現在地',
                        icon: 'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png',
                    });

                    // ラーメン屋のデータを取得
                    fetch('/distance', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude,
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // ラーメン屋のデータを距離でソート
                        data.sort((a, b) => a.distance - b.distance);
                    
                        const ramenList = document.getElementById('ramen-list');
                        ramenList.innerHTML = ''; // 既存のリストをクリア
                    
                        data.forEach((ramen, index) => {
                            // マーカーを地図に追加
                            new google.maps.Marker({
                                position: { lat: ramen.latitude, lng: ramen.longitude },
                                map: map,
                                title: ramen.shops.length > 0 ? ramen.shops[0].name : 'Unknown'
                            });
                    
                            // ラーメン屋のタイトルをリストに追加
                            ramen.shops.forEach(shop => {
                                const ramenItem = document.createElement('div');
                                ramenItem.className = 'ramen-item';
                                const shopLink = document.createElement('a');
                                shopLink.href = `/shops/${shop.id}`; // Shop の詳細ページへのリンク
                                shopLink.textContent = `${index + 1}. ${shop.name} - ${ramen.distance.toFixed(2)} km`;
                                ramenItem.appendChild(shopLink);
                                ramenList.appendChild(ramenItem);
                            });
                        });
                    })


                    .catch(error => {
                        console.error('Error:', error);
                    });
                }, function() {
                    // 位置情報の取得に失敗
                    alert('位置情報の取得に失敗しました。');
                });
            } else {
                // Geolocation がサポートされていないブラウザ
                alert('このブラウザは位置情報をサポートしていません。');
            }

            // データベースから取得したほかのマーカー
            @foreach ($locations as $location)
                @if(!empty($location->latitude) && !empty($location->longitude))
                    new google.maps.Marker({
                        position: { lat: {{ $location->latitude }}, lng: {{ $location->longitude }} },
                        map: map,
                        title: 'Location',
                    });
                @endif
            @endforeach
        };
    </script>

    <!-- Google Maps API の読み込み -->
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ $api_key }}&callback=initMap" async defer></script>
</x-app-layout>
</body>
</html>
