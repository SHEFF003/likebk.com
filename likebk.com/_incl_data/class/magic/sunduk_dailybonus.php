<?php 
if(!defined('GAME'))
{
	die();
}
if($tr['var_id'] == 1) {
	//свиток зашиты от магии
	$re = $this->addItem(5122, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Чек 0.1екр
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	if($io == '') {
		$io = 'Свиток зашиты от магии + Чек на 0.1 екр.';	
	}
}elseif($tr['var_id'] == 2) {
	//свиток защиты от оружия
	$re = $this->addItem(1001, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Чек 0.1екр
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Чек 0.1екр
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	if($io == '') {
		$io = 'Свиток зашиты от магии + Чек на 0.1 екр.(2шт)';	
	}
}
elseif($tr['var_id'] == 3) {
	//Жажда Жизни +5
	$re = $this->addItem(3102, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Чек 0.1екр
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Чек 0.1екр
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Чек 0.1екр
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	if($io == '') {
		$io = 'Жажда Жизни +5 + Чек на 0.1 екр.(3шт)';	
	}
}
elseif($tr['var_id'] == 4) {
	//Нектар неуязвимости
	$re = $this->addItem(2139, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Чек 0.1екр
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Чек 0.1екр
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Чек 0.1екр
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Чек 0.1екр
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	if($io == '') {
		$io = 'Нектар неуязвимости + Чек на 0.1 екр.(4шт)';	
	}
}
elseif($tr['var_id'] == 5) {
	//нектар отрицания
	$re = $this->addItem(2140, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Чек 0.5екр
	$re = $this->addItem(5094, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	if($io == '') {
		$io = 'Нектар отрицания + Чек на 0.5 екр.(1шт)';	
	}
}
elseif($tr['var_id'] == 6) {
	//бутерброд из березки
	$re = $this->addItem(5106, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Чек 0.2екр
	$re = $this->addItem(5093, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Чек 0.2екр
	$re = $this->addItem(5093, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Чек 0.2екр
	$re = $this->addItem(5093, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	if($io == '') {
		$io = 'Бутерброд -The Best Friend + Чек на 0.2 екр.(3шт)';	
	}
}
?>