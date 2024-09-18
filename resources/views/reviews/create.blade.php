<x-app-layout>
    <h1 class="text-5xl font-semibold text-gray-800 m-4">{{ $shop->name }}</h1>

    <form action="/reviews" method="POST" enctype="multipart/form-data">
        @csrf
        
        <input type="hidden" name="post[shop_id]" value="{{ $shop->id }}" />

        <div class="bg-white border border-gray-300 p-4 m-4 rounded-lg shadow-lg">
            <div class="mb-6">
                <h2 class="text-xl font-medium text-gray-700 mb-2">評価</h2>
                <input type="number" name="post[review]" min="1" max="5" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
            
            <div class="mb-6">
                <h2 class="text-xl font-medium text-gray-700 mb-2">口コミ</h2>
                <textarea name="post[body]" placeholder="お好きなコメントをどうぞ" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('post.body') }}</textarea>
                @if ($errors->has('post.body'))
                    <p class="text-red-500 mt-2">{{ $errors->first('post.body') }}</p>
                @endif
            </div>
            
            <div class="mb-6">
                <h2 class="text-xl font-medium text-gray-700 mb-2">画像</h2>
                <input type="file" name="review_image" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm bg-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>

            <div class="flex items-center space-x-4">
                <input type="submit" value="保存" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50" />
                
                <a href="/shops/{{ $shop->id }}" 
                   class="inline-block px-4 py-2 text-white bg-gray-500 rounded-lg shadow-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 transition duration-300 ease-in-out">
                   戻る
                </a>
            </div>
        </div>
    </form>
</x-app-layout>
