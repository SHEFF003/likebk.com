<?php 
define('GAME',true);
include_once('../_incl_data/__config.php');
include_once('../_incl_data/class/__db_connect.php');
include_once('../_incl_data/class/__user.php');
//print_r($_POST);


if(isset($_GET['success']) && $_GET['success'] == 1){
  echo "<font style='margin-left:10px;' color=Red><b>Вы успешно купили екр.</b></font>";
}elseif(isset($_GET['success']) && $_GET['success'] == 0){
  echo "<font style='margin-left:10px;' color=Red><b>Ошибка!!!</b></font>";
}
if(isset($_POST['login_new']) && $_POST['login_new'] != ''){
  $login_new = $_POST['login_new'];
  
  $login_new = trim($login_new);
  
	$login_new = str_replace('  ',' ',$login_new);
	$login_new = str_replace('  ',' ',$login_new);
	$login_new = str_replace('  ',' ',$login_new);
	$login_new = str_replace('  ',' ',$login_new);
	$login_new = str_replace('  ',' ',$login_new);
	$login_new = str_replace('  ',' ',$login_new);
	$login_new = str_replace('  ',' ',$login_new);
	$login_new = str_replace('  ',' ',$login_new);
	$login_new = str_replace('  ',' ',$login_new);
	$login_new = str_replace('  ',' ',$login_new);
	$login_new = str_replace('  ',' ',$login_new);
	$login_new = str_replace('  ',' ',$login_new);
	
  
  $nologin = array('ангел','angel','администрация','administration','Комментатор','Мироздатель','Мусорщик','Падальщик','Повелитель','Архивариус','Пересмешник','Волынщик','Лорд Разрушитель','Милосердие','Справедливость','Искушение','Вознесение');
  $sr = '_-йцукенгшщзхъфывапролджэячсмитьбюё1234567890';
  $simv =array('~','!','&','?','`','"\"', ';','#','№',',','.');
  foreach ($nologin as $key => $value) {
    $pos = strpos($value, $login_new);
    if ($pos === false) {
      $nologi = 0;
    }else{
      $nologi = 1;
      break;
    }
  }
  foreach ($simv as $key => $value) {
    $pos = strpos($login_new, $value);
    if ($pos === false) {
      $nosim = 0;
    }else{
      $nosim = 1;
      break;
    }
  }
  
  
  $okeysm = '- _qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890йцукенгшщзхъфывапролджэячсмитьбюёЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮЁ';
  $i = 0;
  while( $i != -1 ) {
	 if( isset($login_new[$i]) ) {
		 //
		 $pos = strpos($okeysm, $login_new[$i]);
		 if($pos == false) {
			 $nosim = 1;
		 }
		 //
	 }else{
		 $i = -2;
	 }
	 $i++; 
  }
  
  if($nologi == 1 && $u->info['admin'] == 0){
    echo '<font style="font-weight: bold;" color="red">Логин занят</font>';
  }else{
    //Логин от 2 до 20 символов
    if(strlen($login_new)>20) 
    { 
      echo '<font style="font-weight: bold;" color="red">Логин должен содержать не более 20 символов.</font>'; 
    }elseif(strlen($login_new)<2) 
    { 
      echo '<font style="font-weight: bold;" color="red">Логин должен содержать не менее 2 символов.</font>'; 
    }
    //Запрещенный символы
    elseif($nosim == 1)
    {
      echo '<font style="font-weight: bold;" color="red">Логин содержит запрещенные символы.</font>'; 
    }
    //Один алфавит
    /*elseif($er==true)
    {
      echo '<font style="font-weight: bold;" color="red">В логине разрешено использовать только буквы одного алфавита русского или английского. Нельзя смешивать.</font>';
    }*/
    elseif($login_new != ''){
      $user = mysql_query('SELECT * FROM `users`');
      while ($us = mysql_fetch_array($user)) {
        if($login_new ==  $us['login']){
          $t = 1;
          break;
        }else{
          $t = 0;
        }
      }
      $tstl = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `login` = "'.mysql_real_escape_string($login_new).'" LIMIT 1'));
	  $tstl2 = mysql_fetch_array(mysql_query('SELECT `id` FROM `users_safe` WHERE `login` = "'.mysql_real_escape_string($login_new).'" LIMIT 1'));
	  if(isset($tstl['id']) || isset($tstl2['id'])) {
		echo '<font color=red><b>Персонаж с таким логином уже есть! Выберите другой логин!</b></font>';
	  }elseif($t == 1){
        echo '<font style="font-weight: bold;" color="red">Логин занят</font>';
      }else{
        $money2 = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$u->info['id'].'"'));
        $sumlog = 4.99;
        if($money2['money2'] < $sumlog){
          echo '<font style="font-weight: bold;" color="red">У Вас недостаточно средств.</font>'; 
        }else{
          $sumlog = $money2['money2'] - $sumlog; 
          $login_star = $u->info['login'];
          $newl = mysql_query('UPDATE `users` SET `login` = "'.mysql_real_escape_string($login_new).'" WHERE `id` = "'.$u->info['id'].'" ');
          if($newl){
            echo '<font style="font-weight: bold;" color="green">Вы успешно сменили имя на '.$login_new.'.</font> <b> Через 5 сек. вы будете перенаправленны на страницу входа...';
            mysql_query('UPDATE `bank` SET `money2`= "'.mysql_real_escape_string($sumlog).'" WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
            $s = mysql_query('SELECT * FROM `items_users` WHERE `uid`="'.$u->info['id'].'"');
            while ($item = mysql_fetch_array($s)) {
                $stats = explode('|', $item['data']);
                $test = 'sudba='.$login_star;
                $rename = "";
                foreach ($stats as $key => $value) {
                  $pos = strpos($value, $login_star);
                  if ($pos === false) {
                    $rename .= $value."|";
                  }else{
                    $rename .= 'sudba='.$login_new."|";
                  }
                }
                $rename = trim($rename,'|');
                mysql_query('UPDATE `items_users` SET `data` = "'.$rename.'" WHERE `id` = "'.$item['id'].'" LIMIT 1');
                echo '<script>
                  setTimeout(\'top.location.href="/";\', 5000);
                </script>';
               // header( 'Refresh: 5; url=http://likebk.com/index.php');
              
            }
          }else{
            echo '<font style="font-weight: bold;" color="red">Смена имени прошла не удачно.</font>'; 
          }
        }
      }
    }
  }
}

