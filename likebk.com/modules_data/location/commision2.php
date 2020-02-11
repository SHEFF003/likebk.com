<?php
if(!defined('GAME'))die();

header('location:/core/comission/');
die();

if($u->room['file']=='commision2'){
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
function itemsX($id,$uid = NULL, $item_id=NULL){
	$item = mysql_fetch_assoc(mysql_query('SELECT `iu`.`id`,`iu`.`item_id`,`iu`.`uid`,`iu`.`inGroup`,`iu`.`inShop` FROM `items_users` AS `iu` WHERE `iu`.`delete` = "0" AND `iu`.`id` = "'.((int)$id).'" LIMIT 1 '));
	if($item['inGroup'] == 0){
		$grp = ' LIMIT 1';
	} else {
		$grp = ' LIMIT 1000';
	}
	//$grp = ' LIMIT 1';
	$r = mysql_num_rows(mysql_query('SELECT `iu`.`id` FROM `items_users` AS `iu` WHERE `iu`.`inShop` = "'.$item['inShop'].'" AND `iu`.`item_id` = "'.$item['item_id'].'" AND `iu`.`uid` = "'.($item['uid']).'" AND `iu`.`delete` = "0" AND `iu`.`inGroup` = "'.($item['inGroup']).'" '.$grp.' '));
	/*
	$r = mysql_fetch_array(mysql_query('SELECT COUNT(`iu`.`id`) FROM `items_users` AS `iu` WHERE `iu`.`inShop` = "'.$item['inShop'].'" AND `iu`.`item_id` = "'.$item['item_id'].'" AND `iu`.`uid` = "'.($item['uid']).'" AND `iu`.`delete` = "0" AND `iu`.`inGroup` = "'.($item['inGroup']).'" '.$grp.' '));
	$r = $r[0];
	*/
	unset($item);
	return $r;
}
function timeOut($ttm)
{
	 	$out = '';
		$time_still = $ttm;
		$tmp = floor($time_still/2592000);
		$id=0;
		if ($tmp > 0) 
		{ 
			$id++;
			if ($id<3) {$out .= $tmp." мес. ";}
			$time_still = $time_still-$tmp*2592000;
		}
		$tmp = floor($time_still/86400);
		if ($tmp > 0) 
		{ 
			$id++;
			if ($id<3) {$out .= $tmp." дн. ";}
			$time_still = $time_still-$tmp*86400;
		}
		$tmp = floor($time_still/3600);
		if ($tmp > 0) 
		{ 
			$id++;
			if ($id<3) {$out .= $tmp." ч. ";}
			$time_still = $time_still-$tmp*3600;
		}
		$tmp = floor($time_still/60);
		if ($tmp > 0) 
		{ 
			$id++;
			if ($id<3) {$out .= $tmp." мин. ";}
		}
		if($out=='')
		{
			if($time_still<0)
			{
				$time_still = 0;
			}
			$out = $time_still.' сек.';
		}
		return $out;
}
function commisionShops($sid,$preview = "full"){
	global $c,$code,$sid, $svva3;
	$type = 0;
	switch ((int)$_GET['otdel']){
			case 1:$type = 18; break;
			case 2:$type = 19; break;
			case 3:$type = 20; break;
			case 4:$type = 21; break;
			case 5:$type = 22; break;
			case 6:$type = 15; break;
			case 7:$type = 12; break;
			case 8:$type = 4; break;
			case 28:$type = 7; break;
			case 9:$type = 5; break;
			case 10:$type = 6; break;
			case 11:$type = 1; break;
			case 12:$type = 3; break;
			case 13:$type = 8; break;
			case 14:$type = 14; break;
			case 15:$type = 13; break;
			case 16:$type = 9; break;
			case 17:$type = 10; break;
			case 18:$type = 11; break;
			case 36:$type = 30; break;
	}
	//Руны
	if($_GET['otdel'] == "57"){
		$typeotdel = '`im`.`type` = "31" AND `im`.`level` = "1"';
	}elseif($_GET['otdel'] == "58"){
		$typeotdel = '`im`.`type` = "31" AND `im`.`level` = "2"';
	}elseif($_GET['otdel'] == "59"){
		$typeotdel = '`im`.`type` = "31" AND `im`.`level` = "3"';
	}elseif($_GET['otdel'] == "51"){
		$typeotdel = '`im`.`type` = "31" AND `im`.`level` = "4"';
	}
	//чарки
	elseif($_GET['otdel'] == "60"){
		$typeotdel = '`im`.`type` = "62" AND `im`.`level` = "0"';
	}elseif($_GET['otdel'] == "61"){
		$typeotdel = '`im`.`type` = "62" AND `im`.`level` = "1"';
	}elseif($_GET['otdel'] == "62"){
		$typeotdel = '`im`.`type` = "62" AND `im`.`level` = "2"';
	}elseif($_GET['otdel'] == "52"){
		$typeotdel = '`im`.`type` = "62" AND `im`.`level` = "3"';
	}elseif($_GET['otdel'] == "21"){
		$typeotdel = '`ish`.`r` = "'.$_GET['otdel'].'" AND `ish`.`sid` = "1" AND `ish`.`kolvo` > 0 AND (`im`.`type` = "26" OR `im`.`type` = "45")';
	}elseif($_GET['otdel'] == "56"){
		$typeotdel = '`im`.`magic_inci` = "tactic"';
	}elseif((int)$_GET['otdel'] == "1050"){
		$typeotdel = '';
		$where = '`im`.`type` != "31" AND 
		`im`.`type` != "62" AND `im`.`type`!="18" AND 
		`im`.`type`!="19" AND `im`.`type`!="20" AND 
		`im`.`type`!="21" AND `im`.`type`!="22" AND 
		`im`.`type`!="15" AND `im`.`type`!="12" AND 
		`im`.`type`!="4" AND `im`.`type`!="7" AND 
		`im`.`type`!="5" AND `im`.`type`!="6" AND 
		`im`.`type`!="1" AND `im`.`type`!="3" AND 
		`im`.`type`!="8" AND `im`.`type`!="14" AND 
		`im`.`type`!="13" AND `im`.`type`!="9" AND 
		`im`.`type`!="10" AND `im`.`type`!="11" AND `im`.`type`!="30" AND `im`.`magic_inci` != "tactic"';
		//$where = '`im`.`type` != "31" AND `im`.`type` != "62" ';

	}	
	//Вещи
	else{
		if($type != 0){
			$typeotdel = '`im`.`type` = "'.$type.'"';
		}else{
			$typeotdel = '`ish`.`r` = "'.(int)$_GET['otdel'].'" AND (`ish`.`sid` = "1" OR `ish`.`sid` = "2") AND `ish`.`kolvo` > 0';
		}
	}
	if($typeotdel == ''){
		$cl = mysql_query('SELECT `it`.*,`ish`.*,`im`.* FROM `items_users` AS `it` LEFT JOIN `items_shop` AS `ish` ON (`it`.`item_id` = `ish`.`item_id`) LEFT JOIN `items_main` AS `im` ON (`it`.`item_id` = `im`.`id`) WHERE '.$where.' AND `ish`.`item_id` IS NULL AND `it`.`inShop` = "30" AND `it`.`delete` = "0" GROUP BY `it`.`item_id`');
	}else{
		$cl = mysql_query('SELECT `it`.*,`ish`.*,`im`.* FROM `items_users` AS `it` LEFT JOIN `items_shop` AS `ish` ON (`it`.`item_id` = `ish`.`item_id`) LEFT JOIN `items_main` AS `im` ON (`it`.`item_id` = `im`.`id`) WHERE '.$typeotdel.' AND `it`.`inShop` = "30" AND `it`.`delete` = "0" GROUP BY `it`.`item_id`');
	}

	$cr = 'c8c8c8';
		$i = 0;
	 	$steckCikl = 1;
		while($pl = mysql_fetch_array($cl)){
			//echo $pl['name']." ( id=".$pl['item_id']." uid=".$pl['uid'].")<br>";
			//$pl = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$pl2['item_id'].'"'));
			// количетсво одинаковых предметов в комке
		 	$steck = mysql_fetch_array(mysql_query('SELECT COUNT(`item_id`) FROM `items_users` WHERE `item_id` = "'.$pl['id'].'" AND `inShop` = 30 LIMIT 1'));
		 	$price_min_max = mysql_fetch_array(mysql_query('SELECT min(`1price`),max(`1price`) FROM `items_users` WHERE `item_id` = "'.$pl['id'].'" AND `inShop` = 30  GROUP BY `item_id` LIMIT 1'));
			$d = mysql_fetch_array(mysql_query('SELECT `id`,`items_id`,`data` FROM `items_main_data` WHERE `items_id` = "'.$pl['id'].'" LIMIT 1'));
			if($steck[0]>1 && $preview == "preview") {
				$po = lookStats($d['data']);
			} else {
				$po = lookStats($pl['data']);
			}
			$is2 = '';
			$is1 = '<img src="http://img.likebk.com/i/items/'.$pl['img'].'"><br>';
			$is1 .= '<a href="?otdel='.((int)$_GET['otdel']).'&toRent=3&itemid='.$pl['id'].' " >Просмотреть</a> ';
			$is2 .= '<a href="">'.$pl['name'].'</a> &nbsp; &nbsp;';
			//цена
			$is2 .= '<br><b>Цена: ';	 	 	 	 	 	 	 
			if($steck[0]>1 && $preview == "preview") {
				$is2 .= $price_min_max[0].'-'.$price_min_max[1].' кр.</b> ';
			} else {
				$is2 .= $pl['1price'].' кр.</b> ';
			}
			//долговечность
			if($pl['iznosMAX']>0){
				$izcol = '';
				if(floor($pl['iznosNOW'])>=(floor($pl['iznosMAX'])-ceil($pl['iznosMAX'])/100*20)){
					$izcol = 'brown';
				}
			} 
			$is2 .= '<br>Долговечность: <font color="'.$izcol.'"> 0 /'.ceil($pl['iznosMAX']).'</font>';
			//Срок годности предмета
			if($po['srok'] > 0){
				$pl['srok'] = $po['srok'];
			}
			if( $pl['srok'] > 0 AND $preview!="preview" ) {
				if( $pl['time_create']+$pl['srok'] < time() ){
					$is2 .= '<br>Срок годности: '.timeOut($pl['srok']).' (испорчен)';
				} else {
					$is2 .= '<br>Срок годности: '.timeOut($pl['srok']).' (до '.date('d.m.Y H:i',$pl['time_create']+$pl['srok']).')';
				}
			}
			if($pl['magic_chance'] > 0) {
				$is2 .= '<br>Вероятность срабатывания: '.min(array($pl['magic_chance'],100)).'%';
			}
			if($pl['info'] != ''){
				$is2 .= '<br><b>Описание:</b>'.$pl['info'];
 			}
			$kolvoprint = "<small style=\"float:right; color:grey;\" align=\"right\">Количество: <b>".$steck[0]."</b> шт.</small>";
			//echo $is1;
			echo '<tr style="background-color:#'.$cr.';">
			<td width="200" style="padding:7px;" valign="middle" align="center">'.$is1.'</td>
			<td style="padding:7px;" valign="top">'.$kolvoprint.$is2.'</td></tr>';
			$i++;
	 	}
		if($i==0) 
			echo '<tr style="background-color:#'.$cr.';"><td style="padding:7px;" align="center" valign="top">Прилавок магазина пуст</td></tr>';
}
function commisionShops2($sid,$preview = "full"){
	global $c,$code,$sid, $svva3;
	$itemid = (int)$_GET['itemid'];
	//Руны
	if($_GET['otdel'] == "57"){
		$typeotdel = '`im`.`type` = "31" AND `im`.`level` = "1"';
	}elseif($_GET['otdel'] == "58"){
		$typeotdel = '`im`.`type` = "31" AND `im`.`level` = "2"';
	}elseif($_GET['otdel'] == "59"){
		$typeotdel = '`im`.`type` = "31" AND `im`.`level` = "3"';
	}elseif($_GET['otdel'] == "51"){
		$typeotdel = '`im`.`type` = "31" AND `im`.`level` = "4"';
	}
	//чарки
	elseif($_GET['otdel'] == "60"){
		$typeotdel = '`im`.`type` = "62" AND `im`.`level` = "0"';
	}elseif($_GET['otdel'] == "61"){
		$typeotdel = '`im`.`type` = "62" AND `im`.`level` = "1"';
	}elseif($_GET['otdel'] == "62"){
		$typeotdel = '`im`.`type` = "62" AND `im`.`level` = "2"';
	}elseif($_GET['otdel'] == "52"){
		$typeotdel = '`im`.`type` = "62" AND `im`.`level` = "3"';
	}elseif($_GET['otdel'] == "21"){
		$typeotdel = '`ish`.`r` = "'.$_GET['otdel'].'" AND `ish`.`sid` = "1" AND `ish`.`kolvo` > 0 AND (`im`.`type` = "26" OR `im`.`type` = "45")';
	}elseif((int)$_GET['otdel'] == "1050"){
		$typeotdel = '(`ish`.`r` != 1 AND 
			`ish`.`r` != 2 AND `ish`.`r` != 3 AND 
			`ish`.`r` != 4 AND `ish`.`r` != 5 AND 
			`ish`.`r` != 6 AND `ish`.`r` != 7 AND 
			`ish`.`r` != 8 AND `ish`.`r` != 28 AND 
			`ish`.`r` != 9 AND `ish`.`r` != 10 AND 
			`ish`.`r` != 11 AND	`ish`.`r` != 12 AND 
			`ish`.`r` != 13 AND	`ish`.`r` != 14 AND 
			`ish`.`r` != 15 AND	`ish`.`r` != 16 AND 
			`ish`.`r` != 17 AND `ish`.`r` != 18 AND 
			`ish`.`r` != 19 AND `ish`.`r` != 20 AND 
			`ish`.`r` != 50 AND `ish`.`r` != 55 AND 
			`ish`.`r` != 56 AND `ish`.`r` != 51 AND 
			`ish`.`r` != 57 AND `ish`.`r` != 58 AND 
			`ish`.`r` != 59 AND `ish`.`r` != 60 AND 
			`ish`.`r` != 61 AND `ish`.`r` != 62 AND 
			`ish`.`r` != 52 AND `ish`.`r` != 21 AND 
			`ish`.`r` != 36 AND `ish`.`r` != 37 AND 
			`ish`.`kolvo` > 0)';
	}	
	//Вещи которых нету в гос маге
	else{
		$typeotdel = '`ish`.`r` = "'.(int)$_GET['otdel'].'" AND `ish`.`sid` = "1" AND `ish`.`kolvo` > 0';
	}
	$cl = mysql_query('SELECT `it`.*,`ish`.*,`im`.* FROM `items_users` AS `it` LEFT JOIN `items_shop` AS `ish` ON (`it`.`item_id` = `ish`.`item_id`) LEFT JOIN `items_main` AS `im` ON (`it`.`item_id` = `im`.`id`) WHERE '.$typeotdel.' AND `it`.`item_id` = "'.$itemid.'" AND `it`.`inShop` = "30" AND `it`.`delete` = "0"');

	$cr = 'c8c8c8';
	$i = 0;
 	$steckCikl = 1;
	while($pl = mysql_fetch_array($cl)){
		//echo $pl['name']." ( id=".$pl['item_id']." uid=".$pl['uid'].")<br>";
		//$pl = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$pl2['item_id'].'"'));
		// количетсво одинаковых предметов в комке
	 	//$steck = mysql_fetch_array(mysql_query('SELECT COUNT(`item_id`) FROM `items_users` WHERE `item_id` = "'.$pl['id'].'" AND `inShop` = 30 LIMIT 1'));
		//$d = mysql_fetch_array(mysql_query('SELECT `id`,`items_id`,`data` FROM `items_main_data` WHERE `items_id` = "'.$pl['id'].'" LIMIT 1'));
		//if($steck[0]>1 && $preview == "preview") {
		//	$po = lookStats($d['data']);
		//} else {
			$po = lookStats($pl['data']);
		//}
		$is2 = '';
		$is1 = '<img src="http://img.likebk.com/i/items/'.$pl['img'].'"><br>';
		$is1 .= '<a href="?otdel='.((int)$_GET['otdel']).'&toRent=3&itemid='.(INT)$_GET['itemid'].'&buy='.$pl[0].'&sd4='.$u->info['nextAct'].'&rnd='.$code.' " >купить</a> ';
		$is2 .= '<a href="">'.$pl['name'].'</a> &nbsp; &nbsp;';
		//цена
		$is2 .= '<br><b>Цена: ';	 	 	 	 	 	 	 
		$is2 .= $pl['1price'].' кр.</b> ';
		//долговечность
		if($pl['iznosMAX']>0){
			$izcol = '';
			if(floor($pl['iznosNOW'])>=(floor($pl['iznosMAX'])-ceil($pl['iznosMAX'])/100*20)){
				$izcol = 'brown';
			}
		} 
		$is2 .= '<br>Долговечность: <font color="'.$izcol.'"> 0 /'.ceil($pl['iznosMAX']).'</font>';
		//Срок годности предмета
		if($po['srok'] > 0){
			$pl['srok'] = $po['srok'];
		}
		if( $pl['srok'] > 0) {
			if( $pl['time_create']+$pl['srok'] < time() ){
				$is2 .= '<br>Срок годности: '.timeOut($pl['srok']).' (испорчен)';
			} else {
				$is2 .= '<br>Срок годности: '.timeOut($pl['srok']).' (до '.date('d.m.Y H:i',$pl['time_create']+$pl['srok']).')';
			}
		}
		if($pl['magic_chance'] > 0) {
			$is2 .= '<br>Вероятность срабатывания: '.min(array($pl['magic_chance'],100)).'%';
		}
		if($pl['info'] != ''){
			$is2 .= '<br><b>Описание:</b>'.$pl['info'];
		}
		echo '<tr style="background-color:#'.$cr.';">
		<td width="200" style="padding:7px;" valign="middle" align="center">'.$is1.'</td>
		<td style="padding:7px;" valign="top">'.$is2.'</td></tr>';
		$i++;
 	}
	if($i==0) 
		echo '<tr style="background-color:#'.$cr.';"><td style="padding:7px;" align="center" valign="top">Прилавок магазина пуст</td></tr>';
}
	if(isset($u->stats['shopSale'],$_GET['sale'])){
		$bns = 0+$u->stats['shopSale'];
		if($bns!=0){
			if($bns>0){
				$bns = '+'.$bns;
			}
			$shopProcent -= $bns;
			if($shopProcent>99){ $shopProcent = 99; }
			if($shopProcent<1){ $shopProcent = 1; }
			echo '<div style="color:grey;"><b>У Вас действует бонус при продаже: '.$bns.'%</b><br><small>Вы сможете продавать предметы за '.(100-$shopProcent).'% от их стоимости</small></div>';
		}
	}
	
	if(!isset($_GET['otdel'])) $_GET['otdel'] = 1;
	$sid = 1;
	$error = '';
	
	 # Выполнение функции покупки предмета
	if( true == true ) {
		
	}elseif(isset($_GET['buy'])){
		if($u->info['allLock'] > time()) {
			$re = '<div align="left">Вам запрещается пользоваться данным магазином до '.date('d.m.y H:i',$u->info['allLock']).'</div>';
		}elseif($u->info['align'] == 2 || $u->info['haos'] > time()) {
			$re = '<div align="left">Хаосникам запрещается пользоваться данным магазином</div>';
		}elseif($u->newAct($_GET['sd4'])==true){
			$re = $u->buyItemCommison($sid,(int)$_GET['itemid'],(int)$_GET['buy']);
		}else{
			$re = 'Вы уверены что хотите купить этот предмет?';
		}
	}
	
	 /*
	 *Выполнение функции "положить предмет в комисионку"
	 *Или забрать предме из коммисионки.
	 */
	if(false == true) {
		$re = '<div align="left">Временно недоступно!</div>';
	}elseif($u->info['align'] == 2 || $u->info['haos'] > time()) {
		$re = '<div align="left">Хаосникам запрещается пользоваться данным магазином</div>';
	}elseif(isset($_POST['PresTR'])){
		$u->commisonRent(mysql_real_escape_string($_POST['PresTR']),(int)$_POST['iid'],(int)$_POST['summTR']);
	}elseif(isset($_GET['UpdatePrice'])){
		$u->commisonRentUpdate(mysql_real_escape_string($_GET['UpdatePrice']),(int)$_GET['iid'],(int)$_POST['summTR']);
	}
	 	 
	if($re!=''){ echo '<div align="right"><font color="red"><b>'.$re.'</b></font></div>'; } ?>
	
	<script type="text/javascript">
	function AddCount(name, txt){
		document.getElementById("hint4").innerHTML = '<table border=0 width=100% cellspacing=1 cellpadding=0 bgcolor="#CCC3AA"><tr><td align=center><B>Купить неск. штук</td><td width=20 align=right valign=top style="cursor: pointer" onclick="closehint3();"><BIG><B>x</TD></tr><tr><td colspan=2>'+
		'<form method=post><table border=0 width=100% cellspacing=0 cellpadding=0 bgcolor="#FFF6DD"><tr><INPUT TYPE="hidden" name="set" value="'+name+'"><td colspan=2 align=center><B><I>'+txt+'</td></tr><tr><td width=80% align=right>'+
		'Количество (шт.) <INPUT TYPE="text" NAME="count" id=count size=4></td><td width=20%>&nbsp;<INPUT TYPE="submit" value=" »» ">'+
		'</TD></TR></form></TABLE></td></tr></table>';
		document.getElementById("hint4").style.visibility = 'visible';
		document.getElementById("hint4").style.left = '100px';
		document.getElementById("hint4").style.top = '100px';
		document.getElementById("count").focus();
	}
	function closehint3() {
		document.getElementById('hint4').style.visibility='hidden';
		Hint3Name='';
	}	
	</script>
	<style type="text/css"> 
	
	.pH3 { COLOR: #8f0000; FONT-FAMILY: Arial; FONT-SIZE: 12pt; FONT-WEIGHT: bold; }
	.class_ {
		font-weight: bold;
		color: #C5C5C5;
		cursor:pointer;
	}
	.class_st {
		font-weight: bold;
		color: #659BA3;
		cursor:pointer;
	}
	.class__ {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #659BA3;
	}
	.class__st {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #659BA3;
		font-size: 10px;
	}
	.class_old {
		font-weight: bold;
		color: #919191;
		cursor:pointer;
	}
	.class__old {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #838383;
		font-size: 10px;
	}	
	</style>
	<TABLE width="100%" cellspacing="0" cellpadding="0">
	<tr><td valign="top"><?php
	echo '<b style="color:red">'.$error.'</b>';
	?>
	<br />
	<TABLE width="100%" cellspacing="0" cellpadding="4">
	<TR>
	<form name="F1" method="post">
	<TD valign="top" align="left">
	<!--Магазин-->
	<?php if($_GET['toRent'] == 1){?>
	<div style="font-weight: bold; color:red; text-align: center; padding-bottom: 5px;">При продаже вашей вещи взимается комиссия 5% от стоимости сделки.</div>
	<?php }?>
	<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#a5a5a5">
	<div id="hint3" style="visibility:hidden"></div>

	<tr>
	<td align="center" height="21">
	 <?php	
		/*названия разделов (сверху)*/
		if(!isset($_GET['sale']) && isset($_GET['otdel'])) {
/*			$otdels_small_array = array (
			1050=>'<b>Отдел&nbsp;&quot;Прочие предметы&quot;</b>',
			1=>'<b>Отдел&nbsp;&quot;Оружие: кастеты,ножи&quot;</b>',
			2=>'<b>Отдел&nbsp;&quot;Оружие: топоры&quot;</b>',
			3=>'<b>Отдел&nbsp;&quot;Оружие: дубины,булавы&quot;</b>',
			4=>'<b>Отдел&nbsp;&quot;Оружие: мечи&quot;</b>',
			5=>'<b>Отдел&nbsp;&quot;Оружие: магические посохи&quot;</b>',
			6=>'<b>Отдел&nbsp;&quot;Одежда: сапоги&quot;</b>',
			7=>'<b>Отдел&nbsp;&quot;Одежда: перчатки&quot;</b>',
			8=>'<b>Отдел&nbsp;&quot;Одежда: рубахи&quot;</b>',
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
			21=>'<b>Отдел&nbsp;&quot;Амуниция&quot;</b>',
			22=>'<b>Отдел&nbsp;&quot;Эликсиры&quot;</b>',
			23=>'<b>Отдел&nbsp;&quot;Подарки&quot;</b>',
			24=>'<b>Отдел&nbsp;&quot;Подарки: недобрые&quot;</b>',
			25=>'<b>Отдел&nbsp;&quot;Подарки: упаковка&quot;</b>',
			26=>'<b>Отдел&nbsp;&quot;Подарки: открытки&quot;</b>',
			27=>'<b>Отдел&nbsp;&quot;Подарки: фейерверки&quot;</b>');*/
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
			if(isset($otdels_small_array[$_GET['otdel']]) && $_GET['toRent'] != 1){
				echo $otdels_small_array[$_GET['otdel']];	
			}
			elseif($_GET['toRent'] == 1){
				echo '<strong>Отдел "Сдать вещи"</strong>';
			}
		} 
	?>
	</tr>
	<tr><td>
	<!--Рюкзак / Прилавок-->
	<table width="100%" CELLSPACING="1" CELLPADDING="1" bgcolor="#a5a5a5">
	 <?php
	/*
		* Вывод списка вещей продаваемых в комисионке 
		* Вывод вещей которые уже сдали в комок
	*/	 	 	 	 	 
	if(!isset($_GET['toRent'])){
		/*
			* Выводим все вещи продоваемые в комке
			* В режиме предварительного просмотра
		*/
			//$u->commisionShops($sid,"preview");	 	
			//$u->commisionShop($sid,"preview");
	}elseif($_GET['toRent'] == 1 ){
		/*
			* Выводим вещи из инвентарая 
			* которые хотим сдать в комок				 	 	 	 	 
		*/ 
		if($u->info['allLock'] < time()) {
		//$itmAll = $u->genInv(30,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `iu`.`gift` = "" ORDER BY `lastUPD` DESC');
		} else {
			$itmAll[0] = 0;
		}
		if($itmAll[0]==0){
	 	 $itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">ПУСТО</td></tr>';
		}else{
			$itmAllSee = $itmAll[2];
		}
		echo $itmAllSee;
	}elseif($_GET['toRent'] == 2){
		/*
			* Выводим вещи которые мы сдали в комок
		*/	 	 	 	 	 
		//$itmAll = $u->genInv(31,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="30" AND `iu`.`gift` = "" ORDER BY `lastUPD` DESC');
		if($itmAll[0]==0){
			$itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">ПУСТО</td></tr>';
		}else{
			$itmAllSee = $itmAll[2];
		}
	 	 echo $itmAllSee;	 	 	 	 	 	 	 	 	 	 
	}elseif($_GET['toRent'] == 3){
		/*
			* Выводим полный перечень вещей 
			* продоваемых в комке по определенному
			* выбранному айтему
		*/
			//$u->commisionShops2($sid,"full");	 	
			//$u->commisionShop($sid,"full");	 	 	 	 	 	 	 	 	 
	}
	?>
	</TABLE>	 
	</TD></TR>
	</TABLE>
	</TD>
	</FORM>
	</TR>
	</TABLE>	
	<td width="280" valign="top">
	 <TABLE cellspacing="0" cellpadding="0"><TD width="100%">&nbsp;</TD><TD>
	<table border="0" cellpadding="0" cellspacing="0">
	<tr align="right" valign="top">
	<td>
	<!-- -->
	<? echo $goLis; ?>
	<!-- -->
	<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td nowrap="nowrap">
	<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
	<tr>
	<td bgcolor="#D3D3D3"><img src="http://img.likebk.com/i/move/links.gif" width="9" height="7" /></td>
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.9&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.9',1); ?>">Центральная Площадь</a></td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</td></table>
	</td></table>
	<div>
		<br />
		<div align="right">
			<small>
			<b>Деньги: </b><b style="color: #339900"><?php echo $u->info['money']?> кр.</b><br>
      <b>Еврокредиты: </b><b style="color: #339900"><?php echo $u->bank['money2']?> eкр.</b><br>
			</small>
		</div>
		<br />
		<?php
			/*кнопочки*/
			
	if( $u->info['admin'] > 0 ) {
		echo '<div><a href="/main.php?updater&otdel='.((int)$_GET['otdel']).'">Обновить раздел</a></div>';
	}
			
			echo '<INPUT TYPE="button" value="Сдать вещи" onclick="location=\'?toRent=1\'">&nbsp; <INPUT TYPE="button" value="Забрать вещи" onclick="location=\'?toRent=2\'">&nbsp;';
		?>
	</div>
	<div style="background-color:#A5A5A5;padding:1"><center><B>Отделы магазина</B></center></div>
	<div style="line-height:17px;">
	<?php
		/*названия разделов (справа)*/
		/*$otdels_array = array (1=>'Оружие: кастеты,ножи',
			2=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;топоры',
			3=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;дубины,булавы',
			4=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;мечи',
			5=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;магические посохи',
			6=>'Одежда: сапоги',
			7=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;перчатки',
			8=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;рубахи',
			9=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;легкая броня',
			10=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;тяжелая броня',
			11=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;шлемы',
			12=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;наручи',
			13=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;пояса',
			14=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;поножи',
			15=>'Щиты',
			16=>'Ювелирные товары: серьги',
			17=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ожерелья',
			18=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;кольца',
			19=>'Заклинания',
			20=>'Эликсиры');
		$i=1;
		while ($i!=-1){
			if(isset($otdels_array[$i])){
				if(isset($_GET['otdel']) && $_GET['otdel']==$i) {
					$color = 'C7C7C7';	
				} else {
					$color = 'e2e0e0';
				}
				echo '<A HREF="?otdel='.$i.'"><DIV style="background-color: #'.$color.'">'.$otdels_array[$i].'</A></DIV>';
			} else {
				$i = -2;
			}
			$i++;
		}
		if(isset($_GET['otdel']) && $_GET['otdel']==1050) {
			$color = 'C7C7C7';	
		} else {
			$color = 'e2e0e0';
		}*/
		  echo '<div style="background-color: #e2e0e0"><a href="?otdel=1">Оружие: кастеты,ножи</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;топоры</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;дубины,булавы</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;мечи</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;магические посохи</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=6">Одежда: сапоги</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;перчатки</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;рубахи</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=9">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;легкая броня</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=10">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;тяжелая броня</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=11">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;шлемы</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;наручи</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;пояса</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=14">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;поножи</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=28">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;плащи и накидки</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=15">Щиты</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=16">Ювелирные товары: серьги</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=17">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ожерелья</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=18">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;кольца</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=19">Заклинания: нейтральные</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;боевые и защитные</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=50">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;исцеляющие</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=55">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;манящие</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=56">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;тактические</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=51">Руны: Уникальные руны</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=57">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Руны I-го уровня</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=58">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Руны II-го уровня</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=59">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Руны III-го уровня</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=60">Чарки</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=61">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Чарки I-го уровня</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=62">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Чарки II-го уровня</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=52">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Чарки III-го уровня</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=21">Амуниция</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=36">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;эликсиры</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=37">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;еда</a></div>';
		echo '<A HREF="?otdel=1050"><DIV style="background-color: #'.$color.'">Прочие предметы</A></DIV>';
	?>
	</div>
</td>
</table>
<br>
<div id="textgo" style="visibility:hidden;"></div>
  <style>
    #prompt-form {
      display: inline-block;
      padding: 10px;
      width: 200px;
      border: 1px solid black;
      background: white;
      vertical-align: middle;
    }

    #prompt-form-container {
      position: fixed;
      top: 0;
      left: 0;
      z-index: 9999;
      width: 100%;
      height: 100%;
      text-align: center;
    }

    #prompt-form-container:before {
      display: inline-block;
      height: 100%;
      content: '';
      vertical-align: middle;
    }

    #prompt-form input[name="text"] {
      display: block;
      width: 90%;
	  margin: 10px auto;
      padding: 5px;
    }
  </style>
