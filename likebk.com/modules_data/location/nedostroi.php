<?php
if(!defined('GAME'))
{
 die();
}

if($u->room['file']=='nedostroi')
{
		$tr_res1 = 10000; //ледяной кирпич
		$tr_res2 = 100000; //снежный комок
		
		$tr_res = $tr_res1 + $tr_res2;
		$x = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `ng_quest` WHERE `item_id` = 9995 LIMIT 1'));
		$x = $x[0];
		$x1 = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `ng_quest` WHERE `item_id` = 9996 LIMIT 1'));
		$x1 = $x1[0];
		$all = $x + $x1;
		
		if($x == NULL) {
			$x = 0;
		}
		if($x1 == NULL) {
			$x1 = 0;
		}
		if($x > $tr_res2) {
			$x = $tr_res2;
		}
		if($x1 > $tr_res1) {
			$x1 = $tr_res1;
		}
		if($all > $tr_res) {
			$all = $tr_res;
		}
		$now = floor($all / $tr_res * 100); //полоска выполнения (%)
	if(isset($_GET['addres'])) {
		$items = mysql_query('SELECT `im`.`name`,`iu`.`id`,`iu`.`item_id`,`iu`.`delete` FROM `items_main` AS `im` LEFT JOIN `items_users` AS `iu` ON (`im`.`id` = `iu`.`item_id`) WHERE `iu`.`uid` = '.$u->info['id'].' AND (`im`.`id` = 9995 OR `im`.`id` = 9996) AND `iu`.`delete` = 0 AND `iu`.`inShop` = 0');
		$j = 0; $a = 0; $b = 0;
		while($pl = mysql_fetch_array($items)) {
			if($pl['delete'] == 0) {
				if($pl['item_id'] == 9995) {
					$a++;
				}else{
					$b++;
				}
					mysql_query('INSERT INTO `ng_quest` (`uid`,`time`,`item_id`) VALUES ("'.$u->info['id'].'","'.time().'","'.$pl['item_id'].'")');
				mysql_query('UPDATE `items_users` SET `delete` = '.time().' WHERE `inShop` = 0 AND `id` = "'.$pl['id'].'" LIMIT 1');
			}
		}
		
		$x1 = $x1 + $b;
		$x = $x + $a;
		$j = $a + $b; //все ресы с цикла
		$all = $all + $j;
		
		if($j == 0) {
			$re = '<font color=red><b>Предметы не найдены в вашем рюкзаке :) </b></font>';
		}else{
			$s = mysql_fetch_array(mysql_query('SELECT * FROM `ng_statistic` WHERE `uid` = '.$u->info['id'].' LIMIT 1'));
			if(!isset($s['id'])) {
				mysql_query('INSERT INTO `ng_statistic` (`uid`,`colvo`) VALUES ("'.$u->info['id'].'","'.$j.'")');
			}else{
				$s['colvo'] += $j;
				mysql_query('UPDATE `rep` SET `rep_ng` = `rep_ng` + '.$j.' WHERE `id` = '.$u->info['id'].' LIMIT 1');
				mysql_query('UPDATE `ng_statistic` SET `colvo` = '.$s['colvo'].' WHERE `id` = '.$s['id'].' LIMIT 1');
				$re = '<font color=red><b>Вы успешно пожертвовали ресурсы ('.$j.' шт.) на строительство Лачуги Деда Мороза</b></font>';
			}
		}
	}elseif(isset($_GET['finish_stroyka'])) {
		$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `nq_quest` WHERE `uid` != 2018 LIMIT 1'));
		if(!isset($test['id'])) {
			$r1 = mysql_fetch_array(mysql_query('SELECT * FROM `room` WHERE `name` = "Недострой" LIMIT 1'));
			$r2 = mysql_fetch_array(mysql_query('SELECT * FROM `room` WHERE `name` = "Лачуга Деда Мороза" LIMIT 1'));
			if(isset($r1['id'])) {
				mysql_query('UPDATE `room` SET `name` = "'.$r2['name'].'", `code` = "'.$r2['code'].'", `file` = "'.$r2['file'].'" WHERE `id` = "'.$r1['id'].'" LIMIT 1');
				mysql_query('UPDATE `room` SET `name` = "'.$r1['name'].'", `code` = "'.$r1['code'].'", `file` = "'.$r1['file'].'" WHERE `id` = "'.$r2['id'].'" LIMIT 1');
				//удаляем данные
				mysql_query('DELETE FROM `ng_quest`');
				//записываем данные о том, что лачуга построена
				mysql_query('INSERT INTO `ng_quest` (`uid`,`time`) VALUES ("2018","'.time().'")');
				//удаляем ресурсы
				mysql_query('DELETE FROM `items_users` WHERE `item_id` = 6063 OR (`item_id` = 6064) AND `delete` = 0');
			}
			header('location:main.php');
			die();
		}else{
			$re = 'Строительство уже завершено!';
		}
	}
	
	?>
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
	<div id="hint3" style="visibility:hidden"></div>
	<TABLE width="100%" cellspacing="0" cellpadding="0">
	<tr><td valign="top"><div align="center" class="pH3">Недострой</div><br />
	<fieldset><legend><small><b>Идет строительство: <font color=green><?=$all?> / <?=$tr_res?></font><font color=red> (<?=$now?>%)</font></b></legend>
	<br><b><img width="20" height="20" src="http://img.likebk.com/i/items/1.png">Снежный Комок: <?=$x?> / <?=$tr_res2?></b><br>
	<br><b><img width="20" height="20" src="http://img.likebk.com/i/items/2.png">Ледяной Кирпич: <?=$x1?> / <?=$tr_res1?></b><br>
	 <center>
			<div style="display:inline-block;text-align:left;width:20%;height:15px;border:2px solid grey;" title="Строительство завершено на: <?=$now?> (%)">
          <div style="display:inline-block;width:<?=$now?>%;height:15px;background-color:green;"></div>
        </div>
		<? if($tr_res != $all) { 
          echo '<br><br><a href="main.php?addres=1">Пожертвовать ресурсы</a>';
		}else{
			echo '<br><br><a href="main.php?finish_stroyka=1">Завершить строительство!</a>';
		}
			if($re != '') { echo '<br><br><font color=red><b>'.$re.'</b></font>'; }
		?>
		</center>
	</small><br></fieldset>
	<br>
	<U>Больше всего пожертвовали:</U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b><small>(Благосклонность Деда Мороза: <?=$u->rep['rep_ng']?>)</small></b><br>
    <div style="padding:5px;">
	<br>
	 <?
		$sp = mysql_query('SELECT `uid`,`colvo` FROM `ng_statistic` WHERE `colvo` > 0 ORDER BY `colvo` DESC LIMIT 10');
		$i = 1;
		while($pl = mysql_fetch_array($sp)) {
			echo ''.$i.'. '.$u->microLogin($pl['uid'],1).' - Кол-во: '.$pl['colvo'].' шт.<br>';
			$i++;
		}
		if($i == 1) {
			echo 'Список пуст...';
		}
	 ?>
    </div>
	  <td width="280" valign="top"><table cellspacing="0" cellpadding="0">
		<tr>
		  <td width="100%">&nbsp;</td>
		  <td><table  border="0" cellpadding="0" cellspacing="0">
			  <tr align="right" valign="top">
				<td><!-- -->
					<? echo $goLis; ?>
					<!-- -->
					<table border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td nowrap="nowrap"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
							<tr>
							  <td bgcolor="#D3D3D3"><img src="http://img.likebk.com/i/move/links.gif" width="9" height="7" /></td>
							  <td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.323&amp;rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.323',1); ?>">Западная Окраина</a></td>
							</tr>
						</table></td>
					  </tr>
				  </table></td>
			  </tr>
		  </table></td>
		</tr>
	  </table>
		<br />
	<center></center></td>
	</table>
	<div id="textgo" style="visibility:hidden;"></div>						  
<?
}
?>