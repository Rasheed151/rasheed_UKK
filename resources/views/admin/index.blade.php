<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body>
    <div class="m-8">
        <div class="flex justify-end">
        <Button class="bg-[#06402B] p-2 rounded-sm font-normal text-white">Tambah Tipe Kamar</Button>
        </div>
    <table class="w-full border-collapse border border-gray-300 text-left bg">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="p-3 border border-gray-400 text-center align-middle">Tipe Kamar</th>
                <th class="p-3 border border-gray-400 text-center align-middle">Harga/malam</th>
                <th class="p-3 border border-gray-400 text-center align-middle">Kapasitas Kamar</th>
                <th class="p-3 border border-gray-400 text-center align-middle">Jenis Kasur</th>
                <th class="p-3 border border-gray-400 text-center align-middle">Fasilitas Kamar</th>
                <th class="p-3 border border-gray-400 text-center align-middle">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($room_detail as $detail)
                <td class="p-3 border border-gray-400 text-center align-middle">
                    {{ $detail['type']}}
                </td>
                <td class="p-3 border border-gray-400 text-center align-middle">
                    Rp. {{ $detail['price']}}
                </td>
                <td class="p-3 border border-gray-400 text-center align-middle">
                    {{ $detail['capacity']}} Orang
                </td>
                <td class="p-3 border border-gray-400 text-center align-middle">
                    {{ $detail['bed']}}
                </td>
                <td class="p-3 border border-gray-400 text-center align-middle">
                @foreach ($detail['detail'] as $item)
                <p>{{ $item }}</p>
                @endforeach
                </td>
                <td class="p-3 border border-gray-400 text-center align-middle">
                    <p>Hapus</p>
                    <p>Ubah</p>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
    </div>
</body>

</html>