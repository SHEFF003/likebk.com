<?php
	
	//die();
	
$mtime = microtime();$mtime = explode(" ",$mtime);$tstart = $mtime[1] + $mtime[0];
		
		session_start();
		
		$tm = microtime();
		$tm = explode(' ',$tm);
		$tm = $tm[0]+$tm[1];
				
		if(!isset($CRON_CORE)) {
			include('../../_incl_data/__config.php');
			if($_SESSION['tbr']>$tm) {
				die('<script>ggcode="'.$code.'";if(t057!=null){clearTimeout(t057);}</script>');
			}else{
				$_SESSION['tbr'] = $tm+0.3;
			}
		}

if(!isset($CRON_CORE)) {
	define('GAME',true);
	include('../../_incl_data/class/__db_connect.php');
}

//mysql_query('INSERT INTO `battle_test` (`time`,`uid`) VALUES ("'.time().'","'.$u->info['id'].'")');

	//Логер
	//include('../../_incl_data/class/Loger.php');
	//$loger = new Loger;
	//$loger->setStart();

/*mysql_query("LOCK TABLES
`users_rating` WRITE,
`aaa_monsters` WRITE,
`actions` WRITE,
`bank` WRITE,

`battle` WRITE,
`battle_act` WRITE,
`battle_actions` WRITE,
`battle_cache` WRITE,
`battle_end` WRITE,
`battle_last` WRITE,
`battle_logs` WRITE,
`battle_logs_save` WRITE,
`battle_stat` WRITE,
`battle_users` WRITE,

`bs_actions` WRITE,
`bs_items` WRITE,
`bs_items_use` WRITE,
`bs_logs` WRITE,
`bs_map` WRITE,
`bs_statistic` WRITE,
`bs_trap` WRITE,
`bs_turnirs` WRITE,
`bs_zv` WRITE,

`clan` WRITE,
`clan_wars` WRITE,

`dungeon_actions` WRITE,
`dungeon_bots` WRITE,
`dungeon_items` WRITE,
`dungeon_map` WRITE,
`dungeon_now` WRITE,
`dungeon_zv` WRITE,

`eff_main` WRITE,
`eff_users` WRITE,

`items_img` WRITE,
`items_local` WRITE,
`items_main` WRITE,
`items_main_data` WRITE,
`items_users` WRITE,

`izlom` WRITE,
`izlom_rating` WRITE,

`laba_act` WRITE,
`laba_itm` WRITE,
`laba_map` WRITE,
`laba_now` WRITE,
`laba_obj` WRITE,

`levels` WRITE,
`levels_animal` WRITE,

`online` WRITE,

`priems` WRITE,

`quests` WRITE,
`reimage` WRITE,

`reg` WRITE,

`stats` WRITE,
`test_bot` WRITE,
`turnirs` WRITE,
`users` WRITE,
`users_animal` WRITE,
`user_ico` WRITE,
`users_twink` WRITE,
`zayvki` WRITE;");*/
				
function e($t) {
	mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("core #'.date('d.m.Y').' %'.date('H:i:s').' (Критическая ошибка): <b>'.mysql_real_escape_string($t).'</b>","capitalcity","INFINITY","6","1","-1")');
}

if(isset($_GET['cron_core'])) {
	$id = array(
		'id' => $_GET['uid'],
		'pass' => $_GET['pass']
	);
	if(md5($id['id'].'_brfCOreW@!_'.$id['pass']) == $_GET['cron_core']) {
		$uzr = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`pass` FROM `users` WHERE `id` = "'.mysql_real_escape_string($id['id']).'" AND `pass` = "'.mysql_real_escape_string($id['pass']).'" LIMIT 1'));
		if(isset($uzr['id'])) {
			$CRON_CORE = true;
			$_COOKIE['login'] = $uzr['login'];
			$_COOKIE['pass'] = $uzr['pass'];
			$_POST['id'] = 'reflesh';
		}
		unset($uzr);
	}
}

