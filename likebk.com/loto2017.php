<?

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

if(isset($_GET['winners'])) {
	$sp = mysql_query('SELECT `uid`,`ekr`,`bilet` FROM `loto_winners` ORDER BY `ekr` DESC');
	while( $pl = mysql_fetch_array($sp)) {
		if(isset($bb[$pl['bilet']])) {
			echo '<div style="background-color:red">'.$u->microLogin($pl['uid'],1) . ' выиграл <b>'.$pl['ekr'].' екр.</b> , билет №'.$pl['bilet'].'</div><hr>';
		}else{
			$bb[$pl['bilet']]++;
			$itm_id = array(
				1  	=> 5095,
				10 	=> 5097,
				50	=> 5098,
				100	=> 5099
			);
			//
			$itm_id = $itm_id[$pl['ekr']]; 
			//
			if( $itm_id > 0 ) {
				//echo $itm_id.' ';
				//$u->addItem($itm_id,$pl['uid']);
			}
			echo $u->microLogin($pl['uid'],1) . ' выиграл <b>'.$pl['ekr'].' екр.</b> , билет №'.$pl['bilet'].'<br>';
			//echo $u->microLogin($pl['uid'],1) . ' выиграл <b>'.$pl['ekr'].' екр.</b><br>';
		}
	}
	die();
}

$loto = array();

if(isset($_GET['test'])) {
	
	if($_GET['test'] != 2) {
		die();
	}

	/*$sp = $uitm = mysql_query('SELECT `uid` FROM `items_users` WHERE `data` LIKE "%|info=<b>Номер лотерейного билета:</b>%" AND `uid` > 0 GROUP BY `uid`');
	while( $pl = mysql_fetch_array($sp) ) {
		$u->addItem(6923,$pl['uid']);
	}*/

	/*
	$i50 = '558 382 1315 215 807 1312 1177 251 562 10 576 134 993 447 1061 460 917 1064 538 1335 1034 1237 721 1067 934 298 682 1280 640 1190 655 1198 191 585 31 998 518 1207 1247 1080 1215 442 1212 827 889 891 1286 423 573 443';
	$i50 = explode(' ',$i50);
	
	$i20 = '133 1168 1207 918 308 643 492 1263 706 312 709 731 573 885 1215 1245 765 1069 117 515';
	$i20 = explode(' ',$i20);
	
	$i10 = '401 1008 1098 1164 623 1247 1318 1159 1173 430';
	$i10 = explode(' ',$i10);
	
	$i3 = '1099 338 197';
	$i3 = explode(' ',$i3);
	*/
	/*
	$html = '';
	
	$html .= '<br><br><b>Победители по 1 екр.</b>:<br>';
	$i = 0;
	while( $i < count($i50) ) {
		$uitm = mysql_fetch_array(mysql_query('SELECT `id`,`uid` FROM `items_users` WHERE `data` LIKE "%|info=<b>Номер лотерейного билета:</b> '.$i50[$i].'|%" LIMIT 1'));
		if(isset($uitm['id'])) {
			$html .= ($i+1).'. '.$u->microLogin($uitm['uid'],1) . ' (Билет №'.$i50[$i].')<br>';
			//$u->addItem(5095,$uitm['uid']);
		}
		$i++;	
	}
	
	$html .= '<br><br><b>Победители по 10 екр.</b>:<br>';
	$i = 0;
	while( $i < count($i20) ) {
		$uitm = mysql_fetch_array(mysql_query('SELECT `id`,`uid` FROM `items_users` WHERE `data` LIKE "%|info=<b>Номер лотерейного билета:</b> '.$i20[$i].'|%" LIMIT 1'));
		if(isset($uitm['id'])) {
			$html .= ($i+1).'. '.$u->microLogin($uitm['uid'],1) . ' (Билет №'.$i20[$i].')<br>';
			//$u->addItem(5097,$uitm['uid']);
		}
		$i++;	
	}
	
	$html .= '<br><br><b>Победители по 50 екр.</b>:<br>';
	$i = 0;
	while( $i < count($i10) ) {
		$uitm = mysql_fetch_array(mysql_query('SELECT `id`,`uid` FROM `items_users` WHERE `data` LIKE "%|info=<b>Номер лотерейного билета:</b> '.$i10[$i].'|%" LIMIT 1'));
		if(isset($uitm['id'])) {
			$html .= ($i+1).'. '.$u->microLogin($uitm['uid'],1) . ' (Билет №'.$i10[$i].')<br>';
			//$u->addItem(5098,$uitm['uid']);
		}
		$i++;	
	}
	
	$html .= '<br><br><b>Победители по 100 екр.</b>:<br>';
	$i = 0;
	while( $i < count($i3) ) {
		$uitm = mysql_fetch_array(mysql_query('SELECT `id`,`uid` FROM `items_users` WHERE `data` LIKE "%|info=<b>Номер лотерейного билета:</b> '.$i3[$i].'|%" LIMIT 1'));
		if(isset($uitm['id'])) {
			$html .= ($i+1).'. '.$u->microLogin($uitm['uid'],1) . ' (Билет №'.$i3[$i].')<br>';
			//$u->addItem(5099,$uitm['uid']);
		}
		$i++;	
	}
	
	echo $html;
	*/
	
	die();
}

