<?
if( isset($s[1]) && $s[1] == '101/i9' ) {
	/*
		������: ������ 
	*/
	//��� ���������� ��������� � ������� $vad !
	$vad = array(
		'go' => true
	);
	
	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `vars` = "obj_act'.$obj['id'].'" LIMIT 1'));
	
	 if( $vad['test1'][0] > 0 ) {
		$r = '���-�� ������� &quot;'.$obj['name'].'&quot; ������ ���...';
		$vad['go'] = false;
	}
	
	if( $vad['go'] == true ) {
				mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES (
			"'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","'.$vad['bad'].'"
		)');
		$rand = rand(0,1);
		if($rand == 0) {
			
		//���������� ������ 
		$vad['items'] = array(724);
		
		$vad['items'] = $vad['items'][rand(0,count($vad['items'])-1)];
		if( $vad['items'] != 0 ) {
			//����������� �������
			if( !isset($vad['dn_delete'][$vad['items']]) ) {
				$vad['dn_delete'][$vad['items']] = false;
			}
			if( $this->pickitem($obj,$vad['items'],$u->info['id'],'',$vad['dn_delete'][$vad['items']]) ) {
				$r = '�� ���������� ��������...';
			}else{
				$r = '���-�� ����� �� ���, �������� ������������...';
			}
		}else{
			$r = '�� �� ����� ������ ���������...';
		}
	}elseif($rand == 1) {
		$vad['hp_trap'] = rand(350,400);
		
		$u->info['hpNow'] -= $vad['hp_trap'];
		
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$u->info['hpNow'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		
		if($u->info['sex'] == 0) {
			$vad['text'] = '[img[items/trap.gif]] <b>'.$u->info['login'].'</b> ������ � ������� ����������� � &quot;'.$obj['name'].'&quot;. <b>-'.$vad['hp_trap'].'</b> ['.floor($u->stats['hpNow']).'/'.round($u->stats['hpAll']).']';
		}else{
			$vad['text'] = '[img[items/trap.gif]] <b>'.$u->info['login'].'</b> ������� � ������� ����������� � &quot;'.$obj['name'].'&quot;. <b>-'.$vad['hp_trap'].'</b> ['.floor($u->stats['hpNow']).'/'.round($u->stats['hpAll']).']';
		}
		$r = '�� ������� � �������...';
		$this->sys_chat($vad['text']);
	}
}
	
	unset($vad);
}
?>