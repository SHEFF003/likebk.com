//update 11.01.09 by gram
// JavaScript Document


var baseImgPath = '/new/';
var itemImgPath = '/new/';
var hereItemImgPath = '/images/';
var charImgPath = 'http://img.combats.com/i/chars/';
var clanImgPath = 'http://img.combats.com/i/klan/';
var zodiacImgPath = '/images/dress/z/';
var brandImgPath = 'http://img.combats.com/i/city/brand/';
var brand2ImgPath = 'http://img.combats.com/i/misc/';
var trickResourceImgPath = 'http://img.combats.com/i/misc/micro/';
var hpMeterGreenImg = 'http://img.combats.com/i/misc/bk_life_green.gif';
var manaMeterImg = 'http://img.combats.com/i/misc/bk_life_beg_33.gif';
var trickImgPath = 'http://img.combats.com/i/misc/icons/';
var iconImgPath = '/new/';
var infospaceImgPath = '/images/infospace/';
var dressImgPath = '/images/dress/';
var blankImgPath = '/images/blank.gif';
var toothImgPath = 'http://img.combats.com/i/misc/';

var charInfoUrlFormat = 'http://capitalcity.combats.com/inf.pl?login=';

var shortVip = "vip=1";

var maxPersImageNumber = [51, 65];
var excludePersImageNumbers = [[52, 53], [39, 40, 41, 66, 67, 68]];

var uniquePersImageNumbers = [
	['52_orbvsqq', '53_otnmdih','400','500','501','502','503','504','505','506','507','508','509','510','511','512','513','514','515','516','10001','10002','10003','10015','10016','10017','10018','10019','2000_1_kbns5gu', '2000_3_askgl', '2000_2_zk39s', '1092_mfogweobwg', '1144_fzmyvqf','mocker','piper'],
	['66_mmtvgec', '67_esevjzd', '68_sqsbxnc', '500','501','502','10012','10015','10019','2007_1_onsd23', '2003_1_348723483', '2003_2_854736478', '2003_3_777376934', '2001_1_758375928', '2001_2_387429837', '2001_3_458791823', '2002_1_239847283', '2002_2_238947983', '2002_3_857378582', '2006_1_868276432', '2006_2_394356775', '2006_3_100402842', '2004_1_329847534', '2004_2_465762309', '2004_3_636502175', '2005_1_398365734', '2005_2_546276573', '2005_3_573654968', '1089_gr8562789476', '1093_bninwidpqd']
	];

var localizer =
{
	cancel: 'Отмена',
	apply: 'Применить',
	help: 'Справка',
	helpHint: 'Открыть раздел Справки',
	closeMenu: 'Закрыть меню',
	dropItem: 'Снять предмет',
	dropAll: 'Снять все предметы',
	clearAllStats: 'Сбросить статы и умения',
	fitStats: 'Подогнать статы и умения под комплект',
	itemComsumesGroup: 'Потребление',
	itemRequiredGroup: 'Требования',
	itemModifyGroup: 'Действует на',
	itemPropertiesGroup: 'Свойства предмета',
	itemAddInfoGroup: 'Дополнительная информация',
	itemAttackGroup: 'Особенности (атаки)',
	itemDefenceGroup: 'Особенности (защиты)',
	partOfSet: 'Часть комплекта: <u>{0}</u> <b>({1}/{2})</b>.',
	strikeGroup: 'Удар с помощью',
	fitArmor: 'Подогнать броню',
	unfitArmor: 'Убрать подгонку брони',
	fitObject: 'Подогнать под комплект',
	unfitObject: 'Убрать подгонку под комплект',
	sharpening: 'Заточка',
	noSharpening: 'Без заточки',
	twohandledWeapon: '<font color="brown">Двуручное оружие.</font>',
	secondaryWeapon: '<font color="darkgreen">Второе оружие.</font>',
	blockZones: 'Зоны блокирования',
	aboutSetCount: 'В комплект входит {0} предметов.',
	set: 'Комплект',
	strengthening: 'Усиление',
	fists: 'Кулак',
	dressCombatsSet: 'Надеть комплект БК',
	dressFromCombats: 'По персонажу БК',
	dressFromCombatsHint: 'Загрузить манекен по персонажу Бойцовского Клуба',
	zoneVariable: 'Показатель',
	zonehead: 'Голова',
	zonebody: 'Корпус',
	zonewaist: 'Пояс',
	zoneleg: 'Ноги',
	zoneavg: 'Среднее',
	pleaseWait: 'Пожалуйста, подождите...',
	setEtc: '...',
	armorWasFit: '[подгонка&nbsp;брони]',
	wasFit: '[под&nbsp;комплект]',
	wasUpgrade: '[улучшено]',
	wasCharmed: '[зачаровано]',
	wasAdded: ' ',
	upgradeObject: 'Улучшить',
	noUpgrade: 'Не улучшать',
	charmObject: 'Зачаровать',
	addstatsObject: 'Применить',
	uncharmObject: 'Снять зачарование',
	charmHint: '<img src="{0}DarkClan.gif" width="24" height="15" border="0" align="right" /><b>Зачарование</b><br />',
	addstatsHint: '<img src="{0}DarkClan.gif" width="24" height="15" border="0" align="right" /><b>Распределяем Статы</b><br />',
	useMagic: 'Встроена магия',
	hasMagic: 'Встроена магия',
	saveSet: 'Сохранить комплект',
	loadSet: 'Загрузить комплект',
	saveSetHint: '<img src="{0}DarkClan.gif" width="24" height="15" border="0" align="right" /><b>Сохранение комплекта</b><br />Скопируйте этот текст через буфер обмена и сохраните где-нибудь.<br />В любой момент Вы сможете загрузить комплект, описанный этим текстом.<br />Также Вы можете сохранить этот комплект на сервере, получив возможность открывать его по ссылке краткого вида.',
	loadSetHint: '<img src="{0}DarkClan.gif" width="24" height="15" border="0" align="right" /><b>Загрузка комплекта</b><br />Пожалуйста, скопируйте сюда тот текст, который Вы получили при сохранении комплекта, и затем нажмите кнопку &quot;Загрузить&quot;.<br />Также Вы можете загружать комплекты, введя сюда прямую ссылку на комплект , переданную Вам другом.',
	saveSetOnServer: 'Сохранить на сервере',
	infoPaneHeader: 'Расчётные&nbsp;данные',
	viewOptionsPaneHeader: 'Показатели',
	petPaneHeader: 'Зверь',
	listPaneHeader: 'Список',
	damagePaneHeader: 'Урон',
	componentsPaneHeader: 'Рецепты',
	optionsMenu: 'Настройки',
	optionsShowImages: 'Показывать изображения в списке предметов',
	optionsHideImages: 'Не показывать изображения в списке предметов',
	optionsUseAlphaForMenuAndTip: 'Полупрозрачные меню и справочная информация',
	optionsDontUseAlphaForMenuAndTip: 'Непрозрачные меню и справочная информация',
	optionsUseTransitionEffects: 'Использовать анимацию',
	optionsDontUseTransitionEffects: "Не использовать анимацию",
	optionsPreloadImages: 'Заранее загружать изображения Энциклопедии',
	optionsDontPreloadImages: "Не загружать заранее изображения Энциклопедии",
	optionsCaptureMouse: 'Захватывать события мыши при открытии меню',
	optionsDontCaptureMouse: "Не захватывать события мыши при открытии меню",
	startPreloadImages: 'Начата загрузка изображений Энциклопедии.',
	completePreloadImages: 'Загрузка изображений Энциклопедии завершена.',
	elixMenu: 'Эликсиры',
	noElix: 'Без статового эликсира',
	spellMenu: 'Заклинания',
	petMenu: '<font color="#660000">Звери</font>',
	petMenu2: 'Звери',
	dropPet: 'Прогнать зверя',
	noSpell: 'Без наложенного заклинания',
	statWeakness: 'Эликсир',
	appliedSpell: 'Заклинание',
	appliedPetSkill: 'Усиление зверя',
	dropElix: 'Снять эликсир',
	dropSpell: 'Снять наложенное заклинание',
	canUpgrade: '<font color="darkgreen">Доступно <b>улучшение</b> (после одевания).</font>',
	canFit: '<font color="darkgreen">Доступна <b>подгонка</b> (после одевания).</font>',
	friendLink: 'Передать ссылку на этот комплект другу',
	friendLinkHint: '<img src="{0}DarkClan.gif" width="24" height="15" border="0" align="right" /><b>Ссылка на комплект</b><br />Скопируйте эту ссылку и пошлите другу.<br />По этой ссылке он увидит собранный Вами комплект.',
	evaluatedHint: 'Эти числа описывают текущее значение: всего (родные + одежда)',
	requiredHint: 'Числа в квадратных скобках описывают минимально требуемое значение: [необходимо (родные + одежда)]',
	filter: '<img src="{0}DarkClan.gif" width="24" height="15" border="0" align="right" /><b>Фильтр</b>',
	setFilter: 'Наложить фильтр...',
	resetFilter: 'Снять фильтр',
	fminlevel: 'От уровня',
	fmaxlevel: 'До уровня',
	fshowold: 'Устаревшие',
	fshow_com: 'Импорт',
	fshow_ru: 'Наши',
	fshow_artefacts: 'Артефакты',
	ffiltermf: 'Показатель для отбора',
	ffiltermfHint: 'Показываются только те предметы, у которых данный показатель больше нуля.',
	frewardonly: 'Только Канализация',
	copyCab: 'Скопировать кабинку',
	impitem: '[импорт]',
	fixless: '<font color="red">Предмет не подлежит ремонту в ремонтных мастерских.</font>',
	charmless: '<font color="red">Предмет не подлежит зачаровыванию.</font>',
	changeName: 'Изменить имя',
	changeGender: 'Изменить пол',
	changeSign: 'Изменить знак зодиака',
	changeImage: 'Изменить образ',
	changeAlign: 'Изменить склонность',
	changeClan: 'Изменить название клана',
	zodiac0: 'Знак Зодиака неизвестен',
	zodiac1: '<b>Овен</b> (стихия Огня, 21.03-20.04)',
	zodiac2: '<b>Телец</b> (стихия Земли, 21.04-20.05)',
	zodiac3: '<b>Близнецы</b> (стихия Воздуха, 21.05-21.06)',
	zodiac4: '<b>Рак</b> (стихия Воды, 22.06-22.07)',
	zodiac5: '<b>Лев</b> (стихия Огня, 23.07-23.08)',
	zodiac6: '<b>Дева</b> (стихия Земли, 24.08-23.09)',
	zodiac7: '<b>Весы</b> (стихия Воздуха, 24.09-23.10)',
	zodiac8: '<b>Скорпион</b> (стихия Воды, 24.10-22.11)',
	zodiac9: '<b>Стрелец</b> (стихия Огня, 23.11-21.12)',
	zodiac10: '<b>Козерог</b> (стихия Земли, 22.12-20.01)',
	zodiac11: '<b>Водолей</b> (стихия Воздуха, 21.01-20.02)',
	zodiac12: '<b>Рыбы</b> (стихия Воды, 21.02-20.03)',
	attacktfire: 'огненные атаки',
	attacktair: 'электрические атаки',
	attacktwater: 'ледяные атаки',
	attacktearth: 'земляные атаки',
	attacktlight: 'атаки Света',
	attacktdark: 'атаки Тьмы',
	attacktthrust: 'колющие атаки',
	attacktsabre: 'рубящие атаки',
	attacktcrush: 'дробящие атаки',
	attacktcut: 'режущие атаки',
	attackqnone: 'нет',                             //     типы уронов.
//	attackqpermanent: 'постоянные',                 //     на 1 шмотке всеголишь ?
	attackqalways: 'всегда',                        //
	attackqroutinely: 'регулярны',                  //
//	attackqregular: 'регулярны',                    //     в 5-6 местах
	attackqoften: 'часты',                          //
//	attackqfrequent: 'часты',                       //     в 4х местах на 1 пушке
	attackqsometimes: 'временами',                  //
	attackqsmall: 'малы',                           //
//	attackqfew: 'малы',                             //     в 9-10 местах
	attackqrare: 'редки',                           //
//	attackqseldom: 'редки',                         //
	attackqinsignificant: 'ничтожно редки',         //
	defencetthrust: 'Защита от колющего урона',
	defencetsabre: 'Защита от рубящего урона',
	defencetcrush: 'Защита от дробящего урона',
	defencetcut: 'Защита от режущего урона',
	defenceqnone: 'нет',
	defenceqnormal: 'нормальная',
	defenceqfair: 'нормальная',
	defenceqgood: 'хорошая',
	defenceqweak: 'слабая',
	defenceqmagnificent: 'великолепная',
	defenceqexcellent: 'великолепная',
	defenceqmediocre: 'посредственная',
	informAboutCharLoading: '<p>Загрузка информации о персонаже происходит, только если сервер БК не заблокировал сервер DarkClan на чтение информации о персонажах (при блокировании необходимо подождать несколько минут).</p><p>Примерочная автоматически определяет большую часть улучшений и модификаций предметов.</p>',
	armor: 'Броня',
	badPetLevel: 'На [{0}] уровне Вы не сможете раскачать Вашего зверя на <font color="red"><b>[{1}]</b></font> уровень. Пожалуйста, проверьте уровень Вашего зверя.',
	badSkillCount: 'На [{0}] уровне {1} Вам доступно <b>{2}</b> родных владений, а в Вашем комплекте используется <font color="red"><b>{3}</b></font> родных владений. Пожалуйста, проверьте Ваши родные владения.',
	badSkillRewardedCount: 'с учётом {0} наградных владений ',
	badRewardedSkillCount: 'Вам доступно 5 владений за награду, а в Вашем комплекте используется <font color="red"><b>{0}</b></font> владений за награду. Пожалуйста, проверьте Ваши владения за награду.',
	badRewardedStatCount: 'Вам доступно 25 статов за награду, а в Вашем комплекте используется <font color="red"><b>{0}</b></font> статов за награду. Пожалуйста, проверьте Ваши статы за награду.',
	nativeStatsCount: 'На {1} апе [{0}] уровня {2}Вам доступно <b>{3}</b> родных статов. ',
	rewardedStatsCount: 'с учётом {0} наградных статов ',
	neqStatsCount: 'В Вашем комплекте используется <b>{0}</b> родных статов.',
	gtStatsCount: ' Осталось {0} свободных статов.',
	ltStatsCount: ' Не хватает {0} статов.',
	eqStatsCount: 'Свободных статов нет.',
	upperCab: 'Кабинка',
	newCab: 'Новая&nbsp;кабинка',
	closeCab: 'Закрыть кабинку',
	close: 'Закрыть',
	describeNativeStats: 'родные ',
	describeSetStats: ' от комплекта',
	FCPlayerNick: 'Ник персонажа',
	FCPlayerLoadIn: 'Загрузить из БК',
	expTableDesc: 'Таблица опыта позволяет Вам определить возможное количество параметров для использования в кабинке Примерочной.',
	dressSameItem: 'Надеть',
	summaryTableCab: 'Сводная&nbsp;таблица',
	summaryTableHint: 'Сводная таблица позволит сравнить результирующие показатели всех открытых кабинок между собой',
	summaryTableDesc: 'Сводная таблица позволяет сравнить результирующие показатели всех открытых кабинок между собой',
	newCabHint: 'Открыть новую кабинку для одновременной работы с несколькими комплектами и для дальнейшего их сравнения с помощью сводной таблицы',
	expTableCab: 'Таблица&nbsp;опыта',
	expTableHint: 'Таблица&nbsp;опыта',
	summaryTableCab: 'Сводная&nbsp;таблица',
	healerCab: 'Комната&nbsp;Знахаря',
	battlesCab: 'Поединки',
	designerCab: 'Конструктор',
	expIncrement: 'Увеличение',
	expTotal: 'Суммарно',
	expStats: 'статов',
	expSkills: 'умений',
	expEndurance: 'выносливости',
	expCredits: 'кредитов',
	expExperience: 'опыта',
	expBaseExperience: 'Базовый опыт',
	expBody: 'Тело',
	expDescription: 'Описание',
	expNoInformation: 'Нет информации',
	probabilityNever: '<font color="red">нет</font>',
	probabilityReal: 'реально',
	trick: 'Приём',
	attackZone: [
		'В голову',
		'В корпус',
		'В живот',
		'В пояс',
		'В ноги'
		],
	goStrike: 'Вперёд!',
	averageDamage: 'Усреднённый по весу',
	showDetails: 'Подробнее...',
	sameWeapon: '<font color="#336699">Удар второй рукой идентичен удару первой рукой.</font>',
	filterGeneralTab: 'Основные',
	filterMfTab: 'По&nbsp;показателю',
	filterSortTab: 'Сортировка',
	noFilterMf: 'Не фильтровать',
	naturalStats: 'Родные статы',
	resultStats: 'Итоговые статы',
	wearedItems: 'Список одетых предметов<br /><small>Щёлкните по предмету в списке, чтобы получить торговую информацию online.</small>',
	tip: 'Совет',
	charHint: 'Нажмите здесь, чтобы изменить имя, знак зодиака и иные свойства персонажа.',
	adjustHint: 'Нажмите {0}, чтобы подогнать статы и умения под одетый комплект.',
	here: 'здесь',
	badGender: 'Требуется другой пол.',
	reqInfo: 'Требуется {0} {1} , из них родных {2}',
	indicesPaneHeader: '<b>Список показываемых показателей</b><br /><small>изменения действуют на списки редактируемых полей, расчётные данные, сводную таблицу и справочную информацию, только пока открыта Примерочная, предназначены для удобства выполнения снимков.</small><br />',
	appearances: 'Образы',
	alignments: 'Склонности',
	noTrick: 'Нет приёма',
	noTrickHint: '<b>Пустой слот: Приём</b><br /><i>Дополнительная информация</i><br />Нажмите здесь, чтобы выбрать один из тактических приёмов.',
	tricks: 'Приёмы',
	dropTrick: 'Снять приём',
	badHeavyArmor: '<tr><td colspan="2" class="hintview">Боевую магию невозможно использовать в тяжёлой броне. Нажмите {0}, чтобы снять тяжёлую броню.</td></tr>',
	badGloves: '<tr><td colspan="2" class="hintview">Боевую магию невозможно использовать в перчатках не для мага. Нажмите {0}, чтобы снять перчатки.</td></tr>',
	charmChooseMf: 'Выберите изменяемый показатель',
	charmEnterV: 'Укажите значение, на которое чаруется показатель',
	charmReplace: 'Замещать предыдущие чары',
	showObjectData: 'Вывести параметры предмета',
	waddMenu: 'Продукты',
	waddInfo: 'Продукт/подарок',
	noWAdd: 'Без продуктов/подарков',
	ownedBy: 'Принадлежит: ',
	doClean: 'Очистить всё',
	doCleanHint: 'Очищает все сохранённые настройки и кабинки. Полезно, если Примерочная по каким-то причинам перестала у Вас работать.',
	HideAllTricks: 'Снять все приемы',
	dropAllSpells: 'Снять все свитки',
	optionsColorizedDummyOff: 'Отказаться от цветовой раскраски манекена',
	optionsColorizedDummyOn: 'Включить цветовую раскраску манекена',
	setVariantsAvailable: 'Также доступны другие вариации усиления комплекта:',
	bop: 'Этот предмет будет связан общей судьбой с первым, кто получит его. Никто другой не сможет его использовать.',
	boe: 'Этот предмет будет связан общей судьбой с первым, кто оденет его. Никто другой не сможет его использовать.',
	sentinel: '',
	rune: 'Рунная магия',
	addStats: 'Расставить статы',
	unaddStats: 'Снять статы',
	opt_choices: 'Варианты действия',
	unRune: 'Снять руну',
	wasRuned: 'Наложена руна'
};

