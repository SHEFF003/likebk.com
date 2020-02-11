<?
if(!defined('GAME'))
{
	die();
}

$goodkast = 1;

if( $itm['iznosNOW'] >= $itm['iznosMAX'] ) {
	$goodkast = 0;
	$u->error = 'Книга была испорчена... Это просто хлам...';
}

if($goodkast == 1) {
	//
	$u->error = 'Книга &quot;'.$itm['name'].'&quot; успешно использована...';
	//
	mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `overType` = "9"');
	//
	if( $itm['item_id'] == 6740 ) {
		mysql_query("INSERT INTO `eff_users` (
			`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`
		) VALUES (
			377, '".$u->info['id']."', 'Зелёный Том Знаний', 'add_s1=10', 9, ".time().", 0, '".$u->info['login']."', 0, '0', 0, '', 1, -1, '0', 0, 0, '', 0, 0, 0, 0
		);");
	}elseif( $itm['item_id'] == 6741 ) {
		mysql_query("INSERT INTO `eff_users` (
			`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`
		) VALUES (
			378, '".$u->info['id']."', 'Желтый Том Знаний', 'add_s2=10', 9, ".time().", 0, '".$u->info['login']."', 0, '0', 0, '', 1, -1, '0', 0, 0, '', 0, 0, 0, 0
		);");
	}elseif( $itm['item_id'] == 6742 ) {
		mysql_query("INSERT INTO `eff_users` (
			`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`
		) VALUES (
			379, '".$u->info['id']."', 'Красный Том Знаний', 'add_s3=10', 9, ".time().", 0, '".$u->info['login']."', 0, '0', 0, '', 1, -1, '0', 0, 0, '', 0, 0, 0, 0
		);");
	}elseif( $itm['item_id'] == 6743 ) {
		mysql_query("INSERT INTO `eff_users` (
			`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`
		) VALUES (
			380, '".$u->info['id']."', 'Синий Том Знаний', 'add_s5=10', 9, ".time().", 0, '".$u->info['login']."', 0, '0', 0, '', 1, -1, '0', 0, 0, '', 0, 0, 0, 0
		);");
	}elseif( $itm['item_id'] == 6744 ) {
		mysql_query("INSERT INTO `eff_users` (
			`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`
		) VALUES (
			381, '".$u->info['id']."', 'Белый Том Знаний', 'add_s1=5|add_s2=5|add_s3=5|add_s5=5', 9, ".time().", 0, '".$u->info['login']."', 0, '0', 0, '', 1, -1, '0', 0, 0, '', 0, 0, 0, 0
		);");
	}
	//
	if( $itm['iznosNOW'] == 0 ) {
		$u->addItem( 6752 , $u->info['id'] , '|sudba='.$u->info['login'].'' );
		$u->error .= '<br>Вы получили какую-то страницу с заклятием.';
	}
	mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
	//
}

?>