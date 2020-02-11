<?

if(!isset($_COOKIE['SSIDEnter'])) {
	setcookie('SSIDEnter',$_SERVER['REMOTE_ADDR'],time()+3600);
	$_COOKIE['SSIDEnter'] = $_SERVER['REMOTE_ADDR'];
}

if( isset($_GET['ref']) && !isset($_COOKIE['ref']) ) {
	setcookie('ref',$_GET['ref'],time()+3600);
	//header('location: http://likebk.com/register');
	//die();
}elseif( isset($_GET['r']) && !isset($_COOKIE['ref']) ) {
	setcookie('ref',$_GET['r'],time()+3600);
	//header('location: http://likebk.com/register');
	//die();
}elseif( isset($_POST['ref']) && !isset($_COOKIE['ref'])) {
	setcookie('ref',$_POST['ref'],time()+3600);
	//header('location: http://likebk.com/register');
	//die();
}elseif( isset($_POST['refer']) && !isset($_COOKIE['ref'])) {
	setcookie('refer',$_POST['refer'],time()+3600);
	//header('location: http://likebk.com/register');
	//die();
}

if(isset($_COOKIE['ref'])) {
	$_GET['ref'] = $_COOKIE['ref'];
	$_GET['r'] = $_COOKIE['r'];
	$_POST['ref'] = $_COOKIE['ref'];
	$_POST['refer'] = $_COOKIE['ref'];
}

/*header('location: reg.php');
die();*/
//30.05.2060 07:25:06
define('GAME',true);
include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__chat_class.php');
include('_incl_data/class/__filter_class.php');

//if(isset($_GET['test'])) {
	
	/*$bs_test = mysql_fetch_array(mysql_query('SELECT * FROM `ip_base` WHERE `ip` = "'.mysql_real_escape_string($_SERVER['REMOTE_ADDR']).'" LIMIT 1'));
	if(isset($bs_test['id'])) {
		//
	}else{
		//
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL,'http://'.$_SERVER['REMOTE_ADDR'].'/');	
		curl_setopt($ch, CURLOPT_TIMEOUT, 1);  
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_NOBODY,true);
		curl_setopt($ch,CURLOPT_HEADER,true);
		$data = curl_exec($ch); 
		if (curl_errno($ch)) { 
			 $er = htmlspecialchars(curl_error($ch),NULL,'cp1251');
			 if( strripos($er,'timed') == true ) {
				mysql_query('INSERT INTO `ip_base` (`ip`,`time`,`ok`,`data`) VALUES ("'.mysql_real_escape_string($_SERVER['REMOTE_ADDR']).'","'.time().'","1","1#'.mysql_real_escape_string($data).'['.$er.']")');
			 	//echo 'NOT_TOR#1';
			 }else{
				mysql_query('INSERT INTO `ip_base` (`ip`,`time`,`ok`,`data`) VALUES ("'.mysql_real_escape_string($_SERVER['REMOTE_ADDR']).'","'.time().'","1","-1#'.mysql_real_escape_string($data).'['.$er.']")');
				// echo 'TOR#1';
			 }
			// Закрываем дескриптор
			curl_close($ch);
		}else{ 
			//var_dump($data); 
			if( strripos($data,'Content-Type') == true ) {
				mysql_query('INSERT INTO `ip_base` (`ip`,`time`,`ok`,`data`) VALUES ("'.mysql_real_escape_string($_SERVER['REMOTE_ADDR']).'","'.time().'","-1","-2#'.mysql_real_escape_string($data).'")');
				////echo 'TOR#2';
				//echo '['.$data.']';
			}else{
				 mysql_query('INSERT INTO `ip_base` (`ip`,`time`,`ok`,`data`) VALUES ("'.mysql_real_escape_string($_SERVER['REMOTE_ADDR']).'","'.time().'","1","2#'.mysql_real_escape_string($data).'")');
				 //echo 'NOT_TOR#2';
				 //echo '['.$data.']';
			 }
			curl_close($ch); 
		} 
		$bs_test = mysql_fetch_array(mysql_query('SELECT * FROM `ip_base` WHERE `ip` = "'.mysql_real_escape_string($_SERVER['REMOTE_ADDR']).'" ORDER BY `id` DESC LIMIT 1'));
	}*/
//}

