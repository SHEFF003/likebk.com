<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Танец лезвий
	Уворот от 1-го удара и наносите контрудар
*/
$pvr = array();
if( isset($pr_tested_this) ) {
		$fx_priem = function(  $id , $at , $uid, $j_id ) {
		// -- начало приема
		global $u, $btl;	
		//
		//Параметры приема
		$pvr['used'] = 0;
		//		
		$uid1 = $btl->atacks[$id]['uid1'];
		$uid2 = $btl->atacks[$id]['uid2'];			
		if( $uid == $uid2 ) {
			$a = 1;
			$b = 2;
			$u1 = ${'uid1'};
			$u2 = ${'uid2'};
		}elseif( $uid == $uid1 ) {
			$a = 2;
			$b = 1;
			$u1 = ${'uid2'};
			$u2 = ${'uid1'};
		}
		if( isset($at['p'][$a]['priems']['kill'][$uid][$j_id]) ) {	
				mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `id` = "'.$btl->stats[$btl->uids[$uid]]['u_priem'][$j_id][3].'" AND `uid` = "'.$uid.'" LIMIT 1');
				unset($btl->stats[$btl->uids[$uid]]['u_priem'][$j_id]);
				$btl->stats[$btl->uids[$uid]]['u_priem'][$j_id] = false;
		}
		//
		// -- конец приема
		return $at;
	};
	unset( $pr_used_this );
}elseif( isset($pr_used_this) ) { 
	$fx_priem = function(  $id , $at , $uid, $j_id ) {
		// -- начало приема
		global $u, $btl;	
		//
		//Параметры приема
		$pvr['used'] = 0;
		//			
		$uid1 = $btl->atacks[$id]['uid1'];
		$uid2 = $btl->atacks[$id]['uid2'];			
		if( $uid == $uid2 ) {
			$a = 1;
			$b = 2;
			$u1 = ${'uid1'};
			$u2 = ${'uid2'};
		}elseif( $uid == $uid1 ) {
			$a = 2;
			$b = 1;
			$u1 = ${'uid2'};
			$u2 = ${'uid1'};
		}
		if( $a > 0 ) {
			
			if($btl->users[$btl->uids[$u2]]['bot_id'] == 293) {
				$name = 'Стремительный Отпрыг';
			}else{
				$name = 'Танец Лезвий';
			}
			
			$j = 0; $k = 0; $wp = 3;
			while($j < count($at['p'][$a]['atack'])) {
				if( !isset($at['p'][$a]['atack'][$j]['priem_used']) && (
				$at['p'][$a]['atack'][$j][1] > 0 )) {
					if( $pvr['used'] == 0 && !isset($at['p'][$a]['priems']['kill'][$uid][$j_id]) ) {
						//
						//Уворот от удара выставляем
						$obrech = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE (`v2` = "204" OR `v2` = "345") AND `uid` = "'.$u1.'" AND `delete` = 0 LIMIT 1'));
						if(!isset($obrech['id'])) {
							unset($at['p'][$a]['atack'][$j]['yron']);
							$btl->stats[$btl->uids[$uid]]['noobrech'] = 1;
							$at['p'][$a]['atack'][$j][1] = 8;
							$at['p'][$a]['atack'][$j]['notactic'] = 1;
							$pvr['rnd_a'] = rand(1,5);
							if( $btl->testRazmenblock1($id,$u2,$u1,$pvr['rnd_a']) == false ) {
								//Попал
								$at['p'][$b]['atack'][] = array( $pvr['rnd_a'] , 1 , 1 , 1 );
							}else{
								//В блок
								$at['p'][$b]['atack'][] = array( $pvr['rnd_a'] , 3 , 1 , 1 );
							}
							$at = $btl->contrRestart($id,$at,1);
							//$at = $btl->priemsTestRazmen($id,$at);
							//	
							$at['p'][$a]['atack'][$j]['yron']['plog'][] = '$this->priemAddLog( '.$id.', '.$b.', '.$a.', '.$u2.', '.$u1.',
								"'.$name.'",
								"{tm1} '.$btl->addlt($b , 17 , $btl->users[$btl->uids[$u2]]['sex'] , NULL).'",
							'.($btl->hodID + 1).' );';
						}else{
							$at['p'][$a]['atack'][$j]['yron']['plog'][] = '$this->priemAddLog( '.$id.', '.$b.', '.$a.', '.$u2.', '.$u1.',
								"'.$name.'",
								"{tm1} '.$btl->addlt($b , 17 , $btl->users[$btl->uids[$u2]]['sex'] , NULL).' (Обречённостью)",
							'.($btl->hodID + 1).' );';
						}
						//
						$at['p'][$a]['atack'][$j]['yron']['used'][] = array($j_id,$uid,$pvr['used']);
						$at['p'][$a]['atack'][$j]['yron']['kill'][] = array($j_id,$uid,$pvr['kill']);
						//
						$at['p'][$a]['priems']['kill'][$uid][$j_id] = true;
						$at['p'][$a]['atack'][$j]['priem_used'] = $id;
						//
					}
				}
				$j++;
			}	
		}
		// -- конец приема
		return $at;
	};
	unset( $pr_used_this );
}else{
	//Действие при клике
	$this->addEffPr($pl,$id);
}
unset($pvr);
?>