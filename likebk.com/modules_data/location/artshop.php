<?php
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='artshop')
{
	if(!isset($_GET['otdel'])) 
	{
		$_GET['otdel'] = 1;
	}
	
	$sid = 777;
	$sale_ekr = true;
	if( $u->stats['silver'] > 0 ) {
		$sale_ekr = true;
	}else{
		if( isset($_GET['sale']) ) {
			//unset($_GET['sale']);	
		}
	}
	$error = '';
	
	/*if( isset($_GET['restartprice'])) {
		$sp = mysql_query('SELECT `s`.*,`m`.* FROM `items_shop` AS `s` LEFT JOIN `items_main` AS `m` ON `m`.`id` = `s`.`item_id` WHERE `s`.`sid` = "777"');
		
		while($pl = mysql_fetch_array($sp)) {
			$price2 = round(($pl['price2']/2.5),2);
			if( $price2 > 100 ) {
				mysql_query('UPDATE `items_shop` SET `price_2` = "'.$price2.'" WHERE `item_id` = "'.$pl['id'].'" AND `sid` = 777 LIMIT 1');
			}
		}
	}*/
	
	if(isset($_GET['buy']) && isset($u->bank['id']))
	{
		if($u->newAct($_GET['sd4'])==true)
		{
			$re = $u->buyItem($sid,(int)$_GET['buy'],(int)$_GET['x']);
		}else{
			$re = '�� ������� ��� ������ ������ ���� �������?';
		}
	}elseif(isset($_GET['buy_vip']) && isset($u->bank['id']) && $u->stats['silver'] > 1)
	{
		if($u->newAct($_GET['sd4'])==true)
		{
			$re = $u->buyItem($sid,(int)$_GET['buy_vip'],(int)$_GET['x'],NULL,true);
		}else{
			$re = '�� ������� ��� ������ ������ ���� �������?';
		}
	}elseif(isset($_GET['sale']) && isset($_GET['item']) && $u->newAct($_GET['sd4']) && $sale_ekr == true ) {
		$id = (int)$_GET['item'];
		$itm = mysql_fetch_array(mysql_query('SELECT `im`.*,`iu`.*, count(`iuu`.id) as inGroupCount
			FROM `items_users` AS `iu`
			LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`)
			LEFT JOIN `items_users` as `iuu` ON (`iuu`.inGroup = `iu`.inGroup AND `iuu`.item_id = `im`.id )
			WHERE `iuu`.`uid`="'.$u->info['id'].'" AND `iu`.`uid`="'.$u->info['id'].'" AND (`im`.`price2` > 0 OR `im`.`price5` > 0) AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `iu`.`id` = "'.mysql_real_escape_string($id).'" LIMIT 1'));
		$po = $u->lookStats($itm['data']);	
		if($u->info['allLock'] > time()) {
			$po['nosale'] = 1;
		}
		
		$effvip = mysql_fetch_array(mysql_query('SELECT `id`,`timeUse` FROM `eff_users` WHERE `data` LIKE "%add_silver=%" AND `uid` = "'.$u->info['id'].'" ORDER BY `id` DESC LIMIT 1'));
		$cblim = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `ekr_sale` WHERE `uid` = "'.$u->info['id'].'" AND `time` >= '.$effvip['timeUse'].' LIMIT 1'));
		
		//if( $cblim[0] >= $u->stats['silver'] * 5 ) {
		//	$error = '����� ������ ��������� � ������� ��������, �������� VIP �������';
		//}else
		if( ($itm['gift'] != '' && $itm['gift'] != '0') && (  $itm['type'] == 37 || $itm['type'] ==  38 || $itm['type'] == 39 || $itm['type'] == 63 ) ) {
			$error = '������ ��������� �������, ��� ������ ���������� �� ������! :)';
		}elseif(isset($po['nosale'])){
			$error = '�� ������� ������� ������� ...';
		}elseif(isset($po['fromshop']) && ($po['fromshop'] != 777 && $po['fromshop'] != 2)){
			$error = '������� �� ��� ���������� �� ����-������� ��� Gold ekr., ��� ������ ������� �����...';
		}elseif($itm['gift'] != '0' && $itm['gift'] != '') {
				$error = '�� ������� ������� ������� ... ���-���� ������� ;)';
		}elseif(isset($po['frompisher'])){
			$error = '�� ������� ������� ������� ... ������� �� ����������';
		}elseif(isset($po['srok'])){
			$error = '�������� �� ������ �������� ��������� ������ ...';
		}elseif(isset($itm['id'])){
			if($itm['2price']>0){
				$itm['price2'] = $itm['2price'];
			}
			if($itm['5price']>0){
				$itm['price5'] = $itm['5price'];
			}
			$shpCena = round($itm['price2'],2);
			$shpCena5 = round($itm['price5'],2);
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
			$shpCena = $u->shopSaleM( $shpCena , $itm );
			$shpCena5 = $u->shopSaleM( $shpCena5 , $itm );
			$shpCena = $shpCena/100*(100-$prc1);
			$shpCena5 = $shpCena5/100*(100-$prc1);
			
			
			if($itm['iznosMAX']>0 && $itm['iznosMAXi']>0 && $itm['iznosMAXi']>$itm['iznosMAX']){
				$shpCena = $shpCena/100*($itm['iznosMAX']/$itm['iznosMAXi']*100);
				$shpCena5 = ceil($shpCena5/100*($itm['iznosMAX']/$itm['iznosMAXi']*100));
			}
			
/*			if( isset($po['art']) ) {
				$shpCena = $u->round2($shpCena*$u->berezCena()); // ������� ������� 35%
			}else{
				$shpCena = $u->round2($shpCena*$u->berezCena()); // ������� ������� 35%
			}*/
			$premium = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$u->info['id'].'" AND `time_delete` > "'.time().'"'));
			if($premium){
				if($u->berezCena() != 0){
					if( isset($po['art']) ) {
						$shpCena = $u->round2($shpCena*$u->berezCena()); // ���� ����
						$shpCena5 = $u->round2($shpCena5*$u->berezCena()); // ���� ����
					}else{
						$shpCena = $u->round2($shpCena*$u->berezCena()); // ����
						$shpCena5 = $u->round2($shpCena5*$u->berezCena()); // ����
					}
					$shpCena = $u->round2($shpCena*($premium['saleEkr_prc']/100)); // ���� ���������
					$shpCena5 = $u->round2($shpCena5*($premium['saleEkr_prc']/100)); // ���� ���������
				}
				else{
					$shpCena = $u->round2($shpCena*($premium['saleEkr_prc']/100)); // ���� ���������
					$shpCena5 = $u->round2($shpCena5*($premium['saleEkr_prc']/100)); // ���� ���������
				}
			}else{
				if($u->berezCena() != 0){
					if( isset($po['art']) ) {
						$shpCena = $u->round2($shpCena*$u->berezCena()); // ���� ����
						$shpCena5 = $u->round2($shpCena5*$u->berezCena()); // ���� ����
					}else{
						$shpCena = $u->round2($shpCena*$u->berezCena()); // ����
						$shpCena5 = $u->round2($shpCena5*$u->berezCena()); // ����
					}
					$shpCena = $u->round2($shpCena*$c['prcshp']); // ���� ���������
					$shpCena5 = $u->round2($shpCena5*$c['prcshp']); // ���� ���������
				}
				else{
					$shpCena = $u->round2($shpCena*$c['prcshp']); // ���� ���������
					$shpCena5 = $u->round2($shpCena5*$c['prcshp']); // ���� ���������
				}
			}
			if($shpCena<0){
				$shpCena = 0;
			}
			if($shpCena5<0){
				$shpCena5 = 0;
			}
			$col = $u->itemsX($itm['id']);	
			if($col>0){
				$shpCena = $shpCena*$col;
				$shpCena5 = $shpCena5*$col;
			}
			
					/*$premium = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$u->info['id'].'" AND `time_delete` > "'.time().'"'));
					if($premium){
						if($itm['level'] < 9){
							$shpCena = $u->round2($shpCena*1);
						}else{
							$shpCena = $u->round2($shpCena*($premium['sale_prc']/100)); // ���� ���������
						}
					}else{
						if($itm['level'] < 9){
							$shpCena = $u->round2($shpCena*1);
						}else{
							$shpCena = $u->round2($shpCena*0.9); // ���� ���������
						}
					}*/
			
			if($shpCena<0){
				$shpCena = 0;
			}
			if($shpCena5<0){
				$shpCena5 = 0;
			}
			
			$upd2 = mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			if($upd2){
				if($col>1){
					mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `item_id`="'.$itm['item_id'].'" AND `uid`="'.$itm['uid'].'" AND `inGroup` = "'.$itm['inGroup'].'" LIMIT '.$col.'');	
				}
				if( $shpCena > 0 ) {
					$u->bank['money2'] += $shpCena;
					$upd = mysql_query('UPDATE `bank` SET `money2` = "'.$u->bank['money2'].'" WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
					//$upd = mysql_query('SELECT * FROM `bank` WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					if($upd){
						mysql_query('INSERT INTO `ekr_sale` (`uid`,`time`,`money2`) VALUES ("'.$u->info['id'].'","'.time().'","'.mysql_real_escape_string($shpCena).'")');
						$u->info['catch'] += $shpCena;
						mysql_query('UPDATE `users` SET `catch` = "'.$u->info['catch'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						$error = '�� ������� ������� ������� &quot;'.$itm['name'].' [x'.$col.']&quot; �� '.$shpCena.' ���.';
						mysql_query('UPDATE `items_users` SET `inGroup` = "0",`delete` = "'.time().'" WHERE `inGroup` = "'.$itm['id'].'" AND `uid` = "'.$u->info['id'].'" LIMIT '.$itm['group_max'].'');
						$u->addDelo(2,$u->info['id'],'&quot;<font color="green">System.Ekrshop</font>&quot;: ������� &quot;'.$itm['name'].' (x'.$col.')&quot; [itm:'.$itm['id'].'] ��� ������ � ������� �� <B>'.$shpCena.' ���.</B>.',time(),$u->info['city'],'System.Ekrshop',0,$shpCena);
					}else{
						$u->addDelo(2,$u->info['id'],'&quot;<font color="green">System.Ekrshop</font>&quot;: ������� &quot;'.$itm['name'].' (x'.$col.')&quot; [itm:'.$itm['id'].'] ��� ������ � ������� �� <B>'.$shpCena.' ���.</B> (������� �� ����������).',time(),$u->info['city'],'System.Ekrshop',0,0);
						$error = '�� ������� ������� �������...';
					}
				}
				if( $shpCena5 > 0 ) {
					$u->info['money5'] += $shpCena5;
					$upd = mysql_query('UPDATE `users` SET `money5` = "'.$u->info['money5'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					//$upd = mysql_query('SELECT * FROM `bank` WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					if($upd){
						mysql_query('UPDATE `users` SET `money5` = "'.$u->info['money5'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						$error = '�� ������� ������� ������� &quot;'.$itm['name'].' [x'.$col.']&quot; �� '.$shpCena5.' Gold ekr.';
						mysql_query('UPDATE `items_users` SET `inGroup` = "0",`delete` = "'.time().'" WHERE `inGroup` = "'.$itm['id'].'" AND `uid` = "'.$u->info['id'].'" LIMIT '.$itm['group_max'].'');
						$u->addDelo(2,$u->info['id'],'&quot;<font color="green">System.Ekrshop</font>&quot;: ������� &quot;'.$itm['name'].' (x'.$col.')&quot; [itm:'.$itm['id'].'] ��� ������ � ������� �� <B>'.$shpCena5.' Gold ekr.</B>.',time(),$u->info['city'],'System.Ekrshop',0,$shpCena);
					}else{
						$u->addDelo(2,$u->info['id'],'&quot;<font color="green">System.Ekrshop</font>&quot;: ������� &quot;'.$itm['name'].' (x'.$col.')&quot; [itm:'.$itm['id'].'] ��� ������ � ������� �� <B>'.$shpCena5.' Gold ekr.</B> (������� �� ����������).',time(),$u->info['city'],'System.Ekrshop',0,0);
						$error = '�� ������� ������� �������...';
					}
				}
			}else{
				$error = '�� ������� ������� �������...';
			}
		}else{
			$error = '������� �� ������ � ���������.';
		}
	}
	
	if($re!=''){ echo '<div align="right"><font color="red"><b>'.$re.'</b></font></div>'; } ?>
	<script type="text/javascript">
	function AddCount(name, txt)
	{
		document.getElementById("hint4").innerHTML = '<table border=0 width=100% cellspacing=1 cellpadding=0 bgcolor="#CCC3AA"><tr><td align=center><B>������ ����. ����</td><td width=20 align=right valign=top style="cursor: pointer" onclick="closehint3();"><BIG><B>x</TD></tr><tr><td colspan=2>'+
		'<form method=post><table border=0 width=100% cellspacing=0 cellpadding=0 bgcolor="#FFF6DD"><tr><INPUT TYPE="hidden" name="set" value="'+name+'"><td colspan=2 align=center><B><I>'+txt+'</td></tr><tr><td width=80% align=right>'+
		'���������� (��.) <INPUT TYPE="text" NAME="count" id=count size=4></td><td width=20%>&nbsp;<INPUT TYPE="submit" value=" �� ">'+
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
	<!--�������-->
	<?php if( $u->info['admin'] > 0 ) {?>
		<div style="float: right;"><input id="edit_check" type="checkbox" name="edit_check"/> <label>�������� ��������������</label></div>
	<?php }?>
	<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#a5a5a5">
	<div id="hint3" style="visibility:hidden"></div>
	<tr>
	<td align="center" height="21">
	<?php 
		/*�������� �������� (������)*/
		if(!isset($_GET['gifts']) && isset($_GET['otdel'])) 
		{
			$otdels_small_array = array (1=>'<b>�����&nbsp;&quot;������: �������,����&quot;</b>',2=>'<b>�����&nbsp;&quot;������: ������&quot;</b>',3=>'<b>�����&nbsp;&quot;������: ������,������&quot;</b>',4=>'<b>�����&nbsp;&quot;������: ����&quot;</b>',5=>'<b>�����&nbsp;&quot;������: ���������� ������&quot;</b>',6=>'<b>�����&nbsp;&quot;������: ������&quot;</b>',7=>'<b>�����&nbsp;&quot;������: ��������&quot;</b>',8=>'<b>�����&nbsp;&quot;������: ������&quot;</b>',28=>'<b>�����&nbsp;&quot;������: �����&quot;</b>',9=>'<b>�����&nbsp;&quot;������: ������ �����&quot;</b>',10=>'<b>�����&nbsp;&quot;������: ������� �����&quot;</b>',11=>'<b>�����&nbsp;&quot;������: �����&quot;</b>',12=>'<b>�����&nbsp;&quot;������: ������&quot;</b>',13=>'<b>�����&nbsp;&quot;������: �����&quot;</b>',14=>'<b>�����&nbsp;&quot;������: ������&quot;</b>',15=>'<b>�����&nbsp;&quot;����&quot;</b>',16=>'<b>�����&nbsp;&quot;��������� ������: ������&quot;</b>',17=>'<b>�����&nbsp;&quot;��������� ������: ��������&quot;</b>',18=>'<b>�����&nbsp;&quot;��������� ������: ������&quot;</b>',19=>'<b>�����&nbsp;&quot;����������: ����������&quot;</b>',20=>'<b>�����&nbsp;&quot;����������: ������ � ��������&quot;</b>',21=>'<b>�����&nbsp;&quot;���: �������&quot;</b>',22=>'<b>�����&nbsp;&quot;���: ��������&quot;</b>',23=>'<b>�����&nbsp;&quot;�������&quot;</b>',24=>'<b>�����&nbsp;&quot;�������: ��������&quot;</b>',25=>'<b>�����&nbsp;&quot;�������: ��������&quot;</b>',26=>'<b>�����&nbsp;&quot;�������: ��������&quot;</b>',27=>'<b>�����&nbsp;&quot;�������: ����������&quot;</b>');
			if(isset($otdels_small_array[$_GET['otdel']]))
			{
				echo $otdels_small_array[$_GET['otdel']];	
			}
			
		} elseif (isset($_GET['gifts'])) 
		{
			echo '
			<B>�����&nbsp;&quot;������� �������&quot;</B>';	
		}
	?>
	</tr>
	<tr><td>
	<!--������ / ��������-->
	<table width="100%" CELLSPACING="1" CELLPADDING="1" bgcolor="#a5a5a5">
	<?php
	//������� ���� � ��������� ��� �������
		if(isset($_GET['sale'])) {
			$itmAll = $u->genInv(777,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND (`im`.`price2` > 0 OR `im`.`price5` > 0) AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" ORDER BY `lastUPD` DESC');
			if($itmAll[0]==0)
			{
				$itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">�����</td></tr>';
			}else{
				$itmAllSee = $itmAll[2];
			}
			//echo '<tr><td align="center" bgcolor="#e2e0e0"><small>������� ��������� ��������� �� ���. �������������� � ������ ������ ��������, � ���-�� ������ �� �������.<br><b>������� ��������� ���� 0-7 ������� ��� 99%, ���� 8-�� ������ ��� 95%, ���� 9-�� ������, � ��� �� ������ � �������� ����� ����� � ������� ��� 70%.</b><br><font color=red><b>��������!</b></font> ��� ���������, �������, ����, ����������� ��������� �� ������ � ��������� �������� ��� �������! </small></td></tr>'.$itmAllSee;
			//echo '<tr><td align="center" bgcolor="#e2e0e0"><small>������� ��������� ��������� �� ���. �������������� � ������ ������ ��������, � ���-�� ������ �� �������.<br><b>������� ��������� ���� �� 90% �� �� ���������, � <font color=red><b>����������:</b></font> <a style="cursor: pointer;" onclick="top.getUrl(\'main\',\'main.php?premium=1\');">LikeBk Bronze</a> - 93%, <a style="cursor: pointer;" onclick="top.getUrl(\'main\',\'main.php?premium=1\');">LikeBk Silver</a> - 95%, <a style="cursor: pointer;" onclick="top.getUrl(\'main\',\'main.php?premium=1\');">LikeBk Gold</a> - 100%.</b><br><font color=red><b>��������!</b></font> ��� ���������, �������, ����, ����������� ��������� �� ������ � ��������� �������� ��� �������! </small></td></tr>'.$itmAllSee;
			echo '<tr><td align="center" bgcolor="#e2e0e0"><small>������� ��������� ��������� �� ���. �������������� � ������ ������ ��������, � ���-�� ������ �� �������.<br><b>������� ��������� ���� �� 90% �� �� ���������, � <font color=red><b>����������:</b></font> <a style="cursor: pointer;" onclick="top.getUrl(\'main\',\'main.php?premium=1\');" >LikeBk Bronze</a> - 93%, <a style="cursor: pointer;" onclick="top.getUrl(\'main\',\'main.php?premium=1\');" >LikeBk Silver</a> - 95%, <a style="cursor: pointer;" onclick="top.getUrl(\'main\',\'main.php?premium=1\');" >LikeBk Gold</a> - 100%.</b><br><font color=red><b>��������!</b></font> ��� ���������, �������, ����, ����������� ��������� �� ������ � ��������� �������� ��� �������! </small></td></tr>'.$itmAllSee;
		}else{
		//������� ���� � �������� ��� �������
		$u->shopItems($sid);
		?><script>
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
							alert("������� ������� ������");
							location.reload();
						}
						else{
							alert("������");
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
	</TD>
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
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.13&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.13',1); ?>">�������</a></td>
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
	    <b>������: </b><b style="color: #339900"><?php echo $u->info['money']?> ��.</b><br>
      	<b>�����������: </b><b style="color: #339900"><?php echo $u->bank['money2']?> e��.</b><br>
        <?
		if( $u->info['money5'] > 0 ) {
		?>
        <b>���� �����������: </b><b style="color: #339900"><?php echo $u->info['money5']?> Gold ekr.</b><br>
        <? } ?>
      	<b><a style="display: inline-block; margin-top: 3px; padding-right: 5px; text-decoration: underline; font-size: 14px; color: #339900; cursor: pointer;" onClick="location='main.php?bill=1'">��������� ������</a></b><br>
	  <!-- �����: <?//=$u->aves['now']?>/<?//=$u->aves['max']?> &nbsp;<br />
	 	�<? //echo $u->getNum($u->bank['id']); ?>: <b><? //echo $u->bank['money1']; ?></b>��. <b><? //echo $u->bank['money2']; ?></b>���. <a href="main.php?bank_exit=<? //echo $code; ?>"><img src="http://img.likebk.com/i/close_bank.gif" style="cursor:pointer;" title="������� ������ �� ������"></a></small>
       -->
   		</small>
      </div>
	  <br />
	 <?php
	//if(isset($u->bank['id']) && ($u->bank['money2']>0.00 || $u->info['admin']>0)){
		/*��������*/
		if($sale_ekr == true) {
			if(!isset($_GET['sale'])){
				//if( $u->stats['silver'] > 0 ) { 
					echo '<INPUT TYPE="button" value="������� ����" onclick="location=\'?otdel='.$_GET['otdel'].'&sale=1\'">&nbsp;';
				//}else{
				//	echo '<INPUT style="color:grey" TYPE="button" value="������� ����" onclick="alert(\'������ ��� ������� VIP\');">&nbsp;';
				//}
			} else {
				echo '<INPUT TYPE="button" value="������ ����" onclick="location=\'?otdel='.$_GET['otdel'].'\'">&nbsp;';
			}
		}
	//}
	?>
    <INPUT TYPE="button" value="��������" onclick="location = '<? echo $_SERVER['REQUEST_URI']; ?>';"><BR>
	  </div>
	<div style="background-color:#A5A5A5;padding:1"><center><B>������ ��������</B></center></div>
	<div style="line-height:17px;">
	<?php
		/*�������� �������� (������)*/
		$otdels_array = array (1=>'������: �������,����',2=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',3=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������,������',4=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����',5=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���������� ������',6=>'������: ������',7=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',8=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',28=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����',9=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ �����',10=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������� �����',11=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����',12=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',13=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����',14=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',15=>'����',16=>'��������� ������: ������',17=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',18=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',19=>'����������: ����������',20=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ � ��������',21=>'���: �������',22=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',23=>'�������',24=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',25=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',26=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',27=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����������',28=>'����� � �������',29=>'��������',30=>'������������� �������');
		$i=1;
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
		} 
		echo '</DIV>';
	?>
	</div>
	</td>
	</table>
    <br>
	<div id="textgo" style="visibility:hidden;"></div>
<?
}
?>