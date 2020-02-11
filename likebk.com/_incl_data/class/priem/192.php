<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Очиститься кровью
*/
$pvr = array();

/*
$pvr['no'] = ' AND `a`.`v2` != 201';
$pvr['no'] .= ' AND `a`.`v2` != 42 AND `a`.`v2` != 121 AND `a`.`v2` != 122 AND `a`.`v2` != 123 AND `a`.`v2` != 124 AND `a`.`v2` != 125';
$pvr['no'] .= ' AND `a`.`v2` != 186 AND `a`.`v2` != 246 AND `a`.`v2` != 257 AND `a`.`v2` != 281';
$pvr['no'] .= ' AND `a`.`v2` != 282';
$pvr['no'] .= ' AND `a`.`v2` != 21 AND `a`.`v2` != 73 AND `a`.`v2` != 74 AND `a`.`v2` != 75 AND `a`.`v2` != 76 AND `a`.`v2` != 77 AND `a`.`v2` != 78 AND `a`.`v2` != 79';
*/

$pvr['no'] = ' AND `a`.`v2` != 201';
$pvr['no'] = ' AND `a`.`v2` != 31';

$pvr['no'] .= ' AND `a`.`v2` != 191';

$pvr['no'] .= ' AND `a`.`v2` != 292'; //искалечить
$pvr['no'] .= ' AND `a`.`v2` != 237'; //разведка боем

$pvr['no'] .= ' AND `a`.`v2` != 260';

$pvr['no'] .= ' AND `a`.`v2` != 280';
$pvr['no'] .= ' AND `a`.`v2` != 201';
$pvr['no'] .= ' AND `a`.`v2` != 42 AND `a`.`v2` != 121 AND `a`.`v2` != 122 AND `a`.`v2` != 123 AND `a`.`v2` != 124 AND `a`.`v2` != 125';
$pvr['no'] .= ' AND `a`.`v2` != 186 AND `a`.`v2` != 246 AND `a`.`v2` != 257 AND `a`.`v2` != 281';
$pvr['no'] .= ' AND `a`.`v2` != 282';
$pvr['no'] .= ' AND `a`.`v2` != 21 AND `a`.`v2` != 73 AND `a`.`v2` != 74 AND `a`.`v2` != 75 AND `a`.`v2` != 76 AND `a`.`v2` != 77 AND `a`.`v2` != 78 AND `a`.`v2` != 79';
$pvr['no'] .= ' AND `a`.`v2` != 395';
$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Оледенение%" ';

//$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Пожирающее Пламя%" ';

$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Серое Мастерство%" ';
$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Метеорит%" ';
$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Регенерация%" ';
$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Туманный образ%" ';
$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Жертва%" ';
$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Призрачн%" ';
$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Заряд: Шок%" ';
//$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Кристаллизация%" ';
$pvr['no'] .= ' AND `a`.`name` NOT LIKE "Разведка боем%" ';

$pvr['sp'] = mysql_query('SELECT `a`.* FROM `eff_users` AS `a` LEFT JOIN `priems` AS `b` ON `b`.`id` = `a`.`v2` WHERE `a`.`uid` = "'.$u->info['id'].'" AND `a`.`delete` = 0 AND `a`.`v1` = "priem" '.$pvr['no'].' AND ( `b`.`neg` > 0 OR `a`.`v2` = 191 ) ORDER BY RAND() LIMIT 1');
$pvr['pl'] = mysql_fetch_array($pvr['sp']);
$pvr['pl']['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$pvr['pl']['v2'].'" LIMIT 1'));
if( isset($pvr['pl']['priem']['id']) ) {
	$btl->delPriem($pvr['pl'],$btl->users[$btl->uids[$u->info['id']]],100);	
	mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `id` = "'.$pvr['pl']['id'].'" LIMIT 1');	
	//Отнимаем тактики
	$this->mintr($pl);
	$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],
		'Очиститься кровью',
		'{tm1} '.$btl->addlt(1 , 17 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL).'',
		($btl->hodID)
	);
	echo '<font color=red><b>Вы успешно использовали прием &quot;Очиститься кровью&quot;</b></font>';
}else{
	//Отнимаем тактики
	//$this->mintr($pl);
	//echo '<font color=red><b>Вы успешно использовали прием &quot;Очиститься кровью&quot;, нет негативных эффектов которые можно снять.</b></font>';
	//Действие при клике
	/*
	$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],
		'Очиститься кровью',
		'{tm1} '.$btl->addlt(1 , 17 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL).'',
		($btl->hodID)
	);
	*/
	echo '<font color=red><b>Не удалось использовать &quot;Очиститься кровью&quot;, нет негативных эффектов которые можно снять</b></font>';
	$cup = true;
}
unset($pvr);
?>