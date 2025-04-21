<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
@foreach ( $transaction as $data )

<div class="nav rounded-sm bg-white m-16 mt-4 shadow-md">
    <div class="header mx-4 py-2 flex items-center justify-between">
        <p class="font-bold">{{ $data['name'] }}</p>
        <p class="py-1 px-2 rounded-sm bg-green-300 mx-8 font-medium">Pending</p>
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
        <form action="" method="POST">
            @csrf
            @method('PUT')
            <input type="text" value="{{ $data['transaction_id'] }}" hidden>
            <input type="text" value="cancelled" hidden>
            <button type="submit" class="booking-btn p-1 rounded-sm font-normal text-red-500 border-2 mx-4">Batalkan</button>
        </form>
        @elseif ($data['payment_status'] == "Paid")
        <span class="badge bg-success">Paid</span>
        @elseif ($data['payment_status'] == "Cancelled")
        <span class="badge bg-secondary">Dibatalkan</span>
        @endif
        <button class="bg-[#06402B] px-2 py-1 rounded-lg font-medium text-white">Detail Pemesanan</button>
    </div>
</div>

@endforeach
</body>
</html>