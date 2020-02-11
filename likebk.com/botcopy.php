<?

include('_incl_data/__config.php');
define('GAME',true);
define('OK',time());
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

if(isset($_GET['del'])) {
	mysql_query('DELETE FROM `users` WHERE `id` = "'.mysql_real_escape_string($_GET['del']).'" LIMIT 1');
	header('location: /botcopy.php');
	die();
}

$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.mysql_real_escape_string($_POST['uid']).'" LIMIT 1'));
//
$usl = mysql_fetch_array(mysql_query('SELECT `id`,`login` FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['login']).'" LIMIT 1'));
$uss = mysql_fetch_array(mysql_query('SELECT `id`,`login` FROM `users_safe` WHERE `login` = "'.mysql_real_escape_string($_POST['login']).'" LIMIT 1'));
if(isset($usl['id']) || isset($uss['id'])) {
	die('Логин &quot; '.$uss['login'].' '.$usl['login'].' &quot; занят! <a href="/botcopy.php">вернуться</a>');
}elseif(!isset($usr['id'])) {
?>
<form method="post" action="/botcopy.php">
	ID (персонаж с кого копируем): <input type="text" value="" name="uid">
    Новый логин: <input type="text" value="" name="login">
    <input type="submit" value="Создать бота">
</form>
<br><br><b style="color:maroon">Список действующих ботов:</b>
<?
	$sp = mysql_query('SELECT `id` FROM `users` WHERE `pass` = "megabot" ORDER BY `level` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		echo '<br><br><a href="/botcopy.php?del='.$pl['id'].'"><img width="13" height="13" title="Удалить бота" src="http://img.likebk.com/i/clear.gif" style="vertical-align:middle"></a> '.$u->microLogin($pl['id'],1);
	}
	die();
}

//Функция выгрузки
function copy_table($table,$pl,$without) {
	$dsp = mysql_query('SHOW COLUMNS FROM `'.$table.'`');
	while( $dpl = mysql_fetch_array($dsp) ) {
		$data[] = $dpl[0];
	}
	unset($dsp,$dpl);
	$atr = '';
	$val = '';
	$i = 0;
	while( $i < count($data) ) {
		if(isset($data[$i]) && $without != $data[$i]) {
			if($atr != '') {
				$atr .= ',';
			}
			$atr .= '`'.$data[$i].'`';
			if($val != '') {
				$val .= ',';
			}
			$val .= '"'.str_replace('"','',$pl[$data[$i]]).'"';
		}
		$i++;
	}
	$ins  = 'INSERT INTO `'.$table.'` ('.$atr.') VALUES ('.$val.')';
	mysql_query($ins);
}

//Выгружаем персонажа

//Персонаж
$usr['login'] = $_POST['login'];
$usr['name'] = '';
$usr['dviz'] = '';
$usr['hobby'] = '';
$usr['pass'] = 'megabot';
$usr['battle'] = 0;
$usr['room'] = 250;
$usr['align'] = 0;
$usr['clan'] = 0;
copy_table('users',$usr,'id');
$id = mysql_insert_id();

if( $id > 0 ) {
	
	//Характеристики
	$st = mysql_fetch_array(mysql_query('SELECT * FROM `stats` WHERE `id` = "'.$usr['id'].'" LIMIT 1'));
	$st['id'] = $id;
	$st['bot'] = 2;
	$st['zv'] = 0;
	$st['dnow'] = 0;
	copy_table('stats',$st,'no_without_colum');
		
	//Предметы
	$sp = mysql_query('SELECT * FROM `items_users` WHERE `inOdet` > 0 AND `uid` = "'.$usr['id'].'"');
	while( $pl = mysql_fetch_array($sp) ) {
		$pl['uid'] = $id;
		$pl['data'] = str_replace($usr['login'],$_POST['login'],$pl['data']);
		copy_table('items_users',$pl,'id');
	}	
	
	//эффекты
	$sp = mysql_query('SELECT * FROM `eff_users` WHERE `delete` = 0 AND `uid` = "'.$usr['id'].'" AND `name` NOT LIKE "%травма%"');
	while( $pl = mysql_fetch_array($sp) ) {
		$pl['uid'] = $id;
		$pl['timeUse'] += OK;
		$pl['sleeptime'] = 0;
		copy_table('eff_users',$pl,'id');
	}
	
	echo 'Бот '.$u->microLogin($id,1).' создан! &nbsp; <a href="/botcopy.php">вернуться</a>';
}else{
	echo 'Ошибка создания бота... ['.$usr['id'].' => '.$_POST['login'].']';
}

?>