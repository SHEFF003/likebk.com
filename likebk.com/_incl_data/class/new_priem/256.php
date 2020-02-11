<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Скорость молнии
*/
$pvr = array();

//Действие при клике
$this->addEffPr($pl,$id);

$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],
	'Скорость Молнии',
	'{tm1} '.$btl->addlt(1 , 21 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL).'',
	($btl->hodID+1)
);
echo '<font color=red><b>Вы успешно использовали прием &quot;Скорость Молнии&quot;</b></font>';

unset($pvr);
?>