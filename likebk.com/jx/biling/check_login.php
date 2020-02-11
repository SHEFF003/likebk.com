<?php
defined('GAME', true);
// класс загрузки файлов 
$dbgo = mysql_connect('localhost','like','23wesdxc');
mysql_select_db('like',$dbgo);
mysql_query('SET NAMES cp1251');
/*$dbgo = mysql_connect('localhost','root','');
mysql_select_db('crazy',$dbgo);
mysql_query('SET NAMES cp1251');*/
function en_ru($txt)
{
	$g = false;
	$en = preg_match("/^(([a-zA-Z _-])+)$/i", $txt);
	$ru = preg_match("/^(([а-яА-Я _-])+)$/i", $txt);
	if(($ru && $en) || (!$ru && !$en))
	{
		$g = true;
	}
	return $g;
}
$login_new = $_GET['login_new'];
$nologin = array('ангел','angel','администрация','administration','Комментатор','Мироздатель','Мусорщик','Падальщик','Повелитель','Архивариус','Пересмешник','Волынщик','Лорд Разрушитель','Милосердие','Справедливость','Искушение','Вознесение');
$sr = '_-йцукенгшщзхъфывапролджэячсмитьбюё1234567890';
$simv = array('~','!','&','?','`','"\"', ';','#','№',',','.','"',"'");
$er = en_ru($login_new);
foreach ($nologin as $key => $value) {
	$pos = strpos($value, $login_new);
	if ($pos === false) {
		$nologi = 0;
	}else{
		$nologi = 1;
		break;
	}
}
foreach ($simv as $key => $value) {
	$pos = strpos($login_new, $value);
	if ($pos === false) {
		$nosim = 0;
	}else{
		$nosim = 1;
		break;
	}
}
if($nologi == 1 && $u->info['admin'] == 0){
	echo '<font style="font-weight: bold;" color="red">Логин занят</font>';
}else{
	//Логин от 2 до 20 символов
	if(strlen($login_new)>20) 
	{ 
		echo '<font style="font-weight: bold;" color="red">Логин должен содержать не более 20 символов.</font>'; 
	}elseif(strlen($login_new)<2) 
	{ 
		echo '<font style="font-weight: bold;" color="red">Логин должен содержать не менее 2 символов.</font>'; 
	}
	//Запрещенный символы
	elseif($nosim == 1)
	{
		echo '<font style="font-weight: bold;" color="red">Логин содержит запрещенные символы.</font>'; 
	}
	//Один алфавит
	/*elseif($er==true)
	{
		echo '<font style="font-weight: bold;" color="red">В логине разрешено использовать только буквы одного алфавита русского или английского. Нельзя смешивать.</font>';
	}*/
	elseif($login_new != ''){
		$user = mysql_query('SELECT * FROM `users`');
		while ($us = mysql_fetch_array($user)) {
			if($login_new ==  $us['login']){
				$t = 1;
				break;
			}else{
				$t = 0;
			}
		}
		if($t == 1){
			echo '<font style="font-weight: bold;" color="red">Логин занят</font>';
		}else{
			echo '<font style="font-weight: bold;" color="green">Логин свободен</font>';
		}
	}
}
?>