<?
if(!defined('GAME')) { die(); }



$shok = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `data` LIKE "%nousepriem%" AND `delete` = 0 LIMIT 1'));

if($e['bm_a1'] == 'bot_priems1' && !isset($shok['id']) ) {
  $pr_use = 0;
  $pr_vars = array('hp_u1' => $this->users[$this->uids[$uid1]]['hpNow'], 'hp_u2' => $this->users[$this->uids[$uid2]]['hpNow']);

  if(!function_exists('rand_user_team')) {
	function rand_user_team($tm, $tp) {
	  global $btl;
	  $r = array();
	  $i = 0;
	  while($i < count($btl->users)) {
		if($btl->users[$i]['team'] == $tm && $tp == 1) {
		  $r[] = $btl->users[$i]['id'];
		} elseif($btl->users[$i]['team'] != $tm && $tp == 2) {
		  $r[] = $btl->users[$i]['id'];
		}			
		$i++;
	  }
	  if(count($r) == 0) {
		$r = 0;	
	  } else {
		$r = rand(0,count($r)-1);
	  }
	  return $r;
	}
  }
  
   if(!function_exists('roundHp')) {
  function roundHp($hAll, $hNow) {
    return intval($hNow / ($hAll / 100));
  }
}
$hp = roundHp($this->stats[$this->uids[$uid1]]['hpAll'], $this->stats[$this->uids[$uid1]]['hpNow']);


//Devils City
if($this->users[$this->uids[$uid1]]['bot_id'] == 802) {
	//разведчик
	$pr_use = 1;
	
	$rand = rand(0,1);
	
	if($rand == 1) {
		$pr_vars['priem_use'][0]['chance'] = 30;
		$pr_vars['priem_use'][0]['name'] = 'Мастер Клинков';
		$pr_vars['priem_use'][0]['id'] = 413;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}else{
		$pr_vars['priem_use'][0]['chance'] = 30;
		$pr_vars['priem_use'][0]['name'] = 'Изворотливость';
		$pr_vars['priem_use'][0]['id'] = 414;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];	
	}

	
	if(rand(0,100) <= 20) {
		
		$now = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$uid2.'" AND `v2` = 425 AND `delete` = 0 LIMIT 1'));
		
		if(!isset($now['id'])) {
			//кастуем
			$pr_vars['priem_use'][0]['chance'] = 1000;
			$pr_vars['priem_use'][0]['name'] = 'Отравленный Дротик';
			$pr_vars['priem_use'][0]['id'] = 425;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
			
			$hp = rand(125,225);
			
			if(rand(0,100) <= 30) {
				$hp*=2;
				$color = 'red';
			}else{
				$color = 'green';
			}
			
			$this->stats[$this->uids[$uid2]]['hpNow'] -= $hp;
			$this->users[$this->uids[$uid2]]['hpNow'] -= $hp;
			$this->users[$this->uids[$uid2]]['last_hp'] =- $hp;
			mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].',`last_hp` = '.$this->users[$this->uids[$uid2]]['last_hp'].' WHERE `id` = '.$this->users[$this->uids[$uid2]]['id'].' LIMIT 1');
		
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas1['text'] = '{tm1} {u1}, применил прием <b>&quot;Отравленный Дротик&quot;</b> на {u2} <font color='.$color.'><b> - '.$hp.'</font></b> ['.ceil($this->users[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			$this->add_log($mas1);
			
		}
		
		
	}
		
	$drotik = $u->testAction('`uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `vars` = "use::drotik::'.$this->info['id'].'" LIMIT 1', 1);
			
	if(!isset($drotik['id'])) {
		$pr_vars['priem_use'][0]['chance'] = 1000;
		$pr_vars['priem_use'][0]['name'] = 'Парализация';
		$pr_vars['priem_use'][0]['id'] = 415;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];	
		 
		$hp = rand(125,225);
		if(rand(0,100) <= 30) {
			$hp*=2;
			$color = 'red';
		}else{
			$color = 'green';
		}
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $hp;
		$this->users[$this->uids[$uid2]]['hpNow'] -= $hp;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $hp;
		mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].',`last_hp` = '.$this->users[$this->uids[$uid2]]['last_hp'].' WHERE `id` = '.$this->users[$this->uids[$uid2]]['id'].' LIMIT 1');
		
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas1['text'] = '{tm1} {u1}, применил прием <b>&quot;Парализующий Дротик&quot;</b> на {u2} <font color='.$color.'><b> - '.$hp.'</font></b> ['.ceil($this->users[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		$this->add_log($mas1);
		$u->addAction(time(), 'use::drotik::'.$this->info['id'], 0, $this->users[$this->uids[$uid1]]['id']);
	}
} 

if($this->users[$this->uids[$uid1]]['bot_id'] == 803) {
	$pr_use = 1; //патрульный
	$rand = rand(0,2);
	if($rand == 1) {
		$pr_vars['priem_use'][0]['chance'] = 30;
		$pr_vars['priem_use'][0]['name'] = 'Пробой Защиты';
		$pr_vars['priem_use'][0]['id'] = 422;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}elseif($rand == 2) {
		$pr_vars['priem_use'][0]['chance'] = 30;
		$pr_vars['priem_use'][0]['name'] = 'Абсолютная защита';
		$pr_vars['priem_use'][0]['id'] = 424;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}else{
		$pr_vars['priem_use'][0]['chance'] = 30;
		$pr_vars['priem_use'][0]['name'] = 'Кровожадность';
		$pr_vars['priem_use'][0]['id'] = 419;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}
	
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 804) { 
	//мародер шаман
	$pr_use = 1;
	
			$pr_vars['priem_use'][0]['chance'] = 20;
			$pr_vars['priem_use'][0]['name'] = 'Тишина';
			$pr_vars['priem_use'][0]['id'] = 416;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
			
			
	
	if($this->hodID == 4 || $this->hodID == 12 || $this->hodID == 20 || $this->hodID == 28 || $this->hodID == 36 || $this->hodID == 42 || $this->hodID == 50 || $this->hodID == 58 || $this->hodID == 64 || $this->hodID == 70 || $this->hodID == 78 || $this->hodID == 84 || $this->hodID == 90 || $this->hodID == 96 || $this->hodID == 104 || $this->hodID == 112 || $this->hodID == 120 || $this->hodID == 128 || $this->hodID == 136 || $this->hodID == 140 || $this->hodID == 148 || $this->hodID == 156 || $this->hodID == 164 || $this->hodID == 172 || $this->hodID == 180 || $this->hodID == 188 || $this->hodID == 196 || $this->hodID == 204) {
		$meteor = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = '.$this->users[$this->uids[$uid2]]['id'].' AND `v2` = 396 AND `delete` = 0 LIMIT 1'));
		if(!isset($meteor['id'])) {
			$pr_vars['priem_use'][0]['chance'] = 100;
			$pr_vars['priem_use'][0]['name'] = 'Метеорит';
			$pr_vars['priem_use'][0]['id'] = 417;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		}
	}elseif($this->hodID == 3 || $this->hodID == 6 || $this->hodID == 9 || $this->hodID == 13 || $this->hodID == 15 || $this->hodID == 18 || $this->hodID == 21 || $this->hodID == 24 || $this->hodID == 27 || $this->hodID == 30 || $this->hodID == 33 || $this->hodID == 37 || $this->hodID == 40 || $this->hodID == 43 || $this->hodID == 46 || $this->hodID == 49 || $this->hodID == 52 || $this->hodID == 55 || $this->hodID == 59 || $this->hodID == 62 || $this->hodID == 65 || $this->hodID == 68 || $this->hodID == 71) {
					$trand = rand(1,4);
					$y = rand(85,120);
					$eff = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `v2` = 144 AND `delete` = 0 LIMIT 1'));
					
					if(isset($eff['id'])) {
						$y/=2;
					}
					
					$this->stats[$this->uids[$uid2]]['hpNow'] -= $y;
					$this->users[$this->uids[$uid2]]['hpNow'] -= $y;
					$this->users[$this->uids[$uid2]]['last_hp'] =- $y;
					mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].', `last_hp` = '.$this->users[$this->uids[$uid2]]['last_hp'].' WHERE `id` = '.$this->stats[$this->uids[$uid2]]['id'].' LIMIT 1');
					if($trand == 1) $txt = ', победив страх, решил поразить {u2} заклятьем <b><font color=#008080>&quot;Штормовой Щит&quot; - '.$y.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
					elseif($trand == 2) $txt = ', нарисовав вокруг себя несколько рун, призвал заклятье <b><font color=#008080>&quot;Штормовой Щит&quot; на {u2} - '.$y.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
					elseif($trand == 3) $txt = ', догадавшись, что пришло время показать себя, произнес заклятье <b><font color=#008080>&quot;Штормовой Щит&quot; на {u2} - '.$y.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
					elseif($trand == 4) $txt = ', с испугу произнес, первое пришедшее на ум, заклятье <b><font color=#008080>&quot;Штормовой Щит&quot; на {u2} - '.$y.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
					$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
					$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
					$mas['text'] = '{tm1} {u1} '.$txt.'';
					$this->add_log($mas); 
	}elseif(rand(0,100) <= 60) {
			$use_team = rand(0,1);
			$go = rand(1,2);
			$hp = rand(101,243);
			$r1 = rand(1,3);
			if($go == 2 && rand(0,100) <= 25) {
				if($use_team == 0) {
					 $this->stats[$this->uids[$uid1]]['hpNow'] += $hp;
					 $this->users[$this->uids[$uid1]]['hpNow'] += $hp;
					 
					 if($this->users[$this->uids[$uid1]]['hpNow'] > $this->stats[$this->uids[$uid1]]['hpAll']) {
						 $this->users[$this->uids[$uid1]]['hpNow'] = $this->stats[$this->uids[$uid1]]['hpAll'];
					 }
					 
					 mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid1]]['hpNow'].' WHERE `id` = '.$this->users[$this->uids[$uid1]]['id'].' LIMIT 1');
					if($r1 == 1) $txt = 'впал в транс и начал бормотать заклятие <b><font color=bagr>&quot;Болотное заживление&quot;</font></b> на {u1} <b><font color=green> + '.$hp.'</font></b> ['.$this->users[$this->uids[$uid1]]['hpNow'].'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
					if($r1 == 2) $txt = 'очнулся от медитации, и призвал заклятье заклятье <b><font color=bagr>&quot;Болотное заживление&quot;</font></b> на {u1} <b><font color=green> + '.$hp.'</font></b> ['.$this->users[$this->uids[$uid1]]['hpNow'].'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']' ;
					else $txt = 'с испугу произнес, первое пришедшее на ум, заклятье <b><font color=bagr>&quot;Болотное заживление&quot;</font></b> на {u1} <b> <font color=green> + '.$hp.'</font></b> ['.$this->users[$this->uids[$uid1]]['hpNow'].'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
					mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$bot['id']]]['hpNow'].' WHERE `id` = '.$this->users[$this->uids[$bot['id']]]['id'].' LIMIT 1');
					$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
					$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
					$mas1['text'] = '{tm1} {u1}, '.$txt.'';
					$this->add_log($mas1);
				}else{
					$bot_team = mysql_query('SELECT `id`,`login` FROM `users` WHERE `battle` = '.$this->users[$this->uids[$uid1]]['battle'].' AND `bot_id` > 0');
					while($bot = mysql_fetch_array($bot_team)) {
							$hp = rand(101,243);
							$r1 = rand(1,3);
						if($this->users[$this->uids[$bot['id']]]['hpNow'] > 0) {
							$this->stats[$this->uids[$bot['id']]]['hpNow'] += $hp;
							$this->users[$this->uids[$bot['id']]]['hpNow'] += $hp;
					if($this->users[$this->uids[$bot['id']]]['hpNow'] > $this->stats[$this->uids[$bot['id']]]['hpAll']) {
						 $this->users[$this->uids[$bot['id']]]['hpNow'] = $this->stats[$this->uids[$bot['id']]]['hpAll'];
					 }
							if($r1 == 1) $txt = 'впал в транс и начал бормотать заклятие <b><font color=bagr>&quot;Болотное заживление&quot;</font></b> на <b><font color=bagr>&quot;'.$bot['login'].'&quot; </font><font color=green> + '.$hp.'</font></b> ['.$this->users[$this->uids[$bot['id']]]['hpNow'].'/'.$this->stats[$this->uids[$bot['id']]]['hpAll'].']';
							if($r1 == 2) $txt = 'очнулся от медитации, и призвал заклятье заклятье <b><font color=bagr>&quot;Болотное заживление&quot;</font></b> на <b><font color=bagr>&quot;'.$bot['login'].'&quot; </font><font color=green> + '.$hp.'</font></b> ['.$this->users[$this->uids[$bot['id']]]['hpNow'].'/'.$this->stats[$this->uids[$bot['id']]]['hpAll'].']' ;
							else $txt = 'с испугу произнес, первое пришедшее на ум, заклятье <b><font color=bagr>&quot;Болотное заживление&quot;</font></b> на <b><font color=bagr>&quot;'.$bot['login'].'&quot; </font><font color=green> + '.$hp.'</font></b> ['.$this->users[$this->uids[$bot['id']]]['hpNow'].'/'.$this->stats[$this->uids[$bot['id']]]['hpAll'].']';
							mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$bot['id']]]['hpNow'].' WHERE `id` = '.$this->users[$this->uids[$bot['id']]]['id'].' LIMIT 1');
							$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
							$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
							$mas1['text'] = '{tm1} {u1}, '.$txt.'';
							$this->add_log($mas1);
					}
				}
			}
		}elseif(rand(0,100) >= 50){
			$team = mysql_query('SELECT `id`,`login` FROM `users` WHERE `battle` = '.$this->users[$this->uids[$uid1]]['battle'].' AND `real` = 1');
			while($pl = mysql_fetch_array($team)) {
				if($this->users[$this->uids[$pl['id']]]['hpNow'] > 0) {
					$hp = rand(91,141);
						$this->stats[$this->uids[$pl['id']]]['hpNow'] -= $hp;
						$this->users[$this->uids[$pl['id']]]['hpNow'] -= $hp;
						$this->users[$this->uids[$pl['id']]]['last_hp'] =- $hp;
						mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$pl['id']]]['hpNow'].',`last_hp` = '.$this->users[$this->uids[$pl['id']]]['last_hp'].' WHERE `id` = '.$this->users[$this->uids[$pl['id']]]['id'].' LIMIT 1');
						$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
						$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
						$mas1['text'] = '{tm1} {u1}, с испугу произнес, первое пришедшее на ум, заклятье <b>&quot;Заряженный штормовой щит&quot;</b> на <b>&quot;'.$pl['login'].'&quot;<font color=green>- '.$hp.'</font></b> ['.ceil($this->stats[$this->uids[$pl['id']]]['hpNow']).'/'.$this->stats[$this->uids[$pl['id']]]['hpAll'].']';	
						$this->add_log($mas1);
					}
				}
			}
		}
	}

if($this->users[$this->uids[$uid1]]['bot_id'] == 805) {
	//болотный тролль
	$pr_use = 1;
	
	if(rand(0,100) <= 15) {	
		$pr_vars['priem_use'][0]['chance'] = 1000;
		$pr_vars['priem_use'][0]['name'] = 'Пробой Защиты';
		$pr_vars['priem_use'][0]['id'] = 422;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}elseif(rand(0,100) <= 20) {
		$pr_vars['priem_use'][0]['chance'] = 1000;
		$pr_vars['priem_use'][0]['name'] = 'Кровожадность';
		$pr_vars['priem_use'][0]['id'] = 419;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}elseif(rand(0,100) <= 25) {
		$pr_vars['priem_use'][0]['chance'] = 1000;
		$pr_vars['priem_use'][0]['name'] = 'Абсолютная защита';
		$pr_vars['priem_use'][0]['id'] = 140;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}else{
		$pr_vars['priem_use'][0]['chance'] = 40;
		$pr_vars['priem_use'][0]['name'] = 'Бешенство';
		$pr_vars['priem_use'][0]['id'] = 418;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		
		$hp = rand(98, 188);
		$krit = rand(0,100);
		
		if($krit <= 35) {
			$hp *= 2;
			$color = 'red';
		}else{
			$color = 'green';
		}
		if(rand(0,100) <= 5) {
			$team = mysql_query('SELECT `id`,`login` FROM `users` WHERE `battle` = '.$this->users[$this->uids[$uid1]]['battle'].' AND `real` = 1');
		while($pl = mysql_fetch_array($team)) {
			if($this->users[$this->uids[$pl['id']]]['hpNow'] > 0) {
					$this->stats[$this->uids[$pl['id']]]['hpNow'] -= $hp;
					$this->users[$this->uids[$pl['id']]]['hpNow'] -= $hp;
					$this->users[$this->uids[$pl['id']]]['last_hp'] =- $hp;
					mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$pl['id']]]['hpNow'].',`last_hp` = '.$this->users[$this->uids[$pl['id']]]['last_hp'].' WHERE `id` = '.$this->users[$this->uids[$pl['id']]]['id'].' LIMIT 1');
					$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
					$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
					$mas1['text'] = '{tm1} {u1}, применил прием <b>&quot;Взмах Дубиной&quot;</b> на персонажа <b>&quot;'.$pl['login'].'&quot;</b> <b><font color='.$color.'>- '.$hp.'</font></b> ['.ceil($this->stats[$this->uids[$pl['id']]]['hpNow']).'/'.$this->stats[$this->uids[$pl['id']]]['hpAll'].']';	
					$this->add_log($mas1);
				}
			}
		}elseif(rand(0,100) <= 5 && $hpR <= 80) {
			$pr_vars['priem_regen']['hp'] = $this->stats[$this->uids[$uid1]]['hpAll'] / 100 * 10;
		    $pr_vars['priem_regen']['chance'] = 10000;
		    $pr_vars['priem_regen']['name'] = 'Регенерация';
		}
	}
}
if($this->users[$this->uids[$uid1]]['bot_id'] == 800) {
	//голодный кровосос
	$pr_use = 1;
	
	if($this->hodID == 3 || $this->hodID == 21 || $this->hodID == 39 || $this->hodID == 57 || $this->hodID == 75 || $this->hodID == 93 || $this->hodID == 111 || $this->hodID == 129) {
		$pr_vars['priem_use'][0]['chance'] = 1000;
		$pr_vars['priem_use'][0]['name'] = 'Болотная атрофия';
		$pr_vars['priem_use'][0]['id'] = 421;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	}elseif(rand(0,100) <= 15) {
		$hp = rand(94, 164);
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $hp;
		$this->users[$this->uids[$uid2]]['hpNow'] -= $hp;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $hp;
		mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].',`last_hp` = '.$this->users[$this->uids[$uid2]]['last_hp'].' WHERE `id` = '.$this->users[$this->uids[$uid2]]['id'].' LIMIT 1');
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas1['text'] = '{tm1} {u1}, применил прием <b>&quot;Ядовитая Аура&quot;</b> на персонажа {u2} <b><font color=green>- '.$hp.'</font></b> ['.ceil($this->stats[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';	
		$this->add_log($mas1);
	}elseif(rand(0,100) >= 70) {
		$team = mysql_query('SELECT `id`,`login` FROM `users` WHERE `battle` = '.$this->users[$this->uids[$uid1]]['battle'].' AND `real` = 1');
		while($pl = mysql_fetch_array($team)) {
			$hp = $this->users[$this->uids[$pl['id']]]['hpNow'] / 100 * 10;
			$this->users[$this->uids[$pl['id']]]['hpNow'] -= $hp;
			$this->users[$this->uids[$pl['id']]]['last_hp'] =- $hp;
			$this->stats[$this->uids[$pl['id']]]['hpNow'] -= $hp;
			$this->stats[$this->uids[$uid1]]['hpNow'] += $hp/2;
			$this->users[$this->uids[$uid1]]['hpNow'] += $hp/2;
			mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid1]]['hpNow'].' WHERE `id` = '.$this->users[$this->uids[$uid1]]['id'].' LIMIT 1');
			mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$pl['id']]]['hpNow'].', `last_hp` = '.$this->users[$this->uids[$pl['id']]]['last_hp'].' WHERE `id` = '.$this->users[$this->uids[$pl['id']]]['id'].' LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas1['text'] = '{tm1} {u1}, применил прием <b>&quot;Высосать&quot;</b> на персонажа <b>&quot;<font color=bagr>'.$pl['login'].'</font>&quot;</b> <b><font color=green>- '.floor($hp).'</font></b> ['.ceil($this->stats[$this->uids[$pl['id']]]['hpNow']).'/'.$this->stats[$this->uids[$pl['id']]]['hpAll'].']';	
			$this->add_log($mas1);
		}
	}else{
		if(rand(0,100) <= 15) {
			$team = mysql_query('SELECT `id`,`login` FROM `users` WHERE `battle` = '.$this->users[$this->uids[$uid1]]['battle'].' AND `real` = 1');
			while($pl = mysql_fetch_array($team)) {
				if($this->users[$this->uids[$pl['id']]]['mpNow'] > 0 && $this->users[$this->uids[$pl['id']]]['hpNow'] > 0) {
					$mp = round($this->stats[$this->uids[$pl['id']]]['mpAll'] / 100 * 5);
					$this->stats[$this->uids[$pl['id']]]['mpNow'] -= $mp;
					$this->users[$this->uids[$pl['id']]]['mpNow'] -= $mp;
					mysql_query('UPDATE `stats` SET `mpNow` = '.$this->stats[$this->uids[$pl['id']]]['mpNow'].' WHERE `id` = '.$this->users[$this->uids[$pl['id']]]['id'].' LIMIT 1');
					$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
					$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
					$mas1['text'] = '{tm1} {u1}, применил прием <b>&quot;Воронка Отрицания&quot;</b> на персонажа <b>&quot;<font color=bagr>'.$pl['login'].'</font>&quot;</b> <b><font color=green>- '.$mp.'</font></b> ['.ceil($this->stats[$this->uids[$pl['id']]]['mpNow']).'/'.$this->stats[$this->uids[$pl['id']]]['mpAll'].']';	
					$this->add_log($mas1);
				}
			}
		}
	}
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 801) {
	//проклятье болот
	$pr_use = 1;
	
	$hp = rand(98, 188);
	$krit = rand(0,100);
	if($krit <= 50) {
		$hp *= 2;
		$color = 'red';
	}else{
		$color = 'green';
	}
	if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 70 || $this->hodID == 75 || $this->hodID == 80 || $this->hodID == 85 || $this->hodID == 90 || $this->hodID == 95 || $this->hodID == 100) {
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $hp;
		$this->users[$this->uids[$uid2]]['hpNow'] -= $hp;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $hp;
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas1['text'] = '{tm1} {u1}, применил прием <b>&quot;Пожрать&quot;</b> на персонажа {u2} <b><font color='.$color.'>- '.$hp.'</font></b> ['.ceil($this->stats[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';	
		$this->add_log($mas1);
	}elseif(rand(0,100) <= 20) {
		$pr_vars['priem_use'][0]['chance'] = 1000;
		$pr_vars['priem_use'][0]['name'] = 'Раскол Брони';
		$pr_vars['priem_use'][0]['id'] = 420;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}
}


//emeralds city

if($this->users[$this->uids[$uid1]]['bot_id'] == 715) {
		$pr_use = 1;
	if($this->hodID == 3 || $this->hodID == 9 || $this->hodID == 15 || $this->hodID == 21 || $this->hodID == 27 || $this->hodID == 23 || $this->hodID == 29 || $this->hodID == 35 || $this->hodID == 41 || $this->hodID == 47 || $this->hodID == 53 || $this->hodID == 59 || $this->hodID == 65 || $this->hodID == 71 || $this->hodID == 77 || $this->hodID == 83 || $this->hodID == 89 || $this->hodID == 95 || $this->hodID == 101 || $this->hodID == 107 || $this->hodID == 113) {
		  $pr_vars['priem_use'][0]['chance'] = 1000;
		  $pr_vars['priem_use'][0]['name'] = 'Королевский удар';
		  $pr_vars['priem_use'][0]['id'] = 138;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}elseif( ($hp <= 85) && $this->hodID == 6 || $this->hodID == 16 || $this->hodID == 26 || $this->hodID == 36 || $this->hodID == 46 || $this->hodID == 56 || $this->hodID == 66 || $this->hodID == 76 || $this->hodID == 86 || $this->hodID == 96 || $this->hodID == 106) {
		$pr_vars['priem_regen']['hp'] = 600;
		$pr_vars['priem_regen']['chance'] = 1000;
		$pr_vars['priem_regen']['name'] = 'Призрачная Боль';
	}elseif( ($hp <= 30) && ($this->hodID == 7 || $this->hodID == 18 || $this->hodID == 28 || $this->hodID == 39 || $this->hodID == 50 || $this->hodID == 62 || $this->hodID == 74 || $this->hodID == 87 || $this->hodID == 98 || $this->hodID == 109)) {
	  $pr_vars['priem_use'][0]['chance'] = 1000;
  	  $pr_vars['priem_use'][0]['name'] = 'Бесчувственность';
  	  $pr_vars['priem_use'][0]['id'] = 411;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}elseif($this->hodID == 2 || $this->hodID == 12 || $this->hodID == 22 || $this->hodID == 32 || $this->hodID == 42 || $this->hodID == 52 || $this->hodID == 63 || $this->hodID == 72 || $this->hodID == 82 || $this->hodID == 92 || $this->hodID == 102) {
			$yrn = rand(64,128);
			$this->stats[$this->uids[$uid2]]['hpNow'] -= $yrn;
			$this->users[$this->uids[$uid2]]['hpNow'] -= $yrn;
			$this->users[$this->uids[$uid2]]['last_hp'] =- $yrn;
			mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].',`last_hp` = '.$this->users[$this->uids[$uid2]]['last_hp'].' WHERE `id` = '.$this->users[$this->uids[$uid2]]['id'].' LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas1['text'] = '{tm1} {u1}, ударил {u2} с помощью приема <b>&quot;Прорыв&quot;<font color=green> - '.$yrn.'</font></b> ['.ceil($this->stats[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';	
			$this->add_log($mas1);
	}elseif(rand(0,100) <= 30) {
	  $pr_vars['priem_use'][0]['chance'] = 1000;
  	  $pr_vars['priem_use'][0]['name'] = 'Полная Защита';
  	  $pr_vars['priem_use'][0]['id'] = 45;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}else{
		if(rand(0,100) <= 25) {
		  $pr_vars['priem_use'][0]['chance'] = 1000;
		  $pr_vars['priem_use'][0]['name'] = 'Танец Лезвий';
		  $pr_vars['priem_use'][0]['id'] = 48;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]]; 
		}elseif(rand(0,100) <= 30) {
		  $pr_vars['priem_use'][0]['chance'] = 1000;
		  $pr_vars['priem_use'][0]['name'] = 'Ярость';
		  $pr_vars['priem_use'][0]['id'] = 14;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		}else{
		 $pr_vars['priem_use'][0]['chance'] = 35;
		  $pr_vars['priem_use'][0]['name'] = 'Стойкость';
		  $pr_vars['priem_use'][0]['id'] = 13;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		}
	}
}

if($this->users[$this->uids[$uid1]]['login'] == "Душа Кроггентайла") {
	
	$pr_use = 1;
	
	if($this->hodID == 6 || $this->hodID == 16 || $this->hodID == 26 || $this->hodID == 36 || $this->hodID == 46 || $this->hodID == 56 || $this->hodID == 66 || $this->hodID == 76 || $this->hodID == 86 || $this->hodID == 96 || $this->hodID == 106) {
		  $pr_vars['priem_use'][0]['chance'] = 1000;
		  $pr_vars['priem_use'][0]['name'] = 'Регенерация';
		  $pr_vars['priem_use'][0]['id'] = 412;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}elseif($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 75 || $this->hodID == 80 || $this->hodID == 85 || $this->hodID == 90 || $this->hodID == 95 || $this->hodID == 100 || $this->hodID == 105 ) {
		
		$yrn = array(8 => 200, 9 => 300, 10 => 500, 11 => 800);
		$yrn = $yrn[$this->users[$this->uids[$uid1]]['level']];
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $yrn;
		$this->users[$this->uids[$uid2]]['hpNow'] -= $yrn;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $yrn;
		mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].',`last_hp` = '.$this->users[$this->uids[$uid2]]['last_hp'].' WHERE `id` = '.$this->users[$this->uids[$uid2]]['id'].' LIMIT 1');
		 //log
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas1['text'] = '{tm1} {u1}, ударил {u2} с помощью приема <b>&quot;Темный удар&quot;<font color=green> - '.$yrn.'</font></b> ['.ceil($this->stats[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';	
		$this->add_log($mas1);
	}
}

