<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class secondAdminController extends Controller
{
    private $rooms = "http://localhost:3000/rooms";
    public function destroy($id)
    {
        $response = Http::delete($this->rooms, ['id' => $id]);

        if ($response->successful()) {
            return redirect()->route('admin.index')->with('success', 'Data berhasil dihapus');
        }

        return back()->with('error', 'Gagal menghapus data');
    }

    public function store(Request $request)
    {
        $response = Http::post($this->rooms, [
            'type_id' => $request->type_id,
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.index')->with('success', 'Data berhasil ditambahkan');
        }

        return back()->with('error', 'Gagal menambahkan data');
    }
    public function update(Request $request, $id)
    {
        $response = Http::put($this->rooms, [
            'id'=>$id,
            'status' => $request->status,
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.index')->with('success', 'Data berhasil diperbarui');
        }

        return back()->with('error', 'Gagal memperbarui data');
    }
}
