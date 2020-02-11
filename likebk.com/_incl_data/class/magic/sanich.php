<?
if(!defined('GAME'))
{
	die();
}

	if($tr['var_id'] == 1) {
		
		//Бронзовая книга
		
		
		$sp = mysql_query('SELECT * FROM `items_users_res` WHERE `item_id` >= 3143 AND `item_id` <= 3192 AND `delete` = 0 AND `inSHop` = 0 AND `inTransfer` = 0 AND `uid` = "'.$this->info['id'].'" GROUP BY `item_id` DESC');
		while( $pl = mysql_fetch_array($sp) ) {
			mysql_query('INSERT INTO `items_users` (`id`,`item_id`,`1price`,`2price`,`3price`,`4price`,`5price`,`uid`,`use_text`,`data`,`inOdet`,`inShop`,`inGroup`,`delete`,`iznosNOW`,`iznosMAX`,`gift`,`gtxt1`,`gtxt2`,`kolvo`,`geniration`,`magic_inc`,`maidin`,`lastUPD`,`timeOver`,`overType`,`secret_id`,`time_create`,`time_sleep`,`dn_delete`,`inTransfer`,`post_delivery`,`lbtl_`,`bexp`,`so`,`blvl`,`pok_itm`,`btl_zd`,`comsid`,`kamen`) VALUES ("'.$pl['id'].'","'.$pl['item_id'].'","'.$pl['1price'].'","'.$pl['2price'].'","'.$pl['3price'].'","'.$pl['4price'].'","'.$pl['5price'].'","'.$pl['uid'].'","'.$pl['use_text'].'","'.$pl['data'].'","'.$pl['inOdet'].'","'.$pl['inShop'].'","'.$pl['inGroup'].'","'.$pl['delete'].'","'.$pl['iznosNOW'].'","'.$pl['iznosMAX'].'","'.$pl['gift'].'","'.$pl['gtxt1'].'","'.$pl['gtxt2'].'","'.$pl['kolvo'].'","'.$pl['geniration'].'","'.$pl['magic_inc'].'","'.$pl['maidin'].'","'.$pl['lastUPD'].'","'.$pl['timeOver'].'","'.$pl['overType'].'","'.$pl['secret_id'].'","'.$pl['time_create'].'","'.$pl['time_sleep'].'","'.$pl['dn_delete'].'","'.$pl['inTransfer'].'","'.$pl['post_delivery'].'","'.$pl['lbtl_'].'","'.$pl['bexp'].'","'.$pl['so'].'","'.$pl['blvl'].'","'.$pl['pok_itm'].'","'.$pl['btl_zd'].'","'.$pl['comsid'].'","'.$pl['kamen'].'")');
			mysql_query('DELETE FROM `items_users_res` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}
		
				
		$pgs = array('all' => 0, 'sudba' => 0);
		$sp_pg = mysql_query('SELECT `id`,`item_id`,`gift` FROM `items_users` WHERE `item_id` >= 3143 AND `item_id` <= 3192 AND `delete` = 0 AND `inSHop` = 0 AND `inTransfer` = 0 AND `uid` = "'.$this->info['id'].'"');
		while($pl_pg = mysql_fetch_array($sp_pg)) {
			$pg_id = $pl_pg['item_id']-3142;
			if(!isset($pgs[$pg_id])) {
				$pgs[$pg_id] = $pl_pg['id'];
				if($pl_pg['gift'] != '') {
					$pgs['sudba']++;
				}
				$pgs['all']++;
			}
		}
		/*$sp_pg = mysql_query('SELECT `id`,`item_id`,`gift` FROM `items_users_res` WHERE `item_id` >= 3143 AND `item_id` <= 3192 AND `delete` = 0 AND `inSHop` = 0 AND `inTransfer` = 0 AND `uid` = "'.$this->info['id'].'"');
		while($pl_pg = mysql_fetch_array($sp_pg)) {
			$pg_id = $pl_pg['item_id']-3142;
			if(!isset($pgs[$pg_id])) {
				$pgs[$pg_id] = $pl_pg['id'];
				if($pl_pg['gift'] != '') {
					$pgs['sudba']++;
				}
				$pgs['all']++;
			}
		}*/
		$lk = 1;
		while($lk <= 50) {
			if($pgs[$lk] < 1) {
				$npgs .= ', '.$lk;
			}
			$lk++;
		}
		
		$test = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `items_users` WHERE `item_id` = 3196 AND `uid` = "'.$this->info['id'].'" AND `time_create` > "'.(time()-60).'" LIMIT 1'));
		$test = $test[0];
		
		if( $test > 0 ) { 
			$this->error .= 'Не удалось собрать книгу. Собирать возможно не чащей одного раза в минуту. Попробуйте позже...';
			$io .= 'Не удалось собрать книгу. Собирать возможно не чащей одного раза в минуту. Попробуйте позже...';
			$no_open_itm = true;
		}elseif($pgs['all'] < 50 /*&& $this->info['admin'] == 0*/ ) {
			$npgs = ltrim($npgs,', ');
			$this->error .= 'Не удалось собрать книгу, необходимо наличие всех страниц. ['.$pgs['all'].'/50]<br>Недостающие страницы: '.$npgs;
			$io .= 'Не удалось собрать книгу, необходимо наличие всех страниц. ['.$pgs['all'].'/50]<br>Недостающие страницы: '.$npgs;
			$no_open_itm = true;
		}else{
			
			//забираем страницы
			$pgs['delete'] = '';
			$sp_pg = 1;
			while($sp_pg <= 50) {
				$pgs['delete'] .= '`id` = "'.$pgs[$sp_pg].'" OR ';
				$sp_pg++;
			}
			
			//if($pgs['delete'] != '') {
				
				$pgs['delete'] = rtrim($pgs['delete'],' OR ');
				/*
				$pgs['delete'] = '('.$pgs['delete'].') AND `uid` = "'.$this->info['id'].'" LIMIT 50';
				mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE '.$pgs['delete']);
				*/
				
				$pgs_del = array();
				
				$sp = mysql_query('SELECT * FROM `items_users` WHERE ('.$pgs['delete'].') AND `uid` = "'.$this->info['id'].'" LIMIT 50');
				while( $pl = mysql_fetch_array($sp) ) {
					$pg_id = $pl['item_id']-3142;
					if(!isset($pgs_del[$pg_id])) {
						$pgs_del[$pg_id] = true;
						mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
					}
				}
				
				$sp = mysql_query('SELECT * FROM `items_users_res` WHERE ('.$pgs['delete'].') AND `uid` = "'.$this->info['id'].'" LIMIT 50');
				while( $pl = mysql_fetch_array($sp) ) {
					$pg_id = $pl['item_id']-3142;
					if(!isset($pgs_del[$pg_id])) {
						$pgs_del[$pg_id] = true;
						mysql_query('UPDATE `items_users_res` SET `delete` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
					}
				}

			//}
			
			/*$sz = $this->testAction('`vars` = "gold_sanich_bonus" LIMIT 1',1);
			if(!isset($sz['id'])) {
				$this->addAction(time(),'gold_sanich_bonus','gold_sanich_bonus');
				//выдаем книгу
				if($pgs['sudba'] > 0) {
					//привязанная
					$this->addItem(3198,$this->info['id'],'|sudba='.$this->info['login']);
				}else{
					//не привязанная
					$this->addItem(3198,$this->info['id']);
				}
				$io .= 'Вы получили предмет &quot;Золотая Книга&quot;<br>Вы собрали книгу Саныча одним из первых поэтому получаете Золотую книгу вместо Бронзовой! ;)';
			}else{
				$sz = $this->testAction('`vars` = "silver_sanich_bonus" LIMIT 1',1);
				if(!isset($sz['id'])) {
					$this->addAction(time(),'silver_sanich_bonus','silver_sanich_bonus');
					//выдаем книгу
					if($pgs['sudba'] > 0) {
						//привязанная
						$this->addItem(3197,$this->info['id'],'|sudba='.$this->info['login']);
					}else{
						//не привязанная
						$this->addItem(3197,$this->info['id']);
					}
					$io .= 'Вы получили предмет &quot;Серебряная Книга&quot;<br>Вы собрали книгу Саныча одним из первых поэтому получаете Серебряную книгу вместо Бронзовой! ;)';
				}else{*/
					//выдаем книгу
					if($pgs['sudba'] > 0) {
						//привязанная
						$this->addItem(3196,$this->info['id']);
					}else{
						//не привязанная
						$this->addItem(3196,$this->info['id']);
					}
					$io .= 'Вы получили предмет &quot;Бронзовая Книга&quot;';
					$this->error .= 'Вы получили предмет &quot;Бронзовая Книга&quot;';
				/*}
			}*/

		}
	}else{
		$this->error .= 'Данный предмет нельзя использовать!';
		$io .= 'Данный предмет нельзя использовать!';
		$no_open_itm = true;
	}
	
?>