if($this->users[$this->uids[$uid1]]['login'] == "Память Кроггентайла") {
	
	$pr_use = 1;
	
	if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 75 || $this->hodID == 80 || $this->hodID == 85 || $this->hodID == 90 || $this->hodID == 95 || $this->hodID == 100 || $this->hodID == 105 ) {
		$yrn = array(8 => 200, 9 => 300, 10 => 500, 11 => 800);
		$yrn = $yrn[$this->users[$this->uids[$uid1]]['level']];
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $yrn;
		$this->users[$this->uids[$uid2]]['hpNow'] -= $yrn;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $yrn;
		mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].',`last_hp` = '.$this->users[$this->uids[$uid2]]['last_hp'].' WHERE `id` = '.$this->users[$this->uids[$uid2]]['id'].' LIMIT 1');
		 //log
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas1['text'] = '{tm1} {u1}, ударил {u2} с помощью приема <b>&quot;Темный удар&quot;<font color=green> - '.$yrn.'</font></b> ['.ceil($this->stats[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';	
		$this->add_log($mas1);
	}elseif($this->hodID == 8 || $this->hodID == 18 || $this->hodID == 28 || $this->hodID == 38 || $this->hodID == 48 || $this->hodID == 58 || $this->hodID == 68 || $this->hodID == 78 || $this->hodID == 88 || $this->hodID == 98 || $this->hodID == 108) {
		$hp = 600;
		$this->stats[$this->uids[$uid1]]['hpNow'] += $hp;
		$this->users[$this->uids[$uid1]]['hpNow'] += $hp;
		if($this->users[$this->uids[$uid1]]['hpNow'] > $this->stats[$this->uids[$uid1]]['hpAll']) {
			$this->users[$this->uids[$uid1]]['hpNow'] = $this->stats[$this->uids[$uid1]]['hpAll'];
		}
		mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid1]]['hpNow'].' WHERE `id` = '.$this->users[$this->uids[$uid1]]['id'].' LIMIT 1');
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas1['text'] = '{tm1} {u1}, восстановил свое здоровье с помощью приема <b>&quot;Призрачная Боль&quot;<font color=green> +'.$hp.'</b></font> ['.ceil($this->stats[$this->uids[$uid1]]['hpNow']).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';	
		$this->add_log($mas1);
	}
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 287) { //Древний страж

if($this->hodID == 3 || $this->hodID == 7 || $this->hodID ==  11 || $this->hodID == 15 || $this->hodID == 19 || $this->hodID == 23 || $this->hodID == 27 || $this->hodID == 31 || $this->hodID == 35 || $this->hodID == 39 || $this->hodID == 43 || $this->hodID == 47 || $this->hodID == 51 || $this->hodID == 55 || $this->hodID == 59 || $this->hodID == 63 || $this->hodID == 67 || $this->hodID == 71) {

$teams = mysql_query('SELECT `u`.`id`,`u`.`battle`,`u`.`login`,`s`.`team` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`team` = "'.$this->users[$this->uids[$uid2]]['team'].'" AND `u`.`battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'"');
		
		while($team = mysql_fetch_array($teams)) {
			
			//пламенная вспышка
			$hp_p = rand(80,100);
			$this->users[$this->uids[$team['id']]]['hpNow'] -= $hp_p;
			$this->users[$this->uids[$team['id']]]['last_hp'] =- $hp_p;
			$this->stats[$this->uids[$team['id']]]['hpNow'] -= $hp_p;
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$team['id']]]['hpNow'].'" , `last_hp` = "'.$this->users[$this->uids[$team['id']]]['last_hp'].'" WHERE `id` = "'.$this->users[$this->uids[$team['id']]]['id'].'" LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1}, нанес урон с помощь приема <b>&quot;Пламенная Вспышка&quot;</b> по персонажу: <b>'.$team['login'].' <font color=bagr>-'.$hp_p.'</b></font> ['.$this->stats[$this->uids[$team['id']]]['hpNow'].'/'.$this->stats[$this->uids[$team['id']]]['hpAll'].']';
			$this->add_log($mas);
		}
	}
}



//Грибница


if($this->users[$this->uids[$uid1]]['bot_id'] == 313) { //Тот кто живет в яме

	/*
		Тот кто живет в яме
		прием "Идиотизм" - аналог туманного образа 10 - 1 раз в 5 ходов
		прием "Паралич" - аналог шокера - длится 3 хода - задержка 7 ходов
		прием "Выпить крови" - мнгновенный удар на 150-200хп - половиной лечит себя
		прием "Природная гибкость" - аналог коварного ухода - 1 раз в 5 ходов
	*/

	$pr_use = 1;
	
	if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 70 || $this->hodID == 75 || $this->hodID == 80 || $this->hodID == 85 || $this->hodID == 90 || $this->hodID == 95 || $this->hodID == 100 || $this->hodID == 105 || $this->hodID == 110 || $this->hodID == 115 || $this->hodID == 120 || $this->hodID == 125 || $this->hodID == 130 || $this->hodID == 135 || $this->hodID == 140 || $this->hodID == 145 || $this->hodID == 150) { 
	
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = 'Идиотизм';
		$pr_vars['priem_use'][0]['id'] = 273;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	
	}elseif($this->hodID == 2 || $this->hodID == 11 || $this->hodID == 21 || $this->hodID == 29 || $this->hodID == 38 || $this->hodID == 47 || $this->hodID == 56 || $this->hodID == 66 || $this->hodID == 74 || $this->hodID == 83 || $this->hodID == 92 || $this->hodID == 101 || $this->hodID == 111 || $this->hodID == 119 || $this->hodID == 128 || $this->hodID == 137 || $this->hodID == 146 || $this->hodID == 156) {
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = 'Паралич';
		$pr_vars['priem_use'][0]['id'] = 410;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	}elseif($this->hodID == 3 || $this->hodID == 9 || $this->hodID == 16 || $this->hodID == 22 || $this->hodID == 28 || $this->hodID == 34 || $this->hodID == 41 || $this->hodID == 46 || $this->hodID == 52 || $this->hodID == 58 || $this->hodID == 64 || $this->hodID == 71 || $this->hodID == 76 || $this->hodID == 82 || $this->hodID == 88 || $this->hodID == 94 || $this->hodID == 102 || $this->hodID == 106 || $this->hodID == 112 || $this->hodID == 118 || $this->hodID == 124 || $this->hodID == 131 || $this->hodID == 136 || $this->hodID == 142 || $this->hodID == 148 || $this->hodID == 154) {
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = 'Природная Гибкость';
		$pr_vars['priem_use'][0]['id'] = 213;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}
	
	if(rand(0,100) <= 10) {
		$hp = rand(150,200);
		$this->users[$this->uids[$uid2]]['hpNow'] -= $hp;
		$this->users[$this->uids[$uid1]]['hpNow'] -= $hp/2;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $hp;
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $hp;
		$this->stats[$this->uids[$uid1]]['hpNow'] -= $hp/2;
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'" , `last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->users[$this->uids[$uid2]]['id'].'" LIMIT 1');
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid1]]['hpNow'].'" WHERE `id` = "'.$this->users[$this->uids[$uid1]]['id'].'" LIMIT 1');
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} {u1}, восстановил здоровье от приема <b><font color=red>&quot;Выпить крови&quot;</font> <font color=green> + '.ceil($hp/2).' </b></font> ['.ceil($this->stats[$this->uids[$uid1]]['hpNow']).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']<br> {u2} утратил здоровье от приема <b><font color=red>&quot;Выпить крови&quot;</font> <font color=green> - '.$hp.' </b></font> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		$this->add_log($mas);
		
	}
	
	
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 315) { //Сжигатель

	$pr_use = 1;
	
				if(rand(0,100) <= 35) {
					$pr_vars['priem_use'][0]['chance'] = 1010;
					$pr_vars['priem_use'][0]['name'] = 'Слабость';
					$pr_vars['priem_use'][0]['id'] = 406;
					$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
				}

}
	
	if($this->users[$this->uids[$uid1]]['bot_id'] == 713) {
		
		/*Защитник+Целитель+Пожиратель+Поглотитель
			Пожиратель
			прием "Укус" - 70-100хп - мнгновенный удар по игроку - 1 раз в 5 ходов

			Целитель
			прием "Исцеление" - лечит всех в своей команде (аналог приема "Цепь исцеления" у воздуха) - 1 раз в 5 ходов - 100-150хп на каждого
		*/


		if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 70 || $this->hodID == 75 || $this->hodID == 80 || $this->hodID == 85 || $this->hodID == 90 || $this->hodID == 95 || $this->hodID == 100 || $this->hodID == 105 || $this->hodID == 110 || $this->hodID == 115 || $this->hodID == 120 || $this->hodID == 125 || $this->hodID == 130 || $this->hodID == 135 || $this->hodID == 140 || $this->hodID == 145 || $this->hodID == 150) {
			$hp = rand(70,100);
			mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].',`last_hp` = '.$this->users[$this->uids[$uid2]]['last_hp'].' WHERE `id` = '.$this->users[$this->uids[$uid2]]['id'].' LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} <b>Пожиратель</b>, <b>применил прием &quot; Укус &quot;</b> на {u2} <b><font color=green> - '.$hp.'</b></font> ['.ceil($this->stats[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpNow'].']';
			$this->add_log($mas);
		}elseif($this->hodID == 3 || $this->hodID == 8 || $this->hodID == 13 || $this->hodID == 18 || $this->hodID == 23 || $this->hodID == 28 || $this->hodID == 33 || $this->hodID == 38 || $this->hodID == 43 || $this->hodID == 48 || $this->hodID == 53 || $this->hodID == 58 || $this->hodID == 63 || $this->hodID == 68 || $this->hodID == 73 || $this->hodID == 78 || $this->hodID == 83 || $this->hodID == 88 || $this->hodID == 93 || $this->hodID == 98 || $this->hodID == 103 || $this->hodID == 108 || $this->hodID == 113 || $this->hodID == 118 || $this->hodID == 123 || $this->hodID == 128 || $this->hodID == 133 || $this->hodID == 138 || $this->hodID == 143 || $this->hodID == 148 || $this->hodID == 153) {
			
			$tr = rand(1,2);
			$w = mysql_query('SELECT `u`.`id`,`u`.`login` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`team` = "'.$this->users[$this->uids[$uid1]]['team'].'" AND `s`.`hpNow` > 0 AND `u`.`battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'"');
			
			while($pl = mysql_fetch_array($w)) {
			$hp = rand(100,150);
			$this->stats[$this->uids[$pl['id']]]['hpNow'] += $hp;
			$this->users[$this->uids[$pl['id']]]['hpNow'] += $hp;
				
				if($tr == 1) {
					$txt = '<b>Целитель</b>, с испугу произнес, первое пришедшее на ум, заклятье <b><font color=#006699> &quot; Исцеление &quot;</b></font> на <b>&quot;'.$pl['login'].'&quot; <font color=green> + '.$hp.'</b></font> ['.ceil($this->stats[$this->uids[$pl['id']]]['hpNow']).'/'.$this->stats[$this->uids[$pl['id']]]['hpAll'].']';
				}elseif($tr == 2) {
					$txt = '<b>Целитель</b>, догадавшись, что пришло время показать себя, произнес заклятье <b><font color=#006699> &quot; Исцеление &quot;</b></font> на <b>&quot;'.$pl['login'].'&quot; <font color=green> + '.$hp.'</b></font> ['.ceil($this->stats[$this->uids[$pl['id']]]['hpNow']).'/'.$this->stats[$this->uids[$pl['id']]]['hpAll'].']';
				}
				
				mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$pl['id']]]['hpNow'].' WHERE `id` = '.$this->users[$this->uids[$pl['id']]]['id'].' LIMIT 1');
				
				$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
				$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
				$mas['text'] = '{tm1} '.$txt.'';
				$this->add_log($mas);
		}
	}
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 314) { //Ужас
	
$pr_use = 1;
	$nowBot = mysql_fetch_array(mysql_query('SELECT `u`.`id` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`team` = "'.$this->users[$this->uids[$uid1]]['team'].'" AND `u`.`battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'" AND `u`.`bot_id` = 713 AND `s`.`hpNow` > 0'));
	if(!isset($nowBot['id'])) {
		mysql_query('DELETE FROM `eff_users` WHERE `uid` = '.$this->users[$this->uids[$uid1]]['id'].' AND `v2` = 407 OR `v2` = 408 AND `delete` = 0');
	}else{
					$pr_vars['priem_use'][0]['chance'] = 1010;
					$pr_vars['priem_use'][0]['name'] = 'Абсолютный Щит';
					$pr_vars['priem_use'][0]['id'] = 407;
					$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
				
					$pr_vars['priem_use'][1]['chance'] = 1010;
					$pr_vars['priem_use'][1]['name'] = 'Абсолютная защита от Магии';
					$pr_vars['priem_use'][1]['id'] = 408;
					$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	}
			$w = mysql_query('SELECT `u`.`id`,`u`.`login` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`team` = "'.$this->users[$this->uids[$uid1]]['team'].'" AND `s`.`hpNow` > 0 AND `u`.`battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'"');
		while($pl = mysql_fetch_array($w)) {
			$eff = mysql_fetch_array(mysql_query('SELECT `id`,`data`,`x` FROM `eff_users` WHERE `uid` = '.$pl['id'].' AND `v2` = 409 AND `delete` = 0 LIMIT 1'));
			if(isset($eff['id'])) {
				$eff['x'] += 1;
				$eff['data'] = "add_m10=".$eff['x']."";
				mysql_query('UPDATE `eff_users` SET `data` = "'.$eff['data'].'",`x` = "'.$eff['x'].'" WHERE `id` = '.$eff['id'].' LIMIT 1');
			}else{
				$data = "add_m10=1";
				$VALUES = '"22","'.$pl['id'].'","Натиск","'.$data.'","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","409","tnbt_enrage.gif","1","-1"';
				mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ('.$VALUES.') ');
			}
		}
}
	
if($this->users[$this->uids[$uid1]]['bot_id'] == 312) { //Макропус
	$pr_use = 1;
	$clon = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `login` LIKE "%'.$this->users[$this->uids[$uid2]]['login'].' (клон)%" AND `battle` = "'.$this->users[$this->uids[$uid2]]['battle'].'" LIMIT 1'));
	if(rand(0,100) <= 30) {
		$clon2 = mysql_query('SELECT `id` FROM `users` WHERE `login` LIKE "%(клон)%" AND `battle` = "'.$this->users[$this->uids[$uid2]]['battle'].'" LIMIT 1');
		while($pl = mysql_fetch_array($clon2)) {
			if($this->users[$this->uids[$pl['id']]]['hpNow'] > 0) {
				if($this->stats[$this->uids[$pl['id']]]['s2'] >= 75) {
					$pr_vars['priem_use'][0]['chance'] = 1010;
					$pr_vars['priem_use'][0]['name'] = 'Отвлечение';
					$pr_vars['priem_use'][0]['id'] = 404;
					$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$pl['id']]];
				}elseif($this->stats[$this->uids[$pl['id']]]['s3'] >= 75) {
					$pr_vars['priem_use'][0]['chance'] = 1010;
					$pr_vars['priem_use'][0]['name'] = 'Точный удар';
					$pr_vars['priem_use'][0]['id'] = 47;
					$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$pl['id']]];
				}elseif($this->stats[$this->uids[$pl['id']]]['s5'] >= 30 && $this->stats[$this->uids[$pl['id']]]['s6'] >= 30) {
					$pr_vars['priem_use'][0]['chance'] = 1010;
					$pr_vars['priem_use'][0]['name'] = 'Отрицание магии';
					$pr_vars['priem_use'][0]['id'] = 405;
					$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
				}
			}
		}
	}
			//Добавляем бота
			$bot = 0;
			if(!isset($clon['id'])) {
			$clone = array(
				'id' => $this->users[$this->uids[$uid2]]['id'],
				'login' => $this->users[$this->uids[$uid2]]['login'].' (клон)',
				'level' => $this->users[$this->uids[$uid2]]['level'],
				'city' => $this->users[$this->uids[$uid2]]['city'],
				'cityreg' => $this->users[$this->uids[$uid2]]['cityreg'],
				'name' => $this->users[$this->uids[$uid2]]['name'],
				'sex' => $this->users[$this->uids[$uid2]]['sex'],
				'deviz' => $this->users[$this->uids[$uid2]]['deviz'],
				'hobby' => $this->users[$this->uids[$uid2]]['hobby'],
				'time_reg' => $this->users[$this->uids[$uid2]]['time_reg'],
				'obraz' => $this->users[$this->uids[$uid2]]['obraz'],
				'stats' => $this->users[$this->uids[$uid2]]['stats'],
				'upLevel' => $this->users[$this->uids[$uid2]]['upLevel'],
				'priems' => $this->users[$this->uids[$uid2]]['priems'],
				'loclon' => true,
				'inTurnir' => $this->users[$this->uids[$uid2]]['inTurnir']
			);
				$bot = $u->addNewbot(1,NULL,$clone,NULL,true);
				mysql_query('UPDATE `stats` SET `team` = "'.$this->users[$this->uids[$uid1]]['team'].'",`dnow` = '.$this->users[$this->uids[$uid2]]['dnow'].',`hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpAll'].'",`mpNow` = "'.$this->users[$this->uids[$uid2]]['mpAll'].'" WHERE `id` = "'.$bot.'" LIMIT 1');
				mysql_query('UPDATE `users` SET `battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'" WHERE `id` = "'.$bot.'" LIMIT 1');
				$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
				$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
				$mas['text'] = '{tm1} {u1} , призвал двойника персонажа <b>'.$this->users[$this->uids[$uid2]]['login'].'</b>';
				$this->add_log($mas);
				unset($clone,$bot);
		}
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 711 || $this->users[$this->uids[$uid1]]['bot_id'] == 712) {
	
	/*
		"Окисление брони" - снижает защиту от урона, эффект складывается, на следующий размен вешает проклятье "Ожог Кислотой" - 3 размена наносит урон примерно в 100ХП -  чистится.
		"Заражение" - вешает проклятье "Мутация" - рандомно снижает статы силы,ловкости,интуиции,интеллекта - на 5 статов - 1 раз в 5 ходов - складывается до х5 - НЕ чистится.
		"Ярость" - при смерти одного из скорпионов добавляет на себя и Брата Мф. мощности урона: +50 
		"Живи!" - при смерти Брата скорпиончика Скорпиончик полностью вскрешает его с полными хп
	*/
	
	$pr_use = 1;
	
		if($this->hodID == 3 || $this->hodID == 7 || $this->hodID == 11 || $this->hodID == 15 || $this->hodID == 19 || $this->hodID == 23 || $this->hodID == 27 || $this->hodID == 31 || $this->hodID == 35 || $this->hodID == 39 || $this->hodID == 43 || $this->hodID == 47 || $this->hodID == 51 || $this->hodID == 55 || $this->hodID == 59 || $this->hodID == 63 || $this->hodID == 67 || $this->hodID == 71 || $this->hodID == 75 || $this->hodID == 79 || $this->hodID == 83 || $this->hodID == 87 || $this->hodID == 91 || $this->hodID == 95 || $this->hodID == 99 || $this->hodID == 103 || $this->hodID == 107 || $this->hodID == 111 || $this->hodID == 115 || $this->hodID == 119 || $this->hodID == 123 || $this->hodID == 127 || $this->hodID == 131 || $this->hodID == 135 || $this->hodID == 139 || $this->hodID == 143 || $this->hodID == 147 || $this->hodID == 151 || $this->hodID == 155 || $this->hodID == 159 || $this->hodID == 163 || $this->hodID == 167 || $this->hodID == 171) {
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Окисление брони';
			$pr_vars['priem_use'][0]['id'] = 400;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		}elseif($this->hodID == 4 || $this->hodID == 8 || $this->hodID == 12 || $this->hodID == 16 || $this->hodID == 20 || $this->hodID == 24 || $this->hodID == 28 || $this->hodID == 32 || $this->hodID == 36  || $this->hodID == 40  || $this->hodID == 44 || $this->hodID == 48 || $this->hodID == 52 || $this->hodID == 56 || $this->hodID == 60 || $this->hodID == 64 || $this->hodID == 68 || $this->hodID == 72 || $this->hodID == 76 || $this->hodID == 80 || $this->hodID == 84 || $this->hodID == 88 || $this->hodID == 92 || $this->hodID == 96 || $this->hodID == 100 || $this->hodID == 104 || $this->hodID == 108 || $this->hodID == 112 || $this->hodID == 116 || $this->hodID == 120 || $this->hodID == 124 || $this->hodID == 128 || $this->hodID == 132 || $this->hodID == 136 || $this->hodID == 140 || $this->hodID == 144 || $this->hodID == 148 || $this->hodID == 152 || $this->hodID == 156 || $this->hodID == 160 || $this->hodID == 164 || $this->hodID == 168 || $this->hodID == 172) {
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Ожог кислотой';
			$pr_vars['priem_use'][0]['id'] = 401;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		}elseif($this->hodID == 20 || $this->hodID == 26 || $this->hodID == 33 || $this->hodID == 38 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 54 || $this->hodID == 61 || $this->hodID == 69 || $this->hodID == 74 || $this->hodID == 81) {
			
			$eff = mysql_fetch_array(mysql_query('SELECT `id`,`data`,`x` FROM `eff_users` WHERE `uid` = '.$this->users[$this->uids[$uid2]]['id'].' AND `v2` = 402 AND `delete` = 0 LIMIT 1'));
			$stat = rand(1,4);
			
			if($stat == 4) { 
				$stat = 5;
			}
				if(!isset($eff['id'])) {
					$edata = "add_s".$stat."=-5";
					$VALUES = '"22","'.$this->users[$this->uids[$uid2]]['id'].'","Мутация","'.$edata.'","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","402","ggyad.gif","1","-1"';
					mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ('.$VALUES.') ');
				}else{
					
					$eff['x'] += 1;
										
					if($eff['x'] > 5) {
						$eff['x'] = 5;
					}
					
					$data = $eff['x']*5;
					mysql_query('UPDATE `eff_users` SET `data` = "add_s'.$stat.'=-'.$data.'",`x` = '.$eff['x'].' WHERE `id` = '.$eff['id'].' LIMIT 1');
				}
		}

		$w = mysql_fetch_array(mysql_query('SELECT `u`.`id`,`u`.`bot_id`,`u`.`login`,`s`.`team`,`s`.`hpNow` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`team` = "'.$this->users[$this->uids[$uid1]]['team'].'" AND `u`.`battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'" AND `u`.`bot_id` = 711 AND `s`.`hpNow` <= 0'));
		$w1 = mysql_fetch_array(mysql_query('SELECT `u`.`id`,`u`.`bot_id`,`u`.`login`,`s`.`team`,`s`.`hpNow` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`team` = "'.$this->users[$this->uids[$uid1]]['team'].'" AND `u`.`battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'" AND `u`.`bot_id` = 712 AND `s`.`hpNow` <= 0'));
		
		
		$step1 = $u->testAction('`uid` = "'.$this->users[$this->uids[$w['id']]]['id'].'" AND `vars` = "use::hp_b_sk::'.$this->info['id'].'" LIMIT 1', 1);
		$step2 = $u->testAction('`uid` = "'.$this->users[$this->uids[$w1['id']]]['id'].'" AND `vars` = "use::hp_sk::'.$this->info['id'].'" LIMIT 1', 1);
		
		if($this->users[$this->uids[$uid1]]['bot_id'] == 712 && isset($w['id']) && !isset($step1['id'])) {
			
			  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			  
			  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			  
			  $mas['text'] = '{tm1} <b>Брат Скорпиончика, исцелил '.$w['login'].'</b><font color=green> +'.$this->stats[$this->uids[$w['id']]]['hpAll'].'</font></b> ['.$this->stats[$this->uids[$w['id']]]['hpAll'].'/'.$this->stats[$this->uids[$w['id']]]['hpAll'].']';
			  
			  $this->add_log($mas);
			  
			  $this->stats[$this->uids[$w['id']]]['hpNow'] += $this->stats[$this->uids[$w['id']]]['hpAll'];
			  
			  $this->users[$this->uids[$w['id']]]['hpNow'] += $this->stats[$this->uids[$w['id']]]['hpAll'];
			 
			  mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$w['id']]]['hpAll'].'" WHERE `id` = '.$w['id'].' LIMIT 1');
			  
			  $u->addAction(time(), 'use::hp_b_sk::'.$this->info['id'], 0, $this->users[$this->uids[$w['id']]]['id']);
			  $eff = mysql_fetch_array(mysql_query('SELECT `id`,`data`,`x` FROM `eff_users` WHERE `uid` = '.$this->users[$this->uids[$uid1]]['id'].' AND `v2` = 403 AND `delete` = 0 LIMIT 1'));
			  
			  if(!isset($eff['id'])) {
				  $sp = mysql_query('SELECT `id`,`login` FROM `users` WHERE `battle` = '.$this->users[$this->uids[$uid2]]['battle'].' AND `bot_id` = 711 OR `bot_id` = 712');
				  while($pl = mysql_fetch_array($sp)) {
					  
					 $VALUES = '"22","'.$this->users[$this->uids[$pl['id']]]['id'].'","Ярость","add_m10=50","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","403","hp_enrage.gif","1","-1"';
					 
					 mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ('.$VALUES.') ');
					 
					  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			  
					  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
					  
					  $mas['text'] = '{tm1} <b>Брат скорпиончика,</b> применил прием &quot Ярость&quot; на <b> '.$pl['login'].' </b>';
					  
					  $this->add_log($mas);
				  }
			  }
			  
		}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 711 && isset($w1['id']) && !isset($step2['id'])) {
			
			  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			  
			  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			 
			 $mas['text'] = '{tm1} <b>Скорпиончик, исцелил '.$w1['login'].'</b><font color=green> +'.$this->stats[$this->uids[$w1['id']]]['hpAll'].'</font></b> ['.$this->stats[$this->uids[$w1['id']]]['hpAll'].'/'.$this->stats[$this->uids[$w1['id']]]['hpAll'].']';
			 
			 $this->add_log($mas);
			 
			 $this->stats[$this->uids[$w1['id']]]['hpNow'] += $this->stats[$this->uids[$w1['id']]]['hpAll'];
			  
			 $this->users[$this->uids[$w1['id']]]['hpNow'] += $this->stats[$this->uids[$w1['id']]]['hpAll'];
			  
			  mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$w1['id']]]['hpAll'].'" WHERE `id` = '.$w1['id'].' LIMIT 1');
			  
			  $u->addAction(time(), 'use::hp_sk::'.$this->info['id'], 0, $this->users[$this->uids[$w1['id']]]['id']);
			   $eff = mysql_fetch_array(mysql_query('SELECT `id`,`data`,`x` FROM `eff_users` WHERE `uid` = '.$this->users[$this->uids[$uid1]]['id'].' AND `v2` = 403 AND `delete` = 0 LIMIT 1'));
			  
			  if(!isset($eff['id'])) {
				  $sp = mysql_query('SELECT `id`,`login` FROM `users` WHERE `battle` = '.$this->users[$this->uids[$uid2]]['battle'].' AND `bot_id` = 711 OR `bot_id` = 712');
				  while($pl = mysql_fetch_array($sp)) {
					  
					 $VALUES = '"22","'.$this->users[$this->uids[$pl['id']]]['id'].'","Ярость","add_m10=50","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","403","hp_enrage.gif","1","-1"';
					 
					 mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ('.$VALUES.') ');
					 
					  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			  
					  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
					  
					  $mas['text'] = '{tm1} <b>Скорпиончик,</b> применил прием &quot Ярость&quot; на <b> '.$pl['login'].' </b>';
					  
					  $this->add_log($mas);
				  }
			  }
			 
		}
		
		$eff = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = '.$u->info['id'].' AND `v2` = 401 AND `delete` = 0 LIMIT 1'));
		
		if(isset($eff['id'])) {
			
			$hpp = rand(80,100);
				
			$this->users[$this->uids[$uid2]]['hpNow'] -= $hpp;
			
			$this->stats[$this->uids[$uid2]]['hpNow'] -= $hpp;
			
			$this->users[$this->uids[$uid2]]['last_hp'] =- $hpp;
				
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'", `last_hp` = '.$this->users[$this->uids[$uid2]]['last_hp'].' WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
				
			  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			  $mas['text'] = '{tm1} {u2}, утратил здоровье от приема <b>Ожог Кислотой<font color=green> -'.$hpp.'</font></b> ['.ceil($this->stats[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			  $this->add_log($mas);
			
			
		}
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 298) { //Грибковая Моль  

	/*
	"Кошмарные сновидения" - паралич (запрет пользоваться приемами) - 6 ходов. задержка 10 ходов
"Мертвая пыльца" - аналог отравления, снимает 50-100 хп каждый ход, длится 5 ходов - задержка 3 хода 
"Кокон" - В течение 5 ходов у монстра увеличена защита от урона и магии +100 (%); каждый ход Моль  восстанавливая своё здоровье на+50HP. задержка 10 ходов
*/

	$pr_use = 1;

	if($this->hodID == 2 || $this->hodID == 12 || $this->hodID == 22 || $this->hodID == 32 || $this->hodID == 42 || $this->hodID == 52 || $this->hodID == 62 || $this->hodID == 72) {
		
		
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Кошмарные сновидения';
			$pr_vars['priem_use'][0]['id'] = 386;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		
	}elseif($this->hodID == 3 || $this->hodID == 11 || $this->hodID == 19 || $this->hodID == 27 || $this->hodID == 35 || $this->hodID == 43 || $this->hodID == 51 || $this->hodID == 59 || $this->hodID == 67 || $this->hodID == 75) {
			
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Мертвая Пыльца';
			$pr_vars['priem_use'][0]['id'] = 387;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
			
	}elseif($this->hodID == 4 || $this->hodID == 15 || $this->hodID == 26 || $this->hodID == 31 || $this->hodID == 44 || $this->hodID == 53 || $this->hodID == 64 || $this->hodID == 74 || $this->hodID == 86) {
		
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Кокон';
			$pr_vars['priem_use'][0]['id'] = 388;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
			
	}
	
	$eff = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `v2` = 387 AND `delete` = 0 LIMIT 1'));
	
	$kokon = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `v2` = 388 AND `delete` = 0 LIMIT 1'));
	
	if(isset($eff['id'])) {
		
			$hpp = rand(50,100);
		
			$this->users[$this->uids[$uid2]]['hpNow'] -= $hpp;
			
			$this->stats[$this->uids[$uid2]]['hpNow'] -= $hpp;
			
			$this->users[$this->uids[$uid2]]['last_hp'] =- $hpp;
			
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'", `last_hp` = '.$this->users[$this->uids[$uid2]]['last_hp'].' WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
			
		  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		  $mas['text'] = '{tm1} {u2}, утратил здоровье от приема <b>Мертвая Пыльца <font color=green>-'.$hpp.'</font></b> ['.ceil($this->stats[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		  $this->add_log($mas);
		
	}
	
	if(isset($kokon['id'])) {
			
			$add_hp = 50;
			
			$this->users[$this->uids[$uid1]]['hpNow'] += $add_hp;
			$this->stats[$this->uids[$uid1]]['hpNow'] += $add_hp;
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid1]]['hpNow'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid1]]['id'].'" LIMIT 1');
			
		  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		  $mas['text'] = '{tm1} {u1}, восстановила здоровье <b><font color=green> + '.$add_hp.'</b></font> ['.ceil($this->stats[$this->uids[$uid1]]['hpNow']).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
		  $this->add_log($mas);
			
	}
	

}

