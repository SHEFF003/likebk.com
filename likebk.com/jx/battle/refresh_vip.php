<?php
if(!isset($CRON_CORE)) {
	define('GAME',true);
	include('../../_incl_data/class/__db_connect.php');
}
				
function e($t) {
	mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("core #'.date('d.m.Y').' %'.date('H:i:s').' (����������� ������): <b>'.mysql_real_escape_string($t).'</b>","capitalcity","INFINITY","6","1","-1")');
}

if(isset($_GET['cron_core'])) {
	$id = array(
		'id' => $_GET['uid'],
		'pass' => $_GET['pass']
	);
	if(md5($id['id'].'_brfCOreW@!_'.$id['pass']) == $_GET['cron_core']) {
		$uzr = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`pass` FROM `users` WHERE `id` = "'.mysql_real_escape_string($id['id']).'" AND `pass` = "'.mysql_real_escape_string($id['pass']).'" LIMIT 1'));
		if(isset($uzr['id'])) {
			$CRON_CORE = true;
			$_COOKIE['login'] = $uzr['login'];
			$_COOKIE['pass'] = $uzr['pass'];
			$_POST['id'] = 'reflesh';
		}
		unset($uzr);
	}
}

if(!isset($CRON_CORE)) {
	header( 'Expires: Mon, 26 Jul 1970 05:00:00 GMT' );
	header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
	header( 'Cache-Control: no-store, no-cache, must-revalidate' );
	header( 'Cache-Control: post-check=0, pre-check=0', false );
	header( 'Pragma: no-cache' );
	header( 'Content-Type: text/html; charset=windows-1251' );
	/*$lock_file = 'lock/battle_'.$_SERVER['HTTP_X_REAL_IP'].'.'.$_COOKIE['auth'].'.bk2'; 
	if ( !file_exists($lock_file) ) { 
		//$fp_lock = fopen($lock_file, 'w');
		//flock($fp_lock, LOCK_EX); 
	} else { 
		//unlink($lock_file);
		//die('<b><center><font color=red>�� ������� ��������� ������, ��������� ������� �����...</font></center></b>');
	}*/
}

