<?
if(!defined('GAME'))
{
	die();
}
if($p['priemIskl']==1)
{
	$uu = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['logingo']).'" LIMIT 1'));
	if(isset($uu['id']))
	{
		if( $a == 1 ) {
			if(($uu['align']!=0 && ($uu['align']<=1 || $uu['align']>=2)) || $uu['clan']>0)
			{
				$uer = '�������� ��������� � ����� ��� � ���� ��� ���� ����������';
			}else{
				$nalign = 1.1;
				if($_POST['zvanie']==1.4)
				{
					$nalign = 1.4;
				}elseif($_POST['zvanie']==1.5)
				{
					$nalign = 1.5;
				}elseif($_POST['zvanie']==1.6)
				{
					$nalign = 1.6;
				}elseif($_POST['zvanie']==1.7)
				{
					$nalign = 1.7;
				}elseif($_POST['zvanie']==1.75)
				{
					$nalign = 1.75;
				}elseif($_POST['zvanie']==1.9)
				{
					$nalign = 1.9;
				}elseif($_POST['zvanie']==1.91)
				{
					$nalign = 1.91;
				}elseif($_POST['zvanie']==1.92)
				{
					$nalign = 1.92;
				}
				if( $u->info['align'] == 1.6 ) {
					$nalign = 1.59;
				}
				$upd = mysql_query('UPDATE `users` SET `align` = "'.$nalign.'",`mod_zvanie` = "" WHERE `id` = "'.$uu['id'].'" LIMIT 1');
				if($upd && $nalign!=$uu['align'])
				{
					$sx = '';
					if($u->info['sex']==1)
					{
						$sx = '�';
					}
					mysql_query('UPDATE `users_delo` SET `hb` = "0" WHERE `uid` = "'.$uu['id'].'" AND `hb`!="0"');
					$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; ������'.$sx.' ��������� � ����� ����� (align'.$nalign.').';
					mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$uu['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".$rtxt."','".$u->info['login']."',0)");
					if($uu['align']>$nalign)
					{
						$uer = '�� ������� �������� ������ ��������� "'.$uu['login'].'".<br>';
					}elseif($uu['align']<$nalign && $uu['align']>0)
					{
						$uer = '�� ������� �������� ������ ��������� "'.$uu['login'].'".<br>';
					}else{
						$uer = '�� ������� ������� ��������� "'.$uu['login'].'" � ����� �����.<br>';
					}
				}else{
					$uer = '�� ������� ������� ��������� � ��';
				}
			}
		}else{
			if(($uu['align']!=0 && ($uu['align']<=3 || $uu['align']>=3)) || $uu['clan']>0)
			{
				$uer = '�������� ��������� � ����� ��� � ���� ��� ���� ����������';
			}else{
				$nalign = 0;
				if( $u->info['align'] == 3.06 ) {
					$nalign = 3.059;
				}
				$upd = mysql_query('UPDATE `users` SET `align` = "'.$nalign.'",`mod_zvanie` = "" WHERE `id` = "'.$uu['id'].'" LIMIT 1');
				if($upd && $nalign!=$uu['align'])
				{
					$sx = '';
					if($u->info['sex']==1)
					{
						$sx = '�';
					}
					mysql_query('UPDATE `users_delo` SET `hb` = "0" WHERE `uid` = "'.$uu['id'].'" AND `hb`!="0"');
					$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; ������'.$sx.' ��������� � ������ (align'.$nalign.').';
					mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$uu['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".$rtxt."','".$u->info['login']."',0)");
					if($uu['align']>$nalign)
					{
						$uer = '�� ������� �������� ������ ��������� "'.$uu['login'].'".<br>';
					}elseif($uu['align']<$nalign && $uu['align']>0)
					{
						$uer = '�� ������� �������� ������ ��������� "'.$uu['login'].'".<br>';
					}else{
						$uer = '�� ������� ������� ��������� "'.$uu['login'].'" � ������.<br>';
					}
				}else{
					$uer = '�� ������� ������� ��������� � ������';
				}
			}

		}
	}else{
		$uer = '�������� �� ������ � ���� ������';
	}
}else{
	$uer = '� ��� ��� ���� �� ������������� ������� ��������';
}	
?>