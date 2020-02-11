<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Живая Вода
*/
$pvr = array();

//Действие при клике
if( isset($pr_used_this) && isset($pr_moment) ) { 
	$fx_priem = function(  $id , $at , $uid, $j_id ) {
		// -- начало приема
		global $u, $btl;	
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
			if( $pvr['used'] == 0 && !isset($at['p'][$a]['priems']['kill'][$uid][$j_id]) ) {
				//
				$pvr['hp'] = 10;
				
				if( $pvr['hp'] < 1 ) {
					$pvr['hp'] = '--';
				}
				$btl->users[$btl->uids[$uid]]['last_hp'] = $pvr['hp'];
				//
				$btl->stats[$btl->uids[$uid]]['hpNow'] += $pvr['hp'];								
				mysql_query('UPDATE `stats` SET `last_hp` = "'.$btl->users[$btl->uids[$uid]]['last_hp'].'",`hpNow` = "'.$btl->stats[$btl->uids[$uid]]['hpNow'].'" WHERE `id` = "'.$btl->stats[$btl->uids[$uid]]['id'].'" LIMIT 1');
				//	
			$prv['text'] = '{u2} восстановил здоровье от &quot;{pr}&quot;';
			
			$prv['text2'] = '{tm1} '.$prv['text'].' <font Color=green><b> + '.$pvr['hp'].'</b></font> ['.ceil($btl->stats[$btl->uids[$uid]]['hpNow']).'/'.$btl->stats[$btl->uids[$uid]]['hpAll'].']';

			$btl->priemAddLog( $id, 1, 2, $u2, $u1,
				'<font color^^^^#'.$prv['color2'].'>Живая Вода</font>',
				$prv['text2'],
				($btl->hodID)
			);
				//
			}	
		}
		// -- конец приема
		return $at;
	};
	unset( $pr_used_this );
}else{
	//действия при клике
}

unset($pvr);
?>