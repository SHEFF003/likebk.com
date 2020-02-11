<?php
if(!defined('GAME')) { die(); }

if(isset($file) && $file[0] == 'dungeons/trap_eff.php') {
  //echo '<input type="button" value="ќбновить" onclick="location =\''.$_SERVER['REQUEST_URI'].'\';" /> &nbsp;¬ы должны быть перемещены, но портал еще не работает. ';

    $actions = array();
  $action = explode('|', $file[1]);
  foreach($action as $value) {
    $temp = explode(':', $value);
	$actions[$temp[0]] = $temp[1];
  }
if(isset($actions['eff'])) {
	$trap_eff = mysql_fetch_array(mysql_query('SELECT `id` FROM `dungeon_actions` WHERE `uid` = "'.$u->info['id'].'" AND `dn` = "'.$u->info['dnow'].'" AND `x` = "'.$u->info['x'].'" AND `y` = "'.$u->info['y'].'" AND `vars` = "trap_eff" LIMIT 1'));
	if(!isset($trap_eff['id'])) {
		if($actions['eff'] == 13) { //Ћовушка дл€ горы
			$id = array(0 => 481, 1 => 482, 2 => 483, 3 => 484, 4 => 485);
			$id = $id[rand(0,count($id)-1)];
			$now_eff = mysql_fetch_array(mysql_query('SELECT `id`,`id_eff` FROM `eff_users` WHERE `uid` = '.$u->info['id'].' AND `id_eff` = '.$id.' AND `delete` = 0 LIMIT 1'));
			
			if($id == $now_eff['id_eff']) {
				mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$now_eff['id'].'"');
			}
			
				$efm = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "'.$id.'" LIMIT 1'));
				if($id == 481) {
					mysql_query('UPDATE `stats` SET `timeGo` = "'.(time()+300).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				}
				mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`) VALUES ("'.$efm['id2'].'","'.$u->info['id'].'","'.$efm['mname'].'","'.$efm['mdata'].'","'.$efm['oneType'].'","'.time().'")');
				mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$u->info['x'].'","'.$u->info['y'].'","'.$u->info['id'].'","trap_eff","eff:'.$efm['id2'].'")');
			if($u->info['sex'] == 0) {
				$vad['text'] = '[img[eff/'.$efm['img'].']] <b>'.$u->info['login'].'</b> угодил в ловушку и подцепил болезнь <b>&quot;'.$efm['mname'].'&quot</b>';
			}else{
				$vad['text'] = '[img[eff/'.$efm['img'].']] <b>'.$u->info['login'].'</b> угодила в ловушку и подцепила болезнь <b>&quot;'.$efm['mname'].'&quot</b>';
			}
			$d->sys_chat($vad['text']);
			
			}
		}
	}
}