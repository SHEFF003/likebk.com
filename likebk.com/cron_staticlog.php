<?php

die();

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
//include('_incl_data/class/__user.php');

echo '['.date('H').']';

if( date('H') < 4 || date('H') > 10 ) {
	echo 'die';
	die();
}

if(isset($_GET['srok'])) {
	echo 'START<hr>';
	$j = 0;
	$nodel = 0;
	$html = '';
	$sp = mysql_query('SELECT `id`,`uid`,`item_id`,`time_create`,`data`,`delete` FROM `items_users` WHERE ( `data` LIKE "%srok%" OR `item_id` IN (SELECT `id` FROM `items_main` WHERE `srok` > 0) )');
	while( $pl = mysql_fetch_array($sp) ) {
		$del = 0;
		if(!isset($itmm[$pl['item_id']])) {
			$itmm[$pl['item_id']] = mysql_fetch_array(mysql_query('SELECT `srok` FROM `items_main` WHERE `id` = "'.$pl['item_id'].'" LIMIT 1'));
		}		
		if( $itmm[$pl['item_id']]['srok'] == 0 ) {
			$i++;
		}elseif( $itmm[$pl['item_id']]['srok'] + $pl['time_create'] < time() ) {
			$del++;
		}else{
			$nodel++;
		}
		if($del == 1) {
			mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
			if( $pl['delete'] == 0 ) {
			//	$html .= ''.$pl['id'].'='.$pl['uid'].'='.$pl['item_id'].'='.date('d.m.Y H:i',($itmm[$pl['item_id']]['srok'] + $pl['time_create'])).',';			
			}
			$j++;
		}
	}
	echo $html;
	echo '<hr>Удалить предметов: '.$j.' [Не удалено: '.$i.'][Еще не испортились: '.$nodel.']';
	die();
}

$j_clear = 0;

function microLogin2($bus) {
	$bus['login_BIG']  = '<b>';
	if( $bus['dealer'] == 1 ) {
		$bus['login_BIG'] .= '<img src=http://img.likebk.com/i/align/align50.gif width=12 height=15 > ';
	}
	if( $bus['align'] > 0 ) {
		$bus['login_BIG'] .= '<img src=http://img.likebk.com/i/align/align'.$bus['align'].'.gif width=12 height=15 >';
	}
	if( $bus['clan'] > 0 ) {
		$bus['login_BIG'] .= '<img src=http://img.likebk.com/i/clan/'.$bus['clan'].'.gif width=24 height=15 >';
	}
	$bus['login_BIG'] .= ''.$bus['login'].'</b>['.$bus['level'].']<a target=_blank href=/inf.php?'.$bus['id'].' ><img width=12 hiehgt=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>';
	return $bus['login_BIG'];
}

