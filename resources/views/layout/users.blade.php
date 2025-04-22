<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Hebat</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-300">
    <!-- Navbar Item -->
    <div class="flex justify-between items-center flex-col md:flex-row bg-gray-900 text-gray-300">
        <div class="col m-8 font-medium text-5xl">
            <p>@yield('title')</p>
        </div>
        <div class="col m-8 font-medium">
            <ul class="flex">
                <li class="pr-4"><a href="/">Home</a></li>
                <li class="px-4"><a href="/room">Kamar</a></li>
                <li class="px-4"><a href="/transaction">Riwayat reservasi</a></li>
                <li class="pl-4">
                    @if (session()->has('user_id'))
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">logout</button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-10 mt-100">
        <div class="container mx-auto px-6 lg:px-20">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <div>
                    <img src="img/hotel_logo.png" class="h-6">
                    <p class="text-sm">Hotel premium yang memberikan pengalaman menginap terbaik dengan pelayanan bintang lima.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Navigasi</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white">Kamar & Suite</a></li>
                        <li><a href="#" class="hover:text-white">Restoran</a></li>
                        <li><a href="#" class="hover:text-white">Fasilitas</a></li>
                        <li><a href="#" class="hover:text-white">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Hubungi Kami</h3>
                    <p class="text-sm">📍Jalan Hotel Mewah No. 1, Jakarta</p>
                    <p class="text-sm">📞 +62 812 3456 7890</p>
                    <p class="text-sm">✉️ info@hotel.com</p>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <img src="img/facebook.png" class="w-6">
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <img src="img/instagram.png" class="w-6">
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <img src="img/instagram.png" class="w-6">
                        </a>
                    </div>
                </div>
                <div class="md:col-span-3 lg:col-span-1 text-center md:text-left">
                    <h3 class="text-lg font-semibold text-white mb-4">Kebijakan</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white">Privasi</a></li>
                        <li><a href="#" class="hover:text-white">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-white">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center border-t border-gray-700 mt-8 pt-6 text-sm">
                © 2025 Hotel Hebat. Semua Hak Dilindungi.
            </div>
        </div>
    </footer>
</body>

</html>