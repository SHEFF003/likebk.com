<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'sivorotka' ) {	

	$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = '.$u->info['id'].' (AND `id_eff` >= 495 AND `id_eff` <= 499 OR (`id_eff` = 501 OR `id_eff` = 503 OR `id_eff` = 504)) AND `delete` = 0 LIMIT 1'));
	
	$m = mysql_fetch_array(mysql_query('SELECT `mname` FROM `eff_main` WHERE `id2` = '.$eff['id_eff'].' LIMIT 1'));
	
	if(isset($eff['id'])) {
		mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$eff['id'].'"');
		$u->error = 'Вы избавились от '.$m['mname'].'';
		mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
	}else{
		$u->error = 'У вас нет проклятий';
	}
}
?>