?>
<!doctype html>
<html>
<head>
<meta charset="windows-1251">
<title>Лотерея LIKEBK!</title>
<style>
.bodyx {
	position:fixed;
	width:100%;
	height:100%;
	top:0px;
	left:0px;
	background-image:url('/loto1.png');
	background-position:center top;
}
</style>
</head>
<script type="text/javascript">
/////////////////////////////////////////////////////////
// Javascript made by http://peters1.dk/tools/snow.php //
/////////////////////////////////////////////////////////

// ПОМНИТЕ: Измените путь, где сохранен файл snow.png...
snow_img = "data:image/png;base64,R0lGODlhGAAYALMAAP////z8/PHx8ezs7Nra2tnZ2djY2NfX19XV1c/Pz8PDwwAAAMDAwAAAAAAAAAAAACH5BAEAAAwALAAAAAAYABgAQAStkMlJq6Uqa8BB7ommeNbXCUACChejHOAwfGqXTUrd7XwfYoNEQhDacIotRorAUUhGS0LSCAgSj0gcEwQgQAeHz4AgTIRdMK9Mt1Mpxj9c5tpMnTQt0c2lT/JHe1B4eSqFIihlTiUZWx4EQSkhHooWHHQKW0MkFTmYIwM2UGaMCgJOOT2pqUU5hVefM6I7NyYmqh+eJWxCKJF7nJFHXiM6ppQVZDWKI0QJA37QLREAOw==";

// ДОПОЛНИТЕЛЬНО: Вы можете легко настроить количество снежинок на каждой странице...
snow_no = 15;

if (typeof(window.pageYOffset) == "number")
{
	snow_browser_width = window.innerWidth;
	snow_browser_height = window.innerHeight;
} 
else if (document.body && (document.body.scrollLeft || document.body.scrollTop))
{
	snow_browser_width = document.body.offsetWidth;
	snow_browser_height = document.body.offsetHeight;
}
else if (document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop))
{
	snow_browser_width = document.documentElement.offsetWidth;
	snow_browser_height = document.documentElement.offsetHeight;
}
else
{
	snow_browser_width = 500;
	snow_browser_height = 500;	
}

snow_dx = [];
snow_xp = [];
snow_yp = [];
snow_am = [];
snow_stx = [];
snow_sty = [];

for (i = 0; i < snow_no; i++) 
{ 
	snow_dx[i] = 0; 
	snow_xp[i] = Math.random()*(snow_browser_width-50);
	snow_yp[i] = Math.random()*snow_browser_height;
	snow_am[i] = Math.random()*20; 
	snow_stx[i] = 0.02 + Math.random()/10;
	snow_sty[i] = 0.7 + Math.random();
	if (i > 0) document.write("<\div id=\"snow_flake"+ i +"\" style=\"position:absolute;z-index:"+i+"\"><\img src=\""+snow_img+"\" border=\"0\"><\/div>"); else document.write("<\div id=\"snow_flake0\" style=\"position:absolute;z-index:0\"><\img src=\""+snow_img+"\" border=\"0\"><\/div>");
}

