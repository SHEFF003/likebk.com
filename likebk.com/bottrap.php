<?php
/*

	Ядро для обработки данных.
	Обработка поединков, обработка заявок, обработка ботов, обработка пещер, обработка турниров, обработка временных генераций

*/

define('GAME',true);

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

echo '<b>Персонажи использующие готовые запросы:</b><br><br>';
$sp = mysql_query('SELECT * , COUNT(`id`) AS `count` FROM `bot_trap` WHERE `x` = 0 OR `y` = 0 GROUP BY `uid` ORDER BY `count` DESC');
while( $pl = mysql_fetch_array($sp) ) {
	echo '[Запросов: '.$pl['count'].'] '.$u->microLogin($pl['uid'],1).' [Комната: '.$pl['room'].'][<b>Браузер:</b> '.$pl['data'].']<br>';
}

echo '<br><br><br><b>Персонажи использующие автокликеры:</b><br><br>';
$tu = array();
$sp = mysql_query('SELECT * FROM `bot_trap` WHERE `x` != 0 OR `y` != 0 GROUP BY `uid` ORDER BY `id` DESC');
while( $pl = mysql_fetch_array($sp) ) {
	if(!isset($tu[$pl['uid']][$pl['x']][$pl['y']])) {
		$test = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `bot_trap` WHERE `uid` = "'.$pl['uid'].'" AND `x` = "'.$pl['x'].'" AND `y` = "'.$pl['y'].'" LIMIT 1'));
		if( $test[0] > 1 ) {
			$test2 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `bot_trap` WHERE `uid` = "'.$pl['uid'].'" LIMIT 1'));
			$tu[$pl['uid']][$pl['x']][$pl['y']] = true;
			echo '[Совпадений кликов ('.$pl['x'].' | '.$pl['y'].'): '.$test[0].' , Всего кликов: '.$test2[0].'] '.$u->microLogin($pl['uid'],1).' [Комната: '.$pl['room'].'][<b>Браузер:</b> '.$pl['data'].']<br>';
		}
	}
}