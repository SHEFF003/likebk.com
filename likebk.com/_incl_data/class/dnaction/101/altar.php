<?
if( isset($s[1]) && $s[1] == '101/altar' ) {
	/*
		Алтарь
		* Телепортирует на необходимую клетку х -3 ,  у 7
		* Для прохода требуется 1 камень типа 881 или 878
	*/
	//Все переменные сохранять в массиве $vad !
	$vad = array(
		'go' => false
	);
	
	//Проверяем камни
	$vad['sp'] = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "878" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inOdet` = "0" AND `inShop` = "0" AND `inTransfer` = "0" LIMIT 1'));
	if( isset($vad['sp']['id']) ) {
		if( $vad['sp']['inGroup'] > 0 ) {
			$r = 'Предмет не должен находиться в группе';
		}else{
			$vad['pl'] = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$vad['sp']['item_id'].'" LIMIT 1'));
			$vad['go'] = true;
		}
	}
	if( $vad['go'] == true ) {
		mysql_query('UPDATE `stats` SET `x` = "-3",`y` = "7",`s` = "1" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		$u->deleteItem($vad['sp']['id'],$u->info['id'],1);
		$r = 'Вы растворили &quot;'.$vad['pl']['name'].'&quot; в алтаре и произошел взрыв. Алтарь переместил вас в тайную комнату';
		echo '<script>location.href="main.php"</script>';
	}elseif( !isset($vad['sp']['id']) ) {
		$r = 'Для перемещения требуется Лучистый Топаз';
	}
	unset($vad);
}
?>