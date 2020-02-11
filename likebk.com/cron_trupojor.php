<?php
/*

	ядро дл€ обработки данных.
	ќбработка поединков, обработка за€вок, обработка ботов, обработка пещер, обработка турниров, обработка временных генераций
	root /bin/sleep 7;php -f /var/www/likebk.com/data/www/likebk.com/cron_trupojor.php;/bin/sleep 7;php -f /var/www/likebk.com/data/www/likebk.com/cron_trupojor.php;/bin/sleep 7;php -f /var/www/likebk.com/data/www/likebk.com/cron_trupojor.php;/bin/sleep 7;php -f /var/www/likebk.com/data/www/likebk.com/cron_trupojor.php;/bin/sleep 7;php -f /var/www/likebk.com/data/www/likebk.com/cron_trupojor.php;/bin/sleep 7;php -f /var/www/likebk.com/data/www/likebk.com/cron_trupojor.php;/bin/sleep 7;php -f /var/www/likebk.com/data/www/likebk.com/cron_trupojor.php;/bin/sleep 7;php -f /var/www/likebk.com/data/www/likebk.com/cron_trupojor.php;
	
*/


function getIP() {
   if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
   return $_SERVER['REMOTE_ADDR'];
}

/*if( $_SERVER['HTTP_CF_CONNECTING_IP'] != $_SERVER['SERVER_ADDR'] && $_SERVER['HTTP_CF_CONNECTING_IP'] != '127.0.0.1' ) {	die('Hello pussy!');   }

if(getIP() != $_SERVER['SERVER_ADDR'] && getIP() != '127.0.0.1' && getIP() != '' && getIP() != '212.224.113.192') {
	die(getIP().'<br>'.$_SERVER['SERVER_ADDR']);
}*/

define('GAME',true);

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');

function e($t) {
	mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("core #'.date('d.m.Y').' %'.date('H:i:s').' ( ритическа€ ошибка): <b>'.mysql_real_escape_string($t).'</b>","capitalcity","LEL","6","1","-1")');
}

function testMonster( $mon , $type ) {
	$r = true;
	if(isset($mon['id'])) {
		//
		if($type == 'start') {
			//ƒень недели
			if( $mon['start_day'] != -1 ) {
				if( ($mon['start_day'] < 7 && $mon['start_day'] != date('w')) || $mon['start_day'] != 7 ) {
					$r = false;
				}
			}
			//„исло
			if( $mon['start_dd'] != -1 ) {
				if( $mon['start_dd'] != date('d') ) {
					$r = false;
				}
			}
			//мес€ц
			if( $mon['start_mm'] != -1 ) {
				if( $mon['start_mm'] != date('n') ) {
					$r = false;
				}
			}
			//час
			if( $mon['start_hh'] != -1 ) {
				if( $mon['start_hh'] != date('G') ) {
					$r = false;
				}
				if( $mon['start_min'] != -1 ) {
					if( $mon['start_min'] < (int)date('i') ) {
						$r = false;
					}
				}
			}
		}elseif($type == 'back') {
			//ƒень недели
			if( $mon['back_day'] != -1 ) {
				if( ($mon['back_day'] < 7 && $mon['back_day'] != date('w')) || $mon['back_day'] != 7 ) {
					$r = false;
				}
			}
			//„исло
			if( $mon['back_dd'] != -1 ) {
				if( $mon['back_dd'] != date('d') ) {
					$r = false;
				}
			}
			//мес€ц
			if( $mon['back_mm'] != -1 ) {
				if( $mon['back_mm'] != date('n') ) {
					$r = false;
				}
			}
			//час
			if( $mon['back_hh'] != -1 ) {
				if( $mon['back_hh'] != date('G') ) {
					$r = false;
				}
				if( $mon['back_min'] != -1 ) {
					if( $mon['back_min'] < (int)date('i') ) {
						$r = false;
					}
				}
			}
		}else{
			//что-то другое
			$r = false;
		}
		//
	}
	return $r;
}

$sp = mysql_query('SELECT `u`.*,`st`.* FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON `st`.`id` = `u`.`id` WHERE `u`.`no_ip` = "trupojor" LIMIT 100');
while($pl = mysql_fetch_array($sp)) {
	$act = 0;
	if($pl['online'] < time()-60) {
		$pl['online'] = time();
		mysql_query('UPDATE `users` SET `online` = "'.$pl['online'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
	}
	if($pl['res_x'] < time()) {
		//ћожно действовать!
		$mon = mysql_fetch_array(mysql_query('SELECT * FROM `aaa_monsters` WHERE `uid` = "'.$pl['id'].'" LIMIT 1'));
		if( isset($mon['id']) ) {
			if( testMonster($mon,'start') == true && $pl['room'] == 303 ) {
				$pl['room'] = $mon['start_room'];
				mysql_query('UPDATE `users` SET `room` = "'.$pl['room'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				mysql_query('UPDATE `stats` SET `hpNow` = "1000000000000",`mpNow` = "1000000000000" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				if( $mon['start_text'] != '' ) {
					echo 1;
					mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("<font color=red>¬нимание!</font> '.mysql_real_escape_string(str_replace('{b}','<b>'.$pl['login'].'</b> ['.$pl['level'].']<a target=_blank href=inf.php?'.$pl['id'].' ><img width=12 height=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>',$mon['start_text'])).'","'.$pl['city'].'","","6","1","'.time().'")');
				}
				$act = 1;
			}
		}else{
			mysql_query('UPDATE `stats` SET `res_x` = "'.(time()+3600).'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}
	}
	if( $act == 0 && $pl['room'] != 303 && $pl['battle'] == 0 ) {
		if(!isset($mon['id'])) {
			$mon = mysql_fetch_array(mysql_query('SELECT * FROM `aaa_monsters` WHERE `uid` = "'.$pl['id'].'" LIMIT 1'));
		}
		if( isset($mon['id']) ) {
			if( testMonster($mon,'back') == true ) {
				$pl['room'] = 303;
				mysql_query('UPDATE `users` SET `room` = "'.$pl['room'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				mysql_query('UPDATE `stats` SET `hpNow` = "1000000000000",`mpNow` = "1000000000000" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				if( $mon['back_text'] != '' ) {
					echo 2;
					mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("<font color=red>¬нимание!</font> '.mysql_real_escape_string(str_replace('{b}','<b>'.$pl['login'].'</b> ['.$pl['level'].']<a target=_blank href=inf.php?'.$pl['id'].' ><img width=12 height=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>',$mon['back_text'])).'","'.$pl['city'].'","","6","1","'.time().'")');
				}
				$act = 2;
			}
		}
	}
	/*if($pl['battle'] > 0) {
		//inuser_go_atack($pl);
	}else{
		if($pl['room'] == 303 && $pl['timeGo'] < time()) {
			if($pl['res_x'] < time()) {
				$pl['room'] = $pl['invBlock'];
				mysql_query('UPDATE `users` SET `room` = "'.$pl['room'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				mysql_query('UPDATE `stats` SET `hpNow` = "1000000000000",`mpNow` = "1000000000000" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("<font color=red>¬нимание!</font> <b>'.$pl['login'].'</b> ['.$pl['level'].']<a target=_blank href=inf.php?'.$pl['id'].' ><img width=12 height=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a> выбралс€ на охоту, будьте осторожны!","'.$pl['city'].'","","6","1","'.time().'")');
			}
		}
	}*/
}
?>