<?
if(!defined('GAME')) {
	die();
}
/*
	�����: ������ ����
	���������� ����� ���������� � ������� ��� ������ �� 250 ��, �� �� ���� 0
*/
$pvr = array();
if( isset($pr_tested_this) ) {
		$fx_priem = function(  $id , $at , $uid, $j_id ) {
		// -- ������ ������
		global $u, $btl;	
		//
		//��������� ������
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
		// -- ����� ������
		return $at;
	};
	unset( $pr_used_this );
}elseif( isset($pr_used_this) ) { 
	$fx_priem = function(  $id , $at , $uid, $j_id ) {
		// -- ������ ������
		global $u, $btl;	
		//
		//��������� ������
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
			$j = 0; $k = 0; $wp = 3;
			while($j < count($at['p'][$a]['atack'])) {
				if( isset($at['p'][$a]['atack'][$j]['yron']) && (
				$at['p'][$a]['atack'][$j][1] == 1 ||
				$at['p'][$a]['atack'][$j][1] == 4 ||
				$at['p'][$a]['atack'][$j][1] == 5 )) {
					if(isset($btl->info['prusenow'.$btl->stats[$btl->uids[$uid]]['u_priem'][$j_id][3].''])) {
						
					}elseif( $pvr['used'] == 0 && !isset($at['p'][$a]['priems']['kill'][$uid][$j_id]) && !isset($btl->stats[$btl->uids[$uid]]['u_priem2'][$j_id]) ) {
						$btl->info['prusenow'.$btl->stats[$btl->uids[$uid]]['u_priem'][$j_id][3].''] = true;
						//
						$btl->stats[$btl->uids[$uid]]['u_priem2'][$j_id] = true;
						$at['p'][$a]['atack'][$j]['yron']['y'] += $at['p'][$a]['atack'][$j]['yron']['bRND'];
						$at['p'][$a]['atack'][$j]['yron']['r'] -= $at['p'][$a]['atack'][$j]['yron']['bRND'];
						$at['p'][$a]['atack'][$j]['yron']['k'] += $at['p'][$a]['atack'][$j]['yron']['bRND'];
						$at['p'][$a]['atack'][$j]['yron']['m_y'] += $at['p'][$a]['atack'][$j]['yron']['bRND'];
						$at['p'][$a]['atack'][$j]['yron']['m_k'] += $at['p'][$a]['atack'][$j]['yron']['bRND'];
						//
						$btl->stats[$btl->uids[$uid]]['pza'] -= 250;
						//
						$at['p'][$a]['atack'][$j]['yron']['plog'][] = '$this->priemAddLog( '.$id.', '.$a.', '.$b.', '.$u1.', '.$u2.',
							"������ ����",
							"{tm1} '.$btl->addlt($a , 17 , $btl->users[$btl->uids[$u1]]['sex'] , NULL).'",
						'.($btl->hodID + 1).' );';						
						//
						$at['p'][$a]['atack'][$j]['yron']['used'][] = array($j_id,$uid,$pvr['used']);
						$at['p'][$a]['atack'][$j]['yron']['kill'][] = array($j_id,$uid,$pvr['kill']);
						//
						$at['p'][$a]['priems']['kill'][$uid][$j_id] = true;
						//
						mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `id` = "'.$btl->stats[$btl->uids[$uid]]['u_priem'][$j_id][3].'" AND `uid` = "'.$uid.'" LIMIT 1');
						unset($btl->stats[$btl->uids[$uid]]['u_priem'][$j_id]);
						$btl->stats[$btl->uids[$uid]]['u_priem'][$j_id] = false;
					}
				}
				$j++;
			}	
		}
		//������� �����
		// -- ����� ������
		return $at;
	};
	unset( $pr_used_this );
}else{
	//�������� ��� �����
	$this->addEffPr($pl,$id);
}
unset($pvr);
?>