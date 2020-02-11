<?php

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__magic.php');
include('_incl_data/class/__user.php');

if(isset($_GET['testback'])) {
	$sp = mysql_query('SELECT * FROM `stella_u` WHERE `uid` IN (SELECT `id` FROM `stats` WHERE `exp` < 300000)');
	while( $pl = mysql_fetch_array($sp) ) {
		$gl = mysql_fetch_array(mysql_query('SELECT * FROM `stella` WHERE `id` = "'.$pl['sid'].'" LIMIT 1'));
		echo '<br>['.$u->microLogin($pl['uid'],1).' -> '.$gl['name'].' -> '.$u->microLogin($gl['uid'.$pl['chose']],1).']';
		//$gl['gl'.$pl['chose']]++;
		//mysql_query('UPDATE `stella` SET `gl1` = "'.$gl['gl1'].'" , `gl2` = "'.$gl['gl2'].'" , `gl3` = "'.$gl['gl3'].'" WHERE `id` = "'.$gl['id'].'" LIMIT 1');
		$usrs[$gl['uid'.$pl['chose']]]++;
	}
	echo '<hr>';
	print_r($usrs);
	die();
}

if(isset($_GET['winner']) && $u->info['admin'] > 0) {
	echo 'winner -> ';
	$sp = mysql_query('SELECT * FROM `stella` ORDER BY `time_finish` ASC');
	$yyy = date('Y')-1;
	while( $pl = mysql_fetch_array($sp) ) {
		if( $pl['winner'] == 0 ) {
			if( $pl['gl1'] > $pl['gl2'] && $pl['gl1'] > $pl['gl3'] ) {
				$pl['winner'] = $pl['uid1'];
			}elseif( $pl['gl1'] > $pl['gl2'] && $pl['gl1'] > $pl['gl3'] ) {
				$pl['winner'] = $pl['uid2'];
			}elseif( $pl['gl1'] > $pl['gl2'] && $pl['gl1'] > $pl['gl3'] ) {
				$pl['winner'] = $pl['uid3'];
			}
			mysql_query('UPDATE `stella` SET `winner` = "'.$pl['winner'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}else{
			if( $pl['clan'] > 0 ) {
				$cln = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$pl['winner'].'" LIMIT 1'));
				echo '<br><b>'.$pl['name'].':</b><br><b><img src="http://img.likebk.com/i/clan/'.$cln['id'].'.gif"> '.$cln['name'].'</b><br>';
			}else{
				mysql_query('DELETE FROM `users_ico` WHERE `text` LIKE "%'.$pl['name'].'%'.$yyy.'%" AND `uid` = "'.$pl['winner'].'"');
				mysql_query('INSERT INTO `users_ico` (`type`,`uid`,`text`,`img`,`time`) VALUES ("1","'.$pl['winner'].'","<b>'.$pl['name'].'</b> `'.$yyy.'","god/'.($pl['id']-1).'.png","'.time().'")');
				echo '<b>'.$pl['name'].':</b><br>'.$u->microLogin($pl['winner'],1).'<br>';
			}
		}
	}
	die();
}

