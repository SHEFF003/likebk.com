<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Изворотливость
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
			$j = 0; $k = 0; $wp = 3;
			while($j < count($at['p'][$a]['atack'])) {
				if(
					!isset($at['p'][$a]['atack'][$j]['priem_used']) &&
					( $at['p'][$a]['atack'][$j][1] > 0 )				
				) {
					if(/* $btl->stats[$btl->uids[$u1]]['nopryh_act'] < 1 хуй знает для чего &&*/ $pvr['used'] == 0 && !isset($at['p'][$a]['priems']['kill'][$uid][$j_id]) ) {
						//
							//Уворот от удара выставляем
							unset($at['p'][$a]['atack'][$j]['yron']);
							
							$at['p'][$a]['atack'][$j][1] = 2;
							
							
							
							
							//$at = $btl->priemsTestRazmen($id,$at);
							//						
							$at['p'][$a]['atack'][$j]['yron']['plog'][] = '$this->deleffm(369,'.(0+$uid).','.$btl->stats[$btl->uids[$uid]]['u_priem'][$j_id][3].');';
							//
							$at['p'][$a]['atack'][$j]['yron']['used'][] = array($j_id,$uid,$pvr['used']);
							$at['p'][$a]['atack'][$j]['yron']['kill'][] = array($j_id,$uid,$pvr['kill']);
							//
							$at['p'][$a]['priems']['kill'][$uid][$j_id] = true;
							$at['p'][$a]['atack'][$j]['priem_used'] = $id;
							//
							//if( $btl->testRazmenblock1($id,$u2,$u1,$pvr['rnd_a']) == false ) {
								$at = $this->yronRazmen($id,$at,true);
							//}
							//
						}
						//
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
	if(isset($btl->info)) {
		$this->addEffPr($pl,$id);
	}else{
		$fx_moment = function($u2,$u1,$j,$yron,$profil) {
			return $yron;
		};
	}
}
unset($pvr);
?>