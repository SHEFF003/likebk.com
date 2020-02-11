<?php
function GetRealIp(){
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
		return $_SERVER['HTTP_CLIENT_IP'];
	else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	return $_SERVER['REMOTE_ADDR'];
}

define('IP',GetRealIp());

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');

if(isset($_GET['start'])) {
	echo '<a href="/d_admin.php?start">ОБНОВИТЬ СТРАНИЦУ</a><hr>';
	if(isset($_GET['clearall'])) {
		mysql_query('DELETE FROM `gourl`');
	}elseif(isset($_POST['url2'])) {
		mysql_query('DELETE FROM `gourl`');
		mysql_query('INSERT INTO `gourl` (`url`,`x`,`time`) VALUES ("'.mysql_real_escape_string($_POST['url2']).'","0","'.time().'")');
	}
	
	$test = mysql_fetch_array(mysql_query('SELECT * FROM `gourl` ORDER BY `id` DESC LIMIT 1'));
	if(isset($test['id'])) {
		echo '<b><font color="red">Идет прогон по ссылке: <a href="http://'.$test['url'].'" target="_blank">'.$test['url'].'</a></font></b>';
		echo '<br>Сделано запросов всего: '.$test['x'];
		echo '<br>Запросов в секунду: '.round( $test['x'] / ( time() - $test['time'] ) ).'';
		echo '<hr>';
	}
?>
<form method="post" action="/d_admin.php?start">
<input type="text" name="url2" value=""> <input type="submit" value="Добавить новый"><hr>
<a href="/d_admin.php?start&clearall">Остановить прогон</a>
</form>
<?
	
}else{
	header('location: /index.php');
}



?>