if(isset($_GET['upd'])) {
	$txt = '
+
Лучший воин
A N U B I S
Middle Finger
Flaming Phoenix
+
Лучший маг
Wolf from Minnesota
NightMarE
SuNCHaSeR
+
Лучший светлый игрок
Scorpion
Wolverine
K O N G
+
Лучший темный игрок
FENOMEN
A N U B I S
Alps
+
Лучший нейтральный игрок
Волкодав
Благодать
Wade_Winstone_Wilson
+
Лучший диггер
FENOMEN
Flaming Phoenix
Дарс
+
Любимчик чата
КАБАНИЧ
Ёжик
Wade_Winstone_Wilson
+
Лучший паладин
Harley_Quinn
Джесси Пинкман
Чик-Брык
+
Лучший DJ радио
Благодать
lota
Jet0n
+
Клешня года
Невидим
St Versus
Romantic Kiss
+
Лучший клан
JCP
Immortals
TLS
+
Лучший глава клана
A N U B I S
КАРДИНАЛ
SuNCHaSeR
+
Прорыв года
Генерал Алкоголь
Alps
nr 1
+
Торговец года
Личность
Ангель_Хранитель
FENOMEN';

	$txt = explode("\n",$txt);
	print_r($txt);
	
	//Обнуление стеллы
	if(isset($_GET['clearstella']) && $u->info['admin'] > 0) {
		mysql_query('UPDATE `stella` SET `gl1` = 0 , `gl2` = 0 , `gl3` = 0 , `uid1` = 0 , `uid2` = 0 , `uid3` = 0');
	}
	
	$i = 1; $j = 1;
	while( $i < count($txt) ) {
		if( $txt[$i] == '+' && $j != 0 ) {
			$j = 0;
		}elseif($j != 1) {
			$j = $txt[$i];
			$jpl = mysql_fetch_array(mysql_query('SELECT * FROM `stella` WHERE `name` = "'.$j.'" LIMIT 1'));
			$jpx = 0;
			echo '<br><br><b>'.$j.'</b>';
			$j = 1;
		}else{
			$jpx++;
			if( $jpl['name'] == 'Лучший клан' ) {
				$txt[$i] = rtrim($txt[$i],' ');
				$txt[$i] = ltrim($txt[$i],' ');
				$usr = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `clan` WHERE `name` = "'.mysql_real_escape_string($txt[$i]).'" LIMIT 1'));
				if(isset($usr['id'])) {
					mysql_query('UPDATE `stella` SET `uid'.$jpx.'` = "'.$usr['id'].'" WHERE `id` = "'.$jpl['id'].'" LIMIT 1');
					echo '<br><b style="color:green">Клан: '.$usr['name'].' ('.$usr['id'].')</b>';
				}else{
					echo '<br><u style="color:red">Клан: '.$txt[$i].'</u>';
				}
			}else{
				$txt[$i] = rtrim($txt[$i],' ');
				$txt[$i] = ltrim($txt[$i],' ');
				$usr = mysql_fetch_array(mysql_query('SELECT `id`,`login` FROM `users` WHERE `login` = "'.mysql_real_escape_string($txt[$i]).'" LIMIT 1'));
				if(isset($usr['id'])) {
					mysql_query('UPDATE `stella` SET `uid'.$jpx.'` = "'.$usr['id'].'" WHERE `id` = "'.$jpl['id'].'" LIMIT 1');
					echo '<br><b style="color:green">'.$usr['login'].' ['.$usr['id'].']</b>';
				}else{
					echo '<br><u style="color:red">'.$txt[$i].'</u>';
				}
			}
		}
		$i++;	
	}

	die();
}

