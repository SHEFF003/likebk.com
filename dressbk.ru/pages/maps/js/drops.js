
var maters = {
gg_token:{name: 'Грибочки',src: imP3 + 'gg_token.gif',recipes:  null,
 			descr: 'Масса: 0.1<BR />Долговечность: 0/1<BR /><b>Описание:</b><BR />Очень аппетитный деликатес...<BR />Сделано в Suncity<BR />  Насобирав их в достаточном количестве, можно обменять их у "Грибоеда" на нужные вещи.'
		},
gg_small_token:{name: 'Маленькие Грибочки',src: imP3 + 'gg_small_token.gif',recipes:  null,
 			descr: 'Масса: 0.1<BR />Долговечность: 0/1<BR />Сделано в Suncity<BR />Если у вас нет репутации в городе Sun City, то для того, что бы вам стали доступны задания, необходимо поговорить с "Мудрый Гусениц" и принести ему 10 "Маленьких Грибочков".'
		},


		mater1:{
				name: 'Шкура пещерного оленя',  cena: 0.1,
				src: imP3 + 'mater1.gif',
				recipes: null
		},
		mater2:{
				name: 'Золото',  cena: 0.1,
				src: imP3 + 'mater2.gif',
				recipes: null
		},
		mater3:{
				name: 'Серебро',  cena: 0.1,
				src: imP3 + 'mater3.gif',
    descr: '&nbsp;&nbsp;&nbsp;Можно найти в тележке на <strong>F8</strong> на 2м этаже "Бездны".',
    recipes: null
		},
		mater4:{
				name: 'Лучистое серебро',  cena: 0.1,
				src: imP3 + 'mater4.gif',
    descr: '&nbsp;&nbsp;&nbsp;Можно найти в тележке на <strong>F8</strong> на 2м этаже "Бездны".',
				recipes: {'spell_curseb': 1}
		},
		mater5:{
				name: 'Мифрил',  cena: 0.1,
				src: imP3 + 'mater5.gif',
    descr: '&nbsp;&nbsp;&nbsp;Можно найти в Выбоинах на 2м этаже "Бездны".',
				recipes: null
		},
		mater6:{
				name: 'Железное дерево',  cena: 0.1,
				src: imP3 + 'mater6.gif',
				recipes: null
		},
		mater7:{
				name: 'Слиток пустынной руды',  cena: 0.1,
				src: imP3 + 'mater7.gif',
				recipes: {'sp_tacpts_HIT1': 3}
		},
		mater8:{
				name: 'Троекорень',  cena: 0.1,
				src: imP3 + 'mater8.gif',
				recipes: {'sp_tacpts_PRY1': 3}
		},
		mater9:{
				name: 'Корень змеиного дерева',  cena: 0.1,
				src: imP3 + 'mater9.gif',
				recipes: {'sp_tacpts_KRT1': 3}
		},/*
		mater10:{
				name: 'Кора змеиного дерева',  cena: 0.1,
				src: imP3 + 'mater10.gif',
				recipes: {'spell_ug_undam2c': 1,'sp_tacpts_CNTR1': 3}
		},
		mater11:{
				name: 'Кожа общего врага',  cena: 0.1,
				src: imP3 + 'mater11.gif',
				recipes: {'spell_ug_undam1c': 1,'spell_ug_undam1c': 1,'sp_tacpts_BLK1': 3}
		},
		mater12:{
				name: 'Сталь',  cena: 0.1,
				src: imP3 + 'mater12.gif',
    descr: '&nbsp;&nbsp;&nbsp;Можно найти в Выбоинах на 2м этаже "Бездны".',
				recipes: {'spell_ug_undam3c': 1,'spell_curse': 1}
		},
		mater13:{
				name: 'Кристалл тысячи ответов',  cena: 0.3,
				src: imP3 + 'mater13.gif',
				recipes: null
		},
		mater14:{
				name: 'Сгусток эфира',  cena: 0.3,
				src: imP3 + 'mater14.gif',
    descr: '&nbsp;&nbsp;&nbsp;Часто падает с Духов и Душ в Лабиринте "ПТП"',
				recipes: {'spell_ug_undam1c': 1,'spell_curseb': 3}
		},
		mater15:{
				name: 'Сгусток астрала',  cena: 0.3,
				src: imP3 + 'mater15.gif',
    descr: '&nbsp;&nbsp;&nbsp;Часто падает с Духов и Душ в Лабиринте "ПТП"',
				recipes: {'spell_ug_undam3c': 1,'sp_tacpts_PRY2': 2}
		},
		mater16:{
				name: 'Глубинный камень',  cena: 0.3,
				src: imP3 + 'mater16.gif',
    descr: '&nbsp;&nbsp;&nbsp;Часто лежит в сундуке на <strong>D9</strong> на 3м этаже "Бездны".',
				recipes: {'spell_ug_undam2c': 1,'spell_curse': 1,'sp_tacpts_KRT2': 2}
		},
		mater17:{
				name: 'Плод змеиного дерева',  cena: 0.3,
				src: imP3 + 'mater17.gif',
				recipes: {'spell_ug_undam1c': 1,'spell_ug_undam3c': 1,'spell_curse': 1,'sp_tacpts_CNTR2': 2}
		},
		mater18:{
				name: 'Тысячелетний камень',  cena: 0.3,
				src: imP3 + 'mater18.gif',
				recipes: {'spell_ug_undam1c': 1,'spell_ug_undam2c': 1,'spell_ug_undam3c': 1,'spell_curse': 1,'sp_tacpts_HIT2': 2}
		},
		mater19:{
				name: 'Кристалл времен',  cena: 0.3,
				src: imP3 + 'mater19.gif',
				recipes: {'spell_ug_undam2c': 1,'sp_tacpts_BLK2': 2}
		},
		mater25:{
				name: 'Кристалл голоса предков',  cena: 1,
				src: imP3 + 'mater25.gif',
    descr: '&nbsp;&nbsp;&nbsp;Часто лежит в сундуке на <strong>С6</strong> на 1м этаже "Пещеры Мглы", часто падает после убийства "Стража Крантона".',
				recipes: {'spell_ug_undam4c': 1,'spell_curseb': 1}
		},                                                                                                                                               
		mater26:{                                                                                                                                        
				name: 'Кристалл стабильности',  cena: 1,
				src: imP3 + 'mater26.gif',
    descr: '&nbsp;&nbsp;&nbsp;Часто лежит в сундуке на <strong>К4</strong> на 2м этаже "Пещеры Мглы".',
				recipes: {'pot_base_50_waterproof': 1,'spell_ug_undam4c': 1,'spell_ug_unp10c': 1,'spell_ug_unexprc': 1,'sp_tacpts_PRY3': 2,'booklearn_slot9': 3,'booklearn_spell7': 3}
		},                                                                                                                                               
		mater27:{                                                                                                                                        
				name: 'Камень затаенного солнца',  cena: 1,
				src: imP3 + 'mater27.gif',
    descr: '&nbsp;&nbsp;&nbsp;Часто лежит в сундуке на <strong>I8</strong> на 2м этаже "Пещеры Мглы".',
				recipes: {'spell_ug_undam2c': 1,'spell_curseb': 1,'sp_tacpts_KRT3': 2,'booklearn_slot9': 3,'booklearn_spell5': 3}
		},                                                                                                                                               
		mater28:{                                                                                                                                        
				name: 'Лучистый рубин',  cena: 1,
				src: imP3 + 'mater28.gif',
				recipes: {'spell_ug_unp10c': 1,'spell_ug_unexprc': 1,'spell_curse': 1,'sp_tacpts_CNTR3': 2,'booklearn_slot9': 3,'booklearn_8': 3}
		},                                                                                                                                               
		mater29:{                                                                                                                                        
				name: 'Лучистый топаз',  cena: 1,
				src: imP3 + 'mater29.gif',
    descr: '&nbsp;&nbsp;&nbsp;Можно найти в сундуке на <strong>С8</strong> на 1м этаже "Бездны".',
				recipes: {'spell_ug_undam1c': 1,'spell_curse': 1,'sp_tacpts_BLK3': 2,'booklearn_slot9': 3}
		},                                                                                                                                               
		mater30:{                                                                                                                                        
				name: 'Шепот гор',  cena: 1,
				src: imP3 + 'mater30.gif',
    descr: '&nbsp;&nbsp;&nbsp;Часто лежит в сундуке на <strong>В11</strong> на 2м этаже "ПТП".',
				recipes: {'spell_ug_undam3c': 1,'spell_curseb': 1,'sp_tacpts_HIT3': 2,'booklearn_slot9': 3,'booklearn_10': 3}
		},                                                                                                                                               
		mater20:{
				name: 'Эссенция лунного света',  cena: 3,
				src: imP3 + 'mater20.gif',
				recipes: {'sp_tacpts_CNTR4': 1,'sp_tacpts_CNTR5': 1,'enh_5_3': 1,'booklearn_slot10': 5}
		},
		mater21:{
				name: 'Эссенция глубины',  cena: 3,
				src: imP3 + 'mater21.gif',
				recipes: {'sp_tacpts_BLK4': 1,'sp_tacpts_BLK5': 1,'enh_4_3': 1,'booklearn_slot10': 5,'booklearn_6': 1,'booklearn_spell4': 1}
		},
		mater22:{
				name: 'Эссенция чистоты',  cena: 3,
				src: imP3 + 'mater22.gif',
				recipes: {'sp_tacpts_HIT4': 1,'sp_tacpts_HIT5': 1,'enh_3_3': 1,'booklearn_slot10': 5,'booklearn_9': 1,'booklearn_spell2': 1}
		},
 		 mater31:{
				name: 'Эссенция праведного гнева',  cena: 3,
				src: imP3 + 'mater31.gif',
				recipes: {'spell_curseb': 1,'sp_tacpts_KRT4': 1,'sp_tacpts_KRT5': 1,'enh_9_3': 1,'booklearn_slot10': 5,'booklearn_7': 1}
		},
		mater23:{
				name: 'Ралиэль',
				src: imP3 + 'mater23.gif',  cena: 3,
				recipes: {'sp_tacpts_BLK5': 1,'sp_tacpts_HIT5': 1,'sp_tacpts_KRT5': 1,'sp_tacpts_CNTR5': 1,'sp_tacpts_PRY5': 1,'booklearn_slot10': 5,'booklearn_spell1': 1}
		},
		mater24:{
				name: 'Стихиалия',
				src: imP3 + 'mater24.gif',  cena: 3,
				recipes: {'spell_ug_unp10c': 1,'spell_ug_unexprc': 1,'spell_curseb': 1,'sp_tacpts_PRY4': 1,'sp_tacpts_PRY5': 1,'enh_1_3': 1,'booklearn_slot10': 5,'booklearn_spell3': 1}
		},

		mater_shop7:{
				name: 'Сущность ресурса',
				src: imP3 + 'mater_shop7.gif',
				recipes:  null
		},



		mater267:{
				name: 'Расскаленная магма',  
				src: imP3 + 'mater267.gif',
				recipes:  null,
    descr: 'Можно купить в рыцарском магазине "Катакомб".'
 		},
		mater261:{
				name: 'Слиток света',  
				src: imP3 + 'mater261.gif',
				recipes:  null,
    descr: 'Можно купить в рыцарском магазине "Бездны".'
 		},
  mater262:{
				name: 'Осколок бездны',  
				src: imP3 + 'mater262.gif',
				recipes:  null,
    descr: 'Можно купить в рыцарском магазине "Бездны".'
 		},
  		mater275:{
				name: 'Песок просвета',  
				src: imP3 + 'mater275.gif',
				recipes:  null,
    descr: 'Можно купить в рыцарском магазине "Пещеры Мглы".'
 		},
		mater276:{
				name: 'Песчаная руда',  
				src: imP3 + 'mater276.gif',
				recipes:  null,
    descr: 'Можно купить в рыцарском магазине "Пещеры Мглы".'
 		},
		mater_izumrud:{
				name: 'Мутный изумруд',
				src: imP3 + 'mater_izumrud.gif',
				recipes: null,
    descr: 'Масса: 1<br />Долговечность: 0/1<br />Максимум: 1 ед.<br />Сделано в Emeralds city<br /><font color=brown>Предмет не подлежит ремонту</font><br />  <b>Курс обмена у Бугага:</b><br />1 изумруд = Эликсир Забытых Мастеров (35 минут)<br />1 изумруд = 10 кровавых рубинов<br />1 изумруд = 5 сущностей ресурса<br />1 изумруд = Инсигния Знаний<br />Камни падают на всех этажах. Шанс дропа растет с уровнем сложности этажа.'
 		},
		runetoken:{
				name: 'Инсигния Знаний ',
				src: imP3 + 'runetoken.gif',
				recipes: null,
    descr: 'Масса: 1<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Может быть использовано на Алтаре Храма Знаний <br />(получите в награду 10 ед. репутации Храма Знаний)<br />Сделано в Emeralds city<br /><font color=brown>Предмет не подлежит ремонту</font>'
 		},
//девел
		mater292:{
				name: 'Кристальный песок',
				src: imP3 + 'mater292.gif',
				recipes:  null,
    descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br />Можно найти в "Заросший пруд", "Берег озера", может упасть с "Болотный Тролль".'
 		},
		mater293:{
				name: 'Мерцающий кристалл',
				src: imP3 + 'mater293.gif',
				recipes:  null,
    descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br />Можно найти в "Заросший пруд", "Берег озера", может упасть с "Болотный Тролль".'
 		},
		mater294:{
				name: 'Слезы лунного мерцания',
				src: imP3 + 'mater294.gif',
				recipes:  null,
    descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br />Можно найти в "Заросший пруд", "Костер", "Берег озера".'
 		},
		mater295:{
				name: 'Чешуйчатая шкура',
				src: imP3 + 'mater295.gif',
				recipes:  null,
    descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br />Можно выбить с "Голодный Кровосос" "Проклятье Болот".'
 		},
		mater296:{
				name: 'Самородок мерцающего металла',
				src: imP3 + 'mater296.gif',
				recipes:  null,
    descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br />Можно найти в "Древняя глыба" или "Огромный валун".'
 		},
		mater297:{
				name: 'Изменчивые водоросли',
				src: imP3 + 'mater297.gif',
				recipes:  null,
    descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br />Можно найти в "Берег озера", "Заросший пруд", может упасть с "Болотный Тролль".'
 		},
		mater298:{
				name: 'Древний мох',
				src: imP3 + 'mater298.gif',
				recipes:  null,
    descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br />Можно найти в "Древний пень", "Трухлявый пень" и "Корявый пень".'
 		},
		mater299:{
				name: 'Черное масло',
				src: imP3 + 'mater299.gif',
				recipes:  null,
    descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br />Можно найти в "Костер", "Смердящая яма", "Берег озера", "Глубокая трещина" или выбить с "Мародер Патрульный" и "Мародер Разведчик".'
 		},
		mater300:{
				name: 'Бурая шкура',
				src: imP3 + 'mater300.gif',
				recipes:  null,
    descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br />Можно найти в "Костер" или выбить с "Мародер Патрульный" и "Мародер Разведчик".'
 		},
		mater301:{
				name: 'Кость болотного тролля',
				src: imP3 + 'mater301.gif',
				recipes:  null,
    descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br />Можно выбить с "Болотный Тролль".'
 		},

//абба
  mater_suv_drop:{
				name: 'Образец',
				src: imP3 + 'mater_suv_drop.gif',
				recipes: null,
				descr: 'Масса: 0.1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><BR>Долговечность: 0/1'
		},
  mater_suv_rew:{
				name: 'Идеальные Образцы',
				src: imP3 + 'mater_suv_rew.gif',
				recipes: null,
				descr: 'Масса: 1  <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/> <BR>Требуется предмет: <B> [Образец]x100 </B> <BR>Долговечность: 0/1'
		},
  shiph_token:{
				name: 'Крыло Шипокрыла Хаоса',
				src: imP3 + 'shiph_token.gif',
				recipes: null,
				descr: 'С низкой вероятностью падает с <B>Шипокрыла Хаоса</B>, <br />за него <B>Шейла</B> даст вам свиток <B>Зачаровать броню: Адаптация</B>.'
		},
  lik_token:{
				name: 'Череп Лика Хаоса',
				src: imP3 + 'lik_token.gif',
				recipes: null,
				descr: 'С низкой вероятностью падает с <B>Лика Хаоса</B>, <br />за него <B>Шейла</B> даст вам свиток <B>Зачаровать шлем: Адаптация</B>.'
		},
  ship_token:{
				name: 'Хвост Шипокрыла',
				src: imP3 + 'ship_token.gif',
				recipes: null,
				descr: 'С низкой вероятностью падает с <B>Шипокрыла</B>, <br />за него <B>Шейла</B> даст вам свиток <B>Зачаровать сапоги: Адаптация</B>.'
		},
  valent_token:{
				name: 'Перья Валентайского Охотника',
				src: imP3 + 'valent_token.gif',
				recipes: null,
				descr: 'С низкой вероятностью падает с <B>Валентайского Охотника</B>, <br />за него <B>Шейла</B> даст вам свиток <B>Зачаровать амулет: Адаптация</B>.'
		},
  fanatik_token:{
				name: 'Пепел Фанатика Хаоса',
				src: imP3 + 'fanatik_token.gif',
				recipes: null,
				descr: 'С низкой вероятностью падает с <B>Фанатика Хаоса</B>, <br />за него <B>Шейла</B> даст вам свиток <B>Зачаровать поножи: Адаптация</B>.'
		},
*/
	 gg3_hishn_kolch:{
				name: 'Кусок старой ржавой кольчуги',
				src: imP3 + 'gg3_hishn_kolch.gif', recipes: null,
				descr: 'Масса: 0.1 <img src="'+d4+'" alt="'+d5+'"/><br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Ржавая сталь, деформировавшиеся звенья. Кто может позариться на такое "добро"?<br />Меняется у "Шизожука" на сувениры.<br /> - Падает с ботов 3го этажа Грибницы, но можно выловить и в "Воронке".'
		},
	 gg3_hishn_dosp:{
				name: 'Обломок доспеха',
				src: imP3 + 'gg3_hishn_dosp.gif',	recipes: null,
				descr: 'Масса: 0.1 <img src="'+d4+'" alt="'+d5+'"/><br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Часть доспеха невразумительной формы. Даже при долгом исследовании нельзя сказать, что это был за доспех.<br />Меняется у "Шизожука" на сувениры.<br /> - Падает с ботов 3го этажа Грибницы, но можно выловить и в "Воронке".'
		},
	 gg3_hishn_sword:{
				name: 'Обломок меча',
				src: imP3 + 'gg3_hishn_sword.gif',  recipes: null,
				descr: 'Масса: 0.1 <img src="'+d4+'" alt="'+d5+'"/><br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Кусок меча с рукоятью. Ржавый до ужаса, просто крошится в руках.<br />Меняется у "Шизожука" на сувениры.<br /> - Падает с ботов 3го этажа Грибницы, но можно выловить и в "Воронке".'
		},
	 gg3_hishn_finger:{
				name: 'Палец латной перчатки',
				src: imP3 + 'gg3_hishn_finger.gif', recipes: null,
				descr: 'Масса: 0.1 <img src="'+d4+'" alt="'+d5+'"/><br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Палец от перчатки. Ржавый, хрупкий, условно металлический. Больше ничего необычного.<br />Меняется у "Шизожука" на сувениры.<br /> - Падает с ботов 3го этажа Грибницы, но можно выловить и в "Воронке".'
		} 

};
/*
// элики
var pots ={


		};



	var scrolls = {
		dispell2:{
				name: 'Снять Проклятие',
				src: imP3 + 'dispell1.gif',
				descr: 'Масса: 1<br />Цена: 10 кр. <br />Долговечность: 0/5<br />Вероятность срабатывания: 99%<br />Задержка использования: 5 мин.<br /><strong>"Перебежчик Брут"</strong> на входе в <strong>Туманные Низины</strong> предложит вам обменять <strong>"Древний мох"х5</strong> и <strong>"Слезы лунного мерцания"х1</strong> на этот свиток.',
				recipes: null
		},
		spell_curse:{
				name: 'Черная Метка',
				src: imP3 + 'spell_curse.gif',
				descr: 'Наложены заклятия: проклятье. Продолжительность действия магии: 1440 мин. Вероятность срабатывания: 70 %.<br />Можно собрать в Мастерской Забытых Мастеров на третьем этаже <strong>Пещеры Тысячи Проклятий</strong> в Capital City',
				recipes: {'mater12': 1,'mater16': 1,'mater17': 1,'mater18': 1,'mater28': 1,'mater29': 1}
		},
		spell_curseb:{
				name: 'Красная Метка',
				src: imP3 + 'spell_curseb.gif',
				descr: 'Наложены заклятия: проклятье. Продолжительность действия магии: 1440 мин.<br />Можно собрать в Мастерской Забытых Мастеров на третьем этаже <strong>Пещеры Тысячи Проклятий</strong> в Capital City',
				recipes: {'mater4': 1, 'mater14': 3, 'mater25': 1, 'mater27': 1, 'mater30': 1, 'mater31': 1, 'mater24': 1}
		},
		'd_blat-6':{
				name: 'Пропуск Забытых',
				src: imP3 + 'd_blat-6.gif',
				descr: 'Позволяет пройти в подземелье на 6 часов раньше. Вероятность срабатывания: 99 %.<br />Может быть в сундуке, выпасть из Маула в <strong>Пещере Тысячи Проклятий</strong> в Capital City или в кроватях третьего этажа в <strong>Бездне</strong> Angels City',
				recipes: null
		},
 
		dispell1:{
				name: 'Снять Проклятие',
				src: imP3 + 'dispell1.gif',
				descr: 'Вероятность срабатывания: 99 %<br />Может быть в сундуке на втором этаже <strong>Пещеры Тысячи Проклятий</strong> в Capital City',
				recipes: null
		},
		cureHP60:{
				name: 'Восстановление энергии 60HP',
				src: imP3 + 'cureHP60.gif',
				descr: 'Масса: 1 <br />Цена: 4 кр. <br />Долговечность: 0/1 <br />Вероятность срабатывания: 70% <br />Требуется минимальное: <br />• Интеллект: 8 <br />• Уровень: 4 <br />Наложены заклятия: исцеление<br />Можно найти в <strong>Катакомбах</strong> в Demons City',
				recipes: null
		} 
 
	};
		


var charki ={
		enhp_6_revamp10:{
				name: 'Зачаровать кольцо: Вытягивание души [1]',
				src: imP3 + 'enhp_6_revamp10.gif',
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 1 кр. <br />Долговечность: 0/1 <br /><strong style="color:#880000">Наложены заклятия:</strong> <strong>Вытягивание души</strong> <br />"При получении повреждения забирает у атакующего 10HP.<br />Шанс срабатывания: 2.5% при получении удара" <br />Описание: <br />У зачарованного этим свитком кольца появляется шанс забрать у атакующего 10 единиц здоровья при получении повреждения.<br />Можно собрать в Мастерской Забытых Мастеров на третьем этаже <strong>Пещеры Тысячи Проклятий</strong> в Capital City<br />Рецепт:<br /><strong style="color:#006600">Кристалл тысячи ответов</strong> - 1 шт. <strong style="color:#006600">Сгусток эфира</strong> - 1 шт.<strong style="color:#006600">Сгусток астрала</strong> - 1 шт.',
				recipes: null
		},
		enhp_6_revamp10_2:{
				name: 'Зачаровать кольцо: Вытягивание души [2]',
				src: imP3 + 'enhp_6_revamp10_2.gif',
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 1 кр. <br />Долговечность: 0/1 <br /><strong style="color:#880000">Наложены заклятия:</strong> <strong>Вытягивание души</strong> <br />"При получении повреждения забирает у атакующего 10HP.<br />Шанс срабатывания: 5% при получении удара" <br />Описание: <br />У зачарованного этим свитком кольца появляется шанс забрать у атакующего 10 единиц здоровья при получении повреждения.<br />Можно собрать в Мастерской Забытых Мастеров на третьем этаже <strong>Пещеры Тысячи Проклятий</strong> в Capital City<br />Рецепт:<br /><strong style="color:#006600">Зачаровать кольцо: Вытягивание души [1]</strong> - 1 шт.  ',
				recipes: null
		},

		enh_1_0:{
				name: 'Зачаровать Украшение [0]',
				src: imP3 + 'enh_1_0.gif',
				descr: 'Масса: 1 <br />Цена: 5 кр. <br />Долговечность: 0/1 <br />Наложены заклятия: усиление <br />Описание: <br />Три - переход количества в качество. Этот свиток слишком   слаб...<br />Можно найти в <strong>Катакомбах</strong> в Demons City',
				recipes: null
		},
		enh_3_0:{
				name: 'Зачаровать оружие [0]',
				src: imP3 + 'enh_3_0.gif',
				descr: 'Масса: 1 <br />Цена: 5 кр. <br />Долговечность: 0/1 <br />Наложены заклятия: усиление <br />Описание: <br />Три - переход количества в качество. Этот свиток слишком   слаб...<br />Можно найти в <strong>Катакомбах</strong> в Demons City',
				recipes: null
		},
		enh_4_0:{
				name: 'Зачаровать Броню [0]',
				src: imP3 + 'enh_4_0.gif',
				descr: 'Масса: 1 <br />Цена: 5 кр. <br />Долговечность: 0/1 <br />Наложены заклятия: усиление <br />Описание: <br />Три - переход количества в качество. Этот свиток слишком   слаб...<br />Можно найти в <strong>Катакомбах</strong> в Demons City',
				recipes: null
		},
		enh_5_0:{
				name: 'Зачаровать Перчатки [0]',
				src: imP3 + 'enh_5_0.gif',
				descr: 'Масса: 1 <br />Цена: 5 кр. <br />Долговечность: 0/1 <br />Наложены заклятия: усиление <br />Описание: <br />Три - переход количества в качество. Этот свиток слишком   слаб...<br />Можно найти в <strong>Катакомбах</strong> в Demons City',
				recipes: null
		},
		enh_9_0:{
				name: 'Зачаровать Шлем [0]',
				src: imP3 + 'enh_9_0.gif',
				descr: 'Масса: 1 <br />Цена: 5 кр. <br />Долговечность: 0/1 <br />Наложены заклятия: усиление <br />Описание: <br />Три - переход количества в качество. Этот свиток слишком   слаб...<br />Можно найти в <strong>Катакомбах</strong> в Demons City',
				recipes: null
		},
  		enh_1_1:{
				name: 'Зачаровать Украшение [1]',
				src: imP3 + 'enh_1_1.gif',
				descr: 'Масса: 1 <br />Цена: 15 кр. <br />Долговечность: 0/1 <br />Вероятность срабатывания:   99%<br />Наложены заклятия: усиление <br />Описание: <br />Три - переход количества в качество. Работает с для кольцами, ожерельями и серьгами.<br />Можно собрать в <strong>Катакомбах</strong> в Demons City<br />Рецепт:<br /><strong style="color:#006600">Зачаровать Украшение [0]</strong> - 3 шт. <strong style="color:#006600">Пирамидальный ключ</strong> - 1 шт.',
				recipes: null
		},
		enh_3_1:{
				name: 'Зачаровать оружие [1]',
				src: imP3 + 'enh_3_1.gif',
				descr: 'Масса: 1 <br />Цена: 15 кр. <br />Долговечность: 0/1 <br />Вероятность срабатывания:   99%<br />Наложены заклятия: усиление <br />Описание: <br />Три - переход количества в качество. Подходит для всех видов оружия.<br />Можно собрать в <strong>Катакомбах</strong> в Demons City<br />Рецепт:<br /><strong style="color:#006600">Зачаровать Оружие [0]</strong> - 3 шт. <strong style="color:#006600">Пирамидальный ключ</strong> - 1 шт.',
				recipes: null
		},
		enh_4_1:{
				name: 'Зачаровать Броню [1]',
				src: imP3 + 'enh_4_1.gif',
				descr: 'Масса: 1 <br />Цена: 15 кр. <br />Долговечность: 0/1 <br />Вероятность срабатывания:   99%<br />Наложены заклятия: усиление <br />Описание: <br />Три - переход количества в качество. Подходит для всех видов брони и щитов.<br />Можно собрать в <strong>Катакомбах</strong> в Demons City<br />Рецепт:<br /><strong style="color:#006600">Зачаровать Броню [0]</strong> - 3 шт. <strong style="color:#006600">Пирамидальный ключ</strong> - 1 шт.',
				recipes: null
		},
		enh_5_1:{
				name: 'Зачаровать Перчатки [1]',
				src: imP3 + 'enh_5_1.gif',
				descr: 'Масса: 1 <br />Цена: 15 кр. <br />Долговечность: 0/1 <br />Вероятность срабатывания:   99%<br />Наложены заклятия: усиление <br />Описание: <br />Три - переход количества в качество. Подходит для перчаток, наручей и поясов.<br />Можно собрать в <strong>Катакомбах</strong> в Demons City<br />Рецепт:<br /><strong style="color:#006600">Зачаровать Перчатки [0]</strong> - 3 шт. <strong style="color:#006600">Пирамидальный ключ</strong> - 1 шт.',
				recipes: null
		},
		enh_9_1:{
				name: 'Зачаровать Шлем [1]',
				src: imP3 + 'enh_9_1.gif',
				descr: 'Масса: 1 <br />Цена: 15 кр. <br />Долговечность: 0/1 <br />Вероятность срабатывания:   99%<br />Наложены заклятия: усиление <br />Описание: <br />Три - переход количества в качество. Подходит для шлемов и даже для сапог.<br />Можно собрать в <strong>Катакомбах</strong> в Demons City<br />Рецепт:<br /><strong style="color:#006600">Зачаровать Шлем [0]</strong> - 3 шт. <strong style="color:#006600">Пирамидальный ключ</strong> - 1 шт.',
				recipes: null
		},
		enh_1_2:{
				name: 'Зачаровать Украшение [2]',
				src: imP3 + 'enh_1_2.gif',
				descr: 'Масса: 1 <br />Цена: 50 кр. <br />Долговечность: 0/1 <br />Вероятность срабатывания:   99%<br />Наложены заклятия: усиление <br />Описание: <br />Три - переход количества в качество. Работает с для кольцами, ожерельями и серьгами.<br />Можно собрать в <strong>Катакомбах</strong> в Demons City<br />Рецепт:<br /><strong style="color:#006600">Зачаровать Украшение [1]</strong> - 3 шт. <strong style="color:#006600">Пирамидальный ключ</strong> - 1 шт.',
				recipes: null
		},
		enh_3_2:{
				name: 'Зачаровать оружие [2]',
				src: imP3 + 'enh_3_2.gif',
				descr: 'Масса: 1 <br />Цена: 50 кр. <br />Долговечность: 0/1 <br />Вероятность срабатывания:   99%<br />Наложены заклятия: усиление <br />Описание: <br />Три - переход количества в качество. Подходит для всех видов оружия.<br />Можно собрать в <strong>Катакомбах</strong> в Demons City<br />Рецепт:<br /><strong style="color:#006600">Зачаровать Оружие [1]</strong> - 3 шт. <strong style="color:#006600">Пирамидальный ключ</strong> - 1 шт.',
				recipes: null
		},
		enh_4_2:{
				name: 'Зачаровать Броню [2]',
				src: imP3 + 'enh_4_2.gif',
				descr: 'Масса: 1 <br />Цена: 50 кр. <br />Долговечность: 0/1 <br />Вероятность срабатывания:   99%<br />Наложены заклятия: усиление <br />Описание: <br />Три - переход количества в качество. Подходит для всех видов брони и щитов.<br />Можно собрать в <strong>Катакомбах</strong> в Demons City<br />Рецепт:<br /><strong style="color:#006600">Зачаровать Броню [1]</strong> - 3 шт. <strong style="color:#006600">Пирамидальный ключ</strong> - 1 шт.',
				recipes: null
		},
		enh_5_2:{
				name: 'Зачаровать Перчатки [2]',
				src: imP3 + 'enh_5_2.gif',
				descr: 'Масса: 1 <br />Цена: 50 кр. <br />Долговечность: 0/1 <br />Вероятность срабатывания:   99%<br />Наложены заклятия: усиление <br />Описание: <br />Три - переход количества в качество. Подходит для перчаток, наручей и поясов.<br />Можно собрать в <strong>Катакомбах</strong> в Demons City<br />Рецепт:<br /><strong style="color:#006600">Зачаровать Перчатки [1]</strong> - 3 шт. <strong style="color:#006600">Пирамидальный ключ</strong> - 1 шт.',
				recipes: null
		},
		enh_9_2:{
				name: 'Зачаровать Шлем [2]',
				src: imP3 + 'enh_9_2.gif',
				descr: 'Масса: 1 <br />Цена: 50 кр. <br />Долговечность: 0/1 <br />Вероятность срабатывания:   99%<br />Наложены заклятия: усиление <br />Описание: <br />Три - переход количества в качество. Подходит для шлемов и даже для сапог.<br />Можно собрать в <strong>Катакомбах</strong> в Demons City<br />Рецепт:<br /><strong style="color:#006600">Зачаровать Шлем [1]</strong> - 3 шт. <strong style="color:#006600">Пирамидальный ключ</strong> - 1 шт.',
				recipes: null
		},
		enh_1_3:{
				name: 'Зачаровать Украшение [3]',                                                                                                                                                                                                                                                                                                                                                                                                       
				src: imP3 + 'enh_1_3.gif',
				descr: 'Масса: 1 <br />Цена: 150 кр. <br /><img src="'+imP2+'align50.gif" />Цена: 100 екр. <br />Долговечность: 0/1 <br />Вероятность срабатывания:   99%<br />Наложены заклятия: усиление <br />Описание: <br />Работает с для кольцами, ожерельями и серьгами.<br />Можно собрать в <strong>Катакомбах</strong> в Demons City<br />Рецепт:<br /><strong style="color:#006600">Зачаровать Украшение [2]</strong> - 3 шт. <strong style="color:#006600">Пирамидальный ключ</strong> - 1 шт.<strong style="color:#006600">"Стихиалия"</strong> - 1 шт.',
				recipes: null
		},
		enh_3_3:{
				name: 'Зачаровать оружие [3]',
				src: imP3 + 'enh_3_3.gif',
				descr: 'Масса: 1 <br />Цена: 150 кр. <br /><img src="'+imP2+'align50.gif" />Цена: 100 екр.<br />Долговечность: 0/1 <br />Вероятность срабатывания:   99%<br />Наложены заклятия: усиление <br />Описание: <br />Подходит для всех видов оружия.<br />Можно собрать в <strong>Катакомбах</strong> в Demons City<br />Рецепт:<br /><strong style="color:#006600">Зачаровать Оружие [2]</strong> - 3 шт. <strong style="color:#006600">Пирамидальный ключ</strong> - 1 шт.<strong style="color:#006600">"Эссенция чистоты"</strong> - 1 шт.',
				recipes: null
		},
		enh_4_3:{
				name: 'Зачаровать Броню [3]',
				src: imP3 + 'enh_4_3.gif',
				descr: 'Масса: 1 <br />Цена: 150 кр. <br /><img src="'+imP2+'align50.gif" />Цена: 100 екр.<br />Долговечность: 0/1 <br />Вероятность срабатывания:   99%<br />Наложены заклятия: усиление <br />Описание: <br />Подходит для всех видов брони и щитов.<br />Можно собрать в <strong>Катакомбах</strong> в Demons City<br />Рецепт:<br /><strong style="color:#006600">Зачаровать Броню [2]</strong> - 3 шт. <strong style="color:#006600">Пирамидальный ключ</strong> - 1 шт. <strong style="color:#006600">"Эссенция глубины"</strong> - 1 шт.',
				recipes:  null
		},
		enh_5_3:{
				name: 'Зачаровать Перчатки [3]',
				src: imP3 + 'enh_5_3.gif',
				descr: 'Масса: 1 <br />Цена: 150 кр. <br /><img src="'+imP2+'align50.gif" />Цена: 100 екр.<br />Долговечность: 0/1 <br />Вероятность срабатывания:   99%<br />Наложены заклятия: усиление <br />Описание: <br />Подходит для перчаток, наручей и поясов.<br />Можно собрать в <strong>Катакомбах</strong> в Demons City<br />Рецепт:<br /><strong style="color:#006600">Зачаровать Перчатки [2]</strong> - 3 шт. <strong style="color:#006600">Пирамидальный ключ</strong> - 1 шт.<strong style="color:#006600">"Эссенция лунного света"</strong> - 1 шт.',
				recipes: null
		},
		enh_9_3:{
				name: 'Зачаровать Шлем [3]',
				src: imP3 + 'enh_9_3.gif',
				descr: 'Масса: 1 <br />Цена: 150 кр.<br /><img src="'+imP2+'align50.gif" />Цена: 100 екр. <br />Долговечность: 0/1 <br />Вероятность срабатывания:   99%<br />Наложены заклятия: усиление <br />Описание: <br />Подходит для шлемов и даже для сапог.<br />Можно собрать в <strong>Катакомбах</strong> в Demons City<br />Рецепт:<br /><strong style="color:#006600">Зачаровать Шлем [2]</strong> - 3 шт. <strong style="color:#006600">Пирамидальный ключ</strong> - 1 шт.<strong style="color:#006600">"Эссенция Праведного гнева"</strong> - 1 шт.',
				recipes: null
		},
 
		enhp_5_dampen_all_1:{
				name: 'Зачаровать Пояс Чары Проклятья Древних 1', city: 1,
				src: imP3 + 'enhp_5_dampen_all_1.gif  ',
				descr: 'Цена: 50 кр.  <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Требуется предмет:<strong> <font color=red>Эссенция чистоты, [Золото]x3</font></strong><br />Долговечность: 0/1  <br />Срок годности: 30 дн.<br />Наложены заклятия: Проклятье Древних <br />Описание:<br />Зачарованный этим свитком пояс имеет шанс временно понизить характиристики атаковавшего противника. <br />Отнимает у противника 5 выносливости, 5 интеллекта, 5 ловкости, 5 силы и 5 интуиции на 5 разменов<br />Шанс срабатывания: 5% при получении удара в пояс.',
				recipes: null
		},
		enhp_5_defend_all_1:{
				name: 'Зачаровать Пояс: Чары Воли Глубин 1', city: 2,
				src: imP3 + 'enhp_5_defend_all_1.gif',
				descr: 'Цена: 50 кр.  <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Требуется предмет:<strong> <font color=red>[Стихиалия] X 1, [Золото] X 3</font></strong><br />Долговечность: 0/1  <br />Срок годности: 30 дн.<br />Наложено заклятье: Воля Бездны<br />Описание:<br />Зачарованный этим свитком пояс имеет шанс поглотить 40% нанесенного вам урона. <br />Шанс срабатывания: 5% при получении удара в пояс.'
			},
		enhp_13_pm_revard:{
				name: 'Зачаровать наручи: Здоровье +12', city: 3,
				src: imP3 + 'enhp_13_pm_revard.gif',
				descr: 'Цена: 50 кр.  <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br /><strong>Требуется предмет:</strong> <strong> <font color=red>Эссенция лунного света, [Слиток пустынной руды]x3</font></strong><br />Долговечность: 0/1 <br /><strong>Действует на:</strong><br /> • Уровень жизни (HP): +12 <br />Описание:<br /> При использовании на наручи, увеличивает уровень здоровья на 12  '
			},
  enhp_19_2:{
				name: 'Зачаровать поножи: Выживание F',
				src: imP3 + 'enhp_19_2.gif',
				recipes: null,
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/> <BR>Цена: 1 кр.<BR>Требуется предмет: <strong> [Идеальные Образцы]x3 </strong> <BR>Долговечность: 0/1 <BR>Вероятность срабатывания: 99%<BR><strong>Действует на:</strong><BR>• Уровень жизни (HP): +40<BR><SMALL><strong>Описание:</strong><BR>При использовании на поножи увеличивает уровень здоровья на 40.</SMALL>'
		},
  enhp_19_3:{
				name: 'Зачаровать поножи: Защита от магии F',
				src: imP3 + 'enhp_19_3.gif',
				recipes: null,
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/> <BR>Цена: 1 кр.<BR>Требуется предмет: <strong> [Идеальные Образцы]x3 </strong> <BR>Долговечность: 0/1 <BR>Вероятность срабатывания: 99%<BR><strong>Действует на:</strong><BR>• Защита от магии: +20<BR><SMALL><strong>Описание:</strong><BR>При использовании на поножи увеличивает защиту от магии на 20.</SMALL>'
		},
  enhp_19_1:{
				name: 'Зачаровать поножи: Защита от урона F',
				src: imP3 + 'enhp_19_1.gif',
				recipes: null,
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/> <BR>Цена: 1 кр.<BR>Требуется предмет: <strong> [Идеальные Образцы]x3 </strong> <BR>Долговечность: 0/1 <BR>Вероятность срабатывания: 99%<BR><strong>Действует на:</strong><BR>• Защита от урона: +20<BR><SMALL><strong>Описание:</strong><BR>При использовании на поножи увеличивает защиту от урона на 20.</SMALL>'
		},
  enhp_9_5:{
				name: 'Зачаровать шлем: Адаптация F',
				src: imP3 + 'enhp_9_5.gif',
				recipes: null,
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/> <BR>Цена: 1 кр.<BR>Долговечность: 0/1<BR>Вероятность срабатывания: 99%<BR><STRONG>Действует на:<BR></STRONG>• Количество увеличений: 2<BR>• Защита от урона: +5<BR><SMALL>При использовании на шлем добавляет 2 выбранных параметра. Параметры нужно выбрать до использования свитка.</SMALL><BR> Обменивается у Шейлы за Череп Лика Хаоса'
		},
  enhp_12_4:{
				name: 'Зачаровать сапоги: Адаптация F',
				src: imP3 + 'enhp_12_4.gif',
				recipes: null,
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/> <BR>Цена: 1 кр. <BR>Долговечность: 0/1<BR>Вероятность срабатывания: 99%<BR><strong>Действует на:</strong><BR>• Количество увеличений: 2<BR>• Мф. против критического удара (%): +10<BR><SMALL>При использовании на сапоги добавляет 2 выбранных параметра. Параметры нужно выбрать до использования свитка.</SMALL><BR> Обменивается у Шейлы за Хвост Шипокрыла'
		},
   enhp_4_4:{
				name: 'Зачаровать броню: Адаптация F',
				src: imP3 + 'enhp_4_4.gif',
				recipes: null,
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/> <BR>Цена: 1 кр. <BR>Долговечность: 0/1<BR>Вероятность срабатывания: 99%<BR><strong>Действует на:</strong><BR>• Количество увеличений: 2<BR>• Мф. против увертывания (%): +10<BR><SMALL>При использовании на броню добавляет 2 выбранных параметра. Параметры нужно выбрать до использования свитка.</SMALL><BR> Обменивается у Шейлы за Крыло Шипокрыла Хаоса'
		},
  enhp_2_4:{
				name: 'Зачаровать амулет: Адаптация F',
				src: imP3 + 'enhp_2_4.gif',
				recipes: null,
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/> <BR>Цена: 1 кр.  <BR>Долговечность: 0/1<BR>Вероятность срабатывания: 99%<BR><strong>Действует на:</strong><BR>• Количество увеличений: 2<BR>• Защита от магии: +5<BR><SMALL>При использовании на амулет добавляет 2 выбранных параметра. Параметры нужно выбрать до использования свитка.</SMALL><BR> Обменивается у Шейлы за Перья Валентайского Охотника'
		},
 enhp_19_4:{
				name: 'Зачаровать поножи: Адаптация F',
				src: imP3 + 'enhp_19_4.gif',
				recipes: null,
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><BR>Цена: 1 кр.<BR>Долговечность: 0/1<BR>Вероятность срабатывания: 99%<BR><strong>Действует на:</strong><BR>• Количество увеличений: 3<BR><SMALL>При использовании на поножи добавляет 3 выбранных параметра. Параметры нужно выбрать до использования свитка.</SMALL><BR> Обменивается у Шейлы за Пепел Фанатика Хаоса'
		} 
};

var taktiks ={
		sp_tacpts_HIT1:{
				name: 'Тактика Боя: 1 F',
				src: imP3 + 'sp_tacpts_HIT1.gif',
				descr:  'Масса: 1 <br />Цена: 10 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 1 бонус удара - <img src="'+imP42+'hit.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater7': 3}
		},
		sp_tacpts_HIT2:{
				name: 'Тактика Боя: 2 F',
				src: imP3 + 'sp_tacpts_HIT2.gif',
				descr: 'Масса: 1 <br />Цена: 20 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 2 бонуса удара - <img src="'+imP42+'hit.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater18': 2}
		},
		sp_tacpts_HIT3:{
				name: 'Тактика Боя: 3 F',
				src: imP3 + 'sp_tacpts_HIT3.gif',
				descr: 'Масса: 1 <br />Цена: 30 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 3 бонуса удара - <img src="'+imP42+'hit.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater30': 2}
		},
		sp_tacpts_HIT4:{
				name: 'Тактика Боя: 4 F',
				src: imP3 + 'sp_tacpts_HIT4.gif',
				descr: 'Масса: 1 <br />Цена: 40 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 4 бонуса удара - <img src="'+imP42+'hit.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater22': 1}
		},
		sp_tacpts_HIT5:{
				name: 'Тактика Боя: 5 F',
				src: imP3 + 'sp_tacpts_HIT5.gif',
				descr: 'Масса: 1 <br />Цена: 50 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 5 бонусов удара - <img src="'+imP42+'hit.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater22': 1,'mater23': 1}
		},
		sp_tacpts_BLK1:{
				name: 'Тактика Защиты: 1 F',
				src: imP3 + 'sp_tacpts_BLK1.gif',
				descr: 'Масса: 1 <br />Цена: 10 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 1 бонус блока - <img src="'+imP42+'block.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater11': 3}
		},
		sp_tacpts_BLK2:{
				name: 'Тактика Защиты: 2 F',
				src: imP3 + 'sp_tacpts_BLK2.gif',
				descr: 'Масса: 1 <br />Цена: 20 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 2 бонуса блока - <img src="'+imP42+'block.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater19': 2}
		},
		sp_tacpts_BLK3:{
				name: 'Тактика Защиты: 3 F',
				src: imP3 + 'sp_tacpts_BLK3.gif',
				descr: 'Масса: 1 <br />Цена: 30 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 3 бонуса блока - <img src="'+imP42+'block.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater29': 2}
		},
		sp_tacpts_BLK4:{
				name: 'Тактика Защиты: 4 F',
				src: imP3 + 'sp_tacpts_BLK4.gif',
				descr: 'Масса: 1 <br />Цена: 40 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 4 бонуса блока - <img src="'+imP42+'block.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater21': 1}
		},
		sp_tacpts_BLK5:{
				name: 'Тактика Защиты: 5 F',
				src: imP3 + 'sp_tacpts_BLK5.gif',
				descr: 'Масса: 1 <br />Цена: 50 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 5 бонусов блока - <img src="'+imP42+'block.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater21': 1,'mater23': 1}
		},
		sp_tacpts_KRT1:{
				name: 'Тактика Крови: 1 F',
				src: imP3 + 'sp_tacpts_KRT1.gif',
				descr: 'Масса: 1 <br />Цена: 10 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 1 бонус крита - <img src="'+imP42+'krit.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater9': 3}
		},
		sp_tacpts_KRT2:{
				name: 'Тактика Крови: 2 F',
				src: imP3 + 'sp_tacpts_KRT2.gif',
				descr: 'Масса: 1 <br />Цена: 20 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 2 бонуса крита - <img src="'+imP42+'krit.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater16': 2}
		},
		sp_tacpts_KRT3:{
				name: 'Тактика Крови: 3 F',
				src: imP3 + 'sp_tacpts_KRT3.gif',
				descr: 'Масса: 1 <br />Цена: 30 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 3 бонуса крита - <img src="'+imP42+'krit.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater27': 2}
		},
		sp_tacpts_KRT4:{
				name: 'Тактика Крови: 4 F',
				src: imP3 + 'sp_tacpts_KRT4.gif',
				descr: 'Масса: 1 <br />Цена: 40 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 4 бонуса крита - <img src="'+imP42+'krit.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater31': 1}
		},
		sp_tacpts_KRT5:{
				name: 'Тактика Крови: 5 F',
				src: imP3 + 'sp_tacpts_KRT5.gif',
				descr: 'Масса: 1 <br />Цена: 50 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 5 бонусов крита - <img src="'+imP42+'krit.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater31': 1,'mater23': 1}
		},
		sp_tacpts_CNTR1:{
				name: 'Тактика Ответа: 1 F',
				src: imP3 + 'sp_tacpts_CNTR1.gif',
				descr: 'Масса: 1 <br />Цена: 10 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 1 бонус уворота - <img src="'+imP42+'counter.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater10': 3}
		},
		sp_tacpts_CNTR2:{
				name: 'Тактика Ответа: 2 F',
				src: imP3 + 'sp_tacpts_CNTR2.gif',
				descr: 'Масса: 1 <br />Цена: 20 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 2 бонуса уворота - <img src="'+imP42+'counter.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater17': 2}
		},
		sp_tacpts_CNTR3:{
				name: 'Тактика Ответа: 3 F',
				src: imP3 + 'sp_tacpts_CNTR3.gif',
				descr: 'Масса: 1 <br />Цена: 30 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 3 бонуса уворота - <img src="'+imP42+'counter.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater28': 2}
		},
		sp_tacpts_CNTR4:{
				name: 'Тактика Ответа: 4 F',
				src: imP3 + 'sp_tacpts_CNTR4.gif',
				descr: 'Масса: 1 <br />Цена: 40 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 4 бонуса уворота - <img src="'+imP42+'counter.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater20': 1}
		},
		sp_tacpts_CNTR5:{
				name: 'Тактика Ответа: 5 F',
				src: imP3 + 'sp_tacpts_CNTR5.gif',
				descr: 'Масса: 1 <br />Цена: 50 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 5 бонусов уворота - <img src="'+imP42+'counter.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater20': 1,'mater23': 1}
		},
		sp_tacpts_PRY1:{
				name: 'Тактика Отражения: 1 F',
				src: imP3 + 'sp_tacpts_PRY1.gif',
				descr: 'Масса: 1 <br />Цена: 10 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 1 бонус парирования - <img src="'+imP42+'parry.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater8': 3}
		},
		sp_tacpts_PRY2:{
				name: 'Тактика Отражения: 2 F',
				src: imP3 + 'sp_tacpts_PRY2.gif',
				descr: 'Масса: 1 <br />Цена: 20 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 2 бонуса парирования - <img src="'+imP42+'parry.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater15': 2}
		},
		sp_tacpts_PRY3:{
				name: 'Тактика Отражения: 3 F',
				src: imP3 + 'sp_tacpts_PRY3.gif',
				descr: 'Масса: 1 <br />Цена: 30 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 3 бонуса парирования - <img src="'+imP42+'parry.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater26': 2}
		},
		sp_tacpts_PRY4:{
				name: 'Тактика Отражения: 4 F',
				src: imP3 + 'sp_tacpts_PRY4.gif',
				descr: 'Масса: 1 <br />Цена: 40 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 4 бонуса парирования - <img src="'+imP42+'parry.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater24': 1}
		},
		sp_tacpts_PRY5:{
				name: 'Тактика Отражения: 5 F',
				src: imP3 + 'sp_tacpts_PRY5.gif',
				descr: 'Масса: 1 <br />Цена: 50 кр. <br />Долговечность: 0/1 <br /> Задержка использования: 3 мин.<br />&nbsp;• Мгновенное заклинание<br /><strong>Требуется минимальное:</strong><br />&nbsp;• Уровень: 5<br /><font color=#990000>Наложены заклятия:</font> тактика<br /><i>Сделано в Angels city</i><br /><font color=#990000>Предмет не подлежит ремонту</font><br />Описание:<br />Дает 5 бонусов парирования - <img src="'+imP42+'parry.gif"> <br />Собирается в Лаборатории на первом этаже <strong>Бездны</strong> в Angels City',
				recipes: {'mater24': 1,'mater23': 1}
		}

};

var pochin ={
 	spell_repare_1:{
				name: 'Свиток починки 1',          //3,5,7,10.
				src: imP3 + 'spell_repare_1.gif',
				descr: 'Масса: 1<br />Долговечность: 0/1<br />Цена: 1 кр. <br />Свитки выпадают из монстров, используя рецепт свитка (рецеп свитка состоит из случайных ингредиентов и их количества), можно получить возможность починить артефакт в Мастерских Забытых Мастеров <strong>Подземелья Потеряных</strong> в Emerald City',
				recipes: null

		}
  
};

	var rares = { 
};
*/

