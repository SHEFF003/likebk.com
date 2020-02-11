<?php

function er($e)
{
	 global $c;
	 die('<html><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru"><TITLE>Произошла ошибка</TITLE></HEAD><BODY text="#FFFFFF"><p><font color=black>Произошла ошибка: <pre>'.$e.'</pre><b><p><a href="http://'.$c[0].'/">Назад</b></a><HR><p align="right">(c) <a href="http://'.$c[0].'/">'.$c[1].'</a></p></body></html>');
}

session_start();

define('GAME',true);
function GetRealIp()
{
 if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
 {
   $ip=$_SERVER['HTTP_CLIENT_IP'];
 }
 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
 {
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
 }
 else
 {
   $ip=$_SERVER['REMOTE_ADDR'];
 }
 return $ip;
}
define('IP',GetRealIp());

include_once('_incl_data/__config.php');
include_once('_incl_data/class/__db_connect.php');
include_once('_incl_data/class/__user.php');
include_once('_incl_data/class/__filter_class.php');
include_once('_incl_data/class/__chat_class.php');

if( $u->info['id'] == 202491 ) {
	include_once('buttons_old.php');
	die();
}

mysql_query('UPDATE `users` SET `doc` = "0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');

if(isset($_GET['showcode']))
{
	include('show_reg_img/security.php');
	die();
}

if($u->info['joinIP']==1 && $u->info['ip']!=IP)
{
	er('#Пожалуйста авторизируйтесь с главной страницы');
}elseif(isset($_GET['exit']))
{
	setcookie('login','',time()-60*60*24*30,'',$c['host']);
	setcookie('pass','',time()-60*60*24*30,'',$c['host']);
	setcookie('login','',time()-60*60*24*30);
	setcookie('pass','',time()-60*60*24*30);
	mysql_query('UPDATE `users` SET `online` = "'.(time()-520).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	die('<script>top.location = "http://'.$c['host'].'/";</script>');
}elseif(!isset($u->info['id']))
{
	
	/*setcookie('login','',time()-60*60*24*30,'',$c['host']);
	setcookie('pass','',time()-60*60*24*30,'',$c['host']);
	setcookie('login','',time()-60*60*24*30);
	setcookie('pass','',time()-60*60*24*30);*/
	
	er('Возникла проблема с определением id персонажа<br>Авторизируйтесь с главной страницы.');
}

if( $u->info['id'] == 129431185 ) {
	$u->info['admin'] = 1;
}

if($u->info['online'] < time()-60)
{
	$filter->setOnline($u->info['online'],$u->info['id'],0);
	mysql_query("UPDATE `users` SET `online`='".time()."',`timeMain`='".time()."' WHERE `id`='".$u->info['id']."' LIMIT 1");	
}

$u->stats = $u->getStats($u->info['id'],0);
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<title><?=$c['title']?></title>
<meta name="description" content="<?=$c['desc']?>" />
<meta name="keywords" content="<?=$c['keys']?>" />
<meta name="author" content="<?=$c['title3']?>"/>
<noscript><meta http-equiv="refresh" content="0; URL=/badbrowser.html"></noscript>
<link href="http://img.likebk.com/css/main.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="http://likebk.com/css/clu0b.css" />
<link rel="stylesheet" type="text/css" href="http://likebk.com/css/windows.css" />
<script src="http://likebk.com:2052/socket.io/socket.io.js"></script>
<script type="text/javascript" src="js/clock.js"></script>
<script>
var upd2017 = true;
var updref = 1; //обновление страницы, если обновилась инфа
var dh7 = new Date();
var loch7 = Date.UTC(dh7.getFullYear(), dh7.getMonth(), dh7.getDate(), dh7.getHours(), dh7.getMinutes(), dh7.getSeconds());
var time_zoneh7 = ((<? echo time();?> - loch7/1000)/60).toFixed(0);

var ignorchatusers = [<?
$html = '';
$sp = mysql_query('SELECT * FROM `friends` WHERE `user` = "'.$u->info['id'].'" AND `ignor` > 0');
while( $pl = mysql_fetch_array($sp) ) {
	$html .= ',"'.$pl['login_ignor'].'"';
}
echo ltrim($html,",");
?>];

var addsmls = [<?
$i = 0;
$x = explode(',',$u->info['add_smiles']);
while( $i < count($x) ) {
	if( $i > 0 ) {
		echo ',';
	}
	echo '"'.$x[$i].'"';
	$i++;
}
?>];

var c = { 
	noEr:0,
	noErTmr:0,
	url:'<?=$c['host']?>',
	img:'img.likebk.com',
	uid:<?=(0+$u->info['id'])?>,
	login:'<?=$u->info['login']?>',
	city:'<?=$u->info['city']?>',
	lvl:<?=$u->info['level']?>,
	rnd:'<?=$code?>',
	room:'<?=$u->info['room']?>',
	roomName:'<?=$u->room['name']?>',
	filter:0,
	time:<?=time()?>,
	pl:0,
	align:<?=(0+$u->info['align'])?>,
	clan:<?=$u->info['clan']?>,
	union:0,
	admin:<?=$u->info['admin']?>,
	dn:<? echo $u->info['dn']; ?>,
	sound:0,
	money:<?=$u->info['money']?>
}, sd4key = "<?=$u->info['nextAct']?>", lafstReg = {},enterUse = 0;

function ctest(city) {
	if(city != c['city']) {
		//top.location = 'buttons.php';
	}
}

function testKey(event)
{
	if(event.keyCode==10 || event.keyCode==13)
	{
		if(top.enterUse == 0)
		{
			chat.subSend();
			top.enterUse = 1;
			top.enterUse = 0;
			//setTimeout('top.enterUse = 0',1000);
		}
	}
}
setInterval('c.time++',1000);
</script>
<script type="text/javascript" src="http://likebk.com/js/jquery.js"></script>
<script>
$.ajaxSetup({cache: false});
$(window).error(function(){
  return true;
});
var iusrno = {};
function ignoreUser(u) {
	if( iusrno[u] == undefined || iusrno[u] == 0 ) {
		//top.iusrno[u] = 1;
		$('#main').attr({'src':'main.php?friends=1&ignore=' + u + ''});
	}else{
		//top.iusrno[u] = 0;
		$('#main').attr({'src':'main.php?friends=1&ignore=' + u + ''});
	}
}
</script>
<script type="text/javascript" src="http://likebk.com/js/jqueryrotate.js"></script>
<script type="text/javascript" src="http://likebk.com/js/jquery.zclip.js"></script>
<script type="text/javascript" src="http://likebk.com/js/jquery.cookie.js"></script>
<script type="text/javascript" src="http://likebk.com/js/title.js"></script>
<script type="text/javascript" src="http://likebk.com/js/gameEngine.js?<?=time()?>"></script>
<script type="text/javascript" src="http://likebk.com/js/interface.js"></script>
<script type="text/javascript" src="http://likebk.com/js/dataCenter.js"></script>
<script type="text/javascript" src="http://likebk.com/js/onlineList.js?<?=time()?>"></script>
<script type="text/javascript" src="http://likebk.com/js/hpregen.js"></script>
<script type="text/javascript" src="http://likebk.com/js/jquery-fireHint.js"></script>
<!-- -->
<link rel="stylesheet" type="text/css" href="http://likebk.com/v2/static/css/game.css" />
<script type="text/javascript" src="http://likebk.com/v2/static/js/core.js" charset="utf-8"></script>
<script type="text/javascript" src="http://likebk.com/v2/getJsUser" charset="utf-8"></script>
<script type="text/javascript" src="http://likebk.com/v2/static/js/autosize.js"></script>
<script>
	_bk.startServerTime( <?=time()?> , -180 );
	_bk.user.info = {
		id:<?=$u->info['id']?>,login:"<?=$u->info['login']?>",level:<?=$u->info['level']?>, align:<?=(0+$u->info['align'])?>, clan:<?=(0+$u->info['clan'])?>, admin:<?=(0+$u->info['admin'])?>,
		sex:<?=$u->info['sex']?>,obraz:"<?=$u->info['obraz']?>"
	};
	_bk.user.stats = {
		hpNow:<?=$u->stats['hpNow']?>,
		hpAll:<?=$u->stats['hpAll']?>,
		mpNow:<?=$u->stats['mpNow']?>,
		mpAll:<?=$u->stats['mpAll']?>
	};
	top._bk.newInfo(<?=$u->jsonData()?>);
</script>
<script type="text/javascript" src="/v2/static/js/mod.js" charset="utf-8"></script>
<!-- -->
<?
if(  !isset($_COOKIE['d1c']) ) {
	include('_incl_data/class/mobile.php');
	$detect = new Mobile_Detect;
	$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
	$_COOKIE['d1c'] = $deviceType;
	setcookie('d1c',$deviceType,(time()+864000));
}else{
	$deviceType = $_COOKIE['d1c'];
}

if( $deviceType == 'tablet' || $deviceType == 'phone' ) {
	echo '<script type="text/javascript" src="http://likebk.com/js/jquery.nicescroll.js"></script>';
?>
<style type="text/css">
#touchmain {
	padding: 0px;
	border: 0;
	overflow: auto;
	margin: 0px;
}
</style>

<script>
  $(document).ready(function() {  
    $("#touchmain").niceScroll("#main",{autohidemode:false,boxzoom:false});	
  });
</script>
<?
}
?>
	<style type="text/css">
		/* Additional classes examples */
		.woman a {
			color:#C33;
		}
		.woman a:hover {
			color:#ff0000;
		}
		img { vertical-align:bottom; }
		#tgf_loadingLine {
			height:18px;
			width:100%;
			color:#776b4a;
			background-color:#ddd5bf;
			position:relative;
		}
		.tfpgs {
			padding:5px;
			background-color:#d4cbb4;
			border-bottom:1px solid #988e73;
			border-top:1px solid #eae3d0;
			cursor:default;
			text-align:center;
		}
		.tgf_msg0 { 
			padding:5px;
			background-color:#c6b893;
			border-bottom:1px solid #988e73;
			border-top:1px solid #eae3d0;
			cursor:default;
		}
		.tgf_msg1 { 
			padding:5px;
			background-color:#d4cbb4;
			border-bottom:1px solid #988e73;
			border-top:1px solid #eae3d0;
			cursor:default;
		}
		.tgf_msgt {
			color:#988e73;
			padding-left:2px;
			padding-right:2px;
			border-right:1px solid #b1a993;
		}
		.tf_btn1 {
			background-color:#ddd5bf;
			padding-left:10px;
			padding-right:10px;
			padding-bottom:3px;
			padding-top:3px;
			margin:1px;
			color:#988e73;
			cursor:pointer;
		    -moz-border-radius: 4px;
		    -webkit-border-radius: 4px;
		    border-radius: 4px;
		}
		
		.tf_btn1:hover {
			background-color:#b7ae96;
			color:#ddd5bf;
			cursor:pointer;
		}
		
		.tf_btn11 {
			background-color:#988e73;
			padding-left:10px;
			padding-right:10px;
			padding-bottom:3px;
			padding-top:3px;
			margin:1px;
			color:#ddd5bf;
			cursor:pointer;
		    -moz-border-radius: 4px;
		    -webkit-border-radius: 4px;
		    border-radius: 4px;
		}
		.qel0 {
			dispaly:none;
			position:absolute;
			z-index:100000;
			border:4px solid #f5cc50;
			border-top-left-radius: 4px;
			border-top-right-radius: 4px;
			border-bottom-right-radius: 4px;
			border-bottom-left-radius: 4px;
		}
	</style>
