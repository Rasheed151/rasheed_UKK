<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Hebat</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white">
    <!-- Navbar Item -->
    <div class="flex justify-between items-center flex-col md:flex-row bg-gray-900 text-gray-300">
        <div class="col m-8 font-medium text-5xl">
            <p>@yield('title')</p>
        </div>
        <div class="col m-8 font-medium">
            <ul class="flex">
                <li class="pr-4"><a href="/">Home</a></li>
                <li class="px-4"><a href="/">Home</a></li>
                <li class="px-4"><a href="/">Home</a></li>
                <li class="pl-4"><a href="/">Home</a>
                    @if (session()->has('user_id'))
                    <form action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">logout</button>
                    </form>
                    @endif
                </li>
            </ul>
        </div>
    </div>
    @yield('content')
</body>

</html>