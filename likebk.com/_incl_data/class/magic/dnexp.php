<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'dnexp' ) {
	$test = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "dnexp" AND `time` > "'.(time()).'" LIMIT 1'));
	if( $u->info['align'] != 2 ) {
		if( isset($test['id']) ) {
			$u->error = '�������� �� ������, ��� '.$u->timeOut($test['time']-time());
		}else{
			//
			$dngcity = array(
				9497 => array('angelscity','������'),
				9498 => array('capitalcity','������ ������ ���������'),
				9499 => array('demonscity','���������'),
				9500 => array('abandonedplain','���� �������'),
				9501 => array('suncity','��������'),
				9502 => array('sandcity','������ ����')
			);
			//
			$dngcity = $dngcity[$itm['item_id']];
			//
			if(!isset($u->rep['id'])) {
				$u->error = '��������� ������... ���������� �����!';
			}elseif($u->rep['rep'.$dngcity[0]] == 9999) {
				$u->error = '��� ���������� ������� ��� 1 ��. ��������� � ���������� '.$dngcity[1].' ����� �������������� ���� �������!.';
			}else{
				//
				$u->addAction(time(),'dnexp','');
				//$u->error = '��� ������ �������, �������� �� ��������� ������� � ������ '.$dngcity[1].' �����.';
				$u->error = '������� ����������� ������ ������� ��������� ('.$dngcity[1].') +1000 ��.';
				$u->rep['rep'.$dngcity[0]] += 1000;
				mysql_query('UPDATE `rep` SET `rep'.$dngcity[0].'` = "'.$u->rep['rep'.$dngcity[0]].'", `nagrada` = `nagrada` + 1000 WHERE `id` = "'.$u->rep['id'].'" LIMIT 1');
				mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
			}
		}
	}else{
		$u->error = '�������� �� ����� ������������ ���� �������!';
	}
}
?>