if($this->users[$this->uids[$uid1]]['bot_id'] == 306) { //Трутень 

	if($this->hodID == rand(1,3) || $this->hodID == 4 || $this->hodID == 5 || $this->hodID == 6 || $this->hodID == 7 || $this->hodID == 8 || $this->hodID == 9 || $this->hodID == 10 || $this->hodID == 11 || $this->hodID == 12 || $this->hodID == 13 || $this->hodID == 14 || $this->hodID ==15 ) {
		$step1 = $u->testAction('`uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `vars` = "use::truten::'.$this->info['id'].'" LIMIT 1', 1);
			
		if(!isset($step1['id'])) {
			for($i = 0; $i < 1; $i++) {
				
				  $logins_bot = array();
				  $bot = $u->addNewbot(309, null, null, $logins_bot); //когтец
				  $logins_bot = $bot['logins_bot'];
				  $lo = $bot['login'].' (1)';
				  mysql_query('UPDATE `users` SET `battle` = "'.$this->info['id'].'", `login` = "'.$lo.'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
				  mysql_query('UPDATE `stats` SET `team` = "'.$this->users[$this->uids[$uid1]]['team'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
				  $logins .= $lo.', ';
				  
				  $logins_bot = array();
				  $bot = $u->addNewbot(308, null, null, $logins_bot); //увесистый гусениц
				  $logins_bot = $bot['logins_bot'];
				  $lo = $bot['login'].' (2)';
				  mysql_query('UPDATE `users` SET `battle` = "'.$this->info['id'].'", `login` = "'.$lo.'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
				  mysql_query('UPDATE `stats` SET `team` = "'.$this->users[$this->uids[$uid1]]['team'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
				  $logins .= $lo.', ';
				  
				  $logins_bot = array();
				  $bot = $u->addNewbot(292, null, null, $logins_bot); //глашатай грибницы
				  $logins_bot = $bot['logins_bot'];
				  $lo = $bot['login'].' (3)';
				  mysql_query('UPDATE `users` SET `battle` = "'.$this->info['id'].'", `login` = "'.$lo.'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
				  mysql_query('UPDATE `stats` SET `team` = "'.$this->users[$this->uids[$uid1]]['team'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
				  $logins .= $lo.', ';
				  
				  $logins_bot = array();
				  $bot = $u->addNewbot(307, null, null, $logins_bot); //последователь грибницы
				  $logins_bot = $bot['logins_bot'];
				  $lo = $bot['login'].' (4)';
				  mysql_query('UPDATE `users` SET `battle` = "'.$this->info['id'].'", `login` = "'.$lo.'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
				  mysql_query('UPDATE `stats` SET `team` = "'.$this->users[$this->uids[$uid1]]['team'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
				  $logins .= $lo.', ';
				  
			  
			  $logins = rtrim($logins, ', ');
			  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			  $mas['text'] = '{tm1} {u1}, <b>призвал в поединок: '.$logins.'</b>';
			  $this->add_log($mas);
			  $u->addAction(time(), 'use::truten::'.$this->info['id'], 0, $this->users[$this->uids[$uid1]]['id']);
			}
		}	
		
	}

}


if($this->users[$this->uids[$uid1]]['bot_id'] == 292) { 

/*
Глашатай Грибницы - 1400хп
профиль - рубка
приемы:
"Держать оборону" - 3 хода у монстра и его союзников броня корпуса: +50, Броня пояса: +50, Броня ног: +50, Броня головы: +50. - задержка 5 ходов+-
"Атаковать" - на 3 хода монстр и его союзники получают Мф. мощности урона (%): +50 - задержка 3 хода
Шокирующий удар - в течение 3 ходов вы оглушены и не можете использовать приемы. - задержка 5 ходов
*/


if($this->hodID == 2 || $this->hodID == 10 || $this->hodID == 18 || $this->hodID == 26 || $this->hodID == 34 || $this->hodID == 42 || $this->hodID == 50 || $this->hodID == 58 || $this->hodID == 66 || $this->hodID == 74 || $this->hodID == 82 || $this->hodID == 90 || $this->hodID == 98 || $this->hodID == 106 || $this->hodID == 114 || $this->hodID == 122 || $this->hodID == 130 || $this->hodID == 138 || $this->hodID == 144 || $this->hodID == 152 || $this->hodID == 160 || $this->hodID == 168 || $this->hodID == 176 || $this->hodID == 182 || $this->hodID == 190 || $this->hodID == 198 || $this->hodID == 206) {
	$w = mysql_query('SELECT `u`.`id`,`u`.`login` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`team` = "'.$this->users[$this->uids[$uid1]]['team'].'" AND `s`.`hpNow` > 0 AND `u`.`battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'"');
	
		while($pl = mysql_fetch_array($w)) {
			
			$eff = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = '.$pl['id'].' AND `v2` = 378 AND `delete` = 0 LIMIT 1'));
			
			if(isset($eff['id'])) {
				mysql_query('UPDATE `eff_users` SET `hod` = 3 WHERE `id` = '.$eff['id'].' LIMIT 1');
			}else{
				$VALUES = '"22","'.$this->users[$this->uids[$pl['id']]]['id'].'","Держать Оборону","add_mib1=50|add_mib2=50|add_mib3=50|add_mib4=50","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","378","ggadapt.gif","1","3"';
				
				mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ('.$VALUES.') ');
			}
			
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1}, применил прием <b>&quotДержать Оборону&quot;</b> на <b>'.$pl['login'].'</b> <i>(Броня корпуса: +50, Броня пояса: +50, Броня ног: +50, Броня головы: +50)</i>';
			$this->add_log($mas);
		}
	

	}elseif($this->hodID == 4 || $this->hodID == 11 || $this->hodID == 16 || $this->hodID == 23 || $this->hodID == 30 || $this->hodID == 37 || $this->hodID == 41 || $this->hodID == 49 || $this->hodID == 56 || $this->hodID == 63 || $this->hodID == 70 || $this->hodID == 77 || $this->hodID == 84 || $this->hodID == 91 || $this->hodID == 97 || $this->hodID == 105 || $this->hodID == 112 || $this->hodID == 119 || $this->hodID == 126 || $this->hodID == 133 || $this->hodID == 137 || $this->hodID == 143 || $this->hodID == 151 || $this->hodID == 158 || $this->hodID == 165 || $this->hodID == 172 || $this->hodID == 179 || $this->hodID == 186 || $this->hodID == 193 || $this->hodID == 200 || $this->hodID == 207) {
		
			$w = mysql_query('SELECT `u`.`id`,`u`.`login` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`team` = "'.$this->users[$this->uids[$uid1]]['team'].'" AND `s`.`hpNow` > 0 AND `u`.`battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'"');
	
		while($pl = mysql_fetch_array($w)) {
			
			$eff = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = '.$pl['id'].' AND `v2` = 379 AND `delete` = 0 LIMIT 1'));
			
			if(isset($eff['id'])) {
				mysql_query('UPDATE `eff_users` SET `hod` = 3 WHERE `id` = '.$eff['id'].' LIMIT 1');
			}else{
				$VALUES = '"22","'.$this->users[$this->uids[$pl['id']]]['id'].'","Атаковать","add_m10=50","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","379","ggadapt.gif","1","3"';
				
				mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ('.$VALUES.') ');
			}
			
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1}, применил прием <b>&quotАтаковать&quot;</b> на <b>'.$pl['login'].'</b> <i>(Мф. Мощности урона + 50)</i>';
			$this->add_log($mas);
		}
		
	}elseif($this->hodID == 6 || $this->hodID == 15 || $this->hodID == 24 || $this->hodID == 33 || $this->hodID == 42 || $this->hodID == 51 || $this->hodID == 60 || $this->hodID == 69 || $this->hodID == 78 || $this->hodID == 87 || $this->hodID == 96 || $this->hodID == 105 || $this->hodID == 114 || $this->hodID == 123 || $this->hodID == 132 || $this->hodID == 141 || $this->hodID == 150 || $this->hodID == 159 || $this->hodID == 169 || $this->hodID == 177 || $this->hodID == 185 || $this->hodID == 195 || $this->hodID == 204) {
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Шокирующий Удар';
			$pr_vars['priem_use'][0]['id'] = 380;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	}
	
	
	
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 309 ) { //когтец

/*
"Открытые раны" - В течение 5 ходов игрок теряете 2% своих жизней. - задержка 5 ходов
"Точный удар" - Наносит мгновенный критический удар.
"Неистовость" - У монстра повышается Мф. мощности урона (%): +100, снижается Защита от урона (%): -100 и Защита от магии(%): -100. Складывается до х3 - 1 раз в 3 хода
*/

	$pr_use = 1;

	if( ($this->hodID == 2 || $this->hodID == 12 || $this->hodID == 22 || $this->hodID == 32 || $this->hodID == 42 || $this->hodID == 52 || $this->hodID == 62) || rand(0,100) <= 15) {
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Открытые Раны';
			$pr_vars['priem_use'][0]['id'] = 381;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	}elseif($this->hodID == 1 || $this->hodID == 4 || $this->hodID == 7 || $this->hodID ==  10 || $this->hodID == 13 || $this->hodID == 16 || $this->hodID == 19 || $this->hodID == 22 || $this->hodID == 25 || $this->hodID == 28 || $this->hodID == 31 || $this->hodID == 34 || $this->hodID == 37 || $this->hodID == 40 || $this->hodID == 43 || $this->hodID == 46 || $this->hodID == 49) { 
		
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Неистовость';
			$pr_vars['priem_use'][0]['id'] = 382;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		
	}elseif(rand(0,100) <= 15) {
	
		$thp = rand(250,300);
		
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $thp;
		$this->users[$this->uids[$uid2]]['hpNow'] -= $thp;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $thp;
		
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
		
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} {u1}, нанес мгновенный урон с помощью приема <b>&quot;Точный Удар&quot</b> по {u2} <font color=red><b> - '.$thp.'</font></b> ['.ceil($this->stats[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		$this->add_log($mas);
	}
} 

if($this->users[$this->uids[$uid1]]['bot_id'] == 307) { //Последователь грибницы

	if($hp <= 20) {
		
		
		$thp = $u->testAction('`vars` = "use_team_hp_bot_'.$this->info['id'].'" LIMIT 1', 1);
		if(!isset($thp['id'])) {
			$w = mysql_query('SELECT `u`.`id`,`u`.`login` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`team` = "'.$this->users[$this->uids[$uid1]]['team'].'" AND `s`.`hpNow` > 0 AND `u`.`battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'"');
		while($team = mysql_fetch_array($w)) {
			
			$this->users[$this->uids[$team['id']]]['hpNow'] = $this->stats[$this->uids[$team['id']]]['hpAll'];
			$this->stats[$this->uids[$team['id']]]['hpNow'] = $this->stats[$this->uids[$team['id']]]['hpAll'];
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->users[$this->uids[$team['id']]]['hpNow'].'" WHERE `id` = "'.$team['id'].'" LIMIT 1');
			
				$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
				$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
				$mas['text'] = '{tm1} <b>Последователь Грибницы</b>, восстановил здоровье <b>'.$team['login'].'</b> с помощью приема <b>&quot;Целебные Споры&quot;<font color=green> + '.$this->users[$this->uids[$team['id']]]['hpNow'].'</b></font> ['.ceil($this->stats[$this->uids[$team['id']]]['hpNow']).'/'.$this->stats[$this->uids[$team['id']]]['hpAll'].']';
				$this->add_log($mas);
			}
			$u->addAction(time(), 'use_team_hp_bot_'.$this->info['id'], 0, $this->users[$this->uids[$uid1]]['id']);
		}	
	}elseif($this->hodID == 1 || $this->hodID == 7 || $this->hodID == 13 || $this->hodID == 19 || $this->hodID == 25 || $this->hodID == 31 || $this->hodID == 37 || $this->hodID == 43 || $this->hodID == 49 || $this->hodID == 55 || $this->hodID == 61 || $this->hodID == 67 || $this->hodID == 73) {
	
		$w2 = mysql_query('SELECT `u`.`id`,`u`.`login` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`team` = "'.$this->users[$this->uids[$uid1]]['team'].'" AND `s`.`hpNow` > 0 AND `u`.`battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'"');
		
		while($pl = mysql_fetch_array($w2)) {
			

			
			$eff = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `v2` = 379 AND `delete` = 0 LIMIT 1'));
			
			if(!isset($eff['id'])) {
			
				$VALUES = '"22","'.$this->users[$this->uids[$pl['id']]]['id'].'","Атаковать","add_m10=50","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","379","ggadapt.gif","1","3"';
				
				mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$pl['id'].'" AND `v2` = 379 AND `delete` = 0');
					
				mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ('.$VALUES.') ');
				
					$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
					$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
					$mas['text'] = '{tm1} <b>Последователь Грибницы</b>, применил прием <b>&quot;Атаковать&quot;</b> на <b>'.$pl['login'].'</b> <i>(Мф.мощности урона +50)</i>';
					$this->add_log($mas);
			}else{
				mysql_query('UPDATE `eff_users` SET `hod` = 3 WHERE `id` = "'.$eff['id'].'" LIMIT 1');
			}
			
		}
	}
	
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 311) { //рогач 


	if($this->hodID == 2) {
		$rhp = 2000;
		$this->users[$this->uids[$uid1]]['hpNow'] -= $rhp;
		$this->stats[$this->uids[$uid1]]['hpNow'] -= $rhp;
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid1]]['hpNow'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid1]]['id'].'" LIMIT 1');
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} {u1}, использовал прием <b>&quot;Отдача&quot;</b> и ударил сам себя на <b><font color=green> - '.$rhp.' </b></font> ['.ceil($this->stats[$this->uids[$uid1]]['hpNow']).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
		$this->add_log($mas);
	}elseif($hp <= 35) {
			$ahp = $this->stats[$this->uids[$uid1]]['hpAll'];
			$this->users[$this->uids[$uid1]]['hpNow'] = $ahp;
			$this->stats[$this->uids[$uid1]]['hpNow'] = $ahp;
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid1]]['hpNow'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid1]]['id'].'" LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1}, использовал прием <b>&quot;Резерв&quot;</b> и восстановил свое здоровье <b><font color=green> + '.$ahp.' </b></font> ['.ceil($this->stats[$this->uids[$uid1]]['hpNow']).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
			$this->add_log($mas);
	}

}


if($this->users[$this->uids[$uid1]]['bot_id'] == 302) { //Сторожевая грибоножка 


$pr_use = 1;

		if($this->hodID == 2 || $this->hodID == 9 || $this->hodID == 16 || $this->hodID == 23 || $this->hodID == 30 || $this->hodID == 37 || $this->hodID == 44 || $this->hodID == 51 || $this->hodID == 58 || $this->hodID == 65 || $this->hodID == 72 || $this->hodID == 79) {
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Галлюцинация';
			$pr_vars['priem_use'][0]['id'] = 286;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		}elseif($this->hodID == 3 || $this->hodID == 13 || $this->hodID == 24 || $this->hodID == 35 || $this->hodID == 46 || $this->hodID == 57 || $this->hodID == 68 || $this->hodID == 79 || $this->hodID == 80 || $this->hodID == 91 || $this->hodID == 102) { 
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Врасти';
			$pr_vars['priem_use'][0]['id'] = 383;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		}
		
		$eff = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `v2` = 383 AND `delete` = 0 LIMIT 1'));
		
		if(isset($eff['id'])) {
			$vhp = rand(30,50);
			
			$this->stats[$this->uids[$uid2]]['hpNow'] -= $vhp;
			$this->stats[$this->uids[$uid1]]['hpNow'] += $vhp;
			$this->users[$this->uids[$uid2]]['hpNow'] -= $vhp;
			$this->users[$this->uids[$uid1]]['hpNow'] += $vhp;
			$this->users[$this->uids[$uid2]]['last_hp'] =- $vhp;
			
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid1]]['hpNow'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid1]]['id'].'" LIMIT 1');
			
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1}, восстановил здоровье от приема <b>&quot;Врасти&quot;<font color=green> + '.$vhp.' </b></font> ['.ceil($this->stats[$this->uids[$uid1]]['hpNow']).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].'] <br> {tm2} {u2}, утерял здоровье от приема <b>&quot;Врасти&quot;<font color=bagr> - '.$vhp.' </b></font>['.ceil($this->stats[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			$this->add_log($mas);
		}
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 305) { //Осторожный Щуп 

$pr_use = 1;
	//"Подкоп" - Наносит противнику урон - 150-200хп и лишает части маны (200-300) - 1 раз в 4 хода
	//"Оглушить" - аналог шокирующего удара - 2 хода нельзя использовать приемы и не получать очков тактик - 1 раз в 3 хода
	
	if($this->hodID == 2 || $this->hodID == 7 || $this->hodID == 12 || $this->hodID == 17 || $this->hodID == 22 || $this->hodID == 27 || $this->hodID == 32 || $this->hodID == 37 || $this->hodID == 42 || $this->hodID == 47 || $this->hodID == 52 || $this->hodID == 57 || $this->hodID == 62 || $this->hodID == 67 || $this->hodID == 72 || $this->hodID == 77 || $this->hodID == 82 || $this->hodID == 87 || $this->hodID == 92 || $this->hodID ==97 || $this->hodID == 102 || $this->hodID == 107 || $this->hodID == 112) {
	
	$hpN = rand(150,200);
	$hpM = rand(200,300);
	
	$this->stats[$this->uids[$uid2]]['hpNow'] -= $hpN;
	$this->users[$this->uids[$uid2]]['hpNow'] -= $hpN;
	$this->users[$this->uids[$uid2]]['last_hp'] =- $hpN;
	
	
		if($this->stats[$this->uids[$uid2]]['mpNow'] > 0) {
			$this->stats[$this->uids[$uid2]]['mpNow'] -= $hpM;
			$this->users[$this->uids[$uid2]]['mpNow'] -= $hpM;
			
			if($this->stats[$this->uids[$uid2]]['mpNow'] < 0) {
				$this->stats[$this->uids[$uid2]]['mpNow'] = 0;
				$this->users[$this->uids[$uid2]]['mpNow'] = 0;
			}
			
			$txt = '<br>{tm1} {u1}, применил прием <b>&quot;Подкоп&quot;</b> на {u2} <font color=blue><b>-'.$hpM.'</font></b> ['.ceil($this->stats[$this->uids[$uid2]]['mpNow']).'/'.$this->stats[$this->uids[$uid2]]['mpAll'].']';
		}
	
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'", `mpNow` = "'.$this->stats[$this->uids[$uid2]]['mpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
		
		
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} {u1}, применил прием <b>&quot;Подкоп&quot;</b> на {u2} <b><font color=green>-'.$hpN.'</b></font> ['.ceil($this->stats[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].'] '.$txt.'';
		$this->add_log($mas);
		
	}
		 if($this->hodID == 6 || $this->hodID == 11 || $this->hodID == 16 || $this->hodID == 23 || $this->hodID == 29 || $this->hodID == 35 || $this->hodID == 41 || $this->hodID == 46 || $this->hodID == 53 || $this->hodID == 59 || $this->hodID == 65 || $this->hodID == 71 || $this->hodID == 76 || $this->hodID == 81 || $this->hodID == 88 || $this->hodID == 94 || $this->hodID == 100 || $this->hodID == 104 || $this->hodID == 110) {		 
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Оглушить';
			$pr_vars['priem_use'][0]['id'] = 384;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		}
	
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 300) { //Искрящийся паразит 

if(rand(0,100) <= 30) {
	
	$hpi = rand(50,100);
	
	$rd = rand(0,1);
	//искра
		if($rd == 1) {
		
			$this->users[$this->uids[$uid2]]['hpNow'] += $hpi;
					
			$this->stats[$this->uids[$uid2]]['hpNow'] += $hpi;
			
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid1]]['hpNow'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid1]]['id'].'" LIMIT 1');
			
			
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1}, впал в транс и начал бормотать заклятие <font color=#008080><b>&quot;Искра&quot;</font></b> на {u1} <b><font color=green>+'.$hpi.'</b></font> ['.ceil($this->stats[$this->uids[$uid1]]['hpNow']).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
			$this->add_log($mas);
		
		}else{
			
			$eff = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `v2` = 144 AND `delete` = 0 LIMIT 1'));
			
			if(isset($eff['id'])) {
				$hpi/=2;
			}
			
			$this->users[$this->uids[$uid2]]['hpNow'] -= $hpi;
			
			$this->users[$this->uids[$uid2]]['last_hp'] =- $hpi;
			
			$this->stats[$this->uids[$uid2]]['hpNow'] -= $hpi;
			
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'", `last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
			
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1},  с испугу произнес, первое пришедшее на ум, заклятье <font color=#008080><b>&quot;Искра&quot;</font></b> на {u2} <b><font color=green>-'.$hpi.'</b></font> ['.ceil($this->stats[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			$this->add_log($mas);
		}
	}else{
	
		$trand = rand(1,4);
		$y = rand(85,120);
		$eff = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `v2` = 144 AND `delete` = 0 LIMIT 1'));
		
		if(isset($eff['id'])) {
			$y/=2;
		}
		
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $y;
		$this->users[$this->uids[$uid2]]['hpNow'] -= $y;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $y;
		mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].', `last_hp` = '.$this->users[$this->uids[$uid2]]['last_hp'].' WHERE `id` = '.$this->stats[$this->uids[$uid2]]['id'].' LIMIT 1');
		if($trand == 1) $txt = ', победив страх, решил поразить {u2} заклятьем <b><font color=#008080>&quot;Молния [11]&quot; - '.$y.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		elseif($trand == 2) $txt = ', нарисовав вокруг себя несколько рун, призвал заклятье <b><font color=#008080>&quot;Молния [11]&quot; на {u2} - '.$y.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		elseif($trand == 3) $txt = ', догадавшись, что пришло время показать себя, произнес заклятье <b><font color=#008080>&quot;Молния [11]&quot; на {u2} - '.$y.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		elseif($trand == 4) $txt = ', с испугу произнес, первое пришедшее на ум, заклятье <b><font color=#008080>&quot;Молния [11]&quot; на {u2} - '.$y.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} {u1} '.$txt.'';
		$this->add_log($mas);
	}
	
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 301) { //Усохший палочник
	
	
		if( rand(0,100) <= 10 ) {
			
		$eff = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `v2` = 385 AND `delete` = 0 LIMIT 1'));

		if(!isset($eff['id'])) {
			$_hp = 100;
			
			$this->users[$this->uids[$uid2]]['hpNow'] -= $_hp;
			
			$this->users[$this->uids[$uid2]]['last_hp'] =- $_hp;
			
			$this->stats[$this->uids[$uid2]]['hpNow'] -= $_hp;
			
			$VALUES = '"22","'.$this->users[$this->uids[$uid2]]['id'].'","Болевой Шок","add_notactic=1|add_nousepriem=1","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","385","multi_hitshock.gif","1","5"';
		
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ('.$VALUES.') ');
			
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'", `last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
			
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			
			$mas['text'] = '{tm1} {u1}, нанес урон с помощью приема <b>&quot;Рассечь&quot;</b> на {u2} <b><font color=green>-'.$_hp.'</b></font> ['.ceil($this->stats[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			
			$this->add_log($mas);
		}

		}elseif($hp <= 50) {
			
		if($this->users[$this->uids[$uid1]]['login'] != "Усохший Палочник (Клон)" && $this->users[$this->uids[$uid1]]['bot_id'] == 301) {
			
				$bot301 = $u->testAction('`uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `vars` = "use::bot_301::'.$this->info['id'].'" LIMIT 1', 1);
				
				if(!isset($bot301['id'])) {
					
					$bot = $u->addNewbot(301, null, null, $logins_bot);
					
					mysql_query('UPDATE `users` SET `battle` = "'.$this->info['id'].'", `login` = "Усохший Палочник (Клон)" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
					mysql_query('UPDATE `stats` SET `team` = "'.$this->users[$this->uids[$uid1]]['team'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
					$u->addAction(time(), 'use::bot_301::'.$this->info['id'], 0, $this->users[$this->uids[$uid1]]['id']);
					
					$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
					
					$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
					
					$mas['text'] = '{tm1} {u1}, <font color=green><b>Клонировал себя...</font></b>';
					
					$this->add_log($mas);
				}
			}
			
		}
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 297) { //Скользкий рогоносец  

$pr_use = 1;
		
		if($this->hodID == 3 || $this->hodID == 7 || $this->hodID == 11 || $this->hodID == 15 || $this->hodID == 19 || $this->hodID == 24 || $this->hodID == 28 || $this->hodID == 32 || $this->hodID == 36 || $this->hodID == 40 || $this->hodID == 44 || $this->hodID == 48 || $this->hodID == 52 || $this->hodID == 56 || $this->hodID == 60 || rand(0,100) <= 10) {
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Пристальный Взгляд';
			$pr_vars['priem_use'][0]['id'] = 217;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		}else{
		
			$test = $u->testAction('`uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `vars` = "plevok'.$this->info['id'].'" LIMIT 1', 1);
				
			if(!isset($test['id'])) {	
				
				if(rand(0,100) <= 75) {
				
					$plevok = rand(100,120);
					
					$this->users[$this->uids[$uid2]]['hpNow'] -= $plevok;
				
					$this->stats[$this->uids[$uid2]]['hpNow'] -= $plevok;
				
					$this->users[$this->uids[$uid2]]['last_hp'] =- $plevok;
					
					mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'", `last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->users[$this->uids[$uid2]]['id'].'" LIMIT 1');
					
					  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
					  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
					  $mas['text'] = '{tm1} {u1}, нанес урон с помощью приема <b>&quot;Липкий Плевок&quot; по {u2} <font color=green>-'.$plevok.'</b></font> ['.ceil($this->stats[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
					  $this->add_log($mas);
					  $u->addAction(time(), 'plevok'.$this->info['id'], 0, $this->users[$this->uids[$uid1]]['id']);
				}
			}else{
				
				$test = $u->testAction('`uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `vars` = "v_sliz'.$this->info['id'].'" LIMIT 1', 1);
				
				if(!isset($test['id'])) {
					
					$VALUES = '"22","'.$this->users[$this->uids[$uid2]]['id'].'","Вязкая Слизь","add_m10=-50|add_m11=-50","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","397","ggsliz.gif","1","-1"';
						
					mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ('.$VALUES.') ');
					
					$u->addAction(time(), 'v_sliz'.$this->info['id'], 0, $this->users[$this->uids[$uid1]]['id']);
			}
		}
	}		
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 296) {  //Мясистый гусениц

		$pr_use = 1;
		
		if(rand(0,100) <= 20) {
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Свернуться';
			$pr_vars['priem_use'][0]['id'] = 389;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		}elseif($this->hodID == 2 || $this->hodID == 13 || $this->hodID == 24 || $this->hodID == 35 || $this->hodID == 46 || $this->hodID == 57 || $this->hodID == 68 || $this->hodID == 79 || $this->hodID == 90 || $this->hodID == 101 || $this->hodID == 112 || $this->hodID == 123 || $this->hodID == 134 || $this->hodID == 145 || $this->hodID == 156 || $this->hodID == 167 || $this->hodID == 178 || $this->hodID == 189 || $this->hodID == 200 || rand(0,100) <= 2) {
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Ядовитая Испарина';
			$pr_vars['priem_use'][0]['id'] = 390;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		}
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 308) {  //Увесистый гусениц

		$pr_use = 1;
		
		if(rand(0,100) <= 10) {
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Свернуться';
			$pr_vars['priem_use'][0]['id'] = 391;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		}elseif($this->hodID == 2 || $this->hodID == 10 || $this->hodID == 18 || $this->hodID == 26 || $this->hodID == 32 || $this->hodID == 40 || $this->hodID == 48 || $this->hodID == 56 || $this->hodID == 64 || $this->hodID == 72 || $this->hodID == 80 || $this->hodID == 88 || $this->hodID == 96 || $this->hodID == 104 || $this->hodID == 112 || $this->hodID == 120 || $this->hodID == 128 || $this->hodID == 136 || $this->hodID == 142 || $this->hodID == 150 || $this->hodID == 158 || $this->hodID == 166 || $this->hodID == 174 || $this->hodID == 180 || $this->hodID == 188 || $this->hodID == 196 || $this->hodID == 204 || rand(0,100) <= 5) {
			$pr_vars['priem_use'][0]['chance'] = 30;
			$pr_vars['priem_use'][0]['name'] = 'Ядовитая Испарина';
			$pr_vars['priem_use'][0]['id'] = 392;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		}
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 293) { // яростная мокрица

	$pr_use = 1;
	
	if($this->hodID == 2 || $this->hodID == 6 || $this->hodID ==  10 || $this->hodID ==  14 || $this->hodID == 18 || $this->hodID == 22 || $this->hodID == 26 || $this->hodID == 30 || $this->hodID == 34 || $this->hodID == 38 || $this->hodID == 42 || $this->hodID == 46 || $this->hodID == 50 || $this->hodID == 54 || $this->hodID == 58 || $this->hodID == 62 || $this->hodID == 66 || $this->hodID == 70 || $this->hodID == 74 || $this->hodID == 78 || $this->hodID == 82 || $this->hodID == 86 || $this->hodID == 90 || rand(0,100) <= 5) {
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = 'Стремительный Отпрыг';
		$pr_vars['priem_use'][0]['id'] = 48;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}


}

if($this->users[$this->uids[$uid1]]['bot_id'] == 294) { // кольчатый страхочервь

$pr_use = 1;
		
		if($this->hodID == 2 || $this->hodID == 10 || $this->hodID == 18 || $this->hodID == 26 || $this->hodID == 32 || $this->hodID == 40 || $this->hodID == 48 || $this->hodID == 56 || $this->hodID == 64 || $this->hodID == 72 || $this->hodID == 80 || $this->hodID == 88 || $this->hodID == 96 || $this->hodID == 104 || rand(0,100) <= 5) {
			
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Гнильная водянка';
			$pr_vars['priem_use'][0]['id'] = 393;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
			
		}

}



if($this->users[$this->uids[$uid1]]['bot_id'] == 295) {
	
	/*Пылающий Паразит - 700хп 1000 маны
маг огня (+прописать профиль - рубка)
приемы:
Разогрев - Увеличивает мф. мощности магии огня на +100 на момент использования монстром последующего приема.
Испепеление 7 ур - Наносит 70 хп урон магией огня. - 1 раз в 3 хода (крит удар магией 140хп)
Пожирающее пламя 7 ур - снимает 25-50 хп каждый ход, длится 5 ходов - задержка 3 хода
*/

							$pr_use = 1;
			if(rand(0,100) <= 20) {
				$pr_vars['priem_use'][0]['chance'] = 1010;
				$pr_vars['priem_use'][0]['name'] = 'Пожирающее Пламя [7]';
				$pr_vars['priem_use'][0]['id'] = 394;
				$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
			}else{
					$a = rand(70,80);
					
					$krit = rand(0,2);
					
					$og = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `v2` = 142 AND `delete` = 0 LIMIT 1 '));
					
					if($krit == 2) {
						$a += $a;
						$color = 'red';
					}else{
						$color = 'bagr';
					}
					
					if(isset($og['id'])) {
						$a/=2;
					}
					
					$this->users[$this->uids[$uid2]]['hpNow'] -= $a;
					
					$this->stats[$this->uids[$uid2]]['hpNow'] -= $a;
					
					$this->users[$this->uids[$uid2]]['last_hp'] =- $a;
					
					mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'", `last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->users[$this->uids[$uid2]]['id'].'" LIMIT 1');
					
					
					$tr = rand(1,3);
					
					if($tr == 1) { 
						$txt = 'впал в транс и начал бормотать заклятие <b><font color='.$color.'>&quot;Испепеление [7]&quot;</font></b> на {u2}. <font color='.$color.'><b>-'.$a.' </font></b> ['.ceil($this->stats[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
					}elseif($tr == 2) { 
						$txt = 'наконец сфокусировал свое внимание на поединке и наколдовал <b><font color='.$color.'>&quot;Испепеление [7]&quot;</font></b> на {u2}. <font color='.$color.'><b>-'.$a.' </font></b> ['.ceil($this->stats[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
					}elseif($tr == 3) {
						$txt = 'догадавшись, что пришло время показать себя, произнес заклятье <b><font color='.$color.'>&quot;Испепеление [7]&quot;</font></b> на {u2}. <font color='.$color.'><b>-'.$a.' </font></b> ['.ceil($this->stats[$this->uids[$uid2]]['hpNow']).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
					}
					
					  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
					  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
					  $mas['text'] = '{tm1} {u1}, '.$txt.'';
					  $this->add_log($mas);
				}
}


 if($this->users[$this->uids[$uid1]]['bot_id'] == 304 || $this->users[$this->uids[$uid1]]['bot_id'] != 304) { //королева грибницы
	 
	 
	 $pr_use = 1;
	 
	$step1 = $u->testAction('`uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `vars` = "use::xlup1::'.$this->info['id'].'" LIMIT 1', 1);
	$step2 = $u->testAction('`uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `vars` = "use::xlup2::'.$this->info['id'].'" LIMIT 1', 1);
	$step3 = $u->testAction('`uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `vars` = "use::xlup3::'.$this->info['id'].'" LIMIT 1', 1);
	$step4 = $u->testAction('`uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `vars` = "use::xlup4::'.$this->info['id'].'" LIMIT 1', 1);
	
 $game = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `bot_id` = 304 AND `battle` = "'.$this->users[$this->uids[$uid2]]['battle'].'" LIMIT 1'));
		
if(isset($game['id'])) {
if($this->users[$this->uids[$uid1]]['bot_id'] == 304) {	
  if($hp <= 75) {
	if(!isset($step1['id'])) {
	  for($i = 1; $i <= 10; $i++) {
		  $logins_bot = array();
	      $bot = $u->addNewbot(303, null, null, $logins_bot);
		  $logins_bot = $bot['logins_bot'];
		  $lo = $bot['login'].' ('.$i.')';
		  mysql_query('UPDATE `users` SET `battle` = "'.$this->info['id'].'", `login` = "'.$lo.'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
	      mysql_query('UPDATE `stats` SET `team` = "'.$this->users[$this->uids[$uid1]]['team'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
	      $logins .= $lo.', ';
	  }
	  $logins = rtrim($logins, ', ');
	  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
      $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
      $mas['text'] = '{tm1} {u1} издала громогласный рёв и <b>'.$logins.'</b> вмешались в поединок.';
	  $this->add_log($mas);
	  $u->addAction(time(), 'use::xlup1::'.$this->info['id'], 0, $this->users[$this->uids[$uid1]]['id']);
	}
  }
	
	if($hp <= 50) {
	  if(!isset($step2['id'])) {
		for($i = 12; $i <= 21; $i++) {
	      $logins_bot = array();
	      $bot = $u->addNewbot(303, null, null, $logins_bot);
		  $logins_bot = $bot['logins_bot'];
		  $lo = $bot['login'].' ('.$i.')';
		  mysql_query('UPDATE `users` SET `battle` = "'.$this->info['id'].'", `login` = "'.$lo.'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
	      mysql_query('UPDATE `stats` SET `team` = "'.$this->users[$this->uids[$uid1]]['team'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
	      $logins .= $lo.', ';
	    }
		$logins = rtrim($logins, ', ');
	    $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
        $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
        $mas['text'] = '{tm1} {u1} издала громогласный рёв и <b>'.$logins.'</b> вмешались в поединок.';
	    $this->add_log($mas);
		$u->addAction(time(), 'use::xlup2::'.$this->info['id'], 0, $this->users[$this->uids[$uid1]]['id']);
	  }
	}

    if($hp <= 25) {
	  if(!isset($step3['id'])) {
		for($i = 22; $i <= 31; $i++) {
	      $logins_bot = array();
	      $bot = $u->addNewbot(303, null, null, $logins_bot);
		  $logins_bot = $bot['logins_bot'];
		  $lo = $bot['login'].' ('.$i.')';
		  mysql_query('UPDATE `users` SET `battle` = "'.$this->info['id'].'", `login` = "'.$lo.'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
	      mysql_query('UPDATE `stats` SET `team` = "'.$this->users[$this->uids[$uid1]]['team'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
	      $logins .= $lo.', ';
	    }
		$logins = rtrim($logins, ', ');
	    $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
        $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
        $mas['text'] = '{tm1} {u1} издала громогласный рёв и <b>'.$logins.'</b> вмешались в поединок.';
	    $this->add_log($mas);
		$u->addAction(time(), 'use::xlup3::'.$this->info['id'], 0, $this->users[$this->uids[$uid1]]['id']);
	  }
	}
	
	if($this->hodID == 4 || $this->hodID == 18 || $this->hodID == 32 || $this->hodID == 46 || $this->hodID == 60 || $this->hodID == 74 || $this->hodID == 88 || $this->hodID == 102 || $this->hodID == 116 || $this->hodID == 130 || $this->hodID == 134 || $this->hodID == 148 || $this->hodID == 162 || $this->hodID == 176 || $this->hodID == 190 || $this->hodID == 204 || $this->hodID == 218 || $this->hodID == 232) {
		
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Разрывные споры';
			$pr_vars['priem_use'][0]['id'] = 395;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
			
		}elseif($this->hodID == 3 || $this->hodID == 9 || $this->hodID == 14 || $this->hodID == 20 || $this->hodID == 26 || $this->hodID == 31 || $this->hodID == 38 || $this->hodID == 44 || $this->hodID == 50 || $this->hodID == 56 || $this->hodID == 62 || $this->hodID == 68 || $this->hodID == 73 || $this->hodID == 80 || $this->hodID == 86 ) {
			
			$pr_vars['priem_use'][0]['chance'] = 1010;
			$pr_vars['priem_use'][0]['name'] = 'Адаптация';
			$pr_vars['priem_use'][0]['id'] = 396;
			$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
			
		}
}
		
			$eff = mysql_fetch_array(mysql_query('SELECT `id`,`hod`,`uid` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `v2` = 395 AND `delete` = 0 LIMIT 1'));
			
			if(isset($eff['id'])) {
				
				$battle = mysql_query('SELECT `u`.`id`,`u`.`login`,`st`.`team` FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`battle` = '.$this->users[$this->uids[$eff['uid']]]['battle'].' AND `st`.`team` = '.$this->users[$this->uids[$eff['uid']]]['team'].'');
				
				while($pl = mysql_fetch_array($battle)) {
					
					if($eff['hod'] <= 1) {
						$hpS = 200;
						$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
						$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
						$mas['text'] = '{tm1} {u1}, нанес урон с помощью приема <b>&quot;Разрывные Споры&quot; </b> по <b>'.$pl['login'].'<font color=green> - '.$hpS.' </b></font> ['.ceil($this->stats[$this->uids[$pl['id']]]['hpNow']).'/'.$this->stats[$this->uids[$pl['id']]]['hpAll'].']';
						$this->add_log($mas);
					}
					
				}
				
			}
		}
}

//Гора Легиона


if($this->users[$this->uids[$uid1]]['bot_id'] == 698) { //Лейтенант
	$pr_use = 1;
if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50) {
	$pr_vars['priem_regen']['hp'] = 250;
	$pr_vars['priem_regen']['chance'] = 1010;
	$pr_vars['priem_regen']['name'] = 'Эликсир Лечения';
}elseif($this->hodID == 6 || $this->hodID == 11 || $this->hodID == 16 || $this->hodID == 22 || $this->hodID == 26 || $this->hodID == 31 || $this->hodID == 36 || $this->hodID == 41 || $this->hodID == 46 || $this->hodID == 51) {	
	$pr_vars['priem_use'][0]['chance'] = 1010;
	$pr_vars['priem_use'][0]['name'] = 'Мастер Клинков';
	$pr_vars['priem_use'][0]['id'] = 10;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
}elseif($this->hodID == 7 || $this->hodID ==  14 || $this->hodID == 21 || $this->hodID == 28 || $this->hodID == 37 || $this->hodID == 43 || $this->hodID == 51 || $this->hodID == 59 || $this->hodID == 67 || $this->hodID == 75) {
	
	$pr_vars['priem_use'][0]['chance'] = 1010;
	$pr_vars['priem_use'][0]['name'] = 'Ранение Тьмой';
	$pr_vars['priem_use'][0]['id'] = 376;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
}
	
	$now = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `name` LIKE "%Ранение Тьмой%" AND `delete` = 0 LIMIT 1'));
	if(isset($now['id'])) {
		$hpNow = rand(250,300);
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $hpNow;
		$this->users[$this->uids[$uid2]]['hpNow'] -= $hpNow;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $hpNow;
		$this->users[$this->uids[$uid1]]['hpNow'] += $hpNow/2;
		$this->stats[$this->uids[$uid1]]['hpNow'] += $hpNow/2;
		
		if($this->stats[$this->uids[$uid2]]['hpNow'] < 0 ) {
			$this->stats[$this->uids[$uid2]]['hpNow'] = 0;
		}
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid1]]['hpNow'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid1]]['id'].'" LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} восстановил здоровье с помощью приема <b>&quot;Ранение Тьмой&quot; <font color=green> + '.ceil(($hpNow/2)).'</font></b> ['.(ceil($this->stats[$this->uids[$uid1]]['hpNow'])).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].'] <br> {tm2} {u2} утратил здоровье от приема <b>&quot;Ранение Тьмой&quot; <font color=green> - '.$hpNow.' </font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			$this->add_log($mas);
	}
	
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 529) { //Мародер Страж Теней
	$pr_use = 1;
	
	if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 70 || $this->hodID == 75 || $this->hodID == 80 || $this->hodID == 85 || $this->hodID == 90 || $this->hodID == 95 || $this->hodID == 100 || $this->hodID == 105 || $this->hodID == 110 || $this->hodID == 115 || $this->hodID == 120 || $this->hodID == 125 || $this->hodID == 130 || $this->hodID == 135 || $this->hodID == 140) {
	
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = 'Каменный Щит';
		$pr_vars['priem_use'][0]['id'] = 249;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}elseif($this->hodID == 6 || $this->hodID == 11 || $this->hodID == 16 || $this->hodID == 21 || $this->hodID == 24 || $this->hodID == 31 || $this->hodID == 36 || $this->hodID == 41 || $this->hodID == 46 || $this->hodID == 51 || $this->hodID == 56 || $this->hodID == 61 || $this->hodID == 65 || $this->hodID == 71 || $this->hodID == 76 || $this->hodID == 81 || $this->hodID == 86 || $this->hodID == 91 || $this->hodID == 96 || $this->hodID == 101 || $this->hodID == 106 || $this->hodID == 111 || $this->hodID == 117 || $this->hodID == 123 || $this->hodID == 129 || $this->hodID == 136 || $this->hodID == 141) {
	
		$pr_vars['priem_use'][0]['chance'] = 1010 ;
		$pr_vars['priem_use'][0]['name'] = 'Абсолютная Защита';
		$pr_vars['priem_use'][0]['id'] = 140;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}elseif($this->hodID == 7 || $this->hodID == 14 || $this->hodID == 22 || $this->hodID == 28 || $this->hodID == 34 || $this->hodID == 42 || $this->hodID == 48 || $this->hodID == 54 || $this->hodID == 60 || $this->hodID == 66 || $this->hodID == 72 || $this->hodID == 78 || $this->hodID == 84 || $this->hodID == 91 || $this->hodID == 97 || $this->hodID == 103 || $this->hodID == 109 || $this->hodID == 114 || $this->hodID == 121 || $this->hodID == 127 || $this->hodID == 134 || $this->hodID == 139) {
	
		$pr_vars['priem_regen']['hp'] = 250;
		$pr_vars['priem_regen']['chance'] = 1010;
		$pr_vars['priem_regen']['name'] = 'Эликсир Лечения';
	}
	
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 487) { //Мясник
	
	if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 70 || $this->hodID == 75 || $this->hodID == 80 || $this->hodID == 85 || $this->hodID == 90 || $this->hodID == 95 || $this->hodID == 100) {
	
		$VALUES = '"22","'.$this->users[$this->uids[$uid1]]['id'].'","Сокрушающий Удар","","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","138","krit_crush.gif","1","-1"';
		
		mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ('.$VALUES.') ');
		
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		
	    $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		
		$mas['text'] = '{tm1} {u1} использовал прием <b>&quot;Сокрушающий Удар&quot;</b>';
		
	    $this->add_log($mas);
	}
	

}


if($this->users[$this->uids[$uid1]]['bot_id'] == 530) { //Мародер Тень
	
	$pr_use = 1;
	
	if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50) {
		$hpOG = rand(400,450);
		$this->users[$this->uids[$uid2]]['hpNow'] -= $hpOG;
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $hpOG;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $hpOG;
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
	    $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
	    $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
	    $mas['text'] = '{tm1} {u1} нанес удар по {u2} с помощью приема <b>&quot;Оглушающий Удар&quot; - <font color=green>'.$hpOG.'</font></b> ['.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
	    $this->add_log($mas);
	}
}



if($this->users[$this->uids[$uid1]]['bot_id'] == 522) { //Глубинный гусениц

	$pr_use = 1;
	
	if($this->hodID == 3 || $this->hodID == 14 || $this->hodID == 25 || $this->hodID == 36 || $this->hodID == 47 || $this->hodID == 58 || $this->hodID == 69 || $this->hodID == 80 || $this->hodID == 91 || $this->hodID == 102) {
		
				$pr_vars['priem_use'][0]['chance'] = 1010;
				$pr_vars['priem_use'][0]['name'] = 'Откатить Слизью';
				$pr_vars['priem_use'][0]['id'] = 364;
				$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	}
	
			$eff = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `v2` = 364 AND `delete` = 0 LIMIT 1'));
			if(isset($eff['id'])) {
				  $hpS = rand(35,43);
				  $this->stats[$this->uids[$uid2]]['hpNow'] -= $hpS;
				  $this->users[$this->uids[$uid2]]['hpNow'] -= $hpS;
				  $this->users[$this->uids[$uid2]]['last_hp'] =- $hpS;
				  mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
				  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
				  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
				  $mas['text'] = '{tm2} {u2} утратил здоровье от приема <b>&quot;Откатить Слизью&quot; <font color=green> - '.ceil(($hpS)).'</font></b> ['.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
				  $this->add_log($mas);
			}
}



if($this->users[$this->uids[$uid1]]['bot_id'] == 537) { //Теневой Мясорвал

	if($this->hodID == 5) {
	$eff = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `name` LIKE "%Разорвать Плоть%" AND `delete` = 0 LIMIT 1'));
	
	if(!isset($eff['id'])) {
		
		$s = rand(1,3);
		
		$stat = 'add_s'.$s.'=-20';
		
		$VALUES = '"22","'.$this->users[$this->uids[$uid2]]['id'].'","Разорвать Плоть","'.$stat.'","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","361","gl_mob_eatmeat_cut.gif","1","7"';
		
		mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ('.$VALUES.') ');
		
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		
	    $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		
		$mas['text'] = '{tm1} {u1} <b>разорвал плоть, персонажу</b> {u2}';
		
	    $this->add_log($mas);
	}
		
}
	
	
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 532) { 

$pr_use = 1;

$pr_vars['priem_use'][0]['chance'] = 1010;
	$pr_vars['priem_use'][0]['name'] = 'Мастер Клинков';
	$pr_vars['priem_use'][0]['id'] = 375;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

}

if($this->users[$this->uids[$uid1]]['bot_id'] == 523) { //Глубинный Зомби
	
	$pr_use = 1;
	
	$eff = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `v2` = 366 AND `delete` = 0 LIMIT 1'));
		
		if(isset($eff['id'])) {
		
			$hpYad = rand(30,70);
			
			$this->users[$this->uids[$uid2]]['hpNow'] -= $hpYad;
			
			$this->users[$this->uids[$uid2]]['last_hp'] -= $hpYad;
			
			$this->stats[$this->uids[$uid2]]['hpNow'] -= $hpYad;
			
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'", `last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->users[$this->uids[$uid2]]['id'].'" LIMIT 1');
			
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			
			$mas['text'] = '{tm2} {u2} утратил здоровье от приема <b>&quot;Ядовитый Укус&quot; <font color=green>-'.$hpYad.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			
			$this->add_log($mas);
		}
	
	if($this->hodID == 3 || $this->hodID == 9 || $this->hodID == 17 || $this->hodID == 24 || $this->hodID == 31 || $this->hodID == 38 || $this->hodID == 45 || $this->hodID == 52 || $this->hodID == 59 || $this->hodID == 66 || $this->hodID == 73 || $this->hodID == 80 || $this->hodID == 87 || $this->hodID == 94 || $this->hodID == 101) {
		
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = 'Ядовытый Укус';
		$pr_vars['priem_use'][0]['id'] = 366;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		
	}elseif($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 44 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 70 || $this->hodID == 75|| $this->hodID == 81 || $this->hodID == 86 || $this->hodID == 91 || $this->hodID == 96 || $this->hodID == 100  ) {
			
			$pr_vars['priem_regen']['hp'] = rand(60,100);
			$pr_vars['priem_regen']['chance'] = 1010;
			$pr_vars['priem_regen']['name'] = 'Регенерация';
			
	}elseif($this->hodID == 7 || $this->hodID == 12) {
		
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = 'Проклятье Голодного Мертвеца';
		$pr_vars['priem_use'][0]['id'] = 367;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		
	}
	
	
}



if($this->users[$this->uids[$uid1]]['bot_id'] == 531) { //Мародер Тень Отступник
	
	$pr_use = 1;
	
	/*
	прием "Изворотливость" - Абс. мф уворота +100 на 2 хода - 1 раз в 7 ходов
	прием "Эликсир Лечения" - хилит себя на 200хп и тратит ход - 1 раз в 6 ходов
	прием "Оглушающий удар" - наносит 150-200 хп урона и паралич на 1 ход (аналог маг приема "Каменный цветок") - прием тратит ход
*/
	
	if($this->hodID == 3 || $this->hodID == 10 || $this->hodID == 17 || $this->hodID == 24 || $this->hodID == 31 || $this->hodID == 38 || $this->hodID == 45 || $this->hodID == 52 || $this->hodID == 59 || $this->hodID == 65 || $this->hodID == 72 || $this->hodID == 79 || $this->hodID == 85 || $this->hodID == 92 || $this->hodID == 99 || $this->hodID == 106 || $this->hodID == 113 || $this->hodID == 120 || $this->hodID == 127 || $this->hodID == 134 || $this->hodID == 141) {
		
		$pr_use = 1;
		
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = 'Изворотливость';
		$pr_vars['priem_use'][0]['id'] = 369;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		
	}elseif($this->hodID == 5 || $this->hodID == 11 || $this->hodID == 18 || $this->hodID == 23 || $this->hodID == 29 || $this->hodID == 35 || $this->hodID == 41 || $this->hodID == 46 || $this->hodID == 50 || $this->hodID == 56 || $this->hodID == 61 || $this->hodID == 67 || $this->hodID == 73 || $this->hodID == 78 || $this->hodID == 84 || $this->hodID == 90 || $this->hodID == 96 || $this->hodID == 102 || $this->hodID == 108 || $this->hodID == 114 || $this->hodID == 122 || $this->hodID == 128 || $this->hodID == 135 || $this->hodID == 140) {
		
			$pr_vars['priem_regen']['hp'] = 200;
			$pr_vars['priem_regen']['chance'] = 1010;
			$pr_vars['priem_regen']['name'] = 'Эликсир Лечения';
		
	}elseif($this->hodID == 8 || $this->hodID == 12 || $this->hodID == 16 || $this->hodID == 20 || $this->hodID == 24 || $this->hodID == 28 || $this->hodID == 32 || $this->hodID == 36 || $this->hodID == 40 || $this->hodID == 44 || $this->hodID == 48 || $this->hodID == 53 || $this->hodID == 57 || $this->hodID == 62 || $this->hodID == 66 || $this->hodID == 70 || $this->hodID == 76 || $this->hodID == 82 || $this->hodID == 86 || $this->hodID == 91 || $this->hodID == 97 || $this->hodID == 103 || $this->hodID == 109 || $this->hodID == 115 || $this->hodID == 121 || $this->hodID == 127 || $this->hodID == 133 || $this->hodID == 139 || $this->hodID == 145) {
		
		$teams = mysql_query('SELECT `u`.`id`,`u`.`battle`,`u`.`login`,`s`.`team` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`team` = "'.$this->users[$this->uids[$uid2]]['team'].'" AND `u`.`battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'"');
		
		while($team = mysql_fetch_array($teams)) {
			
			
			
			$team_hp = rand(150,200);
			
			$this->users[$this->uids[$team['id']]]['hpNow'] -= $team_hp;
			
			$this->users[$this->uids[$team['id']]]['last_hp'] =- $team_hp;
			
			$this->stats[$this->uids[$team['id']]]['hpNow'] -= $team_hp;
			
			$VALUES = '"22","'.$this->users[$this->uids[$team['id']]]['id'].'","Оглушающий Удар","add_notactic=1|add_nousepriem=1","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","368","wis_earth_flower.gif","1","1"';
		
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ('.$VALUES.') ');
			
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$team['id']]]['hpNow'].'", `last_hp` = "'.$this->users[$this->uids[$team['id']]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$team['id']]]['id'].'" LIMIT 1');
			
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			
			$mas['text'] = '{tm1} <b><font color=darkblue> Мародер Тень Отступник,</b></font> применил прием <b><font color=brown>&quot;Оглушающий Удар</b></font> на <b>'.$team['login'].' <font color=green> - '.$team_hp.' </font></b>['.$this->stats[$this->uids[$team['id']]]['hpNow'].'/'.$this->stats[$this->uids[$team['id']]]['hpAll'].']';
			
			$this->add_log($mas);
			
		}
	}
} 


if($this->users[$this->uids[$uid1]]['bot_id'] == 534 || $this->users[$this->uids[$uid1]]['bot_id'] == 528 ) { //Охранник или Мародер Потрошитель Отступник

$pr_use = 1;
	
	if($this->hodID == 8 || $this->hodID == 12 || $this->hodID == 16 || $this->hodID == 21 || $this->hodID == 24 || $this->hodID == 29 || $this->hodID == 32 || $this->hodID == 37 || $this->hodID == 43 || $this->hodID == 48 || $this->hodID == 53 || $this->hodID == 58 || $this->hodID == 64 || $this->hodID == 69 || $this->hodID == 74 || $this->hodID == 79 || $this->hodID == 83 || $this->hodID == 87 || $this->hodID == 92 || $this->hodID == 97 || $this->hodID == 102 || $this->hodID == 106 || $this->hodID == 111 || $this->hodID == 116 || $this->hodID == 120 || $this->hodID == 125 || $this->hodID == 130 || $this->hodID == 135 || $this->hodID == 140) {
		
		$teams = mysql_query('SELECT `u`.`id`,`u`.`battle`,`u`.`login`,`s`.`team` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`team` = "'.$this->users[$this->uids[$uid2]]['team'].'" AND `u`.`battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'"');
		
		while($team = mysql_fetch_array($teams)) {
			
			
			
			$team_hp = rand(150,200);
			
			$this->users[$this->uids[$team['id']]]['hpNow'] -= $team_hp;
			
			$this->users[$this->uids[$team['id']]]['last_hp'] =- $team_hp;
			
			$this->stats[$this->uids[$team['id']]]['hpNow'] -= $team_hp;
			
			$VALUES = '"22","'.$this->users[$this->uids[$team['id']]]['id'].'","Болевой Шок","add_notactic=1|add_nousepriem=1","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","371","multi_hitshock.gif","1","1"';
		
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ('.$VALUES.') ');
			
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$team['id']]]['hpNow'].'", `last_hp` = "'.$this->users[$this->uids[$team['id']]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$team['id']]]['id'].'" LIMIT 1');
			
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			
			$mas['text'] = '{tm1} <b><font color=darkblue> Мародер Тень Отступник,</b></font> применил прием <b><font color=brown>&quot;Рассечь</b></font> на <b>'.$team['login'].' <font color=green> - '.$team_hp.' </font></b>['.$this->stats[$this->uids[$team['id']]]['hpNow'].'/'.$this->stats[$this->uids[$team['id']]]['hpAll'].']';
			
			$this->add_log($mas);
			
		}
			
		}elseif($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 36 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 71 || $this->hodID == 75 || $this->hodID == 80 || $this->hodID == 85) {
		
			$pr_vars['priem_regen']['hp'] = 200;
			$pr_vars['priem_regen']['chance'] = 1010;
			$pr_vars['priem_regen']['name'] = 'Эликсир Лечения';
		
	}elseif($this->hodID == 7 || $this->hodID == 14 || $this->hodID == 21 || $this->hodID == 28 || $this->hodID == 35 || $this->hodID == 42 || $this->hodID == 49 || $this->hodID == 56 || $this->hodID == 63 || $this->hodID == 71 || $this->hodID == 78 || $this->hodID == 86 || $this->hodID == 93 || $this->hodID == 100 || $this->hodID == 107 || $this->hodID == 114 || $this->hodID == 121) {
		
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = 'Сквозной Удар';
		$pr_vars['priem_use'][0]['id'] = 219;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		
	}

	
}



if($this->users[$this->uids[$uid1]]['bot_id'] == 517) { //Безумный рыцарь
	
	$pr_use = 1;
	
	if($this->hodID == 3 || $this->hodID == 10 || $this->hodID == 17 || $this->hodID == 24 || $this->hodID == 31 || $this->hodID == 38 || $this->hodID == 45 || $this->hodID == 52 || $this->hodID == 59 || $this->hodID == 66 || $this->hodID == 73 || $this->hodID == 80 || $this->hodID == 87 || $this->hodID == 94 || $this->hodID == 101) {
		
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = 'Безумное Наступление';
		$pr_vars['priem_use'][0]['id'] = 372;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		
	}elseif($this->hodID == 5 || $this->hodID == 12 || $this->hodID == 19 || $this->hodID == 26 || $this->hodID == 33 || $this->hodID == 40 || $this->hodID == 47 || $this->hodID == 54 || $this->hodID == 61 || $this->hodID == 68 || $this->hodID == 75 || $this->hodID == 82 || $this->hodID == 89 || $this->hodID == 96 || $this->hodID == 103) {
		
		$ob = rand(100,150);
		
		$this->users[$this->uids[$uid2]]['hpNow'] -= $ob;
		
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $ob;
		
		$this->users[$this->uids[$uid2]]['last_hp'] =- $ob;
		
		$add_yron = mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'" WHERE `id` = "'.$this->users[$this->uids[$uid2]]['id'].'" LIMIT 1');
		
		if($add_yron) {
			
				$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			
				$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
				
				$mas['text'] = '{tm1} {u1} нанес урон с помощью приема <b>&quot;Прорвать оборону&quot;</b> по персонажу {u2} <b><font color=green>-'.$ob.'</b></font> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
				
				$this->add_log($mas);
				
				$pr_vars['priem_use'][0]['chance'] = 1010;
				$pr_vars['priem_use'][0]['name'] = 'Глубокое Потрясение';
				$pr_vars['priem_use'][0]['id'] = 373;
				$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
				
			
		}
		
	}
	
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 535) { //Павший заклинатель
	
	if($this->hodID == 4 || $this->hodID == 13 || $this->hodID == 22 || $this->hodID == 31 || $this->hodID == 40 || $this->hodID == 49 || $this->hodID == 58 || $this->hodID == 67 || $this->hodID == 76 || $this->hodID == 85 || $this->hodID == 94) {
		
		$pr_use = 1;
		
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = 'Проклятье Падшего';
		$pr_vars['priem_use'][0]['id'] = 374;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		
	}elseif($this->hodID == 9 || $this->hodID == 18 || $this->hodID == 27 || $this->hodID == 36 || $this->hodID == 45 || $this->hodID == 54 || $this->hodID == 63 || $this->hodID == 72 || $this->hodID == 81 || $this->hodID == 90) {
		
		//moment
		
		$hpl = rand(100,120);
		
		$this->users[$this->uids[$uid2]]['hpNow'] -= $hpl;
		
		$this->users[$this->uids[$uid2]]['last_hp'] =- $hpl;
		
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $hpl;
		
		$this->users[$this->uids[$uid1]]['hpNow'] -= $hpl/2;
		
		$this->stats[$this->uids[$uid1]]['hpNow'] -= $hpl/2;
		
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'", `last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->users[$this->uids[$uid2]]['id'].'" LIMIT 1');
		
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid1]]['hpNow'].'" WHERE `id` = "'.$this->users[$this->uids[$uid1]]['id'].'" LIMIT 1');
		
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		
		$mas['text'] = '{tm1} {u1} восстановил здоровье с помощью приема <b>&quot;Прикосновение Лича&quot; <font color=green>+'.ceil($hpl/2).'</b></font> ['.(ceil($this->stats[$this->uids[$uid1]]['hpNow'])).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].'] <br> {tm2} {u2} пострадал от приема <b>&quot;Прикосновение Лича&quot; <font color=green>-'.$hpl.'</b></font>  ['.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		
		$this->add_log($mas);
		
	}
	
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 533) { //Начальник внешней охраны
			$pr_use = 1;
			if($this->hodID == 6 || $this->hodID == 11 || $this->hodID == 16 || $this->hodID == 21 || $this->hodID == 26 || $this->hodID == 31 || $this->hodID == 36 || $this->hodID == 41 || $this->hodID == 46 || $this->hodID == 51 || $this->hodID == 56 || $this->hodID == 61 || $this->hodID == 66) {
				$pr_vars['priem_use'][0]['chance'] = 1010;
				$pr_vars['priem_use'][0]['name'] = 'Каменный Щит';
				$pr_vars['priem_use'][0]['id'] = 249;
				$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
			}elseif($this->hodID == 7 || $this->hodID == 12 || $this->hodID == 17 || $this->hodID == 22 || $this->hodID == 27 || $this->hodID == 32 || $this->hodID == 37 || $this->hodID == 42 || $this->hodID == 47 || $this->hodID == 52 || $this->hodID == 57 || $this->hodID == 62 || $this->hodID == 67) {
				$pr_vars['priem_use'][0]['chance'] = 1010 ;
				$pr_vars['priem_use'][0]['name'] = 'Абсолютная Защита';
				$pr_vars['priem_use'][0]['id'] = 140;
				$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
			}
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 538) { //гончая
 $pr_use = 1;
  if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40) {
	  
	$pr_vars['priem_regen']['hp'] = 150;
	$pr_vars['priem_regen']['chance'] = 1010;
	$pr_vars['priem_regen']['name'] = 'Регенерация';
	
  }elseif($this->hodID == 6 || $this->hodID == 11 || $this->hodID == 16 || $this->hodID == 21 || $this->hodID == 26 || $this->hodID == 31 || $this->hodID == 36 || $this->hodID == 41) {
	  
		  for($i = 0; $i < 4; $i++) {
			  
			  $php = rand(40,50);
			  $this->stats[$this->uids[$uid2]]['hpNow'] -= $php;
			  $this->users[$this->uids[$uid2]]['hpNow'] -= $php;
			  $this->users[$this->uids[$uid2]]['last_hp'] =- $php;
			  mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
			  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			  $mas['text'] = '{tm1} {u1} применила прием <b>&quotСерия Укусов&quot; на {u2} - <font color=green>'.$php.'</font></b> ['.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			  $this->add_log($mas);
			  
	  }
	  
  }
 
 
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 539) { //Торговец

$pr_use = 1;

  if($this->hodID == 3 || $this->hodID == 6 || $this->hodID == 9 || $this->hodID == 12 || $this->hodID == 15 || $this->hodID == 18 || $this->hodID == 21 || $this->hodID == 24 || $this->hodID == 27 || $this->hodID == 30 || $this->hodID == 33 || $this->hodID == 36 || $this->hodID == 39) {
	  $ydar = rand(200,250);
	  $this->users[$this->uids[$uid2]]['hpNow'] -= $ydar;
	  $this->stats[$this->uids[$uid2]]['hpNow'] -= $ydar;
	  $this->stats[$this->uids[$uid2]]['last_hp'] =- $ydar;
	  
	  mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
	   $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
	   $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} {u1} ударил мешком персонажа {u2} - <b><font color=green>'.$ydar.'</b></font> ['.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		$this->add_log($mas);
  }elseif($this->hodID == 4 || $this->hodID == 7 || $this->hodID == 10 || $this->hodID == 13 || $this->hodID == 16 || $this->hodID == 19 || $this->hodID == 22 || $this->hodID == 25 || $this->hodID == 28 || $this->hodID == 31 || $this->hodID == 34 || $this->hodID == 37 || $this->hodID == 40) {
	  
	   $hpp = rand(350,400);
	   
	   $this->users[$this->uids[$uid2]]['hpNow'] -= $hpp;
	   
	   $this->users[$this->uids[$uid2]]['last_hp'] =- $hpp;
	   
	   $this->stats[$this->uids[$uid2]]['hpNow'] -= $hpp;
	   
	   $this->users[$this->uids[$uid1]]['hpNow'] += $hpp/2;
	   
	   $this->stats[$this->uids[$uid1]]['hpNow'] += $hpp/2;
	   
	mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
	  
	  mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid1]]['hpNow'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid1]]['id'].'" LIMIT 1');
	  
	  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
	  
	  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
	  
	  $mas['text'] = '{tm1} {u1} восстановил здоровье с помощью приема <b>&quot;Бесстыдный Удар&quot; <font color=green>+'.ceil($hpp/2).'</b></font> ['.(ceil($this->stats[$this->uids[$uid1]]['hpNow'])).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].'] <br> {tm2} {u2} пострадал от приема <b>&quot;Бесстыдный Удар&quot; <font color=green>-'.$hpp.'</b></font>  ['.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
	  
	  $this->add_log($mas);
	  
  }elseif($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40) {
	  
	    $pr_vars['priem_regen']['hp'] = rand(400,500);
		$pr_vars['priem_regen']['chance'] = 1010;
		$pr_vars['priem_regen']['name'] = 'Регенерация';
  }

}




