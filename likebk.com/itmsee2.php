<?php
define('GAME',time());

include('_incl_data/class/__db_connect.php');

$itm = array();
$sp = mysql_query('SELECT * FROM `items_main`');
while($pl = mysql_fetch_array($sp) ) {
	$itm[$pl['id']] = $pl;
}

$sp = mysql_query('SELECT COUNT(*) AS `x` , `item_id` FROM `items_users` GROUP BY `item_id` ORDER BY `x` DESC');
while( $pl = mysql_fetch_array($sp) ) {
	echo '<br><br>['.$pl['item_id'].'] '.$pl['x'] . ' רע. - <a href="/item/'.$pl['item_id'].'" target="_blank">'.$itm[$pl['item_id']]['name'].'</a>';
}

?>