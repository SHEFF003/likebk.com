<?php
$dbgo = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
mysql_select_db('like_mainbd',$dbgo);
mysql_query('SET NAMES cp1251');
/* $dbgo = mysql_connect('localhost','root','');
mysql_select_db('crazy',$dbgo);
mysql_query('SET NAMES cp1251');*/
if(isset($_POST['test'])){
	$res = '';
	$res2 = '';
	//echo '<pre>'.print_r(,true).'</pre>';
	foreach( $_POST as $key => $value)
	{
	  	if($key != 'test'){
    	    $res = $value;
    	    // echo $key ."=". $res."<br>";
    	    mysql_query('UPDATE `items_shop` SET `pos` = "'.$res.'" WHERE `iid` = '.$key.' ');
    	}
	  
	}
	echo "���������";
	//$res = substr($res, 0, -1);
	
	/*mysql_query('UPDATE `items_main` SET `price1` = "'.$res2.'" WHERE `id` = '.$_GET['id'].' LIMIT 1');
	mysql_query('UPDATE `items_main_data` SET `data` = "'.$res.'" WHERE `items_id` = '.$_GET['id'].' LIMIT 1');
	echo "<span style='font-size: 15px; color: red;'>��� ��������� ������� ���������</span>";*/
}
else{
	echo "������!!!";
}

function escape($str){
	return mysql_real_escape_string($str);
}

?>