$money2 = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$u->info['id'].'"'));
if(isset($_POST['ekr'])){
  $ekr = $_POST['ekr'];
  if($money2['money2'] >= $ekr){
    if(is_numeric($ekr)){
        if($ekr <= 50 && $ekr >= 0.01){
          $ekr = floor($ekr*100)/100;
          $kr = $ekr * 350;
          $mon2 = $money2['money2'] - $ekr; 
          mysql_query('UPDATE `bank` SET `money2`= "'.mysql_real_escape_string($mon2).'" WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
          $upd = mysql_query('UPDATE `users` SET `money` = `money` + "'.mysql_real_escape_string($kr).'" WHERE `id` = "'.$u->info['id'].'" ');
          if($upd){
            echo '<font color=Red><b>Вы успешно обменяли '.$ekr.' екр. на '.$kr.' кр.</b></font>';
            $u->addDelo(222,$u->info['id'],'Обмен '.$ekr.' екр. на '.$kr.' кр.',time(),$u->info['city'],'BillingExchange',$ekr,$kr);
          }
        }
        else{
          echo 'За 1 раз Вы можете обменять сумму от 0.01 до 50 ЕКР.';
        }
    }
    else{
      echo "<font color=Red><b>Введите коректные данные:</b></font>";
    }
  }else{
    echo '<font color=Red><b>У Вас недостаточно средств  на счете.</b></font>';
  }
}
if(isset($_POST['krExchang'])){
  $sum = 0;
  $kr = $_POST['krExchang'];
  if($u->info['money'] >= $kr){
    if(is_numeric($kr)){
      $deloUSer = mysql_query('SELECT * FROM `users_delo` WHERE `uid` = "'.$u->info['id'].'" AND `type` = "111" AND `login` = "BillingExchange"');
      while ($summoney = mysql_fetch_array($deloUSer)) {
        if(date('d.m.Y', time()) == date('d.m.Y',$summoney['time'])){
           $sum += $summoney['moneyOut'];
        }
      }
      if(($sum + $kr) <= 2000){
        if($kr <= 2000 && $kr > 0){
          $kr = floor($kr/10)*10;
          $ekr = $kr/1000;
          $mon2 = $money2['money2'] + $ekr; 
          mysql_query('UPDATE `users` SET `money` = `money` - "'.mysql_real_escape_string($kr).'" WHERE `id` = "'.$u->info['id'].'" ');
          $upd = mysql_query('UPDATE `bank` SET `money2`= "'.mysql_real_escape_string($mon2).'" WHERE `uid` = "'.$u->info['id'].'" LIMIT 1');
          if($upd){
            echo '<font color=Red><b>Вы успешно обменяли '.$kr.' кр. на '.$ekr.' eкр.</b></font>';
            $u->addDelo(111,$u->info['id'],'Обмен '.$kr.' кр. на '.$ekr.' eкр.',time(),$u->info['city'],'BillingExchange',$kr,$ekr);
          }
        }
        else{
          echo '<font color=Red><b>Вы можете обменять сумму не более 2000 кр.</b></font>';
        }
      }else{
        $e = 2000 - $sum;
        if($e != 0){
          echo "<font color=Red><b>В сутки Вы можете обменять максимум 2000 кр. Вы можете обменять ".$e." кр.</b></font>";
        }else{
          echo "<font color=Red><b>В сутки Вы можете обменять максимум 2000 кр.</b></font>";
        }
      }
    }else{
      echo "<font color=Red><b>Введите коректные данные:</b></font>";
    }
  }else{
      echo "<font color=Red><b>У Вас недостаточно средств на счете.</b></font>";
  }
}
function kursDolar(){
  $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req='.date('d/m/Y'));
  $kurs = $xml->Valute[9]->Value;
  $res = round(100/$kurs, 2);
  return $res;
}
?>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link href="http://likebk.com/css/bootstrap.css" rel="stylesheet" type="text/css">
<style type="text/css">
	h3{
		text-align: left;
		display: inline;
	}
  table td{
    padding-right: 5px;
  }
	.bl1{
		font-size: 15px;
		padding: 5px;
	}
	.bl1 span:first-child{
		color: #23527c;
	}
  #ekr, #krExchang, #buyEkr{
    width: 180px;
  }
  .btn2{
    margin-left: 10px!important;
    width: 150px!important;
  }
  fieldset legend{
    font-size: 15px;
  }
  .form-control{
    display: inline;
  }
  .btn{
    font-size: 12px!important;
    margin-left: 15px;
    width: 130px;
  }
  #sumKred, #sumKredit{
    width: 225px;
  }
  .tbl_kurs{
    color: #fff;
  }
  #tbl_kurs tr td{
    font-weight: bold;
  }
  fieldset{
    border: 1px solid white; 
    padding: 18px 12px 18px 12px;
    margin-top:15px;
  }
  /*.tbl_opt_bon{
    width: 100%;
    margin: auto;
  }*/
  .tbl_opt_bon, .tbl_nak_bon {
  font-family:Arial, Helvetica, sans-serif;
  color:#666;
  font-size:12px;
  text-shadow: 1px 1px 0px #fff;
  background:#E6F8C8;
  border:#ccc 1px solid;
  border-collapse:separate;
  width: 100%;
  -moz-border-radius:3px;
  -webkit-border-radius:3px;
  border-radius:3px;
  -moz-box-shadow: 0 1px 2px #d1d1d1;
  -webkit-box-shadow: 0 1px 2px #d1d1d1;
  box-shadow: 0 1px 2px #d1d1d1;
  box-shadow: 0 0 10px rgba(0,0,0,0.5); /* Параметры тени */
}
.tbl_opt_bon .b, .tbl_nak_bon .b{
  font-weight: bold;
}
.tbl_opt_bon tr, .tbl_nak_bon tr{
  text-align: center;
  padding-left:20px;
}
.tbl_opt_bon tr td:first-child, .tbl_nak_bon tr td:first-child{
  text-align: left;
  padding-left:20px;
  border-left: 0;
}
.tbl_opt_bon tr td, .tbl_nak_bon tr td {
  padding:5px;
  border-top: 1px solid #ffffff;
  border-bottom:1px solid #e0e0e0;
  border-left: 1px solid #e0e0e0;
  background: #DCEEBE;
  background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#DCEEBE));
  background: -moz-linear-gradient(top,  #fbfbfb,  #DCEEBE);
}
.tbl_opt_bon tr:nth-child(even) td, .tbl_nak_bon tr:nth-child(even) td{
  background: #f6f6f6;
  background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6));
  background: -moz-linear-gradient(top,  #f8f8f8,  #f6f6f6);
}
.tbl_opt_bon tr:first-child td, .tbl_nak_bon tr:first-child td{
  border-top: 0px solid #525252!important;
}
.tbl_opt_bon tr:nth-child(odd) td, .tbl_nak_bon tr:nth-child(odd) td{
  border-top: 1px solid #525252;
}
.tbl_opt_bon tr:last-child td, .tbl_nak_bon tr:last-child td{
  border-bottom:0;
}
.tbl_opt_bon tr:last-child td:first-child, .tbl_nak_bon tr:last-child td:first-child{
  -moz-border-radius-bottomleft:3px;
  -webkit-border-bottom-left-radius:3px;
  border-bottom-left-radius:3px;
}
.tbl_opt_bon tr:last-child td:last-child, .tbl_nak_bon tr:last-child td:last-child,{
  -moz-border-radius-bottomright:3px;
  -webkit-border-bottom-right-radius:3px;
  border-bottom-right-radius:3px;
}
.tbl_opt_bon tr:nth-child(2n):hover td, .tbl_nak_bon tr:nth-child(2n):hover td{
  background: #CDCDCD;
  background: -webkit-gradient(linear, left top, left bottom, from(#CDCDCD), to(#f0f0f0));
  background: -moz-linear-gradient(top,  #CDCDCD,  #f0f0f0);
}
.br{
  border-top: 2px solid #525252;
}
#tbl_glav{
  width:100%;
  min-width: 1000px;
}
.bl1 span{
  color: #003388;
  font-weight: bold;
}
</style>
<div style="float: right; width: 210px;">
  <INPUT type='button' value='Обновить' onclick='location="main.php?bill=1"'>
  &nbsp;<INPUT TYPE=button value="Вернуться" onClick="location='main.php';"></TD>
  </div>
<table id="tbl_glav" align="center">
  <tr>
    <td>
      <div class="bl1">
        <?php if(isset($_POST['ekr']) || isset($_POST['krExchang'])){
          $money2 = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$u->info['id'].'"'));
          $mon_us = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$u->info['id'].'"'));?>
          <h3>Ваш баланс счёта:</h3> <span><?php echo number_format($money2['money2'],2,',',' ');?> екр.</span> <h3>и</h3> <span><?php echo number_format($mon_us['money'],2,',',' ');?> кр.</span>
        <?php }else{?>
          <h3>Ваш баланс счёта:</h3> <span><?php echo number_format($money2['money2'],2,',',' ');?> екр.</span> <h3>и</h3> <span><?php echo number_format($u->info['money'],2,',',' ');?> кр.</span>
        <? } ?>
      </div>
    </td>
    <td>
      <div class="bl1">
        <h3>Ваш накопительный бонус:</h3> <span id="pr">0</span>% (<?php echo $money2['moneyBuy']?> екр.)
      </div>
    </td>
  </tr>
  <tr>
    <td width="50%">
      <fieldset>
        <legend style="font-weight:bold; color:#8F0000;">Покупка ЕКР</legend>
        <form method="post" id="ekrform" target="_blank" action="freekassa/likebk_payment.php" onsubmit="if(document.getElementById('ch_1').checked==false) {alert('Вы не согласились с пользовательским соглашением.');return false;} else {if(document.getElementById('ch_2').checked==false) {alert('Вы не согласились с условиями оплаты.');return false;};}; if(document.getElementById('buyEkr').value<0.1) {alert('Нельзя купить менее 0.1 ЕКР!');return false;};">
          <b>Сумма ЕКР:</b> 
          <input class="form-control" oninput="a=this.value.replace(/[^\d\.]+/g,'');this.value=a>10000?'':a" type="text" name="buyEkr" id="buyEkr" value="" size="8" placeholder="Введите сумму пополнения">
          <?php echo '<input type="hidden" name="id_user" value="'.$u->info['id'].'">
          <input type="hidden" name="login_user" value="'.$u->info['login'].'">
          <input type="hidden" name="inByekr" id="inByekr" value="">'; ?>
          <input type="submit" class="btn btn-success btn2" value="Пополнить баланс"><br>
          <div style="padding-bottom: 3px;">
            <font style="font-size: 14px; font-weight: bold;" color="red">При первом пополнении бонус 20% к купленным ЕКР</font>
          </div>
          <table width="100%" border="1">
              <tr>
                <td width="30%" style="padding-left:10px;">
                  <table id="tbl_kurs" border="0">
                    <tbody>
                      <tr>
                        <td colspan="2"><b>Текущий курс: </b></td>
                      </tr>
                      <tr>
                        <td>1 ЕКР=</td>
                        <td>100 руб.</td>
                      </tr>
                    </tbody>
                  </table>
                </td>
                <td width="50%" style="padding-left:10px;">
                  <div id="calc" style="font-weight: bold; width: 100%; margin-top: 10px; margin-bottom: 10px;">
                    Накопительный бонус: <font color="#003388">0 ЕКР</font><br>
                    Оптовый бонус: <font color="#003388">0 ЕКР</font><br>
                    Итого: <font color="#003388">0 ЕКР</font>
                  </div>
                </td>
              </tr>
          </table>
          <small>
          * - зависит от текущих курсов валют<br>
          Доставка игровой валюты производится в автоматическом режиме, сразу же  после оплаты!
          </small>
          <br>
        </form>
        <small style="display: block;padding-top: 8px;">
        <label><input type="checkbox" name="ch1" id="ch_1"> Внимание! При пополнении баланса вы соглашаетесь с соглашением<!--  <a href="" target="_blank">соглашением о предоставлении сервиса игры «Легендарный Бойцовский Клуб»</a> -->.</label>        
        <br>
        <label><input type="checkbox" name="ch2" id="ch_2"> Все комиссии платёжных систем Вы оплачиваете за свой счёт.</label>
        <div style="margin-top: 8px; color: #003388;"><b>Пополняя свой игровой счёт, Вы тем самым спонсируете проект. ВСЕ ваши вложенные деньги в игру будут идти ТОЛЬКО на её же развитие.</b></div>
        </small>
      </fieldset> 
      <br>
      <fieldset>
        <legend style="font-weight:bold; color:#8F0000;">Обмен</legend>
          <form method="post" onsubmit="if(document.getElementById('ekr').value<0.01||document.getElementById('ekr').value>50) {alert('За 1 раз Вы можете обменять сумму от 0.01 до 50 ЕКР.');return false;} else {return confirm('Вы действительно хотите обменять '+document.getElementById('ekr').value+' ЕКР на '+(document.getElementById('ekr').value*350)+' КР ? В обратном направлении обмен с КР на ЕКР будет невозможен.');};">
            Обменять ЕКР на КР по курсу <b>1ЕКР=350КР</b>: <br>
            <input class="form-control"  oninput="a=this.value.replace(/[^\d\.]+/g,'');this.value=a>50?'':a" type="text" name="ekr" id="ekr" value="" size="5" placeholder="Введите екр. от 0.1 до 50">
            <input type="submit" class="btn-xs btn btn-success" name="submit" id="sumKred" value="Обменять 0 ЕКР на 0 КР"><br>
          </form>
        
          <form method="post" onsubmit="if(document.getElementById('krExchang').value<10||document.getElementById('krExchang').value>2000) {alert('За сутки Вы можете обменять сумму не более 2000 КР');return false;} else {return confirm('Вы действительно хотите обменять '+document.getElementById('krExchang').value+' КР на '+(Math.round(document.getElementById('krExchang').value/10)/100)+' ЕКР? Отменить операцию обмена будет невозможно.');};">
            Обменять КР на ЕКР по курсу <b>1000КР=1ЕКР</b>:  <br>
            <input class="form-control" oninput="a=this.value.replace(/[^\d]+/g,'');this.value=a>2000?'':a" type="text" style="margin-left:1px;" name="krExchang" id="krExchang" value="" placeholder="Введите кр. от 10 до 2000" size="5">
            <input type="submit" class="btn-xs btn btn-success" name="submit" id="sumKredit" value="Обменять 0 КР на 0 ЕКР">
          </form>
      </fieldset>     
      <br>
    </td>
    <td width="50%">
      <fieldset>
        <legend style="font-weight:bold; color:#8F0000;">Оптовые бонусы</legend>
        <? $cnsd = ''; if( $c['ekrbonus'] > 0 ) { $cnsd = '<span style="color: red;"> +'.$c['ekrbonus'].'%!</span>'; ?>
        <div style="margin: 10px 0px 15px; color: red">В честь праздников мы увеличиваем оптовый бонус на пополнение ЕКР на <?=$c['ekrbonus']?>%!</div>
        <? } ?>
        <table class="tbl_opt_bon">
          <tbody>
            <tr class="b br">
              <td>Бонус</td>
              <td>1%<?=$cnsd?></td>
              <td>2%<?=$cnsd?></td>
              <td>3%<?=$cnsd?></td>
              <td>4%<?=$cnsd?></td>
              <td>5%<?=$cnsd?></td>
              <!-- <td>1%<span style="color: red;"> +10%!</span></td>
              <td>2%<span style="color: red;"> +10%!</span></td>
              <td>3%<span style="color: red;"> +10%!</span></td>
              <td>4%<span style="color: red;"> +10%!</span></td>
              <td>5%<span style="color: red;"> +10%!</span></td> -->
            </tr>
            <tr>
              <td class="b">Сумма</td>
              <td>10 ЕКР</td>
              <td>20 ЕКР</td>
              <td>30 ЕКР</td>
              <td>40 ЕКР</td>
              <td>50 ЕКР</td>
            </tr>
            <tr class="b br">
              <td class="b">Бонус</td>
              <td>6%<?=$cnsd?></td>
              <td>7%<?=$cnsd?></td>
              <td>8%<?=$cnsd?></td>
              <td>9%<?=$cnsd?></td>
              <td>10%<?=$cnsd?></td>
              <!-- <td>6%<span style="color: red;"> +10%!</span></td>
              <td>7%<span style="color: red;"> +10%!</span></td>
              <td>8%<span style="color: red;"> +10%!</span></td>
              <td>9%<span style="color: red;"> +10%!</span></td>
              <td>10%<span style="color: red;"> +10%!</span></td> -->
            </tr>
            <tr>
              <td class="b">Сумма</td>
              <td>60 ЕКР</td>
              <td>70 ЕКР</td>
              <td>80 ЕКР</td>
              <td>90 ЕКР</td>
              <td>100 ЕКР</td>
            </tr>
          </tbody>
        </table>
      </fieldset>
      <fieldset>
        <legend style="font-weight:bold; color:#8F0000;">Накопительные бонусы</legend>
        <table class="tbl_nak_bon">
          <tbody>
            <tr class="b br">
              <td>Бонус</td>
              <td>1%</td>
              <td>2%</td>
              <td>3%</td>
              <td>4%</td>
              <td>5%</td>
            </tr>
            <tr>
              <td class="b">Сумма</td>
              <td>10 ЕКР</td>
              <td>50 ЕКР</td>
              <td>100 ЕКР</td>
              <td>200 ЕКР</td>
              <td>300 ЕКР</td>
            </tr>
            <tr class="b br">
              <td class="b">Бонус</td>
              <td>6%</td>
              <td>7%</td>
              <td>8%</td>
              <td>9%</td>
              <td>10%</td>
            </tr>
            <tr>
              <td class="b">Сумма</td>
              <td>400 ЕКР</td>
              <td>500 ЕКР</td>
              <td>600 ЕКР</td>
              <td>700 ЕКР</td>
              <td>800 ЕКР</td>
            </tr>
            <tr class="b br">
              <td>Бонус</td>
              <td>11%</td>
              <td>13%</td>
              <td>15%</td>
              <td>17%</td>
              <td>19%</td>
            </tr>
            <tr>
              <td class="b">Сумма</td>
              <td>900 ЕКР</td>
              <td>1 000 ЕКР<img src="http://img.likebk.com/vip.gif"></td>
              <td>1 100 ЕКР<img src="http://img.likebk.com/vip.gif"></td>
              <td>1 200 ЕКР<img src="http://img.likebk.com/vip.gif"></td>
              <td>1 300 ЕКР<img src="http://img.likebk.com/vip.gif"></td>
            </tr>
            <tr class="b br">
              <td class="b">Бонус</td>
              <td>21%</td>
              <td>23%</td>
              <td>25%</td>
              <td>27%</td>
              <td>30%</td>
            </tr>
            <tr>
              <td class="b">Сумма</td>
              <td>1 500 ЕКР<img src="http://img.likebk.com/vip.gif"></td>
              <td>1 700 ЕКР<img src="http://img.likebk.com/vip.gif"></td>
              <td>2 000 ЕКР<img src="http://img.likebk.com/vip.gif"></td>
              <td>2 500 ЕКР<img src="http://img.likebk.com/vip.gif"></td>
              <td>3 000 ЕКР<img src="http://img.likebk.com/vip2.gif"></td>
            </tr>
          </tbody>
        </table>
        <!-- <table class="tbl_nak_bon">
          <table>
            <tbody>
              <tr class="b">
                <td>ЕКР</td>
                <td>Бонус</td>
                <td>ЕКР</td>
                <td>Бонус</td>
              </tr>
            <tr>
              <td>800 ЕКР</td>
              <td>10%</td>
              <td>3 000 ЕКР</td>
              <td>30%</td>
            </tr>
            <tr>
              <td>700 ЕКР</td>
              <td>9%</td>
              <td>2 500 ЕКР</td>
              <td>27%</td>
            </tr>
            <tr>
              <td>600 ЕКР</td>
              <td>8%</td>
              <td>2 000 ЕКР</td>
              <td>25%</td>
            </tr>
            <tr>
              <td>500 ЕКР</td>
              <td>7%</td>
              <td>1 700 ЕКР</td>
              <td>23%</td>
            </tr>
            <tr>
              <td>400 ЕКР</td>
              <td>6%</td>
              <td>1 500 ЕКР</td>
              <td>21%</td>
            </tr>
            <tr>
              <td>300 ЕКР</td>
              <td>5%</td>
              <td>1 300 ЕКР</td>
              <td>19%</td>
            </tr>
            <tr>
              <td>200 ЕКР</td>
              <td>4%</td>
              <td>1 200 ЕКР</td>
              <td>17%</td>
            </tr>
            <tr>
              <td>100 ЕКР</td>
              <td>3%</td>
              <td>1 100 ЕКР</td>
              <td>15%</td>
            </tr>
            <tr>
              <td>50 ЕКР</td>
              <td>2%</td>
              <td>1 000 ЕКР</td>
              <td>13%</td>
            </tr>
            <tr>
              <td>10 ЕКР</td>
              <td>1%</td>
              <td>900 ЕКР</td>
              <td>11%</td>
            </tr>
          </tbody>
        </table> -->
      </fieldset>
    </td>
  </tr>
  <?
  $tfi1 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `free_buy` WHERE `type` = 1 AND `uid` = "'.$u->info['id'].'" LIMIT 1')); //подарки
  $tfi1 = $tfi1[0];
  $tfi2 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `free_buy` WHERE `type` = 2 AND `uid` = "'.$u->info['id'].'" LIMIT 1')); //смайл
  $tfi2 = $tfi2[0];
  ?>
   <tr>
    <td>
      <fieldset>
        <legend style="font-weight:bold; color:#8F0000;">Покупка личного подарка</legend>
        <small>
        <? if( $tfi1 > 0 ) { echo '<b>Стоимость услуги: <b><small><font color=green>'.$tfi1.' шт. бесплатно</font></small></b><br>'; }else{ ?>
        <b>Стоимость услуги: 2.99 ЕКР</b><br>
        <? } ?>
        Требования к персональному подарку:<br>
        GIF-картинка размером 60х60 (ШхВ) и весом до 300 Кб.<br>
        <br>
        Выберите картинку:
        <form action="" method="post" enctype="multipart/form-data" name="form101" id="form101">
        <input class="form-control" style="display: inline-block; padding: 0px; width: 225px!important; height: 18px;" type="file" name="giftimg" id="giftimg"  multiple />
        <input class="add_gift btn btn-default" style="font-size: 13px!important;" type="submit" value="Загрузить"/>
        <div id="fil_load"></div>
        <output id="list"></output>
        </small>
        </form>
        <font style="font-size: 11px;" color=Red><b>Внимание!</b> Подарок можно отправить 10 раз!</font><Br>
        <font style="font-size: 11px;" color=Red>В случае отказа (по любой причине) возвращается 90% от стоимости.</font>
        <font style="font-size: 11px;" color=Red><b>Название картинки для загрузки должно быть на английском языке!</b></font>
    </fieldset>
    </td>
    <td>
      <fieldset>
        <legend style="font-weight:bold; color:#8F0000;">Покупка личного смайлика</legend>
        <small>
        <? if( $tfi2 > 0 ) { echo '<b>Стоимость услуги: <b><small><font color=green>'.$tfi2.' шт. бесплатно</font></small></b><br>'; }else{ ?>
        <b>Стоимость услуги: 4.99 ЕКР</b><br>
        <? } ?>
        Требования к персональному смайлику:<br>
        GIF-картинка минимальным размером 16x16 (ШхВ) и максимальным размером 90х50 (ШхВ) , и весом до 300 Кб.<br>
        <br>
        Выберите картинку:
        <form action="" method="post" enctype="multipart/form-data" name="form102" id="form102">
        <input class="form-control" style="display: inline-block; padding: 0px; width: 225px!important; height: 18px;" type="file" name="smileimg" id="smileimg"  multiple />
        <input class="add_smile btn btn-default" style="font-size: 13px!important;" type="submit" value="Загрузить"/>
        <div id="fil_load"></div>
        <output id="list"></output>
        </small>
        </form>
        <font style="font-size: 11px;" color=Red>В случае отказа (по любой причине) возвращается 90% от стоимости.</font>
        <font style="font-size: 11px;" color=Red><b>Название картинки для загрузки должно быть на английском языке!</b></font>
    </fieldset>
    </td>
  </tr>
  
  <tr>
    <td>
      <fieldset>
        <legend style="font-weight:bold; color:#8F0000;">Покупка личного образа</legend>
        <small>
        <b>Стоимость услуги: 9.99 ЕКР</b><br>
        Требования к персональному образу:<br>
        GIF-картинка размером 120x220 (ШхВ) и весом до 300 Кб.<br>
        <br>
        Выберите картинку:
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <input class="form-control" style="display: inline-block; padding: 0px; width: 225px!important; height: 18px;" type="file" name="obrazimg" id="obrazimg"  multiple />
        <input class="add_obraz btn btn-default" style="font-size: 13px!important;" type="submit" value="Загрузить"/>
        <div id="fil_load"></div>
        <output id="list"></output>
        </small>
        </form>
        <font style="font-size: 11px;" color=Red>В случае отказа (по любой причине) возвращается 90% от стоимости.</font>
        <font style="font-size: 11px;" color=Red><b>Название картинки для загрузки должно быть на английском языке!</b></font>
    </fieldset>
    </td>
    <td>
      <fieldset>
        <legend style="font-weight:bold; color:#8F0000;">Покупка кланового образа</legend>
        <small>
        <b>Стоимость услуги: 24.99 ЕКР</b><br>
        Требования к персональному образу:<br>
        GIF-картинка размером 120x220 (ШхВ) и весом до 300 Кб.<br>
        <br>
        Выберите картинку:
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <input class="form-control" style="display: inline-block; padding: 0px; width: 225px!important; height: 18px;" type="file" name="obraz_clanimg" id="obraz_clanimg"  multiple />
        <input class="add_clan_obraz btn btn-default" style="font-size: 13px!important;" type="submit" value="Загрузить"/>
        <div id="fil_load"></div>
        <output id="list"></output>
        </small>
        </form>
        <font style="font-size: 11px;" color=Red>В случае отказа (по любой причине) возвращается 90% от стоимости.</font>
        <font style="font-size: 11px;" color=Red><b>Название картинки для загрузки должно быть на английском языке!</b></font>
    </fieldset>
    </td>
  </tr>
  <tr>
    <td>
      <fieldset style="border: 1px solid white; padding: 10px;margin-top:15px;">
        <legend style="font-weight:bold; color:#8F0000;">Смена имени персонажа</legend>
        <small>
            <b>Стоимость услуги: 4.99 ЕКР</b><br>
            Текущее имя: <?php echo $u->info['login']?><br>
            <form method="post" action="" id="form_log">
              <div style="width: 40%; display: inline-block;">
                <input class="form-control" style="width: 100%;" type="text" name="login_new" id="login_new" onkeyup="check_login();" size="35" placeholder="Введите новое имя.." style="margin: 5px 0 5px 0;"> 
              </div>
              <span id="msg_login" style="width: 57%; display: inline-block; float: right;">
              </span><br>
              <input type="button" class="changeLog btn btn-success" value="Сменить имя" onclick="if(confirm('Действительно хотите сменить имя?')) $('#form_log').submit();">
            </form>
        <script>
        function check_login() {
          $("#msg_login").html('<b>Проверка доступности...</b>');
          $.ajax({
            url: "./jx/biling/check_login.php?login_new="+$('#login_new').val(),
            cache: false
            }).done(function( html ) {
              
              $("#msg_login").html(html);
              });
          }

        </script>
        </small>
      </fieldset>
    </td>
    <td>
        <fieldset>
          <legend style="font-weight:bold; color:#8F0000;">Покупка образа животного</legend>
          <small>
          <b>Стоимость услуги: 4.99 ЕКР</b><br>
          Требования к образу животного:<br>
          GIF-картинка размером 120x40 (ШхВ) и весом до 100 Кб.<br>
          <br>
          Выберите картинку:
          <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
          <input class="form-control" style="display: inline-block; padding: 0px; width: 225px!important; height: 18px;" type="file" name="obrazanimal" id="obrazanimal"  multiple />
          <input class="add_obraz_animal btn btn-default" style="font-size: 13px!important;" type="submit" value="Загрузить"/>
          <div id="fil_load"></div>
          <output id="list"></output>
          </small>
          </form>
          <font style="font-size: 11px;" color=Red>В случае отказа (по любой причине) возвращается 90% от стоимости.</font>
          <font style="font-size: 11px;" color=Red><b>Название картинки для загрузки должно быть на английском языке!</b></font>
        </fieldset>
    </td>
  </tr>
