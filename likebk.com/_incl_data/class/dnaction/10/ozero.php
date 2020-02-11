<?
if( isset($s[1]) && $s[1] == '10/ozero' ) {
	 
	//Все переменные сохранять в массиве $vad !
	$vad['mItm'] = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `uid` = '.$u->info['id'].' AND `item_id` = 8270 AND `delete` = 0 LIMIT 1'));
	
	$vad['quest'] = mysql_fetch_array(mysql_query('SELECT * FROM `dialog_act` WHERE `uid` = '.$u->info['id'].' AND `var` = "shiz1" AND `val` = 0 LIMIT 1'));
	if(isset($vad['mItm']['id']) && isset($vad['quest']['id']) ) {
		mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","itm:'.$vad['mItm']['item_id'].'","quest:'.$vad['quest']['id'].'")');
		mysql_query('DELETE FROM `items_users` WHERE `id` = '.$vad['mItm']['id'].'');
		$r = 'Вы опустили Непонятную Штуковину на дно озера...';
	}else{
		$r = 'Ничего не получилось...';
	}
	
	unset($vad);
}

?>