if($this->users[$this->uids[$uid1]]['bot_id'] == 536) { //Сеймос

$pr_use = 1;

if($this->hodID == 6 || $this->hodID == 12 || $this->hodID ==  18 || $this->hodID ==  24 || $this->hodID == 30 || $this->hodID == 36 || $this->hodID ==  42 || $this->hodID ==  48 || $this->hodID ==  54 || $this->hodID ==  60 || $this->hodID ==  66 || $this->hodID ==  72 || $this->hodID ==  78 || $this->hodID ==  84 || $this->hodID ==  90 || $this->hodID ==  96 || $this->hodID ==  102 || $this->hodID == 108 || $this->hodID == 116 || $this->hodID == 122 || $this->hodID == 128 || $this->hodID == 135 || $this->hodID == 141 || $this->hodID == 146 || $this->hodID == 152 || $this->hodID == 159 || $this->hodID == 165 || $this->hodID == 172 || $this->hodID == 178) {
	
		$hpNow = rand(250,300);
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $hpNow;
		$this->users[$this->uids[$uid2]]['hpNow'] -= $hpNow;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $hpNow;
		$this->stats[$this->uids[$uid1]]['hpNow'] += $hpNow/2;
		$this->users[$this->uids[$uid1]]['hpNow'] += $hpNow/2;
		
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid1]]['hpNow'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid1]]['id'].'" LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} восстановил здоровье с помощью приема <b>&quot;Темное Ранение&quot; <font color=green> + '.ceil(($hpNow/2)).'</font></b> ['.(ceil($this->stats[$this->uids[$uid1]]['hpNow'])).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].'] <br> {tm2} {u2} утратил здоровье от приема <b>&quot;Темное Ранение&quot; <font color=green> - '.$hpNow.' </font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			$this->add_log($mas);
	
}elseif($this->hodID == 7 || $this->hodID == 14 || $this->hodID == 21 || $this->hodID ==  28 || $this->hodID ==  35 || $this->hodID == 41 || $this->hodID == 49 || $this->hodID == 56 || $this->hodID == 63 || $this->hodID == 70 || $this->hodID == 77 || $this->hodID ==  84 || $this->hodID ==  92 || $this->hodID == 99 || $this->hodID == 106 || $this->hodID == 113 || $this->hodID == 120 || $this->hodID == 127 || $this->hodID == 134 || $this->hodID == 140 || $this->hodID == 147 || $this->hodID == 154 || $this->hodID == 161 || $this->hodID == 168 || $this->hodID == 173 || $this->hodID == 180) {
	
		$khp = rand(350,400);
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $khp;
		$this->users[$this->uids[$uid2]]['hpNow'] -= $khp;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $khp;
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} {u1} нанес урон по врагу {u2} с помощью приема <b>&quot;Тактический Укол&quot; - '.$khp.'</b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		$this->add_log($mas);
		
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = 'Потеря Подвижности';
		$pr_vars['priem_use'][0]['id'] = 204;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	
}

		$pr_vars['priem_regen']['hp'] = 500;
		$pr_vars['priem_regen']['chance'] = 10;
		$pr_vars['priem_regen']['name'] = 'Эликсир Лечения';


} 



