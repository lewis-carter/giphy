<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giphy</title>
</head>

<body>

    <form action="{{ route('search.index') }}" method="get">
        <input type="text" name="search">
        <button type="submit">Go!</button>
    </form>

    @yield('content')

</body>

</html>