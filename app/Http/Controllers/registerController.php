<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class registerController extends Controller
{
    public function index(){
        return view('register');
    }

    public function register(Request $request){
        $response = Http::post('http://localhost:3000/users',[
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'level' => 1
        ]);
        if($response->successful()){
            return redirect()->back()->with('success','Verhasil,Silahkan Verifikasi melalui email terlebih dahulu');
        }else{
            return redirect()->back()->with('error', 'Terjadi Kesalahan');
        }
    }
}
