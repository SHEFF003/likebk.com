<?php
define('GAME',true);
die();
// include('_incl_data/__config.php');
// include('_incl_data/class/__db_connect.php');
// include('_incl_data/class/__chat_class.php');
// include('_incl_data/class/__filter_class.php');

// if( isset($_POST['ajax_reg']) ) {	
// 	include('_incl_data/class/__reg.php');
// 	include('_incl_data/class/__user.php');
// 	if( isset($u->info['id']) && $u->info['bithday'] == '01.01.1800') {
// 		//
// 		$_POST['reg_login'] = iconv('UTF-8', 'windows-1251', $_POST['reg_login']);
// 		//
// 		$reg_d = array(
// 			0 => $_POST['reg_login'],
// 			1 => $_POST['reg_pass'],
// 			2 => $_POST['reg_pass2'],
// 			3 => $_POST['reg_mail'],
// 			7 => $_POST['reg_dd'],
// 			8 => $_POST['reg_mm'],
// 			9 => $_POST['reg_yy'],
// 			15 => $_POST['reg_sex']
// 		);
// 		//
// 		$error = '';
// 		//
// 					//Запрещенные логины
// 					$nologin = array(0=>'ангел',1=>'angel',2=>'администрация',3=>'administration',4=>'Комментатор',5=>'Мироздатель',6=>'Мусорщик',7=>'Падальщик',8=>'Повелитель',9=>'Архивариус',10=>'Пересмешник',11=>'Волынщик',12=>'Лорд Разрушитель',13=>'Милосердие',14=>'Справедливость',15=>'Искушение',16=>'Вознесение');
// 					$blacklist = "!@#$%^&*()\+Ёё|/'`\"";
// 					$sr = '_-йцукенгшщзхъфывапролджэячсмитьбюё1234567890';
// 					$i = 0;
// 					while($i<count($nologin))
// 					{
// 						if(preg_match("/".$nologin[$i]."/i",$filter->mystr($reg_d[0])))
// 						{
// 							$error = 'Выберите, пожалуйста, другой ник.<br>'; $_POST['step'] = 1; $i = count($nologin);
// 						}
// 						$i++;
// 					}
// 					$reg_d[0] = str_replace('  ',' ',$reg_d[0]);
// 					//Логин от 2 до 20 символов
// 					if(strlen($reg_d[0])>20) 
// 					{ 
// 						$error = 'Логин должен содержать не более 20 символов.<br>'; $_POST['step'] = 1;
// 					}
// 					if(strlen($reg_d[0])<2) 
// 					{ 
// 						$error = 'Логин должен содержать не менее 2 символов.<br>'; $_POST['step'] = 1;
// 					}
// 					//Один алфавит
// 					$er = $r->en_ru($reg_d[0]);
// 					if($er==true)
// 					{
// 						$error = 'В логине разрешено использовать только буквы одного алфавита русского или английского. Нельзя смешивать.<br>'; $_POST['step'] = 1;
// 					}
// 					//Запрещенный символы
// 					if(strpos($sr,$reg_d[0]))
// 					{
// 						$error = 'Логин содержит запрещенные символы.<br>'; $_POST['step'] = 1;
// 					}				
// 					//Персонажи в базе
// 					$log = mysql_fetch_array(mysql_query('SELECT `id` from `users` where `login`="'.mysql_real_escape_string($reg_d[0]).'" LIMIT 1'));
// 					$log2 = mysql_fetch_array(mysql_query('SELECT `id` from `lastNames` where `login`="'.mysql_real_escape_string($reg_d[0]).'" LIMIT 1'));
// 					if(isset($log['id']) || isset($log2['id']))
// 					{
// 						$error = 'Логин '.$reg_d[0].' уже занят, выберите другой.<br>'; $_POST['step'] = 1;
// 					}
// 					//Разделители
// 					if(substr_count($reg_d[0],' ')+substr_count($reg_d[0],'-')+substr_count($reg_d[0],'_')>2)
// 					{
// 						$error = 'Не более двух разделителей одновременно (пробел, тире, нижнее подчеркивание).<br>'; $_POST['step'] = 1;
// 					}
// 					$reg_d[0] = trim($reg_d[0],' ');	
					
