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
		document.getElementById('modtitle').innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="top">'+title+'</td><td width="30" valign="top"><div align="right"><a title="������� ����" onClick="closeMod(); return false;" href="#">x</a></div></td></tr></table>';
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
<table align=left><tr><td><img src="http://img.likebk.com/i/alchemy1.gif"></td></tr></table><table align=right><tr><td><INPUT TYPE="button" onclick="location.href='main.php?alhp=1';" value="��������" title="��������"> <INPUT TYPE="button" onclick="location.href='main.php';" value="���������" title="���������"></table>
<center><SCRIPT>drwfl("<?=$u->info['login']?>",<?=$u->info['id']?>,"<?=$u->info['level']?>",50,"")</SCRIPT></center>
<?
$pl = mysql_fetch_array(mysql_query('SELECT * FROM `bank_table` ORDER BY `time` DESC LIMIT 1'));
$ba = mysql_fetch_array(mysql_query("SELECT * FROM `bank_alh` WHERE `uid` = '".mysql_real_escape_string($u->info['id'])."' LIMIT 1"));
if(isset($ba['id'])) {
?>
<table width=320>
    <tr>
        <td>
        	<h4>�� ������������ ������:</h4>
            <b><?=$ba['ekr']?></b> ���. / <b><?=$ba['ekr2']?></b> Gold ekr.
            <br />
            <!-- ����������� <b><? //if($ba['USD'] > 0) { echo $ba['USD']; }else{ echo '0.00'; } ?></b> $ -->
            <hr />       
            <?
			// $ucur = round(round(($pl['cur']/$pl['USD']),4)/100*(100-$ba['procent']),2);
			$ucur = 0.2;
			?>     
            <!-- ������������ ����: <b><?=$ucur?></b> $ = 1 ����������. -->
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
					echo '����������: '.$u->microLogin($uba['uid'],1).'<br>';
					//echo '���� ���������� �'.$uba['id'].'<br>';
					if($bontxt != 0){
						echo '����� ����������: '.$bontxt.'%<br>';
					}
					if($bon_nak != 0){
						echo '������������� �����: '.$bon_nak.' ���.<br>';
					}
					if($bon_opt != 0){
						echo '������� �����: '.$bon_opt.' ���.<br>';
					}

				}else{
					echo '<font color=red>���������� ���� ������������, ���� �� ������.</font><hr>';
					unset($_POST['buy_ekr']);
				}
				echo '<hr>';
				if(isset($uba['id'])) {
					$_POST['buy4ekr'] = round($_POST['buy4ekr'],2);
					if(isset($_POST['buy4ekr']) && $_POST['buy4ekr'] < 1) {
						echo '<font color=red>����������� ����� �������: 1 ���.</font><hr>';
						unset($_POST['buy4ekr']);
					}elseif($_POST['buy4ekr'] > $ba['ekr']) {
						echo '<font color=red>������������ ������� �� �����</font><hr>';
						unset($_POST['buy4ekr']);
					}
					if(isset($_POST['buygoodluck'])) { 
					
						$moneyBuyReal = round($_POST['buy4ekr'],2);
						
						echo '<script>alert("������� �� ����� '.$_POST['buy4ekr'].' ���. ���� ��������� �������!");location.href="main.php?alhp=1";</script>';
						$ba['ekr'] -= $_POST['buy4ekr'];
						//$ba['USD'] += round($_POST['buy4ekr']*$ucur,2);
						mysql_query('UPDATE `bank_alh` SET `ekr` = "'.mysql_real_escape_string($ba['ekr']).'" WHERE `id` = "'.$ba['id'].'" LIMIT 1');
						mysql_query('UPDATE `bank` SET `moneyBuyReal` = `moneyBuyReal` + '.mysql_real_escape_string($moneyBuyReal).' , `moneyBuy` = `moneyBuy` + '.mysql_real_escape_string($ekr).',`money2` = `money2` + '.mysql_real_escape_string($ekr).' WHERE `id` = "'.$uba['id'].'" LIMIT 1');
						$u->addDelo(788,$uba['uid'],'����� '.$ekr.' ���. � �������� '.$u->info['login'].'',time(),  '','AlhimPayment',$ekr,'');					
						$money = round($ekr,2);
						//$money = round($money/100*(100-$ba['procent']),2);
						
						$user = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`city`,`sex`,`room`,`referals` FROM `users` WHERE `id` = "'.mysql_real_escape_string($uba['uid']).'" LIMIT 1'));
						echo '['.$user['referals'].']';
						if( $user['referals'] > 0 && $_POST['buy4ekr'] >= 1 ) {
							$refer = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`city`,`sex`,`room`,`referals` FROM `users` WHERE `id` = "'.mysql_real_escape_string($user['referals']).'" LIMIT 1'));
							if( isset($refer['id']) ) {
								$r = '<span class=date>'.date('d.m.Y H:i').'</span> <img src=http://img.likebk.com/i/align/align50.gif width=12 height=15 /><u><b>����</b> &laquo;����������� �����&raquo; / ������� <b>'.$u->info['login'].'</b></u> ��������: ';
								if($refer['sex'] == 1) {
									$r .= '���������';
								}else{
									$r .= '���������';
								}
								$ubaref = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$refer['id'].'" ORDER BY `id` DESC LIMIT 1'));
								if( isset($ubaref['id']) ) {
									mysql_query('UPDATE `bank` SET `money2` = "'.mysql_real_escape_string($ubaref['money2']+round($ekr*0.07,2)).'", `referal_money` = "'.mysql_real_escape_string($ubaref['referal_money']+round($ekr*0.07,2)).'"  WHERE `id` = "'.$ubaref['id'].'" LIMIT 1');
								}
								$r .= ' <b>'.$refer['login'].'</b>, ��� ������� &quot;'.$user['login'].'&quot; �������� EKP. � �� ��� ���� ��������� '.round($ekr*0.07,2).' EKP. ';
								mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$refer['city']."','".$refer['room']."','','".$refer['login']."','".$r."','-1','5','0')");
							}
						}
						
						$r = '<span class=date>'.date('d.m.Y H:i').'</span> <img src=http://img.likebk.com/i/align/align50.gif width=12 height=15 /><u><b>����</b> &laquo;����������� �����&raquo; / ������� <b>'.$u->info['login'].'</b></u> ��������: ';
						
						if($user['sex'] == 1) {
							$r .= '���������';
						}else{
							$r .= '���������';
						}
						
						$r .= ' <b>'.$user['login'].'</b>, �� ��� ���� ��������� '.$ekr.' EKP. ���������� ��� �� �������!';
						
						mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$user['city']."','".$user['room']."','','".$user['login']."','".$r."','-1','5','0')");
												
						$text_msg = '������� <b>'.$u->info['login'].'</b> �������� ������� <b>'.$_POST['buy4ekr'].'</b> ���. (������ '.$ba['procent'].'% , ����������� '.$ba['USD'].'$). ����������: '.$u->microLogin($uba['uid'],1).'. ���������� ���� ����������: � <b>'.$uba['id'].'</b>.';
						
						$balance = mysql_fetch_array(mysql_query('SELECT SUM(`money`) FROM `balance_money` WHERE `cancel` = 0'));
						$balance = $balance[0]+$money;
						mysql_query('INSERT INTO `balance_money` (`time`,`ip`,`money`,`comment2`,`balance`,`cancel`) VALUES ("'.time().'","'.$u->info['ip'].'","'.mysql_real_escape_string((int)$money).'","'.mysql_real_escape_string($text_msg).'","'.$balance.'","'.time().'")');
						
					}else{
						echo '����� ���.:';
						if(!isset($_POST['buy4ekr'])) {
							echo '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <input name="buy4ekr" style="width:50px;" value="0.00" /> <input value="�����" type="submit" /><br>';
						}else{
							echo ' <b>'.round((int)$_POST['buy4ekr'],2).'</b> ���.<input name="buy4ekr" type="hidden" value="'.$_POST['buy4ekr'].'" />';
							echo ' &nbsp; <input type="submit" name="buygoodluck" value="��������� �������">';
						}
					}
				}
			}
			?>
            <? if(isset($_POST['buy_ekr'])){ ?>
            	<input name="buy_ekr" type="hidden" value="<?=$_POST['buy_ekr']?>" /> 
            <? }else{ ?>
            	��������� ���. �� ���� ������: 
            	<input name="buy_ekr" style="width:200px;" placeholder="������� id ���������" value="<?=$_POST['buy_ekr']?>" /> 
            	<input value="�����" type="submit" />
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
					
					echo '����������: '.$u->microLogin($uba['id'],1).'<br>';
					//echo '���� ���������� �'.$uba['id'].'<br>';
					/*if($bontxt != 0){
						echo '����� ����������: '.$bontxt.'%<br>';
					}
					if($bon_nak != 0){
						echo '������������� �����: '.$bon_nak.' ���.<br>';
					}
					if($bon_opt != 0){
						echo '������� �����: '.$bon_opt.' ���.<br>';
					}*/

				}else{
					echo '<font color=red>�������� �� ������.</font><hr>';
					unset($_POST['buy_ekr2']);
				}
				echo '<hr>';
				if(isset($uba['id'])) {
					$_POST['buy4ekr'] = round($_POST['buy4ekr'],2);
					if(isset($_POST['buy4ekr']) && $_POST['buy4ekr'] < 0.01) {
						echo '<font color=red>����������� ����� �������: 0.01 Gold ekr.</font><hr>';
						unset($_POST['buy4ekr']);
					}elseif($_POST['buy4ekr'] > $ba['ekr2']) {
						echo '<font color=red>������������ ������� �� �����</font><hr>';
						unset($_POST['buy4ekr']);
					}
					if(isset($_POST['buygoodluck'])) { 
										
						$moneyBuyReal = round($_POST['buy4ekr'],2);
						
						$user = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`city`,`sex`,`room`,`referals` FROM `users` WHERE `id` = "'.mysql_real_escape_string($uba['id']).'" LIMIT 1'));
												
						echo '<script>alert("������� �� ����� '.$_POST['buy4ekr'].' Gold ekr. ���� ��������� �������!");location.href="main.php?alhp=1";</script>';
						$ba['ekr2'] -= $_POST['buy4ekr'];
						//$ba['USD'] += round($_POST['buy4ekr']*$ucur,2);
						mysql_query('UPDATE `bank_alh` SET `ekr2` = "'.mysql_real_escape_string($ba['ekr2']).'" WHERE `id` = "'.$ba['id'].'" LIMIT 1');
						mysql_query('UPDATE `bank` SET `moneyBuyReal` = `moneyBuyReal` + '.mysql_real_escape_string($ekr).' , `moneyBuy` = `moneyBuy` + '.mysql_real_escape_string($moneyBuyReal).' WHERE `uid` = "'.$uba['id'].'" LIMIT 1');
						mysql_query('UPDATE `users` SET `money5` = `money5` + '.mysql_real_escape_string($ekr).' WHERE `id` = "'.$uba['id'].'" LIMIT 1');
						$u->addDelo(788,$uba['id'],'����� '.$ekr.' Gold ekr. � �������� '.$u->info['login'].'',time(),  '','AlhimPayment',$ekr,'');					
						$money = round($ekr,2);
												
						//$money = round($money/100*(100-$ba['procent']),2);
												
						$r = '<span class=date>'.date('d.m.Y H:i').'</span> <img src=http://img.likebk.com/i/align/align50.gif width=12 height=15 /><u><b>����</b> &laquo;����������� �����&raquo; / ������� <b>'.$u->info['login'].'</b></u> ��������: ';
						
						if($user['sex'] == 1) {
							$r .= '���������';
						}else{
							$r .= '���������';
						}
						
						$r .= ' <b>'.$user['login'].'</b>, �� ��� ���� ��������� '.$ekr.' Gold Ekr. ���������� ��� �� �������!';
						
						mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$user['city']."','".$user['room']."','','".$user['login']."','".$r."','-1','5','0')");
												
						$text_msg = '������� <b>'.$u->info['login'].'</b> �������� ������� <b>'.$_POST['buy4ekr'].'</b> Gold Ekr. (������ '.$ba['procent'].'% , ����������� '.$ba['USD'].'$). ����������: '.$u->microLogin($uba['uid'],1).'. ���������� ���� ����������: � <b>'.$uba['id'].'</b>.';
						
						$balance = mysql_fetch_array(mysql_query('SELECT SUM(`money`) FROM `balance_money` WHERE `cancel` = 0'));
						$balance = $balance[0]+$money;
						mysql_query('INSERT INTO `balance_money` (`time`,`ip`,`money`,`comment2`,`balance`,`cancel`) VALUES ("'.time().'","'.$u->info['ip'].'","'.mysql_real_escape_string((int)$money).'","'.mysql_real_escape_string($text_msg).'","'.$balance.'","'.time().'")');
						
					}else{
						echo '����� Gold Ekr.:';
						if(!isset($_POST['buy4ekr'])) {
							echo '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; <input name="buy4ekr" style="width:50px;" value="0.00" /> <input value="�����" type="submit" /><br>';
						}else{
							echo ' <b>'.round((int)$_POST['buy4ekr'],2).'</b> ���.<input name="buy4ekr" type="hidden" value="'.$_POST['buy4ekr'].'" />';
							echo ' &nbsp; <input type="submit" name="buygoodluck" value="��������� �������">';
						}
					}
				}
			}
			?>
            <? if(isset($_POST['buy_ekr2'])){ ?>
            	<input name="buy_ekr2" type="hidden" value="<?=$_POST['buy_ekr2']?>" /> 
            <? }else{ ?>
            	��������� Gold Ekr. �� ���� ������: 
				<?
				if( $c['ekr2bonus'] > 0 ) {
					echo ' <b style="color:red">+'.$c['ekr2bonus'].'% �� 10 Gold ekr</b>';
				}
				?> 
            	<input name="buy_ekr2" style="width:200px;" placeholder="������� id ���������" value="<?=$_POST['buy_ekr2']?>" /> 
            	<input value="�����" type="submit" />
            <? } ?>
        	</form>
        </td>
    </tr>
