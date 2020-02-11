<?
if(!defined('GAME'))
{
	die();
}

if( $itm['magic_inci'] == 'timeout' ) {
	
	
	
	$pvr = array();
	
	//Действие при клике
	/*if( $btl->info['status'] > 0 ) {
		$u->error = 'В статусных боя запрещено изменять таймаут!';
	}else*/
	if( $u->stats['hpNow'] < 1) {
		$u->error = '<font color=red><b>Вы не можете использовать свиток, вы погибли...</b></font>';
	}elseif( isset($btl->info['id']) ) {		
		if( $btl->info['dn_id'] > 0 || $btl->info['izlom'] > 0 ) {
			$u->error = '<font color=red><b>Магия не действует в пещерах и подобных локациях...</b></font>';	
		}else{			
			//
			if( $itm['item_id'] == 7027 ) {
				$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],
					'',
					'{tm1} {u1} увеличил таймаут поединка на 1 минуту. ',
					($btl->hodID)
				);			
				$u->error = '<font color=red><b>Вы увеличили таймаут поединка на 1 минуту.</b></font>';
				$btl->info['timeout'] += 60;
			}else{
				$btl->priemAddLog( $id, 1, 2, $u->info['id'], $u->info['enemy'],
					'',
					'{tm1} {u1} уменьшил таймаут поединка на 1 минуту. ',
					($btl->hodID)
				);			
				$u->error = '<font color=red><b>Вы уменьшили таймаут поединка на 1 минуту.</b></font>';
				$btl->info['timeout'] -= 60;
			}
			//
			if( $btl->info['timeout'] > 5*60 ) {
				$btl->info['timeout'] = 5*60;
			}elseif( $btl->info['timeout'] < 1*60 ) {
				$btl->info['timeout'] = 1*60;
			}
			//	
			mysql_query('UPDATE `battle` SET `timeout` = "'.$btl->info['timeout'].'" WHERE `id` = "'.$btl->info['id'].'" LIMIT 1');
			//
			mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = '.$itm['id'].' LIMIT 1');
		}
		
	}else{
		$u->error = '<font color=red><b>Свиток возможно использовать только в бою</b></font>';
	}
	
	//Отнимаем тактики
	//$this->mintr($pl);
	
	unset($pvr);
}
?>