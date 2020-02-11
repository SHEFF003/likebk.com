<?php
if(!defined('GAME')) { die(); }

if(isset($file) && $file[0] == 'dungeons/trap_rand_hp.php') {
 // echo '<input type="button" value="ќбновить" onclick="location =\''.$_SERVER['REQUEST_URI'].'\';" /> &nbsp;¬ы должны быть перемещены, но портал еще не работает. ';
  $actions = array();
  $action = explode('|', $file[1]);
  foreach($action as $value) {
    $temp = explode(':', $value);
	$actions[$temp[0]] = $temp[1];
  }
   $actions2 = array();
  $action2 = explode('|', $file[1]);
  foreach($action2 as $value2) {
    $temp2 = explode(':', $value2);
	$actions2[$temp2[0]] = $temp2[1];
  }
  if(isset($actions['min'],$actions2['max'])) {
	  $hpRand = mysql_fetch_array(mysql_query('SELECT `id` FROM `dungeon_actions` WHERE `uid` = "'.$u->info['id'].'" AND `dn` = "'.$u->info['dnow'].'" AND `x` = "'.$u->info['x'].'" AND `y` = "'.$u->info['y'].'" AND `vars` = "trap_hpRand" LIMIT 1'));
	  if(!isset($hpRand['id'])) {
		 $hp = rand($actions['min'],$actions2['max']);
		  $u->info['hpNow'] -= $hp;
		  if($u->info['hpNow'] < 1) {
			  mysql_query('INSERT INTO `dungeon_actions` (`dn`,`x`,`y`,`time`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.$u->info['x'].'","'.$u->info['y'].'","'.time().'","'.$u->info['id'].'","die","")');
			  mysql_query('UPDATE `stats` SET `hpNow` = "'.$u->info['hpNow'].'",`x` = "'.$u->info['res_x'].'", `y` = "'.$u->info['res_y'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		  }else{
			 mysql_query('UPDATE `stats` SET `hpNow` = "'.$u->info['hpNow'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		  }
			mysql_query('INSERT INTO `dungeon_actions` (`dn`,`time`,`x`,`y`,`uid`,`vars`,`vals`) VALUES ("'.$u->info['dnow'].'","'.time().'","'.$u->info['x'].'","'.$u->info['y'].'","'.$u->info['id'].'","trap_hpRand","HP:'.$hp.'")');
			if($u->info['sex'] == 0) {
					$vad['text'] = '[img[items/trap.gif]] <b>'.$u->info['login'].'</b> угодил в ловушку оставленную одним из обитателей подземель€. <b>-'. $hp.'HP</b>';
				}else{
					$vad['text'] = '[img[items/trap.gif]] <b>'.$u->info['login'].'</b> угодила в ловушку оставленную одним из обитателей подземель€. <b>-'. $hp.'HP</b>';	
				}
				$d->sys_chat($vad['text']);
		}
	}
}