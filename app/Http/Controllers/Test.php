<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Utils;
use App\Novel;
use App\Novel\Detector_77nt;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Novel\Analyst;
use Illuminate\Support\Facades\Mail;
use App\Novel\Pusher;
use App\Chapter;
use App\Novel\Downloader;

class Test extends Controller
{
    public function test1(){
		$ana = new Analyst();
		$ana->fetchAllNovel();
    }
    
    public function test3(){
    	$pusher = new Pusher();
    	$pusher->pushAllNovel();
    	$pusher->fireMail();
    }
    
    public function test2(){
    	$dl = new Downloader();
    	$dl->downloadAllNovel();
    }
    
    public function all(){
    	$de = new Detector_77nt(Novel::find(1));
    	$de->downloadAll();
    }
    
    public function pushOne(){
    	Mail::send('email.empty', [], function(\Illuminate\Mail\Message $message){
    		$message->subject('Push to kindle');
    		$message->from('kindle-push@crimro.me', 'kindle-push');
    		$message->to('roslairy@crimro.me', 'roslairy\'s android Device');
    	});
    }
}