// 					//проверяем пароль
// 					if(strlen($reg_d[1])<6 || strlen($reg_d[1])>30)
// 					{
// 						$error = 'Длина пароля не может быть меньше 6 символов или более 30 символов.<br>'; $_POST['step'] = 2;
// 					}
// 					if($reg_d[1]!=$reg_d[2])
// 					{
// 						$error = 'В анкете пароль нужно ввести дважды, для проверки. Во второй раз вы его ввели неверно, будьте внимательнее.<br>'; $_POST['step'] = 2;
// 					}
// 					if(preg_match('/'.$reg_d[0].'/i',$reg_d[1]))
// 					{
// 						$error = 'Пароль содержит элементы логина.<br>'; $_POST['step'] = 2;
// 					}
// 					if( $reg_d[1] != $reg_d[2] ) {
// 						$error = 'Пароли не совпадают.<br>'; $_POST['step'] = 2;
// 					}
// 					if($_POST['step']!=2)
// 					{
// 						$stp = 3; $noup = 0;
// 					}
// 					//проверяем e-mail
// 					if(strlen($reg_d[3])<6 || strlen($reg_d[3])>50)
// 					{
// 						$error = 'E-mail не может быть короче 6-х символов и длинее 50-ти.<br>'; $_POST['step'] = 3;
// 					}
					
// 					if(!preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $reg_d[3]))
// 					{
// 						$error = 'Вы указали явно ошибочный E-mail.<br>'; $_POST['step'] = 3;
// 					}
					
// 					if( $_POST['mail_post'] != 'true' ) {
// 						$error = 'Дайте разрешение на возможность рассылки информации на ваш E-mail';
// 					}
					
// 					$reg_d[4] = $chat->str_count($reg_d[4],30);
// 					$reg_d[5] = $chat->str_count($reg_d[5],30);
					
// 					if($_POST['step']!=3)
// 					{
// 						$stp = 4; $noup = 0;
// 					}
					
// 					$reg_d[6] = $chat->str_count($reg_d[6],90);
// 					$reg_d[7] = round($reg_d[7]);
// 					$reg_d[8] = round($reg_d[8]);
// 					$reg_d[9] = round($reg_d[9]);
					
// 					if($reg_d[7]<1 || $reg_d[7]>31 || $reg_d[8]<1 || $reg_d[8]>12 || $reg_d[9]<1920 || $reg_d[9]>2006)
// 					{
// 						$error = 'Ошибка в написании дня рождения.<br>'; $_POST['step'] = 4;
// 					}
					
// 					if($reg_d[15]!=1 && $reg_d[15]!=2)
// 					{
// 						$error = 'Вы указали не верный пол.<br>'; $_POST['step'] = 4;
// 					}			
		
// 		if( $error == '' ) {
// 			if( $reg_d[15] != 2 ) {
// 				$reg_d[15] = 0;
// 			}else{
// 				$reg_d[15] = 1;
// 			}
// 			setcookie('login',$reg_d[0],time()+60*60*24*7,'',$c['host']);
// 			setcookie('pass',md5($reg_d[1]),time()+60*60*24*7,'',$c['host']);
// 			mysql_query('UPDATE `users` SET
// 			`login` = "'.mysql_real_escape_string($reg_d[0]).'",
// 			`activ` = "1",
// 			`pass` = "'.mysql_real_escape_string(md5($reg_d[1])).'",
// 			`mail` = "'.mysql_real_escape_string($reg_d[3]).'",
// 			`bithday` = "'.mysql_real_escape_string($reg_d[7].'.'.$reg_d[8].'.'.$reg_d[9]).'",
// 			`sex` = "'.mysql_real_escape_string($reg_d[15]).'",
// 			`fnq` = "0"
// 			WHERE `id` = "'.mysql_real_escape_string($u->info['id']).'" LIMIT 1');
			
// 			if( $u->info['host_reg'] > 0 ) {
// 				$refer = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `id` = "'.$u->info['host_reg'].'" LIMIT 1'));
// 				if( isset($refer['id']) ) {
// 					$u->addItem(4005,$refer['id']);
// 				}else{
// 					$nast = 1001398;
// 					mysql_query('UPDATE `users` SET
// 					`host_reg` = "'.$nast.'"
// 					WHERE `id` = "'.mysql_real_escape_string($u->info['id']).'" LIMIT 1');
// 				}
// 			}else{
// 				$nast = 1001398;
// 				mysql_query('UPDATE `users` SET
// 				`host_reg` = "'.$nast.'"
// 				WHERE `id` = "'.mysql_real_escape_string($u->info['id']).'" LIMIT 1');
// 			}
// 			//Заводим счет в банке
// 			mysql_query("INSERT INTO `bank` (`uid`,`block`,`create`,`pass`,`money1`,`money2`,`moneyBuy`) VALUES (
// 				'".mysql_real_escape_string($u->info['id'])."',
// 				'0',
// 				'".time()."',
// 				'passs',
// 				'0.00',
// 				'0.00',
// 				'0.00'
// 				)");
// 			//Вешаем обезличивание персонажу
// 			mysql_query('UPDATE `users` SET`info_delete` = "1" WHERE `id` = "'.mysql_real_escape_string($u->info['id']).'" LIMIT 1');