function SnowStart() 
{ 
	for (i = 0; i < snow_no; i++) 
	{ 
		snow_yp[i] += snow_sty[i];
		if (snow_yp[i] > snow_browser_height-50) 
		{
			snow_xp[i] = Math.random()*(snow_browser_width-snow_am[i]-30);
			snow_yp[i] = 0;
			snow_stx[i] = 0.02 + Math.random()/10;
			snow_sty[i] = 0.7 + Math.random();
		}
		snow_dx[i] += snow_stx[i];
		document.getElementById("snow_flake"+i).style.top=snow_yp[i]+"px";
		document.getElementById("snow_flake"+i).style.left=snow_xp[i] + snow_am[i]*Math.sin(snow_dx[i])+"px";
	}
	snow_time = setTimeout("SnowStart()", 10);
}
//SnowStart();
</script>
<body>
<link href="http://img.likebk.com/css/main.css" rel="stylesheet" type="text/css">
<div style="position:fixed; z-index:2; width:100%; text-align:center; top:240px; padding:10px;"><a style="padding:5px; background-color:#FFF;" href="?rand=3">Разыграть 3 победителя!</a> <a style="padding:5px; background-color:#FFF;" href="?rand=10">Разыграть 10 победителей!</a> <a style="padding:5px; background-color:#FFF;" href="?rand=30">Разыграть 30 победителей!</a> <a style="padding:5px; background-color:#FFF;" href="?rand=200">Разыграть 200 победителей!</a></div><hr>
<div class="bodyx">&nbsp;</div>
<div style="text-align:center; padding-top:250px; padding-bottom:300px; background-color:#FFC; color:#000">
<?

$sp = mysql_query('SELECT `id`,`uid`,`data` FROM `items_users` WHERE `item_id` = 4539 AND `delete` = 0 AND `uid` > 0 ORDER BY `id` ASC');
while( $pl = mysql_fetch_array($sp) ) {
	$e1 = explode('|info=<b>Номер лотерейного билета:</b> ',$pl['data']);
	$e1 = explode('|',$e1[1]);
	$e1 = $e1[0];
	$loto[] = array( $pl['uid'],$e1 );
}

if(isset($_GET['rand'])) {
	$i = 0;
	$winmest = array(
		3 => 100,
		10 => 50,
		30 => 10,
		200 => 1
	);
	mysql_query('DELETE FROM `loto_winners` WHERE `x` = "'.mysql_real_escape_string($_GET['rand']).'"');
	while( $i < $_GET['rand'] ) {
		$rnd = rand(0,count($loto)-1);
		$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `loto_winners` WHERE `bilet` = "'.$loto[$rnd][1].'" LIMIT 1'));
		if(isset($test['id'])) {
			$rnd = rand(0,count($loto)-1);
			$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `loto_winners` WHERE `bilet` = "'.$loto[$rnd][1].'" LIMIT 1'));
			if(isset($test['id'])) {
				$rnd = rand(0,count($loto)-1);
				$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `loto_winners` WHERE `bilet` = "'.$loto[$rnd][1].'" LIMIT 1'));
				if(isset($test['id'])) {
					$rnd = rand(0,count($loto)-1);
					$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `loto_winners` WHERE `bilet` = "'.$loto[$rnd][1].'" LIMIT 1'));
					if(isset($test['id'])) {
						$rnd = rand(0,count($loto)-1);
						$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `loto_winners` WHERE `bilet` = "'.$loto[$rnd][1].'" LIMIT 1'));
					}
				}
			}
		}
		echo '<br>Место: '.($i+1).'<div style="padding:10px; color:#FFF; background-color:green;">Победитель розыгрыша: '.$u->microLogin($loto[$rnd][0],1).'  - номер билета №'.$loto[$rnd][1].'</div>';
		//
		mysql_query('INSERT INTO `loto_winners` (`uid`,`x`,`bilet`,`ekr`) VALUES ("'.$loto[$rnd][0].'","'.round((int)$_GET['rand']).'","'.$loto[$rnd][1].'","'.$winmest[$_GET['rand']].'")');
		//
		$i++;
	}
}
$i = 0;
while( $i < count($loto) ) {
	echo '<hr>'.$u->microLogin($loto[$i][0],1) . ' - номер билета №'.$loto[$i][1].'';
	$i++;
}

?>
</div>
</body>
</html>