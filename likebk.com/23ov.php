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
			$error = 'Неудалось обменять, недостаточно Обычных Трофеев. Необходимо 10 шт.';
		}else{
			mysql_query('DELETE FROM `items_users` WHERE `item_id` = 7004 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 LIMIT ' . ($ob*10));
			$i = 0;
			while( $i < $ob ) {
				$u->addItem( 7005 , $u->info['id'] );
				$itm1x += 1;
				$i++;
			}
			$itm2x -= $ob*10;
			$error = 'Вы успешно обменяли Обычные Трофеи на '.$ob.' шт. Кровавых Трофеев!';
		}
	}elseif(isset($_GET['action1'])) {	
		if( $itm1x < 200 ) {
			$error = 'Недостаточно Кровавых Трофеев! Необходимо собрать 200 шт.!';
		}else{
			$itm2x++;
			mysql_query('INSERT INTO `23quest` (`uid`,`time`) VALUES ("'.$u->info['id'].'","'.( time() + 86400 * 345 ).'")');
			mysql_query('DELETE FROM `items_users` WHERE (`item_id` = 7004 OR `item_id` = 7005) AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0');
			$error = 'Вы успешно сдали '.$itm1x.' шт. Кровавых Трофеев!';
			$bonus++;
			if( $bonus < 200 ) {
				$u->addItem( 7006 , $u->info['id'] );
				$error .= ' Вы заняли '.$bonus.' место и получаете дополнительный приз &quot;Плащ Защитника ЛайкБК&quot;!';
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
    	<h3><center>"Прорыв Общего Врага" (Квест на 23 февраля)</center></h3>
    </td>
    <td width="300" align="right">
        <input type="button" class="btn" onClick="location.href='/23ov.php'" value="Обновить">
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
	<center><b>Общий Враг открыл портал чтобы провести свой легион хаоса в этот мир!</b><br></center><br>
    В хаотических боях стали выпадать <img src="http://img.likebk.com/i/items/trofi2.gif"> <b>Кровавые Трофеи</b>, для закрытия портала и защиты нашего мира вам потребуется собрать 200 Кровавых Трофеев! Вы должны успеть это сделать до 28 февраля (включительно)!
    В пещерах также падают <img src="http://img.likebk.com/i/items/trofi1.gif"> <b>Обычные Трофеи</b>. Их можно обменять на <b>Кровавые Трофеи</b> по курсу: <b>10 Обычных Трофеев</b> = <b>1 Кровавый Трофей</b>.<br><br>
    <? if( isset($mybonus['id']) ) { ?>
    <div><b><font color=green>Вы уже завершили задание, заняв <?=($last+1)?> место! <? if( $last < 200 ) { echo ' (Вы получили плащ)'; } ?></font></b></div>
    <? }else{ ?>
    У вас <b>Кровавых Трофеев</b>: <?=$itm1x?> / 200 <input type="button" class="btn" onClick="location.href='/23ov.php?action1=1'" value="Сдать трофеи"><br>
    У вас <b>Обычных Трофеев</b>: <?=$itm2x?> <input type="button" class="btn" onClick="location.href='/23ov.php?action2=1'" value="Обменять на Кровавые"><br><br>
    <? } ?>
    В награду, за выполнение задания, вы получите <img src="http://img.likebk.com/i/defender.gif"> <b>Значок Защитника ЛайкБК</b>! Первые 200 игроков завершивших задание получат ценный приз - <img src="http://img.likebk.com/i/items/23ck.gif"> <b>Плащ Защитника ЛайкБК</b>!
	<b><font color=red><? if( $bonus < 200 ) { ?>Осталось плащей: <?=(200-$bonus)?> шт.<? }else{ echo 'Плащи Защитника ЛайкБК закончились :('; } ?></font></b>
    </div>
</center>
</body></html>