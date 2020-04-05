@extends('layout.app')

@section('content')

<div class="container mx-auto">
    <form action="{{ route('modified.search') }}" method="get" class="mt-10 shadow border border-gray-900 inline-flex rounded overflow-hidden">
        <input type="text" name="search" placeholder="Search Stored Gifs" class="py-2 px-4">
        <button type="submit" class="p-2 bg-gray-800 text-white">Go!</button>
    </form>

    <div class="flex flex-wrap -mx-4">
        @foreach ($gifs as $gif)
        <div class="w-1/4 px-4 mt-8">
            <div class="rounded">
                <h2 class="bg-gray-900 text-white p-4 truncate">{{ $gif->title }}</h2>
                
                <img src="{{ $gif->url }}" alt="{{ $gif->title }}" class="h-64 w-full object-contain bg-black">
            </div>
        </div>
        @endforeach
    </div>

    <div class="my-20 flex justify-center">
        @if ($gifs->previousPageUrl())
            <a href="{{ $gifs->previousPageUrl() }}" class="mx-4 px-4 py-2 bg-gray-900 text-white rounded">Previous Page</a>
        @endif
    
        @if ($gifs->nextPageUrl())
            <a href="{{ $gifs->nextPageUrl() }}" class="mx-4 px-4 py-2 bg-gray-900 text-white rounded">Next Page</a>
        @endif
    </div>
    
</div>



@endsection