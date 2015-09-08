<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model {
	
	public static function getNextReadyMail() {
		$result = self::where ( 'state', '=', 'ready' )->take ( 1 )->get ();
		
		if ($result->count () == 0)
			return null;
		else
			return $result [0];
	}
	
	public static function getNextFireMail() {
		$result = self::where ( 'state', '=', 'fire' )->take ( 1 )->get ();
		
		if ($result->count () == 0)
			return null;
		else
			return $result [0];
	}
	
	public function novel(){
		return $this->belongsTo('App\Novel');
	}
	
	public function chapter(){
		return $this->belongsTo('App\Chapter');
	}
}
