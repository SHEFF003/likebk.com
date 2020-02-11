<?php
if(!defined('GAME')) { die(); }

if(isset($file) && $file[0] == 'dungeons/3/j6.php') {

  $actions = array();
  $action = explode('|', $file[1]);
  foreach($action as $value) {
    $temp = explode(':', $value);
	$actions[$temp[0]] = $temp[1];
  }
	
	if( isset($actions['attackBot']) && $actions['attackBot'] != '' ) {
		$act = mysql_fetch_array(mysql_query('SELECT `id` FROM `dungeon_actions` WHERE `uid` = "'.$u->info['id'].'" AND `dn` = "'.$u->info['dnow'].'" AND `x` = "'.$u->info['x'].'" AND `y` = "'.$u->info['y'].'" AND `vars` = "j6_dun3" LIMIT 1'));
		if(!isset($act['id'])) {
		$attackBot = array();
		if( isset($actions['left']) ) $attackBot[] = array( 'x' => (int)$u->info['x']-1, 'y' => (int)$u->info['y'] );
		if( isset($actions['right']) ) $attackBot[] = array( 'x' => (int)$u->info['x']+1, 'y' => (int)$u->info['y'] );
		if( isset($actions['top']) ) $attackBot[] = array( 'x' => (int)$u->info['x'], 'y' => (int)$u->info['y']+1 );
		if( isset($actions['bottom']) ) $attackBot[] = array( 'x' => (int)$u->info['x'], 'y' => (int)$u->info['y']-1 );
		$action = '';
		mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$u->info['x'].'","'.$u->info['y'].'","'.$u->info['id'].'","j6_dun3","atack_bot")');
		foreach ($attackBot as $temp) {
			if($action!='') $action .= ' OR ';
			$action .= '(`x` = "'.$temp['x'].'" AND `y` = "'.$temp['y'].'")';
		}
		$temp = mysql_query('SELECT * FROM `dungeon_bots` WHERE `dn` = "'.$u->info['dnow'].'" AND ('.$action.') AND `delete`=\'0\' AND `inBattle`=\'0\' LIMIT 10');
		while($t = mysql_fetch_array($temp)){ 
			if( isset($t['id_bot']) ) $d->botAtack($t,$u->info,2); 
		}
			$hp = $u->stats['hpAll']/2;
			$u->info['hpNow'] -= $hp;
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$u->info['hpNow'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			if($u->info['sex'] == 0) {
				$vad['text'] = '[img[items/trap.gif]] <b>'.$u->info['login'].'</b> угодил в ловушку оставленную одним из обитателей подземелья. <b>-'. (ceil($hp)).'HP</b>';
			}else{
				$vad['text'] = '[img[items/trap.gif]] <b>'.$u->info['login'].'</b> угодила в ловушку оставленную одним из обитателей подземелья. <b>-'. (ceil($hp)).'HP</b>';	
			}
			$d->sys_chat($vad['text']);
		
		}
	}
}