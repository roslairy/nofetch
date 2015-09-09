<?php

namespace App\Novel;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Storage;

class Mailer extends AbstractComponent {
	
	public function run(){
		$this->fireMail();
	}
	
	protected function fireMail() {
		$mail = \App\Mail::getNextReadyMail ();
		
		if ($mail != null){
		
			$mail->state = 'fire';
			$mail->save ();
			
		}
		
		$this->send ();
	}
	
	protected function send() {
		$result = Mail::raw ( '', function (Message $message) {
			
			$mail = \App\Mail::getNextFireMail ();
			$content = $mail->content;
			$name = $mail->name;
			
			$message->from ( env ( 'MAIL_USERNAME' ), 'Pusher' );
			$message->to ( env ( 'MAIL_TO' ), 'Kindle' );
			$message->subject ( $name );
			$message->attachData ( $content, $name );
		} );
		
		// check if succeess
		$mail = \App\Mail::getNextFireMail ();
		if ($result == 1) $mail->state = 'sent';
		else $mail->state = 'failed';
		$mail->save ();
	}
}