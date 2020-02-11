<?php
define('GAME',true);

//

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');

$sp = mysql_query('SELECT * FROM `eff_users` WHERE `delete` = 0 AND `endtime` > "'.time().'"');
while( $pl = mysql_fetch_array($sp) ) {
	//
	$usr = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`city`,`room`,`online` FROM `users` WHERE `id` = "'.$pl['uid'].'" LIMIT 1'));
	$sts = mysql_fetch_array(mysql_query('SELECT `id`,`zv` FROM `stats` WHERE `id` = "'.$pl['uid'].'" LIMIT 1'));
	if($sts['zv'] > 0) {
		$zvs = mysql_fetch_array(mysql_query('SELECT `id` FROM `zayvki` WHERE `id` = "'.$sts['zv'].'" AND `razdel` = 5 LIMIT 1'));
		echo 2;
		if(isset($zvs['id'])) {
			//
			echo 1;
			mysql_query('UPDATE `eff_users` SET `timeUse` = `timeUse` + 70 WHERE `id` = "'.$pl['id'].'" LIMIT 1');
			//
		}
	}
}

$sp = mysql_query('SELECT * FROM `eff_users` WHERE `endtime` > 0 AND `delete` = 0 AND `v1` != "priem" AND `endtime` != 77 AND `sleeptime` = 0 AND `endfx` != `endtime`
AND	(`endtime` - "'.time().'" > 0) AND (`endtime` - "'.time().'" < 600)');
while( $pl = mysql_fetch_array($sp) ) {
	//
	if(isset($usr['id']) && $usr['online'] > time() - 120) {
		//
		if( $pl['endtime'] - time() > 0 && round(($pl['endtime'] - time()) / 60) > 0 ) {
			/*mysql_query("
				INSERT INTO `chat` (
					`invis`, `dn`, `login`, `to`, `city`, `room`, `effect`, `time`, `type`,`spam`,
					
					`text`,
					
					`toChat`, `color`, `typeTime`, `sound`, `global`, `delete`, `new`, `ip`, `molch`, `da`, `jalo`, `active`
				) VALUES (
					0, 0, '', '".mysql_real_escape_string($usr['login'])."', '".$usr['city']."', ".$usr['room'].", '', ".time().", 6, 0,
					
					'Ёффект &quot;<b title=".$usr['id']." >".$pl['name']."</b>&quot; будет действовать менее ".round(($pl['endtime'] - time()) / 60)." мин.!',
					
					0, '#000000', 0, 0, 0, 0, 1, '', 0, 0, 0, 0);
			");*/
		}
		mysql_query('UPDATE `eff_users` SET `endfx` = `endtime` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		echo '@';
	}
	echo '#';
}

?>
