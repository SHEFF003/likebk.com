<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'exitbtl' ) {
	
	
	
	$pvr = array();
	
	//Действие при клике
	if( $u->stats['hpNow'] >= 1 && $u->info['admin'] == 0) {
		$u->error = '<font color=red><b>Вы должны погибнуть чтобы воспользоваться этим свитком...</b></font>';
	}elseif( isset($btl->info['id']) ) {		
		if( $btl->info['dn_id'] > 0 || $btl->info['izlom'] > 0 ) {
			$u->error = '<font color=red><b>Магия не действует в пещерах и подобных локациях...</b></font>';	
		}elseif( $btl->info['noinc'] > 0 && $u->stats['hpNow'] >= 1 ) {
			$u->error = '<font color=red><b>Бой изолирован и вы не можете его покинуть пока не погибните</b></font>';	
		}else{			
			$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],
				'',
				'{tm1} {u1} сбежал с поля боя... ',
				($btl->hodID)
			);			
			$u->error = '<font color=red><b>Вы сбежали с поля боя и потеряли всю энергию...</b></font>';
			//	
			mysql_query('INSERT INTO `users_noatack` (`uid`,`time`,`battle`) VALUES ("'.$u->info['id'].'","'.(time()+5*60).'","'.$u->info['battle'].'")');
			//	
			mysql_query('DELETE FROM `battle_rune_exp` WHERE `uid` = "'.$u->info['id'].'"');
			mysql_query('UPDATE `stats` SET `battle_yron` = 0, `battle_exp` = 0, `hpNow` = 0, `mpNow` = 0 , `tactic1` = 0 , `tactic2` = 0 , `tactic3` = 0 , `tactic4` = 0 , `tactic5` = 0 , `tactic6` = 0 , `tactic7` = -1 , `last_pr` = 0 , `last_hp` = -1 WHERE `id` = '.$u->info['id'].' LIMIT 1');
			mysql_query('UPDATE `users` SET `battle` = 0 WHERE `id` = '.$u->info['id'].' LIMIT 1');
			//
			mysql_query('DELETE FROM `eff_users` WHERE `v1` = "priem" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0');
			mysql_query('DELETE FROM `battle_users` WHERE `uid` = "'.$u->info['id'].'" AND `finish` = 0');
			//
			mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
		}
		
	}else{
		$u->error = '<font color=red><b>Свиток возможно использовать только в бою</b></font>';
	}
	
	//Отнимаем тактики
	//$this->mintr($pl);
	
	unset($pvr);
}
?>