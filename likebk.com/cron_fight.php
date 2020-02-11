<?php
function getIP() {
   if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
   return $_SERVER['REMOTE_ADDR'];
}


define('GAME',true);
setlocale(LC_CTYPE ,"ru_RU.CP1251");
include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

function inuser_go_btl($id) {
	if(isset($id['id'])) {
		file_get_contents('http://likebk.com/jx/battle/refresh.php?uid='.$id['id'].'&cron_core='.md5($id['id'].'_brfCOreW@!_'.$id['pass']).'&pass='.$id['pass']);
	}
}

function finishBattle($id) {
	$testuser = mysql_fetch_array(mysql_query('SELECT `id`,`pass` FROM `users` WHERE `battle` = "'.$id.'" LIMIT 1'));
	if(isset($testuser['id'])) {
		mysql_query('UPDATE `stats` SET `hpNow` = 0 WHERE `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$id.'")');
		inuser_go_btl($testuser);
	}else{
		mysql_query('UPDATE `battle` SET `team_win` = 0 , `time_over` = "'.time().'" WHERE `id` = "'.$id.'" LIMIT 1');
	}	
}

$sp = mysql_query('SELECT * FROM `battle` WHERE `team_win` = -1 ORDER BY `id` DESC');
while( $pl = mysql_fetch_array($sp) ) {
	$test = mysql_fetch_array(mysql_query('SELECT * FROM `battle_logs` WHERE `battle` = "'.$pl['id'].'" ORDER BY `id` DESC LIMIT 1'));
	if(isset($test['id'])) {
		if( $test['time'] < time() - 60 * 30 ) {
			//Завершаем бой
			echo '[<a href="/logs.php?log='.$pl['id'].'">'.$pl['id'].'</a>]';
			finishBattle($pl['id']);
		}
	}elseif( $pl['time_start'] < time() - 60 * 30 ) {
		//Завершаем бой
		echo '[<a href="/logs.php?log='.$pl['id'].'">'.$pl['id'].'</a>]';
		finishBattle($pl['id']);
	}
}
?>