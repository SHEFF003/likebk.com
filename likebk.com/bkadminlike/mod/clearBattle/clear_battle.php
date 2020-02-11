<?php
$dbgo = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
mysql_select_db('like_mainbd',$dbgo);
mysql_query('SET NAMES cp1251');
//  $dbgo = mysql_connect('localhost','root','');
// mysql_select_db('crazy',$dbgo);
// mysql_query('SET NAMES cp1251');
$id = $_POST['id_battle'];
$t = 0;
  	$battle = mysql_query('SELECT * FROM `battle` WHERE `time_over` = "0" AND `id` <= "'.$id.'"');
  	while ($btl = mysql_fetch_array($battle)) {
      $bt .=  $btl['id'].', ';
		  mysql_query('UPDATE `battle` SET `time_over` = "'.time().'" WHERE `id` = "'.$btl['id'].'"'); 
      $user_battle = mysql_query('SELECT * FROM `battle_users` WHERE `plus` = "0" AND `battle` = "'.$btl['id'].'"');
      while ($us_btl = mysql_fetch_array($user_battle)) {
        mysql_query('UPDATE `battle_users` SET `plus` = "1" WHERE `id` = '.$us_btl['id'].' LIMIT 1'); 
      }
      $t = 1;
  	}
  //echo $bt;
  if($t == 1){
		echo "Успешно завершено!";
	}
	else{
		echo "Ошибка!!!";
	}
?>