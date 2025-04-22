@extends('layout.users')
@section('title','Riwayat Reservasi')
@section('content')
@if(session('success'))
<div class="bg-green-200 text-green-800 px-4 py-2 rounded m-4">{{ session('success') }}</div>
@endif
@if(session('error'))
<div class="bg-red-200 text-red-800 px-4 py-2 rounded m-4">{{ session('error') }}</div>
@endif
@foreach ( $history as $data )

<div class="nav rounded-sm bg-white m-16 mt-4 shadow-md">
    <div class="header mx-4 py-2 flex items-center justify-between">
        <p class="font-bold">{{ $data['name'] }}</p>
        @if ($data['payment_status'] == "Pending")
        <p class="py-1 px-2 rounded-sm bg-green-300 mx-8 font-medium">Pending</p>
        @elseif($data['payment_status'] == "Cancelled")
        <p class="py-1 px-2 rounded-sm bg-red-300 mx-8 font-medium">Dibatalkan</p>
        @endif
    </div>
    <div class="content border-y-1 border-black flex justify-between font-medium">
        <div class="left mx-8 py-4">
            <p class="pb-8">Tipe Kamar : {{ $data['room_type'] }}</p>
            <p>Nomor Kamar : {{$data['room_id']}}</p>
        </div>
        <div class="right  mx-8 py-4">
            <div class="top pb-8">{{ \Carbon\Carbon::parse($data['check_in'])->format('d M Y') }} - {{ \Carbon\Carbon::parse($data['check_out'])->format('d M Y') }} </div>
            <div class="bottom">{{$data['payment_method']}} Total Harga : Rp.{{ number_format($data['total_price'], 0, ',', '.') }}</div>
        </div>
    </div>
    <div class="footer mx-8 flex justify-end py-2">
        @if ($data['payment_status'] == "Pending")
        <form action="{{ route('transaction.update', $data['transaction_id']) }}" method="POST">
            @csrf
            @method('PUT')
            <input name="payment_status" value="cancelled" hidden>
            <button type="submit" class="p-1 rounded-sm font-normal text-red-500 border-2 mx-4">Batalkan</button>
        </form>
        <a href="{{ route('print', $data['transaction_id']) }}"
            class="bg-[#06402B] px-2 py-1 rounded-lg font-medium text-white">
            Cetak data
        </a>
        @else
        <div class="p-1 rounded-sm font-normal text-red-500 border-2 mx-4">
            <p>Dibatalkan</p>
        </div>
        @endif
    </div>
</div>

@endforeach
@endsection