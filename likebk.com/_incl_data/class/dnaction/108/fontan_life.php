<?
if( isset($s[1]) && $s[1] == '108/fontan_life' ) {
	 
	 $vad = array('go' => true);
	 
	//Все переменные сохранять в массиве $vad !
	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `vars` = "obj_act'.$obj['id'].'" AND `dn` = "'.$u->info['dnow'].'" LIMIT 1'));
	$vad['test2'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `vars` = "obj_act'.$obj['id'].'" AND `uid` = '.$u->info['id'].' AND `dn` = "'.$u->info['dnow'].'" LIMIT 1'));
	
		if($vad['test1'][0] > 1 || $vad['test2'][0] > 0) {
			$vad['go'] = false;
			$r = "Ничего не произошло...";
		}

		if($vad['go'] == true) {
			mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","'.$vad['bad'].'")');
			$this->pickitem($obj,2417,$u->info['id'],'',false);
			$r = 'Вы обнаружили Глоток легкой жизни';
		}
	
	unset($vad);
}

?>