var ptp ={
cureHP120:{name: 'Восстановление энергии +120HP F',src: imP3 + 'cureHP45.gif',
	descr: 'Масса: 1 <br />Цена: 4 кр. <br />Долговечность: 0/1 <br />Вероятность срабатывания: 70% <br />Требуется минимальное: <br />• Уровень: 4 <br />Наложены заклятия: исцеление<br />Можно найти в  '
		},
invoke_maxhp:{name: 'Сосуд жизненных сил F',src: imP3 + 'invoke_maxhp.gif',
	descr: 'Масса: 1<br />Цена: 1 кр.<br />Долговечность: 0/5<br />Срок годности: 3 дн.<br /><strong>Наложены заклятия:</strong> Восстановление жизненных сил<br /><strong>Описание:</strong>При использовании полностью восстанавливает ваши жизненные силы.<br />Можно найти в <strong>Забытой экипировке</strong>'
		},  
pot_cureHP150_0:{ name: 'Заживляющая Настойка F',city: 7, src: imP3 + 'pot_cureHP150_0.gif',
 descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 2 кр.<br />Долговечность: 0/10<br />Срок годности: 30 дн. <br /><strong>Требуется минимальное:</strong><br />&bull; Уровень: 7<br />&bull; Местоположение: пещеры<br /><strong>Описание:</strong><br />Зелье, смешанное из мха, грибочков и хлюпов, богато витаминами. Восстанавливает 150 здоровья, использовать можно только в темноте подземелий. <br />Можно купить у Мухатора или выбить с ботов'
		}, 
pot_cureHP300_0:{ name: 'Заживляющий Эликсир F',city: 7, src: imP3 + 'pot_cureHP300_0.gif',
 descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 5 кр.<br />Долговечность: 0/10<br />Срок годности: 30 дн. <br /><strong>Требуется минимальное:</strong><br />&bull; Уровень: 8<br />&bull; Местоположение: пещеры<br /><strong>Описание:</strong><br />Зелье, смешанное из трав, мха, грибочков и хлюпов, богато витаминами и минералами. Восстанавливает 300 здоровья, использовать можно только в темноте подземелий. <br />Можно купить у Мухатора или выбить с ботов'
		},
pot_curemana250_0:{name:'Флакончик маны F',src: imP3 + 'pot_curemana250_0.gif',
				descr:'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 2 кр.<br />Долговечность: 0/10<br />Срок годности: 30 дн. <br /><strong>Требуется минимальное:</strong><br />• Уровень: 4<br />• Местоположение: пещеры<br /><strong>Описание:</strong><br />Заботливо наполнен небольшим количеством магии. Восстанавливает 250 магической энергии, использовать можно только в темноте подземелий.<br />Падает с ботов'
		}, 
pot_curemana500_0:{name:'Бутылек маны F',src: imP3 + 'pot_curemana500_0.gif',
				descr:'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 4 кр.<br />Долговечность: 0/10<br />Срок годности: 30 дн. <br /><strong>Требуется минимальное:</strong><br />• Уровень: 7<br />• Местоположение: пещеры<br /><strong>Описание:</strong><br />Заботливо наполнен значительным количеством магии. Восстанавливает 500 магической энергии, использовать можно только в темноте подземелий.<br />Падает с ботов'
		},
mater333:{ name: 'Прах неупокоенного Р',city: 1, src: imP3 + 'mater333.gif',recipes:null,
				descr: 'Масса: 0.1<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Горстка темного пепла, глядя на него, становится не по себе.<br />Нужен для ритуала призыва.'
		}, 
mater334:{ name: 'Осколки голема P',city: 1, src: imP3 + 'mater334.gif',recipes:null,
				descr: 'Масса: 0.1<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Парочка небольших осколков руды, еще недавно бывших частями голема.<br />Нужны для ритуала призыва.'
		},
mater335:{ name: 'Фрагмент древней плиты F',city: 1, src: imP3 + 'mater335.gif',recipes:null,
				descr: 'Масса: 0.1<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />На первый взгляд просто кусок стены, но почти стертые знаки, выдают в этом предмете носитель древних знаний.<br /> Валюта рыцарского магазина ПТП'
		}, 
mater337:{ name: 'Реагенты для ритуала призыва VF',city: 1, src: imP3 + 'mater337.gif',recipes:null,
				descr: 'Масса: 0.1<br />Долговечность: 0/1<br /><strong>Описание:</strong><br /> Получается на Алтаре Грита за "Прах неупокоенного", "Осколки голема"<br />Нужны для вызова "Одержимый Духом Голем" '
		},
p1k_gritscroll_1:{name: 'Останки справочника Грита EF',src: imP3 + 'p1k_gritscroll_1.gif',
				descr: 'Масса: 1 <br />Долговечность: 0/1<br />Срок годности: 60 дн.  <br /><strong>Описание:</strong><br />Уцелевшие страницы хранят подробные инструкции по призыву и усмирению различных существ.<br />С небольшой вероятностью падает с Мастера Грита. <br />При использовании получаете <img src="http://img.combats.ru/i/misc/icons/p1k_summoner.gif" /> - Эффект - Знания Мастера Грита на 6 часов. <br />Частица знаний Мастера Грита о ритуалах призыва, которую вы смогли понять. <br />Необходим для использования Алтаря и Лаборатории в комнате с Гритом. <br />При выходе из метро пропадает.'
		},
p1k_gritscroll_2:{name: 'Останки справочника Грита EF',src: imP3 + 'p1k_gritscroll_2.gif',
				descr: 'Масса: 1 <br />Долговечность: 0/2<br />Срок годности: 120 дн.  <br /><strong>Описание:</strong><br />Уцелевшие страницы хранят подробные инструкции по призыву и усмирению различных существ.<br />С небольшой вероятностью падает с Мастера Грита. <br />При использовании получаете <img src="http://img.combats.ru/i/misc/icons/p1k_summoner.gif" /> - Эффект - Знания Мастера Грита на 6 часов. <br />Частица знаний Мастера Грита о ритуалах призыва, которую вы смогли понять. <br />Необходим для использования Алтаря и Лаборатории в комнате с Гритом. <br />При выходе из метро пропадает.'
		},
p1k_gritscroll_3:{name: 'Останки справочника Грита EF',src: imP3 + 'p1k_gritscroll_3.gif',
				descr: 'Масса: 1 <br />Долговечность: 0/3<br />Срок годности: 180 дн.  <br /><strong>Описание:</strong><br />Уцелевшие страницы хранят подробные инструкции по призыву и усмирению различных существ.<br />С небольшой вероятностью падает с Мастера Грита. <br />При использовании получаете <img src="http://img.combats.ru/i/misc/icons/p1k_summoner.gif" /> - Эффект - Знания Мастера Грита на 6 часов. <br />Частица знаний Мастера Грита о ритуалах призыва, которую вы смогли понять. <br />Необходим для использования Алтаря и Лаборатории в комнате с Гритом. <br />При выходе из метро пропадает.'
		},
mater336:{ name: 'Печать рода Гритов EF',city: 7, src: imP3 + 'mater336.gif',recipes:null,
				descr: 'Масса: 0.1<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Невероятно древнее и изящное кольцо с печатью проклятого рода.<br />'
		},
mater500:{ name: 'Горстка старинных монет VF',city: 1, src: imP3 + 'mater500.gif',recipes:null,
				descr: 'Масса: 1<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Возможно для кого-то они представляют некоторую ценность.<br /> Можно обменять на креды в Девилсе у НПСа березки.'
		},
	clanexp_500:{ name: 'Право на дружбу [500] F',src: imP3 + 'clanexp_500.gif',
				descr: 'Масса: 1<br />Долговечность: 0/1<br />Срок годности: 30 дн.<br /><strong>Требуется минимальное:</strong><br />• Клан: состоять в клане уровня 0-5<br /><strong>Описание:</strong><br />Прочитав его вы повысите опыт клана на 500.<br />Начисление опыта может произойти не сразу, а спустя некотрое время.<br />Внимание! Может быть использован только для увеличения опыта клана до 6 уровня.<br /> Может упасть с Маула.'
		}, 
	clanexp_1000:{ name: 'Право на дружбу [1000] F',src: imP3 + 'clanexp_1000.gif',
				descr: 'Масса: 1<br />Долговечность: 0/1<br />Срок годности: 60 дн.<br /><strong>Требуется минимальное:</strong><br />• Клан: состоять в клане уровня 0-5<br /><strong>Описание:</strong><br />Прочитав его вы повысите опыт клана на 1000.<br />Начисление опыта может произойти не сразу, а спустя некотрое время.<br />Внимание! Может быть использован только для увеличения опыта клана до 6 уровня.<br /> Может упасть с Маула.'
		},
	sword0831:{ name: 'Ятаган Маула VF', src: imP3 + '3/2/sword0831.gif',
	  descr: 'Масса: 10 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 195 кр.<br />Долговечность: 0/34<br />Предмет для воина<br /><strong>Требуется минимальное:</strong><br />• Ловкость: 48<br />• Уровень: 8<br />• Мастерство владения мечами: 5<br />• Выносливость: 20<br /><strong>Действует на:</strong><br />• Мф. против увертывания (%): +55<br />• Мф. увертывания (%): +55<br />• Мф. контрудара (%): +5<br />• Мф. мощности колющего урона: +5<br /><strong>Свойства предмета:</strong><br /> Урон: 10 - 30<br /> Зоны блокирования: +<br /><strong>Особенности:</strong> <br /> Колющие атаки: Регулярны<br /> Режущие атаки: Малы<br /><strong>Описание:</strong><br />Немного потрепанный с первого взгляда, но если присмотреться, становится понятно, что этот ятаган прослужит еще долго.<br />Может упасть с Маула в ПТП.'
		 },
	belt0831:{ name: 'Пояс несокрушимого атамана VF',src: imP3 + '5/belt0831.gif',
   descr: 'Масса: 5 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 135 кр. <br />Долговечность: 0/34<br />Предмет для воина<br /><strong>Требуется минимальное:</strong><br />• Уровень: 8<br />• Выносливость: 48<br />• Сила: 24<br /><strong>Действует на:</strong><br />• Мф. против увертывания (%): +50<br />• Мф. мощности дробящего урона: +5<br />• Защита от магии: +10<br />• Уровень жизни (HP): +65<br />• Сила: +2<br />• Броня пояса: 8-29 (7+d22)'
   },
	belt0832:{ name: 'Пояс ловкого атамана VF',src: imP3 + '5/belt0832.gif',
		 descr: 'Масса: 3 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 135 кр.<br />Долговечность: 0/34<br /><strong>Требуется минимальное:</strong><br />• Ловкость: 48<br />• Уровень: 8<br />• Выносливость: 24<br /><strong>Действует на:</strong><br />• Мф. против увертывания (%): +50<br />• Мф. увертывания (%): +50<br />• Мф. мощности колющего урона: +5<br />• Защита от магии: +20<br />• Уровень жизни (HP): +37<br />• Броня пояса: 5-15 (4+d11)<br />Можно выбить с ботов в ПТП.'
   },
	belt0833:{ name: 'Пояс жестокого атамана VF', src: imP3 + '5/belt0833.gif',
   descr: 'Масса: 3 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 135 кр.<br />Долговечность: 0/34<br /><strong>Требуется минимальное:</strong><br />• Уровень: 8<br />• Выносливость: 25<br />• Сила: 25<br /><strong>Действует на:</strong><br />• Мф. мощности крит. удара (%): +5<br />• Мф. против увертывания (%): +50<br />• Мф. критического удара (%): +50<br />• Защита от магии: +10<br />• Уровень жизни (HP): +45<br />• Броня пояса: 7-22 (6+d16)<br />Можно выбить с ботов в ПТП.'
		 },
 belt0834:{ name: 'Пояс буйного атамана VF', src: imP3 + '5/belt0834.gif',
   descr: 'Масса: 5 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 135 кр.<br />Долговечность: 0/34<br />Предмет для воина<br /><strong>Требуется минимальное:</strong><br />• Уровень: 8<br />• Выносливость: 24<br />• Сила: 48<br /><strong>Действует на:</strong><br />• Мф. против критического удара (%): +25<br />• Мф. против увертывания (%): +50<br />• Мф. мощности рубящего урона: +5<br />• Защита от магии: +15<br />• Уровень жизни (HP): +50<br />• Броня пояса: 8-29 (7+d22)<br />Можно выбить с ботов в ПТП.'
		 },
 belt0835:{ name: 'Пояс мудрого атамана VF',src: imP3 + '5/belt0835.gif',
		 descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 135 кр.<br />Долговечность: 0/34<br />Предмет для мага<br /><strong>Требуется минимальное:</strong><br />• Интеллект: 24<br />• Уровень: 8<br />• Мудрость: 56<br /><strong>Действует на:</strong><br />• Мф. против критического удара (%): +25<br />• Мф. мощности магии стихий: +5<br />• Защита от урона: +10<br />• Уровень жизни (HP): +36<br />• Уровень маны: +70<br />• Броня пояса: 4-11 (3+d8)<br />Можно выбить с ботов в ПТП.'
   },
	boots0931:{ name: 'Ботинки прочного валуна VF',src: imP3 + '12/boots0931.gif',
		 descr: 'Масса: 10 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 185 кр.<br />Долговечность: 0/55<br />Предмет для воина<br /><strong>Требуется минимальное:</strong><br />• Уровень: 9<br />• Выносливость: 27<br />• Сила: 54<br /><strong>Действует на:</strong><br />• Мф. против критического удара (%): +25<br />• Мф. против увертывания (%): +70<br />• Мф. мощности рубящего урона: +7<br />• Защита от магии: +20<br />• Уровень жизни (HP): +75<br />• Сила: +1<br />• Броня ног: 8-28 (7+d21)<br />Можно выбить с ботов в ПТП.'
   }, 
 boots0933:{name: 'Ботинки острых граней VF',src: imP3 + '12/boots0933.gif',
	  descr: 'Масса: 5 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 185 кр. <br />Долговечность: 0/55<br /><strong>Требуется минимальное:</strong><br />• Уровень: 9<br />• Выносливость: 30<br />• Сила: 25<br /><strong>Действует на:</strong><br />• Мф. мощности крит. удара (: +7<br />• Мф. против увертывания (: +70<br />• Мф. критического удара (: +70<br />• Защита от магии: +20<br />• Уровень жизни (HP): +50<br />• Броня ног: 7-22 (6+D16)<br />Можно выбить с ботов в ПТП.'
	 	}, 
 boots0934:{ name: 'Сапоги каменной глыбы VF',src: imP3 + '12/boots0934.gif',
		 descr: 'Масса: 10 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 185 кр.<br />Долговечность: 0/55<br />Предмет для воина<br /><strong>Требуется минимальное:</strong><br />• Уровень: 9<br />• Выносливость: 54<br />• Сила: 27<br /><strong>Действует на:</strong><br />• Мф. против мощности крит. удара (: +5<br />• Мф. против увертывания (%): +50<br />• Мф. мощности дробящего урона: +7<br />• Защита от магии: +20<br />• Уровень жизни (HP): +85<br />• Сила: +1<br />• Броня ног: 12-43 (11+d32)<br />Можно выбить с ботов в ПТП.'
	 	}, 
	boots0935:{ name: 'Ботинки редкой породы VF',src: imP3 + '12/boots0935.gif',
	  descr: 'Масса: 2 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 185 кр.<br />Долговечность: 0/55<br />Предмет для мага<br /><strong>Требуется минимальное:</strong><br />• Интеллект: 27<br />• Уровень: 9<br />• Мудрость: 63<br /><strong>Действует на:</strong><br />• Мф. против критического удара (%): +50<br />• Мф. мощности магии стихий: +8<br />• Защита от урона: +15<br />• Уровень жизни (HP): +40<br />• Уровень маны: +80<br />• Броня ног: 3-9 (2+d7)<br />Можно выбить с ботов в ПТП.'
  	} 

};