// taken from analyzer3.js script.
var twoBlockZones = [
	{ name: 'Голова и грудь', zones: 0x03 },
	{ name: 'Грудь и живот', zones: 0x06 },
	{ name: 'Живот и пояс', zones: 0x0C },
	{ name: 'Пояс и ноги', zones: 0x18 },
	{ name: 'Голова и ноги', zones: 0x11 }
	];

var threeBlockZones = [
	{ name: 'Голова, грудь и живот', zones: 0x07 },
	{ name: 'Грудь, живот и пояс', zones: 0x0E },
	{ name: 'Живот, пояс и ноги', zones: 0x1C },
	{ name: 'Голова, пояс и ноги', zones: 0x19 },
	{ name: 'Голова, грудь и ноги', zones: 0x13 }
	];

var attackFreq = {
	falways: 100,
//	fpermanent: 100,
	foften: 90,
//	ffrequent: 85,
	froutinely: 80,
//	fregular: 80,
	fsometimes: 60,
	fsmall: 20,
//	ffew: 25,
	frare: 10,
//	fseldom: 20,
	finsignificant: 5,

	fnone: 0
};

/* Character slots definition */

var slot_w1 = { // earings
	id: 'w1',
	zone: 'all',
	index: 1,
	canCharm: true,
	width: 60,
	height: 20
	};

var slot_w2 = { // amulet
	id: 'w2',
	zone: 'all',
	index: 2,
	canCharm: true,
	width: 60,
	height: 20
	};

var slot_w3 = { // weapon
	id: 'w3',
	zone: 'all',
	index: 3,
	canCharm: true,
	width: 60,
	height: 60
	};

var slot_w4 = { // armor
	id: 'w4',
	zone: 'body',
	index: 4,
	canCharm: true,
	width: 60,
	height: 80
	};

var slot_w5 = { // belt
	id: 'w5',
	zone: 'waist',
	index: 5,
	canCharm: true,
	width: 60,
	height: 40
	};

var slot_w6 = { // ring 1
	id: 'w6',
	zone: 'all',
	index: 6,
	canCharm: true,
	width: 20,
	height: 20
	};

var slot_w7 = { // ring 2
	id: 'w7',
	zone: 'all',
	index: 7,
	canCharm: true,
	width: 20,
	height: 20
	};

var slot_w8 = { // ring 3
	id: 'w8',
	zone: 'all',
	index: 8,
	canCharm: true,
	width: 20,
	height: 20
	};

var slot_w9 = { // helmet
	id: 'w9',
	zone: 'head',
	index: 9,
	canCharm: true,
	width: 60,
	height: 60
	};

var slot_w10 = { // shield
	id: 'w10',
	zone: 'all',
	index: 10,
	canCharm: true,
	width: 60,
	height: 60
	};

var slot_w11 = { // gloves
	id: 'w11',
	zone: 'all',
	index: 11,
	canCharm: true,
	width: 60,
	height: 40
	};

var slot_w12 = { // boots
	id: 'w12',
	zone: 'leg',
	index: 12,
	canCharm: true,
	width: 60,
	height: 40
	};

var slot_w13 = { // braslet
	id: 'w13',
	zone: 'all',
	index: 13,
	canCharm: true,
	width: 60,
	height: 40
	};

var slot_w14 = { // carman 1
	id: 'w14',
	zone: 'all',
	index: 14,
	width: 40,
	height: 20
	};

var slot_w15 = { // carman 2
	id: 'w15',
	zone: 'all',
	index: 15,
	width: 40,
	height: 20
	};

var slot_w16 = { // carman 3
	id: 'w16',
	zone: 'all',
	index: 16,
	width: 40,
	height: 20
	};

var slot_w0 = { // shirt
	id: 'wshirt',
	zone: 'body',
	index: 0,
	canCharm: true,
	width: 60,
	height: 80,
	emptyImageHere: true
	};

var slot_w17 = { // cape
	id: 'wcape',
	zone: 'all',
	index: 17,
	canCharm: true,
	width: 60,
	height: 80,
	emptyImageHere: true
	};

var slot_w18 = { // wreath
	id: 'wwreath',
	zone: 'all',
	index: 18,
	canCharm: true,
	width: 60,
	height: 60,
	emptyImageHere: true
	};

var slot_w19 = { // pants
	id: 'w19',
	zone: 'pants',
	index: -1,
	canCharm: true,
	width: 60,
	height: 80
	};

var slot_wbook = { // book
	id: 'wbook',
	zone: 'all',
	index: -1,
	width: 40,
	height: 25,
	emptyImageHere: true
	};

var slot_wadd = { // adds
	id: 'wadd',
	zone: 'all',
	index: -1,
	width: 1,
	height: 1,
	emptyImageHere: true
	};

var slots = new Array(
	slot_w1, slot_w2, slot_w3, slot_w4, slot_w5, slot_w6, slot_w7, slot_w8, slot_w9, slot_w10, slot_w11, slot_w12, slot_w13, slot_w14, slot_w15, slot_w16, slot_w0, slot_w17, slot_w18
	);

function createSpellSlots()
{
	for (var i = 100; i <= 109; i++)
	{
		var spellSlot = { // spell
			id: ('w' + i),
			zone: 'all',
			index: slots.length,
			width: 40,
			height: 25
			};
		slots.push(spellSlot);
	}
}

createSpellSlots();

slot_wbook.index = slots.length;
slots.push(slot_wbook);
slot_wadd.index = slots.length;
slots.push(slot_wadd);
slot_w19.index = slots.length;
slots.push(slot_w19);

var aligns = new Array(
	{caption: 'Разное'},
	{id: '0', caption: 'Без склонности'},
	{id: '7', caption: 'Нейтральное братство'},
	{id: '9', caption: 'Марка'},
	{id: '10', caption: 'Отморозок'},
	{id: '23', caption: 'ТемноСерая'},
	{id: '50', caption: 'Алхимик'},
	{id: '100', caption: 'Ангел'},
	{caption: 'Темное братство'},
	{id: '3', caption: 'Темный'},
	{id: '3.01', caption: 'Тарман-Служитель'},
	{id: '3.05', caption: 'Тарман-Надсмотрщик'},
	{id: '3.06', caption: 'Каратель'},
	{id: '3.07', caption: 'Тарман-Убийца'},
	{id: '3.075', caption: '13-я Гвардия'},
	{id: '3.09', caption: 'Тарман-Палач'},
	{id: '3.091', caption: 'Тарман-Владыка'},
	{id: '3.092', caption: 'Тарман-Владыка на пенсии'},
	{id: '3.99', caption: 'Верховный Тарман'},
	{id: '3.001', caption: 'Гвардия Мусорщика'},
	{caption: 'Белое братство'},
	{id: '1', caption: 'Светлый'},
	{id: '1.1', caption: 'Паладин Поднебесья'},
	{id: '1.4', caption: 'Таможенный Паладин'},
	{id: '1.5', caption: 'Паладин Солнечной Улыбки'},
	{id: '1.6', caption: 'Инквизитор'},
	{id: '1.7', caption: 'Паладин Огненной Зари'},
	{id: '1.75', caption: 'Хранитель Знаний'},
	{id: '1.9', caption: 'Паладин Неба Белый'},
	{id: '1.91', caption: 'Старший Паладин Неба'},
	{id: '1.92', caption: 'Кавалер Ордена Света'},
	{id: '1.99', caption: 'Глава Ордена'},
	{id: '1.01', caption: 'Гвардия Мироздателя'},
	{caption: 'Пределы Хаоса'},
	{id: '2', caption: 'Хаос'},
	{id: '2.5', caption: 'Служитель Хаоса'},
	{id: '2.9', caption: 'Старший Служитель Хаоса'},
	{id: '2.99', caption: 'Лорд Хаоса'}
	);

var relativeSpiritConsumers = new Array(
	{id: 'cureHP15', hp: 15},
	{id: 'cureHP30', hp: 30},
	{id: 'cureHP45', hp: 45},
	{id: 'cureHP60', hp: 60},
	{id: 'cureHP120', hp: 120},
	{id: 'cureHP600', hp: 600},
	{id: 'cureHP900', hp: 900},
 {id: 'cureHP1200', hp: 1200},
 {id: 'cureHP1500', hp: 1500}
	);

var absoluteSpiritConsumers = [
	{id: 'preservation', spirit: 20},
	{id: 'preservationD', spirit: 20},
	{id: 'reanimationL', spirit: 30},
	{id: 'reanimation', spirit: 30},
	{id: 'reanimation_olditem', spirit: 30},
	{id: 'mirror', spirit: 5},
	{id: 'elementalcrit', spirit: 10}
	];

var alignImages = {
	dark: '<img src="{0}align3.gif" width="12" height="15" border="0" alt="Темная склонность"/>',
	light: '<img src="{0}align1.gif" width="12" height="15" border="0" alt="Светлая склонность"/>',
	neutral: '<img src="{0}align7.gif" width="12" height="15" border="0" alt="Нейтральная склонность"/>',
	haos: '<img src="{0}align2.gif" width="12" height="15" border="0" alt="Склонность хаоса"/>',
	greydark: '<img src="{0}align23.gif" width="12" height="15" border="0" alt="ТемноСерая склонность"/>',

	sentinel: ''
	};


