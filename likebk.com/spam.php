<?php
function GetRealIp(){
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
		return $_SERVER['HTTP_CLIENT_IP'];
	else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
	return $_SERVER['REMOTE_ADDR'];
}
define('IP',GetRealIp());
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

if(isset($_GET['chat'])) {
	echo '<B>����� ���� ���������:</b><br> - - - - - ������ - - - - -<br>';
	$sp = mysql_query('SELECT * FROM `chat` WHERE `spam` > 0 ORDER BY `time` DESC');
	while($pl = mysql_fetch_array($sp) ) {
		echo date('d.m.Y H:i',$pl['time']).' <b>'.$pl['login'].'</b>: '.$pl['text'].'<hr>';
	}
	die('<br>- - - - - ����� - - - - - ');
}

if( $u->info['admin'] > 0 ) {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>�������������� ������� �� �����</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<meta http-equiv=Cache-Control Content=no-cache>
<meta http-equiv=PRAGMA content=NO-CACHE>
<meta http-equiv=Expires Content=0>
<link href="http://img.likebk.com/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.1.11.js"></script>
<body style="padding-top:0px; margin-top:7px; height:100%; background-color:#dedede;">
<b>������ ����������� ����\������:</b> &nbsp; <input onClick="location.href='/spam.php';" type="button" value="��������"><br><br>
<?
$spam = mysql_fetch_array(mysql_query('SELECT * FROM `spam_word` WHERE `id` = 1 LIMIT 1'));
$spam = $spam['data'];
$spam = explode('|',$spam);
//
if(isset($_GET['del'])) {
	echo '<div><font color="red">����� &quot;<b>'.$spam[floor((int)$_GET['del'])].'</b>&quot; �������.</font><br><br></div>';
	unset($spam[floor((int)$_GET['del'])]);
	$spam = implode('|',$spam);
	mysql_query('UPDATE `spam_word` SET `data` = "'.mysql_real_escape_string($spam).'" WHERE `id` = "1" LIMIT 1');
	$spam = explode('|',$spam);
}elseif(isset($_POST['add'])){
	$_POST['add'] = htmlspecialchars($_POST['add'],NULL,'cp1251');
	echo '<div><font color="green">����� &quot;<b>'.$_POST['add'].'</b>&quot; ���������.</font><br><br></div>';
	$spam = implode('|',$spam);
	$spam .= '|'.$_POST['add'].'';
	mysql_query('UPDATE `spam_word` SET `data` = "'.mysql_real_escape_string($spam).'" WHERE `id` = "1" LIMIT 1');
	$spam = explode('|',$spam);
}
//
$i = 0;
while( $i < count($spam) ) {
	echo ''.$spam[$i].' <a href="/spam.php?del='.$i.'"><img src="http://img.likebk.com/i/close2.gif"></a><hr>';
	$i++;
}
?>
<form method="post" action="/spam.php">
<input type="text" name="add" value="" style="width:244px;"> <input type="submit" value="��������">
</form>
</body>
</html>
<?	
}else{
	die('������? :)');
}

?>