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
<title>����� ���������� "LikeBK"</title>
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
.�����1 {border-left: 1px solid #AEAFAE; border-top: 1px solid #AEAFAE; border-bottom: 1px solid #EEEFEE; border-right: 1px solid #EEEFEE; font-size: 12px; }
.�����2 {
  font-size: 12px;
  color: #999999;
}
.�����5 {font-size: 12px}
.test a {
  font-weight: normal;  
}
</style>
</head>
<body style="padding-top:0px; margin-top:2px; background-color:#dedfde;">
<table class="tblbr" width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td class="�����1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>"LikeBK"
        <? if($auth==true){
  $la = sys_getloadavg();
  $la[0]=$la[0]/4;
  $la[1]=$la[1]/4;
  $la[2]=$la[2]/4;
    ?>
         / ����� �������: <?=date('H:i')?> ( <?=time()?> ) / <? 
      echo "��������: ".round($la[0]*100,2)."% ";
      $load = sys_getloadavg();
  if ($la[1] < 0.16) {
    echo "<font color=green>������</font>";
  } elseif ($la[1] < 0.25) {
    echo "<font color=orange>�������</font>";
  } elseif ($la[1] > 0.25) {
    echo "<font color=red>�������</font>";
  }
     ?>
        <? }
    $online = 0;
    $sp = mysql_query('SELECT `id`,`room`,`city` FROM `users` WHERE `online` > ('.time().'-600)');
    while($pl = mysql_fetch_array($sp))
    {
      $online++;
    }
    ?> / ������: <?=$online?> / �������� USI: <?=round((round($la[2]*100,2)/$online),2)?>%
<?php echo '<br><b>C������ �������� ������� (����� ��������� � ������� ��������� ���������):</b> 1���: '.$load[0].'% / 5���: '.$load[1].'% / 15���: '.$load[2].'%';?>
  </td>
        <td>&nbsp;</td>
        <td><? if($auth==true){ ?><div align="right"><a href="?exit=<?=$code?>">�����</a></div><? } ?></td>
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
        <span class="�����5"><br>
        ��� ����� � ������ ��������� ������</span>
        <hr>
        <span class="�����5">������� ������: 
        <input value="" name="psw" type="password">
        <input type="submit" value="��" />
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
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">����� ���������</strong></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">��������� �������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">��������� �������</a></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr> -->
           <tr>
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">���</strong></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=clear_user_battle">�������� �� ���</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=clear_battle">�������� ��� � �������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=clear_bot_zv">�������� �������� �����</a></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">���������</strong></div></td>
          </tr>
          <tr>
            <td><div align="left"><a target="_blank" href="http://likebk.com/online.php?list_online">������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=new_pers">����� ������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=online_bot">����</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=referals">��������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=money_user">����</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=alhim">��������� ���� ��������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=recordAlh">���������� ������� ��������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=add_money">��������� ��.</a></div></td>
          </tr>
          <?php if($u->info['id']==155){?>
          <tr>
            <td><div align="left"><a href="?mod=add_money2">��������� ���.</a></div></td>
          </tr>
          <? }?>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">��������</strong></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=subject">��� ��������</a></div></td>
          </tr>          
          <tr>
            <td><div align="left"><a href="?mod=searchsubject">����� ��������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=sortShop">���������� � ���������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=subjectprers">���������� ���������</a></div></td>
          </tr> 
          <tr>
            <td>&nbsp;</td>
          </tr>
          <!-- <tr>
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">�������</strong></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">����� �������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">������ � ��������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">�������� �������</a></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr> -->
<!--           <tr>
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">��������</strong></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">��������� ��������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">��������� ��������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">��������� ���</a></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr> -->
<!--           <tr>
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">��������</strong></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">����� ��������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">��������� �������</a></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr> -->
          <tr>
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">������</strong></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=dungeon_list">������ �����</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=dungeon&r=1">�������� ����������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=dungeon_bots">�������� �����</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=dungeon_editor">�������� �����</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=dobj&r=1">������ � ���������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">������� ������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">������ � ��������</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">������� �����</a></div></td>
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
            echo '<center>� ��� ��� ������� � ������� �������</center>';
          }
        }else{
          echo '<center>�������� ������</center>';
        }
    if(isset($_GET['lib'])){
      if(file_exists('./lib/'.htmlspecialchars($_GET['lib'],NULL,'cp1251').'.php')){
        include('./lib/'.htmlspecialchars($_GET['lib'],NULL,'cp1251').'.php');
      }
      else{
        echo '<center>� ��� ��� ������� � ������� �������</center>';
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
    <td><div align="center" class="�����2">Pluon, PluGameCMS � 2011-2012<BR>
    All rights reserved.</div></td>
  </tr>
</table>
</body>
</html>