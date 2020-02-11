<?php

//die('Скоро мы заработаем!');

/*
if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '' ) {
	$tst = explode('/',$_SERVER['HTTP_REFERER']);
	if($tst[2] != 'likebk.com' && $tst[2] != 'top.likebk.com' && $tst[2] != 'forum.likebk.com') {
		die();
	}
}
*/

/*if( $_COOKIE['test'] != 1 ) {
	//die('Ожидайте. Идет установка нового оборудования. (Примерное время окончания 00:30)');
	//die('Попробу чуть позже');
	//die( 'Игра остановлена примерно до 14:00 (по серверу) для обновления. Приносим извинение за доставленные неудобства / / /<br>Время сервера: '.date('H:i:s').'' );
}*/

//die('Игра остановлена на 5 минут. (Ведутся работы с базой)');

if(isset($_GET['buy'])) {
	session_start();
	$time = microtime(true);
	$time = time()+1;
	if($_SESSION['shoptime'] >= time()) {
		unset($_GET['buy']);
	}else{
		$_SESSION['shoptime'] = $time;
	}
}elseif(date('m') > 7) {
	session_start();
	$time = microtime(true)+1;
	if($_SESSION['shoptime'] >= time()) {
		$_SESSION['shoptime'] = $time;
	}
}elseif( isset($_GET['takeall']) || isset($_POST['takeall']) || isset($_POST['use_pid']) || isset($_GET['use_pid']) || isset($_POST['buy']) || isset($_POST['item']) || isset($_POST['itm']) || isset($_GET['buy']) || isset($_GET['item']) || isset($_GET['itm']) ) {
	session_start();
	$time = microtime(true)+1;
	if($_SESSION['shoptime'] >= time()) {
		unset($_POST['takeall'],$_GET['takeall'],$_POST['use_pid'],$_GET['use_pid'],$_GET['buy'],$_GET['item'],$_GET['itm'],$_POST['buy'],$_POST['item'],$_POST['itm']);
	}else{
		$_SESSION['shoptime'] = $time;
	}
}


//require_once('redbean.php');
if(!defined('GAME'))
{
	die();
}

//die('Идут работы по оптимизации, 1 мин.');

if( date('d.m.Y H') == '18.09.2016 00' ) {
	die('Технические работы на сервере. (Приблизительно до 01:00 по МСК)');
}

//sleep(1);

/*session_start();
if($_SESSION['tbl'] > time()) {
	unset(
		$_POST['buy'] , $_POST['item'] , $_GET['buy'] , $_GET['item'] , $_GET['itm']
	);
}else{
	$_SESSION['tbl'] = time() + 0.500;
}*/

$dbgo2 = mysql_connect('localhost','like','23wesdxc');
mysql_select_db('like_delo',$dbgo2);
mysql_query('SET NAMES cp1251');

//if(isset($_GET['exp1991'])) {
	//$sp = mysql_query('SELECT * FROM `items_users2`');
	//while( $pl = mysql_fetch_array($sp) ) {
		//mysql_query('UPDATE `items_users` SET `bexp` = "'.$pl['bexp'].'" , `blvl` = "'.$pl['blvl'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		//echo $pl['id'].'<br>';
	//}
	//die();
//}

/*$dbgo = mysql_pconnect('136.243.33.173','likebkdbmain','S8a7E4x1');
mysql_select_db('likebkdbmain',$dbgo);
mysql_query('SET NAMES cp1251');*/
/*$dbgo = mysql_connect('localhost','root','');
mysql_select_db('crazy',$dbgo);
mysql_query('SET NAMES cp1251');*/

// // ORM
// R::setup('mysql:host=localhost;dbname=crazy;charset=cp1251;','root', '');
// R::freeze(true);
// R::exec('SET NAMES cp1251');

if( $_COOKIE['login'] == 'Roger' || $_COOKIE['login'] == 'zloialex' || $_COOKIE['login'] == 'орисай' || $_COOKIE['login'] == 'fly' ) {
	//die();
}

if(isset($_GET['test50'])) {
	print_r($_COOKIE);
	die();
}



//if( $_SERVER['SCRIPT_NAME'] != '/main.php' && $_SERVER['SCRIPT_NAME'] != '/online.php' && $_SERVER['SCRIPT_NAME'] != '/jx/battle/refresh.php'  ) { 
	/*mysql_query('INSERT INTO `files_look` (`ip`,`user`,`ref`,`time`,`file`,`url`,`get`,`post`) VALUES (
		"'.mysql_real_escape_string($ipban).'","'.mysql_real_escape_string($_COOKIE['login']).'"
		,"'.mysql_real_escape_string($_SERVER['HTTP_REFERER']).'","'.time().'"
		,"'.mysql_real_escape_string($_SERVER['SCRIPT_NAME']).'"
		,"'.mysql_real_escape_string($_SERVER['REQUEST_URI']).'",
		"'.mysql_real_escape_string(json_encode($_GET)).'",
		"'.mysql_real_escape_string(json_encode($_POST)).'"
		
	)');*/
	
//}




$ipbant = mysql_fetch_array(mysql_query('SELECT * FROM `block_ip` WHERE `ip` = "'.mysql_real_escape_string($ipban).'" OR `ip` = "'.mysql_real_escape_string($_COOKIE['ip']).'" LIMIT 1'));
if(isset($ipbant['id']) || isset($_GET['ipban'])) {
	echo 'Ваш ip %<b>'.$ipban.'</b> заблокирован. Код блокировки: '.$ipban['id'].'<br>По всем возникшим вопросам обращайтесь по эл.почте: support@likebk.com';
	die();
}
unset($ipbant);