var pm ={
 cure3_7:{ name: 'Лечение тяжелых травм  F', src: imP3 + 'cure3_7.gif',
  descr: 'Масса: 1<br />Цена: 1 кр.<br />Долговечность: 0/2<br /><strong>Требуется минимальное:</strong><br />• Уровень: 6 '
		},  
pot_cureHP150_0:{ name: 'Заживляющая Настойка F',city: 7, src: imP3 + 'pot_cureHP150_0.gif',
  descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 2 кр.<br />Долговечность: 0/5/15/25<br />Срок годности: 30 дн. <br /><strong>Требуется минимальное:</strong><br />&bull; Уровень: 7<br />&bull; Местоположение: пещеры<br /><strong>Описание:</strong><br />Зелье, смешанное из мха, грибочков и хлюпов, богато витаминами. Восстанавливает 150 здоровья, использовать можно только в темноте подземелий. <br />Можно купить у Мухатора или выбить с ботов'
		}, 
pot_cureHP300_0:{ name: 'Заживляющий Эликсир F',city: 7, src: imP3 + 'pot_cureHP300_0.gif',
  descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 5 кр.<br />Долговечность: 0/5/15/25<br />Срок годности: 30 дн. <br /><strong>Требуется минимальное:</strong><br />&bull; Уровень: 8<br />&bull; Местоположение: пещеры<br /><strong>Описание:</strong><br />Зелье, смешанное из трав, мха, грибочков и хлюпов, богато витаминами и минералами. Восстанавливает 300 здоровья, использовать можно только в темноте подземелий. <br />Можно купить у Мухатора или выбить с ботов'
		},
pot_curemana250_0:{name:'Флакончик маны F',src: imP3 + 'pot_curemana250_0.gif',
  descr:'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 2 кр.<br />Долговечность: 0/5/15/25<br />Срок годности: 30 дн. <br /><strong>Требуется минимальное:</strong><br />• Уровень: 4<br />• Местоположение: пещеры<br /><strong>Описание:</strong><br />Заботливо наполнен небольшим количеством магии. Восстанавливает 250 магической энергии, использовать можно только в темноте подземелий.<br />Падает с ботов'
		}, 
pot_curemana500_0:{name:'Бутылек маны F',src: imP3 + 'pot_curemana500_0.gif',
	 descr:'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 4 кр.<br />Долговечность: 0/5/15/25<br />Срок годности: 30 дн. <br /><strong>Требуется минимальное:</strong><br />• Уровень: 7<br />• Местоположение: пещеры<br /><strong>Описание:</strong><br />Заботливо наполнен значительным количеством магии. Восстанавливает 500 магической энергии, использовать можно только в темноте подземелий.<br />Падает с ботов'
		}, 
	clanexp_500:{ name: 'Право на дружбу [500] F',src: imP3 + 'clanexp_500.gif',
				descr: 'Масса: 1<br />Долговечность: 0/1<br />Срок годности: 30 дн.<br /><strong>Требуется минимальное:</strong><br />• Клан: состоять в клане уровня 0-5<br /><strong>Описание:</strong><br />Прочитав его вы повысите опыт клана на 500.<br />Начисление опыта может произойти не сразу, а спустя некотрое время.<br />Внимание! Может быть использован только для увеличения опыта клана до 6 уровня.<br /> Можно найти в сундуках или выбить с Краппта.'
		}, 
	clanexp_1000:{ name: 'Право на дружбу [1000] F',src: imP3 + 'clanexp_1000.gif',
				descr: 'Масса: 1<br />Долговечность: 0/1<br />Срок годности: 60 дн.<br /><strong>Требуется минимальное:</strong><br />• Клан: состоять в клане уровня 0-5<br /><strong>Описание:</strong><br />Прочитав его вы повысите опыт клана на 1000.<br />Начисление опыта может произойти не сразу, а спустя некотрое время.<br />Внимание! Может быть использован только для увеличения опыта клана до 6 уровня.<br /> Можно найти в сундуках или выбить с Краппта.'
		},
	pm_bones:{ name: 'Куски костей VP',city: 3, src: imP3 + 'pm_bones.gif',
				descr: 'Масса: 0.1 <br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Разнообразные куски и осколки костей Проклятия Глубин. По своей сути - бесполезны.'
		}, 
	pm_skin:{ name: 'Лоскуты шкуры P',city: 3, src: imP3 + 'pm_skin.gif',
				descr: 'Масса: 0.1<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Остатки шкуры ПГ. Твердая, плохопахнущая, неприятная на ощупь.'
		}, 
	pm_coal:{ name: 'Горючий камень F',city: 3, src: imP3 + 'pm_coal.gif',
				descr: 'Масса: 3 <br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Кусок породы с резким запахом и свойством пачкать руки. Используется в металлургии.'
		},  
	pm_gold1:{ name: 'Частицы золота VP ',city: 3, src: imP3 + 'pm_gold1.gif',
				descr: 'Масса: 0.1<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Мелкие крупинки золота перемешанные с пылью, песком, какими-то крошками и мусором. Мусор в этой смеси преобладает.'
		}, 
	pm_gold2:{ name: 'Небольшой слиток золота P',city: 3, src: imP3 + 'pm_gold2.gif',
				descr: 'Масса: 2 <br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Очень скромный слиток золота. Не особо аккуратный, но увесистый.'
		},  
	pm_lead1:{ name: 'Частицы свинца VP',city: 3, src: imP3 + 'pm_lead1.gif',
				descr: 'Масса: 0.1 <br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Мелкие крупинки свинца перемешанные с пылью, песком, какими-то крошками и мусором. Мусор в этой смеси преобладает.'
		},  
	pm_lead2:{ name: 'Небольшой слиток свинца P',city: 3, src: imP3 + 'pm_lead2.gif',
				descr: 'Масса: 2 <br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Очень скромный слиток свинца. Не особо аккуратный, но увесистый.'
		}, 
	pm_silver1:{ name: 'Частицы серебра VP',city: 3, src: imP3 + 'pm_silver1.gif',
				descr: 'Масса: 0.1<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Мелкие крупинки серебра перемешанные с пылью, песком, какими-то крошками и мусором. Мусор в этой смеси преобладает.'
		},   
	pm_silver2:{ name: 'Небольшой слиток серебра P',city: 3, src: imP3 + 'pm_silver2.gif',
				descr: 'Масса: 2<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Очень скромный слиток серебра. Не особо аккуратный, но увесистый.'
		},  
	pm_cooper1:{ name: 'Частицы меди VP',city: 3, src: imP3 + 'pm_cooper1.gif',
				descr: 'Масса: 0.1<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Мелкие крупинки меди перемешанные с пылью, песком, какими-то крошками и мусором. Мусор в этой смеси преобладает.'
		},
	pm_cooper2:{ name: 'Небольшой слиток меди P',city: 3, src: imP3 + 'pm_cooper2.gif',
				descr: 'Масса: 2<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Очень скромный слиток меди. Не особо аккуратный, но увесистый.'
		},   
	pm_metal3:{ name: 'Слиток металла F',city: 3, src: imP3 + 'pm_metal3.gif',
				descr: 'Масса: 4<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Тяжелый слиток металла, готов к употреблению в ювелирной промышленности и производстве монет.<br /> Он же слиток ювелирного металла.'
		}, 
	pm_metal4:{ name: 'Металлиум VF',city: 3, src: imP3 + 'pm_metal4.gif',
				descr: 'Масса: 8<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Очень тяжелый, плотный и очень прочный слиток металла. Применяется в тяжелом бронестроении и оружейной промышленности. Редкая вещь. '
		},
inc_hpm5	:{ name: 'Чудо-жижа F',city: 3, src: imP3 + 'inc_hpm5.gif',
				descr: 'Масса: 4 <br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Чудо-жижа - помогает увеличить долговечность предмета экипировки на 5.<br />Можно получить у Хрумпта взамен Металлиума + 5 Горючих камней'
		}, 
pm_token:{ name: 'Знак признательности города VF',city: 3, src: imP3 + 'pm_token.gif',
				descr: 'Масса: 1<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Неудобный для переноски, тяжеловатый, но что поделать - такова уж признательность.<br /> Принеся Фелико слиток ювелирного металла, он даст вам 10 знаков признательности.'
		},
	head06310:{ name: 'Шлем опытного шахтера VF',city: 3, src: imP3 + '9/head06310.gif',
				descr: 'Масса: 1 <br />Цена: 10 кр.<br />Долговечность: 0/40<br /><strong>Описание:</strong><br />Практически точная имитация шлема шахтера. Для полноценной работы необходима точная имитация свечи шахтера.<br />Если зарядить в метро свечкой, то даст ускоренное перемещение на 1 час.'
		},
	pm_rank1_reward:{ name: 'Чертежи шлема VF',city: 3, src: imP3 + 'pm_rank1_reward.gif',
				descr: 'Масса: 0.1 <br />Цена: 1 кр.<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Чертежи какого-то очень сложного шлема. Может быть кто-нибудь по ним сможет создать что-то подобное?'
		},
hood07410:{ name: 'Капюшон главного забойщика EF',city: 3, src: imP3 + '18/hood07410.gif',
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 10 кр.<br />Долговечность: 0/50<br /><strong>Требуется минимальное:</strong><br />• Уровень: 7<br />Местоположение: пещеры<br />Максимум: 1 ед.<br />Встроено заклятие 1 шт. в сутки (Использовано: 0)<br /><strong>Описание:</strong><br />Экспериментальная модель капюшона, доступная немногим. Для полноценной работы требуется свечи.'
  },
	invoke_pm_food_3:{ name: 'Истлевший завтрак VP',city: 3, src: imP3 + 'invoke_pm_food_3.gif',
				descr: 'Масса: 0.1 <br />Долговечность: 0/1<br />Требуется минимальное:<br />• Местоположение: пещеры<br />Наложено заклятье: Эффект от завтрака<br /><strong>Описание:</strong><br />Завернутая в то, что когда-то было обработанной шкурой, эта масса органики производит удручающее впечатление. Хотя если покопаться – можно что-нибудь найти. Вы действительно хотите ЭТО съесть?<br />'
		},
	invoke_pm_food_2:{ name: 'Протухший завтрак P',city: 3, src: imP3 + 'invoke_pm_food_2.gif',
				descr: 'Масса: 0.1 <br />Долговечность: 0/1<br />Требуется минимальное:<br />• Местоположение: пещеры<br />Наложено заклятье: Эффект от завтрака<br /><strong>Описание:</strong><br />Завернутая в обработанную шкуру, эта тухлятина производит достаточно неоднозначное впечатление. Хотя на второй взгляд, встречаются на вид съедобные кусочки. Вопрос – вы действительно настолько голодны?<br />'
		},
	invoke_pm_food_1:{ name: 'Испорченный завтрак F',city: 3, src: imP3 + 'invoke_pm_food_1.gif',
				descr: 'Масса: 0.1 <br />Долговечность: 0/1<br />Наложено заклятье: Эффект от завтрака<br /><strong>Описание:</strong><br />Завернутая в слегка побитую и потертую кожу, эта пища смотрится неплохо. А области покрытые плесенью вполне можно вырезать и выбросить. Так что с голоду вы не умрете – это точно.<br />'
		},
	invoke_pm_food_0:{ name: 'Питательный завтрак VF',city: 3, src: imP3 + 'invoke_pm_food_0.gif',
				descr: 'Масса: 0.1 <br />Долговечность: 0/1<br />Наложено заклятье: Эффект от завтрака<br /><strong>Описание:</strong><br />Укрытый от невзгод тщательно обработанной кожей этот завтрак может спасти вас не только от неминуемой гибели, но и придать вам сил перед боем, исцелить ваши болезни и просто утолить голод.<br />Дает ускоренное перемещение, лечит до максимума, снимает негативные эффекты, добавляет несколько статов.'
		}, 
mater500:{ name: 'Горстка старинных монет VF',city: 1, src: imP3 + 'mater500.gif',recipes:null,
				descr: 'Масса: 1<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Возможно для кого-то они представляют некоторую ценность.<br /> Можно обменять на креды в Девилсе у НПСа березки.'
		},
 pm_bonePG:{ name: 'Статуэтка ПГ F',city: 3, src: imP3 + 'pm_bonePG.gif',
				descr: 'Масса: 1 <br />Долговечность: 0/1<br />Максимум: 1 ед.<br /><strong>Описание:</strong><br />Выточенная и собранная из натуральной кости ПГ эта стутуэтка вызывает противоречивые чувства.'
		},  
 invoke_pm_digger_candle:{ name: 'Коробка со свечками F',city: 3, src: imP3 + 'invoke_pm_digger_candle.gif',
				descr: 'Масса: 0.1 <br />Долговечность: 0/10<br />Наложено заклятье: Освещение<br /><strong>Описание:</strong><br />Свечи для использования в Шлеме Диггера. Не мочить, не использовать вблизи открытого огня, не давать детям, не разбирать.<br />'
		} 



};

 var kanaliz ={ 
 cure3_7:{
				name: 'Лечение травм F',
				src: imP3 + 'cure3_7.gif',
				descr: 'Масса: 1<br />Цена: 1 кр.<br />Долговечность: 0/5<br /><strong>Требуется минимальное:</strong><br />• Уровень: 2-7<br />Максимум: 10 ед.<br /><strong>Описание:</strong>Исцеляет травмы. Работает только для персонажей 2-7 уровня.<br />Можно найти в <strong>Забытой экипировке</strong>'
		},  
		cureHP45:{
				name: 'Восстановление энергии +45HP F',
				src: imP3 + 'cureHP45.gif',
				descr: 'Масса: 1 <br />Цена: 4 кр. <br />Долговечность: 0/1 <br />Вероятность срабатывания: 70% <br />Требуется минимальное: <br />• Уровень: 4 <br />Наложены заклятия: исцеление<br />Можно найти в <strong>Забытой экипировке</strong> ',
				recipes: null
		},
 invoke_maxhp:{
				name: 'Сосуд жизненных сил F',
				src: imP3 + 'invoke_maxhp.gif',
				descr: 'Масса: 1<br />Цена: 1 кр.<br />Долговечность: 0/5<br />Срок годности: 3 дн.<br /><strong>Наложены заклятия:</strong> Восстановление жизненных сил<br /><strong>Описание:</strong>При использовании полностью восстанавливает ваши жизненные силы.<br />Можно найти в <strong>Забытой экипировке</strong>'
		}, 
 amulet0431:{
				name: 'Гайка Силы VF',
				src: imP3 + '2/amulet0431.gif',
				descr: 'Масса: 1 <Br />Цена: 90 кр.<Br />Долговечность: 0/25<Br /><strong>Требуется минимальное:</strong><Br />• Уровень: 4<Br />• Сила: 15<Br /><strong>Действует на:</strong><Br />• Мф. против критического удара (%): +30<Br />• Мф. против увертывания (%): +30<Br />• Уровень жизни (HP): +33<Br />• Сила: +3<Br />• Броня головы: 4-6 (3+d3)<Br />• Броня корпуса: 4-6 (3+d3)<Br />• Броня пояса: 4-6 (3+d3)<Br />• Броня ног: 4-6 (3+d3)<Br />Можно получить у <strong>Луки</strong> выполнив его квест.',
				recipes: null
		},
 amulet0432:{
				name: 'Гайка Мудрости VF',
				src: imP3 + '2/amulet0432.gif',
				descr: 'Масса: 1 <Br />Цена: 90 кр.<Br />Долговечность: 0/25<Br /><strong>Требуется минимальное:</strong><Br />• Интеллект: 15<Br />• Уровень: 4<Br /><strong>Действует на:</strong><Br />• Мф. против критического удара (%): +27<Br />• Интеллект: +3<Br />• Уровень жизни (HP): +30<Br />• Уровень маны: +30<Br />• Броня головы: 4-6 (3+d3)<Br />• Броня корпуса: 4-6 (3+d3)<Br />• Броня пояса: 4-6 (3+d3)<Br />• Броня ног: 4-6 (3+d3)<Br />Можно получить у <strong>Луки</strong> выполнив его квест.',
				recipes: null
		},

	sword0531:{
				name: 'Лунный Клинок VF',city: 6,
				src: imP3 + '3/2/sword0531.gif',
				descr: 'Масса: 10 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 78 кр. <br />Долговечность: 0/20<br />Предмет для воина<br /><strong>Требуется минимальное:</strong><br />• Уровень: 5<br />• Мастерство владения мечами: 5<br />• Выносливость: 25<br /><strong>Действует на:</strong><br />• Уровень жизни (HP): +20<br /><strong>Свойства предмета:</strong><br />• Урон: 7 - 21<br />• Второе оружие<br />• Зоны блокирования: +<br /><strong>Особенности:</strong><br />• Рубящие атаки: Временами<br />• Режущие атаки: Временами<br />Можно выбить с ботов в Канализации'
		},
 bow0531:{
				name: 'Паучий Лук VF',city: 6,
				src: imP3 + '3/51/bow0531.gif',
				descr: 'Масса: 10 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 124 кр. <br />Долговечность: 0/20<br />Предмет для стрелка<br /><strong>Требуется минимальное:</strong><br />• Ловкость: 30<br />• Уровень: 5<br />• Мастерство владения луком: 5<br />• Выносливость: 15<br /><strong>Действует на:</strong><br />• Мф. против критического удара (%): +20<br />• Мф. против увертывания (%): +20<br />• Мф. увертывания (%): +35<br />• Мф. мощности колющего урона: +5<br />• Ловкость: +1<br />• Уровень жизни (HP): +20<br /><strong>Свойства предмета:</strong><br />• Урон: 8 - 16<br />• Двуручное оружие<br />• Зоны блокирования: +<br /><strong>Особенности:</strong><br />• Колющие атаки: Часты<br />• Дробящие атаки: Ничтожно редки<br /><small><strong>Колчан:</strong></small><br />  Может вместить до 250 стрел<br />Можно выбить с ботов в Канализации'
		},
 staff0531:{
				name: 'Посох Забытых Умений VF',city: 6,
				src: imP3 + '3/30/staff0531.gif',
				descr: 'Масса: 10 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 130 кр. <br />Долговечность: 0/20<br />Предмет для мага<br /><strong>Требуется минимальное:</strong><br />• Интеллект: 15<br />• Уровень: 5<br />• Мастерство владения магическими посохами: 1<br /><strong>Действует на:</strong><br />• Мф. против критического удара (%): +20<br />• Мф. мощности магии стихий: +5<br />• Интеллект: +3<br />• Уровень жизни (HP): +20<br />• Уровень маны: +45<br /><strong>Свойства предмета:</strong><br />• Урон: 1 - 16<br />• Двуручное оружие<br />• Зоны блокирования: +<br /><strong>Особенности:</strong><br />• Огненные атаки: Малы<br />• Дробящие атаки: Малы<br />• Ледяные атаки: Малы<br />• Электрические атаки: Малы<br />• Земляные атаки: Малы<br />Можно выбить с ботов в Канализации'
		},
	head0631:{
				name: 'Шлем Устрашения VF',city: 6,
				src: imP3 + '9/head0631.gif',
				descr: 'Масса: 10 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 103 кр.  <br />Долговечность: 0/35<br /><strong>Требуется минимальное:</strong><br />• Уровень: 6<br />• Выносливость: 20<br /><strong>Действует на:</strong><br />• Количество увеличений: +2<br />• Владение оружием: +1<br />• Уровень жизни (HP): +34<br />• Мф. против критического удара (%): +30<br />• Мф. против увертывания (%): +30<br />• Броня головы: 7-25 <br />Можно выбить с ботов в Канализации'
		},
	head0632:{
				name: 'Шапка Удачного Выстрела VF',city: 6,
				src: imP3 + '9/head0632.gif',
				descr: 'Масса: 5 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 103 кр. <br />Долговечность: 0/35<br />Предмет для стрелка<br /><strong>Требуется минимальное:</strong><br />• Ловкость: 36<br />• Уровень: 6<br />• Выносливость: 18<br /><strong>Действует на:</strong><br />• Мф. против увертывания (%): +20<br />• Мф. увертывания (%): +30<br />• Мф. мощности колющего урона: +5<br />• Ловкость: +2<br />• Мастерство владения луком: +1<br />• Уровень жизни (HP): +35<br />• Уровень маны: +20<br />• Броня головы: 4-12 (3+d9)<br />Можно выбить с ботов в Канализации'
		},  
 head0633:{
				name: 'Обруч Четырех Стихий VF',city: 6,
				src: imP3 + '9/head0633.gif',
				descr: 'Масса: 2 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 106 кр.  <br />Долговечность: 0/35<br /><strong>Требуется минимальное:</strong><br />• Уровень: 6<br />• Интеллект: 18<br /><strong>Действует на:</strong><br />• Интеллект: +2<br />• Уровень маны: +50<br />• Уровень жизни (HP): +30<br />• Мф. против критического удара (%): +10<br />• Мф. мощности магии стихий: +5<br />• Броня головы: 3-9<br />Можно выбить с ботов в Канализации'
		}, 
	body0431:{
				name: 'Роба Вечного Ученика VF',city: 6,
				src: imP3 + '4/body0431.gif',
				descr: 'Масса: 12 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 99 кр. <br />Долговечность: 0/25<br />Предмет для мага<br /><strong>Требуется минимальное:</strong><br />• Интеллект: 12<br />• Уровень: 4<br /><strong>Действует на:</strong><br />• Мф. против критического удара (%): +30<br />• Мф. мощности магии стихий: +5<br />• Интеллект: +2<br />• Уровень жизни (HP): +20<br />• Уровень маны: +35<br />• Броня корпуса: 2-4 (1+d3)<br />Можно выбить с ботов в Канализации'
		},
	body0432:{ name: 'Куртка Осенних Сумерек VF',city: 6, src: imP3 + '4/body0432.gif',
				descr: 'Масса: 25<img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 99 кр. <br />Долговечность: 0/25<br />Предмет для стрелка<br /><strong>Требуется минимальное:</strong><br />&bull; Ловкость: 24<br />&bull; Уровень: 4<br />&bull; Выносливость: 12<br /><strong>Действует на:</strong><br />&bull; Мф. против увертывания (%): +35<br />&bull; Мф. увертывания (%): +50<br />&bull; Мф. мощности колющего урона: +5<br />&bull; Ловкость: +2<br />&bull; Уровень жизни (HP): +40<br />&bull; Броня корпуса: 2-4 (1+d3)<br />Можно выбить с ботов в Канализации'
		},   
 body0433:{
				name: 'Панцирь Пехотинца VF',city: 6,
				src: imP3 + '4/body0433.gif',
				descr: 'Масса: 50 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 99 кр.  <br />Долговечность: 0/25<br /><strong>Требуется минимальное:</strong><br />• Уровень: 4<br />• Выносливость: 15<br /><strong>Действует на:</strong><br />• Количество увеличений: +2<br />• Уровень жизни (HP): +51<br />• Мф. против критического удара (%): +30<br />• Мф. против увертывания (%): +50<br />• Броня корпуса: 3-8<br />Можно выбить с ботов в Канализации'
		},

	 zk_vantuz_1:{
				name: 'Вантуз P',
				src: imP3 + 'zk_vantuz_1.gif',
				recipes: null,
				descr: 'Масса: 1 <Br />Долговечность: 0/1<Br />Максимум: 1 ед.<Br /><strong>Описание:</strong><Br />Собственность Мартына.<Br />Взяв его у Луки, с ним можно попасть в "Котельную" и собирать с его помощью "Засоры". <Br />Обменяв у "Печника" получите 3 золотых жетона.'
		},
	 zk_zasor_1:{
				name: 'Засор VP',
				src: imP3 + 'zk_zasor_1.gif',
				recipes: null,
				descr: 'Масса: 1 <Br />Долговечность: 0/1<Br /><strong>Описание:</strong><Br />Вам кажется что... Оно ЖИВОЕ!<Br />Собираются в "Котельной" с помощью "Вантуза"<Br />Обменяв у "Печника" получите 3 золотых жетона за 33 "Засора".'
		},
	 mater_small_lvl4_reward:{
				name: 'Гайка VP',
				src: imP3 + 'mater_small_lvl4_reward.gif',
				recipes: null,
				descr: 'Может выпасть из: Паука, Сточного Паука, Канализационного Жука, Сантехника Зомби, Обитателя Подвалов; <Br />можно найти в: Потерянном сундуке, Водостоке на клетке <b>H13</b>, в Водостоке на клетке <b>K10</b> (в северной стене). <Br />1го этажа <strong>Канализации</strong>.'
		},
	 mater_small_lvl5_reward:{
				name: 'Чистая гайка VP',
				src: imP3 + 'mater_small_lvl5_reward.gif',
				recipes: null,
				descr: 'Может выпасть из: Канализационного Паука, Страшной Крысы <Br />можно найти в Месторождении Мусора.<Br />2го этажа <strong>Канализации</strong>.'
		},
	 mater_small_lvl6_reward:{
				name: 'Гайка с резьбой VP',
				src: imP3 + 'mater_small_lvl6_reward.gif',
				recipes: null,
				descr: 'Может выпасть из Летучей Бестии, Кровавый Сантехник; <Br />можно найти в Бронзовом Сундучке.<Br />2го этажа <strong>Канализации</strong>.'
		},
	 mater_med_lvl4_reward:{
				name: 'Болт P',
				src: imP3 + 'mater_med_lvl4_reward.gif',
				recipes: null,
				descr: 'Может выпасть из Обитателя Подвалов; <Br />можно найти в Заброшенном Сундуке.<Br />1го этажа <strong>Канализации</strong>.'
		},
	 mater_med_lvl5_reward:{
				name: 'Длинный болт P',
				src: imP3 + 'mater_med_lvl5_reward.gif',
				recipes: null,
				descr: 'Может выпасть из Безголового Сантехника; <Br />можно найти в Останках Сантехника.<Br />2го этажа <strong>Канализации</strong>.'
		},
	 mater_med_lvl6_reward:{
				name: 'Нужный болт P',
				src: imP3 + 'mater_med_lvl6_reward.gif',
				recipes: null,
				descr: 'Может выпасть из Хозяин Канализации, Слесаря - зомби, Местных Жителей; <Br />можно найти в Серебряном Сундучке.<Br />2го этажа <strong>Канализации</strong>'
		},
	 mater_big_lvl4_reward:{
				name: 'Вентиль F',
				src: imP3 + 'mater_big_lvl4_reward.gif',
				recipes: null,
				descr: 'Может выпасть из Тунельного Гада и Жуткой Мерзости; <Br />можно найти в Старом Сундуке.<Br />1го этажа <strong>Канализации</strong>.'
		},
	 mater_big_lvl5_reward:{
				name: 'Чистый вентиль F',
				src: imP3 + 'mater_big_lvl5_reward.gif',
				recipes: null,
				descr: 'Может выпасть из Старожила; <Br />можно найти в Кованом Сундуке.<Br />2го этажа <strong>Канализации</strong>.'
		},
	 mater_big_lvl6_reward:{
				name: 'Рабочий вентиль F',
				src: imP3 + 'mater_big_lvl6_reward.gif',
				recipes: null,
				descr: 'Может выпасть из Главного Прораба; <Br />можно найти в Золотом Сундучке.<Br />2го этажа <strong>Канализации</strong>.'
		},
	 mater247:{
				name: 'Ключииик F',
				src: imP3 + 'mater247.gif',
				recipes: null,
				descr: 'Выпадает из <strong>Мартына Водопроводчика</strong> в <strong>Канализации</strong>.<Br /> нужен для завершения задания, или с помощью него можно отгрутить Вентиль от трубопровода за Лукой.'
		},
	 mater_coin_lvl4_reward:{
				name: 'Жетон VP',
				src: imP3 + 'mater_coin_lvl4_reward.gif',
				recipes: null,
				descr: '<strong>Обмен жетонов для 5-6го уровня:</strong> <Br />1 Жетон за 3 Гайки или 1 Болт, или 3 Жетона за 1 Вентиль<Br /><strong>для 7 уровня:</strong><Br />1 Жетон за  9 Гаек или 3 Болта, или за 1 Вентиль <Br /><strong>для 8го и старше уровня:</strong><Br />1 Жетон за  15 Гаек или 5 Болтов, или 3 Жетона за 5 Вентилей <Br />Нужны для покупки вещей в магазине <strong>Канализации</strong>.'
		},
	 mater_coin_lvl5_reward:{
				name: 'Серебряный жетон P',
				src: imP3 + 'mater_coin_lvl5_reward.gif',
				recipes: null,
				descr: '<strong>Обмен жетонов для 5-6го уровня:</strong> <Br />1 Серебряный Жетон за 3 Чистые Гайки  или 1 Длинный Болт, <Br />или 3 Серебряный Жетона за 1 Чистый Вентиль<Br /><strong>для 7 уровня:</strong><Br />1 Серебряный Жетон за  9 Чистых Гаек или 3 Длинных Болта, или за 1 Чистый Вентиль <Br /><strong>для 8го и старше уровня:</strong><Br />1 Серебряный Жетон за 15 Чистых Гайек  или 5 Длинных Болтов, <Br />или 3 Серебряных Жетона за 5 Чистых Вентилей<Br />Нужны для покупки вещей в магазине <strong>Канализации</strong>.'
		},
	 mater_coin_lvl6_reward:{
				name: 'Золотой жетон F',
				src: imP3 + 'mater_coin_lvl6_reward.gif',
				recipes: null,
				descr: '<strong>Обмен жетонов для 5-6го уровня:</strong> <Br />1 Золотой Жетон за 3 Гайки с резьбой  или 1 Болт Нужный, <Br />или 3 Золотых Жетона за 1 Вентиль Рабочий<Br /><strong>для 7 уровня:</strong><Br />1 Золотой Жетон за  9 Гаек с резьбой или 3 Нужных Болта, или за 1 Рабочий Вентиль <Br /><strong>для 8го и старше уровня:</strong><Br />1 Золотой Жетон за 15 Гаек с Резьбой  или  5 Болтов  Нужных, <Br />или  3 Золотых Жетона за 5 Вентилей Рабочих<Br />или  3 Золотых Жетона за Вантуз<Br />или  3 Золотых Жетона за 33 Засора<Br />Нужны для покупки вещей в магазине <strong>Канализации</strong>.'
		} 
 };



 var gg ={
 cure3_7:{
				name: 'Лечение тяжелых травм F',
				src: imP3 + 'cure3_7.gif',
				descr: 'Масса: 1<br />Цена: 1 кр.<br />Долговечность: 0/5<br /> Требуется минимальное: <br />• Уровень: 6  <br /><strong>Описание:</strong>Исцеляет травмы. <br />Можно найти в <strong>Кучах мусора</strong>'
		},  
		cureHP45:{
				name: 'Восстановление энергии +45HP F',
				src: imP3 + 'cureHP45.gif',
				descr: 'Масса: 1 <br />Цена: 4 кр. <br />Долговечность: 0/1<br />Требуется минимальное: <br />• Уровень: 4<br />Можно найти в <strong>Кучах мусора</strong> ',
				recipes: null
		},
		cureHP60:{
				name: 'Восстановление энергии +60HP F',
				src: imP3 + 'cureHP60.gif',
				descr: 'Масса: 1 <br />Цена: 4 кр. <br />Долговечность: 0/1<br />Требуется минимальное: <br />• Уровень: 4<br />Можно найти в <strong>Кучах мусора</strong> ',
				recipes: null
		},
pot_cureHP150_0:{ name: 'Заживляющая Настойка F',city: 7, src: imP3 + 'pot_cureHP150_0.gif',
  descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 2 кр.<br />Долговечность: 0/10<br />Срок годности: 30 дн. <br /><strong>Требуется минимальное:</strong><br />&bull; Уровень: 7<br />&bull; Местоположение: пещеры<br /><strong>Описание:</strong><br />Зелье, смешанное из мха, грибочков и хлюпов, богато витаминами. Восстанавливает 150 здоровья, использовать можно только в темноте подземелий. <br />Можно купить у Мухатора или выбить с ботов'
		}, 
pot_cureHP300_0:{ name: 'Заживляющий Эликсир F',city: 7, src: imP3 + 'pot_cureHP300_0.gif',
  descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 5 кр.<br />Долговечность: 0/10<br />Срок годности: 30 дн. <br /><strong>Требуется минимальное:</strong><br />&bull; Уровень: 8<br />&bull; Местоположение: пещеры<br /><strong>Описание:</strong><br />Зелье, смешанное из трав, мха, грибочков и хлюпов, богато витаминами и минералами. Восстанавливает 300 здоровья, использовать можно только в темноте подземелий. <br />Можно купить у Мухатора или выбить с ботов'
		}, 
invoke_maxhp_gg:{ name: 'Настойка на грибах F',city: 7, src: imP3 + 'invoke_maxhp_gg.gif',
  descr: 'Масса: 1<img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 1 кр.<br />Долговечность: 0/5<br />Срок годности: 3 дн.<br /><strong>Наложены заклятия:</strong> Восстановление жизненных сил<br /><strong>Описание:</strong><br />Странный вкус, странный запах, восстанавливает жизненные силы.<br />Можно найти в Кучах мусора, Чудодейственной луже'
  },
invoke_gg_fastmove:{ name: 'Зелье Грибницы F',city: 3, src: imP3 + 'invoke_gg_fastmove.gif',
	 descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 1 кр. <br />Долговечность: 4/5<br />Срок годности: 30 дн. <br /><strong>Требуется минимальное:</strong><br />• Уровень: 7<br />• Местоположение: Грибница<br />Наложено заклятье: Ускорение<br /><strong>Описание:</strong><br />Зелье с резким, отталкивающим запахом. По уверениям, должно ускорять передвижение по грибнице'
		},
gg_3rd_key:{ name: 'Феромоны - пропуск на третий этаж Грибницы F',city: 7, src: imP3 + 'gg_3rd_key.gif',
	 descr: 'Масса: 0.1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><img src="'+d4+'" alt="'+d5+'"/><br />Долговечность: 0/1<br />Срок годности: 7 дн.<br /><strong>Описание:</strong><br />Флакончик выглядит так, как будто выдувал страдающих астмой стеклодув. Жидкость внутри совершенно без запаха.<br />Ключ позволяет переместиться сразу от точки входа первого этажа (нажать на чёрного светляка), на третий.<br />Ключ можно приобрести за грибочки у Шизожука.'
		},
pot_anti_poison_3:{ name: 'Почки Палочника F',city: 7, src: imP3 + 'pot_anti_poison_3.gif',
	 descr: 'Масса: 1 <br />Цена: 1 кр.<br />Долговечность: 0/4<br />Срок годности: 20 дн.<br /><strong>Требуется минимальное:</strong><br />Местоположение: пещеры<br /><strong>Описание:</strong><br />Пахнет неприятно, но яды лечит отменно<br />Падает с Палочников'
		}, 
	pot_anti_disease_3:{ name: 'Печень Гусиница F',city: 7, src: imP3 + 'pot_anti_disease_3.gif',
	 descr: 'Масса: 1<br />Цена: 1 кр.<br />Долговечность: 0/4<br />Срок годности: 20 дн.<br /><strong>Требуется минимальное:</strong><br />Местоположение: пещеры<br /><strong>Описание:</strong><br />На вид не очень, но хорошо лечит болезни.<br />Падает с Гисиниц'
		},        
pot_curemana250_0:{name:'Флакончик маны F',src: imP3 + 'pot_curemana250_0.gif',
	 descr:'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 2 кр.<br />Долговечность: 0/10<br />Срок годности: 30 дн. <br /><strong>Требуется минимальное:</strong><br />• Уровень: 4<br />• Местоположение: пещеры<br /><strong>Описание:</strong><br />Заботливо наполнен небольшим количеством магии. Восстанавливает 250 магической энергии, использовать можно только в темноте подземелий.<br />Падает с ботов'
		}, 
pot_curemana500_0_gg:{name:'Склянка Сладковатой жижи F',src: imP3 + 'pot_curemana500_0_gg.gif',
	 descr:'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 1 кр.<br />Долговечность: 0/1<br />Срок годности: 3 дн.  <strong>Описание:</strong><br />Полезное снадобье из Грибницы, восстанавливающее 500 единиц маны. Привкус плесени и запах перегноя не оставят вас равнодушными.<br />Падает с ботов'
		}, 
gg_order_half:{ name: 'Испорченное Разрешение Грибницы F',city: 7, src: imP3 + 'gg_order_half.gif',
	 descr: 'Масса: 0.1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Может быть, его можно еще исправить?<br />С помощью Магической коробки преобразуется у "Хищнеца" в Разрешение Грибницы.'
		},
gg3_magic_box:{ name: 'Магическая коробка EF', src: imP3 + 'gg3_magic_box.gif',
	 descr: 'Масса: 0.1 <img src="'+d4+'" alt="'+d5+'"/><br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Вокруг этой коробки ощущается присутствие довольно сильной магии. Но открыть вы её не можете, как не старались.<br />При наличии этой коробки и Испорченного Разрешения Грибницы, "Хищнец" даст вам Разрешение Грибницы.'
		},
gg_order_full:{ name: 'Разрешение Грибницы EF',city: 7, src: imP3 + 'gg_order_full.gif',
	 descr: 'Масса: 0.1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br /><strong>Описание:</strong><br />...<br />Необходимо для покупки вещей у Грибоеда.'
		}, 
gg_right_key:{ name: 'Половинка камня VF',city: 7, src: imP3 + 'gg_right_key.gif',
	 descr: '<br />Масса: 0.1<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Обломок камня. Когда-то был подозрительно правильной формы.<br />Падает с Ужаса.'
		},
gg_left_key:{ name: 'Половинка камня VF',city: 7, src: imP3 + 'gg_left_key.gif',
	 descr: '<br />Масса: 0.1<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Обломок камня. Когда-то был подозрительно правильной формы.<br />Падает с Макропуса.'
		},
gg_full_key:{ name: 'Камень-ключ EF',city: 7, src: imP3 + 'gg_full_key.gif',
	 descr: '<br />Масса: 0.1<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />По слухам, открывает сундук. Какой - неизвестно. '
		},
gg_reward1:{ name: 'Вечный Гриб F', src: imP3 + 'gg_reward1.gif', recipes: null,
	 descr: '<br />Цена: 0,1 кр.<br />Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 3/7<br />Вероятность срабатывания: 70%<br /><strong>Требуется минимальное:</strong><br />• Уровень: 8<br />• Выносливость: 15<br />Встроено заклятие <img src="'+imP3+'cureHP600.gif" alt="Великое восстановление энергии"/> 2 шт. в сутки <br /><strong>Описание:</strong><br />Он долго служил Мудрому Гусеницу<br />Награда за выполнение рыцарского задания в Грибнице.'
		},
ring0931:{ name: 'Кольцо корней VF',city: 7, src: imP3 + '6/ring0931.gif',
	 descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 121 кр.<br />Долговечность: 0/43<br />Предмет для воина<br /><strong>Требуется минимальное:</strong><br />• Уровень: 9<br />• Выносливость: 25<br /><strong>Действует на:</strong><br />• Мф. мощности урона: +5<br />• Уровень жизни (HP): +80<br />• Сила: +5<br />Сделано в Грибнице<br />  Можно выловить в яме у Хищнеца.'
		},
ring0932:{ name: 'Кольцо ветвей VF',city: 7, src: imP3 + '6/ring0932.gif',
	 descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 121 кр.<br />Долговечность: 0/43<br />Предмет для стрелка<br /><strong>Требуется минимальное:</strong><br />• Уровень: 9<br />• Выносливость: 25<br /><strong>Действует на:</strong><br />• Мф. мощности урона: +5<br />• Ловкость: +5<br />• Уровень жизни (HP): +40<br />• Уровень маны: +40<br />Сделано в Грибнице<br />  Можно выловить в яме у Хищнеца.'
		},
ring0933:{ name: 'Кольцо трав VF',city: 7, src: imP3 + '6/ring0933.gif',
	 descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 121 кр.<br />Долговечность: 0/43<br /><strong>Требуется минимальное:</strong><br />• Уровень: 9<br />• Выносливость: 25<br /><strong>Действует на:</strong><br />• Защита от магии: +19<br />• Защита от урона: +19<br />• Уровень жизни (HP): +80<br />Сделано в Грибнице<br />  Можно выловить в яме у Хищнеца.'
		},
ring0934:{ name: 'Кольцо мха VF',city: 7, src: imP3 + '6/ring0934.gif',
	 descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 121 кр.<br />Долговечность: 0/43<br /><br />Предмет для мага<br /><strong>Требуется минимальное:</strong><br />• Уровень: 9<br />• Выносливость: 25<br /><strong>Действует на:</strong><br />• Мф. мощности магии стихий: +5<br />• Интеллект: +5<br />• Уровень жизни (HP): +40<br />• Уровень маны: +40<br />Сделано в Грибнице<br />  Можно выловить в яме у Хищнеца.'
		},
ring0941:{ name: 'Древнее Кольцо Корней EF',city: 7, src: imP3 + '6/ring0941.gif',
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 121 кр.<br />Долговечность: 0/45<br />Предмет для стрелка<br /><strong>Требуется минимальное:</strong><br />• Уровень: 9<br />• Выносливость: 25<br /><strong>Действует на:</strong><br />• Мф. мощности урона: +6<br />• Сила: +6<br />• Уровень жизни (HP): +80<br />Сделано в Грибнице<br />  для получения необходимы: Кольцо Ветвей+Магическая коробка улучшется у Хищнеца.'
		}, 
	ring0942:{ name: 'Древнее Кольцо Ветвей EF',city: 7, src: imP3 + '6/ring0942.gif',
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 121 кр.<br />Долговечность: 0/45<br />Предмет для стрелка<br /><strong>Требуется минимальное:</strong><br />• Уровень: 9<br />• Выносливость: 25<br /><strong>Действует на:</strong><br />• Мф. мощности урона: +6<br />• Ловкость: +6<br />• Уровень жизни (HP): +40<br />• Уровень маны: +40<br />Сделано в Грибнице<br />  для получения необходимы: Кольцо Ветвей+Магическая коробка улучшется у Хищнеца.'
		}, 
	ring0943:{ name: 'Древнее Кольцо Трав VF',city: 7, src: imP3 + '6/ring0943.gif',
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 121 кр.<br />Долговечность: 0/43<br /><strong>Требуется минимальное:</strong><br />• Уровень: 9<br />• Выносливость: 25<br /><strong>Действует на:</strong><br />• Защита от магии: +19<br />• Защита от урона: +19<br />• Уровень жизни (HP): +100<br />Сделано в Грибнице<br />  Можно выловить в яме у Хищнеца.'
		},
	ring0944:{ name: 'Древнее Кольцо Трав VF',city: 7, src: imP3 + '6/ring0944.gif',
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 121 кр.<br />Долговечность: 0/43<br /><strong>Требуется минимальное:</strong><br />• Уровень: 9<br />• Выносливость: 25<br /><strong>Действует на:</strong><br />Сделано в Грибнице<br />  Можно выловить в яме у Хищнеца.'
		},

	 gg3_suv_grib1:{
				name: 'Светящийся гриб',
				src: imP3 + 'gg3_suv_grib1.gif', recipes: {'gg3_hishn_kolch': 2},
				descr: 'Масса: 0.1 <br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Гриб синего цвета, при его свете можно даже читать. Ухаживать осторожно, поливать как придется.<br /> - просто сувенир, можно дарить через гос.маг. долговечность подарка 180 дн. '
		},
	 gg3_suv_grib2:{
				name: 'Светящийся гриб',
				src: imP3 + 'gg3_suv_grib2.gif', recipes: {'gg3_hishn_kolch': 2},
				descr: 'Масса: 0.1 <br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Гриб синего цвета, при его свете можно даже читать. Ухаживать осторожно, поливать как придется.<br /> - просто сувенир, можно дарить через гос.маг. долговечность подарка 180 дн. '
		},
	 gg3_suv_grib3:{
				name: 'Светящийся гриб',
				src: imP3 + 'gg3_suv_grib3.gif', recipes: {'gg3_hishn_kolch': 2},
				descr: 'Масса: 0.1 <br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Гриб синего цвета, при его свете можно даже читать. Ухаживать осторожно, поливать как придется.<br /> - просто сувенир, можно дарить через гос.маг. долговечность подарка 180 дн. '
		},
	 gg3_suv_insect_f:{
				name: 'Насекомое в смоле',
				src: imP3 + 'gg3_suv_insect_f.gif', recipes: {'gg3_hishn_dosp': 2},
				descr: 'Масса: 0.1 <br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Цветная смола, в которой, когда-то, давным-давно, застряло насекомое.<br /> - просто сувенир, можно дарить через гос.маг. долговечность подарка 180 дн.<br /><strong>Требуется:<img src="'+imP3+'gg3_hishn_dosp.gif" alt="Обломок доспеха"/> х2</strong>'
		},
	 gg3_suv_insect_m:{
				name: 'Насекомое в смоле',
				src: imP3 + 'gg3_suv_insect_m.gif',  recipes: {'gg3_hishn_sword': 2},
				descr: 'Масса: 0.1 <br />Долговечность: 0/1<br /><strong>Описание:</strong><br /><br /> - просто сувенир, можно дарить через гос.маг. долговечность подарка 180 дн. '
		},
	 gg3_suv_civiar:{
				name: 'Шар с непонятным содержимым',
				src: imP3 + 'gg3_suv_civiar.gif', recipes: {'gg3_hishn_finger': 2},
				descr: 'Масса: 0.1 <br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Упругий прозрачный шар, внутри которого что-то переливается всеми цветами радуги.<br /> - просто сувенир, можно дарить через гос.маг. долговечность подарка 180 дн. '
		},
	 gg3_suv_orchid:{
				name: 'Невянущий цветок',
				src: imP3 + 'gg3_suv_orchid.gif', recipes: {'gg3_hishn_kolch': 2,'gg3_hishn_dosp': 2},
				descr: 'Масса: 0.1 <br />Долговечность: 0/1<br /><strong>Описание:</strong><br /><br /> - просто сувенир, можно дарить через гос.маг. долговечность подарка 180 дн. '
		},
  gg3_suv_horn1:{
   	name: 'Жвалы',
   	src: imP3 + 'gg3_suv_horn1.gif', recipes: {'gg3_hishn_sword': 2,'gg3_hishn_finger': 2},
    descr: 'Масса: 0.1 <br />Долговечность: 0/1<br /><strong>Описание:</strong><br /><br /> - просто сувенир, можно дарить через гос.маг. долговечность подарка 180 дн.'
  },
  gg3_suv_horn2:{
   	name: 'Жвалы',
   	src: imP3 + 'gg3_suv_horn2.gif', recipes: {'gg3_hishn_sword': 2,'gg3_hishn_finger': 2},
    descr: 'Масса: 0.1 <br />Долговечность: 0/1<br /><strong>Описание:</strong><br /><br /> - просто сувенир, можно дарить через гос.маг. долговечность подарка 180 дн.'
  },
  gg3_hishn_bone:{
				name: 'Кость',
				src: imP3 + 'gg3_hishn_bone.gif',
				descr: 'Масса: 0.1 <img src="'+d4+'" alt="'+d5+'"/><br />Долговечность: 0/1<br /><strong>Описание:</strong><br />При всем вашем знании анатомии вас успокаивает мысль, что это кость не человеческая.<br />Выужена с Воронки, зачем нужна - хз ))'
		},  

  gg3_mak_grib:{
				name: 'Кусочек гриба',
				src: imP3 + 'gg3_mak_grib.gif',
				descr: 'Масса: 0.1 <img src="'+d4+'" alt="'+d5+'"/><br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Кусочек гриба, крепкий как деревяшка.<br />  - квестовый предмет, описание квестов <A href="http://www.darkclan.ru/cgi/lib.pl?p=mushrooms" TARGET="_blank"><U>читаем тут</U></A>.'
		}, 
gg3_mak_bottle_empty:{name: 'Пустая бутыль F',src: imP3 + 'gg3_mak_bottle_empty.gif',
				descr:'Масса: 0.1 <img src="'+d4+'" alt="'+d5+'"/><br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Обычная пустая бутылка. Ничего интересного нет. Правда-правда.<br />Квестовый предмет, описание квестов <A href="http://www.darkclan.ru/cgi/lib.pl?p=mushrooms" TARGET="_blank"><U>читаем тут</U></A>'
		},
	 gg3_mak_bottle:{
				name: 'Бутылка с плохопахнущей жидкостью',
				src: imP3 + 'gg3_mak_bottle.gif',
				descr: 'Масса: 0.1 <img src="'+d4+'" alt="'+d5+'"/><br />Долговечность: 0/1<br />Срок годности: 0.006 дн.(10 минут)<br /><strong>Описание:</strong><br />Бутылка с жидкостью, которую вы набрали в колодце.<br /> - квестовый предмет, описание квестов <A href="http://www.darkclan.ru/cgi/lib.pl?p=mushrooms" TARGET="_blank"><U>читаем тут</U></A>'
		},
	 gg3_mak_shtuk:{
				name: 'Непонятная штуковина',
				src: imP3 + 'gg3_mak_shtuk.gif',
				descr: 'Масса: 0.1 <img src="'+d4+'" alt="'+d5+'"/><br />Долговечность: 0/1<br /> - квестовый предмет, описание квестов <A href="http://www.darkclan.ru/cgi/lib.pl?p=mushrooms" TARGET="_blank"><U>читаем тут</U></A>'
		},
	 invoke_gg3_mak_ferom:{
				name: 'Клейкое вещество',
				src: imP3 + 'invoke_gg3_mak_ferom.gif',
				descr: 'Масса: 0.1 <img src="'+d4+'" alt="'+d5+'"/><br />Долговечность: 0/1<br />Наложено заклятье: Запах насекомого<br /> - квестовый предмет, описание квестов <A href="http://www.darkclan.ru/cgi/lib.pl?p=mushrooms" TARGET="_blank"><U>читаем тут</U></A>'
		},
	 gg3_shiz_crystal:{
				name: 'Черный кристалл',
				src: imP3 + 'gg3_shiz_crystal.gif',
				descr: 'Масса: 0.1 <img src="'+d4+'" alt="'+d5+'"/><br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Ранее принадлежал глубинному гусеницу.<br />На выходе исчезает, с ним можно пройти мимо рогоносца.<br /> - квестовый предмет, описание квестов <A href="http://www.darkclan.ru/cgi/lib.pl?p=mushrooms" TARGET="_blank"><U>читаем тут</U></A>'
		}  
};

