<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'pasha' ) {	
	
	ini_set('display_errors','On');
	
	if( $itm['iznosNOW'] >= $itm['iznosMAX'] ) {
		$u->error = 'Нельзя использовать!';
	}elseif( $u->info['battle'] == 0 ) {
		$u->error = 'Необходимо находиться в поединке!';
	}else{
		$jl = $_GET['login'];
		$_GET['login'] = urlencode($_GET['login']);
		//используем на персонажа (все кроме себя)	
		$_GET['login'] = str_replace('%',' ',$_GET['login']);
		$_GET['login'] = str_replace('25','',$_GET['login']);
		//
		$usr = mysql_fetch_array(mysql_query('SELECT `st`.`atack`, `st`.`clone`, `u`.`bot_id`, `u`.`type_pers`,`u`.`inTurnir`,`st`.`zv`,`st`.`bot`,`st`.`hpNow`,`u`.`login`,`st`.`dnow`,`u`.`id`,`u`.`align`,`u`.`admin`,`u`.`clan`,`u`.`level`,`u`.`room`,`u`.`online`,`u`.`battle`,`st`.`team` FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`city` = "'.$u->info['city'].'" AND `u`.`battle` = "'.$u->info['battle'].'" AND (`u`.`login`="'.mysql_real_escape_string($_GET['login']).'" OR `u`.`login`="'.mysql_real_escape_string($jl).'") LIMIT 1'));
		$bact = mysql_fetch_array(mysql_query('SELECT * FROM `pasha_use` WHERE `uid` = "'.$u->info['id'].'" AND `btl` = "'.$u->info['battle'].'" LIMIT 1'));
		if( $u->stats['hpNow'] < 1 ) {
			$u->error = 'Вы погибли!';
		}elseif(isset($bact['id'])) {
			$u->error = 'Задержка еще '.$bact['hod'].' ход(а).';
		}elseif(isset($usr['id'])) {
			$gj = 0; $txt = '';
			if( $itm['item_id'] == 7029 || $itm['item_id'] == 7030 ) {
				if( $usr['team'] == $u->info['team'] || $usr['battle'] != $u->info['battle'] ) {
					$u->error = 'Используется на противника!';
				}elseif( $usr['hpNow'] < 1 ) {
					$u->error = 'Противник погиб!';
				}else{
					//
					$test20 = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$usr['id'].'" AND `v2` = "346" AND `delete` = 0 LIMIT 1'));
					if(isset($test20['id'])) {
						$u->error = 'На персонаже уже есть пасхальный эффект!';
					}elseif( $itm['item_id'] == 7029 ) {
						mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
						mysql_query("
							INSERT INTO `eff_users` ( `id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`) VALUES
							( 22, '".$usr['id']."', 'Пасхальное отрицание', 'add_m10=-75|add_m11=-75|add_za=-75|add_zm=-75', 0, 77, 0, '".$u->info['id']."', 0, 'priem', 346, 'easter_egg_small_1.png', 1, 3, 'пасхальныйэффект1', 0, 0, '', 0, 0, 0, 1, 0);
						");
					}elseif( $itm['item_id'] == 7030 ) {
						mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
						mysql_query("
							INSERT INTO `eff_users` ( `id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`) VALUES
							( 22, '".$usr['id']."', 'Пасхальное потрясение', 'add_za=-150|add_zm=-150', 0, 77, 0, '".$u->info['id']."', 0, 'priem', 346, 'easter_egg_small_5.png', 1, 3, 'пасхальныйэффект1', 0, 0, '', 0, 0, 0, 1, 0);
						");
						mysql_query('INSERT INTO `pasha_use` (`uid`,`btl`,`hod`) VALUES ("'.$u->info['id'].'","'.$u->info['battle'].'","5")');
						$u->error = 'Вы успешно использовали &quot;'.$itm['name'].'&quot; на персонажа &quot;'.$usr['login'].'&quot;!';
						$txt .= ' на {u2}.';
						$gj++;
					}
					//
				}
			}elseif( $itm['item_id'] == 7031 ) {
				if( $usr['team'] != $u->info['team'] || $usr['battle'] != $u->info['battle'] ) {
					$u->error = 'Используется на союзника!';
				}elseif( $usr['hpNow'] < 1 ) {
					$u->error = 'Цель погибла!';
				}else{
					//
					$test20 = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$usr['id'].'" AND `v2` = "347" AND `delete` = 0 LIMIT 1'));
					if(isset($test20['id'])) {
						$u->error = 'На персонаже уже есть пасхальный эффект!';
					}elseif( $itm['item_id'] == 7031 ) {
						mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
						mysql_query("
							INSERT INTO `eff_users` ( `id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`) VALUES
							( 22, '".$usr['id']."', 'Пасхальное наступление', 'add_m10=50|add_m11=50', 0, 77, 0, '".$u->info['id']."', 0, 'priem', 347, 'easter_egg_small_3.png', 1, 1, 'пасхальныйэффект2', 0, 0, '', 0, 0, 0, 1, 0);
						");
						mysql_query('INSERT INTO `pasha_use` (`uid`,`btl`,`hod`) VALUES ("'.$u->info['id'].'","'.$u->info['battle'].'","5")');
						$u->error = 'Вы успешно использовали &quot;'.$itm['name'].'&quot; на персонажа &quot;'.$usr['login'].'&quot;!';
						$txt .= ' на {u2}.';
						$gj++;
					}
					//
				}
			}elseif( $itm['item_id'] == 7032 ) {
				if( $usr['team'] != $u->info['team'] || $usr['battle'] != $u->info['battle'] ) {
					$u->error = 'Используется на союзника!';
				}elseif( $usr['hpNow'] < 1 ) {
					$u->error = 'Цель погибла!';
				}else{
					mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
					//
					//$test20 = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$usr['id'].'" AND `v2` = "347" AND `delete` = 0 LIMIT 1'));
					//if(isset($test20['id'])) {
					//	$u->error = 'На персонаже уже есть пасхальный эффект!';
					//}elseif( $itm['item_id'] == 7032 ) {
						mysql_query('UPDATE `stats` SET `tactic4` = `tactic4` + 5 WHERE `id` = "'.$usr['id'].'" LIMIT 1');
					//}
					//
					mysql_query('INSERT INTO `pasha_use` (`uid`,`btl`,`hod`) VALUES ("'.$u->info['id'].'","'.$u->info['battle'].'","5")');
					$u->error = 'Вы успешно использовали &quot;'.$itm['name'].'&quot; на персонажа &quot;'.$usr['login'].'&quot;!';
					$txt .= ' на {u2}.';
					$gj++;
				}
			}elseif( $itm['item_id'] == 7033 ) {
				if( $usr['team'] == $u->info['team'] || $usr['battle'] != $u->info['battle'] ) {
					$u->error = 'Нельзя использовать на союзника!';
				}elseif( $usr['hpNow'] < 1 ) {
					$u->error = 'Цель погибла!';
				}else{
					mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
					//
					//прием "Тепловой удар" - магический урон. 
					global $priem;
					$pvr = array();
						//Действие при клике
						$pvr['hp'] = rand(1,50);
						$pvr['hp'] = $priem->magatack( $u->info['id'], $usr['id'], $pvr['hp'], 'огонь', 1 );
						$pvr['promah_type'] = $pvr['hp'][3];
						$pvr['promah'] = $pvr['hp'][2];
						$pvr['krit'] = $pvr['hp'][1];
						$pvr['hp']   = $pvr['hp'][0];
						$pvr['hpSee'] = '--';
						$pvr['hpNow'] = floor($btl->stats[$btl->uids[$usr['id']]]['hpNow']);
						$pvr['hpAll'] = $btl->stats[$btl->uids[$usr['id']]]['hpAll'];
							
						//Используем проверку на урон приемов
						$pvr['hp'] = $btl->testYronPriem( $u->info['id'], $usr['id'], 21, $pvr['hp'], 8, true );
							
						$pvr['hpSee'] = '-'.$pvr['hp'];
						$pvr['hpNow'] -= $pvr['hp'];
						$btl->priemYronSave($u->info['id'],$usr['id'],$pvr['hp'],0);
							
						if( $pvr['hpNow'] > $pvr['hpAll'] ) {
							$pvr['hpNow'] = $pvr['hpAll'];
						}elseif( $pvr['hpNow'] < 0 ) {
							$pvr['hpNow'] = 0;
						}
							
						$btl->stats[$btl->uids[$usr['id']]]['hpNow'] = $pvr['hpNow'];
							
						mysql_query('UPDATE `stats` SET `hpNow` = "'.$btl->stats[$btl->uids[$usr['id']]]['hpNow'].'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
							
						$prv['text'] = $btl->addlt(1 , 19 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL);
						
						//Цвет приема
						if( $pvr['promah'] == false ) {
							if( $pvr['krit'] == false ) {
								$prv['color2'] = '006699';
								if(isset($btl->mcolor[$btl->mname['земля']])) {
									$prv['color2'] = $btl->mcolor[$btl->mname['земля']];
								}
								$prv['color'] = '000000';
								if(isset($btl->mncolor[$btl->mname['земля']])) {
									$prv['color'] = $btl->mncolor[$btl->mname['земля']];
								}
							}else{
								$prv['color2'] = 'FF0000';
								$prv['color'] = 'FF0000';
							}
						}else{
							$prv['color2'] = '909090';
							$prv['color'] = '909090';
						}
						
						$prv['text2'] = '{tm1} '.$prv['text'].'. <font Color='.$prv['color'].'><b>'.$pvr['hpSee'].'</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].']';
						if( $pvr['promah_type'] == 2 ) {
							$prv['text'] = $btl->addlt(1 , 20 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL);
							$prv['text2'] = '{tm1} '.$prv['text'].'. <font Color='.$prv['color'].'><b>--</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].']';
						}
						$btl->priemAddLog( $id, 1, 2, $u->info['id'], $usr['id'],
							'<font color^^^^#'.$prv['color2'].'>Пасхальный удар</font>',
							$prv['text2'],
							($btl->hodID + 1)
						);
					
					unset($pvr);
					//
					mysql_query('INSERT INTO `pasha_use` (`uid`,`btl`,`hod`) VALUES ("'.$u->info['id'].'","'.$u->info['battle'].'","5")');
					$u->error = 'Вы успешно использовали &quot;'.$itm['name'].'&quot; на персонажа &quot;'.$usr['login'].'&quot;!';
					$txt .= ' на {u2}.';
					$gj++;
				}
			}
			
			if( $gj > 0 ) {
				if( $itm['item_id'] != 7033 ) {
					if($u->info['sex']==1) {
						$txt = '{u1} применила заклинание &quot;<b>'.$itm['name'].'</b>&quot; '.$txt.'';
					}else{
						$txt = '{u1} применил заклинание &quot;<b>'.$itm['name'].'</b>&quot; '.$txt.'';
					}
					$lastHOD = mysql_fetch_array(mysql_query('SELECT * FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
					$id_hod = $lastHOD['id_hod'];
					if($lastHOD['type']!=6) {
						if( $kst != 7 ) {
							$id_hod++;
						}
					}
					mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.time().'","'.$u->info['battle'].'","'.($id_hod).'","{tm1} '.$txt.'","login1='.$u->info['login'].'||t1='.$u->info['team'].'||time1='.time().'||login2='.$usr['login'].'||t2='.$usr['team'].'||time2='.time().'","","","","","6")');
				}
				//
			}
			
		}else{
			$u->error = 'Персонаж не найден!';
		}
		//mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
	}
}
?>