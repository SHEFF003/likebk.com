<?php
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__magic.php');
include('_incl_data/class/__user.php');

if( $u->info['admin'] == 0 ) {
	if( date('m') != 3 || date('d') < 6 || date('d') > 13 ) {
		die();
	}
}

if(!isset($u->info['id']) || $u->info['room'] != 9) {
	header('location: main.php');
	die();
}

$itm1x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 7016 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 LIMIT 1'));
$itm1x = $itm1x[0];

$itm2x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 7015 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 LIMIT 1'));
$itm2x = $itm2x[0];

$bonus = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `8quest` WHERE `time` > "'.time().'" LIMIT 1'));
$bonus = $bonus[0];

$mybonus = mysql_fetch_array(mysql_query('SELECT * FROM `8quest` WHERE `time` > "'.time().'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
$last = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `8quest` WHERE `id` < "'.$mybonus['id'].'" LIMIT 1'));
$last = $last[0];

if( !isset($mybonus['id']) ) {
	if(isset($_GET['action2'])) {
		$ob = floor( $itm2x / 10 );	
		if( $ob < 1 ) {
			$error = '��������� ��������, ������������ ������� ������. ���������� 10 ��.';
		}else{
			mysql_query('DELETE FROM `items_users` WHERE `item_id` = 7015 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 LIMIT ' . ($ob*10));
			$i = 0;
			while( $i < $ob ) {
				$u->addItem( 7016 , $u->info['id'] );
				$itm1x += 1;
				$i++;
			}
			$itm2x -= $ob*10;
			$error = '�� ������� �������� ������� ����� �� '.$ob.' ��. ��������� �����!';
		}
	}elseif(isset($_GET['action1'])) {	
		if( $itm1x < 200 ) {
			$error = '������������ ��������� ������! ���������� ������� 200 ��.!';
		}else{
			$itm2x++;
			mysql_query('INSERT INTO `8quest` (`uid`,`time`) VALUES ("'.$u->info['id'].'","'.( time() + 86400 * 345 ).'")');
			mysql_query('DELETE FROM `items_users` WHERE (`item_id` = 7015 OR `item_id` = 7016) AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0');
			$error = '�� ������� ����� '.$itm1x.' ��. ��������� ������!';
			$bonus++;
			if( $bonus < 100 ) {
				$u->addItem( (7017 + rand(0,2)) , $u->info['id'] );
				$error .= ' �� ������ '.$bonus.' ����� � ��������� �������������� ���� &quot;��������� �����&quot;!';
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
    	<h3><center>
    	"������ ���������" (����� �� 8 �����)
    	</center></h3>
    </td>
    <td width="300" align="right">
        <input type="button" class="btn" onClick="location.href='/8mr.php'" value="��������">
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
	<center><b>��������� ������� ������ ����� �������� �������� � ���� ����!</b><br></center><br>
    � ����������� ���� ����� �������� <img src="http://img.likebk.com/i/items/f_pion.gif"> <b>��������� ������</b>, ��� ��������� �������� ��� ����������� ������� 200 ������� �������! �� ������ ������ ��� ������� �� 13 ����� (������������)!
    � ������� ����� ������ <img src="http://img.likebk.com/i/items/f_glad.gif"> <b>������� ������</b>. �� ����� �������� �� <b>��������� ������</b> �� �����: <b>10 ������� �������</b> = <b>1 ��������� ������</b>.<br><br>
    <? if( isset($mybonus['id']) ) { ?>
    <div><b><font color=green>�� ��� ��������� �������, ����� <?=($last+1)?> �����! <? if( $last < 100 ) { echo ' (�� �������� �����)'; } ?></font></b></div>
    <? }else{ ?>
    � ��� <b>��������� �������</b>: <?=$itm1x?> / 200 
    <input type="button" class="btn" onClick="location.href='/8mr.php?action1=1'" value="����� �����"><br>
    � ��� <b>������� �������</b>: <?=$itm2x?> 
    <input type="button" class="btn" onClick="location.href='/8mr.php?action2=1'" value="�������� �� ���������"><br><br>
    <? } ?>
    � �������, �� ���������� �������, �� �������� <img src="http://img.likebk.com/8mrt.png"> <b>������ ��������� ������������ 8 �����</b>! ������ 100 ������� ����������� ������� ������� ������ ���� - ���� �� ���� ��������� <img src="http://img.likebk.com/i/items/venok8m_1.gif"> <img src="http://img.likebk.com/i/items/venok8m_2.gif"> <img src="http://img.likebk.com/i/items/venok8m_3.gif"> <b>���������� �����</b>, ������� ����� ������ ���������� ����� ��� �������� (�������� - �������, ����� - �������)!
	<b><font color=red><? if( $bonus < 100 ) { ?>�������� �������: <?=(100-$bonus)?> ��.<? }else{ echo '������ ����������� :('; } ?></font></b>
    </div>
</center>
</body></html>