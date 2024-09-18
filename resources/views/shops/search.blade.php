<x-app-layout>
    <h1 class="text-4xl text-center font-semibold m-4">＜ 条件を絞って近くのラーメン屋を探す ＞</h1>
        
    
    <div class="bg-white border border-gray-300 p-4 m-4 rounded-lg shadow-lg flex-1 min-w-[300px]">
        <form action="{{ route('shops.mapResults') }}" method="GET" class="space-y-4">
            <!-- ジャンルセレクト -->
            <div>
                <label for="category" class="block text-gray-700 font-medium mb-1">ジャンル:</label>
                <select name="category" id="category" class="w-full p-2 border border-gray-300 rounded-md">
                    <option value="">すべて</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- ラーメンの種類チェックボックス -->
            <div>
                <label for="ramen_tags" class="block text-gray-700 font-medium mb-1">ラーメンの種類:</label>
                <div id="ramen_tags" class="flex flex-wrap gap-4">
                    @foreach($tags as $tag)
                        <div class="flex items-center">
                            <input type="checkbox" name="ramen_tags[]" value="{{ $tag->id }}" id="tag-{{ $tag->id }}" class="mr-2">
                            <label for="tag-{{ $tag->id }}" class="text-gray-600">{{ $tag->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- 検索ボタン -->
            <div>
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition duration-300">検索</button>
            </div>
        </form>
    </div>
</x-app-layout>
