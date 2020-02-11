<?php
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__magic.php');
include('_incl_data/class/__user.php');

if( $u->info['admin'] == 0 ) {
	die();
}

if(isset($_GET['iid'])) {
	$_POST['iid'] = $_GET['iid'];
}

if(isset($_POST['iid'])) {
	$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `id` = "'.mysql_real_escape_string($_POST['iid']).'" LIMIT 1'));
	if(!isset($itm['id'])) {
		echo '<div>ПРЕДМЕТ НЕ НАЙДЕН!</div>';
	}else{
		if(isset($_GET['del'])) {
			$itm['data'] = str_replace( str_replace('*','=',$_GET['del']) , '' , $itm['data'] );
			$itm['data'] = str_replace( '||' , '|' , $itm['data'] );	
			mysql_query('INSERT INTO `actions` (`city`,`vars`) VALUES ("char","'.$itm['id'].'")');
			mysql_query('UPDATE `items_users` SET `data` = "'.mysql_real_escape_string($itm['data']).'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
		}elseif(isset($_GET['only'])) {
			
			$_GET['only'] = explode('_',$_GET['only']);
			$_GET['only'] = $_GET['only'][1];
			
			$itm['data'] = explode('|',$itm['data']);
			$i = 0;
			while( $i < count($itm['data']) ) {
				$pos = strripos($itm['data'][$i], '_');
				if( $pos == true ) {
					$pos = strripos($itm['data'][$i], $_GET['only']);
					if( $pos == false ) {
						unset($itm['data'][$i]);
					}else{
						echo $itm['data'][$i];
					}
				}
				$i++;
			}
			$itm['data'] = implode('|',$itm['data']);
			echo $itm['data'];
			//mysql_query('UPDATE `items_users` SET `data` = "'.mysql_real_escape_string($itm['data']).'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
		}
	}
}

?>
<!doctype html>
<html>
<head>
<meta charset="windows-1251">
<title>Редактор чарок</title>
</head>

<body>

<? if(!isset($itm['id'])) { ?>
<form method="post" action="editor3.php">
	Введите ID чарки: <input type="text" name="iid" value="">
	<input type="submit" value="Редактировать">
</form>
<? }else{

echo 'Предмет ID <b>'.$itm['id'].'</b> (У игрока '.$u->microLogin($itm['uid'],1).'):<br><br>';
$data = explode('|',$itm['data']);
$i = 0;
while( $i < count($data)) {
	$data[$i] = explode('=',$data[$i]);
	$vl = explode('_',$data[$i][0]);
	echo $u->is[$vl[0]].' ('.$data[$i][0].') = '.$data[$i][1] .' <a href="/editor3.php?iid='.$itm['id'].'&del='.$data[$i][0].'*'.$data[$i][1].'">Удалить параметр</a>';
	//echo ' &nbsp; &nbsp; <a href="/editor3.php?iid='.$itm['id'].'&only='.$data[$i][0].'">Оставить тип '.$data[$i][0].'</a>';
	echo '<br>';
	$i++;
}

} ?>

</body>
</html>
