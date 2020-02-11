<?
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='shop_ded_moroz') {
	$ng = mysql_fetch_array(mysql_query('SELECT `id`,`uid`,`etap`,`cp`,`haot`,`fiz`,`time` FROM `ng_quests` WHERE `uid` = '.$u->info['id'].' LIMIT 1')); //инфо
	
	if(!isset($ng['id'])) {
		mysql_query('INSERT INTO `ng_quests` (`uid`,`etap`) VALUES ("'.$u->info['id'].'","1")');
		$ng = mysql_fetch_array(mysql_query('SELECT `id`,`uid`,`etap`,`cp`,`haot`,`fiz`,`time` FROM `ng_quests` WHERE `uid` = '.$u->info['id'].' LIMIT 1'));
	}
		if($ng['etap'] == 5) {
			$etap = array(5 => 6, 6 => 6, 7 => 6, 8 => 6, 9 =>6, 10 => 6, 11 => 7, 12 => 8, 13 => 8 );
			$etap = $etap[$u->info['level']];
			//$ng['etap'] = $etap;
			$q = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`act_date`,`info` FROM `quests` WHERE `line` = 2018 AND `kin` = '.$etap.' LIMIT 1'));
		}else{
			$q = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`act_date`,`info` FROM `quests` WHERE `line` = 2018 AND `kin` = '.$ng['etap'].' LIMIT 1'));
		}
		//текущий квест
		$now = @mysql_fetch_array(mysql_query('SELECT `id` FROM `actions` WHERE `uid` = '.$u->info['id'].' AND `vars` LIKE "%start_quest'.$q['id'].'%" LIMIT 1'));
		//тип квеста
		$act = explode(':',$q['act_date']);
		
	if($act[0] == "kill_bot") { //убить ботов
		
		$b = explode('kill_bot:=:',$q['act_date']);
		
		if($ng['etap'] == 1 || $nq['etap'] == 5) {
				
			$b = explode(',',$b[1]);
				
			$b = explode('all_kill:=:',$b[1]);
			
			
			if($ng['etap'] == 1) {
				$sql = 'WHERE `id` = 47 OR (`id` = 48) LIMIT 2 ';
			}else{
				$sql = 'WHERE `login` LIKE "%Проклятие Глубин%" LIMIT 15 ';
			}
			
			$sp = mysql_query('SELECT `id` FROM `test_bot` '.$sql.'');
			$x = 0;
			while($pl = mysql_fetch_array($sp)) {
				$a = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `actions` WHERE `uid` = '.$u->info['id'].' AND `vars` LIKE "%win_bot_'.$pl['id'].'%" LIMIT 1'));
				$x += $a[0];
			}
			$a = $x;
		}else{
			$b = explode('=',$b[1]);
			$a = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `actions` WHERE `uid` = '.$u->info['id'].' AND `vars` LIKE "%win_bot_'.$b[0].'%" LIMIT 1'));
			$a = $a[0];
		}
		$r = ' ('.$a.' / '.$b[1].')';
	}elseif($act[0] == "haot") {
		$a = $ng['haot'];
		$b = explode('haot:=:',$q['act_date']);
		$r = ' ('.$a.' / '.$b[1].')';
	}elseif($act[0] == "kill_user") { //убить игроков
		$a = $ng['cp'];
		 $b = explode('kill_user:=:',$q['act_date']);
		 $r = ' ('.$a.' / '.$b[1].')';
	}elseif($act[0] == "fiz") {
		$a = $ng['fiz'];
		$b = explode('fiz:=:',$q['act_date']);
		$r = ' ('.$a.' / '.$b[1].')';
	}
 
	if(isset($_GET['add_quest'])) {
		if($ng['time'] > time()) {
			$re = 'Следующее задание доступно через: '.$u->timeOut($ng['time'] - time()).'';
		}elseif(isset($now['id'])) {
			$re = 'У вас уже есть задание, сначала выполните его';
		}elseif($ng['etap'] >= 6) {
			$re = 'Заданий больше нет...';
		}else{
			$u->addAction(time(),'start_quest'.$q['id'].'','go');
			$re = 'Вы получили задание &quot;'.$q['name'].'&quot;';
		}
	}
	if( $u->info['id'] == 12345 ) {
		$a = 100;
	}
	
	 if(isset($_GET['finish_quest'])) {
		 if( $ng['etap'] == 5 &&$a >= $b[1] ) {
			 $re = '<center style="color:red"><b>Поздравляем вы спасли Новый Год и в награду получаете сундук с обкастом:</b><br><br>';
			 if(!isset($_GET['finish_all'])) {
			 	$re .= '<INPUT TYPE=button class="btnnew" style="font-size: 13px; padding-top:3px; padding-bottom: 3px;" value=\'Открыть сундук\' onclick=\'location="main.php?finish_quest&finish_all"\'>';
			 }else{
				/*
				сундук с обкастом (включая весь из березки), голд аккаунт на 1 неделю (добавляется к текущему если уже есть у игрока), значек в инфу ("спасти новый год 2019),  чек на 5 екр
				*/
				 $re .= 'Вы обнаружили: Екр. обкаст, Голд аккаунт (+7 дн.), значок в информацию о персонаже!';
				
				 $uid = $u->info['id'];
				 $u->addItem(3101,$uid,'|sudba=1|nosale=1|notransfer=1|frompisher=1');
				 $u->addItem(4037,$uid,'|sudba=1|nosale=1|notransfer=1|frompisher=1');
				 $u->addItem(4038,$uid,'|sudba=1|nosale=1|notransfer=1|frompisher=1');
				 $u->addItem(4039,$uid,'|sudba=1|nosale=1|notransfer=1|frompisher=1');
				 $u->addItem(4040,$uid,'|sudba=1|nosale=1|notransfer=1|frompisher=1');
				 $u->addItem(1461,$uid,'|sudba=1|nosale=1|notransfer=1|frompisher=1');
				 $u->addItem(1462,$uid,'|sudba=1|nosale=1|notransfer=1|frompisher=1');
				 $u->addItem(1463,$uid,'|sudba=1|nosale=1|notransfer=1|frompisher=1');
				 $u->addItem(8231,$uid,'|sudba=1|nosale=1|notransfer=1|frompisher=1');
				 $u->addItem(6814,$uid,'|sudba=1|nosale=1|notransfer=1|frompisher=1');
				 $u->addItem(6817,$uid,'|sudba=1|nosale=1|notransfer=1|frompisher=1');
				 $u->addItem(5084,$uid,'|sudba=1|nosale=1|notransfer=1|frompisher=1');
				
				$prem = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$u->info['id'].'" AND `time_delete` > "'.time().'" LIMIT 1'));
				if(isset($prem['id'])) {
					$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `id_eff` = 435 AND `uid` = "'.$u->info['id'].'" LIMIT 1'));					
					mysql_query('DELETE FROM `premium` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `id_eff` = "435" AND `delete` = 0 LIMIT 1');
					$tmadd = 7 * 86400 + ($prem['time_delete']-time());
					mysql_query("INSERT INTO `eff_users` (`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`, `endtime`, `endfx`) VALUES (435, ".$u->info['id'].", 'LikeBk Gold', 'add_speedhp=150|add_speed_dungeon=50|add_speedmp=150|add_m10=10|add_m11=10|add_exp=100|add_sale_berez=100|add_sale_ekr_berez=100|add_za=10|add_zma=10', 777, ".(time()+$tmadd).", 0, '', 0, '0', 0, '', 1, -1, '0', 0, 1, '', 0, 0, 0, 1, 0, 0, 0);");
					mysql_query("INSERT INTO `premium` (`uid`, `name`, `type`, `time_delete`, `money`, `speed_Loc`, `speedHp`, `speedMp`, `addExp`, `addRep`, `ym_delay`, `yv_drop`, `speed_dunger`, `mfza`, `mf_yron`, `sale_prc`, `saleEkr_prc`, `Exp_zver`) VALUES (".$u->info['id'].", 'LikeBk Gold', 3, ".(time()+$tmadd).", 0, 30, 150, 150, 100, 50, 50, 2, 50, 10, 10, 100, 100, 100);");
					
				}else{
					mysql_query('DELETE FROM `premium` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `id_eff` = "435" AND `delete` = 0 LIMIT 1');
					$tmadd = 7;
					$tmadd = $tmadd * 86400;
					mysql_query("INSERT INTO `eff_users` (`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`, `endtime`, `endfx`) VALUES (435, ".$u->info['id'].", 'LikeBk Gold', 'add_speedhp=150|add_speed_dungeon=50|add_speedmp=150|add_m10=10|add_m11=10|add_exp=100|add_sale_berez=100|add_sale_ekr_berez=100|add_za=10|add_zma=10', 777, ".(time()+$tmadd).", 0, '', 0, '0', 0, '', 1, -1, '0', 0, 1, '', 0, 0, 0, 1, 0, 0, 0);");
					mysql_query("INSERT INTO `premium` (`uid`, `name`, `type`, `time_delete`, `money`, `speed_Loc`, `speedHp`, `speedMp`, `addExp`, `addRep`, `ym_delay`, `yv_drop`, `speed_dunger`, `mfza`, `mf_yron`, `sale_prc`, `saleEkr_prc`, `Exp_zver`) VALUES (".$u->info['id'].", 'LikeBk Gold', 3, ".(time()+$tmadd).", 0, 30, 150, 150, 100, 50, 50, 2, 50, 10, 10, 100, 100, 100);");
					
				}
				
				 $ng['etap'] += 1;
				 mysql_query('UPDATE `ng_quests` SET `etap` = '.$ng['etap'].', `time` = '.(time() + 86400).' WHERE `uid` = '.$u->info['id'].' LIMIT 1');
				 mysql_query('DELETE FROM `actions` WHERE `id` = '.$now['id'].' LIMIT 1');
				 $re = 'Вы завершили задание &quot'.$q['name'].'&quot;';
			 }
			 $re .= '</center>';
		 }elseif($a >= $b[1]) {
			$ng['etap'] += 1;
			mysql_query('UPDATE `ng_quests` SET `etap` = '.$ng['etap'].', `time` = '.(time() + 86400).' WHERE `uid` = '.$u->info['id'].' LIMIT 1');
			mysql_query('DELETE FROM `actions` WHERE `id` = '.$now['id'].' LIMIT 1');
			$re = 'Вы завершили задание &quot'.$q['name'].'&quot;';
		 }else{
			 $re = 'Ничего не получилось...';
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
	<tr><td valign="top"><div align="center" class="pH3">Лачуга Деда Мороза</div><br />
	<center>
<b class="pH3">Привет, путник! На дворе стоят лютые морозы! Мир LIKEBK готовится к празднованию Нового года, но ужасные твари из подземелий и другие нехорошие дядьки хотят сорвать праздник!
Помоги нарушить их злобные планы и спасти Новый год!!! </b><br><br><br>
	<fieldset><? if(isset($now['id'])) { ?> (<?=$q['name']?>)<BR><small><b><?=$q['info']?> <?=$r?></b></small><? }elseif($ng['etap'] >= 6) { echo '<b>Вы закончили квестовую линию...</b>'; }elseif($ng['time'] > time()) { echo 'Следующее задание доступно через: <b>'.$u->timeOut($ng['time'] - time()).'</b>'; }else{ if(isset($_GET['add_quest'])) { echo '('.$q['name'].')<BR><small><b>'.$q['info'],$r.'</b></small>'; }else{  echo '<b>Текущее задание отсувствует</b>'; } }?></fieldset><br>
	<? if($a != 0 && $b[1] != 0 && ($a >= $b[1]) && isset($now['id']) && !isset($_GET['finish_quest'])) { ?>
	<a href="?finish_quest">Завершить задание!</a>
	<? }elseif(!isset($now['id']) && !isset($_GET['add_quest']) && $ng['etap'] < 6) { ?>
		<a href="?add_quest">Получить задание!</a>
<?	}
		if($re != '') {
			echo '<br><br><font color=red><b>'.$re.'</b></font>';
		}

 ?>
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
							  <td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.323&amp;rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.323',1); ?>">Восточная Окраина</a></td>
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
	</TABLE></tr>
<?
}
?>