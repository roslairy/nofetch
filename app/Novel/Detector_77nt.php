<?php

namespace App\Novel;

use App\Utils;
use App\Chapter;
use Purl\Url;

class Detector_77nt implements NovelDetector {
	protected $novel;
	public function __construct($novel) {
		$this->novel = $novel;
	}
	public function fetchChapter() {
		$dom = Utils::getDom ( $this->novel->url );
		$dds = $dom->find ( 'dl', 0 )->find ( 'dd' );
		$end = count ( $dds );
		$chapterIndex = $end + 1;
		
		$newed = false;
		foreach ( range ( $end, 3, - 3 ) as $i ) {
			foreach ( range ( 2, 0 ) as $j ) {
				$chapterIndex --;
				$index = $i - $j - 1;
				$a = $dds [$index]->find ( 'a', 0 );
				if ($a == null)
					continue;
				if (Chapter::where ( 'index', '=', $chapterIndex )->count () != 0) {
					$newed = true;
					break;
				}
				$name = $a->text ();
				$url = $this->novel->url . $a->getAttribute ( 'href' );
				$chapter = new Chapter ();
				$chapter->name = $name;
				$chapter->index = $chapterIndex;
				$chapter->state = 'detected';
				$chapter->url = $url;
				$chapter->novel_id = $this->novel->id;
				$chapter->save ();
			}
			if ($newed) {
				break;
			}
		}
	}
	public function downloadChapter() {
		$chapter = $this->novel->getNextDownloadChapter ();
		if ($chapter == null)
			return;
		$dom = Utils::getDom ( $chapter->url );
		$content = $dom->find ( '.content', 0 )->text ();
		$content = str_replace ( str_repeat ( '&nbsp;', 4 ), "\n\t", $content );
		$chapter->content = $content;
		$chapter->state = 'downloaded';
		$chapter->save ();
	}
	public function downloadAll() {
		foreach ( Chapter::all () as $chapter ) {
			if ($chapter->state != 'detected')
				continue;
			$dom = Utils::getDom ( $chapter->url );
			$content = $dom->find ( '.content', 0 )->text ();
			$content = str_replace ( str_repeat ( '&nbsp;', 4 ), "\n\t", $content );
			$chapter->content = $content;
			$chapter->state = 'downloaded';
			$chapter->save ();
		}
	}
}