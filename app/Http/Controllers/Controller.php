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
                $request->session()->flash('reason_access_denied', 'new_client');
                return false;

            // если зареган и активен
            } elseif($client->status_activity == 'active') {
                session(['phone' => $request->phone, 'client_id' => $client->id]);
                return $request->phone;

            // если зареган и заблокирован (при первоначальной регистрации или по истечении срока)
            } else {
                //$request->session()->flash('reason_access_denied', 'wait_allow'); // пока этот флеш не нужен
                return false;
            }
        }
        // не авторизован, не отправлен запрос на авторизацию\регистрацию, обычная загрузка страницы
        else
            return false;
    }

}
