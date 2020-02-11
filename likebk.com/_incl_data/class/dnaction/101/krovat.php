<?
if( isset($s[1]) && $s[1] == '101/krovat' ) {

	//Все переменные сохранять в массиве $vad !
	$vad = array(
		'go' => true
	);
	
	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `vars` = "obj_act'.$obj['id'].'" AND `dn` = "'.$u->info['dnow'].'" LIMIT 1'));
	 if( $vad['test1'][0] > 0 ) {
		$r = 'Кто-то обыскал &quot;'.$obj['name'].'&quot; раньше вас...';
		$vad['go'] = false;
	}
	
	if( $vad['go'] == true ) {
	if(rand(0,100) <= 90) {
		if(rand(0,100) <= 4) {
			$vad['items'] = array(2412);
		}elseif(rand(0,100) <= 40) {
			$vad['items'] = array(2413,2414,2415,2416);
		}elseif(rand(0,100) <= 40) {
			$vad['items'] = array(2);
		}else{
			$r = 'Вы ничего не нашли...';
		}
	}else{
		$r = 'Вы ничего не нашли...';
	}
		
			$vad['items'] = $vad['items'][rand(0,count($vad['items'])-1)];
		

		if($vad['items'] != 0) {
			
				$vad['items'] = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$vad['items'].'" LIMIT 1'));
				
				$r = 'Обыскав &quot;'.$obj['name'].'&quot; вы обнаружили &quot;'.$vad['items']['name'].'&quot;';
				
				$this->pickitem($obj,$vad['items']['id'],$u->info['id'],'',$vad['dn_delete'][$vad['items']['id']]);
		}
			mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","")');
	}
	
	unset($vad);
}
?>