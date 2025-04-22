@extends('layout.users')
@section('title','Kamar')
@section('content')
<!-- Form Check-in Check-out--->
<div class="nav mx-4 my-8">
    <div class="title flex justify-center text-2xl font-semibold">
        <p>Tanggal Reservasi</p>
    </div>
    <form method="GET" action="{{ route('room.index') }}">
        <div class="col flex flex-row">
            <div class="w-1/2 m-2">
                <input type="date" id="tanggal1" name="tanggal1"
                    min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                    value="{{ old('tanggal1', $tanggal1 ?? '') }}"
                    class="mt-2 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <p class="text-2xl font-semibold m-2 mt-4">Sampai</p>
            <div class="w-1/2 m-2">
                <input type="date" id="tanggal2" name="tanggal2"
                    min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}"
                    value="{{ old('tanggal2', $tanggal2 ?? '') }}"
                    class="mt-2 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
        </div>
    </form>
</div>

@foreach ($room_detail as $detail)
@if ($detail['available'])
<div class="nav bg-white mt-8 m-4 rounded-sm justify-center p-4 flex flex-col md:flex-row">
    <div class="nav m-4 w-1/3">
        <div class="font-semibold text-2xl my-2">
            {{ $detail['type'] ?? 'Data tidak ditemukan' }} Room
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
                        Rp. {{ $detail['price'] ?? 'Data tidak ditemukan' }}
                    </td>
                    <td class="p-3 border border-gray-400 text-center align-middle">
                        {{ $detail['capacity'] ?? 'Data tidak ditemukan' }} Orang
                    </td>
                    <td class="p-3 border border-gray-400 text-center align-middle">
                        {{ $detail['bed'] ?? 'Data tidak ditemukan' }}
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



<script>
    const tanggal1 = document.getElementById('tanggal1');
    const tanggal2 = document.getElementById('tanggal2');
    const form = tanggal2.closest('form');

    const besok = new Date();
    besok.setDate(besok.getDate() + 1);

    tanggal1.addEventListener('change', function() {
        const tgl1 = new Date(this.value);
        if (isNaN(tgl1)) return;

        tgl1.setDate(tgl1.getDate() + 1);
        const minTgl2 = tgl1.toISOString().split('T')[0];
        tanggal2.min = minTgl2;

        if (tanggal2.value && tanggal2.value < minTgl2) {
            tanggal2.value = '';
        }
    });


    document.querySelectorAll('.booking-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();

            const tgl1 = document.getElementById('tanggal1').value;
            const tgl2 = document.getElementById('tanggal2').value;
            const typeId = this.getAttribute('data-type-id');

            if (!tgl1 || !tgl2) {
                alert('Silakan pilih tanggal check-in dan check-out terlebih dahulu.');
                return;
            }

            const url = `/booking?type_id=${typeId}&check_in=${encodeURIComponent(tgl1)}&check_out=${encodeURIComponent(tgl2)}`;
            window.location.href = url;
        });
    });

    tanggal2.addEventListener('change', function() {
        if (this.value) {
            form.submit();
        }
    });
</script>

@endsection