@extends('layout.app')

@section('content')

<form action="{{ route('modified.search') }}" method="get">
    <input type="text" name="search">
    <button type="submit">Go!</button>
</form>

@foreach ($gifs as $gif)
    <h2>{{ $gif->title }}</h2>
    
    <img src="{{ $gif->url }}" alt="{{ $gif->title }}">
@endforeach

@if ($gifs->previousPageUrl())
    <a href="{{ $gifs->previousPageUrl() }}">Previous Page</a>
@endif

@if ($gifs->nextPageUrl())
    <a href="{{ $gifs->nextPageUrl() }}">Next Page</a>
@endif

@endsection