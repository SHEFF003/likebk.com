<?
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

if( $u->info['admin'] > 0 ) {
	echo '<script type="text/javascript" src="/js/jquery.js"></script>';
	if(isset($_GET['return'])) {
		$t = mysql_fetch_array(mysql_query('SELECT * FROM `users_delo` WHERE `id` = "'.mysql_real_escape_string($_GET['return']).'" LIMIT 1'));
		if(isset($t['id'])) {
			$txt = $t['text'];
			$txt = explode('&quot;<font color="maroon">System.inventory</font>&quot;: Предмет &quot;<b>',$txt);
			$txt = explode('</b>&quot; [itm:62608696] был <b>выброшен</b>.',$txt[1]);
			$txt = explode(' (x',$txt[0]);
			$txt1 = explode('</b>&quot; [itm:',$txt[0]);
			if( $txt1[0] != '' ) {
				$txt = $txt1[0];
			}else{
				$txt = $txt[0];
			}
			echo '['.$txt.']';
			$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `name` = "'.mysql_real_escape_string($txt).'" LIMIT 1'));
			if(isset($itm['id'])) {
				echo '<font color="green">Предмет &quot;<b>'.$itm['name'].'</b>&quot; был выдан персонажу id '.$t['uid'].' !</font><script>window.close();</script>';
				$u->addItem($itm['id'],$t['uid'],'|rest_item_back=1');
			}else{
				echo '<font color=red>Предмет не найден!</font>';
			}
		}
		
		echo ' <a href="javascript:window.close();">Закрыть окно</a>';
		
	}elseif(isset($_GET['login']) || isset($_GET['id'])) {
		$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.mysql_real_escape_string($_GET['id']).'"'));
		if(isset($usr['id'])) {
			$sp = mysql_query('SELECT * FROM `users_delo` WHERE (`text` LIKE "%были%выброшены%" OR `text` LIKE "%был%выброшен%") AND `uid` = "'.$usr['id'].'" ORDER BY `id` ASC');
			while( $pl = mysql_fetch_array($sp) ) {
				if( !isset($_GET['date']) || date('d.m.Y',$pl['time']) == $_GET['date'] ) {
					echo '<div id="id'.$pl['id'].'"><div style="padding:5px;border-bottom:1px solid grey;"><a onClick="$(\'#id'.$pl['id'].'\').hide();" href="/admin_itemback.php?return='.$pl['id'].'" target="_blank">Восстановить</a> '.date('d.m.Y H:i:s',$pl['time']).' &nbsp; <b>%'.$pl['ip'].'</b> &nbsp; ('.$pl['text'].')</div>';
					echo '</div>';
				}
			}
		}else{
			echo 'Игрок не найден!';
		}
	}
	
}

?>