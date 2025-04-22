<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body>
@foreach ( $history as $data )
    <div class="font-semibold text-5xl flex justify-center">
        <p>Reservasi Hotel Hebat Atas Nama {{ $data['name'] }} </p>
    </div>
    <div class="font-semibold text-2xl flex justify-start">
        Tanggal : {{ \Carbon\Carbon::parse($data['check_in'])->format('d M Y') }} - {{ \Carbon\Carbon::parse($data['check_out'])->format('d M Y') }} <hr>
        Nomor Kamar :{{ $data['room_id'] }}<hr>
        Total Harga :{{ $data['total_price'] }}<hr>
        Tipe Kamar :{{ $data['room_type'] }}<hr>
    </div>
@endforeach
</body>
</html>