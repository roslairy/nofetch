<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Novel extends Model {
	public function getNextDownloadChapter() {
		$chapters = Chapter::where ( 'novel_id', '=', $this->id )->where ( 'state', '=', 'detected' )->where('index', '>', $this->latestChapter)->orderBy ( 'index' )->take ( 1 )->get ();
		
		if ($chapters->count () == 0)
			return null;
		else
			return $chapters [0];
	}
}