var knownStats = [
	'strength',
	'dexterity',
	'intuition',
	'endurance',
	'intellect',
	'wisdom',
	'spirituality'
	];


var battleTurnParams = [
	'hitpoints',
	'mana',
	'spiritlevel',
	'parry',
	'shieldblock',
	'counterstroke',
	'absolutecriticalhit',
	'absolutejumpaway',
	'firemagicdefence',
	'airmagicdefence',
	'watermagicdefence',
	'earthmagicdefence',
	'lightmagicdefence',
	'darkmagicdefence',
	'greymagicdefence',
	'firemagicpower',
	'airmagicpower',
	'watermagicpower',
	'earthmagicpower',
	'lightmagicpower',
	'darkmagicpower',
	'magicdefencereduce',
	'firemagicdefencereduce',
	'airmagicdefencereduce',
	'watermagicdefencereduce',
	'earthmagicdefencereduce',
	'lightmagicdefencereduce',
	'darkmagicdefencereduce',
	'greymagicdefencereduce',
	'attackcount',
	'blockcount',
	'criticalpower',
	'power',
	'thrustpower',
	'sabrepower',
	'crushpower',
	'cutpower',
	'criticalhit',
	'anticriticalhit',
	'jumpaway',
	'antijumpaway',
	'piercearmor',
	'absolutecriticalhit',
	'absolutejumpaway'
	];

var knownStatLimits = {
	strength: 3,
	dexterity: 3,
	intuition: 3,
	endurance: 3
	};

var knownCleanModifiers = [
	'level',
	'-',
	'strength',
	'dexterity',
	'intuition',
	'endurance',
	'intellect',
	'wisdom',
	'spirituality',
	'totalstats',
	'-',
	'hitpoints',
	'mana',
	'spiritlevel',
	'-',
	'hpspeed',
	'manaspeed',
	'manaconsumption',
	'-',
	'weaponskill',
	'knifeskill',
	'axeskill',
	'clubskill',
	'swordskill',
	'staffskill',
	'-',
	'magicskill',
	'firemagicskill',
	'airmagicskill',
	'watermagicskill',
	'earthmagicskill',
	'lightmagicskill',
	'darkmagicskill',
	'greymagicskill',
	'-',
	'parry',
	'shieldblock',
	'counterstroke',
	'absolutejumpaway',
	'absolutecriticalhit',
	'-',
	'magicdefence',
	'firemagicdefence',
	'airmagicdefence',
	'watermagicdefence',
	'earthmagicdefence',
	'lightmagicdefence',
	'darkmagicdefence',
	'greymagicdefence',
	'-',
	'magicpower',
	'firemagicpower',
	'airmagicpower',
	'watermagicpower',
	'earthmagicpower',
	'lightmagicpower',
	'darkmagicpower',
	'-',
	'magicdefencereduce',
	'firemagicdefencereduce',
	'airmagicdefencereduce',
	'watermagicdefencereduce',
	'earthmagicdefencereduce',
	'lightmagicdefencereduce',
	'darkmagicdefencereduce',
	'greymagicdefencereduce',
	'-',
	'attackcount',
	'blockcount',
	'-',
	'knapsack',
	'-',
	'totalprice',
	'totaleprice',
	'totalweight',
	'consumed_reward',
	'-',
	'spell_powerup10_self',
	'spell_powerup10_other',
	'spell_protect10_self',
	'spell_protect10_other',
	'-',
	'spell_powerup1_self',
	'spell_powerup1_other',
	'spell_powerup3_self',
	'spell_powerup3_other',
	'spell_powerup2_self',
	'spell_powerup2_other',
	'spell_powerup4_self',
	'spell_powerup4_other',
	'spell_protect1_self',
	'spell_protect1_other',
	'spell_protect3_self',
	'spell_protect3_other',
	'spell_protect2_self',
	'spell_protect2_other',
	'spell_protect4_self',
	'spell_protect4_other'
	];

var knownWeaponModifiers = [
	'criticalpower',
	'power',
	'thrustpower',
	'sabrepower',
	'crushpower',
	'cutpower',
	'-',
	'criticalhit',
	'anticriticalhit',
	'jumpaway',
	'antijumpaway',
	'-',
	'piercearmor'
	];

var knownWeaponModifiersHash = {};
for (var wi = 0; wi < knownWeaponModifiers.length; wi++)
{
	if (knownWeaponModifiers[wi] == '-') continue;
	knownWeaponModifiersHash[knownWeaponModifiers[wi]] = true;
}

var knownAdvWeaponModifiers = {
	damage: 0,
	mfdamage: 0,
	mfcdamage: 0,
	postdamage: 0
	};

var knownWeaponPowerModifiers = {
	// value 'all' - always acts on minimal damage too.
	power: 'all',
	thrustpower: 'attack',
	sabrepower: 'attack',
	crushpower: 'attack',
	cutpower: 'attack',
	magicpower: 'allmagic',
	firemagicpower: 'magic',
	airmagicpower: 'magic',
	watermagicpower: 'magic',
	earthmagicpower: 'magic',
	lightmagicpower: 'xmagic',
	darkmagicpower: 'xmagic'
	};

var knownZoneModifiers = {
	defence: 0,
	thrustdefence: 0,
	sabredefence: 0,
	crushdefence: 0,
	cutdefence: 0
	};

var knownArmorModifiers = {
	headarmor: 0,
	bodyarmor: 0,
	waistarmor: 0,
	legarmor: 0,
	avgarmor: 0
	};

var naturalElements = [
	'fire',
	'earth',
	'air',
	'water'
	];

var allElements = [
	'fire',
	'earth',
	'air',
	'water',
	'light',
	'dark',
	'grey'
	];

var common_props = {
	eprice: {lbl: 'Цена (екр.)', fmt: '<font color="brown">{0}&nbsp;екр.</font>', view: true},
	price: {lbl: 'Цена', fmt: '{0}&nbsp;кр.', view: true},
	weight: {lbl: 'Вес', view: true},
	durability: {lbl: 'Долговечность', fmt: '0/{0}', view: true}
	};

var item_props = {
	sex: {lbl: 'Пол', view: true, nocharm: true},
	allstats:{lbl: 'Все статы',view:true,nocharm:true},
	stats:{lbl: 'Количество увеличений', view: true},
	level: {lbl: 'Уровень', required: true, view: true, nocharm: true},
	levelup: {lbl: 'Ап', view: true, nocharm: true},
	pstat: {lbl: 'Статов за награду', view: true, nocharm: true},
	pskil: {lbl: 'Умений за награду', view: true, nocharm: true},
	strength: {lbl: 'Сила', required: true, view: true, inmfg: true},
	dexterity: {lbl: 'Ловкость', required: true, view: true, inmfg: true},
	intuition: {lbl: 'Интуиция', required: true, view: true, inmfg: true},
	endurance: {lbl: 'Выносливость', required: true, view: true, nocharm: true},
	intellect: {lbl: 'Интеллект', required: true, view: true, inmfg: true},
	wisdom: {lbl: 'Мудрость', required: true, view: true, nocharm: true},
	spirituality: {lbl: 'Духовность', required: true, view: true, nocharm: true},
	totalstats: {lbl: 'Всего статов', view: true, nocharm: true},
	spiritlevel: {lbl: 'Уровень духа', view: true, nocharm: true},
	totalprice: {lbl: 'Стоимость предметов', fmt: '{0}&nbsp;кр.', view: true, nocharm: true},
	totaleprice: {lbl: 'Стоимость предметов (екр.)', fmt: '{0}&nbsp;екр.', view: true, nocharm: true},
	totalweight: {lbl: 'Вес предметов', view: true, nocharm: true},
	mana: {lbl: 'Уровень маны', required: true, view: true, inmfg: true},
	weaponskill: {lbl: 'Владение оружием', view: true, inmfg: true, inprpg: true},
	knifeskill: {lbl: 'Владение ножами и кинжалами', required: true, view: true, inmfg: true, inprpg: true},
	axeskill: {lbl: 'Владение топорами и секирами', required: true, view: true, inmfg: true, inprpg: true},
	clubskill: {lbl: 'Владение молотами и дубинами', required: true, view: true, inmfg: true, inprpg: true},
	swordskill: {lbl: 'Владение мечами', required: true, view: true, inmfg: true, inprpg: true},
	staffskill: {lbl: 'Владение посохами', required: true, view: true, inmfg: true, inprpg: true},
	magicskill: {lbl: 'Владение магией Стихий', view: true, inmfg: true},
	firemagicskill: {lbl: 'Владение магией Огня', required: true, view: true, inmfg: true},
	airmagicskill: {lbl: 'Владение магией Воздуха', required: true, view: true, inmfg: true},
	watermagicskill: {lbl: 'Владение магией Воды', required: true, view: true, inmfg: true},
	earthmagicskill: {lbl: 'Владение магией Земли', required: true, view: true, inmfg: true},
	lightmagicskill: {lbl: 'Владение магией Света', required: true, view: true, inmfg: true},
	darkmagicskill: {lbl: 'Владение магией Тьмы', required: true, view: true, inmfg: true},
	greymagicskill: {lbl: 'Владение серой магией', required: true, view: true, inmfg: true},
	mindamage: {lbl: 'Минимальный урон', view: true, inmfg: true, inprpg: true},
	maxdamage: {lbl: 'Максимальный урон', view: true, inmfg: true, inprpg: true},
	damage: {lbl: 'Урон', view: false, nocharm: true},
	mfdamage: {lbl: 'Урон с учётом мф.', view: true, nocharm: true},
	nextdamage: {lbl: 'Отложенный урон', view: true, nocharm: true},
	nextturns: {lbl: 'Длительность отложенного урона', fmt: '{0} ходов', view: true, nocharm: true},
	minhitpoints: {lbl: 'Минимальный уровень жизни', view: true, nocharm: true},
	maxhitpoints: {lbl: 'Максимальный уровень жизни', view: true, nocharm: true},
	nexthitpoints: {lbl: 'Отложенный уровень жизни', view: true, nocharm: true},
	mfdamage: {lbl: 'Урон с учётом мф.', view: true, nocharm: true},
	mfcdamage: {lbl: 'Критический урон с учётом мф.', view: true, nocharm: true},
	postdamage: {lbl: 'Дополнительный урон', view: true, nocharm: true},
	hitpoints: {lbl: 'Уровень жизни', view: true, inmfg: true},
	hpspeed: {lbl: 'Скорость восстановления жизни', fmt: '{0}%', view: true, inmfg: true},
	manaspeed: {lbl: 'Скорость восстановления маны', fmt: '{0}%', view: true, inmfg: true},
	manaconsumption: {lbl: 'Уменьшение расхода маны', fmt: '{0}%', maxvalue: 99, view: true, inmfg: true},
	criticalpower: {lbl: 'Мф. мощности критического удара', fmt: '{0}%', view: true, inmfg: true, inprpg: true},
	absolutecriticalhit: {lbl: 'Абс. мф. крита', view: true, inmfg: true, inprpg: true},
	criticalhit: {lbl: 'Мф. критического удара', fmt: '{0}%', view: true, inmfg: true, inprpg: true},
	anticriticalhit: {lbl: 'Мф. против критического удара', fmt: '{0}%', view: true, inmfg: true},
	absolutejumpaway: {lbl: 'Абс. мф. уворота', view: true, inmfg: true, inprpg: true},
	jumpaway: {lbl: 'Мф. увёртывания', fmt: '{0}%', view: true, inmfg: true, inprpg: true},
	antijumpaway: {lbl: 'Мф. против увёртывания', fmt: '{0}%', view: true, inmfg: true},
	piercearmor: {lbl: 'Мф. пробоя брони', fmt: '{0}%', maxvalue: 100, view: true, inmfg: true, inprpg: true},
	parry: {lbl: 'Мф. парирования', fmt: '{0}%', maxvalue: 200, view: true, inmfg: true},
	counterstroke: {lbl: 'Мф. контрудара', fmt: '{0}%', maxvalue: 80, view: true, inmfg: true},
	shieldblock: {lbl: 'Мф. блока щитом', fmt: '{0}%', maxvalue: 80, view: true, inmfg: true, inprpg: true},
	power: {lbl: 'Мф. мощности удара', fmt: '{0}%', view: true, inmfg: true, inprpg: true},
	thrustpower: {lbl: 'Мф. мощности колющего урона', fmt: '{0}%', view: true, inmfg: true, inprpg: true},
	sabrepower: {lbl: 'Мф. мощности рубящего урона', fmt: '{0}%', view: true, inmfg: true, inprpg: true},
	crushpower: {lbl: 'Мф. мощности дробящего урона', fmt: '{0}%', view: true, inmfg: true, inprpg: true},
	cutpower: {lbl: 'Мф. мощности режущего урона', fmt: '{0}%', view: true, inmfg: true, inprpg: true},
	defence: {lbl: 'Защита от урона', maxvalue: 1800, view: true, inmfg: true, inprpg: true},
	edefence: {lbl: 'Защита от колющего, рубящего, дробящего и режущего урона', maxvalue: 1800, view: true, nocharm: true},
	thrustdefence: {lbl: 'Защита от колющего урона', maxvalue: 1800, view: true, inmfg: true, inprpg: true},
	sabredefence: {lbl: 'Защита от рубящего урона', maxvalue: 1800, view: true, inmfg: true, inprpg: true},
	crushdefence: {lbl: 'Защита от дробящего урона', maxvalue: 1800, view: true, inmfg: true, inprpg: true},
	cutdefence: {lbl: 'Защита от режущего урона', maxvalue: 1800, view: true, inmfg: true, inprpg: true},
	magicdefence: {lbl: 'Защита от магии', maxvalue: 1800, view: true, inmfg: true},
	emagicdefence: {lbl: 'Защита от магии Огня, Воздуха, Воды и Земли', maxvalue: 1800, view: true, nocharm: true},
	firemagicdefence: {lbl: 'Защита от магии Огня', maxvalue: 1800, view: true, inmfg: true},
	airmagicdefence: {lbl: 'Защита от магии Воздуха', maxvalue: 1800, view: true, inmfg: true},
	watermagicdefence: {lbl: 'Защита от магии Воды', maxvalue: 1800, view: true, inmfg: true},
	earthmagicdefence: {lbl: 'Защита от магии Земли', maxvalue: 1800, view: true, inmfg: true},
	lightmagicdefence: {lbl: 'Защита от магии Света', maxvalue: 1800, view: true, inmfg: true},
	darkmagicdefence: {lbl: 'Защита от магии Тьмы', maxvalue: 1800, view: true, inmfg: true},
	greymagicdefence: {lbl: 'Защита от серой магии', maxvalue: 1800, view: true, inmfg: true},
	magicpower: {lbl: 'Мф. мощности магии стихий', fmt: '{0}%', view: true, inmfg: true},
	firemagicpower: {lbl: 'Мф. мощности магии Огня', fmt: '{0}%', view: true, inmfg: true},
	airmagicpower: {lbl: 'Мф. мощности магии Воздуха', fmt: '{0}%', view: true, inmfg: true},
	watermagicpower: {lbl: 'Мф. мощности магии Воды', fmt: '{0}%', view: true, inmfg: true},
	earthmagicpower: {lbl: 'Мф. мощности магии Земли', fmt: '{0}%', view: true, inmfg: true},
	lightmagicpower: {lbl: 'Мф. мощности магии Света', fmt: '{0}%', view: true, inmfg: true},
	darkmagicpower: {lbl: 'Мф. мощности магии Тьмы', fmt: '{0}%', view: true, inmfg: true},
	magicdefencereduce: {lbl: 'Понижение защиты от магии', fmt: '{0}%', maxvalue: 99, view: true, inmfg: true},
	firemagicdefencereduce: {lbl: 'Понижение защиты от магии Огня', fmt: '{0}%', maxvalue: 99, view: true, inmfg: true},
	airmagicdefencereduce: {lbl: 'Понижение защиты от магии Воздуха', fmt: '{0}%', maxvalue: 99, view: true, inmfg: true},
	watermagicdefencereduce: {lbl: 'Понижение защиты от магии Воды', fmt: '{0}%', maxvalue: 99, view: true, inmfg: true},
	earthmagicdefencereduce: {lbl: 'Понижение защиты от магии Земли', fmt: '{0}%', maxvalue: 99, view: true, inmfg: true},
	lightmagicdefencereduce: {lbl: 'Понижение защиты от магии Света', fmt: '{0}%', maxvalue: 99, view: true, inmfg: true},
	darkmagicdefencereduce: {lbl: 'Понижение защиты от магии Тьмы', fmt: '{0}%', maxvalue: 99, view: true, inmfg: true},
	greymagicdefencereduce: {lbl: 'Понижение защиты от серой магии', fmt: '{0}%', maxvalue: 99, view: true, inmfg: true},
	attackcount: {lbl: 'Точек удара за ход', view: true, nocharm: true},
	blockcount: {lbl: 'Зон блока за ход', view: true, nocharm: true},
	knapsack: {lbl: 'Ёмкость рюкзака', view: true, nocharm: true},
	headarmor: {lbl: 'Броня головы', view: true, nocharm: true},
	bodyarmor: {lbl: 'Броня корпуса', view: true, nocharm: true},
	waistarmor: {lbl: 'Броня пояса', view: true, nocharm: true},
	legarmor: {lbl: 'Броня ног', view: true, nocharm: true},
	avgarmor: {lbl: 'Броня в среднем', view: true, nocharm: true},
	probability: {lbl: 'Вероятность срабатывания', fmt: '{0}%', maxvalue: 99, view: true, nocharm: true, inprpg: true},
	spell_powerup10_self: {lbl:'Сокрушение на себя', fmt:'{0} ед.', view: true, nocharm: true},
	spell_powerup10_other: {lbl:'Сокрушение на других', fmt:'{0} ед.', view: true, nocharm: true},
	spell_powerup1_self: {lbl:'Огненное Усиление на себя', fmt:'{0} ед.', view: true, nocharm: true},
	spell_powerup1_other: {lbl:'Огненное Усиление на других', fmt:'{0} ед.', view: true, nocharm: true},
	spell_powerup3_self: {lbl:'Воздушное Усиление на себя', fmt:'{0} ед.', view: true, nocharm: true},
	spell_powerup3_other: {lbl:'Воздушное Усиление на других', fmt:'{0} ед.', view: true, nocharm: true},
	spell_powerup2_self: {lbl:'Водное Усиление на себя', fmt:'{0} ед.', view: true, nocharm: true},
	spell_powerup2_other: {lbl:'Водное Усиление на других', fmt:'{0} ед.', view: true, nocharm: true},
	spell_powerup4_self: {lbl:'Земное Усиление на себя', fmt:'{0} ед.', view: true, nocharm: true},
	spell_powerup4_other: {lbl:'Земное Усиление на других', fmt:'{0} ед.', view: true, nocharm: true},
	spell_protect10_self: {lbl:'Защита от Оружия на себя', fmt:'{0} ед.', view: true, nocharm: true},
	spell_protect10_other: {lbl:'Защита от Оружия на других', fmt:'{0} ед.', view: true, nocharm: true},
	spell_protect1_self: {lbl:'Защита от Огня на себя', fmt:'{0} ед.', view: true, nocharm: true},
	spell_protect1_other: {lbl:'Защита от Огня на других', fmt:'{0} ед.', view: true, nocharm: true},
	spell_protect3_self: {lbl:'Защита от Воздуха на себя', fmt:'{0} ед.', view: true, nocharm: true},
	spell_protect3_other: {lbl:'Защита от Воздуха на других', fmt:'{0} ед.', view: true, nocharm: true},
	spell_protect2_self: {lbl:'Защита от Воды на себя', fmt:'{0} ед.', view: true, nocharm: true},
	spell_protect2_other: {lbl:'Защита от Воды на других', fmt:'{0} ед.', view: true, nocharm: true},
	spell_protect4_self: {lbl:'Защита от Земли на себя', fmt:'{0} ед.', view: true, nocharm: true},
	spell_protect4_other: {lbl:'Защита от Земли на других', fmt:'{0} ед.', view: true, nocharm: true},
	magic_damage: {lbl:'Магический урон', view: true, nocharm: true},
	magic_cdamage: {lbl:'Магический критический урон', view: true, nocharm: true},
	consumed_reward: {lbl:'Потрачено награды', view: true, nocharm: true},
	_power_v: {lbl:'Общий мф. мощности урона', fmt: '{0}%', view: true, nocharm: true}
	};

