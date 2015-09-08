<?php

namespace App\Novel;

use App\Chapter;
use Illuminate\Support\Facades\Storage;
use App\Novel;
use Illuminate\Support\Facades\Mail;

class Pusher extends AbstractComponent {
	
	public function run(){
		$this->pushAllNovel();
		$mailer = new Mailer;
		$mailer->run();
	}
	
	protected function pushAllNovel() {
		foreach ( Novel::all () as $novel ) {
			$this->pushNovel ( $novel );
		}
	}
	protected function pushNovel($novel) {
		$nextChapter = Chapter::getNextChapter ( $novel );
		if ($nextChapter == null)
			return;
		
		$name = $novel->name . ' - ' . $nextChapter->name . '.txt';
		
		$mail = new \App\Mail ();
		$mail->state = 'ready';
		$mail->name = $name;
		$mail->content = $nextChapter->content;
		$mail->novel_id = $novel->id;
		$mail->chapter_id = $nextChapter->id;
		$mail->save ();
		
		$nextChapter->state = 'pushed';
		$nextChapter->save ();
		
		$novel->latestChapter ++;
		$novel->save ();
	}
}