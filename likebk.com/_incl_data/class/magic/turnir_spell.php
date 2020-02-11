<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'turnir_spell' ) {
	//
	mysql_query('UPDATE `happy_quest` SET `q3_2` = `q3_2` + 1 WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
	//
	if( $itm['item_id'] == 6834 ) {
		$u->error = 'Теперь вы можете вступить в турнир без ограничений! Только один раз!';
		mysql_query('DELETE FROM `turnir_go` WHERE `uid` = "'.$u->info['id'].'"');
		mysql_query('INSERT INTO `turnir_go` (`uid`,`time`) VALUES ("'.$u->info['id'].'","'.time().'")');
		mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
	}elseif( $itm['item_id'] >= 6835 && $itm['item_id'] <= 6842 ) {
		$u->error = 'Свиток добавлен в турнирную заявку!';
		mysql_query('INSERT INTO `turnir_spell` (`uid`,`item_id`) VALUES ("'.$u->info['id'].'","'.$itm['item_id'].'")');
		mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
	}else{
		$u->error = 'Что-то здесь не так...';
	}
}
?>