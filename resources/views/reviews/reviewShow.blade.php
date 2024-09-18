<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-5xl font-semibold mb-4">{{ $shop->name }}</h1>
        
        <h2 class="text-xl text-gray-700 m-4">＜　全ての口コミ　＞</h2>
        <a href="{{ route('shops.show', ['shop' => $shop->id]) }}" 
           class="inline-block px-6 py-3 m-4 text-white bg-gray-500 rounded-lg shadow-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 transition duration-300 ease-in-out">
           店詳細ページに戻る
        </a>
        @foreach($reviews as $review)
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <p class="text-gray-900 font-medium">投稿者：{{ $review->user->name }}</p>
                <p class="text-gray-800 mt-2">{{ $review->body }}</p>
                <p class="text-gray-600 mt-2">👍の数：{{ $review->likes_count }}</p>
                <form action="/reviews/{{ $review->id }}/like" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                        @if($review->likeBy(Auth::user()))
                            👍を消す
                        @else
                            👍
                        @endif
                    </button>
                </form>
                @if($review->review_image_url)
                    <img src="{{ $review->review_image_url }}" alt="口コミの画像" class="mt-4 max-w-full h-auto rounded-lg">
                @endif
            </div>
        @endforeach
    </div>
</x-app-layout>
