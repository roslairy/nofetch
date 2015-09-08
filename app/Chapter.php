<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model {
	
	public static function getNextChapter($novel) {
		$nextIndex = $novel->latestChapter + 1;
		$result = self::where ( 'novel_id', '=', $novel->id )->where ( 'state', '=', 'downloaded' )->where ( 'index', '=', $nextIndex )->take ( 1 )->get ();
		
		if ($result->count () != 1)
			return null;
		else
			return $result [0];
	}
	
	public function novel(){
		return $this->belongsTo('App\Novel');
	}
}
