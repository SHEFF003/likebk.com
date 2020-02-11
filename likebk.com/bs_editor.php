<?
exit();
session_start();

function er($e)
{
	 global $c;
	 die('<html><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><meta http-equiv="Content-Language" content="ru"><TITLE>Произошла ошибка</TITLE></HEAD><BODY text="#FFFFFF"><p><font color=black>Произошла ошибка: <pre>'.$e.'</pre><b><p><a href="http://'.$c[0].'/">Назад</b></a><HR><p align="right">(c) <a href="http://'.$c[0].'/">'.$c[1].'</a></p></body></html>');
}

function GetRealIp()
{
	if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

define('IP',GetRealIp());
define('GAME',true);

include_once('РЕДАКТОРЫ/_incl_data/__config.php');
include_once('РЕДАКТОРЫ/_incl_data/class/__db_connect.php');
include_once('РЕДАКТОРЫ/_incl_data/class/__user.php');

if(!isset($u->info['id']) || $u->info['admin'] == 0) {
	die('<meta http-equiv="refresh" content="0; URL=http://likebk.com/">');
}

	/*
  <tr>
    <td width="50" height="50">&nbsp;</td>
    <td width="50" height="50">&nbsp;</td>
    <td width="50" height="50">&nbsp;</td>
    <td width="50" height="50">&nbsp;</td>
    <td width="50" height="50">&nbsp;</td>
    <td width="50" height="50">&nbsp;</td>
    <td width="50" height="50">&nbsp;</td>
    <td width="50" height="50">&nbsp;</td>
    <td width="50" height="50">&nbsp;</td>
    <td width="50" height="50">&nbsp;</td>
    <td width="50" height="50">&nbsp;</td>
    <td width="50" height="50">&nbsp;</td>
  </tr>
	*/

//Собираем карту
$map = '';
$x = 0;
$y = 0;
$bid = 0;
$size = 9;

//Действия
if( isset($_GET['create_new']) ) {
	$cord = explode(',',$_GET['create_new']);
	$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `bs_map` WHERE `mid` = "'.mysql_real_escape_string($bid).'" AND `x` = "'.mysql_real_escape_string($cord[0]).'" AND `y` = "'.mysql_real_escape_string($cord[1]).'" LIMIT 1'));
	if( !isset($test['id']) ) {
		mysql_query('INSERT INTO `bs_map` (`mid`,`x`,`y`) VALUES ("'.mysql_real_escape_string($bid).'","'.mysql_real_escape_string($cord[0]).'","'.mysql_real_escape_string($cord[1]).'") ');
	}
	header('location: /bs_editor.php?x='.round($x).'&y='.round($y).'');
}elseif(isset($_GET['up'])) {
	$test = mysql_fetch_array(mysql_query('SELECT `id`,`up` FROM `bs_map` WHERE `mid` = "'.mysql_real_escape_string($bid).'" AND `id` = "'.mysql_real_escape_string($_GET['up']).'" LIMIT 1'));
	if( isset($test['id']) ) {
		if( $test['up'] == 0 ) {
			$test['up'] = 1;
		}else{
			$test['up'] = 0;
		}
		mysql_query('UPDATE `bs_map` SET `up` = "'.$test['up'].'" WHERE `id` = "'.$test['id'].'" LIMIT 1');
	}
	header('location: /bs_editor.php?x='.round($x).'&y='.round($y).'');
}elseif(isset($_GET['left'])) {
	$test = mysql_fetch_array(mysql_query('SELECT `id`,`left` FROM `bs_map` WHERE `mid` = "'.mysql_real_escape_string($bid).'" AND `id` = "'.mysql_real_escape_string($_GET['left']).'" LIMIT 1'));
	if( isset($test['id']) ) {
		if( $test['left'] == 0 ) {
			$test['left'] = 1;
		}else{
			$test['left'] = 0;
		}
		mysql_query('UPDATE `bs_map` SET `left` = "'.$test['left'].'" WHERE `id` = "'.$test['id'].'" LIMIT 1');
	}
	header('location: /bs_editor.php?x='.round($x).'&y='.round($y).'');
}elseif(isset($_GET['right'])) {
	$test = mysql_fetch_array(mysql_query('SELECT `id`,`right` FROM `bs_map` WHERE `mid` = "'.mysql_real_escape_string($bid).'" AND `id` = "'.mysql_real_escape_string($_GET['right']).'" LIMIT 1'));
	if( isset($test['id']) ) {
		if( $test['right'] == 0 ) {
			$test['right'] = 1;
		}else{
			$test['right'] = 0;
		}
		mysql_query('UPDATE `bs_map` SET `right` = "'.$test['right'].'" WHERE `id` = "'.$test['id'].'" LIMIT 1');
	}
	header('location: /bs_editor.php?x='.round($x).'&y='.round($y).'');
}elseif(isset($_GET['down'])) {
	$test = mysql_fetch_array(mysql_query('SELECT `id`,`down` FROM `bs_map` WHERE `mid` = "'.mysql_real_escape_string($bid).'" AND `id` = "'.mysql_real_escape_string($_GET['down']).'" LIMIT 1'));
	if( isset($test['id']) ) {
		if( $test['down'] == 0 ) {
			$test['down'] = 1;
		}else{
			$test['down'] = 0;
		}
		mysql_query('UPDATE `bs_map` SET `down` = "'.$test['down'].'" WHERE `id` = "'.$test['id'].'" LIMIT 1');
	}
	header('location: /bs_editor.php?x='.round($x).'&y='.round($y).'');
}

//Получаем массив с клетками
$map_box = array(	);
$sp = mysql_query('SELECT * FROM `bs_map` WHERE `mid` = "'.mysql_real_escape_string($bid).'" AND
	(
		`x` >= "'.mysql_real_escape_string($x-$size).'" AND `x` <= "'.mysql_real_escape_string($x+$size).'" AND
		`y` >= "'.mysql_real_escape_string($y-$size).'" AND `y` <= "'.mysql_real_escape_string($y+$size).'"
	)
');
while( $pl = mysql_fetch_array( $sp ) ) {
	$map_box[$pl['x']][$pl['y']] = $pl;
}
//Генерируем карту из мэп бокса
$i = $x-$size;
while( $i < $x+$size ) {
	$j = $y-$size;
	$map .= '<tr>';
	while( $j < $y+$size ) {
		$box = '';
		//$i - x , $j - y
		if( !isset($map_box[$i][$j]) ) {
			//Клетка пустая
			$box = '';
			$box = '<div onclick="location.href=\'?x='.round($x).'&y='.round($y).'&create_new='.$i.','.$j.'\';" class="emptybox">'.$box.'</div>';
		}else{
			//Клетка забита
			$cls = array(
				0 => 0,
				1 => 0,
				2 => 0,
				3 => 0
			);
			if( $map_box[$i][$j]['up'] > 0 ) {
				if( $map_box[$i][$j]['up'] > 1 ) {
					$cls[0] = 2;
				}else{
					$cls[0] = 1;
				}
			}
			if( $map_box[$i][$j]['left'] > 0 ) {
				if( $map_box[$i][$j]['left'] > 1 ) {
					$cls[1] = 2;
				}else{
					$cls[1] = 1;
				}
			}
			if( $map_box[$i][$j]['right'] > 0 ) {
				if( $map_box[$i][$j]['right'] > 1 ) {
					$cls[2] = 2;
				}else{
					$cls[2] = 1;
				}
			}
			if( $map_box[$i][$j]['down'] > 0 ) {
				if( $map_box[$i][$j]['down'] > 1 ) {
					$cls[3] = 2;
				}else{
					$cls[3] = 1;
				}
			}
			$box = '
			<table title="ID: '.$map_box[$i][$j]['id'].',X: '.$map_box[$i][$j]['x'].',Y: '.$map_box[$i][$j]['y'].'" width="50" height="50" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td align="center" valign="middle"></td>
				<td align="center" valign="middle"><img onclick="location.href=\'?x='.round($x).'&y='.round($y).'&up='.$map_box[$i][$j]['id'].'\'" class="bxs bxs'.$cls[0].'" src="http://img.likebk.com/1x1.gif"></td>
				<td align="center" valign="middle"></td>
			  </tr>
			  <tr>
				<td align="center" valign="middle"><img onclick="location.href=\'?x='.round($x).'&y='.round($y).'&left='.$map_box[$i][$j]['id'].'\'" class="bxs bxs'.$cls[1].'" src="http://img.likebk.com/1x1.gif"></td>
				<td align="center" valign="middle"></td>
				<td align="center" valign="middle"><img onclick="location.href=\'?x='.round($x).'&y='.round($y).'&right='.$map_box[$i][$j]['id'].'\'" class="bxs bxs'.$cls[2].'" src="http://img.likebk.com/1x1.gif"></td>
			  </tr>
			  <tr>
				<td align="center" valign="middle"></td>
				<td align="center" valign="middle"><img onclick="location.href=\'?x='.round($x).'&y='.round($y).'&down='.$map_box[$i][$j]['id'].'\'" class="bxs bxs'.$cls[3].'" src="http://img.likebk.com/1x1.gif"></td>
				<td align="center" valign="middle"></td>
			  </tr>
			</table>';
			$box = '<div style="width:50px;height:50px;background-color:grey;border:1px solid #dedede;">'.$box.'</div>';
		}
		$map .= '<td width="50" height="50" align="center" valign="middle">'.$box.'</td>';
		$j++;
	}
	$map .= '</tr>';
	$i++;
}
?>
<style>
.emptybox {
	cursor:pointer;
	width:50px;
	height:50px;
	background-color:#efefef;
	border:1px solid #dedede;
}
.emptybox:hover {
	background-color:#aedeae;
	border:1px solid #a0dea0;
}
.bxs0 {
	background-color:#F66;
}
.bxs1 {
	background-color:#0C3;
}
.bxs2 {
	background-color:blue;
}
.bxs {
	width:5px;
	height:5px;
	border:2px solid grey;
	cursor:pointer;
}
.bxs:hover {
	border:2px solid #FC0;
}
</style>
<table border="0" cellspacing="0" cellpadding="0">
<?=$map?>
</table>