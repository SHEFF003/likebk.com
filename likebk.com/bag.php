<?

if(isset($_GET['test'])) {
	$i = 412.5;
	$j = 0; $x = 0; $k = 0;
	while( $i > 20 ) {
		$x++;
		$i = round( $i + $i/100*0.1 ,3);
		if( $j == 29 ) {
			$i -= 56.8;
		}
		if( $x == 30 ) {
			$x = 0;
			$p = $i/100*5;
			if( $p < 20 ) {
				$p = 20;
			}
			$i = round( $i - $p ,3);
			$k++;
		}
		if( $x == 0 ) {
			echo '&nbsp; &nbsp; &nbsp; ['.$k.'] <b>';
		}
		echo $j. '. '.$i.'<br><br>';
		if( $x == 0 ) {
			echo '</b>';
		}
		$j++;
	}
	die();
}

if(isset($_GET['statsbag'])) {
	
	include('_incl_data/__config.php');
	define('GAME',true);
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__user.php');
	
	function test_skills($plu,$repu) {
		$r = 0;
		$sp = mysql_query('SELECT * FROM `levels` WHERE `upLevel` < "'.$plu['upLevel'].'" ORDER BY `upLevel` ASC');
		while( $pl = mysql_fetch_array($sp) ) {
			$r += $pl['skills'];
		}
		if( $repu['add_skills'] > 10 ) {
			$repu['add_skills'] = 10;
		}
		if($plu['twink'] == 0) {
			$r += $repu['add_skills'];
		}
		
		return $r;
	}
	
	function test_skills2($plu,$repu) {
		$r = 0;
		$sp = mysql_query('SELECT * FROM `levels` WHERE `upLevel` < "'.$plu['upLevel'].'" ORDER BY `upLevel` ASC');
		while( $pl = mysql_fetch_array($sp) ) {
			$r += $pl['nskills'];
		}
		if($plu['twink'] == 0) {
			$r += $repu['add_skills2'];
		}
		return $r;
	}
	
	function test_ability($plu,$repu) {
		$r = 0;
		$sp = mysql_query('SELECT * FROM `levels` WHERE `upLevel` < "'.$plu['upLevel'].'" ORDER BY `upLevel` ASC');
		while( $pl = mysql_fetch_array($sp) ) {
			$r += $pl['ability'];
		}
		
		if($plu['twink'] == 0) {
			$arch = mysql_fetch_array(mysql_query('SELECT * FROM `achiev` WHERE `uid` = "'.$plu['id'].'" LIMIT 1'));
			$r += $arch['add_stats'];
			$r += $repu['add_stats'];
		}
		
		if($plu['twink'] > 0) {
			$r += 20; //почему то 20 лишних статов сука всегда пропадает, хуй его знает из за чего, ебучий твинк
		}
		
		return $r;
	}
	
	function test_s5($plu) {
		$r = 3;
		$sp = mysql_query('SELECT * FROM `levels` WHERE `exp` <= "'.$plu['exp'].'" ORDER BY `upLevel` ASC');
		while( $pl = mysql_fetch_array($sp) ) {
			$r += $pl['vinosl'];
		}
		return $r;
	}
	
	$html = '';
	$sp = mysql_query('SELECT `id` FROM `users` WHERE `real` > 0 AND `pass` NOT LIKE "%saint%" AND `pass` != "online" AND `pass2` NOT LIKE "%saint%"');
	while( $pl = mysql_fetch_array($sp) ) {
		$plu = mysql_fetch_array(mysql_query('SELECT `a`.* , `b`.* FROM `users` AS `a` LEFT JOIN `stats` AS `b` ON `a`.`id` = `b`.`id` WHERE `a`.`id` = "'.$pl['id'].'" LIMIT 1'));
		$repu = mysql_fetch_array(mysql_query('SELECT * FROM `rep` WHERE `id` = "'.$pl['id'].'" LIMIT 1'));
		$stats = $u->lookStats($plu['stats']);
		//
		$mx_st = 3*3 + test_ability($plu,$repu) + test_s5($plu,$repu); //максимум статов
		$mx_sk = 1+test_skills($plu,$repu); //максимум умелок
		//
		$stsu = 0;
		$i = 1;
		while( $i <= 15 ) {
			$stsu += $stats['s'.$i];
			$i++;
		}
		$sksu = 0;
		$i = 1;
		while( $i <= 15 ) {
			$sksu += $stats['a'.$i];
			$sksu += $stats['mg'.$i];
			$i++;
		}
		//
		if( $stsu > $mx_st ) {
			$html .= '<br>'.$u->microLogin($pl['id'],1).' -> ['.$stsu.' из '.$mx_st.' возможных статов]';
		}
		if( $sksu > $mx_sk || $repu['add_skills'] > 10 ) {
			$html2 .= '<br>'.$u->microLogin($pl['id'],1).' -> ['.$sksu.' из '.$mx_sk.' возможных умений, вырыто '.$repu['add_skills'].']';
		}
		//		
	}
	
	$html .= '<hr>'.$html2;
	
	if( $html == '' ) {
		$html = 'Пользователи с багами не найдены.';
	}
	echo $html;
	
	die();
}

if(isset($_GET['kamen'])) {
	include('_incl_data/__config.php');
	define('GAME',true);
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__user.php');
	if(isset($_GET['delete'])) {
		mysql_query('UPDATE `items_users` SET `kamen` = 1 WHERE `id` = "'.$_GET['delete'].'" LIMIT 1');
	}
	$sp = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.mysql_real_escape_string($_GET['kamen']).'" AND `kamen` > 1 AND `inOdet` > 0');
	while( $pl = mysql_fetch_array($sp) ) {
		echo '<br><br>[ itm_id : '.$pl['item_id'].' ] ' . $pl['kamen'] . ' <a href="/bag.php?kamen='.$_GET['kamen'].'&delete='.$pl['id'].'">delete</a>';
	}
	echo '<hr>';
	$rep = mysql_fetch_array(mysql_query('SELECT `hip` FROM `rep` WHERE `id` = "'.$_GET['kamen'].'" LIMIT 1'));
	echo 'HIP: '.$rep['hip'].'';
	die();
}

if(isset($_GET['funduk'])) {
	include('_incl_data/__config.php');
	define('GAME',true);
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__user.php');
	
	$sp = mysql_query('SELECT * FROM `items_users` WHERE `item_id` >= 10182 ORDER BY `id` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		$itm = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.$pl['item_id'].'" LIMIT 1'));
		$po = $u->lookStats($pl['data']);
		if( $po['fromshop'] > 0 || $pl['1price'] > 0 ) {
			echo '<hr>'.$u->microLogin($pl['uid'],1).' - '.$itm['name'].' ('.$pl['1price'].' кр , '.$pl['2price'].') - '.date('d.m.Y H:i',$pl['time_create']).'';
		}else{
			echo '<hr><div style="background-color:red">'.$u->microLogin($pl['uid'],1).' - '.$itm['name'].' ('.$pl['1price'].' кр , '.$pl['2price'].') - '.date('d.m.Y H:i',$pl['time_create']).'</div>';
		}
	}
	
	die();
}


if(isset($_GET['heal'])) {
	include('_incl_data/__config.php');
	define('GAME',true);
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__user.php');
	$usrs = array();
	$sp = mysql_query('SELECT `text`,`vars` FROM `battle_logs` WHERE `battle` = 1703716 AND `text` LIKE "%использовал%HP%"');
	while( $pl = mysql_fetch_array($sp) ) {
		$login = explode('||',$pl['vars']);
		$login = explode('=',$login[0]);
		$login = $login[1];
		$exp = explode('<font color=#006699>+',$pl['text']);
		$exp = explode('</font>',$exp[1]);
		$exp = $exp[0];
		$usrs[$login] += $exp;
	}
	print_r($usrs);
	die();
}

