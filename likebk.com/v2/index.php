<?php

function utf1251($val) {	
	return iconv("CP1251", "UTF8", $val);
}

ini_set('display_errors', 1);

define('OK', time());
define('TZ', -180);

if(isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
	//CLOUD_CONFIG
	define('IP', $_SERVER["HTTP_CF_CONNECTING_IP"]);
	define('CO', $_SERVER["HTTP_CF_IPCOUNTRY"]);
}else{
	define('IP', $_SERVER['REMOTE_ADDR']);
	define('CO','??');
}

if(!isset($_SERVER['HTTP_USER_AGENT'])) {
	$_SERVER['HTTP_USER_AGENT'] = 'nodeJS';
}

define('BS',$_SERVER['HTTP_USER_AGENT']);
define('DEV_MODE', IP == '127.0.0.1');
define('DOMAIN', 'likebk.com/v2/');
define('IMAGES', 'likebk.com/v2/static/images');
define('DS'	, DIRECTORY_SEPARATOR);
define('PROJECT_PATH', __DIR__);
define('APP_PATH', __DIR__ . DS . 'app');

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'like');
define('DB_USER', 'like');
define('DB_PASS', '23wesdxc');

define('RIGHTS', 'likebk.com');
define('COPY', 'LikeBK <sup>v2.0</sup> &copy; 2016-'.date('Y',OK).'');

define('MOD_VERSION', '0.0.0.2.'.OK.'');

require APP_PATH . DS . 'init.php';
?>