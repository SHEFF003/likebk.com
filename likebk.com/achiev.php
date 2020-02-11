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
    	Достижения персонажа
    	</center></h3>
    </td>
    <td width="300" align="right">
        <input type="button" class="btn" onClick="location.href='achiev.php'" value="Обновить">
    	<input type="button" class="btn" onClick="location.href='main.php?inv'" value="Вернуться">
    </td>
  </tr>
</table>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <!-- NEW -->
  <tr>
    <td width="150" align="center" valign="middle">
   	<img style="vertical-align:middle" src="http://img.likebk.com/achiev/a1-<? if( $ar['a1lvl'] < 1 ) { echo 1; }else{ echo $ar['a1lvl']; } ?>.png"></td>
    <td><div> <b>Победа в физических боях</b><br>
    	<?
		$tx = array();
		if( $ar['a1lvl'] == 0 ) {
			$tx[0] = 100;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a1lvl'] == 1 ) {
			$tx[0] = 300;
			$tx[1] = 2000;
			$tx[2] = 20;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a1lvl'] == 2 ) {
			$tx[0] = 500;
			$tx[1] = 3000;
			$tx[2] = 70;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a1lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a1'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
    <td><div> <b>Победы во всех боях</b><br>
    	<?
		$tx = array();
		if( $ar['a2lvl'] == 0 ) {
			$tx[0] = 1000;
			$tx[1] = 100;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a2lvl'] == 1 ) {
			$tx[0] = 10000;
			$tx[1] = 200;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a2lvl'] == 2 ) {
			$tx[0] = 100000;
			$tx[1] = 500;
			$tx[2] = 50;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a2lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a2'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
    <td><div> <b>Накопленные деньги</b><br>
    	<?
		$tx = array();
		if( $ar['a3lvl'] == 0 ) {
			$tx[0] = 10000;
			$tx[1] = 100;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a3lvl'] == 1 ) {
			$tx[0] = 50000;
			$tx[1] = 500;
			$tx[2] = 10;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a3lvl'] == 2 ) {
			$tx[0] = 100000;
			$tx[1] = 1000;
			$tx[2] = 30;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a3lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a3'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
    <td><div> <b>Плавка уникальных рун</b><br>
    	<?
		$tx = array();
		if( $ar['a4lvl'] == 0 ) {
			$tx[0] = 50;
			$tx[1] = 100;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 1; //екр
		}elseif( $ar['a4lvl'] == 1 ) {
			$tx[0] = 100;
			$tx[1] = 500;
			$tx[2] = 10;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 2; //екр
		}elseif( $ar['a4lvl'] == 2 ) {
			$tx[0] = 150;
			$tx[1] = 1000;
			$tx[2] = 30;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 3; //екр
		}elseif( $ar['a4lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a4'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[5] > 0 ) {
				echo $tx[5]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
    <td><div> <b>Убийство пещерных монстров</b><br>
    	<?
		$tx = array();
		if( $ar['a5lvl'] == 0 ) {
			$tx[0] = 1000;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a5lvl'] == 1 ) {
			$tx[0] = 10000;
			$tx[1] = 2000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a5lvl'] == 2 ) {
			$tx[0] = 100000;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a5lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a5'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[5] > 0 ) {
				echo $tx[5]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
    <td><div> <b>Побед в хаотичных боях</b><br>
    	<?
		$tx = array();
		if( $ar['a6lvl'] == 0 ) {
			$tx[0] = 1000;
			$tx[1] = 300;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a6lvl'] == 1 ) {
			$tx[0] = 5000;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a6lvl'] == 2 ) {
			$tx[0] = 10000;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a6lvl'] == 3 ) {
			$tx[0] = -1;
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a6'].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
    <td><div> <b>Сделать подарки другим игрокам</b><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 100;
			$tx[1] = 50;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a7lvl'] == 1 ) {
			$tx[0] = 500;
			$tx[1] = 100;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a7lvl'] == 2 ) {
			$tx[0] = 1000;
			$tx[1] = 300;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
    <td><div> <b>Получить подарки от других игроков</b><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 100;
			$tx[1] = 50;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a8lvl'] == 1 ) {
			$tx[0] = 500;
			$tx[1] = 100;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a8lvl'] == 2 ) {
			$tx[0] = 1000;
			$tx[1] = 300;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
    <td><div> <b>Достичь 200 000 репутации в пещерах</b><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 200000;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 500000;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 1000000;
			$tx[1] = 2000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
    <td><div> <b>Поставить 100 травм противникам</b><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 100;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 200;
			$tx[1] = 750;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 300;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
    <td><div> <b>Достигнуть 1000 побед на Центральной Площади</b><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 1000;
			$tx[1] = 1000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 2500;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 5000;
			$tx[1] = 2000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
		if($ar['a12lvl'] == 0) { $travm = 'лёгкие'; }elseif($ar['a12lvl'] == 1) { $travm = 'средние'; }else{ $travm = 'тяжёлые'; }
	?>
    <td><div> <b>Вылечить <?=$travm?> травмы другим игрокам</b><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 300;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 200;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 100;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
		if($ar['a13lvl'] == 0) { $info = 'Бронзовая медаль<br>(Прокачать питомца до 10-го уровня)' ; }elseif($ar['a13lvl'] == 1) { $info = 'Серебряная медаль<br>(Прокачать питомца до 10-го уровня)' ; }else{ $info = 'Золотая медаль<br>(Прокачать питомца до 10-го уровня)'; }
	?>
    <td><div> <b>Животновод</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 1;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 2;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 3;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
		if($ar['a14lvl'] == 0) { $info = 'Бронзовая медаль<br>(Приобрести личный смайлик)' ; }elseif($ar['a14lvl'] == 1) { $info = 'Серебряная медаль<br>(Приобрести личный смайлик)' ; }else{ $info = 'Золотая медаль<br>(Приобрести личный смайлик)'; }
	?>
    <td><div> <b>Любитель смайлов</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 10;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 20;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 30;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
				if($ar['a15lvl'] == 0) { $info = 'Бронзовая медаль<br>(Приобрести личный образ)'; }elseif ($ar['a15lvl'] == 1) { $info = 'Серебряная медаль<br>(Приобрести личный образ)'; }else{ $info = 'Золотая медаль<br>(Приобрести личный образ)'; }
	?>
    <td><div> <b>Многоликий</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 5;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 10;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 15;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
		if($ar['a16lvl'] == 0) { $info = 'Бронзовая медаль <br>(Убить Повелителя)'; }elseif ($ar['a16lvl'] == 1) { $info = 'Серебряная медаль<br>(Убить Эми Тейли)'; }else{ $info = 'Золотая медаль<br>(Убить Короля Валлуара или Болотного Тролля)'; }
	?>
    <td><div> <b>Убийца боссов</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 100;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 100;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 100;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
		if($ar['a'.$ai.'lvl'] == 0) { $info = 'Бронзовая медаль <br>(Выпить Зелье Мастеров или Воинского Искусства)'; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = 'Серебряная медаль<br>(Выпить Зелье Мастеров или Воинского Искусства)'; }else{ $info = 'Золотая медаль<br>(Выпить Зелье Мастеров или Воинского Искусства)'; }
	?>
    <td><div> <b>Любитель зелий Воинского Искусства</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 50;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 100;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 150;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
		if($ar['a'.$ai.'lvl'] == 0) { $info = 'Бронзовая медаль <br>(Выпить Амброзию Подмастерья Владык)'; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = 'Серебряная медаль<br>(Выпить Амброзию Подмастерья Владык)'; }else{ $info = 'Золотая медаль<br>(Выпить Амброзию Подмастерья Владык)'; }
	?>
    <td><div> <b>Любитель Амброзии</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 50;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 100;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 150;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
		if($ar['a'.$ai.'lvl'] == 0) { $info = 'Бронзовая медаль <br>(Победить в статусной битве)'; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = 'Серебряная медаль<br>(Победить в статусной битве)'; }else{ $info = 'Золотая медаль<br>(Победить в статусной битве)'; }
	?>
    <td><div> <b>Величайший воин</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 10;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 25;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 100;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
		if($ar['a'.$ai.'lvl'] == 0) { $info = 'Бронзовая медаль <br>(Убить персонажа с Светлой склонностью на ЦП)'; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = 'Серебряная медаль<br>(Убить персонажа с Светлой склонностью на ЦП)'; }else{ $info = 'Золотая медаль<br>(Убить персонажа с Светлой склонностью на ЦП)'; }
	?>
    <td><div> <b>Убийца Светлых</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 200;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 500;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 1000;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
		if($ar['a'.$ai.'lvl'] == 0) { $info = 'Бронзовая медаль <br>(Убить персонажа с Тёмной склонностью на ЦП)'; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = 'Серебряная медаль<br>(Убить персонажа с Тёмной склонностью на ЦП)'; }else{ $info = 'Золотая медаль<br>(Убить персонажа с Тёмной склонностью на ЦП)'; }
	?>
    <td><div> <b>Убийца Тёмных</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 200;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 500;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 1000;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
		if($ar['a'.$ai.'lvl'] == 0) { $info = 'Бронзовая медаль <br>(Убить персонажа с Нейтральной склонностью на ЦП)'; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = 'Серебряная медаль<br>(Убить персонажа с Нейтральной склонностью на ЦП)'; }else{ $info = 'Золотая медаль<br>(Убить персонажа с Нейтральной склонностью на ЦП)'; }
	?>
    <td><div> <b>Убийца Нейтралов</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 200;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 500;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 1000;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
		if($ar['a'.$ai.'lvl'] == 0) { $info = 'Бронзовая медаль '; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = 'Серебряная медаль'; }else{ $info = 'Золотая медаль'; }
	?>
    <td><div> <b>Благодарность Админа</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 5;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 10;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 25;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Набрано '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
		if($ar['a'.$ai.'lvl'] == 0) { $info = 'Бронзовая медаль<br>(Провести 90 дней на Светлой стороне) '; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = 'Серебряная медаль<br>(Провести 180 дней на Светлой стороне)'; }else{ $info = 'Золотая медаль<br>(Провести 360 дней на Светлой стороне)'; }
	?>
    <td><div> <b>Преданность Свету</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 90; // 3месяца(90 дней)
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 180; //6месяцев(180 дней)
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 360; //12 месяцев(360 дней)
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Осталось дней '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
		if($ar['a'.$ai.'lvl'] == 0) { $info = 'Бронзовая медаль<br>(Провести 90 дней на Тёмной стороне) '; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = 'Серебряная медаль<br>(Провести 180 дней на Тёмной стороне)'; }else{ $info = 'Золотая медаль<br>(Провести 360 дней на Тёмной стороне)'; }
	?>
    <td><div> <b>Преданность Тьме</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 90; // 3месяца(90 дней)
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 180; //6месяцев(180 дней)
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 360; //12 месяцев(360 дней)
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Осталось дней '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
		if($ar['a'.$ai.'lvl'] == 0) { $info = 'Бронзовая медаль<br>(Провести 90 дней на Нейтральной стороне) '; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = 'Серебряная медаль<br>(Провести 180 дней на Нейтральной стороне)'; }else{ $info = 'Золотая медаль<br>(Провести 360 дней на Нейтральной стороне)'; }
	?>
    <td><div> <b>Преданность Нейтралитету</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 90; // 3месяца(90 дней)
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 180; //6месяцев(180 дней)
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 360; //12 месяцев(360 дней)
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Осталось  '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
		if($ar['a'.$ai.'lvl'] == 0) { $info = 'Бронзовая медаль<br>(Получить молчанки)'; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = 'Серебряная медаль<br>(Получить молчанки)'; }else{ $info = 'Золотая медаль<br>(Получить молчанки)'; }
	?>
    <td><div> <b>Хулиган</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 25;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 50;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 100;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Осталось '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
		if($ar['a'.$ai.'lvl'] == 0) { $info = 'Бронзовая медаль<br>(Получить Хаос)'; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = 'Серебряная медаль<br>(Получить Хаос)'; }else{ $info = 'Золотая медаль<br>(Получить Хаос)'; }
	?>
    <td><div> <b>Злостный нарушитель</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 5;
			$tx[1] = 500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 10;
			$tx[1] = 1500;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 15;
			$tx[1] = 3000;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Осталось '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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
		if($ar['a'.$ai.'lvl'] == 0) { $info = 'Бронзовая медаль<br>(10000 репутации ХИП) '; }elseif ($ar['a'.$ai.'lvl'] == 1) { $info = 'Серебряная медаль<br>(25000 репутации ХИП)'; }else{ $info = 'Золотая медаль<br>(50000 репутации ХИП)'; }
	?>
    <td><div> <b>Любитель Хижины Искателей Приключений</b><br><i><small><?=$info?></small></i><br>
    	<?
		$tx = array();
		if( $ar['a'.$ai.'lvl'] == 0 ) {
			$tx[0] = 10000; // 3месяца(90 дней)
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 1 ) {
			$tx[0] = 25000; //6месяцев(180 дней)
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}elseif( $ar['a'.$ai.'lvl'] == 2 ) {
			$tx[0] = 50000; //12 месяцев(360 дней)
			$tx[1] = 0;
			$tx[2] = 0;
			$tx[3] = 0; //голд
			$tx[4] = 0; //статы
			$tx[5] = 0; //екр
		}else{
			$tx[0] = -1;
		}
		if( $tx[0] == -1 ) {
			echo '<font color=green>Вы достигли максимального уровня в этом достижении!</font>';
		}else{
			echo 'Осталось '.$ar['a'.$ai.''].'/'.$tx[0].' для достижения следующего уровня!<br><b>Награда за следующий уровень:</b> ';
			if( $tx[1] > 0 ) {
				echo $tx[1]. ' кр., ';
			}
			if( $tx[3] > 0 ) {
				echo $tx[1]. ' екр., ';
			}
			if( $tx[2] > 0 ) {
				echo $tx[2]. ' HP, ';
			}
			echo ' значок.';
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