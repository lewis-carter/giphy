<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giphy</title>
</head>

<body>
@foreach ($gifs as $gif)
    <h2>{{ $gif['title'] }}</h2>
    
    <img src="{{ $gif['images']['downsized']['url'] }}" alt="{{ $gif['title'] }}">
@endforeach

</body>

</html>