<?php

define('GAME',true);
setlocale(LC_CTYPE ,"ru_RU.CP1251");
include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

//турнир
$bs = mysql_fetch_array(mysql_query('SELECT * FROM `bs_turnirs` LIMIT 1'));
$cnfg = array('time_restart' => 10800,'time_puti' => 30);

$arh_config = array(
	'login' => 'Архивариус',
	'pass' => 'bstowerbot',
	'level' => 8,
	'inTurnir' => $bs['id'],
	'sex' => 0,
	'obraz' => '10013.gif',
	'name' => 'Архивариус',
	'online' => (time()+86400),
	'city' => 'capitalcity',
	'room' => 363,
	'align' => 7,
	'clan' => 0,
	'cityreg' => 'capitalcity',
	'bithday' => '01.02.2003',
	'real' => 1,
	'x' => 0, 
	'y' => -5
);


function msg_bs($txt) {
	mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("<font color=red>Внимание! </font><font color=#cb0000>'.mysql_real_escape_string($txt).'</font>","capitalcity","","6","1","'.time().'")');
}

function add_arhiv($arh) {
	global $bs;
	$return = 0;
	mysql_query('INSERT INTO `users` (`login`,`pass`,`level`,`inTurnir`,`sex`,`obraz`,`name`,`online`,`city`,`room`,`align`,`clan`,`cityreg`,`bithday`,`real`) VALUES ("'.$arh['login'].'","bstowerbot","'.$arh['level'].'","'.$bs['id'].'","'.$arh['sex'].'","'.$arh['obraz'].'","'.$arh['login'].'","'.$arh['online'].'","'.$arh['city'].'","'.$arh['room'].'","'.$arh['align'].'","'.$arh['clan'].'","capitalcity","01.02.2003","'.$arh['real'].'")');
	$return = mysql_insert_id();
	if( $return > 0 ) {
		$ins = mysql_query('INSERT INTO `stats` (`id`,`stats`,`hpNow`,`mpNow`,`bot`,`x`,`y`,`upLevel`) VALUES ("'.$return.'","s1=25|s2=25|s3=25|s4=10|rinv=40|m9=5|m6=10","500","500","2","'.$arh['x'].'","'.$arh['y'].'","98")');
		if(!$ins) {
			mysql_query('DELETE FROM `users` WHERE `id` = "'.$return.'" LIMIT 1');
			$return = 0;
		}
	}
	return $return;
}

function testTur() { //завершение турнира по тайм-ауту
	global $bs, $u, $cnfg;
		$inBot = mysql_query('SELECT `id`,`login` FROM `users` WHERE `inTurnir` = '.$bs['id'].'');
		while($bot = mysql_fetch_array($inBot)) {
			$usr = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `inUser` = '.$bot['id'].' LIMIT 1'));
			//удаляем ботов и заявки на бс
			mysql_query('DELETE FROM `items_users` WHERE `uid` = '.$bot['id'].'');
			mysql_query('DELETE FROM `users` WHERE `id` = '.$bot['id'].'');
			mysql_query('DELETE FROM `stats` WHERE `id` = '.$bot['id'].'');
			mysql_query('DELETE FROM `rep` WHERE `id` = '.$bot['id'].'');
			mysql_query('DELETE FROM `bs_zv`');
			mysql_query('DELETE FROM `bs_items`');
			mysql_query('DELETE FROM `bs_trap`');
			//mysql_query('DELETE FROM `bs_logs`');
			mysql_query('UPDATE `users` SET `inUser` = 0 WHERE `id` = '.$usr['id'].' LIMIT 1');
		}
		$bs['status'] = 0;
		$bs['time_start'] = time() + $cnfg['time_restart'];
		mysql_query('UPDATE `bs_turnirs` SET `status` = '.$bs['status'].', `time_start` = '.$bs['time_start'].', `bsid` = `bsid` + 1, `ch1` = 0,`ch2` = 0 WHERE `id` = '.$bs['id'].' LIMIT 1');
		$chat = 'Турнир в Башне Смерти завершен. <b>Тайм-аут!</b> Призовой фонд: '.$bs['money'].' кр. Следующий турнир начнется через: '.$u->timeOut($bs['time_start'] - time()).'';
		msg_bs($chat);
}

