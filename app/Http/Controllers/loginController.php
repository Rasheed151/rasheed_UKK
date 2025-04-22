<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class loginController extends Controller
{
    public function index()
    {

        return view('login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $response = Http::post('http://localhost:3000/login', [
            'name' => $request->name,
            'password' => $request->password,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            session([
                'user_id' => $data['user']['id'],
                'user_name' => $data['user']['name'],
                'user_level' => $data['user']['level'],
            ]);

            switch ($data['user']['level']) {
                case 1:
                    return redirect()->route('home');
                case 2:
                    return redirect()->route('receptionist.index');
                case 3:
                    return redirect()->route('admin.index');
            }
        } else {
            return back()->withErrors(['login' => $response->json()['message'] ?? 'Gagal login']);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect()->route('home')->with('success', 'Kamu telah logout');
    }
}
