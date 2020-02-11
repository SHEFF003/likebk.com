<?php
define('GAME',true);
setlocale(LC_CTYPE ,"ru_RU.CP1251");
include('../_incl_data/__config.php');
include('../_incl_data/class/__db_connect.php');
include('../_incl_data/class/__user.php');

 /*$s = mysql_query('select * from `dungeon_mapes` where `id_dng` = 108');
 
 $ok = 0;
 
	while($m = mysql_fetch_array($s)) {
		$values = '"'.$m['id_dng'].'","'.$m['x'].'","'.$m['y'].'","'.$m['name'].'","'.$m['style'].'","'.$m['go'].'","'.$m['togo'].'","'.$m['st'].'","'.$m['go_1'].'","'.$m['go_2'].'","'.$m['go_3'].'","'.$m['go_4'].'","'.$m['go_5'].'","'.$m['no_bot'].'","'.$m['css'].'","'.$m['fileadd'].'","'.$m['file'].'","'.$m['tr_items'].'","'.$m['timeGO'].'"';
		$ok = mysql_query('INSERT INTO `dungeon_map` (`id_dng`,`x`,`y`,`name`,`style`,`go`,`togo`,`st`,`go_1`,`go_2`,`go_3`,`go_4`,`go_5`,`no_bot`,`css`,`fileadd`,`file`,`tr_items`,`timeGO`) values ('.$values.')');
		
	}
	
 if($ok != 0) {
	 echo 'Status Map: TRUE';
 }else{
	 echo 'Status Map: FALSE';
 }
 
 $ok = 0;
 
 $bb = mysql_query('select * from `dungeon_botes` where `for_dn` = 108');
 
 while($b = mysql_fetch_array($bb)) {
	 $values = '"'.$b['for_dn'].'","'.$b['id_bot'].'","'.$b['bot_group'].'","'.$b['colvo'].'","'.$b['items'].'","'.$b['x'].'","'.$b['y'].'","'.$b['s'].'","'.$b['delete'].'","'.$b['dialog'].'","'.$b['go_bot'].'","'.$b['atack'].'"';
	 $ok = mysql_query('INSERT INTO `dungeon_bots` (`for_dn`,`id_bot`,`bot_group`,`colvo`,`items`,`x`,`y`,`s`,`delete`,`dialog`,`go_bot`,`atack`) values ('.$values.')');
	 
 }
 
 if($ok != 0) {
	 echo 'Status Bot: TRUE';
 }else{
	 echo 'Status Bot: FALSE';
 }*/
 
?>