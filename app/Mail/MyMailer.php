<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Contracts\Queue\ShouldQueue;

class MyMailer extends Mailable
{
    use Queueable, SerializesModels;

	/**
	 * The demo object instance.
	 *
	 * @var Demo
	 */
	public $data;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($dataEmail)
	{
		$this->data = $dataEmail;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->from('agro-gazeta@yandex.ru')
			->view('mails.sendAccessArticleCode')
			// ->text('mails.demo_plain') // текстовое представление
			->with(
				[
					'testVarOne' => '1',
					'testVarTwo' => '2',
				]);
//			->attach(public_path('/images').'/demo.jpg', [
//				'as' => 'demo.jpg',
//				'mime' => 'image/jpeg',
//			]);
	}
}
