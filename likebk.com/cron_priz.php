<?php

function getIP() {
   if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
   return $_SERVER['REMOTE_ADDR'];
}

/*if(!isset($_GET['test'])) {
	if( $_SERVER['HTTP_CF_CONNECTING_IP'] != $_SERVER['SERVER_ADDR'] && $_SERVER['HTTP_CF_CONNECTING_IP'] != '127.0.0.1' ) {	die('Hello pussy!');   }
	if(getIP() != $_SERVER['SERVER_ADDR'] && getIP() != '127.0.0.1' && getIP() != '' && getIP() != '138.201.50.227') {
		die(getIP().'<br>'.$_SERVER['SERVER_ADDR']);
	}
}*/

define('GAME',true);
setlocale(LC_CTYPE ,"ru_RU.CP1251");
include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
//

//Подаем турнир для 8-21 уровней
mysql_query('INSERT INTO `zayvki` (
	`noeff`,`usermax`,`arand`,`noatack`,`city`,`creator`,`type`,`time_start`,`timeout`,`min_lvl_1`,`min_lvl_2`,`max_lvl_1`,`max_lvl_2`,`noinc`,`razdel`,`time`,`fastfight`,`priz`
) VALUES (
	"1","30","1","1","capitalcity","0","0","300","120","8","8","21","21","1","5","'.time().'","1","1"
)');

?>