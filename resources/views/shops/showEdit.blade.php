<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-5xl font-bold mb-4">{{ $shop->name }}</h1>
        
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4">＜　店情報　＞</h2>
            
            <div class="mb-4">
                <h3 class="text-lg font-medium">予約可否：</h3>
                <p class="text-gray-700">{{ $shop->reserve }}</p>
            </div>
            
            <div class="mb-4">
                <h3 class="text-lg font-medium">住所：</h3>
                <p class="text-gray-700">{{ $shop->location->address }}</p>
            </div>
            
            <div class="mb-4">
                <h3 class="text-lg font-medium">営業時間：</h3>
                <p class="text-gray-700">{{ $shop->open_time }}～{{ $shop->close_time }}</p>
            </div>
            
            <div class="mb-4">
                <h3 class="text-lg font-medium">電話番号：</h3>
                <p class="text-gray-700">{{ $shop->phone }}</p>
            </div>
            
            <div class="mb-4">
                <h3 class="text-lg font-medium">料金：</h3>
                <p class="text-gray-700">{{ $shop->min_price }}円～{{ $shop->max_price }}円</p>
            </div>  
            
            <div class="mb-4">
                <h3 class="text-lg font-medium">ラーメンの系統：</h3>
                <p class="text-gray-700">{{ $shop->shop_category->name }}</p>
            </div>
            
            <div class="mb-4">
                <h3 class="text-lg font-medium">ラーメンの種類：</h3>
                <p class="text-gray-700">
                    @foreach($shop->ramen_tags as $tag)
                        {{ $tag->name }}@if(!$loop->last), @endif
                    @endforeach
                </p>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4">＜　メニュー　＞</h2>
            <p class="text-gray-700">{{ $shop->menu }}</p>
        </div>
        
        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4">＜　画像　＞</h2>
            <img src="{{ $shop->shop_image_url }}" alt="画像の投稿はありません。" class="w-full h-auto rounded-lg">
        </div>
        
        <div class="flex gap-4 mb-6">
            <a href='/shops/{{ $shop->id }}/edit' 
                class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300 ease-in-out">
                編集する
            </a>
            <a href="/reviews/create/{{$shop->id}}" 
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow-md font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
                評価と口コミも書く
            </a>
            <form action="/shops/{{ $shop->id }}" id="form_{{ $shop->id }}" method="POST" class="flex items-center">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deleteShop({{ $shop->id }})" 
                    class="bg-red-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 transition duration-300 ease-in-out">
                    この投稿を削除する
                </button>
            </form>
            <a href="/" 
                class="bg-gray-500 text-white px-4 py-2 rounded-lg shadow-md font-semibold hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 transition duration-300 ease-in-out">
                トップページに戻る
            </a>
        </div>
    </div>

    <script>
        function deleteShop(id){
            'use strict'
            
            if (confirm('削除すると復元できません。 \n本当に削除しますか？')){
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</x-app-layout>
