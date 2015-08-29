<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model{
	
	public function getNextDownloadChapter(){
		$chapters = Chapter::where('novel', '=', $this->name)	
			->where('state', '=', 'detected')
			->orderBy('index')
			->take(1)
			->get();
		
		if ($chapters->count() == 0) return null;
		else return $chapters[0];
	}
}
