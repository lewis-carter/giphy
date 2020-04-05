@extends('layout.app')

@section('content')

<div class="container mx-auto">
    <div class="flex flex-wrap -mx-4">
        @foreach ($gifs as $gif)
        <div class="w-1/4 px-4 mt-8">
            <div class="rounded">
                <h2 class="bg-gray-900 text-white p-4 truncate">{{ $gif['title'] }}</h2>
                <img src="{{ $gif['url'] }}" alt="{{ $gif['title'] }}" class="h-64 w-full object-contain bg-black">
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection