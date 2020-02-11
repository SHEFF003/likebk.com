<?php
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='flyrune')
{
	
	if(!isset($_GET['talk']) || $_GET['talk'] != 15 ) {
		header('location: /main.php?talk=15');
		die();
	}
	
	$shopProcent = 0;
	
	if(isset($_POST['itemgift']) && true == false)
	{
		$to = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['to_login']).'" ORDER BY `id` ASC LIMIT 1'));
		if(isset($to['id']))
		{
			if($u->info['align'] == 2 || $u->info['haos'] > time()) {
				$re = '<div align="left">Хаосникам запрещается делать подарки другим игрокам</div>';
			}elseif($to['id']==$u->info['id'])
			{
				$re = '<div align="left">Очень щедро дарить что-то самому себе ;)</div>';
			}elseif($u->info['level']<4)
			{
				$re = '<div align="left">Дарить подарки можно начиная с 4-го уровня</div>';
			}else{
				if( $_POST['itemgift'] > 1000000000000 ) {
					$itm_l = mysql_fetch_array(mysql_query('SELECT * FROM `users_gifts` WHERE `uid` = "'.$u->info['id'].'" AND `id` = "'.mysql_real_escape_string((int)$_POST['itemgift']-1000000000000).'" LIMIT 1'));
					if( isset($itm_l['id']) && $itm_l['money'] > $u->info['money'] ) {
						$re = '<div align="left">Недостаточно денег</div>';
					}elseif( isset($itm_l['id']) ) {
						$itm = $u->addItem(4533,1,'|gift_id='.$itm_l['id'].'');
						if( $itm > 0 ) {
							$itm = mysql_fetch_array(mysql_query('SELECT `im`.*,`iu`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE (`im`.`type` = "28" OR `im`.`type` = "38" OR `im`.`type` = "63" OR `im`.`type` = "64") AND `iu`.`id` = "'.mysql_real_escape_string($itm).'" AND `iu`.`uid` = "1" AND `iu`.`gift` = "" AND `iu`.`delete` = "0" AND `iu`.`inOdet` = "0" AND `iu`.`inShop` = "0" LIMIT 1'));
							if(isset($itm['id'])) {
								$u->info['money'] -= $itm_l['money'];
								mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
								
								$itm['gtxt1'] = $_POST['podarok2'];
								$itm['gtxt2'] = $_POST['txt'];
													
								$itm['gtxt1'] = str_replace('\x3C','<',$itm['gtxt1']);
								$itm['gtxt1'] = str_replace('\x3','>',$itm['gtxt1']);	
								$itm['gtxt1'] = htmlspecialchars($itm['gtxt1'],NULL,'cp1251');
								$itm['gtxt2'] = str_replace('\x3C','<',$itm['gtxt2']);
								$itm['gtxt2'] = str_replace('\x3','>',$itm['gtxt2']);	
								$itm['gtxt2'] = htmlspecialchars($itm['gtxt2'],NULL,'cp1251');
								
								$upd = mysql_query('UPDATE `items_users` SET `data` = "'.$itm['data'].'",`gtxt1` = "'.mysql_real_escape_string($itm['gtxt1']).'",`gtxt2` = "'.mysql_real_escape_string($itm['gtxt2']).'", `uid` = "'.$to['id'].'", `gift` = "'.$u->info['login'].'",`time_create` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
								$whos = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` WHERE `id` = "'.$to['id'].'" LIMIT 1'));
								$ld = $u->addDelo(1, $to['id'],'&quot;<font color=#C65F00>Shop.'.$u->info['city'].'</font>&quot;: Получен подарок от  [id="'.$u->info['id'].'"/ Логин : "'.$u->info['login'].'"]. Предмет [id="'.$itm['id'].'"/ Название : "'.$itm['name'].'"]',time(),$u->info['city'],'Shop.gift',0,0);
								$ld = $u->addDelo(1, $u->info['id'],'&quot;<font color=#C65F00>Shop.'.$u->info['city'].'</font>&quot;: Сделал подарок персонажу  [id="'.$to['id'].'"/ Логин : "'.$whos['login'].'"]. Предмет [id="'.$itm['id'].'"/ Название : "'.$itm['name'].'"]',time(),$u->info['city'],'Shop.gift',0,0);
								if($upd)
								{
									$re = '<div align="left">Подарок был успешно отправлен к &quot;'.$to['login'].'&quot; за '.$itm_l['money'].' кр.</div>';
									$text = ' Получен подарок <b>'.$itm_l['name'].'</b>. От персонажа [login:'.$u->info['login'].'] .';
									mysql_query("INSERT INTO `chat` (`new`, `city`, `room`, `login`, `to`, `text`, `time`, `type`, `toChat`) VALUES ('1','".$u->info['city']."', '', '', '".$to['login']."', '".$text."', '".time()."', '6', '0')");
								}else{
									$re = '<div align="left">Не удалось сделать подарок</div>';
								}
							}else{
								$re = '<div align="left">Не удалось сделать подарок, он испортился...</div>';
							}
						}else{
							$re = '<div align="left">Не удалось сделать подарок, курьер случайно сломал его...</div>';
						}
					}else{
						$re = '<div align="left">Предмет не найден</div>';
					}
				}else{
					$itm = mysql_fetch_array(mysql_query('SELECT `im`.*,`iu`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE (`im`.`type` = "28" OR `im`.`type` = "38" OR `im`.`type` = "63" OR `im`.`type` = "64") AND `iu`.`id` = "'.mysql_real_escape_string($_POST['itemgift']).'" AND `iu`.`uid` = "'.$u->info['id'].'" AND `iu`.`gift` = "" AND `iu`.`delete` = "0" AND `iu`.`inOdet` = "0" AND `iu`.`inShop` = "0" LIMIT 1'));
					if(isset($itm['id']))
					{
						//$itm['data'] = '';
						
						$itm['gtxt1'] = $_POST['podarok2'];
						$itm['gtxt2'] = $_POST['txt'];
											
						$itm['gtxt1'] = str_replace('\x3C','<',$itm['gtxt1']);
						$itm['gtxt1'] = str_replace('\x3','>',$itm['gtxt1']);	
						$itm['gtxt1'] = htmlspecialchars($itm['gtxt1'],NULL,'cp1251');
						$itm['gtxt2'] = str_replace('\x3C','<',$itm['gtxt2']);
						$itm['gtxt2'] = str_replace('\x3','>',$itm['gtxt2']);	
						$itm['gtxt2'] = htmlspecialchars($itm['gtxt2'],NULL,'cp1251');
						
						$upd = mysql_query('UPDATE `items_users` SET `data` = "'.$itm['data'].'",`gtxt1` = "'.mysql_real_escape_string($itm['gtxt1']).'",`gtxt2` = "'.mysql_real_escape_string($itm['gtxt2']).'", `uid` = "'.$to['id'].'", `gift` = "'.$u->info['login'].'",`time_create` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
						$whos = mysql_fetch_array(mysql_query('SELECT `login` FROM `users` WHERE `id` = "'.$to['id'].'" LIMIT 1'));
						$ld = $u->addDelo(1, $to['id'],'&quot;<font color=#C65F00>Shop.'.$u->info['city'].'</font>&quot;: Получен подарок от  [id="'.$u->info['id'].'"/ Логин : "'.$u->info['login'].'"]. Предмет [id="'.$itm['id'].'"/ Название : "'.$itm['name'].'"]',time(),$u->info['city'],'Shop.gift',0,0);
						$ld = $u->addDelo(1, $u->info['id'],'&quot;<font color=#C65F00>Shop.'.$u->info['city'].'</font>&quot;: Сделал подарок персонажу  [id="'.$to['id'].'"/ Логин : "'.$whos['login'].'"]. Предмет [id="'.$itm['id'].'"/ Название : "'.$itm['name'].'"]',time(),$u->info['city'],'Shop.gift',0,0);
						if($upd)
						{
							$re = '<div align="left">Подарок был успешно отправлен к &quot;'.$to['login'].'&quot;</div>';
							$text = ' Получен подарок <b>'.$itm['name'].'</b>. От персонажа [login:'.$u->info['login'].'] .';
							mysql_query("INSERT INTO `chat` (`new`, `city`, `room`, `login`, `to`, `text`, `time`, `type`, `toChat`) VALUES ('1','".$u->info['city']."', '', '', '".$to['login']."', '".$text."', '".time()."', '6', '0')");
						}else{
							$re = '<div align="left">Не удалось сделать подарок</div>';
						}
					}else{
						$re = '<div align="left">Предмет не найден</div>';
					}
				}
			}
		}else{
			$re = '<div align="left">Персонаж с таким логином не найден</div>';
		}
	}
	
	if(isset($u->stats['shopSale'],$_GET['sale']) && true == false){
		$bns = 0+$u->stats['shopSale'];
		if($bns!=0){
			if($bns>0){
				$bns = '+'.$bns;
			}
			//$shopProcent = $u->shopSaleM( $shopProcent , $itm );
			$shopProcent -= $bns;
			if($shopProcent>99){ $shopProcent = 99; }
			if($shopProcent<1){ $shopProcent = 1; }
			echo '<div style="color:grey;"><b>У Вас действует бонус при продаже: '.$bns.'%</b><br><small>Вы сможете продавать предметы за 50% от их стоимости</small></div>';
		}
	}
	if(!isset($_GET['otdel'])) {
		$_GET['otdel'] = 1;
	}
	$sid = 420;
	$error = '';
	if(isset($_GET['buy'])){
		if($u->newAct($_GET['sd4'])==true){
			$re = $u->buyItem($sid,(int)$_GET['buy'],(int)$_GET['x']);
		}else{
			$re = 'Вы уверены что хотите купить этот предмет?';
		}
	}elseif(isset($_GET['sale']) && isset($_GET['item']) && $u->newAct($_GET['sd4']) && true == false){
		$id = (int)$_GET['item'];
		$itm = mysql_fetch_array(mysql_query('SELECT `im`.*,`iu`.*, count(`iuu`.id) as inGroupCount
			FROM `items_users` AS `iu`
			LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`)
			LEFT JOIN `items_users` as `iuu` ON (`iuu`.inGroup = `iu`.inGroup AND `iuu`.item_id = `im`.id )
			WHERE `iuu`.`uid`="'.$u->info['id'].'" AND `iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `iu`.`id` = "'.mysql_real_escape_string($id).'" LIMIT 1'));
		$po = $u->lookStats($itm['data']);		
		if($u->info['allLock'] > time()) {
			$po['nosale'] = 1;
		}
		if( ($itm['gift'] != '' && $itm['gift'] != '0') && (  $itm['type'] == 37 || $itm['type'] ==  38 || $itm['type'] == 39 || $itm['type'] == 63 ) ) {
			$error = 'Нельзя продавать подарки, они должны оставаться на память! :)';
		}elseif(isset($po['nosale'])){
			$error = 'Не удалось продать предмет, запрет продажи данного предмета ...';
		}elseif($pl['type']<29 && ($po['srok'] > 0 || $pl['srok'] > 0) && $pl['type'] != 28){
			$error = 'Не удалось продать предмет, вышел срок годности ...';
		}elseif(isset($po['frompisher'])){
			$error = 'Не удалось продать предмет, предмет из подземелья ...';
		}elseif(isset($po['fromlaba'])){
			$error = 'Не удалось продать предмет, предмет из лабиринта продается за воинственность ...';
		}elseif(isset($itm['id'])){
			if($itm['1price']>0){
				$itm['price1'] = $itm['1price'];
			}
			$shpCena = $itm['price1'];
			$plmx = 0;
			if($itm['iznosMAXi']!=$itm['iznosMAX'] && $itm['iznosMAX']!=0){
				$plmx = $itm['iznosMAX'];
			}else{
				$plmx = $itm['iznosMAXi'];
			}
			if($itm['iznosNOW']>0){
				$prc1 = floor($itm['iznosNOW'])/$plmx*100;
			}else{
				$prc1 = 0;
			}
			$shpCena = $u->shopSaleM( $shpCena , $itm );
			$shpCena = $shpCena/100*(100-$prc1);
			if( $itm['iznosMAXi'] < 999999999 ) {
				if($itm['iznosMAX']>0 && $itm['iznosMAXi']>0 && $itm['iznosMAXi']>ceil($itm['iznosMAX'])){
					$shpCena = $shpCena/100*(ceil($itm['iznosMAX'])/$itm['iznosMAXi']*100);
				}
			}
			$shpCena = $u->round2($shpCena/100*(100-$shopProcent));
			if($shpCena<0){
				$shpCena = 0;
			}
			$col = $u->itemsX($itm['id']);	
			if($col>0){
				$shpCena = $shpCena*$col;
			}
			if($shpCena<0){
				$shpCena = 0;
			}
			$upd2 = mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			if($upd2){
				if($col>1){
					mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `item_id`="'.$itm['item_id'].'" AND `uid`="'.$itm['uid'].'" AND `inGroup` = "'.$itm['inGroup'].'" LIMIT '.$col.'');	
				}
				$u->info['money'] += $shpCena;
				$upd = mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				if($upd) {
					$error = 'Вы успешно продали предмет &quot;'.$itm['name'].' [x'.$col.']&quot; за '.$shpCena.' кр.';
					mysql_query('UPDATE `items_users` SET `inGroup` = "0",`delete` = "'.time().'" WHERE `inGroup` = "'.$itm['id'].'" AND `uid` = "'.$u->info['id'].'" LIMIT '.$itm['group_max'].'');
					$u->addDelo(2,$u->info['id'],'&quot;<font color="green">System.shop</font>&quot;: Предмет &quot;'.$itm['name'].' (x'.$col.')&quot; [itm:'.$itm['id'].'] был продан в магазин за <B>'.$shpCena.' кр.</B>.',time(),$u->info['city'],'System.shop',0,0);
				} else {
					$u->addDelo(2,$u->info['id'],'&quot;<font color="green">System.shop</font>&quot;: Предмет &quot;'.$itm['name'].' (x'.$col.')&quot; [itm:'.$itm['id'].'] был продан в магазин за <B>'.$shpCena.' кр.</B> (кредиты не переведены).',time(),$u->info['city'],'System.shop',0,0);
					$error = 'Не удалось продать предмет...';
				}
			} else {
				$error = 'Не удалось продать предмет...';
			}
		} else {
			$error = 'Предмет не найден в инвентаре.';
		}
	} elseif(isset($_GET['sale']) && isset($_GET['item_rep']) && $u->newAct($_GET['sd4']) && true == false ) {
		$id = (int)$_GET['item_rep'];
		$itm = mysql_fetch_array(mysql_query('SELECT `im`.*,`iu`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE `iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `im`.`pricerep` > 0 AND `iu`.`inShop`="0" AND `iu`.`id` = "'.mysql_real_escape_string($id).'" LIMIT 1'));
		$po = $u->lookStats($itm['data']);		
		if($u->info['allLock'] > time()) {
			$po['nosale'] = 1;
		}
		if(isset($po['nosale'])){
			$error = 'Не удалось продать предмет, запрет продажи данного предмета ...';
		}elseif($pl['type']<29 && ($po['srok'] > 0 || $pl['srok'] > 0)){
			$error = 'Не удалось продать предмет, вышел срок годности ...';
		}elseif(isset($po['frompisher'])){
			$error = 'Не удалось продать предмет, предмет из подземелья ...';
		}elseif(isset($itm['id'])){
			$shpCena = $itm['pricerep'];
			
			$plmx = 0;
			if($itm['iznosMAXi']!=$itm['iznosMAX'] && $itm['iznosMAX']!=0){
				$plmx = $itm['iznosMAX'];
			}else{
				$plmx = $itm['iznosMAXi'];
			}
			
			if($itm['iznosNOW']>0){
				$prc1 = $itm['iznosNOW']/$plmx*100;
			}else{
				$prc1 = 0;
			}
			$shpCena = $shpCena/100*(100-$prc1);
			if($itm['iznosMAX']>0 && $itm['iznosMAXi']>0 && $itm['iznosMAXi']>$itm['iznosMAX']){
				$shpCena = $shpCena/100*($itm['iznosMAX']/$itm['iznosMAXi']*100);
			}
			//$shpCena = $u->round2($shpCena/100*(100-$shopProcent));
			if($shpCena<0){
				$shpCena = 0;
			}
			$col = $u->itemsX($itm['id']);	
			if($col>0){
				$shpCena = $shpCena*$col;
			}
			$shpCena = floor($shpCena);
			if($shpCena<0){
				$shpCena = 0;
			}
			$upd2 = mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			if($upd2){
				if($col>1){
					mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `item_id`="'.$itm['item_id'].'" AND `uid`="'.$itm['uid'].'" AND `inGroup` = "'.$itm['inGroup'].'" LIMIT '.$col.'');	
				}
				$u->rep['rep3'] += $shpCena;
				$upd = mysql_query('UPDATE `rep` SET `rep3` = "'.$u->rep['rep3'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				if($upd){
					$error = 'Вы успешно обменяли предмет &quot;'.$itm['name'].' [x'.$col.']&quot; на +'.$shpCena.' воинственности.<br>
							  Ваша воинственность: '.($u->rep['rep3']-$u->rep['rep3_buy']).'';
					mysql_query('UPDATE `items_users` SET `inGroup` = "0",`delete` = "'.time().'" WHERE `inGroup` = "'.$itm['id'].'" AND `uid` = "'.$u->info['id'].'" LIMIT '.$itm['group_max'].'');
					$u->addDelo(2,$u->info['id'],'&quot;<font color="green">System.shop</font>&quot;: Предмет &quot;'.$itm['name'].' (x'.$col.')&quot; [itm:'.$itm['id'].'] был продан в магазин за <B>'.$shpCena.' воинственность.</B>.',time(),$u->info['city'],'System.shop',0,0);
				}else{
					$u->addDelo(2,$u->info['id'],'&quot;<font color="green">System.shop</font>&quot;: Предмет &quot;'.$itm['name'].' (x'.$col.')&quot; [itm:'.$itm['id'].'] был продан в магазин за <B>'.$shpCena.' воинственность.</B> (Репутация не переведена).',time(),$u->info['city'],'System.shop',0,0);
					$error = 'Не удалось обменять предмет...';
				}
			}else{
				$error = 'Не удалось обменять предмет...';
			}
		}else{
			$error = 'Подходящий предмет не найден в инвентаре.';
		}
	}
	
	if($re!=''){ echo '<div align="right"><font color="red"><b>'.$re.'</b></font></div>'; } ?>
	<script type="text/javascript">
	function AddCount(name, txt)
	{
		document.getElementById("hint4").innerHTML = '<table border=0 width=100% cellspacing=1 cellpadding=0 bgcolor="#CCC3AA"><tr><td align=center><B>Купить неск. штук</td><td width=20 align=right valign=top style="cursor: pointer" onclick="closehint3();"><BIG><B>x</TD></tr><tr><td colspan=2>'+
		'<form method=post><table border=0 width=100% cellspacing=0 cellpadding=0 bgcolor="#FFF6DD"><tr><INPUT TYPE="hidden" name="set" value="'+name+'"><td colspan=2 align=center><B><I>'+txt+'</td></tr><tr><td width=80% align=right>'+
		'Количество (шт.) <INPUT TYPE="text" NAME="count" id=count size=4></td><td width=20%>&nbsp;<INPUT TYPE="submit" value=" »» ">'+
		'</TD></TR></form></TABLE></td></tr></table>';
		document.getElementById("hint4").style.visibility = 'visible';
		document.getElementById("hint4").style.left = '100px';
		document.getElementById("hint4").style.top = '100px';
		document.getElementById("count").focus();
	}
	function closehint3() {
	document.getElementById('hint4').style.visibility='hidden';
	Hint3Name='';
	}	
	</script>
	<style type="text/css"> 
	
	.pH3			{ COLOR: #8f0000;  FONT-FAMILY: Arial;  FONT-SIZE: 12pt;  FONT-WEIGHT: bold; }
	.class_ {
		font-weight: bold;
		color: #C5C5C5;
		cursor:pointer;
	}
	.class_st {
		font-weight: bold;
		color: #659BA3;
		cursor:pointer;
	}
	.class__ {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #659BA3;
	}
	.class__st {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #659BA3;
		font-size: 10px;
	}
	.class_old {
		font-weight: bold;
		color: #919191;
		cursor:pointer;
	}
	.class__old {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #838383;
		font-size: 10px;
	}	
	</style>
	<TABLE width="100%" cellspacing="0" cellpadding="0">
	<tr><td valign="top"><div style="margin-top: 5px;" align="center" class="pH3"><? echo $u->room['name']; ?></div>
	<?php
	echo '<b style="color:red">'.$error.'</b>';
	?>
	<br />
	<td width="280" valign="top">
    <TABLE cellspacing="0" cellpadding="0"><TD width="100%">&nbsp;</TD><TD>
	<table  border="0" cellpadding="0" cellspacing="0"> 
	<tr align="right" valign="top">
	<td>
	<!-- -->
	<? echo $goLis; ?>
	<!-- -->
	<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td nowrap="nowrap">
	<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
	<tr>
	<td bgcolor="#D3D3D3"><img src="http://img.likebk.com/i/move/links.gif" width="9" height="7" /></td>
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.412&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.412',1); ?>">Мистический Лес</a></td>
	</tr>
	</table>
	</td>
	</tr>
	</table>
	</td></table>
	</td></table>
	<div><br />
      <div align="right">
      <small>
      <b>Деньги: </b><b style="color: #339900"><?php echo $u->info['money']?> кр.</b></small>
      <INPUT TYPE="button" value="Обновить" onclick="location = '<? echo str_replace('item','',str_replace('buy','',$_SERVER['REQUEST_URI'])); ?>';"><BR>
	  </div></td>
	</table>
    <br>
	<div id="textgo" style="visibility:hidden;"></div>
<?
}
?>