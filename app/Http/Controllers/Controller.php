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

            // если невалидный телефон
            if( !self::isPhoneValid($request->phone) ) {
                $request->session()->flash('reason_access_denied', 'Неверный формат телефона');
                return false;
            }
            // если не зареган, зарегим как "Новый клиент"
            if( !$client = Client::where('phone', $request->phone)->first() ) {
                $client = new Client();
                $client->phone = $request->phone;
                $client->save();
                $request->session()->flash('reason_access_denied', 'Вы еще не зарегистрированы в системе');
                return false;
            }
            // если зареган и активен (или на пробном периоде)
            if($client->status_activity == 'active' || $client->status_activity == 'trial_period') {
                session(['phone' => $request->phone, 'client_id' => $client->id]);
                //self::sendSMS('9068255288', 'проверка');
                return $request->phone;
            }
            // если зареган и заблокирован
            $request->session()->flash('reason_access_denied', 'Вам не предоставлен доступ');
            return false;
        }
        // не авторизован, не отправлен запрос на авторизацию\регистрацию, обычная загрузка страницы
        else
            return false;
    }

    public static function sendSMS($phone, $smstext)
    {
        $ch = curl_init();
        $src = '<?xml version="1.0" encoding="utf-8"?>';
        $src .= '<xml_request name="sms_send">';
        $src .= '<xml_user lgn="33417" pwd="26336481"/>';
        $src .= "<sms sms_id='2' number='+7$phone' source_number='Agrozerno' ttl='10'>$smstext</sms>";
        $src .= '</xml_request>';
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded','Content-Charset: UTF-8'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $src);
        curl_setopt($ch, CURLOPT_URL, 'http://api.smsdirector.ru/public/http/z.php');
        $result = curl_exec($ch);
    }

    public static function isPhoneValid($phone)
    {
//        if( is_numeric($phone) && (substr($phone, 0, 1) == '9') && (strlen($phone) == 10) ) {
//            return true;
//        } else {
//            return false;
//        }
        return is_numeric($phone) && (substr($phone, 0, 1) == '9') && (strlen($phone) == 10);
    }

}
