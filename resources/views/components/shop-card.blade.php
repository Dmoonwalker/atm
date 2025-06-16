@php
$isLiked = auth()->check() ? $shop->likedBy(auth()->user()) : false;
@endphp

<div class="flex items-center gap-2">
    <button
        x-data="{
            liked: {{ $isLiked ? 'true' : 'false' }},
            likesCount: {{ $shop->likes_count }},
            async toggleLike() {
                const response = await fetch('{{ route('shops.like.toggle', $shop) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });
                const data = await response.json();
                this.liked = data.is_liked;
                this.likesCount = data.likes_count;
            }
        }"
        :class="liked ? 'text-red-500' : 'text-gray-400'"
        @click="toggleLike"
        class="focus:outline-none"
        title="Like this shop"
        type="button">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
            <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
        </svg>
    </button>
    <span x-text="likesCount"></span>
</div>