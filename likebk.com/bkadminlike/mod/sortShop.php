<style type="text/css">
	#update{
		width: 800px!important;
		word-wrap: break-word;
	}
</style>
<?php

	$dbgo = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
	mysql_select_db('like_mainbd',$dbgo);
	mysql_query('SET NAMES cp1251');
	
	$magas = array(2=>"Березка",777=>"Артефактный магазин",1=>"ГосМаг");
	
	$berez = array(1=>'Оружие: кастеты,ножи',
			2=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;топоры',
			3=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;дубины,булавы',
			4=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;мечи',
			5=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;магические посохи',
			6=>'Одежда: сапоги',
			7=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;перчатки',
			8=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;рубахи',
			9=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;легкая броня',
			10=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;тяжелая броня',
			11=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;шлемы',
			12=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;наручи',
			13=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;пояса',
			14=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;поножи',
			28=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;плащи и накидки',
			15=>'Щиты',
			16=>'Ювелирные товары: серьги',
			17=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ожерелья',
			18=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;кольца',
			19=>'Заклинания: нейтральные',
			20=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;боевые и защитные',
			50=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;исцеляющие',
			55=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;манящие',
			56=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;тактические',
			51=>'Руны',
			52=>'Чарки',
			53=>'Книги',
			21=>'Амуниция',
			36=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;эликсиры',
			37=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;еда',
			32=>'Сувениры: открытки',
			29=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;подарки',
			33=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;недобрые',
			34=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;упаковка',
			35=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;фейерверки',
			54=>'Чеки');

$gosmag = array(1=>'Оружие: кастеты,ножи',
		2=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;топоры',
		3=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;дубины,булавы',
		4=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;мечи',
		5=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;магические посохи',
		6=>'Одежда: сапоги',
		7=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;перчатки',
		8=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;рубахи',
		9=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;легкая броня',
		10=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;тяжелая броня',
		11=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;шлемы',
		12=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;наручи',
		13=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;пояса',
		14=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;поножи',
		15=>'Щиты',
		16=>'Ювелирные товары: серьги',
		17=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ожерелья',
		18=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;кольца',
		19=>'Заклинания: нейтральные',
		20=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;боевые и защитные',
		50=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;исцеляющие',
		55=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;манящие',
		21=>'Амуниция',
		36=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Эликсиры',
		37=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;еда',
		32=>'Сувениры: открытки',
		29=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Подарки');
/*
	$otdels_array = array(1=>'Оружие: кастеты,ножи',
		2=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;топоры',
		3=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;дубины,булавы',
		4=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;мечи',
		5=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;магические посохи',
		6=>'Одежда: сапоги',
		7=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;перчатки',
		8=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;рубахи',
		28=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;плащи',
		9=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;легкая броня',
		10=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;тяжелая броня',
		11=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;шлемы',
		12=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;наручи',
		13=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;пояса',
		14=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;поножи',
		28=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Плащи и накидки',
		15=>'Щиты',
		16=>'Ювелирные товары: серьги',
		17=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ожерелья',
		18=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;кольца',
		19=>'Заклинания: нейтральные',
		20=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;боевые и защитные',
		50=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;исцеляющие',
		29=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;манящие',
		30=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;тактические',
		31=>'Руны',
		32=>'Чарки',
		21=>'Амуниция',
		22=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;эликсиры',
		33=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;еда',
		25=>'Сувениры: открытки',
		23=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;подарки',
		24=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;недобрые',
		26=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;упаковка',
		27=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;фейерверки',
		34=>'Чеки');*/
echo "<h3 style='text-align: left;'>Сортировка вещей в разделах</h3>";
echo "<b>Выберите Магазин:</b></br>";
echo '<select id="magas">';
	foreach ($magas as $key => $value) {
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
echo '</select><br>';
echo "<b>Выберите раздел:</b></br>";
echo '<div id="berez" style=""><select id="razd">';
	foreach ($berez as $key => $value) {
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
echo '</select></div>';
echo '<div id="gosmag" style="display: none;"><select  id="gos">';
	foreach ($gosmag as $key => $value) {
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
echo '</select></div>';
echo '<div id="update">';
$it_shop = mysql_query('SELECT * FROM `items_shop` WHERE `sid`="2" AND `r` = "1" AND `kolvo` != 0 ORDER BY `level` ASC');
$coun = 1;
while ($svit_it = mysql_fetch_array($it_shop)) {
	$name = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$svit_it['item_id'].'"'));
	$stat = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$svit_it['item_id'].'"'));
	//if($stat['price_3'] != 0){
	echo "<div style='padding: 5px;'><b>".$coun.") ".$name['name']." (id = ".$name['id'].")</b></div>";
	echo "Уровень: <b>".$name['level']."</b><br>";
	echo "Цена кр. (price1-price_1): <b>".$name['price1']."-".$svit_it['price_1']."</b><br>";
	echo "Цена eкр. (price2-price_2): <b>".$name['price2']."-".$svit_it['price_2']."</b><br>";
	echo "Цена eкр. price_3: <b>".$svit_it['price_3']."</b><br><br>";
/*	foreach ($otdels_array as $key => $value) {
		$pos = strpos($key, $svit_it['r']);
		if ($pos === false) {
			$t = 0;
		}else{
			$t = $key;
			break;
		}
	}
	if($t != 0){
		echo $otdels_array[$t]."<br>";
	}else{
		echo $svit_it['r'].'<br>';
	}*/
	echo "<img src='http://img.likebk.com/i/items/".$name['img']."'>"."<br>";
	echo $stat['data']."<br>";
	echo "<div class='rows'><input class='form-control' type='text' name='".$svit_it['iid']."' value='".$svit_it['pos']."'></div>";
	echo "<br>";
	echo "<hr>";
	$coun++;
}?>
<input type='submit' value='Изменить' name='test' class='submit btn btn-default'>
<script type="text/javascript">