</table>
<br>

<script type="text/javascript">
  //Кнопка сохранить
  $('.add_gift').click(function(){
      var input = $("#giftimg");
      var id = "<?php echo $u->info['id']?>";
      var fd = new FormData;
      fd.append('filename', input.prop('files')[0]);
      $.ajax({
          url: './jx/biling/upload_img2.php?id='+id+'&type=1',
          data: fd,
          processData: false,
          contentType: false,
          type: 'POST',
          success: function (data) {
              alert(data);
          }
      });
  });
  //Кнопка сохранить
  $('.add_smile').click(function(){
      var input = $("#smileimg");
      var id = "<?php echo $u->info['id']?>";
      var fd = new FormData;
      fd.append('filename', input.prop('files')[0]);
      $.ajax({
          url: './jx/biling/upload_img3.php?id='+id+'&type=1',
          data: fd,
          processData: false,
          contentType: false,
          type: 'POST',
          success: function (data) {
              alert(data);
          }
      });
  });
  //Кнопка сохранить
  $('.add_obraz').click(function(){
      var input = $("#obrazimg");
      var id = "<?php echo $u->info['id']?>";
      var fd = new FormData;
      fd.append('filename', input.prop('files')[0]);
      $.ajax({
          url: './jx/biling/upload_img.php?id='+id+'&type=1',
          data: fd,
          processData: false,
          contentType: false,
          type: 'POST',
          success: function (data) {
              alert(data);
          }
      });
  });
  //Кнопка сохранить
  $('.add_clan_obraz').click(function(){
      var input = $("#obraz_clanimg");
      var id = "<?php echo $u->info['id']?>";
      var fd = new FormData;
      fd.append('filename', input.prop('files')[0]);
      $.ajax({
          url: './jx/biling/upload_img.php?id='+id+'&type=2',
          data: fd,
          processData: false,
          contentType: false,
          type: 'POST',
          success: function (data) {
              alert(data);
          }
      });
  });
  $('.add_obraz_animal').click(function(){
      var input = $("#obrazanimal");
      var id = "<?php echo $u->info['id']?>";
      var fd = new FormData;
      fd.append('filename', input.prop('files')[0]);
      $.ajax({
          url: './jx/biling/upload_img.php?id='+id+'&type=3',
          data: fd,
          processData: false,
          contentType: false,
          type: 'POST',
          success: function (data) {
              alert(data);
          }
      });
  });
