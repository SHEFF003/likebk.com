<?php

define('GAME',true);

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

$sp = mysql_query('SELECT * FROM `test_money` WHERE `s2` > 0 OR `s3` > 0 GROUP BY `uid` ORDER BY `time` DESC , `s3` DESC , `s2` DESC');
while( $pl = mysql_fetch_array($sp) ) {
	$b = mysql_fetch_array(mysql_query('SELECT `moneyBuy` FROM `bank` WHERE `uid` = "'.$pl['uid'].'" LIMIT 1'));
	$b = $b['moneyBuy'];
	echo '<br>' . $u->microLogin($pl['uid'],1) . ' - <b>'.$pl['s2'].' екр.</b> - - - - <b>'.$pl['s3'].' Gold</b> ';
}