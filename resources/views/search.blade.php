@extends('layout.app')

@section('content')

@foreach ($gifs as $gif)
    <h2>{{ $gif['title'] }}</h2>
    
    <img src="{{ $gif['images']['downsized']['url'] }}" alt="{{ $gif['title'] }}">
@endforeach

@endsection