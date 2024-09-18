<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-5xl font-semibold text-gray-800 m-4">{{ $review->shop ? $review->shop->name : 'Shop not available' }}</h1>

        <div class="bg-white border border-gray-300 p-4 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-medium text-gray-700 mb-2">＜ 評価 ＞</h2>
            <p class="text-lg">{{ $review->review }}</p>
        </div>
        
        <div class="bg-white border border-gray-300 p-4 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-medium text-gray-700 mb-2">＜ 口コミ ＞</h2>
            <p class="text-lg">{{ $review->body }}</p>
        </div>
        
        <div class="bg-white border border-gray-300 p-4 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-medium text-gray-700 mb-2">＜ 画像 ＞</h2>
            <img src="{{ $review->review_image_url }}" alt="レビュー画像" class="w-full max-w-md h-auto object-cover rounded-lg" />
        </div>
        
        <div class="flex items-center space-x-4">
            <a href='/reviews/{{ $review->id }}/edit' class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                編集する
            </a>

            <form action="/reviews/{{ $review->id }}" id="form_{{ $review->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deleteReview({{ $review->id }})" class="px-4 py-2 bg-red-500 text-white rounded-lg shadow-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                    口コミの削除
                </button>
            </form>
            
            <a href="{{ route('shops.show', ['shop' => $review->shop_id]) }}" 
                class="inline-block px-4 py-2 text-white bg-gray-500 rounded-lg shadow-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 transition duration-300 ease-in-out">
                店の詳細ページに戻る
            </a>

            <a href="/" 
                class="inline-block px-4 py-2 text-white bg-gray-500 rounded-lg shadow-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 transition duration-300 ease-in-out">
                トップページに戻る
            </a>
        </div>
    </div>

    <script>
        function deleteReview(id) {
            'use strict';

            if (confirm('削除すると復元できません。 \n本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</x-app-layout>
