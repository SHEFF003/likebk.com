<?
define('GAME',true);
include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

$btl = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.mysql_real_escape_string((int)$_GET['log']).'" LIMIT 1'));
if(!isset($btl['id'])) {
	/*
	$btl_html = mysql_fetch_array(mysql_query('SELECT * FROM `battle_static` WHERE `battle` = "'.mysql_real_escape_string((int)$_GET['log']).'" LIMIT 1'));
	if(isset($btl_html['id'])) {
		$pg = (int)$_GET['p'];
		if( $pg < 1 ) {
			$pg = 1;
		}elseif( $pg > $btl_html['pages'] ) {
			$pg = $btl_html['pages'];
		}
		if(isset($_GET['analiz'])) {
			$pg = 's';
		}
		$data = file_get_contents(''.$btl_html['path'].$pg.'.html');
		echo $data;
		die();
	}
	*/
}

if( $u->info['admin'] > 0 ) {
	if(isset($_GET['clearbattle'])) {
		mysql_query('UPDATE `users` SET `battle` = 0 WHERE `battle` = "'.$btl['id'].'"');
		mysql_query('DELETE FROM `battle_users` WHERE `battle` = "'.$btl['id'].'"'); 
		mysql_query('DELETE FROM `battle_stat` WHERE `battle` = "'.$btl['id'].'"');
		mysql_query('DELETE FROM `battle_static` WHERE `battle` = "'.$btl['id'].'"'); 
		mysql_query('DELETE FROM `battle_end` WHERE `battle_id` = "'.$btl['id'].'"');  
	}
	echo '<div><a href="/logs.php?log='.$btl['id'].'&clearbattle">��������� �������� �������������</a></div>';
	echo '<hr><br>'; 
}

$fil = '<span style="margin-left: 25px;">����� : <form id="line_filter" style="display: inline;" onsubmit="return false;"> <input type="text" id="line_filter_input" autocomplete="off" style="padding:5px;" /> <input type="submit" id="line_filter_input_submit" class="btn" value="������" onclick="return false" /> <input type="button" id="line_filter_glow" class="btn" value="���������" /></form></span>';

$r = ''; $p = ''; $b = '<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tbody>
    <tr valign="top">
      <td valign="bottom" nowrap="" title="">
	  <input class="btn btn-default" onClick="location=location;" style="padding:5px;" type="submit" name="analiz2" value="��������">';

if($btl['team_win'] != -1) {
	if(!isset($_GET['analiz'])) {
		$b .= ' <input class="btn btn-default"  class="btn btn-default"onClick="location=\'logs.php?log='.((int)$_GET['log']).'&analiz=1\';" style="padding:5px;" type="submit" name="analiz3" value="����������">';
		$b .= $fil;
	}else{
		$b .= ' <input class="btn btn-default" onClick="location=\'logs.php?log='.((int)$_GET['log']).'\';" style="padding:5px;" type="submit" name="analiz3" value="��� ���">';
	}
}
$b .= '</td>
    </tr>	
  </tbody>
</table>';
$b2 = '<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tbody>
    <tr valign="top">
      <td valign="bottom" nowrap="" title="">
	  <input class="btn btn-default" onClick="location=location;" style="padding:5px;" type="submit" name="analiz2" value="��������">';

if($btl['team_win'] != -1) {
	if(!isset($_GET['analiz'])) {
		$b2 .= ' <input class="btn btn-default"  class="btn btn-default"onClick="location=\'logs.php?log='.((int)$_GET['log']).'&analiz=1\';" style="padding:5px;" type="submit" name="analiz3" value="����������">';
	}else{
		$b2 .= ' <input class="btn btn-default" onClick="location=\'logs.php?log='.((int)$_GET['log']).'\';" style="padding:5px;" type="submit" name="analiz3" value="��� ���">';
	}
}
$b2 .= '</td>
    </tr>	
  </tbody>
</table>';