if(isset($_GET['com17'])) {

	include('_incl_data/__config.php');
	define('GAME',true);
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__user.php');
	
	$l= 'Дарс
A N U B I S
nr 1
Рагнар Лодброк
Витюшон
VarguS
awesоme
Alps
Someone
Толстый фраер
SHOW TIME
Awful
Poncheg
technomagnessio
Wоlverine
Raddington
hook_mad
Личноcть
Mr Trololo
Sarz
Steve Rogers
Котей
ПАДОНОК
Император Хаос
djolik
Динамит
SuNCHaSeR
Китайскийероглиф
ШотКредингера
Keep Calm
Flaming Phoenix
Night Assassin
Nefertiri
FENOMEN
Sedoy_killer
Алексей Попович
Черный Принц
TeQuila BooM
Wolf from Minnesota
Земмел
Дарс
Естакада
Oдинокий Волк
Middle Finger
gomer
Fierywind
КАРДИНАЛ
*NightMarE*
KisliyARSI
Генерал Алкоголь
Б А Р О Н
Ангел_Хранитель
TarmanN
DeR LieBHaBeR
Киндер пингви
СЕТЬ
вован машина
Olehandro
ГУАНТУМ
Неш
Baghirovv
Сколфилд
RK
K O N G
Волкодав
The Darkness
тм-Каратель
ATAMAH CIPKO
St Versus
Джесси Пинкман
Takashiba
З Л О Й
LenkOff
Поиграем
Scorpion
Magister Iodine
manu
Бригадный Генерал
смайлик
Mister Smith
НочноЙ ПризраК
S I C A R I O';
$l = explode('
',$l);
$i = 0;
while( $i < count($l) ) {
	$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `login` = "'.$l[$i].'" LIMIT 1'));
	if(!isset($test['id'])) {
		echo '<br>'.$l[$i].'';
	}
	//echo '<br>'.$test['id'].'';
	$i++;
}
	
	
	die();
	
	function addPrem($uid) {
		$tmadd = 7;
		mysql_query('DELETE FROM `premium` WHERE `uid` = "'.$uid.'" LIMIT 1');
		mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$uid.'" AND `id_eff` = "435" AND `delete` = 0 LIMIT 1');
		$tmadd = $tmadd * 86400;
		mysql_query("INSERT INTO `eff_users` (`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`, `endtime`, `endfx`) VALUES (435, ".$uid.", 'LikeBk Gold', 'add_speedhp=150|add_speed_dungeon=50|add_speedmp=150|add_m10=10|add_m11=10|add_exp=100|add_sale_berez=100|add_sale_ekr_berez=100|add_za=10|add_zma=10', 777, ".(time()+$tmadd).", 0, '', 0, '0', 0, '', 1, -1, '0', 0, 1, '', 0, 0, 0, 1, 0, 0, 0);");
		mysql_query("INSERT INTO `premium` (`uid`, `name`, `type`, `time_delete`, `money`, `speed_Loc`, `speedHp`, `speedMp`, `addExp`, `addRep`, `ym_delay`, `yv_drop`, `speed_dunger`, `mfza`, `mf_yron`, `sale_prc`, `saleEkr_prc`, `Exp_zver`) VALUES (".$uid.", 'LikeBk Gold', 3, ".(time()+$tmadd).", 0, 30, 150, 150, 100, 50, 50, 2, 50, 10, 10, 100, 100, 100);");

	}

	$sp = mysql_query('SELECT `id` FROM `users` WHERE `real` > 0');
	while( $pl = mysql_fetch_array($sp) ) {
		$u->addItem(10156,$pl['id'],'|nosale=1|sudba=1|notransfer=1');
		$test = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `timeUse` > "'.(time()).'" AND `uid` = "'.$pl['id'].'" AND `id_eff` = "435" AND `delete` = 0 LIMIT 1'));
		if(isset($test['id'])) {
			//echo $test['name'] . ' - '.$u->timeOut($test['timeUse']-time()).'<br>';
			mysql_query('UPDATE `eff_users` SET `timeUse` = `timeUse` + "'.(86400*7).'" WHERE `id` = "'.$test['id'].'" LIMIT 1');
			mysql_query('UPDATE `premium` SET `time_delete` = "'.($test['timeUse']+86400*7).'" WHERE `id` = "'.$test['id'].'" LIMIT 1');
		}else{
			addPrem($pl['id']);
		}
	}
	die();
}

