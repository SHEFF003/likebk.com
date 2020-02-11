<?php

if(!isset($_GET['tt'])) {
	die();
}

define('GAME',true);

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');
include('_incl_data/class/__zv.php');
include('_incl_data/class/__magic.php');

	
	//отморозки
	$sp = mysql_query('SELECT * FROM `battle` WHERE `otmorozok` = 1 AND `team_win` = -1 AND `otmorozok_use` = 0');
	while( $pl = mysql_fetch_array($sp) ) {
		echo '{otmorozok-';
		if( rand( 0 , 100 ) < 15 ) {
			echo 'attack!';
			//
			mysql_query('UPDATE `battle` SET `otmorozok_use` = 1 WHERE `id` = "'.$pl['id'].'" LIMIT 1');
			//
			$usr = mysql_fetch_array(mysql_query('SELECT `level`,`city` FROM `users` WHERE `battle` = "'.$pl['id'].'" ORDER BY `level` DESC LIMIT 1'));
			$bot = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `login` LIKE "%Отморозок [%'.$usr['level'].'%]%" LIMIT 1'));
			if(!isset($bot['id'])) {
				$bot = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `login` LIKE "Отморозок" LIMIT 1'));
			}
			//
			$tmr = rand(1,2);
			//
			$logins_bot = array();
			$bot = $u->addNewbot($bot['id'],NULL,NULL,$logins_bot,NULL);
			$otmz = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `users` WHERE `login` LIKE "%Отморозок (%" AND `battle` = "'.$pl['id'].'" LIMIT 1'));
			//
			$otmz[0]++;
			//
			mysql_query('UPDATE `users` SET `city` = "'.$usr['city'].'",`login` = "Отморозок ('.$otmz[0].')",`battle` = "'.$pl['id'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
			//
			mysql_query('UPDATE `stats` SET `team` = "'.$tmr.'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
			//
			$vtvl = '{tm1} {u1} вмешался в поединок. <b>Хо! хо! хо!</b>';
			$last_hod = mysql_fetch_array(mysql_query('SELECT `id_hod` FROM `battle_logs` WHERE `battle` = "'.$pl['id'].'" ORDER BY `id_hod` DESC LIMIT 1'));
			$last_hod = $last_hod['id_hod'];
			//
			$mass = array(
				'time' 		=> time(),
				'battle' 	=> $pl['id'],
				'id_hod' 	=> ($last_hod+1),
				'vars' 		=> '||time1='.time().'||time2=0||s1=0||t1='.$tmr.'||login1=Отморозок ('.$otmz[0].')',
				'type' 		=> 1			
			);
			//
			$ins = mysql_query('INSERT INTO `battle_logs` (
				`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`
			) VALUES (
				"'.$mass['time'].'",
				"'.$mass['battle'].'",
				"'.$mass['id_hod'].'",
				"'.$vtvl.'",
				"'.$mass['vars'].'",
				"",
				"",
				"",
				"",
				"'.$mass['type'].'"
			)');
		}
		echo '}';
	}
	
	$rz = 5;
	if( (int)date('i') == 0 || (int)date('i') == 20 || (int)date('i') == 40 || isset($_GET['test10']) ) {
		//10
		$zv_c = array(
			'time_start' => 600,
			'tm1' => rand( 2, 6 ),
			'tm2' => rand( 2, 6 ),
			'l1min' => 10,
			'l1max' => 10,
			'l2min' => 10,
			'l2max' => 10,
			'timeout' => ( 60 * rand( 2, 3 ) ),
			'usermax' => 30    
		);
		mysql_query('INSERT INTO `zayvki` (`noatack`,`arand`,`noeff`,`noart`,`usermax`,`bot1`,`bot2`,`time`,`city`,`type`,`time_start`,`timeout`,`min_lvl_1`,`min_lvl_2`,`max_lvl_1`,`max_lvl_2`,`tm1max`,`tm2max`,`travmaChance`,`invise`,`razdel`,`comment`,`money`,`withUser`,`tm1`,`tm2`) VALUES (
						  "1","1","1","1",
						  "'.$zv_c['usermax'].'",
						  "0",
						  "0",
						  "'.time().'",
						  "capitalcity",
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
	}elseif( (int)date('i') == 5 || (int)date('i') == 25 || (int)date('i') == 55 || isset($_GET['test11']) ) {
		//11
		$zv_c = array(
			'time_start' => 300,
			'tm1' => rand( 2, 6 ),
			'tm2' => rand( 2, 6 ),
			'l1min' => 11,
			'l1max' => 11,
			'l2min' => 11,
			'l2max' => 11,
			'timeout' => ( 60 * 1 ),
			'usermax' => 30    
		);
		mysql_query('INSERT INTO `zayvki` (`noatack`,`arand`,`noeff`,`noart`,`usermax`,`bot1`,`bot2`,`time`,`city`,`type`,`time_start`,`timeout`,`min_lvl_1`,`min_lvl_2`,`max_lvl_1`,`max_lvl_2`,`tm1max`,`tm2max`,`travmaChance`,`invise`,`razdel`,`comment`,`money`,`withUser`,`tm1`,`tm2`) VALUES (
						  "1","1","1","1",
						  "'.$zv_c['usermax'].'",
						  "0",
						  "0",
						  "'.time().'",
						  "capitalcity",
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
	}elseif( (int)date('i') == 10 || (int)date('i') == 30 || (int)date('i') == 50 || isset($_GET['test12']) ) {
		//12
		$zv_c = array(
			'time_start' => 600,
			'tm1' => rand( 2, 6 ),
			'tm2' => rand( 2, 6 ),
			'l1min' => 12,
			'l1max' => 12,
			'l2min' => 12,
			'l2max' => 12,
			'timeout' => ( 60 * rand( 2, 3 ) ),
			'usermax' => 30    
		);
		mysql_query('INSERT INTO `zayvki` (`fastfight`,`noatack`,`arand`,`noeff`,`noart`,`usermax`,`bot1`,`bot2`,`time`,`city`,`type`,`time_start`,`timeout`,`min_lvl_1`,`min_lvl_2`,`max_lvl_1`,`max_lvl_2`,`tm1max`,`tm2max`,`travmaChance`,`invise`,`razdel`,`comment`,`money`,`withUser`,`tm1`,`tm2`) VALUES (
						  "1","1","1","1","1",
						  "'.$zv_c['usermax'].'",
						  "0",
						  "0",
						  "'.time().'",
						  "capitalcity",
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
	}elseif( (int)date('i') == 15 || (int)date('i') == 35 || (int)date('i') == 55 || isset($_GET['test11_2']) ) {
		//2-21
		$zv_c = array(
			'time_start' => 300,
			'tm1' => rand( 2, 6 ),
			'tm2' => rand( 2, 6 ),
			'l1min' => 11,
			'l1max' => 11,
			'l2min' => 11,
			'l2max' => 11,
			'timeout' => ( 60 * 1 ),
			'usermax' => 30    
		);
		mysql_query('INSERT INTO `zayvki` (`noatack`,`arand`,`noeff`,`noart`,`usermax`,`bot1`,`bot2`,`time`,`city`,`type`,`time_start`,`timeout`,`min_lvl_1`,`min_lvl_2`,`max_lvl_1`,`max_lvl_2`,`tm1max`,`tm2max`,`travmaChance`,`invise`,`razdel`,`comment`,`money`,`withUser`,`tm1`,`tm2`) VALUES (
						  "1","1","1","1",
						  "'.$zv_c['usermax'].'",
						  "0",
						  "0",
						  "'.time().'",
						  "capitalcity",
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
	}

die();

?>