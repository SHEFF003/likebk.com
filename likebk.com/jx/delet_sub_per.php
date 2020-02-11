<?php

define('GAME',true);

include_once('../_incl_data/class/__db_connect.php');

//echo $_GET['id_adm'];

$adm = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$_GET['id_adm5554'].'" '));

if(isset($_GET['id_sb']) && $adm['admin'] > 0){
	$upd = mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$_GET['id_sb'].'"');
	if($upd){
		echo "Удаление прошло успешно (ошибка!)";
	}
	else{
		echo "Ошибка";
	}

}

?>