if(isset($_GET['prem1'])) {
	
	
	include('_incl_data/__config.php');
	define('GAME',true);
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__user.php');
		
	$sp = mysql_query('SELECT `id` FROM `users` WHERE `real` > 0');
	while( $inf = mysql_fetch_array($sp) ) {
		$u->addItem(6812,$inf['id'],'|nosale=1|sudba=1|notransfer=1');
	}
	die();
}
if(isset($_GET['ach-bag'])) {
	
	include('_incl_data/__config.php');
	define('GAME',true);
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__user.php');
	
	$achst = array(
		0,1,0,0,0,
		1,1,1,1,0,
		0,0,0,0,0,
		0,0,0,0,0,
		0,0,0,0,0
	);
	
	echo '<b>Персы с баговыми ачивками в статах:</b><br>';
	
	$sp = mysql_query('SELECT `id` FROM `stats` WHERE `bot` = 0');
	while( $pl = mysql_fetch_array($sp) ) {

		$ach = mysql_fetch_array(mysql_query('SELECT * FROM `achiev` WHERE `uid` = "'.$pl['id'].'" LIMIT 1'));
		$stg = 0;
		
		$i = 0;
		while( $i <= 50 ) {
			if( $ach['a'.$i.'lvl'] > 2 ) {
				$stg += $achst[$i];
			}
			$i++;
		}
		
		if(isset($_GET['update'])) {
			mysql_query('UPDATE `achiev` SET `add_stats` = "'.$stg.'" WHERE `uid` = "'.$pl['id'].'" LIMIT 1');
		}
		echo '<br>'.$u->microLogin($pl['id'],1).' - '.$stg.' статов от ачивки';
		
	}
	die();
}elseif(isset($_GET['stats-bag'])) {
	
	include('_incl_data/__config.php');
	define('GAME',true);
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__user.php');
	
	function test_ability($fu) {
		$r = 3+3+3;		
		$sp = mysql_query('SELECT * FROM `levels` WHERE `upLevel` < "'.$fu['upLevel'].'" ORDER BY `upLevel` ASC');
		while( $pl = mysql_fetch_array($sp) ) {
			$r += $pl['ability'];
			$r += $pl['vinosl'];
		}		
		if($fu['twink'] == 0) {
			$arch = mysql_fetch_array(mysql_query('SELECT * FROM `achiev` WHERE `uid` = "'.$fu['id'].'" LIMIT 1'));
			$r += $arch['add_stats'];
			$r += $fu['rep']['add_stats'];
		}		
		return $r;
	}
	
	function test_s5($fu) {
		$r = 3;
		$sp = mysql_query('SELECT * FROM `levels` WHERE `exp` <= "'.$fu['exp'].'" ORDER BY `upLevel` ASC');
		while( $pl = mysql_fetch_array($sp) ) {
			$r += $pl['vinosl'];
		}
		return $r;
	}
	
	function test_all_stats($dar) {
		global $u;
		$r = 0;
		$po = $u->lookStats($dar);
		$i = 1;
		while( $i <= 11 ) {
			$r += $po['s'.$i];
			$i++;
		}
		return $r;
	}
	
	function newst($st,$lm) {
		global $u;
		$po = $u->lookStats($st);
		$mx = 1;
		$i = 1;
		while( $i <= 11 ) {
			if( $po['s'.$mx] < $po['s'.$i] ) {
				$mx = $i;
			}
			$i++;
		}
		
		$po['s'.$mx] -= $lm;
		return $u->impStats($po);
	}
	
	$x1 = 0;
	$x2 = 0;
	$sp = mysql_query('SELECT `id`,`upLevel`,`stats`,`ability` FROM `stats` WHERE `bot` = 0 ORDER BY `exp` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		
		$sts = 0;
		$stmx = 0;
		
		$pl['rep'] = mysql_fetch_array(mysql_query('SELECT `add_stats` FROM `rep` WHERE `id` = "'.$pl['id'].'" LIMIT 1'));
		
		$sts += test_ability($pl);
		$sts += test_s5($pl);
		
		$stmx  = test_all_stats($pl['stats']) + $pl['ability'];
		
		$arch = mysql_fetch_array(mysql_query('SELECT `add_stats` FROM `achiev` WHERE `uid` = "'.$pl['id'].'" LIMIT 1'));
		$arch = $arch['add_stats'];
		
		$reps = mysql_fetch_array(mysql_query('SELECT `add_stats` FROM `rep` WHERE `uid` = "'.$pl['id'].'" LIMIT 1'));
		$reps = $reps['add_stats'];
		
		if( $stmx - $sts > 0 ) {
			$x1++;
			$newst = newst($pl['stats'],($stmx-$sts));
			if(isset($_GET['update'])) {
				mysql_query('UPDATE `stats` SET `stats` = "'.$newst.'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
			}
			$s1 .= '<div>Игрок: '.$u->microLogin($pl['id'],1).', Статов: '.$stmx.' (ачивки: '.$arch.') , Должно быть: '.$sts.' (Лишних: '.($stmx-$sts).')</div>';
		}elseif( $stmx - $sts < 0 ) {
			$x2++;
			if(isset($_GET['update'])) {
				mysql_query('UPDATE `stats` SET `ability` = "'.(-($stmx-$sts)).'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
			}
			$s2 .= '<div>Игрок: '.$u->microLogin($pl['id'],1).', Статов: '.$stmx.' (ачивки: '.$arch.') , Должно быть: '.$sts.' (Лишних: '.($stmx-$sts).')</div>';
		}
	}
	
	echo '<div>Всего: '.($x1+$x2).' , Лишние статы: '.$x1.' , Терпилы: '.$x2.'</div><hr><div>'.$s1.'</div><hr><div>'.$s2.'</div>';
	
	die();
}elseif(isset($_GET['chisti-v-komke'])) {
	include('_incl_data/__config.php');
	define('GAME',true);
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__user.php');
	
	$sp = mysql_query('SELECT `item_id`,`items_id`,`id` FROM `items_com` WHERE `delete` = 0');
	while( $pl = mysql_fetch_array($sp) ) {
		$itm = mysql_fetch_array(mysql_query('SELECT `id`,`data`,`time_create` FROM `items_users` WHERE `id` = "'.$pl['item_id'].'" LIMIT 1'));
		if(isset($itm['id'])) {
			$main = mysql_fetch_array(mysql_query('SELECT `id`,`srok` FROM `items_main` WHERE `id` = "'.$pl['items_id'].'" LIMIT 1'));
			if(isset($main['id'])) {
				$srok = $main['srok'];
				$po = $u->lookStats($itm['data']);
				if( isset($po['srok']) ) {
					$srok = $po['srok'];
				}
				if( $srok > 0 ) {
					$srok += $itm['time_create'];
					if( $srok < time() ) {
						//echo '<br>[ '.$main['srok'].' | '.$po['srok'].' | '.$itm['id'].' - '.date('d.m.Y H:i',$srok).' ]';
						mysql_query('UPDATE `items_com` SET `delete` = "123456777" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
					}
				}
			}
		}
	}
	
	die();
}elseif(isset($_GET['sanich'])) {
	include('_incl_data/__config.php');
	define('GAME',true);
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__user.php');
	
	$sp = mysql_query('SELECT `id` FROM `items_main` WHERE `name` LIKE "%Страниц%" OR `name` LIKE "%Обложка%"');
	while($pl = mysql_fetch_array($sp) ) {
		$u->addItem($pl['id'],$_GET['sanich']);
	}
	die();
	
}elseif(isset($_GET['chaosmsg'])) {
	define('OK',time());
	include('_incl_data/__config.php');
	define('GAME',true);
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__user.php');
	
	mysql_query('DELETE FROM `chat`');		
	$sp = mysql_query('SELECT * FROM `users` WHERE `online` > '.(time()-120).' AND `admin` = 0 AND (`align` = 1 OR `align` = 2 OR `align` = 3 OR `align` = 7 OR `align` = 0)');
	while( $pl = mysql_fetch_array($sp) ) {
		$from = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` ORDER BY RAND() LIMIT 1'));
		$from = $from['login'];
		mysql_query("INSERT INTO `chat` (`invis`, `dn`, `login`, `to`, `city`, `room`, `effect`, `time`, `type`, `spam`, `text`, `toChat`, `color`, `typeTime`, `sound`, `global`, `delete`, `new`, `ip`, `molch`, `da`, `jalo`, `active`, `frv`) VALUES (0, 0, '".$from."', '".$pl['login']."', '".$pl['city']."', ".$pl['room'].", '', ".(time()+rand(-10,10)).", 3, 0, '  ".$_GET['testmsg']." ', 0, 'Blue', 0, 0, 0, 0, 1, '', 0, 0, 0, 0, NULL);");
	}
	
}elseif(isset($_GET['testmsg'])) {
		
	define('OK',time());
	include('_incl_data/__config.php');
	define('GAME',true);
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__user.php');
	
	if( $u->info['banned'] > 0 || $u->info['molch1'] > OK ) {
		die('BANNED_MOLCH');
	}
			
	$sp = mysql_query('SELECT * FROM `users` WHERE `online` > '.(time()-120).' AND `admin` = 0 AND (`align` = 1 OR `align` = 2 OR `align` = 3 OR `align` = 7 OR `align` = 0)');
	while( $pl = mysql_fetch_array($sp) ) {
		mysql_query("INSERT INTO `chat` (`invis`, `dn`, `login`, `to`, `city`, `room`, `effect`, `time`, `type`, `spam`, `text`, `toChat`, `color`, `typeTime`, `sound`, `global`, `delete`, `new`, `ip`, `molch`, `da`, `jalo`, `active`, `frv`) VALUES (0, 0, '".$u->info['login']."', '".$pl['login']."', '".$pl['city']."', ".$pl['room'].", '', ".(time()+rand(-10,10)).", 3, 0, '  ".$_GET['testmsg']." ', 0, 'Blue', 0, 0, 0, 0, 1, '', 0, 0, 0, 0, NULL);");
	}
	
	die('STOP');
	
}elseif(isset($_GET['clear_bots'])) {
	$ar = array(
		69617027,109151641,142236761,143595573,126042365,130820942,143573987,141971408,69565296,121985402,94781429,120077555,
		140130491,138801317,123388209,89719513,69423904,139507306,143511007,123371894,96830185,69274878,125997020,134448861,
		129637237,115035355,133111039,121895721,96785648,133008359,131934061,132169078,130822318,69427830,123874526,95898061,
		69273533,69306627,97959751,95398719,110775827,69405216,112436641,69429008
	);
	$i = 0; while( $i < count($ar) ) {
		$usr = mysql_fetch_array(mysql_query('SELECT `id`,`login` FROM `users_safe` WHERE `uid` = "'.$ar[$i].'" LIMIT 1'));
		if(isset($usr['id'])) {
			echo '[ЗАМОРОЗКА] <b>'.$usr['login'].'</b><br>';
			//if(!isset($_GET['test'])) {
			//	mysql_query('DELETE FROM `users_safe` WHERE `id` = "'.$usr['id'].'" LIMIT 1');
			//}
		}else{
			echo $u->microLogin($ar[$i],1).'<br>';
			//if(!isset($_GET['test'])) {
			//	mysql_query('DELETE FROM `users` WHERE `id` = "'.$ar[$i].'" LIMIT 1');
			//}
		}
		$i++;
	}
	
	die();
}

if(isset($_GET['clear_delo'])) {
	
	$x = 0; $x1 = 0;
	
	function cleardelo($uid) {
		global $u;
		$sp = mysql_query('SELECT `time`,`uid`,`login`,`text` FROM `delo` WHERE `uid` = "'.$uid.'" ORDER BY `id` DESC');
		while( $pl = mysql_fetch_array($sp) ) {
			$y = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `delo` WHERE
				`time` = "'.$pl['time'].'" AND
				`uid` = "'.$pl['uid'].'" AND
				`login` = "'.$pl['login'].'" AND
				`text` = "'.$pl['text'].'" AND `id` != "'.$pl['id'].'" LIMIT 1'));
			$x += $y[0];
				
			mysql_query('DELETE FROM `delo` WHERE
				`time` = "'.$pl['time'].'" AND
				`uid` = "'.$pl['uid'].'" AND
				`login` = "'.$pl['login'].'" AND
				`text` = "'.$pl['text'].'" AND `id` != "'.$pl['id'].'"
			');
			$x1++;
		}
		echo ''.$u->microLogin($uid,1).' | Записей: '.$x1.' , Удалено дублей: '.$x.' , Осталось: '.($x1-$x).'';
	}
	$usr = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `id` > "'.mysql_real_escape_string($_GET['clear_delo']).'" AND `real` > 0 ORDER BY `id` ASC LIMIT 1'));
	if(isset($usr['id'])) {
		cleardelo($usr['id']);
		
		$xx = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `id` > "'.mysql_real_escape_string($_GET['clear_delo']).'" LIMIT 1'));
		echo ' [Осталось игроков: '.$xx[0].']';
		echo '<script>function test(){ top.frames.location = "/bag.php?clear_delo='.$usr['id'].'";} setTimeout("test();",1000);</script>';
	}
	die();
}

if(isset($_GET['test3'])) {
	$sp = mysql_query('SELECT `uid` FROM `logs_auth` WHERE `browser` = "" GROUP BY `uid`');
	while( $pl = mysql_fetch_array($sp) ) {
		echo '<br>'.$u->microLogin($pl['uid'],1).'';
	}
	die();
}

if(isset($_GET['test2'])) {
	$sp = mysql_query('SELECT `uid`,SUM(`colvo`) AS `x` FROM `ng_statistic` GROUP BY `uid` ORDER BY `x` DESC LIMIT 10');
	$i = 0;
	echo '<b>Список: </b><br>';
	while( $pl = mysql_fetch_array($sp) ) {
		$i++;
		//$u->addItem(10148,$pl['uid'],'|nosale=1|notransfer=1|noremont=1');
		echo '<br>' . $i . '. ' . $u->microLogin($pl['uid'],1) .' - ' . $pl['x'];
	}
	die();
}

if(isset($_GET['test1'])) {
	$sp = mysql_query('SELECT * FROM `items_main` WHERE `id` >= 10126');
	while( $pl = mysql_fetch_array($sp) ) {
		$data = '';
		
		$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "'.$pl['magic_inci'].'" LIMIT 1'));
		$eff = explode('|',$eff['mdata']);
		$i = 0;
		while( $i < count($eff) ) {
			$effd = explode('=',$eff[$i]);
			$effd[0] = str_replace('add_','',$effd[0]);
			$data .= ' , '.$u->is[$effd[0]].': +'.$effd[1].'';
			$i++;
		}
		
		$data = ltrim($data,' , ');
		
		echo '['.$pl['id'].' | '.$pl['magic_inci'].' | '.$pl['overTypei'].'] <img src="http://img.likebk.com/i/items/'.$pl['img'].'" title="'.$pl['name'].'"> &nbsp; Эффект: '.$pl['name'].' &nbsp; '.$data.' <br> ';
	}
	die();
}

if(isset($_GET['test1'])) {
	$sp = mysql_query('SELECT COUNT(`id`) AS `x` , `uid` FROM `pasha_x` GROUP BY `uid` ORDER BY `x` DESC');
	$i = 1;
	while( $pl = mysql_fetch_array($sp) ) {
		/*if( $i <= 2 ) {
			$u->addItem(8013,$pl['uid'],'|nosale=1|sudba=1|notransfer=1');
		}elseif($i <= 10 ) {
			$u->addItem(8014,$pl['uid'],'|nosale=1|sudba=1|notransfer=1');
		}elseif( $i <= 50) {
			$u->addItem(8015,$pl['uid'],'|nosale=1|sudba=1|notransfer=1');
		}*/
		$i++;
		echo '<br>'.$u->microLogin($pl['uid'],1) . ' - '.$pl['x'].' шт.';
	}
	die();
}

if(isset($_GET['test2'])) {
	$sp = mysql_query('SELECT `uid` FROM `pasha_x` ORDER BY `time` ASC');
	$i = 1;
	while( $pl = mysql_fetch_array($sp) ) {
		$usrs[$pl['uid']]++;
		if($usrs[$pl['uid']] >= 100) {
			die($pl['uid']);
		}
	}
	print_r($usrs);
	die();
}

if(isset($_GET['onl'])) {
	$time = time();
	$day = 0;
	while( $day <= 365 ) {
		
		$time -= $day * 86400;
		
		$test = mysql_fetch_array(mysql_query('SELECT * FROM `online_list` WHERE `date` = "'.date('d.m.Y',$time).' 19:00" LIMIT 1'));
		echo ''.date('d.m.Y',$time).' - '.$test['online'].'<br>';
		
		
		$day++;
	}
	die();
}

if(isset($_GET['alh'])) {
	$sp = mysql_query('SELECT * FROM `ekr_sale` WHERE `time` > 1463158611');
	while( $pl = mysql_fetch_array($sp) ) {
		$m = date('m',$pl['time']);
		$y = date('Y',$pl['time']);
		$mas[$y][$m] += round($pl['money2']*0.6);
		$mas['all'] += round($pl['money2']*0.6);
	}
	print_r($mas);
	die();
}

if(isset($_GET['qwe'])) {
	$x = 0;
	$sp = mysql_query('SELECT * FROM `items_users_res` WHERE `uid` = 0');
	while( $itm = mysql_fetch_array($sp) ) {
		$x++;
		mysql_query('INSERT INTO `items_users` (`id`,`item_id`,`1price`,`2price`,`3price`,`4price`,`5price`,`uid`,`use_text`,`data`,`inOdet`,`inShop`,`inGroup`,`delete`,`iznosNOW`,`iznosMAX`,`gift`,`gtxt1`,`gtxt2`,`kolvo`,`geniration`,`magic_inc`,`maidin`,`lastUPD`,`timeOver`,`overType`,`secret_id`,`time_create`,`time_sleep`,`dn_delete`,`inTransfer`,`post_delivery`,`lbtl_`,`bexp`,`so`,`blvl`,`pok_itm`,`btl_zd`,`comsid`,`kamen`) VALUES ("'.$itm['id'].'","'.$itm['item_id'].'","'.$itm['1price'].'","'.$itm['2price'].'","'.$itm['3price'].'","'.$itm['4price'].'","'.$itm['5price'].'","'.$itm['uid'].'","'.$itm['use_text'].'","'.$itm['data'].'","'.$itm['inOdet'].'","'.$itm['inShop'].'","'.$itm['inGroup'].'","'.$itm['delete'].'","'.$itm['iznosNOW'].'","'.$itm['iznosMAX'].'","'.$itm['gift'].'","'.$itm['gtxt1'].'","'.$itm['gtxt2'].'","'.$itm['kolvo'].'","'.$itm['geniration'].'","'.$itm['magic_inc'].'","'.$itm['maidin'].'","'.$itm['lastUPD'].'","'.$itm['timeOver'].'","'.$itm['overType'].'","'.$itm['secret_id'].'","'.$itm['time_create'].'","'.$itm['time_sleep'].'","'.$itm['dn_delete'].'","'.$itm['inTransfer'].'","'.$itm['post_delivery'].'","'.$itm['lbtl_'].'","'.$itm['bexp'].'","'.$itm['so'].'","'.$itm['blvl'].'","'.$itm['pok_itm'].'","'.$itm['btl_zd'].'","'.$itm['comsid'].'","'.$itm['kamen'].'")');
		mysql_query('DELETE FROM `items_users_res` WHERE `id` = "'.$itm['id'].'" LIMIT 1');
	}
	echo $x;
	die();
}

if(isset($_GET['ex'])) {
	
	$itmid = 2;
	$prc = 0.1;
	
	$sp = mysql_query('SELECT COUNT(*) AS `x` , `uid` FROM `items_users` WHERE `item_id` = '.$itmid.' GROUP BY `uid`');
	while( $pl = mysql_fetch_array($sp) ) {
		$lim = $pl['x'] - 10;
		if( $lim >= 1 ) {
			mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$pl['uid'].'" AND `item_id` = '.$itmid.' LIMIT ' . $lim);
			mysql_query('UPDATE `users` SET `money` = `money` + '.( $lim * $prc ) .' WHERE `id` = "'.$pl['uid'].'" LIMIT 1');
		}
	}
	die();
}

if(isset($_GET['itm'])) {
	
	$html = '';
	$x = 0;
	$x2 = 0;
	$sp = mysql_query('SELECT `item_id` , COUNT(`id`) AS `x` FROM `items_users` GROUP BY `item_id` ORDER BY `x` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$pl['item_id'].'" LIMIT 1'));
		$html .= '['.$itm['type'].'] <b>'.$itm['name'].'</b> (id '.$itm['id'].') - '.$pl['x'].' шт.<br>';
		if( $itm['inslot'] == 0 ) {
			$x2 += $pl['x'];
		}
		$x += $pl['x'];
	}
	
	echo 'Всего предметов: '.$x.'<br>Ресурсы: '.$x2.'<hr>';
	echo $html;
	
	die();
}

function save_table($data,$table) {
	$r = array();
	$k = array_keys($data);
	//
	$i = 0;
	$j = 0;
	while( $i < count($k) ) {
		if( gettype($k[$i]) == 'string' ) {
			if( $j > 0 ) {
				$k1 .= ',';
				$d1 .= ',';
			}
			$k1 .= '`'.$k[$i].'`';
			$d1 .= '"'.str_replace('\\','\ ',str_replace('"','&quot;',str_replace(';INSERT INTO `',';&nbsp;INSERT INTO `',$data[$k[$i]]))).'"';
			$j++;
		}
		$i++;
	}
	$r = 'INSERT INTO `'.$table.'` ('.$k1.') VALUES ('.$d1.');';
	//
	return $r;
}

if(isset($_GET['combag2'])) {
	$html = '';
	$sp = mysql_query('SELECT * FROM `items_com` WHERE `buy` = 0 AND `delete` > 0 AND `item_id` NOT IN (SELECT `id` FROM `items_users`)');
	while( $pl = mysql_fetch_array($sp) ) {
		//???????? ?? ??????
		echo $u->microLogin($pl['uid'],1) . ' '.$pl['name'].' ['.$pl['items_id'].'] (x'.$pl['group'].')<br>';
		$x += $pl['group'];
	}
	echo '<hr>Всего предметов: '.$x;
	die();
}

if(isset($_GET['combag'])) {
	$html = '';
	$sp = mysql_query('SELECT * FROM `items_com` WHERE `item_id` NOT IN (SELECT `id` FROM `items_users`) AND `buy` = 0 AND `delete` = 0');
	while( $pl = mysql_fetch_array($sp) ) {
		//???????? ?? ??????
		$itmcopy = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "'.$pl['items_id'].'" AND `uid` > 0 LIMIT 1'));
		if(isset($itmcopy['id'])) {
			$itmcopy['id'] = $pl['item_id'];
			$itmcopy['uid'] = 0;
			mysql_query(save_table($itmcopy,'items_users'));
			echo 1;
		}
	}
	die();
}

if(isset($_GET['prem1'])) {
	$sp = mysql_query('SELECT `id` FROM `users` WHERE `real` > 0');
	while( $inf = mysql_fetch_array($sp) ) {
		/*$prem = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$inf['id'].'" AND `time_delete` > "'.time().'" LIMIT 1'));
		if(isset($prem['id'])) {
			$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `id_eff` = 435 AND `uid` = "'.$inf['id'].'" LIMIT 1'));
			if(!isset($eff['id'])) {
				echo 'test['.(($prem['time_delete']-time())/86400).']';
			}
			
			echo '1';
			mysql_query('DELETE FROM `premium` WHERE `uid` = "'.$inf['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$inf['id'].'" AND `id_eff` = "435" AND `delete` = 0 LIMIT 1');
			$tmadd = 7 * 86400 + ($prem['time_delete']-time());
			mysql_query("INSERT INTO `eff_users` (`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`, `endtime`, `endfx`) VALUES (435, ".$inf['id'].", 'LikeBk Gold', 'add_speedhp=150|add_speed_dungeon=50|add_speedmp=150|add_m10=10|add_m11=10|add_exp=100|add_sale_berez=100|add_sale_ekr_berez=100|add_za=10|add_zma=10', 777, ".(time()+$tmadd).", 0, '', 0, '0', 0, '', 1, -1, '0', 0, 1, '', 0, 0, 0, 1, 0, 0, 0);");
			mysql_query("INSERT INTO `premium` (`uid`, `name`, `type`, `time_delete`, `money`, `speed_Loc`, `speedHp`, `speedMp`, `addExp`, `addRep`, `ym_delay`, `yv_drop`, `speed_dunger`, `mfza`, `mf_yron`, `sale_prc`, `saleEkr_prc`, `Exp_zver`) VALUES (".$inf['id'].", 'LikeBk Gold', 3, ".(time()+$tmadd).", 0, 30, 150, 150, 100, 50, 50, 2, 50, 10, 10, 100, 100, 100);");
			
		}else{
			echo '0';
			mysql_query('DELETE FROM `premium` WHERE `uid` = "'.$inf['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$inf['id'].'" AND `id_eff` = "435" AND `delete` = 0 LIMIT 1');
			$tmadd = 7;
			$tmadd = $tmadd * 86400;
			mysql_query("INSERT INTO `eff_users` (`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`, `endtime`, `endfx`) VALUES (435, ".$inf['id'].", 'LikeBk Gold', 'add_speedhp=150|add_speed_dungeon=50|add_speedmp=150|add_m10=10|add_m11=10|add_exp=100|add_sale_berez=100|add_sale_ekr_berez=100|add_za=10|add_zma=10', 777, ".(time()+$tmadd).", 0, '', 0, '0', 0, '', 1, -1, '0', 0, 1, '', 0, 0, 0, 1, 0, 0, 0);");
			mysql_query("INSERT INTO `premium` (`uid`, `name`, `type`, `time_delete`, `money`, `speed_Loc`, `speedHp`, `speedMp`, `addExp`, `addRep`, `ym_delay`, `yv_drop`, `speed_dunger`, `mfza`, `mf_yron`, `sale_prc`, `saleEkr_prc`, `Exp_zver`) VALUES (".$inf['id'].", 'LikeBk Gold', 3, ".(time()+$tmadd).", 0, 30, 150, 150, 100, 50, 50, 2, 50, 10, 10, 100, 100, 100);");
			
		}
		//поступь 4371 , 6812 компенсация
		$u->addItem(4371,$inf['id'],'|nosale=1|sudba=1|notransfer=1');
		$u->addItem(6812,$inf['id'],'|nosale=1|sudba=1|notransfer=1');*/
	}
	die();
}

if(isset($_GET['backres'])) {
	
	/*$x = 0;
	$sp = mysql_query('SELECT * FROM `items_users_res` WHERE `lastUPD` < "'.(time()-60*30).'" AND `inShop` < 2 AND `delete` = 0 AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `type` = 32 OR `type` = 34 OR `type` = 1206) LIMIT 10000');
	while( $itm = mysql_fetch_array($sp) ) {
		$x++;
		mysql_query('INSERT INTO `items_users` (`id`,`item_id`,`1price`,`2price`,`3price`,`4price`,`5price`,`uid`,`use_text`,`data`,`inOdet`,`inShop`,`inGroup`,`delete`,`iznosNOW`,`iznosMAX`,`gift`,`gtxt1`,`gtxt2`,`kolvo`,`geniration`,`magic_inc`,`maidin`,`lastUPD`,`timeOver`,`overType`,`secret_id`,`time_create`,`time_sleep`,`dn_delete`,`inTransfer`,`post_delivery`,`lbtl_`,`bexp`,`so`,`blvl`,`pok_itm`,`btl_zd`,`comsid`,`kamen`) VALUES ("'.$itm['id'].'","'.$itm['item_id'].'","'.$itm['1price'].'","'.$itm['2price'].'","'.$itm['3price'].'","'.$itm['4price'].'","'.$itm['5price'].'","'.$itm['uid'].'","'.$itm['use_text'].'","'.$itm['data'].'","'.$itm['inOdet'].'","'.$itm['inShop'].'","'.$itm['inGroup'].'","'.$itm['delete'].'","'.$itm['iznosNOW'].'","'.$itm['iznosMAX'].'","'.$itm['gift'].'","'.$itm['gtxt1'].'","'.$itm['gtxt2'].'","'.$itm['kolvo'].'","'.$itm['geniration'].'","'.$itm['magic_inc'].'","'.$itm['maidin'].'","'.$itm['lastUPD'].'","'.$itm['timeOver'].'","'.$itm['overType'].'","'.$itm['secret_id'].'","'.$itm['time_create'].'","'.$itm['time_sleep'].'","'.$itm['dn_delete'].'","'.$itm['inTransfer'].'","'.$itm['post_delivery'].'","'.$itm['lbtl_'].'","'.$itm['bexp'].'","'.$itm['so'].'","'.$itm['blvl'].'","'.$itm['pok_itm'].'","'.$itm['btl_zd'].'","'.$itm['comsid'].'","'.$itm['kamen'].'")');
		mysql_query('DELETE FROM `items_users_res` WHERE `id` = "'.$itm['id'].'" LIMIT 1');
	}
	echo 'Перенос предметов: '.$x.' шт.';
	$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users_res` WHERE `item_id` IN ( SELECT `id` FROM `items_main` WHERE `type` = 32 ) LIMIT 1'));
	echo '<br>Осталось '.$x[0].' предметов.';
	echo '<script>top.location.href = top.location.href;</script>';*/
	
	die();
}

if(isset($_GET['list23'])) {
	$sp = mysql_query('SELECT `uid`,`colvo` FROM `ng_statistic` ORDER BY `colvo` DESC LIMIT 100');
	while( $pl = mysql_fetch_array($sp) ) {
		$i++;
		echo '<br>'.$i . '. ' .$u->microLogin($pl['uid'],1) . ' ('.$pl['colvo'].' шт.)';
	}
	die();
}elseif(isset($_GET['list1'])) {
	$sp = mysql_query('SELECT `uid` , COUNT(*) AS `x` FROM `users_delo` WHERE `text` LIKE "%Получен предмет%Бронзовая книга%" AND `time`  > 1548340862 - 86400 * 4 AND `time` < 1548340862 - 79200 GROUP BY `uid` ORDER BY `x` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		if( $pl['x'] >= 64 ) {
			$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `uid` = "'.$pl['uid'].'" AND `delete` = 0 AND `item_id` = 3196 LIMIT 1'));
			echo $u->microLogin($pl['uid'],1) . ' - '.$pl['x'].' (Осталось книг: '.$x[0].')';
			echo ' Отнимаем: ';
			$xo = $pl['x'] - 6;
			if( $xo > $x[0] ) {
				$xo = $x[0];
			}
			if(isset($_GET['nakazat'])) {
				//mysql_query('UPDATE `items_users` SET `uid` = 12345 , `gift` = "'.$pl['uid'].'" WHERE `uid` = "'.$pl['uid'].'" AND `delete` = 0 AND `item_id` = 3196 LIMIT ' . $xo);
			}
			echo $xo;
			
			echo '<br>';
		}
	}
	die();
}

if(isset($_GET['bots'])) {
	$sp = mysql_query('SELECT * FROM `de_bot` WHERE `uid` != 15466598 AND `uid` != 21596721 GROUP BY `uid`');
	while( $pl = mysql_fetch_array($sp) ) {
		echo $u->microLogin($pl['uid'],1) . '<br>';
	}
	die();
}

if(isset($_GET['golos'])) {
	$sp = mysql_query('SELECT `uid` FROM `stella_u` GROUP BY `uid`');
	while( $pl = mysql_fetch_array($sp) ) {
		echo '<br>' . $u->microLogin($pl['uid'],1);
	}
	die();
}

if(isset($_GET['table'])) {
	$result = mysql_query("SHOW COLUMNS FROM `items_users`");
	if (!$result) {
		echo 'Ошибка при выполнении запроса: ' . mysql_error();
		exit;
	}
	if (mysql_num_rows($result) > 0) {
		while ($row = mysql_fetch_assoc($result)) {
			if( $t1 != '' ) {
				$t1 .= ',';
				$t2 .= ',';
			}
			$t1 .= '`'.$row['Field'].'`';
			$t2 .= '"\'.$itm[\''.$row['Field'].'\'].\'"';
		}
		echo 'mysql_query(\'INSERT INTO `items_users_res` ('.$t1.') VALUES ('.$t2.')\');';
	}
	die();
}

if(isset($_GET['newinv'])) {
	$sp = mysql_query('SELECT `id` FROM `users` WHERE `newinv` > 0 AND `online` > "'.(time()-60).'"');
	while( $pl = mysql_fetch_array($sp) ) {
		echo $u->microLogin($pl['id'],1).'<br>';
		$x++;
	}
	echo '<hr>Игроков с новым инвентарем: '.$x.' шт.';
	die();
}

if(isset($_GET['elkozel'])) {
	$sp = mysql_query('SELECT * FROM `users_delo` WHERE `uid` = 42812795 AND `time` > "'.(time()-86400*2).'" AND `text` LIKE "%был передан%" ORDER BY `id` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		/*echo '<div>';
		echo $pl['text'];
		echo '</div>';*/
		$itmid = explode('[itm:',$pl['text']);
		$itmid = explode(']',$itmid[1]);
		$itmid = $itmid[0];
		$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `id` = "'.$itmid.'" LIMIT 1'));
		if(isset($itm['id'])) {
			echo '['.$itmid.' - ';
			if( !isset($itm['id']) || $itm['delete'] > 0 ) {
				echo ' <b><font color="red">предмет использован</font></b>';
			}else{
				mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			}
			echo ' - ' . $u->microLogin($itm['uid'],1);
			$itm2 = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$itm['item_id'].'" LIMIT 1'));
			echo ' <b>id'.$itm2['id'].' , '.$itm2['name'].'</b>';
			echo ']<br>';
		}
	}
	die();
}

if(isset($_GET['elkozel2'])) {
	$sp1 = mysql_query('SELECT * FROM `post` WHERE  `uid` = 42812795 AND `time` >= "'.(time()-86400*2).'" ORDER BY `time` DESC');
	while($pl1 = mysql_fetch_array($sp1))
	{
		$itmid = $pl1['item_id'];
		$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `id` = "'.$itmid.'" LIMIT 1'));
		if(isset($itm['id'])) {
			echo '['.$itmid.' - ';
			if( !isset($itm['id']) || $itm['delete'] > 0 ) {
				echo ' <b><font color="red">предмет использован</font></b>';
			}else{
				mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			}
			echo ' - ' . $u->microLogin($itm['uid'],1);
			$itm2 = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$itm['item_id'].'" LIMIT 1'));
			echo ' <b>id'.$itm2['id'].' , '.$itm2['name'].'</b>';
			echo ']<br>';
		}else{
			mysql_query('DELETE FROM `post` WHERE `id` = "'.$pl1['id'].'" LIMIT 1');
		}
	} 
	die();
}

