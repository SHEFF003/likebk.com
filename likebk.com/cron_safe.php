<?php

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

if(!isset($_GET['test'])) {
	//die();
}
function safe_delo() {
	if( date('m') < 9 ) {
		mysql_query('INSERT INTO `delo` ( `uid`,`dop`,`time`,`city`,`text`,`login`,`delete`,`no_right`,`type`,`ip`,`moneyOut`,`moneyIn`,`hb`,`ldtype`,`onlyAdmin` ) SELECT  `uid`,`dop`,`time`,`city`,`text`,`login`,`delete`,`no_right`,`type`,`ip`,`moneyOut`,`moneyIn`,`hb`,`ldtype`,`onlyAdmin` FROM `users_delo`');
	}
}

//mysql_query('UPDATE `users` SET `online` = 0 WHERE `id` = 12345 LIMIT 1');

$sp = mysql_query('SELECT `id`,`money5` FROM `users` WHERE `real` > 0');
while( $pl = mysql_fetch_array($sp) ) {
	$m2 = mysql_fetch_array(mysql_query('SELECT `money2` FROM `bank` WHERE `uid` = "'.$pl['id'].'" LIMIT 1'));
	$m2 = $m2['money2'];
	$m3 = $pl['money5'];
	//
	$sum = mysql_fetch_array(mysql_query('SELECT SUM(`2price`) , SUM(`5price`) FROM `items_users` WHERE `uid` = "'.$pl['id'].'" AND `delete` = 0 LIMIT 1'));
	//
	mysql_query('INSERT INTO `test_money` (`uid`,`time`,`m2`,`m2i`,`s2`,`m3`,`m3i`,`s3`) VALUES (
		"'.$pl['id'].'","'.time().'","'.$m2.'","'.$sum[0].'","'.($m2+$sum[0]).'","'.$m3.'","'.$sum[1].'","'.($m3+$sum[1]).'"
	)');
}

safe_delo();

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

$test_uid = $_GET['test']; //Тестовый перенос

$x = 0;
$x_all = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `users` WHERE `real` > 0 LIMIT 1')); $x_all = $x_all[0];

$x5_all = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `users` WHERE `real` > 0 AND `online` < "'.(time()-86400*30).'" LIMIT 1')); $x5_all = $x5_all[0];

$x2 = 0;
$x2_all = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` LIMIT 1')); $x2_all = $x2_all[0];

$x2r = 0;
$x2r_all = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users_res` LIMIT 1')); $x2r_all = $x2r_all[0];

$x3 = 0;
$x3_all = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `actions` LIMIT 1')); $x3_all = $x3_all[0];
if( date('m') < 9 ) {mysql_query('DELETE FROM `users_delo`');}

if( $test_uid == 0 ) {
	$sp = mysql_query('SELECT * FROM `users` WHERE `online` < "'.(time()-86400*30).'" AND `real` > 0 ORDER BY `online` ASC LIMIT 50');
}else{
	$sp = mysql_query('SELECT * FROM `users` WHERE `id` = "'.$test_uid.'" AND `real` > 0 LIMIT 1');
}

