<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model {
	//
	
	public static function put($key, $value){
		$config = self::where('key', '=', $key)->take(1)->get()[0];
		$config->value = $value;
		$config->save();
	}
	
	public static function get($key){
		return self::where('key', '=', $key)->take(1)->get()[0]->value;
	}
}