if(isset($_GET['prem'])){
	$sp = mysql_query('SELECT * FROM `premium` WHERE `time_delete` > "'.time().'" GROUP BY `uid`');
	while($pl = mysql_fetch_array($sp)) {
		$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$pl['uid'].'" AND `name` LIKE "%LikeBk Gold%" LIMIT 1'));
		if(!isset($eff['id'])) {
			echo '<font color=red>'.$u->microLogin($pl['uid'],1). ' - [Осталось: '.$u->timeOut($pl['time_delete']-time()).']</font><br>';
		}else{
			//echo $u->microLogin($pl['uid'],1). ' - [Осталось: '.$u->timeOut($pl['time_delete']-time()).']<br>';
		}
	}
	die();
}

if(isset($_GET['max'])){
	$sp = mysql_query('SELECT * FROM `items_users` WHERE `time_create` = 1543597465 AND `item_id` >= 5095 AND `item_id` <= 5099 AND `delete` > 0');
	while($pl = mysql_fetch_array($sp)){
		$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$pl['item_id'].'" LIMIT 1'));
		echo '['.$u->microLogin($pl['uid'],1).'] - '.$itm['name'].'<br>';
	}
	die();
}
//SELECT `uid` FROM `items_users` WHERE `item_id` = 4008

if(isset($_GET['bot2'])){
	$sp = mysql_query('SELECT `uid` FROM `items_users` WHERE `item_id` = 4008');
	while($pl=mysql_fetch_array($sp)){
		echo $u->microLogin($pl['uid'],1).'<br>';
	}
	die();
}

