<?
if(!defined('GAME'))
{
	die();
}



?>
<table width="100%" cellspacing="0" cellpadding="0">
  <form method="post" action="main.php">
    <tr>
      <td valign="top" align="left"><img src="http://img.likebk.com/i/1x1.gif" alt="" width="1" height="5" /><br />
      &nbsp;&nbsp; </td>
      <td align="center"><h3>������� ����� ��������� &quot;<? echo $u->info['login']; ?>&quot;</h3></td>
      <td valign="top" align="right">&nbsp;
        <input type="submit" name="edit" value="���������" />
        <br />
      </td></tr>
  </form>
</table>
<?
$sp = mysql_query('SELECT * FROM `obraz` WHERE `sex` = "'.$u->info['sex'].'" AND `level` <= "'.$u->info['level'].'" AND `animal` = "0" AND (`login` = "" OR `login` = "'.$u->info['login'].'") AND (`uid` = "" OR `uid` = "'.$u->info['id'].'") AND (`align` = "0" OR `align` = "'.$u->info['align'].'") AND (`clan` = "0" OR `clan` = "'.$u->info['clan'].'") ORDER BY `level` ASC, `img` ASC');
while($pl = mysql_fetch_array($sp)) {
	$tr = true;
	$trd = '';
	$po = $u->lookStats($pl['tr']);
	$t = $u->items['tr'];
	$x = 0;
	if( $pl['level'] > 0 ) {
		$trd .= "\r".'&bull; ������� ���������: '.$pl['level'].'';
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
			$trd .= "\r".'&bull; ��������: '.$tritm.'';
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
			$trd = '��������� �����������:'.$trd;
		}
		echo '<a href="main.php?inv=1&obr_sel='.$pl['id'].'&rnd='.$code.'"><img oncontextmenu="return false;" ondragstart="return false"  title="'.$trd.'" src="http://img.likebk.com/i/obraz/'.$pl['sex'].'/'.$pl['img'].'" width="120" height="220" /></a> ';
	}
}


 
?>