$('.submit').click(function(){
  var data = '';
  $('input').each(function(){
    data += this.name+'='+encodeURIComponent(this.value)+'&';
  });
  $.ajax({
    type: 'POST',
    url: '/bkadminlike/mod/updateShop/update.php',
    data: data,
    success: function(data) {
      alert(data);
      //$('#content').toggle();
    }
  });
});  
</script>
<?php echo '</div>';?>
<script type="text/javascript">
$("#magas").change(function(){
	var mag = $(this).val();
   	var razdel = $("select#razd").val();
   	if(mag == 1){
   		$('#gosmag').css('display', '');
   		$('#berez').css('display', 'none');
   		razdel = $("select#gos").val();
   	}else if(mag == 2){
   		$('#berez').css('display', '');
   		$('#gosmag').css('display', 'none');
   		razdel = $("select#razd").val();
   	}
   	$.ajax({
   		type: 'POST',
   		url: '/bkadminlike/mod/updateShop/ajax_item.php',
   		data: 'sid='+mag+'&r='+razdel,
   		success: function(data){
   			$('#update').html(data);
   		}
   	});
});
$("#razd").change(function(){
	var mag = $("select#magas").val();
   	var razdel = $(this).val();
   	$.ajax({
   		type: 'POST',
   		url: '/bkadminlike/mod/updateShop/ajax_item.php',
   		data: 'sid='+mag+'&r='+razdel,
   		success: function(data){
   			$('#update').html(data);
   		}
   	});
});
$("#gos").change(function(){
	var mag = $("select#magas").val();
   	var razdel = $(this).val();
   	$.ajax({
   		type: 'POST',
   		url: '/bkadminlike/mod/updateShop/ajax_item.php',
   		data: 'sid='+mag+'&r='+razdel,
   		success: function(data){
   			$('#update').html(data);
   		}
   	});
});
</script>