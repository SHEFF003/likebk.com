<?
if( isset($s[1]) && $s[1] == '3/fontanblood1' ) {
	/*
		Фонтан ума (обмен кольца крови на усиленное)
		* Можно получить один из 4 eff
	*/
	//Все переменные сохранять в массиве $vad !
	$vad = array(
		'go' => true
	);
	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "obj_act'.$obj['id'].'" LIMIT 1'));
	if( $vad['test1'][0] > 0 ) {
		$r = 'Ничего не произошло...';
		$vad['go'] = false;
	}
	
	if( $vad['go'] == true ) {
		//mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES (
		//	"'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","'.$vad['bad'].'"
		//)');
		
		$itm1 = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "3135" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 AND `inTransfer` = 0 LIMIT 1'));
		$itm2 = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "6962" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 AND `inTransfer` = 0 LIMIT 1'));
		if(!isset($itm1['id']) || !isset($itm2['id'])) {
			$r = 'Чтобы получить &quot;Воинское Кольцо Алтаря&quot; вам необходимо принести: Кольцо Алтаря и Эссенция Силы.';
		}else{
			mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$itm1['id'].'" OR `id` = "'.$itm2['id'].'"');
			$u->addItem(7026,$u->info['id']);
			$r = 'Вы получили &quot;Воинское Кольцо Алтаря&quot; в обмен на: Кольцо Алтаря и Эссенция Силы.';
		}
	}
	
	unset($vad);
}

?>