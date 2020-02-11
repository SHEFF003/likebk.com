<?php 
	$us = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$u->info['id'].'"'));
	echo $us['login'];
	if(isset($_GET['cave_sale']) && $_GET['cave_sale'] == 1){
		echo "1";
	}elseif(isset($_GET['cave_sale']) && $_GET['cave_sale'] == 2){
		echo "2";
	}elseif(isset($_GET['cave_sale']) && $_GET['cave_sale'] == 3){
		echo "3";
	}
?>
<div style="float: right;">
	<input type='button' value='Обновить' onClick="location='main.php?cave_sale'"/>
	<input type='button' onclick='location="main.php?rz=1"' value="Вернуться" />
</div>