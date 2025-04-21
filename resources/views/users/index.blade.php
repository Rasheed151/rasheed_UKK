<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body class="bg-gray-300">


    <!-- Bagian Pertama -->
    <div class="nav justify-center items-center m-8 mt-12 p-2 bg-white flex-col md:flex-row rounded-sm">
        <div class="container">
            <div class="flex justify-between items-center flex-col md:flex-row">
                <div class="col m-8 font-bold text-5xl">
                    <p>HOTEL HEBAT</p>
                </div>
                @if (session()->has('user_id'))
                <span class="mx-2">Halo, {{ session('user_name') }}</span>
                @else
                <span class="mx-2">Selamat, Datang</span>
                @endif
                <div class="col m-8 font-medium">
                    <ul class="flex">
                        <li class="pr-4 border-r-2 border-r-black"><a href="/">Home</a></li>
                        <li class="px-4 border-r-2 border-r-black"><a href="/">Kamar</a></li>
                        <li class="px-4 border-r-2 border-r-black"><a href="/">Riwayat transaksi</a></li>
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
            <div class="row m-8">
                <div class="col h-100 overflow-hidden rounded-sm">
                    <img src="img/image2.jpg" class="w-full">
                </div>
            </div>
        </div>
    </div>

    <!-- Bagian Kedua -->
    <div class="nav bg-white mt-8 m-4 rounded-sm justify-center p-4">
        <div class="m-4">
            <div class="col font-bold text-5xl mb-8">
                <p>Fasilitas</p>
            </div>
            <div class="row mt-4 flex justify-center flex-col md:flex-row">
                <div class="col h-60 overflow-hidden rounded-sm m-4">
                    <img src="img/image2.jpg" class="w-full md:auto">
                </div>
                <div class="col h-60 overflow-hidden rounded-sm m-4">
                    <img src="img/image2.jpg" class="w-full md:auto">
                </div>
                <div class="col h-60 overflow-hidden rounded-sm m-4">
                    <img src="img/image2.jpg" class="w-full md:auto">
                </div>
            </div>
        </div>
        <div class="m-4">
            <div class="col font-bold text-5xl mb-8">
                <p>Tentang Kami</p>
            </div>
            <div class="row m-8">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod illo sit cupiditate ducimus saepe itaque optio neque fugit asperiores vero, aliquam doloribus deserunt at placeat soluta nihil quas quisquam! Id doloribus molestiae tempora totam sit. Numquam perferendis animi perspiciatis dolorem nemo nulla sint placeat facere saepe voluptatibus quasi eaque, aspernatur quod accusamus totam fuga dignissimos veniam nesciunt et! Eveniet, repudiandae mollitia est error dolorem voluptatem quod quae sunt! Ad nemo atque numquam in beatae, dolorum deserunt! Sed officiis quis alias exercitationem sequi minima beatae repellendus autem veritatis. Animi pariatur ex, cumque dolore sunt mollitia hic quidem dolorem molestias corporis inventore?</p>
            </div>
        </div>
    </div>

    <!-- Bagian Ketiga -->
    <div class=" justify-center items-center m-8 mt-12 p-2 bg-white flex-col md:flex-row rounded-sm">
        <div class="col font-bold text-5xl my-8 mx-4">
            <p>Lokasi & Destinasi Wisata Terdekat</p>
        </div>
        <div class="flex justify-between items-center flex-col md:flex-row m-4">
            <div class="rounded-sm justify-start">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.602703639476!2d107.88994747443898!3d-7.171839970375026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68b1b5bc176cc1%3A0x99cce91e3246efa5!2sIn%20Situ%20Hotel%20Garut!5e0!3m2!1sen!2sid!4v1743226920112!5m2!1sen!2sid"
                    width="600"
                    height="450"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <div class="rounded-sm bg-gray-100 mx-8 w-full">
                <div class="nav p-2 text-white rounded-sm bg-blue-500 font-medium">
                    <p>Destinasi Wisata</p>
                </div>
                <ul class="mx-2">
                    <li class="flex items-center my-5 gap-2">
                        <img src="img/map-icon.png" class="w-5">
                        <p>Lorem Ipsum</p>
                    </li>
                    <li class="flex items-center my-5 gap-2">
                        <img src="img/map-icon.png" class="w-5">
                        <p>Lorem Ipsum</p>
                    </li>
                    <li class="flex items-center my-5 gap-2">
                        <img src="img/map-icon.png" class="w-5">
                        <p>Lorem Ipsum</p>
                    </li>
                    <li class="flex items-center my-5 gap-2">
                        <img src="img/map-icon.png" class="w-5">
                        <p>Lorem Ipsum</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-10">
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