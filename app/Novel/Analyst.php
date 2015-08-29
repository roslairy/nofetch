<?php
namespace App\Novel;

use App\Novel;
use Carbon\Carbon;
class Analyst{
	
	protected $now;
	
	public function __construct(){
		$this->now = Carbon::now();
	}
	
	public function fetchAllNovel(){
		foreach (Novel::all() as $novel){
			$this->fetchChapter($novel);
		}
	}
	
	protected function fetchChapter($novel){
		$detector = $this->getDetector($novel);
		$detector->fetchChapter();
	}
	
	/**
	 * 
	 * @param Novel $novel
	 * @return NovelDetector
	 */
	protected function getDetector($novel){
		$className = 'App\Novel\Detector_'.$novel->website;
		$reflection = new \ReflectionClass($className);
		return $reflection->newInstance($novel);
	}
}