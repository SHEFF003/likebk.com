<?
if(!defined('GAME'))
{
	die();
}
function bonus_optom($a) { 
      global $c;
	  $bon = array("100", "90", "80", "70", "60", "50", "40", "30", "20", "10");
      $pro = array("10", "9", "8", "7", "6", "5", "4", "3", "2", "1");
      $i = 0;
      $pr = 0;
      while($i < 10){
        if($a >= $bon[$i]){
           $pr = $pro[$i];
          break;
        }
        $i++;
      }
	  $pr += $c['ekrbonus'];
      return (floor( ($a*$pr/100) *100)/100);
}
function bonus_nak($a,$id){
  $m = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$id.'"'));
  $nak = $m['moneyBuy'];
  $nak_bonus = 0;
  //alert(nak);
  $bon = array("3000", "2500", "2000", "1700", "1500", "1300", "1200", "1100", "1000", "900", "800", "700", "600", "500", "400", "300", "200", "100", "50", "10");
  $pro = array("30", "27", "25", "23", "21", "19", "17", "15", "13", "11", "10", "9", "8", "7", "6", "5", "4", "3", "2", "1");
  $i = 0;
  while($i < 20){
    if($nak >= $bon[$i]){
       $nak_bonus = $pro[$i];
      break;
    }
    $i++;
  }
  $pr = 0;
  if($nak_bonus == 0){
    $pr = 0;   
  }
  else{
    $pr = $nak_bonus;
  }
  return (floor( ($a*$pr/100) *100)/100);
}

?>
<script type="text/javascript" language="javascript" src='http://img.likebk.com/js/commoninf.js'></script>
<style>
.modpow {
	background-color:#ddd5bf;
}
.mt {
	background-color:#b1a993;
	padding-left:10px;
	padding-right:10px;
	padding-top:5px;
	padding-bottom:5px;
}
.md {
	padding:10px;
}
</style>
<script>
function openMod(title,dat)
{
	var d = document.getElementById('useMagic');
	if(d!=undefined)
	{
		document.getElementById('modtitle').innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="top">'+title+'</td><td width="30" valign="top"><div align="right"><a title="Закрыть окно" onClick="closeMod(); return false;" href="#">x</a></div></td></tr></table>';
		document.getElementById('moddata').innerHTML = dat;
		d.style.display = '';
	}
}

