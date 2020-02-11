<?php 
	define('GAME',true);

	include('../_incl_data/class/__db_connect.php');
	//print_r();
	if($_POST){
		mysql_query("UPDATE `items_shop` SET `r` = -".$_POST['r_sh']." WHERE `item_id` = ".$_POST['id_sh']." AND `sid` = ".$_POST['sid_sh']."");
		echo "ok";
	}
	else{
		echo "error";
	}
?>