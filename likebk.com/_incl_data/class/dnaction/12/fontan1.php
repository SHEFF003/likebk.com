<?
if(isset($s[1]) && $s[1] == '12/fontan1') {
  $vad = array('go' => false);
  $vad['use_fontan'] = mysql_fetch_array(mysql_query('SELECT * FROM `dungeon_actions` WHERE `uid` = "'.$u->info['id'].'" AND `dn` = "'.$u->info['dnow'].'" AND `vars` = "use_fontan" AND `vals` = "2" LIMIT 1'));
  if(!isset($vad['use_fontan']['id'])) {
	$vad['key'] = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "1174" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inOdet` = "0" AND `inShop` = "0" AND `inTransfer` = "0" LIMIT 1'));
	if(isset($vad['key']['id'])) {
	  $vad['bottle'] = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "2" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inOdet` = "0" AND `inShop` = "0" AND `inTransfer` = "0" LIMIT 1'));
	  if(isset($vad['bottle']['id'])) { 
		$vad['go'] = true; 
	  } else {
        $r = 'Для использования требуется &quot;Пустая Бутылка&quot;';
	  }
	} else {
	  $r = 'Для использования требуется &quot;Мерцающий Ключ №1&quot;';
	}
  } else {
	if($u->info['sex'] == 1) { $a = 'а'; } else { $a = ''; }
	$r = 'Мне кажется, что здесь я уже был'.$a.'..';
  }
  
  if( $u->info['admin'] > 0 ) {
	 $vad['go'] = true; 
  }
  
  if($vad['go'] == true) {
    $r = 'Вы воспользовались &quot;Ключ №1&quot;. Опустив пустую бутылку в фонтан вы наполнили её.';
	$u->deleteItem(intval($vad['key']['id']), $u->info['id'], 1);
	$u->deleteItem(intval($vad['bottle']['id']), $u->info['id'], 1); 
	
	$poi = 0;
	
	$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `actions` WHERE `vars` = "font12_poi_'.$u->info['id'].'" AND `time` > "'.time().'" LIMIT 1'));
	if(!isset($test['id']) && rand(0,100) < 50 ) {
		$poi = 1;
	}
	
	if( $poi == 1 ) {
		$this->pickitem($obj,1181,$u->info['id'],'');
		mysql_query('INSERT INTO `actions` (`vars`,`time`) VALUES ("font12_poi_'.$u->info['id'].'","'.(time()+6*3600).'")');
	}else{	
		if(rand(0,100) <= 50) {
			$u->addItem(round(1181), $u->info['id'], '|musor=2|noremont=1|nosale=1',12);
		}else{
			$r = 'Ничего не удалось, бутылка разбилась...';
			$u->deleteItem(intval($vad['bottle']['id']), $u->info['id'], 1); 
		}
	}
  } 
  unset($vad);
}
?>