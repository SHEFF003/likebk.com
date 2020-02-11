<?php
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

//рейтинг персонажей
$html = '';
$i = 1;
$j = 0;
$sp = mysql_query('SELECT `id`,`uid`,`dmy`,`last` FROM `users_rating` ORDER BY `rating` DESC');
while( $pl = mysql_fetch_array($sp) ) {
	$user = mysql_fetch_array(mysql_query('SELECT `u`.`id` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`bot` = 0 AND `u`.`id` = "'.$pl['uid'].'" AND `u`.`pass` NOT LIKE "%saintlucia%" LIMIT 1000'));
	if(!isset($user['id'])) {
		mysql_query('DELETE FROM `users_rating` WHERE `uid` = "'.$pl['uid'].'"');
	}else{
		if( $pl['dmy'] != date('dmY') ) {
			mysql_query('UPDATE `users_rating` SET `dmy` = "'.date('dmY').'",`last` = "'.($j+1).'",`last2` = "'.$pl['last'].'",`now` = `rating` WHERE `uid` = "'.$pl['uid'].'" LIMIT 1');
		}
		$j++;
	}
}
/*
$sp = mysql_query('SELECT * FROM `users_rating` ORDER BY `rating` DESC');
while( $pl = mysql_fetch_array($sp) ) {
	$user = mysql_fetch_array(mysql_query('SELECT `u`.`id` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`bot` = 0 AND `u`.`id` = "'.$pl['uid'].'" AND `u`.`pass` NOT LIKE "%saintlucia%" LIMIT 1000'));
	if(!isset($user['id'])) {
		mysql_query('DELETE FROM `users_rating` WHERE `uid` = "'.$pl['uid'].'"');
	}else{
		$html .= '<b>'.$i.'</b>';
		if($i != $pl['last'] && ($j+$pl['last']-$i) != 0 && ($pl['last']-$i+$j) != 0) {
			$html .= '<sup>';
			if($pl['last'] > $i) {
				$html .= '<font color=green>+'.($pl['last']-$i).'</font>';
			}else{
				$html .= '<font color=maroon>'.($pl['last']-$i).'</font>';
			}
			$html .= '</sup>';
		}
		$html .= ' &nbsp; &nbsp; '.$u->microLogin($pl['uid'],1);
		$html .= ' &nbsp; '.$pl['rating'].'<br>';
	}
	$i++;
}*/

//echo $html;

?>