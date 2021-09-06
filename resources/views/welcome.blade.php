<x-app-layout>
    <x-slot name-"header">
        <h2 class="font-semibold text-xl">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <x-post-list :posts="$posts"/>
</x-app-layout>