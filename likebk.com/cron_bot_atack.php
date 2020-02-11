<?php

define('GAME',true);
setlocale(LC_CTYPE ,"ru_RU.CP1251");

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');

function inuser_go_btl($id) {
	if(isset($id['id'])) {
		//file_get_contents('http://bk.com/jx/battle/refresh.php?uid='.$id['id'].'&cron_core='.md5($id['id'].'_brfCOreW@!_'.$id['pass']).'&pass='.$id['pass']);
	}
}

$i = 1;
while( $i <= 3 ) {
	$sp = mysql_query('SELECT `u`.`id` , `u`.`pass` FROM `stats` AS `s` LEFT JOIN `users` AS `u` ON `u`.`id` = `s`.`id` WHERE `s`.`bot` > 0 AND `u`.`battle` > 0 ORDER BY `s`.`nextAct` ASC LIMIT 1000');
	$btltest = array(); $btl_ref = array();
	while($pl = mysql_fetch_array($sp)) {
		inuser_go_btl( $pl );
	}
	$i++;
	sleep(19);
}
?>
