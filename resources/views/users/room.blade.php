@extends('layout.gray')
@section('title','Kamar')
@section('content')
<!-- Form Check-in Check-out--->
<div class="nav mx4 my-8">
    <div class="title flex justify-center text-2xl font-semibold">
        <p>Tanggal Reservasi</p>
    </div>
    <form method="GET" action="{{ route('room.index') }}">
        <div class="col flex flex-row">
            <div class="w-1/2 m-4 bg-white rounded-sm">
                <input type="date" id="check_in" name="check_in"
                    min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                    value="{{ old('check_in', $check_in ?? '') }}"
                    class="mt-2 block w-full p-3 border border-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <p class="text-2xl font-semibold m-2 mt-4">Sampai</p>
            <div class="w-1/2 m-4 bg-white rounded-sm">
                <input type="date" id="check_out" name="check_out"
                    min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}"
                    value="{{ old('check_out', $check_out ?? '') }}"
                    class="mt-2 block w-full p-3 border border-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
        </div>
    </form>
</div>
</div>


<!-- Room Card-->
@foreach ($room_detail as $detail)
@if ($detail['available'])
<div class="nav bg-white mt-8 m-4 rounded-sm justify-center p-4 flex flex-col md:flex-row">
    <div class="nav m-4 w-1/3">
        <div class="font-semibold text-2xl my-2">
            {{ $detail['type']}} Room
        </div>
        <div>
            <img src="img/image2.jpg" class="rounded-lg">
        </div>
    </div>
    <div class="nav w-2/3 m-4 mt-16">
        <table class="w-full border-collapse border border-gray-300 text-left">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="p-3 border border-gray-400 text-center align-middle">Harga</th>
                    <th class="p-3 border border-gray-400 text-center align-middle">Jumlah Orang</th>
                    <th class="p-3 border border-gray-400 text-center align-middle">Tempat Tidur & Fasilitas</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-gray-100">
                    <td class="p-3 border border-gray-400 text-center align-middle">
                        Rp. {{ $detail['price']}}
                    </td>
                    <td class="p-3 border border-gray-400 text-center align-middle">
                        {{ $detail['capacity']}} Orang
                    </td>
                    <td class="p-3 border border-gray-400 text-center align-middle">
                        {{ $detail['bed']}}
                        @foreach ($detail['detail'] as $item)
                        <p>{{ $item }}</p>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="flex justify-end mt-8">
            <a href="#"
                data-type-id="{{ $detail['id'] }}"
                class="booking-btn bg-[#06402B] p-2 rounded-sm font-normal text-white">
                Pemesanan
            </a>
        </div>
    </div>
</div>
@endif
@endforeach

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

<script>
    const check_in = document.getElementById('check_in');
    const check_out = document.getElementById('check_out');
    const form = check_out.closest('form');


    check_in.addEventListener('change', function() {
        const tgl1 = new Date(this.value);
        if (isNaN(tgl1)) return;

        tgl1.setDate(tgl1.getDate() + 1);
        const minTgl2 = tgl1.toISOString().split('T')[0];
        check_out.min = minTgl2;
        if (check_out.value && check_out.value < minTgl2) {
            check_out.value = '';
        }
    });


    document.querySelectorAll('.booking-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();

            const tgl1 = document.getElementById('check_in').value;
            const tgl2 = document.getElementById('check_out').value;
            const typeId = this.getAttribute('data-type-id');

            if (!tgl1 || !tgl2) {
                alert('Silakan pilih tanggal check-in dan check-out terlebih dahulu.');
                return;
            }

            const url = `/booking?type_id=${typeId}&check_in=${encodeURIComponent(tgl1)}&check_out=${encodeURIComponent(tgl2)}`;
            window.location.href = url;
        });
    });

    check_out.addEventListener('change', function() {
        if (this.value) {
            form.submit(); 
        }
    });
</script>

@endsection