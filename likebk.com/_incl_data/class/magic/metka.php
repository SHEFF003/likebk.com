<?
if(!defined('GAME'))
{
	die();
}

if($itm['magic_inci'] == "metka" && $itm['item_id'] == 8200) {
	if($usr['online'] < time()-520 ) {
		$u->error = 'Персонаж находится в реальном мире ;)';
	}elseif($usr['atack'] > time() - 86400 ||  $usr['atack2'] > time() - 86400) {
		$u->error = 'На персонаже: '.$u->microLogin($usr['id'],1).' уже есть метка!';
	}elseif($u->info['room'] != $usr['room']) {
		$u->error = 'Вы должны находится в одной комнате, с персонажем: '.$u->microLogin($usr['id'],1).'';
	}elseif( ($usr['room'] == 214) || ($usr['room'] == 217) || ($usr['room'] == 218) || ($usr['room'] == 219) ) {
		$u->error = 'Персонаж: '.$u->microLogin($usr['id'],1).' находится в Общежитии';
	}elseif($usr['battle'] > 0) {
		$u->error = 'Персонаж '.$u->microLogin($usr['id'],1).' в поединке';
	}else{
		$mt = mysql_query('UPDATE `stats` SET `atack` = "'.(time() + 86400).'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
		if($mt) {
			$u->error = 'Вы успешно наложили заклятие: "'.$itm['name'].'" на персонажа '.$u->microLogin($usr['id'],1).'';
		}else{
			$u->error = 'Не удалось прочесть заклятие!';
		}
	}
}elseif($itm['magic_inci'] == "metka" && $itm['item_id'] == 8201) {
	if($usr['online'] < time()-520 ) {
		$u->error = 'Персонаж находится в реальном мире ;)';
	}elseif($usr['atack'] > time() - 86400 ||  $usr['atack2'] > time() - 86400) {
		$u->error = 'На персонаже: '.$u->microLogin($usr['id'],1).' уже есть метка!';
	}elseif($u->info['room'] != $usr['room']) {
		$u->error = 'Вы должны находится в одной комнате, с персонажем: '.$u->microLogin($usr['id'],1).'';
	}elseif( ($usr['room'] == 214) || ($usr['room'] == 217) || ($usr['room'] == 218) || ($usr['room'] == 219) ) {
		$u->error = 'Персонаж: '.$u->microLogin($usr['id'],1).' находится в Общежитии';
	}elseif($usr['battle'] > 0) {
		$u->error = 'Персонаж '.$u->microLogin($usr['id'],1).' в поединке';
	}else{
		$mt = mysql_query('UPDATE `stats` SET `atack2` = "'.(time() + 86400).'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
		if($mt) {
			$u->error = 'Вы успешно наложили заклятие: "'.$itm['name'].'" на персонажа '.$u->microLogin($usr['id'],1).'';
		}else{
			$u->error = 'Не удалось прочесть заклятие!';
		}
	}
}
?>