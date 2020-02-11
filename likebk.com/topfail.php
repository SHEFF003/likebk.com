<?

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

if(isset($u->info['id']) && $u->info['admin'] > 0 ) {
	echo 'Список игроков:<br><br>';
	$sp = mysql_query('SELECT * FROM `captcha` WHERE `fail` > 1 ORDER BY `fail` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		$rec = ($pl['result'] - $pl['time']);
		if( $rec > 0 ) {
			$rec = $u->timeOut($rec);
		}else{
			$rec = '<font color=red>нет ответа</font>';
		}
		echo 'Ошибок: ' . $pl['fail'] . ' | Реакция: '.$rec.' | ' .$u->microLogin($pl['uid'],1).'<br>';
	}
}

?>	