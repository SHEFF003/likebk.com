<?php

define('GAME',true);

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');


if(isset($_GET['help'])) {
	$ac = array();
	$sp = mysql_query('SELECT `id`,`vars` FROM `actions`');
	while( $pl = mysql_fetch_array($sp) ) {
		$pl['vars'] = preg_replace("/[0-9]{1}/", "", $pl['vars']); 
		$ac[$pl['vars']]++;
	}
	print_r($ac);
	die();
}elseif(isset($_GET['actions'])) {
	/*	
	( `vars` LIKE "%win_bot%" AND `time` < "'.( time() - 86400*8 ).'" ) OR
	*/
	$dl = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `actions` WHERE	
	`vars` LIKE "%animal_use%" OR
	`vars` LIKE "%lose_bot%" OR
	`vars` LIKE "%lose_bot_clone%" OR
	`vars` LIKE "%msg_bans%" OR
	`vars` LIKE "%nich_bot%" OR
	`vars` LIKE "%nich_bot_clone%" OR
	`vars` LIKE "%sel_obraz%" OR
	`vars` LIKE "%win_bot_clone%" OR
	( `vars` LIKE "%takeit%" AND `time` < "'.( time() - 86400*3 ).'" ) OR
	( `vars` LIKE "%use_priem%" AND `time` < "'.( time() - 86400*2 ).'" ) OR	
	( `vars` LIKE "%psh%" AND `time` < "'.( time() - 86400 ).'" ) OR
	( `vars` LIKE "%statistic_today%" AND `time` < "'.( time() - 86400*2 ).'" )	'));
	
	mysql_query('DELETE FROM `actions` WHERE	
	`vars` LIKE "%animal_use%" OR
	`vars` LIKE "%lose_bot%" OR
	`vars` LIKE "%lose_bot_clone%" OR
	`vars` LIKE "%msg_bans%" OR
	`vars` LIKE "%nich_bot%" OR
	`vars` LIKE "%nich_bot_clone%" OR
	`vars` LIKE "%sel_obraz%" OR
	`vars` LIKE "%win_bot_clone%" OR
	( `vars` LIKE "%takeit%" AND `time` < "'.( time() - 86400*3 ).'" ) OR
	( `vars` LIKE "%use_priem%" AND `time` < "'.( time() - 86400*2 ).'" ) OR	
	( `vars` LIKE "%psh%" AND `time` < "'.( time() - 86400 ).'" ) OR
	( `vars` LIKE "%statistic_today%" AND `time` < "'.( time() - 86400*2 ).'" )	
	');
	
	echo '[Удалено '.$dl[0].' записей]';
	die();
}

mysql_query('DELETE FROM `dungeon_bots` WHERE `for_dn` = 0 AND `dn` NOT IN (SELECT `id` FROM `dungeon_now`)');
mysql_query('DELETE FROM `dungeon_obj` WHERE `for_dn` = 0 AND `dn` NOT IN (SELECT `id` FROM `dungeon_now`)');
mysql_query('DELETE FROM `eff_users` WHERE `delete` > 0 AND `id_eff` != 555');
mysql_query('DELETE FROM `items_users` WHERE `delete` > 0 AND `delete` != 1357908642 AND `uid` > 0');
mysql_query('DELETE FROM `users_delo` WHERE `uid` NOT IN (SELECT `id` FROM `users`)');
//mysql_query('DELETE FROM `users` WHERE `id` > 0 AND `id` NOT IN (SELECT `id` FROM `stats`)');
//mysql_query('DELETE FROM `stats` WHERE `id` > 0 AND `id` NOT IN (SELECT `id` FROM `users`)');
mysql_query('DELETE FROM `actions` WHERE `uid` > 0 AND `uid` NOT IN (SELECT `id` FROM `users`)');
mysql_query('DELETE FROM `chat` WHERE `time` < "'.( time() - 86400 ).'" AND `delete` = 0 AND `spam` = 0');

mysql_query('DELETE FROM `battle_logs` WHERE `time` < "'.( time() - 86400 ).'"`');
mysql_query('DELETE FROM `battle_users` WHERE `time` < "'.( time() - 86400 ).'"`');
mysql_query('DELETE FROM `battle_stat` WHERE `time` < "'.( time() - 86400 ).'"`');
mysql_query('DELETE FROM `battle_last` WHERE `time` < "'.( time() - 86400 ).'"`');
mysql_query('DELETE FROM `battle_end` WHERE `time` < "'.( time() - 86400 ).'"`');
mysql_query('DELETE FROM `battle_act` WHERE `time` < "'.( time() - 86400 ).'"`');
?>