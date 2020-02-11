<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Метеорит
*/
$pvr = array();
if( isset($pr_used_this) && isset($pr_moment) ) {
	//Каждый ход
	$fx_priem = function(  $id , $at , $uid, $j_id ) {
		// -- начало приема
		global $u, $btl, $priem;	
		//
		//Параметры приема
		$pvr['used'] = 0;
		//		
		$uid1 = $btl->atacks[$id]['uid1'];
		$uid2 = $btl->atacks[$id]['uid2'];			
		if( $uid == $uid1 ) {
			$a = 1;
			$b = 2;
			$u1 = ${'uid1'};
			$u2 = ${'uid2'};
		}elseif( $uid == $uid2 ) {
			$a = 2;
			$b = 1;
			$u1 = ${'uid2'};
			$u2 = ${'uid1'};
		}
		if( $a > 0 ) {
			
			//Проверяем эффект
			$prv['j_priem'] = $btl->stats[$btl->uids[$u1]]['u_priem'][$j_id][0];
			$prv['priem_th'] = $btl->stats[$btl->uids[$u1]]['effects'][$prv['j_priem']]['id'];
			
			if( $btl->stats[$btl->uids[$u1]]['effects'][$prv['j_priem']]['hod'] == 1 ) {
				//действия
				$pvr['hp'] = rand(133,233);

					
				if( $pvr['hpNow'] > $pvr['hpAll'] ) {
					$pvr['hpNow'] = $pvr['hpAll'];
				}elseif( $pvr['hpNow'] < 0 ) {
					$pvr['hpNow'] = 0;
				}
				
				$btl->stats[$btl->uids[$u1]]['hpNow'] -= $pvr['hp'];	
				$btl->users[$btl->uids[$u1]]['last_hp'] =- $pvr['hp'];	
				$pvr['hp'] = $btl->testYronPriem( $pvr['user_use'], $u1, 11, $pvr['hp'], 8, true, false, 1 );	
				mysql_query('UPDATE `stats` SET `hpNow` = "'.$btl->stats[$btl->uids[$u1]]['hpNow'].'",`last_hp` = '.$btl->users[$btl->uids[$u1]]['last_hp'].' WHERE `id` = "'.$u1.'" LIMIT 1');
				$prv['text'] = '{u2} утратил здоровье от &quot;{pr}&quot;<b><font color=green> - '.$pvr['hp'].'</font></b>';
				$pvr['hpNow'] = $btl->stats[$btl->uids[$u1]]['hpNow'];
				$pvr['hpAll'] = $btl->stats[$btl->uids[$u1]]['hpAll'];
				$prv['text2'] = '{tm1} '.$prv['text'].'. <font Color=green><b>'.$pvr['hpSee'].'</b></font> ['.$pvr['hpNow'].'/'.$pvr['hpAll'].']';
				$prv['xx'] = '';

				$btl->priemAddLog( $id, 1, 2, $pvr['user_use'], $u1,'<font color^^^^#'.$prv['color2'].'>Метеорит'.$prv['xx'].'</font>',$prv['text2'],($btl->hodID)
				);
			}
		}
		// -- конец приема
		return $at;
	};
	unset( $pr_used_this );
}

unset($pvr);
?>