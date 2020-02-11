<?php

/*

	ßäðî äëÿ îáðàáîòêè äàííûõ.
	Îáðàáîòêà ïîåäèíêîâ, îáðàáîòêà çàÿâîê, îáðàáîòêà áîòîâ, îáðàáîòêà ïåùåð, îáðàáîòêà òóðíèðîâ, îáðàáîòêà âðåìåííûõ ãåíåðàöèé

*/



//if( $_SERVER['HTTP_CF_CONNECTING_IP'] != $_SERVER['SERVER_ADDR'] && $_SERVER['HTTP_CF_CONNECTING_IP'] != '127.0.0.1' ) {	die('Hello pussy!');   }

function getIP() {
   if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
   return $_SERVER['REMOTE_ADDR'];
}

if(getIP() != $_SERVER['SERVER_ADDR'] && getIP() != '127.0.0.1' && getIP() != '' && getIP() != '212.224.113.192') {
	//die(getIP().'<br>'.$_SERVER['SERVER_ADDR']);
}


define('GAME',true);

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');

function e($t) {
	mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("core #'.date('d.m.Y').' %'.date('H:i:s').' (Êðèòè÷åñêàÿ îøèáêà): <b>'.mysql_real_escape_string($t).'</b>","capitalcity","LEL","6","1","-1")');
}

$count = array(
	0, //çàâåðøåííûõ ïîåäèíêîâ
	0,
	0,
	0,
	0,
	0
);

function clear_user($plid) {
		mysql_query('UPDATE `users` SET `login` = "delete",`login2` = `login` WHERE `id` = "'.$plid.'" LIMIT 1');
	/*	mysql_query('DELETE FROM `users` WHERE `id` = "'.$plid.'" LIMIT 1');
		mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$plid.'"');
		mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$plid.'"');
		mysql_query('DELETE FROM `bank` WHERE `uid` = "'.$plid.'"');*/
}

$sp = mysql_query('SELECT `id` FROM `users` WHERE `cityreg` = "" && `timereg` = "0" LIMIT 100');
while($pl = mysql_fetch_array($sp)) {
	$n_st = mysql_fetch_array(mysql_query('SELECT `id` FROM `stats` WHERE `id` = "'.$pl['id'].'" LIMIT 1'));
	if(!isset($n_st['id'])) {
		clear_user($pl['id']);
	}
}

function inuser_go_btl($id) {
	if(isset($id['id'])) {
		file_get_contents('http://likebk.com/jx/battle/refresh.php?uid='.$id['id'].'&cron_core='.md5($id['id'].'_brfCOreW@!_'.$id['pass']).'&pass='.$id['pass']);
	}
}

/* ñ÷èòàåì ïîåäèíêè */
//e('îáðàáîòêà îòìåíåíà.');
/*$sp = mysql_query('SELECT `id`,`time_start` FROM `battle` WHERE `team_win` = "-1" AND `time_over` = "0" LIMIT 100');
while($pl = mysql_fetch_array($sp)) {
	if($pl['time_start'] < time() - 3600) {
		// Ïîåäèíîê íà÷àëñÿ áîëåå 1 ÷àñà íàçàä, åñëè ïîñëåäíåå äåéñòâèå áûëî ñîâåðøåíî áîëåå 1 ÷àñà íàçàä - çàâåðøàåì ïîåäèíîê - ÍÈ×Üß
		$act = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_logs` WHERE `battle` = "'.$pl['id'].'" AND `time` < "'.(time()-7200).'" LIMIT 1'));
		$acz = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `battle_logs` WHERE `battle` = "'.$pl['id'].'" LIMIT 1'));
		if(isset($act['id']) || $acz[0] < 1 || $pl['time_start'] < time() - 86400 * 3 ) {
			//Âñåì â áîþ äåëàåì 0 ÍÐ
			$usrs = '';
			$user_in = 0;
			$sp1 = mysql_query('SELECT `id`,`login`,`pass` FROM `users` WHERE `battle` = "'.$pl['id'].'"');
			while($pl1 = mysql_fetch_array($sp1)) {
				if($user_in == 0) {
					$user_in = array('id'=>$pl1['id'],'login'=>$pl1['login'],'pass'=>$pl1['pass']);
				}
				$usrs .= '`id` = "'.$pl1['id'].'" OR';
			}
			if($usrs != '') {
				$usrs = rtrim($usrs,' OR');
				mysql_query('UPDATE `stats` SET `hpNow` = "0",`mpNow` = "0" WHERE '.$usrs);
				
				//Âñèëÿåìñÿ â ó÷àñòíèêà áîÿ
				inuser_go_btl($user_in);				
				//
				mysql_query('UPDATE `battle` SET `team_win` = "0",`time_over` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
			}else{
				mysql_query('UPDATE `battle` SET `team_win` = "0",`time_over` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
			}
			$count[0]++;
		}
	}
}*/
?>