var stb ={
		token23soldier:{
				name: 'Жетон «Рядовой армии Общего Врага»',
				src: imP3 + 'token23soldier.gif',
				descr: '<BR />Масса: 0.1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><BR />Долговечность: 0/1<BR />Сделано в Логово Общего Врага<BR />Обмениваются у "Сержанта".',
    recipes: null
		},
		token23command:{
				name: 'Жетон «Командир армии Общего Врага»',
				src: imP3 + 'token23command.gif',
				descr: '<BR />Масса: 0.1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><BR />Долговечность: 0/1<BR />Сделано в Логово Общего Врага<BR />Обмениваются у "Сержанта".',
    recipes: null
		},
		ring0431:{
				name: 'Героическое кольцо',
				src: imP3 + '6/ring0431.gif',
				descr: 'Масса: 1 <img src="'+d4+'" alt="'+d5+'"/><br />Цена: 62 кр. <br />Долговечность: 0/50 <br /><strong>Требуется минимальное:</strong><br />• Уровень: 4 <br /><strong>Действует на:</strong><br />• Уровень жизни (HP): +100 <br />Максимум: 1 ед. <br />Сделано в Abandoned Plain<br />Можно обменять у "Сержанта" в "Сторожевой Башне" за 3 жетона командиров и 20 жетонов рядовых. ',
    recipes: null
		},
		cloak0831:{
				name: 'Героический плащ',
				src: imP3 + '17/cloak0831.gif',
				descr: 'Масса: 1 <img src="'+d4+'" alt="'+d5+'"/><br />Цена: 100 кр. <br />Долговечность: 0/60<br /><strong>Требуется минимальное:</strong><br />• Уровень: 8<br /><strong>Действует на:</strong><br />• Уровень жизни (HP): +6<br />Максимум: 1 ед.<br />Сделано в Abandoned Plain<br />Можно обменять у "Сержанта" в "Сторожевой Башне" за 5 жетонов командиров и 30 жетонов рядовых. ',
    recipes: null
		},
	 cloak1031:{
				name: 'Очень героический плащ',
				src: imP3 + '17/cloak1031.gif',
				descr: 'Масса: 1 <img src="'+d4+'" alt="'+d5+'"/><br />Цена: 300 кр.<br />Долговечность: 0/60<br /><strong>Требуется минимальное:</strong><br />• Уровень: 10<br /><strong>Действует на:</strong><br />• Ловкость: +1<br />• Интуиция: +1<br />• Интеллект: +1<br />• Уровень жизни (HP): +6<br />• Сила: +1<br />Максимум: 1 ед. <br />Сделано в Abandoned Plain<br />Можно обменять у "Сержанта" в "Сторожевой Башне" за 10 жетонов командиров и 45 жетонов рядовых. ',
    recipes: null
		}
};