if($this->users[$this->uids[$uid1]]['bot_id'] == 700) { 
///////Эми тейли
	$pr_use = 1;
	
if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 14 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 70 || $this->hodID == 75 || $this->hodID == 80 || $this->hodID == 85 || $this->hodID == 90 || $this->hodID == 95 || $this->hodID == 100) {
		$pr_vars['priem_use'][0]['chance'] = 1010 ;
		$pr_vars['priem_use'][0]['name'] = 'Абсолютная Защита';
		$pr_vars['priem_use'][0]['id'] = 140;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		
	}elseif($this->hodID == 7) {
		
		
		$emi = $u->testAction('`uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `vars` = "use::emi_gora::'.$this->info['id'].'" LIMIT 1', 1);
		if(!isset($emi['id'])) {
		
		  for($i = 1; $i <= 2; $i++) {
			  
			  
			  $logins_bot = array();
			  $bot = $u->addNewbot(529, null, null, $logins_bot);
			  $logins_bot = $bot['logins_bot'];
			  $lo = $bot['login'].' ('.$i.')';
			  mysql_query('UPDATE `users` SET `battle` = "'.$this->info['id'].'", `login` = "'.$lo.'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
			  mysql_query('UPDATE `stats` SET `team` = "'.$this->users[$this->uids[$uid1]]['team'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
			  $logins .= $lo.', ';
			  
			  $logins_bot = array();
			  $bot = $u->addNewbot(528, null, null, $logins_bot);
			  $logins_bot = $bot['logins_bot'];
			  $lo = $bot['login'].' ('.$i.')';
			  mysql_query('UPDATE `users` SET `battle` = "'.$this->info['id'].'", `login` = "'.$lo.'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
			  mysql_query('UPDATE `stats` SET `team` = "'.$this->users[$this->uids[$uid1]]['team'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
			  $logins .= $lo.', ';
			  
			  $logins_bot = array();
			  $bot = $u->addNewbot(531, null, null, $logins_bot);
			  $logins_bot = $bot['logins_bot'];
			  $lo = $bot['login'].' ('.$i.')';
			  mysql_query('UPDATE `users` SET `battle` = "'.$this->info['id'].'", `login` = "'.$lo.'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
			  mysql_query('UPDATE `stats` SET `team` = "'.$this->users[$this->uids[$uid1]]['team'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
			  $logins .= $lo.', ';
			  
		  }
			  $logins = rtrim($logins, ', ');
			  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			  $mas['text'] = '{tm1} {u1} призвала в поединок <b>'.$logins.'</b>';
			  $this->add_log($mas);
			  $u->addAction(time(), 'use::emi_gora::'.$this->info['id'], 0, $this->users[$this->uids[$uid1]]['id']);
		
		
		}
		
		
	}elseif(rand(0,100) <= 10) {
				$krit = rand(0,1);
				if($krit == 0) {
					$khp = 400;
					$color = 'green';
				}else{
					$khp = 800;
					$color = 'red';
				}
				$this->stats[$this->uids[$uid2]]['hpNow'] -= $khp;
				$this->users[$this->uids[$uid2]]['hpNow'] -= $khp;
				$this->users[$this->uids[$uid2]]['last_hp'] =- $khp;
				mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
				$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
				$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
				$mas['text'] = '{tm1} {u1} нанес урон по врагу {u2} с помощью приема <b>&quot;Тактический Укол&quot; <font color='.$color.'>- '.$khp.'</b></font> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
				$this->add_log($mas);
				
				$pr_vars['priem_use'][0]['chance'] = 1010 ;
				$pr_vars['priem_use'][0]['name'] = 'Потеря Подвижности';
				$pr_vars['priem_use'][0]['id'] = 204;
				$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		
	}elseif(rand(0,100) <= 7) {
		
		$hpOG = rand(400,450);
		$this->users[$this->uids[$uid2]]['hpNow'] -= $hpOG;
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $hpOG;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $hpOG;
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
	    $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
	    $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
	    $mas['text'] = '{tm1} {u1} нанес удар по {u2} с помощью приема <b>&quot;Оглушающий Удар&quot; - <font color=green>'.$hpOG.'</font></b> ['.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
	    $this->add_log($mas);
		
	}elseif($this->hodID == 9 || $this->hodID == 16 || $this->hodID == 19 || $this->hodID == 24 || $this->hodID == 29 || $this->hodID == 34 || $this->hodID == 39 || $this->hodID == 44 || $this->hodID == 49 || $this->hodID == 54 || $this->hodID == 59 || $this->hodID == 64 || $this->hodID == 69 || $this->hodID == 74 || $this->hodID == 79 || $this->hodID == 84 || $this->hodID == 89 || $this->hodID == 94 || $this->hodID == 99 || $this->hodID == 104) {
		
		$hpNow = rand(250,300);
		
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $hpNow;
		
		$this->users[$this->uids[$uid2]]['hpNow'] -= $hpNow;
		
		$this->users[$this->uids[$uid2]]['last_hp'] =- $hpNow;
		
		$this->stats[$this->uids[$uid1]]['hpNow'] += $hpNow/2;
		
		$this->users[$this->uids[$uid1]]['hpNow'] += $hpNow/2;
		
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
		
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid1]]['hpNow'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid1]]['id'].'" LIMIT 1');
		
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		
		$mas['text'] = '{tm1} {u1} восстановил здоровье с помощью приема <b>&quot;Темное Ранение&quot; <font color=green> + '.ceil(($hpNow/2)).'</font></b> ['.(ceil($this->stats[$this->uids[$uid1]]['hpNow'])).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].'] <br> {tm2} {u2} утратил здоровье от приема <b>&quot;Темное Ранение&quot; <font color=green> - '.$hpNow.' </font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		
		$this->add_log($mas);
		
	}
			$pr_vars['priem_regen']['hp'] = 500;
			$pr_vars['priem_regen']['chance'] = 10;
			$pr_vars['priem_regen']['name'] = 'Эликсир Лечения';
}



if($this->users[$this->uids[$uid1]]['bot_id'] == 701) { // Заводчик
	if($this->hodID > 2) {
	$pes = $u->testAction('`uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `vars` = "use::pes_gora::'.$this->info['id'].'" LIMIT 1', 1);
	if(!isset($pes['id'])) {
		  for($i = 1; $i <= 4; $i++) {
			  $logins_bot = array();
			  $bot = $u->addNewbot(538, null, null, $logins_bot);
			  $logins_bot = $bot['logins_bot'];
			  $lo = $bot['login'].' ('.$i.')';
			  mysql_query('UPDATE `users` SET `battle` = "'.$this->info['id'].'", `login` = "'.$lo.'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
			  mysql_query('UPDATE `stats` SET `team` = "'.$this->users[$this->uids[$uid1]]['team'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
			  $logins .= $lo.', ';
		  }
			  $logins = rtrim($logins, ', ');
			  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			  $mas['text'] = '{tm1} {u1} призвал в поединок <b>'.$logins.'</b>';
			  $this->add_log($mas);
			  $u->addAction(time(), 'use::pes_gora::'.$this->info['id'], 0, $this->users[$this->uids[$uid1]]['id']);
		}
	}
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 702) { //Эмиссар Ордена
	$pr_use = 1;
	if($this->hodID == 4 || $this->hodID == 8 || $this->hodID == 13 || $this->hodID == 16 || $this->hodID == 20 || $this->hodID == 24 || $this->hodID == 28 || $this->hodID == 32 || $this->hodID == 36 || $this->hodID == 40 || $this->hodID == 44 || $this->hodID == 48 || $this->hodID == 52) {
		
	$pr_vars['priem_use'][0]['chance'] = 1010;
	$pr_vars['priem_use'][0]['name'] = 'Спасательный Плащ';
	$pr_vars['priem_use'][0]['id'] = 140;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	
}elseif($this->hodID == 6 || $this->hodID == 12 || $this->hodID == 18 || $this->hodID == 24 || $this->hodID == 29 || $this->hodID == 37 || $this->hodID == 42 || $this->hodID == 48 || $this->hodID == 54 || $this->hodID == 61 ) {
	
		$zhp = rand(550,600);
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $zhp;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $zhp;
		$this->stats[$this->uids[$uid1]]['hpNow'] += $zhp/2;
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid1]]['hpNow'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid1]]['id'].'" LIMIT 1');
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} {u1} восстановил здоровье от приема <b>&quot;Засадить Клинок&quot; <font color=green> + '.ceil(($zhp/2)).'</font></b> ['.(ceil($this->stats[$this->uids[$uid1]]['hpNow'])).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].'] <br> {tm2} {u2} утратил здоровье от приема <b>&quot;Засадить Клинок&quot; <font color=green> - '.$zhp.' </font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		$this->add_log($mas);
		
}elseif($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50) {
		$khp = rand(350,400);
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $khp;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $khp;
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} {u1} нанес урон по врагу {u2} с помощью приема <b>&quot;Тактический Укол&quot; - '.$khp.'</b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		$this->add_log($mas);
	}
}


//бездна

if($this->users[$this->uids[$uid1]]['bot_id'] == 353) {
### Служитель Бездны [9] - Бездна 3 этаж
/* (1200HP)
Сила: 50
Ловкость: 15
Интуиция: 15
Выносливость: 50
Интеллект: 0
Мудрость: 0
1 удар 2 зоны блоков. Профильный урон: дробящий, стихийные атаки: огонь.
Использует приёмы:
"Проклятье Бездны" - каст магией тьмы.
"Камнепад" - каст магией земли, на всю команду.
"Аура Святости" - аналог "Призрачной Защиты"
"Воля К Победе" .
 * */
	$pr_use = 1;
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 350 || $this->users[$this->uids[$uid1]]['bot_id'] == 351) {
### Служитель Глубин [8] - Бездна 1-3 этаж
  $pr_vars['priem_team_f'][0]['chance'] = 85;
  $pr_vars['priem_team_f'][0]['name'] = '<font color=darkblue>Проклятие Бездны</font>';
  $pr_vars['priem_team_f'][0]['x'] = 1;
  $pr_vars['priem_team_f'][0]['type'] = 0;
  $pr_vars['priem_team_f'][0]['hp'] = 0;
  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(99,199);
  $pr_vars['priem_team_f'][0]['priem'] = 164;
  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
  $pr_vars['priem_team_f'][0]['on'] = $uid;
  $pr_vars['priem_team_f'][0]['nomf'] = 0;
  $pr_vars['priem_team_f'][0]['fiz'] = 0;
  $pr_vars['priem_team_f'][0]['krituet'] = true;
  
  	$pr_vars['priem_regen']['hp'] = rand(40,45);
	$pr_vars['priem_regen']['chance'] = 20;
	$pr_vars['priem_regen']['name'] = 'Воля к победе';
  


  
	$pr_use = 1;
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 158) {
### Гарл Йонни Салистон [9] - Бездна 3 этаж

	// Хлебнуть Крови - аналог Полной Защите
	$pr_vars['priem_use'][0]['chance'] = 20;
	$pr_vars['priem_use'][0]['name'] = 'Хлебнуть Крови';
	$pr_vars['priem_use'][0]['id'] = 240;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	// Слепая удача.
	$pr_vars['priem_use'][1]['chance'] = 40;
	$pr_vars['priem_use'][1]['name'] = 'Слепая удача';
	$pr_vars['priem_use'][1]['id'] = 47;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][2]['chance'] = 45;
	$pr_vars['priem_use'][2]['name'] = 'Ярость';
	$pr_vars['priem_use'][2]['id'] = 14;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][3]['chance'] = 50;
	$pr_vars['priem_use'][3]['name'] = 'Стойкость';
	$pr_vars['priem_use'][3]['id'] = 13;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_regen']['hp'] = rand(40,45);
	$pr_vars['priem_regen']['chance'] = 20;
	$pr_vars['priem_regen']['name'] = 'Воля к победе';


	$pr_use = 1;
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 152) {
### Ольгерт Вирт [10] - Бездна 2 этаж

	// Сильный удар.
	$pr_vars['priem_use'][0]['chance'] = 20;
	$pr_vars['priem_use'][0]['name'] = 'Сильный удар';
	$pr_vars['priem_use'][0]['id'] = 4;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	// Активная защита.
	$pr_vars['priem_use'][1]['chance'] = 20;
	$pr_vars['priem_use'][1]['name'] = 'Активная защита';
	$pr_vars['priem_use'][1]['id'] = 7;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	// Стойкость.
	$pr_vars['priem_use'][2]['chance'] = 20;
	$pr_vars['priem_use'][2]['name'] = 'Стойкость';
	$pr_vars['priem_use'][2]['id'] = 13;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

	// Ярость.
	$pr_vars['priem_use'][3]['chance'] = 20;
	$pr_vars['priem_use'][3]['name'] = 'Ярость';
	$pr_vars['priem_use'][3]['id'] = 14;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

	// Обречённость, срабатывает если у цели родной ловкости больше 30-ти...
	if( (int)$u->lookStats($this->users[$this->uids[$uid2]]['stats'])['s2'] > 30) {
		$pr_vars['priem_use'][4]['chance'] = 22;
		$pr_vars['priem_use'][4]['name'] = 'Обречённость';
		$pr_vars['priem_use'][4]['id'] = 204;
		$pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];
	}
	//Ошеломить, срабатывает если у цели родного мудрости больше 10-ти...
	if( (int)$u->lookStats($this->users[$this->uids[$uid2]]['stats'])['s5'] > 10) {
		$pr_vars['priem_use'][4]['chance'] = 22;
		$pr_vars['priem_use'][4]['name'] = 'Ошеломить';
		$pr_vars['priem_use'][4]['id'] = 189;
		$pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];
	}

	//отрицание силы
if($this->hodID == 1) {
	if($this->stats[$this->uids[$uid2]]['s6'] <= 0) {
		$zaO = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = '.$this->users[$this->uids[$uid1]]['id'].' AND `name` LIKE "%Отрицание Силы%" AND `delete` = 0 LIMIT 1'));
		if(!isset($zaO['id'])) {
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid1]]['id'].'","Отрицание Силы","add_za=500","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","0","spell_godprotect10.gif","1","-1")');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u2} решил что его спасение, это прием <b>&quot;Отрицание Силы&quot;</b>';
			$this->add_log($mas);
		}
	}elseif($this->stats[$this->uids[$uid2]]['s5'] > 35 && $this->stats[$this->uids[$uid2]]['s6'] > 15) {
		$zmO = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = '.$this->users[$this->uids[$uid1]]['id'].' AND `name` LIKE "%Отрицание Слова%" AND `delete` = 0 LIMIT 1'));
		if(!isset($zmO['id'])) {
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid1]]['id'].'","Отрицание Слова","add_zm=500","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","0","spell_godprotect.gif","1","-1")');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u2} решил что его спасение, это прием <b>&quot;Отрицание Слова&quot;</b>';
			$this->add_log($mas);
		}
	}
}

//последняя воля
if($hp <= 33) {
	$vol = mysql_fetch_array(mysql_query('SELECT `id`,`hod` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `name` LIKE "%Последняя Воля%" AND `delete` = 0 LIMIT 1 '));
	if(!isset($vol['id'])) {
		mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid1]]['id'].'","Последняя Воля","from_bezdna","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","351","new_reg.gif","1","'.rand(8,10).'")');
	}elseif(isset($vol['id']) && $vol['hod'] < 2) {
		$cikl = mysql_query('SELECT `id`,`login`,`battle` FROM `users` WHERE `battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'"');
		while($cl = mysql_fetch_array($cikl)) {
			$hpO = $this->stats[$this->uids[$cl['id']]]['hpNow'];
			$this->stats[$this->uids[$cl['id']]]['hpNow'] -= $hpO;
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$cl['id']]]['hpNow'].'" WHERE `id` = "'.$cl['id'].'" LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$cl['id']]]['sex'].'||t1='.$this->users[$this->uids[$cl['id']]]['team'].'||login1='.$this->users[$this->uids[$cl['id']]]['login'].'||s2='.$this->users[$this->uids[$cl['id']]]['sex'].'||t2='.$this->users[$this->uids[$cl['id']]]['team'].'||login2='.$this->users[$this->uids[$cl['id']]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} <a>Ольгерт Вирт</a> использовал последнюю волю на <b>'.$cl['login'].' - <font color=green>'.(ceil($hpO)).'</b></font> ['.$this->stats[$this->uids[$cl['id']]]['hpNow'].'/'.$this->stats[$this->uids[$cl['id']]]['hpAll'].']';
			$this->add_log($mas);
		}
	}
}

	
	
	
	$pr_vars['hp'] = mysql_fetch_array(mysql_query('SELECT hp as `Now`, hpAll as `All` FROM `battle_users` WHERE `uid` = "'.$uid1.'" LIMIT 1'));
	$pr_vars['hp']['Ustalost'] = round(85 - ($pr_vars['hp']['Now'] / ($pr_vars['hp']['All']/100))) ;
	// Усталость
	if( $pr_vars['hp']['Now'] != 0 AND $pr_vars['hp']['Now'] / ($pr_vars['hp']['All']/100) < 85  ) {
		if( $pr_vars['hp']['Ustalost'] > 0 ){
			if($pr_vars['hp']['Ustalost'] > 33){
				$pr_vars['hp']['Ustalost'] = 33;
			}
			$pr_vars['hp']['exist'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `delete` = "0" AND `id_eff` = "5" AND `uid` = "'.$uid1.'" LIMIT 1'));
			if($pr_vars['hp']['exist']) { // Если существует
				mysql_query('UPDATE `eff_users` SET `data` = "add_m10=-'.$pr_vars['hp']['Ustalost'].'0", `name` = "Усталость -'.$pr_vars['hp']['Ustalost'].'%" WHERE `delete` = "0" AND `id_eff` = "5" AND `uid` = "'.$uid1.'" LIMIT 1');
			} else { // Если не существует
				mysql_query('INSERT INTO `eff_users` (`id_eff`, `uid`, `img2`, `name`, `data`, `user_use`,`timeUse`, `delete`, `v1`, `v2`, `x`, `no_Ace`) VALUES (5, '.$uid1.', "eff_travma.gif", "Усталость -'.$pr_vars['hp']['Ustalost'].'%", "add_m10=-'.$pr_vars['hp']['Ustalost'].'0", "'.$uid1.'","77", "0", "priem", "292", "1", "1")');
			}
		}
	}
	unset($pr_vars['hp']);
	$pr_use = 1;
}



if($this->users[$this->uids[$uid1]]['bot_id'] == 254) {
###берсерк
  $pr_use = 1; 
  
  if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 70 || $this->hodID == 75) {
	  $pr_vars['priem_regen']['hp'] = 75;
	  $pr_vars['priem_regen']['chance'] = 1010;
	  $pr_vars['priem_regen']['name'] = 'Регенерация';
  }
  
  $pr_vars['priem_use'][0]['chance'] = 55;
  $pr_vars['priem_use'][0]['name'] = 'Удачный удар';
  $pr_vars['priem_use'][0]['id'] = 11;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
 
  
  $pr_vars['priem_use'][1]['chance'] = 60;
  $pr_vars['priem_use'][1]['name'] = 'Ярость';
  $pr_vars['priem_use'][1]['id'] = 14;
  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][2]['chance'] = 65;
  $pr_vars['priem_use'][2]['name'] = 'Раздробить череп';
  $pr_vars['priem_use'][2]['id'] = 219;
  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
  
}

if( $this->users[$this->uids[$uid1]]['bot_id'] == 251) {
	$pr_use = 1;
	
	$pr_vars['priem_regen']['hp'] = 500;
	$pr_vars['priem_regen']['chance'] = 15;
	$pr_vars['priem_regen']['name'] = 'Эликсир Лечения';
	
	$pr_vars['priem_use'][0]['chance'] = 55;
	$pr_vars['priem_use'][0]['name'] = 'Сонный Яд';
	$pr_vars['priem_use'][0]['id'] = 352;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	
	$pr_vars['priem_use'][1]['chance'] = 20;
    $pr_vars['priem_use'][1]['name'] = 'Шокирующий Удар';
    $pr_vars['priem_use'][1]['id'] = 235;
    $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][2]['chance'] = 50;
	$pr_vars['priem_use'][2]['name'] = 'Ярость';
	$pr_vars['priem_use'][2]['id'] = 14;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][3]['chance'] = 45;
	$pr_vars['priem_use'][3]['name'] = 'Танец Лезвий';
	$pr_vars['priem_use'][3]['id'] = 48;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
}

if( $this->users[$this->uids[$uid1]]['bot_id'] == 281) {
	$pr_use = 1;
	
	$pr_vars['priem_use'][0]['chance'] = 35;
	$pr_vars['priem_use'][0]['name'] = 'Проклятие Бродячего Мертвеца';
	$pr_vars['priem_use'][0]['id'] = 353;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
}

if( $this->users[$this->uids[$uid1]]['bot_id'] == 276 || $this->users[$this->uids[$uid1]]['bot_id'] == 278) {
	$pr_use = 1;
	
	$pr_vars['priem_use'][0]['chance'] = 55;
	$pr_vars['priem_use'][0]['name'] = 'Стылое Касание';
	$pr_vars['priem_use'][0]['id'] = 355;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	
	$pr_vars['priem_use'][1]['chance'] = 50;
	$pr_vars['priem_use'][1]['name'] = 'Ядовитый Укус';
	$pr_vars['priem_use'][1]['id'] = 354;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid2]];
	
	$mgn = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `v2` = 354 LIMIT 1'));
	if(isset($mgn['id'])) {
		 $yrb = rand(30,70);
		 $this->stats[$this->uids[$uid2]]['hpNow'] -= $yrb;
		 $this->users[$this->uids[$uid2]]['last_hp'] =- $yrb;
		 mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->users[$this->uids[$uid2]]['id'].'" LIMIT 1');
		 $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		 $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		 $mas['text'] = '{tm1} {u2} получил повреждение от приема <b>&quot;Ядовитый Укус&quot; <font color=green> - '.$yrb.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		 $this->add_log($mas);
	}
}

