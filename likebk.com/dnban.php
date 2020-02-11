<?
define('GAME',true);
include_once('_incl_data/__config.php');
include_once('_incl_data/class/__db_connect.php');
include_once('_incl_data/class/__user.php');

if( $u->info['admin'] > 0 ) {
?>
<!doctype html>
<html>
<head>
<meta charset="windows-1251">
<title>Текущие походы в пещере</title>
<link href="http://img.likebk.com/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.js"></script>
</head>

<body>
<?

if(isset($_GET['log'])) {
	
	$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.mysql_real_escape_string($_GET['log']).'" LIMIT 1'));
	if(isset($usr['id'])) {
		echo '<a href="/dnban.php?log='.$usr['id'].'">Обновить</a><hr>';
		$sp = mysql_query('SELECT * FROM `files_look` WHERE `user` = "'.$usr['login'].'" ORDER BY `time` DESC LIMIT 500');
		while( $pl = mysql_fetch_array($sp) ) {
			echo '['.date('d.m.Y H:i:s',$pl['time']).'] &nbsp; ' . $pl['url'] . '<br>';
		}
	}else{
		echo 'Пользователь не найден!';
	}
	
}else{

	$dnid = 0;
	$sp = mysql_query('SELECT `u`.* , `s`.`dnow` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id` WHERE `s`.`dnow` > 0 AND `s`.`bot` = 0 ORDER BY `s`.`dnow` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		if( $pl['online'] > time() - 240 ) {
			echo $u->microLogin($pl['id'],1);
			echo '<B> <font color=green>ONLINE</font></B>';
		}else{
			echo '<font color=#aeaeae>'.$u->microLogin($pl['id'],1).' (был тут '.$u->timeOut(time()-$pl['online']).' назад)</font>';
		}
		$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `files_look` WHERE `user` = "'.$pl['login'].'" AND `time` > "'.(time()-600).'" LIMIT 1'));
		$x = $x[0];
		echo ' Запросов за 10 мин: <b>'.$x.'</b> <a href="/dnban.php?log='.$pl['id'].'" target="_blank">лог</a>';
		if( $dnid != $pl['dnow'] ) {
			echo ' <font color=blue><small>[ПОХОД №'.$pl['dnow'].']</small></font>';
			$dnid = $pl['dnow'];
			echo '<hr>';
		}else{
			echo '<br><br>';
		}
	}

}

?>
</body>
</html>
<?	
}
?>