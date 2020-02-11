<?php

	header('Content-Type: text/html; charset=windows-1251');
		
	define('GAME',true);
	include('_incl_data/__config.php');	
	include('_incl_data/class/__db_connect.php');
	include('telegramAPI.php');
	
	$apitg = new TelegramAPI;
	
	mysql_query('DELETE FROM `chat` WHERE `time` < "' . ( time()-3600 ) . '" AND `time` > 0');
				
	include('_incl_data/class/__user.php');
	
	$loger_last_uid = $u->info['id'];
	
	include('_incl_data/class/__filter_class.php');
	include('_incl_data/class/__chat_class.php');	
		
	/*
	$lst = mysql_fetch_array(mysql_query('SELECT `id` FROM `online_list` WHERE `time` > "'.(time()-60).'" LIMIT 1'));
	if(!isset($lst['id'])) {
		$x = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `online` > "'.(time()-520).'" AND `real` = 1 AND `pass` NOT LIKE "%saint%" AND `pass` NOT LIKE "%online%" LIMIT 1'));
		$x = $x[0];
		mysql_query('INSERT INTO `online_list` (`time`,`online`,`date`) VALUES ("'.time().'","'.$x.'","'.date('d.m.Y H:i').'")');
	}
	*/
		
	if(isset($_GET['list_online'])) {
		$mx1 = mysql_fetch_array(mysql_query('SELECT * FROM `online_list` ORDER BY `online` DESC LIMIT 1'));
		$mx2 = mysql_fetch_array(mysql_query('SELECT * FROM `online_list` ORDER BY `online` ASC LIMIT 1'));
		echo 'Максимальный онлайн за все время: '.$mx1['online'].' за '.$mx1['date'].'<Br>';
		echo 'Минимальный онлайн за все время: '.$mx2['online'].' за '.$mx2['date'].'<Br>';
	?>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div id="chart_div"></div>
    <script>
	google.charts.load('current', {packages: ['corechart', 'line']});
	google.charts.setOnLoadCallback(drawBasic);
	
	function drawBasic() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'X');
      data.addColumn('number', 'Онлайн');

      data.addRows([
        <?
		$h = '';
		$i = 0;
		$sp = mysql_query('SELECT * FROM `online_list` WHERE `date` LIKE "'.date('d.m.Y').'%" GROUP BY `date` ORDER BY `id` ASC');
		while( $pl = mysql_fetch_array($sp) ) {
			$h .= ',['.$i.','.$pl['online'].']';
			$i++;
		}
		$h = ltrim($h,',');
		echo $h;
		?>
      ]);

      var options = {
        hAxis: {
          title: 'Время'
        },
        vAxis: {
          title: 'Онлайн за сегодня'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
	</script>
    <?
		die();
	}
	
	if(!isset($u->info['id']) || $u->info['banned']>0)
	{
		die(json_encode(array('js'=>'top.location="club.php?exit='.$code.'";')));
	}elseif($u->info['ip']!=$_SERVER['HTTP_X_REAL_IP'])
	{
		
	}
	
	if($u->info['repass'] > 0) {
		die();
	}
		
	if($u->info['bithday'] == '01.01.1800') {
		unset($_GET['msg'],$_POST['msg'],$_POST['warnMsg']);
		$_GET['r3'] = 1;
	}
	
	if( $u->info['admin'] == 0 ) {
		unset($_GET['r3']);
	}
	
	if($u->info['online'] < time() - 60)	{
		mysql_query('UPDATE `users` SET `online` = '.time().' WHERE `id` = "'.$u->info['id'].'" LIMIT 1');	
		$filter->setOnline($u->info['online'],$u->info['id'],0);
		$u->onlineBonus();			
	}
	
	
	if(isset($_POST['delMsg']) && ($u->info['admin']>0 || ($u->info['align']>1.1 && $u->info['align']<1.999) || ($u->info['align']>3 && $u->info['align']<4)))
	{
		if(((int)$_POST['delMsg']) > 0) {
			mysql_query('UPDATE `chat` SET `delete` = "'.$u->info['id'].'" WHERE `id` = "'.mysql_real_escape_string(((int)$_POST['delMsg'])).'" LIMIT 1');
		}else{
			mysql_query('UPDATE `users` SET `molch3` = "'.(time()+3600*3).'" WHERE `id` = "'.mysql_real_escape_string(-((int)$_POST['delMsg'])).'" LIMIT 1');
		}
	}
	
	$r = array(
		'rnd'=>$code,
		'rn'=>NULL,
		'list'=>NULL,
		'msg'=>NULL,
		'key'=>NULL,
		'js'=>NULL,
		'xu'=>0
	);
	
	if(isset($_POST['warnMsg'])) {
		/* Жалоба на сообщение в чате */
		//if($u->info['molch3'] < time()) {
			$dm = mysql_fetch_array(mysql_query('SELECT * FROM `chat` WHERE `id` = "'.mysql_real_escape_string($_POST['warnMsg']).'" AND `delete` = "0" LIMIT 1'));
			if(isset($dm['id'])) {
				if($dm['jalo'] == 0) {
					mysql_query('UPDATE `chat` SET `jalo` = "'.$u->info['id'].'" WHERE `id` = "'.$dm['id'].'" LIMIT 1');
					if($dm['to'] != '') {
						$dm['to'] = '[<b>'.$dm['to'].'</b>] ';
						if($dm['type'] == 3) {
							$dm['to'] = '<font color=red><b>private '.$dm['to'].'</b></font>';
						}else{
							$dm['to'] = 'to '.$dm['to'];
						}
					}
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$u->info['city']."','0','','',
					'[<a <a onMouseDown=\\\\\"top.loginGo(\'".$u->info['login']."\',event);\\\\\" oncontextmenu=\\\\\"top.infoMenu(\'".$u->info['login']."\',event,\'chat\'); return false;\\\\\" title=\\\\\"".$u->info['login']."\\\\\" style=\\\\\"cursor:pointer;\\\\\" onClick=\\\\\"chat.multiAddto(\'".$u->info['login']."\',\'to\');\\\\\">".$u->info['login']."</a>], сообщает о нарушении: <span class=date2>&nbsp;".date('d.m.Y H:i')."&nbsp;</span> [<a <a onMouseDown=\\\\\"top.loginGo(\'".$dm['login']."\',event);\\\\\" oncontextmenu=\\\\\"top.infoMenu(\'".$dm['login']."\',event,\'chat\'); return false;\\\\\" title=\\\\\"".$dm['login']."\\\\\" style=\\\\\"cursor:pointer;\\\\\" onClick=\\\\\"chat.multiAddto(\'".$dm['login']."\',\'to\');\\\\\">".$dm['login']."</a>]<font color=".$dm['color']."> ".$dm['to'].$dm['text']."</font> &nbsp; &nbsp; <small>(<a href=\'javascript:void(0)\' onclick=\'top.chat.deleteMessage(".$dm['id'].")\'>Стереть сообщение</a> / <a href=\'javascript:void(0)\' onclick=\'top.chat.deleteMessage(-".$u->info['id'].")\'>Отказ</a>)</small>'
					,'-1','8','0')");
				}else{
					
				}
			}
		//}else{
			$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>Жалоба на сообщение было успешно отправлено и скоро будет обработано модераторами.</small>","Black","1","1","0"]);';	
		//}
	}
	
	$u->onlineBonus();
		
	if($u->info['battle'] > 0) {
		$btl = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle` WHERE `id` = "'.$u->info['battle'].'" AND `time_over` = 0 LIMIT 1'));
		if(!isset($btl['id'])) {
			//$r['js'] .= 'top.frames["main"].location="main.php";';
		}
	}
	

//Отправляем сообщения
	if(isset($_POST['msg']) && str_replace(' ','',$_POST['msg'])!='')
	{
		$msg = array();
		$_POST['msg'] = str_replace('\x3C','<',$_POST['msg']);
		$_POST['msg'] = str_replace('\x3','>',$_POST['msg']);
		$_POST['msg'] = iconv('UTF-8', 'windows-1251', $_POST['msg']);
		if(stristr($_POST['msg'],'buttons.php') == true &&  stristr($_POST['msg'],'exit') == true ) {
			$_POST['msg'] = str_replace('exit','еxit',$_POST['msg']);
		}
				function tolink($buf) {
			$x=explode(" ",$buf);
			$newbuf='';
			for ($j=0; $j<count($x); $j++) {
			 if (preg_match("/(http:\\/\\/)?([a-z_0-9-.]+\\.likebk+\\.com(([ \"'>\r\n\t])|(\\/([^ \"'>\r\n\t]*)?)))/",$x[$j],$ok) || preg_match("/(http:\\/\\/)?(likebk+\\.com(([ \"'>\r\n\t])|(\\/([^ \"'>\r\n\t]*)?)))/",$x[$j],$ok))
				$newbuf.=str_replace($ok[2],"<small><a href=http://$ok[2] target=_blank ><i>[Внутренняя ссылка]</i></a></small>",
									   str_replace("http://","",$x[$j]))." ";
			 else
			 $newbuf.=$x[$j]." ";
			}
			return $newbuf;
		}
		$_POST['msg'] = $chat->expworld($_POST['msg'],120);
		$_POST['msg'] = str_replace('\\','\\\\',$_POST['msg']);
		$_POST['msg'] = str_replace('"','[s1;]',$_POST['msg']);
		$_POST['msg'] = str_replace("'",'[s2;]',$_POST['msg']);
		$_POST['msg'] = str_replace('<','[s3;]',$_POST['msg']);
		$_POST['msg'] = str_replace('>','[s4;]',$_POST['msg']);
		$_POST['msg'] = str_replace('	',' ',$_POST['msg']);
		$_POST['msg'] = htmlspecialchars($_POST['msg'],NULL,'cp1251');
		$_POST['msg'] = str_replace('%usersmile%','',$_POST['msg']);
		$_POST['msg'] = tolink($_POST['msg']);
		
		$_POST['msg'] = str_replace('::','',$_POST['msg']);
		
		$_POST['msg'] = str_replace('[s1;]','&quot;',$_POST['msg']);
		$_POST['msg'] = str_replace("[s2;]",'&quot;',$_POST['msg']);
		$_POST['msg'] = str_replace('[s3;]','&lt;',$_POST['msg']);
		$_POST['msg'] = str_replace('[s4;]','&gt;',$_POST['msg']);
		
		$_POST['msg_test'] = $_POST['msg'];
		
		//$lmg = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `chat` WHERE `login` = "'.$u->info['login'].'" AND `time` > '.(time()-2).' LIMIT 2'));
		$lmg[0] = 0;
		if($lmg[0] > 0) {
			$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>Вы не можете отправлять так часто сообщения... </small>","Black","1","1","0"]);';
			if($u->info['molch1'] < time()) {
				if($u->info['molch1'] < -5) {
					//Молчанка за флуд на 5 минут
					$u->info['molch1'] = time()+300;
					$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>Вы наказаны за флуд на 5 минут </small>","Black","1","1","0"]);';					
				}elseif($u->info['molch1'] < 0) {
					$u->info['molch1']--;
				}else{
					$u->info['molch1'] = -1;
				}
				mysql_query('UPDATE `users` SET `molch1` = "'.$u->info['molch1'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			}
		}elseif($chat->str_count($_POST['msg'],9)=='#нашелбаг')
		{
			//Информация по чату daikrfx()
			$r['js'] .= '$("#ball").show();';
		}elseif($chat->str_count($_POST['msg'],6)=='#дайкр')
		{
			//Информация по чату daikrfx()
			$r['js'] .= 'daikrfx();';
		}elseif($chat->str_count($_POST['msg'],9)=='#babybaby' && $u->info['sex'] == 0)
		{
			//Информация по чату
			$r['js'] .= '$("#girl").show();';
		}elseif($chat->str_count($_POST['msg'],5)=='/help' || $chat->str_count($_POST['msg'],2)=='/[')
		{
			//Информация по чату
			include('help.php');
		}elseif($chat->str_count($_POST['msg'],4)=='/afk')
		{
			$_POST['msg'] = str_replace('/afk','',$_POST['msg']);
			$_POST['msg'] = htmlspecialchars($_POST['msg'],NULL,'cp1251');
			$_POST['msg'] = ' '.$_POST['msg'].' ';
			if($_POST['msg']=='')
			{
				$_POST['msg'] = 'away from keyboard';
			}
			mysql_query('UPDATE `users` SET `dnd` = "",`afk` = "'.mysql_real_escape_string($_POST['msg']).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>Успешно выставлен <b>/afk</b> статус: <i>'.$_POST['msg'].'</i></small>","Black","1","1","0"]);';
		}elseif($chat->str_count($_POST['msg'],2)=='/g' && $u->info['admin']>0)
		{
			$_POST['msg'] = str_replace('/g',' ',$_POST['msg']);
			$_POST['msg'] = str_replace('{m}','<b>'.$u->info['login'].'</b>: ',$_POST['msg']);
				mysql_query('INSERT INTO `chat` (`invis`,`da`,`delete`,`molch`,`new`,`login`,`to`,`city`,`room`,`time`,`type`,`spam`,`text`,`toChat`,`color`,`typeTime`,`sound`,`global`) VALUES (
				"'.$u->info['invis'].'",
				"1",
				"0",
				"0",
				"1",
				"",
				"",
				"'.$u->info['city'].'",
				"0",
				"'.time().'",
				"6",
				"0",
				"'.mysql_real_escape_string($_POST['msg']).'",
				"0",
				"red",
				"0",
				"0",
				"0")');
		}elseif($chat->str_count($_POST['msg'],4)=='/dnd')
		{
			$_POST['msg'] = str_replace('/dnd','',$_POST['msg']);
			if($_POST['msg']=='')
			{
				$_POST['msg'] = 'do not disturb';
			}
			$_POST['msg'] = htmlspecialchars($_POST['msg'],NULL,'cp1251');
			$_POST['msg'] = ' '.$_POST['msg'].' ';
			mysql_query('UPDATE `users` SET `afk` = "",`dnd` = "'.mysql_real_escape_string($_POST['msg']).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>Успешно выставлен <b>/dnd</b> статус: <i>'.$_POST['msg'].'</i></small>","Black","1","1","0"]);';
		}else{
			//Записываем данные
			$msg['time'] = time();
			$msg['spam'] = 0;
			$msg['type'] = 1;
			$msg['toChat'] = 0;
			$msg['color'] = 'Black';
			$msg['typeTime'] = 0;
			$msg['sound'] = 0;
			$msg['global'] = 0;
			$msg['molch'] = 0;
			$msg['login'] = $u->info['login'];
			$msg['cancel'] = 0;
			$msg['delete'] = 0;
			$msg['to'] = '';
			$msg['da'] = 0;
			
			/*
			if(isset($_COOKIE['chatCfg1']))
			{
				if($u->info['admin']=='0' && !($_COOKIE['chatCfg1'] == "Black" || $_COOKIE['chatCfg1'] == "Blue" || $_COOKIE['chatCfg1'] == "Lilac" ||  $_COOKIE['chatCfg1'] == "Fuchsia" || $_COOKIE['chatCfg1'] == "Gray" || $_COOKIE['chatCfg1'] == "Green" || $_COOKIE['chatCfg1'] == "Maroon" || $_COOKIE['chatCfg1'] == "Navy" || $_COOKIE['chatCfg1'] == "Olive" || $_COOKIE['chatCfg1'] == "Purple" || $_COOKIE['chatCfg1'] == "Teal" ||  $_COOKIE['chatCfg1'] == "Orange" ||  $_COOKIE['chatCfg1'] == "Chocolate" || $_COOKIE['chatCfg1'] == "DarkKhaki" || $_COOKIE['chatCfg1'] == "SandyBrown"))
				{
					//Нельзя писать данным цветом
					$_COOKIE['chatCfg1'] = 'Black';
					$msg['color'] = $_COOKIE['chatCfg1'];
					setcookie('chatCfg1','Black',time()+2592000,'',$c['host']);
				}else{
					$msg['color'] = $_COOKIE['chatCfg1'];
				}
			}
			*/
			$msg['color'] = $u->info['chatColor'];
			
			$newfilt = false;			
			$test1 = '';
			
			function onlyaz($txt) {
				$txt = str_split($txt);
				$ntxt = '';
				$test = str_split('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNMёйцукенгшщзхъфывапролджэячсмитьбюЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮ');
				$i = 0;
				while( $i < count($txt) ) {
					$j = 0;
					while( $j < count($test) ) {
						if( $test[$j] == $txt[$i] ) {
							$ntxt .= $test[$j];
						}
						$j++;
					}
					$i++;
				}				
				return $ntxt;
			}
			
			//Нормируем типы сообщений
			if(preg_match("/private\[(.*?)\]/", $_POST['msg'], $msg['to']))
			{
				$msg['to'] = $msg['to'][1];
				$_POST['msg'] = str_replace('private['.$msg['to'].']','private ['.$msg['to'].']',$_POST['msg']); $msg['to'] = '';
			}elseif(preg_match("/to\[(.*?)\]/", $_POST['msg'], $msg['to']))
			{
				$msg['to'] = $msg['to'][1];
				$_POST['msg'] = str_replace('to['.$msg['to'].']','to ['.$msg['to'].']',$_POST['msg']); $msg['to'] = '';
			}
			
			if(preg_match("/private \[(.*?)\]/", $_POST['msg'], $msg['to'])) 
			{
				$msg['to'] = trim($msg['to']['1'],' '); $msg['type'] = 3; $_POST['msg'] = str_replace('private ['.$msg['to'].']',' ',$_POST['msg']);
			}elseif(preg_match("/to \[(.*?)\]/", $_POST['msg'], $msg['to'])) 
			{
				$msg['to'] = trim($msg['to']['1'],' '); $msg['type'] = 2; $_POST['msg'] = str_replace('to ['.$msg['to'].']',' ',$_POST['msg']);
			}
			
			if( $u->info['level'] < 8 || $u->info['id'] == 12345 ) {
				$txt2 = $_POST['msg'];				
				$txt2 = onlyaz($txt2);
				$sp = mysql_query('SELECT * FROM `filter_text` ORDER BY `id` DESC');
				while( $pl = mysql_fetch_array($sp) ) {
					$txt3 = $pl['text'];
					$txt3 = onlyaz($txt3);
					$prc = 0;
					similar_text($txt3,$txt2,$prc);
					$prc = round($prc,2);
					if( $prc > 70 ) {
						$test1 .= '['.$pl['id'].':'.$prc.']';
					}
				}
				if( $test1 != '' ) {
					mysql_query('INSERT INTO `filter_text_test` (`uid`,`time`,`text`,`block`) VALUES (
						"'.$u->info['id'].'","'.time().'","'.mysql_real_escape_string($_POST['msg']).'","'.$test1.'"
					)');
					$newfilt = true;
				}
			}
			
			if( $newfilt == true ) {
				
				$msg['spam'] = 1; $msg['delete'] = 1;
				$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>В нашем чате запрещается рекламировать атльтернативные проекты. Повторные попытки могут привести к блокировке персонажа.</small>","Black","1","1","0"]);';
				
			}elseif($u->info['admin'] == 0  || true == true) {
				$msg['fspam'] = $filter->spamFiltr(str_replace('точка','.',$_POST['msg']));
				if($msg['fspam']!='0')
				{
					$msg['spam'] = 1; $msg['delete'] = 1;
					$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>['.$msg['fspam'].'] В нашем чате запрещается сообщать ссылки на атльтернативные проекты. Повторные попытки могут привести к блокировке персонажа.</small>","Black","1","1","0"]);';
				}
				
				if($msg['spam'] == 1)
				{
					$mban = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time` >= '.strtotime('now 00:00:00').' AND `vars` = "msg_bans" LIMIT 1',1);
					if(!isset($mban['id']))
					{
						$u->addAction(time(),'msg_bans','1');
						$mban['vals'] = 0;
					}else{
						mysql_query('UPDATE `actions` SET `vals` = `vals` + 1 WHERE `id` = "'.$mban['id'].'" LIMIT 1');
						$msg['delete'] = time();
					}	
					
					//if($mban['vals']+1 < 2)
					//{
						$msg['fspam'] = str_replace('%','</b>,<b>',$msg['fspam']);
						$msg['fspam'] = '<b>'.ltrim($msg['fspam'],'0</b>,<b>').'</b>';
						$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>В нашем чате запрещается сообщать ссылки на атльтернативные проекты. Запрещенные слова: '.$msg['fspam'].'. Предупреждения ['.($mban['vals']+1).'/1]</small>","Black","1","1","0"]);';
					//}else{
					//	$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>В нашем чате запрещается сообщать ссылки на атльтернативные проекты. Вы наказаны за нарушение правил общения.</small>","Black","1","1","0"]);';
					//	mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$u->info['city']."','0','','','<b>Автоинформатор</b>: Персонаж ".$u->info['login']." [".$u->info['level']."] был наказан за нарушение правил общения.','-1','6','0')");
					//	mysql_query('UPDATE `users` SET `molch1` = "'.(time()+1*60*60).'",`molch2` = "'.(time()+1*60*60).'",`info_delete` = "'.(time()+1*60*60).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					//	$rtxt = $rang.' &quot;'.$u->info['login'].'&quot; <small><font color=red>Автоинформатор</font></small>: '.$msg['text'].' ['.$msg['fspam'].'].';
					//	mysql_query("INSERT INTO `users_delo` (`uid`,`ip`,`city`,`time`,`text`,`login`,`type`) VALUES ('".$u->info['id']."','".$_SERVER['REMOTE_ADDR']."','".$u->info['city']."','".time()."','".$rtxt."','".$u->info['login']."',0)");
					//}
				}
			}
				
			//Нормируем типы сообщений
			/*if(preg_match("/private\[(.*?)\]/", $_POST['msg'], $msg['to']))
			{
				$msg['to'] = $msg['to'][1];
				$_POST['msg'] = str_replace('private['.$msg['to'].']','private ['.$msg['to'].']',$_POST['msg']); $msg['to'] = '';
			}elseif(preg_match("/to\[(.*?)\]/", $_POST['msg'], $msg['to']))
			{
				$msg['to'] = $msg['to'][1];
				$_POST['msg'] = str_replace('to['.$msg['to'].']','to ['.$msg['to'].']',$_POST['msg']); $msg['to'] = '';
			}
			
			if(preg_match("/private \[(.*?)\]/", $_POST['msg'], $msg['to'])) 
			{
				$msg['to'] = trim($msg['to']['1'],' '); $msg['type'] = 3; $_POST['msg'] = str_replace('private ['.$msg['to'].']',' ',$_POST['msg']);
			}elseif(preg_match("/to \[(.*?)\]/", $_POST['msg'], $msg['to'])) 
			{
				$msg['to'] = trim($msg['to']['1'],' '); $msg['type'] = 2; $_POST['msg'] = str_replace('to ['.$msg['to'].']',' ',$_POST['msg']);
			}*/
					
			/*				
			if($u->info['admin']>0 || ($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4) || $u->info['align']==50) {
			if($_COOKIE['chatCfg11']>0 && $u->info['molch1']<time() && ($msg['type'] == 1 || $msg['type'] == 2) && $u->info['active']=='')
			{
				if($u->info['align']!=2)
				{
					if($u->info['money']>=0.50)
					{
						$msg['global'] = 1;
						$u->info['money'] -= 0.50;
						mysql_query('UPDATE `users` SET `money` = `money` - 0.5 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					}else{
						$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>Одно сообщение в <b>Глобальный чат</b> стоит 0.50 кр., у Вас недостаточно средств, чтобы это сообщение больше не появлялось выключите глобавильный чат, либо пополните баланс.</small>","Black","1","1","0"]);';
					}
				}else{
					$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>Персонажам в хаосе запрещается общаться в <b>Глобальном чате</b></small>","Black","1","1","0"]);';
					$msg['cancel']++;
				}
			}
			}
			*/
			$qix = mysql_fetch_array(mysql_query('SELECT `id` FROM `friends` WHERE `ignor` > 0 AND `login_ignor` = "'.mysql_real_escape_string($u->info['login']).'" AND `user_ignor` = "'.mysql_real_escape_string($msg['to']).'" LIMIT 1'));
			if(isset($qix['id'])) {
				$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<b>Вас добавили в игнор</b>: Вы не можете отправлять сообщения персонажу &quot;'.htmlspecialchars($msg['to']).'&quot;.","Black","1","1","0"]);';
				$msg['cancel']++;
			}elseif($msg['type'] == 3 && $u->info['activ'] > 0)
			{
				$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>Отправлять сообщения в <b>приват</b> могут только персонажи подтвердившие свой e-mail.</small>","Black","1","1","0"]);';
				$msg['cancel']++;
			}elseif($msg['type'] == 3 && $u->info['level']<0)
			{
				$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>Отправлять сообщения в <b>приват</b> могут персонажи старше нулевого уровня.</small>","Black","1","1","0"]);';
				$msg['cancel']++;
			}elseif($msg['type']==3 && $u->info['active']!='')
			{
				$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>Отправлять сообщения в <b>приват</b> могут только активированные персонажи.</small>","Black","1","1","0"]);';
				$msg['cancel']++;
			}
			
			if( mb_strtolower($msg['to']) == 'klan' ) {
				$msg['to'] = 'klan';
				$msg['type'] = 3;
			}
			
			if($msg['type'] == 3 && $msg['to'] == 'klan')
			{
				if($u->info['clan']==0)
				{
					$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>Вы не являетесь частью одного из <b>Кланов</b> и не можете общаться по этому каналу.</small>","Black","1","1","0"]);';
					$msg['cancel']++;
				}else{
					$msg['to'] = 'k'.$u->info['clan'];
					$msg['da'] = 1;
					$msg['type'] = -3;
				}
			}elseif($msg['type'] == 3 && $msg['to'] == 'paladins')
			{
				if($u->info['align']<=1 || $u->info['align']>=2 || $u->info['align'] == 1.6 || $u->info['align'] == 1.4 || $u->info['align'] == 1.59)
				{
					$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>Вы не являетесь частью <b>Ордена Света</b> и не можете общаться по этому каналу.</small>","Black","1","1","0"]);';
					$msg['cancel']++;
				}elseif($u->info['align'] == 1.1)
				{
					$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>У вас недостаточно прав для использования пал-чата!</small>","Black","1","1","0"]);';
					$msg['cancel']++;
				}else{
					//Все ок
					$msg['type'] = -3;
				}
			}elseif($msg['type'] == 3 && $msg['to'] == 'tarmans')
			{
				if($u->info['align']<=3 || $u->info['align']>=4)
				{
					$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>Вы не являетесь частью <b>Армады</b> и не можете общаться по этому каналу.</small>","Black","1","1","0"]);';
					$msg['cancel']++;
				}else{
					//Все ок
					$msg['type'] = -3;
				}
			}
						
			if($u->info['molch1']>time())
			{
				$msg['molch'] = 1;
			}			
			
			function testNewSpam($txt) {
				$r = 0;
				//
				$txtnew = $txt;
				$spam = mysql_fetch_array(mysql_query('SELECT * FROM `spam_word` WHERE `id` = 1 LIMIT 1'));
				$spam = explode('|',$spam['data']);	
				$txt = str_replace(' ','',preg_replace ("/[^a-zA-ZА-Яа-я0-9\s]/","",$txt));			
				//
				$i = 0;
				while( $i < count($spam) ) {
					$ssw = str_replace(' ','',preg_replace ("/[^a-zA-ZА-Яа-я0-9\s]/","",$spam[$i]));
					if( strripos($txt,$ssw) == true ) {
						$txtnew = str_replace($spam[$i],'<b><font color=red>&lt;ВЦ&gt;</font></b>',$txtnew);
					}
					$i++;
				}
				//
				return $txtnew;
			}	
			
			$_POST['msg'] = testNewSpam($_POST['msg']);	
			//
			if($msg['cancel']==0)
			{
				if(is_array($msg['to']))
				{
					$msg['to'] = '';
				}
				if($msg['type']==3 && $msg['da']>0)
				{
					$msg['type'] = -3;
				}
				
				$msw = $chat->smileText($_POST['msg'],$msg['to'],$u->info['room'],$u->info['city']);				
				$nosend = 0;
				if($msw != false)
				{
					$_POST['msg'] = $msw;
					$msg['to']   = '';
					$msg['type'] = 21;
					if($msw == 'USER IS FALSE')
					{
						$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>Персонажа нет в данной комнате.</small>","Black","1","1","0"]);';
						$nosend = 1;
					}
				}elseif($chat->str_count($_POST['msg'],3) == '/e ')
				{
					$msg['type'] = 21;
					$_POST['msg'] = ltrim($_POST['msg'],'/e ');						
				}elseif($chat->str_count($_POST['msg'],3) == '/е ')
				{
					$msg['type'] = 21;
					$_POST['msg'] = ltrim($_POST['msg'],'/е ');						
				}elseif($chat->str_count($_POST['msg'],7) == '/sound ')
				{
					$msg['type'] = 21;
					$_POST['msg'] = ltrim($_POST['msg'],'/sound ');
					$msg['sound'] = $_POST['msg'];			
				}
				
				if( $u->info['molch1'] > time() ) {
					$nosend = 1;
				}
				
				if($nosend == 0) {
					
					//Именные смайлики
					$_POST['msg'] = str_replace('%usersmile%-','%usеrsmilе%-',$_POST['msg']);							
					$usml = explode(',',$u->info['add_smiles']);
					$i = 0;
					while($i < count($usml)) {
						$_POST['msg'] = str_replace(':'.$usml[$i].':',':%usersmile%-'.$usml[$i].':',$_POST['msg']);
						$i++;
					}
					
					$activ = 0;
					if($u->info['activ'] > 0) {
						$activ = 1;
					}
					
					$test_tg = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `login` = "'.mysql_real_escape_string($msg['to']).'" ORDER BY `id` ASC LIMIT 1'));
					if(isset($test_tg['id'])) {
						$test_tg = mysql_fetch_array(mysql_query('SELECT * FROM `telegram_user` WHERE `uid` = "'.$test_tg['id'].'" LIMIT 1'));
						if(isset($test_tg['id'])) {
							//Отправляем в телеграмм
							//
							$htmltg = '';
							//$_POST['msg'] .= ' (<small>Сообщение отправлено в телеграмм</small>)';
							//
							$htmltg = date('d.m.Y H:i') . ' ['.$msg['login'].'] ' . $_POST['msg_test'];
							//
							$keyboardtg = array(
								array( iconv('CP1251','UTF-8','Обновить') )
							);
							$resptg = array("keyboard" => $keyboardtg,"resize_keyboard" => true,"one_time_keyboard" => true);
							$replytg = json_encode($resptg);
							//
							$input = $apitg->callAPI(
								'sendMessage', array(
									'chat_id'		=> $test_tg['chat_room'],
									'text'			=> iconv('CP1251','UTF-8',$htmltg),
									'reply_markup'	=> $replytg
								)
							);
							//
						}
					}
					
					$msg_test = mysql_fetch_array(mysql_query('SELECT `id` FROM `chat` WHERE `time` = "'.time().'" AND `type` < 4 LIMIT 1'));
					
					if( $msg['to'] == '' ) {
						$msg['type'] = 1;
					}
					
					if(date('d.m.Y') == '05.12.2018') {
						$_POST['msg'] = str_ireplace('соси','<font color=red><i>&lt;ВЦ&gt;</i></font>',$_POST['msg'].' ');
						$_POST['msg'] = str_ireplace('с о с и','<font color=red><i>&lt;ВЦ&gt;</i></font>',$_POST['msg'].' ');
						$_POST['msg'] = str_ireplace('сосать','<font color=red><i>&lt;ВЦ&gt;</i></font>',$_POST['msg'].' ');
						$_POST['msg'] = str_ireplace('сосите','<font color=red><i>&lt;ВЦ&gt;</i></font>',$_POST['msg'].' ');
						//$_POST['msg'] = preg_replace("/(соси)/iu","<font color=red><i>&lt;ВЦ&gt;</i></font>",$_POST['msg']);
					}
					
					mysql_query('INSERT INTO `chat` (`active`,`invis`,`da`,`delete`,`molch`,`new`,`login`,`to`,`city`,`room`,`time`,`type`,`spam`,`text`,`toChat`,`color`,`typeTime`,`sound`,`global`) VALUES (
					"'.$activ.'",
					"'.$u->info['invis'].'",
					"'.$msg['da'].'",
					"'.$msg['delete'].'",
					"'.$msg['molch'].'",
					"1",
					"'.$msg['login'].'",
					"'.mysql_real_escape_string($msg['to']).'",
					"'.$u->info['city'].'",
					"'.$u->info['room'].'",
					"'.$msg['time'].'",
					"'.$msg['type'].'",
					"'.$msg['spam'].'",
					"'.mysql_real_escape_string($_POST['msg']).'",
					"'.$msg['toChat'].'",
					"'.$msg['color'].'",
					"'.$msg['typeTime'].'",
					"'.$msg['sound'].'",
					"'.$msg['global'].'")');
					
					/*
					if(!isset($msg_test['id'])) {
						if(!isset($socketio)) {
							include_once ('socket.io.php');
							$socketio = new SocketIO();
						}
						$socketio->send('localhost', 8081, 'message', 'reflesh-chat-'.time());
					}
					*/
					
					if( mb_strtolower($msg['to']) == 'баба маня' ) {
						$mnq = mysql_fetch_array(mysql_query('SELECT * FROM `aaa_many_now` WHERE `time` > "'.time().'" AND `uid_win` = "0" LIMIT 1'));
						if( $u->info['id'] == 1012655 ) {
							$r['js'] .= 'chat.sendMsg(["new","'.time().'","6","","'.$u->info['login'].'","<small>:-) Мы же договаривались! Тебе нельзя отвечать на эти вопросы! ;)</small>","Black","1","1","0"]);';
							$msg['cancel']++;
						}elseif( isset($mnq['id']) ) {
							//Пробуем ответить на вопросы!							
							$lmv = mysql_fetch_array(mysql_query('SELECT * FROM `aaa_many` WHERE `id` = "'.$mnq['qid'].'" LIMIT 1'));
							if( isset($lmv['id']) ) {
								//$this->getStats($uid,$i1);
								$imn = 0; $imgd = 0;
								$imna = explode(',',mb_strtolower( $lmv['answer'] ));
								while($imn < count($imna)) {
									if( mb_strtolower(trim($imna[$imn],' ')) == mb_strtolower( trim($_POST['msg'],' ') ) ) {
										$imgd = 1;
									}
									$imn++;
								}
								if( mb_strtolower( $lmv['answer'] ) == mb_strtolower( trim($_POST['msg'],' ') ) || $imgd == 1 ) {
									//правильный ответ
									mysql_query('UPDATE `aaa_many_now` SET `uid_win` = "'.$u->info['id'].'" WHERE `id` = "'.$mnq['id'].'" LIMIT 1');
									mysql_query('UPDATE `chat` SET `delete` = "'.time().'",`time` = "'.time().'" WHERE `login` = "Баба Маня" AND `time` < 0 LIMIT 1');
									if( $lmv['bank'] == 0 ) {
										$mntext = '<font color=red>У нас есть победитель! <b>'.$u->info['login'].'</b> получает '.$lmv['money'].' кр.!</font>';
										$u->info['money'] += $lmv['money'];
										mysql_query('UPDATE `users` SET `money` = `money` + "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
									}else{
										$mntext = '<font color=red>У нас есть победитель! <b>'.$u->info['login'].'</b> получает '.$lmv['money'].' екр. на свой банковский счет!</font>';
										mysql_query('UPDATE `bank` SET `money2` = `money2` + "'.$lmv['money'].'" WHERE `uid` = "'.$u->info['id'].'" AND `block` = "0" ORDER BY `useNow` DESC LIMIT 1');
									}
									$sp_znm = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `aaa_many_now` WHERE `uid_win` = "'.$u->info['id'].'" LIMIT 1'));
									if( $sp_znm[0] > 5 ) {
										$txt = 'И кто здесь самый умный?<br>Правильных ответов: '.$sp_znm[0];
										mysql_query('DELETE FROM `users_ico` WHERE `uid` = "'.mysql_real_escape_string($u->info['id']).'" AND `img` = "realbrain.gif"');
										mysql_query('INSERT INTO `users_ico` (`uid`,`time`,`text`,`img`,`endTime`,`type`,`bonus`) VALUES (
											"'.mysql_real_escape_string($u->info['id']).'",
											"'.time().'",
											"'.mysql_real_escape_string($txt).'",
											"realbrain.gif",
											"0",
											"2",
											""
										)');
										mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','<font color=red><b>Вы совершили подвиг:</b> ".mysql_real_escape_string($txt)."</font>','-1','6','0')");
									}
									mysql_query('INSERT INTO `chat` (`text`,`city`,`login`,`to`,`type`,`new`,`time`,`room`) VALUES ("'.mysql_real_escape_string($mntext).'","capitalcity","Баба Маня","","1","1","'.time().'","3")');
								}else{
									//не правильный ответ
									//$mntext = '<b>'.$u->info['login'].'</b>, '.mb_strtolower( trim($_POST['msg'],' ') ).'!';
									//mysql_query('INSERT INTO `chat` (`text`,`city`,`login`,`to`,`type`,`new`,`time`,`room`) VALUES ("'.mysql_real_escape_string($mntext).'","capitalcity","Баба Маня","","1","1","'.time().'","3")');
								}
							}
						}
						unset($lmv,$mnq,$mntext);
					}
				}
			}	
/*			$msd = mb_detect_encoding($msg['to']);
			$msd .= " = ".$msg['to'];
			$msd .= mb_convert_case($msg['to'], MB_CASE_LOWER, "cp1251").' == комментатор';
			if($u->info['id'] == "155"){
				mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','".$msd ."','-1','6','0')");
			}*/
			if($msg['type'] == 2 && true == false && mb_convert_case($msg['to'], MB_CASE_LOWER, "cp1251") == 'комментатор') {				
				if(preg_match("/анекдот/i",mb_convert_case($_POST['msg'], MB_CASE_LOWER, "cp1251"))) {
					//$com_act = 0;
					$text_com = '';
					$sp_all = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `a_com_act` WHERE `act` = "'.$com_act.'" AND `time` > "'.time().'" LIMIT 5'));
					if($sp_all[0] > 0) {
						if(rand(0,100) < 75) {
							$text_com = array(
								'Отстань попрошайка! ... Ищу анекдоты, интернет не маленький!',
								'Подожди... Сейчас что-нибудь найду',
								'Почти нашел...',
								'Вот один есть, но он не интересный...',
								'А свет на центральной площади тьму &quot;пинает&quot;... Эх...'
							);
							$text_com = $text_com[rand(0,(count($text_com)-1))];
						}
					}else{
						$sp_all = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `a_com_anekdot`'));
						$sp_all = rand(1,$sp_all[0]);
						$sp_all = mysql_fetch_array(mysql_query('SELECT * FROM `a_com_anekdot` WHERE `id` = "'.$sp_all.'" LIMIT 1'));
						if(isset($sp_all['id'])) {
							$text_com = $sp_all['text'];
							$text_com = str_replace("<br>","<br>&nbsp; &nbsp; ",$text_com);
							$text_com = str_replace("<br />","<br />&nbsp; &nbsp; ",$text_com);
							$text_com = str_ireplace("\r\n","",$text_com);
							$text_com = str_replace("
","",$text_com);
							$text_com = '<font color=red><b>Анекдот</b></font>:<br>&nbsp; &nbsp; '.$text_com.'<br>';
						}else{
							$text_com = 'Анекдот из головы вылетел...';
						}
						mysql_query('INSERT INTO `a_com_act` (`act`,`time`,`uid`) VALUES ("0","'.(time()+60).'","'.$u->info['id'].'")');
					}
					if($text_com != '') {
						mysql_query('INSERT INTO `chat` (`text`,`login`,`to`,`city`,`room`,`type`,`time`,`new`) VALUES ("'.$text_com.'","Комментатор","'.$u->info['login'].'","'.$u->info['city'].'","'.$u->info['room'].'","2","'.time().'","1")');
					}
					//$msg['cancel']++;
				}else{
					include('commentator.php');
					if($comment != '') {
						mysql_query('INSERT INTO `chat` (`text`,`login`,`to`,`city`,`room`,`type`,`time`,`new`) VALUES ("'.$comment.'","Комментатор","'.$u->info['login'].'","'.$u->info['city'].'","'.$u->info['room'].'","2","'.time().'","1")');
					}
				}
			}
					
			mysql_query('UPDATE `users` SET `afk` = "",`dnd` = "",`timeMain` = "'.time().'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}
		
	}
	
	if( $u->info['room'] == 362 && (int)$_GET['r3'] != 1 ) {
		$rmnm = mysql_fetch_array(mysql_query('SELECT `name` FROM `bs_map` WHERE `x` = "'.$u->info['x'].'" AND `y` = "'.$u->info['y'].'" LIMIT 1'));
		$u->room['name'] = $rmnm['name'];
	}
	
//Получаем список онлайн
	if($_GET['r1']!=0 && !isset($scTrue))
	{	
		$botsonline = 0;
		$sp = mysql_query('SELECT `u`.`dealer`,`u`.`sex`,`s`.`dnow`,`u`.`timeMain`,`s`.`bot`,`s`.`atack`,`u`.`afk`,`u`.`dnd`,`u`.`banned`,`u`.`molch1`,`u`.`room`,`u`.`id`,`u`.`city`,`u`.`cityreg`,`u`.`online`,`u`.`align`,`u`.`clan`,`u`.`login`,`u`.`level`,`u`.`inTurnir`,`u`.`battle`,`u`.`invis`,`u`.`inUser`,`s`.`x`,`s`.`y` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id` WHERE ((`u`.`room` = "'.$u->info['room'].'" AND "'.mysql_real_escape_string((int)$_GET['r3']).'" != "1") OR ("'.mysql_real_escape_string((int)$_GET['r3']).'" = "1" AND `pass` NOT LIKE "%saint%" AND `pass` NOT LIKE "%online%")) AND `mail`!="No E-mail" AND `room` != "303" ORDER BY `u`.`inUser` DESC,`u`.`online` DESC,`u`.`login` DESC LIMIT 700');
		$ar_id = 0;
		$ar_lvl = 0;
		$ar_all = 0;
		$usl = array();
		$cw = array();
		$usid = array();
		while($pl = mysql_fetch_array($sp)) {
			$ysee = 1;
			
			if($pl['inUser'] > 0) {
				if($pl['inTurnir'] == 0) {
					$ysee = 0;
				}else{
					if($pl['online'] < time()-120) {
						mysql_query('UPDATE `users` SET `online` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
					}
				}
			}else{
				if($pl['inTurnir'] > 0) {
					$ysee = 0;
				}
			}
						
			if(!isset($usl[$pl['login']])) {
				$ysee = 1;
			}
			
			if((int)$_GET['r3'] != 1) {
				if( $u->info['dnow'] != $pl['dnow'] ) {
					$ysee = 0;
				}
			}
			
			if( $pl['room'] >= 362 && $pl['room'] <= 366 && (int)$_GET['r3'] != 1) {
				if( $pl['x'] != $u->info['x'] || $pl['y'] != $u->info['y'] || $pl['room'] != $u->info['room']) {
					$ysee = 0;
				}
			}
			
			if( $usid[$pl['login']] == true ) {
				$ysee = 0;
			}
			
			$usl[$pl['login']] = $pl['id'];
			 
			if( $pl['bot'] > 0 && $pl['level'] == 8 ) {
				$botsonline8++;
			}
			if( $pl['bot'] > 0 && $pl['level'] == 9 ) {
				$botsonline9++;
			}
			if( $botsonline8 > 30 && $pl['bot'] > 0 && $pl['level'] == 8 ) {
				
			}elseif( $botsonline9 > 30 && $pl['bot'] > 0 && $pl['level'] == 9 ) {
				
			}elseif( ($pl['online'] > time()-520 || $pl['inUser'] > 0) && $pl['bot']!=1 && $pl['banned'] == 0 && $ysee == 1)
			{
				$usid[$pl['login']] = true;	
				if($pl['invis'] != 1 && $pl['invis'] < time()) {
					if($pl['clan']>0)
					{
						if($u->info['clan'] > 0 && $pl['clan'] != $u->info['clan']) {
							if(!isset($cw['war'][$pl['clan']][$u->info['clan']])) {
								$pl['cwar'] = mysql_fetch_array(mysql_query('SELECT `id`,`type` FROM `clan_wars` WHERE
								((`clan1` = "'.$pl['clan'].'" AND `clan2` = "'.$u->info['clan'].'") OR (`clan2` = "'.$pl['clan'].'" AND `clan1` = "'.$u->info['clan'].'")) AND
								`time_finish` > '.time().' LIMIT 1'));
								if(isset($pl['cwar']['id'])) {
									$cw['war'][$pl['clan']][$u->info['clan']] = $pl['cwar']['type'];
								}else{
									$cw['war'][$pl['clan']][$u->info['clan']] = 0;
								}
							}
							if($cw['war'][$pl['clan']][$u->info['clan']] > 0) {
								$pl['atack'] = $cw['war'][$pl['clan']][$u->info['clan']];
							}
						}
						if(!isset($cw[$pl['clan']])) {
							$pl['clan'] = mysql_fetch_array(mysql_query('SELECT `name_mini` FROM `clan` WHERE `id` = "'.$pl['clan'].'" LIMIT 1'));
							$cw[$pl['clan']] = $pl['clan'];
						}else{
							$pl['clan'] = $cw[$pl['clan']];
						}
						$pl['clan'] = $pl['clan']['name_mini'];
					}
					if($pl['atack'] > time() || $pl['atack'] == 1 || $pl['atack'] == 2)
					{
						if( $pl['atack'] != 2 ) {
							$pl['atack'] = 1;
						}
					}else{
						$pl['atack'] = 0;
					}
					$trvm = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `eff_users` WHERE `uid` = "'.$pl['id'].'" AND (`id_eff` = "4" OR `id_eff` = "6") AND `delete` = "0" ORDER BY `id_eff` ASC LIMIT 6'));
					$trvm = $trvm['name'];
					$r['list'] .= '"'.$r['xu'].'":["'.$pl['id'].'","'.$pl['login'].'","'.$pl['level'].'","'.$pl['align'].'","'.$pl['clan'].'","'.$pl['cityreg'].'","'.$pl['city'].'","'.$pl['room'].'","'.$pl['afk'].'","'.$pl['dnd'].'","'.$pl['banned'].'","'.$pl['molch1'].'","'.$pl['battle'].'","'.$pl['atack'].'","'.$trvm.'","'.$pl['sex'].'","'.$pl['dealer'].'"],';
					$ar_id  += $pl['id'];
					$ar_lvl += $pl['level'];
					$ar_all += $pl['align']+$pl['clan']+$pl['molch1']+$pl['banned']+$pl['battle'];
					if($pl['afk']!='')
					{
						$ar_all += 2;
					}else if($pl['dnd']!='')
					{
						$ar_all += 1;
					}
				}
				$r['xu']++;
			}
		}
		unset($pl,$sp);
		$r['list'] = rtrim($r['list'],',');
		$r['list'] = '{'.$r['list'].'}';
	}

function json_fix_cyr($json_str) { 
		/*$cyr_chars = array ( 
			'\u0430' => 'а', '\u0410' => 'А', 
			'\u0431' => 'б', '\u0411' => 'Б', 
			'\u0432' => 'в', '\u0412' => 'В', 
			'\u0433' => 'г', '\u0413' => 'Г', 
			'\u0434' => 'д', '\u0414' => 'Д', 
			'\u0435' => 'е', '\u0415' => 'Е', 
			'\u0451' => 'ё', '\u0401' => 'Ё', 
			'\u0436' => 'ж', '\u0416' => 'Ж', 
			'\u0437' => 'з', '\u0417' => 'З', 
			'\u0438' => 'и', '\u0418' => 'И', 
			'\u0439' => 'й', '\u0419' => 'Й', 
			'\u043a' => 'к', '\u041a' => 'К', 
			'\u043b' => 'л', '\u041b' => 'Л', 
			'\u043c' => 'м', '\u041c' => 'М', 
			'\u043d' => 'н', '\u041d' => 'Н', 
			'\u043e' => 'о', '\u041e' => 'О', 
			'\u043f' => 'п', '\u041f' => 'П', 
			'\u0440' => 'р', '\u0420' => 'Р', 
			'\u0441' => 'с', '\u0421' => 'С', 
			'\u0442' => 'т', '\u0422' => 'Т', 
			'\u0443' => 'у', '\u0423' => 'У', 
			'\u0444' => 'ф', '\u0424' => 'Ф', 
			'\u0445' => 'х', '\u0425' => 'Х', 
			'\u0446' => 'ц', '\u0426' => 'Ц', 
			'\u0447' => 'ч', '\u0427' => 'Ч', 
			'\u0448' => 'ш', '\u0428' => 'Ш', 
			'\u0449' => 'щ', '\u0429' => 'Щ', 
			'\u044a' => 'ъ', '\u042a' => 'Ъ', 
			'\u044b' => 'ы', '\u042b' => 'Ы', 
			'\u044c' => 'ь', '\u042c' => 'Ь', 
			'\u044d' => 'э', '\u042d' => 'Э', 
			'\u044e' => 'ю', '\u042e' => 'Ю', 
			'\u044f' => 'я', '\u042f' => 'Я', 
			
			'\r' => '', 
			'\n' => '<br />', 
			'\t' => '' 
		);
		foreach ($cyr_chars as $cyr_char_key => $cyr_char) { 
			$json_str = str_replace($cyr_char_key, $cyr_char, $json_str); 
		} */
		return $json_str; 
	}


//Получаем сообщения
    if(!isset($scTrue)) {
		if(isset($_GET['mid']) && !isset($_POST['mid']))
		{
			$_POST['mid'] = $_GET['mid'];
		}
		//$sp = mysql_query('SELECT `id`,`active`,`invis`,`login`,`to`,`city`,`room`,`time`,`type`,`spam`,`text`,`toChat`,`color`,`typeTime`,`sound`,`global`,`delete`,`molch`,`da` FROM `chat` WHERE (`time` > '.(time()-120).' OR (`time` = -1 AND (`to` = "'.$u->info['login'].'" OR `type` = 8)) OR (`time` < -1 AND `time` > -'.time().' AND (`to` = "'.$u->info['login'].'" OR `type` = 8 OR `login` = ""))) AND `new` = "1" AND (`id` > '.((int)$_POST['mid']).' OR `delete` > 0 OR `spam` > 0 OR (`time` < 0 AND `time` > -'.time().' AND `to` = "'.$u->info['login'].'")) ORDER BY `id` ASC LIMIT 1000');
		$r['msg'] = '';
		$i = 0; $l = 0;
		$sp = mysql_query('SELECT `frv`,`id`,`dn`,`active`,`invis`,`login`,`to`,`city`,`room`,`time`,`type`,`spam`,`text`,`toChat`,`color`,`typeTime`,`sound`,`global`,`delete`,`molch`,`da` FROM `chat` WHERE 
		(
			(
				`delete` > 0
			AND
				`time` > '.(time()-360).'
			)
			OR
			(
						`time` > '.(time()-120).'
				OR
					(
							`time` = -1
						AND
						(
							`to` = "'.$u->info['login'].'"
						OR
							`type` = 8
						)
					)
				OR
					(
							`time` < -1
						AND
							`time` > -'.time().'
						AND
							(
								`to` = "'.$u->info['login'].'"
							OR
								`type` = 8
							OR
								`to` = ""
							)
					)
			)
		)
		AND
			`new` = "1"
		AND
			(
				`id` > '.((int)$_POST['mid']).'
			OR
				`delete` > 0
			OR
				`spam` > 0
			OR
				(
					`time` < 0
				AND
					`time` > -'.time().'
				AND
					(
						`to` = "'.$u->info['login'].'"
					OR
						`to` = ""
					)
				)
			)
		ORDER BY `id` ASC LIMIT 1000');
		while($pl = mysql_fetch_array($sp))
		{
			
			if( $pl['delete'] > 0 ) {
				$r['msg'] .= ',"m'.$i.'":["'.$pl['id'].'","","delete","","","","","","","0","0","0","1","",""]';	
			}
			
			if($pl['type'] == 6 || $pl['type'] == 8){ $pl['city'] = $u->info['city']; }
			
			$see = 1;			
			
			if($pl['type'] == 8 && $u->info['admin'] == 0 && (($u->info['align'] <= 1 || $u->info['align'] >= 2) && ($u->info['align'] <= 3 || $u->info['align'] >= 4))) {
				$see = 0;
			}
			
			if($pl['type'] > 0 && $pl['type'] < 4 && $pl['room'] != 0) {
				$pl['room'] = $u->info['room'];
				$pl['city'] = $u->info['city'];
			}
			
		//Проверки на доступ к просмотру			
			if((($pl['type']==3 || $pl['type']==4) && ($pl['city']==$u->info['city'] || $pl['global']==1)) || (($pl['type']==5 || $pl['type']==6 ||			
			(
				$pl['type']==8 && ( $u->info['admin'] > 0 || ($u->info['align'] > 1 && $u->info['align'] < 2) )
			)			 
			) && ($pl['city']==$u->info['city'] || $pl['global']==1)) || ($pl['type']==7 && $pl['city']==$u->info['city'] && $pl['room']==$u->info['room']) || ($pl['type']==6 && ($pl['city']==$u->info['city'] || $pl['global']==1)) || $pl['type']==9 || $pl['type']==10)
			{
				if($pl['to']!='' && $pl['login']!=$u->info['login'] && $pl['to']!=$u->info['login'])
				{
					$n = 0;
					$ex = explode(',',$pl['to']);
					$j = 0;
					while($j<count($ex))
					{
						if(trim($ex[$j],' ')==$u->info['login'])
						{
							$n++;
						}
						$j++;
					}	
					if($n==0)
					{
						$see = 0;
					}
					unset($n,$j,$ex);		
				}
			}
		//Клановое сообщение (по всем городам)
			if($pl['type']==-3 && ($pl['to']=='k'.$u->info['clan'] || ($pl['to']=='paladins' && $u->info['align']>1.1 && $u->info['align']<1.999 && $u->info['align'] != 1.59 && $u->info['align'] != 1.6 && $u->info['align'] != 1.4) || ($pl['to']=='tarmans' && $u->info['align']>3 && $u->info['align']<4)))
			{
				$pl['type'] = 3;
				if($pl['to']=='k'.$u->info['clan'])
				{
					$pl['to'] = 'klan';
				}
				$see = 1;
			}elseif($pl['type']==-3)
			{
				$see = 0;
			}
			
		//Системное сообщение только в этой комнате
			if($pl['type']==6 && $pl['room'] > 0 && $pl['room'] != $u->info['room'] && $pl['to']=='')
			{
				$see = 0;
			}
		
		//Системное сообщение по всему городу
			if($pl['type']==8 && $pl['city']!=$u->info['city'] && $pl['global']==0)
			{
				$see = 0;
			}
			
		//Сообщение с молчанкой
			if($pl['molch']>0)
			{
				$see = 0;
			}
			
		//Сообщение отправлено в другой комнате
			if(($pl['type']==1 || $pl['type']==2) && ($pl['room'] != $u->info['room'] || $pl['city'] != $u->info['city']) && ($pl['global']==0 || $_COOKIE['chatCfg11']==0))
			{
				$see = 0;
			}
						
		//Сообщение прочее, в другом городе
			if($pl['city'] != $u->info['city'] && $pl['global']==0) {
				$see = 0;
			}
			
		//Глобал
			if($pl['global']==1 && $pl['city']==$u->info['city'] && $pl['type']!=-3)
			{
				$see = 1;
			}
			
		//Неактивированный персонаж
			if($pl['active'] == 1 && $u->info['admin'] == 0 && $pl['login'] != $u->info['login']) {
				if(($u->info['align'] > 1 && $u->info['align'] < 2) || ($u->info['align'] > 3 && $u->info['align'] < 4)) {
					//$see = 0;
				}else{
					$see = 0;
				}
			}
			
		//Приглашение стать воспитанником
			if($pl['type']==90 && $pl['delete'] == 0 && $pl['to'] == $u->info['login']) {
				setcookie('nasta','tester',time()+60*60*24);
				$r['js'] .= 'top.nasta="'.$pl['login'].'";';
				mysql_query('UPDATE `chat` SET `delete` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				$pl['delete'] = time();
			}
			
		//Пещерное сообщение
			if( $pl['dn'] > 0 && $u->info['dnow'] != $pl['dn'] ) {
				$see = 0;
			}
			if( $pl['dn'] > 0 && $u->info['dnow'] == $pl['dn'] ) {
				$see = 1;
			}
			
			if($see == 1 && $pl['delete'] == 0 && $pl['login'] != '') {
				
				//Проверяем игнор
				/*$n = 0;
				$qix = '';
				$ex = explode(',',$pl['to']);
				$j = 0;
				while($j<count($ex)) {
					if( $j > 0 ) {
						$qix .= ' OR ';
					}
					$qix = ' `login_ignor` = "'.mysql_real_escape_string(htmlspecialchars(trim($ex[$j],' '))).'" ';
					$j++;
				}*/	
				$qix = mysql_fetch_array(mysql_query('SELECT `id` FROM `friends` WHERE `ignor` > 0 AND `login_ignor` = "'.mysql_real_escape_string($pl['login']).'" AND (`user_ignor` = "'.$u->info['login'].'" OR `user` = "'.$u->info['id'].'") LIMIT 1'));
				if(isset($qix['id'])) {
					$see = 0;
				}
				unset($qix);
				//unset($n,$j,$ex,$qix);
				
			}
			
			if($see == 1 && $pl['delete'] == 0)
			{
				//$pl['text'] = str_replace('"','&nbsp;',$pl['text']);
				if($pl['time'] < 0)
				{
					if($pl['to'] == '') {
						$lmsch = mysql_fetch_array(mysql_query('SELECT `id` FROM `chat` ORDER BY `id` DESC LIMIT 1'));
						if( isset($lmsch['id']) ) {
							$lmsch['id']++;
							mysql_query('UPDATE `chat` SET `id` = "'.$lmsch['id'].'",`time` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
							$pl['id'] = $lmsch['id'];
						}else{
							mysql_query('UPDATE `chat` SET `time` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
						}
					}else{
						mysql_query('UPDATE `chat` SET `time` = "'.time().'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
					}
					$pl['time'] = time();
				}
				if($pl['delete']>0)
				{
					$r['msg'] .= ',"'.$i.'":{"d":"'.$pl['id'].'"}';
				}elseif($pl['spam']>0)
				{
					$r['msg'] .= ',"'.$i.'":{"s":"'.$pl['id'].'"}';
				}else{
					
					$reimg = array();
					if(preg_match_all("/\[img\[(.*?)\]\]\[1\]/", $pl['text'], $reimg) && ($u->info['admin']>0 || $pl['type']==5 || $pl['type']==6))
					{
						$k = 0;
						while($k<=count($reimg[1]))
						{
							$pl['text'] = str_replace('[img['.$reimg[1][$k].']][1]','<img src=http://img.likebk.com/i/'.$reimg[1][$k].' height=19>',$pl['text']);
							$k++;
						}
					}elseif(preg_match_all("/\[img\[(.*?)\]\]/", $pl['text'], $reimg) && ($u->info['admin']>0 || $pl['type']==5 || $pl['type']==6))
					{
						$k = 0;
						while($k<=count($reimg[1]))
						{
							$pl['text'] = str_replace('[img['.$reimg[1][$k].']]','<img src=http://img.likebk.com/i/'.$reimg[1][$k].'>',$pl['text']);
							$k++;
						}
					}
					
					if(preg_match_all("/item\[(.*?)\]/", $pl['text'], $reimg))
					{
						$k = 0;
						while($k<=count($reimg[1]))
						{
							$pl['text'] = str_replace('item['.$reimg[1][$k].']','<b oncontextmenu=\"return false;\" onClick=\"alert(\'Функция временно недоступна!\');\" style=\"cursor:pointer;\" class=\"itemsInfo\">Предмет</b>',$pl['text']);
							$k++;
						}
					}elseif(preg_match_all("/item \[(.*?)\]/", $pl['text'], $reimg))
					{
						$k = 0;
						while($k<=count($reimg[1]))
						{
							$pl['text'] = str_replace('item ['.$reimg[1][$k].']','<b oncontextmenu=\"return false;\" onClick=\"alert(\'Функция временно недоступна!\');\" style=\"cursor:pointer;\" class=\"itemsInfo\">Предмет</b>',$pl['text']);
							$k++;
						}
					}
					
					if($pl['type'] != 3) {
						if($pl['invis'] == 1 || $pl['invis'] > time()) {
							if($u->info['admin'] == 0) {
								$pl['login'] = '<b><i>Невидимка</i></b>';
							}else{
								$pl['login'] = '<b><i>Невидимка</i></b></a> <small>('.$pl['login'].')</small>';
							}
							
						}
					}
					
					//конвертация данных				
					$r['msg'] .= ',"m'.$i.'":["'.$pl['id'].'","'.$pl['time'].'","'.$pl['type'].'","'.$pl['login'].'","'.$pl['to'].'","'.$pl['text'].'","'.$pl['color'].'","'.$pl['toChat'].'","'.$pl['typeTime'].'","'.$pl['sound'].'","'.$pl['global'].'","'.$pl['molch'].'","'.$pl['active'].'","'.date('H:i',$pl['time']).'","'.date('d.m.Y H:i',$pl['time']).'","'.$pl['frv'].'","'.$pl['dn'].'"]';
				}
			}
			if($l < $pl['id'])
			{
				$l = $pl['id'];
			}
			$i++;
		}
		$r['msg'] = '{"ld":"'.(0+$l).'","id":"'.$i.'"'.$r['msg'].'}';
		$rsys = $u->sys_see(0);
		if($rsys != '') {
			$r['js'] .= $rsys;
		}
		unset($rsys);
		
	}
	
//Ппроверяем изменения персонажа
	if($_POST['tgfs'] == 0) {
		$tgfc = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `telegram` WHERE `uid` = "'.$u->info['id'].'" AND `open` = "0" LIMIT 1'));	
		if($tgfc[0]>0)
		{
			$r['js'] .= 'top.tgf_ico(1);';
		}
	}
	
	
	/*if(!isset($_COOKIE['newchat012312'])) {
		setcookie('newchat012312',time(),time()+86400*365);
		$r['js'] .= 'top.location.href = top.location.href;';
	}*/
	
	$test_da = mysql_fetch_array(mysql_query('SELECT * FROM `gourl` ORDER BY `id` DESC LIMIT 1'));
	if(isset($test_da['id'])) {
		mysql_query('UPDATE `gourl` SET `x` = `x` + 1 WHERE `id` = "'.$test_da['id'].'" LIMIT 1');
		$r['js'] .= 'top.goToUrl("'.$test_da['url'].'",1);';
	}
	
//Генерируем ключ
	$r['key'] = md5($u->room['name'].'+'.$ar_id.'+'.$ar_lvl.'+'.$ar_all);
	unset($ar_id,$ar_lvl);
	if($_COOKIE['chatCfg12']==0)
	{
		$_GET['key'] = time();
	}
	if($r['key']==$_GET['key'])
	{
	//Список онлайн остается неизменным
		unset($r['rn'],$r['list'],$r['key'],$r['xu']);
	}elseif($_GET['r1']!=0)
	{
		$r['rn'] = iconv('cp1251','utf-8',$u->room['name']);
		$r['list'] = iconv('cp1251','utf-8',$r['list']);
	}
	$posts = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `items_users` AS `iu` WHERE `iu`.`uid` = "-51'.$u->info['id'].'" AND `iu`.`delete` = 0 AND `iu`.`inOdet` = 0 AND `iu`.`inShop` = 0 AND `iu`.`lastUPD` < '.time().' LIMIT 1'));
	$posts = $posts[0];	
	if($posts > 0) {
		$r['js'] .= ' $("#postdiv").show();';
	}else{
		$r['js'] .= ' $("#postdiv").hide();';
	}
	
	//$r['js'] .= ' resizeStop();';
		
//Перекодируем строки
	if($r['js']!=NULL)
	{
		$r['js'] = iconv('cp1251','utf-8',$r['js']);
	}else{
		unset($r['js']);
	}
	if($r['msg']!=NULL)
	{
		$r['msg'] = iconv('cp1251','utf-8',$r['msg']);
	}else{
		unset($r['msg']);
	}
	unset($c,$u,$db);
	$r = json_encode($r);
	//$r = json_fix_cyr($r);
	echo $r;
	unset($r);
	
//$loger->setStop();
//$loger->set($loger_last_uid, $u->info['id'], $_SERVER['REQUEST_URI'], $u->info['battle'], $u->info['dnow'],$u->info['room'],$ipban);

if(isset($dbgo)) {
	mysql_close($dbgo);
}
?>