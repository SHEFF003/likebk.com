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
			if( ($uu['align'] == 1.59 || $uu['align'] == 1.6) && $u->info['align'] != 1.6 ) {
				$uer = '�� �� ������ ��������� ������������!';
			}elseif( $uu['align'] != 1.59 && $uu['align'] != 1.6 && $u->info['align'] == 1.6 ) {
				$uer = '�� ������ ��������� ������ ������������!';
			}elseif($uu['align']<=1 || $uu['align']>=2)
			{
				$uer = '�������� �� �������� ����������� ��';
			}else{
				$upd = mysql_query('UPDATE `users` SET `align` = "0" WHERE `id` = "'.$uu['id'].'" LIMIT 1');
				if($upd)
				{
					$sx = '';
					if($u->info['sex']==1)
					{
						$sx = '�';
					}
					mysql_query('UPDATE `users_twink` SET `align` = 0 WHERE `uid` = "'.$uu['id'].'"');
					mysql_query('UPDATE `users_delo` SET `hb` = "0" WHERE `uid` = "'.$uu['id'].'" AND `hb`!="0"');
					$rtxt = '[img[items/unpal.gif]] '.$rang.' &quot;'.$u->info['cast_login'].'&quot; �����'.$sx.' &quot;'.$uu['login'].'&quot; ������ &quot;�������&quot;';
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$rtxt."','".time()."','6','0','1')");				
					$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; �����'.$sx.' ������ &quot;�������&quot;.';
					mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$uu['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".$rtxt."','".$u->info['login']."',0)");
					$uer = '�� ������� ����� ���� �������� � ��������� "'.$uu['login'].'".<br>';
				}else{
					$uer = '�� ������� ������������ ������ ��������';
				}
			}
		}else{
			if( ($uu['align'] == 3.059 || $uu['align'] == 3.06) && $u->info['align'] != 3.06 ) {
				$uer = '�� �� ������ ��������� ������������!';
			}elseif( $uu['align'] != 3.059 && $uu['align'] != 3.06 && $u->info['align'] == 3.06 ) {
				$uer = '�� ������ ��������� ������ ������������!';
			}elseif($uu['align']<=3 || $uu['align']>=3.99)
			{
				$uer = '�������� �� �������� ����������� ������';
			}else{
				$upd = mysql_query('UPDATE `users` SET `align` = "0" WHERE `id` = "'.$uu['id'].'" LIMIT 1');
				if($upd)
				{
					$sx = '';
					if($u->info['sex']==1)
					{
						$sx = '�';
					}
					mysql_query('UPDATE `users_delo` SET `hb` = "0" WHERE `uid` = "'.$uu['id'].'" AND `hb`!="0"');
					$rtxt = '[img[items/palbuttondarkhc1.gif]] '.$rang.' &quot;'.$u->info['cast_login'].'&quot; �����'.$sx.' &quot;'.$uu['login'].'&quot; ������ &quot;�������&quot;';
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$rtxt."','".time()."','6','0','1')");				
					$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; �����'.$sx.' ������ &quot;�������&quot;.';
					mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$uu['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".$rtxt."','".$u->info['login']."',0)");
					$uer = '�� ������� ����� ���� ������� � ��������� "'.$uu['login'].'".<br>';
				}else{
					$uer = '�� ������� ������������ ������ ��������';
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