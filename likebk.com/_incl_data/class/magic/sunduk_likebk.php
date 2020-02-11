<?php 
if(!defined('GAME'))
{
	die();
}

if( $tr['var_id'] == 101 ) {
	
	$itms = array(10126,10127,10128,10129);
	
	$i = 0;
	while( $i < count($itms) ) {
		$re = $this->addItem($itms[$i],$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
		if( $re > 0 ) {
			mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
		}
		$i++;
	}

}elseif($tr['var_id'] == 10 ) {

	$re = $this->addItem(10126,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	
	$re = $this->addItem(10127,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	
	$re = $this->addItem(10128,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	
	$re = $this->addItem(10129,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	
	$re = $this->addItem(10131,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	
	$re = $this->addItem(10133,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	
	$re = $this->addItem(10135,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	
	$re = $this->addItem(10137,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	
	$re = $this->addItem(10144,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}

}elseif($tr['var_id'] == 1) {

//Эликсиры

	//5122
	$re = $this->addItem(5122,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//5123
	$re = $this->addItem(5123,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Зелье Жизни
	$re = $this->addItem(4702,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Зелье маны
	$re = $this->addItem(5108,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Нектар неуязвимости
	$re = $this->addItem(2139,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Нектар отрицания
	$re = $this->addItem(2140,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Нападение
	$re = $this->addItem(865,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Жажада жизни +5
	$re = $this->addItem(3102,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Защита от оружия
	$re = $this->addItem(1001,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Холодный разум
	$re = $this->addItem(1460,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Сокрушение
	$re = $this->addItem(994,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Нектар Великана
	$re = $this->addItem(4037,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Нектар предчувствия
	$re = $this->addItem(4038,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Нектар Разума
	$re = $this->addItem(4039,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Нектар змеи
	$re = $this->addItem(4040,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//Бутерброд
	$re = $this->addItem(5106,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
	}

}
?>