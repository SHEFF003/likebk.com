<?php
define('GAME',true);
setlocale(LC_CTYPE ,"ru_RU.CP1251");
include('../_incl_data/class/__db_connect.php');

//Обнуляем клан статистику за сутки

$sp = mysql_query('SELECT `id`,`exp1` FROM `clan` WHERE `exp` > 0');
while($pl = mysql_fetch_array($sp)) {
	$pl['exp1'] = 0;
	mysql_query('UPDATE `clan` SET `exp1` = '.$pl['exp1'].' WHERE `id` = '.$pl['id'].' LIMIT 1');
}

?>