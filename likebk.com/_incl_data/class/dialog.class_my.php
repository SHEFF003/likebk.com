<?
if(!defined('GAME'))
{
	die();
}

class dialog
{
	public $info,$dText = '',$aText = '',$youInfo = '',$botInfo = '',$title = '',$p = 1,$pg = 1;
	
	public function trnObj($x,$j)
	{
		$r = array(0=>0,1=>0);
		$i = floor($x/$j);
		$r = array(0=>$i,1=>$x-($i*$j));
		return $r;
	}
	
	public function objLevel($t,$l)
	{
		$i = 1;
		$r = 0;		
		while($i<=$l)
		{
			if(isset($t[$i]))
			{
				$r = $t[$i];
			}
			$i++;	
		}		
		return $r;	
	}
	
	public function dialog_act_update($data) {
		global $u;
		$r = array(false,'');
		$x = explode('#',$data);
		$i = 0;
		while( $i < count($x) ) {
			$k = explode('=',$x[$i]);
			$var = $k[0];
			$val = $k[1];
			if( $var == 'take_item' ) {
				//�������� �������
				$itms = array();
				$sp = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = "'.mysql_real_escape_string($val).'" AND (`delete` = "0" OR `delete` = "1000") AND `inOdet` = "0" AND `inShop` = "0" LIMIT 100');
				while($pl = mysql_fetch_array($sp))	{
					$itms[$pl['item_id']]++;	
				}
						
				if($itms[$val] >= $k[2]) {
					//$u->deleteItemID($val,$u->info['id'],$k[2]);
					
					mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `item_id` = "'.mysql_real_escape_string($val).'" AND `uid` = "'.$u->info['id'].'" AND `inShop` = 0 AND `inTransfer` = 0 AND (`delete` = "0" OR `delete` = "1000") AND `inOdet` = 0 LIMIT '.round($k[2]));
				}else{
					$i = count($x);
					$r[0] = false;
					$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$val.'" LIMIT 1'));
					$r[1] = '� ��� ��� ������� ��������! ��������� &quot;'.$itm['name'].'&quot;';
					if( $k[2] > 1 ) {
						$r[1] .= ' ('.$k[2].' ��.)';
					}
				}
				//
			}elseif( $var == 'add_item' ) {
				$data_itm = '|frompisher=1';
				$i1 = 0;
				while( $i1 < $k[2] ) {
					if( $val == 4797 ) {
						//��������
						if( $u->info['level'] >= 4 && $u->info['level'] <= 7 ) {
							$val = 4797;
						}elseif( $u->info['level'] >= 8 && $u->info['level'] <= 9 ) {
							$val = 4798;
						}else{
							$val = 4799;
						}
					}
					$u->addItem($val,$u->info['id'],$data_itm);
					$i1++;
				}
			}elseif( $var == 'up' ) {
				$tqst = mysql_fetch_array(mysql_query('SELECT * FROM `dialog_act` WHERE `uid` = "'.$u->info['id'].'" AND `var` = "'.mysql_real_escape_string($val).'" ORDER BY `id` DESC LIMIT 1'));
				if(!isset($tqst['id'])) {
					mysql_query('INSERT INTO `dialog_act` (
						`uid`,`city`,`time`,`var`,`val`
					) VALUES (
						"'.$u->info['id'].'","'.$u->info['city'].'","'.time().'","'.mysql_real_escape_string($val).'","'.mysql_real_escape_string($k[2]).'"
					)');
				}else{
					mysql_query('UPDATE `dialog_act` SET `val` = "'.mysql_real_escape_string($k[2]).'" WHERE `uid` = "'.$u->info['id'].'" AND `var` = "'.mysql_real_escape_string($val).'" ORDER BY `id` DESC LIMIT 1');	
				}
			}elseif( $var == 'finish' ) {
				$r[0] = true;
				$r[1] = $val;
			}
			$i++;
		}
		return $r;
	}
	
	public function quest_act($data) {
		global $u;
		//
		$r = true;
		//
		$f = explode('#',$data);
		$ql = mysql_fetch_array(mysql_query('SELECT * FROM `dialog_act` WHERE `var` = "'.mysql_real_escape_string($f[3]).'" AND `uid` = "'.$u->info['id'].'" ORDER BY `id` DESC LIMIT 1'));
		if(isset($ql['id'])) {
			//user_id # all # all # lukaqst1 # -1
			if( $f[0] == 'user_id' ) {
				$f[0] = $u->info['id'];
			}	
			//
			if( $f[0] != $ql['uid'] && $f[0] != 'all' ) {
				$r = false;
			}elseif( $f[1] != $ql['city'] && $f[1] != 'all' ) {
				$r = false;
			}elseif( $f[2] != $ql['time'] && $f[2] != 'all' ) {
				$r = false;
			}elseif( $f[3] != $ql['var'] && $f[3] != 'all' ) {
				$r = false;
			}elseif( $f[4] == -1 ) {
				//�� ������ ����� �������
				$r = false;
			}elseif( $f[4] != $ql['val'] ) {
				$r = false;
			}elseif( $f[5] == 1 && $ql['now'] < $ql['max'] ) {
				$r = false;
			}
		}else{
			if( $f[4] != -1 ) {
				$r = false;
			}
		}
		//
		return $r;
	}
	
	public function start($id)
	{
		global $u,$q,$c,$d,$code;
		$this->info = mysql_fetch_array(mysql_query('SELECT * FROM `dungeon_dialog` WHERE `id` = "'.mysql_real_escape_string((int)$id).'" LIMIT 1'));
		if(isset($this->info['id']))
		{
			$pg = 1;
			$go = 1;
			$txt = '';
			//������� �� ���������
			if(isset($_GET['act']))
			{
				$ta = mysql_fetch_array(mysql_query('SELECT * FROM `dungeon_dlg` WHERE `type` = "0" AND `id` = "'.mysql_real_escape_string((int)$_GET['act']).'" AND `id_dg` = "'.$this->info['id'].'" LIMIT 1'));
				if(isset($ta['id']))
				{
					$ta['action'] = $this->ltr($ta['action']);
					$act = explode('|',$ta['action']);
					$go1 = 1;
					$needRep = array();
					if($ta['tr'] != '') {
						$i = 0;
						$x = explode('|',$ta['tr']);
						while($i < count($x)) {
							//����������
							$k = explode('=',$x[$i]);

							if($k[0]=='data') {
								$date = explode('-',$k[1]);
								$dd1 = $date[0];
								$mm1 = $date[1];
								$dd2 = $date[2];
								$mm2 = $date[3];
								$date1 = strtotime($dd1.'-'.$mm1.'-'.date('Y'));
								$date2 = strtotime($dd2.'-'.$mm2.'-'.date('Y'));
								
								if( $date1 > time() || $date2 < time() ) {
									$go1 = 'delete';
									$i = count($x);
								}
								
							}elseif($k[0]=='diact') {
								//��������
								//user_id # all # all # lukaqst1 # -1
								if($this->quest_act($k[1])==false) {
									$go1 = 'delete';
									$i = count($x);
								}														
							}elseif($k[0]=='quest_end') {
								//����� ����� ��������� ��������� ��� � ������� ������
								$qlst = mysql_fetch_array(mysql_query('SELECT `id`,`vals` FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "start_quest'.$k[1].'" ORDER BY `id` DESC LIMIT 1'));
								if(isset($qlst['id']) && $qlst['vals'] != 'win' && $qlst['vals'] != 'end' && $qlst['vals'] != 'bad') {
									$go1 = 0;
									$txt .= '<br><b><font color=red>���-�� �� ���, �� ��� ����� ������ �������...</font>';
									$pg = $ta['page'];	
								}
							}elseif($k[0]=='quest_only_one') {
								//����� ����� ��������� ������ ���� ���
								$qlst = mysql_fetch_array(mysql_query('SELECT `id`,`vals` FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "start_quest'.$k[1].'" ORDER BY `id` DESC LIMIT 1'));
								if(isset($qlst['id']) && ($qlst['vals'] == 'win' || $qlst['vals'] == 'bad')) {
									$go1 = 0;
									$txt .= '<br><b><font color=red>���-�� �� ���, �� ��� ��������� ������ �������...</font>';
									$pg = $ta['page'];	
								}
							}elseif($k[0]=='quest_now') {
								//����� ������ ���� ����
								$qlst = mysql_fetch_array(mysql_query('SELECT `id`,`vals` FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "start_quest'.$k[1].'" ORDER BY `id` DESC LIMIT 1'));
								if(isset($qlst['id']) && $qlst['vals'] != 'win' && $qlst['vals'] != 'end' && $qlst['vals'] != 'bad'){}else{
									$go1 = 0;
									$txt .= '<br><b><font color=red>���-�� �� ���, ��������� ����� �������...</font>';
									$pg = $ta['page'];	
								}
							}elseif($k[0]=='tr_itm') {
								//����� ������� �������
								$qlst = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = "'.$k[1].'" AND `inOdet` = 0 AND `inTransfer` = 0 AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
								if(!isset($qlst['id'])){
									$go1 = 0;
									$itmqs = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.$k[1].'" LIMIT 1'));
									if(isset($itmqs['id'])) {
										$txt .= '<br><b><font color=red>��������� ������� &quot;'.$itmqs['name'].'&quot;.</font>';
									}
									$pg = $ta['page'];	
								}
							}elseif($k[0]=='tr_itmodet') {
								//����� ������� �������
								$k[1] = str_replace(',','" OR `item_id` = "',$k[1]);
								$qlst = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND (`item_id` = "'.$k[1].'") AND `inOdet` > 0 AND `inTransfer` = 0 AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
								if(!isset($qlst['id'])){
									$go1 = 0;
									$itmqs = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.$k[1].'" LIMIT 1'));
									if(isset($itmqs['id'])) {
										$txt .= '<br><b><font color=red>��������� ������� &quot;'.$itmqs['name'].'&quot;.</font>';
									}
									$pg = $ta['page'];	
								}
							}elseif($k[0]=='tr_noitmodet') {
								//����� ������� �������
								$k[1] = str_replace(',','" OR `item_id` = "',$k[1]);
								$qlst = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND (`item_id` = "'.$k[1].'") AND `inOdet` > 0 AND `inTransfer` = 0 AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
								if(isset($qlst['id'])){
									$go1 = 0;
									$itmqs = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.$k[1].'" LIMIT 1'));
									if(isset($itmqs['id'])) {
										$txt .= '<br><b><font color=red>� ��� ��� ���� ��������� ������� &quot;'.$itmqs['name'].'&quot;.</font>';
									}
									$pg = $ta['page'];	
								}
							}elseif($k[0]=='tr_noitm') {
								//����� ������� �������
								$k[1] = str_replace(',','" OR `item_id` = "',$k[1]);
								$qlst = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND (`item_id` = "'.$k[1].'") AND `inTransfer` = 0 AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
								if(isset($qlst['id'])){
									$go1 = 0;
									$itmqs = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.$k[1].'" LIMIT 1'));
									if(isset($itmqs['id'])) {
										$txt .= '<br><b><font color=red>� ��� ��� ���� ��������� ������� &quot;'.$itmqs['name'].'&quot;.</font>';
									}
									$pg = $ta['page'];	
								}
							}elseif($k[0]=='del_itm') {
								//����� ������� �������
								$qlst = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = "'.$k[1].'" AND `inOdet` = 0 AND `inTransfer` = 0 AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
								if(isset($qlst['id'])){
									$itmqs = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.$k[1].'" LIMIT 1'));
									if(isset($itmqs['id'])) {
										if(mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$qlst['id'].'" LIMIT 1')) {
											$txt .= '<br><b><font color=red>�� ������ &quot;'.$itmqs['name'].'&quot;</font>';
										}
									}
									$pg = $ta['page'];	
								}
							} elseif( $k[0] == 'needRep' ) {
								// �������� ������� ��������� � ������.
								$temp = explode(',', $k[1]);
								$needRep = array('city' => $temp[0], 'rep' => (int)$temp[1]); 
								if( isset($needRep) ) { # ��������� ���������. 
									if($u->rep['rep'.$needRep['city']] < $needRep['rep'] ) {
										$swapActStatus = 0;
										$go1 = 0;
										$txt = '<font color=red>� ���� ������ ����� �� �����, ����� ����� ��������!</font>';
										$pg = $ta['page'];
									}
								}
							}
							$i++;
						}
					}
					
					if(isset($act[1]) && $go1 == 1){
						$act1 = explode('=',$act[1]);
						$act0 = explode('=',$act[0]);
						if( $act0[0] == 'fileqst' ) {
							if(file_exists('_incl_data/class/quest/'.htmlspecialchars($act0[1]).'.php')) {
								include('_incl_data/class/quest/'.htmlspecialchars($act0[1]).'.php');
							}else{
								$txt .= '<br><b><font color=red>����� �� ������ � ������� NPS...</b></font>';
							}
							$pg = $act[1];
						}elseif( $act[0]=='dialog_act_update') {
							$act33 = $this->dialog_act_update($act[2]);
							if( $act33[0] == false ) {
								if( $act33[1] == '' ) {
									$txt .= '<br><b><font color=red>���-�� ����� �� ���...</b></font>';
								}else{
									$txt .= '<br><b><font color=red>'.$act33[1].'</font></b>';
								}
							}else{
								$txt .= '<br><b><font color=red>'.$act33[1].'</font></b>';
							}
							$pg = $act[1];
						}elseif( $act[0]=='quest_act' ) {
							$txt .= '<br><b><font color=red>�� �������� ����� �������.</b></font>';
							mysql_query('INSERT INTO `dialog_act` (
								`uid`,`city`,`time`,`var`,`val`,`btl_bot`,`itms`,`now`,`max`,`info`
							) VALUES (
								"'.$u->info['id'].'","'.$u->info['city'].'","'.time().'","'.mysql_real_escape_string($act1[0]).'","'.mysql_real_escape_string($act1[1]).'"
								,"'.mysql_real_escape_string($act1[3]).'","'.mysql_real_escape_string($act1[4]).'","'.mysql_real_escape_string($act1[5]).'","'.mysql_real_escape_string($act1[6]).'","'.mysql_real_escape_string($act1[7]).'"
							)');
							$pg = $act1[2];
							if( $act1[8] != 0 ) {
								//������ ������� ��� ������
								$itmb = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$act1[8].'" LIMIT 1'));
								if(isset($itmb['id'])) {
									$u->addItem($act1[8],$u->info['id'],'|nodelete=1');
									$txt .= '<br><b><font color=red>�� �������� ������� &quot;'.$itmb['name'].'&quot;</font></b>';
								}
							}
						}elseif( $act[0]=='buyitm' ) {
							$itmb = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$act1[0].'" LIMIT 1'));
							if(isset($itmb['id'])) {
								if( $u->info['money'] < $act1[1] ) {
									$txt .= '<br><b><font color=red>��� �� ������� ����� ��� ������� &quot;'.$itmb['name'].'&quot;, ��������� '.$act1[1].' ��.';
								}else{
									$act1dt = '';
									$txt .= '<br><b><font color=red>�� ������� ��������� &quot;'.$itmb['name'].'&quot;';
									if($act1[1] > 0) {
										$txt .= ' �� '.$act1[1].' ��.';
										$u->info['money'] -= $act1[1];
										mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
									}
									if($act1[2] > 0) {
										$txt .= ' �� '.$act1[2].' ���.';
									}
									if( $act1[3] > 0 ) {
										$txt .= ' �� ���� '.$u->timeOut($act1[3]).'';
										$act1dt .= '|srok='.$act1[3].'';
									}
									$txt .= '</font></b>';
									
									$u->addItem($itmb['id'],$u->info['id'],$act1dt);
									$pg = $act1[4];
								}
							}else{
								$txt .= '<br><b><font color=red>��������� ���������� �������...</font></b>';
								$pg = 1;	
							}
						}elseif( $act1[0]=='quest' ) {
							$pg = $act1[1];	
							$act2 = explode('=',$act[1]);													
							if($act2[0] > 0 && $q->testGood($act2[0])==1) {
								//������ �����
								if($act2[1]!='0') {
									//������ ��������
									$ic1 = 0;
									$act21 = explode(',',$act2[1]);
									while($ic1 < count($act21)) {
										$act3 = explode('-',$act21[$ic1]);
										$itmqs = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.$act3[0].'" LIMIT 1'));
										if(isset($itmqs['id'])) {
											if($act3[2] > 1) {
												//���������
												$txt .= '<br><b><font color=red>�� �������� ������� &quot;'.$itmqs['name'].'&quot; (x'.$act3[2].' ��.).</font></b>';
											}else{
												//����
												$txt .= '<br><b><font color=red>�� �������� ��������� ������� &quot;'.$itmqs['name'].'&quot;.</font></b>';
											}
											$ic2 = 1;
											while($ic2 <= $act3[2]) {
												$u->addItem($itmqs['id'],$u->info['id'],'|quest_item=1',array('del'=>$act3[3]));
												$ic2++;
											}
										}
										$ic1++;
									}
								}
								$q->startq($act2[0]);
								$txt .= '<br><b><font color=red>'.$u->error.'.</font></b>';
								$u->error = '';
							} else {
								$txt .= '<br><b><font color=red>�� ������� �������� �������, �� ������������� ������� ���������...</font></b>';	
							}
						} elseif($act[0]=='go' && $go1 == 1) {
							$pg = $act[1];	
						} elseif($act[0]=='goroom' && $go1 == 1) {
							$u->info['room'] = $act[1];
							mysql_query('UPDATE `users` SET `room` = "'.$u->info['room'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
							header('location: main.php');
							die();	
						} elseif( $act[0]=='flyrune_1_1' && $go1 == 1) {
									
							$trrep = 1000;	
							$runeid = 0;
							//				
							if( $act[2] == 1 ) {
								$runeid = 8233; //���
							}elseif( $act[2] == 2 ) {
								$runeid = 8234; //���
							}elseif( $act[2] == 3 ) {
								$runeid = 8235; //���
							}
							//
							if( $act[2] == 4 ) {
								$runeid = 8238; //����
							}elseif( $act[2] == 5 ) {
								$runeid = 8239; //����
							}elseif( $act[2] == 6 ) {
								$runeid = 8240; //����
							}elseif( $act[2] == 7 ) {
								$runeid = 8241; //����
							}
							//
							if( $act[2] == 8 ) {
								$runeid = 8242; //������
							}elseif( $act[2] == 9 ) {
								$runeid = 8243; //������
							}elseif( $act[2] == 10 ) {
								$runeid = 8244; //������
							}elseif( $act[2] == 11 ) {
								$runeid = 8245; //������
							}
							//
							if( $act[2] == 12 ) {
								$runeid = 8246; //����
							}elseif( $act[2] == 13 ) {
								$runeid = 8247; //����
							}elseif( $act[2] == 14 ) {
								$runeid = 8248; //����
							}elseif( $act[2] == 15 ) {
								$runeid = 8249; //����
							}
							//
							$trx = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `fly_buy` WHERE `uid` = "'.$u->info['id'].'" AND `runeid` = "'.$runeid.'" LIMIT 1'));
							$trx = 0+$trx[0];
							$trrep += $trx * 1000;
							
							
							if( $runeid > 0 ) {
								$u->error = '['.$runeid.']';
							}elseif( $runeid == 0 ) {
								$u->error = '���� �� �������!';
							}elseif( $u->buyrep($trrep) == false ) {
								$u->error = '� ��� ������������ ��������� � �������! ���������� '.$trrep.' ��.!' ;
							}else{	
								$itmf = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.$runeid.'" LIMIT 1'));
								mysql_query('INSERT INTO `fly_buy` (`uid`,`time`,`runeid`) VALUES ("'.$u->info['id'].'","'.time().'","'.$runeid.'")');							
								$u->error = '�� ��������� "'.$itmf['name'].'" �� ' . $trrep . ' ���������!' ;
								$u->addItem($runeid,$u->info['id'],'|sudba=1');
							}
							//
							$txt .= '<br><b><font color=red>'.$u->error.'.</font></b>';
							$u->error = '';	
							$pg = $act[1];
						} elseif($act[0]=='transfer2' && $go1 == 1) {
							//�������� �������������
							$txt = '';
							
							$xtik = 0; //��������� ����
							
							/*if( $act[1] == 1 ) {
								$txt .= '����� 1...';
								$xtik = 10;
								$itik = 4465;
								
							}elseif( $act[1] == 2 ) {
								$txt .= '����� 2...';
								$xtik = 5;
								$itik = 2143;
								
							}elseif( $act[1] == 3 ) {
								$txt .= '����� 3...';
								$xtik = 5;
								$itik = 2144;
								
							}elseif( $act[1] == 4 ) {
								$txt .= '����� 4...';
								$xtik = 6;
								//��� �����
								$itik = -1;
								
							}elseif( $act[1] == 5 ) {
								$txt .= '����� 5...';
								$xtik = 6;
								//��� ����
								$itik = -2;
								
							}else*/
							if( $act[1] == 6 ) {
								$txt .= '����� 6...';
								$xtik1 = 50;
								//������ 1
								$itik = -3;
								
							}elseif( $act[1] == 7 ) {
								$txt .= '����� 7...';
								$xtik2 = 30;
								//������ 2
								$itik = -3;
								
							}else{
								$txt .= '������������ �� ������ ���� ����...';
							}
							
							$txt = '�������� ������ ���� ������ 3 ������';
							
							$itms = array();
							$sp = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND (`item_id` = "6806" OR `item_id` = "6807") AND (`delete` = "0" OR `delete` = "1000") AND `inOdet` = "0" AND `inShop` = "0" LIMIT 100');
							while($pl = mysql_fetch_array($sp))	{
								$itms[$pl['item_id']]++;	
							}
		
							if( $u->info['admin'] > 0 ) {
								$itms[6806] += 100;
								$itms[6807] += 100;	
							}
		
							$t1 = $this->trnObj($itms[6806],$xtik1+0);
							$t2 = $this->trnObj($itms[6807],$xtik2+0);
							
							if(($t1[0] > 0 || $xtik1 == 0) && ($t2[0] > 0 || $xtik2 == 0)) {
								// $t[0] - ������� ��������� ������� ����,  $cn[$i]['add'][0] - item_id �������� �������
								//������� �����������
	
								$gdtik = 1;
	
								if( $gdtik == 1 ) {
									$upd1 = mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = "6806" AND (`delete` = "0" OR `delete` = "1000") AND `inOdet` = "0" AND `inShop` = "0" ORDER BY `inGroup` ASC LIMIT '.$xtik1.'');
									$upd2 = mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = "6807" AND (`delete` = "0" OR `delete` = "1000") AND `inOdet` = "0" AND `inShop` = "0" ORDER BY `inGroup` ASC LIMIT '.$xtik2.'');
									//echo 'UPDATE `items_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = "4504" AND (`delete` = "0" OR `delete` = "1000") AND `inOdet` = "0" AND `inShop` = "0" LIMIT '.$t[0].'';
									//if($upd1 && $upd2) {
										//���-�� ����������
										if( $itik == -3 ) {
											//������ +1
											mysql_query('DELETE FROM `users_ico` WHERE `uid` = "'.$u->info['id'].'" AND `time` > "'.(time()-30*86400).'" AND (`img` = "helloween_2014m1.gif" OR `img` = "helloween_2014m2.gif")');
											mysql_query('INSERT INTO `users_ico` (`uid`,`time`,`text`,`img`,`endTime`,`bonus`,`type`,`x`) VALUES (
												"'.$u->info['id'].'",
												"'.time().'",
												"<b>��������</b>`'.date('Y').'<br>���������� ����!",
												"helloween_2014m1.gif",
												"0",
												"add_exp=1",
												"1",
												"1"
											)');
											$txt = '�� �������� ������ &quot;��������`'.date('Y').'&quot;';
										}
									//}else{
									//	$txt = '���-�� ����� �� ���... ['.$itik.']';
									//}
								}else{
									$txt = '��������� ��������� �����...';
								}
							}else{
								$txt = '������������ ���� ��� ������...';
							}
							
							if($txt!=''){
								$txt = '<br><font color="red">'.$txt.'</font>';	
							}
							$pg = 3;
						} elseif($act[0]=='shizq' && $go1 == 1) {
								$txt = "<font color=red><b>�� �������� ���������� ���������...</font></b>";
								$u->addItem(8270,$u->info['id'],"sudba=1|frompisher=10");
								mysql_query('INSERT INTO `dialog_act` (`uid`,`city`,`time`,`var`,`val`,`max`,`info`) VALUES ('.$u->info['id'].',"capitalcity",'.time().',"shiz1",0,1,"�������� � ����� ���������� ���������")');
								$pg = 5;
						} elseif($act[0]=='shizq2' && $go1 == 1) {
								$txt = "<font color=red><b>�� �������� ������� ��������...</font></b>";
								$u->addItem(8271,$u->info['id'],"sudba=1|frompisher=10");
								mysql_query('INSERT INTO `dialog_act` (`uid`,`city`,`time`,`var`,`val`,`max`,`info`) VALUES ('.$u->info['id'].',"capitalcity",'.time().',"shiz2",0,1,"����������� ������")');
								$pg = 6;
						}elseif($act[0]=='transfer1' && $go1 == 1) {
							//������ ����� � ������ ����� �� ����������� �� ������
							//�� ������ � ���� ����... ���� ���, ���� ����� ������ ��!
							$pg = $act[1]; $itms = array();
							$sp = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND (`item_id` = "1002" OR `item_id` = "1003" OR `item_id` = "1004" OR `item_id` = "1005" OR (`item_id` >= "1009" AND`item_id` <= "1014")) AND (`delete` = "0" OR `delete` = "1000") AND `inOdet` = "0" AND `inShop` = "0"');
							while($pl = mysql_fetch_array($sp)) {
								$itms[$pl['item_id']]++;	
							}
							//��������
							$cn = array( 
								0 => 3, //���-�� �������������
								1 => array(
									//�����
									1     => array('n'=>'�����',0=>1002,1=>3,7=>9,8=>15),
									//����
									2     => array('n'=>'����',0=>1003,1=>1,7=>3,8=>5),
									//�������
									3     => array('n'=>'�������',0=>1005,1=>(1/3),7=>1,8=>2),
									'add' => array(0=>1006,1=>'�����') //������� ��������������, ��������� �����					
									), //������
								2 => array(
									//�����
									1     => array('n'=>'������ �����',0=>1009,1=>3,7=>9,8=>15),
									//����
									2     => array('n'=>'������� ����',0=>1010,1=>1,7=>3,8=>5),
									//�������
									3     => array('n'=>'������ �������',0=>1011,1=>(1/3),7=>1,8=>2),
									'add' => array(0=>1007,1=>'���������� �����') //������� ��������������, ��������� �����					
								), //�������
								3 => array(
									//�����
									1     => array('n'=>'����� � �������',0=>1012,1=>3,7=>9,8=>15),
									//����
									2     => array('n'=>'������ ����',0=>1013,1=>1,7=>3,8=>5),
									//�������
									3     => array('n'=>'������� �������',0=>1014,1=>(1/3),7=>1,8=>2),
									'add' => array(0=>1008,1=>'������� �����') //������� ��������������, ��������� �����		
								) //������
								);
								
							$i = 1;
							while($i<=$cn[0])
							{
								$j = 1;
								while($j<count($cn[$i][$j]))
								{
									
									$t = $cn[$i][$j];
									$t = $this->trnObj($itms[$cn[$i][$j][0]],$this->objLevel($cn[$i][$j],$u->info['level']));
									if($t[0]>0)
									{
										// $t[0] - ������� ��������� ������� ����,  $cn[$i]['add'][0] - item_id �������� �������
										//������� �����������
										$upd = mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = "'.$cn[$i][$j][0].'" AND (`delete` = "0" OR `delete` = "1000") AND `inOdet` = "0" AND `inShop` = "0" LIMIT '.($t[0]*$this->objLevel($cn[$i][$j],$u->info['level'])).'');
										if($upd)
										{
											$data = '|frompisher='.$d->info['id2'];
											$e = 1;
											while($e<=$t[0])
											{
												$u->addItem($cn[$i]['add'][0],$u->info['id'],$data);
												$e++;
											}
											$txt .= $cn[$i][$j]['n'].' x'.($t[0]*$this->objLevel($cn[$i][$j],$u->info['level'])).' = '.$cn[$i]['add'][1].' x'.$t[0].'<br>';
										}else{
											$txt .= '�� ������� �������� ������� &quot;'.$cn[$i][$j]['n'].'&quot;, ���-�� �� ��� ...<br>';	
										}
									}
									$j++;	
								}
								$i++;
							}

							if($txt!='') {
								$txt = '<br><font color="red">'.$txt.'</font>';	
							}
						}elseif($act[0]=='transferSpells30' && $go1 == 1) {
							
							//2553 2554
							
							$keypr1 = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `item_id` = "2553" LIMIT 1'));
							$keypr2 = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `item_id` = "2554" LIMIT 1'));
							
							$txt = '';
							
							if(isset($keypr1['id'],$keypr2['id'])) {
								mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$keypr1['id'].'" OR `id` = "'.$keypr2['id'].'" LIMIT 2');
								$data = '|frompisher='.$d->info['id2'];
								$u->addItem(2555,$u->info['id'],$data);
								$txt = '�� ������� �������� &quot;������������� ����&quot;';
							}
							
							if( $txt == '' ) {
								$txt = '���������� �������� ��� ������ �������...';
							}

							if($txt!='') {
								$txt = '<br><font color="red">'.$txt.'</font>';	
							}
							
						}elseif($act[0]=='transferSpells31' && $go1 == 1) {
							
							$pg = $act[1]; $itms = array();
							$sp = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND (`item_id` = "2560" OR `item_id` = "2564" OR `item_id` = "2568" OR `item_id` = "2572" OR `item_id` = "2576") AND (`delete` = "0" OR `delete` = "1000") AND `inOdet` = "0" AND `inShop` = "0"');
							while($pl = mysql_fetch_array($sp)) {
								$itms[$pl['item_id']]++;
								if( $itms[$pl['item_id']] > 3 ) {
									$itms[$pl['item_id']] = 3;
								}
							}
														
							$keypr = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `item_id` = "2555" LIMIT 1'));
							if(!isset($keypr['id'])) {
								$itms = array();
								$txt = '��������� &quot;������������� ����&quot;, � ��� ��� ���...';
							}
							
							//��������
							$cn = array( 
								0 => 5, //���-�� �������������
								1 => array(
									1     => array('n'=>'���������� ��������� [0]',0=>2560,8=>3,'add'=>array(2561,'���������� ��������� [1]')),	
									2     => array('n'=>'���������� ������ [0]',0=>2564,8=>3,'add'=>array(2565,'���������� ������ [1]')),
									3     => array('n'=>'���������� ����� [0]',0=>2568,8=>3,'add'=>array(2569,'���������� ����� [1]')),
									4     => array('n'=>'���������� �������� [0]',0=>2572,8=>3,'add'=>array(2573,'���������� �������� [1]')),
									5     => array('n'=>'���������� ���� [0]',0=>2576,8=>3,'add'=>array(2577,'���������� ���� [1]'))			
									)
								);
								
							$i = 1;
							while($i<=$cn[0])
							{
								$j = 1;
								while($j<=$cn[0])
								{
									$t = $cn[$i][$j];
									$t = $this->trnObj($itms[$cn[$i][$j][0]],$this->objLevel($cn[$i][$j],8));
									if($t[0]>0)
									{
										$upd = mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = "'.$cn[$i][$j][0].'" AND (`delete` = "0" OR `delete` = "1000") AND `inOdet` = "0" AND `inShop` = "0" LIMIT '.($t[0]*$this->objLevel($cn[$i][$j],$u->info['level'])).'');
										if($upd)
										{
											$data = '|frompisher='.$d->info['id2'];
											$e = 1;
											while($e<=$t[0])
											{
												$u->addItem($cn[$i][$j]['add'][0],$u->info['id'],$data);
												$e++;
											}
											mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$keypr['id'].'" LIMIT 1');
											$txt .= $cn[$i][$j]['n'].' x'.($t[0]*$this->objLevel($cn[$i][$j],$u->info['level'])).' = '.$cn[$i][$j]['add'][1].' x'.$t[0].'<br>';
										}else{
											$txt .= '�� ������� �������� ������� &quot;'.$cn[$i][$j]['n'].'&quot;, ���-�� �� ��� ...<br>';	
										}
										//$i = $cn[0];
										//$j = count($cn[$i][$j]);
									}
									$j++;	
								}
								$i++;
							}

							if( $txt == '' ) {
								$txt = '� ��� �� ������� ����������� ���������...';
							}

							if($txt!='') {
								$txt = '<br><font color="red">'.$txt.'</font>';	
							}
							
						}elseif($act[0]=='transferSpells32' && $go1 == 1) {
							
							$pg = $act[1]; $itms = array();
							$sp = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND (`item_id` = "2561" OR `item_id` = "2565" OR `item_id` = "2569" OR `item_id` = "2573" OR `item_id` = "2577") AND (`delete` = "0" OR `delete` = "1000") AND `inOdet` = "0" AND `inShop` = "0"');
							while($pl = mysql_fetch_array($sp)) {
								$itms[$pl['item_id']]++;
								if( $itms[$pl['item_id']] > 3 ) {
									$itms[$pl['item_id']] = 3;
								}	
							}
							
							$keypr = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `item_id` = "2555" LIMIT 1'));
							if(!isset($keypr['id'])) {
								$itms = array();
								$txt = '��������� &quot;������������� ����&quot;, � ��� ��� ���...';
							}
							
							//��������
							$cn = array( 
								0 => 5, //���-�� �������������
								1 => array(
									1     => array('n'=>'���������� ��������� [1]',0=>2561,8=>3,'add'=>array(2562,'���������� ��������� [2]')),	
									2     => array('n'=>'���������� ������ [1]',0=>2565,8=>3,'add'=>array(2566,'���������� ������ [2]')),
									3     => array('n'=>'���������� ����� [1]',0=>2569,8=>3,'add'=>array(2570,'���������� ����� [2]')),
									4     => array('n'=>'���������� �������� [1]',0=>2573,8=>3,'add'=>array(2574,'���������� �������� [2]')),
									5     => array('n'=>'���������� ���� [1]',0=>2577,8=>3,'add'=>array(2578,'���������� ���� [2]'))			
									)
								);
								
							$i = 1;
							while($i<=$cn[0])
							{
								$j = 1;
								while($j<=$cn[0])
								{
									
									$t = $cn[$i][$j];
									$t = $this->trnObj($itms[$cn[$i][$j][0]],$this->objLevel($cn[$i][$j],8));
									if($t[0]>0)
									{
										$upd = mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = "'.$cn[$i][$j][0].'" AND (`delete` = "0" OR `delete` = "1000") AND `inOdet` = "0" AND `inShop` = "0" LIMIT '.($t[0]*$this->objLevel($cn[$i][$j],$u->info['level'])).'');
										if($upd)
										{
											$data = '|frompisher='.$d->info['id2'];
											$e = 1;
											while($e<=$t[0])
											{
												$u->addItem($cn[$i][$j]['add'][0],$u->info['id'],$data);
												$e++;
											}
											mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$keypr['id'].'" LIMIT 1');
											$txt .= $cn[$i][$j]['n'].' x'.($t[0]*$this->objLevel($cn[$i][$j],$u->info['level'])).' = '.$cn[$i][$j]['add'][1].' x'.$t[0].'<br>';
										}else{
											$txt .= '�� ������� �������� ������� &quot;'.$cn[$i][$j]['n'].'&quot;, ���-�� �� ��� ...<br>';	
										}
										$i = $cn[0];
										$j = count($cn[$i][$j]);
									}
									$j++;	
								}
								$i++;
							}

							if( $txt == '' ) {
								$txt = '� ��� �� ������� ����������� ���������...';
							}

							if($txt!='') {
								$txt = '<br><font color="red">'.$txt.'</font>';	
							}
							
						}elseif($act[0]=='transferSpells33' && $go1 == 1) {
							
							$pg = $act[1]; $itms = array();
							$sp = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND (`item_id` = "2562" OR `item_id` = "2566" OR `item_id` = "2570" OR `item_id` = "2574" OR `item_id` = "2578") AND (`delete` = "0" OR `delete` = "1000") AND `inOdet` = "0" AND `inShop` = "0"');
							while($pl = mysql_fetch_array($sp)) {
								$itms[$pl['item_id']]++;	
								if( $itms[$pl['item_id']] > 3 ) {
									$itms[$pl['item_id']] = 3;
								}
							}
							
							$keypr = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `item_id` = "2555" LIMIT 1'));
							if(!isset($keypr['id'])) {
								$itms = array();
								$txt = '��������� &quot;������������� ����&quot;, � ��� ��� ���...';
							}
							
							//��������
							$cn = array( 
								0 => 5, //���-�� �������������
								1 => array(
									1     => array('n'=>'���������� ��������� [2]',0=>2562,8=>3,'add'=>array(2563,'���������� ��������� [3]')),	
									2     => array('n'=>'���������� ������ [2]',0=>2566,8=>3,'add'=>array(2567,'���������� ������ [3]')),
									3     => array('n'=>'���������� ����� [2]',0=>2570,8=>3,'add'=>array(2571,'���������� ����� [3]')),
									4     => array('n'=>'���������� �������� [2]',0=>2574,8=>3,'add'=>array(2575,'���������� �������� [3]')),
									5     => array('n'=>'���������� ���� [2]',0=>2578,8=>3,'add'=>array(2579,'���������� ���� [3]'))			
									)
								);
								
							$i = 1;
							while($i<=$cn[0])
							{
								$j = 1;
								while($j<=$cn[0])
								{
									
									$t = $cn[$i][$j];
									$t = $this->trnObj($itms[$cn[$i][$j][0]],$this->objLevel($cn[$i][$j],8));
									if($t[0]>0)
									{
										$upd = mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = "'.$cn[$i][$j][0].'" AND (`delete` = "0" OR `delete` = "1000") AND `inOdet` = "0" AND `inShop` = "0" LIMIT '.($t[0]*$this->objLevel($cn[$i][$j],$u->info['level'])).'');
										if($upd)
										{
											$data = '|frompisher='.$d->info['id2'];
											$e = 1;
											while($e<=$t[0])
											{
												$u->addItem($cn[$i][$j]['add'][0],$u->info['id'],$data);
												$e++;
											}
											$txt .= $cn[$i][$j]['n'].' x'.($t[0]*$this->objLevel($cn[$i][$j],$u->info['level'])).' = '.$cn[$i][$j]['add'][1].' x'.$t[0].'<br>';
											mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$keypr['id'].'" LIMIT 1');
										}else{
											$txt .= '�� ������� �������� ������� &quot;'.$cn[$i][$j]['n'].'&quot;, ���-�� �� ��� ...<br>';	
										}
										$i = $cn[0];
										$j = count($cn[$i][$j]);
									}
									$j++;	
								}
								$i++;
							}

							if( $txt == '' ) {
								$txt = '� ��� �� ������� ����������� ���������...';
							}

							if($txt!='') {
								$txt = '<br><font color="red">'.$txt.'</font>';	
							}
							
						}elseif( $act[0] == 'swapItem' && $go1 == 1) {
							$txt = '';
							$swapItem = $act[1];
							$swapError = $act[2];
							$swapTrue = $act[3];
							# ���������� �������� � �������� (���������� �������)
							if( !isset($swapActStatus) ) $swapActStatus = 1; # ��� ����, ������� ���!
							$swapAct = array();  # �������� ������ �� ������.
							$temp = explode ("\\", $swapItem);
							foreach ( $temp as $t ) {
								$t = explode('=', $t); 
								if( $t[0] == 'tr'  ) { // ����� ��� ������
									$temp2 = explode(',', $t[1]); $tr_items = array();
									foreach( $temp2 as $t2 ) {
										$temp3 = explode('x', $t2);
										if( !isset($temp3[1]) ) $temp3[1] = 1; // ���� ���������� �� ������, ������ 1��.
										if( isset($temp3[2]) && $temp3[2]=='del' ) $temp3[2] = true; else $temp3[2]=false; // ������� ���� ��� ��������� ������� ��������� �����!
										$tr_items[] = array('item_id' => $temp3[0], 'colvo' => (int)$temp3[1], 'delete' => $temp3[2]);
									}
									$swapAct['tr'] = $tr_items;
									
								} elseif( $t[0] == 'needQuest' ){ // ���� ����� �����-�� ����� ��� ������������. 
									
								} elseif( $t[0] == 'needRep' ){ // ���� ����� ��������� � ���������� 
									$temp2 = explode(',', $t[1]); $need_rep = array();
									$need_rep[] = array('city' => $temp2[0], 'rep' => (int)$temp2[1]);
									
									$swapAct['need_rep'] = $need_rep;
									
								} elseif( $t[0] == 'add' ){ // ����� �������� ����.
									$temp2 = explode(',', $t[1]); $add_items = array();
									foreach($temp2 as $t2) {
										$temp3 = explode('x', $t2);
										if( !isset($temp3[1]) ) $temp3[1] = 1; // ���� ���������� �� ������, ������ 1��.
										$add_items[] = array('item_id' => $temp3[0], 'colvo' => (int)$temp3[1]);
									}
									$swapAct['add'] = $add_items; 
								} elseif( $t[0] == 'uses' ){ // ���� ����� ��������� � ����������
									$swapAct['uses'] = $t[1];
								}
							} // ���� ��������� ������ ���������.
							unset($temp,$temp2,$temp3,$t2,$tr_items,$add_items);
							
							if( $swapActStatus == 0 ) {
								$txt = '� ���� ������ ����� �� �����, ����� ����� ��������!';
								$pg = $swapError; 
							} elseif ( isset($swapAct['need_rep']) ) { # ��������� ���������.
								foreach($swapAct['need_rep'] as $rep) { # ���� ��������� ���������
									if($u->rep['rep'.$rep['city']] < $rep['rep'] ) {
										$swapActStatus = 0;
										$txt = '� ���� ������ ����� �� �����, ����� ����� ��������!';
										$pg = $swapError; 
									}
								}
							}

							if( isset($swapAct['uses']) ) { # ��������� ���������� ��� �������������.
								#$swapAct['uses'] = mysql_fetch_array(mysql_query('SELECT `id`,`vals` FROM `actions` WHERE `room` = "'.$u->info['room'].'" AND `vals` = "masteryUses'.$u->info['dnow'].'" ORDER BY `id` DESC LIMIT '.$swapAct['uses'] .''));
								if( isset($swapAct['uses']['id']) ) {
									$swapActStatus = 0;
									$txt = '���-�� ��� ������� ����� � �������� �������, ������ �� ���������...';
									$pg = 0; 
								}
							} 

							if( isset($swapAct['tr']) AND $swapActStatus == 1 ) { # ��������� ����������� ��������.
								foreach($swapAct['tr'] as $item) { # ���� ��������� ���������. 
									$item_info = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$item['item_id'].'" LIMIT 1'));
									if( isset($item_info['id']) ) {
										$query = mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "'.$item['item_id'].'" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inShop` = "0" AND `inOdet` = "0" LIMIT '.$item['colvo'].'');
										$j=0;
										while( $t = mysql_fetch_array($query) ) {
											$j++;
										}
										if( $j < $item['colvo'] ) { 
											$txt .= '� ��� ������������ ��������� "'.$item_info['name'].'"!  ('.$item['item_id'].')<br/>';
											$swapActStatus = 3;
											$pg = $swapError;
										} elseif( $swapActStatus != 3) {
											$swapActStatus = 2;
										}
									}
								}
							}

							if( isset($swapAct['tr']) AND $swapActStatus == 3 ) { # �������� �������� del==true.
								$mess = '������������� �������: ';
								$qsw = 0;
								foreach($swapAct['tr'] as $item) { # ���� ��������� ���������.
									if ( $item['delete'] == true ){
										$query = mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `item_id` = "'.$item['item_id'].'" AND `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inShop` = "0" AND `inOdet` = "0" ORDER BY inGroup DESC LIMIT '.$item['colvo'].''); 
										if($query){
											$item_info = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$item['item_id'].'" LIMIT 1'));
											if( $qsw > 0 ) $mess .=', ';
											$mess .= '"'.$item_info['name'].'"';
											if( $item['colvo'] > 1 ) $mess .= '('.$item['item_id'].'��)';
											$qsw++;	
										}
									}
								}
								$mess .= '.<br/>';
								if( $qsw > 0 ) $txt .= $mess;
							} elseif( isset($swapAct['tr']) AND $swapActStatus == 2 ) { # �������� �������� ���. 
								$mess = '������������� �������: ';
								$qsw = 0;
								foreach($swapAct['tr'] as $item) {
									$query = mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `item_id` = "'.$item['item_id'].'" AND `uid` = "'.$u->info['id'].'" AND (`delete` = "0" OR `delete` = "1000") AND `inShop` = "0" AND `inOdet` = "0" ORDER BY inGroup DESC LIMIT '.$item['colvo'].'');
									if($query) {
										$item_info = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$item['item_id'].'" LIMIT 1'));
										if( $qsw > 0 ) $mess .=', ';
										$mess .= '"'.$item_info['name'].'"';
										if( $item['colvo'] > 1 ) $mess .= '('.$item['item_id'].'��)';
										$qsw++;
									}
								}
								$mess .= '.<br/>';
								if( $qsw > 0 ) $txt .= $mess;
							}
							
							if( isset($swapAct['add']) AND $swapActStatus == 2 ) { # ������ ��������. 
								foreach($swapAct['add'] as $item) {
									$qsw = 0;
									while($qsw < $item['colvo']) {
										$txt .= '<br/>�� �������� �������';
										$u->addItem($item['item_id'],$u->info['id']);
										$qsw++;
									}
								}
								
mysql_query('INSERT INTO `actions` (`uid`,`time`,`city`,`room`,`vars`,`ip`,`vals`) VALUES ("'.$u->info['id'].'","'.time().'","'.$u->info['city'].'","'.$u->info['room'].'", "","'.mysql_real_escape_string($_SERVER['HTTP_X_REAL_IP']).'", "masteryUses'.$u->info['dnow'].'")');
								$pg = $swapTrue;
							}
							if( $txt != '' ) {
								$txt = '<br><font color="red">'.$txt.'</font>';	
							}
						}
					}
				}
			}
						
			if($this->info['tr_room']!=0 && $this->info['tr_room']!=$u->info['room'])
			{
				$go = 0;	
			}
						
			if($this->info['tr_dn']!=0) {
				//������� ������
				global $d;
				if($this->info['tr_dn']!=$d->info['id2'])
				{
					$go = 0;
				}elseif($this->info['x']!=0 || $this->info['y']!=0)
				{
					if($d->testLike($u->info['x'],$u->info['y'],$this->info['x'],$this->info['y'])!=1)
					{						
						$go = 0;
					}
					//���� ��� �����
					$dbot = mysql_fetch_array(mysql_query('SELECT * FROM `dungeon_bots` WHERE `dn` = "'.$u->info['dnow'].'" AND `x` = "'.$this->info['x'].'" AND `y` = "'.$this->info['y'].'" LIMIT 1'));
					if(!isset($dbot['id2']))
					{
						$go = 0;
					}
				}
			}

			if($go==1) {
				//dlg_nps:=:3=7
				//����� (� ��������)
				$qs_sp = mysql_query('SELECT `id`,`act_date` FROM `quests` WHERE `act_date` LIKE "%dlg_nps:=:'.$this->info['id'].'='.$pg.'=1=e%" LIMIT 1');
				while($qs_pl = mysql_fetch_array($qs_sp)) {
					$q->endq($qs_pl['id'],'win');
					$gsex = explode('=e'.$this->info['id'].$pg.'=',$qs_pl['act_date']);
					if($gsex[1] > 0) {
						//������ ���������� �����
						$q->startq($gsex[1]);
						$txt .= '<br><font color="red"><b>������� ����������</b></font>';
					}
				}
				
				//����� (��� ��������)
				$qs_sp = mysql_query('SELECT `id`,`act_date` FROM `quests` WHERE `act_date` LIKE "%dlg_nps:=:'.$this->info['id'].'='.$pg.'=0=e%" LIMIT 1');
				while($qs_pl = mysql_fetch_array($qs_sp)) {
					$q->endq($qs_pl['id'],'end');
					$gsex = explode('=e'.$this->info['id'].$pg.'=',$qs_pl['act_date']);
					if($gsex[1] > 0) {
						//������ ���������� ����� $gsex[1]
						$q->startq($gsex[1]);
						$txt .= '<br><font color="red"><b>������� ����������</b></font>';
					}
				}
				
				$this->title = $this->info['text'];
				$this->youInfo = $u->getInfoPers($u->info['id'],1);
				$this->youInfo = $this->youInfo[0];
				$this->botInfo = $this->infoBot($this->info['bot_id']);
				//������
				$qpl = mysql_fetch_array(mysql_query('SELECT * FROM `dungeon_dlg` WHERE `type` = "1" AND `qid` = "0" AND `id_dg` = "'.$this->info['id'].'" AND `page` = "'.((int)$pg).'" LIMIT 1'));
				if( !isset($qpl['id']) ) {
					if($txt == '' ){
						$qpl['text'] = '������ �� ������ ...';	
					} else {
						$qpl['text'] = $txt.' (<a href="main.php?rnd='.$code.'">����</a>)';
						$txt = '';
					}
				} else {
					$this->pg = $qpl['id'];
				}
				
				if( $u->info['admin'] > 0 ) {
					if( isset($_GET['add_new_qid']) ) {
						mysql_query('INSERT INTO `dungeon_dlg` (`type`,`qid`,`id_dg`,`text`) VALUES ("0","'.$qpl['id'].'","'.$this->info['id'].'","<i>����� ������� ������</i>")');
					}
				}
				
				//�������� ������
				$a = '';
				$sp = mysql_query('SELECT * FROM `dungeon_dlg` WHERE `type` = "0" AND `qid` = "'.$qpl['id'].'" AND `id_dg` = "'.$this->info['id'].'" ORDER BY `sort` DESC LIMIT 25');
				while($pl = mysql_fetch_array($sp))
				{
					$pl['action'] = $this->ltr($pl['action']);
					$act = explode('|',$pl['action']);
					if(isset($act[1]))
					{
						$pl['action'] = 'main.php?talk='.$this->info['id'].'&act='.$pl['id'].'&rnd='.$code;	
					}
					$go1 = '';
					if($pl['tr'] != '') {
						$i = 0;
						$x = explode('|',$pl['tr']);
						while($i < count($x)) {
							//����������
							$k = explode('=',$x[$i]);	

							if($k[0]=='data') {
								$date = explode('-',$k[1]);
								$dd1 = $date[0];
								$mm1 = $date[1];
								$dd2 = $date[2];
								$mm2 = $date[3];
								$date1 = strtotime($dd1.'-'.$mm1.'-'.date('Y'));
								$date2 = strtotime($dd2.'-'.$mm2.'-'.date('Y'));
								
								if( $date1 > time() || $date2 < time() ) {
									$go1 = 'delete';
									$i = count($x);
								}
								
							}elseif($k[0]=='diact') {
								//��������
								//user_id # all # all # lukaqst1 # -1
								if($this->quest_act($k[1])==false) {
									$go1 = 'delete';
									$i = count($x);
								}
							}elseif($k[0]=='quest_end') {
								//����� ����� ��������� ��������� ��� � ������� ������
								$qlst = mysql_fetch_array(mysql_query('SELECT `id`,`vals` FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "start_quest'.$k[1].'" ORDER BY `id` DESC LIMIT 1'));
								if(isset($qlst['id']) && $qlst['vals'] != 'win' && $qlst['vals'] != 'end' && $qlst['vals'] != 'bad') {
									//$go1 .= "�� ��� ����� ������ �������\n";
									$go1 = 'delete';
									$i = count($x);
								}
							}elseif($k[0]=='quest_only_one') {
								//����� ����� ��������� ������ ���� ���
								$qlst = mysql_fetch_array(mysql_query('SELECT `id`,`vals` FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "start_quest'.$k[1].'" ORDER BY `id` DESC LIMIT 1'));
								if(isset($qlst['id']) && ($qlst['vals'] == 'win' || $qlst['vals'] == 'bad')) {
									//$go1 .= "�� ��� ����� ������ �������\n";
									$go1 = 'delete';
									$i = count($x);
								}
							}elseif($k[0]=='quest_now') {
								//����� ������ ���� ����
								$qlst = mysql_fetch_array(mysql_query('SELECT `id`,`vals` FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "start_quest'.$k[1].'" ORDER BY `id` DESC LIMIT 1'));
								if(isset($qlst['id']) && $qlst['vals'] != 'win' && $qlst['vals'] != 'end' && $qlst['vals'] != 'bad'){}else{
									$go1 = 'delete';
									$i = count($x);
								}
							}elseif($k[0]=='tr_itm') {
								//����� ������� �������
								$qlst = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = "'.$k[1].'" AND `inOdet` = 0 AND `inTransfer` = 0 AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
								if(!isset($qlst['id'])){
									$go1 = 'delete';
									$i = count($x);
								}
							}elseif($k[0]=='tr_itmodet') {
								//����� ������� �������
								$k[1] = str_replace(',','" OR `item_id` = "',$k[1]);
								$qlst = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND (`item_id` = "'.$k[1].'") AND `inOdet` > 0 AND `inTransfer` = 0 AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
								if(!isset($qlst['id'])){
									$go1 = 'delete';
									$i = count($x);
								}
							}elseif($k[0]=='tr_noitmodet') {
								//����� ������� �������
								$k[1] = str_replace(',','" OR `item_id` = "',$k[1]);
								$qlst = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND (`item_id` = "'.$k[1].'") AND `inTransfer` = 0 AND `inOdet` > 0 AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
								if(isset($qlst['id'])){
									$go1 = 'delete';
									$i = count($x);
								}
							}elseif($k[0]=='tr_noitm') {
								//����� ������� �������
								$k[1] = str_replace(',','" OR `item_id` = "',$k[1]);
								$qlst = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND (`item_id` = "'.$k[1].'") AND `inTransfer` = 0 AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
								if(isset($qlst['id'])){
									$go1 = 'delete';
									$i = count($x);
								}
							}
							$i++;
						}
					}
					
					if($this->info['id'] == 11) {
						$talk_11 = mysql_fetch_array(mysql_query('SELECT `id2` FROM `dungeon_bots` WHERE ((`id_bot` = "285" && `x` = "8" && `y` = "89") OR (`id_bot` = "285" && `x` = "8" && `y` = "87") OR (`id_bot` = "285" && `x` = "7" && `y` = "86") OR (`id_bot` = "285" && `x` = "7" && `y` = "86") OR (`id_bot` = "285" && `x` = "6" && `y` = "87") OR (`id_bot` = "285" && `x` = "6" && `y` = "89")) AND `delete` = "0" AND `dn` = "'.$u->info['dnow'].'" AND `for_dn` = "0" LIMIT 10'));
					}elseif($this->info['id'] == 13) {
						$talk_13 = mysql_fetch_array(mysql_query('SELECT `id2` FROM `dungeon_bots` WHERE ((`id_bot` = "285" && `x` = "1" && `y` = "82") OR (`id_bot` = "278" && `x` = "0" && `y` = "82") OR (`id_bot` = "278" && `x` = "-1" && `y` = "82") OR (`id_bot` = "278" && `x` = "-1" && `y` = "80") OR (`id_bot` = "278" && `x` = "0" && `y` = "80") OR (`id_bot` = "285" && `x` = "1" && `y` = "80") OR (`id_bot` = "285" && `x` = "2" && `y` = "81") OR (`id_bot` = "286" && `x` = "0" && `y` = "81") ) AND `delete` = "0" AND `dn` = "'.$u->info['dnow'].'" AND `for_dn` = "0" LIMIT 10'));
					}
					
					if($u->info['admin'] > 0) {
						$a .= '<small>(<a href="javascript:window.open(\'http://likebk.com/quest_dlg_edit.php?pid='.$pl['id'].'\',\'winEdi1\',\'width=850,height=400,top=400,left=500,resizable=no,scrollbars=yes,status=no\');" title="������������� ������� ������">���.</a>)</small> &nbsp; ';
					}
					
					if($go1 == '') {
						if(isset($talk_11['id2']) || isset($talk_13['id2']) ) {
							$a .= '&bull; <a href="main.php">�� �� ������ ������������ ������, ������ ���� �������� �����... (����)';
						}else{
							$a .= '&bull; <a href="'.$pl['action'].'">'.$pl['text'].'</a><br>';
						}
					}elseif($go1 == 'delete') {
						if( $u->info['admin'] > 0 ) {
							$a .= '&bull; <a style="color:#aeaeae" href="'.$pl['action'].'">'.$pl['text'].'</a><br>';
						}
					}else{
						$a .= '<font color="#9A9A9A">&bull; <b>'.$pl['text'].'</b></font> <small title="'.$go1.'"> <b style="cursor:help"><font color=red>[?]</font></b></small><br>';
					}
					
				}
				
				
				if($u->info['admin'] > 0) {
					$a .= '<small style="border-top:1px solid #BABABA;padding-top:5px;display:block;margin-top:5px;"><a href="main.php?talk='.((int)$_GET['talk']).'&act='.((int)$_GET['act']).'&add_new_qid=1">�������� ������� ������</a></small>';
				}
				
				if(stristr($qpl['text'],'{lavka_rune_change}') == true) {
					$rnsupd = '';
					$sp = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND (`inOdet` = 63 OR `inOdet` = 64 OR `inOdet` = 66) LIMIT 3');
					while( $pl = mysql_fetch_array($sp) ) {
						$itmr = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$pl['item_id'].'" LIMIT 1'));
						$trtub = 1 + $pl['blvl'];
						$runx = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = "3136" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
						$runx = $runx[0];
						$erkr = 0.1 * (1 + $pl['blvl']);
						if( $pl['id'] == $_GET['updaterune'] ) {
							if( $pl['bexp'] < ((1+$pl['blvl'])*10000) ) {
								$rnsupd .= '<div><b><font color="red">&nbsp; &nbsp;������������ ����� ��� �������� ����!';
							}elseif( $pl['blvl']+1 > $u->info['level'] ) {
								$rnsupd .= '<div><b><font color="red">&nbsp; &nbsp;������� ���� �� ����� ��������� ������� ���������!';
							}elseif( $u->bank['money2'] < $erkr ) {
								$rnsupd .= '<div><b><font color="red">&nbsp; &nbsp;� ��� ������������ ����� ��� �������� ����!';
							}elseif( $runx < $trtub ) {
								$rnsupd .= '<div><b><font color="red">&nbsp; &nbsp;� ��� ������������ <span title="item_id: 3136">�������� �������</span> ��� �������� ����!';
							}else{
								$rnsupd .= '<div><b><font color="red">&nbsp; &nbsp;���� &quot;'.$itmr['name'].'&quot; ���� ������� �� '.$erkr.' ���. � '.$trtub.' �������� �������!</font></b></div>';
								//
								$po = $u->lookStats($pl['data']); 
								//��������� ����
								$pl['blvl']++;
								if( $pl['blvl'] == 5 || $pl['blvl'] == 10 || $pl['blvl'] == 15 || $pl['blvl'] == 20 ) {
									//��������� +1 ����
									if( $po['add_s1'] > 0 ) {
										$po['add_s1']++;
									}elseif( $po['add_s2'] > 0 ) {
										$po['add_s2']++;
									}elseif( $po['add_s3'] > 0 ) {
										$po['add_s3']++;
									}elseif( $po['add_s5'] > 0 ) {
										$po['add_s5']++;
									}
									//��������� �� � ��
									if( $po['add_hpAll'] > 0 ) {
										$po['add_hpAll'] += 25;
									}elseif( $po['add_mpAll'] > 0 ) {
										$po['add_mpAll'] += 50;
									}
									//
								}
								//��������� ���������
								//
								$parrun = array(
									8233 => array('add_min_use_mp',0.3),
									8234 => array('add_pzm',0.3),
									8235 => array('add_mpAll',10),
									8238 => array('add_m3',0.5),
									8239 => array('add_m5',5),
									8240 => array('add_m2',5),
									8241 => array('add_m1',5),
									8242 => array('add_m6',0.5),
									8243 => array('add_m7',0.3),
									8244 => array('add_m2',5),
									8245 => array('add_m4',5),
									8246 => array('add_m8',0.3),
									8247 => array('add_za',1.5),
									8248 => array('add_m2',5),
									8249 => array('add_m5',5)
								);
								$po['tr_lvl'] = $pl['blvl'];
								$po[$parrun[$pl['item_id']][0]] += $parrun[$pl['item_id']][1];
								//
								$po = $u->impStats($po);
								$pl['data'] = $po;
								$pl['bexp'] = 0;
								//
								mysql_query('UPDATE `bank` SET `money2` = `money2` - "'.round($erkr,2).'" WHERE `uid` = "'.$u->info['id'].'"');
								$u->bank['money2'] -= $erkr;
								mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = "3136" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$trtub);
								mysql_query('UPDATE `items_users` SET `data` = "'.mysql_real_escape_string($pl['data']).'" , `blvl` = "'.$pl['blvl'].'" , `bexp` = "'.$pl['bexp'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
								//
							}
						}
						if( $pl['bexp'] < ((1+$pl['blvl'])*10000) && $u->info['admin'] == 0 ) {
							$rnsupd .= '<div><b><font color="#CCC">&bull;</font> '.$itmr['name'].' <small>(�������: '.$pl['blvl'].' , ����: '.$pl['bexp'].'/'.((1+$pl['blvl'])*10000).')</small></b> (������������ �����)</div>';
						}else{
							$rnsupd .= '<div><a href="/main.php?talk=15&act=455&updaterune='.$pl['id'].'"><font color="blue">&bull;</font> '.$itmr['name'].' <small>(�������: '.$pl['blvl'].' , ����: '.$pl['bexp'].'/'.((1+$pl['blvl'])*10000).')</small> ������� �� '.$erkr.' ���. � '.$trtub.' �������� �������</a></div>';
						}
						$rnsupd .= '</font>';
					}
					if( $rnsupd == '' ) {
						$rnsupd = '<br><font color="red">(��� �������� ���� � ���������� ������ �� ���������!)</font>';
					}
					$qpl['text'] = str_replace('{lavka_rune_change}',$rnsupd,$qpl['text']);
				}
				
				$this->dText = $qpl['text'].'<br>'.$txt;
				$this->aText = $a;				
			}else{
				$this->aText = '<center>������ �� ��������, ��������� <a href="main.php?rnd='.$code.'">�����</a><br></center>';		
			}
		}else{
			$this->aText = '<center>������ �� ������, ��������� <a href="main.php?rnd='.$code.'">�����</a><br><font color="white">'.((int)$id).'</font></center>';	
		}
	}
	
	public function ltr($v)
	{
		
		return $v;	
	}
	
	public function infoBot($id)
	{
		global $c,$code;
		$r = '';
		$bot = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `id` = "'.((int)$id).'" LIMIT 1'));
		if(isset($bot['id']))
		{
			//�������������� �� ��������� � �� �����������
			$witm    = array();
			$witm[1] = '<img width="60" height="60" style="display:block;" title="������ ���� ����" src="http://img.likebk.com/i/items/w/w9.gif">';
			$witm[2] = '<img width="60" height="40" style="display:block;" title="������ ���� ������" src="http://img.likebk.com/i/items/w/w13.gif">';
			$witm[3] = '<img width="60" height="60" style="display:block;" title="������ ���� ������" src="http://img.likebk.com/i/items/w/w3.gif">';
			$witm[4] = '<img width="60" height="80" style="display:block;" title="������ ���� �����" src="http://img.likebk.com/i/items/w/w4.gif">';
			$witm[7] = '<img width="60" height="40" style="display:block;" title="������ ���� ����" src="http://img.likebk.com/i/items/w/w5.gif">';
			$witm[8] = '<img width="60" height="20" style="display:block;" title="������ ���� ������" src="http://img.likebk.com/i/items/w/w1.gif">';
			$witm[9] = '<img width="60" height="20" style="display:block;" title="������ ���� ��������" src="http://img.likebk.com/i/items/w/w2.gif">';
			$witm[10] = '<img width="20" height="20" style="display:block;" title="������ ���� ������" src="http://img.likebk.com/i/items/w/w6.gif">';
			$witm[11] = '<img width="20" height="20" style="display:block;" title="������ ���� ������" src="http://img.likebk.com/i/items/w/w6.gif">';
			$witm[12] = '<img width="20" height="20" style="display:block;" title="������ ���� ������" src="http://img.likebk.com/i/items/w/w6.gif">';
			$witm[13] = '<img width="60" height="40" style="display:block;" title="������ ���� ��������" src="http://img.likebk.com/i/items/w/w11.gif">';
			$witm[14] = '<img width="60" height="60" style="display:block;" title="������ ���� ���" src="http://img.likebk.com/i/items/w/w10.gif">';
			$witm[16] = '<img width="60" height="80" style="display:block;" title="������ ���� ������" src="http://img.likebk.com/i/items/w/w19.gif">';
			$witm[17] = '<img width="60" height="40" style="display:block;" title="������ ���� �����" src="http://img.likebk.com/i/items/w/w12.gif">';
			//40-52 ���� ��� �����		
			$witm[53] = '<img style="display:block;" title="������ ���� ������ ������" src="http://img.likebk.com/i/items/w/w15.gif">';
			$witm[54] = '<img style="display:block;" title="������ ���� ����� ������" src="http://img.likebk.com/i/items/w/w15.gif">';
			$witm[55] = '<img style="display:block;" title="������ ���� ����������� ������" src="http://img.likebk.com/i/items/w/w15.gif">';
			$witm[56] = '<img style="display:block;" title="������ ���� �����" src="http://img.likebk.com/i/items/w/w20.gif">';
			$witm[57] = '<img style="display:block;" title="������ ���� �����" src="http://img.likebk.com/i/items/w/w20.gif">';
			$witm[58] = '<img style="display:block;" title="������ ���� �����" src="http://img.likebk.com/i/items/w/w20.gif">';
			
			$pb = '';
			$hpmp = '??&nbsp;';
			$eff = '';
			$anml = '';
			$oi = '';
			$msl = '<img width="120" height="40" style="display:block" src="http://img.likebk.com/i/slot_bottom.gif">';
			$witmg = '';
			
			if( $bot['level'] < 0 ) {
				$bot['level'] = '??';
			}
			
			$r = '<div style="width:246px; padding:2px;" align="center"><b>'.$bot['login'].'</b> ['.$bot['level'].']<img src="http://img.likebk.com/i/inf_.gif"></div>
			<div style="width:240px; padding:2px; border-bottom:1px solid #666666; border-right:1px solid #666666; border-left:1px solid #FFFFFF; border-top:1px solid #FFFFFF;">
			<div align="center"><!-- blocked -->'.$pb.'</div>
			<table width="240" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="60" valign="top">
				<table width="60" height="280" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td height="60">'.$witm[1].'</td>
				  </tr>
				  <tr>
					<td height="40">'.$witm[2].'</td>
				  </tr>
				  <tr>
					<td height="60">'.$witm[3].'</td>
				  </tr>
				  <tr>
					<td height="80">'.$witm[4].'</td>
				  </tr>
				  <tr>
					<td height="40">'.$witm[7].'</td>
				  </tr>
				</table>
				</td>
				<td height="280" valign="top">
				<table width="120" height="280" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td height="20" valign="top">
					<!-- HP and MP -->
					'.$hpmp.'
					<!-- -->
					</td>
				  </tr>
				  <tr>
					<td valign="top">
					<div style="position:relative;height:220px;">
						<!-- ����� -->
							<div style="position:absolute; width:120px; height:220px; z-index:1;"><a href="#obraz_pers"><img width="120" height="220" src="http://img.likebk.com/i/obraz/'.$bot['sex'].'/'.$bot['obraz'].'" '.$oi.'></a></div>
							<div style="position:absolute; width:120px; height:220px; z-index:3;" align="left">'.$eff.'</div>'.$anml.'
					</div>
					</td>
				  </tr>
				  <tr>
					<td height="40"><div align="center">'.$msl.'</div></td>
				  </tr>
				</table>
				</td>
				<td width="60" valign="top">
				<table width="60" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td height="20">'.$witm[8].'</td>
				  </tr>
				  <tr>
					<td height="20">'.$witm[9].'</td>
				  </tr>
				  <tr>
					<td height="20"><table width="60" border="0" cellspacing="0" cellpadding="0">
						<tr>
						  <td width="20" height="20">'.$witm[10].'</td>
						  <td width="20">'.$witm[11].'</td>
						  <td width="20">'.$witm[12].'</td>
						</tr>
					</table></td>
				  </tr>
				  <tr>
					<td height="40">'.$witm[13].'</td>
				  </tr>
				  <tr>
					<td height="60">'.$witm[14].'</td>
				  </tr>
				  <tr>
					<td height="80">'.$witm[16].'</td>
				  </tr>
				  <tr>
					<td height="40">'.$witm[17].'</td>
				  </tr>
				</table>
				</td>
			  </tr>
			</table>'.$witmg.'
			</div>';
		}else{
			$r = 'No information';	
		}
		return $r;
	}
}

$dialog = new dialog;
?>