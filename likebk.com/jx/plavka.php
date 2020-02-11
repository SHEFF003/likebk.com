<?php 
define('GAME',true);

include('../_incl_data/__config.php');
include('../_incl_data/class/__db_connect.php');
include('../_incl_data/class/__user.php');

//print_r($_POST);
$id = '';
foreach($_POST as $key=>$val) 
{
	$id_i = explode("_", $val);
	$id .= '`id` = "'.round((int)$id_i[1]).'" OR ';
}
$id = trim($id,' OR ');
$it_user = mysql_query('SELECT * FROM `items_users` WHERE ('.$id.') AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 3');
$i = 1;
$lvl1 = 0;
$lvl2 = 0;
$lvl3 = 0;
$lid = array();
while ($it_us = mysql_fetch_array($it_user)) {
	if( !isset($lid[$it_us]) ) {
		$it_main = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$it_us['item_id'].'"'));
		if($i == 1){
			$lvl1 = $it_main['level'];	
		}
		elseif($i == 2){
			$lvl2 = $it_main['level'];	
		}
		elseif($i == 3){
			$lvl3 = $it_main['level'];	
		}
		$na += $it_us['name'].",";
		$lid[$it_us] = true;
		$i++;
	}
}

if( $i < 3 ) {
	die('Необходимо выбрать 3 разных руны.');
}

$na = trim($na, ',');
$rep = 0;
$unik = 0;
if($lvl1 == $lvl2 && $lvl2 == $lvl3 && $lvl1 == 1){
	$rep = 1;
	$levmin = 1;
}
elseif($lvl1 == $lvl2 && $lvl2 == $lvl3 && $lvl1 == 2){
	$rep = 3;	
	$levmin = 2;
}
elseif($lvl1 == $lvl2 && $lvl2 == $lvl3 && $lvl1 == 3){
	$rep = 5;
	$levmin = 3;
	//Уникальная руна шанс получения 1%
	if(rand(1, 100) <= 1){
		$unik = 1;
	}

}
else{
	//echo $lvl1."<br>".$lvl2."<br>".$lvl3;
	$levmin = 5;
	if($levmin >= $lvl3){
		$levmin = $lvl3;
	}
	if($levmin >= $lvl2){
		$levmin = $lvl2;
	}
	if($levmin >= $lvl1){
		$levmin = $lvl1;
	}
}
if($levmin != 5){
	if($levmin == 2){
		$rep = 3;
	}elseif($levmin == 1){
		$rep = 1;
	}
}
if($unik == 1){
	$rune = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `type` = "31" AND `level` = "4" ORDER BY RAND() LIMIT 1'));
}else{
	$rune = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `type` = "31" AND `level` = "'.$levmin.'" ORDER BY RAND() LIMIT 1'));
}
	if(isset($rune['name'])) {
		echo 'В результате плавки получена руна "'.$rune['name'].'".';
		$u->addItem($rune['id'],$u->info['id'], null, null, null, '', $na);
		mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE ('.$id.') AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 ');
		if($u->rep['rep1'] < 10000){
			$u->rep['rep1'] += $rep;
			mysql_query('UPDATE `rep` SET `rep1` = "'.$u->rep['rep1'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}
	}else{
		echo 'Руна не найдена... Попробуйте еще! "'.$rune['name'].'".';
	}

/*
echo '<span id="rune_vibor">';
	echo '<table id="vib_run" style="border-top:#A5A5A5 1px solid;" width="100%" border="0" cellspacing="0" cellpadding="0">
		<thead><tr><td colspan="2">Выберите одну из рун</td></tr></thead>
				<tbody>';
	while ($triRune = mysql_fetch_array($rune)) {?>
		<tr>
			<td  bgcolor="#c8c8c8" width="160" align="center" style="border-right:#A5A5A5 1px solid; padding:5px;">
				<?php echo '<img src="http://'.$c['img'].'/i/items/'.$triRune['img'].'" style="margin-bottom:5px;">'?><br>
				<a href="javascript:void(0);" onClick="RecItRun(<?php echo $triRune['id']?>)">Выбрать</a>
			</td>
			<td  bgcolor="#c8c8c8" valign="top" align="left" style="padding-left:3px; padding-bottom:3px; padding-top:7px;">
				<div align="left">
					<a class="inv_name" ><?php echo $triRune['name']?></a>&nbsp;&nbsp; 
					(Масса: <?php echo $triRune['massa']?>) 
					<img title="Этот предмет связан общей судьбой с qwert. Никто другой не сможет его использовать." src="http://img.likebk.com/i/desteny.gif">
					<br>Долговечность: <font color="">0/1</font>
					<br><b>Требуется минимальное:</b>
					<br>• Уровень: <?php echo $triRune['level']?><br>
					<b>Свойства предмета:</b>
					<br>• <?php echo $triRune['name']?>
					<small style="font-size:10px;"><div>
						<b>Описание:</b></div>
						<div><?php echo $triRune['info']?></div>
						<div>Сделано в Capital city</div>
					</small>
				</div>
			</td>
		</tr>
<?php }
	echo '</tbody></table></span>';*/
unset($_POST);	