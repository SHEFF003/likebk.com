<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Разведка боем
	Показывает все активные приемы на противнике 5 ходов
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
		global $u, $btl, $priem;	
		//
		//Параметры приема
		$pvr['used'] = 0;
		//		
		$uid1 = $btl->atacks[$id]['uid2'];
		$uid2 = $btl->atacks[$id]['uid1'];	
		//echo '['.$uid1.'|'.$uid2.'|*'.$uid.'*]';		
		if( $uid == $uid1 ) {
			$a = 1;
			$b = 2;
			$u1 = ${'uid1'};
			$u2 = ${'uid2'};
			$uid1 = $btl->atacks[$id]['uid1'];
			$uid2 = $btl->atacks[$id]['uid2'];
		}elseif( $uid == $uid2 ) {
			$a = 2;
			$b = 1;
			$u1 = ${'uid2'};
			$u2 = ${'uid1'};
			$uid1 = $btl->atacks[$id]['uid2'];
			$uid2 = $btl->atacks[$id]['uid1'];
		}
		if( $a > 0 ) {
			$j = 0; $k = 0; $wp = 3;
			while($j < count($at['p'][$b]['atack'])) {
				/*if( isset($at['p'][$a]['atack'][$j]['yron']) && (
				$at['p'][$b]['atack'][$j][1] == 1 ||
				$at['p'][$b]['atack'][$j][1] == 4 ||
				$at['p'][$b]['atack'][$j][1] == 5 ))
				{*/
					if( $pvr['used'] == 0 && !isset($at['p'][$b]['priems']['kill'][$uid][$j_id]) ) {
						//
						$btl->priemAddLogFast( $uid2, 0, "Разведка боем",
							'{tm1} '.$btl->addlt(1 , 17 , $btl->users[$btl->uids[$uid2]]['sex'] , NULL).'',
						1, time() );					
						//
						mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `id` = "'.$btl->stats[$btl->uids[$uid2]]['u_priem'][$j_id][3].'" AND `uid` = "'.$uid2.'" LIMIT 1');
						//unset($btl->stats[$btl->uids[$uid2]]['u_priem'][$j_id]);
						//
						$btl->laterScript .= '$priem->addPriem('.$uid1.',238,\'add_seeAllEff=1\',0,77,4,'.$uid2.',5,\'разведкабоем\',0,0,0,0,0,1);';
						//
						$at['p'][$b]['priems']['kill'][$uid][$j_id] = true;
						//
					}
				/*}*/
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