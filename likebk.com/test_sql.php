<?php

die();

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');

if(isset($_GET['test'])) {
	//
	$t = mysql_fetch_array(mysql_query('SELECT * FROM `test` WHERE `id` = 1 LIMIT 1'));
	//
	echo 'INSERT INTO `test` ( `value` , `time` )VALUES("'.$t['value'].'","'.time().'")';
	mysql_query('INSERT INTO `test` ( `value` , `time` )VALUES("'.$t['value'].'","'.time().'")');
	echo '<hr>';
	print_r(mysql_error());
}

?>