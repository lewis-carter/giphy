<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <title>Giphy</title>
</head>

<body>

    <nav class="flex justify-center items-center py-4 bg-gray-900">
        <form action="{{ route('search.index') }}" method="get" class="mr-10 flex rounded overflow-hidden">
            <input type="text" name="search" placeholder="Search Giphy" class="py-2 px-4">
            <button type="submit" class="p-2 bg-gray-800 text-white">Go!</button>
        </form>

        <a href="/" class="mx-4 text-white">Trending Giphy Gifs</a>
        <a href="/random" class="mx-4 text-white">Random Giphy Gifs</a>
        <a href="/modified" class="mx-4 text-white">Random Stored Gifs</a>
    </nav>

    

    @yield('content')

</body>

</html>