// <?php 
// define('GAME', 1);

// //Бот ищет заявку в группы или хаот для своего уровня и подходящую ему
// include_once('_incl_data/__config.php');
// include_once('_incl_data/class/__db_connect.php');
// include_once('_incl_data/class/__user.php');
// include('_incl_data/class/__zv.php');

// $rz = 5;

// $sp = mysql_query('SELECT * FROM `zayvki` WHERE `razdel` = "'.$rz.'" AND `cancel` = "0" AND `start` = "0" AND `noart` = 0 LIMIT 10');
// while($pl = mysql_fetch_array( $sp )) {
// 	$countZv = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `zv` = "'.$pl['id'].'" LIMIT 100'));
// 	if($countZv[0] < $pl['usermax']){
// 		$pr = 0;
// 		$bot = mysql_fetch_array(mysql_query('SELECT `u`.*,`st`.* FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON `st`.`id` = `u`.`id` WHERE `u`.`pass` = "saintlucia" AND `u`.`banned` = "0" AND `u`.`battle` = "0" AND `st`.`zv`="0" AND `st`.`hpNow` > 0 AND `u`.`level` >= "'.$pl["min_lvl_1"].'" AND `u`.`level` <= "'.$pl["max_lvl_1"].'" ORDER BY RAND() LIMIT 1'));
// 		if( $pr == 0 ) {
		
// 			$go = 1;
// 			$tm = array(0,0,0);
			
// 			if( $rz == 4 ) {
				
// 				$tm1c = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `zv` = "'.$pl['id'].'" AND `team` = "1" LIMIT 1'));
// 				$tm2c = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `zv` = "'.$pl['id'].'" AND `team` = "2" LIMIT 1'));
				
// 				if($tm1c[0] < $pl['tm1max']) {						
// 					if( $pl['min_lvl_1'] <= $bot['level'] && $pl['max_lvl_1'] >= $bot['level']) {							
// 						$tm[1] = 1;							
// 					}																		
// 				}
				
// 				if($tm2c[0] < $pl['tm2max']) {						
// 					if( $pl['min_lvl_1'] <= $bot['level'] && $pl['max_lvl_1'] >= $bot['level']) {							
// 						$tm[2] = 1;							
// 					}																		
// 				}	
				
// 				$atm = 1;
// 				$tmr = 0;						
// 				if( $tm[1] == 1 && $tm[2] == 0 ) {
// 					$tmr = 1;
// 				}elseif( $tm[1] == 0 && $tm[2] == 1 ) {
// 					$tmr = 2;
// 				}else{
// 					$tmr = rand(1,2);
// 				}
				
// 				if($tmr > 0) {
// 					if($tmr == 1) {
// 						$atm = 2;
// 					}						
					
										
// 					//Логика приема заявки
// 					if( team_zv_cf($pl,$atm) > ( team_zv_cf($pl,$tmr) + $st['reting'] )*1.67 ||  ($zv['tm2max'] < $zv['tm1max']/2) || ($zv['tm1max'] < $zv['tm2max']/2) ) {
// 						//e($bot['login'].', я очкую '.$pl['id'].' , '.team_zv_cf($pl,$atm).' VS '.(team_zv_cf($pl,$tm) + $st['reting'] ).' ...');
// 						if(rand(0,100) < 90) {
// 							$go = 0;
// 						}
// 					}
// 				}
								
// 			}elseif( $rz == 5 ) {					
				
// 				if( $pl['min_lvl_1'] <= $bot['level'] && $pl['max_lvl_1'] >= $bot['level']) {							
// 					$tm[1] = 1;							
// 				}
				
// 				//Только 8-ки
// 				/*if( $bot['level'] <= 8 ) {
// 					if( $pl['min_lvl_1'] <= 8 && $pl['max_lvl_1'] <= 8) {							
// 						$tm[1] = 1;							
// 					}	
// 				}else{*/
// 					/*if( $pl['min_lvl_1'] == $bot['level'] && $pl['max_lvl_1'] == $bot['level'] ) {							
// 						$tm[1] = 1;							
// 					}	*/
// 				//}
// 			}
			
			
// 			if($go == 1 && ( $tm[1] != 0 || $tm[2] != 0 )) {
								
// 				if( $tm[1] == 1 && $tm[2] == 0 ) {
// 					$tm = 1;
// 				}elseif( $tm[1] == 0 && $tm[2] == 1 ) {
// 					$tm = 2;
// 				}else{
// 					$tm = rand(1,2);
// 				}
					
// 				if( $rz == 5 ) {
// 					$tm = 1;
// 				}
										
// 				//e($bot['login'].', принял участие в заявке #'.$pl['id'].', за команду №'.$tm.' ');
					
// 				if( $rz == 5 ) {
// 					/* считаем баланс */
// 					if($pl['tm1'] > $pl['tm2'])
// 					{
// 						$tm = 2;
// 					}elseif($z['tm1']<$z['tm2'])
// 					{
// 						$tm = 1;
// 					}else{
// 						$tm = rand(1,2);
// 					}
					
// 					$tm = rand(1,2);
					
// 					if($pl['invise']==1)
// 					{
// 						$nxtID = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `zv` = "'.$pl['id'].'"'));
// 						$nxtID = $nxtID[0];
// 						//$u->info['login2'] = 'Боец ('.($nxtID+1).')';
// 						$bot['login2'] = '';
// 					}else{
// 						$bot['login2'] = '';
// 					}
					
// 					$blnc = 100*$bot['level']+$st['reting'];
			
// 					$pl['tm'.$tm] += $blnc;
					
// 					mysql_query('UPDATE `zayvki` SET `tm1` = "'.$pl['tm1'].'", `tm2` = "'.$pl['tm2'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
						
// 				}
										
// 				if( $tm > 0 || $rz == 5 ) {
					
// 					//Принимаем участие в заявке
// 			    	mysql_query('UPDATE `stats` SET `zv` = "'.$pl['id'].'",`team` = "'.$tm.'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
// 			 	    mysql_query('UPDATE `users` SET `login2` = "'.$bot['login2'].'",`ipreg` = "8" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
// 					$bot['zv'] = $pl['id'];
// 				    $pr = $pl['id'];
					
// 				}
				
// 			} //if
			
// 		} // while
// 	}
// 	else{
// 		$pl['time'] = $pl['time'] - $pl['time_start'];
// 		mysql_query( 'UPDATE `zayvki` SET `time` = "'.$pl['time'].'" WHERE `id` = "'.$pl['id'].'"');
// 	}
// 	//sleep(rand(3, 10));
// }
// ?>