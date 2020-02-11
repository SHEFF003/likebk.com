<?
if(isset($s[1]) && $s[1] == '10/eff') {
  
  
  	$vad = array(
		'go' => true
	);
  
  	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `vars` = "obj_act'.$obj['id'].'" AND `dn` = "'.$u->info['dnow'].'" AND `uid` = '.$u->info['id'].' LIMIT 1'));
	
	 if( $vad['test1'][0] > 0 ) {
		$r = 'Ничего не произошло...';
		$vad['go'] = false;
	}
  
  if( $vad['go'] == true ) {
	  $eff = array(495,496,497,498,499);
	  
	  $eff = $eff[rand(0,count($eff)-1)];
	  
	   $ef = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = '.$eff.' LIMIT 1'));
	   
	   if(isset($ef['id2'])) {
			
			$eff_u = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `id_eff` = '.$ef['id2'].' AND `uid` = '.$u->info['id'].' AND `delete` = 0 LIMIT 1'));
			
			if(isset($eff_u['id'])) {
				
				mysql_query('UPDATE `eff_users` SET `timeUse` = '.time().' WHERE `id` = '.$eff_u['id'].' LIMIT 1');
				
				$r = 'На вас наложено заклятие: '.$ef['mname'].'';
				
			}else{
				
				$VALUES = '"'.$ef['id2'].'","'.$u->info['id'].'","'.$ef['mname'].'","'.$ef['mdata'].'","'.time().'",1,-1,"'.(time() + $ef['actionTime']).'"';
				
				mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`x`,`hod`,`endtime`) VALUES ('.$VALUES.')');
				
				$r = 'На вас наложено заклятие: '.$ef['mname'].'';
			}
			
			mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","")');
			
	   }else{
		   
		   $r = 'Эффект не найден! Сообщите Администрации';
		   
	   }
	}
}
?>