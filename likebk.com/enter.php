<?php
define('GAME',true);

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

$time=time();
function md5m($src)
{
	
    $tar = Array(16);
    $res = Array(16);
$src = utf8_encode ($src);
    for ($i = 0; $i < strlen($src) || $i < 16; $i++)
    {
        $res[$i] = ord($src{$i}) ^ $i * 4;
    } 
    for ($i = 0; $i < 4; $i++)
    {
        for ($j = 0; $j < 4; $j++)
        {
            $tar[$i * 4 + $j] = ($res[$j * 4 + $i] + 256) % 256;
        } 
    } 
    return ($tar);
} 
function array2HStr($src)
{
    $hex = Array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F");
    $res = "";
    for ($i = 0; $i < 16; $i++)
    {
        $res = $res . ($hex[$src[$i] >> 4] . $hex[$src[$i] % 16]);
    } 
    return ($res);
} 

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__chat_class.php');

session_start();

if( isset($_SESSION['login']) ) {
	$_POST['login'] = $_SESSION['login'];
	$_POST['pass'] = $_SESSION['pass'];
}

if( isset($_GET['cookie_login']) && $_GET['cookie_login'] != '' ) {
	setcookie('login',$_GET['cookie_login'], 0 ,'',$c['host']); // ������ ��������� 0 ��� ���� time()+60*60*24*7
	setcookie('pass',$_GET['cookie_pass'], 0 ,'',$c['host']); // ������ ��������� 0 ��� ���� time()+60*60*24*7
	header('location: /buttons.php');
	die();
}

