<?
if(!defined('GAME')) {
	die();
}
/*
	Прием: Чистота воды
*/
$pvr = array();
//
if( isset($this->ue['id']) ) {
	$prv['color2'] = $btl->mcolor[$btl->mname['вода']];
	$prv['text'] = $btl->addlt(1 , 18 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL);	
	$prv['text2'] = '{tm1} '.$prv['text'].'';
	$btl->priemAddLog( $id, 1, 2, $u->info['id'], $this->ue['id'],
		'<font color^^^^#'.$prv['color2'].'>Чистота Воды</font>',
		$prv['text2'],
		($btl->hodID + 0)
	);
	//
	$i = 0;
	$add_where = '';
	while( $i < count($btl->users) ) {
		if( $btl->users[$i]['team'] == $btl->users[$btl->uids[$u->info['id']]]['team'] ) {
			$add_where .= ' AND `user_use`!="'.$btl->users[$i]['id'].'"';
		}
		$i++;
	}
	
	/*
	$prv['dell'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `user_use`!= "'.$this->ue['id'].'" AND `name` != "Иммунитет к Ошеломить" AND `name` != "Статика" and `user_use`!= "'.$u->info['id'].'" and `user_use`!= "" and `delete`="0" and `uid`="'.$this->ue['id'].'" AND `v2` NOT IN (
		SELECT `id` FROM `priems` WHERE `neg` = 0
	) and `v1`="priem" '.$add_where.' ORDER BY RAND()  LIMIT 1'));
	*/
	
	$add_where .= ' AND ( `name` LIKE "%Заземление%" OR `name` LIKE "%Переохлаждение%"  OR `name` LIKE "%Пожирающее Пламя%" OR `name` LIKE "%Отравление%" OR `name` LIKE "%Цель Воды%" OR `name` LIKE "%Цель Земли%" OR `name` LIKE "%Цель Воздуха%" OR `name` LIKE "%Цель Огня%" OR `name` LIKE "%Ядовитое Облако%" ) ';
	
	$prv['dell'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `user_use` != "'.$this->ue['id'].'" AND `user_use`!= "'.$u->info['id'].'" AND `user_use`!= "" AND `delete`="0" AND `uid` = "'.$this->ue['id'].'" '.$add_where.' ORDER BY RAND()  LIMIT 1'));
	if( $prv['dell'] ) {
		$prv['dell']['priem']['id'] = $prv['dell']['id'];
		$btl->delPriem($prv['dell'],$btl->users[$btl->uids[$this->ue['id']]],99,false,$pl['name']);
	}
	//
	$this->mintr($pl);
}else{
	$cup = true;
}
//
unset($pvr);
?>