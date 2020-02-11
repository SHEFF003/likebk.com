<?php

die();

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

if(isset($_GET['list'])) {
	$i = 1;
	$sp = mysql_query('SELECT * , COUNT(*) AS `x` FROM `aaa_f1` GROUP BY `uid` ORDER BY `x` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		echo $i . '. '. $u->microLogin($pl['uid'],1).' -> запросов без подтверждения: '.$pl['x'].'<br><br>';
		$i++;
	}
}elseif(isset($u->info['id'])) {
	if( is_array($_POST['data']) ) {
		$_POST['data'] = json_encode($_POST['data']);
	}
	if( $_POST['data'] != '' ) {
		mysql_query('INSERT INTO `aaa_bot` (`itmid`,`uid`,`data`,`time`) VALUES ("'.mysql_real_escape_string($_POST['itmid']).'","'.$u->info['id'].'","'.mysql_real_escape_string($_POST['data']).'","'.time().'")');
	}
}

?>