</head>

<body onLoad="bodyLoaded();cb_statusTest();open_cb(1,null);_bk.start();DigitalClock.start('clock');">
<input type="text" style="width:1px; position:absolute; left:-100px; top:-100px;" value="" id="myInputCopy" name="myInputCopy">
<div id="hideblock" style="position:absolute; width:1px; height:1px; overflow:scroll; left:-100px; top:-100px;"></div>
<div style="display:none" class="qel0" id="qel0"></div>
<noscript><center>В вашем браузере отсутствует поодержка <b>javascript</b></center></noscript>
<script>
var buttonsver = '2.1.1';
</script>
<?
//if( $u->info['id'] == 12345 || $u->info['id'] == 33 || $u->locktest() == true ) {
?>
<style>
.sd4inp {
	width:210px;
	padding:10px;
	margin:10px;
	border:1px solid #777;
	border-radius:5px;
	font-size:50px;
	text-align:center;
}
</style>
<div id="sd4win" style="z-index:10000000; display:none; position:absolute; width:250px; height:150px;">
	<div id="sd4drg" style="border-radius:10px; width:250px; height:150px; background-color:#EFEFEF;">
    	<center><img style="border-radius:5px; margin-top:10px;" id="sd4img1" src="/show_reg_img/security3.php" width="70" height="20"> <img onclick="sd4ref();" style="cursor:pointer;border-radius:5px; margin-top:10px;" src="/show_reg_img/ref.png" width="20" height="20"></center>
    	<input onKeyUp="sd4test();" class="sd4inp" type="text" id="sd4num" value=""><br>
    	<small><center><font color="#333333">(Укажите цифры с картинки выше)</font></center></small>
	</div>
