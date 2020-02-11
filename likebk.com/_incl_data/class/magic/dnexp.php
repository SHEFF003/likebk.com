<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'dnexp' ) {
	$test = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "dnexp" AND `time` > "'.(time()).'" LIMIT 1'));
	if( $u->info['align'] != 2 ) {
		if( isset($test['id']) ) {
			$u->error = 'Задержка не прошла, еще '.$u->timeOut($test['time']-time());
		}else{
			//
			$dngcity = array(
				9497 => array('angelscity','Бездна'),
				9498 => array('capitalcity','Пещера Тысячи Проклятий'),
				9499 => array('demonscity','Катакомбы'),
				9500 => array('abandonedplain','Гора Легиона'),
				9501 => array('suncity','Грибница'),
				9502 => array('sandcity','Пещера Мглы')
			);
			//
			$dngcity = $dngcity[$itm['item_id']];
			//
			if(!isset($u->rep['id'])) {
				$u->error = 'Произошла ошибка... попробуйте позже!';
			}elseif($u->rep['rep'.$dngcity[0]] == 9999) {
				$u->error = 'Вам необходимо набрать еще 1 ед. репутации в подземелье '.$dngcity[1].' чтобы вспользоваться этим свитком!.';
			}else{
				//
				$u->addAction(time(),'dnexp','');
				//$u->error = 'Все прошло успешно, задержки на получение задания в пещеру '.$dngcity[1].' снята.';
				$u->error = 'Успешно использован свиток Поднять репутацию ('.$dngcity[1].') +1000 ед.';
				$u->rep['rep'.$dngcity[0]] += 1000;
				mysql_query('UPDATE `rep` SET `rep'.$dngcity[0].'` = "'.$u->rep['rep'.$dngcity[0]].'", `nagrada` = `nagrada` + 1000 WHERE `id` = "'.$u->rep['id'].'" LIMIT 1');
				mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			}
		}
	}else{
		$u->error = 'Хаосники не могут пользоваться этим свитком!';
	}
}
?>