$sp = mysql_query('SELECT * FROM `battle` WHERE `time_over` > 0 AND `time_over` < "' . ( time() - 15*60 ).'" LIMIT 350');
while( $pl = mysql_fetch_array($sp) ) {
	if(!isset($_GET['test'])) {
		if(!file_exists('static_logs/btl'.$pl['id'].'_'.$pl['time_over'].'/')) {
			mkdir('static_logs/btl'.$pl['id'].'_'.$pl['time_over'].'/',0777);
		}
		//Копируем страницы
		$pmax = mysql_fetch_array(mysql_query('SELECT `id_hod`,`id` FROM `battle_logs` WHERE `battle` = "'.$pl['id'].'" ORDER BY  `id_hod` DESC  LIMIT 1'));
		$pmax = $pmax['id_hod'];
		$pmax = ceil($pmax/30);
		//
		$i = 1;
		while( $i <= $pmax ) {
			//
			$data = file_get_contents('http://likebk.com/logs.php?log='.$pl['id'].'&p='.$i.'');
			//
			$flog = fopen('static_logs/btl'.$pl['id'].'_'.$pl['time_over'].'/'.$i.'.html', "w");
			//echo 'http://likebk.com/static_logs/btl'.$pl['id'].'_'.$pl['time_over'].'/'.$i.'.html';
			if(!$flog) {
				//
			}else{
				fwrite($flog, $data); 
				fclose($flog);
			}
			//
			$i++;
		}	
		//Копируем статистику
		//
		$data = file_get_contents('http://likebk.com/logs.php?log='.$pl['id'].'&analiz=1');
		//
		$flog = fopen('static_logs/btl'.$pl['id'].'_'.$pl['time_over'].'/s.html', "w");
		if(!$flog) {
			//
		}else{
			fwrite($flog, $data); 
			fclose($flog);
		}
	}
	//
	$uids = '';
	$tms = '';
	$tml = 0;
	$wind = 0;
	$su = mysql_query('SELECT `uid`,`team`,`login`,`level`,`align` FROM `battle_users` WHERE `battle` = "'.$pl['id'].'" GROUP BY `uid` ORDER BY `team` ASC');
	while( $pu = mysql_fetch_array($su) ) {
		$uids .= '['.$pu['uid'].':'.$pu['team'].']';
		//
		if( $tml != $pu['team'] ) {
			if( $tml != 0 ) {
				$tms .= ' {против} ';
			}
			$tml = $pu['team'];
			if( $pu['team'] == $pl['team_win'] && $pl['team_win'] > 0 && $wind == 0 ) {
				$tms .= ' {win} ';
				$wind++;
			}
			$tms .= microLogin2(array(
				'id'	=> $pu['uid'],
				'align'	=> $pu['align'],
				'clan'	=> $pu['clan'],
				'login'	=> $pu['login'],
				'level'	=> $pu['level']
			));
		}else{
			$tms .= ', ' . microLogin2(array(
				'id'	=> $pu['uid'],
				'align'	=> $pu['align'],
				'clan'	=> $pu['clan'],
				'login'	=> $pu['login'],
				'level'	=> $pu['level']
			));
		}
	}
	if(isset($_GET['test'])) {
		echo '<hr>';
		echo '['.$tms.']';
	}else{
		//
		mysql_query('INSERT INTO `battle_static` ( `teams`,`team_win`,`pages`,`battle`,`time_over`,`time_start`,`path`,`uids` ) VALUES (
			"'.mysql_real_escape_string($tms).'","'.$pl['team_win'].'","'.$pmax.'","'.$pl['id'].'","'.$pl['time_over'].'","'.$pl['time_start'].'","static_logs/btl'.$pl['id'].'_'.$pl['time_over'].'/","'.$uids.'"
		) ');
		//
		//Удаляем данные...
		mysql_query('DELETE FROM `battle` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		mysql_query('DELETE FROM `battle_act` WHERE `battle` = "'.$pl['id'].'"');
		mysql_query('DELETE FROM `battle_actions` WHERE `btl` = "'.$pl['id'].'"');
		mysql_query('DELETE FROM `battle_end` WHERE `battle_id` = "'.$pl['id'].'"');
		mysql_query('DELETE FROM `battle_last` WHERE `battle_id` = "'.$pl['id'].'"');
		mysql_query('DELETE FROM `battle_logs` WHERE `battle` = "'.$pl['id'].'"');
		mysql_query('DELETE FROM `battle_stat` WHERE `battle` = "'.$pl['id'].'"');
		mysql_query('DELETE FROM `battle_users` WHERE `battle` = "'.$pl['id'].'"');
		//
		//echo 'Лог '.$pl['id'].' перенесен. Страниц: '.$pmax.'<hr>';
		//
		$j_clear++;
	}
}
//
if( $j_clear > 0 && date('H') > 2 && date('H') < 8 ) {
	mysql_query('OPTIMIZE TABLE `battle`');
	mysql_query('OPTIMIZE TABLE `battle_act`');
	mysql_query('OPTIMIZE TABLE `battle_actions`');
	mysql_query('OPTIMIZE TABLE `battle_end`');
	mysql_query('OPTIMIZE TABLE `battle_last`');
	mysql_query('OPTIMIZE TABLE `battle_logs`');
	mysql_query('OPTIMIZE TABLE `battle_stat`');
	mysql_query('OPTIMIZE TABLE `battle_users`');
}
//
?>