<?
$sd4 = 'admin';
$psw = md5('tip:'.$_SERVER['REMOTE_ADDR'].'t'.date('dh',time()).'t'.$sd4);
$psw = $psw[7].$psw[3].$psw[0].$psw[1].$psw[5];
$auth = false;

$_POST['psw'] = $psw;

if(isset($_COOKIE['pass3']) && $_COOKIE['pass3']==$psw){
  $auth = true;
}
if(isset($_GET['code'])){
  $tpsw = md5('tip:'.$_SERVER['REMOTE_ADDR'].'t'.$_GET['code'].'t'.$sd4);
  $tpsw = $tpsw[7].$tpsw[3].$tpsw[0].$tpsw[1].$tpsw[5];
  die($tpsw);
}elseif(isset($_POST['psw'])){
  if($_POST['psw']==$psw) {
    setcookie('pass3',$_POST['psw'],time()+36000);
    $_COOKIE['pass3'] = $_POST['psw'];
    $auth = true;
  }
}elseif(isset($_GET['exit'])){
  if($_COOKIE['pass3']==$psw){
    setcookie('pass3',false,time()-3600);
    unset($_COOKIE['pass3']);
    $auth = false;
  }
}
include_once('../_incl_data/__config.php');
define('GAME',true);
include_once('../_incl_data/class/__db_connect.php');
include_once('../_incl_data/class/__user.php');
if($u->info['admin']==0){
  die('<script>location="http://likebk.com/buttons.php";</script>');
}
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<meta http-equiv=Cache-Control Content=no-cache>
<meta http-equiv=PRAGMA content=NO-CACHE>
<meta http-equiv=Expires Content=0>
<title>Центр управления "LikeBK"</title>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <script src="http://likebk.com/js/logs/bootstrap.min.js" type="text/javascript"></script>
<link href="http://<?=$c['img']?>/css/main.css" rel="stylesheet" type="text/css">
<link href="http://likebk.com/js/logs/bootstrap.css" rel="stylesheet" type="text/css">
<style>
.tblbr2 {
  border-left:1px solid #AEAFAE;
  border-top:1px solid #AEAFAE;
  border-bottom:1px solid #EEEFEE;
  border-right:1px solid #EEEFEE;
}
.tblbr {
  border-left:1px solid #EEEFEE;
  border-top:1px solid #EEEFEE;
  border-bottom:1px solid #AEAFAE;
  border-right:1px solid #AEAFAE;
}
.стиль1 {border-left: 1px solid #AEAFAE; border-top: 1px solid #AEAFAE; border-bottom: 1px solid #EEEFEE; border-right: 1px solid #EEEFEE; font-size: 12px; }
.стиль2 {
  font-size: 12px;
  color: #999999;
}
.стиль5 {font-size: 12px}
.test a {
  font-weight: normal;  
}
</style>
</head>
<body style="padding-top:0px; margin-top:2px; background-color:#dedfde;">
<table class="tblbr" width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td class="стиль1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>"LikeBK"
        <? if($auth==true){
  $la = sys_getloadavg();
  $la[0]=$la[0]/4;
  $la[1]=$la[1]/4;
  $la[2]=$la[2]/4;
    ?>
         / Время сервера: <?=date('H:i')?> ( <?=time()?> ) / <? 
      echo "Нагрузка: ".round($la[0]*100,2)."% ";
      $load = sys_getloadavg();
  if ($la[1] < 0.16) {
    echo "<font color=green>низкая</font>";
  } elseif ($la[1] < 0.25) {
    echo "<font color=orange>средняя</font>";
  } elseif ($la[1] > 0.25) {
    echo "<font color=red>высокая</font>";
  }
     ?>
        <? }
    $online = 0;
    $sp = mysql_query('SELECT `id`,`room`,`city` FROM `users` WHERE `online` > ('.time().'-600)');
    while($pl = mysql_fetch_array($sp))
    {
      $online++;
    }
    ?> / Онлайн: <?=$online?> / Нагрузка USI: <?=round((round($la[2]*100,2)/$online),2)?>%
<?php echo '<br><b>Cредняя загрузка системы (число процессов в очереди системных процессов):</b> 1мин: '.$load[0].'% / 5мин: '.$load[1].'% / 15мин: '.$load[2].'%';?>
  </td>
        <td>&nbsp;</td>
        <td><? if($auth==true){ ?><div align="right"><a href="?exit=<?=$code?>">Выйти</a></div><? } ?></td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
    <td valign="top">
    <div align="center">
      <?
    if(!isset($_COOKIE['pass3']) || $_COOKIE['pass3']!=$psw){
  ?>
      <form action="../bkadminlike/index.php" method="post"><center><br><br>
        <span class="стиль5"><br>
        Для входа в панель требуется пароль</span>
        <hr>
        <span class="стиль5">Введите пароль: 
        <input value="" name="psw" type="password">
        <input type="submit" value="ок" />
        </span>
      </form>
</div>
    <?
  }else{
  ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" height="18" valign="top"><table class="test" width="100%" border="0" align="left" cellpadding="2" cellspacing="0">
          <!-- <tr>
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">Общие настройки</strong></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">Настройка сервера</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">Настройки модулей</a></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr> -->
           <tr>
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">Бои</strong></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=clear_user_battle">Вытащить из боя</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=clear_battle">Очистить бои в текущих</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=clear_bot_zv">Вытащить зависших ботов</a></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">Персонажи</strong></div></td>
          </tr>
          <tr>
            <td><div align="left"><a target="_blank" href="http://likebk.com/online.php?list_online">Онлайн</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=new_pers">Новые игроки</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=online_bot">Боты</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=referals">Рефералы</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=money_user">Банк</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=alhim">Пополнить счет Алхимика</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=recordAlh">Посмотреть продажи Алхимика</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=add_money">Пополнить кр.</a></div></td>
          </tr>
          <?php if($u->info['id']==155){?>
          <tr>
            <td><div align="left"><a href="?mod=add_money2">Пополнить екр.</a></div></td>
          </tr>
          <? }?>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">Предметы</strong></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=subject">Все предметы</a></div></td>
          </tr>          
          <tr>
            <td><div align="left"><a href="?mod=searchsubject">Поиск предмета</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=sortShop">Сортировка в магазинах</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=subjectprers">Добавление предметов</a></div></td>
          </tr> 
          <tr>
            <td>&nbsp;</td>
          </tr>
          <!-- <tr>
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">Локации</strong></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">Поиск локации</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">Работа с локацией</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">Добавить локацию</a></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr> -->
<!--           <tr>
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">Действия</strong></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">Проверить переводы</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">Проверить действия</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">Проверить чат</a></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr> -->
<!--           <tr>
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">Поединки</strong></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">Поиск поединка</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">Настройки баланса</a></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr> -->
          <tr>
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">Пещеры</strong></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=dungeon_list">Список пещер</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=dungeon&r=1">Редактор лабиринтов</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=dungeon_bots">Редактор ботов</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=dungeon_editor">Редактор пещер</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=dobj&r=1">Работа с обьектами</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">Создать пещеру</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">Работа с квестами</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">Создать квест</a></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table></td>
        <td valign="top" style="padding:10px;">
        <?
        if(isset($_GET['mod'])){
          if(file_exists('./mod/'.htmlspecialchars($_GET['mod'],NULL,'cp1251').'.php')){
            include('./mod/'.htmlspecialchars($_GET['mod'],NULL,'cp1251').'.php');
          }
                else{
            echo '<center>У вас нет доступа к данному разделу</center>';
          }
        }else{
          echo '<center>Выберите раздел</center>';
        }
    if(isset($_GET['lib'])){
      if(file_exists('./lib/'.htmlspecialchars($_GET['lib'],NULL,'cp1251').'.php')){
        include('./lib/'.htmlspecialchars($_GET['lib'],NULL,'cp1251').'.php');
      }
      else{
        echo '<center>У вас нет доступа к данному разделу</center>';
      }
    }
    ?></td>
      </tr>
    </table>    
    <?
    }
  ?></td>
  </tr>
  <tr>
    <td><div align="center" class="стиль2">Pluon, PluGameCMS © 2011-2012<BR>
    All rights reserved.</div></td>
  </tr>
</table>
</body>
</html>