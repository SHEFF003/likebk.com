<?php 

define('GAME',true);

include('../../_incl_data/__config.php');
include('../../_incl_data/class/__db_connect.php');
include('../../_incl_data/class/__user.php');


//print_r($_POST);
/*$id = '';
$cou = 0;
foreach($_POST as $key=>$val) 
{
	$id_i = explode("_", $val);
	$id .= '`id` = '.$id_i[1].' OR ';
	$cou++;
}
$id = trim($id,' OR ');

/*$it_user = mysql_query('SELECT * FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) LEFT JOIN `items_shop` AS `ish` ON (`ish`.`item_id` = `iu`.`item_id`) WHERE ('.$id.') AND `iu`.`uid` = "'.$u->info['id'].'" AND `ish`.`sid` = "609" AND `ish`.`r` = "6" AND `ish`.`kolvo` > "0"');*/
//$it_user = mysql_query('SELECT * FROM `items_users` WHERE ( '.$id.' ) AND `uid` = "'.$u->info['id'].'" AND `delete` = "0"');
//echo $id."-".$cou;
/*$na = '';
while ($it_us = mysql_fetch_array($it_user)) {
	//$it_main = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$it_us['item_id'].'"'));
	$it_main = mysql_fetch_array(mysql_query('SELECT * FROM `items_shop` WHERE `item_id` = "'.$it_us['item_id'].'" AND `sid` = "609" AND `r` = "6" AND `kolvo` > 0'));
	$na .= $it_main['item_id'].",";
}
$na = trim($na, ',');
$i = explode(',', $na);
$i = count($i);
$rep = $i;
//echo $i."=".$rep;
$upd = mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE '.$id.' ');
if($upd){
	$upd2 = mysql_query('UPDATE `rep` SET `repcapitalcity` = `repcapitalcity` + '.$rep.' WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	if($upd2){
		echo 'Вы получили "'.$rep.'" ед.';
	}
}else{
	echo "Ошибка";
}

unset($_POST);	*/

$cou = 0;
$itm_val = array();
$itm_sel = '';
foreach($_POST as $key=>$val) {
	$val = round(ltrim($val,'plrun_'));
	if(!isset($itm_va[$val])) {
		$itm_sel .= '`id` = "'.mysql_real_escape_string($val).'" OR ';
	}
}
$itm_sel = rtrim($itm_sel,' OR ');
$rep1 = 0;

$sp = mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 AND ( '.$itm_sel.' ) GROUP BY `id`');
while( $pl = mysql_fetch_array($sp) ) {
	$rep1++;
	$u->rep['nagrada'] += 1;
	//$u->rep['repcapitalcity'] += 1;
	mysql_query('UPDATE `rep` SET `nagrada` = "'.$u->rep['nagrada'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
}
echo 'Вы получили "'.$rep1.'" ед.';
mysql_query('UPDATE `rep` SET `nagrada` = "'.$u->rep['nagrada'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');