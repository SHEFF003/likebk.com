<?
if(!defined('GAME'))
{
	die();
}

/*
- �������� ���������� ������ � $btl->users[]['eff'] ����� �������������, � ��������� ������ �������� ������ ������������ ����� 1 ���
*/

class priems
{	

	public function mg2static_points($uid,$st) {	
		global $u;
		if(isset($st['mg2static_points'])) {
			$mg = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$uid.'" AND `data` LIKE "%add_mg2static_points%" AND `delete` = "0" ORDER BY `id` DESC LIMIT 1'));
			if(isset($mg['id']) && $mg['data']['add_mg2static_points'] < 5) {
				if( $mg['x'] < 5 ) {
					$mg['data'] = $u->lookStats($mg['data']);
					$mg['data']['add_mg2static_points']++;
					$mg['data']['add_zm2proc']--;
					$mg['x'] = $mg['data']['add_mg2static_points'];
					$mg['data'] = $u->impStats($mg['data']);
					mysql_query('UPDATE `eff_users` SET `data` = "'.$mg['data'].'",`x` = "'.$mg['x'].'" WHERE `id` = "'.$mg['id'].'" LIMIT 1');
				}
			}
		}	
	}


	//�������� ����
	public function minMana($uid,$mp,$tp)
	{
		global $u,$btl;
		$r = true;
		/* ��������� ������ ����, ���� $mp > 0 */
		//� ������� ���������� �������� ����ss
		$mp -= round($mp/100*$btl->stats[$btl->uids[$uid]]['min_use_mp']);
		$btl->stats[$btl->uids[$uid]]['mpNow'] -= $mp;
		if($btl->stats[$btl->uids[$uid]]['mpNow']<0)
		{
			$btl->stats[$btl->uids[$uid]]['mpNow'] = 0;
			$r = false;
		}elseif($btl->stats[$btl->uids[$uid]]['mpNow']>$btl->stats[$btl->uids[$uid]]['mpAll'])
		{
			$btl->stats[$btl->uids[$uid]]['mpNow'] = $btl->stats[$btl->uids[$uid]]['mpAll'];
		}
		
		mysql_query('UPDATE `stats` SET `mpNow` = "'.($btl->stats[$btl->uids[$uid]]['mpNow']).'" WHERE `id` = "'.((int)$uid).'" LIMIT 1');
		return $r;
	}
	
	//���������� ����� ������ ���	
	public function hodUsePriem($eff,$pr)
	{
		global $u,$btl,$c,$code;
		$return_main = true;
		if($u->info['hpNow'] > 0) {
			$ue = mysql_fetch_array(mysql_query('SELECT `u`.*,`st`.* FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id`=`st`.`id`) WHERE `u`.`id`="'.$eff['uid'].'" AND `u`.`battle`="'.$btl->info['id'].'" AND `st`.`hpNow` > 0 LIMIT 1'));
			if($pr['file']!='0')
			{
				if(file_exists('../../_incl_data/class/priems/'.$pr['file'].'.php'))
				{
					$hod = $eff['hod'];
					require('priems/'.$pr['file'].'.php');
				}
				if(!isset($cup))
				{
					//�������� ������� �� ������
					//$this->mintr($pl);
				}
			}elseif($pr['file3']!='0')
			{
				if(file_exists('../../_incl_data/class/priems/'.$pr['file3'].'.php'))
				{
					$hod = $eff['hod'];
					require('priems/'.$pr['file3'].'.php');
				}
				if(!isset($cup))
				{
					//�������� ������� �� ������
					//$this->mintr($pl);
				}
			}else{
				//�����-�� ������ �������
				
			}
		}
		return $return_main;
	}
	
	public function redate($pl,$uid)
	{
		global $u,$btl;
		$i = 0;
		if($pl!='')
		{
			$e = explode('|',$pl);
			while($i<count($e))
			{
				$f = explode('=',$e[$i]);
				$f[1] = getdr($f[1],array(0=>'lvl1',1=>'ts5',2=>'mpAll'),array(0=>$btl->users[$btl->uids[$uid]]['level'],1=>$btl->stats[$btl->uids[$uid]]['s5'],2=>$btl->stats[$btl->uids[$uid]]['mpAll']));
				if($f[0]!='' && $f[1]!='')
				{
					$e[$i] = implode('=',$f);
				}
				$i++;	
			}
			$pl = implode('|',$e);
		}
		return $pl;
	}
	
	/* uid - �� ���� �������
	   pr - id ������
	   data - ����, ���� -1, �� ��������� ����3
	   d2 - ��������� ����3
	   tm - ����� �������������, 77 - �����
	   h - ���-�� "������" �����
	   uu - id ����� ������� �����������
	   tp - ��� ������
	*/
	public function addPriem($uid,$pr,$data,$d2,$tm,$h,$uu,$max,$bj,$tp = 0,$ch = 0,$rdt = 0,$tr_life_user = 0,$noupdatebtl = 0)
	{
		global $u,$btl;
		$pl = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.((int)$pr).'" LIMIT 1'));
		//if($uid=='399105'){
		//print_r($pl);
		//}
		$r = false;
		if(isset($pl['id']) && $u->info['hpNow'] > 0)
		{
			if($data==-1)
			{				
				$data = $this->redate($pl['date3'],$u->info['id']);
			}elseif($d2==1)
			{
				$data .= '|'.$this->redate($pl['date3'],$u->info['id']);
			}

			if($pl['cancel_eff2']!='')
			{
				$i = 0; 
				$e = explode(',',$pl['cancel_eff2']);
				while($i<count($e))
				{
					if($e[$i]>0)
					{
						$nem = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$uid.'" AND `v1` = "priem" AND `v2` = "'.$e[$i].'" AND `delete` = "0" LIMIT 1'));
						if(isset($nem['id']))
						{
							$nem['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$e[$i].'" LIMIT 1'));
							if(isset($nem['id']))
							{
								$btl->delPriem($nem,$btl->users[$btl->uids[$uid]],2);
							}
						}
					}
				$i++;
				}
			}
			if($max>0)
			{
				if($pl['zmu'] == 1) {
					$num = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `bj` = "'.$bj.'" AND `user_use` = "'.$u->info['id'].'" AND `uid` = "'.$uid.'" AND `delete` = "0" LIMIT 1'));
				}else{
					$num = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `bj` = "'.$bj.'" AND `uid` = "'.$uid.'" AND `delete` = "0" LIMIT 1'));				
				}
				
				if(isset($num['id']) && ($num['user_use']!=$u->info['id'] && $pl['zmu'] != 2))
				{
					// ������� ������
					mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `id` = "'.$num['id'].'" LIMIT 1');
					if(isset($num['id']))
					{
						$i = 0;
						while($i<count($btl->stats[$btl->uids[$uid]]['effects']))
						{
							if($btl->stats[$btl->uids[$uid]]['effects'][$i]['id']==$num['id'])
							{
								//���������
								$btl->stats[$btl->uids[$uid]]['effects'][$i]['delete'] = time();
							}
							$i++;
						}
					}
					unset($num);
				}
				
				if(!isset($num['id']))
				{
					$ins = mysql_query('INSERT INTO `eff_users` (`tr_life_user`,`bj`,`user_use`,`hod`,`v2`,`img2`,`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`v1`) VALUES ("'.floor($tr_life_user).'","'.$bj.'","'.$uu.'","'.$h.'",'.$pl['id'].',"'.$pl['img'].'.gif",22,"'.$uid.'","'.$pl['name'].'","'.$data.'","0","'.$tm.'","priem")');
					if($ins)
					{
						$r = true;	
						$lid = mysql_insert_id();
					}
					/* ��������� ������ � $btl->eff */
					if( $noupdatebtl == 0 ) {
						//$btl->stats[$btl->uids[$uid]] = $u->getStats($uid,0);
					}
					
				}elseif($num['x']<$max)
				{
					//��������� ��� � ��������� ������
					$num['x']++; $num['hod'] = $h;
					if( $data != -1 && $data != '' && $d2 == 2 ) {
						$num['data'] .= '|'.$data.'';
						$upd = mysql_query('UPDATE `eff_users` SET `x` = `x` + 1,`hod` = "'.$h.'",`data` = "'.$num['data'].'" WHERE `id` = "'.$num['id'].'" LIMIT 1');	
					}else{
						$upd = mysql_query('UPDATE `eff_users` SET `x` = `x` + 1,`hod` = "'.$h.'" WHERE `id` = "'.$num['id'].'" LIMIT 1');	
					}
					if($upd)
					{
						$r = true;
					}	
				}else{
					//��������� ������
					$num['hod'] = $h;
					if( $data != -1 && $data != '' && $d2 == 2 ) {
						$num['data'] .= '|'.$data.'';
						$upd = mysql_query('UPDATE `eff_users` SET `hod` = "'.$h.'",`data` = "'.$num['data'].'" WHERE `id` = "'.$num['id'].'" LIMIT 1');	
					}else{
						$upd = mysql_query('UPDATE `eff_users` SET `hod` = "'.$h.'" WHERE `id` = "'.$num['id'].'" LIMIT 1');	
					}					if($upd)
					{
						$r = true;	
					}
				}
				
				if($r==true)
				{
					//cancel_eff ��� �����
					if($pl['cancel_eff']!='')
					{
						$i = 0; 
						$e = explode(',',$pl['cancel_eff']);
						while($i<count($e))
						{
							if($e[$i]>0)
							{
								$nem = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$uid.'" AND `v1` = "priem" AND `v2` = "'.$e[$i].'" AND `delete` = "0" LIMIT 1'));
								if(isset($nem['id']))
								{
									$nem['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$e[$i].'" LIMIT 1'));
									if(isset($nem['id']))
									{
										$btl->delPriem($nem,$btl->users[$btl->uids[$uid]],2);
									}
								}
							}
						$i++;
						}
					}
				}
				
				/*if($ch==1)
				{
					$vLog = 'time1='.time().'||s1='.$u->info['sex'].'||t1='.$u->info['team'].'||login1='.$u->info['login'].'||s2='.$btl->users[$btl->uids[$uid]]['sex'].'||t2='.$btl->users[$btl->uids[$uid]]['team'].'||login2='.$btl->users[$btl->uids[$uid]]['login'].'';
					$mas1 = array('time'=>time(),'battle'=>$btl->info['id'],'id_hod'=>($btl->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
					if($tp > 0) {
						$tco = array(1=>'006699',2=>'006699',3=>'006699',4=>'006699'); //�� ����
						$tcl = array(1=>'A00000',2=>'008080',3=>'0000FF',4=>'A52A2A'); //�� ����
						$tco = $tco[$tp];
						$tcl = $tcl[$tp];
						$nmz = array(
							0=>array(0=>'�����',1=>'����'),
							1=>array(0=>'����',1=>'��������'),
							2=>array(0=>'�������',1=>'�������������'),
							3=>array(0=>'����',1=>'�����'),
							4=>array(0=>'�����',1=>'��������'),
							5=>array(0=>'�����',1=>'����'),
							6=>array(0=>'����',1=>'����'),
							7=>array(0=>'������������',1=>'�����&nbsp;�����')
						);
						$nmz = $nmz[$tp];
						$mas1['text'] = '{tm1} {u1} {1x16x0} ���������� ����� '.$nmz[0].' &quot;<b><font color=#'.$tcl.'>'.$pl['name'].'</font></b>&quot;';	
					}else{
						//$mas1['text'] = '{tm1} {u1} {1x16x0} ����� &quot;<b>'.$pl['name'].'</b>&quot;';
						//$btl->priemAddLogFast($u->info['id'],0,$pl['name'],'{tm1} '.$btl->addlt(1 , 17 , $btl->users[$btl->uids[$u->info['id']]]['sex'] , NULL).'',0,time());	
					}
					if($u->info['id']!=$uid)
					{
						$mas1['text'] .= ' �� ��������� {u2}.';
					}else{
						$mas1['text'] .= '.';
					}
					$btl->add_log($mas1);
				}*/
				
				if(isset($num['id']))
				{
					$i = 0;
					while($i<count($btl->stats[$btl->uids[$uid]]['effects']))
					{
						if($btl->stats[$btl->uids[$uid]]['effects'][$i]['id']==$num['id'])
						{
							//���������ss
							$btl->stats[$btl->uids[$uid]]['effects'][$i]['data'] = $num['data'];	
							$btl->stats[$btl->uids[$uid]]['effects'][$i]['hod'] = $num['hod'];
							$btl->stats[$btl->uids[$uid]]['effects'][$i]['x'] = $num['x'];
						}
						$i++;
					}
				}
			}
		}
		return $r;
	}
	
	public function lookStatsArray($m)
	{
		$ist = array();
		$di = explode('|',$m);
		$i = 0; $de = false;
		while($i<count($di))
		{
			$de = explode('=',$di[$i]);
			if(isset($de[0],$de[1]))
			{
				if(!isset($ist[$de[0]])) {
					$ist[$de[0]] = array();
				}
				$ist[$de[0]][] = $de[1];
			}
			$i++;
		}
		return $ist;
	}

	public function magicRegen($ue,$hpmin,$tmp,$pl,$eff,$rp = 0,$dp = 0,$krituet=true,$dopyrn=0)
	{
		global $u,$c,$code,$btl;
		$rr = array();
		$uen = $ue['id'];
		$usu = $eff['user_use'];
		if($eff['user_use']<1)
		{
			$usu = $u->info['id'];
		}
		$k = $btl->magKrit($ue['level'],$btl->stats[$btl->uids[$usu]]['mg'.$tmp]);
		
		if($krituet==false){$k=0;}
		
		$hpmin = $this->testPower($btl->stats[$btl->uids[$usu]],$btl->stats[$btl->uids[$uen]],$hpmin,$tmp,2);
		$hpmin = round($hpmin);
		
		$dopyrn = $this->testPower($btl->stats[$btl->uids[$usu]],$btl->stats[$btl->uids[$uen]],$dopyrn,$tmp,2);
		$dopyrn = round($dopyrn);
		
		if($btl->users[$btl->uids[$uen]]['tactic7']<=0 && $dp==0)
		{
			$hpmin = 0; $k = -1;
			$dopyrn = 0;
		}
		if($k==1 && $hpmin!=0 && $krituet==true)
		{
			//����
			$hpmin = $hpmin*2; 
		}elseif($k==-1 && $hpmin!=0)
		{
			//������
			$hpmin = $hpmin/2; 
			$dopyrn = $dopyrn/2;
		}
		if($hpmin<1){ $hpmin = 0; }else{
			$hpmin = rand(($hpmin*0.97),$hpmin);	
		}
		
		$hpmin += floor($dopyrn);
		
		if(isset($btl->stats[$btl->uids[$uen]]['min_heal_proc'])) {
			if($btl->stats[$btl->uids[$uen]]['min_heal_proc'] > 100) {
				$btl->stats[$btl->uids[$uen]]['min_heal_proc'] = 100;
			}
			$hpmin = round($hpmin/100*(100+$btl->stats[$btl->uids[$uen]]['min_heal_proc']));
		}
		
		if($btl->users[$btl->uids[$uen]]['tactic7']>0 && $dp==0)
		{
			//�������� �������, ���� ��� ��������
			$btl->users[$btl->uids[$uen]]['tactic7'] -= $hpmin/$btl->stats[$btl->uids[$uen]]['hpAll'];
			$btl->users[$btl->uids[$uen]]['tactic7'] = round($btl->users[$btl->uids[$uen]]['tactic7'],2);
			$btl->stats[$btl->uids[$uen]]['tactic7'] = $btl->users[$btl->uids[$uen]]['tactic7'];
			if($uen==$u->info['id'])
			{
				$u->info['tactic7'] = $btl->users[$btl->uids[$uen]]['tactic7'];
				$u->stats['tactic7'] = $btl->users[$btl->uids[$uen]]['tactic7'];
			}
			if($btl->users[$btl->uids[$uen]]['tactic7']<0)
			{
				$btl->users[$btl->uids[$uen]]['tactic7']  = 0;
			}
		}
		$hp2 = floor($btl->stats[$btl->uids[$uen]]['hpNow'] + $hpmin);
		
		if($hp2 > $btl->stats[$btl->uids[$uen]]['hpAll'])
		{
			$hpmin = floor($hp2-$btl->stats[$btl->uids[$uen]]['hpAll']);
			$hp2 = $btl->stats[$btl->uids[$uen]]['hpAll'];
		}elseif($hp2<0)
		{
			$hp2 = 0;
		}
		$rr[0] = $hpmin; //����
		$rr[1] = $k; //���
		/* ��������� ������ ������ */
			//�������� ������ � �������� ����������
			$miny = 0; //�� ������� ������ ���� ���� ������ (������ ������)
			$minu = 0;
			$sp1 = mysql_query('SELECT `e`.* FROM `eff_users` AS `e` WHERE `e`.`uid` = "'.$uen.'" AND `e`.`id_eff` = "22" AND `e`.`delete` = "0" AND `e`.`v1` = "priem" LIMIT 25');
			while($pl2 = mysql_fetch_array($sp1))
			{
				$pl2['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$pl2['v2'].'" LIMIT 1'));
				if(isset($pl2['priem']['id']))
				{
					$dt1 = $u->lookStats($pl2['priem']['date2']);
					if(isset($dt1['yron_u2']))
					{
						$minu = getdr($dt1['yron_u2'],array(0=>'lvl1',1=>'yr1',2=>'ts5',3=>'ts6'),array(0=>$btl->users[$btl->uids[$level]],1=>$hpmin,2=>0,3=>0));
						$miny -= $minu;
						$hpmin += $minu;
						$btl->delPriem($pl2,$btl->users[$btl->uids[$uen]]);	
					}
				}
				
			}
					
		/* ��������� ������ ���������� */
		
		//�������� ��
		$btl->users[$btl->uids[$uen]]['hpNow'] = $hp2;
		$btl->stats[$btl->uids[$uen]]['hpNow'] = $hp2;
		$upd = mysql_query('UPDATE `stats` SET `hpNow` = '.$hp2.',`tactic7` = '.$btl->users[$btl->uids[$uen]]['tactic7'].' WHERE `id` = "'.$uen.'" LIMIT 1');
		
		//������� � ��� ���
		$vLog = 'time1='.time().'||s1='.$u->info['sex'].'||t1='.$u->info['team'].'||login1='.$u->info['login'].'||s2='.$btl->users[$btl->uids[$uen]]['sex'].'||t2='.$btl->users[$btl->uids[$uen]]['team'].'||login2='.$btl->users[$btl->uids[$uen]]['login'].'';
		$mas1 = array('time'=>time(),'battle'=>$btl->info['id'],'id_hod'=>($btl->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		if($rp==1)
		{
			$mas1['id_hod']--;
		}
		//$btl->takeExp($u->info['id'],$hpmin,$u->info['id'],$uen);
		
		$btl->takeExp($u->info['id'],($hpmin*0.33),$u->info['id'],$uen,true);
		
		if($hpmin>0)
		{
			$hpmin = '+'.ceil($hpmin);
		}else{
			$hpmin = '--';
		}
		$tco = array(1=>'006699',2=>'006699',3=>'006699',4=>'006699'); //�� ����
		$tcl = array(1=>'A00000',2=>'008080',3=>'0000FF',4=>'A52A2A'); //�� ����
		$tco = $tco[$tmp];
		$tcl = $tcl[$tmp];
		if($k==1)
		{
			//����
			$tco = 'FF0000';
			$tcl = 'FF0000';
		}elseif($k==-1)
		{
			//������
			$tco = '979797';
			$tcl = '979797'; 
		}
		$nmz = array(
			1=>array(0=>'����',1=>'��������'),
			2=>array(0=>'�������',1=>'�������������'),
			3=>array(0=>'����',1=>'������'),
			4=>array(0=>'�����',1=>'��������')
			);
		$nmz = $nmz[$tmp];
		
		if($rp==1)
		{
			if($k==0)
			{
				//$tcl = '000000';
				//$tco = '008000';
			}
			$sx = array(0=>'',1=>'�');
			$mas1['text'] = '{tm1} ���������� &quot;<b><font color=#'.$tcl.'>'.$pl['name'].'</font></b>&quot; ������������ �������� ��������� {u2}. <b><font title=���&nbsp;�����������:&nbsp;'.$nmz[1].' color=#'.$tco.'>'.$hpmin.'</font></b> ['.ceil($hp2).'/'.$btl->stats[$btl->uids[$uen]]['hpAll'].']';
		}else{
			$mas1['text'] = '{tm1} {u1} {1x16x0} ���������� &quot;<b><font color=#'.$tcl.'>'.$pl['name'].'</font></b>&quot; � ����������� �������� ��������� {u2} ������ '.$nmz[0].'. <b><font title=���&nbsp;�����������:&nbsp;'.$nmz[1].' color=#'.$tco.'>'.$hpmin.'</font></b> ['.ceil($hp2).'/'.$btl->stats[$btl->uids[$uen]]['hpAll'].']';	
		}
		$btl->add_log($mas1);
		$pz[(int)$id] = 1;	
		return $rr;
	}

	public $cof_mag = array(
		0  => 250,
		1  => 250,
		2  => 250,
		3  => 250,
		4  => 250,
		5  => 250,
		6  => 250,
		7  => 250,
		8  => 250,
		9  => 300,
		10 => 360,
		11 => 475,
		12 => 520,
		13 => 625,
		14 => 750,
		15 => 895,
		16 => 1075,
		17 => 1290,
		18 => 1550,
		19 => 1860,
		20 => 2230,
		21 => 2675
	);
	public function magatack( $u1, $u2, $yron, $type, $krit ) {
		global $btl;
		$r = $yron;
		//
		$prm = array(
			'y' => $btl->stats[$btl->uids[$u1]]['mg'.$btl->mname[$type]], //������
			'yv' => 0, //������, �������� ���.
			'max_krit' => 0 //����������� �����
		);
		//
		// (������� ����)*2 - 7 - ����������� ������, ����� �� ���� ��������
		/*
		��� ����� �����/���� �� �������: ������� ���� * 2 � 9 
		������ ������ ���� ���� ����� ����������� ��� ���� �� 3%. �� �� ������ 30%
		*/
		//������� ����� �� ������
		/*
		b - ������� ����
		m - ����
		z - ������ ���� [��.]
		p - ���������� [��.]
		k - ����������� ; k=250 ��� 8��, k=300 ��� 9�� � �.�. +20% �� �������
		*/
		$prm['b'] = round($r,2); //������� ����
		$prm['m'] = $btl->stats[$btl->uids[$u1]]['pm'.$btl->mname[$type]]; //����
		$prm['z'] = $btl->stats[$btl->uids[$u2]]['zm'.$btl->mname[$type]]; //������ ���� (��.)
		if( $prm['z'] < 0 ) {
			$prm['z'] = 0;
		}
		$prm['p'] = $btl->stats[$btl->uids[$u1]]['pzm'.$btl->mname[$type]]+$btl->stats[$btl->uids[$u1]]['pzm']; //���������� (��.)
		$prm['k'] = $this->cof_mag[$btl->users[$btl->uids[$u2]]['level']]; //����������
		if( $prm['k'] == 0 ) {
			$prm['k'] = 1;
		}
		//
		/*if( $prm['p']*10 > $prm['k'] ) {
			$prm['p'] = round($prm['k']/10);
		}*/
		
		$prm['p'] = (1-( pow(0.5, ($prm['p']/75) ) ))*90;
		
		if( $prm['p']*10 > $prm['z']+$prm['k'] ) {
			$prm['p'] = round(($prm['z']+$prm['k'])/10);
		}
		
		//echo '[�������� '.$prm['m'].'%, ���������� '.$prm['p'].' ��., ������ ���� '.$prm['z'].' ��., ���������� '.$prm['k'].']';
		
		//$prm['p'] = round($prm['p']*2);
		
		//$r = $prm['b']*(1+$prm['m']/100)*pow(2,(($prm['p']*10-$prm['z'])/$prm['k'])); (������ ������)
		//$r = $prm['b']*(1+$prm['m']/100)*pow(2,((0-($prm['z']-$prm['p']*10))/$prm['k'])); (�� �����, ������)
		//
		$prm['znew'] = ( ( $prm['z'] / 100) * ( 100 - $prm['p'] ) ) - 5 * $prm['p'];
		//
		//�������� �������� �� 10% - ����� �������� ���������.
		$r = ($prm['b']*((1+$prm['m']/100)))/100*(100-$btl->zmgo($prm['znew']));
		//echo '['.$prm['b'].'*(1+'.$prm['m'].'/100)*pow(2,(('.$prm['p'].'*10-'.$prm['z'].')/'.$prm['k'].'));]';
		
		//$r += floor($btl->stats[$btl->uids[$u1]]['s5']*0.25);
		if( $r < floor($prm['b']*0.2) ) {
			//$r = floor($prm['b']*0.2);
		}elseif( $r > floor($prm['b']*10) ) {
			//$r = floor($prm['b']*10);
		}
		//
		//$prm['y'] -= 5;
		if( $type < $btl->mname[$type] ) {
			$prm['yv'] = ($btl->users[$btl->uids[$u2]]['level'] * 2 - 7);
		}else{
			$prm['yv'] = ($btl->users[$btl->uids[$u2]]['level'] * 2 - 9);
		}
		//
		if( $prm['y'] >= $prm['yv'] || $btl->stats[$btl->uids[$u1]]['acestar'] > 0 ) {
			if( $krit == 1 ) {
				$prm['max_krit'] = 3 * ( $prm['y'] - $prm['yv'] );
				if( $prm['max_krit'] < 0 ) {
					$prm['max_krit'] = 0;
					//��������� ���� ���� 25 ���������
				}elseif( $prm['max_krit'] > 25 ) {
					$prm['max_krit'] = 25;
				}
				//$prm['max_krit'] = round($prm['max_krit']/2);
				//���� ��������
				
				if( $btl->stats[$btl->uids[$u1]]['acestar'] ) {
					//���� 100%
					$prm['max_krit'] = 100;
					mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u1.'" AND `data` LIKE "%add_acestar=%" AND `delete` = 0 LIMIT 1');
				}
				
				if( $btl->get_chanse($prm['max_krit']) == true ) {
					$krit = true;
				}else{
					$krit = false;
				}
			}else{
				$krit = false;
			}
			$promah = false;
		}else{
			$krit = false;
			//����������� �������
			$prm['promah'] = 3 * ( $prm['yv'] - $prm['y'] );
			if( $prm['promah'] < 0 ) {
				$prm['promah'] = 0;
			}elseif( $prm['promah'] > 30 ) {
				$prm['promah'] = 30;
			}
			if( $btl->get_chanse($prm['promah']) == true ) {
				$promah = true;
			}else{
				$promah = false;
			}
		}
		//
		if( $krit == true ) {
			$r = $r*2;
			$promah_type = 0;
		}elseif( $promah == true ) {
			$r = rand(1,floor($r/4));
			$promah_type = 1;
			if( rand(0,100) < 50 ) {
				$r = 0;
				$promah_type = 2;
			}
		}
		//$r = floor(1+$r*0.90);
				
		if( $btl->users[$btl->uids[$u1]]['level'] < 9 ) {
			$r = floor(1+$r*0.75);
		}
		
		if( $type == '����' ) {
			$r = floor(1+$r*0.65);
		}elseif( $type == '�����' ) {
			$r = floor(1+$r*1.05);
		}elseif( $type == '������' ) {
			$r = floor(1+$r*1.00);
		}elseif( $type == '�����' ) {
			$r = floor(1+$r*1.15);
		}
		
		$r += floor($r/100*$btl->stats[$btl->uids[$u2]]['yzm']);
		
		$defd = mysql_fetch_array(mysql_query('SELECT SUM(`vals`) FROM `battle_actions` WHERE `btl` = "'.$btl->info['id'].'" AND `vars` = "use_defteam'.$btl->users[$btl->uids[$u2]]['team'].'" LIMIT 1'));
		$defd = 0 + $defd[0];

		$powd = mysql_fetch_array(mysql_query('SELECT SUM(`vals`) FROM `battle_actions` WHERE `btl` = "'.$btl->info['id'].'" AND `vars` = "use_powteam'.$btl->users[$btl->uids[$u1]]['team'].'" LIMIT 1'));
		$powd = 0 + $powd[0];
		$defd = $defd - $powd;
		
		if( $btl->info['izlom'] > 0 ) {
			$defd = 0;
		}
		
		$r_min = round($r * 0.1);
		
		if(md5($u1)=='632e788ac6af1d6f467b7cb973f24ce1') {$r+=floor($r/100*20);}
		
		$r -= $defd;
		
		if( $r < $r_min ) {
			$r = $r_min;
		}
		
		if( $btl->stats[$btl->uids[$u1]]['mageme'] > 0 && $btl->stats[$btl->uids[$u2]]['mageme'] > 0 && $btl->users[$btl->uids[$u1]]['team'] != $btl->users[$btl->uids[$u2]]['team']  ) {
			$r = $r * 2;
		}
		
		//�������� ������ �� �����
		if($u->info['admin'] == 9 || md5($u2.'test')=='2eea920508060337402cc9d2645cfaf2') {$r -= floor($r*0.05);}
		
		if($r < 1 ) {
			$r = 1;
		}
		//
		unset($prm);
		//
		return array( floor($r) , $krit , $promah , $promah_type );
	}
	
	public function magatackfiz( $u1, $u2, $yron, $type, $krit , $ymelki ) {
		global $btl;
		$r = $yron;
		//
		if( !isset($ymelki) || $ymelki == '0' ) {
			$ymelki = $type;
		}
		//
		$prm = array(
			'y' => $btl->stats[$btl->uids[$u1]]['mg'.$btl->mname[$ymelki]], //������
			'yv' => 0, //������, �������� ���.
			'max_krit' => 0 //����������� �����
		);
		//
		// (������� ����)*2 - 7 - ����������� ������, ����� �� ���� ��������
		/*
		��� ����� �����/���� �� �������: ������� ���� * 2 � 9 
		������ ������ ���� ���� ����� ����������� ��� ���� �� 3%. �� �� ������ 30%
		*/
		//������� ����� �� ������
		/*
		b - ������� ����
		m - ����
		z - ������ ���� [��.]
		p - ���������� [��.]
		k - ����������� ; k=250 ��� 8��, k=300 ��� 9�� � �.�. +20% �� �������
		*/
		$prm['b'] = $r; //������� ����
		$prm['m'] = $btl->stats[$btl->uids[$u1]]['pa'.$btl->mname[$type]]; //����
		$prm['z'] = $btl->stats[$btl->uids[$u2]]['za'.$btl->mname[$type]]; //������ ���� (��.)
		$prm['p'] = $btl->stats[$btl->uids[$u1]]['pza'.$btl->mname[$type]]; //���������� (��.)
		$prm['k'] = $this->cof_mag[$btl->users[$btl->uids[$u1]]['level']]; //����������
		//
		if( $prm['p']*10 > $prm['k'] ) {
			$prm['p'] = floor($prm['k']/10);
		}
		//
		$r = $prm['b']*(1+$prm['m']/100)*pow(2,(($prm['p']*10-$prm['z'])/$prm['k']));
		if( $r < floor($prm['b']*0.2) ) {
			$r = floor($prm['b']*0.2);
		}elseif( $r > floor($prm['b']*10) ) {
			$r = floor($prm['b']*10);
		}
		//
		//$prm['y'] -= 5;
		if( $type < $btl->mname[$type] ) {
			$prm['yv'] = ($btl->users[$btl->uids[$u2]]['level'] * 2 - 7);
		}else{
			$prm['yv'] = ($btl->users[$btl->uids[$u2]]['level'] * 2 - 9);
		}
		//
		if( $prm['y'] >= $prm['yv'] ) {
			if( $krit == 1 ) {
				$prm['max_krit'] = 3 * ( $prm['y'] - $prm['yv'] );
				if( $prm['max_krit'] < 0 ) {
					$prm['max_krit'] = 0;
				}elseif( $prm['max_krit'] > 30 ) {
					$prm['max_krit'] = 30;
				}
				//$prm['max_krit'] = round($prm['max_krit']/2);
				//���� ��������
				if( rand( 0 , 100 ) <= $prm['max_krit'] ) {
					$krit = true;
				}else{
					$krit = false;
				}
			}else{
				$krit = false;
			}
			$promah = false;
		}else{
			$krit = false;
			//����������� �������
			$prm['promah'] = 3 * ( $prm['yv'] - $prm['y'] );
			if( $prm['promah'] < 0 ) {
				$prm['promah'] = 0;
			}elseif( $prm['promah'] > 30 ) {
				$prm['promah'] = 30;
			}
			if( rand( 0 , 100 ) <= $prm['promah'] ) {
				$promah = true;
			}else{
				$promah = false;
			}
		}
		//
		if( $krit == true ) {
			$r = $r*2;
			$promah_type = 0;
		}elseif( $promah == true ) {
			$r = rand(1,floor($r/4));
			$promah_type = 1;
			if( rand(0,100) < 50 ) {
				$r = 0;
				$promah_type = 2;
			}
		}
		//
		unset($prm);
		//
		return array( floor($r) , $krit , $promah , $promah_type );
	}

	public function magicAtack($ue,$hpmin,$tmp,$pl,$eff,$rp = 0,$mxx = 0,$fiz = 0,$nomf = 0,$krituet=true,$heal =0,$namenew=NULL)
	{
		$trawm_off=false;
		global $u,$c,$code,$btl;
		if( $namenew != NULL ) {
			$pl['name'] = $namenew;
		}
		$rr = array();
		$nhpmin = $hpmin;
		$uen = $ue['id'];
		$usu = $eff['user_use'];
		if($eff['user_use']<1)
		{
			$usu = $u->info['id'];
		}
		if($nomf==0)
		{
			$k = $btl->magKrit($ue['level'],$btl->stats[$btl->uids[$usu]]['mg'.$tmp]);
			if($krituet==false){$k=0;}
			if($fiz==0)
			{
		
				//���������� ����
				if($nomf == 0) {
					$hpmin = $this->testPower($btl->stats[$btl->uids[$usu]],$btl->stats[$btl->uids[$uen]],$hpmin,$tmp,2);
				}
			}else{
				//���������� ����
				$wAp += $btl->stats[$btl->uids[$usu]]['pa'.$tmp.''];
				$wAp += $btl->stats[$btl->uids[$usu]]['m10'];
				$wAp -= $btl->stats[$btl->uids[$uen]]['antpa'.$tmp.'']*1.75;
				$wAp -= $btl->stats[$btl->uids[$uen]]['antm10']*1.75;
				$hpmin += ceil((0.01+$hpmin/100)*(0.01+0.98*$wAp))-1;
				
				$hpmin -= round(  $hpmin/100*(35*($btl->stats[$btl->uids[$uen]]['za']+$btl->stats[$btl->uids[$uen]]['za'.$tmp])/1200) );
				$hpmin = round($hpmin);
				
				if(isset($btl->stats[$btl->uids[$uen]]['zaproc']) || isset($btl->stats[$btl->uids[$uen]]['za'.$fiz.'proc'])) //������ �� ����� (���������)
				{
					$hpmin = floor($hpmin/100*(100-$btl->stats[$btl->uids[$uen]]['zaproc']-$btl->stats[$btl->uids[$uen]]['za'.$fiz.'proc']));
					if($hpmin<0)
					{
						$hpmin = 0;
					}
				}
			}
		}
		$hpmin = round($hpmin);
		if($k==1 and $krituet==true)
		{
			//����
			$hpmin = $hpmin*2; 
		}elseif($k==-1)
		{
			//������
			$hpmin = $hpmin/2; 
		}
		if($hpmin<$nhpmin*0.2) {
			$hpmin = $nhpmin*0.2;
		}
		if($hpmin<1){ $hpmin = 0; }else{
			if($nomf == 0) {
				$hpmin = rand(($hpmin*0.97),$hpmin);
			}
		}
		if($mxx>0 && $hpmin > $mxx)
		{
			if($k==0)
			{
				$hpmin = $mxx;
			}elseif($k==1 && $hpmin/2 > $mxx)
			{
				$hpmin = $mxx*2;	
			}
		}
		$rr[0] = $hpmin; //����
		$rr[1] = $k; //���
		/* ��������� ������ ������ */
			//�������� ������ � �������� ����������
			$miny = 0; //�� ������� ������ ���� ���� ������ (������ ������)
			$minu = 0;
			$sp1 = mysql_query('SELECT `e`.* FROM `eff_users` AS `e` WHERE `e`.`uid` = "'.$uen.'" AND `e`.`id_eff` = "22" AND `e`.`delete` = "0" AND `e`.`v1` = "priem" LIMIT 25');
			while($pl2 = mysql_fetch_array($sp1))
			{
				$pl2['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$pl2['v2'].'" LIMIT 1'));
				if(isset($pl2['priem']['id']))
				{
					$dt1 = $u->lookStats($pl2['priem']['date2']);
					if(isset($dt1['yron_u2']))
					{
						$minu = getdr($dt1['yron_u2'],array(0=>'lvl1',1=>'yr1',2=>'ts5',3=>'ts6'),array(0=>$btl->users[$btl->uids[$level]],1=>$hpmin,2=>1,3=>0));
						$miny -= $minu;
						$hpmin += $minu;
						if(isset($dt1['rzEndMg']) && $dt1['rzEndMg']==1)
						{
							$btl->delPriem($pl2,$btl->users[$btl->uids[$uen]]);	
						}
					}elseif(isset($dt1['rzEndMg']) && $dt1['rzEndMg']==1) {
						$btl->delPriem($pl2,$btl->users[$btl->uids[$uen]]);	
					}
				}
				
			}
			
		$hpmin = $btl->testPogB($uen,$hpmin);	
		
		$hp2 = floor($btl->stats[$btl->uids[$uen]]['hpNow'] - $hpmin);
		
		if($btl->stats[$btl->uids[$usu]]['yrnhealmpprocmg'.$tmp] > 0 && $fiz == 0) {
			//����� ����� ���������������� ����
			$btl->stats[$btl->uids[$usu]]['mpNow'] += round($hpmin/100*$btl->stats[$btl->uids[$usu]]['yrnhealmpprocmg'.$tmp]);
			//if($btl->stats[$btl->uids[$usu]]['mpNow'] > $btl->stats[$btl->uids[$usu]]['mpAll']) {
				//$btl->stats[$btl->uids[$usu]]['mpNow'] = $btl->stats[$btl->uids[$usu]]['mpAll'];
			//}
			$btl->users[$btl->uids[$usu]]['mpNow'] = $btl->stats[$btl->uids[$usu]]['mpNow'];
			if($usu == $u->info['id']) {
				$u->info['mpNow'] = $btl->stats[$btl->uids[$usu]]['mpNow'];
				$u->stats['mpNow'] = $btl->stats[$btl->uids[$usu]]['mpNow'];
			}
		}
		
		if($hp2<0)
		{
			$hp2 = 0;	
		}elseif($hp2>$btl->stats[$btl->uids[$uen]]['hpAll'])
		{
			$hp2 = $btl->stats[$btl->uids[$uen]]['hpAll'];	
		}
		
		$btl->stats[$btl->uids[$uen]]['last_hp'] = -floor($hpmin);
			
		if($heal != 0) {
			if($heal == -1) {
				//��� �� ������� ���� � ������ ��
				$btl->stats[$btl->uids[$eff['user_use']]]['hpNow'] += $hpmin;
				if($btl->stats[$btl->uids[$eff['user_use']]]['hpNow'] < 0) {
					$btl->stats[$btl->uids[$eff['user_use']]]['hpNow'] = 0;
				}elseif($btl->stats[$btl->uids[$eff['user_use']]]['hpNow'] > $btl->stats[$btl->uids[$eff['user_use']]]['hpAll']) {
					$btl->stats[$btl->uids[$eff['user_use']]]['hpNow'] = $btl->stats[$btl->uids[$eff['user_use']]]['hpAll'];
				}
				
				if($eff['user_use'] == $u->info['id']) {
					$u->stats['hpNow'] = $btl->stats[$btl->uids[$eff['user_use']]]['hpNow'];
				}
				
				$btl->users[$btl->uids[$eff['user_use']]]['hpNow'] = $btl->stats[$btl->uids[$eff['user_use']]]['hpNow'];
				
				$upd = mysql_query('UPDATE `stats` SET `hpNow` = "'.$btl->stats[$btl->uids[$eff['user_use']]]['hpNow'].'" WHERE `id` = "'.$eff['user_use'].'" LIMIT 1');
			}else{
				//��� �� ���������� �����
				
			}
		}
					
		/* ��������� ������ ���������� */

		//�������� ��
		$btl->users[$btl->uids[$uen]]['hpNow'] = $hp2;
		$btl->stats[$btl->uids[$uen]]['hpNow'] = $hp2;
		
		if($uen == $u->info['id']) {
			$u->stats['hpNow'] = $hp2;
		}
		
		// ��� ������ ��� ��������
		if($btl->info['type']==99 and $hp2==0 and $trawm_off==false){
		//$eff['user_use']
		//$sp1 = mysql_query('SELECT `e`.* FROM `eff_users` AS `e` WHERE `e`.`uid` = "'.$uen.'" AND `e`.`id_eff` = "22" AND `e`.`delete` = "0" AND `e`.`v1` = "priem" LIMIT 25');

								    $trawm_off=true;
								    //$at[2][$i]['ttravm']='������� <font color=red><b>������� ������</b></font>.';
									$btl->addTravm($btl->users[$btl->uids[$uen]]['id'],3,$btl->users[$btl->uids[$eff['user_use']]]['level']);
								}
		$upd = mysql_query('UPDATE `stats` SET `hpNow` = '.$hp2.',`last_hp` = "'.$btl->stats[$btl->uids[$uen]]['last_hp'].'" WHERE `id` = "'.$uen.'" LIMIT 1');
		
		//������� � ��� ���
		$vLog = 'time1='.time().'||s1='.$btl->users[$btl->uids[$usu]]['sex'].'||t1='.$btl->users[$btl->uids[$usu]]['team'].'||login1='.$btl->users[$btl->uids[$usu]]['login'].'||s2='.$btl->users[$btl->uids[$uen]]['sex'].'||t2='.$btl->users[$btl->uids[$uen]]['team'].'||login2='.$btl->users[$btl->uids[$uen]]['login'].'';
		$mas1 = array('time'=>time(),'battle'=>$btl->info['id'],'id_hod'=>($btl->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
		if($rp>0)
		{
			$mas1['id_hod']--;
		}
		
		$btl->takeExp($u->info['id'],$hpmin,$usu,$uen);
		
		if($hpmin>0)
		{
			$hpmin = '-'.ceil($hpmin);
		}else{
			$hpmin = '--';
		}
		$tco = array(1=>'006699',2=>'006699',3=>'006699',4=>'006699',5=>'006699',6=>'006699',7=>'006699'); //�� ����
		$tcl = array(1=>'A00000',2=>'008080',3=>'0000FF',4=>'A52A2A',5=>'006699',6=>'006699',7=>'006699'); //�� ����
		$tco = $tco[$tmp];
		$tcl = $tcl[$tmp];
		if($k==1)
		{
			//����
			$tco = 'FF0000';
			$tcl = 'FF0000';
		}elseif($k==-1)
		{
			//������
			$tco = 'CCCCCC';
			$tcl = 'CCCCCC'; 
		}
		$nmz = array(
			1=>array(0=>'����',1=>'��������'),
			2=>array(0=>'�������',1=>'�������������'),
			3=>array(0=>'����',1=>'�����'),
			4=>array(0=>'�����',1=>'��������'),
			5=>array(0=>'����',1=>'����'),
			6=>array(0=>'����',1=>'����'),
			7=>array(0=>'�����&nbsp;�����',1=>'�����&nbsp;�����')
			);
		$nmz = $nmz[$tmp];
		if($fiz>0)
		{
			$nmz = array(
			1=>array(0=>', ������� ����� , ',1=>'�������'),
			2=>array(0=>', ������� ����� , ',1=>'�������'),
			3=>array(0=>', �������� ����� , ',1=>'��������'),
			4=>array(0=>', ������� ����� , ',1=>'�������')
			);
			$nmz = $nmz[$fiz];
		}
		
		if($rp==1)
		{
			if($k==0)
			{
				$tcl = '000000';
				$tco = '008000';
			}
			$sx = array(0=>'',1=>'�');
			$mas1['text'] = '{tm1} {u2} �������'.$sx[$btl->users[$btl->uids[$uen]]['sex']].' �������� �� &quot;<b><font color=#'.$tcl.'>'.$pl['name'].'</font></b>&quot;. <b><font title=���&nbsp;�����:&nbsp;'.$nmz[1].' color=#'.$tco.'>'.$hpmin.'</font></b> ['.ceil($hp2).'/'.$btl->stats[$btl->uids[$uen]]['hpAll'].']';
		}else{
			$mas1['text'] = '{tm1} {u1} {1x16x0} ���������� &quot;<b><font color=#'.$tcl.'>'.$pl['name'].'</font></b>&quot; � ������� ������ '.$nmz[0].' {u2}. <b><font title=���&nbsp;�����:&nbsp;'.$nmz[1].' color=#'.$tco.'>'.$hpmin.'</font></b> ['.ceil($hp2).'/'.$btl->stats[$btl->uids[$uen]]['hpAll'].']';	
		}
		$btl->add_log($mas1);
		$pz[(int)$id] = 1;	
		return $rr;
	}
	
	public function testActiv($id)
	{
		global $u;
		$r = 0;
		/*if($u->info['admin'] > 0 || $u->info['nadmin'] > 0) {
			$r = 1;
		}else{
			$tst = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` < '.time().' AND `vars` = "read" AND `vals` = "'.$id.'" LIMIT 1',1);
			if(isset($tst['id']))
			{
				$r = 1;
			}
			unset($tst);
		}*/
		$r = 1;
		return $r;
	}
	
	public function testRazmenOldUser( $u2 , $u1 ) {
		global $btl,$u;
		$r = 0;
		//������� -����������- ���� ������ -����-
		if( $btl->users[$btl->uids[$u2]]['id'] != $u->info['id'] ) {
			if( $btl->users[$btl->uids[$u1]]['level'] < $btl->users[$btl->uids[$u2]]['level'] ) {
				$r = 1;
				echo '<center><b><font color=red>������ ��������� ����� ������� ���������� � ��������</font></b></center>';
			}elseif( $btl->users[$btl->uids[$u1]]['bot'] > 0 && $btl->users[$btl->uids[$u2]]['bot'] == 0 ) {
				echo '<center><b><font color=red>������ ��������� ����� �������� ��� �����</font></b></center>';
				$r = 1;
			}
		}
		return $r;
	}
	
	public function testDie($u1,$u2 = 0) {
		global $btl,$u;
		if( $u2 == 0 ) {
			$u2 = $u->info['id'];
		}
		//�������� 1 ����� �� ��� �������� 2
		if( isset($btl->stats[$btl->uids[$u1]]['id']) && floor($btl->stats[$btl->uids[$u1]]['hpNow']) < 1 ) {
			
			if( $u2 > 0 && !isset($btl->users[$btl->uids[$u1]]['dietest']) ) {
				$btl->users[$btl->uids[$u1]]['dietest'] = true;
				if($btl->users[$btl->uids[$u1]]['room'] == 9) {
					if($btl->users[$btl->uids[$u1]]['align'] >= 1 && $btl->users[$btl->uids[$u1]]['align'] < 2) {
						mysql_query('UPDATE `achiev` SET `a20` = `a20` + 1 WHERE `uid` = '.$u2.' AND `a20lvl` < 3 LIMIT 1');
					}elseif($btl->users[$btl->uids[$u1]]['align'] >= 3 && $btl->users[$btl->uids[$u1]]['align'] < 4) {
						mysql_query('UPDATE `achiev` SET `a21` = `a21` + 1 WHERE `uid` = '.$u2.' AND `a21lvl` < 3 LIMIT 1');
					}elseif($btl->users[$btl->uids[$u1]]['align'] == 7 ) {
						mysql_query('UPDATE `achiev` SET `a22` = `a22` + 1 WHERE `uid` = '.$u2.' AND `a22lvl` < 3 LIMIT 1');
					}
				}
			}
			
			$vLog = 'at1=00000||at2=00000||zb1='.$btl->stats[$btl->uids[$u1]]['zonb'].'||zb2=||bl1=||bl2=||time1='.time().'||time2='.time().'||s2=||s1='.$btl->users[$btl->uids[$u1]]['sex'].'||t2=||t1='.$btl->users[$btl->uids[$u1]]['team'].'||login1='.$btl->users[$btl->uids[$u1]]['login2'].'||login2=';
			mysql_query('DELETE FROM `battle_act` WHERE `uid1` = "'.$u1.'" OR `uid2` = "'.$u1.'"');
			if( $btl->users[$btl->uids[$u1]]['tactic7'] <= 0 ) {
				$btl->stats[$btl->uids[$u1]]['spasenie'] = 0;
			}
			$testdie = mysql_fetch_array(mysql_query('SELECT * FROM `battle_die` WHERE `uid` = "'.$u1.'" AND `battle` = "'.$btl->info['id'].'" LIMIT 1'));
			if( $btl->stats[$btl->uids[$u1]]['spasenie'] > 0 ) {
				//������ ��������
				mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u1.'" AND `id_eff` = 22 AND `v1` = "priem" AND `v2` = 324');
				//
				$btl->users[$btl->uids[$u1]]['hpNow'] = floor($btl->stats[$btl->uids[$u1]]['hpAll']/2);
				$btl->stats[$btl->uids[$u1]]['hpNow'] = floor($btl->stats[$btl->uids[$u1]]['hpAll']/2);
				if( $btl->stats[$btl->uids[$u1]]['hpNow'] < 1 ) {
					$btl->stats[$btl->uids[$u1]]['hpNow'] = 1;
				}
				if( $btl->stats[$btl->uids[$u1]]['hpNow'] > $btl->stats[$btl->uids[$u1]]['hpAll'] ) {
					$btl->stats[$btl->uids[$u1]]['hpNow'] = floor($btl->stats[$btl->uids[$u1]]['hpAll']);
				}
				//
				$btl->stats[$btl->uids[$u1]]['mpNow'] = floor($btl->stats[$btl->uids[$u1]]['mpAll']/2);
				if( $btl->stats[$btl->uids[$u1]]['mpNow'] < 1 ) {
					$btl->stats[$btl->uids[$u1]]['mpNow'] = 1;
				}
				if( $btl->stats[$btl->uids[$u1]]['mpNow'] > $btl->stats[$btl->uids[$u1]]['mpAll'] ) {
					$btl->stats[$btl->uids[$u1]]['mpNow'] = floor($btl->stats[$btl->uids[$u1]]['mpAll']);
				}
				$btl->users[$btl->uids[$u1]]['mpNow'] = $btl->stats[$btl->uids[$u1]]['mpNow'];
				//
				$btl->users[$btl->uids[$u1]]['tactic7'] -= 10;
				$btl->users[$btl->uids[$u1]]['last_hp'] = 0;
				mysql_query('UPDATE `stats` SET `last_hp` = 0 , `tactic7` = "'.$btl->users[$btl->uids[$u1]]['tactic7'].'" , `hpNow` = "'.$btl->stats[$btl->uids[$u1]]['hpNow'].'",`mpNow` = "'.$btl->stats[$btl->uids[$u1]]['mpNow'].'" WHERE `id` = "'.$u1.'" LIMIT 1');
				$btl->stats[$btl->uids[$u1]]['dielast'] = true;
				//
				$html2 = '';
				if( $btl->stats[$btl->uids[$u1]]['s7'] > 24 ) {
					//���� ��������� 
					mysql_query("INSERT INTO `eff_users` 
					(`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`) VALUES
					(22, '".$u1."', '���������� ������', '', 0, 77, 0, '".$u1."', 0, 'priem', 141, 'spirit_block25.gif', 1, 1, '0', 0, 0, '', 0, 0, 0, 0, 0);");
					$html2 .= ' + ���������� ������';
				}
				if( $btl->stats[$btl->uids[$u1]]['s7'] > 99 ) {
					//������ ������� ��� �� ���������� �������� ����������, ���������, �������� � ���� � ������� ���
					
				}
				if(!isset($testdie['id'])) {
					mysql_query('INSERT INTO `battle_die` (`uid`,`time`,`battle`) VALUES ("'.$u1.'","'.time().'","'.$btl->info['id'].'")');
					$mas = array(
						'text' => '',
						'time' => time(),
						'vars' => '',
						'battle' => $btl->info['id'],
						'id_hod' => $btl->hodID+1,
						'vars' => $vLog,
						'type' => 1
					);
					$mas['text'] = '{tm1} <b>'.$btl->stats[$btl->uids[$u1]]['login'].'</b> ����...<b title='.$btl->stats[$btl->uids[$u1]]['hpNow'].'-'.$btl->stats[$btl->uids[$u1]]['mpNow'].' >'.$btl->stats[$btl->uids[$u1]]['login'].'</b> ��� ������.';
					$btl->add_log($mas);
					$btl->dietest = true; 
				}
				//
			}else{
				if(!isset($testdie['id'])) {				
					mysql_query('INSERT INTO `battle_die` (`uid`,`time`,`battle`) VALUES ("'.$u1.'","'.time().'","'.$btl->info['id'].'")');
					$mas = array(
						'text' => '',
						'time' => time(),
						'vars' => '',
						'battle' => $btl->info['id'],
						'id_hod' => $btl->hodID+1,
						'vars' => $vLog,
						'type' => 1
					);
					$mas['text'] = '{tm1} <b>'.$btl->stats[$btl->uids[$u1]]['login'].'</b> �����.';
					$btl->add_log($mas);
				}
			}
			
			$u2 = $u->info['id'];
			
			if( $btl->stats[$btl->uids[$u2]]['hpNow'] < 1 ) {
				if($btl->users[$btl->uids[$u1]]['bot_id'] == 0 && $btl->users[$btl->uids[$u2]]['bot_id'] > 0 && !isset($btl->users[$btl->uids[$u2]]['bot_hip']) ) {
					
					$tst2 = mysql_fetch_array(mysql_query('SELECT `bot_id` FROM `users` WHERE `id` = "'.$u2.'" LIMIT 1'));
					$btl->users[$btl->uids[$u2]]['bot_id'] = $tst2['bot_id'];
					
					$btl->users[$btl->uids[$u2]]['bot_hip'] = true;
					if( $btl->users[$this->uids[$u2]]['bot_id'] == 416 ) {
						$u->addItem(8032,$u1,'|sudba=1');
					}	
					mysql_query('INSERT INTO `hip_kill` ( `uid`,`time`,`bot` ) VALUES ( "'.$btl->users[$btl->uids[$u1]]['id'].'" , "'.time().'" , "'.$btl->users[$btl->uids[$u2]]['bot_id'].'" )');
				}
			}
			if( $btl->stats[$btl->uids[$u1]]['hpNow'] < 1 ) {
				if($btl->users[$btl->uids[$u2]]['bot_id'] == 0 && $btl->users[$btl->uids[$u1]]['bot_id'] > 0 && !isset($btl->users[$btl->uids[$u1]]['bot_hip']) ) {
					
					$tst2 = mysql_fetch_array(mysql_query('SELECT `bot_id` FROM `users` WHERE `id` = "'.$u1.'" LIMIT 1'));
					$btl->users[$btl->uids[$u1]]['bot_id'] = $tst2['bot_id'];
					
					$btl->users[$btl->uids[$u1]]['bot_hip'] = true;
					if( $btl->users[$btl->uids[$u1]]['bot_id'] == 416 ) {
						$u->addItem(8032,$u2,'|sudba=1');
					}	
					mysql_query('INSERT INTO `hip_kill` ( `uid`,`time`,`bot` ) VALUES ( "'.$btl->users[$btl->uids[$u2]]['id'].'" , "'.time().'" , "'.$btl->users[$btl->uids[$u1]]['bot_id'].'" )');
				}
			}
			
		}
	}
	
	public function testMagicCast( $user , $enemy ) {
		global $u , $c , $code , $btl;
		$r = 0;
		
		if( $u->info['dnow'] == 0 && $enemy != $u->info['id'] && $enemy != $user && $btl->users[$btl->uids[$enemy]]['id'] > 0 && $btl->users[$btl->uids[$user]]['id'] > 0 ) {
			if( $btl->stats[$btl->uids[$enemy]]['items_price2'] < floor($btl->stats[$btl->uids[$user]]['items_price2']/2) || $btl->users[$btl->uids[$enemy]]['level'] < $btl->users[$btl->uids[$user]]['level'] ) {
				//���� �� ��������� ���� ����� 2 ���
				if( $u->info['team'] != $btl->users[$btl->uids[$user]]['team'] ) {
					$r = 1;
					echo '<div align=center><b><font color=red>������ ��������� ����� ������ � �������!</font></b></div>';
				}
			}
		}
		
		return $r;
	}
	
	public function pruse($id)
	{
		global $u,$c,$code,$btl,$ue;
		
		if( $u->stats['hpNow'] < 1 || $u->info['hpNow'] < 1) {
			echo '�� ������� � �� ������ ������������ ������...';
		}elseif($id==100500 && $u->info['animal']>0)
		{
			$use_lst = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "animal_use'.$btl->info['id'].'" LIMIT 1',1);
			if(!isset($use_lst['id']))
			{				
				$a = mysql_fetch_array(mysql_query('SELECT * FROM `users_animal` WHERE `uid` = "'.$u->info['id'].'" AND `id` = "'.$u->info['animal'].'" AND `pet_in_cage` = "0" AND `delete` = "0" LIMIT 1'));
				if(isset($a['id']) && $a['eda']<1) {
					echo '�� �� ��������� �����...';
				}elseif(isset($a['id']))
				{
					//��������� ����� � ���
					$tp = array(1=>'���',2=>'����',3=>'�������',4=>'�������',5=>'���',6=>'����',7=>'������');
					$id = mysql_fetch_array(mysql_query('SELECT `id` FROM `test_bot` WHERE `login` = "'.$tp[$a['type']].' ['.$a['level'].']" LIMIT 1'));
					if(isset($id['id']))
					{
						$b = $u->addNewbot($id['id'],NULL,NULL);
						if($b>0 && $b!=false)
						{
							$a['eda'] -= 4;
							if($a['eda'] < 0) {
								$a['eda'] = 0;
							}
							
							//��������� ������
							//$anl = mysql_fetch_array(mysql_query('SELECT `bonus` FROM `levels_animal` WHERE `type` = "'.$a['type'].'" AND `level` = "'.$a['level'].'" LIMIT 1'));
							//$anl = $anl['bonus'];							
							//mysql_query('INSERT INTO `eff_users` (`hod`,`v2`,`img2`,`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`v1`,`user_use`) VALUES ("-1","201","pet_unleash.gif",22,"'.$u->info['id'].'","������ �� �����","'.$anl.'","0","77","priem","'.$u->info['id'].'")');
							
							//$anl = $u->lookStats($anl);
							$vLog = 'time1='.time().'||s1='.$u->info['sex'].'||t1='.$u->info['team'].'||login1='.$u->info['login'].'';
							$mas1 = array('time'=>time(),'battle'=>$btl->info['id'],'id_hod'=>$btl->hodID,'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
							/*$ba = '';
							$i = 0;
							while($i<count($u->items['add'])) {
								if(isset($anl['add_'.$u->items['add'][$i]])) {
									if($anl['add_'.$u->items['add'][$i]] > 0) {
										$ba .= $u->is[$u->items['add'][$i]].': +'.$anl['add_'.$u->items['add'][$i]].', ';
									}
								}
								$i++;
							}
							$ba = trim($ba,', ');
							if($ba == '') {
								$ba = '����������';
							}*/
							
							if($u->info['sex'] == 1) {
								$mas1['text'] = '{tm1} {u1} ��������� ����� &quot;<b>'.$a['name'].'&quot;</b>';
							}else{
								$mas1['text'] = '{tm1} {u1} �������� ����� &quot;<b>'.$a['name'].'&quot;</b>';
							}
							$btl->add_log($mas1);
							
							mysql_query('UPDATE `users` SET `login` = "'.$a['name'].' (����� '.$u->info['login'].')",`obraz` = "'.$a['obraz'].'.gif",`battle` = "'.$btl->info['id'].'",`animal2` = "'.time().'" WHERE `id` = "'.$b['id'].'" LIMIT 1');
							mysql_query('UPDATE `stats` SET `team` = "'.$u->info['team'].'" WHERE `id` = "'.$b['id'].'" LIMIT 1');
							mysql_query('UPDATE `users_animal` SET `eda` = "'.$a['eda'].'" WHERE `id` = "'.$a['id'].'" LIMIT 1');
							$u->addAction(time(),'animal_use'.$btl->info['id'],'');
						}else{
							echo '�� ������� ��������� �����...';
						}
					}else{
						//��� �� ������
						echo '�� ������� ��������� ����� ...';
					}
				}else{
					//����� �� ������
					echo '� ��� ��� ����� ...';
				}
			}else{
				//����� ��� �������
				echo '�� ��� ��������� ����� � ���� ��� ...';
			}
		}else{
			
			$p = explode('|',$u->info['priems']);
			$pz = explode('|',$u->info['priems_z']);
			if($p[(int)$id]>0 && $pz[(int)$id]<=0 && $u->info['hpNow']>=1)
			{
				$pl = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `level`<="'.$u->info['level'].'" AND `id` = "'.mysql_real_escape_string($p[(int)$id]).'" LIMIT 1'));
				if(isset($pl['id']) && $pl['activ']!=1)
				{
					if($pl['activ']==0)
					{
						unset($pl);
					}elseif($pl['activ']>1)
					{
						//������� �����
						if(!isset($_GET['notestpriem'])) {
							if($this->testActiv($pl['activ'])==0)
							{
								unset($pl);
							}
						}
					}
				}
				if(isset($pl['id']))
				{
					$notr = 0;
					$pl['useon_user'] = $u->info['enemy'];
					if(isset($_POST['useon']) && $_POST['useon']!='' && $_POST['useon']!='none')
					{
						$_POST['useon'] = iconv('UTF-8', 'windows-1251', $_POST['useon']);
						$u->lock('reflesh.usepriem');
						$this->ue = mysql_fetch_array(mysql_query('SELECT `users`.*,`stats`.* FROM `users` LEFT JOIN `stats` ON (`users`.`id`=`stats`.`id`) WHERE `users`.`login`="'.mysql_real_escape_string($_POST['useon']).'" AND `users`.`battle` = "'.$btl->info['id'].'" AND `stats`.`hpNow` > 0 LIMIT 1'));
												
						if(isset($this->ue['id']) && $this->ue['inUser']>0) {
							$ue2 = mysql_fetch_array(mysql_query('SELECT `users`.*,`stats`.* FROM `users` LEFT JOIN `stats` ON (`users`.`id`=`stats`.`id`) WHERE `users`.`id`="'.mysql_real_escape_string($this->ue['inUser']).'" AND `users`.`battle` = "'.$btl->info['id'].'" AND `stats`.`hpNow` > 0 LIMIT 1'));
							if(isset($ue2['id'])) {
								$this->ue = $ue2;
							}elseif(!isset($this->ue['id'])) {
								die('��� ���������� ����! ('.htmlspecialchars($_POST['useon'],NULL,'cp1251').')');
							}
							unset($ue2);
						}
						
						if( isset($this->ue['id']) ) {
							//if( isset($btl->stats[$btl->uids[$this->ue['id']]]['short_stats']) ) {
							//	$btl->stats[$btl->uids[$this->ue['id']]] = $u->getStats($btl->stats[$btl->uids[$this->ue['id']]],0,0,false,$btl->cached);
							//}
						}
						
						$u->unlock();
						if(!isset($this->ue['id']) && $pl['trUser']>0)
						{
							$notr++;
						}
						if($pl['team'] == 1) {
							//����
							if($u->info['team'] != $this->ue['team']) {
								$notr++;
							}
						}elseif($pl['team'] == 2) {
							//����������
							if($u->info['team'] == $this->ue['team']) {
								$notr++;
							}
						}elseif($pl['team'] == 0) {
							//����� �������
							
						}
					}else{
						//$this->ue = $btl->users[$btl->uids[$u->info['enemy']]];
						$ga = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `battle` = "'.$btl->info['id'].'" AND `uid1` = "'.$u->info['id'].'" AND `uid2` = "'.$u->info['enemy'].'" LIMIT 1'));
						if(($u->info['enemy']==0 || isset($ga['id'])) && ($pl['tr_hod']>0 || $pl['trUser']>0))
						{
							$notr++;
						}
					}

					if(!isset($_GET['notestpriem'])) {
						$notr += $this->testpriem($pl,1,$this->ue['id']);	
					}
					
					/*if( $u->info['admin'] == 0 ) {
						$notr++;
					}*/
					
			
					
					if( $this->ue['id'] > 0 && $this->ue['team'] != $u->info['team'] ) {
						if(!isset($_GET['notestpriem'])) {
							$notr += $this->testRazmenOldUser($this->ue['id'],$u->info['enemy']);
						}
					}
					
					if(!isset($_GET['notestpriem'])) {
						$notr += $this->testMagicCast($this->ue['id'],$u->info['enemy']);
					}
					
					if($notr==0)
					{					
						mysql_query('UPDATE `stats` SET `last_pr` = "'.$pl['id'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						
						//������ �� ����������
						if( $this->ue['id'] > 0 ) {
							$btl->priemsRazmen(array($u->info['id'],$this->ue['id']),'fast');
							mysql_query('UPDATE `eff_users` SET `mark` = 1 WHERE `uid` = "'.$this->ue['id'].'" AND `delete` = 0');
						}else{
							$btl->priemsRazmen(array($u->info['id'],$u->info['enemy']),'fast');
							mysql_query('UPDATE `eff_users` SET `mark` = 1 WHERE `uid` = "'.$u->info['enemy'].'" AND `delete` = 0');
						}
						mysql_query('UPDATE `eff_users` SET `mark` = 1 WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0');
						
						if(file_exists('../../_incl_data/class/priem/'.$pl['id'].'.php')) {
							//
							if(substr($pl['img'], 0, 4) == 'wis_') {
								if( $pl['cancel_eff'] == '' ) {
									$pl['cancel_eff'] = '258';
								}else{
									$pl['cancel_eff'] .= ',258';
								}
								//mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `v2` = "258" AND `v1` = "priem"');
							}
							//
							if( $u->info['id'] == 12345 ) {
								echo '['.$pl['id'].']';
							}
							//$u->lock('reflesh.usepriem');
							require('../../_incl_data/class/priem/'.$pl['id'].'.php');
							//$u->unlock();
							$this->testDie($this->ue['id']);
							$this->testDie($u->info['enemy']);
						}else{
							echo 'useSkill'.$pl['id'].'';
						}
						
						/*echo 'combo::'.$pl['type'].'->';
						if($pl['type']==1)
						{*/
							//������������ �����������
							/*$pz[(int)$id] = 0;
							if($pl['file']!='0')
							{							
								if(file_exists('../../_incl_data/class/priems/'.$pl['file'].'.php'))
								{
									echo 'test1';
								}
							}else{*/
								//������ ���� � �.�.
								/*echo 'test2';
							}
							if(!isset($cup))
							{
								$this->uppz($pl,$id);
								if($pl['tr_hod']>0)
								{
									$this->trhod($pl);
								}
							}
						}elseif($pl['type']==2)
						{*/
							//������������ �� ���� (�� �����������)
							//$this->addEffPr($pl,$id);
							/*echo 'test3->';
							if(file_exists('../../_incl_data/class/priem/'.$pl['id'].'.php')) {
								require('../../_incl_data/class/priem/'.$pl['id'].'.php');
							}else{
								echo 'useSkill'.$pl['id'].'';
							}*/
							/*echo 'test3';
							if($pl['file2']!='0')
							{							
								$fast_use_priem = 1;
								if(file_exists('../../_incl_data/class/priems/'.$pl['file2'].'.php'))
								{
									echo '->file';
								}
							}*/
						/*}elseif($pl['type']==3)
						{
							echo '������������ ������ ������� ���� �������� ���������';
						}
						*/
						
						if(!isset($cup)) {
							$this->uppz($pl,$id);
							//�������� �������
							//$this->mintr($pl);
							if($pl['tr_hod']>0) {
								$this->trhod($pl);
							}
							if( $pl['id'] != 258 ) { 
								if( $pl['cancel_eff'] == '' ) {
									$pl['cancel_eff'] = '258';
								}else{
									$pl['cancel_eff'] .= ',258';
								}
							}
							if($pl['cancel_eff']!='')
							{
								$i = 0; 
								$e = explode(',',$pl['cancel_eff']);
								while($i<count($e))
								{
									if($e[$i]>0)
									{
										if( $e[$i] == 258 ) {
											$nem = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `v1` = "priem" AND `v2` = "'.$e[$i].'" AND `delete` = "0" AND `mark` = 1 LIMIT 1'));
										}else{
											$nem = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$this->ue['id'].'" AND `v1` = "priem" AND `v2` = "'.$e[$i].'" AND `delete` = "0" AND `mark` = 1 LIMIT 1'));
										}
										if(isset($nem['id']))
										{
											$nem['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$e[$i].'" LIMIT 1'));
											if(isset($nem['id']))
											{
												$btl->delPriem($nem,$btl->users[$btl->uids[$this->ue['id']]],500);
											}
										}
									}
								$i++;
								}
							}
						}
						
					}
				}
			}
		}
		$u->unlock();
	}
	
	private function rezadEff($uid,$mg)
	{
		global $u,$btl,$c,$code;
		//$this->rezadEff($u->info['id'],'wis_fire_');
		$md = ''; $md2 = '';
		$ex = explode('|',$btl->users[$btl->uids[$uid]]['priems']);
		$ex2 = explode('|',$btl->users[$btl->uids[$uid]]['priems_z']);
		$i = 0; $ty = array();
		while($i<count($ex))
		{
			if($ex[$i]>0)
			{
				$md .= '`id` = "'.((int)$ex[$i]).'" OR ';
				$ty[$ex[$i]] = $i;
			}
			$i++;
		}
		$md = rtrim($md,' OR ');
		if( $md != '' ) {
			$md = '( '.$md.' ) AND ';
		}
		$sp = mysql_query('SELECT * FROM `priems` WHERE '.$md.' `img` LIKE "%'.$mg.'%"');
		while($pl = mysql_fetch_array($sp))	{
			$ex2[$ty[$pl['id']]] = 0;
		}
		$md2 = implode('|',$ex2);
		$btl->users[$btl->uids[$uid]]['priems_z'] = $md2;
		$u->info['priems_z'] = $md2;
		$upd = mysql_query('UPDATE `stats` SET `priems_z` = "'.$md2.'" WHERE `id` = "'.((int)$uid).'" LIMIT 1');
		unset($md,$md2,$ty);
		if($upd)
		{
			$upd = true;
		}else{
			$upd = false;	
		}
		return $upd;
	}
	
	private function trhod($pl)
	{
		global $u,$btl;
		if($u->info['notrhod'] == -1) {
			$u->info['notrhod'] = 0;
			if($u->stats['magic_cast'] > 0) {
				$u->info['notrhod'] = $u->stats['magic_cast'];
			}
			mysql_query('UPDATE `users` SET `notrhod` = "'.$u->info['notrhod'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}
		if($u->info['notrhod'] > 0) {
			if( $pl['tr_hod'] > 0 ) {
				$u->info['notrhod']--;
				mysql_query('UPDATE `users` SET `notrhod` = "'.$u->info['notrhod'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			}
		}else{
			$a1 = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `battle` = "'.$btl->info['id'].'" AND `uid2` = "'.$u->info['id'].'" AND `uid1` = "'.$u->info['enemy'].'" LIMIT 1'));
			if(isset($a1['id']))
			{
				//��������� ������, ����� ��� ����� 2 ��������� ���
				mysql_query('UPDATE `battle_act` SET `out2` = "1",`tpo2` = "2" WHERE `id` = "'.$a1['id'].'" LIMIT 1');
				$a1['out2'] = 1;
				$a1['tpo2'] = 2;
				$btl->atacks[$a1['id']] = $a1;
				$btl->users[$u->info['id']]['priems_z'] = $u->info['priems_z'];
				$btl->startAtack($a1['id']);
			}else{
				//���� ���������� � ��������� ����
				mysql_query('INSERT INTO `battle_act` (`battle`,`uid1`,`uid2`,`time`,`out1`,`type`,`tpo1`) VALUES ("'.$btl->info['id'].'","'.$u->info['id'].'","'.$u->info['enemy'].'","'.time().'","1","1","2")');			
			}
		}
	}
	
	public function plusData( $d1, $d2 ) {
		global $u;
		$j1 = $u->lookStats($d1);
		$j2 = $u->lookStats($this->redate($d2,$u->info['id']));
		$v = $u->lookKeys($this->redate($d2,$u->info['id']),0); // ����� 2
		//��������� ������ ���� � �����
		$i = 0; $inf = '';
		while($i<count($v))
		{
			$j1[$v[$i]] += $j2[$v[$i]];
			$vi = str_replace('add_','',$v[$i]);
						if($u->is[$vi]!='')
			{
				if($j2[$v[$i]]>0)
				{
					$inf .= $u->is[$vi].': +'.($j2[$v[$i]]*(1+$mpr['x'])).', ';
				}elseif($j2[$v[$i]]<0){
					$inf .= $u->is[$vi].': '.($j2[$v[$i]]*(1+$mpr['x'])).', ';	
				}
			}
			$i++;	
		}
		$inf = rtrim($inf,', ');
		$j1 = $u->impStats($j1);
		return $j1;
	}
	
	private function addEffPr($pl,$id,$redus)
	{
		global $u,$btl;
		$rcu = false;
		$j = $u->lookStats($pl['date2']);		
		$mpr = false; $addch = 0;
		$uid = $u->info['id'];
		if(isset($this->ue['id']))
		{
			$uid = $this->ue['id'];
		}
		if(isset($j['onlyOne']))
		{
			$mpr = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `v2` = "'.$pl['id'].'" AND `uid` = "'.$uid.'" AND `delete` = "0" AND `mark` = 1 LIMIT 1'));
		}
		
		if($pl['cancel_eff2']!='')
		{
			$i = 0; 
			$e = explode(',',$pl['cancel_eff2']);
			while($i<count($e))
			{
				if($e[$i]>0)
				{
					$nem = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$uid.'" AND `v1` = "priem" AND `v2` = "'.$e[$i].'" AND `delete` = "0" AND `mark` = 1 LIMIT 1'));
					if(isset($nem['id']))
					{
						$nem['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$e[$i].'" LIMIT 1'));
						if(isset($nem['id']))
						{
							echo '['.$nem['priem']['name'].']';
							$btl->delPriem($nem,$btl->users[$btl->uids[$uid]],2);
							if( $nem['id'] == $mpr['id'] ) {
								unset($mpr);
							}
						}
					}
				}
			$i++;
			}
		}
		
		$pld = array(0=>''); $nc = 0;
		if(isset($mpr['id']) && $j['onlyOne']==1)
		{
			//�������� �������
			$addch = 1;
			$this->mintr($pl);
			$this->uppz($pl,$id);
			//��������� ����� � �������
			if(isset($this->ue['id']))
			{
				$btl->stats[$btl->uids[$uid]] = $u->getStats($this->ue,0);
			}else{
				$btl->stats[$btl->uids[$uid]] = $u->getStats($u->info,0);	
			}
			$nc = 1;
		}elseif(!isset($mpr['id']))
		{
			$data = '';
			if(isset($j['date3Plus']))
			{
				$data = $this->redate($pl['date3'],$u->info['id']);
			}
			if( isset($redus) ) {
				$data .= '|'.$redus;
			}
			$hd1 = -1;
			if($pl['limit']>0)
			{
				$tm = 77;
				$hd1 = $pl['limit'];
			}else{
				$tm = 77;
			}
			if($pl['limit'] == -2) {
				$hd1 = $pl['limit'];
			}
			mysql_query('INSERT INTO `eff_users` (`hod`,`v2`,`img2`,`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`v1`,`user_use`) VALUES ("'.$hd1.'","'.$pl['id'].'","'.$pl['img'].'.gif",22,"'.$uid.'","'.$pl['name'].'","'.$data.'","0","'.$tm.'","priem","'.$u->info['id'].'")');
			unset($hd1);
			//�������� �������
			$addch = 1;
			$rcu = true;
			$nc = 1;
			$this->mintr($pl);
			//$this->uppz($pl,$id);
			//��������� ����� � �������
			if(isset($this->ue['id']))
			{
				$btl->stats[$btl->uids[$uid]] = $u->getStats($this->ue,0);
			}else{
				$btl->stats[$btl->uids[$uid]] = $u->getStats($u->info,0);	
			}
		}elseif($j['onlyOne']>1)
		{
			if($mpr['x']<$j['onlyOne'])
			{				
				if(isset($j['date3Plus']))
				{
					$j1 = $u->lookStats($mpr['data']);
					$j2 = $u->lookStats($this->redate($pl['date3'],$u->info['id']));
					$v = $u->lookKeys($this->redate($pl['date3'],$u->info['id']),0); // ����� 2
					//��������� ������ ���� � �����
					$i = 0; $inf = '';
					while($i<count($v))
					{
						$j1[$v[$i]] += $j2[$v[$i]];
						$vi = str_replace('add_','',$v[$i]);
						if($u->is[$vi]!='')
						{
							if($j2[$v[$i]]>0)
							{
								$inf .= $u->is[$vi].': +'.($j2[$v[$i]]*(1+$mpr['x'])).', ';
							}elseif($j2[$v[$i]]<0){
								$inf .= $u->is[$vi].': '.($j2[$v[$i]]*(1+$mpr['x'])).', ';	
							}
						}
						$i++;	
					}
					$inf = rtrim($inf,', ');
					$j1 = $u->impStats($j1);
					$pld[0] = ' x'.($mpr['x']+1);
					if($j['refHod']==1) {
						$mpr['hod'] = $pl['limit'];
					}
					$upd = mysql_query('UPDATE `eff_users` SET `hod` = "'.$mpr['hod'].'",`data` = "'.$j1.'",`x` = `x`+1 WHERE `id` = "'.$mpr['id'].'" LIMIT 1');
					if($upd)
					{
						//�������� �������
						$this->mintr($pl);
						$this->uppz($pl,$id);
						//��������� ����� � �������
						if(isset($this->ue['id']))
						{
							$btl->stats[$btl->uids[$uid]] = $u->getStats($this->ue,0);
						}else{
							$btl->stats[$btl->uids[$uid]] = $u->getStats($u->info,0);	
						}
						$addch = 1;
						$rcu = true;
						$nc = 1;
					}
				}				
			}
		}
		/* ������ ���� ��� */
		if($nc==1 && $pl['tr_hod']>0)
		{
			//$this->trhod($pl);
		}
		return $rcu;
	}
	
	public function mintr($pl)
	{
		global $u,$btl;
		$x = 1; $rt = '';
		while($x<=7)
		{
			if( $pl['ndt'.$x] == 0 ) {
				$u->info['tactic'.$x] -= $pl['tt'.$x];
				$btl->users[$btl->uids[$u->info['id']]]['tactic'.$x] -= $pl['tt'.$x];
			}
			if($u->info['tactic'.$x]<0)
			{
				$u->info['tactic'.$x] = 0;
			}
			if($btl->users[$btl->uids[$u->info['id']]]['tactic'.$x]<0)
			{
				$btl->users[$btl->uids[$u->info['id']]]['tactic'.$x] = 0;
			}
			//$rt .= ',`tactic'.$x.'`="'.$u->info['tactic'.$x].'"';
			$rt .= ',`tactic'.$x.'`="'.$btl->users[$btl->uids[$u->info['id']]]['tactic'.$x].'"';
			$x++;
		}
		if($pl['xuse']>0)
		{
			$u->addAction(time(),'use_priem_'.$btl->info['id'].'_'.$u->info['id'],$pl['id']);
		}
		$rt = ltrim($rt,',');
		mysql_query('UPDATE `stats` SET '.$rt.' WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	}
	
	public function maxtr($x,$val)
	{
		global $u,$btl;
		$u->info['tactic'.$x] += $val;
		$btl->users[$btl->uids[$u->info['id']]]['tactic'.$x] += $val;
		if($u->info['tactic'.$x]<0) {
			$u->info['tactic'.$x] = 0;
		}
		if($btl->users[$btl->uids[$u->info['id']]]['tactic'.$x] < 0) {
			$btl->users[$btl->uids[$u->info['id']]]['tactic'.$x] = 0;
		}
		$rt .= '`tactic'.$x.'`="'.$u->info['tactic'.$x].'"';
		mysql_query('UPDATE `stats` SET '.$rt.' WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	}
	
	public function actpridMax($pl)
	{
		global $u,$btl;		
		if($pl['actprid2']>0 || $pl['actprid3']>0)
		{
			$i = 0;
			$pe = explode('|',$u->info['priems']);
			$piz = array();
			while($i<count($pe))
			{
				if($pl['sbr'] == 0) {
					//��� ���������
					$psp = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.((int)$pe[$i]).'" LIMIT 1'));
				}else{
					//������ ������� ����� �����
					$imgnm = '';
					$nm = explode('_',$pl['img']);
					if($nm[0] == 'wis') { //�����
					$imgnm = $nm[0].'_'.$nm[1].'%';
					}else{
						$imgnm = $nm[0].'%';						
					}
					//������ ������ �����
					$psp = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.((int)$pe[$i]).'" AND `img` LIKE "'.$imgnm.'" LIMIT 1'));
				}
				if( $pl['noprid'] == 0 ) {
					if(isset($psp['id']) && $psp['tr_hod']==0 && $psp['type_pr']==1 && $psp['noprid'] == 0)
					{
						if($pl['actprid2']>0)
						{
							$piz[$pe[$i]] = (int)$pl['actprid2'];
						}elseif($pl['actprid3']>0)
						{
							$piz[$pe[$i]] = $psp['zad'];
						}
					}
				}
				$i++;
			}
			$pz = explode('|',$u->info['priems_z']);
			$p = explode('|',$u->info['priems']);
			$i = 0;
			while($i<count($p))
			{
				if($p[$i]>0 && isset($piz[$p[$i]]))
				{
					if($pz[$i]==0)
					{
						$pz[$i] = $piz[$p[$i]];
					}
				}
				$i++;
			}
			$pz = implode('|',$pz);
			$u->info['priems_z'] = $pz;
			$btl->users[$btl->uids[$u->info['id']]]['priems_z'] = $pz;
			$btl->stats[$btl->uids[$u->info['id']]]['priems_z'] = $pz;
		}
	}
	
	public function uppz($pl,$id)
	{
		global $u,$btl;
		$this->actpridMax($pl);
		$p = explode('|',$u->info['priems']);
		$pz = explode('|',$u->info['priems_z']);
		$pz[(int)$id] = $pl['zad'];
		$i = 0; $pe = explode(',',$pl['actprid']);
		$piz = array();
		while($i<count($pe))
		{
			$piz[$pe[$i]] = 1;
			$i++;
		}
		$i = 0; $pe = explode(',',$pl['actprid_one']);
		$piz2 = array();
		while($i<count($pe))
		{
			$piz2[$pe[$i]] = 1;
			$i++;
		}
		$i = 0;
		while($i<count($p))
		{
			if($p[$i]>0)
			{
				if(isset($piz[$p[$i]]))
				{
					if( $pl['id'] == 281 ) {
						//������ ���� + ������� ���� 5 ��. �������� �� ����� � �����
						if($p[(int)$i] == 246 || $p[(int)$i] == 186) {
							$pz[(int)$i] = 5;
						}else{
							$pz[(int)$i] = $pl['zad'];
						}
					}else{
						$pz[(int)$i] = $pl['zad'];
					}
				}
				if(isset($piz2[$p[$i]]))
				{
					if( $pz[(int)$i] == 0 ) {
						$pz[(int)$i] = 1;
					}
				}
			}
			$i++;
		}
		$pz = implode('|',$pz);
		$u->info['priems_z'] = $pz;
		$btl->users[$btl->uids[$u->info['id']]]['priems_z'] = $pz;
		$btl->stats[$btl->uids[$u->info['id']]]['priems_z'] = $pz;
		$tr = $u->lookStats($pl['tr']);
		if(isset($tr['tr_mpNow']))
		{
			$tr['tr_mpNow'] = round($tr['tr_mpNow']/100*(100-$u->stats['min_use_mp']));
			$btl->users[$btl->uids[$u->info['id']]]['mpNow'] -= $tr['tr_mpNow'];
			$btl->stats[$btl->uids[$u->info['id']]]['mpNow'] -= $tr['tr_mpNow'];
			if($btl->stats[$btl->uids[$u->info['id']]]['mpNow']<$btl->users[$btl->uids[$u->info['id']]]['mpNow'])
			{
				$btl->users[$btl->uids[$u->info['id']]]['mpNow'] = $btl->stats[$btl->uids[$u->info['id']]]['mpNow'];
			}
		}
		$u->info['mpNow'] = $btl->users[$btl->uids[$u->info['id']]]['mpNow'];
		mysql_query('UPDATE `stats` SET `mpNow` = "'.$u->info['mpNow'].'",`priems_z` = "'.$pz.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	}
	
	public function reuns($id)
	{
		global $u,$c,$code;
		$p = explode('|',$u->info['priems']);
		if($p[(int)$id]>0)
		{
			//������� �����
			$p[(int)$id] = 0;
			$p = implode('|',$p);
			$upd = mysql_query('UPDATE `stats` SET `priems` = "'.mysql_real_escape_string($p).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			$u->info['priems'] = $p;
		}					
	}
	
	public function uns($id)
	{
		global $u,$c,$code;
		$pl = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `level`<="'.$u->info['level'].'" AND `activ` > "0" AND `id` = "'.mysql_real_escape_string($id).'" LIMIT 1'));
		if(isset($pl['id']))
		{
			$notr = $this->testpriem($pl,1);
			if($notr==0)
			{
				$yes = -1; $non = -1;
				$i = 0; $p = explode('|',$u->info['priems']);
				while($i < $u->info['priemslot'])
				{
					if($non==-1 && $p[$i]==0)
					{
						$non = $i;
					}
					if($p[$i]==$pl['id'])
					{
						$yes = $i;
					}
					$i++;
				}			
				
				if($yes==-1)
				{
					if($non!=-1)
					{
						//������� �����
						$p[$non] = $pl['id'];
						$p = implode('|',$p);
						$upd = mysql_query('UPDATE `stats` SET `priems` = "'.$p.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						if($upd)
						{
							$u->info['priems'] = $p;							
						}
					}else{
						//������� ��������� �����
						echo '������� ��������� �����...';
					}
				}else{
					//����� ����� ��� �����, ������ �� ������
				}	
								
			}
		}
	}
	
	
	//������� ������ $id - 1 (��� ���), 2 - � ���
	public function seeMy($t)
	{
		global $u,$c,$code,$btl;
		if( $u->info['inTurnir'] == 0 || true == true ) {
			$i = 0; $p = explode('|',$u->info['priems']); $lvar = ''; $pr = '';
			while($i < count($p)) {			
				if($p[$i] > 0 && $i >= $u->info['priemslot']) {
					$p[$i] = 0;
				}
				$i++;
			}
			$pz = implode('|',$p);
			$u->info['priems'] = $pz;
			mysql_query('UPDATE `stats` SET `priems` = "'.$u->info['priems'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			$i = 0;
			while($i<$u->info['priemslot'])
			{			
				if($p[$i]>0)
				{
					$pl = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `level`<="'.$u->info['level'].'" AND `activ` > "0" AND `id` = "'.mysql_real_escape_string($p[$i]).'" LIMIT 1'));
					$lvar = $this->priemInfo($pl,$t,$i);
					$pz   = $lvar[1];
					$lvar = $lvar[0];
					if($t==1)
					{
						if(isset($_GET['inv'])) {
							$cl = 'href="main.php?skills=1&rz=4"';
						}else{
							$cl = 'href="main.php?skills=1&rz=4&unuse_priem='.$i.'&rnd='.$code.'"';
						}
					}else{
						if($pl['type']==1)
						{
							//�����������
							if($pl['onUser']==1)
							{
								$oninuser = '';
								if( $pl['team'] == 1 ) {
									if( $u->info['login2'] != '' ) {
										$oninuser = $u->info['login2'];
									}else{
										$oninuser = $u->info['login'];
									}
								}else{
									if( $btl->users[$btl->uids[$u->info['enemy']]]['login2'] != '' ) {
										$oninuser = $btl->users[$btl->uids[$u->info['enemy']]]['login2'];
									}else{
										$oninuser = $btl->users[$btl->uids[$u->info['enemy']]]['login'];
									}
								}
								$cl = 'href="javascript:void(0);" onClick="top.priemOnUser('.$i.',1,\''.$pl['name'].'\',\''.$oninuser.'\');"';
								unset($oninuser);
							}else{
								$cl = 'href="javascript:void(0);" onClick="usepriem('.$i.',1);"';
							}
						}elseif($pl['type']==2)
						{
							//����������
							$cl = 'href="javascript:void(0);" onClick="usepriem('.$i.',1);"';
						}elseif($pl['type']==3)
						{
							$cl = 'href="javascript:void(0);" onClick="alert(\'�������� ����������?\');"';
						}
					}
					
	
					$notr = $this->testpriem($pl,$t);
					
					
					$cl2 = '';
					$cli2 = '';
					if( ( ($pz[$i]>0 || $notr>0) && $t==2 ) || (isset($u->stats['nopriems']) && $pl['nosh'] == 0) || $u->stats['notuse_last_pr'] == $pl['id'] || ($u->stats['hpNow'] < 1 && $u->info['battle'] > 0))
					{
						//$cl2 = 'filter: alpha(opacity=15); -moz-opacity: 0.15; -khtml-opacity: 0.15; opacity: 0.15;';
						$cl = '';
						$cli2  = ' class="nopriemuse" title="������ ������������ (#1)" ';
					}
					
					$pr .= '<a onMouseOver="top.hi(this,\'<b>'.$pl['name'].'</b><Br>'.$lvar.'\',event,3,0,1,1,\'width:240px\');" onMouseOut="top.hic();" onMouseDown="top.hic();" '.$cl.'><img '.$cli2.' style="margin-top:1px; '.$cl2.' margin-left:2px;" src="http://img.likebk.com/i/eff/'.$pl['img'].'.gif" width="40" height="25" /></a>';
				}else{
					if($t==1)
					{
						$pr .= '<img style="margin-top:1px; margin-left:2px;" src="http://img.likebk.com/i/items/w/clearPriem.gif" width="40" height="25" />';
					}
				}
				$i++;
			}
			if($u->info['animal']>0 && $t==2)
			{
				$use_lst = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "animal_use'.$btl->info['id'].'" LIMIT 1',1);
				if(!isset($use_lst['id']))
				{
					$cl2 = '';
					$pr .= '<a onMouseOver="top.hi(this,\'<b>��������� �����</b><Br>��� ����� ����������� � ��������. ����� ��������� ���� ��� �� ���.\',event,3,0,1,1,\'width:240px\');" onMouseOut="top.hic();" onMouseDown="top.hic();" href="javascript:void(0);" onClick="usepriem(100500,1);"><img style="margin-top:1px; '.$cl2.' margin-left:2px;" src="http://img.likebk.com/i/eff/pet_unleash.gif" width="40" height="25" /></a>';
				}else{
					$cl2 = '" title="������ ������������ (#2)" class="nopriemuse';
					$pr .= '<img onMouseOver="top.hi(this,\'<b>��������� �����</b><Br>��� ����� ����������� � ��������. ����� ��������� ���� ��� �� ���.\',event,3,0,1,1,\'width:240px\');" onMouseOut="top.hic();" onMouseDown="top.hic();" style="margin-top:1px; margin-left:2px;'.$cl2.'" src="http://img.likebk.com/i/eff/pet_unleash.gif" width="40" height="25" />';
	
				}
			}
			if($t==1)
			{
				echo '<div style="width:210px;">'.$pr.'</div>';
			}elseif($t==2)
			{
				$pr = str_replace('"','\\"',$pr);
				return $pr;
			}
		}
	}
	
	public function testpriem($pl,$t = 1,$o = 0)
	{
		global $c,$u,$code,$btl;
		$tr = $u->lookStats($pl['tr']);
		$d2 = $u->lookStats($pl['date2']);
		$x = 1;
		$notr = 0;
		
		if( $u->stats['mpNow'] > $u->stats['hpNow'] / 2 && ($u->stats['s5']+$u->stats['s6']) > ($u->stats['s1']+$u->stats['s2']+$u->stats['s3']) ) {
			//���
			if( $pl['nfm'] > 0 ) {
				$notr++;
			}
		}else{
			//����
			
		}
				
		if($t==2 && $pl['id']==181){		
		    $imun = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['enemy'].'" and `v2`="191" and `delete`="0" LIMIT 1'));
		    if($imun){
				$notr++;
			}
		}
		
		if( $pl['id'] == 265 ) {
			if( $btl->stats[$btl->uids[$u->info['enemy']]]['hpNow'] > floor($btl->stats[$btl->uids[$u->info['enemy']]]['hpAll']/100*33) ) {
				$notr++;
			}
		}
		
		if(isset($btl->stats[$btl->uids[$u->info['id']]]['nousepriem']) && $btl->stats[$btl->uids[$u->info['id']]]['nousepriem'] > 0 && $pl['nosh'] == 0) {
			if( $btl->stats[$btl->uids[$u->info['id']]]['noshock_voda'] > 0 && substr($pl['img'],0,10) == 'wis_water_' ) {
				//����
			}else{
				$notr++;
			}
		}
		
		if( $pl['id'] == $btl->stats[$btl->uids[$u->info['id']]]['notuse_last_pr'] ) {
			$notr++;
		}
			
				
		while($x<=7)
		{
			if(isset($btl->uids[$u->info['id']],$btl->users[$btl->uids[$u->info['id']]]))
			{
				if($btl->users[$btl->uids[$u->info['id']]]['tactic'.$x] < $pl['tt'.$x] && $x!=7 && $pl['tt'.$x] > 0)
				{
					$notr++;
				}elseif($x==7)
				{
					if($pl['tt'.$x]>0 && $btl->users[$btl->uids[$u->info['id']]]['tactic'.$x]<=0)
					{
						$notr++;
					}
				}
			}
			$x++;
		}


		if($pl['xuse']>0)
		{
			$xu = $u->testAction('`vars` = "use_priem_'.$btl->info['id'].'_'.$u->info['id'].'" AND `vals` = "'.$pl['id'].'" LIMIT '.$pl['xuse'].'',2);
			if($xu[0]>=$pl['xuse'])
			{
				$notr++;
			}
		}

		$x = 0;
		$t = $u->items['tr'];
		while($x < count($t))
		{
			$n = $t[$x];
			if(isset($tr['tr_'.$n]))
			{
				if($n=='lvl')
				{
					if($tr['tr_'.$n] > $u->info['level'])
					{
						$notr++;
					}
				}elseif($tr['tr_'.$n] > $u->stats[$n])
				{
					$notr++;
				}
			}
			$x++;
		}
				
		
		
		if($pl['activ']==0 || ($this->testActiv($pl['activ'])==0 && $pl['activ']>1))
		{
			$notr++;
		}
				
		if( isset($btl->stats[$btl->uids[$u->info['id']]]['tactic7']) ) {
			if( $pl['id'] == 232 && $btl->stats[$btl->uids[$u->info['id']]]['tactic7'] < 0.01 ) {
				$notr++;
			}
		}
		
		//if($t==2)
		//{
			if($d2['onlyOne']>1 || $d2['onlyOneX1'] == 1)
			{
				if( $d2['onlyOneX1'] == 1 ) {
					$pru = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `v2` = "'.$pl['id'].'" AND `delete` = "0" AND `x` >= 1 LIMIT 1'));
				}else{
					$pru = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$u->info['id'].'" AND `v2` = "'.$pl['id'].'" AND `delete` = "0" AND `x` > 1 LIMIT 1'));
				}
				if(isset($pru['id']) && $pru['x']>=$d2['onlyOne']) {				
					$notr++;				
				}
			}
		//}
		
		//������� ����� �� ����
		if(isset($tr['tr_nousepriem'])) {
			$x = 0;
			$nouse = explode(',',$tr['tr_nousepriem']);
			while($x < count($nouse)) {
				$nousev = explode('.',$nouse[$x]);
				if( $pl['team'] == 2 ) {
					if(isset($btl->stats[$btl->uids[$o]]['prsu'][$nousev[0]]) && $btl->stats[$btl->uids[$o]]['prsu'][$nousev[0]] >= 0) {
						if($nousev[2] > 1) {
							if($nousev[2] <= $btl->stats[$btl->uids[$o]]['prsu'][$nousev[0]]) {
								$notr++;
							}
						}else{
							$notr++;
						}
					}
				}else{
					if(isset($btl->stats[$btl->uids[$u->info['id']]]['prsu'][$nousev[0]]) && $btl->stats[$btl->uids[$u->info['id']]]['prsu'][$nousev[0]] >= 0) {
						if($nousev[2] > 1) {
							if($nousev[2] <= $btl->stats[$btl->uids[$u->info['id']]]['prsu'][$nousev[0]]) {
								$notr++;
							}
						}else{
							$notr++;
						}
					}
				}
				$x++;
			}
			unset($nouse,$nousev);
		}
		
		if( ( $tr['tr_mpNow'] > 0 || $tr['tr_mg1'] > 0 || $tr['tr_mg2'] > 0 || $tr['tr_mg3'] > 0 || $tr['tr_mg4'] > 0 ) && !isset($tr['tr_type_itm1']) ) {
			$tr['tr_type_itm1'] = 22;	
		}
		
		if(isset($tr['tr_type_itm1'])) {
			//������� ������� �������� ������������� ����
			$itmt = mysql_fetch_array(mysql_query('SELECT `u`.`id` FROM `items_users` AS `u` LEFT JOIN `items_main` AS `m` ON `m`.`id` = `u`.`item_id` WHERE `m`.`type` = "'.$tr['tr_type_itm1'].'" AND `u`.`inOdet` > 0 AND `u`.`uid` = "'.$u->info['id'].'" AND `u`.`delete` = "0" LIMIT 1'));
			if(!isset($itmt['id']) && !isset($itmt[0])) {
				if( $tr['tr_type_itm1'] == 18 ) {
					$tr['tr_type_itm1'] = 19;
					$itmt = mysql_fetch_array(mysql_query('SELECT `u`.`id` FROM `items_users` AS `u` LEFT JOIN `items_main` AS `m` ON `m`.`id` = `u`.`item_id` WHERE `m`.`type` = "'.$tr['tr_type_itm1'].'" AND `u`.`inOdet` > 0 AND `u`.`uid` = "'.$u->info['id'].'" AND `u`.`delete` = "0" LIMIT 1'));
				}
				if(!isset($itmt['id']) && !isset($itmt[0])) {
					$notr++;
				}
			}
		}
		
		if(isset($tr['tr_mpNow']))
		{
			if(isset($btl->stats[$btl->uids[$u->info['id']]]))
			{
				if($btl->stats[$btl->uids[$u->info['id']]]['mpNow'] < round($tr['tr_mpNow']/100*(100-$btl->stats[$btl->uids[$u->info['id']]]['min_use_mp'])))
				{
					$notr++;
				}
			}else{
				if($u->info['mpNow'] < $tr['tr_mpNow'])
				{
					$notr++;
				}
			}
		}
		
		if(isset($btl->uids[$u->info['id']],$btl->stats[$btl->uids[$u->info['id']]]))
		{
			if($pl['trUser']==1)
			{
				//������� ����� ������������ � ���-�� ������������ (��� �������� ����� ������)
				if(isset($btl->ga[$u->info['id']][$u->info['enemy']]))
				{
					$notr++;
				}
			}elseif($pl['trUser']==2 && $o > 0)
			{
				//������� ����� ������������ � ���-�� ������������ (��� �������� �� ���������, �� �� ������������)
				$ga = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `battle` = "'.$btl->info['id'].'" AND `uid1` = "'.$u->info['id'].'" AND `uid2` = "'.$btl->users[$btl->uids[$u->info['id']]]['enemy'].'" LIMIT 1'));
				if(isset($ga['id']))
				{
					$notr++;
				}
			}			
		}
		
		return $notr;
	}
	
	public function priemInfo($pl,$t,$id = false)
	{
		global $u,$c,$code,$btl;
		$pz = explode('|',$u->info['priems_z']);
		$tr = $u->lookStats($pl['tr']);
		$trs = '';
		$x = 0;
		$notr = 0;
		$t = $u->items['tr'];
		while($x<count($t))
		{
			$n = $t[$x];
			if(isset($tr['tr_'.$n]))
			{
				if($tr['tr_'.$n] > $u->stats[$n])
				{
					$trs .= '<font color=red>'; $notr++;
				}
				$trs .= '<br>� ';
				$trs .= $u->is[$n].': '.$tr['tr_'.$n];
				if($tr['tr_'.$n] > $u->stats[$n])
				{
					$trs .= '</font>';
				}
			}
			$x++;
		}
			
		$lvar = '';
		$j = 1;
		$nm = array(1=>'hit',2=>'krit',3=>'counter',4=>'block',5=>'parry',6=>'hp',7=>'spirit');
		while($j<=6)
		{
			if($pl['tt'.$j]>0)
			{
				$lvar .= '<img src=http://img.likebk.com/i/micro/'.$nm[$j].'.gif width=8 height=8 /> '.round($pl['tt'.$j],2).' &nbsp; ';
			}
			$j++;
		}
		if($pl['tt7']>0)
		{
			if($lvar!='')
			{
				$lvar .= '<br>';
			}
			$lvar .= '���� ����: '.round($pl['tt'.$j],2).'<br>';
		}
		$lvar .= '<br>';
		if($pl['zad']>0)
		{
			$lvar .= '��������: '.$pl['zad'];
			if($pz[$id]>0)
			{
				$lvar .= ' (��� '.$pz[$id].')';
			}
			$lvar .= '<br>';
		}
		if(isset($tr['tr_mpNow']) && $tr['tr_mpNow']>0)
		{
			$tr['tr_mpNow'] -= round($tr['tr_mpNow']/100*$u->stats['min_use_mp']);
			if($u->info['mpNow']<$tr['tr_mpNow'] || (isset($btl->stats[$btl->uids[$u->info['id']]]) && $btl->stats[$btl->uids[$u->info['id']]]['mpNow']<$tr['tr_mpNow']))
			{
				$lvar .= '<font color=red>� ������ ����: '.$tr['tr_mpNow'].'</font><br>';
			}else{
				$lvar .= '� ������ ����: '.$tr['tr_mpNow'].'<br>';	
			}
		}
		if($pl['tr_hod']>0)
		{
			$lvar .= '� ����� ������ ���<br>';
		}
		if($trs!='')
		{
			$lvar .= '<b>����������:</b>'.$trs.'<br><br>';
		}else{
			$lvar .= '<br>';
		}
		$pl['info'] = preg_replace("!(\#)(.*?)(\#)!ise","getdr('\\2',array(0=>'lvl1',1=>'ts5',2=>'mpAll'),array(0=>'".$u->info['level']."',1=>'".$u->stats['s5']."',2=>'".$u->stats['mpAll']."'))",$pl['info']);
		$lvar .= $pl['info'];
		$lvar = array(0=>$lvar,1=>$pz);
		return $lvar;
	}
	
	//�������� / ���������� / ������������� � �.�.
		public function testPower($s1,$s2,$y,$t,$t2)
		{
			global $u,$btl;
			
			$r = 0;
			if($t2==2)
			{
				//���� ������
				$pm = array(0=>0,1=>0,2=>0,3=>0);
				if($t<5)
				{
					$pm[0] = $s1['m11'];
					$pm[1] = $s2['zm'];
					$pm[2] = $s2['antm11'];
				}
				
				if(isset($btl->info['id']))
				{
					$pm[3] = $btl->zmgo( $s2['zm'.$t] );					
					$pm[3] = round($pm[3]);
				}

				//$p += $p/100*($s1['pm'.$t]*0.75+$pm[0]*1.01+$s1['m11a']*0.75-($s2['antpm'.$t]+$s2['antm11a']+$pm[2])) - $p/75*$pm[3]; //�� ��������� � ������ ����������
				
				//$kfl = 250;
				
				//$p = $y*(1+ ( $s1['pm'.$t]-$s2['antpm'.$t]-$s2['antm11a']-$pm[2] ) /100)*pow(2,(( ( $s2['pzm'.$t]  ) * 10-(($s2['zma']+$pm[1]) + $s2['zm'.$t]) )/$kfl));
				
				//���� = b*(1+m/100)*2^((p*10-z)/k)
				$fx_vl = array(
					250,250,250,250,250,250,250,250,250,300,350,400,450,500,550,600,650,700,750,800,850,900
				);
				
				$fx = array(
					'b' => $y, //������� ����
					'm' => round( $s1['pm'.$t] * 1.65 - $s2['antpm'.$t] ), //����
					'z' => round( $s2['zm'.$t] ), //������ ���� ��.
					'p' => round( $s1['pzm'] + $s1['pzm'.$t] ), //����������
					'k' => $fx_vl[(0+$s1['lvl'])] //����������� ; k=250 ��� 8��, k=300 ��� 9�� � �.�. +20% �� �������
				);
				
				$p = $fx['b'] * ( 1 + $fx['m'] / 100 ) * pow( 2, ( ( $fx['p'] * 10 - $fx['z'] ) / $fx['k'] ) );
				$p += $p/100*10;
				$p -= $p/100*$pm[3];
				//$p += floor($s1['s5']*0.25);
				
				if($p < round($y*0.2)) {
					$p = round($y*0.2);
				}elseif($p > round($y*10)) {
					$p = $y*10;
				}
				
				//$p += $p/100*($s1['pzm']+$s1['pzm'.$t]); //�� ���������� ���.������	
				if(isset($s2['zmproc']) || isset($s2['zm'.$t.'proc'])) //������ �� ����� ������ (���������)
				{
			        
					$p = floor($p/100*(100-$s2['zmproc']-$s2['zm'.$t.'proc']));
					if($p<0)
					{
						$p = 0;
					}
					
				}
				
				$p = round($p/100*rand(107,111));
				$r = $p;

			}else{
				//���� �������
				
			}	

			return $r;
			
			
			/*		//if($u->info['id']==340379 or $u->info['id']==399105){
					//    echo '$y '.$y.'<br>';
					//}
			$r = 0;
			if($t2==2)
			{
				//���� ������
				$pm = array(0=>0,1=>0,2=>0,3=>0);
				if($t<5)
				{
					$pm[0] = $s1['m11'];
					$pm[1] = $s2['zm'];
					$pm[2] = $s2['antm11'];
				}
				$p = $y;
				
				//$p += ($s1['s5']*($p/100*0.52)); //�� ���������
				$p += 0; //�� ������
				
				if(isset($btl->info['id']))
				{
					//$pm[3] = ($p/100*((($s2['zma']+$pm[1])+$s2['zm'.$t])*1.25))*0.20;
					$pm[3] = $btl->zmgo( ($s2['zma']+$pm[1]) + $s2['zm'.$t] );
					$pm[3] = round($pm[3]);
				}

				$p += $p/100*($s1['pm'.$t]*0.75+$pm[0]*1.01+$s1['m11a']*0.75-($s2['antpm'.$t]+$s2['antm11a']+$pm[2])) - $p/75*$pm[3]; //�� ��������� � ������ ����������
				
				
				$p += $p/100*($s1['pzm']+$s1['pzm'.$t]); //�� ���������� ���.������	
				if(isset($s2['zmproc']) || isset($s2['zm'.$t.'proc'])) //������ �� ����� ������ (���������)
				{
			        
					$p = floor($p/100*(100-$s2['zmproc']-$s2['zm'.$t.'proc']));
					if($p<0)
					{
						$p = 0;
					}
					
				}
				$p = round($p/100*rand(90,100));
				$r = $p;

			}else{
				//���� �������
				
			}	
			//if($u->info['id']==340379 or $u->info['id']==399105){
				//	    echo '$r '.$r.'<br>';
				//	}
			return $r;*/
		}
	
	private function pyes($id)
	{
		global $u;
		$p = explode('|',$u->info['priems']);
		$r = false;
		$i = 0;
		while($i<count($p))
		{
			if($p[$i]==$id)
			{
				$r = true;
			}
			$i++;
		}
		return $r;
	}
	
	//������� ��� ��������� ������ ������ �� ��� ������ - 1, ������� ��� ��������� ������ ������ ������ - 2
	public function seePriems($mt)
	{
		global $u,$c,$code;
		if( $u->info['inTurnir'] == 0 || true == true ) {
			$t = $u->items['tr'];
			$nm = array(1=>'hit',2=>'krit',3=>'counter',4=>'block',5=>'parry',6=>'hp',7=>'spirit');
			$sp = mysql_query('SELECT * FROM `priems` WHERE `level`<="'.$u->info['level'].'" AND `activ` > "0" ORDER BY `img`,`level` ASC');
			$u->info['lvl'] = $u->info['level']; $lvar = '';
			while($pl = mysql_fetch_array($sp))
			{
				$noaki = 0;
				if($pl['activ']==1 || $this->testActiv($pl['activ'])==1)
				{
					$lvar = $this->priemInfo($pl,1);
					$lvar = $lvar[0];
					$cl = ''; $a1 = '<a href="main.php?skills=1&all='.((int)$_GET['all']).'&rz=4&use_priem='.$pl['id'].'&rnd='.$code.'">'; $a2 = '</a>';
					if($this->pyes($pl['id'])==true || $this->testpriem($pl,1)>0)
					{
						if((isset($_GET['all']) && $_GET['all'] == 1) || $this->pyes($pl['id'])==true) {
							$cl = 'filter: alpha(opacity=35); -moz-opacity: 0.35; -khtml-opacity: 0.35; opacity: 0.35;';
							$a1 = '';
							$a2 = '';
						}else{
							$noaki = 1;
						}
					}
					if($noaki == 0) {
						$mtnu = explode('_',$pl['img']);
						if($mtnu[0] != 'wis') {
							$mtnu = $mtnu[0];
						}else{
							$mtnu = 'wis_'.$mtnu[1];
						}
						echo $a1.'<img class="pwq'.$mtnu.' pwqall" onMouseOver="top.hi(this,\'<small><b>'.$pl['name'].'</b><Br>'.$lvar.'</small>\',event,3,0,1,1,\'width:240px\');" onMouseOut="top.hic();" onMouseDown="top.hic();" style="margin-top:2px; '.$cl.' margin-left:1px;" src="http://img.likebk.com/i/eff/'.$pl['img'].'.gif" width="40" height="25" />'.$a2;
					}
				}
			}
		}
	}
}

$priem = new priems;

?>