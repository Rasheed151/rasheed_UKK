@extends('layout.nonUsers')
@section('title','Admin')
@section('content')
<div class="m-8">
    <div class="flex justify-end">
        <a href="{{ route('admin.create') }}" class="bg-[#06402B] p-2 rounded-sm font-normal text-white">Tambah Tipe Kamar</a>
        @if(session('success'))
        <p>{{ session('success') }}</p>
        @endif
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
                <a href="{{ route('admin.edit', $detail['id']) }}">Edit</a>
                <form action="{{ route('admin.destroy', $detail['id']) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin?')">Hapus</button>
                </form>
            </td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>


<div class="m-8">
    <div class="flex justify-Center">
        @if(session('success'))
        <p>{{ session('success') }}</p>
        @elseif(session('error'))
        <p>{{ session('error') }}</p>
        @endif
    </div>
    <div>
        <p>Tambahkan Kamar</p>
        <form action="{{ route('adminRoom.store') }}" method="POST">
            @csrf
            <label>Price:
                <select name="type_id">
                    @foreach ($room_detail as $rd )
                    <option value="{{ $rd['id'] }}">{{ $rd['type'] }}</option>
                    @endforeach
                </select></label><br>
            <button type="submit">Simpan</button>
        </form>
    </div>
    <table class="w-full border-collapse border border-gray-300 text-left bg">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="p-3 border border-gray-400 text-center align-middle">Nomor Kamar</th>
                <th class="p-3 border border-gray-400 text-center align-middle">Tipe Kamar</th>
                <th class="p-3 border border-gray-400 text-center align-middle">Status Kamar</th>
                <th class="p-3 border border-gray-400 text-center align-middle">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($room as $data)
            <td class="p-3 border border-gray-400 text-center align-middle">
                {{ $data['id']}}
            </td>
            <td class="p-3 border border-gray-400 text-center align-middle">
                {{ $data['type_id']}}
            </td>
            <td class="p-3 border border-gray-400 text-center align-middle">
                {{ $data['status'] ? 'Aktif' : 'Non-Aktif'}}
            </td>
            <td class="p-3 border border-gray-400 text-center align-middle">
                @if ($data['status'] == 1)
                <form action="{{ route('adminRoom.update', $data['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input name="status" value="0" hidden>
                    <button type="submit">Non-Aktifkan</button>
                </form>
                @elseif($data['status'] == 0)
                <form action="{{ route('adminRoom.update', $data['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input name="status" value=1 hidden>
                    <button type="submit">Aktifkan</button>
                </form>
                @endif
                <form action="{{ route('adminRoom.destroy', $data['id']) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin?')">Hapus</button>
                </form>
            </td>
            </tr>
        </tbody>
        @endforeach
    </table>
</div>
@endsection