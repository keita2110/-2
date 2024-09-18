<x-app-layout>
    <h1 class="text-5xl font-bold mb-6 text-center">ラーメン屋の紹介</h1>

    <form action="/shops" method="POST" enctype="multipart/form-data" class="bg-white border border-gray-300 p-4 m-4 rounded-lg shadow-lg">
        @csrf
        
        <div class="mb-4">
            <h2 class="text-2xl font-semibold mb-2">＜　ラーメン屋名　＞</h2>
            <input type="text" name="shop[name]" placeholder="ラーメン屋名" value="{{ old('shop.name') }}" class="w-full px-4 py-2 border rounded-md shadow-sm">
            @if ($errors->has('shop.name'))
                <p class="text-red-500 text-sm mt-1">{{ $errors->first('shop.name') }}</p>
            @endif
        </div>
        
        <div class="mb-6">
            <h2 class="text-2xl font-semibold mb-2">＜　店情報　＞</h2>

            <div class="mb-4">
                <h3 class="text-lg font-medium mb-1">メニュー</h3>
                <textarea name="shop[menu]" placeholder="食べたメニューなど自由にどうぞ" class="w-full px-4 py-2 border rounded-md shadow-sm">{{ old('shop.menu') }}</textarea>
            </div>
            
            <div class="mb-4">
                <h3 class="text-lg font-medium mb-1">住所</h3>
                <textarea name="shop[location]" class="w-full px-4 py-2 border rounded-md shadow-sm">{{ old('shop.location') }}</textarea>
            </div>
            
            <div class="mb-4">
                <h3 class="text-lg font-medium mb-1">予約可否</h3>
                <input type="text" name="shop[reserve]" placeholder="可 or 不可" value="{{ old('shop.reserve') }}" class="w-full px-4 py-2 border rounded-md shadow-sm">
            </div>
            
            <div class="mb-4">
                <h3 class="text-lg font-medium mb-1">営業時間</h3>
                <div class="flex gap-2">
                    <input type="text" name="shop[open_time]" placeholder="11時" value="{{ old('shop.open_time') }}" class="w-full px-4 py-2 border rounded-md shadow-sm">
                    <span class="self-center">～</span>
                    <input type="text" name="shop[close_time]" placeholder="23時" value="{{ old('shop.close_time') }}" class="w-full px-4 py-2 border rounded-md shadow-sm">
                </div>
            </div>
            
            <div class="mb-4">
                <h3 class="text-lg font-medium mb-1">電話番号</h3>
                <input type="text" name="shop[phone]" placeholder="000-000-0000" value="{{ old('shop.phone') }}" class="w-full px-4 py-2 border rounded-md shadow-sm">
            </div>
            
            <div class="mb-4">
                <h3 class="text-lg font-medium mb-1">価格</h3>
                <div class="flex gap-2">
                    <input type="number" name="shop[min_price]" placeholder="1000" value="{{ old('shop.min_price') }}" class="w-full px-4 py-2 border rounded-md shadow-sm">
                    <span class="self-center">～</span>
                    <input type="number" name="shop[max_price]" placeholder="2000" value="{{ old('shop.max_price') }}" class="w-full px-4 py-2 border rounded-md shadow-sm">円
                </div>
            </div>
            
            <div class="mb-4">
                <h3 class="text-lg font-medium mb-1">ラーメンの系統</h3>
                <select name="shop[shop_category_id]" class="w-full px-4 py-2 border rounded-md shadow-sm">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('shop.shop_category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-4">
                <h3 class="text-lg font-medium mb-1">ラーメンの種類</h3>
                <div class="space-y-2">
                    @foreach($tags as $tag)
                        <label>
                            <input type="checkbox" value="{{ $tag->id }}" name="tags_array[]" {{ in_array($tag->id, old('tags_array', [])) ? 'checked' : '' }} class="mr-2">
                            {{ $tag->name }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-2">画像</h2>
            
            <!-- エラーメッセージの表示 -->
            @if ($errors->has('shop_image'))
                <p class="text-red-500 text-sm mb-2">{{ $errors->first('shop_image') }}</p>
            @endif
        
            <input type="file" name="shop_image" class="w-full px-4 py-2 border rounded-md shadow-sm">
        </div>
        
        <button type="submit" 
            class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
            保存
        </button>
        
        <a href="/" 
            class="inline-block px-4 py-2 ml-4 font-semibold text-white bg-gray-500 rounded-lg shadow-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 transition duration-300 ease-in-out">
            戻る
        </a>
    </form>
</x-app-layout>
