<?php 
$dbgo = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
mysql_select_db('like_mainbd',$dbgo);
mysql_query('SET NAMES cp1251');
/*$dbgo = mysql_connect('localhost','root','');
mysql_select_db('crazy',$dbgo);
mysql_query('SET NAMES cp1251');*/
$id_main = $_GET['id'];
if(isset($_POST['sid'])){
	$res = '`item_id` = "'.mysql_real_escape_string($id_main).'"';
	$res2 = '';
	foreach( $_POST as $key => $value)
	{
	   if($value != ''){
    	    $res .= ',`'.$key.'` = "'.mysql_real_escape_string($value).'" ';
    	}
	}
	$res = trim($res, ',');
	echo $res;
	$ins = mysql_query('INSERT INTO `items_shop` SET '.$res.' ');
	mysql_query('INSERT INTO `items_main_data` SET `items_id` = "'.$id_main.'" ');
	if($ins)
	{
		$id_r = mysql_insert_id();
		echo "<span style='font-size: 15px; color: red;'>Вы успешно добавили вещь в магазин (id = ".$id_r.")</span><br>";
	}else{
		echo "<span style='font-size: 15px; color: red;'>Ошибка в добавление!</span>";	
	}	
	/*mysql_query('UPDATE `items_main` SET `price1` = "'.$res2.'" WHERE `id` = '.$_GET['id'].' LIMIT 1');
	mysql_query('UPDATE `items_main_data` SET `data` = "'.$res.'" WHERE `items_id` = '.$_GET['id'].' LIMIT 1');*/
	
}
?>