if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' || isset($CRON_CORE))
{
	if(isset($_POST['atack'],$_POST['block']) || (isset($_POST['id']) && $_POST['id']=='reflesh') || isset($_POST['usepriem']) || isset($_POST['useitem']))
	{
		if(isset($_POST['useitemon'])) {
			$_POST['useitemon'] = iconv('UTF-8', 'windows-1251', $_POST['useitemon']);
		}
		session_start();
		$tm = microtime();
		$tm = explode(' ',$tm);
		$tm = $tm[0]+$tm[1];
		
		if(!isset($CRON_CORE)) {
			include('../../_incl_data/__config.php');
			if($_SESSION['tbr']>$tm)
			{
				die('<script>ggcode="'.$code.'";if(t057!=null){clearTimeout(t057);}</script>');
			}else{
				$_SESSION['tbr'] = $tm+0.350;
			}
		}
		
		unset($tm);		
		$js = '';
		include('../../_incl_data/class/__user.php');
		include('../../_incl_data/class/__magic.php');
		include('../../_incl_data/class/_cron_.php');	
		include('../../_incl_data/class/__quest.php');	
		
		if(!isset($CRON_CORE)) {
			if(!isset($u->info['id']) || ($u->info['joinIP']==1 && $u->info['ip']!=$_SERVER['HTTP_X_REAL_IP']))
			{
				die($c['exit']);
			}
		}
		
		function json_fix_cyr($json_str) { 
			/*	$cyr_chars = array ( 
				'\u0430' => '�', '\u0410' => '�', 
				'\u0431' => '�', '\u0411' => '�', 
				'\u0432' => '�', '\u0412' => '�', 
				'\u0433' => '�', '\u0413' => '�', 
				'\u0434' => '�', '\u0414' => '�', 
				'\u0435' => '�', '\u0415' => '�', 
				'\u0451' => '�', '\u0401' => '�', 
				'\u0436' => '�', '\u0416' => '�', 
				'\u0437' => '�', '\u0417' => '�', 
				'\u0438' => '�', '\u0418' => '�', 
				'\u0439' => '�', '\u0419' => '�', 
				'\u043a' => '�', '\u041a' => '�', 
				'\u043b' => '�', '\u041b' => '�', 
				'\u043c' => '�', '\u041c' => '�', 
				'\u043d' => '�', '\u041d' => '�', 
				'\u043e' => '�', '\u041e' => '�', 
				'\u043f' => '�', '\u041f' => '�', 
				'\u0440' => '�', '\u0420' => '�', 
				'\u0441' => '�', '\u0421' => '�', 
				'\u0442' => '�', '\u0422' => '�', 
				'\u0443' => '�', '\u0423' => '�', 
				'\u0444' => '�', '\u0424' => '�', 
				'\u0445' => '�', '\u0425' => '�', 
				'\u0446' => '�', '\u0426' => '�', 
				'\u0447' => '�', '\u0427' => '�', 
				'\u0448' => '�', '\u0428' => '�', 
				'\u0449' => '�', '\u0429' => '�', 
				'\u044a' => '�', '\u042a' => '�', 
				'\u044b' => '�', '\u042b' => '�', 
				'\u044c' => '�', '\u042c' => '�', 
				'\u044d' => '�', '\u042d' => '�', 
				'\u044e' => '�', '\u042e' => '�', 
				'\u044f' => '�', '\u042f' => '�', 
				
				'\r' => '', 
				'\n' => '<br />', 
				'\t' => '' 
			);
			foreach ($cyr_chars as $cyr_char_key => $cyr_char) { 
				$json_str = str_replace($cyr_char_key, $cyr_char, $json_str); 
			} */
			return $json_str; 
		}
		
		$u->stats = $u->getStats($u->info['id'],0);
		
		if(!isset($CRON_CORE)) {
			if($u->info['online']<time()-30)
			{
				mysql_query("UPDATE `users` SET `online`='".time()."',`timeMain`='".time()."' WHERE `id`='".$u->info['id']."' LIMIT 1");
			}
		}
		include('../../_incl_data/class/__battle.php');
		include('log_text.php');
		$btl->is = $u->is;
		$btl->items = $u->items;
		$btl->info = $btl->battleInfo($u->info['battle']);
		if(!isset($btl->info['id']))
		{
			if($u->info['battle']==-1)
			{
				//��������� ��������
				$upd = mysql_query('UPDATE `users` SET `battle` = "0",`online` = "'.time().'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				if(!$upd)
				{
					if(!isset($CRON_CORE)) {
						die('������ ���������� ��������.');
					}
				}else{
					echo '<script>location="main.php";</script>';
				}
			}else{
				mysql_query('UPDATE `users` SET `battle` = "0" WHERE `battle` = "'.$u->info['battle'].'" LIMIT 100');
				if(!isset($CRON_CORE)) {
					die('<script>location="main.php";</script>');
				}
			}
		}else{
			//�������� ������ � �������� � ���
				$btl->teamsTake();
				
			if(isset($_POST['useitem'])) {
				$magic->useItems((int)$_POST['useitem']);
				if($u->error!='') {
					echo '<font color=red><center><b>'.$u->error.'</b></center></font>';
				}
			}
				
			//������� �����,������,������� � �.�.
				//����
					if(isset($_POST['atack']) && isset($_POST['block']))
					{
						$btl->addAtack();
					}
				//�����
					if(isset($_POST['usepriem']))
					{
						$priem->pruse($_POST['usepriem']);
					}
				//���������� �������� / �������
					
					
			//�������� �������� (�����, ������������� �������, ���� ���� ����������� ������� ���� ��� ������������ �����)			
				//if(!isset($_POST['usepriem'])) {
					$btl->testActions();
				//}
			//����-����� ����������, ���� ������ ����� ����������
				if($u->stats['hpNow']>=1)
				{
					//������ �����
					if(isset($_POST['smn']) && $_POST['smn']!='none')
					{
						/* ---------------- */
						$_POST['smn'] = iconv('UTF-8', 'windows-1251', $_POST['smn']);
						$uidz = mysql_fetch_array(mysql_query('SELECT `id`,`inUser` FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['smn']).'" AND `battle` = "'.$u->info['battle'].'" LIMIT 1'));
						if($uidz['inUser']>0)
						{
							$uidz['id'] = $uidz['inUser'];
						}
						$rsm = $btl->smena($uidz['id'],false);
						if($rsm!=1)
						{
							echo '<font color=red><center><b>'.$rsm.'</b></center></font>';
						}
						unset($rsm);
						$js .= 'smena_login = \'none\';';
					}
					//����-�����
					if($u->info['enemy']==0 || $btl->stats[$btl->uids[$u->info['enemy']]]['hpNow']<=0 || isset($btl->ga[$u->info['id']][$u->info['enemy']]))
					{
						$btl->autoSmena();
					}
				}else{
					$btl->mainStatus = 3;
				}
			//�������� ������ � ��������
				
			//�������� ������ � ���� ���
				
			//���� ��� ������ - ���������
			if(!isset($_POST['usepriem'])) {
				if($btl->info['team_win']==-1)
				{
					$btl->testFinish();
				}else{
					$btl->testFinish();
				}
			}
			if($btl->info['team_win']==-1)
			{
				$js .= $btl->genTeams($u->info['id']);
			}else{
				$btl->mainStatus = 3;
				$btl->e = $u->btl_txt;
			}
			
			if(!isset($CRON_CORE)) {
				$js .= $btl->myInfo($u->info['id'],1);
				//������� ������	
				if($btl->e!='')
				{
					echo '<font color="red"><center><b>'.$btl->e.'</b></center></font>';
				}
				if(isset($btl->ga[$u->info['id']][$u->info['enemy']]))
				{
					if($u->info['hpNow']>=1) {
						$btl->mainStatus = 2;		
					}
				}else{
					if($u->info['enemy']!=0 && $btl->info['team_win']==-1 && $u->info['hpNow']>=1)
					{
						$js .= $btl->myInfo($u->info['enemy'],2);
					}
				}
				if($btl->info['izlom']>0)
				{
					$js .= 'volna('.(1+$btl->info['izlomRoundSee']).');';
				}
					$i = 1;
					while($i<=7)
					{
						if($btl->users[$btl->uids[$u->info['id']]]['tactic'.$i]<0)
						{
							$btl->users[$btl->uids[$u->info['id']]]['tactic'.$i] = 0;
						}
						if($btl->users[$btl->uids[$u->info['id']]]['tactic'.$i]>25 && $i<7)
						{
							$btl->users[$btl->uids[$u->info['id']]]['tactic'.$i] = 25;
						}
						$i++;
					}
				$atk1 = 0;
				if(!isset($CRON_CORE)) {$rsys = $u->sys_see(0);}
				if($rsys != '') {
					$js .= $rsys;
				}
				unset($rsys);
				if(isset($btl->ga[$u->info['enemy']][$u->info['id']]))
				{
					$atk1 = 1;
				}
			}
			$rehtml = '';
			if(!isset($CRON_CORE)) {
				$js .= '$("#priems").html("'.$priem->seeMy(2).'");';
				//if(!isset($_POST['usepriem'])) {
					$js .= $btl->lookLog();
				//}
			$rehtml .= '<script type="text/javascript">eatk='.$atk1.';
			if(document.getElementById("nabito")!=undefined)
			{
				document.getElementById("nabito").innerHTML = "'.(floor($btl->users[$btl->uids[$u->info['id']]]['battle_yron'])).'";
			}
			if(document.getElementById("expmaybe")!=undefined)
			{
				document.getElementById("expmaybe").innerHTML = "'.(floor($btl->users[$btl->uids[$u->info['id']]]['battle_exp'])).'";
			}
			if(document.getElementById("timer_out")!=undefined)
			{
				document.getElementById("timer_out").innerHTML = "'.round(($btl->info['timeout']/60),2).'";
			}
			$(\'#pers_magic\').html("'.$u->btlMagicList().'");
			g_iCount = 30;
			noconnect = 15;
			connect = 1;
			if(document.getElementById("go_btn")!=undefined)
			{
				document.getElementById("go_btn").disabled = "";
			}
			if(document.getElementById("reflesh_btn")!=undefined)
			{
				document.getElementById("reflesh_btn").disabled = "";
			}
			za = '.(0+$btl->stats[$btl->uids[$u->info['id']]]['zona']).'; genZoneAtack();
			zb = '.(0+$btl->testZonbVis()).'; genZoneBlock();
			refleshPoints();
			tactic(1,'.(0+$btl->users[$btl->uids[$u->info['id']]]['tactic1']).');
			tactic(2,'.(0+$btl->users[$btl->uids[$u->info['id']]]['tactic2']).');
			tactic(3,'.(0+$btl->users[$btl->uids[$u->info['id']]]['tactic3']).');
			tactic(4,'.(0+$btl->users[$btl->uids[$u->info['id']]]['tactic4']).');
			tactic(5,'.(0+$btl->users[$btl->uids[$u->info['id']]]['tactic5']).');
			tactic(6,'.(0+floor($btl->users[$btl->uids[$u->info['id']]]['tactic6'])).');
			smnpty='.(0+$u->info['smena']).';
			mainstatus('.$btl->mainStatus.');
			tactic(7,"'.(0+$btl->users[$btl->uids[$u->info['id']]]['tactic7']).'");
			smena_alls = "0";
			ggcode="'.$code.'";
			'.$js.'
			</script>';
			
			echo ($rehtml);
			
			if( $btl->cached == true ) {
				$btl->clear_cache_start();
			}
			
			unset($atk1);
		}
		echo '<script>ggcode="'.$code.'";if(t057!=null){clearTimeout(t057);}</script>';
		}
	}
}
//unlink($lock_file);
?>