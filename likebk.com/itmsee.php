<?php
define('GAME',time());

include('_incl_data/class/__db_connect.php');

$itm = array();
$sp = mysql_query('SELECT * FROM `items_main`');
while($pl = mysql_fetch_array($sp) ) {
	$itm[$pl['id']] = $pl;
}

if(isset($_GET['del'])) {
	mysql_query('DELETE FROM `items_users` WHERE `item_id` = "'.mysql_real_escape_string($_GET['del']).'"');
	mysql_query('DELETE FROM `items_users_res` WHERE `item_id` = "'.mysql_real_escape_string($_GET['del']).'"');
	header('location: /itmsee.php');
	die();
}

$sp = mysql_query('SELECT COUNT(*) AS `x` , `item_id` FROM `items_users_res` GROUP BY `item_id` ORDER BY `x` DESC');
while( $pl = mysql_fetch_array($sp) ) {
	echo '<br><br>['.$pl['item_id'].'] '.$pl['x'] . ' רע. - <a href="/item/'.$pl['item_id'].'" target="_blank">'.$itm[$pl['item_id']]['name'].'</a> [<a href="/itmsee.php?del='.$pl['item_id'].'">DELETE</a>]';
}

?>