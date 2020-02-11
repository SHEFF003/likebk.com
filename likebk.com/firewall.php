<?php
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');

$server_ip = '193.70.35.218';

if(isset($_GET['list'])) {
	echo time().'<br>';
	echo shell_exec("sudo iptables -L");
	/*
	$ping = shell_exec('su');
	echo 'CONSOLE:['.$ping.']<br>';
	$ping = explode("\n",$ping);
	$i = 0;
	while( $i < count($ping) ) {
		echo $ping[$i] . '<hr>';
		$i++;
	}
	*/
}elseif(isset($_GET['banned'])) {
	$ip = explode('.',$_GET['banned']);
	$ip = intval($ip[0]).'.'.intval($ip[1]).'.'.intval($ip[2]).'.'.intval($ip[3]);
	if( $ip != '127.0.0.1' && $ip != $server_ip ) {
		shell_exec('iptables -A INPUT -s '.$ip.' -j DROP');
		shell_exec('iptables -A INPUT -s '.$ip.' -j REJECT');
		echo 'iptables -A INPUT -s '.$ip.' -j DROP<br>iptables -A INPUT -s '.$ip.' -j REJECT<br><font color="green">IP %'.$ip.' успешно заблокирован!</font>';
	}else{
		echo '<font color="red">IP %'.$ip.' является серверным!</font>';
	}
}elseif(isset($_GET['pass'])) {
	$ping = shell_exec('netstat -ntu | awk \'{print $5}\' | cut -d: -f1 | sort | uniq -c | sort -n');
	$ping = explode("\n",$ping);
	$i = 0;
	while( $i < count($ping) ) {
		$ip = explode(' ',ltrim($ping[count($ping)-$i],' '));
		$sp = mysql_query('SELECT `id`,`login`,`level`,`online`,`clan`,`align` FROM `users` WHERE `ip` = "'.mysql_real_escape_string($ip[1]).'"');
		$html = '';
		//
		while( $pl = mysql_fetch_array($sp) ) {
			$html .= '<img src="http://img.likebk.com/i/align/align'.$pl['align'].'.gif">';
			if( $pl['clan'] > 0 ) {
				$html .= '<img width="24" height="15" src="http://img.likebk.com/i/clan/'.$pl['clan'].'.gif">';
			}
			$html .= '&nbsp; <b>'.$pl['login'].'</b>['.$pl['level'].']<a href="http://likebk.com/inf.php?'.$pl['id'].'" target="_blank"><img src="http://img.likebk.com/i/inf_capitalcity.gif"></a>';
		}
		//
		$sp0 = mysql_query('SELECT `uid` FROM `logs_auth` WHERE `ip` = "'.mysql_real_escape_string($ip[1]).'" GROUP BY `uid`');
		while( $pl0 = mysql_fetch_array($sp) ) {
			$pl = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`level`,`online`,`clan`,`align` FROM `users` WHERE `id` = "'.$pl0['uid'].'" LIMIT 1'));
			if(isset($pl['id'])) {
				$html .= '<img src="http://img.likebk.com/i/align/align'.$pl['align'].'.gif">';
				if( $pl['clan'] > 0 ) {
					$html .= '<img width="24" height="15" src="http://img.likebk.com/i/clan/'.$pl['clan'].'.gif">';
				}
				$html .= '&nbsp; <b><u>'.$pl['login'].'</u></b>['.$pl['level'].']<a href="http://likebk.com/inf.php?'.$pl['id'].'" target="_blank"><img src="http://img.likebk.com/i/inf_capitalcity.gif"></a>';
			}
		}
		//
		if( $html != '' ) {
			if( $ip[1] == '127.0.0.1' || $ip[1] == $server_ip ) {
				$html = ' <font color="green">(<b>СЕРВЕР, НЕЛЬЗЯ ЗАБЛОКИРОВАТЬ</b>)</font>'.$html;
			}else{
				$html = '<a href="/firewall.php?banned='.$ip[1].'" target="_blank">ЗАБЛОКИРОВАТЬ</a> &nbsp; '.$html;
			}
			if( $ip[0] > 0 ) {
				echo '<span style="display:inline-block; padding:5px; width:150px; text-align:center;"><small>Запросов: '.$ip[0].'</small></span><span style="display:inline-block; padding:5px; width:250px; text-align:center;">%['.$ip[1].']</span> ' .$html . '';
			}
		}else{
			if( $ip[1] == '127.0.0.1' || $ip[1] == $server_ip ) {
				$html = ' <font color="green">(<b>СЕРВЕР, НЕЛЬЗЯ ЗАБЛОКИРОВАТЬ</b>)</font>'.$html;
			}else{
				$html = '<a href="/firewall.php?banned='.$ip[1].'" target="_blank">ЗАБЛОКИРОВАТЬ</a> &nbsp; '.$html;
			}
			if( $ip[0] > 0 ) {
				echo '<span style="display:inline-block; padding:5px; width:150px; text-align:center;"><small>Запросов: '.$ip[0].'</small></span><span style="display:inline-block; padding:5px; width:250px; text-align:center; background-color:red; color:white;">%['.$ip[1].']</span> не игрок '.$html;
			}
		}
		echo '<br>';
		$i++;
	}
}else{
	header('location: http://likebk.com/');
}

?>