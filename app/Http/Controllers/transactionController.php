<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class transactionController extends Controller
{
    private $transaction = "http://localhost:3000/transactions";
    private $room = "http://localhost:3000/rooms";
    private $roomDetail = "http://localhost:3000/room-details";

    function index()
    {
        $response = Http::get($this->transaction, [
            'user_id' => session('user_id')
        ]);
        $transactions = $response->json();
        $rooms = collect(Http::get($this->room)->json());
        $roomDetails = collect(Http::get($this->roomDetail)->json());

        $today = Carbon::today();
        $history = collect($transactions)->filter(function ($item) use ($today) {
            return Carbon::parse($item['check_in'])->greaterThanOrEqualTo($today);
        })->map(function ($item) use ($rooms, $roomDetails) {
            $room = $rooms->firstWhere('id', $item['room_id']);
            $detail = $roomDetails->firstWhere('id', $room['type_id'] ?? null);
            $item['room_type'] = $detail['type'] ?? 'Unknown';

            return $item;
        })->values();


        return view('users.transaction', compact('history'));
    }
}
