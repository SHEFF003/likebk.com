<?php
define('GAME',true);

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
//include('_incl_data/class/__user.php');
//include('_incl_data/class/__zv.php');
//include('_incl_data/class/bot.priem.php');
//include('_incl_data/class/bot.logic.php');

mysql_query('UPDATE `users` SET `online` = "'.time().'" WHERE `pass` LIKE "%online%" OR `pass` = "saintlucia" OR `id` = 12345');

die();
/*

// Выбрать ботов
$sp = mysql_query('
	SELECT
		`u`.`id`,
		`u`.`battle`,  # Идентификатор боя в котором состоит пользователь
		`u`.`timereg`, # Время регистрации пользователя
		`u`.`level`,   # Уровень пользователя
		`u`.`city`,    # Город
		`s`.`zv`,      # Идентификатор заявки
		`s`.`bot`,     # Флаг указывающий на активность бота
		`s`.`exp`      # Опыт пользователя
	FROM `stats` AS `s`
	LEFT JOIN `users` AS `u` ON `u`.`id` = `s`.`id`
	WHERE `u`.`pass` = "saintlucia"
	ORDER BY `s`.`nextAct` ASC
	LIMIT 200
');

$btltest        = array();
$userIdsOnline  = array(); // Идентификаторы пользователей для обновления online
$userIdsNextAct = array(); // Идентификаторы пользователей для обновления nextAct
$userIdsLevel8  = array(); // Идентификаторы пользователей 8 уровня для обновления опыта
$userIdsLevel9  = array(); // Идентификаторы пользователей 9 уровня для обновления опыта

$bots8 = array(); // Рандомныйе боты 8 уровня
$bots9 = array(); // Рандомныйе боты 9 уровня

// Итерировать каждого пользователя (бота)
while($pl = mysql_fetch_array($sp)) {
	$i++;

	$userIdsOnline[] = $pl['id'];

	if( $pl['exp'] > 400000 && $pl['level'] == 8 ) { // выбор ботов 8 уровня с опытом не более 400000
		$userIdsLevel8[] = $pl['id'];
	}elseif( $pl['exp'] > 3500000 && $pl['level'] == 9 ) { // выбор ботов 9 уровня с опытом не более 3500000
		$userIdsLevel9[] = $pl['id'];
	}

	// Добавить в отдельный массив ботов 8 уолвгя еще не создавших заявку и неучаствующих в других заявках
	if ($pl['level'] == 8 && $pl['battle'] == 0 && $pl['zv'] == 0) {
		$bots8[] = $pl;
	}

	// Добавить в отдельный массив ботов 9 уолвгя еще не создавших заявку и неучаствующих в других заявках
	if ($pl['level'] == 9 && $pl['battle'] == 0 && $pl['zv'] == 0) {
		$bots9[] = $pl;
	}

	// if( $pl['timereg'] == 0 ) {
	// 	mysql_query('UPDATE `users` SET `timereg` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
	// }

	// if( $pl['bot'] == 0 ) {
	// 	mysql_query('UPDATE `stats` SET `bot` = "2" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
	// }

	//if ( $pl['zv'] == 0 && ($pl['battle'] == 0 || !isset($btltest[$pl['battle']]) || $btltest[$pl['battle']] < 10) ) {
	//	$btltest[$pl['battle']]++;
	//	botLogic::start( $pl['id'] );
	//} else {
		$userIdsNextAct[] = $pl['id'];
	//}
}
// обновления онлайна ботов
mysql_query('UPDATE `users` SET `online` = "'.time().'" WHERE `id` IN('.implode(',', $userIdsOnline).')');
// обновить nextAct ботов
mysql_query('UPDATE `stats` SET `nextAct` = "'.time().'" WHERE `id` IN('.implode(',', $userIdsNextAct).')');
// непозволять ботам 8 уровня переходить на следующий
mysql_query('UPDATE `stats` SET `exp` = "400000" WHERE `id` IN('.implode(',', $userIdsLevel8).')');
// непозволять ботам 9 уровня переходить на следующий
mysql_query('UPDATE `stats` SET `exp` = "3500000" WHERE `id` IN('.implode(',', $userIdsLevel9).')');
/*
global $code,$c,$u;

$back_test = false;

if (isset($bots8[0])) {
	// создать заявку для рандомного бота 8 уровня
	createZv($bots8[rand(0, count($bots8))]);
}
if (isset($bots9[0])) {
	// создать заявку для рандомного бота 9 уровня
	createZv($bots9[rand(0, count($bots9))]);
}


function createZv($bot){

	$z = mysql_fetch_array(mysql_query('
		SELECT COUNT(`zv`.`id`)
		FROM `zayvki` AS `zv`
		LEFT JOIN `users` AS `u` ON `u`.`id` = `zv`.`creator`
		WHERE `zv`.`start`="0"
			AND `zv`.`cancel` = "0"
			AND `zv`.`noart` = "0"
			AND	(`zv`.`min_lvl_1` = '.$bot['level'].' AND `zv`.`max_lvl_1` = '.$bot['level'].' ) LIMIT 1
	'));

	if($z[0] < 3)
	{
		if($bot) {
			$rz = 5;
			$zv_c = array(
				'time_start' => (rand(180, 300) ), // начало боя через сек
				'tm1'        => 99, // ?
				'tm2'        => 99, // ?
				'l1min'      => $bot['level'], // уровень
				'l1max'      => $bot['level'], // уровень
				'l2min'      => $bot['level'], // уровень
				'l2max'      => $bot['level'], // уровень
				'timeout'    => ( 60 * rand( 1, 2 ) ), // время бездействия до прокуска хода
				'usermax'    => 12
			);

			$ins = mysql_query('INSERT INTO `zayvki` (`noatack`,`noeff`,`usermax`,`bot1`,`bot2`,`time`,`city`,`creator`,`type`,`time_start`,`timeout`,`min_lvl_1`,`min_lvl_2`,`max_lvl_1`,`max_lvl_2`,`tm1max`,`tm2max`,`travmaChance`,`invise`,`razdel`,`comment`,`money`,`withUser`,`tm1`,`tm2`) VALUES (
					"1",
					"1",
					"'.$zv_c['usermax'].'",
					"0",
					"0",
					"'.time().'",
					"'.$bot['city'].'",
					"'.$bot['id'].'",
					"0",
					"'.$zv_c['time_start'].'",
					"'.$zv_c['timeout'].'",
					"'.$zv_c['l1min'].'",
					"'.$zv_c['l2min'].'",
					"'.$zv_c['l1max'].'",
					"'.$zv_c['l2max'].'",
					"'.$zv_c['tm1'].'",
					"'.$zv_c['tm2'].'",
					"0",
					"0",
					"'.$rz.'",
					"",
					"",
					"","0","0")');
			$zid = mysql_insert_id();
			mysql_query('UPDATE `stats` SET `zv` = "'.$zid.'", `team` = "1" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
			mysql_query('UPDATE `users` SET `ipreg` = "8",`timeMain` = "'.rnd().'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
		}
	}*/
//}
/*
function bot_group_haot(){

}

function rnd() {
	return time() + rand(7,14) + rand(0,14) + rand(7,21);
}*/