</table>
<?
}

echo "<br><h4><div align=left>����������� �������� � ������ ��������</div></h4>";

$p['m1'] = 1;
$srok = array(15=>'15 �����',30=>'30 �����',60=>'���� ���',180=>'��� ����',360=>'����� �����',720=>'���������� �����',1440=>'���� �����',4320=>'���� �����');
		
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
  $u->send('',1,$infcity,'',htmlspecialchars($_POST['tologin'],NULL,'cp1251'),'<font color=darkblue>��������� ���������� �� </font> <b>'.$u->info['login'].'</b>: '.$_POST['message'].'',-1,6,0,0,0,1);
}
?>
<table>
<a href="#" onClick="openMod('<b>�������� ��������</b>','<form action=\'main.php?<? echo alhp.'&usemod='.$code; ?>\' method=\'post\'>����� ���������: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>����� ��������: &nbsp; <select style=\'margin-left:2px;\' name=\'time\'><option value=\'30\'>30 ����n</option></select> <input type=\'submit\' name=\'usem1\' value=\'���-��\'></form>');"><img src="http://img.likebk.com/i/items/silence30.gif" title="�������� ��������" /></a>
&nbsp;
<!-- <a onClick="openMod('<b>������������</b>','<form action=\'main.php?<? echo alhp.'&usemod='.$code; ?>\' method=\'post\'>����� ���������: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\' value=\'<? echo $u->info['login']; ?>\'><br>�����: &nbsp; <select style=\'margin-left:2px;\' name=\'city\'><option value=\'capitalcity\'>capitalcity</option><option value=\'angelscity\'>angelscity</option><option value=\'demonscity\'>demonscity</option><option value=\'devilscity\'>devilscity</option><option value=\'suncity\'>suncity</option><option value=\'emeraldscity\'>emeraldscity</option><option value=\'sandcity\'>sandcity</option><option value=\'mooncity\'>mooncity</option><option value=\'eastcity\'>eastcity</option><option value=\'abandonedplain\'>abandonedplain</option><option value=\'dreamscity\'>dreamscity</option><option value=\'lowcity\'>devilscity</option><option value=\'oldcity\'>devilscity</option><option value=\'newcapitalcity\'>newcapital</option></select> <input type=\'submit\' name=\'teleport\' value=\'���-��\'></form>');" href="#"><img src="http://img.likebk.com/i/items/teleport.gif" title="������������" /></a></table><br /> -->
<br><h4>��������</h4><!--�� ������ ��������� �������� ��������� ������ ���������, ���� ���� �� ��������� � offline ��� ������ ������.-->
<form method=post style="margin:5px;">
	����� ��������� <input type=text size=20 name="tologin"> 
	��������� <input type=text size=80 name="message"> 
	<input type=submit value="���������">
