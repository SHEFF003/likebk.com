<?php
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='flower')
{
	$shopProcent = 50;
		
	if( $_GET['otdel'] == 4 ) {
		if( (int)date('m') != 2 || (int)date('d') < 07 ) {
			unset($_GET['otdel']);
		}
	}
			
	if(!isset($_GET['otdel'])) 
	{
		$_GET['otdel'] = 1;
	}

	$sid = 6;

	$error = '';
	
	if(isset($_GET['buy']))
	{
		if($u->newAct($_GET['sd4'])==true)
		{
			$re = $u->buyItem($sid,(int)$_GET['buy'],(int)$_GET['x'],'sudba='.$u->info['login'].'|frompisher='.$d->info['id2'].'|nosale=1');
		}else{
			$re = '�� ������� ��� ������ ������ ���� �������?';
		}
	}elseif(isset($_GET['add_item_f'])) {
		//����� ������� � �������
		$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `data` LIKE "%fshop=%" AND `id` = "'.mysql_real_escape_string($_GET['add_item_f']).'" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inShop` = "0" AND `inOdet` = "0" AND `inTransfer` = "0" LIMIT 1'));
		if(!isset($itm['id'])) {
			$re = '���������� ������� �� ������';
		}else{
			if($u->itemsX($itm['id'])==1) {
				$itm_m = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.$itm['item_id'].'" LIMIT 1'));
				mysql_query('UPDATE `items_users` SET `inShop` = "'.$sid.'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
				$re = '������� &quot;'.$itm_m['name'].'&quot; ������� ��������';
			}else{
				//������
				$re = '��������� ������ ���������';
			}
		}
	}elseif(isset($_GET['clear_itm_f'])){
		//����� ������� � �������
		$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `data` LIKE "%fshop=%" AND `id` = "'.mysql_real_escape_string($_GET['clear_itm_f']).'" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inShop` = "'.$sid.'" AND `inOdet` = "0" AND `inTransfer` = "0" LIMIT 1'));
		if(!isset($itm['id'])) {
			$re = '���������� ������� �� ������';
		}else{

			$itm_m = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.$itm['item_id'].'" LIMIT 1'));
			mysql_query('UPDATE `items_users` SET `inShop` = "0",`lastUPD` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			$re = '������� &quot;'.$itm_m['name'].'&quot; ������� �����';
		}
	}elseif(isset($_GET['createFlowers'])) {
		//�������� �����
		$vaza = false;
		$rec1 = '';
		$rec2 = '';
		$rec3 = '';
		$rec3l = 0;
		$sp = mysql_query('SELECT `id`,`item_id` FROM `items_users` WHERE `data` LIKE "%fshop=1%" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inShop` = "'.$sid.'" AND `inOdet` = "0" AND `inTransfer` = "0" ORDER BY `item_id` ASC LIMIT 1000');
		while($pl = mysql_fetch_array($sp)) {
			if($pl['item_id']!=2746) {
				$rec1 .= $pl['item_id'].',';
				$rec3 .= ' `id`='.$pl['id'].' OR';
				$rec3l++;
			}elseif($pl['item_id']==2746) {
				$vaza = true;
			}
		}
		$sp = mysql_query('SELECT `id`,`item_id` FROM `items_users` WHERE `data` LIKE "%fshop=2%" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inShop` = "'.$sid.'" AND `inOdet` = "0" AND `inTransfer` = "0" ORDER BY `item_id` ASC LIMIT 1000');
		while($pl = mysql_fetch_array($sp)) {
			if($pl['item_id']!=2746) {
				$rec2 .= $pl['item_id'].',';
				$rec3 .= ' `id`='.$pl['id'].' OR';
				$rec3l++;
			}elseif($pl['item_id']==2746) {
				$vaza = true;
			}
		}
		$rec1 = rtrim($rec1,',');
		$rec2 = rtrim($rec2,',');
		$rec3 = rtrim($rec3,'OR');

		
		//echo 'SELECT * FROM `recept` WHERE `itm_2` = "'.$rec2.'" AND `itm_1` = "'.$rec1.'" AND `shop` = "'.$sid.'" AND `active` = "1" LIMIT 1';
		$rec = mysql_fetch_array(mysql_query('SELECT * FROM `recept` WHERE `itm_2` = "'.$rec2.'" AND `itm_1` = "'.$rec1.'" AND `shop` = "'.$sid.'" AND `active` = "1" LIMIT 1'));
		if(isset($rec['id']) && $rec3 != '') {
				$itm = mysql_fetch_array(mysql_query('SELECT `id`, `name` FROM `items_main` WHERE `id` = "'.$rec['itm_add'].'" LIMIT 1'));
				$itm_data = mysql_fetch_array(mysql_query('SELECT data FROM `items_main_data` WHERE `items_id` = "'.mysql_real_escape_string($itm['id']).'"'));
				if(isset($itm['id'])) { 
						if($vaza==true && isset($itm_data['data'])){ 
								$itm_data = $u->lookStats($itm_data['data']);
								$itm_data = array('srok'=>$itm_data['srok']); // ��������� ������ ����!
								$itm_data['srok'] = (int)$itm_data['srok']; // ������ �����!
								if(isset($itm_data['srok']) and $itm_data['srok']>0){
										$itm_data['srok'] = $itm_data['srok']*3; // � ��� ���� ������ ���� ��������!
										$itm_data = '|'.$u->impStats($itm_data);
								}
						} else {
								$itm_data = NULL;
						}
						
						$u->addItem($itm['id'],$u->info['id'],$itm_data,NULL,NULL,true);
						mysql_query('UPDATE `items_users` SET `delete` = "'.time().'",`inShop` = "0" WHERE '.$rec3.' LIMIT '.$rec3l);
						$re = '������� &quot;'.$itm['name'].'&quot; ��� ������� ��������� � ���������';
				}else{
						$re = '�� ������� �������� ������� �� �������...';
				}
		} else {
				if($u->info['admin']>0) {
						echo '<div><b>ITM1:</b> '.$rec1.'</div><div><b>ITM2:</b> '.$rec2.'</div>';
				}
				$re = '���������� ������ �� ������...';
		}
	}
	
	if($re!=''){ echo '<div align="left"><font color="red"><b>'.$re.'</b></font></div>'; } ?>
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
	<tr><td valign="top"><div align="center" class="pH3">��������� �������</div>
	<?php
	echo '<b style="color:red">'.$error.'</b>';
	?>
	<br />
	<TABLE width="100%" cellspacing="0" cellpadding="4">
	<TR>
	<form name="F1" method="post">
	<TD valign="top" align="left">
	<!--�������-->
    <? if((int)$_GET['otdel']!=2){ ?>
	<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#a5a5a5">
	<div id="hint3" style="visibility:hidden"></div>
	<tr>
	<td align="center" height="21">
    <?php	
		/*�������� �������� (������)*/
		if(!isset($_GET['sale']) && !isset($_GET['gifts']) && isset($_GET['otdel'])) 
		{
			$otdels_small_array = array (1=>'<b>�����&nbsp;&quot;����� ���&quot;</b>',2=>'<b>�����&nbsp;&quot;����������� ������&quot;</b>',3=>'<b>�����&nbsp;&quot;�����&quot;</b>',4=>'<b>�����&nbsp;&quot;���� ��������&quot;</b>',9=>'<b>���������&nbsp;������</b>');
			if(isset($otdels_small_array[$_GET['otdel']]))
			{
				echo $otdels_small_array[$_GET['otdel']];	
			}		
		}
	?>
	</tr>
	<tr><td>
	<!--������ / ��������-->
	<table width="100%" CELLSPACING="1" CELLPADDING="1" bgcolor="#a5a5a5">
    <?php
		//������� ���� � �������� ��� �������
		
		
		if(isset($_GET['otdel']) && $_GET['otdel']==9) {
			//$u->shopItems(9);
			$is2='';
			$cl = mysql_query('SELECT * FROM recept WHERE active=1');
			
			while($pl = mysql_fetch_array($cl)){
				$cx = array();
				$itm = mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($pl['itm_add']).'"');
				$itm = mysql_fetch_array($itm);
				if(isset($itm) && $itm['type']!='62' ){
					$is2.='<tr style="background-color:#d4d4d4;">
						<td  width="110" style="padding:7px;" valign="middle" align="center"><a target="_blank" href="http://lib.likebk.com/items_info.php?id='.$pl['itm_add'].'"><img  src="http://img.likebk.com/i/items/'.$itm['img'].'"></a></td>
						<td width="300">';
						//
						$itmd = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.mysql_real_escape_string($pl['itm_add']).'" LIMIT 1'));
						if(isset($itmd['id'])) {
							$itd = $u->lookStats($itmd['data']);
						}
						if( $itd['srok'] > 0 ) {
							$itm['srok'] = $itd['srok'];
						}
						$itm['srok'] = ($itm['srok']/60/60/24);
						//
						$is2.='<a target="_blank" href="http://lib.likebk.com/items_info.php?id='.$pl['itm_add'].'">'.$itm['name'].'</a><br/>';
						    /*(�����: 0.01)<br/>
						    <b>����: '.$itm['price1'].' ��.</b><br/>
						    �������������: 0/'.$itm['iznosMAXi'].'<br/>
						    ���� ��������: '.$itm['srok'].' ��.';*/
							
if($itm['massa']>0) {
	$is2 .= '(�����: '.$itm['massa'].') ';
}
if(isset($itd['art'])) {
	$is2 .= '<IMG SRC=http://img.likebk.com/i/artefact.gif WIDTH=18 HEIGHT=16 ALT="����������� ����"> ';
}

				if(isset($po['sudba']))
				{
					$is2 .= '<img title="���� ������� ����� ������ ����� ������� � ������, ��� ������� ���. ����� ������ �� ������ ��� ������������." src="http://img.likebk.com/i/destiny0.gif"> ';
				}

if($itm['price1'] > 0) {
	$is2 .= '<br><b>����: '.$itm['price1'].' ��.</b>';
}

if($itm['price2'] > 0) {
	$is2 .= '<br><b style="color:SaddleBrown ">����: '.$itm['price2'].' ���.</b>';
}

if($itm['iznosMAXi'] >= 999999999) {
	$is2 .= '<br>�������������: <font color="brown">�����������</font >';
}elseif($itm['iznosMAXi'] > 0) {
	$is2 .= '<br>�������������: 0/'.$itm['iznosMAXi'].'';
}


				//���� �������� ��������
				if($itd['srok'] > 0)
				{
					$itm['srok'] = $itd['srok'];
				}
				if($itm['srok'] > 0)
				{
					$is2 .= '<br>���� ��������: '.$u->timeOut($itm['srok']);
				}
				
				//����������������� �������� �����:
				if((int)$itm['magic_inci'] > 0)
				{
					$efi = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "'.((int)$itm['magic_inci']).'" LIMIT 1'));
					if(isset($efi['id2']) && $efi['actionTime']>0)
					{
						$is2 .= '<br>����������������� ��������: '.$u->timeOut($efi['actionTime']);
					}
				}


/* ���������� */
$tr = '';

$t = $u->items['tr'];
$x = 0;
while($x<count($t)) {
	$n = $t[$x];
	if(isset($itd['tr_'.$n])) {
		$tr .= '<br>� ';
		$tr .= $u->is[$n].': '.$itd['tr_'.$n];
	}
	$x++;
}

if($tr != '') {
	$is2 .= '<br><B>��������� �����������:</B>'.$tr;
}

/* ��������� �� */
$tr = '';

$t = $u->items['add'];
$x = 0;
while($x<count($t)) {
	$n = $t[$x];
	if(isset($itd['add_'.$n]) && isset($is[$n])) {
		$z = '+';
		if($itd['add_'.$n] < 1) {
			$z = '';
		}
		$tr .= '<br>&bull; '.$u->is[$n].': '.$z.$itd['add_'.$n];
	}
	$x++;
}

				//��������� �� (�����)
				$i = 1; $bn = array(1=>'������',2=>'�������',3=>'�����',4=>'���');
				while($i<=4)
				{
					if(isset($itd['add_mab'.$i]))
					{
						if($itd['add_mab'.$i]==$itd['add_mib'.$i] && $itm['geniration']==1)
						{
							$z = '+';
							if($itd['add_mab'.$i]<0)
							{
								$z = '';
							}
							$tr .= '<br>&bull; ����� '.$bn[$i].': '.$z.''.$itd['add_mab'.$i];
						}else{
							$tr .= '<br>&bull; ����� '.$bn[$i].': '.$itd['add_mib'.$i].'-'.$itd['add_mab'.$i];
						}
					}
					$i++;
				}

if($tr != '') {
	$is2 .= '<br><B>��������� ��:</B>'.$tr;
}

/* �������� �������� */
$tr = '';

				if(isset($itd['sv_yron_min'],$itd['sv_yron_max']))
				{
					$tr .= '<br>� ����: '.$itd['sv_yron_min'].' - '.$itd['sv_yron_max'];
				}
				$x = 0;
				while($x<count($t))
				{
					$n = $t[$x];
					if(isset($itd['sv_'.$n]))
					{
						$z = '+';
						if($itd['sv_'.$n]<0)
						{
							$z = '';
						}
						$tr .= '<br>� '.$u->is[$n].': '.$z.''.$itd['sv_'.$n];
					}
					$x++;
				}
				if($itm['2too']==1)
				{
					$tr .= '<br>� ������ ������';
				}
				if($itm['2h']==1)
				{
					$tr .= '<br>� ��������� ������';
				}
				if(isset($itd['zonb']))
				{
					$tr .= '<br>� ���� ������������: ';
					if($itd['zonb']>0)
					{
						$x = 1;
						while($x<=$itd['zonb'])
						{
							$tr .= '+';
							$x++;
						}
					}else{
						$tr .= '�';
					}
				}

if($tr != '') {
	$is2 .= '<br><B>�������� ��������:</B>'.$tr;
}

/* ����������� */
$tr = '';

				$x = 1;
				while($x<=4)
				{
					if($itd['tya'.$x]>0)
					{
						$tyc = '�������� �����';
						if($itd['tya'.$x]>6)
						{
							$tyc = '�����';
						}
						if($itd['tya'.$x]>14)
						{
							$tyc = '����';
						}
						if($itd['tya'.$x]>34)
						{
							$tyc = '���������';
						}
						if($itd['tya'.$x]>79)
						{
							$tyc = '���������';
						}
						if($itd['tya'.$x]>89)
						{
							$tyc = '�����';
						}
						if($itd['tya'.$x]>=100)
						{
							$tyc = '������';
						}
						$tr .= '<br>&bull; '.$u->is['tya'.$x].': '.$tyc;
					}
					$x++;
				}
				$x = 1;
				while($x<=7)
				{
					if($itd['tym'.$x]>0)
					{
						$tyc = '�������� �����';
						if($itd['tym'.$x]>6)
						{
							$tyc = '�����';
						}
						if($itd['tym'.$x]>14)
						{
							$tyc = '����';
						}
						if($itd['tym'.$x]>34)
						{
							$tyc = '���������';
						}
						if($itd['tym'.$x]>79)
						{
							$tyc = '���������';
						}
						if($itd['tym'.$x]>89)
						{
							$tyc = '�����';
						}
						if($itd['tym'.$x]>=100)
						{
							$tyc = '������';
						}
						$tr .= '<br>&bull; '.$u->is['tym'.$x].': '.$tyc;
					}
					$x++;
				}
				$x = 1;
				while($x <= 4)
				{
					if($itd['add_oza'.$x]>0)
					{
						$tyc = '������';
						if($itd['add_oza'.$x] == 4)
						{
							$tyc = '��������������';
						}
						if($itd['add_oza'.$x] == 2)
						{
							$tyc = '����������';
						}
						if($itd['add_oza'.$x] == 3)
						{
							$tyc = '�������';
						}
						if($itd['add_oza'.$x] == 5)
						{
							$tyc = '������������';
						}
						if($tyc != '') {
							$tr .= '<br>&bull; '.$u->is['oza'.$x].': '.$tyc;
						}
					}
					$x++;
				}

				if(isset($itd['free_stats']) && $itd['free_stats']>0)
				{
					$is2 .= '<br><b>��������� �������������:</b><br>&bull; ��������� �������������: '.$itd['free_stats'];
				}

if($tr != '') {
	$is2 .= '<br><B>�����������:</B>'.$tr;
}
				//$is2 = '';

				if(isset($itd['complect']))
				{
					$is2 .= '<br><i>�������������� ����������:</i>';
				}
				if(isset($itd['complect']))
				{
					//�� ������������
					$com1 = array('name'=>'����������� ��������','x'=>0,'text'=>'');
					$spc = mysql_query('SELECT * FROM `complects` WHERE `com` = "'.$itd['complect'].'" ORDER BY  `x` ASC LIMIT 20');
					while($itmc = mysql_fetch_array($spc))
					{
						$com1['name'] = $itmc['name'];
						$com1['text'] .= '&nbsp; &nbsp; &bull; <font color="green">'.$itmc['x'].'</font>: ';
						//�������� ���������
						$i1c = 0; $i2c = 0;
						$i1e = lookStats($itmc['data']);
						while($i1c<count($u->items['add']))
						{
							if(isset($i1e[$u->items['add'][$i1c]]))
							{
								$i3c = $i1e[$u->items['add'][$i1c]];
								if($i3c>0)
								{
									$i3c = '+'.$i3c;
								}
								if($i2c>0)
								{
									$com1['text'] .= '&nbsp; &nbsp; '.$u->is[$u->items['add'][$i1c]].': '.$i3c;
								}else{
									$com1['text'] .= $u->is[$u->items['add'][$i1c]].': '.$i3c;
								}								
								$com1['text'] .= '<br>';
								$i2c++;
							}
							$i1c++;
						}
						unset($i1c,$i2c,$i3c);
						$com1['x']++;
					}
					$is2 .= '<br>&bull; ����� ���������: <b>'.$com1['name'].'</b><br><small>';
					$is2 .= $com1['text'];
					$is2 .= '</small>';
				}
				
				$is2 .= '<small style="font-size:10px;">';
				
				if($itm['info']!='')
				{
					$is2 .= '<div><b>��������:</b></div><div>'.$itm['info'].'</div>';
				}
				
				if($itd['info']!='')
				{
					$is2 .= '<div>'.$itd['info'].'</div>';                                        
				}
				
				if($itm['max_text']-$itm['use_text'] > 0) {
					$is2 .= '<div>���������� ��������: '.($itm['max_text']-$itm['use_text']).'</div>';
				}
				
				if(isset($itd['noremont']))
				{
					$is2 .= '<div style="color:brown;">������� �� �������� �������</div>';
				}
				
				if(isset($itd['frompisher']) && $itd['frompisher']>0)
				{
					$is2 .= '<div style="color:brown;">������� �� ����������</div>';
				}
				
				if($itm['dn_delete']>0)
				{
					$is2 .= '<div style="color:brown;">������� ����� ������ ��� ������ �� ����������</div>';
				}				
				
				$is2 .= '</small>';
							
						$is2.='</td>
						<td>';
						$treb = explode(',', $pl['itm_1']);
						foreach($treb as $tr){
							$itm_treb = mysql_fetch_array(mysql_query('SELECT id, name, img, srok, price1,iznosMAXi FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($tr).'"'));
							//$is2.='<a target="_blank" href="http://lib.likebk.com/items_info.php?id='.$itm_treb['id'].'" title="'.$itm_treb['name'].'"><img width="40" src="http://img.likebk.com/i/items/'.$itm_treb['img'].'"></a>';
							if( !isset($cx[$itm_treb['id']]) ) {
								$cx1 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `inShop` = "0" AND `item_id` = "'.$itm_treb['id'].'" AND `delete` = "0" LIMIT 1'));										
								$cx[$itm_treb['id']] = 0 + $cx1[0];
							}
							$is2 .= '<img width="40" '; 
							if( $cx[$itm_treb['id']] >= 1 ) {
								$is2 .= ' style="background-color:green" ';
								$cx[$itm_treb['id']]--;
							}
							$is2 .= 'src="http://img.likebk.com/i/items/'.$itm_treb['img'].'" rel="tooltip" title="'.$itm_treb['name'].' ('.$itm_treb['id'].')">';
						}
						$treb = explode(',', $pl['itm_2']);
						foreach($treb as $tr){
								if( isset($tr) && $tr!=''){
										$itm_treb = mysql_fetch_array(mysql_query('SELECT id, name, img, srok, price1,iznosMAXi FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($tr).'"'));
										//$is2.='<a target="_blank" href="http://lib.likebk.com/items_info.php?id='.$itm_treb['id'].'" title="'.$itm_treb['name'].'"><img width="40" src="http://img.likebk.com/i/items/'.$itm_treb['img'].'"></a>';
										if( !isset($cx[$itm_treb['id']]) ) {
											$cx1 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `inShop` = "0" AND `item_id` = "'.$itm_treb['id'].'" AND `delete` = "0" LIMIT 1'));										
											$cx[$itm_treb['id']] = 0 + $cx1[0];
										}
										$is2 .= '<img width="40" ';
										if( $cx[$itm_treb['id']] >= 1 ) {
											$is2 .= ' style="background-color:green" ';
											$cx[$itm_treb['id']]--;
										}
										$is2 .= ' src="http://img.likebk.com/i/items/'.$itm_treb['img'].'" rel="tooltip" title="'.$itm_treb['name'].' ('.$itm_treb['id'].')">';
								}
						}
						$is2.='</td>
					</tr>';
					$i++;
				}
			}
			echo "<tbody>".$is2."</tbody>";
		} else {
			$u->shopItems($sid);	
		}
		
	?>
	</TABLE>
	</TD></TR>
	</TABLE>
    <? }else{
	$itemsOk = $u->genInv(6,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" ORDER BY `lastUPD` DESC');
	$itemsOk = $itemsOk[2]; //�����������
	$itemsAdd = ''; //������������ ��������
	$flowerAdd = ''; //������������ �����������
	$sp = mysql_query('SELECT `u`.*,`m`.`name`,`m`.`type`,`m`.`img` FROM `items_users` AS `u` LEFT JOIN `items_main` AS `m` ON `u`.`item_id` = `m`.`id` WHERE `u`.`uid` = "'.$u->info['id'].'" AND `u`.`inShop` = "'.$sid.'" AND `u`.`delete` = "0" AND `u`.`data` LIKE "%fshop=1%"');
	while($pl = mysql_fetch_array($sp)) {
		$flowerAdd .= '<div style="float:left;width:80px;padding-bottom:5px;"><img src="http://img.likebk.com/i/items/'.$pl['img'].'"><br>&nbsp;<input type="button" onclick="location=\'main.php?otdel=2&clear_itm_f='.$pl['id'].'&rnd='.$code.'\';return false;" value="������"></div>';
	}
	$sp = mysql_query('SELECT `u`.*,`m`.`name`,`m`.`type`,`m`.`img` FROM `items_users` AS `u` LEFT JOIN `items_main` AS `m` ON `u`.`item_id` = `m`.`id` WHERE `u`.`uid` = "'.$u->info['id'].'" AND `u`.`inShop` = "'.$sid.'" AND `u`.`delete` = "0" AND `u`.`data` LIKE "%fshop=2%"');
	while($pl = mysql_fetch_array($sp)) {
		$itemsAdd .= '<div style="float:left;width:80px;padding-top:5px;"><img src="http://img.likebk.com/i/items/'.$pl['img'].'"><br>&nbsp;<input type="button" onclick="location=\'main.php?otdel=2&clear_itm_f='.$pl['id'].'&rnd='.$code.'\';return false;" value="������"></div>';
	}
	?>
    <table width="100%" style="border:1px solid #a5a5a5;" border="0" cellpadding="0" cellspacing="0" bgcolor="A5A5A5">
      <tr>
        <td colspan="2" align="center"><b>����������� ����������� ������</b></td>
      </tr>
      <tr bgcolor="C7C7C7">
        <td align="center" valign="top" width="180" nowrap="nowrap" ><b>����� ��� ������:</b><br />
          <? echo $itemsAdd; ?>
          <br />
          <div style="float:left;width:180px;padding-top:5px;">
          <input type="button"  style="width:170px;"value="������� �����" onclick="top.frames['main'].location='main.php?otdel=2&createFlowers';" />
          </div>
          </td>
          <td width="100%" align="left" valign="top">
          <? if($flowerAdd == '') { ?>&nbsp;&nbsp;<center style="padding-right:180px;">���������� ���� �����������, �� ������� ������ ��������� �����</center>
          <? }else{ echo '<br>'.$flowerAdd; } ?> <br /></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><b>����� � ��� � �������:</b></td>
      </tr>
      <tr>
        <td colspan="2"><!--������-->
          <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#A5A5A5">
            <tr>
              <td bgcolor="e2e0e0" align="center">			    
				<? if($itemsOk==''){ ?>
                <div style="padding:4px;">� ��� ��� ���������� ��������� � �������</div>
                <? }else{ echo $itemsOk; } ?>                
                </td>
            </tr>
          </table></td>
      </tr>
    </table><? } ?>
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
	<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.11&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.11',1); ?>">����������� �����</a></td>
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
	  </small>
      </div>
	  <br />
    	<INPUT TYPE="button" value="��������" onclick="location = '<? echo $_SERVER['REQUEST_URI']; ?>';"><BR>
	  </div>
	<div style="background-color:#A5A5A5;padding:1"><center><B>������ ��������</B></center></div>
	<div style="line-height:17px;">
	<?php
		/*�������� �������� (������)*/
		$otdels_array = array (1=>'����� ���',2=>'����������� ������',3=>'�����');
		if( (int)date('m') == 2 && (int)date('d') >= 07 ) {
			$otdels_array[4] = '���� ��������';
		}
		$i=1;
		while($i!=-1)
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
		
		if(isset($_GET['otdel']) && $_GET['otdel']==9){$color = 'C7C7C7';} else {$color = 'e2e0e0';}
		echo '<div><A HREF="?otdel=9"><DIV style="background-color: #'.$color.'">�������</A></DIV>';
		
		
		if(isset($_GET['gifts'])) 
		{
			$color = 'C7C7C7';	
		}else{
			$color = 'e2e0e0';	
		}
		//echo '<A HREF="?otdel=4&gifts=1"><DIV style="background-color: #'.$color.'">�������� �����</A></DIV>';
	?>
	</div>
	</td>
	</table>
    <br>
	<div id="textgo" style="visibility:hidden;"></div>
<?
}
?>