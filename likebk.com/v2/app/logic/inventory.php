<?

$found_module = true;

define('GAME',true);
include('../_incl_data/__config.php');
include('../_incl_data/class/__db_connect.php');
include('../_incl_data/class/__magic.php');
if( isset($_GET['com_takeitems']) ) { $_GET['usec1'] = $_GET['com_takeitems']; }
include('../_incl_data/class/__user.php');

if( !defined('OK') || !isset($u->info['id']) ) {
	die('{"error":"Invalid request, user not defined"}');
}

$erract = '';
$newdata1 = '';

if( $u->room['block_all'] > 0 ) {
	//Здесь нельзя пользоваться инвентарем
	unset($_GET['snat'],$_GET['odet'],$_GET['groupall'],$_GET['open_itm'],$_GET['takesanich'],$_GET['com_takeitems'],$_GET['use_pid'],$_GET['snatvse'],$_GET['delete']);
	$erract = 'В этой локации нельзя пользоваться чем-либо!';
}

if( $u->info['battle'] > 0 ) {
	//В бою нельзя пользоваться инвентарем
	die();
}elseif(isset($_GET['ufs'])){
	$u->stats = $u->getStats($u->info['id'],0);
	$act = $u->freeStatsItem($_GET['itmid'],$_GET['ufs'],$u->info['id']);
	$act = 1;
	$testactions = true;
}elseif(isset($_GET['open_itm'])) {
	$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `id` = "'.mysql_real_escape_string($_GET['open_itm']).'" LIMIT 1'));
	if(!isset($itm['id']) || $itm['inShop'] > 0 || $itm['inTransfer'] > 0 || $itm['delete'] > 0) {
		die('{"error":"Предмет не найден!"}');
	}elseif($itm['uid'] != $u->info['id']) {
		die('{"error":"Предмет принадлежит не вам!"}');
	}elseif($itm['inOdet'] > 0) {
		die('{"error":"Предмет уже надет в слот!"}');
	}else{
		$_GET['open'] = true;
		$u->stats = $u->getStats($u->info['id'],0);
		$act = $u->odetItem($itm['id'],$u->info['id']);
		$act = 1;
		$testactions = true;
	}
}elseif(isset($_GET['groupall'])) {
	mysql_query('UPDATE `items_users` SET `inGroup` = 0 WHERE `uid` = "'.$u->info['id'].'" AND `inShop` = 0 AND `inTransfer` = 0 AND `delete` = 0 AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `group_max` > 0 AND `inRazdel` = "'.mysql_real_escape_string((int)$_GET['otdel']).'")');
	mysql_query('UPDATE `items_users` SET `inGroup` = 1 WHERE `uid` = "'.$u->info['id'].'" AND `iznosNOW` = 0 AND `data` LIKE "%nosale%" AND `inOdet` = 0 AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `group_max` > 0 AND `inRazdel` = "'.mysql_real_escape_string((int)$_GET['otdel']).'")');
	mysql_query('UPDATE `items_users` SET `inGroup` = 2 WHERE `uid` = "'.$u->info['id'].'" AND `iznosNOW` = 0 AND `data` LIKE "%sudba%" AND `inOdet` = 0 AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `group_max` > 0 AND `inRazdel` = "'.mysql_real_escape_string((int)$_GET['otdel']).'")');
	mysql_query('UPDATE `items_users` SET `inGroup` = 3 WHERE `uid` = "'.$u->info['id'].'" AND `iznosNOW` = 0 AND `data` LIKE "%frompisher%" AND `inOdet` = 0 AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `group_max` > 0 AND `inRazdel` = "'.mysql_real_escape_string((int)$_GET['otdel']).'")');
	mysql_query('UPDATE `items_users` SET `inGroup` = 4 WHERE `uid` = "'.$u->info['id'].'" AND `iznosNOW` = 0 AND `inGroup` = 0 AND `inOdet` = 0 AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `group_max` > 0 AND `inRazdel` = "'.mysql_real_escape_string((int)$_GET['otdel']).'")');
	$act = 1;
}elseif(isset($_GET['takesanich'])) {
	$sp = mysql_query('SELECT * FROM `items_users_res` WHERE `item_id` >= 3143 AND `item_id` <= 3195 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0');
	while( $itm = mysql_fetch_array($sp) ) {
		$itm['inShop'] = 0;		
		$itm['lastUPD'] = time();			
		mysql_query('INSERT INTO `items_users` (`id`,`item_id`,`1price`,`2price`,`3price`,`4price`,`5price`,`uid`,`use_text`,`data`,`inOdet`,`inShop`,`inGroup`,`delete`,`iznosNOW`,`iznosMAX`,`gift`,`gtxt1`,`gtxt2`,`kolvo`,`geniration`,`magic_inc`,`maidin`,`lastUPD`,`timeOver`,`overType`,`secret_id`,`time_create`,`time_sleep`,`dn_delete`,`inTransfer`,`post_delivery`,`lbtl_`,`bexp`,`so`,`blvl`,`pok_itm`,`btl_zd`,`comsid`,`kamen`) VALUES ("'.$itm['id'].'","'.$itm['item_id'].'","'.$itm['1price'].'","'.$itm['2price'].'","'.$itm['3price'].'","'.$itm['4price'].'","'.$itm['5price'].'","'.$itm['uid'].'","'.$itm['use_text'].'","'.$itm['data'].'","'.$itm['inOdet'].'","'.$itm['inShop'].'","'.$itm['inGroup'].'","'.$itm['delete'].'","'.$itm['iznosNOW'].'","'.$itm['iznosMAX'].'","'.$itm['gift'].'","'.$itm['gtxt1'].'","'.$itm['gtxt2'].'","'.$itm['kolvo'].'","'.$itm['geniration'].'","'.$itm['magic_inc'].'","'.$itm['maidin'].'","'.$itm['lastUPD'].'","'.$itm['timeOver'].'","'.$itm['overType'].'","'.$itm['secret_id'].'","'.$itm['time_create'].'","'.$itm['time_sleep'].'","'.$itm['dn_delete'].'","'.$itm['inTransfer'].'","'.$itm['post_delivery'].'","'.$itm['lbtl_'].'","'.$itm['bexp'].'","'.$itm['so'].'","'.$itm['blvl'].'","'.$itm['pok_itm'].'","'.$itm['btl_zd'].'","'.$itm['comsid'].'","'.$itm['kamen'].'")');
		mysql_query('DELETE FROM `items_users_res` WHERE `id` = "'.$itm['id'].'" LIMIT 1');
		//mysql_query('UPDATE `items_users` SET `lastUPD` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
	}
	$act = 1;
}elseif(isset($_GET['skladtake'])) {
	$sp = mysql_query('SELECT * FROM `items_users_res` WHERE `item_id` = "'.mysql_real_escape_string($_GET['skladtake']).'" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0');
	while( $itm = mysql_fetch_array($sp) ) {					
		mysql_query('INSERT INTO `items_users` (`id`,`item_id`,`1price`,`2price`,`3price`,`4price`,`5price`,`uid`,`use_text`,`data`,`inOdet`,`inShop`,`inGroup`,`delete`,`iznosNOW`,`iznosMAX`,`gift`,`gtxt1`,`gtxt2`,`kolvo`,`geniration`,`magic_inc`,`maidin`,`lastUPD`,`timeOver`,`overType`,`secret_id`,`time_create`,`time_sleep`,`dn_delete`,`inTransfer`,`post_delivery`,`lbtl_`,`bexp`,`so`,`blvl`,`pok_itm`,`btl_zd`,`comsid`,`kamen`) VALUES ("'.$itm['id'].'","'.$itm['item_id'].'","'.$itm['1price'].'","'.$itm['2price'].'","'.$itm['3price'].'","'.$itm['4price'].'","'.$itm['5price'].'","'.$itm['uid'].'","'.$itm['use_text'].'","'.$itm['data'].'","'.$itm['inOdet'].'","'.$itm['inShop'].'","'.$itm['inGroup'].'","'.$itm['delete'].'","'.$itm['iznosNOW'].'","'.$itm['iznosMAX'].'","'.$itm['gift'].'","'.$itm['gtxt1'].'","'.$itm['gtxt2'].'","'.$itm['kolvo'].'","'.$itm['geniration'].'","'.$itm['magic_inc'].'","'.$itm['maidin'].'","'.$itm['lastUPD'].'","'.$itm['timeOver'].'","'.$itm['overType'].'","'.$itm['secret_id'].'","'.$itm['time_create'].'","'.$itm['time_sleep'].'","'.$itm['dn_delete'].'","'.$itm['inTransfer'].'","'.$itm['post_delivery'].'","'.$itm['lbtl_'].'","'.$itm['bexp'].'","'.$itm['so'].'","'.$itm['blvl'].'","'.$itm['pok_itm'].'","'.$itm['btl_zd'].'","'.$itm['comsid'].'","'.$itm['kamen'].'")');
		mysql_query('DELETE FROM `items_users_res` WHERE `id` = "'.$itm['id'].'" LIMIT 1');
		mysql_query('UPDATE `items_users` SET `lastUPD` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
	}
	$act = 1;
}elseif(isset($_GET['unstack'])){
	$u->unstack(intval($_GET['unstack']), intval($_GET['unstackCount']));
	$act = 1;
}elseif(isset($_GET['stack'])){
	$u->stack($_GET['stack']);
	$act = 1;
}elseif(isset($_GET['kolodec1'])) {
	
	$vix = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time`>='.strtotime('now 00:00:00').' AND `vars` = "hpKolodec_'.$u->info['id'].'" ',3);
	$vix = round($vix[0]);
	$vix2 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time`>='.strtotime('now 00:00:00').' AND `vars` = "mpKolodec_'.$u->info['id'].'" ',3);
	$vix2 = round($vix2[0]);
	if($u->info['vip'] == 1){
		$max_hp = 20000;
	}elseif($u->info['vip'] == 2){
		$max_hp = 50000;
	}else{
		$max_hp = 10000;
	}
	
	$u->stats = $u->getStats($u->info['id'],0);
	if($u->stats['hpNow'] != $u->stats['hpAll']){
		$kolodec_hp = mysql_fetch_array(mysql_query('SELECT * FROM `a_kolodec` WHERE `uid` = "'.$u->info['id'].'" AND `type` = "0"'));
		if($vix < $max_hp){
			if(!isset($kolodec_hp['id'])){
				$in_kol = mysql_query('INSERT INTO `a_kolodec` (`uid`,`time`,`type`) VALUES ("'.$u->info['id'].'","'.(time()+300).'","0")');
				if($in_kol){
					//$_SESSION['timestamp'] = time()+300;
					$hpV = $u->stats['hpAll'] - $u->stats['hpNow'];
					if(($hpV + $vix) > $max_hp){
						$hpV = $max_hp - $vix;
					}
					mysql_query('UPDATE `stats` SET `hpNow` =`hpNow` + "'.$hpV.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					$u->addActionKol($u->info['id'], time(),'hpKolodec_'.$u->info['id'], $hpV);
					$erract = 'Ваше здоровье восстановлено!';
				}
			}else{
				$in_kol = mysql_query('UPDATE `a_kolodec` SET `time`="'.(time()+300).'" WHERE `uid`="'.$u->info['id'].'" AND `type` = "0"');
				if($in_kol){
					//$_SESSION['timestamp'] = time()+300;
					$hpV = $u->stats['hpAll'] - $u->stats['hpNow'];
					if(($hpV + $vix) > $max_hp){
						$hpV = $max_hp - $vix;
					}
					mysql_query('UPDATE `stats` SET `hpNow` =`hpNow` + "'.$hpV.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					$u->addActionKol($u->info['id'], time(),'hpKolodec_'.$u->info['id'], $hpV);
					 $erract = 'Ваше здоровье восстановлено!';
				}
			}
		}else{
			$u->error = 'Колодец пуст...';
		}
	}else{
		$u->error = 'Ваше здоровье и так полностью восстановлено';
	}
	
	$erract = '';
	
	$act = 1;
}elseif(isset($_GET['kolodec2'])) {
	$u->stats = $u->getStats($u->info['id'],0);

	$vix = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time`>='.strtotime('now 00:00:00').' AND `vars` = "hpKolodec_'.$u->info['id'].'" ',3);
	$vix = round($vix[0]);
	$vix2 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time`>='.strtotime('now 00:00:00').' AND `vars` = "mpKolodec_'.$u->info['id'].'" ',3);
	$vix2 = round($vix2[0]);
	if($u->info['vip'] == 1){
		$max_hp = 20000;
	}elseif($u->info['vip'] == 2){
		$max_hp = 50000;
	}else{
		$max_hp = 10000;
	}

	if($u->stats['mpNow'] != $u->stats['mpAll']){
		$kolodec_mp = mysql_fetch_array(mysql_query('SELECT * FROM `a_kolodec` WHERE `uid` = "'.$u->info['id'].'" AND `type` = "1"'));
		if($vix2 < $max_hp){
			if(!isset($kolodec_mp['id'])){
				$in_kol = mysql_query('INSERT INTO `a_kolodec` (`uid`,`time`, `type`) VALUES ("'.$u->info['id'].'","'.(time()+300).'","1")');
				if($in_kol){
					//$_SESSION['timestamp'] = time()+300;
					$mpV = $u->stats['mpAll'] - $u->stats['mpNow'];
					if(($mpV + $vix2) > $max_hp){
						$mpV = $max_hp - $vix2;
					}
					mysql_query('UPDATE `stats` SET `mpNow` = `mpNow` + "'.$mpV.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					$u->addActionKol($u->info['id'], time(),'mpKolodec_'.$u->info['id'], $mpV);
					echo '<script>location.href="main.php?inv=1&mpAllkol"</script>';
				}
			}else{
				$in_kol = mysql_query('UPDATE `a_kolodec` SET `time`="'.(time()+300).'" WHERE `uid`="'.$u->info['id'].'" AND `type` = "1"');
				if($in_kol){
					//$_SESSION['timestamp'] = time()+300;
					$mpV = $u->stats['mpAll'] - $u->stats['mpNow'];
					if(($mpV + $vix2) > $max_hp){
						$mpV = $max_hp - $vix2;
					}
					mysql_query('UPDATE `stats` SET `mpNow` =`mpNow` + "'.$mpV.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					$u->addActionKol($u->info['id'], time(),'mpKolodec_'.$u->info['id'], $mpV);
					 echo '<script>location.href="main.php?inv=1&mpAllkol"</script>';
				}
			}
		}else{
			$u->error = 'Колодец пуст...';
		}
	}else{
		$u->error = 'Ваше мана и так полностью восстановлено';
	}
	
	$erract = '';
	
	$act = 1;
}elseif(isset($_GET['saveComp'])) {
	//
	$_POST['compname'] = $_GET['saveComp'];
	$_POST['compname'] = htmlspecialchars($_POST['compname'],NULL,'cp1251');
	$_POST['compname'] = str_replace("'",'',$_POST['compname']);
	$_POST['compname'] = str_replace('"','',$_POST['compname']);
	$ptst = str_replace(' ','',$_POST['compname']);
	if( $ptst!='' ) {
		//Добавляем комплект
		$ptst = '';
		$sp = mysql_query('SELECT `inOdet`,`id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inOdet` > 0 AND `inShop` = "0" ORDER BY `inOdet` ASC LIMIT 250');
		while ( $pl = mysql_fetch_array($sp) ) {
			$ptst .= $pl['inOdet'].'='.$pl['id'].'|';
		}
		$tcm = mysql_fetch_array(mysql_query('SELECT * FROM `save_com` WHERE `uid` = "'.$u->info['id'].'" AND `name` = "'.mysql_real_escape_string($_POST['compname']).'" AND `delete` = "0" LIMIT 1'));
		if( !isset($tcm['id']) ) {
			//добавляем новый комплект
			$ins = mysql_query('INSERT INTO `save_com` (`uid`,`time`,`name`,`val`,`type`) VALUES ("'.$u->info['id'].'","'.time().'","'.mysql_real_escape_string($_POST['compname']).'","'.$ptst.'","0")');
			if($ins) {
				$erract = 'Комплект &quot;'.$_POST['compname'].'&quot; был успешно сохранен';
			} else {
				$erract = 'Не удалось сохранить комплект по техническим причинам';	
			}
		}else{
			//изменяем существующий
			$ins = mysql_query('UPDATE `save_com` SET `val` = "'.$ptst.'" WHERE `id` = "'.$tcm['id'].'" LIMIT 1');
			if($ins)
			{
				$erract = 'Комплект &quot;'.$_POST['compname'].'&quot; был успешно изменен';
			}else{
				$erract = 'Не удалось изменить комплект по техническим причинам';	
			}	
		}
		unset($ptst,$tcm,$inc);
	}
	$act = 1;
	//
}elseif( isset($_GET['com_takeitems']) ) {
	$u->stats = $u->getStats($u->info['id'],0);
	$act = 1;
}elseif( isset($_GET['com_takepriems']) ) {
	$cpr = mysql_fetch_array(mysql_query('SELECT * FROM `complects_priem` WHERE `id` = "'.mysql_real_escape_string($_GET['com_takepriems']).'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
	if( isset($cpr['id']) ) {
		$u->info['priems'] = $cpr['priems'];
		mysql_query('UPDATE `stats` SET `priems` = "'.mysql_real_escape_string($cpr['priems']).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	}
	$u->stats = $u->getStats($u->info['id'],0);
	$act = 1;
}elseif( isset($_GET['com_deletepriems']) ) {
	mysql_query('DELETE FROM `complects_priem` WHERE `id` = "'.mysql_real_escape_string($_GET['com_deletepriems']).'" AND `uid` = "'.$u->info['id'].'" LIMIT 1');
	$u->stats = $u->getStats($u->info['id'],0);
	$act = 1;
}elseif( isset($_GET['com_deleteitems']) ) {
	mysql_query('DELETE FROM `save_com` WHERE `id` = "'.mysql_real_escape_string($_GET['com_deleteitems']).'" AND `uid` = "'.$u->info['id'].'" LIMIT 1');
	$u->stats = $u->getStats($u->info['id'],0);
	$act = 1;
}elseif( isset($_GET['delete']) ) {
	$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `id` = "'.mysql_real_escape_string($_GET['delete']).'" LIMIT 1'));
	if(!isset($itm['id']) || $itm['inShop'] > 0 || $itm['inTransfer'] > 0 || $itm['delete'] > 0) {
		die('{"error":"Предмет не найден!"}');
	}elseif($itm['uid'] != $u->info['id']) {
		die('{"error":"Предмет принадлежит не вам!"}');
	}elseif($itm['inOdet'] > 0) {
		die('{"error":"Предмет надет в слот, сначала снимите его!"}');
	}else{
		
		if( isset($_GET['deleteall7']) ) {
			$col = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `uid` = "'.$itm['uid'].'" AND `item_id` = "'.$itm['item_id'].'" LIMIT 1'));
			$col = $col[0];
		}else{
			$col = 1;
		}
		
		$itmmain = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$itm['item_id'].'" LIMIT 1'));
		$u->addDelo(1,$itm['uid'],'&quot;<font color="maroon">System.inventory</font>&quot;: Предмет &quot;<b>'.$itmmain['name'].' (x'.$col.')</b>&quot; [itm:'.$itm['id'].'] был <b>выброшен</b>.',time(),$u->info['city'],'System.inventory',0,0);
		
		if( isset($_GET['deleteall7']) ) {
			mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$itm['uid'].'" AND `item_id` = "'.$itm['item_id'].'"');
		}else{
			mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
		}
		$act = 1;
	}
}elseif( isset($_GET['snat']) ) {
	$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `id` = "'.mysql_real_escape_string($_GET['snat']).'" LIMIT 1'));
	if(!isset($itm['id']) || $itm['inShop'] > 0 || $itm['inTransfer'] > 0 || $itm['delete'] > 0) {
		die('{"error":"Предмет не найден!"}');
	}elseif($itm['uid'] != $u->info['id']) {
		die('{"error":"Предмет принадлежит не вам!"}');
	}else{
		$_GET['page'] = 1;
		$u->stats = $u->getStats($u->info['id'],0);
		$act = $u->snatItem($itm['id'],$u->info['id']);
		$testactions = true;
	}
}elseif( isset($_GET['snatvse']) ) {
	$_GET['page'] = 1;
	$u->stats = $u->getStats($u->info['id'],0);
	$act = $u->snatItemAll($u->info['id']);
	$testactions = true;
}elseif( isset($_GET['odet']) ) {
	$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `id` = "'.mysql_real_escape_string($_GET['odet']).'" LIMIT 1'));
	if(!isset($itm['id']) || $itm['inShop'] > 0 || $itm['inTransfer'] > 0 || $itm['delete'] > 0) {
		die('{"error":"Предмет не найден!"}');
	}elseif($itm['uid'] != $u->info['id']) {
		die('{"error":"Предмет принадлежит не вам!"}');
	}elseif($itm['inOdet'] > 0) {
		die('{"error":"Предмет уже надет в слот!"}');
	}else{
		$u->stats = $u->getStats($u->info['id'],0);
		$act = $u->odetItem($itm['id'],$u->info['id']);
		$testactions = true;
	}
}elseif( isset($_GET['use_pid']) ) {
	$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `id` = "'.mysql_real_escape_string($_GET['use_pid']).'" LIMIT 1'));
	if(!isset($itm['id']) || $itm['inShop'] > 0 || $itm['inTransfer'] > 0 || $itm['delete'] > 0) {
		die('{"error":"Предмет не найден!"}');
	}elseif($itm['uid'] != $u->info['id']) {
		die('{"error":"Предмет принадлежит не вам!"}');
	}elseif($itm['inOdet'] > 0) {
		die('{"error":"Предмет уже надет в слот!"}');
	}else{
		$u->stats = $u->getStats($u->info['id'],0);
		$magic->useItems($itm['id'],$u);
		$erract = $u->error;
		$u->error = '';
		$act = 1;
		$testactions = true;
	}
}elseif( isset($_GET['stat']) ) {
	$u->stats = $u->getStats($u->info['id'],0);
	$u->rgd = $u->regen($u->info['id'],0,0);
	echo $u->jsonData();
	die();
}elseif( isset($_GET['bonusonline']) ) {
	/*
1. Вывод премиума (голд акк)
2. Кнопка забрать страницы
3. Сохранять свернутые вкладки
	*/
	$bns = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `aaa_bonus` WHERE `uid` = "'.$u->info['id'].'" AND `time` > '.time().' LIMIT 1'));
	if(!isset($bns['id'])) {
		$_GET['getb1w'] = 3;
		$bonus = 0.02;
		$lev = ($u->info['level'] - 8);
		if($lev != 0){
			$bonus = $bonus + (0.01 * $lev);
		}
		if(round(date('w')) == 0 || round(date('w')) == 6 || $c['holiday'] == true) {
			$bonus *= 2;
		}
		$u->takeBonusNew($bonus);
		//$bns = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `aaa_bonus` WHERE `uid` = "'.$u->info['id'].'" AND `time` >= '.time().' LIMIT 1'));
		//die('{"bonus":['.(0+$bns['time']).','.$u->info['money'].','.$u->bank['money2'].']}');
		//die('{"bonus":['.(time()+3600).','.$u->info['money'].','.$u->bank['money2'].']}');
		$newdata1 .= '"bonus":['.(time()+3600).','.$u->info['money'].','.$u->bank['money2'].'],';
		$act = 1;
	}else{
		die('{"error":"Еще рано, бонус за онлайн не восстановился..."}');
	}
}elseif( isset($_GET['stack']) ) {
	$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `id` = "'.mysql_real_escape_string($_GET['use_pid']).'" LIMIT 1'));
	if(!isset($itm['id']) || $itm['inShop'] > 0 || $itm['inTransfer'] > 0 || $itm['delete'] > 0) {
		die('{"error":"Предмет не найден!"}');
	}elseif($itm['uid'] != $u->info['id']) {
		die('{"error":"Предмет принадлежит не вам!"}');
	}else{
		$u->stack($itm['id']);
		$act = 1;
	}
}elseif( isset($_GET['unstack']) ) {
	$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `id` = "'.mysql_real_escape_string($_GET['use_pid']).'" LIMIT 1'));
	if(!isset($itm['id']) || $itm['inShop'] > 0 || $itm['inTransfer'] > 0 || $itm['delete'] > 0) {
		die('{"error":"Предмет не найден!"}');
	}elseif($itm['uid'] != $u->info['id']) {
		die('{"error":"Предмет принадлежит не вам!"}');
	}elseif($itm['inGroup'] == 0) {
		die('{"error":"Предмет не находится в группе!"}');
	}else{
		$x = 0;
		$u->unstack($itm['id'],0);
		$act = 1;
	}
}elseif(isset($_GET['actdata'])) {
	$act = 1;
	$testactions = true;
}



//Проверяем на ошибки
if( $u->error != '' ) {
	//die('{"error":"'.$u->error.'"}');
	$newdata1 .= '"error2":"'.$u->error.'",';
}

//Обновление данных
if(isset($testactions)) {
	$u->stats = $u->getStats( $u->info['id'] , 0 , 1 );
	$u->testItems($u->info['id'],0);
}
if(isset($act)) {
	if( $act != -2 ){
		if(!isset($testactions)) {
			$u->stats = $u->getStats( $u->info['id'] , 0 , 1 );
		}
		$act2 = $u->testItems( $u->info['id'] , $u->stats , 0 );
		if($act2 != -2 && $act == -2) {
			$act = $act2;
		}
		$up1 = '';
		$sp = mysql_query('SELECT `id`,`inOdet` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `inOdet` > 0 AND `delete` = 0 ORDER BY `inOdet` ASC LIMIT 90');
		while( $pl = mysql_fetch_array($sp) ) {
			if( $up1 != '' ) {
				$up1 .= ',';
			}
			$up1 .= '['.$pl['id'].','.$pl['inOdet'].']';
		}
		$u->rgd = $u->regen($u->info['id'],0,0);
		echo '{'.$newdata1.'"acterr":"'.str_replace('"','&quot;',$erract).'","itemsupdate":['.$up1.'],"jsonData":'.$u->jsonData().'}';
	}
}

?>