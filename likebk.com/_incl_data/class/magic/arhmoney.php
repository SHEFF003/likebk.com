<?
if(!defined('GAME'))
{
	die();
}

//��� ��� �� ��2

if($itm['magic_inci'] == "arhmoney") {
	if( $u->info['inTurnir'] == 0 ) {
		$u->error = '���������� ����������� � ������� ����� ������';
	}else{
		$bs = mysql_fetch_array(mysql_query('SELECT * FROM `bs_turnirs` WHERE `id` = '.$u->info['inTurnir'].' LIMIT 1'));
		if(isset($bs['id'])) {
			//$users = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `login` != "����������" AND `inTurnir` = '.$bs['id'].' LIMIT 1'));
			//if($users[0] > 1) {
				//$u->error = '�� ������ �������� ������������ ���������� ����� ������';
			//}else{
				//$arh = mysql_fetch_array(mysql_query('SELECT `u`.`login`,`u`.`id`,`u`.`battle`,`s`.`x`,`s`.`y` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON (`u`.`id` = `s`.`id`) WHERE `u`.`login` = "����������" AND `u`.`room` = 363 AND `s`.`x` = '.$u->info['x'].' AND `s`.`y` = '.$u->info['y'].' LIMIT 1'));
				//if(isset($arh['id'])) {
					//if($arh['battle'] == 0) {
						$real_user = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`level`,`align`,`clan`,`sex` FROM `users` WHERE `inUser` = '.$u->info['id'].' LIMIT 1'));
						if($itm['price2'] > 0) {
							$u->info['money2'] += $itm['price2'];
							$i = 2; $j = 2; $type = '���';
						}else{
							$u->info['money'] += $itm['price1'];
							$j = 1; $type = '��.';
						}
						mysql_query('UPDATE `users` SET `money'.$i.'` = `money'.$i.'` + '.$itm['price'.$j.''].' WHERE `id` = '.$real_user['id'].' LIMIT 1');
						$u->error = '�� ������� ���������� ��� �� '.$itm['price'.$j.''].' '.$type.'';
						
						//��������� � ���
						if( $itm['price2'] == 0 ) {
								if( $u->info['sex'] == 0 ) {
									$text = '{u1} ��������� ��� �� <b>'.$itm['price1'].' ��.</b>';
								}else{
									$text = '{u1} ���������� ��� �� <b>'.$itm['price1'].' ��.</b>';
								}
							}else{
								if( $u->info['sex'] == 0 ) {
									$text = '{u1} ��������� ��� �� <b>'.$itm['price2'].' ���.</b>';
								}else{
									$text = '{u1} ���������� ��� �� <b>'.$itm['price2'].' ���.</b>';
								}
							}
							if( isset($real_user['id']) ) {
								$mereal = '';
								if( $real_user['align'] > 0 ) {
									$mereal .= '<img src=http://img.likebk.com/i/align/align'.$real_user['align'].'.gif width=12 height=15 >';
								}
								if( $real_user['clan'] > 0 ) {
									$mereal .= '<img src=http://img.likebk.com/i/clan/'.$real_user['clan'].'.gif width=24 height=15 >';
								}
								$mereal .= '<b>'.$real_user['login'].'</b> ['.$real_user['level'].']<a target=_blank href=http://likebk.com/info/'.$real_user['id'].' ><img width=12 hiehgt=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>';
							}else{
								$mereal = '<i>���������</i>[??]';
							}
							$text = str_replace('{u1}',$mereal,$text);
							//��������� � ��� ��
							mysql_query('INSERT INTO `bs_logs` (`type`,`text`,`time`,`id_bs`,`count_bs`,`city`,`m`,`u`) VALUES ("1", "'.mysql_real_escape_string($text).'", "'.time().'", "'.$bs['bsid'].'", "'.$bs['bsid'].'", "'.$bs['city'].'","'.$bs['money'].'","1")');
							//��������� � ���
							$chat = '<b>'.$u->info['login'].'</b>, ��������� <img width=30 height=30 src=http://img.likebk.com/i/items/dectransfer.gif> ��� �� <b>1000</b> ��������!';
							mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("<font color=red>��������! </font>'.mysql_real_escape_string($chat).'","capitalcity","","6","1","'.time().'")');
						if(rand(0,100) <= 20) {
							$go = $this->atackUser($arh['id'],$u->info['id'],$u->info['team'],$u->info['battle']);
								if($go > 0) {
								 $txt = '<img src=http://img.likebk.com/i/items/pal_button8.gif><b>&quot;����������&quot;,</b> �������� ����� ��������� �� ��������� <b>&quot;'.$u->info['login'].'&quot;';
								 mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`,`room`) VALUES ("<font color=red>��������! </font>'.mysql_real_escape_string($txt).'","capitalcity","","6","1","'.time().'",'.$u->info['room'].')');
								 header('location:main.php');
								 die();
							}
						}
						mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 , `delete` = "'.time().'" WHERE `id` = '.$itm['id'].' LIMIT 1');
					//}else{
					//	$u->error = '���������� � ��������!';
					//}
				/*}else{
					$u->error = '�� ������ ��������� � ����� ������� � ������������';
				}*/
			//}
		}else{
			$u->error = '������ �� ������!';
		}
	}
}


/*if( $itm['magic_inci'] == 'arhmoney' ) {  //��� ��� �� ��3
	if( $u->info['inTurnir'] == 0 ) {
		$u->error = '���������� ����������� � ������� ����� ������';
	}else{
		$noarh = true;
		$bsd = mysql_fetch_array(mysql_query('SELECT `id`,`users`,`arhiv`,`count`,`city`,`money` FROM `bs_turnirs` WHERE `id` = "'.$u->info['inTurnir'].'" LIMIT 1'));
		if( isset($bsd['id']) ) {
			$bsd_arh = mysql_fetch_array(mysql_query('SELECT `u`.`id`,`u`.`battle`,`s`.`x`,`s`.`y` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id` WHERE `u`.`inTurnir` = "'.$u->info['inTurnir'].'" AND `u`.`login` = "����������" AND `u`.`pass` = "bstowerbot" LIMIT 1'));
			if( $bsd['users'] > 1 && $noarh == false && true == false ) {
				$u->error = '�� ������ �������� ������������ ���������� ����� ������';
			}else{
				if( $u->info['inUser'] == 0 ) {
					$usr_tk = mysql_fetch_array(mysql_query('SELECT `level`,`id`,`money`,`login`,`align`,`clan`,`sex` FROM `users` WHERE `inUser` = "'.$u->info['id'].'" LIMIT 1'));
					if( isset($usr_tk['id']) ) {
						if( $itm['price2'] > 0 ) {
							$bnki = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$usr_tk['id'].'" AND `block` = "0" ORDER BY `id` DESC LIMIT 1'));
						}
						if( $itm['price2'] == 0 ) {
							mysql_query('UPDATE `users` SET `money` = `money` + "'.$itm['price1'].'" WHERE `inUser` = "'.$u->info['id'].'" LIMIT 1');
						}else{
							mysql_query('UPDATE `bank` SET `money2` = `money2` + "'.$itm['price2'].'" WHERE `id` = "'.$bnki['id'].'" LIMIT 1');	
						}
						mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
						if( $itm['price2'] == 0 ) {
							$u->error = '�� ������� ��������� ��� �� '.$itm['price1'].' ��.';
						}else{
							if( isset($bnki['id']) ) {
								$u->error = '�� ������� ��������� ��� �� '.$itm['price2'].' ���. (����: �'.$bnki['id'].' )';	
							}else{
								$u->error = '��� �� '.$itm['price2'].' ���. ��� ���������, �� � ��� ��� ����������� ����������� �����! ������ �������!';	
							}
						}
						//��������� � ��� ��
						if( $itm['price2'] == 0 ) {
							if( $u->info['sex'] == 0 ) {
								$text = '{u1} ��������� ��� �� <b>'.$itm['price1'].' ��.</b>';
							}else{
								$text = '{u1} ���������� ��� �� <b>'.$itm['price1'].' ��.</b>';
							}
						}else{
							if( $u->info['sex'] == 0 ) {
								$text = '{u1} ��������� ��� �� <b>'.$itm['price2'].' ���.</b>';
							}else{
								$text = '{u1} ���������� ��� �� <b>'.$itm['price2'].' ���.</b>';
							}
						}
						if( isset($usr_tk['id']) ) {
							$mereal = '';
							if( $usr_tk['align'] > 0 ) {
								$mereal .= '<img src=http://img.likebk.com/i/align/align'.$usr_tk['align'].'.gif width=12 height=15 >';
							}
							if( $usr_tk['clan'] > 0 ) {
								$mereal .= '<img src=http://img.likebk.com/i/clan/'.$usr_tk['clan'].'.gif width=24 height=15 >';
							}
							$mereal .= '<b>'.$usr_tk['login'].'</b> ['.$usr_tk['level'].']<a target=_blank href=http://likebk.com/info/'.$usr_tk['id'].' ><img width=12 hiehgt=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>';
						}else{
							$mereal = '<i>���������</i>[??]';
						}
						$text = str_replace('{u1}',$mereal,$text);
						//��������� � ��� ��
						mysql_query('INSERT INTO `bs_logs` (`type`,`text`,`time`,`id_bs`,`count_bs`,`city`,`m`,`u`) VALUES (
							"1", "'.mysql_real_escape_string($text).'", "'.time().'", "'.$bsd['id'].'", "'.$bsd['count'].'", "'.$bsd['city'].'",
							"'.round($bsd['money']*0.85,2).'","'.$i.'"
						)');
						//
					}else{
						$u->error = '���-�� ����� �� ���...';
					}
				}else{
					$u->error = '�� ������ ����������� � ������� ����� ������';	
				}
			}
		}else{
			$u->error = '���������� ����������� � ������� ����� ������';
		}
	}
}*/
?>