if( $this->users[$this->uids[$uid1]]['bot_id'] == 285) {
	$pr_use = 1;
	
	$pr_vars['priem_use'][0]['chance'] = 40;
	$pr_vars['priem_use'][0]['name'] = 'Удар Убийцы';
	$pr_vars['priem_use'][0]['id'] = 138;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][1]['chance'] = 50;
	$pr_vars['priem_use'][1]['name'] = 'Ярость';
	$pr_vars['priem_use'][1]['id'] = 14;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][2]['chance'] = 50;
	$pr_vars['priem_use'][2]['name'] = 'Стойкость';
	$pr_vars['priem_use'][2]['id'] = 13;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][3]['chance'] = 50;
	$pr_vars['priem_use'][3]['name'] = 'Абсолютная Защита';
	$pr_vars['priem_use'][3]['id'] = 140;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
}
//Повелитель
if( $this->users[$this->uids[$uid1]]['bot_id'] == 288) {
	$pr_use =1;
	if($hp <= 100 && $hp >= 80) {
		$pr_vars['priem_use'][0]['chance'] = 100;
		$pr_vars['priem_use'][0]['name'] = 'Стремительность';
		$pr_vars['priem_use'][0]['id'] = 359;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}elseif($hp <= 80 && $hp >= 70) {
		$pr_vars['priem_use'][1]['chance'] = 100;
		$pr_vars['priem_use'][1]['name'] = 'Смертоносность';
		$pr_vars['priem_use'][1]['id'] = 358;
		$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
		mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `v2` = 347');
	}elseif($hp <= 70 && $hp >= 50) {
		$pr_vars['priem_use'][2]['chance'] = 100;
		$pr_vars['priem_use'][2]['name'] = 'Стойкость';
		$pr_vars['priem_use'][2]['id'] = 357;
		$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
		mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `v2` = 348');
	}elseif($hp <= 50) {
		$pr_vars['priem_use'][3]['chance'] = 100;
		$pr_vars['priem_use'][3]['name'] = 'Равновесие';
		$pr_vars['priem_use'][3]['id'] = 356;
		$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
		mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `v2` = 349');
	}
	
	 $pr_vars['priem_use'][4]['chance'] = 30;
	 $pr_vars['priem_use'][4]['name'] = 'Ярость';
	 $pr_vars['priem_use'][4]['id'] = 14;
	 $pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][5]['chance'] = 30;
	 $pr_vars['priem_use'][5]['name'] = 'Стойкость';
	 $pr_vars['priem_use'][5]['id'] = 13;
	 $pr_vars['priem_use'][5]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][6]['chance'] = 25;
	 $pr_vars['priem_use'][6]['name'] = 'Полная Защита';
	 $pr_vars['priem_use'][6]['id'] = 45;
	 $pr_vars['priem_use'][6]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][7]['chance'] = 35;
	 $pr_vars['priem_use'][7]['name'] = 'Второе Дыхание';
	 $pr_vars['priem_use'][7]['id'] = 49;
	 $pr_vars['priem_use'][7]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][8]['chance'] = 20;
	 $pr_vars['priem_use'][8]['name'] = 'Обречённость';
	 $pr_vars['priem_use'][8]['id'] = 204;
	 $pr_vars['priem_use'][8]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][9]['chance'] = 25;
	 $pr_vars['priem_use'][9]['name'] = 'Превосходство';
	 $pr_vars['priem_use'][9]['id'] = 139;
	 $pr_vars['priem_use'][9]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][10]['chance'] = 45;
	 $pr_vars['priem_use'][10]['name'] = 'Удачный Удар';
	 $pr_vars['priem_use'][10]['id'] = 11;
	 $pr_vars['priem_use'][10]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][11]['chance'] = 20;
	 $pr_vars['priem_use'][11]['name'] = 'Хлебнуть Крови';
	 $pr_vars['priem_use'][11]['id'] = 240;
	 $pr_vars['priem_use'][11]['on'] = $this->users[$this->uids[$uid1]];
	 
	 
	
}
//Епископ
if( $this->users[$this->uids[$uid1]]['bot_id'] == 266) {
	$pr_use = 1;
	
	if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 70 || $this->hodID == 75) {
		
		$pr_vars['priem_regen']['hp'] = 300;
		$pr_vars['priem_regen']['chance'] = 1010;
		$pr_vars['priem_regen']['name'] = 'Лечение';
		
	}
	
	 $pr_vars['priem_use'][0]['chance'] = 30;
	 $pr_vars['priem_use'][0]['name'] = 'Ярость';
	 $pr_vars['priem_use'][0]['id'] = 14;
	 $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][1]['chance'] = 25;
	 $pr_vars['priem_use'][1]['name'] = 'Обречённость';
	 $pr_vars['priem_use'][1]['id'] = 204;
	 $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][2]['chance'] = 20;
	 $pr_vars['priem_use'][2]['name'] = 'Активная защита';
	 $pr_vars['priem_use'][2]['id'] = 7;
	 $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][3]['chance'] = 40;
	 $pr_vars['priem_use'][3]['name'] = 'Коварный Уход';
	 $pr_vars['priem_use'][3]['id'] = 213;
	 $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
	
	if(rand(0,100) <= 2) {
		$tp = mysql_fetch_array(mysql_query('SELECT `id`,`x` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `name` LIKE "%Святая Ярость%" AND `delete` = 0 LIMIT 1'));
		$name = '<b>Святая Ярость</b>';
		if(!isset($tp['id'])) {
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid2]]['id'].'","'.$name.'","add_za=-125|add_zm=-125","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","0","wis_gray_magicdestroy.gif","1","-1")');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} использовал прием &quot;'.$name.'&quot; на персонажа {u2}';
			$this->add_log($mas);
		}
	}
}
//хищная слизь
if( $this->users[$this->uids[$uid1]]['bot_id'] == 273) {
	$pr_use = 1;
	
	if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 70 || $this->hodID == 75) {
		$pr_vars['priem_regen']['hp'] = 75;
		$pr_vars['priem_regen']['chance'] = 45;
		$pr_vars['priem_regen']['name'] = 'Регенерация';
	}
	
	$pr_vars['priem_use'][1]['chance'] = 50;
	$pr_vars['priem_use'][1]['name'] = 'Воля к победе';
	$pr_vars['priem_use'][1]['id'] = 6;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	
	 $pr_vars['priem_use'][2]['chance'] = 30;
	 $pr_vars['priem_use'][2]['name'] = 'Ярость';
	 $pr_vars['priem_use'][2]['id'] = 14;
	 $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][3]['chance'] = 25;
     $pr_vars['priem_use'][3]['name'] = 'Удачный удар';
     $pr_vars['priem_use'][3]['id'] = 11;
     $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
	
	 if(rand(0,100) <= 20) {
		 $hp_damage = rand(100,800);
		 $this->stats[$this->uids[$uid2]]['hpNow'] -= $hp_damage;
		 $this->users[$this->uids[$uid2]]['last_hp'] =- $hp_damage;
		 mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'", `last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
		 $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		 $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		 $mas['text'] = '{tm1} {u2} получил повреждение от приема <b>&quot;Кислотный Плевок&quot; - <font color=green>'.$hp_damage.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
	     $this->add_log($mas);
	 }
	
	if(rand(0,100) <= 35) {
		$tp = mysql_fetch_array(mysql_query('SELECT `id`,`x` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `name` LIKE "%Поцелуй Слизи%" AND `delete` = 0 LIMIT 1'));
		$name = '<b>Поцелуй Слизи x'.(1+$tp['x']).'</b>';
		if(!isset($tp['id'])) {
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid2]]['id'].'","'.$name.'","add_za=-100","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","0","wis_earth_heal08.gif","1","-1")');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} использовал прием &quot;'.$name.'&quot; на персонажа {u2}';
			$this->add_log($mas);
		}elseif($tp['x'] < 5) {
			mysql_query('UPDATE `eff_users` SET `name` = "'.$name.'", `data` = "add_za=-'.(100+$tp['x']*100).' ", `x` = `x` + 1 WHERE `id` = "'.$tp['id'].'" LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} использовал прием &quot;'.$name.'&quot; на персонажа {u2}';
			$this->add_log($mas);
		}
	}
}
//Чернокнижник
if($this->users[$this->uids[$uid1]]['bot_id'] == 275) {
	$pr_use = 1;
					$now = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `name` LIKE "%Выпить Душу%" AND `delete` = 0 LIMIT 1'));
					if(isset($now['id'])) {
						$goHp = rand(37,99);
						 $pr_vars['priem_regen']['hp'] = $goHp;
						 $pr_vars['priem_regen']['chance'] = 100;
						 $pr_vars['priem_regen']['name'] = 'Выпить Душу';
						 $this->stats[$this->uids[$uid2]]['hpNow'] -= $pr_vars['priem_regen']['hp'];
						 $this->users[$this->uids[$uid2]]['last_hp'] =- $pr_vars['priem_regen']['hp'];
						 mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'", `last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->users[$this->uids[$uid2]]['id'].'" LIMIT 1');
					}
					  $pr_vars['priem_use'][0]['chance'] = 40;
					  $pr_vars['priem_use'][0]['name'] = 'Выпить Душу';
					  $pr_vars['priem_use'][0]['id'] = 362;
					  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
					  
					  $pr_vars['priem_use'][1]['chance'] = 20;
					  $pr_vars['priem_use'][1]['name'] = 'Проклятие Тьмы';
					  $pr_vars['priem_use'][1]['id'] = 360;
					  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid2]];
					  
					  $pr_vars['priem_use'][2]['chance'] = 14;
					  $pr_vars['priem_use'][2]['name'] = 'Стойкость';
					  $pr_vars['priem_use'][2]['id'] = 13;
					  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

					  $pr_vars['priem_use'][3]['chance'] = 15;
					  $pr_vars['priem_use'][3]['name'] = 'Ярость';
					  $pr_vars['priem_use'][3]['id'] = 14;
					  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
					  
			  
}
  //Проклятый пленник
if($this->users[$this->uids[$uid1]]['bot_id'] == 279) {
	/*Теневой Двойник*/
			$clon = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `login` LIKE "%'.$this->users[$this->uids[$uid2]]['login'].' (клон%" AND `battle` = "'.$this->users[$this->uids[$uid2]]['battle'].'" LIMIT 1'));
			//Добавляем бота
			if(!isset($clon['id']) && rand(0,100) <= 20) {
			$clone = array(
				'id' => $this->users[$this->uids[$uid2]]['id'],
				'login' => $this->users[$this->uids[$uid2]]['login'].' (клон)',
				'level' => $this->users[$this->uids[$uid2]]['level'],
				'city' => $this->users[$this->uids[$uid2]]['city'],
				'cityreg' => $this->users[$this->uids[$uid2]]['cityreg'],
				'name' => $this->users[$this->uids[$uid2]]['name'],
				'sex' => $this->users[$this->uids[$uid2]]['sex'],
				'deviz' => $this->users[$this->uids[$uid2]]['deviz'],
				'hobby' => $this->users[$this->uids[$uid2]]['hobby'],
				'time_reg' => $this->users[$this->uids[$uid2]]['time_reg'],
				'obraz' => $this->users[$this->uids[$uid2]]['obraz'],
				'stats' => $this->users[$this->uids[$uid2]]['stats'],
				'upLevel' => $this->users[$this->uids[$uid2]]['upLevel'],
				'priems' => $this->users[$this->uids[$uid2]]['priems'],
				'loclon' => true,
				'inTurnir' => $this->users[$this->uids[$uid2]]['inTurnir']
			);
				$bot = $u->addNewbot(1,NULL,$clone,NULL,true);
				mysql_query('UPDATE `stats` SET `team` = "'.$this->users[$this->uids[$uid1]]['team'].'",`hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`mpNow` = "'.$this->users[$this->uids[$uid2]]['mpNow'].'" WHERE `id` = "'.$bot.'" LIMIT 1');
				mysql_query('UPDATE `users` SET `battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'" WHERE `id` = "'.$bot.'" LIMIT 1');
				$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
				$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
				$mas['text'] = '{tm1} {u1} Использовал прием <b>&quot;Теневой Двойник&quot;</b> и клонировал персонажа <b>'.$this->users[$this->uids[$uid2]]['login'].'</b>';
				$this->add_log($mas);
				unset($clone,$bot);
		}
		/*END*/
		
		
		#Выявить Грехи
		if($hp <= 80 && rand(0, 100) <= 30) {
			$ghp = round($this->stats[$this->uids[$uid2]]['hpNow']/100*rand(5,10));
			$this->stats[$this->uids[$uid1]]['hpNow'] += $ghp;
			mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid1]]['hpNow'].' WHERE `id` = '.$this->stats[$this->uids[$uid1]]['id'].' LIMIT 1'); //добавляем хп плену
			$this->stats[$this->uids[$uid2]]['hpNow'] -= $ghp;
			$this->users[$this->uids[$uid2]]['last_hp'] =- $ghp;
			mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].', `last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = '.$this->stats[$this->uids[$uid2]]['id'].' LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} Применил прием <b><font color=bagr>&quot;Выявить Грехи&quot;</b></font> и восстановил свое здоровье <b><font color=green> + '.$ghp.' ['.ceil($this->stats[$this->uids[$uid1]]['hpNow']).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']</b></font>';
			$this->add_log($mas);
		}
			  $pr_use = 1;
			  
			  $pr_vars['priem_team_f'][0]['chance'] = 30;
			  $pr_vars['priem_team_f'][0]['name'] = '<font color=darkblue>Слово Боли</font>';
			  $pr_vars['priem_team_f'][0]['x'] = 1;
			  $pr_vars['priem_team_f'][0]['type'] = 0;
			  $pr_vars['priem_team_f'][0]['hp'] = 0;
			  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(25,100);
			  $pr_vars['priem_team_f'][0]['priem'] = 164;
			  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
			  $pr_vars['priem_team_f'][0]['on'] = $uid;
			  $pr_vars['priem_team_f'][0]['nomf'] = 0;
			  $pr_vars['priem_team_f'][0]['fiz'] = 0;
			  $pr_vars['priem_team_f'][0]['krituet'] = true;
			  
			  
	}
	
	if( $this->users[$this->uids[$uid1]]['bot_id'] == 283 && $this->users[$this->uids[$uid1]]['bot_id'] != 275) {
		
			  $pr_use = 1;
			  
				 //Украсть душу
				 if($hp <= 35) {
					$now = mysql_fetch_array(mysql_query('SELECT `id`,`hod`,`data`,`x` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `v2` = 361 AND `delete` = 0 LIMIT 1'));
					if(!isset($now['id'])) {
						 $pr_vars['priem_regen']['hp'] = floor($this->stats[$this->uids[$uid2]]['hpNow']);
						 $pr_vars['priem_regen']['chance'] = 100;
						 $pr_vars['priem_regen']['name'] = 'Украсть Душу';
						 $this->stats[$this->uids[$uid2]]['hpNow'] -= $pr_vars['priem_regen']['hp'];
						 $this->users[$this->uids[$uid2]]['last_hp'] =- $pr_vars['priem_regen']['hp'];
						 
						 echo $now['x'];
						 //если хп == 0
						 if( $this->stats[$this->uids[$uid2]]['hpNow'] < 1 ) {
							 $this->stats[$this->uids[$uid2]]['hpNow'] = 100;
						 }
						 mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'", `last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->users[$this->uids[$uid2]]['id'].'" LIMIT 1');
						 
					}
						if($now['hod'] < 2) {
							mysql_query('UPDATE `eff_users` SET `data` = "add_m10=-'.(70+($now['x']*70)).'|add_m11=-'.(70+($now['x']*70)).'", `hod` = "20", `x` = `x` +1 WHERE `id` = "'.$now['id'].'" LIMIT 1');
						 }
					  
					  $pr_vars['priem_use'][0]['chance'] = 100;
					  $pr_vars['priem_use'][0]['name'] = 'Украденная Душа';
					  $pr_vars['priem_use'][0]['id'] = 361;
					  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
					  
				 }else{
					  $pr_vars['priem_use'][0]['chance'] = 35;
					  $pr_vars['priem_use'][0]['name'] = 'Стойкость';
					  $pr_vars['priem_use'][0]['id'] = 13;
					  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

					  $pr_vars['priem_use'][1]['chance'] = 35;
					  $pr_vars['priem_use'][1]['name'] = 'Ярость';
					  $pr_vars['priem_use'][1]['id'] = 14;
					  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
					  
					  $pr_vars['priem_use'][2]['chance'] = 30;
					  $pr_vars['priem_use'][2]['name'] = 'Шокирующий Удар';
					  $pr_vars['priem_use'][2]['id'] = 235;
					  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
				 }
				 
			  
	}
	
  
  if($this->users[$this->uids[$uid1]]['bot_id'] == 284) {
###Жора
//пришпилить(х5)
if(rand(0,100) <= 10) {
		$tp = mysql_fetch_array(mysql_query('SELECT `id`,`x` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `name` LIKE "%Пришпилить%" AND `delete` = 0 LIMIT 1'));
		$name = '<b>Пришпилить x'.(1+$tp['x']).'</b>';
		if(!isset($tp['id'])) {
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid2]]['id'].'","'.$name.'","add_m10=-33|add_m8=-20|add_m6=-20|add_m2=-250|add_m4=-400|add_m5=-500","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","0","hp_natisk.gif","1","-1")');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} использовал прием &quot;'.$name.'&quot; на персонажа {u2}';
			$this->add_log($mas);
		}elseif($tp['x'] < 5) {
			mysql_query('UPDATE `eff_users` SET `name` = "'.$name.'", `data` = "add_m10=-'.(33+$tp['x']*33).'|add_m8=-'.(20+$tp['x']*20).'|add_m6=-'.(20+$tp['x']*20).'|add_m2=-'.(250+$tp['x']*250).'|add_m4=-'.(400+$tp['x']*400).'|add_m5=-'.(250+$tp['x']*250).' ", `x` = `x` + 1 WHERE `id` = "'.$tp['id'].'" LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} использовал прием &quot;'.$name.'&quot; на персонажа {u2}';
			$this->add_log($mas);
		}
	}
	//Гнилое дыхание(x5)
  	if(rand(0,100) <= 15) {
		$tp1 = mysql_fetch_array(mysql_query('SELECT `id`,`x` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `name` LIKE "%Гнилое Дыхание%" AND `delete` = 0 LIMIT 1'));
		$name = '<b>Гнилое Дыхание x'.(1+$tp1['x']).'</b>';
		if(!isset($tp1['id'])) {
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid2]]['id'].'","'.$name.'","add_hpRound=90|add_za=-50|from_kat","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","0","wis_water_cloud08.gif","1","-1")');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} использовал прием &quot;'.$name.'&quot; на персонажа {u2}';
			$this->add_log($mas);
		}elseif($tp1['x'] < 5) {
			mysql_query('UPDATE `eff_users` SET `data` = "add_hpRound='.(100 - ($tp1['x']*10) ).' ", `x` = `x` + 1 WHERE `id` = "'.$tp1['id'].'" LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} использовал прием &quot;'.$name.'&quot; на персонажа {u2}';
			$this->add_log($mas);
		}
	}
	
	//Сожрать
	if($hp <= 1) {
		$this->stats[$this->uids[$uid1]]['hpNow'] += $this->stats[$this->uids[$uid2]]['hpNow'];
		//жора
		mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].' WHERE `id` = '.$this->stats[$this->uids[$uid1]]['id'].' LIMIT 1');
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} {u1} восстановил здоровье, с помощью приема <b>&quot;Сожрать&quot;<font color=green> + '.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'&nbsp;</b></font> ['.$this->stats[$this->uids[$uid1]]['hpNow'].'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
		$this->add_log($mas);
	}
	
  $pr_use = 1; 
  
  
  $pr_vars['priem_use'][1]['chance'] = 15;
  $pr_vars['priem_use'][1]['name'] = 'Удачный удар';
  $pr_vars['priem_use'][1]['id'] = 11;
  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][2]['chance'] = 30;
  $pr_vars['priem_use'][2]['name'] = 'Искалечить';
  $pr_vars['priem_use'][2]['id'] = 292;
  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid2]];
  

  $pr_vars['priem_use'][3]['chance'] = 35;
  $pr_vars['priem_use'][3]['name'] = 'Ярость';
  $pr_vars['priem_use'][3]['id'] = 14;
  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
  
  
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 134) {
###Заблудшая Душа [10]
###To Do : Призрачный удар, Крик души
  $pr_use = 1;
	  $pr_vars['priem_use'][0]['chance'] = 35;
	  $pr_vars['priem_use'][0]['name'] = 'Приём';
	  $pr_vars['priem_use'][0]['id'] = 141;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
  
  
  if($this->hodID == 1) {
	  $this->stats[$this->uids[$uid2]]['hpNow'] -= 100;
	  $this->users[$this->uids[$uid2]]['last_hp'] =- 100;
	  mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].', `last_hp` = '.$this->users[$this->uids[$uid2]]['last_hp'].' WHERE `id` = '.$this->stats[$this->uids[$uid2]]['id'].' LIMIT 1');
	    $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} {u1}, применила прием <b>&quot;Призрачный Удар&quot;</b> на {u2} <b> - 100 </b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']<br>';
		$this->add_log($mas);  
  }
  if(rand(0,100) <= 45) {
  $btt = mysql_query('SELECT `u`.`id`,`u`.`login`,`st`.`team` FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`battle` = '.$this->users[$this->uids[$uid2]]['battle'].' AND `st`.`team` = '.$this->users[$this->uids[$uid2]]['team'].'');
  while($pl = mysql_fetch_array($btt)) {
	  $hpR = rand(70,80);
	  $this->stats[$this->uids[$pl['id']]]['hpNow'] -= $hpR;
	  $this->users[$this->uids[$pl['id']]]['last_hp'] =- $hpR;
	  mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$pl['id']]]['hpNow'].', `last_hp` = '.$this->users[$this->uids[$pl['id']]]['last_hp'].' WHERE `id` = '.$pl['id'].' LIMIT 1');
	  	$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} Заблудшая Душа, примена прием <b>&quotКрик Души&quot</b> на <b>'.$pl['login'].' <font color=green> - '.$hpR.'</font></b> ['.(ceil($this->stats[$this->uids[$pl['id']]]['hpNow'])).'/'.(ceil($this->stats[$this->uids[$pl['id']]]['hpAll'])).']<br>';
		$this->add_log($mas);  
  }
}
  
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 376) {
###Древнее проклятие Глубин [9]
  $pr_use = 1; 

  $pr_vars['priem_regen']['hp'] = 18;
  $pr_vars['priem_regen']['chance'] = 7;
  $pr_vars['priem_regen']['name'] = 'Утереть пот';

  $pr_vars['priem_use'][0]['chance'] = 10;
  $pr_vars['priem_use'][0]['name'] = 'Подставить лоб';
  $pr_vars['priem_use'][0]['id'] = 45;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][1]['chance'] = 8;
  $pr_vars['priem_use'][1]['name'] = 'Раздавить';
  $pr_vars['priem_use'][1]['id'] = 216;
  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][2]['chance'] = 13;
  $pr_vars['priem_use'][2]['name'] = 'Активная защита';
  $pr_vars['priem_use'][2]['id'] = 7;
  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][3]['chance'] = 6;
  $pr_vars['priem_use'][3]['name'] = 'Удачный удар';
  $pr_vars['priem_use'][3]['id'] = 11;
  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][4]['chance'] = 15;
  $pr_vars['priem_use'][4]['name'] = 'Стойкость';
  $pr_vars['priem_use'][4]['id'] = 13;
  $pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];

  $pr_vars['priem_use'][5]['chance'] = 15;
  $pr_vars['priem_use'][5]['name'] = 'Ярость';
  $pr_vars['priem_use'][5]['id'] = 14;
  $pr_vars['priem_use'][5]['on'] = $this->users[$this->uids[$uid1]];
  
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 126) {
###Маул Счастливчик [8]
  $pr_use = 1; 
  
  $pr_vars['priem_use'][0]['chance'] = 35;
  $pr_vars['priem_use'][0]['name'] = 'Удар Феникса';
  $pr_vars['priem_use'][0]['id'] = 216;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][1]['chance'] = 20;
  $pr_vars['priem_use'][1]['name'] = 'Слепая удача';
  $pr_vars['priem_use'][1]['id'] = 47;
  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][2]['chance'] = 40;
  $pr_vars['priem_use'][2]['name'] = 'Активная защита';
  $pr_vars['priem_use'][2]['id'] = 7;
  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][3]['chance'] = 50;
  $pr_vars['priem_use'][3]['name'] = 'Стойкость';
  $pr_vars['priem_use'][3]['id'] = 13;
  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

  $pr_vars['priem_use'][4]['chance'] = 48;
  $pr_vars['priem_use'][4]['name'] = 'Ярость';
  $pr_vars['priem_use'][4]['id'] = 14;
  $pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 372) {
	//пустынник атаман
	$pr_use = 1;
	
	$pr_vars['priem_use'][0]['chance'] = 15;
	$pr_vars['priem_use'][0]['name'] = 'Сильный Удар';
	$pr_vars['priem_use'][0]['id'] = 4;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][1]['chance'] = 10;
	$pr_vars['priem_use'][1]['name'] = 'Шокирующий Удар';
	$pr_vars['priem_use'][1]['id'] = 235;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 123) {
###Дарьяна Корт [8]
###To Do: Вытягивание души
  $pr_use = 1;

  $pr_vars['priem_regen']['hp'] = 600;
  $pr_vars['priem_regen']['chance'] = 20;
  $pr_vars['priem_regen']['name'] = 'Лечение';

  $pr_vars['priem_use'][0]['chance'] = 40;
  $pr_vars['priem_use'][0]['name'] = 'Активная защита';
  $pr_vars['priem_use'][0]['id'] = 7;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

  $pr_vars['priem_use'][1]['chance'] = 65;
  $pr_vars['priem_use'][1]['name'] = 'Стойкость';
  $pr_vars['priem_use'][1]['id'] = 13;
  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

  $pr_vars['priem_use'][2]['chance'] = 60;
  $pr_vars['priem_use'][2]['name'] = 'Ярость';
  $pr_vars['priem_use'][2]['id'] = 14;
  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 124) {
###Изгнанник Мглы [9]
  $pr_use = 1;
  
	$pr_vars['priem_use'][0]['chance'] = 4;
	$pr_vars['priem_use'][0]['name'] = 'Второе Дыхание';
	$pr_vars['priem_use'][0]['id'] = 49;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][1]['chance'] = 6;
	$pr_vars['priem_use'][1]['name'] = 'Удар Серпом';
	$pr_vars['priem_use'][1]['id'] = 219;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	
	
	$pr_vars['priem_use'][2]['chance'] = 8;
	$pr_vars['priem_use'][2]['name'] = 'Сильный Удар';
	$pr_vars['priem_use'][2]['id'] = 4;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][3]['chance'] = 10;
	$pr_vars['priem_use'][3]['name'] = 'Активная Защита';
	$pr_vars['priem_use'][3]['id'] = 7;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][4]['chance'] = 50;
	$pr_vars['priem_use'][4]['name'] = 'Слепая Удача';
	$pr_vars['priem_use'][4]['id'] = 47;
	$pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][5]['chance'] = 51;
	$pr_vars['priem_use'][5]['name'] = 'Стойкость';
	$pr_vars['priem_use'][5]['id'] = 13;
	$pr_vars['priem_use'][5]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][6]['chance'] = 52;
	$pr_vars['priem_use'][6]['name'] = 'Ярость';
	$pr_vars['priem_use'][6]['id'] = 14;
	$pr_vars['priem_use'][6]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_regen']['hp'] = 45;
	$pr_vars['priem_regen']['chance'] = 10;
	$pr_vars['priem_regen']['name'] = 'Воля к победе';

}

