<?
if(!defined('GAME'))
{
	die();
}

if($itm['magic_inci'] == "metka" && $itm['item_id'] == 8200) {
	if($usr['online'] < time()-520 ) {
		$u->error = '�������� ��������� � �������� ���� ;)';
	}elseif($usr['atack'] > time() - 86400 ||  $usr['atack2'] > time() - 86400) {
		$u->error = '�� ���������: '.$u->microLogin($usr['id'],1).' ��� ���� �����!';
	}elseif($u->info['room'] != $usr['room']) {
		$u->error = '�� ������ ��������� � ����� �������, � ����������: '.$u->microLogin($usr['id'],1).'';
	}elseif( ($usr['room'] == 214) || ($usr['room'] == 217) || ($usr['room'] == 218) || ($usr['room'] == 219) ) {
		$u->error = '��������: '.$u->microLogin($usr['id'],1).' ��������� � ���������';
	}elseif($usr['battle'] > 0) {
		$u->error = '�������� '.$u->microLogin($usr['id'],1).' � ��������';
	}else{
		$mt = mysql_query('UPDATE `stats` SET `atack` = "'.(time() + 86400).'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
		if($mt) {
			$u->error = '�� ������� �������� ��������: "'.$itm['name'].'" �� ��������� '.$u->microLogin($usr['id'],1).'';
		}else{
			$u->error = '�� ������� �������� ��������!';
		}
	}
}elseif($itm['magic_inci'] == "metka" && $itm['item_id'] == 8201) {
	if($usr['online'] < time()-520 ) {
		$u->error = '�������� ��������� � �������� ���� ;)';
	}elseif($usr['atack'] > time() - 86400 ||  $usr['atack2'] > time() - 86400) {
		$u->error = '�� ���������: '.$u->microLogin($usr['id'],1).' ��� ���� �����!';
	}elseif($u->info['room'] != $usr['room']) {
		$u->error = '�� ������ ��������� � ����� �������, � ����������: '.$u->microLogin($usr['id'],1).'';
	}elseif( ($usr['room'] == 214) || ($usr['room'] == 217) || ($usr['room'] == 218) || ($usr['room'] == 219) ) {
		$u->error = '��������: '.$u->microLogin($usr['id'],1).' ��������� � ���������';
	}elseif($usr['battle'] > 0) {
		$u->error = '�������� '.$u->microLogin($usr['id'],1).' � ��������';
	}else{
		$mt = mysql_query('UPDATE `stats` SET `atack2` = "'.(time() + 86400).'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
		if($mt) {
			$u->error = '�� ������� �������� ��������: "'.$itm['name'].'" �� ��������� '.$u->microLogin($usr['id'],1).'';
		}else{
			$u->error = '�� ������� �������� ��������!';
		}
	}
}
?>