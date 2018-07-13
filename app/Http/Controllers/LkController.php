<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Client;

class LkController extends Controller
{

    public function profile(Request $request) {
        return view('lk.profile', [
            'is_login' => $this->is_login($request)
        ]);
    }

    public function logout(Request $request){
        $request->session()->forget('phone');
        return redirect()->route('home');
    }

}
