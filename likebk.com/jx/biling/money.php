<?php 
define('GAME',true);
include_once('../_incl_data/__config.php');
include_once('../_incl_data/class/__db_connect.php');
include_once('../_incl_data/class/__user.php');
//print_r($_POST);
$money2 = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$u->info['id'].'"'));	
?>
<h3>¬аш баланс счЄта:</h3> <span><?php echo number_format($money2['money2'],2,',',' ');?></span> екр. <h3>и</h3> <span><?php echo number_format($u->info['money'],2,',',' ');?></span> кр.