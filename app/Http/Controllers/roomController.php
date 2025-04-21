<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use function PHPSTORM_META\type;

class roomController extends Controller
{
    private $rooms = "http://localhost:3000/rooms";
    private $room_details =  "http://localhost:3000/room-details";
    private $transactions =  "http://localhost:3000/transactions";

    public function index(Request $request)
    {
        $check_in = $request->query('check_in');
        $check_out = $request->query('check_out');

        $room = Http::get($this->rooms)->json();
        $room_detail = Http::get($this->room_details)->json();
        $transaction = Http::get($this->transactions)->json();

        $roomByType = collect($room)->groupBy('type_id');
        $room_detail = collect($room_detail)->map(function ($detail) use ($roomByType, $room, $transaction, $check_in, $check_out) {
            $type_id = $detail['id'];
            $rooms = $roomByType->get($type_id, collect());
            $availableRooms = $rooms->filter(function ($room) use ($transaction, $check_in, $check_out) {
                if ($room['status'] != 1) return false; 
                $roomTransaction = collect($transaction)->where('room_id', $room['id']);
                foreach ($roomTransaction as $trans) {
                    if (
                        ($check_in < $trans['check_out']) &&
                        ($check_out > $trans['check_in'])
                    ) {
                        return false; 
                    }
                }
                return true;
            });

            $detail['available'] = $availableRooms->isNotEmpty();
            return $detail;
        });

        return view('users.room', [
            'room' => $room,
            'room_detail' => $room_detail,
            'check_in'=> $check_in,
            'check_out'=> $check_out
        ]);
    }
}
