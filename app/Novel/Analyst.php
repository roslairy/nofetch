<?php

namespace App\Novel;

use App\Novel;
use Carbon\Carbon;

class Analyst extends AbstractComponent {
	public function run(){
		$this->fetchAllNovel();
	}
	
	protected function fetchAllNovel() {
		foreach ( Novel::where ('state', '=', 'detect')->get() as $novel ) {
			$this->fetchChapter ( $novel );
		}
	}
	protected function fetchChapter($novel) {
		$detector = $this->getDetector ( $novel );
		$detector->fetchChapter ();
	}
	
	/**
	 *
	 * @param Novel $novel        	
	 * @return NovelDetector
	 */
	protected function getDetector($novel) {
		$className = 'App\Novel\Detector_' . $novel->website;
		$reflection = new \ReflectionClass ( $className );
		return $reflection->newInstance ( $novel );
	}
}