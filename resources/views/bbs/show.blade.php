<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Show') }}
            </h2>
            {{-- ({{ $post->likes }}) --}}
            {{-- lazy loding 접근할때만 데이터를 가져옴 
                 laravel은 기본적으로 lazy loding 이다. (likes) --}}
            <button onclick=location.href="{{ route('posts.index') }}" 
            type="button" 
            class="btn btn-info hover:bg-blue-700 font-bold text-white">Back 
        </button>
        </div>
    </x-slot>
    <x-posts-show :post="$post"/>
</x-app-layout>