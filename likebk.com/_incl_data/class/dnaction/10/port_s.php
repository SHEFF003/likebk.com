<?
if( isset($s[1]) && $s[1] == '10/port_s' ) {
	 
	//Все переменные сохранять в массиве $vad !
	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `vars` = "obj_act'.$obj['id'].'" AND `dn` = "'.$u->info['dnow'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
	$vad['svetlyak'] = mysql_fetch_array(mysql_query('SELECT * FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `uid` = '.$u->info['id'].' AND `vars` = 1234 AND `vals` = "gribnica" LIMIT 1'));
	
		if(isset($vad['svetlyak']['id'])) {
			mysql_query('UPDATE `stats` SET `x` = "-12",`y` = "25" WHERE `id` = '.$vad['svetlyak']['uid'].' LIMIT 1');
			header('location:main.php');
			die();
		}else{
			$vad = array('go' => true);
			if($vad['test1'][0] > 0) {
				$vad['go'] = false;
				$r = "Ничего не произошло...";
			}
			if( $vad['go'] == true ) {
				mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","")');
				
				if(rand(0,100) <= 70) {
					$vad['items'] = array(2854);
				}elseif(rand(0,100) <= 15) {
					$vad['items'] = array(2856);
				}else{
					$r = 'Вы ничего не обнаружили...';
				}
				
				if( !isset($vad['dn_delete'][$vad['items']]) ) {
					$vad['dn_delete'][$vad['items']] = false;
				}
				if( $this->pickitem($obj,$vad['items'],$u->info['id'],'',$vad['dn_delete'][$vad['items']]) ) {
					$r = 'Вы обнаружили предметы...';
				}
			}	
		}
	
	unset($vad);
}

?>