function testArh() { //завершение турнира если победил архивариус
	global $bs, $u, $cnfg;
	$i = array(0 => 0, 1 => 0);
		$test = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `inTurnir` > 0 AND `room` = 363 LIMIT 1'));
	if($test[0] == 0) {
		$user = mysql_query('SELECT `id` FROM `users` WHERE `room` = 363 AND `inTurnir` = '.$bs['id'].'');
		while($pl = mysql_fetch_array($user)) {
			mysql_query('UPDATE `users` SET `inUser` = 0 WHERE `inUser` = '.$pl['id'].' LIMIT 1');
			mysql_query('DELETE FROM `rep` WHERE `id` = '.$pl['id'].'');
			mysql_query('DELETE FROM `stats` WHERE `id` = '.$pl['id'].'');
			mysql_query('DELETE FROM `users` WHERE `id` = '.$pl['id'].'');
			mysql_query('DELETE FROM `items_users` WHERE `uid` = '.$pl['id'].'');
		}
		//турнир
		mysql_query('DELETE FROM `bs_trap`');
		mysql_query('DELETE FROM `bs_items`');
		mysql_query('DELETE FROM `bs_zv`');
		//mysql_query('DELETE FROM `bs_logs`');
		$bs['time_start'] = time() + $cnfg['time_restart'];
		$bs['money'] = 0;
		mysql_query('UPDATE `bs_turnirs` SET `status` = 0, `money` = '.$bs['money'].', `time_start` = '.$bs['time_start'].', `bsid` = `bsid` + 1, `ch1` = 0, `ch2` = 0 WHERE `id` = '.$bs['id'].' LIMIT 1');
		$chat = 'Завершился турнир в Башне Смерти. Победитель: <b>Отсутствует</b>. Начало следующего турнира через: '.$u->timeOut($bs['time_start'] - time()).'';
		msg_bs($chat);
	}
}


