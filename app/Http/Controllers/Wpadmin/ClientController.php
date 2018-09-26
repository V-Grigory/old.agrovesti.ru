<?php
namespace App\Http\Controllers\Wpadmin;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
//use Illuminate\Support\Str;

class ClientController extends Controller
{
    /* вывод списка клиентов */
    public function readers(Request $request)
    {
        $clients_raw = Client::all();
        $clients_new_client = $clients_raw->where('status_activity', 'new_client')->sortByDesc('created_at')->all();
        $clients_trial_period = $clients_raw->where('status_activity', 'trial_period')->sortByDesc('created_at')->all();
        $clients_inactive = $clients_raw->where('status_activity', 'inactive')->sortByDesc('created_at')->all();
        $clients_active = $clients_raw->where('status_activity', 'active')->sortByDesc('created_at')->all();

        $collection  = new Collection;
        $clients = $collection->merge($clients_new_client)->merge($clients_trial_period)->merge($clients_inactive)->merge($clients_active);

        $count_clients = count($clients);

        return view('wpadmin.clients.readers', [
            'clients' => $clients,
            'count_clients' => $count_clients,
            'params'  => $request
        ]);
    }

    /* обновление клиента */
    public function update(Request $request)
    {
       if($request['phone'] != '') {

           $client = Client::find($request->id);
           $client->fed_okrug = $request->fed_okrug;
           $client->region = $request->region;
           $client->phone = $request->phone;
           $client->f_name = $request->f_name;
           $client->i_name = $request->i_name;
           $client->o_name = $request->o_name;
           $client->email = $request->email;
           $client->company = $request->company;
           $client->status_pay = $request->status_pay;
           $client->range_pay = $request->range_pay;
           $client->status_activity = $request->status_activity;
           $client->save();

           return redirect()->route('wpadmin.clients.readers');
       } else {
           return redirect()->route('wpadmin.clients.readers', ['err_store' => "Телефон является обязательным полем!"]);
       }
    }

    /* Добавление нового клиента */
    public function store(Request $request)
    {
        if( isset($request["addClient"]) && $request->phone != '' ) {
            if( self::isPhoneValid($request->phone) ) {
                if( !$client = Client::where('phone', $request->phone)->first() ) {
                    $client = new Client();
                    $client->phone = $request->phone;
                    $client->save();
                    $request->session()->flash('flash_for_wpadmin', 'Клиент добавлен');
                } else {
                    $request->session()->flash('flash_for_wpadmin', 'Клиент с таким номером УЖЕ добавлен');
                }
            } else {
                $request->session()->flash('flash_for_wpadmin', 'Клиент НЕ добавлен. Невалидный телефон. Правильный формат: 9991112233');
            }
        }
        return redirect()->route('wpadmin.clients.readers');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('wpadmin.clients.readers');
    }

    public function massActions(Request $request)
    {
        $readers_phone = explode(',', $request->readers_phone);

        //file_put_contents("mylog.txt",$request->readers_phone."\n", FILE_APPEND);

        if( $request->action == 'send_sms' ) {
            if( $request->text_sms == '' ) {
                $request->session()->flash('flash_for_wpadmin', 'СМС НЕ разосланы, т.к. НЕ введен текст СМС');
                return redirect()->route('wpadmin.clients.readers');
            }
            foreach ($readers_phone as $reader_phone) {
                self::sendSMS($reader_phone, $request->text_sms);
            }
            $request->session()->flash('flash_for_wpadmin', 'СМС успешно разосланы');
        }

        if( $request->action == 'update' ) {
            $fields_update = [];
            if($request->change_status_pay != 'no_change') $fields_update['status_pay'] = $request->change_status_pay;
            if($request->change_range_pay != 'no_change') $fields_update['range_pay'] = $request->change_range_pay;
            if($request->change_status_activity != 'no_change') $fields_update['status_activity'] = $request->change_status_activity;

            Client::whereIn('phone', $readers_phone)->update($fields_update);
            $request->session()->flash('flash_for_wpadmin', 'Статусы изменены');
        }

        if( $request->action == 'delete' ) {
            Client::whereIn('phone', $readers_phone)->delete();
            $request->session()->flash('flash_for_wpadmin', 'Записи удалены');
        }

        return redirect()->route('wpadmin.clients.readers');
    }



    /*public function search(Request $request)
    {
        return redirect()->route('wpadmin.clients.readers');
    }*/

    //    public function create()
    //    {
    //        return redirect()->route('wpadmin.clients.readers');
    //    }

    //    public function show(Rubrik $rubrik)
    //    {
    //        $list_articles = Rubrik::with('articles')->orderByDesc('id')->where('id', $rubrik->id)->get();
    //
    //        return view('wpadmin.rubriks.list_articles', [
    //            'list_articles' => $list_articles[0]['articles'],
    //        ]);
    //    }

    //    public function edit(Client $client)
    //    {
    //        return view ('wpadmin.clients.readers', [
    //            'client'    => $client,
    //            'clients'   => Client::all(),
    //            //'rubriks'   => Rubrik::all(),
    //            'delimiter' => ''
    //        ]);
    //    }

}