// 			//Выдаем предметы и отправляем сообщение в чат//Выдаем предметы и отправляем сообщение в чат//Выдаем предметы и отправляем сообщение в чат//Выдаем предметы и отправляем сообщение в чат
			
// 				$text = '<b>'.$reg_d[0].'</b>, если у Вас возникли затруднения с выполнением квеста, перейдите по следующей ссылке - <a href=http://likebk.com/library/noobguide/ target=_blank >www.likebk.com/library/noobguide</a> ';
// 			mysql_query("INSERT INTO `chat` (`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`new`) VALUES ('capitalcity','4','','".$reg_d[0]."','".$text."','".time()."','6','0','1')");
						
// 			//Рубаха
// 			$re = $u->addItem(1,$u->info['id'],'|');
// 			if( $re > 0 ) {
// 				mysql_query('UPDATE `items_users` SET `gift` = "Мироздатель" WHERE `id` = "'.$re.'" LIMIT 1');
// 			}
// 			//Штаны
// 			$re = $u->addItem(73,$u->info['id'],'|');
// 			if( $re > 0 ) {
// 				mysql_query('UPDATE `items_users` SET `gift` = "Мусорщик" WHERE `id` = "'.$re.'" LIMIT 1');
// 			}
// 			//Котомка в прочее
// 			$re = $u->addItem(2133,$u->info['id'],'|sudba='.$reg_d[0].'|nosale=1|srok='.(86400*14).'');
// 			if( $re > 0 ) {
// 				mysql_query('UPDATE `items_users` SET `gift` = "Архивариус" WHERE `id` = "'.$re.'" LIMIT 1');
// 			}
// 			//Эликсиры
// 			//Зелье могущества
// 			$re = $u->addItem(870,$u->info['id'],'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
// 			if( $re > 0 ) {
// 				mysql_query('UPDATE `items_users` SET `gift` = "Мироздатель" WHERE `id` = "'.$re.'" LIMIT 1');
// 			}
// 			//Зелье Прозрения
// 			$re = $u->addItem(871,$u->info['id'],'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
// 			if( $re > 0 ) {
// 				mysql_query('UPDATE `items_users` SET `gift` = "Мироздатель" WHERE `id` = "'.$re.'" LIMIT 1');
// 			}
// 			//Зелье Стремительности
// 			$re = $u->addItem(872,$u->info['id'],'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
// 			if( $re > 0 ) {
// 				mysql_query('UPDATE `items_users` SET `gift` = "Мироздатель" WHERE `id` = "'.$re.'" LIMIT 1');
// 			}
// 			//Зелье Разума
// 			$re = $u->addItem(873,$u->info['id'],'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
// 			if( $re > 0 ) {
// 				mysql_query('UPDATE `items_users` SET `gift` = "Мироздатель" WHERE `id` = "'.$re.'" LIMIT 1');
// 			}
// 			//Зелье Пронзающих Игл
// 			$re = $u->addItem(883,$u->info['id'],'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
// 			if( $re > 0 ) {
// 				mysql_query('UPDATE `items_users` SET `gift` = "Мироздатель" WHERE `id` = "'.$re.'" LIMIT 1');
// 			}
// 			$re = $u->addItem(884,$u->info['id'],'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
// 			if( $re > 0 ) {
// 				mysql_query('UPDATE `items_users` SET `gift` = "Мироздатель" WHERE `id` = "'.$re.'" LIMIT 1');
// 			}
// 			$re = $u->addItem(885,$u->info['id'],'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
// 			if( $re > 0 ) {
// 				mysql_query('UPDATE `items_users` SET `gift` = "Мироздатель" WHERE `id` = "'.$re.'" LIMIT 1');
// 			}
// 			$re = $u->addItem(886,$u->info['id'],'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
// 			if( $re > 0 ) {
// 				mysql_query('UPDATE `items_users` SET `gift` = "Мироздатель" WHERE `id` = "'.$re.'" LIMIT 1');
// 			}
// 			$re = $u->addItem(887,$u->info['id'],'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
// 			if( $re > 0 ) {
// 				mysql_query('UPDATE `items_users` SET `gift` = "Мироздатель" WHERE `id` = "'.$re.'" LIMIT 1');
// 			}
// 			$re = $u->addItem(2392,$u->info['id'],'|sudba='.$reg_d[0].'|nosale=1|nodelete=1');
// 			if( $re > 0 ) {
// 				mysql_query('UPDATE `items_users` SET `gift` = "Мироздатель" WHERE `id` = "'.$re.'" LIMIT 1');
// 			}
// 			$re = $u->addItem(2393,$u->info['id'],'|sudba='.$reg_d[0].'|nosale=1|nodelete=1');
// 			if( $re > 0 ) {
// 				mysql_query('UPDATE `items_users` SET `gift` = "Мироздатель" WHERE `id` = "'.$re.'" LIMIT 1');
// 			}
// 			$re = $u->addItem(2394,$u->info['id'],'|sudba='.$reg_d[0].'|nosale=1|nodelete=1');
// 			if( $re > 0 ) {
// 				mysql_query('UPDATE `items_users` SET `gift` = "Мироздатель" WHERE `id` = "'.$re.'" LIMIT 1');
// 			}
// 			$re = $u->addItem(2391,$u->info['id'],'|sudba='.$reg_d[0].'|nosale=1|nodelete=1');
// 			if( $re > 0 ) {
// 				mysql_query('UPDATE `items_users` SET `gift` = "Мироздатель" WHERE `id` = "'.$re.'" LIMIT 1');
// 			}
// 			$re = $u->addItem(865,$u->info['id'],'|sudba='.$reg_d[0].'|nosale=1|nodelete=1');
// 			if( $re > 0 ) {
// 				mysql_query('UPDATE `items_users` SET `gift` = "Мироздатель" WHERE `id` = "'.$re.'" LIMIT 1');
// 			}
// 			$error = 'Регистрация прошла успешно! Спасибо!<br>Через 3 сек. Вы будете перенаправлены в игру!<script>setTimeout(\'top.location.href="/buttons.php"\',2000);</script>';
// 		}
		
