<?
if( isset($s[1]) && $s[1] == '106/trap' ) {
if (!function_exists('trap_eff2')) {
	function trap_eff2($x,$const,$eff_id,$id) {
		if($x > $const) {
			$x = $const;
		}
		if($eff_id == 501) {
			$data = 'add_speed_dungeon=-'.(20*$x).'|dn_delete=1';
			$name = 'Дрожь в коленях (x'.$x.')';
		}elseif($eff_id == 502) {
			$data = 'add_speedhp='.(100*$x).'|add_speedmp='.(100*$x).'|dn_delete=1';
			$name = 'Ускоренное обновление (x'.$x.')';
		}elseif($eff_id == 503) {
			$data = 'add_zm=-'.(25*$x).'|dn_delete=1';
			$name = 'Стихийная слабость (x'.$x.')';
		}elseif($eff_id == 504) {
			$data = 'add_s1=-'.(5*$x).'|add_s2=-'.(5*$x).'|add_s3=-'.(5*$x).'|add_s5=-'.(5*$x).'|dn_delete=1';
			$name = 'Болотная лихорадка (x'.$x.')';
		}
		mysql_query('UPDATE `eff_users` SET `name` = "'.$name.'", `data` = "'.$data.'", `timeUse` = '.time().', `x` = '.$x.' WHERE `id` = '.$id.' LIMIT 1');
		return 0;
	}
}
$act = 1;
if($obj['name'] == "Корявый пень" || $obj['name'] == "Древний пень" || $obj['name'] == "Трухлявый пень" || $obj['name'] == "Огромный Валун" || $obj['name'] == "Древняя глыба") {
	$click = 2;//3клика 
	if(rand(0,100) <= 35) {
		$itms = array(9486,9485,9484,9483,9482,9480,9478,9479);
	}else{
		$itms = array(0);
		$act = 0;
	}
}elseif($obj['name'] == "Берег озера") {
	$click = 4; //5кликов 
	if(rand(0,100) >= 35) {
		$itms = array(9481);
	}elseif(rand(0,100) <= 20) {
		$itms = array(9488,9489,9490,9491,9492,9493,9494,9495,9496);
	}else{
		$itms = array(0);
		$act = 0;
	}
}elseif($obj['name'] == "Костер") {
	$click = 4; //5кликов
	if(rand(0,100) <= 20) {
		$itms = array(9488,9489,9490,9491,9492,9493,9494,9495,9496);
	}elseif(rand(0,100) >= 50){
		$itms = array(9486,9485,9484,9483,9482,9480,9478,9479);
	}else{
		$itms = array(0);
		$act = 0;
	}
}

	$vad = array('go' => true);
	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `vars` = "obj_act'.$obj['id'].'" AND `dn` = "'.$u->info['dnow'].'" LIMIT 1'));
	
	if($click < $vad['test1'][0]) {
		$vad['go'] = false;
		$r = 'Ничего не призошло...';
	}
		if($vad['go'] == true) {
			//задержка
			mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","1")');

		if($act > 0) {
			$itms = $itms[rand(0,count($itms)-1)];
			if($itms != 0) {
				$add = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = '.$itms.' LIMIT 1'));
				if(isset($add['id'])) {
					$this->pickitem($obj,$add['id'],$u->info['id'],'',false);
					$r = 'Вы обнаружили "'.$add['name'].'"';
				}else{
					$r = 'Предмет не найден! Сообщите админам';
				}
			}else{
				$r = 'Вы ничего не нашли...';
			}
		}else{
			//id_eff
			$rz = array(501,502,503,504);
			$rz = $rz[rand(0,count($rz)-1)];
			//effect
		   $eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = '.$rz.' LIMIT 1'));
		   $eff_now = mysql_fetch_array(mysql_query('SELECT `id`,`id_eff`,`data`,`x` FROM `eff_users` WHERE `uid` = '.$u->info['id'].' AND `delete` = 0 AND `id_eff` = '.$eff['id2'].' LIMIT 1'));
			if(isset($eff['id2'])) {
				if(isset($eff_now['id'])) {
					if($eff_now['id_eff'] == 501 && $eff_now['x'] < 5) {
						$eff_now['x'] += 1;
						trap_eff2($eff_now['x'],5,$eff_now['id_eff'],$eff_now['id']);
					}elseif($eff_now['id_eff'] == 502 && $eff_now['x'] < 3) {
						$eff_now['x'] += 1;
						trap_eff2($eff_now['x'],3,$eff_now['id_eff'],$eff_now['id']);
					}elseif($eff_now['id_eff'] == 503 && $eff_now['x'] < 3) {
						$eff_now['x'] += 1;
						trap_eff2($eff_now['x'],3,$eff_now['id_eff'],$eff_now['id']);
					}elseif($eff_now['id_eff'] == 504 && $eff_now['x'] < 5) {
						$eff_now['x'] += 1;
						trap_eff2($eff_now['x'],5,$eff_now['id_eff'],$eff_now['id']);
					}
				}else{
					mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`x`,`hod`) VALUES ("'.$eff['id2'].'","'.$u->info['id'].'","'.$eff['mname'].'","'.$eff['mdata'].'","'.$eff['oneType'].'","'.time().'","1","-1")');
				}
			}else{
				$r = 'Эффект не найден! Сообщите Администрации!';
			}
		$r = 'Вы попали в ловушку, на вас наложено заклятие "'.$eff['mname'].'"';
		
	}
}
		unset($vad);
	}