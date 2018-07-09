<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LkController extends Controller
{

    function is_login(){
        //if(isset($_POST['phone'])) {} //var_dump($_POST['phone']);
        return session('phone') ? session('phone') : false;
    }

    public function profile(Request $request) {
        $name = $request->input('phone');
        return view('lk.profile', [
            'is_login' => $this->is_login()
        ]);
    }

}
