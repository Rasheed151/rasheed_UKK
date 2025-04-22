<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;

class receptionistController extends Controller
{
    private $transactions = "http://localhost:3000/transactions";

    public function index(Request $request)
    {
        $transactions = collect(Http::get($this->transactions)->json());

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $name = $request->input('name');

        $start = $startDate ? Carbon::parse($startDate) : null;
        $end = $endDate ? Carbon::parse($endDate) : null;

        $filtered = $transactions->filter(function ($item) use ($start, $end, $name) {
            $checkIn = Carbon::parse($item['check_in']);
            $checkOut = Carbon::parse($item['check_out']);

            if ($start && $checkOut->lt($start)) return false;
            if ($end && $checkIn->gt($end)) return false;

            if ($name && stripos($item['name'], $name) === false) return false;

            return true;
        });

        return view('receptionist.index', [
            'transaction' => $filtered->values(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'name' => $name
        ]);
    }

    public function update(Request $request, $id)
    {
        $response = Http::put($this->transactions, [
            'id'=>$id,
            'payment_status' => $request->payment_status,
        ]);

        if ($response->successful()) {
            return redirect()->route('receptionist.index')->with('success', 'Data berhasil diperbarui');
        }

        return back()->with('error', 'Gagal memperbarui data');
    }
}
