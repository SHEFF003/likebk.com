<?
if(!defined('GAME'))
{
	die();
}
if(true==true) {
$uri = $_SERVER['REQUEST_URI'];
if(substr_count($uri,'?') < 1) {
	$uri = $uri.'?';
}

$s = 0;
if($u->info['sex'] == 1) {
	$s = 1;
}


if($u->info['fnq'] < 38) {
		$qobr = 'wm1';
		/*			����� ����������		*/
		if(isset($_GET['cancelstep'])) {
			//��������� ��������
			$u->info['fnq'] = 39;
			mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}
		if($u->info['fnq'] == 0) {
				
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//��������, ��������� ������
				$u->info['fnq'] = 1;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
				unset($_GET['qstnextstep']);
			}elseif(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//���������, ����� fnq = 9999
				/*$u->info['fnq'] = 9999;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');*/
				
				unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 0) {
				$txt  = '<a>������������, '.$u->info['login'].'!</a><br><br>';
				$txt .= '� ���� ������ ���� � ������ ��������� � <b>����� ����</b>.<br>';
				$txt .= '� ����� <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> <b>���������</b> ��������� <b>�������</b>, ������� ����������� ���� ������ �� 50 ������, <b>�� ������ � ������</b>. ������� ����� � ���� 2 ������, ���� �� ��������� � ����, � ����� �� ��� ������� ������������ � ����� ����� ��������������.<br><br>';
				$txt .= '�� ���������� � ���� LikeBK.';
				$txt .= '� ������ � ������� ���� �� ������, ���������� � ��������, ������ � ������ ��� � ����� ������������ ���������� ������������� ������ ���������.<br><br>';
				
				$txt .= '<a>����� ���������� ���������� ���� �������, �� ������� ������ ������ � �������� <u>������� �������</u>!</a><br><br>';
				$txt .= '� ������ �������� - ����� ������!<br>���� �� ��� ������� ���� � ���� �� ����� �������, �� ������ ����������, � �� ���������� �����, �� �������, �� ����� ������� �������.<br><br>';
				
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">������!</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
			}
			
		}
		
		/*			�������� ������������� � �������� ����������		*/
		if($u->info['fnq'] == 1) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//��������, ��������� ������
				$u->info['fnq'] = 2;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
		unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 1) {
				$txt  = '<a>� ����, ��� �� ';
				
				if($s == 1) {
					$txt .= '�����������';
				}else{
					$txt .= '����������';
				}	
					
				$txt .= ' ������� ��� ������.</a><br><br>';
				$txt .= '���� �� �������� ��������, ����� ������� ���� ���� ���������, �� ������ ������ ������ ����� ������ �� <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>���������</b>", � ����� "<b>���������</b>", ��������� ����� ���� ������� �������.<br><br>';
				$txt .= '<a>������ � �������� � <u>����������� ��������� ���������</u>.</a><br><br>';
				$txt .= '<u><b>���������� 4 �������� ���������:</b></u><br><br>';
				$txt .= '<b>- ����</b> - ������ <u>���� �������</u> � ��������� ����� � ����� ������ �����, ���������� ������ �������<br>';
				$txt .= '<b>- ��������</b> - ��������� <u>����������</u> �� ����� ����������<br>';
				$txt .= '<b>- ��������</b> - ��������� �������� <u>����������� �����</u>, ������� ����� ������� �������� �����, � ��������� ������ ����������<br>';
				$txt .= '<b>- ������������</b> - ����������� <u>�����</u>, � ������, ����������� ������ ���������� � ���, �� �������. ������� ������� �� (Hit Points) ��� ����� ���������� ���������� ���������� ���������� � ���� �����.<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
			}
		}
		
		/*		������������ �������������� � ������		*/
		if($u->info['fnq'] == 2) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//��������, ��������� ������
				$u->info['fnq'] = 3;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
		unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 2) {
				$txt  = '����� ������, ����� �� <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>���������</b>", ����� �� "<b>������</b>", ���� <small>� <a>�����������</a></small> � ������� ����� �� ������� ������ <b>���������� (������)</b> � <img src="http://img.likebk.com/i/plus.gif" width="9" height="9"> ����� � ������. <small>(�� ������ ��������� ��������������!)</small><br><br>������ � ���� ���� <b>6 ��������� ������</b>, �� �������� ���������, �� ������ �������� �������������� �����.<br><br>';
				$txt .= '<u>�� ������� ������� ���� ��������� ���������:</u><br>';
				$txt .= '<b>- ���������</b> - ����� ��� ������������� �������� ���������� ������� � ��������, �������� � 4-�� ������<br>';
				$txt .= '<b>- ��������</b> - ����� ��� ���������� ������� ���������� ���� (Magic Points), �������� � 7-�� ������<br><br>';
				$txt .= '<a><u>���� ������ �������:</u></a> ����� � <b>"������"</b> � ����� �� <img src="http://img.likebk.com/i/plus.gif" width="9" height="9"> ����� ����������, <b>���������� ��� 3 ��������� �����</b> �� ������ �������. �� ����� ���������, � ����� ������ �� ������� �������� ���� �������������. ����� � ����� ����, ��� ��� ������.<br>';
				$txt .= '����� ���������� ������� � ����� ���� ������ �������.<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
			}
		}
		// ��������� ������� fnq 2
		if($u->info['fnq'] == 3) {
			if($u->info['ability'] == 0) {
				//������� ���������
				$u->info['fnq'] = 4;
				
				$re = $u->addItem(4691,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1|nodelete=1');
				if( $re > 0 ) {
					mysql_query('UPDATE `items_users` SET `gift` = "����������" WHERE `id` = "'.$re.'" LIMIT 1');
				}
				
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'",`money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
				unset($_GET['qstnextstep']);
			}
		}
		
		/*		��������� ���������� 		*/
		if($u->info['fnq'] == 4) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//��������, ��������� ������
				$u->info['fnq'] = 5;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
				unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 4) {
				$txt  = '<a>����������! �� ��������� � ������ �������� � � ������� ��������� <font color=green>������ ��������</font>!</a><br><br>';
				$txt .= '���� ���� ���� ���� � ��������. ��� ������ �����, ��� ������� ���� ��������. ����������� ����, �� ������������ �� ������� � ����, �� ������ �� �������, �� ��������� <u>������ (�������)</u> � <u>�������������� �����</u>. �������� ���� �� ������ ������ � ����.<br><br>';
				$txt .= '<b>������� �����</b> ��������� <a href="http://likebk.com/exp.php" target="_blank">���</a>.<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';	
			}
		}
		
		if($u->info['fnq'] == 5) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//��������, ��������� ������
				$u->info['fnq'] = 6;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
		unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 5) {
				$txt  = '����� � <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>���������</b>", � ������� "<b>��������������</b>" �� ������� <b>�������</b> � <b>�������</b> - ��� ���� ������ ������. ����� �� ���������, �� ������� ������ ������� � ������� � ������� �����.<br><br>';
				$txt .= '� ������� "<b>��������</b>" ����� <img src="http://img.likebk.com/i/items/100kexp.gif" width="40" height="25"> "<b>������ ��������</b>". � ������� ����� ������ �� ������� <u>����� ������ 1-�� ������</u>.<br><br>';
				$txt .= '<a><u>���� ������ �������:</u></a> ����� � <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>���������</b>" � ��������� ���� <b>������ ��������</b>.<br>��������, � ������� ���� ����!<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
			}
		}
		
		if($u->info['fnq'] == 6) {
			if($u->info['exp'] >= 120) {
				
				$u->info['fnq'] = 7;
				
				/*//����� �����
				$u->addItem(724,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1',NULL,50);
				//����� ������
				$u->addItem(1463,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1',NULL,1);
				//����� �������
				$u->addItem(1462,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1',NULL,1);
				//����� �������
				$u->addItem(1461,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1',NULL,1);
				//������ ������������
				$u->addItem(4038,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1',NULL,1);
				//������ ��������
				$u->addItem(4039,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1',NULL,1);
				//����� ������������
				$u->addItem(4037,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1',NULL,1);
				//����� ����
				$u->addItem(4040,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1',NULL,1);*/
				
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
			}
		}
		
		if($u->info['fnq'] == 7) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//��������, ��������� ������
				$u->info['fnq'] = 8;
				$u->info['money'] += 10;
				mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'",`fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');				
				unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 7) {
				$txt  = '<a>�� ������� ��������� � �������� � ��������� <font color=green>�������� ������  � ����� �����</font>!</a><br><br>';
				$txt .= '��� ����, ����� ����� ������ ����, ���� ���������� ����� � <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>���������</b>" � ������ �� ���. ������, ������ ��� ������ �������� �� ����� � �������� � ����� �� �������� ���������.<br>';
				$txt .= '<b>�����</b> ����� � ����� <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>���������</b>" �� ������� "<b>��������</b>". ��� ������� ���� <u>��������� ������������ �����</u> ����� ���, ������� �������� � ��������� �����.<br>';
				$txt .= '������ �� ����� ����� �� "<u>����������� �������</u>", ��� ��������� ������ "<b>��������</b>", � ���� ������� ���� ���...<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
			}
		
		}
		
		if($u->info['fnq'] == 8) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//��������, ��������� ������
				$u->info['fnq'] = 9;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
				unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 8) {
				if($u->room['name'] == '��������������� �������' || $u->room['name'] == '�������') {
					$txt  = '<a>�� ��������� � ��������������� ��������.</a><br><br>';
					$txt .= '�� ������ �� ������ ������, �������, ������ � ��������.<br>����� ���� ������ ���� ���������� ������� � ����� �����!<br><br>';
					$txt .= '������ ����� ������ ���� <u>������ ��������������</u>. �� ���� �����.<br>';
					$txt .= '��� ������ �������� ���������, ����� � ��� - ����������, ������ - ��������.<br><br>';
					$txt .= '<a><u>���� ������ �������:</u></a> <b>���� � ����� ���� ������ ������.</b> �������� ��� �� �������, ��� ������ ������ � ��� ���������� ����� ������� � ����.<br><br>';
					$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
				}else{
					
		unset($_GET['qstnextstep']);
				}
			}
		}
		
		if($u->info['fnq'] == 9) {
			/* ��������� ������� �������� � ���������  */
			$qitm = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inShop` = "0" AND `inTransfer` = "0" AND (`inOdet` = 3 OR `inOdet` = 11) AND (`gift` = "" OR `gift` = "0" OR `gift` = "1") AND `inOdet` < 20 LIMIT 1'));
			if($qitm[0] >= 1) {		
				$u->info['fnq'] = 10;
				$u->info['exp'] += 100;		
				$u->addItem(3101,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1');	
				mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			}
		}
		
		if($u->info['fnq'] == 10) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//��������, ��������� ������
				$u->info['fnq'] = 11;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
		unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 10) {
				$txt  = '<a>���������� � �������� ������� ������� ���������!</a><br><br>';
				$txt .= '�� ���������� ������� �� ������� ������ <b>����� ����� +6</b> � ��� <b>100 ������ �����</b>!<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
			}
		}
		
		if($u->info['fnq'] == 11) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//��������, ��������� ������
				$u->info['fnq'] = 12;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
		unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 11) {
				$txt  = '<a>������ � ����� ����, ��� ������� <u>���� ������� �������</u>.</a><br><br>';
				$txt .= '� "<b>�������</b>", ������ �� ������ �� ������ <b>���������� ��������</b> (����� ������ �������� �� "<b>������</b>" ��� "<b>������</b>").<br><br>';
				$txt .= '� ���� ���� <b>'.$u->info['skills'].' ��������� ���������</b> ��� �������������.<br>���� ������ <u>��������� ���� ��������������� �������</u>.<br><br>';
				$txt .= '���������� ���������� ���� ����� ����� � ������� ��� ������������� ��������� �������.<br><br>';
				$txt .= '<a><u>���� ��������� �������:</u></a> ����� � <b>������</b>, �, ����� �� <img src="http://img.likebk.com/i/plus.gif" width="9" height="9"> <b>������ '.$u->info['skills'].' ���������� �������� ��� �������, ������� �� �����</b>.<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>'; 	
			}
		}
		
		if($u->info['fnq'] == 12) {
			if($u->info['skills'] == 0) {
				$u->info['fnq'] = 13;		
				$u->info['money'] += 15;
				$u->info['exp'] += 150;
				mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'",`money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
		unset($_GET['qstnextstep']);
			}
		}
		
		if($u->info['fnq'] == 13) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//��������, ��������� ������
				$u->info['fnq'] = 14;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
		unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 13) {
				$txt  = '<a>����������! ������ ���� ������ ����� ���� �������, ��� ������! � ������� �� ��������� 150 ����� � 15 ��������.</a><br><br>';
				$txt .= '�� ��� ������ <b>'.$u->info['level'].'�� ������</b>!<br>';
				$txt .= '������, ����� � <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>���������</b>" � <u>���������� �������������� ��������� �����</u>, � ����� ����� ���� <b>������ ��������</b> , ����� ���� �� ���������� � ���� <b>������ ���</b>.';
				$txt .= '<br><br>�� ������� ������������ ������������ � <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>���������</b>" � ������������ ��������� ����� � ������, ������� ����������� ���� �� ������ ��� � ������.';
				$txt .= '<br><br>����� ���������, ������ �� <b>��������</b>, ����� �� ������ "<u>����������� �������</u>", ��� � ������ <b>����������� �����</b> � ��� ����� �� ������� "<b>��� ������</b>".<br><br>� ���� ������� ���� ���. ';
				$txt .= '<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
			}
		}
		
		if($u->info['fnq'] == 14) {
			
			if($u->room['FR'] == 1) {
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					//��������, ��������� ������
					$u->info['fnq'] = 15;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					
			unset($_GET['qstnextstep']);
				}
				
				if($u->info['fnq'] == 14) {
					$txt  = '<a>�� � ������� ������ ����������� �����, ��� � ����� ������� �� ������ ��������� ���.</a><br><br>';
					$txt .= '������� �� ������, ����� �� ������ <b>��������</b>, �� ������� �������.<br><br>';
					$txt .= '<a><u>���������� ���</u></a> (�������� � 1 ������ � �����, � 5 ������ � ��������) - ��� 1 �� 1 � �����������.<br>';
					$txt .= '<a><u>��������� ���</u></a> (�������� � 8 ������) - ������ �� ������, �������� 5 �� 5 �������.<br>';
					$txt .= '<a><u>����������� ���</u></a> (�������� � 8 ������) - ����� ���������� ����� ������ �, ��������� �������, ������� �� ��� ��������, ������� ��������� ������� �� ������.<br><br>';
					$txt .= '�� ������ ������ ���� ������ �� ���, ��� ������� ����� � <b>���������� ����</b>.<br><br>';
					$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
				}
			}
		}
		
		if($u->info['fnq'] == 15) {
		
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//��������, ��������� ������
				$u->info['fnq'] = 16;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
		unset($_GET['qstnextstep']);
			}
		
			if($u->info['fnq'] == 15) {
				$txt  = '����� ��� ��������, �� ������� ��� �������� ��� <b>������ � ������</b>. ������ ���� ���� � ���� �� ��� �����, � ����� ������ <b>������!</b><br>����� ���� ��������� ���� ������� �� ������� � ���� ��� ��������� ������ �������. <br><br>';
				$txt .= '���� ������ ��� �����, ��������, �� ����� ����������, �� ������� ������! � ������� �� ��������� ������� ������� ���������� � ������������, ���� �� ���������� �������.<br>�� ������� ������� <b>���������� ������</b> ������� ���� ��������� ������� ���, ��������� �������� � ���, �������, �������� ������ ����� � ������ ������.';
				$txt .= '<br><br><a><u>���� ����� �������:</u></a> ������� ���� ������ <b>���������� ��� � �����</b>. �� ������ ��������!<br><br>';
				$txt .= '����� ��������� ��� � ��������, ����� ���������� ����!<br><b>������, ������ ����!</b><br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
			}	
		}
		
		if($u->info['fnq'] == 16) {
			$lwn = mysql_fetch_array(mysql_query('SELECT * FROM `a_noob` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `vars` = "qst16" LIMIT 1'));
			if(!isset($lwn['id'])) {
				mysql_query('INSERT INTO `a_noob` (`uid`,`time`,`vars`,`vals`) VALUES ("'.$u->info['id'].'","'.time().'","qst16","'.$u->info['win'].'")');
				$lwn['id'] = mysql_insert_id();
				$lwn['vals'] = $u->info['win'];
			}
			
			if($u->info['win'] > $lwn['vals']) {
				//����� �������
				mysql_query('DELETE `a_noob` WHERE `id` = "'.$lwn['id'].'" LIMIT 1');
				
				$u->info['fnq'] = 17;		
				$u->info['money'] += 50;
				$u->info['exp'] += 500;
				mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `uid` = "'.$u->info['id'].'" AND `inOdet` > 0 AND `inOdet` < 20 LIMIT 20');
				mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'",`money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
				unset($_GET['qstnextstep']);
				
			}elseif(!isset($_GET['cancelzv']) && $u->info['battle'] == 0) {
				$zv = mysql_fetch_array(mysql_query('SELECT * FROM `zayvki` WHERE `id` = "'.$u->info['zv'].'" LIMIT 1'));
				if(isset($zv['id'])) {
					$prt = mysql_fetch_array(mysql_query('SELECT `id` FROM `stats` WHERE `zv` = "'.$u->info['zv'].'" AND `team` = "2" LIMIT 1'));
					if(isset($prt['id'])) {
						
					}elseif($zv['creator'] == $u->info['id'] && $zv['razdel'] == 2) {
						$bot = $u->addNewbot(1,NULL,$u->info['id'],NULL,true);
						if($bot > 0) {
							mysql_query('UPDATE `stats` SET `zv` = "'.$zv['id'].'",`team` = 2 WHERE `id` = "'.$bot.'" LIMIT 1');
						}
					}
				}
			}
		}
		
		if($u->info['fnq'] == 17) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//��������, ��������� ������
				$u->info['fnq'] = 21;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
				unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 17) {
				$txt  = '<a>����������, ������ �� ��������� ���� !</a><br><a>����� �� ���� ������� - 500 ������ ����� � 50 ��������!</a><br><br>';
				$txt .= '� ���� � ������� ���� �������� ������-�������.<br><br>';
				$txt .= '����� ��������, � ����� ���� ���������� <b>�����������</b> (������ �������� �� <b>����</b>).<br><br>';
				$txt .= '���� ����� �������� <u>���������� ���������:</u><br>';
				$txt .= '- <b>������</b> � ������ <b>������</b>, ������� ������� ��� ���� �������.<br>';
				$txt .= '- <b>��������</b> �������� ��������� ������� � �������� �������.<br>';
				$txt .= '- <b>�������� ���� ������� �� ����</b>.<br><br>';
				$txt .= '<br>��������� ������ ���� � ������ ����� ������ ������ �� ����, � ������, ��� ������ ����, ���� ��� ���������� �� ���.<br><br>';
				$txt .= '� ������ �� �������� �� <u>����������� �������</u>, ������� ������ �������� <b><u>��</u></b>. ��� �� ������� ������ <b>��������� ����������</b>. ����� ���� � �� ���������� �����.<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
			}
		}
		
		if($u->info['fnq'] == 21) {
			if($u->room['name'] == '��������� ����������') {
				$u->info['fnq'] = 22;		
				$u->info['exp'] += 200;
				mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
				unset($_GET['qstnextstep']);
			}
		}
		
		if($u->info['fnq'] == 22) {
			if($u->room['name'] == '��������� ����������') {
				
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					//��������, ��������� ������
					$u->info['fnq'] = 23;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					
					unset($_GET['qstnextstep']);
				}
				
				if($u->info['fnq'] == 22) {
					$txt  = '<a>� ���� ��������� ���� �� ��������, ������� 200 ������ �����!</a><br><br>';
					$txt .= '�� � <b>��������� ����������</b>. ���� �� ������� ��� �� ���.<br>����� ����� <u>��������</u> �������� ����, ������� <u>����������</u> �� ������ � <u>�������� ���������</u> ������ ������ � �����.';
					$txt .= '<br><br><a>������</a> - ����� �� ��������� ����� ������� ������� ���� ����, ������� �������� � ����.<br>';
					$txt .= '�� �����&nbsp;<img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30">&nbsp;�&nbsp;<strong>"���������"</strong>&nbsp;�� �������&nbsp;<strong>�������������</strong>.&nbsp;<br>';
					$txt .= '�������������&nbsp;<strong>0/30</strong>&nbsp;������, ��� ����&nbsp;<u>�����</u>&nbsp;� �� ����� 0 �� 30 ���������� ������������ ������.<br>';
					$txt .= '�������������&nbsp;<strong>12/30</strong>&nbsp;������, ��� ����&nbsp;<u>��������</u>&nbsp;�� 12 ������.&nbsp;<br>';
					$txt .= '�������������&nbsp;<strong>30/30</strong>&nbsp;������, ���&nbsp;<u>���� "�����" ���������</u>, ����� ���� �� �� ������� ����� � ������������� �� ����� ������.&nbsp;<br>';
					$txt .= '<br>�������� ������ ���� �������. ������������ ����� ���� ����������� �� ��������, � �����-������ ���� �������� ������ �����, �� ��� �������� �������.<br><br>';
					$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
				}
			}
		}
		
		if($u->info['fnq'] == 23) {	
			
			if($u->room['name'] == '��������� ����������') {
				
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					//��������, ��������� ������
					$u->info['fnq'] = 24;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					
					unset($_GET['qstnextstep']);
				}
				
				$txt  = '<a>����������</a> - ����� �� ������ <u>�������� ������� ����� �� ����� ������</u> � ��� ����� ����� ��� ��������� ����� �� ���� � ���������� � ���������.<br><br>';
				//$txt .= '<a>���������������</a> - ����� ���� ����� ��������������, <u>�� ���� �������� � ������� �� ���������</u>. ��� ����������� ����� ������� ���. ���� ����������� ����� ���� ����, ������� ��� ������ �������� �� ������ ����, ������� ������ �� ����. �����, ����� �� ������ ���� ������ �������, �� ��������� ���� ������ � ������� �����.<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a>';
			}
		}
		
		if($u->info['fnq'] == 24) {	
			
			if($u->room['name'] == '��������� ����������') {
				
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					//��������, ��������� ������
					$u->info['fnq'] = 25;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
					unset($_GET['qstnextstep']);
				}
				
				if($u->info['fnq'] == 24) {	
					$txt .= '<Br><br><a><u>���� ������ �������:</u></a> ����� ����� ���������� ���� �, ����� � ������ <a>������</a>, <b>������ � ���������</b>.<br><br>';
					$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
				}
			}
		}
		
		if($u->info['fnq'] == 25) {
			if($u->room['name'] == '��������� ����������') {
				//$ir = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `iznosNOW` = "0" AND `delete` = "0" AND `inShop` = "0" AND `inTransfer` = "0" AND `item_id` = "143" LIMIT 1'));
				if(isset($_GET['remon'])) {
					//����� �������
					$u->info['fnq'] = 26;		
					$u->info['exp'] += 100;
					mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				}
			}
		}
		
		if($u->info['fnq'] == 26) {
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//��������, ��������� ������
				$u->info['fnq'] = 27;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
				unset($_GET['qstnextstep']);
			}
			if($u->info['fnq'] == 26) {
				$txt  = '<a>�� ������� ��������� � �������� � ��������� 100 ������ �����!</a><br><br>';
				$txt .= '������ �� ������ �&nbsp;<strong>"������ �������"</strong>.<br>����� ��&nbsp;<strong>����������� �������</strong>&nbsp;� ������� ������ ��&nbsp;<strong>"�������� �������"</strong>.&nbsp;<br><br>��� �� �������&nbsp;<strong>"������ �������"</strong>, ��� � ���� ���� �����.';
				$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
			}
		}
		
		if($u->info['fnq'] == 27) {	
			if($u->room['name'] == '������ �������') {
				
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					//��������, ��������� ������
					$u->info['fnq'] = 28;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
					unset($_GET['qstnextstep']);
				}
				
				if($u->info['fnq'] == 27) {			
					$txt  = '<a>�� � ������ �������. </a><br><br>';
					$txt .= '����� �� ������ �������� ���� ����� � ������:<br>';
					$txt .= '<br>';
					$txt .= '- ��������&nbsp;<strong>������������ ��� ������</strong>, ����� ���������������� ��<br>';
					$txt .= '- ��������&nbsp;<strong>������������ ��� �����</strong>, ����� ���������������� ��<br>';
					$txt .= '- ���������������� ����� �� ������,&nbsp;<strong>�� ������ � ������</strong>.<br>';
					$txt .= '<br>';
					$txt .= '<u>������ ������� ������� ���������</u>. ';
					//$txt .= '����� � ���� �������� <strong>���� �������������� ���������� ����� ������ � ������</strong>, ����� ���� �� ��� �������� �������.<br>';
					//$txt .= '������,&nbsp;<u>������ ������</u>&nbsp;� ���� ����� ����������&nbsp;<u>���� ���������� �����������������</u>&nbsp;�� ����� � ����.&nbsp;<br>';
					$txt .= '���������� ������������ ������������ � ������� ��� ����.<br>';
					$txt .= '<br>';
					$txt .= '������ ����������� �������� ���� �����, � ����� ��� �&nbsp;<strong>������ ������������ �������</strong>&nbsp;��&nbsp;<strong>����������� �������</strong>.&nbsp;<br>';
					$txt .= '��� �� ����� ����������.';
					$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>'; 
				}
			}	
		}
		
		if($u->info['fnq'] == 28) {	
			if($u->room['name'] == '������������ �������') { # 9 =�� // ������������ ������� 272
				
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					//��������, ��������� ������
					$u->info['fnq'] = 29;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
					unset($_GET['qstnextstep']);
				}
				if($u->info['fnq'] == 28) {	
					$txt  = '<a>�� � ������������ ��������, ������� ����� �������� "�����".</a><br><br>';
					$txt .= '�� ����� �� ������� �������, �� ����� ������ ������� ���� ���� ������ �������. ����� ���� ����� �������, ��� � �������, �� ������ � ����� �������, �������� � ���������� ������������ ��� ���-����.<br><br>';
					$txt .= '����� ����� ����� ����� ���� ���� ����, �������� �������� ����. ���� ���� ����� �������, �� ������� ������ �� <u>������� 5% ��������</u>. ���� ����� ���� ����� ������, ��� ������ ������� �� � ��������.';
					$txt .= '<br><br>���������� ���� � ������� ������� ��� ������� �����, � ������, ����� �� <u>����������� �������</u>';
					$txt .= ' � ������ ������� �� ��������� ������� �� <u>����������� �����</u>, ������ ������� ������� � <u><b>��������� �������</b></u>. ��� �� ����� ����������.';
					$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
				}
			}
		}
		
		if($u->info['fnq'] == 29) {
			if($u->room['name'] == '��������� �������') {
				$u->info['fnq'] = 30;		
				$u->info['money'] += 10;
				$u->info['exp'] += 1250;
				mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'",`money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
				unset($_GET['qstnextstep']);
			}
		}
		
		if($u->info['fnq'] == 30) {
			if($u->room['name'] == '��������� �������') {
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					//��������, ��������� ������
					$u->info['fnq'] = 32;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
					unset($_GET['qstnextstep']);
				}
				
				if($u->info['fnq'] == 30) {	
					$txt  = '<a>�� � ��������� �������.</a><br><br>';
					$txt .= '� �������� ���� � �������, ����������� �� ���, �� ������, ������� ���� �� ������ �������� �� ������.<br><br>';
					$txt .= '�� ��������� <b>10 ��.</b> � <b>1250 �����</b> �� ���������� ���� ������!<br><br>';
					$txt .= '<a>- ����������</a> - ����� ����� <b>���������� �������</b> ������� ����� �������� ���� � ���������.<br>';
					$txt .= '<a>- ������� �������</a> - ���� �� ������ <b>���� �������</b> ���� ����� <b>����� ������</b>, ��� ��������� � ���� ������.<br>';
					$txt .= '<a>- ������ � �����������</a> - ����� �� ������ ����������� � ����������� � ������� ������������ ������.<br>';
					$txt .= '<a>- ������ �����</a> - ����� �� ������ ������ ���������� ��������� "������ �����" � "������ ������", ������� ����� ����������� ������������ � ����������� ����.<br>';
					$txt .= '<br>��������� �� <u>����������� �������</u>. ��� �� ���������� �����.<br>';
					$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
				}
			}
		}
		
		
		if($u->info['fnq'] == 31) {
			if($u->room['name'] == '�����') {		
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					//��������, ��������� ������
					$u->info['fnq'] = 32;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
					unset($_GET['qstnextstep']);
				}		
				if($u->info['fnq'] == 31) {
					$txt  = '<a>� ����� ����. �� ������ ��������.</a><br><br>';
					$txt .= '������ ����� �������� ����, ������ ��� ���������� ���������, ������� <u>�� ��������� ������ � ����</u>. ����� ����� ��������� ������� �� ���� ������. ���������� ���� � ������ ����� � <b>4��</b> ������.';
					$txt .= '� <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>���������</b>" �� ������ ������ ������� � ��� ����� �����.<br>';
					$txt .= '<a>������ (�����: 17.0/24)</a> ������, ��� <u>��� ����� ����� 17.0 ������</u>, � ����� �� <u>������ ������ � ������� 24 ������� ����</u>.<br>';
					$txt .= '���� ��� ����� ������ ������� ������� - �� �� ������� �������������, �������� ��� ����� � ����-�� ����.<br><br>';
					$txt .= '������ ������� ����� ��������� ������ "<b>����</b>", ��� ������ "<b>����� ��������</b>" � ��������. ������, ����� �� ������� �� ������ �������, � ����� �� ������ �������� ���� ����, � ���� � ������� �������.';
					$txt .= '<br>�� <b>4�</b> ������ � ���� �������� ������ <img src="http://img.likebk.com/i/buttons/chatBtn16.gif" width="30" height="30"> "<b>��������</b>", ��� �� ������� �������� ���� ��� ������ ����, <u>��� ��������� � ����� � ����� �������</u>, ��� ������� ���� ��� ������������� ��������.';
					$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
				}
			}
		}
		
		if($u->info['fnq'] == 32) {
			if($u->room['name'] == '����������� �������') {
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					$u->info['fnq'] = 33;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
					unset($_GET['qstnextstep']);
				}		
				if($u->info['fnq'] == 32) {
					$txt  = '<a>�� �� ����������� �������</a><br><br>';
					$txt .= '�� ������ ������ ��� ���-��� � ����� ����.<br><br>';
					$txt .= '����� ���������� <a>����������</a>, ������� ������ ������� �����:';
					$txt .= '<br>- <img src="http://img.likebk.com/i/align/align3.gif" width="12" height="15"> <b>������</b>';
					$txt .= '<br>- <img src="http://img.likebk.com/i/align/align1.gif" width="12" height="15"> <b>�������</b>';
					$txt .= '<br>- <img src="http://img.likebk.com/i/align/align7.gif" width="12" height="15"> <b>�����������</b>';
					$txt .= '<br>- <img src="http://img.likebk.com/i/align/align2.gif" width="12" height="15"> <b>����</b>';
					$txt .= '<br><br><img src="http://img.likebk.com/i/align/align3.gif" width="12" height="15">������ � <img src="http://img.likebk.com/i/align/align1.gif" width="12" height="15">������� - �������� ����� � ������ ����� ����� �����';
					$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
				}
			}
		}
		
		if($u->info['fnq'] == 33) {	
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				$u->info['fnq'] = 34;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
				unset($_GET['qstnextstep']);
			}	
			if($u->info['fnq'] == 33) {
				$txt  = '<img src="http://img.likebk.com/i/align/align3.gif" width="12" height="15"><a>������ ����������</a> ��������� � ������������� �������. ������, ��� �������, ����� ������ �� ����� ����� (��� ����������) � ����������� ����������, ������� � ��� ����� � �������� ����. ���������� �� ������� �����';
				$txt .= ' <b>������� �������</b>, ����� ��� � ��������.';
				$txt .= '<br><br>';
				$txt .= '<img src="http://img.likebk.com/i/align/align1.gif" width="12" height="15"><a>������� ����������</a> ��������� � �������. ������� ����� ����� ������� �������������� ����� ���� � ������ �� �������� �����.<br>';				
				$txt .= '<br><br><img src="http://img.likebk.com/i/align/align7.gif" width="12" height="15"><a>����������� ����������</a> ��������� � ������� ����� ����� � ������. �������� ����� ��������� ���� � �������� ���� (��� ������) � ������ �� �����. ���� �� ��������� ��� ������� ����� ����� ��� ������.';
				$txt .= '<br><br><img src="http://img.likebk.com/i/align/align2.gif" width="12" height="15"><a>����</a> - ��������� �� ���������.';
				$txt .= ' ������ <img src="http://img.likebk.com/i/align/align1.99.gif" width="12" height="15">�������� ����� �������� �������� ����� �� ������. <b>��������</b> ��������� � ������� ����������, �� ����� ���� ������ � �����, � ';
				$txt .= '<u>������ �� ����������� ������� ����� ����</u>. �������� �� ����� ���������� ���� � ������ � ����� ����������� ����� ���� � ����.';
				$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
			}
		}
		
		if($u->info['fnq'] == 34) {
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				$u->info['fnq'] = 37;		
				$u->info['money'] += 15;
				$u->info['exp'] += 148000;
				mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'",`money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
				echo '<script>location.href="buttons.php';
				unset($_GET['qstnextstep']);
			}
			if($u->info['fnq'] == 34) {
				$txt  = '�������� <img src="http://img.likebk.com/i/align/align1.gif" width="12" height="15"><a>�������</a>, <img src="http://img.likebk.com/i/align/align7.gif" width="12" height="15"><a>�����������</a> ��� <img src="http://img.likebk.com/i/align/align3.gif" width="12" height="15"><a>������</a> ���������� ����� ����� ������:<br><br>';
				$txt .= '- <u>�������� � ����</u> � ������������� �������� ���������� �����. �������� � ���� ����� ������� � <b>8�� ������</b>.<br>';
				$txt .= '- <u>������ ������ ����������</u> � �������� "�������".<br> ��������� ������ - <b>5 ���</b>. ������ ������ ����� �� <b>����� ������</b>.';
				$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
			}	
		}
		
		if($u->info['fnq'] == 35) {
			if($u->room['name'] == '��������� �������') {
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					$u->info['fnq'] = 36;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
					unset($_GET['qstnextstep']);
				}
				if($u->info['fnq'] == 35) {
					$txt  = '<a>�� � ��������.</a><br><br>';
					$txt .= '� <b>��������� ��������</b> �� ������ ������� ����� ������ ��� ������ ������� ����� � �������� �� ������ ���������.<br><br>';
					$txt .= '������ ���������� � <b>��������� ��������</b> �� ��������, ������� ����� ����� �� ����� <u>����������</u> ��� �� ������ �������� ������. ';
					$txt .= '�������� ������ ������� � ����������. ���������� �������, ����� ������� � �������� ������.<br><br>';
					$txt .= '<a>���� �������:</a>';
					$txt .= ' ����� � ������ "<b>�������</b>" ������ � ���� ������� ��� ��������, ����� ����� �� "<b>������� �������</b>".';
					$txt .= '<br>������ ������ �� ���� ������� - <img src="http://img.likebk.com/i/align/align3.gif" width="12" height="15"><b>��������</b> , <img src="http://img.likebk.com/i/align/align1.gif" width="12" height="15"><b>�����������</b> , <img src="http://img.likebk.com/i/align/align7.gif" width="12" height="15"><b>���������</b> , <img src="http://img.likebk.com/i/align/align2.gif" width="12" height="15"><b>���� �����������</b>  - � ������ ��� ���� ������ ������� � ���� ����.';
					$txt .= '<br><br>������ ������� �� ������ �����, �� �� �������, ��� �� ������ ��� <b>������</b>. ���� ���������� � ������ �����.';
					$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">����� &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">��������� ��������</a>';
				}
			}
		}
		
		/*if($u->info['fnq'] == 36) {
			$u->info['fnq'] = 37;		
			$u->info['money'] += 15;
			$u->info['exp'] += 148000;
			//mysql_query('UPDATE `bank` SET `money2` = `money2` + 5 WHERE `uid` = "'.$u->info['id'].'" AND `block` = "0" ORDER BY `id` ASC LIMIT 1');
			mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
			mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'",`money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');	
			//mysql_query("INSERT INTO `eff_users` (`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `sleeptime`, `no_Ace`) VALUES (276, ".$u->info['id'].", 'VIP (50)', 'add_silver=1', 30, ".(time()-30*86400+3*86400).", 0, 0, 1)");
			unset($_GET['qstnextstep']);
		}*/
		
		if($u->info['fnq'] == 37) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				$u->info['fnq'] = 38;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
				unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 37) {
				$txt  = '<a>����������! �� ��������� �� ����� ��������� � ��������� � ������� ��� 148000 ������ ����� � 15 ��������!</a><br><br>';
				$txt .= '�� ������ <b>'.$u->info['level'].'�� ������</b>, ������ ������� � �������� � ���� ����.<br>������� ������ ���� ����� � � ����� ���� ������� �� ���� ����. ';
				$txt .= '<br><br>����� ����� ������ � �������� ������, ������ ����������, ����� ��� ������ ����� ����. ';
				$txt .= '�������� ���� <b>'.$u->info['login'].'</b>, ���� ���� � ����������!';
				$txt .= '<br>����������� � <b>������� ������</b> ����� � ������� � �����!<br><br><a>���� ����������� �������� � ��� ������� ������ �� ����!</a><br>';
				$txt .= '<u>�� ��� �� ��� �������� � �������. �� �������!</u>';
				$txt .= '<br><br><center><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">�������</a></center>';
			}
		}

}
/* -------------- ����-��� ��� , ��� ������ :) --------------------------- */

if(isset($txt) && $txt != '') {
	echo '<script>top.qn_win(\''.$txt.'\',\''.$qobr.'\')</script>';
}else{
	echo '<script>top.qn_win_cls();</script>';
}

echo '<!-- QUEST END -->';
}
?>