function StartBs() {
	global $bs, $cnfg, $arh_config, $u;
	$login = array(0 => '', 1 => '');
if(isset($bs['id'])) {
	if($bs['users'] > 2) {
		$bs_zv = mysql_query('SELECT * FROM `bs_zv` WHERE `bsid` = '.$bs['id'].' AND `off` = 0');
		$mapu = array();
		//maps
		$mapsp = mysql_query('SELECT `x`,`y` FROM `bs_map` ORDER BY RAND()');
		while( $mappl = mysql_fetch_array($mapsp) ) {
			$mapu[] = array( 'x' => $mappl['x'] , 'y' => $mappl['y'] );
		}
		
		//создаем Архивариуса
		if($bs['arhiv'] > 0) {
			$arh = rand(0,count($mapu)-1);
			$arh_config['x'] = $mapu[$arh]['x'];
			$arh_config['y'] = $mapu[$arh]['y'];
			$arh_id = add_arhiv($arh_config);
		}
		
		while($zv = mysql_fetch_array($bs_zv)) {
			$usr = mysql_fetch_array(mysql_query('SELECT `s`.*,`u`.* FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id` WHERE `u`.`id` = '.$zv['uid'].' LIMIT 1'));
			if(isset($usr['id']) && $usr['room'] == 263) {
					$login[0]  = '<b>';
					if( $usr['align'] > 0 ) {
						$login[0] .= '<img src=http://img.likebk.com/i/align/align'.$usr['align'].'.gif width=12 height=15 >';
					}
					if( $usr['clan'] > 0 ) {
						$login[0] .= '<img src=http://img.likebk.com/i/clan/'.$usr['clan'].'.gif width=24 height=15 >';
					}
					$login[0] .= ''.$usr['login'].'</b>['.$usr['level'].']<a target=_blank href=http://likebk.com/inf.php?'.$usr['id'].' ><img width=12 hiehgt=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>';
					$login[1] .= ', '.$login[0];
				mysql_query('INSERT INTO `users` (`chatColor`,`align`,`inTurnir`,`molch1`,`molch2`,`activ`,`login`,`room`,`name`,`sex`,`level`,`bithday`) VALUES ("'.$usr['chatColor'].'","'.$usr['align'].'","1","'.$usr['molch1'].'","'.$usr['molch2'].'","0","'.$usr['login'].'","363","'.$usr['name'].'","'.$usr['sex'].'","'.$usr['level'].'","'.date('d.m.Y').'")');
					$inbot = mysql_insert_id(); //айди бота
					if( $inbot > 0 ) {
						$mp = rand(0,count($mapu)-1);
						$x1 = $mapu[$mp]['x'];
						$y1 = $mapu[$mp]['y'];
						unset($mapu[$mp]);
						//Добавляем путы
						mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`img2`) VALUES ("2","'.$inbot.'","Путы","add_speedhp=30000|add_speedmp=30000|puti='.(time()+$cnfg['time_puti']).'","1","'.(time()+$cnfg['time_puti']).'","chains.gif") ');
						//создаем бота
						mysql_query('INSERT INTO `stats` (`timeGo`,`timeGoL`,`upLevel`,`id`,`stats`,`exp`,`ability`,`skills`,`x`,`y`) VALUES ( "'.(time()+$cnfg['time_puti']).'","'.(time()+$cnfg['time_puti']).'","98","'.$inbot.'","s1=3|s2=3|s3=3|s4=11|s5=0|s6=0|rinv=40|m9=5|m6=10","300000","100","9","'.$x1.'","'.$y1.'")');
						mysql_query('UPDATE `users` SET `inUser` = "'.$inbot.'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
					}
				}
			}
			
		$itbs = array(257,258,259,260,263,264,266,343,712,713,715,716,717,718,268,269,270,271,272,273,274,275,277,278,279,280,
	   283,284,285,286,287,288,316,317,320,700,704,705,290,291,228,230,231,295,322,323,326,327,328,329,331,332,335,336,352,353,358,359,363,364,365,81,82,86,83,84,87,89,91,94,93,92,90,95,96,98,99,100,101,542,543,544,545,
	   546,547,370,371,372,373,374,375,376,377,378,379,380,381,382,383,384,385,387,388,389,390,391,392,393,394,395,396,397,398,135,137,138,146,147,148,149,150,151,152,153,156,158,160,161,162,525,526,527,528,529,533,451,454,
	   457,458,460,246,461,248,251,252,253,680,681,684,443,444,445,447,448,449,232,237,239,647,649,651,652,653,654,177,633,168,436,437,438,321,324,330,334,337,719,720,721,412,415,417,421,422,423,424,178,179,180,182,186,187,193,625,
	   626,627,628,632,634
	);
	//
		$x2 = array(462,463,465,467,468,469,470,471,473,474,475,476,477,478,479,480,481,484,485,486,489,490,491,503,254,296,297,298,299,300,302,301,304,305,306,524,307,685,686,459,233,429,431,432,433,192,408);
		$absItem = array(0 => 325, 1 => 333, 2 => 722, 3 => 723, 4 => 427, 5 => 338, 6 => 339, 7 => 341, 8 => 707, 9 => 708, 10 => 709, 11 => 710, 12 => 177, 13 => 633, 14 => 168,
		//заточки
		15 => 2637, 16 => 2659, 17 => 2681, 18 => 2615,
		//ловушки
		20 => 4242, 21 => 4242, 22 => 4242, /*23 => 4242, 24 => 4242, 25 => 4242, 26 => 4242,*/
		//чеки
		23 => 4176,
		//путы
		27 => 4241, 28 => 4241, 29 => 4241,
		//кулачки
		30 => 4404, 31 => 4404, 32 => 4404,
		//молчанки
		33 =>  8274, 34 => 8274, 35 => 8274, 36 => 8274,
		//свитки хила 15 30 45 60   по 4 штуки каждого
		37 => 2481, 38 => 2481, 39 => 2481, 40 => 2481, 41 => 2542, 42 => 2542, 43 => 2542, 44 => 2542, 45 => 2543, 46 => 2543, 47 => 2543, 48 => 2543, 49 => 2544, 50 => 2544, 51 => 2544, 52 => 2544,
		//другое
		53 => 567,
		//оружия
		54 => 104, 55 => 106, 56 => 110, 57 => 112, 58 => 520, 59 => 522, 60 => 4778, 61 => 115, 62 => 121, 63 => 123, 64 => 125, 65 => 127, 66 => 132, 67 => 134, 68 => 351, 69 => 355, 70 => 356, 71 => 357,
		72 => 360, 73 => 362, 73 => 554, 74 => 361, 75 => 141, 76 => 142, 77 => 144, 78 => 183, 79 => 189, 80 => 195, 81 => 196, 82 => 197, 83 => 199, 84 => 203, 85 => 205, 86 => 492, 87 => 494, 88 => 495, 89 => 497, 90 => 499,91 => 501, 92 => 502, 93 => 557, 94 => 560, 95 =>562,
		96 => 6, 97 => 206, 98 => 208, 99 => 212, 100 => 215, 101 => 218, 102 => 220, 103 => 221, 104 => 223, 105 => 224, 106 => 225, 107 => 507, 108 => 508, 109 => 509, 110 =>510, 111 => 511, 112 => 512, 113 => 513, 114 => 514, 115 => 515, 116 => 516, 117 => 565,118 => 566, 119 => 568, 120 =>569
		);
		$mapl = array();
		
		//maps
		$mapsp = mysql_query('SELECT `x`,`y` FROM `bs_map`');
		while( $mappl = mysql_fetch_array($mapsp) ) {
			$map1[] = array( 'x' => $mappl['x'] , 'y' => $mappl['y'] );
		}
				
		$i = 0;
		$j = count($x2)*2;
		while($i < $j) {
			$itemsX2 = $x2[rand(0,count($x2)-1)];
			
			if($i > 60) {
				$mp = rand(0,count($map1)-1);
			}else{
				$mp = $i;
			}
			
			$x1 = $map1[$mp]['x'];
			$y1 = $map1[$mp]['y'];
			
			mysql_query('INSERT INTO `bs_items` (`bid`,`count`,`item_id`,`x`,`y`) VALUES (1,1,'.$itemsX2.','.$x1.','.$y1.')');	
			
			$i++;
		}
				//
		$ii1 = 0;
		while($ii1 < count($mapl) + 50) {
			//На каждой клетке в среднем 3-4 предмета
			$itbsrnd = $itbs[rand(0,count($itbs)-1)];
			
			if($ii1 > 60) {
				$mp = rand(0,count($map1)-1);
			}else{
				$mp = $ii1;
			}
			//
			$x1 = $map1[$mp]['x'];
			$y1 = $map1[$mp]['y'];
			mysql_query('INSERT INTO `bs_items` (`bid`,`count`,`item_id`,`x`,`y`) VALUES (1,1,'.$itbsrnd.','.$x1.','.$y1.')');				
			//
			$ii1++;
		}
		//100%
		$i = 0;
		$j = count($absItem);
		while($i < $j) {
			$x = $map1[rand(0,count($map1)-1)]['x'];
			$y = $map1[rand(0,count($map1)-1)]['y'];
			mysql_query('INSERT INTO `bs_items` (`bid`,`count`,`item_id`,`x`,`y`) VALUES (1,1,'.$absItem[$i].','.$x.','.$y.')');
			$i++;
		}
			$login[1] .= ', <b><img src=http://img.likebk.com/i/align/align7.gif>Архивариус</b>['.$arh_config['level'].']<a href=http://likebk.com/inf.php?'.$arh_id.' target=_blank><img src=http://img.likebk.com/i/inf_capitalcity.gif>';
			$login[1] = ltrim($login[1],', ');	
			$bs['status'] = 1;
			$chat = 'Начался турнир для '.$bs['level'].' уровней в <b>Башне Смерти</b>. Участники: '.$login[1].'';
			msg_bs($chat);
			mysql_query('UPDATE `bs_turnirs` SET `status` = "'.$bs['status'].'", `time_start` = '.time().', `users_finish` = 2, `users` = 0, `ch1` = 0,`ch2` = 0 WHERE `id` = '.$bs['id'].' LIMIT 1');
		}else{
				$bs['time_start'] = time() + $cnfg['time_restart'];
				$chat = 'Турнир для '.$bs['level'].' уровней в <b>Башне Смерти</b> не начался по причине: Недостаточно участников. Начало следующего турнира через '.$u->timeOut($bs['time_start']-time()).' (<small>'.date('d.m.Y H:i',$bs['time_start']).'</small>)';
				msg_bs($chat);
				mysql_query('UPDATE `bs_turnirs` SET `time_start` = '.$bs['time_start'].',`ch1` = 0,`ch2` = 0 WHERE `id` = '.$bs['id'].' LIMIT 1');
		}
	}
}
function colvo($id_turnir) {
	$sp = mysql_query('SELECT `login` FROM `users` WHERE `room` = 363 AND `inTurnir` = '.$id_turnir.' LIMIT 40');
	$arhiv = 0; $users = 0;
	while($pl = mysql_fetch_array($sp)) {
		if($pl['login'] == "Архивариус") {
			$arhiv++;
		}else{
			$users++;
		}
		$usrAll = $users + $arhiv;
	}
	return $usrAll;
}

