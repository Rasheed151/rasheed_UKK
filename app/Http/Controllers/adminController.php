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
        $rooms = Http::get($this->rooms)->json();

        return view('admin.index', compact('room_detail', 'rooms'));
    }

    public function store() {}

    public function edit() {}

    public function update() {}

    public function destroy(Request $request)
    {
        $request->validate([
            'id'=> 'required']);

        Http::delete($this->room_details, [
            'id' => $request->id 
        ]);
        

        return redirect()->route('admin.index')->with('success', 'Data berhasil dihapus.');
    }
}