if($this->users[$this->uids[$uid1]]['bot_id'] == 125) {
###Страж Крантон [9]
	$pr_use = 1;

	$pr_vars['priem_use'][0]['chance'] = 25;
	$pr_vars['priem_use'][0]['name'] = 'Удар правым жвалом';
	$pr_vars['priem_use'][0]['id'] = 216;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][1]['chance'] = 25;
	$pr_vars['priem_use'][1]['name'] = 'Удачный удар';
	$pr_vars['priem_use'][1]['id'] = 11;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][2]['chance'] = 25;
	$pr_vars['priem_use'][2]['name'] = 'Коварный уход';
	$pr_vars['priem_use'][2]['id'] = 213;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][3]['chance'] = 25;
	$pr_vars['priem_use'][3]['name'] = 'Стойкость';
	$pr_vars['priem_use'][3]['id'] = 13;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][4]['chance'] = 25;
	$pr_vars['priem_use'][4]['name'] = 'Ярость';
	$pr_vars['priem_use'][4]['id'] = 14;
	$pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_regen']['hp'] = 45;
	$pr_vars['priem_regen']['chance'] = 15;
	$pr_vars['priem_regen']['name'] = 'Воля к победе';
}

  if($this->users[$this->uids[$uid1]]['bot_id'] == 142) {
###Мастер Грит [11]
###To Do : Холодный Луч, Оюжигающее пламя, Тяжесть земли, Молния, Истинная форма, Самоуничтожение, Двойной удар, Оглушающий удар
  
  //Самоуничтожение
  if(rand(0,100) <= 30) {
		$t = rand(1,3);
		$grit = rand(35,150);
		$grit2 = rand(35,150);
		$prz = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = '.$this->users[$this->uids[$uid1]]['id'].' AND `v2` = 144 OR (`v2` = 175 OR `v2` = 176 OR `v2` = 177 OR `v2` = 178 OR `v2` = 179) AND `delete` = 0 LIMIT 1 '));
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $grit;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $grit;
		$this->stats[$this->uids[$uid1]]['hpNow'] -= $grit2;
			mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].', `last_hp` = '.$this->users[$this->uids[$uid2]]['last_hp'].' WHERE `id` = '.$this->stats[$this->uids[$uid2]]['id'].' LIMIT 1');
			mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid1]]['hpNow'].' WHERE `id` = '.$this->stats[$this->uids[$uid1]]['id'].' LIMIT 1');
		if($t == 1) {
			$txt = 'очнулся от медитации, и призвал заклятье <b><font color=brown>&quot;Самоуничтожение&quot;</b></font> на {u2} - <b>'.$grit.'</b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			$txt2 = '<br>{tm1} {u1} впал в транс и начал бормотать заклятие заклятье <b><font color=brown>&quot;Самоуничтожение&quot;</b></font> на {u1} - <b>'.$grit2.'</b> ['.$this->stats[$this->uids[$uid1]]['hpNow'].'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']<br>';
		}elseif($t == 2) {
			$txt = ' с испугу произнес, первое пришедшее на ум, заклятье <b><font color=brown>&quot;Самоуничтожение&quot;</b></font> на {u2} - <b>'.$grit.'</b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			$txt2 = '<br>{tm1} {u1} наконец сфокусировал свое внимание на поединке и наколдовал <b><font color=brown>&quot;Самоуничтожение&quot;</b></font> на {u1} - <b>'.$grit2.'</b> ['.$this->stats[$this->uids[$uid1]]['hpNow'].'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
		}elseif($t == 3) {
			$txt = 'впал в транс и начал бормотать заклятие заклятье <b><font color=brown>&quot;Самоуничтожение&quot;</b></font> на {u2} - <b>'.$grit.'</b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']<br>';
			$txt2 = '<br>{tm1} {u1} очнулся от медитации, и призвал заклятье <b><font color=brown>&quot;Самоуничтожение&quot;</b></font> на {u1} - <b>'.$grit2.'</b> ['.$this->stats[$this->uids[$uid1]]['hpNow'].'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
		}
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} '.$txt.' '.$txt2.'';
			$this->add_log($mas);
  }
  
  if(rand(0,100) <= -1) {
		$trand = rand(1,4);
		$y = rand(35,175);
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $y;
		mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].' WHERE `id` = '.$this->stats[$this->uids[$uid2]]['id'].' LIMIT 1');
		if($trand == 1) $txt = ', победив страх, решил поразить {u2} заклятьем <b><font color=#008080>&quot;Молния [11]&quot; - '.$y.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		elseif($trand == 2) $txt = ', нарисовав вокруг себя несколько рун, призвал заклятье <b><font color=#008080>&quot;Молния [11]&quot; на {u2} - '.$y.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		elseif($trand == 3) $txt = ', догадавшись, что пришло время показать себя, произнес заклятье <b><font color=#008080>&quot;Молния [11]&quot; на {u2} - '.$y.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		elseif($trand == 4) $txt = ', с испугу произнес, первое пришедшее на ум, заклятье <b><font color=#008080>&quot;Молния [11]&quot; на {u2} - '.$y.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} '.$txt.'';
			$this->add_log($mas);
  }
  
  
  
	if($hp <= 35) {
		$test = $u->testAction('`uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `vars` = "form_grit" LIMIT 1', 1);
		if(!isset($test['id'])) {
			
			$this->stats[$this->uids[$uid1]]['hpNow'] += 7500;
			
			if($this->stats[$this->uids[$uid1]]['hpNow'] > 7500) {
				$this->stats[$this->uids[$uid1]]['hpNow'] = 7500;
			}
			
			$stats = 's1=150|s2=25|s3=25|s4=125|hpAll=13000|za=1100|zm=900|yron_min=900|yron_max=1400|m2=1100|m5=950|m7=20|m4=450|m1=350|m10=100';
			mysql_query('UPDATE `stats` SET `stats` = "'.$stats.'", `hpNow` = "'.$this->stats[$this->uids[$uid1]]['hpNow'].'" WHERE `id` = "'.$this->users[$this->uids[$uid1]]['id'].'" LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} Применил прием <b>&quotИстинная форма&quot;</b> и сменил свой облик';
			$this->add_log($mas);
			$u->addAction(time(), 'form_grit',0, $this->users[$this->uids[$uid1]]['id']);
		}
	}
	//
		  $pr_use = 1;
		  
		  $pr_vars['priem_team_f'][0]['chance'] = 35;
		  $pr_vars['priem_team_f'][0]['name'] = 'Двойной удар';
		  $pr_vars['priem_team_f'][0]['x'] = 1;
		  $pr_vars['priem_team_f'][0]['type'] = 7;	  
		  $pr_vars['priem_team_f'][0]['hp'] = 0;
		  $pr_vars['priem_team_f'][0]['hp_dmg'] = $this->yronGetrazmen($uid1,$uid2,3,rand(1,5));
		  $pr_vars['priem_team_f'][0]['hp_dmg'] = floor(15+rand($pr_vars['priem_team_f'][0]['hp_dmg']['y'],$pr_vars['priem_team_f'][0]['hp_dmg']['m_y']));
		  $pr_vars['priem_team_f'][0]['priem'] = 73;
		  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][0]['on'] = $uid;
		  $pr_vars['priem_team_f'][0]['nomf'] = 0;
		  $pr_vars['priem_team_f'][0]['fiz'] = 1;
		  $pr_vars['priem_team_f'][0]['krituet'] = true;
	  
  
}
  
	//Излом хаоса
	if($this->users[$this->uids[$uid1]]['bot_id'] == 416) {
		$pr_use = 1;
		#1#
		$pr_vars['priem_use'][0]['chance'] = 50;
		$pr_vars['priem_use'][0]['name'] = 'Грация Боя';
		$pr_vars['priem_use'][0]['id'] = 291;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		#1#
	}
  
###Start (Приёмы ботам)###

if($this->users[$this->uids[$uid1]]['bot_id'] == 118 || $this->users[$this->uids[$uid1]]['bot_id'] == 119) {
###Пустынник Атаман [8] / Пустынник Атаман [9]
	$pr_use = 1;
  
	$pr_vars['priem_use'][0]['chance'] = 30;
	$pr_vars['priem_use'][0]['name'] = 'Сильный удар';
	$pr_vars['priem_use'][0]['id'] = 4;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
  
	//Шокирующий
	$pr_vars['priem_use'][0]['chance'] = 15;
	$pr_vars['priem_use'][0]['name'] = 'Шокирующий удар';
	$pr_vars['priem_use'][0]['id'] = 236;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
  
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 50 || $this->users[$this->uids[$uid1]]['bot_id'] == 53) {
	//Паук или Сточный паук
	//priem team x type hp hp_dmg
	  $pr_use = 1;
	  
	  //Быстрый удар
	  $pr_vars['priem_team_f'][] = array(
		  'chance' => 25,
		  'name' => 'Быстрый удар',
		  'x' => 1,
		  'type' => 7,	  
		  'hp' => 0,
		  'hp_dmg' => 2,	  
		  'priem' => 164,
		  'team' => $this->users[$this->uids[$uid2]]['team'],
		  'on' => $uid,
		  'nomf' => 1,
		  'fiz' => 1,
		  'krituet' => false 
	  );
	  
	  //Отпрыгнуть
	  $pr_vars['priem_use'][] = array(
		  'chance' => 25,
		  'name' => 'Отпрыгнуть',
		  'id' => 8,
		  'on' => $this->users[$this->uids[$uid1]],
		  'no_chat' => true
	  );
	  
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 54) {
	//Канализационный жук
	  $pr_use = 1;
	  //Ослабить удар
	  $pr_vars['priem_use'][0]['chance'] = 10;
	  $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
	  $pr_vars['priem_use'][0]['id'] = 1;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //Мощный удар
	  $pr_vars['priem_use'][1]['chance'] = 10;
	  $pr_vars['priem_use'][1]['name'] = 'Мощный удар';
	  $pr_vars['priem_use'][1]['id'] = 2;
	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 57) {
	//Сантехник зомби
	  $pr_use = 1;
	  //Быстрый удар
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Быстрый удар';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 7;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = 2;

	$pr_vars['priem_team_f'][0]['priem'] = 164;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 1;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = false;
	  //Мощный удар
	  $pr_vars['priem_use'][0]['chance'] = 10;
	  $pr_vars['priem_use'][0]['name'] = 'Мощный удар';
	  $pr_vars['priem_use'][0]['id'] = 2;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 58) {
	//Обитатель подвалов
	  $pr_use = 1;
	  //Быстрый удар
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Мокрый удар';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 3;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = 16;
	  $pr_vars['priem_team_f'][0]['priem'] = 73;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 0;
	  $pr_vars['priem_team_f'][0]['fiz'] = 0;
	  $pr_vars['priem_team_f'][0]['krituet'] = true;
	  
	  //Мощный удар
	  $pr_vars['priem_use'][0]['chance'] = 10;
	  $pr_vars['priem_use'][0]['name'] = 'Мощный удар';
	  $pr_vars['priem_use'][0]['id'] = 2;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //Закусить
	  $pr_vars['priem_regen']['hp'] = 8;
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = 'Закусить';
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 56) {
	//Тунельный гад
	  $pr_use = 1;
	  //Быстрый удар
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Быстрый удар';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 7;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = 2;	  
	  $pr_vars['priem_team_f'][0]['priem'] = 164;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 1;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = false;
	  
	  //Регенерация
	  $pr_vars['priem_regen']['hp'] = rand(8,12);
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = 'Регенерация';
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 55) {
	//Жуткая мерзость
	  $pr_use = 1;
	  //Быстрый удар
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Быстрый удар';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 7;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = 2;	  
	  $pr_vars['priem_team_f'][0]['priem'] = 164;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 1;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = false;
	  //Кислотное касание
	  $pr_vars['priem_team_f'][1]['chance'] = 10;
	  $pr_vars['priem_team_f'][1]['name'] = 'Кислотное касание';
	  $pr_vars['priem_team_f'][1]['x'] = 1;
	  $pr_vars['priem_team_f'][1]['type'] = 3;	  
	  $pr_vars['priem_team_f'][1]['hp'] = 0;
	  $pr_vars['priem_team_f'][1]['hp_dmg'] = 32;
	  $pr_vars['priem_team_f'][1]['priem'] = 73;
	  $pr_vars['priem_team_f'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][1]['on'] = $uid;
	  $pr_vars['priem_team_f'][1]['nomf'] = 0;
	  $pr_vars['priem_team_f'][1]['fiz'] = 0;
	  $pr_vars['priem_team_f'][1]['krituet'] = true;	  
	  //Регенерация
	  $pr_vars['priem_regen']['hp'] = rand(8,12);
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = 'Регенерация';
	  //Надкусить
	  $pr_vars['priem_use'][0]['chance'] = 50;
	  $pr_vars['priem_use'][0]['name'] = 'Надкусить';
	  $pr_vars['priem_use'][0]['id'] = 293;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 52) {
	//Мартын
	  $pr_use = 1;
	  //Мокрый удар
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Мокрый удар';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 3;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = 32;
	  $pr_vars['priem_team_f'][0]['priem'] = 73;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 0;
	  $pr_vars['priem_team_f'][0]['fiz'] = 0;
	  $pr_vars['priem_team_f'][0]['krituet'] = true;	  
	  //Регенерация
	  $pr_vars['priem_regen']['hp'] = rand(8,12);
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = 'Регенерация';
	  //Ослабить удар
	  $pr_vars['priem_use'][0]['chance'] = 10;
	  $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
	  $pr_vars['priem_use'][0]['id'] = 1;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //Мощный удар
	  $pr_vars['priem_use'][1]['chance'] = 10;
	  $pr_vars['priem_use'][1]['name'] = 'Мощный удар';
	  $pr_vars['priem_use'][1]['id'] = 2;
	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
	  //Надкусить
	  if( rand(0,100) < 10 ) {
		  //Зловонная Вода
		  $pr_vars['priem_team_f'][1]['chance'] = 100;
		  $pr_vars['priem_team_f'][1]['name'] = 'Зловонная Вода';
		  $pr_vars['priem_team_f'][1]['x'] = 1;
		  $pr_vars['priem_team_f'][1]['type'] = 3;	  
		  $pr_vars['priem_team_f'][1]['hp'] = 0;
		  $pr_vars['priem_team_f'][1]['hp_dmg'] = 2;	  
		  $pr_vars['priem_team_f'][1]['priem'] = 164;
		  $pr_vars['priem_team_f'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][1]['on'] = $uid;
		  $pr_vars['priem_team_f'][1]['nomf'] = 1;
		  $pr_vars['priem_team_f'][1]['fiz'] = 1;
		  $pr_vars['priem_team_f'][1]['krituet'] = false;
		  //
		  $pr_vars['priem_use'][2]['chance'] = 100;
		  $pr_vars['priem_use'][2]['name'] = 'Зловонная Вода';
		  $pr_vars['priem_use'][2]['id'] = 294;
		  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid2]];
		  $pr_vars['priem_use'][2]['no_chat'] = true;
	  }
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 64) {
	//Канализационный паук
	  $pr_use = 1;
	  //Быстрый удар
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Быстрый удар';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 7;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(10,13);
	  $pr_vars['priem_team_f'][0]['priem'] = 73;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 0;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = true;	  
	  //Проткнуть
	  if( rand(0,100) < 15 ) {
		  //Проткнуть
		  $pr_vars['priem_use'][0]['chance'] = 100;
		  $pr_vars['priem_use'][0]['name'] = 'Проткнуть';
		  $pr_vars['priem_use'][0]['id'] = 295;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		  //$pr_vars['priem_use'][2]['no_chat'] = true;
	  }
	  //Двойной удар
	  if( rand(0,100) < 15 ) {
		  $pr_vars['priem_team_f'][1]['chance'] = 100;
		  $pr_vars['priem_team_f'][1]['name'] = 'Двойной удар';
		  $pr_vars['priem_team_f'][1]['x'] = 1;
		  $pr_vars['priem_team_f'][1]['type'] = 7;	  
		  $pr_vars['priem_team_f'][1]['hp'] = 0;
		  $pr_vars['priem_team_f'][1]['hp_dmg'] = $this->yronGetrazmen($uid1,$uid2,3,rand(1,5));
		  $pr_vars['priem_team_f'][1]['hp_dmg'] = floor(1+rand($pr_vars['priem_team_f'][1]['hp_dmg']['y'],$pr_vars['priem_team_f'][1]['hp_dmg']['m_y']));
		  $pr_vars['priem_team_f'][1]['priem'] = 73;
		  $pr_vars['priem_team_f'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][1]['on'] = $uid;
		  $pr_vars['priem_team_f'][1]['nomf'] = 0;
		  $pr_vars['priem_team_f'][1]['fiz'] = 1;
		  $pr_vars['priem_team_f'][1]['krituet'] = true;
		  //
		  $pr_vars['priem_team_f'][2]['chance'] = 100;
		  $pr_vars['priem_team_f'][2]['name'] = 'Двойной удар';
		  $pr_vars['priem_team_f'][2]['x'] = 1;
		  $pr_vars['priem_team_f'][2]['type'] = 7;	  
		  $pr_vars['priem_team_f'][2]['hp'] = 0;
		  $pr_vars['priem_team_f'][2]['hp_dmg'] = $this->yronGetrazmen($uid1,$uid2,3,rand(1,5));
		  $pr_vars['priem_team_f'][2]['hp_dmg'] = floor(1+rand($pr_vars['priem_team_f'][2]['hp_dmg']['y'],$pr_vars['priem_team_f'][2]['hp_dmg']['m_y']));
		  $pr_vars['priem_team_f'][2]['priem'] = 73;
		  $pr_vars['priem_team_f'][2]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][2]['on'] = $uid;
		  $pr_vars['priem_team_f'][2]['nomf'] = 0;
		  $pr_vars['priem_team_f'][2]['fiz'] = 1;
		  $pr_vars['priem_team_f'][2]['krituet'] = true;
	  }
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 62) {
	//Безголовый Сантехник
	  $pr_use = 1; 
	  //Проткнуть
	  if( rand(0,100) < 15 ) {
		  //Проткнуть
		  $pr_vars['priem_use'][0]['chance'] = 100;
		  $pr_vars['priem_use'][0]['name'] = 'Гнилая кровь';
		  $pr_vars['priem_use'][0]['id'] = 296;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	  }
	  //
  	  $pr_vars['priem_use'][] = array(
		 'chance' => 10,
		 'name' => 'Ослабить удар',
		 'id' => 7,
		 'on' => $this->users[$this->uids[$uid1]],
		 'no_chat' => true
	  );
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 65) {
	//Страшная крыса
	  $pr_use = 1;
	  //Надкусить
	  $pr_vars['priem_use'][0]['chance'] = 40;
	  $pr_vars['priem_use'][0]['name'] = 'Надкусить';
	  $pr_vars['priem_use'][0]['id'] = 293;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	  //Укусить
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Укусить';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 7;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(1,13);	  
	  $pr_vars['priem_team_f'][0]['priem'] = 164;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 1;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = false;
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 61) {
	//Летучая бестия
	  $pr_use = 1;
	  //Укусить
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Укусить';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 7;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(1,14);	  
	  $pr_vars['priem_team_f'][0]['priem'] = 164;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 1;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = false;
	  //
  	  $pr_vars['priem_use'][0]['chance'] = 10;
  	  $pr_vars['priem_use'][0]['name'] = 'Облако тьмы';
  	  $pr_vars['priem_use'][0]['id'] = 236;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	  //Отпрыгнуть
	  $pr_vars['priem_use'][1]['chance'] = 15;
	  $pr_vars['priem_use'][1]['name'] = 'Отпрыгнуть';
	  $pr_vars['priem_use'][1]['id'] = 8;
	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
	  
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 63) {
	//Кровавый сантехник
	  $pr_use = 1;
	  //ослабить удар
  	 $pr_vars['priem_use'][0]['chance'] = 10;
  	 $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
  	 $pr_vars['priem_use'][0]['id'] = 7;
  	 $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	 $pr_vars['priem_use'][0]['no_chat'] = true;
	  //Надкусить
	  $pr_vars['priem_use'][1]['chance'] = 50;
	  $pr_vars['priem_use'][1]['name'] = 'Надкусить';
	  $pr_vars['priem_use'][1]['id'] = 293;
	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid2]];
	  //Проткнуть
	  if( rand(0,100) < 10 ) {
		  //Проткнуть
		  $pr_vars['priem_use'][2]['chance'] = 100;
		  $pr_vars['priem_use'][2]['name'] = 'Гнилая кровь';
		  $pr_vars['priem_use'][2]['id'] = 296;
		  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid2]];
	  }
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 68) {
	//Старожил 
	  $pr_use = 1;
	  //Метнуть болт
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Метнуть болт';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 3;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = 37;
	  $pr_vars['priem_team_f'][0]['priem'] = 164;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 0;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = true;
	  //Метнуть болт
	  $pr_vars['priem_team_f'][1]['chance'] = 10;
	  $pr_vars['priem_team_f'][1]['name'] = 'Взрыв грязи';
	  $pr_vars['priem_team_f'][1]['x'] = 1;
	  $pr_vars['priem_team_f'][1]['type'] = 3;	  
	  $pr_vars['priem_team_f'][1]['hp'] = 0;
	  $pr_vars['priem_team_f'][1]['hp_dmg'] = 22;
	  $pr_vars['priem_team_f'][1]['priem'] = 164;
	  $pr_vars['priem_team_f'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][1]['on'] = $uid;
	  $pr_vars['priem_team_f'][1]['nomf'] = 0;
	  $pr_vars['priem_team_f'][1]['fiz'] = 1;
	  $pr_vars['priem_team_f'][1]['krituet'] = true;
	  //ослабить удар
  	  $pr_vars['priem_use'][0]['chance'] = 10;
  	  $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
  	  $pr_vars['priem_use'][0]['id'] = 7;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  /* if( rand(0,100) < 25 ) {
		  //Метнуть болт
		  if( !isset($this->stats[$this->uids[$uid2]]['noeffectbattle1'])) {
			  $pr_vars['priem_team_f'][1]['chance'] = 100;
			  $pr_vars['priem_team_f'][1]['name'] = 'Прочистить';
			  $pr_vars['priem_team_f'][1]['x'] = 1;
			  $pr_vars['priem_team_f'][1]['type'] = 3;	  
			  $pr_vars['priem_team_f'][1]['hp'] = 0;
			  $pr_vars['priem_team_f'][1]['hp_dmg'] = rand(1,5);
			  $pr_vars['priem_team_f'][1]['priem'] = 164;
			  $pr_vars['priem_team_f'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
			  $pr_vars['priem_team_f'][1]['on'] = $uid;
			  $pr_vars['priem_team_f'][1]['nomf'] = 0;
			  $pr_vars['priem_team_f'][1]['fiz'] = 1;
			  $pr_vars['priem_team_f'][1]['krituet'] = true;
			  mysql_query('INSERT INTO `battle_actions` (`btl`,`uid`,`time`,`vars`,`vals`) VALUES (
				"'.$this->info['id'].'","'.$uid2.'","'.time().'","noeffectbattle1","'.$uid1.'"
			  )');
		  }
	  }*/
	 
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 66) {
	//Местный житель 
	  $pr_use = 1;
	  //Взрыв грязи
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Взрыв грязи';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 3;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = 24;
	  $pr_vars['priem_team_f'][0]['priem'] = 164;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 0;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = true;
	  //ослабить удар
  	  $pr_vars['priem_use'][0]['chance'] = 10;
  	  $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
  	  $pr_vars['priem_use'][0]['id'] = 7;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //ослабить удар
  	  $pr_vars['priem_use'][1]['chance'] = 10;
  	  $pr_vars['priem_use'][1]['name'] = 'Активная защита';
  	  $pr_vars['priem_use'][1]['id'] = 7;
  	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
	  //Регенерация
	  $pr_vars['priem_regen']['hp'] = rand(1,10);
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = 'Регенерация';
	  //Закусить
	  $pr_vars['priem_team_f'][1]['chance'] = 10;
	  $pr_vars['priem_team_f'][1]['name'] = 'Закусить';
	  $pr_vars['priem_team_f'][1]['x'] = 1;
	  $pr_vars['priem_team_f'][1]['type'] = 3;	  
	  $pr_vars['priem_team_f'][1]['hp'] = 25;
	  $pr_vars['priem_team_f'][1]['hp_dmg'] = 25;
	  $pr_vars['priem_team_f'][1]['priem'] = 164;
	  $pr_vars['priem_team_f'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][1]['on'] = $uid;
	  $pr_vars['priem_team_f'][1]['nomf'] = 0;
	  $pr_vars['priem_team_f'][1]['fiz'] = 1;
	  $pr_vars['priem_team_f'][1]['krituet'] = true;
	  $pr_vars['priem_team_f'][1]['hpregen'] = true;
	 
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 59) {
	//Старший прораб 
	  $pr_use = 1;
	  //ослабить удар
  	  $pr_vars['priem_use'][0]['chance'] = 15;
  	  $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
  	  $pr_vars['priem_use'][0]['id'] = 7;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //Активная защита
  	  $pr_vars['priem_use'][1]['chance'] = 15;
  	  $pr_vars['priem_use'][1]['name'] = 'Активная защита';
  	  $pr_vars['priem_use'][1]['id'] = 7;
  	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
	  //Собраться
  	  $pr_vars['priem_use'][2]['chance'] = 15;
  	  $pr_vars['priem_use'][2]['name'] = 'Собраться';
  	  $pr_vars['priem_use'][2]['id'] = 297;
  	  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][2]['no_chat'] = true;
	  //Приказ Слабости
  	  $pr_vars['priem_use'][3]['chance'] = 5;
  	  $pr_vars['priem_use'][3]['name'] = 'Приказ Слабости';
  	  $pr_vars['priem_use'][3]['id'] = 298;
  	  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid2]];
	  //Регенерация
	  $pr_vars['priem_regen']['hp'] = rand(1,10);
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = 'Регенерация';
	  //Двойной удар
	  if( rand(0,100) < 15 ) {
		  //
		  $pr_vars['priem_team_f'][0]['chance'] = 100;
		  $pr_vars['priem_team_f'][0]['name'] = 'Двойной удар';
		  $pr_vars['priem_team_f'][0]['x'] = 1;
		  $pr_vars['priem_team_f'][0]['type'] = 7;	  
		  $pr_vars['priem_team_f'][0]['hp'] = 0;
		  $pr_vars['priem_team_f'][0]['hp_dmg'] = $this->yronGetrazmen($uid1,$uid2,3,rand(1,5));
		  $pr_vars['priem_team_f'][0]['hp_dmg'] = floor(1+rand($pr_vars['priem_team_f'][0]['hp_dmg']['y'],$pr_vars['priem_team_f'][0]['hp_dmg']['m_y']));
		  $pr_vars['priem_team_f'][0]['priem'] = 73;
		  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][0]['on'] = $uid;
		  $pr_vars['priem_team_f'][0]['nomf'] = 0;
		  $pr_vars['priem_team_f'][0]['fiz'] = 1;
		  $pr_vars['priem_team_f'][0]['krituet'] = true;
		  //
		  $pr_vars['priem_team_f'][1]['chance'] = 100;
		  $pr_vars['priem_team_f'][1]['name'] = 'Двойной удар';
		  $pr_vars['priem_team_f'][1]['x'] = 1;
		  $pr_vars['priem_team_f'][1]['type'] = 7;	  
		  $pr_vars['priem_team_f'][1]['hp'] = 0;
		  $pr_vars['priem_team_f'][1]['hp_dmg'] = $this->yronGetrazmen($uid1,$uid2,3,rand(1,5));
		  $pr_vars['priem_team_f'][1]['hp_dmg'] = floor(1+rand($pr_vars['priem_team_f'][1]['hp_dmg']['y'],$pr_vars['priem_team_f'][1]['hp_dmg']['m_y']));
		  $pr_vars['priem_team_f'][1]['priem'] = 73;
		  $pr_vars['priem_team_f'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][1]['on'] = $uid;
		  $pr_vars['priem_team_f'][1]['nomf'] = 0;
		  $pr_vars['priem_team_f'][1]['fiz'] = 1;
		  $pr_vars['priem_team_f'][1]['krituet'] = true;
	  }
	 
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 67) {
	//Хозяин канализации 
	  $pr_use = 1;
	  //Метнуть болт
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Метнуть болт';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 3;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(35,40);
	  $pr_vars['priem_team_f'][0]['priem'] = 164;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 0;
	  $pr_vars['priem_team_f'][0]['fiz'] = 1;
	  $pr_vars['priem_team_f'][0]['krituet'] = true;
	  //ослабить удар
  	  $pr_vars['priem_use'][0]['chance'] = 10;
  	  $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
  	  $pr_vars['priem_use'][0]['id'] = 7;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //$pr_vars['priem_use'][1]['no_chat'] = true;
	  if( rand(0,100) < 10 ) {
		  //Метнуть болт
		  if( !isset($this->stats[$this->uids[$uid2]]['noeffectbattle1'])) {
			  $pr_vars['priem_team_f'][1]['chance'] = 100;
			  $pr_vars['priem_team_f'][1]['name'] = 'Прочистить';
			  $pr_vars['priem_team_f'][1]['x'] = 1;
			  $pr_vars['priem_team_f'][1]['type'] = 3;	  
			  $pr_vars['priem_team_f'][1]['hp'] = 0;
			  $pr_vars['priem_team_f'][1]['hp_dmg'] = rand(1,5);
			  $pr_vars['priem_team_f'][1]['priem'] = 164;
			  $pr_vars['priem_team_f'][1]['team'] = $this->users[$this->uids[$uid2]]['team'];
			  $pr_vars['priem_team_f'][1]['on'] = $uid;
			  $pr_vars['priem_team_f'][1]['nomf'] = 0;
			  $pr_vars['priem_team_f'][1]['fiz'] = 1;
			  $pr_vars['priem_team_f'][1]['krituet'] = true;
			  mysql_query('INSERT INTO `battle_actions` (`btl`,`uid`,`time`,`vars`,`vals`) VALUES (
				"'.$this->info['id'].'","'.$uid2.'","'.time().'","noeffectbattle1","'.$uid1.'"
			  )');
		  }
	  }
	  //Двойной удар
	  if( rand(0,100) < 10 ) {
		  //
		  $cnt1 = count($pr_vars['priem_team_f']);
		  $pr_vars['priem_team_f'][$cnt1]['chance'] = 100;
		  $pr_vars['priem_team_f'][$cnt1]['name'] = 'Двойной удар';
		  $pr_vars['priem_team_f'][$cnt1]['x'] = 1;
		  $pr_vars['priem_team_f'][$cnt1]['type'] = 7;	  
		  $pr_vars['priem_team_f'][$cnt1]['hp'] = 0;
		  $pr_vars['priem_team_f'][$cnt1]['hp_dmg'] = $this->yronGetrazmen($uid1,$uid2,3,rand(1,5));
		  $pr_vars['priem_team_f'][$cnt1]['hp_dmg'] = floor(1+rand($pr_vars['priem_team_f'][$cnt1]['hp_dmg']['y'],$pr_vars['priem_team_f'][$cnt1]['hp_dmg']['m_y']));
		  $pr_vars['priem_team_f'][$cnt1]['priem'] = 73;
		  $pr_vars['priem_team_f'][$cnt1]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][$cnt1]['on'] = $uid;
		  $pr_vars['priem_team_f'][$cnt1]['nomf'] = 0;
		  $pr_vars['priem_team_f'][$cnt1]['fiz'] = 1;
		  $pr_vars['priem_team_f'][$cnt1]['krituet'] = true;
		  //
		  $cnt1++;
		  $pr_vars['priem_team_f'][$cnt1]['chance'] = 100;
		  $pr_vars['priem_team_f'][$cnt1]['name'] = 'Двойной удар';
		  $pr_vars['priem_team_f'][$cnt1]['x'] = 1;
		  $pr_vars['priem_team_f'][$cnt1]['type'] = 7;	  
		  $pr_vars['priem_team_f'][$cnt1]['hp'] = 0;
		  $pr_vars['priem_team_f'][$cnt1]['hp_dmg'] = $this->yronGetrazmen($uid1,$uid2,3,rand(1,5));
		  $pr_vars['priem_team_f'][$cnt1]['hp_dmg'] = floor(1+rand($pr_vars['priem_team_f'][$cnt1]['hp_dmg']['y'],$pr_vars['priem_team_f'][$cnt1]['hp_dmg']['m_y']));
		  $pr_vars['priem_team_f'][$cnt1]['priem'] = 73;
		  $pr_vars['priem_team_f'][$cnt1]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][$cnt1]['on'] = $uid;
		  $pr_vars['priem_team_f'][$cnt1]['nomf'] = 0;
		  $pr_vars['priem_team_f'][$cnt1]['fiz'] = 1;
		  $pr_vars['priem_team_f'][$cnt1]['krituet'] = true;
	  }
	 
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 60) {
	  //Слесарь-зомби 
	  $pr_use = 1;
	  //ослабить удар
  	  $pr_vars['priem_use'][0]['chance'] = 10;
  	  $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
  	  $pr_vars['priem_use'][0]['id'] = 7;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //Бесчувственность
  	  $pr_vars['priem_use'][0]['chance'] = 10;
  	  $pr_vars['priem_use'][0]['name'] = 'Бесчувственность';
  	  $pr_vars['priem_use'][0]['id'] = 141;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //
	  /*if( rand(0,100) < 25 ) {
		  //Метнуть болт
		  if( !isset($this->stats[$this->uids[$uid2]]['noeffectbattle1'])) {
			  $pr_vars['priem_team_f'][0]['chance'] = 100;
			  $pr_vars['priem_team_f'][0]['name'] = 'Прочистить';
			  $pr_vars['priem_team_f'][0]['x'] = 1;
			  $pr_vars['priem_team_f'][0]['type'] = 3;	  
			  $pr_vars['priem_team_f'][0]['hp'] = 0;
			  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(1,5);
			  $pr_vars['priem_team_f'][0]['priem'] = 164;
			  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
			  $pr_vars['priem_team_f'][0]['on'] = $uid;
			  $pr_vars['priem_team_f'][0]['nomf'] = 0;
			  $pr_vars['priem_team_f'][0]['fiz'] = 1;
			  $pr_vars['priem_team_f'][0]['krituet'] = true;
			  mysql_query('INSERT INTO `battle_actions` (`btl`,`uid`,`time`,`vars`,`vals`) VALUES (
				"'.$this->info['id'].'","'.$uid2.'","'.time().'","noeffectbattle1","'.$uid1.'"
			  )');
		  }
	  }*/
	  //Двойной удар
	  if( rand(0,100) < 10 ) {
		  //
		  $cnt1 = count($pr_vars['priem_team_f']);
		  $pr_vars['priem_team_f'][$cnt1]['chance'] = 100;
		  $pr_vars['priem_team_f'][$cnt1]['name'] = 'Двойной удар';
		  $pr_vars['priem_team_f'][$cnt1]['x'] = 1;
		  $pr_vars['priem_team_f'][$cnt1]['type'] = 7;	  
		  $pr_vars['priem_team_f'][$cnt1]['hp'] = 0;
		  $pr_vars['priem_team_f'][$cnt1]['hp_dmg'] = $this->yronGetrazmen($uid1,$uid2,3,rand(1,5));
		  $pr_vars['priem_team_f'][$cnt1]['hp_dmg'] = floor(1+rand($pr_vars['priem_team_f'][$cnt1]['hp_dmg']['y'],$pr_vars['priem_team_f'][$cnt1]['hp_dmg']['m_y']));
		  $pr_vars['priem_team_f'][$cnt1]['priem'] = 73;
		  $pr_vars['priem_team_f'][$cnt1]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][$cnt1]['on'] = $uid;
		  $pr_vars['priem_team_f'][$cnt1]['nomf'] = 0;
		  $pr_vars['priem_team_f'][$cnt1]['fiz'] = 1;
		  $pr_vars['priem_team_f'][$cnt1]['krituet'] = true;
		  //
		  $cnt1++;
		  $pr_vars['priem_team_f'][$cnt1]['chance'] = 100;
		  $pr_vars['priem_team_f'][$cnt1]['name'] = 'Двойной удар';
		  $pr_vars['priem_team_f'][$cnt1]['x'] = 1;
		  $pr_vars['priem_team_f'][$cnt1]['type'] = 7;	  
		  $pr_vars['priem_team_f'][$cnt1]['hp'] = 0;
		  $pr_vars['priem_team_f'][$cnt1]['hp_dmg'] = $this->yronGetrazmen($uid1,$uid2,3,rand(1,5));
		  $pr_vars['priem_team_f'][$cnt1]['hp_dmg'] = floor(1+rand($pr_vars['priem_team_f'][$cnt1]['hp_dmg']['y'],$pr_vars['priem_team_f'][$cnt1]['hp_dmg']['m_y']));
		  $pr_vars['priem_team_f'][$cnt1]['priem'] = 73;
		  $pr_vars['priem_team_f'][$cnt1]['team'] = $this->users[$this->uids[$uid2]]['team'];
		  $pr_vars['priem_team_f'][$cnt1]['on'] = $uid;
		  $pr_vars['priem_team_f'][$cnt1]['nomf'] = 0;
		  $pr_vars['priem_team_f'][$cnt1]['fiz'] = 1;
		  $pr_vars['priem_team_f'][$cnt1]['krituet'] = true;
	  }
	 
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 51) {
	//Лука
	  $pr_use = 1;
	  //Мокрый удар
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = 'Мокрый удар';
	  $pr_vars['priem_team_f'][0]['x'] = 1;
	  $pr_vars['priem_team_f'][0]['type'] = 3;	  
	  $pr_vars['priem_team_f'][0]['hp'] = 0;
	  $pr_vars['priem_team_f'][0]['hp_dmg'] = 32;
	  $pr_vars['priem_team_f'][0]['priem'] = 73;
	  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	  $pr_vars['priem_team_f'][0]['on'] = $uid;
	  $pr_vars['priem_team_f'][0]['nomf'] = 0;
	  $pr_vars['priem_team_f'][0]['fiz'] = 0;
	  $pr_vars['priem_team_f'][0]['krituet'] = true;	  
	  //Ослабить удар
	  $pr_vars['priem_use'][0]['chance'] = 10;
	  $pr_vars['priem_use'][0]['name'] = 'Ослабить удар';
	  $pr_vars['priem_use'][0]['id'] = 1;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //Мощный удар
	  $pr_vars['priem_use'][1]['chance'] = 10;
	  $pr_vars['priem_use'][1]['name'] = 'Мощный удар';
	  $pr_vars['priem_use'][1]['id'] = 2;
	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
}


