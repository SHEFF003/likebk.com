<?
define('GAME',true);
include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

$r = ''; $p = ''; $b = '<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tbody>
    <tr valign="top">
      <td valign="bottom" nowrap="" title=""><input onClick="location=location;" style="padding:5px;" type="submit" name="analiz2" value="Обновить"></td>
    </tr>
  </tbody>
</table>';
if( !isset($_GET['towerid'])) {
	$_GET['towerid'] = 1;
}
$_GET['towerid'] = round((int)$_GET['towerid']);
$notowerlog = false;
$log = mysql_fetch_array(mysql_query('SELECT `id`,`count_bs`,`m` FROM `bs_logs` WHERE `id_bs` = "'.$_GET['towerid'].'" ORDER BY `id` ASC LIMIT 1'));
if(!isset($log['id']))
{
	$notowerlog = true;
	$r = '<br><br><center>Скорее всего Архивариус снова потерял пергамент с хрониками турниров ...</center>';
}else{
	$sp = mysql_query('SELECT * FROM `bs_logs` WHERE `id_bs` = "'.$_GET['towerid'].'" ORDER BY `id` ASC');
	while( $pl = mysql_fetch_array($sp) ) {
		$datesb = '';
		if( $pl['type'] == 2 ) {
			$datesb = '2';
		}
		$r .= '<br><span class="date'.$datesb.'">'.date('d.m.y H:i',$pl['time']).'</span> '.$pl['text'].'';
	}
}

$pers = array(0 => "", 1 => "", 2 => "");

$sp = mysql_query('SELECT `id`,`login`,`level`,`align`,`clan` FROM `users` WHERE `room` = 363 AND `inTurnir` > 0 LIMIT 50');
while($pl = mysql_fetch_array($sp)) {
	if($pl['align'] > 0) {
		$pers[0] = '<img src=http://img.likebk.com/i/align/align'.$pl['align'].'.gif>'; //align
	}
	if($pl['clan'] > 0) {
		$pers[1] = '<img src=http://img.likebk.com/i/clan/'.$pl['clan'].'.gif>'; //clan
	}
	$pers[2] .= ', '.$pers[0].''.$pers[1].'<b>'.$pl['login'].'['.$pl['level'].']</b><a href=http://likebk.com/inf.php?'.$pl['id'].' target=_blank><img src=http://img.likebk.com/i/inf_capitalcity.gif></a>';
}
$pers[2] = ltrim($pers[2],', ');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Архив: Турнир в Башне Смерти</title>
<script src="http://img.likebk.com/js/Lite/gameEngine.js" type="text/javascript"></script>
<link href="http://img.likebk.com/css/main.css" rel="stylesheet" type="text/css">
<style type="text/css">
h3 {
	text-align: center;
}
.CSSteam	{ font-weight: bold; cursor:pointer; }
.CSSteam0	{ font-weight: bold; cursor:pointer; }
.CSSteam1	{ font-weight: bold; color: #6666CC; cursor:pointer; }
.CSSteam2	{ font-weight: bold; color: #B06A00; cursor:pointer; }
.CSSteam3 	{ font-weight: bold; color: #269088; cursor:pointer; }
.CSSteam4 	{ font-weight: bold; color: #A0AF20; cursor:pointer; }
.CSSteam5 	{ font-weight: bold; color: #0F79D3; cursor:pointer; }
.CSSteam6 	{ font-weight: bold; color: #D85E23; cursor:pointer; }
.CSSteam7 	{ font-weight: bold; color: #5C832F; cursor:pointer; }
.CSSteam8 	{ font-weight: bold; color: #842B61; cursor:pointer; }
.CSSteam9 	{ font-weight: bold; color: navy; cursor:pointer; }
.CSSvs 		{ font-weight: bold; }
</style>
</head>

<body bgcolor="#E2E0E0">
<H3> Башня Смерти. Отчет о турнире. &nbsp; <a href="http://www.likebk.com/">www.likebk.com</a></H3>
<? if($pers[2] != "") { ?>
Живые участники в турнире: <?=$pers[2]?><hr>
<?}?>
<? if( $notowerlog == false ) { ?>
Призовой фонд: <b><?=$log['m']?> кр.</b>
<? }
echo $r; ?>
</body>
</html>