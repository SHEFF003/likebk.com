<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'chains' && $itm['iznosNOW'] < $itm['iznosMAX']) {
	$usr = mysql_fetch_array(mysql_query('SELECT `st`.`x`,`st`.`y`,`st`.`timeGo`,`st`.`clone`,`u`.`bot_id`,`u`.`type_pers`,`u`.`inTurnir`,`st`.`zv`,`st`.`bot`,`st`.`hpNow`,`u`.`login`,`st`.`dnow`,`u`.`id`,`u`.`align`,`u`.`admin`,`u`.`clan`,`u`.`level`,`u`.`room`,`u`.`online`,`u`.`battle`,`st`.`team` FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`city` = "'.$u->info['city'].'" AND (`u`.`login`="'.mysql_real_escape_string($_GET['login']).'" OR `u`.`login`="'.mysql_real_escape_string($jl).'") LIMIT 1'));
	if(isset($usr['id']) && $usr['online'] > time()-520 ) {
		//���� �� 1-10 ���
		if( $u->info['room'] != $usr['room'] ) {
			$u->error = '�������� ��������� � ������ �������';
		}else{
			if( $u->info['room'] >= 362 && $u->info['room'] <= 366 && ( $u->info['x'] != $usr['x'] || $u->info['y'] != $usr['y'] ) ) {
				$u->error = '�������� ��������� � ������ �������';
			}elseif( $usr['timeGo'] > time()+120 ) {
				$u->error = '�������� &quot;'.$usr['login'].'&quot; ��� ����������';
			}else{
				$rmin = rand(1,10);
				if( $usr['timeGo'] < time() ) {
					$usr['timeGo'] = time();
				}
				$usr['timeGo'] += $rmin*60;
				$putu = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `img2` = "chains.gif" AND `delete` = "0" AND `uid` = "'.$usr['id'].'" LIMIT 1'));
				if(!isset($putu['id'])) {
					mysql_query('INSERT INTO `eff_users` (`user_use`,`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`img2`) VALUES (
						"'.$u->info['login'].'","2","'.$usr['id'].'","����","puti='.$usr['timeGo'].'","1","'.$usr['timeGo'].'","chains.gif"
					) ');
				}else{
					mysql_query('UPDATE `eff_users` SET `timeUse` = "'.$usr['timeGo'].'" WHERE `id` = "'.$putu['id'].'" LIMIT 1');
				}
				mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
				mysql_query('UPDATE `stats` SET `timeGo` = "'.$usr['timeGo'].'",`timeGoL` = "'.$usr['timeGo'].'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
				if( $u->info['id'] != $usr['id'] ) {
					$rtxt = '[img[items/chains.gif]] �������� &quot;'.$u->info['login'].'&quot; ����������� &quot;'.$itm['name'].'&quot; �� &quot;'.$usr['login'].'&quot; � ���������� ��� �� '.$rmin.' ���.';
					mysql_query("INSERT INTO `chat` (`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`,`new`) VALUES ('".$u->info['city']."','".$u->info['room']."','','','".$rtxt."','".time()."','6','0','1','1')");	
				}
				$u->error = '�� ������� ������������ &quot;'.$itm['name'].'&quot; �� '.$usr['login'].', �� '.$rmin.' ���.';
			}
		}
	}else{
		$u->error = '�������� �� ������ � ���� ������';
	}
}
?>