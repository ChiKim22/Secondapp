<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Show') }}
            </h2>
            <button onclick=location.href="{{ route('posts.index') }}" 
            type="button" 
            class="btn btn-info hover:bg-blue-700 font-bold text-white">Back</button>
        </div>
    </x-slot>
    <x-posts-show :post="$post"/>
</x-app-layout>