</div>
<div id="sd4win_bg" style="z-index:9999999; cursor:default; display:none; position:absolute; width:100%; height:100%; top:0px; left:0px; opacity: 0.75; background-color:#efefef;">
</div>
<script type="text/javascript" src="http://likebk.com/show_reg_img/jRumble.js"></script>
<script>
var refj = 0;
function sd4no() {
	$('#sd4drg').jrumble({
		 x: 3,
		 y: 3,
		 rotation: 3,
		 speed: 5,
		 opacity: true,
		 opacityMin: .05
	});
	$('#sd4drg').css('background-color','#e54646');
	$('#sd4drg').trigger('startRumble');
	setTimeout(function(){ $('#sd4drg').trigger('stopRumble'); $('#sd4drg').css('background-color','#efefef'); } , 500);
	sd4ref();
}
function sd4yes() {
	$('#sd4num').attr('disabled',true);
	$('#sd4drg').css('background-color','#7ecc4f');
	$('#sd4win_bg').animate({opacity:0},1000);
	$('#sd4drg').animate({opacity:0},1000,function(){
		$('#sd4win').hide(1000);
		$('#sd4win_bg').hide();
		$(frames.main).focus();
	});
}
function sd4test() {
	if( $('#sd4num').val().length >= 3 ) {
		$.post('/test_sd4.php',{'key':$('#sd4num').val()},function(data) {
			if( data != 'bad' && data != '' ) {
				sd4yes();
			}else{
				sd4no();
			}
		});
	}
}
function sd4ref() {
	$('#sd4img1').attr('src','/show_reg_img/security3.php?rnd=<?=time()?>.'+refj);
	$('#sd4num').val('');
	$('#sd4num').focus();
	refj++;
}
function sd4win() {
	refj++;
	$('#sd4img1').attr('src','/show_reg_img/security3.php?rnd=<?=time()?>.'+refj);
	setTimeout(function(){ $('#sd4num').attr('disabled',false);
	$('#sd4num').val('');
	$('#sd4drg').css('opacity',1);
	$('#sd4drg').css('background-color','#efefef');
	$('#sd4win_bg').css('background-color','#efefef');
	$('#sd4win_bg').css('opacity',0.75);
	$('#sd4win').show().center();
	$('#sd4num').focus();
	$('#sd4win_bg').show('slow');
	},1000);
}

<? if( $u->locktest() == true ) { echo 'sd4win();'; } ?>

</script>

