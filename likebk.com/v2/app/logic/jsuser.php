<?
use \Core\Database as db;
use \Core\User as u;

$found_module = true;
u::connect(utf1251($_COOKIE['login']),utf1251($_COOKIE['pass']));
if( !defined('OK') || !isset(u::$info['id']) ) {
	die('{"error":"Invalid request, user not defined"}');
}

$r = array();

//Предметы пользователя
$r['items'] = db::query('SELECT
	`id`,`delete`,`item_id`,`data`,`inOdet`,`iznosNOW`,`iznosMAX`,`gift`,`magic_inc`,`inGroup`,`lastUPD`,`time_create`,`bexp`,`blvl`,`1price`,`2price`,`3price`,`4price`,`5price`
FROM `items_users` WHERE `uid` = :uid AND `delete` = 0 AND `inShop` = 0 AND `inTransfer` = 0 AND `comsid` = 0 ORDER BY `lastUPD` DESC',array(
	'uid'	=> u::$info['id']
),true,true);

//Приемы
$r['priems_main'] = db::query('SELECT `id`,`img`,`name`,`info` FROM `priems`',array(
	
),true,true);

$i = 0;
$ri = $r['priems_main'];
while( $i < count($ri) ) {
	$r['priems_main'][$ri[$i]['id']] = $ri[$i];
	$i++;
}
unset($ri,$i);

//Эффекты
$r['eff_main'] = db::query('SELECT `id2`,`img`,`mname`,`info` FROM `eff_main`',array(
	
),true,true);

//Предметы пользователя
$r['items_main'] = db::query('SELECT
	`id`,`srok`,`name`,`img`,`type`,`inslot`,`2h`,`2too`,`inRazdel`,`magic_chance`,`info`,`massa`,`magic_inci`,`overTypei`,`group`,`group_max`,`useInBattle`,`onlyone`,`unik`
FROM `items_main` ORDER BY `id` DESC',array(

),true,true);

$r['items_lastID'] = time();

echo '_bk.user.data = ' . json_encode($r) . ';';

echo '_bk.is = '.json_encode(u::$is).';';

echo '_bk.items = '.json_encode(u::$items).';';

?>