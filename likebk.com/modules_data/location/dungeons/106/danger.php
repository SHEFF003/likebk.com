<?php
if(!defined('GAME')) { die(); }

if(isset($file) && $file[0] == 'dungeons/106/danger.php') {
	
	$map = mysql_fetch_array(mysql_query('SELECT `id` FROM `dungeon_map` WHERE `x` = '.$u->info['x'].' AND `y` = '.$u->info['y'].' LIMIT 1'));
	
	function trap_eff($x,$const,$eff_id,$id) {
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
	
   
   
		$rz = array(501,502,503,504);
		$rz = $rz[rand(0,count($rz)-1)];
	   
	   $eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = '.$rz.' LIMIT 1'));
	   $eff_now = mysql_fetch_array(mysql_query('SELECT `id`,`id_eff`,`x` FROM `eff_users` WHERE `uid` = '.$u->info['id'].' AND `delete` = 0 AND `id_eff` = '.$eff['id2'].' LIMIT 1'));
	   	
		$test = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `vars` = "obj'.$map['id'].'" AND `uid` = '.$u->info['id'].' AND `dn` = "'.$u->info['dnow'].'" LIMIT 1'));
		if($test[0] == 0) {
				if(isset($eff['id2'])) {
					if(isset($eff_now['id'])) {
						if($eff_now['id_eff'] == 501 && $eff_now['x'] < 5) {
							$eff_now['x'] += 1;
							trap_eff($eff_now['x'],5,$eff_now['id_eff'],$eff_now['id']);
						}elseif($eff_now['id_eff'] == 502 && $eff_now['x'] < 3) {
							$eff_now['x'] += 1;
							trap_eff($eff_now['x'],3,$eff_now['id_eff'],$eff_now['id']);
						}elseif($eff_now['id_eff'] == 503 && $eff_now['x'] < 3) {
							$eff_now['x'] += 1;
							trap_eff($eff_now['x'],3,$eff_now['id_eff'],$eff_now['id']);
						}elseif($eff_now['id_eff'] == 504 && $eff_now['x'] < 5) {
							$eff_now['x'] += 1;
							trap_eff($eff_now['x'],5,$eff_now['id_eff'],$eff_now['id']);
						}
					}else{
						mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`x`,`hod`) VALUES ("'.$eff['id2'].'","'.$u->info['id'].'","'.$eff['mname'].'","'.$eff['mdata'].'","'.$eff['oneType'].'","'.time().'","1","-1")');
					}
						mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj'.$map['id'].'","'.$vad['bad'].'")');
					
					if($u->info['sex'] == 1) {
						$sex = 'угодила';
					}else{
						$sex = 'угодил';
					}
					$text = '<img src=http://img.likebk.com/i/eff/'.$eff['img'].'> <b>'.$u->info['login'].'</b>, '.$sex.' в <b>Невидимую Ловушку</b>';	
					$d->sys_chat($text);
					
				}else{
					$r = 'Эффект не найден! Сообщите Администрации!';
					$d->sys_chat($r);
				}
			}
			
		}

