<?php
# ������ �������� ��
# ������ ����� ������� �� ������������ ������� � ������� 3 �����
# ��� ����� ��� ������ ������ 5 ����� �� ������� ��������.


# �������� IP
function getIP() {
   if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
   return $_SERVER['REMOTE_ADDR'];
}

# ��������� �������� ������������. 
/*
 *if( $_SERVER['HTTP_CF_CONNECTING_IP'] != $_SERVER['SERVER_ADDR'] && $_SERVER['HTTP_CF_CONNECTING_IP'] != '127.0.0.1' ) {	die('Hello pussy!');   }
if(getIP() != $_SERVER['SERVER_ADDR'] && getIP() != '127.0.0.1' && getIP() != '' && getIP() != '188.134.44.67') {
	die(getIP().'<br>'.$_SERVER['SERVER_ADDR']);
}
*/

define('GAME', true);
setlocale(LC_CTYPE ,"ru_RU.CP1251");

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
//include('_incl_data/class/__user.php');
//include('_incl_data/class/__dungeon.php');
 
# ������ �������.
function start() {
    # �������� ������� 0.0000
    $mtime = microtime();$mtime = explode(" ",$mtime);$tstart = $mtime[1] + $mtime[0];
    
    # �������� ���� �����.
    # � ������� ��������: ������� ����, ����������� ���� �� ����� ����, ���������� �� ����� �����, ��� ���������� � � �������� �� ��.
    $query = mysql_query(
    "SELECT
		`dn`.time_start as dn_start,
		`dn`.id as dn_id,
		`uc`.countUsers as u_count
	FROM `dungeon_now` as `dn`
	LEFT JOIN `stats` as `st` ON `st`.id = `dn`.uid
	LEFT JOIN `users` as `u` ON `u`.id = `dn`.uid
	LEFT JOIN (SELECT dnow, count(id) as countUsers FROM `stats` group by dnow ) as `uc` ON `uc`.dnow = `dn`.id
    
    WHERE
		`st`.dnow > 0 AND
		`st`.dnow != '' AND 
		`u`.online < ".(time()-10800)." AND
		`dn`.time_start < ".(time()-18000)." AND
		`dn`.time_finish = '0'
	GROUP BY `dn`.id
	ORDER BY `dn`.id DESC;"
    );

    while( $dungeon = mysql_fetch_array( $query ) ) {
		if(isset($dungeon['dn_id'])) {
			# [1] ���������� ������� � ���������� � ���������� ��� `382` ���������� ���������(���.�������)
			$users = mysql_query('SELECT `id` FROM `stats` WHERE `dnow` = "'.$dungeon['dn_id'].'" LIMIT 10');
			while( $cur = mysql_fetch_array($users) ) {
				mysql_query('UPDATE `stats` SET `dnow` = "0" WHERE `id` = "'.$cur['id'].'" LIMIT 1');
				mysql_query('UPDATE `users` SET `room` = "382" WHERE `id` = "'.$cur['id'].'" LIMIT 1');
				#echo '��������� ������ �'.$cur['id'].' � ���������� '.$dungeon['dn_id'].' � ����������� � <strong>���������� ���������</strong><br/>';
				mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$cur['id'].'" AND `dn_delete` = "1" LIMIT 1000');
				# echo '����������� �������� �������� � ������ �'.$cur['id'].' <br/>';
			}
			unset( $cur );
			# [2] ������� �������.
			mysql_query('DELETE FROM `dungeon_obj` WHERE `dn` = "'.$dungeon['dn_id'].'" AND `for_dn` = "0"');
			# echo '������� ������� � ������ �'.$dungeon['dn_id'].'<br/>';

			# [3] ������� ��������.
			mysql_query('DELETE FROM `dungeon_bots` WHERE `dn` = "'.$dungeon['dn_id'].'" AND `for_dn` = "0"');
			# echo '������� �������� � ������ �'.$dungeon['dn_id'].'<br/>';

			# [4] ������� ��������.
			mysql_query('DELETE FROM `dungeon_items` WHERE `dn` = "'.$dungeon['dn_id'].'" AND `for_dn` = "0"');
			# echo '������� �������� � ������ �'.$dungeon['dn_id'].'<br/>';

			# [5] ������� �������� (actions)
			mysql_query('DELETE FROM `dungeon_actions` WHERE `dn` = "'.$dungeon['dn_id'].'"');
			# echo '������� �������� � ������ �'.$dungeon['dn_id'].'<br/>';

			# [6] ��������� ���������� Dungeon_Now - time_finish = time();
			mysql_query('UPDATE `dungeon_now` SET `time_finish` = "'.time().'" WHERE `id` = "'.$dungeon['dn_id'].'" LIMIT 1');
			echo '������� ������ �'.$dungeon['dn_id'].'<br/><br/>';

		} else {
			echo '��� ������ ��� ���������.<br/><br/>';
		}
	}
    unset($query,$dungeon,$users);
    
	$sp = mysql_query('SELECT `id`,`dnow` FROM `stats` WHERE `dnow` > 0 AND `dnow` NOT IN ( SELECT `id` FROM `dungeon_now` )');
	while( $cur = mysql_fetch_array($sp) ) {
		//if(isset($pl['id'])) {
			# [1] ���������� ������� � ���������� � ���������� ��� `382` ���������� ���������(���.�������)
			//$users = mysql_query('SELECT `id` FROM `stats` WHERE `dnow` = "'.$pl['dn_id'].'" LIMIT 10');
			//while( $cur = mysql_fetch_array($users) ) {
				mysql_query('UPDATE `stats` SET `dnow` = "0" WHERE `id` = "'.$cur['id'].'" LIMIT 1');
				mysql_query('UPDATE `users` SET `room` = "382" WHERE `id` = "'.$cur['id'].'" LIMIT 1');
				#echo '��������� ������ �'.$cur['id'].' � ���������� '.$dungeon['dn_id'].' � ����������� � <strong>���������� ���������</strong><br/>';
				mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$cur['id'].'" AND `dn_delete` = "1" LIMIT 1000');
				# echo '����������� �������� �������� � ������ �'.$cur['id'].' <br/>';
			//}
			# [2] ������� �������.
			if( $cur['dnow'] > 0 ) {
				mysql_query('DELETE FROM `dungeon_obj` WHERE `dn` = "'.$cur['dnow'].'" AND `for_dn` = "0"');
				# echo '������� ������� � ������ �'.$dungeon['dn_id'].'<br/>';
	
				# [3] ������� ��������.
				mysql_query('DELETE FROM `dungeon_bots` WHERE `dn` = "'.$cur['dnow'].'" AND `for_dn` = "0"');
				# echo '������� �������� � ������ �'.$dungeon['dn_id'].'<br/>';
	
				# [4] ������� ��������.
				mysql_query('DELETE FROM `dungeon_items` WHERE `dn` = "'.$cur['dnow'].'" AND `for_dn` = "0"');
				# echo '������� �������� � ������ �'.$dungeon['dn_id'].'<br/>';
	
				# [5] ������� �������� (actions)
				mysql_query('DELETE FROM `dungeon_actions` WHERE `dn` = "'.$cur['dnow'].'"');
				# echo '������� �������� � ������ �'.$dungeon['dn_id'].'<br/>';
	
				# [6] ��������� ���������� Dungeon_Now - time_finish = time();
				mysql_query('UPDATE `dungeon_now` SET `time_finish` = "'.time().'" WHERE `id` = "'.$cur['dnow'].'" LIMIT 1');
			}
			
			echo '[x] ������� ������ �'.$cur['dn_id'].'<br/><br/>';

		//} else {
		//	echo '��� ������ ��� ���������.<br/><br/>';
		//}
	}
	
    $mtime = microtime();
    $mtime = explode(" ",$mtime);$mtime = $mtime[1] + $mtime[0];$totaltime = ($mtime - $tstart);
    printf ("�������� ������������� �� %f ������ !", $totaltime);
}

# ��������� ���������� ��������.
start();
