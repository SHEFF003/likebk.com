<?
if(isset($s[1]) && $s[1] == '10/port') {
  
  
  	//port x-15, y40
	
	/*if($u->rep['repsuncity'] > 9999) {
		mysql_query('UPDATE `stats` SET `x` = -15, `y` = 40 WHERE `id` = '.$u->info['id'].' LIMIT 1');
		header('Location:main.php');
		die();
	}else{
		$tr_rep = 10000;
		$repsuncity = $tr_rep - $u->rep['repsuncity'];
		$r = 'Спуск на 3 этаж доступен рыцарям с первого круга!<br><br><font color=green><b>Не хватает репутации до первого круга: '.$repsuncity.'</font></b>';
	}*/
	$r = 'Спуск временно не работает...';
}
?>