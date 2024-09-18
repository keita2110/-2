<x-app-layout>
    <div class="p-4 max-w-2xl mx-auto bg-white shadow-md rounded-lg m-4">
        <form action="/search/result" method="GET" class="flex items-center space-x-4">
            <input 
                type="text" 
                name="keyword" 
                placeholder="店名検索" 
                value="{{ old('keyword', $keyword) }}" 
                required
                class="w-full p-2 border border-gray-300 rounded-md"
            >
            <button 
                type="submit" 
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300"
            >
                検索
            </button>
        </form>
    </div>
    
    <div class="flex">
        <h2 class="text-xl font-semibold m-4">検索ワード: "{{ $keyword }}"</h2>
        <div class="m-4">
            <a 
                href="/" 
                class="inline-block px-4 py-2 ml-3 text-white bg-gray-500 rounded-lg shadow-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 transition duration-300 ease-in-out"
            >
                トップページに戻る
            </a>
        </div>
    </div>

    @if($shops->isEmpty())
        <p class="text-gray-700">該当するラーメン店はありませんでした。</p>
    @else
        <div class="space-y-4">
            @foreach($shops as $shop)
                <div class="bg-white border border-gray-300 p-4 m-4 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold mb-2">{{ $shop->name }}</h3>
                    <p class="text-gray-700">評価： {{ $shop->review_avg }}</p>
                    <p class="text-gray-700">ジャンル： {{ $shop->shop_category->name }}</p>
                    <p class="text-gray-700">営業時間： {{ $shop->open_time }} - {{ $shop->close_time }}</p>
                    <p class="text-gray-700">料金： ¥{{ $shop->min_price }} - ¥{{ $shop->max_price }}</p>
                    <p class="text-gray-700">住所: {{ $shop->location->address }}</p>
                    <a 
                        href="/shops/{{ $shop->id }}" 
                        class="text-blue-500 hover:underline"
                    >
                        詳細を見る
                    </a>
                </div>
            @endforeach
        </div>
    @endif

</x-app-layout>