</form>
<?php 
	// if($u->info['id'] == 155){
		$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.mysql_real_escape_string($u->info['id']).'" AND `dealer` > "0" LIMIT 1'));
		// $usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "202491" AND `dealer` > "0" LIMIT 1'));
		if(isset($usr['id'])) {
			echo '<h3 style="text-align:left;">������� '.$usr['login'].':</h3>';
			$users_delo =  mysql_query('SELECT * FROM `users_delo` WHERE `login` = "AlhimPayment" AND `text` LIKE "%'.$usr['login'].'%" ORDER BY `time` DESC');
			$coun = 1;
			$sum = 0;
			echo "<table id='refs' border='1'><tr><td><b>�</b></td><td><b>�����:</b></td><td><b>�����:</b></td><td><b>����:</b></td></tr>";
			while($us_delo = mysql_fetch_array($users_delo)){
				$us = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$us_delo['uid'].'"'));
				$str = str_replace('� �������� '.$usr['login'], '', $us_delo['text']);
				echo '<tr><td>'.$coun.'</td><td><b>'.$us['login'].'</b></td><td>'.$str.'</td><td>'.date('d.m.Y H:i', $us_delo['time']).'</td></tr>';
				$sum += $us_delo['moneyOut'];
				$coun++;
			}
			echo "</table>";
			echo '<br><b>����� ������: '.$sum.' ���.</b>';
		}
	// }
 ?>
