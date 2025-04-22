<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class adminController extends Controller
{
    private $room_details = "http://localhost:3000/room-details";
    private $rooms = "http://localhost:3000/rooms";

    public function index()
    {
        $room_detail = Http::get($this->room_details)->json();
        $room = Http::get($this->rooms)->json();

        return view('admin.index', compact('room_detail','room'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $response = Http::post($this->room_details, [
            'type' => $request->type,
            'price' => $request->price,
            'capacity' => $request->capacity,
            'bed' => $request->bed,
            'detail' => explode(',', $request->detail),
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.index')->with('success', 'Data berhasil ditambahkan');
        }

        return back()->with('error', 'Gagal menambahkan data');
    }


    public function edit($id)
    {
        $room_detail = Http::get("{$this->room_details}/{$id}")->json();

        return view('admin.edit', compact('room_detail'));
    }

    public function update(Request $request, $id)
    {
        $response = Http::put($this->room_details, [
            'id' => $id,
            'type' => $request->type,
            'price' => $request->price,
            'capacity' => $request->capacity,
            'bed' => $request->bed,
            'detail' => explode(',', $request->detail),
        ]);

        if ($response->successful()) {
            return redirect()->route('admin.index')->with('success', 'Data berhasil diperbarui');
        }

        return back()->with('error', 'Gagal memperbarui data');
    }

    public function destroy($id)
    {
        $response = Http::delete($this->room_details, ['id' => $id]);

        if ($response->successful()) {
            return redirect()->route('admin.index')->with('success', 'Data berhasil dihapus');
        }

        return back()->with('error', 'Gagal menghapus data');
    }

}
