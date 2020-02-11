<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'antidot2' ) {	
	$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = '.$u->info['id'].' AND (`id_eff` >= 427 AND `id_eff` <= 432 OR (`id_eff` >= 481 AND `id_eff` <= 485 ) OR (`id_eff` = 501 OR `id_eff` = 503 OR `id_eff` = 504)) AND `name` NOT LIKE "%Печать Хаоса%" AND `delete` = 0 ORDER BY `id` DESC LIMIT 1'));
	if(isset($eff['id']) && $eff['delete'] == 0) {
		
		$main = mysql_fetch_array(mysql_query('SELECT `mname` FROM `eff_main` WHERE `id2` = "'.$eff['id_eff'].'" LIMIT 1'));
		
		if($eff['id_eff'] == 481) {
			mysql_query('UPDATE `stats` SET `timeGo` = "'.time().'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}
		
		mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$eff['id'].'"');
		$u->error = 'Вы исцелились от болезни "'.$main['mname'].'", будь здоров :)';
		mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
	}else{
		$u->error = 'У вас нет болезней...';
	}
}
?>