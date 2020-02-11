<?
if( isset($s[1]) && $s[1] == '101/telejka' ) {
	/*
		Сундук: Тележка
		* Можно получить один из двух ресурсов
	*/
	//Все переменные сохранять в массиве $vad !
	$vad = array(
		'go' => true
	);
	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "obj_act'.$obj['id'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
	if( $vad['test1'][0] > 0 ) {
		$r = 'Кто-то обыскал &quot;'.$obj['name'].'&quot; до вас...';
		$vad['go'] = false;
	}
	
	if( $vad['go'] == true ) {
		mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","'.$vad['bad'].'")');
		$r = 'Обыскав &quot;'.$obj['name'].'&quot; вы обнаружили &quot;Шкура пещерного оленя&quot;';
		$this->pickitem($obj,894,$u->info['id']);		
	}
	
	unset($vad);
}
?>