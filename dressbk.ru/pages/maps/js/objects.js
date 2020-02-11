 var imP1 = 'pages/maps/images/';
 var imP11 = 'pages/maps/images/obj/';
 var imP12 = 'pages/maps/images/mobs/';
 var imP2 = 'pages/maps/images/';
 var imP21 = 'pages/maps/images/objects/';
 var imP3 = 'pages/maps/images/items/';
 var imP4 = 'pages/maps/images/klan/';
 var imP50 = 'pages/maps/images/chars/0/';
 var imP51 = 'pages/maps/images/chars/1/';
 var imP41 = 'pages/maps/images/misc/icons/';
 var imP42 = 'pages/maps/images/misc/micro/';
 var d1 = 'filter: invert()';
 var d2 = 'pages/maps/images/destiny.gif';
 var d3 = 'Этот предмет будет связан общей судьбой с первым, кто получит его.';
 var d4 = 'pages/maps/images/podarok.gif';
 var d5 = 'Подарок. Предмет нельзя передать.';
 var d6 = 'filter: gray()';
 var d7 = 'Этот предмет будет связан общей судьбой с первым, кто оденет его.';
//'+imP41+'

 	var features = {
//птп
		oceanFountain: {
name: 'Фонтан Заживления',icon: imP11 + 'fountain2.gif', src: imP21 + 'well03.png',
descr: 'Вы получите "Заживляющая Настойка"'
		},
		denyingFountain: {
name: 'Фонтан Заживления',icon: imP11 + 'fountaindeny.gif', src: imP21 + 'well06.png',
descr: 'Фонтан не будет работать, пока жив призрак. Вы получите "Заживляющий Эликсир"'
		},
		chest: {
name: 'Сундук',icon: imP11 + 'sunduk.gif',src: imP21 + 'smag_collect1.png',
descr: 'Можно найти морковки, ингредиенты'
		},
		katiStolb: {
name: 'Замаскированный Обменник',icon: imP11 + 'kk_changer.png',src: imP21 + 'kk_changer.png',
descr: 'Стоит для красоты...'
		},
		greatDenyingFountain: {
name: 'Фонтан Обновления',icon: imP11 + 'fountaindeny.gif', src: imP21 + 'well06.png',
descr: 'Вы получите - <img src="'+imP41+'p1k_regenbuff.gif" /> "Ускоренное обновление" - Максимальный запас здоровья увеличен на 30%. Регенерация маны и жизни увеличена в два раза.Действует 3 часа. Только в метро.'
		},
		plusFifteenFountain: {
name: 'Фонтан Зачарованных Гор',icon: imP11 + 'well05.gif', src: imP21 + 'well05.gif',
descr: 'Вы получите - <img src="'+imP41+'p1k_speedbuff.gif" /> "Тонизирующий эффект" - скорость перемещения увеличена. Нажав второй раз вас переместит в клетку H13 4го этажа. <br> Также, в этой клетке находится Ключ №3 от "Разрушенной Мастерской Забытых Мастеров" '
		},
		lostMastersCupel: {
name: 'Разрушенная Мастерская забытых мастеров',icon: imP11 + 'lmc.gif',src: imP21 + 'well08.png',
descr: 'Можно найти Восстановление энергии 120HP, Сосуд жизненных сил, морковки на ману и хп.'
		},
gritlab:{name:'Лаборатория Грита',icon: imP11 + 'gritlab.gif', src: imP21 + 'p1k_gritlab.png',
descr: 'При наличии эффекта <img src="'+imP41+'p1k_summoner.gif" />"Знания Мастера Грита" + 20 шт."Прах неупокоенного" и 20 шт. "Осколки голема" можно получить "Реагенты для ритуала призыва"<br /> использовать может только один из команды. '
		}, 
gralt:{name:'Техноалтарь',icon: imP11 + 'gralt.gif', src: imP21 + 'p1k_altar.png',
descr: 'Имея "Реагенты для ритуала призыва" можно вызвать Одержимого Духом Голема на клетку F17 4го этажа'
		},
grcrt:{name:'Старнинный Холст',icon: imP11 + 'kart.gif',w:50, h:70,src: imP21 + 'p1k_holst.png',
descr: 'Интересно, кому пришла в голову "светлая" мысль, сохранить для истории столь страшнющую рожу.<br /> Если ее кликнуть под действием эффекта <img src="'+imP41+'p1k_summon_killer.gif" />"Ощущение чужой воли", то он снимется и вы получите Печать рода Гритов.'
		}, 
		pottbl: {
name: 'Потеряная Табкличка',icon: imP11 + 'sign1.gif',w:67, h:45, src: imP21 + '2/sign1.png',
descr: 'Не забыть... Четыре десятка в равных долях.'
		},
  chestcap41: {
name: 'Потерянный Сундук + Сундук Стража',icon: imP11 + 'chest24.gif',src: imP11 + 'chest24.png',
descr: 'В <b>"Потерянном Сундуке"</b> можно найти: Сосуд жизненных сил, Заживляющий Эликсир, Восстановление энергии 120HP. <BR />В <b>"Сундуке Стража"</b> вы найдёте <BR /><b>Верхнюю часть Ключа портала</b> - <img src='+imP3+'key_amul_1.gif width="32" height="32">.'
		},
  chestcap42: {
name: 'Гостевой Сундучок + Сундук Стража',icon: imP11 + 'chest24.gif',src: imP11 + 'chest24.png',
descr: 'В <b>"Гостевом Сундучке"</b> можно найти: Сосуд жизненных сил, Заживляющий Эликсир, Восстановление энергии 120HP. <BR />В <b>"Сундуке Стража"</b> вы найдёте <BR /><b>Правую часть Ключа портала</b> - <img src='+imP3+'key_amul_2.gif width="32" height="32">.'
		},
  chestcap43: {
name: 'Сундук Стража', icon: imP11 + 'chest04.gif',src: imP21 + 'chest04.png',
descr: 'В <b>"Сундуке Стража"</b> вы найдёте <b>Левую часть Ключа портала</b> - <img src='+imP3+'key_amul_3.gif width="32" height="32">.'
		},
  chestcap5: {
name: 'Потерянный Сундук',icon: imP11 + 'chest02.gif',src: imP21 + 'chest02.png',
descr: 'В <b>"Потерянном Сундуке"</b> можно найти: Сосуд жизненных сил, Заживляющий Эликсир, Восстановление энергии 120HP'
		},
  chestcap51: {
name: 'Потерянный Сундук',icon: imP11 + 'chest03.gif',src:  imP11 + 'chest03.png',
descr: 'В нём лежит <b>Ключ от сокровищницы</b> - <img src='+imP3+'Key_0_TR.gif width="32" height="32">,<BR /> с помощью которого открывается решетка на <b>N5</b>.'
		},
		chestcap52: {
name: 'Гостевой Сундучок',icon: imP11 + 'smagcollect1.gif',src: imP21 + 'smag_collect1_1.png',
descr: 'В нём можно найти Сосуд жизненных сил, Заживляющий Эликсир, Восстановление энергии 120HP. '
		},
  chestcap531: {
name: 'Потерянный Сундук + Сундук Стража',icon: imP11 + 'chest24.gif',src: imP11 + 'chest24.png',
descr: 'В <b>"Потерянном Сундуке"</b> можно найти: Сосуд жизненных сил, Заживляющий Эликсир, Восстановление энергии 120HP  <BR />В <b>"Сундуке Стража"</b> Вы найдёте <b>Первую часть руны</b> -<img src="'+imP3+'key_TR_1.gif" width="32" height="32"  /> '
		},
  chestcap532: {
name: 'Потерянный Сундук + Сундук Стража',icon: imP11 + 'chest24.gif',src: imP11 + 'chest24.png',
descr: 'В <b>"Потерянном Сундуке"</b> можно найти: Сосуд жизненных сил, Заживляющий Эликсир, Восстановление энергии 120HP <BR />В <b>"Сундуке Стража"</b> Вы найдёте <b>Пятая часть руны</b> -<img src="'+imP3+'key_TR_5.gif" width="32" height="32"  /> '
		},
  chestcap54: {
name: 'Сундук Стража', icon: imP11 + 'chest04.gif',src: imP21 + 'chest04.png',
descr: 'В <b>"Сундуке Стража"</b> Вы найдёте <b>Вторая часть руны</b> - <img src="'+imP3+'key_TR_2.gif" width="32" height="32"  /> '
		},
  chestcap541: {
name: 'Сундук Стража', icon: imP11 + 'chest04.gif',src: imP21 + 'chest04.png',
descr: 'В <b>"Сундуке Стража"</b> Вы найдёте <b>Третья часть руны</b> - <img src="'+imP3+'key_TR_3.gif" width="32" height="32"  /> '
		},
  chestcap542: {
name: 'Сундук Стража', icon: imP11 + 'chest04.gif',src: imP21 + 'chest04.png',
descr: 'В <b>"Сундуке Стража"</b> Вы найдёте <b>Четвёртая часть руны</b> - <img src="'+imP3+'key_TR_4.gif" width="32" height="32"  /> '
		},





//санд

  doorsnd: {
name: 'Вход в Лабораторию', icon: imP11 + 'door1.gif',w:126, h:87, src: imP21 + '1/door2.png',
descr: 'Для прохода нужен "Ключ от металлургической лаборатории".'
		},
  outsd: {
name: 'Спуск',icon: imP11 + 'enter1.gif', src: imP21 + 'les1up1.png',
descr: 'Спуск на 4й этаж в клетку G2.'
		},
		lastLadder2: {
name: 'загадочное отверстие',icon: imP11 + 'sar2.gif',src: imP21 + '2/sar2.png',
descr: 'Спуск на 4й этаж в клетку G2.'
		},
		lastLadder22: {
name: 'загадочное отверстие',icon: imP11 + 'sar2.gif',src: imP21 + '2/sar2.png',
descr: 'Выход на поверхность. <br><font color=red>При выходе получите задержку на посещение пещеры - 90 минут с момента выхода</font><br> Нужен Мерцающий ключ №3'
		},
		sign1: {
name: 'Указатель',icon: imP11 + 'sign1.gif',w:67, h:45, src: imP21 + '2/sign1.png',
descr: 'Кладовая - направо, лаборатория - налево, ноги вытирать тут.'
		},
		sign2: {
name: 'Указатель',icon: imP11 + 'sign1.gif',w:67, h:45, src: imP21 + '2/sign1.png',
descr: 'Охраныка па галаве не стукать (все ровно ничиго не палучите), лутче пакармите. Рульф Виликий.'
		},
		strslpr: {
name: 'Слитки руды и Пустынной руды',icon: imP11 + 'strslpr.gif',w:80, h:80, src: imP11 + 'strslprbig.gif',
descr: 'Можно найти небольшой слиток металла '
		},
  fntsd: {
name: 'Фонтан Благорасположения',icon: imP11 + 'lmc.gif',src: imP21 + 'well08.png',
descr: 'Может быть морковка на хп или ману, свитки лечения тяжелых травм.'
		},
		gardsand: {
name: 'Решетка',icon: imP11 + 'gard.gif',src: imP21 + 'grate.png',
descr: 'Для прохода необходим "Ключ главного прораба" '
		},
		gardsand2: {
name: 'Решетка',icon: imP11 + 'gard.gif',src: imP21 + 'grate.png',
descr: ''
		},
		gardsand3: {
name: 'Решетка',icon: imP11 + 'gard.gif',src: imP21 + 'grate.png',
descr: 'Для прохода необходим "Ключ от центрального хранилища" '
		},
		vagsd: {
name: 'Тележка',icon: imP11 + 'vagon.gif',src: imP21 + 'lorry01.png',
descr: 'Вы можете найти здесь: частицы металла, небольшой слиток металла, горючий камень.'
		},
		otxsd: {
name: 'Отходы',icon: imP11 + 'glmusweap.gif',w:95, h:50, src: imP21 + '1/mus_weap.png',
descr: 'Вы можете найти здесь: частицы металла, небольшой слиток металла, горючий камень, куски костей, лоскуты шкуры.'
		},

		sdkey1: {
name: 'Ключ завхоза',icon: imP11 + 'keystand.gif', src: imP3 + 'pm_key.gif',
descr: 'Служит для отпирания сундуков. '
		},
		sdkey2: {
name: 'Ключ главного прораба',icon: imP11 + 'keystand.gif', src: imP3 + 'pm_key.gif',
descr: 'Служит для отпирания вагонеток с рудой.'
		},
		sdkey3: {
name: 'Ключ от металлургической лаборатории',icon: imP11 + 'keystand.gif', src: imP3 + 'pm_key.gif',
descr: 'Нужен для прохода в Плавильню к Краппту.'
		},
		sdkey4: {
name: 'Ключ от центрального хранилища',icon: imP11 + 'keystand.gif', src: imP3 + 'pm_key.gif',
descr: 'Ключ от центрального хранилища на четвертом этаже.'
		},


		chestsd1: {
name: 'Сундук &mdash; Ловушка',icon: imP11 + 'sunduk.gif',src: imP21 + 'smag_collect1.png',highlight:1,
descr: 'В сундуке бывает ловушка, в нем можно что-то найти, а можете и ничего не найти.'
		}, 

  chestsd3: {
name: 'Сундук',icon: imP11 + 'chest03.gif',src: imP21 + 'chest03.png',highlight:1,
descr: 'В сундуке бывает ловушка, в нем можно что-то найти, а можете и ничего не найти.'
		},

  nnsd: {
name: 'Непонятное нечто',icon: imP11 + 'nnsd.gif',src: imP21 + 'pm_wall_nn.png',
descr: 'Ты даешь мне 3 Знака признательности города, а я даю тебе 1 грибочек<br />Ты даешь мне 3 Знака признательности города, а я даю тебе 1 Фрагмент древней плиты<br /> Также можно поменять небольшие слитки на нужный вам металл, но 2 к 1.'
		},

		plavsd: {
name: 'Плавильный котел',icon: imP11 + 'plavsd.gif',src: imP21 + 'pm_furnace.png',
descr: 'Напротив котла весит табличка: 3 Частицы металла + Горючий камень = 1 Небольшой слиток металла<br />4 разных cлитка + Горючий камень = 1 слиток ювелирного металла.<br />Осторожно - котел перегревается - не больше одной плавки.'
		},

		secondFloorLadder: {
name: 'Спуск на третий этаж',icon: imP11 + 'ladder1.gif',src: imP21 + 'les1down1.png',
descr: 'Вдохните по глубже и спускайтесь, вы окажетесь на третьем этаже <strong>H2</strong>'
		},
//


  input: {
name: 'Вход',icon: imP11 + 'enter1.gif', src: imP21 + 'les1up1.png',
descr: ''
		},
		oneWayPass: {
name: 'Односторонний проход',icon: imP11 + 'arrow0.gif', src: imP11 + 'arrow0.gif',
descr: ''
		},
		oneWayPass2: {
name: 'Односторонний проход',icon: imP11 + 'arrow1.gif', src: imP11 + 'arrow1.gif',
descr: ''
		},
		oneWayPass3: {
name: 'Односторонний проход',icon: imP11 + 'arrow1.gif', src: imP11 + 'arrow1.gif',
descr: ''
		},
		oneWayPass4: {
name: 'Односторонний проход',icon: imP11 + 'arrow1.gif', src: imP11 + 'arrow1.gif',
descr: ''
		},
		oneWayPass5: {
name: 'Односторонний проход-телепорт',icon: imP11 + 'arrow1.gif', src: imP11 + 'arrow1.gif',
descr: 'Переносит на клетку <b>J6</b>. <br>Для срабатывания необходимо встать на клетку и развернутся на юг.'
		},
		Enterlabirint: {
name: 'Вход',icon: imP11 + 'arrow1.gif', src: imP11 + 'arrow1.gif',
descr: 'Выход из телепорта на <b>K4</b>'
		},
		laddercap45: {
name: 'Переход на пятый этаж',icon: imP11 + 'arrow1.gif', src: imP11 + 'arrow1.gif',
descr: 'Шагнув на клетку <b>H20</b> вы окажетесь на 5м этаже, на клетке <b>B11</b>. Можно вернутся.'
		},
	laddercap5: {
name: 'Выход с четвёртого этажа',icon: imP11 + 'arrow1.gif', src: imP11 + 'arrow1.gif',
descr: 'Шагнув с клетки <b>H19</b> 4го этажа вы окажетесь на 5м этаже, на клетке <b>B11</b>. Можно вернутся.'
		},
		emmeraldEnter: {
name: 'Вход',icon: imP11 + 'arrow1.gif', src: imP11 + 'arrow1.gif',
descr: ''
		},
		emmeraldRepare: {
name: 'Вход в Мастерскую',icon: imP11 + 'door2.gif', src: imP21 + '1_front_door.png',
descr: 'Здесь вы сможете отремонтировать ваши артефакты.'
		},
enterDem22: {
name: 'Вход',icon: imP11 + 'arrow1.gif', src: imP11 + 'arrow1.gif',
descr: 'Выход из трещины Провала на клетке <b>J19</b> '
		},
enterDem21: {
name: 'Вход',icon: imP11 + 'arrow1.gif', src: imP11 + 'arrow1.gif',
descr: 'Выход из ржавого водостока на клетке <b>V7</b> '
		},		
		
enternec1: {
name: 'Вход',icon: imP11 + 'arrow1.gif', src: imP11 + 'arrow1.gif',
descr: ''
		},	
		
necrosvechi: {
name: 'Свечи скорби',icon: imP11 + '30_gy_candle_1.png', src: imP21 + 'gy_candle_1.png',
descr: ' Сожаление приходит в вашу душу незаметно.'
		},		
necrosvechi2: {
name: 'Свечи скорби',icon: imP11 + '30_gy_candle_2.png', src: imP21 + 'gy_candle_2.png',
descr: ' Красиво горят.'
		},			
razritaMagila: {
name: 'Разрытая могила',icon: imP11 + '30_gy_chest3.png', src: imP21 + 'gy_chest3.png',
descr: ''
		},		
pentagramma: {
name: 'Размазанная пентаграмма',icon: imP11 + '30_gy_checkpoint.png', src: imP21 + 'gy_checkpoint.png',
descr: ''
		},	
grobnicaa: {
name: 'Гробница',icon: imP11 + '30_gy_chest2.png', src: imP21 + 'gy_chest2.png',
descr: ''
		},	
nadgrobie: {
name: 'Надгробие',icon: imP11 + '30_gy_tombstone_4.png', src: imP21 + 'gy_tombstone_4.png',
descr: ''
		},	
nadgrobie2: {
name: 'Надгробие',icon: imP11 + '30_gy_tombstone_1.png', src: imP21 + 'gy_tombstone_1.png',
descr: ''
		},	
nadgrobie3: {
name: 'Надгробие',icon: imP11 + '30_gy_chest1.png', src: imP21 + 'gy_chest1.png',
descr: ''
		},	
nadgrobie4: {
name: 'Надгробие',icon: imP11 + '30_gy_tombstone_2.png', src: imP21 + 'gy_tombstone_2.png',
descr: ''
		},
nadgrobie5: {
name: 'Надгробие',icon: imP11 + '30_gy_tombstone_3.png', src: imP21 + 'gy_tombstone_3.png',
descr: ''
		},		
venokpamyati: {
name: 'Венок Памяти',icon: imP11 + '30_gy_venok_1.png', src: imP21 + 'gy_venok_1.png',
descr: ''
		},		
	
altarPriziva: {
name: 'Алтарь призыва',icon: imP11 + 'kk_summ_altar.png', src: imP21 + 'kk_summ_altar2.png',
descr: ''
		},			
		
		enterDem31: {
name: 'Западный Вход',icon: imP11 + 'arrow1.gif', src: imP11 + 'arrow1.gif',
descr: 'С трудом протиснувшись в трещину, вы увидели останки путешественников, идущие к вам. Выход из трещины Провала на <b>K23</b> '
		},
		enterDem32: {
name: 'Восточный Вход',icon: imP11 + 'arrow1.gif', src: imP11 + 'arrow1.gif',
descr: 'Выход из трещины Второго Этажа на <b>K10</b> '
   		},
enterDem33: {
 name: 'Односторонний проход',icon: imP11 + 'arrow1.gif', src: imP11 + 'arrow1.gif',
   descr: ''
		},
		enterDem41: {
	name: 'Вход',icon: imP11 + 'arrow1.gif', src: imP11 + 'arrow1.gif',
descr: 'Выход из телепорта находящегося у <b>Шута&nbsp;Повелителя</b> (Третий Этаж, клетка <b>О3</b>) '
		},
		teleport1: {
name: 'Дорога в один конец',icon: imP11 + 'telport.gif', src: imP21 + 'teleport02.png',
descr: 'Хотите познакомиться с представителем семейства Арахнидов, телепортируйтесь на третий этаж, на клетку <strong>K4</strong>'
		},
		teleport124: {
name: 'Портал',icon: imP11 + 'telportblue.gif', src: imP21 + 'teleport01.png',
descr: 'Перемещает на <b>4</b> этаж в начало Лабиринта.<br />Для перемещения требуется иметь собранный Ключ Портала.'
		},
		teleport2: {
name: 'Телепорт',icon: imP11 + 'telport.gif', src: imP21 + 'teleport02.png',
descr: 'Перемещает на клетку <strong>I3</strong>. <br>Для перемещения необходимо зачистить логово H4-H6-F6-F4.'
		},
		teleport3: {
name: 'Телепорт',icon: imP11 + 'telportblue.gif', src: imP21 + 'teleport01.png',
descr: 'Перемещает на клетку <strong>I9</strong>. Шагнув вперед вы окажетесь на клетке <strong>H9</strong>, обратной дороги нет.'
		},
		teleport4: {
name: 'Телепорт',icon: imP11 + 'telport.gif', src: imP21 + 'teleport02.png',
descr: 'Мерцающий круг, перемещает на клетку <strong>B6</strong>'
		},
		teleport5: {
name: 'Телепорт &mdash; Коридор смерти',icon: imP11 + 'telport.gif', src: imP21 + 'teleport02.png',
descr: 'Вы думаете, что мыши которые ловятся в вашу мышеловку крупнее чем <strong>Древнее Проклятие Глубин</strong>, тогда вам сюда.'
		}, 
		teleport32: {
name: 'Телепорт',icon: imP11 + 'telport.gif', src: imP21 + 'teleport02.png',
descr: 'Отправляет в клетку <strong>F3</strong> второго этажа, для работы нужно зачистить нижнее логово'
		},
		teleport33: {
name: 'Телепорт',icon: imP11 + 'telport.gif', src: imP21 + 'teleport02.png',
descr: 'Перемещает в клетку <strong>С2</strong> третьего этажа, для работы нужно зачистить верхнее логово'
		},
		teleport41: {
name: 'Телепорт',icon: imP11 + 'telportblue.gif', src: imP21 + 'teleport01.png',
descr: 'Решили отправится в неизвестное, захватите <strong>Ключ №1</strong> в сундуке на <strong>L3</strong>. Телепорт ведёт на клетку <strong>S7</strong>'
		},
		teleport51: {
name: 'Телепорт - дорога в глубины',icon: imP11 + 'telportblue.gif', src: imP21 + 'teleport01.png',
descr: 'Перенесет вас на клетку <strong>D9</strong>, для работы надо зачистить логово.'
		},
		teleport52: {
name: 'Спуск на второй этаж',icon: imP11 + 'ladder1.gif', src: imP21 + 'les1down1.png',
descr: 'Спуск на второй этаж, в клетку <strong>H2</strong>'
		},
		teleportdem31: {
name: 'Телепорт на четвертый этаж',icon: imP11 + 'telportblue.gif', src: imP21 + 'teleport01.png',
descr: 'Телепорт на четвертый этаж, в клетку <strong>B11</strong>'
		},
teleportdemshut: {
name: 'Портал Шута',icon: imP11 + 'teleport07.gif', src: imP21 + 'teleport07.png',
descr: 'С помощью Камня Портала Шута можно попасть сразу на 4 этаж, в клетку <strong>D11</strong>'
		},
teleportdemchern: {
name: 'Портал Чернокнижника',icon: imP11 + 'teleport06.gif', src: imP21 + 'teleport06.png',
descr: 'С помощью Камня Портала Чернокнижника можно попасть сразу на 3 этаж (со стороны Чернокнижника), в клетку <strong>А3</strong>'
		},
teleportBezdna: {
name: 'Портал на 4й этаж Бездны',icon: imP11 + 'teleport05.gif', src: imP21 + 'teleport05.png',
descr: 'С помощью портала можно попасть сразу на 4й этаж '
		},
		teleportdemepisk: {
name: 'Портал Епископа',icon: imP11 + 'teleport05.gif', src: imP21 + 'teleport05.png',
descr: 'С помощью Камня Портала Епископа можно попасть сразу на 3 этаж (со стороны Епископа), в клетку <strong>U2</strong>'
		},
kkstoneshut: {
name: 'Камень Портала Шута',icon: imP11 + 'kk_stone_3_4.gif', src: imP3 + 'kk_stone_3_4.gif',
descr: 'С помощью этого Камня, через Портал Шута можно попасть сразу на 4 этаж, в клетку <strong>D11</strong>.<BR /> При входе в портал камень исчезнет.'
		},
kkstonechern: {
name: 'Камень Портала Чернокнижника',icon: imP11 + 'kk_stone_2_3ch.gif', src: imP3 + 'kk_stone_2_3ch.gif',
descr: 'С помощью этого Камня через Портал Чернокнижника можно попасть сразу на 3 этаж (со стороны Чернокнижника), в клетку <strong>B2</strong>.<BR /> При входе в портал камень исчезнет.'
		},
kkstoneepisk: {
name: 'Камень Портала Епископа',icon: imP11 + 'kk_stone_2_3e.gif', src: imP3 + 'kk_stone_2_3e.gif',
descr: 'С помощью этого Камня через Портал Епископа можно попасть сразу на 3 этаж (со стороны Епископа), в клетку <strong>U2</strong>.<BR /> При входе в портал камень исчезнет.'
		},
		teleportem21: {
name: 'Начало пути',icon: imP11 + 'telport.gif', src: imP21 + 'teleport03.png',
descr: 'Телепорт в клетку <strong>H2</strong>'
		},
		teleportem22: {
name: 'Таинственные круги',icon: imP11 + 'telport.gif', src: imP21 + 'teleport03.png',
descr: 'Два телепорта, левый переносит в клетку <strong>H10</strong>, а правый в клетку <strong>H4</strong>'
		},
		teleportem23: {
name: 'Таинственные круги',icon: imP11 + 'telport.gif', src: imP21 + 'teleport03.png',
descr: 'Два телепорта, левый переносит в клетку <strong>F6</strong>, а правый в клетку <strong>H6</strong>'
		},
		teleportem24: {
name: 'Таинственный круг',icon: imP11 + 'telport.gif', src: imP21 + 'teleport03.png',
descr: 'Телепорт, переносит в клетку <strong>H8</strong>, на этой же клетке лежит <strong>Мерцающий ключ</strong>'
		},
		teleportem25: {
name: 'Дорога в глубины',icon: imP11 + 'telportblue.gif', src: imP21 + 'teleport01.png',
descr: 'Не работает'
		},
		teleportem26: {
name: 'Таинственный круг',icon: imP11 + 'telport.gif', src: imP21 + 'teleport03.png',
descr: 'Телепорт в клетку <strong>C8</strong>'
		},
		teleportcap4: {
name: 'Шаг в неизвестность',icon: imP11 + 'telportgreen.gif', src: imP21 + 'teleport04.png',
descr: 'Вы окажитесь в Лабиринте, на  клетке <strong>H13</strong>'
		},
		teleportcap41: {
name: 'Телепорт',icon: imP11 + 'teleport06.gif', src: imP21 + 'teleport06.png',
descr: 'Перемещает в клетку <strong>H19</strong>.'
		},
		teleportcap42: {
name: 'Телепорт',icon: imP11 + 'teleport06.gif', src: imP21 + 'teleport06.png',
descr: 'Перемещает в клетку <strong>I8</strong>.'
		},
		bezdnaUrnaPraha: {
name: 'Урна с прахом',icon: imP11 + 'bbb_urn1.png',w:35, h:62, src: imP21 + 'bbb_urn1.png',
descr: 'Восстановит ваши ХП на максимум.'
		},
		bezdnaUrnaPraha2: {
name: 'Урна с прахом',icon: imP11 + 'bbb_urn3.png',w:35, h:62, src: imP21 + 'bbb_urn3_1.png',
descr: 'Восстановит ваши ХП на максимум.'
		},		
bezdnaSkelet: {
name: 'Останки вашего предшественника', icon: imP11 + 'dead_body_mus.png',w:100, h:50, src: imP21 + 'dead_body_mus.png',
descr: 'Если нажать на него, то можно что-нибудь найти, например пустую бутылку.'
		},
			bezdnaEnter: {
name: 'Вход',icon: imP11 + 'arrow1.gif', src: imP11 + 'arrow1.gif',
descr: ''
		},	
		intelFountain: {
name: 'Фонтан Снадобья Разума',icon: imP11 + 'fountainintel.gif', src: imP21 + 'chalice01.png',
descr: ' Для работы необходимо убить ботов на клетках <b>H6,E6,G7<b>. Для каждого из команды.'
		},
		bezdnaHands: {
name: 'Алчные руки',icon: imP11 + 'bezdnaHands.gif', src: imP21 + 'bezdnaHands.gif',
descr: 'Их назначение пока не извество! При нажатии увидете: <b>Не удалось найти что-либо еще ...</b>'
		},
		bezdnaDarkAltar: {
name: 'Темный Алтарь Бездны',icon: imP11 + 'bbb_altar.png', src: imP21 + 'bbb_altar.png',
descr: 'Их назначение пока не извество! При нажатии увидете: <b>Не удалось найти что-либо еще ...</b>'
		},		
		
		fountdem31: {
name: 'Купель',icon: imP11 + 'fountainintel.gif', src: imP21 + 'chalice01.png',
descr: 'Можно получить <strong>Сыворотку</strong>'
		},
		ghostFountain: {
name: 'Фонтан Призрачного ума',icon: imP11 + 'fountainintel2.gif', src: imP21 + 'well02.png',
descr: ' В этом фонтане вы можете проапгрейдить Кольцо Алтаря до Мистического Кольца Алтаря, <a href="/index.php?section=gameworld&item=altar" target="_blank" class="TLink"><font color="#0000FF">подробности</font></a>. '
		},
		ghostPowerFountain: {
name: 'Фонтан Призрачной силы',icon: imP11 + 'fountainintel2.gif', src: imP21 + 'well02.png',                                                      
descr: ' В этом фонтане вы можете проапгрейдить Кольцо Алтаря до Воинского Кольца Алтаря, <a href="/index.php?section=gameworld&item=altar" target="_blank" class="TLink"><font color="#0000FF">подробности</font></a>.'
		},
		antidotFountain: {
name: 'Купель',icon: imP11 + 'fountainintel.gif', src: imP21 + 'chalice01.png',
descr: 'Можно получить <strong>Антидот</strong>. Излечит от яда. '
		},

		fountainEm31: {
name: 'Фонтан Забытых Мастеров',icon: imP11 + 'fountaindeny.gif', src: imP21 + 'well06.png',
descr: ''
 		},
 
		liteLiveFountain: {
name: 'Фонтан Легкой Жизни',icon: imP11 + 'well04.gif', src: imP21 + 'well04.png',
descr: 'Можно получить эликсир <strong>Глоток лёгкой жизни</strong>. Зелье восстанавливающее уровень <strong>НР</strong> (+600НР). <br \> Могут набрать двое.'
		},
		liteLiveFountainem21: {
name: 'Фонтан Легкой Жизни',icon: imP11 + 'well04.gif', src: imP21 + 'well04.png',
descr: 'Можно получить эликсир <b>Глоток Легкой Жизни</b>. Зелье восстанавливающее уровень <strong>НР</strong> (+600НР).<br \> Могут набрать двое. <br \>Рядом находится телепорт на клетку <strong>C10</strong>.'
		},
		memoryFountain: {
name: 'Фонтан Воспоминаний',icon: imP11 + 'well04.gif', src: imP21 + 'well07.png',
descr: 'Вода этого фонтана навевает недобрые воспоминания...</i><br><img src="'+imP41+'standart_poison.gif" /> <br \>Можно получить - <strong>(Восстановление HP (%): +80)</strong>, но скорее всего, напоровшись на опасную ловушку, выпьете яда: <br \><i><strong>"Грязная Кровь"</strong>Восстановление HP(%):-80</i> <br \>Дальше лучше не продолжать, будет только хуже - максимум: <br \><i><strong>"Грязная Кровь*5"</strong>Восстановление HP(%)-400</i> <br \> эффект длится 3 часа.'
		},
		emmeraldFountain1: {
name: 'Фонтан Искаженной природы',icon: imP11 + 'fountain.gif', src: imP21 + 'well05.png',
descr: ' , для работы фонтана необходимо убить всех в логове у телепорта на клетке H11. Могут набрать трое. '
		},
		demFountain31: {
name: 'Фонтан Былых побед',icon: imP11 + 'fountain.gif', src: imP21 + 'well05.png',
descr: ' '
		},
		key1: {
name: 'Ключ к Фонтану Океана',icon: imP11 + 'key.gif', src: imP3 + 'Key1.gif',
descr: ' (клетка К5).<br \>Если нажать на ключ когда охранники живы, то на вас нападут все рядом стоящие боты. '
		},
		key2: {
name: 'Ключ от входа на третий этаж, через телепорт на D8',icon: imP11 + 'key21.gif', src: imP3 + 'Key2.gif',
descr: ''
		},
		key3: {
name: 'Ключ, Открывает мастерскую на J8',icon: imP11 + 'key3.gif', src: imP2 + 'items/Key3.gif',
descr: ''
		},

		key35: {
name: 'Мерцающий Ключ №3',icon: imP11 + 'key3.gif', src: imP3 + 'Key3.gif',
descr: 'Необходим для прохода через дверь на <strong>Q7</strong>'
		},
		firstFloorLadder: {
name: 'Лестница на второй этаж',icon: imP11 + 'ladder1.gif', src: imP21 + 'les1down1.png',
descr: 'Первый этаж вам показался скучным и вялым, ну тогда попробуйте себя на втором, вы окажетесь там в клетке <strong>D2</strong>'
		},
		firstFloorLadder2: {
name: 'Спуск на второй этаж', icon: imP11 + 'ladder1.gif', src: imP21 + 'les1down1.png',
descr: 'Разминка окончена, приготовьтесь, вас ожидают толпы монстров на <strong>F2</strong>'
		},
		firstFloorLadder31: {
name: 'Лестница №1',icon: imP11 + 'ladder1.gif',src: imP21 + 'les1down1.png',
descr: 'Спуск на 2й этаж, вы окажетесь на клетке (<strong>J2</strong>)'
		},
		firstFloorLadder32: {
name: 'Лестница №2',icon: imP11 + 'ladder1.gif',src: imP21 + 'les1down1.png',
descr: 'Спуск на 2й этаж, вы окажетесь на клетке <strong>B2</strong> второго этажа.'
		},

		secondFloorLadder2: {
name: 'Спуск на третий этаж',icon: imP11 + 'ladder1.gif',src: imP21 + 'les1down1.png',
descr: 'Вдохните по глубже и спускайтесь, вы окажетесь на третьем этаже <strong>(G2)</strong>'
		},
		lastLadder: {
name: 'Выход',icon: imP11 + 'ladder1.gif',src: imP21 + 'les1down1.png',
descr: ''
		},
		ladderem21: {
name: 'Спуск на третий этаж',icon: imP11 + 'ladder1.gif',src: imP21 + 'les1down1.png',
descr: ''
		},
		ladderEm31: {
name: 'Спуск на четвертый этаж', icon: imP11 + 'ladder1.gif',src: imP21 + 'les1down1.png',
descr: 'Воспользовавшись этим спуском, вы попадёте к мастерской для ремонта артефактов.'
		},

  chest1dem1: {
name: 'Сундук',icon: imP11 + 'sunduk.gif',highlight:1,src: imP21 + 'smag_collect1.png',
descr: 'Вы сможете найти здесь ингредиенты, Бутерброд "Завтрак рыцаря", "Бутерброд с мясом", испортившийся эликсир, пустую бутылку, а можете ничего не найти или нарваться на ловушку.'
		},
		chest1ang1: {
name: 'Сундук',icon: imP11 + 'chest03.gif',src: imP21 + 'chest03.png',
descr: 'Можно найти: <b>"Лучистый топаз"</b>.<br>Могут взять двое из команды.'
		},
		chest1ang: {
name: 'Сундук',icon: imP11 + 'chest02.gif',src: imP21 + 'chest02.png',
descr: 'Можно взять <b>"Отворяющую печать №3"</b> - <img src='+imP3+'Key23.gif width="32" height="32">'
		},
		chest2ang1: {
name: 'Сундук',icon: imP11 + 'chest2.gif',src: imP21 + 'chest01.png',
descr: 'С небольшой вероятностью можно найти: <b>чек на 400 кр</b>.'
		},
		chest2ang2: {
name: 'Сундук',icon: imP11 + 'chest2.gif',src: imP21 + 'chest01.png',
descr: 'Можно найти: <b>Глубинный Камень</b>.'
		},
		chest3ang: {
name: 'Сундук',icon: imP11 + 'chest2.gif',src: imP21 + 'chest01.png',
descr: 'Можно найти: Мерцающий ключ, чек на 5 кр. Могут взять 2е из команды.'
		},
		chest2angdang: {
name: 'Сундук &mdash; Ловушка',icon: imP11 + 'chest03.gif',src: imP21 + 'chest03.png',highlight:1,
descr: 'В сундуке ловушка, но всегда пустой.'
		},
		chest2: {
name: 'Сундук &mdash; Ловушка',icon: imP11 + 'sunduk.gif',src: imP21 + 'smag_collect1.png',highlight:1,
descr: 'В сундуке ловушка, найдете вы там что либо - вопрос, но руки оторвет.'
		},

		chest3: {
name: 'Сундук &mdash; Ловушка',icon: imP11 + 'sunduk.gif',src: imP21 + 'smag_collect1.png',highlight:1,
descr: 'В этом сундуке ловушка.'
		},
			chest4: {
name: 'Сундук &mdash; Ловушка',icon: imP11 + 'sunduk.gif',src: imP21 + 'smag_collect1.png', highlight:1,
descr: 'Вы возьмёте здесь <b>Ключ №1</b> - <img src='+imP3+'Key1.gif width="32" height="32">. Нужен для работы телепорта на клетке <strong>S6</strong>.  '
		},
		chestdem31: {
name: 'Сундук ', icon: imP11 + 'chest04.gif',src: imP21 + 'chest04.png', highlight:1,
descr: 'Можно найти еликсир или пустую бутылку'
		},
		demonAltarCharki: {
name: 'Жертвенный Алтарь', icon: imP11 + 'kk_final_altar.png',src: imP21 + 'kk_final_altar.png',
descr: 'Можно собрать свитки <b>Зачарования</b>, требуется <b>Пирамидальный&nbsp;ключ</b>. Для работы необходимо зачистить "Пыточную".'
		},		
		
		chestdem32: {
name: 'Сундук', icon: imP11 + 'chest04.gif',src: imP21 + 'chest04.png',
descr: ' '
		},
		chestdem41: {
name: 'Сундук', icon: imP11 + 'smag_collect1_3.gif',src: imP21 + 'smag_collect1_3.png',
descr: 'Вы можете найти здесь свиток зачарования.'
		},
		chestdem42: {
name: 'Сундук', icon: imP11 + 'smag_collect1_4.gif',src: imP21 + 'smag_collect1_4.png',
descr: 'Вы можете найти здесь свиток зачарования.'
		},
		chestdem43: {
name: 'Сундук', icon: imP11 + 'smag_collect1_1.gif',src: imP21 + 'smag_collect1_1.png',
descr: 'Сундучок упорно не открывается. Возможно, если убить всех глумливо усмехающихся Стражей...<br>Вы найдёте здесь <b>Мерцающий ключ №4</b> - <img src='+imP3+'Key4.gif width="32" height="32"> открывающий <b>Дверь к Повелителю</b>.</ br>Взять можно лишь зачистив "Пыточную". Удобнее убивать Древнего Стража на <b>К7</b>.'
		},
		chest5: {
name: 'Сундук', icon: imP11 + 'smagcollect1.gif',src: imP21 + 'smag_collect1_1.png',
descr: 'Вы найдете здесь <strong>Обломок Пирамидального ключа</strong> - <img src='+imP3+'key_cube_1.gif width="32" height="32">.'
		},
		chest51: {
name: 'Сундук', icon: imP11 + 'smagcollect1.gif',src: imP21 + 'smag_collect1_1.png',
descr: 'Вы найдете здесь <strong>Осколок Пирамидального ключа</strong> - <img src='+imP3+'key_cube_2.gif width="32" height="32">.'
		},
		chest12: {
name: 'Сундук',icon: imP11 + 'chest2.gif',  highlight:1,src: imP21 + 'chest01.png',
descr: 'Может быть ловушка, можно найти ингредиент.'
		},
  		chest121: {
name: 'Сундук',icon: imP11 + 'chest2.gif', highlight:1,src: imP21 + 'chest01.png',
descr: 'Может быть ловушка, можно найти чек на 10кр. или Восстановление энергии 60HP или ингредиент.'
		},
		chest22: {
name: 'Сундук',icon: imP11 + 'chest02.gif', highlight:1,src: imP21 + 'chest02.png',
descr: 'В сундуках, разные ужасные монстры, могут хранить всевозможные ценные вещи, но могут и не хранить, а может и ловушка быть.'
		},
		chestenter: {
name: 'Сундук - Приманка',icon: imP11 + 'sunduk.gif',highlight:1,src: imP21 + 'smag_collect1.png',
descr: 'Добратся до него невозможно.'
		},
  chest02dem3: {
name: 'Сундук &mdash; Ловушка', icon: imP11 + 'chest02.gif',src: imP21 + 'chest02.png', highlight:1,
descr: '  ну и конечно ловушка, снимающая 1000НР'
		},
		chestEm31: {
name: 'Сундучок для друга',icon: imP11 + 'sunduk.gif',src: imP21 + 'smag_collect1.png',
descr: 'Вы сможете найти тут: "Открытку Другу"'
		},


  gardang: {
name: 'Решетка',icon: imP11 + 'gard.gif',src: imP21 + 'grate.png',
descr: 'Для прохода необходим "Мерцающий ключ №3" '
		},
		gard1: {
name: 'Решетка',icon: imP11 + 'grate01.gif',src: imP21 + 'grate01.png',
descr: 'Для прохода нужен ключ от Сокровищницы.'
		},
		doorcap5: {
name: 'Вход', icon: imP11 + 'door1.gif',w:126, h:87, src: imP21 + '1/door2.png',
descr: 'Для прохода требуется <b>Отпирающая руна</b>'
		},
		altar: {
name: 'Алтарь',icon: imP11 + 'altar.gif',src: imP21 + 'altar01.png',
descr: 'Алтарь, который охраняет Служитель Бездны - вход в тайную комнату. Вас перенесет на клетку <b>J9</b>, за телепортацию требуется драгоценный камень. Кликать до упора, редко с первого раза.'
		},
		altar2: {
name: 'Алтарь &mdash; Ловушка',icon: imP11 + 'altar.gif',src: imP21 + 'altar01.png',highlight:1,
descr: 'Первый дотронувшийся получит проклятье или благословение на срок от 3 до 6 часов. <Br /><img src="'+imP41+'standart_curse.gif" /><br /><b>"Благословление Глубин:</b> <Br /><strong>&ndash; Печать Хаоса"</strong> (Максимально наносимое повреждение +25) 3ч.<Br /><b>&ndash; Жизнь"</b> (Уровень жизни (HP) +30), на 6 ч.<Br /><b>&ndash; Регенерация"</b> (Восстановление HP (%): +50), на 3 ч. <Br /><b>&ndash; Мощь"</b> (Сила: +5), на 6 ч.<Br /> <b>&ndash; Скорость"</b> (Ловкость: +5), на 6 ч.<Br /><b>&ndash; Предчувствие"</b> (Интуиция: +5), на 6 ч. <br /><b>"Проклятье Глубин:</b><Br /> <strong>&ndash; Печать Хаоса"</strong> (Максимальное наносимое повреждение: +25, Минимальное наносимое повреждение: -25) на 3 ч. <Br /><b>&ndash; Жизнь"</b> (Уровень жизни (HP) -30), на 6 ч.,<Br /><b>&ndash; Регенерация"</b> (Восстановление HP (%): -50), на 3 ч. <Br /><b>&ndash; Мощь"</b> (Сила: -5), на 6 ч.<Br /><b>&ndash; Скорость"</b> (Ловкость: -5), на 6 ч.<Br /><b>&ndash; Предчувствие"</b> (Интуиция: -5), на 6 ч. <br /><b>Также вы можете здесь найти:</b>  '
		},
		altar21: {
name: 'Алтарь &mdash; Ловушка',icon: imP11 + 'altar.gif',src: imP21 + 'altar01.png',highlight:1,
descr: 'Первый дотронувшийся получит удар от ловушки на -700НР  <br /><b>Также вы можете здесь найти:</b>  '
		},
		altar4: {
name: 'Алтарь Единения',icon: imP11 + 'altar.gif',src: imP21 + 'altar01.png',
descr: 'Можно собрать <b>"Пирамидальный ключ"</b> <br /><img src='+imP3+'key_cube_2.gif width="32" height="32">+<img src='+imP3+'key_cube_1.gif width="32" height="32">=<img src='+imP3+'key_cube_3.gif width="32" height="32">.<br> Необходим для сбора свитков чарования. '
		},
		altar5: {
name: 'Алтарь Осколков',icon: imP11 + 'altar.gif',src: imP21 + 'altar01.png',
descr: 'Можно собрать <b>Ключ Портала</b> при наличии его 3 частей и <b>Отпирающую Руну</b> при наличии её 5 частей'
		},
		lab: {
name: 'Лаборатория',icon: imP11 + 'lab.gif',src: imP21 + 'lab01.png',
descr: 'Можно собрать Свитки Тактик, но не больше чем 3 свитка за поход, на каждого члена команды и не более 10 свитков на команду.<Br />Если у Вас есть Растворители Ресурсов, то материалы из подземелий можно превратить в Сущность Ресурса&nbsp;<img src='+imP3+'mater_shop7.gif width=30 height=30> .<Br /><strong>Внимание:</strong><font color=red>Сущности не связываются общей судьбой.</font><br><a href="/index.php?section=gameworld&item=altar" target="_blank" class="TLink"><font color="#0000FF">подробности</font></a>'
		},
		lab2: {
name: 'Лаборатория',icon: imP11 + 'lab.gif',src: imP21 + 'lab01.png',
descr: 'Можно собрать свитки <b>Зачарования</b>, требуется <b>Пирамидальный&nbsp;ключ</b>. Для работы необходимо зачистить "Пыточную".'
		},
		lab1: {
name: 'Забытая Экипировка',icon: imP11 + 'lab.gif',src: imP21 + 'lab01.png',
descr: 'Могут выпасть: Восстановление энергии +45HP, Сосуд жизненных сил, Лечение травм - падает рандомно 1-6 предметов - после выхода из пещеры пропадает.'
		},

		cavern: {
name: 'Выбоина',icon: imP11 + 'cavern.gif',src: imP21 + '2/duffer.png',
descr: 'Вы сможете найти здесь:  Сталь, Мифрил, Пустые бутылки или ничего не найти, а также вы можете напороться на ловушку.<br>Могут взять двое из команды.'
		},
		cavern1: {
name: 'Выбоина',icon: imP11 + 'cavern.gif',src: imP21 + '2/duffer.png',
descr: 'Дойдя до стенки и развернувшись на восток вы увидете Выбоину, нажав на неё, при наличи <strong>Линзы Портала</strong>, вы попадёте в "Завал" к Ольгерту Вирту, клетка <strong>B9</strong>.'
		},
		cavern2: {
name: 'Выбоина',icon: imP11 + 'cavern.gif',src: imP21 + '2/duffer.png',
descr: 'Выход из "Завала", нажав на неё вы окажетесь на клетке - <strong>B10</strong>'
		},
		cavern3: {
name: 'Выбоина',icon: imP11 + 'cavern.gif',src: imP21 + '2/duffer.png',
descr: 'Выход из "Завала", нажав на неё вы окажетесь на клетке <strong>B8</strong>'
		},
		pot: {
name: 'Котел&ndash;Ловушка', icon: imP11 + 'pot.gif',src: imP21 + 'boiler01.png', highlight:1,
descr: 'Можно получить смертельную рану, прикоснувшись к котлу. <br /><b>Также можно найти здесь</b>: '
		},
		kuzn: {
name: 'Наковальня',icon: imP11 + 'kuzn.gif',src: imP21 + 'forge01.png',
descr: 'Можете клонировать сущность ресурса - из одной сделать 2. Только одну сущность и 1 раз за поход.  Клонированная сущность свяжется общей судьбой.'
		},
		vagon: {
name: 'Тележка',icon: imP11 + 'vagon.gif',src: imP21 + 'lorry01.png',
descr: 'Вы можете найти здесь: Серебро или Лучистое Серебро'
		},
		vagon1: {
name: 'Тележка',icon: imP11 + 'vagon.gif',src: imP21 + 'lorry01.png',
descr: 'Если нажать на тележку, то вам рандомно выпадет свиток тактики от 1 до 4.'
		},
		bed: {
name: 'Кровать',icon: imP11 + 'bed.gif',src: imP21 + 'bed01.png',
descr: 'Может находится Пропуск Забытых.'
		},
		bed1ang: {
name: 'Кровать',icon: imP11 + 'bed.gif',src: imP21 + 'bed01.png',
descr: 'Может находится Мерцающий ключ и Пропуск Забытых.'
		},


		brik: {
name: 'Камень', icon: imP11 + 'brik.gif', highlight:2,w:60, h:30, src: imP21 + 'kamen1.png',
descr: 'В каждом из камней вы сможете найти что либо интересное, например Бутерброд, а если повезёт статовый эликсир на +15, но чаще всего в них попадаются Испортившиеся эликсиры или пустые бутылки, не злоупотребляйте ими.'
		},
		brik1: {
name: 'Камень', icon: imP11 + 'kamen.gif',w:60, h:30, src: imP21 + 'kamen.png',
descr: 'Хоть этот камень и не подъёмный, на нём растёт: <strong>Подгорный Эдельвейс</strong>, сдав который, вы получите звание рыцаря "Бездны". Берут все, кому он нужен для завершения задания.'
		},
		proboina: {
name: 'Подозрительная трещина', icon: imP11 + 'proboina.gif',highlight:1, w:60, h:30, src: imP21 + 'proboina.png',
descr: 'Ступив на неё вы, не успев призвать всех святых, грохнетесь с пяти-метровой высоты в недра <strong>Провала (D14)</strong>'
		},
  proboina2: {
name: 'Подозрительная трещина', icon: imP11 + 'proboina2.gif',highlight:1, w:60, h:30, src: imP21 + 'proboina2.png',
descr: 'Ступив на неё вы и охнуть не успеете, как провалитесь на второй этаж в клетку <strong>B14</strong>'
		},
		proboina3: {
name: 'Подозрительная трещина', icon: imP11 + 'proboina.gif',highlight:1, w:60, h:30, src: imP21 + 'proboina.png',
descr: 'Если вы уже убили Епископа, то ступив на неё вы провалитесь на клетку <strong>U2</strong>'
		},
		proboina4: {
name: 'Подозрительная трещина', icon: imP11 + 'proboina2.gif',highlight:1, w:60, h:30, src: imP21 + 'proboina2.png',
descr: 'Ступив на неё вы, не моргнув глазом провалитесь на третий этаж в клетку <strong>B2</strong>'
		},
		proboina5: {
name: 'Трещина', icon: imP11 + 'proboina.gif',w:60, h:30, src: imP21 + 'proboina.png',
descr: 'Ничего не видно...'
		},
		probenter: {
name: 'Вход', icon: imP11 + 'proboina.gif',w:60, h:30, src: imP21 + 'proboina.png',
descr: 'Через <strong>Подозрительную трещину</strong> на Первом этаже (<strong>B9</strong>)'
		},
		probenter2: {
name: 'Вход', icon: imP11 + 'proboina.gif',w:60, h:30, src: imP21 + 'proboina.png',
descr: 'Через Подозрительную трещину в Провале(<strong>J19</strong>)'
		},
		drainbottom1: {
name: 'Водосток', icon: imP11 + 'drain_bottom.gif',w:60, h:30, src: imP21 + 'drain_bottom.png',
descr: 'Здесь находится <strong>Cвиток&nbsp;Спасения</strong>(0/1), будет правильно, если его получит самый сильный член вашей команды.'
		},
		drainbottom2: {
name: 'Водосток', icon: imP11 + 'drain_bottom.gif',w:60, h:30, src: imP21 + 'drain_bottom.png',
descr: 'Из большинства водостоков сильно попахивает, давайте принюхаемся ещё раз, а теперь ещё раз, ну что почувствовали разницу, нет, ну тогда пойдем дальше&#8230;'
		},
		drainbottom3: {
name: 'Водосток&ndash;Ловушка', icon: imP11 + 'drain_bottom.gif',highlight:1, w:60, h:30, src: imP21 + 'drain_bottom.png',
descr: 'Вы принюхивались ко всему по дороге сюда, но будьте осторожны, здесь вас ожидает хитро настроенная ловушка, которая заберёт половину жизни, да ещё и Смотритель нападёт, который караулит вас на клетке К6.'
		},
		drainbottom4: {
name: 'Ржавый водосток', icon: imP11 + 'drain_bottom.gif',w:60, h:30, src: imP21 + 'drain_bottom.png',
descr: '<strong>Спуск на второй этаж</strong>. Для того чтобы спустится, надо нажать на него.'
		},
		draintop: {
name: 'Водосток', icon: imP11 + 'draintop.gif',w:60, h:27, src: imP21 + 'drain_top.png',
descr: ''
		},
		drainenter: {
name: 'Вход через Водосток', icon: imP11 + 'drain_bottom.gif',w:60, h:27, src: imP21 + 'drain_bottom.png',
descr: 'Надышавшись миазмами Демонской канализации, вы вывалитесь на второй этаж.'
		},
		stat1: {
name: 'Статуя Трупожера', icon: imP11 + 'stat1.gif',w:60, h:105, src: imP21 + 'stat1.png',
descr: '<em>Неразборчивая надпись ярко выраженного нецензурного содержания, намекающая на нежелательность встречи и какого-либо вида общения</em> красуется на предестале этого творения, достойного резца самого Церители (маниакально-депрессивного периода творчества), если не сказать больше&#8230;'
		},
		stat2: {
name: 'Статуя', icon: imP11 + 'stat2.gif',w:60, h:105, src: imP21 + 'stat2.png',
descr: 'Из далека показалось, что это знаменитая скульптурная группа &laquo;Лаокоон со змеями&raquo;, но при ближайшем рассмотрении, стало понятно - подделка, а глянув еще раз убедиться, что скульптор был пьян, в усмерть...'
		},
		stat3: {
name: 'Статуя', icon: imP11 + 'stat3.gif',w:60, h:105, src: imP21 + 'stat3.png',
descr: 'Очень красивая статуя, но почему&ndash;то сразу возникает желание отбить ей голову и руки до плеч, а что поделать, недостатки классического образования.'
		},
		skelet1: {
name: 'Истлевший скелет', icon: imP11 + 'skelet1.gif', highlight:1,w:100, h:50, src: imP21 + 'skelet1.png',
descr: 'Ловушка, бьёт на -1000НР, если нажать на него, то можно найти рассыпающийся рарный шмот.'
		},
skelet12: {
name: 'Истлевший скелет', icon: imP11 + 'skelet1.gif',w:100, h:50, src: imP21 + 'skelet1.png',
descr: 'Если нажать на него, то можно что-нибудь найти, например пустую бутылку.'
		},
		skelet31: {
name: 'Истлевший скелет', icon: imP11 + 'skelet1.gif', highlight:1,w:100,h:50,src: imP21 + 'skelet1.png',
descr: 'Ловушка, бьёт на -1000НР'
		},
		garbage: {
name: 'Куча мусора', icon: imP11 + 'garbage.gif', highlight:1,w:102, h:49, src: imP21 + 'trash02.png',
descr: 'Будьте осторожны напоровшись на опасную ловушку, можно получить болезнь: <img src="'+imP41+'standart_disease.gif" /> <br/><strong>• "Желудочный Грипп" </strong>(Ловкость: -6) - на 6ч.<br/><strong>• "Гудящая Голова" </strong>(Интуиция: -6) на 6ч.<br/><strong>• "Трясущиеся руки" </strong>(Сила: -6) на 6ч.<br/><strong>• "Скрытая Слабость" </strong>(Сила: -2, Интуиция: -2, Ловкость: -2) на 3ч.<br/><strong>• "Ранимость" </strong>(Защита от урона: -10) на 3ч. <BR /><strong>• "Мутный Взгляд"</strong> мф. крита -20%, мф. антикрита -25%, мф. уворота -30%, мф. антиуворота -25%  - на 36 ч.<br/>А можете и яда <img src="'+imP41+'standart_poison.gif" /> хлебнуть:<br/><strong>• "Грязная Кровь"</strong>Восстановление HP(%):-40<br/>  А что собственно вы думали здесь найти, неужели что-то полезное - пустую бутылку может и найдёте. Но если повезёт, можно найти ресурс. '
		},
		barrikada: {
name: 'Баррикада', icon: imP11 + 'barrikada.gif',w:126, h:87, src: imP21 + 'barrikada.png',
descr: 'Большая, ни чем не примечательная куча всяческого металлолома, хотя в ней угадываються некоторые фрагменты ваших предшестенников, не двусмысленно намекающие на возможный итог.'
		},
		barrikada1: {
name: 'Баррикада', icon: imP11 + 'barrikada.gif',w:126, h:87, src: imP21 + 'barrikada.png',
descr: 'Проход забаррикадирован...'
		},
		barrikadadem3: {
name: 'Завал', icon: imP11 + 'landslip01.gif',w:126, h:87, src: imP21 + '1/landslip01.png',
descr: 'Похоже кто-то взорвал проход, тут не пройти.'
		},
		door: {
name: 'Вход', icon: imP11 + 'door1.gif',w:126, h:87, src: imP21 + '1/door2.png',
descr: ''
		},
		door1: {
name: 'Дверь', icon: imP11 + 'door1.gif',w:126, h:87, src: imP21 + '1/door2.png',
descr: 'Требуется ключ №3.'
		},
		door2: {
name: 'Дверь', icon: imP11 + 'door1.gif',w:126, h:87, src: imP21 + '1/door2.png',
descr: ''
		},
		door3: {
name: 'Вход к Повелителю', icon: imP11 + 'door1.gif',w:126, h:87, src: imP21 + '1/door2.png',
descr: 'Для входа необходим <b>Мерцающий ключ №4</b> находящийся в сундуке на <b>K8</b>'
		},
		gobelin01: {
name: 'Гобелен', icon: imP11 + 'gobelin01.gif',w:113, h:65, src: imP21 + '1/dec_gobelin02.png',
descr: 'Вы сможете полюбоватся на красоту древнего гобелена, но не увлекайтесь, впереди ещё много интересного. Тем более, что по утверждению большинства искуствоведов, ни малейшей художественной ценности не представляющий. Попытки отодрать красоту от стены, ни к чему не привели.'
		},
		gobelin02: {
name: 'Гобелен', icon: imP11 + 'gobelin02.gif',w:113, h:65, src: imP21 + '1/dec_gobelin01.png',
descr: 'Красота...'
		},
		gobelin03: {
name: 'Гобелен', icon: imP11 + 'gobelin01.gif',w:113, h:65, src: imP21 + '1/dec_gobelin02.png',
descr: 'Красота...'
		},
  		danger00: {
name: 'Невидимая ловушка', icon: imP11 + 'danger.gif', highlight:1,src: imP11 + 'danger_big.gif',
descr: '1й наступивший может потерять до -1000НР, будьте осторожны.'
		},
		danger01: {
name: 'Невидимая ловушка', icon: imP11 + 'danger.gif', highlight:1,src: imP11 + 'danger_big.gif',
descr: 'Вы можете потерять до -1000НР, будьте осторожны. '
		},
		dangerdem3: {
name: 'Невидимая ловушка', icon: imP11 + 'danger.gif', highlight:1,src: imP11 + 'danger_big.gif',
descr: 'Наносит урон в % от максимального количества ХП, будьте осторожны, работает в обе стороны.'
		},
		danger011: {
name: 'Невидимая ловушка', icon: imP11 + 'danger.gif', highlight:1,src: imP11 + 'danger_big.gif',
descr: 'Наступив на эту клетку на вас нападут "Слизи" с клетки <b>С19</b>'
		},
		danger02: {
name: 'Ловушка &mdash; Телепорт', icon: imP11 + 'danger2.gif', highlight:1,src: imP11 + 'danger2_big.gif',
descr: 'Попав в нее вы принудительно отправитесь в клетку <b>К8</b>'
		},
		danger021: {
name: 'Ловушка &mdash; Телепорт', icon: imP11 + 'danger2.gif', highlight:1,src: imP11 + 'danger2_big.gif',
descr: 'Попав в нее вы принудительно отправитесь в клетку <b>B18</b>'
		},
		danger022: {
name: 'Ловушка &mdash; Телепорт', icon: imP11 + 'danger2.gif', highlight:1,src: imP11 + 'danger2_big.gif',
descr: 'Попав в нее вы принудительно отправитесь в клетку <b>I19</b>'
		},
		danger03: {
name: 'Ловушка &mdash; Телепорт', icon: imP11 + 'danger2.gif', highlight:1,src: imP11 + 'danger2_big.gif',
descr: 'Попав в нее вы принудительно отправитесь в клетку <b>I18</b>'
		},
		danger04: {
name: 'Ловушка &mdash; Телепорт', icon: imP11 + 'danger2.gif', highlight:1,src: imP11 + 'danger2_big.gif',
descr: 'Попав в нее вы принудительно отправитесь в клетку <b>O5</b>, пройти можно только вперёд и только убив "Шута Повелителя".'
		},
		danger041: {
name: 'Ловушка &mdash; Телепорт', icon: imP11 + 'danger2.gif', highlight:1,src: imP11 + 'danger2_big.gif',
descr: 'Попав в нее вы принудительно отправитесь в клетку <b>Р6</b>.'
		},
		danger042: {
name: 'Ловушка &mdash; Телепорт', icon: imP11 + 'danger2.gif', highlight:1,src: imP11 + 'danger2_big.gif',
descr: 'Попав в нее вы принудительно отправитесь в клетку <b>G17</b>.'
		},
	danger05: {
name: 'Невидимая ловушка', icon: imP11 + 'danger.gif', highlight:1,src: imP11 + 'danger_big.gif',
descr: 'Невидимая ловушка, -1000НР.'
		},
	danger06: {
name: 'Засада', icon: imP11 + 'danger.gif', highlight:1,src: imP11 + 'danger_big.gif',
descr: 'Наступив на эту клетку, на вас нападут "Древние Стражи" с клеток <b>K9</b>, <b>K11</b>, <b>I9</b>, <b>I11</b>.'
		},
	danger07: {
name: 'Засада', icon: imP11 + 'danger.gif', highlight:1,src: imP11 + 'danger_big.gif',
descr: 'Наступив на эту клетку, на вас нападёт "Повелитель".'
		},
		dangercap41: {
name: 'Ловушка &mdash; Телепорт', icon: imP11 + 'danger2.gif', highlight:1,src: imP11 + 'danger2_big.gif',
descr: 'Попав в нее вы принудительно отправитесь в клетку <b>H16</b>.'
		},
	danger08: {
name: 'Засада', icon: imP11 + 'danger.gif', highlight:1,src: imP11 + 'danger_big.gif',
descr: 'Наступив на эту клетку, на вас нападут "Зомби" с клетки <b>Е13</b> и <b>С13</b>.'
		},
	danger09: {
name: 'Засада', icon: imP11 + 'danger.gif', highlight:1,src: imP11 + 'danger_big.gif',
descr: 'Наступив на эту клетку, на вас нападёт "Каменный Страж".'
		},
		throne01: {
name: 'Трон Повелителя', icon: imP11 + 'throne01.gif',w:65, h:90, src: imP21 + 'throne01.png',
descr: 'Не сесть...'
		},
				throne0111: {
name: 'Трон Короля', icon: imP11 + 'throne01.gif',w:65, h:90, src: imP21 + 'throne01.png',
descr: 'Телепорт к Бессмертный Король'
		},
		vumpel01: {
name: 'Вымпел', icon: imP11 + 'vumpel01.gif',w:92, h:82, src: imP21 + '2/polot.png',
descr: 'Красота...'
		},
  	zerkalocap: {
name: 'Зеркало', icon: imP11 + 'zer.gif',w:65, h:100, src: imP21 + '1/zer.png',
descr: 'Красота...'
   },
  	weap1: {
name: 'Щит', icon: imP11 + 'weap1.gif',w:76, h:75, src: imP21 + '1/weap1.png',
descr: 'Красота...'
   },
  	weap2: {
name: 'Щит', icon: imP11 + 'weap2.gif',w:79, h:77, src: imP21 + '1/weap2.png',
descr: 'Красота...'
   },
  	weap3: {
name: 'Щит', icon: imP11 + 'weap3.gif',w:74, h:87, src: imP21 + '1/weap3.png',
descr: 'Красота...'
   },
		chestknlz1: {
name: 'Потерянный Сундук',icon: imP11 + 'chest2.gif',src: imP21 + 'chest01.png',
descr: 'Здесь вы можете найти: 1-2<b>Гайки</b>.'
		},
		chestkey1: {
name: 'Потерянный Сундук и Ключ №1',icon: imP11 + 'chestkey1.gif',src: imP21 + 'chest01.png',
descr: 'Здесь вы можете найти: <b>Гайку</b>. Ключ №1 от 2го туннеля.'
		},
		chestkey2: {
name: 'Потерянный Сундук и Ключ №4',icon: imP11 + 'chestkey1.gif',src: imP21 + 'chest01.png',
descr: 'Здесь вы можете найти: <b>Гайку</b>. Ключ №4 от второй половины 4го тоннеля.'
		},
		chestknlz2: {
name: 'Заброшенный Сундук',icon: imP11 + 'chest02.gif',src: imP21 + 'chest02.png',
descr: 'Здесь вы можете найти: <b>Болт</b>.'
		},
		chestknlz3: {
name: 'Старый Сундук',icon: imP11 + 'chest03.gif',src: imP21 + 'chest03.png',
descr: 'Здесь вы можете найти: <b>Вентиль</b>.'
		},
		sliv: {
name: 'Слив', icon: imP11 + 'proboina.gif',		 w:60, h:30, src: imP21 + 'proboina.png',
descr: 'Нажав на него вы окажетесь на клетке <strong>F3</strong>'
		},
  inputkan: {
name: 'Вход',icon: imP11 + 'enter2.gif',src: imP21 + 'ladder02.png',
descr: ''
		},
  kamluki: {
name: 'Каморка Луки',icon: imP11 + 'door3.gif',src: imP21 + '1_front_door2.png',
descr: 'Вход в магазин где можно приобрести вещи за жетоны.'
		},
		gardkan1: {
name: 'Решетка',icon: imP11 + 'grate01.gif',src: imP21 + 'grate01.png',
descr: 'Проход между Главным Коллектором и 2м тоннелем, требуется ключ №1.'
		},
		gardkan11: {
name: 'Решетка',icon: imP11 + 'grate01.gif',src: imP21 + 'grate01.png',
descr: 'Проход между Главным Коллектором и 3м тоннелем, требуется ключ №2.'
		},
		gardkan2: {
name: 'Решетка',icon: imP11 + 'grate02.gif',src: imP21 + 'grate02.png',
descr: 'Проход в первую половину 4го тоннеля, требуется ключ №3.'
		},
		gardkan21: {
name: 'Решетка',icon: imP11 + 'grate02.gif',src: imP21 + 'grate02.png',
descr: 'Проход во вторую половину 4го тоннеля, требуется ключ №4.'
		},                                                 
		gardkan22: {
name: 'Решетка',icon: imP11 + 'grate01.gif',src: imP21 + 'grate01.png',
descr: 'Проход в распределительную, треуется ключ №5'
		},
		keykan23: {
name: 'Ключ №2 и №3',icon: imP11 + 'keykan23.gif',src: imP11 + 'keykan23.png',
descr: 'Ключ №2 от 3го тоннеля, Ключ №3 от первой половины 4го тоннеля. '
		},
		keykan5: {
name: 'Ключ №5',icon: imP11 + 'key5.gif',src: imP21 + 'key5.png',
descr: 'Ключ №5 от Распределительной. '
		},
		trpd: {
name: 'Трубопровод',
icon: imP11 + '1_front_walll_tr.gif',src: imP21 + '1_front_walll_tr.png',
descr: 'За спиной <b>Луки</b> на стене находится трубопровод, с помощью <b>Ключииика</b> можно открутить <b>Вентиль</b>. '
		},
		drainknlz1: {
name: 'Водосток', icon: imP11 + 'drain_bottom.gif',w:60, h:30, src: imP21 + 'drain_bottom.png',
descr: 'Попахивает...'
		},
		drainknlz11: {
name: 'Водосток', icon: imP11 + 'drain_bottom1.gif',w:60, h:30, src: imP21 + 'drain_bottom.png',
descr: 'Попахивает...'
		},
		drainknlz12: {
name: 'Водосток', icon: imP11 + 'drain_bottom1.gif', highlight:2,w:60, h:30, src: imP21 + 'drain_bottom.png',
descr: 'Вы можете найти тут <b>Гайку</b> '
		},
		drainknlz13: {
name: 'Водосток', icon: imP11 + 'draintop1.gif', highlight:2,w:60, h:27, src: imP21 + 'drain_top.png',
descr: 'Находится на северной стене. В нём найдёте гайку.'
		},
		drainknlz14: {
name: 'Загрязнённый водосток', icon: imP11 + 'draintop1.gif', highlight:2,w:60, h:27, src: imP21 + 'drain_top.png',
descr: 'Находится на южной стене. При наличии <b>"Пустая склянка"</b> и нажав на <b>"Загрязнённый водосток"</b> вы получите <b>"Склянка с пробами"</b>. Необходимо для квеста в Храм Знаний. '
		},




  inputkan1: {
name: 'Спуск',icon: imP11 + 'enter2.gif',src: imP21 + 'ladder02.png',
descr: 'Вы окажетесь в клетке <b>N6</b> второго этажа'
		},
  inputkan2: {
name: 'Подъем',icon: imP11 + 'enter2.gif',src: imP21 + 'ladder02.png',
descr: 'Вы окажетесь в клетке <b>D5</b> первого этажа'
		},
		keykan6: {
name: 'Ключ №6',icon: imP11 + 'key6.gif',src: imP21 + 'Key6.png',
descr: 'Ключ №6 от Хозяйственного Помещения. '
		},
		keykan8: {
name: 'Ключ №8',icon: imP11 + 'key8.gif',src: imP21 + 'Key8.png',
descr: 'Ключ №8 от Старого Тоннеля. '
		},
		keykan9: {
name: 'Ключ №9',icon: imP11 + 'key9.gif',src: imP21 + 'Key9.png',
descr: 'Ключ №9 от Административного Помещения. '
		},
		chestknlz4: {
name: 'Кованый сундук',icon: imP11 + 'chest03.gif',src: imP21 + 'chest03.png',
descr: 'Вы найдёте здесь <b>"Чистый Вентиль"</b>.'
		},
		chestknlz5: {
name: 'Серебряный Сундучок',icon: imP11 + 'sunduk.gif',src: imP21 + 'smag_collect1.png',
descr: 'В нём можно найти <b>Нужный Болт</b>.'
		},
		chestknlz51: {
name: 'Серебряный Сундучок + Ключ №7',icon: imP11 + 'smag_collect1_key7.gif',src: imP11 + 'smag_collect1_key7.png',
descr: 'В сундучке можно найти <b>Нужный Болт</b>, ключ №7 от Опасной Зоны.'
		},
		chestknlz6: {
name: 'Бронзовый Сундучок',icon: imP11 + 'smag_collect1_2.gif',src: imP21 + 'smag_collect1_2.png',
descr: 'В нём можно найти <b>Гайка с Резьбой</b>.'
		},
		chestknlz7: {
name: 'Золотой Сундучок',icon: imP11 + 'smag_collect1_3.gif',src: imP21 + 'smag_collect1_3.png',
descr: 'В нём можно найти <b>Рабочий Вентиль</b>.'
		},
		chestknlz8: {
name: 'Кованый Сундук',icon: imP11 + 'chest03.gif',src: imP21 + 'chest03.png',
descr: 'Здесь вы можете найти: <b>Чистый Вентиль</b>.'
		},
		sliv1: {
name: 'Слив', icon: imP11 + 'proboina.gif',w:60, h:30, src: imP21 + 'proboina.png',
descr: 'Нажав на него вы, окажетесь на клетке <strong>N6</strong>'
		},
		potkan: {
name: 'Печь',icon: imP11 + 'pot.gif',src: imP21 + 'boiler01.png',
descr: '"Жжёт".'
		},
		pech1: {
name: 'Подогреватель',icon: imP11 + 'w_pech2.gif',src: imP21 + '1/w_pech2.png',
descr: 'Могут выпасть: Восстановление энергии +45HP, Сосуд жизненных сил, Лечение травм - падает рандомно 1-6 предметов - после выхода из пещеры пропадает.'
		},
	dangerkan1: {
name: 'Засада', icon: imP11 + 'danger.gif', highlight:1,src: imP11 + 'danger_big.gif',
descr: 'Наступив на эту клетку на вас нападёт "страшный монстр" притаившийся за углом, может и не один... '
		},
	dangerkan2: {
name: 'Невидимая Ловушка', icon: imP11 + 'danger.gif', highlight:1,src: imP11 + 'danger_big.gif',
descr: 'Наступив на эту клетку получите урон на -1000НР.'
		},
	zkliuk1: {
name: 'Спуск в Котельную', icon: imP11 + 'zkliuk.gif',src: imP21 + 'zk_liuk_2.png',
descr: 'Вход строго с Вантузами! - взять можно у Луки. Наступив на люк вы переместитесь в "Котельную" (3й этаж).'
		},
	zkliuk2: {
name: 'Технический утилизатор - НЕ ВХОДИ УБЬЁТ!!!', icon: imP11 + 'zkliuk.gif',src: imP21 + 'zk_liuk_1.png',
descr: 'Если вы в него все таки войдете - окажетесь на клетке <b>k10</b> - со всех сторон ловушки на -1000, выхода нет.'
		},
		trash: {
name: 'Месторождение мусора',icon: imP11 + 'trash01.gif',w:102, h:49, src: imP21 + 'trash01.png',
descr: 'В нём можно найти <b>Чистая Гайка</b>.'
		},
		trash1: {
name: 'Останки Сантехника',icon: imP11 + 'garbage.gif',w:102, h:49, src: imP21 + 'trash02.png',
descr: 'В нём можно найти <b>Длинный Болт</b>.'
		}, 
		gardkan3: {
name: 'Решетка',icon: imP11 + 'grate01.gif',src: imP21 + 'grate01.png',
descr: 'Проход в Хозяйственное Помещение, треуется ключ №6'
		},
		gardkan31: {
name: 'Решетка',icon: imP11 + 'grate01.gif',src: imP21 + 'grate01.png',
descr: 'Проход в Отсек 1, треуется ключ №7'
		},                                                    
		gardkan32: {
name: 'Решетка',icon: imP11 + 'grate01.gif',src: imP21 + 'grate01.png',
descr: 'Проход в Отсек 2, треуется ключ №7'
		},                                                    
		gardkan33: {
name: 'Решетка',icon: imP11 + 'grate01.gif',src: imP21 + 'grate01.png',
descr: 'Проход в Отсек 3, треуется ключ №7'
		},                                                    
		gardkan34: {
name: 'Решетка',icon: imP11 + 'grate01.gif',src: imP21 + 'grate01.png',
descr: 'Проход в Отсек 4, треуется ключ №7'
		},                                                    
		gardkan4: {
name: 'Решетка',icon: imP11 + 'grate02.gif',src: imP21 + 'grate02.png',
descr: 'Проход в Старый Тоннель, требуется ключ №8.'
		},                                                                   
		gardkan41: {
name: 'Решетка',icon: imP11 + 'grate02.gif',src: imP21 + 'grate02.png',
descr: 'Проход в Административное Помещение, требуется ключ №9.'
		},
	dangerkan: {
name: 'Засада', icon: imP11 + 'danger.gif', highlight:1,src: imP11 + 'danger_big.gif',
descr: 'Наступив на эту клетку на вас нападёт <b>"Местный Житель"</b>, но только в том случае, если он притаился за углом!'
		},
		kuznang: {
name: 'Наковальня забытых мастеров',icon: imP11 + 'kuzn.gif',src: imP2 + 'objects/forge01.png',
descr: 'Вы сможете модифицировать   '
		},
		kuznsnd: {
name: 'Наковальня забытых мастеров',icon: imP11 + 'kuzn.gif',src: imP2 + 'objects/forge01.png',
descr: 'Вы сможете модифицировать  '
		},
		kuzndem: {
name: 'Наковальня забытых мастеров',icon: imP11 + 'kuzn.gif',src: imP2 + 'objects/forge01.png',
descr: 'Вы сможете модифицировать  '
		},
		dangercap5: {
name: 'Невидимая ловушка', icon: imP11 + 'danger.gif', highlight:1,src: imP11 + 'danger_big.gif',
descr: 'Невидимая ловушка, наступив на эту клетку на вас нападут боты с клетки <b>M16</b>'
		},
		dangercap51: {
name: 'Невидимая ловушка', icon: imP11 + 'danger.gif', highlight:1,src: imP11 + 'danger_big.gif',
descr: 'Невидимая ловушка, наступив на эту клетку на вас нападут боты с клеток <b>I9</b> и <b>J10</b>'
		},
		enterGG: {
name: 'Вход',icon: imP11 + 'arrow1.gif',src: imP11 + 'arrow1.gif',
descr: ''
		},
		gghole1: {
name: 'Ниша в стене', highlight:2,icon: imP11 + 'gghole1.gif',src: imP21 + 'gghole1.png',
descr: 'Находится на восточной стене. В ней находится ключ <img src="'+imP3+'gg_key1.gif" width="32" height="32"/>"Болотная отмычка" от "Заросшего Прохода" на F8 и G8. Взять можно убив всех монстров в логове.'
		},
		gghole12: {
name: 'Ниша в стене', highlight:2,icon: imP11 + 'gghole1.gif',src: imP21 + 'gghole1.png',
descr: 'Находится на восточной стене. В ней находится ключ <img src="'+imP3+'gg_key3.gif" width="32" height="32"/>"Скользкий ключ" от "Заросшего Прохода" на K3 и K4. Взять можно убив всех монстров в логове.'
		},
		ggholezoom11: {
name: 'Ниша в стене', highlight:2,icon: imP11 + 'gghole1.gif',src: imP21 + '1/ggholezoom.gif',
descr: 'Нажав вы побеседуете с Грибоедом, узнаете какие вещи качества VF и EF можно у него купить. Ассортимент магазина грибоеда смотрите на вкладке "Магазины". '
		},
		gghole13: {
name: 'Ниша в стене', highlight:2,icon: imP11 + 'gghole1.gif',src: imP21 + 'gghole1.png',
descr: 'Находится на южной стене клетки С11. В ней находится "Охранный ключ Грибоножки" - <img src="'+imP3+'gg_key4.gif" width="32" height="32"/>  '
		},
		ggdoor22: {
name: 'Заросший проход',icon: imP11 + 'ggdoor2.gif',src: imP21 + 'ggdoor2.png',
descr: 'Находится на восточной стене клетки F8. При наличии <img src="'+imP3+'gg_key1.gif" width="32" height="32"/> "Болотной отмычки"  можно пройти из F8 на G8 и обратно.'
		},
		ggdoor221: {
name: 'Заросший проход',icon: imP11 + 'ggdoor2.gif',src: imP21 + 'ggdoor2.png',
descr: 'Находится на западной стене клетки G8. При наличии <img src="'+imP3+'gg_key1.gif" width="32" height="32"/> "Болотной отмычки"  можно пройти из F8 на G8 и обратно.'
		},
		ggdoor2: {
name: 'Заросший проход',icon: imP11 + 'ggdoor2.gif',src: imP21 + 'ggdoor2.png',
descr: 'Находится на северной стене клетки K4. При наличии <img src="'+imP3+'gg_key3.gif" width="32" height="32"/> "Скользкого ключа"  можно пройти из К4 на К3 и обратно.'
		},
		ggdoor21: {
name: 'Заросший проход',icon: imP11 + 'ggdoor2.gif',src: imP21 + 'ggdoor2.png',
descr: 'Находится на южной стене клетки K3. При наличии <img src="'+imP3+'gg_key3.gif" width="32" height="32"/> "Скользкого ключа"  можно пройти из К4 на К3 и обратно.'
		},
		 ggperehod1: {
name: 'Спуск в нору',icon: imP11 + 'ggperehod1.gif',src: imP21 + 'ggperehod1.png',
descr: 'Находится на восточной стене клетки D7, перемещает из D7 на Е8 и обратно.'
		},
		 ggperehod12: {
name: 'Подъем',icon: imP11 + 'ggperehod2.gif',src: imP21 + 'ggperehod2.png',
descr: 'Находится на северной стене клетки Е8, перемещает из Е8 на D7 и обратно.'
		},
		 ggdoor1: {
name: 'Хитиновый люк',icon: imP11 + 'ggdoor1.gif',w:46, h:64, src: imP21 + 'ggdoor1.png',
descr: 'Находится на северной стене клетки С5, перемещает из С5 на С4 и обратно.'
		},
		 ggdownhole1: {
name: 'Спуск',icon: imP11 + 'ggdownhole1.gif',w:60, h:26, src: imP21 + 'ggdownhole1.png',
descr: 'Спуск на 2й этаж, перемещает на К7, двухсторонний.'
		},
		 gguphole1: {
name: 'Подъем',icon: imP11 + 'gguphole1.gif',src: imP21 + 'gguphole1.png',
descr: 'Находится на потолке, перемещает на F2 1го этажа, двухсторонний.'
		},
		ggchest1: {
name: 'Заросший тайник',highlight:1,icon: imP11 + 'ggchest1.gif',w:57, h:32, src: imP21 + 'ggchest1.png',
descr: 'Сундук, каждый может что-то найти, например "Пустую бутылку" или "Сушеный мухомор", а можете и "Грибочек" найти. Взять можно убив всех монстров в логове. Для всех членов команды.<BR /> Возможна ловушка.'
		},
		ggchest11: {
name: 'Заросший тайник',highlight:1,icon: imP11 + 'ggchest1.gif',w:57, h:32, src: imP21 + 'ggchest1.png',
descr: 'Сундук, каждый может что-то найти, например "Пустую бутылку" или "Сушеный мухомор", а можете и "Грибочек" найти. Взять можно убив всех монстров в логове. Для первого взявшего.<BR /> Возможна ловушка.'
		},
		ggchest2: {
name: 'Заросший тайник',highlight:1,icon: imP11 + 'ggchest2.gif',src: imP21 + 'ggchest2.png',
descr: 'Сундук, каждый может что-то найти, например "Пустую бутылку" или "Сушеный мухомор", а можете и "Грибочек" найти. <BR /> Возможна ловушка.'
		},
		ggchest21: {
name: 'Заросший тайник',highlight:2,icon: imP11 + 'ggchest1.gif',w:57, h:32, src: imP21 + 'ggchest1.png',
descr: 'Если у вас есть <BR /><img src="'+imP3+'gg_key4.gif" width="32" height="32"/> - "Охранный ключ Грибоножки" <BR />и <img src="'+imP3+'gg_key5.gif" width="32" height="32"/> - "Охранный ключ Щупа"<BR /> вы получите - <img src="'+imP3+'gg_key2.gif" width="32" height="32"/> - "Проходное жвало". <BR />Позволит пройти к "Королеве Грибницы"'
		},
		ggchest22: {
name: 'Заросший тайник',highlight:1,icon: imP11 + 'ggchest2.gif',src: imP21 + 'ggchest2.png',
descr: 'Сундук, каждый получает по "Грибочку". Возможна ловушка.'
		},
	 ggdownhole12: {
name: 'Ниша в полу',highlight:2,icon: imP11 + 'ggdownhole1.gif',w:60, h:26, src: imP21 + 'ggdownhole1.png',
descr: 'Тут вы найдете "Охранный ключ Щупа" - <img src="'+imP3+'gg_key5.gif"  width="32" height="32"/>. Взять можно убив "Осторожного Щупа".'
		},
		ggmusor1: {
name: 'Скопление непонятных грибных образований',highlight:1,icon: imP11 + 'ggmusor1.gif',w:80, h:30, src: imP21 + 'ggmusor1.png',
descr: 'Куча мусора, можно что-то найти, например: свиток лечения тяжелых травм, востановление +45,60ХП, Настойку на грибах. Можно получить болезнь: <br><img src="'+imP41+'ggspeed.gif" /> <b>Дрожь в коленях</b> - Скорость перемещения замедлена. Время действия: 3 часа.<br><img src="'+imP41+'ggwater.gif" /> <b>Слабость к Воде</b> - Защита от магии Воды: -100. Время действия: 3 часа.<br><img src="'+imP41+'ggfire.gif" /> <b>Слабость к Огню</b> - Защита от магии Огня: -100. Время действия: 3 часа.<br><img src="'+imP41+'ggair.gif" /> <b>Слабость к Воздуху</b> - Защита от магии Воздуха: -100. Время действия: 3 часа.<br><img src="'+imP41+'gghpreg.gif" /> <b>Ускоренное обновление</b> - Восстановление Маны и НР (%): +100. Время действия: 1 час.'
		},
		ggmusor2: {
name: 'Слизкое нечто, не внушающее доверия',highlight:1,icon: imP11 + 'ggmusor2.gif',w:80, h:30, src: imP21 + 'ggmusor2.png',
descr: 'Куча мусора, можно что-то найти, например: свиток лечения тяжелых травм, востановление +45,60ХП, Настойку на грибах. Можно получить болезнь: <br><img src="'+imP41+'ggspeed.gif" /> <b>Дрожь в коленях</b> - Скорость перемещения замедлена. Время действия: 3 часа.<br><img src="'+imP41+'ggwater.gif" /> <b>Слабость к Воде</b> - Защита от магии Воды: -100. Время действия: 3 часа.<br><img src="'+imP41+'ggfire.gif" /> <b>Слабость к Огню</b> - Защита от магии Огня: -100. Время действия: 3 часа.<br><img src="'+imP41+'ggair.gif" /> <b>Слабость к Воздуху</b> - Защита от магии Воздуха: -100. Время действия: 3 часа.<br><img src="'+imP41+'gghpreg.gif" /> <b>Ускоренное обновление</b> - Восстановление Маны и НР (%): +100. Время действия: 1 час.'
		},
		ggwell1: {
name: 'Чудодейственная лужа',highlight:2,icon: imP11 + 'ggwell1.gif',w:66, h:40, src: imP21 + 'ggwell1.png',
descr: 'Дает "Настойку на грибах F", всем членам команды.'
		},
		ggwell2: {
name: 'Мерцающий источник',highlight:2,icon: imP11 + 'ggwell2.gif',w:66, h:40, src: imP21 + 'ggwell2.png',
descr: 'Первому нажавшему приз: <img src="'+imP41+'gghpmax.gif" /> Эффект "Крепкое здоровье" +20&#37; от вашего максимально количества НР. После выхода из пещеры пропадает.'
		},
//гг3
		ggmusor3: {
name: 'Скопление поганок',icon: imP11 + 'ggmusor1.gif',w:80, h:30, src: imP21 + 'ggmusor1.png',
descr: 'Тухлятина.. противно даже ботинок об такие пачкать..'
		},
		ggmusor31: {
name: 'Труп гигантской гусеницы',icon: imP11 + 'ggmusor2.gif',w:80, h:30, src: imP21 + 'ggmusor2.png',
descr: 'Выглядит вполне аппетитно...'
		},
		koch3gg: {
name: 'Кочка', icon: imP11 + 'koch2.gif',w:83, h:28, src: imP21 + '1/tn_koch2.png',
descr: 'Чем-то напоминает могилу...'
		},
		koch31gg: {
name: 'Кочка', icon: imP11 + 'koch1.gif',w:83, h:28, src: imP21 + '1/tn_koch1.png',
descr: 'От этой кочки странно пахнет...'
		},
	 ggdownhole3: {
name: 'Воронка',icon: imP11 + 'ggdownhole1.gif',w:60, h:26, src: imP21 + 'ggdownhole1.png',
descr: 'Там внизу темно, страшно и очень-очень тихо.'
		},
	 ggdownhole31: {
name: 'Спуск на 3й',icon: imP11 + 'ggdownhole1.gif',w:60, h:26, src: imP21 + 'ggdownhole1.png',
descr: 'Пройти можно в обе стороны'
		},
		ggchest31: {
name: 'Раковина',icon: imP11 + 'ggchest1.gif',w:57, h:32, src: imP21 + 'ggchest1.png',
descr: 'Бывший домик огромной улитки'
		},
		ggchest32: {
name: 'Подозрительное яйцо',icon: imP11 + 'ggchest2.gif',src: imP21 + 'ggchest2.png',
descr: 'В яйце что-то шевелится'
		},
		ggwell3: {
name: 'Мутный источник',icon: imP11 + 'ggwell2.gif',w:66, h:40, src: imP21 + 'ggwell2.png',
descr: 'Источник? Это же самое настоящее болото!'
		},
		ggwell31: {
name: 'Мутный источник',icon: imP11 + 'well.gif',w:66, h:40, src: imP21 + 'gg_qwell.png',
descr: 'Источник? Это же самое настоящее болото!'
		},
		ggwell32: {
name: 'Заросший пруд',icon: imP11 + 'lake.gif',w:66, h:40, src: imP21 + 'gg_qlake.png',
descr: 'Обычное, ничем не примечательно озерцо посреди грибницы. Что вас заинтересовало?'
		},
		ggdoor3: {
name: 'Логово',icon: imP11 + 'ggdoor2.gif',src: imP21 + 'ggdoor2.png',
descr: 'Выключите свет...они ползут на свет...<br>Отсюда появляются новые боты...'
		},
		ggtpt: {
name: 'Невидимый Телепорт', icon: imP11 + 'danger2.gif', src: imP11 + 'danger2_big.gif',
descr: 'Наступив на эту клетку вы перенесетесь на клетку <b>А8</b>'
		},
		ggtpt1: {
name: 'Выход', icon: imP11 + 'pasg.gif', src: imP21 + 'gg_passage_to_light1.png',
descr: 'Выйдя отсюда вы окажетесь на клетке <b>М2</b>'
		},
  ggdanger: {
name: 'Невидимая ловушка', icon: imP11 + 'danger.gif', src: imP11 + 'danger_big.gif',
descr: 'Для прохода необходим предмет <img  height=35 width=35 src="'+imP3+'gg3_shiz_crystal.gif" /> <b>Черный кристалл</b> или убить "Рогача". '
		},
ggsund: {
name: 'Таинственный сундук', icon: imP11 + 'ggsund.gif', src: imP21 + 'gg_sunduk.png',
descr: 'Таинственный сундук.Старый и с виду разваливающийся сундук, на деле оказывается крепким орешком. Все что вы смогли сделать с ним это слегка его поцарапать, после долгих ударов по крышке. Сундук не открывается. Отсюда два вывода. Первый - здесь замешана магия. Второй - нужно что-то, что могло бы снять эту магию и открыть этот сундук.'
		},
wsvet: {
name: 'Белый светляк', icon: imP11 + 'svbel.gif', src: imP21 + 'dec_torch02_b.png',
descr: 'Для диалога необходимо нажать по разу, каждого светляка, что обозначены на карте. Открывает возможность телепортнутся с клетки F3 к Скорпиончикам.'
		},
wsvet2: {
name: 'Белый светляк', icon: imP11 + 'svbel.gif', src: imP21 + 'dec_torch02_b.png',
descr: 'Телепорт в обе стороны с клетки F3 и обратно.'
		},
svche: {
name: 'Черный светляк', icon: imP11 + 'svche.gif', src: imP21 + 'dec_torch02.png',
descr: 'Вход. Так же телепорт на 3й при наличии "Феромонов".'
		}, 
svkra: {
name: 'Красный светляк', icon: imP11 + 'svkra.gif', src: imP21 + '2/dec_torch02r.png',
descr: ''
		}, 
svorj: {
name: 'Оранжевый светляк', icon: imP11 + 'svorj.gif', src: imP21 + '2/dec_torch02.png',
descr: ''
		},
svzel: {
name: 'Зеленый светляк', icon: imP11 + 'svzel.gif', src: imP21 + '2/dec_torch02g.png',
descr: ''
		},
svgol: {
name: 'Голубой светляк', icon: imP11 + 'svgol.gif', src: imP21 + '2/dec_torch02b.png',
descr: ''
		},
svfio: {
name: 'Фиолетовый светляк', icon: imP11 + 'svfio.gif', src: imP21 + '1/dec_torch02u.png',
descr: ''
		},
 dnggg: {
name: 'Невидимая ловушка', icon: imP11 + 'danger.gif', highlight:1,src: imP11 + 'danger_big.gif',
descr: 'Наступив, на вас нападут Скорпиончики.'
		},

//пруд
		icedoor: {
name: 'Дверь',icon: imP11 + 'icedoor.gif',src: imP21 + '1/icedoor.png',
descr: 'Необходим <img src="'+imP3+'Key6.gif" /> - Ключ №6 '
		},
		icedoor2: {
name: 'Дверь',icon: imP11 + 'icedoor.gif',src: imP21 + '1/icedoor.png',
descr: 'Выйдя через дверь, задержка на посещение 45 минут, общая со всеми пещерами.'
		},
		icehole: {
name: 'Прорубь',highlight:2,icon: imP11 + 'icehole.gif',w:98, h:28, src: imP21 + 'icehole01.png',
descr: 'Нажавшему приз: <img src="'+imP41+'standart_effect.gif" > "Закалка" дает 120НР на сутки.(В общежитии не замораживается.)<br> Для работы необходимо убить всех <b>Отморозков</b> вокруг <b>Проруби</b>.'
		},
		icehole2: {
name: 'Спуск',icon: imP11 + 'spusk.gif',src: imP21 + 'les1up2.png',
descr: 'Спуск на 2й этаж'
		},
		enterab: {
name: 'Вход',icon: imP11 + 'arrow1.gif',src: imP11 + 'arrow1.gif',
descr: ''
		},
		enterab1: {
name: 'Вход',icon: imP11 + 'arrow1.gif',src: imP11 + 'arrow1.gif',
descr: ''
		},
		teleportab: {
name: 'Передовая (Души)',icon: imP11 + 'telport.gif',src: imP21 + 'teleport02.png',
descr: 'Перемещает в клетку <b>M10</b>'
		},
		teleportab1: {
name: 'Передовая (Зомби)',icon: imP11 + 'telportgreen.gif',src: imP21 + 'teleport04.png',
descr: 'Перемещает в клетку <b>G2</b>'
		},
  teleportab2: {
name: 'Передовая (Проклятья)',icon: imP11 + 'teleport06.gif',src: imP21 + 'teleport06.png',
descr: 'Перемещает в клетку <b>I2</b>'
		},
  teleportab3: {
name: 'Эвакуация',icon: imP11 + 'teleport06.gif',src: imP21 + 'teleport06.png',
descr: 'Перемещает в Приемную к Военкому.'
		},
// devels
		dangertn: {
name: 'Невидимая ловушка', icon: imP11 + 'danger.gif', highlight:1,src: imP11 + 'danger_big.gif',
descr: '<font color="red">Ловушка не обязательно срабатывает на первом наступившем!<br></font>Можно получить болезнь: <br><img src="'+imP41+'ggspeed.gif" /> "Дрожь в коленях" 15 минут - уменьшает скорость передвижения, до х5.<br><img src="'+imP41+'ggregen.gif" /> "Ускоренное обновление" 30 минут - Восстановление маны и НР (%): +100, до х3.<br><img src="'+imP41+'tn_debuff_res.gif" /> "Стихийная слабость" 30 минут - Защита от стихийной магии: -25, до х3. <br><img src="'+imP41+'tn_debuff.gif" /> "Болотная лихорадка" 30 минут -  сила, ловкость, интуиция, интеллект: -5, до х5.<br>"Дрож в коленях" и "Болотная лихорадка" заменяют друг друга.'
		},
		koch1: {
name: 'Кочка', icon: imP11 + 'koch1.gif',w:83, h:28, src: imP21 + '1/tn_koch1.png',
descr: 'От этой кочки странно пахнет...'
		},
		koch2: {
name: 'Кочка', icon: imP11 + 'koch2.gif',w:83, h:28, src: imP21 + '1/tn_koch2.png',
descr: 'Можно сесть и перевести дух...'
		},
		koch3: {
name: 'Кочка', icon: imP11 + 'koch3.gif',w:83, h:28, src: imP21 + '1/tn_koch3.png',
descr: 'От этой кочки странно пахнет...'
		},
		kust1: {
name: 'Куст', icon: imP11 + 'kust1.gif',w:65, h:39, src: imP21 + '1/tn_kust1.png',
descr: 'Наверное, хороший чай можно из этих листиков заварить...'
		},
		kust2: {
name: 'Куст', icon: imP11 + 'kust2.gif',w:48, h:33, src: imP21 + '1/tn_kust2.png',
descr: 'Ни одной гусеницы на листьях, перекусить нечем...'
		},
		kust3: {
name: 'Куст', icon: imP11 + 'kust3.gif',w:72, h:37, src: imP21 + '1/tn_kust3.png',
descr: 'Отличное место чтобы спрятаться...'
		},
		kust4: {
name: 'Куст', icon: imP11 + 'kust4.gif',w:51, h:35, src: imP21 + '1/tn_kust4.png',
descr: 'Ни одной гусеницы на листьях, перекусить нечем...'
		},
		luzh1d: {
name: 'Заросший пруд', icon: imP11 + 'luzh1.gif',w:125, h:30, src: imP21 + '1/tn_luzh1.png',
descr: 'А водятся ли тут КАРАСИ?!'
		},
		luzh1: {       //дальний
name: 'Заросший пруд', icon: imP11 + 'luzh1.gif', highlight:1,w:125, h:30, src: imP21 + '1/tn_luzh1.png',
descr: 'Есть шанс найти 3 предмета. Можно найти: "Изменчивые водоросли", "Мерцающий кристалл", "Слезы лунного мерцания", "Кристальный песок", а можно и болезнь подцепить: <br><img src="'+imP41+'ggspeed.gif" /> "Дрожь в коленях" 15 минут - уменьшает скорость передвижения, до х5.<br><img src="'+imP41+'ggregen.gif" /> "Ускоренное обновление" 30 минут - Восстановление маны и НР (%): +100, до х3 <br><img src="'+imP41+'tn_debuff_res.gif" /> "Стихийная слабость" 30 минут - Защита от стихийной магии: -25, до х3. <br><img src="'+imP41+'tn_debuff.gif" /> "Болотная лихорадка" 30 минут -  сила, ловкость, интуиция, интеллект: -5, до х5.<br>"Дрожь в коленях" и "Болотная лихорадка" заменяют друг друга.'
		},
		luzh2: {      //верхний
name: 'Заросший пруд', icon: imP11 + 'luzh2.gif',highlight:1,w:120, h:30, src: imP21 + '1/tn_luzh2.png',
descr: 'Есть шанс найти 3 предмета. Можно найти: "Изменчивые водоросли", "Мерцающий кристалл", "Слезы лунного мерцания", "Кристальный песок", а можно и болезнь подцепить: <br><img src="'+imP41+'ggspeed.gif" /> "Дрожь в коленях" 15 минут - уменьшает скорость передвижения, до х5.<br><img src="'+imP41+'ggregen.gif" /> "Ускоренное обновление" 30 минут - Восстановление маны и НР (%): +100, до х3 <br><img src="'+imP41+'tn_debuff_res.gif" /> "Стихийная слабость" 30 минут - Защита от стихийной магии: -25, до х3. <br><img src="'+imP41+'tn_debuff.gif" /> "Болотная лихорадка" 30 минут -  сила, ловкость, интуиция, интеллект: -5, до х5.<br>"Дрожь в коленях" и "Болотная лихорадка" заменяют друг друга.'
		},
		ozero: {
name: 'Берег озера', icon: imP11 + 'ozero.gif', highlight:1,w:85, h:80, src: imP11 + 'tn_ozero.png',
descr: 'Есть шанс найти 5 предмета. Можно найти: "Изменчивые водоросли", "Мерцающий кристалл", "Кристальный песок", "Слезы лунного мерцания", "Черное масло", а можно и болезнь подцепить: <br><img src="'+imP41+'ggspeed.gif" /> "Дрожь в коленях" 15 минут - уменьшает скорость передвижения, до х5.<br><img src="'+imP41+'ggregen.gif" /> "Ускоренное обновление" 30 минут - Восстановление маны и НР (%): +100, до х3<br><img src="'+imP41+'tn_debuff_res.gif" /> "Стихийная слабость" 30 минут - Защита от стихийной магии: -25, до х3. <br><img src="'+imP41+'tn_debuff.gif" /> "Болотная лихорадка" 30 минут -  сила, ловкость, интуиция, интеллект: -5, до х5.<br>"Дрожь в коленях" и "Болотная лихорадка" заменяют друг друга.'
		},
		ogon1: {
name: 'Костер', icon: imP11 + 'ogon1.gif', highlight:1,w:43, h:34, src: imP21 + '1/tn_ogon1.png',
descr: 'Нельзя пошарить у костра, пока кто-то из мародеров ошивается поблизости. <br>Есть шанс найти 5 предметов. Можно найти: "Черное масло", "Слезы лунного мерцания", "Бурая шкура", а можно и болезнь подцепить: <br><img src="'+imP41+'ggspeed.gif" /> "Дрожь в коленях" 15 минут - уменьшает скорость передвижения, до х5.<br><img src="'+imP41+'ggregen.gif" /> "Ускоренное обновление" 30 минут - Восстановление маны и НР (%): +100, до х3<br><img src="'+imP41+'tn_debuff_res.gif" /> "Стихийная слабость" 30 минут - Защита от стихийной магии: -25, до х3. <br><img src="'+imP41+'tn_debuff.gif" /> "Болотная лихорадка" 30 минут -  сила, ловкость, интуиция, интеллект: -5, до х5.<br>"Дрожь в коленях" и "Болотная лихорадка" заменяют друг друга.'
		},
		bulizh1: {
name: 'Древняя глыба', icon: imP11 + 'bulizh1.gif', highlight:1,w:56, h:35, src: imP21 + '1/tn_bulizh1.png',
descr: 'Есть шанс найти 3 предмета. Можно найти: "Самородок мерцающего металла", а можно и болезнь подцепить: <br><img src="'+imP41+'ggspeed.gif" /> "Дрожь в коленях" 15 минут - уменьшает скорость передвижения, до х5.<br><img src="'+imP41+'ggregen.gif" /> "Ускоренное обновление" 30 минут - Восстановление маны и НР (%): +100, до х3<br><img src="'+imP41+'tn_debuff_res.gif" /> "Стихийная слабость" 30 минут - Защита от стихийной магии: -25, до х3. <br><img src="'+imP41+'tn_debuff.gif" /> "Болотная лихорадка" 30 минут -  сила, ловкость, интуиция, интеллект: -5, до х5.<br>"Дрожь в коленях" и "Болотная лихорадка" заменяют друг друга.'
		},
		bulizh2: {
name: 'Огромный валун', icon: imP11 + 'bulizh2.gif', highlight:1,w:56, h:31, src: imP21 + '1/tn_bulizh2.png',
descr: 'Есть шанс найти 3 предмета. Можно найти: "Самородок мерцающего металла", а можно и болезнь подцепить: <br><img src="'+imP41+'ggspeed.gif" /> "Дрожь в коленях" 15 минут - уменьшает скорость передвижения, до х5.<br><img src="'+imP41+'ggregen.gif" /> "Ускоренное обновление" 30 минут - Восстановление маны и НР (%): +100, до х3<br><img src="'+imP41+'tn_debuff_res.gif" /> "Стихийная слабость" 30 минут - Защита от стихийной магии: -25, до х3. <br><img src="'+imP41+'tn_debuff.gif" /> "Болотная лихорадка" 30 минут -  сила, ловкость, интуиция, интеллект: -5, до х5.<br>"Дрожь в коленях" и "Болотная лихорадка" заменяют друг друга.'
		},
		pen1: {
name: 'Древний пень', icon: imP11 + 'pen1.gif', highlight:1,w:56, h:35, src: imP21 + '1/tn_pen1.png',
descr: 'Есть шанс найти 3 предмета. Можно найти: "Древний мох", а можно и болезнь подцепить: <br><img src="'+imP41+'ggspeed.gif" /> "Дрожь в коленях" 15 минут - уменьшает скорость передвижения, до х5.<br><img src="'+imP41+'ggregen.gif" /> "Ускоренное обновление" 30 минут - Восстановление маны и НР (%): +100, до х3<br><img src="'+imP41+'tn_debuff_res.gif" /> "Стихийная слабость" 30 минут - Защита от стихийной магии: -25, до х3. <br><img src="'+imP41+'tn_debuff.gif" /> "Болотная лихорадка" 30 минут -  сила, ловкость, интуиция, интеллект: -5, до х5.<br>"Дрожь в коленях" и "Болотная лихорадка" заменяют друг друга.'
		},
		pen2: {
name: 'Трухлявый пень', icon: imP11 + 'pen2.gif', highlight:1,w:56, h:31, src: imP21 + '1/tn_pen2.png',
descr: 'Есть шанс найти 3 предмета. Можно найти: "Древний мох", а можно и болезнь подцепить: <br><img src="'+imP41+'ggspeed.gif" /> "Дрожь в коленях" 15 минут - уменьшает скорость передвижения, до х5.<br><img src="'+imP41+'ggregen.gif" /> "Ускоренное обновление" 30 минут - Восстановление маны и НР (%): +100, до х3<br><img src="'+imP41+'tn_debuff_res.gif" /> "Стихийная слабость" 30 минут - Защита от стихийной магии: -25, до х3. <br><img src="'+imP41+'tn_debuff.gif" /> "Болотная лихорадка" 30 минут -  сила, ловкость, интуиция, интеллект: -5, до х5.<br>"Дрожь в коленях" и "Болотная лихорадка" заменяют друг друга.'
		},
		pen3: {
name: 'Корявый пень', icon: imP11 + 'pen3.gif', highlight:1,w:56, h:51, src: imP21 + '1/tn_pen3.png',
descr: 'Есть шанс найти 3 предмета. Можно найти: "Древний мох", а можно и болезнь подцепить: <br><img src="'+imP41+'ggspeed.gif" /> "Дрожь в коленях" 15 минут - уменьшает скорость передвижения, до х5.<br><img src="'+imP41+'ggregen.gif" /> "Ускоренное обновление" 30 минут - Восстановление маны и НР (%): +100, до х3<br><img src="'+imP41+'tn_debuff_res.gif" /> "Стихийная слабость" 30 минут - Защита от стихийной магии: -25, до х3. <br><img src="'+imP41+'tn_debuff.gif" /> "Болотная лихорадка" 30 минут -  сила, ловкость, интуиция, интеллект: -5, до х5.<br>"Дрожь в коленях" и "Болотная лихорадка" заменяют друг друга.'
		},
		zarkuz: {
name: 'Заросшая кузница', icon: imP11 + 'zarkuz.gif',w:75, h:45, src: imP21 + '1/tn_anvil.png',
descr: ' '
		},
	 yama1: {
name: 'Глубокая трещина', icon: imP11 + 'yama1.gif',highlight:1,w:110, h:30, src: imP21 + '1/tn_yama1.png',
descr: 'Есть шанс найти 4 предмета. Можно найти: "Черное масло", а можно и болезнь подцепить: <br><img src="'+imP41+'ggspeed.gif" /> "Дрожь в коленях" 15 минут - уменьшает скорость передвижения, до х5.<br><img src="'+imP41+'ggregen.gif" /> "Ускоренное обновление" 30 минут - Восстановление маны и НР (%): +100, до х3<br><img src="'+imP41+'tn_debuff_res.gif" /> "Стихийная слабость" 30 минут - Защита от стихийной магии: -25, до х3. <br><img src="'+imP41+'tn_debuff.gif" /> "Болотная лихорадка" 30 минут -  сила, ловкость, интуиция, интеллект: -5, до х5.<br>"Дрожь в коленях" и "Болотная лихорадка" заменяют друг друга.'
		},
	 yama2: {
name: 'Смердящая яма', icon: imP11 + 'yama2.gif',highlight:1,w:105, h:30, src: imP21 + '1/tn_yama2.png',
descr: 'Есть шанс найти 4 предмета. Можно найти: "Черное масло", а можно и болезнь подцепить: <br><img src="'+imP41+'ggspeed.gif" /> "Дрожь в коленях" 15 минут - уменьшает скорость передвижения, до х5.<br><img src="'+imP41+'ggregen.gif" /> "Ускоренное обновление" 30 минут - Восстановление маны и НР (%): +100, до х3<br><img src="'+imP41+'tn_debuff_res.gif" /> "Стихийная слабость" 30 минут - Защита от стихийной магии: -25, до х3. <br><img src="'+imP41+'tn_debuff.gif" /> "Болотная лихорадка" 30 минут -  сила, ловкость, интуиция, интеллект: -5, до х5.<br>"Дрожь в коленях" и "Болотная лихорадка" заменяют друг друга.'
		},
		grot: {
name: 'Проход в грот', icon: imP11 + 'grot.gif',w:120, h:60, src: imP21 + '1/tn_grot.png',
descr: 'Дыра в скале... веет сыростью и тухлой рыбой. Пролезть внутрь не получается, мешает ржавая решетка.'
		},
		sklp: {
name: 'Проход в разграбленный склеп', icon: imP11 + 'sklp1.gif',w:49, h:60, src: imP21 + '1/tn_sklp.png',
descr: 'Из глубины прохода доносятся отвратительные попискивания и шаркания. Спуститься вниз мешают остатки надгробной плиты, запечатанные какими-то символами.'
		},



//гл
 gldoor: {
			name: 'Решетка - дверь',
			icon: imP11 + 'gldoor.gif',
			src: imP21 + '1/door.png',
			descr: 'Настоящая чугунная решетка! Раньше делали на совесть!<br>НЕ пройти. '
		},
 gldoor1: {
			name: 'Решетка - дверь',
			icon: imP11 + 'gldoor.gif',
			src: imP21 + '1/door.png',
			descr: 'Настоящая чугунная решетка! Раньше делали на совесть! '
		},
 gldoor11: {
			name: 'Решетка - дверь',
			icon: imP11 + 'gldoor.gif',
			src: imP21 + '1/door.png',
			descr: ''
		},
 gldoorz: {
			name: 'Решетка - дверь',
			icon: imP11 + 'gldoor.gif',
			src: imP21 + '1/door.png',
			descr: 'Квест на тело Кейси.'
		},
 gldoorf: {
			name: 'Решетка - дверь',
			icon: imP11 + 'gldoor.gif',
			src: imP21 + '1/door.png',
			descr:''
			//descr: 'Необходим <img src="'+imP3+'gl_farmerkey.gif" /><b>Ключ от Фермы</b>. Ключ снимается со спящего Фермера Ивана при наличии квеста на убийство Жучьей Матки. <br>Квест берётся у Гаечного Ключа.'
		},
  glnish1: {
			name: 'Ниша в стене',
			icon: imP11 + 'glnish1.gif',
			w:44, h:80, src: imP21 + '1/nish1.png',
			descr: 'Ой! Скелет!'
		},
  glnish2: {
			name: 'Ниша в стене',
			icon: imP11 + 'glnish2.gif',
			w:44, h:80, src: imP21 + '1/nish2.png',
			descr: 'Я точно помню, здесь раньше был скелет!'
		}, 
  glrych1: {
			name: 'Таинственный рычаг',
			icon: imP11 + 'glrych1.gif',
			w:22, h:44, src: imP21 + '1/rych1.png',
			descr: 'Необходимая для использования рычага сила: 750'
		}, 
  glluk: {
			name: 'Люк',
			icon: imP11 + 'glluk.gif',
			w:50, h:20, src: imP21 + '1/lluk.png',
			descr: 'Люк ведет на нижние этажи Горы Легиона.'
		}, 
  glluk2: {
			name: 'Люк',
			icon: imP11 + 'glluk.gif',
			w:50, h:20, src: imP21 + '1/lluk.png',
			descr: 'Люк - Используй Силу, Люк!'
		}, 
  glmuschep: {
			name: 'Черепа и Кости',
			icon: imP11 + 'glck.gif', highlight:1,
			w:95, h:50, src: imP21 + '1/mus_chep.png',
			descr: 'Можно найти старые вещи. Может быть ловушка. '
		}, 
  glmusweap: {
			name: 'Груда Старого Оружия',
			icon: imP11 + 'glmusweap.gif',   highlight:1,
			w:95, h:50, src: imP21 + '1/mus_weap.png',
			descr: 'Можно найти старые вещи. Может быть ловушка.'
		},  
  glmusr: {
			name: 'Мусорка',
			icon: imP11 + 'glmusr.gif',
			w:80, h:30,  src: imP21 + '1/musr.png',
			descr: 'Мусор! Ура! То, что нужно! '
		},
  gltresh1: {
			name: 'Трещина',
			icon: imP11 + 'gltresh1.gif',
			w:80, h:30, src: imP21 + '1/tresh1.png',
			descr: 'Если бы я был червяком, я бы смог залезть туда!'
		}, 
  gldur: {
			name: 'Дыра',
			icon: imP11 + 'gldur.gif',
			w:70, h:25, src: imP21 + '1/dur.png',
			descr: 'Это точно дыра. Самая настоящая черная, страшная, бездонная дыра.'
		},
  glaltar: {
			name: 'Техноалтарь',
			icon: imP11 + 'glaltar.gif',
			src: imP21 + '1/item_gl_altar.png',
			descr: 'Странное техническое устройство, производит големов из металлолома.'
		}, 
  glheart: {
			name: 'Сердце Горы',
			icon: imP11 + 'glheart.gif',
			src: imP21 + '1/item_gl_heart.png',
			descr: 'Смазав можно получить: <BR /><img src="'+imP41+'gl_npc_heart_buff.gif" /> <b>Воздействие Сердца Горы</b> эффект - Скорость перемещения значительно увеличена, на 2 часа. <br>Квест на Смазку берётся у Гаечного Ключа. <br>Можно выполнить несколько раз.'
		}, 
  gllab: {
			name: 'Лаборатория механиков',
			icon: imP11 + 'gllab.gif',
			src: imP21 + '1/item_gl_laboratory.png',
			descr: 'С небольшой вероятностью можно очистить один предмет: оружие, щит, посох. <br>Становится доступной после выполнения квеста на голову Жучьей Матки. <br>Квест берётся у Гаечного Ключа. '
		}, 
  glgirlbody: {
			name: 'Женское тело',
			icon: imP11 + 'glgirlbody.gif',
			w:80, h:30, src: imP21 + '1/item_gl_girlbody.png',
			descr: 'Тело Кейси. Необходимо для выполнения квеста Задорного Скелета или Одиокого Призрака. '
		},
		gldanger: {
			name: 'Невидимая ловушка', icon: imP11 + 'danger.gif', highlight:1,
			src: imP11 + 'danger_big.gif',
			descr: 'Невидимая ловушка. Наступив на эту клетку вы потеряете от 20НР до 300НР'
		}, 
		gldanger2: {
			name: 'Невидимая ловушка', icon: imP11 + 'danger.gif', highlight:1,
			src: imP11 + 'danger_big.gif',
			descr: 'Невидимая ловушка, наступив на эту клетку, можно получить болезнь: <BR /><img src="'+imP41+'gl_debuff_inst.gif" /><b>"Снижение Концентрации"</b> - Интуиция: -15 на 20 минут.<BR /><img src="'+imP41+'gl_debuff_str.gif" /><b>"Снижение Силы"</b> - Сила -15 на 20 минут.<BR /><img src="'+imP41+'gl_debuff_agil.gif" /><b>"Снижение стремительности"</b> - Ловкость: -15 на 20 минут.<BR /><img src="'+imP41+'gl_debuff_rzha.gif" /><b>"Ржавчина на доспехах"</b> - Защита от урона -50 на 20 минут.<BR /><img src="'+imP41+'gl_debuff_paralize.gif" /><b>"Паралич конечностей"</b> - Вы парализованы ужасом и не можете двигатся… Вам нужно некоторое время, чтобы успокоится и прийти в себя. На 5 минут.'
		},
		glreshsark: {
			name: 'Решетка + Саркофаг', icon: imP11 + 'coff.gif', 
			src: imP11 + 'coff.png',
			descr: 'За решеткой находится чей-то Саркофаг...'
		},

//2й
		gldown: {
name: 'Лестница на нижнее уровни',icon: imP11 + 'lesd.gif ', src: imP21 + 'les2down.png',
descr: 'Спуск на второй этаж, в клетку <strong>E1</strong> двухсторонний.'
		},
		glup: {
name: 'Лестница',icon: imP11 + 'lesup.gif', w:40, h:60, src: imP21 + 'les2up.png',
descr: 'Подъем на первый этаж, в клетку <strong>В12</strong> двухсторонний.'
		},
		gldown3: {
name: 'Спуск в Глубокие тоннели',icon: imP11 + 'lesd.gif ', src: imP21 + 'les2down.png',
descr: 'Спуск на третий этаж, в клетку <strong>А8</strong>, двухсторонний проход.'
		},
		glup3: {
name: 'Лестница на верхние уровни',icon: imP11 + 'lesup.gif', w:40, h:60, src: imP21 + 'les2up.png',
descr: 'Подъем на второй этаж, в клетку <strong>L13</strong>, двухсторонний проход.'
		},
		gldown4: {
name: 'Спуск в Глубокие тоннели',icon: imP11 + 'lesd.gif ', src: imP21 + 'les2down.png',
descr: 'Спуск на третий этаж, в клетку <strong>А3</strong>, двухсторонний проход.'
		},
		glup4: {
name: 'Лестница на верхние уровни',icon: imP11 + 'lesup.gif', w:40, h:60, src: imP21 + 'les2up.png',
descr: 'Подъем на второй этаж, в клетку <strong>L7</strong>, двухсторонний проход.'
		},
  gldur1: {
			name: 'Тайный проход',
			icon: imP11 + 'gldur.gif',
			w:70, h:25, src: imP21 + '1/dur.png',
			descr: 'Провалившись попадете в клетку <b>V11</b> на 2м этаже.'
		},

 gldoor2: {
			name: 'Решетка - дверь',
			icon: imP11 + 'gldoor.gif',
			src: imP21 + '1/door.png',
			descr: ''
		},
 gldoor3: {
			name: 'Решетка - дверь',
			icon: imP11 + 'gldoor.gif',
			src: imP21 + '1/door.png',
			descr: ''
		},
 gldoor4: {
			name: 'Решетка - дверь',
			icon: imP11 + 'gldoor.gif',
			src: imP21 + '1/door.png',
			descr: ''
		},
 gldoor5: {
			name: 'Решетка - дверь',
			icon: imP11 + 'gldoor.gif',
			src: imP21 + '1/door.png',
			descr: ''
		},
 gldoor6: {
			name: 'Решетка - дверь',
			icon: imP11 + 'gldoor.gif',
			src: imP21 + '1/door.png',
			descr: ''
		},
 gldoor7: {
			name: 'Решетка - дверь',
			icon: imP11 + 'gldoor.gif',
			src: imP21 + '1/door.png',
			descr: ''
		},

		glsar2: {
name: 'Деревянный друг',icon: imP11 + 'sar2.gif',src: imP21 + '2/sar2.png',
descr: 'Вы что, действительно решили покопаться там?'
		},
  glmesh: {
  name: 'Пыльный мешок',icon: imP11 + 'mesh.gif', w:80, h:40, src: imP21 + '1/gl_meshok.png',
  descr: 'На нем спят мародеры.'
  },
  glmesh1: {
  name: 'Дырявый мешок',icon: imP11 + 'mesh.gif', w:80, h:40, src: imP21 + '1/gl_meshok.png',
  descr: ''
  },
  glsokr: {
  name: 'Украденные сокровища',icon: imP11 + 'sokr.gif',src: imP11 + 'sokr_big.gif',
  descr: 'Можно взять Украденные сокровища, при выходе пропадают'
  },
  glsun: {
			name: 'Украденный сундук',
			icon: imP11 + 'glsun.gif',
			w:60, h:40, src: imP21 + '1/gl_sunduk_1.png',
			descr: 'Можно найти Часть глубинного зомби.'
		}, 
  glsun1: {
			name: 'Невостребованный сундук',
			icon: imP11 + 'glsun.gif',
			w:60, h:40, src: imP21 + '1/gl_sunduk_1.png',
			descr: 'Можно найти Часть глубинного зомби.'
		},
  glsun2: {
			name: 'Сундук дозорного',
			icon: imP11 + 'glsun.gif',
			w:60, h:40, src: imP21 + '1/gl_sunduk_1.png',
			descr: 'Можно найти Золотой прун.'
		},
  glsun3: {
			name: 'Потерянный сундук',
			icon: imP11 + 'glsun.gif',
			w:60, h:40, src: imP21 + '1/gl_sunduk_1.png',
			descr: 'Можно найти Сочный оковалок.'
		},
  glsun4: {
			name: 'Сундук начальника стражи',
			icon: imP11 + 'glsun.gif',
			w:60, h:40, src: imP21 + '1/gl_sunduk_1.png',
			descr: 'Можно найти '
		},
  glsun5: {
			name: 'Сундук Лейтенанта',
			icon: imP11 + 'glsun.gif',
			w:60, h:40, src: imP21 + '1/gl_sunduk_1.png',
			descr: 'Можно найти Золотой прун или плащ Лейтенанта.'
		},
  glsun6: {
			name: 'Сундук Оступников',
			icon: imP11 + 'glsun.gif',
			w:60, h:40, src: imP21 + '1/gl_sunduk_1.png',
			descr: 'Можно найти Часть глубинного зомби, Сочный оковалок.'
		},
  glsun7: {
			name: 'Сундук Эми Тейли',
			icon: imP11 + 'glsun.gif',
			w:60, h:40, src: imP21 + '1/gl_sunduk_1.png',
			descr: 'Можно найти свиток (лечение тяж травм).'
		},
  glsun8: {
			name: 'Собачий Сундук',
			icon: imP11 + 'glsun.gif',
			w:60, h:40, src: imP21 + '1/gl_sunduk_1.png',
			descr: 'Можно найти пропуск забытых, мясную радость.'
		},
  glsun9: {
			name: 'Походный сундук Эмиссара',
			icon: imP11 + 'glsun.gif',
			w:60, h:40, src: imP21 + '1/gl_sunduk_1.png',
			descr: 'Можно найти ...'
		},
  glsun10: {
			name: 'Тайник в поселении',
			icon: imP11 + 'glsun.gif',
			w:60, h:40, src: imP21 + '1/gl_sunduk_1.png',
			descr: 'Можно найти изношенные вещи, Часть глубинного зомби, Сочный оковалок.'
		},
  glshkaf: {
			name: 'Старый шкаф',
			icon: imP11 + 'shkaf.gif',
			w:40, h:60, src: imP21 + '1/gl_shkaf.png',
			descr: 'Мародеры хранят здесь свои старые одежды.'
		},
shahtashkaf: {
			name: 'Гоблинский тайник',
			icon: imP11 + 'shkaf.gif',
			w:40, h:60, src: imP21 + '1/gl_shkaf.png',
			descr: 'Гоблины хранят здесь свои елексиры.'
		},
shahtashkaf2: {
			name: 'Гоблинский тайник',
			icon: imP11 + 'haosshkaf.png',
			w:40, h:60, src: imP21 + 'haosshkaf.png',
			descr: 'Гоблины хранят здесь свои елексиры.'
		},		
		
		
  glshkaf2: {
			name: 'Старый шкаф',
			icon: imP11 + 'shkaf.gif',
			w:40, h:60, src: imP21 + '1/gl_shkaf.png',
			descr: 'Внутри что-то скребется..'
		},
  glban: {
			name: 'Символ мародеров',
			icon: imP11 + 'glban.gif',
			src: imP21 + '1/gl_banner.png',
			descr: ''
		},

		gldoor21: {
name: 'Заросший проход',icon: imP11 + 'ggdoor2.gif', w:50, h:60,  src: imP21 + 'ggdoor2.png',
descr: 'Ведет в логово Гусинец. Двухсторонний проход.'
		} 



 	};


//
