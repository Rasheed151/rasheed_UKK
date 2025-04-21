<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class receptionistController extends Controller
{
    private $transactions = "http://localhost:3000/transactions";
    public function index(){
        $transaction = Http::get($this->transactions)->json();

        return view('receptionist.index',compact('transaction'));
    }

    
}
