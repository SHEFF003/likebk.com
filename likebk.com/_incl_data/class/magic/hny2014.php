<?
if(!defined('GAME'))
{
	die();
}

//Выдаем предметы, но не раньше 00:00:00 01-01-2013
if(date('Y')==2020 || $u->info['admin'] > 0) {
	/*

2. Новогодний Шоколад (полное вост. хп) 
3. Новогодняя Открытка 
4. Зелье -Бойцовский Дух- (мощ урона/магии +10, хп +60) 

7. Новогодний Эликсир
	*/	
	//Снежок 0/15 (x1)
	$idit = $u->addItem(1000,$u->info['id']);
	if($idit > 0) {
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "15" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Новогодний эликсир (x1)
		$idit = $u->addItem(3044,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "2" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(4037,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(4038,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(4039,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(4040,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(5109,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(5110,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "1" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(5106,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(5105,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(5104,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(1461,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(1462,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(1463,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(2140,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(2139,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(3140,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(2418,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(5108,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "10" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(4702,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "10" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(6819,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(4037,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(994,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(4037,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(3102,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(5123,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(1001,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		$idit = $u->addItem(1460,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "5" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Звездное сияние (x1)
		/*$idit = $u->addItem(1462,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "7" WHERE `id` = "'.$idit.'" LIMIT 1');
		*/
				
		//Открытка (x1)
		$idit = $u->addItem(996,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Новый Год" , `gtxt1` = "Администрация проекта поздравляет Вас с Новым, '.date('Y').', Годом!" WHERE `id` = "'.$idit.'" LIMIT 1');	
		
		/*
		//Нападалка 0/13 (x1)
		$idit = $u->addItem(874,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "15" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Фейрверк 0/25 , 4055
		//$idit = $u->addItem(4055,$u->info['id']);
		//mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "25" WHERE `id` = "'.$idit.'" LIMIT 1');
		
		//Кольцо жизни (x1)
		/*
		$idit = $u->addItem(2101,$u->info['id'],'|noremont=1|srok=2419200|sudba='.$u->info['login']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год",`iznosMAX` = "10" WHERE `id` = "'.$idit.'" LIMIT 1');
		*/
		
		//Восстановление Энергии 900НР (x3)
		/*$idit = $u->addItem(2710,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(2710,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год" WHERE `id` = "'.$idit.'" LIMIT 1');
		$idit = $u->addItem(2710,$u->info['id']);
		mysql_query('UPDATE `items_users` SET `gift` = "Старый Год" WHERE `id` = "'.$idit.'" LIMIT 1');*/
		
		$u->error = 'Вы успешно использовали &quot;'.$itm['name'].'&quot;. В инвентарь добавлены подарки. С Новым, '.date('Y').', Годом!';
		mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE (`item_id` = "2763" OR `id` = "'.$itm['id'].'") AND `uid` = "'.$u->info['id'].'" LIMIT 10');
	}
}else{
	$u->error = 'Подарок возможно использовать не раньше 01.01.2020';
}

?>