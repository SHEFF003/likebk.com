<?
$dbgo = mysql_pconnect('localhost','like','23wesdxc');
mysql_select_db('like',$dbgo);
mysql_query('SET NAMES cp1251');

$p = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`level`,`sex`,`clan`,`align`,`city`,`cityreg` FROM `users` WHERE `id` = "'.mysql_real_escape_string($_GET['user']).'" LIMIT 1'));

if(isset($p['id'])) {
	$st = mysql_fetch_array(mysql_query('SELECT `id` FROM `stats` WHERE `id` = "'.$p['id'].'" AND (`stats` LIKE "%|s6=0%" OR `stats` NOT LIKE "%|s6=%") LIMIT 1'));
	if(!isset($st['id'])) {
		$_GET['t'] = 2;
	}
}

function  microLogin($id,$t,$nnz = 1)
{
	global $c;
	if($t==1)
	{
		$inf = mysql_fetch_array(mysql_query('SELECT 
		`u`.`id`,
		`u`.`align`,
		`u`.`login`,
		`u`.`clan`,
		`u`.`level`,
		`u`.`city`,
		`u`.`online`,
		`u`.`sex`,
		`u`.`cityreg`,
		`u`.`palpro`,
		`u`.`invis`,
		`st`.`hpNow` FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`id`="'.mysql_real_escape_string($id).'" OR `u`.`login` = "'.mysql_real_escape_string((int)$id).'" LIMIT 1'));
	}else{
		$inf = $id;
		$id = $inf['id'];
	}
	$r = '';
	if(isset($inf['id']) && ( ($inf['invis'] < time() && $inf['invis'] != 1) || ($this->info['id'] == $inf['id'] && $nnz == 1) ))
	{
		if($inf['align']>0)
		{
			$r .= '<img width="12" height="15" src="http://img.likebk.com/i/align/align'.$inf['align'].'.gif" />';
		}
		if($inf['clan']>0)
		{
			$cln = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`name_mini`,`align`,`type_m`,`money1`,`exp` FROM `clan` WHERE `id` = "'.$inf['clan'].'" LIMIT 1'));
			if(isset($cln['id']))
			{
				$r .= '<img width="24" height="15" src="http://img.likebk.com/i/clan/'.$cln['name_mini'].'.gif" />';
			}
		}
		if($inf['cityreg'] == '') {
			$inf['cityreg'] = 'capitalcity';
		}
		$r .= ' <b>'.$inf['login'].'</b> ['.$inf['level'].']<a target="_blank" href="http://likebk.com/inf.php?'.$inf['id'].'"><img rel="tooltip" title="Инф. о '.$inf['login'].'" src="http://img.likebk.com/i/inf_'.$inf['cityreg'].'.gif" /></a>';	
	}else{
		// $r = '<b><i>Невидимка</i></b> [??]<a target="_blank" href="/inf.php?0"><img rel="tooltip" title="Инф. о &lt;i&&gt;Невидимка&lt;/i&gt;" src="http://img.likebk.com/i/inf_capitalcity.gif" /></a>';	
	}
	return $r;
}


?>
<HTML><HEAD><TITLE>Бойцовский клуб</TITLE>
<META content=INDEX,FOLLOW name=robots>
<META content="1 days" name=revisit-after>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<META http-equiv=Pragma content=no-cache>
<META http-equiv=Cache-control content=private>
<META http-equiv=Expires content=0>

<link href="http://top.likebk.com/images/main1.css" rel="stylesheet" type="text/css">
<style type="text/css">
/* .style6 {	color: #DFD3A3;
	font-size: 9px;
}
A:link {
	FONT-WEIGHT: normal;  TEXT-DECORATION: none
}
A:visited {
	FONT-WEIGHT: normal; COLOR: #633525; TEXT-DECORATION: none
}
A:active {
	FONT-WEIGHT: normal; COLOR: #77684d; TEXT-DECORATION: none
}
A:hover {
	COLOR: #000000; TEXT-DECORATION: underline
}
.style10 {font-size: 9pt; font-weight: bold; }
.style7 {font-size: 9pt}
.style8 {color: #4F4B49}
ul {margin:0px; height:0px;}
 */
li
{
list-style-type:decimal;
}

.exp_raiting, .raiting, .win_raiting{
	color: #000;
	font-size: 14px;
	text-transform: uppercase;
	text-align: center;
	font-weight: bold!important;
}
.exp_raiting{
	display: block;
	float: left;
}
.raiting{
	display: block;
	float: left;
	margin-left: 205px;
}
.win_raiting{
	display: block;
	float: right;
}
</style>
</HEAD>
<BODY bgColor=#000000 leftMargin=0 topMargin=0 marginwidth="0" marginheight="0">

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr valign=top><td>
	<table width="100%" height="135"  border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td background="http://top.likebk.com/images/sitebk_02.jpg" scope="col" align=center></td>
	</tr>
	</table>
  </td></tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" bgColor=#3D3D3B>
  <tr valign=top>
	<td width="15%">
	</td>
	<td align=center>
		<table cellspacing=0 cellpadding=0 width="900" bgcolor=#f2e5b1 border=0>
		<tr valign=top>
		<td width="29" rowspan=2 background="http://top.likebk.com/images/n21_08_1.jpg">
		<img src="http://top.likebk.com/images/raitt_08.jpg" width="29" height="256"></td>
		<td><img src="http://top.likebk.com/images/raitt_04.jpg" width="118" height="257"></td>
		<td rowspan=2>
<br>
        <h3 style="font-size: 20px;">Рейтинг Персонажей</h3>
        <TABLE width="100%" border=0 cellPadding=2 cellSpacing=0 name="F1">
            <TBODY>
              <td bgcolor="#F2E5B1">
                <td valign=top>
<a class="exp_raiting" href="http://top.likebk.com/exp_raiting.php">Опыт</a>
<a class="raiting" href="http://top.likebk.com/index.php">Рейтинг</a>
<a class="win_raiting" href="http://top.likebk.com/win_raiting.php">Победы</a>
<br>
<P>
<P>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="http://top.likebk.com/images/ram12_34.gif">
<tr>
<td align="left" scope="col"><img src="http://top.likebk.com/images/ram12_33.gif" width="12" height="11"></td>
<td scope="col"></td>
<td width="18" align="right" scope="col"><img src="http://top.likebk.com/images/ram12_35.gif" width="13" height="11"></td>
</tr>
</table>
<table width=100% border=0 align=center cellpadding=0 cellspacing="1">
<tr>
<td colspan="5"></td>
</tr>
<tr bgcolor="#ECDFAA">
<td align="center"><b>№</b></td>
<td align="center"><b>Персонаж</b></td>
<td align="center"><b>Победы</b></td>
<td>&nbsp;</td>
</tr>
<tr bgcolor="#3D3D3B">
<td></td>
<td width="60%"></td>
<td width="32%"></td>
</tr>


<ul>
<?php
//рейтинг персонажей
$r = '';
$i = 1;
$j = 0;

$p = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`level`,`sex`,`clan`,`align`,`city`,`cityreg` FROM `users` WHERE `id` = "'.mysql_real_escape_string($_GET['user']).'" LIMIT 1'));

$sp = mysql_query('SELECT * FROM `users` WHERE (`pass` NOT LIKE "%saintlucia%" OR `pass` NOT LIKE "%saintlucia5%") ORDER BY `win` DESC LIMIT 250');
while( $pl = mysql_fetch_array($sp) ) {
	$numbi = '';
	$r .= '<tr height="20" bgcolor="#ECDFAA">';
	if( $i == 1 ) {
		$numbi = '<img src="http://img.likebk.com/gold11.png" height="14">';
	}elseif( $i == 2 ) {
		$numbi = '<img src="http://img.likebk.com/silver11.png" height="14">';
	}elseif( $i == 3 ) {
		$numbi = '<img src="http://img.likebk.com/bronze11.png" height="14">';
	}
	//№
	$r .= '<td align="center" height="20" style="font-size:10pt" align=center valign="top" class="mystrong">&nbsp;'.$numbi.$i.'&nbsp;</td>';
	//login
	$r .= '<td height="20" align=left valign="top" class="mystrong">&nbsp;&nbsp;'.microLogin($pl['id'],1).'&nbsp;</td>';
	//рейтинг
	$r .= '<td align="center" height="20" align=right valign="top" class="mystrong">'.number_format($pl['win'],0,'',' ').'</td>';
	//
	$r .= '</tr>';	
	$i++;
}

if($r == '') {
	$r = '<tr  bgcolor="#ECDFAA">';
	//№
	$r .= '<td align=right valign="top" class="mystrong"></td>';
	//login
	$r .= '<td align=center valign="top" class="mystrong">К сожалению рейтинг пуст</td>';
	//рейтинг
	$r .= '<td align=right valign="top" class="mystrong"></td>';
	//
	$r .= '</tr>';	
}

echo $r;
?>
</ul>


<tr>
<td colspan=4><img src="http://top.likebk.com/images/1x1.gif" width="1" height="1" border=0 alt=""></td>
<td></td>
</tr>
<tr>
<td colspan=5><table width="100%"  border="0" cellpadding="0" cellspacing="0" background="http://top.likebk.com/images/ram12_34.gif">
<tr>
<td align="left" scope="col"><img src="http://top.likebk.com/images/ram12_33.gif" width="12" height="11"></td>
<td scope="col"></td>
<td width="18" align="right" scope="col"><img src="http://top.likebk.com/images/ram12_35.gif" width="13" height="11"></td>
</tr>
</table></td>
</tr>
</table>
<center>
<small>
<!-- Рейтинг плавающий. Зависит от ваших активных боевых действий за последние 3 месяца.
Рейтинг обнуляется каждые 3 месяца, следующее обнуление произойдет <u>1 июня 2015</u>. -->
</small>
</center>
</p>
</FORM>
</td>
</tr>
</TABLE>
<!-- End of text -->
</td>
<td align=right><img height=144 src="http://top.likebk.com/images/rairus_03.jpg" width=139 border=0></td>
<td valign=top background="http://top.likebk.com/images/nnn21_03_1.jpg">&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr valign=top>
<td></td>
<td valign=bottom style="padding-bottom:50"><IMG height=236 src="http://top.likebk.com/images/raitt_15.jpg" width=128 border=0></td>
<td width="23" valign=top background="http://top.likebk.com/images/nnn21_03_1.jpg">&nbsp;</td>
</tr>
</table>
</td>
<td width="15%">
</td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor=#000000>
<TR>
<TD colspan=3 width="100%" height=13 background="http://top.likebk.com/images/sitebk_07.jpg"></TD>
</TR>
<tr valign=top>
<td width="20%">
<div align="center">

</div>
</td>
<td align=center><br>
<div align="center" style="padding-bottom:15px;"><NOBR><span class="style6">Copyright © www.likebk.com</span></NOBR></div>
</td>
<td width="20%">
</td>
</tr>
</table>
</BODY>
</HTML>
