<?php
define('GAME',true);

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

//`online` >= "'..'"
$timeMin = strtotime("now 00:00:00");
$user = mysql_query('SELECT * FROM `users` WHERE `real` = 1 AND `pass` != "saintlucia5"  AND `pass` != "saintlucia"');
while($us = mysql_fetch_array($user)){
	/*$daily = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dailybonus` WHERE `uid` = "'.$us['id'].'" '));
	$i = $daily[0];
	if($i == 7){
		echo $us['login'].'<br>';
		mysql_query('DELETE FROM `dailybonus` WHERE `uid` = '.$us['id'].' ');
	}*/
	if($us['online'] < $timeMin - 86400){
		mysql_query('DELETE FROM `dailybonus` WHERE `uid` = '.$us['id'].' ');
		mysql_query('DELETE FROM `dailyprize` WHERE `uid` = '.$us['id'].' ');
	}else{
		$flag = 0;
		$daily = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dailybonus` WHERE `uid` = "'.$us['id'].'" '));
		$i = $daily[0];

		$online = mysql_fetch_array(mysql_query('SELECT `time_today` FROM `online` WHERE `uid` = "'.$us['id'].'"'));
		$battle = mysql_fetch_array(mysql_query('SELECT `date` FROM `dailybattle` WHERE `uid` = "'.$us['id'].'"'));

		$bonus_online = array(
			0=>7200, 
			1=>10800,
			2=>14400,
			3=>18000,
			4=>21600,
			5=>25200,
			6=>28800
		);
		$btl = array(
			0=>10, 
			1=>15, 
			2=>20, 
			3=>25, 
			4=>30, 
			5=>35, 
			6=>40
		);
		if($online['time_today'] >=  $bonus_online[$i] && $battle['date'] >=  $btl[$i]){
			$flag = 1;
		}
		if($flag == 1){
			$ins = mysql_query('INSERT INTO `dailybonus` (`uid`,`date`,`bonus_flag`) VALUES (
						"'.$us['id'].'",
						"'.time().'",
						"0")');
		}else{
			mysql_query('DELETE FROM `dailybonus` WHERE `uid` = '.$us['id'].' ');
		}
		if($i == 6){
			mysql_query('DELETE FROM `dailybonus` WHERE `uid` = '.$us['id'].' ');
		}
		mysql_query('DELETE FROM `dailybattle` WHERE `uid` = '.$us['id'].' ');
		mysql_query('DELETE FROM `dailyprize` WHERE `uid` = '.$us['id'].' ');
	}
}
?>