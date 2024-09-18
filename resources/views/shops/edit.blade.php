<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-5xl font-bold mb-6 text-center">店情報の編集</h1>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="/shops/{{ $shop->id }}/show" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold mb-2">＜　ラーメン屋名　＞</h2>
                    <input type="text" name="shop[name]" placeholder="ラーメン屋名" value="{{ old('shop.name', $shop->name) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('shop.name')
                        <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold mb-2">＜　店情報　＞</h2>
                    
                    <div class="mb-4">
                        <h3 class="text-lg font-medium mb-1">メニュー</h3>
                        <textarea name="shop[menu]" placeholder="食べたメニューなど自由にどうぞ"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('shop.menu', $shop->menu) }}</textarea>
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="text-lg font-medium mb-1">住所</h3>
                        <textarea name="shop[location]"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('shop.location', $shop->location->address) }}</textarea>
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="text-lg font-medium mb-1">予約可否</h3>
                        <input type="text" name="shop[reserve]" placeholder="可 or 不可" value="{{ old('shop.reserve', $shop->reserve) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="text-lg font-medium mb-1">営業時間</h3>
                        <div class="flex space-x-2">
                            <input type="text" name="shop[open_time]" value="{{ old('shop.open_time', $shop->open_time) }}"
                                class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <span class="flex items-center">～</span>
                            <input type="text" name="shop[close_time]" value="{{ old('shop.close_time', $shop->close_time) }}"
                                class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="text-lg font-medium mb-1">電話番号</h3>
                        <input type="text" name="shop[phone]" placeholder="000-000-0000" value="{{ old('shop.phone', $shop->phone) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="text-lg font-medium mb-1">価格</h3>
                        <div class="flex space-x-2">
                            <input type="number" name="shop[min_price]" placeholder="1000" value="{{ old('shop.min_price', $shop->min_price) }}"
                                class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <span class="flex items-center">円～</span>
                            <input type="number" name="shop[max_price]" placeholder="2000" value="{{ old('shop.max_price', $shop->max_price) }}"
                                class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <span class="flex items-center">円</span>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="text-lg font-medium mb-1">ラーメンの系統</h3>
                        <select name="shop[shop_category_id]"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('shop.shop_category_id', $shop->shop_category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-1">ラーメンの種類</h3>
                        <div class="space-y-2">
                            @foreach($tags as $tag)
                                <input type="checkbox" value="{{ $tag->id }}" name="shop_tags_array[]"
                                    class="mr-2 leading-tight" {{ in_array($tag->id, old('shop_tags_array', [])) ? 'checked' : '' }}>
                                <span class="text-gray-700">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h2 class="text-xl font-semibold mb-2">画像</h2>
                    <input type="file" name="shop_image" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <button type="submit"
                    class="bg-blue-500 font-semibold text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300 ease-in-out">
                    保存
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