function closeMod()
{
	var d = document.getElementById('useMagic');
	if(d!=undefined)
	{
		document.getElementById('modtitle').innerHTML = '';
		document.getElementById('moddata').innerHTML = '';
		d.style.display = 'none';
	}
}
</script>
<div id="useMagic" style="display:none; position:absolute; border:solid 1px #776f59; left: 50px; top: 186px;" class="modpow">
<div class="mt" id="modtitle"></div><div class="md" id="moddata"></div></div>
<table align=left><tr><td><img src="http://img.likebk.com/i/alchemy1.gif"></td></tr></table><table align=right><tr><td><INPUT TYPE="button" onclick="location.href='main.php?alhp=1';" value="Обновить" title="Обновить"> <INPUT TYPE="button" onclick="location.href='main.php';" value="Вернуться" title="Вернуться"></table>
<center><SCRIPT>drwfl("<?=$u->info['login']?>",<?=$u->info['id']?>,"<?=$u->info['level']?>",50,"")</SCRIPT></center>
<?
$pl = mysql_fetch_array(mysql_query('SELECT * FROM `bank_table` ORDER BY `time` DESC LIMIT 1'));
$ba = mysql_fetch_array(mysql_query("SELECT * FROM `bank_alh` WHERE `uid` = '".mysql_real_escape_string($u->info['id'])."' LIMIT 1"));
if(isset($ba['id'])) {
?>
<table width=320>
    <tr>
        <td>
        	<h4>На алхимических счетах:</h4>
            <b><?=$ba['ekr']?></b> екр. / <b><?=$ba['ekr2']?></b> Gold ekr.
            <br />
            <!-- Задолжность <b><? //if($ba['USD'] > 0) { echo $ba['USD']; }else{ echo '0.00'; } ?></b> $ -->
            <hr />       
            <?
			// $ucur = round(round(($pl['cur']/$pl['USD']),4)/100*(100-$ba['procent']),2);
			$ucur = 0.2;
			?>     
            <!-- Персональный курс: <b><?=$ucur?></b> $ = 1 Еврокредит. -->
            <!-- <hr /> -->
            <form method="post" action="main.php?alhp=1">
            <?
			if(isset($_POST['buy_ekr'])) {
								
				$uba = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.mysql_real_escape_string($_POST['buy_ekr']).'" AND `block` = "0" LIMIT 1'));
					$bon_nak = bonus_nak($_POST['buy4ekr'], $_POST['buy_ekr']);    
					$bon_opt = bonus_optom($_POST['buy4ekr']);          
					$bon_nak = floor($bon_nak*100)/100;
					$bon_opt = floor($bon_opt*100)/100;
				if(isset($uba['id'])) {
					if($uba['moneyBuy'] == 0){
						$bonus = 0.2;
						$bontxt = 20;
					}
					else{
						$bonus = 0;
						$bontxt = 0;
					}
					$ekr = $_POST['buy4ekr'] + ($_POST['buy4ekr'] * $bonus) + $bon_nak + $bon_opt;
					echo 'Покупатель: '.$u->microLogin($uba['uid'],1).'<br>';
					//echo 'Счет покупателя №'.$uba['id'].'<br>';
					if($bontxt != 0){
						echo 'Бонус покупателя: '.$bontxt.'%<br>';
					}
					if($bon_nak != 0){
						echo 'Накопительный бонус: '.$bon_nak.' ЕКР.<br>';
					}
					if($bon_opt != 0){
						echo 'Оптовый бонус: '.$bon_opt.' ЕКР.<br>';
					}

				}else{
					echo '<font color=red>Банковский счет заблокирован, либо не найден.</font><hr>';
					unset($_POST['buy_ekr']);
				}
				echo '<hr>';
				if(isset($uba['id'])) {
					$_POST['buy4ekr'] = round($_POST['buy4ekr'],2);
					if(isset($_POST['buy4ekr']) && $_POST['buy4ekr'] < 1) {
						echo '<font color=red>Минимальная сумма продажи: 1 екр.</font><hr>';
						unset($_POST['buy4ekr']);
					}elseif($_POST['buy4ekr'] > $ba['ekr']) {
						echo '<font color=red>Недостаточно средств на счете</font><hr>';
						unset($_POST['buy4ekr']);
					}
					if(isset($_POST['buygoodluck'])) { 
					
						$moneyBuyReal = round($_POST['buy4ekr'],2);
						
						echo '<script>alert("Продажа на сумму '.$_POST['buy4ekr'].' екр. была совершена успешно!");location.href="main.php?alhp=1";</script>';
						$ba['ekr'] -= $_POST['buy4ekr'];
						//$ba['USD'] += round($_POST['buy4ekr']*$ucur,2);
						mysql_query('UPDATE `bank_alh` SET `ekr` = "'.mysql_real_escape_string($ba['ekr']).'" WHERE `id` = "'.$ba['id'].'" LIMIT 1');
						mysql_query('UPDATE `bank` SET `moneyBuyReal` = `moneyBuyReal` + '.mysql_real_escape_string($moneyBuyReal).' , `moneyBuy` = `moneyBuy` + '.mysql_real_escape_string($ekr).',`money2` = `money2` + '.mysql_real_escape_string($ekr).' WHERE `id` = "'.$uba['id'].'" LIMIT 1');
						$u->addDelo(788,$uba['uid'],'Купил '.$ekr.' екр. у Алхимика '.$u->info['login'].'',time(),  '','AlhimPayment',$ekr,'');					
						$money = round($ekr,2);
						//$money = round($money/100*(100-$ba['procent']),2);
						
						$user = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`city`,`sex`,`room`,`referals` FROM `users` WHERE `id` = "'.mysql_real_escape_string($uba['uid']).'" LIMIT 1'));
						echo '['.$user['referals'].']';
						if( $user['referals'] > 0 && $_POST['buy4ekr'] >= 1 ) {
							$refer = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`city`,`sex`,`room`,`referals` FROM `users` WHERE `id` = "'.mysql_real_escape_string($user['referals']).'" LIMIT 1'));
							if( isset($refer['id']) ) {
								$r = '<span class=date>'.date('d.m.Y H:i').'</span> <img src=http://img.likebk.com/i/align/align50.gif width=12 height=15 /><u><b>Банк</b> &laquo;Бойцовского клуба&raquo; / Алхимик <b>'.$u->info['login'].'</b></u> сообщает: ';
								if($refer['sex'] == 1) {
									$r .= 'Уважаемая';
								}else{
									$r .= 'Уважаемый';
								}
								$ubaref = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$refer['id'].'" ORDER BY `id` DESC LIMIT 1'));
								if( isset($ubaref['id']) ) {
									mysql_query('UPDATE `bank` SET `money2` = "'.mysql_real_escape_string($ubaref['money2']+round($ekr*0.07,2)).'", `referal_money` = "'.mysql_real_escape_string($ubaref['referal_money']+round($ekr*0.07,2)).'"  WHERE `id` = "'.$ubaref['id'].'" LIMIT 1');
								}
								$r .= ' <b>'.$refer['login'].'</b>, Ваш реферал &quot;'.$user['login'].'&quot; приобрел EKP. и на Ваш счет зачислено '.round($ekr*0.07,2).' EKP. ';
								mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$refer['city']."','".$refer['room']."','','".$refer['login']."','".$r."','-1','5','0')");
							}
						}
						
						$r = '<span class=date>'.date('d.m.Y H:i').'</span> <img src=http://img.likebk.com/i/align/align50.gif width=12 height=15 /><u><b>Банк</b> &laquo;Бойцовского клуба&raquo; / Алхимик <b>'.$u->info['login'].'</b></u> сообщает: ';
						
						if($user['sex'] == 1) {
							$r .= 'Уважаемая';
						}else{
							$r .= 'Уважаемый';
						}
						
						$r .= ' <b>'.$user['login'].'</b>, на Ваш счет зачислено '.$ekr.' EKP. Благодарим Вас за покупку!';
						
						mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$user['city']."','".$user['room']."','','".$user['login']."','".$r."','-1','5','0')");
												
						$text_msg = 'Алхимик <b>'.$u->info['login'].'</b> совершил продажу <b>'.$_POST['buy4ekr'].'</b> екр. (скидка '.$ba['procent'].'% , задолжность '.$ba['USD'].'$). Покупатель: '.$u->microLogin($uba['uid'],1).'. Банковский счет покупателя: № <b>'.$uba['id'].'</b>.';
						
						$balance = mysql_fetch_array(mysql_query('SELECT SUM(`money`) FROM `balance_money` WHERE `cancel` = 0'));
						$balance = $balance[0]+$money;
						mysql_query('INSERT INTO `balance_money` (`time`,`ip`,`money`,`comment2`,`balance`,`cancel`) VALUES ("'.time().'","'.$u->info['ip'].'","'.mysql_real_escape_string((int)$money).'","'.mysql_real_escape_string($text_msg).'","'.$balance.'","'.time().'")');
						
					}else{
						echo 'Сумма екр.:';
						if(!isset($_POST['buy4ekr'])) {
							echo '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <input name="buy4ekr" style="width:50px;" value="0.00" /> <input value="Далее" type="submit" /><br>';
						}else{
							echo ' <b>'.round((int)$_POST['buy4ekr'],2).'</b> екр.<input name="buy4ekr" type="hidden" value="'.$_POST['buy4ekr'].'" />';
							echo ' &nbsp; <input type="submit" name="buygoodluck" value="Совершить продажу">';
						}
					}
				}
			}
			?>
            <? if(isset($_POST['buy_ekr'])){ ?>
            	<input name="buy_ekr" type="hidden" value="<?=$_POST['buy_ekr']?>" /> 
            <? }else{ ?>
            	Перевести екр. на счет игрока: 
            	<input name="buy_ekr" style="width:200px;" placeholder="Введите id персонажа" value="<?=$_POST['buy_ekr']?>" /> 
            	<input value="Далее" type="submit" />
            <? } ?>
        	</form>
            <hr>
            <form method="post" action="main.php?alhp=1">
            <?
			if(isset($_POST['buy_ekr2'])) {
														
				$uba = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.mysql_real_escape_string($_POST['buy_ekr2']).'" LIMIT 1'));
					$bon_nak = bonus_nak($_POST['buy4ekr'], $_POST['buy_ekr2']);    
					$bon_opt = bonus_optom($_POST['buy4ekr']);          
					$bon_nak = floor($bon_nak*100)/100;
					$bon_opt = floor($bon_opt*100)/100;
				if(isset($uba['id'])) {
					$bonus = 0;
					$bontxt = 0;
																
					$ekr = $_POST['buy4ekr'] + ($_POST['buy4ekr'] * $bonus) + $bon_nak + $bon_opt;
					$ekr = $_POST['buy4ekr'];
					
					if( $ekr >= 10 && $c['ekr2bonus'] > 0 ) {
						$ekr += round($ekr/100*$c['ekr2bonus'],2);
					}
					
					echo 'Покупатель: '.$u->microLogin($uba['id'],1).'<br>';
					//echo 'Счет покупателя №'.$uba['id'].'<br>';
					/*if($bontxt != 0){
						echo 'Бонус покупателя: '.$bontxt.'%<br>';
					}
					if($bon_nak != 0){
						echo 'Накопительный бонус: '.$bon_nak.' ЕКР.<br>';
					}
					if($bon_opt != 0){
						echo 'Оптовый бонус: '.$bon_opt.' ЕКР.<br>';
					}*/

				}else{
					echo '<font color=red>Персонаж не найден.</font><hr>';
					unset($_POST['buy_ekr2']);
				}
				echo '<hr>';
				if(isset($uba['id'])) {
					$_POST['buy4ekr'] = round($_POST['buy4ekr'],2);
					if(isset($_POST['buy4ekr']) && $_POST['buy4ekr'] < 0.01) {
						echo '<font color=red>Минимальная сумма продажи: 0.01 Gold ekr.</font><hr>';
						unset($_POST['buy4ekr']);
					}elseif($_POST['buy4ekr'] > $ba['ekr2']) {
						echo '<font color=red>Недостаточно средств на счете</font><hr>';
						unset($_POST['buy4ekr']);
					}
					if(isset($_POST['buygoodluck'])) { 
										
						$moneyBuyReal = round($_POST['buy4ekr'],2);
						
						$user = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`city`,`sex`,`room`,`referals` FROM `users` WHERE `id` = "'.mysql_real_escape_string($uba['id']).'" LIMIT 1'));
												
						echo '<script>alert("Продажа на сумму '.$_POST['buy4ekr'].' Gold ekr. была совершена успешно!");location.href="main.php?alhp=1";</script>';
						$ba['ekr2'] -= $_POST['buy4ekr'];
						//$ba['USD'] += round($_POST['buy4ekr']*$ucur,2);
						mysql_query('UPDATE `bank_alh` SET `ekr2` = "'.mysql_real_escape_string($ba['ekr2']).'" WHERE `id` = "'.$ba['id'].'" LIMIT 1');
						mysql_query('UPDATE `bank` SET `moneyBuyReal` = `moneyBuyReal` + '.mysql_real_escape_string($ekr).' , `moneyBuy` = `moneyBuy` + '.mysql_real_escape_string($moneyBuyReal).' WHERE `uid` = "'.$uba['id'].'" LIMIT 1');
						mysql_query('UPDATE `users` SET `money5` = `money5` + '.mysql_real_escape_string($ekr).' WHERE `id` = "'.$uba['id'].'" LIMIT 1');
						$u->addDelo(788,$uba['id'],'Купил '.$ekr.' Gold ekr. у Алхимика '.$u->info['login'].'',time(),  '','AlhimPayment',$ekr,'');					
						$money = round($ekr,2);
												
						//$money = round($money/100*(100-$ba['procent']),2);
												
						$r = '<span class=date>'.date('d.m.Y H:i').'</span> <img src=http://img.likebk.com/i/align/align50.gif width=12 height=15 /><u><b>Банк</b> &laquo;Бойцовского клуба&raquo; / Алхимик <b>'.$u->info['login'].'</b></u> сообщает: ';
						
						if($user['sex'] == 1) {
							$r .= 'Уважаемая';
						}else{
							$r .= 'Уважаемый';
						}
						
						$r .= ' <b>'.$user['login'].'</b>, на Ваш счет зачислено '.$ekr.' Gold Ekr. Благодарим Вас за покупку!';
						
						mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$user['city']."','".$user['room']."','','".$user['login']."','".$r."','-1','5','0')");
												
						$text_msg = 'Алхимик <b>'.$u->info['login'].'</b> совершил продажу <b>'.$_POST['buy4ekr'].'</b> Gold Ekr. (скидка '.$ba['procent'].'% , задолжность '.$ba['USD'].'$). Покупатель: '.$u->microLogin($uba['uid'],1).'. Банковский счет покупателя: № <b>'.$uba['id'].'</b>.';
						
						$balance = mysql_fetch_array(mysql_query('SELECT SUM(`money`) FROM `balance_money` WHERE `cancel` = 0'));
						$balance = $balance[0]+$money;
						mysql_query('INSERT INTO `balance_money` (`time`,`ip`,`money`,`comment2`,`balance`,`cancel`) VALUES ("'.time().'","'.$u->info['ip'].'","'.mysql_real_escape_string((int)$money).'","'.mysql_real_escape_string($text_msg).'","'.$balance.'","'.time().'")');
						
					}else{
						echo 'Сумма Gold Ekr.:';
						if(!isset($_POST['buy4ekr'])) {
							echo '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <input name="buy4ekr" style="width:50px;" value="0.00" /> <input value="Далее" type="submit" /><br>';
						}else{
							echo ' <b>'.round((int)$_POST['buy4ekr'],2).'</b> екр.<input name="buy4ekr" type="hidden" value="'.$_POST['buy4ekr'].'" />';
							echo ' &nbsp; <input type="submit" name="buygoodluck" value="Совершить продажу">';
						}
					}
				}
			}
			?>
            <? if(isset($_POST['buy_ekr2'])){ ?>
            	<input name="buy_ekr2" type="hidden" value="<?=$_POST['buy_ekr2']?>" /> 
            <? }else{ ?>
            	Перевести Gold Ekr. на счет игрока: 
				<?
				if( $c['ekr2bonus'] > 0 ) {
					echo ' <b style="color:red">+'.$c['ekr2bonus'].'% от 10 Gold ekr</b>';
				}
				?> 
            	<input name="buy_ekr2" style="width:200px;" placeholder="Введите id персонажа" value="<?=$_POST['buy_ekr2']?>" /> 
            	<input value="Далее" type="submit" />
            <? } ?>
        	</form>
        </td>
    </tr>
