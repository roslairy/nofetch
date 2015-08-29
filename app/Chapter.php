<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model{
    
    public static function getNextChapter($novel){
    	$nextIndex = $novel->latestChapter + 1;
    	$result = self::where('novel', '=', $novel->name)
    		->where('state', '=', 'downloaded')
    		->where('index', '=', $nextIndex)
    		->take(1)
    		->get();
    	
    	if ($result->count() != 1) return null;
    	else return $result[0];
    }
    
}