$room = mysql_fetch_array(mysql_query('SELECT * FROM `room` WHERE `id`="'.$btl['room'].'"'));
$name_room = $room['name'];
if(isset($btl['id']) && $btl['team_win'] != -1 && isset($_GET['analiz'])) {
	function rzv($v)
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
	$tmStart = floor(($btl['time_over']-$btl['time_start'])/6)/10;
	$tmStart = rzv($tmStart);
	$tbtl = '<img src="http://img.likebk.com/i/fighttype'.$btl['type'].'.gif">';
	if( $btl['invis'] > 0 ) {
		$tbtl .= '<img src="http://img.likebk.com/i/fighttypehidden0.gif">';
	}
	if($btl['type'] == 0) {
		$tbtl = '��� ���: '.$tbtl.' (���������� ��������) &nbsp; &nbsp; ';
	}elseif($btl['type'] == 1) {
		$tbtl = '��� ���: '.$tbtl.' (�������� ��������) &nbsp; &nbsp; ';
	}else{
		$tbtl = '��� ���: '.$tbtl.' (���������� ��������) &nbsp; &nbsp; ';
	}
		
	if( $btl['izlom'] > 0 ) {
		$tbtl .= '�����: '.$btl['izlomRoundSee'].' &nbsp; &nbsp; ';
	}
	
	$tbtl .= '����������������� ���: '.$tmStart.' ���.<br>';
	
	$users = array(

	);
	
	$uids = array(
	
	);
	
	function con_login($us) {
		$r = '';
		if( $us['align'] > 0 ) {
			$r .= '<img src="http://img.likebk.com/i/align/align'.$us['align'].'.gif" width="12" height="15">';
		}
		if( $us['clan'] > 0 ) {
			$r .= '<a href="clans_inf.php?'.$us['clan'].'" target="_blank"><img src="http://img.likebk.com/i/clan/'.$us['clan'].'.gif" width="24" height="15"></a>';
		}
		$r .= '<b class="CSSteam'.$us['team'].'">'.$us['login'].' ['.$us['level'].']</b>';
		$r .= '<a href="inf.php?'.$us['uid'].'" target="_blank"><img src="http://img.likebk.com/i/inf_capitalcity.gif" width="12" height="11"></a>';
		return $r;
	}
	$exp = array(
    
    );
	$prc = array(
    
    );
	$sp = mysql_query('SELECT * FROM `battle_users` WHERE `battle` = "'.$btl['id'].'"');
	while($pl = mysql_fetch_array($sp)) {
		if(!isset($uids[$pl['id']])) {
			$i = count($users);
			$users[$i] = $pl;
			$uids[$pl['uid']] = $i;
			//
			$exp[$i]['exp'] = $pl['exp_btl'];
			if($exp[$i]['exp'] == 0){
				$prc[$i]['prc'] = 0;
			}
			else{
				$prc[$i]['prc'] = $pl['prc_btl'];
			}
			$users[$i]['value'] = array(
				'y' => 0, //��������+�����������+������ �����
				'b' => 0, //�������� ������
				'p' => 0, //�� �������� ������, �� ��������� ������
				'zb' => array( //������ ��� �����
					
				),
				'sa' => array( //���������� ������
					0 => '',
					1 => '',
					2 => '',
					3 => '',
					4 => '',
					5 => ''
				),
				'sb' => array( //���������� ������
					0 => '',
					1 => '',
					2 => '',
					3 => '',
					4 => '',
					5 => ''
				)
			);

			$sp2 = mysql_query('SELECT * FROM `battle_stat` WHERE `battle` = "'.$btl['id'].'" AND `uid1` = "'.$pl['uid'].'" ORDER BY `id` ASC');
			while($pl2 = mysql_fetch_array($sp2)) {
				//��������� ������
				if($pl2['type'] == 5 || $pl2['type'] == 6 || $pl2['type'] == 7 || $pl2['type'] == 8 || $pl2['type'] == 9 || $pl2['type'] == 10 || $pl2['type'] == 11 || $pl2['type'] == 13){
					$users[$i]['yrn_mag'] += $pl2['yrn'];
					$users[$i]['yrn_mag_krit'] += $pl2['yrn_krit'];
				}
				else{
					$users[$i]['yrn'] += $pl2['yrn'];
					$users[$i]['yrn_krit'] += $pl2['yrn_krit'];
				}
				//���������� �����
				$users[$i]['gaa']++;
				if( $users[$i]['yrn'] > 0 ) {
					$users[$i]['ga']++;
				}
				if( $users[$i]['yrn_krit'] > 0 ) {
					$users[$i]['gak']++;
				}
				//�������� ���� ��� �����
				$j = 0;
				while($j < $pl2['ma']) {
					$users[$i]['zona'][$pl2['a'][$j]]++;
					//
					$za = $pl2['a'][$j];
					$k = 1;
					while($k <= 5) {
						if( $za == $k ) {
							$tpa = $pl2['type_a'][$j];
							$zag[$k] = true;							
							$users[$i]['value']['sa'][$k] .= $tpas[$tpa];
						}else{
							$zag[$k] = false;
							//$users[$i]['value']['sa'][$za] .= '.';
						}
						$k++;
					}
					//
					$j++;
				}
				$j = $pl2['b'];
				$k = 0;
				while($k < $pl2['mb']) {
					if( $j > 5 ) {
						$j = 1;
					}
					$users[$i]['value']['zb'][] = array( 0 => $j , 1 => 0 );
					$users[$i]['zonb'][$j]++;
					$j++;
					$k++;
				}
				//
				$k = 1;
				while($k <= 5) {
					if( $zag[$k] == false ) {
						$users[$i]['value']['sa'][$k] .= ' ';
					}
					$k++;
				}
				//
			}
			//
			$sp2 = mysql_query('SELECT * FROM `battle_stat` WHERE `battle` = "'.$btl['id'].'" AND `uid2` = "'.$pl['uid'].'" ORDER BY `id` ASC');
			$k = 0;
			while($pl2 = mysql_fetch_array($sp2)) {
				//��������� ������
				$users[$i]['_yrn'] -= $pl2['yrn'];
				$users[$i]['_yrn_krit'] -= $pl2['yrn_krit'];
				//�������� ���� ���� ������
				$j = 0; $zag = array();
				while($j < $pl2['ma']) {
					$users[$i]['value']['zb'][$k][1] = $pl2['type_a'][$j];
					if( $pl2['type_a'][$j] == 2 || $pl2['type_a'][$j] == 6 || $pl2['type_a'][$j] == 7 || $pl2['type_a'][$j] == 8 ) {
						$users[$i]['value']['y']++;
					}elseif( $pl2['type_a'][$j] == 3 ) {
						$users[$i]['value']['b']++;
					}else{
						$users[$i]['value']['p']++;
					}
					//
					$j++;
				}
				//
				$k++;
				//
			}
			//���������� ������
			$k = 0;
			$h = 0;
			$bjj = array();
			while( $k < count($users[$i]['value']['zb']) ) {
				$zb = 0+$users[$i]['value']['zb'][$k][0];
				$zt = 0+$users[$i]['value']['zb'][$k][1];
				$bjj[$zb] = true;
				$users[$i]['value']['sb'][$zb] .= ''.$tpbs[$zt].'';
				if( $h < 1 ) {
					$h++;
				}else{
					$d = 1;
					while($d <= 5) {
						if( $bjj[$d] == true ) {
							
						}else{
							$users[$i]['value']['sb'][$d] .= ' ';
						}
						$d++;
					}
					$bjj = array();
					$h = 0;
				}
				$k++;
			}
			//
		}	
	}
	
	$usr = '';
	$tm = array();
	$tm_u = array();
	$tm_v = array();
	$i = 0;
	while($i < count($users)) {
		if( $users[$i] > 0 ) {
			$us = $users[$i];
			if( !isset($tm[$us['team']]) ) {
				$tm[$us['team']] = '';
				$tm_v[] = $us['team'];
			}
			$tm_u[$us['team']][] = $i;
			$tm[$us['team']] .= ''.con_login($us);
			$tm[$us['team']] .= ', ';
			unset($us);
		}
		$i++;	
	}	
	$i = 0;
	while($i < count($tm_v)) {
		$usr .= rtrim($tm[$tm_v[$i]],', ');
		if( $i < count($tm_v)-1 ) {
			$usr .= ' &nbsp; <b>������</b> &nbsp; ';
		}
		$i++;
	}
	//
	$usr = '<H4>��������� ��������</H4>'.$usr.'<br><br>';
	//
	$r = '';
	$r .= '<H4>��������</H4>';
	$r .= '<TABLE class="stat_tbl" width="100%" border=1 cellspacing=0 cellpadding=4>';
	$r .= '<Thead>';
	$r .= '<Tr class="row1">
				<TD rowspan="2" align=center>&nbsp;</TD>
				<TD rowspan="2" align=center>�����</TD>
				<TD rowspan="2">�����</TD>
				<TD rowspan="2">�����</TD>
				<TD rowspan="2">���������</TD>
				<TD rowspan="2">������</TD>
				<TD colspan="2">����</TD>
				<TD rowspan="2">������</TD>
				<TD rowspan="2">����</TD>
			</Tr>
			<tr class="row1">
				<td>���.</td>
				<td>���.</td>
			</tr>
		</Thead>';	
	$i = 0;
	while($i <= count($tm_v)) {	
		$j = 0;
		$team_data = array( 'g' => false );
		$sumexp = 0;
		$sumprc = 0;
		while($j < count($tm_u[$tm_v[$i]])) {
			$us = $users[$tm_u[$tm_v[$i]][$j]];
            $pr = $prc[$tm_u[$tm_v[$i]][$j]];
            $expr = $exp[$tm_u[$tm_v[$i]][$j]];
			if($us['id'] > 0) {
				$team_data['g'] = true;
				if( $us['hp'] < 0 ) {
					$us['hp'] = 0;
				}
				if( $us['yrn'] < 0 ) {
					$us['yrn'] = 0;
				}
				if( $us['yrn_krit'] < 0 ) {
					$us['yrn_krit'] = 0;
				}
				if( $us['_yrn'] > 0 ) {
					$us['_yrn'] = 0;
				}
				if( $us['_yrn_krit'] > 0 ) {
					$us['_yrn_krit'] = 0;
				}
				$team_data['ga'] += $us['ga'];
				$team_data['gaa'] += $us['gaa'];
				$team_data['gak'] += $us['gak'];
				$team_data['hp'] += $us['hp'];
				$team_data['hpAll'] += $us['hpAll'];
				$team_data['yrn'] += $us['yrn'];
				$team_data['yrn_krit'] += $us['yrn_krit'];
				$team_data['yrn_mag'] += $us['yrn_mag'];
				$team_data['yrn_mag_krit'] += $us['yrn_mag_krit'];
				$team_data['_yrn'] += $us['_yrn'];
				$team_data['_yrn_krit'] += $us['_yrn_krit'];
				$team_data['val_b'] += $us['value']['b'];
				$team_data['val_y'] += $us['value']['y'];
				$team_data['val_p'] += $us['value']['p'];
				$sumexp += $expr['exp'];
				$sumprc += $pr['prc'];
				$winw = '';
				if( $us['hp'] < 1 ) {
					$us['hp'] = '<font color=red>0</font>';
					$winw = '<img rel="tooltip" title="�����" width="7" height="7" src="http://img.likebk.com/i/ico/looses.gif">';
				}else{
					$winw = '<img rel="tooltip" title="�����" width="7" height="7" src="http://img.likebk.com/i/ico/wins.gif">';
				}
$r .= '<TR>
			<TD valign=middle align=center>'.$winw.'</TD>
			<TD>'.con_login($us).' ['.$us['hp'].'/'.$us['hpAll'].']</TD>
			<TD><a rel="tooltip" title="������">'.(0+$us['zona'][1]).'</a>/<a rel="tooltip" title="�����">'.(0+$us['zona'][2]).'</a>/<a rel="tooltip" title="�����">'.(0+$us['zona'][3]).'</a>/<a rel="tooltip" title="����">'.(0+$us['zona'][4]).'</a>/<a rel="tooltip" title="����">'.(0+$us['zona'][5]).'</a></TD>
			<TD><a rel="tooltip" title="������">'.(0+$us['zonb'][1]).'</a>/<a rel="tooltip" title="�����">'.(0+$us['zonb'][2]).'</a>/<a rel="tooltip" title="�����">'.(0+$us['zonb'][3]).'</a>/<a rel="tooltip" title="����">'.(0+$us['zonb'][4]).'</a>/<a rel="tooltip" title="����">'.(0+$us['zonb'][5]).'</a></TD>
			<TD align=center><a rel="tooltip" title="������� ���������">'.(0+$us['ga']).'</a>(<a rel="tooltip" title="�����������"><font color=red>'.(0+$us['gak']).'</a></font>)/<a rel="tooltip" title="�����">'.($us['gaa']).'</a></TD>
			<TD align=center><a rel="tooltip" title="������ �������������">'.$us['value']['b'].'</a>/<a rel="tooltip" title="��������">'.$us['value']['y'].'</a>/<a rel="tooltip" title="��������� ������">'.$us['value']['p'].'</a></TD>
			<TD align=center><a rel="tooltip" title="������ HP �� ����������� ">'.$us['yrn'].'</a>/<a rel="tooltip" title="�������"><font color=red>'.$us['yrn_krit'].'</font></a></TD>
			<TD align=center><a rel="tooltip" title="������ HP �� ����������� ������">'.$us['yrn_mag'].'</a>/<a rel="tooltip" title="���. �������"><font color=red>'.$us['yrn_mag_krit'].'</font></a></TD>
			<TD align=center><a rel="tooltip" title="�������� �����������">'.(-$us['_yrn']).'</a></TD>
			<TD align=center>'.$expr['exp'].' ('.$pr['prc'].'%)</TD>
		</TR>';
			}
			unset($us);
			$j++;
		}
		if( $team_data['g'] == true ) {
			$winw = '<span rel="tooltip" title="�����������">--</span>';
			if( $team_data['hp'] < 1 ) {
				$team_data['hp'] = '0';
			}else{
				$winw = '<img rel="tooltip" src="http://img.likebk.com/i/flag.gif" width="20" height="20" title="����������">';
			}
$r .= '<TR bgcolor=d2d0d0>
			<TD align=center>'.$winw.'</TD>
			<TD>
			<b class="CSSteam'.$tm_v[$i].'">����� ['.$team_data['hp'].'/'.$team_data['hpAll'].']</b></TD>
			<TD>&nbsp;</TD>
			<TD>&nbsp;</TD>
			<TD align=center><a rel="tooltip" title="������� ���������">'.(0+$team_data['ga']).'</a>(<a rel="tooltip" title="�����������"><font color=red>'.(0+$team_data['gak']).'</font></a>)/<a rel="tooltip" title="�����">'.($team_data['gaa']).'</a></TD>
			<TD align=center><a rel="tooltip" title="������ �������������">'.$team_data['val_b'].'</a>/<a rel="tooltip" title="��������">'.$team_data['val_y'].'</a>/<a rel="tooltip" title="��������� ������">'.$team_data['val_p'].'</a></TD>
			<TD align=center><a rel="tooltip" title="������ HP �� ����������� ">'.$team_data['yrn'].'</a>/<a rel="tooltip" title="�������"><font color=red>'.$team_data['yrn_krit'].'</font></a></TD>
			<TD align=center><a rel="tooltip" title="������ HP �� ����������� ������">'.$team_data['yrn_mag'].'</a>/<a rel="tooltip" title="���. �������"><font color=red>'.$team_data['yrn_mag_krit'].'</font></a></TD>
			<TD align=center><a rel="tooltip" title="�������� �����������">'.(-$team_data['_yrn']).'</a></TD>
			<TD align=center>'.$sumexp.' ('.$sumprc.'%)</TD>
		</TR>';
		}
		$i++;
	}
	$r .= '</TABLE></div>';
	//
	$r .= '
����� - ��� ��������� � ������� �����: [������/�����]<br>
����� - ���������� ������ �� ��������: ������/�����/�����/����/����<br>
����� - ���������� ������ �� ��������: ������/�����/�����/����/����<br>
��������� - ������� ��������� <font color=red>(�� ��� ������)</font> / ����� ������<br>
������ - ������ ������������� / �������� / ��������� ������<br>
���� - ������ HP �� ����������� / �� ��� <font color=red>�������</font><br>
������ - �������� ����������� <br>
���� - �������� ����� �� ���<br>';
	
	$rw = '!';
	if( $btl['arand'] > 0 ) {
		$rw .= ' <font color=red>���������� ������</font>  &nbsp; &nbsp;';
	}
	if( $btl['balance2'] != '0' ) {
		$rw .= '����������� ���: ' . $btl['balance2'].' &nbsp; &nbsp;';
	}
	$r = '<div>'.$b.'</div><div><span style="float:left;">'.$tbtl.$p.'</span><span style="float:right;">'.$rw.'�������� ����� ���: <i>'.$name_room.'</i></span></div><br><br>'.$usr.$r.'<div align="left">'.$p.'</div>';

}elseif(!isset($btl['id']))
{
	$r = '<br><br><center>������ ����� ���������� ����� ������� ��������� � ��������� ���� ...</center>';
}else{
	include('jx/battle/log_text.php');
	function testlog($pl)
	{
		global $log_text,$c,$u,$code;
		if($pl['type']==1 || $pl['type']==6)
			{
			$dt = explode('||',$pl['vars']);
			$i = 0; $d = array();
			while($i<count($dt))
			{
				$r = explode('=',$dt[$i]);
				if($r[0]!='')
				{
					$d[$r[0]] = $r[1];
				}
				$i++;
			}
			//������� ����
			$rt = $pl['text'];
			//�������� ������
			$rt = str_replace('{u1}','<span onClick="top.addTo(\''.$d['login1'].'\',\'to\'); return false;" oncontextmenu="top.infoMenu(\''.$d['login1'].'\',event,\'chat\'); return false;" class="CSSteam'.$d['t1'].'">'.$d['login1'].'</span>',$rt);
			$rt = str_replace('{u2}','<span onClick="top.addTo(\''.$d['login2'].'\',\'to\'); return false;" oncontextmenu="top.infoMenu(\''.$d['login2'].'\',event,\'chat\'); return false;" class="CSSteam'.$d['t2'].'">'.$d['login2'].'</span>',$rt);
			$rt = str_replace('{pr}','<b>'.$d['prm'].'</b>',$rt);
			$rt = str_replace('^^^^','=',$rt);
			$rt = str_replace('{tm1}','<span class="date">'.date('H:i',$d['time1']).'</span>',$rt);
			$rt = str_replace('{tm2}','<span class="date">'.date('H:i',$d['time2']).'</span>',$rt);
			$rt = str_replace('{tm3}','<span class="date">'.date('d.m.Y H:i',$d['time1']).'</span>',$rt);
			$rt = str_replace('{tm4}','<span class="date">'.date('d.m.Y H:i',$d['time2']).'</span>',$rt);
					
			$k01 = 1;
			$zb1 = array(1=>0,2=>0,3=>0,4=>0,5=>0);
			$zb2 = array(1=>0,2=>0,3=>0,4=>0,5=>0);
					
			if($d['bl2']>0)
			{
				$b11 = 1;
				$b12 = $d['bl1'];
				while($b11<=$d['zb1'])
				{
					$zb1[$b12] = 1;
					if($b12>=5 || $b12<0)
					{
						$b12 = 0;
					}
					$b12++;
					$b11++;
				}
			}
					
			if($d['bl2']>0)
			{
				$b11 = 1;
				$b12 = $d['bl2'];
				while($b11<=$d['zb2'])
				{
					$zb2[$b12] = 1;
					if($b12>=5 || $b12<0)
					{
						$b12 = 0;
					}
					$b12++;
					$b11++;
				}
			}
					
				
			while($k01<=5)
			{
				$zns01 = ''; $zns02 = '';
				$j01 = 1;
				while($j01<=5)
				{
					$zab1 = '0'; $zab2 = '0';
					if($j01==$k01)
					{
						$zab1 = '1';
						$zab2 = '1';
					}
					
					$zab1 .= $zb1[$j01];
					$zab2 .= $zb2[$j01];
						
					$zns01 .= '<img src="http://img.likebk.com/i/zones/'.$d['t1'].'/'.$d['t2'].''.$zab1.'.gif">';
					$zns02 .= '<img src="http://img.likebk.com/i/zones/'.$d['t2'].'/'.$d['t1'].''.$zab2.'.gif">';
					$j01++;
				}
				$rt = str_replace('{zn1_'.$k01.'}',$zns01,$rt);
				$rt = str_replace('{zn2_'.$k01.'}',$zns02,$rt);
				$k01++;
			}

			$j = 1;
			while($j<=21)
			{
				//������ R - ����� 1
				$r = $log_text[$d['s1']][$j];
				$k = 0;
				while($k<=count($r))
				{
					if(isset($log_text[$d['s1']][$j][$k]))
					{
						$rt = str_replace('{1x'.$j.'x'.$k.'}',$log_text[$d['s1']][$j][$k],$rt);
					}
					$k++;
				}
				//������ R - ����� 2
				$r = $log_text[$d['s2']][$j];
				$k = 0;
				while($k<=count($r))
				{
					if(isset($log_text[$d['s2']][$j][$k]))
					{
						$rt = str_replace('{2x'.$j.'x'.$k.'}',$log_text[$d['s2']][$j][$k],$rt);
					}
					$k++;
				}						
				$j++;
			}
			
			//�������� ������ ��������
			$rt = str_replace('{u1}','<span onClick="top.addTo(\''.$d['login1'].'\',\'to\'); return false;" oncontextmenu="top.infoMenu(\''.$d['login1'].'\',event,\'chat\'); return false;" class="CSSteam'.$d['t1'].'">'.$d['login1'].'</span>',$rt);
			$rt = str_replace('{u2}','<span onClick="top.addTo(\''.$d['login2'].'\',\'to\'); return false;" oncontextmenu="top.infoMenu(\''.$d['login2'].'\',event,\'chat\'); return false;" class="CSSteam'.$d['t2'].'">'.$d['login2'].'</span>',$rt);
			$rt = str_replace('{pr}','<b>'.$d['prm'].'</b>',$rt);
			$rt = str_replace('^^^^','=',$rt);
			$rt = str_replace('{tm1}','<span class="date">'.date('H:i',$d['time1']).'</span>',$rt);
			$rt = str_replace('{tm2}','<span class="date">'.date('H:i',$d['time2']).'</span>',$rt);
			$rt = str_replace('{tm3}','<span class="date">'.date('d.m.Y H:i',$d['time1']).'</span>',$rt);
			$rt = str_replace('{tm4}','<span class="date">'.date('d.m.Y H:i',$d['time2']).'</span>',$rt);
			
			//��������� ��������
			$pl['text'] = $rt;
		}
		return $pl['text'];
	}
	//�������� ����
	$min = round(20*((int)$_GET['p']-1));
	if($min<1)
	{
		$min = 0;
	}
	$max = $min+19;
	
	$based = 'battle_logs_save';
	$sp_cnt = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `battle_logs_save` WHERE `battle` = "'.$btl['id'].'" AND `id_hod` > '.$min.' AND `id_hod` <= '.$max.' ORDER BY `id_hod`, `time` ASC LIMIT 1'));
	if( $sp_cnt[0] < 1 ) {
		$based = 'battle_logs';
	}
	
	//���������� ��������
	$pmax = mysql_fetch_array(mysql_query('SELECT `id_hod`,`id` FROM `'.$based.'` WHERE `battle` = "'.$btl['id'].'" ORDER BY  `id_hod` DESC  LIMIT 1'));
	$pmax = $pmax['id_hod'];
	$pmax = ceil($pmax/20);
	
	if($min > round(20*($pmax-1)))
	{
		$min = round(20*($pmax-1));
		$max = $min+19;
	}
	$i = 1;
	while($i<=$pmax)
	{
		if((int)$_GET['p']==$i || ((int)$_GET['p']>$pmax && $i==$pmax) || ((int)$_GET['p']<1 && $i==1))
		{
			$p .= ' <a style="color:maroon" href="?log='.$btl['id'].'&p='.$i.'&rnd='.$code.'">'.$i.'</a> ';
		}else{
			$p .= ' <a href="?log='.$btl['id'].'&p='.$i.'&rnd='.$code.'">'.$i.'</a> ';	
		}
		$i++;
	}
	$h = 0; $clr = 'e2e0e0'; $cclr = '';
	$sp = mysql_query('SELECT * FROM `'.$based.'` WHERE `battle` = "'.$btl['id'].'" AND `id_hod` > '.$min.' AND `id_hod` <= '.($max+1).' ORDER BY `id_hod`, `id` ASC LIMIT 200');	
	while($pl = mysql_fetch_array($sp))
	{
		$pl['text'] = testlog($pl);
		$pl['text'] = str_replace('\"','"',$pl['text']);
		if($h!=$pl['id_hod'])
		{
			if($h>0)
			{
				if($clr == 'e2e0e0') {
					$clr = 'e3e1e1';
				}else{
					$clr = 'e2e0e0';
				}
				$cclr = 'border-top:1px solid #b1b1b1;';
				//$r .= '<hr>';
			}
			$h = $pl['id_hod'];
		}else{
			//$r .= '<br>';	
		}
		$r .= '<div class="logs_php_line" style="background-color:#'.$clr.';'.$cclr.'padding:1px;">'.$pl['text'].'</div>';	
		$cclr = '';
	}
	//�������� ��������
	$p = '��������: '.$p;
	$usr = '';
	if($btl['team_win'] == -1) {
		$sp = mysql_query('SELECT 
			`u`.`id`,`u`.`login`,`u`.`level`,`u`.`sex`,`u`.`align`,`u`.`online`,`u`.`battle`,`u`.`clan`,
			`s`.`hpNow`,`s`.`bot`,`s`.`team`,`u`.`city`
		 FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id` WHERE `u`.`battle` = "'.$btl['id'].'" AND `s`.`hpNow` >= 1');
		 
		 $usrs = array(-1 => array());
		 
		while($pl = mysql_fetch_array($sp)) {
			if(!isset($usrs[$pl['team']])) {
				$usrs[$pl['team']] = '';
				$usrs[-1][count($usrs[-1])] = $pl['team'];
			}
			if($pl['align'] > 0) {
				$usrs[$pl['team']] .= '<img src="http://img.likebk.com/i/align/align'.$pl['align'].'.gif" width="12" height="15">';
			}
			if($pl['clan'] > 0) {
				$usrs[$pl['team']] .= '<img src="http://img.likebk.com/i/clan/'.$pl['clan'].'.gif" width="24" height="15">';
			}
			$pl['stats_r'] = $u->getStats($pl['id']);			
			$usrs[$pl['team']] .= '<b class="CSSteam'.$pl['team'].'">'.$pl['login'].'</b> ['.ceil($pl['stats_r']['hpNow']).'/'.$pl['stats_r']['hpAll'].']<a href=/inf.php?'.$pl['id'].' target=_blank ><img src=http://img.likebk.com/i/inf_capitalcity.gif ></a>,';		
		}
		
		if(count($usrs[-1]) > 0) {
			$i = 0;
			while($i < count($usrs[-1])) {
				$usr .= rtrim($usrs[$usrs[-1][$i]],',').'';
				if(count($usrs[-1]) > $i+1) {
					$usr .= ' &nbsp; <b><font color=black>������</font></b> &nbsp; ';
				}
				$i++;
			}
		}
		
		if($usr != '') {
			$usr = '<div align="center">'.$usr.'</div><hr>';
		}
	}
	$tbtl = '<img src="http://img.likebk.com/i/fighttype'.$btl['type'].'.gif">';
	if( $btl['invis'] > 0 ) {
		$tbtl .= '<img src="http://img.likebk.com/i/fighttypehidden0.gif">';
	}
	if($btl['type'] == 0) {
		$tbtl = '��� ���: '.$tbtl.' (���������� ��������) &nbsp; &nbsp; ';
	}elseif($btl['type'] == 1) {
		$tbtl = '��� ���: '.$tbtl.' (�������� ��������) &nbsp; &nbsp; ';
	}else{
		$tbtl = '��� ���: '.$tbtl.' (���������� ��������) &nbsp; &nbsp; ';
	}
	
	if( $btl['izlom'] > 0 ) {
		$tbtl .= '�����: '.$btl['izlomRoundSee'].' &nbsp; &nbsp; ';
	}
	
	$rw = '';
	if( $btl['arand'] > 0 ) {
		$rw .= ' <font color=red>���������� ������</font>  &nbsp; &nbsp;';
	}
	if( $btl['balance2'] != '0' ) {
		$rw .= ' ����������� ���: ' . $btl['balance2'].' &nbsp; &nbsp;';
	}
	
	$r = '<div>'.$b.'</div><div><span style="float:left;">'.$tbtl.$p.'</span><span style="float:right;">'.$rw.'�������� ����� ���:  <i>'.$name_room.'</i></span></div><br><hr>'.$usr.$r.'<hr>'.$usr.'<div align="left">'.$p.'</div>';
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>�����: ��������</title>
<script src="http://img.likebk.com/js/Lite/gameEngine.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://likebk.com/js/logs/bootstrap.min.js" type="text/javascript"></script>
<link href="http://likebk.com/js/logs/bootstrap.css" rel="stylesheet" type="text/css">
<!-- <link href="http://img.likebk.com/css/main.css" rel="stylesheet" type="text/css"> -->
<script type="text/javascript">
	$(document).ready(function(){
	    $('[rel="tooltip"]').tooltip();   
	    $('[rel="tooltip"]').css('cursor','pointer');
	});
</script>
<style type="text/css">
h3 {
	text-align: center;
}
.CSSteam	{ font-weight: bold; cursor:pointer; }
.CSSteam0	{ font-weight: bold; cursor:pointer; }
.CSSteam1	{ font-weight: bold; color: #6666CC; cursor:pointer; }
.CSSteam2	{ font-weight: bold; color: #B06A00; cursor:pointer; }
.CSSteam3 	{ font-weight: bold; color: #269088; cursor:pointer; }
.CSSteam4 	{ font-weight: bold; color: #A0AF20; cursor:pointer; }
.CSSteam5 	{ font-weight: bold; color: #0F79D3; cursor:pointer; }
.CSSteam6 	{ font-weight: bold; color: #D85E23; cursor:pointer; }
.CSSteam7 	{ font-weight: bold; color: #5C832F; cursor:pointer; }
.CSSteam8 	{ font-weight: bold; color: #842B61; cursor:pointer; }
.CSSteam9 	{ font-weight: bold; color: navy; cursor:pointer; }
.CSSvs 		{ font-weight: bold; }
.stat_tbl{
	text-align: center;
}
</style>
</head>

<?
if($u->info['id'] == 158499643 || $u->info['admin'] > 0 || isset($_COOKIE['root'])) {
	if(isset($_GET['povis'])) {
		mysql_query('UPDATE `battle` SET `status` = `status` + 1 WHERE `id` = "'.$btl['id'].'" LIMIT 1');
		die('<script>top.location.href="/logs.php?log='.$_GET['log'].'"</script>');
	}
	echo '<div style="padding:20xp;"><a href="/logs.php?log='.$_GET['log'].'&povis">�������� ������</a></div>';
}
?>

<body bgcolor="#E2E0E0">
	<div style="visibility: hidden; position: absolute;"></div>
<H3><? if($btl['cwar'] > 0) { echo '<font color=red>�������� �����</font> '; } ?><IMG SRC="http://img.likebk.com/i/fighttype2.gif" WIDTH=20 HEIGHT=20> ���������� ����<? if( $based != 'battle_logs' ) { echo ' (����� ���������)'; } ?> &nbsp; <a href="http://www.likebk.com/">www.likebk.com</a> <IMG SRC="http://img.likebk.com/i/fighttype2.gif" WIDTH=20 HEIGHT=20></H3>
<div align="center" style="font-size:18px;"><?
	$btlstatus = array(
			1 => array(
				array('������� ���',0,0),
				array('������� �����',50,50000),
				array('���������� �����',100,100000),
				array('������������ �����',200,200000),
				array('���������� �����',300,300000),
				array('������ ����',400,400000)
			),
			2 => array(
				array('�������� ���',0,0),
				array('�������� �����',100,100000),
				array('�������� �����',150,150000),
				array('�������� ����',250,250000),
				array('�������� �������',350,350000),
				array('������ ����',450,450000)
			)
	);
	if($btl['status'] > 0) {
		if( $btl['type'] == 99 ) {
			$btlstatus = $btlstatus[2];
		}else{
			$btlstatus = $btlstatus[1];
		}
		echo '<b><font color=red>'.$btlstatus[$btl['status']][0].'</font></b> &nbsp; &nbsp; ';
	}
?></div>
<?php 
	echo $r; 
	echo "<br>".$b2;
?>
<script language="JavaScript">
$('#line_filter').submit(function () {
  $('#line_filter_input_submit').trigger('click');
});

$('#line_filter_glow').click(function () {
  var val = $('#line_filter_input').val();
  $(".logs_php_line").stop().css('background-color', '').show();
  $('#not_found').css('display', 'none');
  if(val != '') {
    $(".logs_php_line:contains('" + val + "')").css('background-color', '#f8f8ef'); //##f8f8ef ffff80
  }
});

$('#line_filter_input_submit').click(function () {
  $("#not_found").slideUp();
  var val = $('#line_filter_input').val();
  if(val == '') {
     $(".logs_php_line").stop().css('background-color', '').show();
  } else {
   /*if($.browser.msie || !1) {
     $(".logs_php_line").stop().css('background-color', '').hide();
     if (val != '') $(".logs_php_line:contains('" + val + "')").stop().show();
   } else {*/
     $(".logs_php_line").stop().css('background-color', '').slideUp();
      $(".logs_php_line:contains('" + val + "')").stop().slideDown();
   //}
   setInterval('if ($(".logs_php_line:visible").length == 0) $("#not_found").slideDown();', 300);
 }
 return false;
});

$('#line_filter_input').keyup(function () {
  if($('#line_filter_input').val() == '') {
    $('#line_filter_input_submit').trigger('click');
  }
});

jQuery.expr[":"].contains = function (elem, i, match, array) {
  return (elem.textContent || elem.innerText || jQuery.text(elem) || "").toLowerCase().indexOf(match[3].toLowerCase()) >= 0;
}
</script>
</body>
</html>