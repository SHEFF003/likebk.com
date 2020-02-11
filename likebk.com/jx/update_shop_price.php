<?php
	define('GAME',true);
	include('../_incl_data/class/__db_connect.php');
if(isset($_GET['id_sh'])){
	$cena1=0; $cena2=0; $cena3 = 0;
	foreach ($_POST as $key => $value) {
		if($key == 'price_1'){
			$cena1 = $value;		
		}
		elseif($key == 'price_2'){
			$cena2 = $value;		
		}
		elseif($key == 'price_3'){
			$cena3 = $value;	
		}
	}
	if($cena1 != 0){
		$re = mysql_query("UPDATE `items_shop` SET `price_1` = ".$cena1." WHERE `item_id` = ".$_GET['id_sh']." AND `sid` = ".$_GET['sid_sh']."");
		if($re){
			echo 'Вы успешно обновили цену';
		}else{
			echo 'Ошибка';
		}
	}
	elseif($cena2 != 0){
		$re = mysql_query("UPDATE `items_shop` SET `price_2` = ".$cena2." WHERE `item_id` = ".$_GET['id_sh']." AND `sid` = ".$_GET['sid_sh']."");
		if($re){
			echo 'Вы успешно обновили цену';
		}else{
			echo 'Ошибка';
		}
	}
	elseif($cena3 != 0){
		$re = mysql_query("UPDATE `items_shop` SET `price_3` = ".$cena3." WHERE `item_id` = ".$_GET['id_sh']." AND `sid` = ".$_GET['sid_sh']."");
		if($re){
			echo 'Вы успешно обновили цену';
		}else{
			echo 'Ошибка';
		}
	}
}
elseif(isset($_GET['id_su'])){
	$str2 = iconv("UTF-8", "WINDOWS-1251", $_POST['name_su']);
	$re = mysql_query("UPDATE `items_main` SET `name` = '".$str2."' WHERE `id` = '".$_GET['id_su']."'");
	if($re){
		echo 'Вы успешно обновили название';
	}else{
		echo 'Ошибка';
	}
}
?>