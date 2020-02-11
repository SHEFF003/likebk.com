<?php

include('../../_incl_data/__config.php');
define('GAME',true);
include('../../_incl_data/class/__db_connect.php');
include('../../_incl_data/class/__user.php');

if(isset($_POST['useitemon'])) {
	$_POST['useitemon'] = iconv('UTF-8', 'windows-1251', $_POST['useitemon']);
}else{
	die('Нельзя использовать предмет! #heal_file');
}

if(!isset($u->info['id'])) {
	die('#heal-1');
}

if($u->info['battle'] == 0 || $u->info['hpNow'] < 1) {
	die('#heal-2');
}

$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$u->info['battle'].'" LIMIT 1'));
if(!isset($battle['id']) || $battle['team_win'] != -1) {
	die('#heal-3');
}


$itm = mysql_fetch_array(mysql_query('SELECT `a`.* , `a`.`id` AS `iid` , `b`.* FROM `items_users` AS `a` LEFT JOIN `items_main` AS `b` ON `b`.`id` = `a`.`item_id` WHERE `a`.`id` = "'.mysql_real_escape_string($_POST['useitem']).'" AND `a`.`uid` = "'.$u->info['id'].'" AND `a`.`inOdet` > 0 AND `a`.`delete` = 0 AND `a`.`iznosNOW` < `a`.`iznosMAX` LIMIT 1'));
if(!isset($itm['id'])) {
	die('#heal-5');
}

$po = $u->lookStats($itm['data']);
if(!isset($po['useOnLogin']) || !isset($po['magic_hpNow'])) {
	die('#heal-6');
}

$u->lock('reflesh-heal');

$tg = mysql_fetch_array(mysql_query('SELECT `a`.* , `b`.* FROM `users` AS `a` LEFT JOIN `stats` AS `b` ON `b`.`id` = `a`.`id` WHERE `a`.`login` = "'.mysql_real_escape_string($_POST['useitemon']).'" AND `a`.`battle` = "'.$u->info['battle'].'" LIMIT 1'));
if(!isset($tg['id']) || $tg['battle'] != $u->info['battle'] || $tg['hpNow'] < 1 || $tg['team'] != $u->info['team']) {
	die('#heal-4');
}

$usr = $u->getStats($tg['id'],0);

if(isset($usr['id'])) {

	if( $po['magic_hpNow'] > 0 ) {
		$po['magic_hpNowOLD'] = $po['magic_hpNow'];										
		$po['magic_hpNow'] = round($po['magic_hpNow']/100*(100+$usr['min_heal_proc']));								
		if( $po['magic_hpNowOLD'] < $po['magic_hpNow'] ) {
			$po['magic_hpNow'] = $po['magic_hpNowOLD'];
		}
		$txt = $po['magic_hpNow'];
												
		if($usr['hpAll']-$usr['hpNow'] < $txt) {
			$txt = floor($usr['hpAll']-$usr['hpNow']);
		}
		
		$gdhh = round($txt/$usr['hpAll']*5,2);
		$gdhd = round($gdhh/$tg['tactic7']*100);
		if($gdhd > 100) {
			$txt = floor($txt/100*$gdhd);
		}
											
		if($tg['tactic7'] >= 1) {
		$hlhlhl = 0;
		if($txt > 0) {
			$usr['hpNow'] += $txt;
			$tg['tactic7'] -= $gdhh;
			if($tg['tactic7'] < 0) {
				$tg['tactic7'] = 0;
			}
			$hlhlhl = $txt;
		}
		$usr['hpNow'] = floor($usr['hpNow']);
												
		if($usr['hpNow'] > $usr['hpAll']) {
			$usr['hpNow'] = $usr['hpAll'];
		}
		if($usr['hpNow'] < 1) {
			$usr['hpNow'] = 0;
		}
				
		//mysql_query('UPDATE `stats` SET `last_hp` = "'.$txt.'", `hpNow` = "'.$usr['hpNow'].'", `tactic7` = "'.$tg['tactic7'].'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
		mysql_query('UPDATE `stats` SET `last_hp` = "'.$txt.'", `hpNow` = ( `hpNow` + "'.mysql_real_escape_string($hlhlhl).'" ), `tactic7` = "'.$tg['tactic7'].'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
		if($txt > 0) {
				$txt = '+'.$txt;
			} elseif($txt == 0){
				$txt = '--';
			}
		} else {
			$usr['hpNow'] = floor($usr['hpNow']);
			$txt = '--';
		}
		$lastHOD = mysql_fetch_array(mysql_query('SELECT * FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
		if(isset($lastHOD['id'])) {
			$id_hod = $lastHOD['id_hod'];
			if($lastHOD['type'] != 6) {
				$id_hod++;
			}
												
			$txt = '<font color=#006699>'.$txt.'</font>';
			if($u->info['id']==$usr['id']) {
				if($u->info['sex']==1) {
					$txt = '{u1} использовала &quot;<b>'.$itm['name'].'</b>&quot; на себя. <b>'.$txt.'</b> ['.$usr['hpNow'].'/'.$usr['hpAll'].']';
				}else{
					$txt = '{u1} использовал &quot;<b>'.$itm['name'].'</b>&quot; на себя. <b>'.$txt.'</b> ['.$usr['hpNow'].'/'.$usr['hpAll'].']';
				}
			}else{
				if($u->info['sex']==1) {
					$txt = '{u1} использовала &quot;<b>'.$itm['name'].'</b>&quot; на {u2}. <b>'.$txt.'</b> ['.$usr['hpNow'].'/'.$usr['hpAll'].']';
				}else{
					$txt = '{u1} использовал &quot;<b>'.$itm['name'].'</b>&quot; на {u2}. <b>'.$txt.'</b> ['.$usr['hpNow'].'/'.$usr['hpAll'].']';
				}
			}
			mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.time().'","'.$u->info['battle'].'","'.($id_hod).'","{tm1} '.$txt.'","login1='.$u->info['login'].'||t1='.$u->info['team'].'||login2='.$usr['login'].'||t2='.$usr['team'].'||time1='.time().'","","","","","6")');
		}									
												
		$itm['iznosNOW']++;
		mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['iid'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1');
												
		// сообщение в лог боя
		$sx = 'ый'; $sx2 = '';
		if($u->info['sex']==1) {
			$sx = 'ая'; $sx2 = 'а';
		}
		$u->error = 'Свиток &quot;'.$itm['name'].'&quot; был успешно использован.';										
		echo '<font color=red><b>'.$u->error.'</b></font>';
	}
	
}else{
	die('#heal-7');
}

$u->unlock();

?>