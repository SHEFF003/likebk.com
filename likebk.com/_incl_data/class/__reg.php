<?
if(!defined('GAME'))
{
	die('/index.php');
}

function GetRealIp()
{
 if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
 {
   $ip=$_SERVER['HTTP_CLIENT_IP'];
 }
 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
 {
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
 }
 else
 {
   $ip=$_SERVER['REMOTE_ADDR'];
 }
 return $ip;
}
define('IP',GetRealIp());

/*
if(IP != '') {
	die('����������� �������� ���������. ���� �������������� ����������.');
}
*/

class register
{
	public function testLogin($v)
	{
		
	}
	
	public function en_ru($txt)
	{
		$g = false;
		$en = preg_match("/^(([a-zA-Z _-])+)$/i", $txt);
		$ru = preg_match("/^(([�-��-� _-])+)$/i", $txt);
		if(($ru && $en) || (!$ru && !$en))
		{
			$g = true;
		}
		return $g;
	}
	public function testStep()
	{
		global $c,$reg,$error,$filter,$chat,$reg_d,$noup,$youip;
		$stp = 1;
		if(isset($_POST['step']) && isset($reg['id']))
		{
			$upd = '';
			
			$lr = mysql_fetch_array(mysql_query('SELECT `id`,`ipreg` FROM `users` WHERE `cityreg`="capitalcity" AND `timereg`>"'.(time()-60*60*1).'" AND `ipreg` = "'.mysql_real_escape_string(IP).'" LIMIT 1'));
			if(isset($_COOKIE['reg_capitalcity']) || (int)$_COOKIE['reg_capitalcity']>time() || isset($lr['id']))
			{
				$error .= '������� � ������ IP ��� ��������������� ��������. � ������ IP ������ ��������� ����������� ���������� �� ����, ��� ��� � ���. ���������� �����.<br>'; $_POST['step'] = 1;
			}
			
			if($error=='')
			{
				
				$reg_bonus = false;
			}
			
			$reg_bonus = true;
			
			if($_POST['step']>1)
			{
				//����������� ������
				$nologin = array(0=>'�����',1=>'angel',2=>'�������������',3=>'administration',4=>'�����������',5=>'�����������',6=>'��������',7=>'���������',8=>'����������',9=>'����������',10=>'�����������',11=>'��������',12=>'���� �����������',13=>'����������',14=>'��������������',15=>'���������',16=>'����������');
				$blacklist = "!@#$%^&*()\+��|/'`\"";
				$sr = '_-���������������������������������1234567890';
				$i = 0;
				while($i<count($nologin))
				{
					if(preg_match("/".$nologin[$i]."/i",$filter->mystr($reg_d[0])))
					{
						$error .= '��������, ����������, ������ ���.<br>'; $_POST['step'] = 1; $i = count($nologin);
					}
					$i++;
				}
				$reg_d[0] = str_replace('  ',' ',$reg_d[0]);
				//����� �� 2 �� 20 ��������
				if(strlen($reg_d[0])>20) 
				{ 
					$error .= '����� ������ ��������� �� ����� 20 ��������.<br>'; $_POST['step'] = 1;
				}
				if(strlen($reg_d[0])<2) 
				{ 
					$error .= '����� ������ ��������� �� ����� 2 ��������.<br>'; $_POST['step'] = 1;
				}
				//���� �������
				$er = $this->en_ru($reg_d[0]);
				if($er==true)
				{
					$error .= '� ������ ��������� ������������ ������ ����� ������ �������� �������� ��� �����������. ������ ���������.<br>'; $_POST['step'] = 1;
				}
				//����������� �������
				if(strpos($sr,$reg_d[0]))
				{
					$error .= '����� �������� ����������� �������.<br>'; $_POST['step'] = 1;
				}				
				//��������� � ����
				$log = mysql_fetch_array(mysql_query('SELECT `id` from `users` where `login`="'.mysql_real_escape_string($reg_d[0]).'" LIMIT 1'));
				$log2 = mysql_fetch_array(mysql_query('SELECT `id` from `lastNames` where `login`="'.mysql_real_escape_string($reg_d[0]).'" LIMIT 1'));
				if(isset($log['id']) || isset($log2['id']))
				{
					$error .= '����� '.$reg_d[0].' ��� �����, �������� ������.<br>'; $_POST['step'] = 1;
				}
				//�����������
				if(substr_count($reg_d[0],' ')+substr_count($reg_d[0],'-')+substr_count($reg_d[0],'_')>2)
				{
					$error .= '�� ����� ���� ������������ ������������ (������, ����, ������ �������������).<br>'; $_POST['step'] = 1;
				}
				$reg_d[0] = trim($reg_d[0],' ');				
				
				
				if($_POST['step']!=1)
				{
					$stp = 2; $noup = 0;
				}
			}
			if($_POST['step']>2)
			{
				//��������� ������
				if(strlen($reg_d[1])<6 || strlen($reg_d[1])>30)
				{
					$error .= '����� ������ �� ����� ���� ������ 6 �������� ��� ����� 30 ��������.<br>'; $_POST['step'] = 2;
				}
				if($reg_d[1]!=$reg_d[2])
				{
					$error .= '� ������ ������ ����� ������ ������, ��� ��������. �� ������ ��� �� ��� ����� �������, ������ ������������.<br>'; $_POST['step'] = 2;
				}
				if(preg_match('/'.$reg_d[0].'/i',$reg_d[1]))
				{
					$error .= '������ �������� �������� ������.<br>'; $_POST['step'] = 2;
				}
				if($_POST['step']!=2)
				{
					$stp = 3; $noup = 0;
				}
			}
			if($_POST['step']>3)
			{
				//��������� e-mail
				if(strlen($reg_d[3])<6 || strlen($reg_d[3])>50)
				{
					$error .= 'E-mail �� ����� ���� ������ 6-� �������� � ������ 50-��.<br>'; $_POST['step'] = 3;
				}
				
				if(!preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $reg_d[3]))
				{
					$error .= '�� ������� ���� ��������� E-mail.<br>'; $_POST['step'] = 3;
				}
				
				$reg_d[4] = $chat->str_count($reg_d[4],30);
				$reg_d[5] = $chat->str_count($reg_d[5],30);
				
				if($_POST['step']!=3)
				{
					$stp = 4; $noup = 0;
				}
			}
			if($_POST['step']>4)
			{
				//���, ���, �����, ����� � �.�.
				$er = $this->en_ru($reg_d[6]);
				if($er==true || strlen($reg_d[6])<2)
				{
					$error .= '������� ���� �������� ���!<br>'; $_POST['step'] = 4;
				}
				
				$reg_d[6] = $chat->str_count($reg_d[6],90);
				$reg_d[7] = round($reg_d[7]);
				$reg_d[8] = round($reg_d[8]);
				$reg_d[9] = round($reg_d[9]);
				
				if($reg_d[7]<1 || $reg_d[7]>31 || $reg_d[8]<1 || $reg_d[8]>12 || $reg_d[9]<1920 || $reg_d[9]>2006)
				{
					$error .= '������ � ��������� ��� ��������.<br>'; $_POST['step'] = 4;
				}
				
				if($reg_d[15]!=0 && $reg_d[15]!=1)
				{
					$error .= '�� ������� �� ������ ���.<br>'; $_POST['step'] = 4;
				}
				
				if($reg_d[14]!='Black' && $reg_d[14]!='Blue' && $reg_d[14]!='Fuchsia' && $reg_d[14]!='Gray' && $reg_d[14]!='Green' && $reg_d[14]!='Maroon' && $reg_d[14]!='Navy' && $reg_d[14]!='Olive' && $reg_d[14]!='Purple' && $reg_d[14]!='Teal' && $reg_d[14]!='Orange' && $reg_d[14]!='Chocolate' && $reg_d[14]!='DarkKhaki' && $reg_d[14]!='SandyBrown')
				{
					$error .= '�� ������� �� ������ ���� ��������� � ����.<br>'; $_POST['step'] = 4;
				}				
				
				if($_POST['step']!=4)
				{
					$stp = 5; $noup = 0;
				}			
			}
			if($_POST['step']>5)
			{
				//���������� � �������� 
				if(!isset($_POST['law_'.$reg['id']]) || $_POST['law_'.$reg['id']]!='on')
				{
					$error .= '��������, ��� �������� ������ ������ �����, �� �� ������ ���������������� ���� ��������.<br>'; $_POST['step'] = 5;
				}
				
				if(!isset($_POST['law2_'.$reg['id']]) || $_POST['law2_'.$reg['id']]!='on')
				{
					$error .= '��������, ��� �������� <u>���������� � �������������� ������� ���� '.$c['title'].'</u>, �� �� ������ ���������������� ��������.<br>'; $_POST['step'] = 5;
				}
				
				if($_POST['code']!=$_SESSION['code'] || $_SESSION['code']<100 || $_POST['code']=='')
				{
					$error .= '������ �������� ����.<br>'; $_POST['step'] = 5;
				}
				
				if($_POST['step']!=5)
				{
					//���������� ����������� � �������� � ����
					
					if($filter->spamFiltr($reg_d[13])!=0)
					{
						$reg_d[13] = '';
					}
					if($filter->spamFiltr($reg_d[10])!=0)
					{
						$reg_d[10] = '';
					}
					if($filter->spamFiltr($reg_d[6])!=0)
					{
						$reg_d[6] = '';
					}
					
					$mbid = 'NULL';
					
					if(isset($_COOKIE['hstreger'])) {
						$reg['referal'] = $_COOKIE['hstreger'];
					}
					
					$ins = mysql_query("INSERT INTO `users` (`activ`,`fnq`,`host_reg`,`room`,`login`,`pass`,`ipreg`,`ip`,`city`,`cityreg`,`a1`,`q1`,`mail`,`name`,`bithday`,`sex`,`city_real`,`icq`,`icq_hide`,`deviz`,`chatColor`,`timereg`) VALUES (
					'0',
					'0',
					'".mysql_real_escape_string($reg['referal'])."',
					'0',
					'".$reg_d[0]."',
					'".md5($reg_d[1])."',
					'".IP."',
					'".IP."',
					'capitalcity',
					'capitalcity',
					'".$reg_d[4]."',
					'".$reg_d[5]."',
					'".$reg_d[3]."',
					'".$reg_d[6]."',
					'".$reg_d[7].".".$reg_d[8].".".$reg_d[9]."',
					'".$reg_d[15]."',
					'".$reg_d[10]."',
					'".$reg_d[11]."',
					'".$reg_d[12]."',
					'".$reg_d[13]."',
					'".$reg_d[14]."',
					'".time()."')");
					if($ins)
					{
						$uid = mysql_insert_id();
						
						$refer = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`banned`,`admin`,`level` FROM `users` WHERE `id` = "'.mysql_real_escape_string($reg['referal']).'" LIMIT 1'));
						if(isset($refer['id'])) {
						    $text = '<font color=red>�� ����� ������������� ������ &quot;'.$refer['login'].'&quot;! � ��������� (������ -������-) �� ������� ��������������� ��������.</font>';
							mysql_query("INSERT INTO `chat` (`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('capitalcity','0','','".$reg_d[0]."','".$text."','".time()."','11','0')");
						}
						
						mysql_query("INSERT INTO `online` (`uid`,`timeStart`) VALUES ('".$uid."','".time()."')");
						mysql_query("INSERT INTO `stats` (`id`,`stats`) VALUES ('".$uid."','s1=3|s2=3|s3=3|s4=3|rinv=40|m9=5|m6=10')");
						//��������� ��������
						mysql_query("INSERT INTO `items_users` (`gift`,`uid`,`item_id`,`data`,`iznosMAX`,`geniration`,`maidin`,`time_create`) VALUES ('�����������','".$uid."','1','add_hpAll=3',10,2,'capitalcity',".time().")");
						mysql_query("INSERT INTO `items_users` (`gift`,`uid`,`item_id`,`data`,`iznosMAX`,`geniration`,`maidin`,`time_create`) VALUES ('��������','".$uid."','73','add_mib3=1|add_mab3=1|add_mib4=1|add_mab4=1',20,2,'capitalcity',".time().")");
						mysql_query("INSERT INTO `items_users` (`uid`,`item_id`,`data`,`iznosMAX`,`geniration`,`maidin`,`time_create`) VALUES ('".$uid."','724','moment=1|sudba=".mysql_real_escape_string($reg_d[0])."|moment_hp=100|nohaos=1|musor=2|noremont=1',100,2,'capitalcity',".time().")");
						mysql_query("INSERT INTO `items_users` (`uid`,`item_id`,`data`,`iznosMAX`,`geniration`,`maidin`,`time_create`) VALUES ('".$uid."','865','tr_lvl=1|sudba=".mysql_real_escape_string($reg_d[0])."|useOnLogin=1|musor=1|noremont=1',50,2,'capitalcity',".time().")");
						mysql_query("INSERT INTO `items_users` (`uid`,`item_id`,`data`,`iznosMAX`,`geniration`,`maidin`,`time_create`) VALUES ('".$uid."','4014','sudba=".mysql_real_escape_string($reg_d[0])."|noremont=1|usefromfile=1|musor=1|nodelete=1|nosale=1|expUpg=300000',1,2,'capitalcity',".time().")");
						
						$text = '������������� �������: ������ ��������� �������, ������� ����� � ������������ ����������� � ����� � ���� ����! :-)';
						mysql_query("INSERT INTO `chat` (`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('capitalcity','0','','".$reg_d[0]."','".$text."','".time()."','11','0')");
						$text = '�� �������� ������� [img[items/pot_cureHP100_20.gif]][1] &quot;����� �����&quot;, �� ��������� � ���������, � ������� &quot;��������&quot;';
						mysql_query("INSERT INTO `chat` (`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('capitalcity','0','','".$reg_d[0]."','".$text."','".time()."','11','0')");
						$text = '�� �������� ������� [img[items/pal_button8.gif]][1] &quot;���������&quot;, �� ��������� � ���������, � ������� &quot;��������&quot;';
						mysql_query("INSERT INTO `chat` (`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('capitalcity','0','','".$reg_d[0]."','".$text."','".time()."','11','0')");
						$text = '�� �������� ������� [img[items/qsvit_hran.gif]][1] &quot;������ ��������&quot;, �� ��������� � ���������, � ������� &quot;��������&quot;. <b><font color=red>����������� ������ ������ �� �������� +300.000 ��. �����</font></b>';
						mysql_query("INSERT INTO `chat` (`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('capitalcity','0','','".$reg_d[0]."','".$text."','".time()."','11','0')");
						
						if(isset($_COOKIE['login']) || isset($_COOKIE['pass']))
						{
							setcookie('login','',time()-60*60*24,'',$c['host']);
							setcookie('pass','',time()-60*60*24,'',$c['host']);
						}
						setcookie('login',$reg_d[0],time()+60*60*24*7,'',$c['host']);
						setcookie('pass',md5($reg_d[1]),time()+60*60*24*7,'',$c['host']);
						setcookie('auth',md5($reg_d[1].'AUTH'.IP),time()+60*60*24*365,'',$c['host']);
						setcookie('reg_capitalcity',true,time()+60*60,'',$c['host']);
						$chat->send('',1,'capitalcity','','','��� ������������ �������: [login:'.$reg_d[0].']',time(),12,1,0,0);
						mysql_query("UPDATE `users` SET `online`='".time()."' WHERE `uid` = '".$uid."' LIMIT 1");
						mysql_query("UPDATE `register_code` SET `reg_id`='".$uid."',`time_finish`='".time()."' WHERE `id` = '".$cd['id']."' LIMIT 1");
						mysql_query("UPDATE `items_users` SET `delete`='".time()."' WHERE `secret_id` = '".$cd['code']."' LIMIT 1");
						mysql_query('DELETE FROM `register` WHERE `id` = "'.$reg['id'].'" LIMIT 1');
						header('location: http://likebk.com/buttons.php');						
						die('����������� ������ �������...');
					}else{
						$error .= '������ �����������. ���������� �����...<br>';
					}
				}			
			}
		}
		return $stp;
	}
}

$r = new register;
?>