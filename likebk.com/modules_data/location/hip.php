<?php
if(!defined('GAME'))
{
	die();
}

if($u->room['file'] == 'hip') {
	
	if(isset($_GET['loc']) && $_GET['loc'] == '1.180.0.412') {
		mysql_query('UPDATE `users` SET `room` = 412 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		header('location: /main.php');
		die();
	}
	
	include('_incl_data/class/dialog.class.php');
	
	$dialog->start(12);
	
	$dlg = mysql_fetch_array(mysql_query('SELECT * FROM `hip` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
	
	$qsts = array(
		1 	=> array( '������� ��� �����' ),
		2 	=> array( '����� �����' ),
		3 	=> array( '������� ��� �������' ),
		4 	=> array( '������������ �����' ),
		5 	=> array( '��������� ������' ),
		6 	=> array( '����� � �����' ),
		7 	=> array( '����� �� ������' ),
		8 	=> array( '������ �������' ),
		9 	=> array( '��� ��������' ),
		10 	=> array( '����� ����������' ),
		11 	=> array( '������������ ���' ),
		12	=> array( '��� �� �������� �������' ),
		13 	=> array( '������� �����' ),
		14 	=> array( '������ �����' ),
		15 	=> array( '������ ���' ),
		16 	=> array( '����� ������' )
	);
	
	if(!isset($dlg['id'])) {
		if(isset($_GET['coin1'])) {
			$cn1 = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "8028" AND `delete` = 0 AND `inShop` = 0 AND `inTransfer` = 0 AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
			$test = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `hip_day` WHERE `uid` = "'.$u->info['id'].'" AND `time` = "'.date('d.m.Y').'" LIMIT 1'));
			$test = 0 + $test[0];
			if( $u->rep['hip'] < 20000 && $test >= 1 ) {
				$error2 = '������� �� ��� ��������� 1 �������!';
			}elseif( $u->rep['hip'] >= 20000 && $test >= 2 ) {
				$error2 = '������� �� ��� ��������� 2 �������!';
			}elseif(isset($cn1['id'])) {
				$rndq = rand(1,count($qsts));	
				if( $rndq == 1 || $rndq == 6 || $rndq == 7 || $rndq == 15 || $rndq == 16 ) {
					$rndq = rand(2,5);
				}
				$error2 = '�� ������� ��������� &quot;������� ��������� ������&quot; � �������� ����� ������� &quot;'.$qsts[$rndq][0].'&quot;!';
				//mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$cn1['id'].'" LIMIT 1');
				mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$cn1['id'].'" LIMIT 1');
				mysql_query('INSERT INTO `hip` ( `uid`,`qid`,`time` ) VALUES ( "'.$u->info['id'].'","'.$rndq.'","'.time().'" )');
				mysql_query('INSERT INTO `hip_day` ( `uid`,`time` ) VALUES ( "'.$u->info['id'].'","'.date('d.m.Y').'" )');
				$dlg = mysql_fetch_array(mysql_query('SELECT * FROM `hip` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
			}else{
				$cn1 = mysql_fetch_array(mysql_query('SELECT * FROM `items_users_res` WHERE `item_id` = "8028" AND `delete` = 0 AND `inShop` = 0 AND `inTransfer` = 0 AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				$test = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `hip_day` WHERE `uid` = "'.$u->info['id'].'" AND `time` = "'.date('d.m.Y').'" LIMIT 1'));
				$test = 0 + $test[0];
				if( $u->rep['hip'] < 25000 && $test >= 1 ) {
					$error2 = '������� �� ��� ��������� 1 �������!';
				}elseif( $u->rep['hip'] >= 25000 && $test >= 2 ) {
					$error2 = '������� �� ��� ��������� 2 �������!';
				}elseif(isset($cn1['id'])) {
					$rndq = rand(1,count($qsts));	
					if( $rndq == 1 || $rndq == 6 || $rndq == 7 || $rndq == 15 || $rndq == 16 ) {
						$rndq = rand(2,5);
					}
					$error2 = '�� ������� ��������� &quot;������� ��������� ������&quot; � �������� ����� ������� &quot;'.$qsts[$rndq][0].'&quot;!';
					mysql_query('UPDATE `items_users_res` SET `delete` = "'.time().'" WHERE `id` = "'.$cn1['id'].'" LIMIT 1');
					mysql_query('INSERT INTO `hip` ( `uid`,`qid`,`time` ) VALUES ( "'.$u->info['id'].'","'.$rndq.'","'.time().'" )');
					mysql_query('INSERT INTO `hip_day` ( `uid`,`time` ) VALUES ( "'.$u->info['id'].'","'.date('d.m.Y').'" )');
					$dlg = mysql_fetch_array(mysql_query('SELECT * FROM `hip` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
				}else{
					$error2 = '� ��� ��� �������� &quot;������� ��������� ������&quot;!';
				}
			}
		}
	}
	if(isset($_GET['cancel1qst'])) {
		mysql_query('DELETE FROM `hip` WHERE `uid` = "'.$u->info['id'].'"');
		mysql_query('DELETE FROM `hip_kill` WHERE `uid` = "'.$u->info['id'].'"');
		$error2 = '�� ���������� �� ���� �������!';
		unset($dlg);
	}
	if(isset($dlg['id'])&& $dlg['start'] == 0 && isset($_GET['startqst'])) {
		$error2 = '������� &quot;'.$qsts[$dlg['qid']][0].'&quot; ��������, ������ �������� ��� ���������!';
		$dlg['start'] = time();
		mysql_query('UPDATE `hip` SET `start` = "'.$dlg['start'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
	}
	if((isset($dlg['id']) && $dlg['finish'] > 0 ) || ( isset($_GET['adm1']) && $u->info['admin'] > 0 ) ) {
		$error2 = '������� &quot;'.$qsts[$dlg['qid']][0].'&quot; ���������, �� �������� 100 ���-���������, 50 ��. � ������� � ������!';
		$u->addItem(2412,$u->info['id'],'|sudba=1|nosale=1|notransfer=1');
		mysql_query('UPDATE `rep` SET `hip` = `hip` + 100 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		$u->info['money'] += 50;
		mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		mysql_query('DELETE FROM `hip` WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
		unset($dlg);
	}
	
	$r = 1;
	if( $_GET['r'] == 2 ) {
		$r = 2;
	}elseif( $_GET['r'] == 3 ) {
		$r = 3;
	}
	
	if($re!=''){ echo '<div align="right"><font color="red"><b>'.$re.'</b></font></div>'; } ?>
    <style>
	.pH3			{ COLOR: #8f0000;  FONT-FAMILY: Arial;  FONT-SIZE: 12pt;  FONT-WEIGHT: bold; }
	</style>
	<style>
    body {
        background-image: url(http://img.likebk.com/i/misc/showitems/dungeon.jpg);background-repeat:no-repeat;background-position:top right;
    }
    </style>
	<TABLE width="100%" cellspacing="0" cellpadding="0">
	<tr><td valign="top"><div align="center" class="pH3">������ ��������� �����������</div>
	<?php
	echo '<b style="color:red">'.$error.'</b>';
	?>
	<td width="280" align="right" valign="top">
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
<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.412&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.412',1); ?>">����������� ���</a></td>
</tr>
<tr>
<td bgcolor="#D3D3D3"><img src="http://img.likebk.com/i/move/links.gif" width="9" height="7" /></td>
<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.419&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.419',1); ?>">����� ����������</a></td>
</tr>
</table>
</td>
</tr>
</table>
</td></table>
</td></table>
<div>
  <INPUT TYPE="button" value="��������" onclick="location = '<? echo $_SERVER['REQUEST_URI']; ?>';"><BR>
	  </div>
<div style="line-height:17px;"></div>
	</td>
	</table>
    <?
	if( $r == 1 ) {
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="300" valign="top"><div align="left"><? echo $dialog->youInfo; ?></div></td>
        <td valign="top">
        <?
		if($error2!=''){ echo '<div align="left"><font color="red"><b>'.$error2.'</b></font></div><br>'; }
		if( !isset($dlg['id']) ) {
			//������ ���, ����� �������
		?>
                ����������, <b><?=$u->info['login']?></b>! �� ���������� � ������ ��������� �����������!
                ����� ����� ��������� ��������� ������� � �������� �� ��� �������, ��� ����� ����� ����� <b>������� ��������� ������</b>.
                ������ �������� � ������� � � ����� ����������, ���� ��������� ������ ������� ��� � �������. � ���� ���� ������ ��� ����?
                <br><br>
                <a href="/main.php?r=1&coin1=1">&bull; ��, ��� ����� ������! (�������� ����� �������)</a>
        <?
		}else{
			//����� ����
			
			if( $dlg['qid'] == 2 ) {
				/*
				����� ����� (�������� ������� / ������).
				����� ��������� ����� 0/10 (894)
				*/
				if(!isset($_GET['finishqst'])) {
				?>
                ����������� ���� ������, ��� ������ ����� ������ �������������. �� ������ � ��� ����� ����� ��������, ������� ���� �� ������ ������ ������.
                �� ���� ��� ��� ��������. ������ ����. ������� � ������ ������� ����� ���� ������� �����, ��� ����� ������� �����. ������� ��� 10 ����� ����.
                ����� ����� ��� ������.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 894 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 10;
				if($x > $xmax) {
					$x = $xmax;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax && $x >= $xmax ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 894 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					echo '<div align="left"><font color="red"><b>������� &quot;'.$qsts[$dlg['qid']][0].'&quot; ���� ������� ���������!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    ��� ������� ����, ������! ������� �������!<br><br>
                    <a href="/main.php?ext">&bull; (��������� �������)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; ������, � ������ ����. (����� �������)</a><br>
                    <?
				}else{
					?>
                    <b>�������:</b> ����� ��������� ����� <?=$x?>/<?=$xmax?><br><br>
                    <?
					if( $x >= $xmax ) {
					?>
                    <a href="/main.php?finishqst">&bull; � ����� ���� 10 ���� ��������� �����.</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 3 ) {
				/*
				������� ��� �������
				- ������ ������� 0/1 (2)
				- �������� ����� 0/3 (3136)
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				����������� ���� ������, ����� ���� ������! ��������� ������� � ������� ���� ��� ����� ����� ������ �������� �������.
                Ÿ ������� ���������, � ����� ����� �� ����� �� ��������. ����� ������� ��� �� �������. � ���� � ������� ���� ���� ����� ������������� ������.
                ������� ��� ������ ������� � 3 �������� ������, � � ������ ������ ������ �� �������.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 2 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 1;
				if($x > $xmax) {
					$x = $xmax;
				}
				$x2 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 3136 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x2 = 0+$x2[0];
				$xmax2 = 3;
				if($x2 > $xmax2) {
					$x2 = $xmax2;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax && $x2 >= $xmax2 ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 2 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 3136 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax2);
					echo '<div align="left"><font color="red"><b>������� &quot;'.$qsts[$dlg['qid']][0].'&quot; ���� ������� ���������!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    ��� ������� ����, ������! ������ ������� ����� � ��� ��������!<br><br>
                    <a href="/main.php?ext">&bull; (��������� �������)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; ������, � ������ ����. (����� �������)</a>
                    <?
				}else{
					?>
                    <b>�������:</b> ������ ������� <?=$x?>/<?=$xmax?><br><b>�������:</b> �������� ����� <?=$x2?>/<?=$xmax2?><br><br>
                    <?
					if( $x >= $xmax && $x2 >= $xmax2 ) {
					?>
                    <a href="/main.php?finishqst">&bull; ��� ������� � �������� ������. ������� �������.</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 4 ) {
				/*
				������������ ����� (�������� ������� / ������).
				- �������� �����
				-��� �����
				- ������� �����
				*/
				if(!isset($_GET['finishqst'])) {
				?>
                ����������� ���� ������, ������� ������ �����. ����� ����� ���������� �� ������ � ������� ����� ��������� � ��� ��� �� ����.
                ���� ���� ��������� ������ � �������� ��������� ����� �������. ���������� � ���� �������� �����, ��� �����, ������� �����.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `hip_kill` WHERE `bot` = 417 AND `uid` = "'.$u->info['id'].'" AND `time` > "'.$dlg['start'].'" LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 1;
				if($x > $xmax) {
					$x = $xmax;
				}
				$x2 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `hip_kill` WHERE `bot` = 419 AND `uid` = "'.$u->info['id'].'" AND `time` > "'.$dlg['start'].'" LIMIT 1'));
				$x2 = 0+$x2[0];
				$xmax2 = 1;
				if($x2 > $xmax2) {
					$x2 = $xmax2;
				}
				$x3 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `hip_kill` WHERE `bot` = 420 AND `uid` = "'.$u->info['id'].'" AND `time` > "'.$dlg['start'].'" LIMIT 1'));
				$x3 = 0+$x3[0];
				$xmax3 = 1;
				if($x3 > $xmax3) {
					$x3 = $xmax3;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax && $x2 >= $xmax2 && $x3 >= $xmax3 ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `hip_kill` WHERE `uid` = "'.$u->info['id'].'"');
					echo '<div align="left"><font color="red"><b>������� &quot;'.$qsts[$dlg['qid']][0].'&quot; ���� ������� ���������!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    ��� ������� ����, ������! ������ ��� ���� ����!<br><br>
                    <a href="/main.php?ext">&bull; (��������� �������)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; ������, � ������ ����. (����� �������)</a>
                    <?
				}else{
					?>
                    <b>�������:</b> ����� ��������� ����� <?=$x?>/<?=$xmax?><br>
                    <b>�������:</b> ����� ��� ����� <?=$x2?>/<?=$xmax2?><br>
                    <b>�������:</b> ����� ������� ����� <?=$x3?>/<?=$xmax3?><br>
                    <br>
                    <?
					if( $x >= $xmax && $x2 >= $xmax2 && $x3 >= $xmax3 ) {
					?>
                    <a href="/main.php?finishqst">&bull; � ���� ���� �����, ��� ������� �� ��� ���������. ��� ���� ����!</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 5 ) {
				/*
				��������� ������ (�������� ������� / ������).
				- ������������� ������ ����� ������ 0/1
				- ������������� ��� ������� 0/1
				- ������������� ��� ������ 0/1
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				����������� ���� ������. �� ��� � ����� �� ���� ������� ������ ������. ���� �������� �� ������� � �������.
                ����� �� ���� ������, �� ��������� ����������� � ��������. ������� � ������ � ������� �� ��������� ��� ����� ��������� ������.
                �� ������, ��� �� ����� �������� � ���������� ��������. ������� ��� ������ ����� ������, ��� ������� � ��� ������.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 2421 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 1;
				if($x > $xmax) {
					$x = $xmax;
				}
				$x2 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 2420 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x2 = 0+$x2[0];
				$xmax2 = 1;
				if($x2 > $xmax2) {
					$x2 = $xmax2;
				}
				$x3 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 2419 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x3 = 0+$x3[0];
				$xmax3 = 1;
				if($x3 > $xmax3) {
					$x3 = $xmax3;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax && $x2 >= $xmax2 ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 2421 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 2420 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax2);
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 2419 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax3);
					echo '<div align="left"><font color="red"><b>������� &quot;'.$qsts[$dlg['qid']][0].'&quot; ���� ������� ���������!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    ��� ������� ����, ������! ������� �������!<br><br>
                    <a href="/main.php?ext">&bull; (��������� �������)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; ������, � ������ ����. (����� �������)</a>
                    <?
				}else{
					?>
                    <b>�������:</b> ������������� ������ ����� ������ <?=$x?>/<?=$xmax?><br>
                    <b>�������:</b> ������������� ��� ������� <?=$x2?>/<?=$xmax2?><br>
                    <b>�������:</b> ������������� ��� ������ <?=$x3?>/<?=$xmax3?><br>
                    <br>
                    <?
					if( $x >= $xmax && $x2 >= $xmax2 && $x3 >= $xmax3 ) {
					?>
                    <a href="/main.php?finishqst">&bull; � ����� ���� �������.</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 8 ) {
				/*
				������ ������� (�������� ������� / ������).
				- ������ ������� ������ 0/1
				- ������ �������� ��������� ������ 0/1
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				����������� ���� ������, � ��� �� ������ ������� ������������� �������� ���� ������� ������ � ����� ����.
                ��� �������, ��� ��� �������� ����� ����� ����������� �����.
                � ������ ���� ��� ������� ������ � ������ � ������� ��������� ������ � ���. �� ����� ������ ��� �����, ��� ����� �� �����.
                ������� ��� ��, ����� � ��� ���������� ���� ������������.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE (`item_id` = 8029 OR `item_id` = 8220) AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 1;
				if($x > $xmax) {
					$x = $xmax;
				}
				$x2 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 8030 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x2 = 0+$x2[0];
				$xmax2 = 1;
				if($x2 > $xmax2) {
					$x2 = $xmax2;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax && $x2 >= $xmax2 ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE (`item_id` = 8029 OR `item_id` = 8220) AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 8030 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax2);
					echo '<div align="left"><font color="red"><b>������� &quot;'.$qsts[$dlg['qid']][0].'&quot; ���� ������� ���������!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    ��� ������� ����, ������! ������� �������! ����������� ��������.<br><br>
                    <a href="/main.php?ext">&bull; (��������� �������)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; ������, � ������ ����. (����� �������)</a>
                    <?
				}else{
					?>
                    <b>�������:</b> ������ ������� ������ <?=$x?>/<?=$xmax?><br><b>�������:</b> ������ �������� ��������� ������ <?=$x2?>/<?=$xmax2?><br><br>
                    <?
					if( $x >= $xmax && $x2 >= $xmax2 ) {
					?>
                    <a href="/main.php?finishqst">&bull; ��� ���� ����� ���� ������, ������. �������� �����, ��� �������, ��������� ��!</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 9 ) {
				/*
				������ ������� (�������� ������� / ������).
				��������� �������� 0/1
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				����������� ���� ������, ������� ������� � �� ��������� ���������� � ������� ���� ��������� ��������. �� ��� ����� �����.
                ���� ������, ��� ����� ��� ��������� ���� � ����������� ����, ����������� ������ ���� � ������������� ���������, ��� ����������.
                �������� � ���, �����, ����� ������� ��-��������? � ���� �� ������� ��-�������� � ��� �� ������ ��� ������.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 8031 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 1;
				if($x > $xmax) {
					$x = $xmax;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 8031 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					echo '<div align="left"><font color="red"><b>������� &quot;'.$qsts[$dlg['qid']][0].'&quot; ���� ������� ���������!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    ��� ������� ����, ������! � ��������� ��� ������� �������!<br><br>
                    <a href="/main.php?ext">&bull; (��������� �������)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; ������, � ������ ����. (����� �������)</a>
                    <?
				}else{
					?>
                    <b>�������:</b> ��������� �������� <?=$x?>/<?=$xmax?><br><br>
                    <?
					if( $x >= $xmax ) {
					?>
                    <a href="/main.php?finishqst">&bull; ��������� ���� ������ ��������! �������� � ����� �������� ���� ����!</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 10 ) {
				/*
				����� ���������� (�������� ������� / ������).
				������ �������� 0/10
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				����������� ���� ������, ������ ���� ������ ������ ����������. ���-�� ����� ��� � � ������ � ����� ���������� �����.
                � ���������� ���� ����� ������� ������� � ��������� �����. �� ��� ���������� ���� ����������� ����� � ����� �����.
                ������ ������ ������ ���� ����� �� ������� ����� �� ����� ����������� �����, � � ����� � ������� �� ������������ ��� ���������� �������.
                ���� ������� � ���� ������ �����. ������ ���. ����� � ���������� ��������, ������� ��� 10 ������� ��������.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 4379 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 10;
				if($x > $xmax) {
					$x = $xmax;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 4379 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					echo '<div align="left"><font color="red"><b>������� &quot;'.$qsts[$dlg['qid']][0].'&quot; ���� ������� ���������!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    ��� ������� ����, ������! � ��������� ��� ������� �������!<br><br>
                    <a href="/main.php?ext">&bull; (��������� �������)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; ������, � ������ ����. (����� �������)</a>
                    <?
				}else{
					?>
                    <b>�������:</b> ������ �������� <?=$x?>/<?=$xmax?><br><br>
                    <?
					if( $x >= $xmax ) {
					?>
                    <a href="/main.php?finishqst">&bull; � ����� ���� 10 ������� ��������!</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 11 ) {
				/*
				������������ ��� (�������� ������� / ������).
				��� ������������� �������� 0/1
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				����������� ���� ������, ������� � ��� �� ����� �������, �� �������� ������. �� ��� ����, ��� � ���� ���� ��������, �� ����� �������. �� � ���� ������, �� ������� ���� � ��� ������. ����� ��� ��������� ������. ������������, ��� � ������ ����� ���� �������, �������� ������ ���, �� � ����, �� � ��� ����. � ��� ��� ��������� ���������� ���������. ������� ��� ���  ������, � �� ���� �� ���������.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 8032 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 10;
				if($x > $xmax) {
					$x = $xmax;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 8032 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					echo '<div align="left"><font color="red"><b>������� &quot;'.$qsts[$dlg['qid']][0].'&quot; ���� ������� ���������!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    ��� ������� ����, ������! ������� �������!<br><br>
                    <a href="/main.php?ext">&bull; (��������� �������)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; ������, � ������ ����. (����� �������)</a>
                    <?
				}else{
					?>
                    <b>�������:</b> ��� ������������� �������� <?=$x?>/<?=$xmax?><br><br>
                    <?
					if( $x >= $xmax ) {
					?>
                    <a href="/main.php?finishqst">&bull; ����� � ���� ����� ������ ��� � ����, �����!</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 12 ) {
				/*
				��� �� �������� ������� (�������� ������� / ������).
				- ��������� ������ 0/10
				- ������������ ������ 0/10
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				����������� ���� ������, �������� � ���� ��������. ������ ����� ������ ������ ���� ������ ���������.
                ������ ���, ���������� ������ � ���������� ���� �����. ������ ��� ����� ��������. ������� �� ����� ������ ��������� �� ������������.
                �������� �� ����, � � ���� ������ ���� ������� �� ������ ����.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 882 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 1;
				if($x > $xmax) {
					$x = $xmax;
				}
				$x2 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 903 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x2 = 0+$x2[0];
				$xmax2 = 1;
				if($x2 > $xmax2) {
					$x2 = $xmax2;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax && $x2 >= $xmax2 ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 882 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 903 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax2);
					$u->addItems(1043,$u->info['id'],'|nosale=1|sudba=1');
					$mx1 = array(
						's1'	=> $u->stats['s1'],
						's2'	=> $u->stats['s2'],
						's3'	=> $u->stats['s3'],
						's5'	=> $u->stats['s5'],
						's6'	=> $u->stats['s6']
					);
					$mx1 = max($mx1);
					if( $u->stats['s2'] == $mx1 ) {
						$u->addItems(4040,$u->info['id'],'|nosale=1|sudba=1');
						$mx1 = '��������';
					}elseif( $u->stats['s3'] == $mx1 ) {
						$u->addItems(4038,$u->info['id'],'|nosale=1|sudba=1');
						$mx1 = '��������';
					}elseif( $u->stats['s5'] == $mx1 || $u->stats['s6'] == $mx1 ) {
						$u->addItems(4039,$u->info['id'],'|nosale=1|sudba=1');
						$mx1 = '����������';
					}else{
						$u->addItems(4037,$u->info['id'],'|nosale=1|sudba=1');
						$mx1 = '����';
					}
					echo '<div align="left"><font color="red"><b>������� &quot;'.$qsts[$dlg['qid']][0].'&quot; ���� ������� ���������! (�� ��������: ��������� ������� ������ � ������� �� +22 '.$mx1.')</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    ��� ������� ����, ������! ������� �������! ����������� ��������.<br><br>
                    <a href="/main.php?ext">&bull; (��������� �������)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; ������, � ������ ����. (����� �������)</a>
                    <?
				}else{
					?>
                    <b>�������:</b> ��������� ������ <?=$x?>/<?=$xmax?><br>
                    <b>�������:</b> ������������ ������ <?=$x2?>/<?=$xmax2?><br><br>
                    <?
					if( $x >= $xmax && $x2 >= $xmax2 ) {
					?>
                    <a href="/main.php?finishqst">&bull; ��������� ������ � ����, ����� � ��������, ����� �� ������ �����������?</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 13 ) {
				/*
				������� ����� (�������� ������� / ������).
				- ������� �����
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				����������� ���� ������, ������-�����, ����� ���� ��� �� ���� �� ����� �� ������ ������ ������ ��������� ������������ ��� � ��������� �����.
                ���� ������ ���� ������� ������� � ������ �������� �� � ������ ���������. ����� �� �����, ��� ��� ����������.
                �� � �����, ��� ������� ����� ��������� ��� � ����� ��������� �� �������. ���������� � ���������� ��������, ����� ��� 5 ������� ����� � �������� ��, 
                ���� ��� �����.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `hip_kill` WHERE `bot` = 367 AND `uid` = "'.$u->info['id'].'" AND `time` > "'.$dlg['start'].'" LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 5;
				if($x > $xmax) {
					$x = $xmax;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax && $x2 >= $xmax2 && $x3 >= $xmax3 ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `hip_kill` WHERE `uid` = "'.$u->info['id'].'"');
					echo '<div align="left"><font color="red"><b>������� &quot;'.$qsts[$dlg['qid']][0].'&quot; ���� ������� ���������!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    ��� ������� ����, ������! ������ ��� ���� ����!<br><br>
                    <a href="/main.php?ext">&bull; (��������� �������)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; ������, � ������ ����. (����� �������)</a>
                    <?
				}else{
					?>
                    <b>�������:</b> ����� ������� ����� <?=$x?>/<?=$xmax?><br>
                    <br>
                    <?
					if( $x >= $xmax ) {
					?>
                    <a href="/main.php?finishqst">&bull; � ����� �� � ���������, � �����, ���� �� ��� ����������� ��� � ���� ��������.</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 14 ) {
				/*
				������ ����� (�������� ������� / ������).
				���� �������� ������ 0/10
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				����������� ���� ������, �������� � ���� ����� ���� � �������. ������� �� ��� � ���� ������ �����. ����� ����� ����� ���������, ����� ���� �����, 
                ��� � �� ��� ���� ����� �� ������. ������� � ���, �������, ���� ������ � ����. ���� ���������� ��� ����������� �����. � ����������� ������ ������� 
                �������, ����� �������� �������� �� �����, �� ���� ��� ���� ����������� ��������, �� ����� �� ����� �����. ������� ��� ������� ����� ����������.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 902 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 10;
				if($x > $xmax) {
					$x = $xmax;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 902 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					echo '<div align="left"><font color="red"><b>������� &quot;'.$qsts[$dlg['qid']][0].'&quot; ���� ������� ���������!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    ��� ������� ����, ������! ������� �������!<br><br>
                    <a href="/main.php?ext">&bull; (��������� �������)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; ������, � ������ ����. (����� �������)</a>
                    <?
				}else{
					?>
                    <b>�������:</b> ���� �������� ������ <?=$x?>/<?=$xmax?><br><br>
                    <?
					if( $x >= $xmax ) {
					?>
                    <a href="/main.php?finishqst">&bull; � ����� ���� �����, ������ ������ �������.</a>
                    <?
					}
				}
			}
			
			if(isset($dlg['id']) && $dlg['finish'] == 0) {
				echo '<div><a href="/main.php?loc=1.180.0.412">&bull; � ��� �����, �������! (��������� ������)</a></div>';
				echo '<div><br><br><br><a href="/main.php?cancel1qst"><font color=red>&bull; � � ���� �� ���������! (���������� �� �������)</font></a></div>';
			}
							
		}
		?>
        </td>
        <td width="300" valign="top"><div align="right"><? echo $dialog->botInfo; ?></div></td>
      </tr>
    </table>
	<?
	}elseif( $r == 2 ) {
	?>
    2
    <?
	}elseif( $r == 3 ) {
	?>
    �������� ������
    <?
	}else{
		echo '<center>������ �� ������</center>';
	}
	?>
<?
}
?>