<?
if( isset($s[1]) && $s[1] == '10/green_s' ) {
	 
	//Все переменные сохранять в массиве $vad !
	$vad = array(
		'go' => true
	);
	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `uid` = '.$u->info['id'].' AND `vars` = "obj_act'.$obj['id'].'" LIMIT 1'));
	if( $vad['test1'][0] > 0 ) {
		$r = 'Ничего не произошло...';
		$vad['go'] = false;
	}
	
	if( $vad['go'] == true ) {
		mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","'.$vad['bad'].'")');
		mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","1","gribnica")');
		$r = 'Вы дотронулись к  Зеленому Светляку';
	}
	
	unset($vad);
}

?>