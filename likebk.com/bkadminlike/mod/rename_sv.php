<?php 
/* $dbgo = mysql_connect('localhost','root','');
mysql_select_db('crazy',$dbgo);
mysql_query('SET NAMES cp1251');*/

$dbgo = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
mysql_select_db('like_mainbd',$dbgo);
mysql_query('SET NAMES cp1251');

// include('../../_incl_data/__config.php');
include('../../_incl_data/__user.php');

// 	echo date('n');
// 	if(round(date('m')) >= 3 && round(date('m')) < 6) {
// 		echo 'false';
// 	}elseif(round(date('m')) >= 6 && round(date('m')) < 9) {
// 		echo 'false';
// 	}elseif(round(date('m')) >= 9 && round(date('m')) < 12) {
// 		echo 'false';
// 	}elseif(round(date('m')) == 12 || round(date('m')) < 3) {
// 		echo 'true';
// 	}else{
// 		echo 'false';
// 	}
// exit();
if($u->info['id'] == 155){ 
	echo "dfsdfsdfds";
	$den = date("m,01,Y");
	$den = explode(',', $den);
	$time = mktime(3,0,0,$den[0],$den[1],$den[2]);; 
	$user_delo = mysql_query('SELECT * FROM `users_delo` AS `usd` LEFT JOIN `users` AS `u` ON (`u`.`id` = `usd`.`uid`) WHERE `usd`.`type` = "777" AND `usd`.`time` >= "'.$time.'" ORDER BY `time` DESC');
	$coun = 1;
	$sum = 0;
	echo "<table id='tbl' border='1'>
			<tr>
				<td><b>№</b></td>
				<td><b>Логин:</b></td>
				<td><b>Текст:</b></td>
				<td><b>Дата:</b></td>
			</tr>";
	while ($delo = mysql_fetch_array($user_delo)) {
		$str = explode(' ', $delo['text']);
		echo '<tr><td>'.$coun.'</td><td><b>'.$delo['login'].'</b></td><td>'.$delo['text'].'</td><td>'.date('d.m.Y H:i', $delo['time']).'</td></tr>';
		$sum += $str[4];
		$coun++;
	}
	echo "</table>";
	echo '<br><b>Всего купили: '.$sum.' руб.</b>';
}


exit();

function lookStats($m)
{
	$ist = array();
	$di = explode('|',$m);
	$i = 0; $de = false;
	while($i<count($di))
	{
		$de = explode('=',$di[$i]);
		if(isset($de[0],$de[1]))
		{
			if(!isset($ist[$de[0]])) {
				$ist[$de[0]] = 0;
			}
			$ist[$de[0]] = $de[1];
		}
		$i++;
	}
	return $ist;
}

function impStats($m)
{
	$i = 0;
	$k = array_keys($m);
	$d = '';
	while($i<=count($k))
	{
		if($k[$i]!='')
		{
			$d .= $k[$i].'='.$m[$k[$i]].'|';
		}
		$i++;
	}
	$d = rtrim($d,'|');
	return $d;
}
function addItem($id, $uid, $md = null, $dn = null, $mxiznos = null, $nosudba = null, $plavka = null) {
	$rt = -1;
	$i = mysql_fetch_array(mysql_query('SELECT `im`.`id`,`im`.`name`,`im`.`img`,`im`.`type`,`im`.`inslot`,`im`.`2h`,`im`.`2too`,`im`.`iznosMAXi`,`im`.`inRazdel`,`im`.`price1`,`im`.`price2`,`im`.`pricerep`,`im`.`magic_chance`,`im`.`info`,`im`.`massa`,`im`.`level`,`im`.`magic_inci`,`im`.`overTypei`,`im`.`group`,`im`.`group_max`,`im`.`geni`,`im`.`ts`,`im`.`srok`,`im`.`class`,`im`.`class_point`,`im`.`anti_class`,`im`.`anti_class_point`,`im`.`max_text`,`im`.`useInBattle`,`im`.`lbtl`,`im`.`lvl_itm`,`im`.`lvl_exp`,`im`.`lvl_aexp` FROM `items_main` AS `im` WHERE `im`.`id` = "'.mysql_real_escape_string($id).'" LIMIT 1'));
	if(isset($i['id']))
	{
		$d = mysql_fetch_array(mysql_query('SELECT `id`,`items_id`,`data` FROM `items_main_data` WHERE `items_id` = "'.$i['id'].'" LIMIT 1'));		
		//новая дата
		$data = $d['data'];	
		if($i['ts']>0)
		{
			if( $nosudba == NULL ) {
				$ui = mysql_fetch_array(mysql_query('SELECT `id`,`login` FROM `users` WHERE `id` = "'.mysql_real_escape_string($uid).'" LIMIT 1'));
				$data .= '|sudba='.$ui['login'];
			}
		}
		if($md!=NULL)
		{
			  $data .= $md; 
			  $data = lookStats($data); // Если в функции имеются две одинаковых константы SROK?
			  $data = impStats($data);
		}


		if($dn!=NULL)
		{
			//предмет с настройками из подземелья
			if($dn['dn_delete']>0)
			{
				$i['dn_delete'] = 1;
			}
		}
		if($mxiznos > 0) {
			$i['iznosMAXi'] = $mxiznos;
		}
		$room = 'capitalcity';

		$ins = mysql_query('INSERT INTO `items_users` (`overType`,`item_id`,`uid`,`data`,`iznosMAX`,`geniration`,`magic_inc`,`maidin`,`lastUPD`,`time_create`,`dn_delete`) VALUES (
										"'.$i['overTypei'].'",
										"'.$i['id'].'",
										"'.$uid.'",
										"'.$data.'",
										"'.$i['iznosMAXi'].'",
										"'.$i['geni'].'",
										"'.$i['magic_inci'].'",
										"'.$room.'",
										"'.time().'",
										"'.time().'",
										"'.$i['dn_delete'].'")');
		if($ins)
		{
			$rt = mysql_insert_id();
			$ads = '';
			if($plavka != null) {
			  $ads = 'Расплавлен предмет : ['.$plavka.']';
			}
			//Записываем в личное дело что предмет получен
			// $ld = $this->addDelo(1,$uid,'&quot;<font color=#C65F00>AddItems.'.'capitalcity'.'</font>&quot;: Получен предмет &quot;<b>'.$i['name'].'</b>&quot; (x1) [#'.$i['iid'].']. '.$ads.'',time(),'capitalcity','AddItems.'.'capitalcity'.'',0,0);
		}else{
			$rt = 0;	
		}			
	}
	return $rt;
}
exit();
//2502 = 5053 = 2456 = 1171 = 2497 = 2472 = 5059 = 5065 = 2524 = 2535 = 5067 = 2114 = 5047 = 2463 = 2539 = 
$run = '(`iu`.`item_id` = "2502" OR `iu`.`item_id` = "5053" OR `iu`.`item_id` = "2456" OR `iu`.`item_id` = "1171" OR `iu`.`item_id` = "2497" OR `iu`.`item_id` = "2472" OR `iu`.`item_id` = "5059" OR `iu`.`item_id` = "5065" OR `iu`.`item_id` = "2524" OR `iu`.`item_id` = "2535" OR `iu`.`item_id` = "5067" OR `iu`.`item_id` = "2114" OR `iu`.`item_id` = "5047" OR `iu`.`item_id` = "2463" OR `iu`.`item_id` = "2539")';
//убираем руны у игроков
$items = mysql_query('SELECT `iu`.*,`im`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`)  WHERE `iu`.`delete` = "0" AND '.$run.' AND `iu`.`inOdet` != "0" AND `iu`.`uid` = "179363"');
//$items = mysql_query('SELECT `iu`.*,`im`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`)  WHERE `iu`.`delete` = "0" AND `iu`.`uid` = "179363" AND `iu`.`data` LIKE "%rune_lvl%" ');
//$items = mysql_query('SELECT `iu`.*,`im`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`)  WHERE `iu`.`delete` = "0" AND  `iu`.`data` LIKE "%rune_lvl=4%" ORDER BY `iu`.`uid` ASC');
//$items = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "155" AND `delete` = 0 AND (`1price` > 0 OR `2price` > 0)');
$coun = 1;
while ($it = mysql_fetch_array($items)) {
	echo $it['item_id'].'<br>';
	echo $coun.') '.$it['name'].'<br>';
	echo $it['data'].'<br>';
	$po = $u->lookStats($it['data']);
	
	$iro = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "2050" LIMIT 1'));
	$ro = $u->lookStats($iro['data']);
	$i = 0;
	while($i<count($u->items['add'])) {
		if(isset($ro['add_'.$u->items['add'][$i]])) {
			$po['add_'.$u->items['add'][$i]] -= $ro['add_'.$u->items['add'][$i]];
			if($po['add_'.$u->items['add'][$i]] == 0) {
				unset($po['add_'.$u->items['add'][$i]]);
			}
		}
		$i++;
	}	

	unset($po['rune'],$po['rune_id'],$po['rune_name'],$po['rune_lvl']);
	$po = $u->impStats($po);
	echo $po.'<br>';

	/*$up = mysql_query('UPDATE `items_users` SET `data` = "'.$po.'" WHERE `uid` = "'.$it['uid'].'" AND `item_id` = "'.$it['item_id'].'" AND `delete` = "0" ');
	if($up){
		echo 'true<br>';
	}
	if($up){
		mysql_query('UPDATE `bank` SET `money2` = `money2` + 4.99 WHERE `uid` = "'.$it['uid'].'"');
		echo "test";
	}*/
	$coun++;
}


exit();



