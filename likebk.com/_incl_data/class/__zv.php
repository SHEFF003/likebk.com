<?
if(!defined('GAME')) { die(); }


session_start();

if( $u->info['id'] == 35447902 ) {
	$u->info['admin'] = 1;
}

/*class Balancer {
            public static function balance($items, $key)
            {
                    $result = array();
                    $maxWeight = floor(self::sum($items, $key) / 2);
                    $numItems = count($items);
                   
                    $sack = self::buildSack($numItems, $maxWeight);
                   
                    for ($n = 1; $n <= $numItems; $n++)
                    {
                            // loop all items
                            for ($weight = 1; $weight <= $maxWeight; $weight++)
                            {
                                    $a = $sack[$n - 1][$weight]['value'];
                                    $b = null;
                                    $value = $items[$n - 1][$key];
                                    if ($value <= $weight)
                                    {
                                            $b = $value + $sack[$n - 1][$weight - $value]['value'];
                                    }
                                    $sack[$n][$weight]['value'] = ($b === null ? $a : max($a, $b));
                                    $sack[$n][$weight]['take'] = ($b === null ? false : $b > $a);
                            }
                    }
                   
                    $setA = array();
                    $setB = array();
                   
                    for ($n = $numItems, $weight = $maxWeight; $n > 0; $n--)
                    {
                            $item = $items[$n - 1];
                            $value = $item[$key];
                            if ($sack[$n][$weight]['take'])
                            {
                                    $setA[] = $item;
                                    $weight = $weight - $value;
                            }
                            else
                            {
                                    $setB[] = $item;
                            }
                    }
                   
                    return array($setA, $setB);
            }
           
            protected static function sum($items, $key)
            {
                    $sum = 0;
                    foreach ($items as $item)
                    {
                            $sum += $item[$key];
                    }
                    return $sum;
            }
           
            protected static function buildSack($width, $height)
            {
                    $sack = array();
                    for ($x = 0; $x <= $width; $x++)
                    {
                            $sack[$x] = array();
                            for ($y = 0; $y <= $height; $y++) {
                                    $sack[$x][$y] = array(
                                            'value' => 0,
                                            'take' => false
                                    );
                            }
                    }
                    return $sack;
            }
}*/

//if( $u->info['id'] == 1008000 || $u->info['admin'] > 0 || $u->stats['silver'] > 0 ) {
$u->info['no_zv_key'] = true;
//}
$moder = mysql_fetch_array(mysql_query('SELECT * FROM `moder` WHERE `align` = "'.$u->info['align'].'" LIMIT 1'));
if(isset($_POST['code21'])) { }

