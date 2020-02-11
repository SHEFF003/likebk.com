<?
if( isset($s[1]) && $s[1] == '10/key2' ) {

	$vad = array(
		'go' => true
	);
	
	$vad['test2'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `vars` = "obj_act'.$obj['id'].'" AND `dn` = "'.$u->info['dnow'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
	if( $vad['test2'][0] > 0 ) {
		$r = 'Вы уже обыскали &quot;'.$obj['name'].'&quot;...';
		$vad['go'] = false;
	}
	
	if( $vad['go'] == true ) {

		$vad['items'] = array(8252);
		
		$vad['items'] = $vad['items'][rand(0,count($vad['items'])-1)];
		if( $vad['items'] != 0 ) {

			mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","")');
			if( !isset($vad['dn_delete'][$vad['items']]) ) {
				$vad['dn_delete'][$vad['items']] = false;
			}
			if( $this->pickitem($obj,$vad['items'],$u->info['id'],'',$vad['dn_delete'][$vad['items']]) ) {
				$r = 'Вы обнаружили Охранный Ключ Грибоножки';
			}else{
				$r = 'Вы ничего не нашли...';
			}
		}else{
			$r = 'Вы не нашли ничего полезного...';
		}
	}
	
	unset($vad);
}
?>