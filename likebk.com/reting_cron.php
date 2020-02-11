<?
	define('GAME',true);
	include('_incl_data/__config.php');
	include('_incl_data/class/__db_connect.php');

	if(isset($_GET['test'])) {
		$html = '';
		$sp = mysql_query('SELECT * FROM `aaa_reting_list` WHERE `date` = "'.date('dmY').'" ORDER BY `pos` ASC LIMIT 1000');
		while( $pl = mysql_fetch_array($sp) ) {
			$usr = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`level` FROM `users` WHERE `id` = "'.$pl['uid'].'" LIMIT 1'));
			$ret = round($pl['global']/(10000+$usr['level']),2);
			$html .= '('.$pl['pos'].') '.$usr['login'].' ['.$usr['level'].'] - '.$ret.'<br>';
		}
		echo $html;
		die();
	}
	
	$add_exp_list = array();
	$all_exp_list = array();
	$exp_list = array();
	$win_list = array();
	
	$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `aaa_reting_list` WHERE `date` = "'.date('dmY').'" LIMIT 1'));
	if(isset($test['id'])) {
		mysql_query('DELETE FROM `aaa_reting_list` WHERE `date` = "'.date('dmY').'"');
	}
	unset($test);
		
	$sp = mysql_query('SELECT `id`,`login`,`win` FROM `users` WHERE `real` = 1 AND `admin` = 0 AND `pass` NOT LIKE "%saint%"');
	while( $pl = mysql_fetch_array($sp) ) {
		$st = mysql_fetch_array(mysql_query('SELECT `id`,`exp` FROM `stats` WHERE `id` = "'.$pl['id'].'" LIMIT 1'));
		$rl = mysql_fetch_array(mysql_query('SELECT `exp`,`global`,`exp_real` FROM `aaa_reting_list` WHERE `uid` = "'.$pl['id'].'" ORDER BY `id` DESC LIMIT 1'));
		
		$exp_list[$pl['id']] = $st['exp'];
		
		$win_list[$pl['id']] = $pl['win'];
		
		$add_exp = $st['exp'] - $rl['exp_real'];
		
		$global_exp = 0; //значение рейтинга за 100 дней, каждый последующий день -1%
		$cp = mysql_query('SELECT `exp` FROM `aaa_reting_list` WHERE `uid` = "'.$pl['id'].'" ORDER BY `id` DESC LIMIT 100');
		$dd = 0;
		while( $cl = mysql_fetch_array($cp) ) {
			$global_exp += round($cl['exp']/100*(100-$dd));
			$dd++;
		}
		
		$add_exp_list[$pl['id']] = $add_exp; //записываем сколько опыта получил за сегодня
		$all_exp_list[$pl['id']] = $global_exp + $add_exp; //записываем сколько опыта получил всего + сегодняшний		
	}
	unset($pl,$sp);
	
	arsort($all_exp_list);
	
	$keys = array_keys($all_exp_list);
	
	$i = 0;
	while( $i <= count($keys) ) {
		if( isset($keys[$i]) ) {
			mysql_query('INSERT INTO `aaa_reting_list` ( `win`,`exp_real`,`uid`,`pos`,`global`,`exp`,`date`,`time` ) VALUES (
				"'.$win_list[$keys[$i]].'","'.$exp_list[$keys[$i]].'","'.$keys[$i].'","'.($i+1).'","'.$all_exp_list[$keys[$i]].'","'.$add_exp_list[$keys[$i]].'","'.date('dmY').'","'.time().'"
			)');
		}
		$i++;
	}
?>