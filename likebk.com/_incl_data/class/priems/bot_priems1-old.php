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








if($this->users[$this->uids[$uid1]]['bot_id'] == 287) { //������� �����

if($this->hodID == 3 || $this->hodID == 7 || $this->hodID ==  11 || $this->hodID == 15 || $this->hodID == 19 || $this->hodID == 23 || $this->hodID == 27 || $this->hodID == 31 || $this->hodID == 35 || $this->hodID == 39 || $this->hodID == 43 || $this->hodID == 47 || $this->hodID == 51 || $this->hodID == 55 || $this->hodID == 59 || $this->hodID == 63 || $this->hodID == 67 || $this->hodID == 71) {

$teams = mysql_query('SELECT `u`.`id`,`u`.`battle`,`u`.`login`,`s`.`team` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`team` = "'.$this->users[$this->uids[$uid2]]['team'].'" AND `u`.`battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'"');
		
		while($team = mysql_fetch_array($teams)) {
			
			//��������� �������
			$hp_p = rand(80,100);
			$this->users[$this->uids[$team['id']]]['hpNow'] -= $hp_p;
			$this->users[$this->uids[$team['id']]]['last_hp'] =- $hp_p;
			$this->stats[$this->uids[$team['id']]]['hpNow'] -= $hp_p;
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$team['id']]]['hpNow'].'" , `last_hp` = "'.$this->users[$this->uids[$team['id']]]['last_hp'].'" WHERE `id` = "'.$this->users[$this->uids[$team['id']]]['id'].'" LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1}, ����� ���� � ������ ������ <b>&quot;��������� �������&quot;</b> �� ���������: <b>'.$team['login'].' <font color=bagr>-'.$hp_p.'</b></font> ['.$this->stats[$this->uids[$team['id']]]['hpNow'].'/'.$this->stats[$this->uids[$team['id']]]['hpAll'].']';
			$this->add_log($mas);
		}
}
}


//���� �������


if($this->users[$this->uids[$uid1]]['bot_id'] == 698) { //���������
	$pr_use = 1;
if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50) {
	$pr_vars['priem_regen']['hp'] = 250;
	$pr_vars['priem_regen']['chance'] = 1010;
	$pr_vars['priem_regen']['name'] = '������� �������';
}elseif($this->hodID == 6 || $this->hodID == 11 || $this->hodID == 16 || $this->hodID == 22 || $this->hodID == 26 || $this->hodID == 31 || $this->hodID == 36 || $this->hodID == 41 || $this->hodID == 46 || $this->hodID == 51) {	
	$pr_vars['priem_use'][0]['chance'] = 1010;
	$pr_vars['priem_use'][0]['name'] = '������ �������';
	$pr_vars['priem_use'][0]['id'] = 10;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
}elseif($this->hodID == 7 || $this->hodID ==  14 || $this->hodID == 21 || $this->hodID == 28 || $this->hodID == 37 || $this->hodID == 43 || $this->hodID == 51 || $this->hodID == 59 || $this->hodID == 67 || $this->hodID == 75) {
	
	$pr_vars['priem_use'][0]['chance'] = 1010;
	$pr_vars['priem_use'][0]['name'] = '������� �����';
	$pr_vars['priem_use'][0]['id'] = 376;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
}
	
	$now = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `name` LIKE "%������� �����%" AND `delete` = 0 LIMIT 1'));
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
			$mas['text'] = '{tm1} {u1} ����������� �������� � ������� ������ <b>&quot;������� �����&quot; <font color=green> + '.ceil(($hpNow/2)).'</font></b> ['.(ceil($this->stats[$this->uids[$uid1]]['hpNow'])).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].'] <br> {tm2} {u2} ������� �������� �� ������ <b>&quot;������� �����&quot; <font color=green> - '.$hpNow.' </font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			$this->add_log($mas);
	}
	
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 529) { //������� ����� �����
	$pr_use = 1;
	
	if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 70 || $this->hodID == 75 || $this->hodID == 80 || $this->hodID == 85 || $this->hodID == 90 || $this->hodID == 95 || $this->hodID == 100 || $this->hodID == 105 || $this->hodID == 110 || $this->hodID == 115 || $this->hodID == 120 || $this->hodID == 125 || $this->hodID == 130 || $this->hodID == 135 || $this->hodID == 140) {
	
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = '�������� ���';
		$pr_vars['priem_use'][0]['id'] = 249;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}elseif($this->hodID == 6 || $this->hodID == 11 || $this->hodID == 16 || $this->hodID == 21 || $this->hodID == 24 || $this->hodID == 31 || $this->hodID == 36 || $this->hodID == 41 || $this->hodID == 46 || $this->hodID == 51 || $this->hodID == 56 || $this->hodID == 61 || $this->hodID == 65 || $this->hodID == 71 || $this->hodID == 76 || $this->hodID == 81 || $this->hodID == 86 || $this->hodID == 91 || $this->hodID == 96 || $this->hodID == 101 || $this->hodID == 106 || $this->hodID == 111 || $this->hodID == 117 || $this->hodID == 123 || $this->hodID == 129 || $this->hodID == 136 || $this->hodID == 141) {
	
		$pr_vars['priem_use'][0]['chance'] = 1010 ;
		$pr_vars['priem_use'][0]['name'] = '���������� ������';
		$pr_vars['priem_use'][0]['id'] = 140;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}elseif($this->hodID == 7 || $this->hodID == 14 || $this->hodID == 22 || $this->hodID == 28 || $this->hodID == 34 || $this->hodID == 42 || $this->hodID == 48 || $this->hodID == 54 || $this->hodID == 60 || $this->hodID == 66 || $this->hodID == 72 || $this->hodID == 78 || $this->hodID == 84 || $this->hodID == 91 || $this->hodID == 97 || $this->hodID == 103 || $this->hodID == 109 || $this->hodID == 114 || $this->hodID == 121 || $this->hodID == 127 || $this->hodID == 134 || $this->hodID == 139) {
	
		$pr_vars['priem_regen']['hp'] = 250;
		$pr_vars['priem_regen']['chance'] = 1010;
		$pr_vars['priem_regen']['name'] = '������� �������';
	}
	
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 487) { //������
	
	if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 70 || $this->hodID == 75 || $this->hodID == 80 || $this->hodID == 85 || $this->hodID == 90 || $this->hodID == 95 || $this->hodID == 100) {
	
		$VALUES = '"22","'.$this->users[$this->uids[$uid1]]['id'].'","����������� ����","","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","138","krit_crush.gif","1","-1"';
		
		mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ('.$VALUES.') ');
		
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		
	    $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		
		$mas['text'] = '{tm1} {u1} ����������� ����� <b>&quot;����������� ����&quot;</b>';
		
	    $this->add_log($mas);
	}
	

}


if($this->users[$this->uids[$uid1]]['bot_id'] == 530) { //������� ����
	
	$pr_use = 1;
	
	if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50) {
		$hpOG = rand(400,450);
		$this->users[$this->uids[$uid2]]['hpNow'] -= $hpOG;
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $hpOG;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $hpOG;
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
	    $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
	    $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
	    $mas['text'] = '{tm1} {u1} ����� ���� �� {u2} � ������� ������ <b>&quot;���������� ����&quot; - <font color=green>'.$hpOG.'</font></b> ['.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
	    $this->add_log($mas);
	}
}



if($this->users[$this->uids[$uid1]]['bot_id'] == 522) { //��������� �������

	$pr_use = 1;
	
	if($this->hodID == 3 || $this->hodID == 14 || $this->hodID == 25 || $this->hodID == 36 || $this->hodID == 47 || $this->hodID == 58 || $this->hodID == 69 || $this->hodID == 80 || $this->hodID == 91 || $this->hodID == 102) {
		
				$pr_vars['priem_use'][0]['chance'] = 1010;
				$pr_vars['priem_use'][0]['name'] = '�������� ������';
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
				  $mas['text'] = '{tm2} {u2} ������� �������� �� ������ <b>&quot;�������� ������&quot; <font color=green> - '.ceil(($hpS)).'</font></b> ['.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
				  $this->add_log($mas);
			}
}



if($this->users[$this->uids[$uid1]]['bot_id'] == 537) { //������� ��������

	if($this->hodID == 5) {
	$eff = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `name` LIKE "%��������� �����%" AND `delete` = 0 LIMIT 1'));
	
	if(!isset($eff['id'])) {
		
		$s = rand(1,3);
		
		$stat = 'add_s'.$s.'=-20';
		
		$VALUES = '"22","'.$this->users[$this->uids[$uid2]]['id'].'","��������� �����","'.$stat.'","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","361","gl_mob_eatmeat_cut.gif","1","7"';
		
		mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ('.$VALUES.') ');
		
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		
	    $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		
		$mas['text'] = '{tm1} {u1} <b>�������� �����, ���������</b> {u2}';
		
	    $this->add_log($mas);
	}
		
}
	
	
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 532) { 

$pr_use = 1;

$pr_vars['priem_use'][0]['chance'] = 1010;
	$pr_vars['priem_use'][0]['name'] = '������ �������';
	$pr_vars['priem_use'][0]['id'] = 375;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

}

if($this->users[$this->uids[$uid1]]['bot_id'] == 523) { //��������� �����
	
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
			
			$mas['text'] = '{tm2} {u2} ������� �������� �� ������ <b>&quot;�������� ����&quot; <font color=green>-'.$hpYad.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			
			$this->add_log($mas);
		}
	
	if($this->hodID == 3 || $this->hodID == 9 || $this->hodID == 17 || $this->hodID == 24 || $this->hodID == 31 || $this->hodID == 38 || $this->hodID == 45 || $this->hodID == 52 || $this->hodID == 59 || $this->hodID == 66 || $this->hodID == 73 || $this->hodID == 80 || $this->hodID == 87 || $this->hodID == 94 || $this->hodID == 101) {
		
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = '�������� ����';
		$pr_vars['priem_use'][0]['id'] = 366;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		
	}elseif($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 44 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 70 || $this->hodID == 75|| $this->hodID == 81 || $this->hodID == 86 || $this->hodID == 91 || $this->hodID == 96 || $this->hodID == 100  ) {
			
			$pr_vars['priem_regen']['hp'] = rand(60,100);
			$pr_vars['priem_regen']['chance'] = 1010;
			$pr_vars['priem_regen']['name'] = '�����������';
			
	}elseif($this->hodID == 7 || $this->hodID == 12) {
		
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = '��������� ��������� ��������';
		$pr_vars['priem_use'][0]['id'] = 367;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		
	}
	
	
}



