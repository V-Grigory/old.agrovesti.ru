<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MyMailer;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
	public function send()
	{
		$objDemo = new \stdClass();
		$objDemo->demo_one = 'Demo One Value';
		$objDemo->demo_two = 'Demo Two Value';
		$objDemo->sender = 'SenderUserName';
		$objDemo->receiver = 'ReceiverUserName';

		Mail::to("v_grigory@mail.ru")->send(new MyMailer($objDemo));

//		return view('mails.sendAccessArticleCode', [
//       'data' => $objDemo
//		]);
	}
//MAIL_DRIVER=smtp
//MAIL_HOST=smtp.yandex.ru
//MAIL_PORT=587
//MAIL_USERNAME=agro-gazeta@yandex.ru
//MAIL_PASSWORD=kVhPBRh4
//MAIL_ENCRYPTION=tls
//MAIL_FROM_ADDRESS=agro-gazeta@yandex.ru
//MAIL_FROM_NAME=agro-gazeta
}