</table>
<?
}

echo "<br><h4><div align=left>Необходимые средства в работе алхимика</div></h4>";

$p['m1'] = 1;
$srok = array(15=>'15 минут',30=>'30 минут',60=>'один час',180=>'три часа',360=>'шесть часов',720=>'двенадцать часов',1440=>'одни сутки',4320=>'трое суток');
		
	if(isset($_GET['usemod']))
	{
		if(isset($_POST['usem1']))
		{
			include('moder/usem1.php');					
		}elseif(isset($_POST['teleport']))
		{
			include('moder/teleport.php');
		}
	}
if(isset($_POST['tologin'],$_POST['message'])) {
  $u->send('',1,$infcity,'',htmlspecialchars($_POST['tologin'],NULL,'cp1251'),'<font color=darkblue>Сообщение телеграфом от </font> <b>'.$u->info['login'].'</b>: '.$_POST['message'].'',-1,6,0,0,0,1);
}
?>
<table>
<a href="#" onClick="openMod('<b>Заклятие молчания</b>','<form action=\'main.php?<? echo alhp.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Время заклятия: &nbsp; <select style=\'margin-left:2px;\' name=\'time\'><option value=\'30\'>30 минуn</option></select> <input type=\'submit\' name=\'usem1\' value=\'Исп-ть\'></form>');"><img src="http://img.likebk.com/i/items/silence30.gif" title="Заклятие молчания" /></a>
&nbsp;
<!-- <a onClick="openMod('<b>Телепортация</b>','<form action=\'main.php?<? echo alhp.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\' value=\'<? echo $u->info['login']; ?>\'><br>Город: &nbsp; <select style=\'margin-left:2px;\' name=\'city\'><option value=\'capitalcity\'>capitalcity</option><option value=\'angelscity\'>angelscity</option><option value=\'demonscity\'>demonscity</option><option value=\'devilscity\'>devilscity</option><option value=\'suncity\'>suncity</option><option value=\'emeraldscity\'>emeraldscity</option><option value=\'sandcity\'>sandcity</option><option value=\'mooncity\'>mooncity</option><option value=\'eastcity\'>eastcity</option><option value=\'abandonedplain\'>abandonedplain</option><option value=\'dreamscity\'>dreamscity</option><option value=\'lowcity\'>devilscity</option><option value=\'oldcity\'>devilscity</option><option value=\'newcapitalcity\'>newcapital</option></select> <input type=\'submit\' name=\'teleport\' value=\'Исп-ть\'></form>');" href="#"><img src="http://img.likebk.com/i/items/teleport.gif" title="Телепортация" /></a></table><br /> -->
<br><h4>Телеграф</h4><!--Вы можете отправить короткое сообщение любому персонажу, даже если он находится в offline или другом городе.-->
<form method=post style="margin:5px;">
	Логин персонажа <input type=text size=20 name="tologin"> 
	сообщение <input type=text size=80 name="message"> 
	<input type=submit value="отправить">
