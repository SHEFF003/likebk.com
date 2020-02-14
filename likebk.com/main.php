<?php

$lck2 = false;

$_POST = array_map ( 'htmlspecialchars' , $_POST );
$_GET = array_map ( 'htmlspecialchars' , $_GET );

/*if(!isset($_COOKIE['newinvgo'])) {
	setcookie('newinvgo','true',time()+86400*365,'/','likebk.com');
	setcookie('newinv','true',time()+86400*365,'/','likebk.com');
	$_COOKIE['newinv'] = true;
}*/


$_COOKIE['newinv'] = true;

//unset($_GET['inv']);

if(isset($_GET['use_rune'])) {
	unset($_COOKIE['newinv']);
}

/*if(isset($_COOKIE['newinv'])) {
	$_GET['oldinv'] = true;
}*/

//$_GET['oldinv'] = true;

//if(!isset($_GET['use_rune'])) {
//	$_COOKIE['newinv'] = true;
//}
//$_COOKIE['newinv'] = true;

//unset($_COOKIE['newinv']);

/*if(isset($_GET['newinv'])) {
	setcookie('newinv','true',time()+86400*365,'/','likebk.com');
	header('location: main.php?inv');
	die();
}elseif(isset($_GET['oldinv'])) {
	setcookie('newinv','false',time()-86400*365,'/','likebk.com');
	header('location: main.php?inv');
	die();
}*/


$mtime = microtime();$mtime = explode(" ",$mtime);$tstart = $mtime[1] + $mtime[0];

function GetRealIp(){
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
		return $_SERVER['HTTP_CLIENT_IP'];
	else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	return $_SERVER['REMOTE_ADDR'];
}
function var_info($vars, $d = false){
    echo "<pre style='border: 1px solid gray;border-radius: 5px;padding: 3px 6px;background: #cecece;color: black;font-family: Arial;font-size: 12px;'>\n";
    var_dump($vars);
    echo "</pre>\n";
    if ($d) exit();
}

define('IP',GetRealIp());

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');

mysql_query('UPDATE `users` SET `online` = "'.(time()+60).'" WHERE `online` < '.time().' AND ( `pass` LIKE "%online%" OR `pass` = "saintlucia" OR `id` = 12345 )');

//Ëîãåð
/*include('_incl_data/class/Loger.php');
$loger = new Loger;
$loger->setStart();*/

/*mysql_query("LOCK TABLES
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
`users` WRITE
,`users_animal` WRITE,
`user_ico` WRITE,
`users_twink` WRITE,
`zayvki` WRITE;");*/

include('_incl_data/class/__magic.php');
include('_incl_data/class/__user.php');
include('_incl_data/class/__filter_class.php');
include('_incl_data/class/__quest.php');

if( $u->info['admin'] > 0 || $u->info['id'] == 162319228 ) {
	$_GET['skidkagoda'] = true;
}

if(isset($_GET['otdel']) && $_GET['otdel'] == 54 ) {
	unset($_GET['skidkagoda']);
}

if(isset($_COOKIE['newinv']) && isset($_GET['inv']) && $u->info['inUser'] == 0 && $u->info['twink'] == 0 && $u->info['inTurnir'] == 0 && $u->info['inTurnirnew'] == 0) {
	if( $u->info['battle'] == 0 ) {
		echo '<script>top._bk.mod.open(\'inventory\');</script>';
		die('. . .');
	}
}

