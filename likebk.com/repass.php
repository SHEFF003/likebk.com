<?
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


$step = 1;
$error = '';

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

			function send_mime_mail($name_from, // ��� �����������
							   $email_from, // email �����������
							   $name_to, // ��� ����������
							   $email_to, // email ����������
							   $data_charset, // ��������� ���������� ������
							   $send_charset, // ��������� ������
							   $subject, // ���� ������
							   $body // ����� ������
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
			  $headers .= "Content-type: text/html; charset=$send_charset\r\n";
			
			  return mail($to, $subject, $body, $headers);
			}
			
			function mime_header_encode($str, $data_charset, $send_charset) {
			  if($data_charset != $send_charset) {
				$str = iconv($data_charset, $send_charset, $str);
			  }
			  return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
			}
			
			function send_mail($to,$to_name,$from = 'support@likebk.com',$name = '<b>���������� ����</b> 2',$title,$text) {
				send_mime_mail($name,
					   $from,
					   $to_name,
					   $to,
					   'CP1251',  // ���������, � ������� ��������� ������������ ������
					   'KOI8-R', // ���������, � ������� ����� ���������� ������
					   $title,
					   $text); // \r\n
			}
			
	if(isset($_GET['test_mail'])) {
		$to      = $_GET['test_mail'];
		$subject = 'the subject';
		$message = 'hello';
		$headers = 'From: support@likebk.com' . "\r\n" .
			'Reply-To: support@likebk.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		
		echo mail($to, $subject, $message, $headers);
		die();
	}

	if(isset($_POST['relogin'])) {
		$_POST['relogin'] = htmlspecialchars($_POST['relogin'],NULL,'cp1251');
		
		include('_incl_data/__config.php');
		define('GAME',true);
		include('_incl_data/class/__db_connect.php');
		
		$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['relogin']).'" LIMIT 1'));
		if(isset($usr['id'])) {
			
			if($usr['admin'] == 0 && $usr['banned'] == 0) {
				$step = 2;
				if(isset($_POST['redate'])) {
					//������ ���
					$lst_psw = mysql_fetch_array(mysql_query('SELECT * FROM `repass` WHERE `uid` = "'.$usr['id'].'" AND `time` > '.(time()-60*60*24).' AND `type` = "1" LIMIT 1'));
					if(isset($lst_psw['id'])) {
						$error = '�������� ������ ����� �� ����� ������ ���� � �����.';
					}elseif(str_replace('0','',$_POST['redate']) == str_replace('0','',$usr['bithday']) && ($_POST['reanswer'] == $usr['q1'] || $usr['q1'] == '')) {
						$error = '<br><br><br>������ �� ��������� &quot;'.$usr['login'].'&quot; ��� ������� ������ �� E-mail ��������� ��� �����������!<br><br><br>';
						$re = mysql_fetch_array(mysql_query('SELECT * FROM `logs_auth` WHERE `uid` = "'.$usr['id'].'" AND `type` = "0" AND `depass` != "" ORDER BY `id` DESC LIMIT 1'));
						if(!isset($re['id'])) {
							$sm = array('a','b','c','d','e','f','x','d','f','X','e','ER','XX','X');
							$re['depass'] = $sm[rand(0,12)].rand(0,9).$sm[rand(0,12)].rand(0,9).$sm[rand(0,12)].rand(0,9).$sm[rand(0,12)].rand(0,9).$sm[rand(0,12)].rand(0,9);
							//$error = '�������� �������� �� ��������.<br>������ �� ���������: </b>'.$re['depass'].'<b>';
						}else{
							//$error = '�������� �������� �� ��������.<br>������ �� ���������: </b>'.$re['depass'].'<b>';
						}
						$title = '�������������� ������ �� "'.$usr['login'].'".';
						$txt   = '������ ����.<br>';
						$txt  .= '� IP-������ - <b>'.IP.'</b>, ��� �������� ������ ��� ������ ���������.<br>���� ��� �� ��, ������ ������� ��� ������.<br><br>';
						$txt  .= '��� �����: <b>'.$usr['login'].'</b><br>';
						$txt  .= '��� ������: '.$re['depass'].'<br><br>';
						$txt  .= '�������� �� ������ ������ �� �����.<br><br>';
						$txt  .= '� ���������,<br>';
						$txt  .= 'Likebk.com - ���� ������� ���������� ����!';
						
						//if(send_mail($urs['mail'],$urs['login'],'support@likebk.com','��2 - Support',$title,$txt)) {		
						if(send_mime_mail('Likebk.com - ���� ������� ���������� ����!',
						   'support@likebk.com',
						   ''.$usr['login'].'',
						   $usr['mail'],
						   'CP1251',  // ���������, � ������� ��������� ������������ ������
						   'KOI8-R', // ���������, � ������� ����� ���������� ������
						   $title,
						   $txt))
						{				
							//mysql_query('UPDATE `users` SET `allLock`="'.(time()+60*60*24).'",`pass` = "'.mysql_real_escape_string(md5($re['depass'])).'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
							mysql_query('UPDATE `users` SET `pass` = "'.mysql_real_escape_string(md5($re['depass'])).'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
							mysql_query('INSERT INTO `repass` (`uid`,`ip`,`type`,`time`) VALUES ("'.$usr['id'].'","'.mysql_real_escape_string(IP).'","1","'.time().'")');
							$step = 3;							
						}else{							
							$error = '�� ������� ��������� ���������. ���������� �����.';							
						}
		
					}else{
						$error = '������� ������ ���� ��������.';
					}
				}
			}else{
				$error = '��������� "'.$_POST['relogin'].'" ��������� ������� ������!';
			}
		}else{
			$error = '����� "'.htmlspecialchars($_POST['relogin'],NULL,'cp1251').'" �� ������ � ����.';
		}
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>LikeBk ���������� ���� - �������������� ������ �� ���������</title>
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
	.rep_pass{
		width: 350px;
		margin: 0 auto;
	}
	.rep_pass p{
		text-align: center!important;
		text-indent: 0px!important;
	}
	.inp_rep{
		width: 150px;
		margin: 0 auto;
    	display: block;
	}
	.testro{
		color: #fff;
		text-align: justify;
	}
	.btn_repa{
		margin: 0 auto;
		display: block!important;
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
					<input placeholder="�����" autocomplete="off" class="log_input login" type="text" name="login" onfocus="if ( '�����' == value ) { value = ''; } " onblur="if ( '' == value ) { value = '�����'; } " value="" />
		        	<input placeholder="������" autocomplete="off" class="log_input pass" type="password" name="pass" value="" />
		        	<button class="enter-btn" onclick="loginUser();" type="submit">&nbsp;</button>
		        </form>
		        	<a class="register-btn" href="http://likebk.com/register">&nbsp;</a>
		        </div>

			</div>
			<div class="menu">
				<ul>
					<li style="width: 165px; margin-left: 8px;"><a target="_blank" href="http://likebk.com/news">�������</a></li>
					<li style="width: 239px;"><a href="http://likebk.com/repass.php/#content">�������������� ������</a></li>
					<li style="width: 115px;"><a target="_blank" href="http://forum.likebk.com/">�����</a></li>
					<li style="width: 212px;"><a target="_blank" href="http://top.likebk.com/">������� ����������</a></li>
					<li style="width: 232px;"><a target="_blank" href="http://likebk.com/clans_inf.php?allclans">������� ������</a></li>
				</ul>
			</div>
		</div>
		<div id="content">
			<p style="font-size: 26px;text-align: center"><b>������ ������ �� ������ ���������?</b></p>
	          <center><?
	          if($error != '') {
			  	echo '<font color="red"><b>'.$error.'</b></font>';
			  }
			  ?></center>
	          <form class="rep_pass" method="post" action="http://likebk.com/repass.php/#content">
	         <?
			    if($step == 1){ ?>
					<p>������� ����� ���������:</p>
					<input class="inp_rep" onfocus="if ( '�����' == value ) { value = ''; } " onblur="if ( '' == value ) { value = '�����'; } " value="�����" maxlength="40" style="padding:3px" name="relogin" type="text" class="inup" id="relogin"><br>
	                <input type="submit" class="btn_repa" value="������� � ���������� ����">
	            <? }elseif($step == 2){ ?>
	                <p>����� ���������:</p>
	                <input class="inp_rep" value="<?=$_POST['relogin']?>" disabled maxlength="40" style="padding:3px" type="text" class="inup"><input type="hidden" name="relogin" value="<?=$_POST['relogin']?>">
					<p>��� ���� ��������:</p>
					<input class="inp_rep" value="<?=$_POST['redate']?>" name="redate" maxlength="10" style="padding:3px" type="text" class="inup">
                    <p><small>(���� �������� �� ��������� ��� ����������� ��������� � ������� dd.mm.yyyy)</small></p>
                    
	                <input type="button" class="btn_repa" onclick="top.location.href='http://likebk.com/repass.php'" class="" value="���������">
	                <input type="submit" class="btn_repa" value="������� ������ �� E-mail">
	            <? } ?>
	            </form>
	            <br><br><br><br>
<div id="txt_centr">Likebk.com<span> - ���� ������� ���������� ����!</span></div>
		</div>
	</div>	
	<!� Yandex.Metrika counter �>
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
<!� /Yandex.Metrika counter �>
</body>
</html>

