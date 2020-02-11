<?
if( isset($s[1]) && $s[1] == '101/yrna_4' ) {
	
	
	$vad = array('go' => true);
	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "obj_act'.$obj['id'].'" LIMIT 1'));
	if( $vad['test1'][0] > 0 ) {
		$r = 'Кто-то обыскал &quot;'.$obj['name'].'&quot; до вас...';
		$vad['go'] = false;
	}
	
	if( $vad['go'] == true ) {
		
		mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","'.$vad['bad'].'")');
		 
		 $u->info['hpNow'] = $u->stats['hpAll'];
		 $u->info['mpNow'] = $u->stats['mpAll'];
		 mysql_query('UPDATE `stats` SET `hpNow` = "'.$u->info['hpNow'].'",`mpNow` = "'.$u->info['mpNow'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		 $r = 'Вы восстановили здоровье...';
		 
	}
	
	unset($vad);
}
?>