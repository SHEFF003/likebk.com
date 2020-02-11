<?php

define('GAME',true);
setlocale(LC_CTYPE ,"ru_RU.CP1251");
include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

if(!isset($u->info['id']) || $u->info['admin'] == 0) {
	if( $u->info['login'] != "LEL" ) {
		header('location: http://likebk.com/');
		die();
	}
}

if(isset($_GET['bx'])) {
	echo '(Осталось '.$u->timeOut((strtotime(date('d.m.Y'))+86400)-time()).')';
}

//
$_GET['id'] = (int)$_GET['id'];
$_GET['exp'] = (int)$_GET['exp'];
//

$us = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.mysql_real_escape_string($_GET['id']).'" LIMIT 1'));
if( !isset($us['id']) ) {
	
}else{
	$st = mysql_fetch_array(mysql_query('SELECT * FROM `stats` WHERE `id` = "'.mysql_real_escape_string($us['id']).'" LIMIT 1'));
	$lvl = mysql_fetch_array(mysql_query('SELECT * FROM `levels` WHERE `upLevel` = "'.$st['upLevel'].'" LIMIT 1'));
	$lvn = mysql_fetch_array(mysql_query('SELECT * FROM `levels` WHERE `exp` <= "'.mysql_real_escape_string($_GET['exp']).'" ORDER BY `exp` DESC LIMIT 1'));
	//
	echo 'Логин: <b>'.$us['login'].'</b> ['.$us['level'].', ап:'.$st['upLevel'].']<br>Откатываем на '.$_GET['exp'].' опыта (Уровень: '.$lvn['nextLevel'].' , апп: '.$lvn['upLevel'].').<hr>';
	//
	$r = array( 0 , 0 , 0 , 0 , 0 , 0 );
	//
	$sp = mysql_query('SELECT * FROM `levels` WHERE `upLevel` <= '.$st['upLevel'].' AND `upLevel` > '.$lvn['upLevel'].'');
	while( $pl = mysql_fetch_array($sp) ) {
		if(isset($pl['vinosl'])) {
			$pl['vinos'] = $pl['vinosl'];
		}
		$r[0] -= $pl['ability'];
		$r[1] -= $pl['skills'];
		$r[2] -= $pl['nskills'];
		$r[3] -= $pl['vinos'];
		$r[4] -= $pl['duh'];
		$r[5] -= $pl['money'];
	}
	//
	$sts = $u->lookStats($st['stats']);
	$nst = array(
		's1'	=> 3,
		's2'	=> 3,
		's3'	=> 3,
		's4'	=> 3,
		's5'	=> 0,
		's6'	=> 0,
		's7'	=> 0
	);
	//
	$sp = mysql_query('SELECT * FROM `levels` WHERE `upLevel` <= '.$lvn['upLevel'].'');
	while( $pl = mysql_fetch_array($sp) ) {
		if(isset($pl['vinosl'])) {
			$pl['vinos'] = $pl['vinosl'];
		}
		$nst['s4'] += $pl['vinos'];
		$nst['s7'] += $pl['duh'];
		$nst['a'] += $pl['ability'];
		$nst['s'] += $pl['skills'];
		$nst['n'] += $pl['nskills'];
	}
	//
	$rep = mysql_fetch_array(mysql_query('SELECT * FROM `rep` WHERE `id` = "'.$us['id'].'" LIMIT 1'));
	$nst['a'] += $rep['add_stats'];
	$nst['s'] += $rep['add_skills'];
	$nst['n'] += $rep['add_skills2'];
	//
	echo '<br>Откат уровня: '.($lvn['nextLevel']-$us['level']).'<br>';
	echo '<br>Откат статов: '. $r[0];
	echo '<br>Откат умений: '. $r[1];
	echo '<br>Откат навыков: '. $r[2];
	echo '<br>Откат выносливости: '. $r[3];
	echo '<br>Откат духа: '. $r[4];
	echo '<br>Откат денег: '. $r[5];
	echo '<br>';
	//
	echo '<hr>';
	//
	$stt = 's7='.$nst['s7'].'|s1=3|s2=3|s3=3|s4='.$nst['s4'].'|s5=0|s6=0|s8=0|s9=0|s10=0|s11=0|a1=0|mg1=0|a2=0|mg2=0|a3=0|mg3=0|a4=10|mg4=0|a5=0|mg5=0|a6=0|mg6=0|a7=0|mg7=0|os1=0|os2=0|os3=0|os4=0|os5=0|os6=0|os7=0|os8=0|os9=0|os10=0|os11=0|s12=0|s13=0|s14=0|s15=0';
	echo $stt;
	print_r($nst);
	//
	if(isset($_GET['good'])) {
		//
		mysql_query('UPDATE `users` SET `level` = "'.$lvn['nextLevel'].'" , `money` = "'.($us['money'] + $r['5']).'" WHERE `id` = "'.$us['id'].'" LIMIT 1');
		mysql_query('UPDATE `stats` SET
		
		`stats` = "'.$stt.'",
		`upLevel` = "'.$lvn['upLevel'].'",
		`ability` = "'.$nst['a'].'",
		`skills` = "'.$nst['s'].'",
		`nskills` = "'.$nst['n'].'",
		`exp` = "'.mysql_real_escape_string($_GET['exp']).'"
		
		WHERE `id` = "'.$us['id'].'" LIMIT 1');
		//
	}else{
		echo '<hr><a href="/recovery.php?id='.$_GET['id'].'&exp='.$_GET['exp'].'&good">Откатить!</a>';
	}
	//
}
?>