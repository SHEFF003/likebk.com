<?
if(!defined('GAME'))
{
	die();
}
if(isset($_GET['hpAllkol'])){
	$u->error = 'Вы успешно восстановили HP';
}
if(isset($_GET['mpAllkol'])){
	$u->error = 'Вы успешно восстановили MP';
}
if($u->error!='')
{
	echo '<font color="red"><b>'.$u->error.'</b></font><br>';
}
$vt = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$u->info['id'].'" AND `vip` > "0" LIMIT 1'));
if(isset($vt['id'])){
	if($vt['vip'] > 0){
		$vi = array(
			//нападалки
			array(865, array( 0, 5 , 10 ),0,0,1,'useOnLogin=1|musor=1|noremont=1|nosale=1|sudba='.$u->info['login'].'|srok=900',1),
			array(2391,array( 0, 3 , 5 ),0,0,1,'useOnLogin=1|musor=1|noremont=1|nosale=1|sudba='.$u->info['login'].'|srok=900',2),
			//лечение травм
			array(4412,array( 0, 3 , 5 ),0,0,1,'useOnLogin=1|musor=1|noremont=1|nosale=1|sudba='.$u->info['login'].'|srok=900',1),	
			array(4413,array( 0, 3 , 5 ),0,0,1,'useOnLogin=1|musor=1|noremont=1|nosale=1|sudba='.$u->info['login'].'|srok=900',1),
			array(4414,array( 0, 3 , 5 ),0,0,1,'useOnLogin=1|musor=1|noremont=1|nosale=1|sudba='.$u->info['login'].'|srok=900',1),
			//лечение травм
			array(9989,array( 0, 2 , 4 ),0,0,1,'useOnLogin=1|musor=1|noremont=1|nosale=1|sudba='.$u->info['login'].'|srok=900',1),	
			array(9990,array( 0, 2 , 4 ),0,0,1,'useOnLogin=1|musor=1|noremont=1|nosale=1|sudba='.$u->info['login'].'|srok=900',1),
			array(9991,array( 0, 2 , 4 ),0,0,1,'useOnLogin=1|musor=1|noremont=1|nosale=1|sudba='.$u->info['login'].'|srok=900',1),
			//Магическое усиление 
			array(5123,array( 0 , 2 , 4 ),0,0,1,'musor=1|noremont=1|nosale=1|onlyOne=1|oneType=25|sudba='.$u->info['login'].'|srok=900',1),
			//Защита от магии 
			array(5122,array( 0 , 2 , 4 ),0,0,1,'musor=1|noremont=1|nosale=1|onlyOne=1|oneType=25|sudba='.$u->info['login'].'|srok=900',1),
			//Сокрушение
			array(994, array( 0 , 2 , 4 ),0,0,1,'musor=1|noremont=1|nosale=1|onlyOne=1|oneType=6|sudba='.$u->info['login'].'|srok=900',1),
			//Холодный разум
			array(1460,array( 0 , 2 , 4 ),0,0,1,'musor=1|noremont=1|nosale=1|onlyOne=1|oneType=25|sudba='.$u->info['login'].'|srok=900',1),
			//Защита от Оружия
			array(1001,array( 0 , 2 , 4 ),0,0,1,'musor=1|noremont=1|nosale=1|onlyOne=1|oneType=25|sudba='.$u->info['login'].'|srok=900',1),
			//Жажда жизни 6
			array(3101,array( 0, 1, 2 ),0,0,1,'useOnLogin=1|musor=1|noremont=1|nosale=1|sudba='.$u->info['login'].'|srok=900',2),
			//Клонирование
			array(4056, array( 0, 1 , 3 ),0,0,1,'useOnLogin=1|musor=1|noremont=1|nosale=1|sudba='.$u->info['login'].'|srok=900',1)
		);
		$kolod = array(
			//колодец жизни
			array(5124,array(0,20000,50000),0,0,0),
			//колодец маны
			array(5125,array(0,20000,50000),0,0,1)
		);
		?>
		<table width="100%">
		  	<tr>
		    	<td align="center"><h3>VIP Панель Персонажа <?=$u->info['login']?>!</h3></td>
		    	<td width="200" align="right"><input type="button" value="обновить" onclick="location='main.php?vip=1';" />      <input type="button" value="Вернуться" onclick="location='main.php';" />
		    	</td>
		  	</tr>
			<?
			$i = 0; $seet = '';
			$vnr = array(0 => 'на сегодня',1 => 'всего');
			while($i < count($vi)) {
				$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$vi[$i][0].'" LIMIT 1'));
				if(isset($itm['id'])) {
					$vix = 0;
					if($vi[$i][4] == 1) {
						//за сегодня
							$vix = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time`>='.strtotime('now 00:00:00').' AND `vars` = "vitm_'.$itm['id'].'" LIMIT '.$vi[$i][1][$u->info['vip']],2);
							$vix = $vix[0];
					}

					if($vi[$i][1][$u->info['vip']]-$vix > 0) {
						if(isset($_GET['take_item_vip']) && $_GET['take_item_vip'] == $itm['id']) {
							$vix++;
							$nitm = $u->addItem($itm['id'],$u->info['id'],$vi[$i][5]);
							if($vi[$i][6]>0) {
								mysql_query('UPDATE `items_users` SET `data`="'.$vi[$i][5].'",`iznosMAX` = "'.$vi[$i][6].'",`1price` = "0.01" WHERE `id` = "'.$nitm.'" AND `uid` = "'.$u->info['id'].'" LIMIT 1');
							}
							$u->addAction(time(),'vitm_'.$itm['id'],'');
							echo '<font color="red">Предмет &quot;<b>'.$itm['name'].'</b>&quot; перемещен к Вам в инвентарь (Осталось всего: '.($vi[$i][1][$u->info['vip']]-$vix).' шт.).</font><br><br>';
						}
					}
					
					$seet0 = '';				
					$seet0 .= '<img '.$vix.' title="'.$itm['name'].' (Осталось всего: '.($vi[$i][1][$u->info['vip']]-$vix).' шт.)" style="height:25px;" src="http://img.likebk.com/i/items/'.$itm['img'].'"> ';
					if($vi[$i][1][$u->info['vip']]-$vix > 0) {
						$seet0 = '<a href="main.php?vip=1&take_item_vip='.$itm['id'].'">'.$seet0.'</a>';
					}else{
						$seet0 = '<span style="filter: alpha(opacity=20); -moz-opacity: 0.20; -khtml-opacity: 0.20; opacity: 0.20;">'.$seet0.'</span>';
					}
					$seet .= $seet0;

					$tbl .= '<tr><td align="center" width="45" bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;">';
					$tbl .= '<img '.$vix.' title="'.$itm['name'].' (Осталось всего: '.($vi[$i][1][$u->info['vip']]-$vix).' шт.)" style="height:25px;" src="http://img.likebk.com/i/items/'.$itm['img'].'"></td>';
					$tbl .= '<td bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;">'.$itm['name'].' (Осталось всего: '.($vi[$i][1][$u->info['vip']]-$vix).' шт.)</td></tr>';

				}
				$i++;
			}
			$i = 0;
			$typ = array(0 => 'HP',1 => 'MP');
			while($i < count($kolod)) {
				$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$kolod[$i][0].'" LIMIT 1'));
				if(isset($itm['id'])) {
					$vix2 = 0;
					if($kolod[$i][4] == 0) {
						//за сегодня
							$vix2 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time`>='.strtotime('now 00:00:00').' AND `vars` = "hpKolodec_'.$u->info['id'].'" ',3);
							$vix2 = round($vix2[0]);
						if($kolod[$i][1][$u->info['vip']]-$vix2 > 0) {
							if(isset($_GET['take_item_vip']) && $_GET['take_item_vip'] == $itm['id']) {
								if($_GET['take_item_vip'] == 5124){
									if($u->stats['hpNow'] != $u->stats['hpAll']){
										$kolodec_hp = mysql_fetch_array(mysql_query('SELECT * FROM `a_kolodec` WHERE `uid` = "'.$u->info['id'].'" AND `type` = "0"'));
										if($vix2 < $kolod[$i][1][$u->info['vip']]){
											if(!isset($kolodec_hp['id'])){
												$in_kol = mysql_query('INSERT INTO `a_kolodec` (`uid`,`time`,`type`) VALUES ("'.$u->info['id'].'","'.(time()+300).'","0")');
												if($in_kol){
													//$_SESSION['timestamp'] = time()+300;
													$hpV = $u->stats['hpAll'] - $u->stats['hpNow'];
													if(($hpV + $vix2) > $kolod[$i][1][$u->info['vip']]){
														$hpV = $kolod[$i][1][$u->info['vip']] - $vix2;
													}
													mysql_query('UPDATE `stats` SET `hpNow` =`hpNow` + "'.$hpV.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
													$u->addActionKol($u->info['id'], time(),'hpKolodec_'.$u->info['id'], $hpV);
													echo '<script>location.href="main.php?vip=1&hpAllkol"</script>';
												}
											}else{
												$in_kol = mysql_query('UPDATE `a_kolodec` SET `time`="'.(time()+300).'" WHERE `uid`="'.$u->info['id'].'" AND `type` = "0"');
												if($in_kol){
													//$_SESSION['timestamp'] = time()+300;
													$hpV = $u->stats['hpAll'] - $u->stats['hpNow'];
													if(($hpV + $vix2) > $kolod[$i][1][$u->info['vip']]){
														$hpV = $kolod[$i][1][$u->info['vip']] - $vix2;
													}
													mysql_query('UPDATE `stats` SET `hpNow` =`hpNow` + "'.$hpV.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
													$u->addActionKol($u->info['id'], time(),'hpKolodec_'.$u->info['id'], $hpV);
													echo '<script>location.href="main.php?vip=1&hpAllkol"</script>';
												}
											}
										}else{
											echo '';
										}
									}else{
										echo '<font color="red"><b>Ваше здоровье и так полностью восстановлено</b></font><br>';
									}
								}
							}
						}
				
					}elseif($kolod[$i][4] == 1) {
						//за сегодня
							$vix2 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time`>='.strtotime('now 00:00:00').' AND `vars` = "mpKolodec_'.$u->info['id'].'" ',3);
							$vix2 = round($vix2[0]);
						if($kolod[$i][1][$u->info['vip']]-$vix2 > 0) {
							if(isset($_GET['take_item_vip']) && $_GET['take_item_vip'] == $itm['id']) {
								if($_GET['take_item_vip'] == 5125){
									if($u->stats['mpNow'] != $u->stats['mpAll']){
										$kolodec_mp = mysql_fetch_array(mysql_query('SELECT * FROM `a_kolodec` WHERE `uid` = "'.$u->info['id'].'" AND `type` = "0"'));
										if($vix2 < $kolod[$i][1][$u->info['vip']]){
											if(!isset($kolodec_mp['id'])){
												$in_kol = mysql_query('INSERT INTO `a_kolodec` (`uid`,`time`,`type`) VALUES ("'.$u->info['id'].'","'.(time()+300).'","0")');
												if($in_kol){
													//$_SESSION['timestamp'] = time()+300;
													$mpV = $u->stats['mpAll'] - $u->stats['mpNow'];
													if(($mpV + $vix2) > $kolod[$i][1][$u->info['vip']]){
														$mpV = $kolod[$i][1][$u->info['vip']] - $vix2;
													}
													mysql_query('UPDATE `stats` SET `mpNow` =`mpNow` + "'.$mpV.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
													$u->addActionKol($u->info['id'], time(),'mpKolodec_'.$u->info['id'], $mpV);
													echo '<script>location.href="main.php?vip=1&mpAllkol"</script>';
												}
											}else{
												$in_kol = mysql_query('UPDATE `a_kolodec` SET `time`="'.(time()+300).'" WHERE `uid`="'.$u->info['id'].'" AND `type` = "0"');
												if($in_kol){
													//$_SESSION['timestamp'] = time()+300;
													$mpV = $u->stats['mpAll'] - $u->stats['mpNow'];
													if(($mpV + $vix2) > $kolod[$i][1][$u->info['vip']]){
														$mpV = $kolod[$i][1][$u->info['vip']] - $vix2;
													}
													mysql_query('UPDATE `stats` SET `mpNow` =`mpNow` + "'.$mpV.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
													$u->addActionKol($u->info['id'], time(),'mpKolodec_'.$u->info['id'], $mpV);
													echo '<script>location.href="main.php?vip=1&mpAllkol"</script>';
												}
											}
										}else{
											echo '';
										}
									}else{
										echo '<font color="red"><b>Ваша мана и так полностью восстановлена</b></font><br>';
									}
								}
							}
						}
					}

					$seet0 = '';				
					$seet0 .= '<img '.$vix2.' title="'.$itm['name'].' (Осталось всего: '.($kolod[$i][1][$u->info['vip']]-$vix2).' шт.)" style="height:25px;" src="http://img.likebk.com/i/items/'.$itm['img'].'"> ';
					if($kolod[$i][1][$u->info['vip']]-$vix2 > 0) {
						$seet0 = '<a href="main.php?vip=1&take_item_vip='.$itm['id'].'">'.$seet0.'</a>';
					}else{
						$seet0 = '<span style="filter: alpha(opacity=20); -moz-opacity: 0.20; -khtml-opacity: 0.20; opacity: 0.20;">'.$seet0.'</span>';
					}
					$seet .= $seet0;

					$tbl .= '<tr><td align="center" width="45" bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;">';
					$tbl .= '<img '.$vix2.' title="'.$itm['name'].' (Осталось всего: '.($kolod[$i][1][$u->info['vip']]-$vix2).' шт.)" style="height:25px;" src="http://img.likebk.com/i/items/'.$itm['img'].'"></td>';
					$tbl .= '<td bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;">'.$itm['name'].' (Осталось всего: '.($kolod[$i][1][$u->info['vip']]-$vix2).' '.$typ[$i].')</td></tr>';

				}
				$i++;
			}
			echo '<table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#E1E1E1">';
			echo '<tr><td bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;"></td><td bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;">Бонус к мощности урона: +'.(10*$u->info['vip']).'%</td></tr>';
			echo '<tr><td bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;"></td><td bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;">Бонус к мощности магии: +'.(10*$u->info['vip']).'%</td></tr>';
			if($vt['vip'] == 1):
				echo '<tr><td bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;"></td><td bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;">Бонус к получаемому опыту: +25%</td></tr>';
			elseif($vt['vip'] == 2):
				echo '<tr><td bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;"></td><td bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;">Бонус к получаемому опыту: +50%</td></tr>';
			endif;
			echo $tbl.'</table>';
			echo ' <p><b>Доступные предметы:</b><br /><small>(Чтобы забрать предмет просто нажмите на его изображение)</small></p>';
			echo $seet;
			?>
		    </p>
		    <font color=red><b>Внимание!</b> Срок годности выдаваемых предметов 15 мин.</font><Br /></td>
		  </tr>
		</table>
	<?php	
	}
}