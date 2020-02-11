<?

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

if(isset($_GET['ekr'])) {
	$sp = mysql_query('SELECT * FROM `balance_money` WHERE `comment2` NOT LIKE "%combatz%" ORDER BY `id` DESC');
	while($pl = mysql_fetch_array($sp) ) {
		$e1 = explode('Банковский счет покупателя: № <b>',$pl['comment2']);
		$e2 = explode('</b>',$e1[1]);
		$bank = $e2[0];
		$type = 0;
		if( $pl['comment2'] != str_replace('Gold Ekr','',$pl['comment2'] )) {
			$type = 1;
		}
		mysql_query('INSERT INTO `ekr2` (`bank`,`time`,`buy`,`type`) VALUES ("'.$bank.'","'.$pl['time'].'","'.$pl['money'].'","'.$type.'") ');
	}
	die();
}

if(!isset($u->info['id']) || (!isset($_GET['man']) & $u->info['admin'] == 0 && $u->info['id'] != 12345 && $u->info['id'] != 225195 && $u->info['id'] != 581644 && $u->info['id'] != 28444355)) {
	die('404');
}

$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string(@$_POST['login']).'" LIMIT 1'));

if(!isset($_POST['date1'])) {
	$d1 = date('d.m.Y');
	$d2 = $d1;
}else{
	$d1 = $_POST['date1'];
	$d2 = $_POST['date2'];
	
	$d1v = strtotime(str_replace('.','-',$d1).' 00:00:00');
	$d2v = strtotime(str_replace('.','-',$d2).' 23:59:59');
	
	$d1 = date('d.m.Y',$d1v);
	$d2 = date('d.m.Y',$d2v);
}

$filter = str_replace('"','',$_POST['filter']);

?>
<!doctype html>
<html>
<head>
<meta charset="windows-1251">
<title>Личное дело игрока <?=$usr['login']?></title>
<link href="http://img.likebk.com/css/main.css" rel="stylesheet" type="text/css">
</head>

<body style="padding-top:0px; margin-top:7px; height:100%; background-color:#E2E0E0;">

	<form method="post" action="/delo.php">
    	Логин: <input style="text-align:center" type="text" value="<?=$usr['login']?>" name="login"> Дата: с <input style="text-align:center" type="text" value="<?=$d1?>" name="date1"> по <input style="text-align:center" type="text" value="<?=$d2?>" name="date2">
   		<br>Фильтр поиска: <input style="width:310px;" type="text" value="<?=$filter?>" name="filter">
        <input value="поиск" type="submit">
    </form>
        
    <hr>
    
    <? if(isset($usr['id'])) { ?>
    <h3 style="display:flex;">Личное дело персонажа <?=$usr['login']?></h3>
    <?
    
	$html = '';
	$x = 0;
	
	$sp = mysql_query('SELECT * FROM `delo` WHERE `uid` = "'.$usr['id'].'" AND `time` >= '.$d1v.' AND `time` <= '.$d2v.' AND `text` LIKE "%'.mysql_real_escape_string($filter).'%" ORDER BY `time` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		if( $filter != '' ) {
			$pl['text'] = str_replace($filter,'<span style="display:inline-block;padding-top:5px;padding-bottom:5px;background-color:yellow">'.$filter.'</span>',$pl['text']);
		}
		$msg = '<span class="date1">'.date('d.m.Y H:i:s',$pl['time']).'</span> ' . $pl['text'];
		$html .= '<div>'.$msg.'</div><hr>';
		$x++;
	}
	
	mysql_select_db('like_delo',$dbgo);
	$sp = mysql_query('SELECT * FROM `delo` WHERE `uid` = "'.$usr['id'].'" AND `time` >= '.$d1v.' AND `time` <= '.$d2v.' AND `text` LIKE "%'.mysql_real_escape_string($filter).'%" ORDER BY `time` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		if( $filter != '' ) {
			$pl['text'] = str_replace($filter,'<span style="display:inline-block;padding-top:5px;padding-bottom:5px;background-color:yellow">'.$filter.'</span>',$pl['text']);
		}
		$msg = '<span class="date1">'.date('d.m.Y H:i:s',$pl['time']).'</span> ' . $pl['text'];
		$html .= '<div>'.$msg.'</div><hr>';
		$x++;
	}
	
	if( $html == '' ) {
		$html = 'Нет записей в личном деле за выбранный период';
	}else{
		$html .= '<div>Найдено записей: '.$x.'</div>';
	}
	
	echo $html;
	
	}else{ ?>
    ... Укажите логин персонажа и период времени ...
    <? } ?>

</body>
</html>