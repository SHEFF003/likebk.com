<?
if(!defined('GAME')) {
	die();
}
/*
	�����: �������� ������
*/
$pvr = array();

//�������� ��� �����
$this->addEffPr($pl,$id);

$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],
	'�������� ������',
	'{tm1} '.$btl->addlt(1 , 21 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL).'',
	($btl->hodID+1)
);
echo '<font color=red><b>�� ������� ������������ ����� &quot;�������� ������&quot;</b></font>';

unset($pvr);
?>