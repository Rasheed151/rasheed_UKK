<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class bookingController extends Controller
{

    private $transactions = "http://localhost:3000/transactions";

    public function index(Request $request)
    {
        $transaction = Http::get($this->transactions)->json();
        // Ambil parameter check_in dan check_out dari query string
        $check_in = $request->query('check_in');
        $check_out = $request->query('check_out');
        $type_id = $request->query('type_id');

        $roomDetails = Http::get('http://localhost:3000/room-details')->json();
        $selectedRoomDetail = collect($roomDetails)->firstWhere('id', $type_id);
        $in = Carbon::parse($check_in);
        $out = Carbon::parse($check_out);
        $nights = $in->diffInDays($out);
        $price = $selectedRoomDetail['price'];
        $total_price = $price * $nights;


        $auto_selected_room = null;
        if ($type_id) {
            $auto_selected_room = $this->getFirstAvailableRoomId($type_id);
        }
        $selected_room_id = $auto_selected_room;

        // Kirim ke view
        return view('users.booking', compact('transaction', 'check_in', 'check_out', 'selected_room_id', 'total_price', 'nights'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'room_id' => 'required',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'phone_number' => 'required',
            'payment_method' => 'required',
            'total_price' => 'required|numeric',
        ]);

        $data = array_merge($validated, [
            'user_id' => session('user_id'),
            'payment_status' => 'pending',
        ]);


        $response = Http::post('http://localhost:3000/transactions', $data);

        if ($response->successful()) {
                return redirect()->route('transaction.index')->with('success', 'Reservasi Kamar Telah Berhasil.');
        } else {
            return redirect()->back()->with('error', 'Booking gagal.');
        }
    }

    private $room = "http://localhost:3000/rooms";

    private function getFirstAvailableRoomId($type_id)
    {
        $rooms = Http::get($this->room)->json();

        foreach ($rooms as $room) {
            if ($room['type_id'] == $type_id && $room['status'] == 1) {
                return $room['id'];
            }
        }
        return null;
    }
}