if(!isset($CRON_CORE)) {
	header( 'Expires: Mon, 26 Jul 1970 05:00:00 GMT' );
	header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
	header( 'Cache-Control: no-store, no-cache, must-revalidate' );
	header( 'Cache-Control: post-check=0, pre-check=0', false );
	header( 'Pragma: no-cache' );
	header( 'Content-Type: text/html; charset=windows-1251' );
	/*$lock_file = 'lock/battle_'.$_SERVER['HTTP_X_REAL_IP'].'.'.$_COOKIE['auth'].'.bk2'; 
	if ( !file_exists($lock_file) ) { 
		$fp_lock = fopen($lock_file, 'w');
		flock($fp_lock, LOCK_EX); 
	} else { 
		unlink($lock_file);
		die('<b><center><font color=red>Не удалось отправить запрос, повторите попытку снова...</font></center></b>');
	}*/
}

if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' || isset($CRON_CORE))
{
	if(isset($_POST['atack'],$_POST['block']) || (isset($_POST['id']) && $_POST['id']=='reflesh') || isset($_POST['usepriem']) || isset($_POST['useitem']))
	{
		if(isset($_POST['useitemon'])) {
			$_POST['useitemon'] = iconv('UTF-8', 'windows-1251', $_POST['useitemon']);
		}
		
		unset($tm);		
		$js = '';
		include('../../_incl_data/class/__user.php');
		include('../../_incl_data/class/__magic.php');
		include('../../_incl_data/class/__quest.php');
		$btltest = mysql_fetch_array(mysql_query('SELECT `battle` FROM `users` WHERE `id` = "158499643" LIMIT 1'));
		$btltest = $btltest['battle'];
		if( $u->info['id'] == 12345 ) {
			$btltest = $u->info['battle'];
		}
		//if( $btltest > 0 && $u->info['battle'] == $btltest && $u->info['inTurnir'] == 0 && $u->info['inTurnirnew'] == 0 && $u->info['dnow'] == 0 ) {
		//	echo 'TEST_BATTLE';
		if( $u->info['inTurnir'] == 0 && $u->info['inTurnirnew'] == 0 && $u->info['dnow'] == 0 ) {
			include('../../_incl_data/class/__battle0.php');
			include('../../_incl_data/class/_cron0_.php');
		}else{
			include('../../_incl_data/class/__battle.php');
			include('../../_incl_data/class/_cron_.php');
		}
		
		//$arr = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `timeload` WHERE `uid` = "'.$u->info['id'].'" AND `time` > "'.(time()-10).'" LIMIT 1'));
		
		/*if($arr[0] > 20) {
			die('Слишком много запросов...');
		}*/
		
		
		//if( $u->info['battle'] == 57178  ) {
			/*mysql_query('UPDATE `users` SET `battle` = 0 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `battle_rune_exp` WHERE `uid` = "'.$u->info['id'].'"');
			mysql_query('UPDATE `stats` SET `battle_exp` = 0 , `battle_yron` = 0 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');*/
		//	die('Проверка связи с Альфа Центраврой!');
		//}
		
		if( $u->locktest() == true ) {
			$_GET = array();
			$_POST = array();
			/*echo '<script>top.sd4win();</script>';*/
		}
				
			if( $u->info['dnow'] > 0 ) {
				$_SESSION['tbr'] = 0;
				unset($_SESSION['tbr']);
			}
				
		//if(isset($u->info['id']) && $u->info['battle'] == 4746497) {
		//	mysql_query('UPDATE `stats` SET `tactic1` = 25 , `tactic2` = 25 , `tactic3` = 25 , `tactic4` = 25 ,  `tactic5` = 25 , `tactic6` = 25 , `tactic7` = 25 , `hpNow` = 1000000000 , `mpNow` = 1000000000 , `priems_z` = "0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1 ');
		//}
								
		if( $u->info['battle'] == 0 ) {
			$btl_last = mysql_fetch_array(mysql_query('SELECT `id`,`battle` FROM `battle_users` WHERE `uid` = "'.$u->info['id'].'" AND `finish` = "0" LIMIT 1'));
			if( isset($btl_last['id']) && $u->info['battle'] == 0 ) {
				echo '<script>document.getElementById(\'teams\').style.display=\'none\';var battleFinishData = "'.$u->info['battle_text'].'";</script>';
				$u->info['battle'] = $btl_last['id'];
				$u->info['battle_lsto'] = true;
			}
		}else{
			$tst = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_actions` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" AND `vars` = "priem222" LIMIT 1'));
			if(isset($tst['id'])) {
				mysql_query('UPDATE `stats` SET `hpNow` = 0 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				$u->info['hpNow'] = 0;
				$u->stats['hpNow'] = 0;		
			}
		}
				
		if(!isset($CRON_CORE)) {
			if(!isset($u->info['id']) || ($u->info['joinIP']==1 && $u->info['ip']!=$_SERVER['HTTP_X_REAL_IP']))
			{
				die($c['exit']);
			}
		}
		
		function json_fix_cyr($json_str) { 
			/*	$cyr_chars = array ( 
				'\u0430' => 'а', '\u0410' => 'А', 
				'\u0431' => 'б', '\u0411' => 'Б', 
				'\u0432' => 'в', '\u0412' => 'В', 
				'\u0433' => 'г', '\u0413' => 'Г', 
				'\u0434' => 'д', '\u0414' => 'Д', 
				'\u0435' => 'е', '\u0415' => 'Е', 
				'\u0451' => 'ё', '\u0401' => 'Ё', 
				'\u0436' => 'ж', '\u0416' => 'Ж', 
				'\u0437' => 'з', '\u0417' => 'З', 
				'\u0438' => 'и', '\u0418' => 'И', 
				'\u0439' => 'й', '\u0419' => 'Й', 
				'\u043a' => 'к', '\u041a' => 'К', 
				'\u043b' => 'л', '\u041b' => 'Л', 
				'\u043c' => 'м', '\u041c' => 'М', 
				'\u043d' => 'н', '\u041d' => 'Н', 
				'\u043e' => 'о', '\u041e' => 'О', 
				'\u043f' => 'п', '\u041f' => 'П', 
				'\u0440' => 'р', '\u0420' => 'Р', 
				'\u0441' => 'с', '\u0421' => 'С', 
				'\u0442' => 'т', '\u0422' => 'Т', 
				'\u0443' => 'у', '\u0423' => 'У', 
				'\u0444' => 'ф', '\u0424' => 'Ф', 
				'\u0445' => 'х', '\u0425' => 'Х', 
				'\u0446' => 'ц', '\u0426' => 'Ц', 
				'\u0447' => 'ч', '\u0427' => 'Ч', 
				'\u0448' => 'ш', '\u0428' => 'Ш', 
				'\u0449' => 'щ', '\u0429' => 'Щ', 
				'\u044a' => 'ъ', '\u042a' => 'Ъ', 
				'\u044b' => 'ы', '\u042b' => 'Ы', 
				'\u044c' => 'ь', '\u042c' => 'Ь', 
				'\u044d' => 'э', '\u042d' => 'Э', 
				'\u044e' => 'ю', '\u042e' => 'Ю', 
				'\u044f' => 'я', '\u042f' => 'Я', 
				
				'\r' => '', 
				'\n' => '<br />', 
				'\t' => '' 
			);
			foreach ($cyr_chars as $cyr_char_key => $cyr_char) { 
				$json_str = str_replace($cyr_char_key, $cyr_char, $json_str); 
			} */
			return $json_str; 
		}
		
		$u->stats = $u->getStats($u->info['id'],0);
				
		if(!isset($CRON_CORE)) {
			if($u->info['online']<time()-30)
			{
				mysql_query("UPDATE `users` SET `online`='".time()."',`timeMain`='".time()."' WHERE `id`='".$u->info['id']."' LIMIT 1");
				//
				include('../../_incl_data/class/__filter_class.php');
				//
				$filter->setOnline($u->info['online'],$u->info['id'],0);
				$u->onlineBonus();	
			}
		}
				
		include('log_text.php');
		$btl->is = $u->is;
		$btl->items = $u->items;
		$btl->info = $btl->battleInfo($u->info['battle']);
		if(!isset($btl->info['id']))
		{
			if($u->info['battle']==-1)
			{
				//завершаем поединок
				$upd = mysql_query('UPDATE `users` SET `battle` = "0",`online` = "'.time().'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				if(!$upd)
				{
					if(!isset($CRON_CORE)) {
						die('Ошибка завершения поединка.');
					}
				}else{
					echo '<script>location="main.php";</script>';
				}
			}else{
				mysql_query('UPDATE `users` SET `battle` = "0" WHERE `battle` = "'.$u->info['battle'].'" LIMIT 100');
				if(!isset($CRON_CORE)) {
					die('<script>location="main.php";</script>');
				}
			}
		}else{
			//получаем массив с игроками в бою
				$btl->teamsTake();
				
			if(isset($_POST['useitem']) && $btl->testUsersLive() == true) {
				//$u->lock('reflesh.useitems');
				$magic->useItems((int)$_POST['useitem']);
				if($u->error!='') {
					echo '<font color=red><center><b>'.$u->error.'</b></center></font>';
				}
				//$u->unlock();
				die('<script>setTimeout("reflesh(true);",100);</script>');
			}
				
			//заносим удары,приемы,эффекты и т.д.
				//удар
					if(isset($_POST['atack']) && isset($_POST['block']))
					{
						$btl->addAtack();
					}
				//прием
					if(isset($_POST['usepriem']) && $btl->testUsersLive() == true)
					{
						//$u->lock('reflesh.usepriem');
						$priem->pruse($_POST['usepriem']);
						if( /*$u->info['id'] == 12345 ||*/ $_POST['usepriem'] == 265 ) {
							if($u->error!='') {
								echo '<font color=red><center><b>'.$u->error.'</b></center></font>';
							}
							die('<script>setTimeout("reflesh(true);",100);</script>');
						}
						//$u->unlock();
					}
				//используем заклятие / пирожки
										
			//проводим действия (удары, использование приемов, если есть возможность нанести удар или использовать прием)			
				//if(!isset($_POST['usepriem'])) {
					$btl->testActions();
				//}
				
				/*if( $u->info['battle'] == 1937788 ) {
					$mtime = microtime();
					$mtime = explode(" ",$mtime);$mtime = $mtime[1] + $mtime[0];$totaltime = ($mtime - $tstart);
					printf ("<div align=center style=padding-top:10px;color:green;>Страница сгенерирована за %f секунд !</div>", $totaltime);
					die();
				}*/
				
			//авто-смена противника, либо просто смена противника
				if($u->stats['hpNow']>=1)
				{
					//ручная смена
					if(isset($_POST['smn']) && $_POST['smn']!='none')
					{
						/* ---------------- */
						$_POST['smn'] = iconv('UTF-8', 'windows-1251', $_POST['smn']);
						$uidz = mysql_fetch_array(mysql_query('SELECT `id`,`inUser` FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['smn']).'" AND `battle` = "'.$u->info['battle'].'" LIMIT 1'));
						if($uidz['inUser']>0)
						{
							$uidz['id'] = $uidz['inUser'];
						}
						$rsm = $btl->smena($uidz['id'],false);
						if($rsm!=1)
						{
							echo '<font color=red><center><b>'.$rsm.'</b></center></font>';
						}
						unset($rsm);
						$js .= 'smena_login = \'none\';';
					}
					//авто-смена
					if($u->info['enemy']==0 || $btl->stats[$btl->uids[$u->info['enemy']]]['hpNow']<=0 || isset($btl->ga[$u->info['id']][$u->info['enemy']]))
					{
						$btl->autoSmena();
					}
				}else{
					$btl->mainStatus = 3;
				}
			//получаем данные о поединке
				
			//получаем данные о логе боя
				
			//Флаги
				if(isset($_POST['ldrl']) && $_POST['ldrl'] != 'none' &&  $u->info['lider'] == $u->info['battle'] && $btl->info['team_win'] == -1 && $u->stats['hpNow'] >= 1) {
					//
					$_POST['ldrl'] = iconv('UTF-8', 'windows-1251', $_POST['ldrl']);
					$llogin = ($_POST['ldrl']);
					$ltype = round((int)$_POST['ldrt']);
					//
					$uidz = mysql_fetch_array(mysql_query('SELECT `id`,`inUser` FROM `users` WHERE `login` = "'.mysql_real_escape_string($llogin).'" AND `battle` = "'.$u->info['battle'].'" LIMIT 1'));
					if($uidz['inUser']>0) {
						$uidz['id'] = $uidz['inUser'];
					}
					//
					$uidz = mysql_fetch_array(mysql_query('SELECT `b`.`lider`,`a`.`id`,`a`.`login`,`a`.`level`,`a`.`real`,`b`.`team`,`b`.`hpNow` FROM `users` AS `a` LEFT JOIN `stats` AS `b` ON `a`.`id` = `b`.`id` WHERE `a`.`id` = "'.$uidz['id'].'" LIMIT 1'));
					//
					if( $ltype == 1 ) {
						if(!isset($uidz['id']) || $uidz['team'] != $u->info['team'] || $uidz['real'] == 0 || $uidz['hpNow'] < 1 || $uidz['id'] == $u->info['id']) {
							echo '<font color=red><center><b>Персонаж не найден в вашей команде</b></center></font>';
						}else{
							mysql_query('UPDATE `stats` SET `lider` = 0 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
							mysql_query('UPDATE `stats` SET `lider` = "'.$u->info['battle'].'" WHERE `id` = "'.$uidz['id'].'" LIMIT 1');
							$u->info['lider'] = 0;
							$btl->addFlog( '{tm1} <b><span class=CSSteam'.$u->info['team'].' >'.$u->info['login'].'</span></b> передал лидерство <img src=http://img.likebk.com/i/lead'.$u->info['team'].'.gif ><span class=CSSteam'.$u->info['team'].' ><b>'.$uidz['login'].'</b></span>.' , 0 , 0 );
							echo '<font color=red><center><b>Персонаж &quot;'.$uidz['login'].'&quot; назначен новым лидером команды!</b></center></font>';
						}
					}else{
						if(!isset($uidz['id']) || $uidz['team'] != $u->info['team'] || $uidz['hpNow'] < 1 || $uidz['id'] == $u->info['id']) {
							echo '<font color=red><center><b>Персонаж не найден в вашей команде...</b></center></font>';
						}else{
							mysql_query('UPDATE `stats` SET `hpNow` = 0,`mpNow` = 0 WHERE `id` = "'.$uidz['id'].'" LIMIT 1');
							$btl->addFlog( '{tm1} Лидер <img src=http://img.likebk.com/i/lead'.$u->info['team'].'.gif ><b><span class=CSSteam'.$u->info['team'].' >'.$u->info['login'].'</span></b> решил, что команде будет лучше без <span class=CSSteam'.$u->info['team'].' ><b>'.$uidz['login'].'</b></span> и убил его не дожидаясь противников.' , 0 , 0 );
							echo '<font color=red><center><b>Вы убили персонажа &quot;'.$uidz['login'].'&quot;. На правах лидера.</b></center></font>';
						}
					}
					//
					$js .= 'leader_login = \'none\';';
					//
				}
				
			//Если бой сыгран - завершаем
			//if(!isset($_POST['usepriem'])) {
				if($btl->info['team_win']==-1)
				{
					$btl->testFinish();
				}else{
					$btl->testFinish();
				}
			//}
			if($btl->info['team_win']==-1)
			{
				$js .= $btl->genTeams($u->info['id']);
			}else{
				$btl->mainStatus = 3;
				$btl->e = $u->btl_txt;
			}
			
			if( $btl->info['id'] == $u->info['lider'] ) {
				$js .= '$("#btn_down_img3").show();$("#btn_down_img4").show();';
			}else{
				$js .= '$("#btn_down_img3").hide();$("#btn_down_img4").hide();';
			}
			
			if(!isset($CRON_CORE)) {
				$js .= $btl->myInfo($u->info['id'],1);
				//выводим данные	
				if($btl->e!='')
				{
					echo '<font color="red"><center><b>'.$btl->e.'</b></center></font>';
				}
				$doptest = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `battle` = "'.$btl->info['id'].'" AND `uid1` = "'.$u->info['id'].'" AND `uid2` = "'.$u->info['enemy'].'" LIMIT 1'));
				if(isset($btl->ga[$u->info['id']][$u->info['enemy']]) && isset($doptest['id']))
				{
					if($u->info['hpNow']>=1) {
						$btl->mainStatus = 2;	
						
						//$doptest2 = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `id` != "'.$btl->ga[$u->info['id']][$u->info['enemy']].'" AND `battle` = "'.$btl->info['id'].'" AND `uid1` = "'.$u->info['id'].'" AND `uid2` = "'.$u->info['enemy'].'" LIMIT 1'));
						$doptest3 = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `battle` = "'.$btl->info['id'].'" AND `uid2` = "'.$u->info['id'].'" AND `uid1` = "'.$u->info['enemy'].'" LIMIT 1'));
						$doptest4 = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `battle` = "'.$btl->info['id'].'" AND `uid1` = "'.$u->info['id'].'" AND `uid2` = "'.$u->info['enemy'].'" LIMIT 1'));
						if(isset($doptest3['id']) && isset($doptest4['id'])) {
							if($doptest3['id'] > $doptest4['id']) {
								mysql_query('DELETE FROM `battle_act` WHERE `id` = "'.$doptest3['id'].'" LIMIT 1');
							}else{
								mysql_query('DELETE FROM `battle_act` WHERE `id` = "'.$doptest4['id'].'" LIMIT 1');
							}
						}
						//echo '<center><small>[Ожидаем хода: '.$btl->ga[$u->info['id']][$u->info['enemy']].' ('.$doptest['id'].'.'.$doptest['type'].'.'.$doptest['out1'].'.'.$doptest['out2'].'.'.$doptest['uid1'].'.'.$doptest['uid2'].' '.$doptest2['id'].'.'.$doptest2['type'].'.'.$doptest2['out1'].'.'.$doptest2['out2'].'.'.$doptest2['uid1'].'.'.$doptest2['uid2'].' '.$doptest3['id'].'.'.$doptest3['type'].'.'.$doptest3['out1'].'.'.$doptest3['out2'].'.'.$doptest3['uid1'].'.'.$doptest3['uid2'].'),'.$u->info['id'].','.$u->info['enemy'].']<br><font color=red>Если противник вас ударил, но вы не можете ответить на удар сообщите эту информацию Повелителю Багов.</font></small></center>';	
					}
				}else{
					if($u->info['enemy']!=0 && $btl->info['team_win']==-1 && $u->info['hpNow']>=1)
					{
						$js .= $btl->myInfo($u->info['enemy'],2);
					}
				}
				if($btl->info['izlom']>0)
				{
					$js .= 'volna('.(1+$btl->info['izlomRoundSee']).');';
				}
					$i = 1;
					while($i<=7)
					{
						if($btl->users[$btl->uids[$u->info['id']]]['tactic'.$i]<0)
						{
							$btl->users[$btl->uids[$u->info['id']]]['tactic'.$i] = 0;
						}
						if($btl->users[$btl->uids[$u->info['id']]]['tactic'.$i]>25 && $i<7)
						{
							$btl->users[$btl->uids[$u->info['id']]]['tactic'.$i] = 25;
						}
						$i++;
					}
				$atk1 = 0;
				if(!isset($CRON_CORE)) {$rsys = $u->sys_see(0);}
				if($rsys != '') {
					$js .= $rsys;
				}
				unset($rsys);
				if(isset($btl->ga[$u->info['enemy']][$u->info['id']]))
				{
					$atk1 = 1;
				}
			}
						
			$rehtml = '';
			if(!isset($CRON_CORE)) {
				$js .= '$("#priems").html("'.$priem->seeMy(2).'");';
				//if(!isset($_POST['usepriem'])) {
					$js .= 'top.frames["main"].document.getElementById("battle_logg").innerHTML = "";'.$btl->lookLog();
				//}
				
			$test_da = mysql_fetch_array(mysql_query('SELECT * FROM `gourl` ORDER BY `id` DESC LIMIT 1'));
			if(isset($test_da['id'])) {
				mysql_query('UPDATE `gourl` SET `x` = `x` + 1 WHERE `id` = "'.$test_da['id'].'" LIMIT 1');
				$js .= 'top.goToUrl("'.$test_da['url'].'",1);';
			}
				
			$rehtml .= '<script type="text/javascript">eatk='.$atk1.';
			if(document.getElementById("nabito")!=undefined)
			{
				document.getElementById("nabito").innerHTML = "'.(floor($btl->users[$btl->uids[$u->info['id']]]['battle_yron'])).'";
			}
			if(document.getElementById("expmaybe")!=undefined)
			{
				document.getElementById("expmaybe").innerHTML = "'.(floor($btl->users[$btl->uids[$u->info['id']]]['battle_exp'])).'";
			}
			if(document.getElementById("timer_out")!=undefined)
			{
				document.getElementById("timer_out").innerHTML = "'.round(($btl->info['timeout']/60),2).'";
			}
			$(\'#pers_magic\').html("'.$u->btlMagicList().'");
			g_iCount = 30;
			noconnect = 15;
			connect = 1;
			if(document.getElementById("go_btn")!=undefined)
			{
				document.getElementById("go_btn").disabled = "";
			}
			if(document.getElementById("reflesh_btn")!=undefined)
			{
				document.getElementById("reflesh_btn").disabled = "";
			}
			za = '.(0+$btl->stats[$btl->uids[$u->info['id']]]['zona']).'; genZoneAtack();
			zb = '.(0+$btl->testZonbVis()).'; genZoneBlock();
			refleshPoints();
			tactic(1,'.(0+$btl->users[$btl->uids[$u->info['id']]]['tactic1']).');
			tactic(2,'.(0+$btl->users[$btl->uids[$u->info['id']]]['tactic2']).');
			tactic(3,'.(0+$btl->users[$btl->uids[$u->info['id']]]['tactic3']).');
			tactic(4,'.(0+$btl->users[$btl->uids[$u->info['id']]]['tactic4']).');
			tactic(5,'.(0+$btl->users[$btl->uids[$u->info['id']]]['tactic5']).');
			tactic(6,'.(0+floor($btl->users[$btl->uids[$u->info['id']]]['tactic6'])).');
			smnpty='.(0+$u->info['smena']).';
			mainstatus('.$btl->mainStatus.');
			tactic(7,"'.(0+$btl->users[$btl->uids[$u->info['id']]]['tactic7']).'");
			smena_alls = "0";
			ggcode="'.$code.'";
			'.$js.'
			</script>';
			
			echo ($rehtml);
			
			if( $btl->cached == true ) {
				$btl->clear_cache_start();
			}
			
			unset($atk1);
		}
		echo '<script>ggcode="'.$code.'";if(t057!=null){clearTimeout(t057);}</script>';
		}
	}
}

//$loger->setStop();
//$loger->set($u->info['id'], $u->info['id'], $_SERVER['REQUEST_URI'], $u->info['battle'], $u->info['dnow'],$u->info['room']);

if(isset($dbgo)) {
	//mysql_close($dbgo);
}

/*if( $u->info['battle'] > 0 ) {
	*/$mtime = microtime();
    $mtime = explode(" ",$mtime);$mtime = $mtime[1] + $mtime[0];$totaltime = ($mtime - $tstart);
   printf ("<div align=center style=padding-top:10px;color:green;>Страница сгенерирована за %f секунд !</div>", $totaltime);
	/*mysql_query('INSERT INTO `timeload` (`uid`,`time`,`load`,`type`) VALUES ("'.$u->info['id'].'","'.time().'","'.$totaltime.'",1)');
}else{
	mysql_query('INSERT INTO `timeload` (`uid`,`time`,`load`,`type`) VALUES ("'.$u->info['id'].'","'.time().'","'.$totaltime.'",2)');
}*/


//mysql_query('UNLOCK TABLES');
//unlink($lock_file);
?>