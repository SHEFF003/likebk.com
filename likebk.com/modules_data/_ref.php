<style type="text/css">
	#tbtets{
		width: 80%;	
	}
	#tbtets tr td{
		padding: 5px;
		padding-left: 15px;
	}
</style>
<?php
if(!defined('GAME') || !isset($_GET['referals']))
{
	die();
}
$rfs   = '';
$sumKr = 0;
$sumEkr = 0;
$count = 1;
$rfs2 .= "<table id='tbtets' border='1'><tr><td align='center'>";
$rfs2 .= "<b>�</b></td>
    <td><b>�����</b></td>
    <td><b>������</b></td></tr>";
$sp = mysql_query('SELECT * FROM `users` WHERE `referals` = "'.$u->info['id'].'" ');
while($pl = mysql_fetch_array($sp))
{
	$r = '';
	if($pl['align']>0)
	{
		$r .= '<img width="12" height="15" src="http://img.likebk.com/i/align/align'.$pl['align'].'.gif" />';
	}
	if($pl['clan']>0)
	{
		$cln = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`name_mini`,`align`,`type_m`,`money1`,`exp` FROM `clan` WHERE `id` = "'.$pl['clan'].'" LIMIT 1'));
		if(isset($cln['id']))
		{
			$r .= '<img width="24" height="15" src="http://img.likebk.com/i/clan/'.$cln['name_mini'].'.gif" />';
		}
	}
	$rfs .= $count.") ";
	$rfs2 .=  "<tr><td align='center'>".$count."</td>";
	$rfs2 .= '<td><a href="javascript:void(0)" onclick="top.chat.addto(\''.$pl['login'].'\',\'private\')">
		<img title="" src="http://img.likebk.com/i/lock.gif" width="20" height="15">
		</a>'.$r.'<a href="javascript:void(0)" onclick="top.chat.addto(\''.$pl['login'].'\',\'to\')">'.$pl['login'].'</a> ['.$pl['level'].']
		<a href="http://likebk.com/inf.php?'.$pl['id'].'" target="_blank">
		<img style="vertical-align:baseline" width="12" height="11" src="http://img.likebk.com/i/inf_capitalcity.gif" title="���. � '.$pl['login'].'">
		</a></td>';
	if($pl['online'] > (time() - 520)){
		$onl = "<font color='green'><b>������</b></font>";
	}else{
		$onl = '��������� ��� �������: '.date('d.m.Y H:i',$pl['online']).'<img title="����� �������" src="http://img.likebk.com/i/clok3_2.png">';
		$out = $u->timeOut(time()-$pl['online']);
		$onl .= '<br>('.$out.' �����)';
    }
    $rfs2 .= "<td>".$onl."</td>";
    $rfs2 .= "</tr>";
$rfs .= $u->microLogin($pl['id'],1).'<br>';
	if($pl['level'] == 8){
		$sumKr += 250; 
	}elseif($pl['level'] == 9){
		$sumKr += 250; 
		$sumEkr += 5;
	}elseif($pl['level'] == 10){
		$sumKr += 250; 
		$sumEkr += 13;
	}elseif($pl['level'] == 11){
		$sumKr += 250; 
		$sumEkr += 25;
	}elseif($pl['level'] == 12){
		$sumKr += 250; 
		$sumEkr += 40;
	}
	$count++;
}
$rfs2 .= "</table>";
if($rfs=='')
{
	$rfs = '<center><b>� ��������� � ��� ��� ���������, ���������� ������ ������!</b></center>';
}
?>
<table cellspacing="0" cellpadding="2" width="100%">
	<tr>
		<td colspan="2"><h3>����������� �������</h3></td>
	</tr>
	<tr>
		<td>
			<p>����������� � ���� ����� ������ ��������� ������ ����, � ��������� �� ��� ������.</p>
			������ ��� ������: 
        <input onClick="this.select();" style="font-size: 14px; text-align:center;background-color:#FBFBFB; color: red; font-weight: bold; width:300px; border:1px solid #EFEFEF; padding:5px;" size="45" value="http://likebk.com/register?r=<?=$u->info['id']?>"  />
		</td>
		<td>
			<input type='button' value='��������' onclick='location=&quot;main.php?referals&quot;' />
		          &nbsp;
		          <input type="button" value="���������" onclick='location=&quot;main.php&quot;' />
		</td>
	</tr>
	<tr>
		<td><h4>���� ��������:</h4></td>
		<td>
			<center><b>��������� �� ���������</b></center>
			<small>�� ������ ������� ������ �������� �� ������ �������� ��������� ������:</small>
		</td>
	</tr>
	<tr>
		<td>
			<?php if($u->info['admin']>0){
				//echo $rfs2;
			}?>

			<?=$rfs2 ?>
		</td>
		<td style="vertical-align: top;" width="245px">
			<center>
				<b>8</b> ������� - <font color="green"><b>250 ��.</b></font><br>
				<b>9</b> ������� - <font color="green"><b>5.00 ���.</b></font><br>
				<b>10</b> ������� - <font color="green"><b>8.00 ���.</b></font><br>
				<b>11</b> ������� - <font color="green"><b>12.00 ���.</b></font><br>
				<b>12</b> ������� - <font color="green"><b>15.00 ���.</b></font><br>
                <b>13</b> ������� - <font color="green"><b>25.00 ���.</b></font>
			</center>
			<b><small><br><font color="red">�� ������ ���������� ����� ��������� ��� �����, �� ������ �������� 7% �� ����� ����������.</font></small></b>
			<?php if($sumKr != 0 || $sumEkr != 0){
				echo '<div style="float: left;">';
				echo '<br><b>�����������:</b><br> ';
				if($sumKr != 0){
					echo '<b>������: <font color="green">'.$sumKr.' ��.</font></b><br>';
				} if($sumEkr != 0){
					echo '<b>�����������: <font color="green">'.$sumEkr.' ���.</font></b>';
				}
				echo "</div>";
			}?>
		</td>

	</tr>
	<tr>
		<td colspan="2">
			<p>��������� �������� �� ����� ������ �������� � ������ IP. ��������� ��������� ����������� ������ � ���� �� ������ �� ����������� ������ ���� �� �����-���� ��� �����. ����������� ������� ������������� ������ ��� ����������� ����� �������.</p>
			<p>����������� ����� ������� ����������� ������ ������ ����, � ��� ����� ���������� � ������.</p>
		</td>
	</tr>
</table>
