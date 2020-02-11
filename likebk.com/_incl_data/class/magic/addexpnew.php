<?
if(!defined('GAME'))
{
	die();
}

$efft100 = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `id_eff` = "477" LIMIT 1'));
$efft30 = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `id_eff` = "478" LIMIT 1'));
$efft20 = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `id_eff` = "479" LIMIT 1'));
$efft10 = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `id_eff` = "480" LIMIT 1'));

if( $itm['id'] > 0 && $itm['item_id'] == 6855 ) {
	//100%
	$u->error = 'Вы использовали &quot;'.$itm['name'].'&quot;!';
		
	if(isset($efft30['id'])) {
		mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$efft30['id'].'" LIMIT 1');
	}
	if(isset($efft20['id'])) {
		mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$efft20['id'].'" LIMIT 1');
	}
	if(isset($efft10['id'])) {
		mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$efft10['id'].'" LIMIT 1');
	}
	if(isset($efft100['id'])) {
		mysql_query('UPDATE `eff_users` SET `timeUse` = `timeUse` + "'.(86400*7).'" WHERE `id` = "'.$efft100['id'].'" LIMIT 1');
	}else{
		mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`) VALUES (
			"477","'.$u->info['id'].'","Повышение опыта","add_exp2=100","'.time().'"
		)');
	}
	
	mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
}elseif( $itm['id'] > 0 && $itm['item_id'] == 6856 ) {
	//30%
	$u->error = 'Вы использовали &quot;'.$itm['name'].'&quot;!';
	
	if(isset($efft20['id'])) {
		mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$efft20['id'].'" LIMIT 1');
	}
	if(isset($efft10['id'])) {
		mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$efft10['id'].'" LIMIT 1');
	}
	if(isset($efft100['id'])) {
		
	}elseif(isset($efft30['id'])) {
		mysql_query('UPDATE `eff_users` SET `timeUse` = `timeUse` + "'.(86400*7).'" WHERE `id` = "'.$efft30['id'].'" LIMIT 1');
	}else{
		mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`) VALUES (
			"478","'.$u->info['id'].'","Повышение опыта","add_exp2=30","'.time().'"
		)');
	}
	
	mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
}elseif( $itm['id'] > 0 && $itm['item_id'] == 6857 ) {
	//20%
	$u->error = 'Вы использовали &quot;'.$itm['name'].'&quot;!';
	
	if(isset($efft10['id'])) {
		mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$efft10['id'].'" LIMIT 1');
	}
	if(isset($efft100['id']) || isset($efft30['id']) ) {
		
	}elseif(isset($efft20['id'])) {
		mysql_query('UPDATE `eff_users` SET `timeUse` = `timeUse` + "'.(86400*7).'" WHERE `id` = "'.$efft20['id'].'" LIMIT 1');
	}else{
		mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`) VALUES (
			"479","'.$u->info['id'].'","Повышение опыта","add_exp2=20","'.time().'"
		)');
	}
	
	mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
}elseif( $itm['id'] > 0 && $itm['item_id'] == 6858 ) {
	//10%
	$u->error = 'Вы использовали &quot;'.$itm['name'].'&quot;!';
	
	if(isset($efft100['id']) || isset($efft30['id']) || isset($efft20['id'])) {
		
	}elseif(isset($efft10['id'])) {
		mysql_query('UPDATE `eff_users` SET `timeUse` = `timeUse` + "'.(86400*7).'" WHERE `id` = "'.$efft10['id'].'" LIMIT 1');
	}else{
		mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`) VALUES (
			"480","'.$u->info['id'].'","Повышение опыта","add_exp2=10","'.time().'"
		)');
	}
	
	mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
}
?>