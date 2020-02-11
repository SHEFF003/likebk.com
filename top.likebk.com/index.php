<?
if(!function_exists('GetRealIp')) {
	function GetRealIpTest(){
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			return $_SERVER['HTTP_CLIENT_IP'];
		else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		return $_SERVER['REMOTE_ADDR'];
	}
	$ipban = GetRealIpTest();
}else{
	$ipban = GetRealIp();
}

$dbgo = mysql_pconnect('localhost','like','23wesdxc');
mysql_select_db('like',$dbgo);
mysql_query('SET NAMES cp1251');

	mysql_query('INSERT INTO `files_look` (`ip`,`user`,`ref`,`time`,`file`,`url`) VALUES (
		"'.mysql_real_escape_string($ipban).'","'.mysql_real_escape_string($_COOKIE['login']).'"
		,"'.mysql_real_escape_string($_SERVER['HTTP_REFERER']).'","'.time().'"
		,"'.mysql_real_escape_string($_SERVER['SCRIPT_NAME']).'"
		,"'.mysql_real_escape_string($_SERVER['REQUEST_URI']).'"
		
	)');

/*$p = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`level`,`sex`,`clan`,`align`,`city`,`cityreg` FROM `users` WHERE `id` = "'.mysql_real_escape_string($_GET['user']).'" LIMIT 1'));

if(isset($p['id'])) {
	$st = mysql_fetch_array(mysql_query('SELECT `id` FROM `stats` WHERE `id` = "'.$p['id'].'" AND (`stats` LIKE "%|s6=0%" OR `stats` NOT LIKE "%|s6=%") LIMIT 1'));
	if(!isset($st['id'])) {
		$_GET['t'] = 2;
	}
}*/

function  microLogin($id,$t,$nnz = 1) {
	$inf = $id;
	$id = $inf['id'];
	$r = '';
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
	$r .= ' <b>'.$inf['login'].'</b> ['.$inf['level'].']<a target="_blank" href="http://likebk.com/inf.php?'.$inf['id'].'"><img title="Инф. о '.$inf['login'].'" src="http://img.likebk.com/i/inf_'.$inf['cityreg'].'.gif" /></a>';	
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
<td align="center"><b>Рейтинг</b></td>
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
/*$i = 1;
$j = 0;
$sp = mysql_query('SELECT `id`,`uid`,`dmy`,`last` FROM `users_rating` ORDER BY `rating` DESC');
while( $pl = mysql_fetch_array($sp) ) {
	$user = mysql_fetch_array(mysql_query('SELECT `u`.`id` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`bot` = 0 AND `u`.`id` = "'.$pl['uid'].'" AND `u`.`pass` NOT LIKE "%saintlucia%" LIMIT 250'));
	if(!isset($user['id'])) {
		mysql_query('DELETE FROM `users_rating` WHERE `uid` = "'.$pl['uid'].'"');
	}else{
		if( $pl['dmy'] != date('dmY') ) {
			mysql_query('UPDATE `users_rating` SET `dmy` = "'.date('dmY').'",`last` = "'.($j+1).'",`last2` = "'.$pl['last'].'",`now` = `rating` WHERE `uid` = "'.$pl['uid'].'" LIMIT 1');
		}
		$j++;
	}
}

$p = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`level`,`sex`,`clan`,`align`,`city`,`cityreg` FROM `users` WHERE `id` = "'.mysql_real_escape_string($_GET['user']).'" LIMIT 1'));

$rt_type = 'now';
if(isset($_GET['type']) && $_GET['type'] == 2) {
	$rt_type = 'rating';
}
*/
$i = 1;
$sp = mysql_query('SELECT * FROM `aaa_reting_list` WHERE `date` = "'.date('dmY').'" ORDER BY `pos` ASC LIMIT 1000');
while( $pl = mysql_fetch_array($sp) ) {
	$user = mysql_fetch_array(mysql_query('SELECT `u`.`id`,`u`.`level`,`u`.`login`,`u`.`align`,`u`.`clan` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `u`.`id` = "'.$pl['uid'].'" LIMIT 1'));
	if(!isset($user['id'])) {
		$r .= '<td height="20" style="font-size:10pt" align=center valign="top" class="mystrong">&nbsp;'.$pl['pos'].'&nbsp;</td>';
		//login
		$r .= '<td height="20" align=left valign="top" class="mystrong">&nbsp;&nbsp;- - -&nbsp;</td>';
		//рейтинг
		$r .= '<td align="center" height="20" align=right valign="top" class="mystrong">- - -</td>';
		//
		$r .= '</tr>';
	}else{
		$ret = round($pl['global']/(10000+$user['level']),2);
		if($pl['uid'] == $p['id']) {
			$r .= '<tr  height="20" bgcolor="#d9ca8c">';
		}else{
			$r .= '<tr height="20" bgcolor="#ECDFAA">';
		}
		//№
		$numb = '';
		$numbi = '';
		$poslast = mysql_fetch_array(mysql_query('SELECT `pos` FROM `aaa_reting_list` WHERE `id` < "'.$pl['id'].'" AND `uid` = "'.$pl['uid'].'" ORDER BY `id` DESC LIMIT 1'));
		if(isset($poslast['pos'])) {
			$poslast = $poslast['pos'];
			if($pl['pos'] != $poslast) {
				$numb .= '<sup>&nbsp;<small>';
				if($poslast > $pl['pos']) {
					$numbi .= '<img style="padding-bottom:4px;" src="http://img.likebk.com/uprt2.png" width="7" height="7">';
					$numb .= '<font color=green><b>+'.($poslast-$pl['pos']).'</b></font>';
				}else{
					$numbi .= '<img style="padding-bottom:4px;" src="http://img.likebk.com/uprt.png" width="7" height="7">';
					$numb .= '<font color=maroon><b>'.($pl['pos']-$poslast).'</b></font>';
				}
				$numb .= '</small></sup>';
			}
		}
		if( $i == 1 ) {
			$numbi = '<img src="http://img.likebk.com/gold11.png" height="14">';
		}elseif( $i == 2 ) {
			$numbi = '<img src="http://img.likebk.com/silver11.png" height="14">';
		}elseif( $i == 3 ) {
			$numbi = '<img src="http://img.likebk.com/bronze11.png" height="14">';
		}
		$r .= '<td height="20" style="font-size:10pt" align=center valign="top" class="mystrong"><a name="id'.$pl['uid'].'">&nbsp;'.$numbi.$pl['pos'].$numb.'&nbsp;</a></td>';
		//login
		$r .= '<td height="20" align=left valign="top" class="mystrong">&nbsp;&nbsp;'.microLogin($user,1).'&nbsp;</td>';
		//рейтинг
		$r .= '<td align="center" height="20" align=right valign="top" class="mystrong">'.number_format($ret,0,'',' ').'</td>';
		//
		$r .= '</tr>';	
	}
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
