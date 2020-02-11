<?
if(!defined('GAME'))
{
	die();
}
if(true==true) {
$uri = $_SERVER['REQUEST_URI'];
if(substr_count($uri,'?') < 1) {
	$uri = $uri.'?';
}

$s = 0;
if($u->info['sex'] == 1) {
	$s = 1;
}


if($u->info['fnq'] < 38) {
		$qobr = 'wm1';
		/*			Квест знакомство		*/
		if(isset($_GET['cancelstep'])) {
			//Завершаем обучение
			$u->info['fnq'] = 39;
			mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}
		if($u->info['fnq'] == 0) {
				
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//согласен, следующий диалог
				$u->info['fnq'] = 1;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
				unset($_GET['qstnextstep']);
			}elseif(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//Отказался, пишем fnq = 9999
				/*$u->info['fnq'] = 9999;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');*/
				
				unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 0) {
				$txt  = '<a>Здравствуйте, '.$u->info['login'].'!</a><br><br>';
				$txt .= 'Я рада видеть тебя и помогу освоиться в <b>Нашем Мире</b>.<br>';
				$txt .= 'В твоем <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> <b>Инвентаре</b> находится <b>Котомка</b>, которая увеличивает твой рюкзак на 50 единиц, <b>не забудь её надеть</b>. Котомка будет у тебя 2 недели, пока ты освоишься в Игре, а потом ты уже сможешь позаботиться о своих вещах самостоятельно.<br><br>';
				$txt .= 'Ты находишься в мире LikeBK.';
				$txt .= 'А сейчас я проведу тебя по улицам, познакомлю с жителями, помогу в первом бою и научу пользоваться различными возможностями твоего персонажа.<br><br>';
				
				$txt .= '<a>После выполнения нескольких моих заданий, ты станешь умелым Воином и получишь <u>немалую награду</u>!</a><br><br>';
				$txt .= 'С твоего согласия - давай начнем!<br>Если ты уже опытный Воин и тебе не нужны награды, ты можешь отказаться, и мы встретимся вновь, но позднее, на более старших уровнях.<br><br>';
				
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Начнем!</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
			}
			
		}
		
		/*			Описание характеристик и полезная информация		*/
		if($u->info['fnq'] == 1) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//согласен, следующий диалог
				$u->info['fnq'] = 2;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
		unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 1) {
				$txt  = '<a>Я рада, что ты ';
				
				if($s == 1) {
					$txt .= 'согласилась';
				}else{
					$txt .= 'согласился';
				}	
					
				$txt .= ' принять мою помощь.</a><br><br>';
				$txt .= 'Если ты случайно забудешь, какое задание тебе надо выполнить, ты всегда можешь нажать внизу справа на <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>Инвентарь</b>", и зайдя "<b>Состояние</b>", прочитать снова свое текущее задание.<br><br>';
				$txt .= '<a>Начнем с главного и <u>распределим параметры персонажа</u>.</a><br><br>';
				$txt .= '<u><b>Существуют 4 основных параметра:</b></u><br><br>';
				$txt .= '<b>- сила</b> - делает <u>удар сильнее</u> и позволяет взять с собой больше вещей, увеличивая размер рюкзака<br>';
				$txt .= '<b>- ловкость</b> - позволяет <u>увернуться</u> от удара противника<br>';
				$txt .= '<b>- интуиция</b> - позволяет наносить <u>критические удары</u>, которые вдвое сильнее обычного удара, и пробивать защиту противника<br>';
				$txt .= '<b>- выносливость</b> - увеличивает <u>жизнь</u>, а значит, возможность дольше находиться в бою, не погибая. Зеленая полоска НР (Hit Points) над твоим персонажем показывает количество оставшейся у тебя жизни.<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
			}
		}
		
		/*		Расскидываем характеристики и умения		*/
		if($u->info['fnq'] == 2) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//согласен, следующий диалог
				$u->info['fnq'] = 3;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
		unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 2) {
				$txt  = 'Внизу справа, нажми на <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>Инвентарь</b>", далее на "<b>Умения</b>", либо <small>• <a>Способности</a></small> и наверху слева ты увидишь список <b>параметров (статов)</b> и <img src="http://img.likebk.com/i/plus.gif" width="9" height="9"> рядом с каждым. <small>(Не забудь сохранить характеристики!)</small><br><br>Сейчас у тебя есть <b>6 свободных статов</b>, но развивая персонажа, ты будешь получать дополнительные статы.<br><br>';
				$txt .= '<u>На старших уровнях тебе добавятся параметры:</u><br>';
				$txt .= '<b>- интеллект</b> - нужен для использования основных магических свитков и заклятий, доступно с 4-го уровня<br>';
				$txt .= '<b>- мудрость</b> - нужна для увеличения запасов магической силы (Magic Points), доступно с 7-го уровня<br><br>';
				$txt .= '<a><u>Твое первое задание:</u></a> Зайди в <b>"Умения"</b> и нажав на <img src="http://img.likebk.com/i/plus.gif" width="9" height="9"> около параметров, <b>распредели все 3 свободных стата</b> по своему желанию. Не бойся ошибиться, в любой момент ты сможешь изменить свое распределение. Позже я научу тебя, как это делать.<br>';
				$txt .= 'После выполнения задания я вручу тебе первую награду.<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
			}
		}
		// Проверяем задание fnq 2
		if($u->info['fnq'] == 3) {
			if($u->info['ability'] == 0) {
				//задание выполнено
				$u->info['fnq'] = 4;
				
				$re = $u->addItem(4691,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1|nodelete=1');
				if( $re > 0 ) {
					mysql_query('UPDATE `items_users` SET `gift` = "Архивариус" WHERE `id` = "'.$re.'" LIMIT 1');
				}
				
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'",`money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
				unset($_GET['qstnextstep']);
			}
		}
		
		/*		Небольшая информация 		*/
		if($u->info['fnq'] == 4) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//согласен, следующий диалог
				$u->info['fnq'] = 5;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
				unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 4) {
				$txt  = '<a>Поздравляю! Ты справился с первым заданием и в награду получаешь <font color=green>Свиток Обучения</font>!</a><br><br>';
				$txt .= 'Опыт дает тебе рост и развитие. Чем больше опыта, тем сильнее твой персонаж. Зарабатывая опыт, ты поднимаешься по уровням и апам, на каждом из которых, ты получаешь <u>деньги (кредиты)</u> и <u>дополнительные статы</u>. Получить опыт ты можешь только в боях.<br><br>';
				$txt .= '<b>Таблица опыта</b> находится <a href="http://likebk.com/exp.php" target="_blank">тут</a>.<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';	
			}
		}
		
		if($u->info['fnq'] == 5) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//согласен, следующий диалог
				$u->info['fnq'] = 6;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
		unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 5) {
				$txt  = 'Зайдя в <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>Инвентарь</b>", в разделе "<b>Обмундирование</b>" ты найдешь <b>Рубашку</b> с <b>Штанами</b> - это твоя первая одежда. Когда ты вырастешь, ты оденешь мощные доспехи и пойдешь в Великие битвы.<br><br>';
				$txt .= 'В разделе "<b>Заклятия</b>" лежит <img src="http://img.likebk.com/i/items/100kexp.gif" width="40" height="25"> "<b>Свиток Обучения</b>". С помощью этого свитка ты сможешь <u>стать воином 1-го уровня</u>.<br><br>';
				$txt .= '<a><u>Твое второе задание:</u></a> Зайди в <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>Инвентарь</b>" и используй этот <b>Свиток Обучения</b>.<br>Действуй, и награда ждет тебя!<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
			}
		}
		
		if($u->info['fnq'] == 6) {
			if($u->info['exp'] >= 120) {
				
				$u->info['fnq'] = 7;
				
				/*//Зелье Жизни
				$u->addItem(724,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1',NULL,50);
				//Звезд сияние
				$u->addItem(1463,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1',NULL,1);
				//Звезд тяжесть
				$u->addItem(1462,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1',NULL,1);
				//Звезд Энергия
				$u->addItem(1461,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1',NULL,1);
				//Нектар Предчувствия
				$u->addItem(4038,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1',NULL,1);
				//Нектар Великана
				$u->addItem(4039,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1',NULL,1);
				//Звезд Предчувствия
				$u->addItem(4037,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1',NULL,1);
				//Звезд Змеи
				$u->addItem(4040,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1',NULL,1);*/
				
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
			}
		}
		
		if($u->info['fnq'] == 7) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//согласен, следующий диалог
				$u->info['fnq'] = 8;
				$u->info['money'] += 10;
				mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'",`fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');				
				unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 7) {
				$txt  = '<a>Ты отлично справился с заданием и получаешь <font color=green>Полезные свитки  и Зелье Жизни</font>!</a><br><br>';
				$txt .= 'Для того, чтобы снять одетую вещь, тебе достаточно зайти в <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>Инвентарь</b>" и нажать на нее. Оружие, доспех или свиток исчезнет из слота и появится в одном из разделов Инвентаря.<br>';
				$txt .= '<b>Зелье</b> лежит в твоем <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>Инвентаре</b>" во вкладке "<b>Эликсиры</b>". Оно поможет тебе <u>мгновенно восстановить жизнь</u> после боя, избежав ожидания в несколько минут.<br>';
				$txt .= 'Теперь ты готов выйти на "<u>Центральную площадь</u>", там находится здание "<b>Магазина</b>", я буду ожидать тебя там...<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
			}
		
		}
		
		if($u->info['fnq'] == 8) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//согласен, следующий диалог
				$u->info['fnq'] = 9;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
				unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 8) {
				if($u->room['name'] == 'Государственный магазин' || $u->room['name'] == 'Магазин') {
					$txt  = '<a>Мы находимся в Государственном магазине.</a><br><br>';
					$txt .= 'На полках ты видишь оружие, доспехи, свитки и амуницию.<br>Здесь тебе всегда рады предложить хороший и новый товар!<br><br>';
					$txt .= 'Пришло время купить тебе <u>первое обмундирование</u>. На твой выбор.<br>';
					$txt .= 'Меч обычно выбирают критовики, топор и нож - уворотчики, дубину - силовики.<br><br>';
					$txt .= '<a><u>Твое третье задание:</u></a> <b>Купи и одень свое первое оружие.</b> Покупать нож не советую, это слабое оружие и оно пользуется малым спросом в игре.<br><br>';
					$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
				}else{
					
		unset($_GET['qstnextstep']);
				}
			}
		}
		
		if($u->info['fnq'] == 9) {
			/* проверяем наличие предмета в инвентаре  */
			$qitm = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inShop` = "0" AND `inTransfer` = "0" AND (`inOdet` = 3 OR `inOdet` = 11) AND (`gift` = "" OR `gift` = "0" OR `gift` = "1") AND `inOdet` < 20 LIMIT 1'));
			if($qitm[0] >= 1) {		
				$u->info['fnq'] = 10;
				$u->info['exp'] += 100;		
				$u->addItem(3101,$u->info['id'],'|sudba='.$u->info['login'].'|nosale=1');	
				mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			}
		}
		
		if($u->info['fnq'] == 10) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//согласен, следующий диалог
				$u->info['fnq'] = 11;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
		unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 10) {
				$txt  = '<a>Поздравляю с покупкой первого боевого комплекта!</a><br><br>';
				$txt .= 'За выполнение задания ты получил свиток <b>Жажда Жизни +6</b> и еще <b>100 единиц опыта</b>!<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
			}
		}
		
		if($u->info['fnq'] == 11) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//согласен, следующий диалог
				$u->info['fnq'] = 12;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
		unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 11) {
				$txt  = '<a>Теперь я научу тебя, как сделать <u>удар оружием сильнее</u>.</a><br><br>';
				$txt .= 'В "<b>Умениях</b>", справа от статов ты видишь <b>Мастерство владения</b> (часто игроки называют их "<b>умения</b>" или "<b>умелки</b>").<br><br>';
				$txt .= 'У тебя есть <b>'.$u->info['skills'].' свободных параметра</b> для распределения.<br>Одно умение <u>усиливает удар соответствующим оружием</u>.<br><br>';
				$txt .= 'Магическое мастерство тебе будет нужно в будущем для использования различных свитков.<br><br>';
				$txt .= '<a><u>Твое четвертое задание:</u></a> Зайди в <b>Умения</b>, и, нажав на <img src="http://img.likebk.com/i/plus.gif" width="9" height="9"> <b>добавь '.$u->info['skills'].' мастерства владения тем оружием, которое ты купил</b>.<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>'; 	
			}
		}
		
		if($u->info['fnq'] == 12) {
			if($u->info['skills'] == 0) {
				$u->info['fnq'] = 13;		
				$u->info['money'] += 15;
				$u->info['exp'] += 150;
				mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'",`money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
		unset($_GET['qstnextstep']);
			}
		}
		
		if($u->info['fnq'] == 13) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//согласен, следующий диалог
				$u->info['fnq'] = 14;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
		unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 13) {
				$txt  = '<a>Поздравляю! Теперь твое оружие будет бить сильнее, чем раньше! В награду ты получаешь 150 опыта и 15 кредитов.</a><br><br>';
				$txt .= 'Ты уже достиг <b>'.$u->info['level'].'го уровня</b>!<br>';
				$txt .= 'Теперь, зайди в <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>Инвентарь</b>" и <u>распредели дополнительные свободные статы</u>, а затем одень свой <b>первый комплект</b> , после чего мы отправимся в твой <b>первый бой</b>.';
				$txt .= '<br><br>Не забывай периодически заглядываеть в <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>Инвентарь</b>" и распределять свободные статы и умения, которые добавляются тебе на каждом апе и уровне.';
				$txt .= '<br><br>Когда оденешься, выходи из <b>Магазина</b>, нажав на кнопку "<u>Центральная площадь</u>", иди в здание <b>Бойцовского клуба</b> и там нажми на комнату "<b>Зал воинов</b>".<br><br>Я буду ожидать тебя там. ';
				$txt .= '<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
			}
		}
		
		if($u->info['fnq'] == 14) {
			
			if($u->room['FR'] == 1) {
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					//согласен, следующий диалог
					$u->info['fnq'] = 15;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					
			unset($_GET['qstnextstep']);
				}
				
				if($u->info['fnq'] == 14) {
					$txt  = '<a>Мы в Главном здании Бойцовского клуба, где в любой комнате ты можешь проводить бои.</a><br><br>';
					$txt .= 'Наверху по центру, нажав на кнопку <b>Поединки</b>, ты увидишь разделы.<br><br>';
					$txt .= '<a><u>Физические бои</u></a> (доступны с 1 уровня с ботом, с 5 уровня с игроками) - бой 1 на 1 с противником.<br>';
					$txt .= '<a><u>Групповые бои</u></a> (доступны с 8 уровня) - группа на группу, например 5 на 5 человек.<br>';
					$txt .= '<a><u>Хаотические бои</u></a> (доступны с 8 уровня) - здесь собирается толпа народа и, случайным образом, делится на две половины, которым предстоит драться за победу.<br><br>';
					$txt .= 'Ты можешь подать свою заявку на бой, или принять чужую в <b>Физических боях</b>.<br><br>';
					$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
				}
			}
		}
		
		if($u->info['fnq'] == 15) {
		
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//согласен, следующий диалог
				$u->info['fnq'] = 16;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
		unset($_GET['qstnextstep']);
			}
		
			if($u->info['fnq'] == 15) {
				$txt  = 'Когда бой начнется, ты увидишь два столбика зон <b>ударов и блоков</b>. Выбери один удар и одну из зон блока, и нажми кнопку <b>Вперед!</b><br>Когда твой противник тебе ответит ты увидишь в логе боя результат вашего размена. <br><br>';
				$txt .= 'Твой первый бой будет, возможно, не самым мастерским, но главное начать! В будущем ты научишься изучать тактику противника и предполагать, куда он собирается ударить.<br>На старших уровнях <b>магические свитки</b> помогут тебе расширить тактику боя, пополнить здоровье в бою, напасть, породить своего клона и многое другое.';
				$txt .= '<br><br><a><u>Твое пятое задание:</u></a> Проведи свой первый <b>Физический бой с ботом</b>. Ты должен победить!<br><br>';
				$txt .= 'После окончания боя я появлюсь, чтобы поздравить тебя!<br><b>Вперед, смелый Воин!</b><br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
			}	
		}
		
		if($u->info['fnq'] == 16) {
			$lwn = mysql_fetch_array(mysql_query('SELECT * FROM `a_noob` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `vars` = "qst16" LIMIT 1'));
			if(!isset($lwn['id'])) {
				mysql_query('INSERT INTO `a_noob` (`uid`,`time`,`vars`,`vals`) VALUES ("'.$u->info['id'].'","'.time().'","qst16","'.$u->info['win'].'")');
				$lwn['id'] = mysql_insert_id();
				$lwn['vals'] = $u->info['win'];
			}
			
			if($u->info['win'] > $lwn['vals']) {
				//Квест пройден
				mysql_query('DELETE `a_noob` WHERE `id` = "'.$lwn['id'].'" LIMIT 1');
				
				$u->info['fnq'] = 17;		
				$u->info['money'] += 50;
				$u->info['exp'] += 500;
				mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW` + 1 WHERE `uid` = "'.$u->info['id'].'" AND `inOdet` > 0 AND `inOdet` < 20 LIMIT 20');
				mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'",`money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
				unset($_GET['qstnextstep']);
				
			}elseif(!isset($_GET['cancelzv']) && $u->info['battle'] == 0) {
				$zv = mysql_fetch_array(mysql_query('SELECT * FROM `zayvki` WHERE `id` = "'.$u->info['zv'].'" LIMIT 1'));
				if(isset($zv['id'])) {
					$prt = mysql_fetch_array(mysql_query('SELECT `id` FROM `stats` WHERE `zv` = "'.$u->info['zv'].'" AND `team` = "2" LIMIT 1'));
					if(isset($prt['id'])) {
						
					}elseif($zv['creator'] == $u->info['id'] && $zv['razdel'] == 2) {
						$bot = $u->addNewbot(1,NULL,$u->info['id'],NULL,true);
						if($bot > 0) {
							mysql_query('UPDATE `stats` SET `zv` = "'.$zv['id'].'",`team` = 2 WHERE `id` = "'.$bot.'" LIMIT 1');
						}
					}
				}
			}
		}
		
		if($u->info['fnq'] == 17) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//согласен, следующий диалог
				$u->info['fnq'] = 21;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
				unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 17) {
				$txt  = '<a>Поздравляю, теперь ты настоящий Воин !</a><br><a>Прими от меня награду - 500 единиц опыта и 50 кредитов!</a><br><br>';
				$txt .= 'У тебя в кармане есть звенящие монеты-кредиты.<br><br>';
				$txt .= 'Кроме кредитов, в нашем Мире существуют <b>еврокредиты</b> (игроки называют их <b>екры</b>).<br><br>';
				$txt .= 'Екры можно получить <u>следующими способами:</u><br>';
				$txt .= '- <b>Купить</b> у любого <b>дилера</b>, оплатив удобной для тебя валютой.<br>';
				$txt .= '- <b>Получить</b> выполняя различные задания и совершая подвиги.<br>';
				$txt .= '- <b>Обменять свои кредиты на екры</b>.<br><br>';
				$txt .= '<br>Некоторые редкие вещи в городе можно купить только за екры, и знание, как купить екры, тебе еще пригодится не раз.<br><br>';
				$txt .= 'А сейчас мы вернемся на <u>Центральную площадь</u>, которую многие называют <b><u>ЦП</u></b>. Там ты найдешь здание <b>Ремонтной мастерской</b>. Зайди туда и мы встретимся вновь.<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
			}
		}
		
		if($u->info['fnq'] == 21) {
			if($u->room['name'] == 'Ремонтная мастерская') {
				$u->info['fnq'] = 22;		
				$u->info['exp'] += 200;
				mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				
				unset($_GET['qstnextstep']);
			}
		}
		
		if($u->info['fnq'] == 22) {
			if($u->room['name'] == 'Ремонтная мастерская') {
				
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					//согласен, следующий диалог
					$u->info['fnq'] = 23;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					
					unset($_GET['qstnextstep']);
				}
				
				if($u->info['fnq'] == 22) {
					$txt  = '<a>Я хочу наградить тебя за внимание, подарив 200 единиц опыта!</a><br><br>';
					$txt .= 'Мы в <b>Ремонтной мастерской</b>. Сюда ты придешь еще не раз.<br>Здесь можно <u>починить</u> сломаные вещи, сделать <u>гравировку</u> на оружии и <u>улучшить параметры</u> своего оружия и вещей.';
					$txt .= '<br><br><a>Ремонт</a> - здесь за небольшую плату мастера починят твои вещи, которые ломаются в боях.<br>';
					$txt .= 'На вещах&nbsp;<img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30">&nbsp;в&nbsp;<strong>"Инвентаре"</strong>&nbsp;ты увидишь&nbsp;<strong>Долговечность</strong>.&nbsp;<br>';
					$txt .= 'Долговечность&nbsp;<strong>0/30</strong>&nbsp;значит, что вещь&nbsp;<u>новая</u>&nbsp;и ее износ 0 из 30 возможного максимальнго износа.<br>';
					$txt .= 'Долговечность&nbsp;<strong>12/30</strong>&nbsp;значит, что вещь&nbsp;<u>поломана</u>&nbsp;на 12 единиц.&nbsp;<br>';
					$txt .= 'Долговечность&nbsp;<strong>30/30</strong>&nbsp;значит, что&nbsp;<u>вещь "убита" полностью</u>, такую вещь ты не сможешь одеть и ремонтировать ее вдвое дороже.&nbsp;<br>';
					$txt .= '<br>Старайся чинить вещи вовремя. Максимальный износ вещи уменьшается со временем, и когда-нибудь тебе придется купить новую, но это случится нескоро.<br><br>';
					$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
				}
			}
		}
		
		if($u->info['fnq'] == 23) {	
			
			if($u->room['name'] == 'Ремонтная мастерская') {
				
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					//согласен, следующий диалог
					$u->info['fnq'] = 24;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					
					unset($_GET['qstnextstep']);
				}
				
				$txt  = '<a>Гравировка</a> - здесь ты можешь <u>написать любимую фразу на своем оружии</u> и она будет видна при наведении мышки на него в информации о персонаже.<br><br>';
				//$txt .= '<a>Модифицирование</a> - любую вещь можно модифицировать, <u>то есть улучшить и усилить ее параметры</u>. Для модификации нужен опытный маг. Цена модификации равна цене вещи, поэтому нет смысла улучшать те слабые вещи, которые сейчас на тебе. Позже, когда ты купишь себе мощные доспехи, ты вернешься сюда вместе с сильным магом.<br><br>';
				$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a>';
			}
		}
		
		if($u->info['fnq'] == 24) {	
			
			if($u->room['name'] == 'Ремонтная мастерская') {
				
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					//согласен, следующий диалог
					$u->info['fnq'] = 25;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
					unset($_GET['qstnextstep']);
				}
				
				if($u->info['fnq'] == 24) {	
					$txt .= '<Br><br><a><u>Твое шестое задание:</u></a> сними любую поломанную вещь и, зайдя в раздел <a>Ремонт</a>, <b>почини её полностью</b>.<br><br>';
					$txt .= '<a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
				}
			}
		}
		
		if($u->info['fnq'] == 25) {
			if($u->room['name'] == 'Ремонтная мастерская') {
				//$ir = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `iznosNOW` = "0" AND `delete` = "0" AND `inShop` = "0" AND `inTransfer` = "0" AND `item_id` = "143" LIMIT 1'));
				if(isset($_GET['remon'])) {
					//квест пройден
					$u->info['fnq'] = 26;		
					$u->info['exp'] += 100;
					mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				}
			}
		}
		
		if($u->info['fnq'] == 26) {
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				//согласен, следующий диалог
				$u->info['fnq'] = 27;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
				unset($_GET['qstnextstep']);
			}
			if($u->info['fnq'] == 26) {
				$txt  = '<a>Ты отлично справился с заданием и получаешь 100 единиц опыта!</a><br><br>';
				$txt .= 'Теперь мы сходим в&nbsp;<strong>"Хижину Знахаря"</strong>.<br>Выйди на&nbsp;<strong>Центральную Площадь</strong>&nbsp;и поверни налево на&nbsp;<strong>"Западную окраину"</strong>.&nbsp;<br><br>Там ты найдешь&nbsp;<strong>"Хижину Знахаря"</strong>, где я буду тебя ждать.';
				$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
			}
		}
		
		if($u->info['fnq'] == 27) {	
			if($u->room['name'] == 'Хижина Знахаря') {
				
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					//согласен, следующий диалог
					$u->info['fnq'] = 28;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
					unset($_GET['qstnextstep']);
				}
				
				if($u->info['fnq'] == 27) {			
					$txt  = '<a>Мы в Хижине Знахаря. </a><br><br>';
					$txt .= 'Здесь ты можешь изменить свои статы и умения:<br>';
					$txt .= '<br>';
					$txt .= '- сбросить&nbsp;<strong>одновременно все умения</strong>, чтобы перераспределить их<br>';
					$txt .= '- сбросить&nbsp;<strong>одновременно все статы</strong>, чтобы перераспределить их<br>';
					$txt .= '- перераспределить статы по одному,&nbsp;<strong>из одного в другой</strong>.<br>';
					$txt .= '<br>';
					$txt .= '<u>Услуги Знахаря сегодня бесплатны</u>. ';
					//$txt .= 'Затем у тебя появится <strong>один дополнительный бесплатный сброс статов и умений</strong>, после чего за все придется платить.<br>';
					//$txt .= 'Однако,&nbsp;<u>каждую неделю</u>&nbsp;у тебя будет появляться&nbsp;<u>одно бесплатное перераспределение</u>&nbsp;из стата в стат.&nbsp;<br>';
					$txt .= 'Постарайся использовать бесплатности с выгодой для себя.<br>';
					$txt .= '<br>';
					$txt .= 'Можешь попробовать изменить свои статы, а затем иди в&nbsp;<strong>Первый комиссионный магазин</strong>&nbsp;на&nbsp;<strong>Центральной площади</strong>.&nbsp;<br>';
					$txt .= 'Там мы снова встретимся.';
					$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>'; 
				}
			}	
		}
		
		if($u->info['fnq'] == 28) {	
			if($u->room['name'] == 'Комиссионный магазин') { # 9 =ЦП // Комиссионный магазин 272
				
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					//согласен, следующий диалог
					$u->info['fnq'] = 29;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
					unset($_GET['qstnextstep']);
				}
				if($u->info['fnq'] == 28) {	
					$txt  = '<a>Мы в Комиссионном магазине, который часто называют "комок".</a><br><br>';
					$txt .= 'Он похож на обычный Магазин, но здесь игроки продают свои вещи другим игрокам. Часто вещи здесь дешевле, чем в обычном, но бывают и очень дорогие, например с уникальной модификацией или топ-вещи.<br><br>';
					$txt .= 'Любой игрок может сдать сюда свою вещь, выставив желаемую цену. Если вещь будет куплена, он получит деньги за <u>вычетом 5% комиссии</u>. Цену своей вещи можно менять, или совсем забрать ее с прилавка.';
					$txt .= '<br><br>Заглядывай сюда в поисках дешевых или топовых вещей, а сейчас, выйди на <u>Центральную Площадь</u>';
					$txt .= ' и оттуда перейди по указателю направо на <u>Страшилкину улицу</u>, оттуда перейди направо в <u><b>Восточную окраину</b></u>. Там мы снова встретимся.';
					$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
				}
			}
		}
		
		if($u->info['fnq'] == 29) {
			if($u->room['name'] == 'Восточная окраина') {
				$u->info['fnq'] = 30;		
				$u->info['money'] += 10;
				$u->info['exp'] += 1250;
				mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'",`money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
				unset($_GET['qstnextstep']);
			}
		}
		
		if($u->info['fnq'] == 30) {
			if($u->room['name'] == 'Восточная окраина') {
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					//согласен, следующий диалог
					$u->info['fnq'] = 32;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
					unset($_GET['qstnextstep']);
				}
				
				if($u->info['fnq'] == 30) {	
					$txt  = '<a>Мы в Восточной окраине.</a><br><br>';
					$txt .= 'Я расскажу тебе о зданиях, построенных на ней, но прежде, награжу тебя за долгое хождение по городу.<br><br>';
					$txt .= 'Ты получаешь <b>10 кр.</b> и <b>1250 опыта</b> за выполнение моих просьб!<br><br>';
					$txt .= '<a>- Зоомагазин</a> - здесь можно <b>приобрести питомца</b> который будет помогать тебе в сражениях.<br>';
					$txt .= '<a>- Книжный магазин</a> - если ты хочешь <b>быть сильнее</b> тебе нужны <b>новые приемы</b>, они продаются в этом здании.<br>';
					$txt .= '<a>- Портал к подземельям</a> - здесь вы можете отправиться в приключения в поисках удивительных наград.<br>';
					$txt .= '<a>- Алтарь Крови</a> - здесь вы можете купить уникальные артефакты "Кольцо Крови" и "Кольцо Алтаря", которые дадут неоспоримые преимущества в хаотических боях.<br>';
					$txt .= '<br>Перейдите на <u>Центральной Площади</u>. Там мы встретимся вновь.<br>';
					$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
				}
			}
		}
		
		
		if($u->info['fnq'] == 31) {
			if($u->room['name'] == 'Почта') {		
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					//согласен, следующий диалог
					$u->info['fnq'] = 32;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
					unset($_GET['qstnextstep']);
				}		
				if($u->info['fnq'] == 31) {
					$txt  = '<a>Я ждала тебя. Ты быстро добрался.</a><br><br>';
					$txt .= 'Почтой можно передать вещь, деньги или телеграмму персонажу, который <u>не находится сейчас в игре</u>. Почта берет небольшой процент за свои услуги. Передавать вещи и деньги можно с <b>4го</b> уровня.';
					$txt .= 'В <img src="http://img.likebk.com/i/buttons/chatBtn13.gif" width="30" height="30"> "<b>Инвентарь</b>" ты видишь размер рюкзака и вес своих вещей.<br>';
					$txt .= '<a>Рюкзак (масса: 17.0/24)</a> значит, что <u>вес твоих вещей 17.0 единиц</u>, а всего ты <u>можешь унести в рюкзаке 24 единицы веса</u>.<br>';
					$txt .= 'Если вес вещей больше размера рюкзака - ты не сможешь передвигаться, покупать или брать у кого-то вещи.<br><br>';
					$txt .= 'Размер рюкзака можно увеличить статом "<b>сила</b>", или купить "<b>Мешок Торговца</b>" в Магазине. Однако, Почта не смотрит на размер рюкзака, и здесь ты можешь передать вещи тому, у кого в рюкзаке перевес.';
					$txt .= '<br>На <b>4м</b> уровне у тебя появится кнопка <img src="http://img.likebk.com/i/buttons/chatBtn16.gif" width="30" height="30"> "<b>Передачи</b>", где ты сможешь передать вещь или деньги тому, <u>кто находится с тобой в одной комнате</u>, или продать вещь без Комиссионного магазина.';
					$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
				}
			}
		}
		
		if($u->info['fnq'] == 32) {
			if($u->room['name'] == 'Центральная площадь') {
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					$u->info['fnq'] = 33;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
					unset($_GET['qstnextstep']);
				}		
				if($u->info['fnq'] == 32) {
					$txt  = '<a>Мы на центральной площади</a><br><br>';
					$txt .= 'Ты должен узнать еще кое-что о нашем Мире.<br><br>';
					$txt .= 'Здесь существуют <a>склонности</a>, которые бывают четырех видов:';
					$txt .= '<br>- <img src="http://img.likebk.com/i/align/align3.gif" width="12" height="15"> <b>Темная</b>';
					$txt .= '<br>- <img src="http://img.likebk.com/i/align/align1.gif" width="12" height="15"> <b>Светлая</b>';
					$txt .= '<br>- <img src="http://img.likebk.com/i/align/align7.gif" width="12" height="15"> <b>Нейтральная</b>';
					$txt .= '<br>- <img src="http://img.likebk.com/i/align/align2.gif" width="12" height="15"> <b>Хаос</b>';
					$txt .= '<br><br><img src="http://img.likebk.com/i/align/align3.gif" width="12" height="15">Темные и <img src="http://img.likebk.com/i/align/align1.gif" width="12" height="15">Светлые - заклятые враги и всегда воюют между собой';
					$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
				}
			}
		}
		
		if($u->info['fnq'] == 33) {	
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				$u->info['fnq'] = 34;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
				unset($_GET['qstnextstep']);
			}	
			if($u->info['fnq'] == 33) {
				$txt  = '<img src="http://img.likebk.com/i/align/align3.gif" width="12" height="15"><a>Темная склонность</a> стремится к беспредельной свободе. Темные, как вампиры, могут кусать по ночам серых (без склонности) и нейтральных персонажей, забирая у них жизнь и пополняя свою. Защититься от вампира можно';
				$txt .= ' <b>Свитком Чеснока</b>, купив его в Магазине.';
				$txt .= '<br><br>';
				$txt .= '<img src="http://img.likebk.com/i/align/align1.gif" width="12" height="15"><a>Светлая склонность</a> стремится к порядку. Светлые имеют более быстрое восстановление жизни днем и защиту от вампиров ночью.<br>';				
				$txt .= '<br><br><img src="http://img.likebk.com/i/align/align7.gif" width="12" height="15"><a>Нейтральная склонность</a> стремится к балансу между Тьмой и Светом. Нейтралы имеют усиленный удар в кулачных боях (без оружия) и защиту от травм. Даже из кровавого боя нейтрал может выйти без травмы.';
				$txt .= '<br><br><img src="http://img.likebk.com/i/align/align2.gif" width="12" height="15"><a>Хаос</a> - наказание за проступки.';
				$txt .= ' Только <img src="http://img.likebk.com/i/align/align1.99.gif" width="12" height="15">Паладины могут наложить заклятие Хаоса на игрока. <b>Паладины</b> относятся к Светлой склонности, но имеют свой значок и права, и ';
				$txt .= '<u>следят за соблюдением законов этого Мира</u>. Хаосники не могут передавать вещи и деньги и имеют уменьшенный вдвое опыт в боях.';
				$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
			}
		}
		
		if($u->info['fnq'] == 34) {
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				$u->info['fnq'] = 37;		
				$u->info['money'] += 15;
				$u->info['exp'] += 148000;
				mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'",`money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
				echo '<script>location.href="buttons.php';
				unset($_GET['qstnextstep']);
			}
			if($u->info['fnq'] == 34) {
				$txt  = 'Получить <img src="http://img.likebk.com/i/align/align1.gif" width="12" height="15"><a>Светлую</a>, <img src="http://img.likebk.com/i/align/align7.gif" width="12" height="15"><a>Нейтральную</a> или <img src="http://img.likebk.com/i/align/align3.gif" width="12" height="15"><a>Темную</a> склонность можно двумя путями:<br><br>';
				$txt .= '- <u>вступить в клан</u> и автоматически получить склонность клана. Вступать в клан можно начиная с <b>8го уровня</b>.<br>';
				$txt .= '- <u>купить значок склонности</u> в магазине "Березка".<br> Стоимость значка - <b>5 екр</b>. Купить значок можно на <b>любом уровне</b>.';
				$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
			}	
		}
		
		if($u->info['fnq'] == 35) {
			if($u->room['name'] == 'Цветочный магазин') {
				if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
					$u->info['fnq'] = 36;
					mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
					unset($_GET['qstnextstep']);
				}
				if($u->info['fnq'] == 35) {
					$txt  = '<a>Мы в магазине.</a><br><br>';
					$txt .= 'В <b>Цветочном магазине</b> ты можешь собрать букет цветов или купить сувенир здесь и подарить их любому персонажу.<br><br>';
					$txt .= 'Букеты собираются в <b>Цветочном магазине</b> по рецептам, которые можно найти на сайте <u>Библиотеки</u> или на других клановых сайтах. ';
					$txt .= 'Сувениры бывают обычные и уникальные. Уникальный сувенир, можно создать и оплатить екрами.<br><br>';
					$txt .= '<a>Твое задание:</a>';
					$txt .= ' Зайди в раздел "<b>Подарки</b>" справа и купи сувенир или открытку, затем нажми на "<b>Сделать подарки</b>".';
					$txt .= '<br>Выбери одного из двух Ангелов - <img src="http://img.likebk.com/i/align/align3.gif" width="12" height="15"><b>Мусорщик</b> , <img src="http://img.likebk.com/i/align/align1.gif" width="12" height="15"><b>Мироздатель</b> , <img src="http://img.likebk.com/i/align/align7.gif" width="12" height="15"><b>Хранитель</b> , <img src="http://img.likebk.com/i/align/align2.gif" width="12" height="15"><b>Лорд Разрушитель</b>  - и подари ему свой первый подарок в этом Мире.';
					$txt .= '<br><br>Выбери подарок по своему вкусу, но не забывай, что ты даришь его <b>Ангелу</b>. Будь уважителен к Высшим Силам.';
					$txt .= '<br><br><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Далее &raquo;</a> <a style="float: right; margin-right: 15px;" target="main" href="'.$uri.'&cancelstep">Закончить обучение</a>';
				}
			}
		}
		
		/*if($u->info['fnq'] == 36) {
			$u->info['fnq'] = 37;		
			$u->info['money'] += 15;
			$u->info['exp'] += 148000;
			//mysql_query('UPDATE `bank` SET `money2` = `money2` + 5 WHERE `uid` = "'.$u->info['id'].'" AND `block` = "0" ORDER BY `id` ASC LIMIT 1');
			mysql_query('UPDATE `stats` SET `exp` = "'.$u->info['exp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');		
			mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'",`money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');	
			//mysql_query("INSERT INTO `eff_users` (`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `sleeptime`, `no_Ace`) VALUES (276, ".$u->info['id'].", 'VIP (50)', 'add_silver=1', 30, ".(time()-30*86400+3*86400).", 0, 0, 1)");
			unset($_GET['qstnextstep']);
		}*/
		
		if($u->info['fnq'] == 37) {
			
			if(isset($_GET['qstnextstep']) && $_GET['qstnextstep'] == $u->info['fnq']) {
				$u->info['fnq'] = 38;
				mysql_query('UPDATE `users` SET `fnq` = "'.$u->info['fnq'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');			
				unset($_GET['qstnextstep']);
			}
			
			if($u->info['fnq'] == 37) {
				$txt  = '<a>Поздравляю! Ты справился со всеми заданиями и получаешь в награду еще 148000 единиц опыта и 15 кредитов!</a><br><br>';
				$txt .= 'Ты достиг <b>'.$u->info['level'].'го уровня</b>, умеешь драться и выживать в этом Мире.<br>Впереди долгий путь Воина и я желаю тебе успехов на этом пути. ';
				$txt .= '<br><br>Найди новых друзей и заклятых врагов, выбери Склонность, изучи все уголки этого Мира. ';
				$txt .= 'Удачного пути <b>'.$u->info['login'].'</b>, будь смел и бесстрашен!';
				$txt .= '<br>Возвращайся в <b>Главное Здание</b> клуба и вступай в битвы!<br><br><a>Твои приключения начались и все зависит только от тебя!</a><br>';
				$txt .= '<u>Мы еще не раз увидимся в будущем. До встречи!</u>';
				$txt .= '<br><br><center><a target="main" href="'.$uri.'&qstnextstep='.$u->info['fnq'].'">Закрыть</a></center>';
			}
		}

}
/* -------------- ПОКА-ЧТО ВСЕ , для ньюбов :) --------------------------- */

if(isset($txt) && $txt != '') {
	echo '<script>top.qn_win(\''.$txt.'\',\''.$qobr.'\')</script>';
}else{
	echo '<script>top.qn_win_cls();</script>';
}

echo '<!-- QUEST END -->';
}
?>