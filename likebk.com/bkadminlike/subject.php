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
	if($_POST['psw']==$psw)	{
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
<title>Центр управления "bkadminlike"</title>
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
        <td>bkadminlike v0.0.0
        <? if($auth==true){
	$la = sys_getloadavg();
	$la[0]=$la[0]/4;
	$la[1]=$la[1]/4;
	$la[2]=$la[2]/4;
		?>
         / Время сервера: <?=date('H:i')?> ( <?=time()?> ) / <? 
		 	echo "Нагрузка: ".round($la[0]*100,2)."% ";
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
		?> / Онлайн: <?=$online?> / Нагрузка USI: <?=round((round($la[2]*100,2)/$online),2)?>%</td>
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
          <tr>
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
          </tr>
          <tr>
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">Персонажи</strong></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">Поиск персонажей</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">Работа с персонажем</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="?mod=online_bot">Работа с ботом</a></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td bgcolor="#C0C2C0"><div align="left" class="tblbr"><strong style="margin-left:10px;">Предметы</strong></div></td>
          </tr>
          <!--<tr>
            <td><div align="left"><a href="subject.php">Все предметы</a></div></td>
          </tr>-->          
          <tr>
            <td><div align="left"><a href="?mod=searchsubject">Поиск предмета</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">Работа с предметом</a></div></td>
          </tr>
          <tr>
            <td><div align="left"><a href="#">Предметы у персонажей</a></div></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
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
          </tr>
          <tr>
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
          </tr>
          <tr>
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
          </tr>
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
        <style>
.paginate {
font-family:Arial, Helvetica, sans-serif;
	padding: 3px;
	margin: 3px;
}

.paginate a {
	padding:2px 5px 2px 5px;
	margin:2px;
	border:1px solid #999;
	text-decoration:none;
	color: #666;
}
.paginate a:hover, .paginate a:active {
	border: 1px solid #999;
	color: #000;
}
.paginate span.current {
    margin: 2px;
	padding: 2px 5px 2px 5px;
		border: 1px solid #999;
		
		font-weight: bold;
		background-color: #999;
		color: #FFF;
	}
	.paginate span.disabled {
		padding:2px 5px 2px 5px;
		margin:2px;
		border:1px solid #eee;
		color:#DDD;
	}
	
	li{
		width: 100%;
		padding-bottom:100px;
        margin-top:  10px;
		list-style:none;
        line-height: 1.0;
        border: 1px solid #fff;
    }	
	ul{
	   margin:6px;
	   padding:0px;
    }
    .left_img{
        float: left;
        width: 10%;
    }	
    .right_inf{
        float: right;
        width: 90%;
    }
    .right_inf h3{
        padding-bottom: 5px;
        margin-bottom: 5px;
        text-align: left;
    }
    
	
</style>
<?php
	//include('connect.php');	

	$tableName="items_main";		
	$targetpage = "subject.php"; 	
	$limit = 100; 
	
	$query = "SELECT COUNT(*) as num FROM $tableName";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	$stages = 3;
	$page = mysql_escape_string($_GET['page']);
	if($page){
		$start = ($page - 1) * $limit; 
	}else{
		$start = 0;	
		}	
	
    // Get page data
	$query1 = "SELECT * FROM $tableName LIMIT $start, $limit";
	$result = mysql_query($query1);
	
	// Initial page num setup
	if ($page == 0){$page = 1;}
	$prev = $page - 1;	
	$next = $page + 1;							
	$lastpage = ceil($total_pages/$limit);		
	$LastPagem1 = $lastpage - 1;					
	
	
	$paginate = '';
	if($lastpage > 1)
	{	
	

	
	
		$paginate .= "<div class='paginate'>";
		// Previous
		if ($page > 1){
			$paginate.= "<a href='$targetpage?page=$prev'>previous</a>";
		}else{
			$paginate.= "<span class='disabled'>previous</span>";	}
			

		
		// Pages	
		if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page){
					$paginate.= "<span class='current'>$counter</span>";
				}else{
					$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}					
			}
		}
		elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
		{
			// Beginning only hide later pages
			if($page < 1 + ($stages * 2))		
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}					
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";		
			}
			// Middle hide some front and some back
			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
			{
				$paginate.= "<a href='$targetpage?page=1'>1</a>";
				$paginate.= "<a href='$targetpage?page=2'>2</a>";
				$paginate.= "...";
				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}					
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";		
			}
			// End only hide early pages
			else
			{
				$paginate.= "<a href='$targetpage?page=1'>1</a>";
				$paginate.= "<a href='$targetpage?page=2'>2</a>";
				$paginate.= "...";
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}					
				}
			}
		}
					
				// Next
		if ($page < $counter - 1){ 
			$paginate.= "<a href='$targetpage?page=$next'>next</a>";
		}else{
			$paginate.= "<span class='disabled'>next</span>";
			}
			
		$paginate.= "</div>";		
	
	
}
 echo $total_pages.' Results';
 // pagination
 echo $paginate;
?>

<ul>

<?php 
 

		while($row = mysql_fetch_array($result))
		{
		
		  echo '<li>';
          echo '<div class="left_img"><img src="http://img.likebk.com/i/items/'.$row['img'].'"></div>';
          echo "<div class='right_inf'><h3>".$row['name']."</h3>(id = ".$row['id']." )<br>".$row['info']."</div>";
          echo '</li>';
          echo '<div style="clear: both;">';
		
		}
	
	?>
</ul>
        
        
        </td>
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