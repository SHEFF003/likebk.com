<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'cats1' ) {	
	//��� ���������� ��������� � ������� $vad !
	$vad = array(
		'go' => true
	);	
	if( $vad['go'] == true ) {
		$vad['i1'] = array(
			0 => 422,
			1 => 423,
			2 => 424,
			3 => 425
		);
		$vad['i2'] = array(
    		8227 => 'INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`) VALUES ("422","'.$u->info['id'].'","������������� ������: ��������","add_s2=5|nofastfinisheff=1|onlyOne=1","60","'.(time()-3600*2).'") ' ,
   			8228 => 'INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`) VALUES ("423","'.$u->info['id'].'","������������� ������: ����","add_s1=5|nofastfinisheff=1|onlyOne=1","61","'.(time()-3600*2).'") ' ,
   			8229 => 'INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`) VALUES ("424","'.$u->info['id'].'","������������� ������: �����������","add_speedhp=50|nofastfinisheff=1|onlyOne=1","62","'.(time()-3600*2).'") ' ,
    		8230 => 'INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`) VALUES ("425","'.$u->info['id'].'","������ �����","add_yron_max=25|nofastfinisheff=1|onlyOne=1","63","'.(time()+3600*1).'") ',
        	8232 => 'INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`) VALUES ("486","'.$u->info['id'].'","������������� ������: ������������","add_s3=5|dun3|nofastfinisheff=1|onlyOne=1","61","'.(time()-3600*2).'") ');
        
		$vad['i1'] = $itm['item_id'];
		
		if( $itm['item_id'] == 8231 ) {
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `id_eff` = "422" AND `delete` = 0');
        	mysql_query($vad['i2'][8227]);
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `id_eff` = "423" AND `delete` = 0');
        	mysql_query($vad['i2'][8228]);
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `id_eff` = "424" AND `delete` = 0');
        	mysql_query($vad['i2'][8229]);
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `id_eff` = "425" AND `delete` = 0');
        	mysql_query($vad['i2'][8230]);
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `id_eff` = "425" AND `delete` = 0');
        	mysql_query($vad['i2'][8230]);
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `id_eff` = "486" AND `delete` = 0');
        	mysql_query($vad['i2'][8232]);
		}elseif( isset($vad['i2'][$vad['i1']]) ) {
			mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `id_eff` = "'.$vad['i1'].'" AND `delete` = 0');
        	mysql_query($vad['i2'][$vad['i1']]);
			//$r = '�� ��� �������� ��������!';
		}else{
			//$r = '�� ��� �������� ��������! (������ �� ������, ��������� �������)';
		}
	}
	$u->error = '�� ������� ������������ &quot;'.$itm['name'].'&quot;.';
	mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
}
?>