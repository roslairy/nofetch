<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Novel\Analyst;
use App\Novel\Downloader;
use App\Novel\Pusher;
use App\Novel\Mailer;
use App\Novel\NoFManager;

class Kernel extends ConsoleKernel {
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [ 
			\App\Console\Commands\Inspire::class 
	];
	
	/**
	 * Define the application's command schedule.
	 *
	 * @param \Illuminate\Console\Scheduling\Schedule $schedule        	
	 * @return void
	 */
	protected function schedule(Schedule $schedule) {
		$schedule->call ( function () {
			$manager = new NoFManager;
			$manager->run();
		} )->cron ( '* * * * *' );
	}
}
