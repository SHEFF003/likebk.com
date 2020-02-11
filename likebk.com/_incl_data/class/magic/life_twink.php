<?
if(!defined('GAME'))
{
	die();
}

$tw = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vals` = "twink'.$u->info['id'].'" LIMIT 1'));

if(isset($tw['id'])) {
	$tw['time'] = $tw['time'] + 3600;
	mysql_query('UPDATE `actions` SET `time` = '.$tw['time'].' WHERE `id` = '.$tw['id'].' LIMIT 1');
	$u->error = 'Вы продлили жизнь твинку :)';
	mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
}else{
	$u->error = 'Данные о твинке не найдены!';
}

?>