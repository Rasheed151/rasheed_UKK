<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use function PHPSTORM_META\type;

class roomController extends Controller
{
    private $room = "http://localhost:3000/rooms";
    private $room_detail =  "http://localhost:3000/room-details";

    public function index(Request $request)
    {
        $tanggal1 = $request->query('tanggal1');
        $tanggal2 = $request->query('tanggal2');

        $room = Http::get($this->room)->json();
        $room_detail = Http::get($this->room_detail)->json();
        $transactions = Http::get('http://localhost:3000/transactions')->json();

        
        $roomGroupedByType = collect($room)->groupBy('type_id');

        
        $room_detail = collect($room_detail)->map(function ($detail) use ($roomGroupedByType, $room, $transactions, $tanggal1, $tanggal2) {
            $type_id = $detail['id'];
            $rooms = $roomGroupedByType->get($type_id, collect());

            
            $availableRooms = $rooms->filter(function ($room) use ($transactions, $tanggal1, $tanggal2) {
                if ($room['status'] != 1) return false; 

                
                $roomTransactions = collect($transactions)->where('room_id', $room['id']);

                
                foreach ($roomTransactions as $trans) {
                    if (
                        ($tanggal1 < $trans['check_out']) &&
                        ($tanggal2 > $trans['check_in'])
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
            'tanggal1'=> $tanggal1,
            'tanggal2'=> $tanggal2
        ]);
    }
}

