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
	
	$magas = array(2=>"�������",777=>"����������� �������",1=>"������");
	
	$berez = array(1=>'������: �������,����',
			2=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',
			3=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������,������',
			4=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����',
			5=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���������� ������',
			6=>'������: ������',
			7=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',
			8=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',
			9=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ �����',
			10=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������� �����',
			11=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����',
			12=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',
			13=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����',
			14=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',
			28=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����� � �������',
			15=>'����',
			16=>'��������� ������: ������',
			17=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',
			18=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',
			19=>'����������: �����������',
			20=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ � ��������',
			50=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����������',
			55=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�������',
			56=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����������',
			51=>'����',
			52=>'�����',
			53=>'�����',
			21=>'��������',
			36=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',
			37=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���',
			32=>'��������: ��������',
			29=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�������',
			33=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',
			34=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',
			35=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����������',
			54=>'����');

$gosmag = array(1=>'������: �������,����',
		2=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',
		3=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������,������',
		4=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����',
		5=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���������� ������',
		6=>'������: ������',
		7=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',
		8=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',
		9=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ �����',
		10=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������� �����',
		11=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����',
		12=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',
		13=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����',
		14=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',
		15=>'����',
		16=>'��������� ������: ������',
		17=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',
		18=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',
		19=>'����������: �����������',
		20=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ � ��������',
		50=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����������',
		55=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�������',
		21=>'��������',
		36=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',
		37=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���',
		32=>'��������: ��������',
		29=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�������');
/*
	$otdels_array = array(1=>'������: �������,����',
		2=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',
		3=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������,������',
		4=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����',
		5=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���������� ������',
		6=>'������: ������',
		7=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',
		8=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',
		28=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����',
		9=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ �����',
		10=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������� �����',
		11=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����',
		12=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',
		13=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����',
		14=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',
		28=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����� � �������',
		15=>'����',
		16=>'��������� ������: ������',
		17=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',
		18=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������',
		19=>'����������: �����������',
		20=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ � ��������',
		50=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����������',
		29=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�������',
		30=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����������',
		31=>'����',
		32=>'�����',
		21=>'��������',
		22=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',
		33=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���',
		25=>'��������: ��������',
		23=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�������',
		24=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',
		26=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��������',
		27=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����������',
		34=>'����');*/
echo "<h3 style='text-align: left;'>���������� ����� � ��������</h3>";
echo "<b>�������� �������:</b></br>";
echo '<select id="magas">';
	foreach ($magas as $key => $value) {
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
echo '</select><br>';
echo "<b>�������� ������:</b></br>";
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
	echo "�������: <b>".$name['level']."</b><br>";
	echo "���� ��. (price1-price_1): <b>".$name['price1']."-".$svit_it['price_1']."</b><br>";
	echo "���� e��. (price2-price_2): <b>".$name['price2']."-".$svit_it['price_2']."</b><br>";
	echo "���� e��. price_3: <b>".$svit_it['price_3']."</b><br><br>";
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
<input type='submit' value='��������' name='test' class='submit btn btn-default'>
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