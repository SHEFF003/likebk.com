<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Натиск
*/
$pvr = array();
if( isset($pr_momental_this)) {

}elseif( isset($pr_tested_this) ) {

}elseif( isset($pr_used_this) ) { 

}else{
	$defd = mysql_fetch_array(mysql_query('SELECT SUM(`vals`) FROM `battle_actions` WHERE `btl` = "'.$btl->info['id'].'" AND `vars` = "use_powteam'.$u->info['team'].'" LIMIT 1'));
	$defd = 0 + $defd[0];
	if( $defd < 200 ) {
		if( $defd > 0 ) {
			$defd = ' (x'.$defd.')';
		}else{
			$defd = '';
		}
		//Действие при клике
		$btl->priemAddLogFast( $u->info['id'], 0, "Натиск".$defd,
			'{tm1} '.$btl->addlt(1 , 17 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL).'',
		0, time() );
		//
		mysql_query('INSERT INTO `battle_actions` (`btl`,`uid`,`time`,`vars`,`vals`) VALUES (
			"'.$btl->info['id'].'","'.$u->info['id'].'","'.time().'","use_powteam'.$u->info['team'].'","1"
		)');
		//
		$this->mintr($pl);
	}else{
		$cup = true;
	}
}
unset($pvr);
?>