function premiumGold($uid, $time){
	$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "435"'));
	$bonusT = $time;
	$bonus = array(
		"name"=>"LikeBk Gold",
		"speed_Loc" => "30",
		"speedHp" => "150",
		"speedMp" => "150",
		"addExp" => "100",
		"addRep" => "50",
		"ym_delay"=>"50",
		"yv_drop"=>"2",
		"speed_dunger"=>"50",
		"mfza"=>"10",
		"mf_yron"=>"10",
		"sale_prc"=>"100",
		"saleEkr_prc"=>"100",
		"Exp_zver"=>"100",
		"type"=>"3"
		);
	$res = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$uid.'"'));
	if($res['id']){
		$ins = mysql_query('UPDATE `premium` SET 
			`name` = "'.$bonus['name'].'",
			`type` = "'.$bonus['type'].'",
			`time_delete` = "'.(time()+$bonusT).'",
			`speed_Loc` = "'.$bonus['speed_Loc'].'",
			`speedHp` = "'.$bonus['speedHp'].'",
			`speedMp` = "'.$bonus['speedMp'].'",
			`addExp` = "'.$bonus['addExp'].'",
			`addRep` = "'.$bonus['addRep'].'",
			`ym_delay` = "'.$bonus['ym_delay'].'",
			`yv_drop` = "'.$bonus['yv_drop'].'",
			`speed_dunger` = "'.$bonus['speed_dunger'].'",
			`mfza` = "'.$bonus['mfza'].'",
			`mf_yron` = "'.$bonus['mf_yron'].'",
			`sale_prc` = "'.$bonus['sale_prc'].'",
			`saleEkr_prc` = "'.$bonus['saleEkr_prc'].'",
			`Exp_zver` = "'.$bonus['Exp_zver'].'",
			`money` = "0"
			WHERE `uid` = "'.$uid.'"');
	}
	else{
		$ins = mysql_query('INSERT INTO `premium` SET 
			`name` = "'.$bonus['name'].'",
			`uid` = "'.$uid.'", 
			`type` = '.$bonus['type'].',
			`time_delete` = "'.(time()+$bonusT).'",
			`speed_Loc` = "'.$bonus['speed_Loc'].'",
			`speedHp` = "'.$bonus['speedHp'].'",
			`speedMp` = "'.$bonus['speedMp'].'",
			`addExp` = "'.$bonus['addExp'].'",
			`addRep` = "'.$bonus['addRep'].'",
			`ym_delay` = "'.$bonus['ym_delay'].'",
			`yv_drop` = "'.$bonus['yv_drop'].'",
			`speed_dunger` = "'.$bonus['speed_dunger'].'",
			`mfza` = "'.$bonus['mfza'].'",
			`mf_yron` = "'.$bonus['mf_yron'].'",
			`sale_prc` = "'.$bonus['sale_prc'].'",
			`saleEkr_prc` = "'.$bonus['saleEkr_prc'].'",
			`Exp_zver` = "'.$bonus['Exp_zver'].'",
			`money` = "0" ');		
	}
	if($ins){
		$ef_us = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = '.$uid.' AND `delete` = "0" AND `overType` = "777"'));
		if($ef_us['overType'] == 777)
		{
			//убираем прошлые эффекты
			$goodUse = 0;
			$upd1 = mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$uid.'" AND `overType` = "777" AND `delete` = "0"');
			if($upd1)
			{
				$goodUse = 1;
			}
		}
		mysql_query('INSERT INTO `eff_users` (`uid`,`id_eff`,`data`,`name`,`overType`,`timeUse`,`x`,`no_Ace`) VALUES ("'.$uid.'","'.$eff['id2'].'","'.$eff['mdata'].'","'.$eff['mname'].'","777","'.(time()+$bonusT).'","1","1")');
		return true;
	}
	else{
		return false;
	}
}
function eliki($uid, $login){
	echo $uid.'<br>';
	//Зелье Жизни
	$re = addItem(4702,$uid,'|sudba='.$login.'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Зелье маны
	$re = addItem(5108,$uid,'|sudba='.$login.'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Нектар неуязвимости
	$re = addItem(2139,$uid,'|sudba='.$login.'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Нектар отрицания
	$re = addItem(2140,$uid,'|sudba='.$login.'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Нападение
	$re = addItem(865,$uid,'|sudba='.$login.'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Жажада жизни +5
	$re = addItem(3102,$uid,'|sudba='.$login.'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Защита от оружия
	$re = addItem(1001,$uid,'|sudba='.$login.'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Холодный разум
	$re = addItem(1460,$uid,'|sudba='.$login.'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Сокрушение
	$re = addItem(994,$uid,'|sudba='.$login.'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Нектар Великана
	$re = addItem(4037,$uid,'|sudba='.$login.'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Нектар предчувствия
	$re = addItem(4038,$uid,'|sudba='.$login.'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Нектар Разума
	$re = addItem(4039,$uid,'|sudba='.$login.'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Нектар змеи
	$re = addItem(4040,$uid,'|sudba='.$login.'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Бутерброд
	$re = addItem(5106,$uid,'|sudba='.$login.'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
}

//$users = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "Adm" '));
//echo $users['id'];
//echo "$users['id']";
//mysql_query('UPDATE `bank` SET `money2`= (`money2` - "30") WHERE `uid` = "'.$users['id'].'" LIMIT 1');

if($u->info['id'] == 155){
	
	// $user = array(4=>'Adm');
	$user = array(
		1=>'"SuNCHaSeR"',
		2=>'"Unknown"',
		3=>'"Nautika"',
		4=>'"Misteroy"',
		5=>'"Rouch"',
		6=>'"Пафтыч"',
		7=>'"Полковник"',
		8=>'"Хабарик"',
		9=>'"Эномай"',
		10=>'"WU-TANG CLAN"'
		);
	$i = 1;
	$users = mysql_query('SELECT * FROM `users` WHERE `login` IN('.implode(",", $user).')');
	while ($u = mysql_fetch_array($users)) {
		echo $u['login'].'<br>';
	}
	/*while ($i <= 10) {
		$users = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.$user[$i].'" '));
		if($i <= 3){
			if($i == 1){
				$ekr = 50;
			}elseif($i == 2){
				$ekr = 40;
			}elseif($i == 3){
				$ekr = 30;
			}
			$time = 2592000;
			// premiumGold($users['id'], $time);
			//eliki($users['id'],$users['login']);
			//mysql_query('UPDATE `bank` SET `money2`= `money2` - '.$ekr*2.' WHERE `uid` = "'.$users['id'].'" LIMIT 1');
		}else{
			$ekr = 15;
			$time = 604800;
			// premiumGold($users['id'], $time);
			//mysql_query('UPDATE `bank` SET `money2`= `money2` - '.$ekr*2.' WHERE `uid` = "'.$users['id'].'" LIMIT 1');
		}
		//echo $ekr;
		$bank = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$users['id'].'" '));
		$sum = $bank['money2'] - ($ekr*2);
		echo $users['login'].' = '.$sum.'<br>';
		$ins = mysql_query('UPDATE `bank` SET `money2`= '.$sum.' WHERE `uid` = "'.$users['id'].'" LIMIT 1');
		if($ins){
			echo $users['login'].'= yes<br>';
		}else{
			echo $users['login'].'= no<br>';
		}
		$i++;
	}*/
}

exit();
//

if($u->info['id'] == 33){
	$den = date("m,01,Y");
	$den = explode(',', $den);
	$time = mktime(3,0,0,$den[0],$den[1],$den[2]);; 
	$user_delo = mysql_query('SELECT * FROM `users_delo` AS `usd` LEFT JOIN `users` AS `u` ON (`u`.`id` = `usd`.`uid`) WHERE `usd`.`type` = "777" AND `usd`.`time` >= "'.$time.'" ORDER BY `time` DESC LIMIT 50');
	$coun = 1;
	$sum = 0;
	echo "<table id='tbl' border='1'>
			<tr>
				<td><b>№</b></td>
				<td><b>Логин:</b></td>
				<td><b>Текст:</b></td>
				<td><b>Дата:</b></td>
			</tr>";
	while ($delo = mysql_fetch_array($user_delo)) {
		$str = explode(' ', $delo['text']);
		echo '<tr><td>'.$coun.'</td><td><b>'.$delo['login'].'</b></td><td>'.$delo['text'].'</td><td>'.date('d.m.Y H:i', $delo['time']).'</td></tr>';
		$sum += $str[4];
		$coun++;
	}
	echo "</table>";
	// echo '<br><b>Всего купили: '.$sum.' руб.</b>';
}

$coun = 1;
$items_users = mysql_query('SELECT * FROM `eff_users` WHERE `delete` > 0 LIMIT 50000');
while ($it = mysql_fetch_array($items_users)) {
	echo $coun.'<br>';
	//mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$it['id'].'"');
	$coun++;
}


exit();

$user = mysql_query('SELECT * FROM `users` AS `us` LEFT JOIN `stats` AS `st` ON (`us`.`id` = `st`.`id`) WHERE `st`.`exp` >= 58000000 AND `st`.`exp` < 59000000');
while ($us = mysql_fetch_array($user)) {
	echo $us['login'].' = '.$us['exp'].'<br>';
	$a42 = 2;
	//$u->stats['s4'] += $a42;
	echo $us['stats'].'<br>';
	$tst2 = $u->lookStats($us['stats']);
	$tst2['s4'] += $a42;
	$us['stats'] = $u->impStats($tst2);
	echo $us['stats'].'<br>';
	//mysql_query('UPDATE `stats` SET `stats`="'.$us['stats'].'" WHERE `id` = "'.$us['id'].'" LIMIT 1');
}

exit();


$bot = mysql_query('SELECT * FROM `users` WHERE `pass` = "saintlucia" ');
$coun = 1;
while($us = mysql_fetch_array($bot)){
	if($us['level'] == 8){
		$win = rand(150, 200);
		$lose = rand(30, 100);
	}elseif($us['level'] == 9){
		$win = rand(300, 500);
		$lose = rand(200, 300);
	}elseif ($us['level'] == 10) {
		$win = rand(500, 700);
		$lose = rand(300, 500);
	}
	echo $coun.') '.$us['login'].'<br>';
	//echo $win.' = '.$lose.'<br>';
	//$up = mysql_query('UPDATE `users` SET `win` = "'.$win.'", `lose`="'.$lose.'"  WHERE `pass` = "saintlucia" AND `id` = "'.$us['id'].'" ');
	if($up){
		echo "true";
	}else{
		echo "false";
	}
	$coun++;
}


exit();


$item_main = mysql_query('SELECT * FROM `items_main` AS `im` LEFT JOIN `items_main_data` AS `imd` ON (`im`.`id` = `imd`.`items_id`) WHERE `im`.`id`="2522" ');
$coun = 1;
while ($it_m = mysql_fetch_array($item_main)) {
	echo $coun.') '.$it_m['name'].'<br>';
	echo $it_m['data'].'<br>';
	$po = lookStats($it_m['data']);
	unset($po['noremont']);
	$po = impStats($po);
	echo $po.'<br>';
	$item_us = mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "'.$it_m['items_id'].'"');
	$coun2=1;
	while ($it_us = mysql_fetch_array($item_us)) {
		echo $coun2.') '.$it_us['id'].'<br>';
		echo $it_us['data'].'<br>';
		$po2 = lookStats($it_us['data']);
		unset($po2['noremont']);
		$po2 = impStats($po2);
		//echo $po2.'<br>';
	//	$up = mysql_query('UPDATE `items_users` SET `data` = "'.$po2.'"  WHERE `id` = "'.$it_us['id'].'" ');
		$coun2++;
	}
	//$up = mysql_query('UPDATE `items_main_data` SET `data` = "'.$po.'"  WHERE `items_id` = "'.$it_m['items_id'].'" ');
	$coun++;
}

exit();

/*function premiumGold($uid){
	$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "435"'));
	$bonusT = 259200;
	$bonus = array(
		"name"=>"LikeBk Gold",
		"speed_Loc" => "30",
		"speedHp" => "150",
		"speedMp" => "150",
		"addExp" => "100",
		"addRep" => "50",
		"ym_delay"=>"50",
		"yv_drop"=>"2",
		"speed_dunger"=>"50",
		"mfza"=>"10",
		"mf_yron"=>"10",
		"sale_prc"=>"100",
		"saleEkr_prc"=>"100",
		"Exp_zver"=>"100",
		"type"=>"3"
		);
	$ins = mysql_query('INSERT INTO `premium` SET 
		`name` = "'.$bonus['name'].'",
		`uid` = "'.$uid.'", 
		`type` = "'.$bonus['type'].'",
		`time_delete` = "'.(time()+$bonusT).'",
		`speed_Loc` = "'.$bonus['speed_Loc'].'",
		`speedHp` = "'.$bonus['speedHp'].'",
		`speedMp` = "'.$bonus['speedMp'].'",
		`addExp` = "'.$bonus['addExp'].'",
		`addRep` = "'.$bonus['addRep'].'",
		`ym_delay` = "'.$bonus['ym_delay'].'",
		`yv_drop` = "'.$bonus['yv_drop'].'",
		`speed_dunger` = "'.$bonus['speed_dunger'].'",
		`mfza` = "'.$bonus['mfza'].'",
		`mf_yron` = "'.$bonus['mf_yron'].'",
		`sale_prc` = "'.$bonus['sale_prc'].'",
		`saleEkr_prc` = "'.$bonus['saleEkr_prc'].'",
		`Exp_zver` = "'.$bonus['Exp_zver'].'",
		`money` = "0" ');
	if($ins){
		mysql_query('INSERT INTO `eff_users` (`uid`,`id_eff`,`data`,`name`,`overType`,`timeUse`,`x`,`no_Ace`) VALUES ("'.$uid.'","'.$eff['id2'].'","'.$eff['mdata'].'","'.$eff['mname'].'","777","'.(time()+$bonusT).'","1","1")');
		return true;
	}
	else{
		return false;
	}
}*/

$users = mysql_query('SELECT * FROM `users` WHERE `id` > "1017615" AND `real` = "1" AND `level` > "0"');
$coun = 1;
while ($us = mysql_fetch_array($users)) {
	echo $coun.') '.$us['login'].'<br>';
	$premium = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$us['id'].'"'));
	if($premium['id']){
		echo "YES<br>";
	}else{
		echo "NO<br>";
		//premiumGold($us['id']);
	}
	$coun++;
}

exit();

// $item_main = mysql_query('SELECT * FROM `items_main` AS `im` LEFT JOIN `items_users` AS `it` ON (`im`.`id` = `it`.`item_id`) WHERE `im`.`name` = "Футболка БК" ');
$item_main = mysql_query('SELECT * FROM `items_main` WHERE `name` = "Футболка Равновесия" ');
$coun=1; 
while($it_m = mysql_fetch_array($item_main)){
	$item_us = mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "'.$it_m['id'].'"');
	echo $coun.') '.$it_m['name'].' = '.$it_m['id'].' износ = '.$it_m['iznosMAXi'].'<br>';
	$coun=1;
	while ($it_us = mysql_fetch_array($item_us)) {
		echo $coun2.') '.$it_us['id'].' износ = '.$it_us['iznosMAX'].'<br>';
		//$up = mysql_query('UPDATE `items_users` SET `iznosMAX` = "100"  WHERE `id` = "'.$it_us['id'].'" ');
		$coun2++;
	}
	//$up = mysql_query('UPDATE `items_main` SET `iznosMAXi` = "100"  WHERE `id` = "'.$it_m['id'].'" ');
	$coun++;
}
exit();


$items_shop = mysql_query('SELECT * FROM `items_main` AS `im` LEFT JOIN `items_shop` AS `ish` ON (`im`.`id` = `ish`.`item_id`) WHERE `ish`.`sid` = "777" AND `ish`.`kolvo` > "0" AND `ish`.`r` > "0" AND `ish`.`r` < "19"');
$coun = 1;
while($it_sh = mysql_fetch_array($items_shop)){
	echo $coun.') '.$it_sh['name'].' id='.$it_sh['r'].') iznos = '.$it_sh['iznosMAXi'].'<br>';
	$item_us = mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "'.$it_sh['id'].'"');
	$coun2=1;
	while ($it_us = mysql_fetch_array($item_us)) {
		echo '<span style="margin-left: 20px;">'.$coun2.') '.$it_us['id'].' износ = '.$it_us['iznosMAX'].'</span><br>';
		//$up = mysql_query('UPDATE `items_users` SET `iznosMAX` = "500"  WHERE `id` = "'.$it_us['id'].'" ');
		$coun2++;
	}
	//$up = mysql_query('UPDATE `items_main` SET `iznosMAXi` = "500"  WHERE `id` = "'.$it_sh['id'].'" ');
	$coun++;
}

exit();

$eff_users = mysql_query('SELECT * FROM `eff_users` WHERE `delete` = 0 AND (`id_eff` = "433" OR `id_eff` = "434" OR `id_eff` = "435")');
$coun = 1;
while($eff = mysql_fetch_array($eff_users)){
	$prem = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$eff['uid'].'"'));
	if($prem['time_delete'] < $eff['timeUse']){
		echo $coun.') '.$prem['name'].' = '.$eff['uid'].'<br>';
		echo date('d.m.Y H:i',$prem['time_delete']).' = '. date('d.m.Y H:i',$eff['timeUse']).'<br>';
		//$up = mysql_query('UPDATE `eff_users` SET `timeUse` = "'.$prem['time_delete'].'"  WHERE `id` = "'.$eff['id'].'" ');
		$coun++;
	}
}

/*$items_main = mysql_query('SELECT `im`.*,`imd`.* FROM `items_main` AS `im` LEFT JOIN `items_main_data` AS `imd` ON ( `im`.`id` = `imd`.`items_id`) WHERE `imd`.`data` LIKE "%sv_za=%" ');
$coun = 1;
while($it = mysql_fetch_array($items_main)){
	echo $coun.') '.$it['name'].'<br>'.$it['data'].'<br>';
	$str = str_replace('sv_za=', 'add_za=', $it['data']);
	echo $str.'<br>';
	$items_user = mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "'.$it['items_id'].'" AND `data` LIKE "%sv_za=%" ');
	$co = 1;
	while($us = mysql_fetch_array($items_user)){
		echo $co.') '.$us['uid'].'<br>'.$us['data'].'<br>';
		$str2 = str_replace('sv_za=', 'add_za=', $us['data']);
	echo $str2.'<br>';
		$co++;
		$coun++;
		// $up = mysql_query('UPDATE `items_users` SET `data` = "'.$str2.'"  WHERE `id` = "'.$us['id'].'" AND `uid` = "'.$us['uid'].'" ');
	}
	// $up = mysql_query('UPDATE `items_main_data` SET `data` = "'.$str.'"  WHERE `id` = "'.$it['id'].'" ');
	
	//mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$it['id'].'"');
	
}*/

/*$items_id = '`item_id` != "2530" AND `item_id` != "2531" AND `item_id` != "2532"';
$items_shop = mysql_query('SELECT * FROM `items_shop` AS `ish` LEFT JOIN `items_main_data` AS `imd` ON(`imd`.`items_id` = `ish`.`item_id`) LEFT JOIN `items_main` AS `im` ON(`im`.`id` = `ish`.`item_id`) WHERE `ish`.`sid` = "777" AND `ish`.`r` = "18" AND `ish`.`kolvo` > "0" AND '.$items_id.' ');
$coun = 1;
while ($it_sh = mysql_fetch_array($items_shop)) {
	$items = mysql_query('SELECT `iu`.* FROM `items_users` AS `iu` WHERE `iu`.`item_id` = "'.$it_sh['item_id'].'" AND `iu`.`delete` = "0" ');	
	echo '<br>-------------------------------<br>';
	echo $coun.') '.$it_sh['name'].'<br>';
	echo $it_sh['data'].'<br>';
	$po = $it_sh['data'].'|onlyart=1';
	echo $po.'<br>';
	//$po = $u->lookStats($it_sh['data']);
	//unset($po['noremont']);
	//$po = $u->impStats($po);
	//echo $po.'<br>';
	//$up = mysql_query('UPDATE `items_main_data` SET `data` = "'.$po.'" WHERE `items_id` = "'.$it_sh['item_id'].'" ');
	echo '<br>---<br>';
	$coun2 = 1;
	while ($it = mysql_fetch_array($items)) {
		echo $coun2.') <b>'.$it['uid'].'</b><br>';
		echo $it['data'].'<br>';
		$po2 = $it['data'].'|onlyart=1';
		echo $po2.'<br>';	
		// $po2 = $u->lookStats($it['data']);
		// unset($po2['noremont']);
		// $po2 = $u->impStats($po2);
		// echo $po2.'<br><br>';
		//$up2 = mysql_query('UPDATE `items_users` SET `data` = "'.$po2.'" WHERE `uid` = "'.$it['uid'].'" AND `item_id` = "'.$it['item_id'].'" AND `delete` = "0" ');
		$coun2++;
	}
	$coun++;
}*/


//убираем руны у игроков
//$items = mysql_query('SELECT `iu`.*,`im`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`)  WHERE `iu`.`delete` = "0" AND `iu`.`data` LIKE "%rune_lvl=4%" ');
//$items = mysql_query('SELECT `iu`.*,`im`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`)  WHERE `iu`.`delete` = "0" AND  `iu`.`data` LIKE "%rune_lvl=4%" ORDER BY `iu`.`uid` ASC');
//$items = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "155" AND `delete` = 0 AND (`1price` > 0 OR `2price` > 0)');
/*$coun = 1;
while ($it = mysql_fetch_array($items)) {
	echo $coun.') '.$it['name'].'<br>';
	echo $it['data'].'<br>';
	$po = $u->lookStats($it['data']);
	$iro = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$po['rune_id'].'" LIMIT 1'));
	$ro = $u->lookStats($iro['data']);
	$i = 0;
	while($i<count($u->items['add'])) {
		if(isset($ro['add_'.$u->items['add'][$i]])) {
			$po['add_'.$u->items['add'][$i]] -= $ro['add_'.$u->items['add'][$i]];
			if($po['add_'.$u->items['add'][$i]] == 0) {
				unset($po['add_'.$u->items['add'][$i]]);
			}
		}
		$i++;
	}	

	unset($po['rune'],$po['rune_id'],$po['rune_name'],$po['rune_lvl']);
	$po = $u->impStats($po);
	echo $it['item_id']."<br>";

	
	echo $po.'<br><br>';
	$up = mysql_query('UPDATE `items_users` SET `data` = "'.$po.'" WHERE `uid` = "'.$it['uid'].'" AND `item_id` = "'.$it['item_id'].'" AND `delete` = "0" ');
	if($up){
		mysql_query('UPDATE `bank` SET `money2` = `money2` + 4.99 WHERE `uid` = "'.$it['uid'].'"');
		echo "test";
	}
	$coun++;
}*/

/*$items = mysql_query('SELECT `iu`.*,`im`.*,`us`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) LEFT JOIN `users` AS `us` ON (`iu`.`uid` = `us`.`id`) WHERE `iu`.`delete` = "0" AND  `iu`.`data` LIKE "%rune_lvl=4%" ORDER BY `iu`.`uid` ASC ');
$coun = 1;
$name = '';
$c = 1;
while ($it = mysql_fetch_array($items)) {
	
	if($it['login'] == $name){
		echo $coun.')'.$it['login'].'<br>';
		//echo $it['name'].'<br>';
		//echo $it['data'].'<br><br>';
		$po = lookStats($it['data']);
		//$po['rune_id']
		unset($po['rune'],$po['rune_id'],$po['rune_name'],$po['rune_lvl']);
		$po = impStats($po);
		//echo $po.'<br><br>';
		$coun++;
		$name = $it['login'];
	}else{
		echo "<br>-----".$c."-----<br>"; 
		$coun = 1;
		echo $coun.')'.$it['login'].'<br>';
		$coun++;
		$name = $it['login'];
		$c++;
	}

}*/

exit();
function  microLogin($id,$t,$nnz = 1)
{
	global $c;
	if($t==1)
	{
		$inf = mysql_fetch_array(mysql_query('SELECT 
		`u`.`id`,
		`u`.`align`,
		`u`.`login`,
		`u`.`clan`,
		`u`.`level`,
		`u`.`city`,
		`u`.`online`,
		`u`.`sex`,
		`u`.`cityreg`,
		`u`.`palpro`,
		`u`.`invis`,
		`st`.`hpNow` FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`id`="'.mysql_real_escape_string($id).'" OR `u`.`login` = "'.mysql_real_escape_string((int)$id).'" LIMIT 1'));
	}else{
		$inf = $id;
		$id = $inf['id'];
	}
	$r = '';
	if(isset($inf['id']) && ( ($inf['invis'] < time() && $inf['invis'] != 1) || ($this->info['id'] == $inf['id'] && $nnz == 1) ))
	{
		if($inf['align']>0)
		{
			$r .= '<img width="12" height="15" src="http://img.likebk.com/i/align/align'.$inf['align'].'.gif" />';
		}
		if($inf['clan']>0)
		{
			$cln = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`name_mini`,`align`,`type_m`,`money1`,`exp` FROM `clan` WHERE `id` = "'.$inf['clan'].'" LIMIT 1'));
			if(isset($cln['id']))
			{
				$r .= '<img width="24" height="15" src="http://img.likebk.com/i/clan/'.$cln['name_mini'].'.gif" />';
			}
		}
		if($inf['cityreg'] == '') {
			$inf['cityreg'] = 'capitalcity';
		}
		$r .= ' <b>'.$inf['login'].'</b> ['.$inf['level'].']<a target="_blank" href="/inf.php?'.$inf['id'].'"><img rel="tooltip" title="Инф. о '.$inf['login'].'" src="http://img.likebk.com/i/inf_'.$inf['cityreg'].'.gif" /></a>';	
	}else{
		// $r = '<b><i>Невидимка</i></b> [??]<a target="_blank" href="/inf.php?0"><img rel="tooltip" title="Инф. о &lt;i&&gt;Невидимка&lt;/i&gt;" src="http://img.likebk.com/i/inf_capitalcity.gif" /></a>';	
	}
	return $r;
}

$otdels_small_array = array (
				1050=>'<b>Отдел&nbsp;&quot;Прочие предметы&quot;</b>',
				1=>'<b>Отдел&nbsp;&quot;Оружие: кастеты,ножи&quot;</b>',
				2=>'<b>Отдел&nbsp;&quot;Оружие: топоры&quot;</b>',
				3=>'<b>Отдел&nbsp;&quot;Оружие: дубины,булавы&quot;</b>',
				4=>'<b>Отдел&nbsp;&quot;Оружие: мечи&quot;</b>',
				5=>'<b>Отдел&nbsp;&quot;Оружие: магические посохи&quot;</b>',
				6=>'<b>Отдел&nbsp;&quot;Одежда: сапоги&quot;</b>',
				7=>'<b>Отдел&nbsp;&quot;Одежда: перчатки&quot;</b>',
				8=>'<b>Отдел&nbsp;&quot;Одежда: рубахи&quot;</b>',
				28=>'<b>Отдел&nbsp;&quot;Одежда: плащи&quot;</b>',
				9=>'<b>Отдел&nbsp;&quot;Одежда: легкая броня&quot;</b>',
				10=>'<b>Отдел&nbsp;&quot;Одежда: тяжелая броня&quot;</b>',
				11=>'<b>Отдел&nbsp;&quot;Одежда: шлемы&quot;</b>',
				12=>'<b>Отдел&nbsp;&quot;Одежда: наручи&quot;</b>',
				13=>'<b>Отдел&nbsp;&quot;Одежда: пояса&quot;</b>',
				14=>'<b>Отдел&nbsp;&quot;Одежда: поножи&quot;</b>',
				15=>'<b>Отдел&nbsp;&quot;Щиты&quot;</b>',
				16=>'<b>Отдел&nbsp;&quot;Ювелирные товары: серьги&quot;</b>',
				17=>'<b>Отдел&nbsp;&quot;Ювелирные товары: ожерелья&quot;</b>',
				18=>'<b>Отдел&nbsp;&quot;Ювелирные товары: кольца&quot;</b>',
				19=>'<b>Отдел&nbsp;&quot;Заклинания: нейтральные&quot;</b>',
				20=>'<b>Отдел&nbsp;&quot;Заклинания: боевые и защитные&quot;</b>',
				50=>'<b>Отдел&nbsp;&quot;Заклинания: исцеляющие&quot;</b>',
				55=>'<b>Отдел&nbsp;&quot;Заклинания: манящие&quot;</b>',
				56=>'<b>Отдел&nbsp;&quot;Заклинания: тактические&quot;</b>',
				51=>'<b>Отдел&nbsp;&quot;Руны: Уникальные руны&quot;</b>',
				57=>'<b>Отдел&nbsp;&quot;Руны: I-го уровня&quot;</b>',
				58=>'<b>Отдел&nbsp;&quot;Руны: II-го уровня&quot;</b>',
				59=>'<b>Отдел&nbsp;&quot;Руны: III-го уровня&quot;</b>',
				60=>'<b>Отдел&nbsp;&quot;Чарки&quot;</b>',
				61=>'<b>Отдел&nbsp;&quot;Чарки: I-го уровня&quot;</b>',
				62=>'<b>Отдел&nbsp;&quot;Чарки: II-го уровня&quot;</b>',
				52=>'<b>Отдел&nbsp;&quot;Чарки: III-го уровня&quot;</b>',
				21=>'<b>Отдел&nbsp;&quot;Амуниция&quot;</b>',
				36=>'<b>Отдел&nbsp;&quot;Амуниция: эликсиры&quot;</b>',
				37=>'<b>Отдел&nbsp;&quot;Амуниция: еда&quot;</b>');

$coun = 1;
$user = mysql_query('SELECT * FROM `battle_users` WHERE `battle` = "91226"');
while($us = mysql_fetch_array($user)){
	//mysql_query('UPDATE `battle_users` SET `finish` = "1" WHERE `id` = "'.$us['id'].'"'); 
}


/*$coun = 1;
$level = 11;
    echo "<table id='tbtets' border='1'><tr><td align='center'>";
    echo "№</td>
        <td>Логин</td>
        <td align='center'>Опыта</td>
        <td align='center'>Онлайн</td></tr>";
//$user = mysql_query('SELECT `u`.*,`st`.* FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`real` = "1" AND `u`.`level` > "7"');
$user = mysql_query('SELECT `us`.*,`st`.* FROM `users` AS `us` LEFT JOIN `stats` AS `st` ON (`us`.`id` = `st`.`id`) WHERE `st`.`bot` = "0" AND `us`.`real` = "1" AND `us`.`level` > "7" ORDER BY `st`.`exp` DESC');
while ($us = mysql_fetch_array($user)) {
	if($level > $us['level']){
		$coun = 1;
		$level = $us['level'];
		echo "<tr><td>--</td><td>----------</td><td>-------</td><td>------</td></tr>";
	}
	//echo $coun.") ".microLogin($us['id'],1).'  ОПЫТ = '.$us['exp']."<br>";
	echo "<tr><td>".$coun."</td>";
        echo "<td>".microLogin($us['id'],1)."</td>";
        echo "<td>".$us['exp']."</td>";
        if($us['online'] > (time() - 520)){
            $onl = "<font color='green'><b>Онлайн</b></font>";
        }else{
            $onl = 'Последний раз заходил: '.date('d.m.Y H:i',$us['online']).'<img title="Время сервера" src="http://img.likebk.com/i/clok3_2.png">';
            $out = '';
            $time_still = time()-$us['online'];
            $tmp = floor($time_still/2592000);
            $id=0;
            if ($tmp > 0) { 
                $id++;
                if ($id<3) {$out .= $tmp." мес. ";}
                $time_still = $time_still-$tmp*2592000;
            }
            $tmp = floor($time_still/604800);
            if ($tmp > 0) { 
            $id++;
            if ($id<3) {$out .= $tmp." нед. ";}
            $time_still = $time_still-$tmp*604800;
            }
            $tmp = floor($time_still/86400);
            if ($tmp > 0) { 
                $id++;
                if ($id<3) {$out .= $tmp." дн. ";}
                $time_still = $time_still-$tmp*86400;
            }
            $tmp = floor($time_still/3600);
            if ($tmp > 0) { 
                $id++;
                if ($id<3) {$out .= $tmp." ч. ";}
                $time_still = $time_still-$tmp*3600;
            }
            $tmp = floor($time_still/60);
            if ($tmp > 0) { 
                $id++;
                if ($id<3) {$out .= $tmp." мин. ";}
            }
            if($out=='')
            {
                $out = $time_still.' сек.';
            }
            $onl .= '<br>('.$out.' назад)';
        }
        echo "<td>".$onl."</td>";
        echo "</tr>";
	$coun++;
}
echo "</table>";*/
//очистка с таблицы items_users
/*$it_shop = mysql_query('SELECT * FROM `users` WHERE `real` = 0');
$coun = 1;
while ($svit_it = mysql_fetch_array($it_shop)) {
	echo $coun.") ".$svit_it['login']."-".$svit_it['id']."<br>";
	$test[0]= mysql_fetch_array(mysql_query('SELECT * FROM `aaa_birthday` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[1]= mysql_fetch_array(mysql_query('SELECT * FROM `aaa_bonus` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[2]= mysql_fetch_array(mysql_query('SELECT * FROM `aaa_dialog_vars` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[3]= mysql_fetch_array(mysql_query('SELECT * FROM `aaa_znahar` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[4]= mysql_fetch_array(mysql_query('SELECT * FROM `actions` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[5]= mysql_fetch_array(mysql_query('SELECT * FROM `add_smiles` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[6]= mysql_fetch_array(mysql_query('SELECT * FROM `an_data` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[7]= mysql_fetch_array(mysql_query('SELECT * FROM `a_com_act` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[8]= mysql_fetch_array(mysql_query('SELECT * FROM `a_noob` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[9]= mysql_fetch_array(mysql_query('SELECT * FROM `a_system` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[10] = mysql_fetch_array(mysql_query('SELECT * FROM `a_vaucher` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[11] = mysql_fetch_array(mysql_query('SELECT * FROM `a_vaucher_active` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[12] = mysql_fetch_array(mysql_query('SELECT * FROM `bandit` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[13] = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[14] = mysql_fetch_array(mysql_query('SELECT * FROM `bank_alh` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[15] = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `uid1` = "'.$svit_it['id'].'" OR `uid2` = "'.$svit_it['id'].'"'));
			$test[16] = mysql_fetch_array(mysql_query('SELECT * FROM `battle_actions` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[17] = mysql_fetch_array(mysql_query('SELECT * FROM `battle_cache` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[18] = mysql_fetch_array(mysql_query('SELECT * FROM `battle_last` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[19] = mysql_fetch_array(mysql_query('SELECT * FROM `battle_stat` WHERE `uid1` = "'.$svit_it['id'].'" OR `uid2` = "'.$svit_it['id'].'"'));
			$test[20] = mysql_fetch_array(mysql_query('SELECT * FROM `battle_users` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[21] = mysql_fetch_array(mysql_query('SELECT * FROM `bid` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[22] = mysql_fetch_array(mysql_query('SELECT * FROM `bs_actions` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[23] = mysql_fetch_array(mysql_query('SELECT * FROM `bs_zv` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[24] = mysql_fetch_array(mysql_query('SELECT * FROM `building` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[25] = mysql_fetch_array(mysql_query('SELECT * FROM `buy_ekr` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[26] = mysql_fetch_array(mysql_query('SELECT * FROM `chat_ignore` WHERE `uid` = "'.$svit_it['id'].'" OR `login` = "'.$svit_it['login'].'"'));
			$test[27] = mysql_fetch_array(mysql_query('SELECT * FROM `complects_priem` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[28] = mysql_fetch_array(mysql_query('SELECT * FROM `dialog_act` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[29] = mysql_fetch_array(mysql_query('SELECT * FROM `dump` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[30] = mysql_fetch_array(mysql_query('SELECT * FROM `dungeon_actions` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[31] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[32] = mysql_fetch_array(mysql_query('SELECT * FROM `ekr_sale` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[33] = mysql_fetch_array(mysql_query('SELECT * FROM `feerverks` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[34] = mysql_fetch_array(mysql_query('SELECT * FROM `fontan` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[35] = mysql_fetch_array(mysql_query('SELECT * FROM `fontan_hp` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[36] = mysql_fetch_array(mysql_query('SELECT * FROM `fontan_text` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[37] = mysql_fetch_array(mysql_query('SELECT * FROM `friends` WHERE `user` = "'.$svit_it['id'].'"
			OR `friend` = "'.$svit_it['id'].'"
			OR `enemy` = "'.$svit_it['id'].'"
			OR `notinlist` = "'.$svit_it['id'].'"
			OR `ignor` = "'.$svit_it['id'].'"
			OR `login_ignor` = "'.$svit_it['login'].'"
			OR `user_ignor` = "'.$svit_it['login'].'"'));
			$test[38] = mysql_fetch_array(mysql_query('SELECT * FROM `house` WHERE `owner` = "'.$svit_it['id'].'"'));
			$test[39] = mysql_fetch_array(mysql_query('SELECT * FROM `items_img` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[40] = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[41] = mysql_fetch_array(mysql_query('SELECT * FROM `izlom_rating` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[42] = mysql_fetch_array(mysql_query('SELECT * FROM `laba_act` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[43] = mysql_fetch_array(mysql_query('SELECT * FROM `laba_itm` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[44] = mysql_fetch_array(mysql_query('SELECT * FROM `lastnames` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[45] = mysql_fetch_array(mysql_query('SELECT * FROM `logs_auth` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[46] = mysql_fetch_array(mysql_query('SELECT * FROM `loto_win` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[47] = mysql_fetch_array(mysql_query('SELECT * FROM `mults` WHERE `uid` = "'.$svit_it['id'].'" OR `uid2` = "'.$svit_it['id'].'"'));
			$test[48] = mysql_fetch_array(mysql_query('SELECT * FROM `notepad` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[49] = mysql_fetch_array(mysql_query('SELECT * FROM `obraz` WHERE `uid` = "'.$svit_it['id'].'" OR `login` = "'.$svit_it['login'].'"'));
			$test[50] = mysql_fetch_array(mysql_query('SELECT * FROM `online` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[51] = mysql_fetch_array(mysql_query('SELECT * FROM `pirogi` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[52] = mysql_fetch_array(mysql_query('SELECT * FROM `post` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[53] = mysql_fetch_array(mysql_query('SELECT * FROM `reimage` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[54] = mysql_fetch_array(mysql_query('SELECT * FROM `rep` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[55] = mysql_fetch_array(mysql_query('SELECT * FROM `repass` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[56] = mysql_fetch_array(mysql_query('SELECT * FROM `ruletka_coin` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[57] = mysql_fetch_array(mysql_query('SELECT * FROM `save_com` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[58] = mysql_fetch_array(mysql_query('SELECT * FROM `stats` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[59] = mysql_fetch_array(mysql_query('SELECT * FROM `transfers` WHERE `uid1` = "'.$svit_it['id'].'" OR `uid2` = "'.$svit_it['id'].'"'));
			$test[60] = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$svit_it['id'].'"'));
			$test[61] = mysql_fetch_array(mysql_query('SELECT * FROM `stats` WHERE `id` = "'.$svit_it['id'].'"'));
			$test[62] = mysql_fetch_array(mysql_query('SELECT * FROM `users_delo` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[63] = mysql_fetch_array(mysql_query('SELECT * FROM `users_animal` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[64] = mysql_fetch_array(mysql_query('SELECT * FROM `users_gifts` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[65] = mysql_fetch_array(mysql_query('SELECT * FROM `users_ico` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[66] = mysql_fetch_array(mysql_query('SELECT * FROM `users_reputation` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[67] = mysql_fetch_array(mysql_query('SELECT * FROM `users_turnirs` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[68] = mysql_fetch_array(mysql_query('SELECT * FROM `users_twink` WHERE `uid` = "'.$svit_it['id'].'"'));
			$test[69] = mysql_fetch_array(mysql_query('SELECT * FROM `zayavki` WHERE `creator` = "'.$svit_it['id'].'"'));
			$test[70] = mysql_fetch_array(mysql_query('SELECT * FROM `_clan` WHERE `uid` = "'.$svit_it['id'].'"'));
			$i=0; 
			while ($i < 71) {
				echo $i.') '.$test[$i]['id']."<br>";
				$i++;
			}
	//$bot = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$svit_it['uid'].'"'));
	//if($bot['real'] == 0){
		//echo $bot['login']." - ";
		//$sub_name = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$svit_it['item_id'].'"'));
		//mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$svit_it['id'].'"');
		//echo $coun.") <br>";	
		//mysql_query('UPDATE `users` SET `real` = 1 WHERE `id` = "'.$svit_it['uid'].'"'); 
		$coun++;
	//}
	//$sub_name = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$svit_it['item_id'].'"'));
	//mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$svit_it['id'].'"');
	//echo $sub_name['name']."<br>";
}*/
//6. Очистка личного дела
/*$coun = 1;
$up = mysql_query('SELECT * FROM `users_delo` WHERE `time` < "'.(time()-86400*11).'" ');
while ($up2 = mysql_fetch_array($up)) {
	echo $coun.') '.$up2['id']."<br>";
	$coun++;
}*/
//mysql_query('DELETE FROM `users_delo` WHERE `time` < "'.(time()-86400*5).'" ');
//$items_user = mysql_query('SELECT `it`.*,`ish`.*,`im`.* FROM `items_users` AS `it` LEFT JOIN `items_shop` AS `ish` ON (`it`.`item_id` = `ish`.`item_id`) LEFT JOIN `items_main` AS `im` ON (`it`.`item_id` = `im`.`id`) WHERE `it`.`inShop` != "0" AND `it`.`delete` = "0" GROUP BY `it`.`item_id`');
//$where = '`im`.`type` != "31" AND `im`.`type` != "62"';
/*$items_user = mysql_query('SELECT `it`.*,`ish`.*,`im`.* FROM `items_users` AS `it` LEFT JOIN `items_shop` AS `ish` ON (`it`.`item_id` = `ish`.`item_id`) LEFT JOIN `items_main` AS `im` ON (`it`.`item_id` = `im`.`id`) WHERE '.$where.' AND `ish`.`item_id` IS NULL AND `it`.`inShop` = "30" AND `it`.`delete` = "0" GROUP BY `it`.`item_id`');

//$items_user = mysql_query('SELECT `it`.*,`ish`.*,`im`.* FROM `items_users` AS `it` LEFT JOIN `items_shop` AS `ish` ON (`it`.`item_id` = `ish`.`item_id`) LEFT JOIN `items_main` AS `im` ON (`it`.`item_id` = `im`.`id`) WHERE `ish`.`r` = "21" AND `ish`.`kolvo` > 0 AND `ish`.`sid` = "1" AND `it`.`inShop` = "30" AND `it`.`delete` = "0" GROUP BY `it`.`item_id`');
while ($it_us = mysql_fetch_array($items_user)) {
	//$user = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$it_us['item_id'].'"'));
	$it_main = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$it_us['item_id'].'"'));
	echo $coun.") ".$it_us['name']." ( id=".$it_us['item_id']." uid=".$it_us['uid'].")".$otdels_small_array[$it_us['r']]."=".$it_us['inShop']."<br>";
	echo $it_us['data']."<br>";
	$coun++;
}*/
/*$items_user = mysql_query('SELECT * FROM `items_shop` WHERE `kolvo` = 0 ');
while ($it_us = mysql_fetch_array($items_user)) {
	$it_main = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$it_us['item_id'].'"'));
	//$itm = mysql_query('SELECT * FROM `items_shop` WHERE `kolvo` > 0  AND `item_id` = '.$it_us['item_id'].'');
	//while ($i = mysql_fetch_array($itm)) {
	//	$it_m = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$i['item_id'].'"'));
		//echo "&nbsp;&nbsp;".$it_m['name']." level=".$it_m['level']."  id=".$it_m['id']."(sid=".$i['sid']."r=".$i['r'].")<br>";	
	//}
	//echo $coun.") ".$it_main['name']." level=".$it_main['level']."  id=".$it_main['id']."(sid=".$it_us['sid']."r=".$it_us['r'].")<br>";
	//mysql_query('DELETE FROM `items_shop` WHERE `iid` = "'.$it_us['iid'].'"');
	$coun++;
}*/
/*$coun = 1;
$stat = mysql_query('SELECT * FROM `items_main_data`');
while ($svit_it = mysql_fetch_array($stat)) {
	$items_shop = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$svit_it['items_id'].'"'));
	$stats = explode('|', $svit_it['data']);
	echo $coun.") ".$items_shop['id']."=".$items_shop['name']." (".$items_shop['level'].")<br>";
	//echo $stat['data']."<br><br>";
	$sovp = array(
		"sv_"=>"sv_",
		"add_"=>"add_",
		"tr_"=>"tr_"
		);
	$text = '';
	foreach ($stats as $key => $value) {
		foreach ($sovp as $test) {
			$pos = strpos($value, $test);
			if ($pos === false) {
				$t = 0;
			}else{
				$t = 1;
				break;
			}
		}
		if($t == 0){
			$text .= $value."|";
		}
		/*else{
			$sam = explode("_", $value);
			//$text .= "add_".$sam[1]."|";
			$text .= "<span style='color: red;'>add_".$sam[1]."</span>|";
			//echo '<br>Подстрока найдена в позиции: '.$value;
		}*/
/*	}
	$text = trim($text,'|');
	echo $text;
	//mysql_query('UPDATE `items_main_data` SET `data` = "'.$text.'" WHERE `items_id` = "'.$svit_it['id'].'"'); 
	
	echo "<hr>";
	$coun++;
}*/

/*$coun = 1;
$it_shop = mysql_query('SELECT * FROM `items_shop` WHERE `sid` = 777 AND `kolvo` > 0');
while ($svit_it = mysql_fetch_array($it_shop)) {
	$stat = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$svit_it['item_id'].'"'));
 	$stats = explode('|', $stat['data']);
	$items_shop = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$svit_it['item_id'].'"'));
	echo $coun.") ".$items_shop['name']." (".$items_shop['level'].")<br>";
	echo $stat['data']."<br>";
	//mysql_query('UPDATE `items_main` SET `price1` = "'.$svit_it['price_1'].'", `price2` = "'.$svit_it['price_2'].'" WHERE `id` = "'.$svit_it['item_id'].'"'); 
	//echo "price shop = ".$items_shop['price_1'].' - '.$items_shop['price_2']."<br>";
	//mysql_query('UPDATE `items_shop` SET `price_1` = "'.$svit_it['price1'].'", `price_2`= "'.$svit_it['price2'].'"  WHERE `item_id` = "'.$svit_it['id'].'"'); 
	echo "<hr>";
	$coun++;
}*/

//очистка боев
/*$it_shop = mysql_query('SELECT * FROM `battle_users` WHERE `plus` = "0" AND `battle` < "104620"');
$coun = 1;
while ($svit_it = mysql_fetch_array($it_shop)) {
	//$bot = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$svit_it['uid'].'"'));
	//if($svit_it['plus'] ){
	//	echo $bot['login']." - ";
		//$sub_name = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$svit_it['item_id'].'"'));
		//mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$svit_it['id'].'"');
		//echo $coun.") <br>";	
		//mysql_query('UPDATE `battle_users` SET `plus` = "1" WHERE `id` = "'.$svit_it['id'].'"'); 
		echo $coun.") ".date('d.m.Y H:i', $svit_it['time_enter']).' - ';
		echo $svit_it['login']."<br>";	
		$coun++;
	//}
	//$sub_name = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$svit_it['item_id'].'"'));
	//mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$svit_it['id'].'"');
	//echo $sub_name['name']."<br>";
}*/

/*$it_shop = mysql_query('SELECT * FROM `items_main` WHERE `type` < "28"');
$coun = 1;
while ($svit_it = mysql_fetch_array($it_shop)) {
	//$items_shop = mysql_fetch_array(mysql_query('SELECT * FROM `items_shop` WHERE `item_id` = "'.$svit_it['id'].'"'));
	$stat = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$svit_it['id'].'"'));
 	$stats = explode('|', $stat['data']);
	echo $coun.") ".$svit_it['name']." (".$svit_it['level'].")<br>";
	echo $stat['data']."<br><br>";
	$sovp = array(
		"sv_za"=>"sv_za",
		"sv_zma"=>"sv_zma",
		"sv_a1"=>"sv_a1",
		"sv_a2"=>"sv_a2",
		"sv_a3"=>"sv_a3",
		"sv_a4"=>"sv_a4",
		"sv_pa1"=>"sv_pa1",
		"sv_pa2"=>"sv_pa2",
		"sv_pa3"=>"sv_pa3",
		"sv_pa4"=>"sv_pa4",
		"sv_m1"=>"sv_m1",
		"sv_m2"=>"sv_m2",
		"sv_m3"=>"sv_m3",
		"sv_m4"=>"sv_m4",
		"sv_m5"=>"sv_m5",
		"sv_m6"=>"sv_m6",
		"sv_m7"=>"sv_m7",
		"sv_m8"=>"sv_m8",
		"sv_m9"=>"sv_m9",
		"sv_m10"=>"sv_m10",
		"sv_m11"=>"sv_m11",
		"sv_m12"=>"sv_m12",
		"sv_m13"=>"sv_m13",
		"sv_m14"=>"sv_m14",
		"sv_m15"=>"sv_m15",
		"sv_m16"=>"sv_m16",
		"sv_m17"=>"sv_m17",
		"sv_m18"=>"sv_m18",
		"sv_m19"=>"sv_m19",
		"sv_m20"=>"sv_m20",
		);
	$text = '';
	foreach ($stats as $key => $value) {
		foreach ($sovp as $test) {
			//echo $value." = ".$test;
			//$ke = array_search($value, $sovp); 
			//echo $ke;
			$pos = strpos($value, $test);
			if ($pos === false) {
				$t = 0;
			}else{
				$t = 1;
				break;
			}
		}
		if($t == 0){
			$text .= $value."|";
		}
		else{
			$sam = explode("_", $value);
			$text .= "add_".$sam[1]."|";
			//$text .= "<span style='color: red;'>add_".$sam[1]."</span>|";
			//echo '<br>Подстрока найдена в позиции: '.$value;
		}
	}
	$text = trim($text,'|');
	echo $text;
	//mysql_query('UPDATE `items_main_data` SET `data` = "'.$text.'" WHERE `items_id` = "'.$svit_it['id'].'"'); 
	
	echo "<hr>";
	$coun++;
}
*/
//BillingExchange
/*
$bilex = mysql_query('SELECT * FROM `bank`');
while ($i = mysql_fetch_array($bilex)) {
	if($i['money2'] < 0){
		echo microLogin($i['uid'],1).'<br>';
	}
}
echo "Кто переводил: <br>";
$ex = mysql_query('SELECT * FROM `users_delo` WHERE `type` = "111" OR `type` = "222"');
while($j = mysql_fetch_array($ex)){
	if($j['uid'] != "155" && $j['uid'] != "33"){
		echo microLogin($j['uid'],1).'<br>'.$j['text']."<br>";
	}
}
*/
/*//очистка боев
$it_shop = mysql_query('SELECT * FROM `battle_users` WHERE `battle` < "10000"');
$coun = 1;
while ($svit_it = mysql_fetch_array($it_shop)) {
	//$bot = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$svit_it['uid'].'"'));
	//if($svit_it['plus'] ){
	//	echo $bot['login']." - ";
		//$sub_name = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$svit_it['item_id'].'"'));
		//mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$svit_it['id'].'"');
		//echo $coun.") <br>";	
		//mysql_query('UPDATE `battle_users` SET `plus` = "1" WHERE `id` = "'.$svit_it['id'].'"'); 
		echo $coun.") ".date('d.m.Y H:i', $svit_it['time_enter']).' - ';
		echo $svit_it['login']."<br>";	
		$coun++;
	//}
	//$sub_name = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$svit_it['item_id'].'"'));
	//mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$svit_it['id'].'"');
	//echo $sub_name['name']."<br>";
}*/
/*//очистка боев с текущих
$it_shop = mysql_query('SELECT * FROM `battle_users` WHERE `plus` = "0" AND `battle` < "63300"');
$coun = 1;
while ($svit_it = mysql_fetch_array($it_shop)) {
	//$bot = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$svit_it['uid'].'"'));
	//if($svit_it['plus'] ){
	//	echo $bot['login']." - ";
		//$sub_name = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$svit_it['item_id'].'"'));
		//mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$svit_it['id'].'"');
		//echo $coun.") <br>";	
		//mysql_query('UPDATE `battle_users` SET `plus` = "1" WHERE `id` = "'.$svit_it['id'].'"'); 
		echo $coun.") ".date('d.m.Y H:i', $svit_it['time_enter']).' - ';
		echo $svit_it['login']."<br>";	
		$coun++;
	//}
	//$sub_name = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$svit_it['item_id'].'"'));
	//mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$svit_it['id'].'"');
	//echo $sub_name['name']."<br>";
}*/
//очистка боев с текущих
/*$it_shop = mysql_query('SELECT * FROM `battle` WHERE `time_over` = "0" AND `id` < "37000"');
$coun = 1;
while ($svit_it = mysql_fetch_array($it_shop)) {
	//$bot = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$svit_it['uid'].'"'));
	//if($bot['pass'] == 'saintlucia' || $bot['pass'] == 'saintlucia5'){
	//	echo $bot['login']." - ";
		//$sub_name = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$svit_it['item_id'].'"'));
		//mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$svit_it['id'].'"');
		//echo $coun.") <br>";	
		//mysql_query('UPDATE `battle` SET `time_over` = "'.time().'" WHERE `id` = "'.$svit_it['id'].'"'); 
		//echo $coun.") ".$svit_it['id']."<br>";	
		$coun++;
	//}
	//$sub_name = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$svit_it['item_id'].'"'));
	//mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$svit_it['id'].'"');
	//echo $sub_name['name']."<br>";
}*/
//очистка с таблицы items_users
/*$it_shop = mysql_query('SELECT * FROM `items_users` WHERE `delete` != 0 ');
$coun = 1;
while ($svit_it = mysql_fetch_array($it_shop)) {
	//$bot = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$svit_it['uid'].'"'));
	//if($bot['pass'] == 'saintlucia' || $bot['pass'] == 'saintlucia5'){
		//echo $bot['login']." - ";
		//$sub_name = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$svit_it['item_id'].'"'));
		//mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$svit_it['id'].'"');
		echo $coun.") <br>";	
		//echo $coun.") ".$sub_name['name']."<br>";	
		$coun++;
	//}
	//$sub_name = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$svit_it['item_id'].'"'));
	//mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$svit_it['id'].'"');
	//echo $sub_name['name']."<br>";
}*/

/*$it_shop = mysql_query('SELECT * FROM `forum_msg_mod`');
$coun = 1;
while ($svit_it = mysql_fetch_array($it_shop)) {
	if($svit_it['id'] < 4340){
		echo $svit_it['id'].") ".$svit_it['login']."<br>";
		//mysql_query('DELETE FROM `forum_msg_mod` WHERE `id` = "'.$svit_it['id'].'"');
	}
}*/

/*$it_shop = mysql_query('SELECT * FROM `items_main` WHERE `type` = "30"');
$coun = 1;
while ($svit_it = mysql_fetch_array($it_shop)) {
	$items_shop = mysql_fetch_array(mysql_query('SELECT * FROM `items_shop` WHERE `item_id` = "'.$svit_it['id'].'"'));
	$stat = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$svit_it['id'].'"'));
 	$stats = explode('|', $stat['data']);
		echo $coun.") ".$svit_it['name']." (".$svit_it['level'].")<br>";
		echo '<img src="http://img.likebk.com/i/items/'.$svit_it['img'].'">';
		echo $svit_it['id']."<br>";
		echo $stat['data']."<br><br>";
		echo $svit_it['info'];
		echo "<hr>";
		$coun++;
	//echo "price main = ".$svit_it['price1'].' - '.$svit_it['price2']."<br>";
	//$res = '';
   // $res .= '`real` = "1", `kolvo` = "2000000000", `level` = "'.$svit_it['level'].'", `price_1` = "400", `price_2` = "4.99", `sid` = "2", `r` = "31", `item_id` = "'.$svit_it['id'].'"';
    //echo $res;
	//$ins = mysql_query('INSERT INTO `items_shop` SET '.$res.' ');
	//mysql_query('UPDATE `items_main` SET `price1` = "400", `price2` = "4.99" WHERE `id` = "'.$svit_it['id'].'"'); 
	//echo "price shop = ".$items_shop['price_1'].' - '.$items_shop['price_2']."<br>";
	//mysql_query('UPDATE `items_shop` SET `price_1` = "'.$svit_it['price1'].'", `price_2`= "'.$svit_it['price2'].'"  WHERE `item_id` = "'.$svit_it['id'].'"'); 
	// echo "<hr>";
	// $coun++;
}*/
/*$it_shop = mysql_query('SELECT * FROM `items_main` WHERE `type` = "46"');
$coun = 1;
while ($svit_it = mysql_fetch_array($it_shop)) {
	$items_shop = mysql_fetch_array(mysql_query('SELECT * FROM `items_shop` WHERE `item_id` = "'.$svit_it['id'].'"'));
	$stat = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$svit_it['id'].'"'));
 	$stats = explode('|', $stat['data']);
		echo $coun.") ".$svit_it['name']." (".$svit_it['level'].")<br>";
	//echo '<img src="http://img.likebk.com/i/items/'.$svit_it['img'].'">';
		echo $svit_it['id']."<br>";
		echo "price main = ".$svit_it['price1'].' - '.$svit_it['price2']."<br>";
		echo "price shop = ".$items_shop['price_1'].' - '.$items_shop['price_2'].' = '.$items_shop['price_3']."<br>";
		echo $svit_it['info'];
//mysql_query('UPDATE `items_shop` SET `price_1` = "'.$svit_it['price1'].'"  WHERE `item_id` = "'.$svit_it['id'].'"'); 
		echo "<hr>";
		$coun++;
	//echo "price main = ".$svit_it['price1'].' - '.$svit_it['price2']."<br>";
	//$res = '';
   // $res .= '`real` = "1", `kolvo` = "2000000000", `level` = "'.$svit_it['level'].'", `price_1` = "400", `price_2` = "4.99", `sid` = "2", `r` = "31", `item_id` = "'.$svit_it['id'].'"';
    //echo $res;
	//$ins = mysql_query('INSERT INTO `items_shop` SET '.$res.' ');
	//mysql_query('UPDATE `items_main` SET `price1` = "400", `price2` = "4.99" WHERE `id` = "'.$svit_it['id'].'"'); 
	//echo "price shop = ".$items_shop['price_1'].' - '.$items_shop['price_2']."<br>";
	//mysql_query('UPDATE `items_shop` SET `price_1` = "'.$svit_it['price1'].'", `price_2`= "'.$svit_it['price2'].'"  WHERE `item_id` = "'.$svit_it['id'].'"'); 
	// echo "<hr>";
	// $coun++;
}*/
/*$it_shop = mysql_query('SELECT * FROM `items_shop` WHERE `sid` = 2 AND `r` = "29" AND `kolvo` > 0');
while ($svit_it = mysql_fetch_array($it_shop)) {
	$items_shop = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$svit_it['item_id'].'"'));
	echo $coun.") ".$items_shop['name']." (".$items_shop['level'].")<br>";
	echo "price main = ".$svit_it['price_1'].' - '.$svit_it['price_2']."<br>";
	//mysql_query('UPDATE `items_main` SET `price1` = "'.$svit_it['price_1'].'", `price2` = "'.$svit_it['price_2'].'" WHERE `id` = "'.$svit_it['item_id'].'"'); 
	//echo "price shop = ".$items_shop['price_1'].' - '.$items_shop['price_2']."<br>";
	//mysql_query('UPDATE `items_shop` SET `price_1` = "'.$svit_it['price1'].'", `price_2`= "'.$svit_it['price2'].'"  WHERE `item_id` = "'.$svit_it['id'].'"'); 
	echo "<hr>";
	$coun++;
}*/
// $it_shop = mysql_query('SELECT * FROM `items_main` ORDER BY `id` DESC LIMIT 500');
// $coun = 1;
// while ($svit_it = mysql_fetch_array($it_shop)) {
// 	$text = '';
// 	$stat = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$svit_it['id'].'"'));
// 	$stats = explode('|', $stat['data']);
// 	$items_shop = mysql_fetch_array(mysql_query('SELECT * FROM `items_shop` WHERE `item_id` = "'.$svit_it['id'].'"'));
// 	if($items_shop['sid'] == 777){
// 		echo $coun.") ".$svit_it['name']." (".$svit_it['level'].")<br>";
// 		echo $stat['data']."<br>";
// 		$test = "mod_lvl";
// 		foreach ($stats as $key => $value) {
// 			$pos = strpos($value, $test);
// 			if ($pos === false) {
// 				$t = 0;
// 			}else{
// 				$t = 1;
// 				break;
// 			}
// 		}
// 		if($t == 0){
// 			$text .= $stat['data']."|mod_lvl=".$svit_it['level'];
// 		}
// 		//echo "<font color=red>".$text."</font><br>";
// 		//mysql_query('UPDATE `items_main_data` SET `data` = "'.$text.'" WHERE `items_id` = "'.$svit_it['id'].'"');
// 		$stats = explode('|', $stat['data']);
// 		echo "<hr>";
// 		$coun++;
// 	}
// 	/*if($svit_it['price1'] == 0 && $stat['price_1'] != 0){
// 		echo $coun.") ".$svit_it['name']." (".$svit_it['level'].")<br>";
// 		echo "price main = ".$svit_it['price1'].' - '.$svit_it['price2']."<br>";
// 		echo "price shop = ".$stat['price_1'].' - '.$stat['price_2']."<br>";
// 		//mysql_query('UPDATE `items_main` SET `price1` = "'.$stat['price_1'].'" WHERE `id` = "'.$svit_it['id'].'"'); 
// 		echo "<hr>";
// 		$coun++;
// 	}*/
// }


/*$it_shop = mysql_query('SELECT * FROM `items_main` ');
$coun = 1;
while ($svit_it = mysql_fetch_array($it_shop)) {
	$stat = mysql_fetch_array(mysql_query('SELECT * FROM `items_shop` WHERE `item_id` = "'.$svit_it['id'].'"'));
	//if($stat['price_2'] != 0){
		echo $coun.") ".$svit_it['name']." (".$svit_it['level'].")<br>";
		echo "price main = ".$svit_it['price1'].' - '.$svit_it['price2']."<br>";
		echo "price shop = ".$stat['price_1'].' - '.$stat['price_2'].' = '.$stat['price_3']."<br>";
		//mysql_query('UPDATE `items_main` SET `price2` = "'.$stat['price_3'].'" WHERE `id` = "'.$svit_it['id'].'"'); 
		echo "<hr>";
		$coun++;
	//}
	/*if($svit_it['price1'] == 0 && $stat['price_1'] != 0){
		echo $coun.") ".$svit_it['name']." (".$svit_it['level'].")<br>";
		echo "price main = ".$svit_it['price1'].' - '.$svit_it['price2']."<br>";
		echo "price shop = ".$stat['price_1'].' - '.$stat['price_2']."<br>";
		//mysql_query('UPDATE `items_main` SET `price1` = "'.$stat['price_1'].'" WHERE `id` = "'.$svit_it['id'].'"'); 
		echo "<hr>";
		$coun++;
	}*
}
*/
/*$it_shop = mysql_query('SELECT * FROM `items_main` ');

$coun = 1;
while ($svit_it = mysql_fetch_array($it_shop)) {
	$text = '';
	$cou = 1;
	$test = "ожив";
	$pos = strpos($svit_it['info'], $test);
	if ($pos === false) {
		$t = 0;
	}else{
		echo $coun.") ".$svit_it['name']." (".$svit_it['level'].")<br>";
		echo $svit_it['id'];
		echo $svit_it['info'];
		echo "<hr>";
		$coun++;
		//break;
	}
	//mysql_query('UPDATE `items_main` SET `level` = "3" WHERE `id` = "'.$svit_it['id'].'"'); 
	//mysql_query('UPDATE `items_main_data` SET `data` = "'.$text.'" WHERE `items_id` = "'.$svit_it['id'].'"'); 

}*/
//Смена параметров у рун
/*$it_shop = mysql_query('SELECT * FROM `items_main` WHERE `type` = "31" AND `level`="10" ORDER BY `info` ASC');

$coun = 1;
while ($svit_it = mysql_fetch_array($it_shop)) {
	$stat = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$svit_it['id'].'"'));
	$stats = explode('|', $stat['data']);
	echo $coun.") ".$svit_it['name']." (".$svit_it['level'].")<br>";
	echo $stat['data']."<br>";
	$text = '';
	$cou = 1;
	$test = "add_hpAll=50";
	//$test = "add_mpAll=50";
	foreach ($stats as $key => $value) {
		$pos = strpos($value, $test);
		if ($pos === false) {
			$t = 0;
		}else{
			$t = 1;
			//break;
		}
		if($t == 0){
			$text .= $value."|";
		}
		else{
			//$text .= "<span style='color: red;'>add_zma=15</span>|";
			$text .= "add_hpAll=100|";
			//$text .= "add_mpAll=100|";
		}
	}
	$text = trim($text,'|');
	echo $text."<br>";
	//mysql_query('UPDATE `items_main` SET `level` = "3" WHERE `id` = "'.$svit_it['id'].'"'); 
	//mysql_query('UPDATE `items_main_data` SET `data` = "'.$text.'" WHERE `items_id` = "'.$svit_it['id'].'"'); 
	echo "<hr>";
	$coun++;
}*/
//Добавление рун
/*$it_shop = mysql_query('SELECT * FROM `items_main` WHERE `type` = "31" AND `inslot`="1" ORDER BY `info` ASC');

$coun = 1;
while ($svit_it = mysql_fetch_array($it_shop)) {
	//$mas = array();
	$mas = $svit_it;
	$stat = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$svit_it['id'].'"'));
	$stats = explode('|', $stat['data']);
	echo $coun.") ".$svit_it['name']." (".$svit_it['level'].")<br>";
	echo $svit_it['inslot']."<br>";
	echo $svit_it['iznosMAXi']."<br>";
	echo $svit_it['inRazdel']."<br>";
	echo $svit_it['massa']."<br>";
	echo $svit_it['level']."<br>";
	echo $svit_it['ts']."<br>";
	echo $stat['data']."<br>";
	$test = "шлем";
	//$tst = "оружие";
	//$tst = "рубаха";
	//$tst = "плащ";
	$tst = "Щит";
	// $pos = strpos($svit_it['info'], $test);
	// if ($pos === false) {
	// 	$t = 0;
	// }else{
	// 	$t = 1;
	// 	$text .= "<span style='color: red;'>".$test."</span>";
	// 	break;
	// }
	$text = trim($text,'|');
	$inf ='';
	echo $svit_it['info']."<br>";
	$pos = strpos($svit_it['info'], $test);
	if ($pos === false) {
		$t = 0;
	}else{
		$t = 1;
		$sam = explode("(", $svit_it['info']);
		$inf = $sam[0]."(".$tst.")";
		//break;
	}
	echo "<hr>";
	//$mas['inslot'] = 3;
	//$mas['inslot'] = 4;
	//$mas['inslot'] = 6;
	$mas['inslot'] = 14;
	//echo $coun.") ".$mas['name']." (".$mas['level'].")<br>";
	echo $mas['name']."<br>
			".$mas['img']."<br>
			".$mas['inslot']."<br>
			".$mas['iznosMAXi']."<br>
			".$mas['inRazdel']."<br>
			".$mas['massa']."<br>
			".$mas['level']."<br>
			".$mas['ts']."<br>
			".$inf;
	// $ins = mysql_query('INSERT INTO `items_main` SET 
	// 	`name` = "'.mysql_real_escape_string($svit_it['name']).'",
	// 	`img` = "'.$svit_it['img'].'",
	// 	`type` = "'.$svit_it['type'].'", 
	// 	`inslot` = "'.$mas['inslot'].'",
	// 	`iznosMAXi` = "'.$svit_it['iznosMAXi'].'",
	// 	`inRazdel` = "'.$svit_it['inRazdel'].'",
	// 	`massa` = "'.$svit_it['massa'].'",
	// 	`level` = "'.$svit_it['level'].'",
	// 	`ts` = "'.$svit_it['ts'].'",
	// 	`info` = "'.$inf.'"
	// ');		

	// if($ins)
	// {
	// 	$id_r = mysql_insert_id();
	// 	mysql_query('INSERT INTO `items_main_data` SET 
	// 	`items_id` = "'.$id_r.'",
	// 	`data` = "'.$stat['data'].'"
	// ');		
	// 	echo "<br><br><br>YES".$id_r;
	// }else{
	// 	echo "Errror";	
	// }	
	
	//echo "<pre>";
	//print_r($svit_it);

	//mysql_query('UPDATE `items_main` SET `level` = "4" WHERE `id` = "'.$svit_it['id'].'"'); 
	//mysql_query('UPDATE `items_main_data` SET `data` = "'.$text.'" WHERE `items_id` = "'.$svit_it['id'].'"'); 
	echo "<hr>";
	$coun++;
}*/
/*$it_shop = mysql_query('SELECT * FROM `items_main` WHERE `level`="0" ORDER BY `info` ASC');
$coun = 1;
while ($svit_it = mysql_fetch_array($it_shop)) {
	$stat = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$svit_it['id'].'"'));
	$stats = explode('|', $stat['data']);
	echo $coun.") ".$svit_it['name']." (".$svit_it['level'].")<br>";
	echo $stat['data']."<br>";
	$test = "tr_lvl";
	$t = 0;
	$text = '';
	foreach ($stats as $key => $value) {
		$pos = strpos($value, $test);
		if ($pos === false) {
			$t = 0;
		}else{
			$t = 1;
			break;
		}
	}
	if($t == 1){
		$sam = explode("=", $value);
		$text = $sam[1];
	}
	else{
		$text = 0;
	}	
	echo $text;
	echo "<hr>";
	//mysql_query('UPDATE `items_main` SET `level` = "'.$text.'" WHERE `id` = "'.$svit_it['id'].'"'); 
	$coun++;
}*/
//смена уровней у рун
/*$it_shop = mysql_query('SELECT * FROM `items_main` WHERE `type` = "31" AND `level`="10" ORDER BY `info` ASC');

$coun = 1;
while ($svit_it = mysql_fetch_array($it_shop)) {
	$stat = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$svit_it['id'].'"'));
	$stats = explode('|', $stat['data']);
	echo $coun.") ".$svit_it['name']." (".$svit_it['level'].")<br>";
	echo $stat['data']."<br>";
	$slot = array(8=>"серьги", 
	 	9=>"ожерелье", 
	 	10=>"кольцо", 
	 	13=>"перчатки",
	 	16=>"поножи",
	 	17=>"обувь",
	 	1=>"шлем",
	 	2=>"наручи",
	 	5=>"броня",
	 	7=>"пояс");
	$text = '';
	$cou = 1;
	$test = "tr_lvl=7";
	foreach ($stats as $key => $value) {
		$pos = strpos($value, $test);
		if ($pos === false) {
			$t = 0;
		}else{
			$t = 1;
			//break;
		}
		if($t == 0){
			$text .= $value."|";
		}
		else{
			$text .= "tr_lvl=4|";
		}
	}
	// foreach ($slot as $key=>$test) {
	// 	$pos = strpos($svit_it['info'], $test);
	// 	if ($pos === false) {
	// 		$t = 0;
	// 	}else{
	// 		$t = 1;
	// 		$text .= "<span style='color: red;'>".$test."</span>";
	// 		break;
	// 	}
	// }
	$text = trim($text,'|');
	echo $text."<br>";
	//mysql_query('UPDATE `items_main` SET `level` = "4" WHERE `id` = "'.$svit_it['id'].'"'); 
	//mysql_query('UPDATE `items_main_data` SET `data` = "'.$text.'" WHERE `items_id` = "'.$svit_it['id'].'"'); 
	echo "<hr>";
	$coun++;
}*/



//Ставим слоты для свитков

// $it_shop = mysql_query('SELECT * FROM `items_main` WHERE `type` = "31"');

// $coun = 1;
// while ($svit_it = mysql_fetch_array($it_shop)) {
// 	//$stat = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$svit_it['id'].'"'));
// 	 echo $coun.") ".$svit_it['name']."<br>";
// 	 echo $svit_it['info']."<br>";
// 	 echo $svit_it['inslot']."<br>";
// 	$slot = array(8=>"серьги", 
// 	 	9=>"ожерелье", 
// 	 	10=>"кольцо", 
// 	 	13=>"перчатки",
// 	 	16=>"поножи",
// 	 	17=>"обувь",
// 	 	1=>"шлем",
// 	 	2=>"наручи",
// 	 	5=>"броня",
// 	 	7=>"пояс");
// 	$text = '';
// 	foreach ($slot as $key=>$test) {
// 		$pos = strpos($svit_it['info'], $test);
// 		if ($pos === false) {
// 			$t = 0;
// 		}else{
// 			$t = 1;
// 			$text .= $key;
// 			break;
// 		}
// 	}

// 	$coun++;
// 	$text = trim($text,'|');
// 	echo $text."<br>";
// 	//mysql_query('UPDATE `items_main` SET `inslot` = "'.$text.'" WHERE `id` = "'.$svit_it['id'].'"'); 
// 	echo "<hr>";
// }

//Удаление у свитков защит лишниъ
//$sub_name2 = mysql_query('SELECT * FROM `items_main`');
// $sub_name2 = mysql_query('SELECT * FROM `items_main` WHERE `type` = "31" ORDER BY `level` ASC  ');
// //$sub = mysql_query('SELECT * FROM `items_main_data` ORDER BY `items_id` ASC LIMIT 10');
// $coun = 1;
// while ($sub_nam = mysql_fetch_array($sub_name2)) {
// 	$sub = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$sub_nam['id'].'"'));
// 	//$sub_name = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$i['id'].'"'));
// 	$stats = explode('|', $sub['data']);
// 	//echo "<b>".$coun.") ".$sub_nam['name']."</b> : <br>";
// 		$sovp = array(
// 			"add_za1"=>"add_za1",
// 			"add_za2"=>"add_za2",
// 			"add_za3"=>"add_za3",
// 			"add_za4"=>"add_za4",
// 			"add_zm1"=>"add_zm1",
// 			"add_zm2"=>"add_zm2",
// 			"add_zm3"=>"add_zm3",
// 			"add_zm4"=>"add_zm4",
// 			"add_zm5"=>"add_zm5",
// 			"add_zm6"=>"add_zm6",
// 			"add_zm7"=>"add_zm7");
// 	$text = '';
// 	$id = '';
// 	foreach ($stats as $key => $value) {
// 		//echo $value."<br>";
// 		foreach ($sovp as $test) {
// 			$pos = strpos($value, $test);
// 			if ($pos === false) {
// 				$t = 0;
// 			}else{
// 				$t = 1;
// 				break;
// 			}
// 		}
// 		if($t == 0){
// 			//$text .= $value."|";
// 		}
// 		else{
// 			$text .= $value."|";
// 			$id .= "<b>".$coun.") ".$sub_nam['name']."</b> : <br>".$sub_nam['id']." - ".$value."<br><hr>";
// 			$coun++;
// 			//mysql_query('DELETE FROM `items_main_data` WHERE `items_id` = "'.$sub_nam['id'].'"');
// 			//mysql_query('DELETE FROM `items_main` WHERE `id` = "'.$sub_nam['id'].'"');
// 			//$text .= "<span style='color: red;'>add_".$sam[1]."</span>|";
// 			//echo '<br>Подстрока найдена в позиции: '.$value;
// 		}
// 	}
// 	$text = trim($text,'|');
// 	echo $id;
// 	//mysql_query('UPDATE `items_main_data` SET `data` = "'.$text.'" WHERE `items_id` = "'.$sub_nam['id'].'"'); 
	
// 	//echo "<hr>";
	
// }



//добавление мастерства для предметов
/*$sub_name2 = mysql_query('SELECT * FROM `items_main`');

//$sub = mysql_query('SELECT * FROM `items_main_data` ORDER BY `items_id` ASC LIMIT 10');
$coun = 1;
while ($sub_nam = mysql_fetch_array($sub_name2)) {
	$sub = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$sub_nam['id'].'"'));
	//$sub_name = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$i['id'].'"'));
	$stats = explode('|', $sub['data']);
	echo "<b>".$coun.") ".$sub_nam['name']."</b> : <br>";
		$sovp = array("sv_a1"=>"sv_a1","sv_a2"=>"sv_a2","sv_a3"=>"sv_a3","sv_a4"=>"sv_a4","sv_a5"=>"sv_a5","sv_a6"=>"sv_a6","sv_a7"=>"sv_a7","sv_aall"=>"sv_aall","sv_mall"=>"sv_mall","sv_m2all"=>"sv_m2all","sv_mg1"=>"sv_mg1","sv_mg2"=>"sv_mg2","sv_mg3"=>"sv_mg3","sv_mg4"=>"sv_mg4","sv_mg5"=>"sv_mg5","sv_mg6"=>"sv_mg6","sv_mg7"=>"sv_mg7");
	$text = '';
	foreach ($stats as $key => $value) {
		echo $value."<br>";
		foreach ($sovp as $test) {
			//echo $value." = ".$test;
			$ke = array_search($value, $sovp); 
			echo $ke;
			$pos = strpos($value, $test);
			if ($pos === false) {
				$t = 0;
			}else{
				$t = 1;
				break;
			}
		}
		if($t == 0){
			$text .= $value."|";
		}
		else{
			$sam = explode("_", $value);
			$text .= "add_".$sam[1]."|";
			//$text .= "<span style='color: red;'>add_".$sam[1]."</span>|";
			//echo '<br>Подстрока найдена в позиции: '.$value;
		}
	}
	$text = trim($text,'|');
	echo $text;
	//mysql_query('UPDATE `items_main_data` SET `data` = "'.$text.'" WHERE `items_id` = "'.$sub_nam['id'].'"'); 
	
	echo "<hr>";
	$coun++;
}*/



//Добавление арт, sudba, noremont, mod_lvl
/*$it_shop = mysql_query('SELECT * FROM `items_shop` WHERE `sid` = "777"');

$coun = 1;
while ($art_it = mysql_fetch_array($it_shop)) {
	$sub_name = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$art_it['item_id'].'"'));
	$stat = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$art_it['item_id'].'"'));
	echo $coun.") ".$sub_name['name']."<br>";
	$stats = explode('|', $stat['data']);
	$test = "art";
	$test2 = "sudba";
	$test3 = "noremont";
	$text = "";
	$t = 0;$t2 = 0;$t3 = 0;$t4 = 0;
	foreach ($stats as $key => $value) {
		//art
		$pos = strpos($value, $test);
		if ($pos === false) {
			$text .= $value."|";
		}else{
			$t = 1;
			$text .= $value."|";
		}
		//sudba
		$pos = strpos($value, $test2);
		if ($pos === false) {
			//$text .= $value."|";
		}else{
			$t2 = 1;
			//$text .= $value."|";
		}
		//noremont
		$pos = strpos($value, $test3);
		if ($pos === false) {
			//$text .= $value."|";
		}else{
			$t3 = 1;
			//$text .= $value."|";
		}
		$pos = strpos($value, "mod_lvl");
		if ($pos === false) {
			//$text .= $value."|";
		}else{
			$t4 = 1;
			//$text .= $value."|";
		}
		$pos = strpos($value, "tr_lvl");
		if ($pos === false) {
			
		}else{
			$mod_lvl = explode('=', $value);
		}
	}
	if($t == 0){
		$text = $text."art=1";
	}
	if($t2 == 0){
		$text = $text."|sudba=0";
	}
	if($t3 == 0){
		$text = $text."|noremont=1";
	}
	if($t4 == 0){
		$text = $text."|mod_lvl=".$mod_lvl[1];
	}
	$text = trim($text,'|');
	echo $text;
	//mysql_query('UPDATE `items_main_data` SET `data` = "'.$text.'" WHERE `items_id` = "'.$art_it['item_id'].'"'); 
	echo "<hr>";
	$coun++;
}*/
//Нельзя ремонтировать предметы
/*$it_shop = mysql_query('SELECT * FROM `items_main` WHERE `type` = "29" OR `type` = "30" OR `type` = "46"');

$coun = 1;
while ($art_it = mysql_fetch_array($it_shop)) {
	$stat = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$art_it['id'].'"'));
	echo $coun.") ".$art_it['name']."<br>";
	$stats = explode('|', $stat['data']);
	$test3 = "noremont";
	$text = "";
	$t = 0;$t2 = 0;$t3 = 0;$t4 = 0;
	foreach ($stats as $key => $value) {
		//echo $value;
		//noremont
		$pos = strpos($value, $test3);
		if ($pos === false) {
			$text .= $value."|";
		}else{
			$t3 = 1;
			$text .= $value."|";
		}
	}
	if($t3 == 0){
		$text = $text."|noremont=1";
	}
	$text = trim($text,'|');
	echo $text;
	//mysql_query('UPDATE `items_main_data` SET `data` = "'.$text.'" WHERE `items_id` = "'.$art_it['id'].'"'); 
	echo "<hr>";
	$coun++;
}*/

//Убирание требований у свитков серую магию и интелект
/*$it_shop = mysql_query('SELECT * FROM `items_main` WHERE `type` = "29"');
$it_shop = mysql_query('SELECT * FROM `items_main` WHERE `type` = "46"');

$coun = 1;
while ($art_it = mysql_fetch_array($it_shop)) {
	$stat = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$art_it['id'].'"'));
	echo $coun.") ".$art_it['name']."<br>";
	$stats = explode('|', $stat['data']);
	$sovp = array("tr_s5"=>"tr_s5","tr_mg7"=>"tr_mg7");
	echo $stat['data']."<br><br>";
	$text = '';
	foreach ($stats as $key => $value) {
		foreach ($sovp as $test) {
			//echo $value." = ".$test;
			//$ke = array_search($value, $sovp); 
			//echo $ke;
			$pos = strpos($value, $test);
			if ($pos === false) {
				$t = 0;
			}else{
				$t = 1;
				break;
			}
		}
		if($t == 0){
			$text .= $value."|";
		}

	}
	$text = trim($text,'|');
	echo $text;
	//mysql_query('UPDATE `items_main_data` SET `data` = "'.$text.'" WHERE `items_id` = "'.$art_it['id'].'"'); 
	echo "<hr>";
}*/

?>