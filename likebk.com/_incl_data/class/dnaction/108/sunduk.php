<?
if( isset($s[1]) && $s[1] == '108/sunduk' ) {
	 
	 $vad = array('go' => true);
	 
	//Все переменные сохранять в массиве $vad !
	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `vars` = "obj_act'.$obj['id'].'" AND `uid` = '.$u->info['id'].' AND `dn` = "'.$u->info['dnow'].'" LIMIT 1'));
	
		if($vad['test1'][0] > 0) {
			$vad['go'] = false;
			$r = "Ничего не произошло...";
		}

		if($vad['go'] == true) {
			mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","'.$vad['bad'].'")');
			/*if(rand(0,100) <= 10) {
				$itms = array(2143,2144);
				$itms = $itms[rand(0,count($itms)-1)];
			}else{
				$itms = 961;
			}
			
			$im = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = '.$itms.' LIMIT 1'));
			if(isset($im['id'])) {
				$this->pickitem($obj,$im['id'],$u->info['id'],'',false);
				$r = 'Вы обнаружили "'.$im['name'].'"';
			}else{
				$r = 'Предмет не найден, сообщите Администратору!';
				$r =  rand(0,100);
			}
			*/
			if(rand(0,100) <= 70) {
				$itms = 969;
				$this->pickitem($obj,969,$u->info['id'],'',false);
				$r = 'Вы обнаружили "Открытку для Друга"';
			}else{
				$r = 'Вы ничего не обнаружили...';
			}
			
		}
	
	unset($vad);
}

?>