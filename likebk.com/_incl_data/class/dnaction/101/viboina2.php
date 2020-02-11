<?
if( isset($s[1]) && $s[1] == '101/viboina2' ) {
	/*
		Выбоина
		* Телепортирует на необходимую клетку х 4 ,  у 26
		* Для прохода требуется 1 Линза Портала - 4298
	*/
	//Все переменные сохранять в массиве $vad !
	$vad = array(
		'go' => false
	);
	
	//Проверяем камни
	$vad['sp'] = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "4298" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inOdet` = "0" AND `inShop` = "0" AND `inTransfer` = "0" LIMIT 1'));
	if( !isset($vad['sp']['id']) ) {
		if( $vad['sp']['inGroup'] > 0 ) {
			$r = 'Предмет не должен находиться в группе';
		}else{
			$vad['pl'] = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$vad['sp']['item_id'].'" LIMIT 1'));
			$vad['go'] = true;
		}
	}
	if( $vad['go'] == true ) {
		mysql_query('UPDATE `stats` SET `x` = "4",`y` = "26",`s` = "4" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		$u->deleteItem($vad['sp']['id'],$u->info['id'],1);
		$r = 'Вы переместились при помощи  &quot;'.$vad['pl']['name'].'&quot; на другую сторону';
		echo '<script>location.href="main.php"</script>';
	}elseif( !isset($vad['sp']['id']) ) {
		$r = 'Для перемещения требуется &quot;Линза Портала&quot;';
	}
	unset($vad);
}
?>