if($this->users[$this->uids[$uid1]]['bot_id'] == 531) { //������� ���� ���������
	
	$pr_use = 1;
	
	/*
	����� "��������������" - ���. �� ������� +100 �� 2 ���� - 1 ��� � 7 �����
	����� "������� �������" - ����� ���� �� 200�� � ������ ��� - 1 ��� � 6 �����
	����� "���������� ����" - ������� 150-200 �� ����� � ������� �� 1 ��� (������ ��� ������ "�������� ������") - ����� ������ ���
*/
	
	if($this->hodID == 3 || $this->hodID == 10 || $this->hodID == 17 || $this->hodID == 24 || $this->hodID == 31 || $this->hodID == 38 || $this->hodID == 45 || $this->hodID == 52 || $this->hodID == 59 || $this->hodID == 65 || $this->hodID == 72 || $this->hodID == 79 || $this->hodID == 85 || $this->hodID == 92 || $this->hodID == 99 || $this->hodID == 106 || $this->hodID == 113 || $this->hodID == 120 || $this->hodID == 127 || $this->hodID == 134 || $this->hodID == 141) {
		
		$pr_use = 1;
		
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = '��������������';
		$pr_vars['priem_use'][0]['id'] = 369;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		
	}elseif($this->hodID == 5 || $this->hodID == 11 || $this->hodID == 18 || $this->hodID == 23 || $this->hodID == 29 || $this->hodID == 35 || $this->hodID == 41 || $this->hodID == 46 || $this->hodID == 50 || $this->hodID == 56 || $this->hodID == 61 || $this->hodID == 67 || $this->hodID == 73 || $this->hodID == 78 || $this->hodID == 84 || $this->hodID == 90 || $this->hodID == 96 || $this->hodID == 102 || $this->hodID == 108 || $this->hodID == 114 || $this->hodID == 122 || $this->hodID == 128 || $this->hodID == 135 || $this->hodID == 140) {
		
			$pr_vars['priem_regen']['hp'] = 200;
			$pr_vars['priem_regen']['chance'] = 1010;
			$pr_vars['priem_regen']['name'] = '������� �������';
		
	}elseif($this->hodID == 8 || $this->hodID == 12 || $this->hodID == 16 || $this->hodID == 20 || $this->hodID == 24 || $this->hodID == 28 || $this->hodID == 32 || $this->hodID == 36 || $this->hodID == 40 || $this->hodID == 44 || $this->hodID == 48 || $this->hodID == 53 || $this->hodID == 57 || $this->hodID == 62 || $this->hodID == 66 || $this->hodID == 70 || $this->hodID == 76 || $this->hodID == 82 || $this->hodID == 86 || $this->hodID == 91 || $this->hodID == 97 || $this->hodID == 103 || $this->hodID == 109 || $this->hodID == 115 || $this->hodID == 121 || $this->hodID == 127 || $this->hodID == 133 || $this->hodID == 139 || $this->hodID == 145) {
		
		$teams = mysql_query('SELECT `u`.`id`,`u`.`battle`,`u`.`login`,`s`.`team` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`team` = "'.$this->users[$this->uids[$uid2]]['team'].'" AND `u`.`battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'"');
		
		while($team = mysql_fetch_array($teams)) {
			
			
			
			$team_hp = rand(150,200);
			
			$this->users[$this->uids[$team['id']]]['hpNow'] -= $team_hp;
			
			$this->users[$this->uids[$team['id']]]['last_hp'] =- $team_hp;
			
			$this->stats[$this->uids[$team['id']]]['hpNow'] -= $team_hp;
			
			$VALUES = '"22","'.$this->users[$this->uids[$team['id']]]['id'].'","���������� ����","add_notactic=1|add_nousepriem=1","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","368","wis_earth_flower.gif","1","1"';
		
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ('.$VALUES.') ');
			
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$team['id']]]['hpNow'].'", `last_hp` = "'.$this->users[$this->uids[$team['id']]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$team['id']]]['id'].'" LIMIT 1');
			
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			
			$mas['text'] = '{tm1} <b><font color=darkblue> ������� ���� ���������,</b></font> �������� ����� <b><font color=brown>&quot;���������� ����</b></font> �� <b>'.$team['login'].' <font color=green> - '.$team_hp.' </font></b>['.$this->stats[$this->uids[$team['id']]]['hpNow'].'/'.$this->stats[$this->uids[$team['id']]]['hpAll'].']';
			
			$this->add_log($mas);
			
		}
	}
} 


if($this->users[$this->uids[$uid1]]['bot_id'] == 534 || $this->users[$this->uids[$uid1]]['bot_id'] == 528 ) { //�������� ��� ������� ����������� ���������

$pr_use = 1;
	
	if($this->hodID == 8 || $this->hodID == 12 || $this->hodID == 16 || $this->hodID == 21 || $this->hodID == 24 || $this->hodID == 29 || $this->hodID == 32 || $this->hodID == 37 || $this->hodID == 43 || $this->hodID == 48 || $this->hodID == 53 || $this->hodID == 58 || $this->hodID == 64 || $this->hodID == 69 || $this->hodID == 74 || $this->hodID == 79 || $this->hodID == 83 || $this->hodID == 87 || $this->hodID == 92 || $this->hodID == 97 || $this->hodID == 102 || $this->hodID == 106 || $this->hodID == 111 || $this->hodID == 116 || $this->hodID == 120 || $this->hodID == 125 || $this->hodID == 130 || $this->hodID == 135 || $this->hodID == 140) {
		
		$teams = mysql_query('SELECT `u`.`id`,`u`.`battle`,`u`.`login`,`s`.`team` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id`  WHERE `s`.`team` = "'.$this->users[$this->uids[$uid2]]['team'].'" AND `u`.`battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'"');
		
		while($team = mysql_fetch_array($teams)) {
			
			
			
			$team_hp = rand(150,200);
			
			$this->users[$this->uids[$team['id']]]['hpNow'] -= $team_hp;
			
			$this->users[$this->uids[$team['id']]]['last_hp'] =- $team_hp;
			
			$this->stats[$this->uids[$team['id']]]['hpNow'] -= $team_hp;
			
			$VALUES = '"22","'.$this->users[$this->uids[$team['id']]]['id'].'","������� ���","add_notactic=1|add_nousepriem=1","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","371","multi_hitshock.gif","1","1"';
		
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ('.$VALUES.') ');
			
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$team['id']]]['hpNow'].'", `last_hp` = "'.$this->users[$this->uids[$team['id']]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$team['id']]]['id'].'" LIMIT 1');
			
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			
			$mas['text'] = '{tm1} <b><font color=darkblue> ������� ���� ���������,</b></font> �������� ����� <b><font color=brown>&quot;�������</b></font> �� <b>'.$team['login'].' <font color=green> - '.$team_hp.' </font></b>['.$this->stats[$this->uids[$team['id']]]['hpNow'].'/'.$this->stats[$this->uids[$team['id']]]['hpAll'].']';
			
			$this->add_log($mas);
			
		}
			
		}elseif($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 36 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 71 || $this->hodID == 75 || $this->hodID == 80 || $this->hodID == 85) {
		
			$pr_vars['priem_regen']['hp'] = 200;
			$pr_vars['priem_regen']['chance'] = 1010;
			$pr_vars['priem_regen']['name'] = '������� �������';
		
	}elseif($this->hodID == 7 || $this->hodID == 14 || $this->hodID == 21 || $this->hodID == 28 || $this->hodID == 35 || $this->hodID == 42 || $this->hodID == 49 || $this->hodID == 56 || $this->hodID == 63 || $this->hodID == 71 || $this->hodID == 78 || $this->hodID == 86 || $this->hodID == 93 || $this->hodID == 100 || $this->hodID == 107 || $this->hodID == 114 || $this->hodID == 121) {
		
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = '�������� ����';
		$pr_vars['priem_use'][0]['id'] = 219;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		
	}

	
}



if($this->users[$this->uids[$uid1]]['bot_id'] == 517) { //�������� ������
	
	$pr_use = 1;
	
	if($this->hodID == 3 || $this->hodID == 10 || $this->hodID == 17 || $this->hodID == 24 || $this->hodID == 31 || $this->hodID == 38 || $this->hodID == 45 || $this->hodID == 52 || $this->hodID == 59 || $this->hodID == 66 || $this->hodID == 73 || $this->hodID == 80 || $this->hodID == 87 || $this->hodID == 94 || $this->hodID == 101) {
		
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = '�������� �����������';
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
				
				$mas['text'] = '{tm1} {u1} ����� ���� � ������� ������ <b>&quot;�������� �������&quot;</b> �� ��������� {u2} <b><font color=green>-'.$ob.'</b></font> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
				
				$this->add_log($mas);
				
				$pr_vars['priem_use'][0]['chance'] = 1010;
				$pr_vars['priem_use'][0]['name'] = '�������� ����������';
				$pr_vars['priem_use'][0]['id'] = 373;
				$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
				
			
		}
		
	}
	
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 535) { //������ �����������
	
	if($this->hodID == 4 || $this->hodID == 13 || $this->hodID == 22 || $this->hodID == 31 || $this->hodID == 40 || $this->hodID == 49 || $this->hodID == 58 || $this->hodID == 67 || $this->hodID == 76 || $this->hodID == 85 || $this->hodID == 94) {
		
		$pr_use = 1;
		
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = '��������� �������';
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
		
		$mas['text'] = '{tm1} {u1} ����������� �������� � ������� ������ <b>&quot;������������� ����&quot; <font color=green>+'.ceil($hpl/2).'</b></font> ['.(ceil($this->stats[$this->uids[$uid1]]['hpNow'])).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].'] <br> {tm2} {u2} ��������� �� ������ <b>&quot;������������� ����&quot; <font color=green>-'.$hpl.'</b></font>  ['.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		
		$this->add_log($mas);
		
	}
	
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 533) { //��������� ������� ������
			$pr_use = 1;
			if($this->hodID == 6 || $this->hodID == 11 || $this->hodID == 16 || $this->hodID == 21 || $this->hodID == 26 || $this->hodID == 31 || $this->hodID == 36 || $this->hodID == 41 || $this->hodID == 46 || $this->hodID == 51 || $this->hodID == 56 || $this->hodID == 61 || $this->hodID == 66) {
				$pr_vars['priem_use'][0]['chance'] = 1010;
				$pr_vars['priem_use'][0]['name'] = '�������� ���';
				$pr_vars['priem_use'][0]['id'] = 249;
				$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
			}elseif($this->hodID == 7 || $this->hodID == 12 || $this->hodID == 17 || $this->hodID == 22 || $this->hodID == 27 || $this->hodID == 32 || $this->hodID == 37 || $this->hodID == 42 || $this->hodID == 47 || $this->hodID == 52 || $this->hodID == 57 || $this->hodID == 62 || $this->hodID == 67) {
				$pr_vars['priem_use'][0]['chance'] = 1010 ;
				$pr_vars['priem_use'][0]['name'] = '���������� ������';
				$pr_vars['priem_use'][0]['id'] = 140;
				$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
			}
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 538) { //������
 $pr_use = 1;
  if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40) {
	  
	$pr_vars['priem_regen']['hp'] = 150;
	$pr_vars['priem_regen']['chance'] = 1010;
	$pr_vars['priem_regen']['name'] = '�����������';
	
  }elseif($this->hodID == 6 || $this->hodID == 11 || $this->hodID == 16 || $this->hodID == 21 || $this->hodID == 26 || $this->hodID == 31 || $this->hodID == 36 || $this->hodID == 41) {
	  
		  for($i = 0; $i < 4; $i++) {
			  
			  $php = rand(40,50);
			  $this->stats[$this->uids[$uid2]]['hpNow'] -= $php;
			  $this->users[$this->uids[$uid2]]['hpNow'] -= $php;
			  $this->users[$this->uids[$uid2]]['last_hp'] =- $php;
			  mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
			  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			  $mas['text'] = '{tm1} {u1} ��������� ����� <b>&quot����� ������&quot; �� {u2} - <font color=green>'.$php.'</font></b> ['.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			  $this->add_log($mas);
			  
	  }
	  
  }
 
 
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 539) { //��������

$pr_use = 1;

  if($this->hodID == 3 || $this->hodID == 6 || $this->hodID == 9 || $this->hodID == 12 || $this->hodID == 15 || $this->hodID == 18 || $this->hodID == 21 || $this->hodID == 24 || $this->hodID == 27 || $this->hodID == 30 || $this->hodID == 33 || $this->hodID == 36 || $this->hodID == 39) {
	  $ydar = rand(200,250);
	  $this->users[$this->uids[$uid2]]['hpNow'] -= $ydar;
	  $this->stats[$this->uids[$uid2]]['hpNow'] -= $ydar;
	  $this->stats[$this->uids[$uid2]]['last_hp'] =- $ydar;
	  
	  mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
	   $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
	   $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} {u1} ������ ������ ��������� {u2} - <b><font color=green>'.$ydar.'</b></font> ['.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
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
	  
	  $mas['text'] = '{tm1} {u1} ����������� �������� � ������� ������ <b>&quot;���������� ����&quot; <font color=green>+'.ceil($hpp/2).'</b></font> ['.(ceil($this->stats[$this->uids[$uid1]]['hpNow'])).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].'] <br> {tm2} {u2} ��������� �� ������ <b>&quot;���������� ����&quot; <font color=green>-'.$hpp.'</b></font>  ['.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
	  
	  $this->add_log($mas);
	  
  }elseif($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40) {
	  
	    $pr_vars['priem_regen']['hp'] = rand(400,500);
		$pr_vars['priem_regen']['chance'] = 1010;
		$pr_vars['priem_regen']['name'] = '�����������';
  }

}




