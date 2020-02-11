<?
if(!defined('GAME'))
{
	die();
}

if($st['usefromfile']=='magic3') {
	 
	 if($u->info['battle'] > 0) {
		$id = $u->info['id'];
		if($u->info['hpNow'] > 0) {
			
			$tst = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `item_heal` WHERE `item_id` = "'.$itm['id'].'" AND `date` = "'.date('d.m.Y').'" LIMIT 1'));
			$tst = $tst[0];
			
			if( $btl->info['noeff'] > 0 ) {
				$u->error = 'В этом бою нельзя использовать этот предмет!';
			}elseif( $tst >= 2 ) {
				$u->error = 'Лимит использований исчерпан!';
			}else{
				//Хилка +1200 НР
				$lastHOD = mysql_fetch_array(mysql_query('SELECT * FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
				if(isset($lastHOD['id'])) {
					$id_hod = $lastHOD['id_hod'];
					if($lastHOD['type'] != 6) {
						$id_hod++;
					}
					$hphl = 900;
					$txt = $hphl;
					if( $txt > 0 ) {
						$txt = '+'.$txt;
					}
					$txt = '<font color=#006699>'.$txt.'</font>';
					$btl->stats[$btl->uids[$u->info['id']]]['hpNow'] += $hphl;
					if( $btl->stats[$btl->uids[$u->info['id']]]['hpNow'] > $btl->stats[$btl->uids[$u->info['id']]]['hpAll'] ) {
						$btl->stats[$btl->uids[$u->info['id']]]['hpNow'] = $btl->stats[$btl->uids[$u->info['id']]]['hpAll'];
					}
					$btl->stats[$btl->uids[$u->info['id']]]['hpNow'] = round($btl->stats[$btl->uids[$u->info['id']]]['hpNow']);
					mysql_query('UPDATE `stats` SET `hpNow` = "'.$btl->stats[$btl->uids[$u->info['id']]]['hpNow'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('INSERT INTO `item_heal` (`item_id`,`time`,`date`) VALUES ("'.$itm['id'].'","'.time().'","'.date('d.m.Y').'")');
					if($u->info['sex']==1) {
						$txt = '{u1} использовала &quot;<b>'.$itm['name'].'</b>&quot; на себя. <b>'.$txt.'</b> ['.$btl->stats[$btl->uids[$u->info['id']]]['hpNow'].'/'.$btl->stats[$btl->uids[$u->info['id']]]['hpAll'].']';
					}else{
						$txt = '{u1} использовал &quot;<b>'.$itm['name'].'</b>&quot; на себя. <b>'.$txt.'</b> ['.$btl->stats[$btl->uids[$u->info['id']]]['hpNow'].'/'.$btl->stats[$btl->uids[$u->info['id']]]['hpAll'].']';
					}
					mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.time().'","'.$u->info['battle'].'","'.($id_hod).'","{tm1} '.$txt.'","login1='.$u->info['login'].'||t1='.$u->info['team'].'||login2='.$u->info['login'].'||t2='.$u->info['team'].'||time1='.time().'","","","","","6")');
				}	
				
				$u->error = 'Вы успешно использовали предмет!<script>setTimeout("reflesh(true);",100);</script>';
				
				mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `id` = "'.$itm['id'].'" LIMIT 1');
				mysql_query($sql);
			}
		}
	
	 }else{
		 $u->error = 'Можно использовать только в поединке!';
	 }
}

echo '<font color="red"><div><b>'.$u->error.'</b></div></font>';
die();

die();

?>