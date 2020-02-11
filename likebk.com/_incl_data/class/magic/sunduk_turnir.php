<?php 
if(!defined('GAME'))
{
	die();
}
if($tr['var_id'] == 1) {

	//Случайный комплект
	$vg = array(
		'Night Demon',
		'Gold Scorpion',
		'Steel Wolf',
		'Steel Tiger',
		'Ice Power',
		'Fire Power',
		'Air Power',
		'Earth Power'
	);
	$vg = $vg[rand(0,count($vg)-1)];
	$vsp = mysql_query('SELECT * FROM `items_main` WHERE `name` LIKE "%'.$vg.'%" ORDER BY `type` ASC');
	while( $vpl = mysql_fetch_array($vsp) ) {
		$vj = 1;
		if( $vpl['inslot'] == 10 ) {
			$vj = 3;
		}elseif( $vpl['inslot'] == 3 ) {
			$vj = 2;
		}
		while( $vj > 0 ) {
			$re = $this->addItem($vpl['id'],$this->info['id'],'|srok='.(3600*5).'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
			if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Организатор Турниров" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			$vj--;
		}
	}
	
	//Рандомный эликсир на статы (гос)
	$vg = array(
		870 , 871 , 872 , 873
	);
	$vg = $vg[rand(0,count($vg)-1)];
	$re = $this->addItem($vg,$this->info['id'],'|srok='.(3600*5).'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Организатор Турниров" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	
	//Хилка 600 НР
	$re = $this->addItem(4016,$this->info['id'],'|srok='.(3600*5).'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "Организатор Турниров" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	
}
?>