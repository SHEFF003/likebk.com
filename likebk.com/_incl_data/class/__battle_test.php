<?
if(!defined('GAME')) { die(); }

//ini_set('memory_limit','256M');

class battleClass {	
	public $mncolor = array(1=>'006699',2=>'006699',3=>'006699',4=>'006699',5=>'006699',6=>'006699',7=>'006699'); //не крит
	public $mcolor = array(1=>'A00000',2=>'008080',3=>'0000FF',4=>'A52A2A',5=>'006699',6=>'006699',7=>'006699'); //не крит
	public $mname = array('огонь' => 1 , 'вода' => 3 , 'воздух' => 2 , 'земля' => 4 , 'свет' => 5 , 'тьма' => 6 , 'серая' => 7 );
	public $laterScript = '';
	public $dietest = false;
	public $prm = array(
		/*
			act:	1 - когда персонаж получает повреждение
					2 - когда персонаж наносит удар
			type_of:	1 - уворот
						2 - крит
						3 - атака
						4 - защита
						5 - прочее
		*/
		
		//Гора Легиона
		
		369  => array( 'name'	=> 'Изворотливость', 'act'	=> 1 , 'type_of' => 1 ),
		370 => array( 'name'	=> 'Рассечь', 'act'	=> 2 , 'type_of' => 3 ),
		
		
		//грибница
		393	=> array( 'name'	=> 'Гнильная водянка', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 ),
		394	=> array( 'name'	=> 'Пожирающее пламя [7]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 ),
		392	=> array( 'name'	=> 'Ядовитая испарина', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 ),
		390	=> array( 'name'	=> 'Ядовитая испарина', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 ),
		381	=> array( 'name'	=> 'Открытые раны', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 ),
		391 => array( 'name'	=> 'Свернуться', 'act' => 2, 'type_of' => 4 ),
		389 => array( 'name'	=> 'Свернуться', 'act' => 2, 'type_of' => 4 ),
		388 => array( 'name'	=> 'Кокон', 'act' => 2, 'type_of' => 4 ),
		396 => array( 'name'	=> 'Адаптация', 'act' => 2, 'type_of' => 4 ),
		398	=> array( 'name'	=> 'Живая Вода', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 ),
		//
		//emeralds city
		411 => array( 'name'	=> 'Бесчувственность', 'act' => 1, 'type_of' => 4 ),
		342   => array( 'name'	=> 'Круговая Защита', 'act'	=> 0 , 'type_of' => 0 ),
		343   => array( 'name'	=> 'Натиск', 'act'	=> 0 , 'type_of' => 0 ),
		412	=> array( 'name'	=> 'Регенерация', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 ),
		//Devils City
		417	  => array( 'name' => 'Метеорит', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 ),
		414   => array( 'name'	=> 'Изворотливость', 'act'	=> 1 , 'type_of' => 1 ),
		413   => array( 'name'	=> 'Мастер Клинков', 'act'	=> 1 , 'type_of' => 1 ),
		424 => array( 'name'	=> 'Абсолютная защита', 'act' => 1 , 'type_of' => 4 ),
		425	=> array( 'name'	=> 'Отравленный Дротик', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 ),
		426	=> array( 'name'	=> 'Высосать', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 ),
		//
		1   => array( 'name'	=> 'Прикрыться', 'act'	=> 1 , 'type_of' => 5 ),
		2   => array( 'name'	=> 'Вломить', 'act'	=> 2 , 'type_of' => 3 ),
		4   => array( 'name'	=> 'Сильный удар', 'act' => 2 , 'type_of' => 3 ),		
		7   => array( 'name'	=> 'Активная защита', 'act'	=> 1 , 'type_of' => 4 ),
        
        
		290   => array('name'	=> 'Вытягивание души', 'act'	=> 1 , 'type_of' => 4 ),
		
		//Излом хаоса
		291 => array( 'name'	=> 'Грация Боя', 'act' => 2, 'type_of' => 4 ),
        
		//Канализация
		294	=> array( 'name'	=> 'Зловонная Вода', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 ),
		295	=> array( 'name'	=> 'Проткнуть', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 ),
		296	=> array( 'name'	=> 'Гнилая Кровь', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 ),
		297 => array( 'name'	=> 'Собраться', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 3 ),
		298   => array( 'name'	=> 'Приказ Слабости', 'act'	=> 2 , 'type_of' => 3 ),
		//
        
		141 => array( 'name'	=> 'Призрачная защита', 'act' => 1, 'type_of' => 4 ),
		423 => array( 'name'	=> 'Призрачная магия', 'act' => 1, 'type_of' => 4 ),
		147 => array( 'name'	=> 'Призрачный кинжал', 'act' => 1, 'type_of' => 4 ),
		148 => array( 'name'	=> 'Призрачный топор', 'act' => 1, 'type_of' => 4 ),
		149 => array( 'name'	=> 'Призрачный удар', 'act' => 1, 'type_of' => 4 ),
		150 => array( 'name'	=> 'Призрачное лезвие', 'act' => 1, 'type_of' => 4 ),
		
		142 => array( 'name'	=> 'Призрачный огонь', 'act' => 2, 'type_of' => 4 ),
		144 => array( 'name'	=> 'Призрачный воздух', 'act' => 2, 'type_of' => 4 ),
		146 => array( 'name'	=> 'Призрачная земля', 'act' => 2, 'type_of' => 4 ),
		145 => array( 'name'	=> 'Призрачная вода', 'act' => 2, 'type_of' => 4 ),
		
		8   => array( 'name'	=> 'Танец ветра', 'act'	=> 1 , 'type_of' => 1 ),	
		9	=> array( 'name'	=> 'Дикая удача', 'act'	=> 2 , 'type_of' => 3 ),
		10  => array( 'name'	=> 'Предвидение', 'act'	=> 1 , 'type_of' => 1 ),	
		11  => array( 'name'	=> 'Удачный удар', 'act' => 2 , 'type_of' => 3 ),
				
		45  => array( 'name'	=> 'Полная защита', 'act' => 1, 'type_of' => 4 ),
		
		47  => array( 'name'	=> 'Слепая удача', 'act'	=> 2 , 'type_of' => 2 ),
		48  => array( 'name'	=> 'Танец лезвий', 'act'	=> 1 , 'type_of' => 1 ),	
		49  => array( 'name'	=> 'Второе дыхание', 'act'	=> 1 , 'type_of' => 1 ),
		138 => array( 'name'	=> 'Сокрушающий удар', 'act'	=> 2 , 'type_of' => 3 ),
		140 => array( 'name'	=> 'Абсолютная защита', 'act' => 1 , 'type_of' => 4 ),
		193 => array( 'name'	=> 'Усиленные удары', 'act' => 2 , 'type_of' => 3 ),
		//204 => array( 'name'	=> 'Обречённость', 'act' => 2 , 'type_of' => 5 ),
		
		204 => array( 'name'	=> 'Обречённость', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 3 ),
		345 => array( 'name'	=> 'Обречённость', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 3 ),
		
		211 => array( 'name'	=> 'Агрессивная защита', 'act' => 1 , 'type_of' => 4 ),
		213 => array( 'name'	=> 'Коварный Уход', 'act'	=> 1 , 'type_of' => 4 ),
		215 => array( 'name'	=> 'Скрытая ловкость', 'act'	=> 1 , 'type_of' => 1 ),	
		216 => array( 'name'	=> 'Скрытая сила', 'act'	=> 2 , 'type_of' => 2 ),
		217 => array( 'name'	=> 'Разгадать тактику', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 3 ),
		219 => array( 'name'	=> 'Точный удар', 'act' => 2 , 'type_of' => 3 ),
		220 => array( 'name'	=> 'Ставка на опережение', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 3 ),
		222 => array( 'name'	=> 'Последний удар', 'act'	=> 2 , 'type_of' => 3 ),
		225 => array( 'name'	=> 'Магическая защита', 'act' => 1 , 'type_of' => 4 ),
		226 => array( 'name'	=> 'Возмездие', 'act' => 1 , 'type_of' => 4 ),
		231 => array( 'name'	=> 'Глухая защита', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 3 ),
		234 => array( 'name'	=> 'Осторожность', 'act' => 2, 'type_of' => 4 ),
		235 => array( 'name'	=> 'Шокирующий удар', 'act'	=> 2 , 'type_of' => 3 ),		
		189 => array( 'name'	=> 'Ошеломить', 'act'	=> 2 , 'type_of' => 3 ),
		
		237 => array( 'name'	=> 'Разведка боем', 'act'	=> 2 , 'type_of' => 3 /*, 'moment' => 3*/ ),
		
		239 => array( 'name'	=> 'Поступь смерти', 'act' => 2 , 'type_of' => 3 ),
		
		344 => array( 'name'	=> 'Поступь смерти (тест)', 'act' => 2 , 'type_of' => 3 ),
		
		240	=> array( 'name'	=> 'Хлебнуть крови', 'act'	=> 2 , 'type_of' => 5 )
		
		//Оледенение
		,21	=> array( 'name'	=> 'Оледенение [4]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )	
		,73	=> array( 'name'	=> 'Оледенение [5]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )	
		,74	=> array( 'name'	=> 'Оледенение [6]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )	
		,75	=> array( 'name'	=> 'Оледенение [7]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )	
		,76	=> array( 'name'	=> 'Оледенение [8]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )	
		,77	=> array( 'name'	=> 'Оледенение [9]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )	
		,78	=> array( 'name'	=> 'Оледенение [10]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )	
		,79	=> array( 'name'	=> 'Оледенение [11]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )	
		
		//Отравление
		,22	=> array( 'name'	=> 'Отравление [6]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,80	=> array( 'name'	=> 'Отравление [7]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,81	=> array( 'name'	=> 'Отравление [8]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,82	=> array( 'name'	=> 'Отравление [9]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,83	=> array( 'name'	=> 'Отравление [10]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,84	=> array( 'name'	=> 'Отравление [11]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		
		//Регенерация
		,36	=> array( 'name'	=> 'Регенерация [5]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,85	=> array( 'name'	=> 'Регенерация [6]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,86	=> array( 'name'	=> 'Регенерация [7]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,87	=> array( 'name'	=> 'Регенерация [8]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,88	=> array( 'name'	=> 'Регенерация [9]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,89	=> array( 'name'	=> 'Регенерация [10]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,90	=> array( 'name'	=> 'Регенерация [11]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		
		//Ядовитое облако
		,23	=> array( 'name'	=> 'Ядовитое Облако [8]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,70	=> array( 'name'	=> 'Ядовитое Облако [9]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,71	=> array( 'name'	=> 'Ядовитое Облако [10]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,72	=> array( 'name'	=> 'Ядовитое Облако [11]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		
		//Иней
		,269 => array( 'name'	=> 'Иней [7]', 'act' => 2, 'type_of' => 8 )
		,276 => array( 'name'	=> 'Иней [8]', 'act' => 2, 'type_of' => 8 )
		,277 => array( 'name'	=> 'Иней [9]', 'act' => 2, 'type_of' => 8 )
		//Огненный Щит
		,245 => array( 'name'	=> 'Огненный Щит', 'act' => 2, 'type_of' => 8 )
		
		//Духи Льда
		//,270 => array( 'name'	=> 'Духи Льда', 'act'	=> 2 , 'type_of' => 5 , 'type_sec' => 5 )
		,270  => array( 'name'	=> 'Духи Льда', 'act' => 2 , 'type_of' => 5 , 'type_sec' => 9 )
		
		//Хватка Льда
		,280 => array( 'name'	=> 'Хватка Льда', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		
		//Жертва Воде
		,281 => array( 'name'	=> 'Жертва Воде', 'act' => 2, 'type_of' => 5 )
		
		//Ледяное спасение
		,282 => array( 'name'	=> 'Ледяное Спасение', 'act' => 2, 'type_of' => 5 )
		
		//
		//
		
		//Медитация
		,24 => array( 'name'	=> 'Медитация', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 3 )
		
		//Магический барьер
		,210 => array( 'name'	=> 'Магический Барьер [4]', 'act' => 2, 'type_of' => 8 )
		,209 => array( 'name'	=> 'Магический Барьер [7]', 'act' => 2, 'type_of' => 8 )
		,208 => array( 'name'	=> 'Магический Барьер [8]', 'act' => 2, 'type_of' => 8 )
		,207 => array( 'name'	=> 'Магический Барьер [9]', 'act' => 2, 'type_of' => 8 )
		,206 => array( 'name'	=> 'Магический Барьер [10]', 'act' => 2, 'type_of' => 8 )
		,284 => array( 'name'	=> 'Магический Барьер [11]', 'act' => 2, 'type_of' => 8 )
		
		//Силовое поле
		,175 => array( 'name'	=> 'Магический Барьер [7]', 'act' => 2, 'type_of' => 8 )
		,176 => array( 'name'	=> 'Магический Барьер [8]', 'act' => 2, 'type_of' => 8 )
		,177 => array( 'name'	=> 'Магический Барьер [9]', 'act' => 2, 'type_of' => 8 )
		,178 => array( 'name'	=> 'Магический Барьер [10]', 'act' => 2, 'type_of' => 8 )
		,179 => array( 'name'	=> 'Магический Барьер [11]', 'act' => 2, 'type_of' => 8 )
		
		//
		//
		
		//Метеорит
		,42		=> array( 'name'	=> 'Метеорит [6]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,121	=> array( 'name'	=> 'Метеорит [7]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,122	=> array( 'name'	=> 'Метеорит [8]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,123	=> array( 'name'	=> 'Метеорит [9]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,124	=> array( 'name'	=> 'Метеорит [10]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,125	=> array( 'name'	=> 'Метеорит [11]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		
		//Каменный Щит
		,249 => array( 'name'	=> 'Каменный Щит', 'act' => 2, 'type_of' => 4 )
		
		//Песчанный щит
		,248 => array( 'name'	=> 'Песчаный Щит', 'act' => 2, 'type_of' => 4 )
		
		//Заземление
		,251 => array( 'name'	=> 'Заземление: Плюс', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,252 => array( 'name'	=> 'Заземление: Минус', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		
		//
		//
		
		//Туманный образ
		,273 => array( 'name'	=> 'Туманный Образ [10]', 'act'	=> 1 , 'type_of' => 4 )
		,286 => array( 'name'	=> 'Туманный Образ [9]', 'act'	=> 1 , 'type_of' => 4 )
		,287 => array( 'name'	=> 'Туманный Образ [8]', 'act'	=> 1 , 'type_of' => 4 )
		,288 => array( 'name'	=> 'Туманный Образ [7]', 'act'	=> 1 , 'type_of' => 4 )
		
		//
		,255 => array( 'name'	=> 'Воздушный Щит', 'act' => 2, 'type_of' => 8 )
		
		//
		//
		
		//Пещерные приемы
		,337 => array( 'name'	=> 'Выпить Душу', 'act'	=> 2 , 'type_of' => 5 )
		
		//Пожирающее Пламя
		,33	=> array( 'name'	=> 'Пожирающее Пламя [6]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,56	=> array( 'name'	=> 'Пожирающее Пламя [7]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,57	=> array( 'name'	=> 'Пожирающее Пламя [8]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,58	=> array( 'name'	=> 'Пожирающее Пламя [9]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,59	=> array( 'name'	=> 'Пожирающее Пламя [10]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,60	=> array( 'name'	=> 'Пожирающее Пламя [11]', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		
        //Эффекты
		,327	=> array( 'name'	=> 'Живая Вода', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 3 )
		,328 => array( 'name'	=> 'Сушеный Мухомор', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,329 => array( 'name'	=> 'Мешочек Пыли', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,330 => array( 'name'	=> 'Отвар когтей ПГ', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,331 => array( 'name'	=> 'Отвар Василиска', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		//1 сентября, квест
		,299 => array( 'name'	=> 'Ядовитые язвы', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,300 => array( 'name'	=> 'Элементарный заряд', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,301 => array( 'name'	=> 'Темное ранение', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,302 => array( 'name'	=> 'Подлечиться', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,303 => array( 'name'	=> 'Шкура поглощения', 'act' => 2, 'type_of' => 4 )
		,304 => array( 'name'	=> 'Особенное проклятье!', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
		,305 => array( 'name'	=> 'Кровожадность', 'act'	=> 2 , 'type_of' => 0 , 'moment' => 0 , 'moment_end' => 3 )
	);
	
	//Сохраняем лог в архик
		public function saveLogs( $id , $type ) {
			//if( $type == 'all' ) {
			//	$type = '';	
			//}
			//mysql_query('INSERT INTO `battle_logs_save` SELECT `id`,`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type` FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'" AND `id_hod` <= '.($this->hodID-2).'');
			//mysql_query('DELETE FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'" '.$type.'');
		}
		
	//Добавляем нанесенный урон
		public function takeYronNow($uid,$y){
			global $u;
			$this->users[$this->uids[$uid]]['battle_yron'] += floor($y);
			$this->stats[$this->uids[$uid]]['battle_yron'] += floor($y);
			if( $uid == $u->info['id'] ) {
				$u->info['battle_yron'] += floor($y);
				$u->stats['battle_yron'] += floor($y);
			}
			mysql_query('UPDATE `stats` SET `battle_yron` = `battle_yron` + "'.mysql_real_escape_string(floor($y)).'" WHERE `id` = "'.mysql_real_escape_string($uid).'" LIMIT 1');
		}
	
	public function hphe( $uid , $hp , $false_t7 = false ) {
		global $u;
		if( !isset($this->stats[$this->uids[$uid]]) ) {
			echo 'WARNING! ОШИБКА! ПОТЕРЯНА ПЕРЕМЕННАЯ ЗДОРОВЬЯ ПЕРСОНАЖА! (СООБЩИТЬ ПЕРСОНАЖУ LEL)';
		}else{
			$hpnow = floor($this->stats[$this->uids[$uid]]['hpNow']);
			$hpall = $this->stats[$this->uids[$uid]]['hpAll'];
			if( $hp > 0 ) {
				if( $this->stats[$this->uids[$uid]]['hpNow'] < 1 ) {
					$hp = 0;
				}
				//Хиляем
				if( $hpnow + $hp > $hpall ) {
					$hpli = $hpnow+$hp-$hpall;
					$hp -= $hpli; 
				}
				if( isset($this->stats[$this->uids[$uid]]['min_heal_proc']) && $this->stats[$this->uids[$uid]]['min_heal_proc'] < -99 ) {
					$hp = 0;
				}else{
					$hp = $hp/100*(100+$this->stats[$this->uids[$uid]]['min_heal_proc']);
				}
				//Отнимаем тактику										
				if( $false_t7 == false ) {
					if( $this->users[$this->uids[$uid]]['tactic7'] <= 0 ) {
						$hp = 0;
						$this->users[$this->uids[$uid]]['tactic7'] = 0;
						$this->stats[$this->uids[$uid]]['tactic7'] = $this->users[$this->uids[$uid]]['tactic7'];
					}else{
						$gdhh = round($hp/$this->stats[$this->uids[$uid]]['hpAll']*5,2);
						$gdhd = round($this->users[$this->uids[$uid]]['tactic7']/$gdhh*100);
						$this->users[$this->uids[$uid]]['tactic7'] = round(($this->users[$this->uids[$uid]]['tactic7']-$gdhh),2);
						if( $this->users[$this->uids[$uid]]['tactic7'] < 0 ) {
							$this->users[$this->uids[$uid]]['tactic7'] = 0;
						}
						$this->stats[$this->uids[$uid]]['tactic7'] = $this->users[$this->uids[$uid]]['tactic7'];
						if( $gdhd < 100 ) {
							//$hp = floor($hp/100*$gdhd);
						}
					}
				}
			}elseif( $hp < 0 ) {
				//Отнимаемф
				if( $hpnow + $hp < 0) {
					$hpli = $hpnow + $hp;
					$hp += -($hpli);
				}
			}
			
			$this->stats[$this->uids[$uid]]['last_hp'] = -$hp;	
			mysql_query('UPDATE `stats` SET
			`last_hp` = "'.$this->users[$this->uids[$uid]]['last_hp'].'",
			`tactic7` = "'.$this->users[$this->uids[$uid]]['tactic7'].'"
			WHERE `id` = "'.$uid.'" LIMIT 1');
					
		}
		
		return floor($hp);
	}
	
	
	public $e,                 //Ошибка (текст)
		   $cached = false,	   //Кэширование данных
		   $expCoef    = 0	,    # % опыта в бою
		   $aBexp      = 0,    //Добавочный опыт в боях
		   $mainStatus = 1,    //Отображаем главное окно (1 - можно бить, 2 - ожидаем ход противника, 3 - Проиграли. Ожидаем завершения поединка)
		   $info = array(),    //Информация о поединке
		   $users = array(),   //Информация о пользователях в этом бою
		   $stats = array(),   //Информация о статах пользователей в этом бою
		   $uids = array(),    //Список пользователей и их id в stats или users пример id пользователя = 555 , то $uids[555] выдаст его порядковый номер в массиве users \ stats
		   $atacks = array(),  //Список ударов в этом бою (действующих)
		   $ga = array(),      //Список uid кто нанес удар и по кому  $ga[ {id кто ударил} ][ {id кого ударил} ]
		   $ag = array(),      //Список uid кто нанес удар и по кому  $ga[ {id кого ударили} ][ {id кто ударил} ] 
		   $na = 1,            //возможность использовать удар
		   $np = 1,            //возможность использовать приемы
		   $nm = 1,            //возможность использовать заклятия
		   $hodID = 0,
		   $stnZbVs = 0,
		   $bots = array(),    // ID ботов
		   $iBots = array(),   // i бота
		   $stnZb = array(),
		   $uAtc = array('id'=>0,'a'=>array(1=>0,2=>0,3=>0,4=>0,5=>0),'b'=>0), //Если игрок нанес удар
		   $lg_itm = array(0 => array('грудью','ребром руки','лбом','кулаком','ногой','левой ногой','правой ногой','коленом'),1 => array('ножом','тыльной стороной лезвия ножа','рукоятью ножа','лезвием ножа'),2 => array('сучковатой палкой','поленом','тяжелой дубиной','дубиной','рукоятью молота'),3 => array('секирой','топором','лезвием секиры','алебардой','тяжелым держаком','длинной секирой'),4 => array('ножнами','гардой','мечом','лезвием меча','рукоятью меча','тупым лезвием','острой стороной меча','огромным мечом'),5 => array('сучковатой палкой','посохом','тяжелой тростью','корявым посохом','основанием посоха'), 22=> array('костылем')), // Чем лупили
		   $lg_zon = array(1 => array ('в нос','в глаз','в челюсть','по переносице','в кадык','по затылку','в правый глаз','в левый глаз','в скулу'),2 => array ('в грудь','в корпус','в солнечное сплетение','в сердце','в область лопаток'),3 => array ('в бок','по желудку','по левой руке','по правой руке'),4 => array ('по <вырезано цензурой>','в пах','в промежность','по левой ягодице','по правой ягодице'),5 => array ('по ногам','в область правой пятки','в область левой пятки','по коленной чашечке','по икрам')); // Куда лупили
	public $is = array(),$items = array();
		
	//Очистка кэша для ...
		public $uclearc = array(),$ucleari = array();
		public function clear_cache($uid) {
			if( $uid > 0 && !isset($this->uclearc[$uid]) ) {
				$this->uclearc[$uid] = true;
				$this->ucleari[] = $uid;
			}
		}
		
		public function clear_cache_start() {
			$i = 0;
			while( $i < count($this->ucleari) ) {
				mysql_query('DELETE FROM `battle_cache` WHERE `uid` = "'.mysql_real_escape_string($this->ucleari[$i]).'"');
				$i++;
			}
		}
		
	//Расчет маг.крита
		public function magKrit($l2,$t)
		{
			$r = 0;
			$r = $l2*2-7;
			if($r>$t)
			{
				//магический промах (серый удар, в 2 раза меньше) 6%
				//250 ед. защиты от магии дает 1% шанса увернуться от магии
				//$r = -1; , промах --
				$r = 0;
			}else{
				//каждая владелка дает 3% шанс крита
				$r = ceil($t*0.75);
				if($r>30)
				{
					$r = 30;
				}
				if(rand(0,10000)<$r*100)
				{
					//крит удар
					$r = 1;
				}else{
					$r = 0;	
				}
			}
			return $r;
		}
		
		
	//Обновление НР
		public function hpRef() {
			
		}
		
	//Расчет опыта
		public function testExp($y,$s1,$s2,$id1,$id2)
		{
			
			//if( $y > $s2['hpNow'] ) {
			//	$y = $s2['hpNow'];
			//}
			
			if($y<0){ $y = 0; }
			
			$addExp = 0+($y/$s2['hpAll']*100);
			
			if( $s2['hpAll']-$y < 0){
				$addExp = 100;
			}
			
			if($this->users[$this->uids[$s2['id']]]['host_reg'] == 'real_bot_user') {
				$addExp = floor($addExp*0.76);
			}
			
			if($addExp<0){ $addExp = 0; }						
			if( $s2['levels']!='undefined' && $this->users[$this->uids[$s2['id']]]['pass'] != 'saintlucia' ){
				//$doexp = mysql_fetch_array(mysql_query('SELECT SUM(`items_main`.`price1`) FROM `items_users`,`items_main` WHERE `items_users`.`inOdet` > 0 AND `items_main`.`inSlot` < 50 AND `items_users`.`uid` = "'.$id2.'" AND `items_users`.`delete` = 0 AND `items_main`.`id` = `items_users`.`item_id` ORDER BY `items_main`.`inSlot` ASC LIMIT 50'));
				if($doexp[0]>0) {
					$doexp = floor($doexp[0]/15);
				}else{
					$doexp = 0;
				}
				//$doexp = floor(($this->users[$this->uids[$id2]]['btl_cof']-$this->users[$this->uids[$id1]]['btl_cof']*0.80)/5);
				//if( $this->users[$this->uids[$id2]]['btl_cof'] > $this->users[$this->uids[$s2['id']]]['level']*350 ) {
				//	//Артник
				//	$doexp = floor($this->users[$this->uids[$s2['id']]]['level']*350 + ($this->users[$this->uids[$id2]]['btl_cof']/20));
				//}else{
					//Не артник
					$doexp = floor(($this->users[$this->uids[$id2]]['btl_cof']));
				//}
				if( $this->users[$this->uids[$id2]]['bot'] == 0 || $this->users[$this->uids[$id2]]['clone'] > 0 ) {
					$baseexp = array(
						50,
						85,
						135,
						170,
						200,
						370,
						635,
						1200, //7
						1700, //8
						2200, //9
						2500, //10
						3000, //11
						3500, //12
						4000, //13
						4500, //14
						4500,
						4500,
						4500,
						4500,
						4500,
						4500,
						4500
					);
					$doexp += $baseexp[$this->users[$this->uids[$s2['id']]]['level']];
										
				}
				
				if( $doexp < 0 ) {
					$doexp = 0;
				}
				$addExp = $addExp*(1+($s2['levels']['expBtlMax'])+$doexp*1.01)/100;
				if( $this->users[$this->uids[$s2['id']]]['bot'] > 0 ) {
					//$addExp = round($addExp/5);
				}
				unset($doexp);
			}else{
				$addExp = 0;
			}
			
			/*
			if($s1['level'] > $s2['level']){
				$minProc = 100 - 33*( $s1['level']-$s2['level'] );
				if($minProc < 1) {
					$minProc = 1;
				}
				$addExp = round($addExp/100*$minProc);
			}
			*/
			
			//if( $this->users[$this->uids[$s2['id']]]['bot_id'] == 0 && $this->stats[$this->uids[$s2['id']]]['itmslvl'] == 0 ) {
			//	$addExp = 0;
			//}
			
			if( $this->info['typeBattle'] == 9 ) {
				//Нападение
				//за 8 и ниже не дают опыт
				if( $this->users[$this->uids[$s1['id']]]['level'] > $this->users[$this->uids[$s2['id']]]['level'] ) {
					if( $this->users[$this->uids[$s2['id']]]['level'] <= 8 ) {
						$addExp = 0;
					}
				}
			}
						
			if( $this->users[$this->uids[$id2]]['clone'] == 0 ) {
				$procitm = 100;			
				$itmodet = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `inOdet` > 0 AND `inOdet` < 18 AND `uid` = "'.$s2['id'].'" LIMIT 1'));
				$itmodet = $itmodet[0];
				if( $itmodet < 0 ) { $itmodet = 0; }
				if( $itmodet > 17 ) { $itmodet = 17; }			
				$procitm = $itmodet/17*100;
				if( $procitm < 10 ) {
					$procitm = 10;
				}
				$addExp = $addExp/100*$procitm;
			}
			
			if( $this->users[$this->uids[$s1['id']]]['level'] <= $this->users[$this->uids[$s2['id']]]['level'] - 2 ) {
				//+40
				$addExp += $addExp/100*40;
			}elseif( $this->users[$this->uids[$s1['id']]]['level'] == $this->users[$this->uids[$s2['id']]]['level'] - 1 ) {
				//+20
				$addExp += $addExp/100*20;
			}elseif( $this->users[$this->uids[$s1['id']]]['level'] == $this->users[$this->uids[$s2['id']]]['level'] ) {
				//0
				
			}elseif( $this->users[$this->uids[$s1['id']]]['level'] - 1 == $this->users[$this->uids[$s2['id']]]['level'] ) {
				//-20
				$addExp -= $addExp/100*20;
			}elseif( $this->users[$this->uids[$s1['id']]]['level'] - 2 == $this->users[$this->uids[$s2['id']]]['level'] ) {
				//-40
				$addExp -= $addExp/100*40;
			}else{
				//-100 
				$addExp = 0;
			}
			
			return $addExp;
		}
	
	//Добавляем опыт \ нанесенный урон
		public function takeExp($id,$y,$id1,$id2,$mgregen = false,$nobattle_uron = false){
			global $u;
			if(isset($this->users[$this->uids[$id]])){
				$s1 = $this->stats[$this->uids[$id1]];
				$s2 = $this->stats[$this->uids[$id2]];
				$yns = $y;
				if( $yns < 0 ) {
					$yns = 0;
				}
				if( $s2['hpNow'] < 0 ) {
					$y = $s2['hpNow'] + $y;
				}
				if( $y < 0 ) {
					$y = 0;
				}
				if($id1!=$id2){
					$e = $this->testExp($y,$s1,$s2,$id1,$id2);
				}else{
					$e = 0;
				}
				if( (int)$this->users[$this->uids[$id1]]['bot_id'] == 0 && $this->users[$this->uids[$id1]]['dnow'] != 0 && $this->info['dungeon'] != 1) {
					$dun_limitForLevel = array( // Максимум для каждого уровня.
						4 => 750,
						5 => 1500,
						6 => 3500,
						7 => 8000,
						8 => 25000,
						9 => 50000,
						10 => 75000,
						11 => 125000,
						12 => 250000,
						13 => 500000,
						14 => 750000
					);
					$dun_expFactor = array( // Максимум для каждого уровня.
						4 => 5,
						5 => 5,
						6 => 5,
						7 => 5,
						8 => 5,
						9 => 3,
						10 => 1,
						11 => 1,
						12 => 1,
						13 => 1,
						14 => 1
					);
					
					if( isset($dun_expFactor[(int)$this->users[$this->uids[$id1]]['level']]) ){
						$e = $e * $dun_expFactor[(int)$this->users[$this->uids[$id1]]['level']];
					}

					if($this->info['dungeon'] > 1 && $this->users[$this->uids[$id1]]['battle'] > 0 ) { // пещерный лимит 
						$dun_exp = array(); // Текущий лимит опыта игрока в подземельях.
						$rep = mysql_fetch_array(mysql_query('SELECT `dungeonexp`,`id` FROM `rep` WHERE `id` = "'.$this->users[$this->uids[$id1]]['id'].'" LIMIT 1'));
						$rep = explode(',',$rep['dungeonexp']);
						foreach ($rep as $key=>$val) {
							$val = explode('=',$val);
							if( isset($val[0]) && isset($val[1]) && $val[0] !='' && $val[1] != 0 ) $dun_exp[(int)$val[0]] = (int)$val[1]; // текущий лимит опыта в подземке 
						} unset($rep);
						
						if( !isset($dun_exp[$this->info['dungeon']]) ) $dun_exp[$this->info['dungeon']] = 0;
						if( !isset($dun_limitForLevel[(int)$this->users[$this->uids[$id1]]['level']]) ){ // Если лимит не задан, опыт не даем.
							$e = 0;
						} elseif(
							isset($dun_exp[$this->info['dungeon']]) &&
							$dun_exp[$this->info['dungeon']] >= $dun_limitForLevel[(int)$this->users[$this->uids[$id1]]['level']]
						) { // Если лимит уже достигнут, опыт не даем.
							$e = 0;
						} elseif(
							isset($dun_exp[$this->info['dungeon']]) &&
							$dun_limitForLevel[(int)$this->users[$this->uids[$id1]]['level']] > $dun_exp[$this->info['dungeon']]
						) { // Если текущая репутация не достигла лимита.
							if( ( $dun_exp[$this->info['dungeon']] + $e ) > $dun_limitForLevel[(int)$this->users[$this->uids[$id1]]['level']] ) {
								// Если опыта набрано достаточно, для достижения лимита.
								$e = abs($e - abs( $dun_limitForLevel[(int)$this->users[$this->uids[$id1]]['level']] - ( $e + $dun_exp[$this->info['dungeon']] ) ));
								$dun_exp[$this->info['dungeon']] += $e; 
							} elseif( $dun_limitForLevel[(int)$this->users[$this->uids[$id1]]['level']] > ( $dun_exp[$this->info['dungeon']] + $e ) ) {
								// Если опыта недостаточно, для достижения лимита.
								$e = $e;
								$dun_exp[$this->info['dungeon']] += $e;
							} else {
								$e = 0;
							}
						} else { // В любой непонятной ситуцаии.
							$e = 0;
						}
					} else $e = $e; // Опыт в пещерах.
					if( $this->info['dungeon'] == 102 && (int)$this->users[$this->uids[$id1]]['bot_id'] == 0 ) {
						$e = floor($e * 0.002);
					} 
				} 
			
				//$this->users[$this->uids[$id1]]['battle_exp'] += round($e*1,5);
				$this->users[$this->uids[$id1]]['battle_exp'] += $e;
				if($mgregen == false && $nobattle_uron == false) {
					$this->users[$this->uids[$id1]]['battle_yron'] += floor($yns);
					if(!isset($this->stats[$this->uids[$id1]]['notactic']) || $this->stats[$this->uids[$id1]]['notactic'] == 0) {
						if( $s2['hpAll'] <= 1000 ) {
							$this->users[$this->uids[$id1]]['tactic6'] += round(0.1*(floor($yns)/$s2['hpAll']*100),10);
						}else{
							$this->users[$this->uids[$id1]]['tactic6'] += round(0.1*(floor($yns)/1000*100),10);	
						}						
					}
				}
				
				//if($y != 0) {
				//	$this->users[$this->uids[$id1]]['tactic6'] = -$y;
				//} 
				//if($u->info['admin'] > 0 ) {
				//	echo '['.$id1.' ударил '.$id2.' и получил +'.$y.' к нанесенному урону]';
				//}
 
			
				$upd = mysql_query('UPDATE `stats` SET `last_hp` = "'.$this->users[$this->uids[$id1]]['last_hp'].'",`tactic6` = "'.$this->users[$this->uids[$id1]]['tactic6'].'",`battle_yron` = "'.$this->users[$this->uids[$id1]]['battle_yron'].'",`battle_exp` = "'.$this->users[$this->uids[$id1]]['battle_exp'].'" WHERE `id` = "'.((int)$id1).'" LIMIT 1');
				if(!$upd){
					echo '[не удача при использовании приема]';	
				}else{
					$this->clear_cache( $id1 );
					$this->stats[$this->uids[$id1]]['tactic6'] = $this->users[$this->uids[$id1]]['tactic6'];
					if($id1==$u->info['id'])
					{
						$u->info['tactic6'] = $this->users[$this->uids[$id1]]['tactic6'];
						$u->stats['tactic6'] = $this->users[$this->uids[$id1]]['tactic6'];
						$u->info['battle_exp'] = $this->users[$this->uids[$id1]]['battle_exp'];
						$u->stats['battle_exp'] = $this->stats[$this->uids[$id1]]['battle_exp'];
						$u->info['battle_yron'] = $this->users[$this->uids[$id1]]['battle_yron'];
						$u->stats['battle_yron'] = $this->stats[$this->uids[$id1]]['battle_yron'];
						$u->info['notactic'] = $this->users[$this->uids[$id1]]['notactic'];
						$u->stats['notactic'] = $this->users[$this->uids[$id1]]['notactic'];
					}
				}
				unset($s1,$s2);
			}
		}
	//JS информация о игроке
		public function myInfo($id,$t)
		{
			global $c,$u;
			$tim = time();
			if(isset($this->users[$this->uids[$id]]) || $u->info['id'] == $id)
			{
				if($u->info['id'] == $id || ($u->info['enemy'] == $id && $id > 0)) {
					//Всегда обновляем
					$this->users[$this->uids[$id]] = mysql_fetch_array(mysql_query('SELECT `u`.*,`st`.* FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`id` = "'.$id.'" LIMIT 1'));
					$this->stats[$this->uids[$id]] = $u->getStats($this->users[$this->uids[$id]],0);
					$this->stats[$this->uids[$id]]['items'] = $this->stats[$this->uids[$id]]['items'];
					$this->stats[$this->uids[$id]]['effects'] = $this->stats[$this->uids[$id]]['effects'];
					/*
					$ur   = $this->users[$this->uids[$id]];
					$st   = $this->stats[$this->uids[$id]];
					$itm  = $this->stats[$this->uids[$id]]['items'];
					$eff  = $this->stats[$this->uids[$id]]['effects'];
					*/
				}
					
				//ssecho '['.$id.' -> '.$this->users[$this->uids[$id]]['last_hp'].']';
								
				$ur   = $this->users[$this->uids[$id]];
				$st   = $this->stats[$this->uids[$id]];
				$itm  = $this->stats[$this->uids[$id]]['items'];
				$eff  = $this->stats[$this->uids[$id]]['effects'];
				$ef   = '';
				$i    = 0;
				//Свиток благословения	
				$blag = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `id_eff`="555" AND `uid`="'.$id.'"'));
				if($blag){
					if($blag['delete'] > $blag['timeUse']){
						$t2 = '';
						$time_still2 = $blag['delete'] - time();
						$tmp = floor($time_still2/3600);
						if ($tmp > 0) { 
							$id2++;
							if ($id2<3) {$t2 .= $tmp." ч. ";}
							$time_still2 = $time_still2-$tmp*3600;
						}
						$tmp = floor($time_still2/60);
						if ($tmp > 0) { 
							$id2++;
							if ($id2<3) {$t2 .= $tmp." мин. ";}
						}

						if($t2=='')
						{
							$t2 = $time_still2.' сек.';
						}
						if($time_still2 > 0){
							$opis = '<b><u>Свиток благословения</u></b> (Эффект)</br>';
							$opis .= 'Осталось: '.$t2.'</br>';
							$opis .= 'Увеличение опыта (%): +'.$blag['data'];
							$ef .= '<div class=\"pimg\" pog=\"0\" col=\"1\" stl=\"0\" stt=\"'.$opis.'\"><img src=\"http://img.likebk.com/i/eff/new_reg.gif\"/></div>';
						}
					}
				}
				while($i!=-1)
				{
					$nseef = 0;
					if($this->users[$this->uids[$ur['id']]]['id'] != $u->info['id'] && $ur['id'] != 0)
					{
						if($this->stats[$this->uids[$ur['id']]]['seeAllEff'] != 1) {
							$nseef = 1;
							if($eff[$i]['v1']=='priem')
							{
								$eff[$i]['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$eff[$i]['v2'].'" LIMIT 1'));
							}
							if(isset($eff[$i]['priem']['id']) && $eff[$i]['priem']['neg']==1)
							{
								$nseef = 0;
							}
						}
					}
					
					if( $this->stats[$this->uids[$id]]['seeAllEff'] > 0 ) {
						$nseef = 0;
					}
					
					if(isset($eff[$i]) && $eff[$i] != 'delete')
					{
						if($nseef == 0)
						{
							
							$ei = '<b><u>'.$eff[$i]['name'].'</u></b>';
							if($eff[$i]['x']>1)
							{
								//$ei .= ' [x'.$eff[$i]['x'].'] ';	
								$ei .= ' x'.$eff[$i]['x'].' ';	
							}
							if($eff[$i]['type1']>0 && $eff[$i]['type1']<7)
							{
								$ei .= ' (Эликсир)';
							}elseif(($eff[$i]['type1']>6 && $eff[$i]['type1']<11) || $eff[$i]['type1']==16)
							{
								$ei .= ' (Заклятие)';
							}elseif($eff[$i]['type1']==14)
							{
								$ei .= ' (Прием)';
							}elseif($eff[$i]['type1']==15)
							{
								$ei .= ' (Изучение)';
							}elseif($eff[$i]['type1']==17)
							{
								$ei .= ' (Проклятие)';
							}elseif($eff[$i]['type1']==18 || $e['type1']==19)
							{
								$ei .= ' (Травма)';
							}elseif($eff[$i]['type1']==20)
							{
								$ei .= ' (Пристрастие)';
							}elseif($eff[$i]['type1']==22)
							{
								$ei .= ' (Ожидание)';
							}else{
								$ei .= ' (Эффект)';
							}
							$ei .= '<br>';
							
							$out = '';
							$time_still = ($eff[$i]['timeUse']+($eff[$i]['timeAce']-$eff[$i]['timeUse'])+$eff[$i]['actionTime']);
							if($eff[$i]['timeAce'] == 0) {
								$time_still += $eff[$i]['timeUse'];
							}
							$time_still -= time();
							if($eff[$i]['bp']==0 && $eff[$i]['timeUse']!=77)
							{
								if($eff[$i]['type1']!=13)
								{
									/*$tmp = floor($time_still/2592000);
									$id=0;
									if ($tmp > 0) { 
										$id++;
										if ($id<3) {$out .= $tmp." мес. ";}
										$time_still = $time_still-$tmp*2592000;
									}
									$tmp = floor($time_still/604800);
									if ($tmp > 0) { 
									$id++;
									if ($id<3) {$out .= $tmp." нед. ";}
									$time_still = $time_still-$tmp*604800;
									}
									$tmp = floor($time_still/86400);
									if ($tmp > 0) { 
										$id++;
										if ($id<3) {$out .= $tmp." дн. ";}
										$time_still = $time_still-$tmp*86400;
									}
									$tmp = floor($time_still/3600);
									if ($tmp > 0) { 
										$id++;
										if ($id<3) {$out .= $tmp." ч. ";}
										$time_still = $time_still-$tmp*3600;
									}
									$tmp = floor($time_still/60);
									if ($tmp > 0) { 
										$id++;
										if ($id<3) {$out .= $tmp." мин. ";}
									}
									if($out=='')
									{
										$out = $time_still.' сек.';
									}*/
									$ei .= 'Осталось: '.$u->timeOut($time_still).'';
								}
							}else{
								if($eff[$i]['timeUse']!=77)
								{
									$ei .= 'Осталось: '.$u->timeOut($time_still).'';
									//$ei .= 'Зарядов: '.$out.'<br>';
								}elseif($eff[$i]['hod']>=0)
								{
									$ei .= 'Зарядов: '.$eff[$i]['hod'].'<br>';	
								}
							}
							
							if($eff[$i]['user_use']!='')
							{
								if($this->users[$this->uids[$eff[$i]['user_use']]]['login2']!='') {
									$ei .= 'Автор: <b>'.$this->users[$this->uids[$eff[$i]['user_use']]]['login2'].'</b>';
								}elseif($this->users[$this->uids[$eff[$i]['user_use']]]['login']!='') {
									$ei .= 'Автор: <b>'.$this->users[$this->uids[$eff[$i]['user_use']]]['login'].'</b>';
								}
							}
							
							//Действие эффекта
							$tr = '';
							$ti = $u->items['add'];
							$x = 0; $ed = $u->lookStats($eff[$i]['data']);	
							while($x<count($ti))
							{
								$n = $ti[$x];
								if(isset($ed['add_'.$n],$u->is[$n]) && $n!='pog')
								{
									$z = '';
									if($ed['add_'.$n]>0)
									{
										$z = '+';
									}
									$tr .= '<br>'.$u->is[$n].': '.$z.''.$ed['add_'.$n];
								}
								$x++;
							}
							$efix = 0;
							if( isset($ed['add_pog2']) && $ed['add_pog2'] > 0 ) {
								$efix = $ed['add_pog2'];
							}
							if(isset($ed['add_pog']))
							{
								$tr .= '<br>Магический барьер способен поглотить еще <b>'.$ed['add_pog'].'</b> ед. урона';
							}
							if(isset($ed['add_pog2']))
							{
								$tr .= '<br>Магический барьер способен поглотить еще <b>'.$ed['add_pog2'].'</b> ед. урона <small>('.$ed['add_pog2p'].'%)</small>';
							}
							
							if($tr!='')
							{
								$ei .= $tr;
							}
							if($eff[$i]['info']!='')
							{
								$ei .= '<br><i>Информация:</i><br>'.$eff[$i]['info'];
							}

							//$ef .= '<img width=\"38\" style=\"margin:1px;display:block;float:left;\" src=\"http://img.likebk.com/i/eff/'.$eff[$i]['img'].'\" onMouseOver=\"top.hi(this,\''.$ei.'\',event,0,1,1,1,\'\');\" onMouseOut=\"top.hic();\" onMouseDown=\"top.hic();\" />';
							$ef .= '<div class=\"pimg\" pog=\"'.$efix.'\" col=\"'.$eff[$i]['x'].'\" stl=\"0\" stt=\"'.$ei.'\"><img src=\"http://img.likebk.com/i/eff/'.$eff[$i]['img'].'\"/></div>';
							unset($efix);
						}
					}elseif($eff[$i]!='delete')
					{
						$i = -2;
					}
					$i++;
				}
				
				//if( $st['itmslvl'] == 0 && $ur['bot_id'] == 0) {
				//	$ef .= '<div class=\"pimg\" pog=\"0\" col=\"0\" stl=\"0\" stt=\"<b><u>Легкое вооружение</u></b> (Эффект)<br>Осталось: <i>Бесконечно</i>\"><img src=\"http://img.likebk.com/i/eff/light_armor.gif\"/></div>';
				//}
				
				$ca = '';
				if($ur['clan']>0)
				{
					$cl = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$ur['clan'].'" LIMIT 1'));
					if(isset($cl['id']))
					{
						$ca = '<img src=\"http://img.likebk.com/i/clan/'.$cl['name_mini'].'.gif\" title=\"'.$cl['name'].'\">';
					}
				}
				if($ur['align']>0)
				{
					$ca = '<img src=\"http://img.likebk.com/i/align/align'.$ur['align'].'.gif\">'.$ca;
				}
				if($ur['login2']=='')
				{
					$ur['login2'] = $ur['login'];
				}
				if(floor($st['hpNow'])>$st['hpAll'])
				{
					$st['hpNow'] = $st['hpAll'];
				}
				if(floor($st['mpNow'])>$st['mpAll'])
				{
					$st['mpNow'] = $st['mpAll'];
				}
				$stsua  = '<b>'.$ur['login2'].'</b>';
				$stsua .= '<br>Сила: '.$st['s1'];
				$stsua .= '<br>Ловкость: '.$st['s2'];
				$stsua .= '<br>Интуиция: '.$st['s3'];
				$stsua .= '<br>Выносливость: '.$st['s4'];
				if($st['s5'] != 0) {
					$stsua .= '<br>Интелект: '.$st['s5'];
				}
				if($st['s6'] != 0) {
					$stsua .= '<br>Мудрость: '.$st['s6'];
				}
				if($u->info['admin']>0){
					if(isset($ur['align']) && $ur['align'] == 9){
						$align = $ur['align'];
					} else {
						$align = $ur['align'];
					}
				}

				$tp_img = array(
					1 => 4,
					2 =>5,
					14 => 6,
					3 => 7,
					5 => 8,
					7 => 9,
					17 => 10,
					16 => 11,
					13 => 12,
					10 => 13,
					9 => 14,
					8 => 15,
					11 => 17, //кольцо 2
					12 => 18 //кольцо 3		
				);
				$info = 'info_reflesh('.$t.','.$ur['id'].',"'.$ca.'<a href=\"javascript:void(0)\" onclick=\"top.chat.addto(\''.$ur['login2'].'\',\'to\');return false;\">'.$ur['login2'].'</a> ['.$ur['level'].']<a href=\"inf.php?'.$ur['id'].'\" target=\"_blank\"><img src=\"http://img.likebk.com/i/inf_'.$ur['cityreg'].'.gif\" title=\"Инф. о '.$ur['login2'].'\"></a>&nbsp;","'.$ur['obraz'].'",'.floor($st['hpNow']).','.floor($st['hpAll']).','.floor($st['mpNow']).','.floor($st['mpAll']).',0,'.$ur['sex'].',"'.$ef.'","'.$stsua.'", "'.$align.'");shpb();';
				$i = 0;
				while($i<count($itm))
				{
					if(isset($st['items_img'][$tp_img[$itm[$i]['inOdet']]])) {
						$itm[$i]['img'] = $st['items_img'][$tp_img[$itm[$i]['inOdet']]];
					}
					//генерируем предметы
					$ttl = '<b>'.$itm[$i]['name'].'</b>';
					$td = $u->lookStats($itm[$i]['data']);				
					$lvar = '';
					if($td['add_hpAll']>0)
					{
						if($td['add_hpAll']>0)
						{
							$td['add_hpAll'] = '+'.$td['add_hpAll'];
						}
						$lvar .= '<br>Уровень жизни: '.$td['add_hpAll'].'';
					}
					if($td['sv_yron_max']>0 || $td['sv_yron_min']>0)
					{
						$lvar .= '<br>Урон: '.(0+$td['sv_yron_min']).'-'.(0+$td['sv_yron_max']).'';
					}
					if($td['add_mab1']>0)
					{
						if($td['add_mib1']==$td['add_mab1'] && $pl['geniration']==1)
						{
							$m1l = '+'; if($td['add_mab1']<0){ $m1l = ''; }
							$lvar .= '<br>Броня головы: '.$m1l.''.(0+$td['add_mab1']).'';
						}else{
							$lvar .= '<br>Броня головы: '.(0+$td['add_mib1']).'-'.(0+$td['add_mab1']).'';
						}
					}
					if($td['add_mab2']>0)
					{
						if($td['add_mib2']==$td['add_mab2'] && $pl['geniration']==1)
						{
							$m1l = '+'; if($td['add_mab2']<0){ $m1l = ''; }
							$lvar .= '<br>Броня корпуса: '.$m1l.''.(0+$td['add_mab2']).'';
						}else{
							$lvar .= '<br>Броня корпуса: '.(0+$td['add_mib2']).'-'.(0+$td['add_mab2']).'';
						}
					}
					if($td['add_mab3']>0)
					{
						if($td['add_mib3']==$td['add_mab3'] && $pl['geniration']==1)
						{
							$m1l = '+'; if($td['add_mab3']<0){ $m1l = ''; }
							$lvar .= '<br>Броня пояса: '.$m1l.''.(0+$td['add_mab3']).'';
						}else{
							$lvar .= '<br>Броня пояса: '.(0+$td['add_mib3']).'-'.(0+$td['add_mab3']).'';
						}
					}
					if($td['add_mab4']>0)
					{
						if($td['add_mib4']==$td['add_mab4'] && $pl['geniration']==1)
						{
							$m1l = '+'; if($td['add_mab4']<0){ $m1l = ''; }
							$lvar .= '<br>Броня ног: '.$m1l.''.(0+$td['add_mab4']).'';
						}else{
							$lvar .= '<br>Броня ног: '.(0+$td['add_mib4']).'-'.(0+$td['add_mab4']).'';
						}
					}				
					if($itm[$i]['iznosMAX']>0)
					{
						if($itm[$i]['iznosMAXi'] == 999999999) {
							$lvar .= '<br>Долговечность: <font color=brown>неразрушимо</font>';
						}else{
							$lvar .= '<br>Долговечность: '.floor($itm[$i]['iznosNOW']).'/'.floor($itm[$i]['iznosMAX']);
						}
					}
					$ttl .= $lvar;
					$ccv = '';
					
					if($itm[$i]['magic_inci']!='' || $itm[$i]['magic_inc']!='') {
						if($itm[$i]['magic_inc'] == '') {
							$itm[$i]['magic_inc'] = $itm[$i]['magic_inci'];
						}
						$mgi = mysql_fetch_array(mysql_query('SELECT * FROM `eff_main` WHERE `id2` = "'.$itm[$i]['magic_inc'].'" AND `type1` = "12345" LIMIT 1'));
						if(isset($mgi['id2'])) {
							$mgilog = '';
							$ccv .= 'top.useMagicBattle(\''.$mgi['mname'].'\','.$itm[$i]['id'].',\''.$mgi['img'].'\',1,2);';
						}
					}
					
					if(isset($st['items_img'][$tp_img[$itm[$i]['inOdet']]])) {
						$ttl = '<i>Эффект иллюзии</i>';
					}elseif(isset($st['items_img'][$tp_img[5]]) && ($itm[$i]['inOdet'] == 4 || $itm[$i]['inOdet'] == 6)) {
						$ttl = '<i>Эффект иллюзии</i>';
					}elseif(isset($st['items_img'][$tp_img[1]]) && $itm[$i]['inOdet'] == 52) {
						$ttl = '<i>Эффект иллюзии</i>';
					}
					
					$info .= 'abitms('.(0+$t).','.(0+$itm[$i]['uid']).','.(0+$itm[$i]['id']).','.(0+$itm[$i]['inOdet']).',"'.$itm[$i]['name'].'","'.$ttl.'","'.$itm[$i]['img'].'","'.$ccv.'");';
					$i++;
				}
				
				return $info;
			}else{
				return false;
			}
		}
		
	//Проверка на выживших
		public function testUsersLive() {
			$r = false;
			$tl = 0;
			$i = 0;
			$j = 0;
			while($i<count($this->uids))
			{
				if($this->stats[$i]['id']>0)
				{
					if( floor($this->stats[$i]['hpNow']) < 1 ) {
						$this->stats[$i]['hpNow'] = 0;
					}
					$hp[$this->users[$i]['team']] += floor($this->stats[$i]['hpNow']);
					if(!isset($tml[$this->users[$i]['team']]) && floor($this->stats[$i]['hpNow']) >= 1)
					{
						$tml[$this->users[$i]['team']] = 1;
						$tmv[$j] = $this->users[$i]['team'];
						$tl++;
					}
				}
				$i++;
			}
			if( $tl > 1 ) {
				$r = true;
			}
			return $r;
		}
			
	//Мини лог
		public function miniLogAdd( $user , $text ) {
			$txt = $text;									
			$vLog = 'at1=00000||at2=00000||zb1=0||zb2=0||bl1=0||bl2=0||time1='.time().'||time2='.time().'||s1='.$user['sex'].'||t1='.$user['team'].'||login1='.$user['login'].'||';									
			$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>($this->hodID+1),'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');									
			$mas1['text'] = $txt;
			$this->add_log($mas1);
		}
				
	//Проверяем завершение боя
		public $btlstatus = array(
			1 => array(
				array('Обычный бой',0,0),
				array('Великая битва',100,50000),
				array('Величайшая битва',200,100000),
				array('Историческая битва',800,200000),
				array('Эпохальная битва',1200,300000),
				array('Судный день',2400,400000)
			),
			2 => array(
				array('Кровавый бой',0,0),
				array('Кровавая битва',200,100000),
				array('Кровавая резня',300,150000),
				array('Кровавая сеча',1000,250000),
				array('Кровавое побоище',1400,350000),
				array('Судный день',2700,450000)
			)
		);
		public function testFinish()
		{
			global $u;

			//Статус битвы
			$this->info['tpbtlstatus'] = 1;
			//
			if( $this->info['type'] == 99 ) {
				$this->info['tpbtlstatus'] = 2;
			}

			if( $this->info['start1'] == 0 ) {
				//Нельзя завершить т.к. не корректный старт
			}elseif($this->info['team_win'] == -1)
			{
				
				if( $this->info['razdel'] != 5 && $this->info['izlom'] == 0 && $this->info['dungeon'] == 0 ) {
					
					$bojk = mysql_fetch_array(mysql_query('SELECT SUM(`battle_yron`) FROM `stats` WHERE `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$this->info['id'].'")'));
					$bojk = $bojk[0];
					$bojku = 0;
					if( $bojk >= 900000 ) {
						$bojku = 5;
					}elseif( $bojk >= 700000 ) {
						$bojku = 4;
					}elseif( $bojk >= 500000 ) {
						$bojku = 3;
					}elseif( $bojk >= 300000 ) {
						$bojku = 2;
					}elseif( $bojk >= 100000 ) {
						$bojku = 1;
					}
					if( $bojku > $this->info['status'] ) {
						if($this->info['status'] == 0) {
							$spik = mysql_query('SELECT `id` FROM `stats` WHERE `hpNow` >= 1 AND `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$this->info['id'].'") GROUP BY `team` ORDER BY `battle_yron` DESC');
							while( $plik = mysql_fetch_array($spik) ) {
								mysql_query('UPDATE `stats` SET `lider` = "'.$this->info['id'].'" WHERE `id` = "'.$plik['id'].'" LIMIT 1');
							}
						}
						$this->info['status'] = $bojku;
						//(+'.$this->btlstatus[$this->info['tpbtlstatus']][$this->info['status']][1].'% опыта и +'.$this->btlstatus[$this->info['tpbtlstatus']][$this->info['status']][2].' лимит опыта для 12 уровней)
						mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.time().'","'.$this->info['id'].'","'.$this->hodID.'",
							"<b><font color=red>Статус битвы изменен на &quot;'.$this->btlstatus[$this->info['tpbtlstatus']][$this->info['status']][0].'&quot; (Таймаут: '.round($this->info['timeout']/60,2).')</font></b>"
						,"0","0","0","0","0","1")');
						$this->info['timeout'] -= 1;
						if( $this->info['timeout'] < 1 ) {
							$this->info['timeout'] = 1;
						}
						mysql_query('UPDATE `battle` SET `timeout` = "'.$this->info['timeout'].'", `status` = "'.$this->info['status'].'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
					}
					
				}
				
				$hp = array();
				$tml = array();
				$tmv = array();
				$tl = 0;
				$i = 0;
				$j = 0;
				while($i<count($this->uids))
				{
					if($this->stats[$i]['id']>0)
					{
						if( floor($this->stats[$i]['hpNow']) < 1 ) {
							$this->stats[$i]['hpNow'] = 0;
						}
						$hp[$this->users[$i]['team']] += floor($this->stats[$i]['hpNow']);
						if(!isset($tml[$this->users[$i]['team']]) && floor($this->stats[$i]['hpNow']) >= 1)
						{
							$tml[$this->users[$i]['team']] = 1;
							$tmv[$j] = $this->users[$i]['team'];
							$tl++;
						}
					}
					$i++;
				}
				
				if($tl<=1) {
					//Доп.проверка
					$tmHpNow = array();
					$tmNow = array();
					$sp = mysql_query('SELECT `u`.`login`,`u`.`id`,`u`.`battle`,`s`.`team`,`s`.`hpNow` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id` WHERE `u`.`battle` = "'.$this->info['id'].'"');
					while( $pl = mysql_fetch_array($sp) ) {
						if( !isset($tmHpNow[$pl['team']])) {
							$tmHpNow[$pl['team']] = 0;
							$tmNow[] = $pl['team'];
						}
						$hpTm = floor($pl['hpNow']);
						if( $hpTm < 0 ) {
							$hpTm = 0;
						}
						if( $hpTm > 0 ) {
							$tmHpNow[$pl['team']] += $pl['hpNow'];
						}
					}
					$gdj = 0;
					$i = 0;
					while( $i < count($tmNow) ) {
						if( isset($tmNow[$i]) ) {
							$j = $tmNow[$i];
							if( $tmHpNow[$j] > 0 ) {
								$gdj++;
							}
						}
						$i++;
					}
					if( $gdj > 1 ) {
						$tl = $gdj;
						echo 'Поединок может завершиться не корректно... (Сообщите Администрации об этом)';
					}
					if( $tl <= 1 ) {
						$tl = 2;
						mysql_query('UPDATE `stats` SET `mpNow` = `mpAll` , `hpNow` = `hpAll` WHERE `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$this->info['id'].'")');
						mysql_query('UPDATE `stats` SET `hpNow` = 10000 WHERE AND `hpNow` < 1 `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$this->info['id'].'")');
					}
				}

				if($tl <= 1) {	
					die('Что-то пошло не так! Этот бой нельзя завершить!');				
					//завершаем поединок, кто-то один победил, либо ничья
										
					$i = 0; $tmwin = 0;
					while($i<count($tmv))
					{
						if($tmv[$i]>=1 && $tml[$tmv[$i]]>0)
						{
							$tmwin = $tmv[$i];
						}
						$i++;
					}

					if($this->info['izlom'] == 0) {
						$rs = ''; $ts = array(); $tsi = 0;
						if($this->info['id']>0)
						{
							//данные о игроках в бою
							unset($this->users,$this->stats,$this->uids,$this->bots,$this->iBots);
							$trl = mysql_query('SELECT `u`.`no_ip`,`u`.`id`,`u`.`notrhod`,`u`.`login`,`u`.`login2`,`u`.`sex`,`u`.`online`,`u`.`admin`,`u`.`align`,`u`.`clan`,`u`.`level`,`u`.`battle`,`u`.`obraz`,`u`.`win`,`u`.`win_p`,`u`.`lose_p`,`u`.`lose`,`u`.`nich`,`u`.`animal`,`u`.`animal2`,`st`.`stats`,`st`.`hpNow`,`st`.`mpNow`,`st`.`exp`,`st`.`dnow`,`st`.`team`,`st`.`battle_yron`,`st`.`battle_exp`,`st`.`enemy`,`st`.`battle_text`,`st`.`upLevel`,`st`.`timeGo`,`st`.`timeGoL`,`st`.`bot`,`st`.`lider`,`st`.`btl_cof`,`st`.`tactic1`,`st`.`tactic2`,`st`.`tactic3`,`st`.`tactic4`,`st`.`tactic5`,`st`.`tactic6`,`st`.`tactic7`,`st`.`x`,`st`.`y`,`st`.`battleEnd`,`st`.`priemslot`,`st`.`priems`,`st`.`priems_z`,`st`.`bet`,`st`.`clone`,`st`.`atack`,`st`.`bbexp`,`st`.`res_x`,`st`.`res_y`,`st`.`res_s`,`st`.`id`,`st`.`last_hp`,`st`.`last_pr`,`u`.`sex`,`u`.`money`,`u`.`money3`,`u`.`bot_id` FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`battle` = "'.$this->info['id'].'" ORDER BY `st`.`bot` DESC');
							$ir = 0; $bi = 0;
							$this->users = NULL;
							$this->stats = NULL;
							$this->uids = NULL;
							$this->bots = NULL;
							$this->iBots = NULL;
							while($pl = mysql_fetch_array($trl))
							{
								//записываем данные
								if($pl['login2']=='')
								{
									$pl['login2'] = $pl['login'];
								}
								$this->users[$ir] = $pl;
								$this->uids[$pl['id']] = $ir;
								if($pl['bot']>0)
								{
									$this->bots[$bi] = $pl['id'];
									$this->iBots[$pl['id']] = $bi;
									$bi++;
								}
								//записываем статы
								$this->stats[$ir] = $u->getStats($pl,0);
								$ir++;
							}
						}
					}elseif(!isset($this->uids[$u->info['id']])) {
						$rs = ''; $ts = array(); $tsi = 0;
						if($this->info['id']>0)
						{
							//данные о игроках в бою
							$trl = mysql_query('SELECT `u`.`no_ip`,`u`.`id`,`u`.`notrhod`,`u`.`login`,`u`.`login2`,`u`.`sex`,`u`.`online`,`u`.`admin`,`u`.`align`,`u`.`clan`,`u`.`level`,`u`.`battle`,`u`.`obraz`,`u`.`win`,`u`.`win_p`,`u`.`lose_p`,`u`.`lose`,`u`.`nich`,`u`.`animal`,`u`.`animal2`,`st`.`stats`,`st`.`hpNow`,`st`.`mpNow`,`st`.`exp`,`st`.`dnow`,`st`.`team`,`st`.`battle_yron`,`st`.`battle_exp`,`st`.`enemy`,`st`.`battle_text`,`st`.`upLevel`,`st`.`timeGo`,`st`.`timeGoL`,`st`.`bot`,`st`.`lider`,`st`.`btl_cof`,`st`.`tactic1`,`st`.`tactic2`,`st`.`tactic3`,`st`.`tactic4`,`st`.`tactic5`,`st`.`tactic6`,`st`.`tactic7`,`st`.`x`,`st`.`y`,`st`.`battleEnd`,`st`.`priemslot`,`st`.`priems`,`st`.`priems_z`,`st`.`bet`,`st`.`clone`,`st`.`atack`,`st`.`bbexp`,`st`.`res_x`,`st`.`res_y`,`st`.`res_s`,`st`.`id`,`st`.`last_hp`,`st`.`last_pr`,`u`.`sex`,`u`.`money`,`u`.`bot_id`,`u`.`money3` FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`id` = "'.$this->info['id'].'" LIMIT 1');
							$pl = mysql_fetch_array($trl);
								//записываем данные
								if($pl['login2']=='')
								{
									$pl['login2'] = $pl['login'];
								}
								$this->users[count($this->users)] = $pl;
								$this->uids[$pl['id']] = $ir;
								if($pl['bot']>0)
								{
									$this->bots[count($this->bots)] = $pl['id'];
									$this->iBots[$pl['id']] = $bi;
								}
								//записываем статы
								$this->stats[count($this->stats)] = $u->getStats($pl,0);
						}
					}
					

					
					if($this->info['izlom']>0 && $tmwin==1)
					{					
						// выкидываем ботов из боя
						$i = 0; $dlt = ''; $dlt2 = '';
						$sp = mysql_query('SELECT `users`.`id`,`stats`.`bot`,`stats`.`team` FROM `users`,`stats` WHERE `users`.`battle` = "'.$this->info['id'].'" AND `stats`.`id` = `users`.`id` LIMIT 10000');
						while($pl = mysql_fetch_array($sp))
						{
							if($pl['bot']==1 &&$pl['team'] != $u->info['team'])
							{
								$dlt .= ' `id`="'.$pl['id'].'" OR';
								$dlt2 .= ' `uid`="'.$pl['id'].'" OR';
								$i++;
							}
							
						}
						
						if($i > 0) {
							$dlt = trim($dlt,'OR');
							$dlt2 = trim($dlt2,'OR');
							mysql_query('DELETE FROM `users` WHERE '.$dlt.' LIMIT '.$i);
							mysql_query('DELETE FROM `stats` WHERE '.$dlt.' LIMIT '.$i);
							mysql_query('DELETE FROM `items_users` WHERE '.$dlt2.' LIMIT '.($i*100));
							mysql_query('DELETE FROM `eff_users` WHERE '.$dlt2.' LIMIT '.($i*100));
						}
						
						unset($i,$dlt,$dlt2);
						
						$j = 0; $k = 0; $obr = 0;
						
						//Это излом, добавляем еще ботов
							if( rand(0,100) <= 10 || $u->info['id'] == 12345 ) {
								//Уникальные монстры
								if( $this->info['izlomLvl'] == 8 ) {
									$bots = array( 'Валентайский Охотник','Шипокрыл Хаоса','Шипокрыл','Лик Хаоса','Фанатик Хаоса' );
									//$bots = array( 'Валентайский Охотник' );
								}
								$logins_bot = array();
								//
								echo '<center><b><font color=red>Приближается нечто...</font></b></center>';
								//
								$id2 = rand(0,(count($bots)-1));			
								$id = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `login` = "'.$bots[$id2].'" AND `active` = "1" ORDER BY `level` DESC LIMIT 1'));
								$bot = $u->addNewbot($id['id'],NULL,NULL,$logins_bot,NULL,round($this->info['izlomRoundSee']));
								if(isset($id['id']) && $bot != false) {
									//
									$btxt = '';
									if( $id['align'] > 0 ) {
										$btxt = $btxt.'<img width=12 height=15 src=http://img.likebk.com/i/align/align'.$id['align'].'.gif >';
									}
									if( $id['clan'] > 0 ) {
										$btxt = $btxt.'<img width=24 height=15 src=http://img.likebk.com/i/clan/'.$id['clan'].'.gif >';
									}
									$btxt = $btxt.'<b>{u1}</b>['.$id['level'].']<a href=inf.php?'.$id['id'].' target=_blank ><img width=12 height=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>';
									if( $id['sex'] == 1 ) {
										$btxt = $btxt.' вмешалась в поединок.';
									}else{
										$btxt = $btxt.' вмешался в поединок.';
									}
									$this->miniLogAdd(array(
										'login' => $id['login'],
										'sex'	=> $id['sex'],
										'team'	=> 0
									),'{tm1} '.$btxt);
									//
									$logins_bot = $bot['logins_bot'];
									mysql_query('UPDATE `users` SET `battle`="'.$this->info['id'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
									mysql_query('UPDATE `stats` SET `team`="2" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
									if(rand(0,10000) < 1500){ $obr++; }
									$j++;
								}
							}else{
								//Обычные монстры
								if( $this->info['izlomLvl'] == 8 ) {
									$bots = array( 'Литейщик','Проклятие Глубин','Пустынник Маньяк','Пустынник Убийца','Рабочий Мглы','Смотритель Мглы','Сторож Мглы' );
								}
								$logins_bot = array();
								//
								$id2 = rand(0,(count($bots)-1));			
								$id = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `login` = "'.$bots[$id2].'" AND `level` <= "'.$u->info['level'].'" AND `active` = "1" ORDER BY `level` DESC LIMIT 1'));
								$bot = $u->addNewbot($id['id'],NULL,NULL,$logins_bot,NULL,$this->info['izlomRoundSee']);
								if(isset($id['id']) && $bot != false) {
									//
									$btxt = '';
									if( $id['align'] > 0 ) {
										$btxt = $btxt.'<img width=12 height=15 src=http://img.likebk.com/i/align/align'.$id['align'].'.gif >';
									}
									if( $id['clan'] > 0 ) {
										$btxt = $btxt.'<img width=24 height=15 src=http://img.likebk.com/i/clan/'.$id['clan'].'.gif >';
									}
									$btxt = $btxt.'<b>{u1}</b>['.$id['level'].']<a href=inf.php?'.$id['id'].' target=_blank ><img width=12 height=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>';
									if( $id['sex'] == 1 ) {
										$btxt = $btxt.' вмешалась в поединок.';
									}else{
										$btxt = $btxt.' вмешался в поединок.';
									}
									$this->miniLogAdd(array(
										'login' => $id['login'],
										'sex'	=> $id['sex'],
										'team'	=> 0
									),'{tm1} '.$btxt);
									//
									$logins_bot = $bot['logins_bot'];
									mysql_query('UPDATE `users` SET `battle`="'.$this->info['id'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
									mysql_query('UPDATE `stats` SET `team`="2" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
									if(rand(0,10000) < 1500){ $obr++; }
									$j++;
								}
								//
								$id2 = rand(0,(count($bots)-1));			
								$id = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `login` = "'.$bots[$id2].'" AND `level` <= "'.$u->info['level'].'" AND `active` = "1" ORDER BY `level` DESC LIMIT 1'));
								$bot = $u->addNewbot($id['id'],NULL,NULL,$logins_bot,NULL,$this->info['izlomRoundSee']);
								if(isset($id['id']) && $bot != false) {
									//
									$btxt = '';
									if( $id['align'] > 0 ) {
										$btxt = $btxt.'<img width=12 height=15 src=http://img.likebk.com/i/align/align'.$id['align'].'.gif >';
									}
									if( $id['clan'] > 0 ) {
										$btxt = $btxt.'<img width=24 height=15 src=http://img.likebk.com/i/clan/'.$id['clan'].'.gif >';
									}
									$btxt = $btxt.'<b>{u1}</b>['.$id['level'].']<a href=inf.php?'.$id['id'].' target=_blank ><img width=12 height=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>';
									if( $id['sex'] == 1 ) {
										$btxt = $btxt.' вмешалась в поединок.';
									}else{
										$btxt = $btxt.' вмешался в поединок.';
									}
									$this->miniLogAdd(array(
										'login' => $id['login'],
										'sex'	=> $id['sex'],
										'team'	=> 0
									),'{tm1} '.$btxt);
									//
									$logins_bot = $bot['logins_bot'];
									mysql_query('UPDATE `users` SET `battle`="'.$this->info['id'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
									mysql_query('UPDATE `stats` SET `team`="2" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
									if(rand(0,10000) < 1500){ $obr++; }
									$j++;
								}
								//
								if( rand(0,100) < 70 ) {
									$id2 = rand(0,(count($bots)-1));			
									$id = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `login` = "'.$bots[$id2].'" AND `level` <= "'.$u->info['level'].'" AND `active` = "1" ORDER BY `level` DESC LIMIT 1'));
									$bot = $u->addNewbot($id['id'],NULL,NULL,$logins_bot,NULL,$this->info['izlomRoundSee']);
									if(isset($id['id']) && $bot != false) {
									//
									$btxt = '';
									if( $id['align'] > 0 ) {
										$btxt = $btxt.'<img width=12 height=15 src=http://img.likebk.com/i/align/align'.$id['align'].'.gif >';
									}
									if( $id['clan'] > 0 ) {
										$btxt = $btxt.'<img width=24 height=15 src=http://img.likebk.com/i/clan/'.$id['clan'].'.gif >';
									}
									$btxt = $btxt.'<b>{u1}</b>['.$id['level'].']<a href=inf.php?'.$id['id'].' target=_blank ><img width=12 height=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>';
									if( $id['sex'] == 1 ) {
										$btxt = $btxt.' вмешалась в поединок.';
									}else{
										$btxt = $btxt.' вмешался в поединок.';
									}
									$this->miniLogAdd(array(
										'login' => $id['login'],
										'sex'	=> $id['sex'],
										'team'	=> 0
									),'{tm1} '.$btxt);
									//
										$logins_bot = $bot['logins_bot'];
										mysql_query('UPDATE `users` SET `battle`="'.$this->info['id'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
										mysql_query('UPDATE `stats` SET `team`="2" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
										if(rand(0,10000) < 1500){ $obr++; }
										$j++;
									}
								}
								//Каждые 50 вол = +1 монстр 
								$irb = floor($this->info['izlomRoundSee']/50);
								while( $irb > 0 ) {
									//
									if( rand(0,100) < 20 ) {
										$id2 = rand(0,(count($bots)-1));			
										$id = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `login` = "'.$bots[$id2].'" AND `level` <= "'.$u->info['level'].'" AND `active` = "1" ORDER BY `level` DESC LIMIT 1'));
										$bot = $u->addNewbot($id['id'],NULL,NULL,$logins_bot,NULL,$this->info['izlomRoundSee']);
										if(isset($id['id']) && $bot != false) {
											//
											$btxt = '';
											if( $id['align'] > 0 ) {
												$btxt = $btxt.'<img width=12 height=15 src=http://img.likebk.com/i/align/align'.$id['align'].'.gif >';
											}
											if( $id['clan'] > 0 ) {
												$btxt = $btxt.'<img width=24 height=15 src=http://img.likebk.com/i/clan/'.$id['clan'].'.gif >';
											}
											$btxt = $btxt.'<b>{u1}</b>['.$id['level'].']<a href=inf.php?'.$id['id'].' target=_blank ><img width=12 height=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>';
											if( $id['sex'] == 1 ) {
												$btxt = $btxt.' вмешалась в поединок.';
											}else{
												$btxt = $btxt.' вмешался в поединок.';
											}
											$this->miniLogAdd(array(
												'login' => $id['login'],
												'sex'	=> $id['sex'],
												'team'	=> 0
											),'{tm1} '.$btxt);
											//
											$logins_bot = $bot['logins_bot'];
											mysql_query('UPDATE `users` SET `battle`="'.$this->info['id'].'" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
											mysql_query('UPDATE `stats` SET `team`="2" WHERE `id` = "'.$bot['id'].'" LIMIT 1');
											if(rand(0,10000) < 1500){ $obr++; }
											$j++;
										}
									}
									$irb--;
								}
							}
							//
							unset($logins_bot);
						//
						//
						//
						/*if( true == false ) {
							$mz = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `izlom` WHERE `izlom` = "'.$this->info['izlom'].'" AND `level` = "'.$this->info['izlomLvl'].'" LIMIT 50'));
							$mz = $mz[0];
							$pz = $this->info['izlomRound']+rand(1,3);
							if($pz/$mz>1){
								$zz = floor($pz/$mz);
								$pz = $pz-($zz*$mz);
							}
							$iz = mysql_fetch_array(mysql_query('SELECT * FROM `izlom` WHERE `izlom` = "'.$this->info['izlom'].'" AND `level` = "'.$this->info['izlomLvl'].'" AND `round` = "'.$pz.'" LIMIT 1'));
							$i = 0; $bots = $iz['bots']; $bots = explode('|',$bots); $j = 0; $k = 0; $obr = 0;
							$logins_bot = array();
							while($i<count($bots))
							{
								if($bots[$i]>0)
								{
									$k = $u->addNewbot($bots[$i],NULL,NULL,$logins_bot);
									if($k!=false)
									{
										$logins_bot = $k['logins_bot'];
										$upd = mysql_query('UPDATE `users` SET `battle` = "'.$this->info['id'].'" WHERE `id` = "'.$k['id'].'" LIMIT 1');
										if($upd)
										{
											$upd = mysql_query('UPDATE `stats` SET `team` = "2" WHERE `id` = "'.$k['id'].'" LIMIT 1');
											if($upd)
											{
												$j++; if(rand(0,10000) < 1500){ $obr++; }
											}
										}
									}
								}
								$i++;
							}	
							unset($logins_bot);
						}*/
						//
						//
						//
						if($j==0)
						{
							//конец излома
							//if( $u->info['admin'] > 0 ) {
								$this->finishBattle_new($tml,$tmv,NULL);
							//}else{
							//	$this->finishBattle($tml,$tmv,NULL);
							//}
							$fin1 = mysql_query('INSERT INTO `izlom_rating` (`uid`,`time`,`voln`,`level`,`bots`,`rep`,`obr`,`btl`) VALUES ("'.$u->info['id'].'","'.time().'","'.$this->info['izlomRoundSee'].'","'.$this->info['izlomLvl'].'","0","0","'.($this->info['izlomObr']-$this->info['izlomObrNow']).'","'.$this->info['id'].'")');
						}else{
							$this->info['izlomRound'] = $iz['round'];
							mysql_query('UPDATE `battle` SET `izlomObrNow` = '.$obr.',`izlomObr` = `izlomObr` + '.$obr.',`timeout` = (`timeout`+5),`izlomRound` = "'.($this->info['izlomRound']+1).'",`izlomRoundSee` = `izlomRoundSee`+1 WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
							$this->stats[$this->uids[$u->info['id']]]['hpNow'] += $this->stats[$this->uids[$u->info['id']]]['hpAll']*0.25;
							$this->stats[$this->uids[$u->info['id']]]['mpNow'] += $this->stats[$this->uids[$u->info['id']]]['mpAll']*0.25;
							$this->users[$this->uids[$u->info['id']]]['hpNow'] = $this->stats[$this->uids[$u->info['id']]]['hpAll'];
							$this->users[$this->uids[$u->info['id']]]['mpNow'] = $this->stats[$this->uids[$u->info['id']]]['mpAll'];
											$vLog = 'at1=00000||at2=00000||zb1='.$this->stats[$this->uids[$u1]]['zonb'].'||zb2='.$this->stats[$this->uids[$u2]]['zonb'].'||bl1='.$this->atacks[$id]['b'.$a].'||bl2='.$this->atacks[$id]['b'.$b].'||time1='.$this->atacks[$id]['time'].'||time2='.$this->atacks[$id]['time2'].'||s2='.$this->users[$this->uids[$u2]]['sex'].'||s1='.$this->users[$this->uids[$u1]]['sex'].'||t2='.$this->users[$this->uids[$u2]]['team'].'||t1='.$this->users[$this->uids[$u1]]['team'].'||login1='.$this->users[$this->uids[$u1]]['login2'].'||login2='.$this->users[$this->uids[$u2]]['login2'].'';
				
							$mas = array(
								'text' => '',
								'time' => time(),
								'vars' => '',
								'battle' => $this->info['id'],
								'id_hod' => ($this->hodID+1),
								'vars' => $vLog,
								'type' => 1
							);
							if( $u->info['sex'] == 1 ) {
								$mas['text'] = '<span class=date>'.date('H:i').'</span> <b>'.$u->info['login'].'</b> воспользовалась приемом &quot;<b>Передышка</b>&quot;.';
							}else{
								$mas['text'] = '<span class=date>'.date('H:i').'</span> <b>'.$u->info['login'].'</b> воспользовался приемом &quot;<b>Передышка</b>&quot;.';
							}
							if( $u->stats['hpNow'] < $u->stats['hpAll'] ) {
								$hpSks = floor(($u->stats['hpAll']*((rand(15,25))/100)));
								if( $hpSks > floor($u->stats['hpAll'] - $u->stats['hpNow']) ) {
									$hpSks = floor($u->stats['hpAll'] - $u->stats['hpNow']);
								}
								$mas['text'] .= ' <font color=#0066aa><b>+'.$hpSks.'</b></font>';
							}else{
								$hpSks = 0;
								$mas['text'] .= ' <font color=#0066aa><b>--</b></font>';
							}
							$mas['text'] .= ' ['.floor($u->info['hpNow']+$hpSks).'/'.$u->stats['hpAll'].']';
							$this->add_log($mas);
					
							mysql_query('UPDATE `stats` SET `hpNow` = "'.($u->info['hpNow']+($u->stats['hpAll']*((rand(15,25))/100))).'",`mpNow` = "'.($u->info['mpNow']+($u->stats['mpAll']*0.25)).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						}				
					}else{
						//завершаем бой
						//
						//if($u->info['admin'] > 0) {
							$this->finishBattle_new($tml,$tmv,NULL);
						//}else{
						//	$this->finishBattle($tml,$tmv,NULL);
						//}
						//
						if($this->info['izlom']>0)
						{
							$fin1 = mysql_query('INSERT INTO `izlom_rating` (`uid`,`time`,`voln`,`level`,`bots`,`rep`,`obr`,`btl`) VALUES ("'.$u->info['id'].'","'.time().'","'.$this->info['izlomRoundSee'].'","'.$this->info['izlomLvl'].'","0","0","'.($this->info['izlomObr']-$this->info['izlomObrNow']).'","'.$this->info['id'].'")');
						}else{
							echo '<script>'.$this->lookLog().'</script>';
							die();
						}
					}
					if(isset($fin1))
					{
						mysql_query('INSERT INTO `eff_users` (`no_Ace`,`id_eff`,`overType`,`uid`,`name`,`data`,`timeUse`) VALUES ("1","31","23","'.$u->info['id'].'","Касание Хаоса","","'.time().'")');
						mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$u->info['city']."','".$u->info['room']."','','".$u->info['login']."','Вы создали предмет &quot;Образец&quot;x".($this->info['izlomObr']-$this->info['izlomObrNow'])."','".time()."','6','0')");
						$i01 = 1;
						while($i01<=($this->info['izlomObr']-$this->info['izlomObrNow']))
						{				
							$u->addItem(1226,$u->info['id'],'|sudba='.$u->info['login']);
							$i01++;
						}
						unset($fin1);
						echo '<script>'.$this->lookLog().'</script>';
						die();
					}
				}
			}else{
				//if($u->info['admin'] > 0) {
					$this->finishBattle_new(NULL,NULL,10);
					echo '<script>'.$this->lookLog().'</script>';
					die();
				//}else{
				//	$this->finishBattle(NULL,NULL,10);
				//}
			}
		}
		
	//Новое завершение поединка
		public function finishBattle_new($var1,$var2,$var3) {
						
			global $u;
			
			//$this->info['time_test'] = time();
			
			if( $this->info['time_test'] == 0 ) {
				$sp = mysql_query('SELECT `s`.`team` , SUM(`s`.`hpNow`) FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `u`.`id` = `s`.`id` WHERE `u`.`battle` = "'.$this->info['id'].'" GROUP BY `s`.`team`');
				while( $pl = mysql_fetch_array($sp) ) {
					if( $pl['hp'] >= 1 ) {
						$tms++;
					}
				}
				if( $tms < 2 ) {
					mysql_query('UPDATE `battle` SET `time_test` = "'.time().'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
					$this->info['time_test'] = time();
				}
			}
				
			if( $this->info['time_test'] > 0 ) {		
				//echo '[Завершение поединка]';
				
				//if( $u->info['dnow'] == 0 ) {
					mysql_query("LOCK TABLES
						`battle_finish_new` WRITE,
						`bank` WRITE,
						`users` WRITE,
						`stats` WRITE;
					");
				//}
				
				
				//
				
				/*if( $this->info['id'] == 9947913 ) {
					die('Test finish...');
				}else*/
				
				/*if( $u->info['id'] == 12345 && !isset($_GET['finishnew']) && $this->info['team_win'] == -1 ) {
					if( $this->info['time_test'] == 0 ) {
						$sp = mysql_query('SELECT `s`.`team` , SUM(`s`.`hpNow`) FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `u`.`id` = `s`.`id` WHERE `u`.`battle` = "'.$this->info['id'].'" GROUP BY `s`.`team`');
						while( $pl = mysql_fetch_array($sp) ) {
							if( $pl['hp'] >= 1 ) {
								$tms++;
							}
						}
						echo '[!!!]';
						if( $tms < 2 ) {
							mysql_query('UPDATE `battle` SET `time_test` = "'.time().'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
						}
					}
				}else*/
				if( $this->info['team_win'] == -1 ) {
					$tmlwin = 0;
					$sp = mysql_query('SELECT `id`,`bot`,`team`,`hpNow` FROM `stats` WHERE `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$this->info['id'].'")');
					while( $pl = mysql_fetch_array($sp) ) {
						mysql_query('DELETE FROM `battle_finish_new` WHERE `uid` = "'.$pl['id'].'"');
						if( $pl['hpNow'] >= 1 ) {
							$pl['hpNow'] = 1;
						}else{
							$pl['hpNow'] = 0;
						}
						if( $pl['hpNow'] > 0 ) {
							$tml[$pl['team']]++;
							$tmlwin = $pl['team'];
						}
						mysql_query('INSERT INTO `battle_finish_new` (
							`razdel`,
							`priz`,
							`uid`,
							`battle`,
							`team`,
							`life`,
							`finish`,
							`bot`
						) VALUES (
							"'.$this->info['razdel'].'",
							"'.$this->info['priz'].'",
							"'.$pl['id'].'",
							"'.$this->info['id'].'",
							"'.$pl['team'].'",
							"'.$pl['hpNow'].'",
							"0",
							"'.$pl['bot'].'"
						)');
					}
					if( count($tml) > 1 ) {
						mysql_query('DELETE FROM `battle_finish_new` WHERE `battle` = "'.$this->info['id'].'"');
						$this->info['team_win'] = -1;
						//поединок не завершился
					}else{
						//Завершаем поединок
						mysql_query('UPDATE `battle` SET `team_win` = "'.$tmlwin.'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
						$this->info['team_win'] = $tmlwin;
					}
	
					$prc = $this->expCoef + $this->aBexp; // процент, общий
					
					$sp = mysql_query('SELECT * FROM `battle_finish_new` WHERE `battle` = "'.$this->info['id'].'" AND `finish` = 0');
					while( $pl = mysql_fetch_array($sp) ) {
						
						$i = $this->uids[$pl['uid']]; //id игрока в массиве
											
						// сколько % опыта получит игрок
						$pl['proc'] += $prc;
						if($this->stats[$i]['silver'] > 0) {
							$pl['proc'] += 5 * $this->stats[$i]['silver'];
							if($this->stats[$i]['bonusexp'] > 1) {
								$pl['proc'] += 1000 * $this->stats[$i]['bonusexp'];
							}
						}
						if( $this->users[$i]['align'] == 2 ) {
							$pl['proc'] = 50;
						}
						
						// сколько урона нанес игрок
						$pl['dmg'] = $this->users[$i]['battle_yron'];
						
						// сколько опыта получит игрок (без %)		
						$pl['exp'] =  $this->users[$i]['battle_exp'];
						if( $pl['exp'] < 0 ) {
							$pl['exp'] = 0;
						}
						
						if( $pl['team'] == $this->info['team_win'] ){
							//победа
							$pl['win'] = 1;
						}elseif( $this->info['team_win'] > 0 ){
							//поражение
							$pl['win'] = 2;
						}else{
							//ничья
							$pl['win'] = 3;
							$pl['win_lost'] = $pl['team'].'|'.$this->info['team_win'];
						}
						
						if($this->info['razdel'] == 5) {
							$pl['daily'] = 1;
						}else{
							$pl['daily'] = 0;
						}
						
						$pl['sneg007'] = 0;
						
						if($this->info['dungeon'] > 0) {
							$pl['sneg007'] = 3;
						}elseif($this->info['razdel'] == 5 || $u->info['id'] == 12345){
							$pl['sneg007'] = 2;
						}else{
							$pl['sneg007'] = 0;
						}
						/*elseif($this->info['razdel'] == 5 && (date('m') == '02' || (date('m') == '01' && date('d') > 14))){
							$pl['sneg007'] = 2;
							//$txt_prasd = 'Вы получили праздничный предмет! (Снеговик)';
							//mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$this->users[$i]['city']."','".$this->users[$i]['room']."','','".$this->users[$i]['login']."','".$txt_prasd."','-1','6','0')");
						}elseif($this->info['dungeon'] > 0 && (date('m') == '02' || (date('m') == '01' && date('d') > 14))){
							if(rand(0,100) < 11) {
								$pl['sneg007'] = 3;
							}else{
								$pl['sneg007'] = 0;
							}
							//$txt_prasd = 'Вы получили праздничный предмет! (Снеговик)';
							//mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$this->users[$i]['city']."','".$this->users[$i]['room']."','','".$this->users[$i]['login']."','".$txt_prasd."','-1','6','0')");
						}elseif($this->info['razdel'] == 5 && (date('m') == '03' || (date('m') == '04' && date('d') <= 14))){
							$pl['sneg007'] = 4;
							//$txt_prasd = 'Вы получили праздничный предмет! (Снеговик)';
							//mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$this->users[$i]['city']."','".$this->users[$i]['room']."','','".$this->users[$i]['login']."','".$txt_prasd."','-1','6','0')");
						}elseif($this->info['dungeon'] > 0 && (date('m') == '03' || (date('m') == '04' && date('d') <= 14))){
							if(rand(0,100) < 11) {
								$pl['sneg007'] = 5;
							}else{
								$pl['sneg007'] = 0;
							}
							//$txt_prasd = 'Вы получили праздничный предмет! (Снеговик)';
							//mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$this->users[$i]['city']."','".$this->users[$i]['room']."','','".$this->users[$i]['login']."','".$txt_prasd."','-1','6','0')");
						}elseif($this->info['razdel'] == 5 && date('m') == '11'){
							$pl['sneg007'] = 8;
							//$txt_prasd = 'Вы получили праздничный предмет! (Снеговик)';
							//mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$this->users[$i]['city']."','".$this->users[$i]['room']."','','".$this->users[$i]['login']."','".$txt_prasd."','-1','6','0')");
						}elseif($this->info['dungeon'] > 0 && date('m') == '11' ){
							if(rand(0,100) < 11) {
								$pl['sneg007'] = 9;
							}else{
								$pl['sneg007'] = 0;
							}
							//$txt_prasd = 'Вы получили праздничный предмет! (Снеговик)';
							//mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$this->users[$i]['city']."','".$this->users[$i]['room']."','','".$this->users[$i]['login']."','".$txt_prasd."','-1','6','0')");
						}else{
							$pl['sneg007'] = 0;
						}
						*/
						
						//Обновляем завершение для этого игрока
						mysql_query('UPDATE `battle_finish_new` SET 
						
							`win_lost` = "'.$pl['win_lost'].'" ,
							`daily` = "'.$pl['daily'].'" ,
							`ekr` = "'.$pl['ekr'].'",
							`sneg` = "'.$pl['sneg007'].'" ,
							`win` = "'.$pl['win'].'",
							`finish` = "1" ,
							`exp` = "'.$pl['exp'].'" ,
							`dmg` = "'.$pl['dmg'].'" ,
							`proc` = "'.$pl['proc'].'"
						
						WHERE `id` = "'.$pl['id'].'" LIMIT 1');
						//
						//Поломка предметов
						/*
						if( $pl['team'] == $this->info['team_win'] ){
							//победа
							if( $this->users[$i]['dnow'] == 0 ) {
								$lom = (rand(0,5))/100;
							}
						}elseif( $this->info['team_win'] > 0 ){
							//поражение
							$lom = (rand(25,50))/100;
							$lom = round($lom*2.75,2);
							$nlom = array(0=>rand(0,18),1=>rand(0,18),2=>rand(0,18),3=>rand(0,18));
							mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW`+'.$lom.' WHERE `inOdet` < "18" AND `inOdet` > "0" AND `uid` = "'.$pl['uid'].'" AND `inOdet`!="0" AND `inOdet`!='.$nlom[0].' AND `inOdet`!='.$nlom[1].' AND `inOdet`!='.$nlom[2].' AND `inOdet`!='.$nlom[3].' LIMIT 18');
						}else{
							//ничья
							$lom = (rand(5,25))/100;
							$lom = round($lom*2.75,2);
							$nlom = array(0=>rand(0,18),1=>rand(0,18),2=>rand(0,18),3=>rand(0,18));
							mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW`+'.$lom.' WHERE `inOdet` < "18" AND `inOdet` > "0" AND `uid` = "'.$pl['uid'].'" AND `inOdet`!="0" AND `inOdet`!='.$nlom[0].' AND `inOdet`!='.$nlom[1].' AND `inOdet`!='.$nlom[2].' AND `inOdet`!='.$nlom[3].' LIMIT 18');
						}
						*/
						//
					}
					
				}
				mysql_query('DELETE FROM `battle_finish_new` WHERE `bot` > 0 AND `battle` = "'.$this->info['id'].'"');
				//
				//if( $u->info['dnow'] == 0 ) {
					mysql_query("UNLOCK TABLES;");
				//}
				//echo '[Готово!]';
				if( $this->info['team_win'] != -1 ) {
					$this->finishBattle($var1,$var2,$var3);
				}
				//die();
			}
		}
		
	//завершение поединка
		public function finishBattle($t,$v,$nl)
		{
			global $magic,$u,$q,$c;
			
			
			$frtu = false;
			
			/*
			$lock_file = 'lock/btl_finish_'.$this->info['id'].'.bk2'; 
			if ( !file_exists($lock_file) ) { 
				$fp_lock = fopen($lock_file, 'w');
				flock($fp_lock, LOCK_EX); 
			}else{
				$frtu = true;
			}
			*/	
			
			
			if( $this->info['iznomRound'] == 0 ) {
				$test_lgs = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'" ORDER BY `id` DESC LIMIT 1'));
				if( $test_lgs['time'] > time() - 1 ) {
					$frtu = true;
					//echo '<font color=red ><b>Идет завершение поединка...</b></font>';
					die();
				}
			}
			if( $this->dietest == true && $this->info['iznomRound'] == 0 ) {
				$frtu = true;
			}
			
								
			if($frtu == false) {
			
				//
				$sp = mysql_query('SELECT `st`.`hpNow`,`st`.`id` FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id` WHERE `u`.`battle` = "'.$this->info['id'].'"');
				while( $pl = mysql_fetch_array($sp) ) {
					if(isset($this->uids[$pl['id']])) {
						$this->users[$this->uids[$pl['id']]]['hpNow'] = $pl['hpNow'];
						$this->stats[$this->uids[$pl['id']]]['hpNow'] = $pl['hpNow'];
					}
				}
				//
			
				if($nl!=10)
				{
					$i = 0; $dnr = 0;
					if($this->info['team_win']==-1)
					{
						$this->info['team_win'] = 0;
						while($i<count($v))
						{
							if($v[$i]>=1 && $t[$v[$i]]>0)
							{
								$this->info['team_win'] = $v[$i];
							}
							$i++;
						}														
					}
				}
				//mysql_query('LOCK TABLES users,stats,battle,battle_last,battle_end,chat WRITE');
				
				//данные о игроках в бою
				$t = mysql_query('SELECT `u`.`stopexp`,`u`.`twink`,`u`.`city`,`u`.`room`,`u`.`no_ip`,`u`.`pass`,`u`.`id`,`u`.`notrhod`,`u`.`login`,`u`.`login2`,`u`.`sex`,`u`.`online`,`u`.`admin`,`u`.`align`,`u`.`clan`,`u`.`level`,`u`.`battle`,`u`.`obraz`,`u`.`win`,`u`.`win_p`,`u`.`lose_p`,`u`.`lose`,`u`.`nich`,`u`.`animal`,`u`.`animal2`,`st`.`stats`,`st`.`hpNow`,`st`.`mpNow`,`st`.`exp`,`st`.`dnow`,`st`.`team`,`st`.`battle_yron`,`st`.`battle_exp`,`st`.`enemy`,`st`.`battle_text`,`st`.`upLevel`,`st`.`timeGo`,`st`.`timeGoL`,`st`.`bot`,`st`.`lider`,`st`.`btl_cof`,`st`.`tactic1`,`st`.`tactic2`,`st`.`tactic3`,`st`.`tactic4`,`st`.`tactic5`,`st`.`tactic6`,`st`.`tactic7`,`st`.`x`,`st`.`y`,`st`.`battleEnd`,`st`.`priemslot`,`st`.`priems`,`st`.`priems_z`,`st`.`bet`,`st`.`clone`,`st`.`atack`,`st`.`bbexp`,`st`.`res_x`,`st`.`res_y`,`st`.`res_s`,`st`.`id`,`st`.`last_hp`,`st`.`last_pr`,`u`.`sex`,`u`.`money`,`u`.`bot_id`,`u`.`money3` FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`battle` = "'.$this->info['id'].'"');
				$i = 0; $bi = 0;
				while($pl = mysql_fetch_array($t))
				{
					//записываем данные
					if($pl['login2']=='')
					{
						$pl['login2'] = $pl['login'];
					}
					$this->users[$i] = $pl;
					$this->uids[$pl['id']] = $i;
					if($pl['bot']>0)
					{
						$this->bots[$bi] = $pl['id'];
						$this->iBots[$pl['id']] = $bi;
						$bi++;
					}
					//записываем статы
					$this->stats[$i] = $u->getStats($pl,0);
					//
					//
					$i++;
				}
			
			if($this->info['time_over']==0)
			{
				$tststrt = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$this->info['id'].'" AND `time_over` = "0" LIMIT 1'));
				if(isset($tststrt['id'])) {
					
					
					//Турнир БС
					if( $u->info['inTurnir'] > 0 ) {
						$bs = mysql_fetch_array(mysql_query('SELECT * FROM `bs_turnirs` WHERE `id` = "'.$u->info['inTurnir'].'" LIMIT 1'));
						$i = 0;
						while($i<count($this->users)) {
							if( $this->stats[$i]['hpNow'] < 1 && $this->users[$i]['clone'] == 0 && $this->stats[$i]['clone'] == 0 && $this->users[$i]['real'] == 0 ) {
								//Удаляем из БС
								//echo '['.$this->users[$i]['login'].']';
								//Добавляем в лог БС
								if( $this->users[$i]['sex'] == 0 ) {
									$text .= '{u1} повержен и выбывает из турнира+';
								}else{
									$text .= '{u1} повержена и выбывает из турнира-';
								}
								//Выкидываем предметы с персонажа
								$spik = mysql_query('SELECT `id`,`item_id` FROM `items_users` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `delete` ="0"');
							while( $plik = mysql_fetch_array($spik) ) {
								
								mysql_query('INSERT INTO `bs_items` (`x`,`y`,`bid`,`count`,`item_id`) VALUES (
									"'.$this->users[$i]['x'].'","'.$this->users[$i]['y'].'","'.$bs['id'].'","'.$bs['count'].'","'.$plik['item_id'].'"
								)');
								
							}
								unset($spik,$plik);
								//
								$usrreal = '';
								$usr_real = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`align`,`clan`,`battle`,`level` FROM `users` WHERE `login` = "'.$this->users[$i]['login'].'" AND `inUser` = "'.$this->users[$i]['id'].'" LIMIT 1'));
								if( !isset($usr_real['id']) ) {
									$usr_real = $this->users[$i];
								}
								if( isset($usr_real['id'])) {
									$usrreal = '';
									if( $usr_real['align'] > 0 ) {
										$usrreal .= '<img src=http://img.likebk.com/i/align/align'.$usr_real['align'].'.gif width=12 height=15 >';
									}
									if( $usr_real['clan'] > 0 ) {
										$usrreal .= '<img src=http://img.likebk.com/i/clan/'.$usr_real['clan'].'.gif width=24 height=15 >';
									}
									$usrreal .= '<b>'.$usr_real['login'].'</b>['.$usr_real['level'].']<a target=_blank href=http://likebk.com/inf.php?'.$usr_real['id'].' ><img width=12 hiehgt=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>';
								}else{
									$mereal = '<i>Невидимка</i>[??]';
								}
								$text = str_replace('{u1}',$usrreal,$text);
								mysql_query('INSERT INTO `bs_logs` (`type`,`text`,`time`,`id_bs`,`count_bs`,`city`,`m`,`u`) VALUES (
									"1", "'.mysql_real_escape_string($text).'", "'.time().'", "'.$bs['bsid'].'", "'.$bs['count'].'", "'.$bs['city'].'",
									"'.round($bs['money']*0.85,2).'","'.$i.'"
								)');
								//
								//Удаление клона
								mysql_query('DELETE FROM `users` WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
								mysql_query('DELETE FROM `stats` WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
								mysql_query('DELETE FROM `actions` WHERE `uid` = "'.$this->users[$i]['id'].'"');
								mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$this->users[$i]['id'].'"');
								mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$this->users[$i]['id'].'"');
								mysql_query('DELETE FROM `users_delo` WHERE `uid` = "'.$this->users[$i]['id'].'"');
									
								//Обновление персонажа
								mysql_query('UPDATE `users` SET `inUser` = "0" WHERE `login` = "'.$this->users[$i]['login'].'" OR `inUser` = "'.$this->users[$i]['id'].'" LIMIT 1');
								//Обновляем заявку
								mysql_query('UPDATE `bs_zv` SET `off` = "'.time().'" WHERE `inBot` = "'.$this->users[$i]['id'].'" AND `off` = "0" LIMIT 1');
								unset($text,$usrreal,$usr_real);
							}
							$i++;
						}
						unset($bs);
					}
					//
						
						
				/*if($this->users[$i]['room'] == 363) {
					if($this->users[$i]['team']!=$this->info['team_win']) {
					$bs = mysql_fetch_array(mysql_query('SELECT * FROM `bs_turnirs` WHERE `id` = "'.$u->info['inTurnir'].'" LIMIT 1'));
					$i = 0;
					while($i<count($this->users)) {
							//Удаляем из БС
							//echo '['.$this->users[$i]['login'].']';
							//Добавляем в лог БС
							if( $this->users[$i]['sex'] == 0 ) {
								$text .= '{u1} повержен и выбывает из турнира';
							}else{
								$text .= '{u1} повержена и выбывает из турнира';
							}
							//Выкидываем предметы с персонажа
							$spik = mysql_query('SELECT `id`,`item_id` FROM `items_users` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `delete` ="0"');
							while( $plik = mysql_fetch_array($spik) ) {
								
								mysql_query('INSERT INTO `bs_items` (`x`,`y`,`bid`,`count`,`item_id`) VALUES (
									"'.$this->users[$i]['x'].'","'.$this->users[$i]['y'].'","'.$bs['id'].'","'.$bs['count'].'","'.$plik['item_id'].'"
								)');
								
							}
							unset($spik,$plik);
							//
							$usrreal = '';
							$usr_real = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`align`,`clan`,`battle`,`level` FROM `users` WHERE `login` = "'.$this->users[$i]['login'].'" AND `inUser` = "'.$this->users[$i]['id'].'" LIMIT 1'));
							if( !isset($usr_real['id']) ) {
								$usr_real = $this->users[$i];
							}
							if( isset($usr_real['id'])) {
								$usrreal = '';
								if( $usr_real['align'] > 0 ) {
									$usrreal .= '<img src=http://img.likebk.com/i/align/align'.$usr_real['align'].'.gif width=12 height=15 >';
								}
								if( $usr_real['clan'] > 0 ) {
									$usrreal .= '<img src=http://img.likebk.com/i/clan/'.$usr_real['clan'].'.gif width=24 height=15 >';
								}
								$usrreal .= '<b>'.$usr_real['login'].'</b>['.$usr_real['level'].']<a target=_blank href=http://likebk.com/info/'.$usr_real['id'].' ><img width=12 hiehgt=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>';
							}else{
								$mereal = '<i>Невидимка</i>[??]';
							}
							$text = str_replace('{u1}',$usrreal,$text);
							mysql_query('INSERT INTO `bs_logs` (`type`,`text`,`time`,`id_bs`,`count_bs`,`city`,`m`,`u`) VALUES (
								"1", "'.mysql_real_escape_string($text).'", "'.time().'", "'.$bs['id'].'", "'.$bs['count'].'", "'.$bs['city'].'",
								"'.round($bs['money']*0.85,2).'","'.$i.'"
							)');
							//Удаление клона
							mysql_query('DELETE FROM `users` WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
							mysql_query('DELETE FROM `rep` WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
							mysql_query('DELETE FROM `stats` WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
							mysql_query('DELETE FROM `actions` WHERE `uid` = "'.$this->users[$i]['id'].'"');
							mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$this->users[$i]['id'].'"');
							mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$this->users[$i]['id'].'"');
							mysql_query('DELETE FROM `users_delo` WHERE `uid` = "'.$this->users[$i]['id'].'"');
							//Обновление персонажа
							mysql_query('UPDATE `users` SET `inUser` = "0" WHERE `login` = "'.$this->users[$i]['login'].'" OR `inUser` = "'.$this->users[$i]['id'].'" LIMIT 1');
							//Обновляем заявку
							mysql_query('UPDATE `bs_zv` SET `off` = "'.time().'" WHERE `uid` = "'.$usr_real['id'].'" AND `off` = "0" LIMIT 1');
							$bs['users_finish'] -= 1;
							mysql_query('UPDATE `bs_turnirs` SET `users_finish` = "'.$bs['users_finish'].'" WHERE `id` = "'.$bs['id'].'" LIMIT 1');
							unset($text,$usrreal,$usr_real);
						$i++;
					}
					unset($bs);
				}
			}*/
						
					
					if( $this->info['inTurnir'] == 0 ) {
						mysql_query('UPDATE `battle` SET `time_over` = "'.time().'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
					}
					//Заносим данные о завершении боя
					$i = 0; $vl = ''; $vtvl = ''; $relu = 0; $vtvlldr = '';
					while($i<count($this->users))
					{
						/*if( $this->user[$i]['clon'] == 0 && $this->user[$i]['bot'] == 0 ) {
							$relu++;
						}*/
						mysql_query('UPDATE `battle_finish_new` SET `team` = "'.$this->users[$i]['team'].'" WHERE `battle` = "'.$this->info['id'].'" AND `uid` = "'.$this->users[$i]['id'].'"');
						$vl .= '("'.$this->users[$i]['login'].'","'.$this->users[$i]['city'].'","'.$this->info['id'].'","'.$this->users[$i]['id'].'","'.time().'","'.$this->users[$i]['team'].'","'.$this->users[$i]['level'].'","'.$this->users[$i]['align'].'","'.$this->users[$i]['clan'].'","'.$this->users[$i]['exp'].'","'.$this->users[$i]['bot'].'","'.$this->users[$i]['money'].'","'.$this->users[$i]['money3'].'"),';
						if($this->users[$i]['team'] == $this->info['team_win'] && $this->info['team_win'] > 0) {
							$vtvl .= '<b>'.$this->users[$i]['login'].'</b>, ';
							if( $this->users[$i]['lider'] > 0 ) {
								$vtvlldr .= '<b>'.$this->users[$i]['login'].'</b> и';
							}
						}
						$i++;
					}
					
										
					$this->info['players_c'] = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users` WHERE `login` NOT LIKE "%(зверь%" AND `battle` = "'.$this->info['id'].'" LIMIT 1'));
					$this->info['players_c'] = $this->info['players_c'][0];
					
					mysql_query('UPDATE `battle` SET `team_win` = "'.$this->info['team_win'].'" , `players_c` = "'.$this->info['players_c'].'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
					
					if($vtvl != '') {
						$vtvl = rtrim($vtvl,', ');
						$vtvl = str_replace('"','\\\\\"',$vtvl);
						
						$vtvlldr = rtrim($vtvl,', ');
						$vtvlldr = str_replace('"','\\\\\"',$vtvl);
						
						if($this->info['status'] > 0 ) {
							$vtvlldr = '. Благодаря величайшим воинам '.$vtvlldr;
						}else{
							$vtvlldr = '';
						}
						
						$this->hodID++;
						$vLog = 'time1='.time();
						$mass = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>'test','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
						$vtvl = 'Бой закончен'.$vtvlldr.', победа за '.$vtvl.'.';
						$ins = mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$vtvl.'","'.$mass['vars'].'","'.$mass['zona1'].'","'.$mass['zonb1'].'","'.$mass['zona2'].'","'.$mass['zonb2'].'","'.$mass['type'].'")');
					}else{
						$this->info['players_cc'] = mysql_fetch_array(mysql_query('SELECT COUNT(`u`.`id`) FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id` WHERE `s`.`hpNow` > 0 AND `u`.`battle` = "'.$this->info['id'].'" AND `s`.`team` != "'.$u->info['team'].'" LIMIT 1'));
						$this->info['players_cc'] = $this->info['players_cc'][0];
						$this->info['players_cc2'] = mysql_fetch_array(mysql_query('SELECT COUNT(`u`.`id`) FROM `users` AS `u` LEFT JOIN `stats` AS `s` ON `s`.`id` = `u`.`id` WHERE `s`.`hpNow` >= 1 AND `u`.`battle` = "'.$this->info['id'].'" AND `s`.`team` != "'.$u->info['team'].'" LIMIT 1'));
						$this->info['players_cc2'] = $this->info['players_cc2'][0];
						$inf_test = ', users: '.$this->info['players_cc'].' and '.$this->info['players_cc2'].'';
						$this->hodID++;
						$vLog = 'time1='.time();
						$mass = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>'test','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
						//$vtvl = 'Бой закончен, ничья. ( Information '.$inf_test.' )';
						$vtvl = 'Бой закончен, ничья.'; 
						$ins = mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$vtvl.'","'.$mass['vars'].'","'.$mass['zona1'].'","'.$mass['zonb1'].'","'.$mass['zona2'].'","'.$mass['zonb2'].'","'.$mass['type'].'")');
					}
					
					//$this->saveLogs( $this->info['id'] , 'all' );
					
					if( $this->info['type'] == 99 || $this->info['type'] == 199 ) {
						//$this->hodID++;
						$vLog = 'time1='.time();
						$mass = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>'test','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
						$vtvl = 'И победители стали калечить проигравших...';
						$ins = mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$vtvl.'","'.$mass['vars'].'","'.$mass['zona1'].'","'.$mass['zonb1'].'","'.$mass['zona2'].'","'.$mass['zonb2'].'","'.$mass['type'].'")');
						$i = 0; $vtvl = '';
						$tr_nm = array(
						 1 => 'легкую',
						 2 => 'среднюю',
						 3 => 'тяжелую'
						);
						$dart = mysql_fetch_array(mysql_query('SELECT * FROM `dark_attack` WHERE `battle` = "'.$this->info['id'].'" LIMIT 1'));
						while($i<count($this->users)) {
							
							$ttrvm1 = mysql_fetch_array(mysql_query('SELECT `id`,`x` FROM `eff_users` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `id_eff` = 263 AND `delete` = 0 LIMIT 1'));

							if( !isset($ttrvm1['id']) && $this->users[$i]['team'] != $this->info['team_win'] ) {
								$tr_pl = mysql_fetch_array(mysql_query('SELECT `id`,`v1` FROM `eff_users` WHERE `id_eff` = 4 AND `uid` = "'.$this->users[$i]['id'].'" AND `delete` = "0" ORDER BY `v1` DESC LIMIT 1'));
								if(isset($tr_pl['id'])) {
									mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$tr_pl['id'].'" LIMIT 1');
								}
								unset($tr_pl);
								//if( !isset($tr_pl['id']) || $tr_pl['v1'] < 3 || ( $dart['uid1'] == $this->users[$i]['id'] || $dart['uid2'] == $this->users[$i]['id'] ) ) {
								if( !isset($tr_pl['id']) || $dart['uid1'] == $this->users[$i]['id'] || $dart['uid2'] == $this->users[$i]['id'] ) {
									$tr_tp = rand(1,3);
									if( isset($tr_pl['id']) ) {
										$tr_tp = rand(($tr_pl['v1']+1),3);
									}
									$nelich = 0;
									$nelich2 = '';
									if( $this->info['type'] == 199 || /*$dart['uid1'] == $this->users[$i]['id'] || $dart['uid2'] == $this->users[$i]['id']*/ isset($dart['id']) ) {
										$nelich = array('id'=>1);
										$nelich2 = ' <u>неизлечимую</u> ';
										$tr_tp = 3;
									}
									if( $this->users[$i]['sex'] == 1 ) {
										$vtvl = '<b>'.$this->users[$i]['login'].'</b> получила повреждение: <font color=red>'.$tr_nm[$tr_tp].''.$nelich2.' травму</font>.<br>'.$vtvl;
									}else{
										$vtvl = '<b>'.$this->users[$i]['login'].'</b> получил повреждение: <font color=red>'.$tr_nm[$tr_tp].''.$nelich2.' травму</font>.<br>'.$vtvl;
									}
									$this->addTravm($this->users[$i]['id'],$tr_tp,rand(3,5),$nelich);
								}
							}
							$i++;
						}
						$ins = mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$vtvl.'","'.$mass['vars'].'","'.$mass['zona1'].'","'.$mass['zonb1'].'","'.$mass['zona2'].'","'.$mass['zonb2'].'","'.$mass['type'].'")');
					}
					
					if($vl!='')
					{
						$vl = rtrim($vl,',');
						mysql_query('INSERT INTO `battle_last` (`login`,`city`,`battle_id`,`uid`,`time`,`team`,`lvl`,`align`,`clan`,`exp`,`bot`,`money`,`money3`) VALUES '.$vl.'');
					}
					
					mysql_query('INSERT INTO `battle_end` (`battle_id`,`city`,`time`,`team_win`) VALUES ("'.$this->info['id'].'","'.$this->info['city'].'","'.$this->info['time_start'].'","'.$this->info['team_win'].'")');
				}
				$vLog = 'time1='.time();
				$mass = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>'test','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
				//$vtvl = '';
				//$ins = mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$vtvl.'","'.$mass['vars'].'","'.$mass['zona1'].'","'.$mass['zonb1'].'","'.$mass['zona2'].'","'.$mass['zonb2'].'","'.$mass['type'].'")');
				$i = 0; $vtvl = '';
				$tr_nm = array(
				 1 => 'легкую',
				 2 => 'среднюю',
				 3 => 'тяжелую'
				);
				while($i<count($this->users)) {
					if( $this->users[$i]['team'] != $this->info['team_win'] && $this->info['team_win'] > 0 ) {
						$tr_pl = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `v1` = "priem" AND `v2` = 292 AND `uid` = "'.$this->users[$i]['id'].'" AND `delete` = "0" LIMIT 1'));
						
						if( $this->info['razdel'] == 5 ) {
							$u->addWord($this->users[$i]['id']);
						}
						
						$ins = mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$vtvl2.'","'.$mass['vars'].'","'.$mass['zona1'].'","'.$mass['zonb1'].'","'.$mass['zona2'].'","'.$mass['zonb2'].'","'.$mass['type'].'")');

						if( isset($tr_pl['id']) ) {
							if( rand(0,100) < $tr_pl['data'] ) {
								$tr_tp = rand(1,3);
								if( isset($tr_pl['id']) ) {
									$tr_tp = rand(($tr_pl['v1']+1),3);
								}
								if( $this->users[$i]['sex'] == 1 ) {
									$vtvl = '<b>'.$this->users[$i]['login'].'</b> получила повреждение (Искалечить, автор: <b>'.$this->users[$this->uids[$tr_pl['user_use']]]['login'].'</b>): <font color=red>'.$tr_nm[$tr_tp].' травму</font>.<br>'.$vtvl;
								}else{
									$vtvl = '<b>'.$this->users[$i]['login'].'</b> получил повреждение (Искалечить, автор: <b>'.$this->users[$this->uids[$tr_pl['user_use']]]['login'].'</b>): <font color=red>'.$tr_nm[$tr_tp].' травму</font>.<br>'.$vtvl;
								}
								$this->addTravm($this->users[$i]['id'],$tr_tp,rand(3,5));
								if( $this->users[$i]['real'] > 0 ) {
									mysql_query('UPDATE `achiev` SET `a10` = `a10` + 1 WHERE `uid` = "'.mysql_real_escape_string($tr_pl['user_use']).'" LIMIT 1');
								}
							}
						}
					}
					$i++;
				}
				if( $vtvl != '' ) {
					if( $this->info['type'] != 99 ) {
						$vtvl2 = 'И победители стали калечить проигравших...';
						$ins = mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$vtvl2.'","'.$mass['vars'].'","'.$mass['zona1'].'","'.$mass['zonb1'].'","'.$mass['zona2'].'","'.$mass['zonb2'].'","'.$mass['type'].'")');
					}
					$ins = mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$vtvl.'","'.$mass['vars'].'","'.$mass['zona1'].'","'.$mass['zonb1'].'","'.$mass['zona2'].'","'.$mass['zonb2'].'","'.$mass['type'].'")');
				}	
																
				//Награда за события
				if( $this->info['type'] == 500 && isset($tststrt['id']) ) {
					
					//Предметы которые выпадают в центр
					
					$i = 0;
					while($i<count($this->users)) {
						if( $this->users[$i]['no_ip'] == 'trupojor' ) {
							$mon = mysql_fetch_array(mysql_query('SELECT * FROM `aaa_monsters` WHERE `uid` = "'.$this->users[$i]['id'].'" LIMIT 1'));
							if( isset($mon['id']) ) {
								if( $this->info['team_win'] == 0 ) {
									//Ничья
									mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats['hpAll'].'",`mpNow` = "'.$this->stats['mpAll'].'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
									mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("<font color=red>Внимание!</font> '.mysql_real_escape_string(str_replace('{b}','<b>'.$this->users[$i]['login'].'</b> ['.$this->users[$i]['level'].']<a target=_blank href=inf.php?'.$this->users[$i]['id'].' ><img width=12 height=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>',$mon['nich_text'])).' ","'.$this->users[$i]['city'].'","","6","1","'.time().'")');
								}elseif( $this->info['team_win'] == $this->stats[$i]['team'] ) {
									//Проиграли
									if( $mon['win_back'] == 1 ) {
										mysql_query('UPDATE `users` SET `room` = "303" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
									}
									mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats['hpAll'].'",`mpNow` = "'.$this->stats['mpAll'].'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
									mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("<font color=red>Внимание!</font> '.mysql_real_escape_string(str_replace('{b}','<b>'.$this->users[$i]['login'].'</b> ['.$this->users[$i]['level'].']<a target=_blank href=inf.php?'.$this->users[$i]['id'].' ><img width=12 height=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>',$mon['lose_text'])).' ","'.$this->users[$i]['city'].'","","6","1","'.time().'")');
								}else{
									//Выиграли
									$j = 0; $usrwin = '';
									while($j < count($this->users)) {
										if( $this->users[$j]['no_ip'] != 'trupojor' && $this->users[$j]['bot'] == 0 ) {
											
											//Хеллоуин
											if( $mon['uid'] == 10165078 ) {
												$hwns = mysql_fetch_array(mysql_query('SELECT * FROM `helloween` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `y` = "'.date('Y').'" LIMIT 1'));
												if(!isset($hwns['id'])) {
													mysql_query('INSERT INTO `helloween` (
														`y`,`uid`,`time`,`ico`,`x`
													) VALUES (
														"'.date('Y').'","'.$this->users[$j]['id'].'","'.time().'","0","1"
													)');
												}else{
													$hwns['x']++;
													mysql_query('UPDATE `helloween` SET `x` = "'.$hwns['x'].'" WHERE `id` = "'.$hwns['id'].'" LIMIT 1');
												}
											}
											
											//Выдаем предметы
											//addGlobalItems($uid,$itm,$eff,$ico,$exp,$cr,$ecr)
																		
											$this->addGlobalItems($this->users[$i]['id'],$this->users[$j]['id'],$mon['win_itm'],$mon['win_eff'],$mon['win_ico'],$mon['win_exp'],$mon['win_money1'],$mon['win_money2']);
											if( $this->stats[$j]['hpNow'] > 0 ) {
												$usrwin .= ', ';
												if( $this->users[$j]['align'] > 0 ) {
													$usrwin .= '<img width=12 height=15 src=http://img.likebk.com/i/align/align'.$this->users[$j]['align'].'.gif >';
												}
												if( $this->users[$j]['clan'] > 0 ) {
													$usrwin .= '<img width=24 height=15 src=http://img.likebk.com/i/clan/'.$this->users[$j]['clan'].'.gif >';
												}
												$usrwin .= '<b>'.$this->users[$j]['login'].'</b> ['.$this->users[$j]['level'].']<a target=_blank href=inf.php?'.$this->users[$j]['id'].' ><img width=12 height=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>';
											}
										}
										$j++;
									}
									if( $usrwin != '' ) {
										$usrwin = ltrim($usrwin,', ');
									}else{
										$usrwin = '<i>Команде героев</i>';
									}
									mysql_query('UPDATE `users` SET `room` = "303" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
									mysql_query('UPDATE `stats` SET `res_x` = "'.(time() + 60*$mon['time_restart']).'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
									mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("<font color=red>Внимание!</font> '.mysql_real_escape_string(str_replace('{b}','<b>'.$this->users[$i]['login'].'</b> ['.$this->users[$i]['level'].']<a target=_blank href=inf.php?'.$this->users[$i]['id'].' ><img width=12 height=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>', str_replace('{u}',$usrwin,$mon['win_text'])  )).' ","'.$this->users[$i]['city'].'","","6","1","'.time().'")');
									unset($usrwin);
								}
							}
						}
						$i++;
					}
				}
			}
			
			// выкидываем ботов из боя
			$i = 0; $botsi = 0;
			while($i<count($this->users))
			{				
				if($this->users[$i]['bot']==2) {
					$this->users[$i]['battle'] = 0;
					mysql_query('UPDATE `users` SET `battle` = "0" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
					mysql_query('UPDATE `stats` SET `zv` = "0",`team` = "0",`exp` = `exp` + `battle_exp`,`battle_exp` = "0",`timeGo` = "'.time().'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$this->users[$i]['id'].'" LIMIT 100');
				}elseif($this->users[$i]['bot']==1){
					$botsi++;
					mysql_query('DELETE FROM `users` WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `stats` WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$this->users[$i]['id'].'" LIMIT 100');
					mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$this->users[$i]['id'].'" LIMIT 100');
				}
				if($this->users[$i]['clone']>0 && $this->users[$i]['bot']>0 && isset($this->users[$this->uids[$this->users[$i]['clone']]]['id']) && $this->users[$this->uids[$this->users[$i]['clone']]]['team']!=$this->users[$i]['team']){
					//Добавляем что клон побежден
					if($this->users[$this->uids[$this->users[$i]['clone']]]['team']==$this->info['team_win']){
						$u->addAction(time(),'win_bot_clone','',$this->users[$i]['clone']);
					}elseif($this->info['team_win']==0){
						$u->addAction(time(),'nich_bot_clone','',$this->users[$i]['clone']);
					}else{
						$u->addAction(time(),'lose_bot_clone','',$this->users[$i]['clone']);
					}
				}elseif($this->users[$i]['bot']>0 && $this->users[$i]['bot_id']>0){
					//Добавляем что бота победили
					$j = 0;
					while($j<count($this->users)){
						if($this->users[$j]['bot']==0 && $this->users[$j]['team']!=$this->users[$i]['team']){
							
							if( $this->users[$i]['level'] < 10 ) {
								if( $this->users[$i]['bot_id'] == 157 || $this->users[$i]['bot_id'] == 355 ) {
									mysql_query('UPDATE `happy_quest` SET `q5` = `q5` + 1 WHERE `uid` = "'.$this->users[$j]['id'].'" LIMIT 1');
								}
							}elseif( $this->users[$i]['level'] == 10 ) {
								if( $this->users[$i]['bot_id'] == 288 || $this->users[$i]['bot_id'] == 109 ) {
									mysql_query('UPDATE `happy_quest` SET `q5` = `q5` + 1 WHERE `uid` = "'.$this->users[$j]['id'].'" LIMIT 1');
								}
							}else{
								if( $this->users[$i]['bot_id'] == 340 || $this->users[$i]['bot_id'] == 540 ) {
									mysql_query('UPDATE `happy_quest` SET `q5` = `q5` + 1 WHERE `uid` = "'.$this->users[$j]['id'].'" LIMIT 1');
								}
							}
							
							if($this->users[$j]['team']==$this->info['team_win']){
								$u->addAction(time(),'win_bot_'.$this->users[$i]['bot_id'],'',$this->users[$j]['id']);
								
								if($this->users[$i]['bot_id'] == 288) {
									mysql_query('UPDATE `achiev` SET `a16` = `a16` +1 WHERE `uid` = '.$this->users[$j]['id'].' AND `a16lvl` = 0 LIMIT 1');
								}elseif($this->users[$i]['bot_id'] == 700) {
									mysql_query('UPDATE `achiev` SET `a16` = `a16` +1 WHERE `uid` = '.$this->users[$j]['id'].' AND `a16lvl` = 1 LIMIT 1');
								}elseif($this->users[$i]['bot_id'] == 715 || $this->users[$i]['bot_id'] == 805) {
									mysql_query('UPDATE `achiev` SET `a16` = `a16` +1 WHERE `uid` = '.$this->users[$j]['id'].' AND `a16lvl` = 2 LIMIT 1');
								}
								
							}elseif($this->info['team_win']==0){
								$u->addAction(time(),'nich_bot_'.$this->users[$i]['bot_id'],'',$this->users[$j]['id']);
							}else{
								$u->addAction(time(),'lose_bot_'.$this->users[$i]['bot_id'],'',$this->users[$j]['id']);
							}
						}
						$j++;
					}
				}
				$i++;
			}
			$botss = array();
			if(true==true){				
				if($nl!=10){				
					//Из бота падают предметы
					if($this->info['dungeon']>0){
						
						$hptst = mysql_fetch_array(mysql_query('SELECT * FROM `happy_quest` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
						if( isset($hptst['id']) && $hptst['x'] == 7 ) {
							if( rand(0,100) < 5 ) {
								$tou = 0; //какому юзеру предназначено
								/* выделяем случайного юзера из команды */
								$itmz = array(
									8020 , 100
								);
								//
								$itmnm = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.$itmz[0].'" LIMIT 1'));
								$itmnm = $itmnm['name'];
												
								//$rtxt = 'У <b>'.$tbot2['login'].'</b> был предмет &quot;'.$itmnm.'&quot; и кто угодно может поднять его';
								//mysql_query("INSERT INTO `chat` (`dn`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`,`new`) VALUES ('".$this->info['dn_id']."','".$this->users[0]['city']."','".$this->users[0]['room']."','','','".$rtxt."','".time()."','6','0','1','1')");
												
								$ins = mysql_query('INSERT INTO `dungeon_items` (`dn`,`user`,`item_id`,`time`,`x`,`y`) VALUES (
								"'.$this->info['dn_id'].'",
								"'.$tou.'",
								"'.$itmz[0].'",
								"'.time().'",
								"'.$this->info['x'].'",
								"'.$this->info['y'].'")');
							}






						}
						
						if( rand(0,100) < 2 ) {
							$ins = mysql_query('INSERT INTO `dungeon_items` (`dn`,`user`,`item_id`,`time`,`x`,`y`) VALUES (
							"'.$this->info['dn_id'].'",
							"0",
							"8028",
							"'.time().'",
							"'.$this->info['x'].'",
							"'.$this->info['y'].'")');
						}
						
						if($this->info['team_win']==$u->info['team'] && $this->info['dungeon'] == 102){
							$j1 = mysql_fetch_array(mysql_query('SELECT * FROM `laba_obj` WHERE `type` = 2 AND `lib` = "'.$this->info['dn_id'].'" AND `x` = "'.$this->info['x'].'" AND `y` = "'.$this->info['y'].'" LIMIT 1'));
							if( isset($j1['id']) ) {
								mysql_query('DELETE FROM `laba_obj` WHERE `id` = "'.$j1['id'].'" LIMIT 1');
								//Выпадает шмотка
								mysql_query('INSERT INTO `laba_obj` (`use`,`lib`,`time`,`type`,`x`,`y`,`vars`) VALUES (
									"0","'.$j1['lib'].'","'.time().'","6","'.$j1['x'].'","'.$j1['y'].'","'.(0+$botsi).'"
								)');
							}
						} elseif($this->info['team_win']==$u->info['team']) {
							//выйграли люди, выкидываем предметы из мобов					
							$j1 = mysql_query('SELECT * FROM `dungeon_bots` WHERE `dn` = "'.$this->info['dn_id'].'" AND `for_dn` = "0" AND `x` = "'.$this->info['x'].'" AND `delete` = "0" AND `y`= "'.$this->info['y'].'" LIMIT 100');
							while($tbot = mysql_fetch_array($j1)) {
								$j2 = 0;
								while( $j2 < $tbot['colvo'] ) {
									//
									if( isset($tbot['id2']) ) {
										$tbot2 = mysql_fetch_array(mysql_query('SELECT * FROM `test_bot` WHERE `id` = "'.$tbot['id_bot'].'" LIMIT 1'));
										$itms = explode('|',$tbot2['p_items']);
										$tii = 0;
										while($tii<count($itms)){
											$itmz = explode('=',$itms[$tii]);
											if($itmz[0]>0) {
												if( isset($itmz[2]) && $itmz[2] != '' ) { // $itmz[2] == quest888 
													$questDrop = mysql_fetch_array(mysql_query('SELECT * FROM `actions` WHERE `vars` LIKE "%'.$itmz[2].'%" AND `vals` = "go" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
												}
												if( isset($questDrop['id']) ) { // Если квест есть, предмет имеет шанс выпасть
												} elseif( isset($itmz[2]) && $itmz[2] != '' ) $itmz[1]=0; // Если предмет квестовый, а квеста у игрока нет, то предмет выпадет с вероятностью 0
												unset($questDrop);
												
												//Добавляем этот предмет в зону Х и У
												if( $itmz[1] * 100000 >= rand(1,10000000) ) {
													$tou = 0; //какому юзеру предназначено
													/* выделяем случайного юзера из команды */
													$itmnm = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.$itmz[0].'" LIMIT 1'));
													$itmnm = $itmnm['name'];
													
													$rtxt = 'У <b>'.$tbot2['login'].'</b> был предмет &quot;'.$itmnm.'&quot; и кто угодно может поднять его';
													mysql_query("INSERT INTO `chat` (`dn`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`,`new`) VALUES ('".$this->info['dn_id']."','".$this->users[0]['city']."','".$this->users[0]['room']."','','','".$rtxt."','".time()."','6','0','1','1')");
													
													$ins = mysql_query('INSERT INTO `dungeon_items` (`dn`,`user`,`item_id`,`time`,`x`,`y`) VALUES (
													"'.$this->info['dn_id'].'",
													"'.$tou.'",
													"'.$itmz[0].'",
													"'.time().'",
													"'.$this->info['x'].'",
													"'.$this->info['y'].'")');
												}
											}
											$tii++;	
										}
									}
									$j2++;
								}
								//
								//$this->info['botx'] = $j2;
								$i = 0;
								while($i < count($this->users)){
									if($this->users[$i]['bot']==0){
										$arch = mysql_fetch_array(mysql_query('SELECT * FROM `achiev` WHERE `uid` = "'.$this->users[$i]['id'].'" LIMIT 1'));
										if(isset($arch['id'])) {
											if( $this->info['dungeon'] > 0 ) {
												//$arch['a5']++;
												$arch['a5'] += $j2;
											}
											mysql_query('UPDATE `achiev` SET `a1` = "'.$arch['a1'].'",`a2` = "'.$arch['a2'].'",`a5` = "'.$arch['a5'].'",`a6` = "'.$arch['a6'].'" WHERE `id` = "'.$arch['id'].'" LIMIT 1');
										}
									}
									$i++;
								}
								//Квест 1 сентября, 
								if( date('m') == 9 || date('m') == 8 ) {
									if(rand(0,1000) >= 30) {
										//Не выпало
									}elseif( $this->info['turnir'] == 0 && $this->info['inTurnir'] == 0 ) { 
										$tou = 0; //какому юзеру предназначено
										/* выделяем случайного юзера из команды */
										$itmz = array(
											rand(6745,6751) , 100
										);
										//
										$itmnm = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.$itmz[0].'" LIMIT 1'));
										$itmnm = $itmnm['name'];
														
										$rtxt = 'У <b>'.$tbot2['login'].'</b> был предмет &quot;'.$itmnm.'&quot; и кто угодно может поднять его';
										mysql_query("INSERT INTO `chat` (`dn`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`,`new`) VALUES ('".$this->info['dn_id']."','".$this->users[0]['city']."','".$this->users[0]['room']."','','','".$rtxt."','".time()."','6','0','1','1')");
														
										$ins = mysql_query('INSERT INTO `dungeon_items` (`dn`,`user`,`item_id`,`time`,`x`,`y`) VALUES (
										"'.$this->info['dn_id'].'",
										"'.$tou.'",
										"'.$itmz[0].'",
										"'.time().'",
										"'.$this->info['x'].'",
										"'.$this->info['y'].'")');
									}
								}
								//
							}
							# mysql_query('UPDATE `dungeon_bots` SET `delete` = "'.time().'" WHERE `dn` = "'.$this->info['dn_id'].'" AND `for_dn` = "0" AND `x` = "'.$this->info['x'].'" AND `y`= "'.$this->info['y'].'" AND `delete` = "0" ');
							mysql_query('UPDATE `dungeon_bots` SET `delete` = "'.time().'" WHERE `dn` = "'.$this->info['dn_id'].'" AND `for_dn` = "0" AND `inBattle` = '.$this->users[0]['battle'].' AND `delete` = "0" '); 
							
						}else{
							//выкидываем всех игроков в клетку RESTART
							$dnr = 1;
							if( $this->info['dungeon'] != 102 ) {
								mysql_query('UPDATE `dungeon_bots` SET `inBattle` = "0" WHERE `dn` = "'.$this->info['dn_id'].'" AND `for_dn` = "0" AND `x` = "'.$this->info['x'].'" AND `y`= "'.$this->info['y'].'"');
							}
						}
					}
				}
				
				
				$gm = array(); $gms = array();
				$bm = array(); $bms = array();
				
				//Квестовый раздел
					$i = 0;
					while($i < count($this->users)){
						if($this->users[$i]['bot']==0 && $this->users[$i]['id'] == $u->info['id']){
							$q->bfinuser($this->users[$i],$this->info['id'],$this->info['team_win']);
						}
						$i++;
					}
				//Квестовый раздел				
				
				//завершаем поединок
				$i = $this->uids[$u->info['id']];
				
				/*
				//Выходные летом и всегда +25% опыта
				if(round(date('m')) >= 5 && round(date('m')) < 9) {
					if(round(date('w')) == 0 || round(date('w')) == 6) {
						$this->stats[$i]['exp'] += 25;
					}
				//}*/
				
				$this->stats[$i]['exp'] += $this->expCoef;
																
				$this->stats[$i]['exp'] += $this->aBexp;
				
				if($this->stats[$i]['silver']>0) {
					$this->stats[$i]['exp'] += 5*$this->stats[$i]['silver'];
					if($this->stats[$i]['bonusexp'] > 1) { // Для покупки опыта (получает максимум)
						$this->stats[$i]['exp'] += 1000*$this->stats[$i]['bonusexp'];
					}
					//if($this->stats[$i]['speeden']>20) { // Для восстановления энергии (получает максимум)
						//$this->stats[$i]['enNow'] += $this->stats[$i]['speeden'];
						
					//$upd2 = mysql_query('UPDATE `stats` SET `enNow` = "'.$this->users[$i]['enNow'].'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');


					//}
				}
			if($this->info['dungeon'] == 0){
				//Эффект благословения, добавление опыта при победе 2%, при поражение и ничье 1%, длится два часа
				//чтение с бд  и создание поля в таблице для User
				global $magic;
				$resopit = $magic->addopit($this->users[$i]['id']);
				$efid = $resopit[0];
				$efopit = $resopit[1];
				if($efopit <= 100){
					$efopit1 = ($efopit + 2);
					$efopit2 = ($efopit + 1);
				}
				else{

					$efopit = 100;
					$efopit1 = $efopit;
					$efopit2 = $efopit;
				}
			}
			else{
				$efopit = 0;
			}
/*			if($this->stats[$i]['os4'] > 0){
				$efopit += $this->stats[$i]['os4'];
			}*/
			if($u->info['vip'] == 1){
				$efopit += 25;
			}elseif($u->info['vip'] == 2){
				$efopit += 50;
			}
				$act01 = 0;
				$premium = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$u->info['id'].'"'));
				if($premium['time_delete'] > time()){
					$efopit += $premium['addExp'];
				}
				//опыт, когда победа
				global $prc_btl1, $prc_btl2;
				// $prc_btl1 = (1 + $this->info['addExp']+$this->stats[$i]['exp']);
				$prc_btl1 = 100;
				$prc_btl2 = (rand(10,20));
				$vesna = $magic->Vesna($this->users[$i]['id']);
				$efopit += $vesna;
				if( $this->info['status'] > 0 ) {
					$efopit += $this->btlstatus[$this->info['tpbtlstatus']][$this->info['status']][1];
				}
				//$this->stats[$i]['exp'] += $this->stats[$i]['exp2'];
				$efopit += $this->stats[$i]['exp2'];
					
				/*Изменения базы опыта*/
					$op1_id1 = $this->users[$i]['battle_exp'];
					$this->users[$i]['battle_exp'] = round($this->users[$i]['battle_exp']+($this->users[$i]['battle_exp']/100*(0 + $efopit)));
				/*Удалить*/
					/*if($this->users[$i]['level'] < 8){
						$basopit = array('8'=>140, '7'=>250, '6'=>400, '5'=>500, '4'=>600, '3'=>1100, '2'=>1900, '1'=>3600);
						$lvl = (8 - $this->users[$i]['level']);
						$op1_id1 = $basopit[$lvl]; 
						$this->users[$i]['battle_exp'] = round($basopit[$lvl]+$this->users[$i]['battle_exp']+($this->users[$i]['battle_exp']/100*(100 + $efopit)));
					}
					else{
						$op1_id1 = $this->users[$i]['battle_exp'];
						if($this->info['razdel'] == 5 && $this->users[$i]['level'] == 10 && $this->info['dungeon'] == 0){
							$this->users[$i]['battle_exp'] = (round($this->users[$i]['battle_exp']+($this->users[$i]['battle_exp']/100*(0 + $efopit))))*2;	
						}elseif($this->info['razdel'] == 5 && $this->users[$i]['level'] == 11 && $this->info['dungeon'] == 0){
							$this->users[$i]['battle_exp'] = (round($this->users[$i]['battle_exp']+($this->users[$i]['battle_exp']/100*(0 + $efopit))))*3;	
						}else{
							$this->users[$i]['battle_exp'] = round($this->users[$i]['battle_exp']+($this->users[$i]['battle_exp']/100*(0 + $efopit)));
						}
						//$this->users[$i]['battle_exp'] = round($this->users[$i]['battle_exp']+($this->users[$i]['battle_exp']/100*($efopit + 1 + $this->info['addExp']+$this->stats[$i]['exp'])));
						//$this->users[$i]['battle_exp'] = round($this->users[$i]['battle_exp']+($this->users[$i]['battle_exp']/100*(1+$this->info['addExp']+$this->stats[$i]['exp'])));
					}*/
				/*Удалить*/
				if($this->users[$i]['dnow'] != 0 && $this->info['dungeon'] != 1  && $this->users[$i]['team']==$this->info['team_win']) {
					$dun_limitForLevel = array( 4 => 750, 5 => 1500, 6 => 3500, 7 => 8000, 8 => 25000, 9 => 50000, 10 => 75000, 11 => 125000, 12 => 250000, 13 => 500000, 14 => 750000 );
					// Максимум для каждого уровня. 
					
					if( $this->users[$i]['battle_exp'] > 0 ) {
						$dun_exp = array(); // Текущий лимит опыта игрока в подземельях.
						$rep = mysql_fetch_array(mysql_query('SELECT `dungeonexp`,`id` FROM `rep` WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1'));
						$rep = explode(',',$rep['dungeonexp']);
						foreach ($rep as $key=>$val) { 
							$val = explode('=',$val); // текущий лимит опыта в подземке 
							if( isset($val[0]) && isset($val[1]) && $val[0] !='' && $val[1] != 0 ) $dun_exp[(int)$val[0]] = (int)$val[1];
						}
						unset($rep);
					}
					
					if( !isset($dun_exp[$this->info['dungeon']]) ) $dun_exp[$this->info['dungeon']] = 0;
					
					if( !isset($dun_limitForLevel[(int)$this->users[$i]['level']]) ){ // Если лимит не задан, опыт не даем.
						$this->users[$i]['battle_exp'] = 0;
					} elseif(
						isset($dun_exp[$this->info['dungeon']]) &&
						$dun_exp[$this->info['dungeon']] >= $dun_limitForLevel[(int)$this->users[$i]['level']]
					) { // Если лимит уже достигнут, опыт не даем.
						$this->users[$i]['battle_exp'] = 0;
					} elseif(
						isset($dun_exp[$this->info['dungeon']]) &&
						$dun_limitForLevel[(int)$this->users[$i]['level']] > $dun_exp[$this->info['dungeon']]
					) { // Если текущая репутация не достигла лимита.
						if( ( $dun_exp[$this->info['dungeon']] + $this->users[$i]['battle_exp'] ) > $dun_limitForLevel[(int)$this->users[$i]['level']] ) {
							// Если опыта набрано достаточно, для достижения лимита.
							$this->users[$i]['battle_exp'] = abs($this->users[$i]['battle_exp'] - abs( $dun_limitForLevel[(int)$this->users[$i]['level']] - ( $this->users[$i]['battle_exp'] + $dun_exp[$this->info['dungeon']] ) ));
							$dun_exp[$this->info['dungeon']] += $this->users[$i]['battle_exp']; 
						} elseif( $dun_limitForLevel[(int)$this->users[$i]['level']] > ( $dun_exp[$this->info['dungeon']] + $this->users[$i]['battle_exp'] ) ) {
							// Если опыта недостаточно, для достижения лимита.
							$this->users[$i]['battle_exp'] = $this->users[$i]['battle_exp'];
							$dun_exp[$this->info['dungeon']] += $this->users[$i]['battle_exp']; 
						} else {
							$this->users[$i]['battle_exp'] = 0;
						}
					} else { // В любой непонятной ситуцаии.
						$this->users[$i]['battle_exp'] = 0;
					}
					
					
					if( $this->users[$i]['battle_exp'] > 0 && isset($dun_exp[$this->info['dungeon']]) && $dun_exp[$this->info['dungeon']] > 0 ){
						$dunexp = array();
						foreach ($dun_exp as $key=>$val) {
							$dunexp[$key] = $key.'='.$val; // текущий лимит опыта в подземке
						}
						$dun_exp = implode(",",$dunexp);
						mysql_query('UPDATE `rep` SET `dungeonexp` = "'.$dun_exp.'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
						unset($dunexp,$dun_exp);
					}
					unset($dun_limitForLevel);
				}
				//опыт, когда поражение или ничья, рандомно от 10-20%
				$res = 0;
				/*$prc_pr = (rand(10,20));*/
				
				if( $this->info['dungeon'] == 0 ) {
					//mysql_query('START TRANSACTION');
					//mysql_query('INSERT INTO `battle_lock` (`uid`,`btl`,`ekr`,`exp`,`time`) VALUES ("'.$this->users[$i]['id'].'","'.$this->info['id'].'","0","0","'.time().'")');
					//mysql_query('COMMIT');
				}
				
				if($this->info['team_win']==0){
					$res = 0;
					//ничья
						if($this->users[$i]['level']<=1){
							$this->users[$i]['battle_exp'] = floor($this->users[$i]['battle_exp']*0.33);
						}else{
							//опыт, когда ничья
							$res = 1;
							//$this->users[$i]['battle_exp'] = 0;
							//$this->users[$i]['battle_exp'] = round($this->users[$i]['battle_exp']+($this->users[$i]['battle_exp']/100*$prc_pr));
							//$this->users[$i]['battle_exp'] = round($op1_id1/100*$prc_pr);
							$this->users[$i]['battle_exp'] = round($op1_id1/100*$prc_btl2);
						}
                        //if( $this->info['dungeon'] == 0 ) {
						//	mysql_query('UPDATE `battle_lock` SET `type` = "3" WHERE `uid` = "'.$this->users[$i]['id'].'" AND `btl` = "'.$this->info['id'].'"');
						//}else{
						//	$this->users[$i]['nich'] += 1;
						//}
						$mess = 'Ничья.';
				}elseif($this->users[$i]['team']==$this->info['team_win']){
					//выйграл
						$gm[$i] = $this->info['money'];
                        
                        $gms[$i] = $this->info['money3'];
                        
                        //if( $this->info['dungeon'] == 0 ) {
						//	mysql_query('UPDATE `battle_lock` SET `type` = "1" WHERE `uid` = "'.$this->users[$i]['id'].'" AND `btl` = "'.$this->info['id'].'"');
						//}else{
						//	$this->users[$i]['win'] += 1;
						//}
						if( $this->info['priz'] == 1 ) {
							$this->users[$i]['win_p'] += 1;
						}
						$act01 = 1;
						$mess = 'Победа.';
						
						if( $this->info['razdel'] == 1 ) {
							mysql_query('UPDATE `happy_quest` SET `q2` = `q2` + 1 WHERE `uid` = "'.$this->users[$i]['id'].'" LIMIT 1');
						}
						if( $this->info['razdel'] == 5 ) {
							mysql_query('UPDATE `happy_quest` SET `q4_2` = `q4_2` + 1 WHERE `uid` = "'.$this->users[$i]['id'].'" LIMIT 1');
						}
						if( $this->info['type'] == 139 ) {
							mysql_query('UPDATE `happy_quest` SET `q9` = `q9` + 1 WHERE `uid` = "'.$this->users[$i]['id'].'" LIMIT 1');
						}
						
						if($this->info['status'] > 0) {
							mysql_query('UPDATE `achiev` SET `a19` = `a19` + 1 WHERE `uid` = '.$this->users[$i]['id'].' AND `a19lvl` < 3 LIMIT 1');
						}
						
				}else{
					$res = 0;
					//проиграл
						if($this->users[$i]['level']<=1){
							$this->users[$i]['battle_exp'] = ceil($this->users[$i]['battle_exp']*0.23);
						}else{
							//опыт, когда поражение
							$res = 1;
							//$this->users[$i]['battle_exp'] = 0;
							//$this->users[$i]['battle_exp'] = round($this->users[$i]['battle_exp']+($this->users[$i]['battle_exp']/100*$prc_pr));
							//$this->users[$i]['battle_exp'] = round($op1_id1/100*$prc_pr);
							$this->users[$i]['battle_exp'] = round($op1_id1/100*$prc_btl2);

						}
						$bm[$i] = $this->info['money'];
                        
                        $bms[$i] = $this->info['money3'];
                        //if( $this->info['dungeon'] == 0 ) {
						//	mysql_query('UPDATE `battle_lock` SET `type` = "-1" WHERE `uid` = "'.$this->users[$i]['id'].'" AND `btl` = "'.$this->info['id'].'"');
						//}else{
						//	$this->users[$i]['lose'] += 1;
						//}
						if( $this->info['priz'] == 1 ) {
							$this->users[$i]['lose_p'] += 1;
						}
						$act01 = 2;
						$mess = 'Поражение.';
				}
				if( $this->info['razdel'] == 5 ) {
					mysql_query('UPDATE `happy_quest` SET `q4` = `q4` + 1 WHERE `uid` = "'.$this->users[$i]['id'].'" LIMIT 1');
				}
				//
				if($this->users[$i]['team']==$this->info['team_win']){
					$arch = mysql_fetch_array(mysql_query('SELECT * FROM `achiev` WHERE `uid` = "'.$this->users[$i]['id'].'" LIMIT 1'));
					if(isset($arch['id'])) {
						if( $u->info['room'] == 9 ) {
							$arch['a11']++;
						}
						if( $this->info['razdel'] == 1 || $this->info['razdel'] == 2 ) {
							$arch['a1']++;
						}
						if( $this->info['razdel'] == 5 ) {
							$arch['a6']++;
						}
						$arch['a2']++;
						//if( $this->info['dungeon'] > 0 ) {
							//$arch['a5']++;
						//}
						mysql_query('UPDATE `achiev` SET `a1` = "'.$arch['a1'].'",`a11` = "'.$arch['a11'].'",`a2` = "'.$arch['a2'].'",`a5` = "'.$arch['a5'].'",`a6` = "'.$arch['a6'].'" WHERE `id` = "'.$arch['id'].'" LIMIT 1');
					}
				}
				//
				//Рассчитываем кол-во выигрышных сумм и кто сколько получил (для екр.)
				if( $this->info['money3'] > 0 && isset($gms[$i]) ) {
					$mn = array(
						'l'  => 0, //сколько проигравших игроков
						'w'  => 0, //сколько выигрывших игроков
						'm' => 0   //сумма выигрыша (общая)
					);
					if( $act01 == 1 ) {
						$mn['l'] = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `battle_users` WHERE `battle` = "'.$this->info['id'].'" AND `team` != "'.$this->users[$i]['team'].'" LIMIT 1'));
						$mn['l'] = $mn['l'][0];
						$mn['w'] = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `battle_users` WHERE `battle` = "'.$this->info['id'].'" AND `team` = "'.$this->users[$i]['team'].'" LIMIT 1'));
						$mn['w'] = $mn['w'][0];
						$mn['m'] = round(($mn['l']*$this->info['money3'])/100*87,2);
						$gms[$i] = round(($mn['m']/$mn['w']),2);
					}
				}
				//
				//заносим данные в БД
				//Поломка предметов
					if($act01==1){
						//победа
						if( $this->users[$i]['dnow'] == 0 ) {
							$lom = (rand(0,5))/100;
						}
					}elseif($act01==2){
						//поражение
						$lom = (rand(25,50))/100;
						$lom = round($lom*2.75,2);
						$nlom = array(0=>rand(0,18),1=>rand(0,18),2=>rand(0,18),3=>rand(0,18));
						mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW`+'.$lom.' WHERE `inOdet` < "18" AND `inOdet` > "0" AND `uid` = "'.$this->users[$i]['id'].'" AND `inOdet`!="0" AND `inOdet`!='.$nlom[0].' AND `inOdet`!='.$nlom[1].' AND `inOdet`!='.$nlom[2].' AND `inOdet`!='.$nlom[3].' LIMIT 18');
					}else{
						//ничья
						$lom = (rand(5,25))/100;
						$lom = round($lom*2.75,2);
						$nlom = array(0=>rand(0,18),1=>rand(0,18),2=>rand(0,18),3=>rand(0,18));
						mysql_query('UPDATE `items_users` SET `iznosNOW` = `iznosNOW`+'.$lom.' WHERE `inOdet` < "18" AND `inOdet` > "0" AND `uid` = "'.$this->users[$i]['id'].'" AND `inOdet`!="0" AND `inOdet`!='.$nlom[0].' AND `inOdet`!='.$nlom[1].' AND `inOdet`!='.$nlom[2].' AND `inOdet`!='.$nlom[3].' LIMIT 18');
					}

					$prc = '';						
					if($this->users[$i]['align']==2){
						$this->users[$i]['battle_exp'] = floor($this->users[$i]['battle_exp']/2);
					}
					if($this->users[$i]['animal']>0){
						$ulan = $u->testAction('`uid` = "'.$this->users[$i]['id'].'" AND `vars` = "animal_use'.$this->info['id'].'" LIMIT 1',1);
						if(isset($ulan['id']) && $this->users[$i]['team']==$this->info['team_win']){
							$a004 = mysql_fetch_array(mysql_query('SELECT `max_exp` FROM `users_animal` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `id` = "'.$this->users[$i]['animal'].'" AND `pet_in_cage` = "0" AND `delete` = "0" LIMIT 1'));
							//33% от опыта переходит боту, но не более максимума
							$aexp = (round($this->users[$i]['battle_exp']/100*33));
							if($aexp > $a004['max_exp'])
							{
								$aexp = $a004['max_exp'];
							}
							unset($ulan);
							$upd = mysql_query('UPDATE `users_animal` SET `exp` = `exp` + '.$aexp.' WHERE `id` = "'.$this->users[$i]['animal'].'" AND `level` < '.$this->users[$i]['level'].' LIMIT 1');
							if($upd) {
								$this->users[$i]['battle_exp'] = round($this->users[$i]['battle_exp']/100*67); 
								$this->info['addExp'] -= 33.333;
							}
						}
					}
					if($this->users[$i]['align']==2 || $this->users[$i]['haos'] > time()) {
						$this->stats[$i]['exp'] = -($this->info['addExp']+50);
					}
					//Записываем тут проценты
					// if($this->info['addExp']+$this->stats[$i]['exp']!=0)
					// {
						$prcok = 0;
						if($res == 0){
							//$prc = ' ('.($efopit+100+$this->info['addExp']+$this->stats[$i]['exp']).'%)';
							$prc = ' ('.(100 + $efopit).'%)';
							$prcok = 100+$efopit;
						}
						else{
							// $prc = ' ('.$prc_pr.'%)';
							 $prc = ' ('.$prc_btl2.'%)';
							 $prcok = $prc_btl2;
						}
					// }
					// if($this->info['money']>0) {
					// 	if(isset($gm[$i])) {
					// 		$prc .= ' Вы выйграли <b>'.$gm[$i].' кр.</b> за этот бой.';
					// 		$u->addDelo(4,$this->users[$i]['id'],'&quot;<font color="olive">System.battle</font>&quot;: Персонаж выйграл <b>'.$gm[$i].' кр.</b> (В бою №'.$this->info['id'].').',time(),$this->info['city'],'System.battle',0,0);
					// 		$this->users[$i]['money'] += $gm[$i];
					// 	} elseif(isset($bm[$i])) {
					// 		$prc .= ' Вы заплатили <b>'.$bm[$i].' кр.</b> за этот бой.';
					// 		$u->addDelo(4,$this->users[$i]['id'],'&quot;<font color="olive">System.battle</font>&quot;: Персонаж <i>проиграл</i> <b>'.$gm[$i].' кр.</b> (В бою №'.$this->info['id'].').',time(),$this->info['city'],'System.battle',0,0);
					// 		$this->users[$i]['money'] -= $bm[$i];
					// 	}
					// }
					// if($this->info['money3'] > 0) {
					// 	if(isset($gms[$i])) {
					// 		$prc .= ' Вы выйграли <b>'.$gms[$i].' $.</b> за этот бой.';
					// 		$u->addDelo(4,$this->users[$i]['id'],'&quot;<font color="olive">System.battle</font>&quot;: Персонаж выйграл <b>'.$gms[$i].' $.</b> (В бою №'.$this->info['id'].').',time(),$this->info['city'],'System.battle',0,0);
					// 		$this->users[$i]['money3'] += $gms[$i];
					// 		mysql_query('UPDATE `users` SET `money3` = `money3` + "'.$gms[$i].'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
					// 	} elseif(isset($bms[$i])) {
					// 		$prc .= ' Вы заплатили <b>'.$bms[$i].' $.</b> за этот бой.';
					// 		$u->addDelo(4,$this->users[$i]['id'],'&quot;<font color="olive">System.battle</font>&quot;: Персонаж <i>проиграл</i> <b>'.$gms[$i].' $.</b> (В бою №'.$this->info['id'].').',time(),$this->info['city'],'System.battle',0,0);
					// 		$this->users[$i]['money3'] -= $bms[$i];
					// 		mysql_query('UPDATE `users` SET `money3` = `money3` - "'.$bms[$i].'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
					// 	}
					// }

					/*if($this->info['kingfight']==1) {
						//Призовой поединок
						if($this->info['team_win'] == 0) {
							
						}elseif($this->users[$i]['team'] == $this->info['team_win']){
							$bnks = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$this->users[$i]['id'].'" ORDER BY `useNow` DESC LIMIT 1'));
							if(isset($bnks['id'])) {
								$bnks['msn'] = round($this->user[$i]['level']/50,2);
								$bnks['msn'] = 0.15;
								mysql_query('UPDATE `bank` SET `money2` = `money2` + "'.mysql_real_escape_string($bnks['msn']).'" WHERE `id` = "'.$bnks['id'].'" LIMIT 1');
								$prc .= ' <img src=http://img.likebk.com/king.gif width=20 height=20> Вы получили приз: '.$bnks['msn'].' екр., банк №'.$bnks['id'].'';
								
							}
							unset($bnks);
						}
					}*/
										
					if( $this->users[$i]['team']==$this->info['team_win']) {
						if( $this->users[$i]['twink'] > 0 ) {
							//Добавляем воинственность
							if( $this->info['dungeon'] == 0 ) {
								if( $this->users[$i]['battle_exp'] >= 0 ) {
									$prc .= ' Вы получили &quot;Жетон Новичка&quot; за этот бой';
									$u->addItem(9979,$this->users[$i]['id']);
								}
							}
						}
					}
					
					//if(100+$this->info['addExp']+$this->stats[$i]['exp'] > 1000) {
					//	$prc .= ' (Великая Битва)';
					//}
					
					if( $this->info['status'] > 0 ) {
						$prc .= ' ('.$this->btlstatus[$this->info['tpbtlstatus']][$this->info['status']][0].')';
					}
					
					if($this->info['dungeon'] == 1 && $this->users[$i]['team']==$this->info['team_win']) {
						//канализация лимит
						$rep = mysql_fetch_array(mysql_query('SELECT `dl1`,`id` FROM `rep` WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1'));
						if($rep['dl'.$this->info['dungeon']] > 0) {
							$this->users[$i]['battle_exp'] += ceil(500/$this->users[$i]['level']);
							if($rep['dl'.$this->info['dungeon']] > $this->users[$i]['battle_exp']) {
								$rep['dl'.$this->info['dungeon']] -= $this->users[$i]['battle_exp'];
							}else{
								$this->users[$i]['battle_exp'] = $rep['dl'.$this->info['dungeon']];
								$rep['dl'.$this->info['dungeon']] = 0;
							}
							mysql_query('UPDATE `rep` SET `dl'.$this->info['dungeon'].'` = "'.$rep['dl'.$this->info['dungeon']].'" WHERE `id` = "'.$rep['id'].'" LIMIT 1');
						}else{
							$this->users[$i]['battle_exp'] = 0;
						}
					}
					
					if($this->users[$i]['battle_exp'] < 1) {
						$this->users[$i]['battle_exp'] = 0;
					}
					
					if($this->users[$i]['battle_exp'] < 1 && $this->users[$i]['twink'] == 0) {
						if( $this->info['money'] == 0 && $this->info['money3'] == 0 && $this->info['kingfight'] == 0 ) {
							$prc = '';
						}
					}
					
					if($this->user[$i]['host_reg'] == 'real_bot_user') {
						$this->users[$i]['battle_exp'] = round($this->users[$i]['battle_exp']/3);
					}
					$yronn = floor($this->users[$i]['battle_yron']);

					//Хеллоуин
					if( $this->users[$i]['bot'] == 0 && $this->info['time_over'] > 0 ) {
						if( date('d.m') == '30.10' || date('d.m') == '31.10' || (date('m') == 11 && date('d') < 14) ) {
							if( $this->info['razdel'] == 5 && isset($this->users[$i]['id']) && $this->users[$i]['login'] != '' ) {
								if(isset($this->users[$i]['tkw2'])) {
									
								}elseif( ( rand(0,100) < 80 && $this->info['team_win'] == $this->users[$i]['team'] ) || ( rand(0,100) < 10 && $this->info['team_win'] != $this->users[$i]['team'] )  ) {
									//
									$hlw = $u->addItem(6807, $this->users[$i]['id'], 'nosale=1');
									//
									mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES (
									" Вы получили предмет: Кровавая Тыква (х1)",
									"'.$this->users[$i]['city'].'","'.$this->users[$i]['login'].'","6","1","'.time().'")');
									$this->users[$i]['tkw2']++;
								}
							}
						}
					}

					$lime = array(
						12 => 300000,
						13 => 400000
					);
					if( $this->info['status'] > 0 ) {
						$lime[12] += $this->btlstatus[$this->info['tpbtlstatus']][$this->info['status']][2];
					}
					if( $this->info['status'] >= 4 && $this->info['razdel'] == 0 ) {
						//без лимитов опыта
					}else{
						if( $this->info['status'] > 0 ) {
							if( isset($lime[$this->users[$i]['level']]) && $lime[$this->users[$i]['level']]*2 < $this->users[$i]['battle_exp']) {
								$this->users[$i]['battle_exp'] = $lime[$this->users[$i]['level']]*2;
							}
						}else{
							if( isset($lime[$this->users[$i]['level']]) && $lime[$this->users[$i]['level']] < $this->users[$i]['battle_exp']) {
								$this->users[$i]['battle_exp'] = $lime[$this->users[$i]['level']];
							}
						}
					}

					$this->users[$i]['battle_text'] = 'Бой закончен. '.$mess.' Всего вами нанесено урона: <b>'.$yronn.' HP</b>. Получено опыта: <b>'.(0+$this->users[$i]['battle_exp']).'</b>'.$prc.'.'; //stats
					//
					mysql_query('UPDATE `battle_finish_new` SET 
					
						`exp` = "'.$this->users[$i]['battle_exp'].'" ,
						`dmg` = "'.$yronn.'" ,
						`proc` = "'.$prcok.'"
					
					WHERE `uid` = "'.$this->users[$i]['id'].'" AND `battle` = "'.$this->info['id'].'" LIMIT 1');
					//
					$this->users[$i]['last_b'] = $this->info['id']; //stats
					$this->users[$i]['last_a'] = $act01;
					$this->users[$i]['battle'] = -1; //users
					$this->users[$i]['battle_yron'] = 0; //stats
						
					//if( $this->info['dungeon'] == 0 ) {
					//	mysql_query('UPDATE `battle_lock` SET `exp` = "'.$this->users[$i]['battle_exp'].'" WHERE `uid` = "'.$this->users[$i]['id'].'" AND `btl` = "'.$this->info['id'].'"');
					//}else{						
						//$this->users[$i]['exp']  += $this->users[$i]['battle_exp']; //users
					//}
					
					/*if($this->stats[$i]['speeden']>2) { // Для восстановления энергии (получает максимум)
						$this->users[$i]['enNow']+= $this->stats[$i]['enNow']; //users
						$upd2 = mysql_query('UPDATE `stats` SET `enNow` = "'.$this->users[$i]['enNow'].'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
					}*/
					//Добавляем клан опыт (Все кроме пещер)
					
					if($this->users[$i]['clan'] > 0) {
						$cpr = 1;
						if($this->info['typeBattle'] == 9) {
							$cpr = 25;
						}elseif($this->info['typeBattle'] == 50) {
							$cpr = 65;
						}
						mysql_query('UPDATE `clan` SET `exp` = `exp` + "'.round($this->users[$i]['battle_exp']/100*$cpr).'" WHERE `id` = "'.$this->users[$i]['clan'].'" LIMIT 1');
					}
					
					$this->users[$i]['battle_exp'] = 0; //stats
					
					if($this->users[$i]['team']==$this->info['team_win']) {
						mysql_query('UPDATE 
						
						`rep` SET `n_capitalcity` = `n_capitalcity` + '.$this->users[$i]['bn_capitalcity'].' ,
						`n_demonscity` = `n_demonscity` + '.$this->users[$i]['bn_demonscity'].' ,
						`n_demonscity` = `n_demonscity` + '.$this->users[$i]['bn_suncity'].'
						
						 WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
					}
					
					//репутация 
					$this->users[$i]['bn_demonscity'] = 0;
					$this->users[$i]['bn_capitalcity'] = 0;
					$this->users[$i]['bn_suncity'] = 0;
				//завершение эффектов с финишем
					$spe = mysql_query('SELECT * FROM `eff_users` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `file_finish` != "" AND `v1` = "priem" LIMIT 30');
					while($ple = mysql_fetch_array($spe)) {
						if(file_exists('../../_incl_data/class/priems/'.$ple['file_finish'].'.php'))	{
							require('../../_incl_data/class/priems/'.$ple['file_finish'].'.php');
						}
					}
				//обновляем данные
					mysql_query('DELETE FROM `eff_users` WHERE `v1` = "priem" AND `uid` = "'.$this->users[$i]['id'].'" LIMIT 30');
					if($dnr==1){
						if( $this->users[$i]['room'] == 370 ) {
							$dies = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `dungeon_actions` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `dn` = "'.$this->users[$i]['dnow'].'" AND `vars` = "dielaba" LIMIT 1'));
							$dies = $dies[0];
							mysql_query('INSERT INTO `dungeon_actions` (`dn`,`uid`,`x`,`y`,`time`,`vars`,`vals`) VALUES (
								"'.$this->users[$i]['dnow'].'","'.$this->users[$i]['id'].'","'.$this->users[$i]['x'].'","'.$this->users[$i]['y'].'","'.time().'","dielaba",""
							)');
						}else{
							$dies = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `dungeon_actions` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `dn` = "'.$this->users[$i]['dnow'].'" AND `vars` = "die" LIMIT 1'));
							$dies = $dies[0];
							mysql_query('INSERT INTO `dungeon_actions` (`dn`,`uid`,`x`,`y`,`time`,`vars`,`vals`) VALUES (
								"'.$this->users[$i]['dnow'].'","'.$this->users[$i]['id'].'","'.$this->users[$i]['x'].'","'.$this->users[$i]['y'].'","'.time().'","die",""
							)');
						}
						if( $dies < 2 || $this->info['dungeon'] == 15 ) {
								//
								$tshbn = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `delete` = 0 AND `item_id` = "4910" LIMIT 1'));								
								if(isset($tshbn['id'])) {
									//выбрасываем шайбу
									mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$tshbn['id'].'" LIMIT 1');
									//
									mysql_query('INSERT INTO `dungeon_obj` (
										`name`,`dn`,`x`,`y`,`img`,`delete`,`action`,`for_dn`,
										`type`,`w`,`h`,`s`,`s2`,`os1`,`os2`,`os3`,`os4`,`type2`,`top`,`left`,`date`
									) VALUES (
										"Шайба","'.$this->info['dn_id'].'","'.$this->users[$i]['x'].'","'.$this->users[$i]['y'].'","shaiba.png","0","fileact:15/shaiba","0",
										"0","120","220","0","0","5","8","12","0","0","0","0","{use:\'takeit\',rt1:69,rl1:-47,rt2:74,rl2:126,rt3:76,rl3:140,rt4:80,rl4:150}"
									)');
									//
								}
								//телепортируем в рестарт (координата 0х0)
								$this->users[$i]['x'] = $this->users[$i]['res_x'];
								$this->users[$i]['y'] = $this->users[$i]['res_y'];
								$this->users[$i]['s'] = $this->users[$i]['res_s'];
								$r_n = mysql_fetch_array(mysql_query('SELECT `name` FROM `room` WHERE `id` = "'.(int)$this->users[$i]['room'].'" LIMIT 1'));
								if( $this->users[$i]['room'] == 370 ) {
									if( $this->users[$i]['sex'] == 0 ) {
										$rtxt = '<b>'.$this->users[$i]['login'].'</b> трагически погиб и находится в начале лабиринта';
									}else{
										$rtxt = '<b>'.$this->users[$i]['login'].'</b> трагически погибла и находится в начале лабиринта';
									}
								}else{
									if( $this->users[$i]['sex'] == 0 ) {
										$rtxt = '<b>'.$this->users[$i]['login'].'</b> трагически погиб и находится в комнате &quot;'.$r_n['name'].'&quot;';
									}else{
										$rtxt = '<b>'.$this->users[$i]['login'].'</b> трагически погибла и находится в комнате &quot;'.$r_n['name'].'&quot;';
									}
								}
						}elseif( $this->info['dungeon'] == 102 ) {
							$nld = '';
							$lab = mysql_fetch_array(mysql_query('SELECT `id`,`users` FROM `laba_now` WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1'));
							if( $lab['users'] < 2 ) {
								//Удаляем подземелье
								mysql_query('DELETE FROM `laba_now` WHERE `id` = "'.$lab['id'].'" LIMIT 1');
								mysql_query('DELETE FROM `laba_map` WHERE `id` = "'.$lab['id'].'" LIMIT 1');
								mysql_query('DELETE FROM `laba_obj` WHERE `lib` = "'.$lab['id'].'"');
								mysql_query('DELETE FROM `laba_act` WHERE `lib` = "'.$lab['id'].'"');
								mysql_query('DELETE FROM `laba_itm` WHERE `lib` = "'.$lab['id'].'"');
							}else{
								$lab['users']--;
								mysql_query('UPDATE `laba_now` SET `users` = "'.$lab['users'].'" WHERE `id` = "'.$lab['id'].'" LIMIT 1');
							}
							mysql_query('UPDATE `stats` SET `dnow` = "0" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
							mysql_query('UPDATE `users` SET `room` = "369" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
							//удаляем все предметы которые пропадают после выхода из пещеры
							mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$this->users[$i]['id'].'" AND `delete` < 1234567890 AND `inShop` = "0" AND (`dn_delete` = "1" OR `data` LIKE "%fromlaba=1%")');
							if( $this->users[$i]['login'] != '' ) {
								mysql_query('DELETE FROM `eff_users` WHERE `uid` = '.$this->users[$i]['id'].' AND `data` LIKE "%dn_delete=1%"');
								if( $this->users[$i]['sex'] == 0 ) {
									$rtxt = '<b>'.$this->users[$i]['login'].'</b> трагически погиб без права на воскрешение и покидает подземелье'.$nld;
								}else{
									$rtxt = '<b>'.$this->users[$i]['login'].'</b> трагически погибла без права на воскрешение и покидает подземелье'.$nld;
								}
							}
						}else{
							$tinf = mysql_fetch_array(mysql_query('SELECT `uid` FROM `dungeon_now` WHERE `id` = "'.$this->info['dn_id'].'" LIMIT 1'));
							$nld = '';
							if( $tinf['uid'] == $this->users[$i]['id'] ) {
								$tinf = mysql_fetch_array(mysql_query('SELECT `id` FROM `stats` WHERE `dnow` = "'.$this->info['dn_id'].'" AND `hpNow` >= 1 LIMIT 1'));
								if( isset($tinf['id']) ) {
									$tinf = mysql_fetch_array(mysql_query('SELECT `id`,`login` FROM `users` WHERE `id` = "'.$tinf['id'].'" LIMIT 1'));
									$nld .= ', новым лидером становится &quot;'.$tinf['login'].'&quot;';
									mysql_query('UPDATE `dungeon_now` SET `uid` = "'.$tinf['id'].'" WHERE `id` = "'.$this->info['dn_id'].'" LIMIT 1');
								}
							}
                            $rooms = array(374 => 372, 189 => 188, 360 => 354, 19 => 293, 315 => 275, 305 => 18, 423 => 422, 201 => 200, 426 => 425, 427 => 425);
                            $n_rm = $rooms[$this->users[$i]['room']];
							mysql_query('UPDATE `stats` SET `dnow` = "0" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
							mysql_query('UPDATE `users` SET `room` = "'.$n_rm.'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
							//удаляем все предметы которые пропадают после выхода из пещеры
							mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$this->users[$i]['id'].'" AND `dn_delete` = "1" LIMIT 1000');
							mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = "1189" OR `item_id` = "4447" OR `item_id` = "1174") LIMIT 1000');
                            if( $this->users[$i]['sex'] == 0 ) {
								$rtxt = '<b>'.$this->users[$i]['login'].'</b> трагически погиб без права на воскрешение и покидает подземелье'.$nld;
							}else{
								$rtxt = '<b>'.$this->users[$i]['login'].'</b> трагически погибла без права на воскрешение и покидает подземелье'.$nld;
							}
						}
						if( $rtxt != '' ) {
							mysql_query("INSERT INTO `chat` (`dn`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`,`new`) VALUES ('".$this->info['dn_id']."','".$this->users[$i]['city']."','".$this->users[$i]['room']."','','','".$rtxt."','".time()."','6','0','1','1')");
						}
					}
					
					mysql_query('UPDATE `users` SET `login2` = "" WHERE `battle` = "'.$this->info['id'].'"');
					$upd  = mysql_query('UPDATE `users` SET `login2` = "", `money` = "'.$this->users[$i]['money'].'"
					,`win` = "'.$this->users[$i]['win'].'",`lose` = "'.$this->users[$i]['lose'].'"
					,`win_p` = "'.$this->users[$i]['win_p'].'",`lose_p` = "'.$this->users[$i]['lose_p'].'"
					,`nich` = "'.$this->users[$i]['nich'].'",`battle` = "-1" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
					
					if( $u->info['id'] == $this->users[$i]['id'] ) {
						$u->info['battle_text'] = $this->users[$i]['battle_text'];
					}
					
					$upd2 = mysql_query('UPDATE `stats` SET `bn_capitalcity` = 0,`bn_demonscity` = 0,`smena` = 3,`tactic7` = "-100",`x`="'.$this->users[$i]['x'].'",`y`="'.$this->users[$i]['y'].'",`priems_z`="0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0",`last_pr`="0",`tactic1`="0",`tactic2`="0",`tactic3`="0",`tactic4`="0",`tactic5`="0",`tactic6`="0.00000000",`tactic7`="10",`exp` = "'.$this->users[$i]['exp'].'",`battle_exp` = "'.$this->users[$i]['battle_exp'].'",`battle_text` = "'.$this->users[$i]['battle_text'].'",`battle_yron` = "0",`enemy` = "0",`last_b`="'.$this->info['id'].'",`regHP` = "'.time().'",`regMP` = "'.time().'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
				
				//Запись опыта и процентов в статистику для игроков
				//mysql_query('UPDATE `battle_users` SET `exp_btl` = "'.$this->users[$i]['battle_exp'].'", `prc_btl` = "'.$prc_btl.'" WHERE `uid` = "'.$this->users[$i]['id'].'" AND `battle` = "'.$this->info['id'].'"');
				mysql_query('UPDATE `battle_users` SET `plus` = "1", `finish` = "1" WHERE `uid` = "'.$this->users[$i]['id'].'" AND `battle` = "'.$this->info['id'].'"');
				$txt_ekr = '';
				$btl = mysql_query('SELECT * FROM `battle_users` WHERE `battle` = "'.$this->info['id'].'"');
				while($ress = mysql_fetch_array($btl)){
					if($ress['prc_btl'] == "0"){
						if($this->info['dungeon'] == 0){
							$resopit = $magic->addopit($ress['uid']);
							$efid = $resopit[0];
							$efopit = $resopit[1];
							if($efopit <= 100){
								$efopit1 = ($efopit + 2);
								$efopit2 = ($efopit + 1);
							}else{
								$efopit = 100;
								$efopit1 = $efopit;
								$efopit2 = $efopit;
							}
						}else{
							$efopit = 0;
						}

						//$efopit += $this->stats[$this->uids[$ress['uid']]]['exp2'];

/*				if($this->stats[$i]['os4'] > 0){
					$efopit += $this->stats[$i]['os4'];
				}*/
						$vips = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$ress['uid'].'" AND `vip` > 0 '));
						if(isset($vips['id'])){
							if($vips['vip'] == 1){
								$efopit += 25;
							}elseif($vips['vip'] == 2){
								$efopit += 50;
							}
						}
						$premium = mysql_fetch_array(mysql_query('SELECT * FROM `premium` WHERE `uid` = "'.$ress['uid'].'"'));
						if($premium['time_delete'] > time()){
							$efopit += $premium['addExp'];
						}
						$efopit += $vesna;
						/*Изменения базы опыта*/
							$bas_exp = $ress['exp_btl'];
							$ress['exp_btl'] = round($ress['exp_btl']+($ress['exp_btl']/100*(0 + $efopit)));
						/*Удалить*/
							/*//Увеличенный опыт для статистики для персонажей меньше 8 уровня
							if($ress['level'] < 8){
								$basopit = array('8'=>140, '7'=>250, '6'=>400, '5'=>500, '4'=>600, '3'=>1100, '2'=>1900, '1'=>3600);
								$lvl = (8 - $ress['level']);
								$bas_exp = $basopit[$lvl]; 
								$ress['exp_btl'] = round($basopit[$lvl]+$ress['exp_btl']+($ress['exp_btl']/100*(100 + $efopit)));
							}
							else{
								$bas_exp = $ress['exp_btl'];
								if($ress['level'] == 10 && $this->info['dungeon'] == 0 && $this->info['razdel'] == 5){
									$ress['exp_btl'] = (round($ress['exp_btl']+($ress['exp_btl']/100*(0 + $efopit))))*2;
								}elseif($ress['level'] == 11 && $this->info['dungeon'] == 0 && $this->info['razdel'] == 5){
									$ress['exp_btl'] = (round($ress['exp_btl']+($ress['exp_btl']/100*(0 + $efopit))))*3;
								}else{
									$ress['exp_btl'] = round($ress['exp_btl']+($ress['exp_btl']/100*(0 + $efopit)));
								}
								
								//$this->users[$i]['battle_exp'] = round($this->users[$i]['battle_exp']+($this->users[$i]['battle_exp']/100*($efopit + 1 + $this->info['addExp']+$this->stats[$i]['exp'])));
								//$this->users[$i]['battle_exp'] = round($this->users[$i]['battle_exp']+($this->users[$i]['battle_exp']/100*(1+$this->info['addExp']+$this->stats[$i]['exp'])));
							}*/
						/*Удалить*/
						
						if( isset($lime[$ress['level']]) && $lime[$ress['level']] < $ress['exp_btl']['battle_exp']) {
							//$this->users[$i]['battle_exp'] = $lime[$this->users[$i]['level']];
							$ress['exp_btl'] = $lime[$ress['level']];
						}
						
						if($ress['team'] == $this->info['team_win'] || $this->info['priz'] == 1){
							mysql_query('UPDATE `battle_users` SET `exp_btl` = "'.$ress['exp_btl'].'", `prc_btl` = "'.(100+$efopit).'" WHERE `uid` = "'.$ress['uid'].'" AND `battle` = "'.$this->info['id'].'"');
							//mysql_query('UPDATE `stats` SET `battle_yron` = "0", `zv`="0" WHERE `id` = "'.$ress['uid'].'" LIMIT 1');
							if($this->info['dungeon'] == 0){
								$test = mysql_fetch_array(mysql_query('SELECT * FROM `battle_ending` WHERE `uid` = "'.$ress['uid'].'" AND `battle` = "'.$this->info['id'].'" LIMIT 1'));
							}
							if(isset($test['id'])) {
								//
								mysql_query('UPDATE `battle_ending` SET `x` = `x` + 1 WHERE `id` = "'.$test['id'].'" LIMIT 1');
								//
							}elseif($this->info['dungeon'] == 0){
								mysql_query('INSERT INTO `battle_ending` (`uid`,`battle`,`x`) VALUES ("'.$ress['uid'].'","'.$this->info['id'].'","0")');
								//Обновление таблицы, добавление опыта
								$magic->updateopit($efid, $efopit1);
								if($this->info['razdel'] == 5 && $ress['level'] >= 8){
									$ekr = 0.02;
									$lev = ($ress['level'] - 8);
									if($lev != 0){
										$ekr = $ekr + (0.01 * $lev);
									}
									if(round(date('w')) == 0 || round(date('w')) == 6 /*|| $c['holiday'] == true*/ ) {
										$ekr *= 2;
									}
									if( $this->info['priz'] == 1 ) {
										//
										//$itmodet = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `inOdet` > 0 AND `inOdet` < 18 AND `uid` = "'.$this->users[$i]['id'].'" LIMIT 1'));
										//$itmodet = $itmodet[0];
										//if( $itmodet < 0 ) { $itmodet = 0; }
										//if( $itmodet > 17 ) { $itmodet = 17; }	
										//
										if( $ress['team'] == $this->info['team_win'] ) {
											$ekr *= 2;
										}
										if( $this->stats[$this->uids[$ress['uid']]]['lvlitmsu'] < 10 ) {
											$ekr = 0;
										}
										//$magic->addekr($ekr, $ress['uid']);
										//if( $this->info['razdel'] == 5 ) {
										mysql_query('UPDATE `battle_finish_new` SET 
										
											`ekr` = "'.$ekr.'",
											`priz_take` = 1 
										
										WHERE `uid` = "'.$ress['uid'].'" AND `battle` = "'.$this->info['id'].'" LIMIT 1');
										//}
										/*if($this->info['razdel'] == 5 && $this->users[$i]['id'] == $ress['uid']){
											if( $this->stats[$i]['lvlitmsu'] < 12  ) {
												$txt_ekr = $this->users[$i]['battle_text']. "Вам начислено <strong><font color=red>0 екр.</font></strong>, необходимо надеть полный комплект (Призовой Хаот)";
												mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$ress['city']."','".$ress['room']."','','".$ress['login']."','".$txt_ekr."','".time()."','6','0')");
												echo '<script>top.chat.reflesh();</script>';
											}else{
												$txt_ekr = $this->users[$i]['battle_text']. "Вам начислено <strong>".$ekr." екр.</strong> (Призовой Хаот)";
												mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$ress['city']."','".$ress['room']."','','".$ress['login']."','".$txt_ekr."','".time()."','6','0')");
												echo '<script>top.chat.reflesh();</script>';
											}
										}*/
									}elseif($ress['exp_btl'] > 5000){
										//$magic->addekr($ekr, $ress['uid']);
										//$u->addDelo(776, $ress['uid'],'За бой начисленно '.$ekr.' екр.',time(),  '','battleBonus',$ekr,'');
										//if( $this->info['razdel'] == 5 ) {
											
										if( $this->stats[$this->uids[$ress['uid']]]['lvlitmsu'] < 10 ) {
											$ekr = 0;
										}
											
										mysql_query('UPDATE `battle_finish_new` SET 
										
											`ekr` = "'.$ekr.'"
										
										WHERE `uid` = "'.$ress['uid'].'" AND `battle` = "'.$this->info['id'].'" LIMIT 1');
										//}
										/*if($this->info['razdel'] == 5 && $this->users[$i]['id'] == $ress['uid']){
											$txt_ekr = $this->users[$i]['battle_text']. "Вам начислено <strong>".$ekr." екр.</strong>";
											mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$ress['city']."','".$ress['room']."','','".$ress['login']."','".$txt_ekr."','".time()."','6','0')");
											echo '<script>top.chat.reflesh();</script>';
										}*/
										/*$resboi= 'Бой закончен. Победа. Получено опыта: <b>'.$ress['exp_btl'].'</b> ('.(100 + $efopit).'%).'; //stats
										$txt_ekr = $resboi. "Вам начислено <strong>".$ekr." екр.</strong>";
											mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$ress['city']."','".$ress['room']."','','".$ress['login']."','".$txt_ekr."','-1','6','0')");
											echo '<script>top.chat.reflesh();</script>';*/
									}
									/*if($this->info['razdel'] == 5){
										//$magic->pryanik($ress['uid']);
										if(rand(1, 100) <= 50){
								    		//$items = array('5111'=>5111,'5112'=>5112,'5113'=>5113,'5114'=>5114,'5115'=>5115,'5116'=>5116,'5117'//=>5117,'5118'=>5118,'5119'=>5119,'5120'=>5120);
								    		$items = array('5111'=>5111,'5113'=>5113,'5114'=>5114,'5115'=>5115,'5117'=>5117,'5118'=>5118,'5119'=>5119,'5120'=>5120);
								    		$item = array_rand($items, 1);
								    		$prasdnik = $u->addItem($item, $ress['uid'], 'nosale=1|notransfer=1');
								    		if($prasdnik){
								    			$txt_prasd = 'Вы получили праздничный предмет!';
								    			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$ress['city']."','".$ress['room']."','','".$ress['login']."','".$txt_prasd."','-1','6','0')");
								    		}
								    	}
									}*/
								}

							}
						}
						else{
							mysql_query('UPDATE `battle_users` SET `exp_btl` = "'.round($bas_exp/100*$prc_btl2).'", `prc_btl` = "'.$prc_btl2.'" WHERE `uid` = "'.$ress['uid'].'" AND `battle` = "'.$this->info['id'].'"');	
							//mysql_query('UPDATE `stats` SET `battle_yron` = "0", `zv`="0" WHERE `id` = "'.$ress['uid'].'" LIMIT 1');
							if($this->info['dungeon'] == 0){
								//Обновление таблицы, добавление опыта
								$magic->updateopit($efid, $efopit2);
							}
						}
						$bt_l = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$this->info['id'].'"'));
						if($bt_l['noeff'] == 1){
							$it_us = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$ress['uid'].'" AND `inOdet` < "0" AND `delete` = "0"');
							//var_dump($it_us);
							while($item_us = mysql_fetch_array($it_us)){
								$inod = trim($item_us['inOdet'],'-');
								mysql_query('UPDATE `items_users` SET `inOdet`="'.$inod.'" WHERE `id` = "'.$item_us['id'].'"');
							}
							//mysql_query('UPDATE `items_users` SET `inOdet`="-99" WHERE `uid` = "'.$ress['uid'].'" AND ');
						}
						if($bt_l['type'] == 1){
							$it_us = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$ress['uid'].'" AND `inOdet` < "0" AND `delete` = "0"');
							//var_dump($it_us);
							while($item_us = mysql_fetch_array($it_us)){
								$inod = trim($item_us['inOdet'],'-');
								mysql_query('UPDATE `items_users` SET `inOdet`="'.$inod.'" WHERE `id` = "'.$item_us['id'].'"');
							}
							//mysql_query('UPDATE `items_users` SET `inOdet`="-99" WHERE `uid` = "'.$ress['uid'].'" AND ');
						}
						if($this->info['razdel'] == 5){
							$pass = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$ress['uid'].'" '));
							if( $this->stats[$this->uids[$ress['uid']]]['lvlitmsu'] < 10 ) {
								//не даем бонус 
							}elseif($pass['pass'] != 'saintlucia5' && $pass['pass'] != 'saintlucia' && $pass['real'] == 1){
								mysql_query('UPDATE `battle_finish_new` SET 
								
								`daily` = "1"
								
								WHERE `uid` = "'.$pass['id'].'" AND `battle` = "'.$this->info['id'].'" LIMIT 1');
								/*
								$daily = mysql_fetch_array(mysql_query('SELECT * FROM `dailybattle` WHERE `uid` = "'.$ress['uid'].'" '));
								if(isset($daily['id'])){
									mysql_query('UPDATE `dailybattle` SET `date`= (`date` + 1) WHERE `uid` = "'.$ress['uid'].'"');
								}else{
									mysql_query("INSERT INTO `dailybattle` (`uid`,`date`) VALUES ('".$ress['uid']."','1' )");
								}*/
								
							}
						}
					}
				}

				if($this->info['turnir'] == 0) {
				//пишем в чат
					if($txt_ekr == ''){
						if( $this->users[$i]['login'] != '' ) {
							mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$this->users[$i]['city']."','".$this->users[$i]['room']."','','".$this->users[$i]['login']."','".$this->users[$i]['battle_text']."','".time()."','6','0')");
						}
						echo '<script>top.chat.reflesh();</script>';				
					}
					else{
					/*	mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$this->users[$i]['city']."','".$this->users[$i]['room']."','','".$this->users[$i]['login']."','".$txt_ekr."','-1','6','0')");
						echo '<script>top.chat.reflesh();</script>';*/
					}
				}else{
					mysql_query('UPDATE `turnirs` SET `winner` = "'.$this->info['team_win'].'" WHERE `id` = "'.$this->info['turnir'].'" LIMIT 1');
				}
				//завершаем сам бой				
				$upd3  = mysql_query('UPDATE `battle` SET `time_over` = "'.time().'",`team_win` = "'.$this->info['team_win'].'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
				
				//Если это БС (старая версия)
				/*$tinf = mysql_fetch_array(mysql_query('SELECT * FROM `dungeon_now` WHERE `id` = "'.$this->info['dn_id'].'" LIMIT 1'));
				if(isset($tinf['id']) && $tinf['bsid']>0)
				{
					$bs = mysql_fetch_array(mysql_query('SELECT * FROM `bs_turnirs` WHERE `city` = "'.$u->info['city'].'" AND `id` = "'.$tinf['bsid'].'" AND `time_start` = "'.$tinf['time_start'].'" LIMIT 1'));
					if(isset($bs['id']))
					{
						$u->bsfinish($bs,$this->users,$this->info);				
					}
				}*/
				//mysql_query('DELETE FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'"');
				$this->saveLogs( $this->info['id'] , 'all' );				
				if( $u->info['battle'] != 0 && !isset($u->info['battle_lsto']) ) {
					echo '<script>document.getElementById(\'teams\').style.display=\'none\';var battleFinishData = "'.$u->info['battle_text'].'";</script>';
				}
				//mysql_query('UNLOCK TABLES');
			}
			//unlink($lock_file);
			}
		}
		
	//Выдаем предметы
	//$this->addGlobalItems($this->user[$i]['id'],$this->user[$j]['id'],$mon['win_itm'],$mon['win_eff'],$mon['win_ico'],$mon['win_exp'],$mon['win_money'],$mon['win_money2']);
		public $ainm = array();
		public function addGlobalItems($bid,$uid,$itm,$eff,$ico,$exp,$cr,$ecr) {
			global $u;
			//
			//Выпадение дропа на ЦП
			if( $bid == 1009 ) {
				//Обищй враг (9 мая)
				// 911 1172 1173 2141 2142 2143  2144
				$svtl = array(911,1172,1173,2141,2142,2143,2144);
				$svtl = $svtl[rand(0,count($svtl)-1)];
						mysql_query('INSERT INTO `items_local`
						( `room` , `time`,`item_id`,`data`,`tr_login`,`colvo` ) VALUES
						(
							"'.$this->users[$this->uids[$uid]]['room'].'",
							"'.time().'",
							"'.$svtk.'",
							"|nosale=1|srok=259200",
							"'.$this->users[$this->uids[$uid]]['login'].'",
							"1"
						)');
								
			}elseif( $bid == 1008 ) {
				//Старый Новый Год
				$jit = 0;
				$iit = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `users` WHERE `online` > '.(time()-120).''));
				$iit = floor($iit[0]/20);
				$iit = rand(1,$iit);
				while( $jit < $iit ) {
					if( rand(0,100) < 50 ) {
						$svtk = array(
							1000,1000,1000,1000,1000,1000,1000,1000,
							1000,1000,1000,1000,1000,1000,1000,1000,1000,
							1000,1000,1000,1000,1000,1000,1000,1000,1000,
							1000,1000,1000,1000,1000,1000,1000,1000,
							1461,1462,1463,
							4037,4038,4039,4040,
							911,1172,1173,2142,2141,2143,2870,2144,1000,
							1000,1000,1000,1000,1000,1000,1000,1000,1000,
							1000,1000,1000,1000,1000,1000,1000,1000,1000,
							1000,1000,1000,1000,1000,1000,1000,1000,1000,
							1000,1000,1000,1000,1000,1000,1000,1000,1000				
						);
						$svtk = $svtk[rand(0,count($svtk)-1)];
						if( $svtk == 1000 ) {
							mysql_query('INSERT INTO `items_local`
							( `room` , `time`,`item_id`,`data`,`tr_login`,`colvo` ) VALUES
							(
								"'.$this->users[$this->uids[$uid]]['room'].'",
								"'.time().'",
								"'.$svtk.'",
								"|nosale=1|srok=259200",
								"'.$this->users[$this->uids[$uid]]['login'].'",
								"1"
							),(
								"'.$this->users[$this->uids[$uid]]['room'].'",
								"'.time().'",
								"'.$svtk.'",
								"|nosale=1|srok=259200",
								"'.$this->users[$this->uids[$uid]]['login'].'",
								"1"
							),(
								"'.$this->users[$this->uids[$uid]]['room'].'",
								"'.time().'",
								"'.$svtk.'",
								"|nosale=1|srok=259200",
								"'.$this->users[$this->uids[$uid]]['login'].'",
								"1"
							),(
								"'.$this->users[$this->uids[$uid]]['room'].'",
								"'.time().'",
								"'.$svtk.'",
								"|nosale=1|srok=259200",
								"'.$this->users[$this->uids[$uid]]['login'].'",
								"1"
							),(
								"'.$this->users[$this->uids[$uid]]['room'].'",
								"'.time().'",
								"'.$svtk.'",
								"|nosale=1|srok=259200",
								"'.$this->users[$this->uids[$uid]]['login'].'",
								"1"
							),(
								"'.$this->users[$this->uids[$uid]]['room'].'",
								"'.time().'",
								"'.$svtk.'",
								"|nosale=1|srok=259200",
								"'.$this->users[$this->uids[$uid]]['login'].'",
								"1"
							)');
						}
						mysql_query('INSERT INTO `items_local`
						( `room` , `time`,`item_id`,`data`,`tr_login`,`colvo` ) VALUES
						(
							"'.$this->users[$this->uids[$uid]]['room'].'",
							"'.time().'",
							"'.$svtk.'",
							"|nosale=1|srok=259200",
							"'.$this->users[$this->uids[$uid]]['login'].'",
							"1"
						)');
					}
					$jit++;
				}
				unset($svtk);
			}elseif( $bid == 1007 ) {
				//Хэллоуин, Тыквоголовый CAPITAL CITY
				$jit = 0;
				$iit = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `users` WHERE `online` > '.(time()-120).''));
				$iit = floor($iit[0]/20);
				$iit = rand(1,$iit);
				while( $jit < $iit ) {
					if( rand(0,100) < 50 ) {
						mysql_query('INSERT INTO `items_local`
						( `room` , `time`,`item_id`,`data`,`tr_login`,`colvo` ) VALUES
						(
							"'.$this->users[$this->uids[$uid]]['room'].'",
							"'.time().'",
							"4504",
							"",
							"'.$this->users[$this->uids[$uid]]['login'].'",
							"1"
						)');
					}
					$jit++;
				}
			}elseif( $bid == 1006 ) {
				//Трупожор CAPITAL CITY
				if( rand(0,100) < 10 ) {
					mysql_query('INSERT INTO `items_local`
					( `room` , `time`,`item_id`,`data`,`tr_login`,`colvo` ) VALUES
					(
						"'.$this->users[$this->uids[$uid]]['room'].'",
						"'.time().'",
						"4451",
						"srok=86400",
						"'.$this->users[$this->uids[$uid]]['login'].'",
						"1"
					)');
				}
			}elseif( $bid == 1000 ) {
				//Трупожор CAPITAL CITY
				//if( rand(0,100) < 10 ) {
					mysql_query('INSERT INTO `items_local`
					( `room` , `time`,`item_id`,`data`,`tr_login`,`colvo` ) VALUES
					(
						"'.$this->users[$this->uids[$uid]]['room'].'",
						"'.time().'",
						"4460",
						"srok=2592000",
						"'.$this->users[$this->uids[$uid]]['login'].'",
						"1"
					)');
				//}
			}elseif( $bid == 1001 ) {

				//Трупожор CAPITAL CITY
				//if( rand(0,100) < 10 ) {
					mysql_query('INSERT INTO `items_local`
					( `room` , `time`,`item_id`,`data`,`tr_login`,`colvo` ) VALUES
					(
						"'.$this->users[$this->uids[$uid]]['room'].'",
						"'.time().'",
						"4461",
						"srok=2592000",
						"'.$this->users[$this->uids[$uid]]['login'].'",
						"1"
					)');
				//}
			}elseif( $bid == 1002 ) {
				//Трупожор CAPITAL CITY
				//if( rand(0,100) < 10 ) {
					mysql_query('INSERT INTO `items_local`
					( `room` , `time`,`item_id`,`data`,`tr_login`,`colvo` ) VALUES
					(
						"'.$this->users[$this->uids[$uid]]['room'].'",
						"'.time().'",
						"4462",
						"srok=2592000",
						"'.$this->users[$this->uids[$uid]]['login'].'",
						"1"
					)');
				//}
			}elseif( $bid == 1003 ) {
				//Трупожор CAPITAL CITY
				//if( rand(0,100) < 10 ) {
					mysql_query('INSERT INTO `items_local`
					( `room` , `time`,`item_id`,`data`,`tr_login`,`colvo` ) VALUES
					(
						"'.$this->users[$this->uids[$uid]]['room'].'",
						"'.time().'",
						"4463",
						"srok=2592000",
						"'.$this->users[$this->uids[$uid]]['login'].'",
						"1"
					)');
				//}
			}elseif( $bid == 1004 ) {
				//Трупожор CAPITAL CITY
				//if( rand(0,100) < 10 ) {
					mysql_query('INSERT INTO `items_local`
					( `room` , `time`,`item_id`,`data`,`tr_login`,`colvo` ) VALUES
					(
						"'.$this->users[$this->uids[$uid]]['room'].'",
						"'.time().'",
						"4459",
						"srok=2592000",
						"'.$this->users[$this->uids[$uid]]['login'].'",
						"1"
					)');
				//}
			}
			//			
			if( $exp > 0 ) {
				$this->users[$this->uids[$uid]]['battle_exp'] += round($exp*$this->users[$this->uids[$uid]]['battle_yron']/$this->stats[$this->uids[$bid]]['hpAll']);
				mysql_query('UPDATE `stats` SET `battle_exp` =  "'.mysql_real_escape_string($this->users[$this->uids[$uid]]['battle_exp']).'" WHERE `id` = "'.mysql_real_escape_string($uid).'" LIMIT 1');
			}
			//
			if( $cr != '' && $cr > 0 ) {
				if( $this->stats[$this->uids[$uid]]['hpNow'] > 0 ) {
					mysql_query('UPDATE `users` SET `money` = (`money` + '.mysql_real_escape_string($cr).') WHERE `id` = "'.mysql_real_escape_string($uid).'" LIMIT 1');
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$this->users[$this->uids[$uid]]['city']."','".$this->users[$this->uids[$uid]]['room']."','','".$this->users[$this->uids[$uid]]['login']."','<font color=#cb0000><b>Вы получили кредиты:</b> ".mysql_real_escape_string($cr)." <b>кр.</b></font>','".time()."','6','0')");
				}
			}
			//
			if( $ecr != '' && $ecr > 0 ) {
				if( $this->stats[$this->uids[$uid]]['hpNow'] > 0 ) {
					mysql_query('UPDATE `bank` SET `money2` = `money2` + "'.mysql_real_escape_string($ecr).'" WHERE `uid` = "'.mysql_real_escape_string($uid).'" AND `block` = "0" ORDER BY `id` DESC LIMIT 1');
					//mysql_query('UPDATE `battle_lock` SET `ekr` = "'.$ecr.'" WHERE `uid` = "'.$uid.'" AND `btl` = "'.$this->info['id'].'"');
					if($ins) {
						mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$this->users[$this->uids[$uid]]['city']."','".$this->users[$this->uids[$uid]]['room']."','','".$this->users[$this->uids[$uid]]['login']."','<font color=#cb0000><b>Вы получили Евро-кредиты:</b> ".mysql_real_escape_string($ecr)." <b>екр.</b></font>','".time()."','6','0')");
					}else{
						mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$this->users[$this->uids[$uid]]['city']."','".$this->users[$this->uids[$uid]]['room']."','','".$this->users[$this->uids[$uid]]['login']."','<font color=#cb0000><b>Вы могли получили Евро-кредиты за этот бой, но у Вас нет банковского счета.</b> Его можно создать на Страшилкиной ул. в здании Банка за небольшое количество кредитов.</font>','".time()."','6','0')");
					}
				}
			}
			//
			if( $ico != '' ) {
				/*
				0(тип, 1 - значок, 2 - подвиг)@
				1(время в минутах)@
				2(название картинки)@

				3(название)@
				4(требует остаться в живых 0 или 1, либо игрок умер -1)@
				5(требует набить с ботам урона в % Например 0.001)@
				6(действия например: add_s1=5|add_hpAll=50)@
				7(Требует другой значок, название картинки)@
				8(плюсует значок 0 или 1)@
				9(удаляем прошлый значок 0 or 1)
				*/
				$i = 0;
				$txt = '';
				$ico = explode('#',$ico);
				while( $i < count($ico) ) {
					$ico_e = explode('@',$ico[$i]);
					if(isset($ico_e[3])) {
						//
						$add = 1;
						if($ico_e[4] == 1 && floor($this->stats[$this->uids[$uid]]['hpNow']) < 1) {
							$add = 0;
						}
						if( $add == 1 ) {
							$ins = false;
							if( $ico_e[8] == 0 ) {
								$ins = true;
								if( $ico_e[9] == 1 ) {
									mysql_query('DELETE FROM `users_ico` WHERE `uid` = "'.mysql_real_escape_string($uid).'" AND `img` = "'.mysql_real_escape_string($ico_e[2]).'"');
								}
							}else{
								$old_ico = mysql_fetch_array(mysql_query('SELECT `id` FROM `users_ico` WHERE `uid` = "'.mysql_real_escape_string($uid).'" AND (`endTime` > "'.time().'" OR `endTime` = 0) AND `img` = "'.mysql_real_escape_string($ico_e[2]).'" LIMIT 1'));
								if( !isset($old_ico['id'])) {
									$ins = true;
								}else{
									if( $old_ico['id'] > 0 ) {
										$txt .= ', &quot;'.$ico_e[3].' (<small>Обновление</small>)&quot;';
										mysql_query('UPDATE `users_ico` SET `x` = `x` + 1,`endTime` = "'.mysql_real_escape_string(time()+$ico_e[1]*60).'" WHERE `id` = "'.$old_ico['id'].'" LIMIT 1');
									}else{
										$ins = true;
									}
								}
								unset($old_ico);
							}
							if($ins == true) {
								if( $ico_e[9] == 1 ) {
									mysql_query('DELETE FROM `users_ico` WHERE `uid` = "'.mysql_real_escape_string($uid).'" AND `img` = "'.mysql_real_escape_string($ico_e[2]).'"');
								}
								mysql_query('INSERT INTO `users_ico` (`uid`,`time`,`text`,`img`,`endTime`,`type`,`bonus`) VALUES (
									"'.mysql_real_escape_string($uid).'",
									"'.time().'",
									"'.mysql_real_escape_string($ico_e[3]).'",
									"'.mysql_real_escape_string($ico_e[2]).'",
									"'.mysql_real_escape_string(time()+$ico_e[1]*60).'",
									"'.mysql_real_escape_string($ico_e[0]).'",
									"'.mysql_real_escape_string($ico_e[6]).'"
								)');
								$txt .= ', &quot;'.$ico_e[3].'&quot;';
							}
						}
						//
					}
					$i++;
				}
				if( $txt != '' ) {
					$txt = ltrim($txt,', ');
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$this->users[$this->uids[$uid]]['city']."','".$this->users[$this->uids[$uid]]['room']."','','".$this->users[$this->uids[$uid]]['login']."','<font color=#cb0000><b>Вы совершили подвиг:</b> ".mysql_real_escape_string($txt)."</font>','".time()."','6','0')");
				}
			}
			//
			if( $itm != '' ) {
				$i = 0;
				$txt = '';
				$itm = explode(',',$itm);
				while($i < count($itm)) {
					$itm_e = explode('@',$itm[$i]);
					if($itm_e[0] > 0) {
						$j = 0;
						while( $j < $itm_e[1] ) {
							$u->addItem($itm_e[0],$uid,'|'.$itm_e[2]);
							$j++;
						}
						if( !isset($this->ainm[$itm_e[0]]) ) {
							$this->ainm[$itm_e[0]] = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($itm_e[0]).'" LIMIT 1'));
						}
						if( isset($this->ainm[$itm_e[0]]['id']) ) {
							//Добавляем текст о добавлении предмета
							$txt .= ', <b>'.$this->ainm[$itm_e[0]]['name'].'</b>';
							if( $itm_e[1] > 1 ) {
								$txt .= ' <b>(x'.$itm_e[1].')</b>';
							}
						}
					}
					$i++;
				}
				if( $txt != '' ) {
					$txt = ltrim($txt,', ');
					mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$this->users[$this->uids[$uid]]['city']."','".$this->users[$this->uids[$uid]]['room']."','','".$this->users[$this->uids[$uid]]['login']."','<font color=#cb0000><b>Вы получили предметы:</b> ".mysql_real_escape_string($txt)."</font>','".time()."','6','0')");
				}
			}
			//
		}
		
	//Проводим удар
		public function addNewAtack()
		{
			global $u;
			if(!isset($this->ga[$u->info['id']][$u->info['enemy']]))
			{
				if($this->stats[$this->uids[$u->info['id']]]['hpNow']>0)	
				{
					$us = $this->stats[$this->uids[$u->info['id']]];
					$i = 1; $no = 0;
					if($us['weapon1']!=1 && $us['weapon2']==1)
					{
						$uz['zona'] += 1;
					}
					while($i<=$uz['zona'])
					{
						if($this->uAtc['a'][$i]==0)
						{	
							$no = 1;
						}
						$i++;
					}
					
					if($this->uAtc['b']==0)
					{
						$no = 1;
					}

					
					if($no==0)
					{
						//наносим удар
						if($u->info['enemy'] > 0)
						{
		
							if(!isset($this->ga[$u->info['enemy']][$u->info['id']]))
							{
								if($this->stats[$this->uids[$u->info['id']]]['hpNow']>=1 && $this->stats[$this->uids[$u->info['enemy']]]['hpNow']>=1)
								{
									//наносим новый удар
									$a = $this->uAtc['a'][1].''.$this->uAtc['a'][2].''.$this->uAtc['a'][3].''.$this->uAtc['a'][4].''.$this->uAtc['a'][5];
									$b = $this->uAtc['b'];	
									mysql_query('DELETE FROM `battle_act` WHERE `battle` = "'.$this->info['id'].'" AND ((`uid2` = "'.$u->info['id'].'" AND `uid1` = "'.$u->info['enemy'].'") OR (`uid1` = "'.$u->info['id'].'" AND `uid2` = "'.$u->info['enemy'].'")) LIMIT 2');						
									$d = mysql_query('INSERT INTO `battle_act` (`battle`,`time`,`uid1`,`uid2`,`a1`,`b1`) VALUES ("'.$this->info['id'].'","'.time().'","'.$u->info['id'].'","'.$u->info['enemy'].'","'.$a.'","'.$b.'")');
									if(!$d)
									{
										$this->e = 'Не удалось нанести удар по противнику...';
									}else{
										$this->ga[$u->info['id']][$u->info['enemy']] = mysql_insert_id();
									}
								}								
							}else{
								//отвечаем на удар противника
								if($this->stats[$this->uids[$u->info['id']]]['hpNow']>=1 && $this->stats[$this->uids[$u->info['enemy']]]['hpNow']>=1)
								{
									if(isset($this->atacks[$this->ga[$u->info['enemy']][$u->info['id']]]['id']))
									{
										$this->atacks[$this->ga[$u->info['enemy']][$u->info['id']]]['a2'] = $this->uAtc['a'][1].''.$this->uAtc['a'][2].''.$this->uAtc['a'][3].''.$this->uAtc['a'][4].''.$this->uAtc['a'][5];
										$this->atacks[$this->ga[$u->info['enemy']][$u->info['id']]]['b2'] = $this->uAtc['b'];
										$this->startAtack($this->atacks[$this->ga[$u->info['enemy']][$u->info['id']]]['id']);
									}
								}
							}
						}else{
							//ожидание хода противника (нет подходящего противника)
							
						}
					}else{
						$this->e = 'Выберите зоны удара и блока';
					}
				}else{
					$this->e = 'Для вас поединок закончен, ожидайте пока завершат другие...';
				}
			}else{
				//уже ударили противника, ожидание хода
				
			}	
		}
	
	//Запускаем магические предметы, если в них что-то встроено
		public function magicItems($uid1,$uid2)
		{
			global $u,$priem,$c,$code;
			if(isset($this->stats[$this->uids[$uid1]]))
			{
				$i = 0;
				while($i<count($this->stats[$this->uids[$uid1]]['items']))
				{
					$itm = $this->stats[$this->uids[$uid1]]['items'][$i];
					if(isset($itm['id']))
					{
						$e = $u->lookStats($itm['data']);
						if(isset($e['bm_a1']))
						{
							if(file_exists('../../_incl_data/class/priems/'.$e['bm_a1'].'.php'))
							{
								require('../../_incl_data/class/priems/'.$e['bm_a1'].'.php');
							}
						}
					}
					$i++;
				}
				unset($itm);
			}
		}
		public function testPog($uid,$yr)
		{
			//$yr = round($yr*1.25);
			$yr2 = $yr;
			if($yr > 0) {
			$testmana=false;
			global $u,$priem;
			$i = 0;			
			$ypg22 = 0;
			while($i < count($this->stats[$this->uids[$uid]]['set_pog2']))
			{			
				$j = $this->stats[$this->uids[$uid]]['set_pog2'][$i];                
				$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data'] = str_replace('add_pog2='.$j['y'],'add_pog2=$',$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data']);
				$dt3 = $u->lookStats($this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data']);				
				$dt3['add_pog2mp'] = round($dt3['add_pog2mp']/100,2);
				if(isset($dt3['add_pog2mp'])) {
					$priem->minMana($uid,round(round($yr2/100*(100-$dt3['add_pog2p']))*$dt3['add_pog2mp']));
				}				
				$j['y'] -= $yr2; // осталось для поглощения			
				if(isset($dt3['add_pog2p'])) {
					$yr2 = round($yr2/100*(100-$dt3['add_pog2p']));
					//echo '[Поглощаем: '.($dt3['add_pog2p']).'% за '.(round(round($yr2/100*(100-$dt3['add_pog2p']))*$dt3['add_pog2mp'])).'MP]';
				}
				unset($dt3);				
				if($j['y'] < 0 || ($this->stats[$this->uids[$uid]]['mpNow'] <= 0 && $dt3['add_pog2mp'] > 0)) {					
					$dt2 = $u->lookStats($this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data']);
					if(isset($dt2['endPog']) && $dt2['endPog'] == 1)
					{
						//удаляем прием
						$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['v2'].'" LIMIT 1'));
						$this->delPriem($this->stats[$this->uids[$uid]]['effects'][$j['id']-1],$this->users[$this->uids[$uid]],4,$uid);
						$this->stats[$this->uids[$uid]]['effects'][$j['id']-1] = 'delete';
					}
					unset($dt2);
					$yr2 = -($j['y']);
					$j['y'] = 0;
				}
								
				$this->stats[$this->uids[$uid]]['set_pog'][$i]['y'] = $j['y'];	
				$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data'] = str_replace('add_pog2=$','add_pog2='.$j['y'],$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data']);
				$upd = mysql_query('UPDATE `eff_users` SET `data` = "'.$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['id'].'" LIMIT 1');
				if($upd)
				{
					
				}
				$i++;
			}
			
			}
			return $yr2;

		}
		public $rehodeff = array();
		
	//Поглощение урона
		public $poglast = array();
		
		public function testPogB($uid,$yr,$pliid,$test = 0)
		{
			//$yr = round($yr*1.25);
			$yr2 = $yr;
			if($yr > 0) {
			$testmana=false;
			global $u,$priem;
			$i = 0;			
			$ypg22 = 0;
			while($i < count($this->stats[$this->uids[$uid]]['set_pog2']))
			{			
				$j = $this->stats[$this->uids[$uid]]['set_pog2'][$i];              
				if( $this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['id'] == $pliid || $test == 1 ) {
					$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data'] = str_replace('add_pog2='.$j['y'],'add_pog2=$',$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data']);
					$dt3 = $u->lookStats($this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data']);
					$dt3['add_pog2mp'] = round($dt3['add_pog2mp']/100,2);				
					//
					$dt30 = 0;
					$dt30 = floor($j['y']/$yr2*100);
					//
					//echo '['.$j['y'].'|'.$dt3['add_pog2'].'|'.$yr2.' -> '.$dt30.'/'.$dt3['add_pog2p'].'] ';
					//
					if( $dt30 < $dt3['add_pog2p'] ) {
						$dt3['add_pog2p'] = $dt30;
					}
					//
					unset($dt30);
					//
					if(isset($dt3['add_pog2mp'])) {
						if( (round(round($yr2/100*(100-$dt3['add_pog2p']))*$dt3['add_pog2mp'])) > $this->stats[$this->uids[$uid]]['mpNow']) {
							//не хватило маны, считаем сколько хватит % от поглощенного урона
							$j['yhj'] = $this->stats[$this->uids[$uid]]['mpNow'] / (round(round($yr2/100*(100-$dt3['add_pog2p']))*$dt3['add_pog2mp']))*100;
							$j['yhj'] = floor($j['yhj']); //Сколько % мы можем поглотить
							$dt3['add_pog2p'] = floor($dt3['add_pog2p']/100*$j['yhj']);	
							//echo '[!]';						
						}
						if( $test == 1 ) {
							$priem->minMana($uid,round(round($yr2/100*$dt3['add_pog2p'])*$dt3['add_pog2mp']));
						}
					}	
					if(!isset($this->poglast[$uid])) {
						$this->poglast[$uid] = 0;
					}
					$this->poglast[$uid] += $yr2;
					if( $test == 1 ) {
						//$j['y'] -= $this->poglast[$uid]; // осталось для поглощения	
						$j['y'] -= round($this->poglast[$uid]/100*$dt3['add_pog2p']);
						$priem->minMana($uid,round(round($this->poglast[$uid]/100*$dt3['add_pog2p'])*$dt3['add_pog2mp']));
					}
					if(isset($dt3['add_pog2p'])) {
						$yr2 = round($yr2/100*(100-$dt3['add_pog2p']));
						//echo '[Поглощаем: '.($dt3['add_pog2p']).'% ( '.$yr2/100*$dt3['add_pog2p'].' от '.$yr2.' ед. ) за '.(round(round($yr2/100*(100-$dt3['add_pog2p']))*$dt3['add_pog2mp'])).'MP , остаток МР: '.$this->stats[$this->uids[$uid]]['mpNow'].']';
					}			
					//unset($dt3);				
					if($j['y'] < 0 || ($this->stats[$this->uids[$uid]]['mpNow'] <= 0 && $dt3['add_pog2mp'] > 0)) {					
						$dt2 = $u->lookStats($this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data']);
						if(isset($dt2['endPog']) && $dt2['endPog'] == 1)
						{
							//удаляем прием
							//Добавляем в лог
							$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['v2'].'" LIMIT 1'));
							$this->delPriem($this->stats[$this->uids[$uid]]['effects'][$j['id']-1],$this->users[$this->uids[$uid]],4,$uid);
							$this->stats[$this->uids[$uid]]['effects'][$j['id']-1] = 'delete';
						}
						unset($dt2);
						//$yr2 += -($j['y']);
						$j['y'] = 0;
					}	
					$this->stats[$this->uids[$uid]]['set_pog'][$i]['y'] = $j['y'];
					$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data'] = str_replace('add_pog2=$','add_pog2='.$j['y'],$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data']);
					//echo '['.$j['id'].'!'.$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['id'].']';
					$upd = mysql_query('UPDATE `eff_users` SET `data` = "'.$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data'].'" WHERE `id` = "'.$this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['id'].'" LIMIT 1');
					if($upd) {
						//echo '['.$j['y'].'->'.$yr2.']';
						//echo $this->stats[$this->uids[$uid]]['effects'][$j['id']-1]['data'];
					}
					if( $j['y'] - $this->poglast[$uid]+$yr2 < 0 ) {
						//echo '['.$yr.']';
						$yr -= $yr + ($j['y'] - $this->poglast[$uid]+$yr2);
						//echo '['.$this->poglast[$uid].','.$yr2.','.$j['y'].']';
						$yr2 = $yr;
						$i = count($this->stats[$this->uids[$uid]]['set_pog2'])+1;
					}
				}
				$i++;
			}
			
			}
			return $yr2;

		}


		
	//Проверка как бьем
		public function testHowRazmen($id) {
			$r = array(
				1 => 0, 2 => 0
			);
			if(isset($this->atacks[$id])) {
				if($this->atacks[$id]['out1']>0 && $this->atacks[$id]['out2']>0)
				{
					//игрок 1 пропустил ход
					if($this->atacks[$id]['out1'] == 100) {
						//на магию
						$r[1] = -2;
					}else{
						//время
						$r[1] = -1;
					}
					//игрок 2 пропустил ход
					if($this->atacks[$id]['out2'] == 100) {
						//на магию
						$r[2] = -2;
					}else{
						//время
						$r[2] = -1;
					}
				}elseif($this->atacks[$id]['out1']>0)
				{
					//игрок 1 пропустил ход
					if($this->atacks[$id]['out1'] == 100) {
						//Пропустил ход на магию
						$r[1] = -2;
					}else{
						//Пропустил ход по тайму
						$r[1] = -1;
					}
					//игрок 2 бьет
					$r[2] = 1;
				}elseif($this->atacks[$id]['out2']>0)
				{
					//игрок 2 пропустил ход
					if($this->atacks[$id]['out2'] == 100) {
						//Пропустил ход на магию
						$r[2] = -2;
					}else{
						//Пропустил ход по тайму
						$r[2] = -1;
					}
					//игрок 1 бьет
					$r[1] = 1;
				}else{
					//размен игрок 1 бьет по игрок 2 , и игрок 2 бьет по игрок 1
					$r[1] = 1;
					$r[2] = 1;
				}
			}
			return $r;
		}
		
	//Тестируем удары и т.д
		public function newRazmen($id,$at) {
			
			global $u;
			
			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
				
			/*
			if( $yhod == 1 ) {	
				//$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod']			
				$uid1_rl = $uid1;
				$uid2_rl = $uid2;
				$uid2 = $this->yhod_user($uid2,$uid1,$this->stats[$this->uids[$uid2]]['yhod']);				
			}
			*/
			
			if( $u->info['admin'] > 0 ) {
				//echo '['.$this->stats[$this->uids[$uid1]]['yhod'].'|'.$this->stats[$this->uids[$uid2]]['yhod'].']';
				//echo '['.$this->atacks[$id]['out1'].'|'.$this->atacks[$id]['out2'].']';
				//echo '['.$this->atacks[$id]['b1'].'|'.$this->atacks[$id]['b2'].']<hr>';
			}
			
			
			if( $this->stats[$this->uids[$uid1]]['yhod'] > 0 && $this->atacks[$id]['out1'] > 0 && $this->atacks[$id]['b1'] == 0) { // маг бьет вторым				
				$this->atacks[$id]['b1'] = rand(1,5);
				/*
				$this->atacks[$id]['out1'] = 0;
				$this->atacks[$id]['a1'] = ''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).'';
				mysql_query('UPDATE `battle_act` SET `out1` = 0 , `a1` = "'.$this->atacks[$id]['a1'].'" , `b1` = "'.$this->atacks[$id]['b1'].'" WHERE `id` = "'.$this->atacks[$id]['id'].'" LIMIT 1');
				*/
			}
			if( $this->stats[$this->uids[$uid2]]['yhod'] > 0 && $this->atacks[$id]['out2'] > 0 && $this->atacks[$id]['b2'] == 0) { //маг бьет первым
				$this->atacks[$id]['b2'] = rand(1,5);
				$this->atacks[$id]['out2'] = 0;
				$this->atacks[$id]['a2'] = ''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).'';
				mysql_query('UPDATE `battle_act` SET `out2` = 0 , `a2` = "'.$this->atacks[$id]['a2'].'" , `b2` = "'.$this->atacks[$id]['b2'].'" WHERE `id` = "'.$this->atacks[$id]['id'].'" LIMIT 1');
			}
				
			if( $this->stats[$this->uids[$uid1]]['yhod'] > 0 && $this->atacks[$id]['out1'] > 0 ) {
				if( $this->atacks[$id]['out1'] == 0 ) {
					$at[1] = $this->usersTestAtack($id,$uid1,$uid2,true);
				}else{
					//echo '['. $this->users[$this->uids[$uid1]]['login'] .' пропустил ход]';
					$at[1] = array( 0 );
				}
				if( $this->atacks[$id]['out2'] == 0 ) {
					$at[2] = $this->usersTestAtack($id,$uid2,$uid1,true);
				}else{
					//echo '['. $this->users[$this->uids[$uid2]]['login'] .' пропустил ход]';
					$at[2] = array( 0 );
				}
			}else{
				if( $this->atacks[$id]['out1'] == 0 ) {
					$at[1] = $this->usersTestAtack($id,$uid1,$uid2,false);
				}else{
					//echo '['. $this->users[$this->uids[$uid1]]['login'] .' пропустил ход]';
					$at[1] = array( 0 );
				}
				if( $this->atacks[$id]['out2'] == 0 ) {
					$at[2] = $this->usersTestAtack($id,$uid2,$uid1,false);
				}else{
					//echo '['. $this->users[$this->uids[$uid2]]['login'] .' пропустил ход]';
					$at[2] = array( 0 );
				}
			}
			
			return $at;
		}
	
	//Игрок1 наносит удар Игрок2
		public function usersTestAtack($id,$uid1,$uid2,$mgf) {
			global $u;
			$r = array();			
			$block = array(
				0,
				0,
				0,
				0,
				0,
				0
			);
			
			$uid1r = $uid1;
			$uid2r = $uid2;
			
			/*if( $this->stats[$this->uids[$uid1]]['yhod'] > 0) {
				if( $this->atacks[$id]['out1'] > 0 ) {
					$uid1 = $uid2r;
					$this->atacks[$id]['out1_'] = $this->atacks[$id]['out1'];
					$this->atacks[$id]['out1'] = 0;
				}
			}
			if( $this->stats[$this->uids[$uid2]]['yhod'] > 0) {
				if( $this->atacks[$id]['out2'] > 0 ) {
					$uid2 = $uid1r;
					$this->atacks[$id]['out2_'] = $this->atacks[$id]['out2'];
					$this->atacks[$id]['out2'] = 0;
				}
			}*/
			
			/*if( $this->stats[$this->uids[$uid2]]['yhod'] > 0 && $u->info['admin'] > 0) {
				/*if( $this->atacks[$id]['out2'] > 0 ) {
					$uid2 = $uid1r;
					$this->atacks[$id]['out2_'] = $this->atacks[$id]['out2'];
					$this->atacks[$id]['out2'] = 0;
				}*/
			//}
			
			//Проверка блоков
				$i = 1;
				if( $uid1 == $this->atacks[$id]['uid1'] ) {
					$a = 2;
					$b = 1;
					$j = $this->atacks[$id]['b2'];
					$atack = array(
						0,
						$this->atacks[$id]['a1'][0],
						$this->atacks[$id]['a1'][1],
						$this->atacks[$id]['a1'][2],
						$this->atacks[$id]['a1'][3],
						$this->atacks[$id]['a1'][4]
					);
				}elseif( $uid2 == $this->atacks[$id]['uid1'] ) {
					$a = 1;
					$b = 2;
					$j = $this->atacks[$id]['b1'];
					$atack = array(
						0,
						$this->atacks[$id]['a2'][0],
						$this->atacks[$id]['a2'][1],
						$this->atacks[$id]['a2'][2],
						$this->atacks[$id]['a2'][3],
						$this->atacks[$id]['a2'][4]
					);
				}

				
				/*if( $u->info['admin'] > 0 ) {
					echo '['.$mfg.' , '.$uid1.' , '.$uid2.' , '.$a.' , '.$this->atacks[$id]['out' . $a ].' , '.$this->stats[$this->uids[${'uid'.$a}]]['yhod'].']';
				}*/
				

				//if( $this->atacks[$id]['out' . $a ] == 0 || $this->stats[$this->uids[${'uid'.$a}]]['yhod'] > 0 || $mgf == true ) {
				if( $this->atacks[$id]['out' . $a ] == 0 || $uid1 == $uid2 || $this->stats[$this->uids[${'uid'.$a}]]['yhod'] > 0 ) {
					if( $this->stats[$this->uids[${'uid'.$a}]]['yhod'] > 0 || $mgf == true ) {
						$znbx = $this->stats[$this->uids[$uid1]]['zonb'];
						//echo 2;
					}else{
						$znbx = $this->stats[$this->uids[$uid2]]['zonb'];
						//echo 3;
					}
					while( $i <= $znbx ) {
						$block[$j] = 1;
						$j++;
						if( $j > 5 || $j < 1 ) {
							$j = 1;
						}
						$i++;
					}
				}else{
					//echo '['.$this->atacks[$id]['out' . $a ].'->'.$this->stats[$this->uids[${'uid'.$a}]]['yhod'].'->'.$uid1.'->'.$uid2.']';
					//echo '['.$this->atacks[$id]['out' . $b ].'->'.$this->stats[$this->uids[${'uid'.$b}]]['yhod'].'->'.$uid1.'->'.$uid2.']<br>';
				}
			//Проверка ударов
				$i = 1;
				while( $i <= $this->stats[$this->uids[$uid1]]['zona'] ) {
					if( $atack[$i] > 0 ) {
						if( $block[$atack[$i]] == 1 ) {
							//удар был заблокирован
							// КУДА БИЛ , ТИП УДАРА
							$r['atack'][] = array( $atack[$i] , 3 , 0 );
						}else{
							//Удар прошел
							// КУДА БИЛ , ТИП УДАРА
							$r['atack'][] = array( $atack[$i] , 1 , 0 );
						}
					}
					$i++;
				}
				
				//if( $u->info['admin'] > 0 ) {
				//	print_r($r['atack']);
				//}
				
			return $r;
		}
		
	//Проверка зоны и блока
		public function testRazmenblock1($id,$uid1,$uid2,$atack) {
			$r = false;
			//Проверка блоков
				$i = 1;
				if( $uid1 == $this->atacks[$id]['uid1'] ) {
					$j = $this->atacks[$id]['b2'];
				}elseif( $uid2 == $this->atacks[$id]['uid1'] ) {
					$j = $this->atacks[$id]['b1'];
				}
				if( $this->atacks[$id]['out2'] == 0 ) {
					while( $i <= $this->stats[$this->uids[$uid2]]['zonb'] ) {
						//echo '{'.$j.'}';
						$block[$j] = 1;
						$j++;
						if( $j > 5 || $j < 1 ) {
							$j = 1;
						}
						$i++;
					}
				}
			//Проверка ударов
				if( $atack > 0 ) {
					if( $block[$atack] == 1 ) {
						//удар был заблокирован
						// КУДА БИЛ , ТИП УДАРА
						$r = true;
					}else{
						//Удар прошел
						// КУДА БИЛ , ТИП УДАРА
						$r = false;
					}
				}
			return $r;
		}
		
	//Первичный расчет мф. эффектов (пример)
		public function firstRazmen($id,$at) {
			
			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
			
			$i = 1;
			while( $i <= 2 ) {
				if( $i == 1 ) {
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}
				
				//Расчет уворота Цели от Атакующего
				
					
				$i++;
			}
			
			return $at;
		}
		
	//Проверка ухода удара в игрока
		public function yhod_user( $uid1, $uid2, $type ) {
			// 1 - кто бьет .  2 - в кого бьют . тип
			//Удал летит прямо в противника
			if( $this->import_user == 0 ) {
				$r = $uid1;
				$rand_user = false;
				if( $type == 2 ) {
					//Случайный персонаж из своей команды (в том числе игрок)
					$i = 0;
					while( $i < count( $this->users ) ) {
						if( $this->users[$i]['team'] == $this->users[$this->uids[$uid2]]['team'] ) {
							if( $this->stats[$i]['hpNow'] >= 1 ) {
								$rand_user[] = $this->users[$i]['id'];
							}
						}
						$i++;
					}
				}elseif( $type == 4 ) {
					//Случайный персонаж, любой
					$i = 0;
					while( $i < count( $this->users ) ) {
						//if( $this->users[$i]['team'] == $this->users[$this->uids[$uid1]]['team'] ) {
							if( $this->stats[$i]['hpNow'] >= 1 ) {
								$rand_user[] = $this->users[$i]['id'];
							}
						//}
						$i++;
					}
				}elseif( $type == 5 ) {
					//Случайный персонаж, любой (кроме игрока)
					$i = 0;
					while( $i < count( $this->users ) ) {
						if( $this->users[$i]['team'] == $this->users[$this->uids[$uid2]]['team'] && $uid2 != $this->users[$i]['id'] ) {
							if( $this->stats[$i]['hpNow'] >= 1 ) {
								$rand_user[] = $this->users[$i]['id'];
							}
						}
						$i++;
					}
				}elseif( $type == 6 ) {
					//Случайный персонаж из команды противника
					$i = 0;
					while( $i < count( $this->users ) ) {
						if( $this->users[$i]['team'] != $this->users[$this->uids[$uid2]]['team'] ) {
							if( $this->stats[$i]['hpNow'] >= 1 ) {
								$rand_user[] = $this->users[$i]['id'];
							}
						}
						$i++;
					}
				}elseif( $type > 100 ) {
					//Удар идет в конкретного игрока
					if( !isset($this->users[$this->uids[$type]]) || $this->users[$this->uids[$type]]['id'] != $type ) {
						$r = $uid2;	
					}else{
						$r = $type;
					}
				}
				if( $rand_user != false && count($rand_user) > 0 ) {
					$r = $rand_user[rand(0,( count($rand_user) - 1 ))];
				}
				$this->import_user = $r;
			}else{
				$r = $this->import_user;
			}
			return $r;
		}
		
	//Расчет уворота игроков
		public function mf1Razmen($id,$at,$v) {
			
			global $u;
				
			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
						
			if( $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 0 ) {
				$uid1 = $this->yhod_user($this->atacks[$id]['uid2'],$this->atacks[$id]['uid1'],$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod']);
			}elseif( $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] > 0 ) {
				$uid2 = $this->yhod_user($this->atacks[$id]['uid1'],$this->atacks[$id]['uid2'],$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod']);
			}
			
			$i = 1;
			while( $i <= 2 ) {
				if( $i == 1 ) {
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}
				
				//Расчет уворота Цели (u2) от Атакующего (u1)
				//print_r( $at[$i] );
				$j = 0; $wp01 = 3; $k01 = 0;
				while($j < count($at[$a]['atack']) && $j < 8) {
					// КУДА БИЛ , ТИП УДАРА
					if( $k01 == 0 && isset($this->stats[$this->uids[$u1]]['wp3id']) ) {
						//Левая рука
						$wp01 = 3;
						$k01 = 1;
					}else{
						//Правая рука
						if( isset($this->stats[$this->uids[$u1]]['wp14id']) && $this->stats[$this->uids[$u1]]['items'][$this->stats[$this->uids[$u1]]['wp14id']]['type'] != 13 ) {
							$wp01 = 14;	
						}else{
							if( isset($this->stats[$this->uids[$u1]]['wp3id']) ) {
								$wp01 = 3;
							}else{
								//нет оружия

								$wp01 = 3;
							}
						}
						$k01 = 0;
					}
					$witm01 = 0;
					$witm_type01 = 0;		
					if( $wp01 > 0 ) {
						$witm01 = $this->stats[$this->uids[$u1]]['items'][$this->stats[$this->uids[$u1]]['wp' . $wp01 . 'id']];
						$witm_data01 = $u->lookStats($witm01['data']);
						//$r['wt'] = $witm['type'];
					}
					//
					if( $at[$a]['atack'][$j][2] == $v ) {
						$tyv = $this->mfs( 2 , array( 'mf' => $this->stats[$this->uids[$u2]]['m4'] , 'amf' => $this->stats[$this->uids[$u1]]['m5'] + $witm_data01['sv_m5']  ) );
						if( $tyv == 1 && $this->atacks[$id]['out'.$b] == 0 ) {
							//увернулся, гад :)
							$this->stats[$this->uids[$u1]]['nopryh'] = floor(0+(int)$this->stats[$this->uids[$u1]]['nopryh']);
							if( !isset($this->stats[$this->uids[$u1]]['nopryh']) || $this->stats[$this->uids[$u1]]['nopryh'] <= 0 ) {
								if( isset($this->stats[$this->uids[$u1]]['nopryh['.$j.']']) ) {
									//
								}else{
									$at[$a]['atack'][$j][1] = 2;
								}
							}else{
								$this->stats[$this->uids[$u1]]['nopryh['.$j.']']++;
								$this->stats[$this->uids[$u1]]['nopryh']--;
							}
						}
					}
					$j++;
				}
					
				$i++;
			}
			unset($witm01,$witm_type01,$wp01,$k01);
			
			return $at;
		}
		
	//Расчет крита игроков
		public function mf2Razmen($id,$at,$v) {
			
			global $u;
			
			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
			
			if( $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 0 ) {
				//$uid1 = $this->yhod_user($this->atacks[$id]['uid2'],$this->atacks[$id]['uid1'],$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod']);
			}elseif( $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] > 0 ) {
				$uid2 = $this->yhod_user($this->atacks[$id]['uid1'],$this->atacks[$id]['uid2'],$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod']);
			}
			
			$i = 1;
			while( $i <= 2 ) {
				if( $i == 1 ) {
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}
				
				//Расчет крита Атакующего (u1) по Цели (u2)
				//print_r( $at[$i] );
				$j = 0; $wp01 = 0; $k01 = 0;
				while($j < count($at[$a]['atack']) && $j < 8) {
					// КУДА БИЛ , ТИП УДАРА
					if( $k01 == 0 && isset($this->stats[$this->uids[$u1]]['wp3id']) ) {
						//Левая рука
						$wp01 = 3;
						$k01 = 1;
					}else{
						//Правая рука
						if( isset($this->stats[$this->uids[$u1]]['wp14id']) && $this->stats[$this->uids[$u1]]['items'][$this->stats[$this->uids[$u1]]['wp14id']]['type'] != 13 ) {
							$wp01 = 14;	
						}else{
							if( isset($this->stats[$this->uids[$u1]]['wp3id']) ) {
								$wp01 = 3;
							}else{
								//нет оружия
								$wp01 = 3;
							}
						}
						$k01 = 0;
					}
					$witm01 = 0;
					$witm_type01 = 0;		
					if( $wp01 > 0 ) {
						$witm01 = $this->stats[$this->uids[$u1]]['items'][$this->stats[$this->uids[$u1]]['wp' . $wp01 . 'id']];
						$witm_data01 = $u->lookStats($witm01['data']);
						//$r['wt'] = $witm['type'];
					}
					//
					if( $at[$a]['atack'][$j][2] == $v ) {	
						/*if( $u->info['id'] == 12345 ) {
							echo '['.$u1.' -> '.$u2.']';
						}*/
						if( rand(0,100) > $this->stats[$this->uids[$u2]]['enemy_am1'] && $this->mfs( 1 , array( 'mf' => $this->stats[$this->uids[$u1]]['m1'] + $witm_data01['sv_m1'] , 'amf' => $this->stats[$this->uids[$u2]]['m2']  ) ) == 1 ) {
							//кританул, гад :)
							if( $at[$a]['atack'][$j][1] == 3 ) {
								//в блок
								$at[$a]['atack'][$j][1] = 4;
							}else{
								//обычный крит
								$at[$a]['atack'][$j][1] = 5;
							}
						}
					}
					$j++;
				}
					
				$i++;
			}
			unset($witm01,$witm_type01,$k01,$wp01);
			
			return $at;
		}
		
	//Расчет парирования игроков
		public function mf3Razmen($id,$at,$v) {
			
			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
			
			if( $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 0 ) {
				//$uid1 = $this->yhod_user($this->atacks[$id]['uid2'],$this->atacks[$id]['uid1'],$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod']);
			}elseif( $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] > 0 ) {
				$uid2 = $this->yhod_user($this->atacks[$id]['uid1'],$this->atacks[$id]['uid2'],$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod']);
			}
			
			$i = 1;
			while( $i <= 2 ) {
				if( $i == 1 ) {
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}
				
				//Расчет парирования Цели (u2) от Атакующего (u1)
				//print_r( $at[$i] );
				$j = 0;
				while($j < count($at[$a]['atack']) && $j < 8) {
					// КУДА БИЛ , ТИП УДАРА
					if( $at[$a]['atack'][$j][2] == $v ) {
						if( $this->mfs( 3 , array( '1' => $this->stats[$this->uids[$u2]]['m7'] , '2' => $this->stats[$this->uids[$u1]]['m7'] , 'u1' => $u2 , 'u2' => $u1  ) ) == 1 && $this->atacks[$id]['out'.$b] == 0 ) {
							//увернулся, гад :)
							$this->stats[$this->uids[$u1]]['nopryh'] = floor(0+(int)$this->stats[$this->uids[$u1]]['nopryh']);
							if( !isset($this->stats[$this->uids[$u1]]['nopryh']) || $this->stats[$this->uids[$u1]]['nopryh'] <= 0 ) {
								if( isset($this->stats[$this->uids[$u1]]['nopryh['.$j.']']) ) {
									//
								}else{
									$at[$a]['atack'][$j][1] = 6;
								}
							}else{
								$this->stats[$this->uids[$u1]]['nopryh['.$j.']']++;
								$this->stats[$this->uids[$u1]]['nopryh']--;
							}
						}
					}
					$j++;
				}
					
				$i++;
			}
			
			return $at;
		}
		
	//Расчет блока щитом игроков
		public function mf4Razmen($id,$at,$v) {
			
			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
			
			if( $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 0 ) {
				//$uid1 = $this->yhod_user($this->atacks[$id]['uid2'],$this->atacks[$id]['uid1'],$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod']);
			}elseif( $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] > 0 ) {
				$uid2 = $this->yhod_user($this->atacks[$id]['uid1'],$this->atacks[$id]['uid2'],$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod']);
			}
			
			$i = 1;
			while( $i <= 2 ) {
				if( $i == 1 ) {
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}
				if( $this->stats[$this->uids[$u2]]['sheld1'] > 0 ) {
					//Расчет блока щитом Цели (u2) от Атакующего (u1)
					//print_r( $at[$i] );
					$j = 0;
					while($j < count($at[$a]['atack']) && $j < 8) {
						// КУДА БИЛ , ТИП УДАРА
						if( $at[$a]['atack'][$j][1] != 3 ) {
							if( $at[$a]['atack'][$j][2] == $v ) {
								if( $this->mfs( 5 , ($this->stats[$this->uids[$u2]]['m8']/2) ) == 1 && $this->atacks[$id]['out'.$b] == 0 ) {
									//блокировал щитом, гад :)
									if( !isset($this->stats[$this->uids[$u1]]['nopryh']) || $this->stats[$this->uids[$u1]]['nopryh'] == 0 ) {
										$at[$a]['atack'][$j][1] = 7;
										$this->stats[$this->uids[$u1]]['nopryh']--;
									}
								}
							}
						}
						$j++;
					}
				}
					
				$i++;
			}
			
			return $at;
		}
		
	//Расчет контрудара игроков
		public function mf5Razmen($id,$at,$v) {
						
			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
			
			if( $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 0 ) {
				//$uid1 = $this->yhod_user($this->atacks[$id]['uid2'],$this->atacks[$id]['uid1'],$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod']);
			}elseif( $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] > 0 ) {
				$uid2 = $this->yhod_user($this->atacks[$id]['uid1'],$this->atacks[$id]['uid2'],$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod']);
			}
			
			$i = 1;
			while( $i <= 2 ) {
				if( $i == 1 ) {
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}
				
				//Расчет контрудара Цели (u2) по Атакующему (u1)
				//print_r( $at[$i] );
				$j = 0;
				while($j < count($at[$a]['atack']) && $j < 8) {
					// КУДА БИЛ , ТИП УДАРА
					if( $at[$a]['atack'][$j][2] == $v ) {
						if( $at[$a]['atack'][$j][1] == 2 ) {
							if( $this->mfs( 6 , $this->stats[$this->uids[$u2]]['m6'] ) == 1 ) {
								//контрудар, гад :)
								$at[$a]['atack'][$j][1] = 8;
								$rnd_a = rand(1,5);
								if( $this->testRazmenblock1($id,$u2,$u1,$rnd_a) == false ) {
									$at[$b]['atack'][] = array( $rnd_a , 1 , 1 , 1 );
								}else{
									$at[$b]['atack'][] = array( $rnd_a , 3 , 1 , 1 );
								}
								$at = $this->contrRestart($id,$at,1);
							}
						}
					}
					$j++;
				}
					
				$i++;
			}
			
			return $at;
		}
		
	//Просмотр (для админов)
		public function seeRazmen($id,$at) {
			$r = '';
			
			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
			
			$i = 1;
			while($i <= 2) {
				if( $i == 1 ) {
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}
				
				if( !isset($at[$a]['atack']) ) {
					$r .= 'u1 пропустил свой ход';
				}else{
					$j = 0;
					while($j < count($at[$a]['atack']) && $j < 8) {
						if( $at[$a]['atack'][$j][1] == 1 ) {
							//u1 ударил обычным ударом u2
							$r .= 'u1 ударил обычным ударом u2';
						}elseif( $at[$a]['atack'][$j][1] == 2 ) {
							//u2 увернулся от u1
							$r .= 'u2 увернулся от u1';
						}elseif( $at[$a]['atack'][$j][1] == 3 ) {
							//u2 заблокировал удар u1
							$r .= 'u2 заблокировал удар u1';
						}elseif( $at[$a]['atack'][$j][1] == 4 ) {
							//u1 пробил блок u2 критом
							$r .= 'u1 пробил блок u2 критом';
						}elseif( $at[$a]['atack'][$j][1] == 5 ) {
							//u1 ударил критическим ударом u2
							$r .= 'u1 ударил критическим ударом u2';
						}elseif( $at[$a]['atack'][$j][1] == 6 ) {
							//u2 парировал удар u1
							$r .= 'u2 парировал удар u1';
						}elseif( $at[$a]['atack'][$j][1] == 7 ) {
							//u2 блокировал щитом удар u1
							$r .= 'u2 блокировал щитом удар u1';
						}elseif( $at[$a]['atack'][$j][1] == 8 ) {
							//u2 увернулся от удара u1 и нанес по нему контрудар
							$r .= 'u2 увернулся от удара u1 и нанес по нему контрудар';
						}
						if( $at[$a]['atack'][$j][3] == 1 ) {
							$r .= ' (контрудар)';
						}
						if( isset($at[$a]['atack'][$j]['yron']) ) {
							$r .= ' '.$at[$a]['atack'][$j]['yron']['r'].'';
							if( $at[$a]['atack'][$j]['yron']['w'] == 3 ) {
								$r .= ' (правая рука)';
							}elseif( $at[$a]['atack'][$j]['yron']['w'] == 14 ) {
								$r .= ' (левая рука)';
							}
						}
						if( isset($at[$a]['atack'][$j]['yron']['hp']) ) {
							$r .= ' ['.floor($at[$a]['atack'][$j]['yron']['hp']).'/'.floor($at[$a]['atack'][$j]['yron']['hpAll']).']';
						}
						$r .= ',<br>';
						$j++;
					}
				}
				
				$r = str_replace('u1','<b>'.$this->users[$this->uids[$u1]]['login'].'</b>',$r);
				$r = str_replace('u2','<b>'.$this->users[$this->uids[$u2]]['login'].'</b>',$r);

				$r .= '|<br>';
				$i++;
			}
			
			return $r;
		}
		
	//Выделение из лог текста
		public function addlt( $a , $id , $s , $rnd ) {
			global $log_text;
			if( $rnd == NULL ) {
				$rnd = rand(0,(count($log_text[$s][$id])-1));
			}
			return '{'.$a.'x'.$id.'x'.$rnd.'}';
		}
		
	//Добавляем статистику
		public function addNewStat($stat) {
			mysql_query('INSERT INTO `battle_stat`
			( `battle`,`uid1`,`uid2`,`time`,`type`,`a`,`b`,`ma`,`mb`,`type_a`,`type_b`,`yrn`,`yrn_krit`,`tm1`,`tm2` ) VALUES (
				"'.$this->info['id'].'",
				"'.$stat[1]['uid1'].'",
				"'.$stat[1]['uid2'].'",
				"'.$stat[1]['time'].'",
				"'.$stat[1]['type'].'",
				"'.$stat[1]['a'].'",
				"'.$stat[1]['b'].'",
				"'.$stat[1]['ma'].'",
				"'.$stat[1]['mb'].'",
				"'.$stat[1]['type_a'].'",
				"'.$stat[1]['type_b'].'",
				"'.$stat[1]['yrn'].'",
				"'.$stat[1]['yrn_krit'].'",
				"'.$stat[1]['tm1'].'",
				"'.$stat[1]['tm2'].'"
			)');
			mysql_query('INSERT INTO `battle_stat`
			( `battle`,`uid1`,`uid2`,`time`,`type`,`a`,`b`,`ma`,`mb`,`type_a`,`type_b`,`yrn`,`yrn_krit`,`tm1`,`tm2` ) VALUES (
				"'.$this->info['id'].'",
				"'.$stat[2]['uid1'].'",
				"'.$stat[2]['uid2'].'",
				"'.$stat[2]['time'].'",
				"'.$stat[2]['type'].'",
				"'.$stat[2]['a'].'",
				"'.$stat[2]['b'].'",
				"'.$stat[1]['ma'].'",
				"'.$stat[2]['mb'].'",
				"'.$stat[2]['type_a'].'",
				"'.$stat[2]['type_b'].'",
				"'.$stat[2]['yrn'].'",
				"'.$stat[2]['yrn_krit'].'",
				"'.$stat[2]['tm1'].'",
				"'.$stat[2]['tm2'].'"
			)');
		}
		
	//Добавляем размены в лог
		public function addlogRazmen($id,$at,$ne5) {
			
			global $u;
			
			$r = '';
			
			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
			
			$this->hodID++;
			
			$dies = array(
				1 => 0,
				2 => 0
			);
			
			//массив для статистики
			$stat = array(
				1 => array(
					'uid1' => 0,
					'uid2' => 0,
					'time' => time(),
					'type' => 0,
					'a' => '00000',
					'b' => '0',
					'type_a' => '',
					'type_b' => '0',
					'yrn' => 0,
					'yrn_krit' => 0,
					'ma' => 0,
					'mb' => 0,
					'tm1' => 0,
					'tm2' => 0				
				),
				2 => array(
					'uid1' => 0,
					'uid2' => 0,
					'time' => time(),
					'type' => 0,
					'a' => '00000',
					'b' => '0',
					'type_a' => '',
					'type_b' => '0',
					'yrn' => 0,
					'yrn_krit' => 0,
					'ma' => 0,
					'mb' => 0,
					'tm1' => 0,
					'tm2' => 0
				)
			);
			
			$i = 1;
			while($i <= 2) {
				if( $i == 1 ) {
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}
				
				$u1b = $u1;
				$u2b = $u2;
				
				$yhodtrue = 0;
				
				if( $this->stats[$this->uids[$u1]]['yhod'] > 0 ) {
					//$u1 = $this->yhod_user($u2,$u1,$this->stats[$this->uids[$u1]]['yhod']);
				}elseif( $this->stats[$this->uids[$u2]]['yhod'] > 0 ) {
					$yhodtrue = $u2;
					$u2 = $this->yhod_user($u2,$u1,$this->stats[$this->uids[$u2]]['yhod']);
				}
				
				//if( $u->info['admin'] > 0 ) {
				//	echo '['.$u1.'|'.$u2.']';
				//}
								
				$s1 = $this->users[$this->uids[$u1]]['sex'];
				$s2 = $this->users[$this->uids[$u2]]['sex'];
				
				$stat[$a]['uid1'] = $u1;
				$stat[$a]['uid2'] = $u2;
				$stat[$a]['ma'] = $this->stats[$this->uids[$u1]]['zona'];
				$stat[$a]['mb'] = $this->stats[$this->uids[$u1]]['zonb'];
				$stat[$a]['tm1'] = $this->users[$this->uids[$u1]]['team'];
				$stat[$a]['tm2'] = $this->users[$this->uids[$u2]]['team'];
				$stat[$a]['a'] = $this->atacks[$id]['a'.$a];
				$stat[$a]['b'] = $this->atacks[$id]['b'.$a];
				
				$vLog = 'at1=00000||at2=00000||zb1='.$this->stats[$this->uids[$u1]]['zonb'].'||zb2='.$this->stats[$this->uids[$u2]]['zonb'].'||bl1='.$this->atacks[$id]['b'.$a].'||bl2='.$this->atacks[$id]['b'.$b].'||time1='.$this->atacks[$id]['time'].'||time2='.$this->atacks[$id]['time2'].'||s'.$a.'='.$s1.'||s'.$b.'='.$s2.'||t2='.$this->users[$this->uids[$u2]]['team'].'||t1='.$this->users[$this->uids[$u1]]['team'].'||login1='.$this->users[$this->uids[$u1]]['login2'].'||login2='.$this->users[$this->uids[$u2]]['login2'].'';
				
				$mas = array(
					'text' => '',
					'time' => time(),
					'vars' => '',
					'battle' => $this->info['id'],
					'id_hod' => $this->hodID,
					'vars' => $vLog,
					'type' => 1
				);
				
				if( !isset($at[$a]['atack']) ) {
					if( isset($this->stats[$this->uids[$u1]]['id']) && $this->atacks[$id]['tyman'] == 0 ) {
						if( $this->atacks[$id]['tpo'.$a] == 2 ) {
							$mas['text'] .= '{u1} потратил свой ход на магию.';
						}else{
							$mas['text'] .= '{u1} пропустил свой ход.';
						}
						$mas['text'] = '{tm1} ' . $mas['text'];
						$this->add_log($mas);
					}
				}else{
					$j = 0;
					while($j < count($at[$a]['atack']) && $j < 8) {	
						//
						$mas['text'] = '';
						//
						$wt = array(
							21 => 4,
							22 => 5,
							20 => 2,
							28 => 2,
							19 => 3,
							18 => 1,
							26 => 22
						);
						$par = array(
							'zona' => '{zn2_'.$at[$a]['atack'][$j][0].'} ',
							'kyda' => $this->lg_zon[$at[$a]['atack'][$j][0]][rand(0,(count($this->lg_zon[$at[$a]['atack'][$j][0]])-1))],
							'chem' => $this->lg_itm[$wt[$at[$a]['atack'][$j]['wt']]][rand(0,(count($this->lg_itm[$wt[$at[$a]['atack'][$j]['wt']]])-1))]
						);
						//
						$atkgd = 0;
						//
						if( $at[$a]['atack'][$j][1] == 1 ) {
							//u1 ударил обычным ударом u2
							$mas['text'] .= $par['zona'] . '{u2} ' . $this->addlt($b,1,$s2,NULL) . '' . $this->addlt($b,2,$s2,NULL) . '' . $this->addlt($a,3,$s1,NULL) . ' {u1} ' . $this->addlt($a,4,$s1,NULL) . '' . $this->addlt($a,5,$s1,NULL) . '' . $this->addlt($a,6,$s1,NULL) . ' ' . $this->addlt(1,7,$s1,$at[$a]['atack'][$j]['yron']['t']) . ' '.$par['chem'].' '.$par['kyda'].'. ';
							$atkgd++;
						}elseif( $at[$a]['atack'][$j][1] == 2 ) {
							//u2 увернулся от u1
							$mas['text'] .= $par['zona'] . '{u1} ' . $this->addlt($a,8,$s1,NULL) . '' . $this->addlt($a,9,$s1,NULL) . ' {u2} <b>' . $this->addlt($b,11,$s2,NULL) . '</b> '.$par['chem'].' '.$par['kyda'].'. ';
						}elseif( $at[$a]['atack'][$j][1] == 3 ) {
							//u2 заблокировал удар u1
							$mas['text'] .= $par['zona'] . '{u1} ' . $this->addlt($a,8,$s1,NULL) . '' . $this->addlt($a,9,$s1,NULL) . ' {u2} ' . $this->addlt($b,10,$s2,NULL) . ' ' . $this->addlt(1,7,0,$s1,$at[$a]['atack'][$j]['yron']['t']) . ' '.$par['chem'].' '.$par['kyda'].'. ';
						}elseif( $at[$a]['atack'][$j][1] == 4 ) {
							//u1 пробил блок u2 критом
							$mas['text'] .= $par['zona'] . '{u2} ' . $this->addlt($b,1,$s2,NULL) . '' . $this->addlt($b,2,$s2,NULL) . '' . $this->addlt($a,3,$s1,NULL) . ' {u1} ' . $this->addlt($a,4,$s1,NULL) . '' . $this->addlt($a,5,$s1,NULL) . ', <u>пробив блок</u>, ' . $this->addlt($a,6,$s1,NULL) . ' ' . $this->addlt(1,7,$s1,$at[$a]['atack'][$j]['yron']['t']) . ' '.$par['chem'].' '.$par['kyda'].'. ';
							$atkgd++;
						}elseif( $at[$a]['atack'][$j][1] == 5 ) {
							//u1 ударил критическим ударом u2
							$mas['text'] .= $par['zona'] . '{u2} ' . $this->addlt($b,1,$s2,NULL) . '' . $this->addlt($b,2,$s2,NULL) . '' . $this->addlt($a,3,$s1,NULL) . ' {u1} ' . $this->addlt($a,4,$s1,NULL) . '' . $this->addlt($a,5,$s1,NULL) . '' . $this->addlt($a,6,$s1,NULL) . ' ' . $this->addlt(1,7,$s1,$at[$a]['atack'][$j]['yron']['t']) . ' '.$par['chem'].' '.$par['kyda'].'. ';
							$atkgd++;
						}elseif( $at[$a]['atack'][$j][1] == 6 ) {
							//u2 парировал удар u1
							$mas['text'] .= $par['zona'] . '{u1} ' . $this->addlt($a,8,$s1,NULL) . '' . $this->addlt($a,9,$s1,NULL) . ' {u2} неожиданно <b>парировал</b> ' . $this->addlt(1,7,0,$s1,$at[$a]['atack'][$j]['yron']['t']) . ' '.$par['chem'].' '.$par['kyda'].'. ';
						}elseif( $at[$a]['atack'][$j][1] == 7 ) {
							//u2 блокировал щитом удар u1
							$mas['text'] .= $par['zona'] . '{u1} ' . $this->addlt($a,8,$s1,NULL) . '' . $this->addlt($a,9,$s1,NULL) . ' {u2}, воспользовавшись <b>своим щитом</b>, ' . $this->addlt($b,10,$s2,NULL) . ' ' . $this->addlt(1,7,0,$s1,$at[$a]['atack'][$j]['yron']['t']) . ' '.$par['chem'].' '.$par['kyda'].'. ';
						}elseif( $at[$a]['atack'][$j][1] == 8 ) {
							//u2 увернулся от удара u1 и нанес по нему контрудар
							$mas['text'] .= $par['zona'] . '{u1} ' . $this->addlt($a,8,$s1,NULL) . '' . $this->addlt($a,9,$s1,NULL) . ' {u2} ' . $this->addlt($b,11,$s2,NULL) . ' '.$par['chem'].' '.$par['kyda'].' и нанес <font  style=background:#fdd; color=#000><strong>контрудар</strong></font>. ';
						}
						
						/*if( $yhodtrue > 0 ) {
							$mas['text'] .= '<small>';
							$mas['text'] .= ' (<u>'.$this->stats[$this->uids[$u1]]['login'].'</u> (Защита: '.$this->stats[$this->uids[$u1]]['za'].') наносит удар по <u>'.$this->stats[$this->uids[$u2]]['login'].'</u> (Защита: '.$this->stats[$this->uids[$u2]]['za'].') вместо <u>'.$this->stats[$this->uids[$yhodtrue]]['login'].'</u> (Защита: '.$this->stats[$this->uids[$yhodtrue]]['za'].'))';
							$mas['text'] .= '</small>';
						}*/
						
						if( $atkgd > 0 ) {
							mysql_query('UPDATE `eff_users` SET `hod` = "3" WHERE `delete` = 0 AND `uid` = "'.$u1.'" AND `v1` = "priem" AND `v2` = 239 LIMIT 1');
						}
						
						$stat[$a]['type_a'] .= ''.$at[$a]['atack'][$j][1].'';
						if( (!isset($this->stats[$this->uids[$u2]]['notravma']) || $this->stats[$this->uids[$u2]]['notravma'] == 0 )  && isset($at[$a]['atack'][$j]['yron']['travma']) && $at[$a]['atack'][$j]['yron']['travma'][0] > 0 && floor($at[$a]['atack'][$j]['yron']['hp']) <= 0 ) {
							$tr_pl = mysql_fetch_array(mysql_query('SELECT `id`,`v1` FROM `eff_users` WHERE `id_eff` = 4 AND `uid` = "'.$u2.'" AND `delete` = "0" ORDER BY `v1` DESC LIMIT 1'));
							if( !isset($tr_pl['id']) /*|| $tr_pl['v1'] < 3*/ ) {
								//263
								if( isset($tr_pl['id']) ) {
									$at[$a]['atack'][$j]['yron']['travma'][0] = rand(($tr_pl['v1']+1),3);
								}
								if( $at[$a]['atack'][$j]['yron']['travma'][0] <= 3 ) {
									$mas['text'] = rtrim($mas['text'],'. ');
									$mas['text'] .= ', <font color=red>нанеся противнику <b>';							
									
									if( $this->users[$this->uids[$u2]]['real'] > 0 ) {
										mysql_query('UPDATE `achiev` SET `a10` = `a10` + 1 WHERE `uid` = "'.mysql_real_escape_string($u1).'" LIMIT 1');
									}
									
									if( $at[$a]['atack'][$j]['yron']['travma'][0] == 1 ) {
										$mas['text'] .= 'Легкую';
										$this->addTravm($u2,1,rand(3,5));
									}elseif( $at[$a]['atack'][$j]['yron']['travma'][0] == 2 ) {
										$mas['text'] .= 'Среднюю';
										$this->addTravm($u2,2,rand(3,5));
									}elseif( $at[$a]['atack'][$j]['yron']['travma'][0] == 3 ) {
										$mas['text'] .= 'Тяжелую';
										$this->addTravm($u2,3,rand(3,5));
									}
									$mas['text'] .= ' травму</b></font>. ';	
								}
							}
							unset($tr_pl);
						}
						if( $at[$a]['atack'][$j]['yron']['pb'] == 1 && isset($at[$a]['atack'][$j]['yron']['hp']) ) {
							$mas['text'] = rtrim($mas['text'],'. ');
							$mas['text'] .= ' <i>пробив броню</i>. ';
						}
						if( $at[$a]['atack'][$j][3] == 1 ) {
							//$mas['text'] .= '<font style=background:#fdd; color=red><strong>(контрудар)</strong></font> ';
						}
						if( isset($at[$a]['atack'][$j]['yron']) ) {
							if( $at[$a]['atack'][$j]['yron']['w'] == 3 ) {
								$mas['textWP'] = '(правая&nbsp;рука)';
							}elseif( $at[$a]['atack'][$j]['yron']['w'] == 14 ) {
								$mas['textWP'] = '(левая&nbsp;рука)';
							}else{
								$mas['textWP'] = '(непонятно&nbsp;чем)';
							}
							if( $at[$a]['atack'][$j][1] == 4 || $at[$a]['atack'][$j][1] == 5 || $at[$a]['atack'][$j][1] == 1 ) {
								if( $at[$a]['atack'][$j]['yron']['y'] < 1 ) {
									$at[$a]['atack'][$j]['yron']['r'] = '--';
								}
							}
							if( $at[$a]['atack'][$j][1] == 4 || $at[$a]['atack'][$j][1] == 5 ) {
								$stat[$a]['yrn_krit'] += -$at[$a]['atack'][$j]['yron']['r'];
								$mas['text'] .= ' <font title='.$mas['textWP'].' color=#ff0000><b>'.$at[$a]['atack'][$j]['yron']['r'].'</b></font>';
							}else{
								$mas['text'] .= ' <font title='.$mas['textWP'].' color=#0066aa><b>'.$at[$a]['atack'][$j]['yron']['r'].'</b></font>';
							}
							$stat[$a]['type'] = $at[$a]['atack'][$j]['yron']['t'];
							$stat[$a]['yrn'] += -$at[$a]['atack'][$j]['yron']['r'];
						}
						if( isset($at[$a]['atack'][$j]['yron']['hp']) ) { 
							if($this->users[$this->uids[$u2]]['align']==9){
								$at[$a]['atack'][$j]['yron']['hp'] = $at[$a]['atack'][$j]['yron']['hp']/($at[$a]['atack'][$j]['yron']['hpAll']/100);
								$at[$a]['atack'][$j]['yron']['hpAll'] = '100%';
							}
							$mas['text'] .= ' ['.floor($at[$a]['atack'][$j]['yron']['hp']).'/'.floor($at[$a]['atack'][$j]['yron']['hpAll']).']';
						}
						//
						if( $mas['text'] != '' ) {
							$mas['text'] = '{tm1} ' . $mas['text'];
						}
						/*
						'.$mass['time'].'",
						"'.$mass['battle'].'",
						"'.$mass['id_hod'].'",
						"'.$mass['text'].'",
						"'.$mass['vars'].'",
						"'.$mass['zona1'].'",
						"'.$mass['zonb1'].'",
						"'.$mass['zona2'].'",
						"'.$mass['zonb2'].'",
						"'.$mass['type'].'
						*/
						//
						if( count($at[$a]['atack'][$j]['yron']['plog']) > 0 ) {
							$il = 0;
							while( $il <= count($at[$a]['atack'][$j]['yron']['plog']) ) {
								if( isset($at[$a]['atack'][$j]['yron']['plog'][$il]) ) {
									eval($at[$a]['atack'][$j]['yron']['plog'][$il]);
								}
								$il++;
							}
						}
						$this->add_log($mas);

						$j++;
					}
					
					$u1 = $u1b;
					$u2 = $u2b;					
					
				}
				$i++;
			}
			
			//Добавляем статистику + записываем в баттл_юзерс НР игроков
			$this->addNewStat( $stat );
			
			//Вывод в лог смерти персонажа
			if( $ne5 == false ) {
				if( floor($this->stats[$this->uids[$u1]]['hpNow']) < 1 ) {
					$dies[1] = 1;
				}
				if( floor($this->stats[$this->uids[$u2]]['hpNow']) < 1 && $u1 != $u2 ) {
					$dies[2] = 1;
				}
			}else{				
				$s1 = $this->users[$this->uids[$u1]]['sex'];
				$s2 = $this->users[$this->uids[$u2]]['sex'];				
				$vLog = 'at1=00000||at2=00000||zb1='.$this->stats[$this->uids[$u1]]['zonb'].'||zb2='.$this->stats[$this->uids[$u2]]['zonb'].'||bl1='.$this->atacks[$id]['b'.$a].'||bl2='.$this->atacks[$id]['b'.$b].'||time1='.$this->atacks[$id]['time'].'||time2='.$this->atacks[$id]['time2'].'||s2='.$this->users[$this->uids[$u2]]['sex'].'||s1='.$this->users[$this->uids[$u1]]['sex'].'||t2='.$this->users[$this->uids[$u2]]['team'].'||t1='.$this->users[$this->uids[$u1]]['team'].'||login1='.$this->users[$this->uids[$u1]]['login2'].'||login2='.$this->users[$this->uids[$u2]]['login2'].'';
				$mas = array(
					'text' => '',
					'time' => time(),
					'vars' => '',
					'battle' => $this->info['id'],
					'id_hod' => $this->hodID+1,
					'vars' => $vLog,
					'type' => 1
				);				
				if( floor($this->stats[$this->uids[$u1]]['hpNow']) < 1 ) {
					$tst = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_actions` WHERE `btl` = "'.$this->info['id'].'" AND `uid` = "'.$u1.'" AND `vars` = "priem222" LIMIT 1'));
					//Игрок 1 погиб
					if( $this->stats[$this->uids[$u1]]['spasenie'] > 0 && !isset($tst['id']) ) {
						$mas['text'] = '{tm1} <b>'.$this->stats[$this->uids[$u1]]['login'].'</b> убит...<b title='.$this->stats[$this->uids[$u1]]['hpNow'].'-'.$this->stats[$this->uids[$u1]]['mpNow'].'>'.$this->stats[$this->uids[$u1]]['login'].'</b> был спасен. ';
						$this->add_log($mas);
						$this->dietest = true; 
					}
				}
				if( floor($this->stats[$this->uids[$u2]]['hpNow']) < 1 && $u1 != $u2 ) {
					$tst = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_actions` WHERE `btl` = "'.$this->info['id'].'" AND `uid` = "'.$u2.'" AND `vars` = "priem222" LIMIT 1'));
					//Игрок 2 погиб
					if( $this->stats[$this->uids[$u2]]['spasenie'] > 0 && !isset($tst['id']) ) {
						$mas['text'] = '{tm1} <b>'.$this->stats[$this->uids[$u2]]['login'].'</b> убит...<b title='.$this->stats[$this->uids[$u2]]['hpNow'].'-'.$this->stats[$this->uids[$u2]]['mpNow'].'>'.$this->stats[$this->uids[$u2]]['login'].'</b> был спасен. ';
						$this->add_log($mas);
						$this->dietest = true; 
					}
				}
			}
			if( $dies[1] > 0 || $dies[2] > 0 ) {
				
				$s1 = $this->users[$this->uids[$u1]]['sex'];
				$s2 = $this->users[$this->uids[$u2]]['sex'];
				
				$vLog = 'at1=00000||at2=00000||zb1='.$this->stats[$this->uids[$u1]]['zonb'].'||zb2='.$this->stats[$this->uids[$u2]]['zonb'].'||bl1='.$this->atacks[$id]['b'.$a].'||bl2='.$this->atacks[$id]['b'.$b].'||time1='.$this->atacks[$id]['time'].'||time2='.$this->atacks[$id]['time2'].'||s2='.$this->users[$this->uids[$u2]]['sex'].'||s1='.$this->users[$this->uids[$u1]]['sex'].'||t2='.$this->users[$this->uids[$u2]]['team'].'||t1='.$this->users[$this->uids[$u1]]['team'].'||login1='.$this->users[$this->uids[$u1]]['login2'].'||login2='.$this->users[$this->uids[$u2]]['login2'].'';
				
				$mas = array(
					'text' => '',
					'time' => time(),
					'vars' => '',
					'battle' => $this->info['id'],
					'id_hod' => $this->hodID,
					'vars' => $vLog,
					'type' => 1
				);
	
				$rtngwin = array( 1 , 2 , 3 , 5 , 10 , 20 , 40 , 80 , 160 );
				$rtnglos = array( 0 , 0 , 0 , -1 , -2 , -5 , -10 , -20 , -40 );
				
				if( $dies[1] == 1 ) {
					
					unset($this->stats[$this->uids[$u1]]['dielast']);
					
					if( $this->info['dn_id'] > 0 ) {
						//не дается репутация	
					}else{
						$rtng1 += $rtnglos[$this->users[$this->uids[$u1]]['level']];
						$rtng2 += $rtngwin[$this->users[$this->uids[$u1]]['level']];
					}
					$tst = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_actions` WHERE `btl` = "'.$this->info['id'].'" AND `uid` = "'.$u1.'" AND `vars` = "priem222" LIMIT 1'));
					//Персонаж 1 погиб от рук персонаж 2
					mysql_query('INSERT INTO `battle_die` (`uid`,`time`,`battle`) VALUES ("'.$u1.'","'.time().'","'.$this->info['id'].'")');
					if( $ne5 == false ) {
						mysql_query('DELETE FROM `battle_act` WHERE `uid1` = "'.$u1.'"');
					}
					if( $this->users[$this->uids[$u1]]['tactic7'] <= 0 ) {
						$this->stats[$this->uids[$u1]]['spasenie'] = 0;
					}
					if( $this->stats[$this->uids[$u1]]['spasenie'] > 0 && !isset($tst['id']) ) {
						//Свиток спасения
						mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u1.'" AND `id_eff` = 22 AND `v1` = "priem" AND `v2` = 324');
						//
						$this->stats[$this->uids[$u1]]['hpNow'] = floor($this->stats[$this->uids[$u1]]['hpAll']/2);
						if( $this->stats[$this->uids[$u1]]['hpNow'] < 1 ) {
							$this->stats[$this->uids[$u1]]['hpNow'] = 1;
						}
						if( $this->stats[$this->uids[$u1]]['hpNow'] > $this->stats[$this->uids[$u1]]['hpAll'] ) {
							$this->stats[$this->uids[$u1]]['hpNow'] = floor($this->stats[$this->uids[$u1]]['hpAll']);
						}
						//
						$this->stats[$this->uids[$u1]]['mpNow'] = floor($this->stats[$this->uids[$u1]]['mpAll']/2);
						if( $this->stats[$this->uids[$u1]]['mpNow'] < 1 ) {
							$this->stats[$this->uids[$u1]]['mpNow'] = 1;
						}
						if( $this->stats[$this->uids[$u1]]['mpNow'] > $this->stats[$this->uids[$u1]]['mpAll'] ) {
							$this->stats[$this->uids[$u1]]['mpNow'] = floor($this->stats[$this->uids[$u1]]['mpAll']);
						}
						//
						$this->users[$this->uids[$u1]]['mpNow'] = $this->stats[$this->uids[$u1]]['mpNow'];
						//
						$this->users[$this->uids[$u1]]['tactic7'] -= 10;
						mysql_query('UPDATE `stats` SET `last_hp` = 0 , `tactic7` = "'.$this->users[$this->uids[$u1]]['tactic7'].'" , `hpNow` = "'.$this->stats[$this->uids[$u1]]['hpNow'].'",`mpNow` = "'.$this->stats[$this->uids[$u1]]['mpNow'].'" WHERE `id` = "'.$u1.'" LIMIT 1');
						//
						if( $this->stats[$this->uids[$u1]]['s7'] > 24 ) {
							//Даем призрачку 
							mysql_query("INSERT INTO `eff_users` 
							(`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`) VALUES
							(22, '".$u1."', 'Призрачная защита', '', 0, 77, 0, '".$u1."', 0, 'priem', 141, 'spirit_block25.gif', 1, 1, '0', 0, 0, '', 0, 0, 0, 0, 0);");
						}
						if( $this->stats[$this->uids[$u1]]['s7'] > 99 ) {
							//Смерть очищает вас от негативных эффектов заклинаний, проклятий, болезней и ядов в текущем бою
							
						}
						$mas['text'] = '{tm1} <b>'.$this->stats[$this->uids[$u1]]['login'].'</b> убит...<b title='.$this->stats[$this->uids[$u1]]['hpNow'].'-'.$this->stats[$this->uids[$u1]]['mpNow'].'>'.$this->stats[$this->uids[$u1]]['login'].'</b> был спасен. ';
						$this->add_log($mas);
						$this->dietest = true; 
						//
					}else{
						if(isset($this->stats[$this->uids[$u1]]['login'])) {
							if($this->users[$this->uids[$u1]]['room'] == 9) {
								if( ($this->users[$this->uids[$u1]]['align'] == 1) || ($this->users[$this->uids[$u1]]['align'] == 1 && $this->users[$this->uids[$u2]]['align'] == 1)) {
									mysql_query('UPDATE `achiev` SET `a20` = `a20` + 1 WHERE `uid` = '.$u2.' AND `a20lvl` < 3 LIMIT 1');
								}elseif( ($this->users[$this->uids[$u1]]['align'] == 3) || ($this->users[$this->uids[$u1]]['align'] == 3 && $this->users[$this->uids[$u2]]['align'] == 3) ) {
									mysql_query('UPDATE `achiev` SET `a21` = `a21` + 1 WHERE `uid` = '.$u2.' AND `a21lvl` < 3 LIMIT 1');
								}elseif( ($this->users[$this->uids[$u1]]['align'] == 7) || ($this->users[$this->uids[$u1]]['align'] == 7 && $this->users[$this->uids[$u2]]['align'] == 7) ) {
									mysql_query('UPDATE `achiev` SET `a22` = `a22` + 1 WHERE `uid` = '.$u2.' AND `a22lvl` < 3 LIMIT 1');
								}
							}
							mysql_query('UPDATE `stats` SET `last_hp` = 0 , `hpNow` = "0",`mpNow` = "0" WHERE `id` = "'.$u1.'" LIMIT 1');
							$mas['text'] = '{tm1} <b>'.$this->stats[$this->uids[$u1]]['login'].'</b> погиб.';
							$this->add_log($mas);
						}
					}
				}
				if( $dies[2] == 1 ) {
					
					unset($this->stats[$this->uids[$u2]]['dielast']);
					
					if( $this->info['dn_id'] > 0 ) {
						//не дается репутация	
					}else{
						$rtng1 += $rtngwin[$this->users[$this->uids[$u2]]['level']];
						$rtng2 += $rtnglos[$this->users[$this->uids[$u2]]['level']];
					}
					//Персонаж 2 погиб от рук персонаж 1
					mysql_query('INSERT INTO `battle_die` (`uid`,`time`,`battle`) VALUES ("'.$u2.'","'.time().'","'.$this->info['id'].'")');
					$tst = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_actions` WHERE `btl` = "'.$this->info['id'].'" AND `uid` = "'.$u2.'" AND `vars` = "priem222" LIMIT 1'));
					if( $this->users[$this->uids[$u2]]['tactic7'] <= 0 ) {
						$this->stats[$this->uids[$u2]]['spasenie'] = 0;
					}
					if( $ne5 == false ) {
						mysql_query('DELETE FROM `battle_act` WHERE `uid2` = "'.$u2.'"');
					}
					if( $this->stats[$this->uids[$u2]]['spasenie'] > 0 && !isset($tst['id']) ) {
						//Свиток спасения
						mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$u2.'" AND `id_eff` = 22 AND `v1` = "priem" AND `v2` = 324');
						//
						$this->stats[$this->uids[$u2]]['hpNow'] = floor($this->stats[$this->uids[$u2]]['hpAll']/2);
						if( $this->stats[$this->uids[$u2]]['hpNow'] < 1 ) {
							$this->stats[$this->uids[$u2]]['hpNow'] = 1;
						}
						if( $this->stats[$this->uids[$u2]]['hpNow'] > $this->stats[$this->uids[$u2]]['hpAll'] ) {
							$this->stats[$this->uids[$u2]]['hpNow'] = floor($this->stats[$this->uids[$u2]]['hpAll']);
						}
						//
						$this->stats[$this->uids[$u2]]['mpNow'] = floor($this->stats[$this->uids[$u2]]['mpAll']/2);
						if( $this->stats[$this->uids[$u2]]['mpNow'] < 1 ) {
							$this->stats[$this->uids[$u2]]['mpNow'] = 1;
						}
						if( $this->stats[$this->uids[$u2]]['mpNow'] > $this->stats[$this->uids[$u2]]['mpAll'] ) {
							$this->stats[$this->uids[$u2]]['mpNow'] = floor($this->stats[$this->uids[$u2]]['mpAll']);
						}
						//
						$this->users[$this->uids[$u2]]['tactic7'] -= 10;
						mysql_query('UPDATE `stats` SET `last_hp` = 0 , `tactic7` = "'.$this->users[$this->uids[$u2]]['tactic7'].'" , `hpNow` = "'.$this->stats[$this->uids[$u2]]['hpNow'].'",`mpNow` = "'.$this->stats[$this->uids[$u2]]['mpNow'].'" WHERE `id` = "'.$u2.'" LIMIT 1');
						//
						$this->users[$this->uids[$u2]]['mpNow'] = $this->stats[$this->uids[$u2]]['mpNow'];
						//
						if( $this->stats[$this->uids[$u2]]['s7'] > 24 ) {
							//Даем призрачку 
							mysql_query("INSERT INTO `eff_users` 
							(`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`) VALUES
							(22, '".$u2."', 'Призрачная защита', '', 0, 77, 0, '".$u2."', 0, 'priem', 141, 'spirit_block25.gif', 1, 1, '0', 0, 0, '', 0, 0, 0, 0, 0);");
						}
						if( $this->stats[$this->uids[$u2]]['s7'] > 99 ) {
							//Смерть очищает вас от негативных эффектов заклинаний, проклятий, болезней и ядов в текущем бою
							
						}
						$mas['text'] = '{tm1} <b>'.$this->stats[$this->uids[$u2]]['login'].'</b> убит...<b title='.$this->stats[$this->uids[$u2]]['hpNow'].'-'.$this->stats[$this->uids[$u2]]['mpNow'].' >'.$this->stats[$this->uids[$u2]]['login'].'</b> был спасен. ';
						$this->add_log($mas);
						$this->dietest = true; 
						//
					}else{
						if(isset($this->stats[$this->uids[$u2]]['login'])) {
							if($this->users[$this->uids[$u2]]['room'] == 9) {
								if( ($this->users[$this->uids[$u2]]['align'] == 1) || ($this->users[$this->uids[$u2]]['align'] == 1 && $this->users[$this->uids[$u1]]['align'] == 1)) {
									mysql_query('UPDATE `achiev` SET `a20` = `a20` + 1 WHERE `uid` = '.$u1.' AND `a20lvl` < 3 LIMIT 1');
								}elseif( ($this->users[$this->uids[$u2]]['align'] == 3) || ($this->users[$this->uids[$u2]]['align'] == 3 && $this->users[$this->uids[$u1]]['align'] == 3)) {
									mysql_query('UPDATE `achiev` SET `a21` = `a21` + 1 WHERE `uid` = '.$u1.' AND `a21lvl` < 3 LIMIT 1');
								}elseif( ($this->users[$this->uids[$u2]]['align'] == 7) || ($this->users[$this->uids[$u2]]['align'] == 7 && $this->users[$this->uids[$u1]]['align'] == 7)) {
									mysql_query('UPDATE `achiev` SET `a22` = `a22` + 1 WHERE `uid` = '.$u1.' AND `a22lvl` < 3 LIMIT 1');
								}
							}
							mysql_query('UPDATE `stats` SET `last_hp` = 0 , `hpNow` = "0",`mpNow` = "0" WHERE `id` = "'.$u2.'" LIMIT 1');
							$mas['text'] = '{tm1} <b>'.$this->stats[$this->uids[$u2]]['login'].'</b> погиб.';
							$this->add_log($mas);
						}
					}					
				}
				//Записываем рейтинг
				if( $this->info['typeBattle'] == 99 ) {
					$rtng1 = $rtng1*2;
					$rtng2 = $rtng2*2;
					if( $this->info['razdel'] == 5 ) {
						if( $rtng1 < 0 ) {
							$rtng1 = 0;
						}
						if( $rtng2 < 0 ) {
							$rtng2 = 0;
						}
					}
				}
				//
				if( $this->stats[$this->uids[$u1]]['inTurnir'] == 0 && $this->stats[$this->uids[$u2]]['inTurnir'] == 0 && $this->info['dn_id'] == 0 && $this->info['izlom'] == 0 ) {
					if( $this->users[$this->uids[$u2]]['bot'] == 0 ) {
						$rtng = mysql_fetch_array(mysql_query('SELECT * FROM `users_rating` WHERE `uid` = "'.$u1.'" LIMIT 1'));
						if(!isset($rtng['id'])) {
							mysql_query('INSERT INTO `users_rating` (`uid`,`rating`,`time`) VALUES (
								"'.$u1.'","'.$rtng1.'","'.time().'"
							)');
						}else{
							$rtng['rating'] += $rtng1;
							mysql_query('UPDATE `users_rating` SET `rating` = "'.$rtng['rating'].'",`time` = "'.time().'" WHERE `uid` = "'.$u1.'" LIMIT 1');
						}
					}
					unset($rtng);
					if( $this->users[$this->uids[$u1]]['bot'] == 0 ) {
						$rtng = mysql_fetch_array(mysql_query('SELECT * FROM `users_rating` WHERE `uid` = "'.$u2.'" LIMIT 1'));
						if(!isset($rtng['id'])) {
							mysql_query('INSERT INTO `users_rating` (`uid`,`rating`,`time`) VALUES (
								"'.$u2.'","'.$rtng2.'","'.time().'"
							)');
						}else{
							$rtng['rating'] += $rtng2;
							mysql_query('UPDATE `users_rating` SET `rating` = "'.$rtng['rating'].'",`time` = "'.time().'" WHERE `uid` = "'.$u2.'" LIMIT 1');
						}
					}
				}
				unset($rtng1,$rtng2);
			}
			
			return true;
		}
		
	//Добавляем в лог действия приема
		public function priemAddLog($id,$a,$b,$u1,$u2,$prm,$text,$hodID,$tm1 = 0, $tm2 = 0) {
			if( $tm1 == 0 ) {
				if(isset($this->atacks[$id])) {
					$tm1 = $this->atacks[$id]['time'];
				}else{
					$tm1 = time();
				}
			}
			if( $tm2 == 0 ) {
				if(isset($this->atacks[$id])) {
					$tm2 = $this->atacks[$id]['time2'];
				}else{
					$tm2 = time();
				}
			}
			$vLog = 'prm='.$prm.'||at1=00000||at2=00000||zb1='.$this->stats[$this->uids[$u1]]['zonb'].'||zb2='.$this->stats[$this->uids[$u2]]['zonb'].'||bl1='.$this->atacks[$id]['b'.$a].'||bl2='.$this->atacks[$id]['b'.$b].'||time1='.$tm1.'||time2='.$tm2.'||s'.$a.'='.$this->users[$this->uids[$u1]]['sex'].'||s'.$b.'='.$this->users[$this->uids[$u2]]['sex'].'||t2='.$this->users[$this->uids[$u2]]['team'].'||t1='.$this->users[$this->uids[$u1]]['team'].'||login1='.$this->users[$this->uids[$u1]]['login2'].'||login2='.$this->users[$this->uids[$u2]]['login2'].'';	
			$mas = array(
				'text' => $text,
				'time' => time(),
				'vars' => '',
				'battle' => $this->info['id'],
				'id_hod' => $hodID,
				'vars' => $vLog,
				'type' => 1
			);
			$this->add_log($mas);	
		}
		
	//Добавляем в лог действия приема (без атаки)
		public function priemAddLogFast($u1,$u2,$prm,$text,$hodID,$tm) {
			$vLog = 'prm='.$prm.'||time1='.$tm.'||time2='.$tm.'||s1='.$this->users[$this->uids[$u1]]['sex'].'||s2='.$this->users[$this->uids[$u2]]['sex'].'||t2='.$this->users[$this->uids[$u2]]['team'].'||t1='.$this->users[$this->uids[$u1]]['team'].'||login1='.$this->users[$this->uids[$u1]]['login2'].'||login2='.$this->users[$this->uids[$u2]]['login2'].'';	
			$mas = array(
				'text' => $text,
				'time' => time(),
				'vars' => '',
				'battle' => $this->info['id'],
				'id_hod' => ($this->hodID + $hodID),
				'vars' => $vLog,
				'type' => 1
			);
			$this->add_log($mas);	
		}
	
	//Считаем контру
		public function contrRestart($id,$at,$v) {
			//крит
			$at = $this->mf2Razmen($id,$at,$v);
			//уворот
			$at = $this->mf1Razmen($id,$at,$v);
			//парирование
			$at = $this->mf3Razmen($id,$at,$v);
			//блок щитом (если есть щит, конечно)
			$at = $this->mf4Razmen($id,$at,$v);
			//контрудар
			//$at = $this->mf5Razmen($id,$at,$v);
			//Проверяем урон
			$at = $this->yronRazmen($id,$at,true);
			
			return $at;
		}
		
	//Расчитываем статы для конкретной зоны атаки
		public function yronGetrazmenStats( $s , $z ) {
			global $u;
			/*
			1     - шлем
			2     - наручи
			3     - оружие (правая рука)
			4     - рубаха
			5     - броня
			6     - плащ
			7     - пояс
			8     - серьги
			9     - амулет
			10-12 - кольца
			13    - перчатки
			14    - оружие / щит (левая рука)
			16    - поножи
			17    - ботинки
			*/
			$zi = array( //Предметы влияющие на зоны
				1 => array( 1 , 8 , 9 , 52 ), //голова
				2 => array( 4 , 5 , 6 ), //грудь
				3 => array( 2 , 4 , 5 , 6 , 13 ), //живот
				4 => array( 7 , 16 , 10 , 11 , 12 ), //пояс
				5 => array( 17 )  //ноги
			);
			//
			$zi = $zi[$z];
			$i = 0;
			//
			while( $i < count($zi) ) {
				//
				$t = $u->items['add'];
				$ii = 0;
				//
				while( $ii < count($s['items']) ) {
					if( isset($s['items'][$ii]) && $s['items'][$ii]['inOdet'] == $zi[$i] ) {
						$po = $u->lookStats($s['items'][$ii]['data']);
						//
						$x = 0;
						while( $x < count($t) ) {
							$n = $t[$x];
							if(isset($po['sv_'.$n])) {
								$s[$n] += $po['sv_'.$n];
								if( $n == 'za' ) {
									$iii = 1;
									while($iii <= 4) {
										$s['za'.$iii] += $po['sv_'.$n];
										$iii++;
									}
								}elseif( $n == 'zm' ) {
									$iii = 1;
									while($iii <= 4) {
										$s['zm'.$iii] += $po['sv_'.$n];
										$iii++;
									}
								}elseif( $n == 'zma' ) {
									$iii = 1;
									while($iii <= 7) {
										$s['zma'.$iii] += $po['sv_'.$n];
										$iii++;
									}
								}
							}
							$x++;	
						}
						//
					}
					$ii++;
				}
				//
				$i++;
			}
			//
			return $s;
		}
		
	//Расчитываем ед. урона
		public function yronGetrazmen( $uid1,$uid2,$wp,$zona,$yhod ) {
			global $u;
			$ditest = array();
			//$oldst1 = $this->stats[$this->uids[$uid1]];
			//$oldst2 = $this->stats[$this->uids[$uid2]];	
			//Получаем статы игрока 1 и 2 для конкретной зоны
			//$this->stats[$this->uids[$uid1]] = $this->yronGetrazmenStats( $this->stats[$this->uids[$uid1]] , $zona );
			//$this->stats[$this->uids[$uid2]] = $this->yronGetrazmenStats( $this->stats[$this->uids[$uid2]] , $zona );
			//$this->a_save_stats($uid1);
			//$this->a_save_stats($uid2);
			//
			//$this->a_testing_stats($uid1,$zona);
			//$this->a_testing_stats($uid2,$zona);
			//
			if( $yhod == 1 ) {
				/*
				if( $this->stats[$this->uids[$u1]]['yhod'] > 0 ) {
					//$u1 = $this->yhod_user($u2,$u1,$this->stats[$this->uids[$u1]]['yhod']);
				}elseif( $this->stats[$this->uids[$u2]]['yhod'] > 0 ) {
					$u2 = $this->yhod_user($u2,$u1,$this->stats[$this->uids[$u2]]['yhod']);
				}
				*/				
				//OLD
				/*$uid1_rl = $uid1;
				$uid2_rl = $uid2;
				$uid2 = $uid1_rl;				
				*/
				//NEW
				
				$uid1_rl = $uid1;
				$uid2_rl = $uid2;
				$uid2 = $this->yhod_user($uid2,$uid1,$this->stats[$this->uids[$uid2]]['yhod']);
				
			}
			
			$r = array(
				'y' => 0,
				'r' => '--'
			);			
			//Определяем тип урона
			/*
				Колющий
				Рубящий
				Режущий
				Дробящий
			*/
			$witm = 0;
			$witm_type = 0;


			if( $wp > 0 ) {
				$witm = $this->stats[$this->uids[$uid1]]['items'][$this->stats[$this->uids[$uid1]]['wp' . $wp . 'id']];
				$witm_data = $u->lookStats($witm['data']);
				$witm_type = $this->weaponTx($witm);
				//$r['wt'] = $witm['type'];
			}
			if( $witm_type == 0 || $witm_type == 12 ) {
				$witm_type2 = '';
			}else{

				$witm_type2 = $witm_type;
			}
			$r['t'] = $witm_type2;
			//Расчет брони
			/*
				голова
				грудь
				живот
				пояс
				ноги
			*/
			$bron = array(
				1 => array( $this->stats[$this->uids[$uid2]]['mib1'] , $this->stats[$this->uids[$uid2]]['mab1'] ),
				2 => array( $this->stats[$this->uids[$uid2]]['mib2'] , $this->stats[$this->uids[$uid2]]['mab2'] ),
				3 => array( $this->stats[$this->uids[$uid2]]['mib2'] , $this->stats[$this->uids[$uid2]]['mab2'] ),
				4 => array( $this->stats[$this->uids[$uid2]]['mib3'] , $this->stats[$this->uids[$uid2]]['mab3'] ),
				5 => array( $this->stats[$this->uids[$uid2]]['mib4'] , $this->stats[$this->uids[$uid2]]['mab4'] )
			);
			//
			//Увеличиваем параметры от текущего оружия которым бьем
			//$witm_data 
			$iii = 1;
			while($iii <= 7) {
				if(isset($witm_data['sv_a'.$iii]) && $witm_data['sv_a'.$iii] != 0) {
					$this->stats[$this->uids[$uid1]]['a'.$iii] += $witm_data['sv_a'.$iii];
				}
				if(isset($witm_data['sv_mg'.$iii]) && $witm_data['sv_mg'.$iii] != 0) {
					$this->stats[$this->uids[$uid1]]['mg'.$iii] += $witm_data['sv_mg'.$iii];
				}
				$iii++;
			}
			$iii = 1;
			while($iii <= 4) {
				if(isset($witm_data['sv_aall']) && $witm_data['sv_aall'] != 0) {
					$this->stats[$this->uids[$uid1]]['a'.$iii] += $witm_data['sv_aall'];
				}
				$iii++;
			}
			$iii = 1;
			while($iii <= 4) {
				if(isset($witm_data['sv_mall']) && $witm_data['sv_mall'] != 0) {
					$this->stats[$this->uids[$uid1]]['mg'.$iii] += $witm_data['sv_mall'];
				}
				$iii++;
			}
			$iii = 1;
			while($iii <= 7) {
				if(isset($witm_data['sv_m2all']) && $witm_data['sv_m2all'] != 0) {
					$this->stats[$this->uids[$uid1]]['mg'.$iii] += $witm_data['sv_m2all'];
				}
				$iii++;
			}
			
			if(isset($witm_data['sv_m3']) && $witm_data['sv_m3'] != 0) {
				$this->stats[$this->uids[$uid1]]['m3'] += $witm_data['sv_m3'];
			}
			
			$iii = 1;
			while($iii <= 7) {
				if(isset($witm_data['sv_pa'.$iii]) && $witm_data['sv_pa'.$iii] != 0) {
					$this->stats[$this->uids[$uid1]]['pa'.$iii] += $witm_data['sv_pa'.$iii]+$witm_data['sv_m10'];
				}
				if(isset($witm_data['sv_pm'.$iii]) && $witm_data['sv_pm'.$iii] != 0) {
					$this->stats[$this->uids[$uid1]]['pm'.$iii] += $witm_data['sv_pm'.$iii]+$witm_data['sv_m11a'];
					if( $iii < 5 ) {
						$this->stats[$this->uids[$uid1]]['pm'.$iii] += $witm_data['sv_m11'];
					}
				}
				$iii++;
			}
			//
			//мощность + подавление мощности противником
			$wAp = 0;
			$w3p  = 0;
			$w14p = 0;
			if($witm_type==12) {
				//удар кулаком
				$wAp += $this->stats[$this->uids[$uid1]]['m10'];
				if($this->users[$this->uids[$uid1]]['align']==7) {
					$wAp += 15;
				}
			}elseif($witm_type < 5) {
				$wAp += $this->stats[$this->uids[$uid1]]['pa'.$witm_type.''] + $this->stats[$this->uids[$uid1]]['m10'] + $witm_data['sv_pa'.$witm_type.''];
				$wAp -= $this->stats[$this->uids[$uid2]]['antpa'.$witm_type.''];

			}else{
				$wAp += $this->stats[$this->uids[$uid1]]['pm'.($witm_type-4).''] + $this->stats[$this->uids[$uid1]]['m11a'] + $witm_data['sv_pm'.($witm_type-4).''];
				$wAp -= $this->stats[$this->uids[$uid2]]['antpm'.($witm_type-4).''];
			}
			//

			//
			//Владение данным оружием
			$vladenie = 0;
						
			//Пробой брони
			$proboi = 0;
			if( $this->mfs(4, $witm_data['sv_m9']) == 1 ) {
				$proboi = $witm_data['sv_m9'];
				$r['pb'] = 1;
			}
			
			
			
			$y = $this->yrn(
				//$st1, $st2, $u1, $u2, $level, $level2, $type, $min_yron, $max_yron, $min_bron, $max_bron,
				//$vladenie, $power_yron, $power_krit, $zashita, $ozashita, $proboi, $weapom_damage
				$this->stats[$this->uids[$uid1]],
				$this->stats[$this->uids[$uid2]],
				$this->users[$this->uids[$uid1]],
				$this->users[$this->uids[$uid2]],
				$this->users[$this->uids[$uid1]]['level'],
				$this->users[$this->uids[$uid2]]['level'],
				//
				$witm_type,
				$this->stats[$this->uids[$uid1]]['minAtack'], //мин. урон (добавочный)
				$this->stats[$this->uids[$uid1]]['maxAtack'], //макс. урон

				$bron[$zona][0], //броня мин.
				$bron[$zona][1], //броня макс
				//
				$vladenie, //владения
				(($wAp + $w3p + $w14p)*0.70), //мощность урона
				($this->stats[$this->uids[$uid1]]['m3']*0.70), //мощность крита
				(($this->stats[$this->uids[$uid2]]['za' . $witm_type2]) - $this->stats[$this->uids[$uid1]]['pza'] + $this->yronLvl($this->users[$this->uids[$uid1]]['level'],$this->users[$this->uids[$uid2]]['level'])), //защита от урона
				$this->stats[$this->uids[$uid1]]['ozash'], //подавление защиты
				$proboi, //пробой брони
				0, //хз
				($witm_data['sv_yron_min']+$this->stats[$this->uids[$uid1]]['yron_min']),
				($witm_data['sv_yron_max']+$this->stats[$this->uids[$uid1]]['yron_max']),
				$this->stats[$this->uids[$uid2]]['zaproc'],
				$this->stats[$this->uids[$uid2]]['zmproc'],
				(($this->stats[$this->uids[$uid2]]['zm' . ($witm_type2-4)]) - $this->stats[$this->uids[$uid1]]['pzm'] + $this->yronLvl($this->users[$this->uids[$uid1]]['level'],$this->users[$this->uids[$uid2]]['level'])), //защита от урона
				$this->stats[$this->uids[$uid1]]['omzash'], //подавление защиты
				$witm['type']
			);		
			
			$r['y'] = round(rand($y['min'],$y['max']));
			$r['k'] = round(rand($y['Kmin'],$y['Kmax']));
			
			$r['m_y'] = $y['max'];
			$r['m_k'] = $y['Kmax'];
			
			$r['bRND'] = $y['bRND'];
			
			$r['w_type'] = $witm_type;
			
			//Если второе оружие - урон ниже на 50%
			$wp1 = $this->stats[$this->uids[$uid1]]['items'][$this->stats[$this->uids[$uid1]]['wp3id']];
			$wp2 = $this->stats[$this->uids[$uid1]]['items'][$this->stats[$this->uids[$uid1]]['wp14id']];
			/*if( $wp == 14 ) {				
				if( $wp1['level'] > $wp2['level'] ) {
					$r['y'] = floor( $r['y'] * 0.5 );
					$r['k'] = floor( $r['k'] * 0.5 );
				}
			}elseif( $wp == 3 ) {			
				if( $wp2['level'] > $wp1['level'] ) {
					$r['y'] = floor( $r['y'] * 0.5 );
					$r['k'] = floor( $r['k'] * 0.5 );
				}
			}*/
			
			if( $r['y'] < 1 ) {
				$r['y'] = 1;
			}			
			if( $r['k'] < 1 ) {
				$r['k'] = 1;
			}	
			//$this->a_restart_stats($uid1,1);
			//$this->a_testing_stats($uid2,1);	
			return $r;
		}
		
	//Считаем урон
		public function yronRazmen($id,$at,$pat = false) {
						
			if( $pat == true ) {
				$pat = $at;
				$at = $pat['p'];
			}else{
				unset($pat);
			}
						
			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
			
			if( $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 0 ) {
				$yhod = array( 1 => 1 , 2 => 0 );
				//$uid1 = $this->yhod_user($this->atacks[$id]['uid2'],$this->atacks[$id]['uid1'],$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod']);
			}elseif( $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] > 0 ) {
				$yhod = array( 1 => 0 , 2 => 1 );
				//$uid2 = $this->yhod_user($this->atacks[$id]['uid1'],$this->atacks[$id]['uid2'],$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod']);
			}
			
			$i = 1;
			while( $i <= 2 ) {
				if( $i == 1 ) {
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}
				

				//Считаем свойства от предметов
				
				
				//Расчет удара (u2) по (u1)
				//print_r( $at[$i] );
				$j = 0; $k = 0; $wp = 3;
				while($j < count($at[$a]['atack']) && $j < 8) {
					// КУДА БИЛ , ТИП УДАРА
					if( $k == 0 && isset($this->stats[$this->uids[$u1]]['wp3id']) ) {
						//Левая рука
						$wp = 3;
						$k = 1;
					}else{
						//Правая рука
						if( isset($this->stats[$this->uids[$u1]]['wp14id']) && $this->stats[$this->uids[$u1]]['items'][$this->stats[$this->uids[$u1]]['wp14id']]['type'] != 13 ) {

							$wp = 14;	
						}else{
							if( isset($this->stats[$this->uids[$u1]]['wp3id']) ) {
								$wp = 3;
							}else{
								//нет оружия
								$wp = 3;
							}
						}
						$k = 0;
					}
					if( $wp > 0 ) {
						$witm = $this->stats[$this->uids[$u1]]['items'][$this->stats[$this->uids[$u1]]['wp' . $wp . 'id']];
						$witm_type = $this->weaponTx($witm);
						$at[$a]['atack'][$j]['wt'] = $witm['type'];
					}
					//
					$at[$a]['atack'][$j]['yhod'] = $yhod[$a];					
					//
					if( !isset($at[$a]['atack'][$j]['yron']) && (
						$at[$a]['atack'][$j][1] == 1 ||
						$at[$a]['atack'][$j][1] == 4 ||
						$at[$a]['atack'][$j][1] == 5 )
					) {
							//
							$at[$a]['atack'][$j]['yron'] = $this->yronGetrazmen($u1,$u2,$wp,$at[$a]['atack'][$j][0],$yhod[$b]);
							if( $at[$a]['atack'][$j][1] == 4 ) {
								$at[$a]['atack'][$j]['yron']['y_old'] = $at[$a]['atack'][$j]['yron']['y'];
								$at[$a]['atack'][$j]['yron']['y'] = round($at[$a]['atack'][$j]['yron']['k']/2);
							}elseif( $at[$a]['atack'][$j][1] == 5 ) {
								$at[$a]['atack'][$j]['yron']['y_old'] = $at[$a]['atack'][$j]['yron']['y'];
								$at[$a]['atack'][$j]['yron']['y'] = $at[$a]['atack'][$j]['yron']['k'];
							}
							$at[$a]['atack'][$j]['yron']['2h'] = $witm['2h'];
							$at[$a]['atack'][$j]['yron']['w'] = $wp;
							if( $at[$a]['atack'][$j]['yron']['y'] < 1 ) {
								$at[$a]['atack'][$j]['yron']['r'] = '--';
							}else{
								$at[$a]['atack'][$j]['yron']['r'] = '-' . $at[$a]['atack'][$j]['yron']['y'];
							}
							//
					}else{
							//
							$at[$a]['atack'][$j]['block'] = $this->yronGetrazmen($u1,$u2,$wp,$at[$a]['atack'][$j][0],$yhod[$b]);
							if( $at[$a]['atack'][$j][1] == 4 ) {
								$at[$a]['atack'][$j]['block']['y_old'] = $at[$a]['atack'][$j]['block']['y'];
								$at[$a]['atack'][$j]['block']['y'] = round($at[$a]['atack'][$j]['block']['k']/2);
							}elseif( $at[$a]['atack'][$j][1] == 5 ) {
								$at[$a]['atack'][$j]['block']['y_old'] = $at[$a]['atack'][$j]['block']['y'];
								$at[$a]['atack'][$j]['block']['y'] = $at[$a]['atack'][$j]['block']['k'];
							}
							$at[$a]['atack'][$j]['block']['2h'] = $witm['2h'];
							$at[$a]['atack'][$j]['block']['w'] = $wp;
							if( $at[$a]['atack'][$j]['block']['y'] < 1 ) {
								$at[$a]['atack'][$j]['block']['r'] = '--';
							}else{
								$at[$a]['atack'][$j]['block']['r'] = '-' . $at[$a]['atack'][$j]['block']['y'];
							}
							//
					}
					$j++;
				}
					
				$i++;
			}
			
			if( isset($pat) && $pat != false ) {
				$pat['p'] = $at;
				$at = $pat;
			}
			
			return $at;
		}
		
	//Обновление здоровья
		public function updateHealth($id,$at,$ne5) {
			
			global $priem;
			
			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
			$uid_o1 = $this->atacks[$id]['uid1'];
			$uid_o2 = $this->atacks[$id]['uid2'];
			
			if( $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 0 ) {
				$uid1 = $this->yhod_user($this->atacks[$id]['uid2'],$this->atacks[$id]['uid1'],$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod']);
			}elseif( $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] > 0 ) {
				$uid2 = $this->yhod_user($this->atacks[$id]['uid1'],$this->atacks[$id]['uid2'],$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod']);
			}
			
			$i = 1;
			while( $i <= 2 ) {
				if( $i == 1 ) {
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}
						
				//Рассчет дополнительных тактик
				if( $this->users[$this->uids[$u2]]['animal2'] > 0 ) {
							
				}elseif( $this->atacks[$id]['out'.$b] > 0 ) {
					//Игрок ${'u'.$a} получает тактики, возможно
					if( rand(0,100) < min(floor($this->stats[$this->uids[$u1]]['m6']/5),20) ) {
						//выдаем тактику контрудара
						//$this->users[$this->uids[$u1]]['tactic3']++;
					}
					if( rand(0,100) < min(floor($this->stats[$this->uids[$u1]]['m8']/4),20) ) {
						//выдаем тактику щита
						//$this->users[$this->uids[$u1]]['tactic4']++;
					}
				}
								
				//Расчет удара Цели (u2) по Атакующему (u1)
				//print_r( $at[$i] );
				$j = 0; $k = 0; $wp = 3;
				while($j < count($at[$a]['atack']) && $j < 8 ) {
					//Добавляем тактики
					//$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['tactic1']
					if( $at[$a]['atack'][$j][1] == 1 ) {
						//u1 ударил обычным ударом u2
						if( $this->users[$this->uids[$u2]]['animal2'] > 0 ) {
														
						}elseif( !isset($this->stats[$this->uids[$u1]]['notactic']) || $this->stats[$this->uids[$u1]]['notactic'] == 0 ) {
							$this->users[$this->uids[$u1]]['tactic1']++;
							//Двуручка
							if( $at[$a]['atack'][$j]['yron']['2h'] == 1 ) {
								$this->users[$this->uids[$u1]]['tactic1'] += 2;
							}
						}
					}elseif( $at[$a]['atack'][$j][1] == 2 ) {
						//u2 увернулся от u1
					}elseif( $at[$a]['atack'][$j][1] == 3 ) {
						//u2 заблокировал удар u1
						if( $this->users[$this->uids[$u1]]['animal2'] > 0 ) {
							
						}elseif( !isset($this->stats[$this->uids[$u2]]['notactic']) || $this->stats[$this->uids[$u2]]['notactic'] == 0 ) {
							$this->users[$this->uids[$u2]]['tactic4']++;
						}
					}elseif( $at[$a]['atack'][$j][1] == 4 ) {
						//u1 пробил блок u2 критом
						if( $this->users[$this->uids[$u2]]['animal2'] > 0 ) {
							
						}elseif( !isset($this->stats[$this->uids[$u1]]['notactic']) || $this->stats[$this->uids[$u1]]['notactic'] == 0 ) {
							$this->users[$this->uids[$u1]]['tactic2']++;
						}
					}elseif( $at[$a]['atack'][$j][1] == 5 ) {
						//u1 ударил критическим ударом u2
						if( $this->users[$this->uids[$u2]]['animal2'] > 0 ) {
							
						}elseif( !isset($this->stats[$this->uids[$u1]]['notactic']) || $this->stats[$this->uids[$u1]]['notactic'] == 0 ) {
							$this->users[$this->uids[$u1]]['tactic2'] += 2;
							//Двуручка
							if( $at[$a]['atack'][$j]['yron']['2h'] == 1 ) {
								$this->users[$this->uids[$u1]]['tactic2'] += 1;
							}
						}
					}elseif( $at[$a]['atack'][$j][1] == 6 ) {
						//u2 парировал удар u1
						if( $this->users[$this->uids[$u1]]['animal2'] > 0 ) {
							
						}elseif( !isset($this->stats[$this->uids[$u2]]['notactic']) || $this->stats[$this->uids[$u2]]['notactic'] == 0 ) {
							$this->users[$this->uids[$u2]]['tactic5']++;
						}
					}elseif( $at[$a]['atack'][$j][1] == 7 ) {
						//u2 блокировал щитом удар u1						
					}elseif( $at[$a]['atack'][$j][1] == 8 ) {
						//u2 увернулся от удара u1 и нанес по нему контрудар
						if( $this->users[$this->uids[$u1]]['animal2'] > 0 ) {
							
						}elseif( !isset($this->stats[$this->uids[$u2]]['notactic']) || $this->stats[$this->uids[$u2]]['notactic'] == 0 ) {
							$this->users[$this->uids[$u2]]['tactic3']++;
						}
					}
					// КУДА БИЛ , ТИП УДАРА
					if( isset($at[$a]['atack'][$j]['yron']) && (
					$at[$a]['atack'][$j][1] == 1 ||
					$at[$a]['atack'][$j][1] == 4 ||
					$at[$a]['atack'][$j][1] == 5 )) {
						//
						if( $at[$a]['atack'][$j]['yron']['y'] < 0 ) {
							$at[$a]['atack'][$j]['yron']['y'] = 1;
							$at[$a]['atack'][$j]['yron']['r'] = -1;
							$at[$a]['atack'][$j]['yron']['k'] = 1;
						}
						//Отнимаем НР
						$this->stats[$this->uids[$u2]]['hpNow'] -= $at[$a]['atack'][$j]['yron']['y'];
						$this->users[$this->uids[$u2]]['last_hp'] = -$at[$a]['atack'][$j]['yron']['y'];
						//Добавляем нанесенный урон и опыт
						//$this->users[$this->uids[$u1]]['battle_yron'] += $at[$a]['atack'][$j]['yron']['y'];
						$this->takeExp( $u1, $at[$a]['atack'][$j]['yron']['y'], $u1, $u2) ;
						
						//echo '['.$u1.' -> '.$u2.']';
						$at[$a]['atack'][$j]['yron']['hp'] = $this->stats[$this->uids[$u2]]['hpNow'];
						if( $at[$a]['atack'][$j]['yron']['hp'] < 1 ) {
							$at[$a]['atack'][$j]['yron']['hp'] = 0;
						}
						$at[$a]['atack'][$j]['yron']['hpAll'] = $this->stats[$this->uids[$u2]]['hpAll'];
						if( $at[$a]['atack'][$j]['yron']['hp'] > $at[$a]['atack'][$j]['yron']['hpAll'] ) {
							$at[$a]['atack'][$j]['yron']['hp'] = $at[$a]['atack'][$j]['yron']['hpAll'];
						}
						//
						//Травмирование
						if( $at[$a]['atack'][$j][1] == 4 || $at[$a]['atack'][$j][1] == 5 ) {
							if( !isset($at[$a]['atack'][$j]['yron']['travma']) && rand(0,1000) < 500 ) {
								$trvm_chns = floor(rand(0,200)/10);
								if( $trvm_chns > 3 || $trvm_chns < 1 ) {
									$trvm_chns = 0;
								}
								$at[$a]['atack'][$j]['yron']['travma'] = array( $trvm_chns , 'Обыкновенная травма' );
								unset($trvm_chns);
							}
						}
					}
					$j++;
				}
					
				$i++;
			}
			
			/*
			if( $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 0 ) {
				$priem->testDie($uid1);
			}elseif( $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] > 0 ) {
				$priem->testDie($uid2);
			}
			*/
			if( $ne5 == false ) {
				$priem->testDie($uid1,$uid2);
				$priem->testDie($uid1,$uid2);
				if( $uid1 != $uid_o1 ) {
					$priem->testDie($uid_o1);
				}
				if( $uid2 != $uid_o2 ) {
					$priem->testDie($uid_o2);
				}				
			}
			
			return $at;
		}
		
	//Добавляем новую статистику игрока
		public function addstatuser($id) {
			if( $id > 0 ) {
				$uid = $id;
				$id = $this->uids[$uid];
				mysql_query('INSERT INTO `battle_users`
					( `battle`,`uid`,`time_enter`,`login`,`level`,`align`,`clan`,`hpAll`,`hp`,`team` )
				VALUES
				(
					"'.$this->info['id'].'",
					"'.$uid.'",
					"'.time().'",
					"'.$this->users[$id]['login'].'",
					"'.$this->users[$id]['level'].'",
					"'.$this->users[$id]['align'].'",
					"'.$this->users[$id]['clan'].'",
					"'.$this->stats[$id]['hpAll'].'",
					"'.$this->stats[$id]['hp'].'",
					"'.$this->users[$id]['team'].'"
				)');
			}
		}
		
	//Проверяем приемы
		public function priemsRazmen($id, $at) {
			if( $at == 'fast' ) {
				$uid1 = $id[0];
				$uid2 = $id[1];
			}else{
				$uid1 = $this->atacks[$id]['uid1'];
				$uid2 = $this->atacks[$id]['uid2'];
			}
			$i = 1;
			if( $uid1 == $uid2 ) {
				$i = 2;
			}
			while( $i <= 2 ) {
				if( $i == 1 ) {
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}
				
				//Получаем приемы и смотрим когда какой действует
				$eff = $this->stats[$this->uids[$u1]]['effects'];
				$this->stats[$this->uids[$u1]]['u_priem'] = array();
				$j = 0;				
				while( $j <= count($eff) ) {
					if( isset($eff[$j]) && $eff[$j]['id_eff'] == 22 && $eff[$j]['v1'] == 'priem' && $eff[$j]['v2'] > 0 ) {
						$this->stats[$this->uids[$u1]]['u_priem'][] = array( $j , $eff[$j]['v2'] , $this->prm[$eff[$j]['v2']]['act'] , $eff[$j]['id'] , $this->prm[$eff[$j]['v2']]['type_of'] , $this->prm[$eff[$j]['v2']]['moment'] , $this->prm[$eff[$j]['v2']]['moment_end'] , $this->prm[$eff[$j]['v2']]['type_sec'] );
						$this->stats[$this->uids[$u1]]['u_priemUse'][$eff[$j]['v2']]++;
					}
					$j++;
				}

				$i++;
			}
			//
		}
		
	//Приемы которые используются моментально
		public function priemsRazmenMoment( $id, $at ) {
			
			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
			
			$i = 1;
			if( $uid1 == $uid2 ) {
				$i = 2;
			}
			while( $i <= 2 ) {
				
				if( $i == 1 ) {
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}				
				if( !isset($at['p']['p_cast']) ) {
					$at['p'] = $at;
					$at['p']['p_cast'] = true;
				}
				//
				
				//Приемы ухода от удара
				if(!isset($this->stats[$this->uids[$u2]]['nopryh']) || $this->stats[$this->uids[$u2]]['nopryh'] == 0) {
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
						if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0  && $this->stats[$this->uids[$u1]]['u_priem'][$j][5] == 1 ) {							
							if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
								$pr_used_this = $u1;
								$pr_moment = true;
								require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
								$at = $fx_priem($id,$at,$u1,$j);
								unset(${'fx_priem'});
								$this->stats[$this->uids[$u2]]['nopryh']--;
							}
						}
						$j++;
					}
				}
				//Приемы крита
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][5] == 2 ) {
						if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
							$pr_used_this = $u1;
							$pr_moment = true;
							require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
							$at = $fx_priem($id,$at,$u1,$j);
							unset(${'fx_priem'});
						}
					}
					$j++;
				}
				//Приемы атаки
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][5] == 3 ) {
						if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
							$pr_used_this = $u1;
							$pr_moment = true;
							require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
							if( isset($fx_priem) ) {
								$at = $fx_priem($id,$at,$u1,$j);
							}
							unset(${'fx_priem'});
						}
					}
					$j++;
				}
				//Приемы защиты
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][5] == 4 ) {
						if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
							$pr_used_this = $u1;
							$pr_moment = true;
							require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
							$at = $fx_priem($id,$at,$u1,$j);
							unset(${'fx_priem'});
						}
					}
					$j++;
				}
				//Прочие приемы
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][5] == 5 ) {
						if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
							$pr_used_this = $u1;
							$pr_moment = true;
							require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
							$at = $fx_priem($id,$at,$u1,$j);
							unset(${'fx_priem'});
						}
					}
					$j++;
				}
				//
				$i++;
			}
			//
			return $at;
		}

	//Приемы которые используются моментально (в конце хода)
		public function priemsRazmenMomentEnd( $id, $at ) {
			
			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
			
			$i = 1;
			if( $uid1 == $uid2 ) {
				$i = 2;
			}
			while( $i <= 2 ) {
				
				if( $i == 1 ) {
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}				
				if( !isset($at['p']['p_cast']) ) {
					$at['p'] = $at;
					$at['p']['p_cast'] = true;
				}
				//
				
				//Приемы ухода от удара
				if(!isset($this->stats[$this->uids[$u2]]['nopryh']) || $this->stats[$this->uids[$u2]]['nopryh'] == 0) {
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
						if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0  && $this->stats[$this->uids[$u1]]['u_priem'][$j][6] == 1 ) {
							if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
								$pr_used_this = $u1;
								$pr_moment = true;
								require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
								$at = $fx_priem($id,$at,$u1,$j);
								unset(${'fx_priem'});
								$this->stats[$this->uids[$u2]]['nopryh']--;
							}
						}
						$j++;
					}
				}
				//Приемы крита
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][6] == 2 ) {
						if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
							$pr_used_this = $u1;
							$pr_moment = true;
							require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
							$at = $fx_priem($id,$at,$u1,$j);
							unset(${'fx_priem'});
						}
					}
					$j++;
				}
				//Приемы атаки
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][6] == 3 ) {
						if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
							if( !isset($this->stats[$this->uids[$u1]]['tuman']) ) {
								$pr_used_this = $u1;
								$pr_moment = true;
								require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
								if(isset($fx_priem)) {
									$at = $fx_priem($id,$at,$u1,$j);
									unset(${'fx_priem'});
								}		
							}
						}
					}
					$j++;
				}
				//Приемы защиты
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][6] == 4 ) {
						if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
							$pr_used_this = $u1;
							$pr_moment = true;
							require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
							$at = $fx_priem($id,$at,$u1,$j);
							unset(${'fx_priem'});
						}
					}
					$j++;
				}
				//Прочие приемы
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][6] == 5 ) {
						if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
							$pr_used_this = $u1;
							$pr_moment = true;
							require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
							$at = $fx_priem($id,$at,$u1,$j);
							unset(${'fx_priem'});
						}
					}
					$j++;
				}
				//
				$i++;
			}
			//
			return $at;
		}

		
	//Используем приемы
		public $nohodpriem = array(
			273 => true ,
			286 => true ,
			287 => true ,
			288 => true ,
			213 => true
		);
		public function priemsTestRazmen( $id, $at ) {
			
			global $u;
			
			$uid1b = $this->atacks[$id]['uid1'];
			$uid2b = $this->atacks[$id]['uid2'];
			
			$uid1 = $this->atacks[$id]['uid1'];
			$uid2 = $this->atacks[$id]['uid2'];
				
			/*if( $this->stats[$this->uids[$uid1]]['yhod'] > 0 ) {
				//$uid1 = $this->yhod_user($uid1,$uid2,$this->stats[$this->uids[$uid1]]['yhod']);
			}				
			if( $this->stats[$this->uids[$uid2]]['yhod'] > 0 ) {
				$uid2 = $this->yhod_user($uid2,$uid1,$this->stats[$this->uids[$uid2]]['yhod']);
			}*/	
			
			$i = 1;
			if( $uid1 == $uid2 ) {
				$i = 2;
			}
			while( $i <= 2 ) {
				if( $i == 1 ) {
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}
				
				$u1b = $u1;
				$u2b = $u2;
				
				
				
				if( $this->stats[$this->uids[$u1]]['yhod'] > 0 ) {
					//$u1 = $this->yhod_user($u1,$u2,$this->stats[$this->uids[$u1]]['yhod']);
				}
							
				//if( $u->info['admin'] > 0 || $this->info['id'] == 1055097 ) {
					if( $this->stats[$this->uids[$u2]]['yhod'] > 0 ) {
						$u2 = $this->yhod_user($u2,$u1,$this->stats[$this->uids[$u2]]['yhod']);
						$this->import_user = 0;
					}
				//}
				
				if( !isset($at['p']['p_cast']) ) {
					$at['p'] = $at;
					$at['p']['p_cast'] = true;
				}
				
				//Приемы ухода от удара
				/*
				if( $this->stats[$this->uids[$u1]]['yhod'] > 0 ) {
					$u1 = $this->yhod_user($u2,$u1,$this->stats[$this->uids[$u1]]['yhod']);
				}elseif( $this->stats[$this->uids[$u2]]['yhod'] > 0 ) {
					$u2 = $this->yhod_user($u1,$u2,$this->stats[$this->uids[$u2]]['yhod']);
				}
				*/
				if(!isset($this->stats[$this->uids[$u2]]['nopryh']) || $this->stats[$this->uids[$u2]]['nopryh'] == 0) {
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
						if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0  && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 1 ) {
							if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
								//if( $this->stats[$this->uids[$u2]]['yhod'] > 0 ) {
									
								//}else{
									$pr_used_this = $u1;
									require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
									$at = $fx_priem($id,$at,$u1,$j);
									unset(${'fx_priem'});
									$this->stats[$this->uids[$u2]]['nopryh']--;
								//}
							}
						}
						$j++;
					}
				}
				//$u1 = $u1b;
				//$u2 = $u2b;
				//Приемы крита
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 2 ) {
						if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
							//if( $this->stats[$this->uids[$u2]]['yhod'] > 0 ) {
								
							//}else{
								$pr_used_this = $u1;
								require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
								$at = $fx_priem($id,$at,$u1,$j);
								unset(${'fx_priem'});
							//}
						}
					}
					$j++;
				}
				//Приемы атаки
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 3 ) {
						if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
							//if( $this->stats[$this->uids[$u2]]['yhod'] > 0 ) {
									
							//}else{
								$pr_used_this = $u1;
								require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
								if( isset($fx_priem) ) {
									$at = $fx_priem($id,$at,$u1,$j);
								}
								unset(${'fx_priem'});
							//}
						}
					}
					$j++;
				}
				//
				if( $this->stats[$this->uids[$u2]]['yhod'] > 0 ) {
					
					
					//$u2 = $this->yhod_user($u1,$u2,$this->stats[$this->uids[$u2]]['yhod']);
					/*$u2 = $u1;
					$this->atacks[$id]['uid1'] = $u2;
					$this->atacks[$id]['uid2'] = $u2;

					//Приемы защиты
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u2]]['u_priem'] ) ) {
						if( $this->stats[$this->uids[$u2]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u2]]['u_priem'][$j][4] == 4 ) {
							if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php')) {
								//if( $this->stats[$this->uids[$u1]]['yhod'] > 0 && !isset($this->nohodpriem[$this->stats[$this->uids[$u1]]['u_priem'][$j][1]]) ) {
										
								//}else{
									$pr_used_this = $u2;
									require('priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php');
									if( isset($fx_priem) ) {
										$at = $fx_priem($id,$at,$u2,$j);
									}
									unset(${'fx_priem'});
								//}
							}
						}
						$j++;
					}
					$u1 = $u1b;
					$u2 = $u2b;
					$this->atacks[$id]['uid1'] = $u1;
					$this->atacks[$id]['uid2'] = $u2;
					*/
					
				}
				
				//
				//Приемы защиты
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 4 ) {
						if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
							//if($u->info['id'] == 12345 ) {
							//	echo '<br>'.$u1.'>'.$u2.'>'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'>'.$this->stats[$this->uids[$u1]]['u_priem'][$j][3].'>'.$this->stats[$this->uids[$u1]]['yhod'].'';
							//}
							if( ($this->stats[$this->uids[$u1]]['yhod'] > 0 && $u1 != $u2) && !isset($this->nohodpriem[$this->stats[$this->uids[$u1]]['u_priem'][$j][1]]) ) {
								
							}else{
								//
								//if( $u->info['admin'] > 0 || $this->info['id'] == 1055097 ) {
									if( $u1 != $u1b || $u2 != $u2b ) {
										$this->atacks[$id]['uid'.$a] = $u1;
										$this->atacks[$id]['uid'.$b] = $u2;
									}
									//echo '[@'.$u1b.'|'.$u2b.'|'.$u1.'|'.$u2.'@]';
								//}
								//
								$pr_used_this = $u1;
								require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
								if( isset($fx_priem) ) {
									$at = $fx_priem($id,$at,$u1,$j);
								}
								//
								//if( $u->info['admin'] > 0 || $this->info['id'] == 1055097 ) {
									if( $u1 != $u1b || $u2 != $u2b ) {
										if( $at['p'][$a]['priems']['kill'][$u1][$j] > 0 ) {
											//echo '[!delete_eff!]';
											//print_r($this->stats[$this->uids[$u1]]['u_priem'][$j]);
											//
											mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `id` = "'.$this->stats[$this->uids[$u1]]['u_priem'][$j][3].'" AND `uid` = "'.$u1.'" LIMIT 1');
											unset($this->stats[$this->uids[$u1]]['u_priem'][$j]);
											//
											$this->stats[$this->uids[$u1]]['um_priem'][$j] = true;
											//
										}
										$this->atacks[$id]['uid'.$a] = $u1b;
										$this->atacks[$id]['uid'.$b] = $u2b;
									}
									//echo '['.$u1b.'|'.$u2b.'|'.$u1.'|'.$u2.']';
								//}
								//
								unset(${'fx_priem'});
							}
						}
					}
					$j++;
				}
				//
				//Прочие приемы
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 5 ) {
						if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
							if( $this->stats[$this->uids[$u1]]['yhod'] > 0 && !isset($this->nohodpriem[$this->stats[$this->uids[$u1]]['u_priem'][$j][1]]) ) {
									
							}else{
								$pr_used_this = $u1;
								require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
								if( isset($fx_priem) ) {
									$at = $fx_priem($id,$at,$u1,$j);
								}
								unset(${'fx_priem'});
							}
						}
					}
					$j++;
				}
				//Прочие приемы
				/*$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 8 ) {
						if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
							$pr_used_this = $u1;
							require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
							$at = $fx_priem($id,$at,$u1,$j);
							unset(${'fx_priem'});
						}
					}
					$j++;
				}*/
				
				$u1 = $u1b;
				$u2 = $u2b;
					
				$i++;
			}
			
			$i = 1;
			if( $uid1 == $uid2 ) {
				$i = 2;
			}
			while( $i <= 2 ) {
				if( $i == 1 ) {
					$a = 1;
					$b = 2;
					$u1 = ${'uid1'};
					$u2 = ${'uid2'};
				}else{
					$a = 2;
					$b = 1;
					$u1 = ${'uid2'};
					$u2 = ${'uid1'};
				}
				
				if( !isset($at['p']['p_cast']) ) {
					$at['p'] = $at;
					$at['p']['p_cast'] = true;
				}
				
				//Прочие приемы
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 8 ) {
						if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
							if( $this->stats[$this->uids[$u1]]['yhod'] > 0 && !isset($this->nohodpriem[$this->stats[$this->uids[$u1]]['u_priem'][$j][1]]) ) {
									
							}else{
								$pr_used_this = $u1;
								require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
								$at = $fx_priem($id,$at,$u1,$j);
								unset(${'fx_priem'});
							}
						}
					}
					$j++;
				}
				
				//Прочие приемы
				$j = 0;
				while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
					if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 9 ) {
						if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
							//if( $this->stats[$this->uids[$u2]]['yhod'] > 0 ) {
									
							//}else{
								$pr_used_this = $u1;
								require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');

								$at = $fx_priem($id,$at,$u1,$j);
								unset(${'fx_priem'});
							//}
						}
					}
					$j++;
				}
					
				$i++;
			}

			return $at;
		}
		
	//Повторная проверка приемов
		public function priemsRestartRazmen( $id, $at ) {
			if( isset($at['p']) ) {
				//
				//Проверка
				$uid1 = $this->atacks[$id]['uid1'];
				$uid2 = $this->atacks[$id]['uid2'];
				
				/*
					Если возникнут проблемы с приемами, придется переписать алгоритм, сейчас он выглядит так:					
						Цикл 1. Проверяем пользователя
						Цикл 2 внутри Цикла 1. Проверяем приемы поторые пользователь использовал
					Придется сделать:
						Цикл 1. Проверяем пользователя
						Цикл 2 внутри Цикла 1. Проверяем приемы уворота
						Цикл 3. Проверяем пользователя
						Цикл 4 внутри Цикла 3. Проверяем приемы крита
						и т.д.
				*/
				
				$i = 1;
				if( $uid1 == $uid2 ) {
					$i = 2;
				}
				while( $i <= 2 ) {
					if( $i == 1 ) {
						$a = 1;
						$b = 2;
						$u1 = ${'uid1'};
						$u2 = ${'uid2'};
					}else{
						$a = 2;
						$b = 1;
						$u1 = ${'uid2'};
						$u2 = ${'uid1'};
					}
					
					if( !isset($at['p']['p_cast']) ) {
						$at['p'] = $at;
						$at['p']['p_cast'] = true;
					}
					
					//Приемы ухода от удара
					if(!isset($this->stats[$this->uids[$u2]]['nopryh']) || $this->stats[$this->uids[$u2]]['nopryh'] == 0) {
						$j = 0;
						while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
							if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0  && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 1 ) {
								if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
									//if( $this->stats[$this->uids[$u2]]['yhod'] > 0 ) {
										
									//}else{
										$pr_tested_this = $u1;
										require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
										$at = $fx_priem($id,$at,$u1,$j);
										unset(${'fx_priem'});
										$this->stats[$this->uids[$u2]]['nopryh']--;
									//}
								}
							}
							$j++;
						}
					}
					//Приемы крита
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
						if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 2 ) {
							if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
								//if( $this->stats[$this->uids[$u2]]['yhod'] > 0 ) {
									
								//}else{
									$pr_tested_this = $u1;
									require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
									$at = $fx_priem($id,$at,$u1,$j);
									unset(${'fx_priem'});
								//}
							}
						}
						$j++;
					}
					//Приемы атаки
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
						if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 3 ) {
							if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
								//if( $this->stats[$this->uids[$u2]]['yhod'] > 0 ) {
									
								//}else{
									$pr_tested_this = $u1;
									require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
									$at = $fx_priem($id,$at,$u1,$j);
									unset(${'fx_priem'});
								//}
							}
						}
						$j++;
					}
					//Приемы защиты
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
						if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 4 ) {
							if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
								if( $this->stats[$this->uids[$u1]]['yhod'] > 0 && !isset($this->nohodpriem[$this->stats[$this->uids[$u1]]['u_priem'][$j][1]]) ) {
									
								}else{
									$pr_tested_this = $u1;
									require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
									$at = $fx_priem($id,$at,$u1,$j);
									unset(${'fx_priem'});
								}
							}
						}
						$j++;
					}
					//Прочие приемы
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
						if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 5 ) {
							if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
								if( $this->stats[$this->uids[$u1]]['yhod'] > 0 && !isset($this->nohodpriem[$this->stats[$this->uids[$u1]]['u_priem'][$j][1]]) ) {
									
								}else{
									$pr_tested_this = $u1;
									require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
									$at = $fx_priem($id,$at,$u1,$j);
									unset(${'fx_priem'});
								}
							}
						}
						$j++;
					}
					//Прочие приемы
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u2]]['u_priem'] ) ) {
						if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u2]]['u_priem'][$j][4] == 8 ) {
							if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php')) {
								//if( $this->stats[$this->uids[$u2]]['yhod'] > 0 ) {
									
								//}else{
									$pr_tested_this = $u2;
									require('priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php');
									$at = $fx_priem($id,$at,$u2,$j);
									unset(${'fx_priem'});
								//}
							}
						}
						$j++;
					}
					//Прочие приемы
					$j = 0;
					while( $j <= count( $this->stats[$this->uids[$u2]]['u_priem'] ) ) {
						if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u2]]['u_priem'][$j][4] == 9 ) {
							if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php')) {
								//if( $this->stats[$this->uids[$u2]]['yhod'] > 0 ) {
									
								//}else{
									$pr_tested_this = $u2;
									require('priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php');
									$at = $fx_priem($id,$at,$u2,$j);
									unset(${'fx_priem'});
								//}
							}
						}
						$j++;
					}
						
					$i++;
				}
				//
				$at = $at['p'];				
				unset($at['p']);	
			}
			return $at;
		}
		
	//Проверка урон приемов над защитными
		public function testYronPriemAttack( $pid , $u1 , $u2 , $hp ) {
			
			//Игрок 1 бьет по Игроку 2 при помощи приема № pid на hp ед. здоровья
			
			/*
				Полная защита
			*/
			//Получаем приемы и смотрим когда какой действует
			$eff = $this->stats[$this->uids[$u2]]['effects'];
			$j = 0;				
			while( $j <= count($eff) ) {
				if( isset($eff[$j]) && $eff[$j]['id_eff'] == 22 && $eff[$j]['v1'] == 'priem' && $eff[$j]['v2'] > 0 ) {
					// id прием $eff[$j]['v2']
					if( $eff[$j]['v2'] == 140 || $eff[$j]['v2'] == 45 || $eff[$j]['v2'] == 211 ) {
						//Приемы от которых урон = 1 , то есть выдаем 0
						$hp['y'] = -1;
						$hp['r'] = 1;
						$hp['k'] = 2;
						$hp['m_y'] = 1;
						$hp['m_k'] = 2;	
					}
				}
				$j++;
			}
			unset($eff);
			
			return $hp;
		}
		
	//Проверка урон приемов над защитными
		public function testYronPriemAttackYK( $pid , $u1 , $u2 , $hp ) {
			
			//Игрок 1 бьет по Игроку 2 при помощи приема № pid на hp ед. здоровья
			
			/*
				Полная защита
			*/
			//Получаем приемы и смотрим когда какой действует
			$eff = $this->stats[$this->uids[$u2]]['effects'];
			$j = 0;				
			while( $j <= count($eff) ) {
				if( isset($eff[$j]) && $eff[$j]['id_eff'] == 22 && $eff[$j]['v1'] == 'priem' && $eff[$j]['v2'] > 0 ) {
					// id прием $eff[$j]['v2']
					if( $eff[$j]['v2'] == 140 || $eff[$j]['v2'] == 45 || $eff[$j]['v2'] == 211 ) {
						//Приемы от которых урон = 1 , то есть выдаем 0
						$hp['y'] = -1;
						$hp['r'] = 1;	
					}
				}
				$j++;
			}
			unset($eff);
			
			return $hp;
		}

	public function deleffm($pid , $uid , $id) {
		if( $id > 0 ) {
			if(!mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.mysql_real_escape_string($id).'" AND `v1` = "priem" AND `v2` != "0" LIMIT 1')) {
				echo '[*Ошибка удаления прием['.$id.','.$pid.','.$uid.']]';
			}
		}else{
			if(!mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.mysql_real_escape_string($uid).'" AND `v1` = "priem" AND `v2` = "'.$pid.'"')) {

			}
		}
		//echo '['.$id.','.$pid.','.$uid.']';
	}
		
	//Проверка урона приемов
		public $um_priem  = array();
		public function testYronPriem( $uid1, $uid2, $priem, $yron, $profil, $stabil, $test = false, $inlog = 0 ) {
			/*
				profil = {
					-1 - урон оружием
					-2 - урон магией
					 0 - неизвестно
					 1-4  - профильный оружия
					 5-12 - профильный магия
				}
				stabil - урон не подвержен мощностям и т.д
			*/
			//Проверка
			$a = 1;
			$b = 2;
			$u1 = ${'uid1'};
			$u2 = ${'uid2'};
			
			if( $this->stats[$this->uids[$u2]]['zmproc'] > 0 ) {
				$yron = floor($yron/100*(100-$this->stats[$this->uids[$u2]]['zmproc']));
				if( $yron < 1 ) {
					$yron = 1;
				}
			}
			
			//Проверяем приемы защиты игрока $u1 на урон игрока $u2
			//Получаем приемы и смотрим когда какой действует
			if(!isset($this->stats[$this->uids[$u2]]['u_priem'])) {
				$eff = $this->stats[$this->uids[$u2]]['effects'];
				$j = 0;				
				while( $j <= count($eff) ) {
					if( isset($eff[$j]) && $eff[$j]['id_eff'] == 22 && $eff[$j]['v1'] == 'priem' && $eff[$j]['v2'] > 0 ) {
						$this->stats[$this->uids[$u2]]['u_priem'][] = array( $j , $eff[$j]['v2'] , $this->prm[$eff[$j]['v2']]['act'] , $eff[$j]['id'] , $this->prm[$eff[$j]['v2']]['type_of'] , $this->prm[$eff[$j]['v2']]['moment'] );
					}
					$j++;
				}
				unset($eff);
			}
			//Приемы защиты
			$j = 0;
			while( $j <= count( $this->stats[$this->uids[$u2]]['u_priem'] ) ) {
				if( $this->stats[$this->uids[$u2]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u2]]['u_priem'][$j][4] == 4 ) {
					if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php')) {
						//if( $test == false ) {
						//
						$pr_momental_this = $u2;
						require('priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php');
						$yron = $fx_moment($u2,$u1,$j,$yron,$profil);
						unset(${'fx_moment'});
						//
						/*}else{
							echo '[('.$u2.')';
							print_r($this->stats[$this->uids[$u2]]['um_priem']);
							echo '!]';
							echo '[USED:'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].']';
						}*/
					}
				}
				$j++;
			}
			
			//Прочие приемы
			$j = 0;
			while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
				if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][4] == 5 ) {
					if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
						$pr_momental_this = $u1;
						require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
						if( isset($fx_moment) ) {
							$yron = $fx_moment($u1,$u2,$j,$yron,$profil,$inlog);
						}
						unset(${'fx_moment'});
						/*$pr_tested_this = $u1;
						require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
						$at = $fx_priem($id,$at,$u1,$j);
						unset(${'fx_priem'});*/
					}
				}
				$j++;
			}
			
			//Прочие приемы (влияет на урон от моментальных приемов)
			$j = 0;
			while( $j <= count( $this->stats[$this->uids[$u1]]['u_priem'] ) ) {
				if( $this->stats[$this->uids[$u1]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u1]]['u_priem'][$j][7] == 5 ) {
					if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php')) {
						$pr_momental_this_seven = $u1;
						require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
						if( isset($fx_moment_seven) ) {
							$yron = $fx_moment_seven($u1,$u2,$j,$yron,$profil,$inlog);
						}
						unset(${'fx_moment_seven'});
					}
				}
				$j++;
			}
			
			//Прочие приемы
			$j = 0;
			while( $j <= count( $this->stats[$this->uids[$u2]]['u_priem'] ) ) {
				if( $this->stats[$this->uids[$u2]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u2]]['u_priem'][$j][4] == 8 ) {
					if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php')) {
						$pr_momental_this = $u2;
						require('priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php');
						if( isset($fx_moment) ) {
							$yron = $fx_moment($u2,$u1,$j,$yron,$profil,$inlog);
						}
						unset(${'fx_moment'});
						/*$pr_tested_this = $u1;
						require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
						$at = $fx_priem($id,$at,$u1,$j);
						unset(${'fx_priem'});*/
					}
				}
				if( $this->stats[$this->uids[$u2]]['u_priem'][$j][2] > 0 && $this->stats[$this->uids[$u2]]['u_priem'][$j][4] == 9 ) {
					if(file_exists('../../_incl_data/class/priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php')) {
						$pr_momental_this = $u2;
						require('priem/'.$this->stats[$this->uids[$u2]]['u_priem'][$j][1].'.php');
						if( isset($fx_moment) ) {
							$yron = $fx_moment($u2,$u1,$j,$yron,$profil,$inlog);
						}
						unset(${'fx_moment'});
						/*$pr_tested_this = $u1;
						require('priem/'.$this->stats[$this->uids[$u1]]['u_priem'][$j][1].'.php');
						$at = $fx_priem($id,$at,$u1,$j);
						unset(${'fx_priem'});*/
					}
				}
				$j++;
			}
			
			return $yron;
		}
		
	//Опыт + набитый урон за удар приемом\магией
		public function priemYronSave($u1,$u2,$yron,$type,$nootmen = false) {
			
			global $u;
			
			$u->lock('battle-priemYronSave');
			
			//$type 0 - урон , 1 - хил
			if( isset($this->uids[$u1]) ) {
				
				if( $this->stats[$this->uids[$u2]]['hpAll'] <= 1000 ) {
					$adt6 = round(0.1*(floor($yron)/$this->stats[$this->uids[$u2]]['hpAll']*100),10);
				}else{
					$adt6 = round(0.1*(floor($yron)/1000*100),10);
				}				
				
				if( $yron > 0 ) {
					$this->users[$this->uids[$u1]]['battle_yron'] += $yron;
					$this->users[$this->uids[$u1]]['battle_exp'] += round(1*$this->testExp($yron,$this->stats[$this->uids[$u1]],$this->stats[$this->uids[$u2]],$u1,$u2));
					$this->users[$this->uids[$u1]]['tactic6'] += $adt6;
					$this->stats[$this->uids[$u1]]['tactic6'] += $adt6;
				}else{
					$adt6 = 0;
				}
				//
				$this->users[$this->uids[$u2]]['last_hp'] = -$yron;
				
				//$this->users[$this->uids[$u2]]['hpNow'] -= $yron;
				//$this->stats[$this->uids[$u2]]['hpNow'] -= $yron;
				
				//mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$u2]]['hpNow'].'" WHERE `id` = "'.$u2.'" LIMIT 1');
				
				//
				if($value['21'] = $value['mpNow']){
					mysql_query('INSERT INTO `battle_stat`
					( `battle`,`uid1`,`uid2`,`time`,`type`,`a`,`b`,`ma`,`mb`,`type_a`,`type_b`,`yrn`,`yrn_krit`,`tm1`,`tm2` ) VALUES (
						"'.$this->users[$this->uids[$u1]]['battle'].'",
						"'.$u1.'",
						"'.$u2.'",
						"'.time().'",
						"0",
						"",
						"",
						"",
						"",
						"",
						"",
						"'.$yron.'",
						"",
						"",
						""
					)');
					mysql_query('INSERT INTO `battle_stat`
					( `battle`,`uid1`,`uid2`,`time`,`type`,`a`,`b`,`ma`,`mb`,`type_a`,`type_b`,`yrn`,`yrn_krit`,`tm1`,`tm2` ) VALUES (
						"'.$this->users[$this->uids[$u1]]['battle'].'",
						"'.$u2.'",
						"'.$u1.'",
						"'.time().'",
						"0",
						"",
						"",
						"",
						"",
						"",
						"",
						"'.$yron.'",
						"",
						"",
						""
					)');
				}else{
					mysql_query('INSERT INTO `battle_stat`
					( `battle`,`uid1`,`uid2`,`time`,`type`,`a`,`b`,`ma`,`mb`,`type_a`,`type_b`,`yrn`,`yrn_krit`,`tm1`,`tm2` ) VALUES (
						"'.$this->users[$this->uids[$u1]]['battle'].'",
						"'.$u1.'",
						"'.$u2.'",
						"'.time().'",
						"13",
						"",
						"",
						"",
						"",
						"",
						"",
						"'.$yron.'",
						"",
						"",
						""
					)');
					mysql_query('INSERT INTO `battle_stat`
					( `battle`,`uid1`,`uid2`,`time`,`type`,`a`,`b`,`ma`,`mb`,`type_a`,`type_b`,`yrn`,`yrn_krit`,`tm1`,`tm2` ) VALUES (
						"'.$this->users[$this->uids[$u1]]['battle'].'",
						"'.$u2.'",
						"'.$u1.'",
						"'.time().'",
						"13",
						"",
						"",
						"",
						"",
						"",
						"",
						"'.$yron.'",
						"",
						"",

						""
					)');
				}
				
				//echo "------------<br>";
				//print_r($this->users[$this->uids[$u2]]);
				mysql_query('UPDATE `stats` SET	
					`tactic6`	  = `tactic6` + "'.$adt6.'",
					`battle_yron` = `battle_yron` + "'.$yron.'",
					`battle_exp`  = `battle_exp` + "'.round(1*$this->testExp($yron,$this->stats[$this->uids[$u1]],$this->stats[$this->uids[$u2]],$u1,$u2)).'"					
				WHERE `id` = "'.$u1.'" LIMIT 1');
				//				
				mysql_query('UPDATE `stats` SET	
					`last_hp` 	  = "'.$this->users[$this->uids[$u2]]['last_hp'].'"					
				WHERE `id` = "'.$u2.'" LIMIT 1'); 

			}
			$u->unlock();
		}
		
	//Откат НР
		public function uphp( $uid ) {
			//$r = mysql_fetch_array(mysql_query('SELECT `hpNow` FROM `stats` WHERE `id` = "'.$uid.'" LIMIT 1'));
			//$r = explode('.',$r['hpNow']);
			//$r = $r[0];		
			//return floor($r);
			return floor($this->stats[$this->uids[$uid]]['hpNow']);
		}
		
	//Наносим удар между игроками
		public $restart_stats_data = array();
		
		public function a_restart_stats($uid1,$glob) {
			if($uid1 > 0 && isset($this->restart_stats_data[$uid1])) {
				$this->stats[$this->uids[$uid1]] = $this->restart_stats_data[$uid1];
				if($glob == 1) {
					unset($this->restart_stats_data[$uid1]);
				}
			}
		}
		
		public function a_save_stats($uid1) {
			if($uid1 > 0) {
				$this->restart_stats_data[$uid1] = $this->stats[$this->uids[$uid1]];
			}
		}
		
		public function a_testing_stats($uid1,$zona) {
			//$this->stats[$this->uids[$uid1]] = $this->yronGetrazmenStats( $this->stats[$this->uids[$uid1]] , $zona );
			if($uid1 > 0) {
				$this->stats[$this->uids[$uid1]] = $this->yronGetrazmenStats( $this->stats[$this->uids[$uid1]] , $zona );
			}
		}
		
		public $import_atack = array();
		public $contr = array();
		public $import_user = 0;
		public function startAtack($id,$newsf5 = false,$nofcast = false)
		{
			global $u,$log_text,$priem;
			//
			$u->lock('battle.startAtack');
			//
			
			if( isset($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['short_stats']) ) {
				//echo 1;
				$this->stats[$this->uids[$this->atacks[$id]['uid1']]] = $u->getStats($this->stats[$this->uids[$this->atacks[$id]['uid1']]],0,0,false,$this->cached);
			}
			if( isset($this->stats[$this->uids[$this->atacks[$id]['uid2']]]['short_stats']) ) {
				//echo 2;
				$this->stats[$this->uids[$this->atacks[$id]['uid2']]] = $u->getStats($this->stats[$this->uids[$this->atacks[$id]['uid2']]],0,0,false,$this->cached);
			}	
			
			$this->inport_user = 0;
			//
			$vrm = array(
				'uid1' => $this->atacks[$id]['uid1'],
				'uid2' => $this->atacks[$id]['uid2']
			);
			// $k = mysql_fetch_array(mysql_query('SELECT `u`.*,`st`.* FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON `st`.`id` = `u`.`id` WHERE `u`.`id` = '.$this->atacks[$id]['uid1'].''));
			// $k2 = mysql_fetch_array(mysql_query('SELECT `u`.*,`st`.* FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON `st`.`id` = `u`.`id` WHERE `u`.`id` = '.$this->atacks[$id]['uid2'].''));
			$k = mysql_fetch_array(mysql_query('SELECT `hpNow` FROM `stats` WHERE `id` = '.$this->atacks[$id]['uid1'].''));
			$k2 = mysql_fetch_array(mysql_query('SELECT `hpNow` FROM `stats` WHERE `id` = '.$this->atacks[$id]['uid2'].''));

			if($k['hpNow'] > 0 && $k2['hpNow'] > 0){
				/*echo $k['login']."Giv".$k2['login']."<br>";
			}
			else{
				echo $k['login']."Mertv".$k2['login']."<br>";
			}*/
			//
			/*
			if( $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 0 ) {
				$this->atacks[$id]['uid1'] = $this->atacks[$id]['uid2'];
			}elseif( $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] > 0 ) {
				$this->atacks[$id]['uid2'] = $this->atacks[$id]['uid1'];
			}
			*/

			$rest = 0;


		if(isset($this->atacks[$id]) && $this->atacks[$id]['lock'] == 0) {
					
				//$this->yhod_user($uid2,$uid1,$this->stats[$this->uids[$uid2]]['yhod']);
			
			
			if( $newsf5 == true ) {
				$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] = 0;
				$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] = 0;
			}			
				
													
			if( $newsf5 == false ) {
				
				$untac1 = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `v1` = "priem" AND `v2` = "217" AND `uid` = "'.$this->atacks[$id]['uid1'].'" AND `delete` = 0 LIMIT 1'));
				$untac2 = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `v1` = "priem" AND `v2` = "217" AND `uid` = "'.$this->atacks[$id]['uid2'].'" AND `delete` = 0 LIMIT 1'));
			
				$gdtc = true;
				if( $this->atacks[$id]['out2'] == 0 && $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 0 && !isset($untac2['id']) ) {
				}elseif( $this->atacks[$id]['out1'] == 0 && $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] > 0 && !isset($untac1['id']) ) {					
				}else{
					$gdtc = false;
				}
			
				if( $gdtc == true ) {
					unset($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['noyhodtm'],$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['noyhodtm']);
					$p1h = false;
					if( $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 0 && $this->atacks[$id]['out1'] > 0 && $this->atacks[$id]['tpo1'] == 0 ) {
						$p1h = true;
						$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['noyhodtm'] = true;
						$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] = 0;
					}
					if( $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] > 0 && $this->atacks[$id]['out2'] > 0 && $this->atacks[$id]['tpo2'] == 0 ) {
						$p1h = true;
						$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['noyhodtm'] = true;
						$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] = 0;
					}					
					$stopfx = false;					
				}
								
				if( $p1h == true ) {
					//маг пропустил ход или воин
					
				}elseif( $this->atacks[$id]['out2'] == 0 && $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 0 && !isset($untac2['id']) ) {
					
					$outjk = $this->atacks[$id]['out1'];
					
					$eftmk = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `data` LIKE "%add_yhod%" AND `uid` = "'.$this->atacks[$id]['uid1'].'" LIMIT 1'));
					mysql_query('DELETE FROM `eff_users` WHERE `data` LIKE "%add_yhod%" AND `uid` = "'.$this->atacks[$id]['uid1'].'"');
					mysql_query('DELETE FROM `eff_users` WHERE `data` LIKE "%add_yhod%" AND `uid` = "'.$this->atacks[$id]['uid2'].'"');
					mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$eftmk['id'].'"');
					
					//
					if( $outjk == 0 ) {
						//echo '[YU]';
						$rnda = rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5);
						$rndb = rand(1,5);	
						mysql_query('INSERT INTO `battle_act` (
							`tyman`,`battle`,`uid1`,`uid2`,`time`,`time2`,`out2`,`a1`,`b1`,`a2`,`b2`
						) VALUES (
							"1","'.$this->info['id'].'","'.$this->atacks[$id]['uid1'].'","'.$this->atacks[$id]['uid2'].'","'.time().'","'.time().'","1",
							"'.$rnda.'","'.$rndb.'",
							"'.$rnda.'","'.$rndb.'"
						)');
											
						$lstidhod = mysql_insert_id();
						$this->atacks[$lstidhod] = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `id` = "'.$lstidhod.'" LIMIT 1'));
						//
						$this->startAtack($lstidhod,true,true); $this->hodID--;
					}else{
						$prv['color2'] = '000000';	
						$prv['text2'] = '{tm1} <b>'.$this->users[$this->uids[$uidtum1]]['login'].'</b> потратил свой ход на магию.';
						$this->priemAddLog( $id, 1, 2, $uidtum1, 0,
							'<font color^^^^#'.$prv['color2'].'>'.$eftmk['name'].'</font>',
							$prv['text2'],	
							($this->hodID + 1)
						);
					}
					$prv['color2'] = '000000';
					$prv['text'] = $this->addlt(1 , 17 , $this->users[$this->uids[$uidtum1]]['sex'] , NULL);	
					$prv['text2'] = '{tm1} Здоровье персонажа <b><u>'.$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['login'].'</u></b>: '.round($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'],2).' ед.';
					$this->priemAddLog( $id, 1, 2, $uidtum1, 0,
						'<font color^^^^#'.$prv['color2'].'>'.$eftmk['name'].'</font>',
						$prv['text2'],	
						($this->hodID + 1)
					);
					//
					
					$fm1k = 1;
					//Меняем конструкцию размена
					$uidtum1 = $this->atacks[$id]['uid1'];
					$uidtum2 = $this->atacks[$id]['uid2'];
					mysql_query('UPDATE `battle_act` SET
						`uid1` = "'.$this->atacks[$id]['uid2'].'" , `a1` = "00000" , `out1` = "1" , `tout1` = "'.$this->atacks[$id]['tout2'].'" , `tpo1` = "'.$this->atacks[$id]['tpo2'].'",
						`uid2` = "'.$this->atacks[$id]['uid1'].'" , `a2` = "'.$this->atacks[$id]['a1'].'" , `b2` = "'.$this->atacks[$id]['b1'].'" , `out2` = "'.$this->atacks[$id]['out1'].'" , `tout2` = "'.$this->atacks[$id]['tout1'].'" , `tpo2` = "'.$this->atacks[$id]['tpo1'].'"
						WHERE `id` = "'.$this->atacks[$id]['id'].'" LIMIT 1			
					');
					//	
					$oa = $this->atacks[$id];
					//				
					$rnda = rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5);
					$rndb = rand(1,5);					
					
					//	"'.$this->atacks[$id]['a2'].'","'.$this->atacks[$id]['b2'].'",
					//	"'.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).'","'.rand(1,5).'"
					
					$usruh = $this->yhod_user($this->atacks[$id]['uid2'],$this->atacks[$id]['uid1'],$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod']);
					//$usruh = $this->atacks[$id]['uid2'];
					mysql_query('INSERT INTO `battle_act` (
						`tyman`,`battle`,`uid1`,`uid2`,`time`,`time2`,`out2`,`a1`,`b1`,`a2`,`b2`
					) VALUES (
						"1","'.$this->info['id'].'","'.$this->atacks[$id]['uid2'].'","'.$usruh.'","'.time().'","'.time().'","1",
						"'.$rnda.'","'.$rndb.'",
						"'.$rnda.'","'.$rndb.'"
					)');
					
					$this->users[$this->uids[$this->atacks[$id]['uid2']]]['tuman'] = true;
					
					$lstidhod = mysql_insert_id();
					$this->atacks[$lstidhod] = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `id` = "'.$lstidhod.'" LIMIT 1'));
					//
					$this->startAtack($lstidhod,true); $this->hodID--;
					$this->teamsTake();
					//Туманный образ
					$prv['color2'] = '000000';
					$prv['text'] = $this->addlt(1 , 17 , $this->users[$this->uids[$uidtum1]]['sex'] , NULL);	
					$prv['text2'] = '{tm1} Здоровье персонажа <b>'.$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['login'].'</b>: '.round($this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'],2).' ед.';
					$this->priemAddLog( $id, 1, 2, $uidtum1, 0,
						'<font color^^^^#'.$prv['color2'].'>'.$eftmk['name'].'</font>',
						$prv['text2'],	
						($this->hodID + 1)
					);
					//
					/*$rest_uid1 = $u->getStats($this->atacks[$id]['uid1'],0,0,false,false,true);
					$rest_uid2 = $u->getStats($this->atacks[$id]['uid2'],0,0,false,false,true);
					$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'] = $rest_uid1['hpNow'];
					$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'] = $rest_uid2['hpNow'];
					$this->users[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'] = $rest_uid1['hpNow'];
					$this->users[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'] = $rest_uid2['hpNow'];
					//
					if( $this->atacks[$id]['uid1'] == $u->info['id'] ) {
						$u->info['hpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'];
						$u->stats['hpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'];
					}elseif( $this->atacks[$id]['uid2'] == $u->info['id'] ) {
						$u->info['hpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'];
						$u->stats['hpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'];
					}
					mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'].'" WHERE `id` = "'.$this->atacks[$id]['uid1'].'" LIMIT 1');
					mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'].'" WHERE `id` = "'.$this->atacks[$id]['uid2'].'" LIMIT 1');
					*///
					unset($rest_uid1,$rest_uid2);
					//
					$this->atacks[$id] = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `id` = "'.$this->atacks[$id]['id'].'" LIMIT 1'));
					//echo '<font color=red><b>[UPDATE_ACT-1*'.$this->atacks[$id]['uid1'].'*'.$this->atacks[$id]['uid2'].'*.'.$usruh.']</b></font>';
					//mysql_query('DELETE FROM `eff_users` WHERE `data` LIKE "%add_yhod%" AND `uid` = "'.$this->atacks[$id]['uid1'].'"');
					//mysql_query('DELETE FROM `eff_users` WHERE `data` LIKE "%add_yhod%" AND `uid` = "'.$this->atacks[$id]['uid2'].'"');
					//
					/*if( $outjk == 0 ) {
						mysql_query('INSERT INTO `battle_act` (
							`tyman`,`battle`,`uid1`,`uid2`,`time`,`time2`,`out2`,`a1`,`b1`,`a2`,`b2`
						) VALUES (
							"1","'.$this->info['id'].'","'.$this->atacks[$id]['uid2'].'","'.$this->atacks[$id]['uid1'].'","'.time().'","'.time().'","1",
							"'.$rnda.'","'.$rndb.'",
							"'.$rnda.'","'.$rndb.'"
						)');
											
						$lstidhod = mysql_insert_id();
						$this->atacks[$lstidhod] = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `id` = "'.$lstidhod.'" LIMIT 1'));
						//
						$this->startAtack($lstidhod,true,true); $this->hodID--;
					}else{
						$prv['color2'] = '000000';	
						$prv['text2'] = '{tm1} <b>'.$this->users[$this->uids[$uidtum1]]['login'].'</b> потратил свой ход на магию.';
						$this->priemAddLog( $id, 1, 2, $uidtum1, 0,
							'<font color^^^^#'.$prv['color2'].'>'.$eftmk['name'].'</font>',
							$prv['text2'],	
							($this->hodID + 1)
						);
					}
					$prv['color2'] = '000000';
					$prv['text'] = $this->addlt(1 , 17 , $this->users[$this->uids[$uidtum1]]['sex'] , NULL);	
					$prv['text2'] = '{tm1} Здоровье персонажа <b><u>'.$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['login'].'</u></b>: '.round($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'],2).' ед.';
					$this->priemAddLog( $id, 1, 2, $uidtum1, 0,
						'<font color^^^^#'.$prv['color2'].'>'.$eftmk['name'].'</font>',
						$prv['text2'],	
						($this->hodID + 1)
					);*/
					//
					$stopfx = true;
				}elseif( $this->atacks[$id]['out1'] == 0 && $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] > 0 && !isset($untac1['id']) ) {
					//Меняем конструкцию размена
					
					$outjk = $this->atacks[$id]['out2'];
					
					$fm1k = 2;
					$eftmk = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `data` LIKE "%add_yhod%" AND `uid` = "'.$this->atacks[$id]['uid2'].'" LIMIT 1'));
					mysql_query('DELETE FROM `eff_users` WHERE `data` LIKE "%add_yhod%" AND `uid` = "'.$this->atacks[$id]['uid1'].'"');
					mysql_query('DELETE FROM `eff_users` WHERE `data` LIKE "%add_yhod%" AND `uid` = "'.$this->atacks[$id]['uid2'].'"');
					mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$eftmk['id'].'"');
					$uidtum1 = $this->atacks[$id]['uid2'];
					$uidtum2 = $this->atacks[$id]['uid1'];
					mysql_query('UPDATE `battle_act` SET
						`uid1` = "'.$this->atacks[$id]['uid1'].'" , `a1` = "00000" , `out1` = "1" , `tout1` = "'.$this->atacks[$id]['tout1'].'" , `tpo1` = "'.$this->atacks[$id]['tpo1'].'",
						`uid2` = "'.$this->atacks[$id]['uid2'].'" , `a2` = "'.$this->atacks[$id]['a2'].'" , `b2` = "'.$this->atacks[$id]['b2'].'" , `out2` = "'.$this->atacks[$id]['out2'].'" , `tout2` = "'.$this->atacks[$id]['tout2'].'" , `tpo2` = "'.$this->atacks[$id]['tpo2'].'"
						WHERE `id` = "'.$this->atacks[$id]['id'].'" LIMIT 1			
					');
					//
					$rnda = rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5);
					$rndb = rand(1,5);
					//
					$usruh = $this->yhod_user($this->atacks[$id]['uid1'],$this->atacks[$id]['uid2'],$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod']);
					//$usruh = $this->atacks[$id]['uid1'];
					mysql_query('INSERT INTO `battle_act` (
						`tyman`,`battle`,`uid1`,`uid2`,`time`,`time2`,`out2`,`a1`,`b1`,`a2`,`b2`
					) VALUES (
						"1","'.$this->info['id'].'","'.$this->atacks[$id]['uid1'].'","'.$usruh.'","'.time().'","'.time().'","1",
						"'.$rnda.'","'.$rndb.'",
						"'.$rnda.'","'.$rndb.'"
					)');
					
					$this->users[$this->uids[$this->atacks[$id]['uid1']]]['tuman'] = true;
					
					$lstidhod = mysql_insert_id();
					$this->atacks[$lstidhod] = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `id` = "'.$lstidhod.'" LIMIT 1'));
					//
					$this->startAtack($lstidhod,true); $this->hodID--;
					$this->teamsTake();
					//
					$prv['color2'] = '000000';
					$prv['text'] = $this->addlt(1 , 17 , $this->users[$this->uids[$uidtum1]]['sex'] , NULL);	
					$prv['text2'] = '{tm1} Здоровье персонажа <b>'.$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['login'].'</b>: '.round($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'],2).' ед.';
					$this->priemAddLog( $id, 1, 2, $uidtum1, 0,
						'<font color^^^^#'.$prv['color2'].'>'.$eftmk['name'].'</font>',
						$prv['text2'],	
						($this->hodID + 1)
					);
					//
					//
					/*$rest_uid1 = $u->getStats($this->atacks[$id]['uid1'],0,0,false,false,true);
					$rest_uid2 = $u->getStats($this->atacks[$id]['uid2'],0,0,false,false,true);
					$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'] = $rest_uid1['hpNow'];
					$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'] = $rest_uid2['hpNow'];
					$this->users[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'] = $rest_uid1['hpNow'];
					$this->users[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'] = $rest_uid2['hpNow'];
					//
					if( $this->atacks[$id]['uid1'] == $u->info['id'] ) {
						$u->info['hpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'];
						$u->stats['hpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'];
					}elseif( $this->atacks[$id]['uid2'] == $u->info['id'] ) {
						$u->info['hpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'];
						$u->stats['hpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'];
					}
					mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'].'" WHERE `id` = "'.$this->atacks[$id]['uid1'].'" LIMIT 1');
					mysql_query('UPDATE `stats` SET `hpNow` = "'.$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'].'" WHERE `id` = "'.$this->atacks[$id]['uid2'].'" LIMIT 1');
					*///
					unset($rest_uid1,$rest_uid2);
					//
					$this->atacks[$id] = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `id` = "'.$this->atacks[$id]['id'].'" LIMIT 1'));
					//echo '<font color=red><b>[UPDATE_ACT-2.'.$usruh.']</b></font>';
					//mysql_query('DELETE FROM `eff_users` WHERE `data` LIKE "%add_yhod%" AND `uid` = "'.$this->atacks[$id]['uid1'].'"');
					//mysql_query('DELETE FROM `eff_users` WHERE `data` LIKE "%add_yhod%" AND `uid` = "'.$this->atacks[$id]['uid2'].'"');
					//
					if( $outjk == 0 ) {
						mysql_query('INSERT INTO `battle_act` (
							`tyman`,`battle`,`uid1`,`uid2`,`time`,`time2`,`out2`,`a1`,`b1`,`a2`,`b2`
						) VALUES (
							"1","'.$this->info['id'].'","'.$this->atacks[$id]['uid2'].'","'.$this->atacks[$id]['uid1'].'","'.time().'","'.time().'","1",
							"'.$rnda.'","'.$rndb.'",
							"'.$rnda.'","'.$rndb.'"
						)');					
						$lstidhod = mysql_insert_id();
						$this->atacks[$lstidhod] = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `id` = "'.$lstidhod.'" LIMIT 1'));
						//
						$this->startAtack($lstidhod,true,true); $this->hodID--;
					}else{
						$prv['color2'] = '000000';
						$prv['text2'] = '{tm1} <b>'.$this->users[$this->uids[$uidtum1]]['login'].'</b> потратил свой ход на магию.';
						$this->priemAddLog( $id, 1, 2, $uidtum1, 0,

							'<font color^^^^#'.$prv['color2'].'>'.$eftmk['name'].'</font>',
							$prv['text2'],	
							($this->hodID + 1)
						);
					}
					//
					$prv['color2'] = '000000';
					$prv['text'] = $this->addlt(1 , 17 , $this->users[$this->uids[$uidtum1]]['sex'] , NULL);	
					$prv['text2'] = '{tm1} Здоровье персонажа <b><u>'.$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['login'].'</u></b>: '.round($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'],2).' ед.';
					$this->priemAddLog( $id, 1, 2, $uidtum1, 0,
						'<font color^^^^#'.$prv['color2'].'>'.$eftmk['name'].'</font>',
						$prv['text2'],	
						($this->hodID + 1)
					);
					//
					$stopfx = true;
				}elseif( $this->atacks[$id]['out2'] == 0 && $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 0 && !isset($untac2['id']) && false == true ) {
					//Меняем конструкцию размена
					mysql_query('UPDATE `battle_act` SET
						`uid1` = "'.$this->atacks[$id]['uid2'].'" , `a1` = "'.$this->atacks[$id]['a2'].'" , `b1` = "'.$this->atacks[$id]['b2'].'" , `out1` = "'.$this->atacks[$id]['out2'].'" , `tout1` = "'.$this->atacks[$id]['tout2'].'" , `tpo1` = "'.$this->atacks[$id]['tpo2'].'",
						`uid2` = "'.$this->atacks[$id]['uid1'].'" , `a2` = "'.$this->atacks[$id]['a1'].'" , `b2` = "'.$this->atacks[$id]['b1'].'" , `out2` = "'.$this->atacks[$id]['out1'].'" , `tout2` = "'.$this->atacks[$id]['tout1'].'" , `tpo2` = "'.$this->atacks[$id]['tpo1'].'"
						WHERE `id` = "'.$this->atacks[$id]['id'].'" LIMIT 1			
					');
					$this->atacks[$id] = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `id` = "'.$this->atacks[$id]['id'].'" LIMIT 1'));
					//echo '<font color=red><b>[UPDATE_ACT]</b></font>';
					mysql_query('DELETE FROM `eff_users` WHERE `data` LIKE "%add_yhod%" AND `uid` = "'.$this->atacks[$id]['uid1'].'"');
				}
				
			}else{
				$rest = 1;
			}
			
			//$stopfx = false;
			mysql_query('DELETE FROM `battle_act` WHERE `id` = "'.$id.'" LIMIT 1');
			if( $stopfx == true ) {
				
				//обновляем задержки приемов
				$zd1 = explode('|',$this->users[$this->uids[$uidtum1]]['priems_z']);
				//
				$i5 = 0;
				while($i5 < 51) {
					if(isset($zd1[$i5]) && $zd1[$i5]>0) {
						//Если приемы не требуют ход
						$zd1[$i5] -= 1;
					}
					$i5++;
				}
				$this->users[$this->uids[$uidtum1]]['priems_z'] = implode('|',$zd1);
				mysql_query('UPDATE `stats` SET `enemy` = 0 , `priems_z` = "'.$this->users[$this->uids[$uidtum1]]['priems_z'].'" WHERE `id` = "'.$uidtum1.'" LIMIT 1');				
				mysql_query('UPDATE `stats` SET `enemy` = 0 WHERE `id` = "'.$uidtum2.'" LIMIT 1');	
				//Туманный образ
				$prv['color2'] = '000000';
				$prv['text'] = $this->addlt(1 , 17 , $this->users[$this->uids[$uidtum1]]['sex'] , NULL);	
				$prv['text2'] = '{tm1} '.$prv['text'].' <small>(Порядок #'.$fm1k.')</small>';
				$this->priemAddLog( $id, 1, 2, $uidtum1, 0,
					'<font color^^^^#'.$prv['color2'].'>'.$eftmk['name'].'</font>',
					$prv['text2'],	
					($this->hodID + 1)
				);
				$_SESSION['tbr'] = 0;
				die('<script>reflesh(true);</script>');
				return true;
			}
				//Прием Ставка на Опережение
				$i = 1; $j = 2; $k = 0;
				$unpr = '';
				while( $i <= 2 ) {
					$untac = mysql_fetch_array(mysql_query('SELECT `id`,`uid` FROM `eff_users` WHERE `v1` = "priem" AND `v2` = "220" AND `uid` = "'.$this->atacks[$id]['uid'.$i].'" AND `delete` = 0 LIMIT 1'));
					if(isset($untac['id'])) {						
						//
						/*
						AND `a`.`v2` != 231
						*/
						$pvr['sp'] = mysql_query('SELECT `a`.* FROM `eff_users` AS `a` WHERE `a`.`uid` = "'.$this->atacks[$id]['uid'.$j].'" AND `a`.`delete` = 0 AND ( `a`.`v1` = "priem"
						
							AND `a`.`v1` = "priem" 
							AND `a`.`v2` != 201 
							AND `a`.`v2` != 344 
							AND `a`.`v2` != 238 
							AND `a`.`v2` != 139 
							AND `a`.`v2` != 211 
							AND `a`.`v2` != 233 
							AND `a`.`v2` != 223 
							AND `a`.`v2` != 222
							AND `a`.`v2` NOT IN ( SELECT `id` FROM `priems` WHERE `neg` > 0 )
							AND `a`.`name` NOT LIKE "%Магический барьер%"
							AND `a`.`name` NOT LIKE "%Силовое поле%"
							AND `a`.`name` NOT LIKE "%Туманный образ%"
							AND `a`.`name` NOT LIKE "%Каменный страж%"
							AND `a`.`v2` != 245
							AND `a`.`v2` != 248
							AND `a`.`v2` != 249
							AND `a`.`v2` != 254
							AND `a`.`v2` != 255
							AND `a`.`v2` != 260
							AND `a`.`v2` != 285				
							AND `a`.`v2` != 29
							AND `a`.`v2` != 180
							AND `a`.`v2` != 283
							AND `a`.`v2` != 267
							AND `a`.`v2` != 32
							AND `a`.`v2` != 257
							AND `a`.`v2` != 30				
							AND `a`.`v2` != 251
							AND `a`.`v2` != 250
							AND `a`.`v2` != 252
							AND `a`.`v2` != 31
							
							AND `a`.`v2` != 188
							AND `a`.`v2` != 229
							
							AND `a`.`v2` != 217
							AND `a`.`v2` != 220
							
							AND `a`.`v2` != 269
							AND `a`.`v2` != 276
							AND `a`.`v2` != 277
							AND `a`.`v2` != 278
							AND `a`.`v2` != 279
							
							AND `a`.`name` NOT LIKE "%Спасение%"
							)
						LIMIT 30');
						$pvr['priemtest'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `v2` = "211" AND `delete` = 0 AND `uid` = "'.$this->atacks[$id]['uid'.$j].'" LIMIT 1'));
						if(isset($pvr['priemtest']['id'])) {
							$this->priemAddLogFast( $this->atacks[$id]['uid'.$j], 0, "Ставка на опережение",
								'{tm1} {u1} не смог украсть приемы. (Защита от приема: Агрессивная защита)',
							1, time() );
							//
							mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$this->atacks[$id]['uid'.$j].'" AND `v2` = "220"');
							//
						}else{
							while($pvr['pl'] = mysql_fetch_array($pvr['sp'])) {
								$pvr['pl']['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$pvr['pl']['v2'].'" LIMIT 1'));
								if( isset($pvr['pl']['priem']['id']) && $pvr['pl']['priem']['neg'] == 0 ) {
									//$this->delPriem($pvr['pl'],$this->users[$this->uids[$this->atacks[$id]['uid'.$j]]],100);
										$pvr['pl']['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "217" AND `delete` = 0 AND `uid` = "'.$pvr['pl']['uid'].'" LIMIT 1'));
										$tst6 = mysql_fetch_array(mysql_query('SELECT `id`,`v2` FROM `eff_users` WHERE `uid` = "'.$this->atacks[$id]['uid'.$i].'" AND `v2` = "'.$pvr['pl']['v2'].'" AND `delete` = 0 LIMIT 1'));
										if(isset($tst6['id'])) {
											mysql_query('UPDATE `eff_users` SET `uid` = "0" , `delete` = "'.time().'" WHERE `id` = "'.$pvr['pl']['id'].'" LIMIT 1');

										}else{
											mysql_query('UPDATE `eff_users` SET `uid` = "'.$this->atacks[$id]['uid'.$i].'" WHERE `id` = "'.$pvr['pl']['id'].'" LIMIT 1');
										}
										//
										$this->priemAddLogFast( $this->atacks[$id]['uid'.$i], 0, "Ставка на опережение",
											'{tm1} {u1} украл прием <b>'.$pvr['pl']['name'].'</b>.',
										1, time() );
									//	
									$rest++;
								}
							}
						}
						$k++;
					}
					$j--;
					$i++;
				}
				
				//
				if( $rest > 0 ) {
					$this->stats[$this->uids[$this->atacks[$id]['uid1']]] = $u->getStats($this->atacks[$id]['uid1'],0,0,false,false,true);
					$this->stats[$this->uids[$this->atacks[$id]['uid2']]] = $u->getStats($this->atacks[$id]['uid2'],0,0,false,false,true);
				}
				//
				
				//Прием разгадать тактику
				$i = 1; $j = 2; $k = 0;
				$unpr = '';
				while( $i <= 2 && $newsf5 == false ) {
					$untac = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `v1` = "priem" AND `v2` = "217" AND `uid` = "'.$this->atacks[$id]['uid'.$i].'" AND `delete` = 0 LIMIT 1'));
					//$untac2 = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `v1` = "priem" AND ( /*`v2` = "220" OR */ `v2` = "211") AND `uid` = "'.$this->atacks[$id]['uid'.$j].'" AND `delete` = 0 LIMIT 1'));
					if(isset($untac['id'])) {
						//1
						$pvr['sp'] = mysql_query('SELECT `a`.* FROM `eff_users` AS `a` WHERE `a`.`uid` = "'.$this->atacks[$id]['uid'.$j].'" AND `a`.`delete` = 0 AND `a`.`v1` = "priem"
						
							
							AND `a`.`v2` != 238
							
							AND `a`.`v2` != 217
							
							AND `a`.`v2` != 228
							AND `a`.`v2` != 229
							
							AND `a`.`v2` != 139
							AND `a`.`v2` != 188

							AND `a`.`v2` != 211
							AND `a`.`v2` != 49
							AND `a`.`v2` != 233
							AND `a`.`v2` != 227
							AND `a`.`v2` != 220
							AND `a`.`v2` != 191
							
							AND `a`.`v2` != 201
							
							AND `a`.`v2` != 206 AND `a`.`v2` != 207 AND `a`.`v2` != 208 AND `a`.`v2` != 209
							AND `a`.`v2` != 210 AND `a`.`v2` != 284 AND `a`.`v2` != 261 AND `a`.`v2` != 262
							AND `a`.`v2` != 263 AND `a`.`v2` != 258
							
							AND `a`.`v2` != 29 AND `a`.`v2` != 30
							AND `a`.`v2` != 31 AND `a`.`v2` != 32 AND `a`.`v2` != 256 AND `a`.`v2` != 249
							AND `a`.`v2` != 248 AND `a`.`v2` != 187 AND `a`.`v2` != 245 AND `a`.`v2` != 175
							AND `a`.`v2` != 176 AND `a`.`v2` != 177 AND `a`.`v2` != 178 AND `a`.`v2` != 179
							AND `a`.`v2` != 285 AND `a`.`v2` != 36 AND `a`.`v2` != 85 AND `a`.`v2` != 86
							AND `a`.`v2` != 87 AND `a`.`v2` != 88 AND `a`.`v2` != 89 AND `a`.`v2` != 90
							AND `a`.`v2` != 269 AND `a`.`v2` != 276 AND `a`.`v2` != 277 AND `a`.`v2` != 270
							AND `a`.`v2` != 174							
							AND `a`.`v2` != 324 AND `a`.`v2` != 395 AND `a`.`v2` != 397 AND `a`.`v2` != 406
														
							AND `name` NOT LIKE "%Иммунитет%"
							AND `name` NOT LIKE "%Метеорит%"
							AND `name` NOT LIKE "%Отравление%"
							AND `name` NOT LIKE "%Оледенение%"
							AND `name` NOT LIKE "%Ядовитое Облако%"
							AND `name` NOT LIKE "%Пожирающее Пламя%"
							
							AND `name` NOT LIKE "%Магический Барьер%"
							AND `name` NOT LIKE "%Магический барьер%"
						
						LIMIT 30');
						$pvr['priemtest'] = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `v2` = "211" AND `delete` = 0 AND `uid` = "'.$this->atacks[$id]['uid'.$j].'" LIMIT 1'));
						if(isset($pvr['priemtest']['id'])) {
							$this->priemAddLogFast( $this->atacks[$id]['uid'.$j], 0, "Разгадать тактику",
								'{tm1} {u1} защищен от &quot;Разгадать тактику&quot;. (Агрессивная защита)',
							1, time() );
							//
							mysql_query('DELETE FROM `eff_users` WHERE `uid` = "'.$this->atacks[$id]['uid'.$i].'" AND `v2` = "217"');
							//
						}else{
							while($pvr['pl'] = mysql_fetch_array($pvr['sp'])) {
								$pvr['pl']['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$pvr['pl']['v2'].'" AND `neg` = 0 LIMIT 1'));
								if(isset($pvr['pl']['priem']['id'])) {
									$this->delPriem($pvr['pl'],$this->users[$this->uids[$this->atacks[$id]['uid'.$j]]],100);
								}
								$rest++;
							}
						}
						//
						$k++;
					}
					$j--;
					$i++;
				}
				
				//
				if( $rest > 0 ) {
					$this->stats[$this->uids[$this->atacks[$id]['uid1']]] = $u->getStats($this->atacks[$id]['uid1'],0,0,false,false,true);
					$this->stats[$this->uids[$this->atacks[$id]['uid2']]] = $u->getStats($this->atacks[$id]['uid2'],0,0,false,false,true);
				}
				//
				
				//UPDATE ... SET `lock` = 1
				//Копируем характиристики
				//$this->a_save_stats($this->atacks[$id]['uid1']);
				//$this->a_save_stats($this->atacks[$id]['uid2']);
				//
								
				//Восстановление манны 1% за ход
				//$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'] += floor($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['s6']/4 + $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hod_minmana'] );
				//$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'] += floor($this->stats[$this->uids[$this->atacks[$id]['uid2']]]['s6']/4 + $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hod_minmana'] );
				//
				//$this->users[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'];
				//$this->users[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'];
				//
				
				$last_yrn = array(
					1 => $this->users[$this->uids[$this->atacks[$id]['uid1']]]['battle_yron'],
					2 => $this->users[$this->uids[$this->atacks[$id]['uid2']]]['battle_yron']
				);
				
				//Расчет количества блоков и противников
				$this->testZonb($this->atacks[$id]['uid1'],$this->atacks[$id]['uid2'],$id);
				
				//Запускаем магию предметов
				$this->magicItems($this->atacks[$id]['uid1'],$this->atacks[$id]['uid2']);
				$this->magicItems($this->atacks[$id]['uid2'],$this->atacks[$id]['uid1']);
					
				// Получаем приемы игроков
				$this->priemsRazmen($id,$at);
				$this->priemsRazmenMoment($id,$at);
				$this->priemsRazmen($id,$at);
								
				// Тестируем размены (получаем куда игрок ударил, куда попал, куда блок)
				$at = $this->newRazmen($id);
				
				// Тестируем какие еще могут быть варианты при ударе
				// Уворот, парирование, крит, пробить блок, блок щитом
				// Блок щитом (если есть щит, конечно)
				/*
				$at = $this->mf4Razmen($id,$at,0);
				// Крит
				$at = $this->mf2Razmen($id,$at,0);
				// Уворот
				$at = $this->mf1Razmen($id,$at,0);
				// Парирование
				$at = $this->mf3Razmen($id,$at,0);
				// Контрудар
				$at = $this->mf5Razmen($id,$at,0);				
				// Считаем тип урона и урон
				$at = $this->yronRazmen($id,$at);
				*/
				
				
				$at = $this->mf4Razmen($id,$at,0); //блок щитом
				$at = $this->mf2Razmen($id,$at,0); //крит
				$at = $this->mf1Razmen($id,$at,0); //уворот
				$at = $this->mf3Razmen($id,$at,0); //парирование
				
				//расчет зон блока
				//if( $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] == 0 && $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] == 0 ) {
				$at = $this->mf5Razmen($id,$at,0); //контрудар
				//}
				$at = $this->yronRazmen($id,$at);  //расчет урона
				
				// Проверяем приемы
				//['effects'][
				// Получаем приемы игроков
				$at = $this->priemsTestRazmen($id,$at);
				// Собираем размен (пересчитываем и расчитываем урон и т.д)
				$at = $this->priemsRestartRazmen($id,$at); //Повторная проверка приемов (если требуется)
				
				//Минусуем поглощенный урон
				if( count($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['set_pog']) > 0 ) {
					$this->testPogB($this->atacks[$id]['uid1'],1,$id,1);
				}
				if( count($this->stats[$this->uids[$this->atacks[$id]['uid2']]]['set_pog']) > 0 ) {
					$this->testPogB($this->atacks[$id]['uid2'],1,$id,1);
				}
				
				// Обновляем НР и добавляем тактики
				$at = $this->updateHealth($id,$at,$newsf5);	
				/*echo $k['id'] . "-" . $k2['id'];
				echo "<pre>";
				print_r($at);*/
				// Заносим в логи + записываем статистику боя
				$this->addlogRazmen($id,$at,$newsf5);	
				//addFlog($at,$this->atacks[$id]['uid1'], $this->atacks[$id]['uid2']);						
				//echo $this->seeRazmen($id,$at);
				// NEW BATTLE SYSTEM	
							
				/*
				if( $this->stats[$this->uids[$vrm['uid1']]]['yhod'] > 0 ) {
					$this->atacks[$id]['uid1'] = $vrm['uid1'];
				}elseif( $this->stats[$this->uids[$vrm['uid2']]]['yhod'] > 0 ) {
					$this->atacks[$id]['uid2'] = $vrm['uid2'];
				}
				*/
				
				//
				//Возращаем зоны блока
				$this->restZonb($this->atacks[$id]['uid1'],$this->atacks[$id]['uid2']);
				//обновляем задержки приемов
				$zd1 = explode('|',$this->users[$this->uids[$this->atacks[$id]['uid1']]]['priems_z']);
				$zd2 = explode('|',$this->users[$this->uids[$this->atacks[$id]['uid2']]]['priems_z']);
				$zd1id = explode('|',$this->users[$this->uids[$this->atacks[$id]['uid1']]]['priems']);
				$zd2id = explode('|',$this->users[$this->uids[$this->atacks[$id]['uid2']]]['priems']);
				//
				$prmos = array();
				//
				$i5 = 0;
				if( $nofcast == true ) {
					//$i5 = 1051;
				}
				while($i5 < 51) {
					if(isset($zd1[$i5]) && $zd1[$i5]>0) {
						//Если приемы не требуют ход
						$zd1[$i5] -= 1;
						/*if( $this->users[$this->uids[$this->atacks[$id]['uid2']]]['id'] == $this->users[$this->uids[$this->atacks[$id]['uid1']]]['enemy'] ) {
							//Обнуляем приемы не требующие ход
							$zd1[$i5] -= 1;
						}else{
							//echo '['.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['id'].'|'.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['enemy'].']';
							//не обнуляем (только те что требуют ход)
							if(!isset($prmos[$zd1id[$i5]])) {
								$prmos[$zd1id[$i5]] = mysql_fetch_array(mysql_query('SELECT `id`,`tr_hod` FROM `priems` WHERE `id` = "'.$zd1id[$i5].'" AND `img` LIKE "wis_%" LIMIT 1'));
							}
							if( !isset($prmos[$zd1id[$i5]]['id']) || $prmos[$zd1id[$i5]]['tr_hod'] > 0 ) {
								$zd1[$i5] -= 1;
							}
						}*/
					}
					if(isset($zd2[$i5]) && $zd2[$i5]>0) {
						//Если приемы не требуют ход
						$zd2[$i5] -= 1;
						/*if( $this->users[$this->uids[$this->atacks[$id]['uid1']]]['id'] == $this->users[$this->uids[$this->atacks[$id]['uid2']]]['enemy'] ) {
							//Обнуляем приемы не требующие ход
							$zd2[$i5] -= 1;
						}else{
							//не обнуляем (только те что требуют ход)
							if(!isset($prmos[$zd2id[$i5]])) {
								$prmos[$zd2id[$i5]] = mysql_fetch_array(mysql_query('SELECT `id`,`tr_hod` FROM `priems` WHERE `id` = "'.$zd2id[$i5].'" AND `img` LIKE "wis_%" LIMIT 1'));
							}
							if( !isset($prmos[$zd2id[$i5]]['id']) || $prmos[$zd2id[$i5]]['tr_hod'] > 0 ) {
								$zd2[$i5] -= 1;
							}
						}*/
					}
					$i5++;
				}
				unset($prmos);
				
				if( $this->users[$this->uids[$this->atacks[$id]['uid1']]]['enemy'] == $this->users[$this->uids[$this->atacks[$id]['uid2']]]['id'] ) {
					$this->users[$this->uids[$this->atacks[$id]['uid1']]]['enemy'] = -$this->users[$this->uids[$this->atacks[$id]['uid1']]]['enemy'];
				}
				
				if( $this->users[$this->uids[$this->atacks[$id]['uid2']]]['enemy'] == $this->users[$this->uids[$this->atacks[$id]['uid1']]]['id'] ) {
					$this->users[$this->uids[$this->atacks[$id]['uid2']]]['enemy'] = -$this->users[$this->uids[$this->atacks[$id]['uid2']]]['enemy'];
				}
							
				$this->users[$this->uids[$this->atacks[$id]['uid1']]]['priems_z'] = implode('|',$zd1);
				$this->users[$this->uids[$this->atacks[$id]['uid2']]]['priems_z'] = implode('|',$zd2);	
				if($this->atacks[$id]['uid1']==$u->info['id']) {
					$u->info['priems_z'] = implode('|',$zd1);					
				} elseif($this->atacks[$id]['uid2']==$u->info['id']) {
					$u->info['priems_z'] = implode('|',$zd2);					
				}
				//
				//Проверяем тактики
				$i = 1;
				while( $i <= 6 ) {
					if( $this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic'.$i] > 25 ) {
						$this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic'.$i] = 25;
					}elseif( $this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic'.$i] <= 0 ) {
						$this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic'.$i] = 0;
					}
					if( $this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic'.$i] > 25 ) {
						$this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic'.$i] = 25;
					}elseif( $this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic'.$i] <= 0 ) {
						$this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic'.$i] = 0;
					}
					$i++;
				}
				//
				
				mysql_query('UPDATE `users` SET `notrhod` = "-1" WHERE `id` = "'.$this->atacks[$id]['uid1'].'" OR `id` = "'.$this->atacks[$id]['uid2'].'" LIMIT 2');
				
				
				//Обновляем задержки предметов
/*				mysql_query('UPDATE `items_users` SET `btl_zd` = `btl_zd` - 1 WHERE (`uid` = "'.$this->atacks[$id]['uid1'].'" OR `uid` = "'.$this->atacks[$id]['uid2'].'") AND `btl_zd` > 0 AND `inOdet` > 0 LIMIT 100');
					
				mysql_query('UPDATE `users` SET `notrhod` = "-1" WHERE `id` = "'.$this->atacks[$id]['uid1'].'" OR `id` = "'.$this->atacks[$id]['uid2'].'" LIMIT 2');
							
				//Обновляем данные в battle_users
				if($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'] <= 0){
					mysql_query('UPDATE `battle_users` SET `finish` = 1, `plus` = 1 WHERE `uid` = "'.$this->atacks[$id]['uid2'].'"');
					mysql_query('UPDATE `battle_users` SET `plus` = 1 WHERE `uid` = "'.$this->atacks[$id]['uid1'].'"');
				}
				elseif($this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'] <= 0){
					mysql_query('UPDATE `battle_users` SET `finish` = 1, `plus` = 1 WHERE `uid` = "'.$this->atacks[$id]['uid1'].'"');	
					mysql_query('UPDATE `battle_users` SET `plus` = 1 WHERE `uid` = "'.$this->atacks[$id]['uid2'].'"');	
				}
				else{}
*/
				if(isset($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mphodrefr']) && $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mphodrefr'] > 0) {
					$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'] += $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mphodrefr'];
					$this->users[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'];
				}
				if(isset($this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mphodrefr']) && $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mphodrefr'] > 0) {
					$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'] += $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mphodrefr'];
					$this->users[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'];
				}


				if(isset($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow_update'])) {
					
					//echo '[test1]';
					
					//echo '['.$this->atacks[$id]['uid1'].'->'.$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'].'+'.$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow_update'].'_heal_MP]';
					
					$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'] += $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow_update'];
					$this->users[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'];
					unset($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow_update']);
				}
				
				if(isset($this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow_update'])) {
					
					//echo '[test2]';
					
					//echo '['.$this->atacks[$id]['uid2'].'->'.$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'].'+'.$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow_update'].'_heal_MP]';
										
					$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'] += $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow_update'];
					$this->users[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'];
					unset($this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow_update']);
				}

				mysql_query('UPDATE `battle_users` SET 
					`exp_btl` = "'.$this->users[$this->uids[$this->atacks[$id]['uid2']]]['battle_exp'].'" 
					WHERE `uid` = "'.$this->atacks[$id]['uid2'].'" AND `battle` = "'.$this->info["id"].'"');
				mysql_query('UPDATE `battle_users` SET 
					`exp_btl` = "'.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['battle_exp'].'" 
					WHERE `uid` = "'.$this->atacks[$id]['uid1'].'" AND `battle` = "'.$this->info["id"].'"');
				
				if( $nofcast == false ) {
					mysql_query('DELETE FROM `battle_heal` WHERE `uid` = "'.$this->atacks[$id]['uid2'].'" OR `uid` = "'.$this->atacks[$id]['uid1'].'"');
				}

				mysql_query('UPDATE `battle_users` SET `hp` = "'.$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'].'"
					WHERE `battle` = "'.$this->info['id'].'" AND `uid` = "'.$this->atacks[$id]['uid1'].'" LIMIT 1');
				mysql_query('UPDATE `battle_users` SET `hp` = "'.$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'].'"
					WHERE `battle` = "'.$this->info['id'].'" AND `uid` = "'.$this->atacks[$id]['uid2'].'" LIMIT 1');
				
				if( $nofcast == false ) {
					mysql_query('UPDATE `pasha_use` SET `hod` = `hod` - 1 WHERE `uid` = "'.$this->atacks[$id]['uid1'].'" OR `uid` = "'.$this->atacks[$id]['uid2'].'"');
					mysql_query('DELETE FROM `pasha_use` WHERE (`uid` = "'.$this->atacks[$id]['uid1'].'" OR `uid` = "'.$this->atacks[$id]['uid2'].'") AND `hod` < 1');
				}
				
				/////////////////////////////////////
				//Восстановление манны 1% за ход
				/*
				$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'] += floor($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['s6']/4 + $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hod_minmana'] );
				$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'] += floor($this->stats[$this->uids[$this->atacks[$id]['uid2']]]['s6']/4 + $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hod_minmana'] );
				//
				$this->users[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'];
				$this->users[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'];
				//
				*/
				$last_yrn = array(
					1  => $last_yrn[1],
					2  => $last_yrn[2],
					10 => $this->users[$this->uids[$this->atacks[$id]['uid1']]]['battle_yron'],
					20 => $this->users[$this->uids[$this->atacks[$id]['uid2']]]['battle_yron']
				);
				
				$last_yrn[100] = floor($last_yrn[10]-$last_yrn[1]);
				$last_yrn[200] = floor($last_yrn[20]-$last_yrn[2]);				
				
				/*
				$this->users[$this->uids[$this->atacks[$id]['uid1']]]['last_yrn'] = $last_yrn[100];
				$this->users[$this->uids[$this->atacks[$id]['uid2']]]['last_yrn'] = $last_yrn[200];				
				unset($last_yrn);
				*/
				
				if( $newsf5 == false || $nofcast == true ) {
					if( $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] > 0 ) {
						$this->save_stats( $this->yhod_user( $this->atacks[$id]['uid2'], $this->atacks[$id]['uid1'], $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] ) );
						$priem->testDie( $this->yhod_user( $this->atacks[$id]['uid2'], $this->atacks[$id]['uid1'], $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['yhod'] ) );
					}elseif( $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] > 0 ) {
						$priem->testDie( $this->yhod_user( $this->atacks[$id]['uid1'], $this->atacks[$id]['uid2'], $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] ) );
						$this->save_stats( $this->yhod_user( $this->atacks[$id]['uid1'], $this->atacks[$id]['uid2'], $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['yhod'] ) );
					}
				}
				
				/*
				if( $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'] < 1 ) {
					if($this->users[$this->uids[$this->atacks[$id]['uid1']]]['bot_id'] == 0 && $this->users[$this->uids[$this->atacks[$id]['uid2']]]['bot_id'] > 0 ) {
						if( $this->users[$this->uids[$this->atacks[$id]['uid2']]]['bot_id'] == 416 ) {
							$u->addItem(8032,$this->atacks[$id]['uid1'],'|sudba=1');
						}
						echo '['.$this->atacks[$id]['uid2'].'+'.$this->users[$this->uids[$this->atacks[$id]['uid2']]]['bot_id'].']';					
						mysql_query('INSERT INTO `hip_kill` ( `uid`,`time`,`bot` ) VALUES ( "'.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['id'].'" , "'.time().'" , "'.$this->users[$this->uids[$this->atacks[$id]['uid2']]]['bot_id'].'" )');
					}
				}
				if( $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'] < 1 ) {
					if($this->users[$this->uids[$this->atacks[$id]['uid2']]]['bot_id'] == 0 && $this->users[$this->uids[$this->atacks[$id]['uid1']]]['bot_id'] > 0 ) {
						if( $this->users[$this->uids[$this->atacks[$id]['uid1']]]['bot_id'] == 416 ) {
							$u->addItem(8032,$this->atacks[$id]['uid2'],'|sudba=1');
						}
						echo '['.$this->atacks[$id]['uid1'].'-'.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['bot_id'].']';		
						mysql_query('INSERT INTO `hip_kill` ( `uid`,`time`,`bot` ) VALUES ( "'.$this->users[$this->uids[$this->atacks[$id]['uid2']]]['id'].'" , "'.time().'" , "'.$this->users[$this->uids[$this->atacks[$id]['uid1']]]['bot_id'].'" )');
					}
				}
				*/		
				$i = 1;
				while( $i <= 7 ) {
					$this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic'.$i] += 1;
					$this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic'.$i] += 1;
					$i++;
				}
				$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'] += 10000;
				$this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow'] += 10000;
				$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'] += 10000;
				$this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow'] += 10000;
				
				mysql_query('UPDATE `stats` SET
				
					`hpNow` = "'.mysql_real_escape_string($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow']).'",
					`mpNow` = "'.mysql_real_escape_string($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['mpNow']).'",
					`tactic1` = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic1']).'",
					`tactic2` = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic2']).'",
					`tactic3` = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic3']).'",
					`tactic4` = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic4']).'",
					`tactic5` = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic5']).'",
					`tactic6` = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic6']).'",
					`tactic7` = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid1']]]['tactic7']).'",
					
					`enemy` 	  = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid1']]]['enemy']).'",
					`battle_yron` = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid1']]]['battle_yron']).'",
					`last_hp` 	  = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid1']]]['last_hp']).'",
					`battle_exp`  = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid1']]]['battle_exp']).'",
					`priems_z`  = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid1']]]['priems_z']).'"
					
				WHERE `id` = "'.mysql_real_escape_string($this->atacks[$id]['uid1']).'" LIMIT 1');
				//
				//
				mysql_query('UPDATE `stats` SET
				
					`hpNow` = "'.mysql_real_escape_string($this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow']).'",
					`mpNow` = "'.mysql_real_escape_string($this->stats[$this->uids[$this->atacks[$id]['uid2']]]['mpNow']).'",
					`tactic1` = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic1']).'",
					`tactic2` = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic2']).'",
					`tactic3` = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic3']).'",
					`tactic4` = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic4']).'",
					`tactic5` = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic5']).'",
					`tactic6` = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic6']).'",
					`tactic7` = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid2']]]['tactic7']).'",
					
					`enemy` 	  = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid2']]]['enemy']).'",
					`battle_yron` = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid2']]]['battle_yron']).'",
					`last_hp` 	  = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid2']]]['last_hp']).'",
					`battle_exp`  = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid2']]]['battle_exp']).'",
					`priems_z`  = "'.mysql_real_escape_string($this->users[$this->uids[$this->atacks[$id]['uid2']]]['priems_z']).'"
					
				WHERE `id` = "'.mysql_real_escape_string($this->atacks[$id]['uid2']).'" LIMIT 1');
				//
				
				$this->users[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow'];
				$this->users[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'] = $this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow'];
				
				if( $nofcast == false ) { //Перенести в запрос после обновления на строку 7905
					$this->priemsRazmenMomentEnd($id,$at);
				}
				
				//if( $newsf5 == false || $nofcast == true ) {
					$priem->testDie($this->atacks[$id]['uid1'],$this->atacks[$id]['uid2']);
					$priem->testDie($this->atacks[$id]['uid2'],$this->atacks[$id]['uid1']);
				//}
				
				//

				//Эффекты требующие живого игрока tr_life_user
				/*if( floor($this->stats[$this->uids[$this->atacks[$id]['uid1']]]['hpNow']) < 1 ) {
					$sp = mysql_query('SELECT * FROM `eff_users` WHERE `tr_life_user` = "'.$this->atacks[$id]['uid1'].'" AND `delete` = "0" LIMIT 50');
					while( $pl = mysql_fetch_array($sp) ) {
						$pl['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$pl['v2'].'" LIMIT 1'));
						$this->delPriem($pl,$this->users[$this->uids[$this->atacks[$id]['uid1']]],3,$this->atacks[$id]['uid2']);
						echo 1;
					}
					echo 2;
				}
				if( floor($this->stats[$this->uids[$this->atacks[$id]['uid2']]]['hpNow']) < 1 ) {
					$sp = mysql_query('SELECT * FROM `eff_users` WHERE `tr_life_user` = "'.$this->atacks[$id]['uid2'].'" AND `delete` = "0" LIMIT 50');
					while( $pl = mysql_fetch_array($sp) ) {
						$pl['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$pl['v2'].'" LIMIT 1'));
						$this->delPriem($pl,$this->users[$this->uids[$this->atacks[$id]['uid2']]],3,$this->atacks[$id]['uid1']);
						echo 3;
					}
					echo 4;
				}*/
				//
				
				//Минусуем заряд приема \ эффекта
				$j = 1; $jn = 1;
				if( $nofcast == true ) {
					$j = 3;
				}
				while($j<=2) {
					$eff = $this->stats[$this->uids[$this->atacks[$id]['uid'.$j]]]['effects'];
					$i = 0; 
					while($i<count($eff)) {
						if(isset($eff[$i])) {
							if($eff[$i]['timeUse']==77 && $eff[$i]['hod']>-1) {
								$eff[$i]['hod']--;
								$eff[$i]['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$eff[$i]['v2'].'" LIMIT 1'));
								if( round($eff[$i]['priem']['minmana'] * $eff[$i]['x']) != 0 ) {
									//Отнимаем ману у того кто кастовал
									$priem->minMana($eff[$i]['user_use'],round($eff[$i]['priem']['minmana'] * $eff[$i]['x']));
									if( $this->stats[$this->uids[$eff[$i]['user_use']]]['mpNow'] <= 0 ) {
										$eff[$i]['hod'] = 0;
									}
								}
								if( strripos( $eff[$i]['data'] , 'minprocmanahod') == true ) {									
									$pvr = array(
										'x1'	=> 0,
										'x2'	=> 0,
										'd'		=> '',
										'i'		=> 0,
										'uid'	=> $eff[$i]['uid'],
										'color' => '',
										'color2'=> '',
										'effx'	=> '',
										'x'		=> $eff[$i]['name']
									);
									$pvr['d'] = explode('|',$eff[$i]['data']);
									while( $pvr['i'] < count($pvr['d']) ) {
										if( isset($pvr['d'][$pvr['i']])) {
											$pvr['d1'] = explode('=',$pvr['d'][$pvr['i']]);
											if( $pvr['d1'][0] == 'minprocmanahod' ) {
												$pvr['d1'] = explode('x',$pvr['d1'][1]);
												$pvr['x1'] = $pvr['d1'][0];
												$pvr['x2'] = $pvr['d1'][1];
											}
										}
										$pvr['i']++;
									}
																		
									$pvr['mp'] = round($this->stats[$this->uids[$pvr['uid']]]['mpAll']/100*rand($pvr['x1'],$pvr['x2']));
									$pvr['mpSee'] = 0;
									$pvr['mpNow'] = floor($this->stats[$this->uids[$pvr['uid']]]['mpNow']);
									$pvr['mpAll'] = $this->stats[$this->uids[$pvr['uid']]]['mpAll'];
									$pvr['mpTr'] = $pvr['mpAll'] - $pvr['mpNow'];
									
									//$pvr['mp'] = $btl->hphe( $u->info['id'] , $pvr['hp'] );
									
									if( $pvr['mpTr'] > 0 ) {
										//Требуется хилл
										if( $pvr['mpTr'] < $pvr['mp'] ) {
											$pvr['mp'] = $pvr['mpTr'];
										}
										$pvr['mpSee'] = '+'.$pvr['mp'];
										$pvr['mpNow'] += $pvr['mp'];
									}					
									if( $pvr['mpNow'] > $pvr['mpAll'] ) {
										$pvr['mpNow'] = $pvr['mpAll'];
									}elseif( $pvr['mpNow'] < 0 ) {
										$pvr['mpNow'] = 0;
									}
									if( $pvr['mpSee'] == 0 ) {
										$pvr['mpSee'] = '--';
									}
									
									$btl->stats[$btl->uids[$pvr['uid']]]['mpNow'] = $pvr['mpNow'];
									$btl->users[$btl->uids[$pvr['uid']]]['mpNow'] = $pvr['mpNow'];				
									mysql_query('UPDATE `stats` SET `mpNow` = "'.$btl->stats[$btl->uids[$pvr['uid']]]['mpNow'].'" WHERE `id` = "'.$pvr['uid'].'" LIMIT 1');
									
									$pvr['text'] = $this->addlt(1 , 21 , $this->users[$this->uids[$pvr['uid']]]['sex'] , NULL);	
									$pvr['text2'] = '{tm1} '.$pvr['text'].' на <font Color=#006699><b>'.$pvr['mpSee'].'</b></font> ['.$pvr['mpNow'].'/'.$pvr['mpAll'].'] (Мана)';
									$this->priemAddLog( $id, 1, 2, $pvr['uid'], 0,
										'<font color^^^^#'.$pvr['color2'].'>'.$pvr['x'].'</font>',
										$pvr['text2'],
										($this->hodID + 0)
									);
									//echo '[Восстанавливаем '.round(rand($pvr['x1'],$pvr['x2'])).'% маны.]';
									unset($pvr);
								}
								/*
								$re = $priem->hodUsePriem($eff[$i],$eff[$i]['priem']);
								if(isset($re['hod'])) {
									$eff[$i]['hod'] = $re['hod'];
								}
								*/
								if(isset($this->rehodeff[$eff[$i]['id']])) {
									$eff[$i]['hod'] = $this->rehodeff[$eff[$i]['id']];
								}
								if($eff[$i]['hod']>0) {
									$this->stats[$this->uids[$this->atacks[$id]['uid'.$j]]]['effects']['hod'] = $eff[$i]['hod'];
									mysql_query('UPDATE `eff_users` SET `hod` = "'.$eff[$i]['hod'].'" WHERE `id` = "'.$eff[$i]['id'].'" LIMIT 1');
								}else{
									//удаляем прием
									if($eff[$i]['v2']>0) {												
										if($j==1) {
											$jn = 2;
										}else{
											$jn = 1;	
										}
										$this->delPriem($eff[$i],$this->users[$this->uids[$this->atacks[$id]['uid'.$j]]],3,$this->atacks[$id]['uid'.$jn]);
									}
								}
							}elseif($eff[$i]['timeUse']==77 && $eff[$i]['hod']==-2) {
								$eff[$i]['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$eff[$i]['v2'].'" LIMIT 1'));
								$priem->hodUsePriem($eff[$i],$eff[$i]['priem']);
							}else{
								$eff[$i]['priem'] = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.$eff[$i]['v2'].'" LIMIT 1'));
								if( isset($eff[$i]['priem']['minmana']) && round($eff[$i]['priem']['minmana'] * $eff[$i]['x']) != 0 ) {
									//Отнимаем ману у того кто кастовал
									$priem->minMana($eff[$i]['user_use'],round($eff[$i]['priem']['minmana'] * $eff[$i]['x']));
									if( $this->stats[$this->uids[$eff[$i]['user_use']]]['mpNow'] <= 0 ) {
										$eff[$i]['hod'] = 0;
										if(isset($this->rehodeff[$eff[$i]['id']])) {
											$eff[$i]['hod'] = $this->rehodeff[$eff[$i]['id']];
										}
										if($eff[$i]['v2']>0) {												
											if($j==1) {
												$jn = 2;
											}else{
												$jn = 1;	
											}
											$this->delPriem($eff[$i],$this->users[$this->uids[$this->atacks[$id]['uid'.$j]]],3,$this->atacks[$id]['uid'.$jn]);
										}
									}
								}
							}

						}
						$i++;
					}
					$j++;
				}
				//				
				//
				//Обновляем текущего противника
				if( $u->info['id'] == $this->atacks[$id]['uid1'] ) {
					$u->info['enemy'] = $this->users[$this->uids[$this->atacks[$id]['uid1']]]['enemy'];
				}
				if( $u->info['id'] == $this->atacks[$id]['uid2'] ) {
					$u->info['enemy'] = $this->users[$this->uids[$this->atacks[$id]['uid2']]]['enemy'];
				}
				//Удаляем размен из базы
				mysql_query('DELETE FROM `battle_act` WHERE ( `uid1` = "'.$this->atacks[$id]['uid1'].'" AND `uid2` = "'.$this->atacks[$id]['uid2'].'" ) OR
				( `uid2` = "'.$this->atacks[$id]['uid1'].'" AND `uid1` = "'.$this->atacks[$id]['uid2'].'" )');

				//$this->a_restart_stats($this->atacks[$id]['uid1'],1);
				//$this->a_restart_stats($this->atacks[$id]['uid2'],1);

				unset($old_s1,$old_s2);
				unset($this->ga[$this->atacks[$id]['uid1']][$this->atacks[$id]['uid2']],$this->ga[$this->atacks[$id]['uid2']][$this->atacks[$id]['uid1']]);
				unset($this->ag[$this->atacks[$id]['uid1']][$this->atacks[$id]['uid2']],$this->ag[$this->atacks[$id]['uid2']][$this->atacks[$id]['uid1']]);
				unset($this->atacks[$id]);
				mysql_query('DELETE FROM `battle_act` WHERE `id` = "'.$id.'" LIMIT 1');
				//
				//Возвращаем старые характеристики
				/*
				$this->stats[$this->uids[$this->atacks[$id]['uid1']]] = $old_s1;
				$this->stats[$this->uids[$this->atacks[$id]['uid2']]] = $old_s2;
				*/
				unset($old_s1,$old_s2);
				//
				
			}
			if( $this->laterScript  != '' ) {
				eval($this->laterScript);
				//echo '['.$this->laterScript.']';
				$this->laterScript = '';
			}
	}
	$u->unlock();
}
	//Сохранение данные 
	public function save_stats( $uid ) {
			mysql_query('UPDATE `stats` SET
			
				`hpNow` = "'.$this->stats[$this->uids[$uid]]['hpNow'].'",
				`mpNow` = "'.$this->stats[$this->uids[$uid]]['mpNow'].'",
				`tactic1` = "'.$this->users[$this->uids[$uid]]['tactic1'].'",
				`tactic2` = "'.$this->users[$this->uids[$uid]]['tactic2'].'",
				`tactic3` = "'.$this->users[$this->uids[$uid]]['tactic3'].'",
				`tactic4` = "'.$this->users[$this->uids[$uid]]['tactic4'].'",
				`tactic5` = "'.$this->users[$this->uids[$uid]]['tactic5'].'",
				`tactic6` = "'.$this->users[$this->uids[$uid]]['tactic6'].'",
				`tactic7` = "'.$this->users[$this->uids[$uid]]['tactic7'].'",
				
				`enemy` 	  = "'.$this->users[$this->uids[$uid]]['enemy'].'",
				`battle_yron` = "'.$this->users[$this->uids[$uid]]['battle_yron'].'",
				`last_hp` 	  = "'.$this->users[$this->uids[$uid]]['last_hp'].'",
				`battle_exp`  = "'.$this->users[$this->uids[$uid]]['battle_exp'].'",
				`priems_z`  = "'.$this->users[$this->uids[$uid]]['priems_z'].'"
				
			WHERE `id` = "'.$uid.'" LIMIT 1');
	}
	
//Отображение НР
	public function hpSee($now,$all,$type = 1) {
		$r = '['.$now.'/'.$all.']';
		if($all > 10000) {
			$type = 2;
		}
		if($type == 1) {
			
		}elseif($type == 2) {
			$p1 = floor($now/$all*100);
			$r = '['.$p1.'/100%]';
		}
		return $r;
	}
	
//Быстрый лог
	public function addFlog($t,$u1,$u2)
	{
			$vLog = '';
			if(isset($this->info[$this->uids[$u1]]['id']))
			{
				$vLog .= 'time1='.time().'||s1='.$this->users[$this->uids[$u1]]['id']['sex'].'||t1='.$this->users[$this->uids[$u1]]['team'].'||login1='.$this->users[$this->uids[$u1]]['login'].'||';
			}
			if(isset($this->info[$this->uids[$u2]]['id']))
			{
				$vLog .= 'time2='.time().'||s2='.$this->users[$this->uids[$u2]]['sex'].'||t2='.$this->users[$this->uids[$u2]]['team'].'||login2='.$this->users[$this->uids[$u2]]['login'].'';
			}
			$vLog = rtrim($vLog,'||');
			$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
			$mas1['text'] = $t;
			$this->add_log($mas1);
	}
	
		
//Выводим лог боя
	public function logCache()
	{
		global $c,$u,$log_text;
		$thishodID = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'" ORDER BY `id` DESC LIMIT 1'));
		if(isset($hodID['id'])) {
			$hodID = $hodID['id'];
		}else{
			$hodID = 0;
		}
		
		if( $hodID > $this->info['hod'] ) {
			//unlink("../../battle_logs/btl_".$this->info['id'].".js");
			$this->info['hod'] = $hodID;
			mysql_query('UPDATE `battle` SET `hod` = "'.$hodID.'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
			if( $u->info['design'] == 1 ) {
				$js = ''; $pll = 0;
				if($_POST['idlog']<1){ $_POST['idlog'] = 0; }
				//
				$sp = mysql_query('SELECT 
				`id`,`type`,`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zona2`,`zonb1`,`zonb2`
				FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'" AND `id` > '.mysql_real_escape_string($_POST['idlog']).' AND `id_hod` > '.($this->hodID-7).' LIMIT 100');
				$jin = 0; $forYou2 = 0;
				while($pl = mysql_fetch_array($sp))
				{
					$jin++;
					$rt = $pl['text'];
					$pl['vars'] = str_replace('^^^^','rvnO',$pl['vars']);
					$rt = str_replace('{tm1}','<span class=\"date {fru}\">'.date('H:i',time()).'</span>',$rt);
					$rt = str_replace('{tm2}','<span class=\"date {fru}\">'.date('H:i',time()).'</span>',$rt);
					$rt = str_replace('{tm3}','<span class=\"date {fru}\">'.date('d.m.Y H:i',time()).'</span>',$rt);
					$rt = str_replace('{tm4}','<span class=\"date {fru}\">'.date('d.m.Y H:i',time()).'</span>',$rt);
					$pl['text'] = $rt;
					unset($rt);
					if($pll < $pl['id']) {
						$pll = $pl['id'];
					}
					$js = 'add_log('.$pl['id'].','.$forYou2.',"'.$pl['text'].'",'.$pl['id_hod'].',0,0,"'.str_replace('"','&quot;',$pl['vars']).'");'.$js;
				}
			$js .= 'id_log='.$pll.';';
		}else{
			$js = ''; $pll = 0;
			if($_POST['idlog']<1){ $_POST['idlog'] = 0; }
			//
			$sp = mysql_query('SELECT 
			`id`,`type`,`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zona2`,`zonb1`,`zonb2`
			FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'" AND `id` > '.mysql_real_escape_string($_POST['idlog']).' AND `id_hod` > '.($this->hodID-7).' LIMIT 100');
				$jin = 0; $forYou2 = 0;
				while($pl = mysql_fetch_array($sp))
				{
					$jin++;
					$rt = $pl['text'];
					//$rt = str_replace('^^^^','=',$rt);
					$pl['vars'] = str_replace('^^^^','rvnO',$pl['vars']);
					$rt = str_replace('{tm1}','<span class=\"date {fru}\">'.date('H:i',time()).'</span>',$rt);
					$rt = str_replace('{tm2}','<span class=\"date {fru}\">'.date('H:i',time()).'</span>',$rt);
					$rt = str_replace('{tm3}','<span class=\"date {fru}\">'.date('d.m.Y H:i',time()).'</span>',$rt);
					$rt = str_replace('{tm4}','<span class=\"date {fru}\">'.date('d.m.Y H:i',time()).'</span>',$rt);
					$pl['text'] = $rt;
					unset($rt);
					if($pll < $pl['id']) {
						$pll = $pl['id'];
					}
					$js = 'add_log('.$pl['id'].','.$forYou2.',"'.$pl['text'].'",'.$pl['id_hod'].',0,0,"'.str_replace('"','&quot;',$pl['vars']).'");'.$js;
				}
				$js .= 'id_log='.$pll.';';
			}
			//		 
			/*$fp = fopen("battle_logs/btl_".$this->info['id'].".js", "w");
			fwrite($fp, 'var vlogid = '.$this->info['hod'].';var loadingLogNow = true;function logRefleshedCache(){ '.$js.' }');
			fclose($fp);*/
			//
		}
		return true;
	}
						
//Выводим лог боя
	public function lookLog()
	{
		global $c,$u,$log_text;
			$js = ''; $pll = 0;
			
			$hodID = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'" ORDER BY `id` DESC LIMIT 1'));
			if(isset($hodID['id'])) {
				$hodID = $hodID['id'];
			}else{
				$hodID = 0;
			}
			$updt = 0;
			if( $hodID > $this->info['hod'] ) {
				//unlink("../../battle_logs/btl_".$this->info['id'].".js");
				$this->info['hod'] = $hodID;
				mysql_query('UPDATE `battle` SET `hod` = "'.$hodID.'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
				$updt = 1;
			}
			
			if($_POST['idlog']<1){ $_POST['idlog'] = 0; }
			//Переносим оставшийся лог в хранилище
			//mysql_query('INSERT INTO `battle_logs_save` SELECT * FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'" AND `id_hod` <= '.($this->hodID-2).'');
			//mysql_query('DELETE FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'" AND `id_hod` <= '.($this->hodID-2).'');
			//$this->saveLogs( $this->info['id'] , 'AND `id_hod` <= '.($this->hodID-2).'' );
			//

			$sp = mysql_query('SELECT 
			`id`,`type`,`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zona2`,`zonb1`,`zonb2`
			FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'" AND `id_hod` >= '.($this->hodID-3).' ORDER BY `id_hod` DESC , `id` DESC');
			//$sp = mysql_query('SELECT * FROM `battle_logs` WHERE `battle` = "'.$this->info['id'].'" AND `id` > '.mysql_real_escape_string($_POST['idlog']).' AND `id_hod` > '.($this->hodID-10).' LIMIT 150');
			$jin = 0; $forYou2 = 0;
			$js .= 'top.frames["main"].document.getElementById("battle_logg").innerHTML="";';
			while($pl = mysql_fetch_array($sp))
			{
				$jin++;
				if((true == false) && ($pl['type']==1 || $pl['type']==6)) {
					/*$dt = explode('||',$pl['vars']);
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
					
					$forYou = '';	 $forYou2 = 0;				
					if(($d['login1'] == $u->info['login2'] && $d['login1'] != '') || ($d['login1'] == $u->info['login'] && $d['login1'] != '')) {
						$forYou = 'forYou'; $forYou2 = 1;
					}elseif(($d['login2'] == $u->info['login2'] && $d['login2'] != '') || ($d['login2'] == $u->info['login'] && $d['login2'] != '')) {
						$forYou = 'forYou'; $forYou2 = 2;
					}
					
					//заменяем данные
					$rt = str_replace('{u1}','<span onClick=\"top.chat.addto(\''.$d['login1'].'\',\'to\'); return false;\" oncontextmenu=\"top.infoMenu(\''.$d['login1'].'\',event,\'chat\'); return false;\" class=\"CSSteam'.$d['t1'].'\">'.$d['login1'].'</span>',$rt);
					$rt = str_replace('{u2}','<span onClick=\"top.chat.addto(\''.$d['login2'].'\',\'to\'); return false;\" oncontextmenu=\"top.infoMenu(\''.$d['login2'].'\',event,\'chat\'); return false;\" class=\"CSSteam'.$d['t2'].'\">'.$d['login2'].'</span>',$rt);
					$rt = str_replace('{pr}','<b>'.$d['prm'].'</b>',$rt);
					$rt = str_replace('^^^^','=',$rt);
					$rt = str_replace('{tm1}','<span class=\"date '.$forYou.'\">'.date('H:i',$d['time1']).'</span>',$rt);
					$rt = str_replace('{tm2}','<span class=\"date '.$forYou.'\">'.date('H:i',$d['time2']).'</span>',$rt);
					$rt = str_replace('{tm3}','<span class=\"date '.$forYou.'\">'.date('d.m.Y H:i',$d['time1']).'</span>',$rt);
					$rt = str_replace('{tm4}','<span class=\"date '.$forYou.'\">'.date('d.m.Y H:i',$d['time2']).'</span>',$rt);
					
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
								
							$zns01 .= '<img src=\"http://img.likebk.com/i/zones/'.$d['t1'].'/'.$d['t2'].''.$zab1.'.gif\">';
							$zns02 .= '<img src=\"http://img.likebk.com/i/zones/'.$d['t2'].'/'.$d['t1'].''.$zab2.'.gif\">';
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
					
					//Повторная замена, если есть
					$rt = str_replace('{u1}','<span onClick=\"top.chat.addto(\''.$d['login1'].'\',\'to\'); return false;\" oncontextmenu=\"top.infoMenu(\''.$d['login1'].'\',event,\'chat\'); return false;\" class=\"CSSteam'.$d['t1'].'\">'.$d['login1'].'</span>',$rt);
					$rt = str_replace('{u2}','<span onClick=\"top.chat.addto(\''.$d['login2'].'\',\'to\'); return false;\" oncontextmenu=\"top.infoMenu(\''.$d['login2'].'\',event,\'chat\'); return false;\" class=\"CSSteam'.$d['t2'].'\">'.$d['login2'].'</span>',$rt);
					$rt = str_replace('{pr}','<b>'.$d['prm'].'</b>',$rt);
					$rt = str_replace('^^^^','=',$rt);
					$rt = str_replace('{tm1}','<span class=\"date '.$forYou.'\">'.date('H:i',$d['time1']).'</span>',$rt);
					$rt = str_replace('{tm2}','<span class=\"date '.$forYou.'\">'.date('H:i',$d['time2']).'</span>',$rt);
					$rt = str_replace('{tm3}','<span class=\"date '.$forYou.'\">'.date('d.m.Y H:i',$d['time1']).'</span>',$rt);
					$rt = str_replace('{tm4}','<span class=\"date '.$forYou.'\">'.date('d.m.Y H:i',$d['time2']).'</span>',$rt);
					
					//закончили заменять
					$pl['text'] = $rt;*/					
				}else{
					$rt = $pl['text'];
					//$rt = str_replace('^^^^','=',$rt);
					$pl['vars'] = str_replace('^^^^','rvnO',$pl['vars']);
					$rt = str_replace('{tm1}','<span class=\"date {fru}\">'.date('H:i',time()).'</span>',$rt);
					$rt = str_replace('{tm2}','<span class=\"date {fru}\">'.date('H:i',time()).'</span>',$rt);
					$rt = str_replace('{tm3}','<span class=\"date {fru}\">'.date('d.m.Y H:i',time()).'</span>',$rt);
					$rt = str_replace('{tm4}','<span class=\"date {fru}\">'.date('d.m.Y H:i',time()).'</span>',$rt);
					$pl['text'] = $rt;
				}
				unset($rt);
				if($pll < $pl['id']) {
					$pll = $pl['id'];
				}
				$js .= 'add_log('.$pl['id'].','.$forYou2.',"'.$pl['text'].'",'.$pl['id_hod'].',0,0,"'.str_replace('"','&quot;',$pl['vars']).'");';
			}
			$js .= 'id_log='.$pll.';';
			//$js = bzcompress($js,9);
			
			if( $updt == 1 ) {	 
				/*$fp = fopen("../../battle_logs/btl_".$this->info['id'].".js", "w");
				fwrite($fp, 'var vlogid = '.$this->info['hod'].';var loadingLogNow = true;function logRefleshedCache(){ '.$js.' }');
				fclose($fp);*/
			}
			
		return $js;
	}
	
//Добавляем в лог
	public function add_log($mass)
	{
		if($mass['time']!='' && $mass['text'] != '')
		{
			//mysql_query('LOCK TABLES battle_logs WRITE');
			
			$ins = mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$mass['text'].'","'.$mass['vars'].'","'.$mass['zona1'].'","'.$mass['zonb1'].'","'.$mass['zona2'].'","'.$mass['zonb2'].'","'.$mass['type'].'")');
			
			//mysql_query('UNLOCK TABLES');
		}
	}
		
	///Комментатор
	public function get_comment(){
		$boycom = array ('А танцуешь ты лучше.','А мы что, в прятки тут играем?','А вы разве пингвинов никогда не видели?','А, ведь когда-то, вы были красивыми… А теперь? Ну и рожи! Жуть!','А потом еще труп пинать будут.','А я вчера ночью за соседями подглядывал. Они точно так же кувыркались','А ведь вы живых людей дубасите...','А вот я вчера в зоопарке был...','А вы в стройбате не служили?','А вы видели, чтобы так на улице делали!?','А вы знали что ёжики размножаются в интернете?','А жить-то, как хочется:','А из-за чего вы собственно дерётесь?','А чего ржёте, вы ещё остальных не видели','А что произойдёт если ты испугаешся до полусмерти дважды?!','Больше так не делай. Ты же не садист?','Без комментариев...','Больно ведь!','Быстро ты за монитор спрятался!','Все хотят попасть в рай, но никто не хочет умирать!','Вчера с такой девчонкой познакомился.','Всего 5 минут знакомы, а дерутся, словно супруги с 20-ти летним стажем...','Все. Я так больше не могу.','В конце концов, кто-то победит?','Вы чего, с дерева упали?','Возятся как сонные мухи... давайте я вам лучше анекдот расскажу: ...','Вот видишь, как полезно чистить зубы на ночь?','Вот вы все руками махаете, а за вами уже очередь','Вот попадёте вы в плен и вас там будут долго бить. Но вы ничего не расскажете... и не потому, что вы такой стойкий, просто вы ничего не знаете','Вы бы лучше пошли потренировались!','Вы все еще разминаетесь? Позовите, когда кости в муку друг другу разминать будете.','Вы же бойцы! Имейте совесть!','Гаси недоумка!','Да, если бы я смог это остановить, то получил бы нобелевскую премию `За мир` ','Да куда они бьют?!','Давайте быстрее! За вами уже очередь образовалась.','Давайте обойдемся сегодня таймаутом. А? А то мне уже кошмары скоро будут сниться.','Дерутся как девчонки!','Дети, посмотрите налево... Ой!.. Нет, туда лучше не смотреть.','Если так будет продолжаться, то скоро мы заснем!','Если бы у меня было кресло-качалка, я бы в нём качался...','Если вы что-то сказать хотите, то лучше молчите :)','Жестокость не порок.','Жизнь вне нашего клуба - это пустая трата кислорода!!!','Жми! Дави! Кусай! Царапай!','За такие бои надо в хаос отправлять!','Знаете откуда в комиссионном магазине столько вещей? Это я после ваших гулянок собираю и сдаю туда. Иногда вместе с частями тела, застрявшими в них.','Здесь люди так близки друг к другу. Просто иначе ударить нельзя.','И пролитая кровь еще пульсирует...','Инвалидов развелось...','Какой бой!!!','Кто!? Кто здесь?!','Кто вас этому научил?','Кузнечик, блин...','Куплю импортный проигрыватель грампластинок.','Лошадью ходи!','Лучше враг, чем друг - враг.','Ладно, вы тут пока друг друга за волосы таскайте, а я пойду, пообедаю.','Мне ваш балет уже надоел!','Может, начнется-таки настоящий бой???','Мысли лезут в голову изнутри, а удары снаружи.','Ну и где ваши коронные удары? Где живописные падения я спрашиваю!','Ну, нельзя же так наотмашь лупить!','Надо раньше было думать, теперь смертельно поздно...','На такое зрелище билеты продавать можно. Народ ухохочется!','Нет! Не надо драки! А... ладно деритесь, все равно не умеете.','Нет, ну должен быть повод, должен же быть повод?','Нет, я отказываюсь это комментировать!','Не таких обламывали!','Ну выпили вы рюмку, ну две... ну литр, ну два... так зачем же после этого драку затевать?!','Ну и кто за этот погром платить будет?','Ну и оскал у вас. Из вашей улыбки кастеты делать можно.','Ну, что же ты..? Не печалься. Выше голову, так по ней удобней попасть.','Ничего... Блок тоже удар.','Обернись!!!.... Поздно...','Ого! Научите меня так не делать.','Осторожно! Сделаешь дырочку, уже не запломбируешь!','Оно вам надо???','Обычное дело...там что-то отклеилось.','Ой, и заболтался я с вами...','Он же не промахнётся если ты не отойдёшь!','По-моему, кому-то светит инвалидность.','Подкинь ему грабли, на которые он еще не наступал.','Прав был кот Леопольд, давайте жить дружно?','При ударе в живот нарушается кислотно-щелочной баланс.','Проверь, не торчит ли у тебя нож из живота.','Перестаньте мне орать!','Подкинь ему грабли, на которые он еще не наступал.','Прыгают тут как блохи... Все, я пошел за дихлофосом!','Разбудите меня когда эта порнография закончится...','Ребенок сильнее ударил бы!','Славно вмазал!','Славно они веселятся','Смотрю вот на вас, и слезы наворачиваются.','Сначала учатся ходить, а потом только в драку лезут.','Так они друг другу что-нибудь сломают.','Так ты ему все кости переломаешь!','У меня в подъезде точно так же соседа отмудохали','Убогих развелось...','Ух ты, какой прыткий!','Фашист!! Надо ж, так по больному месту врезать...','Хватит бить его об угол моей кабинки! Мне же потом ее чинить.','Хулиганы, прекратите немедленно!','Хочешь, подскажу, куда он ударит?','Хорошо, что у меня ловкости больше чем у вас всех, а то б вы и меня в инвалидную коляску посадили бы.','Хороший бой!','Хороший удар!','Хиляк-разрядник!','Что ты его за волосы схватил?! Отпусти немедленно!','Щас я вас настигну, вот тогда мы и похохочем','Это была какая-то неизвестная мне техника...','Это же противник, а не глина! Хватит мяться!','Это не бой, это издевательское избиение.','Это поубавит спеси','Это и был твой план `Б` ?','Это была какая-то неизвестная мне техника...','Я же предупреждал, - будет больно.','Я не страдаю безумием. Я наслаждаюсь им каждую минуту :)','Я красивый, я сильный, я умный, я добрый. А вот вы? Вы себя-то видели?!','Я тоже умею драться, но не буду...','(тревожно озираясь) я вам по секрету скажу... за вами наблюдают!','<вырезано цензурой> после боя я этих <вырезано цензурой> обоих в <вырезано цензурой> и <вырезано цензурой>','<вырезано цензурой> каратисты фиговы');
		$act_com = array();
		if(rand(1,6) == rand(1,6))
		{
			$txt = '{tm1} <i>Комментатор: '.$boycom[rand(0,count($boycom)-1)].'</i>';
									
			$vLog = 'time1='.time().'';									
			$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');									
			$mas1['text'] = $txt;
			$this->add_log($mas1);
			
		} else {
			return false;
		}
	}
	
	//Расчет типа удара от оружия
		public function weaponTx($item)
		{
			$tp = 0;
			if(isset($item['id']))
			{
				$itm = $this->lookStats($item['data']);
				//рубящий урон
				$t2 = round(0+$itm['tya2'],2);
				//колящий урон
				$t1 = round(0+$itm['tya1'],2);
				//дробящего урон
				$t3 = round(0+$itm['tya3'],2);
				//режущий урон
				$t4 = round(0+$itm['tya4'],2);
				//урон огня
				$t5 = round(0+$itm['tym1'],2);
				//урон воды
				$t7 = round(0+$itm['tym3'],2);
				//урон земли
				$t8 = round(0+$itm['tym4'],2);
				//урон воздуха
				$t6 = round(0+$itm['tym2'],2);
				//урон света
				$t9 = round(0+$itm['tym5'],2);
				//урон тьмы
				$t10 = round(0+$itm['tym6'],2);
				//урон серой магией
				$t11 = round(0+$itm['tym7'],2);
				
				$i = 0;
				if($t1+$t2+$t3+$t4+$t5+$t6+$t7+$t8+$t9+$t10+$t11 > 0)
				{
					$z = floor(rand(0,1000000000)/10000000);
					$i = 1; $j = 1;
					$gmax = 0;
					$gmx  = 0;
					$inr = array(); //зоны которые участвуют в "конкурсе"
					while($i <= 11)
					{
						if(${'t'.$i}>0)
						{
							if(${'t'.$i}>$gmx)
							{
								$gmx = ${'t'.$i};
								$gmax = $i;
							}elseif(${'t'.$i}==$gmx)
							{
								if(rand(0,1)==1)
								{
									$gmax = $i;
								}
							}
							$inr[$j] = $i;
							$j++; 
						}
						$i++;
					}
					
					//Мешаем элементы массива
					shuffle($inr);
					
					//выводим случайный тип урона
					$i = 1; $lst = 0;
					while($i<=$j)
					{
						$v = ${'t'.$inr[$i]};
						if($v>0)
						{
							$z = floor(rand(0,1000000000)/10000000);
							$v += $lst;
							if($v>$z)
							{
								$tp = $inr[$i];
								$i = $j+1;
							}else{
								$lst = $v;
							}
						}
						$i++;
					}
					
					if($gmx>30)
					{
						if(rand(0,2)==1)
						{
							$tp = $gmax;
						}
					}
					
					if($tp==0)
					{
						$tp = $gmax;
					}
				}				
			}else{
				$tp = 12;
			}	
			return $tp;
		}
		
		
	//Расчет урона от оружия
		public function weaponAt($item,$st,$x)
		{
			$tp = 0;
			$tp20 = 0;
			if(isset($item['id']))
			{
				$itm = $this->lookStats($item['data']);				
				//начинаем расчет урона
				$min = $itm['sv_yron_min']+$itm['yron_min']+$st['minAtack'];
				$max = $itm['sv_yron_max']+$itm['yron_max']+$st['maxAtack'];
				if($x!=0)
				{
					/*
					Колющий - 60% Силы и 40% Ловкости. 
					Рубящий - 70% Силы 20% Ловкости и 20% Интуиции. 
					Дробящий - 100% Силы. 
					Режущий - 60% Силы и 40% Интуиции.
					...........новый................
					 Дробящий (дубины и булавы): 95% Силы.
					- Режущий (мечи): 45% Силы и 45% Интуиции.
					- Колющий (ножи и кинжалы): 45% Силы и 55% Ловкости.
					- Рубящий (топоры): 60% Силы 25% Ловкости и 25% Интуиции.

					*/
					//Тип урона: 0 - нет урона, 1 - колющий, 2 - рубящий, 3 - дробящий, 4 - режущий, 5 - огонь, 6 - воздух, 7 - вода, 8 - земля, 9 - свет, 10 - тьма, 11 - серая
					if($x==1)
					{
						//колющий
						$wst = $st['s1']*0.45+$st['s2']*0.55;
						$min += 5+(ceil($wst*1.4)/1.75)+$st['minAtack'];
						$max += 7+(ceil(0.4+$min/0.9)/1.75)+$st['maxAtack'];
						$tp20 = 1;
					}elseif($x==2)
					{
						//рубящий
						$wst = $st['s1']*0.60+$st['s2']*0.25+$st['s3']*0.25;
						$min += 5+(ceil($wst*1.4)/1.75)+$st['minAtack'];
						$max += 7+(ceil(0.4+$min/0.9)/1.75)+$st['maxAtack'];
						$tp20 = 2;
					}elseif($x==3)
					{
						//дробящий
						$wst = $st['s1']*0.80;
						$min += 5+(ceil($wst*1.4)/1.75)+$st['minAtack'];
						$max += 7+(ceil(0.4+$min/0.9)/1.75)+$st['maxAtack'];
						$tp20 = 3;
					}elseif($x==4)
					{
						//режущий
						$wst = $st['s1']*0.45+$st['s3']*0.45;
						$min += 5+(ceil($wst*1.4)/1.75)+$st['minAtack'];
						$max += 7+(ceil(0.4+$min/0.9)/1.75)+$st['maxAtack'];
						$tp20 = 4;
					}elseif($x>=5 && $x<=22)
					{
						//урон магии и магии стихий
						$wst = $st['s1']*0.01+$st['s2']*0.01+$st['s3']*0.01+$st['s5']*0.06;
						$min += 3+(ceil($wst*1.4)/2.25)+$st['minAtack'];
						$max += 5+(ceil(0.4+$min/0.9)/2.25)+$st['maxAtack'];
						$tp20 = 5;
					}else{
						//без профильного урона
						
					}
					
					$wst = ($st['s1']*0.02+$st['s2']*0.02+$st['s3']*0.05);
					$min1 = -2+ceil($wst*1.4)/1.25;
					$max2 = 4+ceil(0.4+$min1/0.9)/1.25;	
					
					$min =	round(($min+$min1));	
					$max =	round(($max+$max1));		
				}
				$tp = rand(($min+$max)/3.5,(($min+$max)/3.5 + (($min+$max)/3.5)/100*7));
			}
			return $tp;
		}
		
	//Расчет урона от оружия
		public function weaponAt22($item,$st,$x)
		{
			$tp = 0;
			$tp20 = 0;
			if(isset($item['id']))
			{
				$itm = $this->lookStats($item['data']);				
				//начинаем расчет урона
				$min = $itm['sv_yron_min']+$itm['yron_min']+$st['minAtack'];
				$max = $itm['sv_yron_max']+$itm['yron_max']+$st['maxAtack'];
			}
			return array($min,$max);
		}

		public function domino($itm) {
			$r = 0;
			//0 - inOdet , 1 - class , 2 - class-point , 3 - anti_class , 4 - antic_lass-point	 , 5 - level , 6 level_u
			//15 предметов
			$clss = array(
				1   => 100, //шлем
				2   => 80,  //наручи
				3   => 150, //оружие
				14  => 100, //щит
				5   => 200, //броня
				7   => 50,  //пояс
				17  => 50,  //ботинки
				10  => 80,  //кольцо
				11  => 80,  //кольцо
				12  => 80,  //кольцо
				9   => 100, //амулет
				8   => 100, //серьги
				4   => 50,  //рубаха
				16  => 80,  //поножи
				6   => 50   //плащ
			);
			$r += $clss[$itm[0]];
			if($itm[10] > 0) {
				//екр.предмет
				if($itm[10] < 500) {
					//не артефакт
					$r += $clss[$itm[0]]*4;
				}else{
					//артефакт
					$r += $clss[$itm[0]]*8;
				}
			}
			return $r;
		}
		
		public function adomino($itm) {
			$r = 0;
			//0 - inOdet , 1 - class , 2 - class-point , 3 - anti_class , 4 - antic_lass-point	 , 5 - level , 6 level_u
			//15 предметов
			$clss = array(
				1   => 80, //шлем
				2   => 60,  //наручи
				3   => 130, //оружие
				14  => 80, //щит
				5   => 180, //броня
				7   => 30,  //пояс
				17  => 30,  //ботинки
				10  => 50,  //кольцо
				11  => 50,  //кольцо
				12  => 50,  //кольцо
				9   => 80, //амулет
				8   => 80, //серьги
				4   => 30,  //рубаха
				16  => 50,  //поножи
				6   => 30   //плащ
			);
			$r += $clss[$itm[0]];
			return $r;
		}
		
		public function domino_lvl($r,$lvl,$lvl_itm) {
			if($lvl < $lvl_itm) {
				$r = $r*((50-$lvl+$lvl_itm)/100);
				//расчет урона, если есть добавочные бонусы на подобии екр.вещей \ артефактов, либо легендарных предметов
				$r = ceil($r);
			}
			return $r;
		}
		/*
		public $bal = array(
			//Расчет шанса победы X - Y
			// танк , уворот , крит , силовик , универсал , маг
			'Танк'   	=> array(0,50,90,00,90,50,50), // танк
			'Уворот' 	=> array(0,00,50,90,00,50,70), // уворот
			'Крит'   	=> array(0,90,00,50,90,30,50), // крит
			'Силовик'   => array(0,00,90,00,50,50,50), // силовик
			'Универсал' => array(0,50,30,90,00,50,70), // универсал
			'Маг' 		=> array(0,90,30,00,90,50,50)  // маг

		);
		*/
		
		/*
		public function domino_all($v1,$v2,$d1,$d2) {
			// Мощность класса 1 , Мощность класса 2 , Анти 1 , Анти 2
			//Расчет бонусов
			$mx = 0;
			$cs = array(NULL,'Танк','Уворот','Крит','Силовик','Универсал','Маг');
			$r = array(
				0 => 0,
				'Крит'=>array(),
				'Танк'=>array(),
				'Уворот'=>array(),
				'Универсал'=>array(),
				'Силовик'=>array(),
				'Маг'=>array()
			);
			$i = 0;
			while($i <= 7) {
				if(isset($v1[$i]) || isset($v2[$i])) {
					$r[$cs[$i]] = round(((1+($v1[$i]*1.3)-$v2[$i]+$d1[$i]+$d2[$i])/1300),2);
					if($v1[$i] > $mx) {
						$mx = $v1[$i];
						$r[0] = $cs[$i];
						$r[1] = $i;
					}
				}
				$i++;
			}
			return $r;
		}*/
 
		public function yronLvl($lvl1,$lvl2) {
			$r = array(
				1  => array(0,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200),
				2  => array(0,600,400,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200),
				3  => array(0,1000,800,600,400,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200),
				4  => array(0,1400,1200,1000,800,600,400,200,200,200,200,200,200,200,200,200,200,200,200,200,200,200),
				5  => array(0,1800,1600,1400,1200,1000,800,600,400,200,200,200,200,200,200,200,200,200,200,200,200,200),
				6  => array(0,2200,2000,1800,1600,1400,1200,1000,800,600,400,200,200,200,200,200,200,200,200,200,200,200),
				7  => array(0,2600,2400,2200,2000,1800,1600,1400,1200,1000,800,600,400,200,200,200,200,200,200,200,200,200),
				8  => array(0,3000,2800,2600,2400,2200,2000,1800,1600,1400,1200,1000,800,600,400,200,200,200,200,200,200,200),
				9  => array(0,3400,3200,3000,2800,2600,2400,2200,2000,1800,1600,1400,1200,1000,800,600,400,200,200,200,200,200),
				10 => array(0,3800,3600,3400,3200,3000,2800,2600,2400,2200,2000,1800,1600,1400,1200,1000,800,600,400,200,200,200),
				11 => array(0,4200,4000,3800,3600,3400,3200,3000,2800,2600,2400,2200,2000,1800,1600,1400,1200,1000,800,600,400,200),
				12 => array(0,4600,4400,4200,4000,3800,3600,3400,3200,3000,2800,2600,2400,2200,2000,1800,1600,1400,1200,1000,800,600),
				13 => array(0,5000,4800,4600,4400,4200,4000,3800,3600,3400,3200,3000,2800,2600,2400,2200,2000,1800,1600,1400,1200,1000),
				14 => array(0,5400,5200,5000,4800,4600,4400,4200,4000,3800,3600,3400,3200,3000,2800,2600,2400,2200,2000,1800,1600,1400),
				15 => array(0,5800,5600,5400,5200,5000,4800,4600,4400,4200,4000,3800,3600,3400,3200,3000,2800,2600,2400,2200,2000,1800),
				16 => array(0,6200,6000,5800,5600,5400,5200,5000,4800,4600,4400,4200,4000,3800,3600,3400,3200,3000,2800,2600,2400,2200),
				17 => array(0,6600,6400,6200,6000,5800,5600,5400,5200,5000,4800,4600,4400,4200,4000,3800,3600,3400,3200,3000,2800,2600),
				18 => array(0,7000,6800,6600,6400,6200,6000,5800,5600,5400,5200,5000,4800,4600,4400,4200,4000,3800,3600,3400,3200,3000),
				19 => array(0,7400,7200,7000,6800,6600,6400,6200,6000,5800,5600,5400,5200,5000,4800,4600,4400,4200,4000,3800,3600,3400),
				20 => array(0,7800,7600,7400,7200,7000,6800,6600,6400,6200,6000,5800,5600,5400,5200,5000,4800,4600,4400,4200,4000,3800),
				21 => array(0,8200,8000,7800,7600,7400,7200,7000,6800,6600,6400,6200,6000,5800,5600,5400,5200,5000,4800,4600,4400,4200)
			);
			$r = floor($r[$lvl1][$lvl2]/100);
			$r = 0;
			return $r;
		}
		
	//Расчет защиты
		public function zago($v,$mg1,$mg2) {
			/*if($v > 1000) {
				$v = 1000;
			}
			$r = (1-( pow(0.5, ($v/300) ) ))*100;		
			return $r*0.9;*/
			//$r = round( (1-( pow(0.5, ($v/399.51) ) ))*100 , 2 );
			
			//if( $this->info['dn_id'] > 0 ) {
				if( $v > 1700 ) {
					$v = 1700;
				}
				$r = round( (1-( pow(0.5, ($v/(399.51)) ) ))*100 , 2 );
				if( $this->info['razdel'] >= 1 ) {
					if( $r > 92 && $mg1 == 0 && $mg2 > 0 ) {
						$r = 92;
					}
				}
			/*}else{
				if( $v > 1750 ) {
					$v = 1750;
				}
				$r = round( (1-( pow(0.5, ($v/(121+399.51)) ) ))*100 , 2 );
			}*/
			/*$r = round( (1-( pow(0.5, ($v/541.51) ) ))*100 , 2 );
			if( $r > 95 ) {
				$r = 95;
			}*/
			
			return $r;
		}
	//Расчет защиты (магия)
		public function zmgo($v) {
			/*if($v > 1000) {
				$v = 1000;
			}
			$r = (1-( pow(0.5, ($v/300) ) ))*100;*/
			$r = (1-( pow(0.5, ($v/250) ) ))*100;		
			return $r;
		}
		
	/* Расчет урона */
		public function yrn($st1, $st2, $u1, $u2, $level, $level2, $type, $min_yron, $max_yron, $min_bron, $max_bron, $vladenie, $power_yron, $power_krit, $zashita, $ozashita, $proboi, $weapom_damage, $weapom_min, $weapom_max, $za_proc, $zm_proc, $zashitam , $ozashitam , $item_type ) {

			global $u;
			
			//Поправка
			if( $zashita < 1 ) {
				$zashita = 1;
			}
			
			//Параметры для возврвата
			$r = array('min' => 0, 'max' => 0, 'type' => $type);
			$p = array(
				'Y'		=> 0,
				'B'		=> array(0 => 0, 1 => 0, 'rnd' => false),
				'L'		=> $level,
				'W'		=> array($min_yron, $max_yron, 'rnd' => false), //минимальный урон //максимальный урон добавочный
				'U'		=> $vladenie, //владение оружием
				'M'		=> $power_yron, //мощность урона
				'K'		=> $power_krit, //мощность крита
				'S'		=> 0,  //влияние статов на проф.урон
				'T'		=> 1,   //Кф. оружия
				'iT'	=> 1,	//Итоговый доп. Кф. оружия
				/*
					(S) - влияние наших статов на профильный урон
					Колющий: S = Сила * 0,6 + Ловкость * 0,4
					Рубящий: S = Сила * 0,7 + Ловкость * 0,2 + Интуиция * 0,2
					Дробящий: S = Сила * 1
					Режущий: S = Сила * 0,6 + Интуиция * 0,4
				*/
			);
			
			//Умножитель 1.33 для двуручки и 1.00 для одной руки
			if ($weapom_damage == 0) { $p['T'] = 1; }elseif($weapom_damage == 1) {$p['T'] = 1.33;$p['iT'] = 1.33;}
			
			//Расчет типа урона			
				//колющий
						if($r['type'] == 1) {		$p['S'] = $st1['s1'] * 0.60 + $st1['s2'] * 0.40; 
													$p['U'] = $st1['a1'] * 0.7; //кинжалы
				//рубящий
					}elseif($r['type'] == 2) {		$p['S'] = $st1['s1'] * 0.60 + $st1['s2'] * 0.30 + $st1['s3'] * 0.10;
													$p['U'] = $st1['a2']; //топоры
				//дробящий
					}elseif($r['type'] == 3) {		$p['S'] = $st1['s1'] * 0.80;
													$p['U'] = $st1['a3'] * 1.2; //дубины
				//режущий
					}elseif($r['type'] == 4) {		$p['S'] = $st1['s1'] * 0.45 + $st1['s3'] * 0.45;
													$p['U'] = $st1['a4']; //мечи
				//Магиечески
					}elseif($r['type'] >= 5){		$p['S'] = $st1['s1'] * 0.5 + $st1['s2'] * 0.5;	
													$p['U'] = $st1['mg'.($r['type']-4)]; //магией					
					}else {
													$p['S'] = ($st1['s1']*1); $p['U']=0; // для кулака(нужно переписывать 
					}

					
					if( $st2['mg3'] > 10 ) {
						//Если маг воды
						$zashita -= round($zashita/100*20);
					}
					
					/*
					//колющий
							if($r['type'] == 1) {		$p['S'] = $st1['s1'] * 0.15 + $st1['s2'] * 0.35; 
														$p['U'] = $st1['a1']*0.7; //кинжалы
					//рубящий
						}elseif($r['type'] == 2) {		$p['S'] = $st1['s1'] * 0.3 + $st1['s2'] * 0.25 + $st1['s3'] * 0.25;
														$p['U'] = $st1['a2']; //топоры
					//дробящий
						}elseif($r['type'] == 3) {		$p['S'] = $st1['s1'] * 0.7;
														$p['U'] = $st1['a3']*0.7; //дубины
					//режущий
						}elseif($r['type'] == 4) {		$p['S'] = $st1['s1'] * 0.3 + $st1['s3'] * 0.5;
														$p['U'] = $st1['a4']; //мечи
					//Магиечески
						}elseif($r['type'] >= 5){		$p['S'] = $st1['s1'] * 0.4 + $st1['s2'] * 0.4;	
														$p['U'] = $st1['mg'.($r['type']-4)]; //магией					
						}else {
														$p['S'] = ($st1['s1']*1); $p['U']=0; // для кулака(нужно переписывать 
						}
					*/
					
					//$p['S'] = $p['S'];
			//Выставление параметров		
				$r['bron'] = array($min_bron, $max_bron); //Броня зоны куда бьем
				$r['bron']['rnd'] = rand($r['bron'][0],$r['bron'][1]);
				$r['bron']['rnd'] += $r['bron']['rnd']*0.25; //искуственное поднятие брони +25%
				
				$r['za'] = $zashita; //Защита от урона
				$r['oza'] = $ozashita; //Особенность Защиты от урона
				
				$r['zm'] = $zashitam; //Защита от урона
				$r['ozm'] = $ozashitam; //Особенность Защиты от урона
				
				
			//Остальные расчеты	
				/*if($p['S'] > 0) {
					$p['B'][0] = round((ceil($p['S']*1.4)/1.25)+2);
				}else{
					$p['B'][0] = round((ceil($st1['s1']*1.4)/1.25)+2);
				}
				$p['B'][1] = round(5+ceil(0.4+($p['B'][0]-0)/0.9)/1.25);			
				*/
				$p['B'][0] = 5;
				$p['B'][1] = 9;
				$p['B']['rnd'] = rand($p['B'][0],$p['B'][1]);
				
				$p['W']['rnd'] = rand($p['W'][0],$p['W'][1]);
				
				//$p['U'] = $p['U']/2;
				
			//Обычный урон
				$r['min']  = (($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(1+0.07*$p['U']))*(1+$p['M']/100);
				$r['max']  = (($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(1+0.07*$p['U']))*(1+$p['M']/100);
				

			//Критический урон
			/*
				$r['Kmin'] = ((($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(1+0.07*$p['U']))*(1+$p['M']/100))*(2+$p['K']/100);
				$r['Kmax'] = ((($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(1+0.07*$p['U']))*(1+$p['M']/100))*(2+$p['K']/100);
			*/
				$r['Kmin'] = ((($p['B'][0]+$p['L']+$p['S']+$p['W'][0])*$p['T']*(1+0.07*$p['U']))*(1+($p['K']+$p['M'])/100))*2;
				$r['Kmax'] = ((($p['B'][1]+$p['L']+$p['S']+$p['W'][1])*$p['T']*(1+0.07*$p['U']))*(1+($p['K']+$p['M'])/100))*2;
			
				$r['min'] = floor($r['min']);
				$r['max'] = floor($r['max']);
				$r['Kmin'] = floor($r['Kmin']);
				$r['Kmax'] = floor($r['Kmax']);					
								
				$r['min'] += $weapom_min;
				$r['max'] += $weapom_max;
				$r['Kmin'] += $weapom_min*2;
				$r['Kmax'] += $weapom_max*2;
				
			//Минимальное значение урона
				$r['min_'] = floor($r['min']*0.01);
				$r['max_'] = floor($r['max']*0.01);
				$r['Kmin_'] = floor($r['Kmin']*0.01);
				$r['Kmax_'] = floor($r['Kmax']*0.01);
				$r['min_'] = 1;
				$r['max_'] = 1;
				$r['Kmin_'] = 1;
				$r['Kmax_'] = 1;
							
											
			//Расчет брони

				//для обычного
				if( $r['type'] < 5) {
					$r['min_abron'] = round($r['min']*0.01);
					$r['max_abron'] = round($r['max']*0.01);
					
					if($proboi != 0) {
						$r['bron']['rnd'] = floor($r['bron']['rnd']/100*(100-$proboi));
					}
					
					$r['min'] -= $r['bron']['rnd'];
					$r['max'] -= $r['bron']['rnd'];
					/*
					if($r['min'] < $r['min_abron']) {
						$r['min'] = $r['min_abron'];
					}
					if($r['max'] < $r['max_abron']) {
						$r['max'] = $r['max_abron'];
					}
					*/
					
					
					//для крита
					$r['Kmin_abron'] = round($r['Kmin']/1);
					$r['Kmax_abron'] = round($r['Kmax']/1);
					$r['Kmin'] -= $r['bron']['rnd']*2;
					$r['Kmax'] -= $r['bron']['rnd']*2;
					/*
					if($r['Kmin'] < $r['Kmin_abron']) {
						$r['Kmin'] = $r['Kmin_abron'];
					}
					if($r['Kmax'] < $r['Kmax_abron']) {
						$r['Kmax'] = $r['Kmax_abron'];
					}
					*/
				}
								
			//Особенности защиты				
				$r['ozash_rnd'] = $r['oza'][$r['type']][1]; /*rand($r['oza'][$r['type']][0],$r['oza'][$r['type']][1]);*/
				
				if($r['ozash_rnd'] > 80) { $r['ozash_rnd'] = 80; }
				if($r['ozash_rnd'] < 0) { $r['ozash_rnd'] = 0; }
				

				$r['ozash_rnd'] = 100-$r['ozash_rnd'];				
				
				$r['min'] -= ($r['min']/(200+$r['ozash_rnd'])*$r['ozash_rnd']);
				$r['max'] -= ($r['max']/(200+$r['ozash_rnd'])*$r['ozash_rnd']);
				
				$r['Kmin'] -= ($r['Kmin']/(200+$r['ozash_rnd'])*$r['ozash_rnd']);
				$r['Kmax'] -= ($r['Kmax']/(200+$r['ozash_rnd'])*$r['ozash_rnd']);
				
				//if($r['min'] < $r['min_']) { $r['min'] = $r['min_']; }
				//if($r['max'] < $r['max_']) { $r['max'] = $r['max_']; }
				//if($r['Kmin'] < $r['Kmin_']) { $r['Kmin'] = $r['Kmin_']; }
				//if($r['Kmax'] < $r['Kmax_']) { $r['Kmax'] = $r['Kmax_']; }
				
				/*
				if( $r['type'] >= 5 ) {
					$r['min'] = 1+floor($r['min']/2);
					$r['max'] = 1+floor($r['max']/2);
					$r['Kmin'] = 1+floor($r['Kmin']/2);
					$r['Kmax'] = 1+floor($r['Kmax']/2);
				}
				*/				
				
				//Заточки
				//if( $r['min'] > 1 || $r['max'] > 1 ) {
					/*$r['min'] += $weapom_min;
					$r['max'] += $weapom_max;
					$r['Kmin'] += $weapom_min*2;
					$r['Kmax'] += $weapom_max*2;
					//
					$r['min_'] += $weapom_max;
					$r['max_'] += $weapom_max;
					$r['Kmin_'] += $weapom_max*2;
					$r['Kmax_'] += $weapom_max*2;*/
				//}
								
				$r['bRND'] = $p['B']['rnd'];
				
			//Расчет защиты (не более 80%)
				if( $u->info['id'] == 12345 ) {
					echo '['.$this->zago($r['za']).']';
				}
				if( $r['type'] < 5 ) {
					$r['min'] = floor($r['min']/100*(100-$this->zago($r['za'],$st1['mageme'],$st2['mageme'])));
					$r['max'] = floor($r['max']/100*(100-$this->zago($r['za'],$st1['mageme'],$st2['mageme'])));
					$r['Kmin'] = floor($r['Kmin']/100*(100-$this->zago($r['za'],$st1['mageme'],$st2['mageme'])));
					$r['Kmax'] = floor($r['Kmax']/100*(100-$this->zago($r['za'],$st1['mageme'],$st2['mageme'])));
				}elseif( $r['type'] == 12 ) {
					$r['min'] = floor($r['min']/100*(100-$this->zago($r['za'],$st1['mageme'],$st2['mageme'])));
					$r['max'] = floor($r['max']/100*(100-$this->zago($r['za'],$st1['mageme'],$st2['mageme'])));
					$r['Kmin'] = floor($r['Kmin']/100*(100-$this->zago($r['za'],$st1['mageme'],$st2['mageme'])));
					$r['Kmax'] = floor($r['Kmax']/100*(100-$this->zago($r['za'],$st1['mageme'],$st2['mageme'])));
				}else{
					$r['min'] = floor($r['min']/100*(100-$this->zmgo($r['zm'])));
					$r['max'] = floor($r['max']/100*(100-$this->zmgo($r['zm'])));
					$r['Kmin'] = floor($r['Kmin']/100*(100-$this->zmgo($r['zm'])));
					$r['Kmax'] = floor($r['Kmax']/100*(100-$this->zmgo($r['zm'])));
				}
											
				/*
				if($u->info['admin'] > 0) {
					echo " {<font style='color:blue'> - </font>}";
				}
				*/
				
				/*
				[min] => 26
				[max] => 30
				[Kmin] => 51
				[Kmax] => 60
				[min_] => 15
				[max_] => 17
				[Kmin_] => 30
				[Kmax_] => 35
				*/
								
				/*$min_yrn = 0; //%
				if( $r['type'] >= 5 ) {
					$min_yrn += $zm_proc;
				}else{
					$min_yrn += $za_proc;
				}
								
				$r['min'] -= floor($r['min']/100*$min_yrn);
				$r['max'] -= floor($r['max']/100*$min_yrn);
				$r['Kmin'] -= floor($r['Kmin']/100*$min_yrn);
				$r['Kmax'] -= floor($r['Kmax']/100*$min_yrn);
				$r['min_'] -= floor($r['min_']/100*$min_yrn);
				$r['max_'] -= floor($r['max_']/100*$min_yrn);
				$r['Kmin_'] -= floor($r['Kmin_']/100*$min_yrn);
				$r['Kmax_'] -= floor($r['Kmax_']/100*$min_yrn);*/
				
				if( $st1['yrnfizproc'] != 0 ) {
					$r['min'] += floor($r['min']/100*$st1['yrnfizproc']);
					$r['max'] += floor($r['max']/100*$st1['yrnfizproc']);
					$r['Kmin'] += floor($r['Kmin']/100*$st1['yrnfizproc']);
					$r['Kmax'] += floor($r['Kmax']/100*$st1['yrnfizproc']);
					$r['min_'] += floor($r['min_']/100*$st1['yrnfizproc']);
					$r['max_'] += floor($r['max_']/100*$st1['yrnfizproc']);
					$r['Kmin_'] += floor($r['Kmin_']/100*$st1['yrnfizproc']);
					$r['Kmax_'] += floor($r['Kmax_']/100*$st1['yrnfizproc']); 
				}
								
				$defd = mysql_fetch_array(mysql_query('SELECT SUM(`vals`) FROM `battle_actions` WHERE `btl` = "'.$this->info['id'].'" AND `vars` = "use_defteam'.$u2['team'].'" LIMIT 1'));
				$defd = 0 + $defd[0];
				$powd = mysql_fetch_array(mysql_query('SELECT SUM(`vals`) FROM `battle_actions` WHERE `btl` = "'.$this->info['id'].'" AND `vars` = "use_powteam'.$u1['team'].'" LIMIT 1'));
				$powd = 0 + $powd[0];
				$defd = $defd - $powd;
								
				if( $this->info['izlom'] > 0 ) {
					$defd = 0;
				}
				
				$r_min['min'] = floor(($r['min']*$p['iT'])*0.1);
				$r_min['max'] = floor(($r['max']*$p['iT'])*0.1);
				$r_min['Kmin'] = floor(($r['Kmin']*$p['iT'])*0.1);
				$r_min['Kmax'] = floor(($r['Kmax']*$p['iT'])*0.1);
				$r_min['min_'] = floor(($r['min_']*$p['iT'])*0.1);
				$r_min['max_'] = floor(($r['max_']*$p['iT'])*0.1);
				$r_min['Kmin_'] = floor(($r['Kmin_']*$p['iT'])*0.1);
				$r_min['Kmax_'] = floor(($r['Kmax_']*$p['iT'])*0.1);
												
				//$p['iT']
				$r['min'] = floor($r['min']*$p['iT']) - $defd;
				$r['max'] = floor($r['max']*$p['iT']) - $defd;
				$r['Kmin'] = floor($r['Kmin']*$p['iT']) - $defd*2;
				$r['Kmax'] = floor($r['Kmax']*$p['iT']) - $defd*2;
				$r['min_'] = floor($r['min_']*$p['iT']) - $defd;
				$r['max_'] = floor($r['max_']*$p['iT']) - $defd;
				$r['Kmin_'] = floor($r['Kmin_']*$p['iT']) - $defd*2;
				$r['Kmax_'] = floor($r['Kmax_']*$p['iT']) - $defd*2;

				if( $r['min'] < $r_min['min'] ) { $r['min'] = $r_min['min']; }
				if( $r['max'] < $r_min['max'] ) { $r['max'] = $r_min['max']; }
				if( $r['Kmin'] < $r_min['Kmin'] ) { $r['Kmin'] = $r_min['Kmin']; }
				if( $r['Kmax'] < $r_min['Kmax'] ) { $r['Kmax'] = $r_min['Kmax']; }
				if( $r['min_'] < $r_min['min_'] ) { $r['min_'] = $r_min['min_']; }
				if( $r['max_'] < $r_min['max_'] ) { $r['max_'] = $r_min['max_']; }
				if( $r['Kmin_'] < $r_min['Kmin_'] ) { $r['Kmin_'] = $r_min['Kmin_']; }
				if( $r['Kmax_'] < $r_min['Kmax_'] ) { $r['Kmax_'] = $r_min['Kmax_']; }
				
				$min_yrn = 0; //%
				
				if( $r['type'] >= 5 ) {
					$min_yrn += $zm_proc;
				}else{
					$min_yrn += $za_proc;
				}
								
				//if( $st2['yza'] != 0 ) {
					if( $r['type'] >= 5 ) {
						$r['min'] -= floor($r['min']/100*$st2['yzm']);
						$r['max'] -= floor($r['max']/100*$st2['yzm']);
						$r['Kmin'] -= floor($r['Kmin']/100*$st2['yzm']);
						$r['Kmax'] -= floor($r['Kmax']/100*$st2['yzm']);
						$r['min_'] -= floor($r['min_']/100*$st2['yzm']);
						$r['max_'] -= floor($r['max_']/100*$st2['yzm']);
						$r['Kmin_'] -= floor($r['Kmin_']/100*$st2['yzm']);
						$r['Kmax_'] -= floor($r['Kmax_']/100*$st2['yzm']);
					}else{
						$r['min'] -= floor($r['min']/100*$st2['yza']);
						$r['max'] -= floor($r['max']/100*$st2['yza']);
						$r['Kmin'] -= floor($r['Kmin']/100*$st2['yza']);
						$r['Kmax'] -= floor($r['Kmax']/100*$st2['yza']);
						$r['min_'] -= floor($r['min_']/100*$st2['yza']);
						$r['max_'] -= floor($r['max_']/100*$st2['yza']);
						$r['Kmin_'] -= floor($r['Kmin_']/100*$st2['yza']);
						$r['Kmax_'] -= floor($r['Kmax_']/100*$st2['yza']);
					}
				//}
				
				if($r['type'] == 3 && $za_proc < 100) {
					$min_yrn -= 20;
				}
				
				//тестовая защита от урона
				//if($u->info['admin'] == 9 || md5($u2['id'].'test')=='2-eea920508060337402cc9d2645cfaf2') {$min_yrn += 5;}
								
				$r['min'] -= floor($r['min']/100*$min_yrn);
				$r['max'] -= floor($r['max']/100*$min_yrn);
				$r['Kmin'] -= floor($r['Kmin']/100*$min_yrn);
				$r['Kmax'] -= floor($r['Kmax']/100*$min_yrn);
				$r['min_'] -= floor($r['min_']/100*$min_yrn);
				$r['max_'] -= floor($r['max_']/100*$min_yrn);
				$r['Kmin_'] -= floor($r['Kmin_']/100*$min_yrn);
				$r['Kmax_'] -= floor($r['Kmax_']/100*$min_yrn);
			    
				if( $st1['mageme'] > 0 && $st2['mageme'] > 0 ) {
					$r['min'] += 10+$level * 3;
					$r['max'] += 10+$level * 3;
					$r['Kmin'] += 10+$level * 6;
					$r['Kmax'] += 10+$level * 6;
					$r['min_'] += 10+$level * 3;
					$r['max_'] += 10+$level * 3;
					$r['Kmin_'] += 10+$level * 6;
					$r['Kmax_'] += 10+$level * 6;
				}
							 				 
			    if( $r['min'] < 1 ) {
			    	$r['min'] = 1;
			    }
			    if( $r['Kmax'] < 1 ) {
			    	$r['Kmax'] = 1;
			    }
			    if( $r['min_'] < 1 ) {
			     	$r['min_'] = 1;
			    }
			    if( $r['min_'] < 1 ) {
			     	$r['max_'] = 1;
			    }
			     
			    if( $r['Kmin'] < 2 ) {
			    	$r['Kmin'] = 2;
			    }
			    if( $r['Kmax'] < 2 ) {
			    	$r['Kmax'] = 2;
			    }
			    if( $r['Kmin_'] < 2 ) {
			     	$r['Kmin_'] = 2;
			    }
			    if( $r['Kmin_'] < 2 ) {
			     	$r['Kmax_'] = 2;
			    }
				
				if( $r['min'] > 1 ) {
					/*$r['min'] += $st1['maxAtack'];
			    	$r['max'] += $st1['maxAtack'];
			    	$r['Kmin'] += $st1['maxAtack']*2;
			    	$r['Kmin'] += $st1['maxAtack']*2;*/
				}
			    
			    $r['m_k'] = $r['Kmax'];
					
					
			return $r;
		}
		
		public $pr_not_use = array(),$pr_reset = array(),$pr_yrn = false,$prnt = array();
	//Завершение действия приема
	// pl прием
	// u1 инфа юзера
	// t1 тип снятия 
	// 99 = очищение кровью
	// u2 
	//$this->delPriem($pd[$k2][1][$k],${'p'.$k2},1,${'p'.$k2jn});
		public $del_val = array(),$re_pd = array();
		public function delPriem($pl,$u1,$t = 1,$u2 = false,$rznm = 'Очиститься Кровью',$k2nm,$yrn,$yrnt)
		{
			global $u,$priem;
			if(isset($pl['priem']['id']) && !isset($this->del_val['eff'][$pl['priem']['id']]))
			{	
				if($pl['x'] > 1) {
					$pl['name'] = $pl['name'].' x'.$pl['x'].'';
				}
				if($pl['timeUse']==77)
				{
					//завершаем прием
					mysql_query('DELETE FROM `eff_users` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
				}
				$vLog = 'time1='.time().'||s1='.$u1['sex'].'||t1='.$u1['team'].'||login1='.$u1['login'].'';
				if(isset($u2['id'])) {
					$vLog .= '||s2='.$u2['sex'].'||t2='.$u2['team'].'||login2='.$u2['login'].'';
				}
				$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
				if($t==4)
				{
					$mas1['id_hod']++;
					$t = 2;
				}
				if($t==1)
				{
					$mas1['id_hod']++;
					if($pl['priem']['file']!='0')
					{						
						if(file_exists('../../_incl_data/class/priems/'.$pl['priem']['file'].'.php'))
						{
							require('priems/'.$pl['priem']['file'].'.php');
						}
					}elseif($pl['priem']['file3']!='0')
					{						
						if(file_exists('../../_incl_data/class/priems/'.$pl['priem']['file3'].'.php'))
						{
							require('priems/'.$pl['priem']['file3'].'.php');
						}
					}else{
						$mas1['text'] = '{tm1} {u1} {1x16x0} прием &quot;<b>'.$pl['name'].'</b>&quot;.';
						$this->del_val['eff'][$pl['priem']['id']] = true;
					}
				}elseif($t==2)
				{
					$mas1['text'] = '{tm1} У персонажа {u1} закончилось действие магии &quot;<b>'.$pl['name'].'</b>&quot;.';
				}elseif($t==99){
				    $mas1['text'] = '{u1} Снял эфект &quot;<b>'.$pl['name'].'</b>&quot; с помощью <b>'.$rznm.'</b> .';
				}else{
					if( $t == 100 ) {
						$mas1['id_hod']++;
					}
					$mas1['text'] = '{tm1} Закончилось действие эффекта &quot;<b>'.$pl['name'].'</b>&quot; для {u1}.';
				}
				if( $pl['priem']['id'] != 24 ) {
					$this->add_log($mas1);
				}
				$this->stats[$this->uids[$pl['uid']]] = $u->getStats($pl['uid'],0);
			}else{
				//не удалось удалить прием или эффект
			}
		}
		public function hodUserPriem($pl,$u1,$t = 1,$u2 = false,$rznm = 'Очиститься Кровью',$k2nm,$yrn,$yrnt)
		{
			global $u,$priem;
			if(isset($pl['priem']['id']) && !isset($this->del_val['eff'][$pl['priem']['id']]))
			{

				if($yrnt == 1)
				{
					//обычный удар
					$yrn = round($yrn);
				}elseif($yrnt == 6)
				{
					//противник увернулся от удара
					$yrn = 0;
				}elseif($yrnt == 9)
				{
					//противник парировал удар
					$yrn = 0;
				}elseif($yrnt == 3)
				{
					//вы нанесли крит-удар
					$yrn = round($yrn*1.95)+ceil($yrn/125*$this->stats[$this->uids[$u1['id']]]['m3']);
				}elseif($yrnt == 4)
				{
					//вы нанесли крит-удар через блок
					$yrn = round($yrn*0.45)+ceil($yrn/125*$this->stats[$this->uids[$u1['id']]]['m3']);
				}else{
					//неизвестный удар
					$yrn = 0;
				}
				
				if($pl['x'] > 1) {
					$pl['name'] = $pl['name'].' x'.$pl['x'].'';
				}
				$vLog = 'time1='.time().'||s1='.$u1['sex'].'||t1='.$u1['team'].'||login1='.$u1['login'].'';
				if(isset($u2['id'])) {
					$vLog .= '||s2='.$u2['sex'].'||t2='.$u2['team'].'||login2='.$u2['login'].'';
				}
				$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
				if($t==4)
				{
					$mas1['id_hod']++;
					$t = 2;
				}if($t==1)

				{
					$mas1['id_hod']++;

					if($pl['priem']['file']!='0')
					{						
						if(file_exists('../../_incl_data/class/priems/'.$pl['priem']['file'].'.php'))
						{
							require('priems/'.$pl['priem']['file'].'.php');
						}
					}else{
						$mas1['text'] = '{tm1} {u1} {1x16x0} прием &quot;<b>'.$pl['name'].'</b>&quot;.';
						$this->del_val['eff'][$pl['priem']['id']] = true;
					}
				}
				$this->add_log($mas1);
				$this->stats[$this->uids[$pl['uid']]] = $u->getStats($pl['uid'],0);
			}else{
				//не удалось удалить прием или эффект
			}
		}
		
	//расчет защиты
		public function aPower($za,$za1,$yrn)
		{
			$z = 0;
			/*$z = ($za+$za1)*0.35;
			$z = round($yrn/$z*100);*/
			
			$z = (1-( pow(0.5, (($za+$za1)/250) ) ))*100; 			
			return $z;
		}
		
	//расчет брони
		public function bronGo($min,$max)
		{
			$v = 0;
			//$v = ceil(($min+$max)/2,$max);
			$v = ceil($min,$max);
			return $v;
		}	
		
	//расчет брони (test)
		public function bronGoTest($min,$max)
		{
			$v = 0;
			//$v = ceil(($min+$max)/2,$max);
			$v = ceil(round($min,$max));
			return $v;
		}
	
	//Разбираем массив со статами
		public function lookStats($m)
		{
			$ist = array();
			$di = explode('|',$m);
			$i = 0; $de = false;
			while($i<count($di))
			{
				$de = explode('=',$di[$i]);
				$ist[$de[0]] = $de[1];
				$i++;
			}
			return $ist;
		}
		
	//Расчет зависимости уворота
		public function mfsgo1($a,$b) {
			/*$r = 0.0928;
			$a = 5 + ($a * 0.3);
			$b = 5 + ($b * 0.3);
			if($b < 1) {
				$b = 1;
			}
			if($a < $b) {
				$a = $b+1;
			}
			$r = ceil($r*($a-$b)) + 5;*/
			$r = $this->form_mf($a,$b);
			return $r;
		}
		
	//Расчет зависимости крита
		public function mfsgo2($a,$b) {
			/*$r = 0.0838;
			$a = 5 + ($a * 0.3);
			$b = 5 + ($b * 0.3);
			if($b < 1) {
				$b = 1;
			}
			if($a < $b) {
				$a = $b+1;
			}
			$r = ceil($r*($a-$b));*/
			$r = $this->form_mf($a,$b);
			return $r;
		}
		
	//Расчет мф. (новая)
		public function form_mf($u,$au) {
			$v = $u - $au;
			if($v < 0) {
				$v = 0; 
			} //testtest
			$r = (1-( pow(rand(89,90)/100, (($v)/100) ) ))*100;	
			$r = round($r);
			return $r;
		}
		
	//Расчет МФ		
		public function mfs($type, $mf)
		{
			$rval = 0;
			switch($type) {
				case 1:
					if($mf['amf'] < 1){ $mf['amf'] = 1; }
					if($mf['mf'] < 1){ $mf['mf'] = 1; }
					//if($mf['amf'] > $mf['mf']) {
					//	$mf['amf'] = $mf['mf'];
					//}
					$rval = min( (( 1 - ( ( $mf['amf']*0.8 + 50 ) / ( $mf['mf']*0.8 + 50 ) ) ) * 100), 80); //Крит. удар
					//$rval = min($this->mfsgo2(($mf['mf']),$mf['amf']),80);
					if($rval < 1) {
						$rval = 0;
					}
					if($rval > 80) {
						$rval = 80;
					}	
				break;
				case 2:
					if($mf['amf'] < 1){ $mf['amf'] = 1; }
					if($mf['mf'] < 1){ $mf['mf'] = 1; }
					/*
					if($mf['amf'] > $mf['mf']) {
						$mf['amf'] = $mf['mf'];
					}
					*/
					$rval = min( ( ( 1 - ( ( $mf['amf']*0.8 + 50 ) / ( $mf['mf']*0.8 + 50 ) ) ) * 100 ), 80 ); //Уворот

					//$rval = min($this->mfsgo1($mf['mf'],$mf['amf']),60);
					//$rval += 10;
					if($rval < 1) {
						$rval = 0;
					}
					if($rval > 80) {
						$rval = 80;
					}					
				break;
				case 3:
					/*
					$mf[1] -= 4;
					$mf[2] -= 4;
					if($mf[1] < 1){ $mf[1] = 1; }
					if($mf[2] < 1){ $mf[2] = 1; }
					
					//$rval = $mf[1] - $mf[2]; //Парирование
					$rval = $mf[1]-($mf[2]/2);
					if( $rval > 100 ) {
						$rval = 100;
					}
					$rval = round($rval/3);
					if( $rval < 1 ) {
						$rval = 0;
					}
					*/
					
					if($mf[1] < 1){ $mf[1] = 1; }
					if($mf[2] < 1){ $mf[2] = 1; }
					
					if( $this->stats[$this->uids[$mf['u1']]]['items'][$this->stats[$this->uids[$mf['u1']]]['wp3id']]['type'] == 18 ) {
						$rvar += floor($mf[1]*0.25);
					}
					
					//$rval = $mf[1] - $mf[2]; //Парирование
					$rval = round(($mf[1]-($mf[2]/2))*0.75);
					if( $rval < 1 ) {
						$rval = 0;
					}elseif( $rval > 95 ) {
						$rval = 95;
					}
										
					$rnd1 = rand(0,100);
					if( $rval < $rnd1 ) {
						$rval = 0;
					}
					
					//$rval = (1-( pow(0.75, ($rval/125) ) ))*100;
					
					//if( $rval > 60 ) {
					//	$rval = 60;
					//}	
					
				break;
				case 4:
					$mf = round($mf*0.6);
					if($mf < 1){ $mf = 0; }
					if($mf > 100){ $mf = 100; }
					//$mf = (1-( pow(0.5, ($mf/200) ) ))*100;
					$rval = min( $mf , 100 ); //пробой брони
				break;
				case 5:
					if($mf < 1){ $mf = 0; }
					$rval = min( $mf, 40 ); //блок щитом
				break;
				case 6:
					$mf = $mf/80*100;
					$mf = round($mf/2);
					if($mf < 1){ $mf = 0; }
					if($mf > 50){ $mf = 50; }
					//$mf = (1-( pow(0.5, ($mf/75) ) ))*100;
					$rval = $mf; //Контрудар
				break;
			}
			if($this->get_chanse($rval) == true) {
				$rval = 1;
			}else{
				$rval = 0;
			}
			return $rval;
		}		
	
		public function get_chanse($percent)
		{
			$a = 101+$percent;
			$b = 100-$percent;
			$i = 1;
			if(($a-$b)>0){
				while($i<=$a-$b){
					$conp[] = rand(1,100);  
					//$conp[] = mt_rand(1,100);  
					if( $i > 1000 ) {
						$i = ($a-$b+1);
					}
					$i++;   
				}
			}
			$t = count($conp);
			$prob = round($percent);
			if(@array_search($prob,$conp)!=false){
				$critical = true;
			}else{
				$critical = false;
			} 
			return $critical;
		}
	
	//Расчет шанса
		public function get_chanse_new($persent)
		{		
			$mm = 10;
			if(rand($mm,100*$mm)<=$persent*$mm)
			{
				return true;
			}else{
				return false;
			}
		}
	
	//Смена противника
		public function smena($uid,$auto = false,$lastdie = false)
		{
			global $u;
			if(($auto == false && $u->info['smena'] > 0) || $auto == true) {
				if($this->stats[$this->uids[$u->info['id']]]['hpNow']>=1)
				{
					if( $u->info['team'] != $this->users[$this->uids[$uid]]['team'] && isset($this->uids[$uid]) && $uid!=$u->info['id'] && $this->users[$this->uids[$uid]]['team']!=$this->users[$this->uids[$u->info['id']]]['team'])
					{
						if(!isset($this->ga[$u->info['id']][$uid]) || $lastdie == true)
						{
							if(ceil($this->stats[$this->uids[$uid]]['hpNow'])>=1)
							{
								//меняем противника
								if($auto == false) {
									$u->info['smena']--;
								}
								$upd = mysql_query('UPDATE `stats` SET `enemy` = "'.$uid.'",`smena` = "'.$u->info['smena'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
								$u->info['enemy'] = $uid;
								$this->users[$this->uids[$uid]]['smena'] = $u->info['smena'];
								$this->users[$this->uids[$u->info['id']]]['enemy'] = $uid;
								return 1;
							}else{
								return 'Нельзя сменить, противник уже мертв';
							}
						}else{
							return 'Нельзя сменить на выбранную цель!';
						}
					}else{
						return 'Нельзя сменить на выбранную цель []';
					}
				}else{
					return 'Для вас поединок закончен, ожидайте пока завершат другие...';
				}
			}else{
				return 'У вас закончились смены противника';
			}
		}
	
	//авто-смена противника
		public function autoSmena()
		{
			global $u;
			$ms = array();
			$ms_all = array();
			$i = 0; $j = 0;
			while($i<count($this->users))
			{
				if(isset($this->users[$i]) && $this->users[$i]['id']!=$u->info['id'] && $this->users[$i]['team']!=$u->info['team'] && $this->stats[$i]['hpNow']>=1 && -($u->info['enemy']) != $this->users[$i]['id'])
				{
					if(!isset($this->ga[$u->info['id']][$this->users[$i]['id']]))
					{
						$ms[$j] = $this->users[$i]['id'];
						$j++;
					}
					if( !isset($this->uids[(-($u->info['enemy']))]) ) {
						$ms_all[] = $this->users[$i]['id'];
					}
				}
				$i++;
			}
			$msh = array();
			if( $j == 0 ) {
				
				$enemydie = 0;
				
				if( isset($this->stats[$this->uids[$u->info['enemy']]]) ) {
					$u->info['enemy'] = 0;
					$enemydie = 1;
				}
				
				if( (!isset($this->uids[(-($u->info['enemy']))]) || $this->stats[$this->uids[(-($u->info['enemy']))]]['hpNow'] < 1) && ( $u->info['enemy'] < 0 || $enemydie == 1 ) ) {
					$i = 0; $j = 0;
					while($i<count($this->users))
					{
						if(isset($this->users[$i]) && $this->users[$i]['id']!=$u->info['id'] && $this->users[$i]['team']!=$u->info['team'] && $this->stats[$i]['hpNow']>=1 && -($u->info['enemy']) != $this->users[$i]['id'])
						{
							$ms[$j] = $this->users[$i]['id'];
							$msh[$ms[$j]] = true;
							$j++;
						}
						$i++;
					}
				}
			}

			$ms = $ms[rand(0,$j-1)];
			if($j > 0) {
				if( isset($msh[$ms]) ) {
					$this->smena($ms,true,true);
				}else{
					$this->smena($ms,true);
				}
			}else{
				if( $u->info['enemy'] < 0 ) {
					$smnr5 = $this->smena(-($u->info['enemy']),true);
					if( $smnr5 != 1 ) {
						if( !isset($this->uids[(-($u->info['enemy']))]) ) {
							$u->info['enemy'] = $ms_all[rand(0,(count($ms_all)-1))];
							mysql_query('UPDATE `stats` SET `enemy` = "'.$u->info['enemy'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						}
					}
					unset($smnr5);
				}
			}
		}
	
	//Смена противника
		public function smena2($uid,$auto = false,$lastdie = false)
		{
			global $u;
			if(($auto == false && $u->info['smena'] > 0) || $auto == true) {
				if($this->stats[$this->uids[$u->info['id']]]['hpNow']>=1)
				{
					if(isset($this->uids[$uid]) && $uid!=$u->info['id'] && $this->users[$this->uids[$uid]]['team']!=$this->users[$this->uids[$u->info['id']]]['team'])
					{
						if(!isset($this->ga[$u->info['id']][$uid]) || $lastdie == true)
						{
							if(ceil($this->stats[$this->uids[$uid]]['hpNow'])>=1)
							{
								//меняем противника
								if($auto == false) {
									$u->info['smena']--;
								}
								$upd = mysql_query('UPDATE `stats` SET `enemy` = "'.$uid.'",`smena` = "'.$u->info['smena'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
								$u->info['enemy'] = $uid;
								$this->users[$this->uids[$uid]]['smena'] = $u->info['smena'];
								$this->users[$this->uids[$u->info['id']]]['enemy'] = $uid;
								return 1;
							}else{
								return 'Нельзя сменить, противник уже мертв';
							}
						}else{
							return 'Нельзя сменить на выбранную цель!';
						}
					}else{
						return 'Нельзя сменить на выбранную цель []';
					}
				}else{
					return 'Для вас поединок закончен, ожидайте пока завершат другие...';
				}
			}else{
				return 'У вас закончились смены противника';
			}
		}
	
	//авто-смена противника
		public function autoSmena2()
		{
			global $u;
			$ms = array();
			$ms_all = array();
			$i = 0; $j = 0;
			while($i<count($this->users))
			{
				if(isset($this->users[$i]) && $this->users[$i]['id']!=$u->info['id'] && $this->users[$i]['team']!=$u->info['team'] && $this->stats[$i]['hpNow']>=1 && -($u->info['enemy']) != $this->users[$i]['id'])
				{
					if(!isset($this->ga[$u->info['id']][$this->users[$i]['id']]))
					{
						$ms[$j] = $this->users[$i]['id'];
						$j++;
					}
					if( !isset($this->uids[(-($u->info['enemy']))]) ) {
						$ms_all[] = $this->users[$i]['id'];
					}
				}
				$i++;
			}
			$msh = array();
			if( $j == 0 ) {
				
				$enemydie = 0;
				
				if( isset($this->stats[$this->uids[$u->info['enemy']]]) ) {
					$u->info['enemy'] = 0;
					$enemydie = 1;
				}
				
				if( (!isset($this->uids[(-($u->info['enemy']))]) || $this->stats[$this->uids[(-($u->info['enemy']))]]['hpNow'] < 1) && ( $u->info['enemy'] < 0 || $enemydie == 1 ) ) {
					$i = 0; $j = 0;
					while($i<count($this->users))
					{
						if(isset($this->users[$i]) && $this->users[$i]['id']!=$u->info['id'] && $this->users[$i]['team']!=$u->info['team'] && $this->stats[$i]['hpNow']>=1 && -($u->info['enemy']) != $this->users[$i]['id'])
						{
							$ms[$j] = $this->users[$i]['id'];
							$msh[$ms[$j]] = true;
							$j++;
						}
						$i++;
					}
				}
			}

			$ms = $ms[rand(0,$j-1)];
			if($j > 0) {
				if( isset($msh[$ms]) ) {
					$this->smena($ms,true,true);
				}else{
					$this->smena($ms,true);
				}
			}else{
				if( $u->info['enemy'] < 0 ) {
					$smnr5 = $this->smena(-($u->info['enemy']),true);
					if( $smnr5 != 1 ) {
						if( !isset($this->uids[(-($u->info['enemy']))]) ) {
							$u->info['enemy'] = $ms_all[rand(0,(count($ms_all)-1))];
							mysql_query('UPDATE `stats` SET `enemy` = "'.$u->info['enemy'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						}
					}
					unset($smnr5);
				}
			}
		}
			
	//Действия бота (атака)
		public function botAtack($uid,$pl,$tp)
		{
			//global $c,$u,$code;
			//Бот использует прием, если это возможно
			/*$ij = 0;
			$bp = explode('|',$this->users[$this->uids[$uid]]['priems']);
			$bpz = explode('|',$this->users[$this->uids[$uid]]['priems_z']);
			while($i<count($bp))
			{
				$plj = mysql_fetch_array(mysql_query('SELECT * FROM `priems` WHERE `id` = "'.((int)$bp[$ij]).'" AND `activ` > "0" LIMIT 1'));
				if(isset($plj['id']))
				{
					$notrj = 0;

					

					if($bpz[$ij]<=0 && $bp[$ij]>0 && $notrj==0)
					{
						//можно использовать
						
					}
				}
				$ij++;
			}*/
			//$pl - удар 
			$test_atack = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_act` WHERE `battle` = "'.$this->info['id'].'" AND ((
				`uid1` = "'.$pl.'" AND `uid2` = "'.$uid.'"
			) OR (
				`uid2` = "'.$pl.'" AND `uid1` = "'.$uid.'"
			)) LIMIT 1'));
			if($tp==1 && !isset($test_atack['id']))
			{
				//бот сам делает удар
				//if(rand(0,1)==1)
				//{
					$a = rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5);
					$b = rand(1,5);
					//mysql_query('LOCK TABLES battle_act WRITE');
					
					//mysql_query('DELETE FROM `battle_act` WHERE `battle` = "'.$this->info['id'].'" AND ((`uid2` = "'.$pl.'" AND `uid1` = "'.$uid.'") OR (`uid1` = "'.$pl.'" AND `uid2` = "'.$uid.'")) LIMIT 2');
					
					$d = mysql_query('INSERT INTO `battle_act` (`battle`,`time`,`uid1`,`uid2`,`a1`,`b1`) VALUES ("'.$this->info['id'].'","'.time().'","'.$pl.'","'.$uid.'","'.$a.'","'.$b.'")');
					
					//mysql_query('UNLOCK TABLES');
				//}
			}elseif($tp==2)
			{
				//бот отвечает на удар
				$bot = $this->users[$this->uids[$pl['uid2']]];
				$na = array('id'=>0,'a'=>array(1=>0,2=>0,3=>0,4=>0,5=>0),'b'=>0);
				$a222 = rand(1,5).'_'.rand(1,5).'_'.rand(1,5).'_'.rand(1,5).'_'.rand(1,5);
				$a = explode('_',$a222);
				$i = 1;
				$na['id'] = time();
				while($i<=5)
				{
					if(isset($a[$i-1]))
					{
						$a[$i-1] = intval(round($a[$i-1]));
						if($a[$i-1]>=1 && $a[$i-1]<=5)
						{
							$na['a'][$i] = $a[$i-1];
						}else{
							$na['a'][$i] = 0;
						}
					}
					$i++;
				}				
				$na['b'] = rand(1,5);
				//Проводим удар
				$this->atacks[$pl['id']]['a2'] = $a222;
				$this->atacks[$pl['id']]['b2'] = $na['b'];
				$this->startAtack($pl['id']);
			}
		}
	
	//Проверяем удары, приемы, свитки, зверей
		public function testActions()
		{
			global $u;
			
			
			//проверяем удары
				$m = mysql_query('SELECT * FROM `battle_act` WHERE `battle` = "'.$this->info['id'].'" AND (`uid1` = "'.$u->info['id'].'" OR `uid2` = "'.$u->info['id'].'") ORDER BY `id` ASC LIMIT 10');
				$i = 0;
				$botA = array();
				$botR = array();
				while($pl = mysql_fetch_array($m))
				{
					$ts1 = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_act` WHERE `uid1` = "'.$pl['uid1'].'" AND `uid2` = "'.$pl['uid2'].'" AND `id` != "'.$pl['id'].'" LIMIT 1'));
					if(isset($ts1['id'])) {
						//mysql_query('DELETE FROM `battle_act` WHERE `uid1` = "'.$pl['uid1'].'" AND `uid2` = "'.$pl['uid2'].'" AND `id` != "'.$pl['id'].'"');
					}
					$ts2 = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_act` WHERE `uid2` = "'.$pl['uid1'].'" AND `uid1` = "'.$pl['uid2'].'" AND `id` != "'.$pl['id'].'" LIMIT 1'));
					if(isset($ts2['id'])) {
						//mysql_query('DELETE FROM `battle_act` WHERE `uid2` = "'.$pl['uid1'].'" AND `uid1` = "'.$pl['uid2'].'" AND `id` != "'.$pl['id'].'"');
					}
					unset($ts1,$ts2);
					
					if($this->stats[$this->uids[$pl['uid1']]]['hpNow']<=0 || $this->stats[$this->uids[$pl['uid2']]]['hpNow']<=0)
					{
						mysql_query('DELETE FROM `battle_act` WHERE `id` = "'.$pl['id'].'" LIMIT 1');
					}elseif($pl['time']+$this->info['timeout']>time())
					{
						//удар не пропущен по тайму, просто заносим данные
						$this->atacks[$pl['id']] = $pl;
						$this->ga[$pl['uid1']][$pl['uid2']] = $pl['id'];
						$this->ag[$pl['uid2']][$pl['uid1']] = $pl['id'];
						if(isset($this->iBots[$pl['uid1']]))
						{
							//ударил бот и нет ответа
							$botA[$pl['uid1']] = $pl['id'];
						}elseif(isset($this->iBots[$pl['uid2']]))
						{
							//ударили бота и он не ответил
							$botR[$pl['uid2']] = $pl['id'];	
							$this->botAtack($pl['uid1'],$pl,2);
						}
					}else{
						//пропуск по тайму
						if($pl['a1']==0 && $pl['a2']==0)
						{
							//игрок 1 пропустил по тайму
							$pl['out1'] = time();	
							$pl['tout1'] = 1;	
							//игрок 2 пропустил по тайму
							$pl['out2'] = time();	
							$pl['tout2'] = 1;	
						}elseif($pl['a1']==0)
						{
							//игрок 1 пропустил по тайму
							$pl['out1'] = time();	
							$pl['tout1'] = 1;					
						}elseif($pl['a2']==0)
						{
							//игрок 2 пропустил по тайму
							$pl['out2'] = time();	
							$pl['tout2'] = 1;							
						}
						//наносим удар по пропуску
						$this->atacks[$pl['id']] = $pl;
						$this->startAtack($pl['id']);
					}
				}
			//тест удара
				if($this->uAtc['id']>0)
				{
					if($this->na==1)
					{
						$this->addNewAtack();
					}
				}
			//тест использования заклятий
				
			//тест использования приемов
				
			//тест, бот делает удары
				$i = 0; $i = count($this->bots);
				while($i<count($this->bots))
				{					
					$bot = $this->bots[$i];
					if(isset($bot) && $this->stats[$this->uids[$bot]]['hpNow'] >= 1)
					{
						$j = 0;
						while($j<count($this->users))
						{
							if($this->users[$j]['hpNow'] >= 1 && $this->users[$this->uids[$bot]]['team'] != $this->users[$j]['team']) {
								if(isset($this->users[$j]) && $this->stats[$j]['hpNow']>=1 && $this->stats[$this->uids[$bot]]['hpNow']>=1 && !isset($this->ga[$bot][$this->users[$j]['id']]) && !isset($this->ag[$bot][$this->users[$j]['id']]) && $this->users[$j]['id']!=$bot && $this->users[$j]['team']!=$this->users[$this->uids[$bot]]['team'])
								{
									$this->botAtack($this->users[$j]['id'],$bot,1);
								}elseif(isset($this->users[$i]) && $this->users[$i]['bot']>0 && $this->stats[$i]['hpNow']>=1 && $this->stats[$this->uids[$bot]]['hpNow']>=1 && $this->users[$i]['id']!=$bot && $this->users[$i]['team']!=$this->users[$this->uids[$bot]]['team']){
									if($this->botAct($bot)==true)
									{
										if(!isset($this->ga[$bot][$this->users[$i]['id']]) && $this->users[$this->uids[$bot]]['timeGo']<time() && !isset($this->ag[$bot][$this->users[$i]['id']]))
										{
											$this->botAtack($this->users[$i]['id'],$bot,1);
											}elseif(isset($this->ag[$bot][$this->users[$i]['id']]))

										{
										}elseif(isset($this->ga[$bot][$this->users[$i]['id']]) && $this->users[$this->uids[$bot]]['timeGo']<time())
										{
											$this->botAtack($bot,$this->users[$i]['id'],1);
										}
									}
								}else{
									//Удары между ботами
									$this->atacks[$this->ga[$bot][$this->users[$j]['id']]]['a1'] = rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5);
									$this->atacks[$this->ga[$bot][$this->users[$j]['id']]]['b1'] = rand(1,5);
									$this->atacks[$this->ga[$bot][$this->users[$j]['id']]]['a2'] = rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5);
									$this->atacks[$this->ga[$bot][$this->users[$j]['id']]]['b2'] = rand(1,5);
									$this->atacks[$this->ag[$bot][$this->users[$j]['id']]]['a1'] = rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5);
									$this->atacks[$this->ag[$bot][$this->users[$j]['id']]]['b1'] = rand(1,5);
									$this->atacks[$this->ag[$bot][$this->users[$j]['id']]]['a2'] = rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5);
									$this->atacks[$this->ag[$bot][$this->users[$j]['id']]]['b2'] = rand(1,5);
									if(isset($this->ga[$bot][$this->users[$j]['id']]) && $this->users[$j]['bot']>0)
									{
										if($this->users[$j]['timeGo'] < time() && $this->users[$this->uids[$bot]]['timeGo']<time())
										{
											$this->startAtack($this->ga[$bot][$this->users[$j]['id']]);
											$this->users[$this->uids[$bot]]['timeGo'] = time()+7;
											mysql_query('UPDATE `stats` SET `timeGo` = "'.(time()+7).'" WHERE `id` = "'.$this->users[$j]['id'].'" LIMIT 1');
										}
									}elseif(isset($this->ag[$bot][$this->users[$j]['id']]) && $this->users[$j]['bot']>0){
										if($this->users[$this->uids[$bot]]['timeGo']<time() && $this->users[$j]['timeGo']<time())
										{
											$this->startAtack($this->ag[$bot][$this->users[$j]['id']]);
											$this->users[$this->uids[$bot]]['timeGo'] = time()+7;
											mysql_query('UPDATE `stats` SET `timeGo` = "'.(time()+7).'" WHERE `id` = "'.$this->users[$this->uids[$bot]]['id'].'" LIMIT 1');
										}
									}
								}
							}
							$j++;
						}
					}
					$i++;
				}
		}
		
	//Действия бота
		public function botAct($uid)
		{
			$r = false;
			if($this->users[$this->uids[$uid]]['bot']>0)
			{
				if($this->users[$this->uids[$uid]]['online'] < time()-3)
				{
					$r = true;
					$this->users[$this->uids[$uid]]['online'] = time();
					mysql_query('UPDATE `users` SET `online` = "'.time().'" WHERE `id` = "'.((int)$uid).'" LIMIT 1');
				}else{
					if(rand(0,2)==1)
					{
						$r = true;
					}
				}
			}
			return $r;
		}
		
	//получаем данные о поединке
		public function battleInfo($id)
		{
			$b = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.mysql_real_escape_string($id).'" LIMIT 1'));
			if(isset($b['id']))
			{
				$this->hodID = mysql_fetch_array(mysql_query('SELECT `id_hod` FROM `battle_logs` WHERE `battle` = "'.$b['id'].'" ORDER BY `id` DESC LIMIT 1'));
				if(isset($this->hodID['id_hod']))
				{
					$this->hodID = $this->hodID['id_hod'];
				}else{
					$this->hodID = 0;
				}	
				return $b;
			}else{
				return false;
			}
		}
	
	//наносим удар противнику
		public function addAtack()
		{
			global $js,$u;
			$ngdofdso = false;
			if(isset($_POST['atack'],$_POST['block']))
			{
				$na = array('id'=>0,'a'=>array(1=>0,2=>0,3=>0,4=>0,5=>0),'b'=>0);
				$a = explode('_',$_POST['atack']);
				$i = 1;
				$na['id'] = time();
				while($i<=5)
				{
					if(isset($a[$i-1]))
					{
						$a[$i-1] = intval(round($a[$i-1]));
						if($a[$i-1]>=1 && $a[$i-1]<=5)
						{
							$na['a'][$i] = $a[$i-1];
						}else{
							$na['a'][$i] = 0;
							if( $i <= $u->stats['zona'] ) {
								$ngdofdso = true;
							}
						}
					}
					$i++;
				}
				
				$na['b'] = intval(round($_POST['block']));
				if($na['b']<1 || $na['b']>5)
				{
					$na['b'] = 0;
					$ngdofdso = true;
				}
				
				//$ngdofdso = false;
				
				if( $ngdofdso == true ) {
					$this->e = 'Выберите зоны удара и блока';
				}else{			
					$this->uAtc = $na;
					$js .= 'testClearZone();';
				}
			}else{
				$this->e = 'Выберите зоны удара и блока';
			}
		}
		
	//выделяем пользователей
		public function teamsTake()
		{
			global $u;
			$rs = ''; $ts = array(); $tsi = 0;
			if($this->info['id']>0)
			{
				//данные о игроках в бою
				$nxtlg = array();
				//$t = mysql_query('SELECT `u`.`no_ip`,`u`.`twink`,`u`.`stopexp`,`u`.`id`,`u`.`notrhod`,`u`.`login`,`u`.`login2`,`u`.`sex`,`u`.`online`,`u`.`admin`,`u`.`align`,`u`.`clan`,`u`.`level`,`u`.`battle`,`u`.`obraz`,`u`.`win`,`u`.`win_p`,`u`.`lose_p`,`u`.`lose`,`u`.`nich`,`u`.`animal`,`u`.`animal2`,`st`.`stats`,`st`.`hpNow`,`st`.`mpNow`,`st`.`exp`,`st`.`dnow`,`st`.`team`,`st`.`battle_yron`,`st`.`battle_exp`,`st`.`enemy`,`st`.`battle_text`,`st`.`upLevel`,`st`.`timeGo`,`st`.`timeGoL`,`st`.`bot`,`st`.`lider`,`st`.`btl_cof`,`st`.`tactic1`,`st`.`tactic2`,`st`.`tactic3`,`st`.`tactic4`,`st`.`tactic5`,`st`.`tactic6`,`st`.`tactic7`,`st`.`x`,`st`.`y`,`st`.`battleEnd`,`st`.`priemslot`,`st`.`priems`,`st`.`priems_z`,`st`.`bet`,`st`.`clone`,`st`.`atack`,`st`.`bbexp`,`st`.`res_x`,`st`.`res_y`,`st`.`res_s`,`st`.`id`,`st`.`last_hp`,`st`.`last_pr`,`u`.`sex`,`u`.`money`,`u`.`bot_id`,`u`.`money3` FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`battle` = "'.$this->info['id'].'" LIMIT 100');
				
				if( $this->info['start1'] == 0 ) {
					//mysql_query('UPDATE `battle` SET `start1` = "'.time().'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
					//Проверка распределения команд
					if( $this->info['razdel'] == 5 ) {
						//новое распределение
						if( $this->info['arand'] == 0 ) {
							$sp = mysql_query('SELECT `id`,`btl_cof2` FROM `stats` WHERE `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$this->info['id'].'") ORDER BY `btl_cof2` ASC');
							$tms = 1;
							$tmx = array( 0 , 0 , 0 );
							while( $pl = mysql_fetch_array($sp) ) {
								if( $tmx[1] == $tmx[2] ) {
									$tms = rand(1,2);
								}elseif( $tmx[1] > $tmx[2] ) {
									$tms = 2;
								}else{
									$tms = 1;
								}
								if( $pl['btl_cof2'] < 0 ) {
									$pl['btl_cof2'] = 0;
									$tmx[$tms] += 10;
								}
								$tmx[$tms] += $pl['btl_cof2'];
								mysql_query('UPDATE `stats` SET `team` = "'.$tms.'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
							}
							mysql_query('UPDATE `battle` SET `balance2` = "'.$tmx[1].' VS '.$tmx[2].'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
							unset($tmx,$tmx,$pl,$cp);
						}
						
						//
						$tms1p = mysql_query('SELECT `team` , COUNT(*) AS `x` FROM `stats` WHERE `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$this->info['id'].'") GROUP BY `team`');
						$tms = array();
						while( $tms1 = mysql_fetch_array($tms1p) ) {
							$tms[$tms1['team']] = $tms1['x'];
						}
						unset($tms1,$tms1p);
						if( $tms[1] - $tms[2] > 1 ) {
							$tmsx = $tms[1]-$tms[2]-1; //сколько разница: 5 - 1 - 1 = 3
							$tmsa = floor(($tms[1]+$tms[2])/2); //сколько должно быть 5 + 1 \ 2 = 3
							$tmsg = $tmsa - $tms[2]; // сколько tmsa 3 - tms[1] 1 = 2 игрока
							$tmst1 = 1; //откуда
							$tmst2 = 2; //куда
						}elseif( $tms[2] - $tms[1] > 1 ) {
							$tmsx = $tms[2]-$tms[1]-1; //сколько разница
							$tmsa = floor(($tms[1]+$tms[2])/2); //сколько должно быть
							$tmsg = $tmsa - $tms[1]; // сколько
							$tmst1 = 2; //откуда
							$tmst2 = 1;	//куда					
						}
						if( isset($tmsx) ) {
							if( $this->info['arand'] > 0 ) {
								$ord = ' RAND()';
							}else{
								$ord = '`btl_cof2` ASC';
							}
							mysql_query('UPDATE `stats` SET `hpNow` = "1" WHERE `hpNow` < 1 AND `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$this->info['id'].'")');
							mysql_query('UPDATE `battle` SET `players` = "data: '.$tms[1].','.$tms[2].','.$tmst1.','.$tmst2.','.$tmsg.','.$tmsa.'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
							mysql_query('UPDATE `stats` SET `team` = "'.$tmst2.'" WHERE `team` = "'.$tmst1.'" AND `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$this->info['id'].'") ORDER BY '.$ord.' LIMIT '.$tmsg);
						}else{
							mysql_query('UPDATE `battle` SET `players` = "data2: '.$tms[1].','.$tms[2].'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
						}
						unset($tmsx);
					}
				}
				
				$t = mysql_query('SELECT
				`u`.* ,

				`st`.*
				FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`battle` = "'.$this->info['id'].'"');
				
				$i = 0; $bi = 0; $up = '';
				if($this->info['start2']==0) {
					$tststrt = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle` WHERE `id` = "'.$this->info['id'].'" AND `start2` = "0" LIMIT 1'));
					if(isset($tststrt['id'])) {
						$upd = mysql_query('UPDATE `battle` SET `start2` = "'.time().'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
					}else{
						$this->info['start2'] = time();
					}

				}
				while($pl = mysql_fetch_array($t))
				{					
					//записываем данные
					if($pl['login2']=='')
					{
						$pl['login2'] = $pl['login'];
					}
					$this->users[$i] = $pl;
					$this->uids[$pl['id']] = $i;
					if($pl['bot']>0)
					{
						$this->bots[$bi] = $pl['id'];
						$this->iBots[$pl['id']] = $bi;
						$bi++;
					}
					
					if( $this->info['start2'] == 0 ) {
						mysql_query('UPDATE `users` SET `notrhod` = "-1" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
						$this->users[$i]['notrhod'] = -1;
					}
					
					//записываем статы
					if( $u->info['enemy'] != $pl['id'] && $u->info['enemy'] != 0 && $this->stats[$i]['hpAll'] > 0 ) {
						$this->stats[$i]['short_stats'] = true;
					}
					if( $pl['id'] == $u->info['id'] ) {
						$this->stats[$i] = $u->stats;
						
						$this->stats[$i]['hpNow'] = floor($this->stats[$i]['hpNow']);
						$this->stats[$i]['hpAll'] = floor($this->stats[$i]['hpAll']);
						if( $this->stats[$i]['hpNow'] > $this->stats[$i]['hpAll'] ) {
							$this->stats[$i]['hpNow'] = $this->stats[$i]['hpAll'];	
						}elseif( $this->stats[$i]['hpNow'] < 0 ) {
							$this->stats[$i]['hpNow'] = 0;
						}
						
						$this->stats[$i]['mpNow'] = floor($this->stats[$i]['mpNow']);
						$this->stats[$i]['mpAll'] = floor($this->stats[$i]['mpAll']);
						if( $this->stats[$i]['mpNow'] > $this->stats[$i]['mpAll'] ) {
							$this->stats[$i]['mpNow'] = $this->stats[$i]['mpAll'];	
						}elseif( $this->stats[$i]['mpNow'] < 0 ) {
							$this->stats[$i]['mpNow'] = 0;
						}
						
					}elseif( isset($this->stats[$i]['short_stats']) ) {
						
						$this->stats[$i] = $pl;
						$this->stats[$i]['short_stats'] = true;
						
						$this->stats[$i]['hpNow'] = floor($this->stats[$i]['hpNow']);
						$this->stats[$i]['hpAll'] = floor($this->stats[$i]['hpAll']);
						if( $this->stats[$i]['hpNow'] > $this->stats[$i]['hpAll'] ) {
							$this->stats[$i]['hpNow'] = $this->stats[$i]['hpAll'];	
						}elseif( $this->stats[$i]['hpNow'] < 0 ) {
							$this->stats[$i]['hpNow'] = 0;
						}
						
						$this->stats[$i]['mpNow'] = floor($this->stats[$i]['mpNow']);
						$this->stats[$i]['mpAll'] = floor($this->stats[$i]['mpAll']);
						if( $this->stats[$i]['mpNow'] > $this->stats[$i]['mpAll'] ) {
							$this->stats[$i]['mpNow'] = $this->stats[$i]['mpAll'];	
						}elseif( $this->stats[$i]['mpNow'] < 0 ) {
							$this->stats[$i]['mpNow'] = 0;
						}
						
					}else{
						$this->stats[$i] = $u->getStats($pl,0,0,false,$this->cached);
						$this->stats[$i]['full_stats'] = true;
					}
					
					//Заносим старт
					if($this->info['start2'] == 0 )
					{
						if(!isset($ts[$this->users[$i]['team']]))
						{
							$tsi++;
							$ts[$this->users[$i]['team']] = $tsi;
						}
						
						if($this->users[$i]['level'] <= 7) {
							$this->users[$i]['tactic7'] = floor(10/$this->stats[$i]['hpAll']*$this->stats[$i]['hpNow']);
						} elseif($this->users[$i]['level'] == 8) {
							$this->users[$i]['tactic7'] = floor(20/$this->stats[$i]['hpAll']*$this->stats[$i]['hpNow']);
						} elseif($this->users[$i]['level'] == 9) {
							$this->users[$i]['tactic7'] = floor(30/$this->stats[$i]['hpAll']*$this->stats[$i]['hpNow']);
						} elseif($this->users[$i]['level'] >= 10) {
							$this->users[$i]['tactic7'] = floor((40+$this->stats[$i]['s7'])/$this->stats[$i]['hpAll']*$this->stats[$i]['hpNow']);
						}
						if( $this->stats[$i]['s7'] > 49 ) {
							mysql_query('DELETE FROM `eff_users` WHERE `name` = "Спасение" AND `uid` = "'.$this->users[$i]['id'].'"');
							mysql_query("
								INSERT INTO `eff_users` ( `id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`) VALUES
								( 22, '".$this->users[$i]['id']."', 'Спасение', 'add_spasenie=1', 0, 77, 0, '".$this->users[$i]['id']."', 0, 'priem', 324, 'preservation.gif', 1, -1, 'спасение', 0, 0, '', 0, 0, 0, 1, 0);
							");
						}

						
                        #Вот здесь добавляло лишнего духа) Ost. Costa
                        #$this->users[$i]['tactic7'] += $this->stats[$i]['s7'];
                        #####
						// Бафф Зверя animal_bonus
						if($this->users[$i]['animal'] > 0) {
							$a = mysql_fetch_array(mysql_query('SELECT * FROM `users_animal` WHERE `uid` = "'.$this->users[$i]['id'].'" AND `id` = "'.$this->users[$i]['animal'].'" AND `pet_in_cage` = "0" AND `delete` = "0" LIMIT 1'));
							if(isset($a['id'])) {
								if($a['eda']>=1) {
									$anl = mysql_fetch_array(mysql_query('SELECT `bonus` FROM `levels_animal` WHERE `type` = "'.$a['type'].'" AND `level` = "'.$a['level'].'" LIMIT 1'));
									$anl = $anl['bonus'];
									
									$tpa = array(1=>'cat',2=>'owl',3=>'wisp',4=>'demon',5=>'dog',6=>'pig',7=>'dragon');
									$tpa2 = array(1=>'Кота',2=>'Совы',3=>'Светляка',4=>'Чертяки',5=>'Пса',6=>'Свина',7=>'Дракона');
									$tpa3 = array(1=>'Кошачья Ловкость',2=>'Интуиция Совы',3=>'Сила Стихий',4=>'Демоническая Сила',5=>'Друг',6=>'Полная Броня',7=>'Инферно');
									
									mysql_query('INSERT INTO `eff_users` (`hod`,`v2`,`img2`,`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`v1`,`user_use`) VALUES ("-1","201","summon_pet_'.$tpa[$a['type']].'.gif",22,"'.$this->users[$i]['id'].'","'.$tpa3[$a['type']].' ['.$a['level'].']","'.$anl.'","0","77","priem","'.$this->users[$i]['id'].'")');
									
									if( $tpa[$a['type']] == 'dog' ) {
										$anlhp = str_replace('add_hpAll=','',$anl);
										$anlhp = (int)$anlhp;
										mysql_query('UPDATE `stats` SET `hpNow` = `hpNow` + "'.$anlhp.'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
										$this->users[$i]['hpNow'] += $anlhp;
										$this->stats[$i]['hpNow'] += $anlhp;
									}
									
									$anl = $u->lookStats($anl);
									
									$vLog = 'time1='.time().'||s1='.$this->users[$i]['sex'].'||t1='.$this->users[$i]['team'].'||login1='.$this->users[$i]['login'].'';
									$vLog .= '||s2=1||t2='.$this->users[$i]['team'].'||login2='.$a['name'].' (Зверь '.$this->users[$i]['login'].')';
									
									$mas1 = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>1,'text'=>'','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
									
									$ba = '';
									$i6 = 0;
									while($i6<count($u->items['add'])) {
										if(isset($anl['add_'.$u->items['add'][$i6]])) {
											if($anl['add_'.$u->items['add'][$i6]] > 0) {
												$ba .= $u->is[$u->items['add'][$i6]].': +'.$anl['add_'.$u->items['add'][$i6]].', ';
											}
										}
										$i6++;
									}
									$ba = trim($ba,', ');
									if($ba == '') {
										$ba = 'Эффект отсутсвует';
									}
									
									$mas1['text'] = '{tm1} {u2} очнулся от медитации, и призвал заклятье &quot;<b>'.$tpa3[$a['type']].' ['.$a['level'].']</b>&quot; на {u1}. ('.$ba.')';
									$nxtlg[count($nxtlg)] = $mas1;
									mysql_query('UPDATE `users_animal` SET `eda` = `eda` - 1 WHERE `id` = "'.$a['id'].'" LIMIT 1');
									//$this->add_log($mas1);
									$this->get_comment();
								}else{
									$u->send('',$this->users[$i]['room'],$this->users[$i]['city'],'',$this->users[$i]['login'],'<b>'.$a['name'].'</b> нуждается в еде...',time(),6,0,0,0,1);
								}
							}
						}
												
						mysql_query('UPDATE `stats` SET `last_hp` = "0",`tactic1`="0",`tactic2`="0",`tactic3`="0",`tactic4`="0",`tactic5`="0",`tactic6`="0",`tactic7` = "'.($this->users[$i]['tactic7']).'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');

						$rs[$this->users[$i]['team']] .= $u->microLogin($this->users[$i],2).', ';
					}
					$up .= '`uid` = "'.$pl['id'].'" OR';
					//battle-user (статистика, начальная)
					$mybu = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle_users` WHERE `battle` = "'.$this->info['id'].'" AND `uid` = "'.mysql_real_escape_string($pl['id']).'" LIMIT 1'));
					if(!isset($mybu['id'])) {
						//Пустое значение статистики для данного персонажа за текущий бой
						$this->addstatuser($pl['id']);
					}
					$i++;
				}
				
				/*
				if($i == 0) {
					$t = mysql_query('SELECT `u`.*,`st`.* FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON (`u`.`id` = `st`.`id`) WHERE `u`.`battle` = "'.$this->info['id'].'" AND `st`.`hpNow` > 0');
					$i = 0; $bi = 0; $up = '';
					while($pl = mysql_fetch_array($t))
					{
						//записываем данные
						if($pl['login2']=='')
						{
							$pl['login2'] = $pl['login'];
						}
						$this->users[$i] = $pl;
						$this->uids[$pl['id']] = $i;
						if($pl['bot']>0)
						{
							$this->bots[$bi] = $pl['id'];
							$this->iBots[$pl['id']] = $bi;
							$bi++;
						}
						//записываем статы
						$this->stats[$i] = $u->getStats($pl,0);
						//Заносим старт
						if($this->info['start1']==0)
						{
							if(!isset($ts[$this->users[$i]['team']]))
							{
								$tsi++;
								$ts[$this->users[$i]['team']] = $tsi;
							}
							
							if($this->users[$i]['level']<=7)
							{
								$this->users[$i]['tactic7'] = floor(10/$this->stats[$i]['hpAll']*$this->stats[$i]['hpNow']);
							}elseif($this->users[$i]['level']==8)
							{
								$this->users[$i]['tactic7'] = floor(20/$this->stats[$i]['hpAll']*$this->stats[$i]['hpNow']);
							}elseif($this->users[$i]['level']==9)
							{
								$this->users[$i]['tactic7'] = floor(30/$this->stats[$i]['hpAll']*$this->stats[$i]['hpNow']);
							}elseif($this->users[$i]['level']>=10)
							{
								$this->users[$i]['tactic7'] = floor(40/$this->stats[$i]['hpAll']*$this->stats[$i]['hpNow']);
							}
							
							$this->users[$i]['tactic7'] += $this->stats[$i]['s7'];
							
							mysql_query('UPDATE `stats` SET `tactic1`="0",`tactic2`="0",`tactic3`="0",`tactic4`="0",`tactic5`="0",`tactic6`="0",`tactic7`="0",`tactic7` = "'.($this->users[$i]['tactic7']).'" WHERE `id` = "'.$this->users[$i]['id'].'" LIMIT 1');
							
							$rs[$tsi] .= $u->microLogin($this->users[$i],2).', ';
						}
						$up .= '`uid` = "'.$pl['id'].'" OR';
						$i++;
					}
				}
				*/
				
				$up = rtrim($up,' OR');
				//mysql_query('UPDATE `eff_users` SET `timeAce` = "0" WHERE ('.$up.') AND `delete` = "0"');
				//echo '<hr><hr><hr>';
				
				//Заносим в лог начало поединка
				
				if($this->info['start1']==0)
				{
					$tststrt = mysql_fetch_array(mysql_query('SELECT `id` FROM `battle` WHERE `id` = "'.$this->info['id'].'" AND `start1` = "0" LIMIT 1'));
					if(isset($tststrt['id'])) {
						
						//Проверка распределения команд
						/*if( $this->info['razdel'] == 5 ) {
							$tms1p = mysql_query('SELECT `team` , COUNT(*) AS `x` FROM `stats` WHERE `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$this->info['id'].'") GROUP BY `team`');
							$tms = array();
							while( $tms1 = mysql_fetch_array($tms1p) ) {
								$tms[$tms1['team']] = $tms1['x'];
							}
							unset($tms1,$tms1p);
							if( $tms[1] - $tms[2] > 1 ) {
								$tmsx = $tms[1]-$tms[2]-1; //сколько разница: 5 - 1 - 1 = 3
								$tmsa = floor(($tms[1]+$tms[2])/2); //сколько должно быть 5 + 1 \ 2 = 3
								$tmsg = $tmsa - $tms[2]; // сколько tmsa 3 - tms[1] 1 = 2 игрока
								$tmst1 = 1; //откуда
								$tmst2 = 2; //куда
							}elseif( $tms[2] - $tms[1] > 1 ) {
								$tmsx = $tms[2]-$tms[1]-1; //сколько разница
								$tmsa = floor(($tms[1]+$tms[2])/2); //сколько должно быть
								$tmsg = $tmsa - $tms[1]; // сколько
								$tmst1 = 2; //откуда
								$tmst2 = 1;	//куда					
							}
							if( isset($tmsx) ) {
								mysql_query('UPDATE `stats` SET `hpNow` = "1" WHERE `hpNow` < 1 AND `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$this->info['id'].'")');
								mysql_query('UPDATE `battle` SET `players` = "data: '.$tms[1].','.$tms[2].','.$tmst1.','.$tmst2.','.$tmsg.','.$tmsa.'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
								mysql_query('UPDATE `stats` SET `team` = "'.$tmst2.'" WHERE `team` = "'.$tmst1.'" AND `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$this->info['id'].'") ORDER BY RAND() LIMIT '.$tmsg);
							}else{
								mysql_query('UPDATE `battle` SET `players` = "data2: '.$tms[1].','.$tms[2].'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
							}
							unset($tmsx);
						}*/
						
						$upd = mysql_query('UPDATE `battle` SET `start1` = "'.time().'" WHERE `id` = "'.$this->info['id'].'" LIMIT 1');
						if($upd)
						{
							$i = 0; $r = '';
							while($i <= $tsi)
							{
								if(isset($rs[$i]) && $rs[$i] != '') {
									$r .= rtrim($rs[$i],', ').' и ';
								}
								$i++;
							}
							$r = rtrim($r,' и ');
							$r = str_replace('"','\\\\\"',$r);
							$this->hodID++;
							$vLog = 'time1='.time().'||';
							$mass = array('time'=>time(),'battle'=>$this->info['id'],'id_hod'=>$this->hodID,'text'=>'test','vars'=>$vLog,'zona1'=>'','zonb1'=>'','zona2'=>'','zonb2'=>'','type'=>'1');
							$r = 'Часы показывали <span class=\\\\\"date\\\\\">'.date('d.m.Y H:i',$this->info['time_start']).'</span>, когда '.$r.' бросили вызов друг другу.';
							$ins = mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$r.'","'.$mass['vars'].'","'.$mass['zona1'].'","'.$mass['zonb1'].'","'.$mass['zona2'].'","'.$mass['zonb2'].'","'.$mass['type'].'")');
							if(!$ins)
							{
								//echo $r;
							}
							$this->info['start1'] = time();
						}
					}
					
					//
					
					if(count($nxtlg) > 0) {
						$i = 0;
						while($i < count($nxtlg)) {
							$this->add_log($nxtlg[$i]);
							$i++;
						}
					}
					
					//
				}
			}
		}
	
	//Возращаем зоны блока по умолчанию
		public function restZonb($uid1,$uid2)
		{
			if($this->stnZbVs[$uid1]>0)
			{
				$this->stats[$this->uids[$uid1]]['zonb'] = $this->stnZbVs[$uid1];
			}
			if($this->stnZbVs[$uid2]>0)
			{
				$this->stats[$this->uids[$uid1]]['zonb'] = $this->stnZbVs[$uid2];
			}
		}
	
	//проверка блока (Визуальная)
		public function testZonbVis()
		{
			global $u;
			if($this->stnZbVs==0)
			{
				$zb = $this->stats[$this->uids[$u->info['id']]]['zonb'];
				$this->stnZbVs = $zb;
			}else{
				$zb = $this->stnZb;
			}
			$eu = $this->users[$this->uids[$u->info['id']]]['enemy'];
			if($zb>3){ $zb = 3; }
			if($eu!='' && $eu!=0)
			{
				if($this->stats[$this->uids[$eu]]['weapon1']==1 || $this->stats[$this->uids[$eu]]['weapon2']==1)
				{
					if($this->stats[$this->uids[$u->info['id']]]['weapon1']!=1 && $this->stats[$this->uids[$u->info['id']]]['weapon2']!=1)
					{
						$zb -= 1;		
					}				
				}
			}
			if($zb<1){ $zb = 1; }
			return $zb;
		}
		
	//проверка блока
		public function testZonb($uid,$uid2,$id)
		{
			global $u;
			$zba = array(1=>0,2=>0);
			
			$uid1r = $uid;
			$uid2r = $uid2;
			
			if( $this->stats[$this->uids[$uid]]['yhod'] > 0) {
				$uid2 = $uid1r;
			}
			if( $this->stats[$this->uids[$uid2]]['yhod'] > 0) {
				$uid = $uid2r;
			}
			
			if( $this->stats[$this->uids[$uid2]]['yhod'] > 0 && $this->atacks[$id]['out2'] > 0 && $this->atacks[$id]['b2'] == 0) {
				$this->atacks[$id]['b2'] = rand(1,5);
				$this->atacks[$id]['a2'] = ''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).''.rand(1,5).'';
				mysql_query('UPDATE `battle_act` SET `a2` = "'.$this->atacks[$id]['a2'].'" , `b2` = "'.$this->atacks[$id]['b2'].'" WHERE `id` = "'.$this->atacks[$id]['id'].'" LIMIT 1');
			}
			
			$zba[1] = $this->stats[$this->uids[$uid]]['zonb'];
			$zba[2] = $this->stats[$this->uids[$uid2]]['zonb'];
			
			if($this->stnZb[$uid]==0)
			{
				$zba[1] = $this->stats[$this->uids[$uid]]['zonb'];
				$this->stnZb[$uid] = $zba[1];
			}else{
				$zba[1] = $this->stnZb[$uid];
			}
			
			if($this->stnZb[$uid2]==0)
			{
				$zba[2] = $this->stats[$this->uids[$uid2]]['zonb'];
				$this->stnZb[$uid] = $zba[2];
			}else{
				$zba[2] = $this->stnZb[$uid2];
			}
			
			if($zba[1]>3){ $zba[1] = 3; }
			if($zba[2]>3){ $zba[2] = 3; }
			
			//Блоки игрока 1
			if($this->stats[$this->uids[$uid2]]['weapon1']==1 || $this->stats[$this->uids[$uid2]]['weapon2']==1)
			{
				if($this->stats[$this->uids[$uid]]['weapon1']!=1 && $this->stats[$this->uids[$uid]]['weapon2']!=1)
				{
					$zba[1] -= 1;		
				}				
			}
			
			//Блоки игрока 2
			if($this->stats[$this->uids[$uid]]['weapon1']==1 || $this->stats[$this->uids[$uid]]['weapon2']==1)
			{
				if($this->stats[$this->uids[$uid2]]['weapon1']!=1 && $this->stats[$this->uids[$uid2]]['weapon2']!=1)
				{
					$zba[2] -= 1;		
				}				
			}			
			
			if($zba[1]<1){ $zba[1] = 1; }
			if($zba[2]<1){ $zba[2] = 1; }
						
			$this->stats[$this->uids[$uid]]['zonb'] = $zba[1];
			$this->stats[$this->uids[$uid2]]['zonb'] = $zba[2];
			if($this->stats[$this->uids[$uid]]['min_zonb']>0 && $this->stats[$this->uids[$uid]]['zonb']<$this->stats[$this->uids[$uid]]['min_zonb'])
			{
				$this->stats[$this->uids[$uid]]['zonb'] = $this->stats[$this->uids[$uid]]['min_zonb'];
			}
			if($this->stats[$this->uids[$uid2]]['min_zonb']>0 && $this->stats[$this->uids[$uid2]]['zonb']<$this->stats[$this->uids[$uid2]]['min_zonb'])
			{
				$this->stats[$this->uids[$uid2]]['zonb'] = $this->stats[$this->uids[$uid2]]['min_zonb'];
			}	
		}
	
	//генерируем команды
		public function genTeams($you)
		{
			$ret = '';
			$teams = array( );
			//выделяем пользователей
			$i = 0;	 $j = 1; $tms =	array( );
			//if( $this->users[$this->uids[$you]]['team'] > 0 && $this->stats[$this->uids[$you]]['hpNow'] > 0 ) {
				$teams[$this->users[$this->uids[$you]]['team']] = '';
				$tms[0] = $this->users[$this->uids[$you]]['team'];
			//}
			while($i<count($this->uids))
			{
				if($this->stats[$i]['hpNow']>0)
				{
					if(!isset($teams[$this->users[$i]['team']]))
					{
						$tms[$j] = $this->users[$i]['team'];
						$j++;
					}	
					if($this->stats[$i]['hpNow']<0){ $this->stats[$i]['hpNow'] = 0; }
					$a1ms = '';
					if(isset($this->ga[$this->users[$i]['id']][$you]) && $this->ga[$this->users[$i]['id']][$you]!=false)
					{
						$a1mc = '';
						$ac = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `id` = "'.$this->ga[$this->users[$i]['id']][$you].'" LIMIT 1'));
						if(isset($ac) && $ac['time']+$this->info['timeout']-15<time())
						{
							$a1mc = 'color:red;';
						}
						$a1ms = 'style=\"text-decoration: underline; '.$a1mc.'\"';
					}elseif(isset($this->ag[$this->users[$i]['id']][$you]) && $this->ag[$this->users[$i]['id']][$you]!=false)
					{
						$a1mc = '';
						$ac = mysql_fetch_array(mysql_query('SELECT * FROM `battle_act` WHERE `id` = "'.$this->ag[$this->users[$i]['id']][$you].'" LIMIT 1'));
						if(isset($ac) && $ac['time']+$this->info['timeout']-15<time())
						{
							$a1mc = 'color:green;';
						}
						$a1ms = 'style=\"text-decoration: overline; '.$a1mc.'\"';
					}		
					if($this->users[$i]['login2']=='')
					{
						$this->users[$i]['login2'] = $this->users[$i]['login'];
					}
					if ($this->users[$i]['align']==9){
						$this->stats[$i]['hpNow'] = $this->stats[$i]['hpNow']/($this->stats[$i]['hpAll']/100); 
						$this->stats[$i]['hpAll'] = '100%';
					}
					$ldr = '';
					if( $this->users[$i]['lider'] == $this->info['id'] ) {
						$ldr = '<img width=24 height=15 title=Лидер&nbsp;группы src=http://img.likebk.com/i/lead'.$this->users[$i]['team'].'.gif \>';	
					}
					$teams[$this->users[$i]['team']] .= ', '.$ldr.'<span '.$a1ms.' class=\"CSSteam'.$this->users[$i]['team'].'\" onClick=\"top.chat.addto(\''.$this->users[$i]['login2'].'\',\'to\'); return false;\" oncontextmenu=\"top.infoMenu(\''.$this->users[$i]['login2'].'\',event,\'main\'); return false;\">'.$this->users[$i]['login2'].'</span><small> <a href=/inf.php?'.$this->stats[$i]['id'].' target=_blank ><img src=http://img.likebk.com/i/inf_capitalcity.gif ></a> ['.floor($this->stats[$i]['hpNow']).'/'.$this->stats[$i]['hpAll'].']</small>';
				}
				$i++;				
			}
			
			//генерируем команды
			$i = 0;
			while($i<count($tms))
			{
				$teams[$tms[$i]] = ltrim($teams[$tms[$i]],', ');
				if( $teams[$tms[$i]] != '' ) {
					if($u->info['team'] == $tms[$i]) {
						$teams[$tms[$i]] = '<img src=\"http://img.likebk.com/i/lock3.gif\" style=\"cursor:pointer\" width=\"20\" height=\"15\" onClick=\"top.chat.addto(\'team'.$tms[$i].'\',\'private\'); return false;\"> '.$teams[$tms[$i]];
					}else{
						$teams[$tms[$i]] = '<img src=\"http://img.likebk.com/i/lock3.gif\" style=\"cursor:pointer\" width=\"20\" height=\"15\" onClick=\"top.chat.addto(\'team\',\'private\'); return false;\"> '.$teams[$tms[$i]];
					}
					$ret .= $teams[$tms[$i]];				
					if(count($tms)>$i+1)
					{
						$ret .= ' <span class=\"CSSvs\">&nbsp; против &nbsp;</span> ';
					}
				}
				$i++;
			}
			return 'genteam("'.$ret.'");';
		}
		
		
		public function addTravm($uid,$type,$lvl,$nelich)
		{
		    global $u;
			
			$tsttr1 = mysql_fetch_array(mysql_query('SELECT `id` FROM `eff_users` WHERE `uid` = "'.$uid.'" AND `id_eff` = 263 AND `delete` = 0 LIMIT 1'));
			if(!isset($tsttr1['id'])) {
					
				
				if(isset($nelich['id'])) { 
					$type = 3;
				}
				
				$t = $type;
				
				if($t==1){
						$name='Легкая травма';
						$stat=rand(1, 3); // пока без духовности
						$timeEnd=rand(5400,21600);// время травмы от 1.30 до 6 часов
						$data='add_s'.$stat.'=-'.$lvl;
						$img = 'eff_travma1.gif';
						$v1=1;
						//echo '<b><font color=red>'.$name.'</font></b>';
				}elseif($t==2){
						$name='Средняя травма';
						$stat=rand(1, 3); // пока без духовности
						$timeEnd=rand(21600,43200);// время травмы от 6 до 12 часов
						$data='add_s'.$stat.'=-'.($lvl*2);
						$v1=2;
						$img = 'eff_travma2.gif';
				}
				elseif($t==3){
						$name='Тяжелая травма';
						$stat=rand(1, 3); // пока без духовности
						$timeEnd=rand(43200,86400);// время травмы от 12 до 6 часов
						$data='add_s'.$stat.'=-'.($lvl*3);
						$v1=3;
						$img = 'eff_travma3.gif';
				}
				if(isset($nelich['id'])) {
					$name .= ' (Неизлечимая)';
					$timeEnd = $nelich['time'] * 3600;
					$data .= '|nelich=1';
				}
				if( $timeEnd < 3600 ) {
					$timeEnd = 3600*rand(3,7);
				}
				$ins = mysql_query('INSERT INTO `eff_users` (`overType`,`timeUse`,`hod`,`name`,`data`,`uid`, `id_eff`, `img2`, `timeAce`, `v1`) VALUES ("0","'.time().'","-1","'.$name.'","'.$data.'","'.$uid.'", "4", "'.$img.'","'.$timeEnd.'", "'.$v1.'")');
				$ins = mysql_query('INSERT INTO `eff_users` (`overType`,`timeUse`,`hod`,`name`,`data`,`uid`, `id_eff`, `img2`, `timeAce`, `v1`) VALUES ("0","'.time().'","-1","Иммунитет: Защита от травм","add_notravma=1","'.$uid.'", "263", "cure1.gif","21600", "")');
			}
		}
}

$btl = new battleClass;
?>