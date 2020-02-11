<?

if(isset($_GET['die'])) {
	die('...');
}

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

if( $u->info['doc'] == 0 ) {
	if(isset($_POST['data'])) {
		$_POST['data'] = iconv("UTF8", "CP1251//TRANSLIT//IGNORE", $_POST['data']);
		mysql_query('INSERT INTO `doc` (`uid`,`time`,`html`) VALUES ("'.$u->info['id'].'","'.time().'","'.mysql_real_escape_string($_POST['data']).'")');
		mysql_query('UPDATE `users` SET `doc` = "'.time().'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		die();
	}
}

if($u->info['admin'] == 0 && !isset($_GET['scrn0'])) {
	die();
}

function delbag($r) {
	$r = str_replace('.js','.js',$r);
	$r = str_replace('if(window.top !== window.self)','if(true !== true)',$r);
	$r = str_replace('main.php','/doc.php?die',$r);
	return $r;
}

if(!isset($_GET['list'])) {
	$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.mysql_real_escape_string($_GET['uid']).'" LIMIT 1'));
	if(!isset($usr['id'])) {
		die('Игрок не найден!<br><br><a href="/doc.php?list">Список подозрительных персонажей</a>');
	}
	
	if(isset($_GET['new'])) {
		$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `doc` WHERE `uid` = "'.$u->info['id'].'" AND `time` > "'.mysql_real_escape_string($_GET['new']).'" LIMIT 1'));
		if(!isset($test['id'])) {
			mysql_query('UPDATE `users` SET `doc` = 0 WHERE `id` = "'.$usr['id'].'" LIMIT 1');
			$newwait = true;
		}else{
			header('location: /doc.php?uid='.$usr['id'].'&sid='.$test['id'].'');
			die();
		}
	}elseif(isset($_GET['sid'])) {
		if( $_GET['sid'] == 0 ) {
			$html = mysql_fetch_array(mysql_query('SELECT * FROM `doc` WHERE `uid` = "'.$usr['id'].'" ORDER BY `id` DESC LIMIT 1'));
		}else{
			//if(isset($_GET['px'])) {
				$px = mysql_fetch_array(mysql_query('SELECT `id` FROM `doc` WHERE `uid` = "'.$usr['id'].'" AND `id` < "'.mysql_real_escape_string($_GET['sid']).'" ORDER BY `id` DESC LIMIT 1'));
			//}elseif(isset($_GET['nx'])) {
				$nx = mysql_fetch_array(mysql_query('SELECT `id` FROM `doc` WHERE `uid` = "'.$usr['id'].'" AND `id` > "'.mysql_real_escape_string($_GET['sid']).'" ORDER BY `id` ASC LIMIT 1'));
			//}else{
				$html = mysql_fetch_array(mysql_query('SELECT * FROM `doc` WHERE `uid` = "'.$usr['id'].'" AND `id` = "'.mysql_real_escape_string($_GET['sid']).'" LIMIT 1'));
			//}
		}
		if(isset($_GET['see'])) {
			if(!isset($html['id'])) {
				echo 'Скриншот не найден.';
			}else{
				$html['html'] = delbag($html['html']);
				echo $html['html'];
			}
			die();
		}
	}
}

?>
<!doctype html>
<html>
<head>
<meta charset="windows-1251">
<title>Скриншоты персонажа <?=$usr['login']?></title>
<style type="text/css">
body , html {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	width:100%;
	height:100%;
}
</style>
<link href="http://img.likebk.com/css/main.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
	background-color: #EBEBEB;
}
</style>
</head>

<body>

<?
if(isset($newwait)) {
	echo 'Скриншот в процессе изготовления. Ожидайте пока персонаж будет онлайн и получит запрос! (Пока-что скриншот не получен)<br><br>
	<a href="/doc.php?new='.$_GET['new'].'&uid='.$usr['id'].'">ОБНОВИТЬ</a>';
}elseif(isset($_GET['list'])) {

	echo '<h3>Список подозрительных персонажей:</h3><br>';
	$sp = mysql_query('SELECT `uid`,`id` FROM `doc` WHERE `html` LIKE "%>Часы<%" GROUP BY `uid`');
	while( $pl = mysql_fetch_array($sp) ) {
		echo $u->microLogin($pl['uid'],1).' ( <a href="/doc.php?uid='.$pl['uid'].'&sid='.$pl['id'].'">Открыть скрин</a> )<br>';
	}
	
}else{ ?>
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="50" align="center" valign="middle">
    	<h3>Скриншоты персонажа <?=$u->microLogin($usr['id'],1)?></h3>
        (Дата скриншота: <?=date('d.m.Y H:i:s',$html['time'])?>)
    </td>
  </tr>
  <tr>
    <td align="center" valign="middle" bgcolor="#CCCCCC">
    <iframe width="100%" height="100%" frameborder="0" src="/doc.php?uid=<?=$usr['id']?>&see&sid=<?=$html['id']?>"></iframe>
    </td>
  </tr>
  <tr>
    <td height="50" align="center" valign="middle">
    	<? if(isset($px['id'])){ ?>| <a href="/doc.php?uid=<?=$usr['id']?>&sid=<?=$px['id']?>">Предыдущий</a> &nbsp; <? } ?>
        <? if(isset($nx['id'])){ ?>| <a href="/doc.php?uid=<?=$usr['id']?>&sid=<?=$nx['id']?>">Следующий</a> &nbsp; <? } ?>
        | &nbsp; <a href="/doc.php?uid=<?=$usr['id']?>&new=<?=time()?>">Новый скриншот</a> &nbsp;
        | &nbsp; <a href="/doc.php?list">Список подозрительных персонажей</a> |
    </td>
  </tr>
</table>
<? } ?>
</body>
</html>
