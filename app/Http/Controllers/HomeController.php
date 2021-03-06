<?php

namespace App\Http\Controllers;

use App\Article;
use App\Rubrik;
use App\Page;
use App\Comments;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
//use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function rubrika($name_en)
    {
        //== для панигации ==
        $page_previous = ( isset($_GET['p']) && abs((int)$_GET['p']) > 1 ) ? abs((int)$_GET['p']) - 1 : 0;
        $page_next = ( isset($_GET['p']) && abs((int)$_GET['p']) > 0 ) ? abs((int)$_GET['p']) + 1 : 2;
        // общее кол-во статей (чтоб не показывать кн. Дальше)
        $articles_cnt = Rubrik::with(['articles'])->where('name_en', $name_en)->get();
        if( $page_next - 1 == ceil(count($articles_cnt[0]['articles']) / 6) ) $page_next = 'no_articles_more';


        $list_articles = Rubrik::with(
                                ['articles' => function ($query) {
                                    $page = isset($_GET['p']) ? abs((int)$_GET['p']) : 1;
                                    $skip = ($page - 1) * 6;
                                    $query->skip($skip)->take(6)->orderBy('updated_at', 'desc');
                                    //$query->orderBy('updated_at', 'desc');
                                }]
                            )->where('name_en', $name_en)->get();

        if(isset($list_articles[0])) {
            return view('rubrika', [
                'list_articles' => $list_articles[0]['articles'],
                'rubrika_name_ru' => $list_articles[0]['name_ru'],
                'page_previous' => $page_previous,
                'page_next' => $page_next,
            ]);
        } else {
            return view('404');
        }

    }

    public function article($name_en, Request $request)
    {
        // реквест на отправку со страницы Ваша история
        if($request->vasha_istoriya_phone != NULL) {
            $headers = "From: webmaster@agrovesti.ru'; Content-Type: text/html; charset=UTF-8;";
            $msg = "ФИО: " . $request->vasha_istoriya_fio . "\r\n";
            $msg .= "Телефон, эл. почта: " . $request->vasha_istoriya_phone . "\r\n";
            $msg .= "Организация: " . $request->vasha_istoriya_company;
            mail('v_grigory@mail.ru', 'Письмо со страницы "Ваша история", agrovesti.ru', $msg, $headers);
            mail('agrotmn2016@mail.ru', 'Письмо со страницы "Ваша история", agrovesti.ru', $msg, $headers);
            mail('0501agro@mail.ru', 'Письмо со страницы "Ваша история", agrovesti.ru', $msg, $headers);
            mail('89222654748@mail.ru', 'Письмо со страницы "Ваша история", agrovesti.ru', $msg, $headers);
            $request->session()->flash('email_sended');
            //Mail::raw($msg, function($message) {
            //    $message->from('webmaster@agrovesti.ru', 'Письмо со страницы "Ваша история", agrovesti.ru');
            //    $message->to('v_grigory@mail.ru');
                //$message->to('v_grigory@mail.ru')->cc('bar@example.com');;
            //});
        }

        // если пришел коммент, сохраним его
        if($request->comment != NULL) {
            $comment = new Comments();
            $comment->article_id = $request->comment_article_id;
            $comment->client_id = $request->comment_client_id;
            $comment->comment = $request->comment;
            $comment->save();
        }

        // найдем запрошенную статью
        $article = Article::with('rubriks')->where('name_en', $name_en)->first();

        if($article) {
            // возьмем комменты с авторами
            $comments = Comments::with('client')->where('article_id', $article->id)->get();

            return view('article', [
                'article' => $article,
                'comments' => $comments,
                'is_login' => $this->is_login($request)
            ]);
        } else {
            return view('404');
        }

    }

    public function syncTilda() {
        return view('sync-tilda');
    }

    public function checkClientsRangePay() {
        Client::where('range_pay', date("d.m.Y"))->update(['status_pay'=>'notpaid','status_activity'=>'inactive']);
    }

    public function clientsJSON(Request $request) {
        header('Access-Control-Allow-Origin: *');
//        $clients_raw = Client::all();
//        $clients_new_client = $clients_raw->where('status_activity', 'Новый клиент')->sortByDesc('created_at')->all();
//        $clients_trial_period = $clients_raw->where('status_activity', 'Пробный период')->sortByDesc('created_at')->all();
//        $clients_inactive = $clients_raw->where('status_activity', 'Заблокирован')->sortByDesc('created_at')->all();
//        $clients_active = $clients_raw->where('status_activity', 'Активен')->sortByDesc('created_at')->all();
//
//        $collection  = new Collection;
//        $clients = $collection->merge($clients_new_client)->merge($clients_trial_period)->merge($clients_inactive)->merge($clients_active);
//
//        $count_clients = count($clients);

        $clients = Client::orderBy('id', 'desc')->get();

        return json_encode(['clients' => $clients]);
        //return json_encode(['clients' => 'qwqwqw11']);
    }

    public function updateClients(Request $request) {
        header('Access-Control-Allow-Origin: *');
        //file_put_contents("/home/grigory/projects/debug.txt", json_encode($request->all()) . "\n", FILE_APPEND);

        if($request->action === 'delete') {
            Client::destroy($request->id);
            return json_encode('OK');
        }

        if($request->id) {
            $client = Client::find($request->id);
        } else {
            $client = new Client;
        }

        if($request->fed_okrug)
            $client->fed_okrug = $request->fed_okrug;
        if($request->region)
            $client->region = $request->region;
        if($request->phone)
            $client->phone = $request->phone;
        else
            $client->phone = time();
        if($request->f_name)
            $client->f_name = $request->f_name;
        if($request->i_name)
            $client->i_name = $request->i_name;
        if($request->o_name)
            $client->o_name = $request->o_name;
        if($request->email)
            $client->email = $request->email;
        if($request->company)
            $client->company = $request->company;
        if($request->status_pay)
            $client->status_pay = $request->status_pay;
        if($request->range_pay)
            $client->range_pay = $request->range_pay;
        if($request->status_activity)
            $client->status_activity = $request->status_activity;

        $client->save();

        return json_encode($client);
    }

}
