<?php

namespace App;

use PHPHtmlParser\Dom;
use GuzzleHttp\Client;

class Utils {
	public static function getDom($url) {
		$dom = new Dom ();
		$html = self::getHtml ( $url );
		$dom->load ( $html );
		return $dom;
	}
	public static function getHtml($url) {
		$client = new Client ();
		$response = $client->get ( $url, [ 
				'verify' => false,
				'timeout' => 10
		] );
		if ($response->getStatusCode () != 200) {
			$error = '%s: Bad HTTP response code, url is %s, status code is %d.';
			$error = sprintf ( $error, __METHOD__, $url, $response->getStatusCode () );
			Log::error ( $error );
			throw new \Exception ( $error, 0 );
		}
		return $response->getBody ()->__toString ();
	}
	public static function chtonum($str = '') {
		$unit = array (
				'亿' => 100000000,
				'万' => 10000,
				'千' => 1000,
				'仟' => 1000,
				'百' => 100,
				'十' => 10 
		);
		$num = array (
				'一' => 1,
				'二' => 2,
				'三' => 3,
				'四' => 4,
				'五' => 5,
				'六' => 6,
				'七' => 7,
				'八' => 8,
				'九' => 9 
		);
		$str = str_replace ( array_keys ( $num ), $num, $str );
		$result = array ();
		$number = '';
		preg_match_all ( '/[0-9]千[0-9]百[0-9]十[0-9]|[0-9]百[0-9]十[0-9]|[0-9]十[0-9]|[0-9]/ism', $str, $pnum );
		foreach ( $pnum [0] as $val ) {
			$tmp = '';
			for($i = 0; $i < mb_strlen ( $val, 'utf-8' ); $i ++) {
				$s = mb_substr ( $val, $i, 1, 'utf-8' );
				if (! is_numeric ( $s )) {
					$k = $unit [$s];
					if (strlen ( $tmp ) >= strlen ( $k )) {
						preg_match ( '/([0-9]*)([0-9]{' . (strlen ( $k ) - 1) . '})([0-9])/ism', $tmp, $n );
						$tmp = ($n [1] + $n [3]) . $n [2];
					} else {
						$tmp = $tmp * $k;
					}
				} else if ($i == (mb_strlen ( $val, 'utf-8' ) - 1)) {
					$tmp += $s;
				} else {
					$tmp .= $s;
				}
			}
			$nnum [] = $tmp;
		}
		$result = str_replace ( array_keys ( $unit ), ';', str_replace ( $pnum [0], $nnum, $str ) );
		foreach ( explode ( ';', $result ) as $val ) {
			$number .= sprintf ( '%04d', $val );
		}
		return sprintf ( '%2u', $number );
	}
}