<div id="prompt-form-container" style="display: none;">
    <form id="prompt-form">
      <div id="prompt-message">Введите цену</div>
      <input name="text" type="text" placeholder="Введите цену">
      <input type="submit" value="Изменить">
      <input type="button" name="cancel" value="Отмена">
    </form>
  </div>
<? } ?>
<script type="text/javascript">
    // Показать полупрозрачный DIV, затеняющий всю страницу 
    // (а форма будет не в нем, а рядом с ним, чтобы не полупрозрачная) 
    function showCover() {
      var coverDiv = document.createElement('div');
      coverDiv.id = 'cover-div';
      document.body.appendChild(coverDiv);
    }

    function hideCover() {
      document.body.removeChild(document.getElementById('cover-div'));
    }

    function showPrompt(text, callback) {
      showCover();
      var form = document.getElementById('prompt-form');
      var container = document.getElementById('prompt-form-container');
      document.getElementById('prompt-message').innerHTML = text;
      form.elements.text.value = '';

      function complete(value) {
        hideCover();
        container.style.display = 'none';
        document.onkeydown = null;
        callback(value);
      }

      form.onsubmit = function() {
        var value = form.elements.text.value;
        if (value == '') return false; // игнорировать пустой submit

        complete(value);
        return false;
      };

      form.elements.cancel.onclick = function() {
        //complete(null);
        hideCover();
        container.style.display = 'none';
      };

      document.onkeydown = function(e) {
        if (e.keyCode == 27) { // escape
          complete(null);
        }
      };

      var lastElem = form.elements[form.elements.length - 1];
      var firstElem = form.elements[0];

      lastElem.onkeydown = function(e) {
        if (e.keyCode == 9 && !e.shiftKey) {
          firstElem.focus();
          return false;
        }
      };

      firstElem.onkeydown = function(e) {
        if (e.keyCode == 9 && e.shiftKey) {
          lastElem.focus();
          return false;
        }
      };


      container.style.display = 'block';
      form.elements.text.focus();
    }

	$('.UpdatePresTR').click(function() {
	  var iid = $(this).attr('iidvalue');
      showPrompt("Изменить Цену", function(value) {
        location.href="main.php?toRent=2&UpdatePrice="+value+"&iid="+iid;
      });
    });
</script>