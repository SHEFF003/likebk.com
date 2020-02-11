<?php
if(!defined('GAME')) { die(); }

if(isset($file) && $file[0] == 'dungeons/106/atack3.php') {
	$test = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `vars` = "act_niz3" AND `dn` = "'.$u->info['dnow'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
	if($test[0] == 0) {
		$btl_id = 0;
			$expB = 0;
			$btl = array('players'=>'', 'timeout'=>180, 'type'=>0, 'invis'=>0, 'noinc'=>0, 'travmChance'=>0, 'typeBattle'=>0, 'addExp'=>$expB, 'money'=>0 );

			$ins = mysql_query('INSERT INTO `battle` (`dungeon`,`dn_id`,`x`,`y`,`city`,`time_start`,`players`,`timeout`,`type`,`invis`,`noinc`,`travmChance`,`typeBattle`,`addExp`,`money`,`room`) VALUES ("10", "'.$u->info['dnow'].'", "-12", "27", "'.$u->info['city'].'", "'.time().'", "'.$btl['players'].'", "'.$btl['timeout'].'", "'.$btl['type'].'", "'.$btl['invis'].'", "'.$btl['noinc'].'", "'.$btl['travmChance'].'", "'.$btl['typeBattle'].'", "'.$btl['addExp'].'", "'.$btl['money'].'", "'.$u->info['room'].'")');

			$btl_id = mysql_insert_id();
	
			if( $btl_id > 0 ) { //ƒобавл€ем ботов 
				$botw = mysql_query('SELECT * FROM `dungeon_bots` WHERE `dn` = '.$u->info['dnow'].' AND `x` = 19 AND `y` = -2 OR (`x` = 19 AND `y` = -1 OR `x` = 19 AND `y` = 0 OR `x` = 20 AND `y` = -1 OR `x` = 21 AND `y` = -2 OR `x` = 20 AND `y` = -4) AND `delete` = 0');
				while($pl = mysql_fetch_array($botw)) {
					
					if($pl['dn'] == $u->info['dnow']) {	
						$test = mysql_fetch_array(mysql_query('SELECT `login`,`level`,`sex`,`obraz`,`stats`,`priems` FROM `test_bot` WHERE `id` = '.$pl['id_bot'].' LIMIT 1'));
							//копируем пользовател€
						$values = '"9","'.$test['login'].'",'.$test['level'].',"bot_nizin","'.$u->info['city'].'","'.$u->info['city'].'","'.$test['login'].'",'.$test['sex'].',"","","'.time().'","'.$test['obraz'].'",'.$pl['id_bot'].',"0"';
						
						$ins1 = mysql_query('INSERT INTO `users` (`align`,`login`,`level`,`pass`,`city`,`cityreg`,`name`,`sex`,`deviz`,`hobby`,`timereg`,`obraz`,`bot_id`,`inTurnir`) VALUES ('.$values.')');
						
						$bots = mysql_insert_id();
					
						mysql_query('INSERT INTO `stats` (`id`,`stats`,`hpNow`,`upLevel`,`bot`,`priems`) VALUES ("'.$bots.'","'.$test['stats'].'","1000000","1","1","'.$test['priems'].'")');
						
						mysql_query('INSERT INTO `items_users` (`uid`,`item_id`,`data`,`inOdet`,`iznosMAX`,`kolvo`) VALUES ("'.$bots.'","2605","bm_a1=bot_priems1","1","1","1")');
					
						mysql_query('UPDATE `dungeon_bots` SET `inBattle` = '.$btl_id.' WHERE `id2` = '.$pl['id2'].' LIMIT 1');
						
						mysql_query('UPDATE `users` SET `battle` = '.$btl_id.' WHERE `id` = '.$bots.' LIMIT 1');
						
						mysql_query('UPDATE `stats` SET `team` = 2 WHERE `id` = '.$bots.' LIMIT 1');
					}
				}
					mysql_query('UPDATE `users` SET `battle` = '.$btl_id.' WHERE `id` = '.$u->info['id'].' LIMIT 1');
					
					mysql_query('UPDATE `stats` SET `team` = 1 WHERE `id` = '.$u->info['id'].' LIMIT 1');
					mysql_query('INSERT INTO `dungeon_actions` (`dn`,`x`,`y`,`time`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.$u->info['x'].'","'.$u->info['y'].'","'.time().'","'.$u->info['id'].'","act_niz3","3")');
			}
			header('location:main.php');
			die();
	}
}