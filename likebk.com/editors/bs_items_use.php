<?
	define('GAME',true);
	include('../РЕДАКТОРЫ/_incl_data/__config.php');	
	include('../РЕДАКТОРЫ/_incl_data/class/__db_connect.php');	
	include('../РЕДАКТОРЫ/_incl_data/class/__user.php');
	if( $u->info['admin'] == 0 ) {
		header('location: http://likebk.com/');
		die($u->info['admin']);
	}
?>
<style>
.pd1 {
	padding:5px;
}
.grn {
	background-color:green;
}
</style>
<?
	$bid = 1;
	$itm_u = '';
	$i = 0;
	$sp = mysql_query('SELECT `id`,`name`,`img` FROM `items_main` WHERE `geni` = 1 OR (`name` NOT LIKE "%кристаллизатор%" AND `type` = 29)');
	while( $pl = mysql_fetch_array($sp) ) {
		$usit = mysql_fetch_array(mysql_query('SELECT `id` FROM `bs_items_use` WHERE `item_id` = "'.$pl['id'].'" AND `bid` = "'.mysql_real_escape_string($bid).'" LIMIT 1'));
		if( isset($_GET['use']) && $pl['id'] == (int)$_GET['use'] ) {
			if( isset($usit['id']) ) {
				mysql_query('DELETE FROM `bs_items_use` WHERE `id` = "'.$usit['id'].'" LIMIT 1');
				unset($usit);
			}else{
				mysql_query('INSERT INTO `bs_items_use` (`item_id`,`bid`) VALUES ("'.$pl['id'].'","'.mysql_real_escape_string($bid).'")');
				$usit['id'] = 1;
			}
		}
		$i++;
		if( isset($usit['id']) ) {
			$cls1 = ' grn';	
		}else{
			$cls1 = '';		
		}
		$itm_u .= '<a href="?use='.$pl['id'].'"><img class="pd1'.$cls1.'" src="http://img.likebk.com/i/items/'.$pl['img'].'" title="#'.$pl['id']."\r".$pl['name'].'" /></a>';
	}
	echo 'Предметов: <b>'.$i.'</b><hr>'.$itm_u;
?>