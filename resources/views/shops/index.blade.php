<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold">トップページ</h1>
    </x-slot>
    
    <!-- メインタイトル -->
    <div class="text-8xl font-bold text-center my-12" style="font-family: 'KouzanC', serif;">
        探麵
    </div>
    
    <!-- ボタンセクション -->
    <div class="flex flex-col items-center space-y-4 mb-8">
        <div class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-600 transition duration-300">
            <a href='/search' class="block text-center">近くのラーメン屋を探す</a>
        </div>
        
        <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-green-600 transition duration-300">
            <a href='/shops/create' class="block text-center">店を紹介する</a>
        </div>
        
        <div class="bg-yellow-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-yellow-600 transition duration-300">
            <a href="search/second" class="block text-center">条件を絞って近くの店を探す</a>
        </div>
    </div>
    
    <!-- 検索フォームセクション -->
    <div class="flex justify-center mb-8">
        <form action="/search/result" method="GET" class="flex items-center space-x-4 bg-white p-4 rounded-lg shadow-md border border-gray-200">
            <input type="text" name="keyword" placeholder="店名検索" required class="border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-blue-600 transition duration-300">検索</button>
        </form>
    </div>
    
</x-app-layout>
