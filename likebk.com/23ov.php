<?php
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__magic.php');
include('_incl_data/class/__user.php');

if(!isset($u->info['id']) || $u->info['room'] != 9) {
	header('location: main.php');
	die();
}

if( $u->info['admin'] == 0 ) {
	if( date('m') != 2 || date('d') < 23 || date('d') > 28 ) {
		//die();
	}
}

$itm1x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 7005 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 LIMIT 1'));
$itm1x = $itm1x[0];

$itm2x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 7004 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 LIMIT 1'));
$itm2x = $itm2x[0];

$bonus = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `23quest` WHERE `time` > "'.time().'" LIMIT 1'));
$bonus = $bonus[0];

$mybonus = mysql_fetch_array(mysql_query('SELECT * FROM `23quest` WHERE `time` > "'.time().'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
$last = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `23quest` WHERE `id` < "'.$mybonus['id'].'" LIMIT 1'));
$last = $last[0];

if( !isset($mybonus['id']) ) {
	if(isset($_GET['action2'])) {
		$ob = floor( $itm2x / 10 );	
		if( $ob < 1 ) {
			$error = '��������� ��������, ������������ ������� �������. ���������� 10 ��.';
		}else{
			mysql_query('DELETE FROM `items_users` WHERE `item_id` = 7004 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 LIMIT ' . ($ob*10));
			$i = 0;
			while( $i < $ob ) {
				$u->addItem( 7005 , $u->info['id'] );
				$itm1x += 1;
				$i++;
			}
			$itm2x -= $ob*10;
			$error = '�� ������� �������� ������� ������ �� '.$ob.' ��. �������� �������!';
		}
	}elseif(isset($_GET['action1'])) {	
		if( $itm1x < 200 ) {
			$error = '������������ �������� �������! ���������� ������� 200 ��.!';
		}else{
			$itm2x++;
			mysql_query('INSERT INTO `23quest` (`uid`,`time`) VALUES ("'.$u->info['id'].'","'.( time() + 86400 * 345 ).'")');
			mysql_query('DELETE FROM `items_users` WHERE (`item_id` = 7004 OR `item_id` = 7005) AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0');
			$error = '�� ������� ����� '.$itm1x.' ��. �������� �������!';
			$bonus++;
			if( $bonus < 200 ) {
				$u->addItem( 7006 , $u->info['id'] );
				$error .= ' �� ������ '.$bonus.' ����� � ��������� �������������� ���� &quot;���� ��������� ������&quot;!';
			}
		}
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<meta http-equiv=Cache-Control Content=no-cache>
<meta http-equiv=PRAGMA content=NO-CACHE>
<meta http-equiv=Expires Content=0>
<link href="http://img.likebk.com/css/main.css" rel="stylesheet" type="text/css">
</head>
<body style="padding-top:0px; margin-top:7px; height:100%; background-color:#E2E0E0;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="300">&nbsp;</td>
    <td>
    	<h3><center>"������ ������ �����" (����� �� 23 �������)</center></h3>
    </td>
    <td width="300" align="right">
        <input type="button" class="btn" onClick="location.href='/23ov.php'" value="��������">
    	<input type="button" class="btn" onClick="location.href='main.php'" value="���������">
    </td>
  </tr>
</table>
<br>

<?
if(isset($error)) {
	echo '<div align="center" style="padding:10px;"><font color="red"><b>'.$error.'</b></font></div>';
}
?>

<center>
	<div style="width:1000px; text-align:justify;">
	<center><b>����� ���� ������ ������ ����� �������� ���� ������ ����� � ���� ���!</b><br></center><br>
    � ����������� ���� ����� �������� <img src="http://img.likebk.com/i/items/trofi2.gif"> <b>�������� ������</b>, ��� �������� ������� � ������ ������ ���� ��� ����������� ������� 200 �������� �������! �� ������ ������ ��� ������� �� 28 ������� (������������)!
    � ������� ����� ������ <img src="http://img.likebk.com/i/items/trofi1.gif"> <b>������� ������</b>. �� ����� �������� �� <b>�������� ������</b> �� �����: <b>10 ������� �������</b> = <b>1 �������� ������</b>.<br><br>
    <? if( isset($mybonus['id']) ) { ?>
    <div><b><font color=green>�� ��� ��������� �������, ����� <?=($last+1)?> �����! <? if( $last < 200 ) { echo ' (�� �������� ����)'; } ?></font></b></div>
    <? }else{ ?>
    � ��� <b>�������� �������</b>: <?=$itm1x?> / 200 <input type="button" class="btn" onClick="location.href='/23ov.php?action1=1'" value="����� ������"><br>
    � ��� <b>������� �������</b>: <?=$itm2x?> <input type="button" class="btn" onClick="location.href='/23ov.php?action2=1'" value="�������� �� ��������"><br><br>
    <? } ?>
    � �������, �� ���������� �������, �� �������� <img src="http://img.likebk.com/i/defender.gif"> <b>������ ��������� ������</b>! ������ 200 ������� ����������� ������� ������� ������ ���� - <img src="http://img.likebk.com/i/items/23ck.gif"> <b>���� ��������� ������</b>!
	<b><font color=red><? if( $bonus < 200 ) { ?>�������� ������: <?=(200-$bonus)?> ��.<? }else{ echo '����� ��������� ������ ����������� :('; } ?></font></b>
    </div>
</center>
</body></html>