<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'nalign' ) {
	$test = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "nalign" AND `time` > "'.(time()).'" LIMIT 1'));
	if( $u->info['align'] != 2 ) {
		if( isset($test['id']) ) {
			$u->error = 'Задержка не прошла, еще '.$u->timeOut($test['time']-time());
		}else{
			$u->addAction(time(),'nalign','');
			$u->error = 'Успешно использован свиток Право на Свободу!';
			mysql_query('DELETE FROM `align_time` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
		}
	}else{
		$u->error = 'Хаосники не могут пользоваться этим свитком!';
	}
}
?>