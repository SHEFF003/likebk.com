<?php
$dbgo = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
mysql_select_db('like_mainbd',$dbgo);
mysql_query('SET NAMES cp1251');
/*$dbgo = mysql_pconnect('136.243.33.173','likebkdbmain','S8a7E4x1');
mysql_select_db('likebkdbmain',$dbgo);
mysql_query('SET NAMES cp1251');*/
//  $dbgo = mysql_connect('localhost','root','');
// mysql_select_db('crazy',$dbgo);
// mysql_query('SET NAMES cp1251');
$id = $_POST['id_battle'];
  	$user_battle = mysql_query('SELECT * FROM `battle_users` WHERE `plus` = "0" AND `battle` = "'.$id.'"');
  	while ($us_btl = mysql_fetch_array($user_battle)) {
  		//$us .= $us_btl['uid'];
		mysql_query('UPDATE `battle_users` SET `plus` = "1" WHERE `id` = '.$us_btl['id'].' LIMIT 1');	
  	}
  	//echo $id."=".$us;
  	$upd  = mysql_query('UPDATE `battle` SET `time_over` = "'.time().'" WHERE `id` = "'.$id.'"'); 
  	if($upd){
		echo "Успешно завершено!";
	}
	else{
		echo "Ошибка!!!";
	}
?>