function TestonlineBot() {
	$test = mysql_query('SELECT `id` FROM `users` WHERE `room` = 363 AND `inTurnir` > 0 LIMIT 40');
	while($bot = mysql_fetch_array($test)) {
		mysql_query('UPDATE `users` SET `online` = '.(time() + 7200).' WHERE `id` = '.$bot['id'].' LIMIT 1');
	}
}

	$usersAll = colvo($bs['id']);
	
	if( $bs['status'] == 1) {
		//обновляем онлайн ботам которых кинули
		TestonlineBot();
		
		if($bs['time_start'] < time() - 8*60*60) { //Тайм-аут
			testTur();
		}elseif($usersAll <= 1) { //Если победил Архивариус
			testArh();
		}
	}elseif($bs['status'] == 0) {
		if($bs['time_start'] <= time()) {
			StartBs();
		}else{
			if($bs['time_start'] - 60*60 < time() && $bs['ch1'] == 0) {
				$chat = 'Начало турнира для '.$bs['level'].' уровней в <b>Башне Смерти</b> через '.$u->timeOut($bs['time_start']-time()).' (<small>'.date('d.m.Y H:i',$bs['time_start']).'</small>), текущий призовой фонд: '.$bs['money'].' кр., заявок: '.$bs['users'].'';
				msg_bs($chat);
				mysql_query('UPDATE `bs_turnirs` SET `ch1` = 1 WHERE `id` = '.$bs['id'].' LIMIT 1');
			}elseif($bs['time_start'] - 10*60 < time() && $bs['ch2'] == 0) {
				$chat = 'Начало турнира для '.$bs['level'].' уровней в <b>Башне Смерти</b> через '.$u->timeOut($bs['time_start']-time()).' (<small>'.date('d.m.Y H:i',$bs['time_start']).'</small>), текущий призовой фонд: '.$bs['money'].' кр., заявок: '.$bs['users'].'';
				msg_bs($chat);
				mysql_query('UPDATE `bs_turnirs` SET `ch2` = 1 WHERE `id` = '.$bs['id'].' LIMIT 1');
			}
		}
	}
?>