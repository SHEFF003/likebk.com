<?php
define('GAME',true);
include('../_incl_data/__config.php');
include('../_incl_data/class/__db_connect.php');
include('../_incl_data/class/__user.php');
if($_GET['msg'] == 1){?>
	<div id="upda">
		<!-- ������: <strong style="color: #23527c"><b><? //echo $u->bank['money2']; ?></b>&nbsp;���.</strong><br /><? /*}*/ ?> -->
		������: <strong style="color: #23527c"><b><? echo $u->bank['money2']; ?></b>&nbsp;���.</strong><? /*}*/ ?>
		<b><a style="display: inline-block; text-decoration: underline; font-size: 13px; color: #339900; cursor: pointer;" onClick="location='main.php?bill=1'">��������� ������</a></b><br>
	</div>
	<?
    if( $u->info['level'] > 7 ) {
		$bonus = 0.02;
		$lev = ($u->info['level'] - 8);
		if($lev != 0){
			$bonus = $bonus + (0.01 * $lev);
		}
		if(round(date('w')) == 0 || round(date('w')) == 6 || $c['holiday'] == true) {
			$bonus *= 2;
		}
		$bns = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `aaa_bonus` WHERE `uid` = "'.$u->info['id'].'" AND `time` > '.time().' LIMIT 1'));
		if(isset($_GET['takebns']) && $u->newAct($_GET['takebns'])==true && !isset($bns['id'])) {
			$u->takeBonusNew($bonus);
			$bns = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `aaa_bonus` WHERE `uid` = "'.$u->info['id'].'" AND `time` > '.time().' LIMIT 1'));
		}
		/*
		if(isset($bns['id'])) {
			echo '<b><font color="Red">��� ��������� '.$bonus.' ���.</font></b>';
			echo '<div class="txt_bonus">��� ����� '.$bonus.' ���.: </div>';
			echo '<button style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" id="bonus_btn" onclick="alert(\'�� ������� ����� ����� ����� '.$u->timeOut($bns['time']-time()).'\');" class="btnnew"> ����� '.$u->timeOut($bns['time']-time()).' </button>';
		}else{
			echo '<div class="txt_bonus">��� ����� '.$bonus.' ���.: </div>';
			echo '<button id="bonus_btn" style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" class="btnnew" id="bonus_btn" onclick="btn_bon(); return false;">��������!</button></div>';
		}
		*/
		if( $u->info['clan'] == 0 && ($u->info['align'] == 0 || $u->info['align'] == 2) ) {
			$bonus = array(
				0,0,0,0,0,0,0,0,8,12,16,20,24,24,24,24,24,24,24,24,24
			);
			$bonus = $bonus[$u->info['level']];
			if(round(date('w')) == 0 || round(date('w')) == 6 || $c['holiday'] == true) {
				$bonus *= 2;
			}
			if(isset($bns['id'])) {
				echo '<b><font color="Red">��� ��������� '.$bonus.' ��.</font></b>';
				echo '<div class="txt_bonus">��� ����� '.$bonus.' ��.: </div>';
				echo '<button id="bonus_btn" style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" onclick="alert(\'�� ������� ����� ����� ����� '.$u->timeOut($bns['time']-time()).'\');" class="btnnew"> ����� '.$u->timeOut($bns['time']-time()).' </button>';
			}else{
				echo '<div class="txt_bonus">��� ����� '.$bonus.' ��.: </div>';
				echo '<button id="bonus_btn" style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" class="btnnew" id="bonus_btn" onclick="btn_bon(); return false;">��������!</button></div>';
			}
		}else{
			if(isset($bns['id'])) {
				echo '<b><font color="Red">��� ��������� '.$bonus.' ���.</font></b>';
				echo '<div class="txt_bonus">��� ����� '.$bonus.' ���.: </div>';
				echo '<button id="bonus_btn" style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" onclick="alert(\'�� ������� ����� ����� ����� '.$u->timeOut($bns['time']-time()).'\');" class="btnnew"> ����� '.$u->timeOut($bns['time']-time()).' </button>';
			}else{
				echo '<div class="txt_bonus">��� ����� '.$bonus.' ���.: </div>';
				echo '<button id="bonus_btn" style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" class="btnnew" id="bonus_btn" onclick="btn_bon(); return false;">��������!</button></div>';
			}
		}
	}
}else{?>
	<div id="upda">
		������: <strong style="color: #23527c"><b><? echo $u->bank['money2']; ?></b>&nbsp;���.</strong><? /*}*/ ?>
		<b><a style="display: inline-block; text-decoration: underline; font-size: 13px; color: #339900; cursor: pointer;" onClick="location='main.php?bill=1'">��������� ������</a></b><br>
	</div>
	<? if( $u->info['level'] > 7 ) {
		$bonus = 0.02;
		$lev = ($u->info['level'] - 8);
		if($lev != 0){
			$bonus = $bonus + (0.01 * $lev);
		}
		if(round(date('w')) == 0 || round(date('w')) == 6 || $c['holiday'] == true) {
			$bonus *= 2;
		}
		$bns = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `aaa_bonus` WHERE `uid` = "'.$u->info['id'].'" AND `time` > '.time().' LIMIT 1'));
		if(isset($_GET['takebns']) && $u->newAct($_GET['takebns'])==true && !isset($bns['id'])) {
			$u->takeBonusNew($bonus);
			$bns = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `aaa_bonus` WHERE `uid` = "'.$u->info['id'].'" AND `time` > '.time().' LIMIT 1'));
		}
		if(isset($bns['id'])) {
			echo '<div class="txt_bonus">��� ����� '.$bonus.' ���.: </div>';
			echo '<button id="bonus_btn" style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" onclick="alert(\'�� ������� ����� ����� ����� '.$u->timeOut($bns['time']-time()).'\');" class="btnnew"> ����� '.$u->timeOut($bns['time']-time()).' </button>';
		}else{
			echo '<div class="txt_bonus">��� ����� '.$bonus.' ���.: </div>';
			echo '<button id="bonus_btn" style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" class="btnnew" id="bonus_btn" onclick="btn_bon(); return false;">��������!</button></div>';
		}
	}
}?>
<?php
/*if( $u->info['level'] > 0 ) {
	echo '<div>';
	$rating = mysql_fetch_array(mysql_query('SELECT `id`,`last` FROM `users_rating` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
	$bns = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `aaa_bonus` WHERE `uid` = "'.$u->info['id'].'" AND `time` > '.time().' LIMIT 1'));
	if(isset($_GET['takebns']) && $u->newAct($_GET['takebns'])==true && !isset($bns['id'])) {
		$u->takeBonus();
		$bns = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `aaa_bonus` WHERE `uid` = "'.$u->info['id'].'" AND `time` > '.time().' LIMIT 1'));
	}
	if(!isset($rating['id'])) {
		echo '<button style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" class="btnnew"> ��� ������  </button>';
	}elseif(isset($bns['id'])) {
		echo '<button style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" onclick="alert(\'�� ������� ����� ����� ����� '.$u->timeOut($bns['time']-time()).'\');" class="btnnew"> ����� '.$u->timeOut($bns['time']-time()).'  </button>';
	}else{
		//echo '�������� �����:<br><div align="left"><button class="btnnew" onclick="location.href=\'main.php?inv=1&takebns='.$u->info['nextAct'].'\';">25 ��.!</button>';
		//echo '<button class="btnnew" onclick="location.href=\'main.php?inv=1&takebns='.$u->info['nextAct'].'&getb1w=2\';">'.($u->info['level']*3).' ����.!</button><button class="btnnew" onclick="location.href=\'main.php?inv=1&takebns='.$u->info['nextAct'].'&getb1w=3\';">1 ���.</button></div>';
		if( isset($rating['id']) && $rating['last'] <= 50 ) {
			if($u->info['clan'] > 0 || ($u->info['align'] > 0 && $u->info['align'] != 2)) {
				$rating['bns'] = '1 ���.';
			}else{
				$rating['bns'] = '0.5 ���.';
			}
		}else{
			if($u->info['clan'] > 0 || ($u->info['align'] > 0 && $u->info['align'] != 2)) {
				$rating['bns'] = ($u->info['level']).' ��.';
			}else{
				$rating['bns'] = ($u->info['level']/2).' ��.';
			}
		}
		echo '<button style="display:inline-block;width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" class="btnnew" onclick="location.href=\'main.php?inv=1&takebns='.$u->info['nextAct'].'&getb1w=3\';">��������&nbsp;'.$rating['bns'].'</button>';
	}
	echo '&nbsp;<a class="btnnew" style="font-size: 12px; display:inline-block;cursor:help;padding:4px 0 3px 0;margin:0px;" onMouseOver="top.hi(this,\'<b>����� �� ������</b>:<br>- ��������� ���������� 1-50 ����� � �������� �������� <b>0.5</b> ���.<br>- ��������� ���������� 51 � ���� ����� � �������� �������� <b>'.($u->info['level']/2).'</b> ��. �� '.$u->info['level'].' ������<br>- ��������� ����������� � ����� �������� � <b>2 ����</b> ������ �������<br>- ��������� �� ����������� �������� � <b>2 ����</b> ������ �������<br>- ��������� �� ����������� � �������� <b>�� ��������</b> ������� �� ������\',event,3,1,1,1,\'\');" onMouseOut="top.hic();" onMouseDown="top.hic();">&nbsp; ? &nbsp;</a>';
	echo '</div>';
	unset($rating);
}*/
?>