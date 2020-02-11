<?php
$dbgo = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
mysql_select_db('like_mainbd',$dbgo);
mysql_query('SET NAMES cp1251');
/*$dbgo = mysql_connect('localhost','root','');
mysql_select_db('crazy',$dbgo);
mysql_query('SET NAMES cp1251');*/
// вместо $_FILES.
$id_main = $_GET['id'];
$price1 = $_GET['price1'];
$price2 = $_GET['price2'];
if($_FILES){
    // $url = dirname($_SERVER['DOCUMENT_ROOT']);
    // $uploaddir = $url.'/img.'.$_SERVER['SERVER_NAME'].'/i/items';
    $uploaddir = '../../../../img.likebk.com/i/items';
    //@mkdir("uploads", 0777);
    $uploadfile = $uploaddir."/".basename($_FILES['filename']['name']);
    //echo $uploadfile;
    //print_r($_FILES);
    
    if($_FILES['filename']['type'] != "image/gif" && $_FILES['filename']['type'] != "image/png") {
       echo "Загружать можно только GIF изображения и png";
       exit;
    }
    else{
        if($_FILES["filename"]["size"] > 300000)
        {
            echo ("Размер файла превышает 20 кб");
            exit;
        }
        else{
           // Проверяем загружен ли файл
          if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
          {
             // Если файл загружен успешно, перемещаем его
             // из временной директории в конечную
            $name = $_FILES['filename']['name'];
             if(move_uploaded_file($_FILES["filename"]["tmp_name"], $uploadfile)){
                echo "<span style='font-size: 15px; color: red;'>Изображение успешно загружено</span>";
                mysql_query('UPDATE `items_main` SET `img` = "'.mysql_real_escape_string($name).'" WHERE `id` = '.$id_main.' LIMIT 1');
              }
           } else {
              echo("Ошибка загрузки изображения");
           }
       }
   }
}

?>
<p>
  <b>Добавить в магазин</b><br>
  <form id="shop_form"> 
    <b>Выберите предмета:</b><br/>
    <select name="sid">
    <option value="2">Березка</option>
        <option value="1">ГосМаг</option>
        
        <option value="777">Артефактный</option>
    </select>
    <br/><b>Отделы магазина:</b><br/>
    <select name="r">
        <option value="117">"Лесной дух"</option>
        <option value="116">"Огненный воин"</option>
        <option value="115">"Железный человек"</option>
        <option value="114">"Сумеречный воин"</option>
        <!-- <option value="117">"крит"</option> -->
        <option value="11">"Одежда: шлемы"</option>
        <option value="12">"Одежда: наручи"</option>
        <option value="1">"Оружие: кастеты,ножи"</option>
        <option value="2">"Оружие: топоры"</option>
        <option value="3">"Оружие: дубины,булавы"</option>
        <option value="4">"Оружие: мечи"</option>
        <option value="5">"Оружие: магические посохи"</option>
        <option value="9">"Одежда: легкая броня"</option>
        <option value="10">"Одежда: тяжелая броня"</option>
        <option value="13">"Одежда: пояса"</option>
        <option value="16">"Ювелирные товары: серьги"</option>
        <option value="17">"Ювелирные товары: ожерелья"</option>
        <option value="18">"Ювелирные товары: кольца"</option>
        <option value="7">"Одежда: перчатки"</option>
        <option value="15">"Щиты"</option>
        <option value="14">"Одежда: поножи"</option>
        <option value="6">"Одежда: сапоги"</option>
    </select>
    <input type="hidden" name="price_1" value="<?php echo $price1;?>">
    <input type="hidden" name="price_2" value="<?php echo $price2;?>">
    <!-- <br/><b>Цена в кр.:</b><br/>
    <input class='form-control' style="width: 20%" id="price" name="price_1" type="text" placeholder="Цена предмета в кр." />
    <br/><b>Цена в екр.:</b><br/>
    <input class='form-control' style="width: 20%" id="price" name="price_2" type="text" placeholder="Цена предмета в екр." /> -->
    <br/><b>Уровень:</b><br/>
    <input class='form-control' style="width: 30%" id="level_sub" name="level" type="text" placeholder="Уровень предмета" />
    <input type="hidden" name="real" value="1">
    <input type="hidden" name="kolvo" value="2000000000">
  </form>

    <input class="add_shop btn btn-default" style="font-size: 13px!important;" type="submit" value="Добавить"/>
</p>
<script type="text/javascript">
$('.add_shop').click(function(){
    var id = "<?php echo $id_main;?>";
    $.ajax({
        url: '/bkadmin/mod/newSub/add_items_shop.php?id='+id,
        data: $('#shop_form').serialize(),
        type: 'POST',
        success: function (data) {
            alert(data);
        }
    });
});
</script>