if($this->users[$this->uids[$uid1]]['bot_id'] == 536) { //������

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
			$mas['text'] = '{tm1} {u1} ����������� �������� � ������� ������ <b>&quot;������ �������&quot; <font color=green> + '.ceil(($hpNow/2)).'</font></b> ['.(ceil($this->stats[$this->uids[$uid1]]['hpNow'])).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].'] <br> {tm2} {u2} ������� �������� �� ������ <b>&quot;������ �������&quot; <font color=green> - '.$hpNow.' </font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			$this->add_log($mas);
	
}elseif($this->hodID == 7 || $this->hodID == 14 || $this->hodID == 21 || $this->hodID ==  28 || $this->hodID ==  35 || $this->hodID == 41 || $this->hodID == 49 || $this->hodID == 56 || $this->hodID == 63 || $this->hodID == 70 || $this->hodID == 77 || $this->hodID ==  84 || $this->hodID ==  92 || $this->hodID == 99 || $this->hodID == 106 || $this->hodID == 113 || $this->hodID == 120 || $this->hodID == 127 || $this->hodID == 134 || $this->hodID == 140 || $this->hodID == 147 || $this->hodID == 154 || $this->hodID == 161 || $this->hodID == 168 || $this->hodID == 173 || $this->hodID == 180) {
	
		$khp = rand(350,400);
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $khp;
		$this->users[$this->uids[$uid2]]['hpNow'] -= $khp;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $khp;
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} {u1} ����� ���� �� ����� {u2} � ������� ������ <b>&quot;����������� ����&quot; - '.$khp.'</b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		$this->add_log($mas);
		
		$pr_vars['priem_use'][0]['chance'] = 1010;
		$pr_vars['priem_use'][0]['name'] = '������ �����������';
		$pr_vars['priem_use'][0]['id'] = 204;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	
}

		$pr_vars['priem_regen']['hp'] = 500;
		$pr_vars['priem_regen']['chance'] = 10;
		$pr_vars['priem_regen']['name'] = '������� �������';


} 



if($this->users[$this->uids[$uid1]]['bot_id'] == 700) { 
///////��� �����
	$pr_use = 1;
	
if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 14 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 70 || $this->hodID == 75 || $this->hodID == 80 || $this->hodID == 85 || $this->hodID == 90 || $this->hodID == 95 || $this->hodID == 100) {
		$pr_vars['priem_use'][0]['chance'] = 1010 ;
		$pr_vars['priem_use'][0]['name'] = '���������� ������';
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
			  $mas['text'] = '{tm1} {u1} �������� � �������� <b>'.$logins.'</b>';
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
				$mas['text'] = '{tm1} {u1} ����� ���� �� ����� {u2} � ������� ������ <b>&quot;����������� ����&quot; <font color='.$color.'>- '.$khp.'</b></font> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
				$this->add_log($mas);
				
				$pr_vars['priem_use'][0]['chance'] = 1010 ;
				$pr_vars['priem_use'][0]['name'] = '������ �����������';
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
	    $mas['text'] = '{tm1} {u1} ����� ���� �� {u2} � ������� ������ <b>&quot;���������� ����&quot; - <font color=green>'.$hpOG.'</font></b> ['.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
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
		
		$mas['text'] = '{tm1} {u1} ����������� �������� � ������� ������ <b>&quot;������ �������&quot; <font color=green> + '.ceil(($hpNow/2)).'</font></b> ['.(ceil($this->stats[$this->uids[$uid1]]['hpNow'])).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].'] <br> {tm2} {u2} ������� �������� �� ������ <b>&quot;������ �������&quot; <font color=green> - '.$hpNow.' </font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		
		$this->add_log($mas);
		
	}
			$pr_vars['priem_regen']['hp'] = 500;
			$pr_vars['priem_regen']['chance'] = 10;
			$pr_vars['priem_regen']['name'] = '������� �������';
}



if($this->users[$this->uids[$uid1]]['bot_id'] == 701) { // ��������
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
			  $mas['text'] = '{tm1} {u1} ������� � �������� <b>'.$logins.'</b>';
			  $this->add_log($mas);
			  $u->addAction(time(), 'use::pes_gora::'.$this->info['id'], 0, $this->users[$this->uids[$uid1]]['id']);
		}
	}
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 702) { //������� ������
	$pr_use = 1;
	if($this->hodID == 4 || $this->hodID == 8 || $this->hodID == 13 || $this->hodID == 16 || $this->hodID == 20 || $this->hodID == 24 || $this->hodID == 28 || $this->hodID == 32 || $this->hodID == 36 || $this->hodID == 40 || $this->hodID == 44 || $this->hodID == 48 || $this->hodID == 52) {
		
	$pr_vars['priem_use'][0]['chance'] = 1010;
	$pr_vars['priem_use'][0]['name'] = '������������ ����';
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
		$mas['text'] = '{tm1} {u1} ����������� �������� �� ������ <b>&quot;�������� ������&quot; <font color=green> + '.ceil(($zhp/2)).'</font></b> ['.(ceil($this->stats[$this->uids[$uid1]]['hpNow'])).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].'] <br> {tm2} {u2} ������� �������� �� ������ <b>&quot;�������� ������&quot; <font color=green> - '.$zhp.' </font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		$this->add_log($mas);
		
}elseif($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 20 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50) {
		$khp = rand(350,400);
		$this->stats[$this->uids[$uid2]]['hpNow'] -= $khp;
		$this->users[$this->uids[$uid2]]['last_hp'] =- $khp;
		mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'",`last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} {u1} ����� ���� �� ����� {u2} � ������� ������ <b>&quot;����������� ����&quot; - '.$khp.'</b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		$this->add_log($mas);
	}
}


//������

if($this->users[$this->uids[$uid1]]['bot_id'] == 353) {
### ��������� ������ [9] - ������ 3 ����
/* (1200HP)
����: 50
��������: 15
��������: 15
������������: 50
���������: 0
��������: 0
1 ���� 2 ���� ������. ���������� ����: ��������, ��������� �����: �����.
���������� �����:
"��������� ������" - ���� ������ ����.
"��������" - ���� ������ �����, �� ��� �������.
"���� ��������" - ������ "���������� ������"
"���� � ������" .
 * */
	$pr_use = 1;
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 350 || $this->users[$this->uids[$uid1]]['bot_id'] == 351) {
### ��������� ������ [8] - ������ 1-3 ����
  $pr_vars['priem_team_f'][0]['chance'] = 85;
  $pr_vars['priem_team_f'][0]['name'] = '<font color=darkblue>��������� ������</font>';
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
	$pr_vars['priem_regen']['name'] = '���� � ������';
  
  
	$pr_use = 1;
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 158) {
### ���� ����� �������� [9] - ������ 3 ����

	// �������� ����� - ������ ������ ������
	$pr_vars['priem_use'][0]['chance'] = 20;
	$pr_vars['priem_use'][0]['name'] = '�������� �����';
	$pr_vars['priem_use'][0]['id'] = 240;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	// ������ �����.
	$pr_vars['priem_use'][1]['chance'] = 40;
	$pr_vars['priem_use'][1]['name'] = '������ �����';
	$pr_vars['priem_use'][1]['id'] = 47;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][2]['chance'] = 45;
	$pr_vars['priem_use'][2]['name'] = '������';
	$pr_vars['priem_use'][2]['id'] = 14;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][3]['chance'] = 50;
	$pr_vars['priem_use'][3]['name'] = '���������';
	$pr_vars['priem_use'][3]['id'] = 13;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_regen']['hp'] = rand(40,45);
	$pr_vars['priem_regen']['chance'] = 20;
	$pr_vars['priem_regen']['name'] = '���� � ������';


	$pr_use = 1;
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 152) {
### ������� ���� [10] - ������ 2 ����

	// ������� ����.
	$pr_vars['priem_use'][0]['chance'] = 20;
	$pr_vars['priem_use'][0]['name'] = '������� ����';
	$pr_vars['priem_use'][0]['id'] = 4;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	// �������� ������.
	$pr_vars['priem_use'][1]['chance'] = 20;
	$pr_vars['priem_use'][1]['name'] = '�������� ������';
	$pr_vars['priem_use'][1]['id'] = 7;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	// ���������.
	$pr_vars['priem_use'][2]['chance'] = 20;
	$pr_vars['priem_use'][2]['name'] = '���������';
	$pr_vars['priem_use'][2]['id'] = 13;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

	// ������.
	$pr_vars['priem_use'][3]['chance'] = 20;
	$pr_vars['priem_use'][3]['name'] = '������';
	$pr_vars['priem_use'][3]['id'] = 14;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

	// ������������, ����������� ���� � ���� ������ �������� ������ 30-��...
	if( (int)$u->lookStats($this->users[$this->uids[$uid2]]['stats'])['s2'] > 30) {
		$pr_vars['priem_use'][4]['chance'] = 22;
		$pr_vars['priem_use'][4]['name'] = '������������';
		$pr_vars['priem_use'][4]['id'] = 204;
		$pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];
	}
	//���������, ����������� ���� � ���� ������� �������� ������ 10-��...
	if( (int)$u->lookStats($this->users[$this->uids[$uid2]]['stats'])['s5'] > 10) {
		$pr_vars['priem_use'][4]['chance'] = 22;
		$pr_vars['priem_use'][4]['name'] = '���������';
		$pr_vars['priem_use'][4]['id'] = 189;
		$pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];
	}

	//��������� ����
if($this->hodID == 1) {
	if($this->stats[$this->uids[$uid2]]['s6'] <= 0) {
		$zaO = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = '.$this->users[$this->uids[$uid1]]['id'].' AND `name` LIKE "%��������� ����%" AND `delete` = 0 LIMIT 1'));
		if(!isset($zaO['id'])) {
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid1]]['id'].'","��������� ����","add_za=500","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","0","spell_godprotect10.gif","1","-1")');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u2} ����� ��� ��� ��������, ��� ����� <b>&quot;��������� ����&quot;</b>';
			$this->add_log($mas);
		}
	}elseif($this->stats[$this->uids[$uid2]]['s5'] > 35 && $this->stats[$this->uids[$uid2]]['s6'] > 15) {
		$zmO = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = '.$this->users[$this->uids[$uid1]]['id'].' AND `name` LIKE "%��������� �����%" AND `delete` = 0 LIMIT 1'));
		if(!isset($zmO['id'])) {
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid1]]['id'].'","��������� �����","add_zm=500","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","0","spell_godprotect.gif","1","-1")');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u2} ����� ��� ��� ��������, ��� ����� <b>&quot;��������� �����&quot;</b>';
			$this->add_log($mas);
		}
	}
}

//��������� ����
if($hp <= 33) {
	$vol = mysql_fetch_array(mysql_query('SELECT `id`,`hod` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `name` LIKE "%��������� ����%" AND `delete` = 0 LIMIT 1 '));
	if(!isset($vol['id'])) {
		mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid1]]['id'].'","��������� ����","from_bezdna","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","351","new_reg.gif","1","'.rand(8,10).'")');
	}elseif(isset($vol['id']) && $vol['hod'] < 2) {
		$cikl = mysql_query('SELECT `id`,`login`,`battle` FROM `users` WHERE `battle` = "'.$this->users[$this->uids[$uid1]]['battle'].'"');
		while($cl = mysql_fetch_array($cikl)) {
			$hpO = $this->stats[$this->uids[$cl['id']]]['hpNow'];
			$this->stats[$this->uids[$cl['id']]]['hpNow'] -= $hpO;
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$cl['id']]]['hpNow'].'" WHERE `id` = "'.$cl['id'].'" LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$cl['id']]]['sex'].'||t1='.$this->users[$this->uids[$cl['id']]]['team'].'||login1='.$this->users[$this->uids[$cl['id']]]['login'].'||s2='.$this->users[$this->uids[$cl['id']]]['sex'].'||t2='.$this->users[$this->uids[$cl['id']]]['team'].'||login2='.$this->users[$this->uids[$cl['id']]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} <a>������� ����</a> ����������� ��������� ���� �� <b>'.$cl['login'].' - <font color=green>'.(ceil($hpO)).'</b></font> ['.$this->stats[$this->uids[$cl['id']]]['hpNow'].'/'.$this->stats[$this->uids[$cl['id']]]['hpAll'].']';
			$this->add_log($mas);
		}
	}
}

	
	
	
	$pr_vars['hp'] = mysql_fetch_array(mysql_query('SELECT hp as `Now`, hpAll as `All` FROM `battle_users` WHERE `uid` = "'.$uid1.'" LIMIT 1'));
	$pr_vars['hp']['Ustalost'] = round(85 - ($pr_vars['hp']['Now'] / ($pr_vars['hp']['All']/100))) ;
	// ���������
	if( $pr_vars['hp']['Now'] != 0 AND $pr_vars['hp']['Now'] / ($pr_vars['hp']['All']/100) < 85  ) {
		if( $pr_vars['hp']['Ustalost'] > 0 ){
			if($pr_vars['hp']['Ustalost'] > 33){
				$pr_vars['hp']['Ustalost'] = 33;
			}
			$pr_vars['hp']['exist'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `delete` = "0" AND `id_eff` = "5" AND `uid` = "'.$uid1.'" LIMIT 1'));
			if($pr_vars['hp']['exist']) { // ���� ����������
				mysql_query('UPDATE `eff_users` SET `data` = "add_m10=-'.$pr_vars['hp']['Ustalost'].'0", `name` = "��������� -'.$pr_vars['hp']['Ustalost'].'%" WHERE `delete` = "0" AND `id_eff` = "5" AND `uid` = "'.$uid1.'" LIMIT 1');
			} else { // ���� �� ����������
				mysql_query('INSERT INTO `eff_users` (`id_eff`, `uid`, `img2`, `name`, `data`, `user_use`,`timeUse`, `delete`, `v1`, `v2`, `x`, `no_Ace`) VALUES (5, '.$uid1.', "eff_travma.gif", "��������� -'.$pr_vars['hp']['Ustalost'].'%", "add_m10=-'.$pr_vars['hp']['Ustalost'].'0", "'.$uid1.'","77", "0", "priem", "292", "1", "1")');
			}
		}
	}
	unset($pr_vars['hp']);
	$pr_use = 1;
}