</form>
<?php 
	// if($u->info['id'] == 155){
		$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.mysql_real_escape_string($u->info['id']).'" AND `dealer` > "0" LIMIT 1'));
		// $usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "202491" AND `dealer` > "0" LIMIT 1'));
		if(isset($usr['id'])) {
			echo '<h3 style="text-align:left;">Алхимик '.$usr['login'].':</h3>';
			$users_delo =  mysql_query('SELECT * FROM `users_delo` WHERE `login` = "AlhimPayment" AND `text` LIKE "%'.$usr['login'].'%" ORDER BY `time` DESC');
			$coun = 1;
			$sum = 0;
			echo "<table id='refs' border='1'><tr><td><b>№</b></td><td><b>Логин:</b></td><td><b>Купил:</b></td><td><b>Дата:</b></td></tr>";
			while($us_delo = mysql_fetch_array($users_delo)){
				$us = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$us_delo['uid'].'"'));
				$str = str_replace('у Алхимика '.$usr['login'], '', $us_delo['text']);
				echo '<tr><td>'.$coun.'</td><td><b>'.$us['login'].'</b></td><td>'.$str.'</td><td>'.date('d.m.Y H:i', $us_delo['time']).'</td></tr>';
				$sum += $us_delo['moneyOut'];
				$coun++;
			}
			echo "</table>";
			echo '<br><b>Всего продал: '.$sum.' екр.</b>';
		}
	// }
 ?>
