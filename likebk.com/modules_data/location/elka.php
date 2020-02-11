<?php
if(!defined('GAME'))
{
 die();
}
//id Новогоднего подарка
$pidid = 0; //4008
//if( $u->info['admin'] > 0 ) {
	$pidid = 4008;
//}

$dy = 1;
if((date('n',time())==2 && date('j',time())<=15))
{
	$dy = 0;
}
$dt = date('Y',time())+$dy;
$dt = 2020;

$smt = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "take_gift_'.$dt.'" LIMIT 1',1);

$ekgid = mysql_fetch_array(mysql_query('SELECT * FROM `elka_gid` WHERE `uid` = "'.$u->info['id'].'" AND `y` = "'.$dt.'" LIMIT 1'));

if($u->room['file']=='elka')
{
	if(isset($_GET['take_gift']) && !isset($ekgid['id']) )
	{
		//получаем свой новогодний подарок за текущий год addItem($id,$uid)
		$smt = $u->testAction('`uid` = "'.$u->info['id'].'" AND `vars` = "take_gift_'.$dt.'" LIMIT 1',1);
		if($pidid == 0) {
			echo '<font color=red>Сейчас не удалось получить подарок... уже скоро! ;)</font>';
		}elseif(!isset($ekgid['id']))
		{
			$pid = $u->addItem($pidid,$u->info['id']);
			if($pid>0)
			{
				mysql_query('UPDATE `items_users` SET `gift` = "Администрация",`gtxt1` = "Поздравляем Вас с Новым Годом!" WHERE `id` = "'.$pid.'" AND `uid` = "'.$u->info['id'].'" LIMIT 1');
				$u->addAction(time(),'take_gift_'.$dt.'',$u->info['city']);
				mysql_query('INSERT INTO `elka_gid` ( `uid`,`time`,`y` ) VALUES ( "'.$u->info['id'].'","'.time().'","'.$dt.'" ) ');
				echo '<font color=red>Предмет находится у Вас в инвентаре, в разделе "прочее"</font>';
			}else{
				echo '<font color=red>Не удалось получить подарок...</font>';
			}
		}else{
			echo '<font color=red>Вы уже получили свой подарок ;)</font>';
		}
	}elseif(isset($_GET['del']))
	{
	  if($u->info['admin']>0 || ($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4))
	  {
		if($u->info['admin']==0)
		{
		  $pInfo = ''.$u->info['align'].'|'.$u->info['clan'].'|'.$u->info['login'].'|'.$u->info['level'].'|'.$u->info['cityreg'].'';
		}else{
		  $pInfo = '1';
		}
		mysql_query("UPDATE `elka` SET `delete`='".$pInfo."' WHERE `id`='".mysql_real_escape_string($_GET['del'])."'");
	  }
	}elseif(isset($_GET['use_cup']))
	{
		$smt = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` > '.(time()-600).' AND `vars` = "use_cupNewYear" LIMIT 1',1);
		if(!isset($smt['id']))
		{
			$u->addAction(time(),'use_cupNewYear','');
			mysql_query('UPDATE `stats` SET `hpNow` = "'.$u->stats['hpAll'].'",`mpNow` = "'.$u->stats['mpAll'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			echo '<font color=red>Успешно использован эликсир "Полное восстановление"</font>';
		}
	}elseif(isset($_POST['message']))
	{
	  $_POST['message'] = htmlspecialchars($_POST['message'],NULL,'cp1251');
	  if($_POST['message']!='')
	  {
	   $dy = 1;
	   if((date('n',time())==1 && date('j',time())<=15))
	   {
		 $dy = 0;
	   }
	   $u->info['ET'] = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` > '.(time()-600).' AND `vars` = "send_elka" LIMIT 1',1);
	   if(isset($u->info['ET']['id']))
	   {
		 echo '<font color=red>Оставлять надписи на стволе ёлки можно не чаще одного раза в 10 минут</font>';
	   }else{
			$pInfo = ''.$u->info['align'].'|'.$u->info['clan'].'|'.$u->info['login'].'|'.$u->info['level'].'|'.$u->info['cityreg'].'|'.$u->info['id'].'';
			mysql_query("INSERT INTO `elka` (`year`,`time`,`pers`,`text`,`city`) VALUES (".$dt.",".time().",'".$pInfo."','".mysql_real_escape_string($_POST['message'])."','".$u->info['city']."'); ");
			$u->addAction(time(),'send_elka','');
		}
	  }
	}
	
	?>
	<style type="text/css"> 
	
	.pH3			{ COLOR: #8f0000;  FONT-FAMILY: Arial;  FONT-SIZE: 12pt;  FONT-WEIGHT: bold; }
	.class_ {
		font-weight: bold;
		color: #C5C5C5;
		cursor:pointer;
	}
	.class_st {
		font-weight: bold;
		color: #659BA3;
		cursor:pointer;
	}
	.class__ {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #659BA3;
	}
	.class__st {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #659BA3;
		font-size: 10px;
	}
	.class_old {
		font-weight: bold;
		color: #919191;
		cursor:pointer;
	}
	.class__old {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #838383;
		font-size: 10px;
	}
	
	</style>
    <div align="right"><? if($re!=''){ echo '<font color="red"><b>'.$re.'</b></font>'; } ?></div>
	<div id="hint3" style="visibility:hidden"></div>
	<TABLE width="100%" cellspacing="0" cellpadding="0">
	<tr><td valign="top"><div align="center" class="pH3">Новогодняя елка <?
	 echo $dt; ?>!</div>
	<br />
	<!-- Подарки -->
	<?
	$sg = 1;
	//Если есть подарки		
	if((date('n',time())==12 || date('n',time())<=2 || $u->info['admin'] > 0) && $sg==1)
	{
		
	function effUseCast($id) {
		$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "'.$id.'" LIMIT 1'));
		$r = '<a href="/main.php?takeeffnow='.$id.'"><img title="'.$eff['mname'].'" src="http://img.likebk.com/i/eff/'.$eff['img'].'"></a> ';
		return $r;
	}
	
	unset($_GET['takeeffnow']);
	if(isset($_GET['randeff'])) {
		$eid = array(
			0 => 38,
			1 => 37,
			2 => 295,
			3 => 25,
			4 => 436,
			5 => 20,
			6 => 32,
			7 => 437
		);
		$_GET['takeeffnow'] = $eid[rand(0,count($eid)-1)];
	}
	
	if(isset($_GET['takeeffnow'])) {
		$eid = array(
			37 => 38,
			38 => 37,
			295 => 295,
			25 => 25,
			436 => 436,
			20 => 20,
			32 => 32,
			437 => 437
		);
		$eid = $eid[(int)$_GET['takeeffnow']];
			
		if( $eid > 0 ) {
			$shii = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "9996" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1'));
			$shi = 0;
			if(isset($shii['id'])) {
				$shi++;
			}
			if( $u->info['admin'] > 0 ) {
				$shi += 100;
			}
			
			if( $shi == 0 || $u->info['money'] < 1 ) {
				echo '<div><font color="red"><b>Для каста необходим предмет &quot;Ледяной Кирпич&quot; и 1 кр.</b></font></div>';
			}else{
				$effu = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "'.$eid.'" LIMIT 1'));
				if(!isset($effu['id2'])) {
					echo '<div><font color="red"><b>Эффект не найден...</b></font></div>';
				}else{
					$n = $effu['mname'];
					$d = $effu['mdata'];
					
					mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND (`id_eff` = "'.$effu['id2'].'" OR `overType` = "'.$effu['oneType'].'")');

					$ins = mysql_query('INSERT INTO `eff_users`
					(
						`overType`,`id_eff`,`uid`,`name`,`timeUse`,`data`,`no_Ace`
					) VALUES (
						"'.$effu['oneType'].'","'.$effu['id2'].'","'.$u->info['id'].'","'.$n.'","'.time().'","'.$d.'","'.$effu['noAce'].'"
					)');
					if( $ins ) {
						//
						mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$shii['id'].'" LIMIT 1');
						//
						//
						$u->info['money'] -= 1;
						mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						echo '<div><font color="red"><b>Вы успешно обменяли &quot;Ледяной Кирпич&quot; и 1 кр. на каст &quot;'.$effu['mname'].'&quot;!</b></font></div>';
					}else{
						echo '<div>Что-то пошло не так...</div>';
					}
				}
			}
		}else{
			echo '<div><font color="red"><b>Эффект не найден...</b></font></div>';
		}		
	}
		
	?>
    <style>
		#wrapper {
	    margin-bottom: 20px;
	    padding-top: 5px;
	}
	.button{
	     display: inline-block;
	     width: 165px;
	     margin: 10px auto;
		 text-decoration:none; 
		 text-align:center; 
		 padding:5px 5px; 
		 border:solid 1px #007300; 
		 -webkit-border-radius:8px;
		 -moz-border-radius:8px; 
		 border-radius: 8px; 
		 font:16px Arial, Helvetica, sans-serif; 
		 font-weight:bold; 
		 color:#fff!important; 
		 background-color:#43a824; 
		 background-image: -moz-linear-gradient(top, #43a824 0%, #1a5707 100%); 
		 background-image: -webkit-linear-gradient(top, #43a824 0%, #1a5707 100%); 
		 background-image: -o-linear-gradient(top, #43a824 0%, #1a5707 100%); 
		 background-image: -ms-linear-gradient(top, #43a824 0% ,#1a5707 100%); 
		 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1a5707', endColorstr='#1a5707',GradientType=0 ); 
		 background-image: linear-gradient(top, #43a824 0% ,#1a5707 100%);   
		 -webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff; 
		 -moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 1px #ffffff;  
		 box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;    
	}
	.button:hover{
		color:#E5FFFF!important;
		opacity: 0.8; 
	}
	</style>
    <div style="padding-left:10px;">
	<span class="pH3"><small>Вы можете получить один из случайных эффектов усилений.<br>Вам потребуется 1 шт. <img style="padding-top:10px;" src="http://img.likebk.com/i/items/2.png"> "Ледяной кирпич" (выпадает в хаотических поединках) и 1 кр.</small></span><br><br>
    <a href="main.php?randeff" style="padding-left:10px;">
    <span class="button" style="pointer-events: none; cursor: default;">Получить эффект</span>
    </a>
    <?
    /*
	effUseCast(361);?>
    <?=effUseCast(362);?>
    <?=effUseCast(295);?>
    <?=effUseCast(25);?>
    <?=effUseCast(436);?>
    <?=effUseCast(20);?>
    <?=effUseCast(32);?>
    <?=effUseCast(437);
	*/
	?>
    </div>
    <br>
    <div style="padding-left:10px;">
	<span class="pH3"><small>Подарки:</small></span>
    <div>
    <?
    $smt = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` > '.(time()-600).' AND `vars` = "use_cupNewYear" LIMIT 1',1);
	?>
    <span class="pH3"><small>Чаша HP и Маны (Восстанавливает полностью Ману и HP, но не чаще 1 раза в 10 минут)</small></span><br>
    <a href="?use_cup=<? echo $code; ?>" <? if(isset($smt['id'])){ echo 'onClick="alert(\'Использовать Новогодний кубок можно не чаще одного раза в 10 минут\');return false;"'; } ?> /><img src="http://img.likebk.com/cup2012.gif" style="padding:10px;<? if(isset($smt['id'])){ echo 'filter: alpha(opacity=35); -moz-opacity: 0.35; -khtml-opacity: 0.35; opacity: 0.35;'; } ?>" title="Чаша HP и Маны (Восстанавливает полностью Ману и HP, но не чаще 1 раза в 10 минут)"></a>
    <? 
	$pd = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` > '.(time()-600).' AND `vars` = "take_gift'.$dt.'" LIMIT 1',1);
	if(!isset($smt['id']) && !isset($ekgid['id'])) {
	?>
	<a href="?take_gift=<? echo $code; ?>" <? if(isset($pd['id'])){ echo 'onClick="return false;"'; } ?> /><img src="http://img.likebk.com/i/items/<? echo 'podarok2014'; ?>.gif" style="padding:10px;<? if(isset($pd['id'])){ echo 'filter: alpha(opacity=35); -moz-opacity: 0.35; -khtml-opacity: 0.35; opacity: 0.35;'; } ?>" title="Взять `Новогодний подарок <? echo $dt; ?>`"></a>
    <?
	}
	?>
    </div>
	</div>
    <hr>
	<?
	}
	
	if(isset($_GET['page']))
	{
	 $fpage = round($_GET['page']);
	 if($fpage<=0)
	 {
	   $fpage = 1;
	 }
	}else{
	 $fpage = 1;
	}
	$limit1 = ($fpage-1)*20+$fpage-1;
	$limit2 = 21;
	
			  $i = mysql_fetch_array(mysql_query('SELECT COUNT(`year`) FROM `elka` WHERE `year` = "'.$dt.'" AND (`delete` = "0" OR '.$u->info['admin'].' > 0) ORDER BY `id` DESC'));
			  $i = $i[0];
			  $d = ceil($i/21);
			  if($i>0)
			  {
			   if($d<13)
			   {
				$j=0;
				$pagesN = '';
				while($i>=0)
				{
				  $i -= 21;
				  if($i!=0)
				  {			  
				   $j++;
				   $r2 = '';
				   if($j<=$d)
				   {
					if(isset($r))
					{
					  $r2 = '&r='.$r;
					}
					$jt = $j;
					if($fpage==$j)
					{
					 $jt = '<span class="number">'.$j.'</span>';
					}
					$pagesN .= ' <a href="?id='.$post['id'].'&d='.$_GET['d'].'&page='.$j.'" title="Перейти на страницу №'.$j.'">'.$jt.'</a> ';
				   }
				  }
				}
				$pages .= ' '.$pagesN.' ';
			   }else{
				$j = $fpage-6;
				$i = 0;
				$pagesN = '';
				while($k<13)
				{
				 if($j>0)
				 {
				  if($j<=$d)
				  {
				   $jt = $j;
				   if($fpage==$j)
				   {
					 $jt = '<span class="number">'.$j.'</span>';
				   }
				   $pagesN .= ' <a href="?id='.$post['id'].'&d='.$_GET['d'].'&page='.$j.'" title="Перейти на страницу №'.$j.'">'.$jt.'</a> ';
				  }
				  $k++;
				 }
				 $j++;
				}
				$prpage = $fpage-12;
				$nxpage = $fpage+12;
				if($prpage<=0)
				{
				  $prpage = 1;
				}
				if($nxpage>$d)
				{
				  $nxpage = $d;
				}
				$_GET['d'] = (int)$_GET['d'];
				if($fpage-7>0)
				{
				 $pages .= '<a href="?id='.$post['id'].'&d='.$_GET['d'].'&page=1" title="Первая страница">«</a> <a href="?id='.$post['id'].'&d='.$_GET['d'].'&page='.$prpage.'" title="Показать предыдущие страницы">...</a> ';
				}
				$pages .= ' '.$pagesN.' ';
				if($fpage<$d-5)
				{
				 $pages .= '<a href="?id='.$post['id'].'&d='.$_GET['d'].'&page='.$nxpage.'" title="Показать следующие страницы">...</a> <a href="?id='.$post['id'].'&d='.$_GET['d'].'&page='.$d.'" title="Последняя страница">»</a>';
				}
			   }		   
			  }else{
				$pages = '';
			  }
	?>
    <div style="padding:5px;">
	<?
	$sp = mysql_query('SELECT * FROM `elka` WHERE `year`="'.$dt.'" AND `delete` = 0 AND `city`="'.$u->info['city'].'" AND (`delete` = "0" OR '.$u->info['admin'].' > 0) ORDER BY `time` DESC LIMIT '.$limit1.','.$limit2.'');
	$page = floor((int)$_POST['page']);
	if($page<1){ $page = 1; }elseif($page>300){ $page==300; }
	while($pl = mysql_fetch_array($sp))
	{
	  $prs = explode('|',$pl['pers']); $pers = '';
	  if($prs[0]!=0)
	  {
		$pers .= '<img src="http://img.likebk.com/i/align/align'.$prs[0].'.gif">';
	  }
	  if($prs[1]!=0)
	  {
		$clanPrs = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id`="'.$prs[1].'" LIMIT 1'));
		$pers .= '<img src="http://img.likebk.com/i/clan/'.$clanPrs['name_mini'].'.gif">';
	  }
	  $pers .= '<b>'.$prs[2].'</b>['.$prs[3].']<a href="http://likebk.com/inf.php?'.$prs[5].'" title="Инф. о '.$prs[2].'" target="blank"><img src="http://img.likebk.com/i/inf_'.$prs[4].'.gif"></a>';
	  if($pl['delete']!='0')
	  {
		if($pl['delete']=='1')
		{
		  if($u->info['admin']>0)
		  {
			$pl['text'] = '<font color=red><i>Сообщение стерто</i></font> <font color=grey><small>('.$pl['text'].')</small></font>';
		  }else{
		   $pl['text'] = '<font color=red><i>Сообщение стерто</i></font>';
		  }
		}else{
	  $prs = explode('|',$pl['delete']); $pers2 = '';
	  if($prs[0]!=0)
	  {
		$pers2 .= '<img src="http://img.likebk.com/i/align/align'.$prs[0].'.gif">';
	  }
	  if($prs[1]!=0)
	  {
		$clanPrs = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id`="'.$prs[1].'" LIMIT 1'));
		$pers2 .= '<img src="http://img.likebk.com/i/clan/'.$clanPrs['img'].'.gif">';
	  }
	  $pers2 .= '<a href="javascript:top.toUser(\''.$prs[2].'\',\'private\');"><b>'.$prs[2].'</b></a>['.$prs[3].']<a href="http://likebk.com/inf.php?login='.$prs[2].'" title="Инф. о '.$prs[2].'" target="blank"><img src="http://img.likebk.com/i/inf_'.$prs[4].'.gif"></a>';
	  
		  if($u->info['admin']>0 || ($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4))
		  {
			$pl['text'] = '<i><font color=red>Сообщение стерто персонажем</font> '.$pers2.'</i> <font color=grey><small>('.$pl['text'].')</small></font>';
		  }else{
		   $pl['text'] = '<i><font color=red>Сообщение стерто персонажем</font> '.$pers2.'</i>';
		  }
		}
	  }
	  if(($u->info['admin']>0 || ($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4)) && $pl['delete']=='0')
	  {
		$dl = ' <a href="main.php?page='.$_POST['page'].'&del='.$pl['id'].'"><small>Стереть</small></a>';
	  }else{
		$dl = '';
	  }
	  echo '<font class=date>'.date('d.m.Y H:i',$pl['time']).'</font> '.$pers.' - '.$pl['text'].''.$dl.'<BR>';
	}
	?>
    </div>
	Страницы: <? echo $pages; ?><br>
	<FORM method="post" action="main.php">
	 Оставить сообщение: <INPUT type=text name=message maxlength=150 size=50>&nbsp;<INPUT type=submit name=addmessage value='Добавить'>
	</FORM>
	  <td width="280" valign="top"><table cellspacing="0" cellpadding="0">
		<tr>
		  <td width="100%">&nbsp;</td>
		  <td><table  border="0" cellpadding="0" cellspacing="0">
			  <tr align="right" valign="top">
				<td><!-- -->
					<? echo $goLis; ?>
					<!-- -->
					<table border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td nowrap="nowrap"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
							<tr>
							  <td bgcolor="#D3D3D3"><img src="http://img.likebk.com/i/move/links.gif" width="9" height="7" /></td>
							  <td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.9&amp;rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.9',1); ?>">Центральная Площадь</a></td>
							</tr>
						</table></td>
					  </tr>
                      <tr>
						<td nowrap="nowrap"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
							<tr>
							  <td bgcolor="#D3D3D3"><img src="http://img.likebk.com/i/move/links.gif" width="9" height="7" /></td>
							  <td bgcolor="#D3D3D3" nowrap="nowrap"><div align="left"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.209&amp;rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.209',1); ?>">Ледяная пещера</a></div></td>
							</tr>
						</table></td>
					  </tr>
                      <tr>
						<td nowrap="nowrap"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
							<tr>
							  <td bgcolor="#D3D3D3"><img src="http://img.likebk.com/i/move/links.gif" width="9" height="7" /></td>
							  <td bgcolor="#D3D3D3" nowrap="nowrap"><div align="left"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.397&amp;rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.397',1); ?>">Новогодний магазин</a></div></td>
							</tr>
						</table></td>
					  </tr>
                      <tr>
						<td nowrap="nowrap"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
							<tr>
							  <td bgcolor="#D3D3D3"><img src="http://img.likebk.com/i/move/links.gif" width="9" height="7" /></td>
							  <td bgcolor="#D3D3D3" nowrap="nowrap"><div align="left"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.409&amp;rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.409',1); ?>">Ледяной Каток</a></div></td>
							</tr>
						</table></td>
					  </tr>
				  </table></td>
			  </tr>
		  </table></td>
		</tr>
	  </table>
		<br />
	<center></center></td>
	</table>
	<div id="textgo" style="visibility:hidden;"></div>						  
<?
}
?>