while( $pl = mysql_fetch_array($sp) ) {
		
	$save = '';
	
	$pl['time'] = time();
	
	if(!file_exists('safe/user'.$pl['id'].'_'.$pl['time'].'.html')) {			
		//$x2_v = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `uid` = "'.$pl['id'].'" LIMIT 1')); $x2_v = $x2_v[0];
		//$x2 += $x2_v;			
		//$x3_v = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `actions` WHERE `uid` = "'.$pl['id'].'" LIMIT 1')); $x3_v = $x3_v[0];
		//$x3 += $x3_v;		
		//
		//	
		mysql_query('DELETE FROM `users_safe` WHERE `uid` = "'.$pl['id'].'"');	
		mysql_query('INSERT INTO `users_safe` ( `uid`,`login`,`pass`,`time` ) VALUES ( "'.$pl['id'].'","'.$pl['login'].'","'.$pl['pass'].'","'.time().'" )');
		//		
		$st = mysql_fetch_array(mysql_query('SELECT * FROM `stats` WHERE `id` = "'.$pl['id'].'" LIMIT 1'));
		$ac = mysql_fetch_array(mysql_query('SELECT * FROM `actions` WHERE `uid` = "'.$pl['id'].'"'));		
		$save .= save_table($pl,'users');
		$save .= save_table($st,'stats');
		$save .= save_table($ac,'actions');	
		//
		$qr = mysql_fetch_array(mysql_query('SELECT * FROM `rep` WHERE `id` = "'.$pl['id'].'" LIMIT 1'));
		$save .= save_table($qr,'rep');	
		//
		//
		$qr = mysql_fetch_array(mysql_query('SELECT * FROM `achiev` WHERE `uid` = "'.$pl['id'].'" LIMIT 1'));
		$save .= save_table($qr,'achiev');	
		//
		$sp_itm = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$pl['id'].'"');
		while( $pl_itm = mysql_fetch_array($sp_itm) ) {
			$save .= save_table($pl_itm,'items_users');
		}
		//
		$sp_itm = mysql_query('SELECT * FROM `items_users_res` WHERE `uid` = "'.$pl['id'].'"');
		while( $pl_itm = mysql_fetch_array($sp_itm) ) {
			$save .= save_table($pl_itm,'items_users_res');
		}	
		//	
		$sp_itm = mysql_query('SELECT * FROM `users_animal` WHERE `uid` = "'.$pl['id'].'"');
		while( $pl_itm = mysql_fetch_array($sp_itm) ) {
			$save .= save_table($pl_itm,'users_animal');
		}	
		//	
		$sp_itm = mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$pl['id'].'"');
		while( $pl_itm = mysql_fetch_array($sp_itm) ) {
			$save .= save_table($pl_itm,'bank');
		}	
		//	
		/*
		$sp_itm = mysql_query('SELECT * FROM `user_rating` WHERE `uid` = "'.$pl['id'].'"');
		while( $pl_itm = mysql_fetch_array($sp_itm) ) {
			$save .= save_table($pl_itm,'user_rating');
		}
		*/
		$sp_itm = mysql_query('SELECT * FROM `user_ico` WHERE `uid` = "'.$pl['id'].'"');
		while( $pl_itm = mysql_fetch_array($sp_itm) ) {
			$save .= save_table($pl_itm,'user_ico');
		}			
		//		
		$flog = fopen('safe/user'.$pl['id'].'_'.$pl['time'].'.html', "w");
		if(!$flog) {
			//
		}else{
			fwrite($flog, $save); 
			fclose($flog);
		}	
		//
		mysql_query('DELETE FROM `users` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		mysql_query('DELETE FROM `stats` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		mysql_query('DELETE FROM `actions` WHERE `uid` = "'.$pl['id'].'"');
		mysql_query('DELETE FROM `rep` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$pl['id'].'"');
		mysql_query('DELETE FROM `achiev` WHERE `uid` = "'.$pl['id'].'"');
		mysql_query('DELETE FROM `items_users_res` WHERE `uid` = "'.$pl['id'].'"');
		//
		echo '[+]';
		$x++;		
	}else{
		echo '<br>[-]<br>';
	}
}

if( $test_uid > 0 ) {
	//echo $save;
	echo '[FINISH]<hr>';
}

echo '[Пользователей на заморозку: '.$x.' из '.$x5_all.' (Всего игроков: '.$x_all.') ('.round(($x / $x_all * 100),2).'%)]';
echo '<br>[Предметов на заморозку: '.$x2.' из '.$x2_all.' ('.round(($x2 / $x2_all * 100),2).'%)]';
echo '<br>[Поля `actions`: '.$x3.' из '.$x3_all.' ('.round(($x3 / $x3_all * 100),2).'%)]';

?>