<?
if(!defined('GAME'))
{
	die();
}
?>
<HTML>
<HEAD>
<link rel=stylesheet type="text/css" href="../i/main.css">
<meta content="text/html; charset=windows-1251" http-equiv=Content-type>
</HEAD>
<body bgcolor=e2e0e0>
<FORM ACTION="main.php?act_sec" METHOD=POST>
<P align=right>
<INPUT TYPE=button value="���������" style='width: 75px' onclick="location.href='main.php'"></P>
<H3>����� ������� ������������</H3>
�� ������ �������� ����� � ������� �� ��������� �����<BR>
������� �����, �� ������� ������ �������� ����� <small>(� ������� mm.yy)</small>: 
<INPUT TYPE=text NAME=date value="<?echo date("m.y");?>"> 
<INPUT TYPE=submit name=logenters value="����������">
</FORM>
<BR>
<?
if ($_POST['date']) {

  $_POST['date']=trim($_POST['date']);

  $m=($_POST['date'][0]?$_POST['date'][0]:'0').($_POST['date'][1]?$_POST['date'][1]:'0');

  $y=($_POST['date'][3]?$_POST['date'][3]:'0').($_POST['date'][4]?$_POST['date'][4]:'0');

  
if ($m>0 && $y>0) {

?>
<TABLE width=100% bgcolor=F0F0F0><TR><TD>
<H3>����� ������� ������������ �� <? echo $m.".20".$y?></H3>
<H4>Capital City</H4>
<?
$date = mktime(0, 0, 0, $m, 31, "20".$y);
$date1 = mktime(0, 0, 0, $m, 1, "20".$y);
    $res = mysql_query("SELECT * FROM `logs_auth` WHERE `uid` = '".mysql_real_escape_string($u->info['id'])."' AND `time` <= '".mysql_real_escape_string($date)."'  AND `time` >= '".mysql_real_escape_string($date1)."'ORDER by `id` DESC;");

  unset($i); while ($i<mysql_num_rows($res)) {

    $i++;$s=mysql_fetch_array($res);
  	$dat=date("d.m.y H:i",$s['time']);
	if($s['type']==1) {$s['ip'] = '<b>'.$s['ip'].'</b>';}
    echo $dat.($s['type']==3?' <B>�������� ������</B>, ':' ������ "'.$u->info['login'].'" ').$s['ip'].'<br>';


  }
?>
</TD></TR></TABLE>
</TABLE>
<? }
}
?>
</BODY>
</HTML>