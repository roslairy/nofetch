<?php

namespace App\Novel;

interface NovelDetector {
	public function __construct($novel);
	public function fetchChapter();
	public function downloadChapter();
}