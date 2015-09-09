<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Novel;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\BootstrapThreePresenter;
use Illuminate\Support\Facades\Validator;
use App\Chapter;
use App\Mail;
use App\Config;

class Admin extends Controller {
	
	// #########################################
	//
	// View
	//
	// #########################################
	public function main() {
		
		$data = ['pageName' => 'main' ];
		$data['novelCnt'] = Novel::where('state', '=', 'detect')->count();
		$data['chapterCnt'] = Chapter::where('state', '=', 'detected')->count();
		$data['mailCnt'] = Mail::where('state', '=', 'ready')->count();
		
		return view ( 'index', $data);
	}
	
	public function novel() {
		$novels = Novel::paginate ( 10 );
		
		return view ( 'novel', [ 'novels' => $novels, 'pageName' => 'novel' ] );
	}
	
	public function edit() {
		$task = Input::get ( 'task', 'new' );
		
		$data = $this->{"getDataEdit_{$task}"} ();
		
		$data['selects'] = $this->getNovelSelect();
		
		return view ( 'edit', $data );
	}
	
	public function chapter(){
		$chapters = Chapter::orderBy('index', 'desc')->with('novel')->paginate ( 10 );
		
		return view ( 'chapter', [ 'chapters' => $chapters, 'pageName' => 'chapter' ] );
	}
	
	public function mail(){
		$mails = Mail::with('novel')->with('chapter')->paginate ( 10 );
		
		return view ( 'mail', [ 'mails' => $mails, 'pageName' => 'mail' ] );
	}
	
	public function setting(){
		$configs = Config::all();
		
		$data = [ 'pageName' => 'setting' ];
		foreach($configs as $config){
			$data[$config->key] = $config->value;
		}
		
		return view ( 'setting', $data);
	}
	
	protected function getNovelSelect(){
		return [
				'77nt'
		];
	}
	
	protected function getDataEdit_new() {
		$url = Input::get ( 'novelUrl', '' );
		
		$data = [ 'pageName' => 'novel', 'realPageName' => 'edit' ];
		$data ['id'] = - 1;
		$data ['name'] = '';
		$data ['author'] = '';
		$data ['website'] = '';
		$data ['url'] = $url;
		$data ['begin'] = 1;
		return $data;
	}
	
	protected function getDataEdit_edit() {
		$novel = Novel::find ( Input::get ( 'id', - 1 ) );
		if ($novel == null)abort ( 404 );
		
		$data = [ 'pageName' => 'novel', 'realPageName' => 'edit' ];
		$data ['id'] = $novel->id;
		$data ['name'] = $novel->name;
		$data ['author'] = $novel->author;
		$data ['state'] = $novel->state;
		$data ['website'] = $novel->website;
		$data ['url'] = $novel->url;
		$data ['begin'] = $novel->latestChapter + 1;
		return $data;
	}
	
	// #########################################
	//
	// Admin
	//
	// #########################################
	public function editSave() {
		$v = Validator::make(Input::all(), [
				'novelId' => 'required|numeric',
				'novelName' => 'required',
				'novelAuthor' => 'required',
				'novelWebsite' => 'required',
				'novelUrl' => 'required',
				'novelBegin' => 'required|numeric|min:1',
		]);
		
		if ($v->fails()){
			return response('bad request', 400);
		}
		
		$novel = Novel::findOrNew(Input::get('novelId'));
		$novel->name = Input::get('novelName');
		$novel->author = Input::get('novelAuthor');
		$novel->state = 'detect';
		$novel->website = Input::get('novelWebsite');
		$novel->url = Input::get('novelUrl');
		$novel->latestChapter = Input::get('novelBegin') - 1;
		$novel->save();
		
		return redirect()->route('novel');
	}
	
	public function novelPause(){
		if (!Input::has('id')) abort(404);
		
		$novel = Novel::find(Input::get('id'));
		$novel->state = 'pause';
		$novel->save();
		
		return redirect()->back();
	}
	
	public function novelResume(){
		if (!Input::has('id')) abort(404);
		
		$novel = Novel::find(Input::get('id'));
		$novel->state = 'detect';
		$novel->save();
		
		return redirect()->back();
	}
	
	public function novelDelete(){
		if (!Input::has('id')) abort(404);
		
		$novel = Novel::find(Input::get('id'));
		$novel->delete();
		
		return redirect()->back();
	}
	
	public function settingSave(){
		$v = Validator::make(Input::all(), [
				'fetchInterval' => 'required|numeric',
				'downloadInterval' => 'required|numeric',
				'pushInterval' => 'required|numeric'
		]);
		
		if ($v->fails()){
			return response('bad request', 400);
		}

		Config::put('fetchInterval', Input::get('fetchInterval'));
		Config::put('downloadInterval', Input::get('downloadInterval'));
		Config::put('pushInterval', Input::get('pushInterval'));
		
		return redirect()->route('setting');
	}
	
	public function settingReset(){
		Config::put('fetchInterval', 10);
		Config::put('downloadInterval', 1);
		Config::put('pushInterval', 1);
		
		return redirect()->route('setting');
	}
}