var knownWeaponSkills = [
	'knifeskill',
	'axeskill',
	'clubskill',
	'swordskill',
	'staffskill'
	];

var shortInfoMap = {
	level: 'level',
	str: 'strength',
	dex: 'dexterity',
	inst: 'intuition',
	power: 'endurance',
	intel: 'intellect',
	wis: 'wisdom',
	spirit: 'spirituality'
	};

var shortInfoMap2 = {
	_str: 'strength',
	_dex: 'dexterity',
	_inst: 'intuition',
	_power: 'endurance',
	_intel: 'intellect'
	};

var knownPredefinedCharms = [
	{id: 'enhp_3_manabuff1', caption: 'Увеличение Маны 1', v: 'mana#20', categories: ['staffs']},
	{id: 'enhp_3_manabuff2', caption: 'Увеличение Маны 2', v: 'mana#40', categories: ['staffs']},
	{id: 'enhp_3_manabuff3', caption: 'Увеличение Маны 3', v: 'mana#60', categories: ['staffs']},

//	{id: 'enhp_3_moder_4', caption: 'Зачаровать оружие: Огонь', categories: ['knives','axes','clubs','swords']},
//	{id: 'enhp_3_moder_5', caption: 'Зачаровать оружие: Лёд', categories: ['knives','axes','clubs','swords']},

	{id: 'enhp_6_bloodlinew1', caption: 'Кровавая Мощь', v: 'power#1#hitpoints#6', categories: ['rings']},
	{id: 'enhp_6_bloodlinem1', caption: 'Кровавая Мощь', v: 'magicpower#1#hitpoints#6', categories: ['rings']},
	{id: 'enhp_6_bloodlinew2', caption: 'Кровавая Мощь [2]', v: 'power#2#hitpoints#12', categories: ['rings']},
	{id: 'enhp_6_bloodlinem2', caption: 'Кровавая Мощь [2]', v: 'magicpower#2#hitpoints#12', categories: ['rings']},
	{id: 'enhp_2_maxHP10', caption: 'Зачаровать амулет: Здоровье +100', v: 'hitpoints#100', categories: ['necklaces']},
	{id: 'enhp_13_pm_revard', caption: 'Зачаровать наручи: Здоровье +12', v: 'hitpoints#12', categories: ['bracelets']},
	{id: 'enhp_3_moder_6_1', caption: 'Зачаровать Посох: Урон', v: 'magicpower#4', categories: ['staffs']},
	{id: 'enhp_4_moder_2_1', caption: 'Зачаровать броню: Жизнь', v: 'hitpoints#33', categories: ['heavyarmors', 'lightarmors']},
	{id: 'enhp_4_4', caption: 'Зачаровать броню: Адаптация', v: 'antijumpaway#10#stats#2', categories: ['heavyarmors', 'lightarmors']},
	{id: 'enhp_2_4', caption: 'Зачаровать амулет: Адаптация', v: 'magicdefence#5#stats#2', categories: ['necklaces']},
	{id: 'enhp_9_5', caption: 'Зачаровать шлем: Адаптация', v: 'defence#5#stats#2', categories: ['helmets']},
	{id: 'enhp_12_4', caption: 'Зачаровать сапоги: Адаптация', v: 'anticriticalhit#10#stats#2', categories: ['boots']},
	{id: 'enhp_19_1', caption: 'Зачаровать поножи: Защита от урона', v: 'defence#20', categories: ['pants']},
	{id: 'enhp_19_2', caption: 'Зачаровать поножи: Выживание', v: 'hitpoints#40', categories: ['pants']},
	{id: 'enhp_19_3', caption: 'Зачаровать поножи: Защита от магии', v: 'magicdefence#20', categories: ['pants']},
	{id: 'enhp_19_4', caption: 'Зачаровать поножи: Адаптация', v: 'stats#3', categories: ['pants']},
	{id: 'enhp_9_moder_1_1', caption: 'Зачаровать шлем: Благословление Звезд', v: 'dexterity#1#intuition#1#intellect#1#strength#1#hitpoints#6', categories: ['helmets']},
	{id: 'enhp_11_moder_3', caption: 'Зачаровать перчатки: Урон', v: 'power#2#magicpower#2', categories: ['gauntlets']},
	{id: 'enhp_2_tournir1chka_7_1', caption: 'Зачаровать амулет: Характеристики +1', v: 'dexterity#1#intuition#1#strength#1#hitpoints#6', categories: ['necklaces']},
	{id: 'enhp_2_tournir1chka_7_2', caption: 'Зачаровать амулет: Характеристики +2', v: 'dexterity#2#intuition#2#strength#2#hitpoints#12', categories: ['necklaces']},
	{id: 'enhp_2_tournir1chka_7_3', caption: 'Зачаровать амулет: Характеристики +3', v: 'dexterity#3#intuition#3#strength#3#hitpoints#18', categories: ['necklaces']}
	];

var knownNaturalEditors = new Array(
	'level',
	'levelup',
	'-',
	'strength',
	'dexterity',
	'intuition',
	'endurance',
	'intellect',
	'wisdom',
	'spirituality',
	'-',
	'knifeskill',
	'axeskill',
	'clubskill',
	'swordskill',
	'staffskill',
	'-',
	'firemagicskill',
	'airmagicskill',
	'watermagicskill',
	'earthmagicskill',
	'-',
	
	'lightmagicskill',
	'darkmagicskill',
	'greymagicskill',
	'-',
	'pstat',
	'pskil'
	);

var knownElix = {
	strength: { id: 'pot_base_50_str', caption: 'Зелье Могущества', makeUp: 'strength', values: new Array(0,15) },
	dexterity: { id: 'pot_base_50_dex', caption: 'Зелье Стремительности', makeUp: 'dexterity', values: new Array(0,15) },
	intuition: { id: 'pot_base_50_inst', caption: 'Зелье Прозрения', makeUp: 'intuition', values: new Array(0,15) },
	intellect: { id: 'pot_base_50_intel', caption: 'Зелье Разума ', makeUp: 'intellect', values: new Array(0,15) },
	separator0: null,
	intellect1: { id: 'pot_base_200_bot4', caption: 'Снадобье Разума', makeUp: 'intellect', values: new Array(0,20) },
	strength2: { id: 'pot_base_200_bot3', caption: 'Снадобье Великана', makeUp: 'strength', values: new Array(0,20) },
	dexterity2: { id: 'pot_base_200_bot2', caption: 'Снадобье Змеи', makeUp: 'dexterity', values: new Array(0,20) },
	intuition2: { id: 'pot_base_200_bot1', caption: 'Снадобье Предчувствия', makeUp: 'intuition', values: new Array(0,20) },
	separator1: null,
	intellect3: { id: 'pot_base_50_intel2', caption: 'Нектар Разума', makeUp: 'intellect', values: new Array(0,22) },
	intuition3: { id: 'pot_base_50_inst2', caption: 'Нектар Предчувствия', makeUp: 'intuition', values: new Array(0,22) },
	strength3: { id: 'pot_base_50_str2', caption: 'Нектар Великана', makeUp: 'strength', values: new Array(0,22) },
	dexterity3: { id: 'pot_base_50_dex2', caption: 'Нектар Змеи', makeUp: 'dexterity', values: new Array(0,22) },
	separator2: null,
    lovka20: { id: 'lovka20', caption: 'Древняя настойка Грации', makeUp: 'dexterity', values: new Array(0,25) },
	inte20: { id: 'inte20', caption: 'Древняя настойка Неукротимости', makeUp: 'intuition', values: new Array(0,25) }, 
	sila20: { id: 'sila20', caption: 'Древняя настойка Свирепости', makeUp: 'strength', values: new Array(0,25) },
	intelekt20: { id: 'intelekt20', caption: 'Древняя настойка Просветления', makeUp: 'intellect', values: new Array(0,25) },
//	strength4: { id: 'pot_base_200_bot_pm1', caption: 'Эликсир Силы Предков', makeUp: 'strength', values: new Array(0, 20, 22, 24, 26, 28, 30) },
//	strength6: { id: 'pot_base_1000_str', caption: 'Топливо для Големов', makeUp: 'strength', values: new Array(0, 12, 18) },
//	dexterity3: { id: 'pot_base_1000_dex', caption: 'Смазка для Големов', makeUp: 'dexterity', values: new Array(0, 12, 18) },
//	intuition3: { id: 'pot_base_1000_inst', caption: 'Ускоритель для Големов', makeUp: 'intuition', values: new Array(0, 12, 18) }
	};

