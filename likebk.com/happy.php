<?php
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__magic.php');
include('_incl_data/class/__user.php');

if( $u->info['id'] != 12345 ) {	
	die('Запустится в следующем году!');
}

if(!isset($u->info['id']) || $u->info['room'] != 9) {
	if( $u->info['admin'] == 0 ) {
		header('location: main.php');
		die();
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
    	Празднование 3 года ЛайкБК!
    	</center></h3>
    </td>
    <td width="300" align="right">
        <input type="button" class="btn" onClick="location.href='/happy.php'" value="Обновить">
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
<style>
.button{
     display: block;
     width: 165px;
     margin: 10px auto;
	 text-decoration:none; 
	 text-align:center; 
	 padding:5px 5px; 
	 border:solid 1px #007300; 
	 -webkit-border-radius:8px;
	 -moz-border-radius:8px; 
	 border-radius: 8px; 
	 font:16px Arial, Helvetica, sans-serif; 
	 font-weight:bold; 
	 color:#fff!important; 
	 background-color:#43a824; 
	 background-image: -moz-linear-gradient(top, #43a824 0%, #1a5707 100%); 
	 background-image: -webkit-linear-gradient(top, #43a824 0%, #1a5707 100%); 
	 background-image: -o-linear-gradient(top, #43a824 0%, #1a5707 100%); 
	 background-image: -ms-linear-gradient(top, #43a824 0% ,#1a5707 100%); 
	 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1a5707', endColorstr='#1a5707',GradientType=0 ); 
	 background-image: linear-gradient(top, #43a824 0% ,#1a5707 100%);   
	 -webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff; 
	 -moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 1px #ffffff;  
	 box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;    
}
.button:hover{
	color:#E5FFFF!important;
	opacity: 0.8; 
}
.dv1 {
	height:15px;
	background-color:#0C3;
}
.dv2 {
	height:15px;
	width:250px;
	background-color:#CCC;
	border:1px solid #333;
	text-align:left;
	display:inline-block;
}
.op123 {
	filter:progid:DXImageTransform.Microsoft.Alpha(opacity=25); /* IE 5.5+*/
	-moz-opacity: 0.25; /* Mozilla 1.6 и ниже */
	-khtml-opacity: 0.25; /* Konqueror 3.1, Safari 1.1 */
	opacity: 0.25; /* CSS3 - Mozilla 1.7b +, Firefox 0.9 +, Safari 1.2+, Opera 9+, Chrome 5+, IE 9+ */
}
</style>
<center>
Дорогие друзья!<br>
Поздравляем вас с праздником - 3 год нашей любимой игре - LIKEBK!<br>
В честь этого события, мы предлагаем вам пройти суровые испытания, разделенные на 2 типа, за которые вы получите ценные награды! <br>
	<?
	$finish1 = 0;
	
	if($finish1 == 0) {
	?>
    <hr><h3>Задание №1</h3>
	<?
	$onl = 0;
	
	$ong = mysql_fetch_array(mysql_query('SELECT * FROM `happy_online` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
	if(!isset($ong['id'])) {
		mysql_query('INSERT INTO `happy_online` (`uid`,`time`) VALUES ("'.$u->info['id'].'","'.time().'")');
		$ong = mysql_fetch_array(mysql_query('SELECT * FROM `happy_online` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
	}
	if(isset($ong['id']) && $ong['time'] < time() && isset($_GET['take1on'])) {
		echo '<div><b><font color=red>Вы успешно отметились!</font></b></div>';
		$ong['h']++;
		$ong['time'] = time()+3600;
		mysql_query('UPDATE `happy_online` SET `h` = "'.$ong['h'].'" , `time` = "'.$ong['time'].'" WHERE `id` = "'.$ong['id'].'" LIMIT 1');
	}
	
	$onl = $ong['h'];
	
	if( $onl >= 100 && isset($_GET['take1']) && isset($ong['id']) && $ong['f'] == 0) {
		echo '<div><b><font color=red>Вы успешно забрали награду за Задание №1!</font></b></div>';
		mysql_query('UPDATE `happy_online` SET `f` = "'.time().'" WHERE `id` = "'.$ong['id'].'" LIMIT 1');
		//
		$u->addItem(8023,$u->info['id'],'|sudba=1|nosale=1|notransfer=1');
		if( $u->info['add_smiles'] == '' ) {
			$u->info['add_smiles'] = '3like';
		}else{
			$u->info['add_smiles'] .= ',3like';
		}
		mysql_query('UPDATE `users` SET `add_smiles` = "'.$u->info['add_smiles'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		$ong['f'] = time();
		//
	}
	
	if( $ong['f'] > 0 ) {
		echo '<div><b><font color=red>Задание было успешно выполнено! Вы уже получили награду!</font></b></div>';
	}elseif( $onl >= 100 ) {
		echo '<a href="/happy.php?take1=1"><span class="button" style="pointer-events: none; cursor: default;">Забрать награду</span></a>';
	}else{
	?>
    Провести в онлайне 100 часов:
    <div class="dv2">
    	<div class="dv1" style="width:<?=($onl/100*100)?>%">&nbsp;</div>
    </div> Осталось еще <?=(100-$onl)?> ч.<?
    if( $ong['time'] <= time() ) {
		echo '<a href="/happy.php?take1on=1"><span class="button" style="pointer-events: none; cursor: default;">Отметиться!</span></a>';
	}else{
		echo '<a href="#" onclick="alert(\'Еще рано, нельзя отметиться!\');return false;"><span class="button" style="pointer-events: none; cursor: default;">Отметиться через '.$u->timeOut($ong['time']-time()).'</span></a>';
	}
	?><br><br>
    <? }
	
	if( $ong['f'] == 0 ) {
	?>
    Награда: <img src="http://img.likebk.com/i/items/1g_like2.gif" style="vertical-align:middle"> <b>Капюшон: 3 года ЛайкБК!</b> и <img style="vertical-align:middle" src="http://img.likebk.com/i/smile/3like.gif"> <b>Именной смайлик 3 года ЛайкБК!</b><? } ?>
    <hr><h3>Задание №2</h3>
    <?
	}
	$qst = mysql_fetch_array(mysql_query('SELECT * FROM `happy_quest` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
	if(!isset($qst['id'])) {
		mysql_query('INSERT INTO `happy_quest` (`uid`) VALUES ("'.$u->info['id'].'")');
		$qst = mysql_fetch_array(mysql_query('SELECT * FROM `happy_quest` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
	}
	
	if(isset($_GET['qid500']) && $u->info['admin'] > 0) {
		$qst['x'] = round((int)$_GET['qid500']);
	}
	
	if($u->info['id'] == 12345) {
		echo '<div>Выберите квест: ';
		$i = 0;
		while( $i < 10 ) {
			$i++;
			echo ' <a href="/happy.php?qid500='.$i.'">['.$i.']</a>';
		}
		echo '</div>';
		echo '<div>Выберите награду: ';
		$i = 0;
		while( $i < 10 ) {
			$i++;
			echo ' <a href="/happy.php?qid501='.$i.'">['.$i.']</a>';
		}
		echo '</div><hr>';
	}
	
	function winadd($id,$type = false) {
		global $c , $u;
		
		$txt = '<b>3 года ЛайкБК!</b> Вы получили награду за выполнение задания: ';
		if( $type == true ) {
			$txt = '';
		}
		
		if( $id == 1 ) {
			if( $type == false ) {
				$i = 0;
				$a = array( 994 , 3102 , 5123 , 5122 , 1001 , 1460 , 2140 , 2139 , 3140 , 2418 , 873 , 872 , 871 , 870 , 6819 );
				while( $i <= count( $a ) ) {
					if( $a[$i] > 0 ) {
						$itm = $u->addItem($a[$i],$u->info['id'],'|sudba=1|nosale=1|notransfer=1');
					}
					$i++;
				}
			}
			$txt .= '<b>Сокрушение , Жажда Жизни +5 , Магическое усиление , Защита от магии , Защита от оружия , Холодный разум , Зелье могущества , Зелье прозрения , Зелье стремительности , Зелье разума , Эликсир восстановления , Эликсир потока , Нектар неуязвимости , Нектар отрицания , Антидот</b>!';
		}elseif( $id == 2 ) {
			if( $type == false ) {
				$i = 0;
				$a = array( 5109 , 5110 );
				while( $i <= count( $a ) ) {
					if( $a[$i] > 0 ) {
						$itm = $u->addItem($a[$i],$u->info['id'],'|sudba=1|nosale=1|notransfer=1');
					}
					$i++;
				}
				$u->info['money'] += 50;
				mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			}
			$txt .= '<b>50 кр. , Эликсир Воинского Искусства и Эликсир Магического Искусства</b>!';
		}elseif( $id == 3 ) {
			if( $type == false ) {
				$i = 0;
				$a = array( 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 , 6833 );
				while( $i <= count( $a ) ) {
					if( $a[$i] > 0 ) {
						$itm = $u->addItem($a[$i],$u->info['id'],'|sudba=1|notransfer=1');
					}
					$i++;
				}
				$u->info['money'] += 150;
				mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			}
			$txt .= '<b>150 кр. , Турнирный Жетон (х30)</b>!';
		}elseif( $id == 4 ) {
			if( $type == false ) {
				$prm = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$u->info['id'].'" AND `time_delete` > "'.time().'" AND `type` = 3 LIMIT 1'));
				if(!isset($prm['id'])) {
					mysql_query('DELETE FROM `premium` WHERE `uid` = "'.$u->info['id'].'"');
					mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `id_eff` = "435" AND `delete` = 0');
					$tmadd = 7 * 86400;
					mysql_query("INSERT INTO `eff_users` (`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`, `endtime`, `endfx`) VALUES (435, ".$u->info['id'].", 'LikeBk Gold', 'add_speedhp=150|add_speed_dungeon=50|add_speedmp=150|add_m10=10|add_m11=10|add_exp=100|add_sale_berez=100|add_sale_ekr_berez=100|add_za=10|add_zma=10', 777, ".(time()+$tmadd).", 0, '', 0, '0', 0, '', 1, -1, '0', 0, 1, '', 0, 0, 0, 1, 0, 0, 0);");
					mysql_query("INSERT INTO `premium` (`uid`, `name`, `type`, `time_delete`, `money`, `speed_Loc`, `speedHp`, `speedMp`, `addExp`, `addRep`, `ym_delay`, `yv_drop`, `speed_dunger`, `mfza`, `mf_yron`, `sale_prc`, `saleEkr_prc`, `Exp_zver`) VALUES (".$u->info['id'].", 'LikeBk Gold', 3, ".(time()+$tmadd).", 0, 30, 150, 150, 100, 50, 50, 2, 50, 10, 10, 100, 100, 100);");
				}else{
					mysql_query('UPDATE `premium` SET `time_delete` = `time_delete` + "'.(86400*7).'" WHERE `id` = "'.$prm['id'].'" LIMIT 1');
					mysql_query('UPDATE `eff_users` SET `timeUse` = `timeUse` + "'.(86400*7).'" WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `id_eff` = 435 LIMIT 1');
				}
			}
			$txt .= '<b>7 дней LikeBk Gold</b>!';
		}elseif( $id == 5 ) {
			if( $type == false ) {
				$i = 0;
				if( $lvl < 10 ) { 
					$a = array( 6035 );
				}elseif( $lvl == 10 ) {
					$a = array( 6037 );
				}elseif( $lvl > 10 ) {
					$a = array( 6038 );
				}
				while( $i <= count( $a ) ) {
					if( $a[$i] > 0 ) {
						$itm = $u->addItem($a[$i],$u->info['id'],'|sudba=1|nosale=1|notransfer=1');
					}
					$i++;
				}
				$u->info['money'] += 100;
				mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			}
			$txt .= '<b>100 кр. и Право на подвиг (';
			if( $lvl < 10 ) { echo 'Бездна'; }elseif( $lvl == 10 ) { echo 'Катакомбы'; }elseif( $lvl > 10 ) { echo 'Гора Легиона'; }
			$txt .= ')</b>!';
		}elseif( $id == 6 ) {
			if( $type == false ) {
				$i = 0;
				$a = array( 4371 , 1035 , 1035 , 1035 );
				while( $i <= count( $a ) ) {
					if( $a[$i] > 0 ) {
						$itm = $u->addItem($a[$i],$u->info['id'],'|sudba=1|nosale=1|notransfer=1');
					}
					$i++;
				}
			}
			$txt .= '<b>Мягкая поступь (5 дней) и Сущность Ресурса (х3)</b>!';
		}elseif( $id == 7 ) {
			if( $type == false ) {
				$i = 0;
				$a = array( 5095 );
				while( $i <= count( $a ) ) {
					if( $a[$i] > 0 ) {
						$itm = $u->addItem($a[$i],$u->info['id'],'|sudba=1|nosale=1|notransfer=1');
					}
					$i++;
				}
				$u->info['money'] += 100;
				mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			}
			$txt .= '<b>100 кр. и Чек на 1 екр.</b>!';
		}elseif( $id == 8 ) {
			if( $type == false ) {
				$i = 0;
				$a = array( 9913 );
				while( $i <= count( $a ) ) {
					if( $a[$i] > 0 ) {
						$itm1 = $u->addItem($a[$i],$u->info['id'],'|sudba=1|nosale=1|notransfer=1');
						mysql_query('UPDATE `items_users` SET `gift` = "ЛайкБК" , `gtxt1` = "Поздравляем Вас с юбилеем: ЛайкБК 3 года!" WHERE `id` = "'.$itm1.'" LIMIT 1');
					}
					$i++;
				}
			}
			$txt .= '<b>Открытка ЛайкБК 3 года!</b>!';
		}elseif( $id == 9 ) {
			if( $type == false ) {
				$i = 0;
				$a = array( 3101 , 1461 , 1462 , 1463 , 5084 );
				while( $i <= count( $a ) ) {
					if( $a[$i] > 0 ) {
						$itm = $u->addItem($a[$i],$u->info['id'],'|sudba=1|nosale=1|notransfer=1');
					}
					$i++;
				}
			}
			$txt .= '<b>Жажда Жизни +5 , Звездная Энергия , Звездная Тяжесть , Звездное Сияние , Тактики Боя: 5</b>!';
		}elseif( $id == 10 ) {
			if( $type == false ) {
				$i = 0;
				$a = array( 9914 );
				while( $i <= count( $a ) ) {
					if( $a[$i] > 0 ) {
						$itm = $u->addItem($a[$i],$u->info['id'],'|sudba=1|nosale=1|notransfer=1');
					}
					$i++;
				}
				mysql_query("INSERT INTO `users_ico` (`uid`, `time`, `text`, `img`, `endTime`, `bonus`, `href`, `type`, `x`) VALUES
				(".$u->info['id'].", ".time().", '<b>а года ЛайкБК!</b>`2019<br>Участник празднования!', '3godlike.png', 0, '', '#', 1, 1);");
			}
			$txt .= '<b>Плащ и значок 3 года ЛайкБК</b>!';
		}
		
		if($txt != '') {
			if( $type == false ) {
				mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES (
				" '.$txt.' ",
				"'.$u->info['city'].'","'.$u->info['login'].'","6","1","'.time().'")');
			}else{
				echo '<br><br>Вы получите награду за выполнение задания: ' . $txt;
			}
		}
	}
	
	if(isset($_GET['qid501']) && $u->info['admin'] > 0) {
		winadd($_GET['qid501']);
	}
	
	$qd = $qst['x'];
	
	if($qd == 1) {
		
		$b = array();
		
		$bkv = 0;
		
		$b['l'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = "5111" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1'));
		if( $b['l'][0] >= 1 ) {
			$b['l'] = '<img style="vertical-align:middle;" height="30" src="http://img.likebk.com/i/items/likebkL.png">';
			$bkv++;
		}else{
			$b['l'] = '<img style="vertical-align:middle;" height="30" class="op123" src="http://img.likebk.com/i/items/likebkL.png">';
		}
		
		$b['i'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = "5113" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1'));
		if( $b['i'][0] >= 1 ) {
			$b['i'] = '<img style="vertical-align:middle;" height="30" src="http://img.likebk.com/i/items/likebkI.png">';
			$bkv++;
		}else{
			$b['i'] = '<img style="vertical-align:middle;" height="30" class="op123" src="http://img.likebk.com/i/items/likebkI.png">';
		}
		
		$b['k'] = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `item_id` = "5114" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1'));
		if( $b['k']['id'] >= 1 ) {
			$bkid = $b['k']['id'];
			$b['k'] = '<img style="vertical-align:middle;" height="30" src="http://img.likebk.com/i/items/likebkK.png">';
			$bkv++;
		}else{
			$b['k'] = '<img style="vertical-align:middle;" height="30" class="op123" src="http://img.likebk.com/i/items/likebkK.png">';
		}
		
		$b['k2'] = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `item_id` = "5114" AND `id` != "'.$bkid.'" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1'));
		if( $b['k2']['id'] >= 1 ) {
			$b['k2'] = '<img style="vertical-align:middle;" height="30" src="http://img.likebk.com/i/items/likebkK.png">';
			$bkv++;
		}else{
			$b['k2'] = '<img style="vertical-align:middle;" height="30" class="op123" src="http://img.likebk.com/i/items/likebkK.png">';
		}
		
		$b['e'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = "5117" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1'));
		if( $b['e'][0] >= 1 ) {
			$b['e'] = '<img style="vertical-align:middle;" height="30" src="http://img.likebk.com/i/items/likebkE.png">';
			$bkv++;
		}else{
			$b['e'] = '<img style="vertical-align:middle;" height="30" class="op123" src="http://img.likebk.com/i/items/likebkE.png">';
		}
		
		$b['b'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = "5118" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1'));
		if( $b['b'][0] >= 1 ) {
			$b['b'] = '<img style="vertical-align:middle;" height="30" src="http://img.likebk.com/i/items/likebkB.png">';
			$bkv++;
		}else{
			$b['b'] = '<img style="vertical-align:middle;" height="30" class="op123" src="http://img.likebk.com/i/items/likebkB.png">';
		}
		
		$b['c'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = "5115" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1'));
		if( $b['c'][0] >= 1 ) {
			$b['c'] = '<img style="vertical-align:middle;" height="30" src="http://img.likebk.com/i/items/likebkC.png">';
			$bkv++;
		}else{
			$b['c'] = '<img style="vertical-align:middle;" height="30" class="op123" src="http://img.likebk.com/i/items/likebkC.png">';
		}
		
		$b['o'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = "5119" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1'));
		if( $b['o'][0] >= 1 ) {
			$b['o'] = '<img style="vertical-align:middle;" height="30" src="http://img.likebk.com/i/items/likebkO.png">';
			$bkv++;
		}else{
			$b['o'] = '<img style="vertical-align:middle;" height="30" class="op123" src="http://img.likebk.com/i/items/likebkO.png">';
		}
		
		$b['m'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = "5120" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1'));
		if( $b['m'][0] >= 1 ) {
			$b['m'] = '<img style="vertical-align:middle;" height="30" src="http://img.likebk.com/i/items/likebkM.png">';
			$bkv++;
		}else{
			$b['m'] = '<img style="vertical-align:middle;" height="30" class="op123" src="http://img.likebk.com/i/items/likebkM.png">';
		}
		
		if( $bkv >= 9 ) {
			//mysql_query('UPDATE `happy_quest` SET `x` = 2 WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `happy_quest` WHERE `uid` = "'.$u->info['id'].'"');
			winadd(1);
			mysql_query('INSERT INTO `happy_quest` (`uid`,`x`) VALUES ("'.$u->info['id'].'","2")');
			header('location: /happy.php');
			die();
		}
		
	?>
Итак, первое задание: на просторах нашего клуба, появился воришка, который украл и спрятал в разных укромных местах символы нашего клуба! А именно буквы LIKEBK.COM!<br>
Вам необходимо собрать все буквы. Получить их вы можете за какое либо из действий, будь то покупка предметов, хаотичный поединок и подарки другим игрокам. Собрав все, вы сможете получить ценный приз!<br><br>
	<?=$b['l'].' '.$b['i'].' '.$b['k'].' '.$b['e'].' '.$b['b'].' '.$b['k2'].' . '.$b['c'].' '.$b['o'].' '.$b['m']?><br><br>
    <b>Собрано букв: <?=$bkv?>/9</b>
    <?
	winadd(1,true);
	}elseif( $qd == 2 ) {
		//По завершению выдаются свитки для турниров
	?>
    Найдя все буквы, вы решили найти и наказать воришку! Проведите 3 физических поединка и одержите победу в них! Вдруг воришка прячется среди ваших противников!<br><br>
    <b>Одержано побед в физических боях: <?=$qst['q2']?>/3</b>
    <?	
		if( $qst['q2'] >= 3 ) {
			//
			$u->addItem(6834,$u->info['id'],'|sudba=1|nosale=1|notransfer=1');
			$u->addItem(6835,$u->info['id'],'|sudba=1|nosale=1|notransfer=1');
			$u->addItem(6836,$u->info['id'],'|sudba=1|nosale=1|notransfer=1');
			$u->addItem(6839,$u->info['id'],'|sudba=1|nosale=1|notransfer=1');
			$u->addItem(6842,$u->info['id'],'|sudba=1|nosale=1|notransfer=1');
			//
			winadd(2);
			//mysql_query('UPDATE `happy_quest` SET `x` = 3 WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `happy_quest` WHERE `uid` = "'.$u->info['id'].'"');
			mysql_query('INSERT INTO `happy_quest` (`uid`,`x`) VALUES ("'.$u->info['id'].'","3")');
			header('location: /happy.php');
			die();
		}
		winadd(2,true);
	}elseif( $qd == 3 ) {
		if( $qst['q3'] > 10 ) {
			$qst['q3'] = 10;
		}
		if( $qst['q3_2'] > 5 ) {
			$qst['q3_2'] = 5;
		}
		
	?>
    Вдоволь поиздевавшись над несчастными слабаками, вы решаете попробовать свои силы в равном турнирном бою с горожанами! Но, жажда легкой победы дает о себе знать и вы решаете воспользоваться незаконными усилениями в виде турнирных свитков!<br>
    Вам необходимо провести 10 турниров и 1 раз использовать все турнирные свитки! (Они находятся у вас в инвентаре)<br><br>
    <b>Проведено турниров: <?=$qst['q3']?>/10 и Использовано турнирных свитков: <?=$qst['q3_2']?>/5</b>
    <?	
		if( $qst['q3'] >= 10 && $qst['q3_2'] >= 5 ) {
			winadd(3);
			//mysql_query('UPDATE `happy_quest` SET `x` = 4 WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `happy_quest` WHERE `uid` = "'.$u->info['id'].'"');
			mysql_query('INSERT INTO `happy_quest` (`uid`,`x`) VALUES ("'.$u->info['id'].'","4")');
			header('location: /happy.php');
			die();
		}
		winadd(3,true);
	}elseif( $qd == 4 ) {
		if( $qst['q4'] > 50 ) {
			$qst['q4'] = 50;
		}
		if( $qst['q4_2'] > 25 ) {
			$qst['q4_2'] = 25;
		}
	?>
    О нет! Вас застукали за использованием незаконных турнирных свитков! Теперь вам дорога только в бои для самых яростных бойцов. Туда где нет принципов и правил, где царит хаос и беззаконие. Хаотичные бои.<br>
    Чтобы доказать всем свое умение вам нужно провести 50 хаотичных боев и одержать в них как минимум 25 побед!<br><br>
    <b>Проведено хаотов: <?=$qst['q4']?>/50 и Одержано побед в хаотах: <?=$qst['q4_2']?>/25</b>
    <?	
		if( $qst['q4'] >= 50 && $qst['q4_2'] >= 25 ) {
			winadd(4);
			//mysql_query('UPDATE `happy_quest` SET `x` = 5 WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `happy_quest` WHERE `uid` = "'.$u->info['id'].'"');
			mysql_query('INSERT INTO `happy_quest` (`uid`,`x`) VALUES ("'.$u->info['id'].'","5")');
			header('location: /happy.php');
			die();
		}
		winadd(4,true);
	}elseif( $qd == 5 ) {
	?>
Прославившись в хаотичных боях, вы не находите себе достойных противников среди простых смертных и решаете спуститься в мрачные подземелья, в поисках славы и сокровищ.
<br>
Необходимо 3 раза убить <? if( $u->info['level'] < 10 ) { echo '<b>Повелитель</b> в Катакомбах на 4 этаже.'; }elseif( $u->info['level'] == 10 ) { echo '<b>Повелитель</b> в Катакомбах на 4 этаже.'; }else{ echo '<b>Эми Тейли</b> в Горе Легиона.'; } ?>
<br><br><b>Вы одержали победу над монстром <?=$qst['q5']?>/3 раз.</b>
    <?	
		if( $qst['q5'] >= 3 ) {
			winadd(5);
			//mysql_query('UPDATE `happy_quest` SET `x` = 6 WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `happy_quest` WHERE `uid` = "'.$u->info['id'].'"');
			mysql_query('INSERT INTO `happy_quest` (`uid`,`x`) VALUES ("'.$u->info['id'].'","6")');
			header('location: /happy.php');
			die();
		}
		winadd(5,true);
	}elseif( $qd == 6 ) {
	?>
Убив древних обитателей подземелий, вы накликали на себя гнев богов LIKEBK! Чтобы исправить ситуацию, вы решаете сделать щедрое подношение и отправляетесь в подземелья в поисках сокровищ.
<br>
Необходим собрать 25 ресурсов из подземелья <? if( $u->info['level'] < 10 ) { echo 'Бездна.'; }elseif( $u->info['level'] == 10 ) { echo 'Катакомбы.'; }else{ echo 'Катакомбы.'; } ?>
<br><br>
<b>Собрано ресурсов: <?=$qst['q6']?>/25</b>
    <?	
		if( $qst['q6'] >= 25 ) {
			winadd(6);
			//mysql_query('UPDATE `happy_quest` SET `x` = 6 WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `happy_quest` WHERE `uid` = "'.$u->info['id'].'"');
			mysql_query('INSERT INTO `happy_quest` (`uid`,`x`) VALUES ("'.$u->info['id'].'","7")');
			header('location: /happy.php');
			die();
		}
		winadd(6,true);
	}elseif( $qd == 7 ) {
	?>
Пожертвовав сокровища из подземелий, вы понимаете, что ничего не произошло... Кто то из старожилов рассказывает вам, что боги LIKEBK очень любят редкое сокровище. Монета 3 года LIKEBK!
<br>
<b>В любом из подземелий вам необходимо найти 1 монету &quot;Монета 3 года LIKEBK!&quot;.</b>
	<?	
		$itmtest = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "8020" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1'));
		if(isset($itmtest['id'])) {
			$qst['q7'] = 1;
		}
		if( $qst['q7'] >= 1 ) {
			winadd(7);
			mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `items_id` = "8020"');
			//mysql_query('UPDATE `happy_quest` SET `x` = 6 WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `happy_quest` WHERE `uid` = "'.$u->info['id'].'"');
			mysql_query('INSERT INTO `happy_quest` (`uid`,`x`) VALUES ("'.$u->info['id'].'","8")');
			header('location: /happy.php');
			die();
		}
		winadd(7,true);
    }elseif( $qd == 8 ) {
	?>
Кажется все налаживается, удача снова преследует вас и вы решаете отблагодарить богов LIKEBK!<br>
Необходимо подарить любой подарок или открытку персонажам <b>Admin</b> или <b>Повелитель Багов</b>
	<?
		if( $qst['q8'] >= 1 ) {
			winadd(8);
			//mysql_query('UPDATE `happy_quest` SET `x` = 6 WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `happy_quest` WHERE `uid` = "'.$u->info['id'].'"');
			mysql_query('INSERT INTO `happy_quest` (`uid`,`x`) VALUES ("'.$u->info['id'].'","9")');
			header('location: /happy.php');
			die();
		}
		winadd(8,true);
    }elseif( $qd == 9 ) {
		if(isset($_GET['fight'])) {
			//
				$bot = $u->addNewbot($id['id'],NULL,$u->info['id'],NULL,'turbomax');
				//создаем поединок с ботом
				$expB = 0;
				$btl = array('otmorozok' => 0 , 'priz' => 0 , 'smert' => 0,'noart' => 0,'noeff' => 0,'noatack' => 0,'arand' => 0,'kingfight' => 0,'nobot' => 0,'fastfight' => 0,'players'=>'','timeout'=>60,'type'=>0,'invis'=>0,'noinc'=>0,'travmChance'=>0,'typeBattle'=>0,'addExp'=>$expB,'money'=>0,'money3'=>0);
				$ins = mysql_query('INSERT INTO `battle` (`otmorozok`,`priz`,`room`,`smert`,`noart`,`noeff`,`noatack`,`arand`,`kingfight`,`nobot`,`fastfight`,`clone`,`city`,`time_start`,`players`,`timeout`,`type`,`invis`,`noinc`,`travmChance`,`typeBattle`,`addExp`,`money`,`money3`) VALUES (
													"'.$btl['otmorozok'].'",
													"'.$btl['priz'].'",
													"'.$u->info['room'].'",
													"'.$btl['smert'].'",
													"'.$btl['noart'].'",
													"'.$btl['noeff'].'",
													"'.$btl['noatack'].'",
													"'.$btl['arand'].'",
													"'.$btl['kingfight'].'",
													"'.$btl['nobot'].'",
													"'.$btl['fastfight'].'",												
													"1",
													"'.$u->info['city'].'",
													"'.time().'",
													"'.$btl['players'].'",
													"'.$btl['timeout'].'",
													"139",
													"'.$btl['invis'].'",
													"'.$btl['noinc'].'",
													"'.$btl['travmChance'].'",
													"'.$btl['typeBattle'].'",
													"'.$btl['addExp'].'",
													"'.$btl['money'].'", "'.$btl['money3'].'")');
				if($ins)
				{
					$btl_id = mysql_insert_id();
					//обновляем данные о поединке	
					$u->info['enNow'] -= $trEn;					
					$upd2  = mysql_query('UPDATE `users` SET `battle`="'.$btl_id.'" WHERE `id` = "'.$u->info['id'].'" OR `id` = "'.$bot.'" LIMIT 2');
					mysql_query('UPDATE `stats` SET `team`="1",`enNow` = "'.$u->info['enNow'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('UPDATE `stats` SET `team`="2" WHERE `id` = "'.$bot.'" LIMIT 1');
					//Если бой кулачный, то снимаем вещи
					if($btl['type']==1)
					{
						mysql_query('UPDATE `items_users` SET `inOdet`="0" WHERE `uid` = "'.$u->info['id'].'" AND `inOdet`!=0');
						mysql_query('UPDATE `items_users` SET `inOdet`="0" WHERE `uid` = "'.$bot.'" AND `inOdet`!=0');
					}
					
					//обновляем заявку, что бой начался
					$u->info['battle'] = $btl_id;
					//Отправляем сообщение в чат всем бойцам
					mysql_query("INSERT INTO `chat` (`city`,`room`,`to`,`time`,`type`,`toChat`,`sound`) VALUES ('".$u->info['city']."','".$u->info['room']."','".$u->info['login']."','".time()."','11','0','117')");
					die('<script>location="main.php?battle_id='.$btl_id.'";</script>');
				}else{
					$this->error = 'Cannot start battle (no prototype "ABD0Clone")';
				}
			//
		}
	?>
	За все нужно платить. Удача и щедрость богов не даются просто так. Былые заслуги забыты, на вашем пути появляется самое сложное задание. Вы должны одолеть самого себя.<br>
    <a href="/happy.php?fight"><span class="button" style="pointer-events: none; cursor: default;">Бросить вызов самому себе!</span></a>
	<?
		if( $qst['q9'] >= 1 ) {
			winadd(9);
			//mysql_query('UPDATE `happy_quest` SET `x` = 6 WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `happy_quest` WHERE `uid` = "'.$u->info['id'].'"');
			mysql_query('INSERT INTO `happy_quest` (`uid`,`x`) VALUES ("'.$u->info['id'].'","10")');
			header('location: /happy.php');
			die();
		}
		winadd(9,true);
    }elseif( $qd == 10 ) {
	?>
    Поздравляем, вы завершили все испытания и получаете в награду приз: <B>Плащ и значок ЛайкБК 3 года!</B><br>
    <br>
    <a href="/happy.php?take_lst=1"><span class="button" style="pointer-events: none; cursor: default;">Забрать награду</span></a>
    <br>
    <h3>Оставайтесь с нами! LIKEBK - 3 года!</h3>
    <?
		if(isset($_GET['take_lst'])) {
			winadd(10);
			//mysql_query('UPDATE `happy_quest` SET `x` = 6 WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
			mysql_query('DELETE FROM `happy_quest` WHERE `uid` = "'.$u->info['id'].'"');
			mysql_query('INSERT INTO `happy_quest` (`uid`,`x`) VALUES ("'.$u->info['id'].'","11")');
			header('location: /happy.php');
			die();
		}
		winadd(10,true);
	}else{
	?><B><font color=red>
    Поздравляем, вы завершили все испытания!<br>
    Оставайтесь с нами! LIKEBK - 3 года!</font></B>
    <?
	}
	?>
</center>

</body></html>