<?php
$dbgo = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
mysql_select_db('like_mainbd',$dbgo);
mysql_query('SET NAMES cp1251');
//  $dbgo = mysql_connect('localhost','root','');
// mysql_select_db('crazy',$dbgo);
// mysql_query('SET NAMES cp1251');
$id = $_POST['lvl_bot'];
$t = 0;
  	$bot = mysql_query('SELECT * FROM `users` WHERE `pass` = "saintlucia" AND `level` = "'.$id.'"');
  	while ($bt = mysql_fetch_array($bot)) {
      //$bt .=  $btl['id'].', ';
		  mysql_query('UPDATE `stats` SET `zv` = "0" WHERE `id` = "'.$bt['id'].'" AND `bot` = "2"'); 
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