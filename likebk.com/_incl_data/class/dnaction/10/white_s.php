<?
if( isset($s[1]) && $s[1] == '10/white_s' ) {
	 
	//��� ���������� ��������� � ������� $vad !
	$vad = array(
		'go' => true
	);
	$vad['test1'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `uid` = '.$u->info['id'].' AND `vars` = "obj_act'.$obj['id'].'" LIMIT 1'));
	$vad['svetlyak'] = mysql_fetch_array(mysql_query('SELECT * FROM `dungeon_actions` WHERE `dn` = "'.$u->info['dnow'].'" AND `uid` = '.$u->info['id'].' AND `vals` = "gribnica" LIMIT 1'));
	if( $vad['test1'][0] > 0 ) {
		$r = '������ �� ���������...';
		$vad['go'] = false;
	}
	
	if( $vad['go'] == true ) {
		mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$obj['x'].'","'.$obj['y'].'","'.$u->info['id'].'","obj_act'.$obj['id'].'","'.$vad['bad'].'")');
		if(isset($vad['svetlyak']['id'])) {
			$vad['svetlyak']['vars'] .= 4;
			mysql_query('UPDATE `dungeon_actions` SET `vars` = '.$vad['svetlyak']['vars'].' WHERE `id` = '.$vad['svetlyak']['id'].' LIMIT 1');
		}
		$r = '�� ����������, ��� �� ��� ������ ���-��. �� �� �� �������� ���� �� ����� ������. ������ �� - ����� ���� ���������� ����� <���-��>. � � ����� �� ���������� ������������� ��������� ��������� �� ����... ��� �� ����.';
	}
	
	unset($vad);
}

?>