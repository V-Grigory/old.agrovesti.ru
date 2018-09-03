<?php
namespace App\Http\Controllers\Wpadmin;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function readers(Request $request)
    {
        return view('wpadmin.clients.readers', [
            'clients' => Client::all()->sortByDesc('created_at'),
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
                //$request->session()->flash('reason_access_denied', 'new_client');
            }
        }
        return redirect()->route('wpadmin.clients.readers');
    }


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



    public function destroy(Client $client)
    {
        //unlink(public_path().'/images/banners/'.$banner->image);
        $client->delete();
        return redirect()->route('wpadmin.clients.readers');
    }

}