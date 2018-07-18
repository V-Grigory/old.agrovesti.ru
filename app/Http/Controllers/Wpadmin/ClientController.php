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
            'client'   => [],
            'clients'   => Client::all(),
            //'rubriks'   => Rubrik::all(),
            //'delimiter' => '',
            //'params' => $request
        ]);
    }

    public function update(Request $request, Client $client)
    {
       return redirect()->route('wpadmin.clients.readers');

       if($request['name'] != '' && $request['link'] != '') {

           $banner = Banner::find($request->id);
           $banner->name = $request->name;
           $banner->position = $request->position;

           if($request['image'] != NULL) {
               unlink(public_path().'/images/banners/'.$banner->image);
               $name_image = Str::slug(\Carbon\Carbon::now()->format('dmyHi') . '-' . mb_substr($request->file('image')->getClientOriginalName(), 0, 40));
               $name_image = $name_image . '.' . $request->file('image')->getClientOriginalExtension();
               $request->file('image')->move(public_path() . '/images/banners/', $name_image);
               $banner->image = $name_image;
           }
           $banner->link = $request->link;
           $banner->save();

           return redirect()->route('wpadmin.clients.readers');
       } else {
           return redirect()->route('wpadmin.banners.index', ['err_store' => "Необходимо заполнить все поля!"]);
       }
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        if($request['name'] != '' && $request['link'] != '' && $request['image'] != NULL) {

            $banner = new Banner();
            $banner->name = $request->name;
            $banner->position = $request->position;

            $name_image = Str::slug(\Carbon\Carbon::now()->format('dmyHi').'-'.mb_substr($request->file('image')->getClientOriginalName(),0,40));
            $name_image = $name_image .'.'. $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path().'/images/banners/', $name_image);

            $banner->image = $name_image;
            $banner->link = $request->link;
            $banner->save();
            //Banner::create($request->all());
            return redirect()->route('wpadmin.banners.index');
        } else {
            return redirect()->route('wpadmin.banners.index', ['err_store' => "Необходимо заполнить все поля!"]);
        }
    }


//    public function show(Rubrik $rubrik)
//    {
//        $list_articles = Rubrik::with('articles')->orderByDesc('id')->where('id', $rubrik->id)->get();
//
//        return view('wpadmin.rubriks.list_articles', [
//            'list_articles' => $list_articles[0]['articles'],
//        ]);
//    }

    public function edit(Client $client)
    {
        return view ('wpadmin.clients.readers', [
            'client'    => $client,
            'clients'   => Client::all(),
            //'rubriks'   => Rubrik::all(),
            'delimiter' => ''
        ]);
    }


    /*
    public function destroy(Banner $banner)
    {
        unlink(public_path().'/images/banners/'.$banner->image);
        $banner->delete();
        return redirect()->route('wpadmin.banners.index');
    }
    */
}