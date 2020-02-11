<?php
$dbgo = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
mysql_select_db('like_mainbd',$dbgo);
mysql_query('SET NAMES cp1251');

$it_shop = mysql_query('SELECT * FROM `items_shop` WHERE `sid`="'.$_POST['sid'].'" AND `r` = "'.$_POST['r'].'" AND `kolvo` != 0 ORDER BY `pos` ASC');
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
    url: '/bkadmin/mod/updateShop/update.php',
    data: data,
    success: function(data) {
      alert(data);
      //$('#content').toggle();
    }
  });
});  
</script>