if($this->users[$this->uids[$uid1]]['bot_id'] == 254) {
###�������
  $pr_use = 1; 
  
  if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 70 || $this->hodID == 75) {
	  $pr_vars['priem_regen']['hp'] = 75;
	  $pr_vars['priem_regen']['chance'] = 1010;
	  $pr_vars['priem_regen']['name'] = '�����������';
  }
  
  $pr_vars['priem_use'][0]['chance'] = 55;
  $pr_vars['priem_use'][0]['name'] = '������� ����';
  $pr_vars['priem_use'][0]['id'] = 11;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
 
  
  $pr_vars['priem_use'][1]['chance'] = 60;
  $pr_vars['priem_use'][1]['name'] = '������';
  $pr_vars['priem_use'][1]['id'] = 14;
  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][2]['chance'] = 65;
  $pr_vars['priem_use'][2]['name'] = '���������� �����';
  $pr_vars['priem_use'][2]['id'] = 219;
  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
  
}

if( $this->users[$this->uids[$uid1]]['bot_id'] == 251) {
	$pr_use = 1;
	
	$pr_vars['priem_regen']['hp'] = 500;
	$pr_vars['priem_regen']['chance'] = 15;
	$pr_vars['priem_regen']['name'] = '������� �������';
	
	$pr_vars['priem_use'][0]['chance'] = 55;
	$pr_vars['priem_use'][0]['name'] = '������ ��';
	$pr_vars['priem_use'][0]['id'] = 352;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	
	$pr_vars['priem_use'][1]['chance'] = 20;
    $pr_vars['priem_use'][1]['name'] = '���������� ����';
    $pr_vars['priem_use'][1]['id'] = 235;
    $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][2]['chance'] = 50;
	$pr_vars['priem_use'][2]['name'] = '������';
	$pr_vars['priem_use'][2]['id'] = 14;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][3]['chance'] = 45;
	$pr_vars['priem_use'][3]['name'] = '����� ������';
	$pr_vars['priem_use'][3]['id'] = 48;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
}

if( $this->users[$this->uids[$uid1]]['bot_id'] == 281) {
	$pr_use = 1;
	
	$pr_vars['priem_use'][0]['chance'] = 35;
	$pr_vars['priem_use'][0]['name'] = '��������� ��������� ��������';
	$pr_vars['priem_use'][0]['id'] = 353;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
}

if( $this->users[$this->uids[$uid1]]['bot_id'] == 276 || $this->users[$this->uids[$uid1]]['bot_id'] == 278) {
	$pr_use = 1;
	
	$pr_vars['priem_use'][0]['chance'] = 55;
	$pr_vars['priem_use'][0]['name'] = '������ �������';
	$pr_vars['priem_use'][0]['id'] = 355;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	
	$pr_vars['priem_use'][1]['chance'] = 50;
	$pr_vars['priem_use'][1]['name'] = '�������� ����';
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
		 $mas['text'] = '{tm1} {u2} ������� ����������� �� ������ <b>&quot;�������� ����&quot; <font color=green> - '.$yrb.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		 $this->add_log($mas);
	}
}

if( $this->users[$this->uids[$uid1]]['bot_id'] == 285) {
	$pr_use = 1;
	
	$pr_vars['priem_use'][0]['chance'] = 40;
	$pr_vars['priem_use'][0]['name'] = '���� ������';
	$pr_vars['priem_use'][0]['id'] = 138;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][1]['chance'] = 50;
	$pr_vars['priem_use'][1]['name'] = '������';
	$pr_vars['priem_use'][1]['id'] = 14;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][2]['chance'] = 50;
	$pr_vars['priem_use'][2]['name'] = '���������';
	$pr_vars['priem_use'][2]['id'] = 13;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][3]['chance'] = 50;
	$pr_vars['priem_use'][3]['name'] = '���������� ������';
	$pr_vars['priem_use'][3]['id'] = 140;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
}
//����������
if( $this->users[$this->uids[$uid1]]['bot_id'] == 288) {
	$pr_use =1;
	if($hp <= 100 && $hp >= 80) {
		$pr_vars['priem_use'][0]['chance'] = 100;
		$pr_vars['priem_use'][0]['name'] = '���������������';
		$pr_vars['priem_use'][0]['id'] = 359;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	}elseif($hp <= 80 && $hp >= 70) {
		$pr_vars['priem_use'][1]['chance'] = 100;
		$pr_vars['priem_use'][1]['name'] = '��������������';
		$pr_vars['priem_use'][1]['id'] = 358;
		$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
		mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `v2` = 347');
	}elseif($hp <= 70 && $hp >= 50) {
		$pr_vars['priem_use'][2]['chance'] = 100;
		$pr_vars['priem_use'][2]['name'] = '���������';
		$pr_vars['priem_use'][2]['id'] = 357;
		$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
		mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `v2` = 348');
	}elseif($hp <= 50) {
		$pr_vars['priem_use'][3]['chance'] = 100;
		$pr_vars['priem_use'][3]['name'] = '����������';
		$pr_vars['priem_use'][3]['id'] = 356;
		$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
		mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid1]]['id'].'" AND `v2` = 349');
	}
	
	 $pr_vars['priem_use'][4]['chance'] = 30;
	 $pr_vars['priem_use'][4]['name'] = '������';
	 $pr_vars['priem_use'][4]['id'] = 14;
	 $pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][5]['chance'] = 30;
	 $pr_vars['priem_use'][5]['name'] = '���������';
	 $pr_vars['priem_use'][5]['id'] = 13;
	 $pr_vars['priem_use'][5]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][6]['chance'] = 25;
	 $pr_vars['priem_use'][6]['name'] = '������ ������';
	 $pr_vars['priem_use'][6]['id'] = 45;
	 $pr_vars['priem_use'][6]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][7]['chance'] = 35;
	 $pr_vars['priem_use'][7]['name'] = '������ �������';
	 $pr_vars['priem_use'][7]['id'] = 49;
	 $pr_vars['priem_use'][7]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][8]['chance'] = 20;
	 $pr_vars['priem_use'][8]['name'] = '������������';
	 $pr_vars['priem_use'][8]['id'] = 204;
	 $pr_vars['priem_use'][8]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][9]['chance'] = 25;
	 $pr_vars['priem_use'][9]['name'] = '�������������';
	 $pr_vars['priem_use'][9]['id'] = 139;
	 $pr_vars['priem_use'][9]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][10]['chance'] = 45;
	 $pr_vars['priem_use'][10]['name'] = '������� ����';
	 $pr_vars['priem_use'][10]['id'] = 11;
	 $pr_vars['priem_use'][10]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][11]['chance'] = 20;
	 $pr_vars['priem_use'][11]['name'] = '�������� �����';
	 $pr_vars['priem_use'][11]['id'] = 240;
	 $pr_vars['priem_use'][11]['on'] = $this->users[$this->uids[$uid1]];
	 
	 
	
}
//�������
if( $this->users[$this->uids[$uid1]]['bot_id'] == 266) {
	$pr_use = 1;
	
	if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 70 || $this->hodID == 75) {
		
		$pr_vars['priem_regen']['hp'] = 300;
		$pr_vars['priem_regen']['chance'] = 1010;
		$pr_vars['priem_regen']['name'] = '�������';
		
	}
	
	 $pr_vars['priem_use'][0]['chance'] = 30;
	 $pr_vars['priem_use'][0]['name'] = '������';
	 $pr_vars['priem_use'][0]['id'] = 14;
	 $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][1]['chance'] = 25;
	 $pr_vars['priem_use'][1]['name'] = '������������';
	 $pr_vars['priem_use'][1]['id'] = 204;
	 $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][2]['chance'] = 20;
	 $pr_vars['priem_use'][2]['name'] = '�������� ������';
	 $pr_vars['priem_use'][2]['id'] = 7;
	 $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][3]['chance'] = 40;
	 $pr_vars['priem_use'][3]['name'] = '�������� ����';
	 $pr_vars['priem_use'][3]['id'] = 213;
	 $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
	
	if(rand(0,100) <= 2) {
		$tp = mysql_fetch_array(mysql_query('SELECT `id`,`x` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `name` LIKE "%������ ������%" AND `delete` = 0 LIMIT 1'));
		$name = '<b>������ ������</b>';
		if(!isset($tp['id'])) {
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid2]]['id'].'","'.$name.'","add_za=-125|add_zm=-125","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","0","wis_gray_magicdestroy.gif","1","-1")');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} ����������� ����� &quot;'.$name.'&quot; �� ��������� {u2}';
			$this->add_log($mas);
		}
	}
}
//������ �����
if( $this->users[$this->uids[$uid1]]['bot_id'] == 273) {
	$pr_use = 1;
	
	if($this->hodID == 5 || $this->hodID == 10 || $this->hodID == 15 || $this->hodID == 25 || $this->hodID == 30 || $this->hodID == 35 || $this->hodID == 40 || $this->hodID == 45 || $this->hodID == 50 || $this->hodID == 55 || $this->hodID == 60 || $this->hodID == 65 || $this->hodID == 70 || $this->hodID == 75) {
		$pr_vars['priem_regen']['hp'] = 75;
		$pr_vars['priem_regen']['chance'] = 45;
		$pr_vars['priem_regen']['name'] = '�����������';
	}
	
	$pr_vars['priem_use'][1]['chance'] = 50;
	$pr_vars['priem_use'][1]['name'] = '���� � ������';
	$pr_vars['priem_use'][1]['id'] = 6;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	
	 $pr_vars['priem_use'][2]['chance'] = 30;
	 $pr_vars['priem_use'][2]['name'] = '������';
	 $pr_vars['priem_use'][2]['id'] = 14;
	 $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
	 
	 $pr_vars['priem_use'][3]['chance'] = 25;
     $pr_vars['priem_use'][3]['name'] = '������� ����';
     $pr_vars['priem_use'][3]['id'] = 11;
     $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
	
	 if(rand(0,100) <= 20) {
		 $hp_damage = rand(100,800);
		 $this->stats[$this->uids[$uid2]]['hpNow'] -= $hp_damage;
		 $this->users[$this->uids[$uid2]]['last_hp'] =- $hp_damage;
		 mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'", `last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid2]]['id'].'" LIMIT 1');
		 $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		 $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		 $mas['text'] = '{tm1} {u2} ������� ����������� �� ������ <b>&quot;��������� ������&quot; - <font color=green>'.$hp_damage.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
	     $this->add_log($mas);
	 }
	
	if(rand(0,100) <= 35) {
		$tp = mysql_fetch_array(mysql_query('SELECT `id`,`x` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `name` LIKE "%������� �����%" AND `delete` = 0 LIMIT 1'));
		$name = '<b>������� ����� x'.(1+$tp['x']).'</b>';
		if(!isset($tp['id'])) {
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid2]]['id'].'","'.$name.'","add_za=-100","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","0","wis_earth_heal08.gif","1","-1")');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} ����������� ����� &quot;'.$name.'&quot; �� ��������� {u2}';
			$this->add_log($mas);
		}elseif($tp['x'] < 5) {
			mysql_query('UPDATE `eff_users` SET `name` = "'.$name.'", `data` = "add_za=-'.(100+$tp['x']*100).' ", `x` = `x` + 1 WHERE `id` = "'.$tp['id'].'" LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} ����������� ����� &quot;'.$name.'&quot; �� ��������� {u2}';
			$this->add_log($mas);
		}
	}
}
//������������
if($this->users[$this->uids[$uid1]]['bot_id'] == 275) {
	$pr_use = 1;
					$now = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `name` LIKE "%������ ����%" AND `delete` = 0 LIMIT 1'));
					if(isset($now['id'])) {
						$goHp = rand(37,99);
						 $pr_vars['priem_regen']['hp'] = $goHp;
						 $pr_vars['priem_regen']['chance'] = 100;
						 $pr_vars['priem_regen']['name'] = '������ ����';
						 $this->stats[$this->uids[$uid2]]['hpNow'] -= $pr_vars['priem_regen']['hp'];
						 $this->users[$this->uids[$uid2]]['last_hp'] =- $pr_vars['priem_regen']['hp'];
						 mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'", `last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->users[$this->uids[$uid2]]['id'].'" LIMIT 1');
					}
					  $pr_vars['priem_use'][0]['chance'] = 40;
					  $pr_vars['priem_use'][0]['name'] = '������ ����';
					  $pr_vars['priem_use'][0]['id'] = 362;
					  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
					  
					  $pr_vars['priem_use'][1]['chance'] = 20;
					  $pr_vars['priem_use'][1]['name'] = '��������� ����';
					  $pr_vars['priem_use'][1]['id'] = 360;
					  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid2]];
					  
					  $pr_vars['priem_use'][2]['chance'] = 14;
					  $pr_vars['priem_use'][2]['name'] = '���������';
					  $pr_vars['priem_use'][2]['id'] = 13;
					  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

					  $pr_vars['priem_use'][3]['chance'] = 15;
					  $pr_vars['priem_use'][3]['name'] = '������';
					  $pr_vars['priem_use'][3]['id'] = 14;
					  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
					  
			  
}
  //��������� �������
if($this->users[$this->uids[$uid1]]['bot_id'] == 279) {
	/*������� �������*/
			$clon = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `login` LIKE "%'.$this->users[$this->uids[$uid2]]['login'].' (����%" AND `battle` = "'.$this->users[$this->uids[$uid2]]['battle'].'" LIMIT 1'));
			//��������� ����
			if(!isset($clon['id']) && rand(0,100) <= 20) {
			$clone = array(
				'id' => $this->users[$this->uids[$uid2]]['id'],
				'login' => $this->users[$this->uids[$uid2]]['login'].' (����)',
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
				$mas['text'] = '{tm1} {u1} ����������� ����� <b>&quot;������� �������&quot;</b> � ���������� ��������� <b>'.$this->users[$this->uids[$uid2]]['login'].'</b>';
				$this->add_log($mas);
				unset($clone,$bot);
		}
		/*END*/
		
		
		#������� �����
		if($hp <= 80 && rand(0, 100) <= 30) {
			$ghp = round($this->stats[$this->uids[$uid2]]['hpNow']/100*rand(5,10));
			$this->stats[$this->uids[$uid1]]['hpNow'] += $ghp;
			mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid1]]['hpNow'].' WHERE `id` = '.$this->stats[$this->uids[$uid1]]['id'].' LIMIT 1'); //��������� �� �����
			$this->stats[$this->uids[$uid2]]['hpNow'] -= $ghp;
			$this->users[$this->uids[$uid2]]['last_hp'] =- $ghp;
			mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].', `last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = '.$this->stats[$this->uids[$uid2]]['id'].' LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} �������� ����� <b><font color=bagr>&quot;������� �����&quot;</b></font> � ����������� ���� �������� <b><font color=green> + '.$ghp.' ['.ceil($this->stats[$this->uids[$uid1]]['hpNow']).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']</b></font>';
			$this->add_log($mas);
		}
			  $pr_use = 1;
			  
			  $pr_vars['priem_team_f'][0]['chance'] = 30;
			  $pr_vars['priem_team_f'][0]['name'] = '<font color=darkblue>����� ����</font>';
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
			  
				 //������� ����
				 if($hp <= 35) {
					$now = mysql_fetch_array(mysql_query('SELECT `id`,`hod`,`data`,`x` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `v2` = 361 AND `delete` = 0 LIMIT 1'));
					if(!isset($now['id'])) {
						 $pr_vars['priem_regen']['hp'] = floor($this->stats[$this->uids[$uid2]]['hpNow']);
						 $pr_vars['priem_regen']['chance'] = 100;
						 $pr_vars['priem_regen']['name'] = '������� ����';
						 $this->stats[$this->uids[$uid2]]['hpNow'] -= $pr_vars['priem_regen']['hp'];
						 $this->users[$this->uids[$uid2]]['last_hp'] =- $pr_vars['priem_regen']['hp'];
						 
						 echo $now['x'];
						 //���� �� == 0
						 if( $this->stats[$this->uids[$uid2]]['hpNow'] < 1 ) {
							 $this->stats[$this->uids[$uid2]]['hpNow'] = 100;
						 }
						 mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$uid2]]['hpNow'].'", `last_hp` = "'.$this->users[$this->uids[$uid2]]['last_hp'].'" WHERE `id` = "'.$this->users[$this->uids[$uid2]]['id'].'" LIMIT 1');
						 
					}
						if($now['hod'] < 2) {
							mysql_query('UPDATE `eff_users` SET `data` = "add_m10=-'.(70+($now['x']*70)).'|add_m11=-'.(70+($now['x']*70)).'", `hod` = "20", `x` = `x` +1 WHERE `id` = "'.$now['id'].'" LIMIT 1');
						 }
					  
					  $pr_vars['priem_use'][0]['chance'] = 100;
					  $pr_vars['priem_use'][0]['name'] = '���������� ����';
					  $pr_vars['priem_use'][0]['id'] = 361;
					  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
					  
				 }else{
					  $pr_vars['priem_use'][0]['chance'] = 35;
					  $pr_vars['priem_use'][0]['name'] = '���������';
					  $pr_vars['priem_use'][0]['id'] = 13;
					  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

					  $pr_vars['priem_use'][1]['chance'] = 35;
					  $pr_vars['priem_use'][1]['name'] = '������';
					  $pr_vars['priem_use'][1]['id'] = 14;
					  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
					  
					  $pr_vars['priem_use'][2]['chance'] = 30;
					  $pr_vars['priem_use'][2]['name'] = '���������� ����';
					  $pr_vars['priem_use'][2]['id'] = 235;
					  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
				 }
				 
			  
	}
	
  
  if($this->users[$this->uids[$uid1]]['bot_id'] == 284) {
###����
//����������(�5)
if(rand(0,100) <= 10) {
		$tp = mysql_fetch_array(mysql_query('SELECT `id`,`x` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `name` LIKE "%����������%" AND `delete` = 0 LIMIT 1'));
		$name = '<b>���������� x'.(1+$tp['x']).'</b>';
		if(!isset($tp['id'])) {
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid2]]['id'].'","'.$name.'","add_m10=-33|add_m8=-20|add_m6=-20|add_m2=-250|add_m4=-400|add_m5=-500","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","0","hp_natisk.gif","1","-1")');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} ����������� ����� &quot;'.$name.'&quot; �� ��������� {u2}';
			$this->add_log($mas);
		}elseif($tp['x'] < 5) {
			mysql_query('UPDATE `eff_users` SET `name` = "'.$name.'", `data` = "add_m10=-'.(33+$tp['x']*33).'|add_m8=-'.(20+$tp['x']*20).'|add_m6=-'.(20+$tp['x']*20).'|add_m2=-'.(250+$tp['x']*250).'|add_m4=-'.(400+$tp['x']*400).'|add_m5=-'.(250+$tp['x']*250).' ", `x` = `x` + 1 WHERE `id` = "'.$tp['id'].'" LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} ����������� ����� &quot;'.$name.'&quot; �� ��������� {u2}';
			$this->add_log($mas);
		}
	}
	//������ �������(x5)
  	if(rand(0,100) <= 15) {
		$tp1 = mysql_fetch_array(mysql_query('SELECT `id`,`x` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `name` LIKE "%������ �������%" AND `delete` = 0 LIMIT 1'));
		$name = '<b>������ ������� x'.(1+$tp1['x']).'</b>';
		if(!isset($tp1['id'])) {
			mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid2]]['id'].'","'.$name.'","add_hpRound=90|add_za=-50|from_kat","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","0","wis_water_cloud08.gif","1","-1")');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} ����������� ����� &quot;'.$name.'&quot; �� ��������� {u2}';
			$this->add_log($mas);
		}elseif($tp1['x'] < 5) {
			mysql_query('UPDATE `eff_users` SET `data` = "add_hpRound='.(100 - ($tp1['x']*10) ).' ", `x` = `x` + 1 WHERE `id` = "'.$tp1['id'].'" LIMIT 1');
			$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
			$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas['text'] = '{tm1} {u1} ����������� ����� &quot;'.$name.'&quot; �� ��������� {u2}';
			$this->add_log($mas);
		}
	}
	
	//�������
	if($hp <= 1) {
		$this->stats[$this->uids[$uid1]]['hpNow'] += $this->stats[$this->uids[$uid2]]['hpNow'];
		//����
		mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].' WHERE `id` = '.$this->stats[$this->uids[$uid1]]['id'].' LIMIT 1');
		$vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} {u1} ����������� ��������, � ������� ������ <b>&quot;�������&quot;<font color=green> + '.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'&nbsp;</b></font> ['.$this->stats[$this->uids[$uid1]]['hpNow'].'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
		$this->add_log($mas);
	}
	
  $pr_use = 1; 
  
  
  $pr_vars['priem_use'][1]['chance'] = 15;
  $pr_vars['priem_use'][1]['name'] = '������� ����';
  $pr_vars['priem_use'][1]['id'] = 11;
  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][2]['chance'] = 30;
  $pr_vars['priem_use'][2]['name'] = '����������';
  $pr_vars['priem_use'][2]['id'] = 292;
  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid2]];
  

  $pr_vars['priem_use'][3]['chance'] = 35;
  $pr_vars['priem_use'][3]['name'] = '������';
  $pr_vars['priem_use'][3]['id'] = 14;
  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
  
  
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 134) {
###��������� ���� [10]
###To Do : ���������� ����, ���� ����
  $pr_use = 1;
	  $pr_vars['priem_use'][0]['chance'] = 35;
	  $pr_vars['priem_use'][0]['name'] = '����';
	  $pr_vars['priem_use'][0]['id'] = 141;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
  
  
  if($this->hodID == 1) {
	  $this->stats[$this->uids[$uid2]]['hpNow'] -= 100;
	  $this->users[$this->uids[$uid2]]['last_hp'] =- 100;
	  mysql_query('UPDATE `stats` SET `hpNow` = '.$this->stats[$this->uids[$uid2]]['hpNow'].', `last_hp` = '.$this->users[$this->uids[$uid2]]['last_hp'].' WHERE `id` = '.$this->stats[$this->uids[$uid2]]['id'].' LIMIT 1');
	    $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		$mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		$mas['text'] = '{tm1} {u1}, ��������� ����� <b>&quot;���������� ����&quot;</b> �� {u2} <b> - 100 </b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']<br>';
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
		$mas['text'] = '{tm1} ��������� ����, ������� ����� <b>&quot���� ����&quot</b> �� <b>'.$pl['login'].' <font color=green> - '.$hpR.'</font></b> ['.(ceil($this->stats[$this->uids[$pl['id']]]['hpNow'])).'/'.(ceil($this->stats[$this->uids[$pl['id']]]['hpAll'])).']<br>';
		$this->add_log($mas);  
  }
}
  
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 376) {
###������� ��������� ������ [9]
  $pr_use = 1; 

  $pr_vars['priem_regen']['hp'] = 18;
  $pr_vars['priem_regen']['chance'] = 7;
  $pr_vars['priem_regen']['name'] = '������� ���';

  $pr_vars['priem_use'][0]['chance'] = 10;
  $pr_vars['priem_use'][0]['name'] = '���������� ���';
  $pr_vars['priem_use'][0]['id'] = 45;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][1]['chance'] = 8;
  $pr_vars['priem_use'][1]['name'] = '���������';
  $pr_vars['priem_use'][1]['id'] = 216;
  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][2]['chance'] = 13;
  $pr_vars['priem_use'][2]['name'] = '�������� ������';
  $pr_vars['priem_use'][2]['id'] = 7;
  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][3]['chance'] = 6;
  $pr_vars['priem_use'][3]['name'] = '������� ����';
  $pr_vars['priem_use'][3]['id'] = 11;
  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][4]['chance'] = 15;
  $pr_vars['priem_use'][4]['name'] = '���������';
  $pr_vars['priem_use'][4]['id'] = 13;
  $pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];

  $pr_vars['priem_use'][5]['chance'] = 15;
  $pr_vars['priem_use'][5]['name'] = '������';
  $pr_vars['priem_use'][5]['id'] = 14;
  $pr_vars['priem_use'][5]['on'] = $this->users[$this->uids[$uid1]];
  
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 126) {
###���� ����������� [8]
  $pr_use = 1; 
  
  $pr_vars['priem_use'][0]['chance'] = 35;
  $pr_vars['priem_use'][0]['name'] = '���� �������';
  $pr_vars['priem_use'][0]['id'] = 216;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][1]['chance'] = 20;
  $pr_vars['priem_use'][1]['name'] = '������ �����';
  $pr_vars['priem_use'][1]['id'] = 47;
  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][2]['chance'] = 40;
  $pr_vars['priem_use'][2]['name'] = '�������� ������';
  $pr_vars['priem_use'][2]['id'] = 7;
  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
  
  $pr_vars['priem_use'][3]['chance'] = 50;
  $pr_vars['priem_use'][3]['name'] = '���������';
  $pr_vars['priem_use'][3]['id'] = 13;
  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

  $pr_vars['priem_use'][4]['chance'] = 48;
  $pr_vars['priem_use'][4]['name'] = '������';
  $pr_vars['priem_use'][4]['id'] = 14;
  $pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 372) {
	//��������� ������
	$pr_use = 1;
	
	$pr_vars['priem_use'][0]['chance'] = 15;
	$pr_vars['priem_use'][0]['name'] = '������� ����';
	$pr_vars['priem_use'][0]['id'] = 4;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][1]['chance'] = 10;
	$pr_vars['priem_use'][1]['name'] = '���������� ����';
	$pr_vars['priem_use'][1]['id'] = 235;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 123) {
###������� ���� [8]
###To Do: ����������� ����
  $pr_use = 1;

  $pr_vars['priem_regen']['hp'] = 600;
  $pr_vars['priem_regen']['chance'] = 20;
  $pr_vars['priem_regen']['name'] = '�������';

  $pr_vars['priem_use'][0]['chance'] = 40;
  $pr_vars['priem_use'][0]['name'] = '�������� ������';
  $pr_vars['priem_use'][0]['id'] = 7;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

  $pr_vars['priem_use'][1]['chance'] = 65;
  $pr_vars['priem_use'][1]['name'] = '���������';
  $pr_vars['priem_use'][1]['id'] = 13;
  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

  $pr_vars['priem_use'][2]['chance'] = 60;
  $pr_vars['priem_use'][2]['name'] = '������';
  $pr_vars['priem_use'][2]['id'] = 14;
  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 124) {
###��������� ���� [9]
  $pr_use = 1;
  
	$pr_vars['priem_use'][0]['chance'] = 4;
	$pr_vars['priem_use'][0]['name'] = '������ �������';
	$pr_vars['priem_use'][0]['id'] = 49;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][1]['chance'] = 6;
	$pr_vars['priem_use'][1]['name'] = '���� ������';
	$pr_vars['priem_use'][1]['id'] = 219;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	
	
	$pr_vars['priem_use'][2]['chance'] = 8;
	$pr_vars['priem_use'][2]['name'] = '������� ����';
	$pr_vars['priem_use'][2]['id'] = 4;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][3]['chance'] = 10;
	$pr_vars['priem_use'][3]['name'] = '�������� ������';
	$pr_vars['priem_use'][3]['id'] = 7;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][4]['chance'] = 50;
	$pr_vars['priem_use'][4]['name'] = '������ �����';
	$pr_vars['priem_use'][4]['id'] = 47;
	$pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][5]['chance'] = 51;
	$pr_vars['priem_use'][5]['name'] = '���������';
	$pr_vars['priem_use'][5]['id'] = 13;
	$pr_vars['priem_use'][5]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_use'][6]['chance'] = 52;
	$pr_vars['priem_use'][6]['name'] = '������';
	$pr_vars['priem_use'][6]['id'] = 14;
	$pr_vars['priem_use'][6]['on'] = $this->users[$this->uids[$uid1]];
	
	$pr_vars['priem_regen']['hp'] = 45;
	$pr_vars['priem_regen']['chance'] = 10;
	$pr_vars['priem_regen']['name'] = '���� � ������';

}