if(isset($_GET['bot1'])){
	$sp = mysql_query('SELECT `uid` FROM `dng_way` GROUP BY `uid`');
	while($pl=mysql_fetch_array($sp)){
		echo $u->microLogin($pl['uid'],1).'<br>';
	}
	die();
}

if(isset($_GET['haot_stat'])) {
	$sp = mysql_query('SELECT `uid`,COUNT(*) AS `x` FROM `haot_stat` GROUP BY `uid` ORDER BY `x` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		echo '[Хаотов: '.$pl['x'].'] '.$u->microLogin($pl['uid'],1).' <br>';
	}
	die();
}

if(isset($_GET['test1'])) {
	/*$sp = mysql_query('SELECT `id`,`money` FROM `users` ORDER BY `money` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		$test = mysql_fetch_array(mysql_query('SELECT `id`,`money` FROM `battle_last` WHERE `uid` = "'.$pl['id'].'" AND `time` > '.(time()-3600*5).' ORDER BY `id` ASC LIMIT 1'));
		if( isset($test['id']) && $pl['money'] < $test['money'] && $test['money'] - $pl['money'] > 500 ) {
			echo $u->microLogin($pl['id'],1).' [Стало: '.$pl['money'].' , Было: '.$test['money'].']<br>';
		}
	}*/
	die();
}

