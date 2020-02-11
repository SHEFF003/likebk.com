<?
if(!defined('GAME'))
{
	die();
}

if($itm['magic_inci'] == "prkl_ptp" && $itm['item_id'] == 8202) {
	if($usr['login'] == $u->info['login']) {
		$u->error = 'Нельзя использовать на себя';
	}elseif($u->info['room']!=$usr['room'] && $usr['battle'] == 0) {
		$u->error = 'Вы должны находится в одной комнате, с персонажем: '.$u->microLogin($usr['id'],1).'';
    }elseif($usr['online'] < time()-520 ) {
		$u->error = 'Персонаж находится в реальном мире ;)';
	}else{
		$now = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$usr['id'].'" AND `delete` = 0 AND `data` LIKE "%from_ptp%" LIMIT 1'));
		if(isset($now['id'])) {
			mysql_query('DELETE FROM `eff_users` WHERE `id` = '.$now['id'].'');
		}
		if($usr['battle'] > 0) {
			$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],'','{tm1} {u1} использовал <b>'.$itm['name'].'</b> на персонажа {u2} ',($btl->hodID));	
			$add_eff = mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`x`,`hod`,`mark`,`v1`,`img2`) VALUES ("445","'.$usr['id'].'","Проклятье Умирающей Земли","add_pm4=-20|from_ptp","81","77","1","-1","1","priem","spell_ug_undam4c.gif")');
		}else{
			$add_eff = mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`x`,`hod`,`mark`) VALUES ("445","'.$usr['id'].'","Проклятье Умирающей Земли","add_pm4=-20|from_ptp","81","'.time().'","1","0","1") ');
		}
		if($add_eff) {
			mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			$u->error = 'Вы успешно использовали "'.$itm['name'].'" на персонажа: '.$u->microLogin($usr['id'],1).'';
		}else{
			$u->error = 'Ошибка!';
		}
	}
}elseif($itm['magic_inci'] == "prkl_ptp" && $itm['item_id'] == 8203) {
	if($usr['login'] == $u->info['login']) {
		$u->error = 'Нельзя использовать на себя';
	}elseif($u->info['room']!=$usr['room'] && $usr['battle'] == 0) {
		$u->error = 'Вы должны находится в одной комнате, с персонажем: '.$u->microLogin($usr['id'],1).'';
    }elseif($usr['online'] < time()-520 ) {
		$u->error = 'Персонаж находится в реальном мире ;)';
	}else{
		$now = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$usr['id'].'" AND `delete` = 0 AND `data` LIKE "%from_ptp%" LIMIT 1'));
		if(isset($now['id'])) {
			mysql_query('DELETE FROM `eff_users` WHERE `id` = '.$now['id'].'');
		}
		if($usr['battle'] > 0) {
			$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],'','{tm1} {u1} использовал <b>'.$itm['name'].'</b> на персонажа {u2} ',($btl->hodID));	
			$add_eff = mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`x`,`hod`,`mark`,`v1`,`img2`) VALUES ("446","'.$usr['id'].'","Проклятье угасающего огня","add_pm1=-20|from_ptp","81","77","1","-1","1","priem","spell_ug_undam1c.gif")');
		}else{
			$add_eff = mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`x`,`hod`,`mark`) VALUES ("446","'.$usr['id'].'","Проклятье угасающего огня","add_pm1=-20|from_ptp","81","'.time().'","1","0","1") ');
		}
		if($add_eff) {
			mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			$u->error = 'Вы успешно использовали "'.$itm['name'].'" на персонажа: '.$u->microLogin($usr['id'],1).'';
		}else{
			$u->error = 'Ошибка!';
		}
	}
}elseif($itm['magic_inci'] == "prkl_ptp" && $itm['item_id'] == 8204) {
	if($usr['login'] == $u->info['login']) {
		$u->error = 'Нельзя использовать на себя';
	}elseif($u->info['room']!=$usr['room'] && $usr['battle'] == 0) {
		$u->error = 'Вы должны находится в одной комнате, с персонажем: '.$u->microLogin($usr['id'],1).'';
    }elseif($usr['online'] < time()-520 ) {
		$u->error = 'Персонаж находится в реальном мире ;)';
	}else{
		$now = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$usr['id'].'" AND `delete` = 0 AND `data` LIKE "%from_ptp%" LIMIT 1'));
		if(isset($now['id'])) {
			mysql_query('DELETE FROM `eff_users` WHERE `id` = '.$now['id'].'');
		}
		if($usr['battle'] > 0) {
			$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],'','{tm1} {u1} использовал <b>'.$itm['name'].'</b> на персонажа {u2} ',($btl->hodID));	
			$add_eff = mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`x`,`hod`,`mark`,`v1`,`img2`) VALUES ("447","'.$usr['id'].'","Проклятье замерзающей воды","add_pm3=-20|from_ptp","81","77","1","-1","1","priem","spell_ug_undam2c.gif")');
		}else{
			$add_eff = mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`x`,`hod`,`mark`) VALUES ("447","'.$usr['id'].'","Проклятье замерзающей воды","add_pm3=-20|from_ptp","81","'.time().'","1","0","1") ');
		}
		if($add_eff) {
			mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			$u->error = 'Вы успешно использовали "'.$itm['name'].'" на персонажа: '.$u->microLogin($usr['id'],1).'';
		}else{
			$u->error = 'Ошибка!';
		}
	}
}elseif($itm['magic_inci'] == "prkl_ptp" && $itm['item_id'] == 8205) {
	if($usr['login'] == $u->info['login']) {
		$u->error = 'Нельзя использовать на себя';
	}elseif($u->info['room']!=$usr['room'] && $usr['battle'] == 0) {
		$u->error = 'Вы должны находится в одной комнате, с персонажем: '.$u->microLogin($usr['id'],1).'';
    }elseif($usr['online'] < time()-520 ) {
		$u->error = 'Персонаж находится в реальном мире ;)';
	}else{
		$now = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$usr['id'].'" AND `delete` = 0 AND `data` LIKE "%from_ptp%" LIMIT 1'));
		if(isset($now['id'])) {
			mysql_query('DELETE FROM `eff_users` WHERE `id` = '.$now['id'].'');
		}
		if($usr['battle'] > 0) {
			$add_eff = mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`x`,`hod`,`mark`,`v1`,`img2`) VALUES ("448","'.$usr['id'].'","Проклятье стихающего ветра","add_pm2=-20|from_ptp","81","77","1","-1","1","priem","spell_ug_undam3c.gif")');
			
			$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],'','{tm1} {u1} использовал <b>'.$itm['name'].'</b> на персонажа {u2} ',($btl->hodID));	
		}else{
			$add_eff = mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`x`,`hod`,`mark`) VALUES ("448","'.$usr['id'].'","Проклятье стихающего ветра","add_pm2=-20|from_ptp","81","'.time().'","1","0","1") ');
		}
		if($add_eff) {
			mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			$u->error = 'Вы успешно использовали "'.$itm['name'].'" на персонажа: '.$u->microLogin($usr['id'],1).'';
		}else{
			$u->error = 'Ошибка!';
		}
	}
}elseif($itm['magic_inci'] == "prkl_ptp" && $itm['item_id'] == 8206) {
	if($usr['login'] == $u->info['login']) {
		$u->error = 'Нельзя использовать на себя';
	}elseif($u->info['room']!=$usr['room'] && $usr['battle'] == 0) {
		$u->error = 'Вы должны находится в одной комнате, с персонажем: '.$u->microLogin($usr['id'],1).'';
    }elseif($usr['online'] < time()-520 ) {
		$u->error = 'Персонаж находится в реальном мире ;)';
	}else{
		$now = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$usr['id'].'" AND `delete` = 0 AND `data` LIKE "%ptp_from%" LIMIT 1'));
		if(isset($now['id'])) {
			mysql_query('DELETE FROM `eff_users` WHERE `id` = '.$now['id'].'');
		}
		if($usr['battle'] > 0) {
			$add_eff = mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`x`,`hod`,`mark`,`v1`,`img2`) VALUES ("449","'.$usr['id'].'","Проклятье Уязвимости","add_za=-100|ptp_from","81","77","1","-1","1","priem","spell_ug_unp10c.gif")');
			
			$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],'','{tm1} {u1} использовал <b>'.$itm['name'].'</b> на персонажа {u2} ',($btl->hodID));	
		}else{
			$add_eff = mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`x`,`hod`,`mark`) VALUES ("449","'.$usr['id'].'","Проклятье Уязвимости","add_za=-100|ptp_from","81","'.time().'","1","0","1") ');
		}
		if($add_eff) {
			mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			$u->error = 'Вы успешно использовали "'.$itm['name'].'" на персонажа: '.$u->microLogin($usr['id'],1).'';
		}else{
			$u->error = 'Ошибка!';
		}
	}
}elseif($itm['magic_inci'] == "prkl_ptp" && $itm['item_id'] == 8207) {
	if($usr['login'] == $u->info['login']) {
		$u->error = 'Нельзя использовать на себя';
	}elseif($u->info['room']!=$usr['room'] && $usr['battle'] == 0) {
		$u->error = 'Вы должны находится в одной комнате, с персонажем: '.$u->microLogin($usr['id'],1).'';
    }elseif($usr['online'] < time()-520 ) {
		$u->error = 'Персонаж находится в реальном мире ;)';
	}else{
		$now = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$usr['id'].'" AND `delete` = 0 AND `data` LIKE "%fromptp%" LIMIT 1'));
		if(isset($now['id'])) {
			mysql_query('DELETE FROM `eff_users` WHERE `id` = '.$now['id'].'');
		}
		if($usr['battle'] > 0) {
			$add_eff = mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`x`,`hod`,`mark`,`v1`,`img2`) VALUES ("450","'.$usr['id'].'","Проклятье легкого отупения","add_min_use_mp=10|fromptp","81","77","1","-1","1","priem","spell_ug_unexprc.gif")');
			$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],'','{tm1} {u1} использовал <b>'.$itm['name'].'</b> на персонажа {u2} ',($btl->hodID));	
		}else{
			$add_eff = mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`x`,`hod`,`mark`) VALUES ("450","'.$usr['id'].'","Проклятье легкого отупения","add_min_use_mp=10|fromptp","81","'.time().'","1","0","1") ');
		}
		if($add_eff) {
			mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			$u->error = 'Вы успешно использовали "'.$itm['name'].'" на персонажа: '.$u->microLogin($usr['id'],1).'';
		}else{
			$u->error = 'Ошибка!';
		}
	}
}
?>