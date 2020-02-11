<?php
if(!defined('GAME'))
{
	die();
}

if(!function_exists('GetRealIp')) {
	function GetRealIpTest(){
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			return $_SERVER['HTTP_CLIENT_IP'];
		else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		return $_SERVER['REMOTE_ADDR'];
	}
	$ipban = GetRealIpTest();
}else{
	$ipban = GetRealIp();
}

$dbgo = mysql_connect('localhost','like','23wesdxc');
mysql_select_db('like',$dbgo);
mysql_query('SET NAMES cp1251');

	mysql_query('INSERT INTO `files_look` (`ip`,`user`,`ref`,`time`,`file`,`url`) VALUES (
		"'.mysql_real_escape_string($ipban).'","'.mysql_real_escape_string($_COOKIE['login']).'"
		,"'.mysql_real_escape_string($_SERVER['HTTP_REFERER']).'","'.time().'"
		,"'.mysql_real_escape_string($_SERVER['SCRIPT_NAME']).'"
		,"'.mysql_real_escape_string($_SERVER['REQUEST_URI']).'"
		
	)');

?>