if(isset($_GET['f1f2'])) {
	$sp = mysql_query('SELECT `id` FROM `users` WHERE `real` > 0');
	while( $pl = mysql_fetch_array($sp) ) {
		$tst = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dailybonus` WHERE `uid` = "'.$pl['id'].'" LIMIT 1'));
		$tst = $tst[0];
		if( $tst >= 7 ) {
			//максимальная награда и так
			
		}else{
			//добавляем еще один день
			
		}
		//Обновляем текущий день награду
		//mysql_query('INSERT INTO `dailybattle` (`uid`,`date`) VALUES ("'.$pl['id'].'","35")');
	}
	die();
}

if(isset($_GET['fuckbag'])) {
	$sp = mysql_query('SELECT `id`,`money` FROM `users` WHERE `id` IN ( SELECT `uid` FROM `achiev` WHERE `a11` >= 100 AND `uid` IN (SELECT `id` FROM `users` WHERE `online` > 1537269962-86400) ) ORDER BY `money` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		echo $u->microLogin($pl['id'],1).' - - - - - - - <u>'.$pl['money'].' кр.</u><br>';
	}
	die();
}

if(isset($_GET['fx1'])) {
	$sp = mysql_query('SELECT `id`,`uid` FROM `items_users` WHERE `item_id` = 9968 AND `delete` = 0');
	while( $pl = mysql_fetch_array($sp) ) {
		if(!isset($usr[$pl['uid']])) {
			$usr[$pl['uid']] = true;
			mysql_query('DELETE FROM `items_users` WHERE `item_id` = 9968 AND `uid` = "'.$pl['uid'].'" AND `id` != '.$pl['id'].'');
		}
	}
	die();
}
	
if(isset($_GET['test1'])) {
	$sp = mysql_query('SELECT * FROM `items_users` WHERE `item_id` = 7006 AND `delete` = 0');
	while( $pl = mysql_fetch_array($sp) ) {
		$ico = mysql_fetch_array(mysql_query('SELECT * FROM `23quest` WHERE `uid` = "'.$pl['uid'].'" LIMIT 1'));
		if(!isset($ico['id'])) {
			echo $u->microLogin($pl['uid'],1).'<br>';
			//mysql_query('INSERT INTO `23quest` (`uid`,`time`) VALUES ("'.$pl['uid'].'","'.time().'")');
		}
	}
	die();
}
	
if(isset($_GET['prem1'])) {
	/*$sp = mysql_query('SELECT * FROM `users` WHERE `real` > 0');
	while( $inf = mysql_fetch_array($sp) ) {
		$prem = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$inf['id'].'" AND `time_delete` > "'.time().'" LIMIT 1'));
		if(isset($prem['id'])) {
			$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `id_eff` = 435 AND `uid` = "'.$inf['id'].'" LIMIT 1'));
			if(!isset($eff['id'])) {
				echo 'test['.(($prem['time_delete']-time())/86400).']';
			}
			
			echo '1';
			mysql_query('DELETE FROM `premium` WHERE `uid` = "'.$inf['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$inf['id'].'" AND `id_eff` = "435" AND `delete` = 0 LIMIT 1');
			$tmadd = 1 * 86400 + ($prem['time_delete']-time());
			mysql_query("INSERT INTO `eff_users` (`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`, `endtime`, `endfx`) VALUES (435, ".$inf['id'].", 'LikeBk Gold', 'add_speedhp=150|add_speed_dungeon=50|add_speedmp=150|add_m10=10|add_m11=10|add_exp=100|add_sale_berez=100|add_sale_ekr_berez=100|add_za=10|add_zma=10', 777, ".(time()+$tmadd).", 0, '', 0, '0', 0, '', 1, -1, '0', 0, 1, '', 0, 0, 0, 1, 0, 0, 0);");
			mysql_query("INSERT INTO `premium` (`uid`, `name`, `type`, `time_delete`, `money`, `speed_Loc`, `speedHp`, `speedMp`, `addExp`, `addRep`, `ym_delay`, `yv_drop`, `speed_dunger`, `mfza`, `mf_yron`, `sale_prc`, `saleEkr_prc`, `Exp_zver`) VALUES (".$inf['id'].", 'LikeBk Gold', 3, ".(time()+$tmadd).", 0, 30, 150, 150, 100, 50, 50, 2, 50, 10, 10, 100, 100, 100);");
			
		}else{
			echo '0';
			mysql_query('DELETE FROM `premium` WHERE `uid` = "'.$inf['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$inf['id'].'" AND `id_eff` = "435" AND `delete` = 0 LIMIT 1');
			$tmadd = 1;
			$tmadd = $tmadd * 86400;
			mysql_query("INSERT INTO `eff_users` (`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`, `endtime`, `endfx`) VALUES (435, ".$inf['id'].", 'LikeBk Gold', 'add_speedhp=150|add_speed_dungeon=50|add_speedmp=150|add_m10=10|add_m11=10|add_exp=100|add_sale_berez=100|add_sale_ekr_berez=100|add_za=10|add_zma=10', 777, ".(time()+$tmadd).", 0, '', 0, '0', 0, '', 1, -1, '0', 0, 1, '', 0, 0, 0, 1, 0, 0, 0);");
			mysql_query("INSERT INTO `premium` (`uid`, `name`, `type`, `time_delete`, `money`, `speed_Loc`, `speedHp`, `speedMp`, `addExp`, `addRep`, `ym_delay`, `yv_drop`, `speed_dunger`, `mfza`, `mf_yron`, `sale_prc`, `saleEkr_prc`, `Exp_zver`) VALUES (".$inf['id'].", 'LikeBk Gold', 3, ".(time()+$tmadd).", 0, 30, 150, 150, 100, 50, 50, 2, 50, 10, 10, 100, 100, 100);");
			
		}
	}*/
	die();
}
	
if(isset($_GET['kk'])) {
	
	$sp = mysql_query('SELECT `referals` FROM `users` WHERE `id` IN (SELECT `id` FROM `stats` WHERE `exp` >= 200000) AND `banned` = 0 AND `referals` > 0 AND `timereg` >= ' . strtotime('17-12-2017') .' AND `timereg` <= ' . strtotime('18-01-2018'));
	$rf = array(); $all = 0;
	while( $pl = mysql_fetch_array($sp) ) {
		$rf[$pl['referals']]++; $all++;
	}
	
	echo 'Всего рефералов: '.$all.'<br><br>';
	
	arsort($rf);
	$key = array_keys($rf);
	$i = 0;
	$f2 = 100;
	while( $i < count($key) ) {
		if( $rf[$key[$i]] < $f2 ) {
			$f2 = $rf[$key[$i]];
			if( $f2 != 100 ) {
				echo '<hr>';
			}
		}
		echo '<b></b>'.$u->microLogin($key[$i],1).' - Рефералов: '.$rf[$key[$i]].'<br><br>';
		$i++;
	}
	
	die();
	
}elseif(isset($_GET['gft'])) {
	
	/*$i = 0;
	while( $i <= 254 ) {
		$f1 = file_exists('../img.likebk.com/i/items/newgft/'.$i.'.png');
		$f2 = file_exists('../img.likebk.com/i/items/newgft/'.$i.'.gif');
		if( $f1 ) {
			$t = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_main` WHERE `img` = "newgft/'.$i.'.png"'));
			if(!isset($t['id'])) {
				echo 'add -> '.$i.'.png<br>';
				mysql_query("INSERT INTO `items_main` (`name`, `img`, `type`, `iznosMAXi`, `price1`, `info`, `massa`, `magic_inci`, `overTypei`, `group`, `group_max`) VALUES ('Новый подарок', 'newgft/".$i.".png', 38, 1, 30.00, '<i>Сувенир</i>', 1.00, '', NULL, 1, 127);");
			}
		}
		if( $f2 ) {
			$t = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_main` WHERE `img` = "newgft/'.$i.'.gif"'));
			if(!isset($t['id'])) {
				echo 'add -> '.$i.'.gif<br>';
				mysql_query("INSERT INTO `items_main` (`name`, `img`, `type`, `iznosMAXi`, `price1`, `info`, `massa`, `magic_inci`, `overTypei`, `group`, `group_max`) VALUES ('Новый подарок', 'newgft/".$i.".gif', 38, 1, 30.00, '<i>Сувенир</i>', 1.00, '', NULL, 1, 127);");
			}
		}
		$i++;	
	}*/
	
	/*echo '<form method="post" action="/bag.php?gft">';
	$i = 8307;
	while( $i <= 8460 ) {
		$itm = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`img` FROM `items_main` WHERE `id` = "'.$i.'" LIMIT 1'));
		if(isset($itm['id'])) {
			$nm1 = '';
			if(isset($_POST['itm'.$itm['id']])) {
				$nm1 = $_POST['itm'.$itm['id']];
				mysql_query('UPDATE `items_main` SET `name` = "'.mysql_real_escape_string($_POST['itm'.$itm['id']]).'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			}
			echo '<img src="http://img.likebk.com/i/items/'.$itm['img'].'"> <input type="text" value="'.$nm1.'" name="itm'.$itm['id'].'"><hr>';
		}
		$i++;
	}
	echo '<input type="submit" value="СОХРАНИТЬ"></form>';*/
	die();
}
	

	
if(isset($_GET['test'])) {
	$i = 0;
	$r = 1000000;
	while( $i <= 15 ) {
		$r += $r*0.07;
		$i++;
	}
	echo $r;
	die();
}

if(isset($_GET['go'])) {
	
	echo 'DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400*round((int)$_GET['go'])).'";';
	
	die();

}


if(isset($_GET['itmlist'])) {
	/*include('_incl_data/__config.php');
	define('GAME',true);
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__user.php');*/
	
	$sp = mysql_query('SELECT `item_id` , COUNT(*) AS `x` FROM `items_users` GROUP BY `item_id` ORDER BY `x` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		$itm = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.$pl['item_id'].'" LIMIT 1'));
		echo '<b>'.$itm['name'].'</b> - '.$pl['item_id'].' - '.$pl['x'].' шт.<br><br>';
	}
}

if(isset($_GET['com17'])) {

	
	function addPrem($uid) {
		$tmadd = 7;
		mysql_query('DELETE FROM `premium` WHERE `uid` = "'.$uid.'" LIMIT 1');
		mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$uid.'" AND `id_eff` = "435" AND `delete` = 0 LIMIT 1');
		$tmadd = $tmadd * 86400;
		mysql_query("INSERT INTO `eff_users` (`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`, `endtime`, `endfx`) VALUES (435, ".$uid.", 'LikeBk Gold', 'add_speedhp=150|add_speed_dungeon=50|add_speedmp=150|add_m10=10|add_m11=10|add_exp=100|add_sale_berez=100|add_sale_ekr_berez=100|add_za=10|add_zma=10', 777, ".(time()+$tmadd).", 0, '', 0, '0', 0, '', 1, -1, '0', 0, 1, '', 0, 0, 0, 1, 0, 0, 0);");
		mysql_query("INSERT INTO `premium` (`uid`, `name`, `type`, `time_delete`, `money`, `speed_Loc`, `speedHp`, `speedMp`, `addExp`, `addRep`, `ym_delay`, `yv_drop`, `speed_dunger`, `mfza`, `mf_yron`, `sale_prc`, `saleEkr_prc`, `Exp_zver`) VALUES (".$uid.", 'LikeBk Gold', 3, ".(time()+$tmadd).", 0, 30, 150, 150, 100, 50, 50, 2, 50, 10, 10, 100, 100, 100);");

	}

	/*$sp = mysql_query('SELECT `id` FROM `users` WHERE `real` > 0');
	while( $pl = mysql_fetch_array($sp) ) {
		//$u->addItem(6812,$pl['id'],'|nosale=1|sudba=1|notransfer=1');
		$test = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `timeUse` > "'.(time()).'" AND `uid` = "'.$pl['id'].'" AND `id_eff` = "435" AND `delete` = 0 LIMIT 1'));
		if(isset($test['id'])) {
			//echo $test['name'] . ' - '.$u->timeOut($test['timeUse']-time()).'<br>';
			mysql_query('UPDATE `eff_users` SET `timeUse` = `timeUse` + "'.(86400*7).'" WHERE `id` = "'.$test['id'].'" LIMIT 1');
			mysql_query('UPDATE `premium` SET `time_delete` = "'.($test['timeUse']+86400*7).'" WHERE `id` = "'.$test['id'].'" LIMIT 1');
		}else{
			addPrem($pl['id']);
		}
	}*/
	die();
}elseif(isset($_GET['itmgo1'])) {
	include('_incl_data/__config.php');
	define('GAME',true);
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__user.php');
	
	mysql_query('UPDATE `users` SET `money` = `money` + 1 WHERE `id` = 12345 LIMIT 1');
	
	die();
	
	$html = '';
	$x = 0;
	$x2 = 0;
	$sp = mysql_query('SELECT `id` FROM `users`');
	while( $pl = mysql_fetch_array($sp) ) {
		$uid = $pl['id'];
		//mysql_query('INSERT INTO `items_users_res` ( SELECT * FROM `items_users` WHERE `uid` = "'.$uid.'" AND `delete` = 0 AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `inSlot` = 0 AND ( `magic_inci` = 0 OR `magic_inci` = "" ) ) AND ( `magic_inc` = 0 OR `magic_inc` = "" ) ORDER BY `item_id` )');
		//mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$uid.'" AND `delete` = 0 AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `inSlot` = 0 AND ( `magic_inci` = 0 OR `magic_inci` = "" ) ) AND ( `magic_inc` = 0 OR `magic_inc` = "" )');
		$x++;
	}
	
	echo 'Обработано '.$x.' игроков!';
	
	die();
}elseif(isset($_GET['itmgo2'])) {
	include('_incl_data/__config.php');
	define('GAME',true);
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__user.php');
	
	$html = '';
	$x = 0;
	$x2 = 0;
	$sp = mysql_query('SELECT `id` FROM `users`');
	while( $pl = mysql_fetch_array($sp) ) {
		$uid = $pl['id'];
		//mysql_query('INSERT INTO `items_users` ( SELECT * FROM `items_users_res` WHERE `uid` = "'.$uid.'" AND `delete` = 0 AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `inSlot` = 0 AND ( `magic_inci` = 0 OR `magic_inci` = "" ) ) AND ( `magic_inc` = 0 OR `magic_inc` = "" ) ORDER BY `item_id` )');
		//mysql_query('DELETE FROM `items_users_res` WHERE `uid` = "'.$uid.'" AND `delete` = 0 AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `inSlot` = 0 AND ( `magic_inci` = 0 OR `magic_inci` = "" ) ) AND ( `magic_inc` = 0 OR `magic_inc` = "" )');
		$x++;
	}
	
	echo 'Обработано '.$x.' игроков!';
	
	die();
}elseif(isset($_GET['itm'])) {
	include('_incl_data/__config.php');
	define('GAME',true);
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__user.php');
	
	$html = '';
	$x = 0;
	$x2 = 0;
	$sp = mysql_query('SELECT `item_id` , COUNT(`id`) AS `x` FROM `items_users` GROUP BY `item_id` ORDER BY `x` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$pl['item_id'].'" LIMIT 1'));
		$html .= '['.$itm['type'].'] <b>'.$itm['name'].'</b> (id '.$itm['id'].') - '.$pl['x'].' шт.<br>';
		if( $itm['inslot'] == 0 ) {
			$x2 += $pl['x'];
		}
		$x += $pl['x'];
	}
	
	echo 'Всего предметов: '.$x.'<br>Ресурсы: '.$x2.'<hr>';
	echo $html;
	
	die();
}elseif(isset($_GET['comp'])) {
	include('_incl_data/__config.php');
	define('GAME',true);
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__user.php');

	$sp = mysql_query('SELECT `id` FROM `users` WHERE `real` > 0');
	while( $pl = mysql_fetch_array($sp) ) {
		//$u->addItem(6812,$pl['id'],'|nosale=1|sudba=1');
		$i = 0;
		while( $i < 10 ) {
		//	$u->addItem(8024,$pl['id'],'|nosale=1|sudba=1');
			$i++;
		}
	}
	
	die();
}

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');

if(isset($_GET['list'])) {
	$sp = mysql_query('SELECT * FROM `users` WHERE `win_p` > 0 ORDER BY `win_p` DESC LIMIT 100');
	while( $pl = mysql_fetch_array($sp) ) {
		echo '<div>'.$pl['login'].' ['.$pl['level'].'] - побед: '.$pl['win_p'].' - поражения: '.$pl['lose_p'].' - дата реги '.date('d.m.Y H:i',$pl['timereg']).'</div>';
	}
	die();
}

if(isset($_GET['list_cap'])) {
	$sp = mysql_query('SELECT * FROM `rep` ORDER BY `repcapitalcity` DESC LIMIT 100');
	while( $pl = mysql_fetch_array($sp) ) {
		$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$pl['id'].'" LIMIT 1'));
		echo '<div>'.$usr['login'].' ['.$usr['level'].'] - '.$pl['repcapitalcity'].' - дата реги '.date('d.m.Y H:i',$pl['timereg']).'</div>';
	}
	die();
}

/*if(isset($_GET['test123'])) {
	$users_delo = array(
	array( // row #0
		36885353,
		29,
	),
	array( // row #1
		44910116,
		11,
	),
	array( // row #2
		23282294,
		7,
	),
	array( // row #3
		33944649,
		5,
	),
	array( // row #4
		30001343,
		4,
	),
	array( // row #5
		14413,
		4,
	),
	array( // row #6
		446583,
		3,
	),
	array( // row #7
		35095467,
		3,
	),
	array( // row #8
		35035910,
		3,
	),
	array( // row #9
		38711520,
		3,
	),
	array( // row #10
		28494730,
		2,
	),
	array( // row #11
		36690656,
		2,
	),
	array( // row #12
		22386890,
		2,
	),
	array( // row #13
		2770750,
		2,
	),
	array( // row #14
		633227,
		2,
	),
	array( // row #15
		2021492,
		2,
	),
	array( // row #16
		23967618,
		2,
	),
	array( // row #17
		35962311,
		2,
	),
	array( // row #18
		19318569,
		1,
	),
	array( // row #19
		38281800,
		1,
	),
	array( // row #20
		42158830,
		1,
	),
	array( // row #21
		2378600,
		1,
	),
	array( // row #22
		43239095,
		1,
	),
	array( // row #23
		1747199,
		1,
	),
	array( // row #24
		1514373,
		1,
	),
	array( // row #25
		2115746,
		1,
	),
	array( // row #26
		37959909,
		1,
	),
	array( // row #27
		37393952,
		1,
	),
	array( // row #28
		13910171,
		1,
	),
	array( // row #29
		43745830,
		1,
	),
	array( // row #30
		19208005,
		1,
	),
	array( // row #31
		37211895,
		1,
	),
	array( // row #32
		45633430,
		1,
	),
	array( // row #33
		34799526,
		1,
	),
	array( // row #34
		634102,
		1,
	),
	array( // row #35
		24973957,
		1,
	),
	array( // row #36
		4938953,
		1,
	),
	array( // row #37
		39340510,
		1,
	),
	array( // row #38
		14624451,
		1,
	),
	array( // row #39
		35305781,
		1,
	),
	array( // row #40
		37952947,
		1,
	),
	array( // row #41
		41736098,
		1,
	),
	array( // row #42
		11716767,
		1,
	),
	array( // row #43
		37731988,
		1,
	),
	array( // row #44
		7945708,
		1,
	),
	array( // row #45
		14252583,
		1,
	),
	array( // row #46
		807123,
		1,
	),
	array( // row #47
		39562583,
		1,
	),
	array( // row #48
		34900700,
		1,
	),
	array( // row #49
		27969,
		1,
	),
	array( // row #50
		3458309,
		1,
	),
	array( // row #51
		7846912,
		1,
	),
	array( // row #52
		894267,
		1,
	),
	array( // row #53
		8077252,
		1,
	),
	array( // row #54
		39255876,
		1,
	),
	array( // row #55
		35818432,
		1,
	),
	array( // row #56
		8518768,
		1,
	),
	array( // row #57
		42109810,
		1,
	),
	array( // row #58
		33248552,
		1,
	),
	array( // row #59
		7303765,
		1,
	),
	array( // row #60
		26767782,
		1,
	),
	array( // row #61
		16646,
		1,
	),
	array( // row #62
		39729402,
		1,
	),
	array( // row #63
		671360,
		1,
	),
	array( // row #64
		37505204,
		1,
	),
	array( // row #65
		22695204,
		1,
	),
	array( // row #66
		39818578,
		1,
	),
	array( // row #67
		2954832,
		1,
	),
	array( // row #68
		3591314,
		1,
	),
);

	$i = 0;
	while( $i < count($users_delo) ) {
		mysql_query('UPDATE `rep` SET `hip` = `hip` + "'.($users_delo[$i][1]*100).'" WHERE `id` = "'.$users_delo[$i][0].'"');
		$i++;
	}


	die();	
}*/

?>