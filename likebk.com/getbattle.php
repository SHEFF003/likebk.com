<?php

if(!isset($_POST['loading']) && !isset($_GET['loading'])) {
	//die();
}

function GetRealIp(){
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
		return $_SERVER['HTTP_CLIENT_IP'];
	else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	return $_SERVER['REMOTE_ADDR'];
}

define('IP',GetRealIp());
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');

class battleNew {
	
	
	
}

$user = mysql_fetch_array(mysql_query('SELECT `id`,`battle` FROM `users` WHERE `login` = "'.mysql_real_escape_string($_COOKIE['login']).'" AND `pass` = "'.mysql_real_escape_string($_COOKIE['pass']).'" lIMIT 1'));
if(isset($user['id']) && $user['battle'] > 0) {
	$stats = mysql_fetch_array(mysql_query('SELECT * FROM `stats` WHERE `id` = "'.$user['id'].'" LIMIT 1'));
	
	if( $stats['hpNow'] > $stats['hpAll'] ) {
		$stats['hpNow'] = $stats['hpAll'];
	}
	if( $stats['mpNow'] > $stats['mpAll'] ) {
		$stats['mpNow'] = $stats['mpAll'];
	}
	
	$bt = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$user['battle'].'" LIMIT 1'));
	
	//Получаем данные о поединке
	$r = '';
	
	//Проверяем размен с текущим противником
	$bot_go = false;
	$rd = '';
		
	$sp = mysql_query('SELECT * FROM `battle_act` WHERE ( `uid1` = "'.$user['id'].'" OR `uid2` = "'.$user['id'].'" ) AND `battle` = "'.$user['battle'].'" ORDER BY `time` ASC');
	while( $pl = mysql_fetch_array($sp) ) {
		$rd .= ',['.$pl['id'].','.$pl['uid1'].','.$pl['uid2'].','.($pl['time']-time()+$bt['timeout']).']';
		//
		if( $pl['uid1'] == $user['id'] && $bot_go == false ) {
			$bot_test = mysql_fetch_array(mysql_query('SELECT `id` FROM `stats` WHERE `id` = "'.$pl['uid2'].'" LIMIT 1'));
			if(isset($bot_test['id'])) {
				$bot_go = true;
			}
		}
		//
	}	
	$rd = ltrim($rd,',');
	$r .= ',"act":['.$rd.']';
	unset($sp,$pl,$rd);
		
	if( $bot_go == false ) {
		//Проверяем ботов в этом бою
		$bot_battle = array();
		$bot_battle2 = array();
		$sp = mysql_query('SELECT `a`.`id` FROM `users` AS `a` LEFT JOIN `stats` AS `b` ON `a`.`id` = `b`.`id` WHERE `a`.`battle` = "'.$user['battle'].'"');
		while( $pl = mysql_fetch_array($sp) ) {
			if( $bot_go == false ) {
				$rz = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_act` WHERE `uid1` = "'.$pl['id'].'" AND `uid2` = "'.$user['id'].'" AND `battle` = "'.$user['battle'].'" LIMIT 1'));
				if(!isset($rz['id'])) {
					$bot_go = true;
				}
			}	
		}
	}
		
	//Удары ботов
	if( $bot_go == true ) {
		file_get_contents('http://likebk.com/jx/battle/reflesh_new.php?user='.$user['id'].'');
	}
	
	if(isset($_GET['global'])) {
				
		if(isset($bt['id'])) {
			
			//Получение инф. о пользователях в бою
			$rd = '';
			$sp = mysql_query('SELECT `id`,`login`,`level`,`align`,`clan` FROM `users` WHERE `battle` = "'.$bt['id'].'"');
			while( $pl = mysql_fetch_array($sp) ) {
				$st = mysql_fetch_array(mysql_query('SELECT `hpNow`,`mpNow`,`hpAll`,`mpAll`,`team` FROM `stats` WHERE `id` = "'.$pl['id'].'" LIMIT 1'));
				$rd .= '['.(0+$pl['id']).','.(0+$st['hpNow']).','.(0+$st['mpNow']).','.(0+$st['hpAll']).','.(0+$st['mpAll']).'],';
			}
			$rd = rtrim($rd,',');
			$r .= ',"u":['.$rd.']';
			
		}else{
			$error = 'Поединок не найден...';
		}
		
		//Эффекты текущего персонажа и противника
		$r .= ',"eff_me":[';
		$i = 0;
		$sp = mysql_query('SELECT * FROM `eff_users` WHERE ( `uid` = "'.$user['id'].'" OR `uid` = "'.$stats['enemy'].'" ) AND `delete` = "0" ORDER BY `id` DESC');
		while( $pl = mysql_fetch_array($sp) ) {
			if( $pl['v1'] == 'priem' ) {
				$prm = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$pl['v2'].'" AND `img` NOT LIKE "%wis_%" LIMIT 1'));
				if( $user['id'] == $pl['uid'] || $prm['neg'] > 0 ) {
					if( $i == 0 ) {
						$i++;
					}else{
						$r .= ',';
					}
					$r .= '['.$pl['uid'].','.$pl['id'].','.$pl['id_eff'].',"'.$pl['name'].'","'.$prm['img'].'.gif","14"]';
				}
			}else{
				if( $user['id'] == $pl['uid'] ) {
					if( $i == 0 ) {
						$i++;
					}else{
						$r .= ',';
					}
					$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "'.$pl['id_eff'].'" LIMIT 1'));
				
					$r .= '['.$pl['uid'].','.$pl['id'].','.$pl['id_eff'].',"'.$pl['name'].'","'.$eff['img'].'","'.$eff['type1'].'"]';
				}
			}
		}
		$r .= ']';
		//
		
	}elseif(isset($_GET['loading'])) {
		//Загрузда дополнительных данных
		if(isset($_GET['uload']) && $_GET['uload'] != '0') {
			//Загрузка пользователей
			$ex = explode(',',$_GET['uload']);
			$i = 1;
			$rd = '';
			while( $i < count($ex) ) {
				if( $ex[$i] > 0 ) {
					//
					$us = mysql_fetch_array(mysql_query('SELECT
					
						`id`,`login`,`level`,`clan`,`align`,`obraz`
					
					FROM `users` WHERE `battle` = "'.$user['battle'].'" AND `id` = "'.mysql_real_escape_string($ex[$i]).'" LIMIT 1'));
					if(isset($us['id'])) {
						$ss = mysql_fetch_array(mysql_query('SELECT
						
						`hpNow`,`mpNow`,`hpAll`,`mpAll`,`team`
						
						FROM `stats` WHERE `id` = "'.$us['id'].'" LIMIT 1'));
						
						if( $ss['hpNow'] > $ss['hpAll'] ) {
							$ss['hpNow'] = $ss['hpAll'];
						}
						
						if( $ss['mpNow'] > $ss['mpAll'] ) {
							$ss['mpNow'] = $ss['mpAll'];
						}
						
						$rd .= ',{';
						// 
						$rd .= ' "id":'.( 0 + (int)$ex[$i] );
						$rd .= ',"login":"'.$us['login'].'"';
						$rd .= ',"level":"'.$us['level'].'"';
						$rd .= ',"align":"'.$us['align'].'"';
						$rd .= ',"clan":"'.$us['clan'].'"';
						$rd .= ',"team":"'.$ss['team'].'"';
						$rd .= ',"hp":'.( 0 + $ss['hpNow'] ).'';
						$rd .= ',"mp":'.( 0 + $ss['mpNow'] ).'';
						$rd .= ',"hpAll":'.( 0 + $ss['hpAll'] ).'';
						$rd .= ',"mpAll":'.( 0 + $ss['mpAll'] ).'';
						$rd .= ',"sex":'.( 0 + $us['sex'] ).'';
						$rd .= ',"obraz":"'.$us['obraz'].'"';
						//
						//Предметы
						$ri = '';
						$sp = mysql_query('SELECT `id`,`item_id`,`inOdet`,`magic_inc` FROM `items_users` WHERE `uid` = "'.$us['id'].'" AND `delete` = 0 AND `inOdet` > 0');
						while( $pl = mysql_fetch_array($sp) ) {
							//
							$im = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`img`,`magic_inci` FROM `items_main` WHERE `id` = "'.$pl['item_id'].'" LIMIT 1'));
							//
							$ccv = '';
							if( $pl['magic_inc'] == '' ) {
								$pl['magic_inc'] = $im['magic_inci'];
							}
							if( $pl['magic_inc'] != '' ) {
								$mgi = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "'.$pl['magic_inc'].'" AND `type1` = "12345" LIMIT 1'));
								if(isset($mgi['id2'])) {
									$ccv .= 'top.useMagicBattle(\''.$mgi['mname'].'\','.$pl['id'].',\''.$mgi['img'].'\',1,2);';
								}
							}
							//
							$ri .= ',['.$pl['id'].','.$pl['item_id'].','.$pl['inOdet'].',"'.$im['name'].'","'.$im['img'].'","'.$ccv.'"]';
						}
						$ri = ltrim($ri,',');
						$rd .= ',"itm":['.$ri.']';
						//
						//Эффекты (не требуется кэширование)
						$ri = '';

						$ri = ltrim($ri,',');
						$rd .= ',"eff":['.$ri.']';
						//
						//
						$rd .= ' }';
					}
				}
				$i++;
			}
			$rd = ltrim($rd,',');
			$r .= ',"ul":['.$rd.']';
			unset($rd,$ri);
			//
		}
		//
		if(isset($_GET['pload']) && $_GET['pload'] != '0') {
			//Загрузка приемов
			$ex = explode(',',$_GET['pload']);
			$i = 1;
			$rd = '';
			while( $i < count($ex) ) {
				if( $ex[$i] > 0 ) {
					//
					$pl = mysql_fetch_array(mysql_query('SELECT
					
						`id`,`name`,`img`,`type`,`onUser`,`team`,`tt1`,`tt2`,`tt3`,`tt4`,`tt5`,`tt6`,`tt7`
					
					FROM `priems` WHERE `id` = "'.mysql_real_escape_string($ex[$i]).'" AND `img` NOT LIKE "%wis_%" LIMIT 1'));
					if(isset($pl['id'])) {
						//
						$rd .= ',{';
						// 
						$rd .= ' "id":'.( 0 + (int)$ex[$i] );
						$rd .= ',"name":"'.$pl['name'].'"';
						$rd .= ',"img":"'.$pl['img'].'"';
						$rd .= ',"type":"'.$pl['type'].'"';
						$rd .= ',"onUser":"'.$pl['onUser'].'"';
						$rd .= ',"team":"'.$pl['team'].'"';
						$rd .= ',"trtt":"[0,'.$pl['tt1'].','.$pl['tt2'].','.$pl['tt3'].','.$pl['tt4'].','.$pl['tt5'].','.$pl['tt6'].','.$pl['tt7'].']"';
						//
						$rd .= ' }';
						//
					}
				}
				$i++;
			}
			$rd = ltrim($rd,',');
			$r .= ',"pl":['.$rd.']';
			unset($sp,$pl,$rd);
			//
		}
		//
	}
		
}else{
	$error = 'Пользователь в бою не найден...';
}

echo '{ "btl":"'.(0+$bt['id']).'" , "hod":"'.(0+$bt['hod']).'" , "you":"'.(0+$user['id']).'" , "enemy":"'.(0+$stats['enemy']).'" , "pr": [ "'.$stats['priems'].'" , "'.$stats['priems_z'].'" , '.(0+$stats['priemslot']).' ] , "dm":"'.floor($stats['battle_yron']).'" , "to":"'.round($bt['timeout']/60,2).'" , "r":{ '.ltrim($r,',').' } , "e":"'.$error.'" , "t1":"'.$stats['tactic1'].'" , "t2":"'.$stats['tactic2'].'" , "t3":"'.$stats['tactic3'].'" , "t4":"'.$stats['tactic4'].'" , "t5":"'.$stats['tactic5'].'" , "t6":"'.$stats['tactic6'].'" , "t7":"'.$stats['tactic7'].'" }';

?>