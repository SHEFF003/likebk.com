<?php
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__magic.php');
include('_incl_data/class/__user.php');

if( $u->info['admin'] == 0 ) {
	die();
}

if(isset($_GET['v1'])) {
	$_POST['uid'] = $_GET['v1'];
}

if(isset($_POST['uid'])) {
	$user = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.mysql_real_escape_string($_POST['uid']).'" OR `login` = "'.mysql_real_escape_string($_POST['uid']).'" LIMIT 1'));
	if(isset($user['id'])) {
		$ach = mysql_fetch_array(mysql_query('SELECT * FROM `achiev` WHERE `uid` = "'.$user['id'].'" LIMIT 1'));
		if(isset($ach['id'])) {
			if(isset($_GET['v1'])) {
				if(isset($_GET['v2'])) {
					$i = round((int)$_GET['v2']);
					if( $i >= 0 ) {
						$alm = mysql_fetch_array(mysql_query('SELECT * FROM `achiev` WHERE `a'.$i.'lvl` = "'.($ach['a'.$i.'lvl']-1).'" ORDER BY `a'.$i.'` ASC LIMIT 1'));
						if(isset($alm['id'])) {
							mysql_query('UPDATE `achiev` SET `a'.$i.'` = "'.$alm['a'.$i].'",`a'.$i.'lvl` = "'.$alm['a'.$i.'lvl'].'" WHERE `id` = "'.$ach['id'].'" LIMIT 1');
							header('location: /editor2.php?v1='.$user['id'].'');
							die();
						}else{
							echo '<div style="color:red">��� ����������� "������!"</div><br>';
						}
					}
				}elseif(isset($_GET['v3'])) {
					$i = round((int)$_GET['v3']);
					if( $i >= 0 ) {
						$alm = mysql_fetch_array(mysql_query('SELECT * FROM `achiev` WHERE `a'.$i.'lvl` = "'.($ach['a'.$i.'lvl']+1).'" ORDER BY `a'.$i.'` ASC LIMIT 1'));
						if(isset($alm['id'])) {
							mysql_query('UPDATE `achiev` SET `a'.$i.'` = "'.$alm['a'.$i].'",`a'.$i.'lvl` = "'.$alm['a'.$i.'lvl'].'" WHERE `id` = "'.$ach['id'].'" LIMIT 1');
							header('location: /editor2.php?v1='.$user['id'].'');
							die();
						}else{
							echo '<div style="color:red">��� ����������� "������!"</div><br>';
						}
					}
				}
			}
		}
	}
}

if(isset($_GET['add'])) {
  header('location: /editor2.php');
  die();
}

?>
<!doctype html>
<html>
<head>
<meta charset="windows-1251">
<title>�������� ����������</title>
</head>

<body>

<? if(!isset($user['id'])) { ?>
<form method="post" action="editor2.php">
	������� ����� ��� ID: <input type="text" name="uid" value="">
	<input type="submit" value="�������������">
</form>
<? }else{

$an = array(
	'',
	'������ � ���������� ����',
	'������ �� ���� ����',
	'����������� ������',
	'������ ���������� ���',
	'�������� �������� ��������',
	'����� � ��������� ����',
	'������� ������� ������ �������',
	'�������� ������� �� ������ �������',
	'������� 200 000 ��������� � �������',
	'��������� 100 ����� �����������',
	'���������� 1000 ����� �� ����������� �������'
);
$i = 1;
while( $i <= 11 ) {
	$alm = mysql_fetch_array(mysql_query('SELECT * FROM `achiev` ORDER BY `a'.$i.'lvl` DESC , `a'.$i.'` ASC LIMIT 1'));
	echo '[�������: '.$ach['a'.$i.'lvl'].' , ������������ � �������: '.$alm['a'.$i.'lvl'].' ] <img src="http://img.likebk.com/achiev/a'.$i.'-'.$ach['a'.$i.'lvl'].'.png" height="12"> <b>'.$an[$i].'</b> &nbsp; <a href="?v1='.$user['id'].'&v2='.$i.'">[�������� �� '.($ach['a'.$i.'lvl']-1).' ������]</a> <a href="?v1='.$user['id'].'&v3='.$i.'">[�������� �� '.($ach['a'.$i.'lvl']+1).' ������]</a><br><br>';
	$i++;
}
?>
	
<? } ?>

</body>
</html>
