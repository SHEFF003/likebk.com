<?
if(!defined('GAME'))
{
	die();
}


$no_open_itm = true;

if( $this->info['room'] != 9 ) {
	$this->error = 'Открывать портал можно только на Центральной Площади!';	
	//$no_open_itm = true;
}else{
	$test = mysql_fetch_array(mysql_query('SELECT * FROM `qst_portal` WHERE `time` > "'.time().'" LIMIT 1'));
	if(isset($test['id'])) {
		$this->error = 'Вы не можете открыть новый портал пока не закроется старый!';	
		//$no_open_itm = true;
	}else{
		
		$ins = mysql_query('INSERT INTO `dungeon_now` (`city`,`uid`,`id2`,`name`,`time_start`)
		VALUES ("'.$this->info['city'].'","'.$this->info['id'].'","110","Другое Измерение","'.time().'")');
		if($ins){
			$zid = mysql_insert_id();
			
			mysql_query('UPDATE `stats` SET `x` = 0 , `y` = 0 ,`dnow` = "'.$zid.'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
			mysql_query('UPDATE `users` SET `room` = "360" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
			
			/*
			Создание пещеры
			*/
			$map_locs = array();
			$spm2 = mysql_query('SELECT `id`,`x`,`y` FROM `dungeon_map` WHERE `id_dng` = "110"');
			while( $plm2 = mysql_fetch_array( $spm2 ) ) {
				$map_locs[] = array($plm2['x'],$plm2['y']);
			}
			unset( $spm2 , $plm2 );
			//Добавляем ботов
			$vls = '';
			$sp = mysql_query('SELECT * FROM `dungeon_bots` WHERE `for_dn` = "110"');
			while( $pl = mysql_fetch_array( $sp ) ) {
				if( $pl['id_bot'] == 0 && $pl['bot_group'] !=''){
					$bots = explode( ',', $pl['bot_group'] );
					$pl['id_bot'] = (int)$bots[rand(0, count($bots)-1 )];
				}
				$xyn = $map_locs[rand(0,count($map_locs)-1)];
				//$pl['x'] = $xyn[0];
				//$pl['y'] = $xyn[1];
				if( $pl['id_bot'] > 0 )$vls .= '("'.$zid.'","'.$pl['id_bot'].'","'.$pl['colvo'].'","'.$pl['items'].'","'.$pl['x'].'","'.$pl['y'].'","'.$pl['dialog'].'","'.$pl['items'].'","'.$pl['go_bot'].'"),';
				unset($bots);
			}
			$vls = rtrim($vls,',');				
			$ins1 = mysql_query('INSERT INTO `dungeon_bots` (`dn`,`id_bot`,`colvo`,`items`,`x`,`y`,`dialog`,`atack`,`go_bot`) VALUES '.$vls.'');
			//Добавляем обьекты
			$vls = '';
			$sp = mysql_query('SELECT * FROM `dungeon_obj` WHERE `for_dn` = "110"');
			while($pl = mysql_fetch_array($sp))
			{
				$vls .= '("'.$zid.'","'.$pl['name'].'","'.$pl['img'].'","'.$pl['x'].'","'.$pl['y'].'","'.$pl['action'].'","'.$pl['type'].'","'.$pl['w'].'","'.$pl['h'].'","'.$pl['s'].'","'.$pl['s2'].'","'.$pl['os1'].'","'.$pl['os2'].'","'.$pl['os3'].'","'.$pl['os4'].'","'.$pl['type2'].'","'.$pl['top'].'","'.$pl['left'].'","'.$pl['date'].'"),';
			}
			//
			
			$itm['iznosNOW']++;
			mysql_query('UPDATE `items_users` SET `iznosNOW` = "'.$itm['iznosNOW'].'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			if( $itm['iznosNOW'] >= $itm['iznosMAX'] ) {
				$this->deleteItem($itm['id'],$this->info['id']);
			}
			
			$this->error = 'Вы успешно открыли портал на Центральной Площади!<script>location.href=\'/main.php?showportal1\';</script>';	
							
			$dnow = 0;
			
			mysql_query('INSERT INTO `qst_portal` (`uid`,`time`,`users`,`dnow`) VALUES (
				"'.$this->info['id'].'","'.(time()+600).'","4","'.$zid.'"
			)');
			
			mysql_query('INSERT INTO `qst_portal_go` (`uid`,`time`) VALUES (
				"'.$this->info['id'].'","'.(time()+3600).'"
			)');
			
		}
	}
}

?>