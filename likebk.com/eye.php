<?
define('GAME',true);
include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

if( $u->info['admin'] > 0 ) {
	
	if(isset($_GET['test_bot'])) {
		$html = '';
		$sp = mysql_query('SELECT * FROM `files_look` WHERE `file` LIKE "%buttons.php%" GROUP BY `user`');
		while( $pl = mysql_fetch_array($sp) ) {
			$html .= '<hr><div style="background-color:red;padding:5px;color:#fff;"><b>'.$pl['user'].'</b></div><br><br>';
			$sp1 = mysql_query('SELECT `time` FROM `files_look` WHERE `file` LIKE "%buttons.php%" AND `user` = "'.$pl['user'].'" ORDER BY `time` DESC');
			while($pl1 = mysql_fetch_array($sp1) ) {
				$html .= '[ '.date('d.m.Y H:i:s',$pl1['time']).' ( '.$pl1['ip'].' ) ��������: '.($lst-$pl1['time']).']<br>';
				$lst = $pl1['time'];
			}
		}
		echo $html;
		die();
	}
	
	$ipserv = '193.70.35.218';
	
	if(isset($_GET['look_file'])) {
		echo '<b>������� � �����: <u>'.$_GET['look_file'].'</u></b> &nbsp; &nbsp; <a href="eye.php">���������</a><br><br>';
		$sp = mysql_query('SELECT * FROM `files_look` WHERE `file` = "'.mysql_real_escape_string($_GET['look_file']).'" GROUP BY `ip`');
		while( $pl = mysql_fetch_array($sp) ) {
			$x = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `files_look` WHERE `file` = "'.$pl['file'].'" AND `ip` = "'.$pl['ip'].'" LIMIT 1'));
			$x = $x[0];
			if( $ipserv == $pl['ip'] ) {
				echo '<font color="green">';
			}
			echo '<u>*&quot;'.$pl['user'].'&quot; (%ip '.$pl['ip'].')</u> (��������: '.$x.')<hr>';
			if( $ipserv == $pl['ip'] ) {
				echo '</font>';
			}
		}
	}else{
		
		$ipserv2 = $ipserv;
		$ipserv = '-1234567';
		
		if(isset($_GET['filter'])) {
			echo '<a href="?main">�������� ������ �����</a><hr>';
		}else{
			echo '<a href="?filter">�������� ���</a><hr>';
		}
		echo '<b>������� � ������:</b><br><br>';
		$sp = mysql_query('SELECT * FROM `files_look` WHERE `ip` != "'.$ipserv.'" GROUP BY `file`');
		while( $pl = mysql_fetch_array($sp) ) {
			$x = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `files_look` WHERE `file` = "'.$pl['file'].'" AND `ip` != "'.$ipserv.'" LIMIT 1'));
			$x = $x[0];
			$z = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `files_look` WHERE `file` = "'.$pl['file'].'" AND `ip` = "'.$ipserv2.'" LIMIT 1'));
			$z = $z[0];
			if( $z > 0 || isset($_GET['filter']) ) {
				echo '<u><a href="eye.php?look_file='.$pl['file'].'">'.$pl['file'].'</a></u> (��������: '.$x.')<hr>';
			}
		}
	}
}

?>