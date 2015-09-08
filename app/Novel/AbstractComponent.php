<?php

namespace App\Novel;

use Carbon\Carbon;

abstract class AbstractComponent {
	protected $now;
	public function __construct() {
		$this->now = Carbon::now ();
		$this->init();
	}
	protected function init(){}
	abstract public function run();
}