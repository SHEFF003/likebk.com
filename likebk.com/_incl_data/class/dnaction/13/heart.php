<?
if( isset($s[1]) && $s[1] == '13/heart' ) {
	//Выбираем текущий квест
	$quest = mysql_fetch_array(mysql_query('SELECT * FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` LIKE "%start_quest258%" AND `vals` = "go" LIMIT 1'));
		if(isset($quest['id'])) {
			//Проверяем наличие тюбика
			$tb = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `item_id` = 3063 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1')); 
			if(isset($tb['id'])) {
				//Завершаем квест и выдаем награду
				mysql_query('UPDATE `actions` SET `vals` = "heart" WHERE `id` = "'.$quest['id'].'" LIMIT 1');
				
				$u->rep['repabandonedplain'] += 400;
				
				mysql_query('UPDATE `rep` SET `repabandonedplain` = "'.$u->rep['repabandonedplain'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
				$effect = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `id_eff` = 491 AND `delete` = 0 LIMIT 1'));
				
				if(isset($effect['id'])) {
					mysql_query('UPDATE `eff_users` SET `timeUse` = '.time().' WHERE `id` = '.$effect['id'].' LIMIT 1');
				}else{
					mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`user_use`,`img2`,`x`,`hod`,`file_finish`) VALUES ("491","'.$u->info['id'].'","Воздействие Сердца Горы","add_speed_dungeon=25|dn_delete=1","86","'.time().'","","","1","-1","")');
				}
				
				mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$tb['id'].'"');
				
				$r = 'Вы завершили задание: Смазка: Сердце Горы';
				
			}else{
				$r = 'У вас нет Тюбика со Смазкой';
			}
		}else{
			$r = 'У вас нет задания: Смазка: Сердце Горы';
		}
	
}

?>