if($this->users[$this->uids[$uid1]]['bot_id'] == 125) {
###����� ������� [9]
	$pr_use = 1;

	$pr_vars['priem_use'][0]['chance'] = 25;
	$pr_vars['priem_use'][0]['name'] = '���� ������ ������';
	$pr_vars['priem_use'][0]['id'] = 216;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][1]['chance'] = 25;
	$pr_vars['priem_use'][1]['name'] = '������� ����';
	$pr_vars['priem_use'][1]['id'] = 11;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][2]['chance'] = 25;
	$pr_vars['priem_use'][2]['name'] = '�������� ����';
	$pr_vars['priem_use'][2]['id'] = 213;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][3]['chance'] = 25;
	$pr_vars['priem_use'][3]['name'] = '���������';
	$pr_vars['priem_use'][3]['id'] = 13;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][4]['chance'] = 25;
	$pr_vars['priem_use'][4]['name'] = '������';
	$pr_vars['priem_use'][4]['id'] = 14;
	$pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_regen']['hp'] = 45;
	$pr_vars['priem_regen']['chance'] = 15;
	$pr_vars['priem_regen']['name'] = '���� � ������';
}

  if($this->users[$this->uids[$uid1]]['bot_id'] == 142) {
###������ ���� [11]
###To Do : �������� ���, ���������� �����, ������� �����, ������, �������� �����, ���������������, ������� ����, ���������� ����
  
  //���������������
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
			$txt = '������� �� ���������, � ������� �������� <b><font color=brown>&quot;���������������&quot;</b></font> �� {u2} - <b>'.$grit.'</b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			$txt2 = '<br>{tm1} {u1} ���� � ����� � ����� ��������� �������� �������� <b><font color=brown>&quot;���������������&quot;</b></font> �� {u1} - <b>'.$grit2.'</b> ['.$this->stats[$this->uids[$uid1]]['hpNow'].'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']<br>';
		}elseif($t == 2) {
			$txt = ' � ������ ��������, ������ ��������� �� ��, �������� <b><font color=brown>&quot;���������������&quot;</b></font> �� {u2} - <b>'.$grit.'</b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
			$txt2 = '<br>{tm1} {u1} ������� ������������ ���� �������� �� �������� � ���������� <b><font color=brown>&quot;���������������&quot;</b></font> �� {u1} - <b>'.$grit2.'</b> ['.$this->stats[$this->uids[$uid1]]['hpNow'].'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
		}elseif($t == 3) {
			$txt = '���� � ����� � ����� ��������� �������� �������� <b><font color=brown>&quot;���������������&quot;</b></font> �� {u2} - <b>'.$grit.'</b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']<br>';
			$txt2 = '<br>{tm1} {u1} ������� �� ���������, � ������� �������� <b><font color=brown>&quot;���������������&quot;</b></font> �� {u1} - <b>'.$grit2.'</b> ['.$this->stats[$this->uids[$uid1]]['hpNow'].'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
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
		if($trand == 1) $txt = ', ������� �����, ����� �������� {u2} ��������� <b><font color=#008080>&quot;������ [11]&quot; - '.$y.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		elseif($trand == 2) $txt = ', ��������� ������ ���� ��������� ���, ������� �������� <b><font color=#008080>&quot;������ [11]&quot; �� {u2} - '.$y.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		elseif($trand == 3) $txt = ', �����������, ��� ������ ����� �������� ����, �������� �������� <b><font color=#008080>&quot;������ [11]&quot; �� {u2} - '.$y.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		elseif($trand == 4) $txt = ', � ������ ��������, ������ ��������� �� ��, �������� <b><font color=#008080>&quot;������ [11]&quot; �� {u2} - '.$y.'</font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
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
			$mas['text'] = '{tm1} {u1} �������� ����� <b>&quot�������� �����&quot;</b> � ������ ���� �����';
			$this->add_log($mas);
			$u->addAction(time(), 'form_grit',0, $this->users[$this->uids[$uid1]]['id']);
		}
	}
	//
		  $pr_use = 1;
		  
		  $pr_vars['priem_team_f'][0]['chance'] = 35;
		  $pr_vars['priem_team_f'][0]['name'] = '������� ����';
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
  
	//����� �����
	if($this->users[$this->uids[$uid1]]['bot_id'] == 416) {
		$pr_use = 1;
		#1#
		$pr_vars['priem_use'][0]['chance'] = 50;
		$pr_vars['priem_use'][0]['name'] = '������ ���';
		$pr_vars['priem_use'][0]['id'] = 291;
		$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
		#1#
	}
  
###Start (����� �����)###

