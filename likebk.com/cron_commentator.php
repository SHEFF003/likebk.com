<?php
define('GAME',true);

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

/*$text_com = '';

	$sp_all = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `a_com_anekdot`'));
	$sp_all = rand(1,$sp_all[0]);
	$sp_all = mysql_fetch_array(mysql_query('SELECT * FROM `a_com_anekdot` WHERE `id` = "'.$sp_all.'" LIMIT 1'));
	if(isset($sp_all['id'])) {
		$text_com = $sp_all['text'];
		$text_com = str_replace("<br>","<br>&nbsp; &nbsp; ",$text_com);
		$text_com = str_replace("<br />","<br />&nbsp; &nbsp; ",$text_com);
		$text_com = str_ireplace("\r\n","",$text_com);
		$text_com = str_replace("
","",$text_com);
		$text_com = '<font color=red><b>Анекдот</b></font>:<br>&nbsp; &nbsp; '.$text_com.'<br>';
	}
	//mysql_query('INSERT INTO `a_com_act` (`act`,`time`,`uid`) VALUES ("0","'.(time()+60).'","'.$u->info['id'].'")');
if($text_com != '') {
	mysql_query('INSERT INTO `chat` (`text`,`login`,`to`,`city`,`room`,`type`,`time`,`new`) VALUES ("'.$text_com.'","Комментатор","","'.$u->info['city'].'","'.$u->info['room'].'","2","'.time().'","1")');
}*/

$text_com2 = '<font color=red><b>Внимание!</b></font> У нас проходит народное голосование «человек года LikeBK»! Подробности на <a href=http://forum.likebk.com/index.php?read=11281&rnd=1 target=_blank >форуме</a></i>';
//$text_com2 = '<font color=red><b>Внимание!</b></font> Напоминаем, что у нас проходит конкурс «реферальная гонка»! Подробности на <a href=http://forum.likebk.com/index.php?read=2151&rnd=1 target=_blank >форуме</a></i>';
mysql_query('INSERT INTO `chat` (`text`,`login`,`to`,`city`,`room`,`type`,`time`,`new`) VALUES ("'.$text_com2.'","","","capitalcity","9","2","'.time().'","1")');
/*echo $u->info['login'];
$text_com2 = '<font color=red><b>Внимание!</b></font> В <i><a href=http://likebk.com/news target=_blank >новостную ленту</a></i> добавлена новая новость!';
mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$text_com2."','-1','6','0')");*/
/*$text_com2 = '<font color=red><b>Внимание!</b></font> В <i><a href=http://likebk.com/news target=_blank >новостную ленту</a></i> добавлена новая новость!';
mysql_query('INSERT INTO `chat` (`text`,`login`,`to`,`city`,`room`,`type`,`time`,`new`) VALUES ("'.$text_com2.'","","","capitalcity","9","2","'.time().'","1")');*/
?>