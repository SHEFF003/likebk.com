<?
die();
/*header('location: reg.php');
die();*/
//30.05.2060 07:25:06
exit();
define('GAME',true);
include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__chat_class.php');
include('_incl_data/class/__filter_class.php');

if(isset($_GET['showcode'])) {
	include('show_reg_img/security.php');
	die();
}
	session_start();
	include('_incl_data/class/__reg.php');
	include('_incl_data/class/__user.php');
if(!$_POST['ref']){
$ref = $_GET['ref'];}else{$ref = $_POST['ref'];}
if (!ereg("^[0-9]+$",$ref)){$ref=0;}
if(!empty($ref)){$s_ref = mysql_fetch_array(mysql_query("SELECT id FROM `users` WHERE `id`='$ref';"));
if(!$s_ref){$ref=0;}
}
if(!empty($_COOKIE['mailru']) or $_COOKIE['mailru'] == 'enter'){
	$msg = '������� � ������ IP ��� ��������������� ��������. � ������ IP ������ ��������� ����������� ���������� �� ����, ��� ��� � �����. ���������� �����. <BR>';

}
switch($_POST['step']){
	case '1': //STEP 1
		if(strlen($_POST['login']) < '3' or strlen($_POST['login']) > '15'){
			$msg = '����� �� ����� ���� ������ 3-� �������� � ������ 15-��<BR>� ������ ������ ����������� �����<BR>';
		}
		if(empty($msg) and preg_match( '/[^�-��-�a-zA-Z_ -]/', $_POST['login'])){
			$msg = '�� ������������ � ������ ����������� �������';	
		}
		if(empty($msg) and preg_match( '/[^a-zA-Z_ -]/', $_POST['login']) and preg_match( '/[^�-��-�_ -]/', $_POST['login'])){
			$msg = '� ������ ��������� ������������ ������ ����� ������ �������� �������� ��� �����������. ������ ���������.<BR>';	
		}
		if(empty($msg)){
			$res = mysql_fetch_array(mysql_query("SELECT `id` FROM `users` WHERE `login` = '".$_POST['login']."'"));
			if($res['id'] != NULL){
				$msg = '����� '.$_POST['login'].' ��� �����, �������� ������.<BR>';	
			}
			
		}
		if(empty($msg) and preg_match("#(\_|\-|\ ){2,}#", $_POST['login'])){
			$msg = '��������� ������������ ��� �������������� ������� ������.<BR>';
		}
		if(empty($msg) and preg_match("/(.)\\1\\1/", $_POST['login'])){
			$msg = '��������� ������������� ���� � ����� ���������� �������� ������.<BR>';
		}
		if(empty($msg)){
			$_POST['step'] = '2';
		}
		break;
		
	case '2': //STEP 2
		if(strlen($_POST['psw']) < '6' or strlen($_POST['psw']) > '30'){
			$msg = '����� ������ �� ����� ���� ������ 6 �������� ��� ����� 30 ��������.<BR>';	
		}
		if(empty($msg) and ($_POST['psw'] != $_POST['psw2'])){
			$msg = '� ������ ������ ����� ������ ������, ��� ��������. 
			�� ������ ��� �� ��� ����� �������, ������ ������������...<BR>';	
		}
		if(empty($msg) and preg_match("/".$_POST['login']."/i", $_POST['psw']) or preg_match("/".strrev($_POST['login'])."/i", $_POST['psw'])){
			$msg = '������ �������� �������� ������';
		}
		$uc = 0;
		$lc = 0;
		$num = 0;
		$other = 0;
		for ($i = 0, $j = strlen($_POST['psw']); $i < $j; $i++) {
			$c = substr($_POST['psw'],$i,1);
			if (preg_match('/^[[:upper:]]$/',$c)) {
				$uc++;
			} elseif (preg_match('/^[[:lower:]]$/',$c)) {
				$lc++;
			} elseif (preg_match('/^[[:digit:]]$/',$c)) {
				$num++;
			} else {
				$other++;
			}
		}
		$max = $j - 2;
		if(empty($msg) and ($uc > $max or $lc > $max or $num > $max or $other > $max)) {
			$msg = "������ ������� ����� - �������� ���� ������� ����� ��������� ��� ����� ���� ���� ������.<BR>";
		}
/*		
		if ($fh = fopen("passwords.txt",'r')) {
			$found = false;
			while (! ($found || feof($fh))) {
				$word = preg_quote(trim(strtolower(fgets($fh,1024))),'/');
				if (preg_match("/$word/",strtolower($_POST['psw']))) {
					$found = true;
				}
			}
			fclose($fh);
			if ($found) {
				$msg = "������ ������� ����� - �������� ���� ������� ����� ��������� ��� ����� ���� ���� ������.<BR>";
			}
		}
*/	
		if(empty($msg)){
			$_POST['step'] = '3';
		}
		break;
		
	case '3': //STEP 3
		if (!preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/", $_POST['email'])) {
			$msg = "�� ������� ���� ��������� email (".htmlspecialchars($_POST['email']).").<BR>";
		}
		if(empty($msg)){
			$res = mysql_fetch_array(mysql_query("SELECT `id` FROM `users` WHERE `email` = '".$_POST['email']."'"));
			if($res['id'] != NULL){
				$msg = '����� '.htmlspecialchars($_POST['email']).' ��� ������, �������� ������.<BR>';	
			}
			
		}
		
		if(empty($msg)){
			$_POST['step'] = '4';
		}
		break;
	case '4': //STEP 4
		if(empty($_POST['name'])){
			$msg = '������� ���� �������� ���!<BR>';
		}
		if(empty($msg) and ($_POST['DD']=='00' or $_POST['MM']=='00' or $_POST['YYYY']=='0000')){
			$msg = '������ � ��������� ��� ��������.<BR>';
		}
		if(empty($msg)){
			$_POST['step'] = '5';
		}
		break;
	case '5': //STEP 5

		if(empty($msg) and empty($_POST['Law'])){
			$msg = '��������, ��� �������� ������ ������ �����, �� �� ������ ���������������� ���� ��������.<BR>';
		}
		if(empty($msg) and empty($_POST['Law2'])){
			$msg = '��������, ��� �������� ���������� � �������������� ������� ���� ���������� ����, �� �� ������ ���������������� ��������.<BR>';
		}
		if(empty($msg)){
			$birthday = preg_replace("/[^0-9-]/",'',$_POST["0day"]);
			if (!empty($_SERVER['HTTP_CLIENT_IP'])){
				$ip=$_SERVER['HTTP_CLIENT_IP'];
			}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
				$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			}else{
				$ip=$_SERVER['REMOTE_ADDR'];
			}
			// if(mysql_query("INSERT INTO `users` (`login`,`pass`,`email`,`realname`,`borndate`,`sex`,`city`,`icq`,`lozung`,`color`,`ip`,`refer`) VALUES ('".htmlspecialchars($_POST['login'])."','".md5($_POST['psw'])."','".htmlspecialchars($_POST['email'])."','".htmlspecialchars($_POST['name'])."','".$birthday."','".intval($_POST['sex'])."','".htmlspecialchars($_POST['city'])."','".intval($_POST['icq'])."','".htmlspecialchars($_POST['about'])."','".htmlspecialchars($_POST['ChatColor'])."','".$ip."','".$ref."');")){

			
if(mysql_query("INSERT INTO `users` (`borncity`,`login`,`pass`,`email`,`realname`,`borndate`,`sex`,`city`,`icq`,`http`,`info`,`lozung`,`color`,`ip`,`exp`,`money`,`showmyinfo`,`refer`,`ekr`,`incity`,`vip`)VALUES('Capital City','{$_POST['login']}','".md5($_POST['psw'])."','{$_POST['email']}','{$_POST['name']}','$birthday','{$_POST['sex']}','{$_POST['virtcity']}','{$_POST['icq']}','{$_POST['homepage']}','{$_POST['hobby']}','{$_POST['about']}','{$_POST['ChatColor']}','$ip','300000','2000','1','$ref','300','virtcity','1');")) {
$i = mysql_insert_id();
mq("insert into userdata (id) values($i)");
mq("insert into vip_times (user_id,end_time,eternal) values($i,ADDDATE(NOW(),3),0)");			
			
			
				// $i = mysql_insert_id();
						setcookie("mailru", "enter", time()+86400);
##############################################################################################################################################################						
                    mysql_query("INSERT INTO `inventory` (`owner`,`name`,`nlevel`,`mfkrit`,`mfakrit`,`mfuvorot`,`mfauvorot`,`type`,`massa`,`cost`,`img`,`maxdur`,`present`,`destinyinv`,`stats`,`setid`,`statshm`,`gmeshok`)
                        VALUES('".$i."','������ ����� ����� [8]','8','50','50','50','50','19','0.5','1','bag0831.png','20','skycombats','1','10','103','100','1000') ;");

                    mysql_query("INSERT INTO `inventory` (`owner`,`name`,`type`,`massa`,`cost`,`img`,`maxdur`,`present`,`stats`,`statshm`)
                        VALUES('".$i."','������� ����������','6','0.5','1','shirt1163.png','30','skycombats','10','100') ;");

                    mysql_query("INSERT INTO `inventory` (`owner`,`bron3`,`bron4`,`name`,`type`,`massa`,`cost`,`img`,`maxdur`,`present`,`statshm`)
                        VALUES('".$i."','10','10','����� ����������','24','0.5','1','legs1242.png','30','skycombats','50') ;");

                    mysql_query("INSERT INTO `inventory` (`owner`,`name`,`type`,`massa`,`cost`,`img`,`maxdur`,`present`,`magic`,`otdel`,`isrep`)
                        VALUES('".$i."','����� �����','188','1','0','pot_cureHP100_20.gif','200','skycombats','189','6','0') ;");
					
			        mysql_query("INSERT INTO `inventory` (`owner`,`name`,`type`,`massa`,`cost`,`img`,`maxdur`,`isrep`,`magic`,`present`)
			           VALUES('".$i."', '���������', '25', '1', '0.00', 'attack.gif', '5', '0', '23', 'skycombats') ;");
						
                    mysql_query("INSERT INTO `inventory` (`owner`,`name`,`type`,`massa`,`cost`,`img`,`maxdur`,`present`,`magic`,`otdel`,`isrep`)
                        VALUES('".$i."','��� ����� (��.)','12','1','0','downgrade.gif','10','������','2','6','0') ;");

                    mysql_query("INSERT INTO `inventory` (`owner`,`name`,`nlevel`,`type`,`massa`,`cost`,`img`,`maxdur`,`present`,`magic`,`otdel`,`isrep`)
                        VALUES('".$i."','������� ����������','11','25','1','0','ekr_100.gif','1','skycombats','329','6','0') ;");
						
                     // mysql_query("INSERT INTO `inventory` (`owner`,`name`,`type`,`massa`,`cost`,`img`,`maxdur`,`present`,`magic`,`otdel`,`isrep`)
                        // VALUES('".$i."','��� ����� (��.)','12','1','0','downgrade.gif','10','������','2','6','0') ;");                       				
##################################################################################################################################################################
                    mq("INSERT INTO `effects` (`owner`,`name`,`time`,`type`) values ('$i','�������� ��������� ��������',".(time()+259200).",3);");
                    mq("INSERT INTO `effects` (`owner`,`name`,`time`,`type`) values ('$i','������ ������� (15)',".(time()+1296000).",40);");					
						mysql_query("INSERT INTO `online` (`id` ,`date` ,`room`)VALUES ('".$i."', '".time()."', '1');");

						if(!empty($ref)){
             				        // mysql_query("UPDATE `users` SET `ekr`=`ekr`+10 WHERE `id`='$ref'");

		$us = mysql_fetch_array(mysql_query("select `id` from `online` WHERE `date` >= ".(time()-60)." AND `id` = '{$ref}' LIMIT 1;"));
         		if($us[0]){
		addchp ('<font color=red>��������! </font> <font color=\"Black\">�������� <B>'.$_POST['login'].'</B> ����������������� �� ����� ������.</font>   ','{[]}'.nick7 ($ref).'{[]}');
			} else {
	   	mysql_query("INSERT INTO `telegraph` (`owner`,`date`,`text`) values ('".$ref."','','".'<font color=red>��������!</font> <font color=\"Black\">�������� <B>'.$_POST['login'].'</B> ����������������� �� ����� ������. ��� ����������� 30 ��.</font> '."');");
			}






						}

						session_start();
						setcookie("battle", $i);
						$_SESSION['uid'] = $i;

						mysql_query("UPDATE `users` SET `sid` = '".session_id()."' WHERE `id` = {$i};");
						$_SESSION['sid'] = session_id();
					// addchp ('private ['.$_POST["login"].'] ��������! ������������ ���� -  <a href=javascript:top.AddTo("'.$_POST["login"].'")><span oncontextmenu="OpenMenu()">'.$_POST["login"].'</span></a>!<font color="green"><b> ������������� ������� � ��� ������ warcombats ������ ������� ����� � ��������� �������!</b></font> <font color="red"><b>��. �������!</b></font><font color="green"><b> ��� ����� �������� ���� � ��������� ��������, ��������� ������� � �������, ������� ��������� � Quests City!</b></font><font color="black"><b> �� ���� ������������ ��������..� ��� �� ������������ ���������� ������� � �������, ����������� � ���������� ��� ��� ���������!</b></font>��� �������� �� 6 ��� ��������� ������� ������ ������� ����� ���������� � ����������� "������� � ����".�������� ����!',"�����������", 1);
                        header("Location: battle.php");
                    addchp ('��������! ������� ����� ���������� <a href=javascript:top.AddTo("'.$_POST["login"].'")><span oncontextmenu="OpenMenu()">'.$_POST["login"].'</span></a>! ������������� ������� � ������� ������ ������ ������� ����� � ��������� �������!',"�����������", 1);
                        //������ �������
                        //�������� ���������:))
                    addchp ('private [pal] ��������! ������� ����� ���������� <a href=javascript:top.AddTo("'.$_POST["login"].'")><span oncontextmenu="OpenMenu()">'.$_POST["login"].'</span></a>!',"�����������", 1);
                        //�������� ������:))
                    addchp ('private [Admonion] ��������! ������� ����� ���������� <a href=javascript:top.AddTo("'.$_POST["login"].'")><span oncontextmenu="OpenMenu()">'.$_POST["login"].'</span></a>!',"�����������", 1);
                        //�������� ����:))
                    addchp ('private [Eurobyte] ��������! ������� ����� ���������� <a href=javascript:top.AddTo("'.$_POST["login"].'")><span oncontextmenu="OpenMenu()">'.$_POST["login"].'</span></a>!',"�����������", 1);
                    addchp ('private [��������] ��������! ������� ����� ���������� <a href=javascript:top.AddTo("'.$_POST["login"].'")><span oncontextmenu="OpenMenu()">'.$_POST["login"].'</span></a>!',"�����������", 1);
                    addchp ('private [,,,,,,,] ��������! ������� ����� ���������� <a href=javascript:top.AddTo("'.$_POST["login"].'")><span oncontextmenu="OpenMenu()">'.$_POST["login"].'</span></a>!',"�����������", 1);			
                        //�������� ��������:))
                    addchp ('private [tar] ��������! ������� ����� ���������� <a href=javascript:top.AddTo("'.$_POST["login"].'")><span oncontextmenu="OpenMenu()">'.$_POST["login"].'</span></a>!',"�����������", 1);
                        //�������� � ����� ���
                        //addchp ('��������! ������� ����� ���������� <a href=javascript:top.AddTo("'.$_POST["login"].'")><span oncontextmenu="OpenMenu()">'.$_POST["login"].'</span></a>! ������������� ������� � ������� ������ ������ ������� ����� � ��������� �������!',"�����������", 1);
                        //������ �������
                    addchp ('private ['.$_POST["login"].']<font color="blue"><b> ����������� ��� � �������� ������������ �� ����� SkyCombats, � �������� ������ �� �������� ��� VIP Account �� ��� ���. �������� ���� � ������� �����. ������� ��� �� � ���� !!!</b></font>',"�����������", 1);
                        header("Location: battle.php");						
						die();
			}
		}
		break;
}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<title>����������� � BkWar</title>
	<meta NAME="robots" CONTENT="INDEX,FOLLOW">
	<meta http-equiv=pragma content="no-cache">
    <META HTTP-EQUIV="Cache-control" CONTENT="private">
    <META HTTP-EQUIV=Expires CONTENT=0>
    <link href="http://img.combats.ru/i/register/main1.css" rel="stylesheet" type="text/css"> 
<style type="text/css"> 
.style6 {	color: #DFD3A3;
	font-size: 9px;
}
.style5 {color: #990000}
.style7 {color: #364875}
</style>
<script language="JavaScript"> 
function CheckValue(a) {
    var b = '';
    for (i = '0'; i < a.value.length; i++) {
	var c = a.value.substring(i, i+1);
	if ((c >= 'A' && c <= 'Z') || (c >= 'a' && c <= 'z') ||
	(c.charCodeAt(0) >= 1040 && c.charCodeAt(0) <= 1103)
	|| (c == ' ') || (c == '-'))
	{
	    b += c;
	}
    }
    if (a.value != b) { a.value = b; }
}
</script>
</head>
<body bgcolor="#000000" topmargin=0 leftmargin=0 marginheight=0 marginwidth=0>
<div id='container'>
  <div id='content'>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr valign="top">
        <td><table width="100%" height="135"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td background="http://skycombats.ru/i/register/sitebk_02.jpg" scope="col" align="center"><img src="http://skycombats.ru/register/sitebk_03ru.gif" width="194" height="135" border="0" /></a></td>
          </tr>
        </table></td>
      </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor='#3D3D3B'>
      <tr valign="top">
        <td align="center"><script type="text/javascript">
		  var $wsize = document.body.clientWidth;
		  if ( $wsize >= 800 ) $wsize = Math.floor( $wsize * 0.8 );
		  document.write('<table cellspacing="0" cellpadding="0" bgcolor="#f2e5b1" border="0" width="'+ ( $wsize - 20 ) +'">');
		  </script>
      <tr valign="top">
          <td width="29" rowspan="2" background="http://img.combats-club.ru/register/n21_08_1.jpg"><p><img src="http://img.combats.ru/i/register/nm31_08.jpg" width="29" height="256" /></p></td>
          <td><img src="http://img.combats.ru/i/register/nm31_04.jpg" width="118" height="257" /><br /></td>
          <td rowspan="2" width="100%">
            <!-- Begin of text -->
            <?php
			if(empty($_POST) or $_POST['step']=='1'){
				echo'<h3><br></h3> <TABLE width="100%" border=0 cellPadding=2 cellSpacing=0 name="F1">
  <FORM action="" method="POST" name="FORM1">
    <INPUT type="hidden" name="step" value="1">
    <INPUT type="hidden" name="add" value="1">
    <TBODY>
      <TR>
        <TD colSpan=3><p><img src="http://skycombats.ru/i/regs.gif" width="198" height="26"></p>

          <BR>
          <FONT color=red><B>'.$msg.'</B></FONT></TD>
      </TR>
      <TR>
        <TD width="10" rowspan="2" vAlign=top class="style5">*</TD>
        <TD width="146">��� ������ ��������� (login):</TD>
        <TD width="317"><input NAME="login" value="'.htmlspecialchars($_POST['login']).'" class="inup" size=25 maxlength=15 onPropertyChange="CheckValue(this)">
          &nbsp;
          <INPUT type=submit class="btn" value="����������"></TD>
      </TR>
      <TR>
        <TD colspan="2"><span class="style7">
<small>�����������:</span><BR>
1. ��� �� ����� ���� ������ 2-� �������� � ������� 15-��. ��� �� ����� �������� ����� ��� �� ���� ����.<BR>
���������: <B>������� ����</B>, <B>��������</B>, <B>��</B><BR>
�����������: <B>�</B>, <B>�������������� ������</B><BR><BR>
2. ��� ����� ��������� ������ ����� ��� �������� ��� ����������� ��������. � �������� �������������� �������� ����� ������������ ������ ��� ���� "-"<BR>
���������: <B>����-�����</B>, <B>������ �� ����</B><BR>
�����������: <B>���� 17</B>, <B>*����*</B><BR><BR>
3. ����������� ������������ ��� ������ ���������� �����, ��� ������ �������, �� ������ ������������ ������������ ����� ����� ���������.<BR>
���������: <B>���������</B>, <B>Dead Moroz</B><BR>
�����������: <B>Super ����</B>, <B>����� the best</B><BR><BR>
4. ��� �� ����� ��������� ��������� ����� ����� �������.<BR>
���������: <B>Vasya</B>, <B>���� ��������</B><BR>
�����������: <B>vAsya</B>, <B>������������</B><BR><BR>
5. ��� �� ����� ���������� ��� ������������� ��������, �������������� ��� ����<BR>
���������: <B>Vasya</B>, <B>���� ��������</B><BR>
�����������: <B>Vasya-</B>, <B>-���� ��������-</B><BR><BR>
6. ��������� ������������ ��� �������������� ������� ������<BR>
���������: <B>���� c �������</B>, <B>���� ��������</B><BR>
�����������: <B>����--�--�����</B>, <B>����- ��������</B><BR><BR>
7. ��������� ������������� ���� � ����� ���������� �������� ������<BR>
���������: <B>���� � �������</B>, <B>���� ��������</B><BR>
�����������: <B>������</B>, <B>����������</B><BR><BR>
8. ��� ������ ���� ��������. ��������� ��������� ��������� ���� (��, ��������) � ������ � ����� ��������� ������.<BR>
���������: <B>���� c �������</B>, <B>���� ��������</B><BR>
�����������: <B>FTRNZJ</B>, <B>�����</B><BR><BR>
9. ��� �� ����� ��������� ����������� ������� � �����������.<BR>
���������: <B>����</B>, <B>���� ��������</B><BR>
�����������: <B><FONT color=red>&lt;�������� ��������&gt;</FONT></B>, <B><FONT color=red>&lt;�������� ����������� ��������&gt;</FONT></B><BR><BR>
</small>
  </TR>
</TD>

  
<INPUT type="hidden" name="psw" value="">
    <INPUT type="hidden" name="psw2" value="">
    <input type="hidden" name="email" value="">
    <input type="hidden" name="secretquestion" value="">
    <input type="hidden" name="secretanswer" value="">
    <input type="hidden" name="name" value="">
    <input type="hidden" name="0day" value="00-00-0000">
    <input type="hidden" name="sex" value="0">
    <input type="hidden" name="city" value="">
    <input type="hidden" name="icq" value="">
    <input type="hidden" name="hide_icq" value="">
    <input type="hidden" name="about" value="">
    <input type="hidden" value="Black" name="ChatColor">
  </FORM>
</TABLE>
';	
			}elseif($_POST['step']=='2'){
				echo'<h3><br></h3>
<TABLE width="100%" border=0 cellPadding=2 cellSpacing=0 name="F1">
  <FORM action="" method="POST" name="FORM1">
    <INPUT type=hidden name=step value="2">
    <INPUT type=hidden name=add value="1">
    <TBODY>
      <TR>
        <TD colSpan=3><p><img src="http://skycombats.ru/i/regs.gif" width="198" height="26"></p>
          <span class="style5"><B>��������!</B></span> ������ ���� �������� <U>������</U> ��� ��������� Internet Explorer! ���������� ������ 5.5 � ����.<BR>
          <BR>
          <FONT color=red><B>'.$msg.'</b></FONT></TD>
      </TR>
      <TR>
        <TD vAlign=top><span class="style5">*</span></TD>
        <TD>��� ������ ���������:</TD>
        <TD><input type="hidden" NAME="login" value="'.$_POST['login'].'">
          '.$_POST['login'].'</TD>
      </TR>
      <TR>
      <TR>
        <TD vAlign=top><span class="style5">*</span></TD>
        <TD>������:</TD>
        <TD><input name=psw type=password value="'.htmlspecialchars($_POST['psw']).'" class="inup" size=15 maxlength=21></TD>
      </TR>
      <TR>
        <TD vAlign=top><span class="style5">*</span></TD>
        <TD>������ ��������:</TD>
        <TD><input name=psw2 type=password value="'.htmlspecialchars($_POST['psw2']).'" class="inup" size=15 maxlength=21></TD>
      </TR>
      <TR>
        <TD vAlign=top>&nbsp;</TD>
        <TD colspan="2"><small><span class="style7"> ������� ������� ������: ������ ������ ����� � ��� �����. �������� hero63<BR>
          <BR>
          ����� ������� ������, ��������</span> <A HREF="http://skycombats.ru/encicl/FAQ/afer.html" target=_blank><B>��� �������</B></A><BR>
          1. ������ �� ����� ���� ������ 6 ��������.<BR>
          �����������: <B>mks23</B>, <B>zm2</B><BR>
          ���������: <B>telez371</B><BR>
          <BR>
          2. ��������� ������ ���������� ������ ����� ����� ��������� � ������ ��������.<BR>
          �����������: <B>sharksn</B>, <B>letotron</B><BR>
          ���������: <B>sharksn25</B>, <B>leto_tron</B><BR>
          <BR>
          3. ��������� �������, ���������������� ������.<BR>
          �����������: <B>qwerty123456</B>, <B>qazwsx098</B><BR>
          ���������: <B>telez371</B>, <B>nord-23k</b><BR>
          <BR>
          4. ������ �� ������ ��������� ����� ������.
          �����������: <B>vasya2004</B> ��� ������ <B>Vasya</B><BR>
          ���������: <B>telez371</B>, <B>nord-23k</b> ��� ������ <B>Vasya</B>.<BR>
          <BR>
          5. ������������� �� ������������� �������� ������ ����������� � ������� �� email.<BR>
        </small></TD>
      </TR>
    <TD align=center colSpan=4><p> <br>
      <TABLE width=100%>
        <tr>
          <TD><INPUT onclick=\'FORM1.step.value=""; FORM1.submit()\' type=button class="btn" value="���������"></TD>
          <TD><INPUT type=submit class="btn" value="����������"></TD>
        </tr>
      </TABLE>
      </p>
      <br>
      <br>
      <br>
      <br></TD>
    </TR>
    </TBODY>
    
    <input type="hidden" name=email value="">
    <input type="hidden" name=secretquestion class="inup" value="">
    <input type="hidden" name=secretanswer value="">
    <input type="hidden" name=name value="">
    <input type="hidden" name="0day" value="00-00-0000">
    <input type="hidden" name="sex" value="0">
    <input type="hidden" name=city value="">
    <input type="hidden" name=icq value="">
    <input type="hidden" name="hide_icq" value="">
    <input type="hidden" value="" name=about>
    <input type="hidden" value="Black" name=ChatColor>
  </FORM>
</TABLE>';	
			}elseif($_POST['step']=='3'){
			echo'<h3><br></h3>
<TABLE width="100%" border=0 cellPadding=2 cellSpacing=0 name="F1">
  <FORM action="" method="POST" name="FORM1">
    <INPUT type=hidden name=step value="3">
    <INPUT type=hidden name=add value="1">
    <TBODY>
      <TR>
        <TD colSpan=3><p><img src="http://skycombats.ru/i/regs.gif" width="198" height="26"></p>
          <span class="style5"><B>��������!</B></span> ������ ���� �������� <U>������</U> ��� ��������� Internet Explorer! ���������� ������ 5.5 � ����.<BR>
          <BR>
          <FONT color=red><B>'.$msg.'</b></FONT></TD>
      </TR>
      <TR>
        <TD vAlign=top><span class="style5">*</span></TD>
        <TD>��� ������ ���������:</TD>
        <TD><input type="hidden" NAME="login" value="'.htmlspecialchars($_POST['login']).'">
          '.htmlspecialchars($_POST['login']).'</TD>
      </TR>
      <TR>
        <INPUT type="hidden" name="psw" value="'.htmlspecialchars($_POST['psw']).'">
        <INPUT type="hidden" name="psw2" value="'.htmlspecialchars($_POST['psw2']).'">
      <TR>
        <TD rowspan="2" vAlign=top class="style5">*</TD>
        <TD width="146">��� e-mail: </TD>
        <TD><input name=email class="inup" value="'.htmlspecialchars($_POST['email']).'" maxlength=50></TD>
      </TR>
      <TR>
        <TD colspan="2">(������������ <U>������</U> ��� ����������� ������, ����� �� ������������ � �� ������������ ��� �������� "�����������/����������/..." � ������� �����.)</TD>
      </TR>

      <TR>
        <TD align=center colSpan=4><p> <br>
          <TABLE width=100%>
            <TR>
              <TD><INPUT onclick=\'FORM1.step.value="2"; FORM1.submit()\' type=button class="btn" value="���������"></TD>
              <TD><INPUT type=submit class="btn" value="����������"></TD>
            </TR>
          </TABLE>
          </p>
          <br>
          <br>
          <br>
          <br></TD>
      </TR>
      </TR>
    </TBODY>
    <input type="hidden" name=name value="">
    <input type="hidden" name="0day" value="00-00-0000">
    <input type="hidden" name="sex" value="0">
    <input type="hidden" name=city value="">
    <input type="hidden" name=icq value="">
    <input type="hidden" name="hide_icq" value="">
    <input type="hidden" value="" name=about>
    <input type="hidden" value="Black" name=ChatColor>
  </FORM>
</TABLE>';	
			}elseif($_POST['step'] == '4'){
				echo'<h3><br></h3>
<TABLE width="100%" border=0 cellPadding=2 cellSpacing=0 name="F1">
  <FORM action="" method="POST" name="FORM1">
    <INPUT type=hidden name=step value="4">
    <INPUT type=hidden name=add value="1">
    <TBODY>
      <TR>
        <TD colSpan=3><p><img src="http://skycombats.ru/i/regs.gif" width="198" height="26"></p>
          <span class="style5"><B>��������!</B></span> ������ ���� �������� <U>������</U> ��� ��������� Internet Explorer! ���������� ������ 5.5 � ����.<BR>
          <BR>
          <FONT color=red><B>'.$msg.'</b></FONT></TD>
      </TR>
      <TR>
        <TD vAlign=top><span class="style5">*</span></TD>
        <TD>��� ������ ���������:</TD>
        <TD><input type="hidden" NAME="login" value="'.htmlspecialchars($_POST['login']).'">
          '.htmlspecialchars($_POST['login']).'</TD>
      </TR>
      <TR>
        <INPUT type="hidden" name="psw" value="'.htmlspecialchars($_POST['psw']).'">
        <INPUT type="hidden" name="psw2" value="'.htmlspecialchars($_POST['psw2']).'">
        <input type="hidden" name=email value="'.htmlspecialchars($_POST['email']).'">
        <input type="hidden" name=secretquestion class="inup" value="'.htmlspecialchars($_POST['secretquestion']).'">
        <input type="hidden" name=secretanswer value="'.htmlspecialchars($_POST['secretanswer']).'">
      <TR>
        <TD vAlign=top><span class="style5">*</span></TD>
        <TD>���� �������� ���: </TD>
        <TD><input name=name value="'.htmlspecialchars($_POST['name']).'" class="inup" size=45 maxlength=90></TD>
      </TR>
      <TR>
        <TD rowspan="2" vAlign=top class="style5">*</TD>
        <TD>���� ��������:</TD>
        <TD><script language="javascript" type="text/javascript"> 
function procdays (month) {
var selected = document.getElementById(\'dd\').value;
//	if (selected == "") selected=1;
document.getElementById(\'dd\').length = 0;
var days = new Array(3,0,3,2,3,2,3,3,2,3,2,3);
if (Math.round(document.getElementById(\'yyyy\').value/4) == document.getElementById(\'yyyy\').value/4) {days[1]=1;}
var ind = parseFloat(month.value)-1;
if (ind < 0) ind=0;
var base = 29 + days[ind];
//	if (selected>(base-1)) {selected=1;}
if (selected>(base-1)) {selected="";}
document.getElementById(\'dd\').add(document.createElement("option"));
for (var i=1; i<base; i++) {
var myday = document.createElement("option");
myday.value = i;
myday.text = i;
document.getElementById(\'dd\').add(myday);
}
document.getElementById(\'dd\').value = selected;
genZerodate();
return true;
}
function genZerodate () {
var ss=document.getElementById(\'dd\').value;
if (ss.length < 2) ss=\'0\'+ss;
if (ss.length < 2) ss=\'0\'+ss;
var str = ss+\'-\'+document.getElementById(\'mm\').value+\'-\'+document.getElementById(\'yyyy\').value;
document.getElementById(\'nhya\').value = str;
return true;
}
        </script>
          ����:
          <select name="DD" id="dd" class="inup" onchange="genZerodate();">
            <option value="0" selected="1"></option>
            <SCRIPT> 
var s="";
for (i=1; i<=31; i++) {
s+=\'<option value="\'+i+\'">\'+i+\'</option>\';
}
document.write(s);
    </SCRIPT>
          </select>
          �����:
          <select name="MM" onchange="procdays(this);"  class="inup" id="mm">
            <option value="00" selected="1"></option>
            <option value="01">������</option>
            <option value="02">�������</option>
            <option value="03">����</option>
            <option value="04">������</option>
            <option value="05">���</option>
            <option value="06">����</option>
            <option value="07">����</option>
            <option value="08">������</option>
            <option value="09">��������</option>
            <option value="10">�������</option>
            <option value="11">������</option>
            <option value="12">�������</option>
          </select>
          ���:
          <select name="YYYY" class="inup" onchange="procdays(document.getElementById(\'mm\'));" id="yyyy">
            <option value="0000" selected="1"></option>
            <SCRIPT> 
var s="";
for (i=2004; i>=1920; i--) {
s+=\'<option value="\'+i+\'">\'+i+\'</option>\';
}
document.write(s);
  </SCRIPT>
          </select>
          <input type="text" name="0day" id="nhya" value="'.htmlspecialchars($_POST['DD']).'-'.htmlspecialchars($_POST['MM']).'-'.htmlspecialchars($_POST['YYYY']).'" style="width:0px; height:0px; visibility:hidden" />
          <SCRIPT> 
var s=document.getElementById(\'n
hya\');
s=s.value.split("-");
if (s.length > 0) {
s[0]=parseFloat(s[0]);
FORM1.DD.value=s[0];
}
if (s.length > 1) {
s[1]=parseFloat(s[1]);
if (s[1] < 10 ) s[1]=\'0\'+s[1];
FORM1.MM.value=s[1];
}
if (s.length > 2) {
s[2]=parseFloat(s[2]);
if (s[2] > 0 && s[2] < 10 ) {s[2]=\'200\'+s[2];} else {
if (s[2] > 0 && s[2] < 100 ) s[2]=\'19\'+s[2];
}
FORM1.YYYY.value=s[2];
}
procdays(document.getElementById(\'mm\'));
</SCRIPT></TD>
      </TR>
      <TR>
        <TD colspan="2"><small><span class="style5">��������! </span><span class="style7">���� �������� ������ ���� ����������, ��� ������������ � ������� ��������. ������ � ������������ ����� ����� ��������� ��� ��������������.</span></small></TD>
      </TR>
      <TR>
        <TD vAlign=top><span class="style5">*</span></TD>
        <TD colspan="2">��� ���������:<BR>
          <INPUT id=A1 style="CURSOR: hand" type=radio value="1" name="sex">
          <LABEL for=A1> �������</LABEL>
          <BR>
          <INPUT id=A2 style="CURSOR: hand" type=radio value="0" name="sex">
          <LABEL for=A2> �������</LABEL></TD>
      </TR>
      <TR>
        <TD>        
        <TD colspan="2"><small><span class="style5">��������! </span><span class="style7">��� ��������� ������ ��������������� ��������� ���� ������.</span></small></TD>
      </TR>
      <TR>
        <TD>&nbsp;</TD>
        <TD>�����: </TD>
        <TD><INPUT TYPE="text" value="'.htmlspecialchars($_POST['city']).'" NAME="city" size=20 maxlength=40 class="inup"></TD>
      </TR>
      <TR>
        <TD>&nbsp;</TD>
        <TD>ICQ:</TD>
        <TD><input value="'.htmlspecialchars($_POST['hide_icq']).'" name=icq class="inup" size=9 maxlength=20>
          <INPUT type=checkbox name="hide_icq" value=1>
          �� ����������</td>
          </TD>
      </TR>
      <TR>
        <TD>&nbsp;</TD>
        <TD>�����:</TD>
        <TD><input value="'.htmlspecialchars($_POST['about']).'" name=about class="inup" size=60 maxlength=160></TD>
      </TR>
      <TR>
        <TD>&nbsp;</TD>
        <TD>���� ��������� � ����:</TD>
        <TD><select name=ChatColor class="inup">';
$colors = array(array('black','Black'),array('blue','Blue'),array('fuchsia','Fuchsia'),array('gray','Grey'),array('green','Green'),array('maroon','Maroon'),array('navy','Navy'),array('olive','Olive'),array('purple','Purple'),array('teal','Teal'),array('orange','Orange'),array('chocolate','Chocolate'),array('sandybrown','SandyBrown'));
foreach ($colors as $row) {
	echo'<option style="BACKGROUND: #f2f0f0; COLOR: '.$row[0].'" value="'.$row[0].'">'.$row[1].'</option>';
}
echo'        </select>
          <SCRIPT>FORM1.ChatColor.value="black"</SCRIPT></TD>
      </TR>
      <TR>
        <TD align=center colSpan=4><p> <br>
          <TABLE width=100%>
            <TR>
              <TD><INPUT onclick=\'genZerodate(); FORM1.step.value="3"; FORM1.submit()\' type=button class="btn" value="���������"></TD>
              <TD><INPUT onclick="genZerodate(); FORM1.submit(); " type=submit class="btn" value="����������"></TD>
            </TR>
          </TABLE>
          </p>
          <br>
          <br>
          <br>
          <br></TD>
      </TR>
  </FORM>
</TABLE>';	
			}elseif($_POST['step']=='5'){
				echo'<h3><br></h3> <TABLE width="100%" border=0 cellPadding=2 cellSpacing=0 name="F1">
  <FORM action="" method="POST" name="FORM1">
    <INPUT type="hidden" name="step" value="5">
    <INPUT type="hidden" name="add" value="1">
    <TBODY>
      <TR>
        <TD colSpan=3><p><img src="http://skycombats.ru/i/regs.gif" width="198" height="26"></p>
          <span class="style5"><B>��������!</B></span> ������ ���� �������� <U>������</U> ��� ��������� Internet Explorer! ���������� ������ 5.5 � ����.<BR>
          <BR>
          <FONT color=red><B>'.$msg.'</B></FONT></TD>
      </TR>
      <TR>
        <TD vAlign=top><span class="style5">*</span></TD>
        <TD>��� ������ ���������:</TD>
        <TD><input type="hidden" NAME="login" value="'.htmlspecialchars($_POST['login']).'">
          '.htmlspecialchars($_POST['login']).'</TD>
      </TR>
      <TR>
        <INPUT type="hidden" name="psw" value="'.htmlspecialchars($_POST['psw']).'">
        <INPUT type="hidden" name="psw2" value="'.htmlspecialchars($_POST['psw2']).'">
        <input type="hidden" name=email value="'.htmlspecialchars($_POST['email']).'">
        <input type="hidden" name=secretquestion value="'.htmlspecialchars($_POST['secretquestion']).'">
        <input type="hidden" name=secretanswer value="'.htmlspecialchars($_POST['secretanswer']).'">
        <input type="hidden" name=name value="'.htmlspecialchars($_POST['name']).'">
        <input type="hidden" name="0day" value="'.htmlspecialchars($_POST['0day']).'">
        <input type="hidden" name="sex" value="'.htmlspecialchars($_POST['sex']).'">
        <input type="hidden" name=city value="'.htmlspecialchars($_POST['city']).'">
        <input type="hidden" name=icq value="'.htmlspecialchars($_POST['icq']).'">
        <input type="hidden" name="hide_icq" value="'.htmlspecialchars($_POST['hide_icq']).'">
        <input type="hidden" value="'.htmlspecialchars($_POST['about']).'" name=about>
        <input type="hidden" value="'.htmlspecialchars($_POST['ChatColor']).'" name=ChatColor>
      <TR>
        <TD vAlign=top><FONT color=red>*</FONT></TD>
        <TD colspan="2"><INPUT id=A3 style="CURSOR: hand" type=checkbox name=Law>
          <LABEL for=A3> � �������� ���������</LABEL>
          <A TARGET=_blank HREF="http://skycombats.ru/encicl/law.html"><B>������ ����������� �����</B></A></TD>
      </TR>
      <TR>
        <TD vAlign=top><FONT color=red>*</FONT></TD>
        <TD colspan="2"><INPUT id=A4 style="CURSOR: hand" type=checkbox name=Law2>
          <LABEL for=A4> </LABEL>
          <LABEL FOR=A4>� ����������� �</LABEL>
          <A TARGET=_blank HREF="http://www.combats.com/TOS.html"><B>����������� � �������������� ������� ���� "���������� ����"</B></A> � �������� �� ���� �������. </TD>
      </TR>

      <TR>
        <TD align=center colSpan=4><p> <br>
          <TABLE width=100%>
            <TR>
              <TD><INPUT onclick=\'FORM1.step.value="4"; FORM1.submit()\' type=button class="btn" value="���������"></TD>
              <TD><INPUT type=submit class="btn" value="����������������"></TD>
            </TR>
          </TABLE>
          </p>
          <p align="left">��� �������� ������������ � ��������� ���� ����������� �������� ������ <A TARGET=_blank HREF="http://skycombats.ru/encicl/start.html"><B>������� �����</B></A> ��� �������� <A HREF="http://skycombats.ru/encicl/fc_faq.hlp"><B>������� ����������� (HLP-���� 50��)</B></A>. </p>
          <br>
          <br>
          <br>
          <br></TD>
  </FORM>
</TABLE>
';	
			}
			
			?>
            <!-- End of text -->
          <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>     
</td>
          <td style="padding-left: 3" align="right"><img height="130" src="http://img.combats.ru/i/register/ico_n13profile_03ru.jpg" width="130" border="0" /></td>
          <td valign="top" background="http://img.combats-club.ru/register/nnn21_03_1.jpg">&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
      <tr valign="top">
        <td>&nbsp;</td>
        <td valign="center" style="padding-bottom:50" align="right"><img height="236" src="http://img.combats.ru/i/register/nm314_13.jpg" width="128" border="0" /></td>
        <td width="23" valign="top" background="http://img.combats-club.ru/register/nnn21_03_1.jpg">&nbsp;</td>

 </tr>
    </table>
    </td>
    </tr>
    </table>
  </div>
</div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#000000">
  <tr>
    <td width="100%" height="13" background="http://skycombats.ru/register/sitebk_07.jpg"></td>
  </tr>
  </tr>
  
  </div>
  </td>
  
  <td valign="middle" align="center"><NOBR><span class="style6">Copyright &copy; 2013 �www.SkyCombats.ru�</span></NOBR></td>
  </tr>
</table>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter31463688 = new Ya.Metrika({
                    id:31463688,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/31463688" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>