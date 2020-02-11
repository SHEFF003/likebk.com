<?
if(!defined('GAME'))
{
	die();
}

if($st['usefromfile']=='magic2') {
	 
	 if($u->info['battle'] > 0) {
		 $id = $u->info['id'];
		if($u->info['hpNow'] > 0) {
			
			if($itm['item_id'] == 1032) {
				//живая вода
				
				$eff_users = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = '.$id.' AND `v2` = 398 AND `delete` = 0 LIMIT 1'));
			
					if(isset($eff_users['id'])) {
						mysql_query('UPDATE `eff_users` SET `hod` = 10 WHERE `id` = '.$eff_users['id'].' LIMIT 1');
						$u->error = 'Вы использовали "Живая вода"';
					}else{
						$sql = 'INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$id.'","Живая Вода","","77","'.$id.'","priem","398","invoke_kar3_lifew.gif","1","10")';
						$u->error = 'Вы использовали "Живая вода"';
					}
				}elseif($itm['item_id'] == 1034) { //мухомор
					
					$eff_users = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = '.$id.' AND `v2` = 399 AND `delete` = 0 LIMIT 1'));
			
					if(isset($eff_users['id'])) {
						mysql_query('UPDATE `eff_users` SET `hod` = 7 WHERE `id` = '.$eff_users['id'].' LIMIT 1');
						$u->error = 'Вы использовали "Сушеный Мухомор"';
					}else{
						$sql = 'INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$id.'","Сушеный Мухомор","add_m10=40|add_m11=40|add_za=-60|add_zm=-60","77","'.$id.'","priem","399","invoke_kar3_mush.gif","1","7")';
						$u->error = 'Вы использовали "Сушеный Мухомор"';
					}
					
				}
				mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$itm['id'].'" LIMIT 1');
				mysql_query($sql);
			}
		}
	
	 }else{
		 $u->error = 'Можно использовать только в поединке!';
	 }
?>