if($this->users[$this->uids[$uid1]]['bot_id'] == 118 || $this->users[$this->uids[$uid1]]['bot_id'] == 119) {
###��������� ������ [8] / ��������� ������ [9]
	$pr_use = 1;
  
	$pr_vars['priem_use'][0]['chance'] = 30;
	$pr_vars['priem_use'][0]['name'] = '������� ����';
	$pr_vars['priem_use'][0]['id'] = 4;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
  
	//����������
	$pr_vars['priem_use'][0]['chance'] = 15;
	$pr_vars['priem_use'][0]['name'] = '���������� ����';
	$pr_vars['priem_use'][0]['id'] = 236;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
  
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 50 || $this->users[$this->uids[$uid1]]['bot_id'] == 53) {
	//���� ��� ������� ����
	//priem team x type hp hp_dmg
	  $pr_use = 1;
	  
	  //������� ����
	  $pr_vars['priem_team_f'][] = array(
		  'chance' => 25,
		  'name' => '������� ����',
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
	  
	  //����������
	  $pr_vars['priem_use'][] = array(
		  'chance' => 25,
		  'name' => '����������',
		  'id' => 8,
		  'on' => $this->users[$this->uids[$uid1]],
		  'no_chat' => true
	  );
	  
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 54) {
	//��������������� ���
	  $pr_use = 1;
	  //�������� ����
	  $pr_vars['priem_use'][0]['chance'] = 10;
	  $pr_vars['priem_use'][0]['name'] = '�������� ����';
	  $pr_vars['priem_use'][0]['id'] = 1;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //������ ����
	  $pr_vars['priem_use'][1]['chance'] = 10;
	  $pr_vars['priem_use'][1]['name'] = '������ ����';
	  $pr_vars['priem_use'][1]['id'] = 2;
	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 57) {
	//��������� �����
	  $pr_use = 1;
	  //������� ����
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = '������� ����';
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
	  //������ ����
	  $pr_vars['priem_use'][0]['chance'] = 10;
	  $pr_vars['priem_use'][0]['name'] = '������ ����';
	  $pr_vars['priem_use'][0]['id'] = 2;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 58) {
	//��������� ��������
	  $pr_use = 1;
	  //������� ����
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = '������ ����';
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
	  
	  //������ ����
	  $pr_vars['priem_use'][0]['chance'] = 10;
	  $pr_vars['priem_use'][0]['name'] = '������ ����';
	  $pr_vars['priem_use'][0]['id'] = 2;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //��������
	  $pr_vars['priem_regen']['hp'] = 8;
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = '��������';
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 56) {
	//��������� ���
	  $pr_use = 1;
	  //������� ����
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = '������� ����';
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
	  
	  //�����������
	  $pr_vars['priem_regen']['hp'] = rand(8,12);
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = '�����������';
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 55) {
	//������ ��������
	  $pr_use = 1;
	  //������� ����
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = '������� ����';
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
	  //��������� �������
	  $pr_vars['priem_team_f'][1]['chance'] = 10;
	  $pr_vars['priem_team_f'][1]['name'] = '��������� �������';
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
	  //�����������
	  $pr_vars['priem_regen']['hp'] = rand(8,12);
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = '�����������';
	  //���������
	  $pr_vars['priem_use'][0]['chance'] = 50;
	  $pr_vars['priem_use'][0]['name'] = '���������';
	  $pr_vars['priem_use'][0]['id'] = 293;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 52) {
	//������
	  $pr_use = 1;
	  //������ ����
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = '������ ����';
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
	  //�����������
	  $pr_vars['priem_regen']['hp'] = rand(8,12);
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = '�����������';
	  //�������� ����
	  $pr_vars['priem_use'][0]['chance'] = 10;
	  $pr_vars['priem_use'][0]['name'] = '�������� ����';
	  $pr_vars['priem_use'][0]['id'] = 1;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //������ ����
	  $pr_vars['priem_use'][1]['chance'] = 10;
	  $pr_vars['priem_use'][1]['name'] = '������ ����';
	  $pr_vars['priem_use'][1]['id'] = 2;
	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
	  //���������
	  if( rand(0,100) < 10 ) {
		  //��������� ����
		  $pr_vars['priem_team_f'][1]['chance'] = 100;
		  $pr_vars['priem_team_f'][1]['name'] = '��������� ����';
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
		  $pr_vars['priem_use'][2]['name'] = '��������� ����';
		  $pr_vars['priem_use'][2]['id'] = 294;
		  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid2]];
		  $pr_vars['priem_use'][2]['no_chat'] = true;
	  }
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 64) {
	//��������������� ����
	  $pr_use = 1;
	  //������� ����
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = '������� ����';
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
	  //���������
	  if( rand(0,100) < 15 ) {
		  //���������
		  $pr_vars['priem_use'][0]['chance'] = 100;
		  $pr_vars['priem_use'][0]['name'] = '���������';
		  $pr_vars['priem_use'][0]['id'] = 295;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
		  //$pr_vars['priem_use'][2]['no_chat'] = true;
	  }
	  //������� ����
	  if( rand(0,100) < 15 ) {
		  $pr_vars['priem_team_f'][1]['chance'] = 100;
		  $pr_vars['priem_team_f'][1]['name'] = '������� ����';
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
		  $pr_vars['priem_team_f'][2]['name'] = '������� ����';
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
	//���������� ���������
	  $pr_use = 1; 
	  //���������
	  if( rand(0,100) < 15 ) {
		  //���������
		  $pr_vars['priem_use'][0]['chance'] = 100;
		  $pr_vars['priem_use'][0]['name'] = '������ �����';
		  $pr_vars['priem_use'][0]['id'] = 296;
		  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	  }
	  //
  	  $pr_vars['priem_use'][] = array(
		 'chance' => 10,
		 'name' => '�������� ����',
		 'id' => 7,
		 'on' => $this->users[$this->uids[$uid1]],
		 'no_chat' => true
	  );
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 65) {
	//�������� �����
	  $pr_use = 1;
	  //���������
	  $pr_vars['priem_use'][0]['chance'] = 40;
	  $pr_vars['priem_use'][0]['name'] = '���������';
	  $pr_vars['priem_use'][0]['id'] = 293;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	  //�������
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = '�������';
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
	//������� ������
	  $pr_use = 1;
	  //�������
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = '�������';
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
  	  $pr_vars['priem_use'][0]['name'] = '������ ����';
  	  $pr_vars['priem_use'][0]['id'] = 236;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
	  //����������
	  $pr_vars['priem_use'][1]['chance'] = 15;
	  $pr_vars['priem_use'][1]['name'] = '����������';
	  $pr_vars['priem_use'][1]['id'] = 8;
	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
	  
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 63) {
	//�������� ���������
	  $pr_use = 1;
	  //�������� ����
  	 $pr_vars['priem_use'][0]['chance'] = 10;
  	 $pr_vars['priem_use'][0]['name'] = '�������� ����';
  	 $pr_vars['priem_use'][0]['id'] = 7;
  	 $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	 $pr_vars['priem_use'][0]['no_chat'] = true;
	  //���������
	  $pr_vars['priem_use'][1]['chance'] = 50;
	  $pr_vars['priem_use'][1]['name'] = '���������';
	  $pr_vars['priem_use'][1]['id'] = 293;
	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid2]];
	  //���������
	  if( rand(0,100) < 10 ) {
		  //���������
		  $pr_vars['priem_use'][2]['chance'] = 100;
		  $pr_vars['priem_use'][2]['name'] = '������ �����';
		  $pr_vars['priem_use'][2]['id'] = 296;
		  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid2]];
	  }
}elseif($this->users[$this->uids[$uid1]]['bot_id'] == 68) {
	//�������� 
	  $pr_use = 1;
	  //������� ����
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = '������� ����';
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
	  //������� ����
	  $pr_vars['priem_team_f'][1]['chance'] = 10;
	  $pr_vars['priem_team_f'][1]['name'] = '����� �����';
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
	  //�������� ����
  	  $pr_vars['priem_use'][0]['chance'] = 10;
  	  $pr_vars['priem_use'][0]['name'] = '�������� ����';
  	  $pr_vars['priem_use'][0]['id'] = 7;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  /* if( rand(0,100) < 25 ) {
		  //������� ����
		  if( !isset($this->stats[$this->uids[$uid2]]['noeffectbattle1'])) {
			  $pr_vars['priem_team_f'][1]['chance'] = 100;
			  $pr_vars['priem_team_f'][1]['name'] = '����������';
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
	//������� ������ 
	  $pr_use = 1;
	  //����� �����
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = '����� �����';
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
	  //�������� ����
  	  $pr_vars['priem_use'][0]['chance'] = 10;
  	  $pr_vars['priem_use'][0]['name'] = '�������� ����';
  	  $pr_vars['priem_use'][0]['id'] = 7;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //�������� ����
  	  $pr_vars['priem_use'][1]['chance'] = 10;
  	  $pr_vars['priem_use'][1]['name'] = '�������� ������';
  	  $pr_vars['priem_use'][1]['id'] = 7;
  	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
	  //�����������
	  $pr_vars['priem_regen']['hp'] = rand(1,10);
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = '�����������';
	  //��������
	  $pr_vars['priem_team_f'][1]['chance'] = 10;
	  $pr_vars['priem_team_f'][1]['name'] = '��������';
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
	//������� ������ 
	  $pr_use = 1;
	  //�������� ����
  	  $pr_vars['priem_use'][0]['chance'] = 15;
  	  $pr_vars['priem_use'][0]['name'] = '�������� ����';
  	  $pr_vars['priem_use'][0]['id'] = 7;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //�������� ������
  	  $pr_vars['priem_use'][1]['chance'] = 15;
  	  $pr_vars['priem_use'][1]['name'] = '�������� ������';
  	  $pr_vars['priem_use'][1]['id'] = 7;
  	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
	  //���������
  	  $pr_vars['priem_use'][2]['chance'] = 15;
  	  $pr_vars['priem_use'][2]['name'] = '���������';
  	  $pr_vars['priem_use'][2]['id'] = 297;
  	  $pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][2]['no_chat'] = true;
	  //������ ��������
  	  $pr_vars['priem_use'][3]['chance'] = 5;
  	  $pr_vars['priem_use'][3]['name'] = '������ ��������';
  	  $pr_vars['priem_use'][3]['id'] = 298;
  	  $pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid2]];
	  //�����������
	  $pr_vars['priem_regen']['hp'] = rand(1,10);
	  $pr_vars['priem_regen']['chance'] = 10;
	  $pr_vars['priem_regen']['name'] = '�����������';
	  //������� ����
	  if( rand(0,100) < 15 ) {
		  //
		  $pr_vars['priem_team_f'][0]['chance'] = 100;
		  $pr_vars['priem_team_f'][0]['name'] = '������� ����';
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
		  $pr_vars['priem_team_f'][1]['name'] = '������� ����';
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
	//������ ����������� 
	  $pr_use = 1;
	  //������� ����
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = '������� ����';
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
	  //�������� ����
  	  $pr_vars['priem_use'][0]['chance'] = 10;
  	  $pr_vars['priem_use'][0]['name'] = '�������� ����';
  	  $pr_vars['priem_use'][0]['id'] = 7;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //$pr_vars['priem_use'][1]['no_chat'] = true;
	  if( rand(0,100) < 10 ) {
		  //������� ����
		  if( !isset($this->stats[$this->uids[$uid2]]['noeffectbattle1'])) {
			  $pr_vars['priem_team_f'][1]['chance'] = 100;
			  $pr_vars['priem_team_f'][1]['name'] = '����������';
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
	  //������� ����
	  if( rand(0,100) < 10 ) {
		  //
		  $cnt1 = count($pr_vars['priem_team_f']);
		  $pr_vars['priem_team_f'][$cnt1]['chance'] = 100;
		  $pr_vars['priem_team_f'][$cnt1]['name'] = '������� ����';
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
		  $pr_vars['priem_team_f'][$cnt1]['name'] = '������� ����';
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
	  //�������-����� 
	  $pr_use = 1;
	  //�������� ����
  	  $pr_vars['priem_use'][0]['chance'] = 10;
  	  $pr_vars['priem_use'][0]['name'] = '�������� ����';
  	  $pr_vars['priem_use'][0]['id'] = 7;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //����������������
  	  $pr_vars['priem_use'][0]['chance'] = 10;
  	  $pr_vars['priem_use'][0]['name'] = '����������������';
  	  $pr_vars['priem_use'][0]['id'] = 141;
  	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //
	  /*if( rand(0,100) < 25 ) {
		  //������� ����
		  if( !isset($this->stats[$this->uids[$uid2]]['noeffectbattle1'])) {
			  $pr_vars['priem_team_f'][0]['chance'] = 100;
			  $pr_vars['priem_team_f'][0]['name'] = '����������';
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
	  //������� ����
	  if( rand(0,100) < 10 ) {
		  //
		  $cnt1 = count($pr_vars['priem_team_f']);
		  $pr_vars['priem_team_f'][$cnt1]['chance'] = 100;
		  $pr_vars['priem_team_f'][$cnt1]['name'] = '������� ����';
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
		  $pr_vars['priem_team_f'][$cnt1]['name'] = '������� ����';
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
	//����
	  $pr_use = 1;
	  //������ ����
	  $pr_vars['priem_team_f'][0]['chance'] = 10;
	  $pr_vars['priem_team_f'][0]['name'] = '������ ����';
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
	  //�������� ����
	  $pr_vars['priem_use'][0]['chance'] = 10;
	  $pr_vars['priem_use'][0]['name'] = '�������� ����';
	  $pr_vars['priem_use'][0]['id'] = 1;
	  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][0]['no_chat'] = true;
	  //������ ����
	  $pr_vars['priem_use'][1]['chance'] = 10;
	  $pr_vars['priem_use'][1]['name'] = '������ ����';
	  $pr_vars['priem_use'][1]['id'] = 2;
	  $pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];
	  $pr_vars['priem_use'][1]['no_chat'] = true;
}


/*
* ������ ������ (������)
* */
if($this->users[$this->uids[$uid1]]['bot_id'] == 356) {
###����� ������ [9] - ������ 1 ����
	$pr_use = 1;

	$pr_vars['priem_use'][0]['chance'] = 25;
	$pr_vars['priem_use'][0]['name'] = '���� ������ ������';
	$pr_vars['priem_use'][0]['id'] = 216;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][1]['chance'] = 25;
	$pr_vars['priem_use'][1]['name'] = '������� ����';
	$pr_vars['priem_use'][1]['id'] = 11;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][2]['chance'] = 25;
	$pr_vars['priem_use'][2]['name'] = '�������� ����';
	$pr_vars['priem_use'][2]['id'] = 213;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][3]['chance'] = 25;
	$pr_vars['priem_use'][3]['name'] = '���������';
	$pr_vars['priem_use'][3]['id'] = 13;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][4]['chance'] = 25;
	$pr_vars['priem_use'][4]['name'] = '������';
	$pr_vars['priem_use'][4]['id'] = 14;
	$pr_vars['priem_use'][4]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_regen']['hp'] = 45;
	$pr_vars['priem_regen']['chance'] = 15;
	$pr_vars['priem_regen']['name'] = '���� � ������';
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 355) {
### ������ ������ [12] - ������ 3 ����

	$pr_use = 1;
	// ���������� ��� - ������ ������ ������
	$pr_vars['priem_use'][0]['chance'] = 20;
	$pr_vars['priem_use'][0]['name'] = '���������� ���';
	$pr_vars['priem_use'][0]['id'] = 45;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	// ��������� - ������ ������� ����.
	$pr_vars['priem_use'][1]['chance'] = 25;
	$pr_vars['priem_use'][1]['name'] = '���������';
	$pr_vars['priem_use'][1]['id'] = 216;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	// ���� ������� - ������� ������������ ����.
	$pr_vars['priem_team_f'][0]['chance'] = 25;
	$pr_vars['priem_team_f'][0]['name'] = '���� �������';
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
	$pr_vars['priem_use'][2]['name'] = '���������';
	$pr_vars['priem_use'][2]['id'] = 13;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

	$pr_vars['priem_use'][3]['chance'] = 25;
	$pr_vars['priem_use'][3]['name'] = '������';
	$pr_vars['priem_use'][3]['id'] = 14;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 261) {
### ������ ������ [9] - ������ 1-3 ����
/*  (650HP)
����: 50
��������: 15
��������: 60
������������: 30
���������: 5
��������: 0
1 ���� 2 �����. ���������� ����: �������, ��������� �����: ���� (� 8�).
* */
	$pr_use = 1;
}
if($this->users[$this->uids[$uid1]]['bot_id'] == 345) {
### ������ ������ [8] - ������ 1-3 ����
/* (500HP)
����: 30
��������: 25
��������: 50
������������: 30
���������: 0
��������: 0
1 ���� 2 �����. ���������� ����: �������, ��������� �����: ���� (� 8�).
* */
	$pr_use = 1;
}
if($this->users[$this->uids[$uid1]]['bot_id'] == 346) {
### �������� [7] - ������ 1-3 ����
/* (450HP)
����: 50
��������: 25
��������: 20
������������: 30
���������: 0
��������: 0
1 ����, 2 �����. ���������� ����: ��������.
*/
	$pr_use = 1;
}
if($this->users[$this->uids[$uid1]]['bot_id'] == 347) {
### �������� [8] - ������ 1-3 ����
/* (500HP)
����: 30
��������: 30
��������: 50
������������: 30
���������: 0
��������: 0
1 ����, 2 �����. ���������� ����: ��������.
����� ��������: ������
*/
	$pr_use = 1;
}
if($this->users[$this->uids[$uid1]]['bot_id'] == 348) {
### ����������� ������ [9] - ������ 1-3 ����
/*(600HP)
����: 50
��������: 50
��������: 20
������������: 30
���������: 10
��������: 0
1 ���� 2 �����. ���������� ����: �������, ��������� �����: ���� (� 8�).
 */
	$pr_use = 1;
}
if($this->users[$this->uids[$uid1]]['bot_id'] == 349) {
### ����������� ������ [8] - ������ 1-3 ����
/* (375HP)
����: 40
��������: 50
��������: 35
������������: 30
���������: 0
��������: 0
1 ���� 2 �����. ���������� ����: �������, ��������� �����: ���� (� 8�).
*/
	$pr_use = 1;
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 352) {
### ������� ������� ����� [9] - ������ 3 ����
	// ������� ����.
	$pr_vars['priem_use'][0]['chance'] = 25;
	$pr_vars['priem_use'][0]['name'] = '������� ����';
	$pr_vars['priem_use'][0]['id'] = 11;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid1]];

	// �������� ������.
	$pr_vars['priem_use'][1]['chance'] = 20;
	$pr_vars['priem_use'][1]['name'] = '�������� ������';
	$pr_vars['priem_use'][1]['id'] = 7;
	$pr_vars['priem_use'][1]['on'] = $this->users[$this->uids[$uid1]];

	// ���������.
	$pr_vars['priem_use'][2]['chance'] = 20;
	$pr_vars['priem_use'][2]['name'] = '���������';
	$pr_vars['priem_use'][2]['id'] = 13;
	$pr_vars['priem_use'][2]['on'] = $this->users[$this->uids[$uid1]];

	// ������.
	$pr_vars['priem_use'][3]['chance'] = 25;
	$pr_vars['priem_use'][3]['name'] = '������';
	$pr_vars['priem_use'][3]['id'] = 14;
	$pr_vars['priem_use'][3]['on'] = $this->users[$this->uids[$uid1]];

	$pr_use = 1;
}
if($this->users[$this->uids[$uid1]]['bot_id'] == 355) {
### ��������� ������ [8] - ������ 2 ����
/* (800HP)
� ����������: 8 ��.
����: 80
��������: 3
��������: 3
������������: 40
���������: 0
��������: 0
1 ���� 2 �����. ���������� ����: ��������, ��������� �����: �����. ���������� (�������� ����� ��� ����� ������).
�������� ������� �����.
 */
	$pr_use = 1;
}

