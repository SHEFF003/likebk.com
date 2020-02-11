<?php
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__magic.php');
include('_incl_data/class/__user.php');

if($u->info['admin'] == 0) {
	header('location: /index.php');
	die();
}

if(isset($_GET['use'])) {
	$test = mysql_fetch_array(mysql_query('SELECT `id`,`nfm` FROM `priems` WHERE `id` = "'.mysql_real_escape_string($_GET['use']).'" LIMIT 1'));
	if(isset($test['id'])) {
		if( $test['nfm'] > 0 ) {
			$test['nfm'] = 0;
		}else{
			$test['nfm'] = 1;
		}
		mysql_query('UPDATE `priems` SET `nfm` = "'.$test['nfm'].'" WHERE `id` = "'.$test['id'].'" LIMIT 1');
	}
	header('location: /admin_mp.php');
}

?>

<center>
<?
echo '<br><h3>Общедоступные приемы</h3>';
$sp = mysql_query('SELECT * FROM `priems` WHERE `nfm` = 0 AND `activ` != 0 ORDER BY `img` ASC');
while( $pl = mysql_fetch_array($sp) ) {
	echo '<a href="/admin_mp.php?use='.$pl['id'].'"><img width="40" height="25" title="'.$pl['name'].'" src="http://img.likebk.com/i/eff/'.$pl['img'].'.gif"></a> ';
}
echo '<br><br><h3>Приемы которые нельзя использовать магу</h3>';
$sp = mysql_query('SELECT * FROM `priems` WHERE `nfm` > 0 AND `activ` != 0 ORDER BY `img` ASC');
while( $pl = mysql_fetch_array($sp) ) {
	echo '<a href="/admin_mp.php?use='.$pl['id'].'"><img src="http://img.likebk.com/i/eff/'.$pl['img'].'.gif"></a> ';
}
?>
</center>
</body>
</html>