var knownAdds = {
	
	};



var knownDamageElix = {
	standart_curse: {id: 'standart_curse', caption: 'Печать Хаоса', modify: {damage2: 25}},
	pot_base_0_strup: {id: 'pot_base_0_strup', caption: 'Эликсир Воинского Искусства', modify: {power: 33, damage1: 25, damage2: 50}},
	//ambrozija: {id: 'ambrozija', caption: 'Амброзия подмастерья Владык', modify: {antijumpaway:100}},
//НЕПАШЕТ     а так же и на мастерах неработает +33 магии
	//pot_base_0_strup_1: {id: 'pot_base_0_strup', caption: 'Новогодний Эликсир', modify: {magicpower: 50, magicdefencereduce: 10}},
	pot_base_0_ny3: {id: 'pot_base_0_ny3', caption: 'Эссенция Здоровья', modify: {hitpoints: 300}},
	//pot_base_0_ny1: {id: 'pot_base_0_ny1', caption: 'Снадобье -Тарманка-', modify: {power: 15,hitpoints: 60}}
	};

var knownDefElix = {
	//pot_base_50_kolproof: { places: new Array('eweapon'), id: 'pot_base_50_kolproof', caption: 'Зелье Пронзающих Игл', makeUp: 'thrustdefence', values: new Array(0, 50, 62) },
	//pot_base_50_rubproof: { places: new Array('eweapon'), id: 'pot_base_50_rubproof', caption: 'Зелье Свистящих Секир', makeUp: 'sabredefence', values: new Array(0, 50, 62) },
	//pot_base_50_drobproof: { places: new Array('eweapon'), id: 'pot_base_50_drobproof', caption: 'Зелье Тяжелых Молотов', makeUp: 'crushdefence', values: new Array(0, 50, 62) },
	//pot_base_50_rezproof: { places: new Array('eweapon'), id: 'pot_base_50_rezproof', caption: 'Зелье Сверкающих Лезвий', makeUp: 'cutdefence', values: new Array(0, 50, 62) },
	pot_base_50_damageproof: { places: new Array('eweapon'), id: 'pot_base_50_damageproof', caption: 'Эликсир Неуязвимости', makeUp: 'defence', values: new Array(0, 50, 62) },
	pot_base_200_alldmg2: { places: new Array('eweapon'), id: 'pot_base_200_alldmg2', caption: 'Великое зелье Стойкости', makeUp: 'defence', values: new Array(0, 75, 93) },
	pot_base_200_alldmg3: { places: new Array('eweapon'), id: 'pot_base_200_alldmg3', caption: 'Нектар Неуязвимости', makeUp: 'defence', values: new Array(0, 100, 125) },
	pot_base_200_alldmg2_p1k: { places: new Array('eweapon'), id: 'pot_base_200_alldmg2_p1k', caption: 'Зелье Каменной Стойкости', makeUp: 'defence', values: new Array(0, 120, 150) },
	separator3: null,
	//pot_base_50_fireproof: { places: new Array('emagic'), id: 'pot_base_50_fireproof', caption: 'Эликсир Пламени', makeUp: 'firemagicdefence', values: new Array(0, 50, 62) },
	//pot_base_50_airproof: { places: new Array('emagic'), id: 'pot_base_50_airproof', caption: 'Эликсир Ветра', makeUp: 'airmagicdefence', values: new Array(0, 50, 62) },
	//pot_base_50_waterproof: { places: new Array('emagic'), id: 'pot_base_50_waterproof', caption: 'Эликсир Морей', makeUp: 'watermagicdefence', values: new Array(0, 50, 62) },
	//pot_base_50_earthproof: { places: new Array('emagic'), id: 'pot_base_50_earthproof', caption: 'Эликсир Песков', makeUp: 'earthmagicdefence', values: new Array(0, 50, 62) },
	//pot_base_50_magicproof: { places: new Array('emagic'), id: 'pot_base_50_magicproof', caption: 'Эликсир Стихий', makeUp: 'magicdefence', values: new Array(0, 50, 62) },
	//pot_base_100_allmag1: { places: new Array('emagic'), id: 'pot_base_100_allmag1', caption: 'Малое зелье Отрицания', makeUp: 'magicdefence', values: new Array(0, 33, 41) },
	pot_base_200_allmag2: { places: new Array('emagic'), id: 'pot_base_200_allmag2', caption: 'Великое зелье Отрицания', makeUp: 'magicdefence', values: new Array(0, 75, 93) },
	pot_base_200_allmag3: { places: new Array('emagic'), id: 'pot_base_200_allmag3', caption: 'Нектар Отрицания', makeUp: 'magicdefence', values: new Array(0, 100, 125) },
	pot_base_200_allmag2_p1k: { places: new Array('emagic'), id: 'pot_base_200_allmag2_p1k', caption: 'Зелье Стража Магии', makeUp: 'magicdefence', values: new Array(0, 120, 150) }
	
	};
	//separator3: null,
	//pot_base_150_fireproof: { places: new Array('emagic'), id: 'pot_base_150_fireproof', caption: 'Эликсир Зарева', makeUp: 'firemagicdefence', values: new Array(0, 75, 93) },
	//pot_base_150_airproof: { places: new Array('emagic'), id: 'pot_base_150_airproof', caption: 'Эликсир Урагана', makeUp: 'airmagicdefence', values: new Array(0, 75, 93) },
	//pot_base_150_waterproof: { places: new Array('emagic'), id: 'pot_base_150_waterproof', caption: 'Эликсир Океанов', makeUp: 'watermagicdefence', values: new Array(0, 75, 93) },
	//pot_base_150_earthproof: { places: new Array('emagic'), id: 'pot_base_150_earthproof', caption: 'Эликсир Недр', makeUp: 'earthmagicdefence', values: new Array(0, 75, 93) },
	

var knownApplicableSpells = {
	spellIntel: { id: 'spell_stat_intel', caption: 'Холодный Разум', makeUp: 'intellect', values: new Array(0, 10), isSpell: true,check:0 },
	separator2: null,
		
	spellHitpointsUp: { id: 'spell_powerHPup{0}', caption: 'Жажда Жизни', makeUp: 'hitpoints', values: new Array(0, 1, 2, 3, 4 , 5, 6), isSpell: true,check:0 },
	spellHitpointsDown: { id: 'spell_powerHPdn{0}', caption: 'Иссушение', makeUp: 'hitpoints', values: new Array(0, -1, -2, -3, -4 , -5), isSpell: true,check:0 },
	spellBD: { id: 'spell_starshine',pic:'spell_starshine', caption: 'Звездное Сияние', makeUp: 'allstats', values: new Array(0,10), isSpell: true, check:1}
    
	};

var knownPowerUps = {
	spell_powerup10: {id:'spell_powerup10:',lbl:'Сокрушение', skill: 'greymagicskill', found: false, damageup: true,value:25},

	spell_protect10: {id:'spell_protect10',lbl:'Защита от Оружия',skill: 'greymagicskill', found: false, damageup: false,value:100}
	
	//spell_powerup1: {id:'spell_powerup1',lbl:'Огненное Усиление',skill: 'firemagicskill', found: false, damageup: true, element: 'fire',value:25,check:true},
	//spell_powerup2: {id:'spell_powerup2',lbl:'Водное Усиление',skill: 'watermagicskill', found: false, damageup: true, element: 'water',value:25,check:true},
	//spell_powerup3: {id:'spell_powerup3',lbl:'Воздушное Усиление',skill: 'airmagicskill', found: false, damageup: true, element: 'air',value:25,check:true},
	//spell_powerup4: {id:'spell_powerup4',lbl:'Земное Усиление',skill: 'earthmagicskill', found: false, damageup: true, element: 'earth',value:25,check:true},
	
	//spell_protect1: {id:'spell_protect1',lbl:'Защита от Огня',skill: 'firemagicskill', found: false, damageup: false, element: 'fire',value:100},
	//spell_protect2: {id:'spell_protect2',lbl:'Защита от Воды',skill: 'watermagicskill', found: false, damageup: false, element: 'water',value:100},
	//spell_protect3: {id:'spell_protect3',lbl:'Защита от Воздуха',skill: 'airmagicskill', found: false, damageup: false, element: 'air',value:100},
	//spell_protect4: {id:'spell_protect4',lbl:'Защита от Земли',skill: 'earthmagicskill', found: false, damageup: false, element: 'earth',value:100}
	
	};


var knownECRPowerUps = {
	//spell_godstat_str: {modify: 'strength', v: 100},
	//spell_godstat_dex: {modify: 'dexterity', v: 100},
	//spell_godstat_inst: {modify: 'intuition', v: 100},
	//spell_godprotect10: {modify: 'defence', v: 500},
	//spell_godprotect: {modify: 'magicdefence', v: 500},
  //invoke_spell_godintel100: {modify: 'intellect', v: 100},
	zma_spell: {modify: 'magicpower', v: 25},
    zma: {modify: 'magicdefence', v: 100},
 spell_startenacity: {modify: 'hitpoints', v: 300},
// больше 1 параметра не хочет распознавать=(
//standart_curse: {modify: 'maxdamage', v: 25},
//spell_starenergy: {modify: 'magicpower', v: 20, 'mana', v: 150}

//	separator2: null,   // статы от книг:
//invoke_plain_1s_str10: {modify: 'strength', v: 10}, //Зелёный Том Знаний
//invoke_plain_1s_dex10: {modify: 'dexterity', v: 10}, //Жёлтый Том Знаний
//invoke_plain_1s_inst10: {modify: 'intuition', v: 10}, //Красный Том Знаний
//invoke_plain_1s_intel10: {modify: 'intellect', v: 10}, //Синий Том Знаний
//invoke_plain_1s_all5: {modify: 'strength', v: 5, 'dexterity', v: 5, 'intuition', v: 5, 'intellect', v: 5}, //Белый том знаний
//invoke_plain_1s_spirit10: {modify: 'spirituality', v: 10}, // Черный Том Знаний
standart_effect: {modify: 'hitpoints', v: 120}
	};

var reSharpness = /\+(\d{1,2})$/;
var reDamage = /^Удар: ([0-9]*) - ([0-9]*)$/;
var reHeadArmor = /^Броня головы: ([0-9]*)-([0-9]*) \([0-9]*\+d[0-9]*\)$/;
var reBodyArmor = /^Броня корпуса: ([0-9]*)-([0-9]*) \([0-9]*\+d[0-9]*\)$/;
var reWaistArmor = /^Броня пояса: ([0-9]*)-([0-9]*) \([0-9]*\+d[0-9]*\)$/;
var reLegArmor = /^Броня ног: ([0-9]*)-([0-9]*) \([0-9]*\+d[0-9]*\)$/;
var reHitPoints = /^Уровень жизни: \+([0-9]+)$/

var combatSpells = {
	fireball: { id: 'fireball', magic: 'fire', critMultiplier: 3, elemental: true, minzero: false },
	lighting_bolt: { id: 'lighting_bolt', magic: 'air', critMultiplier: 1, elemental: true, minzero: true },
	showstorm: { id: 'showstorm', magic: 'water', critMultiplier: 1, elemental: true, minzero: false },
	stonerain: { id: 'stonerain', magic: 'earth', critMultiplier: 3, elemental: true, minzero: false },
	darkbolt: { id: 'darkbolt', magic: 'dark', critMultiplier: 3, elemental: false, minzero: false }
	};

var trickCategories = [
	{id: 'novice', caption: 'Приёмы&nbsp;новичков' },
	{id: 'fight', caption: 'Школа&nbsp;Оружия' },
	{id: 'fire', caption: 'Стихия&nbsp;Огня' },
	{id: 'air', caption: 'Стихия&nbsp;Воздуха' },
	{id: 'water', caption: 'Стихия&nbsp;Воды' },
	{id: 'earth', caption: 'Стихия&nbsp;Земли' },
	{id: 'light', caption: 'Школа&nbsp;Света' },
	{id: 'dark', caption: 'Школа&nbsp;Тьмы' },
	{id: 'grey', caption: 'Серая&nbsp;школа' }
	];

