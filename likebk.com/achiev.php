<?php

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__magic.php');
include('_incl_data/class/__user.php');

if(!isset($u->info['id'])) {
	header('location: main.php');
	die();
}

$ar = mysql_fetch_array(mysql_query('SELECT * FROM `achiev` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
if(!isset($ar['id'])) {
	mysql_query('INSERT INTO `achiev` (`uid`) VALUES ("'.$u->info['id'].'")');
	$ar = mysql_fetch_array(mysql_query('SELECT * FROM `achiev` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
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
    	���������� ���������
    	</center></h3>
    </td>
    <td width="300" align="right">
        <input type="button" class="btn" onClick="location.href='achiev.php'" value="��������">
    	<input type="button" class="btn" onClick="location.href='main.php?inv'" value="���������">
    </td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <!-- NEW -->
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a1-<? if( $ar['a1lvl'] < 1 ) { echo 1; }else{ echo $ar['a1lvl']; } ?>.png"></td>
    <td><div> <b>������ � ���������� ����</b><br>
    	<?
		$tx = array();
		if( $ar['a1lvl'] == 0 ) {
			$tx[0] = 100;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a1lvl'] == 1 ) {
			$tx[0] = 300;
			$tx[1] = 2000;
			$tx[2] = 20;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a1lvl'] == 2 ) {
			$tx[0] = 500;
			$tx[1] = 3000;
			$tx[2] = 70;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a1lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a1'].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a1']-$ar['a1l'])/($tx[0]-$ar['a1l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a1']-$ar['a1l'])/($tx[0]-$ar['a1l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <!-- NEW -->
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a2-<? if( $ar['a2lvl'] < 1 ) { echo 1; }else{ echo $ar['a2lvl']; } ?>.png"></td>
    <td><div> <b>������ �� ���� ����</b><br>
    	<?
		$tx = array();
		if( $ar['a2lvl'] == 0 ) {
			$tx[0] = 1000;
			$tx[1] = 100;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a2lvl'] == 1 ) {
			$tx[0] = 10000;
			$tx[1] = 200;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a2lvl'] == 2 ) {
			$tx[0] = 100000;
			$tx[1] = 500;
			$tx[2] = 50;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a2lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a2'].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a2']-$ar['a2l'])/($tx[0]-$ar['a2l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a2']-$ar['a2l'])/($tx[0]-$ar['a2l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <!-- NEW -->
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a3-<? if( $ar['a3lvl'] < 1 ) { echo 1; }else{ echo $ar['a3lvl']; } ?>.png"></td>
    <td><div> <b>����������� ������</b><br>
    	<?
		$tx = array();
		if( $ar['a3lvl'] == 0 ) {
			$tx[0] = 10000;
			$tx[1] = 100;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a3lvl'] == 1 ) {
			$tx[0] = 50000;
			$tx[1] = 500;
			$tx[2] = 10;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a3lvl'] == 2 ) {
			$tx[0] = 100000;
			$tx[1] = 1000;
			$tx[2] = 30;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a3lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a3'].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a3']-$ar['a3l'])/($tx[0]-$ar['a3l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a3']-$ar['a3l'])/($tx[0]-$ar['a3l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <!-- NEW -->
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a4-<? if( $ar['a4lvl'] < 1 ) { echo 1; }else{ echo $ar['a4lvl']; } ?>.png"></td>
    <td><div> <b>������ ���������� ���</b><br>
    	<?
		$tx = array();
		if( $ar['a4lvl'] == 0 ) {
			$tx[0] = 50;
			$tx[1] = 100;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 1; //���
		}elseif( $ar['a4lvl'] == 1 ) {
			$tx[0] = 100;
			$tx[1] = 500;
			$tx[2] = 10;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 2; //���
		}elseif( $ar['a4lvl'] == 2 ) {
			$tx[0] = 150;
			$tx[1] = 1000;
			$tx[2] = 30;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 3; //���
		}elseif( $ar['a4lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a4'].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[5] > 0 ) {
				echo $tx[5]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a4']-$ar['a4l'])/($tx[0]-$ar['a4l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a4']-$ar['a4l'])/($tx[0]-$ar['a4l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <!-- NEW -->
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a5-<? if( $ar['a5lvl'] < 1 ) { echo 1; }else{ echo $ar['a5lvl']; } ?>.png"></td>
    <td><div> <b>�������� �������� ��������</b><br>
    	<?
		$tx = array();
		if( $ar['a5lvl'] == 0 ) {
			$tx[0] = 1000;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a5lvl'] == 1 ) {
			$tx[0] = 10000;
			$tx[1] = 2000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a5lvl'] == 2 ) {
			$tx[0] = 100000;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a5lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a5'].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[5] > 0 ) {
				echo $tx[5]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a5']-$ar['a5l'])/($tx[0]-$ar['a5l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a5']-$ar['a5l'])/($tx[0]-$ar['a5l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <!-- NEW -->
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a6-<? if( $ar['a6lvl'] < 1 ) { echo 1; }else{ echo $ar['a6lvl']; } ?>.png"></td>
    <td><div> <b>����� � ��������� ����</b><br>
    	<?
		$tx = array();
		if( $ar['a6lvl'] == 0 ) {
			$tx[0] = 1000;
			$tx[1] = 300;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a6lvl'] == 1 ) {
			$tx[0] = 5000;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a6lvl'] == 2 ) {
			$tx[0] = 10000;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a6lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a6'].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a6']-$ar['a6l'])/($tx[0]-$ar['a6l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a6']-$ar['a6l'])/($tx[0]-$ar['a6l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <!-- NEW -->
  <? if( $u->info['id'] > 0 ) { ?>
  <? $ai = 7; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
    <td><div> <b>������� ������� ������ �������</b><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 100;
			$tx[1] = 50;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a7lvl'] == 1 ) {
			$tx[0] = 500;
			$tx[1] = 100;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a7lvl'] == 2 ) {
			$tx[0] = 1000;
			$tx[1] = 300;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <!-- NEW -->
  <? $ai = 8; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
    <td><div> <b>�������� ������� �� ������ �������</b><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 100;
			$tx[1] = 50;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a8lvl'] == 1 ) {
			$tx[0] = 500;
			$tx[1] = 100;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a8lvl'] == 2 ) {
			$tx[0] = 1000;
			$tx[1] = 300;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <!-- NEW -->
  <? $ai = 9; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
    <td><div> <b>������� 200 000 ��������� � �������</b><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 200000;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 500000;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 1000000;
			$tx[1] = 2000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <!-- NEW -->
  <? $ai = 10; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
    <td><div> <b>��������� 100 ����� �����������</b><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 100;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 200;
			$tx[1] = 750;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 300;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <!-- NEW -->
  <? $ai = 11; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
    <td><div> <b>���������� 1000 ����� �� ����������� �������</b><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 1000;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 2500;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 5000;
			$tx[1] = 2000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
         <?}?>
	<? $ai = 12; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
		if($ar['a12lvl'] == 0) { $travm = '�����'; }elseif($ar['a12lvl'] == 1) { $travm = '�������'; }else{ $travm = '������'; }
	?>
    <td><div> <b>�������� <?=$travm?> ������ ������ �������</b><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 300;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 200;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 100;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?}?>
	<? $ai = 13; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
		if($ar['a13lvl'] == 0) { $info = '��������� ������<br>(��������� ������� �� 10-�� ������)' ; }elseif($ar['a13lvl'] == 1) { $info = '���������� ������<br>(��������� ������� �� 10-�� ������)' ; }else{ $info = '������� ������<br>(��������� ������� �� 10-�� ������)'; }
	?>
    <td><div> <b>����������</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 1;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 2;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 3;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
		<? $ai = 14; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
		if($ar['a14lvl'] == 0) { $info = '��������� ������<br>(���������� ������ �������)' ; }elseif($ar['a14lvl'] == 1) { $info = '���������� ������<br>(���������� ������ �������)' ; }else{ $info = '������� ������<br>(���������� ������ �������)'; }
	?>
    <td><div> <b>�������� �������</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 10;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 20;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 30;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
		<? $ai = 15; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
				if($ar['a15lvl'] == 0) { $info = '��������� ������<br>(���������� ������ �����)'; }elseif ($ar['a15lvl'] == 1) { $info = '���������� ������<br>(���������� ������ �����)'; }else{ $info = '������� ������<br>(���������� ������ �����)'; }
	?>
    <td><div> <b>����������</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 5;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 10;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 15;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
	<? $ai = 16; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
		if($ar['a16lvl'] == 0) { $info = '��������� ������ <br>(����� ����������)'; }elseif ($ar['a16lvl'] == 1) { $info = '���������� ������<br>(����� ��� �����)'; }else{ $info = '������� ������<br>(����� ������ �������� ��� ��������� ������)'; }
	?>
    <td><div> <b>������ ������</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 100;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 100;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 100;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
		<? $ai = 17; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
		if($ar['a'.$ai.'lvl'] == 0) { $info = '��������� ������ <br>(������ ����� �������� ��� ��������� ���������)'; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = '���������� ������<br>(������ ����� �������� ��� ��������� ���������)'; }else{ $info = '������� ������<br>(������ ����� �������� ��� ��������� ���������)'; }
	?>
    <td><div> <b>�������� ����� ��������� ���������</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 50;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 100;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 150;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
		<? $ai = 18; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
		if($ar['a'.$ai.'lvl'] == 0) { $info = '��������� ������ <br>(������ �������� ����������� ������)'; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = '���������� ������<br>(������ �������� ����������� ������)'; }else{ $info = '������� ������<br>(������ �������� ����������� ������)'; }
	?>
    <td><div> <b>�������� ��������</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 50;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 100;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 150;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
		<? $ai = 19; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
		if($ar['a'.$ai.'lvl'] == 0) { $info = '��������� ������ <br>(�������� � ��������� �����)'; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = '���������� ������<br>(�������� � ��������� �����)'; }else{ $info = '������� ������<br>(�������� � ��������� �����)'; }
	?>
    <td><div> <b>���������� ����</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 10;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 25;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 100;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
		<? $ai = 20; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
		if($ar['a'.$ai.'lvl'] == 0) { $info = '��������� ������ <br>(����� ��������� � ������� ����������� �� ��)'; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = '���������� ������<br>(����� ��������� � ������� ����������� �� ��)'; }else{ $info = '������� ������<br>(����� ��������� � ������� ����������� �� ��)'; }
	?>
    <td><div> <b>������ �������</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 200;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 500;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 1000;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
		<? $ai = 21; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
		if($ar['a'.$ai.'lvl'] == 0) { $info = '��������� ������ <br>(����� ��������� � Ҹ���� ����������� �� ��)'; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = '���������� ������<br>(����� ��������� � Ҹ���� ����������� �� ��)'; }else{ $info = '������� ������<br>(����� ��������� � Ҹ���� ����������� �� ��)'; }
	?>
    <td><div> <b>������ Ҹ����</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 200;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 500;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 1000;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
		<? $ai = 22; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
		if($ar['a'.$ai.'lvl'] == 0) { $info = '��������� ������ <br>(����� ��������� � ����������� ����������� �� ��)'; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = '���������� ������<br>(����� ��������� � ����������� ����������� �� ��)'; }else{ $info = '������� ������<br>(����� ��������� � ����������� ����������� �� ��)'; }
	?>
    <td><div> <b>������ ���������</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 200;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 500;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 1000;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
		<? /*$ai = 23; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
		if($ar['a'.$ai.'lvl'] == 0) { $info = '��������� ������ '; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = '���������� ������'; }else{ $info = '������� ������'; }
	?>
    <td><div> <b>������������� ������</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 5;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 10;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 25;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <? }*/?>
		<? $ai = 24; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
		if($ar['a'.$ai.'lvl'] == 0) { $info = '��������� ������<br>(�������� 90 ���� �� ������� �������) '; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = '���������� ������<br>(�������� 180 ���� �� ������� �������)'; }else{ $info = '������� ������<br>(�������� 360 ���� �� ������� �������)'; }
	?>
    <td><div> <b>����������� �����</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 90; // 3������(90 ����)
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 180; //6�������(180 ����)
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 360; //12 �������(360 ����)
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '�������� ���� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
		<? $ai = 25; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
		if($ar['a'.$ai.'lvl'] == 0) { $info = '��������� ������<br>(�������� 90 ���� �� Ҹ���� �������) '; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = '���������� ������<br>(�������� 180 ���� �� Ҹ���� �������)'; }else{ $info = '������� ������<br>(�������� 360 ���� �� Ҹ���� �������)'; }
	?>
    <td><div> <b>����������� ����</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 90; // 3������(90 ����)
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 180; //6�������(180 ����)
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 360; //12 �������(360 ����)
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '�������� ���� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
		<? $ai = 26; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
		if($ar['a'.$ai.'lvl'] == 0) { $info = '��������� ������<br>(�������� 90 ���� �� ����������� �������) '; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = '���������� ������<br>(�������� 180 ���� �� ����������� �������)'; }else{ $info = '������� ������<br>(�������� 360 ���� �� ����������� �������)'; }
	?>
    <td><div> <b>����������� ������������</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 90; // 3������(90 ����)
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 180; //6�������(180 ����)
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 360; //12 �������(360 ����)
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '��������  '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
		<? /*$ai = 27; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
		if($ar['a'.$ai.'lvl'] == 0) { $info = '��������� ������<br>(�������� ��������)'; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = '���������� ������<br>(�������� ��������)'; }else{ $info = '������� ������<br>(�������� ��������)'; }
	?>
    <td><div> <b>�������</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 25;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 50;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 100;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '�������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
		<? $ai = 28; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
		if($ar['a'.$ai.'lvl'] == 0) { $info = '��������� ������<br>(�������� ����)'; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = '���������� ������<br>(�������� ����)'; }else{ $info = '������� ������<br>(�������� ����)'; }
	?>
    <td><div> <b>�������� ����������</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 5;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 10;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 15;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '�������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}*/
		?>
        
		<? $ai = 29; ?>
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a<?=''.$ai.''?>-<? if( $ar['a'.$ai.'lvl'] < 1 ) { echo 1; }else{ echo $ar['a'.$ai.'lvl']; } ?>.png"></td>
	<?
		if($ar['a'.$ai.'lvl'] == 0) { $info = '��������� ������<br>(10000 ��������� ���) '; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = '���������� ������<br>(25000 ��������� ���)'; }else{ $info = '������� ������<br>(50000 ��������� ���)'; }
	?>
    <td><div> <b>�������� ������ ��������� �����������</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 10000; // 3������(90 ����)
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 25000; //6�������(180 ����)
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 50000; //12 �������(360 ����)
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //����
			$tx[4] = 0; //�����
			$tx[5] = 0; //���
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>�� �������� ������������� ������ � ���� ����������!</font>';
		}else{
			echo '�������� '.$ar['a'.$ai.''].'/'.$tx[0].' ��� ���������� ���������� ������!<br><b>������� �� ��������� �������:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' ��., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' ���., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' ������.';
			?>
        <div style="display:inline-block;text-align:left;width:100%;height:20px;border:1px solid grey;">
          <div style="display:inline-block;width:<? if( floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100) > 100 ) { echo 100; }else{ echo floor(($ar['a'.$ai.'']-$ar['a'.$ai.'l'])/($tx[0]-$ar['a'.$ai.'l'])*100); }?>%;height:20px;background-color:green;">&nbsp;</div>
        </div>
            <?
		}
		?>
		
    </div><hr></td>
    <td width="300" align="right">&nbsp;</td>
  </tr>
  <!-- NEW -->
  <? } ?>
</table>
</body></html>