<?

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

define('GAME',true);
include_once('_incl_data/__config.php');
include_once('_incl_data/class/__db_connect.php');
include_once('_incl_data/class/__user.php');

if(isset($_GET['list'])) {
	$i = 0;
	echo '<b>Список подозрительных вводов каптчи:</b><br><br>';
	$sp = mysql_query('SELECT * FROM `captcha_bot` WHERE `ip` != `ip_see` OR `ip` != `ip_see2` ORDER BY `id` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		echo $u->microLogin($pl['uid'],1).' - '.$pl['ip'].' (ip ввода) - '.$pl['ip_see'].' (ip просмотра) - '.$pl['ip_see2'].' (ip обработки)<br>';
		$i++;
	}
	if( $i == 0 ) {
		echo 'Список пуст.';
	}
	die();
}

$r = 'bad';
session_start();
if(isset($_SESSION['code3']) && (int)$_SESSION['code3'] > 0 && $_SESSION['code3'] == $_POST['key']) {
	if(isset($u->info['id'])) {
		mysql_query('UPDATE `captcha` SET `result` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `result` = 0');
	}
	mysql_query('INSERT INTO `captcha_bot` (`x`,`uid`,`time`,`key`,`ip`,`ip_see`,`ip_see2`) VALUES ("'.mysql_real_escape_string($_SESSION['code3_x']).'","'.$u->info['id'].'","'.time().'","'.mysql_real_escape_string($_SESSION['code3']).'","'.mysql_real_escape_string(IP).'","'.mysql_real_escape_string($_SESSION['code3_ip']).'","'.mysql_real_escape_string($_SESSION['code3_ip2']).'")');
	$r = 'good';
	$_SESSION['code3'] = false;
	$_SESSION['code3_ip'] = false;
	unset($_SESSION['code3'],$_SESSION['code3_ip'],$_SESSION['code3_ip2'],$_SESSION['code3_x']);
}

echo $r;

?>