var helpChapterHtml = ''
	+ '<h4>Как пользоваться</h4>'
	+ '<p>Наша примерочная имеет простой интерфейс.</p>'
	+ '<p>При нажатии (кнопкой мыши) на любой слот манекена появляется меню, благодаря которому Вы можете надеть предмет.</p>'
	+ '<p>После того, как Вы одели предмет, с помощью этого меню Вы можете этот предмет заточить, улучшить до необходимого уровня, подогнать под комплект БК, '
	+ 'снять или подогнать броню под Вашего персонажа.</p>'
	+ '<p>Например, с помощью этого меню Вы можете надеть Меч Кромуса, затем улучшить его до 9 уровня, подогнать под комплект Кровавой Луны, и затем заточить на +10.</p>'
	+ '<p>Одетые Вами манекены Вы всегда можете сохранить или загрузить в виде текста. Для того, чтобы показать получившийся вариант другу, '
	+ 'достаточно передать ему адрес, который Вы увидите, выбрав команду &quot;Передать ссылку на этот комплект другу&quot;. '
	+ 'Кстати, при загрузке комплекта вместо текста можно указать дружескую ссылку на комплект.</p>'
	+ '<p>Также Вы можете быстро надеть один из предопределённых комплектов игры &quot;Бойцовский Клуб&quot;, выбрав пункт &quot;Надеть комплект БК&quot;, расположенный выше манекена персонажа.</p>'
	+ '<p>В примерочной предусмотрена возможность открывать несколько кабинок с помощью закладки &quot;Новая кабинка&quot;, чтобы Вы могли одевать и сравнивать различные варианты комплектов.</p>'
	+ '<p>Также Вы можете рассчитать стоимость переброса статов от одного комплекта к другому, открыв закладку &quot;Комната Знахаря&quot;.</p>'
	+ '<p>Встроенная таблица опыта доступна на закладке &quot;Таблица опыта&quot;.</p>'
	+ '<h4>Расчёт показателей</h4>'
	+ '<p>Для получения правильных результатов необходимо не только одеть манекен персонажа БК, но и обязательно ввести родные показатели персонажа.</p>'
	+ '<p>Примерочная ведёт расчёт показателей, исходя из данных Энциклопедии, а также учитывая эмпирическим путём выведенные нашим кланом формулы расчёта '
	+ '&quot;родных&quot; показателей, а также скрытые усиления и иные модификаторы.</p>'
	+ '<p>Естественно, результаты могут быть не совсем точными, к тому же необходимо учитывать то, что мир БК постоянно изменяется.</p>'
	+ '<p>Сравнить результирующие показатели комплектов во всех открытых кабинках можно, открыв закладку &quot;Сводная таблица&quot;.</p>'
	+ '<p>В отличие от расчётного модуля Инвентаря БК, расчётный модуль нашей Примерочной рассчитывает большее количество показателей, включая скрытые.</p>'
	+ '<p>Отличия расчётного модуля нашей Примерочной от расчётных модулей большинства известных Примерочных:</p>'
	+ '<ul><li>Мы рассчитываем реальные значения показателей, а не только от предметов;</li>'
	+ '<li>Мы правильно считаем показатели по зонам &quot;голова&quot;, &quot;корпус&quot;, &quot;пояс&quot;, &quot;ноги&quot;;</li>'
	+ '<li>Мы рассчитываем мощность сокрушения, защиты от урона, стихийного усиления и защиты от стихии (если надеть соответствующий свиток);</li>'
	+ '<li>Мы рассчитываем мощность урона от боевой магии, расходующей ману (если надеть соответствующий свиток).</li></ul>'
	+ '<p>В кабинках показатели выводятся в формате: текущее значение (всплывающая подсказка показывает расшифровку: родное значение + значение от комплекта) [требуемое значение]. '
	+ 'Если какое-либо значение является максимально возможным в БК, то оно выводится жирным текстом.</p>'
	+ '<p>Если текущее значение равно максимальному для кабинок, оно выводится зелёным цветом, иначе коричневым цветом. Если текущее значение меньше требуемого, то требуемое значение выделяется красным цветом.</p>'
	+ '<p><a href="#" class="TLink" onclick="hideMenu(); hideHelp(); return false">Скрыть справку</a>.</p>'
	;

var dressHints = new Array(
	'Вы легко можете узнать стоимость перекидки статов для перехода от одного комплекта к другому, открыв закладку &quot;Комната Знахаря&quot;.',
	'Если Вы оденете на манекен свиток сокрушения или иного стихийного усиления, то будет также рассчитана мощность накладываемого магом заклинания.',
	'Если Вы оденете на манекен свиток боевой магии, требующий ману, то будет также рассчитан урон боевого заклинания (для цели с нулевой защитой от магии).',
	'Для того, чтобы надеть артефакт, предположим, девятого уровня, просто оденьте артефакт, а затем нажмите на одетый артефакт, и выберите в меню пункт &quot;Улучшить&quot;.',
	'Для того, чтобы подогнать броню, нажмите на одетую броню, и выберите в меню пункт &quot;Подогнать броню&quot;.',
	'Для того, чтобы подогнать предмет под комплект БК, нажмите на одетый предмет, и выберите в меню пункт &quot;Подогнать под комплект&quot;.',
	'Примерочная долго грузится? Проверьте настройки Internet Explorer: Сервис | Свойства обозревателя, Дополнительно, Настройка HTTP 1.1 - галочки должны быть проставлены для обоих подпунктов.',
	'Для того, чтобы заточить оружие, нажмите на одетое оружие, и выберите в меню пункт &quot;Заточка на +X&quot;.',
	'По умолчанию устаревшие предметы типа Робы Торговца недоступны в меню выбора предмета. Но Вы всегда можете сделать их доступными, используя &quot;Фильтр&quot;.',
	'Если Вы хотите отключить визуальные эффекты, такие, как полупрозрачность, анимация или изображения предметов в списках, достаточно открыть &quot;Настройки&quot;.',
	'Начать примерку часто удобно, взяв за основу реально существующего персонажа БК, введя его ник: &quot;По персонажу БК&quot;.',
	'Если Вы хотите примерить один из комплектов БК, удобно выбрать комплект целиком из меню &quot;Надеть комплект БК&quot;.',
	'Чтобы увидеть реальные расчётные данные, необходимо одеть манекен и обязательно ввести статы и умения персонажа.',
	'Вы можете одновременно работать с несколькими вариантами экипировки, используя произвольное количество кабинок, нажав на закладку &quot;Новая кабинка&quot;.',
	'Вы можете легко сравнить разные варианты экипировки в открытых кабинках, открыв закладку &quot;Сводная таблица&quot;.'
	);

function setItemPropLabel(propName, newLabel)
{
	item_props[propName].lbl = newLabel;
}

function getItemPropLabel(propName)
{
	return item_props[propName].lbl;
}

function getItemPropFormattedValue(propName, value, maxvalue)
{
	var itemProp = item_props[propName];
	var actualValue = value;
	if (('maxvalue' in itemProp) && (value >= itemProp.maxvalue))
	{
		actualValue = itemProp.maxvalue.toString().bold();
	}
	var fmt = ('fmt' in itemProp) ? itemProp.fmt : '{0}';
	r = format(fmt, actualValue);
	if (maxvalue == null)
	{
		return r;
	}
	if (value !== maxvalue && value < maxvalue)
	{
		return r.fontcolor("brown");
	}
	return r.fontcolor("darkgreen");
}


function testStateProp(state, propName, value)
{
	var v = parseInt(value);
	var r = true
		&& (state != null)
		&& !isNaN(v)
		;
	if (r && (propName in state.results))
	{
		var sv = state.results[propName];
		if (propName in state.battlemf)
		{
			sv -= state.battlemf[propName];
		}
		r = (sv < v);
	}
	return r;
}

function getHtmlOfProp(state, obj, propDesc, propName, extension)
{
	if (obj == null || propDesc == null || !(propName in obj))
	{
		return '';
	}
	var fmt = ('fmt' in propDesc) ? propDesc.fmt : '{0}';
	var v = format(fmt, obj[propName]);
	var red = false;
	if (state != null)
	{
		red |= testStateProp(state, propName, obj[propName]);
	}
	if (red)
	{
		v = format('<font color="red">{0}</font>', v);
	}
	var r = propDesc.lbl + ': ' + v;
	if (extension  != null)
	{
		r += extension;
	}
	return r + '<br />';
}

function getHtmlOfSignedProp(obj, propDesc, propName, charm, rune, runeOpt)
{
	if (obj == null || propDesc == null || !(propName in obj))
	{
		return '';
	}
	var runeMods=null;
	if ((rune != null) && (runeOpt != null))
		{
		var appRune = getObjectById(rune);
		if ('modify' in appRune)
			{
			if ('opts' in appRune.modify)
				{
				if (appRune.modify.opts[runeOpt] != null)
					{
					runeMods=appRune.modify.opts[runeOpt];
					}
				}

			}
		}
	var fmt = ('fmt' in propDesc) ? propDesc.fmt : '{0}';
	var v = parseInt(obj[propName]);
	if (isNaN(v))
	{
		v = obj[propName];
	}
	else
	{
		var hasCharm = false;
		if ((charm != null) && (propName in charm))
		{
			v -= charm[propName];
			hasCharm = true;
		}

		var hasRune = false;
		if ((runeMods != null) && (propName in runeMods))
		{
			v -= runeMods[propName];
			hasRune = true;
		}
		if (v > 0)
		{
			v = '+' + v;
		}
		if (hasCharm)
		{
			v = '' + v + '<b>';
			if (charm[propName] > 0)
			{
				v += '+';
			}
			v += '' + charm[propName] + '</b>';
		}

		if (hasRune)
		{
			v = '' + v + '<i>';
			if (runeMods[propName] > 0)
			{
				v += '+';
			}
			v += '' + runeMods[propName] + '</i>';
		}
	}
	return propDesc.lbl + ': ' + format(fmt, v) + '<br />';
}

function getHtmlOfArmorProp(obj, basePropName, caption)
{
	var amin = null;
	var amax = null;
	if (obj == null)
	{
		return '';
	}
	if (basePropName in obj)
	{
		amax = amin = obj[basePropName];
	}
	else if ((basePropName + '1') in obj)
	{
		amin = obj[basePropName + '1'];
		amax = obj[basePropName + '2'];
	}
	if (amin == null)
	{
		return '';
	}
	return format('{0}: {1}-{2}<br />', caption, amin, amax);
}

function getDefAttackFreqFor(atype)
{
	return {id: atype, ideal: 25, real: 25, freal: 25, elemental: false};
}

function getAttackFreq(obj)
{
	if (obj == null || !('attacks' in obj))
	{
		return {
			thrust: getDefAttackFreqFor('thrust'),
			sabre: getDefAttackFreqFor('sabre'),
			crush: getDefAttackFreqFor('crush'),
			cut: getDefAttackFreqFor('cut')
		};
	}
	var totalv = 0;
	var r = new Object();
	for (var attackn in obj.attacks)
	{
		var iv = attackFreq['f' + obj.attacks[attackn]];
		var elemental = false;
		for (var nei = 0; nei < naturalElements.length; nei++)
		{
			if (naturalElements[nei] == attackn)
			{
				elemental = true;
				break;
			}
		}
		r[attackn] = {id:attackn, ideal: iv, elemental: elemental};
		totalv += iv;
	}
	for (var rn in r)
	{
		r[rn].real = (r[rn].ideal * 100.0) / totalv;
		r[rn].freal = Math.floor(r[rn].real * 100.0 + 0.5) / 100.0;
	}
	return r;
}

function areNotMagicGloves(o)
{
	return ((o != null) && (o.slot == 'w11') && (!('required' in o) || !('wisdom' in o.required) || (o.required.wisdom == 0)));
}

function isHeavyArmor(o)
{
	return ((o != null) && (o.slot == 'w4') && (o.category == 'heavyarmors'));
}

function isSecondaryWeapon(o)
{
	return ((o != null) && ('properties' in o) && ('secondweapon' in o.properties) && (o.properties.secondweapon == 'yes'));
}

function isTwohandledWeapon(o)
{
	return ((o != null) && ('properties' in o) && ('twohandled' in o.properties) && (o.properties.twohandled == 'yes'));
}

function getJSName(id)
{
	if (id == null)
	{
		return null;
	}
	if (id.length > 0)
	{
		if (id.charAt(0) >= '0' && id.charAt(0) <= '9')
		{
			id = '_' + id;
		}
	}
	return replacestr(replacestr(id, '.', '_'), '-', '_');
}

function getObjectById(objid)
{
	if (objid == null)
	{
		return null;
	}
	return dressItems[getJSName(objid)];
}

function getSetById(setid)
{
	return dressSets[getJSName(setid)];
}

function getSetAndCountById(setCountId)
{
	for (var setn in dressSets)
	{
		var set = dressSets[setn];
		if (!('details' in set))
		{
			continue;
		}
		for (var scn in set.details)
		{
			if (scn == setCountId)
			{
				return {set: set, count: set.details[scn]};
			}
		}
	}
	return {set: null, count: null};
}

function getSetCountById(setCountId)
{
	var r = getSetAndCountById(setCountId);
	return r.count;
}

function getCountForSet(state, setid)
{
	if (state == null)
	{
		return 0;
	}
	var countFound = 0;
	var set = getSetById(setid);
	for (var sloti = 0; sloti < slots.length; sloti++)
	{
		var slot = slots[sloti];
		var o = getObjectByStateSlot(state, slot);
		if (o == null || !('setlink' in o) || (o.setlink.name != set.id))
		{
			continue;
		}
		countFound++;

		if (isTwohandledWeapon(o))
		{
			countFound++;
		}
	}
	return countFound;
}

function getStrengtheningById(strengtheningid)
{
	return dressStrengthenings[strengtheningid];
}

