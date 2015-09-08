<?php
namespace App\Novel;

use App\Config;
use ReflectionClass;
class NoFManager extends AbstractComponent{
	
	protected $components = [
			'fetch' => Analyst::class,
			'download' => Downloader::class,
			'push' => Pusher::class,
	];
	
	protected $tickCnt;
	
	protected function init(){
		$this->tickCnt = Config::get('tickCnt');
		$this->tickCnt++;
		if ($this->tickCnt > 10080) $this->tickCnt = 1;
	}
	
	public function run(){
		$this->tick();
		$this->saveTick();
	}
	
	protected function saveTick(){
		Config::put('tickCnt', $this->tickCnt);
	}
	
	protected function tick(){
		foreach ($this->components as $component => $class){
			if ($this->isComponentReady($component)){
				$this->runComponent($class);
				$this->tickComponent($component);
			}
		}
	}
	
	protected function tickComponent($component){
		Config::put($component.'Last', $this->tickCnt);
	}
	
	protected function isComponentReady($component){
		$compoTick = Config::get($component.'Last');
		$compoTick += Config::get($component.'Interval');
		if ($compoTick <= $this->tickCnt || $compoTick - 1440 > $this->tickCnt){
			return true;
		} else {
			return false;
		}
	}
	
	protected function runComponent($class){
		$reflection = new ReflectionClass($class);
		$instance = $reflection->newInstance();
		$instance->run();
	}
}