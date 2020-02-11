<?php
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__magic.php');
include('_incl_data/class/__user.php');

if( $u->info['admin'] == 0 ) {
	if( date('m') != 4 || date('d') > 5 ) {
		die();
	}
}

if(!isset($u->info['id']) || $u->info['room'] != 9) {
	if( $u->info['admin'] == 0 ) {
		header('location: main.php');
		die();
	}
}

$itm1x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 7021 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 LIMIT 1'));
$itm1x = $itm1x[0];

$itm2x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 7022 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 LIMIT 1'));
$itm2x = $itm2x[0];

$bonus = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `1quest` WHERE `time` > "'.time().'" LIMIT 1'));
$bonus = $bonus[0];

$mybonus = mysql_fetch_array(mysql_query('SELECT * FROM `1quest` WHERE `time` > "'.time().'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
$last = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `1quest` WHERE `id` < "'.$mybonus['id'].'" LIMIT 1'));
$last = $last[0];

if( !isset($mybonus['id']) ) {
	if(isset($_GET['action2'])) {
		$ob = floor( $itm2x / 10 );	
		if( $ob < 1 ) {
			$error = 'Неудалось обменять, недостаточно Вставных челюстей. Необходимо 10 шт.';
		}else{
			mysql_query('DELETE FROM `items_users` WHERE `item_id` = 7022 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 LIMIT ' . ($ob*10));
			$i = 0;
			while( $i < $ob ) {
				$u->addItem( 7021 , $u->info['id'] );
				$itm1x += 1;
				$i++;
			}
			$itm2x -= $ob*10;
			$error = 'Вы успешно обменяли Вставные челюсти на '.$ob.' шт. Бород!';
		}
	}elseif(isset($_GET['action1'])) {	
		if( $itm1x < 200 ) {
			$error = 'Недостаточно Бород! Необходимо собрать 200 шт.!';
		}else{
			$itm2x++;
			mysql_query('INSERT INTO `1quest` (`uid`,`time`) VALUES ("'.$u->info['id'].'","'.( time() + 86400 * 345 ).'")');
			mysql_query('DELETE FROM `items_users` WHERE (`item_id` = 7022 OR `item_id` = 7021) AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0');
			$error = 'Вы успешно сдали '.$itm1x.' шт. Бород!';
			$bonus++;
			if( $bonus < 100 ) {
				$u->addItem( 7024 , $u->info['id'] );
				$error .= ' Вы заняли '.$bonus.' место и получаете дополнительный приз!';
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
    	"Портал Рауля" (Квест на 1 апреля)
    	</center></h3>
    </td>
    <td width="300" align="right">
        <input type="button" class="btn" onClick="location.href='/1ap.php'" value="Обновить">
    	<input type="button" class="btn" onClick="location.href='main.php'" value="Вернуться">
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
	<center><b>Хомяк Рауль открыл портал чтобы разыграть всех в этом мире!</b><br></center><br>
    В хаотических боях стали выпадать <img src="http://img.likebk.com/i/items/suven_1apr_11_2012.gif"> <b>Борода</b>, для получения подарков вам потребуется собрать 200 бород! Вы должны успеть это сделать до 5 апреля (включительно)!
    В пещерах также падают <img src="http://img.likebk.com/i/items/suven_1stapril_13_2011.gif"> <b>Вставная челюсть</b>. Их можно обменять на <b>Бороду</b> по курсу: <b>10 Вставных челюстей</b> = <b>1 Борода</b>.<br><br>
    <? if( isset($mybonus['id']) ) { ?>
    <div><b><font color=green>Вы уже завершили задание, заняв <?=($last+1)?> место! <? if( $last < 100 ) { echo ' (Вы получили венок)'; } ?></font></b></div>
    <? }else{ ?>
    У вас <b>Борода</b>: <?=$itm1x?> / 200 
    <input type="button" class="btn" onClick="location.href='/1ap.php?action1=1'" value="Сдать"><br>
    У вас <b>Вставная челюсть</b>: <?=$itm2x?> 
    <input type="button" class="btn" onClick="location.href='/1ap.php?action2=1'" value="Обменять"><br><br>
    <? } ?>
    В награду, за выполнение задания, вы получите <img src="http://img.likebk.com/massfun.gif"> <b>Значок Участника Празднования 1 Апреля</b>! Первые 100 игроков завершивших задание получат ценный  <b>Приз</b>, который будет давать уникальный образ при одевании (господам - мужской, дамам - женский)!
	<b><font color=red><? if( $bonus < 100 ) { ?>Осталось бонусов: <?=(100-$bonus)?> шт.<? }else{ echo 'Бонусы закончились :('; } ?></font></b>
    </div>
</center>
</body></html>