</script>


<script type="text/javascript">
  var nak = "<?php echo $money2['moneyBuy']?>";
  nak = Math.round(nak, 0);
  var nak_bonus = 0;
  //alert(nak);
  var bon = ["3000", "2500", "2000", "1700", "1500", "1300", "1200", "1100", "1000", "900", "800", "700", "600", "500", "400", "300", "200", "100", "50", "10"];
  var pro = ["30", "27", "25", "23", "21", "19", "17", "15", "13", "11", "10", "9", "8", "7", "6", "5", "4", "3", "2", "1"];
  var i = 0;
  while(i < 20){
    if(nak >= bon[i]){
       nak_bonus = pro[i];
      $("#pr").text(pro[i]);
      break;
    }
    i++;
  }
  //обмен екр на кр
  $('#ekr').keyup(function() {
      //var ekrEx = $(this).val();
      var ekrEx = $(this).val().match(/^-?(0|([1-9]\d*))(((\.\d+)?$)|(\.$))/);
      if (!ekrEx) {
        $(this).val('');
      }
      else{
        var ekrEx = $(this).val();
      }
      if(ekrEx==0) {
        ekrEx='';
      }
      ekrEx = Math.floor(ekrEx*100)/100;
      var kr = parseFloat(ekrEx) * 350;
    $("#sumKred").val('Обменять '+ekrEx+' ЕКР на '+kr+' КР');
  });
