<?php
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__magic.php');
include('_incl_data/class/__user.php');

if( $u->info['admin'] == 0 ) {
	die();
}

if(isset($_GET['iid'])) {
	$_POST['iid'] = $_GET['iid'];
}

if(isset($_POST['iid'])) {
	$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.mysql_real_escape_string($_POST['iid']).'" LIMIT 1'));
	if(!isset($usr['id'])) {
		echo '<div>ИГРОК НЕ НАЙДЕН!</div>';
	}elseif( $usr['twink'] > 0 ) {
		echo '<div>ИГРОК ДОЛЕН ВЫЙТИ С ТВИНКА!</div>';
	}else{
		mysql_query('DELETE FROM `actions` WHERE `uid` = "'.$usr['id'].'" AND `vals` LIKE "%twink%"');
		$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `uid` = "-92'.$usr['id'].'" AND `inShop` = 1 LIMIT 1'));
		echo 'Восстановлено предметов: '.$x[0].' шт.';
		mysql_query('UPDATE `items_users` SET `uid` = "'.$usr['id'].'" WHERE `uid` = "-92'.$usr['id'].'" AND `inShop` = 1');
	}
}

?>
<!doctype html>
<html>
<head>
<meta charset="windows-1251">
<title>Редактор твинков</title>
</head>

<body>

<? if(!isset($itm['id'])) { ?>
<form method="post" action="editor4.php">
	Введите ID персонажа: <input type="text" name="iid" value="">
	<input type="submit" value="Восстановить вещи + Обнулить время твинка">
</form>
<? }else{

	

} ?>

</body>
</html>