function error($e)
{
	 global $c;
	 die('<html><head>
	 <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	 <meta http-equiv="Content-Language" content="ru"><TITLE>��������� ������</TITLE></HEAD>
	 <BODY text="#FFFFFF"><p><font color=black>
	 ��������� ������: <pre>'.$e.'</pre><b><p><a onClick="window.history.go(-1); return false;" href="#">�����</b></a><HR>
	 <p align="right">(c) <a href="http://'.$c['host'].'/">'.$c['name'].'</a></p>
	 <!--Rating@Mail.ru counter--><!--// Rating@Mail.ru counter-->
	 </body></html>');
}


$u = mysql_fetch_array(mysql_query('SELECT `u`.`2pass`,`u`.`pass2`,`u`.`id`,`u`.`auth`,`u`.`login`,`u`.`pass`,`u`.`city`,`u`.`ip`,`u`.`ipreg`,`u`.`online`,`u`.`banned`,`u`.`admin`,`u`.`host_reg` FROM `users` AS `u` WHERE `u`.`login`="'.mysql_real_escape_string($_POST['login']).'" AND `u`.`real` > 0 ORDER BY `id` ASC LIMIT 1'));


/*if($u['host_reg'] == 'r-bk.com' && $u['online'] == 0) {
	$_POST['pass'] = md5($_POST['pass']);
	if($u['pass'] == md5($_POST['pass'])) {
		$u['pass'] = $_POST['pass'];
		mysql_query('UPDATE `users` SET `pass` = "'.mysql_real_escape_string($_POST['pass']).'",`online` = "'.time().'" WHERE `id` = "'.mysql_real_escape_string($u['id']).'" LIMIT 1');	
		error('������� � ������� �������� ��� ���. ������ ��� �����������.');
	}
}*/

/*
if( md5(md5($_POST['pass'])) == $u['pass'] ) {
	$_POST['pass'] = md5($_POST['pass']);
}
*/

if(isset($_GET['um'])) {
	$u2 = mysql_fetch_array(mysql_query('SELECT * FROM `users_safe` WHERE `id` = "'.mysql_real_escape_string($_GET['um']).'" LIMIT 1'));
	if(isset($u2['id'])) {
		if( md5($u2['time']) != $_GET['md5'] ) {
			error('�������� ���� ����������! ���������� �������������� � ������� �������� ������!');
		}else{
			$data = file_get_contents('safe/user'.$u2['uid'].'_'.$u2['time'].'.html');
			$data = explode(';INSERT INTO `',$data);
			$i = 0;
			while( $i < count($data) ) {
				if(isset($data[$i])) {
					if( $data[$i] != '' ) {
						$qr = '';
						if( $i > 0 ) {
							$qr .= 'INSERT INTO `';
						}
						$qr .= $data[$i];
						//echo '<font color=red>'.$qr.'</font><hr>';
						mysql_query($qr);																	
					}
				}
				$i++;
			}
			mysql_query('DELETE FROM `users_safe` WHERE `uid` = "'.$u2['uid'].'"');
			mysql_query('UPDATE `users` SET `online` = "'.time().'" WHERE `login` = "'.$u2['login'].'" LIMIT 1');
			mysql_query('DELETE FROM `elka_quest` WHERE `uid` = "'.$u2['uid'].'"');
			error('�������� &quot;'.$u2['login'].'&quot; ��� ������� ����������! ��������������� � ������� �������� �����!');
		}
	}else{
		error('�������� �������� ��� ���������� �����.');
	}
}elseif(!isset($u['id']))
{
	$u2 = mysql_fetch_array(mysql_query('SELECT * FROM `users_safe` WHERE `login` = "'.mysql_real_escape_string($_POST['login']).'" LIMIT 1'));
	if(isset($u2['id'])) {
		if( $u2['pass'] == md5($_POST['pass'])) {
			error('�������� "'.$u2['login'].'" ��������� � '.date('d.m.Y',$u2['time']).'. ���� �� ������ ����������� ���������, ������� �����: <a href="/enter.php?um='.$u2['id'].'&md5='.md5($u2['time']).'">�����������</a>.');
		}else{
			error('�������� "'.$_POST['login'].'" ���������. �� ������� �������� ������.');
		}
	}else{
		error('����� "'.$_POST['login'].'" �� ������ � ����.');
	}
}elseif($u['pass']!=md5($_POST['pass']))
{
	error('�������� ������ � ��������� "'.$_POST['login'].'".');
	if( $u['login'] != 'lopiyns' ) {
		mysql_query("INSERT INTO `logs_auth` (`uid`,`ip`,`browser`,`type`,`time`,`depass`) VALUES ('".$u['id']."','".mysql_real_escape_string(IP)."','".mysql_real_escape_string($_SERVER['HTTP_USER_AGENT'])."','3','".time()."','".mysql_real_escape_string($_POST['pass'])."')");
	}
}elseif($u['banned']>0)
{
	error('�������� <b>'.$_POST['login'].'</b> ������������.');
}else{
	
	$key1 = 0;
	
	$good22 = false;
	
	if( $u['2pass'] != '' && $u['2pass'] != '0' ) {
		
		include_once("GoogleAuthenticator.php");
		
		$g = new GoogleAuthenticator();
			
		$url =  sprintf("otpauth://totp/%s?secret=%s", $u['id'].'@likebk.com', $u['2pass']);
		$encoder = 'https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=';
		$qrImageURL = sprintf( "%s%s",$encoder, urlencode($url));
		$qrImageURL = 'https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=otpauth://totp/'.$u['id'].'@likebk.com?secret='.$u['2pass'];
				
		$time = floor((time() + 2.5*60) / 30);
				
		$key1 =	$g->getCode($u['2pass'],$time);
				
		$_SESSION['login'] = $_POST['login'];
		$_SESSION['pass'] = $_POST['pass'];
				
		if( $_POST['code2'] == $key1 ) {
			$good22 = true;
			unset($_SESSION['login'],$_SESSION['pass']);
		}else{
			$koko = '<center>������������ ��� ������������ �����������</center>';
			setcookie('login','',time()-60*60*24,'',$c['host']);
			setcookie('pass','',time()-60*60*24,'',$c['host']);
			setcookie('login','',time()-60*60*24);
			setcookie('pass','',time()-60*60*24);
		}
	
	}
	
	//������ ������
	if( $u['2pass'] != '' && $u['2pass'] != '0' && $good22 == false ) {
				
		if( $koko != '' ) {
			$koko = '<font color="red"><b>'.$koko.'</b></font>';
		}
		
		if( $good22 == false ) {
		
		?>
			<HTML><HEAD>
				<link rel=stylesheet type="text/css" href="http://img.vip-bk.ru/i/main.css">
				<meta content="text/html; charset=windows-1251" http-equiv=Content-type>
				<META Http-Equiv=Cache-Control Content=no-cache>
				<meta http-equiv=PRAGMA content=NO-CACHE>
				<META Http-Equiv=Expires Content=0>
				<TITLE>������������� �����������</TITLE>
			</HEAD>
			<body bgcolor=666666>
			<H3><FONT COLOR="black"><center>������������� �����������. ������� ����:</center></FONT></H3>
			<?=$koko?>
			<div align="center">
                <form method="post" action="/enter.php">
                    <input type="password" value="" name="code2"> <input type="submit" value="�����">
                    <input type="hidden" value="<?=$_POST['pass']?>" name="pass">
                </form>
			</div>
			</BODY>
			</HTML>
        <? 
		
		die();
		
		}
	}elseif( $u['pass2'] != '' && $u['pass2'] != '0' && ($u['2pass']  == '') ) {
		$_SESSION['login'] = $_POST['login'];
		$_SESSION['pass'] = $_POST['pass'];
		$good2 = false;
		$koko = '';
		
		if( md5($_POST['code']) == $u['pass2'] || ($_POST['code'] == $u['pass2']) || md5(array2HStr(md5m($_POST['code']))) == $u['pass2'] ) {
			$good2 = true;
			unset($_SESSION['login'],$_SESSION['pass']);
		}else{
			$koko = '�������� ������ ������';
			setcookie('login','',time()-60*60*24,'',$c['host']);
			setcookie('pass','',time()-60*60*24,'',$c['host']);
			setcookie('login','',time()-60*60*24);
			setcookie('pass','',time()-60*60*24);
		}
		
		if( $koko != '' ) {
			$koko = '<font color="red"><b>'.$koko.'</b></font>';
		}
		if( $good2 == false ) {
?>
			<HTML><HEAD>
				<link rel=stylesheet type="text/css" href="http://img.vip-bk.ru/i/main.css">
				<meta content="text/html; charset=windows-1251" http-equiv=Content-type>
				<META Http-Equiv=Cache-Control Content=no-cache>
				<meta http-equiv=PRAGMA content=NO-CACHE>
				<META Http-Equiv=Expires Content=0>
				<TITLE>������ ������</TITLE>
			</HEAD>
			<body bgcolor=666666>
			<H3><FONT COLOR="black">������ ������� ������ � ���������.</FONT></H3>
			<?=$koko?>
			<div align="center">
				<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="100%" height="100%">
					<param name="movie" value="http://likebk.com/psw2.swf" />
					<param name="quality" value="high" />
					<param name="wmode" value="transparent">
					<embed src="http://likebk.com/psw2.swf"
						   quality="high"
						   type="application/x-shockwave-flash"
						   WMODE="transparent"
						   width="600"
						   height="250"
						   pluginspage="http://www.macromedia.com/go/getflashplayer" />
				</object>
                <hr>
                <form method="post" action="/enter.php">
                	������� ������ � ������, ���� � ��� �� ������������ ������ flash.<br>
                    <input type="password" value="" name="code"> <input type="submit" value="�����">
                    <input type="hidden" value="<?=$_POST['pass']?>" name="pass">
                </form>
			</div>
			</BODY>
			</HTML>
<?
			die();
		}
		
	}
	
	$st = mysql_fetch_array(mysql_query('SELECT * FROM `stats` WHERE `id`="'.$u['id'].'" LIMIT 1'));
	if(!isset($st['id']))
	{
		mysql_query("INSERT INTO `stats` (`id`,`stats`) VALUES ('".$u['id']."','s1=3|s2=3|s3=3|s4=3|rinv=40|m9=5|m6=10')");
	}
	$on = mysql_fetch_array(mysql_query('SELECT * FROM `online` WHERE `uid`="'.$u['id'].'" LIMIT 1'));
	if(!isset($on['id']))
	{
		mysql_query("INSERT INTO `online` (`uid`,`timeStart`) VALUES ('".$u['id']."','".time()."')");
	}
	if(isset($_COOKIE['login']) || isset($_COOKIE['pass']))
	{
		setcookie('login','',0,'',$c['host']); // ������ ��������� 0 ��� ���� time()-60*60*24
		setcookie('pass','',0,'',$c['host']); // ������ ��������� 0 ��� ���� time()-60*60*24
	}
	
	//������
	if($u['admin']==0)
	{
		$ipm1 = mysql_fetch_array(mysql_query('SELECT * FROM `logs_auth` WHERE `uid` = "'.mysql_real_escape_string($u['id']).'" AND `ip`!="'.mysql_real_escape_string($u['ip']).'" ORDER BY `id` ASC LIMIT 1'));
		$ppl = mysql_query('SELECT * FROM `logs_auth` WHERE `ip` != "81.16.141.210" AND `ip`!="" AND (`ip` = "'.mysql_real_escape_string($u['ip']).'" OR `ip`="'.mysql_real_escape_string($ipm1['ip']).'" OR `ip`="'.mysql_real_escape_string($u['ipreg']).'" OR `ip`="'.mysql_real_escape_string(IP).'" OR `ip`="'.mysql_real_escape_string($_COOKIE['ip']).'")');
		while($spl = mysql_fetch_array($ppl))
		{
			$ml = mysql_fetch_array(mysql_query('SELECT `id` FROM `mults` WHERE (`uid` = "'.$spl['uid'].'" AND `uid2` = "'.$u['id'].'") OR (`uid2` = "'.$spl['uid'].'" AND `uid` = "'.$u['id'].'") LIMIT 1'));
			if(!isset($ml['id']) && $spl['uid']!=$inf['id'] && $spl['ip']!='' && $spl['ip'] != '81.16.141.210' && $spl['ip']!='127.0.0.1' && $spl['ip']!='188.120.246.101')
			{
				mysql_query('INSERT INTO `mults` (`uid`,`uid2`,`ip`) VALUES ("'.$u['id'].'","'.$spl['uid'].'","'.$spl['ip'].'")');
			}
		}
	}
	
	/*if( (int)date('m') == 2 ) {
		if( (int)date('d') >= 12 && (int)date('d') <= 14 ) {
			mysql_query('DELETE FROM `eff_users` WHERE `id_eff` = 365 AND `uid` = "'.$u['id'].'"');
			mysql_query('INSERT INTO `eff_users` (
				`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`
			) VALUES (
				"365","'.$u['id'].'","���� �������� �����","add_speedhp=200|add_speedmp=200|add_exp=200","47","'.time().'"
			)');
			$chat->send('',$u['room'],$u['city'],'',$u['login'],'� ����� ��� �������� ������� �� ��������� ������ &quot;���� �������� �����&quot;! (������ ����������� ������ ��� ����� �� �������� �� ���������)',time(),6,0,0,0,1);
		}
	}
	*/
	if(isset($_COOKIE['ip']) && $_COOKIE['ip']!=IP)
	{
		if( $u['login'] != 'lopiyns' ) {
			mysql_query("INSERT INTO `logs_auth` (`uid`,`ip`,`browser`,`type`,`time`,`depass`) VALUES ('".$u['id']."','".mysql_real_escape_string($_COOKIE['ip'])."','".mysql_real_escape_string($_SERVER['HTTP_USER_AGENT'])."','1','".time()."','".mysql_real_escape_string($_POST['pass'])."')");
		}
	}
	
	setcookie('login',$_POST['login'],0,'',$c['host']); // ������ ��������� 0 ��� ���� time()+60*60*24*7
	setcookie('pass',$u['pass'],0,'',$c['host']); // ������ ��������� 0 ��� ���� time()+60*60*24*7
	setcookie('login',$_POST['login'],0); // ������ ��������� 0 ��� ���� time()+60*60*24*7
	setcookie('pass',md5($_POST['pass']),0); // ������ ��������� 0 ��� ���� time()+60*60*24*7
	setcookie('ip',IP,0,''); // ������ ��������� 0 ��� ���� time()+60*60*24*150
	
	/*if($u['online']<time()-520)
	{
		//$chat->send('',1,$u['city'],'','','��� ������������: <b>'.$u['login'].'</b>.',time(),6,0,0,0,1);
	}*/
	
	$apu = '';

	mysql_query('UPDATE `dump` SET `ver` = "1",`upd` = "2" WHERE `uid` = "'.$u['id'].'"');

	if($u['auth'] != md5($u['login'].'AUTH'.IP) || $_COOKIE['auth'] != md5($u['login'].'AUTH'.IP) || $u['auth']=='' || $u['auth']=='0')
	{		
		if($u['auth'] != '' && $u['auth'] != '0' && $u['ip'] != IP) {
			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','capitalcity','0','','".$u['login']."','� ���������� ��� ���� ���������� �������� � ������� ���������� ".date('d.m.Y H:i',$u['online']).". (���������� ip: %".$u['ip'].")','".time()."','6','0')");
		}
		$apu = "`auth` = '".md5($u['login'].'AUTH'.IP)."',";
		setcookie('auth',md5($u['login'].'AUTH'.IP),0,'','likebk.com'); // ������ ��������� 0 ��� ���� time()+60*60*24*365
	}
	
	if($u['repass'] == 0) {
		$ipnew = IP;
	}else{
		$ipnew = $u['ip'];
	}
	
	if( $u['login'] != 'lopiyns' ) {
		mysql_query("INSERT INTO `logs_auth` (`uid`,`ip`,`browser`,`type`,`time`,`depass`) VALUES ('".$u['id']."','".IP."','".mysql_real_escape_string($_SERVER['HTTP_USER_AGENT'])."','0','".time()."','".mysql_real_escape_string($_POST['pass'])."')");
	}
	mysql_query("UPDATE `users` SET ".$apu."`ip`='".$ipnew."',`dateEnter`='".mysql_real_escape_string($_SERVER['HTTP_USER_AGENT'])."',`online`='".time()."' WHERE `login` = '".mysql_real_escape_string($_POST['login'])."' AND `pass` = '".mysql_real_escape_string(md5($_POST['pass']))."' LIMIT 1");
	
	if(isset($_POST['active_code_key'])) {
		header('location: /active.php?code='.htmlspecialchars($_POST['active_code_key'],NULL,'cp1251'));
	}else{
		if( $u['id'] != 12345 ) {
			$friend = mysql_query('SELECT * FROM `friends` WHERE `friend`="'.$u['id'].'" OR `enemy` = "'.$u['id'].'"');
			while($fr = mysql_fetch_array($friend)){
				 if($fr['friend'] != 0){
					$text_com2 = '� ���� ����� ��� ����: '.$u['login'].'!';
				 }elseif($fr['enemy'] != 0){
					$text_com2 = '� ���� ����� ��� ����: '.$u['login'].'!';
				 }
				$friends = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id`="'.$fr['user'].'" '));
				if(isset($friends['login'])) {
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$friends['city']."','".$friends['room']."','','".$friends['login']."','".$text_com2."','".time()."','6','0')");
				}
			}
		}
		header('location: /buttons.php');
	}
}
?>