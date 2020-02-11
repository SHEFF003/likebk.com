<?
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');

if(isset($_GET['b1'])) {
	$btltest = mysql_fetch_array(mysql_query('SELECT `battle` FROM `users` WHERE `id` = "158499643" LIMIT 1'));
	$btltest = $btltest['battle'];
	//echo 'UPDATE `stats` SET `priems_z` = "0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0" , `tactic1` = 25 , `tactic2` = 25 , `tactic3` = 25 , `tactic4` = 25 , `tactic5` = 25 , `tactic6` = 25 , `tactic7` = 25 WHERE `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$btltest.'")';
	mysql_query('UPDATE `stats` SET `priems_z` = "0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0" , `tactic1` = 25 , `tactic2` = 25 , `tactic3` = 25 , `tactic4` = 25 , `tactic5` = 25 , `tactic6` = 25 , `tactic7` = 25 WHERE `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$btltest.'")');
		
	die();
}

die();

if(isset($_GET['count_items_users'])) {
	$items = array();
	$items_html = array();
	$sp = mysql_query('SELECT `id`,`name`,`type` FROM `items_main`');
	while( $pl = mysql_fetch_array($sp) ) {
		$a = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `items_users` WHERE `item_id` = "'.$pl['id'].'" AND `delete` = 0 LIMIT 1'));
		$b = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `items_users` WHERE `item_id` = "'.$pl['id'].'" AND `delete` > 0 LIMIT 1'));
		if(!isset($items_html[($a[0]+$b[0])])) {
			$items_html[($a[0]+$b[0])] = '<hr>';
			$items[] = ($a[0]+$b[0]);
		}
		$items_html[($a[0]+$b[0])] .=  'id:['.$pl['id'].'] <b>'.$pl['name'].' [Тип: '.$pl['type'].']</b> - Не удаленных: '.$a[0].' , Удаленных: '.$b[0].' , Всего: '.($a[0]+$b[0]).'<br>';
	}
	sort($items);
	reset($items);
	
	$i = 0;
	while( $i <= count($items) ) {
		echo $items_html[$items[$i]] . '<br>';
		$i++;
	}
	
	die();
}

$lvl = array();
$st_all = 12;
$sp = mysql_query('SELECT * FROM `levels`');
while ($pl = mysql_fetch_array($sp) ) {
	$st_all += $pl['ability'];
	$st_all += $pl['vinosl'];
	$lvl[$pl['upLevel']] = $st_all;
}

$sp = mysql_query('SELECT `id`,`stats`,`ability`,`upLevel` FROM `stats` WHERE `id` in (SELECT `id` FROM `users` WHERE `real` > 0) AND `bot` = 0 ORDER BY `exp` DESC');
while( $pl = mysql_fetch_array($sp) ) {
	//
	$rep = mysql_fetch_array(mysql_query('SELECT `add_stats` FROM `rep` WHERE `id` = "'.$pl['id'].'" LIMIT 1'));
	//
	$stats = 0+$pl['ability'];
	$stats_max = 0+$lvl[$pl['upLevel']]+$rep['add_stats'];
	//Родные характеристики
	$i = 0;
	$sts = explode('|',$pl['stats']);
	$st = array();
	$i = 0; $ste = '';
	while($i < count($sts)) {
		$ste = explode('=',$sts[$i]);
		if(isset($ste[1])) {
			if(!isset($st[$ste[0]])) {
				$st[$ste[0]] = 0;
			}
			if( intval($ste[1]) ) {
				$st[$ste[0]]  += intval($ste[1]);
			}
		}
		$i++;
	}
	//
	$i = 0;
	while( $i < 20 ) {
		$stats += round((int)$st['s'.$i]);
		$i++;
	}
	//
	if( ($stats-$stats_max) > 10 || $pl['ability'] < 0 ) {
		if( $pl['ability'] < 0 ) {
			echo '<font color="red"><b>[RED!!! '.$pl['ability'].'</b></font>]';
		}
		echo '<b><font color="blue">id:[<a href="/inf.php?'.$pl['id'].'" target="_blank">'.$pl['id'].' open</a>] '.$stats.' (Родные: '.$lvl[$pl['upLevel']].', Пещерные:'.$rep['add_stats'].' , Баговые: '.($stats-$stats_max).')</font></b><hr>';
	}
	//	
}

?>