<?php
namespace App\Novel;
use App\Novel;
use Carbon\Carbon;
class Downloader{

	protected $now;

	public function __construct(){
		$this->now = Carbon::now();
	}

	public function downloadAllNovel(){
		foreach (Novel::all() as $novel){
			$this->downloadChapter($novel);
		}
	}

	protected function downloadChapter($novel){
		$detector = $this->getDetector($novel);
		$detector->downloadChapter();
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