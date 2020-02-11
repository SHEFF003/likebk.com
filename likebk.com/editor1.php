<?php
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__magic.php');
include('_incl_data/class/__user.php');

if( $u->info['admin'] == 0 ) {
	die();
}

if(isset($_GET['add'])) {
	mysql_query('INSERT INTO `a_quest` (`name`) VALUES ("Новый квест")');
	header('location: /editor1.php');
	die();
}elseif(isset($_GET['del'])) {
	mysql_query('UPDATE `a_quest` SET `mm` = 0 WHERE `id` = "'.mysql_real_escape_string($_GET['del']).'" LIMIT 1');
	header('location: /editor1.php');
	die();
}elseif(isset($_GET['save'])) {
  $ps = mysql_query('SELECT * FROM `a_quest` ORDER BY `id` DESC');
  while( $pl = mysql_fetch_array($ps) ) {
	  if(isset($_POST['qst_'.$pl['id'].'_name'])) {
		 $pl['dd'] = $_POST['qst_'.$pl['id'].'_'.'dd'];
		 $pl['dd2'] = $_POST['qst_'.$pl['id'].'_'.'dd2'];
		 $pl['mm'] = $_POST['qst_'.$pl['id'].'_'.'mm'];
		 $pl['mm2'] = $_POST['qst_'.$pl['id'].'_'.'mm2'];
		 $pl['name'] = $_POST['qst_'.$pl['id'].'_'.'name'];
		 $pl['name2'] = $_POST['qst_'.$pl['id'].'_'.'name2'];
		 $pl['img1'] = $_POST['qst_'.$pl['id'].'_'.'img1'];
		 $pl['itm1'] = $_POST['qst_'.$pl['id'].'_'.'itm1'];
		 $pl['itm2'] = $_POST['qst_'.$pl['id'].'_'.'itm2'];
		 $pl['itm3'] = $_POST['qst_'.$pl['id'].'_'.'itm3'];
		 $pl['loto'] = $_POST['qst_'.$pl['id'].'_'.'loto'];
		 $pl['gift'] = $_POST['qst_'.$pl['id'].'_'.'gift'];
		 $pl['room'] = $_POST['qst_'.$pl['id'].'_'.'room'];
		 mysql_query('UPDATE `a_quest` SET
		 
		 `dd` = "'.mysql_real_escape_string($pl['dd']).'",
		 `mm` = "'.mysql_real_escape_string($pl['mm']).'",
		 `dd2` = "'.mysql_real_escape_string($pl['dd2']).'",
		 `mm2` = "'.mysql_real_escape_string($pl['mm2']).'",
		 `name` = "'.mysql_real_escape_string($pl['name']).'",
		 `name2` = "'.mysql_real_escape_string($pl['name2']).'",
		 `img1` = "'.mysql_real_escape_string($pl['img1']).'",
		 `itm1` = "'.mysql_real_escape_string($pl['itm1']).'",
		 `itm2` = "'.mysql_real_escape_string($pl['itm2']).'",
		 `itm3` = "'.mysql_real_escape_string($pl['itm3']).'",
		 `loto` = "'.mysql_real_escape_string($pl['loto']).'",
		 `gift` = "'.mysql_real_escape_string($pl['gift']).'",
		 `room` = "'.mysql_real_escape_string($pl['room']).'"
		 
		 WHERE `id` = "'.$pl['id'].'" LIMIT 1');
	  }
  }
  header('location: /editor1.php');
  die();
}

?>
<!doctype html>
<html>
<head>
<meta charset="windows-1251">
<title>Редактор квестов</title>
</head>

<body>
<form method="post" action="/editor1.php?save">
<div align="center" style="padding:30px;">
	<input type="submit" value="СОХРАНИТЬ ДАННЫЕ" style="padding:10px;"> &nbsp; &nbsp; 
    <input type="button" onClick="top.location.href='/editor1.php?add'" value="ДОБАВИТЬ НОВЫЙ" style="padding:10px;">
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td width="50" align="center" valign="middle" bgcolor="#D6D6D6">id</td>
    <td width="300" align="center" valign="middle" bgcolor="#D6D6D6">Название</td>
    <td align="center" valign="middle" bgcolor="#D6D6D6">Дата начала<br>
    (dd mm)</td>
    <td align="center" valign="middle" bgcolor="#D6D6D6">Дата конца<br>
    (dd mm)</td>
    <td width="300" align="center" valign="middle" bgcolor="#D6D6D6">Заголовок</td>
    <td align="center" valign="middle" bgcolor="#D6D6D6">Картинка обложки</td>
    <td align="center" valign="middle" bgcolor="#D6D6D6">Предмет (часы)</td>
    <td align="center" valign="middle" bgcolor="#D6D6D6">Предмет (хаоты)</td>
    <td align="center" valign="middle" bgcolor="#D6D6D6">Предмет (пещеры)</td>
    <td align="center" valign="middle" bgcolor="#D6D6D6">Лото</td>
    <td align="center" valign="middle" bgcolor="#D6D6D6">Подарки</td>
    <td align="center" valign="middle" bgcolor="#D6D6D6">Комната магазина</td>
    <td align="center" valign="middle" bgcolor="#D6D6D6"></td>
  </tr>
  <?
  $html = '';
  $ps = mysql_query('SELECT * FROM `a_quest` WHERE `mm` != 0 ORDER BY `id` DESC');
  while( $pl = mysql_fetch_array($ps) ) {
  	$html .= '	  <tr>
					<td align="center" valign="top" width="50">'.$pl['id'].'</td>
					<td align="center" valign="top"><input style="width:100%" name="qst_'.$pl['id'].'_name" type="text" value="'.$pl['name'].'"></td>
					<td align="center" valign="top" width="100"><select name="qst_'.$pl['id'].'_dd">';
	
	$i = 1;
	while( $i <= 31 ) {
		$sel = '';
		if( $pl['dd'] == $i ) {
			$sel = 'selected';
		}
		$html .= '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		$i++;
	}
	
	$html .= 		'</select><select name="qst_'.$pl['id'].'_mm">';
	
	$i = 0;
	while( $i <= 12 ) {
		$sel = '';
		if( $pl['mm'] == $i ) {
			$sel = 'selected';
		}
		$html .= '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		$i++;
	}
	
	$html .= 		'</select></td>
					<td align="center" valign="top" width="100"><select name="qst_'.$pl['id'].'_dd2">';
	
	$i = 1;
	while( $i <= 31 ) {
		$sel = '';
		if( $pl['dd2'] == $i ) {
			$sel = 'selected';
		}
		$html .= '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		$i++;
	}
	
	$html .= 		'</select><select name="qst_'.$pl['id'].'_mm2">';
	
	$i = 0;
	while( $i <= 12 ) {
		$sel = '';
		if( $pl['mm2'] == $i ) {
			$sel = 'selected';
		}
		$html .= '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		$i++;
	}
	
	$html .= 		'</select></td>
					<td align="center" valign="top"><input style="width:100%" name="qst_'.$pl['id'].'_name2" type="text" value="'.$pl['name2'].'"></td>
					<td align="center" valign="top"><input style="width:100%" name="qst_'.$pl['id'].'_img1" type="text" value="'.$pl['img1'].'"></td>
					<td align="center" valign="top"><input style="width:100%" name="qst_'.$pl['id'].'_itm1" type="text" value="'.$pl['itm1'].'"></td>
					<td align="center" valign="top"><input style="width:100%" name="qst_'.$pl['id'].'_itm2" type="text" value="'.$pl['itm2'].'"></td>
					<td align="center" valign="top"><input style="width:100%" name="qst_'.$pl['id'].'_itm3" type="text" value="'.$pl['itm3'].'"></td>
					<td align="center" valign="top"><input style="width:100%" name="qst_'.$pl['id'].'_loto" type="text" value="'.$pl['loto'].'"></td>
					<td align="center" valign="top"><input style="width:100%" name="qst_'.$pl['id'].'_gift" type="text" value="'.$pl['gift'].'"></td>
					<td align="center" valign="top"><input style="width:100%" name="qst_'.$pl['id'].'_room" type="text" value="'.$pl['room'].'"></td>
					<td align="center" valign="top"><a href="/editor1.php?del='.$pl['id'].'">Удалить</a></td>
				  </tr>';
  }
  echo $html;
  ?>
</table>
</form>


</body>
</html>
