<?

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');
include('_incl_data/class/__magic.php');

function genkey($uid) {
	$k = md5('#key'.$uid.''.date('m.Y').'');	
	return $k;
}

function genkeyday($uid) {
	$k = md5('#key'.$uid.''.date('d.m.Y').'');	
	return $k;
}

$_GET['nolog'] = true;
if(isset($_GET['gen'])) {
	echo '[ '.genkey($_GET['gen']).' | | | '.genkeyday($_GET['gen']).' ]';
}elseif(isset($_GET['key']) && ($_GET['key'] == genkey($u->info['id']) || $_GET['key'] == genkeyday($u->info['id'])) && isset($u->info['id']) ) {
	?>
    <html>
    <head>
    	<title>Плюшечная :: <?=$u->info['id']?></title>
        <script>
		function setLocation(curLoc){
			try {
			  history.pushState(null, null, curLoc);
			  return;
			} catch(e) {}
			location.hash = '#' + curLoc;
		}
		</script>
    </head>
    <body style="background-color:#E2E0E0">
        <link href="http://img.likebk.com/css/main.css" rel="stylesheet" type="text/css">
        <h4>Плюшечная: забронированный столик для персонажа <font color="black"><?=$u->microLogin($u->info['id'],1)?></font></h4><hr>
        <?
		$arr = array(10133,10131,10144,10137,10135,10130,10132,10134,10136);
		$cast = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `jad` WHERE `uid` = "'.$u->info['id'].'" AND `date` = "'.date('d.m.Y').'" LIMIT 1'));
		if( $u->info['admin'] > 0 ) {
			$cast[0] = 0;
		}
		if(isset($_GET['use'])) {
			if( $cast[0] >= 10 ) {
				echo '<div><b><font color="red">Лимит на сегодня исчерпан!</font></b></div>';
			}elseif(isset($arr[$_GET['use']])) {
				$itm = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`img` FROM `items_main` WHERE `id` = "'.$arr[$_GET['use']].'" LIMIT 1'));
				if(isset($itm['id'])) {
					$cast = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `jad` WHERE `uid` = "'.$u->info['id'].'" AND `iid` = "'.mysql_real_escape_string($_GET['use']).'" AND `date` = "'.date('d.m.Y').'" LIMIT 1'));
					if( $u->info['admin'] > 0 ) {
						$cast[0] = 0;
					}
					if( $cast[0] >= 2 ) {
						echo '<div><b><font color="red">Лимит использования &quot;'.$itm['name'].'&quot; на сегодня исчерпан!</font></b></div>';
					}else{
						//
						$ij = $u->addItem($itm['id'],$u->info['id'],'|add_post=2');
						$_GET['login'] = $u->info['login']; //на кого кастуем
						$magic->useItems($ij);
						mysql_query('INSERT INTO `jad` (`uid`,`time`,`date`,`iid`) VALUES ("'.$u->info['id'].'","'.time().'","'.date('d.m.Y').'","'.mysql_real_escape_string($_GET['use']).'")');
						mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$ij.'" LIMIT 1');
						echo '<script>setLocation("/clock.php?key='.htmlspecialchars($_GET['key']).'");</script><div><b><font color="red">Вы успешно получили плюшку &quot;'.$itm['name'].'&quot;!</font></b></div>';
						//echo '<div><i>'.$u->error.' ... '.$re.'</i></div>';
						//
					}
				}
			}
		}
		$i = 0;
		while( $i < count($arr) ) {
			$itm = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`img`,`iznosMAXi` FROM `items_main` WHERE `id` = "'.$arr[$i].'" LIMIT 1'));
			if(isset($itm['id'])) {
				$shop = mysql_fetch_array(mysql_query('SELECT `price_5`,`price_3` FROM `items_shop` WHERE `item_id` = "'.$itm['id'].'" LIMIT 1'));
				$cena = $shop['price_5'];
				if( $cena > 0 ) {
					$cena = ''.round($cena/$itm['iznosMAXi'],2).' Gold';
				}else{
					$cena = $shop['price_3'];
					$cena = ''.round($cena/$itm['iznosMAXi'],2).' Ekr';
				}
				echo '<a href="/clock.php?key='.$_GET['key'].'&use='.$i.'"><img title="#'.$itm['id'].' '.$itm['name'].' ('.$cena.')" src="http://img.likebk.com/i/items/'.$itm['img'].'"></a> ';
			}
			$i++;
		}
		?>
        <hr>
        Возможно использовать каждый каст только два раза за сутки и не более 10 кастов всего.
    </body>
    </html>
    <?
}else{
	header('location: /');
}