function getObjectDescHtml(state, obj)
{
	var i;
	var html = '';
	var addinfo = '';
	var level = 0;
	if (('required' in obj) && ('level' in obj.required))
	{
		level = obj.required.level;
	}
	var artefact = (('artefact' in obj) && obj.artefact);
	var old = (('old' in obj) && obj.old);
	var imp1 = (('imp1' in obj) && obj.imp1);
	var showTeeth = (level < 8) && !artefact && !old && !imp1;
	html += obj.caption.bold();
	if (('showlevel' in obj) && obj.showlevel && ('level' in obj))
	{
		html += '&nbsp;<b>[' + obj.level + ']</b>';
	}
	if (artefact)
	{
		html += format('&nbsp;<img src="{0}artefact.gif" width="18" height="16" border="0" alt="Artefact" />', baseImgPath);
	}
	if ('alignment' in obj)
	{
		html += format('&nbsp;' + alignImages[obj.alignment], baseImgPath);
	}
	if ('binding' in obj)
	{
		switch (obj.binding)
		{
		case 'bop':
			html += '&nbsp;<img src="' + baseImgPath + 'destiny.gif" style="filter: invert()" border="0" width="16" height="18" alt="' + localizer.bop + '" />';
			break;
		case 'boe':
			html += '&nbsp;<img src="' + baseImgPath + 'destiny.gif" style="filter: gray()" border="0" width="16" height="18" alt="' + localizer.boe + '" />';
			break;
		}
	}
	else if ('destiny' in obj)
	{
		html += '&nbsp;<img src="' + baseImgPath + 'destiny.gif" border="0" width="16" height="18" alt="' + obj.destiny + '" />';
	}
	if (('wasFit' in obj) && obj.wasFit)
	{
		html += '&nbsp;' + localizer.wasFit;
	}
	if (('wasUpgrade' in obj) && obj.wasUpgrade)
	{
		html += '&nbsp;' + localizer.wasUpgrade;
	}
	if (old)
	{
		html += '&nbsp;[old]';
	}
	if (imp1)
	{
		html += '&nbsp;' + localizer.impitem;
	}
	if (('wasCharmed' in obj) && obj.wasCharmed)
	{
		html += '&nbsp;' + localizer.wasCharmed;
	}
	if (('wasAdded' in obj) && obj.wasAdded)
	{
		html += '&nbsp;' + localizer.wasAdded;
	}
	html += '<br />';

	if (('wasRuned' in obj) && ('rune' in obj))
	{
		var appRune = getObjectById(obj.rune);
		if ('caption' in appRune)
			{
			html += '<i>'+localizer.wasRuned + ':&nbsp;' + appRune.caption.bold() + '</i><br />';
			}
	}
	if ('owner' in obj)
	{
		html += localizer.ownedBy + '<b>' + obj.owner + '</b><br />';
	}
	if ('clan' in obj)
	{
		html += localizer.ownedBy + '<img src="' + clanImgPath + obj.clan + '.gif" width="24" height="15" border="0" /><b>' + obj.clan + '</b><br />';
	}
	if (('resources' in obj) || (('consumes' in obj) && ('spiritlevel' in obj.consumes)))
	{
		var rhtml = '';
		if ('resources' in obj)
		{
			for (var rn in obj.resources)
			{
				rhtml += '<img src="' + trickResourceImgPath + rn + '.gif" width="8" height="8" border="0" />';
				rhtml += ' ' + obj.resources[rn] + ' ';
			}
		}
		if (('consumes' in obj) && ('spiritlevel' in obj.consumes))
		{
			rhtml += '<img src="' + trickResourceImgPath + 'spirit.gif" width="8" height="8" border="0" />';
			rhtml += ' ' + obj.consumes.spiritlevel + ' ';
		}
		if (rhtml != '')
		{
			html += '<span style="font-size: 10px; font-family: Verdana, Arial, Helvetica;">';
			html += rhtml;
			html += '</span><br />';
		}
	}
	if ('count' in obj)
	{
		html += format(localizer.aboutSetCount, obj.count) + '<br />';
	}
	if ('upgrade' in obj)
	{
		html += localizer.canUpgrade + '<br />';
	}
	if ((('artefact' in obj) && obj.artefact) || (('adjustment' in obj) && obj.adjustment))
	{
		html += localizer.canFit + '<br />';
	}
	if ('common' in obj)
	{
		for (var mfname in common_props)
		{
			if (!common_props[mfname].view)
			{
				continue;
			}
			var extension = '';
			if (mfname == 'price' && showTeeth && ('price' in obj.common))
			{
				extension += ' (';
				var price = obj.common.price;
				if (price >= 100)
				{
					extension += Math.floor(price / 100);
					price = price % 100;
					extension += '<img width="7" height="7" border="0" alt="" src="' + toothImgPath + 'zub_low1.gif" title="Чистый зуб" />';
				}
				if (price >= 10)
				{
					extension += Math.floor(price / 10);
					price = price % 10;
					extension += '<img width="7" height="7" border="0" alt="" src="' + toothImgPath + 'zub_low3.gif" title="Нормальный зуб" />';
				}
				if (price > 0)
				{
					extension += price;
					extension += '<img width="7" height="7" border="0" alt="" src="' + toothImgPath + 'zub_low4.gif" title="Гнилой зуб" />';
				}
				extension += ')';
			}
			html += getHtmlOfProp(null, obj.common, common_props[mfname], mfname, extension);

		}
		if (('probability' in obj.common) && item_props.probability.view)
		{
			html += item_props.probability.lbl + ': ';
			var probability = obj.common.probability;
			html += getItemPropFormattedValue('probability', probability);
			if (state != null)
			{
				var ointellect = 0;
				if (('required' in obj) && ('intellect' in obj.required))
				{
					ointellect = obj.required.intellect;
				}
				if (('results' in state) && ('intellect' in state.results))
				{
					html += ' ('+ localizer.probabilityReal + ' ';
					if (state.results.intellect < ointellect)
					{
						html += localizer.probabilityNever;
					}
					else
					{
					    var realprobability = (probability * (1 + (state.results.intellect - ointellect) * 0.03));
					    realprobability = Math.floor(realprobability * 100.0 + 0.5) / 100.0;
					    if (realprobability > 99.0)
					    {
						    realprobability = 99.0;
					    }
    					html += getItemPropFormattedValue('probability', realprobability);
					}
					html += ')';
				}
			}
			html += '<br />';
		}
	}
	var comsumationHtml = '';
	var absConsumeMultiplier = 1;
	if (state != null && state.natural.spirituality >= 75)
	{
		absConsumeMultiplier = 0.5;
	}
	for (var acn in absoluteSpiritConsumers)
	{
		var ac = absoluteSpiritConsumers[acn];
		if (ac.id == obj.id)
		{
			comsumationHtml += getItemPropLabel('spiritlevel');
			comsumationHtml += ': ';
			comsumationHtml += ac.spirit * absConsumeMultiplier;
			comsumationHtml += '<br />';
			break;
		}
	}
	for (var rcn in relativeSpiritConsumers)
	{
		var rc = relativeSpiritConsumers[rcn];
		if (rc.id == obj.id)
		{
			comsumationHtml += getItemPropLabel('spiritlevel');
			comsumationHtml += ': ';
			var sl = Math.floor((rc.hp * 1000.0) / state.results.hitpoints) / 100;
			comsumationHtml += sl;
			comsumationHtml += '<br />';
	    		break;
		}
	}
	if (comsumationHtml != '')
	{
		html += localizer.itemComsumesGroup.bold() + '<br />';
		html += comsumationHtml;
	}
	if ('required' in obj)
	{
		html += localizer.itemRequiredGroup.bold() + '<br />';
		if ('sex' in obj.required)
		{
   			var statesex = state.sex ? 'female' : 'male';
			var itemProp = item_props['sex'];
			if (itemProp.view)
			{
				html += getItemPropLabel('sex');
				html += ': ';
				if (statesex != obj.required.sex)
				{
					html += '<font color="red">';
				}
				html += (obj.required.sex == 'male') ? 'мужской': 'женский';
				if (statesex != obj.required.sex)
				{
					html += '</font>';
				}
				html += '<br />';
			}
		}

		for (var mfname in item_props)
		{
			var itemProp = item_props[mfname];
			if (!itemProp.view)
			{
				continue;
			}
			if (('required' in itemProp) && itemProp.required)
			{
				html += getHtmlOfProp(state, obj.required, itemProp, mfname);
			}
		}
		if (isTwohandledWeapon(obj))
		{
			html += localizer.twohandledWeapon + '<br />';
		}
		if ('zodiacs' in obj)
		{
			html += 'Знак зодиака: ';
			var firstz = true;
			for (var zn in obj.zodiacs)
			{
				var z = obj.zodiacs[zn];
				if (firstz)
				{
					firstz = false;
				}
				else
				{
					html += ', ';
				}
				html += z.caption;
			}
			html += '<br />';
		}
		if ('capitalreputation' in obj.required)
		{
			html += 'Репутация в Capital city: ' + obj.required.capitalreputation;
			if (obj.required.capitalreputation >= 10000)
			{
				html += '<img src="' + brandImgPath + '1.gif" width="34" height="19" border="0" />';
			}
			html += '<br />';
		}
		if ('angelsreputation' in obj.required)
		{
			html += 'Репутация в Angels city: ' + obj.required.angelsreputation;
			if (obj.required.angelsreputation >= 10000)
			{
				html += '<img src="' + brandImgPath + '2.gif" width="34" height="19" border="0" />';
			}
			html += '<br />';
		}
		if ('sandreputation' in obj.required)
		{
			html += 'Репутация в Sand city: ' + obj.required.sandreputation;
			if (obj.required.sandreputation >= 10000)
			{
				html += '<img src="' + brandImgPath + '7.gif" width="34" height="19" border="0" />';
			}
			html += '<br />';
		}
		if ('demonsreputation' in obj.required)
		{
			html += 'Репутация в Demons city: ' + obj.required.demonsreputation;
			if (obj.required.demonsreputation >= 10000)
			{
				html += '<img src="' + brandImgPath + '3.gif" width="34" height="19" border="0" />';
			}
			html += '<br />';
		}
		if ('baltarreputation' in obj.required)
		{
			html += 'Пожертвовано рубинов на Алтарь Крови: ' + obj.required.baltarreputation;
			if (obj.required.baltarreputation >= 100)
			{
			html += '<img src="' + brand2ImgPath + 'znbl_1.gif" width="35" height="24" border="0" />';
			}
			html += '<br />';
		}
	}
	if ('modify' in obj)
	{
		html += localizer.itemModifyGroup.bold() + '<br />';

		//"Variable actions for different runes
		if ('opts' in obj.modify)
			{
			if (obj.modify.opts.length >= 1)
				{
				html += localizer.opt_choices + ':<br />';
				for (var a=0; a<= obj.modify.opts.length-1; a++)
					{
					for (var imod in obj.modify.opts[a])
						{
						if (!item_props[imod])
							{ continue; }
						html += '<li> '+getHtmlOfSignedProp(obj.modify.opts[a], item_props[imod], imod, null, null, null)+'</li>';
						}
					}
				html += '<br>';
				}
			}

		for (var mfname in item_props)
		{
			if (!item_props[mfname].view)
			{
				continue;
			}
			html += getHtmlOfSignedProp(obj.modify, item_props[mfname], mfname, obj.charms, obj.rune, obj.runeOpt);
		}
		for (var armorn in knownArmorModifiers)
		{
			if (!item_props[armorn].view)
			{
				continue;
			}
			html += getHtmlOfArmorProp(obj.modify, armorn, getItemPropLabel(armorn));
		}



	}
	if ('properties' in obj)
	{
		html += localizer.itemPropertiesGroup.bold() + '<br />';
		for (var mfname in item_props)
		{
			if (!item_props[mfname].view)
			{
				continue;
			}
			html += getHtmlOfSignedProp(obj.properties, item_props[mfname], mfname);
		}
		if (isTwohandledWeapon(obj))
		{
			addinfo += localizer.twohandledWeapon + '<br />';
		}
		if (isSecondaryWeapon(obj))
		{
			addinfo += localizer.secondaryWeapon + '<br />';
		}
		if ('blockzones' in obj.properties)
		{
			addinfo += localizer.blockZones + ': <b>' + obj.properties.blockzones + '</b><br />';
		}
	}
	if ('magic1' in obj)
	{
		addinfo += localizer.useMagic;
		addinfo += ' ';
		addinfo += obj.magic1;
		addinfo += '<br />';
	}
	if ('magic' in obj)
	{
		addinfo += localizer.hasMagic;
		addinfo += ' ';
		if ('name' in obj.magic)
		{
			var alt = '';
			if ('caption' in obj.magic)
			{
				alt = format(' alt="{0}"', obj.magic.caption);
			}
			addinfo += format('<img src="{2}{0}.gif" width="40" height="25" border="0"{1} />', obj.magic.name, alt, itemImgPath);
			addinfo += ' ';
		}
		if ('description' in obj.magic)
		{
			addinfo += obj.magic.description;
		}
		addinfo += '<br />';
	}
	if ('setlink' in obj)
	{
		var set = getSetById(obj.setlink.name);
		addinfo += format(localizer.partOfSet, set.caption, getCountForSet(state, set.id), set.count);
		addinfo += '<br />';
	}
	if (('fixless' in obj) && obj.fixless)
	{
		addinfo += localizer.fixless;
		addinfo += '<br />';
	}
	if (('artefact' in obj) && obj.artefact)
	{
		addinfo += localizer.fixless;
		addinfo += '<br />';
		addinfo += localizer.charmless;
		addinfo += '<br />';
	}
	if ('description' in obj)
	{
		addinfo += obj.description;
		addinfo += '<br />';
	}

	if (addinfo != '')
	{
		html += localizer.itemAddInfoGroup.italics() + '<br />';
		html += addinfo;
	}
	if ('attacks' in obj)
	{
		var af = getAttackFreq(obj);
		html += localizer.itemAttackGroup.italics() + '<br />';

		for (var attackn in obj.attacks)
		{
			var attackt = 'attackt' + attackn;
			if (attackt in localizer)
			{
				attackt = localizer[attackt];
			}
			else
			{
				attackt = attackn;
			}
			var attackq = 'attackq' + obj.attacks[attackn];
			if (attackq in localizer)
			{
				attackq = localizer[attackq];
			}
			else
			{
				attackq = obj.attacks[attackn];
			}
			var attackf = af[attackn].freal;
			html += attackt + ': ' + attackq + ' (' + attackf + '%)<br />';
		}
	}
	if ('defences' in obj)
	{
		html += localizer.itemDefenceGroup.italics() + '<br />';
		for (var defencen in obj.defences)
		{
			var defencet = 'defencet' + defencen;
			if (defencet in localizer)
			{
				defencet = localizer[defencet];
			}
			else
			{
				defencet = defencen;
			}
			var defenceq = 'defenceq' + obj.defences[defencen];
			if (defenceq in localizer)
			{
				defenceq = localizer[defenceq];
			}
			else
			{
				defenceq = obj.defences[defencen];
			}
			html += defencet + ': ' + defenceq + '<br />';
		}
	}
	return html;
}

// serialization

function serializeValue(v)
{
	var r = '';
	if (v == null)
	{
		r += '0//';
	}
	else
	{
		if (typeof (v) == 'string')
		{
			r += "s/'";
			r += escape(v);
			r += "'/";
		}
		else if (typeof (v) == 'boolean')
		{
			r += 'b/';
			r += v ? 'Y' : 'N';
			r += '/';
		}
		else if (typeof (v) == 'number')
		{
			r += 'n/';
			r += v.toString();
			r += '/';
		}
		else if (typeof (v) == 'object')
		{
			if (v instanceof Array)
			{
				r += 'a/';
				r += serializeArray(v);
				r += '/';
			}
			else
			{
				r += 'o/';
				r += serializeObject(v);
				r += '/';
			}
		}
	}
	return r;
}

function serializeArray(a)
{
	var r = '';
	for (var i = 0; i < a.length; i++)
	{
		if (r != '')
		{
			r += ',';
		}
		r += serializeValue(a[i]);
	}
	r = '(' + r + ')';
	return r;
}

function serializeObject(obj)
{
	var r = '';
	for (var propName in obj)
	{
		if (r != '')
		{
			r += ',';
		}
		var v = obj[propName];
		r += propName;
		r += '/';
		r += serializeValue(v);
	}
	r = '{' + r + '}';
	return r;
}

function reqContextChar(context)
{
	var found = false;
	var c = context.s.charAt(context.index);
	var msg = '';
	for (var i = 1; i < reqContextChar.arguments.length; i++)
	{
		if (c == reqContextChar.arguments[i])
		{
			found = true;
			break;
		}
		if (msg != '')
		{
			msg += ' or ';
		}
		msg += '"' + reqContextChar.arguments[i] + '"';
	}
	if (!found)
	{
		context.errorMessage = 'cannot deserialize value. we expect ' + msg + ' character at index ' + context.index + '.';
		context.errorFound = true;
	}
	return found;
}

