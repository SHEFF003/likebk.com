<?
if(!defined('GAME'))
{
	die();
}

if(isset($_GET['delcop'])) {
	mysql_query('DELETE FROM `complects_priem` WHERE `id` = "'.mysql_real_escape_string($_GET['delcop']).'" AND `uid` = "'.$u->info['id'].'" LIMIT 1');
}elseif(isset($_GET['usecopr'])) {
	$cpr = mysql_fetch_array(mysql_query('SELECT * FROM `complects_priem` WHERE `id` = "'.mysql_real_escape_string($_GET['usecopr']).'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
	if(isset($cpr['id'])) {
		$u->info['priems'] = $cpr['priems'];
		mysql_query('UPDATE `stats` SET `priems` = "'.mysql_real_escape_string($cpr['priems']).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	}
}elseif(isset($_GET['clear_abil']) && $u->info['priems'] != '0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0') {
	$u->info['priems'] = '0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0';
	mysql_query('UPDATE `stats` SET `priems` = "'.$u->info['priems'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
}

include_once('_incl_data/class/_cron_.php');

if(isset($_GET['use_priem']))
{
	$priem->uns((int)$_GET['use_priem']);
}elseif(isset($_GET['unuse_priem']))
{
	$priem->reuns((int)$_GET['unuse_priem']);
}

//����� ������
$znn = '';
$toms = 0;
$sp = mysql_query('SELECT * FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "read" AND `time` < '.time().'');
while($pl = mysql_fetch_array($sp))
{
	$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$pl['vals'].'" LIMIT 1'));
	if(isset($itm['id']))
	{
		if( $itm['id'] >= 1044 && $itm['id'] <=1047 ) {
			$toms++;
		}
		$lvar = '<br>���� ��������: '.date('d.m.Y',$pl['time']).'';	
		$znn .= '<a target="_blank" href="http://lib.'.$c['host'].'/items_info.php?id='.$pl['vals'].'&rnd='.$code.'"><img style="margin:2px;" src="http://img.likebk.com/i/items/'.$itm['img'].'" onMouseOver="top.hi(this,\'�������: <b>'.$itm['name'].'</b>'.$lvar.'\',event,3,0,1,1);" onMouseOut="top.hic();" onMouseDown="top.hic();" /></a> ';
	}else{
		$znn .= '<img style="margin:2px;" src="http://img.likebk.com/i/items/nozn.gif" title="���������: ����������� ������" /> ';
	}
}

if( 10+$toms > $u->info['priemslot'] ) {	
	$u->info['priemslot'] = 10 + $toms;
	mysql_query('UPDATE `stats` SET `priemslot` = "'.$u->info['priemslot'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
}

$rzsee = 1;

if(isset($_GET['rz']))
{
	$rzsee = round((int)$_GET['rz']);
	if($rzsee<=0 || $rzsee>7 || $rzsee==2)
	{
		$rzsee = 1;
	}
}	

$energy = '';
$str = '';
$inst = '';
$dex = '';
$intel = '';
$mec = '';
$dub = '';
$nj = '';
$top = '';
$pos = '';
$ogon = '';
$voda = '';
$vozduh = '';
$zemla = '';
$svet  = '';
$seraya = '';
$tma = '';
?>


<style type="text/css"> 
.tz		{ font-weight:bold; color: #003388; background-color: #CCCCCC; cursor:pointer; text-align: center; }
.tzS		{ font-weight:bold; color: #000000; background-color: #CCCCCC; text-align: center; }
.tzOver		{ font-weight:bold; color: #003388; background-color: #C0C0C0; cursor:pointer; text-align: center; }
.tzSet		{ font-weight:bold; color: #003388; background-color: #A6B1C6; cursor:default; text-align: center; }
.dtz		{ display: none }
.nonactive	{filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1); filter:progid:DXImageTransform.Microsoft.Alpha(opacity=30);}
.nactive {
cursor:pointer;
}
</style>

<body leftmargin=0 topmargin=0 marginwidth=0 marginheight=0 bgcolor=e2e0e0>

<SCRIPT>
var clevel='';
var currentID=<? echo time(); ?>;
var newrz = <? echo $rzsee; ?>;
function dw(s) {document.write(s);}

function highl(nm, i)
{	if (clevel == nm) { document.getElementById(nm).className = 'tzSet' }
	else {
		if (i==1) { document.getElementById(nm).className = 'tzOver' }
		else { document.getElementById(nm).className = 'tz' }
	}
}
function setlevel(nm)
{

		if (clevel != '') {
			document.getElementById(clevel).className = 'tz';
			document.getElementById('d'+clevel).style.display = 'none';
		}
		clevel = nm || 'L1';
		document.getElementById(clevel).className = 'tzSet';
		document.getElementById('d'+clevel).style.display = 'inline';
		newrz = nm.split('L');
		newrz = newrz[1];
}

</SCRIPT>

<TABLE width=100%>
	<TD>
<?
$st = $u->lookStats($u->info['stats']);
if(@$_GET['dec_transfer'] || @$_GET['dec_travma'] || @$_GET['fast_homeworld'] || @$_GET['inc_expr'] || @$_GET['inc_friends'] || @$_GET['inc_hobby'] || @$_GET['max_inventory'] || @$_GET['num_transfer'] || @$_GET['speed_HP'] || @$_GET['speed_MP'] || @$_GET['speed_debuff'])
{
	$summs = floor($_GET['dec_transfer']+$_GET['dec_travma']+$_GET['fast_homeworld']+$_GET['inc_expr']+$_GET['inc_friends']+$_GET['inc_hobby']+$_GET['max_inventory']+$_GET['num_transfer']+$_GET['speed_HP']+$_GET['speed_MP']+$_GET['speed_debuff']);
	if(!is_numeric($summs)){$summs=0;}
	
	if($summs>1)
	{
		$summs=0;
		echo '&nbsp; &nbsp;<font color=red>���-�� ����� �� ���...</font><br>';
	}elseif($summs<0)
	{
		$summs=0;
		echo '&nbsp; &nbsp;<font color=red>��� �������� ����� ����������, ��� �� ��� ������ �� ��� ;)</font><br>';
	}elseif(($st['os1']+$_GET['dec_transfer']<=5 && $_GET['dec_transfer']>0) ||
			($st['os2']+$_GET['dec_travma']<=5 && $_GET['dec_travma']>0) ||
			($st['os3']+$_GET['fast_homeworld']<=5 && $_GET['fast_homeworld']>0) ||
			($st['os4']+$_GET['inc_expr']<=5 && $_GET['inc_expr']>0) ||
			($st['os5']+$_GET['inc_friends']<=5 && $_GET['inc_friends']>0) ||
			($st['os6']+$_GET['inc_hobby']<=5 && $_GET['inc_hobby']>0) ||
			($st['os7']+$_GET['max_inventory']<=5 && $_GET['max_inventory']>0) ||
			($st['os8']+$_GET['num_transfer']<=5 && $_GET['num_transfer']>0) ||
			($st['os9']+$_GET['speed_HP']<=5 && $_GET['speed_HP']>0) ||
			($st['os10']+$_GET['speed_MP']<=5 && $_GET['speed_MP']>0) ||
			($st['os11']+$_GET['speed_debuff']<=5 && $_GET['speed_debuff']>0) && $u->info['id']==$_GET['s4i']
		  )
		{
		
			$st['os1'] += (int)$_GET['dec_transfer'];
			$st['os2'] += (int)$_GET['dec_travma'];
			$st['os3'] += (int)$_GET['fast_homeworld'];
			$st['os4'] += (int)$_GET['inc_expr'];
			$st['os5'] += (int)$_GET['inc_friends'];
			$st['os6'] += (int)$_GET['inc_hobby'];
			$st['os7'] += (int)$_GET['max_inventory'];
			$st['os8'] += (int)$_GET['num_transfer'];
			$st['os9'] += (int)$_GET['speed_HP'];
			$st['os10'] += (int)$_GET['speed_MP'];
			$st['os11'] += (int)$_GET['speed_debuff'];
			$u->info['stats'] = $u->impStats($st);
		}if($u->info['sskills']-(int)$summs<0)
		{
			echo '&nbsp; &nbsp;<font color=red>� ��� ��� ��������� ������������</font><br>';
		}elseif(mysql_query("UPDATE 
							`stats` 
						SET 
							`stats`= '".mysql_real_escape_string($u->info['stats'])."',
							`sskills` = `sskills` - '".mysql_real_escape_string((int)$summs)."'
						WHERE 
							`id` = '".(int)$u->info['id']."';")) 
		{
			if($_GET['dec_transfer']==1) {echo "&nbsp; &nbsp;<font color=red>�� ������� ����������� \"������������ ".($st['os1']>1?" - ".$st['os1']."":"")."\"</font><br>";}
			if($_GET['dec_travma']==1) {echo "&nbsp; &nbsp;<font color=red>�� ������� ����������� \"������� ".($st['os2']>1?" - ".$st['os2']."":"")."\"</font><br>";}
			if($_GET['fast_homeworld']==1) {echo "&nbsp; &nbsp;<font color=red>�� ������� ����������� \"������� ".($st['os3']>1?" - ".$st['os3']."":"")."\"</font><br>";}
			if($_GET['inc_expr']==1) {echo "&nbsp; &nbsp;<font color=red>�� ������� ����������� \"��������������� ".($st['os4']>1?" - ".$st['os4']."":"")."\"</font><br>";}
			if($_GET['inc_friends']==1) {echo "&nbsp; &nbsp;<font color=red>�� ������� ����������� \"����������� ".($st['os5']>1?" - ".$st['os5']."":"")."\"</font><br>";}
			if($_GET['inc_hobby']==1) {echo "&nbsp; &nbsp;<font color=red>�� ������� ����������� \"����������� ".($st['os6']>1?" - ".$st['os6']."":"")."\"</font><br>";}
			if($_GET['max_inventory']==1) {echo "&nbsp; &nbsp;<font color=red>�� ������� ����������� \"���������� ".($st['os7']>1?" - ".$st['os7']."":"")."\"</font><br>";}
			if($_GET['num_transfer']==1) {echo "&nbsp; &nbsp;<font color=red>�� ������� ����������� \"���������������� ".($st['os8']>1?" - ".$st['os8']."":"")."\"</font><br>";}
			if($_GET['speed_HP']==1) {echo "&nbsp; &nbsp;<font color=red>�� ������� ����������� \"���������� ".($st['os9']>1?" - ".$st['os9']."":"")."\"</font><br>";}
			if($_GET['speed_MP']==1) {echo "&nbsp; &nbsp;<font color=red>�� ������� ����������� \"�������������� ".($st['os10']>1?" - ".$st['os10']."":"")."\"</font><br>";}
			if($_GET['speed_debuff']==1) {echo "&nbsp; &nbsp;<font color=red>�� ������� ����������� \"�������� ��� ".($st['os11']>1?" - ".$st['os11']."":"")."\"</font><br>";}
			$u->info['sskills'] -= $summs;
		}
}
if (@$_GET['upr']) {
	/*-----��������� ����� ������ � ������-----*/
	if(!isset($_GET['energy']) || $_GET['energy'] < 0){ $_GET['energy'] = 0; }
	if(!isset($_GET['str']) || $_GET['str'] < 0){ $_GET['str'] = 0; }
	if(!isset($_GET['dex']) || $_GET['dex'] < 0){ $_GET['dex'] = 0; }
	if(!isset($_GET['inst']) || $_GET['inst'] < 0){ $_GET['inst'] = 0; }
	if(!isset($_GET['power']) || $_GET['power'] < 0){ $_GET['power'] = 0; }
	if(!isset($_GET['intel']) || $_GET['intel'] < 0){ $_GET['intel'] = 0; }
	if(!isset($_GET['wis']) || $_GET['wis'] < 0){ $_GET['wis'] = 0; }
	if(!isset($_GET['spirit']) || $_GET['spirit'] < 0){ $_GET['spirit'] = 0; }
	if(!isset($_GET['will']) || $_GET['will'] < 0){ $_GET['will'] = 0; }
	if(!isset($_GET['freedom']) || $_GET['freedom'] < 0){ $_GET['freedom'] = 0; }
	if(!isset($_GET['god']) || $_GET['god'] < 0){ $_GET['god'] = 0; }
	
	if(!isset($_GET['m_sword']) || $_GET['m_sword'] < 0){ $_GET['m_sword'] = 0; }
	if(!isset($_GET['m_tohand']) || $_GET['m_tohand'] < 0){ $_GET['m_tohand'] = 0; }
	if(!isset($_GET['m_molot']) || $_GET['m_molot'] < 0){ $_GET['m_molot'] = 0; }
	if(!isset($_GET['m_axe']) || $_GET['m_axe'] < 0){ $_GET['m_axe'] = 0; }
	if(!isset($_GET['m_staff']) || $_GET['m_staff'] < 0){ $_GET['m_staff'] = 0; }
	if(!isset($_GET['m_magic1']) || $_GET['m_magic1'] < 0){ $_GET['m_magic1'] = 0; }
	if(!isset($_GET['m_magic2']) || $_GET['m_magic2'] < 0){ $_GET['m_magic2'] = 0; }
	if(!isset($_GET['m_magic3']) || $_GET['m_magic3'] < 0){ $_GET['m_magic3'] = 0; }
	if(!isset($_GET['m_magic4']) || $_GET['m_magic4'] < 0){ $_GET['m_magic4'] = 0; }
	if(!isset($_GET['m_magic5']) || $_GET['m_magic5'] < 0){ $_GET['m_magic5'] = 0; }
	if(!isset($_GET['m_magic6']) || $_GET['m_magic6'] < 0){ $_GET['m_magic6'] = 0; }
	if(!isset($_GET['m_magic7']) || $_GET['m_magic7'] < 0){ $_GET['m_magic7'] = 0; }

			
	$summ = floor($_GET['energy']+$_GET['str']+$_GET['dex']+$_GET['inst']+$_GET['power']+$_GET['intel']+$_GET['wis']+$_GET['spirit']+$_GET['will']+$_GET['freedom']+$_GET['god']);
	if(!is_numeric($summ)){$summ=0;}
	$summu = floor($_GET['m_axe']+$_GET['m_molot']+$_GET['m_sword']+$_GET['m_tohand']+$_GET['m_staff']+$_GET['m_magic1']+$_GET['m_magic2']+$_GET['m_magic3']+$_GET['m_magic4']+$_GET['m_magic5']+$_GET['m_magic6']+$_GET['m_magic7']);
	if(!is_numeric($summu)){$summu=0;}

	/*-----��������� ����� ������ � ������-----*/
	/*-----����� ����� � ������----*/
		if(
			(($_GET['energy']>0 || $_GET['str']>0 ||
			$_GET['dex']>0 ||
			$_GET['inst']>0 ||
			$_GET['power']>0 ||
			($_GET['intel']>0 && $u->info['level'] > 3) ||
			($_GET['wis']>0 && $u->info['level'] > 6) ||
			($_GET['spirit']>0 && $u->info['level'] > 9) ||
			($_GET['will']>0 && $u->info['level'] > 12) ||
			($_GET['freedom']>0 && $u->info['level'] > 15) ||
			($_GET['god']>0 && $u->info['level'] > 18)) && $summ<=$u->info['ability'] && $u->info['ability']>0) ||
			(($st['a1']+$_GET['m_sword']>0) ||
			($st['a2']+$_GET['m_tohand']>0) ||
			($st['a3']+$_GET['m_molot']>0) ||
			($st['a4']+$_GET['m_axe']>0) ||
			($st['a5']+$_GET['m_staff']>0) ||
			($st['mg1']+$_GET['m_magic1']>0) ||
			($st['mg2']+$_GET['m_magic2']>0) ||
			($st['mg3']+$_GET['m_magic3']>0) ||
			($st['mg4']+$_GET['m_magic4']>0) ||
			($st['mg5']+$_GET['m_magic5']>0) ||
			($st['mg6']+$_GET['m_magic6']>0) ||
			($st['mg7']+$_GET['m_magic7']>0) && $summu<=$u->info['skills'] && $u->info['skills']>0)  && $u->info['id']==$_GET['s4i']
		)
		{
			$st['s1'] += (int)$_GET['str'];
			$st['s2'] += (int)$_GET['dex'];
			$st['s3'] += (int)$_GET['inst'];
			$st['s4'] += (int)$_GET['power'];
			$st['a1'] += (int)$_GET['m_sword'];
			$st['a2'] += (int)$_GET['m_tohand'];
			$st['a3'] += (int)$_GET['m_molot'];
			$st['a4'] += (int)$_GET['m_axe'];
			$st['a5'] += (int)$_GET['m_staff'];
			$st['mg1'] += (int)$_GET['m_magic1'];
			$st['mg2'] += (int)$_GET['m_magic2'];
			$st['mg3'] += (int)$_GET['m_magic3'];
			$st['mg4'] += (int)$_GET['m_magic4'];
			$st['mg5'] += (int)$_GET['m_magic5'];
			$st['mg6'] += (int)$_GET['m_magic6'];
			$st['mg7'] += (int)$_GET['m_magic7'];
			if ($u->info['level'] > 3) {$st['s5'] += (int)$_GET['intel'];}
			if ($u->info['level'] > 6) {$st['s6'] += (int)$_GET['wis'];}
			if ($u->info['level'] > 9) {$st['s7'] += (int)$_GET['spirit'];}
			if ($u->info['level'] > 12) {$st['s8'] += (int)$_GET['will'];}
			if ($u->info['level'] > 15) {$st['s9'] += (int)$_GET['freedom'];}
			if ($u->info['level'] > 18) {$st['s10'] += (int)$_GET['god'];}
			//$st['s11'] +=(int)$_GET['energy'];
			
			$u->info['stats'] = $u->impStats($st);
			
			/*if((int)$_GET['energy'] + $u->stats['s11'] > $u->info['level']) {
				echo '&nbsp; &nbsp;<font color=red>������� �� ����� ���� ���� ������ ���������</font><br>';
			}else*/
			if(/*$_GET['energy'] < 0 || */$_GET['str'] < 0 || $_GET['dex'] < 0 || $_GET['intel'] < 0 || $_GET['wis'] < 0 || $_GET['spirit'] < 0 || $_GET['will'] < 0 || $_GET['freedom'] < 0 || $_GET['god'] < 0 || $_GET['inst'] < 0 || $_GET['power'] < 0 || $_GET['m_sword'] < 0 || $_GET['m_tohand'] < 0 || $_GET['m_molot'] < 0 || $_GET['m_staff'] < 0	|| $_GET['m_magic1'] < 0 || $_GET['m_magic2'] < 0 || $_GET['m_magic3'] < 0 || $_GET['m_magic4'] < 0 || $_GET['m_magic5'] < 0 || $_GET['m_magic6'] < 0 || $_GET['m_magic7'] < 0) {
				echo '&nbsp; &nbsp;<font color=red>1) ���-�� ����� �� ���...</font><br>';
			}elseif($u->info['ability']-(int)$summ<0 || $u->info['skills']-(int)$summu<0)
			{
				echo '&nbsp; &nbsp;<font color=red>���-�� ����� �� ���... (�����������: '.($u->info['ability']-(int)$summ).', ������: '.($u->info['skills']-(int)$summu).')</font><br>';
			}elseif(mysql_query("UPDATE 
							`stats` 
						SET 
							`stats`= '".mysql_real_escape_string($u->info['stats'])."', 
							`ability` = `ability` - '".mysql_real_escape_string((int)$summ)."', 
							`skills` = `skills` - '".mysql_real_escape_string((int)$summu)."'
						WHERE 
							`id` = '".(int)$u->info['id']."';")) 
			{				
				//if($_GET['energy']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ����������� "<B>�������</B>" ����������� ������</font><br>';}
				if($_GET['str']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ����������� "<B>����</B>" ����������� ������</font><br>';}
				if($_GET['dex']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ����������� "<B>��������</B>" ����������� ������</font><br>';}
				if($_GET['inst']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ����������� "<B>��������</B>" ����������� ������</font><br>';}
				if($_GET['power']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ����������� "<B>������������</B>" ����������� ������</font><br>';}
				if($_GET['intel']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ����������� "<B>���������</B>" ����������� ������</font><br>';}
				if($_GET['wis']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ����������� "<B>��������</B>" ����������� ������</font><br>';}
				if($_GET['spirit']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ����������� "<B>����������</B>" ����������� ������</font><br>';}
				if($_GET['will']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ����������� "<B>����</B>" ����������� ������</font><br>';}
				if($_GET['freedom']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ����������� "<B>������� ����</B>" ����������� ������</font><br>';}
				if($_GET['god']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ����������� "<B>��������������</B>" ����������� ������</font><br>';}
				if($_GET['m_sword']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ������ "<B>���������� �������� ������, ���������</B>" ����������� ������</font><br>';}
				if($_GET['m_axe']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ������ "<B>���������� �������� ������</B>" ����������� ������</font><br>';}
				if($_GET['m_molot']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ������ "<B>���������� �������� ��������, ��������</B>" ����������� ������</font><br>';}
				if($_GET['m_tohand']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ������ "<B>���������� �������� ��������, ��������</B>" ����������� ������</font><br>';}
				if($_GET['m_staff']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ������ "<B>���������� �������� ����������� ��������</B>" ����������� ������</font><br>';}
				if($_GET['m_magic1']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ������ "<B>���������� �������� ������� ����</B>" ����������� ������</font><br>';}
				if($_GET['m_magic2']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ������ "<B>���������� �������� ������� �������</B>" ����������� ������</font><br>';}
				if($_GET['m_magic3']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ������ "<B>���������� �������� ������� ����</B>" ����������� ������</font><br>';}
				if($_GET['m_magic4']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ������ "<B>���������� �������� ������� �����</B>" ����������� ������</font><br>';}
				if($_GET['m_magic5']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ������ "<B>���������� �������� ������ �����</B>" ����������� ������</font><br>';}
				if($_GET['m_magic6']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ������ "<B>���������� �������� ������ ����</B>" ����������� ������</font><br>';}
				if($_GET['m_magic7']>0) {echo '&nbsp; &nbsp;<font color=red>���������� ������ "<B>���������� �������� ����� ������</B>" ����������� ������</font><br>';}
				/*--��� ����������--*/
							//$u->stats['s11'] += (int)$_GET['energy'];
							$u->stats['s1'] += (int)$_GET['str'];
							$u->stats['s2'] += (int)$_GET['dex'];
							$u->stats['s3'] += (int)$_GET['inst'];
							$u->stats['s4'] += (int)$_GET['power'];
							$u->stats['a1'] += (int)$_GET['m_sword'];
							$u->stats['a2'] += (int)$_GET['m_tohand'];
							$u->stats['a3'] += (int)$_GET['m_molot'];
							$u->stats['a4'] += (int)$_GET['m_axe'];
							$u->stats['a5'] += (int)$_GET['m_staff'];
							$u->stats['mg1'] += (int)$_GET['m_magic1'];
							$u->stats['mg2'] += (int)$_GET['m_magic2'];
							$u->stats['mg3'] += (int)$_GET['m_magic3'];
							$u->stats['mg4'] += (int)$_GET['m_magic4'];
							$u->stats['mg5'] += (int)$_GET['m_magic5'];
							$u->stats['mg6'] += (int)$_GET['m_magic6'];
							$u->stats['mg7'] += (int)$_GET['m_magic7'];
							if ($u->info['level'] > 3) {$u->stats['s5'] += (int)$_GET['intel'];}
							if ($u->info['level'] > 6) {$u->stats['s6'] += (int)$_GET['wis'];}
							if ($u->info['level'] > 9) {$u->stats['s7'] += (int)$_GET['spirit'];}
							if ($u->info['level'] > 12) {$u->stats['s8'] += (int)$_GET['will'];}
							if ($u->info['level'] > 15) {$u->stats['s9'] += (int)$_GET['freedom'];}
							if ($u->info['level'] > 18) {$u->stats['s10'] += (int)$_GET['god'];}
							$u->info['ability'] -= $summ;
							$u->info['skills'] -= $summu;
							/*--��� ����������--*/
			}
		}
}
	/*-----����� ����� � ������-----*/
/////������ ������ ��������
if(!isset($st['s1'])) {$st['s1']=0;}
if(!isset($st['s2'])) {$st['s2']=0;}
if(!isset($st['s3'])) {$st['s3']=0;}
if(!isset($st['s4'])) {$st['s4']=0;}
if(!isset($st['s5'])) {$st['s5']=0;}
if(!isset($st['s6'])) {$st['s6']=0;}
if(!isset($st['s7'])) {$st['s7']=0;}
if(!isset($st['s8'])) {$st['s8']=0;}
if(!isset($st['s9'])) {$st['s9']=0;}
if(!isset($st['s10'])) {$st['s10']=0;}
//if(!isset($st['s11'])) {$st['s11']=0;}
if(!isset($st['a1'])) {$st['a1']=0;}
if(!isset($st['a2'])) {$st['a2']=0;}
if(!isset($st['a3'])) {$st['a3']=0;}
if(!isset($st['a4'])) {$st['a4']=0;}
if(!isset($st['a5'])) {$st['a5']=0;}
if(!isset($st['mg1'])) {$st['mg1']=0;}
if(!isset($st['mg2'])) {$st['mg2']=0;}
if(!isset($st['mg3'])) {$st['mg3']=0;}
if(!isset($st['mg4'])) {$st['mg4']=0;}
if(!isset($st['mg5'])) {$st['mg5']=0;}
if(!isset($st['mg6'])) {$st['mg6']=0;}
if(!isset($st['mg7'])) {$st['mg7']=0;}
if(!isset($u->stats['s1'])) {$u->stats['s1']=0;}
if(!isset($u->stats['s2'])) {$u->stats['s2']=0;}
if(!isset($u->stats['s3'])) {$u->stats['s3']=0;}
if(!isset($u->stats['s4'])) {$u->stats['s4']=0;}
if(!isset($u->stats['s5'])) {$u->stats['s5']=0;}
if(!isset($u->stats['s6'])) {$u->stats['s6']=0;}
if(!isset($u->stats['s7'])) {$u->stats['s7']=0;}
if(!isset($u->stats['s8'])) {$u->stats['s8']=0;}
if(!isset($u->stats['s9'])) {$u->stats['s9']=0;}
if(!isset($u->stats['s10'])) {$u->stats['s10']=0;}
//if(!isset($u->stats['s11'])) {$u->stats['s11']=0;}
if(!isset($u->stats['a1'])) {$u->stats['a1']=0;}
if(!isset($u->stats['a2'])) {$u->stats['a2']=0;}
if(!isset($u->stats['a3'])) {$u->stats['a3']=0;}
if(!isset($u->stats['a4'])) {$u->stats['a4']=0;}
if(!isset($u->stats['a5'])) {$u->stats['a5']=0;}
if(!isset($u->stats['mg1'])) {$u->stats['mg1']=0;}
if(!isset($u->stats['mg2'])) {$u->stats['mg2']=0;}
if(!isset($u->stats['mg3'])) {$u->stats['mg3']=0;}
if(!isset($u->stats['mg4'])) {$u->stats['mg4']=0;}
if(!isset($u->stats['mg5'])) {$u->stats['mg5']=0;}
if(!isset($u->stats['mg6'])) {$u->stats['mg6']=0;}
if(!isset($u->stats['mg7'])) {$u->stats['mg7']=0;}
if(!isset($u->stats['a1'])) {$u->stats['a1']=0;}
if(!isset($u->stats['a2'])) {$u->stats['a2']=0;}
if(!isset($u->stats['a3'])) {$u->stats['a3']=0;}
if(!isset($u->stats['a4'])) {$u->stats['a4']=0;}
if(!isset($u->stats['a5'])) {$u->stats['a5']=0;}
if(!isset($u->stats['mg1'])) {$u->stats['mg1']=0;}
if(!isset($u->stats['mg2'])) {$u->stats['mg2']=0;}
if(!isset($u->stats['mg3'])) {$u->stats['mg3']=0;}
if(!isset($u->stats['mg4'])) {$u->stats['mg4']=0;}
if(!isset($u->stats['mg5'])) {$u->stats['mg5']=0;}
if(!isset($u->stats['mg6'])) {$u->stats['mg6']=0;}
if(!isset($u->stats['mg7'])) {$u->stats['mg7']=0;}
///////////////////////////
/////�����
$sil = $u->stats['s1'] - $st['s1'];
if($sil>0){$str = "<SMALL>&nbsp;(<SPAN id=\"str_inst\">".$st['s1']."</SPAN>+".$sil.")</SMALL>";}
$lov = $u->stats['s2'] - $st['s2'];
if($lov>0){$dex = "<SMALL>&nbsp;(<SPAN id=\"dex_inst\">".$st['s2']."</SPAN>+".$lov.")</SMALL>";}
$int = $u->stats['s3'] - $st['s3'];
if($int>0){$inst = "<SMALL>&nbsp;(<SPAN id=\"inst_inst\">".$st['s3']."</SPAN>+".$int.")</SMALL>";}
$intell = $u->stats['s5'] - $st['s5'];
if($intell>0){$intel = "<SMALL>&nbsp;(<SPAN id=\"intel_inst\">".$st['s5']."</SPAN>+".$intell.")</SMALL>";}
//$energy = $u->stats['s11'] - $st['s11'];
//if($energy>0){$energy = "<SMALL>&nbsp;(<SPAN id=\"intel_inst\">".$st['s11']."</SPAN>+".$energy.")</SMALL>";}
/////������
$noj = $u->stats['a1'] - $st['a1'];
if($noj>0){$nj = "<SMALL>&nbsp;(<SPAN id=\"m_sword_inst\">".$st['a1']."</SPAN>+".$noj.")</SMALL>";}
$topor = $u->stats['a2'] - $st['a2'];
if($topor>0){$top = "<SMALL>&nbsp;(<SPAN id=\"m_tohand_inst\">".$st['a2']."</SPAN>+".$topor.")</SMALL>";}
$dubina = $u->stats['a3'] - $st['a3'];
if($dubina>0){$dub = "<SMALL>&nbsp;(<SPAN id=\"m_molot_inst\">".$st['a3']."</SPAN>+".$dubina.")</SMALL>";}
$mech = $u->stats['a4'] - $st['a4'];
if($mech>0){$mec = "<SMALL>&nbsp;(<SPAN id=\"m_axe_inst\">".$st['a4']."</SPAN>+".$mech.")</SMALL>";}
$posoh = $u->stats['a5'] - $st['a5'];
if($posoh>0){$pos = "<SMALL>&nbsp;(<SPAN id=\"m_staff_inst\">".$st['a5']."</SPAN>+".$posoh.")</SMALL>";}
/////�����
$fire = $u->stats['mg1'] - $st['mg1'];
if($fire>0){$ogon = "<SMALL>&nbsp;(<SPAN id=\"m_magic1_inst\">".$st['mg1']."</SPAN>+".$fire.")</SMALL>";}
$water = $u->stats['mg2'] - $st['mg2'];
if($water>0){$voda = "<SMALL>&nbsp;(<SPAN id=\"m_magic2_inst\">".$st['mg2']."</SPAN>+".$water.")</SMALL>";}
$air = $u->stats['mg3'] - $st['mg3'];
if($air>0){$vozduh = "<SMALL>&nbsp;(<SPAN id=\"m_magic3_inst\">".$st['mg3']."</SPAN>+".$air.")</SMALL>";}
$earth = $u->stats['mg4'] - $st['mg4'];
if($earth>0){$zemla = "<SMALL>&nbsp;(<SPAN id=\"m_magic4_inst\">".$st['mg4']."</SPAN>+".$earth.")</SMALL>";}
$light = $u->stats['mg5'] - $st['mg5'];
if($light>0){$svet = "<SMALL>&nbsp;(<SPAN id=\"m_magic5_inst\">".$st['mg5']."</SPAN>+".$light.")</SMALL>";}
$gray = $u->stats['mg6'] - $st['mg6'];
if($gray>0){$seraya = "<SMALL>&nbsp;(<SPAN id=\"m_magic6_inst\">".$st['mg6']."</SPAN>+".$gray.")</SMALL>";}
$dark = $u->stats['mg7'] - $st['mg7'];
if($dark>0){$tma = "<SMALL>&nbsp;(<SPAN id=\"m_magic7_inst\">".$st['mg7']."</SPAN>+".$dark.")</SMALL>";}
/////�����������
$os['os1'] = $st['os1'];
//$os['os2'] = $st['os2'];
$os['os3'] = $st['os3'];
$os['os4'] = $st['os4'];
$os['os5'] = $st['os5'];
$os['os6'] = $st['os6'];
$os['os7'] = $st['os7'];
//$os['os8'] = $st['os8'];
$os['os9'] = $st['os9'];
$os['os10'] = $st['os10'];
//$os['os11'] = $st['os11'];

$os["os1"]=array("name"=>"������������","opt"=>"dec_transfer","descr"=>"�������� ��������� ������� �� ", "nlevel"=>4,"bonus1"=>"0,1 ��.","bonus2"=>"0,2 ��.","bonus3"=>"0,3 ��.","bonus4"=>"0,4 ��.","bonus5"=>"0,5 ��.");
//$os["os2"]=array("name"=>"�������","opt"=>"dec_travma","descr"=>"����� ������ ������ �� ", "nlevel"=>4,"bonus1"=>"5%","bonus2"=>"10%","bonus3"=>"15%","bonus4"=>"20%","bonus5"=>"25%");
$os["os3"]=array("name"=>"�������","opt"=>"fast_homeworld","descr"=>"������ \"�������\" ���������� ������ �� ", "nlevel"=>4,"bonus1"=>"5 �����","bonus2"=>"10 �����","bonus3"=>"15 �����","bonus4"=>"20 �����","bonus5"=>"25 �����");
$os["os4"]=array("name"=>"���������������","opt"=>"inc_expr","descr"=>"���������� ���� ������ �� ", "nlevel"=>4,"bonus1"=>"1 %","bonus2"=>"2 %","bonus3"=>"3 %","bonus4"=>"4 %","bonus5"=>"5 %");
$os["os5"]=array("name"=>"�����������","opt"=>"inc_friends","descr"=>"C����� ������ ������ �� ","bonus1"=>5,"bonus2"=>10,"bonus3"=>15,"bonus4"=>20,"bonus5"=>25);
$os["os6"]=array("name"=>"�����������","opt"=>"inc_hobby","descr"=>"���������� ������������� ������� ������� \"��������� / �����\" �� ","bonus1"=>"200 ��������","bonus2"=>"400 ��������","bonus3"=>"600 ��������","bonus4"=>"800 ��������","bonus5"=>"1000 ��������");
$os["os7"]=array("name"=>"����������","opt"=>"max_inventory","descr"=>"������ ����� � ������� �� ", "nlevel"=>4,"bonus1"=>"10 ������","bonus2"=>"20 ������","bonus3"=>"30 ������","bonus4"=>"40 ������","bonus5"=>"50 ������");
//$os["os8"]=array("name"=>"����������������","opt"=>"num_transfer","descr"=>"����� ������� � ���� ", "nlevel"=>4,"bonus1"=>"+20","bonus2"=>"+40","bonus3"=>"+60","bonus4"=>"+80","bonus5"=>"+100");
$os["os9"]=array("name"=>"����������","opt"=>"speed_HP","descr"=>"�������� ����������������� ������� �� ", "npower"=>10,"bonus1"=>"+5%","bonus2"=>"+10%","bonus3"=>"+15%","bonus4"=>"+20%","bonus5"=>"+30%");    
$os["os10"]=array("name"=>"��������������","opt"=>"speed_MP","descr"=>"���� ����������������� ������� �� ", "nwis"=>20,"bonus1"=>"+5%","bonus2"=>"+10%","bonus3"=>"+15%","bonus4"=>"+20%","bonus5"=>"+25%");    
//$os["os11"]=array("name"=>"�������� ���","opt"=>"speed_debuff","descr"=>"�� ����� ��� ����� �������� ���������� �������� ����� �� ��������� ", "nlevel"=>5,"bonus1"=>"10% �� ����������","bonus2"=>"20% �� ����������","bonus3"=>"30% �� ����������","bonus4"=>"40% �� ����������","bonus5"=>"50% �� ����������");
?>
	<? echo $u->microLogin($u->info['id'],1);?>
	&nbsp; &nbsp;
<TD valign=top align=right>
<INPUT TYPE=button class="btnnew" style="font-size: 13px; padding-top:3px; padding-bottom: 3px;" value='��������' onclick='location="main.php?skills=1&rz="+newrz+"&all=<?=$_GET['all'];?>&rnd=<? echo $code; ?>"'>
<INPUT TYPE=button class="btnnew" style="font-size: 13px; padding-top:3px; padding-bottom: 3px;" value="���������" onClick="location.href='main.php'"></div>
</TABLE>
<TABLE border=0 cellspacing=0 cellpadding=0 width=100%>
<TD width=30% valign=top>
<TABLE border=0 cellspacing=1 cellpadding=0 width=100%>
<TR>
<TD height="25" class=tzS>�������������� ���������</TD>
<TR><TD style='padding-left: 5'>
<STYLE> 
IMG.skill{width:9px;height:9px;cursor:pointer}
TD.skill{font-weight:bold}
TD.skills{font-weight:bold;color:#600000}
TD.skillb{font-weight:bold;color:#006000}
.linestl1 {
	background-color: #E2E0E0;
	font-size: 10px;
	font-weight: bold;
}
</STYLE>

<TABLE cellSpacing=0>
<TR id="str" onMouseDown="ChangeSkill(event,this)" onMouseUp="DropTimer()" onClick="OnClick(event,this);">
<TD>&bull; ����: </TD>
<TD width=40 class="skill" align="right" wdth=30><?=$u->stats['s1']?></TD>
<TD width=60 noWrap><?=$str?></TD>
<?if ($u->info['ability']>0){?><TD><IMG id="minus_str" SRC=http://img.likebk.com/i/minus.gif class="nonactive" ALT="���������">&nbsp;<IMG SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������" id="plus_str"></TD><?}?>
</TR>
<TR id="dex" onMouseDown="ChangeSkill( event, this )" onMouseUp="DropTimer()"  onclick="OnClick(event,this);">
<TD>&bull; ��������: </TD>
<TD width=40 class="skill" align="right" wdth=30><?=$u->stats['s2']?><BR></small></TD>
<TD width=60 noWrap><?=$dex?></TD>
<?if ($u->info['ability']>0){?><TD><IMG id="minus_dex" SRC=http://img.likebk.com/i/minus.gif class="nonactive" ALT="���������">&nbsp;<IMG SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������" id="plus_dex"></TD><?}?>
</TR>
<TR id="inst" onMouseDown="ChangeSkill( event, this )" onMouseUp="DropTimer()"  onclick="OnClick(event,this);">
<TD>&bull; ��������: </TD>
<TD width=40 class="skill" align="right" wdth=30><?=$u->stats['s3']?><BR></small></TD>
<TD width=60 noWrap><?=$inst?></TD>
<?if ($u->info['ability']>0){?><TD><IMG id="minus_inst" SRC=http://img.likebk.com/i/minus.gif class="nonactive" ALT="���������">&nbsp;<IMG SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������" id="plus_inst"></TD><?}?>
</TR>
<TR id="power" onMouseDown="ChangeSkill( event, this )" onMouseUp="DropTimer()"  onclick="OnClick(event,this);">
<TD>&bull; ������������: </TD>
<TD width=40 class="skill" align="right" wdth=30><?=$u->stats['s4']?><BR></small></TD>
<TD width=60 noWrap></TD>
<?if ($u->info['ability']>0){?><TD><IMG id="minus_power" SRC=http://img.likebk.com/i/minus.gif class="nonactive" ALT="���������">&nbsp;<IMG SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������"  id="plus_power"></TD><?}?>
</TR>
<?if ($u->info['level'] > 3) {?>
<TR id="intel" onMouseDown="ChangeSkill( event, this )" onMouseUp="DropTimer()"  onclick="OnClick(event,this);">
<TD>&bull; ���������: </TD>
<TD width=40 class="skill" align="right" wdth=30><?=$u->stats['s5']?></TD>
<TD width=60 noWrap><?=$intel?></TD>
<?if ($u->info['ability']>0){?><TD><IMG id="minus_intel" SRC=http://img.likebk.com/i/minus.gif class="nonactive" ALT="���������">&nbsp;<IMG SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������"  id="plus_intel"></TD><?}?>
</TR>
<?}if ($u->info['level'] > 6) {?>
<TR id="wis" onMouseDown="ChangeSkill( event, this )" onMouseUp="DropTimer()"  onclick="OnClick(event,this);">
<TD>&bull; ��������: </TD>
<TD width=40 class="skill" align="right" wdth=30><?=$u->stats['s6']?></TD>
<TD width=60 noWrap></TD>
<?if ($u->info['ability']>0){?><TD><IMG id="minus_wis" SRC=http://img.likebk.com/i/minus.gif class="nonactive" ALT="���������">&nbsp;<IMG SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������"  id="plus_wis"></TD><?}?>
</TR>
<?}if ($u->info['level'] > 9) {?>
<TR id="spirit" onMouseDown="ChangeSkill( event, this )" onMouseUp="DropTimer()"  onclick="OnClick(event,this);">
<TD>&bull; ����������: </TD>
<TD width=40 class="skill" align="right" wdth=30><?=$u->stats['s7']?></TD>
<TD width=60 noWrap></TD>
<?if ($u->info['ability']>0){?><TD><IMG id="minus_spirit" SRC=http://img.likebk.com/i/minus.gif class="nonactive" ALT="���������">&nbsp;<IMG SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������"  id="plus_spirit"></TD><?}?>
</TR>
<?}if ($u->info['level'] > 12) {?>
<TR id="will" onMouseDown="ChangeSkill( event, this )" onMouseUp="DropTimer()"  onclick="OnClick(event,this);">
<TD>&bull; ����: </TD>
<TD width=40 class="skill" align="right" wdth=30><?=$u->stats['s8']?></TD>
<TD width=60 noWrap></TD>
<?if ($u->info['ability']>0){?><TD><IMG id="minus_will" SRC=http://img.likebk.com/i/minus.gif class="nonactive" ALT="���������">&nbsp;<IMG SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������"  id="plus_will"></TD><?}?>
</TR>
<?}if ($u->info['level'] > 15) {?>
<TR id="freedom" onMouseDown="ChangeSkill( event, this )" onMouseUp="DropTimer()"  onclick="OnClick(event,this);">
<TD>&bull; ������� ����: </TD>
<TD width=40 class="skill" align="right" wdth=30><?=$u->stats['s9']?></TD>
<TD width=60 noWrap></TD>
<?if ($u->info['ability']>0){?><TD><IMG id="minus_freedom" SRC=http://img.likebk.com/i/minus.gif class="nonactive" ALT="���������">&nbsp;<IMG SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������"  id="plus_freedom"></TD><?}?>
</TR>
<?}if ($u->info['level'] > 18) {?>
<TR id="god" onMouseDown="ChangeSkill( event, this )" onMouseUp="DropTimer()"  onclick="OnClick(event,this);">
<TD>&bull; ��������������: </TD>
<TD width=40 class="skill" align="right" wdth=30><?=$u->stats['s10']?></TD>
<TD width=60 noWrap></TD>
<?if ($u->info['ability']>0){?><TD><IMG id="minus_god" SRC=http://img.likebk.com/i/minus.gif class="nonactive" ALT="���������">&nbsp;<IMG SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������"  id="plus_god"></TD><?}?>
</TR>
<?}?>
<?
/*<TR id="energy" onMouseDown="ChangeSkill( event, this )" onMouseUp="DropTimer()"  onclick="OnClick(event,this);">
<TD>&bull; �������: </TD>
<TD width=40 class="skill" align="right" wdth=30><?=$u->stats['s11']?></TD>
<TD width=60 noWrap></TD>
*/
?>
<?
/*
if ($u->info['ability']>0){?><TD><IMG id="minus_energy" SRC=http://img.likebk.com/i/minus.gif class="nonactive" ALT="���������">&nbsp;<IMG SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������"  id="plus_energy"></TD><?
} */?>
</TR>
</TABLE>
<INPUT type="button" class="btnnew" style="font-size: 13px; padding-top:3px; padding-bottom: 3px;" value="���������" disabled id="save_button0" onClick="SaveSkill()">
<INPUT type="checkbox" onClick="ChangeButtonState(0)">
<BR><BR>
<FONT COLOR=green>
<? if($u->info['ability']>0){?>&nbsp;��������� ����������: <SPAN id=UP><?=$u->info['ability']?></SPAN><BR><?}?>

<? if($u->info['skills']>0){?>&nbsp;��������� ������: <SPAN id=m_UP><?=$u->info['skills']?></SPAN><BR><?}?>

<? if($u->info['sskills']>0){?>&nbsp;��������� ������������: <SPAN id=m_UP><?=$u->info['sskills']?></SPAN><BR><?}?>
</FONT>
<Br>
<b>����������� ����������� ����� �������:</b><br>
- <b>��������</b> (<b>������ � ������</b>): 95% ����.<br>
- <b>�������</b> (<b>����</b>): 45% ���� � 45% ��������.<br>
- <b>�������</b> (<b>���� � �������</b>): 45% ���� � 55% ��������.<br>
- <b>�������</b> (<b>������</b>): 60% ���� 30% �������� � 10% ��������.<br>
<BR><BR>
</FONT>
</TABLE>
<SCRIPT> 
var nUP = <?=$u->info['ability']?>;
var oUP = document.getElementById( "UP" );
var nm_UP = <?=$u->info['skills']?>;
var m_UP = document.getElementById( "m_UP" );
var arrChange = { };
var arrMin = {str: <?=$st['s1']?>, dex: <?=$st['s2']?>, inst: <?=$st['s3']?>, power: <?=$st['s4']?><?if($u->info['level']>3) {?>, intel: <?=$st['s5']?><?}?>
<?if($u->info['level']>6) {?>, wis: <?=$st['s6']?><?}?><?if($u->info['level']>9) {?>, spirit: <?=$st['s7']?><?}?><?if($u->info['level']>12) {?>, will: <?=$st['s8']?><?}?><?if($u->info['level']>15) {?>, freedom: <?=$st['s9']?><?}?><?if($u->info['level']>18) {?>,god: <?=$st['s10']?><?}?>
};
var skillsArr = new Array ();
skillsArr["m_axe"] = <?=$st['a4']?>;
skillsArr["m_molot"] = <?=$st['a3']?>;
skillsArr["m_staff"] = <?=$st['a5']?>;
skillsArr["m_sword"] = <?=$st['a1']?>;
skillsArr["m_tohand"] = <?=$st['a2']?>;
skillsArr["m_magic1"] = <?=$st['mg1']?>;
skillsArr["m_magic2"] = <?=$st['mg2']?>;
skillsArr["m_magic3"] = <?=$st['mg3']?>;
skillsArr["m_magic4"] = <?=$st['mg4']?>;
skillsArr["m_magic5"] = <?=$st['mg5']?>;
skillsArr["m_magic6"] = <?=$st['mg6']?>;
skillsArr["m_magic7"] = <?=$st['mg7']?>;
function SetAllSkills(isOn) {
var arrSkills = new Array("str", "dex", "inst", "power", "intel", "wis", "spirit", "will", "freedom", "god");
for (var i in arrSkills) {
var clname = ( isOn ) ? "skill" : "nonactive";
if( oNode = document.getElementById( "plus_" + arrSkills[i] ) ) oNode.className=clname;
}
}
var t;
function OnClick(eEvent, This) {
DropTimer();
var oNode = eEvent.target || eEvent.srcElement;
if( oNode.nodeName != "IMG" ) return;
var nDelta = ( oNode.nextSibling ) ? -1 : 1;
MakeSkillStep(nDelta, This, 0);
}
function DropTimer() {
if (t) {
clearTimeout(t);
t = 0;
}
}
function ChangeSkill( eEvent, This ) {
var oNode = eEvent.target || eEvent.srcElement;
if( oNode.nodeName != "IMG" ) return;
var nDelta = ( oNode.nextSibling ) ? -1 : 1;
t=setTimeout(function() {MakeSkillStep(nDelta, This, 1)}, 500);
}
function MakeSkillStep(nDelta, This, IsRecurse) {
if ((nUP - nDelta ) < 0) return;
var id = This.id;
if (!arrChange[ id ]) arrChange[ id ] = 0;
if ((arrChange[ id ] + nDelta) < 0 ) {
if (oNode = document.getElementById( "minus_" + id ))
oNode.className = "nonactive";
return;
}
SetAllSkills(( nUP - nDelta ));
arrChange[ id ] += nDelta;
This.cells[ 1 ].innerHTML = parseFloat( This.cells[ 1 ].innerHTML ) + nDelta;
if( oNode = document.getElementById( id + "_inst" ) )
oNode.innerHTML = parseFloat( oNode.innerHTML ) + nDelta;
oUP.innerHTML = nUP -= nDelta;
if ( !arrChange[ id ] ) {
if( oNode = document.getElementById( "minus_" + id ) ) oNode.className = "nonactive";
} else {
if( oNode = document.getElementById( "minus_" + id ) ) oNode.className = "skill";
}
if (IsRecurse) t = setTimeout(function(){MakeSkillStep(nDelta, This, 1)}, 50);
}
function ChangeAbility( id, nDelta, inst) {
IsTimerStarted = 0;
if( ( nm_UP - nDelta ) < 0 ) return;
if( !arrChange[ id ] ) arrChange[ id ] = 0;
if( ( arrChange[ id ] + nDelta ) == 0 )  {
if( oNode = document.getElementById( "minus_" + id ) ) oNode.className = "nonactive";
}
if (nDelta > 0) {
skillsArr[id] = 1;
if( oNode = document.getElementById( "plus_" + id ) ) oNode.className = "nonactive";
}
if( ( arrChange[ id ] + nDelta ) < 0 ) return;
arrChange[ id ] += nDelta;
if( ( nm_UP - nDelta ) == 0 )  {
for (var i in skillsArr) {
if( oNode = document.getElementById( "plus_" + i ) ) oNode.className = "nonactive";
}
}
if( oNode = document.getElementById( id + "_base" ) )
oNode.innerHTML = parseFloat( oNode.innerHTML ) + nDelta;
if( oNode = document.getElementById( id + "_inst" ) )
oNode.innerHTML = parseFloat( oNode.innerHTML ) + nDelta;
m_UP.innerHTML = nm_UP -= nDelta;
if ( nDelta > 0 ) {
prefix = "minus_";
} else {
prefix = "plus_";
skillsArr[id] = 0;
for (var i in skillsArr) {
if (skillsArr[i]==0)  {
if( oNode = document.getElementById( "plus_" + i ) ) oNode.className = "skill";
}
}
}
if( oNode = document.getElementById( prefix + id ) ) oNode.className = "skill";
}
function SaveSkill( This ) {
var sHref = "main.php?skills=1&upr=save&s4i=<?=$u->info['id']?>";
for( var i in arrChange )
if( arrChange[ i ] > 0 )
sHref += "&" + i + "=" + arrChange[ i ];
if (This) {
This.href = sHref;
} else {
document.location = sHref;
}
return true;
}
function SaveAbility(This) {
var sHref = "main.php?skills=1&upr=save&s4i=<?=$u->info['id']?>";
for( var i in arrChange )
if( arrChange[ i ] > 0 )
sHref += "&" + i + "=" + arrChange[ i ];
if (This) {
This.href = sHref;
} else {
document.location = sHref;
}
return true;
}
function ChangeButtonState(bid) {
var button = document.getElementById( "save_button"+bid );
if (button.disabled) {
button.disabled = 0;
} else {
button.disabled = 1;
}
}
</SCRIPT>

<TD width=1 bgcolor=#A0A0A0><SPAN></SPAN></TD>
<TD valign=top>
<TABLE border=0 cellspacing=1 cellpadding=0 width=100%>
<TR>

<TD class=tz id=L1 width=150 height="25" onMouseOver="highl('L1',1)" onMouseOut="highl('L1',0)" onClick="setlevel('L1')">����������</TD>
<? if($u->info['level']>1){ ?>
<TD class=tz id=L3 width=150 onMouseOver="highl('L3',1)" onMouseOut="highl('L3',0)" onClick="setlevel('L3')">�����������</TD>
<? if( $u->info['inTurnir'] == 0 || true == true ) { ?>
<TD>
<TD class=tz id=L4 width=150 onMouseOver="highl('L4',1)" onMouseOut="highl('L4',0)" onClick="setlevel('L4')">������</TD>
<? } ?>
<? } ?>
<TD>
<? if($znn!=''){ ?><TD class=tz id=L7 width=150 onMouseOver="highl('L7',1)" onMouseOut="highl('L7',0)" onClick="setlevel('L7')">������</TD><? } ?>
<TD>
<TD class=tz id=L5 width=150 onMouseOver="highl('L5',1)" onMouseOut="highl('L5',0)" onClick="setlevel('L5')">���������</TD>
 
<TD>
<TD class=tz id=L6 width=150 onMouseOver="highl('L6',1)" onMouseOut="highl('L6',0)" onClick="setlevel('L6')">���������</TD>
<TD class=tz >&nbsp</TD>
</TR>
</TABLE>
<TABLE border=0 cellspacing=1 cellpadding=0 width=100%>
<TD width=100% style='padding-left: 7'>
<div class=dtz ID=dL1>


<table>
<tr><td colspan="4"><b>������:</b></td></tr>

<tr>
<TD>&nbsp;&bull;&nbsp;���������� �������� ������: </TD>
<TD width=40 class="skill" align="right" width=30 id='m_axe_base'><?=$u->stats['a4']?></small><BR></TD>
<TD width=60 noWrap><?=$mec?></TD>
<?if ($u->info['skills']){?>
<TD>
<IMG id="minus_m_axe" SRC=http://img.likebk.com/i/minus.gif class=nonactive ALT="���������" onMouseUp="ChangeAbility('m_axe', -1, <?=$st['a4']?>)">&nbsp;
<IMG id="plus_m_axe" SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������" onMouseUp="ChangeAbility('m_axe', 1, <?=$st['a4']?>)">
</TD>
<?}elseif($u->info['skills']>0){?>
<TD>
<IMG SRC=http://img.likebk.com/i/minus.gif class=nonactive>&nbsp;
<IMG SRC=http://img.likebk.com/i/plus.gif class=nonactive>
</TD>
<?}?>
</tr>


<tr>
<TD>&nbsp;&bull;&nbsp;���������� �������� ��������, ��������: </TD>
<TD width=40 class="skill" align="right" width=30 id='m_molot_base'><?=$u->stats['a3']?></small><BR></TD>
<TD width=60 noWrap><?=$dub?></TD>
<?if ($u->info['skills']){?>
<TD>
<IMG id="minus_m_molot" SRC=http://img.likebk.com/i/minus.gif class=nonactive ALT="���������" onMouseUp="ChangeAbility('m_molot', -1, <?=$st['a3']?>)">&nbsp;
<IMG id="plus_m_molot" SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������" onMouseUp="ChangeAbility('m_molot', 1, <?=$st['a3']?>)">
</TD>
<?}elseif($u->info['skills']>0){?>
<TD>
<IMG SRC=http://img.likebk.com/i/minus.gif class=nonactive>&nbsp;
<IMG SRC=http://img.likebk.com/i/plus.gif class=nonactive>
</TD>
<?}?>
</tr>

<tr>
<TD>&nbsp;&bull;&nbsp;���������� �������� ������, ���������: </TD>
<TD width=40 class="skill" align="right" width=30 id='m_sword_base'><?=$u->stats['a1']?></small><BR></TD>
<TD width=60 noWrap><?=$nj?></TD>
<?if ($u->info['skills']){?>
<TD>
<IMG id="minus_m_sword" SRC=http://img.likebk.com/i/minus.gif class=nonactive ALT="���������" onMouseUp="ChangeAbility('m_sword', -1, <?=$st['a1']?>)">&nbsp;
<IMG id="plus_m_sword" SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������" onMouseUp="ChangeAbility('m_sword', 1, <?=$st['a1']?>)">
</TD>
<?}elseif($u->info['skills']>0){?>
<TD>
<IMG SRC=http://img.likebk.com/i/minus.gif class=nonactive>&nbsp;
<IMG SRC=http://img.likebk.com/i/plus.gif class=nonactive>
</TD>
<?}?>
</tr>

<tr>
<TD>&nbsp;&bull;&nbsp;���������� �������� ��������, ��������: </TD>
<TD width=40 class="skill" align="right" width=30 id='m_tohand_base'><?=$u->stats['a2']?></small><BR></TD>
<TD width=60 noWrap><?=$top?></TD>
<?if ($u->info['skills']){?>
<TD>
<IMG id="minus_m_tohand" SRC=http://img.likebk.com/i/minus.gif class=nonactive ALT="���������" onMouseUp="ChangeAbility('m_tohand', -1, <?=$st['a2']?>)">&nbsp;
<IMG id="plus_m_tohand" SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������" onMouseUp="ChangeAbility('m_tohand', 1, <?=$st['a2']?>)">
</TD>
<?}elseif($u->info['skills']>0){?>
<TD>
<IMG SRC=http://img.likebk.com/i/minus.gif class=nonactive>&nbsp;
<IMG SRC=http://img.likebk.com/i/plus.gif class=nonactive>
</TD>
<?}?>
</tr>

<tr>
<TD>&nbsp;&bull;&nbsp;���������� �������� ����������� ��������: </TD>
<TD width=40 class="skill" align="right" width=30 id='m_staff_base'><?=$u->stats['a5']?></small><BR></TD>
<TD width=60 noWrap><?=$pos?></TD>
<?if ($u->info['skills']){?>
<TD>
<IMG id="minus_m_staff" SRC=http://img.likebk.com/i/minus.gif class=nonactive ALT="���������" onMouseUp="ChangeAbility('m_staff', -1, <?=$st['a5']?>)">&nbsp;
<IMG id="plus_m_staff" SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������" onMouseUp="ChangeAbility('m_staff', 1, <?=$st['a5']?>)">
</TD>
<?}elseif($u->info['skills']>0){?>
<TD>
<IMG SRC=http://img.likebk.com/i/minus.gif class=nonactive>&nbsp;
<IMG SRC=http://img.likebk.com/i/plus.gif class=nonactive>
</TD>
<?}?>
</tr>
<tr><td colspan="4"><b>�����:<b></td></tr>

<tr>
<TD>&nbsp;&bull;&nbsp;���������� �������� ������� ����: </TD>
<TD width=40 class="skill" align="right" width=30 id='m_magic1_base'><?=$u->stats['mg1']?></small><BR></TD>
<TD width=60 noWrap><?=$ogon?></TD>
<?if ($u->info['skills']){?>
<TD>
<IMG id="minus_m_magic1"  SRC=http://img.likebk.com/i/minus.gif class=nonactive ALT="���������" onMouseUp="ChangeAbility('m_magic1', -1, <?=$st['mg1']?>)">&nbsp;
<IMG id="plus_m_magic1"  SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������" onMouseUp="ChangeAbility('m_magic1', 1, <?=$st['mg1']?>)">
</TD>
<?}elseif($u->info['skills']>0){?>
<TD>
<IMG SRC=http://img.likebk.com/i/minus.gif class=nonactive>&nbsp;
<IMG SRC=http://img.likebk.com/i/plus.gif class=nonactive>
</TD>
<?}?>
</tr>

<tr>
<TD>&nbsp;&bull;&nbsp;���������� �������� ������� �������: </TD>
<TD width=40 class="skill" align="right" width=30 id='m_magic2_base'><?=$u->stats['mg2']?></small><BR></TD>
<TD width=60 noWrap><?=$voda?></TD>
<?if ($u->info['skills']){?>
<TD>
<IMG id="minus_m_magic2"  SRC=http://img.likebk.com/i/minus.gif class=nonactive ALT="���������" onMouseUp="ChangeAbility('m_magic2', -1, <?=$st['mg2']?>)">&nbsp;
<IMG id="plus_m_magic2"  SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������" onMouseUp="ChangeAbility('m_magic2', 1, <?=$st['mg2']?>)">
</TD>
<? }elseif($u->info['skills']>0){?>
<TD>
<IMG SRC=http://img.likebk.com/i/minus.gif class=nonactive>&nbsp;
<IMG SRC=http://img.likebk.com/i/plus.gif class=nonactive>
</TD>
<? } ?>
</tr>

<tr>
<TD>&nbsp;&bull;&nbsp;���������� �������� ������� ����: </TD>
<TD width=40 class="skill" align="right" width=30 id='m_magic3_base'><?=$u->stats['mg3']?></small><BR></TD>
<TD width=60 noWrap><?=$vozduh?></TD>
<? if ($u->info['skills']){?>
<TD>
<IMG id="minus_m_magic3"  SRC=http://img.likebk.com/i/minus.gif class=nonactive ALT="���������" onMouseUp="ChangeAbility('m_magic3', -1, <?=$st['mg3']?>)">&nbsp;
<IMG id="plus_m_magic3"  SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������" onMouseUp="ChangeAbility('m_magic3', 1, <?=$st['mg3']?>)">
</TD>
<? }elseif($u->info['skills']>0){?>
<TD>
<IMG SRC=http://img.likebk.com/i/minus.gif class=nonactive>&nbsp;
<IMG SRC=http://img.likebk.com/i/plus.gif class=nonactive>
</TD>
<? } ?>
</tr>

<tr>
<TD>&nbsp;&bull;&nbsp;���������� �������� ������� �����: </TD>
<TD width=40 class="skill" align="right" width=30 id='m_magic4_base'><?=$u->stats['mg4']?></small><BR></TD>
<TD width=60 noWrap><?=$zemla?></TD>
<?if ($u->info['skills']){?>
<TD>
<IMG id="minus_m_magic4"  SRC=http://img.likebk.com/i/minus.gif class=nonactive ALT="���������" onMouseUp="ChangeAbility('m_magic4', -1, <?=$st['mg4']?>)">&nbsp;
<IMG id="plus_m_magic4"  SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������" onMouseUp="ChangeAbility('m_magic4', 1, <?=$st['mg4']?>)">
</TD>
<?}elseif($u->info['skills']>0){?>
<TD>
<IMG SRC=http://img.likebk.com/i/minus.gif class=nonactive>&nbsp;
<IMG SRC=http://img.likebk.com/i/plus.gif class=nonactive>
</TD>
<?}?>
</tr>

<tr>
<TD>&nbsp;&bull;&nbsp;���������� �������� ������ �����: </TD>
<TD width=40 class="skill" align="right" width=30 id='m_magic5_base'><?=$u->stats['mg5']?></small><BR></TD>
<TD width=60 noWrap><?=$svet?></TD>
<?if ($u->info['skills']){?>
<TD>
<IMG id="minus_m_magic5"  SRC=http://img.likebk.com/i/minus.gif class=nonactive ALT="���������" onMouseUp="ChangeAbility('m_magic5', -1, <?=$st['mg5']?>)">&nbsp;
<IMG id="plus_m_magic5"  SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������" onMouseUp="ChangeAbility('m_magic5', 1, <?=$st['mg5']?>)">
</TD>
<?}elseif($u->info['skills']>0){?>
<TD>
<IMG SRC=http://img.likebk.com/i/minus.gif class=nonactive>&nbsp;
<IMG SRC=http://img.likebk.com/i/plus.gif class=nonactive>
</TD>
<?}?>
</tr>

<tr>
<TD>&nbsp;&bull;&nbsp;���������� �������� ������ ����: </TD>
<TD width=40 class="skill" align="right" width=30 id='m_magic6_base'><?=$u->stats['mg6']?></small><BR></TD>
<TD width=60 noWrap><?=$seraya?></TD>
<? if($u->info['skills']){ ?>
<TD>
<IMG id="minus_m_magic6"  SRC=http://img.likebk.com/i/minus.gif class=nonactive ALT="���������" onMouseUp="ChangeAbility('m_magic6', -1, <?=$st['mg6']?>)">&nbsp;
<IMG id="plus_m_magic6"  SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������" onMouseUp="ChangeAbility('m_magic6', 1, <?=$st['mg6']?>)">
</TD>
<? }elseif($u->info['skills']>0){?>
<TD>
<IMG SRC=http://img.likebk.com/i/minus.gif class=nonactive>&nbsp;
<IMG SRC=http://img.likebk.com/i/plus.gif class=nonactive>
</TD>
<? }?>
</tr>

<tr>
<TD>&nbsp;&bull;&nbsp;���������� �������� ����� ������: </TD>
<TD width=40 class="skill" align="right" width=30 id='m_magic7_base'><?=$u->stats['mg7']?></small><BR></TD>
<TD width=60 noWrap><?=$tma?></TD>
<? if ($u->info['skills']){ ?>
<TD>
<IMG id="minus_m_magic7"  SRC=http://img.likebk.com/i/minus.gif class=nonactive ALT="���������" onMouseUp="ChangeAbility('m_magic7', -1, <?=$st['mg7']?>)">&nbsp;
<IMG id="plus_m_magic7"  SRC=http://img.likebk.com/i/plus.gif class=skill ALT="���������" onMouseUp="ChangeAbility('m_magic7', 1, <?=$st['mg7']?>)">
</TD>
<? }elseif($u->info['skills']>0){?>
<TD>
<IMG SRC=http://img.likebk.com/i/minus.gif class=nonactive>&nbsp;
<IMG SRC=http://img.likebk.com/i/plus.gif class=nonactive>
</TD>
<? } ?>
</tr>
</table>
<TABLE>
<TR valign="middle">
<TD><INPUT type="button" class="btnnew" style="font-size: 13px; padding-top:3px; padding-bottom: 3px;" value="���������" disabled id="save_button1" onClick="SaveAbility()"></TD>
<TD><INPUT type="checkbox" onClick="ChangeButtonState(1)"></TD>
</TR>
</TABLE>

</div>
<div class=dtz ID=dL2>
<BR>
� ���� ������ ���� ������� ;)
</div>
<div class=dtz ID=dL3>
<?
/*---�����������---*/
		foreach ($os as $k=>$v) {
			$good=1;
			if ($v["nlevel"] && $v["nlevel"]+$st[$k]>$u->info["level"]) $good=0;
			if ($v["npower"] && $v["npower"]+($st[$k]*5)>$st['s4']) $good=0;
			if ($v["nwis"] && $v["nwis"]+($st[$k]*5)>$st['s6']) $good=0; 
			if ($good) {
				if ($st[$k]<5) echo "<BR>&bull; <A href=\"?skills=1&rz=3&".$v['opt']."=1\" onclick=\"return confirm('�� �������, ��� ������ ������� ����������� &quot;".$v['name']."&quot;?')\">".$v['name']."".($st[$k]>0?" - ".($st[$k]+1):"")."</A><BR>
				<SMALL>".$v['descr']." ".$v["bonus".($st[$k]+1)]."</SMALL><BR>";
			}
		}
	echo "<br>";
	echo "
    <b>��������� �����������:</b><br>";
	foreach ($os as $k=>$v) {
		if ($st[$k]) echo "&bull; ".$v['name']." ".($st[$k]>1?" - ".$st[$k]."":"")."<br>";
	}
/*---�����������---*/
?>
</div>
<div class="dtz" ID=dL4>
<script type="text/javascript" src="js/jquery.js"></script>
<SCRIPT>
var p_name;

function redirectto (s) {
	location = s;
}

function show_div(o) {
	$('.pwqall').css({'display':'none'});
	$('.pwq'+o).css({'display':''});
}

</SCRIPT>
<table border=0 cellspacing=0 width="100%" cellpadding=0 ><tr valign="top">
  <td valign="top" width="100%">
<?
if(isset($_GET['savePriems'])) {
	$_GET['savePriems'] = htmlspecialchars(substr($_GET['savePriems'],0,11),NULL,'cp1251');
	$sp = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `complects_priem` WHERE `uid` = "'.$u->info['id'].'" LIMIT 16'));
	if($sp[0] >= 15) {
		$re = '������ ��������� ����� 15 ���������� �������';
	}elseif(str_replace(' ','',$_GET['savePriems']) != '') {
		$cmpl = mysql_fetch_array(mysql_query('SELECT `id` FROM `complects_priem` WHERE `uid` = "'.$u->info['id'].'" AND `name` = "'.mysql_real_escape_string($_GET['savePriems']).'" LIMIT 1'));
		if(isset($cmpl['id'])) { 
			$re = '������ ����������� �������� ������� "'.$_GET['savePriems'].'"';
			mysql_query('UPDATE `complects_priem` SET `priems` = "'.$u->info['priems'].'" WHERE `id` = "'.$cmpl['id'].'" LIMIT 1');
		}else{
			$re = '������ ������ �������� ������� "'.$_GET['savePriems'].'"';
			mysql_query('INSERT INTO `complects_priem` (`priems`,`uid`,`name`) VALUES ("'.$u->info['priems'].'","'.$u->info['id'].'","'.mysql_real_escape_string($_GET['savePriems']).'")');
		}
	}else{
		$re = '�� ������� �������� ���������';
	}
	if($re != '') {
		echo '<br>&nbsp; <font color="red"><b>'.$re.'</b></font><br><br>';
	}
}
?>
<B>��������� ������:</B><BR>
<?
//������� ������
$priem->seeMy(1);
?><br>
<B>����� ��� ������:</B>
<TABLE cellpadding=0 cellspacing=0><TR><TD>
<div style="">
<?
$priem->seePriems(1);
?>
</div>
</div>
</TD></TR></TABLE></DIV></td><td valign="top" align=right width=1>

<FIELDSET><LEGEND>���������</LEGEND><SMALL><NOBR>
<A href="#" onclick='show_div("all"); return(false)'>���</A>
               <BR>
<A href="#" onclick='show_div("hit"); return(false)'>������ �����</A>
               <BR>
<A href="#" onclick='show_div("block"); return(false)'>������ ������</A>
               <BR>
<A href="#" onclick='show_div("counter"); return(false)'>������ �����������</A>
               <BR>
<A href="#" onclick='show_div("krit"); return(false)'>������ ����������� ������</A>
               <BR>
<A href="#" onclick='show_div("parry"); return(false)'>������ �����������</A>
               <BR>
<A href="#" onclick='show_div("multi"); return(false)'>�����-������</A>
               <BR>
<A href="#" onclick='show_div("hp"); return(false)'>������ �����</A>
               <BR>
<A href="#" onclick='show_div("blood"); return(false)'>������ ������</A>
               <BR>
<A href="#" onclick='show_div("spirit"); return(false)'>������ ���� ����</A>
               <BR>
<A href="#" onclick='show_div("wis_fire"); return(false)'>���������� ����</A>
               <BR>
<A href="#" onclick='show_div("wis_water"); return(false)'>���������� ����</A>
               <BR>
<A href="#" onclick='show_div("wis_air"); return(false)'>���������� �������</A>
               <BR>
<A href="#" onclick='show_div("wis_earth"); return(false)'>���������� �����</A>
               <BR>
<A href="#" onclick='show_div("wis_light"); return(false)'>���������� ����� �����</A>
               <BR>
<A href="#" onclick='show_div("wis_gray"); return(false)'>���������� ����� �����</A>
               <BR>
<A href="#" onclick='show_div("wis_dark"); return(false)'>���������� ����� ����</A><BR></FIELDSET></NOBR></SMALL>
<SCRIPT>show_div("all");</SCRIPT></td><td valign="top" align="right">
<table width="200" align=right cellpadding=0 cellspacing=0><tr>
<form name=F1 action="?skills=1&rz=4" method="GET">
<input type="hidden" name="skills" value="1">
<input type="hidden" name="rz" value="4">
<td>
<FIELDSET><LEGEND>���������� �����</LEGEND>

&nbsp;<INPUT TYPE=radio ID=A1 NAME=all value=0 <? if($_GET['all'] == 0) { echo 'checked="checked"'; } ?> onClick="form.submit()"> <LABEL FOR=A1>��������� ���</LABEL><BR>
&nbsp;<INPUT TYPE=radio ID=A2 NAME=all value=1 <? if($_GET['all'] == 1) { echo 'checked="checked"'; } ?> onClick="form.submit()"> <LABEL FOR=A2>���</LABEL>

</FIELDSET>
<BR>
<a style='font-size:10px' href="/main.php?skills=1&rz=4&all=<?=$_GET['all']?>&clear_abil=1">��������</A>
               <BR>
<A style='font-size:10px' href="javascript:void(0)" onClick="top.savePriems();">��������� �����</a><br>
<p style="margin-left: 10px; font-size:10px;" align="left">
<?
$sp = mysql_query('SELECT * FROM `complects_priem` WHERE `uid` = "'.$u->info['id'].'" LIMIT 10');
while($pl = mysql_fetch_array($sp)) {
	echo '<a onclick="if(confirm(\'������� �����  ?\')){location=\'main.php?skills=1&rz=4&all=&rnd='.$code.'&delcop='.$pl['id'].'\'}" href="javascript:void(0)"><img src="http://'.$c['img'].'/i/clear.gif" width="13" height="13"></a> <a href="?skills=1&rz=4&all=&rnd='.$code.'&usecopr='.$pl['id'].'">������������ &quot;'.$pl['name'].'&quot;</a><br>';
}
?>
</p>

</td>
</form>
</tr></table>

</td><td>&nbsp;</td>
</tr></table>
</div>
<div class="dtz" ID=dL5>
<div style="margin:5px;">
<SMALL>
</SMALL>
<?
//D5D5D5 , C7C7C7
//�������� � �������
$clr = 'D5';
$ae = '';

//�������
$i = 0;
while($i<count($u->stats['effects']))
{
	if(isset($u->stats['effects'][$i]))
	{
		if($clr=='C7')
		{
			$clr = 'D5';
		}else{
			$clr = 'C7';	
		}
		$v1 = '';
		$v2 = '';
		$v3 = $u->lookStats($u->stats['effects'][$i]['data']);
		//<FONT color=#A00000>-??</FONT>
		$j = 0;
		while($j<count($u->items['add']))
		{
			if(isset($v3['add_'.$u->items['add'][$j]]))
			{
				$v1 .= '&nbsp;&bull; '.$u->is[$u->items['add'][$j]].'<br>';
				$v4 = $v3['add_'.$u->items['add'][$j]];
				if($v4>0)
				{
					$v4 = '+'.$v4;
				}elseif($v4<0)
				{
					$v4 = '<FONT color=#A00000>'.$v4.'</FONT>';
				}
				$v2 .= $v4.'<br>';
			}
			$j++;
		}
		if($v1=='')
		{
			$v1 = '??';	
		}
		if($v2=='')
		{
			$v2 = '??';
		}
		$ae .= '<TR bgcolor=#'.$clr.$clr.$clr.'>
		<TD>'.$v1.'</TD>
		<TD align=right>'.$v2.'</TD>
		<TD style=\'padding: 1,5,1,5\' align=right>'.$u->timeOut($u->stats['effects'][$i]['timeUse']+$u->stats['effects'][$i]['actionTime']-time()).'</TD>
		<TD style=\'padding: 1,5,1,5\' align=right><small>&quot;'.$u->stats['effects'][$i]['name'].'&quot;</small></TD>
	</TR>';
	}
	$i++;
}

//����� �� ������
$efs = mysql_query('SELECT * FROM `users_ico` WHERE `uid`="'.mysql_real_escape_string($u->info['id']).'" AND (`endTime` > "'.time().'" OR `endTime` = 0)');
while($e = mysql_fetch_array($efs)) {
		if($clr=='C7')
		{
			$clr = 'D5';
		}else{
			$clr = 'C7';	
		}
		$v1 = '';
		$v2 = '';
		$v3 = $u->lookStats($e['bonus']);
		//<FONT color=#A00000>-??</FONT>
		$j = 0;
		while($j<count($u->items['add']))
		{
			if(isset($v3['add_'.$u->items['add'][$j]]))
			{
				$v1 .= '&nbsp;&bull; '.$u->is[$u->items['add'][$j]].'<br>';
				$v4 = $v3['add_'.$u->items['add'][$j]];
				if($v4>0)
				{
					$v4 = '+'.$v4;
				}elseif($v4<0)
				{
					$v4 = '<FONT color=#A00000>'.$v4.'</FONT>';
				}
				$v2 .= $v4.'<br>';
			}
			$j++;
		}
		if($v1=='')
		{
			$v1 = '??';	
		}
		if($v2=='')
		{
			$v2 = '??';
		}
		$ae .= '<TR bgcolor=#'.$clr.$clr.$clr.'>
		<TD>'.$v1.'</TD>
		<TD align=right>'.$v2.'</TD>
		<TD style=\'padding: 1,5,1,5\' align=right>'.$u->timeOut($e['endTime']-time()).'</TD>
		<TD style=\'padding: 1,5,1,5\' align=right><small><img ';
		if( $e['type'] == 2 ) {
			$ae .= 'width="30" style="float:left"';
		}
		$ae .= ' src="http://img.likebk.com/'.$e['img'].'"> &quot;'.$e['text'].'&quot;</small></TD>
	</TR>';
}


if($ae!='')
{
?>
<TABLE border="0" cellpadding=3 cellspacing=1>
<TR bgcolor=#A5A5A5>
	<TD><B>��������������</B></TD>
    <TD align=right><B>��.</B></TD>
    <TD align=right><B>�����</B></TD>
    <TD align=right ><B>�����������</B></TD>
</TR>
<?
echo $ae;	
?>
</TABLE>
<br>
<?
}

$ae = '';

$sp = mysql_query('SELECT * FROM `eff_users` WHERE `v1` LIKE "pgb%" AND `delete` = "0" AND `deactiveTime` > '.time().' AND `uid` = "'.$u->info['id'].'" ORDER BY `timeUse` DESC');
while($pl = mysql_fetch_array($sp)) {
	$tp = (int)str_replace('pgb','',$pl['v1']);
	$lvlp = explode('[',$pl['name']); 
	$lvlp = explode(']',$lvlp[1]);
	$lvlp = $lvlp[0]; 
	$v = $magic->pgpar[$tp];
	//$ae .= '&bull; '.$v[0].' ['.$lvlp.'], ��� '.$u->timeOut($pl['timeUse']-time()).', ������ ����������� ����� '.$u->timeOut($pl['deactiveTime']-time()).'<br>';
}

if($ae != '') {
	//echo '<br><b>�����������:</b><br>'.$ae.'<br><br>';
}

/* ������ ����� */
if($u->info['fnq'] < 38) {
	//���������� ������ ��� ������
	include('_incl_data/class/noob_quest_txt.php');	
	if($txt != '') {
		echo '<fieldset style="padding:10px">
  <legend><b>��������</b></legend>
  '.$txt.'
</fieldset><br>';
	}
}

$html = '';
$test1 = mysql_fetch_array(mysql_query('SELECT * FROM `align_time` WHERE `uid` = "'.$u->info['id'].'" AND `align` > 0 AND `time` > "'.(time()-86400*7).'" LIMIT 1'));
$test2 = mysql_fetch_array(mysql_query('SELECT * FROM `align_time` WHERE `uid` = "'.$u->info['id'].'" AND `clan` > 0 AND `time` > "'.(time()-86400*3).'" LIMIT 1'));

if(isset($test1['id'])) {
	$dalign = array(
		1 => '<img src="http://img.likebk.com/i/align/align1.gif"> �������',
		3 => '<img src="http://img.likebk.com/i/align/align3.gif"> ������',
		7 => '<img src="http://img.likebk.com/i/align/align7.gif"> �����������'
	);
	$html .= '<div>&nbsp;&nbsp; &bull; �������� �� ����� ���������� ��� '.$u->timeOut($test1['time']+86400*7-time()).' (��������� ����������: '.$dalign[$test1['align']].')</div>';
}

if(isset($test2['id'])) {
	$dalign = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$test2['clan'].'" LIMIT 1'));
	if(isset($dalign['id'])) {
		$dalign = '<img src="http://img.likebk.com/i/clan/'.$dalign['id'].'.gif"> '.$dalign['name'].'';
	}else{
		$dalign = '<i>����������� ����</i>';
	}
	$html .= '<div>&nbsp;&nbsp; &bull; �������� �� ����� ����� ��� '.$u->timeOut($test1['time']+86400*3-time()).' (��������� ����: '.$dalign.')</div>';
}

if($html != '') {
	echo '&nbsp;<b>��������:</b><br>'.$html.'<br><br>';
}
unset($html);

?>
&nbsp;<b>�������:</b>
<br>
<?
/* ������ ������ */
$b = array();
$st = array();
	//������ ������
		//����
			if($u->stats['s1']>24 && $u->stats['s1']<50){ $st[1]['m10']  += 5;  }
			if($u->stats['s1']>49 && $u->stats['s1']<75){ $st[1]['m10']  += 10; }
			if($u->stats['s1']>74 && $u->stats['s1']<100){ $st[1]['m10']  += 17; }
			if($u->stats['s1']>99 && $u->stats['s1']<125){ $st[1]['m10']  += 25; }
			if($u->stats['s1']>124 && $u->stats['s1']<150){ $st[1]['m10'] += 25; $st[1]['minAtack'] += 10; $st[1]['maxAtack'] += 10; }
			if($u->stats['s1']>149 && $u->stats['s1']<175){ $st[1]['m10'] += 30; $st[1]['minAtack'] += 10; $st[1]['maxAtack'] += 10; }
			if($u->stats['s1']>174){ $st[1]['m10'] += 30; $st[1]['minAtack'] += 15; $st[1]['maxAtack'] += 15; }
		//��������
			if($u->stats['s2']>24 && $u->stats['s2']<50){ $st[2]['m7']  += 5;  }
			if($u->stats['s2']>49 && $u->stats['s2']<75){ $st[2]['m7']  += 5; $st[2]['m4']  += 35; $st[2]['m2']  += 15; }
			if($u->stats['s2']>74 && $u->stats['s2']<100){ $st[2]['m7']  += 15; $st[2]['m4']  += 35; $st[2]['m2']  += 15; }
			if($u->stats['s2']>99 && $u->stats['s2']<125){ $st[2]['m7']  += 15; $st[2]['m4']  += 105; $st[2]['m2']  += 40; }
			if($u->stats['s2']>124 && $u->stats['s2']<150){ $st[2]['m7']  += 15; $st[2]['m4']  += 105; $st[2]['m2']  += 40; $st[2]['m15'] += 5; }
			if($u->stats['s2']>149 && $u->stats['s2']<175){ $st[2]['m7']  += 20; $st[2]['m4']  += 115; $st[2]['m2']  += 40; $st[2]['m15'] += 5; }
			if($u->stats['s2']>174){ $st[2]['m7']  += 20; $st[2]['m4']  += 120; $st[2]['m2']  += 50; $st[2]['m15'] += 7; }
		//��������
			if($u->stats['s3']>24 && $u->stats['s3']<50){ $st[3]['m3'] += 10; }
			if($u->stats['s3']>49 && $u->stats['s3']<75){ $st[3]['m3'] += 10; $st[3]['m1'] += 35; $st[3]['m5'] += 15; }
			if($u->stats['s3']>74 && $u->stats['s3']<100){ $st[3]['m3'] += 25; $st[3]['m1'] += 35; $st[3]['m5'] += 15; }
			if($u->stats['s3']>99 && $u->stats['s3']<125){ $st[3]['m3'] += 25; $st[3]['m1'] += 105; $st[3]['m5'] += 45; }
			if($u->stats['s3']>124 && $u->stats['s3']<150){ $st[3]['m3'] += 25; $st[3]['m1'] += 105; $st[3]['m5'] += 45; $st[3]['m14'] += 5; }
			if($u->stats['s3']>149 && $u->stats['s3']<175){ $st[3]['m3'] += 30; $st[3]['m1'] += 105; $st[3]['m5'] += 45; $st[3]['m14'] += 5; }
			if($u->stats['s3']>174){ $st[3]['m3'] += 30; $st[3]['m1'] += 120; $st[3]['m5'] += 45; $st[3]['m14'] += 7; }
		//������������
			if($u->stats['s4']>0){ $st[5]['hpAll']   += 30;  }
			if($u->stats['s4']>24 && $u->stats['s4']<50){ $st[4]['hpAll']  += 50;  }
			if($u->stats['s4']>49 && $u->stats['s4']<75){ $st[4]['hpAll']  += 100; }
			if($u->stats['s4']>74 && $u->stats['s4']<100){ $st[4]['hpAll']  += 175; }
			if($u->stats['s4']>99 && $u->stats['s4']<125){ $st[4]['hpAll']  += 250; }
			if($u->stats['s4']>124 && $u->stats['s4']<150){ $st[4]['hpAll'] += 250; $st[4]['za'] += 25; }
			if($u->stats['s4']>149 && $u->stats['s4']<175){ $st[4]['hpAll'] += 350; $st[4]['za'] += 50;}
			if($u->stats['s4']>174){ $st[4]['hpAll'] += 400; $st[4]['za'] += 100;}
		//��������
			if($u->stats['s5']>24 && $u->stats['s5']<50){ $st[6]['m11'] += 5; }
			if($u->stats['s5']>49 && $u->stats['s5']<75){ $st[6]['m11'] += 10;  }
			if($u->stats['s5']>74 && $u->stats['s5']<100){ $st[6]['m11'] += 17; }
			if($u->stats['s5']>99 && $u->stats['s5']<125){ $st[6]['m11'] += 25; }
			if($u->stats['s5']>124 && $u->stats['s5']<150){ $st[6]['m11'] += 35;  }
			if($u->stats['s5']>149 && $u->stats['s5']<175){ $st[6]['m11'] += 45; }
			if($u->stats['s5']>174){ $st[6]['m11'] += 60; }
		//��������
			if($u->stats['s6']>24 && $u->stats['s6']<50){ $st[7]['mpAll'] += 50; $st[7]['speedmp'] += 100;}
			if($u->stats['s6']>49 && $u->stats['s6']<75){ $st[7]['mpAll'] += 100; $st[7]['speedmp'] += 200;}
			if($u->stats['s6']>74 && $u->stats['s6']<100){ $st[7]['mpAll'] += 175; $st[7]['speedmp'] += 350; }
			if($u->stats['s6']>99 && $u->stats['s6']<125){ $st[7]['mpAll'] += 250; $st[7]['speedmp'] += 500; }
			if($u->stats['s6']>124 && $u->stats['s6']<150){ $st[7]['mpAll'] += 250; $st[7]['speedmp'] += 500; $st[7]['pzm'] += 3; }
			if($u->stats['s6']>149 && $u->stats['s6']<175){ $st[7]['mpAll'] += 300; $st[7]['speedmp'] += 600; $st[7]['pzm'] += 3; }
			if($u->stats['s6']>174){ $st[7]['mpAll'] += 350; $st[7]['speedmp'] += 700; $st[7]['pzm'] += 5; }
	//����� �������
	$i = 1;
	while($i<=7)
	{
		if(isset($st[$i]))
		{
			$j = 0;
			while($j<count($u->items['add']))
			{
				if(isset($st[$i][$u->items['add'][$j]]))
				{
					$vr = $st[$i][$u->items['add'][$j]];
					if($vr>0)
					{
						$vr = '+'.$vr;
					}
					$b[$i] .= '&nbsp;&nbsp;&nbsp;&bull; '.$u->is[$u->items['add'][$j]].': '.$vr.'<br>';
				}
				$j++;
			}
		}
		$i++;
	}
	
	
/* ���������� ��������� */
$coms = array();
$cl = mysql_query('SELECT `im`.`name`,`im`.`2h`,`im`.`id`,`iu`.`data` FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE `iu`.`inOdet`!="0" AND `iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0"');
while($pl = mysql_fetch_array($cl))
{
	$sts = explode('|',$pl['data']);
	$i = 0; $ste = ''; $sti = array();
	while($i<count($sts))
	{
		$ste = explode('=',$sts[$i]);
		if(isset($ste[1]))
		{
			$sti[$ste[0]] += intval($ste[1]);
		}
		$i++;
	}
	if(isset($sti['complect']))
	{
		$coms[count($coms)]['id'] = $sti['complect'];
		if(!isset($coms['com'][$sti['complect']]))
		{
			$coms['com'][$sti['complect']] = 0;	
			$coms['new'][count($coms['new'])] = $sti['complect'];	
		}
		$coms['com'][$sti['complect']]++;
		if($pl['2h']>0) {
			$coms['com'][$sti['complect']]++;
		}
	}	
}

if(count($coms['new']) > 0) {
	$cmss = '';
	$i = 0;
	while($i < count($coms['new'])) {
		if($coms['new'][$i] > 0) {
			$spc = mysql_query('SELECT * FROM `complects` WHERE `com` = "'.$coms['new'][$i].'" AND `x` <= "'.$coms['com'][$coms['new'][$i]].'" ORDER BY `x` DESC LIMIT 1');
			while($plc = mysql_fetch_array($spc)) {
				$cmss .= '&nbsp;&nbsp; &bull; '.$plc['name'].' ';
				if($coms['com'][$coms['new'][$i]] >= $plc['x']) {
					$cmss .= '<font color=green>['.$coms['com'][$coms['new'][$i]].'/'.$plc['x'].']</font>';
				}else{
					$cmss .= '['.$coms['com'][$coms['new'][$i]].'/'.$plc['x'].']';
				}
				$cmss .= '<br>';
				
						$ia = $u->items['add'];
				
						//��������� �������� ���������
						$cmss .= '<small style="color:grey">';
						$ij = 0;
						$sti = $u->lookStats($plc['data']);
						while($ij<count($ia))
						{
							if(isset($ia[$ij]) && isset($sti[$ia[$ij]]))
							{
								//$st[$ia[$ij]] += $sti[$ia[$ij]];
								$mad   = $sti[$ia[$ij]];
								if($mad > 0) {
									$mad = '+'.$mad;
								}
								$cmss .= '&nbsp; &nbsp; &nbsp; &nbsp; &bull; '.$u->is[$ia[$ij]].': '.$mad.'<br>';
							}
							$ij++;
						}
						$cmss .= '</small>';
			}					
		}
		$i++;
	}
	if($cmss != '') {
		echo '&nbsp;&nbsp;&nbsp;<b>��������</b>:<br>'.$cmss.'<br>';
	}
}

/*
if(isset($sti['complect']))
{
	$coms[count($coms)+1]['id'] = $sti['complect'];
	if(!isset($coms['com'][$sti['complect']]))
	{
		$coms['com'][$sti['complect']] = 0;	
	}
	$coms['com'][$sti['complect']]++;
}
//������ ����������
$i = 1;
while($i<=count($coms['com']))
{
	if(isset($coms[$i]))
	{
		//$coms[$i]['id'] - id ���������, $j - ���-�� ��������� ������� ���������
		$j = $coms['com'][$coms[$i]['id']];
		$com = mysql_fetch_array(mysql_query('SELECT * FROM `complects` WHERE `com` = "'.((int)$coms[$i]['id']).'" AND `x` <= '.((int)$j).' ORDER BY  `x` DESC  LIMIT 1'));
		if(isset($com['id']))
		{
			//��������� �������� ���������
			$ij = 0;
			$sti = $this->lookStats($com['data']);
			while($ij<count($ia))
			{
				if(isset($ia[$ij]) && isset($sti[$ia[$ij]]))
				{
					$st[$ia[$ij]] += $sti[$ia[$ij]];
				}
				$ij++;
			}	
		}
	}
	$i++;
}
*/
	
if(isset($b[1]))
{
	echo '&nbsp;&nbsp;&nbsp;<b>���������� ����</b>:<br>'.$b[1].'<br>';
}
if(isset($b[2]))
{
	echo '&nbsp;&nbsp;&nbsp;<b>�������� ������</b>:<br>'.$b[2].'<br>';
}
if(isset($b[3]))
{
	echo '&nbsp;&nbsp;&nbsp;<b>������������</b>:<br>'.$b[3].'<br>';
}
if(isset($b[5]))
{
	echo '&nbsp;&nbsp;&nbsp;<b>������������</b>:<br>'.$b[5].'<br>';
}
if(isset($b[4]))
{
	echo '&nbsp;&nbsp;&nbsp;<b>�������� ����</b>:<br>'.$b[4].'<br>';
}
if(isset($b[6]))
{
	echo '&nbsp;&nbsp;&nbsp;<b>�����</b>:<br>'.$b[6].'<br>';
}
if(isset($b[7]))
{
	echo '&nbsp;&nbsp;&nbsp;<b>���� ��������</b>:<br>'.$b[7].'<br>';
}
?>
</div>
</div>
</div>
<div class=dtz ID=dL6>
<div style="padding:5px;">
<BR>
<?
$qsee = '';
$qx = 0;
$rating = mysql_fetch_array(mysql_query('SELECT * FROM `aaa_reting_list` WHERE `uid` = "'.$u->info['id'].'" ORDER BY `id` DESC LIMIT 1'));
$rating2 = mysql_fetch_array(mysql_query('SELECT * FROM `aaa_reting_list` WHERE `uid` = "'.$u->info['id'].'" AND `id` < "'.$rating['id'].'" ORDER BY `id` DESC LIMIT 1'));
//
$rtns = ($rating['pos']-$rating2['pos']);
if( $rtns == 0) {
	$rtns = '<font color=grey>0</font>';
}elseif( $rtns > 0 ) {
	$rtns = '<img src="http://img.likebk.com/uprt2.png" width="7" height="7"><font color=green>+'.$rtns.'</font>';
}else{
	$rtns = '<img src="http://img.likebk.com/uprt.png" width="7" height="7"><font color=maroon>'.$rtns.'</font>';
}
echo '<b>�������:</b> '.round($rating['global']/(10000+$u->info['level']),2).' <sup>(�����: '.round($rating['global']/(10000+$u->info['level']),2).')</sup><br><b>������� � ����:</b> <a href="http://top.likebk.com/#'.$u->info['id'].'" target="_blank">'.$rating['pos'].'</a> <sup>'.$rtns.'</sup>';


//���������� ������ ������� �������
$sp = mysql_query('SELECT * FROM `actions` WHERE `vars` LIKE "%start_quest%" AND `vals` = "go" AND `uid` = "'.$u->info['id'].'" LIMIT 100');
while($pl = mysql_fetch_array($sp))
{
	$pq = mysql_fetch_array(mysql_query('SELECT * FROM `quests` WHERE `id` = "'.str_replace('start_quest','',$pl['vars']).'" LIMIT 1'));
	$pq['info'] = str_replace('&quot;','"',$pq['info']);
	$pq['info'] = str_replace('&nbsp;',' ',$pq['info']);
	$qsee .= '<a href="main.php?skills=1&rz=6&end_qst_now='.$pq['id'].'"><img src="http://img.likebk.com/i/clear.gif" title="���������� �� �������"></a> <b>'.$pq['name'].'</b><div style="padding-left:15px;padding-bottom:5px;border-bottom:1px solid grey"><small>'.$pq['info'].'<br>'.$q->info($pq).'</small></div><br>';
	$qx++;
}

if($qsee == '')
{
	$qsee = '� ��������� � ��� ��� �� ������ �������';
}else{
	$qsee .= '<small>* � ������� �� ����������� � �������� ������� �������� ������, � ������ ������� ����������� � NPS, ������� � �.�. �������� �������</small>';
}
?>
<FIELDSET>
<LEGEND><B>������� �������: </B>[<?=$qx?>/28]</LEGEND>
<?=$qsee?>
<BR>
</FIELDSET>
<?
/*$psh = mysql_fetch_array(mysql_query('SELECT * FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "psh0" AND `time` > '.(time()-7200).' LIMIT 1'));
if(isset($psh['id']))
{
	if($clr=='C7')
	{
		$clr = 'D5';
	}else{
		$clr = 'C7';	
	}
	echo '<br>&nbsp;<b>����� �� ����������:</b> '.$u->timeOut(($psh['time']+60*60*3)-time()).'<br><br>';
}*/

$pshzd = '';
$pshnames = array(
	1	=> '�����������',
	3	=> '���������',
	10	=> '��������',
	11	=> '���������',
	12	=> '������ ������ ���������',
	13	=> '���� �������',
	20	=> '������� ������',
	101 => '������',
	103	=> '���������',
	102	=> '���������� ��������',
	104	=> '��������'
	
);
$sp = mysql_query('SELECT `vars`,`time`,`id` FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars`LIKE "psh%" AND `time` > '.(time()-10800).' AND `vals` = "" GROUP BY `vars`');
while( $pl = mysql_fetch_array($sp) ) {
	if($clr=='C7')
	{
		$clr = 'D5';
	}else{
		$clr = 'C7';	
	}
	$pshname = '';
	$pshname = $pshnames[str_replace('psh','',$pl['vars'])];
	if( $pshname == '' ) {
		$pshname = '<i>����������� ����������</i>';
	}
	$pshzd .= '<br>&nbsp;<b>����� �� ���������� ('.$pshname.'):</b> '.$u->timeOut(($pl['time']+10800)-time()).' (�� '.date('d.m.Y H:i',$pl['time']).')';
}

if( $pshzd != '' ) {
	echo $pshzd . '<br><br>';
}

?>
<br>
<?
if($u->rep['repcapitalcity']>0){ ?>
&bull; <B>Capital city</B> - <?=$u->rep_zv(2,$u->rep['repcapitalcity'])?><BR>
<? } if($u->rep['repangelscity']>0){ ?>
&bull; <B>Angels city</B> - <?=$u->rep_zv(3,$u->rep['repangelscity'])?><BR>
<? } if($u->rep['repdemonscity']>0){ ?>
&bull; <B>Demons city</B> - <?=$u->rep_zv(4,$u->rep['repdemonscity'])?><BR>
<? } if($u->rep['repabandonedplain']>0){ ?>
&bull; <B>����</B> - <?=$u->rep_zv(4,$u->rep['repabandonedplain'])?><BR>
<? } if($u->rep['repsandcity']>0){ ?>
&bull; <B>Sand city</B> - <?=$u->rep_zv(6,$u->rep['repsandcity'])?><BR>
<? } if($u->rep['repsuncity']>0){ ?>
&bull; <B>Sun city</B> - <?=$u->rep_zv(7,$u->rep['repsuncity'])?><BR>
<? } if($u->rep['repemeraldscity']>0){ ?>
&bull; <B>Emeralds City</B> - <?=$u->rep_zv(8,$u->rep['repemeraldscity'])?><BR>
<? } if($u->rep['rep1']>0){ ?>
&bull; <B>���� ������</B> - <?=$u->rep_zv(1,$u->rep['rep1'])?><BR>
<? } if($u->rep['rep2']>0){ ?>
&bull; <B>������ �����</B> - <?=$u->rep_zv(5,$u->rep['rep2'])?><BR>
<? } if($u->rep['hip']>0){ ?>
&bull; <B>������ ��������� �����������</B> - <?=($u->rep['hip']-$u->rep['hip_buy']).' (������� �� ��� �����: '.$u->rep['hip'].' ��.)'?><BR>
<? } if($u->rep['repdevilscity']>0){ ?>
&bull; <B>Devils City</B> - <?=$u->rep_zv(8,$u->rep['repdevilscity'])?><BR>
<?}?>

<BR><BR>
<?
$sf = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` >= '.strtotime('now 00:00:00').' AND `vars` = "statistic_today" LIMIT 1',1);
if(isset($sf['id']))
{
	$sfe = $u->lookStats($sf['vals']);
	$sf[0] = $u->info['exp']-$sfe['e'];
	$sf[1] = $u->info['win']-$sfe['w'];
	$sf[2] = $u->info['lose']-$sfe['l'];
	$sf[3] = $u->info['nich']-$sfe['n'];
	unset($sfe);
}else{
	$sf = array(0=>0,1=>0,2=>0,3=>0);	
}
?>
&nbsp; &nbsp; &nbsp; <B>�� �������</B><BR>
&bull; ������� �����: <? echo $sf[0]; ?><BR>
&bull; �������� �����: <? echo $sf[1]; ?><BR>
&bull; ��������� ����: <? echo $sf[2]; ?><BR>
&bull; ��������������: <? echo $sf[3]; ?><BR>
</div>
</div>
<? if($znn!=''){ ?>
<div class=dtz ID=dL7>
<?=$znn;?>
</div>
<? } ?>
<SCRIPT>
setlevel('L<? if(isset($rzsee)){ echo $rzsee; }else{ echo 1; } ?>');
</SCRIPT>
</TABLE>
</TABLE>
<!--������� ���-->
</BODY>
</HTML>
