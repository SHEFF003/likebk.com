<?php
define('GAME',true);
setlocale(LC_CTYPE ,"ru_RU.CP1251");
include('../_incl_data/class/__db_connect.php');

//ќбнул¤ем клан статистику за 7 дней

$sp = mysql_query('SELECT `id`,`exp2` FROM `clan` WHERE `exp` > 0');
while($pl = mysql_fetch_array($sp)) {
	$pl['exp2'] = 0;
	mysql_query('UPDATE `clan` SET `exp2` = '.$pl['exp2'].' WHERE `id` = '.$pl['id'].' LIMIT 1');
}

?>