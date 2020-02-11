    <script src="http://likebk.com/premium/js/jquery-1.8.2.min.js"></script> 
    <script src="http://likebk.com/premium/js/jquery.pricetable.min.js"></script>       
    <link href="http://likebk.com/premium/css/reset.css" rel="stylesheet" type="text/css">
    <link href="http://likebk.com/premium/css/pricetable.css" rel="stylesheet" type="text/css">
    <!-- <link href="http://likebk.com/premium/css/animate.css" rel="stylesheet" type="text/css">     -->
    <!-- <link href="http://likebk.com/css/bootstrap.css" rel="stylesheet" type="text/css">  -->
       
    <script type="text/javascript" charset="utf-8"> 
   $(document).ready(function() { 
    var pt = $('#priceTable1').priceTable();

    /* menu style chooser panel */
    $("#panel a.open").click(function(){
      var _left = $("#panel").css("margin-left");
      if (_left == "-210px"){
        $("#panel").stop(true, true).animate({marginLeft: "-10px"}, 300);
      }else{
        $("#panel").stop(true, true).animate({marginLeft: "-210px"}, 300);
      }
      return false;
    })

    $('select#yr1').change(function () { 
      var i = $(this).children(":selected").val();
      var price = 0;
      if(i == 1){
        price = 1.49;
      }else if(i == 2){
        price = 4.99;
      }
      $('.price1').text(price);
      //$(this).parent().parent().find('.button a').attr('data', i);
      //$(this).parent().parent().find('.button a').attr('data2', 1);
      $('#dta1 a').attr('data', i);
      //$('#dta1 a').attr('data2', 1);
    });     
    $('select#yr2').change(function () { 
      var i = $(this).children(":selected").val();
      var price = 0;
      if(i == 1){
        price = 2.99;
      }else if(i == 2){
        price = 9.99;
      }
      $('.price2').text(price);
      // $(this).parent().parent().find('.button a').attr('data', i);
      // $(this).parent().parent().find('.button a').attr('data2', 2);
      $('#dta2 a').attr('data', i);
      //$('#dta2 a').attr('data2', 2);
    });   
    $('select#yr3').change(function () { 
      var i = $(this).children(":selected").val();
      var price = 0;
      if(i == 1){
        price = 4.49;
      }else if(i == 2){
        price = 14.99;
      }
      $('.price3').text(price);
      // $(this).parent().parent().find('.button a').attr('data', i);
      // $(this).parent().parent().find('.button a').attr('data2', 3);
      $('#dta3 a').attr('data', i);
      //$('#dta1 a').attr('data2', 1);
    });   

    $('.button a').click(function(){
      var i = $(this).attr('data');
      var j = $(this).attr('data2');
      $.ajax({
        type: 'POST',
        url: 'premium/add.php',
        data: 'price='+i+'&type='+j,
        success: function(data){
            alert(data);
        }
      })
    });;
   });
    </script> 


  <style type="text/css" media="screen">
    #wrapper{              
      width: 1000px;     
      margin: 0 auto;
      margin-bottom: 40px;
    }   

    #panel {
      position: fixed;
      top: 100px;
      z-index: 1200;
    }
    #panelContainer {
      float: left;
      font-size: 12px;
      width: 170px;
      height: 140px;
      padding: 20px;
      color: #CCC;      
      background: #333;
    }
    .open{
      background: url(images/panelbutton.png) no-repeat 0 0 transparent;
      display: block;
      height: 180px;
      width: 34px;
      float: right;
      z-index: 999;
    }
    #panelContainer select{
      margin-bottom: 40px;
    }
    #panelContainer select, #panelContainer select:focus {
      width: 100%;
      padding: 3px;
      margin: 10px 0 15px 0;  
      font-size: 12px;
      border: none;
    }
    ul li.priceItem{
      width: 33%;
      min-width: 300px;
      font-size: 13px;
    }
    ul.priceTable li ul{
      background: url(premium/images/bg.png) repeat-x;
    }
    ul.priceTable li ul li.header{
      padding-bottom: 0px;
    }
    ul.priceTable li ul li{
      margin-bottom: 6px!important;
      padding: 0px 5px!important;
    }
    ul.priceTable li ul li.even{
      margin-bottom: 6px!important;
      padding: 0px 5px!important;
    }
    ul.priceTable li ul li.header{
      padding-top: 15px!important;
    }
    .form-control {
      margin-bottom: 5px;
      display: block;
      width: 50%;
      height: 24px;
      padding: 0px 5px;
      font-size: 12px;
      line-height: 1.42857143;
      color: #555555;
      background-color: #ffffff;
      background-image: none;
      border: 1px solid #cccccc;
      border-radius: 4px;
      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
      box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
      -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
      -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
      transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
    }
    .form-control:focus {
      border-color: #66afe9;
      outline: 0;
      -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
      box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(102, 175, 233, 0.6);
    }
    .form-control::-moz-placeholder {
      color: #999999;
      opacity: 1;
    }
    .form-control:-ms-input-placeholder {
      color: #999999;
    }
    .form-control::-webkit-input-placeholder {
      color: #999999;
    }
    .form-control::-ms-expand {
      border: 0;
      background-color: transparent;
    }
    .form-control[disabled],
    .form-control[readonly],
    fieldset[disabled] .form-control {
      background-color: #eeeeee;
      opacity: 1;
    }
    .form-control[disabled],
    fieldset[disabled] .form-control {
      cursor: not-allowed;
    }
    textarea.form-control {
      height: auto;
    }
    ul.priceTable li ul li.button{
      width: 50%!important;
      margin: 10px 21% 16px!important;
    }
  </style>

