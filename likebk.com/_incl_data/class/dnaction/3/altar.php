<?
if( isset($s[1]) && $s[1] == '3/altar' ) {
	/*
		АЛтарь
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
		mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES (
			"'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","'.$vad['bad'].'"
		)');
		$vad['i1'] = array(
			0 => 422,
			1 => 423,
			2 => 424,
			3 => 425,
			4 => 486,
			5 => 487,
			6 => 488
		);
		
		
		$vad['i2'] = array(
    		422 => 'INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`) VALUES ("422","'.$u->info['id'].'","Благословение глубин: Скорость","add_s2=5|nofastfinisheff=1|dun=3","60","'.time().'") ' ,
   			423 => 'INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`) VALUES ("423","'.$u->info['id'].'","Благословение глубин: Мощь","add_s1=5|nofastfinisheff=1|dun=3","61","'.time().'") ' ,
   			424 => 'INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`) VALUES ("424","'.$u->info['id'].'","Проклятие глубин: Регенерация","add_speedhp=-50|nofastfinisheff=1|dun=3","62","'.time().'") ' ,
    		425 => 'INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`) VALUES ("425","'.$u->info['id'].'","Печать Хаоса","add_yron_min=-25|add_yron_max=25|nofastfinisheff=1|dun=3","63","'.time().'") ',
    		486 => 'INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`) VALUES ("486","'.$u->info['id'].'","Благословение глубин: Предчувствие","add_s3=5|nofastfinisheff=1|dun=3","63","'.time().'") ',
    		487 => 'INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`) VALUES ("487","'.$u->info['id'].'","Печать Хаоса","add_yron_max=25|nofastfinisheff=1|dun=3","63","'.time().'") ',
    		488 => 'INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`) VALUES ("488","'.$u->info['id'].'","Благословение глубин: Регенерация","add_speedhp=50|nofastfinisheff=1|dun=3","63","'.time().'") ');
        $vad['i1'] = $vad['i1'][rand(0,count($vad['i1'])-1)];
		if( isset($vad['i2'][$vad['i1']]) ) {
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `id_eff` = "'.$vad['i1'].'" AND `delete` = 0');
        	mysql_query($vad['i2'][$vad['i1']]);
			
		if($vad['i1'] == 425) {
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `id_eff` = "487" AND `delete` = 0');
		}elseif($vad['i1'] == 487) {
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `id_eff` = "425" AND `delete` = 0');
		}
		
			$r = 'На вас наложено заклятие!';
		}else{
			$r = 'На вас наложено заклятие! (эффект не найден, пожалуйся Админам)';
		}
	}
	
	unset($vad);
}

?>