<? //} ?>
<style>
/* цвета команд */
.CSSteam0	{ font-weight: bold; cursor:pointer; }
.CSSteam1	{ font-weight: bold; color: #6666CC; cursor:pointer; }
.CSSteam2	{ font-weight: bold; color: #B06A00; cursor:pointer; }
.CSSteam3 	{ font-weight: bold; color: #269088; cursor:pointer; }
.CSSteam4 	{ font-weight: bold; color: #A0AF20; cursor:pointer; }
.CSSteam5 	{ font-weight: bold; color: #0F79D3; cursor:pointer; }
.CSSteam6 	{ font-weight: bold; color: #D85E23; cursor:pointer; }
.CSSteam7 	{ font-weight: bold; color: #5C832F; cursor:pointer; }
.CSSteam8 	{ font-weight: bold; color: #842B61; cursor:pointer; }
.CSSteam9 	{ font-weight: bold; color: navy; cursor:pointer; }
.CSSvs 		{ font-weight: bold; }
.buttons:hover { background-color:#EFEFEF; }
.buttons:active { color:#777777; }
.buttons { background-color:#E9E9E9; }
.menutop2{color:#003366;} .menutop2:hover{
	color:#446B93;
}
.klan { font-weight:bold; color: green; background-color: #99FFCC;}
.redColor {
	color: #FF0000;
	font-weight: bold;
}
.borderWhite {
	border: 1px solid #f2f0f0;
}
.date21	{
	font-family: Courier;
	font-size: 8pt;
	text-decoration:underline;
	font-weight:normal;
	color: #007000;
	background-color: #00FFAA
}


.zoneCh_no {
	float:left;
	overflow:hidden;
	height: 18px;
	width: 18px;
}

.inpBtl {
	color: #000000;
	text-decoration: none;
	background-color: #ECE9D8;
	border: 1px solid #000000;    
}

.zoneCh_yes {
	float:left;
	overflow:hidden;
	height: 18px;
	width: 18px;
	background-color: #A9AFB1;
}
	
body {
	background-color: #e8e8e8;
}
.st1222 {
	font-size: 18px;
	color: #990000;
	font-weight: bold;
}
.crop {
	float:left;
	overflow:hidden;
	height: 18px;
	width: 18px;
}

.radio_off {
    margin-left:0px;
}

.radio_on {
    margin-left:-18px;
}

.battle_hod_style {
    border-bottom-width: 1px;
    border-bottom-style: solid;
    border-bottom-color: #AEAEAE;
}
.zbtn1l{	width:9px;	height:18px;	background: url(http://likebk.com/tab.png) 0px 0px repeat-x;}
.zbtn1r {	width:9px;	height:18px;	background: url(http://likebk.com/tab.png) -18px 0px repeat-x;}
.zbtn1r2 {	width:9px;	height:18px;	background: url(http://likebk.com/tab.png) 18px 0px repeat-x;}
.zbtn2l{	width:9px;	height:18px;	background: url(http://likebk.com/tab.png) -36px 0px repeat-x;}
.zbtn2r {	width:9px;	height:18px;	background: url(http://likebk.com/tab.png) -54px 0px repeat-x;}
.zbtn2r2 {	width:9px;	height:18px;	background: url(http://likebk.com/tab.png) -90px 0px repeat-x;}
.zbtn2r3 {	width:9px;	height:18px;	background: url(http://likebk.com/tab.png) 54px 0px repeat-x;}
.zbtn1c{	background-color: #808080;	border-top-width: 1px;	border-bottom-width: 1px;	border-top-style: solid;	border-bottom-style: solid;	border-top-color: #000000;	border-bottom-color: #000000;	color: #FFFFFF;	cursor:default;	padding-left:5px;	padding-right:5px;	FONT-FAMILY: Verdana, Arial, Helvetica, Tahoma, sans-serif;}
.zbtn2c{
	background-color: #D5D2C9;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #000000;
	color: #000000;
	cursor:default;
	padding-left:5px;
	padding-right:5px;
	FONT-FAMILY: Verdana, Arial, Helvetica, Tahoma, sans-serif;
	font-weight: bold;
}
</style>
<script>
if(window.top !== window.self)
{
	document.write = "";
	window.top.location = window.self.location;
	setTimeout(function(){ document.body.innerHTML='Ошибка доступа.'; },500);
	window.self.onload=function(evt){
	document.body.innerHTML='Ошибка доступа.';};
}
function cc(el) {
	$(window).resize(function(){
		$(el).css({
				position:'absolute',
				left: ($(document).width() - $(el).outerWidth())/2,
				top: ($(document).height() - $(el).outerHeight())/2
		});
	});		
	$(window).resize();
}
</script>
<style>
#qsst {
	position:absolute;
	z-index:10000000;
	cursor:default;
	display:none;
	top:50px;
	left:50px;
}
#onbon {
	position:absolute;
	z-index:100;
	cursor:default;
	display:none;
	bottom:30px;
	left:18px;
}
#mini_qsst {
	position:absolute;
	z-index:100;
	cursor:default;
	display:none;
	bottom:10px;
	right:18px;
}
</style>
<?
if( $u->info['admin'] >= 0 || $u->info['login'] == 'enchanter' ) {
	?>
    <script>
	function daikrfx() { 
		$('#daiekr').show().html('<iframe id="daikr" name="daikr" src="/daiekr.html" frameborder="0" style="display:block;padding-top:0px;padding:0;margin:0;width:850px;height:520px;border:0;" scrolling="auto"></iframe><br>&nbsp;&nbsp;&nbsp;<B onclick="daikrfxclose()" style="cursor:pointer;color:#FFF;background-color:#000;padding:10px;">ЗАКРЫТЬ ИГРУ</B>');
	}
	function daikrfxclose() { 
		$('#daiekr').hide().html('');
	}
	</script>
    <div id="daiekr" style="position:absolute; display:none; top:0; left:0; z-index:9999999999;">
            
    </div>
    <img oncontextmenu="$(this).hide(); return false;" draggable="false" id="girl" style="display:none;position:absolute;bottom:25px;right:140px;" height="128" src="/minigirl.gif">
    <img oncontextmenu="$(this).hide(); return false;" width="128" title="Подорожник" draggable="false" style="display:none;cursor:move; position:absolute; z-index:999999999999999999999999;" src="/pod.png" id="ball">
	 <script>
var ball = document.getElementById('ball');

ball.onmousedown = function(e) { // 1. отследить нажатие

  // подготовить к перемещению
  // 2. разместить на том же месте, но в абсолютных координатах
  ball.style.position = 'absolute';
  moveAt(e);
  // переместим в body, чтобы мяч был точно не внутри position:relative
  document.body.appendChild(ball);

  ball.style.zIndex = 1000; // показывать мяч над другими элементами

  // передвинуть мяч под координаты курсора
  // и сдвинуть на половину ширины/высоты для центрирования
  function moveAt(e) {
    ball.style.left = e.pageX - ball.offsetWidth / 2 + 'px';
    ball.style.top = e.pageY - ball.offsetHeight / 2 + 'px';
  }

  // 3, перемещать по экрану
  document.onmousemove = function(e) {
    moveAt(e);
  }

  // 4. отследить окончание переноса
  ball.onmouseup = function() {
    document.onmousemove = null;
    ball.onmouseup = null;
  }
}
      </script>
    <?
}
?>
<?php if($u->info['level'] < 8){?>
<div id="qsst"></div>
<?php }?>
<div id="ttl" class="ttl_css" style="display:none;z-index:1111;" /></div>
<div id="nfml" style="display:none;position:absolute;" /></div>
<div id="persmenu" style="display:none;z-index:1110;" /></div>
<div id="windows" style="position:absolute;z-index:1101;"></div>
<div id="wupbox" onmouseup="win.WstopDrag()" onmousemove="win.WmoveDrag(event)" onselectstart="return false"></div>
<div id="chconfig">
<center><b>Настройки чата</b></center>
<img title="Эпическая линия (o_O)" src="http://<?=$c['img'];?>/1x1.gif" class="eLine"><br>
Скорость обновления: <SELECT id="chcf0"><OPTION value='-1'>никогда</OPTION><OPTION value='1'>15 сек.</OPTION><OPTION selected value='2'>30 сек.</OPTION><OPTION value='3'>1 мин.</OPTION><OPTION value='4'>5 мин.</OPTION></SELECT><br>
<div>Сортировка списка онлайн: <SELECT id="chcf8"><OPTION value='0' selected>По логину</OPTION><OPTION value='1'>По уровню</OPTION><OPTION value='2'>По склоности</OPTION><OPTION value='3'>По клану</OPTION></SELECT>
<input name="chcf9" type="checkbox" id="chcf9" value="1"><small>По убыванию</small></div>
<? if($u->info['admin']>0 || ($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4) || $u->info['dealer']==1) { ?>
<div><input name="chcf11" type="checkbox" id="chcf11" value="1"> Глобальный чат</div>
<? } ?>
<div><input name="chcf12" type="checkbox" id="chcf12" value="1"> Экономия трафика</div>
<div style="display:<? if($u->info['admin']>0 || ($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4)) { echo ''; }else{ echo 'none;'; } ?>"><input name="chcf7" type="checkbox" id="chcf7" value="1"> <span title="Получать сообщения от персонажей на которых наложено заклятие молчания">Сообщения с молчанкой</span></div>
<img title="Эпическая линия (o_O)" src="http://<?=$c['img'];?>/1x1.gif" class="eLine">
<div>&nbsp; &nbsp;&nbsp; <span><a href="javascript:void(0)" onclick="chat.ignorListOpen();chconf();">Список игнорируемых</a></span></div>
</div>
<!-- <div id="counters"></div> -->
<!-- ресайзы -->
<div id="actionDiv" style="position:absolute;"></div>
<div id="reline1" onselectstart="return false">
	<img src="http://img.likebk.com/1x1.gif" width="9" height="4" style="float:left; display:block; position:absolute; background-image:url(http://img.likebk.com/i/lite/_top_24.gif);">
	<img src="http://img.likebk.com/1x1.gif" width="10" height="4" style="float:right; display:block; background-image:url(http://img.likebk.com/i/lite/_top_28.gif);">
</div>
<div id="reline2" onselectstart="return false"></div>
<!-- ресайзы -->
	<? /*
	<script>
	function rrtest00000() {
		/*
		var html = '<script async type="text/javascript" src="//volnorez.com/plugins/jscode/player_js/001d11a9/%7B%22autoplay0%22%3Atrue%2C%22share%22%3A%22local%22%2C%22skin%22%3A%22skin3%22%2C%22style%22%3A%7B%22ch%22%3A%2222%22%7D%7D"></script>';
		*/
		//var html = "test";
        //$('#vplayer001d11a9').append(html);
	//} ?> 
    <script>
	function rrtest() {
		$(document.body).append("<script async type=\"text/javascript\" src=\"//volnorez.com/plugins/jscode/player_js/001d11a9/%7B%22autoplay0%22%3Atrue%2C%22share%22%3A%22local%22%2C%22skin%22%3A%22skin3%22%2C%22style%22%3A%7B%22ch%22%3A%2222%22%7D%7D\"></"+"script"+">");
		//alert('test');
	}
	</script>
    <div align="center" id="vplayer001d11a9" style="width:300px; background-color:#CCC; height:24px; border:1px solid #999; border-radius:5px; z-index:10000000; position:absolute; top:3px; left:195px;">
    	<div style="padding-top:3px;"><a class="cp" onclick="rrtest()"><small>Включить радио</small></a></div>
    </div>


<div id="upbox" onselectstart="return false"></div>
    <div style="position:absolute; top:0; left:0; height:37px; width:100%;" onselectstart="return false">
    <div title="Новая почта" style="display:none; position:absolute; left: 1px; top: 13px; width:24px; height:15px; background-image:url(http://img.likebk.com/i/mail2.gif);" class="postdiv" id="postdiv"></div>
	    
    <div style="background: url(http://img.likebk.com/i/lite/<?=$u->info['city']?>/top_lite_cap_11.gif) repeat-x bottom; ">
     <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background: url(http://img.likebk.com/i/lite/top_lite_cap_03.gif) repeat-x top; ">
        <tr>
          <td align="left"><!-- <img src="http://img.likebk.com/i/lite/<?=$u->info['city']?>/top_lite_cap_01.gif" height="14" class="db" /> --></td>
          <td align="right" class="main_text" style="position: relative"><table cellspacing="0" cellpadding="0" border="0" width="490">
            <tr valign="bottom" align="center">
              <td width="31" height="14"><img class="db" height="14" src="http://img.likebk.com/i/lite/mennu112_06_lite.gif" width="31" /></td>
              <td align="center"><table height="14" cellspacing="0" cellpadding="0" width="100%" background="http://img.likebk.com/i/lite/mennu112_06.gif" border="0">
                <tr align="middle">
                  <td id="el1" class="main_text" onClick="this.style.backgroundColor='#404040'; this.style.color='#FFFFFF'; showtable('1');" align="center">Знания</td>
                  <td width="1"><img class="db" height="11" src="http://img.likebk.com/i/lite/mennu112_09.gif" width="1" /></td>
                  <td id="el2" class="main_text" onClick="this.style.backgroundColor='#404040'; this.style.color='#FFFFFF'; showtable('2');" align="center">Общение</td>
                  <td width="1"><img class="db" height="11" src="http://img.likebk.com/i/lite/mennu112_09.gif" width="1" /></td>
                  <td id="el3" class="main_text" onClick="this.style.backgroundColor='#404040'; this.style.color='#FFFFFF'; showtable('3');" align="center">Безопасность</td>
                  <td width="1"><img class="db" height="11" src="http://img.likebk.com/i/lite/mennu112_09.gif" width="1" /></td>
                  <td id="el4" class="main_text" onClick="this.style.backgroundColor='#404040'; this.style.color='#FFFFFF'; showtable('4');" style="background:#404040; color:#FFFFFF;" align="center">Персонаж</td>
                  <td width="1"><img class="db" height="11" src="http://img.likebk.com/i/lite/mennu112_09.gif" width="1" /></td>
                  <td id="el5" class="main_text" onClick="if(confirm('Выйти из игры?')){ top.location = '/buttons.php?exit&rnd=<?=$code?>'; }"  align="center">Выход&nbsp;</td>
                </tr>
              </table></td>
              <td width="38">
              	<img class="db" height="14" src="http://img.likebk.com/i/lite/mennu112_04_lite.gif" width="37" />
              </td>
            </tr>
          </table>
          </td>
        </tr>
        <tr>
          <td align="left" width="200" style="display: block;">
          	<img style="display:block; float:left;" src="http://img.likebk.com/i/lite/top_lite_cap_07.gif" width="15" height="17" />
          	<!-- <img class="db" src="http://img.likebk.com/i/lite/<?=$u->info['city']?>/top_lite_cap_08.gif" width="175" height="17" /> --></td>
          <td align="right">
          <table cellspacing="0" cellpadding="0" width="490" style="background-image:url(http://img.likebk.com/i/lite/top_lite_cap_15.gif);" border="0">
            <tr>
              <td align="right" class="menutop"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="20"><img class="db" src="http://img.likebk.com/i/lite/top_lite_13.gif" width="20" height="17" /></td>
                    <td align="right" valign="top" background="http://img.likebk.com/i/lite/top_lite_low_15.gif" style="font-size:10px;">
                        <span style="display:none;" id="menu1"> 
                        	<a href="http://<? echo $c['host']; ?>/news" target="_blank" class="menutop">Новости</a> | 
                        	<a style="color: green; font-weight: bold;" href="http://dressbk.ru/" target="_blank" class="menutop">Примерочная</a> |
                        	<a href="http://<? echo $c['host']; ?>/bonus.php" target="_blank" class="menutop">Бонусы от статов</a> | 
                        	<a href="http://forum.<? echo $c['host']; ?>/index.php?r=12&rnd=1" target="_blank" class="menutop">Законы</a> | 
                        	<a href="http://<? echo $c['host']; ?>/encicl/2.html" target="_blank" class="menutop">Соглашения</a>&nbsp;</span>
                        <span style="display:none;" id="menu2">
                        		<a onClick="top.telegraf(); return false" href="javascript:void(0)" target="_blank" class="menutop"> Телеграммы </a> | 
                        		<!-- <a href="http://<? //echo $c['host']; ?>/library/" target="_blank" class="menutop"> Библиотека </a> |  -->
                        		<a href="http://<? echo $c['host']; ?>/news" target="_blank" class="menutop"> События </a> | 
                        		<a href="http://forum.<? echo $c['host']; ?>" target="_blank" class="menutop"> Форум </a> |  
                        		<a href="http://top.<? echo $c['host']; ?>/" target="_blank" class="menutop">Рейтинг</a>&nbsp;</span>
                        <span style="display:none;" id="menu3"> 
                        		<a href="main.php?act_sec=1" target="main" class="menutop">Отчеты</a> | 
                        		<a href="/main.php?act_trf=1" target="main" class="menutop">Отчеты о переводах</a> | 
                        		<!-- <a href="http://<? //echo $c['host']; ?>/encicl/1.html" target="_blank" class="menutop">Правила</a> |  -->
                        		<a href="http://<? echo $c['host']; ?>/main.php?security&rnd=<?=$c[9]?>" target="main" class="menutop">Настройки</a> | 
                        		<a href="main.php?security&rnd=<?=$c[9]?>" target="main" class="menutop">Смена пароля</a>&nbsp;</span>
                        <?php //if($u->info['admin'] > 0) {?>
                        	<span style="display:;" id="menu4"><a style="color: green; font-weight: bold;" href="#" onclick="_bk.oUrl('/main.php?referals=1&rn=<?=$c[9]?>');return false;" target="main" class="menutop">Реферальный Заработок</a> | 
                       	<?php //}?>
                       <a href="#" onclick="_bk.oUrl('/main.php?inv=1&rn=<?=$c[9]?>'); return false;" target="main" class="menutop">Инвентарь</a> | 
                       <a href="#" onclick="_bk.oUrl('/main.php?skills=1&side=5');return false;" target="main" class="menutop">Умения</a> | 
                       <a href="#" onclick="_bk.oUrl('/main.php?zayvka=1');return false;" target="main" class="menutop">Поединки</a>
                       <!-- | <a href="/seasons.php" target="main" class="menutop">Сезоны</a>--> | 
                        <a href="#" onclick="_bk.oUrl('/main.php?anketa=1');return false;" target="main" class="menutop">Анкета</a>&nbsp;</span>
                    </td>
                    <td width="22"><img class="db" src="http://img.likebk.com/i/lite/top_lite_18.gif" width="22" height="17" /></td>
                  </tr>             
                </table></td>
            </tr>
          </table></td>
        </tr>
      </table>
    </div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="15" height="6"><img class="db" src="http://img.likebk.com/i/lite/_lit_20.gif" width="15" height="6" /></td>
        <td background="http://img.likebk.com/i/lite/_top_20s.gif"><img class="db" src="http://img.likebk.com/i/lite/<?=$u->info['city']?>/cap_lit_21.gif" width="79" height="6" /></td>
        <td width="24" height="6"><img class="db" src="http://img.likebk.com/i/lite/_lit_27.gif" width="24" height="6" /></td>
      </tr>
    </table>
    <div style="position: absolute; top: 0px; left: 10px; width: 169px; height: 45px;">
    	<img src="http://likebk.com/images/theme/logo.png" width="169" height="45">
    </div>
    <!-- -->
</div>
<table id="globalMain" width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="31" width="9" bgcolor="#D6D6D6"></td>
    <td height="31" bgcolor="#D6D6D6">&nbsp;</td>
    <td height="31" width="12" bgcolor="#D6D6D6"></td>
  </tr>
  <tr>
    <td bgcolor="#D6D6D6" background="http://img.likebk.com/i/lite/_top_24.gif"></td>
    <td valign="top" bgcolor="#e2e0e0" id="main_td">
    <div id="touchmain" style="margin-top:3px;">
    	<iframe id="main" name="main" src="/main.php?dietest" frameborder="0" style="display:block;padding-top:0px;padding:0;margin:0;width:100%;border:0;" scrolling="auto"></iframe>
    </div>
    </td>
    <td class="no_chat_mob"  bgcolor="#D6D6D6" background="http://img.likebk.com/i/lite/_top_28.gif"></td>
  </tr>
  <tr class="no_chat_mob">
    <td bgcolor="#D6D6D6" background="http://img.likebk.com/i/lite/_top_24.gif"></td>
    <td id="chat" valign="top" height="35%" bgcolor="#eeeeee">
    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" style="border-top:1px solid #CCCCCC">
      <tr>
        <td valign="top" id="chat_block" style="position:relative;display:block;border-top:1px solid #808080">
            <div id="mini_qsst" onClick="top.qn_slk()" style="cursor:pointer"></div>
            <div id="onbon"></div>
            <div id="chat_menus" unselectable="on" onselectstart="return false;" style="position:absolute; right:0px; top:3px; padding-right:0px; height:18px; text-align:right; white-space:nowrap;">
              	<!-- -->
                <table border="0" style="margin-top:-3px;" align="right" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <div id="chat_menu" style="text-align:right; white-space:nowrap;">
                            <? /*<div id="addbs" style="float:left;display:;"><a href="javascript:top.add_cb(0,'new',0,0);"><img src="addmn.gif" width="16" height="16" title="Добавить новую вкладку" /></a></div>*/ ?>
                        </div>
                      </td>
                      <td style="display:none;" id="scroll_none" width="3"></td>
                    </tr>
                </table>
                <!-- -->
              </div>

        <div id="ttSmiles" onselectstart="return false" style="display:none;z-index:1100;" />
        	<div id="smilesDiv">Загрузка смайликов</div>
            <div align="center"><button onClick="chat.lookSmiles()">Закрыть</button></div>
        </div>
        
          <div id="chat_list" style="cursor:default;">
                <div id="canals">
                
                </div>
          </div>        
        </td>
        <td width="240" valign="top" bgcolor="#faf2f2" style="border-left:2px solid #CCCCCC;border-top:1px solid #808080" id="online">
        <div id="online_list" style="cursor:default;">
        	<div style="padding:10px;" id="chnewline1" align="center"><small><a href="javascript:void(0);" onclick="chat.socketStart();">Включить новый чат (тест)</a><hr></small></div>
          <div align="center" style="margin-top:5px;"><button class="btnnew2" id="robtn" onClick="chat.reflesh()">Обновить</button></div>
          <font class="db" style="padding:0px 0 8px 0;font-size: 10pt; color:#8f0000;"><b id="roomName"></b></font>
          <div id="onlist"></div>
          <div id="blockbtnlist1" style="border-top:#cac2c2 solid 1px;padding:5px;margin-top:5px;">
              <div><label><input type="checkbox" value="1" <? if( $u->info['level'] < 8 ) { ?>checked<? } ?> id="autoRefOnline">Обновлять автомат.</label></div>
              <? if( $u->info['admin'] > 0 ) { ?>
              <div><label><input name="chcf10" type="checkbox" id="chcf10" <? if( $u->info['level'] < 8 ) { ?>checked<? } ?> value="0">Показать всех игроков</label></div>
          	  <? } ?>
          </div>
        </div>
      </td>
      </tr>
    </table>
    </td>
    <td bgcolor="#D6D6D6" background="http://img.likebk.com/i/lite/_top_28.gif"></td>
  </tr>
  <tr class="no_chat_mob">
    <td height="30" valign="bottom"><img class="db" src="http://img.likebk.com/i/lite/bkf_l_r1_02.gif" width="9" height="30"></td>
    <td height="30" bgcolor="#E9E9E9" background="http://img.likebk.com/i/buttons/chat_bg.gif">
    <table width="100%" height="26" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="30"><img class="db" src="http://img.likebk.com/b___.gif" width="30" height="30" title="Чат"></td>
        <td <? if($_COOKIE['chatCfg11']<1){ echo 'style="display:none;" '; } ?>width="100" align="center" id="globalMode"><div style="border:1px solid #CCCCCC;background-color:#EAEAEA;color:#717171;padding:2px; width:90%;"><small id="moneyGM"><?=$u->info['money']?> кр.</small></div></td>
        <td>
        	<?php if($u->info['level'] < 4){?>
        		<input disabled="disabled"  style="width:100%;font-size:9pt;margin-bottom:2px;" />	
        	<?php }else{?>
        		<input onmouseup="top.chat.inObj=undefined;" type="text" name="textmsg" id="textmsg" maxlength="240" onKeyPress="top.testKey(event)" style="width:100%;font-size:9pt;margin-bottom:2px;" />
        	<?php }?>
        </td>
        <td width="6">&nbsp;</td>
        <td width="30"><img onClick="chat.subSend();" src="http://img.likebk.com/1x1.gif" class="db cp chatBtn2_1"></td>
        <td width="5">
        <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="1" height="1" id="Sound" align="middle">
			<param name="allowScriptAccess" value="always" />
			<param name="movie" value="flash/Sound2.1.swf" />
			<param name="quality" value="high" />
			<param name="scale" value="noscale" />
			<param name="wmode" value="transparent" />
			<embed src="flash/Sound2.1.swf" quality="high" scale="noscale" wmode="transparent" width="1" height="1" name="Sound" id="Sound2" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
        </object>
        </td>
        <td width="30"><img onClick="chat.clear();" class="db cp" src="http://img.likebk.com/i/buttons/chatBtn3.gif"></td>
        <td width="30"><img onClick="chat.filterMsg();" id="chbtn1" src="http://img.likebk.com/1x1.gif" class="db cp chatBtn1_1"></td>
        <td width="30"><img onClick="chat.systemMsg();" id="chbtn4" src="http://img.likebk.com/1x1.gif" class="db cp chatBtn4_<? if(isset($_COOKIE['citySys']) && $_COOKIE['citySys']==1){ echo 2; }else{ echo 1; } ?>"></td>
        <td width="30"><img id="chbtn5" onClick="chat.speedChat();" src="http://img.likebk.com/1x1.gif" class="db cp chatBtn5_1"></td>
        <td width="30"><img id="chbtn6" onClick="chat.translitChat()" src="http://img.likebk.com/1x1.gif" class="db cp chatBtn6_1"></td>
        <td width="30"><img id="chbtn7" onClick="chat.soundChat()" src="http://img.likebk.com/1x1.gif" class="db cp chatBtn7_1"></td>
        <td width="5">&nbsp;</td>
        <td width="30"><img id="chbtn8" class="db cp chatBtn8_1" onClick="chat.lookSmiles()" src="http://img.likebk.com/1x1.gif"></td>
        <td width="30"><img id="chbtn8" class="cp" title="Панель быстрого доступа" onClick="fastpanel()" src="http://img.likebk.com/b___cl1.gif"></td>
        <td width="16" bgcolor="#BAB7B3"><img src="http://img.likebk.com/i/buttons/chat_explode.gif" width="16" height="30" class="db" /></td>
 
        <td width="30"><img width="30" height="30" id="qel1" oncontextmenu="_bk.mod.open('inventory'); return false;" onclick="_bk.oUrl('main.php?inv=1&rnd='+c.rnd);" onMouseOver="top.hi(this,'Инвентарь',event,0,1,1,1,'max-height:240px');" onMouseOut="top.hic();" onMouseDown="top.hic();" class="db cp" src="http://img.likebk.com/i/buttons/chatBtn13.gif"></td>
		<td width="30"><img width="30" height="30" id="qel1001" onclick="_bk.mod.open('tickets');" onMouseOver="top.hi(this,'Обратная связь',event,0,1,1,1,'max-height:240px');" onMouseOut="top.hic();" onMouseDown="top.hic();" class="db cp" src="/chatBtn22.gif"></td>
        <!-- Проверка уровня Передача предметов  -->
		<?   if($u->info['level']>7){ ?>
        	<td width="30"><img onClick="_bk.oUrl('main.php?transfer=1&rnd='+c.rnd);" onMouseOver="top.hi(this,'Передача предметов',event,0,1,1,1,'max-height:240px');" onMouseOut="top.hic();" onMouseDown="top.hic();" class="db cp" src="http://img.likebk.com/i/buttons/chatBtn16.gif"></td>
        <? } 
        else{?>
        	<td width="30"><img onClick="$('#open_modal1').click();" onMouseOver="top.hi(this,'Передача предметов',event,0,1,1,1,'max-height:240px');" onMouseOut="top.hic();" onMouseDown="top.hic();" class="db cp" src="http://img.likebk.com/i/buttons/chatBtn16.gif"></td>
        <?}
        if($u->info['level']>0){ ?>
        <td width="30"><img onClick="_bk.oUrl('main.php?alh=1&rnd='+c.rnd);" onMouseOver="top.hi(this,'Алхимики',event,0,1,1,1,'max-height:240px');" onMouseOut="top.hic();" onMouseDown="top.hic();" class="db cp" src="http://img.likebk.com/i/buttons/chatBtn9.gif"></td>
        <? } if($u->info['dealer']==1 || $u->info['admin'] == 1) {?>
		<td width="30"><img onClick="_bk.oUrl('main.php?alhp=1&rnd='+c.rnd);" class="db cp" src="http://img.likebk.com/i/buttons/chatBtn20.gif"></td>
		<?}  if($u->info['align']>=1 && $u->info['align']<2 || $u->info['admin'] == 1){ ?>
        <td width="30"><img onClick="_bk.oUrl('main.php?light=1&rnd='+c.rnd);" class="db cp" src="http://img.likebk.com/i/buttons/chatBtn15.gif"></td>
        <? } 
        if($u->info['align']>=3 && $u->info['align']<4 || $u->info['admin'] == 1){ ?>
        <td width="30"><img onClick="_bk.oUrl('main.php?dark=1&rnd='+c.rnd);" class="db cp" src="http://img.likebk.com/i/buttons/chatBtn10.gif"></td>
        <? } if($u->info['vip']>0 || $u->stats['silver']>0){ ?>
        <td width="30"><img onClick="_bk.oUrl('main.php?vip=1&rnd='+c.rnd);" onMouseOver="top.hi(this,'VIP',event,0,1,1,1,'max-height:240px');" onMouseOut="top.hic();" onMouseDown="top.hic();" class="db cp" src="http://img.likebk.com/i/buttons/chatBtn17.gif"></td>
        <? } if($u->info['level']>-1){ ?>
        <td width="30"><img onClick="_bk.oUrl('main.php?friends=1&rnd='+c.rnd);" onMouseOver="top.hi(this,'Контакты',event,0,1,1,1,'max-height:240px');" onMouseOut="top.hic();" onMouseDown="top.hic();" class="db cp" src="http://img.likebk.com/i/buttons/chatBtn12.gif"></td>
        <? } if($u->info['level']>=0){ ?>
        <td width="30"><img onClick="_bk.oUrl('main.php?notepad=1&rnd='+c.rnd);" onMouseOver="top.hi(this,'Блокнот',event,0,1,1,1,'max-height:240px');" onMouseOut="top.hic();" onMouseDown="top.hic();" class="db cp" src="http://img.likebk.com/b_notepad.gif"></td>
		<? } if($u->info['level']>-1){ ?>

        <? } if($u->info['clan']>0 || ($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4)){ ?>
        <td width="30"><img onClick="_bk.oUrl('main.php?clan=1&rnd='+c.rnd);" onMouseOver="top.hi(this,'Клан',event,0,1,1,1,'max-height:240px');" onMouseOut="top.hic();" onMouseDown="top.hic();" class="db cp" src="http://img.likebk.com/i/buttons/chatBtn14.gif"></td>
        <? } if($u->info['admin']>0 || $u->info['id'] == 581644){ ?>
        <td width="30"><img onClick="_bk.oUrl('main.php?admin=1&rnd='+c.rnd);" onMouseOver="top.hi(this,'Панель Тармана',event,0,1,1,1,'max-height:240px');" onMouseOut="top.hic();" onMouseDown="top.hic();" class="db cp" src="http://img.likebk.com/i/buttons/chatBtn19.gif"></td>
        <? }//if($u->info['admin']>0){ ?>
        <td width="30"><img onClick="_bk.oUrl('main.php?bill=1&rnd='+c.rnd);" onMouseOver="top.hi(this,'Банк',event,0,1,1,1,'max-height:240px');" onMouseOut="top.hic();" onMouseDown="top.hic();"  class="db cp" src="http://img.likebk.com/i/buttons/bill_img.gif"></td>
        <? //}?>
        <?php if(isset($_GET['bill']) && $_GET['success'] == 1){
			echo "<script>_bk.oUrl('main.php?bill=1&rnd='+c.rnd+'&success=1');</script>";
		}elseif(isset($_GET['bill']) && $_GET['success'] == 0){
			echo "<script>_bk.oUrl('main.php?bill=1&rnd='+c.rnd+'&success=0');</script>";
		}
        ?>
        <!--
        <td width="30"><img onClick="_bk.oUrl('main.php?bagreport=1&rnd='+c.rnd);" class="db cp" src="http://img.likebk.com/i/buttons/chatBtnBugs.gif"></td>
        -->
        <? //}
        //if($u->info['admin'] > 0){ ?>
	        <?php if(isset($_GET['premium']) && $_GET['premium'] == 1){
	        	echo "<script>_bk.oUrl('main.php?premium=1&rnd='+c.rnd);</script>";
	        }?>
        <td width="30"><img onClick="_bk.oUrl('main.php?premium=1&rnd='+c.rnd);" onMouseOver="top.hi(this,'LikeBK премиум',event,0,1,1,1,'max-height:240px');" onMouseOut="top.hic();" onMouseDown="top.hic();"  class="db cp" src="http://img.likebk.com/i/buttons/premium.gif"></td>
        <? //}?>
        <td width="30"><img onClick="if(confirm('Выйти из игры?')){ top.location = '/buttons.php?exit&rnd=<?=$code?>'; }" class="db cp" src="http://img.likebk.com/i/buttons/chatBtn11.gif"></td>
        <td width="82">
        	<div style="background-color:#bbb8b6; padding-left:5px; padding-right:5px; margin-top:4px; position:relative;">
            	<img src="/in/settime.png" width="8" height="8" style="position:absolute;right:11px;bottom:3px;">
            	<canvas id="clock" width="82" height="22"><font color="red"><b>--:--</b></font></canvas>
            </div>
        </td>
      </tr>
    </table>
    </td>
    <td height="30" align="right" bgcolor="#D6D6D6"><img class="db" src="http://img.likebk.com/i/lite/bkf_l_r1_06.gif" width="9" height="30"></td>
  </tr>
  <tr>
    <td height="5" bgcolor="#D6D6D6" style="background:url(http://img.likebk.com/sand_mid_31.png);"></td>
    <td height="5" bgcolor="#D6D6D6" style="background:url(http://img.likebk.com/sand_mid_31.png);"><!-- iFrames zone --></td>
    <td height="5" bgcolor="#D6D6D6" style="background:url(http://img.likebk.com/sand_mid_31.png);"></td>
  </tr>
</table>
<!-- модальное окно -->
<div id="modal1" class="modal_div">
	<!-- <span class="modal_close">х</span> -->
	<table border="0" cellspacing="0" cellpadding="0"><tbody><tr><td class="wi1s0"></td><td class="wi1s1"></td><td class="wi1s2"></td></tr><tr><td class="wi1s3"><img src="http://img.likebk.com/1x1.gif" width="5" height="1"></td><td class="wi1s7" id="win_main_iusemgnight_atack"><div class="wi1s10" onselectstart="return false">
		<table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td rowspan="2">
			<b></b>
		</td><td width="15" align="right"><img style="display:block" class="modal_close" src="http://img.likebk.com/i/clear.gif" width="13" height="13"></td></tr></tbody></table></div>
		<div style="margin:2px;min-width:300px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0"><tbody><tr><td><center>
							<div style="cursor:pointer;padding:5px;color: red;">
	 							<br><b>Персонажам младше 8 уровня вход запрещен</b><br><br>
	 						</div>
				</center></td></tr></tbody></table></div></td><td class="wi1s4"><img src="http://img.likebk.com/1x1.gif" width="5" height="1"></td></tr><tr><td class="wi1s5"></td><td class="wi1s6"></td><td class="wi1s8"><div id="win_a_iusemgnight_atack" class="wi1s9"></div></td></tr></tbody>
	</table>
</div>
<a style="display: none;" id="open_modal1" href="#modal1" class="open_modal"></a><!-- ссылкa с href="#modal1", oткрoет oкнo с  id = modal1-->
<div id="overlay"></div><!-- Пoдлoжкa, oкнa нa всю стрaницу -->
<?
if($u->info['active']!='' && $u->info['mail']!='No E-mail')
{
	$yes = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "user_active_good" LIMIT 1',1);
	$yes2 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "user_active_send" LIMIT 1',1);
	if($u->info['login'] != '-LEL-')
	{
		mysql_query('UPDATE `stats` SET `active` = "" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	}
	
	/*
	function send_mime_mail($name_from, // имя отправителя
                       $email_from, // email отправителя
                       $name_to, // имя получателя
                       $email_to, // email получателя
                       $data_charset, // кодировка переданных данных
                       $send_charset, // кодировка письма
                       $subject, // тема письма
                       $body // текст письма
                       )
	   {
	  $to = mime_header_encode($name_to, $data_charset, $send_charset)
					 . ' <' . $email_to . '>';
	  $subject = mime_header_encode($subject, $data_charset, $send_charset);
	  $from =  mime_header_encode($name_from, $data_charset, $send_charset)
						 .' <' . $email_from . '>';
	  if($data_charset != $send_charset) {
		$body = iconv($data_charset, $send_charset, $body);
	  }
	  $headers = "From: $from\r\n";
	  $headers .= "Content-type: text/plain; charset=$send_charset\r\n";
	
	  return mail($to, $subject, $body, $headers);
	}
	
	function mime_header_encode($str, $data_charset, $send_charset) {
	  if($data_charset != $send_charset) {
		$str = iconv($data_charset, $send_charset, $str);
	  }
	  return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
	}

	if(!isset($yes2['id']))
	{
		//отправляем письмо
		echo '<script>chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>На Ваш почтовый ящик <b>'.$u->info['mail'].'</b> отправлено письмо с инструкцией по активации аккаунта. (Письмо прийдти в течении 15 минут, а так-же проверьте раздел &quot;Спам&quot;)</small>","Black","1","1","0"]);</script>';
		//$u->addAction(time(),'user_active_send',$u->info['mail']);
		// получатели		
		send_mime_mail('www.likebk.com',
               'support@likebk.com',
               ''.$u->info['login'].'',
               $u->info['mail'],
               'CP1251',  // кодировка, в которой находятся передаваемые строки
               'KOI8-R', // кодировка, в которой будет отправлено письмо
               'Активация персонажа '.$u->info['login'].'',
               "Здравствуйте! Мы очень рады новому персонажу в нашем Мире! \r\n Ваш персонаж: ".$u->info['login']." [0] \r\n Ссылка для активации: http://capitalcity.likebk.com/club.php?active=".$u->info['active'].".\r\n\r\nС уважением, Администрация likebk.com!");
		$u->addAction(time(),'user_active_send',$u->info['mail']);
		
	}elseif(!isset($yes['id']))
	{
		//Пользовательское соглашение
		if(isset($_GET['active']) && $u->info['active'] == $_GET['active'])
		{
			//согласен
			$u->addAction(time(),'user_active_good',$u->info['mail']);
			mysql_query('UPDATE `stats` SET `active` = "" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			die('<script>top.location = "http://'.$c[$u->info['city']].'/club.php";</script>');
		}
	}
	*/
}
?>
<?php include('js/ie/ie.php');?>
<script>
startEngine();
/*function newchst() {
	console.log('test');
	if( typeof io == 'function' ) {
		chat.testTimer(false);
		chat.socketStart();
	}else{
		setTimeout('newchst();',500);
	}
}
window.onload = function () {
	if( typeof window.WebSocket == 'function' ) {
		//новый чат
		chat.socketchat = true;
	}else{
		//старый чат, пользователь на устаревшем браузере
	}*/
	if( chat.socketchat == false ) {
		chat.testTimer(false);
	}else{
		//newchst();
	}
//}
/*
top.add_cb(1,'--',1,'ch1','local_items');
top.add_cb(2,'Настройки',1,'ch2','chat_config');
top.add_cb(3,'Лог',1,'ch3','log');
top.add_cb(4,'Системные',1,'ch4','<br>');
top.add_cb(5,'Чат',1,'ch5','<br>');
top.open_cb(5,null);
*/
//quest.sel(document.getElementById('qel1'));
</script>

<div><img src="https://mc.yandex.ru/watch/54287436" style="position:absolute; left:-9999px;" alt="" /></div>
</body>
</html>
<?
unset($db);
?>