<div style="float: right; width: 210px;">
  <INPUT type='button' value='Обновить' onclick='location="main.php?premium=1"'>
  &nbsp;<INPUT TYPE=button value="Вернуться" onClick="location='main.php';">
</div>

<div id="wrapper">
  <h3 style='font-size: 24px; font-weight: bold; padding: 20px; padding-bottom: 30px; text-align: center;'>Премиум аккаунты</h3>
<ul class="priceTable greenStyle" id="priceTable1">
    <li class="priceItem">
    <ul>
      <li class="header" data-animate="flipInX"><img src="http://img.likebk.com/i/eff/bronze.png"> LikeBk Bronze </li>
      <li data-animate="flipInX">
        <center><select class="form-control" id="yr1">
          <option value="1">Неделя</option>
          <option value="2">1 месяц</option>
        </select>
        </center>
      </li>
      <li data-animate="flipInX"><span class="price price1">1.49</span> екр.</li>
      <li data-animate="flipInX">Скорость передвижения по подземельям: +10%</li>
      <li data-animate="flipInX">Скорость восстановления Здоровья: +50%</li>
      <li data-animate="flipInX">Скорость восстановления маны: +50%</li>
      <li data-animate="flipInX">Бонус к получаемому опыту: +25%</li>
      <li data-animate="flipInX">Защита от урона: +3%</li>
      <li data-animate="flipInX">Защита от магии: +3%</li>
      <li data-animate="flipInX">Мф. мощности урона: +3%</li>
      <li data-animate="flipInX">Мф. мощности магии стихий: +3%</li>
      <li data-animate="flipInX">Продажа вещей за 93% от стоимости</li>
      <li data-animate="flipInX">Продажа екр. вещей за 93% от стоимости</li>
      <li data-animate="flipInX" id="dta1" class="button"><a data="1" data2="1" href="#">Купить</a></li>      
    </ul>       
  </li>
  <li class="priceItem active">
    <ul>
      <li class="header" data-animate="flipInX"><img src="http://img.likebk.com/i/eff/silver.png"> LikeBk Silver </li>
      <li data-animate="flipInX">
        <center>
        <select class="form-control" id="yr2">
          <option value="1">Неделя</option>
          <option value="2">1 месяц</option>
        </select>
        </center>
      </li>
      <li data-animate="flipInX"><span class="price price2">2.99</span> екр.</li>
      <li data-animate="flipInX">Скорость передвижения по подземельям: +30%</li>
      <li data-animate="flipInX">Скорость восстановления Здоровья: +100%</li>
      <li data-animate="flipInX">Скорость восстановления маны: +100%</li>
      <li data-animate="flipInX">Бонус к получаемому опыту: +50%</li>
      <li data-animate="flipInX">Защита от урона: +5%</li>
      <li data-animate="flipInX">Защита от магии: +5%</li>
      <li data-animate="flipInX">Мф. мощности урона: +5%</li>
      <li data-animate="flipInX">Мф. мощности магии стихий: +5%</li>
      <li data-animate="flipInX">Продажа вещей за 95% от стоимости</li>
      <li data-animate="flipInX">Продажа екр. вещей за 95% от стоимости</li>
      <li data-animate="flipInX" id="dta2" class="button"><a data="1" data2="2" href="#">Купить</a></li>      
    </ul>       
  </li>
  <li class="priceItem">
    <ul>
      <li class="header" data-animate="flipInX"><img src="http://img.likebk.com/i/eff/gold.png"> LikeBk Gold </li>
      <li data-animate="flipInX">
        <center>
        <select class="form-control" id="yr3">
          <option value="1">Неделя</option>
          <option value="2">1 месяц</option>
        </select>
        </center>
      </li>
      <li data-animate="flipInX"><span class="price price3">4.49</span> екр.</li>
      <li data-animate="flipInX">Скорость передвижения по подземельям: +50%</li>
      <li data-animate="flipInX">Скорость восстановления Здоровья: +150%</li>
      <li data-animate="flipInX">Скорость восстановления маны: +150%</li>
      <li data-animate="flipInX">Бонус к получаемому опыту: +100%</li>
      <li data-animate="flipInX">Защита от урона: +10%</li>
      <li data-animate="flipInX">Защита от магии: +10%</li>
      <li data-animate="flipInX">Мф. мощности урона: +10%</li>
      <li data-animate="flipInX">Мф. мощности магии стихий: +10%</li>
      <li data-animate="flipInX">Продажа вещей за 100% от стоимости</li>
      <li data-animate="flipInX">Продажа екр. вещей за 100% от стоимости</li>
      <li data-animate="flipInX" id="dta3" class="button"><a data="1" data2="3" href="#">Купить</a></li>      
    </ul>       
  </li>
</ul>   
</div>

