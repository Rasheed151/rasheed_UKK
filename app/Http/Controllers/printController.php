<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class printController extends Controller
{
    private $transaction = 'http://localhost:3000/print';
    private $room = "http://localhost:3000/rooms";
    private $room_detail = "http://localhost:3000/room-details";

    function print($id)
    {
        $response = Http::get($this->transaction, [
            'id' => $id
        ]);
        $transactions = $response->json();
        $rooms = collect(Http::get($this->room)->json());
        $roomDetails = collect(Http::get($this->room_detail)->json());

        $today = Carbon::today();
        $history = collect($transactions)->map(function ($item) use ($rooms, $roomDetails) {
            $room = $rooms->firstWhere('id', $item['room_id']);
            $detail = $roomDetails->firstWhere('id', $room['type_id'] ?? null);
            $item['room_type'] = $detail['type'] ?? 'Unknown';

            return $item;
        })->values();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('users.print', compact('history'));

        return $pdf->stream('Reservasi hotel.pdf');
    }

}
