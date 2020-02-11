<?php 
if(!defined('GAME'))
{
	die();
}
if($tr['var_id'] == 1) {
	//Чек на 100 екр
	$re = $this->addItem(4512,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1|notransfer=1',NULL,0);
	if( $re > 0 ) {
		mysql_query("INSERT INTO `users_ico` (`uid`, `time`, `text`, `img`, `endTime`, `bonus`, `href`, `type`, `x`) VALUES (".$this->info['id'].", ".time().", '<b>Пасха</b>`2017<br>Участник конкурса!', 'pasha3.png', ".(time()+365*86400).", '', '#', 1, 1);");
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}

}elseif($tr['var_id'] == 2) {
	//Чек на 35 екр
	$re = $this->addItem(8017,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1|notransfer=1',NULL,0);
	if( $re > 0 ) {
		mysql_query("INSERT INTO `users_ico` (`uid`, `time`, `text`, `img`, `endTime`, `bonus`, `href`, `type`, `x`) VALUES (".$this->info['id'].", ".time().", '<b>Пасха</b>`2017<br>Участник конкурса!', 'pasha2.png', ".(time()+365*86400).", '', '#', 1, 1);");
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}

}elseif($tr['var_id'] == 3) {
	//Чек на 20 екр
	mysql_query("INSERT INTO `users_ico` (`uid`, `time`, `text`, `img`, `endTime`, `bonus`, `href`, `type`, `x`) VALUES (".$this->info['id'].", ".time().", '<b>Пасха</b>`2017<br>Участник конкурса!', 'pasha1.png', ".(time()+365*86400).", '', '#', 1, 1);");
	$re = $this->addItem(8018,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1|notransfer=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}

}elseif($tr['var_id'] == 4) {
	//Чек на 1 екр
	mysql_query("INSERT INTO `users_ico` (`uid`, `time`, `text`, `img`, `endTime`, `bonus`, `href`, `type`, `x`) VALUES (".$this->info['id'].", ".time().", '<b>Пасха</b>`2017<br>Участник конкурса!', 'pasha1.png', ".(time()+365*86400).", '', '#', 1, 1);");
	$re = $this->addItem(5095,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1|notransfer=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}

}
?>