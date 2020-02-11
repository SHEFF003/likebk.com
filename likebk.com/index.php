<?
/*if(!isset($_COOKIE['ok_enter']) && isset($_COOKIE['login'])) {
	// unset cookies
	$past = time() - 36000000;
	foreach ( $_COOKIE as $key => $value ) {
		setcookie( $key, false, $past, '/','' );
		setcookie( $key, false, $past, '/','likebk.com' );
		//setcookie( $key, false, $past, '/','.likebk.com' );
		setcookie( $key, false, $past );
	}
	setcookie('ok_enter',time(),time()+86400,'/','');
	die('Обновите страницу и войдите на персонажа заново! <a href="/">Обновить страницу</a>');
}*/

if(isset($_GET['test'])) {
	phpinfo();
	die();
}

if(isset($_GET['server'])) {
	print_r($_SERVER);
	die();
}

if( strripos($_SERVER['HTTP_REFERER'],'combats1.com') == true ) {
	setcookie('from','combats1.com',time()+86400);
}elseif(isset($_GET['from'])) {
	setcookie('from',htmlspecialchars($_GET['from'],NULL,'cp1251'),time()+86400);
	header('location: http://likebk.com/register');
	die();
}


if( isset($_GET['code']) ) {
	header('location: /active.php?code='.htmlspecialchars($_GET['code']).'');
	die();
}

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');
if( !isset($u->info['id']) ) {
	unset($_COOKIE['login'],$_COOKIE['pass']);
}

$page = 'index';
$big_top = '';

$url = $_SERVER['REDIRECT_URL'];
$url = explode('/',$url);

if($url[1] == 'forum') {
	$page = 'forum';
}elseif($url[1] == 'events') {
	$page = 'events';
}elseif($url[1] == 'top') {
	$page = 'top';
}elseif($url[1] == 'buy') {
	$page = 'buy';
}elseif($url[1] == 'library') {
	$page = 'library';
}

if($page != 'index') {
	$big_top = '_small';
}
$isCityads = (isset($_GET['utm_source']) && ($_GET['utm_source'] == 'cityads'));
$isClick_Id = (isset($_GET['click_id']) && !empty($_GET['click_id']));
if ($isClick_Id) {
	setcookie('utm_source', $_GET['utm_source'], strtotime('+30 days'));
	setcookie('click_id', $_GET['click_id'], strtotime('+30 days'));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Бойцовский клуб игра онлайн. Браузерная современная игра БК2 - LikeBK (олдбк).</title>
<meta name="keywords" content="Бойцовский клуб, комбатс, combats, БК2, legbk, oldbk, браузерная игра, LikeBK" />
</head>
<link href="http://img.likebk.com/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://likebk.com/js/jquery.js"></script>
<script type="text/javascript" src="http://likebk.com/js/jimg.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<style>
	@font-face {
		font-family: RobotoReg;
		src: url('/images/Roboto-Regular.ttf');
	}
	@font-face {
		font-family: RobotoBold;
		src: url('/images/Roboto-Bold.ttf');
	}
	@font-face {
		font-family: RobotoSlab;
		src: url('/images/RobotoSlab-Bold.ttf');
	}
	html, body {
		width:100%;
		/*min-width: 700px;*/
		height:100%;
		min-width: 1000px;
		padding:0;
		margin:0;
		border: none;
		background: #000 url('/images/theme/likebody2.png') center top no-repeat;
	}

	.tbl{
		border: 1px solid red;
		margin: 0 auto; 
	}
	.img_body{
		position: absolute;
		height: 100%;
		width: auto;

	}
	.content{
		position: relative;
		top: 514px;
		width: 1000px;
		height: auto;
		margin: 0 auto;
	}
	.form_marg form{
		display: inline-block;
	}
	.form_log{
		background: url('/images/theme/form_log.png') no-repeat;
		width: 700px;
		height: 83px;
		line-height: 90px;
		margin: 0 auto;
		position: relative;
		top: 0px;
	}
	.form_log .form_marg{
		margin-left: 30px;
	}
	.form_log input.log_input{
		display: inline-block;
		margin-right: 10px;
		width: 160px;
		height: 37px;
		font-size: 12px;
		text-align: center;
		border-radius: 4px;
		color: #5e513c;
		background: #fff7e7;
		border: 1px solid #b1a182;
	}
	.form_log .enter-btn{
		position: relative;
		top: 3px;
		background: url('/images/theme/btn_log.png') no-repeat;
		width: 122px;
		height: 39px;
		margin-left: 10px;
		border: none;
	}
	.form_log .enter-btn:hover{
		opacity: 0.7;
		cursor: pointer;
	}
	.register-btn{
		display: inline-block;
		position: relative;
		top: 28px;
		background: url('/images/theme/btn_reg.png') no-repeat;
		width: 143px;
		height: 39px;
		margin-left: 10px;
		border: none;
	}
	.form_log .register-btn:hover{
		opacity: 0.7;
		cursor: pointer;
	}
	.menu{
		background: url('/images/theme/menu.jpg') no-repeat;
		width: 1000px;
		height: 60px;
		position: relative;
		top: 3px;
		margin: 0 auto;
	}
	.menu ul{
		padding: 0;
		margin: 0;
	}
	.menu ul li{
		display: inline-block;
		text-align: center;
		line-height: 60px;
	}
	.menu ul li a{
		text-transform: uppercase;
		font-size: 13px;
		color: #373737;
		font-family: RobotoBold;
	}
	.menu ul li a:hover{
		text-decoration: underline;
	}
	#content{
		position: relative;
		top: 0px;
		width: 940px;
		height: 220px;
		margin: 0 auto;
		padding: 20px;
		padding-left: 30px;
		padding-right: 30px;

	}  
	#content p{
		color: #fff;
		font-size: 18px;
		text-align: justify;
	    text-indent: 25px;
		font-family: "RobotoReg";
	}
	#txt_centr{
		text-align: center;
		font-size: 24px;
		color: #d0be9a;
		font-weight: bold;
		font-family: "RobotoSlab";
		padding-top: 20px;
		padding-bottom: 30px;
	}
	#txt_centr span{
		font-weight: normal;
		font-family: "Times New Roman";
	}
	@media (min-width: 1500px) {
		html, body {
			background: #000 url('/images/theme/likebody.jpg') center top no-repeat;
		}
		.content{
			top: 619px;
		}
	}
