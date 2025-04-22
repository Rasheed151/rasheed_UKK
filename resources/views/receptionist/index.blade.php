@extends('layout.nonUsers')
@section('title','Resepsionis')
@section('content')
<div class="flex justify-center text-3xl my-4 font-semibold">
    <p>Sortir Data Reservasi</p>
</div>
<form method="GET" action="{{ route('receptionist.index') }}">
    <div class="col flex-row flex justify-center">
        <div class="w-1/3 mx-2">
            <label for="name" class="text-2xl font-medium">Nama Reservasi:</label>
            <input type="text" name="name" value="{{ request('name') }}" placeholder="Cari nama..."
                class="mt-2 block w-full p-3 border border-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>
        <div class="w-1/3 mx-2">
            <label for="start_date" class="text-2xl font-medium">Dari Tanggal:</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}"
                class="mt-2 block w-full p-3 border border-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>
        <div class="w-1/3 mx-2">
            <label for="end_date" class="text-2xl font-medium">Sampai Tanggal:</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}"
                class="mt-2 block w-full p-3 border border-white rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
        </div>
    </div>
    <div class="m-2 justify-center flex">
        <button type="submit" class="bg-blue-500 px-2 py-1 text-2xl rounded-sm mx-4">Sortir</button>
        <a href="{{ route('receptionist.index') }}"
            class="bg-blue-500 px-2 py-1 text-2xl rounded-sm mx-4">Hapus Sortir</a>
    </div>
</form>
@foreach ( $transaction as $data )

<div class="nav rounded-sm bg-white m-16 mt-4 shadow-md">
    <div class="header mx-4 py-2 flex items-center justify-between">
        <p class="font-bold">{{ $data['name'] }}</p>
        @if ($data['payment_status'] == "Pending")
        <p class="py-1 px-2 rounded-sm bg-green-300 mx-8 font-medium">Terunda</p>
        @elseif($data['payment_status'] == "Cancelled")
        <p class="py-1 px-2 rounded-sm bg-red-300 mx-8 font-medium">Dibatalkan</p>
        @else
        <p class="py-1 px-2 rounded-sm bg-green-300 mx-8 font-medium">Selesai</p>
        @endif
    </div>
    <div class="content border-y-1 border-black flex justify-between font-medium">
        <div class="left mx-8 py-4">
            <p class="pb-8">Tipe Kamar : </p>
            <p>Nomor Kamar : {{$data['room_id']}}</p>
        </div>
        <div class="right  mx-8 py-4">
            <div class="top pb-8">{{ \Carbon\Carbon::parse($data['check_in'])->format('d M Y') }} - {{ \Carbon\Carbon::parse($data['check_out'])->format('d M Y') }} </div>
            <div class="bottom">{{$data['payment_method']}} Total Harga : Rp.{{ number_format($data['total_price'], 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="footer mx-8 flex justify-end py-2">
        @if ($data['payment_status'] == "Pending")
        <form action="{{ route('receptionist.update', $data['transaction_id']) }}" method="POST">
            @csrf
            @method('PUT')
            <input name="payment_status" value="cancelled" hidden>
            <button type="submit" class="booking-btn p-1 rounded-sm font-normal text-red-500 border-2 mx-4">Batalkan</button>
        </form>
        <form action="{{ route('receptionist.update', $data['transaction_id']) }}" method="POST">
            @csrf
            @method('PUT')
            <input name="payment_status" value="paid" hidden>
            <button type="submit" class="booking-btn p-1 rounded-sm font-normal text-green-500 border-2 mx-4">Selesai</button>
        </form>

        @elseif ($data['payment_status'] == "Paid")
        <form action="{{ route('receptionist.update', $data['transaction_id']) }}" method="POST">
            @csrf
            @method('PUT')
            <input name="payment_status" value="pending" hidden>
            <button type="submit" class="booking-btn p-1 rounded-sm font-normal text-red-500 border-2 mx-4">Tunda Kembali</button>
        </form>
        @else
        <form action="{{ route('receptionist.update', $data['transaction_id']) }}" method="POST">
            @csrf
            @method('PUT')
            <input name="payment_status" value="pending" hidden>
            <button type="submit" class="booking-btn p-1 rounded-sm font-normal text-green-500 border-2 mx-4">Tunda Kembali</button>
        </form>
        @endif
    </div>
</div>

@endforeach
@endsection