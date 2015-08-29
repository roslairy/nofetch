<?php
namespace App\Novel;

use App\Chapter;
use Illuminate\Support\Facades\Storage;
use App\Novel;
use Illuminate\Support\Facades\Mail;
class Pusher{
	
	public function pushAllNovel(){
		foreach (Novel::all() as $novel){
			$this->pushNovel($novel);
		}
	}
	
	protected function pushNovel($novel){
		$nextChapter = Chapter::getNextChapter($novel);
		if ($nextChapter == null) return;
		$fileName = $novel->name.' - '.$nextChapter->name.'.txt';
		$mail = new \App\Mail();
		$mail->chapterId = $nextChapter->id;
		$mail->state = 'ready';
		$mail->attachment = $fileName;
		$mail->save();
    	$nextChapter->state = 'pushed';
    	$nextChapter->save();
    	$novel->latestChapter++;
    	$novel->save();
	}
	
	public static function fireMail(){
    	$mail = \App\Mail::getNextMail();
    	if ($mail == null) return;
    	Mail::send('email.empty', [], function(\Illuminate\Mail\Message $message){
    		$mail = \App\Mail::getNextMail();
    		$chapter = Chapter::find($mail->chapterId);
    		$message->subject('Push to kindle');
    		$message->from('kindle-push@crimro.me', 'kindle-push');
    		$message->to('roslairy@crimro.me', 'roslairy\'s android Device');
    		$message->attachData($chapter->content, $mail->attachment);
    		$mail->state = 'pushed';
    		$mail->save();
    	});
	}
}