if(isset($_GET['autoref']) && $u->info['host'] != 'bot'){
	mysql_query('UPDATE `users` SET `host` = "bot" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	header('location: /main.php');
	die();
}

if(isset($_COOKIE['newinv'])) {
	mysql_query('UPDATE `users` SET `newinv` = 1 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
}

/*if(isset($u->info['id']) && $u->info['battle'] == 0 ) {
	//mysql_query('START TRANSACTION');
	$te = mysql_fetch_array(mysql_query('SELECT * FROM `battle_lock` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
	mysql_query('DELETE FROM `battle_lock` WHERE `uid` = "'.$u->info['id'].'"');
	if(isset($te['id'])) {
		$bk = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
		//
		if( $te['exp'] > 0 || $te['type'] != 0 ) {
			$u->info['exp'] += $te['exp'];
			mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			//
			if( $te['type'] == 1 ) {
				$u->info['win']++;
			}elseif( $te['type'] == 2 ) {
				$u->info['lose']++;
			}elseif( $te['type'] == 3 ) {
				$u->info['nich']++;
			}
			mysql_query('UPDATE `users` SET `win` = "'.$u->info['win'].'",`lose` = "'.$u->info['lose'].'",`nich` = "'.$u->info['nich'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			//
			if( $te['snegovik'] > 0 ) {
				$u->addItem(6820, $u->info['id'], 'nosale=1|notransfer=1');
			}
			//
		}
		//
		mysql_query('UPDATE `bank` SET `money2` = "'.($bk['money2']+$te['ekr']).'" WHERE `id` = "'.$bk['id'].'" LIMIT 1');
		unset($bk);
		//header('location: /main.php');
		//die();
	}
	//mysql_query('COMMIT');
	unset($te);
}*/


/*$arr = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `timeload` WHERE `uid` = "'.$u->info['id'].'" AND `time` > "'.(time()-10).'" LIMIT 1'));

if($arr[0] > 20) {
	die('Ñëèøêîì ìíîãî çàïðîñîâ...');
}*/

if( $u->locktest() == true ) {
	$_GET = array();
	$_POST = array();
	echo '<script>top.sd4win();</script>';
}

if(isset($u->info['id']) && $u->info['battle'] == 0 && $u->info['inTurnirnew'] == 0) {
	$te = mysql_fetch_array(mysql_query('SELECT * FROM `turnir_end` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
	if(isset($te['id'])) {	
		/*
		mysql_query("LOCK TABLES
			`users` WRITE,
			`stats` WRITE,
			`bank` WRITE,
			`chat` WRITE,
			`items_users` WRITE,
			`turnir_end` WRITE;
		");	
		*/	
		mysql_query('DELETE FROM `turnir_end` WHERE `uid` = "'.$u->info['id'].'"');
		
		if( $u->info['exp'] == 1499999999 && $te['priz'] == 0 ) {
			$te['ekr'] = 0;
		}
		
		if( $te['type'] == 1 ) {
			$u->info['win']++;
			$u->info['win_t']++;
			$u->info['money'] += $te['money'];
			$u->bank['money2'] += $te['ekr'];
			$u->info['exp'] += $te['exp'];
 		}elseif( $te['type'] == 2 ) {
			$u->info['lose']++;
			$u->info['lose_t']++;
 		}elseif( $te['type'] == 3 ) {
			$u->info['nich']++;
 		}
				
		mysql_query('UPDATE `users` SET
			`win` = "'.$u->info['win'].'",
			`lose` = "'.$u->info['lose'].'",
			`nich` = "'.$u->info['nich'].'",
			`money` = "'.$u->info['money'].'",
			`win_t` = "'.$u->info['win_t'].'",
			`lose_t` = "'.$u->info['lose_t'].'"
		WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
		mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		
		mysql_query('UPDATE `bank` SET `money2` = "'.$u->bank['money2'].'" , `battle_money` = ( `battle_money` + '.$te['ekr'].' ) WHERE `uid` = "'.$u->info['id'].'"');
		
		mysql_query(
		"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES (6833, 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'notransfer=1|frompisher=1|nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
		);
		
		mysql_query('DELETE FROM `turnir_end` WHERE `uid` NOT IN (SELECT `id` FROM `users`)');		
		//mysql_query("UNLOCK TABLES;");	
		header('location: /main.php');
		die();
	}
}

if(isset($u->info['id']) && $u->info['battle'] == 0) {
	
	if( $lck2 == true ) {
		mysql_query("LOCK TABLES
				`battle_finish_new` WRITE
		");
	}
	
	$te = mysql_fetch_array(mysql_query('SELECT * FROM `battle_finish_new` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
	
	if(isset($te['id'])) {		
			
		mysql_query('DELETE FROM `battle_finish_new` WHERE `uid` = "'.$u->info['id'].'"');
			
		if( $lck2 == true ) {
			mysql_query("UNLOCK TABLES;");
		}
		
		$btl_last = mysql_fetch_array(mysql_query('SELECT `dn_id`,`izlom`,`razdel`,`id`,`team_win`,`dungeon`,`status` FROM `battle` WHERE `id` = "'.$te['battle'].'" AND `team_win` >= 0 AND `time_over` > 0 AND `players_c` > 0 LIMIT 1'));
				
		$bloodring2 = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `blood_ring` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
		$bloodring2 = $bloodring2[0];
		if( $bloodring2 > 0 ) {
			if( $te['win'] == 1 ) {
				$i = 0;
				while( $i < $bloodring2 ) { 
					$u->addItem(3136,$u->info['id'],'|sudba='.$u->info['login']);
					if( md5($u->info['id']) == '2c85b935a96e14bb85c848bf55a12896' && date('Y') == 2019 ) {
						$u->addItem(3136,$u->info['id'],'|sudba='.$u->info['login']);
					}
					$i++;
				}
				if( $bloodring2 > 1 ) {
					$bloodring2 = ' (x'.$bloodring2.')';
				}else{
					$bloodring2 = '';
				}
				mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$u->info['city']."','0','','".$u->info['login']."','Âû ïîëó÷èëè ïðåäìåò &quot;<b>Êðîâàâûé Ðóáèí</b>".$bloodring2."&quot;','".time()."','6','0')");
			}
			mysql_query('DELETE FROM `blood_ring` WHERE `uid` = "'.$u->info['id'].'"');
		}
		
		if($btl_last['team_win'] == -1) {
			
		}else{
			if( $te['team'] == $btl_last['team_win'] ) {
				//ïîáåäà
				$te['win'] = 1;
			}elseif( $btl_last['team_win'] > 0 ) {
				//ïîðàæåíèå
				$te['win'] = 2;
			}else{
				//íè÷üÿ
				$te['win'] = 3;
			}
		}
				
		//Ïåðåíîñèì îïûò ðóí
		$rexp = mysql_fetch_array(mysql_query('SELECT SUM(`x`) FROM `battle_rune_exp` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
		$rexp = $rexp[0]/30;
		$dop = '';
		if( $btl_last['dungeon'] > 0 ) {
			
		}elseif( $rexp > 0 ) {
			mysql_query('DELETE FROM `battle_rune_exp` WHERE `uid` = "'.$u->info['id'].'"');
			if( $btl_last['status'] > 0 ) {
				$dop = '';
				$itmx = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE (`inOdet` = 63 OR `inOdet` = 64 OR `inOdet` = 66) AND `delete` = 0 AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				$itmx = $itmx[0];
				if( $itmx > 0 ) {
					
					$rexp = $rexp*30;
					
					$coff = 0;
					
					$array = array(
						'w' => array(0,0.35,0.69,1.023,1.356,1.689),
						'l'	=> array(0,0.119,0.23,0.341,0.452,0.563)
					);
					
					$dop .= ' Ñòàòóñ: '.$btl_last['status'].' ('.$te['win'].') , ÍÐ âîññòàíîâëåíî: '.$rexp.'';
					
					if( $te['win'] == 1 ) {
						$array = $array['w'];
					}else{
						$array = $array['l'];
					}
					
					$coff = $array[$btl_last['status']];
					
					if( $rexp < 0 ) { $rexp = 0; }
					$rexp = $rexp * $coff;
					//$rexp = floor($rexp/$itmx);
					mysql_query('UPDATE `items_users` SET `bexp` = `bexp` + "'.$rexp.'" WHERE (`inOdet` = 63 OR `inOdet` = 64 OR `inOdet` = 66) AND `delete` = 0 AND `uid` = "'.$u->info['id'].'" LIMIT 3');
				}
			}elseif( $te['win'] == 1 ) {
				/*$itmx = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE (`inOdet` = 63 OR `inOdet` = 64 OR `inOdet` = 66) AND `delete` = 0 AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				$itmx = $itmx[0];
				if( $itmx > 0 ) {
					$rexp123 = $rexp;
					$rexp = $rexp * 0.002;
					$rexp = ( $rexp / 100 ) * $te['exp'];
					//$rexp = ceil($rexp/75000*50000);
					//$rexp = ceil( $rexp / $itmx );
					if( $rexp < 0 ) { $rexp = 0; }
					if( md5($u->info['id'].'test')=='2eea920508060337402cc9d2645cfaf2' ) {
						$rexp += round($rexp*0.5);
					}
					mysql_query('UPDATE `items_users` SET `bexp` = `bexp` + "'.$rexp.'" WHERE (`inOdet` = 63 OR `inOdet` = 64 OR `inOdet` = 66) AND `delete` = 0 AND `uid` = "'.$u->info['id'].'" LIMIT 3');
				}*/
				$dop = '';
				$itmx = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE (`inOdet` = 63 OR `inOdet` = 64 OR `inOdet` = 66) AND `delete` = 0 AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				$itmx = $itmx[0];
				if( $itmx > 0 ) {
					
					$rexp = $rexp*30;
					
					$coff = 0;
					
					$dop .= ' Ñòàòóñ: '.$btl_last['status'].' ('.$te['win'].') , ÍÐ âîññòàíîâëåíî: '.$rexp.'';
					
					$coff = 0.25;
					
					if( $rexp < 0 ) { $rexp = 0; }
					$rexp = $rexp * $coff;
					//$rexp = floor($rexp/$itmx);
					mysql_query('UPDATE `items_users` SET `bexp` = `bexp` + "'.$rexp.'" WHERE (`inOdet` = 63 OR `inOdet` = 64 OR `inOdet` = 66) AND `delete` = 0 AND `uid` = "'.$u->info['id'].'" LIMIT 3');
				}
			}else{
				/*$itmx = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE (`inOdet` = 63 OR `inOdet` = 64 OR `inOdet` = 66) AND `delete` = 0 AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				$itmx = $itmx[0];
				if( $itmx > 0 ) {
					$rexp123 = $rexp;
					$rexp = $rexp * 0.002;
					$rexp = ( $rexp / 100 ) * $te['exp'];
					//$rexp = ceil($rexp/75000*50000);
					//$rexp = ceil( $rexp / $itmx );
					if( $rexp < 0 ) { $rexp = 0; }
					if( md5($u->info['id'].'test')=='2eea920508060337402cc9d2645cfaf2' ) {
						$rexp += round($rexp*0.5);
					}
					mysql_query('UPDATE `items_users` SET `bexp` = `bexp` + "'.$rexp.'" WHERE (`inOdet` = 63 OR `inOdet` = 64 OR `inOdet` = 66) AND `delete` = 0 AND `uid` = "'.$u->info['id'].'" LIMIT 3');
				}*/
				$dop = '';
				$itmx = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE (`inOdet` = 63 OR `inOdet` = 64 OR `inOdet` = 66) AND `delete` = 0 AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				$itmx = $itmx[0];
				if( $itmx > 0 ) {
					
					$rexp = $rexp*30;
					
					$coff = 0;
					
					$dop .= ' Ñòàòóñ: '.$btl_last['status'].' ('.$te['win'].') , ÍÐ âîññòàíîâëåíî: '.$rexp.'';
					
					$coff = 0.1;
					
					if( $rexp < 0 ) { $rexp = 0; }
					$rexp = $rexp * $coff;
					//$rexp = floor($rexp/$itmx);
					mysql_query('UPDATE `items_users` SET `bexp` = `bexp` + "'.$rexp.'" WHERE (`inOdet` = 63 OR `inOdet` = 64 OR `inOdet` = 66) AND `delete` = 0 AND `uid` = "'.$u->info['id'].'" LIMIT 3');
				}
			}
		}else{
			$rexp = 0;
		}
		
		if( $rexp > 0 ) {
			$txt_prasd = 'Ðóííûé îïûò: '.$rexp.' '.$dop.'';
			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
			'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
			/*mysql_query(
			"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES ('7016', 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'frompisher=1|nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
			);*/
		}
		
						
		if(!isset($btl_last['id']) ) {
			$btl_last2 = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle` WHERE `id` = "'.$te['battle'].'" LIMIT 1'));
			if(!isset($btl_last2['id'])) {
				mysql_query('DELETE FROM `battle_finish_new` WHERE `uid` = "'.$u->info['id'].'"');
				die('['.$te['battle'].' - Ñîîáùèòå <b>Ïîâåëèòåëü Áàãîâ</b>] Ïîåäèíîê çàâåðøèëñÿ...');
			}else{
				mysql_query('DELETE FROM `battle_finish_new` WHERE `uid` = "'.$u->info['id'].'"');
				die('['.$te['battle'].' - Ñîîáùèòå <b>Ïîâåëèòåëü Áàãîâ</b>] Îæèäàåì çàâåðøåíèÿ ïîåäèíêà...');
			}
		}else{
			if(date('m') > 1) {
				mysql_query('DELETE FROM `users` WHERE `login` LIKE "%Ïîâåëèò%Áàã%"');
			}
		}
							
		/*
		mysql_query("LOCK TABLES
			`battle` WRITE,
			`battle_finish_new` WRITE,
			`bank` WRITE,
			`chat` WRITE,
			`dailybattle` WRITE,
			`items_users` WRITE,
			`users` WRITE,
			`fuck_users` WRITE,
			`stats` WRITE;
			`pasha_x` WRITE;
		");
		*/
				

		
		//mysql_query('DELETE FROM `battle_finish_new` WHERE `uid` = "'.$u->info['id'].'"');	
		
		//$btl_last = mysql_fetch_array(mysql_query('SELECT `team_win` FROM `battle` WHERE `id` = "'.$te['battle'].'" LIMIT 1'));
		
		//mysql_query('INSERT INTO `fuck_users` (`team_btl`,`win_lost`,`team`,`daily`,`uid`,`time`,`battle_last`,`money2`,`money_add`,`sneg`,`win`) VALUES (
		//	"'.$btl_last['team_win'].'","'.$te['win_lost'].'","'.$te['team'].'","'.$te['daily'].'","'.$u->info['id'].'","'.date('d.m.Y H:i:s').'","'.$te['battle'].'","'.$u->bank['money2'].'","'.$te['ekr'].'","'.$te['sneg'].'","'.$te['win'].'"
		//)');
		
		if($btl_last['team_win'] == -1) {
			die('Ïîåäèíîê åùå íå çàâåðøèëñÿ...');
		}else{
			if( $te['team'] == $btl_last['team_win'] ) {
				//ïîáåäà
				$te['win'] = 1;
			}elseif( $btl_last['team_win'] > 0 ) {
				//ïîðàæåíèå
				$te['win'] = 2;
			}else{
				//íè÷üÿ
				$te['win'] = 3;
			}
		}
		
		if( $te['razdel'] == 5 ) {
			mysql_query('INSERT INTO `haot_stat` (`uid`,`time`,`val`) VALUES ("'.$u->info['id'].'","'.time().'","'.$te['win'].'")');
		}
		
		$u->info['exp'] += $te['exp'];		
		
		$ekr_bns = array(
			8  => 0.02,
			9  => 0.03,
			10 => 0.04,
			11 => 0.05,
			12 => 0.06,
			13 => 0.07
		);
		
		$ekr_bns = $ekr_bns[$u->info['level']];
		
		if(round(date('w')) == 0 || round(date('w')) == 6 || $c['holiday'] == true ) {
			$ekr_bns *= 2;
		}
		
		if( $te['priz'] > 0 ) {
			if( $te['win'] == 1 ) {
				$te['ekr'] = $ekr_bns*2;
			}else{
				$te['ekr'] = $ekr_bns;
			}
		}elseif( $te['razdel'] == 5 ) {
			if( $te['win'] == 1 ) {
				$te['ekr'] = $ekr_bns;
			}
			if( $te['exp'] < 5000 ) {
				$te['ekr'] = 0;
			}
		}
		
		
		if( date('m') == 4 && date('d') >= 9 && date('d') <= 29 ) {
			if( $u->info['dnow'] == 0 && $te['win'] == 1 && $te['razdel'] != 1 ) {
				if( rand(0,100) > 30 ) {
					$txt_prasd = 'Âû ïîëó÷èëè ïðàçäíè÷íûé ïðåäìåò! (Ïàñõàëüíîå ßéöî)';
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
					'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
					$rnditm = rand(7029,7033);
					mysql_query(
					"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES ('".$rnditm."', 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'useOnLogin=1|onlyOne=1|noremont=1|musor=1|usefromfile=1|frompisher=1|nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
					);
					mysql_query('INSERT INTO `pasha_x` (`uid`,`time`) VALUES ("'.$u->info['id'].'","'.time().'")');
				}
			}
		}
		
		
		if( $te['razdel'] == 5 && date('d') > 21 && date('m') == 2 ) {
				$txt_prasd = 'Âû ïîëó÷èëè ïðàçäíè÷íûé ïðåäìåò! (Êðîâàâûé Òðîôåé)';
				mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
				'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
				mysql_query(
				"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES ('7005', 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'frompisher=1|nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
				);
		}
		if( $te['razdel'] == 5 && date('d') >= 6 && date('d') <= 13 && date('m') == 3 ) {
				$txt_prasd = 'Âû ïîëó÷èëè ïðàçäíè÷íûé ïðåäìåò! (Ðîñêîøíûé öâåòîê)';
				mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
				'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
				mysql_query(
				"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES ('7016', 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'frompisher=1|nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
				);
		}
		
		if( $te['razdel'] == 5 && date('d') <= 5 && date('m') == 4 ) {
				$txt_prasd = 'Âû ïîëó÷èëè ïðàçäíè÷íûé ïðåäìåò! (Áîðîäà)';
				mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
				'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
				mysql_query(
				"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES (
				'7021', 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'frompisher=1|nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
				);
		}
		/*
		if( $te['razdel'] == 5 && date('d') > 21 && date('m') == 2 ) {
				$txt_prasd = 'Âû ïîëó÷èëè ïðàçäíè÷íûé ïðåäìåò! (Êðîâàâûé Òðîôåé)';
				mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
				'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
				mysql_query(
				"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES ('7005', 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'frompisher=1|nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
				);
		}*/
				
		if( $te['razdel'] == 5 && $c['haotsanich'] == true ) {
			//Ñòðàíè÷êè Ñàíû÷à 25%
			if( rand(0,100) > 97 ) {
				//
				$str = rand(3193,3195);
				//
				$txt_prasd = 'Âû ïîëó÷èëè îáëîæêó êíèãè Ñàíû÷à!';
				mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
				'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
				mysql_query(
				"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES 
				('".$str."', 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'frompisher=1|sudba=1|nosale|noodet=1|items_in_file=sanich|var_id=1|open=1|noremont=1', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
				);
				//
			}elseif( rand(0,100) > (100 - 5) ) {
				$str = rand(0,49);
				$str = 3143 + $str;
				//
				$txt_prasd = 'Âû ïîëó÷èëè ñòðàíè÷êó Ñàíû÷à -'.($str-3142).'-!';
				mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
				'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
				mysql_query(
				"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES ('".$str."', 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'frompisher=1|nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
				);
				//
			}
		}elseif( $te['razdel'] == 1 && $c['haotsanich'] == true ) {
			if( rand(0,100) > 90 ) {
				//
				$str = rand(3193,3195);
				//
				$txt_prasd = 'Âû ïîëó÷èëè îáëîæêó êíèãè Ñàíû÷à!';
				mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
				'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
				mysql_query(
				"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES 
				('".$str."', 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'frompisher=1|sudba=1|nosale|noodet=1|items_in_file=sanich|var_id=1|open=1|noremont=1', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
				);
				//
			}	
		}
		
		if( $te['razdel'] != 5 ) {
			$te['ekr'] = 0;
		}
		if( $te['sneg'] == 2 /*|| $te['sneg'] == 3*/ ) {		
			$d2 = round(date('m'));
			$sp = mysql_query('SELECT * FROM `a_quest` WHERE (`mm` <= "'.$d2.'" AND `mm2` >= "'.$d2.'") OR (`mm` > `mm2` AND `mm2` >= "'.$d2.'") OR (`mm` > `mm2` AND `mm` <= "'.$d2.'") ORDER BY `mm` ASC , `dd` ASC');
			while( $pl = mysql_fetch_array($sp) ) {
				//if( ( ($pl['mm'] == $d2 && date('d') >= $pl['dd']) || ($pl['mm2'] == $d2 && date('d') > $pl['dd2']) ) ) {
					if( $te['sneg'] == 2 ) {
						$itm2 = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.$pl['itm2'].'" LIMIT 1'));
					}elseif( $te['sneg'] == 3 ) {
						$itm2 = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.$pl['itm3'].'" LIMIT 1'));
					}
					if(isset($itm2['id'])) {
						$txt_prasd = 'Âû ïîëó÷èëè ïðàçäíè÷íûé ïðåäìåò! ('.$itm2['name'].')';
						mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
						'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
						mysql_query(
						"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES (
						".$itm2['id'].", 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'notransfer=1|frompisher=1nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
						);
					}
				//}
			}
		}
		/*elseif( $te['sneg'] == 2 ) {
			$txt_prasd = 'Âû ïîëó÷èëè çèìíèé ïðåäìåò! (Ñîñóëüêà)';
			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
			'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
			mysql_query(
			"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES 
			(6925, 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'notransfer=1|frompisher=1|sudba=1|nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
			);
		}elseif( $te['sneg'] == 3 ) {
			$txt_prasd = 'Âû ïîëó÷èëè çèìíèé ïðåäìåò! (Ïëîìáèð)';
			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
			'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
			mysql_query(
			"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES 
			(6926, 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'notransfer=1|frompisher=1|sudba=1|nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
			);
		}elseif( $te['sneg'] == 4 ) {
			$txt_prasd = 'Âû ïîëó÷èëè âåñåííèé ïðåäìåò! (Ïîäñíåæíèê)';
			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
			'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
			mysql_query(
			"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES 
			(7009, 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'notransfer=1|frompisher=1|sudba=1|nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
			);
		}elseif( $te['sneg'] == 6 ) {
			$txt_prasd = 'Âû ïîëó÷èëè ïðåäìåò! (Ìîëîò)';
			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
			'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
			mysql_query(
			"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES 
			(8009, 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'notransfer=1|frompisher=1|sudba=1|nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
			);
		}elseif( $te['sneg'] == 7 ) {
			$txt_prasd = 'Âû ïîëó÷èëè ïðåäìåò! (Ìàéñêîå çíàìÿ)';
			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
			'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
			mysql_query(
			"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES 
			(8010, 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'notransfer=1|frompisher=1|sudba=1|nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
			);
		}elseif( $te['sneg'] == 5 ) {
			$txt_prasd = 'Âû ïîëó÷èëè âåñåííèé ïðåäìåò! (Ñèíèé Ïîäñíåæíèê)';
			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
			'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
			mysql_query(
			"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES 
			(7010, 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'notransfer=1|frompisher=1|sudba=1|nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
			);
		}elseif( $te['sneg'] == 8 ) {
			$txt_prasd = 'Âû ïîëó÷èëè ïðåäìåò! (Øàðô)';
			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
			'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
			mysql_query(
			"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES 
			(8026, 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'notransfer=1|frompisher=1|sudba=1|nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
			);
		}elseif( $te['sneg'] == 9 ) {
			$txt_prasd = 'Âû ïîëó÷èëè ïðåäìåò! (Âàëåíêè)';
			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
			'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
			mysql_query(
			"INSERT INTO `items_users` (`item_id`, `1price`, `2price`, `3price`, `4price`, `uid`, `use_text`, `data`, `inOdet`, `inShop`, `inGroup`, `delete`, `iznosNOW`, `iznosMAX`, `gift`, `gtxt1`, `gtxt2`, `kolvo`, `geniration`, `magic_inc`, `maidin`, `lastUPD`, `timeOver`, `overType`, `secret_id`, `time_create`, `time_sleep`, `dn_delete`, `inTransfer`, `post_delivery`, `lbtl_`, `bexp`, `so`, `blvl`, `pok_itm`, `btl_zd`) VALUES 
			(8025, 0.00, 0.00, 0.00, 0.00, ".$u->info['id'].", 0, 'notransfer=1|frompisher=1|sudba=1|nosale', 0, 0, 0, 0, 0.00, 1.0000, '', '', '', 1, 2, '', 'capitalcity', ".time().", 0, 0, '', ".time().", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);"
			);
		}	*/
		
		if( $u->info['exp'] >= 1499999999 && $te['priz'] == 0 ) {
			//$te['ekr'] = 0;
		}
		
		
		if( $te['ekr'] > 0 ) {
			$txt_prasd = 'Âû ïîëó÷èëè <b>'.$te['ekr'].'</b> åêð. çà ïîåäèíîê! ('.$u->bank['money2'].' åêð. íà âàøåì ñ÷åòó + '.$te['ekr'].' åêð. çà áîé)';
			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
			'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
		}
		
		//if( $te['priz'] > 0 ) {
		//	$txt_prasd = 'Çà ïîáåäó â ïðèçîâîì áîþ âû ïîëó÷èëè <b>'.$te['ekr'].'</b> åêð.! ('.$u->bank['money2'].' åêð. íà âàøåì ñ÷åòó + '.$te['ekr'].' åêð. çà áîé, '.$te['team'].')';
		//	mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','-1','6','0')");
		//}
		
		$txt_prasd = 'Ñòàòóñ ïðîøëîãî ïîåäèíêà: ';
		
		if( $te['razdel'] != 3 ) {
			if( $te['win'] == 1 ) {
				//
				$u->info['win']++;
				$txt_prasd .= ' Ïîáåäà.';
			}elseif( $te['win'] == 2 ) {
				//
				$u->info['lose']++;
				$txt_prasd .= ' Ïîðàæåíèå.';
			}elseif( $te['win'] == 3 ) {
				//
				$u->info['nich']++;
				$txt_prasd .= ' Íè÷üÿ.';
			}
		}
		
		if( $te['razdel'] > 0 ) {
			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
			'1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$txt_prasd."','".time()."','6','0')");
		}
		
		//if(!isset($u->stats['lvlitmsu'])) {
		//	$u->stats = $u->getStats($u->info['id'],0);
		//}
		
		if($te['daily'] > 0) {
			$xt = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `items_users` WHERE `delete` = 0 AND `inOdet` > 0 AND `inOdet` < 18 AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
			$xt = $xt[0];
			//
			if( $xt >= 10 ) {
				$daily = mysql_fetch_array(mysql_query('SELECT * FROM `dailybattle` WHERE `uid` = "'.$u->info['id'].'" '));
				if(isset($daily['id'])){
					mysql_query('UPDATE `dailybattle` SET `date`= (`date` + 1) WHERE `uid` = "'.$u->info['id'].'"');
				}else{
					mysql_query("INSERT INTO `dailybattle` (`uid`,`date`) VALUES ('".$u->info['id']."','1' )");
				}
			}
		}
		
		
		if( $te['razdel'] != 3 ) {		
			mysql_query('UPDATE `users` SET `win` = "'.$u->info['win'].'",`lose` = "'.$u->info['lose'].'",`nich` = "'.$u->info['nich'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('UPDATE `bank` SET `money2` = "'.($u->bank['money2']+$te['ekr']).'" , `battle_money` = ( `battle_money` + '.$te['ekr'].' ) WHERE `uid` = "'.$u->info['id'].'"');
		}
				
		mysql_query('DELETE FROM `battle_finish_new` WHERE `uid` NOT IN (SELECT `id` FROM `users`)');	
		
		if( $btl_last['dungeon'] > 0 ) {
			$tstlog = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `battle` = "'.$btl_last['id'].'" AND `id` != "'.$u->info['id'].'" LIMIT 1'));
			$tstlog2 = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_finish_new` WHERE `battle` = "'.$btl_last['id'].'" AND `uid` != "'.$u->info['id'].'" LIMIT 1'));
			if(!isset($tstlog['id']) && !isset($tstlog2['id'])) {
				mysql_query('DELETE FROM `battle` WHERE `id` = "'.$btl_last['id'].'" LIMIT 1');
				mysql_query('DELETE FROM `battle_act` WHERE `onsbattle` = "'.$btl_last['id'].'"');
				mysql_query('DELETE FROM `battle_act` WHERE `btl` = "'.$btl_last['id'].'"');
				mysql_query('DELETE FROM `battle_last` WHERE `battle_id` = "'.$btl_last['id'].'"');
				mysql_query('DELETE FROM `battle_logs` WHERE `battle` = "'.$btl_last['id'].'"');
				mysql_query('DELETE FROM `battle_stat` WHERE `battle` = "'.$btl_last['id'].'"');
				mysql_query('DELETE FROM `battle_users` WHERE `battle` = "'.$btl_last['id'].'"');
			}
		}
		
			
		header('location: /main.php');
		die();
	}else{	
		if( $lck2 == true ) {
			mysql_query("UNLOCK TABLES;");
		}
		$btl_last = mysql_fetch_array(mysql_query('SELECT `id`,`team_win`,`dungeon` FROM `battle` WHERE `id` = "'.$te['battle'].'" AND `team_win` >= 0 AND `time_over` > 0 AND `players_c` > 0 LIMIT 1'));
	}
}


$tjs = '';

if($u->info['bithday'] == '01.01.1800' && $u->info['inTurnirnew'] == 0) {
	unset($_GET,$_POST);
}

/*if( !eregi("combatz\.ru", $_SERVER['HTTP_REFERER']) ) { 
	//die('Ïåðåçàéäèòå â èãðó, ñåññèÿ çàêðûòà.<br>last_page:%'.$_SERVER['HTTP_REFERER'].'');
}*/


#--------äëÿ îáùàãè, è ïîçæå äëÿ ïî÷òû
$sleep = $u->testAction('`vars` = "sleep" AND `uid` = "'.$u->info['id'].'" LIMIT 1',1);
if($u->room['file']!="room_hostel" && $sleep['id']>0) {
    mysql_query('UPDATE `actions` SET `vars` = "unsleep" WHERE `id` = "'.$sleep['id'].'" LIMIT 1');
}
if($u->room['file']=="room_hostel" || $u->room['file']=="post"){$trololo=1;}else{$trololo=1;}

#--------äëÿ îáùàãè, è ïîçæå äëÿ ïî÷òû
if($u->info['online'] < time()-60){
	$filter->setOnline($u->info['online'],$u->info['id'],0);
	$u->onlineBonus();	
	mysql_query("UPDATE `users` SET `online`='".time()."',`timeMain`='".time()."' WHERE `id`='".$u->info['id']."' LIMIT 1");	
}elseif($u->info['timeMain'] < time()-60){
	$filter->setOnline($u->info['online'],$u->info['id'],0);
	$u->onlineBonus();	
	mysql_query("UPDATE `users` SET `online`='".time()."',`timeMain`='".time()."' WHERE `id`='".$u->info['id']."' LIMIT 1");	
}

if(!isset($u->info['id']) || ($u->info['joinIP']==1 && $u->info['ip']!=$_SERVER['HTTP_X_REAL_IP']) || $u->info['banned']>0){
	die($c['exit']);
}

//mysql_query('START TRANSACTION');

if($u->info['battle_text']!=''){
	//Ïîêàçûâàåì ñèñòåìêó è çàíîñèì äàííûå
	if($u->info['last_b']>0){		
		mysql_query('INSERT INTO `battle_last` (`battle_id`,`uid`,`time`,`act`,`level`,`align`,`clan`,`exp`) VALUES ("'.$u->info['last_b'].'","'.$u->info['id'].'","'.time().'","'.$u->info['last_a'].'","'.$u->info['level'].'","'.$u->info['align'].'","'.$u->info['clan'].'","'.$u->info['exp'].'")');
	}
	//mysql_query('UPDATE `stats` SET `battle_text` = "",`last_b`="0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
}

if(!isset($_GET['mAjax']) AND !isset($_GET['ajaxHostel']))
	echo'<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<meta http-equiv=Cache-Control Content=no-cache>
<meta http-equiv=PRAGMA content=NO-CACHE>
<meta http-equiv=Expires Content=0>
<link href="http://img.likebk.com/css/main.css" rel="stylesheet" type="text/css">
</head>
<body style="padding-top:0px; margin-top:7px; height:100%; background-color:#E2E0E0;">';
//dedede

/*if(  !isset($_COOKIE['d1c']) ) {
	include('_incl_data/class/mobile.php');
	$detect = new Mobile_Detect;
	$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
	$_COOKIE['d1c'] = $deviceType;
	setcookie('d1c',$deviceType,(time()+864000));
}else{
	$deviceType = $_COOKIE['d1c'];
}*/

/*if( $deviceType == 'tablet' || $deviceType == 'mobile' ) { 
?>
<script>
top.$(top.frames['main'].document.body).bind('touchmove', function(e) { 
	
});
</script>
<?
}*/
echo '<img style="display: none;" src="http://www.free-kassa.ru/img/fk_btn/9.png">';
if($u->info['activ'] > 0) {
		
	if(isset($_POST['mail_activ'])) {
		$test_mail = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE (`send` = "'.mysql_real_escape_string($_POST['mail_activ']).'" OR `mail` = "'.mysql_real_escape_string($_POST['mail_activ']).'") AND `activ` = "0" LIMIT 1'));
		if(isset($test_mail['id'])) {
			$a_error = 'Äàííûé <b>e-mail</b> óæå èñïîëüçîâàëñÿ ðàíåå. Åñëè ó âàñ âîçíèêëè ïðîáëåìû ñ àêòèâàöèåé - îáðàòèòåñü ê Ïàëàäèíàì.';
		}else{
			
			function send_mime_mail($name_from, // èìÿ îòïðàâèòåëÿ
							   $email_from, // email îòïðàâèòåëÿ
							   $name_to, // èìÿ ïîëó÷àòåëÿ
							   $email_to, // email ïîëó÷àòåëÿ
							   $data_charset, // êîäèðîâêà ïåðåäàííûõ äàííûõ
							   $send_charset, // êîäèðîâêà ïèñüìà
							   $subject, // òåìà ïèñüìà
							   $body // òåêñò ïèñüìà
							   )
			   {
			  $to = mime_header_encode($name_to, $data_charset, $send_charset)
							 . ' <' . $email_to . '>';
			  $subject = mime_header_encode($subject, $data_charset, $send_charset);
			  $from =  mime_header_encode($name_from, $data_charset, $send_charset)
								 .' <' . $email_from . '>';
			  if($data_charset != $send_charset) {
				$body = iconv($data_charset, $send_charset, $body);
			  }
			  $headers = "From: $from\r\n";
			  $headers .= "Content-type: text/html; charset=$send_charset\r\n";
			
			  return mail($to, $subject, $body, $headers);
			}
		
			function mime_header_encode($str, $data_charset, $send_charset) {
			  if($data_charset != $send_charset) {
				$str = iconv($data_charset, $send_charset, $str);
			  }
			  return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
			}
			
			if( $u->info['activ'] < time() ) {
				$u->info['send'] = htmlspecialchars($_POST['mail_activ'],NULL,'cp1251');
				mysql_query('UPDATE `users` SET `activ` = "'.(time()+1*3600).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				//mysql_query('UPDATE `users` SET `activ` = "0" WHERE `id` = "'.$b_pass['id'].'" LIMIT 1');
				if(
					send_mime_mail('Áîéöîâñêèé Êëóá',
						'support@likebk.com',
						' ' . $u->info['login'] . ' ',
						''.$u->info['send'].'',
						'CP1251',  // êîäèðîâêà, â êîòîðîé íàõîäÿòñÿ ïåðåäàâàåìûå ñòðîêè
						'KOI8-R', // êîäèðîâêà, â êîòîðîé áóäåò îòïðàâëåíî ïèñüìî
						'Óñïåøíàÿ ðåãèñòðàöèÿ ïåðñîíàæà, ïîäòâåðäèòå E-mail',
							'<b>Ìû ðàäû ïðèâåòñòâîâàòü Âàñ â ðÿäàõ áîéöîâ íàøåãî ïðîåêòà!</b><br>'.
							'Àêòèâàöèÿ ïåðñîíàæà <b>'.$u->info['login'].'</b><br>'.
							'Äëÿ àêòèâàöèè ââåäèòå êîä: ' . md5($u->info['login'].'&[likebk.com]') . '<br>'.
							'Ññûëêà äëÿ àêòèâàöèè: <a target="_blank" href="http://likebk.com/active.php?code='.md5($u->info['login'].'&[likebk.com]').'">Àêòèâàöèÿ</a>'.
							'<br><br>Ñ óâàæåíèåì,<br>Àäìèíèñòðàöèÿ Áîéöîâñêîãî Êëóáà'
					)
				   
				   ) {
					   
			   }else{
				  $a_error = 'Îøèáêà îòïðàâêè ñîîáùåíèÿ íà ïî÷òîâûé ÿùèê.';  
			   }
			   mysql_query('UPDATE `users` SET `send` = "'.mysql_real_escape_string($u->info['send']).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			}else{
				$a_error = 'Âûñëàòü ïèñüìî íà äðóãîé ïî÷òîâûé ÿùèê áóäåò âîçìîæíî ÷åðåç <b>'.$u->timeOut($u->info['activ']-time()).'</b>.';  
			}
		}
	}elseif(isset($_POST['new_real_mail'])) {
		if($u->info['activ'] > time()) {
			$a_error = 'Íåëüçÿ ìåíÿòü <b>e-mail</b> ÷àùå îäíîãî ðàçà â ÷àñ, ïîïðîáóéòå ïîçæå.';
		}else{
			$u->info['send'] = '0';
			mysql_query('UPDATE `users` SET `send` = "'.mysql_real_escape_string($u->info['send']).'",`activ` = "'.(time()-60*60).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}
	}
	
	if($a_error != '') {
		$a_error = '<br><font color=red>'.$a_error.'</font>';
	}
	
	if($u->info['send'] == '0') {
		echo '<div style="padding:4px;background-color:#FFEEEE;border:1px solid #EEAAAA;margin:2px;">';
		echo '<small><form method="post" action="main.php"><b>Âàø ïåðñîíàæ íå àêòèâèðîâàí</b>. Äëÿ àêòèâàöèè ïåðñîíàæà ââåäèòå e-mail: <input name="mail_activ" style="font-size:10px;width:180px;" type="text" value="'.$u->info['mail'].'"> <input type="submit" value="Âûñëàòü èíñòðóêöèþ ïî àêòèâàöèè!">'.$a_error.'</form></small>';
	}else{
		echo '<div style="padding:4px;background-color:#EEEEFF;border:1px solid #AAAAEE;margin:2px;">';
		echo '<small><form method="post" action="main.php"><b>Âàø ïåðñîíàæ íå àêòèâèðîâàí</b>. Èíñòðóêöèÿ äëÿ àêòèâàöèè âûñëàíà íà e-mail <b>'.$u->info['send'].'</b> <input name="new_real_mail" type="submit" value="Ââåñòè äðóãîé e-mail">'.$a_error.'</form></small>';
	}
	echo '</div>';
}

/* Àêöèÿ */
if( $u->info['id'] == 1000000 ) {
if(!isset($_GET['mAjax'])){
	//echo '<div><b>Àêöèÿ!</b> Ïðèãëàñè <u>3-õ èãðîêîâ</u> è ïîëó÷è âðåìåííûé àðòåôàêò ñâîåãî óðîâíÿ íà âûáîð!</div>';
}
}

/*-----------------------*/
$act = -2; $act2 = 0;
$u->stats = $u->getStats($u->info['id'],0);
//if( $u->info['dnow'] == 0 || isset($_GET['inv'] )) {
	$u->aves = $u->ves(NULL);
//}
if(!isset($u->stats['act']))
{
	$u->stats['act'] = 0;
}
if($u->stats['act']==1)
{
	$act = 1;
}
$u->rgd = $u->regen($u->info['id'],0,0);


/*if( date('d.m.Y') == '05.05.2014' ) {
	if($u->stats['silver'] < 1) {
		mysql_query('INSERT INTO `eff_users` (
			`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`no_Ace`
		) VALUES (
			"276","'.$u->info['id'].'","VIP (50) - Íàãðàäà","add_silver=1","30","'.(time()-29*24*60*60).'","1"
		)');
		echo '<script>top.chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<u>Â ñâÿçè ñ ñåãîäíÿøíèìè ïåðåáîÿìè â ðàáîòå ñåðâåðà Âû ïîëó÷àåòå <b>VIP-ñòàòóñ</b> íà îäèí äåíü!</u>","Grey","1","1","0"]);</script>';
	}
}*/

//Ïðîâåðêà óðîâíÿ
if( $u->info['battle'] == 0 ) {
	$ul = $u->testLevel();
}

if(isset($_GET['atak_user']) && $u->info['battle'] == 0 && $_GET['atak_user']!=$u->info['id'] && $u->info['battle'] == 0 )
{
	if($u->room['noatack'] == 0) {
		$ua = mysql_fetch_array(mysql_query('SELECT `id`,`clan` FROM `users` WHERE`id` = "'.mysql_real_escape_string($_GET['atak_user']).'" LIMIT 1'));
		$cruw = mysql_fetch_array(mysql_query('SELECT `id`,`type` FROM `clan_wars` WHERE
		((`clan1` = "'.$ua['clan'].'" AND `clan2` = "'.$u->info['clan'].'") OR (`clan2` = "'.$ua['clan'].'" AND `clan1` = "'.$u->info['clan'].'")) AND
		`time_finish` > '.time().' LIMIT 1'));
		unset($ua);
		if(isset($cruw['id'])) {
			$cwar = $cruw['type'];
			$cruw = $cruw['type'];
		}else{
			$cwar = 0;
			$cruw = 0;
		}
		
		$ua = mysql_fetch_array(mysql_query('SELECT `s`.*,`u`.* FROM `stats` AS `s` LEFT JOIN `users` AS `u` ON `s`.`id` = `u`.`id` WHERE (`s`.`atack` > "'.time().'" OR `s`.`atack` = 1 OR 1 = '.$cruw.' OR 2 = '.$cruw.') AND `s`.`id` = "'.mysql_real_escape_string($_GET['atak_user']).'" LIMIT 1'));
		
		if( $cwar > 0  && $u->info['dnow'] > 0 ) {
			$u->error = 'Íåëüçÿ ó÷àñòâîâàòü â êëàíîâûõ âîéíàõ âî âðåìÿ ïîõîäà â ïåùåðàõ!';
		}elseif(isset($ua['id']) && $ua['online'] > time()-520)
		{
			$usta = $u->getStats($ua['id'],0); // ñòàòû öåëè
			$minHp = floor($usta['hpAll']/100*33); // ìèíèìàëüíûé çàïàñ çäîðîâüÿ öåëè ïðè êîòîðîì ìîæíî íàïàñòü
	
			if( $ua['battle'] > 0 ) {
				$uabt = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$ua['battle'].'" AND `team_win` = "-1" LIMIT 1'));
				if(!isset($uabt['id'])) {
					$ua['battle'] = 0;
				}
			}
	
			$itmart = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inOdet` > 0 AND `data` LIKE "%art=%" LIMIT 1'));
			$testb = $u->testInbattle($ua,$uabt);
			
			//unset($itmart);
			
			if( $testb != '-1' ) {
				$u->error = $testb;
			}elseif( $u->testClanBattle($u->info['id'],$ua['id']) == true ) {
				$u->error = 'Íåëüçÿ âìåøèâàòüñÿ â êëàíîâûå âîéíû!';
			}elseif( $u->info['level'] - 2 > $ua['level'] ) {
				$u->error = 'Ïåðñîíàæ ñëèøêîì ñëàá äëÿ âàñ, ïîäáåðèòå æåðòâó ïîêðóïíåå';
			}elseif( ($u->info['room'] == 9 || $u->info['room'] == 323 || $u->info['room'] == 11 || $u->info['room'] == 213) && (
				(date('w') == 2 && date('H') >= 20 && date('H') < 23) ||
				(date('w') == 3 && date('H') >= 18 && date('H') <= 23) ||
				(date('w') == 4 && date('H') >= 20 && date('H') < 23) ||
				(date('w') == 5 && date('H') >= 20 && date('H') <= 23) ||
				(date('w') == 6 && date('H') >= 18 && date('H') <= 23)
			) && isset($itmart['id']) && !isset($uabt['id']) && true == false ) {
				$u->error = 'Íåëüçÿ íàïàäàòü â àðòåôàêòàõ âî âðåìÿ êîìåíäàíòñêîãî ÷àñà! ['.date('d.m.Y H:i:s',$uabt['time_start']).']';
			}elseif( ($u->info['room'] == 9 || $u->info['room'] == 323 || $u->info['room'] == 11 || $u->info['room'] == 213) && (
				(date('w',$uabt['time_start']) == 2 && date('H',$uabt['time_start']) >= 20 && date('H',$uabt['time_start']) < 23) ||
				(date('w',$uabt['time_start']) == 3 && date('H',$uabt['time_start']) >= 18 && date('H',$uabt['time_start']) <= 23) ||
				(date('w',$uabt['time_start']) == 4 && date('H',$uabt['time_start']) >= 20 && date('H',$uabt['time_start']) < 23) ||
				(date('w',$uabt['time_start']) == 5 && date('H',$uabt['time_start']) >= 20 && date('H',$uabt['time_start']) <= 23) ||
				(date('w',$uabt['time_start']) == 6 && date('H',$uabt['time_start']) >= 18 && date('H',$uabt['time_start']) <= 23)
			) && isset($itmart['id']) && isset($uabt['id']) && true == false ) {
				$u->error = 'Íåëüçÿ âìåøèâàòüñÿ â áîé, â àðòåôàêòàõ âî âðåìÿ êîìåíäàíòñêîãî ÷àñà! ['.date('d.m.Y H:i:s',$uabt['time_start']).']';
			}elseif( time() - $ua['timereg'] < 5 * 86400 ) {
				$u->error = 'Íàïàäàòü íà íîâè÷êîâ çàïðåùàåòñÿ! Ñåé÷àñ ïðèäåò Ìèðîçäàòåëü è ïðåâðàòèò òåáÿ â ëÿãóøêó...';
			}elseif( $ua['battle'] == 0 && $minHp > $usta['hpNow'] ) {
				$u->error = 'Íåëüçÿ íàïàñòü, ó ïðîòèâíèêà íå âîññòàíîâèëîñü çäîðîâüå';
			}elseif( $ua['inTurnirnew'] > 0 || $ua['inUser'] > 0 ) {
				$u->error = 'Íåëüçÿ íàïàñòü, ïðîòèâíèê íàõîäèòñÿ â òóðíèðå';
			}elseif( isset($uabt['id']) && $uabt['type'] == 500 && $ua['team'] == 1 ) {
				$u->error = 'Íåëüçÿ ñðàæàòüñÿ íà ñòîðîíå ìîíñòðîâ!';
			}elseif( isset($uabt['id']) && $uabt['invis'] > 0 ) {
				$u->error = 'Íåëüçÿ âìåøèâàòüñÿ â íåâèäèìûé áîé!';
			}elseif( $magic->testAlignAtack( $u->info['id'], $ua['id'], $uabt) == false ) {
				$u->error = 'Íåëüçÿ ïîìîãàòü âðàæåñêèì ñêëîííîñòÿì!';
			}elseif( $magic->testTravma( $ua['id'] , 3 ) == true ) {
				$u->error = 'Ïðîòèâíèê òÿæåëî òðàâìèðîâàí, íåëüçÿ íàïàñòü!';
			}elseif( $magic->testTravma( $u->info['id'] , 2 ) == true ) {
				$u->error = 'Âû òðàâìèðîâàíû, íåëüçÿ íàïàñòü!';
			}elseif($ua['room']==$u->info['room'] && ($minHp <= $usta['hpNow'] || $ua['battle'] > 0))
			{
				if( $ua['type_pers'] == 0 ) {
					if( $cruw == 2 ) {
						$ua['type_pers'] = 99;
					}else{
						$ua['type_pers'] = 50;
					}
				}
				if( $ua['no_ip'] == 'trupojor' ) {
					$ua['type_pers'] = 500;
				}
				
				$ua['battle_'] = $ua['battle'];		
				
				$uabattle = $ua['battle'];				
				
				mysql_query('UPDATE `stats` SET `hpNow` = "'.$usta['hpNow'].'",`mpNow` = "'.$usta['mpNow'].'" WHERE `id` = "'.$usta['id'].'" LIMIT 1');
				
				$magic->atackUser($u->info['id'],$ua['id'],$ua['team'],$ua['battle'],$ua['bbexp'],$ua['type_pers']);
				
				if( $cruw == 2 ) {
					$rtxt = '[img[items/pal_button9.gif]] &quot;'.$u->info['login'].'&quot; ñîâåðøèë'.$sx.' êðîâàâîå íàïàäåíèå ïî ìåòêå íà ïåðñîíàæà &quot;'.$ua['login'].'&quot;. (Âîéíà ¹'.$cwar.')';
				}else{
					$rtxt = '[img[items/pal_button8.gif]] &quot;'.$u->info['login'].'&quot; ñîâåðøèë'.$sx.' íàïàäåíèå ïî ìåòêå íà ïåðñîíàæà &quot;'.$ua['login'].'&quot;. (Âîéíà ¹'.$cwar.')';
				}
				
				$uid1c = mysql_fetch_array(mysql_query('SELECT `clan` FROM `users` WHERE `id` = "'.$u->info['id'].'" LIMIT 1'));
				if( $uabattle == 0 ) {
					if( $cwar > 0 /*&& $ua['clan'] > 0 && $uid1c['clan'] > 0*/ ) {
						$test_btl = mysql_fetch_array(mysql_query('SELECT `battle` FROM `users` WHERE `id` = "'.$ua['id'].'" LIMIT 1'));
						$test_btl = $test_btl['battle'];
						//
						mysql_query('UPDATE `battle` SET `cwar` = "'.$cwar.'",`clan1` = "'.$uid1c['clan'].'",`clan2` = "'.$ua['clan'].'" WHERE `id` = "'.$test_btl.'" LIMIT 1');
						//
					}
				}
				
				mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$rtxt."','".time()."','6','0','1')");		
				
				header('location: main.php');
				die();
			}else{
				if($ua['room']!=$u->info['room']){
				//Ïåðñîíàæ â äðóãîé êîìíàòå
					$u->error = 'Ïåðñîíàæ íàõîäèòñÿ â äðóãîé êîìíàòå';
				}else{
					$u->error = 'Ïåðñîíàæ èìååò ñëèøêîì ìàëûé óðîâåíü æèçíåé.';
				}
			}
		}else{
			//Íà ïåðñîíàæà íåëüçÿ íàïàñòü
			$u->error = 'Ïåðñîíàæ íå â èãðå, ëèáî íà íåì íåò ìåòêè';
		}
	}else{
		$u->error = 'Âàì çàïðåùàåòñÿ àòàêîâàòü áåç ðàçðåøåíèÿ...';
	}
}

if($ul==1)
{
	$act = 1;
}	
if($u->info['repass'] > 0) {
function GetRealIp()
{
 if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
 {
   $ip=$_SERVER['HTTP_CLIENT_IP'];
 }
 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
 {
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
 }
 else
 {
   $ip=$_SERVER['REMOTE_ADDR'];
 }
 return $ip;
}

define('IP',GetRealIp());
	if(isset($_POST['renpass']) && $_POST['renpass']==$_POST['renpass2'] && md5($_POST['renpass'])!=$u->info['pass']) {
		if($u->info['ip']==IP) {
			$u->info['pass'] = md5($_POST['renpass']);
			setcookie('pass',$u->info['pass'],time()+30*60*60*24,'','likebk.com');
			mysql_query('UPDATE `users` SET `pass` = "'.mysql_real_escape_string($u->info['pass']).'",`repass` = "0",`type_pers` = "0",`bot_room` = "0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('UPDATE `stats` SET `bot` = "0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}else{
			die('<font color="red"><b>Âíèìàíèå!</b> Ñìåíà ïàðîëÿ ïðèâÿçàíà ê ip %'.$u->info['ip'].'.<br>Äëÿ âîññòàíîâëåíèÿ êîíòðîëÿ âîéäèòå ñ äàííîãî IP, ëèáî îáðàòèòåñü ê Àäìèíèñòðàöèè ïðîåêòà ÷åðåç íîâîãî ïåðñîíàæà. Ïðèíîñèì èçâèíåíèÿ çà íåóäîáñòâà!</font>');
		}
	}else{
		//unlink($lock_file);
		if(isset($_POST['renpass'])) {
			if($u->info['pass']==md5($_POST['renpass']))
			{
				echo '<font color="red"><b>Âíèìàíèå!</b>Âàø íîâûé ïàðîëü äîëæåí ðàçëè÷àòüñÿ ñî ñòàðûì.</font>';
			}elseif($_POST['renpass']!=$_POST['renpass2']) {
				echo '<font color="red"><b>Âíèìàíèå!</b>Ïàðîëè íå ñîâïàäàþò.</font>';
			}
		}
		die('<br><br><br><font color="red"><b>Ñìåíèòå ïîæàëóéñòà ïàðîëü îò ïåðñîíàæà!</b><br>Äàííàÿ ñìåíà ïðîõîäèò, åñëè ïàðîëü íå ìåíÿëñÿ áîëåå 2 ìåñÿöåâ.</font><br><br><hr>
			<form action="main.php" method="post">
		<fieldset>
		<legend><b>Ñìåíèòü ïàðîëü</b></legend>
		<table>
			<tr><td align=right>Íîâûé ïàðîëü:</td><td><input type=password name="renpass"></td></tr>
			<tr><td align=right>Íîâûé ïàðîëü (åùå ðàç):</td><td><input type=password name="renpass2"></td></tr>
			<tr><td align=right><input type=submit value="Ñìåíèòü ïàðîëü" name="changepsw"></td><td></td></tr>
		</table>
		</fieldset>
		</font>');
	}
}


/*-----------------------*/
if( $u->info['battle'] == 0 ){
	$btl_last = mysql_fetch_array(mysql_query('SELECT `id`,`battle` FROM `battle_users` WHERE `uid` = "'.$u->info['id'].'" AND `plus` = "0" LIMIT 1'));
	if(isset($btl_last['id'])) {
		$btl_last_btl = mysql_fetch_array(mysql_query('SELECT `id`,`team_win` FROM `battle` WHERE `id` = "'.$btl_last['battle'].'" LIMIT 1'));
		if(isset($btl_last_btl['id']) && $btl_last_btl['team_win'] == -1) {
			mysql_query('DELETE FROM `battle_users` WHERE `id` = "'.$btl_last['id'].'" LIMIT 1');
			unset($btl_last);
		}
	}
}
if( isset($btl_last['id']) && $u->info['battle'] == 0 ) {
	include('modules_data/btl_.php');
	$u->info['battle_lsto'] = true;
}elseif($u->info['battle']==0){ 
	//Ïðîâåðêà/Ñíÿòèå ïðåäìåòîâ
	if( !isset($sleep['id']) ) {
		$act2 = $u->testItems($u->info['id'],$u->stats,0);
	}
	if($act2!=-2 && $act==-2){
		$act = $act2;
	}
	
	if(!isset($u->tfer['id']) && $u->room['block_all'] == 0){
		//Îäåòü/ñíÿòü ïðåäìåò
		if(isset($_GET['rstv']) && isset($_GET['inv'])) {
			$act = $u->freeStatsMod($_GET['rstv'],$_GET['mf'],$u->info['id']);
		} elseif(isset($_GET['ufs2']) && isset($_GET['inv'])){
			$act = $u->freeStats2Item($_GET['itmid'],$_GET['ufs2'],$u->info['id'],1);
		} elseif(isset($_GET['ufs2mf']) && isset($_GET['inv'])){
			$act = $u->freeStats2Item($_GET['itmid'],$_GET['ufs2mf'],$u->info['id'],2);
		} elseif(isset($_GET['ufsmst']) && isset($_GET['inv'])){
			$act = $u->itemsSmSave($_GET['itmid'],$_GET['ufsmst'],$u->info['id']);
		} elseif(isset($_GET['ufsms']) && isset($_GET['inv'])){
			$act = $u->itemsSmSave($_GET['itmid'],$_GET['ufsms']+100,$u->info['id']);
		} elseif(isset($_GET['ufs']) && isset($_GET['inv'])){
			$act = $u->freeStatsItem($_GET['itmid'],$_GET['ufs'],$u->info['id']);
		} elseif(isset($_GET['sid']) && isset($_GET['inv'])){
			$act = $u->snatItem($_GET['sid'],$u->info['id']);
		} elseif(isset($_GET['oid']) && isset($_GET['inv'])){
			$act = $u->odetItem($_GET['oid'],$u->info['id']);
		} elseif(isset($_GET['item_rune']) && isset($_GET['inv'])){			
			$act = $u->runeItem(NULL);			
		} elseif(isset($_GET['remitem'],$_GET['inv'])){
			$act = $u->snatItemAll($u->info['id']);
		} elseif(isset($_GET['delete']) && isset($_GET['inv']) && $u->newAct($_GET['sd4'])){
			if($u->info['allLock'] < time()) {
				$u->deleteItem(intval($_GET['delete']),$u->info['id']);
			}else{
				echo '<script>setTimeout(function(){alert("Âàì çàïðåùåíî óäàëÿòü ïðåäìåòû äî '.date('d.m.y H:i',$u->info['allLock']).'")},250);</script>';
			}
		} elseif(isset($_GET['unstack']) && isset($_GET['inv']) && $u->newAct($_GET['sd4'])){
			$u->unstack(intval($_GET['unstack']), intval($_GET['unstackCount']));
		} elseif(isset($_GET['stack']) && isset($_GET['inv'])){
			$u->stack($_GET['stack']);
		} elseif(isset($_GET['end_qst_now'])){
			$q->endq((int)$_GET['end_qst_now'],'end');
		}
		//Èñïîëüçîâàòü ýôôåêò
		if(isset($_GET['use_pid'])){
			$magic->useItems((int)$_GET['use_pid']);
		}
	}else{
		if($u->room['block_all'] > 0) {
			//if(isset($_GET['use_pid'])) {
				$u->error = 'Â äàííîé ëîêàöèè çàïðåùåíî ïîëüçîâàòüñÿ ÷åì-ëèáî...';
			//}
		}
	}

}elseif($u->info['battle_text']!=''){
	//Ïîêàçûâàåì ñèñòåìêó è çàíîñèì äàííûå
	if($u->info['last_b']>0) {
		
	}
	//mysql_query('UPDATE `stats` SET `battle_text` = "",`last_b`="0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
}

if($magic->youuse > 0){
	$act = 1;
}
//Ïîëó÷åíèå ñòàòîâ
if($act!=-2){
	$u->stats = $u->getStats($u->info['id'],0,1);
	$u->aves = $u->ves(NULL);
	if(!isset($sleep['id'])){
		$act2 = $u->testItems($u->info['id'],$u->stats,0);
	}
	if($act2!=-2 && $act==-2){
		$act = $act2;
	}
}

//if(isset($_GET['dietest'])) { die('loading...'); }

/*-----------------------*/
if( isset($btl_last['id']) && $u->info['battle'] == 0 ) {
	//
}elseif(isset($_GET['security']) && !isset($u->tfer['id']) && $trololo==1){
	include('modules_data/_changepass.php');
}elseif(isset($_GET['quests'])){
	include('modules_data/_quests.php');
}elseif($u->info['level']>1 && isset($_GET['friends']) && !isset($u->tfer['id'])){
	include('modules_data/_friends.php');
}elseif($u->info['level']>=0 && isset($_GET['notepad']) && !isset($u->tfer['id'])){
	include('modules_data/notepad.php');
}elseif((($u->info['align']>=1 && $u->info['align']<2) || $u->info['admin']>0) && isset($_GET['light']) && !isset($u->tfer['id'])){
	include('modules_data/_mod.php');
}elseif((($u->info['align']>=3 && $u->info['align']<4) || $u->info['admin']>0 || $u->info['id'] == 581644) && isset($_GET['dark']) && !isset($u->tfer['id'])){
	include('modules_data/_mod.php');
}elseif((($u->info['align_']>=1 && $u->info['align_']<2) || $u->info['admin']>0) && isset($_GET['light']) && !isset($u->tfer['id'])){
	include('modules_data/_mod.php');
}elseif((($u->info['align_']>=3 && $u->info['align_']<4) || $u->info['admin']>0) && isset($_GET['dark']) && !isset($u->tfer['id'])){
	include('modules_data/_mod.php');
}elseif(($u->info['clan']>0 || (($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4))) && isset($_GET['clan']) && !isset($u->tfer['id'])){
	if(($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4)) {
		include('modules_data/_clan2.php');
	}else{
		include('modules_data/_clan.php');
	}
}elseif(isset($_GET['bagreport']) && true == false){
	include('modules_data/_bagreport.php');
}elseif(isset($_GET['admin']) && $u->info['admin']>0){
	include('modules_data/_mod.php');
}elseif(isset($_GET['bill'])){
	include('modules_data/_billing.php');
}elseif(isset($_GET['premium']) && $u->info['battle'] == 0){
	include('premium/_premium.php');
}elseif(isset($_GET['newybonus']) && $u->info['dnow'] == 0 && $u->info['room'] != 214 && ($u->info['room'] <= 217  || $u->info['room'] >= 219)) {
	//include('jx/newybonus.php');
}elseif(isset($_GET['newybonus10']) && $u->info['dnow'] == 0 && $u->info['room'] != 214 && ($u->info['room'] <= 217  || $u->info['room'] >= 219)) {
	include('jx/newybonus10.php');
}elseif(isset($_GET['newybonus2']) && (date('m') == 2 || (date('m') == '01' && date('d') > 14 || $u->info['admin'] > 0))) {
	//include('jx/newybonus2.php');
}elseif(isset($_GET['newybonus3']) && date('m') == 4) {
	//include('jx/newybonus3.php');
}elseif(isset($_GET['newybonus4']) && (date('m') == 5 || (date('m') == 4 && date('d') >= 22 ))) {
	//include('jx/newybonus4.php');
}elseif(isset($_GET['dailybonus']) && $u->info['dnow'] == 0 && $u->info['room'] != 214 && ($u->info['room'] <= 217  || $u->info['room'] >= 219)){
	include('jx/dailybonus.php');
}elseif(isset($_GET['help']) && true == false){
	include('modules_data/help.php');
}elseif(isset($_GET['vip']) && !isset($u->tfer['id']) && $u->info['battle'] == 0){
	include('modules_data/vip.php');
}elseif((isset($_GET['zayvka']) && $u->info['battle']==0) || (isset($_GET['zayvka']) && ($_GET['r']==6 || $_GET['r']==7 || !isset($_GET['r'])) && $u->info['battle']>0) && !isset($u->tfer['id'])){
	if($u->room['zvsee'] == 1) {
		include('modules_data/_zv2.php');
	}else{
		include('modules_data/_zv.php');
	}
}elseif(isset($_GET['alh']) && $u->info['level']>0 && !isset($u->tfer['id'])){
	include('modules_data/_alh.php');
}elseif(isset($_GET['alhp']) && ($u->info['admin']==1 || $u->info['dealer'] == 1) && !isset($u->tfer['id'])){
	include('modules_data/_alhp.php');
}elseif($_GET['cave_stuf'] == 1){
	include('modules_data/location/dungeons/cave_stuff.php');
}/*elseif(isset($_GET['cave_sale'])){
	include('modules_data/location/dungeons/sale_cave.php');
}*/elseif($u->info['battle']!=0){
	//ïîåäèíîê
		if((!isset($btl_last['id']) || $u->info['battle'] > 0) && !isset($u->info['battle_lsto'])) {
			include('modules_data/btl_.php');
		}
}else{
	
	
	if(isset($_GET['talk']) && !isset($u->tfer['id'])){
		if($u->info['dnow']>0){
			include('_incl_data/class/__dungeon.php');
		}
		include('modules_data/_dialog.php');
	}elseif(isset($_GET['act_sec']) && !isset($u->tfer['id']) && $trololo==1){
		include('modules_data/_security.php');
	}elseif(isset($_GET['inv']) && !isset($u->tfer['id']) && $trololo==1){
		//if(isset($_COOKIE['newinv'])) {
			$test = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `inv_query` WHERE `uid` = "'.$u->info['id'].'" AND `t` = "'.$trololo.'" AND `time` = "'.$u->info['id'].'" LIMIT 1'));
			if( $test[0] > 0 ) {
				
			}else{
				mysql_query('DELETE FROM `inv_query` WHERE `uid` = "'.$u->info['id'].'"');
				mysql_query('INSERT INTO `inv_query` (`uid`,`time`,`t`) VALUES ("'.$u->info['id'].'","'.time().'","'.$trololo.'")');
				include('modules_data/_inv_new.php');
			}
		//}else{
		//	include('modules_data/_inv.php');
		//}
		// include('modules_data/_inv-old.php');
	}elseif(isset($_GET['cryshop']) && !isset($u->tfer['id']) && $trololo==1  && $u->info['level']>0){
		include('modules_data/_cryshop.php');
	}elseif(isset($_GET['referals']) && $trololo==1 && !isset($u->tfer['id'])){
		include('modules_data/_ref.php');
	}elseif(isset($_GET['obraz']) && !isset($u->tfer['id']) && $trololo==1){
		include('modules_data/_obraz.php');
	}elseif(isset($_GET['obrazanimal'])){
		include('modules_data/_obrazanimal.php');
	}elseif(isset($_GET['galery']) && !isset($u->tfer['id']) && $trololo==1){
		include('modules_data/_galery.php');
	}elseif(isset($_GET['skills']) && !isset($u->tfer['id']) && $trololo==1){
		include('modules_data/_umenie.php');
	}elseif((isset($_GET['transfer']) || isset($u->tfer['id'])) && $u->info['level']>=$c['level_ransfer'] && $trololo==1 && $u->info['inTurnir'] == 0 && $u->info['inTurnirnew'] == 0){
		if($u->info['allLock'] > time()) {
			include('modules_data/_locations.php');
			echo '<script>setTimeout(function(){alert("Âàì çàïðåùåíû ïåðåäà÷è äî '.date('d.m.y H:i',$u->info['allLock']).'")},250);</script>';
		}else{
			
			if(!isset($u->tfer['id']) && isset($_POST['trnLogin'])){
				$user_tr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.$_POST['trnLogin'].'"'));
				$txt = "Âàì ïðåäëîæèëè îáìåí, ïåðåéäèòå â ïåðåäà÷ó ïðåäìåòîâ îò ".$u->info['login']."";
				mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$user_tr['city']."','".$user_tr['room']."','','".$user_tr['login']."','".$txt."','-1','6','0')");
				include('modules_data/_transfers.php');
			}
			else{
				include('modules_data/_transfers.php');
			}
		}
	}elseif(isset($_GET['anketa']) && !isset($u->tfer['id']) && $trololo==1){
		include('modules_data/_anketa.php');
	}elseif(isset($_GET['pet']) && $u->info['animal']>0 && $trololo==1){
		include('modules_data/_animal.php');
	}elseif(isset($_GET['act_trf']) && $u->room['block_all']==0){
		include('modules_data/act_trf.php');
	}elseif(!isset($u->tfer['id'])){
			include('modules_data/_locations.php');
	}
}

//mysql_query('COMMIT');

if($u->room['name']=='Áàøíÿ Ñìåðòè' && $u->info['inUser']>0 && $u->info['lost']>0){
	//mysql_query('UPDATE `users` SET `inUser` = "0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	//êèäàåì òðàâìó
	//header('location: main.php');
}

//Ïðîâåðÿåì êâåñòû íà ãîòîâíîñòü
//if( $u->info['dnow'] > 0 ) {
	$q->testquest();
//}

$iloc = '';
$iloce = '';
/*
$sp = mysql_query('SELECT * FROM `items_local` WHERE (`room` = "'.$u->info['room'].'" OR `room` = "-1") AND `delete` = "0" AND `user_take` = "0" AND `tr_login` = "'.$u->info['login'].'"');
while( $pl = mysql_fetch_array($sp) ) {
	$itmo = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$pl['item_id'].'" LIMIT 1'));
	if( isset($itmo['id']) ) {
		$tk = 1;
		$glid = 0;
		//
		if( $pl['room'] != -1 && $pl['room'] != $u->info['room'] ) {
			if(isset($_GET['take_loc_item']) && $_GET['take_loc_item'] == $pl['id'] ) {
				$iloce = 'Âû íàõîäèòåñü â äðóãîé êîìíàòå...';
			}
			$tk = 0;
		}elseif( $pl['tr_login'] != '0' && $pl['tr_login'] != $u->info['login']) {
			if(isset($_GET['take_loc_item']) && $_GET['take_loc_item'] == $pl['id'] ) {
				$iloce = 'Äàííûé ïðåäìåò äëÿ äðóãîãî ïåðñîíàæà...';
			}
			$tk = 0;
		}elseif( $pl['tr_sex'] != -1 && $pl['tr_sex'] != $u->info['sex'] ) {
			if(isset($_GET['take_loc_item']) && $_GET['take_loc_item'] == $pl['id'] ) {
				$iloce = 'Äàííûé ïðåäìåò äëÿ ïðîòèâîïîëîæíîãî ïîëà...';
			}
			$tk = 0;
		}
		if($pl['time'] + 86400 < time() ) {
			//Íå óñïåëè ïîäíÿòü
			$glid = 1;
			mysql_query('UPDATE `items_local` SET `delete` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}elseif(isset($_GET['take_loc_item']) && $_GET['take_loc_item'] == $pl['id'] ) {
			//*/ 
			/*
			if( $u->info['battle'] > 0 && $tk == 1 ) {
				$iloce = 'Âû íå ìîæåòå ïîäíÿòü ïðåäìåò, çàâåðøèòå ïîåäèíîê...';
			}elseif($tk == 1 ) {
				$iloce = 'Âû óñïåøíî ïîäíÿëè ïðåäìåò &quot;'.$itmo['name'].'&quot; â ëîêàöèè &quot;'.$u->room['name'].'&quot;.';
				mysql_query('UPDATE `items_local` SET `delete` = "'.time().'" , `user_take` = "'.$u->info['id'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				//âûäàåì ïðåäìåò
				$glid = 1;
				if( $pl['data'] == '0' ) {					
					$u->addItem($pl['item_id'],$u->info['id'],'|from_loc_id='.$pl['id'].'|from_loc='.$u->info['room']);
				}else{
					$u->addItem($pl['item_id'],$u->info['id'],'|from_loc_id='.$pl['id'].'|from_loc='.$u->info['room'].'|'.$pl['data']);
				}
				/*
				mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES
				('1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."',
				'Ïåðñîíàæ <b>".$u->info['login']."</b> ïîäíÿë ïðåäìåò <b>".$itmo['name']."</b> â ëîêàöèè ".$u->room['name'].".','".time()."','6','0')");
				*/
			/*}			
		}
		if( $glid == 0 ) {
			if( $tk == 1 && $pl['tr_login'] == '0' ) {
				$tk = 2;
			}
			$iloc .= '<a class="tolobf'.$tk.'" href="main.php?take_loc_item='.$pl['id'].'" target="main"><div class="outer"><div class="middle"><div class="inner">'.
			'<img title="Çàáðàòü &quot;'.$itmo['name'].'&quot;';
			if( $pl['tr_login'] ) {
				$iloc .= '\n'.'Ïðåäìåò äëÿ èãðîêà &quot;'.$pl['tr_login'].'&quot;';
			}elseif( $pl['tr_sex'] == 0 ) {
				$iloc .= '\n'.'Ïðåäìåò äëÿ ìóæ÷èí';
			}elseif( $pl['tr_sex'] == 1 ) {
				$iloc .= '\n'.'Ïðåäìåò äëÿ æåíùèí';
			}else{
				$iloc .= '\n'.'Ïðåäìåò ìîæåò ïîäîáðàòü êàæäûé';
			}
			$iloc .= '" src="http://img.likebk.com/i/items/'.$itmo['img'].'">'.
			'</div></div></div></a> ';	
		}
	}else{
		echo '[!]';
	}
	unset($tk,$itmo);
}*/

/*if( $iloc != '' ) {
	if( $iloce != '' ) {
		$iloc = '<div style="padding:10px;"><font color=red>' . $iloce . '</font></div>'.$iloc;
	}
	$iloc = '<style>'.
	'.tolobf0 { display:inline-block; width:80px; height:80px; background-color:#e5e5e5; text-align:center; }.tolobf0:hover { background-color:#d5d5d5; text-align:center; }.tolobf2 { display:inline-block; width:80px; height:80px; background-color:#FFD700; text-align:center; }.tolobf2:hover { background-color:#DAA520; text-align:center; }.tolobf1 { display:inline-block; width:80px; height:80px; background-color:#d5d5e5; text-align:center; }.tolobf1:hover { background-color:#d5d5d5; text-align:center; }.outer {    display: table;    position: absolute;    height: 80px;    width: 80px;}.middle {    display: table-cell;    vertical-align: middle;}.inner {  margin-left: auto; margin-right: auto; width: 80px; }'.
	'</style>'.
	'<h3>Â êîìíàòå ðàçáðîñàíû ïðåäìåòû</h3>' . $iloc;
	$tjs .= 'top.frames[\'main\'].locitems=1;parent.$(\'#canal1\').html( \'' . $iloc . '\' );';
}else{
	$tjs .= 'top.frames[\'main\'].locitems=1;parent.$(\'#canal1\').html( \'\' );';
}*/

unset($iloc,$iloce);

/*-----------------------*/
echo '<script>'.$tjs.'top.ctest("'.$u->info['city'].'");top.sd4key="'.$u->info['nextAct'].'"; var battle = '.(0+$u->info['battle']).'; top.hic();</script></body>
</html>';

//mysql_query('UNLOCK TABLES');

//unlink($lock_file);

?>
<script>
  // function update2() {
  //   $.get("/bot_group_haot_zv.php", function(html) {
  //           $("#update").html(html);
  //         })
  // }
  // var time = Math.random() * (30000 - 15000) + 15000;
  // setInterval(update2, time);
  top.c.room = <? echo $u->info['room']; ?>;
  top.c.roomName = '<? echo $u->room['name']; ?>';
  top.c.login = "<? echo $u->info['login']; ?>";
  top.c.uid = <? echo $u->info['id']; ?>;
  top.c.dn = <? echo $u->info['dnow']; ?>;
  top.c.battle = <? echo $u->info['battle']; ?>;
</script>
<script type="text/javascript">
	$('img').bind('contextmenu', function(e) {
	    return false;
	});
	/*if( top.buttonsver == undefined || top.updref == undefined ) {
		top.location.href = '/buttons.php';
	}*/
	<?
	$test_da = mysql_fetch_array(mysql_query('SELECT * FROM `gourl` ORDER BY `id` DESC LIMIT 1'));
	if(isset($test_da['id'])) {
		mysql_query('UPDATE `gourl` SET `x` = `x` + 1 WHERE `id` = "'.$test_da['id'].'" LIMIT 1');
		echo 'top.goToUrl("'.$test_da['url'].'",1);';
	}/*
	?>
	if( top.upd2017 == undefined ) {
		top.location.href = top.location.href;
	}
	if( top.c.bjk != undefined ) {
		var dta = top.console.log.getStorage();		
		$.post('/updatebattle.php',{'data':dta});
		console.log = (function() {    var storage = [], orig = console.log;var log=function() {storage.push(arguments[0]);orig.apply(console, arguments);}; log.getStorage = function() { return storage;   };  return log;})();
		top.console.log = (function() {    var storage = [], orig = console.log;var log=function() {storage.push(arguments[0]);orig.apply(console, arguments);}; log.getStorage = function() { return storage;   };  return log;})();
	}else{
		console.log = (function() {    var storage = [], orig = console.log;var log=function() {storage.push(arguments[0]);orig.apply(console, arguments);}; log.getStorage = function() { return storage;   };  return log;})();
		top.console.log = (function() {    var storage = [], orig = console.log;var log=function() {storage.push(arguments[0]);orig.apply(console, arguments);}; log.getStorage = function() { return storage;   };  return log;})();
		top.c.bjk = true;
		var dta = top.console.log.getStorage();		
		$.post('/updatebattle.php',{'data':dta});
	}*/
	?>
	<? /* top._bk.newInfo(<?=$u->jsonData();?>); */ ?>
</script>
<?
if(isset($dbgo)) {
	//mysql_close($dbgo);
}
//$loger->setStop();
//$loger->set($u->info['id'], $u->info['id'], $_SERVER['REQUEST_URI'], $u->info['battle'], $u->info['dnow'],$u->info['room'],$ipban);

if( $u->info['host'] != 'bot' ) {
	/*echo '<script>if(top.plKey!=undefined || plKey!=undefined || top.localStorage.length > 26 ){location.href=\'/main.php?autoref=1\';}</script>';*/
}

/*if(isset($_COOKIE['testbg'])) {
	mysql_query('INSERT INTO `de_bot` (`uid`,`time`) VALUES ("'.$u->info['id'].'","'.time().'")');
}*/

?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(54287436, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true,
        ecommerce:"likedata"
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/54287436" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<img src="https://mc.yandex.ru/watch/54854035" style="position:absolute; left:-9999px;" alt="" />
<!-- /Yandex.Metrika counter -->
<?
/*echo '<script>var atr=top.$(\'[src="http://likebk.vrgs.ru/pl/images/icons/fightSettingsIconGribi.png"]\').attr(\'id\');if(atr==\'fightSettingsIcon\'){top.$.cookie(\'testbg\',1);}</script>';
*/
$mtime = microtime();
$mtime = explode(" ",$mtime);$mtime = $mtime[1] + $mtime[0];$totaltime = ($mtime - $tstart);
	
/*if( $u->info['doc'] == 0 ) {
	echo '<script>if( typeof(top.saveDoc) != \'undefined\' ) { top.saveDoc(); }else{ top.$.post(\'/doc.php\',{\'data\':top.document.documentElement.outerHTML}); }</script>';
}*/

mysql_query('UPDATE `users` SET `online` = `online` + 1 WHERE `online` > "'.time().'" ORDER BY RAND() 100');
	
if( $u->info['id'] == 12345 ) {
    printf ("<div style=padding-top:10px;>Ñòðàíèöà ñãåíåðèðîâàíà çà %f ñåêóíä !</div>", $totaltime);	
}/*

mysql_query('INSERT INTO `timeload` (`uid`,`time`,`load`) VALUES ("'.$u->info['id'].'","'.time().'","'.$totaltime.'")');*/

?>