/*
var tn ={
 
};
 
var izl ={
}; 

var gl ={ 
		pot_anti_disease_5_1:{
				name: 'Сыворотка [5]',
				src: imP3 + 'pot_anti_disease_5.gif',
				descr: 'Масса: 1<br />Долговечность: 0/5 (0/4, 0/3) <br />Цена: 1 кр. <br /><strong>Наложены заклятия:</strong><br />• Исцеление <br /><strong>Описание:</strong><br />• Исцелит вас от многих болезней. <br /> - может упасть с ботов'
			},
		food_l8_2:{
				name: 'Бутерброд -Завтрак Рыцаря- толстый',
				src: imP3 + 'food_l8.gif',
				descr: 'Масса: 1 <br />Цена: 4 кр. <br />Долговечность: 0/4<br />Срок годности: 15 дн. <br />Продолжительность действия магии: 3 ч. <br /><strong>Требуется минимальное:</strong><br />• Уровень: 8<br />• Невозможно использовать хаосникам<br /><strong>Действует на:</strong><br />• Уровень жизни (HP): +180<br /> .'
			},

  gl_token:{
				name: 'Золотой прун',
				src: imP3 + 'gl_token.gif',
				recipes: null,
				descr: 'Масса: 0.1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><BR>Долговечность: 0/1<BR>Валюта ГЛ. Можно выбить с любого бота, получить за выполнение заданий, требуется для оплаты различных услуг по квестам.'
		},
  gl_golem:{
				name: 'Запчасти от Голема',
				src: imP3 + 'gl_golem.gif',
				recipes: null,
				descr: 'Масса: 0.1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><BR>Долговечность: 0/1<BR> Квестовый предмет. Падает с Молодых Големов, нужны Фермеру Ивану.'
		},
  gl_meat:{
				name: 'Мясо Букашки',
				src: imP3 + 'gl_meat.gif',
				recipes: null,
				descr: 'Масса: 0.1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><BR>Долговечность: 0/1<BR>Квестовый предмет, берется у Фермера Ивана, для Каркаша.'
		},
  pot_gl_smazka:{
				name: 'Тюбик со смазкой',
				src: imP3 + 'pot_gl_smazka.gif',
				recipes: null,
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><BR>Цена: 4 кр.<BR>Долговечность: 0/1<BR>Срок годности: 30 дн.<BR>Продолжительность действия магии: 20 мин.<BR><strong>Описание:</strong><BR>Предназначена ТОЛЬКО для смазки механизмов.Внутрь НЕ принимать!!!<BR>Квестовый предмет, берется у Гаечного Ключа для смазки Сердца Горы.'
		},
  food_gl_samogon:{
				name: 'Настойка на жучьей требухе',
				src: imP3 + 'food_gl_samogon.gif',
				recipes: null,
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><BR>Цена: 1.5 кр.<BR>Долговечность: 0/1<BR>Срок годности: 30 дн.<BR>Продолжительность действия магии: 1 ч. 0 мин.<BR><strong>Требуется минимальное:</strong><BR>• Уровень: 8<BR>• Выносливость: 25<BR><strong>Действует на:</strong><BR>• Мф. мощности магии стихий: +10<BR>• Мф. мощности урона: +10<BR>• Интуиция: -3<BR>• Интеллект: -3<BR>Берется у Фермера Ивана + может упасть с ботов.'
		},
   gl_matkahead:{
				name: 'Голова Жучьей Матки',
				src: imP3 + 'gl_matkahead.gif',
				recipes: null,
				descr: 'Масса: 0.1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><BR>Долговечность: 0/1<BR><strong>Описание:</strong><BR>Гаечный Ключ будет безмерно счастлив, увидев эту голову!<BR>Квестовый предмет, падает после смерти Жучьей Матки, надо отнести Гаечному Ключу.'
		},
   gl_zomb_kusok:{
				name: 'Часть глубинного зомби',
				src: imP3 + 'gl_zomb_kusok.gif',
				recipes: null,
				descr: 'Масса: 0.1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><BR>Долговечность: 0/1<BR><strong>Описание:</strong><BR> Падет с глубинного зомби, иногда с мародеров.<BR>Требуется по заданию от Начальника Внешней Охраны.За 15 кусков - 15ед. репутации.<BR> - Можно сдавать до репутации в 10000'
		},
   gl_gusa_meat:{
				name: 'Сочный оковалок',
				src: imP3 + 'gl_gusa_meat.gif',
				recipes: null,
				descr: 'Масса: 0.1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><BR>Долговечность: 0/1<BR><strong>Описание:</strong><BR>Сочный оковалок "Ранее принадлежал глубинному гусеницу"<BR> Падет с глубинного гусеница.<BR>Требуется по заданию от Мясника. За 30 кусков - 45ед. репутации.<BR> - Можно сдавать до репутации в 10000'
		},

	 gl_mara_docs:{
				name: 'Поддельный аусвайс',
				src: imP3 + 'gl_mara_docs.gif',
				descr: 'Масса: 0.1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Искусно сделанный Брутом приказ о вашем зачислении в мародерские патрульные отряды.<br />Непонятная дата, неразборчивая подпись.<br />Необходим для выполнения задания: "Раздобыть документ о приеме на службу. 0/1"<br />для изготовления необходима "бумага 200" и 25 кр, а так же комплект Мародера, иначе Брут не будет говорить об этом.'
		},
	 gl_mara_ley_history:{
				name: 'Прошлое Лейтенанта',
				src: imP3 + 'gl_mara_ley_history.gif',
				descr: '<br />Масса: 0.1 <br />Долговечность: 0/1 <br /><strong>Описание:</strong><br />Документы, утверждающие право человека по имени Крой де Асс на владение фамильным замком отца.'
		},
	 gl_seymos:{
				name: 'Печать Сеймоса',
				src: imP3 + 'gl_seymos.gif',
				descr: 'Масса: 0.1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br />Задание от Эмисара, берется у Сеймоса.'
		},
	 rune_super_500:{
				name: 'Антикус Пентако',
				src: imP3 + 'rune_super_500.gif',
				descr: 'Масса: 1 <br />Цена: 25 кр.<br />Долговечность: 0/1<br /><strong>Требуется минимальное:</strong><br />• Уровень: 7<br /><strong>Действует на:</strong><br />• Уровень жизни (HP): +100<br /><strong>Описание:</strong><br />Этой руной можно улучшить предмет<br />Эмисар дает в награду за выполнение задания на Печать Сеймоса.'
		},
	 gl_stonekey_green:{
				name: 'Зеленый Ключ-камень',
				src: imP3 + 'gl_stonekey_green.gif',
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br /> - 1. Получить можно у "Часового", купив за 4 Золотых или украсть или бесплатно имея 2 вещи комплекта Мародера<br /> - 2. у "Охранника", купив за 5 Золотых. При выходе исчезает.'
		},
	 gl_stonekey_yellow:{
				name: 'Желтый Ключ-камень',
				src: imP3 + 'gl_stonekey_yellow.gif',
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br />Получить можно у "Начальник Внешней Охраны", при наличии 2 вещей комплекта Мародера и имея репутацию Лагеря Мародеров. При выходе исчезает.'
		},
	 gl_stonekey_red:{
				name: 'Красный Ключ-камень',
				src: imP3 + 'gl_stonekey_red.gif',
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br />При выходе исчезает. Берется у Лейтенанта при репутации в 8000.'
		},
	 gl_stonekey_blue:{
				name: 'Синий Ключ-камень',
				src: imP3 + 'gl_stonekey_blue.gif',
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Долговечность: 0/1<br />Эмисар дает в награду за выполнение задания на Печать Сеймоса, не пропадает.'
		},
	 ko_sign:{
				name: 'Знак Кровавого Ордена',
				src: imP3 + 'ko_sign.gif',
				descr: 'Масса: 0.1<br />Долговечность: 0/1<br />Эмисар дает в награду за выполнение задания на Печать Сеймоса, не пропадает.<br />Позволяет пройти за решетку (у входа на 1м этаже) и перенестись сразу в клетку <b>V11</b>.'
		},
	 gl_mara_hood:{
				name: 'Шлем Мародера',
				src: imP3 + 'gl_mara_hood.gif',
				descr: 'Масса: 2 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 3 кр.<br />Долговечность: 0/50<br /><strong>Действует на:</strong><br />•Мф. увертывания (%): +25<br />•Мастерство владения ножами, кастетами: +1<br />• Часть комплекта: Маскировочный комплект Мародера [0/2]<br /><font color=#990000>Предмет не подлежит ремонту</font><br />Комплект необходим для прохода в "город" на 2м этаже, падает с Мародеров иногда с зомби.'
		},
  gl_mara_cloak:{
				name: 'Маскировочный плащ Мародера',
				src: imP3 + 'gl_mara_cloak.gif',
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 20 кр.<br />Долговечность: 0/50<br /><strong>Действует на:</strong><br />• Мф. против критического удара (%): +25<br />• Мф. увертывания (%): +50<br />• Сила: -5<br />• Часть комплекта: Маскировочный комплект Мародера [0/2]<br /><font color=#990000>Предмет не подлежит ремонту</font><br />Комплект необходим для прохода в "город" на 2м этаже, падает с Мародеров иногда с зомби.'
		},
  gl_mara_leycloak:{
				name: 'Плащ Лейтенанта Мародеров',
				src: imP3 + 'gl_mara_leycloak.gif',
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 40 кр.<br />Долговечность: 0/50<br /><strong>Требуется минимальное:</strong><br />• Уровень: 10<br /><strong>Действует на:</strong><br />• Мф. против критического удара (%): +15<br />• Мф. увертывания (%): +15<br />• Уровень жизни (HP): +10 <br />Лежит в сундуке за Лейтенантом.'
		},
 
	 gl_werewolf:{
				name: 'Шкура Рвуна',
				src: imP3 + 'gl_werewolf.gif',
				descr: 'Масса: 1 <img style="'+d1+'" src="'+d2+'" alt="'+d3+'"/><br />Цена: 49 кр.<br />Долговечность: 0/50<br /><strong>Требуется минимальное:</strong><br />• Уровень: 10<br /><strong>Действует на:</strong><br />• Мф. мощности крит. удара (%): +3<br />• Мф. мощности урона (%): +3<br /><strong>Описание:</strong> <br />Все, что осталось от страшного оборотня.<br /><font color=#990000>Предмет не подлежит ремонту.</font>'
		},

	 invoke_plain_gl_dogcall:{
				name: 'Призвать Тоннельную Гончую',
				src: imP3 + 'invoke_plain_gl_dogcall.gif',
				descr: 'Долговечность: 0/1<br />• Мгновенное заклинание<br /><strong>Наложено заклятье:</strong> Вызвать Гончую<br />Может упасть с Мародер Потрошитель. "Этот прием используется только в бою".'
		},
	 invoke_gl_sosiska:{
				name: 'Мясная Радость',
				src: imP3 + 'invoke_gl_sosiska.gif',
				descr: 'Масса: 1<br />Долговечность: 0/1<br />• Мгновенное заклинание<br />Наложено заклятье: <strong>Подкормить</strong> (Сытая собака (прием) - Животное с удовольствием съело ваше угощение. Сытое и довольное, оно атакует намного слабее.) <br /><strong>Описание:</strong><br />Сочная, жирная. Используется для тренировки Тоннельных Гончих.<br />Сделано в Мясная лавка<br />  - используется из кармана, на Тонельную Гончую или Рвуна.'
		},
	 cure3:{
				name: 'Лечение тяжелых травм',
				src: imP3 + 'cure3.gif',
				descr: 'Масса: 1<br />Цена: 4 кр. <br />Долговечность: 0/2<br />Вероятность срабатывания: 50%<br /><strong>Требуется минимальное:</strong><br />• Интеллект: 12<br />• Уровень: 6<br /> - Букашка может дать в обмен на Чугунную Уточку'
		}, 
	 note:{
				name: 'Записки комментатора',
				src: imP3 + 'note.gif',
				descr: 'Масса: 1<br />Цена: 2 кр. <br />Долговечность: 0/10<br />Вероятность срабатывания: 99%<br /><strong>Требуется минимальное:</strong><br />• Интеллект: 5<br />• Уровень: 6<br /> - Букашка может дать в обмен на Чугунную Уточку'
		},
		'd_blat-6_1':{
				name: 'Пропуск Забытых',
				src: imP3 + 'd_blat-6.gif',
				descr: 'Позволяет пройти в подземелье на 6 часов раньше. Вероятность срабатывания: 99 %.<br />Можно выбить из ботов, вяжется',
				recipes: null
		},
	 invoke_tactics5:{
				name: 'Различные тактики',
				src: imP3 + 'invoke_tactics5.gif',
				descr: 'Масса: 1<br />Долговечность: 0/1<br />Можно выбить из ботов различные тактики 1-3, могут вязатся.'
		},
   gl_knife_01:{
				name: 'Таящий могущество кинжал',
				src: imP3 + 'gl_knife_01.gif',
				recipes: null,
				descr: 'Масса:<br />Долговечность: 0/<br /><strong>Требуется минимальное:</strong><br />• Уровень: 15<br /><strong>Описание:</strong><br />Хотя он и предстал перед вами во всем своем великолепии, вы по-прежнему не можете использовать его. Сложно даже представить, сколько сил таит этот предмет, побывавший в Древней Битве.<br />С небольшой вероятностью можно получить у Каркаша при очистке предмета.'
		},
  gl_sword_01:{
				name: 'Таящий могущество меч',
				src: imP3 + 'gl_sword_01.gif',
				recipes: null,
				descr: 'Масса:<br />Долговечность: 0/<br /><strong>Требуется минимальное:</strong><br />• Уровень: 15<br /><strong>Описание:</strong><br />Хотя он и предстал перед вами во всем своем великолепии, вы по-прежнему не можете использовать его. Сложно даже представить, сколько сил таит этот предмет, побывавший в Древней Битве.<br />С небольшой вероятностью можно получить у Каркаша при очистке предмета.'
		},
  gl_2h_sword_01:{
				name: 'Таящий могущество двуручный меч',
				src: imP3 + 'gl_2h_sword_01.gif',
				recipes: null,
				descr: 'Масса:<br />Долговечность: 0/<br /><strong>Требуется минимальное:</strong><br />• Уровень: 15<br /><strong>Описание:</strong><br />Хотя он и предстал перед вами во всем своем великолепии, вы по-прежнему не можете использовать его. Сложно даже представить, сколько сил таит этот предмет, побывавший в Древней Битве.<br />С небольшой вероятностью можно получить у Каркаша при очистке предмета.'
		},
  gl_topor_01:{
				name: 'Таящий могущество здоровый топор',
				src: imP3 + 'gl_topor_01.gif',
				recipes: null,
				descr: 'Масса:<br />Долговечность: 0/<br /><strong>Требуется минимальное:</strong><br />• Уровень: 15<br /><strong>Описание:</strong><br />Хотя он и предстал перед вами во всем своем великолепии, вы по-прежнему не можете использовать его. Сложно даже представить, сколько сил таит этот предмет, побывавший в Древней Битве.<br />С небольшой вероятностью можно получить у Каркаша при очистке предмета.'
		},
  gl_bulava_01:{
				name: 'Таящая могущество булава',
				src: imP3 + 'gl_bulava_01.gif',
				recipes: null,
				descr: 'Масса:<br />Долговечность: 0/<br /><strong>Требуется минимальное:</strong><br />• Уровень: 15<br /><strong>Описание:</strong><br />Хотя он и предстал перед вами во всем своем великолепии, вы по-прежнему не можете использовать его. Сложно даже представить, сколько сил таит этот предмет, побывавший в Древней Битве.<br />С небольшой вероятностью можно получить у Каркаша при очистке предмета.'
		},
  gl_molot_01:{
				name: 'Таящий могущество молот',
				src: imP3 + 'gl_molot_01.gif',
				recipes: null,
				descr: 'Масса:<br />Долговечность: 0/<br /><strong>Требуется минимальное:</strong><br />• Уровень: 15<br /><strong>Описание:</strong><br />Хотя он и предстал перед вами во всем своем великолепии, вы по-прежнему не можете использовать его. Сложно даже представить, сколько сил таит этот предмет, побывавший в Древней Битве.<br />С небольшой вероятностью можно получить у Каркаша при очистке предмета.'
		},
  gl_shield_01:{
				name: 'Таящий могущество тяжелый щит',
				src: imP3 + 'gl_shield_01.gif',
				recipes: null,
				descr: 'Масса:<br />Долговечность: 0/<br /><strong>Требуется минимальное:</strong><br />• Уровень: 15<br /><strong>Описание:</strong><br />Хотя он и предстал перед вами во всем своем великолепии, вы по-прежнему не можете использовать его. Сложно даже представить, сколько сил таит этот предмет, побывавший в Древней Битве.<br />С небольшой вероятностью можно получить у Каркаша при очистке предмета.'
		},
  gl_staff_01:{
				name: 'Таящий могущество древний посох',
				src: imP3 + 'gl_staff_01.gif',
				recipes: null,
				descr: 'Масса:5 <br />Долговечность: 0/<br /><strong>Требуется минимальное:</strong><br />• Уровень: 15<br /><strong>Описание:</strong><br />Хотя он и предстал перед вами во всем своем великолепии, вы по-прежнему не можете использовать его. Сложно даже представить, сколько сил таит этот предмет, побывавший в Древней Битве.<br />С небольшой вероятностью можно получить у Каркаша при очистке предмета.'
		},
  gl_clearing_01:{
				name: 'Чугунная Уточка',
				src: imP3 + 'gl_clearing_01.gif',
				recipes: null,
				descr: 'Масса: 0.1 <BR>Долговечность: 0/1<BR>С небольшой вероятностью можно получить у Каркаша при очистке предмета.<BR>Если отдадите ее "Букашке", то получите "Записки коментатора" или свиток лечения тяжелых травм<br />А еще можно подарить через гос. маг. как сувенир.'
		},
  gl_clearing_02:{
				name: 'Чугунная Вилка',
				src: imP3 + 'gl_clearing_02.gif',
				recipes: null,
				descr: 'Масса: 0.1 <BR>Долговечность: 0/1<BR>С небольшой вероятностью можно получить у Каркаша при очистке предмета.'
		},
  gl_clearing_03:{
				name: 'Кривая Ложка',
				src: imP3 + 'gl_clearing_03.gif',
				recipes: null,
				descr: 'Масса: 0.1 <BR>Долговечность: 0/1<BR>С небольшой вероятностью можно получить у Каркаша при очистке предмета.'
		},
  gl_clearing_04:{
				name: 'Гаечный Ключ',
				src: imP3 + 'gl_clearing_04.gif',
				recipes: null,
				descr: 'Масса: 0.1 <BR>Долговечность: 0/1<BR>С небольшой вероятностью можно получить у Каркаша при очистке предмета.'
		},
  gl_clearing_05:{
				name: 'Чугунная Гантеля 2 кг.',
				src: imP3 + 'gl_clearing_05.gif',
				recipes: null,
				descr: 'Масса: 0.1 <BR>Долговечность: 0/1<BR>С небольшой вероятностью можно получить у Каркаша при очистке предмета.'
		},
  gl_clearing_06:{
				name: 'Подшипник Идеальный',
				src: imP3 + 'gl_clearing_06.gif',
				recipes: null,
				descr: 'Масса: 0.1 <BR>Долговечность: 0/1<BR>С небольшой вероятностью можно получить у Каркаша при очистке предмета.<br />Можно подарить через гос.маг. как сувенир.'
		},
	 gl_clearing_07:{
				name: 'Ржавый гвоздь',
				src: imP3 + 'gl_clearing_07.gif',
				descr: 'Масса: 0.1<br />Долговечность: 0/1<br />С небольшой вероятностью можно получить у Каркаша при очистке предмета.'
		},
   gl_mara_treasures:{
				name: 'Украденные сокровища',
				src: imP3 + 'gl_mara_treasures.gif',
				descr: 'Масса: 0.1 <BR>Долговечность: 0/1<BR>Квестовый предмет. Пропадают при выходе.'
		},
	 suven28:{
				name: 'Путевка на два года',
				src: imP3 + 'suven28.gif',
				descr: 'Масса: 1<br />Цена: 15 кр.<br />Долговечность: 0/1<br /><strong>Описание:</strong><br />Загадочная бумажка с надписью «Полный пансион. Увлекательная программа. Спешите! Количество мест ограничено!»<br />Можно подарить или сдать в гос'
		},

	 cards_apr1:{
				name: 'Открытка -От тещи-',
				src: imP3 + 'cards_apr1.gif',
				descr: 'Масса: 1 <br />Цена: 10 кр. <br />Долговечность: 0/1<br />Срок годности: 30 дн.  <br /><strong>Описание:</strong><br />Для неискренних поздравлений и предупреждения о скором визите<br /> появилась в рюкзаке откуда не ясно ))'
		},
	 suven23_7_5:{
				name: 'Подтяжки',
				src: imP3 + 'suven23_7_5.gif',
				descr: 'Масса: 1<BR> Цена: 5 кр.  <BR>Долговечность: 0/1'
		}
 
};
*/

var items = {
"Ингредиенты": maters,
//"Эликсиры":pots,
//"Свитки":scrolls,
//"Свитки тактик": taktiks,
//"Свитки зачарования": charki,
//"Свитки починки": pochin,
//"Уникальные Вещи":rares,
"из ПТП":ptp,
"из пещеры Мглы":pm,
"из Канализации":kanaliz,
"из Грибницы":gg,
"из Сторожевой Башни":stb 
//"из Туманных низин":tn,
//"из Горы Легиона": gl,
//"из Излома Хаоса":izl
};
