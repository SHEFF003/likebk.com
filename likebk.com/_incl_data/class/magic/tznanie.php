<?
if(!defined('GAME'))
{
	die();
}

if(isset($po['finish_file']) && $po['finish_file']=='tznanie')
{
	//Добавляем слот
	mysql_query('UPDATE `actions` SET `val` = "cast" WHERE (`vals` = "1044" OR `vals` = "1045" OR `vals` = "1046" OR `vals` = "1047" OR `vals` = "5121") AND `val` != "cast" AND `vars` = "read"  AND `uid` = "'.$u->info['id'].'" LIMIT 1');
}else{
	$tst = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` > '.time().' AND `vars` = "read" LIMIT 1',1);
	if(isset($tst['id']) && $u->info['admin'] == 0)
	{ 
		//Уже что-то изучаем
		$u->error = 'Так не пойдет, вы уже что-то изучаете';
	}else{
		
		$tom2 = 0;
		if( $itm['item_id'] == 10149 ) {
			$tom = mysql_fetch_array(mysql_query('SELECT * FROM `tom` WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = '.$itm['item_id'].' LIMIT 1'));
			if( !isset($tom['id']) ) {
				$tom2 = $itm['item_id'];
			}
		}
		
		if(isset($tom['id'])) {
			$u->error = 'Вы не можете изучить этот том!';
		}elseif( $u->info['priemslot'] - $u->rep['add_slot'] >= 16 && !isset($tom['id']) && $tom2 == 0  ) {
			$u->error = 'Вы не можете изучить этот том...';
		}else{
			//
			$tritm = array(
				10 => 1044,
				11 => 1045,
				12 => 1046,
				13 => 1047,
				14 => 5121			
			);
			$addsl = array(
				10 => 1,
				11 => 1,
				12 => 1,
				13 => 1,
				14 => 2				
			);
			$tritm = $tritm[$u->info['priemslot']-$u->rep['add_slot']];
			$addsl = $addsl[$u->info['priemslot']-$u->rep['add_slot']];
			if( $tom2 == $itm['item_id'] ) {
				$addsl = 2;
				$tritm = $itm['item_id'];
			}
			if( $addsl < 1 ) {
				$u->error = 'Не удалось изучить эту книгу...';
			}elseif( $itm['item_id'] != $tritm ) {
				$u->error = 'Вам необходимо изучить Тайное Знание (том '.($u->info['priemslot']-9).') чтобы получить дополнительный слот!';
			}else{
				//
				mysql_query('INSERT INTO `tom` (`uid`,`item_id`) VALUES ("'.$u->info['id'].'","'.$itm['item_id'].'")');
				mysql_query('UPDATE `stats` SET `priemslot` = `priemslot` + "'.$addsl.'" WHERE `id` = "'.$itm['uid'].'" LIMIT 1');
				$fn .= 'finish_file=tznanie';
				
				$ins = mysql_query('INSERT INTO `eff_users` (`overType`,`id_eff`,`uid`,`name`,`timeUse`,`data`,`img2`,`no_Ace`) VALUES ("8","2","'.$u->info['id'].'","Изучение: '.$itm['name'].'","'.(time()+$st['timeRead']).'","'.$fn.'","'.$itm['img'].'","1")');
				if($ins) {
					$u->error = 'Вы начали изучать &quot;'.$itm['name'].'&quot;. Время изучения составит '.$u->timeOut($st['timeRead']).'';
					$u->addAction(time()+$st['timeRead'],'read',$itm['item_id']);
					mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
				}else{
					$u->error = 'Что-то здесь не так';
				}
			}
		}
		
		/*$tst = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "read" AND `vals` = "'.$itm['item_id'].'" LIMIT 1',1);
		if(isset($tst['id']))
		{
			$u->error = 'Вы уже изучили данное знание';
		}else{
			$fn = ''; $tom_iz = 0;
			if($itm['item_id']>1044 && $itm['item_id']<=1047)
			{
				$tst2 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "read" AND `vals` = "'.($itm['item_id']-1).'" LIMIT 1',1);
				if(!isset($tst2['id']))
				{
					$tom_iz = 1;
				}
				unset($tst2);
			}
			if($itm['item_id'] == 5121){
				$tst2 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "read" AND `vals` = "1047" LIMIT 1',1);
				if(!isset($tst2['id']))
				{
					$tom_iz = 1;
				}
				unset($tst2);
			}
			if($tom_iz==0)
			{
				if($itm['item_id']>=1044 && $itm['item_id']<=1047)
				{
					mysql_query('UPDATE `stats` SET `priemslot` = `priemslot` + 1 WHERE `id` = "'.$itm['uid'].'" LIMIT 1');
					$fn .= 'finish_file=tznanie';
				}
				if($itm['item_id']==5121)
				{
					mysql_query('UPDATE `stats` SET `priemslot` = `priemslot` + 2 WHERE `id` = "'.$itm['uid'].'" LIMIT 1');
					$fn .= 'finish_file=tznanie';
				}
				$ins = mysql_query('INSERT INTO `eff_users` (`overType`,`id_eff`,`uid`,`name`,`timeUse`,`data`,`img2`,`no_Ace`) VALUES ("8","2","'.$u->info['id'].'","Изучение: '.$itm['name'].'","'.(time()+$st['timeRead']).'","'.$fn.'","'.$itm['img'].'","1")');
				if($ins)
				{
					$u->error = 'Вы начали изучать &quot;'.$itm['name'].'&quot;. Время изучения составит '.$u->timeOut($st['timeRead']).'';
					$u->addAction(time()+$st['timeRead'],'read',$itm['item_id']);
					mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
				}else{
					$u->error = 'Что-то здесь не так';
				}
			}else{
				$u->error = 'Требует изучения предыдущего тома';
			}
			unset($tom_iz);
		}*/
	}
}
?>