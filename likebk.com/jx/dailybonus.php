<?php
define('GAME',true);

/*echo strtotime('now 00:00:00').'<br>';
echo date("Y-m-d H:i:s", strtotime('now 00:00:00'));*/

include('../_incl_data/class/__db_connect.php');
include('../_incl_data/class/__user.php');
?>
<style type="text/css">
	#wrapper {
	    margin-bottom: 20px;
	    padding-top: 5px;
	}
	.button{
	     display: block;
	     width: 165px;
	     margin: 10px auto;
		 text-decoration:none; 
		 text-align:center; 
		 padding:5px 5px; 
		 border:solid 1px #007300; 
		 -webkit-border-radius:8px;
		 -moz-border-radius:8px; 
		 border-radius: 8px; 
		 font:16px Arial, Helvetica, sans-serif; 
		 font-weight:bold; 
		 color:#fff!important; 
		 background-color:#43a824; 
		 background-image: -moz-linear-gradient(top, #43a824 0%, #1a5707 100%); 
		 background-image: -webkit-linear-gradient(top, #43a824 0%, #1a5707 100%); 
		 background-image: -o-linear-gradient(top, #43a824 0%, #1a5707 100%); 
		 background-image: -ms-linear-gradient(top, #43a824 0% ,#1a5707 100%); 
		 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1a5707', endColorstr='#1a5707',GradientType=0 ); 
		 background-image: linear-gradient(top, #43a824 0% ,#1a5707 100%);   
		 -webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff; 
		 -moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 1px #ffffff;  
		 box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;    
	}
	.button:hover{
		color:#E5FFFF!important;
		opacity: 0.8; 
	}
</style>
<div style="float: right; width: 210px;">
  <INPUT type='button' value='Обновить' onclick='location="/main.php?dailybonus=1"';'>
&nbsp;<INPUT TYPE=button value="Вернуться" onclick='location="/main.php"'>
</div>
<div id="wrapper">
<h3 style="font-size: 24px; font-weight: bold; padding: 20px; padding-bottom: 0px; margin-bottom: 10px; text-align: center;">Получи свою награду за ежедневное испытание!</h3>
<div style="text-align: center; font-family: Arial; line-height: 24px;">
<span style="font-size: 16px; font-weight: bold;">Выполняй испытание каждый день и получи бонус за 7 дней в виде <img style="position: relative;top: 7px;" src="http://img.likebk.com/i/eff/gold.png"> премиум голд аккаунта на неделю!</span><br>
<span style="color: red;">*Если вы пропустили один день, испытание придется начинать заново!</span>
</div>
</div>

<?php

$timeMin = strtotime("now 00:00:00");

$daily = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dailybonus` WHERE `uid` = "'.$u->info['id'].'" '));
$i = $daily[0];

	$bonus_online = array(
		0=>7200, 
		1=>10800,
		2=>14400,
		3=>18000,
		4=>21600,
		5=>25200,
		6=>28800
	);
	$btl = array(
		0=>10, 
		1=>15, 
		2=>20, 
		3=>25, 
		4=>30, 
		5=>35, 
		6=>40
	);
	$priz = array(
		0=>'<img style="position: relative;top: 7px;" src="http://img.likebk.com/i/items/zma.gif"> свиток зашиты от магии + 0.1 екр',
		1=>'<img style="position: relative;top: 7px;" src="http://img.likebk.com/i/items/spell_protect10.gif"> свиток защиты от оружия  + 0.2 екр',
		2=>'<img style="position: relative;top: 7px;" src="http://img.likebk.com/i/items/spell_powerHPup5.gif"> свиток ЖЖ5 + 0.3 екр',
		3=>'<img style="position: relative;top: 15px; width: 40px;" src="http://img.likebk.com/i/items/pot_base_200_alldmg3.gif"> нектар неуязвимости +0.4 екр',
		4=>'<img style="position: relative;top: 15px; width: 40px;" src="http://img.likebk.com/i/items/pot_base_200_allmag3.gif"> нектар отрицания  + 0.5 екр',
		5=>'<img style="position: relative;top: 15px; width: 40px;" src="http://img.likebk.com/i/items/buter.gif"> бутерброд -The Best Friend + 0.6 екр',
		6=>'<img style="position: relative;top: 7px;" src="http://img.likebk.com/i/eff/gold.png"> Премиум Голд аккаунт на неделю'
	);

if(isset($_GET['prize']) && $_GET['prize'] == 1){
	$bonus_flag = mysql_fetch_array(mysql_query('SELECT * FROM `dailyprize` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));

	$online = mysql_fetch_array(mysql_query('SELECT `time_today` FROM `online` WHERE `uid` = "'.$u->info['id'].'"'));
	$battle = mysql_fetch_array(mysql_query('SELECT `date` FROM `dailybattle` WHERE `uid` = "'.$u->info['id'].'"'));
	$sp = mysql_query('SELECT `id` FROM `battle_last` WHERE `uid` = "'.$u->info['id'].'" AND `battle_id` IN (SELECT `id` FROM `battle` WHERE `razdel` = 5) AND `time` > "'.($timeMin).'" GROUP BY `battle_id`');
	while( $pl = mysql_fetch_array($sp) ) {
		$btx++;
	}
	if( $btx > $battle['date'] ) {
		$battle['date'] = $btx;
	}
	if($online['time_today'] >=  $bonus_online[$i] && $battle['date'] >=  $btl[$i]){
		if($bonus_flag){
			echo '<br><div style="text-align: center;"><span style="color: green;">Награда уже получена!</div>';
		}
		else{
			$prize = array(
				0=>6799,
				1=>6800,
				2=>6801,
				3=>6802,
				4=>6803,
				5=>6804
			);
			if($i <= 5){
				$re = $u->addItem($prize[$i], $u->info['id'],'|sudba='.$u->info['login'].'|nosale=1',NULL,0);
				if( $re > 0 ) {
					mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
					$ins = mysql_query('INSERT INTO `dailyprize` (`uid`,`date`,`day`) VALUES (
									"'.$u->info['id'].'",
									"'.time().'",
									"'.$i.'")');
					if(isset($ins)){
						echo '<div style="border-radius: 8px;width: 500px; margin: 0 auto 10px; padding: 10px; background-color: #dff0d8; border-color: #d6e9c6; text-align: center;"><span style="color: #007000;">Вы успешно получили награду! Проверьте ваш инвентарь, раздел "Прочее"!</div>';
					}
				}
			}
			elseif($i == 6){
				$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "435"'));
				$bonusT = 604800;
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
					"Exp_zver"=>"100",
					"type"=>"3"
					);
				$res = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$u->info['id'].'" AND `name` = "'.$bonus['name'].'"'));
				if($res['id']){
					$ins = mysql_query('UPDATE `premium` SET 
						`name` = "'.$bonus['name'].'",
						`type` = "'.$bonus['type'].'",
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
						`money` = "" 
						WHERE `uid` = "'.$u->info['id'].'"');
				}
				else{
					mysql_query('DELETE FROM `premium` WHERE `uid` = "'.$u->info['id'].'"');
					$ins = mysql_query('INSERT INTO `premium` SET 
						`name` = "'.$bonus['name'].'",
						`uid` = "'.$u->info['id'].'", 
						`type` = '.$bonus['type'].',
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
						`money` = "" ');		
				}
				if($ins){
					$ef_us = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `name` = "'.$bonus['name'].'" AND `delete` = "0" AND `overType` = "777" LIMIT 1'));
					if($ef_us['overType'] == 777)
					{
						//убираем прошлые эффекты
						$goodUse = 0;
						$upd1 = mysql_query('UPDATE `eff_users` SET `timeUse` = `timeUse` + "'.(86400*7).'" WHERE `id` = "'.$ef_us['id'].'" LIMIT 1');
						if($upd1)
						{
							$goodUse = 1;
						}
					}else{
						mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `overType` = 777');
						mysql_query('INSERT INTO `eff_users` (`uid`,`id_eff`,`data`,`name`,`overType`,`timeUse`,`x`,`no_Ace`) VALUES ("'.$u->info['id'].'","'.$eff['id2'].'","'.$eff['mdata'].'","'.$eff['mname'].'","777","'.(time()+$bonusT).'","1","1")');
					}					
					if(mysql_query('INSERT INTO `dailyprize` (`uid`,`date`,`day`) VALUES (
									"'.$u->info['id'].'",
									"'.time().'",
									"'.$i.'")')) {
						echo '<div style="border-radius: 8px;width: 500px; margin: 0 auto 10px; padding: 10px; background-color: #dff0d8; border-color: #d6e9c6; text-align: center;"><span style="color: #007000;">Поздравляем! Вы успешно получили награду!</div>';
					}
				}
			}
		}
	}
	else{
		echo '<br><div style="text-align: center;"><span style="color: green;">Вы не выполнили задание!</div>';
	}
}
$bonus_flag = mysql_fetch_array(mysql_query('SELECT * FROM `dailyprize` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));

$online = mysql_fetch_array(mysql_query('SELECT `time_today` FROM `online` WHERE `uid` = "'.$u->info['id'].'"'));
$battle = mysql_fetch_array(mysql_query('SELECT `date` FROM `dailybattle` WHERE `uid` = "'.$u->info['id'].'"'));
$sp = mysql_query('SELECT `id` FROM `battle_last` WHERE `uid` = "'.$u->info['id'].'" AND `battle_id` IN (SELECT `id` FROM `battle` WHERE `razdel` = 5) AND `time` > "'.($timeMin).'" GROUP BY `battle_id`');
while( $pl = mysql_fetch_array($sp) ) {
	$btx++;
}
if( $btx > $battle['date'] ) {
	$battle['date'] = $btx;
}

?>
<?php 
echo '<div style="text-align: center;">';
	echo '<b><span style="color: #8f0000;">День '.($i+1).':</span></b> Необходимо провести '.$u->timeOut($bonus_online[$i]).' часа онлайн, а также '.$btl[$i].' хаотичных боев<br> ';
	echo '<span><b>Получи в награду '.$priz[$i].'!</b></span><br><br>';
	if($bonus_flag){
		echo '<span class="button" style="pointer-events: none;cursor: default; opacity: 0.5;">Награда получена</span>';?>
		<div id="clockdiv"></div>

			<script>
				var c = "<?php echo date("F d, Y H:i:s")?>";
			  	var now = new Date(c);
			  	var tomorrow = new Date(now.getFullYear(), now.getMonth(), now.getDate()+1);

			  	var diff = tomorrow - now;
			  	diff = diff / 1000;

				function gettime() {
					diff = diff - 1;

				  	var seconds = Math.floor( diff % 60 );
					var minutes = Math.floor( (diff/60) % 60 );
					var hours = Math.floor( (diff*1000/(1000*60*60)) % 24 );

					if(hours == 0){
						hours = '';
					}else{
						hours = hours+' ч. ';
					}
					if(minutes == 0){
						minutes = '';
					}else{
						minutes = minutes+' мин. ';
					}
					if(seconds == 0){
						seconds = '0 сек. ';
					}else{
						seconds = seconds+' сек. ';
					}

					if(diff <= 0){
						clearInterval(timeinterval);
					}else{
						document.getElementById('clockdiv').innerHTML = '<span style="font-size: 14px; font-weight: bold;">Осталось до следующего задания: '+hours+minutes+seconds+'</span>';
					}
				}
				gettime();
				var timeinterval = setInterval(gettime,1000);
			</script>
<?php }
	else{
		echo '<div>';
			echo '<b>Пробыть в онлайне '.$u->timeOut($bonus_online[$i]).':</b><br> ';
			if($online['time_today'] <  $bonus_online[$i]){
				$flag = 0;
				echo '<span style="color: red">Осталось: '.$u->timeOut($bonus_online[$i] - $online['time_today']).'</span>';
			}else{
				$flag = 1;
				echo '<span style="color: green;">Выполнено</span>';
			}
		echo '</div>';
	
		echo '<div>';
			echo '<b>Провести '.$btl[$i].' хаотических боев:</b><br> ';
			if($battle['date'] <  $btl[$i]){
				$flag2 = 0;
				echo '<span  style="color: red">Осталось: '.($btl[$i] - $battle['date']).'</span>';
			}
			else{
				$flag2 = 1;
				echo '<span style="color: green;">Выполнено</span>';
			}
		echo '</div>';
		if($flag == 1 && $flag2 == 1){
			echo '<a class="button" href="main.php?dailybonus=1&prize=1">Забрать награду</a>';
		}else{
			echo '<span class="button" style="pointer-events: none; cursor: default; opacity: 0.2;">Забрать награду</span>';	
		}
	}
echo '</div>';
?>