if(isset($_GET['del_z_time']) && $_GET['del_z_time'] != null) {
  $zay = mysql_fetch_array(mysql_query('SELECT * FROM `zayvki` WHERE `id` = "'.(int)$_GET['del_z_time'].'" LIMIT 1'));
  $colls = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `zv` = "'.$zay['id'].'"'));
  $cs = $colls[0];
  if(isset($zay['id'])) {
	if($u->info['zv'] == $zay['id'] && ($zay['creator'] == $u->info['id'])) {
	  if($cs == 1) {
	    mysql_query('UPDATE `stats` SET `zv` = 0 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		mysql_query('DELETE FROM `zayvki` WHERE `id` = "'.$zay['id'].'" LIMIT 1');
		$test_s = '������ �������...';
	  } else {
		$test_s = '���-�� ����� ��� ��� ��������� � ������ ������.';
	  }
	} else {
	  $test_s = '�� �� � ���� ������ , ���� �� �� � �������.';	
	}
  } else {
	$test_s = '������ �� �������...';
  }
}


class zayvki {
	public $zv_see,$error,$z1n = array(4=>'���������',5=>'���������'),$z2n = array(4=>'����������',5=>'����������');
	
	public function test()
	{
		global $code,$c,$u;
		
		if( $u->info['zv'] > 0 ) {
			$test_zv = mysql_fetch_array(mysql_query('SELECT * FROM `zayvki` WHERE `id` = "'.$u->info['zv'].'" LIMIT 1'));
			if(!isset($test_zv['id'])) {
				$u->info['zv'] = 0;	
			}else{
				if( $test_zv['cancel'] > 0 || $test_zv['btl_id'] > 0 ) {
					$u->info['zv'] = 0;	
				}
				if( $test_zv['time'] < time() - 3600 ) {
					$u->info['zv'] = 0;	
				}
			}
			if( $u->info['zv'] == 0 ) {
				mysql_query('UPDATE `stats` SET `zv` = 0 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			}
		}
		
				
		//��������� ��������� � ��������� ��� � ���� ������		
		$sp = mysql_query('SELECT * FROM `zayvki` AS `z` WHERE `z`.`btl_id` = "0" AND `z`.`cancel` = "0" AND `z`.`start` = "0" AND (`z`.`razdel` = 4 OR `z`.`razdel` = 5 OR `z`.`razdel` = 10) ORDER BY `z`.`id` DESC LIMIT 11');
		while($pl = mysql_fetch_array($sp))
		{
			$uz = mysql_query('SELECT `u`.`sex`,`u`.`id`,`u`.`login`,`u`.`align`,`u`.`clan`,`u`.`admin`,`u`.`city`,`u`.`room`,`u`.`online`,`u`.`level`,`u`.`battle`,`u`.`money`,`st`.* FROM `stats` AS `st` LEFT JOIN `users` AS `u` ON (`st`.`id` = `u`.`id`) WHERE `st`.`zv`="'.$pl['id'].'"');
			$tm1 = array();
			$tm2 = array();
			$i = array();
			$toChat = '';
			$toWhere = '';
			while($t = mysql_fetch_array($uz))
			{
				if(!isset(${'tm'.$t['team']})){ ${'tm'.$t['team']} = array(); }
				if(!isset($i[$t['team']])){ $i[$t['team']] = 0; }
				${'tm'.$t['team']}[$i[$t['team']]] = $t;
				$toChat .= ''.$t['login'].',';
				$toWhere .= 'OR `id` = "'.$t['id'].'" ';
				$i[$t['team']]++;
			}

			/*$toChat = rtrim($toChat,',');
			$toWhere = ltrim($toWhere,'OR ');
			$this->startBattle($pl['id'],$toChat.'|-|'.$toWhere);*/
			if( ($pl['razdel']==5 || $pl['razdel']==10) && $pl['usermax'] <= $i[1] + $i[2] ) {
				$pl['time_start'] = time()-$pl['time']-1;
			}
			if($pl['time_start'] < time()-$pl['time'] || ($pl['razdel']==4 && $i[1]>=$pl['tm1max'] && $i[2]>=$pl['tm2max']))
			{
				$toChat = rtrim($toChat,',');
				$toWhere = ltrim($toWhere,'OR ');
				if($pl['razdel']==4)
				{
					//������
					if(!isset($i[1]) || !isset($i[2]))
					{
						//������ �� �������
						$this->cancelGroup($pl,$toChat);
					}else{
						//�������� ��������
						$this->startBattle($pl['id'],$toChat.'|-|'.$toWhere);
					}
				}elseif($pl['razdel']==5 || $pl['razdel']==10)
				{
					//�����
					$i = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `zv` = "'.$pl['id'].'" LIMIT 1'));
					if($pl['min_lvl_1'] == 11 || $pl['min_lvl_2'] == 11){
						$maxus = 2;
					}else{
						$maxus = 4;
					}
					$maxus = 2;
					if($i[0] < $maxus)
					{
						//������ �� �������
						$this->cancelGroup($pl,$toChat);
					}else{
						$zv2 = mysql_query('SELECT * FROM `stats` WHERE `zv` = "'.$pl['id'].'" LIMIT 100');
						$bt = 0;
						while($zv1 = mysql_fetch_array($zv2)){
							if($zv1['bot'] == 0) {
								$bt = 1;
								break;
							}
							else{
								$bt =0;
							}
							$res .= $bt."-";
						}
						if($bt == 1){
							//�������� ��������
							$this->startBattle($pl['id'],$toChat.'|-|'.$toWhere);
						}
						else{
							mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$pl['city']."','','','".$toChat."','".$res."','".time()."','6','0')");
							$this->botNoBattle($pl['id'],$toChat.'|-|'.$toWhere);
						}	
					}
				}
			}
		}
		//��������� ������� � ���� ������
		$sp = mysql_query('SELECT * FROM `turnirs` WHERE `status` != "-1"');
		while($pl = mysql_fetch_array($sp)) {
			
			//������ �������
			if($pl['status'] == 0 && $pl['time'] > time() ) {
				if( floor(($pl['time']-time())/60) <= 2 && $pl['chat'] > 0 ) {
					//�������� 1 ���.
					//$r = '<font color=red><b>�������:</b> �� ������ ������� �������� 1 ������.</font> ';				
					//mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','capitalcity','','','','".$r."','".time()."','6','0')");
					mysql_query('UPDATE `turnirs` SET `chat` = "0" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				}elseif( floor(($pl['time']-time())/60) <= 5 && $pl['chat'] > 1 ) {
					//�������� 5 ���.
					$r = '<font color=red><b>�������:</b> �� ������ ������� �������� 5 �����.</font> ';				
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','capitalcity','','','','".$r."','".time()."','6','0')");
					mysql_query('UPDATE `turnirs` SET `chat` = "1" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				}elseif( floor(($pl['time']-time())/60) <= 10 && $pl['chat'] > 2 ) {
					//�������� 10 ���.
					//$r = '<font color=red><b>�������:</b> �� ������ ������� �������� 10 �����.</font> ';				
					//mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','capitalcity','','','','".$r."','".time()."','6','0')");
					mysql_query('UPDATE `turnirs` SET `chat` = "2" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				}elseif( floor(($pl['time']-time())/60) <= 15 && $pl['chat'] > 3 ) {
					//�������� 15 ���.
					$r = '<font color=red><b>�������:</b> �� ������ ������� �������� 15 �����.</font> ';				
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','capitalcity','','','','".$r."','".time()."','6','0')");
					mysql_query('UPDATE `turnirs` SET `chat` = "3" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				}
			}
			if($pl['status'] == 0 && $pl['time'] < time()) {
				if($pl['users_in'] > 1) {
					//������ �������
					mysql_query('UPDATE `turnirs` SET `time` = "'.(time() + $pl['time3']).'",`status` = "1" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
					//mysql_query('UPDATE `users` SET `inTurnirnew` = "0" WHERE `inTurnirnew` = "'.$pl['id'].'"');
					
					$usp = mysql_query('SELECT * FROM `users` WHERE `inTurnirnew` = "'.$pl['id'].'"');
					while($ur = mysql_fetch_array($usp))
					{
							if(mysql_query('INSERT INTO `users` (`login`,`room`,`name`,`sex`,`level`,`inTurnirnew`,`bithday`,`activ`) VALUES ("'.mysql_real_escape_string($ur['login']).'","318","���","'.$ur['sex'].'","'.$t['level'].'","'.$pl['id'].'","01.01.2001","0")')) {
								$uri = mysql_insert_id();
								mysql_query('INSERT INTO `users_turnirs` (`uid`,`bot`,`turnir`) VALUES ("'.$ur['id'].'","'.$uri.'","'.$pl['id'].'")');
								$zid = 0;
								$x1 = 0;
								$y1 = 0;
								mysql_query('DELETE FROM `turnir_go` WHERE `uid` = "'.$ur['id'].'"');
								mysql_query('INSERT INTO `stats` (`upLevel`,`dnow`,`id`,`stats`,`exp`,`ability`,`skills`,`x`,`y`) VALUES ("98","'.$zid.'","'.$uri.'","s1=3|s2=3|s3=3|s4=3|s5=0|s6=0|rinv=40|m9=5|m6=10","0","0","0",'.$x1.','.$y1.')');
								mysql_query('UPDATE `users` SET `inUser` = "'.$uri.'" WHERE `id` = "'.$ur['id'].'" LIMIT 1');	
							}
							//��������� ������� �������� ������ � ������ ������������
							
					}
					
				}else{
					//������ �������
					mysql_query('UPDATE `turnirs` SET `time` = "'.(time() + $pl['time2']).'",`users_in` = "0" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
					mysql_query('UPDATE `users` SET `inTurnirnew` = "0" WHERE `inTurnirnew` = "'.$pl['id'].'"');
				}
			}
			
		}
	}
	
	public function testCronZv()
	{
		global $code,$c,$u;
		
		$back_test = false;
		
		//��������� ������� � ���� ������
		/*$sp = mysql_query('SELECT * FROM `turnirs` WHERE `status` != "-1"');
		while($pl = mysql_fetch_array($sp)) {
			
			//������ �������
			if($pl['status'] == 0 && $pl['time'] < time()) {
				if($pl['users_in'] > 1) {
					//������ �������
					mysql_query('UPDATE `turnirs` SET `time` = "'.(time() + $pl['time3']).'",`status` = "1" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
					//mysql_query('UPDATE `users` SET `inTurnirnew` = "0" WHERE `inTurnirnew` = "'.$pl['id'].'"');
					
					$usp = mysql_query('SELECT * FROM `users` WHERE `inTurnirnew` = "'.$pl['id'].'" LIMIT '.$pl['users_in']);
					while($ur = mysql_fetch_array($usp))
					{
							mysql_query('INSERT INTO `users` (`login`,`room`,`name`,`sex`,`level`,`inTurnirnew`,`bithday`,`activ`) VALUES ("'.$ur['login'].'","318","'.$ur['name'].'","'.$ur['sex'].'","'.$t['level'].'","'.$pl['id'].'","01.01.2001","0")');
							$uri = mysql_insert_id();
							mysql_query('INSERT INTO `users_turnirs` (`uid`,`bot`,`turnir`) VALUES ("'.$ur['id'].'","'.$uri.'","'.$pl['id'].'")');
							$zid = 0;
							$x1 = 0;
							$y1 = 0;
							mysql_query('INSERT INTO `stats` (`upLevel`,`dnow`,`id`,`stats`,`exp`,`ability`,`skills`,`x`,`y`) VALUES ("98","'.$zid.'","'.$uri.'","s1=3|s2=3|s3=3|s4=3|s5=0|s6=0|rinv=40|m9=5|m6=10","0","0","0",'.$x1.','.$y1.')');
							mysql_query('UPDATE `users` SET `inUser` = "'.$uri.'" WHERE `id` = "'.$ur['id'].'" LIMIT 1');	
							//��������� ������� �������� ������ � ������ ������������
							
					}
					
				}else{
					//������ �������
					mysql_query('UPDATE `turnirs` SET `time` = "'.(time() + $pl['time2']).'",`users_in` = "0" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
					mysql_query('UPDATE `users` SET `inTurnirnew` = "0" WHERE `inTurnirnew` = "'.$pl['id'].'"');
				}
			}
			
		}*/
		
		//��������� ��������� � ��������� ��� � ���� ������		
		$sp = mysql_query('SELECT * FROM `zayvki` AS `z` WHERE `z`.`btl_id` = "0" AND `z`.`cancel` = "0" AND `z`.`start` = "0" AND (`z`.`razdel` = 4 OR `z`.`razdel` = 5) ORDER BY `z`.`id` DESC LIMIT 100');
		while($pl = mysql_fetch_array($sp))
		{
			$uz = mysql_query('SELECT `u`.`sex`,`u`.`id`,`u`.`login`,`u`.`align`,`u`.`clan`,`u`.`admin`,`u`.`city`,`u`.`room`,`u`.`online`,`u`.`level`,`u`.`battle`,`u`.`money`,`st`.* FROM `stats` AS `st` LEFT JOIN `users` AS `u` ON (`st`.`id` = `u`.`id`) WHERE `st`.`zv`="'.$pl['id'].'"');
			$tm1 = array();
			$tm2 = array();
			$i = array();
			$toChat = '';
			$toWhere = '';
			while($t = mysql_fetch_array($uz))
			{
				if(!isset(${'tm'.$t['team']})){ ${'tm'.$t['team']} = array(); }
				if(!isset($i[$t['team']])){ $i[$t['team']] = 0; }
				${'tm'.$t['team']}[$i[$t['team']]] = $t;
				$toChat .= ''.$t['login'].',';
				$toWhere .= 'OR `id` = "'.$t['id'].'" ';
				$i[$t['team']]++;
			}
			if($pl['time_start'] <= time()-$pl['time'] || ($pl['razdel']==4 && $i[1]>=$pl['tm1max'] && $i[2]>=$pl['tm2max']))
			{
				$toChat = rtrim($toChat,',');
				$toWhere = ltrim($toWhere,'OR ');
				if($pl['razdel']==4)
				{
					//������
					if(!isset($i[1]) || !isset($i[2]))
					{
						//������ �� �������
						$this->cancelGroup($pl,$toChat);
					}else{
						//�������� ��������
						$this->startBattle($pl['id'],$toChat.'|-|'.$toWhere);
					}
				}elseif($pl['razdel']==5)
				{
					//�����
					$i = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `zv` = "'.$pl['id'].'" LIMIT 1'));
					if($i[0] < 2 && ($pl['fastfight'] == 0 || $i[0] < 2 || $pl['min_lvl_1'] >= 12))
					{
						$rcf = mysql_fetch_array(mysql_query('SELECT `id`,`btl_cof` FROM `stats` WHERE `zv` = "'.$pl['id'].'" ORDER BY `btl_cof` DESC LIMIT 1'));
						$rcf = $rcf['btl_cof'];
						//������ �� �������
						//��������� ����������� �������
						$lvl_btl_exp = array(
							0 =>           0,
							1 =>         110,
							2 =>         420,
							3 =>        1300,
							4 =>        2500,
							5 =>        5000,
							6 =>       12500,
							7 =>       30000,
							8 =>      300000,
							9 =>     3000000,
							10 =>   10000000,
							11 =>   52000000,
							12 =>   63000000,
							13 =>  182000000,
							14 =>  212000000,
							15 =>  352000000,
							16 =>  504000000,
							17 => 1187000000,
							18 => 2455000000,
							19 => 4387000000,
							20 => 6355000000,							
							21 =>15500000000,							
							22 =>755500000000
						);
						$bot_users = array();
						
						if( $pl['min_lvl_1'] <= 8 && $pl['max_lvl_1'] <= 8 && $pl['nobot'] == 0) {
							$bsp = mysql_query('SELECT
								`u`.`id`,
								`u`.`login`,
								`u`.`level`,
								`s`.`stats`,
								`u`.`cityreg`,
								`u`.`sex`,
								`u`.`obraz`,
								`s`.`upLevel`,
								`s`.`priems`,
								`s`.`btl_cof`
							FROM `stats` AS `s` LEFT JOIN `users` AS `u` ON `u`.`id` = `s`.`id` WHERE `s`.`exp` >= '.$lvl_btl_exp[$pl['min_lvl_1']].' AND `s`.`exp` < '.$lvl_btl_exp[$pl['max_lvl_1']+1].' AND `s`.`bot` = "0" ORDER BY `s`.`btl_cof` DESC LIMIT 25');
							while( $bpl = mysql_fetch_array($bsp) ) {
								$bot_users[] = $bpl;
							}
						}
											
						if( count($bot_users) == 0 ) {
							$text = ' �� ������� ������ �������� �� �������: ������ �� �������. ('.$pl['id'].': '.count($bot_users).' '.$lvl_btl_exp[$pl['min_lvl_1']].'-'.$lvl_btl_exp[$pl['max_lvl_1']+1].')';
							mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$zv['city']."','','','LEL','".$text."','".time()."','6','0')");
							$this->cancelGroup($pl,$toChat);
						}else{							
							$j = 0; $k = 0;
							$bot_users_new = array();
							while( $j < 4-$i[0] ) {
								$botlg = $bot_users[rand(0,count($bot_users)-1)];
								$j++;
								$clone = array(
									'id' => $botlg['id'],
									'login' => '���� (���� '.$j.')',
									'level' => $botlg['level'],
									'city' => $pl['city'],
									'cityreg' => $pl['city'],
									'name' => '����',
									'sex' => $botlg['sex'],
									'deviz' => '',
									'hobby' => '',
									'time_reg' => time(),
									'obraz' => $botlg['obraz'],
									'stats' => $botlg['stats'],
									'upLevel' => $botlg['upLevel'],
									'priems' => $botlg['priems'],
									'loclon' => true
								);
								//$bot = $u->addNewbot(1,NULL,$clone,NULL,true);
								if( $bot > 0 ) {
									mysql_query('UPDATE `stats` SET `btl_cof` = "'.$botlg['btl_cof'].'",`zv` = "'.$pl['id'].'",`hpNow` = "100000",`mpNow` = "100000" WHERE `id` = "'.$bot.'" LIMIT 1');
									mysql_query('UPDATE `users` SET `room` = "303",`battle` = "0" WHERE `id` = "'.$bot.'" LIMIT 1');
									$k++;
								}
							}
							unset($bot_users,$bpl,$bsp,$bot);
							//$this->cancelGroup($pl,$toChat);
							if( $k+$i[0] >= 4 ) {
								$back_test = true;
								//$this->startBattle($pl['id'],$toChat.'|-|'.$toWhere);
							}
						}
					}else{
						//�������� ��������
						$this->startBattle($pl['id'],$toChat.'|-|'.$toWhere);
					}
				}
			}
		}
		
		if( $back_test == true ) {
			$this->testCronZv();
		}
		
	}

	public function userInfo()
	{
		global $u,$c;
			$r = '';
			if($u->stats['mpAll']>0)
			{
				$pm = $u->stats['mpNow']/$u->stats['mpAll']*100;
			}
			$ph = $u->stats['hpNow']/$u->stats['hpAll']*100;
			$dp = '';
			if($u->stats['mpAll']<=0)
			{
				$dp = 'margin-top:13px;';
			}
			$r .= '<table border="0" cellspacing="0" cellpadding="0" height="20">
<tr><td valign="middle"> &nbsp; <font>'.$u->microLogin($u->info['id'],1).'</font> &nbsp; </td>
<td valign="middle" width="120">
<div style="position:relative;'.$dp.'"><div id="vhp'.($u->info['id']).'" title="������� �����" align="left" class="seehp" style="position:absolute; top:-10px; width:120px; height:10px; z-index:12;"> '.floor($u->stats['hpNow']).'/'.$u->stats['hpAll'].'</div>
<div title="������� �����" class="hpborder" style="position:absolute; top:-10px; width:120px; height:9px; z-index:13;"><img src="http://img.likebk.com/1x1.gif" height="9" width="1"></div>
<div class="hp_3 senohp" style="height:9px; width:'.floor(120/100*$ph).'px; position:absolute; top:-10px; z-index:11;" id="lhp'.($u->info['id']).'"><img src="http://img.likebk.com/1x1.gif" height="9" width="1"></div>
<div title="������� �����" class="hp_none" style="position:absolute; top:-10px; width:120px; height:10px; z-index:10;"><img src="http://img.likebk.com/1x1.gif" height="10"></div>
';

if($u->stats['mpAll']>0)
{
	$r .= '<div id="vmp'.($u->info['id']).'" title="������� ����" align="left" class="seemp" style="position:absolute; top:0px; width:120px; height:10px; z-index:12;"> '.floor($u->stats['mpNow']).'/'.$u->stats['mpAll'].'</div>
<div title="������� ����" class="hpborder" style="position:absolute; top:0px; width:120px; height:9px; z-index:13;"><img src="http://img.likebk.com/1x1.gif" height="9" width="1"></div>
<div class="hp_mp senohp" style="height:9px; position:absolute; top:0px; width:'.floor(120/100*$pm).'px; z-index:11;" id="lmp'.($u->info['id']).'"><img src="http://img.likebk.com/1x1.gif" height="9" width="1"></div>
<div title="������� ����" class="hp_none" style="position:absolute; top:0px; width:120px; height:10px; z-index:10;"></div>';
}
$r .= '</div></td></tr></table>';
		unset($stt,$ph,$pm);
		return $r;
	}
	
	public function cancelGroup($zv,$uids)
	{
		$upd = mysql_query('UPDATE `stats` SET `zv` = "0" WHERE `zv` = "'.$zv['id'].'"');
		if($upd)
		{
			$upd = mysql_query('UPDATE `zayvki` SET `cancel` = "'.time().'" WHERE `id` = "'.$zv['id'].'"');
			if($upd && $uids != '')
			{
				$text = ' �� ������� ������ �������� �� �������: ������ �� �������.';
				mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$zv['city']."','','','".$uids."','".$text."','".time()."','6','0')");
			}
		}
	}
	
	public function add()
	{
		global $u,$c,$code;
		$travm = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid`="'.$u->info['id'].'" AND `id_eff`=4 AND (`v1` = 2 OR `v1` = 3) AND `delete`=0 '));
		if($u->info['inTurnirnew']>0){
			$this->error = '�� �� ������ ���������, �� ���������� � �������!';
		}elseif(isset($travm['id'])){
			$this->error = '�� �� ������ ���������, � ��� ������, �������� ��';
		}else{
			if(isset($_GET['r']) && $u->info['inTurnirnew']==0)
			{
				$r = round(intval($_GET['r']));
				if($r == 10 || $r == 9 || ($r>=1 && $r<=5))
				{
					$az = 1;
					if($r==1 && $u->info['level']>0){	$az = 0; $this->error = '�� ��� ������� �� ��������� ;)';	}
					if(($r==2 || $r==3)  && $u->info['level']<1){	$az = 0; $this->error = '�� ��� �� ������� �� ��������� ;)';	}
					if(($r==4 || $r==5)  && $u->info['level']<2){	$az = 0; $this->error = '� '.$this->z1n[$r].' ��� ������ � ������� ������.';	}
					if(!isset($_POST['stavkakredit'])){ $_POST['stavkakredit'] = 0; }
					$money = (int)($_POST['stavkakredit']*100);
					$money = round(($money/100),2);
					
					if(isset($_POST['art_money3']) && $_POST['art_money3'] != '') {
	                  $money3 = (int)($_POST['art_money3']*100); $money3 = round(($money3/100), 2); $at_m = 1;
	                } else {
	                  $at_m = 0; $money3 = 0;
	                }
	                if($u->info['hpNow']<$u->stats['hpAll']/100*30 && ($r>=1 || $r<=3)) {
						$this->error = '�� ��� ������� ��������� ����� ������ ����� ���';
						$az = 0;
					} elseif($r==3 && $money>0 && $u->info['level']<4) {
						$this->error = '��� �� ������ ���������� � 4-�� ������';
						$az = 0;
					} elseif($r==3 && $money<0.5 && $money>0) {
						$this->error = '����������� ������ 0.50 ��.';
						$az = 0;
					} elseif($r==3 && $money>30) {
						$this->error = '������������ ������ 30.00 ��.';
						$az = 0;
					} elseif($r==3 && $money>$u->info['money']) {
						$this->error = '� ��� ������������ �����, ����� ������ ������';
						$az = 0;
					} elseif($at_m == 1) {
	                  if($money3 < 0.1) {
	                    $this->error = '����������� ������ 0.10 $';
	                    $az = 0;
	                  } elseif($money3 > 100) {
	                    $this->error = '������������ ������ 100 $';
					    $az = 0;
	                  } elseif($money3 > 0 && $u->info['level'] < 4) {
	  				    $this->error = '��� ������� ���� ���������� ������� � 4 ������.';
					    $az = 0;
	                  } elseif($money3 > $u->info['money3'] && $at_m == 1) {
	                    $this->error = '� ��� ������������ �������';
					    $az = 0;
	                  }
					}
					if($u->info['zv']>0){ $az = 0; $this->error = '�� ��� �������� � ������.'; }
					if($az==1)
					{
						$nz = array();
						$nz['city'] = $u->info['city'];
						$nz['creator'] = $u->info['id'];
						$nz['type'] = 0;
						if($_POST['k']==1){	$nz['type'] = 1; }
						$_POST['timeout'] = round(intval(mysql_real_escape_string($_POST['timeout'])));
						if($_POST['timeout']==1 || $_POST['timeout']==2 || $_POST['timeout']==3 || $_POST['timeout']==4 || $_POST['timeout']==5)
						{
							$nz['timeout'] = $_POST['timeout']*60;
						}else{
							$nz['timeout'] = 3*60;
						}
						if($r==3)
						{
							if($_POST['onlyfor']!='')
							{
								$nz['withUser'] = mysql_real_escape_string($_POST['onlyfor']);
							}
						}
						$nz['razdel'] = $r;
						$nz['time_start'] = 0;
						$nz['min_lvl_1'] = 0;
						$nz['min_lvl_2'] = 0;
						$nz['max_lvl_1'] = 21;
						$nz['max_lvl_2'] = 21;
						$nz['tm1max'] = 0;
						$nz['tm2max'] = 0;
						$nz['travmaChance'] = 0;
						$nz['invise'] = 0;
						$nz['money'] = 0;
						$nz['comment'] = '';
						$nz['tm1'] = 0;
						$nz['tm2'] = 0;
						$gad = 1;
						if($r==3)
						{
							$nz['money'] = $money;
						}
						if($r == 3 || $r == 4 || $r == 5 || $r == 10) {
						  $nz['money3'] = $money3;
						}
						if(($r==5 || $r==10) && $u->info['level']>1)
						{
							//��������� ���
							if($_POST['startime2'])
							{
								$nz['time_start'] = (int)$_POST['startime2'];
								$nz['comment'] = substr($_POST['cmt'], 0, 40);
								$nz['comment'] = str_replace('"','&quot;',$nz['comment']);
								$nz['comment'] = htmlspecialchars($nz['comment'],NULL,'cp1251');
								if($nz['time_start']!=180 && $nz['time_start']!=300 && $nz['time_start']!=600 && $nz['time_start']!=900 && $nz['time_start']!=1200 && $nz['time_start']!=1800)
								{
									$nz['time_start'] = 600;
								}
								$nz['usermax'] = $_POST['countTm1max'];
								if(isset($_POST['mut_hidden']))
								{
									$nz['invise'] = 1;
								}
								if(isset($_POST['travma']))	{
									$nz['type'] = 99;
								}
								if(isset($_POST['noinc']))	{
									$nz['noinc'] = 1;
								}
								if(isset($_POST['fastfight']))	{
									$nz['fastfight'] = 1;
								}
								if(isset($_POST['nobot']))	{
									$nz['nobot'] = 1;
								}
								if(isset($_POST['kingfight']))	{
									$nz['kingfight'] = 1;
								}
								if(isset($_POST['arand']))	{
									$nz['arand'] = 1;
								}
								if(isset($_POST['otmorozok'])) {
									if( date('m') == 12 || date('m') == 1 || date('m') == 2 || $u->info['admin'] > 0 ) {
										$nz['otmorozok'] = 1;
									}
									$nz['otmorozok'] = 0;
								}
								if(isset($_POST['noatack']))	{
									$nz['noatack'] = 1;
								}
								if(isset($_POST['noeff']))	{
									$nz['noeff'] = 1;
								}
								if(isset($_POST['smert']))	{
									$nz['smert'] = 1;
								}
								if(isset($_POST['noart']))	{
									$nz['noart'] = 1;
									$item_user = mysql_query('SELECT * FROM `items_users` WHERE `delete` = 0 AND `inOdet` > 0 AND `inShop` = 0 AND `uid` = "'.$u->info['id'].'" LIMIT 100');
									$art_user = 0;
									while($it_user = mysql_fetch_array($item_user)){
										$data_us = explode("|", $it_user['data']);
										$i = 0;
										while ($i <= count($data_us)) {
											if($data_us[$i] == "art=1"){
												$art_user = 1;
												break 2;
											}
											else{
												$art_user = 0;
											}
											$i++;
										}
									}
									if($art_user == 1){
										$gad = 0;
										$this->error = '� ������ ��� ��������� ������������� ����������...';		
									}
								}
								if( $nz['kingfight'] == 1 && $nz['fastfight'] == 1 ) {
									$nz['kingfight'] = 0;
								}
								
								$nz['timeout'] = (int)$_POST['timeout'];
								if($nz['timeout']!=1 && $nz['timeout']!=2 && $nz['timeout']!=3 && $nz['timeout']!=4 && $nz['timeout']!=5)
								{
									$nz['timeout'] = 3;
								}
								
								//���������� ������ ��������
								$lvl = (int)$_POST['levellogin1'];
								if($lvl == 0)
								{
									/*$nz['min_lvl_1'] = 2;
									$nz['max_lvl_1'] = 21;*/
									$nz['min_lvl_1'] = $u->info['level'];
									$nz['max_lvl_1'] = $u->info['level'];
								}elseif($lvl == 3)
								{
									$nz['min_lvl_1'] = $u->info['level'];
									$nz['max_lvl_1'] = $u->info['level'];
								}elseif($lvl == 6 && $u->info['level'] < 13)
								{
									$nz['min_lvl_1'] = $u->info['level']-1;
									$nz['max_lvl_1'] = $u->info['level']+1;
								}else{
									$nz['min_lvl_1'] = 2;
									$nz['max_lvl_1'] = 2;
								}
								
								if( $u->info['level'] == 13 ) {
									$nz['min_lvl_1'] = 12;
									$nz['max_lvl_1'] = 14;
								}
								
								if((int)$_POST['k']==1)
								{
									//�������� ���
									$nz['type'] = 1;
								}
								
								$nz['timeout'] = $nz['timeout']*60;
								
								$nz['tm1'] = 100*$u->info['level']+10*$u->info['upLevel']+$u->info['exp']+$u->stats['reting'];
								
								if( $u->info['no_zv_key'] != true ) { 
									if( $_POST['code21'] == 0 || $_POST['code21'] != $_SESSION['code2'] || $_SESSION['code2'] == 0 || !isset($_SESSION['code2']) ) {
										$this->error = '������������ ��� �������������';
										$gad = 0;
									}
								}
								
							}else{
								$gad = 0; $this->error = '���-�� �� ���...<br>';
							}
						}elseif($r==4 && $u->info['level']>1)
						{
							//��������� ���
							//'Array ( [startime] => 300 [timeout] => 1 [nlogin1] => 11 [levellogin1] => 0 [nlogin2] => 11 [levellogin2] => 0 [k] => 1 [travma] => on [mut_clever] => on [cmt] => ���� [open] => ������ ��������! :) )';
							//����� ������� � ��������� ������ �� ��������� ���
							if($_POST['startime'])
							{
								$nz['time_start'] = (int)$_POST['startime'];
								$nz['comment'] = substr($_POST['cmt'], 0, 40);
								$nz['comment'] = str_replace('"','&quot;',$nz['comment']);
								if($nz['time_start']!=300 && $nz['time_start']!=600 && $nz['time_start']!=900 && $nz['time_start']!=1200 && $nz['time_start']!=1800)
								{
									$nz['time_start'] = 600;
								}
								
								$nz['timeout'] = (int)$_POST['timeout'];
								if($nz['timeout']!=1 && $nz['timeout']!=2 && $nz['timeout']!=3 && $nz['timeout']!=4 && $nz['timeout']!=5)
								{
									$nz['timeout'] = 3;
								}
								
								$nz['timeout'] = $nz['timeout']*60;
								
								$nz['tm1max'] = (int)$_POST['nlogin1'];
								if($nz['tm1max']<1 || $nz['tm1max']>99)
								{
									$this->error .= '�������� ���-�� ���������<br>';
									$gad = 0;
								}
								
								$nz['tm2max'] = (int)$_POST['nlogin2'];
								if($nz['tm2max']<1 || $nz['tm2max']>99)
								{
									$this->error .= '�������� ���-�� �����������<br>';
									$gad = 0;
								}
								
								if($nz['tm1max']+$nz['tm2max']<3)
								{
									$this->error .= '������ 1 �� 1 �������� � ������� ���������� ��� ���������� ���<br>';
									$gad = 0;
								}
															
								//���������� ������ ��������
								$lvl = (int)$_POST['levellogin1'];
								if($lvl == 0)
								{
									/*$nz['min_lvl_1'] = 2;
									$nz['max_lvl_1'] = 21;
									*/
									$nz['min_lvl_1'] = $u->info['level'];
									$nz['max_lvl_1'] = $u->info['level'];
								}elseif($lvl == 1)
								{
									$nz['min_lvl_1'] = 2;
									$nz['max_lvl_1'] = $u->info['level'];
								}elseif($lvl == 2)
								{
									$nz['min_lvl_1'] = 2;
									$nz['max_lvl_1'] = $u->info['level']-1;
								}elseif($lvl == 3)
								{
									$nz['min_lvl_1'] = $u->info['level'];
									$nz['max_lvl_1'] = $u->info['level'];
								}elseif($lvl == 4)
								{
									$nz['min_lvl_1'] = $u->info['level'];
									$nz['max_lvl_1'] = $u->info['level']+1;
								}elseif($lvl == 5)
								{
									$nz['min_lvl_1'] = $u->info['level']-1;
									$nz['max_lvl_1'] = $u->info['level'];
								}elseif($lvl == 6)
								{
									$nz['min_lvl_1'] = $u->info['level']-1;
									$nz['max_lvl_1'] = $u->info['level']+1;
								}elseif($lvl == 6){
									$nz['min_lvl_1'] = 99;
								}else{
									$this->error = '���-�� �� ���...<br>';
									$gad = 0;
								}
								
								//���������� ������ ����������
								$lvl = (int)$_POST['levellogin2'];
								if($lvl == 0)
								{
								/*	$nz['min_lvl_2'] = 2;
									$nz['max_lvl_2'] = 21;*/
									$nz['min_lvl_1'] = $u->info['level'];
									$nz['max_lvl_1'] = $u->info['level'];
								}elseif($lvl == 1)
								{
									$nz['min_lvl_2'] = 2;
									$nz['max_lvl_2'] = $u->info['level'];
								}elseif($lvl == 2)
								{
									$nz['min_lvl_2'] = 2;
									$nz['max_lvl_2'] = $u->info['level']-1;
								}elseif($lvl == 3)
								{
									$nz['min_lvl_2'] = $u->info['level'];
									$nz['max_lvl_2'] = $u->info['level'];
								}elseif($lvl == 4)
								{
									$nz['min_lvl_2'] = $u->info['level'];
									$nz['max_lvl_2'] = $u->info['level']+1;
								}elseif($lvl == 5)
								{
									$nz['min_lvl_2'] = $u->info['level']-1;
									$nz['max_lvl_2'] = $u->info['level'];
								}elseif($lvl == 6)
								{
									$nz['min_lvl_2'] = $u->info['level']-1;
									$nz['max_lvl_2'] = $u->info['level']+1;
								}elseif($lvl == 6){
									$nz['min_lvl_2'] = 99;
								}else{
									$this->error = '���-�� �� ���...<br>';
									$gad = 0;
								}
								
								if($nz['min_lvl_1']<2){ $nz['min_lvl_1'] = 2; }
								if($nz['max_lvl_1']>21){ $nz['max_lvl_1'] = 21; }
								if($nz['min_lvl_2']<2){ $nz['min_lvl_2'] = 2; }
								if($nz['max_lvl_2']>21){ $nz['max_lvl_2'] = 21; }
															
								if((int)$_POST['k']==1)
								{
									//�������� ���
									$nz['type'] = 1;
								}
								
							}else{
								$gad = 0;
								$this->error = '���-�� �� ���...<br>';
							}
						}
						
						$bt2 = (int)$_POST['bots2'];
						if($bt2!=0 && $r==4 && $u->info['level']>1){ 
							$bt2 = 1; 
							$nz['min_lvl_2'] = $u->info['level']; 
							$nz['max_lvl_2'] = $u->info['level']; 
							$nz['min_lvl_1'] = $u->info['level']; 
							$nz['max_lvl_1'] = $u->info['level'];  
						}else{ 
							$bt2 = 0; 
						}
										
						if( ($r == 5 || $r == 10) && $nz['min_lvl_1'] == 12 && $nz['max_lvl_1'] == 14 ) {
							$test_zv_lvl = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `zayvki` WHERE `cancel` = "0" 
								
								AND `min_lvl_1` = 12 AND `max_lvl_1` = 14
								
							 AND `btl_id` = 0 AND `razdel` = 5 LIMIT 1'));
							if( $test_zv_lvl[0] >= 2 ) {
								$gad = 0;
								$this->error = '��� ���� 2 ������ 12-14 ������. ������� ��.';
							}
						}
						
						if($gad==1)
						{
							if(!isset($nz['withUser'])){ $nz['withUser'] = ''; }
							$nz['time_create_zv'] = time();
							if( $nz['razdel'] == 4 || $nz['razdel'] == 5 || $nz['razdel'] == 10 ) {
								//��������� ����� ��� �����
								$nz['time_create_zv'] = strtotime(date('d.m.Y H:i',$nz['time_create_zv']).':00',$nz['time_create_zv']);
							}elseif( $nz['razdel'] == 3 ) {
								$nz['noinc'] = 1;	
							}
							if( $nz['noart'] > 0 && $u->info['level'] < 12 ) {
								$nz['noart'] = 0;
							}
							/*if($u->info['level'] == 8){
								$zzz = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `zayvki` WHERE  `start`="0" AND `cancel` = "0" AND `noart` = "0" AND
										(`min_lvl_1` = '.$u->info['level'].' AND `max_lvl_1` = '.$u->info['level'].' ) LIMIT 1'));
								$c_z = 2;
							}elseif($u->info['level'] == 9){
								$zzz = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `zayvki` WHERE  `start`="0" AND `cancel` = "0" AND `noart` = "0" AND
										(`min_lvl_1` = '.$u->info['level'].' AND `max_lvl_1` = '.$u->info['level'].' ) LIMIT 1'));
								$c_z = 2;
							}else{
								$zzz = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `zayvki` WHERE  `start`="0" AND `cancel` = "0" AND `noart` = "0" AND
										(`min_lvl_1` <= "21" AND `max_lvl_1` >= "2" ) LIMIT 1'));
								$c_z = 7;
							}

						  	//$bot = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `battle`="0" AND `level` = "8" AND `pass`="saintlucia" ORDER BY RAND() LIMIT 1'));  	
						  	if($zzz[0] < $c_z)
						  	{*/
						  		if($u->info['level'] == 9 && $r==5){

									/*$zzz = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `zayvki` WHERE  `start`="0" AND `cancel` = "0" AND `noart` = "0" AND
											(`min_lvl_1` = '.$u->info['level'].' AND `max_lvl_1` = '.$u->info['level'].' ) LIMIT 1'));*/
									$zzz = mysql_fetch_array(mysql_query('SELECT COUNT(`zv`.`id`) FROM `zayvki` AS `zv` LEFT JOIN `users` AS `u` ON `u`.`id` = `zv`.`creator` WHERE (`u`.`pass` != "saintlucia" OR `u`.`level` = "9") AND `zv`.`start`="0" AND `zv`.`cancel` = "0" AND `zv`.`noart` = "0" AND
											(`zv`.`min_lvl_1` = '.$u->info['level'].' AND `zv`.`max_lvl_1` = '.$u->info['level'].' ) LIMIT 1'));
									$c_z = 2;
									if($zzz[0] < $c_z)
							  		{
										$ins = mysql_query('INSERT INTO `zayvki` (`otmorozok`,`priz`,`usermax`,`smert`,`noart`,`noeff`,`noatack`,`arand`,`kingfight`,`nobot`,`fastfight`,`noinc`,`bot1`,`bot2`,`time`,`city`,`creator`,`type`,`time_start`,`timeout`,`min_lvl_1`,`min_lvl_2`,`max_lvl_1`,`max_lvl_2`,`tm1max`,`tm2max`,`travmaChance`,`invise`,`razdel`,`comment`,`money`,`money3`,`withUser`,`tm1`,`tm2`) VALUES (
																			"'.$nz['otmorozok'].'",
																			"'.$nz['priz'].'",
																			"'.$nz['usermax'].'",
																			"'.$nz['smert'].'",
																			"'.$nz['noart'].'",
																			"'.$nz['noeff'].'",
																			"'.$nz['noatack'].'",
																			"'.$nz['arand'].'",
																			"'.$nz['kingfight'].'",
																			"'.$nz['nobot'].'",
																			"'.$nz['fastfight'].'",
																			"'.$nz['noinc'].'",
																			"0",
																			"'.((int)$bt2).'",
																			"'.$nz['time_create_zv'].'",
																			"'.$nz['city'].'",
																			"'.$nz['creator'].'",
																			"'.$nz['type'].'",
																			"'.$nz['time_start'].'",
																			"'.mysql_real_escape_string($nz['timeout']).'",
																			"'.mysql_real_escape_string($nz['min_lvl_1']).'",
																			"'.mysql_real_escape_string($nz['min_lvl_2']).'",															
																			"'.mysql_real_escape_string($nz['max_lvl_1']).'",
																			"'.mysql_real_escape_string($nz['max_lvl_2']).'",
																			"'.mysql_real_escape_string($nz['tm1max']).'",
																			"'.mysql_real_escape_string($nz['tm2max']).'",
																			"'.$nz['travmaChance'].'",
																			"'.$nz['invise'].'",
																			"'.$nz['razdel'].'",
																			"'.mysql_real_escape_string($nz['comment']).'",
																			"'.mysql_real_escape_string($nz['money']).'",
			                                                                "'.mysql_real_escape_string($nz['money3']).'",
																			"'.$nz['withUser'].'","'.$nz['tm1'].'","'.$nz['tm2'].'")');
											$zid = mysql_insert_id();
											if($ins)
											{
												mysql_query('UPDATE `stats` SET `zv`="'.$zid.'",`team`="1" WHERE `id`="'.$u->info['id'].'" LIMIT 1');
												$u->info['zv'] = $zid;
												$this->error = '������ �� ��� ������';
											}else{
												$this->error = '�� �� ������ ������ ������...';
											}
										}else{
											$this->error = '��������! ��������� ����������� �� 2 ������� ������ �� ����� ������!';
										}
								}else{
									$ins = mysql_query('INSERT INTO `zayvki` (`otmorozok`,`priz`,`usermax`,`smert`,`noart`,`noeff`,`noatack`,`arand`,`kingfight`,`nobot`,`fastfight`,`noinc`,`bot1`,`bot2`,`time`,`city`,`creator`,`type`,`time_start`,`timeout`,`min_lvl_1`,`min_lvl_2`,`max_lvl_1`,`max_lvl_2`,`tm1max`,`tm2max`,`travmaChance`,`invise`,`razdel`,`comment`,`money`,`money3`,`withUser`,`tm1`,`tm2`) VALUES (
																		"'.$nz['otmorozok'].'",
																		"'.$nz['priz'].'",
																		"'.$nz['usermax'].'",
																		"'.$nz['smert'].'",
																		"'.$nz['noart'].'",
																		"'.$nz['noeff'].'",
																		"'.$nz['noatack'].'",
																		"'.$nz['arand'].'",
																		"'.$nz['kingfight'].'",
																		"'.$nz['nobot'].'",
																		"'.$nz['fastfight'].'",
																		"'.$nz['noinc'].'",
																		"0",
																		"'.((int)$bt2).'",
																		"'.$nz['time_create_zv'].'",
																		"'.$nz['city'].'",
																		"'.$nz['creator'].'",
																		"'.$nz['type'].'",
																		"'.$nz['time_start'].'",
																		"'.mysql_real_escape_string($nz['timeout']).'",
																		"'.mysql_real_escape_string($nz['min_lvl_1']).'",
																		"'.mysql_real_escape_string($nz['min_lvl_2']).'",															
																		"'.mysql_real_escape_string($nz['max_lvl_1']).'",
																		"'.mysql_real_escape_string($nz['max_lvl_2']).'",
																		"'.mysql_real_escape_string($nz['tm1max']).'",
																		"'.mysql_real_escape_string($nz['tm2max']).'",
																		"'.$nz['travmaChance'].'",
																		"'.$nz['invise'].'",
																		"'.$nz['razdel'].'",
																		"'.mysql_real_escape_string($nz['comment']).'",
																		"'.mysql_real_escape_string($nz['money']).'",
		                                                                "'.mysql_real_escape_string($nz['money3']).'",
																		"'.$nz['withUser'].'","'.$nz['tm1'].'","'.$nz['tm2'].'")');
									$zid = mysql_insert_id();
									if($ins)
									{
										mysql_query('UPDATE `stats` SET `zv`="'.$zid.'",`team`="1" WHERE `id`="'.$u->info['id'].'" LIMIT 1');
										$u->info['zv'] = $zid;
										$this->error = '������ �� ��� ������';
									}else{
										$this->error = '�� �� ������ ������ ������...';
									}
								}
							/*}else{
								$this->error = '��������! ��������� ����������� �� 2 ������� ������ �� ����� ������!';
							}*/
						}
					}
				}
			}
		}
	}

	//������������� ���
	public function addBot()
	{
		global $u,$c,$code;
		/*$trEn = 1;
		
		if($u->info['level'] == 0) {
			/*
				14 ����� �� ���
				8 �����
			*/
			//$trEn = 0;
		//}elseif($u->info['level'] == 1) {
			/*
				27 ����� �� ���
				12 �����
			*/
			//$trEn = 1;
		//}elseif($u->info['level'] == 2) {
			/*
				27 ����� �� ���
				12 �����
			*/
			//$trEn = 1;
		//}elseif($u->info['level'] == 3) {
			/*
				27 ����� �� ���
				12 �����
			*/
			//$trEn = 1;
		//}elseif($u->info['level'] == 4) {
			/*
				27 ����� �� ���
				12 �����
			*/
			//$trEn = 1;
		//}else{
		//	$trEn = floor($u->info['level']+(1.25*$u->info['level']));
		//}
		
		//if($u->info['level']>5 && $u->info['admin']==0) {
		if($u->info['level'] <= 7 || $u->info['admin'] > 0) {
		//if($trEn > $u->info['enNow']) {
			$bot = $u->addNewbot($id['id'],NULL,$u->info['id'],NULL,true);
		}else{
			$bot = false;
		}
		$travm = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid`="'.$u->info['id'].'" AND `id_eff`=4 AND (`v1` = 2 OR `v1` = 3) AND `delete`=0 '));
		if(isset($travm['id'])){
			$this->error = '�� �� ������ ���������, � ��� ������, �������� ��';
		}else{
			if($bot==false)
			{
				//if($trEn > $u->info['enNow']) {
				//	$this->error = '������������� ������� ������� ��� ������ ��������. ���������: '.$trEn.' ��., � ��� ['.floor(0+$u->info['enNow']).'/'.(0+$u->stats['enAll']).']<br>'.
				//					'<small>��� ���������� ������ ������� - ��������� �������������� "�������", ���� �������������� ���������� � ����������!</small>';
				//}else{
					$this->error = '��� � ���������, �������, ������� � ������� ����������� ���������� ������ ��� ���������� ������ 8 ������...<br>�� ������� ������������ ����� ����, ��� ���� ���-�� �� �����������...<br>';
				//}
			}elseif($u->info['hpNow']<$u->stats['hpAll']/100*30 && ($r>=1 || $r<=3))
			{
				$this->error = '�� ��� ������� ��������� ����� ������ ����� ���';
				$az = 0;
			}elseif($u->info['align'] == 2)
			{
				$this->error = '�������� �� ����� ��������� �����';
				$az = 0;
			}elseif($bot==false)
			{
				echo '<br><font color=red>Cannot start battle (no prototype "ND0Clone")</font><br>';
			}else{
				//������� �������� � �����
				$expB = 25;
				$btl = array('otmorozok' => 0 , 'priz' => 0 , 'smert' => 0,'noart' => 0,'noeff' => 0,'noatack' => 0,'arand' => 0,'kingfight' => 0,'nobot' => 0,'fastfight' => 0,'players'=>'','timeout'=>60,'type'=>0,'invis'=>0,'noinc'=>0,'travmChance'=>0,'typeBattle'=>0,'addExp'=>$expB,'money'=>0,'money3'=>0);
				$ins = mysql_query('INSERT INTO `battle` (`razdel`,`otmorozok`,`priz`,`room`,`smert`,`noart`,`noeff`,`noatack`,`arand`,`kingfight`,`nobot`,`fastfight`,`clone`,`city`,`time_start`,`players`,`timeout`,`type`,`invis`,`noinc`,`travmChance`,`typeBattle`,`addExp`,`money`,`money3`) VALUES (
													"'.$_GET['r'].'",
													"'.$btl['otmorozok'].'",
													"'.$btl['priz'].'",
													"'.$u->info['room'].'",
													"'.$btl['smert'].'",
													"'.$btl['noart'].'",
													"'.$btl['noeff'].'",
													"'.$btl['noatack'].'",
													"'.$btl['arand'].'",
													"'.$btl['kingfight'].'",
													"'.$btl['nobot'].'",
													"'.$btl['fastfight'].'",												
													"1",
													"'.$u->info['city'].'",
													"'.time().'",
													"'.$btl['players'].'",
													"'.$btl['timeout'].'",
													"'.$btl['type'].'",
													"'.$btl['invis'].'",
													"'.$btl['noinc'].'",
													"'.$btl['travmChance'].'",
													"'.$btl['typeBattle'].'",
													"'.$btl['addExp'].'",
													"'.$btl['money'].'", "'.$btl['money3'].'")');
				if($ins)
				{
					$btl_id = mysql_insert_id();
					//��������� ������ � ��������	
					$u->info['enNow'] -= $trEn;					
					$upd2  = mysql_query('UPDATE `users` SET `battle`="'.$btl_id.'" WHERE `id` = "'.$u->info['id'].'" OR `id` = "'.$bot.'" LIMIT 2');
					mysql_query('UPDATE `stats` SET `team`="1",`enNow` = "'.$u->info['enNow'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('UPDATE `stats` SET `team`="2" WHERE `id` = "'.$bot.'" LIMIT 1');
					//���� ��� ��������, �� ������� ����
					if($btl['type']==1)
					{
						mysql_query('UPDATE `items_users` SET `inOdet`="0" WHERE `uid` = "'.$u->info['id'].'" AND `inOdet`!=0');
						mysql_query('UPDATE `items_users` SET `inOdet`="0" WHERE `uid` = "'.$bot.'" AND `inOdet`!=0');
					}
					
					//��������� ������, ��� ��� �������
					$u->info['battle'] = $btl_id;
					//���������� ��������� � ��� ���� ������
					mysql_query("INSERT INTO `chat` (`city`,`room`,`to`,`time`,`type`,`toChat`,`sound`) VALUES ('".$u->info['city']."','".$u->info['room']."','".$u->info['login']."','".time()."','11','0','117')");
					die('<script>location="main.php?battle_id='.$btl_id.'";</script>');
				}else{
					$this->error = 'Cannot start battle (no prototype "ABD0Clone")';
				}	
			}
		}
	}
	
	//������
	public function startIzlom($id2,$lvl)
	{
		global $u,$c,$code;
			$lvl = (int)$lvl;
			
			if( $lvl == 8 ) {
				/*
				�������� �������
				��������� �����������
				����
				�������� �������
				*/
				$bots = array( '��������','��������� ������','��������� ������','��������� ������','������� ����','���������� ����','������ ����' );
			}
			
			$id2 = rand(0,(count($bots)-1));			
			$id = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `login` = "'.$bots[$id2].'" AND `level` <= "'.$u->info['level'].'" AND `active` = "1" ORDER BY `level` DESC LIMIT 1'));
			
			$logins_bot = array();
			$bot = $u->addNewbot($id['id'],NULL,NULL,$logins_bot,NULL);
			
			if( $u->info['login'] == 'LEL' ) {
				echo '<div>';
				print_r($bot);
				echo '</div>';
				echo 'SELECT * FROM `test_bot` WHERE `login` = "'.$bots[$id2].'" AND `level` <= "'.$u->info['level'].'" AND `active` = "1" ORDER BY `level` DESC LIMIT 1';
				echo '<div>';
				if(isset($id['id'])) {
					echo 'TRUE[1]';
				}else{
					echo '<b>ERROR[1]:</b>';
					print_r($id);
					echo '<br>';
				}
				if($bot != false) {
					echo 'TRUE[2]';
				}
				echo '</div>';
			}
			
			if(isset($id['id']) && $bot != false)
			{
				$logins_bot = $bot['logins_bot'];
				//������� �������� � �����
				$expB = -$bot['expB'];
				$btl = array(
				'otmorozok' => 0,
				'priz' => 0,'smert' => 0,'noart'=>0,'noeff'=>0,'noatack'=>0,'arand'=>0,'kingfight'=>0,'nobot'=>0,'fastfight'=>0,
				'players'=>'','timeout'=>60,'type'=>9,'invis'=>0,'noinc'=>0,'travmChance'=>0,'typeBattle'=>0,'addExp'=>$expB,'money'=>0,'izlom'=>(int)$id2,'izlomLvl'=>(int)$lvl);
				$ins = mysql_query('INSERT INTO `battle` (`otmorozok`,`priz`,`smert`,`noart`,`noeff`,`noatack`,`arand`,`kingfight`,`nobot`,`fastfight`,`city`,`time_start`,`players`,`timeout`,`type`,`invis`,`noinc`,`travmChance`,`typeBattle`,`addExp`,`money`,`izlom`,`izlomLvl`) VALUES (
													"'.$btl['otmorozok'].'",
													"'.$btl['priz'].'",
													"'.$btl['smert'].'",
													"'.$btl['noart'].'",
													"'.$btl['noeff'].'",
													"'.$btl['noatack'].'",
													"'.$btl['arand'].'",
													"'.$btl['kingfight'].'",
													"'.$btl['nobot'].'",
													"'.$btl['fastfight'].'",
													"'.$u->info['city'].'",
													"'.time().'",
													"'.$btl['players'].'",
													"'.$btl['timeout'].'",
													"'.$btl['type'].'",
													"'.$btl['invis'].'",
													"'.$btl['noinc'].'",
													"'.$btl['travmChance'].'",
													"'.$btl['typeBattle'].'",
													"'.$btl['addExp'].'",
													"'.$btl['money'].'","'.$btl['izlom'].'","'.$btl['izlomLvl'].'")');
				if($ins)
				{
					$btl_id = mysql_insert_id();
					//��������� ������ � ��������						
					$upd2  = mysql_query('UPDATE `users` SET `battle`="'.$btl_id.'" WHERE `id` = "'.$u->info['id'].'" OR `id` = "'.$bot['id'].'" LIMIT 2');
					mysql_query('UPDATE `stats` SET `team`="1" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('UPDATE `stats` SET `team`="2" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
					//���� ��� ��������, �� ������� ����
					if($btl['type']==1)
					{
						mysql_query('UPDATE `items_users` SET `inOdet`="0" WHERE `uid` = "'.$u->info['id'].'" AND `inOdet`!=0');
						mysql_query('UPDATE `items_users` SET `inOdet`="0" WHERE `uid` = "'.$bot['id'].'" AND `inOdet`!=0');
					}
					
					//��������� ������, ��� ��� �������
					$u->info['battle'] = $btl_id;
					
					//��������� ��� 2 ����
					$id2 = rand(0,(count($bots)-1));			
					$id = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `login` = "'.$bots[$id2].'" AND `level` <= "'.$u->info['level'].'" AND `pishera` != "" AND `active` = "1" ORDER BY `level` DESC LIMIT 1'));
					$bot = $u->addNewbot($id['id'],NULL,NULL,$logins_bot,NULL);
					if(isset($id['id']) && $bot != false) {
						$logins_bot = $bot['logins_bot'];
						mysql_query('UPDATE `users` SET `battle`="'.$btl_id.'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
						mysql_query('UPDATE `stats` SET `team`="2" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
					}
					$id2 = rand(0,(count($bots)-1));			
					$id = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `login` = "'.$bots[$id2].'" AND `level` <= "'.$u->info['level'].'" AND `pishera` != "" AND `active` = "1" ORDER BY `level` DESC LIMIT 1'));
					$bot = $u->addNewbot($id['id'],NULL,NULL,$logins_bot,NULL);
					if(isset($id['id']) && $bot != false) {
						$logins_bot = $bot['logins_bot'];
						mysql_query('UPDATE `users` SET `battle`="'.$btl_id.'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
						mysql_query('UPDATE `stats` SET `team`="2" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
					}
					
					//���������� ��������� � ��� ���� ������
					mysql_query("INSERT INTO `chat` (`city`,`room`,`to`,`time`,`type`,`toChat`,`sound`) VALUES ('".$u->info['city']."','".$u->info['room']."','".$u->info['login']."','".time()."','11','0','117')");
					die('<script>location="main.php?battle_id='.$btl_id.'";</script>');
				}else{
					$this->error = 'Cannot start battle (no prototype "ABD0'.$id['id'].'")';
				}				
			}else{
				echo '<br><font color=red>Cannot start battle (no prototype "ND0IZ'.$lvl.'")</font><br>';
			}
	}
	public function botNoBattle($id,$vars = NULL)
	{
		$sp = mysql_query('SELECT * FROM `stats` WHERE `zv` = "'.$id.'"');
		while($pl = mysql_fetch_array($sp)) {
			//��������� ������ � ��������						
			mysql_query('UPDATE `users` SET `battle`= "0", `ipreg` = "8" WHERE `id` =  "'.$pl['id'].'"');
			mysql_query('UPDATE `stats` SET `zv` = "0", `team` = "0" WHERE `id` = "'.$pl['id'].'"');
		}
		mysql_query('UPDATE `zayvki` SET `cancel` = "'.time().'"  WHERE `id` = "'.$id.'" LIMIT 1');
		mysql_query('DELETE FROM `zayvki` WHERE `id`= "'.$id.'"');
	}
	public function startBattle($id,$vars = NULL)
	{
		global $c,$code,$u;
		/*mysql_query('START TRANSACTION');
		mysql_query("LOCK TABLES
		`aaa_monsters` WRITE,
		`actions` WRITE,
		`bank` WRITE,
		
		`battle` WRITE,
		`battle_act` WRITE,
		`battle_actions` WRITE,
		`battle_cache` WRITE,
		`battle_end` WRITE,
		`battle_last` WRITE,
		`battle_logs` WRITE,
		`battle_logs_save` WRITE,
		`battle_stat` WRITE,
		`battle_users` WRITE,
		
		`bs_actions` WRITE,
		`bs_items` WRITE,
		`bs_items_use` WRITE,
		`bs_logs` WRITE,
		`bs_map` WRITE,
		`bs_statistic` WRITE,
		`bs_trap` WRITE,
		`bs_turnirs` WRITE,
		`bs_zv` WRITE,
		
		`clan` WRITE,
		`clan_wars` WRITE,
		
		`dungeon_actions` WRITE,
		`dungeon_bots` WRITE,
		`dungeon_items` WRITE,
		`dungeon_map` WRITE,
		`dungeon_now` WRITE,
		`dungeon_zv` WRITE,
		
		`eff_main` WRITE,
		`eff_users` WRITE,
		
		`items_img` WRITE,
		`items_local` WRITE,
		`items_main` WRITE,
		`items_main_data` WRITE,
		`items_users` WRITE,
		
		`izlom` WRITE,
		`izlom_rating` WRITE,
		
		`laba_act` WRITE,
		`laba_itm` WRITE,
		`laba_map` WRITE,
		`laba_now` WRITE,
		`laba_obj` WRITE,
		
		`levels` WRITE,
		`levels_animal` WRITE,
		
		`online` WRITE,
		
		`priems` WRITE,
		
		`quests` WRITE,
		`reimage` WRITE,
		
		`reg` WRITE,
		
		`stats` WRITE,
		`test_bot` WRITE,
		`turnirs` WRITE,
		`users` WRITE,
		`users_animal` WRITE,
		`user_ico` WRITE,
		`users_twink` WRITE,
		`zayvki` WRITE;");*/
		$z = mysql_fetch_array(mysql_query('SELECT * FROM `zayvki` WHERE `id`="'.$id.'" AND `start` = "0" AND `cancel` = "0" AND (`time` > "'.(time()-60*60*2).'" OR `razdel` > 3) LIMIT 1'));
		if(isset($z['id']))
		{
			$vars = explode('|-|',$vars);
			if(($z['razdel']>=4 && $z['razdel']<=5) || $z['razdel'] == 10)
			{
				//������ ���������� ��� ���������� ���
				$btl_id = 0;
				//$txtz = '';
				/*if($z['razdel']==5) {
					//����, �������� �� ������� � �������
					$tm_kr = array(0,0,0);
					$tsr = rand(0,2000);
					if($tsr >= 1000) {
						$tsr = 'DESC';
					}else{
						$tsr = 'ASC';
					}
					
					$kix = 0;				
					$sp = mysql_query('SELECT `s`.`id`,`s`.`team`,`s`.`upLevel`,`s`.`btl_cof`,`s`.`exp` FROM `stats` AS `s` WHERE `s`.`zv` = "'.$z['id'].'" ORDER BY `s`.`btl_cof` DESC LIMIT 200');
					while($pl = mysql_fetch_array($sp)) {
						$ytm = 1;
						
						if( $z['invise'] == 1 ) {
							$kix++;
							mysql_query('UPDATE `users` SET `login2` = "���� ('.$kix.')" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
						}
							
						if($z['type'] == 1) {
							$item_odet = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$pl['id'].'" AND `inOdet` != "0"'));
							mysql_query('UPDATE `items_users` SET `inOdet` = "-'.$item_odet['inOdet'].'" WHERE `uid` = "'.$pl['id'].'"');
						}	
						
						if($z['noart'] == 1) {
							mysql_query('UPDATE `items_users` SET `inOdet` = "0" WHERE `uid` = "'.$pl['id'].'" AND `data` LIKE "%|art=1%"');
						}				
						
						/*
						$point = mysql_fetch_array(mysql_query('SELECT SUM(`i`.`price1`),SUM(`i`.`price2`),SUM(`u`.`1price`),SUM(`u`.`2price`) FROM `items_users` AS `u` LEFT JOIN `items_main` AS `i` ON `i`.`id` = `u`.`item_id` WHERE `u`.`inOdet` > 0 AND `u`.`delete` = "0" AND `u`.`uid` = "'.$pl['id'].'" ORDER BY `inOdet` ASC LIMIT 20'));
						
						if($point[2] > $point[0]){
							$point[0] = $point[2];
						}
						
						if($point[3] > $point[1]){
							$point[1] = $point[3];
						}
						
						if($point[1] > $point[0]){
							$point[0] = $point[1];
						}*/
						
						/*$point[0] = $pl['btl_cof'];
						
						if( $pl['exp'] < 110 ) {
							//0
							$miexp = 0; $maexp = 110;
						}elseif( $pl['exp'] < 420 ) {
							//1
							$miexp = 110; $maexp = 420;
						}elseif( $pl['exp'] < 1300 ) {
							//2
							$miexp = 420; $maexp = 1300;
						}elseif( $pl['exp'] < 2500 ) {
							//3
							$miexp = 1300; $maexp = 2500;
						}elseif( $pl['exp'] < 5000 ) {
							//4
							$miexp = 2500; $maexp = 5000;
						}elseif( $pl['exp'] < 12500 ) {
							//5
							$miexp = 5000; $maexp = 12500;
						}elseif( $pl['exp'] < 30000 ) {
							//6
							$miexp = 12500; $maexp = 30000;
						}elseif( $pl['exp'] < 300000) {
							//7
							$miexp = 30000; $maexp = 300000;
						}elseif( $pl['exp'] < 3000000 ) {
							//8
							$miexp = 300000; $maexp = 3000000;
						}elseif( $pl['exp'] < 10000000 ) {
							//9
							$miexp = 3000000; $maexp = 10000000;
						}elseif( $pl['exp'] < 52000000 ) {
							//10
							$miexp = 10000000; $maexp = 52000000;
						}else{
							//11-21
							$miexp = 52000000; $maexp = 9999999999999;
						}
						$srqu = mysql_fetch_array(mysql_query('SELECT COUNT(`id`),SUM(`btl_cof`) FROM `stats` WHERE `exp` >= '.$miexp.' AND `exp` < '.$maexp.' LIMIT 1'));
						$srqu = round($srqu[1]/$srqu[0]);
						
						if( $point[0] > $srqu ) {
							$point[0] = floor($srqu);
						}
						
						
						if($tm_kr[1] == $tm_kr[2]) {
							$ytm = rand(0,2000);
							if($ytm >= 1000) {
								$ytm = 1;
							}else{
								$ytm = 2;
							}
						}elseif($tm_kr[1] > $tm_kr[2]) {
							$ytm = 2;
						}
						
						if($z['arand'] == 1) {
							$tm_kr[$ytm] += 100;
						}else{
							if($point[1] > $point[0]) {
								$tm_kr[$ytm] += $point[0]+15;
							}else{
								$tm_kr[$ytm] += $point[0]+15;
							}
						}
						//$txtz .= ' {'.$tm_kr[1].':'.$tm_kr[2].'}';				
						if($pl['team'] != $ytm) {
							mysql_query('UPDATE `stats` SET `team` = "'.$ytm.'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
						}						
					}
					
					/*
					if($u->info['admin']>0) {
						$tmres = array();
						$sp = mysql_query('SELECT `u`.`id`,`u`.`login`,`u`.`level`,`s`.`team` FROM `stats` AS `s` LEFT JOIN `users` AS `u` ON `s`.`id` = `u`.`id` WHERE `s`.`zv` = "'.$z['id'].'" LIMIT 200');
						while($pl = mysql_fetch_array($sp)) {
							$tmres[$pl['team']] .= '<a href="inf.php?'.$pl['id'].'" target="_blank">'.$pl['login'].'</a>['.$pl['level'].'], ';
						}
						
						echo trim($tmres[1],', ').' &nbsp; ['.$tm_kr[1].'] <b>������</b> ['.$tm_kr[2].'] &nbsp; '.trim($tmres[2],', ');
					}
					
					die('<br>���������, ���� ������������...');
					*/
					
					/*if(date('N') == 6 || date('N') == 7) {
						$z['exp'] += 100;
					}*/
			//	}
			
				//������ ���������� ��� ���������� ���
				$btl_id = 0;
				//$txtz = '';
				if($z['razdel']==5 || $z['razdel'] == 10) {
					//����, �������� �� ������� � �������
					$tm_kr = array(0,0,0);
					$tsr = rand(0,2000);
					if($tsr >= 1000) {
						$tsr = 'DESC';
					}else{
						$tsr = 'ASC';
					}
					
					$players = array();
					$kix = 0;	
					$tmsad = 2;			
					$sp50 = mysql_query('SELECT `id` FROM `stats` WHERE `zv` = "'.$z['id'].'" ORDER BY RAND()');
					while($pl50 = mysql_fetch_array($sp50)) {
						//
						if( $tmsad == 1 ) {
							$tmsad = 2;
						}else{
							$tmsad = 1;
						}
						mysql_query('UPDATE `stats` SET `timeGo` = "'.(time()+5).'" , `team` = "'.$tmsad.'" WHERE `id` = "'.$pl50['id'].'" LIMIT 1');
					}
					
					/*$players = array();
					$kix = 0;				
					$sp = mysql_query('SELECT `s`.`id`,`s`.`team`,`s`.`upLevel`,`s`.`btl_cof`,`s`.`exp` FROM `stats` AS `s` LEFT JOIN `users` AS `u` ON `u`.`id` = `s`.`id` WHERE `s`.`zv` = "'.$z['id'].'" ORDER BY `u`.`online` DESC');
					while($pl = mysql_fetch_array($sp)) {
						//$pl['btl_cof'] += 3;
						//if( $pl['btl_cof'] < 1 ) {
						//	$pl['btl_cof'] = 1;
						//}
						//if( $z['arand'] == 1 ) {
							$pl['btl_cof'] = 1;
						//}
						$players[] = array(
							'id' => $pl['id'],
							's' => (1+$pl['btl_cof'])
						);
					}
					unset($sp,$pl);
					
					$sets = Balancer::balance($players, 's');

					//
					$setA = $sets[0];
					$setB = $sets[1];
					//
					if( ( count($setA) == 0 && count($setB) == 2 ) ) {
						$setA = array(0=>$sets[1][0]);
						$setB = array(0=>$sets[1][1]);
					}elseif( ( count($setB) == 0 && count($setA) == 2 ) ) {
						$setA = array(0=>$sets[0][0]);
						$setB = array(0=>$sets[0][1]);
					}
					//
					$i = 0;
					while( $i <= count($setA) ) {
						if(isset($setA[$i])) {
							mysql_query('UPDATE `stats` SET `team` = "1" WHERE `id` = "'.$setA[$i]['id'].'" LIMIT 1');
						}
						$i++;
					}
					//
					$i = 0;
					while( $i <= count($setB) ) {
						if(isset($setB[$i])) {
							mysql_query('UPDATE `stats` SET `team` = "2" WHERE `id` = "'.$setB[$i]['id'].'" LIMIT 1');
						}
						$i++;
					}
					*/
					//
					
				}
				
/*				$r = explode("OR", $vars[1]);
				echo count($r).") ".$vars[1]."<br>";
*/
				//mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$u->info['city']."','','','','[battle_type[".$z['razdel']."]]".$txtz."','".time()."','6','0')");
				$us_rom = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id`="'.$z['creator'].'"'));
				$btl = array(
				'otmorozok' => $z['otmorozok'],
				'smert' => $z['smert'],'noart' => $z['noart'],'noeff' => $z['noeff'],'noatack' => $z['noatack'],'arand' => $z['arand'],'kingfight' => $z['kingfight'],
				'players'=>'','timeout'=>$z['timeout'],'type'=>$z['type'],'invis'=>$z['invise'],'noinc'=>0,'travmChance'=>$z['travmaChance'],'typeBattle'=>0,'addExp'=>$z['exp'],'money'=>0,'money3'=>0);
				$ins = mysql_query('INSERT INTO `battle` (`otmorozok`,`priz`,`room`,`smert`,`noart`,`noeff`,`noatack`,`arand`,`kingfight`,`nobot`,`fastfight`,`razdel`,`city`,`time_start`,`players`,`timeout`,`type`,`invis`,`noinc`,`travmChance`,`typeBattle`,`addExp`,`money`,`money3`) VALUES (
													"'.$z['otmorozok'].'",
													"'.$z['priz'].'",
													"'.$us_rom['room'].'",
													"'.$z['smert'].'",
													"'.$z['noart'].'",
													"'.$z['noeff'].'",
													"'.$z['noatack'].'",
													"'.$z['arand'].'",
													"'.$z['kingfight'].'",
													"'.$z['nobot'].'",
													"'.$z['fastfight'].'",												
													"'.$z['razdel'].'",
													"'.$z['city'].'",
													"'.time().'",
													"'.mysql_real_escape_string($btl['players']).'",
													"'.mysql_real_escape_string($btl['timeout']).'",
													"'.mysql_real_escape_string($btl['type']).'",
													"'.mysql_real_escape_string($btl['invis']).'",
													"'.mysql_real_escape_string($btl['noinc']).'",
													"'.mysql_real_escape_string($btl['travmChance']).'",
													"'.mysql_real_escape_string($btl['typeBattle']).'",
													"'.mysql_real_escape_string($btl['addExp']).'",
													"'.mysql_real_escape_string($btl['money'],2).'",
													"'.mysql_real_escape_string($btl['money3'],2).'")');
				$btl_id = mysql_insert_id();
				if($btl_id>0)
				{
					
					mysql_query('UPDATE `battle` SET `balance` = "'.count($setA).' vs '.count($setB).'" WHERE `id` = "'.$btl_id.'" LIMIT 1');
					
					//��������� ������ � ��������						
					if($z['noeff'] == 1){
						$st_us  = mysql_query('SELECT * FROM `stats` WHERE `zv` = "'.$z['id'].'"');
						while ($stat_us = mysql_fetch_array($st_us)) {
							$it_us = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$stat_us['id'].'" AND `inOdet` > 0 AND `delete` = "0"');
							while($item_us = mysql_fetch_array($it_us)){
								$t = 0;
								$nam_it = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$item_us['item_id'].'"'));
								$p_mag_inc = strpos($nam_it['magic_inci'], "elicsir_hp");
								if ($p_mag_inc === false) {
									$t = 0;
								}else{
									$t = 1;
								}
							   if($nam_it['magic_inci'] == "cureHP" || $nam_it['magic_inci'] == "cureMP" || $t == 1 || $nam_it['magic_inci'] == "cloneMe"){
							   		mysql_query('UPDATE `items_users` SET `inOdet`="-'.$item_us['inOdet'].'" WHERE `id` = "'.$item_us['id'].'"');
							   }
							}
						}
					}
					$upd1  = mysql_query('UPDATE `stats` SET `zv`="0" WHERE `zv` = "'.$z['id'].'"');
					$upd2  = mysql_query('UPDATE `users` SET `battle`="'.$btl_id.'" WHERE '.$vars[1].'');
					
					//���� ��� ��������, �� ������� ����
					if($z['type']==1)
					{
						//mysql_query('UPDATE `items_users` SET `inOdet`="0" WHERE `uid` = "'.$u->info['id'].'" AND `inOdet`!=0');
					}
					
					//��������� ������, ��� ��� �������
					$upd = mysql_query('UPDATE `zayvki` SET `start` = "'.time().'",`btl_id` = "'.$btl_id.'" WHERE `id` = "'.$z['id'].'" LIMIT 1');
					$u->info['battle'] = $btl_id;
					//���������� ��������� � ��� ���� ������
					//mysql_query("INSERT INTO `chat` (`city`,`room`,`to`,`time`,`type`,`toChat`,`sound`) VALUES ('".$u->info['city']."','-1','".$vars[0]."','".time()."','11','0','117')");
					/*
					die('<script>location="main.php?battle_id='.$btl_id.'";</script>');
					*/
				}
			}elseif(($z['razdel']>=1 && $z['razdel']<=3) || $z['razdel'] == 9)
			{
				//������ PvP
				if($u->info['team']==1 && $u->info['zv']==$z['id'])
				{
					$zu = mysql_fetch_array(mysql_query('SELECT * FROM `stats` WHERE `zv`="'.$z['id'].'" AND `team` = "2" LIMIT 1'));
					if(isset($zu['id']))
					{
						$uz = mysql_fetch_array(mysql_query('SELECT `login`,`money` FROM `users` WHERE `id`="'.$zu['id'].'" LIMIT 1'));
						if($zu['clone'] > 0) {
							//��������� �����
							$bot = $u->addNewbot(1,NULL,$zu['clone'],NULL,true);
							if($bot > 0) {
								mysql_query('DELETE FROM `users` WHERE `id` = "'.$zu['id'].'" LIMIT 1');
								mysql_query('DELETE FROM `stats` WHERE `id` = "'.$zu['id'].'" LIMIT 1');
								mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$zu['id'].'" AND `uid` > 0 LIMIT 100');
								mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$zu['id'].'" LIMIT 100');
								
								mysql_query('UPDATE `stats` SET `zv` = "'.$z['id'].'",`team` = 2 WHERE `id` = "'.$bot.'" LIMIT 1');
																							
								$zu = mysql_fetch_array(mysql_query('SELECT * FROM `stats` WHERE `zv`="'.$z['id'].'" AND `team` = "2" LIMIT 1'));
								$uz = mysql_fetch_array(mysql_query('SELECT `login`,`money` FROM `users` WHERE `id`="'.$zu['id'].'" LIMIT 1'));
							}
						}
						
						//������� ��������						
						$btl_id = 0;
						if($uz['money']<$z['money'] || $u->info['money']<$z['money'])
						{
							$z['money'] = 0;
						}
						$btl = array('otmorozok' => $z['otmorozok'] , 'players'=>'','timeout'=>$z['timeout'],'type'=>$z['type'],'invis'=>0,'noinc'=>0,'travmChance'=>0,'typeBattle'=>0,'addExp'=>0,'money'=>round($z['money'],2),'money3'=>round($z['money3'],2));
						$ins = mysql_query('INSERT INTO `battle` (`razdel`,`otmorozok`,`priz`,`smert`,`noart`,`noeff`,`noatack`,`arand`,`kingfight`,`nobot`,`fastfight`,`city`,`time_start`,`players`,`timeout`,`type`,`invis`,`noinc`,`travmChance`,`typeBattle`,`addExp`,`money`,`money3`) VALUES (
															"'.$z['razdel'].'",
															"'.$btl['otmorozok'].'",
															"'.mysql_real_escape_string($z['priz']).'",
															"'.mysql_real_escape_string($btl['smert']).'",
															"'.mysql_real_escape_string($btl['noart']).'",
															"'.mysql_real_escape_string($btl['noeff']).'",
															"'.mysql_real_escape_string($btl['noatack']).'",
															"'.mysql_real_escape_string($btl['arand']).'",
															"'.mysql_real_escape_string($btl['kingfight']).'",
															"'.mysql_real_escape_string($btl['nobot']).'",
															"'.mysql_real_escape_string($btl['fastfight']).'",	
															"'.$u->info['city'].'",
															"'.time().'",
															"'.mysql_real_escape_string($btl['players']).'",
															"'.mysql_real_escape_string($btl['timeout']).'",
															"'.mysql_real_escape_string($btl['type']).'",
															"'.mysql_real_escape_string($btl['invis']).'",
															"'.mysql_real_escape_string($btl['noinc']).'",
															"'.mysql_real_escape_string($btl['travmChance']).'",
															"'.mysql_real_escape_string($btl['typeBattle']).'",
															"'.mysql_real_escape_string($btl['addExp']).'",
															"'.mysql_real_escape_string($btl['money']).'","'.mysql_real_escape_string($btl['money3']).'")');
						$btl_id = mysql_insert_id();
						if($ins)
						{
							//��������� ������ � ��������						
							$upd1  = mysql_query('UPDATE `stats` SET `zv`="0" WHERE `zv` = "'.$z['id'].'" LIMIT 2');
							$upd2  = mysql_query('UPDATE `users` SET `battle`="'.$btl_id.'" WHERE `id` = "'.$u->info['id'].'" OR `id` = "'.$zu['id'].'" LIMIT 2');
							
							//���� ��� ��������, �� ������� ����
							if($z['type']==1)
							{
								mysql_query('UPDATE `items_users` SET `inOdet`="0" WHERE `uid` = "'.$u->info['id'].'" AND `inOdet`!=0');
								mysql_query('UPDATE `items_users` SET `inOdet`="0" WHERE `uid` = "'.$zu['id'].'" AND `inOdet`!=0');
							}
							
							//��������� ������, ��� ��� �������
							$upd = mysql_query('UPDATE `zayvki` SET `start` = "'.time().'",`btl_id` = "'.$btl_id.'" WHERE `id` = "'.$z['id'].'" LIMIT 1');

							$u->info['battle'] = $btl_id;
							
							//���������� ��������� � ��� ���� ������
							mysql_query("INSERT INTO `chat` (`city`,`room`,`to`,`time`,`type`,`toChat`,`sound`) VALUES ('".$u->info['city']."','".$u->info['room']."','".$uz['login']."','".time()."','11','0','117')");
							die('<script>location="main.php?battle_id='.$btl_id.'";</script>');
						}else{
							$this->error = '������ �������� �����.';
						}	
					}else{
						$this->error = '�� �� ������ ������ ��������, ���� ������ ����� �� ������.';
					}
				}else{
					$this->error = '�� �� ������ ������ ��������.';
				}
			}
		}	
		//mysql_query('UNLOCK TABLES');
		//mysql_query('COMMIT');
	}

	public function cancelzv()
	{
		global $u,$c,$code,$zi;
		if(isset($_GET['cancelzv'],$zi['id']) && (($zi['razdel']>=1 && $zi['razdel']<=3) || $zi['razdel'] == 9))
		{
			$enemy = mysql_fetch_array(mysql_query('SELECT `u`.*,`st`.* FROM `stats` AS `st` LEFT JOIN `users` AS `u` ON (`st`.`id` = `u`.`id`) WHERE `st`.`zv`="'.$zi['id'].'" AND `st`.`team` = "2" LIMIT 1'));
			if(isset($enemy['id']))
			{
				if(($zi['razdel']>=1 && $zi['razdel']<=3) || $zi['razdel'] == 9)
				{
					if($u->info['team']==1)
					{
						//���������� �� ������ + ����� ��������� � ���
						$upd = mysql_query('UPDATE `stats` SET `zv` = "0",`team`="0" WHERE `id` = "'.$enemy['id'].'" LIMIT 1');
						if($upd)
						{
							mysql_query('UPDATE `users` SET `otk` = (`otk` + 1) WHERE `id` = "'.$zi['id'].'" LIMIT 1');
							$this->error = '�� �������� '.$enemy['login'].' � ��������';
							//���������� ��������� � ���
							$sa = '';
							if($u->info['sex']==2)
							{
								$sa = '�';
							}
							$text = ' [login:'.$u->info['login'].'] �������'.$sa.' ��� � ��������.';
							mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$enemy['city']."','','','".$enemy['login']."','".$text."','".time()."','6','0')");
						}
					}elseif($u->info['id']==$enemy['id'] && $zi['start']==0)
					{
						//���������� �� ������ + ����� ��������� � ���
						$upd = mysql_query('UPDATE `stats` SET `zv` = "0",`team`="0" WHERE `id` = "'.$enemy['id'].'" LIMIT 1');
						if($upd)
						{
							$uz = mysql_fetch_array(mysql_query('SELECT `u`.`sex`,`u`.`login`,`u`.`city`,`u`.`room`,`u`.`id`,`st`.`zv`,`st`.`team` FROM `stats` AS `st` LEFT JOIN `users` AS `u` ON (`st`.`id` = `u`.`id`) WHERE `st`.`zv`="'.$zi['id'].'" AND `st`.`team` = "1" LIMIT 1'));
							if(isset($uz['id']))
							{
								$this->error = '�� �������� ���� ������ �� ���.';
								//���������� ��������� � ���
								$sa = '';
								if($u->info['sex']==2)
								{
									$sa = '�';
								}
								$text = ' [login:'.$u->info['login'].'] �������'.$sa.' ���� ������ �� ���.';
								mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$uz['city']."','','','".$uz['login']."','".$text."','".time()."','6','0')");
							}
							$u->info['zv'] = 0;
							$u->info['team'] = 0;
						}
					}
					if($enemy['bot'] == 1) {
						//������� ���� , �������� � �������
						mysql_query('DELETE FROM `users` WHERE `id` = "'.$enemy['id'].'" LIMIT 1');
						mysql_query('DELETE FROM `stats` WHERE `id` = "'.$enemy['id'].'" LIMIT 1');
						mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$enemy['id'].'" LIMIT 100');
						mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$enemy['id'].'" LIMIT 100');
					}
				}
			}else{
				if(( ($zi['razdel']>=1 && $zi['razdel']<=3) || $zi['razdel'] == 9 ) && $u->info['team']==1)
				{
					//������� ������ �� ���
					$upd = mysql_query('UPDATE `zayvki` SET `cancel` = "'.time().'" WHERE `id` = "'.$zi['id'].'" LIMIT 1');
					if($upd)
					{
						mysql_query('UPDATE `stats` SET `zv` = "0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						$this->error = '�� �������� ���� ������';
						$zi = false;
						$u->info['zv'] = 0;
					}
				}
			}
			
		}
	}
	public function prosmotr()
	{

		global $u,$c,$code,$zi;
		if(isset($_GET['r']))
		{
			$r = round(intval($_GET['r']));
			if($r == 5 || $r == 10)
			{
				//������ ������
				$i = 0;
				$cl = mysql_query('SELECT * FROM `zayvki` WHERE `razdel` = "'.mysql_real_escape_string($r).'" AND `start` = "0" AND `cancel` = "0" AND `time` > "'.(time()-60*60*2).'" AND `city` = "'.$u->info['city'].'" ORDER BY `id` DESC');
				$zvb = '';
				while($pl = mysql_fetch_array($cl))
				{
					if($pl['razdel']==5 || $pl['razdel']==10)
					{
						//������ ���������� ���
						$tm = '';
						$tmStart = floor(($pl['time']+$pl['time_start']-time())/6)/10;
						//if( $u->info['admin'] > 0 ) {
							if((($pl['time']+$pl['time_start'])/10) != (int)(($pl['time']+$pl['time_start'])/10)) {
								$pl['time'] = ceil($pl['time']/60)*60;
								mysql_query('UPDATE `zayvki` SET `time` = "'.$pl['time'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
							}
						//}
						$tmStart = $this->rzv($tmStart);
						if($tmStart == "-0.1"){
							$tmStart = "0.0";
						}
						
						$users = mysql_query('SELECT `u`.`id`,`u`.`login`,`u`.`level`,`u`.`align`,`u`.`clan`,`u`.`admin`,`st`.`team` FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON `u`.`id` = `st`.`id` WHERE `st`.`zv` = "'.$pl['id'].'"');
						$col_p = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `zv` = "'.$pl['id'].'"'));
						$cols = $col_p[0];
						while($s = mysql_fetch_array($users))
						{
							$tm .= $u->microLogin($s['id'],1).', ';
						}
						
						$rad = '';
						
						$tm = rtrim($tm,', ');
						
						if(!isset($zi['id']) && $u->room['zvsee'] == 0 && $u->info['inTurnirnew'] == 0) {
							$rad = '<input type="radio" name="btl_go" id="btl_go'.$pl['id'].'" value="'.$pl['id'].'"> ';
						}
						
						$n1tv = '';
						$unvs = '';
						if($pl['invise']==0)
						{
							//��������� ���
							//$tm = '<i>���������</i>';
							$unvs = 0;
							//if($u->info['admin'] > 0 || ($u->info['align'] > 1 && $u->info['align'] < 2) || ($u->info['align'] > 3 && $u->info['align'] < 4) ) {
								$usrszv = '';
								//if( $u->info['admin'] > 0 ) {
									$spzm = mysql_query('SELECT `id`,`team` FROM `stats` WHERE `zv` = "'.$pl['id'].'" AND `id` != "'.$pl['creator'].'"');
									while( $plzm = mysql_fetch_array($spzm) ) {
										$usrszv .= ','.$u->microLogin($plzm['id'],1).'';
										$unvs++;
									}
								//}

								$tm = $u->microLogin($pl['creator'],1).$usrszv;
							//}
							if($pl['creator'] == 0){
								$unvs = ''.($unvs);
							}
							else{
								$unvs = ''.(1+$unvs);	
							}
							//$unvs = ''.(1+$unvs).' ���. ';
							//$n1tv = ' <img src="http://img.likebk.com/i/fighttypehidden0.gif" title="���������">';
						}
						//
						if( $pl['kingfight'] == 1 ) {
							$n1tv .= ' <img src="http://img.likebk.com/king.gif" rel="tooltip" title="�������� ��������">';
						}
						if( $pl['noart'] == 1 ) {
							$n1tv .= ' <img src="http://img.likebk.com/noart2.gif" rel="tooltip" title="��� ��� ����������">';
						}
						if( $pl['noeff'] == 1 ) {
							$n1tv .= ' <img src="http://img.likebk.com/noeff3.gif" rel="tooltip" title="��������� ������������� ������� ������� HP, ������������ � �������������� MP">';
						}
						if( $pl['noatack'] == 1 ) {
							$n1tv .= ' <img src="http://img.likebk.com/closefight3.gif" rel="tooltip" title="� ��� ������ ���������">';
						}
						if( $pl['nobot'] == 1 ) {
							$n1tv .= ' <img src="http://img.likebk.com/nobot.gif" rel="tooltip" title="� ��� �� �������� ����">';
						}
						if( $pl['fastfight'] == 1 ) {
							$n1tv .= ' <img src="http://img.likebk.com/fastfight.gif" rel="tooltip" title="��� ������ ��� ���������� ������� 2 ������">';
						}
						if( $pl['arand'] == 1 ) {
							$n1tv .= ' <img src="http://img.likebk.com/arand.gif" rel="tooltip" title="������ ����������� ��������� ��������� �������">';
						}
						if( $pl['otmorozok'] == 1 ) {
							$n1tv .= ' <img src="http://img.likebk.com/snow.gif" width="20" height="20" title="� ��� ����� ��������� ���������">';
						}
						//
						/*if($pl['comment'] != '') {
						  $dl = '';
						  if(($moder['boi'] == 1 || $u->info['admin'] > 0) && $pl['dcom']==0) {
						    $dl .= ' (<a href="main.php?zayvka=1&r=5&delcom='.$pl['id'].'&key='.$u->info['nextAct'].'&rnd='.$code.'">������� �����������</a>)';          if(isset($_GET['delcom']) && $_GET['delcom'] == $pl['id'] && $u->newAct($_GET['key']) == true) {
				              mysql_query('UPDATE `zayvki` SET `dcom` = "'.$u->info['id'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				              $pl['dcom'] = $u->info['id'];
			                }
						  }
						  if($pl['dcom'] > 0) { $dl = '<font color="grey"><i>����������� ������ �����������</i></font>'; }
						  if($pl['dcom'] > 0) {
							if($moder['boi'] == 1 || $u->info['admin'] > 0) {
				              $pl['comment'] = '[ ����� ����������� : <font color="red">'.$pl['comment'].'</font>]&nbsp;';
			                } else {
				              $pl['comment'] = '';
			                 }
		                   }
						$zv_comm = '('.$pl['comment'].''.$dl.')';
						} else {
						  $zv_comm = '';
						}*/
						$zv_comm = '';
                        if($pl['money3'] > 0) { $mon = ' ��� �� ������, ������: <b>'.$pl['money3'].'</b>$ '; } else { $mon = ''; }
						if(($r == 5 || $r == 10) && ($pl['creator'] == $u->info['id']) && $cols < 2) {
						  $del_q = '&nbsp;&nbsp;<a href="main.php?zayvka=1&r=5&del_z_time='.$pl['id'].'&rnd='.$code.'"><img src="http://img.likebk.com/i/clear.gif" rel="tooltip" title="������� ������" /></a>';
						} else {
						  $del_q = '';
						}

					$zvb .= '<div style="margin-bottom: 5px;">';
						
						if($pl['type'] == 0){
							$typeboi = "���������� ���";
						}elseif($pl['type'] == 99){
							$typeboi = "�������� ���";
						}
						else{
							$typeboi = "�������� ���";
						}

						if($_COOKIE["mylvl_cookie"] == 1){
							if($u->info['level'] >= $pl['min_lvl_1'] && $u->info['level'] <= $pl['max_lvl_1']){
								
								if( ($pl['timeout']/60) < 0 ) {
									$pl['timeout'] = 0;
								}
								
								//���������� ��� ����������
								if($pl['noart'] == 1 ){	
									if($pl['creator'] == 0){	
										if($tm == ''){		
											$zvb .= '<strong><font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <strong>(����������)</strong><i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.' ���.</strong></span>)<br></i>';
										}
										else{
											$zvb .= '<strong><font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <strong>(����������)</strong><i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.' ���.</strong></span>) </i> ���������: <span style="color:maroon">'.$tm.'</span><br>';	
										}
									}else{
										$zvb .= '<strong><font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.' ���.</strong></span>) </i>���������: <span style="color:maroon">'.$tm.'</span> '.$del_q.'<br>';
									}
								}
								//������ ������
								if(($pl['min_lvl_1'] == $pl['max_lvl_1']) && $pl['noart'] == 0){
									$zvb .= '<strong><font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.' ���.</strong></span>) </i>���������: <span style="color:maroon">'.$tm.'</span> '.$del_q.'<br>';
								}
								elseif($pl['noart'] == 0){
									$zvb .= '<strong><font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.' ���.</strong></span>) </i>���������: <span style="color:maroon">'.$tm.'</span> '.$del_q.'<br>';
								}
							}
						}
						else{
							//���������� ��� ����������
							if($pl['noart'] == 1 ){		
								if($pl['creator'] == 0){		
									if($tm == ''){		
										$zvb .= '<strong><font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <strong>(����������)</strong><i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.' ���.</strong></span>)<br></i>';
									}
									else{
										$zvb .= '<strong><font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <strong>(����������)</strong><i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.' ���.</strong></span>) </i> ���������: <span style="color:maroon">'.$tm.'</span><br>';	
									}
								}else{
									$zvb .= '<strong><font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.' ���.</strong></span>) </i>���������: <span style="color:maroon">'.$tm.'</span> '.$del_q.'<br>';
								}
							}
							//������ ������
							if(($pl['min_lvl_1'] == $pl['max_lvl_1']) && $pl['noart'] == 0){
								$zvb .= '<strong><font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.' ���.</strong></span>) </i>���������: <span style="color:maroon">'.$tm.'</span> '.$del_q.'<br>';
							}
							elseif($pl['noart'] == 0){
								$zvb .= '<strong><font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.' ���.</strong></span>) </i>���������: <span style="color:maroon">'.$tm.'</span> '.$del_q.'<br>';
							}
						}
						

					$zvb .= '</div>';
					}
					$i++;
				}
				
				echo "<hr style='margin-top: 15px;margin-bottom: 15px; padding-bottom: 0px;'>";
				echo $zvb;
			}
		}
	}
	
	public function see()
	{
		global $u,$c,$code,$zi,$cron;
		if(isset($_GET['r']) && ((!isset($_GET['new_group']) && !isset($_POST['groupClick'])) || isset($zi['id'])) )
		{
			$r = round(intval($_GET['r']));
			if(($r>=1 && $r<=5) || $r==8 || $r == 10 || $r==9)
			{
				$this->zv_see = 1;
				if($u->room['FR']==0 && $u->room['zvsee']==0)
				{
					if(($r == 5 || $r == 10) && $u->info['level'] > 7)
					{
						echo '<br><b><font color="black"><center>������ ������ ��� ������� ������ ����� ������ � �������� ����������� �����</center></font></b>'; $this->zv_see = 0;
						$this->prosmotr();
					}elseif(($r == 5 || $r == 10) && $u->info['level'] < 8){
						echo '<br><b><font color="black"><center>������ ������ ��� ������� ������ ����� ������ � 8 ������</center></font></b>'; $this->zv_see = 0;
						$this->prosmotr();
					}else{
						echo '<br><br><br><b><font color="black"><center>������ ������ ����� ������ � �������� ����������� �����</center></font></b>'; $this->zv_see = 0;
					}
				}elseif($r==1 && $u->info['level']>0)
				{
					echo '<br><br><br><b><font color="black"><center>�� ��� ������� �� ��������� ;)</center></font></b>'; $this->zv_see = 0;
				}elseif($r>1 && $r<6 && $u->info['level']<1)
				{
					echo '<br><br><br><b><font color="black"><center>�� ��� �� ������� �� ��������� ;)</center></font></b>'; $this->zv_see = 0;
				}elseif( ( $r == 10 || ($r>3 && $r<6)) && $u->info['level']<8)
				{
					if($r == 5 || $r == 10){
						echo '<br><b><font color="black"><center>������ ������ ��� ������� ������ ����� ������ � 8 ������</center></font></b>'; $this->zv_see = 0;
						$this->prosmotr();
					}else{
						echo '<br><br><br><b><font color="Red"><center>� '.$this->z1n[$r].' ��� ������ � �������� ������.</center></font></b>'; $this->zv_see = 0;
					}
				}elseif($r==1 && $u->info['level']>0)
				{
					echo '<br><br><br><b><font color="black"><center>�� ��� ������� �� ��������� ;)</center></font></b>'; $this->zv_see = 0;
				}elseif($r==8 && $u->info['level'] < 1)
				{
					echo '<br><br><br><b><font color="black"><center>��������� ������� � ������� ������ � ������� ������.</center></font></b>'; $this->zv_see = 0;
				}elseif($u->info['zv']>0 && $u->info['battle']==0 && $r != 8)
				{
					if($zi['razdel']==1 || $zi['razdel']==2 || $zi['razdel']==3 || $zi['razdel']==9)
					{
						echo '
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td valign="top">';
							
							if($u->info['team']==1)
							{
								$uz = mysql_fetch_array(mysql_query('SELECT `u`.`sex`,`u`.`id`,`u`.`login`,`u`.`align`,`u`.`clan`,`u`.`admin`,`u`.`city`,`u`.`room`,`u`.`online`,`u`.`level`,`u`.`battle`,`u`.`money`,`st`.* FROM `stats` AS `st` LEFT JOIN `users` AS `u` ON (`st`.`id` = `u`.`id`) WHERE `st`.`zv`="'.$zi['id'].'" AND `st`.`team`="2" LIMIT 1'));
								if(!isset($uz['id']))
								{
									//���� ����� �� ������
									echo '<div style="float:left;"><div style="float:left;">�� ��� ������ ������ �� ���  <INPUT onClick="location=\'main.php?zayvka=1&r='.$_GET['r'].'&rnd='.$code.'&cancelzv\';" TYPE=submit name=close value="�������� ������"></div>';
								}else{
									//���� ���-�� ������
									$sa = '';
									if($uz['sex']==2)
									{
										$sa = '�';
									}
									echo '<script> zv_Priem = '.(0+$uz['id']).';</script><font color="red"><b>���� ������ ������'.$sa.' '.$ca.'</font></b> '.$u->microLogin($uz['id'],1).'</a><font color="red"><b> ������ ����������� ���? </b></font><INPUT onClick="location=\'main.php?zayvka=1&r='.$_GET['r'].'&rnd='.$code.'&startBattle\';" TYPE=submit name=close value="�����������"> <INPUT onClick="location=\'main.php?zayvka=1&r='.$_GET['r'].'&rnd='.$code.'&cancelzv\';" TYPE=submit name=close value="��������">';
								}
							}else{
								$uz = mysql_fetch_array(mysql_query('SELECT `u`.`id`,`u`.`login`,`u`.`align`,`u`.`clan`,`u`.`admin`,`u`.`city`,`u`.`room`,`u`.`online`,`u`.`level`,`u`.`battle`,`u`.`money`,`st`.* FROM `stats` AS `st` LEFT JOIN `users` AS `u` ON (`st`.`id` = `u`.`id`) WHERE `st`.`zv`="'.$zi['id'].'" AND `st`.`team`="1" LIMIT 1'));
								if(isset($uz['id']))
								{
									echo '������� ������������� ��� �� '.$u->microLogin($uz['id'],1).' <INPUT onClick="location=\'main.php?zayvka=1&r='.$_GET['r'].'&rnd='.$code.'&cancelzv\';" TYPE=submit name=close value="�������� ������">';
								}else{
									//������� ������
									
								}
							}
							
							echo '</td>
							<td align="right" valign="top">
								<div style="float:right;"></div>
							</td>
						  </tr>
						</table></div>';						
					}else{
						$tm_start = floor(($zi['time']+$zi['time_start']-time())/6)/10;
						$tm_start = $this->rzv($tm_start);
						echo '<div style="float:right;"></div>';
						$txt2 = '<b style="margin-bottom: 7px; margin-top:7px; display: inline-block">������� ������ '.$this->z2n[$zi['razdel']].' ���</b><br><span style="margin-bottom: 5px; display: inline-block">��� ��� �������� ����� '.$tm_start.' ���.</span>';
						echo $txt2;
						$sv0 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `zv` = "'.$zi['id'].'" LIMIT 100'));
						/*if($sv0[0] <= 1)
						{
							if(isset($_GET['cancelzvnow']))
							{
								echo ' <b><font color="red">������ �� ��� ��������</font></b>';
								mysql_query('UPDATE `zayvki` SET `cancel` = "'.time().'" WHERE `id` = "'.$u->info['zv'].'" LIMIT 1');
								$u->info['zv'] = 0;
								mysql_query('UPDATE `stats` SET `zv` = "0",`team` = "0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');								
							}else{
								echo ' <a href="main.php?zayvka&r='.$_GET['r'].'&cancelzvnow&rnd='.$code.'" title="�������� ������">��������</a>';
							}
						}*/
						unset($sv0);
						
					}
				}elseif($r==8) {
					//�������
					
					$ttur = array(
						0 => '������ ����� �����!',
						1 => '������ ��� �� ����!',
						2 => '������ �����!'				
					);
										
					if(isset($_POST['trn1']) && $u->room['zvsee']==0) {
						if($u->info['zv'] > 0) {
							$this->error = '�� �� ������ �������� � ������ �.�. ���������� � ������ �� ���.';
						}elseif($u->info['inTurnirnew'] == 0) {
							$totr = mysql_fetch_array(mysql_query('SELECT * FROM `turnirs` WHERE `id` = "'.mysql_real_escape_string($_POST['trn1']).'" AND `status` = "0" LIMIT 1'));
							$tstgo = mysql_fetch_array(mysql_query('SELECT `id` FROM `turnir_go` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
							if($u->info['twink'] > 0) {
								$this->error = '������� ��������� ��������� ������� � �������!';
							}elseif( $totr['type'] == 2 && $u->info['money'] < 10 ) {
								$this->error = '��������� ������������� ����� � ������� 10 ��.';
							}elseif( $totr['time']-time() > 60 * 15 && !isset($tstgo['id']) ) {
								$this->error = '��������� ������� � ������� ����� �������� �� 15 �� ������. ';
							}elseif( $totr['users_in'] >= 30 && !isset($tstgo['id']) ) {
								$this->error = '������������ ����� ���������� 30 �������!';
							}elseif(isset($totr['id'])) {
								if( $totr['type'] == 2 ) {
									$u->info['money'] -= 10;
								}
								mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" , `inTurnirnew` = "'.$totr['id'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
								mysql_query('UPDATE `turnirs` SET `users_in` = `users_in` + 1 WHERE `id` = "'.$totr['id'].'" LIMIT 1');
								$u->info['inTurnirnew'] = $totr['id'];
								$this->error = '�� ���������� �� ������� � �������.';
								$totr['users_in']++;
								if( $totr['users_in'] >= 16 ) {
								//	mysql_query('UPDATE `turnirs` SET `time` = "'.(time()+600).'" WHERE `id` = "'.$totr['id'].'" LIMIT 1');
								}
							} else {
								$this->error = '������ �� ������ �� �������.';
							}
						}else{
							$this->error = '�� ��� ���������� � ������ �� ������.';
						}
					}elseif(isset($_GET['cancel13']) && $u->room['zvsee']==0) {
						if($u->info['inTurnirnew'] > 0) {
							$totr = mysql_fetch_array(mysql_query('SELECT * FROM `turnirs` WHERE `id` = "'.mysql_real_escape_string($u->info['inTurnirnew']).'" AND `status` = "0" LIMIT 1'));
							if(isset($totr['id'])) {
								mysql_query('UPDATE `users` SET `inTurnirnew` = "0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
								mysql_query('UPDATE `turnirs` SET `users_in` = `users_in` - 1 WHERE `id` = "'.$totr['id'].'" LIMIT 1');
								$u->info['inTurnirnew'] = 0;
								$this->error = '�� ���������� �� ������ �� ������.';
							}else{
								$this->error = '������ ���������� �� ������ �������� � �������.';
							}
						}else{
							$this->error = '�� �� ���������� ������� �� � ����� �� ��������.';
						}
					}
					
					$dv = '';
					$trse = '';
					
					if($u->info['inTurnirnew'] > 0) {
						$pl = mysql_fetch_array(mysql_query('SELECT * FROM `turnirs` WHERE `id` = "'.$u->info['inTurnirnew'].'" LIMIT 1'));
						if(!isset($pl['id'])) {
							mysql_query('UPDATE `users` SET `inTurnirnew` = "0" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
							echo '���-�� �� ���... �������� ��������.';
						}else{
							$dv = '';
							$dv55 = '';
							$sp55 = mysql_query('SELECT * FROM `turnir_spell` WHERE `uid` = "'.$u->info['id'].'" ORDER BY `item_id` ASC');
							while( $pl55 = mysql_fetch_array($sp55) ) {
								$itmm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$pl55['item_id'].'" LIMIT 1'));
								if(isset($itmm['id'])) {
									$dv55 .= '<img title="'.$itmm['name'].'" src="http://img.likebk.com/i/items/'.$itmm['img'].'"> ';
								}
							}
							if( $dv55 != '' ) {
								$dv .= '<div><b>������ ������� �� �������� � �������:</b><br>'.$dv55.'</div><hr>';
							}
							$dv .= '<b><u>��������� ������� ['.$pl['users_in'].']</u></b>:<br>';
							$spu = mysql_query('SELECT `u`.`id`,`u`.`align`,`u`.`login`,`u`.`clan`,`u`.`level`,`u`.`city`,`u`.`online`,`u`.`sex`,`u`.`cityreg`,`u`.`palpro`,`u`.`invis` FROM `users` AS `u` WHERE `u`.`inTurnirnew` = "'.$pl['id'].'" LIMIT '.$pl['users_in']);
							$i = 1;
							while($plu = mysql_fetch_array($spu)) {
								$dv .= '<div style="padding:3px;">'.$i.'. '.$u->microLogin($plu,2).'</div>';
								$i++;
							}
							echo '
							<script type="text/javascript">
							function MM_jumpMenu(targ,selObj,restore){ //v3.0
							  eval("location=\'"+selObj.options[selObj.selectedIndex].value+"\'");
							  if (restore) selObj.selectedIndex=0;
							}
							</script>
							<FORM style="margin:0px; padding:0px; border:0px;" METHOD=\'POST\' ACTION=\'main.php?zayvka=1&r='.$r.'&rnd='.$code.'\'>
							<input type="hidden" name="add_new_zv" id="add_new_zv" value="'.floor(time()/3).'" />
							<TABLE width=100% cellspacing=0 cellpadding=0>
								  <TR>
									<TD valign=top>
										<font style="margin-top: 5px; margin-bottom: 5px; display: inline-block;" color="red"><b>'.$this->error.'</b></font>
										<div style="border-bottom:#b2b2b2 solid 1px;padding:5px;">
										������ ������� ����� '.$u->timeOut($pl['time']-time()).' <INPUT class="btnnew" onClick="location=\'main.php?zayvka&r=8&cancel13&tlvl='.$pl['level'].'&rnd='.$code.'\';" TYPE=button name=tmp value="����������">
										</div>
										<div style="border-bottom:#b2b2b2 solid 1px;padding:5px;margin-bottom:5px;">
										'.$dv.'
										</div>
										</TD>
									<TD align=right valign=top></TD>
								  </TR>
								</TABLE>
								</FORM>';
						}
					}else{
						$tlvl = 4;
						$i = 4;
						$trnmz = array(4=>'����������',5=>'����������',6=>'���.\���.');
						while($i <= 6) {
							if($_GET['tlvl'] == $i) {
								$trse .= '<option value="http://likebk.com/main.php?zayvka&r=8&tlvl='.$i.'" selected="selected">'.$trnmz[$i].'</option>';
								$tlvl = $i;
							}else{
								$trse .= '<option value="http://likebk.com/main.php?zayvka&r=8&tlvl='.$i.'">'.$trnmz[$i].'</option>';
							}
							$i++;
						}						
						$prb = '<INPUT class="btnnew" TYPE="submit" name=open value="������� �������">';										
						echo '<style>.zvnkj { padding:5px; }</style>';						
						$sp = mysql_query('SELECT * FROM `turnirs` WHERE `status` = "0" AND `level` = "'.$tlvl.'"');
						$j = 0;
						while($pl = mysql_fetch_array($sp)) {
							$j++;
							$dinf = '������ ����� '.$u->timeOut($pl['time']-time()).'';
							$dv .= '<br><label><div class="zvnkj">';							
							if($u->room['zvsee']==0) {
								$dv .= '<input type="radio" name="trn1" id="trn1_'.$j.'" value="'.$pl['id'].'">';
							}
							if( $pl['type'] == 1 ) {
								$dv .= ' <font color=blue>��������� ��������</font>. ';
							}elseif( $pl['type'] == 2 ) {
								$dv .= ' <font color="blue">��������� ���������</font>. <font color=red>������������� �����: <b>10 ��.</b></font>. ';
							}
							$dv .= ' ���������� ������. ���������� �������: '.$pl['users_in'].' ���. | '.$dinf.'</div></label>';
						}											
						if($dv == '') {
							$dv = '������ �������� ��� ������� ���� ����...';
						}	
						$tstgo = mysql_fetch_array(mysql_query('SELECT `id` FROM `turnir_go` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));	
						if(isset($tstgo['id'])) {
							$dv .= '<div><b><font color=blue>�� ������ ������� ������� � ������� ��� ������ ��������! (������ ���� ���)</font></b></div>';
						}
						$dv55 = '';
						$sp55 = mysql_query('SELECT * FROM `turnir_spell` WHERE `uid` = "'.$u->info['id'].'" ORDER BY `item_id` ASC');
						while( $pl55 = mysql_fetch_array($sp55) ) {
							$itmm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$pl55['item_id'].'" LIMIT 1'));
							if(isset($itmm['id'])) {
								$dv55 .= '<img title="'.$itmm['name'].'" src="http://img.likebk.com/i/items/'.$itmm['img'].'"> ';
							}
						}
						if( $dv55 != '' ) {
							$dv .= '<div><hr><b>������ ������� �� �������� � �������:</b><br>'.$dv55.'</div>';
						}
						echo '
						<script type="text/javascript">
						function MM_jumpMenu(targ,selObj,restore){ //v3.0
						  eval("location=\'"+selObj.options[selObj.selectedIndex].value+"\'");
						  if (restore) selObj.selectedIndex=0;
						}
						</script>
						<FORM style="margin:0px; padding:0px; border:0px;" METHOD=\'POST\' ACTION=\'main.php?zayvka=1&r='.$r.'&rnd='.$code.'\'>
						<input type="hidden" name="add_new_zv" id="add_new_zv" value="'.floor(time()/3).'" />
						<TABLE width=100% cellspacing=0 cellpadding=0>
							  <TR>
								<TD valign=top>
									<font color="red"><b>'.$this->error.'</b></font>
									<div style="border-bottom:#b2b2b2 solid 1px;padding:5px;">
									<!-- ��� �������:
										  <SELECT NAME=turlevel onChange="MM_jumpMenu(null,this,0)">
											'.$trse.'
										 </SELECT>-->
										 '.$prb.'
									</div> 
									<div style="border-bottom:#b2b2b2 solid 1px;padding:5px;margin-bottom:5px;">
									'.$dv.'
									</div>
									'.$prb.'
									</TD>
								<TD align=right valign=top></TD>
							  </TR>
							</TABLE>
							</FORM>';
					}
				}elseif($r==1 || $r==2 || $r==3 || $r==9)
				{
					//�������,����������,����������
					$zi = array(1=>'���� �� �� �������� ������� ������, �� ��� ��� ��� ������������ ������ ��� ���������� ����.',2=>'����� �� ������ ����� ���� ���������� ���������� ��� ��������.',3=>'������ ��� ���������� ��� �������� ������ ����������. �� � ��� ��������� �� ������� ������� ������� �� ���������� ��������. ��������� ���� �� �������������.');
					$dv = '';
					if($u->room['zvsee']==0) {
					if($r==3) {
					    if($u->info['level'] < 4) {
		                  $mn = '<i style="color: Red;">��� �� ������ ���������� � 4 ������.</i><br />';
					    } elseif($u->info['money3'] > 0) {
					      $mn = '<input type="text" name="art_money3" autocomplete="off" size="5" /><br />';
					    } else {
					      $mn = '<i style="color: Red;">� ���, ������������ ������.</i><br />';
					    }
					    if($u->info['level'] > 3){
						$dv = '<br>����� ����������
									  <INPUT TYPE=text NAME=onlyfor maxlength=30 size=12>
									  <BR> <INPUT class="btnnew" TYPE=submit name=open value="������ ������">
									  &nbsp;';
						}
						else{
							echo '<br><br><br><b><font color="Red"><center>��� �� ������ ���������� � 4 ������.</center></font><br />';
						}
					}else{
						$dv = '<INPUT class="btnnew" TYPE=submit name=open value="������ ������">';
						//if($u->info['level'] <= 9 || $u->info['admin']>0 /*|| ($u->stats['silver']>0 && $u->info['level']<8) || ($u->stats['silver'] >= 2 && $u->info['level']<9)*/ )
						if($u->info['level'] <= 7 || $u->info['admin'] > 0)
						{
							$dv .= ' <INPUT class="btnnew" onClick="location=\'main.php?zayvka=1&r='.$_GET['r'].'&bot='.$u->info['nextAct'].'\';" TYPE=button name=clone value="��� � �����">';
						}
						if( $u->info['admin'] > 0 ) {
							
							if( isset($_GET['adminbotatack']) ) {
								$bot_atack = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `id` = "'.mysql_real_escape_string($_GET['adminbotatack']).'" LIMIT 1'));
								if( isset($bot_atack['id']) ) {
									$logins_bot = array();
									$k = $u->addNewbot($bot_atack['id'],NULL,NULL,$logins_bot);
									if( isset($k['id']) ) {
										$expB = 0;
										$btl = array(
											'players'=>'',
											'timeout'=>180,
											'type'=>0,
											'invis'=>0,
											'noinc'=>0,
											'travmChance'=>0,
											'typeBattle'=>0,
											'addExp'=>$expB,
											'money'=>0
										);
	
										$ins = mysql_query('INSERT INTO `battle` (`dungeon`,`dn_id`,`x`,`y`,`city`,`time_start`,`players`,`timeout`,`type`,`invis`,`noinc`,`travmChance`,`typeBattle`,`addExp`,`money`) VALUES (
														"0",
														"0",
														"0",
														"0",
														"'.$u->info['city'].'",
														"'.time().'",
														"'.$btl['players'].'",
														"'.$btl['timeout'].'",
														"'.$btl['type'].'",
														"'.$btl['invis'].'",
														"'.$btl['noinc'].'",
														"'.$btl['travmChance'].'",
														"'.$btl['typeBattle'].'",
														"'.$btl['addExp'].'",
														"'.$btl['money'].'")');
										$btl_id = mysql_insert_id();
										mysql_query('UPDATE `users` SET `battle` = "'.$btl_id.'" WHERE `id` = "'.$k['id'].'" OR `id` = "'.$u->info['id'].'" LIMIT 2');
										mysql_query('UPDATE `stats` SET `team` = "2" WHERE `id` = "'.$k['id'].'" LIMIT 1');
										mysql_query('UPDATE `stats` SET `team` = "1" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
										header('location: main.php');
										die();	
									}
								}
							}
							
							$dv .= '<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval("location=\'main.php?zayvka=1&r=2&rnd=1&adminbotatack="+selObj.options[selObj.selectedIndex].value+"\'");
  if (restore) selObj.selectedIndex=0;
}
</script><form name="form55" id="form55">';
							
							$dv .= '<hr>��� � ��������: <span style="width: 300px; display: inline-block;"><select class="form-control" style="font-size:12px;" onChange="MM_jumpMenu(\'parent\',this,0)" name="botadminatack"><option value="0">------ �������� ������� �� ������ ------</option>';
							
							$sp_m = mysql_query('SELECT * FROM `test_bot` WHERE `pishera` != 0 ORDER BY `id` ASC');
							while($pl_m = mysql_fetch_array($sp_m) ) {
								$dv .= '<option value="'.$pl_m['id'].'">'.$pl_m['id'].' [ '.$pl_m['align'].' ] - '.$pl_m['login'].' ['.$pl_m['level'].'] '.$pl_m['pishera'].'</option>';
							}
							$dv .= '</select></span></form>';
						}
					}
					$res = '
					<FORM style="margin:0px; padding:0px; border:0px;" METHOD=\'POST\' ACTION=\'main.php?zayvka=1&r='.$r.'&rnd='.$code.'\'>
					<input type="hidden" name="add_new_zv" id="add_new_zv" value="'.floor(time()/3).'" />
					<TABLE width=100% cellspacing=0 cellpadding=0>
						  <TR>
							<TD valign=top>'.$zi[$r].'<BR>
								<table cellspacing=0 cellpadding=0>
								  <tr>
									<td><FIELDSET>
									  <LEGEND><B>������ ������ �� ���</B> </LEGEND>
									  �������
									  <span style="width: 70px; display: inline-block;">
									  <SELECT class="form-control" NAME=timeout>
										<OPTION value=1>1 ���.
										<OPTION value=2>2 ���.
										<OPTION value=3 SELECTED>3 ���.
										<OPTION value=4>4 ���.
										<OPTION value=5>5 ���.
									 </SELECT>
									 </span>
									  ��� ���
									  <span style="width: 100px; display: inline-block;">
									  <SELECT class="form-control" NAME=k>
										<OPTION value=0>� �������
										<OPTION value=1>��������
									</SELECT>
									</span>
									  '.$dv.'
									</FIELDSET></td>
								  </tr>
								</table></TD>
							<TD align=right valign=top></TD>
						  </TR>
						</TABLE>
						</FORM>';
					if($u->info['level'] > 4 && $r == 2){
						echo $res;
					}
					elseif($r==2){
						echo '<div style="padding-top: 7px;"><b>��������� ������ �� ��� �� ������� � 5 ������</b></div>';
						echo '<INPUT onClick="location=\'main.php?zayvka=1&r='.$_GET['r'].'&bot='.$u->info['nextAct'].'\';" TYPE=button name=clone value="��� � �����">';
					}
					if($u->info['level'] > 3 && $r == 3) {
						echo $res;
					}
					if( $r == 9 ) {
						echo $res;
					}
					if($r==1){
						echo '<br><INPUT onClick="location=\'main.php?zayvka=1&r='.$_GET['r'].'&bot='.$u->info['nextAct'].'\';" TYPE=button name=clone value="��� � �����">';
					}
					
				}
				}elseif($r==4)
				{
					if($u->room['zvsee']==0) {
					//���������
					/*echo '<INPUT onClick="location=\'main.php?zayvka&r='.$_GET['r'].'&new_group&rnd='.$code.'\';" TYPE=button name=tmp value="������ ������ �� ��������� ���" class="btn btn-default btn-def" style="margin:3px;">
						  <INPUT onClick="location=\'main.php?zayvka&r='.$_GET['r'].'&rnd='.$code.'&sort=\'+document.all.value+\'\';" TYPE=button name=tmp value="��������" class="btn btn-default btn-def" style="float:right;">';*/
					}
				}elseif($r==5 || $r == 10)
				{
					if($u->room['zvsee']==0) {
	                  if($u->info['level'] < 4) {
		                $mn = '<i style="color: Red;">��� �� $ ���������� � 4 ������.</i><br />';
					  } elseif($u->info['money3'] > 0) {
					    $mn = '<input type="text" name="art_money3" autocomplete="off" size="3" /><br />';
					  } else {
					    $mn = '<i style="color: Red;">� ���, ������������ ������.</i><br />';
					  }
					 /*echo '<span class="txt_haot"><!--��������� ��� - ������������� ����������, ��� ������ ����������� �������������. ��� �������� � ������, ���� ��������� ������ 4-� �������.--></span>
					<!-- ���-�� � ��������� ���� �������� ���������� <b>��������������</b> <a href="http://events.likebk.com/?page_id=1&paged=&st=25" target="_blank">���������</a>.<br> -->
						  <INPUT onclick="$(\'#haot\').toggle(\'slow\'); return false;" TYPE=button name=tmp value="������ ������ �� ��������� ���" class="btnnew" style="margin:3px; margin-top: 10px; margin-bottom: 0px;">
						  <form action="main.php?zayvka=1&r='.$_GET['r'].'&start_haot&rnd='.$code.'" method="post" style="margin:0px; padding:0px; margin-left: 15px;">
						  <div style="display:none;" id="haot">
										  <FIELDSET>
											<LEGEND><h3 class="h3_haot" style="">������ ������ �� ��������� ���</h3> </LEGEND>
											������ ���   �����
											<span style="width: 120px; display: inline-block;">
												<SELECT class="form-control" name="startime2">
												<OPTION selected value="300">5 �����
												  <OPTION value="600">10 �����
												  <OPTION value="900">15 �����
												  <OPTION value="1200">20 �����
												  <OPTION value="1800">30 �����</OPTION>
												</SELECT>
											</span>
											�������:
											<span style="width: 120px; display: inline-block;">
												<SELECT class="form-control" name="timeout">
												  <OPTION selected value="1">1 ���.
												  <OPTION value="2">2 ���.
												  <OPTION value="3">3 ���.
												  <OPTION value="4">4 ���.
												  <OPTION value="5">5 ���.</OPTION>
												</SELECT>
											</span><br>
											������ ������:   
											<span style="width: 180px; display: inline-block;">
												<SELECT class="form-control" name="levellogin1">
												  <OPTION value="0">�����
												  <OPTION selected value="3">������ �����   ������
												  <OPTION value="6">��� ������� +/- 1</OPTION>
												</SELECT>
											</span>
											��� ���:
											<span style="width: 120px; display: inline-block;">
												<SELECT class="form-control" name="k">
												  <OPTION selected value="0">� �������
												  <OPTION value="1">��������</OPTION>
												</SELECT>
											</span><br>
											<INPUT type="checkbox" name="travma">
											��� ���   ������ (����������� ������� ��������   ������������)<br>'.
											//<INPUT type="checkbox" name="mut_clever">
											//����������� ����   (����������� ���� ��� ��������� ����������)<BR>
											//<INPUT type="checkbox" name="noart">
											//�������� ��� ���������� (����������� ��������� �������� � ����� ����������)<BR>
											//<INPUT type="checkbox" name="noeff">
											//��� �������� �������� (������ �� ���. � $ �� ��������� � ���� ��������)<BR>
											'<INPUT type="checkbox" name="noatack">
											�������� �������� (� �������� ���������� ���������)<br>
											<INPUT type="checkbox" name="arand">
											������ ������ (��������� ��������� ������������� �������)<br>';
											//<INPUT type="checkbox" name="kingfight">
											//�������� �������� (<b>�� ��������� � ������� ���������</b>)<BR>
											//<INPUT type="checkbox" name="nobot">
											//�������� ��� �����<BR>
											//<INPUT type="checkbox" name="fastfight">
											//������� �������� (��� ������ �������� ��������� ������� ��� ������)<BR>
											//';
											if( $u->info['no_zv_key'] != true ) { 
												echo '<img src="http://likebk.com/show_reg_img/security2.php?id='.time().'" width="70" height="20"> ��� �������������: <input style="width:40px;" type="text" value="" name="code21">';
											}
											//echo '<INPUT type="checkbox" name="mut_hidden">
											//��������� ��� (�� �����   ����������� �� � ������, �� � ���. +5% �����)<br>
											//����������� � ���
											//<span style="width: 300px; display: inline-block;">
											//<INPUT  class="form-control" maxLength="40" size="40" name="cmt"></span><br>'.
                                            //��� �� ������, ������: '.$mn.'
											echo '<INPUT class="btnnew" style="margin-top: 5px;" value="������ ������" type="submit" name="open">
										  </FIELDSET>
										</DIV>
						  </div></form>';*/
					}
				}				
			}elseif($r==6)
			{
				//�������
				$x = 1;
				$html = '';
				$p = 0;
				$_GET['from'] = round((int)$_GET['from']);
				if($_GET['from']>1 && $_GET['from']<50)
				{
					$p = $_GET['from']-1;
				}
				$xx = mysql_num_rows(mysql_query('SELECT `id` FROM `battle` WHERE `city` = "'.$u->info['city'].'" AND `team_win` = "-1" AND `time_over` = "0" AND `start1` > 0'));
				$px = $p*15;
				if($p>ceil($xx/15))
				{
					$p = ceil($xx/15);
				}
				$sp = mysql_query('SELECT * FROM `battle` WHERE `city` = "'.$u->info['city'].'" AND `team_win` = "-1" AND `time_over` = "0" AND `start1` > 0 ORDER BY  `time_start` DESC');
				while($pl = mysql_fetch_array($sp))
				{
					$spi = mysql_query('SELECT * FROM `battle_users` WHERE `battle` = "'.$pl['id'].'" AND `team` = "1" LIMIT 100');
					$tms1 = '';
					while ($pli = mysql_fetch_array($spi)) {
						$tms1 .= $u->microLogin($pli['uid'],1).', ';
					}
					$tms1 = rtrim($tms1,', ');
					$tm = $tms1;
					$tm .= ' <SPAN style=\'color: red; font-weight: bold;\'>������</SPAN> ';
					$spi = mysql_query('SELECT * FROM `battle_users` WHERE `battle` = "'.$pl['id'].'" AND `team` = "2" LIMIT 100');
					$tms2 = '';
					while ($pli = mysql_fetch_array($spi)) {
						$tms2 .= $u->microLogin($pli['uid'],1).', ';
					}
					$tms2 = rtrim($tms2,', ');
					$tm .= $tms2;
					
					if( $tm != '' ) {
						$jbtl = $p+$x;
						$html .= ($p+$x).'. <font class=date>'.date('d.m.y H:i',$pl['time_start']).'</font> '.$tm.' <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['typeBattle'].'.gif" WIDTH=20 HEIGHT=20 ALT="���������� ���"> <A HREF="logs.php?log='.$pl['id'].'&rnd='.$code.'" target=_blank>��</A><BR>';
					}
					$x++;
				}
				?>
<table width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" align="center"><h3>������ ������� ���� �� <?=date('d.m.Y');?> (����� <span id="allfights"><?=$xx;?></span>)</h3></td>
    <td valign="top" align="right"></td>
  </tr>
</table>
<? if($html==''){ echo '<div align="center">� ��������� ������ ���� ���...</div>'; }else{ echo '<div>'.$html.'</div>'; } ?>
<TABLE width=100% cellspacing=0 cellpadding=0><TR>
<TD align=left><? if($p>0 && $xx>15){ ?><A HREF="?zayvka=1&r=6&from=<?=($p-1);?>">�� ���������� ��������</A><? } ?>&nbsp;</TD>
<TD align=right><? if($p*15-$xx>0){ ?><A HREF="?zayvka=1&r=6&from=<?=($p+1);?>">��������� �������� ��</A><? } ?>&nbsp;</TD>
</TR></TABLE>
<?
			}elseif($r==7)
			{
				//�����������
				$btl = '';
				$dt = time();
				if(isset($_GET['logs2']))
				{
					$dt = round((int)$_GET['logs2']);
				}
				$dt = strtotime(date('d F Y',$dt).' 00:00:00');
				$slogin = $u->info['login'];
				if(isset($_GET['filter']))
				{
					$slogin = $_GET['filter'];
				}
				if(isset($_POST['filter']))
				{
					$slogin = $_POST['filter'];
				}
				$slogin = str_replace('"','',$slogin);
				$slogin = str_replace("'",'',$slogin);
				$slogin = str_replace('\\','',$slogin);
				$see = '<TABLE width=100% cellspacing=0 cellpadding=0><TR>
<TD valign=top>&nbsp;<A HREF="?filter='.$slogin.'&zayvka=1&r=7&logs2='.($dt-86400).'">� ���������� ����</A></TD>
<TD valign=top align=center><H3>������ � ����������� ���� �� '.date('d.m.Y',$dt).'</H3></TD>
<TD  valign=top align=right><A HREF="?filter='.$slogin.'&zayvka=1&r=7&logs2='.($dt+86400).'">��������� ���� �</A>&nbsp;</TD>
</TR><TR><TD colspan=3 align=center>
<form method="POST" action="main.php?zayvka=1&r=7&rnd='.$code.'">
�������� ������ ��� ���������: <INPUT TYPE=text NAME=filter value="'.$slogin.'"> �� <INPUT TYPE=text NAME=logs size=12 value="'.date('d.m.Y',$dt).'"> <INPUT TYPE=submit value="������!">
</form>
</TD>
</TR></TABLE>';
				$usr = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`level`,`city` FROM `users` WHERE `login` = "'.mysql_real_escape_string($slogin).'" LIMIT 1'));
				if(isset($usr['id']))
				{
					$tms = $dt;
					$tmf = $dt+86400; 
					
					$sp = mysql_query('SELECT * FROM `battle_last` WHERE `time` >= '.$tms.' AND `time` < '.$tmf.' AND `uid` = "'.$usr['id'].'" ORDER BY `id` DESC');
					$j = 1;
					while($pl = mysql_fetch_array($sp))
					{
						$b = mysql_fetch_array(mysql_query('SELECT * FROM `battle_end` WHERE `battle_id` = "'.$pl['battle_id'].'" LIMIT 1'));
						$tm = '';
						if(isset($b['id']))
						{
							$tms = array(); $ts = array();
							$spi = mysql_query('SELECT * FROM `battle_last` WHERE `battle_id` = "'.$pl['battle_id'].'"');
							while($pli = mysql_fetch_array($spi))
							{
								if(!isset($tms[$pli['team']]))
								{
									$ts[count($ts)] = $pli['team'];
								}
								$tms[$pli['team']][count($tms[$pli['team']])] = $pli;
							}
							$k = 0;
							while($k<count($ts))
							{
								$g = $ts[$k];
								$h = 0;
								$tm2 = '';
								while($h<count($tms[$g]))
								{
									if($tms[$g][$h]['uid']>0)
									{
										if($tms[$g][$h]['align']>0)
										{
											$tm2 .= '<img src="http://img.likebk.com/i/align/align'.$tms[$g][$h]['align'].'.gif">';
										}
										$tm2 .= '<b>'.$tms[$g][$h]['login'].'</b> ['.$tms[$g][$h]['lvl'].']<a href="inf.php?'.$tms[$g][$h]['uid'].'" target="_blank" rel="tooltip" title="���. � '.$tms[$g][$h]['login'].'"><img title="���. � '.$tms[$g][$h]['login'].'" rel="tooltip" src="http://img.likebk.com/i/inf_capitalcity.gif"></a>, ';
									}
									$h++;
								}
								$tm2 = rtrim($tm2,', ');
								$btlg = mysql_fetch_array(mysql_query('SELECT `id`,`team_win` FROM `battle` WHERE `id` = "'.$pl['battle_id'].'" LIMIT 1'));
								if(isset($btlg['id']) && $g == $btlg['team_win']) {
									$tm2 = ' <img width="20" height="20" src="http://img.likebk.com/i/flag.gif" title="������"> '.$tm2;
								}
								$tm .= $tm2;
								if($k+1<count($ts) && $tm2!='' && $ts[$k+1]>0)
								{
									$tm .= ' <font color=red><b>������</b></font> ';
								}
								$k++;
							}
						}
						if($tm == '')
						{
							$tm = '������ �������� ��������';	
						}
						$btl .= $j.'. <font class=date>'.date('d.m.y H:i',$pl['time']).'</font> '.$tm.' <A HREF="logs.php?log='.$pl['battle_id'].'&rnd='.$code.'" target=_blank>��</A><br>';
						$j++;
					}
					
					$tms = $dt;
					$tmf = $dt+86400; 
					
					$sp = mysql_query('SELECT * FROM `battle_static` WHERE `uids` LIKE "%['.$usr['id'].':%" AND `time_start` >= '.$tms.' AND `time_start` < '.$tmf.' ORDER BY `time_start` DESC');
					while( $pl = mysql_fetch_array($sp) ) {
						//
						if( $pl['teams'] != '' ) {
							$pl['teams'] = str_replace(' {������} ',' &nbsp; <font color=red><b>������</b></font> &nbsp; ',$pl['teams']);
							$pl['teams'] = str_replace('{win}',' <img src=http://img.likebk.com/i/flag.gif /> ',$pl['teams']);
						}
						//
						$tm = $pl['teams'];
						//
						if($tm == '') {
							$tm = '&lt; <i>������ �������� ���� ��������! �������� ��� ���.</i> &gt;';	
						}
						$btl .= $j.'. <font class=date>'.date('d.m.y H:i',$pl['time_start']).'</font> '.$tm.' <A HREF="logs.php?log='.$pl['battle'].'" target=_blank>��</A><br>';
						$j++;
					}
					
					//
					
				}
				
				if($btl=='')
				{
					$see .= '<CENTER><BR><BR><B>� ���� ���� �� ���� ����, ��� ��, ��������� ����� ������� ������...</B><BR><BR><BR></CENTER><HR><BR>';
				}else{
					$see .= $btl;
				}
				
				echo $see;
			}else{
				if((!isset($_GET['new_group']) && !isset($_POST['groupClick'])) || isset($zi['id']))
				{
					echo '<BR><BR><CENTER><B>�������� ������</B></CENTER>';
				}
			}
		}else{
			if((!isset($_GET['new_group']) && !isset($_POST['groupClick'])) || isset($zi['id']))
			{
				echo '<BR><BR><CENTER><B>�������� ������</B></CENTER>';
			}
		}
		/*echo '<script>$("#allfights").html("'.$jbtl.'");</script>';*/
	}
	
	public function rzv($v)
	{
		$v = explode('.',$v);
		if(!isset($v[1]))
		{
			$v = $v[0].'.0';
		}else{
			$v = $v[0].'.'.$v[1];
		}
		return $v;
	}
	
	public function rzInfo($id)
	{
		global $u;
		$r = '';
		$w = mysql_num_rows(mysql_query('SELECT * FROM `zayvki` WHERE `time` > '.(time()-7200).' AND `city` = "'.$u->info['city'].'" AND `cancel` = "0" AND `start` = "0" AND `razdel` = "'.$id.'" AND (`min_lvl_1` <= '.$u->info['level'].' OR `min_lvl_2` <= '.$u->info['level'].') AND (`max_lvl_1` >= '.$u->info['level'].' OR `max_lvl_2` >= '.$u->info['level'].')'));
		if($w>0)
		{
			$r = ' <small><font color="grey">('.$w.')</font></small>';
		}
		return $r;
	}
	
	public function testzvu($id,$tm,$bt)
	{
		$r = 0;
		if($bt==0)
		{
			$r = mysql_num_rows(mysql_query('SELECT `id` FROM `stats` WHERE `zv` = "'.$id.'" AND `team` = "'.$tm.'"'));
		}else{
			$r = mysql_num_rows(mysql_query('SELECT `id` FROM `stats` WHERE `zv` = "'.$id.'" AND `team` = "'.$tm.'" AND `bot` = "2"'));
		}
		return $r;
	}
	
	public function seeZv()
	{
		global $u,$c,$code,$zi;
		if(isset($_GET['r']) && $this->zv_see==1)
		{
			$r = round(intval($_GET['r']));
			if(($r>=1 && $r<=5) || $r == 9 || $r == 10)
			{
				//������ ������
				$i = 0;
				$cl = mysql_query('SELECT * FROM `zayvki` WHERE `razdel` = "'.mysql_real_escape_string($r).'" AND `start` = "0" AND `cancel` = "0" AND `time` > "'.(time()-60*60*2).'" AND `city` = "'.$u->info['city'].'" ORDER BY `id` DESC');
				$zvb = '';
				if($r==4 || $r==5)
				{
						/*echo '<table cellspacing="0" cellpadding="0" align="right"><tr><td>
						<FIELDSET><LEGEND>���������� ������</LEGEND>
						&nbsp;<INPUT TYPE=radio ID=A1 name="all" value=0 checked> <LABEL FOR=A1>����� ������</LABEL><BR>
						&nbsp;<INPUT TYPE=radio ID=A2 name="all" value=1> <LABEL FOR=A2>���</LABEL>
						</FIELDSET>
						</td></tr></table><br>';*/
				}
				while($pl = mysql_fetch_array($cl))
				{
					if($pl['razdel']==5 || $pl['razdel']==10)
					{
						//������ ���������� ���
						$tm = '';
						$tmStart = floor(($pl['time']+$pl['time_start']-time())/6)/10;
						//if( $u->info['admin'] > 0 ) {
							if((($pl['time']+$pl['time_start'])/10) != (int)(($pl['time']+$pl['time_start'])/10)) {
								$pl['time'] = ceil($pl['time']/60)*60;
								mysql_query('UPDATE `zayvki` SET `time` = "'.$pl['time'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
							}
						//}
						$tmStart = $this->rzv($tmStart);
						if($tmStart == "-0.1"){
							$tmStart = "0.0";
						}
						
						$users = mysql_query('SELECT `u`.`id`,`u`.`login`,`u`.`level`,`u`.`align`,`u`.`clan`,`u`.`admin`,`st`.`team` FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON `u`.`id` = `st`.`id` WHERE `st`.`zv` = "'.$pl['id'].'"');
						$col_p = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `zv` = "'.$pl['id'].'"'));
						$cols = $col_p[0];
						while($s = mysql_fetch_array($users))
						{
							$tm .= $u->microLogin($s['id'],1).', ';
						}
						
						$rad = '';
						
						$tm = rtrim($tm,', ');
						
						if(!isset($zi['id']) && $u->room['zvsee'] == 0 && $u->info['inTurnirnew'] == 0) {
							$rad = '<input type="radio" name="btl_go" id="btl_go'.$pl['id'].'" value="'.$pl['id'].'"> ';
						}
						
						$n1tv = '';
						$unvs = '';
						if($pl['invise']==0)
						{
							//��������� ���
							//$tm = '<i>���������</i>';
							$unvs = 0;
							//if($u->info['admin'] > 0 || ($u->info['align'] > 1 && $u->info['align'] < 2) || ($u->info['align'] > 3 && $u->info['align'] < 4) ) {
								$usrszv = '';
								//if( $u->info['admin'] > 0 ) {
									$spzm = mysql_query('SELECT `id`,`team` FROM `stats` WHERE `zv` = "'.$pl['id'].'" AND `id` != "'.$pl['creator'].'"');
									while( $plzm = mysql_fetch_array($spzm) ) {
										$usrszv .= ','.$u->microLogin($plzm['id'],1).'';
										$unvs++;
									}
								//}
								$tm = $u->microLogin($pl['creator'],1).$usrszv;
							//}
							if($pl['creator'] == 0){
								$unvs = ''.($unvs);
							}
							else{
								$unvs = ''.(1+$unvs);	
							}
							//$unvs = ''.(1+$unvs).' ���. ';
							//$n1tv = ' <img src="http://img.likebk.com/i/fighttypehidden0.gif" title="���������">';
						}
						//
						if( $pl['kingfight'] == 1 ) {
							$n1tv .= ' <img src="http://img.likebk.com/king.gif" rel="tooltip" title="�������� ��������">';
						}
						if( $pl['noart'] == 1 ) {
							$n1tv .= ' <img src="http://img.likebk.com/noart2.gif" rel="tooltip" title="��� ��� ����������">';
						}
						if( $pl['noeff'] == 1 ) {
							$n1tv .= ' <img src="http://img.likebk.com/noeff3.gif" rel="tooltip" title="��������� ������������� ������� ������� HP, ������������ � �������������� MP">';
						}
						if( $pl['noatack'] == 1 ) {
							$n1tv .= ' <img src="http://img.likebk.com/closefight3.gif" rel="tooltip" title="� ��� ������ ���������">';
						}
						if( $pl['nobot'] == 1 ) {
							$n1tv .= ' <img src="http://img.likebk.com/nobot.gif" rel="tooltip" title="� ��� �� �������� ����">';
						}
						if( $pl['fastfight'] == 1 ) {
							$n1tv .= ' <img src="http://img.likebk.com/fastfight.gif" rel="tooltip" title="��� ������ ��� ���������� ������� 2 ������">';
						}
						if( $pl['arand'] == 1 ) {
							$n1tv .= ' <img src="http://img.likebk.com/arand.gif" rel="tooltip" title="������ ����������� ��������� ��������� �������">';
						}
						if( $pl['otmorozok'] == 1 ) {
							$n1tv .= ' <img src="http://img.likebk.com/snow.gif" width="20" height="20" title="� ��� ����� ��������� ���������">';
						}
						if( $pl['priz'] == 1 ) {
							$n1tv .= ' <font color="red">(<b>�������� ����</b>)</font>';
						}
						//
						/*if($pl['comment'] != '') {
						  $dl = '';
						  if(($moder['boi'] == 1 || $u->info['admin'] > 0) && $pl['dcom']==0) {
						    $dl .= ' (<a href="main.php?zayvka=1&r=5&delcom='.$pl['id'].'&key='.$u->info['nextAct'].'&rnd='.$code.'">������� �����������</a>)';          if(isset($_GET['delcom']) && $_GET['delcom'] == $pl['id'] && $u->newAct($_GET['key']) == true) {
				              mysql_query('UPDATE `zayvki` SET `dcom` = "'.$u->info['id'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				              $pl['dcom'] = $u->info['id'];
			                }
						  }
						  if($pl['dcom'] > 0) { $dl = '<font color="grey"><i>����������� ������ �����������</i></font>'; }
						  if($pl['dcom'] > 0) {
							if($moder['boi'] == 1 || $u->info['admin'] > 0) {
				              $pl['comment'] = '[ ����� ����������� : <font color="red">'.$pl['comment'].'</font>]&nbsp;';
			                } else {
				              $pl['comment'] = '';
			                 }
		                   }
						$zv_comm = '('.$pl['comment'].''.$dl.')';
						} else {
						  $zv_comm = '';
						}*/
						$zv_comm = '';
                        if($pl['money3'] > 0) { $mon = ' ��� �� ������, ������: <b>'.$pl['money3'].'</b>$ '; } else { $mon = ''; }
						if(($r == 5 || $r == 10) && ($pl['creator'] == $u->info['id']) && $cols < 2) {
						  $del_q = '&nbsp;&nbsp;<a href="main.php?zayvka=1&r=5&del_z_time='.$pl['id'].'&rnd='.$code.'"><img src="http://img.likebk.com/i/clear.gif" rel="tooltip" title="������� ������" /></a>';
						} else {
						  $del_q = '';
						}

					$zvb .= '<div style="margin-bottom: 5px;">';
						
						if($pl['type'] == 0){
							$typeboi = "���������� ���";
						}elseif($pl['type'] == 99){
							$typeboi = "�������� ���";
						}
						else{
							$typeboi = "�������� ���";
						}

						if( $tmStart > 0 ) {
							$tmStart .= ' ���.';
						}else{
							$tmStart = ' <i>����� 10 ���.</i>';
						}

						if($_COOKIE["mylvl_cookie"] == 1){
							if($u->info['level'] >= $pl['min_lvl_1'] && $u->info['level'] <= $pl['max_lvl_1']){
								//���������� ��� ����������
								if($pl['noart'] == 1 ){		
									if($pl['creator'] == 0 ){	
										if($tm == ''){		
											$zvb .= '<strong>'.$rad.'<font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <strong>(����������)</strong><i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.'</strong></span>)<br></i>';
										}
										else{
											$zvb .= '<strong>'.$rad.'<font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <strong>(����������)</strong><i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.'</strong></span>) </i> ���������: <span style="color:maroon">'.$tm.'</span><br>';	
										}
									}else{
										$zvb .= '<strong>'.$rad.'<font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.'</strong></span>) </i>���������: <span style="color:maroon">'.$tm.'</span> '.$del_q.'<br>';
									}
								}
								//������ ������
								if(($pl['min_lvl_1'] == $pl['max_lvl_1']) && $pl['noart'] == 0){
									$zvb .= '<strong>'.$rad.'<font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.'</strong></span>) </i>���������: <span style="color:maroon">'.$tm.'</span> '.$del_q.'<br>';
								}
								elseif($pl['noart'] == 0){
									$zvb .= '<strong>'.$rad.'<font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.'</strong></span>) </i>���������: <span style="color:maroon">'.$tm.'</span> '.$del_q.'<br>';
								}
							}
						}
						else{
							//���������� ��� ����������
							if($pl['noart'] == 1 ){		
								if($pl['creator'] == 0 ){			
									if($tm == ''){		
										$zvb .= '<strong>'.$rad.'<font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <strong>(����������)</strong><i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.'</strong></span>)<br></i>';
									}
									else{
										$zvb .= '<strong>'.$rad.'<font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <strong>(����������)</strong><i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.'</strong></span>) </i> ���������: <span style="color:maroon">'.$tm.'</span><br>';	
									}
								}else{
									$zvb .= '<strong>'.$rad.'<font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.' ���.</strong></span>) </i>���������: <span style="color:maroon">'.$tm.'</span> '.$del_q.'<br>';
								}
							}
							//������ ������
							if(($pl['min_lvl_1'] == $pl['max_lvl_1']) && $pl['noart'] == 0){
								$zvb .= '<strong>'.$rad.'<font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.'</strong></span>) </i>���������: <span style="color:maroon">'.$tm.'</span> '.$del_q.'<br>';
							}
							elseif($pl['noart'] == 0){
								$zvb .= '<strong>'.$rad.'<font class="date">'.date('H:i',$pl['time']).'</font></strong> <i><span style="color: #23527c"><strong>('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].' ��. '.$unvs.'/'.$pl['usermax'].' ���.)</strong></span></i> ��� ���: <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'">'.$n1tv.' (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.'.$zv_comm.'</strong></span>) <i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.'</strong></span>) </i>���������: <span style="color:maroon">'.$tm.'</span> '.$del_q.'<br>';
							}
						}

						

					$zvb .= '</div>';
					}elseif($pl['razdel']==4)
					{
						//������ ���������� ���
						$tm1 = '';
						$tm2 = '';
						$tmStart = floor(($pl['time']+$pl['time_start']-time())/6)/10;
						$tmStart = $this->rzv($tmStart);
						
						//�������� � ������, ���������� ��� ����������
						//���� �������� ��� ���������
						$xx2 = $this->testzvu($pl['id'],2,0);
						if($pl['bot2']>0 && $xx2 < $pl['tm2max'])
						{
							//��������� ����� �� ������ �������
							$spb = mysql_query('SELECT `u`.*,`st`.* FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON `u`.`id` = `st`.`id` WHERE `st`.`bot` = 3 AND `u`.`level` = "'.$pl['min_lvl_2'].'" AND `u`.`battle` = 0 AND `st`.`zv` = 0 LIMIT 100');
							$logins_bot = array();
							while($plb = mysql_fetch_array($spb))
							{
								if($xx2 < $pl['tm2max'] && rand(0,10000)<5000 && rand(0,10000)>5000)
								{
									$bt = $u->addNewbot(0,'',$plb['id']);
									$logins_bot = $bt['logins_bot'];
									if($bt>0)
									{
										mysql_query('UPDATE `stats` SET `zv` = "'.$pl['id'].'",`team` = "2" WHERE `id` = "'.$bt.'" LIMIT 1');
										$xx2++;
									}
								}
							}
							unset($plb,$spb,$logins_bot,$bt);
						}
						unset($xx2);						
						
						//���������� �������
						$users = mysql_query('SELECT `u`.`id`,`u`.`login`,`u`.`level`,`u`.`align`,`u`.`clan`,`u`.`admin`,`st`.`team` FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON `u`.`id` = `st`.`id` WHERE `st`.`zv` = "'.$pl['id'].'"');
						while($s = mysql_fetch_array($users))
						{
							${'tm'.$s['team']} .= $u->microLogin($s['id'],1).', ';
						}					
						
						if($tm1=='')
						{
							$tm1 = '������ ���� �� �������';
						}else{
							$tm1 = rtrim($tm1,', ');
						}
						
						if($tm2=='')
						{
							$tm2 = '������ ���� �� �������';
						}else{
							$tm2 = rtrim($tm2,', ');
						}
						$rad = '';
						if(!isset($zi['id']) && $u->room['zvsee']==0)
						{
							$rad = '<input type="radio" name="groupClick" id="groupClick" value="'.$pl['id'].'"> ';
						}
                        if($pl['money3'] > 0) { $mon = ' ��� �� ������, ������: <b>'.$pl['money3'].'</b>$ '; } else { $mon = ''; }
						if($r == 4 && ($pl['creator'] == $u->info['id']) && $cols < 2) {
						  $del_q = '&nbsp;&nbsp;<a href="main.php?zayvka=1&r=4&del_z_time='.$pl['id'].'&rnd='.$code.'"><img src="http://img.likebk.com/i/clear.gif" rel="tooltip" title="������� ������" /></a>';
						} else {
						  $del_q = '';
						}
						/*if($pl['comment']!=''){
						$dl = '';
						  if(($moder['boi'] == 1 || $u->info['admin'] > 0) && $pl['dcom']==0) {
						    $dl .= ' (<a href="main.php?zayvka=1&r=4&delcom='.$pl['id'].'&key='.$u->info['nextAct'].'&rnd='.$code.'">������� �����������</a>)';          if(isset($_GET['delcom']) && $_GET['delcom'] == $pl['id'] && $u->newAct($_GET['key']) == true) {
				              mysql_query('UPDATE `zayvki` SET `dcom` = "'.$u->info['id'].'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				              $pl['dcom'] = $u->info['id'];
			                }
						  }
						  if($pl['dcom'] > 0) { $dl = '<font color="grey"><i>����������� ������ �����������</i></font>'; }
						  if($pl['dcom'] > 0) {
							if($moder['boi'] == 1 || $u->info['admin'] > 0) {
				              $pl['comment'] = '[ ����� ����������� : <font color="red">'.$pl['comment'].'</font>]&nbsp;';
			                } else {
				              $pl['comment'] = '';
			                 }
		                   }

						$zv_comm = '('.$pl['comment'].''.$dl.')';
						}else{$zv_comm='';}*/
						$zv_comm = '';
						if($pl['type'] == 0){
							$typeboi = "���������� ���";
						}elseif($pl['type'] == 99){
							$typeboi = "�������� ���";
						}
						else{
							$typeboi = "�������� ���";
						}
						$zvb .= '<div style="margin-bottom: 5px;">';
						//$zvb .= ''.$rad.'<font class="date">'.date('H:i',$pl['time']).'</font> <B>'.$pl['tm1max'].' (</b>'.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].'<b>) �� '.$pl['tm2max'].' (</b>'.$pl['min_lvl_2'].'-'.$pl['max_lvl_2'].'<b>)</B> ('.$tm1.') <font class="dsc"><i><span style=\'color:red; font-weight:bold;\'>������</span></font></i> ('.$tm2.') <IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="��������� ���"> <font class="dsc"><i>��� �������� ����� <B>'.$tmStart.'</B> ���., ������� '.($pl['timeout']/60).' ���. '.$zv_comm.'</font></i>'.$mon.'<BR>';
						$zvb .= ''.$rad.'<font class="date">'.date('H:i',$pl['time']).'</font> <i><span style="color: #23527c"><b>('.$pl['min_lvl_1'].'-'.$pl['max_lvl_1'].' ��. '.$pl['tm1max'].' ���.)</b></span> �� <span style="color: #23527c"><b>('.$pl['min_lvl_2'].'-'.$pl['max_lvl_2'].' ��. '.$pl['tm2max'].' ���.)</b></span> (�������: <span style="color: #23527c"><strong>'.($pl['timeout']/60).' ���.</strong></span>) '.$zv_comm.'<strong>��� ���: </strong><IMG SRC="http://img.likebk.com/i/fighttype'.$pl['type'].'.gif" WIDTH="20" HEIGHT="20" rel="tooltip" title="'.$typeboi.'"> <font class="dsc"><i>(��� �������� ����� <span style="color: #23527c"><strong>'.$tmStart.' ���.</strong></span>)</font></i> <span style="color:maroon">('.$tm1.' <font class="dsc"><i><span style=\'color:red; font-weight:bold;\'>������</span></font></i> '.$tm2.')</span>'.$del_q.'<BR>';
						$zvb .= '</div>';
					}elseif(($pl['razdel']>=1 && $pl['razdel']<=3) || $pl['razdel'] == 9)
					{
						$uz = mysql_fetch_array(mysql_query('SELECT `u`.`banned`,`u`.`id`,`u`.`login`,`u`.`align`,`u`.`clan`,`u`.`admin`,`u`.`city`,`u`.`room`,`u`.`online`,`u`.`level`,`u`.`battle`,`u`.`money`,`st`.* FROM `stats` AS `st` LEFT JOIN `users` AS `u` ON (`st`.`id` = `u`.`id`) WHERE `st`.`zv`="'.$pl['id'].'" AND `st`.`team`="1" LIMIT 1'));
						if(isset($uz['id']))
						{
							$uze = mysql_fetch_array(mysql_query('SELECT `u`.*,`st`.* FROM `stats` AS `st` LEFT JOIN `users` AS `u` ON (`st`.`id` = `u`.`id`) WHERE `st`.`zv`="'.$pl['id'].'" AND `st`.`team` = "2" LIMIT 1'));
							$d1 = '';
							if($uz['id']==$u->info['id'] || $uze['id']==$u->info['id'])
							{
								$d1 = 'disabled="disabled"';
							}
							if($uz['clan'] == $u->info['clan'] && $u->info['clan'] != 0 && $pl['razdel'] != 3 && $pl['razdel'] != 9) { $d1 = 'disabled="disabled"'; }
							if(!isset($uze['id']) || $u->info['zv'] == $pl['id'])
							{
								$enm = '';
								
								if(isset($uze['id']))
								{									
									$enm = ' ������ '.$u->microLogin($uze['id'],1).'';
								}
								if($uz['banned']>0)
								{
									$pl['id'] = 0;
									$d1 = 'disabled="disabled"';
									$zvb .= '<span style="text-decoration:line-through;">';
								}
								$dp1 = '';
								if($pl['money']>0)
								{
									$dp1 = ' ��� �� ������, ������: <b>'.$u->round2($pl['money']).' ��.</b>';
								}
                                if($pl['money3'] > 0) { $mon = ' ��� �� ������, ������: <b>'.$pl['money3'].'$</b> '; } else { $mon = ''; }
								if($u->room['zvsee'] == 0) {
									$zvb .= '<input name="btl_go" '.$d1.' type="radio" value="'.$pl['id'].'" />';
								}
								$zvb .= '<font class="date">'.date('H:i',$pl['time']).'</font> '.$u->microLogin($uz['id'],1).' '.$enm.'  ��� ���: <img src="http://img.likebk.com/i/fighttype'.($pl['type']).'.gif"> (������� '.round($pl['timeout']/60).' ���.'.$dp1.' '.$mon.')<br>';
								if($uz['banned']>0) { $zvb .= '</span>'; }
							}
						}
					}
					$i++;
				}
				if($i==0)
				{
					//������ ���
					if($u->room['zvsee'] > 0) {
						echo '<br><br><br><div align="center"><b>� ������ ������� ��� �� ����� ������</b></div>';
					}
				}else{
					if(!isset($zi['id']) && $u->room['zvsee']==0)
					{
						if($_GET['r'] == 5 || $_GET['r'] == 10) {
							echo "<hr style='margin-top: 15px;margin-bottom: 15px; padding-bottom: 0px;'>";
							if( $u->info['no_zv_key'] != true ) { 
								echo '<div style="float:left;"><form method="post" style="margin:0px;padding:0px;" action="main.php?zayvka=1&r='.$r.'&rnd='.$code.'"><img src="http://likebk.com/show_reg_img/security2.php?id='.time().'" width="70" height="20"> ��� �������������: <input style="width:40px;" type="text" value="" name="code21">'.$zvb.' <img src="http://likebk.com/show_reg_img/security2.php?id='.time().'" width="70" height="20"> ��� �������������: <input style="width:40px;" type="text" value="" name="code22"><br> <input onclick="haotgo(event);" class="btnnew" style="margin-top:1px;" type="submit" value="������� ������� � ���������" /><input type="hidden" name="gox" id="gox" value="0"><input type="hidden" name="goy" id="goy" value="0"></form></div>';
							}else{
								echo '<div style="float:left;"><form method="post" style="margin:0px;padding:0px;" action="main.php?zayvka=1&r='.$r.'&rnd='.$code.'">'.$zvb.'<br> <input onclick="haotgo(event);" class="btnnew" style="margin-top:1px;" type="submit" value="������� ������� � ���������" /><input type="hidden" name="gox" id="gox" value="0"><input type="hidden" name="goy" id="goy" value="0"></form></div>';
							}
						}else{
							echo "<hr style='margin-top: 15px;margin-bottom: 15px; padding-bottom: 0px;'>";
							if( $zvb != '' ) {
								echo '<div style="float:left;"><form method="post" style="margin:0px;padding:0px;" action="main.php?zayvka=1&r='.$r.'&rnd='.$code.'">'.$zvb.'<input class="btnnew" style=" bold; margin-top:10px;" type="submit" value="������� �����" /></form></div>';
							}
						}
					}else{
						echo "<hr style='margin-top: 15px;margin-bottom: 15px; padding-bottom: 0px;'>";
						echo $zvb;
					}
				}
			}
		}
	}
	
	public function go($id)
	{
		global $u,$c,$code,$zi,$filter;
		if(!isset($zi['id']))
		{
			if($u->info['battle']==0 && $u->info['inTurnirnew']==0)
			{
				$z = mysql_fetch_array(mysql_query('SELECT * FROM `zayvki` WHERE `id`="'.mysql_real_escape_string(intval($id)).'" AND `city` = "'.$u->info['city'].'" AND `start` = "0" AND `cancel` = "0" AND `time` > "'.(time()-60*60*2).'" LIMIT 1'));
				//$itm = mysql_fetch_array(mysql_query('SELECT `im`.*,`iu`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE `iu`.`uid` = "'.$u->info['id'].'" AND `iu`.`inShop`="0" AND `iu`.`delete`="0" LIMIT 1'));
				$travm = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid`="'.$u->info['id'].'" AND `id_eff`=4 AND (`v1` = 2 OR `v1` = 3) AND `delete`=0 '));
				if($u->info['inTurnirnew'] > 0) {
					$this->error = '�� �� ������ ���������, �� ���������� � �������!';
				}elseif(isset($travm['id'])){
					$this->error = '�� �� ������ ���������, � ��� ������, �������� ��';
				}else{
					if(isset($z['id']))
					{
						if(($z['razdel']>=1 && $z['razdel']<=3) || $z['razdel'] == 9)
						{
							//�������, ����, ����������
							$uz1 = mysql_fetch_array(mysql_query('SELECT `u`.`id`,`u`.`login`,`u`.`align`,`u`.`clan`,`u`.`admin`,`u`.`city`,`u`.`room`,`u`.`online`,`u`.`level`,`u`.`battle`,`u`.`money`,`st`.* FROM `stats` AS `st` LEFT JOIN `users` AS `u` ON (`st`.`id` = `u`.`id`) WHERE `st`.`zv`="'.$z['id'].'" AND `st`.`team`="1" LIMIT 1'));
							if(isset($uz1['id']))
							{
								$uz2 = mysql_fetch_array(mysql_query('SELECT `u`.`id`,`u`.`login`,`u`.`align`,`u`.`clan`,`u`.`admin`,`u`.`city`,`u`.`room`,`u`.`online`,`u`.`level`,`u`.`battle`,`u`.`money`,`st`.* FROM `stats` AS `st` LEFT JOIN `users` AS `u` ON (`st`.`id` = `u`.`id`) WHERE `st`.`zv`="'.$z['id'].'" AND `st`.`team`="2" LIMIT 1'));
								if($u->info['hpNow']<$u->stats['hpAll']/100*30 && ($z['razdel']>=1 || $z['razdel']<=3)) {
									$this->error = '�� ��� ������� ��������� ����� ������ ����� ���';
									$az = 0;
								} elseif($uz1['clan']==$u->info['clan'] && $u->info['clan']!=0 && $u->info['admin'] == 0) {
									$this->error = '�� �� ������ ��������� ������ ��������';
								} elseif(($z['money'] > 0 || $z['money3'] > 0) && $u->info['level'] < 4) {
									$this->error = '��� �� ������ ���������� � 4-�� ������';
								} elseif($z['withUser']!='' && $filter->mystr($u->info['login'])!=$filter->mystr($z['withUser']) && $z['razdel']==3) {
									$this->error = '�� �� ������ ������� ��� ������';
								} elseif($z['money'] > 0 && $z['money'] > $u->info['money']) {
									$this->error = '� ��� ������������ �����, ����� ������� ��� ������';
								} elseif($z['money3'] > 0 && $z['money3'] > $u->info['money3']) {
									$this->error = '� ��� ������������ �����, ����� ������� ��� ������';
								}elseif($u->stats['hpNow']<ceil($u->stats['hpAll']/100*34))
								{
									$this->error = '�� ������� ���������, ��������������';
								}elseif(!isset($uz2['id']))
								{
									$upd = mysql_query('UPDATE `stats` SET `zv` = "'.$z['id'].'",`team` = "2" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
									if($upd)
									{
										$ca = '';
										if($uz1['clan']!=0)
										{
											$pc = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id`="'.$uz1['clan'].'" LIMIT 1'));
											if(isset($pc['id']))
											{
												$pc['img'] = $pc['name_mini'].'.gif';
												$ca = '<img rel="tooltip" title="'.$pc['name'].'" src="http://img.likebk.com/i/clan/'.$pc['name_mini'].'.gif">';
											}
										}
										if($uz1['align']!=0)
										{
											$ca = '<img src="http://img.likebk.com/i/align/align'.$uz1['align'].'.gif">'.$ca;
										}
										$this->error = '������� ������������� ��� �� '.$ca.' '.$uz1['login'].' ['.$uz1['level'].']<a href="inf.php?'.$uz1['id'].'" target="_blank"><img src="http://img.likebk.com/i/inf_capitalcity.gif" rel="tooltip" title="���. � '.$uz1['login'].'"></a>';
										$sa = '';
										if($u->info['sex']==2)
										{
											$sa = '�';
										}
										$text = ' [login:'.$u->info['login'].'] ������'.$sa.' ���� ������ �� ���.[reflesh_main_zv_priem:'.$u->info['id'].']';
										mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$uz1['city']."','','','".$uz1['login']."','".$text."','".time()."','6','0')");
										$zi = $z;
										$u->info['zv'] = $z['id'];
										$u->info['team'] = 2;
									}else{
										$this->error = '���������� ������� ������.';
									}
								}else{
									$this->error = '������ ��� ���-�� ������ �� ���.';
								}
							}else{
								$this->error = '������ �� ��� �������������.';
							}
						}elseif($z['razdel']==4 && $u->info['level']>1)
						{
							$tm = 0;
							//���������
							if(isset($_GET['tm1']))
							{
								$tm = 1;
							}elseif(isset($_GET['tm2']))
							{
								$tm = 2;
							}else{
								$this->error = '���-�� ����� �� ���';	
							}
							
							if($tm!=0)
							{
								$t1 = $tm;
								$t2 = 1;
								$tmmax = 0;
								if($tm==1){ $t2 = 2; }
								$cl111 = mysql_query('SELECT `u`.`clan`,`st`.`team`,`st`.`id`,`st`.`zv` FROM `stats` AS `st` LEFT JOIN `users` AS `u` ON (`st`.`id` = `u`.`id`) WHERE `st`.`zv` = "'.$z['id'].'" LIMIT 200');
								$cln = 0;
								while($pc111 = mysql_fetch_array($cl111))
								{
									if($pc111['clan']==$u->info['clan'] && $u->info['clan']!=0 && $pc111['team']==$t2)
									{
										$cln++;
									}
									if($pc111['team']==$t1)
									{
										$tmmax++;
									}
								}
								if($cln>0)
								{
									$this->error = '�� �� ������ ��������� ������ ��������';
								}elseif($z['bot2']==1 && $t1==2) {
									$this->error = '�� �� ������ ��������� �� ������� �����';
								} elseif($z['money3'] > 0 && $z['money3'] > $u->info['money3']) {
									$this->error = '� ��� ������������ �����, ����� ������� ��� ������';
								} elseif(($z['money'] > 0 || $z['money3'] > 0) && $u->info['level'] < 4) {
									$this->error = '��� �� ������ ���������� � 4-�� ������';
								}elseif($z['tm'.$t1.'max']>$tmmax)
								{
									if($z['min_lvl_'.$t1]>$u->info['level'] || $z['max_lvl_'.$t1]<$u->info['level'])
									{
										$this->error = '�� �� ��������� �� ������, �� ��� ������� ����� ����� ��������� '.$z['min_lvl_'.$t1].' - '.$z['max_lvl_'.$t1].' ������';
									}elseif($u->stats['hpNow']<ceil($u->stats['hpAll']/100*67))
									{
										$this->error = '�� ������� ���������, ��������������';
									}else{
										$upd = mysql_query('UPDATE `stats` SET `zv` = "'.$z['id'].'",`team` = "'.mysql_real_escape_string((int)$t1).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
										if(!$upd)
										{

											$this->error = '������ ������ ������...';
										}else{
											$this->error = '<span style="padding-left: 15px;">�� ������� ��������� ���...</span>';
											$zi = $z;
											$u->info['zv'] = $z['id'];
											$u->info['team'] = mysql_real_escape_string((int)$t1);
										}
									}
								}else{
									$this->error = '������ ��� ������� ('.($z['tm'.$t1.'max']-$tmmax).')';
								}
							}
						}elseif(($z['razdel']==5 || $z['razdel']==10) && $u->info['level']>1)
						{
							mysql_query('INSERT INTO `bot_trap` (`uid`,`time`,`x`,`y`,`room`,`data`) VALUES ("'.$u->info['id'].'","'.time().'","'.mysql_real_escape_string($_POST['gox']).'","'.mysql_real_escape_string($_POST['goy']).'","'.$u->info['room'].'","'.mysql_real_escape_string($_SERVER['HTTP_USER_AGENT']).'")');
							$countZv = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `zv` = "'.$z['id'].'" LIMIT 100'));
							//���������
							if( $u->info['no_zv_key'] != true && (!isset($_SESSION['code2']) || $_SESSION['code2'] < 1 || ($_POST['code21'] != $_SESSION['code2'] && $_POST['code22'] != $_SESSION['code2'])) )
							{
								$this->error = '������������ ��� �������������';
							}elseif($z['min_lvl_1']>$u->info['level'] || $z['max_lvl_1']<$u->info['level'])
							{
								$this->error = '�� �� ��������� �� ������, �� ��� ������� ����� ����� ��������� '.$z['min_lvl_1'].' - '.$z['max_lvl_1'].' ������';
							}elseif($u->stats['hpNow'] < ceil($u->stats['hpAll']/100*67)) {
								$this->error = '�� ������� ���������, ��������������';
							} elseif(($z['money'] > 0 || $z['money3'] > 0) && $u->info['level'] < 4) {
							  $this->error = '��� �� ������ ���������� � 4-�� ������';
							} elseif($z['money3'] > 0 && $z['money3'] > $u->info['money3']) {
							  $this->error = '� ��� ������������ �����, ����� ������� ��� ������';
							}elseif($countZv[0] < $z['usermax']){
								$t1 = 1;
								
								/* ������� ������ */
								if($z['tm1']>$z['tm2'])
								{
									$t1 = 2;
								}elseif($z['tm1']<$z['tm2'])
								{
									$t1 = 1;
								}else{
									$t1 = rand(1,2);
								}
								
								if($z['invise']==1)
								{
									$nxtID = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `zv` = "'.$z['id'].'"'));
									$nxtID = $nxtID[0];
									//$u->info['login2'] = '���� ('.($nxtID+1).')';
									$u->info['login2'] = '';
								}else{
									$u->info['login2'] = '';
								}
								
								$blnc = 100*$u->info['level']+$u->stats['reting'];
						
								$z['tm'.$t1] += $blnc;
								if($z['noart'] == 0){
									$upd = mysql_query('UPDATE `stats` SET `zv` = "'.$z['id'].'",`team` = "'.$t1.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
									if(!$upd)
									{
										$this->error = '������ ������ ������...';
									}else{
										mysql_query('UPDATE `users` SET `login2` = "'.$u->info['login2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
										mysql_query('UPDATE `zayvki` SET `tm1` = "'.$z['tm1'].'", `tm2` = "'.$z['tm2'].'" WHERE `id` = "'.$z['id'].'" LIMIT 1');
										$this->error = '�� ������� ��������� ���...';
										$zi = $z;
										$u->info['zv'] = $z['id'];
										$u->info['team'] = mysql_real_escape_string((int)$t1);
										//
										if( $z['priz'] > 0 ) {
											if( rand(0,100) < 31 ) {
												$u->lockstart();
												echo '<script>top.sd4win();</script>';
											}
										}
										//
										if($countZv[0]+1 >= $z['usermax']){
											$z['time'] = $z['time'] - $z['time_start'];
											mysql_query( 'UPDATE `zayvki` SET `time` = "'.$z['time'].'" WHERE `id` = "'.$z['id'].'"');
										}
										//
									}
								}
								else{
									$item_user = mysql_query('SELECT * FROM `items_users` WHERE `delete` = 0 AND `inOdet` > 0 AND `inShop` = 0 AND `uid` = "'.$u->info['id'].'" LIMIT 100');
									$art_user = 0;
									while($it_user = mysql_fetch_array($item_user)){
										$data_us = explode("|", $it_user['data']);
										$i = 0;
										while ($i <= count($data_us)) {
											if($data_us[$i] == "art=1"){
												$art_user = 1;
												break 2;
											}
											else{
												$art_user = 0;
											}
											$i++;
										}
									}
									if($art_user == 1){
										$this->error = '� ������ ��� ��������� ������������� ����������...';		
									}
									else{
										//$this->error = '�� �������...';		
										$upd = mysql_query('UPDATE `stats` SET `zv` = "'.$z['id'].'",`team` = "'.$t1.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
										if(!$upd)
										{
											$this->error = '������ ������ ������...';
										}else{
											mysql_query('UPDATE `users` SET `login2` = "'.$u->info['login2'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
											mysql_query('UPDATE `zayvki` SET `tm1` = "'.$z['tm1'].'", `tm2` = "'.$z['tm2'].'" WHERE `id` = "'.$z['id'].'" LIMIT 1');
											$this->error = '�� ������� ��������� ���...';
											$zi = $z;
											$u->info['zv'] = $z['id'];
											$u->info['team'] = mysql_real_escape_string((int)$t1);
											//
											if($countZv[0]+1 >= $z['usermax']){
												$z['time'] = $z['time'] - $z['time_start'];
												mysql_query( 'UPDATE `zayvki` SET `time` = "'.$z['time'].'" WHERE `id` = "'.$z['id'].'"');
											}
											//
										}
									}
								}
							}else{
								$this->error = '������ ��� �������...';
							}
						}
					}else{
						$this->error = '������ �� ��� �� �������.';
					}	
				}					
			}
		}else{
			$this->error = '�� �� ������ ������� ���. ������� �������� ���� ������.';
		}
	}	
}
$zv = new zayvki;
//$zv->test(); //��������� ������

//if(isset($_GET['testzv'])) {
	$zv->test();
	//die();
//}

?>