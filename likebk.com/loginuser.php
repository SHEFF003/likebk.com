<script type="text/javascript">
		function loginUser(){
			$.ajax({
				type: "POST",
				url: "/loginuser.php",
				data: $('form').serialize(),
				success: function(data){
					if(data == "ok"){
						document.location.href = "/buttons.php";
					}
					else{
						alert(data);
					}
				}	
			});
		};
		
	</script>
<?php
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

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__chat_class.php');

session_start();
$users = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login`="'.mysql_real_escape_string($_POST['login']).'" AND `pass`="'.md5($_POST['pass']).'" ORDER BY `id` ASC LIMIT 1'));
if($users){
	echo "ok";
	setcookie('login',$_POST['login'],0,'',$c['host']); // вместо аргумента 0 тут было time()+60*60*24*7
	setcookie('pass',md5($_POST['pass']),0,'',$c['host']); // вместо аргумента 0 тут было time()+60*60*24*7
	setcookie('login',$_POST['login'],0); // вместо аргумента 0 тут было time()+60*60*24*7
	setcookie('pass',md5($_POST['pass']),0); // вместо аргумента 0 тут было time()+60*60*24*7
	setcookie('ip',IP,0,''); // вместо аргумента 0 тут было time()+60*60*24*150
}
else{
$u = mysql_fetch_array(mysql_query('SELECT `u`.`pass2`,`u`.`id`,`u`.`auth`,`u`.`login`,`u`.`pass`,`u`.`city`,`u`.`ip`,`u`.`ipreg`,`u`.`online`,`u`.`banned`,`u`.`admin`,`u`.`host_reg` FROM `users` AS `u` WHERE `u`.`login`="'.mysql_real_escape_string($_POST['login']).'" ORDER BY `id` ASC LIMIT 1'));

if(!isset($u['id']))
{
	echo 'Логин "'.$_POST['login'].'" не найден в базе.';
}elseif($u['pass']!=md5($_POST['pass']))
{
	echo 'Неверный пароль к персонажу "'.$_POST['login'].'".';
	mysql_query("INSERT INTO `logs_auth` (`uid`,`ip`,`browser`,`type`,`time`,`depass`) VALUES ('".$u['id']."','".mysql_real_escape_string(IP)."','".mysql_real_escape_string($_SERVER['HTTP_USER_AGENT'])."','3','".time()."','".mysql_real_escape_string($_POST['pass'])."')");
}elseif($u['banned']>0)
{
	echo 'Персонаж <b>'.$_POST['login'].'</b> заблокирован.';
}
}
?>