/*
* ����� ������ (������)
* */

if($this->users[$this->uids[$uid1]]['bot_id'] == 132) {
###�������� ����� [9]
###To Do : ���������, ����������
  $pr_use = 0;

}

if($this->users[$this->uids[$uid1]]['bot_id'] == 133) {
###���-��������� [10]
###To Do : ���������� �������
 $pr_use = 1;
	$pr_vars['priem_use'][0]['chance'] = 15;
	$pr_vars['priem_use'][0]['name'] = '���������� �������';
	$pr_vars['priem_use'][0]['id'] = 363;
	$pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];

}


if($this->users[$this->uids[$uid1]]['bot_id'] == 135) {
###������� [9]
###To Do : ��������
  $pr_use = 0;
  
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 136) {
###������������ ����� [9]
###To Do : �������, ������
  $pr_use = 1;
  
  $pr_vars['priem_use'][0]['chance'] = 3;
  $pr_vars['priem_use'][0]['name'] = '���������';
  $pr_vars['priem_use'][0]['id'] = 212;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
  
  	  //������� ����
  $pr_vars['priem_team_f'][0]['chance'] = 45;
  $pr_vars['priem_team_f'][0]['name'] = '<font color=brown>�������</font>';
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
###����� �������� [11]
###To Do : ����������, ��������� ������, ���������, ���������� �����
  $pr_use = 1;
if(rand(0,100) <= 35) {
  $pr_vars['priem_use'][0]['chance'] = 100;
  $pr_vars['priem_use'][0]['name'] = '����������';
  $pr_vars['priem_use'][0]['id'] = 348;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
}
  
  if($hp <= 50) {
	  $pr_vars['priem_use'][1]['chance'] = 70;
	  $pr_vars['priem_use'][1]['name'] = '��������� ������';
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
	  $mas['text'] = '{tm1} {u1} �������� ����� <font color=brown><b>&quot���������&quot;</font></b> �� {u2} <font color=brown><b> - '.$hpRand.' </font></b> ['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
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
	  $mas['text'] = '{tm1} {u1} �������� ����� <font color=darkblue><b>&quot;���������� �����&quot;</font></b> �� {u2} � ����� � ���� �����: <font color=darkblue><b>- '.$mpRand.' </font></b>['.$this->stats[$this->uids[$uid2]]['mpNow'].'/'.$this->stats[$this->uids[$uid2]]['mpAll'].']';
	  $this->add_log($mas);
}
  
}

if($this->users[$this->uids[$uid1]]['bot_id'] == 141) {
###������������ ������ [10]
###To Do : �����, �������� ����
  $pr_use = 1;
  $ran = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$this->users[$this->uids[$uid2]]['id'].'" AND `v2` = 349 AND `delete` = 0 LIMIT 1'));
  if(isset($ran['id'])) {
	  $ranHP2 = round($this->stats[$this->uids[$uid2]]['hpAll']*0.30/10); 
	  $this->stats[$this->uids[$uid2]]['hpNow'] -= $ranHP2;
	  mysql_query('UPDATE `stats` SET `mpNow` = '.$this->stats[$this->uids[$uid2]]['mpNow'].' WHERE `id` = '.$this->stats[$this->uids[$uid2]]['id'].' LIMIT 1');
	  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
	  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
	  $mas['text'] = '{tm1} {u2} ������� ����������� �� ������ <font color=green><b>&quot;�������� ����&quot; - '.$ranHP2.'</font></b> ['.(ceil($this->stats[$this->uids[$uid2]]['hpNow'])).'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
	  $this->add_log($mas);
  }elseif(!isset($ran['id']) && rand(0,100) <= 27) {
	  $ranHP = $this->stats[$this->uids[$uid2]]['hpAll'];
	  $ranHP = round($ranHP/100);
	  $this->stats[$this->uids[$uid2]]['hpNow'] -= $ranHP;
	  $go = mysql_query('UPDATE `stats` SET `mpNow` = '.$this->stats[$this->uids[$uid2]]['mpNow'].' WHERE `id` = '.$this->stats[$this->uids[$uid2]]['id'].' LIMIT 1');
	  if($go) {
		  mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`name`,`data`,`timeUse`,`user_use`,`v1`,`v2`,`img2`,`x`,`hod`) VALUES ("22","'.$this->users[$this->uids[$uid2]]['id'].'","�������� ����","from_ptp","77","'.$this->users[$this->uids[$uid1]]['id'].'","priem","349","bot_deathstrike.gif","1","10")');
		  $vLog = 'time1='.time().'||s1='.$this->users[$this->uids[$uid1]]['sex'].'||t1='.$this->users[$this->uids[$uid1]]['team'].'||login1='.$this->users[$this->uids[$uid1]]['login'].'||s2='.$this->users[$this->uids[$uid2]]['sex'].'||t2='.$this->users[$this->uids[$uid2]]['team'].'||login2='.$this->users[$this->uids[$uid2]]['login'].'';
		  $mas = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		  $mas['text'] = '{tm1} {u1} �������� ����� <font color=darkred><b>&quot;�������� ����&quot;</font></b> �� {u2} � ����� ����: <font color=darkred><b>- '.$ranHP.' </font></b>['.$this->stats[$this->uids[$uid2]]['hpNow'].'/'.$this->stats[$this->uids[$uid2]]['hpAll'].']';
		  $this->add_log($mas);
	  }
  }
  
}


if($this->users[$this->uids[$uid1]]['bot_id'] == 143) {
###������������ �������� [10]
###To Do : �������, ������
  $pr_use = 1;
  
  $pr_vars['priem_use'][0]['chance'] = 3;
  $pr_vars['priem_use'][0]['name'] = '���������';
  $pr_vars['priem_use'][0]['id'] = 212;
  $pr_vars['priem_use'][0]['on'] = $this->users[$this->uids[$uid2]];
  
}
	
  if($pr_use > 0) {
  	//priem_use , priem_team_f , priem_regen ��� ���������� ������ 1 �����
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
			  ###������������ ������������� �� ����� ����������� �����. (��������������)
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
                  $pr_vars['mas']['text'] = '{tm1} {u1} ����������� ����� &quot;<b>'.$pr_vars['priem_team_f'][$i]['name'].'</b>&quot; � ����������� ���� ��������. <b><font color=#006699>'.$hp_vis.'</font></b> ['.$this->users[$this->uids[$uid1]]['hpNow'].'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
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
      mysql_query('UPDATE `stats` SET `hpNow` = '.$pr_vars['hp_u1'].' WHERE `id` = "'.$uid2.'" LIMIT 1');
	  if( $pr_vars['hp_u1'] > $this->stats[$this->uids[$uid1]]['hpAll'] ) {
		 $pr_vars['hp_u1'] = $this->stats[$this->uids[$uid1]]['hpAll'];
	  }
	  $pr_vars['mas']['text'] = '{tm1} {u1} ����������� ����� &quot;<b>'.$pr_vars['priem_regen']['name'].'</b>&quot; � ����������� ���� ��������. <b><font color=#006699>'.$pr_vars['priem_regen']['hp'].'</font></b> ['.ceil($pr_vars['hp_u1']).'/'.$this->stats[$this->uids[$uid1]]['hpAll'].']';
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
			  $pr_vars['mas']['text'] = '{tm1} {u1} ����������� ����� &quot;<b>'.$pr_vars['priem_use'][$i]['name'].$pld[0].'</b>&quot; �� ��������� {u2}. <small>'.$inf.'</small>';
			} else {
			  $pr_vars['mas']['text'] = '{tm1} {u1} ����������� ����� &quot;<b>'.$pr_vars['priem_use'][$i]['name'].$pld[0].'</b>&quot;  �� ��������� {u2}.';
		    }
		  } else {
			if(isset($inf)) {
			  $pr_vars['mas']['text'] = '{tm1} {u1} ����������� ����� &quot;<b>'.$pr_vars['priem_use'][$i]['name'].$pld[0].'</b>&quot;. <small>'.$inf.'</small>';
			} else {
			  $pr_vars['mas']['text'] = '{tm1} {u1} ����������� ����� &quot;<b>'.$pr_vars['priem_use'][$i]['name'].$pld[0].'</b>&quot;.';
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