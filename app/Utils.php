<?php
namespace App;

use PHPHtmlParser\Dom;
class Utils{
	
	public static function getDom($url){
		$dom = new Dom();
		$html = self::getHtml($url);
		$dom->load($html);
		return $dom;
	}
	
	public static function getHtml($url){
		$client = new Client();
		$response = $client->get($url, ['verify' => false]);
		if ($response->getStatusCode() != 200){
			$error = '%s: Bad HTTP response code, url is %s, status code is %d.';
			$error = sprintf($error, __METHOD__, $url, $response->getStatusCode());
			Log::error($error);
			throw new \Exception($error, 0);
		}
		return $response->getBody();
	}
}