<?
if( isset($s[1]) && $s[1] == '101/laba1' ) {
	if(!isset($_GET['type1'])) {
		echo '<h3>Лаборатория</h3><br>Что вы хотите сделать в Лаборатории:<br><br><a href="?take_obj='.$_GET['take_obj'].'&type1=2">&bull; Растворить ресурсы в тактики</a><br><a href="?take_obj='.$_GET['take_obj'].'&type1=1">&bull; Растворить ресурсы при помощи растворителей в Сущность ресурса</a><br><a href="main.php">&bull; Ничего (Вернуться назад)</a><hr>';
		die();
	}elseif( $_GET['type1'] == 1) {
		echo '<h3>Лаборатория</h3>';
		
		if(!isset($_GET['itm1'])) {
			echo '<br><b>Выберите растворитель:</b>';
			$sp = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 AND (`item_id` = "6954" OR `item_id` = "6956" OR `item_id` = "6960" OR `item_id` = "6961") GROUP BY `item_id`');
			$j = 0;
			while( $pl = mysql_fetch_array($sp) ) {
				$itm = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.$pl['item_id'].'" LIMIT 1'));
				echo '<br><a href="?take_obj='.$_GET['take_obj'].'&type1=1&itm1='.$pl['id'].'">&bull; '.$itm['name'].'</a>';
				$j++;
			}
			if( $j == 0 ) {
				echo '<br><br>Нет подходящих предметов<br>';
			}
			die('<br><a href="main.php">&bull; Вернуться назад</a>');
		}elseif(!isset($_GET['itm2'])) {
			$itm1 = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `id` = "'.mysql_real_escape_string($_GET['itm1']).'" AND `delete` = 0 AND `inShop` = 0 AND `uid` = "'.$u->info['id'].'" AND (`item_id` = "6954" OR `item_id` = "6956" OR `item_id` = "6960" OR `item_id` = "6961") LIMIT 1'));
			if(!isset($itm1['id'])) {
				echo '<br><br>Нет подходящих предметов';
				die('<br><a href="main.php">&bull; Вернуться назад</a>');
			}else{
				$itm1m = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.$itm1['item_id'].'" LIMIT 1'));
				$itmsid = '';
				//
				$itmsid_ar = array(
					//`item_id` = "6954" OR `item_id` = "6956" OR `item_id` = "6960" OR `item_id` = "6961"
					6954 => '`img` LIKE "mater1.gif" OR `img` LIKE "mater2.gif" OR `img` LIKE "mater3.gif" OR `img` LIKE "mater4.gif" OR `img` LIKE "mater5.gif" OR `img` LIKE "mater6.gif" OR `img` LIKE "mater7.gif" OR `img` LIKE "mater8.gif" OR `img` LIKE "mater9.gif" OR `img` LIKE "mater10.gif" OR `img` LIKE "mater11.gif" OR `img` LIKE "mater12.gif"',
					6956 => '`img` LIKE "mater13.gif" OR `img` LIKE "mater14.gif" OR `img` LIKE "mater15.gif" OR `img` LIKE "mater16.gif" OR `img` LIKE "mater17.gif" OR `img` LIKE "mater18.gif" OR `img` LIKE "mater19.gif"',
					6960 => '`img` LIKE "mater25.gif" OR `img` LIKE "mater26.gif" OR `img` LIKE "mater27.gif" OR `img` LIKE "mater28.gif" OR `img` LIKE "mater29.gif" OR `img` LIKE "mater30.gif"',
					6961 => '`img` LIKE "mater20.gif" OR `img` LIKE "mater21.gif" OR `img` LIKE "mater22.gif" OR `img` LIKE "mater23.gif" OR `img` LIKE "mater24.gif" OR `img` LIKE "mater31.gif"'
				);
				$itmsid_ar = $itmsid_ar[$itm1m['id']];
				$sp = mysql_query('SELECT `id` FROM `items_main` WHERE ' . $itmsid_ar);
				while( $pl = mysql_fetch_array($sp) ) {
					$itmsid .= ' OR `item_id` = "'.$pl['id'].'"';
				}
				$itmsid = ltrim($itmsid,' OR ');
				//
				echo '<br><b>Выберите ресурс для растворения при помощи &quot;'.$itm1m['name'].'&quot;:</b>';
				$sp = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 AND ('.$itmsid.') GROUP BY `item_id`');
				$j = 0;
				while( $pl = mysql_fetch_array($sp) ) {
					$itm = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.$pl['item_id'].'" LIMIT 1'));
					echo '<br><a href="?take_obj='.$_GET['take_obj'].'&type1=1&itm1='.$itm1['id'].'&itm2='.$pl['id'].'">&bull; '.$itm['name'].'</a>';
					$j++;
				}
				if( $j == 0 ) {
					echo '<br><br>Нет подходящих предметов<br>';
				}
				die('<br><a href="main.php?take_obj='.$_GET['take_obj'].'&type1=1">&bull; Вернуться назад</a>');
			}
		}else{
			$itm1 = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `id` = "'.mysql_real_escape_string($_GET['itm1']).'" AND `delete` = 0 AND `inShop` = 0 AND `uid` = "'.$u->info['id'].'" AND (`item_id` = "6954" OR `item_id` = "6956" OR `item_id` = "6960" OR `item_id` = "6961") LIMIT 1'));
			if(!isset($itm1['id'])) {
				echo '<br><br>Нет подходящих предметов';
				die('<br><a href="main.php">&bull; Вернуться назад</a>');
			}else{
				$itm1m = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.$itm1['item_id'].'" LIMIT 1'));
				$itmsid = '';
				//
				$itmsid_ar = array(
					//`item_id` = "6954" OR `item_id` = "6956" OR `item_id` = "6960" OR `item_id` = "6961"
					6954 => '`img` LIKE "mater1.gif" OR `img` LIKE "mater2.gif" OR `img` LIKE "mater3.gif" OR `img` LIKE "mater4.gif" OR `img` LIKE "mater5.gif" OR `img` LIKE "mater6.gif" OR `img` LIKE "mater7.gif" OR `img` LIKE "mater8.gif" OR `img` LIKE "mater9.gif" OR `img` LIKE "mater10.gif" OR `img` LIKE "mater11.gif" OR `img` LIKE "mater12.gif"',
					6956 => '`img` LIKE "mater13.gif" OR `img` LIKE "mater14.gif" OR `img` LIKE "mater15.gif" OR `img` LIKE "mater16.gif" OR `img` LIKE "mater17.gif" OR `img` LIKE "mater18.gif" OR `img` LIKE "mater19.gif"',
					6960 => '`img` LIKE "mater25.gif" OR `img` LIKE "mater26.gif" OR `img` LIKE "mater27.gif" OR `img` LIKE "mater28.gif" OR `img` LIKE "mater29.gif" OR `img` LIKE "mater30.gif"',
					6961 => '`img` LIKE "mater20.gif" OR `img` LIKE "mater21.gif" OR `img` LIKE "mater22.gif" OR `img` LIKE "mater23.gif" OR `img` LIKE "mater24.gif" OR `img` LIKE "mater31.gif"'
				);
				$xsg = array( 6954 => 1 , 6956 => 3 , 6960 => 10 , 6961 => 30 );
				$xsg = $xsg[$itm1['item_id']];
				$itmsid_ar = $itmsid_ar[$itm1m['id']];
				$sp = mysql_query('SELECT `id` FROM `items_main` WHERE ' . $itmsid_ar);
				while( $pl = mysql_fetch_array($sp) ) {
					$itmsid .= ' OR `item_id` = "'.$pl['id'].'"';
				}
				$itmsid = ltrim($itmsid,' OR ');
				$itm2 = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `id` = "'.mysql_real_escape_string($_GET['itm2']).'" AND `delete` = 0 AND `inShop` = 0 AND `uid` = "'.$u->info['id'].'" AND ('.$itmsid.') LIMIT 1'));
				if(!isset($itm2['id'])) {
					echo '<br><br>Нет подходящих предметов';
					die('<br><a href="main.php">&bull; Вернуться назад</a>');
				}else{
					$itm2m = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.$itm2['item_id'].'" LIMIT 1'));
					$r = 'Вы успешно растворили &quot;'.$itm2m['name'].'&quot; при помощи растворителя &quot;'.$itm1m['name'].'&quot;!';
					$r .= '<br>&nbsp;В инвентарь добавлен предмет &quot;Сущность Ресурсов (x'.$xsg.')&quot;!';
					mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$itm2['id'].'" LIMIT 1');
					$itm1['iznosNOW']++;
					if( $itm1['iznosNOW'] >= $itm1['iznosMAX'] ) {
						$itm1['delete'] = time();
					}
					mysql_query('UPDATE `items_users` SET `delete` = "'.$itm1['delete'].'" , `iznosNOW` = "'.$itm1['iznosNOW'].'" WHERE `id` = "'.$itm1['id'].'" LIMIT 1');
					$i = 0;
					while( $i < $xsg ) {
						$u->addItem(1035,$u->info['id'],'|nosale=1');
						$i++;
					}
				}
			}
		}
	}elseif( $_GET['type1'] == 2) {
		/*
			Сундук: Лаболатория
			* Можно собрать случайную тактику, но не более 3 на человека за поход и не более 10 на команду
			* 897 - Слиток пустынной руды
			* 903 - Тысячелетний камень
			* 888 - Шепот гор
			* 892 - Эссенция чистоты
			* 950 - Кожа Общего Врага
			* 904 - Кристалл времен
			* 878 - Лучистый топаз
			* 880 - Эссенция глубины
			* 879 - Ралиэль
			* 899 - Корень змеиного дерева
			* 882 - Глубинный камень
			* 908 - Камень затаенного солнца
			* 909 - Эссенция праведного гнева
			* 902 - Плод змеиного дерева
			* 881 - Лучистый Рубин
			* 893 - Эссенция лунного света
			* 898 - Троекорень
			* 890 - Сгусток астрала
			* 907 - Кристалл стабильности
			* 905 - Стихиалия
			-- Боя
			4243 - 897 х3
			4244 - 903 х2
			4245 - 888 х2
			4246 - 892 х1
			4247 - 879 х1 , 892 х1
			-- Защиты
			4248 - 950 х3
			4249 - 904 х2
			4250 - 878 х2
			4251 - 880 х1
			4252 - 880 х1 , 892 х1
			-- Крови
			4253 - 899 х3
			4254 - 882 х2
			4255 - 908 х2
			4256 - 909 х1
			4257 - 909 х1 , 892 х1
			-- Ответа
			4258 - 899 х3
			4259 - 902 х2
			4260 - 881 х2
			4261 - 893 х1
			4262 - 893 х1 , 892 х1
			-- Отражения
			4263 - 898 х3
			4264 - 890 х2
			4265 - 907 х2
			4266 - 905 х1
			4267 - 905 х1 , 892 х1
		*/
		//Все переменные сохранять в массиве $vad !
		$vad = array(
			'go' => true
		);
		
		$vad['recept'] = array(
			//Б
			array( 897, 3 ),
			array( 903, 2 ),
			array( 888, 2 ),
			array( 892, 1 ),
			array( 892, 1, 892, 1 ),
			//З
			array( 950, 3 ),
			array( 904, 2 ),
			array( 878, 2 ),
			array( 880, 1 ),
			array( 880, 1, 892, 1 ),
			//К
			array( 899, 3 ),
			array( 882, 2 ),
			array( 908, 2 ),
			array( 909, 1 ),
			array( 909, 1, 892, 1 ),
			//Ответа
			array( 899, 3 ),
			array( 902, 2 ),
			array( 881, 2 ),
			array( 893, 1 ),
			array( 893, 1, 892, 1 ),
			//Отражения
			array( 898, 3 ),
			array( 890, 2 ),
			array( 907, 2 ),
			array( 905, 1 ),
			array( 905, 1, 892, 1 )
		);
		
		$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "obj_act'.$obj['id'].'_lab" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
		$vad['test2'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "obj_act'.$obj['id'].'_lab" LIMIT 1'));
		
		$vad['i'] = 0;
		while( $vad['i'] < count($vad['recept']) ) {
			//4243 + $vad['i']
			$vad['tr_itm'] = $vad['recept'][$vad['i']][0]; 
			if( $vad['tr_itm'] > 0 ) {
				$vad['tr_itm'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = "'.$vad['recept'][$vad['i']][0].'" AND (`delete` = "0" OR `delete` = "1000") AND `inShop` = "0" AND `inTransfer` = "0" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				if( $vad['tr_itm'][0] >= $vad['recept'][$vad['i']][1] ) {
					$vad['tr_itm'] = true;
				}else{
					$vad['tr_itm'] = false;
				}
			}
			if( $vad['recept'][$vad['i']][2] > 0 && $vad['tr_itm'] == true ) {
				$vad['tr_itm'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = "'.$vad['recept'][$vad['i']][2].'" AND (`delete` = "0" OR `delete` = "1000") AND `inShop` = "0" AND `inTransfer` = "0" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				if( $vad['tr_itm'][2] >= $vad['recept'][$vad['i']][3] ) {
					//все ок
				}else{
					$vad['tr_itm'] = false;
				}
			}
			if( $vad['tr_itm'] == true ) {
				$vad['itm'][] = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.(4243 + $vad['i']).'" LIMIT 1'));
				$vad['tr'][(4243 + $vad['i'])] = array( $vad['recept'][$vad['i']][0] , $vad['recept'][$vad['i']][1] , $vad['recept'][$vad['i']][2] , $vad['recept'][$vad['i']][3] );
			}
			$vad['i']++;
		}
		
		$vad['itm'] = $vad['itm'][rand(0,count($vad['itm'])-1)];
		
		if( $vad['test2'][0] >= 10 ) {
			$r = 'Не удалось воспользоваться лабораторией, не более 10 раз на команду за один поход';
			$vad['go'] = false;
		}elseif( $vad['test1'][0] >= 3 ) {
			$r = 'Не удалось воспользоваться лабораторией, не более 3 раз на персонажа за один поход';
			$vad['go'] = false;
		}elseif(!isset($vad['itm']['id'])) {
			$r = 'Недостаточно ингридиентов...';
			$vad['go'] = false;
		}
		
		
		
		if( $vad['go'] == true ) {
			//Выдаем предмет
			if( $vad['tr'][$vad['itm']['id']][1] > 0 ) {
				$u->deleteItemID($vad['tr'][$vad['itm']['id']][0],$u->info['id'],$vad['tr'][$vad['itm']['id']][1]);
			}
			if( $vad['tr'][$vad['itm']['id']][3] > 0 ) {
				$u->deleteItemID($vad['tr'][$vad['itm']['id']][2],$u->info['id'],$vad['tr'][$vad['itm']['id']][3]);
			}
			mysql_query('INSERT INTO `dungeon_actions` (`dn`,`uid`,`time`,`vars`,`x`,`y`) VALUES (
				"'.$u->info['dnow'].'","'.$u->info['id'].'","'.time().'","obj_act'.$obj['id'].'_lab","'.$obj['x'].'","'.$obj['y'].'"
			)');
			$u->addItem($vad['itm']['id'],$u->info['id'],'|frompisher=101');
			$r = 'Вы создали предмет &quot;'.$vad['itm']['name'].'&quot;! Расплавив ресурсы ...';
			if($u->info['sex'] == 0) {
				$vad['text'] = '<b>'.$u->info['login'].'</b> создал предмет &quot;'.$vad['itm']['name'].'&quot; при помощи &quot;'.$obj['name'].'&quot;.';
			}else{
				$vad['text'] = '<b>'.$u->info['login'].'</b> создала предмет &quot;'.$vad['itm']['name'].'&quot; при помощи &quot;'.$obj['name'].'&quot;.';
			}
			$this->sys_chat($vad['text']);
		}
	}
}
?>