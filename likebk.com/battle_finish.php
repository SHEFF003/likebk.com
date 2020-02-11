<?

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');
	
function inuser_go_btl($id) {
	if(isset($id['id'])) {
		$r .= file_get_contents('http://likebk.com/jx/battle/refresh.php?finishnew=true&uid='.$id['id'].'&cron_core='.md5($id['id'].'_brfCOreW@!_'.$id['pass']).'&pass='.$id['pass']);
		$r .= '<hr>';
	}else{
		$r = 'false';
	}
	return $r;
}
	
function e($txt) {
	mysql_query('INSERT INTO `fuck_users` (`win_lost`) VALUES ("'.mysql_real_escape_string($txt).'")');
}

	
if(isset($_GET['bid'])) {
	
	$b = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle` WHERE `id` = "'.mysql_real_escape_string($_GET['bid']).'" LIMIT 1'));
	if(isset($b['id'])) {
		//Проверяем поединок
		$ux = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `users` WHERE `battle` = "'.$b['id'].'" LIMIT 1'));
		$ux = $ux[0];
		if(round($ux) == 0) {
			mysql_query('UPDATE `battle` SET `team_win` = 0 WHERE `id` = "'.$b['id'].'" LIMIT 1');
			$r = '+bad';
		}else{
			$sp = mysql_query('SELECT `s`.`team` , SUM(`s`.`hpNow`) AS `hp` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `u`.`id` = `s`.`id` WHERE `u`.`battle` = "'.$b['id'].'" GROUP BY `s`.`team`');
			while( $pl = mysql_fetch_array($sp) ) {
				if( $pl['hp'] >= 1 ) {
					$tms++;
				}
			}
			if( $tms < 2 ) {
				//завершаем
				//
				$user = mysql_fetch_array(mysql_query('SELECT `id`,`pass` FROM `users` WHERE `battle` = "'.$b['id'].'" ORDER BY `online` DESC LIMIT 1'));
				if(isset($user['id']) && $user['id'] == 12345) {
					e( inuser_go_btl($user) );
					mysql_query('INSERT INTO `fuck_users` (`win_lost`) VALUES ("!'.$b['id'].' - '.$user['id'].' - '.'http://likebk.com/jx/battle/refresh.php?finishnew=true&uid='.$user['id'].'&cron_core='.md5($user['id'].'_brfCOreW@!_'.$user['pass']).'&pass='.$user['pass'].' - FINISH")');
				}
				$r = 'good';
				//
			}else{
				$r = 'bad+';
			}
		}
	}else{
		$r = 'bad-';
	}
}else{
	$r = '-bad';
}
e($r.'['.$b['id'].']');

echo $r;

?>