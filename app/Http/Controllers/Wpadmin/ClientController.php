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

        return view('wpadmin.clients.readers', [
            'clients' => $clients,
            'params'  => $request
        ]);
    }

    /* обновление клиента */
    public function update(Request $request)
    {
       if($request['phone'] != '') {

           $client = Client::find($request->id);
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
            if( !$client = Client::where('phone', $request->phone)->first() ) {
                $client = new Client();
                $client->phone = $request->phone;
                $client->save();
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
                $request->session()->flash('mass_action_seccess', 'СМС НЕ разосланы, т.к. НЕ введен текст СМС');
                return redirect()->route('wpadmin.clients.readers');
            }
            foreach ($readers_phone as $reader_phone) {
                self::sendSMS($reader_phone, $request->text_sms);
            }
            $request->session()->flash('mass_action_seccess', 'СМС успешно разосланы');
        }

        if( $request->action == 'change_status_activity' ) {
            Client::whereIn('phone', $readers_phone)->update(['status_activity'=>$request->change_status_activity]);
            $request->session()->flash('mass_action_seccess', 'Статусы изменены');
        }

        if( $request->action == 'delete' ) {
            Client::whereIn('phone', $readers_phone)->delete();
            $request->session()->flash('mass_action_seccess', 'Записи удалены');
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