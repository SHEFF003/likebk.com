<?
if( isset($s[1]) && $s[1] == '108/ring' ) {
	 
	 $vad = array('go' => true);
	 
	$vad['test2'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `vars` = "obj_act'.$obj['id'].'" AND `uid` = '.$u->info['id'].' AND `dn` = "'.$u->info['dnow'].'" LIMIT 1'));
	
		if($vad['test2'][0] > 0) {
			$vad['go'] = true;
			$r = "Ничего не произошло...";
		}

		if($vad['go'] == true) {
			//$vad['items'] = array(0 => 8305, 1 = > 8306);
			//$vad['items'] = $vad['items'][rand(0,1)];
			$vad['im'] = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = '.$vad['items'].' LIMIT 1'));
			if(isset($vad['im']['id'])) {
				$this->pickitem($obj,$vad['im']['id'],$u->info['id'],'',false);
				$r = 'Вы обнаружили "'.$vad['im']['name'].'"';
			}else{
				$r = 'Предмет не найден! Сообщите Администрации!';
			}
			mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","'.$vad['bad'].'")');
		}
	
	unset($vad);
}

?>