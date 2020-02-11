<?

define('GAME',time());

//Подключение к базе данных
include('../_incl_data/class/__db_connect.php');

?>
<!doctype html>
<html>
<head>
<meta charset="windows-1251">
<title>Любимый Бойцовский Клуб &mdash; Заявки на бой</title>
<link href="http://img.likebk.com/css/main.css" rel="stylesheet" type="text/css">
<link href="http://likebk.com/battle/css/main.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://likebk.com/battle/js/main.js"></script>
</head>

<body onLoad="reflesh();" style="padding-top:0px; margin-top:7px; height:100%; background-color:#E2E0E0;">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%" align="left" valign="top">&nbsp;</td>
        <td align="right" valign="top">
        	<INPUT class="btnnew" style="padding-top:3px; padding-bottom: 3px;" TYPE=button value="Обновить" onClick="reflesh();">
            <INPUT class="btnnew" style="padding-top:3px; padding-bottom: 3px;" TYPE=button value="Вернуться" onClick="location.href='http://likebk.com/main.php?rnd=1';">
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
    <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td align="center" class="s"><b>Бои:</b></td>
        <td style="border-left:1px solid #fff;" width="16%" id="rz1" class="<? if($rz == 1) { echo 's'; }else{ echo 'm'; } ?>" align="center"><a href="javascript:getrazdel(1);">Бои с клоном</a></td>
        <td style="border-left:1px solid #fff;" width="16%" id="rz2" class="<? if($rz == 2) { echo 's'; }else{ echo 'm'; } ?>" align="center"><a href="javascript:getrazdel(2);">Физические</td>
        <td style="border-left:1px solid #fff;" width="16%" id="rz3" class="<? if($rz == 3) { echo 's'; }else{ echo 'm'; } ?>" align="center"><a href="javascript:getrazdel(3);">Хаотичные</td>
        <td style="border-left:1px solid #fff;" width="16%" id="rz4" class="<? if($rz == 4) { echo 's'; }else{ echo 'm'; } ?>" align="center"><a href="javascript:getrazdel(4);">Турниры</td>
        <td style="border-left:1px solid #fff;" width="16%" id="rz5" class="<? if($rz == 5) { echo 's'; }else{ echo 'm'; } ?>" align="center"><a href="javascript:getrazdel(5);">Текущие</td>
        <td style="border-left:1px solid #fff;" width="16%" id="rz6" class="<? if($rz == 6) { echo 's'; }else{ echo 'm'; } ?>" align="center"><a href="javascript:getrazdel(6);">Завершенные</td>
      </tr>
    </table>
    <div id="rzii1" style="display:none">
    	&nbsp;
    </div>
    <div id="rzii2" style="display:none">
    	&nbsp;
    </div>
	<div id="rzii3" style="display:none">
    	&nbsp;
    </div>
	<div id="rzii4" style="display:none">
    	&nbsp;
    </div>
    <div id="rzii5" style="display:none">
    	<table width="100%" border="0" cellspacing="0" cellpadding="3">
    	  <tr>
    	    <td class="m2" style="border-left:1px solid #ddd;">&nbsp;</td>
    	    <td class="s2" style="border-left:1px solid #ddd;">&nbsp;</td>
    	    <td class="m2" style="border-left:1px solid #ddd;">&nbsp;</td>
    	    <td class="m2" style="border-left:1px solid #ddd;">&nbsp;</td>
    	    <td class="m2" style="border-left:1px solid #ddd;">&nbsp;</td>
    	    <td class="m2" style="border-left:1px solid #ddd;">&nbsp;</td>
  	    </tr>
  	  </table>
    </div>
    <div id="rzii6" style="display:none">
    	&nbsp;
    </div>
    </td>
  </tr>
  <tr>
    <td>
    	<div id="maindata">
        
        </div>
    </td>
  </tr>
</table>
	
</body>
</html>