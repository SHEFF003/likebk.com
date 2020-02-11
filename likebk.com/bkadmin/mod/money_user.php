<style type="text/css">
	table#tbl tr td{
		padding: 5px;
	}
</style>
<?php 
/* $dbgo = mysql_connect('localhost','root','');
mysql_select_db('crazy',$dbgo);
mysql_query('SET NAMES cp1251');*/
$dbgo = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
mysql_select_db('like_mainbd',$dbgo);
mysql_query('SET NAMES cp1251');
/*$dbgo = mysql_pconnect('136.243.33.173','likebkdbmain','S8a7E4x1');
mysql_select_db('likebkdbmain',$dbgo);
mysql_query('SET NAMES cp1251');*/

if(isset($_POST['sort'])){
	if($_POST['sort'] == 1){
		$sort = '`b`.`money2`';
	}elseif($_POST['sort'] == 2){
		$sort = '`b`.`moneyBuy`';
	}elseif($_POST['sort'] == 3){
		$sort = '`b`.`referal_money`';
	}elseif($_POST['sort'] == 4){
		$sort = '`b`.`battle_money`';
	}elseif($_POST['sort'] == 5){
		$sort = '`b`.`bonus_money`';
	}
	$bank = mysql_query('SELECT * FROM `bank` AS `b` LEFT JOIN `stats` AS `st` ON (`b`.`uid` = `st`.`id`) LEFT JOIN `users` AS `us` ON (`b`.`uid` = `us`.`id`) WHERE `st`.`bot` = "0" ORDER BY '.$sort.' DESC');	
}else{
	$bank = mysql_query('SELECT * FROM `bank` AS `b` LEFT JOIN `stats` AS `st` ON (`b`.`uid` = `st`.`id`) LEFT JOIN `users` AS `us` ON (`b`.`uid` = `us`.`id`) WHERE `st`.`bot` = "0" ORDER BY `b`.`money2` DESC');
}
echo '<h3 style="text-align:left;">Банк</h3>';
echo "<b>Отсортировать:</b></br>";
echo '<form method="post" id="MyForm"><select name="sort" onchange="document.getElementById(\'MyForm\').submit()">';
	echo ($_POST['sort'] == 1) ? '<option selected value="1">Денег</option>' : '<option value="1">Денег</option>';
	echo ($_POST['sort'] == 2) ? '<option selected value="2">Купил</option>' : '<option value="2">Купил</option>';
	echo ($_POST['sort'] == 3) ? '<option selected value="3">Заработал на рефералах</option>' : '<option value="3">Заработал на рефералах</option>';
	echo ($_POST['sort'] == 4) ? '<option selected value="4">Заработал на боях</option>' : '<option value="4">Заработал на боях</option>';
	echo ($_POST['sort'] == 5) ? '<option selected value="5">Заработал на бонусах</option>' : '<option value="5">Заработал на бонусах</option>';
echo '</select></form><br>';
echo "<table id='tbl' border='1'>
			<tr>
				<td><b>№</b></td>
				<td><b>Логин:</b></td>
				<td><b>Денег:</b></td>
				<td><b>Купил:</b></td>
				<td><b>Заработал на рефералах:</b></td>
				<td><b>Заработал на боях:</b></td>
				<td><b>Заработал на бонусах:</b></td>
			</tr>";
$count = 1;
while($money2 = mysql_fetch_array($bank)){
	if(($money2['money2'] > 1 || $money2['moneyBuy'] > 0) && $money2['admin'] == 0){
		echo '<tr><td>'.$count.'</td>';
		echo '<td>'.microLogin($money2['id'],1).'</td>';
		echo '<td>'.$money2['money2'].'</td>';
		echo '<td>'.$money2['moneyBuy'].'</td>';
		echo '<td>'.$money2['referal_money'].'</td>';
		echo '<td>'.$money2['battle_money'].'</td>';
		echo '<td>'.$money2['bonus_money'].'</td></tr>';
		$count++;
	}
}
echo "</table>";
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
		$r .= ' <b>'.$inf['login'].'</b> ['.$inf['level'].']<a target="_blank" href="/inf.php?'.$inf['id'].'"><img rel="tooltip" title="Инф. о '.$inf['login'].'" src="http://img.likebk.com/i/inf_'.$inf['cityreg'].'.gif" /></a>';	
	}else{
		// $r = '<b><i>Невидимка</i></b> [??]<a target="_blank" href="/inf.php?0"><img rel="tooltip" title="Инф. о &lt;i&&gt;Невидимка&lt;/i&gt;" src="http://img.likebk.com/i/inf_capitalcity.gif" /></a>';	
	}
	return $r;
}

?>