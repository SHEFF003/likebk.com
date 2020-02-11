<?php 
$dbgo = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
mysql_select_db('like_mainbd',$dbgo);
mysql_query('SET NAMES cp1251');
/*$dbgo = mysql_connect('localhost','root','');
mysql_select_db('crazy',$dbgo);
mysql_query('SET NAMES cp1251');*/
$id_r = 0;
$price1 = $_POST['price1'];
$price2 = $_POST['price2'];
$str2 = iconv("UTF-8", "WINDOWS-1251", $_POST['name']);
if(isset($_POST['name']) && $_POST['name'] != ''){
	$res = '';
	$res2 = '';
	foreach( $_POST as $key => $value)
	{
	   if($value != ''){
        if($key == "name"){
          $res .= '`'.$key.'` = "'.mysql_real_escape_string($str2).'",';
        }elseif($key != "pric_check"){
    	    	$res .= '`'.$key.'` = "'.mysql_real_escape_string($value).'",';
    	    }
    	}
	}
	$res = trim($res, ',');
	//echo $res;
	$ins = mysql_query('INSERT INTO `items_main` SET '.$res.' ');		
	if($ins)
	{
		$id_r = mysql_insert_id();
		echo "<span style='font-size: 15px; color: red;'>Вы успешно добавили вещь (id = ".$id_r.")</span><br>";
	}else{
		echo "<span style='font-size: 15px; color: red;'>Ошибка в добавление!</span>";	
	}	
	/*mysql_query('UPDATE `items_main` SET `price1` = "'.$res2.'" WHERE `id` = '.$_GET['id'].' LIMIT 1');
	mysql_query('UPDATE `items_main_data` SET `data` = "'.$res.'" WHERE `items_id` = '.$_GET['id'].' LIMIT 1');*/
	
}
?>
<br>
  <b>Изображение предмета:</b><br/>
  <div id="fil_load">
        <input type="file" id="img" name="img" multiple />
  </div>
    <output id="list"></output>
  <p>
    <input class="add_img btn btn-default" style="font-size: 13px!important;" type="submit" value="Загрузить"/>
  </p>
<div id="block_shop"></div>

<script type="text/javascript">
$('.add_img').click(function(){
    var $input = $("#img");
    var fd = new FormData;
    var id = "<?php echo $id_r;?>";
    var price1 = "<?php echo $price1;?>";
    var price2 = "<?php echo $price2;?>";
    fd.append('filename', $input.prop('files')[0]);
    $.ajax({
        url: '/bkadmin/mod/searchSub/upload_img.php?id='+id+'&price1='+price1+'&price2='+price2,
        data: fd,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data) {
            //alert(data);
            $('#block_shop').html(data);
        }
    });
});

//Вывод загружаемого изображения
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          if($('#list').html() != ''){
            document.getElementById('list').remove();
            $('#fil_load').after('<output id="list"></output>');
          }
          var span = document.createElement('span');
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('img').addEventListener('change', handleFileSelect, false);

</script>