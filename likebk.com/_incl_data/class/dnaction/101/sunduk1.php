<?
if( isset($s[1]) && $s[1] == '101/sunduk1' ) {

	//Все переменные сохранять в массиве $vad !
	$vad = array(
		'go' => true
	);
	
	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `vars` = "obj_act'.$obj['id'].'" AND `dn` = "'.$u->info['dnow'].'" LIMIT 1'));
	$vad['test2'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `vars` = "obj_act'.$obj['id'].'" AND `dn` = "'.$u->info['dnow'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
	if( $vad['test2'][0] > 0 ) {
		$r = 'Вы уже обыскали &quot;'.$obj['name'].'&quot;...';
		$vad['go'] = false;
	}elseif( $vad['test1'][0] > 0 ) {
		$r = 'Кто-то обыскал &quot;'.$obj['name'].'&quot; раньше вас...';
		$vad['go'] = false;
	}
	
	if( $vad['go'] == true ) {
		if(rand(0,100) <= 90) {
			$vad['items'] = array(1189);
			$vad['dn_delete'] = array(1189 => true);
		}elseif(rand(0,100) <= 25) {
			$vad['items'] = array(4272);
		}elseif(rand(0,100) <= 20) {
			$vad['items'] = array(2556);
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