<?
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

if($u->info['admin'] > 0 || $u->info['id'] == 2015578) {
	$txt = 'Открыта регистрация в турнир Бешеных 7рок ССЫЛКА ! Окончание регистрации в воскресенье в 15.00!';
	if(isset($_POST['text'])) {
		$txt = htmlspecialchars($_POST['text'],NULL,'cp1251');
		$txt = str_replace("'",'&quot;',$txt);
		$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `chat` WHERE `time` > "'.(time()-1800).'" AND `ip` = "t'.$u->info['id'].'" LIMIT 1'));
		if(isset($test['id']) && $u->info['admin'] == 0) {
			echo '<div><font color=red>Слишком часто отправляешь сообщения!</font></div>';
		}else{
			mysql_query("INSERT INTO `chat` (
				`invis`, `dn`, `login`, `to`, `city`, `room`, `effect`, `time`, `type`, `spam`, `text`, `toChat`, `color`, `typeTime`, `sound`, `global`, `delete`, `new`, `ip`, `molch`, `da`, `jalo`, `active`, `frv`
			) VALUES (
				0, 0, '', '', 'capitalcity', 0, '', ".time().", 6, 0, ' <marquee style=display:inline-block;width:50px; >Конкурс</marquee> <b>".mysql_real_escape_string($txt)."</b> ', 0, 'green', 0, 0, 0, 0, 1, 't".$u->info['id']."', 0, 1, 0, 0, NULL
			);");
		}
	}
?>
<form method="post" action="/tochat.php" style="text-align:center;">
  Отправить системное сообщение в чат (не чаще 1 раза в 30 минут):<br><br>
  <input type="text" name="text" id="text" value="<?=$txt?>" style="width:80%;">
  <input type="submit" name="button" id="button" value="Отправить">
</form>
<?
}else{
	header('location: /index.php');
}

?>