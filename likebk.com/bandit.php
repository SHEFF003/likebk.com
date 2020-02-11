<?
define('GAME',true);	
include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

$q = '';

/*
1 - серьги
2 - амулет\ожерелье
3 - меч (правая рука)
4 - броня
5 - кольцо
6 - кольцо
7 - кольцо
8 - шлем
9 - перчатки
10 - щит (левая рука)
11 - ботинки
12 - рубашка
13 - плащ
*/

$slots = array(
	8 => 1,
	9 => 2,
	3 => 3,
	5 => 4,
	10 => 5,
	1 => 8,
	13 => 9,
	14 => 10,
	17 => 11,
	4 => 12,
	6 => 13
);

$types = array(
	9 => 1, //серьги
	10 => 2, //амулет
	5 => 3, //легкая броня
	6 => 4, //броня
	11 => 5, //кольцо
	1 => 6, //шлем
	12 => 7, //перчатки
	13 => 8, //щит
	15 => 9, //ботинки
	4 => 10, //рубашка
	7 => 11, //плащ
	18 => 12, //нож
	19 => 13, //топор
	20 => 14, //дубина
	21 => 15 //меч
);

$sp = mysql_query('SELECT `a`.* , `b`.* FROM `items_main` AS `a` LEFT JOIN `items_main_data` AS `b` ON `b`.`items_id` = `a`.`id` WHERE `a`.`geni` = 1');
while( $pl = mysql_fetch_array($sp) ) {
	if( $q != '' ) {
		$q .= ' , ';
	}
	
	if(isset($slots[$pl['inslot']],$types[$pl['type']])) {
	
		$pl['type'] = $types[$pl['type']];
		$pl['inslot'] = $slots[$pl['inslot']];
		
		$po = $u->lookStats($pl['data']);
		
		if(!isset($po['add_minAtack']) && isset($po['sv_minAtack'])) {
			$po['add_minAtack'] = $po['sv_minAtack'];
		}
		if(!isset($po['add_maxAtack']) && isset($po['sv_maxAtack'])) {
			$po['add_maxAtack'] = $po['sv_maxAtack'];
		}
		
		$q .= '(
			
			"'.$pl['name'].'","'.$pl['img'].'","'.$pl['price1'].'","'.$pl['price2'].'","'.$pl['inslot'].'","'.$pl['type'].'","'.$pl['massa'].'","'.$pl['iznosMAXi'].'",
			
			"'.$pl['inRazdel'].'","'.$po['tr_lvl'].'",
			
			"'.$po['tr_s1'].'","'.$po['tr_s2'].'","'.$po['tr_s3'].'","'.$po['tr_s4'].'","'.$po['tr_s5'].'","'.$po['tr_s6'].'"
			
			,"'.$po['add_s1'].'","'.$po['add_s2'].'","'.$po['add_s3'].'","'.$po['add_s4'].'","'.$po['add_s5'].'","'.$po['add_s6'].'"
			,"'.$po['add_hpAll'].'","'.$po['add_mpAll'].'"
			,"'.$po['add_m1'].'","'.$po['add_m2'].'","'.$po['add_m4'].'","'.$po['add_m5'].'"
			,"'.$po['add_mib1'].'","'.$po['add_mib2'].'","'.$po['add_mib3'].'","'.$po['add_mib4'].'"
			,"'.$po['add_minAtack'].'","'.$po['add_maxAtack'].'"
			
			,"'.$po['add_a1'].'","'.$po['add_a2'].'","'.$po['add_a3'].'","'.$po['add_a4'].'","'.$po['add_a5'].'"
			,"'.$po['add_mg1'].'","'.$po['add_mg2'].'","'.$po['add_mg3'].'","'.$po['add_mg4'].'","'.$po['add_mg5'].'","'.$po['add_mg6'].'","'.$po['add_mg7'].'"
			
			,"'.$po['tr_mg1'].'","'.$po['tr_mg2'].'","'.$po['tr_mg3'].'","'.$po['tr_mg4'].'","'.$po['tr_mg5'].'","'.$po['tr_mg6'].'","'.$po['tr_mg7'].'"
			,"'.$po['tr_a1'].'","'.$po['tr_a2'].'","'.$po['tr_a3'].'","'.$po['tr_a4'].'","'.$po['tr_a5'].'"
		
		)<br>';
		
	}
	
}
echo 'INSERT INTO `items_main` (
	`name`,`img`,`1price`,`2price`,`inSlot`,`type`,`massa`,`iznos_max`,
	`inRazdel`,
	`tr_lvl`';	
$i = 1;
while( $i <= 6 ) {
	echo ',`tr_s'.$i.'`';
	$i++;
}
$i = 1;
while( $i <= 6 ) {
	echo ',`add_s'.$i.'`';
	$i++;
}
echo ',`add_hpAll`,`add_mpAll`';
$i = 1;
while( $i <= 4 ) {
	echo ',`add_m'.$i.'`';
	$i++;
}
$i = 1;
while( $i <= 4 ) {
	echo ',`add_bron'.$i.'`';
	$i++;
}
echo ',`yron_min`,`yron_max`';	
$i = 1;
while( $i <= 5 ) {
	echo ',`wa'.$i.'`';
	$i++;
}
$i = 1;
while( $i <= 7 ) {
	echo ',`wm'.$i.'`';
	$i++;
}
$i = 1;
while( $i <= 7 ) {
	echo ',`tr_wm'.$i.'`';
	$i++;
}
$i = 1;
while( $i <= 5 ) {
	echo ',`tr_wa'.$i.'`';
	$i++;
}
	
$q = str_replace(',""',',"0"',$q);
	
echo ') VALUES ' . $q;

?>