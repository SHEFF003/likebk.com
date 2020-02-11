<?php

namespace Core;

class Route {
	
	public static $json_return = false, $device = 'PC', $device_type = 'PC', $device_id = 0;
	
	public static function begin() {
		
	
		if ( isset($_SERVER['HTTP_ACCEPT']) && in_array('application/json', explode(',', $_SERVER['HTTP_ACCEPT'])) ) {
			self::$json_return = true;
		}
	
		$url_data = parse_url($_SERVER['REQUEST_URI']);
		$uri = urldecode($url_data['path']);

		$urls = array(
			'/v2/+' 									=> 'index',
			
			'/v2/getJsUser'								=> 'jsuser',
			
			'/v2/invAction'									=> 'inventory',
			'/v2/invAction/([\s+a-zA-Zа-яА-Я0-9._-с\/])+'	=> 'inventory',
			
			'/v2/proxy'									=> 'pch',
			'/v2/proxy/([\s+a-zA-Zа-яА-Я0-9._-с\/])+'	=> 'pch',
			
			'/v2/ticket'								=> 'tickets'
		);
		
		$found_module = false;
		
		foreach ( $urls as $url => $handler ) {
			if ( preg_match("#^" . $url . "/*$#", $uri) ) {
					$class_name = APP_PATH . DS . 'logic' . DS . $handler;
					if(file_exists($class_name.'.php')) {
						require $class_name.'.php';
					}else{
						self::ErrorClass404($handler,$class_name);
					}
				break;		
			} else {
				continue;
			}
		}
		
		if ( !$found_module ) {
			self::ErrorPage404();	
		}
	}

	public static function redirect($url) {
		header('Location: ' . $url);		
	}
	
	public static function ErrorPage404() {
		die('Page is not found.');
	}
	
	public static function ErrorClass404($name,$class_name) {
		die('Expansion Logic\\'. $name .' is not found.');
	}
}

?>