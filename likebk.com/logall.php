<?php
/*

	Ядро для обработки данных.
	Обработка поединков, обработка заявок, обработка ботов, обработка пещер, обработка турниров, обработка временных генераций

*/

define('GAME',true);

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');
include('_incl_data/class/bot.logic.php');

$html = '';

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
			//обычный удар
			$rt = $pl['text'];
			//заменяем данные
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
				//замена R - игрок 1
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
				//замена R - игрок 2
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
			
			//заменяем данные повторно
			$rt = str_replace('{u1}','<span onClick="top.addTo(\''.$d['login1'].'\',\'to\'); return false;" oncontextmenu="top.infoMenu(\''.$d['login1'].'\',event,\'chat\'); return false;" class="CSSteam'.$d['t1'].'">'.$d['login1'].'</span>',$rt);
			$rt = str_replace('{u2}','<span onClick="top.addTo(\''.$d['login2'].'\',\'to\'); return false;" oncontextmenu="top.infoMenu(\''.$d['login2'].'\',event,\'chat\'); return false;" class="CSSteam'.$d['t2'].'">'.$d['login2'].'</span>',$rt);
			$rt = str_replace('{pr}','<b>'.$d['prm'].'</b>',$rt);
			$rt = str_replace('^^^^','=',$rt);
			$rt = str_replace('{tm1}','<span class="date">'.date('H:i',$d['time1']).'</span>',$rt);
			$rt = str_replace('{tm2}','<span class="date">'.date('H:i',$d['time2']).'</span>',$rt);
			$rt = str_replace('{tm3}','<span class="date">'.date('d.m.Y H:i',$d['time1']).'</span>',$rt);
			$rt = str_replace('{tm4}','<span class="date">'.date('d.m.Y H:i',$d['time2']).'</span>',$rt);
			
			//закончили заменять
			$pl['text'] = $rt;
		}
		return $pl['text'];
	}

$sp = mysql_query('SELECT * FROM `battle_logs` WHERE `battle` = "'.mysql_real_escape_string($_GET['id']).'" ORDER BY `id` ASC');
$hod = 0;
while( $pl = mysql_fetch_array($sp) ) {
	if( $hod != $pl['id_hod'] ) {
		$hod = $pl['id_hod'];
		$html .= '<hr>';
	}
	$pl['text'] = testlog($pl);
	$html .= '<div>'.$pl['id'].'. ['.date('d.m.Y H:i:s',$pl['time']).'] ( '.$pl['id_hod'].' ) <font color="blue">'.$pl['text'].'</font> {'.$pl['vars'].'}</div>';
}
echo $html;

?>