</style>
<body>
	<!-- <div class="tbl">
	<img class="img_body" src="/images/theme/body.png">
	</div> -->
	<div class="content">
		<div class="frm">
			<div class="form_log">
				<div class="form_marg">
				<form method="post" name="F1" id="F1" action="http://likebk.com/enter.php">
					<input placeholder="Логин" autocomplete="off" class="log_input login" type="text" name="login" onfocus="if ( 'Логин' == value ) { value = ''; } " onblur="if ( '' == value ) { value = 'Логин'; } " value="" />
		        	<input placeholder="Пароль" autocomplete="off" class="log_input pass" type="password" name="pass" value="" />
		        	<button class="enter-btn" onclick="loginUser();" type="submit">&nbsp;</button>
		        </form>
		        	<a class="register-btn" href="http://likebk.com/register">&nbsp;</a>
		        </div>

			</div>
			<div class="menu">
				<ul>
					<li style="width: 165px; margin-left: 8px;"><a target="_blank" href="http://likebk.com/news">Новости</a></li>
					<li style="width: 239px;"><a href="http://likebk.com/repass.php/#content">Восстановление пароля</a></li>
					<li style="width: 115px;"><a target="_blank" href="http://forum.likebk.com/">Форум</a></li>
					<li style="width: 212px;"><a target="_blank" href="http://top.likebk.com/">Рейтинг персонажей</a></li>
					<li style="width: 232px;"><a target="_blank" href="http://likebk.com/clans_inf.php?allclans">Рейтинг кланов</a></li>
				</ul>
			</div>
		</div>
		<div id="content">
			<p>«LikeBK.com - твой любимый бойцовский клуб!» – это увлекательная браузерная онлайн игра, со своим уникальным миром и населением, эпическими боями и занимательным общением. LikeBK.com - основана на лучших традициях так называемого "Старого Бойцовского Клуба" или как его еще называются "БК 2" или combats. Здесь собраны самые лучшие моменты прошлых лет, разбавленные множеством современных необходимых требовательному игроку вещей.</p>
			<p>Играть в Бойцовский клуб LikeBK можно совершенно бесплатно, вам требуется лишь доступ в интернет! Желаем Вам удачных побед и верных друзей на просторах  мира LikeBK!</p>
			<div id="txt_centr"><span>По всем вопросам обращайтесь на <a href="mailto:support@likebk.com">support@likebk.com</a></span></div>
            <div id="txt_centr">Likebk.com<span> - твой любимый бойцовский клуб!</span></div>
		</div>
	</div>	

<a style="position: absolute; left: -500px;" href="//www.free-kassa.ru/"><img src="//www.free-kassa.ru/img/fk_btn/17.png"></a>
	<!— Yandex.Metrika counter —>
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter37318475 = new Ya.Metrika({
                    id:37318475,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/37318475" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://vk.com/js/api/openapi.js?159",t.onload=function(){VK.Retargeting.Init("VK-RTRG-281274-tpG0"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script><noscript><img src="https://vk.com/rtrg?p=VK-RTRG-281274-tpG0" style="position:fixed; left:-999px;" alt=""/></noscript>
<!— /Yandex.Metrika counter —>
<?php include('js/ie/ie.php');?>
</body>
</html>
