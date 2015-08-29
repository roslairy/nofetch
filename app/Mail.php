<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model{
    public static function getNextMail(){
		$result = self::where('state', '=', 'ready')
			->take(1)
			->get();
		
		if ($result->count() == 0) return null;
		else return $result[0];
	}
}