/*  $('.sumKred').click(function(){
    var ekrEx = $('#ekr').val();
    ekrEx = Math.floor(ekrEx*100)/100;
    $.ajax({
      type: 'post',
      url: '/jx/biling/ekrEx.php',
      success: function(){
        alert(data);
      }
    });
  })*/
  //Обмен кр на екр
  $('#krExchang').keyup(function() {
      //var krExchang = $(this).val();
      var krExchang = $(this).val().match(/^-?(0|([1-9]\d*))(((\.\d+)?$)|(\.$))/);
      if (!krExchang) {
        $(this).val('');
      }
      else{
        var krExchang = $(this).val();
      }
      if(krExchang==0) {
        krExchang='';
      }
      krExchang = Math.floor(krExchang/10)*10;
      var krExchangekr = krExchang/1000;
    $("#sumKredit").val('Обменять '+krExchang+' КР на '+krExchangekr+' ЕКР');
  });
  //покупка екр
   $('#buyEkr').keyup(function() {
        var buyEkr = $(this).val().match(/^-?(0|([1-9]\d*))(((\.\d+)?$)|(\.$))/);
        if (!buyEkr) {
          $(this).val('');
        }
        else{
          var buyEkr = $(this).val();
        }
        if(buyEkr==0) {
          buyEkr='';
        }
        buyEkr = Math.round(buyEkr*100)/100;
        

        if($(this).val()!=buyEkr) {
          $(this).val()=buyEkr;
        }
        var bon_nak = bonus_nak(buyEkr);    
        var bon_opt = bonus_optom(buyEkr);            
        bon_nak = Math.floor(bon_nak*100)/100;
        bon_opt = Math.floor(bon_opt*100)/100;
        var buyEkrr = parseFloat(buyEkr) + parseFloat(bon_nak) + parseFloat(bon_opt);
        //var buyEkrr = buyEkr + bon_nak + bon_opt;
        var moneBuy = <?php echo round($money2['moneyBuy'])?>;
        if( moneBuy == 0 ){
          buyEkrr += (buyEkrr*0.2);
        }

        buyEkrr = Math.round(buyEkrr*100)/100;

        $("#calc").html('Накопительный бонус: <font color=#003388>'+bon_nak+' ЕКР</font><br />Оптовый бонус: <font color=#003388>'+bon_opt+' ЕКР</font><br />Итого: <font color=#003388>'+buyEkrr+' ЕКР</font>');
        $('#inByekr').val(buyEkrr);
    });
   $('.buyEkr').click(function(){
      $.ajax({
        type: 'post',
        url: 'freekassa/likebk_payment.php',
        data: $('#ekrform').serialize(),
        success: function(data){
          alert(data);
        }
      })
   });
    function bonus_nak(a) { 
      var pr = 0;
      if(nak_bonus == 0){
        pr = 0;   
      }
      else{
        pr = nak_bonus;
      }
      return (Math.floor( (a*pr/100) *100)/100);
    };
    function bonus_optom(a) { 
      var bon = ["100", "90", "80", "70", "60", "50", "40", "30", "20", "10"];
      var pro = [10, 9, 8, 7, 6, 5, 4, 3, 2, 1];
      // var pro = ["20", "19", "18", "17", "16", "15", "14", "13", "12", "11"];
      var i = 0;
      var pr = 0;
      while(i < 10){
        if(a >= bon[i]){
           pr = pro[i];
          break;
        }
        i++;
      }
	  console.log(pr);
	  pr += <?=$c['ekrbonus']?>;
      return (Math.floor( (a*pr/100) *100)/100);
    };

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

  document.getElementById('obrazimg').addEventListener('change', handleFileSelect, false);


</script>