if(!isset($u->info['id']) || $u->info['room'] != 9) {
	header('location: main.php');
	die();
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
    	<h3><center>Стелла Голосований</center></h3>
    </td>
    <td width="300" align="right">
        <input type="button" class="btn" onClick="location.href='stella.php'" value="Обновить">
    	<input type="button" class="btn" onClick="location.href='main.php'" value="Вернуться">
    </td>
  </tr>
</table>
<br>

<?
$i = 0;
$sp = mysql_query('SELECT * FROM `stella` ORDER BY `time_finish` ASC');
while( $pl = mysql_fetch_array($sp) ) {
	$gls = mysql_fetch_array(mysql_query('SELECT * FROM `stella_u` WHERE `sid` = "'.$pl['id'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
	if(isset($_GET['sid']) && $_GET['sid'] == $pl['id']) {
		if( $u->info['exp'] < 300000 ) {
			echo '<div><font color=red><b>Для голосования вам необходимо набрать еще '.(300000-$u->info['exp']).' опыта!</b></font></div>';
		}elseif( true == true ) {
			echo '<div><font color=red><b>Голосование закрыто!</b></font></div>';
		}elseif(isset($gls['id'])) {
			echo '<div><font color=red><b>Вы уже голосовали здесь!</b></font></div>';
		}else{
			$chose = 1;
			if( isset($_GET['uid2']) ) {
				$chose = 2;	
			}elseif( isset($_GET['uid3']) ) {
				$chose = 3;	
			}
			$pl['gl'.$chose]++;
			mysql_query('UPDATE `stella` SET `gl1` = "'.$pl['gl1'].'" , `gl2` = "'.$pl['gl2'].'" , `gl3` = "'.$pl['gl3'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
			mysql_query('INSERT INTO `stella_u` (`uid`,`time`,`sid`,`chose`) VALUES ("'.$u->info['id'].'","'.time().'","'.$pl['id'].'","'.$chose.'")');
			$gls = mysql_fetch_array(mysql_query('SELECT * FROM `stella_u` WHERE `sid` = "" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
			echo '<div><font color=green><b>Вы успешно проголосовали!</b></font></div>';
		}
	}
	$i++;
	echo $i . '. <b>'.$pl['name'].'</b> ('.$pl['title'].')';
	echo '<br>Вы еще не голосовали за эту номинацию, выберите кандидата: <br>';
	//
	if( $pl['uid1'] > 0 ) {
		if( $pl['clan'] == 1 ) {
			$cln0 = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `clan` WHERE `id` = "'.$pl['uid1'].'" LIMIT 1'));
			echo '<br> <img src="http://img.likebk.com/i/clan/'.$cln0['id'].'.gif"> <b>'.$cln0['name'].'</b> (Голосов: '.$pl['gl1'].' , '.round($pl['gl1']/($pl['gl1']+$pl['gl2']+$pl['gl3'])*100,2).'%) ';
		}else{
			echo '<br>'.$u->microLogin($pl['uid1'],1).' (Голосов: '.$pl['gl1'].' , '.round($pl['gl1']/($pl['gl1']+$pl['gl2']+$pl['gl3'])*100,2).'%) ';
		}
		if(isset($gls['id'])) {
			if( $gls['chose'] == 1 ) {
				echo '<font color=blue><b>Ваш голос!</b></font>';
			}
		}else{
			echo '<button onclick="location.href=\'stella.php?sid='.$pl['id'].'&uid1\'">Голосовать</button>';
		}
	}
	if( $pl['uid2'] > 0 ) {
		if( $pl['clan'] == 1 ) {
			$cln0 = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `clan` WHERE `id` = "'.$pl['uid2'].'" LIMIT 1'));
			echo '<br> <img src="http://img.likebk.com/i/clan/'.$cln0['id'].'.gif"> <b>'.$cln0['name'].'</b> (Голосов: '.$pl['gl2'].' , '.round($pl['gl2']/($pl['gl1']+$pl['gl2']+$pl['gl3'])*100,2).'%) ';
		}else{
			echo '<br>'.$u->microLogin($pl['uid2'],1).' (Голосов: '.$pl['gl2'].' , '.round($pl['gl2']/($pl['gl1']+$pl['gl2']+$pl['gl3'])*100,2).'%) ';
		}
		if(isset($gls['id'])) {
			if( $gls['chose'] == 2 ) {
				echo '<font color=blue><b>Ваш голос!</b></font>';
			}
		}else{
			echo '<button onclick="location.href=\'stella.php?sid='.$pl['id'].'&uid2\'">Голосовать</button>';
		}
	}
	if( $pl['uid3'] > 0 ) {
		if( $pl['clan'] == 1 ) {
			$cln0 = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `clan` WHERE `id` = "'.$pl['uid3'].'" LIMIT 1'));
			echo '<br> <img src="http://img.likebk.com/i/clan/'.$cln0['id'].'.gif"> <b>'.$cln0['name'].'</b> (Голосов: '.$pl['gl3'].' , '.round($pl['gl3']/($pl['gl1']+$pl['gl2']+$pl['gl3'])*100,2).'%) ';
		}else{
			echo '<br>'.$u->microLogin($pl['uid3'],1).' (Голосов: '.$pl['gl3'].' , '.round($pl['gl3']/($pl['gl1']+$pl['gl2']+$pl['gl3'])*100,2).'%) ';
		}
		if(isset($gls['id'])) {
			if( $gls['chose'] == 3 ) {
				echo '<font color=blue><b>Ваш голос!</b></font>';
			}
		}else{
			echo '<button onclick="location.href=\'stella.php?sid='.$pl['id'].'&uid3\'">Голосовать</button>';
		}
	}
	//	
	echo '<hr>';
}
?>

</body></html>