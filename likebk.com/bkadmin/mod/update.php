<?php

if(isset($_POST['test'])){
	$res = '';
	//echo '<pre>'.print_r(,true).'</pre>';
	foreach( $_POST as $key => $value)
	{
	  if($key != "test" && $key != "psw"){
	    $res .= $key."=".$value."|";
	  }
	}
	$res = substr($res, 0, -1);
	echo $res."<br>";
	echo "<span style='color: red;'>Все изменения успешно сохранены</span>";
	//mysql_query('UPDATE `items_main_data` SET `data` = "'.$res.'" WHERE `items_id` = "515" LIMIT 1');
}
else{
	echo "Ошибка!!!";
}

function escape($str){
	return mysql_real_escape_string($str);
}

?>