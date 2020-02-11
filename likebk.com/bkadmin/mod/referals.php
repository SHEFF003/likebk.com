<style type="text/css">
	table#refs tr td{
		padding: 5px;
	}
</style>

<?php
$dbgo = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
mysql_select_db('like_mainbd',$dbgo);
mysql_query('SET NAMES cp1251');

echo '<h3 style="text-align:left;">Рефералы</h3>';
/*if(isset($_POST['sort'])){
	if($_POST['sort'] == 1){
		$sort = "0";
	}elseif($_POST['sort'] == 2){
		$sort = "1468497600";
	}
	$referal = mysql_query('SELECT * FROM `users` WHERE `real` = "1" AND `pass` NOT LIKE "%sainlucia%"');
}else{*/
	$referal = mysql_query('SELECT * FROM `users` WHERE `real` = "1" AND `pass` NOT LIKE "%sainlucia%"');
// }

$user_ref = mysql_query('SELECT * FROM `users` AS `u` WHERE `u`.`timereg` >= "1468497600" AND `u`.`referals` > 0 ORDER BY `u`.`referals` ASC ');
echo "<table id='refs' border='1'><tr><td>Логин:</td><td>Рефералы:</td><td>Заработал:</td></tr>";
$coun = 0;
while ($us_ref = mysql_fetch_array($user_ref)) {
	if($name == '' || $name != $us_ref['referals']){
		if($coun == 0){
			$tr = '<tr><td>'.microLogin($us_ref['referals'],1).'</td><td>';

		}else{
			$tr .=  '</td><td>Деньги: '.$sumkr.' кр.<br>Еврокредитов: '.$ekrsum.' екр.   '.$ekrekr.' екр</td></tr><tr><td>'.microLogin($us_ref['referals'],1).'</td><td>';
		}
		$ekr = mysql_fetch_array(mysql_query('SELECT `referal_money` FROM `bank` WHERE `uid` = "'.$us_ref['referals'].'"'));
		$ekrekr = $ekr['referal_money'];
		$name = $us_ref['referals'];
		$sumkr = 0;
		if($us_ref['level'] >= 8){
			$sumkr = 250;
		}
		$ekrsum = 0;
		if($us_ref['level'] == 9){
			$ekrsum = 5;
		}
		if($us_ref['level'] == 10){
			$ekrsum = 13;
		}
		if($us_ref['level'] == 11){
			$ekrsum = 25;
		}
	}else{
		if($us_ref['level'] >= 8){
			$sumkr += 250;
		}
		if($us_ref['level'] == 9){
			$ekrsum += 5;
		}
		if($us_ref['level'] == 10){
			$ekrsum += 13;
		}
		if($us_ref['level'] == 11){
			$ekrsum += 25;
		}
	}
	$tr .= microLogin($us_ref['id'],1).'<br>';

	$coun++;
}
echo $tr.'</table>';

exit();
echo "<b>Показать рефералов:</b></br>";
/*echo '<form method="post" id="MyForm"><select name="sort" onchange="document.getElementById(\'MyForm\').submit()">';
	echo ($_POST['sort'] == 2) ? '<option selected value="2">c 14.07.2016 17:00:00</option>' : '<option value="2">c 14.07.2016 17:00:00</option>';
	echo ($_POST['sort'] == 1) ? '<option selected value="1">за все время</option>' : '<option value="1">за все время</option>';
echo '</select></form><br>';*/
//$referal = mysql_query('SELECT * FROM `users` WHERE `timereg` >= "1468497600"');
echo "<table id='refs' border='1'><tr><td>Логин:</td><td>Рефералы:</td><td>Заработал:</td></tr>";
while($ref = mysql_fetch_array($referal)){
	$ekr = 0;
	$ekr = mysql_fetch_array(mysql_query('SELECT `referal_money` FROM `bank` WHERE `uid` = "'.$ref['id'].'"'));
	$t = 0;
	$sumkr = 0;
	$rfs = '';
	$refer = '';
	$rfs .= microLogin($ref['id'],1).'<br>';
	//$user_ref = mysql_query('SELECT `id`,`level` FROM `users` WHERE `referals` = "'.$ref['id'].'"');
	/*if(isset($_POST['sort'])){
		if($_POST['sort'] == 1){
			$sort = "0";
		}elseif($_POST['sort'] == 2){
			$sort = "1468497600";
		}
		$user_ref = mysql_query('SELECT `id`,`level` FROM `users` WHERE `timereg` >= '.$sort.' AND `referals` = "'.$ref['id'].'"');
	}else{*/
		$user_ref = mysql_query('SELECT `id`,`level` FROM `users` WHERE `timereg` >= "1468497600" AND `referals` = "'.$ref['id'].'"');
	// }
	while ($us_ref = mysql_fetch_array($user_ref)) {
		if($us_ref['id']){
			$t = 1;
		}
		if($us_ref['level'] >= 8){
			$sumkr += 250;
		}
		$refer .= microLogin($us_ref['id'],1).'<br>';
	}
	if($t == 1){
		echo "<tr><td>".$rfs."</td><td>".$refer."</td><td>Деньги: ".$sumkr." кр.<br>Еврокредитов: ".$ekr['referal_money']." екр.</td></tr>";
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