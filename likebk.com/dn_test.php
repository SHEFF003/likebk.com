<?
define('GAME',true);

include_once('_incl_data/__config.php');
include_once('_incl_data/class/__db_connect.php');

$sp = mysql_query('SELECT * FROM `dungeon_bots` WHERE `for_dn` = 13 ORDER BY `x` ASC, `y` ASC');
while( $pl = mysql_fetch_array($sp) ) {
	
	$bot = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `id` = "'.$pl['id_bot'].'" LIMIT 1'));
	
	$e1 = explode('|',$bot['p_items']);
	$i = 0;
	while( $i < count($e1) ) {
		$e2 = explode('=',$e1[$i]);
		if( isset($e2[0]) ) {
			$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$e2[0].'" LIMIT 1'));
			echo '[BOT_ID: '.$bot['login'].'] -> [ ('.$itm['id'].') &nbsp;'.$itm['name'].'&nbsp; - '.$e2[1].' ]<br>';
		}
		$i++;
	}
	
	echo '<hr>';
	
}

?>