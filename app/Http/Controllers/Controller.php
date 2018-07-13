<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function is_login($request){

        // если авторизован
        if( $request->session()->has('phone') ) {
            return session('phone');
        }
        // иначе если пришел реквест с телефоном из формы логина
        elseif(isset($request->phone)) {
            // если не зареган, зарегим
            if( !$client = Client::where('phone', $request->phone)->first() ) {
                $client = new Client();
                $client->phone = $request->phone;
                $client->save();
            }
            session(['phone' => $request->phone]);
            return $request->phone;
        }
        else
            return false;
    }

}