// 		die( $error );
// 	}
// }else{

// 	function GetRealIp()
// 	{
// 	 if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
// 	 {
// 	   $ip=$_SERVER['HTTP_CLIENT_IP'];
// 	 }
// 	 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
// 	 {
// 	  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
// 	 }
// 	 else
// 	 {
// 	   $ip=$_SERVER['REMOTE_ADDR'];
// 	 }
// 	 return $ip;
// 	}
	
// 	define('IP',GetRealIp());
	
// 	function error($e)
// 	{
// 		 global $c;
// 		 die('<html><head>
// 		 <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
// 		 <meta http-equiv="Content-Language" content="ru"><TITLE>Произошла ошибка</TITLE></HEAD>
// 		 <BODY text="#FFFFFF"><p><font color=black>
// 		 Произошла ошибка: <pre>'.$e.'</pre><b><p><a onClick="window.history.go(-1); return false;" href="#">Назад</b></a><HR>
// 		 <p align="right">(c) <a href="http://'.$c['host'].'/">'.$c['name'].'</a></p>
// 		 <!--Rating@Mail.ru counter--><!--// Rating@Mail.ru counter-->
// 		 </body></html>');
// 	}
	
// 	if( isset($_COOKIE['login']) ) {
// 			setcookie('login',false,time()-60*60*24*30,'','.likebk.com/');
// 			setcookie('pass',false,time()-60*60*24*30,'','.likebk.com/');
// 			setcookie('login',false,time()-60*60*24*30);
// 			setcookie('pass',false,time()-60*60*24*30);
// 	}
	
