<style>
.thumb {
    height: 75px;
    border: 1px solid #000;
    margin: 10px 5px 0 0;
}
</style>
<h3 style="text-align:left;">Добавление нового предмета:</h3>
  <p>
  <form id="newS">
    <b>Название предмета:</b><br/>
    <input class='form-control' style="width: 30%" id="name_sub" name="name" type="text" placeholder="Название предмета" />
    <br/><b>Цена в кр.:</b><br/>
    <input class='form-control' style="width: 20%" id="price" name="price1" type="text" placeholder="Цена предмета" />
    <br/><b>Цена в екр.:</b><br/>
    <input class='form-control' style="width: 20%" id="price" name="price2" type="text" placeholder="Цена предмета" />
    <!-- <input id="pric_check" type="checkbox" name="pric_check"/> <label>Цена в екр.</label> -->
    <br/><b>Долговечность:</b><br/>
    <input class='form-control' style="width: 30%" id="iznosMax_sub" name="iznosMAXi" type="text" placeholder="Долговечность предмета" />
    <br/><b>Описание:</b><br/>
    <input class='form-control' style="width: 30%" id="info_sub" name="info" type="text" placeholder="Описание предмета" />
    <br/><b>Уровень:</b><br/>
    <input class='form-control' style="width: 30%" id="level_sub" name="level" type="text" placeholder="Уровень предмета" />
    <br/><b>Масса:</b><br/>
    <input class='form-control' style="width: 30%" id="level_sub" name="massa" type="text" placeholder="Масса предмета" />
    <br/><b>Предмет:</b><br/>
    <select name="type">
        <option value="1">Шлема</option>
        <option value="3">наручи</option>
        <option value="18">Оружия: Кинжал</option>
        <option value="19">Оружия: Топор</option>
        <option value="20">Оружия: Дубина</option>
        <option value="21">Оружия: Меч</option>
        <option value="22">Оружия: Маг. Посох</option>
        <option value="5">Легкая броня</option>
        <option value="6">Тяжелая броня</option>
        <option value="8">пояса</option>
        <option value="9">серьг</option>
        <option value="10">ожерелья</option>
        <option value="11">кольца</option>
        <option value="12">перчаток</option>
        <option value="13">щита</option>
        <option value="14">понож</option>
        <option value="15">обуви</option>
        <option value="">рубахи</option>
        <option value="">плаща</option>
        <!-- <option value="0">Другое</option> -->
    </select>
    <br/><b>Слот для предмета:</b><br/>
    <select name="inslot">
        <option value="1">Слот для шлема</option>
        <option value="2">Слот для наручи</option>
        <option value="3">Слот для Оружия</option>
        <option value="5">Слот для брони</option>
        <option value="7">Слот для пояса</option>
        <option value="8">Слот для серьг</option>
        <option value="9">Слот для ожерелья</option>
        <option value="10">Слот для кольца</option>
        <option value="13">Слот для перчаток</option>
        <option value="14">Слот для щита</option>
        <option value="16">Слот для понож</option>
        <option value="17">Слот для обуви</option>
        <option value="4">Слот для рубахи</option>
        <option value="6">Слот для плаща</option>
        <!-- <option value="0">Другое</option> -->
    </select>
    <br><b>Второе оружие:</b><br/>
    <input class='form-control' style="width: 30%" id="2too" name="2too" type="text" placeholder="введите 1, если второе оружие" />
    <br><b>Двуручное:</b><br/>
    <input class='form-control' style="width: 30%" id="2too" name="2h" type="text" placeholder="введите 1, если двуручное" />
  </p>
  <input type="hidden" name="lvl_exp" value="600">
  <input type="hidden" name="lvl_aexp" value="100">
  <input type="hidden" name="lvl_itm" value="1">
  <input type="hidden" name="class" value="5">
  <input type="hidden" name="inRazdel" value="1">
</form>
<input class="add_s btn btn-default" style="font-size: 13px!important;" name="mainIt" type="submit" value="Сохранить"/>
<div id="block_img"></div>

<script>
//Кнопка сохранить
$('.add_s').click(function(){
    $.ajax({
        url: '/bkadminlike/mod/newSub/add_items_main.php',
        data: $('#newS').serialize(),
        type: 'POST',
        success: function (data) {
            //alert(data);
            $('#block_img').html(data);
        }
    });
});

//Изменение цены в екр
var price;
$("#pric_check").change(function(){
    if(this.checked) {  
        //price = 'price2='+parseFloat($('#price').val());
        $('#price').attr('name','price2');
    } else {
        //price = 'price1='+parseFloat($('#price').val());
        $('#price').attr('name','price1');
    }
});

</script>