function premiumGold($uid){
	$eff = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "435"'));
	$bonusT = 259200;
	$bonus = array(
		"name"=>"LikeBk Gold",
		"speed_Loc" => "30",
		"speedHp" => "150",
		"speedMp" => "150",
		"addExp" => "100",
		"addRep" => "50",
		"ym_delay"=>"50",
		"yv_drop"=>"2",
		"speed_dunger"=>"50",
		"mfza"=>"10",
		"mf_yron"=>"10",
		"sale_prc"=>"100",
		"saleEkr_prc"=>"100",
		"Exp_zver"=>"100",
		"type"=>"3"
		);
	$ins = mysql_query('INSERT INTO `premium` SET 
		`name` = "'.$bonus['name'].'",
		`uid` = "'.$uid.'", 
		`type` = "'.$bonus['type'].'",
		`time_delete` = "'.(time()+$bonusT).'",
		`speed_Loc` = "'.$bonus['speed_Loc'].'",
		`speedHp` = "'.$bonus['speedHp'].'",
		`speedMp` = "'.$bonus['speedMp'].'",
		`addExp` = "'.$bonus['addExp'].'",
		`addRep` = "'.$bonus['addRep'].'",
		`ym_delay` = "'.$bonus['ym_delay'].'",
		`yv_drop` = "'.$bonus['yv_drop'].'",
		`speed_dunger` = "'.$bonus['speed_dunger'].'",
		`mfza` = "'.$bonus['mfza'].'",
		`mf_yron` = "'.$bonus['mf_yron'].'",
		`sale_prc` = "'.$bonus['sale_prc'].'",
		`saleEkr_prc` = "'.$bonus['saleEkr_prc'].'",
		`Exp_zver` = "'.$bonus['Exp_zver'].'",
		`money` = "0" ');
	if($ins){
		mysql_query('INSERT INTO `eff_users` (`uid`,`id_eff`,`data`,`name`,`overType`,`timeUse`,`x`,`no_Ace`) VALUES ("'.$uid.'","'.$eff['id2'].'","'.$eff['mdata'].'","'.$eff['mname'].'","777","'.(time()+$bonusT).'","1","1")');
		return true;
	}
	else{
		return false;
	}
}

if(isset($_GET['showcode'])) {
	include('show_reg_img/security.php');
	die();
}

if(isset($_GET['test1'])) {
	$test = file_get_contents('https://xcombats.com/proxy/' . $_SERVER['REMOTE_ADDR'] . '/short');
	$test = round((int)$test);
}

if(!empty($_COOKIE['mailru']) or $_COOKIE['mailru'] == 'enter'){
//	die('Недавно с вашего компьютера уже регистрировался персонаж. С одного компьютера разрешена регистрация персонажей не чаще, чем раз в сутки. Попробуйте позже. <BR>');
}

//if(isset($bs_test['id'])) {
	//if($bs_test['ok'] < 0) {
	if( $test == 1 ) {
		die('%'.$_SERVER['REMOTE_ADDR'].' | Браузер TOR, анонимайзеры и прокси на нашем игровом сервере запрещены!<br>Воспользуйтесь другим браузером, рекомендуем <a href="http://www.google.ru/chrome/" target="_blank">Google Chrome</a>');
	}
	//}
//}

/* Регистрация AJAX */
if( isset($_POST['id']) ) {
	session_start();
	include('_incl_data/class/__reg.php');
	include('_incl_data/class/__user.php');
	$rt = '';
	//
	$ref = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id`= "'.mysql_real_escape_string($_POST['refer']).'"'));
	if(isset($ref['id'])){
		$refer = $ref['id'];
	}else{
		$refer = 0;
	}
	
	$_POST['login'] = trim($_POST['login']);
	$_POST['login'] = str_replace('  ',' ',$_POST['login']);
	$_POST['login'] = str_replace('  ',' ',$_POST['login']);
	$_POST['login'] = str_replace('  ',' ',$_POST['login']);
	$_POST['login'] = str_replace('  ',' ',$_POST['login']);
	$_POST['login'] = str_replace('  ',' ',$_POST['login']);
	$_POST['login'] = str_replace('  ',' ',$_POST['login']);
	$_POST['login'] = str_replace('  ',' ',$_POST['login']);
	$_POST['login'] = str_replace('  ',' ',$_POST['login']);
	$_POST['login'] = str_replace('  ',' ',$_POST['login']);
	$_POST['login'] = str_replace('  ',' ',$_POST['login']);
	$_POST['login'] = str_replace('  ',' ',$_POST['login']);
	$_POST['login'] = str_replace('  ',' ',$_POST['login']);
	$_POST['login'] = str_replace('  ',' ',$_POST['login']);
	$_POST['login'] = str_replace('  ',' ',$_POST['login']);
	$_POST['login'] = str_replace('  ',' ',$_POST['login']);
	$_POST['login'] = str_replace('  ',' ',$_POST['login']);
	
	
	$gd = array( 0,0,0,0,0,0,0,0,0,0,0 );
	$reg_d = array(
		0 => htmlspecialchars(iconv('UTF-8', 'windows-1251', $_POST['login']),NULL,'cp1251'),
		1 => htmlspecialchars(iconv('UTF-8', 'windows-1251', $_POST['pass']),NULL,'cp1251'),
		2 => htmlspecialchars(iconv('UTF-8', 'windows-1251', $_POST['pass2']),NULL,'cp1251'),
		3 => (int)$_POST['dd'],
		4 => (int)$_POST['mm'],
		5 => (int)$_POST['yy'],
		6 => (int)$_POST['sex'],
		7 => (int)$_POST['rules'],
		8 => htmlspecialchars(iconv('UTF-8', 'windows-1251', $_POST['mail']),NULL,'cp1251'),
		9 => (int)$_POST['keycode'],
		10 => $refer
	);
	$_POST['login'] = str_replace('	',' ',$_POST['login']);
	$_POST['login'] = str_replace('&nbsp;',' ',$_POST['login']);
	//Проверка логина
	//Запрещенные логины
	$error = '';
	$good = 1;
	
	$testip1 = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `timereg` > "'.(time()-10*60).'" AND (`ip` = "'.mysql_real_escape_string($_COOKIE['SSIDEnter']).'" OR `ipreg` = "'.mysql_real_escape_string($_COOKIE['SSIDEnter']).'" OR `ip` = "'.mysql_real_escape_string($_SERVER['REMOTE_ADDR']).'" OR `ipreg` = "'.mysql_real_escape_string($_SERVER['REMOTE_ADDR']).'") LIMIT 1'));
	$testip2 = mysql_fetch_array(mysql_query('SELECT `id` FROM `block_ip` WHERE `ip` = "'.mysql_real_escape_string($_COOKIE['SSIDEnter']).'" OR `ip` = "'.mysql_real_escape_string($_SERVER['REMOTE_ADDR']).'" LIMIT 1'));
	
	if(isset($testip1['id']) || isset($testip2['id'])) {
		$error = 'Нельзя регистрироваться чащей одного раза в 10 минут!';
		$good = 0;
	}
	
	$nologin = array(0=>'ангел',1=>'angel',2=>'администрация',3=>'administration',4=>'Комментатор',5=>'Мироздатель',6=>'Мусорщик',7=>'Падальщик',8=>'Повелитель',9=>'Архивариус',10=>'Пересмешник',11=>'Волынщик',12=>'Лорд Разрушитель',13=>'Милосердие',14=>'Справедливость',15=>'Искушение',16=>'Вознесение');
					$blacklist = "!@#$%^&*()\+Ёё|/'`\"";
					$sr = '_-йцукенгшщзхъфывапролджэячсмитьбюё1234567890';
					$i = 0;
					while($i<count($nologin))
					{
						if(preg_match("/".$nologin[$i]."/i",$filter->mystr($reg_d[0])))
						{
							$error = 'Выберите, пожалуйста, другой ник.'; $_POST['step'] = 1; $i = count($nologin);
						}
						$i++;
					}
					$reg_d[0] = str_replace('  ',' ',$reg_d[0]);
					//Логин от 2 до 20 символов
					if(strlen($reg_d[0])>20) 
					{ 
						$error = 'Логин должен содержать не более 20 символов.'; $_POST['step'] = 1;
					}
					if(strlen($reg_d[0])<2) 
					{ 
						$error = 'Логин должен содержать не менее 2 символов.'; $_POST['step'] = 1;
					}
					//Один алфавит
					$er = $r->en_ru($reg_d[0]);
					if($er==true)
					{
						$error = 'В логине разрешено использовать только буквы одного алфавита русского или английского. Нельзя смешивать.'; $_POST['step'] = 1;
					}
					//Запрещенный символы
					if(strpos($sr,$reg_d[0]))
					{
						$error = 'Логин содержит запрещенные символы.'; $_POST['step'] = 1;
					}				
					//Персонажи в базе
					$log = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `login`="'.mysql_real_escape_string($reg_d[0]).'" LIMIT 1'));
					$log2 = mysql_fetch_array(mysql_query('SELECT `id` FROM `lastNames` WHERE `login`="'.mysql_real_escape_string($reg_d[0]).'" LIMIT 1'));
					$log3 = mysql_fetch_array(mysql_query('SELECT `id` FROM `users_safe` WHERE `login`="'.mysql_real_escape_string($reg_d[0]).'" LIMIT 1'));
					
					if(isset($log['id']) || isset($log2['id']) || isset($log3['id']))
					{
						$error = 'Логин '.$reg_d[0].' уже занят, выберите другой.'; $_POST['step'] = 1;
					}
					//Разделители
					if(substr_count($reg_d[0],' ')+substr_count($reg_d[0],'-')+substr_count($reg_d[0],'_')>2)
					{
						$error = 'Не более двух разделителей одновременно (пробел, тире, нижнее подчеркивание).'; $_POST['step'] = 1;
					}
					$reg_d[0] = trim($reg_d[0],' ');	
					if($error != '') {
						$gd[0] = $error;
						$good = 0;
					}else{
						$gd[0] = 1;
					}
					//проверяем пароль
					if(strlen($reg_d[1])<6 || strlen($reg_d[1])>30)
					{
						$error = 'Длина пароля не может быть меньше 6 символов или более 30 символов.'; $_POST['step'] = 2;
					}
					if($reg_d[1]!=$reg_d[2])
					{
						$error = 'В анкете пароль нужно ввести дважды, для проверки. Во второй раз вы его ввели неверно, будьте внимательнее.'; $_POST['step'] = 2;
					}
					if(preg_match('/'.$reg_d[0].'/i',$reg_d[1]))
					{
						$error = 'Пароль содержит элементы логина.'; $_POST['step'] = 2;
					}
					if( $reg_d[1] != $reg_d[2] ) {
						$error = 'Пароли не совпадают.'; $_POST['step'] = 2;
					}
					if($_POST['step']!=2)
					{
						$stp = 3; $noup = 0;
					}
					if($error != '') {
						$gd[1] = $error;
						$good = 0;
					}else{
						$gd[1] = 1;
					}
					
					//Проверка даты
					$error = '';
					$ddmmyy = array(
						'',
						'January',
						'February',
						'March',
						'April',
						'May',
						'June',
						'July',
						'August',
						'September',
						'October',
						'November',
						'December'
					);
					
					$tstd = date('d.m.Y',strtotime(''.$reg_d[3].' '.$ddmmyy[$reg_d[4]].' '.$reg_d[5].''));
					if( $reg_d[3] < 10 ) {
						$reg_d[3] = '0'.$reg_d[3];
					}
					if( $reg_d[4] < 10 ) {
						$reg_d[4] = '0'.$reg_d[4];
					}
					if( $tstd != ''.$reg_d[3].'.'.$reg_d[4].'.'.$reg_d[5].'' ) {
						$error = 'Ошибка в написании дня рождения.';
					}
					if($error != '') {
						$gd[2] = $error;
						$good = 0;
					}else{
						$gd[2] = 1;
					}
					
					if( $reg_d[7] != 1 ) {
						$error = 'Примите соглашение и дайте разрешение на возможность рассылки информации на ваш E-mail';
					}
					if($error != '') {
						$gd[3] = $error;
						$good = 0;
					}else{
						$gd[3] = 1;
					}
					
					$error = '';
					//проверяем e-mail
					if(strlen($reg_d[8])<6 || strlen($reg_d[8])>50)
					{
						$error = 'E-mail не может быть короче 6-х символов и длинее 50-ти.'; $_POST['step'] = 3;
					}
					
					if(!preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s]+\.+[a-z]{2,6}))$#si', $reg_d[8]))
					{
						$error = 'Вы указали явно ошибочный E-mail.<br>'; $_POST['step'] = 3;
					}
					if($error != '') {
						$gd[4] = $error;
						$good = 0;
					}else{
						$gd[4] = 1;
					}
					
					$error = '';
					//проверяем ключа
					if(strlen($reg_d[9]) != 4 || $reg_d[9] != $_SESSION['code'])
					{
						$error = 'Неверно указан код подтверждения ['.$reg_d[9].']'; $_POST['step'] = 3;
					}
					
					if($error != '') {
						$gd[5] = $error;
						$good = 0;
					}else{
						$gd[5] = 1;
					}
	
	if( $good == 1 ) {
		if( $reg_d[6] == 2 ) {
			$reg_d[6] = 1;
		}else{
			$reg_d[6] = 0;
		}
		//Регистрируем
		/*
		0 => htmlspecialchars(iconv('UTF-8', 'windows-1251', $_POST['login']),NULL,'cp1251'),
		1 => htmlspecialchars(iconv('UTF-8', 'windows-1251', $_POST['pass']),NULL,'cp1251'),
		2 => htmlspecialchars(iconv('UTF-8', 'windows-1251', $_POST['pass2']),NULL,'cp1251'),
		3 => (int)$_POST['dd'],
		4 => (int)$_POST['mm'],
		5 => (int)$_POST['yy'],
		6 => (int)$_POST['sex'],
		7 => (int)$_POST['rules'],
		8 => htmlspecialchars(iconv('UTF-8', 'windows-1251', $_POST['mail']),NULL,'cp1251'),
		9 => (int)$_POST['keycode']
		*/
		//if(IP != '10.117.209.29' || IP != '80.69.58.87' || IP != '46.63.28.213' || IP != '93.127.3.234' || IP != '128.75.154.3' || IP != '194.135.163.12' || IP != '104.131.89.85' || IP != '5.18.62.144' || IP != '192.42.116.16' || IP != '198.50.200.135'){
			//Создаем персонажа
			mysql_query('INSERT INTO `users` (`login`,`host_reg`,`pass`,`ip`,`ipreg`,`city`,`cityreg`,`room`,`timereg`,
			`activ`,`mail`,`bithday`,`sex`,`fnq`,`referals`,`real`
			) VALUES (
				"'.mysql_real_escape_string($reg_d[0]).'",
				"0",
				"'.mysql_real_escape_string(md5($reg_d[1])).'",
				"'.mysql_real_escape_string(IP).'",
				"'.mysql_real_escape_string(IP).'",
				"capitalcity",
				"capitalcity",
				"9",
				"'.time().'",			
				"0",
				"'.mysql_real_escape_string($reg_d[8]).'",
				"'.mysql_real_escape_string($reg_d[3].'.'.$reg_d[4].'.'.$reg_d[5]).'",
				"'.mysql_real_escape_string($reg_d[6]).'",
				"0",
				"'.mysql_real_escape_string((int)$reg_d[10]).'",
				"1"
			)');	
		//}	
		$uid = mysql_insert_id();
		if( $uid > 0 ) {
			setcookie("mailru", "enter", time()+86400);	
			if($refer != 0){
				$chat_msg = 'По Вашей ссылке зарегистрировался реферал: '.$reg_d[0].'!';
				mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$ref['city']."','".$ref['room']."','','".$ref['login']."','".$chat_msg."','-1','6','0')");
			}
			$text = '<b>'.$reg_d[0].'</b>, если у Вас возникли затруднения с выполнением квеста, перейдите по следующей ссылке - <a href=http://likebk.com/library/noobguide/ target=_blank >www.likebk.com/library/noobguide</a> ';
			//mysql_query("INSERT INTO `chat` (`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`new`) VALUES ('capitalcity','0','','".$reg_d[0]."','".$text."','".time()."','6','0','1')");
			$res = "<font color=red>Внимание!</font> Приветствуем новичка ".$reg_d[0]."! Успехов и процветания в нашем мире!";
			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$pl['city']."','','','".$toChat."','".$res."','".time()."','6','0')");

			//Премиум аккаунт
			premiumGold($uid);

			//Рубаха
			$re = $u->addItem(1,$uid,'|');
			if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Мироздатель" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			//Штаны
			$re = $u->addItem(73,$uid,'|');
			if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Мусорщик" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			//Котомка
			$re = $u->addItem(2133,$uid,'|sudba='.$reg_d[0].'|nosale=1|srok='.(86400*14).'');
				if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Архивариус" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			//Эликсиры
			//Зелье Жизни
			$re = $u->addItem(724,$uid,'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
			if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			//Эликсир Восстановления
			$re = $u->addItem(2418,$uid,'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
			if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			//Зелье Могущества
			$re = $u->addItem(870,$uid,'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
			if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			//Зелье Прозрения
			$re = $u->addItem(871,$uid,'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
			if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			//Зелье Стремительности
			$re = $u->addItem(872,$uid,'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
			if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			//Зелье Разума
			$re = $u->addItem(873,$uid,'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
			if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			//Великое зелье Стойкости
			$re = $u->addItem(1186,$uid,'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
			if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			//Великое зелье Отрицания 
			$re = $u->addItem(1188,$uid,'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
			if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			//Жажда Жизни +5
			$re = $u->addItem(3102,$uid,'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
			if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			//Холодный разум
			$re = $u->addItem(1460,$uid,'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
			if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			//Лечение легкой травмы
			$re = $u->addItem(4412,$uid,'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
			if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			//Лечение средней травмы
			$re = $u->addItem(4413,$uid,'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
			if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			//Лечение тяжелой травмы
			$re = $u->addItem(4414,$uid,'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
			if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			//Сокрушение
			$re = $u->addItem(994,$uid,'|sudba='.$reg_d[0].'|nosale=1',NULL,0);
			if( $re > 0 ) {
				mysql_query('UPDATE `items_users` SET `gift` = "Администратор" WHERE `id` = "'.$re.'" LIMIT 1');
			}
			$nast = 1001398;
			mysql_query('UPDATE `users` SET
			`host_reg` = "'.$nast.'"
			WHERE `id` = "'.mysql_real_escape_string($uid['id']).'" LIMIT 1');
			
			mysql_query('UPDATE `users` SET `online` = "'.time().'" WHERE `id` = "'.$uid.'" LIMIT 1');
			//Создаем статы персонажа
			mysql_query("INSERT INTO `online` (`uid`,`timeStart`) VALUES ('".$uid."','".time()."')");
			mysql_query("INSERT INTO `stats` (`id`,`stats`) VALUES ('".$uid."','s1=3|s2=3|s3=3|s4=3|rinv=40|m9=5|m6=10')");	
			
			//Заводим счет в банке
			mysql_query("INSERT INTO `bank` (`uid`,`block`,`create`,`pass`,`money1`,`money2`,`moneyBuy`) VALUES (
				'".$uid."',
				'0',
				'".time()."',
				'passs',
				'0.00',
				'0.00',
				'0.00'
				)");
			//Вешаем обезличивание персонажу
			mysql_query('UPDATE `users` SET`info_delete` = "1" WHERE `id` = "'.$uid.'" LIMIT 1');


			//мульты
			$ipm1 = mysql_fetch_array(mysql_query('SELECT * FROM `logs_auth` WHERE `uid` = "'.mysql_real_escape_string($uid).'" AND `ip`!="'.mysql_real_escape_string(IP).'" ORDER BY `id` ASC LIMIT 1'));
			$ppl = mysql_query('SELECT * FROM `logs_auth` WHERE `ip`!="" AND (`ip` = "'.mysql_real_escape_string(IP).'" OR `ip`="'.mysql_real_escape_string($ipm1['ip']).'" OR `ip`="'.mysql_real_escape_string($_COOKIE['ip']).'")');
			while($spl = mysql_fetch_array($ppl))
			{
				$ml = mysql_fetch_array(mysql_query('SELECT `id` FROM `mults` WHERE (`uid` = "'.$spl['uid'].'" AND `uid2` = "'.$uid.'") OR (`uid2` = "'.$spl['uid'].'" AND `uid` = "'.$uid.'") LIMIT 1'));
				if(!isset($ml['id']) && $spl['ip']!='' && $spl['ip']!='127.0.0.1')
				{
					mysql_query('INSERT INTO `mults` (`uid`,`uid2`,`ip`) VALUES ("'.$uid.'","'.$spl['uid'].'","'.$spl['ip'].'")');
				}
			}
			mysql_query("INSERT INTO `logs_auth` (`uid`,`ip`,`browser`,`type`,`time`,`depass`) VALUES ('".$uid."','".mysql_real_escape_string(IP)."','".mysql_real_escape_string($_SERVER['HTTP_USER_AGENT'])."','1','".time()."','')");
			
			//Обновяем таблицы
			mysql_query("UPDATE `users` SET `online`='".time()."',`ip` = '".mysql_real_escape_string(IP)."' WHERE `uid` = '".$uid."' LIMIT 1");
			if(!setcookie('login',$reg_d[0], (time()+60*60*24*7) , '' , '.likebk.com' ) || !setcookie('pass',md5($reg_d[1]), (time()+60*60*24*7) , '' , '.likebk.com' )) {
				die('Ошибка сохранения cookie.');
			}else{
				/*
				die('Спасибо за регистрацию!<br><script>function test(){ top.location.href="http://likebk.com/buttons.php"; } setTimeout("test()",1000);</script>');
				*/
			}
			
			setcookie('login',$reg_d[0],time()+60*60*24*7,'',$c['host']);
			setcookie('pass',md5($reg_d[1]),time()+60*60*24*7,'',$c['host']);
			setcookie('login',$reg_d[0],time()+60*60*24*7);
			setcookie('pass',md5($reg_d[1]),time()+60*60*24*7);
			
			//header('location: http://likebk.com/buttons.php');
		}
	}
	
	if( $good == 1 ) {
		$gd[6] = 1;
	}
	
	$rt .= '["'.$gd[0].'","'.$gd[1].'","'.$gd[2].'","'.$gd[3].'","'.$gd[4].'","'.$gd[5].'","'.$gd[6].'","'.$gd[7].'","'.$gd[8].'","'.$gd[9].'","'.$gd[10].'"]';
	//
	die($rt);
}

/* Данные регистрации */
$reg_id = microtime();
$reg_id = str_replace(' ','.',$reg_id);
$reg_id = str_replace('.','',$reg_id);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title>Регистрация в мире &laquo;Бойцовского Клуба&raquo;</title>
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/psi.js"></script>
<link rel="stylesheet" href="styles/register.css?<?=time()?>" type="text/css" media="screen"/>
</head>
<body>
<!--
<div style="position:absolute;bottom:0px;left:0px;width:100%;z-index:10000;color:#fff;text-align:center; height:110px; padding-bottom:10px;">ООО &quot;ЛайкБК&quot; &copy; <?=date('Y')?> <br><br>Россия, г. Москва, 3-й Угрешский пр., д. 8 <br> Контактный телефон: +7 (495) 999-47-24<br></div>
-->
<div align="center" style="color:red;" id="errorreg"></div>
<center>
<div class="rgfrm">
<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="62"><table width="100%" height="62" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="129" class="psi_tlimg">&nbsp;</td>
        <td align="center" class="psi_tline">
        	<div class="psi_fix">
<!--           	  <div class="psi_logo">&nbsp;</div> -->
            </div>
        </td>
        <td width="129" class="psi_trimg">&nbsp;</td>
      </tr>
      </table></td>
    </tr>
  <tr>
    <td>
    <table class="psi_mainin" width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="23" class="psi_mleft">&nbsp;</td>
        <td valign="top" width="460" height="401" class="psi_main_reg">
        <!-- main -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
        <form id="register_main" method="post" action="register.php">
        <input name="reg_id" id="reg_id" type="hidden" value="<?=$reg_id?>" />
        <div style="padding:20px;" align="right">
        <div style="padding-right:25px;">
        <center style="font-size:18px;"><img alt="Регистрация нового персонажа" src="images/reg_txt1.png" width="256" height="18"></center><br>
        <!-- -->
        <div style="padding-bottom:5px;">
        	<span style="display:inline-block;width:130px;">Логин персонажа</span> &nbsp; <script>psi.inputPrint('register_login<?=$reg_id?>','register_login<?=$reg_id?>',null,null,null,'psi_input1','width:191px;');</script>
            
            <span style="display:inline-block;width:15px;">
           	 <span id="login_error" style="display:none;" class='tip'><a tabindex="1"><em>?</em></a><span class='answer'><div id="login_error_text">&nbsp;</div></span></span>
        	</span>
        </div>
        <input id="refer_reg" type="hidden" name="refer" value="<?php echo $_GET['r']?>">
        <div style="padding-bottom:5px;">
        	<span style="display:inline-block;width:130px;">Пароль</span> &nbsp; <script>psi.inputPrint('register_pass<?=$reg_id?>','register_pass<?=$reg_id?>',null,null,'password','psi_input1','width:191px;');</script>
            <span style="display:inline-block;width:15px;">
           	 <span id="pass_error" style="display:none;" class='tip'><a tabindex="1"><em>?</em></a><span class='answer'><div id="pass_error_text">&nbsp;</div></span></span>
        	</span>
        </div>
        <div style="padding-bottom:5px;">
        	<span style="display:inline-block;width:130px;">Пароль еще раз</span> &nbsp; <script>psi.inputPrint('register_pass2<?=$reg_id?>','register_pass2<?=$reg_id?>',null,null,'password','psi_input1','width:191px;');</script>
            <span style="display:inline-block;width:15px;">
           	&nbsp;
            </span>
        </div>
        <div style="padding-bottom:5px;">
        	<span style="display:inline-block;width:130px;">Ваш пол</span> &nbsp;&nbsp;&nbsp;
            	<span style="padding-left:15px;">
                    <small class="cp radio1txt" id="register_sex<?=$reg_id?>block1" value="1">
					<script>psi.radioPring('register_sex<?=$reg_id?>','register_sex<?=$reg_id?>',true,null,'Мужской');</script></small>
                    &nbsp; &nbsp; &nbsp;
                    <small class="cp radio1txt" id="register_sex<?=$reg_id?>block2" value="2">
					<script>psi.radioPring('register_sex<?=$reg_id?>','register_sex<?=$reg_id?>',true,2,'Женский');
                    psi.radioPress('register_sex<?=$reg_id?>',$('#register_sex<?=$reg_id?>_1'),2);
                    </script></small>
                     &nbsp; &nbsp;&nbsp; 
                </span>
            <span style="display:inline-block;width:15px;">
           	 <span id="sex_error" style="display:none;" class='tip'><a tabindex="1"><em>?</em></a><span class='answer'><div id="sex_error_text">&nbsp;</div></span></span>
        	</span>
        </div>
        <div style="padding-bottom:5px;">
        	<span style="display:inline-block;width:130px;">День рождения</span> &nbsp;
			<div id="1register_dd<?=$reg_id?>" align="center" class="psi_input1_none psi_list" style="width:43px;">
			  <select name="register_dd<?=$reg_id?>" id="register_dd<?=$reg_id?>">
			    <?
				$i = 1;
				while( $i <= 31 ) {
					$j = $i;
					if( $j < 10 ) {
						$j = '0'.$j;	
					}
				?>
                <option value="<?=$i?>"><?=$j?></option>	
                <?
					$i++;
                }
				unset($i,$j);
				?>		  	
              </select>            
            </div>
            <div id="1register_mm<?=$reg_id?>" align="center" class="psi_input1_none psi_list" style="width:43px;">
			  <select name="register_mm<?=$reg_id?>" id="register_mm<?=$reg_id?>">
			    <?
				$i = 1;
				while( $i <= 12 ) {
					$j = $i;
					if( $j < 10 ) {
						$j = '0'.$j;	
					}
				?>
                <option value="<?=$i?>"><?=$j?></option>	
                <?
					$i++;
                }
				unset($i,$j);
				?>		  	
              </select> 
            </div>
            <div id="1register_yyyy<?=$reg_id?>" align="center" class="psi_input1_none psi_list" style="width:60px;">
			  <select name="register_yyyy<?=$reg_id?>" id="register_yyyy<?=$reg_id?>">
			    <?
				$i = date('Y') - 10;
				while( $i >= date('Y') - 80 ) {
					$j = $i;
				?>
                <option value="<?=$i?>"><?=$j?></option>	
                <?
					$i--;
                }
				unset($i,$j);
				?>		  	
              </select> 		  	
            </div>
            <span style="display:inline-block;width:15px;">
           	 <span id="bd_error" style="display:none;" class='tip'><a tabindex="1"><em>?</em></a><span class='answer'><div id="bd_error_text">&nbsp;</div></span></span>
        	</span>
        </div>
        <div style="padding-bottom:5px;">
        	<span style="display:inline-block;width:130px;">E-mail</span> &nbsp; <script>psi.inputPrint('register_mail<?=$reg_id?>','register_mail<?=$reg_id?>',null,null,null,'psi_input1','width:191px;');</script>
            <span style="display:inline-block;width:15px;">
           	 <span id="mail_error" style="display:none;" class='tip'><a tabindex="1"><em>?</em></a><span class='answer'><div id="mail_error_text">&nbsp;</div></span></span>
        	</span>
        </div>
        <div style="padding-bottom:5px;">
        	<span style="display:inline-block;width:130px;">Код с картинки</span> &nbsp;
			<!-- <img src="register.php?showcode=1" width="107" height="26" style="display:inline-block; vertical-align:bottom;"> -->
			<span id="captcha">
				<img onclick="reload(); return false;" src="register.php?showcode=1" width="107" height="26" style="display:inline-block; vertical-align:bottom;cursor:pointer;" />
			</span>
            <script>psi.inputPrint('register_key<?=$reg_id?>','register_key<?=$reg_id?>',null,null,null,'psi_input1','width:81px;');</script>
            <span style="display:inline-block;width:15px;">
           	 <span id="key_error" style="display:none;" class='tip'><a tabindex="1"><em>?</em></a><span class='answer'><div id="key_error_text">&nbsp;</div></span></span>
        	</span>
        				<span style="display:inline-block;color: #515860;width: 100%;text-align: left;font-size: 11px;margin-left: 172px;">Чтобы обновить Код, нажмите на картинку</span>
        </div>
        <br>
        <div align="center" title="Я принимаю все правила и соглашения, а так-же разрешаю оповещать меня по E-mail">
        	<small class="cp" id="register_rules<?=$reg_id?>block"><script>psi.checkPring('register_rules<?=$reg_id?>','register_rules<?=$reg_id?>',true);</script> &nbsp; <img style="margin-bottom:-15px;" src="images/reg_txt2.png" alt="" width="270" height="35"></small>
            <span style="display:inline-block;width:15px;">
           	 <span id="rules_error" style="display:none;" class='tip'><a tabindex="1"><em>?</em></a><span class='answer'><div id="rules_error_text">&nbsp;</div></span></span>
        	</span>
        </div>
        <br>
        <div align="center">
        	<div onClick="psi.testForm();" class="psi_btn">&nbsp;</div>
        </div>
        <!-- -->
        </div>
        </div>
        </form>
    </td>
    <!-- <td style="border-left:1px solid #161d21;" width="243">&nbsp;</td> -->
  </tr>
  </table>
<!-- main -->	
        </td>
        <td width="23" class="psi_mright">&nbsp;</td>
      </tr>
      </table>
    </td>
    </tr>
  <tr>
    <td height="62"><table width="100%" height="62" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="129" class="psi_dlimg">&nbsp;</td>
        <td class="psi_dline">&nbsp;</td>
        <td width="129" class="psi_drimg">&nbsp;</td>
      </tr>
    </table></td>
    </tr>
</table>
<center style="color:#fff; padding-top:80px; max-width:700px; text-align:justify; padding-bottom:25px;">
«LikeBK.com - твой любимый бойцовский клуб!» – это увлекательная браузерная онлайн игра, со своим уникальным миром и населением, эпическими боями и занимательным общением. LikeBK.com - основана на лучших традициях так называемого "Старого Бойцовского Клуба" или как его еще называются "БК 2" или combats. Здесь собраны самые лучшие моменты прошлых лет, разбавленные множеством современных необходимых требовательному игроку вещей.
Играть в Бойцовский клуб LikeBK можно совершенно бесплатно, вам требуется лишь доступ в интернет! Желаем Вам удачных побед и верных друзей на просторах мира LikeBK!
</center>
</div>
<!-- test window -->
</center>
<br><br>
<script>
psi.startTestingData(<?=$reg_id?>);
function reload () {
	var random_value = new Date().getTime(); 
	document.getElementById('captcha').innerHTML = '<img onclick="reload(); return false;"  src="register.php?showcode=1" width="107" height="26" style="display:inline-block; vertical-align:bottom;cursor:pointer;" />';

};
</script>
<?php include('js/ie/ie.php');?>
	<!— Yandex.Metrika counter —>
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter37318475 = new Ya.Metrika({
                    id:37318475,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/37318475" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!— /Yandex.Metrika counter —>
</body>
</html>
