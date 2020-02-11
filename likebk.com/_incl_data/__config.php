<?
if($_COOKIE['login'] == 'Повелитель Багов' ) {
	error_reporting (1);
	ini_set('display_errors','On');
    setlocale(LC_CTYPE ,"ru_RU.CP1251");
}else{
	error_reporting (1);
	ini_set('display_errors','Off');
    setlocale(LC_CTYPE ,"ru_RU.CP1251");
}

$c = array();
/* Конфигурации игры */

$c['title']  = '«Бойцовский клуб» - Бесплатная, современная браузерная онлайн игра'; //Название игры
$c['title2'] = ' - Бесплатная, современная онлайн игра посвященная сражениям и магии!';
$c['title3']  = 'Бойцовский клуб';
$c['name']   =  'Бойцовский клуб';
$c['keys']   = 'bk2,бк2,2-bk,combatz, игра, играть, игрушки, онлайн,online, интернет, internet, RPG, fantasy, фэнтези, меч, топор, магия, кулак, удар, блок, атака, защита, бой, битва, отдых, обучение, развлечение, виртуальная реальность, рыцарь, маг, знакомства, чат, лучший, форум, свет, тьма, games, клан, банк, магазин, клан'; //Ключевые слова META
$c['desc']   = 'Отличная RPG онлайн игра посвященная боям и магии. Тысячи жизней, миллионы смертей, два бога, сотни битв между Светом и Тьмой.'; //Описание META

//Сервера
$c['host']        = 'likebk.com';
$c['forum']       = 'forum.'.$c['host'];
$c['img']   	  = 'img.likebk.com';
$c['thiscity']    = 'capitalcity';
$c['capitalcity'] = $c['host'];
$c['abandonedplain'] = $c['host'];
$c['exit']		  = '<script>top.location="http://'.$c['host'].'/";</script><noscript><meta http-equiv="refresh" content="0; URL=http://'.$c['host'].'/"></noscript>';

//Скупка
$c['shop_type1'] = 100; //в гос
$c['shop_type2'] = 100; //в березку
$c['ekrbonus']	 = 0; // бонус в % к продаже екр
$c['ekr2bonus']	 = 0; // бонус в % к продаже голд Екр
$c['exp2cp']     = 100; //повышение опыта +100% на цп

//Праздничные бонусы х2 опыт всегда , х2 пенсия всегда , бесплатный ремонт , бесплатное извлечение рун и заточек
$c['holiday'] = false;
if( date('m') > 1 ) {
//	$c['holiday'] = false;
}

$c['prcshp'] = 0.9; //сдача в гос , стандарт 0.90
if( $c['prcshp'] > 1 ) { $c['prcshp'] = 1; }
if( $c['prcshp'] < 0.01 ) { $c['prcshp'] = 0.01; }

//Выпадение страничек Саныча в хаоте
$c['haotsanich'] = false;

//Игра
//$code = explode(' ',microtime());
//$code = $code[0].''.round($code[1]/rand(1,5));
$code = '1';
$c['counters']  = '';

$c['copyright'] = 'Copyright © '.date('Y').' «Бойцовский Клуб»';

$c['counters_noFrm']  = $c['counters'];

$c['level_ransfer'] = 4;
$c['znahar'] = 1;
?>