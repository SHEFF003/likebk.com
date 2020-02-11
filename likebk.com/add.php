<?

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

if(!isset($_COOKIE['root']) && $u->info['id'] != 137157205) {
	die('НЕТ ДОСТУПА');
}

if(isset($_POST['item_id'])) {
	$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($_POST['item_id']).'" OR `name` LIKE "%'.mysql_real_escape_string($_POST['item_id']).'%" LIMIT 1'));
}
if(isset($itm['id']) && !isset($_POST['back'])) {
	
	$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['usr_login']).'" OR `id` = "'.mysql_real_escape_string($_POST['usr_id']).'" ORDER BY `id` ASC LIMIT 1'));
		
	if(!isset($_POST['go'])) {
		$sp = mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($_POST['item_id']).'" OR `name` LIKE "%'.mysql_real_escape_string($_POST['item_id']).'%"');
		while( $pl = mysql_fetch_array($sp) ) {
		?>
        (#<?=$pl['id']?>) <img src="http://img.likebk.com/i/items/<?=$pl['img']?>"> <b><?=$pl['name']?> (x<?=$_POST['item_x']?>)</b> для персонажа <?=$u->microLogin($usr['id'],1)?><br><br>
        <form method="post" action="/add.php">
        <? if( $u->info['id'] != 137157205 ) { ?>
            <br>only_par: <input type="text" name="only_par" value=""><br>
        <? } ?>
            <input type="hidden" name="usr_login" value="<?=$_POST['usr_login']?>"><input type="hidden" name="usr_id" value="<?=$_POST['usr_id']?>">
            <input type="hidden" name="item_id" value="<?=$pl['id']?>"><input type="hidden" name="item_x" value="<?=$_POST['item_x']?>">
            <input type="hidden" name="go" value="1">
            <input type="submit" value="Выдать!">
        </form>
        <? echo '<hr>'; } ?>
        <form method="post" action="/add.php">
            <input type="hidden" name="usr_login" value="<?=$_POST['usr_login']?>"><input type="hidden" name="usr_id" value="<?=$_POST['usr_id']?>">
            <input type="hidden" name="item_id" value="<?=$_POST['item_id']?>"><input type="hidden" name="item_x" value="<?=$_POST['item_x']?>">
            <input type="hidden" name="back" value="1">
            <input type="submit" value="Назад">
        </form>
        <?
		die();
	}else{
		$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['usr_login']).'" OR `id` = "'.mysql_real_escape_string($_POST['usr_id']).'" ORDER BY `id` ASC LIMIT 1'));
		if(isset($usr['id'])) {
			$x = round((int)$_POST['item_x']);
			$i = $x;
			$_GET['nolog'] = true;
			while( $i > 0 ) {
				$ij = $u->addItem($itm['id'],$usr['id'],'|add_post=1');
				if( isset($_POST['only_par']) && $_POST['only_par'] != '' ) {
					$it = mysql_fetch_array(mysql_query('SELECT `id`,`data` FROM `items_users` WHERE `id` = "'.$ij.'" LIMIT 1'));
					if(isset($it['id'])) {
						$it['data'] = $u->lookStats($it['data']);
						//
						$ik = 0;
						$k = array_keys($it['data']);
						while($ik<=count($k)) {
							if( stristr($k[$ik],$_POST['only_par']) == false && stristr($k[$ik],'add') == true ) {
								unset($it['data'][$k[$ik]]);
							}
							$ik++;
						}
						//
						$it['data'] = $u->impStats($it['data']);
						mysql_query('UPDATE `items_users` SET `data` = "'.mysql_real_escape_string($it['data']).'" WHERE `id` = "'.$it['id'].'" LIMIT 1');
					}
				}
				//
				$i--;
			}
			echo '<div><b><font color="green">Предмет &quot;'.$itm['name'].' (x'.$x.')&quot; выдан персонажу &quot;'.$usr['login'].'&quot;!</font></b></div>';
		}else{
			echo '<div><b><font color="red">Пользователь не найден!</font></b></div>';
		}
	}
}

?>
<form method="post" action="/add.php">
	Логин: <input type="text" name="usr_login" value="<?=$_POST['usr_login']?>" style="width:244px;"> или ID: <input type="text" name="usr_id" value="<?=$_POST['usr_id']?>" style="width:244px;">
    <br>
    Предмет: <input type="text" name="item_id" value="<?=$_POST['item_id']?>"> Количество: <input type="text" name="item_x" value="<?=$_POST['item_x']?>">
    <input type="submit" name="Начать выдачу">
</form>

