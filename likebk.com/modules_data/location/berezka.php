<?php
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='berezka')
{	
	if(!isset($_GET['otdel'])) 
	{
		$_GET['otdel'] = 1;
	}
	
	$sid = 2;

	$sale_ekr = true;
	if( $u->stats['silver'] > 0 ) {
		$sale_ekr = true;
	}else{
		if( isset($_GET['sale']) ) {
			//unset($_GET['sale']);	
		}
	}

	$error = '';
	
	if(isset($_GET['buy'])){
		if($u->newAct($_GET['sd4'])==true)
		{
			$re = $u->buyItem($sid,(int)$_GET['buy'],(int)$_GET['x']);
		}else{
			$re = 'Вы уверены что хотите купить этот предмет?';
		}
	}elseif(isset($_GET['sale']) && isset($_GET['item']) && $u->newAct($_GET['sd4']) && $sale_ekr == true ) {
		$id = (int)$_GET['item'];
		$itm = mysql_fetch_array(mysql_query('SELECT `im`.*,`iu`.*, count(`iuu`.id) as inGroupCount
			FROM `items_users` AS `iu`
			LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`)
			LEFT JOIN `items_users` as `iuu` ON (`iuu`.inGroup = `iu`.inGroup AND `iuu`.item_id = `im`.id )
			WHERE `iuu`.`uid`="'.$u->info['id'].'" AND `iu`.`uid`="'.$u->info['id'].'" AND `im`.`price2` > 0 AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `iu`.`id` = "'.mysql_real_escape_string($id).'" LIMIT 1'));
		$po = $u->lookStats($itm['data']);	
		if($u->info['allLock'] > time()) {
			$po['nosale'] = 1;
		}
		
		$effvip = mysql_fetch_array(mysql_query('SELECT `id`,`timeUse` FROM `eff_users` WHERE `data` LIKE "%add_silver=%" AND `uid` = "'.$u->info['id'].'" ORDER BY `id` DESC LIMIT 1'));
		$cblim = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `ekr_sale` WHERE `uid` = "'.$u->info['id'].'" AND `time` >= '.$effvip['timeUse'].' LIMIT 1'));
		
		//if( $cblim[0] >= $u->stats['silver'] * 5 ) {
		//	$error = 'Лимит продаж предметов в березку исчерпан, обновите VIP аккаунт';
		//}else
		if( ($itm['gift'] != '' && $itm['gift'] != '0') && (  $itm['type'] == 37 || $itm['type'] ==  38 || $itm['type'] == 39 || $itm['type'] == 63 ) ) {
			$error = 'Нельзя продавать подарки, они должны оставаться на память! :)';
		}elseif(isset($po['nosale']) && $itm['item_id'] != 2563 && $itm['item_id'] != 2567 && $itm['item_id'] != 2571 && $itm['item_id'] != 2575 && $itm['item_id'] != 2579){
			$error = 'Не удалось продать предмет ...';
		}elseif(isset($po['fromshop']) && ($po['fromshop'] != 777 && $po['fromshop'] != 2) && $itm['item_id'] != 2563 && $itm['item_id'] != 2567 && $itm['item_id'] != 2571 && $itm['item_id'] != 2575 && $itm['item_id'] != 2579){
			$error = 'Предмет не был приобретен за Евро-кредиты, его нельзя продать здесь...';
		}elseif($itm['gift'] != '0' && $itm['gift'] != '' && $itm['item_id'] != 2563 && $itm['item_id'] != 2567 && $itm['item_id'] != 2571 && $itm['item_id'] != 2575 && $itm['item_id'] != 2579) {
				$error = 'Не удалось продать предмет ... Все-таки подарок ;)';
		}elseif(isset($po['frompisher']) && $itm['item_id'] != 2563 && $itm['item_id'] != 2567 && $itm['item_id'] != 2571 && $itm['item_id'] != 2575 && $itm['item_id'] != 2579){
			$error = 'Не удалось продать предмет ... предмет из подземелья';
		}elseif(isset($po['srok'])){
			$error = 'Предметы со сроком годности продавать нельзя ...';
		}elseif(isset($itm['id'])){
			if($itm['2price']>0){
				$itm['price2'] = $itm['2price'];
			}
			$shpCena = round($itm['price2'],2);
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
			$premium = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$u->info['id'].'" AND `time_delete` > "'.time().'"'));
			$shpCena = $u->shopSaleM( $shpCena , $itm );
			$shpCena = $shpCena/100*(100-$prc1);
			if($itm['iznosMAX']>0 && $itm['iznosMAXi']>0 && $itm['iznosMAXi']>ceil($itm['iznosMAX'])){
				$shpCena = $shpCena/100*(ceil($itm['iznosMAX'])/$itm['iznosMAXi']*100);
			}
/*			if( isset($po['art']) ) {
				$shpCena = $u->round2($shpCena*$u->berezCena()); // Процент продажи 35%
			}else{
				$shpCena = $u->round2($shpCena*$u->berezCena()); // Процент продажи 35%
			}*/
			if($itm['magic_inci'] == 'addmoney'){
				$shpCena = $itm['price2'];
			}else{
				$premium = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$u->info['id'].'" AND `time_delete` > "'.time().'"'));
				if(isset($premium['id'])){
					if($u->berezCena() != 0){
						if( isset($po['art']) ) {
							$shpCena = $u->round2($shpCena*$u->berezCena()); // Цена арта
						}else{
							$shpCena = $u->round2($shpCena*$u->berezCena()); // Цена
						}
						$shpCena = $u->round2($shpCena*($premium['saleEkr_prc']/100)); // Цена предметов
					}
					else{
						$shpCena = $u->round2($shpCena*($premium['saleEkr_prc']/100)); // Цена предметов
					}
				}else{
					if($u->berezCena() != 0){
						if( isset($po['art']) ) {
							$shpCena = $u->round2($shpCena*$u->berezCena()); // Цена арта
						}else{
							$shpCena = $u->round2($shpCena*$u->berezCena()); // Цена
						}
						$shpCena = $u->round2($shpCena*$c['prcshp']); // Цена предметов
					}
					else{
						$shpCena = $u->round2($shpCena*$c['prcshp']); // Цена предметов
					}
				}
				if($shpCena<0){
					$shpCena = 0;
				}
			}
			if( $itm['item_id'] == 2563 || $itm['item_id'] == 2567 || $itm['item_id'] == 2571 || $itm['item_id'] == 2575 || $itm['item_id'] == 2579 ) {
				$shpCena = 2.49;
			}
			$col = $u->itemsX($itm['id']);	
			if($col>0){
				$shpCena = $shpCena*$col;
			}
					/*
					$premium = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$u->info['id'].'" AND `time_delete` > "'.time().'"'));
					if($premium){
						if($itm['level'] < 9){
							$shpCena = $u->round2($shpCena*1);
						}else{
							$shpCena = $u->round2($shpCena*($premium['sale_prc']/100)); // Цена предметов
						}
					}else{
						if($itm['level'] < 9){
							$shpCena = $u->round2($shpCena*1);
						}else{
							$shpCena = $u->round2($shpCena*0.9); // Цена предметов
						}
					}
					*/
					
			if($shpCena<0){
				$shpCena = 0;
			}
			$upd2 = mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			if($upd2){
				if($col>1){
					mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `item_id`="'.$itm['item_id'].'" AND `uid`="'.$itm['uid'].'" AND `inGroup` = "'.$itm['inGroup'].'" LIMIT '.$col.'');	
				}
				$u->bank['money2'] += $shpCena;
				$upd = mysql_query('UPDATE `bank` SET `money2` = "'.$u->bank['money2'].'" WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
				//$upd = mysql_query('SELECT * FROM `bank` WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				if($upd){
					mysql_query('INSERT INTO `ekr_sale` (`uid`,`time`,`money2`) VALUES ("'.$u->info['id'].'","'.time().'","'.mysql_real_escape_string($shpCena).'")');
					$u->info['catch'] += $shpCena;
					mysql_query('UPDATE `users` SET `catch` = "'.$u->info['catch'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					$error = 'Вы успешно продали предмет &quot;'.$itm['name'].' [x'.$col.']&quot; за '.$shpCena.' екр.';
					mysql_query('UPDATE `items_users` SET `inGroup` = "0",`delete` = "'.time().'" WHERE `inGroup` = "'.$itm['id'].'" AND `uid` = "'.$u->info['id'].'" LIMIT '.$itm['group_max'].'');
					$u->addDelo(2,$u->info['id'],'&quot;<font color="green">System.Ekrshop</font>&quot;: Предмет &quot;'.$itm['name'].' (x'.$col.')&quot; [itm:'.$itm['id'].'] был продан в магазин за <B>'.$shpCena.' екр.</B>.',time(),$u->info['city'],'System.Ekrshop',0,$shpCena);
				}else{
					$u->addDelo(2,$u->info['id'],'&quot;<font color="green">System.Ekrshop</font>&quot;: Предмет &quot;'.$itm['name'].' (x'.$col.')&quot; [itm:'.$itm['id'].'] был продан в магазин за <B>'.$shpCena.' екр.</B> (кредиты не переведены).',time(),$u->info['city'],'System.Ekrshop',0,0);
					$error = 'Не удалось продать предмет...';
				}
			}else{
				$error = 'Не удалось продать предмет...';
			}
		}else{
			$error = 'Предмет не найден в инвентаре.';
		}
	}
	
	if($u->error != '') {
		$re = $u->error;
	}
	
	if($re!=''){ echo '<div align="right"><font color="red"><b>'.$re.'</b></font></div>'; } ?>
	<script type="text/javascript">
	function AddCount(name, txt){
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
	<TABLE width="100%" cellspacing="0" cellpadding="4">
	<TR>
	<form name="F1" method="post">
	<TD valign="top" align="left">
    <? //if(isset($u->bank['id']) && ($u->bank['money2']>0.00 || $u->info['admin']>0)){ ?>
	<!--Магазин-->
	<?php if( $u->info['admin'] > 0 ) {?>
		<div style="float: right;"><input id="edit_check" type="checkbox" name="edit_check"/> <label>показать редактирование</label></div>
	<?php }?>
	<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#a5a5a5">
	<div id="hint3" style="visibility:hidden"></div>
	<tr>
	<td align="center" height="21">
	<?php 
		/*названия разделов (сверху)*/
		if(!isset($_GET['sale']) && isset($_GET['otdel'])) 
		{
			$otdels_small_array = array (1=>'<b>Отдел&nbsp;&quot;Оружие: кастеты,ножи&quot;</b>',
				2=>'<b>Отдел&nbsp;&quot;Оружие: топоры&quot;</b>',
				3=>'<b>Отдел&nbsp;&quot;Оружие: дубины,булавы&quot;</b>',
				4=>'<b>Отдел&nbsp;&quot;Оружие: мечи&quot;</b>',
				5=>'<b>Отдел&nbsp;&quot;Оружие: магические посохи&quot;</b>',
				6=>'<b>Отдел&nbsp;&quot;Одежда: сапоги&quot;</b>',
				7=>'<b>Отдел&nbsp;&quot;Одежда: перчатки&quot;</b>',
				8=>'<b>Отдел&nbsp;&quot;Одежда: рубахи&quot;</b>',
				28=>'<b>Отдел&nbsp;&quot;Одежда: плащи&quot;</b>',
				9=>'<b>Отдел&nbsp;&quot;Одежда: легкая броня&quot;</b>',
				10=>'<b>Отдел&nbsp;&quot;Одежда: тяжелая броня&quot;</b>',
				11=>'<b>Отдел&nbsp;&quot;Одежда: шлемы&quot;</b>',
				12=>'<b>Отдел&nbsp;&quot;Одежда: наручи&quot;</b>',
				13=>'<b>Отдел&nbsp;&quot;Одежда: пояса&quot;</b>',
				14=>'<b>Отдел&nbsp;&quot;Одежда: поножи&quot;</b>',
				15=>'<b>Отдел&nbsp;&quot;Щиты&quot;</b>',
				16=>'<b>Отдел&nbsp;&quot;Ювелирные товары: серьги&quot;</b>',
				17=>'<b>Отдел&nbsp;&quot;Ювелирные товары: ожерелья&quot;</b>',
				18=>'<b>Отдел&nbsp;&quot;Ювелирные товары: кольца&quot;</b>',
				19=>'<b>Отдел&nbsp;&quot;Заклинания: нейтральные&quot;</b>',
				20=>'<b>Отдел&nbsp;&quot;Заклинания: боевые и защитные&quot;</b>',
				50=>'<b>Отдел&nbsp;&quot;Заклинания: исцеляющие&quot;</b>',
				55=>'<b>Отдел&nbsp;&quot;Заклинания: манящие&quot;</b>',
				56=>'<b>Отдел&nbsp;&quot;Заклинания: тактические&quot;</b>',
				51=>'<b>Отдел&nbsp;&quot;Руны&quot;</b>',
				52=>'<b>Отдел&nbsp;&quot;Чарки&quot;</b>',
				53=>'<b>Отдел&nbsp;&quot;Книги&quot;</b>',
				21=>'<b>Отдел&nbsp;&quot;Амуниция&quot;</b>',
				36=>'<b>Отдел&nbsp;&quot;Амуниция: эликсиры&quot;</b>',
				37=>'<b>Отдел&nbsp;&quot;Амуниция: еда&quot;</b>',
				32=>'<b>Отдел&nbsp;&quot;Сувениры: открытки&quot;</b>',
				29=>'<b>Отдел&nbsp;&quot;Сувениры: подарки&quot;</b>',
				33=>'<b>Отдел&nbsp;&quot;Сувениры: недобрые&quot;</b>',
				34=>'<b>Отдел&nbsp;&quot;Сувениры: упаковка&quot;</b>',
				35=>'<b>Отдел&nbsp;&quot;Сувениры: фейерверки&quot;</b>',
				54=>'<b>Отдел&nbsp;&quot;Чеки&quot;</b>');
			if(isset($otdels_small_array[$_GET['otdel']]))
			{
				echo $otdels_small_array[$_GET['otdel']];	
			}
			
		} elseif (isset($_GET['sale'])) 
		{
			echo '
			<B>Отдел&nbsp;&quot;Продажа предметов&quot;</B>';	
		}
	?>
	</tr>
	<tr><td>
	<!--Рюкзак / Прилавок-->
	<table width="100%" CELLSPACING="1" CELLPADDING="1" bgcolor="#a5a5a5">
	<?php
		//Выводим вещи в инвентаре для продажи
		if(isset($_GET['sale'])) {
			$itmAll = $u->genInv(16,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `im`.`price2` > 0 AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" ORDER BY `lastUPD` DESC');
			if($itmAll[0]==0)
			{
				$itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">ПУСТО</td></tr>';
			}else{
				$itmAllSee = $itmAll[2];
			}
			//echo '<tr><td align="center" bgcolor="#e2e0e0"><small>Продажа предметов купленных за екр. осуществляется с учетом износа предмета, а так-же налога на продажу.<br><b>Магазин принимает вещи 0-7 уровней под 99%, вещи 8-го уровня под 95%, вещи 9-го уровня, а так же свитки и эликсиры можно сдать в магазин под 70%.</b><br><font color=red><b>Внимание!</b></font> Все улучшения, заточки, руны, зачарования предметов не входят в стоимость предмета при продаже! </small></td></tr>'.$itmAllSee;
			//echo '<tr><td align="center" bgcolor="#e2e0e0"><small>Продажа предметов купленных за екр. осуществляется с учетом износа предмета, а так-же налога на продажу.<br><b>Магазин принимает вещи за 90% от их стоимости, с <font color=red><b>аккаунтами:</b></font> <a style="cursor: pointer;" onclick="top.getUrl(\'main\',\'main.php?premium=1\');">LikeBk Bronze</a> - 93%, <a style="cursor: pointer;" onclick="top.getUrl(\'main\',\'main.php?premium=1\');">LikeBk Silver</a> - 95%, <a style="cursor: pointer;" onclick="top.getUrl(\'main\',\'main.php?premium=1\');">LikeBk Gold</a> - 100%.</b><br><font color=red><b>Внимание!</b></font> Все улучшения, заточки, руны, зачарования предметов не входят в стоимость предмета при продаже! </small></td></tr>'.$itmAllSee;
			echo '<tr><td align="center" bgcolor="#e2e0e0"><small>Продажа предметов купленных за екр. осуществляется с учетом износа предмета, а так-же налога на продажу.<br><b>Магазин принимает вещи за 90% от их стоимости, с <font color=red><b>аккаунтами:</b></font> <a style="cursor: pointer;" onclick="top.getUrl(\'main\',\'main.php?premium=1\');">LikeBk Bronze</a> - 93%, <a style="cursor: pointer;" onclick="top.getUrl(\'main\',\'main.php?premium=1\');">LikeBk Silver</a> - 95%, <a style="cursor: pointer;" onclick="top.getUrl(\'main\',\'main.php?premium=1\');">LikeBk Gold</a> - 100%.</b><br><font color=red><b>Внимание!</b></font> Все улучшения, заточки, руны, зачарования предметов не входят в стоимость предмета при продаже! </small></td></tr>'.$itmAllSee;
		}else{
			//Выводим вещи в магазине для покупки
			$u->shopItems($sid);?>
			<script>
				$('.frm1').css('display','none');
				$("#edit_check").change(function(){
				    if(this.checked) {  
				        $('.frm1').css('display','block');
				    } else {
				        $('.frm1').css('display','none');
				    }
				});
				function func_del(id,r,sid){
					$.ajax({
						type: "POST",
						url: "jx/delete_item_shop.php",
						data: "id_sh="+id+"&r_sh="+r+"&sid_sh="+sid+"",
						success: function(data){
							if(data == "ok"){
								alert("Предмет успешно удален");
								location.reload();
							}
							else{
								alert("Ошибка");
							}
						}
					});
				}
				$('.btn_price_update').click(function(){
					var data   = '';
					var id = $(this).attr('id_it');
					var sid = $(this).attr('sid');
					$(this).parent().find('input').each(function(){
						data += this.name+'='+encodeURIComponent(this.value)+'&';
					});
					$.ajax({
						type: 'POST',
						url: 'jx/update_shop_price.php?id_sh='+id+'&sid_sh='+sid+'',
						data: data,
						success: function(data) {
							alert(data);
							location.reload();
						}
					});  
					return false;
				});
				$('.btn_name_update').click(function(){
					var data   = '';
					var id = $(this).attr('id_it');
					$(this).parent().find('input').each(function(){
						data += this.name+'='+encodeURIComponent(this.value)+'&';
					});
					$.ajax({
						type: 'POST',
						url: 'jx/update_shop_price.php?id_su='+id,
						data: data,
						success: function(data) {
							alert(data);
							location.reload();
						}
					});  
					return false;
				});
			</script><?php 
		}
	?>
	</TABLE>	 
	</TD></TR>
	</TABLE>
    <div align="center">
    </div></TD>
	</FORM>
	</TR>
	</TABLE>	
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
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.9&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.9',1); ?>">Центральная площадь</a></td>
	</tr>

	<tr>
	<td bgcolor="#D3D3D3"><img src="http://img.likebk.com/i/move/links.gif" width="9" height="7" /></td>
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.298&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.298',1); ?>">Артефактный магазин</a></td>
	</tr>
    
	<tr>
	<td bgcolor="#D3D3D3"><img src="http://img.likebk.com/i/move/links.gif" width="9" height="7" /></td>
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.431&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.431',1); ?>">Усиление Артефактов</a></td>
	</tr>

	</table>
	</td>
	</tr>
	</table>
	</td></table>
	</td></table>
	<div><br />
     <? //if(isset($u->bank['id'])){ ?>
      <div align="right">
      <small>
      	 <b>Деньги: </b><b style="color: #339900"><?php echo $u->info['money']?> кр.</b><br>
      	 <b>Еврокредиты: </b><b style="color: #339900"><?php echo $u->bank['money2']?> eкр.</b><br>
         <?
		 if( $u->info['money5'] > 0 ) {
		 ?>
         <b>Голд Еврокредиты: </b><b style="color: #339900"><?php echo $u->info['money5']?> Gold ekr.</b><br>
         <? } ?>
      	 <b><a style="display: inline-block; margin-top: 3px; padding-right: 5px; text-decoration: underline; font-size: 14px; color: #339900; cursor: pointer;" onClick="location='main.php?bill=1'">Пополнить баланс</a></b><br>
	  	<!-- Масса: <?//=$u->aves['now']?>/<?//=$u->aves['max']?> &nbsp;<br />
	 	№<? //echo $u->getNum($u->bank['id']); ?>: <b><? //echo $u->bank['money1']; ?></b>кр. <b><? //echo $u->bank['money2']; ?></b>екр. <a href="main.php?bank_exit=<? //echo $code; ?>"><img src="http://img.likebk.com/i/close_bank.gif" style="cursor:pointer;" title="Закрыть работу со счётом"></a></small> -->
      </small>
      </div>
	  <br />
	<?php
	//if(isset($u->bank['id']) && ($u->bank['money2']>0.00 || $u->info['admin']>0)){
		/*кнопочки*/
		if($sale_ekr == true) {
			if(!isset($_GET['sale'])){
				//if( $u->stats['silver'] > 0 ) { 
					echo '<INPUT TYPE="button" value="Продать вещи" onclick="location=\'?otdel='.$_GET['otdel'].'&sale=1\'">&nbsp;';
				//}else{
				//	echo '<INPUT style="color:grey" TYPE="button" value="Продать вещи" onclick="alert(\'Только при наличии VIP\');">&nbsp;';
				//}
			} else {
				echo '<INPUT TYPE="button" value="Купить вещи" onclick="location=\'?otdel='.$_GET['otdel'].'\'">&nbsp;';
			}
		}
	//}
	?>
    <INPUT TYPE="button" value="Обновить" onclick="location = '<? echo $_SERVER['REQUEST_URI']; ?>';">
    <BR>
	  </div>
      <? //if(isset($u->bank['id']) && ($u->bank['money2']>0.00 || $u->info['admin']>0)){ ?>
	<div style="background-color:#A5A5A5;padding:1"><center><B>Отделы магазина</B></center></div>
	<div style="line-height:17px;">
	<?php
		/*названия разделов (справа)*/
		$otdels_array = array (1=>'Оружие: кастеты,ножи',
			2=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;топоры',
			3=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;дубины,булавы',
			4=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;мечи',
			5=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;магические посохи',
			6=>'Одежда: сапоги',
			7=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;перчатки',
			8=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;рубахи',
			28=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;плащи',
			9=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;легкая броня',
			10=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;тяжелая броня',
			11=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;шлемы',
			12=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;наручи',
			13=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;пояса',
			14=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;поножи',
			15=>'Щиты',
			16=>'Ювелирные товары: серьги',
			17=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ожерелья',
			18=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;кольца',
			19=>'Заклинания: нейтральные',
			20=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;боевые и защитные',
			21=>'Амуниция',
			22=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;эликсиры',
			23=>'Подарки',
			24=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;недобрые',
			25=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;открытки',
			26=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;упаковка',
			27=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;фейерверки',
			28=>'Плащи и накидки',
			29=>'Слоты смены: Постоянные',
			30=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Временные слоты смены');

		if($u->info['id'] == 155 ){
		}
		/*if($u->info['admin'] > 0 ){
			echo '<br><div style=""><a href="?otdel=114">Сумеречный воин</a></div><br>';	
			echo '<div style=""><a href="?otdel=115">Железный человек</a></div><br>';	
			echo '<div style=""><a href="?otdel=116">Огненный воин</a></div><br>';	
			echo '<div style=""><a href="?otdel=117">Лесной дух</a></div><br>';		
			
		}*/

  echo '<div style="background-color: #C7C7C7"><a href="?otdel=1">Оружие: кастеты,ножи</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;топоры</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;дубины,булавы</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;мечи</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;магические посохи</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=6">Одежда: сапоги</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;перчатки</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;рубахи</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=9">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;легкая броня</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=10">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;тяжелая броня</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=11">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;шлемы</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=12">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;наручи</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;пояса</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=14">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;поножи</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=28">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;плащи и накидки</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=15">Щиты</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=16">Ювелирные товары: серьги</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=17">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ожерелья</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=18">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;кольца</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=19">Заклинания: нейтральные</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;боевые и защитные</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=50">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;исцеляющие</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=55">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;манящие</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=56">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;тактические</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=53">Книги</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=21">Амуниция</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=36">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;эликсиры</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=37">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;еда</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=32">Сувениры: открытки</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=29">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;подарки</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=33">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;недобрые</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=34">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;упаковка</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=35">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;фейерверки</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=54">Чеки</a></div>';
		/*
		// <div style="background-color: #e2e0e0"><a href="?otdel=51">Руны</a></div>
		// <div style="background-color: #e2e0e0"><a href="?otdel=52">Чарки</a></div>

		<div style="background-color: #e2e0e0"><a href="?otdel=29">Слоты смены: Постоянные</a></div>
		<div style="background-color: #e2e0e0"><a href="?otdel=30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Временные слоты смены</a></div>*/
		/*$i=1;
		while ($i!=-1)
		{
			if(isset($otdels_array[$i]))
			{
				if(isset($_GET['otdel']) && $_GET['otdel']==$i) 
				{
				$color = 'C7C7C7';	
				} else {
				$color = 'e2e0e0';
				}
			echo '
			<A HREF="?otdel='.$i.'"><DIV style="background-color: #'.$color.'">
			'.$otdels_array[$i].'
			</A></DIV>
			';
			} else {
			$i = -2;
			}
			$i++;
		}
		
		if(isset($_GET['gifts'])) 
		{
		$color = 'C7C7C7';	
		} */
		echo '</DIV>';
	//}
	?>
	</div>
    <? //} ?>
	</td>
	</table>
    <br>
	<div id="textgo" style="visibility:hidden;"></div>
<?
}
?>