<?php
$scTrue = true;
mysql_query('DELETE FROM `newchat` WHERE `time` < "'.(time()-120).'"');
if(isset($_GET['refonline'])) {
	define('GAME',true);
	include('_incl_data/__config.php');	
	include('_incl_data/class/__db_connect.php');
	include('_incl_data/class/__filter_class.php');
	include('_incl_data/class/__user.php');
	if(isset($u->info['id'])) {
		mysql_query('DELETE FROM `newchat` WHERE `uid` = "'.$u->info['id'].'"');
		mysql_query('INSERT INTO `newchat` (
			`uid`,`time`
		) VALUES (
			"'.$u->info['id'].'","'.time().'"
		)');
		$lst = mysql_fetch_array(mysql_query('SELECT `id` FROM `online_list` WHERE `time` > "'.(time()-60).'" LIMIT 1'));
		if(!isset($lst['id'])) {
			$x = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `online` > "'.(time()-520).'" AND `real` = 1 AND `pass` NOT LIKE "%saint%" AND `pass` NOT LIKE "%online%" LIMIT 1'));
			$x = $x[0];
			mysql_query('INSERT INTO `online_list` (`time`,`online`,`date`) VALUES ("'.time().'","'.$x.'","'.date('d.m.Y H:i').'")');
		}
		if($u->info['online'] < time() - 60)	{
			mysql_query('UPDATE `users` SET `online` = '.time().' WHERE `id` = "'.$u->info['id'].'" LIMIT 1');	
			$filter->setOnline($u->info['online'],$u->info['id'],0);
			$u->onlineBonus();			
		}
		$r['js'] = '';
		//
		$posts = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `items_users` AS `iu` WHERE `iu`.`uid` = "-51'.$u->info['id'].'" AND `iu`.`delete` = 0 AND `iu`.`inOdet` = 0 AND `iu`.`inShop` = 0 AND `iu`.`lastUPD` < '.time().' LIMIT 1'));
		$posts = $posts[0];		
		if($posts > 0) {
			$r['js'] .= ' $("#postdiv").show();';
		}else{
			$r['js'] .= ' $("#postdiv").hide();';
		}
		//
		$r = json_encode($r);
		echo $r;
	}
}else{
	include('online.php');
}
?>