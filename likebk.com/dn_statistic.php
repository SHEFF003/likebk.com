<?php
define('GAME',true);
include_once('_incl_data/__config.php');
include_once('_incl_data/class/__db_connect.php');
include_once('_incl_data/class/__user.php');

if($u->info['admin']>0) {
	$dng = '';
	if(isset($_GET['d'])) {
		$dng = (int)$_GET['d'];
	}
	if($dng != '') {
		$x = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `dungeon_now` WHERE `id2` = "'.mysql_real_escape_string($dng).'"'));
	}else{
		$x = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `dungeon_now`'));
	}
	$x = $x[0];
	echo '<b>Статистика выпадения предметов в подземельях (<small>Кол-во походов: '.$x.'</small>):</b><br><br>';
	$a = array();
	$n = array(
		0 => array(),
		1 => array()
	);
	$sp = mysql_query('SELECT `id`,`item_id` FROM `items_users` WHERE `data` LIKE "%frompisher='.mysql_real_escape_string($dng).'%" ORDER BY `item_id` ASC');
	while($pl = mysql_fetch_array($sp)) {
		if(!isset($a[$pl['item_id']])) {
			$a[$pl['item_id']] = 0;	
			$r = count($n[0]);
			$n[0][$r] = $pl['item_id'];
			$nl = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.$pl['item_id'].'" LIMIT 1'));
			$n[1][$r] = $nl['name'];
		}
		$a[$pl['item_id']]++;
	}
	
	/* Выводим список */
	$r = '';
	$i = 0;
	while($i<count($n[0])) {
		$r .= '<tr><td width="405" style="border-bottom:1px solid #EFEFEF">'.($i+1).'. <b>'.$n[1][$i].'</b> (id '.$n[0][$i].')</td><td width="200" style="border-bottom:1px solid #EFEFEF">'.$a[$n[0][$i]].' шт. <small>(За поход: ~'.round($a[$n[0][$i]]/$x,2).' шт.)</small></td></tr>';
		$i++;
	}
	echo '<table border="0" cellspacing="0" cellpadding="0">'.$r.'</table>';
}
?>