/*
* Начало Бездны (Бездна)
* */
if($this->users[$this->uids[$uid1]]['bot_id'] == 356) {
###Страж Дайтон [9] - Бездна 1 этаж
	$pr_use = 1;

	$pr_vars['priem_use'][0]['chance'] = 25;
	$pr_vars['priem_use'][0]['name'] = 'Удар правым жвалом';
	$pr_vars['priem_use'][0]['id'] = 216;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][1]['chance'] = 25;
	$pr_vars['priem_use'][1]['name'] = 'Удачный удар';
	$pr_vars['priem_use'][1]['id'] = 11;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][2]['chance'] = 25;
	$pr_vars['priem_use'][2]['name'] = 'Коварный уход';
	$pr_vars['priem_use'][2]['id'] = 213;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][3]['chance'] = 25;
	$pr_vars['priem_use'][3]['name'] = 'Стойкость';
	$pr_vars['priem_use'][3]['id'] = 13;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][4]['chance'] = 25;
	$pr_vars['priem_use'][4]['name'] = 'Ярость';
	$pr_vars['priem_use'][4]['id'] = 14;
	$pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_regen']['hp'] = 45;
	$pr_vars['priem_regen']['chance'] = 15;
	$pr_vars['priem_regen']['name'] = 'Воля к победе';
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 355) {
### Кошмар Глубин [12] - Бездна 3 этаж

	$pr_use = 1;
	// Подставить лоб - аналог Полной Защите
	$pr_vars['priem_use'][0]['chance'] = 20;
	$pr_vars['priem_use'][0]['name'] = 'Подставить лоб';
	$pr_vars['priem_use'][0]['id'] = 45;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	// Раздавить - аналог Скрытой Силе.
	$pr_vars['priem_use'][1]['chance'] = 25;
	$pr_vars['priem_use'][1]['name'] = 'Раздавить';
	$pr_vars['priem_use'][1]['id'] = 216;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	// Удар Хвостом - наносит моментальный урон.
	$pr_vars['priem_team_f'][0]['chance'] = 25;
	$pr_vars['priem_team_f'][0]['name'] = 'Удар Хвостом';
	$pr_vars['priem_team_f'][0]['x'] = 1;
	$pr_vars['priem_team_f'][0]['type'] = 3;
	$pr_vars['priem_team_f'][0]['hp'] = 0;
	$pr_vars['priem_team_f'][0]['hp_dmg'] = rand(35,40);
	$pr_vars['priem_team_f'][0]['priem'] = 164;
	$pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
	$pr_vars['priem_team_f'][0]['on'] = $uid;
	$pr_vars['priem_team_f'][0]['nomf'] = 0;
	$pr_vars['priem_team_f'][0]['fiz'] = 1;
	$pr_vars['priem_team_f'][0]['krituet'] = true;

	$pr_vars['priem_use'][2]['chance'] = 25;
	$pr_vars['priem_use'][2]['name'] = 'Стойкость';
	$pr_vars['priem_use'][2]['id'] = 13;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][3]['chance'] = 25;
	$pr_vars['priem_use'][3]['name'] = 'Ярость';
	$pr_vars['priem_use'][3]['id'] = 14;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 261) {
### Рубака Глубин [9] - Бездна 1-3 этаж
/*  (650HP)
Сила: 50
Ловкость: 15
Интуиция: 60
Выносливость: 30
Интеллект: 5
Мудрость: 0
1 удар 2 блока. Профильный урон: рубящий, стихийные атаки: вода (у 8х).
* */
	$pr_use = 1;
}
if($this->users[$this->uids[$uid1]]['bot_id'] == 345) {
### Рубака Глубин [8] - Бездна 1-3 этаж
/* (500HP)
Сила: 30
Ловкость: 25
Интуиция: 50
Выносливость: 30
Интеллект: 0
Мудрость: 0
1 удар 2 блока. Профильный урон: рубящий, стихийные атаки: вода (у 8х).
* */
	$pr_use = 1;
}
if($this->users[$this->uids[$uid1]]['bot_id'] == 346) {
### Литейщик [7] - Бездна 1-3 этаж
/* (450HP)
Сила: 50
Ловкость: 25
Интуиция: 20
Выносливость: 30
Интеллект: 0
Мудрость: 0
1 удар, 2 блока. Профильный урон: дробящий.
*/
	$pr_use = 1;
}
if($this->users[$this->uids[$uid1]]['bot_id'] == 347) {
### Литейщик [8] - Бездна 1-3 этаж
/* (500HP)
Сила: 30
Ловкость: 30
Интуиция: 50
Выносливость: 30
Интеллект: 0
Мудрость: 0
1 удар, 2 блока. Профильный урон: дробящий.
Место рождения: Бездна
*/
	$pr_use = 1;
}
if($this->users[$this->uids[$uid1]]['bot_id'] == 348) {
### Надзиратель Глубин [9] - Бездна 1-3 этаж
/*(600HP)
Сила: 50
Ловкость: 50
Интуиция: 20
Выносливость: 30
Интеллект: 10
Мудрость: 0
1 удар 2 блока. Профильный урон: рубящий, стихийные атаки: вода (у 8х).
 */
	$pr_use = 1;
}
if($this->users[$this->uids[$uid1]]['bot_id'] == 349) {
### Надзиратель Глубин [8] - Бездна 1-3 этаж
/* (375HP)
Сила: 40
Ловкость: 50
Интуиция: 35
Выносливость: 30
Интеллект: 0
Мудрость: 0
1 удар 2 блока. Профильный урон: рубящий, стихийные атаки: вода (у 8х).
*/
	$pr_use = 1;
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 352) {
### Большой Тяжелый Молот [9] - Бездна 3 этаж
	// Удачный удар.
	$pr_vars['priem_use'][0]['chance'] = 25;
	$pr_vars['priem_use'][0]['name'] = 'Удачный удар';
	$pr_vars['priem_use'][0]['id'] = 11;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	// Активная защита.
	$pr_vars['priem_use'][1]['chance'] = 20;
	$pr_vars['priem_use'][1]['name'] = 'Активная защита';
	$pr_vars['priem_use'][1]['id'] = 7;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	// Стойкость.
	$pr_vars['priem_use'][2]['chance'] = 20;
	$pr_vars['priem_use'][2]['name'] = 'Стойкость';
	$pr_vars['priem_use'][2]['id'] = 13;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

	// Ярость.
	$pr_vars['priem_use'][3]['chance'] = 25;
	$pr_vars['priem_use'][3]['name'] = 'Ярость';
	$pr_vars['priem_use'][3]['id'] = 14;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

	$pr_use = 1;
}
if($this->users[$this->uids[$uid1]]['bot_id'] == 355) {
### Проклятие Глубин [8] - Бездна 2 этаж
/* (800HP)
В количестве: 8 шт.
Сила: 80
Ловкость: 3
Интуиция: 3
Выносливость: 40
Интеллект: 0
Мудрость: 0
1 удар 2 блока. Профильный урон: дробящий, стихийная атака: огонь. Воскресают (примерно через час после смерти).
Обладает толстой бронёй.
 */
	$pr_use = 1;
}

/*
* Конец Бездны (Бездна)
* */

if($this->users[$this->uids[$uid1]]['bot_id'] == 132) {
###Каменный страж [9]
###To Do : Раздавить, Сотрясение
  $pr_use = 0;

}

if($this->users[$this->uids[$uid1]]['bot_id'] == 133) {
###Дух-Хранитель [10]
###To Do : Призрачное касание
 $pr_use = 1;
	$pr_vars['priem_use'][0]['chance'] = 15;
	$pr_vars['priem_use'][0]['name'] = 'Призрачное Касание';
	$pr_vars['priem_use'][0]['id'] = 363;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];

}


if($this->users[$this->uids[$uid1]]['bot_id'] == 135) {
###Механик [9]
###To Do : Починить
  $pr_use = 0;
  
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 136) {
###Механический Голем [9]
###To Do : Вспышка, Обнять
  $pr_use = 1;
  
  $pr_vars['priem_use'][0]['chance'] = 3;
  $pr_vars['priem_use'][0]['name'] = 'Оттеснить';
  $pr_vars['priem_use'][0]['id'] = 212;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
  
  	  //Быстрый удар
  $pr_vars['priem_team_f'][0]['chance'] = 45;
  $pr_vars['priem_team_f'][0]['name'] = '<font color=brown>Вспышка</font>';
  $pr_vars['priem_team_f'][0]['x'] = 1;
  $pr_vars['priem_team_f'][0]['type'] = 0;
  $pr_vars['priem_team_f'][0]['hp'] = 0;
  $pr_vars['priem_team_f'][0]['hp_dmg'] = rand(65,125);
  $pr_vars['priem_team_f'][0]['priem'] = 67;
  $pr_vars['priem_team_f'][0]['team'] = $this->users[$this->uids[$uid2]]['team'];
  $pr_vars['priem_team_f'][0]['on'] = $uid;
  $pr_vars['priem_team_f'][0]['nomf'] = 0;
  $pr_vars['priem_team_f'][0]['fiz'] = 0;
  $pr_vars['priem_team_f'][0]['krituet'] = true;
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 139) {
###Страж Сокровищ [11]
###To Do : Сотрясение, Проклятье стража, Раздавить, Сотрясение мозга
  $pr_use = 1;
if(rand(0,100) <= 35) {
  $pr_vars['priem_use'][0]['chance'] = 100;
  $pr_vars['priem_use'][0]['name'] = 'Сотрясение';
  $pr_vars['priem_use'][0]['id'] = 348;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
}
  
  if($hp <= 50) {
	  $pr_vars['priem_use'][1]['chance'] = 70;
	  $pr_vars['priem_use'][1]['name'] = 'Проклятье Стража';
	  $pr_vars['priem_use'][1]['id'] = 350;
	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid2]];
  }
  
  if(rand(0,100) <= 30) {
	  $hpRand = rand(12,43);
	  $this->stats[$this->uids[$uid2]]['hpNow'] -= $hpRand;
	  $this->users[$this->uids[$uid2]]['last_hp'] =- $hpRand;
	  mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].', `last_hp` = '.$this->users[$this->uids[$uid2]]['last_hp'].' WHERE `id` = '.$this->stats[$this->uids[$uid2]]['id'].' LIMIT 1');
	  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
	  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
	  $mas['text'] = '{tm1} {u1} применил прием <font color=brown><b>&quotРаздавить&quot;</font></b> на {u2} <font color=brown><b> - '.$hpRand.' </font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
	  $this->add_log($mas);
  }
  
if($this->stats[$this->uids[$uid2]]['s5'] > 20 && $this->stats[$this->uids[$uid2]]['s6'] > 30 && rand(0,100) <= 30) {
	$mpRand = rand(100,300);
	$this->stats[$this->uids[$uid2]]['mpNow'] -= $mpRand;
	
	if($this->stats[$this->uids[$uid2]]['mpNow'] < 0) {
		$this->stats[$this->uids[$uid2]]['mpNow'] = 0;
	}
	 mysql_query('UPDATE `stats` SET `mpNow` = '.$this->stats[$this->uids[$uid2]]['mpNow'].' WHERE `id` = '.$this->stats[$this->uids[$uid2]]['id'].' LIMIT 1');
	 $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
	  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
	  $mas['text'] = '{tm1} {u1} применил прием <font color=darkblue><b>&quot;Сотрясение Мозга&quot;</font></b> на {u2} и украл у него манну: <font color=darkblue><b>- '.$mpRand.' </font></b>['.$this->stats[$this->uids[$uid2]]['mpNow'].'/'.$this->stats[$this->uids[$uid2]]['mpAll'].']';
	  $this->add_log($mas);
}
  
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 141) {
###Механический Убийца [10]
###To Do : Взрыв, Глубокая рана
  $pr_use = 1;
  $ran = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `v2` = 349 AND `delete` = 0 LIMIT 1'));
  if(isset($ran['id'])) {
	  $ranHP2 = round($this->stats[$this->uids[$uid2]]['hpAll']*0.30/10); 
	  $this->stats[$this->uids[$uid2]]['hpNow'] -= $ranHP2;
	  mysql_query('UPDATE `stats` SET `mpNow` = '.$this->stats[$this->uids[$uid2]]['mpNow'].' WHERE `id` = '.$this->stats[$this->uids[$uid2]]['id'].' LIMIT 1');
	  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
	  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
	  $mas['text'] = '{tm1} {u2} получил повреждение от приема <font color=green><b>&quot;Глубокая Рана&quot; - '.$ranHP2.'</font></b> ['.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
	  $this->add_log($mas);
  }elseif(!isset($ran['id']) && rand(0,100) <= 27) {
	  $ranHP = $this->stats[$this->uids[$uid2]]['hpAll'];
	  $ranHP = round($ranHP/100);
	  $this->stats[$this->uids[$uid2]]['hpNow'] -= $ranHP;
	  $go = mysql_query('UPDATE `stats` SET `mpNow` = '.$this->stats[$this->uids[$uid2]]['mpNow'].' WHERE `id` = '.$this->stats[$this->uids[$uid2]]['id'].' LIMIT 1');
	  if($go) {
		  mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid2]]['id'].'","Глубокая Рана","from_ptp","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","349","bot_deathstrike.gif","1","10")');
		  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		  $mas['text'] = '{tm1} {u1} применил прием <font color=darkred><b>&quot;Глубокая Рана&quot;</font></b> на {u2} и нанес урон: <font color=darkred><b>- '.$ranHP.' </font></b>['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		  $this->add_log($mas);
	  }
  }
  
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 143) {
###Механический Охранник [10]
###To Do : Вспышка, Обнять
  $pr_use = 1;
  
  $pr_vars['priem_use'][0]['chance'] = 3;
  $pr_vars['priem_use'][0]['name'] = 'Оттеснить';
  $pr_vars['priem_use'][0]['id'] = 212;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
  
}
	
  if($pr_use > 0) {
  	//priem_use , priem_team_f , priem_regen БОТ ИСПОЛЬЗУЕТ ТОЛЬКО 1 ПРИЕМ
  	//if( count($pr_vars['priem_use']) > 0 && count($pr_vars['priem_team_f']) > 0 ) {
		if( rand(0,1) == 1 || !isset($pr_vars['priem_team_f']) ) {
			$pr_vars['priem_use'] = $pr_vars['priem_use'][rand(0,count($pr_vars['priem_use'])-1)];
			$pr_vars['priem_use'] = array( 0 => $pr_vars['priem_use'] );
			unset($pr_vars['priem_team_f']);
		}else{
			$pr_vars['priem_team_f'] = $pr_vars['priem_team_f'][rand(0,count($pr_vars['priem_team_f'])-1)];
			$pr_vars['priem_team_f'] = array( 0 => $pr_vars['priem_team_f'] );
			unset($pr_vars['priem_use']);
		}
	//}
  
	$i = 0;
	while($i < count($pr_vars['priem_team_f'])) {
	  if($pr_vars['priem_team_f'][$i]['chance']*10000 >= rand(0, 1000000)) {
	    $xx = 0; $ix = 0;
		$pl = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `activ` != "-1" AND `id` = "'.$pr_vars['priem_team_f'][$i]['priem'].'" LIMIT 1'));
		while($ix < count($this->users)) {
		  if($this->stats[$ix]['hpNow'] > 0 && $this->users[$ix]['team'] == $pr_vars['priem_team_f'][$i]['team'] && $xx < $pr_vars['priem_team_f'][$i]['x']) {
		    if(isset($pl['id'])) {
		      $pr_vars['priem_team_f'][$i]['hp_dmg'] = $this->testYronPriem( $uid1, $uid2, 12, $pr_vars['priem_team_f'][$i]['hp_dmg'], -1, true );
			  $as = $priem->magicAtack($this->users[$ix], $pr_vars['priem_team_f'][$i]['hp_dmg'], $pr_vars['priem_team_f'][$i]['type'], $pl, array('user_use' => $this->users[$this->uids[$uid1]]['id']), 0, 0, $pr_vars['priem_team_f'][0]['fiz'], $pr_vars['priem_team_f'][$i]['nomf'], $pr_vars['priem_team_f'][0]['krituet'], $this->users[$this->uids[$uid1]]['id'],$pr_vars['priem_team_f'][$i]['name']);
			  ###тестирование востановления ХП после нанесенного урона. (Востанавливает)
              if($as && isset($pr_vars['priem_team_f'][$i]['hpregen'])) {
                if(isset($pr_vars['priem_team_f'][$i]['hp']) || isset($pr_vars['priem_team_f'][$i]['hp_dmg'])) {
                  if(isset($pr_vars['priem_team_f'][$i]['hp_dmg'])) {
                    $n_hp = $this->stats[$this->uids[$uid1]]['hpNow']+$as[0];
                    $hp_vis = '+'.$as[0];
                  } else {
                    $n_hp = $this->stats[$this->uids[$uid1]]['hpNow']+$pr_vars['priem_team_f'][$i]['hp'];
                    $hp_vis = '+'.$pr_vars['priem_team_f'][$i]['hp'];
                  }
                  if($n_hp > $this->stats[$this->uids[$uid1]]['hpAll']) {
                    $n_hp = $this->stats[$this->uids[$uid1]]['hpAll'];
                  }
                  $uid_b = $this->users[$this->uids[$uid1]]['id'];
                  $this->users[$this->uids[$uid1]]['hpNow'] = $n_hp;
                  $this->stats[$this->uids[$uid1]]['hpNow'] = $n_hp;
                  mysql_query('UPDATE `stats` SET `hpNow` = '.$n_hp.' WHERE `id` = "'.$uid_b.'" LIMIT 1');
                  $pr_vars['mas']['text'] = '{tm1} {u1} использовал прием &quot;<b>'.$pr_vars['priem_team_f'][$i]['name'].'</b>&quot; и восстановил свое здоровье. <b><font color=#006699>'.$hp_vis.'</font></b> ['.$this->users[$this->uids[$uid1]]['hpNow'].'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
                  $pr_vars['mas']['vLog'] = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
                  $pr_vars['mas'] = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>$pr_vars['mas']['text'],'vars'=>$pr_vars['mas']['vLog'],'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
                  $this->add_log($pr_vars['mas']);
                }
			  }
              ###
            }
			$xx++;
		  }
		  $ix++;
		}
	  }
	  $i++;	
	}

    if(isset($pr_vars['priem_regen']) && $pr_vars['priem_regen']['chance']*10000 >= rand(0, 1000000)) {
      $pr_vars['hp_u1'] += $pr_vars['priem_regen']['hp'];
	  if($pr_vars['priem_regen']['hp'] > 0) {
		$pr_vars['priem_regen']['hp'] = '+'.$pr_vars['priem_regen']['hp'];
	  }
	  $this->users[$this->uids[$uid1]]['hpNow'] = $pr_vars['hp_u1'];
	  $this->stats[$this->uids[$uid1]]['hpNow'] = $pr_vars['hp_u1'];
	  
	  if( $pr_vars['hp_u1'] > $this->stats[$this->uids[$uid1]]['hpAll'] ) {
		 $pr_vars['hp_u1'] = $this->stats[$this->uids[$uid1]]['hpAll'];
	  }
	  
      mysql_query('UPDATE `stats` SET `hpNow` = '.$pr_vars['hp_u1'].' WHERE `id` = "'.$uid2.'" LIMIT 1');
	  $pr_vars['mas']['text'] = '{tm1} {u1} использовал прием &quot;<b>'.$pr_vars['priem_regen']['name'].'</b>&quot; и восстановил свое здоровье. <b><font color=#006699>'.$pr_vars['priem_regen']['hp'].'</font></b> ['.ceil($pr_vars['hp_u1']).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
	  $pr_vars['mas']['vLog'] = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
	  $pr_vars['mas'] = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID),'text'=>$pr_vars['mas']['text'],'vars'=>$pr_vars['mas']['vLog'],'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
	  $this->add_log($pr_vars['mas']);
    }
	
	$i = 0;
	while($i < count($pr_vars['priem_use'])) {
	  if(isset($pr_vars['priem_use'][$i]) && $pr_vars['priem_use'][$i]['chance'] >= rand(0, 100)) {
		$pl = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `activ` != "-1" AND `id` = "'.mysql_real_escape_string($pr_vars['priem_use'][$i]['id']).'" LIMIT 1'));
		
        if(isset($pl['id']) && $pl['id'] == 290) {
          $priem->magicAtack($pr_vars['priem_use'][$i]['on'], 100, $pr_vars['priem_use'][$i]['type'], $pl, array('user_use' => $uid1), 0, 0, 0, 0, true, $this->users[$this->uids[$uid1]]['id'], $pl['name']);
        }
        
        if(isset($pl['id'])) {
		  $rcu = false;
	      $j = $u->lookStats($pl['date2']);		
		  $mpr = false; $addch = 0;
		  $uid = $this->users[$this->uids[$uid1]]['id'];
		  if(isset($pr_vars['priem_use'][$i]['on']['id'])) {
			$uid = $pr_vars['priem_use'][$i]['on']['id'];
		  }
		  if(isset($j['onlyOne'])) {
			$mpr = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `v2` = "'.$pl['id'].'" AND `uid` = "'.$uid.'" AND `delete` = 0 LIMIT 1'));
		  }
		  $pld = array(0 => ''); $nc = 0;
		  if(isset($mpr['id']) && $j['onlyOne'] == 1) {
			$addch = 1;
			//$priem->mintr($pl);
			$priem->uppz($pl, $id);
			if(isset($pr_vars['priem_use'][$i]['on']['id'])) {
			  $this->stats[$this->uids[$uid]] = $u->getStats($pr_vars['priem_use'][$i]['on'], 0);
			} else {
			  $this->stats[$this->uids[$uid]] = $u->getStats($this->users[$this->uids[$uid1]], 0);	
			}
			$nc = 1;
		  } elseif(!isset($mpr['id'])) {
			$data = '';
			if(isset($j['date3Plus'])) {
			  $data = $priem->redate($pl['date3'], $this->users[$this->uids[$uid1]]['id']);
			}
			$hd1 = -1;
			if($pl['limit'] > 0) {
			  $tm = 77;
			  $hd1 = $pl['limit'];
			} else {
			  $tm = 77;
			}
			mysql_query('INSERT INTO `eff_users` (`hod`, `v2`, `img2`, `id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `v1`, `user_use`) VALUES ("'.$hd1.'", "'.$pl['id'].'", "'.$pl['img'].'.gif", 22, "'.$uid.'", "'.$pr_vars['priem_use'][$i]['name'].'", "'.$data.'", 0, "'.$tm.'", "priem", "'.$this->users[$this->uids[$uid1]]['id'].'")');
			unset($hd1);
			$addch = 1; $rcu = true; $nc = 1;
			//$priem->mintr($pl);
			$priem->uppz($pl,$id);
		  } elseif($j['onlyOne'] > 1) {
			if($mpr['x'] < $j['onlyOne']) {
			  if(isset($j['date3Plus'])) {
				$j1 = $u->lookStats($mpr['data']);
				$j2 = $u->lookStats($priem->redate($pl['date3'], $this->users[$this->uids[$uid1]]['id']));
				$v = $u->lookKeys($priem->redate($pl['date3'], $this->users[$this->uids[$uid1]]['id']), 0);
				$i56 = 0; $inf = '';
				while($i56 < count($v)) {
				  $j1[$v[$i56]] += $j2[$v[$i56]];
				  $vi = str_replace('add_', '', $v[$i56]);
				  if($u->is[$vi] != '') {
					if($j2[$v[$i56]] > 0) {
					  $inf .= $u->is[$vi].': +'.($j2[$v[$i56]]*(1+$mpr['x'])).', ';
					} elseif($j2[$v[$i56]] < 0) {
					  $inf .= $u->is[$vi].': '.($j2[$v[$i56]]*(1+$mpr['x'])).', ';	
					}
				  }
				  $i56++;	
				}
				$inf = rtrim($inf, ', ');
				$j1 = $u->impStats($j1);
				$pld[0] = ' x'.($mpr['x']+1);
				$upd = mysql_query('UPDATE `eff_users` SET `data` = "'.$j1.'", `x` = `x`+1 WHERE `id` = "'.$mpr['id'].'" LIMIT 1');
				if($upd) {
				  //$priem->mintr($pl);
				  $priem->uppz($pl, $id);
				  $addch = 1;
				  $rcu = true;
				  $nc = 1;
				}
			  }				
			}				
		  }
		}
		if($rcu == true && !isset($pr_vars['priem_use'][$i]['no_chat'])) {
		  if( $inf != '' ) {
			 $inf = '('.$inf.')'; 
		  }
		  if($this->users[$this->uids[$uid1]]['id'] != $uid) {
			if(isset($inf)) {
			  $pr_vars['mas']['text'] = '{tm1} {u1} использовал прием &quot;<b>'.$pr_vars['priem_use'][$i]['name'].$pld[0].'</b>&quot; на персонажа {u2}. <small>'.$inf.'</small>';
			} else {
			  $pr_vars['mas']['text'] = '{tm1} {u1} использовал прием &quot;<b>'.$pr_vars['priem_use'][$i]['name'].$pld[0].'</b>&quot;  на персонажа {u2}.';
		    }
		  } else {
			if(isset($inf)) {
			  $pr_vars['mas']['text'] = '{tm1} {u1} использовал прием &quot;<b>'.$pr_vars['priem_use'][$i]['name'].$pld[0].'</b>&quot;. <small>'.$inf.'</small>';
			} else {
			  $pr_vars['mas']['text'] = '{tm1} {u1} использовал прием &quot;<b>'.$pr_vars['priem_use'][$i]['name'].$pld[0].'</b>&quot;.';
			}
		  }
		  $pr_vars['mas']['vLog'] = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		  $pr_vars['mas'] = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID),'text'=>$pr_vars['mas']['text'],'vars'=>$pr_vars['mas']['vLog'],'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		  $this->add_log($pr_vars['mas']);
		}
	  }
	  $i++;
	}
	unset($pr_use, $pr_vars);
  }
}
?>