<?
if(!defined('GAME'))
{
	die();
}
if(isset($_GET['obranimal_sel'])){
	$test = mysql_fetch_array(mysql_query('SELECT * FROM `obraz` WHERE `animal` = "1" AND (`uid` = "" OR `uid` = "'.$u->info['id'].'") AND `img` = "'.mysql_real_escape_string($_GET['obranimal_sel']).'" LIMIT 1'));
	if(!isset($test['id'])) {
		echo "<font color=red><b>Образ не найден</b><	/font>";
	}else{
		$_GET['obranimal_sel'] = str_replace('"','&quot;',$_GET['obranimal_sel']);
		$_GET['obranimal_sel'] = str_replace("'",'&quot;',$_GET['obranimal_sel']);
		$upd = mysql_query('UPDATE `users_animal` SET `img` = "'.htmlspecialchars($_GET['obranimal_sel'],NULL,'cp1251').'" WHERE `uid` = "'.$u->info['id'].'" AND `pet_in_cage` = "0" AND `delete` = "0" LIMIT 1');
		if($upd){
			echo "<font color=red><b>Вы успешно изменили образ животного</b></font>";
		}
		else{
			echo "<font color=red><b>Ошибка</b><	/font>";
		}
	}
}


?>
<table width="100%" cellspacing="0" cellpadding="0">
  <!-- <form method="post" action="main.php"> -->
    <tr>
      <td valign="top" align="left"><img src="http://img.likebk.com/i/1x1.gif" alt="" width="1" height="5" /><br />
      &nbsp;&nbsp; </td>
      <td align="center"><h3>Выбрать образ животного &quot;<? echo $u->info['login']; ?>&quot;</h3></td>
      <td valign="top" align="right">&nbsp;
        <input type="submit" onclick="location='main.php?pet=1'" value="Вернуться" />
        <br />
      </td></tr>
  <!-- </form> -->
</table>
<?
$sp = mysql_query('SELECT * FROM `obraz` WHERE `animal` = "1" AND (`uid` = "" OR `uid` = "'.$u->info['id'].'")');
while($pl = mysql_fetch_array($sp)) {
	$tr = true;
	$trd = '';
	$po = $u->lookStats($pl['tr']);
	$t = $u->items['tr'];
	$x = 0;
	if( $pl['level'] > 0 ) {
		$trd .= "\r".'&bull; Уровень персонажа: '.$pl['level'].'';
	}
	if( $pl['itm'] > 0 ) {
		$pl['itm'] = explode(',',$pl['itm']);
		$j = 0;
		$tritm = '';
		while( $j < count($pl['itm']) ) {
			$itm_id = $pl['itm'][$j];
			if( $itm_id > 0 ) {
				$itm_id = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.$itm_id.'" LIMIT 1'));
				$itm_id_true = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `item_id` = "'.$itm_id['id'].'" AND
				`delete` = 0 AND `inOdet` > 0 AND `inShop` = 0 AND `uid` = "'.$u->info['id'].'"
				LIMIT 1'));
				if(!isset($itm_id_true['id'])) {
					$tr = false;
				}
				if( $j > 0 ) {
					$tritm .= ', ';
				}
				$tritm .= '&quot;'.$itm_id['name'].'&quot;';
			}
			$j++;
		}
		if( $tritm != '' ) {
			$trd .= "\r".'&bull; Предметы: '.$tritm.'';
		}
	}
	while($x < count($t))	{
		$n = $t[$x];
		if(isset($po['tr_'.$n])) {
			$trd .= "\r".'&bull; '.$u->is[$n].': '.$po['tr_'.$n].'';
			if($po['tr_'.$n] > $u->stats[$n]) {
				$tr = false;
			}
		}
		$x++;
	}
	
	if( ($pl['tr'] == '' && $pl['itm'] == '') || $tr == true ) {
		if( $trd != '' ) {
			$trd = 'Требуется минимальное:'.$trd;
		}
		echo '<a href="main.php?obrazanimal&obranimal_sel='.$pl['img'].'&rnd='.$code.'"><img title="'.$trd.'" src="http://img.likebk.com/i/obraz/'.$pl['sex'].'/'.$pl['img'].'" width="120" height="40" /></a> ';
	}
}
?>