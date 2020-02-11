<?php
/*
function getIP() {
   if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
   return $_SERVER['REMOTE_ADDR'];
}*/

/*if(getIP() != $_SERVER['SERVER_ADDR'] && getIP() != '127.0.0.1' && getIP() != '' && getIP() != '188.134.44.67') {
	die(getIP().'<br>'.$_SERVER['SERVER_ADDR']);
}*/

define('GAME',true);

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

$x = 0;
$sp = mysql_query('SELECT * FROM `items_users` WHERE `lastUPD` < "'.(time()-60*30).'" AND `inShop` < 2 AND `uid` > 0 AND `delete` = 0 AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `type` = 32 OR `type` = 34 OR `type` = 1206) LIMIT 50000');
while( $itm = mysql_fetch_array($sp) ) {
	$x++;
	mysql_query('INSERT INTO `items_users_res` (`id`,`item_id`,`1price`,`2price`,`3price`,`4price`,`5price`,`uid`,`use_text`,`data`,`inOdet`,`inShop`,`inGroup`,`delete`,`iznosNOW`,`iznosMAX`,`gift`,`gtxt1`,`gtxt2`,`kolvo`,`geniration`,`magic_inc`,`maidin`,`lastUPD`,`timeOver`,`overType`,`secret_id`,`time_create`,`time_sleep`,`dn_delete`,`inTransfer`,`post_delivery`,`lbtl_`,`bexp`,`so`,`blvl`,`pok_itm`,`btl_zd`,`comsid`,`kamen`) VALUES ("'.$itm['id'].'","'.$itm['item_id'].'","'.$itm['1price'].'","'.$itm['2price'].'","'.$itm['3price'].'","'.$itm['4price'].'","'.$itm['5price'].'","'.$itm['uid'].'","'.$itm['use_text'].'","'.$itm['data'].'","'.$itm['inOdet'].'","'.$itm['inShop'].'","'.$itm['inGroup'].'","'.$itm['delete'].'","'.$itm['iznosNOW'].'","'.$itm['iznosMAX'].'","'.$itm['gift'].'","'.$itm['gtxt1'].'","'.$itm['gtxt2'].'","'.$itm['kolvo'].'","'.$itm['geniration'].'","'.$itm['magic_inc'].'","'.$itm['maidin'].'","'.$itm['lastUPD'].'","'.$itm['timeOver'].'","'.$itm['overType'].'","'.$itm['secret_id'].'","'.$itm['time_create'].'","'.$itm['time_sleep'].'","'.$itm['dn_delete'].'","'.$itm['inTransfer'].'","'.$itm['post_delivery'].'","'.$itm['lbtl_'].'","'.$itm['bexp'].'","'.$itm['so'].'","'.$itm['blvl'].'","'.$itm['pok_itm'].'","'.$itm['btl_zd'].'","'.$itm['comsid'].'","'.$itm['kamen'].'")');
	mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$itm['id'].'" LIMIT 1');
}
echo 'Перенос предметов: '.$x.' шт.';
$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` IN ( SELECT `id` FROM `items_main` WHERE `type` = 32 ) LIMIT 1'));
echo '<br>Осталось '.$x[0].' предметов.';
echo '<script>top.location.href = top.location.href;</script>';