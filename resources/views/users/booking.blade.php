@extends('layout.gray')
@section('title','Reservasi Kamar')
@section('content')
<div class="nav rounded-lg bg-white m-8">
    <div class="nav my-4 border-b-2 p-4">
        <div class="title text-5xl">
            <p>Pemesanan</p>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-200 text-green-800 px-4 py-2 rounded m-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="bg-red-200 text-red-800 px-4 py-2 rounded m-4">{{ session('error') }}</div>
    @endif

    <div class="col">
        <form action="{{ url('/booking') }}" method="POST">
            @csrf
            <div class="col flex flex-row">
                <div class="row m-4 w-1/2">
                    <label for="name" class="block m-2">Nama Reservasi</label>
                    <input type="text" name="name" placeholder="Rasheed Muhyiddien"
                        class="m-2 w-full p-4 border border-gray-300 rounded-lg  focus:ring-blue-500 sm:text-sm">
                </div>
                <div class="row m-4 w-1/2">
                    <label for="phone_number" class="block m-2">Nomor Telepon</label>
                    <input type="number" name="phone_number" placeholder="Contoh : +62123456789"
                        class="m-2 w-full p-4 border border-gray-300 rounded-lg  focus:ring-blue-500 sm:text-sm">
                </div>
            </div>

            <div class="col flex flex-row">
                <div class="row m-4 w-1/2">
                    <label class="block text-sm font-medium text-gray-700">Nomor Kamar</label>
                    <div class="mt-2 w-full p-4 border border-gray-300 rounded-lg bg-gray-100 text-gray-700">
                        Kamar {{ $selected_room_id }}
                    </div>
                    <input type="hidden" name="room_id" value="{{ $selected_room_id }}">
                </div>
                <div class="row m-4 w-1/2">
                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                    <select name="payment_method" required
                        class="mt-2 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="cash">Cash</option>
                        <option value="ewallet">E-Wallet</option>
                    </select>
                </div>
            </div>

            <div class="col flex flex-row">
                <div class="row m-4 w-1/2">
                    <label class="block m-2">Tanggal Check-In</label>
                    <div class="m-2 w-full p-4 border border-gray-300 rounded-lg bg-gray-100 text-gray-700">
                        {{ $check_in }}
                    </div>
                    <input type="hidden" name="check_in" value="{{ $check_in }}">
                </div>
                <div class="text-2xl font-semibold mt-16">
                    <p class="mx-2">Sampai</p>
                </div>
                <div class="row m-4 w-1/2">
                    <label class="block m-2">Tanggal Check-Out</label>
                    <div class="m-2 w-full p-4 border border-gray-300 rounded-lg bg-gray-100 text-gray-700">
                        {{ $check_out }}
                    </div>
                    <input type="hidden" name="check_out" value="{{ $check_out }}">
                </div>
            </div>


            <div class="row m-4 w-1/2">
                <label class="block text-sm font-medium text-gray-700">Total Harga</label>
                <div class="mt-2 w-full p-4 border border-gray-300 rounded-lg bg-gray-100 text-gray-700">
                    Rp {{ number_format($total_price, 0, ',', '.') }} untuk {{ $nights }} malam
                </div>
                <input type="hidden" name="total_price" value="{{ $total_price }}">
            </div>


            <div class="footer flex justify-end border-t-2 my-4">
                <div class="m-4">
                    <button class="bg-[#06402B] px-4 py-2 rounded-lg font-semibold text-white text-xl">Pesan Sekarang</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Data Transaksi (hasil read API) -->
    <!-- <div class="m-4">
        <h2 class="text-2xl font-bold mb-2">Data Transaksi</h2>
        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Kamar</th>
                    <th class="border px-4 py-2">Check-in</th>
                    <th class="border px-4 py-2">Check-out</th>
                    <th class="border px-4 py-2">Total</th>
                    <th class="border px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaction as $t)
                    <tr>
                        <td class="border px-4 py-2">{{ $t['transaction_id'] }}</td>
                        <td class="border px-4 py-2">{{ $t['name'] ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $t['room_id'] }}</td>
                        <td class="border px-4 py-2">{{ $t['check_in'] }}</td>
                        <td class="border px-4 py-2">{{ $t['check_out'] }}</td>
                        <td class="border px-4 py-2">{{ $t['total_price'] }}</td>
                        <td class="border px-4 py-2">{{ $t['payment_status'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> -->
</div>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const checkIn = urlParams.get('check_in');
        const checkOut = urlParams.get('check_out');

        if (checkIn) document.getElementById('check_in').value = checkIn;
        if (checkOut) document.getElementById('check_out').value = checkOut;
    });
</script>

@endsection