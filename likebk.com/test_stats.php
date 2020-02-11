<?
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');
if($u->info['admin'] == 0) {
	die();
}

$html = '';
$lvl = array();
function test_level($id) {
	$r = 0;
	$sp = mysql_query('SELECT * FROM `levels` WHERE `upLevel` <= '.$id);
	while( $pl = mysql_fetch_array($sp) ) {
		$r += $pl['ability'] + $pl['vinosl'];
	}
	return $r;
}
$sp = mysql_query('SELECT `id`,`stats`,`ability`,`upLevel` FROM `stats` WHERE `id` IN (SELECT `id` FROM `users` WHERE `real` > 0 AND `level` > 9) ORDER BY `exp` DESC');
while( $pl = mysql_fetch_array($sp) ) {
	
	$pl_x = 0;
	$rep_x = 0;
	
	$sts = explode('|',$pl['stats']);
	$st = array();
	$st2 = array();
	$i = 0; $ste = '';
	//Родные характеристики
	while($i<count($sts)) {
		$ste = explode('=',$sts[$i]);
		if(isset($ste[1])) {
			if(!isset($st[$ste[0]])) {
				$st[$ste[0]] = 0;
			}
			$st[$ste[0]]  += intval($ste[1]);		
			if(!isset($st2[$ste[0]])) {
				$st2[$ste[0]] = 0;
			}
			$st2[$ste[0]] += intval($ste[1]);
		}
		$i++;
	}
	//
	$i = 1;
	$std = '';
	while( $i <= 21 ) {
		if( (int)$st2['s'.$i] != 0 ) {
			$pl_x += (int)$st2['s'.$i];
			if( $std != '' ) {
				$std .= ' , ';
			}
			$std .= 's'.$i.' = '.(int)$st2['s'.$i].'';
		}
		$i++;
	}
	$pl_x += $pl['ability'];
	
	$ach_x = mysql_fetch_array(mysql_query('SELECT `add_stats` FROM `achiev` WHERE `uid` = "'.$pl['id'].'" LIMIT 1'));
	$ach_x = $ach_x['add_stats'];
	
	$rep_x = mysql_fetch_array(mysql_query('SELECT `add_stats` FROM `rep` WHERE `id` = "'.$pl['id'].'" LIMIT 1'));
	$rep_x = $rep_x['add_stats'];
	if(!isset($lvl[$pl['upLevel']])) {
		$lvl[$pl['upLevel']] = test_level($pl['upLevel']);
	}
	$lvl_x = $lvl[$pl['upLevel']];
	$lst = $pl_x - ($lvl_x + $rep_x + $ach_x) - 12;
	if( $lst > 0 ) {
		$html .= '<div> '.$u->microLogin($pl['id'],1).' - <b>'.$lst.'</b> статов. (Сейчас статов: '.$pl_x.' | Родных: '.$lvl_x.' , Пещерных: '.$rep_x.' , Ачивки: '.$ach_x.')</div>';
	}
}

echo 'Персонажи с баговыми статами: <br><br><br>' . $html;

?>