// 	$lr = mysql_fetch_array(mysql_query('SELECT `id`,`ipreg`,`pass`,`bithday`,`login` FROM `users` WHERE `cityreg`="capitalcity" AND `timereg`>"'.(time()-60*60*1).'" AND `ipreg` = "'.mysql_real_escape_string(IP).'" LIMIT 1'));
// 	if(/*isset($_COOKIE['reg_capitalcity']) || (int)$_COOKIE['reg_capitalcity']>time() ||*/ isset($lr['id2'])) {
// 		if( isset($lr['id']) && $lr['bithday'] == '01.01.1800' ) {
// 			if( isset($_GET['enter']) ) {
// 				setcookie('login',$lr['login'],time()+60*60*24*7,'',$c['host']);
// 				setcookie('pass',$lr['pass'],time()+60*60*24*7,'',$c['host']);
// 				header('location: http://likebk.com/buttons.php');
// 			}
// 			error('Недавно с вашего IP уже регистрировался персонаж. С одного IP адреса разрешена регистрация персонажей не чаще, чем раз в час. Попробуйте позже.<br>Для авторизации <b>'.$lr['login'].'</b> перейдите по ссылке: <a href="/reg.php?enter">Авторизироваться</a>');
// 		}else{
// 			error('Недавно с вашего IP уже регистрировался персонаж. С одного IP адреса разрешена регистрация персонажей не чаще, чем раз в час. Попробуйте позже.<br>');
// 		}
// 	}else{
// 		//Создаем персонажа
// 		$pass = md5(md5(rand(0,100.).'#'.rand(0,1000)));
// 		mysql_query('INSERT INTO `users` (`host_reg`,`pass`,`ip`,`ipreg`,`city`,`cityreg`,`room`,`timereg`) VALUES (
// 			"'.mysql_real_escape_string(0+$_GET['ref']).'",
// 			"'.mysql_real_escape_string($pass).'",
// 			"'.mysql_real_escape_string(IP).'",
// 			"'.mysql_real_escape_string(IP).'",
// 			"capitalcity",
// 			"capitalcity",
// 			"4",
// 			"'.time().'"
// 		)');	
// 		$uid = mysql_insert_id();
// 		if( $uid > 0 ) {
// 			$login = 'Новичок'.$uid;
// 			mysql_query('UPDATE `users` SET `login` = "'.mysql_real_escape_string($login).'" WHERE `id` = "'.$uid.'" LIMIT 1');
// 			//Создаем статы персонажа
// 			mysql_query("INSERT INTO `online` (`uid`,`timeStart`) VALUES ('".$uid."','".time()."')");
// 			mysql_query("INSERT INTO `stats` (`id`,`stats`) VALUES ('".$uid."','s1=3|s2=3|s3=3|s4=3|rinv=40|m9=5|m6=10')");	
			
// 			//мульты
// 			$ipm1 = mysql_fetch_array(mysql_query('SELECT * FROM `logs_auth` WHERE `uid` = "'.mysql_real_escape_string($uid).'" AND `ip`!="'.mysql_real_escape_string(IP).'" ORDER BY `id` ASC LIMIT 1'));
// 			$ppl = mysql_query('SELECT * FROM `logs_auth` WHERE `ip`!="" AND (`ip` = "'.mysql_real_escape_string(IP).'" OR `ip`="'.mysql_real_escape_string($ipm1['ip']).'" OR `ip`="'.mysql_real_escape_string($_COOKIE['ip']).'")');
// 			while($spl = mysql_fetch_array($ppl))
// 			{
// 				$ml = mysql_fetch_array(mysql_query('SELECT `id` FROM `mults` WHERE (`uid` = "'.$spl['uid'].'" AND `uid2` = "'.$uid.'") OR (`uid2` = "'.$spl['uid'].'" AND `uid` = "'.$uid.'") LIMIT 1'));
// 				if(!isset($ml['id']) && $spl['ip']!='' && $spl['ip']!='127.0.0.1')
// 				{
// 					mysql_query('INSERT INTO `mults` (`uid`,`uid2`,`ip`) VALUES ("'.$uid.'","'.$spl['uid'].'","'.$spl['ip'].'")');
// 				}
// 			}
// 			mysql_query("INSERT INTO `logs_auth` (`uid`,`ip`,`browser`,`type`,`time`,`depass`) VALUES ('".$uid."','".mysql_real_escape_string(IP)."','".mysql_real_escape_string($_SERVER['HTTP_USER_AGENT'])."','1','".time()."','')");
			
// 			//Обновяем таблицы
// 			mysql_query("UPDATE `users` SET `online`='".time()."',`ip` = '".mysql_real_escape_string(IP)."' WHERE `uid` = '".$uid."' LIMIT 1");
			
// 			if(!setcookie('login',$login, (time()+60*60*24*7) , '' , '.likebk.com' ) || !setcookie('pass',$pass, (time()+60*60*24*7) , '' , '.likebk.com' )) {
// 				die('Ошибка сохранения cookie.');
// 			}else{
// 				/*
// 				die('Спасибо за регистрацию!<br><script>function test(){ top.location.href="http://likebk.com/buttons.php"; } setTimeout("test()",1000);</script>');
// 				*/
// 			}
// 			header('location: http://likebk.com/buttons.php');
// 		}
// 	}
// }

?>