function readSerializedValue(context)
{
	var c;
	var vt = context.s.charAt(context.index);
	context.index++;
	switch (vt)
	{
		case '0':
			reqContextChar(context, ':', '/');
			context.index++;
			reqContextChar(context, ':', '/');
			context.index++;
			context.valueRead = null;
			break;
		case 's':
			reqContextChar(context, ':', '/');
			context.index++;
			reqContextChar(context, "'");
			context.index++;
			var nextAposIndex = context.s.indexOf("'", context.index);
			if (nextAposIndex < 0)
			{
				context.errorMessage = 'cannot deserialize string value. we expect end &apos; character after index ' + context.index + '.';
				context.errorFound = true;
				return;
			}
			context.valueRead = unescape(context.s.substring(context.index, nextAposIndex));
			context.index = nextAposIndex + 1;
			reqContextChar(context, ':', '/');
			context.index++;
			break;
		case 'b':
			reqContextChar(context, ':', '/');
			context.index++;
			reqContextChar(context, 'Y', 'N');
			c = context.s.charAt(context.index);
			context.valueRead = (c == 'Y');
			context.index++;
			reqContextChar(context, ':', '/');
			context.index++;
			break;
		case 'n':
			reqContextChar(context, ':', '/');
			context.index++;
			var nextTwoDotIndex = context.s.indexOf(":", context.index);
			var nextSlashIndex = context.s.indexOf("/", context.index);
			if (nextTwoDotIndex < 0 || (nextSlashIndex >= 0 && nextTwoDotIndex > nextSlashIndex))
			{
				nextTwoDotIndex = nextSlashIndex;
			}
			if (nextTwoDotIndex < 0)
			{
				context.errorMessage = 'cannot deserialize number value. we expect end ":" or "/" character after index ' + context.index + '.';
				context.errorFound = true;
				return;
			}
			var v = context.s.substring(context.index, nextTwoDotIndex);
			context.valueRead = (v.indexOf('.') >= 0) ? parseFloat(v) : parseInt(v);
			context.index = nextTwoDotIndex + 1;
			break;
		case 'a':
			reqContextChar(context, ':', '/');
			context.index++;
			readSerializedArray(context);
			if (context.errorFound)
			{
				return;
			}
			reqContextChar(context, ':', '/');
			context.index++;
			break;
		case 'o':
			reqContextChar(context, ':', '/');
			context.index++;
			readSerializedObject(context);
			if (context.errorFound)
			{
				return;
			}
			reqContextChar(context, ':', '/');
			context.index++;
			break;
		default:
			context.errorMessage = 'cannot deserialize unknown value. unexpected type prefix ' + vt;
			context.errorFound = true;
			break;
	}
}

function readSerializedArray(context)
{
	var valueRead = new Array();
	var c;
	reqContextChar(context, '(');
	context.index++;
	c = context.s.charAt(context.index);
	if (c == ")")
	{
		context.index++;
		context.valueRead = valueRead;
		return;
	}
	for (;!context.errorFound; context.index++)
	{
		readSerializedValue(context);
		if (context.errorFound)
		{
			return;
		}
		var v = context.valueRead;
		valueRead.push(v);
		c = context.s.charAt(context.index);
		if (c == ")")
		{
			context.index++;
			context.valueRead = valueRead;
			return;
		}
		if (c != ",")
		{
			context.errorMessage = 'cannot deserialize array value. we expect "," or ")" character at index ' + context.index + '.';
			context.errorFound = true;
			return;
		}
	}
}

function readSerializedObject(context)
{
	var valueRead = new Object();
	var c;
	reqContextChar(context, '{');
	context.index++;
	c = context.s.charAt(context.index);
	if (c == "}")
	{
		context.index++;
		context.valueRead = valueRead;
		return;
	}
	for (;!context.errorFound; context.index++)
	{
		var nextTwoDotIndex = context.s.indexOf(":", context.index);
		var nextSlashIndex = context.s.indexOf("/", context.index);
		if (nextTwoDotIndex < 0 || (nextSlashIndex >= 0 && nextTwoDotIndex > nextSlashIndex))
		{
			nextTwoDotIndex = nextSlashIndex;
		}
		if (nextTwoDotIndex <= 0)
		{
			context.errorMessage = 'cannot deserialize object property name. we expect ":" or "/" character after index ' + context.index + '.';
			context.errorFound = true;
			return;
		}
		var propName = context.s.substring(context.index, nextTwoDotIndex);
		context.index = nextTwoDotIndex + 1;
		readSerializedValue(context);
		if (context.errorFound)
		{
			return;
		}
		var v = context.valueRead;
		valueRead[propName] = v;
		c = context.s.charAt(context.index);
		if (c == "}")
		{
			context.index++;
			context.valueRead = valueRead;
			return;
		}
		if (c != ",")
		{
			context.errorMessage = 'cannot deserialize object value. we expect "," or "}" character at index ' + context.index + '.';
			context.errorFound = true;
			return;
		}
	}
}

function deserializeObject(s)
{
	// drop CR/LF and spaces if any was entered by user.
	s = replacestr(replacestr(replacestr(s, "\n", ''), "\r", ''), ' ', '');
	var context = { s: s, index: 0, errorFound: false, errorMessage: '', valueRead: null };
	readSerializedObject(context);
	if (context.errorFound)
	{
		alert(context.errorMessage);
		return null;
	}
	return context.valueRead;
}

function deserializeArray(s)
{
	// drop CR/LF if any was entered by user.
	s = replacestr(replacestr(s, "\n", ''), "\r", '');
	var context = { s: s, index: 0, errorFound: false, errorMessage: '', valueRead: null };
	readSerializedArray(context);
	if (context.errorFound)
	{
		alert(context.errorMessage);
		return null;
	}
	return context.valueRead;
}

function createVirtualSet(name, caption, count, sitems)
{
	var level = 0;
	var items = sitems.split('/');
	for (var i in items)
	{
		var item = getObjectById(items[i]);
		if (item == null) continue;
		item.setlink = { name: name };
		if (!('baseitem' in item) && ('required' in item) && ('level' in item.required) && (item.required.level > level))
		{
			level = item.required.level;
		}
	}
	var details = {};
//	details[name + count] = { id: name + count, required: { itemscount: count }};
	var o = {id: name, virtual: true, caption: caption, count: count, required: { level: level }, details: details };
	dressSets[name] = o;
}

function createVirtualSets()
{
	

}

var catRunes={
shirts: {
   lv4: ['rune_0_0_1', 'rune_0_1_1', 'rune_0_2_1', 'rune_0_3_1'
], lv7: ['rune_1_0_1', 'rune_1_1_1', 'rune_1_2_1', 'rune_1_3_1'
], lv9: ['rune_2_0_1', 'rune_2_1_10', 'rune_2_2_1', 'rune_2_3_1'] },
shields: {
   lv4: ['rune_0_0_1', 'rune_0_1_1', 'rune_0_2_1', 'rune_0_3_1'
], lv7: ['rune_1_0_1', 'rune_1_1_1', 'rune_1_2_1', 'rune_1_3_1'
], lv9: ['rune_2_0_1', 'rune_2_1_10', 'rune_2_2_1', 'rune_2_3_1'] },
capes: {
   lv4: ['rune_0_0_1', 'rune_0_1_1', 'rune_0_2_1', 'rune_0_3_1'
], lv7: ['rune_1_0_1', 'rune_1_1_1', 'rune_1_2_1', 'rune_1_3_1'
], lv9: ['rune_2_0_1', 'rune_2_1_10', 'rune_2_2_1', 'rune_2_3_1'] },
staffs: {
   lv4: ['rune_0_0_1', 'rune_0_1_1', 'rune_0_2_1', 'rune_0_3_1'
], lv7: ['rune_1_0_1', 'rune_1_1_1', 'rune_1_2_1', 'rune_1_3_1'
], lv9: ['rune_2_0_1', 'rune_2_1_10', 'rune_2_2_1', 'rune_2_3_1'] },
swords: {
   lv4: ['rune_0_0_1', 'rune_0_1_1', 'rune_0_2_1', 'rune_0_3_1'
], lv7: ['rune_1_0_1', 'rune_1_1_1', 'rune_1_2_1', 'rune_1_3_1'
], lv9: ['rune_2_0_1', 'rune_2_1_10', 'rune_2_2_1', 'rune_2_3_1'] },
clubs: {
   lv4: ['rune_0_0_1', 'rune_0_1_1', 'rune_0_2_1', 'rune_0_3_1'
], lv7: ['rune_1_0_1', 'rune_1_1_1', 'rune_1_2_1', 'rune_1_3_1'
], lv9: ['rune_2_0_1', 'rune_2_1_10', 'rune_2_2_1', 'rune_2_3_1'] },
axes: {
   lv4: ['rune_0_0_1', 'rune_0_1_1', 'rune_0_2_1', 'rune_0_3_1'
], lv7: ['rune_1_0_1', 'rune_1_1_1', 'rune_1_2_1', 'rune_1_3_1'
], lv9: ['rune_2_0_1', 'rune_2_1_10', 'rune_2_2_1', 'rune_2_3_1'] },
knives: {
   lv4: ['rune_0_0_1', 'rune_0_1_1', 'rune_0_2_1', 'rune_0_3_1'
], lv7: ['rune_1_0_1', 'rune_1_1_1', 'rune_1_2_1', 'rune_1_3_1'
], lv9: ['rune_2_0_1', 'rune_2_1_10', 'rune_2_2_1', 'rune_2_3_1'] },
wreaths: {
   lv4: ['rune_0_0_1', 'rune_0_1_1', 'rune_0_2_1', 'rune_0_3_1'
], lv7: ['rune_1_0_1', 'rune_1_1_1', 'rune_1_2_1', 'rune_1_3_1'
], lv9: ['rune_2_0_1', 'rune_2_1_10', 'rune_2_2_1', 'rune_2_3_1'] },
earrings: {
   lv4: ['rune_0_0_1', 'rune_0_1_1', 'rune_0_2_1', 'rune_0_3_1'
], lv7: ['rune_1_0_1', 'rune_1_1_1', 'rune_1_2_1', 'rune_1_3_1'
], lv9: ['rune_2_0_1', 'rune_2_1_10', 'rune_2_2_1', 'rune_2_3_1'] },
necklaces: {
   lv4: ['rune_0_0_2', 'rune_0_1_2', 'rune_0_2_2', 'rune_0_3_2'
], lv7: ['rune_1_0_2', 'rune_1_1_2', 'rune_1_2_2', 'rune_1_3_2'
], lv9: ['rune_2_0_2', 'rune_2_1_1', 'rune_2_2_2', 'rune_2_3_2'] },
rings: {
   lv4: ['rune_0_0_3', 'rune_0_1_3', 'rune_0_2_3', 'rune_0_3_3'
], lv7: ['rune_1_0_3', 'rune_1_1_3', 'rune_1_2_3', 'rune_1_3_3'
], lv9: ['rune_2_0_3', 'rune_2_1_2', 'rune_2_2_3', 'rune_2_3_3'] },
gauntlets: {
   lv4: ['rune_0_0_4', 'rune_0_1_4', 'rune_0_2_4', 'rune_0_3_4'
], lv7: ['rune_1_0_4', 'rune_1_1_4', 'rune_1_2_4', 'rune_1_3_4'
], lv9: ['rune_2_0_4', 'rune_2_1_3', 'rune_2_2_4', 'rune_2_3_4'] },
pants: {
   lv4: ['rune_0_0_5', 'rune_0_1_5', 'rune_0_2_5', 'rune_0_3_5'
], lv7: ['rune_1_0_5', 'rune_1_1_5', 'rune_1_2_5', 'rune_1_3_5'
], lv9: ['rune_2_0_5', 'rune_2_1_4', 'rune_2_2_5', 'rune_2_3_5'] },
boots: {
   lv4: ['rune_0_0_6', 'rune_0_1_6', 'rune_0_2_6', 'rune_0_3_6'
], lv7: ['rune_1_0_6', 'rune_1_1_6', 'rune_1_2_6', 'rune_1_3_6'
], lv9: ['rune_2_0_6', 'rune_2_1_5', 'rune_2_2_6', 'rune_2_3_6'] },
helmets: {
   lv4: ['rune_0_0_7', 'rune_0_1_7', 'rune_0_2_7', 'rune_0_3_7'
], lv7: ['rune_1_0_7', 'rune_1_1_7', 'rune_1_2_7', 'rune_1_3_7'
], lv9: ['rune_2_0_7', 'rune_2_1_6', 'rune_2_2_7', 'rune_2_3_7'] },
bracelets: {
   lv4: ['rune_0_0_8', 'rune_0_1_8', 'rune_0_2_8', 'rune_0_3_8'
], lv7: ['rune_1_0_8', 'rune_1_1_8', 'rune_1_2_8', 'rune_1_3_8'
], lv9: ['rune_2_0_8', 'rune_2_1_7', 'rune_2_2_8', 'rune_2_3_8'] },
heavyarmors: {
   lv4: ['rune_0_0_9', 'rune_0_1_9', 'rune_0_2_9', 'rune_0_3_9'
], lv7: ['rune_1_0_9', 'rune_1_1_9', 'rune_1_2_9', 'rune_1_3_9'
], lv9: ['rune_2_0_9', 'rune_2_1_8', 'rune_2_2_9', 'rune_2_3_9'] },
lightarmors: {
   lv4: ['rune_0_0_9', 'rune_0_1_9', 'rune_0_2_9', 'rune_0_3_9'
], lv7: ['rune_1_0_9', 'rune_1_1_9', 'rune_1_2_9', 'rune_1_3_9'
], lv9: ['rune_2_0_9', 'rune_2_1_8', 'rune_2_2_9', 'rune_2_3_9'] },
belts: {
   lv4: ['rune_0_0_10', 'rune_0_1_10', 'rune_0_2_10', 'rune_0_3_10'
], lv7: ['rune_1_0_10', 'rune_1_1_10', 'rune_1_2_10', 'rune_1_3_10'
], lv9: ['rune_2_0_10', 'rune_2_1_9', 'rune_2_2_10', 'rune_2_3_10']}};

var superRunes=['rune_super_1', 'rune_super_2', 'rune_super_3', 'rune_super_4', 'rune_super_5', 'rune_super_6', 'rune_super_7', 'rune_super_8', 'rune_super_9', 'rune_super_10'];
