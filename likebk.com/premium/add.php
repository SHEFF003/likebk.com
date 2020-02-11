<?php 
	define('GAME',true);

	include('../_incl_data/__config.php');
	include('../_incl_data/class/__db_connect.php');
	include('../_incl_data/class/__user.php');


	$price1 = array('1'=>'1.49','2'=>'4.99');
	$price2 = array('1'=>'2.99','2'=>'9.99');
	$price3 = array('1'=>'4.49','2'=>'14.99');
	$time = array('1'=>'604800','2'=>'2592000');
	$bonusT = $time[$_POST['price']];
	
	
	if($_POST['type'] == 1){
		$price = $price1[$_POST['price']];
		$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "433"'));
		$bonus = array(
			"name"=>"LikeBk Bronze",
			"speed_Loc" => "10",
			"speedHp" => "50",
			"speedMp" => "50",
			"addExp" => "25",
			"addRep" => "10",
			"ym_delay"=>"10",
			"yv_drop"=>"0",
			"speed_dunger"=>"10",
			"mfza"=>"3",
			"mf_yron"=>"3",
			"sale_prc"=>"93",
			"saleEkr_prc"=>"93",
			"Exp_zver"=>"25"
			);
	}elseif($_POST['type'] == 2){
		$price = $price2[$_POST['price']];
		$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "434"'));
		$bonus = array(
			"name"=>"LikeBk Silver",
			"speed_Loc" => "20",
			"speedHp" => "100",
			"speedMp" => "100",
			"addExp" => "50",
			"addRep" => "30",
			"ym_delay"=>"30",
			"yv_drop"=>"0",
			"speed_dunger"=>"30",
			"mfza"=>"5",
			"mf_yron"=>"5",
			"sale_prc"=>"95",
			"saleEkr_prc"=>"95",
			"Exp_zver"=>"50"
			);
	}elseif($_POST['type'] == 3){
		$price = $price3[$_POST['price']];
		$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "435"'));
		$bonus = array(
			"name"=>"LikeBk Gold",
			"speed_Loc" => "30",
			"speedHp" => "150",
			"speedMp" => "150",
			"addExp" => "100",
			"addRep" => "50",
			"ym_delay"=>"50",
			"yv_drop"=>"2",
			"speed_dunger"=>"50",
			"mfza"=>"10",
			"mf_yron"=>"10",
			"sale_prc"=>"100",
			"saleEkr_prc"=>"100",
			"Exp_zver"=>"100"
			);
	}

	$money = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$u->info['id'].'"'));
	if($money['money2'] < $price){
		echo "У Вас недостаточно средств";
	}
	else{
		mysql_query('UPDATE `bank` SET `money2` = `money2` - "'.$price.'" WHERE `uid` = "'.$u->info['id'].'"');
		$res = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$u->info['id'].'"'));
		if($res['id']){
			$ins = mysql_query('UPDATE `premium` SET 
				`name` = "'.$bonus['name'].'",
				`type` = "'.$_POST['type'].'",
				`time_delete` = "'.(time()+$bonusT).'",
				`speed_Loc` = "'.$bonus['speed_Loc'].'",
				`speedHp` = "'.$bonus['speedHp'].'",
				`speedMp` = "'.$bonus['speedMp'].'",
				`addExp` = "'.$bonus['addExp'].'",
				`addRep` = "'.$bonus['addRep'].'",
				`ym_delay` = "'.$bonus['ym_delay'].'",
				`yv_drop` = "'.$bonus['yv_drop'].'",
				`speed_dunger` = "'.$bonus['speed_dunger'].'",
				`mfza` = "'.$bonus['mfza'].'",
				`mf_yron` = "'.$bonus['mf_yron'].'",
				`sale_prc` = "'.$bonus['sale_prc'].'",
				`saleEkr_prc` = "'.$bonus['saleEkr_prc'].'",
				`Exp_zver` = "'.$bonus['Exp_zver'].'",
				`money` = "'.$price.'" 
				WHERE `uid` = "'.$u->info['id'].'"');
		}
		else{
			
			$ef_us_last = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.mysql_real_escape_string($u->info['id']).'" AND `name` = "'.mysql_real_escape_string($eff['mname']).'" AND `delete` = "0" AND `overType` = "777"'));
			if(isset($ef_us_last['timeUse'])) {
				$ef_us_last = $ef_us_last['timeUse'] - time();
				if( $ef_us_last < 1 ) {
					$ef_us_last = 0;
				}
			}
			
			$ins = mysql_query('INSERT INTO `premium` SET 
				`name` = "'.$bonus['name'].'",
				`uid` = "'.$u->info['id'].'", 
				`type` = '.$_POST['type'].',
				`time_delete` = "'.(time()+$bonusT+$ef_us_last).'",
				`speed_Loc` = "'.$bonus['speed_Loc'].'",
				`speedHp` = "'.$bonus['speedHp'].'",
				`speedMp` = "'.$bonus['speedMp'].'",
				`addExp` = "'.$bonus['addExp'].'",
				`addRep` = "'.$bonus['addRep'].'",
				`ym_delay` = "'.$bonus['ym_delay'].'",
				`yv_drop` = "'.$bonus['yv_drop'].'",
				`speed_dunger` = "'.$bonus['speed_dunger'].'",
				`mfza` = "'.$bonus['mfza'].'",
				`mf_yron` = "'.$bonus['mf_yron'].'",
				`sale_prc` = "'.$bonus['sale_prc'].'",
				`saleEkr_prc` = "'.$bonus['saleEkr_prc'].'",
				`Exp_zver` = "'.$bonus['Exp_zver'].'",
				`money` = '.$price.' ');		
		}
		if($ins){
			
			$ef_us_last = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.mysql_real_escape_string($u->info['id']).'" AND `name` = "'.mysql_real_escape_string($eff['mname']).'" AND `delete` = "0" AND `overType` = "777"'));
			if(isset($ef_us_last['timeUse'])) {
				$ef_us_last = $ef_us_last['timeUse'] - time();
				if( $ef_us_last < 1 ) {
					$ef_us_last = 0;
				}
			}
	
			$ef_us = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = '.$u->info['id'].' AND `delete` = "0" AND `overType` = "777"'));
			if($ef_us['overType'] == 777)
			{
				//убираем прошлые эффекты
				$goodUse = 0;
				$upd1 = mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `overType` = "777" AND `delete` = "0"');
				if($upd1)
				{
					$goodUse = 1;
				}
			}
			mysql_query('INSERT INTO `eff_users` (`uid`,`id_eff`,`data`,`name`,`overType`,`timeUse`,`x`,`no_Ace`) VALUES ("'.$u->info['id'].'","'.$eff['id2'].'","'.$eff['mdata'].'","'.$eff['mname'].'","777","'.(time()+$bonusT+$ef_us_last).'","1","1")');
			echo "Поздравляем! Вы успешно купили премиум аккаунт: ".$bonus['name'];
		}
		else{
			echo "Ошибка";
		}
	}
?>