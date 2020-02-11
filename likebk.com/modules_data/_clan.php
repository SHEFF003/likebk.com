<?
if(!defined('GAME')) { die(); }

$gral = false;


$gral = true;


//die('Ведутся работы в Клан-панели.');

$res = mysql_fetch_array(mysql_query("SELECT * FROM `clan` WHERE `id` = '".mysql_real_escape_string($u->info['clan'])."' LIMIT 1"));

if( $res['level'] < 10 ) {
	$gral = false;
}

if( $gral == false ) {
	unset($_GET['gral']);
}

if( $res['join1'] > 0 ) {
	$res['join1pl'] = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `clan` = "'.$res['id'].'" AND `time_start` > 0 AND `alians` = "'.$res['join1'].'" AND `type` = 1 LIMIT 1'));
}
if( $res['join2'] > 0 ) { 
	$res['join2pl'] = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `clan` = "'.$res['id'].'" AND `time_start` > 0 AND `alians` = "'.$res['join2'].'" AND `type` = 2 LIMIT 1'));
}

/*
$j00 = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `clan` = "'.$res['id'].'" LIMIT 1'));
if(isset($j00['id'])) {
	$res['join2'] = $j00['alians'];
}
*/

$cpr = explode('|', $u->info['clan_prava']);

if(!isset($res['id'])) {
  die('Клан был расформирован.');
}

if(!isset($_GET['ability']) && !isset($_GET['events']) && !isset($_GET['gral']) && !isset($_GET['diplom']) && !isset($_GET['control']) && !isset($_GET['deposit']) && !isset($_GET['titul']) && !isset($_GET['rules']) && !isset($_GET['info']) && !isset($_GET['members'])) {
  $_GET['events'] = 1;
}

//Возможности текущего титула
$tt = array(
	0	=>	array('000000000','Доступные каналы'),
	1	=>	array(0,'Просмотр событий клана'),
	2	=>	array(0,'Создание событий клана'),
	3	=>	array(0,'Просмотр хранилища'),
	4	=>	array(0,'Использование вещей из хранилища'),
	5	=>	array(0,'Изъятие предметов из хранилища'),
	6	=>	array(0,'Просмотр казны и списка игроков, пополнявших казну'),
	7	=>	array(0,'Пополнение казны'),
	8	=>	array(0,'Использование казны'),
	9	=>	array(0,'Прием в клан'),
	10	=>	array(0,'Изгнание из клана'),
	11	=>	array(0,'Редактирование информации о клане'),
	12	=>	array(0,'Клановые союзы и альянсы'),
	13	=>	array(0,'Управление клановыми союзами и альянсами'),
	14	=>	array(0,'Обьявление войны'),
	15	=>	array(0,'Использование клановых абилок'),
	16	=>	array(0,0),
	17	=>	array(0,0),
	18	=>	array(0,0),
	19	=>	array(0,0),
	20	=>	array(0,0),
	21	=>	array(0,0)
);

if($u->info['clan_prava'] != 'glava') {
  $utitl = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `id` = "'.$u->info['clan_prava'].'" LIMIT 1'));
  if(!isset($utitl['id'])) {
    $utitl = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `id` = 2 LIMIT 1'));
  }
} else {
  $utitl = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `id` = 1 LIMIT 1'));
}

if(isset($utitl['id'])) {
	$i = 1;
	while($i < count($tt)) {
		if($utitl['prava'][$i] > 0) {
			$tt[$i][0] = 1;
		}
		$i++;
	}
}

$u->info['tt'] = $tt;

//Уровень клана
$lvl_exp = array(
	0 => 0,
	1 => 500000,
	2 => 2000000,
	3 => 5500000,
	4 => 10500000,
	5 => 20500000,
	6 => 35500000,
	7 => 65500000,
	8 => 105500000,
	9 => 205500000,
	10 => 305500000,
	11 => 505500000,
	12 => 705500000,
	13 => 1000000000
);

if($res['exp'] >= $lvl_exp[$res['level']+1] && isset($lvl_exp[$res['level']+1])) {
	$res['level']++;
	mysql_query('UPDATE `clan` SET `level` = "'.$res['level'].'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
	mysql_query('INSERT INTO `clan_news` (`clan`,`time`,`ddmmyyyy`,`uid`,`ip`,`login`,`title`,`text`) VALUES (
	"'.$res['id'].'","'.time().'","'.date('d.m.Y').'","0","127.0.0.1","Администрация","Клановое сообщение","Ваш клан достиг уровня '.$res['level'].'!"
	)');
}

//Права клана
$lvl_prava = array(
	0  => array(16,0,0,0,0,50,20,200),
	1  => array(20,1,0,0,0,50,20,200),
	2  => array(24,1,0,0,0,50,20,200),
	3  => array(28,1,0,0,0,50,20,200),
	4  => array(32,1,1,0,0,100,40,200),
	5  => array(36,1,1,0,0,100,40,200),
	6  => array(40,1,1,0,0,100,40,200),
	7  => array(44,1,1,0,0,200,80,200),
	8  => array(48,1,1,1,1,200,80,200),
	9  => array(52,1,1,1,1,200,80,200),
	10 => array(56,1,1,1,1,200,80,200),
	11 => array(60,1,1,1,1,200,80,200),
	12 => array(64,1,1,1,1,200,80,200),
	13 => array(68,1,1,1,1,200,80,200)
);

?>
<script type="text/javascript" src="js/jquery.js"></script>
<style>

body { background-image:url(http://img.likebk.com/i/clanpanel/klan_img_44.jpg);}
.a {text-decoration:none; color:#333333; font-size:10px;}
.a:hover{text-decoration:none; color:#333333; font-size:10px;}
 
.clanimg { padding-right:5px; margin-bottom:-2px;}
.infimg {margin-left:2px; margin-bottom:-1px;}

#clanpanel {width:100%; height:32px; color:#333333; font-weight:bold; font-size:11px; min-width:1250px;}
#clanpanel .head{ float:left; width:75px; height:18px; font-size:11px; background-image:url(http://img.likebk.com/i/clanpanel/klan_img_03.jpg); background-repeat:no-repeat;}
#clanpanel .panel{ float:left; width:100%; height:32px; font-size:11px; background-image:url(http://img.likebk.com/i/clanpanel/klan_img_08.jpg); background-repeat:repeat-x;}
#clanpanel .foot{ float:left; width:75px; height:12px; font-size:11px; background-image:url(http://img.likebk.com/i/clanpanel/klan_img_27.jpg); background-repeat:no-repeat;}

.tabs ul {list-style:none; float:left; margin:0px; padding:0px;}

.name{ float:left; color:#990000; height:32px; padding-left:85px; background-image:url(http://img.likebk.com/i/clanpanel/klan_s3r3_07.jpg); background-repeat:no-repeat;  line-height:32px; padding-right:15px;}
 .clanicon{ padding-right:10px; margin-bottom:-2px;}

.tabs .events{ float:left; height:32px; padding-left:60px; background-image:url(http://img.likebk.com/i/clanpanel/klan_img_09.jpg); background-repeat:no-repeat;  line-height:32px; padding-right:20px;}
.tabs .control{ float:left; height:32px; padding-left:60px; background-image:url(http://img.likebk.com/i/clanpanel/klan_img_11.jpg); background-repeat:no-repeat;  line-height:32px; padding-right:20px;}

.tabs .deposit{ float:left; height:32px; padding-left:60px; background-image:url(http://img.likebk.com/i/clanpanel/klan_img_13.jpg); background-repeat:no-repeat;  line-height:32px; padding-right:20px;}

.tabs .clanart{ float:left; height:32px; padding-left:60px; background-image:url(http://img.likebk.com/i/clanpanel/klan_img_17.jpg); background-repeat:no-repeat;  line-height:32px; padding-right:20px;}

.tabs .rules{ float:left; height:32px; padding-left:60px; background-image:url(http://img.likebk.com/i/clanpanel/klan_img_19.jpg); background-repeat:no-repeat;  line-height:32px; padding-right:20px;}

.tabs .info{ float:left; height:32px; padding-left:60px; background-image:url(http://img.likebk.com/i/clanpanel/klan_img_21.jpg); background-repeat:no-repeat;  line-height:32px; padding-right:20px;}

.tabs .members{ float:left; height:32px; padding-left:60px; background-image:url(http://img.likebk.com/i/clanpanel/klan_img_23.jpg); background-repeat:no-repeat;  line-height:32px; padding-right:20px;}

.tabs .last{ float:right; width:15px; height:32px;background-image:url(http://img.likebk.com/i/clanpanel/klan_img_25.jpg); background-repeat:no-repeat;}


#clancontent {width:100%; float:left; padding-top:25px; }
.eventsblock {}



.legtitle   {font-weight:bold; padding:0px 5px 0px 5px; color:#990000;}
.legcontent {padding:0px 5px 0px 5px;}

.section {
	width: 100%;

	margin: 0 0 30px;
}
ul.tabs {
	height: 28px;
	line-height: 25px;
	list-style: none;
	margin:0px; padding:0px;
	font-size:10px;
	color:#666;
}
.tabs li {
	float: left;
	position: relative;
	cursor:pointer;
	font-size:10px;
}

.tabs li a{
	color:#666;
	font-size:10px;
}
.tabs li:hover,
.vertical .tabs li:hover {

}
li.current a{
	color:#333333;
	font-size:10px;

}


.box {
width:100%;
float:left;
display: none;
padding-top:25px;


}
.box.visible {
	display: block;
}
.modpow {

background-color:#ddd5bf;

}

.mt {

background-color:#b1a993;

padding-left:10px;

padding-right:10px;

padding-top:5px;

padding-bottom:5px;

}

.md {

padding:10px;

}
</style>

<script>

function openMod(title, dat) {
  var d = document.getElementById('useMagic');
  if(d != undefined) {
    document.getElementById('modtitle').innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="top">'+title+'</td><td width="30" valign="top"><div align="right"><a title="Закрыть" onClick="closeMod(); return false;" href="#">x</a></div></td></tr></table>';
    document.getElementById('moddata').innerHTML = dat;
    d.style.display = '';
  }
}



function closeMod() {
  var d = document.getElementById('useMagic');
  if(d != undefined) {
    document.getElementById('modtitle').innerHTML = '';
    document.getElementById('moddata').innerHTML = '';
    d.style.display = 'none';
  }
}

function addNewEvent() {
  openMod('Добавить событие',
	'<form method="post" action="main.php?clan&events&add=<?=$code?>">Заголовок: <input name="titleadd" value="" style="width:335px;" type="text"><br><textarea name="textadd" style="width:412px;" rows="5"></textarea><br><div align="right"><input type="submit" value="Добавить событие"></div></form>');
}

function addNewTitul() {
  openMod('Добавить титул',
	'<form method="post" action="main.php?clan&titul&add=<?=$code?>">Название титула: <input name="tituladd" value="" style="width:235px;" type="text"><br><small style="float:left">(не более 30-ти символов)</small><input style="float:right" type="submit" value="Добавить титул"></div></form>');
}

</script>

<div id="useMagic" style="display:none; position:absolute; border:solid 1px #776f59; left: 50px; top: 186px;" class="modpow">
 <div class="mt" id="modtitle"></div>
 <div class="md" id="moddata"></div>
</div>
<input style="float:right;margin:1px" type="button" value="Вернуться" onClick="document.location='main.php'">
<input style="float:right;margin:1px" type="button" value="Обновить" onClick="document.location='<?=$_SERVER['REQUEST_URI']?>'">
<?
if($u->info['clan_prava'] != 'glava') {
  if(isset($_GET['clan_exit']) && $u->newAct($_GET['sd4']) == true) {
    if($u->info['money'] >= 50) {
	  $txt = 'Игрок <img src="http://img.likebk.com/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="http://img.likebk.com/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$u->info['login'].'</a>['.$u->info['level'].']<a target="_blank" title="Инф. о '.$u->info['login'].'" href="inf.php?'.$u->info['id'].'"><img src="http://img.likebk.com/i/inf_'.$u->info['cityreg'].'.gif"></a> покинул клан. (50 кр.)';
	  mysql_query('INSERT INTO `clan_news` (`clan`, `time`, `ddmmyyyy`, `uid`, `ip`, `login`, `title`, `text`) VALUES ("'.$res['id'].'", "'.time().'", "'.date('d.m.Y').'", "0", "127.0.0.1", "Администрация", "Клановое сообщение", "'.mysql_real_escape_string($txt).'")');
	  mysql_query('UPDATE `users` SET `palpro` = 0, `clan` = 0, `align` = 0, `clan_prava` = "0|0|0|0", `money` = `money` - 50 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	  $ar = $u->rem_itm_cl($u->info, $res['id'], 7);
    } else {
	  echo '<script>setTimeout("alert(\'Для выхода из клана требуется наличие 50 кр.\');",500)</script>';
	}
  }
?>
<input style="float:right;margin:1px;margin-right:50px;color:red;" type="button" value="Покинуть клан (50 кр.)" onClick="if(confirm('Выйти из клана <?=$res['name']?>')){ location.href = '/main.php?clan&clan_exit=1&sd4=<?=$u->info['nextAct']?>'; }">
<? } ?>
<br>
<div class="section">
<div id="clanpanel">
  <div class="head" style="position:relative"><img src="http://img.likebk.com/i/align/align<?=$res['align'];?>.gif" style="position:absolute;top:23px;left:40px;" /></div>
    <div class="panel" style="white-space:nowrap;min-width:1000px;">
      <div class="name" onclick='location.href="main.php?clan&events"' title="События клана" style="cursor:pointer"><img class="clanicon" src="http://img.likebk.com/i/clan/<?=$res['name_mini'];?>.gif"><?=$res['name'];?></div>
      <ul class="tabs">
      <!--<li class="events"><a href="main.php?clan&events">События</a></li>-->
      <? if($tt[11][0] == 1 || $tt[9][0] == 1) { ?><li class="control"><a href="main.php?clan&control">Управление</a></li><? } ?>
      <? if($tt[3][0] == 1) { ?><li class="deposit"><a href="main.php?clan&deposit">Хранилище</a></li><? } ?>
      <? if($tt[15][0] == 1) { ?><li class="deposit"><a href="main.php?clan&ability">Абилки</a></li><? } ?>
      <? if($tt[11][0] > 0) { ?><li class="clanart"><a href="main.php?clan&titul">Титулы</a></li><? } ?>
      <li class="rules"><a href="main.php?clan&rules">Права</a></li>
      <li class="info"><a href="main.php?clan&info">О клане</a></li>
      <li class="members"><a href="main.php?clan&members">Соклановцы</a></li>
      <? if($tt[12][0] == 1) { ?>
      <li class="rules"><a href="main.php?clan&diplom">Дипломатия</a></li>
      <? } ?>
      <? if( $gral == true ) { ?>
      <li class="rules"><a href="main.php?clan&gral">Грааль</a></li>
      <? } ?>
      <li class="last"></li>
      </ul>
    </div>
 <div class="foot"></div>
</div><? if(isset($_GET['events'])) { ?>
   <div class="box visible">
   <style>
   .leftimg {
    float:left; /* Выравнивание по левому краю */
    margin: 17px 17px 17px 7px; /* Отступы вокруг картинки */
   }
   .rightimg  {
    float: right; /* Выравнивание по правому краю  */ 
    margin: 17px 7px 17px 17px; /* Отступы вокруг картинки */
   }
   .dnbx {
	   width:25px;
	   height:22px;
	   background-color:#ecece4;
	   vertical-align:middle;
	   text-align:center;  
	   display:inline-block;
	   margin:1px;
	   padding-top:3px;
	   cursor:default;
   }
   .dnbx1 {
	   width:25px;
	   height:22px;
	   background-color:#ecece4;
	   vertical-align:middle;
	   text-align:center;  
	   display:inline-block;
	   margin:1px;
	   padding-top:3px;
	   cursor:default;
   }
   .dnbx5 {
	   height:22px;
	   background-color:#ecece4;
	   vertical-align:middle;
	   text-align:center;  
	   display:inline-block;
	   margin:1px;
	   padding-top:3px;
	   cursor:default;
   }
   .dnbx:hover {
	   width:25px;
	   height:22px;
	   background-color:#dbdad5;
	   vertical-align:middle;
	   text-align:center;  
	   display:inline-block;
	   margin:1px;
	   padding-top:3px;
	   cursor:default;
   }
   .dnbx2 {
	   width:25px;
	   height:22px;
	   background-color:#b5b4b1;
	   color:#ecebe6;
	   vertical-align:middle;
	   text-align:center;  
	   display:inline-block;
	   margin:1px;
	   padding-top:3px;
	   cursor:default;
   }
   </style>
    <fieldset style="border:1px dashed #eeeeee">
      <legend><span class="legtitle">События</span></legend>
      <?
	  	  
	  $c_r = ''; $c_c = ''; $c_p = '';	 
	  
	  if(isset($_GET['add'],$_POST['textadd']) && $tt[2][0] == 1) {
		 $lmsg = mysql_fetch_array(mysql_query('SELECT `id` FROM `clan_news` WHERE `uid` = "'.$u->info['id'].'" AND `time` > '.(time()-10).' LIMIT 1'));
		 if(isset($lmsg['id'])) {
			 $c_r .= '<font color="#FF0000"><b>Нельзя добавлять сообщения чаще одного раза в 10 секунд</b></font><br>'; 
		 }else{
			 $tadd = htmlspecialchars($_POST['textadd'],NULL,'cp1251');
			 $ttadd = htmlspecialchars($_POST['titleadd'],NULL,'cp1251');
			 if(str_replace(' ','',str_replace('	','',$tadd)) == '') {
				 $c_r .= '<font color="#FF0000"><b>Нельзя отправлять пустое событие</b></font><br>';  
			 }elseif(str_replace(' ','',str_replace('	','',$ttadd)) == '') {
				 $c_r .= '<font color="#FF0000"><b>Нельзя отправлять пустой заголовок</b></font><br>';  
			 }else{
				$tadd = str_replace("\n",'<br>',$tadd);
				mysql_query('INSERT INTO `clan_news` (`clan`,`time`,`ddmmyyyy`,`uid`,`ip`,`login`,`title`,`text`) VALUES (
				"'.$res['id'].'","'.time().'","'.date('d.m.Y').'","'.$u->info['id'].'","'.$u->info['ip'].'","'.$u->info['login'].'","'.mysql_real_escape_string($ttadd).'","'.mysql_real_escape_string($tadd).'"
				)');
				$c_r .= '<font color="#FF0000"><b>Событие было успешно добавлено</b></font><br>'; 
			 }
		 }
	  }elseif(isset($_GET['delete']) && $tt[2][0] == 1) {
		  $upd = mysql_query('UPDATE `clan_news` SET `delete` = "'.$u->info['id'].'" WHERE `clan` = "'.$res['id'].'" AND `delete` = "0" AND `uid` != "0" AND `id` = "'.mysql_real_escape_string($_GET['delete']).'" LIMIT 1');
		  if($upd) {
			 $c_r .= '<font color="#FF0000"><b>Событие было успешно удалено</b></font><br>';  
		  }else{
			  $c_r .= '<font color="#FF0000"><b>Событие не найдено</b></font><br>';  
		  }
	  }
	   
	  $dd = date('d');
	  $mm = date('m');
	  $yy = date('Y');	
	  
	  if(isset($_GET['mm'])) {
		 $mm =  ceil((int)$_GET['mm']);
	  }
	  if(isset($_GET['dd'])) {
		 $dd =  ceil((int)$_GET['dd']);
	  }
	  if(isset($_GET['yy'])) {
		 $yy =  ceil((int)$_GET['yy']);
	  }
	    
	  $mml = ceil($mm)-1;
	  $mmr = ceil($mm)+1;	  
	  $yyl = $yy;
	  $yyr = $yy;	  
	  if($mml < 1) {
		$yyl--;
		$mml = 12;  
	  }	  
	  if($mmr > 12) {
		$yyr++;
		$mmr = 1;  
	  }	
	  $dds = array('','пн','вт','ср','чт','пт','<font color="#981115">сб</font>','<font color="#981115">вс</font>');
	  $mms = array('','январь','февраль','март','апрель','май','июнь','июль','август','сентябрь','октябрь','ноябрь','декабрь');
	  $num = 0; $lday = 0;
	  for($i = 0; $i < 7; $i++)
	  {
		$dayofweek = date('w',mktime(0, 0, 0, $mm, $day_count, $yy));
		$dayofweek = $dayofweek - 1;
		if($dayofweek == -1) $dayofweek = 6;
	
		if($dayofweek == $i)
		{
		  $week[$num][$i] = $day_count;
		  $lday = $day_count;
		  $day_count++;
		}else{
		  $week[$num][$i] = "";
		}
	  }
	  
	  function freenews($d,$m,$y) {
		  global $res;
		  $r = $d;
		  if($d < 9) {
			 $d = '0'.$d; 
		  }
		  if($m < 9) {
			 $m = '0'.((int)$m); 
		  }
		  $n = mysql_fetch_array(mysql_query('SELECT `id` FROM `clan_news` WHERE `clan` = "'.$res['id'].'" AND `delete` = "0" AND `ddmmyyyy` = "'.$d.'.'.$m.'.'.$y.'" LIMIT 1'));
		  if(isset($n['id'])) {
			 $r = '<a style="text-decoration:underline;" href="?clan&events&ftr=1&mm='.$m.'&yy='.$y.'&dd='.$d.'">'.$r.'</a>'; 
		  }
		  return $r;
	  }
	  
	  $i = 1;
	  $c_c .= '<div style="width:260px;border:1px solid #9d9d9d;padding:10px;background-color:#ecebe7">';
	  if($tt[2][0] > 0) {
	  	$c_c .= '<center><input type="button" value="Добавить событие" onClick="addNewEvent();"></center><br>';
	  }
	  $c_c .= '<div><span style="float:left" class="dnbx" title="'.$mms[$mml].' '.$yyl.'" onclick="location=\'?clan&events&mm='.$mml.'&yy='.$yyl.'\'">&lt;</span><span style="float:right" class="dnbx" onclick="location=\'?clan&events&mm='.$mmr.'&yy='.$yyr.'\'" title="'.$mms[$mmr].' '.$yyr.'">&gt;</span><center class="dnbx5">'.$yy.' '.$mms[ceil($mm)].'</center></div><br>';
	  while($i <= 49) {
		 if($i <= 7) {
		 	$c_c .= '<small class="dnbx1"><b>'.$dds[$i].'</b></small>';
		 }else{
			if($i-7 > 7) {
				$lday++;
				if(date('d',mktime(0, 0, 0, $mm, $lday)) == $lday) {
					if($lday == date('d') && $mm == ceil(date('m')) && $yy == date('Y')) {
						$c_c .= '<span class="dnbx2">'.freenews($lday,$mm,$yy).'</span>';
					}else{
						$c_c .= '<span class="dnbx">'.freenews($lday,$mm,$yy).'</span>';
					}
				}else{
					$c_c .= '<span class="dnbx1">&nbsp;</span>';
				}
			}else{
				if($week[0][$i-8] > 0) {
					if($week[0][$i-8] == date('d') && $mm == ceil(date('m')) && $yy == date('Y')) {
						$c_c .= '<span class="dnbx2">'.freenews($week[0][$i-8],$mm,$yy).'</span>';
					}else{
						$c_c .= '<span class="dnbx"">'.freenews($week[0][$i-8],$mm,$yy).'</span>';
					}
				}elseif($lday > 0) {
					$c_c .= '<span class="dnbx1">&nbsp;</span>';
				}
			}
		 }
		 if($i == 7 || $i == 14 || $i == 21 || $i == 28 || $i == 35 || $i == 42) {
			if($lday > 0 || $i != 14) {
				$c_c .= '<br>';
			}
		 }
		 $i++; 
	  }
	  $c_c .= '</div>';
	  
		if($tt[1][0] == 1) {
		  $cnftr = '';
		  if(isset($_GET['ftr'])) {
			  if($_GET['ftr'] == 1) {
				$dd1 = $dd;
				$mm1 = $mm;
				$yy1 = $yy;
				if($dd1 < 9) {
					$dd1 = '0'.$dd1;
				}
				if($mm1 < 9) {
					$mm1 = '0'.$mm1;
				}
			  	$cnftr = ' AND `ddmmyyyy` = "'.mysql_real_escape_string($dd1.'.'.$mm1.'.'.$yy1).'"';
			  }
		  }
			$pg = round((int)$_GET['pg']);
			if($pg < 1) {
				$pg = 1;	
			}
			$pgssee = ceil(($pg-1)*5);
		  
			$pgs = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `clan_news` WHERE `clan` = "'.$res['id'].'" AND `delete` = "0"'.$cnftr));
			$pgs = $pgs[0];
			$pga = ceil($pgs/5);
	
			$i = 1;
			while($i <= $pga) {
				if($pg == $i) {
					$c_p .= ' <b>'.$i.'</b> ';
				}else{
					if(isset($_GET['ftr'])) {
						$c_p .= ' <a href="?clan&events&dd='.$dd.'&mm='.$mm.'&yy='.$yy.'&ftr='.$_GET['ftr'].'&pg='.$i.'">'.$i.'</a> ';
					}else{
						$c_p .= ' <a href="?clan&events&pg='.$i.'">'.$i.'</a> ';
					}
				}
				$i++;
			}
			
			if($c_p != '') {
				$c_p = 'Страицы: '.$c_p;
			}
		  
		  $sp = mysql_query('SELECT * FROM `clan_news` WHERE `clan` = "'.$res['id'].'" AND `delete` < 1'.$cnftr.' ORDER BY `id` DESC LIMIT '.mysql_real_escape_string($pgssee).',5');
		  while($pl = mysql_fetch_array($sp)) {
			  if($pl['uid'] > 0) {
				$login = $u->microLogin($pl['uid'],1);
				if($tt[2][0] == 1){
					$pl['text'] = '<img src="http://img.likebk.com/i/clear.gif" width="13" height="13" title="Удалить событие" class="leftimg" style="cursor:pointer" onclick="location=\'main.php?clan&events&pg='.ceil($pg).'&delete='.$pl['id'].'\'">'.$pl['text'];
				}
			  }else{
				$login = '';  
			  }
			  
			  $c_r .= '
	<table width="100%" border="0" style="border:1px solid #aeaeae" cellspacing="0" cellpadding="5">
	  <tr>
		<td bgcolor="#c4c3c1"><div style="float:left"><i>'.date('d.m.Y H:i',$pl['time']).'</i> &nbsp; &nbsp; &nbsp; <a class="a" href="javascript:void(0)">'.$pl['title'].'</a></div><div style="float:right">'.$login.'</div></td>
	  </tr>
	  <tr>
		<td>'.$pl['text'].'</td>
	  </tr>
	</table><br>';
		  }	 
	  }
	  if($c_r == '') {
		 $c_r .= '<br><br><br><br><br><br><br><br><center><b>Событий пока нет или глава клана не предоставил вам к ним доступ</b></center>'; 
	  }
	   
	  ?>
      <table width="100%" border="0" cellspacing="0" cellpadding="10">
      <tr>
        <td align="left" valign="top"><?=$c_r?></td>
        <td width="300" align="center" valign="top"><?=$c_c?></td>
      </tr>
      <tr>
        <td align="right" valign="top"><?=$c_p?></td>
        <td align="left" valign="top">&nbsp;</td>
      </tr>
      </table>
    </fieldset>
   </div>
   <? }elseif(isset($_GET['control'])) { ?> 
   <script>
	function changeLogin(selObj){
	  selid = selObj.options[selObj.selectedIndex].value;
	  $('#sn_titul').val($('#slg'+selid).attr('vtitul'));
	  $('#sn_zvanie').val($('#slg'+selid).attr('vzvanie'));
	  $('#sn_canals').val($('#slg'+selid).attr('vcanals'));
	  
	  if($('#slg'+selid).attr('vtitul') == 'глава клана') {
		  $('#rp_titul').attr({'disabled':'disabled'});
		  $('#sn_zvanie').attr({'disabled':'disabled'});
		  $('#sn_canals').attr({'disabled':'disabled'});
		  $('#rp_save').attr({'disabled':'disabled'});
	  }else{
		  $('#rp_titul').attr({'disabled':false});
		  $('#sn_zvanie').attr({'disabled':false});
		  $('#sn_canals').attr({'disabled':false});
		  $('#rp_save').attr({'disabled':false});
	  }
	}
   </script>
   <div class="box visible">
    <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
		Тип управления кланом: <a href="javascript:void(0)"><? if($res['politic'] == 1) { ?>Диктатура<? }else{ ?>Демократия<? } ?></a>
    </div>
    <?
	$c_pr = array(
		100, //принять
		50, //выгнать
		100 //сменить главу
	);
 
	if(isset($_POST['svb_canals']) && $tt[11][0] == 1) {
		echo '<font color="#FF0000"><b>Каналы чата сохранены</b></font><br>';
		$res['canals'] = $_POST['svb_canals'];
		$rce = explode();
		$i = 1;
		while($i <= 9) {
			
			$i++;
		}
		mysql_query('UPDATE `clan` SET `canals` = "'.mysql_real_escape_string($res['canals']).'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
	}elseif(isset($_POST['svb_give_money']) && $tt[7][0] == 1) {
		$mn = round((int)$_POST['svb_give_money'],2);
		if($mn >= 0.01) {
			if($res['money1'] < $mn) {
				echo '<font color="#FF0000"><b>В клане недостаточно средств</b></font><br>';
			}else{
				$res['money1'] -= $mn;
				$u->info['money'] += $mn;
				echo '<font color="#FF0000"><b>Вы успешно сняли с казны клана '.$mn.' кр.</b></font><br>';
				mysql_query('UPDATE `clan` SET `money1` = "'.mysql_real_escape_string($res['money1']).'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
				mysql_query('UPDATE `users` SET `money` = "'.mysql_real_escape_string($u->info['money']).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`) VALUES ("'.$res['id'].'","'.time().'","1","'.$u->info['login'].'","'.mysql_real_escape_string($mn).'","'.$u->info['id'].'")');
			}
		}
	}elseif(isset($_POST['svb_take_money']) && $tt[6][0] == 1) {
		$mn = round((int)$_POST['svb_take_money'],2);
		if($mn >= 0.01) {
			if($u->info['money'] < $mn) {
				echo '<font color="#FF0000"><b>У вас недостаточно средств</b></font><br>';
			}else{
				$res['money1'] += $mn;
				$u->info['money'] -= $mn;
				echo '<font color="#FF0000"><b>Вы успешно положили в казну клана '.$mn.' кр.</b></font><br>';
				mysql_query('UPDATE `clan` SET `money1` = "'.mysql_real_escape_string($res['money1']).'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
				mysql_query('UPDATE `users` SET `money` = "'.mysql_real_escape_string($u->info['money']).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`) VALUES ("'.$res['id'].'","'.time().'","2","'.$u->info['login'].'","'.mysql_real_escape_string($mn).'","'.$u->info['id'].'")');
			}
		}
	}elseif(isset($_POST['invite']) && ($_POST['invite'] == 'Принять' || $_POST['invite'] == 'Выгнать' || $_POST['invite'] == 'Назначить') && $tt[11][0] == 1) {
		if($_POST['invite'] == "Выгнать" && $tt[10][0] == 1) {
			$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['logingo']).'" AND `clan` = "'.$res['id'].'" LIMIT 1'));
			//$ttus = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `id` = "'.$usr['clan_prava'].'" LIMIT 1'));
			if(!isset($usr['id'])) {
				echo '<font color="#FF0000"><b>Игрок не найден в клане</b></font><br>';
			} elseif($tt['prioritet'] >= $utitl['prioritet']) {
				echo '<font color="#FF0000"><b>Игрок старше вас по званию, либо звания совпадают</b></font><br>';
			} elseif($u->info['money'] < $c_pr[1]) {
				echo '<font color="#FF0000"><b>У вас не достаточно кр. для исключения игрока из клана (Требуется: '.$c_pr[1].' кр.)</b></font><br>';
			} elseif($usr['clan_prava'] == 'galva' && $u->info['clan_prava'] != 'glava') {
				echo '<font color="#FF0000"><b>Игрок старше вас по званию, либо звания совпадают</b></font><br>';
			} else {
			  $ar = $u->rem_itm_cl($usr, $res['id'], 8);
				mysql_query('UPDATE `users` SET `palpro` = 0, `clan_prava` = 0, `clan` = 0, `mod_zvanie` = "", `align` = 0 WHERE `id` = "'.$usr['id'].'" LIMIT 1');
				$u->info['money'] -= $c_pr[1];
				mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				$c_r .= '<font color="#FF0000"><b>Игрок &quot;'.$usr['login'].'&quot; был исключен из клана за '.$c_pr[1].' кр.</b></font><br>'; 
				$txt = 'Игрок <img src="http://img.likebk.com/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="http://img.likebk.com/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$u->info['login'].'</a>['.$u->info['level'].']<a target="_blank" title="Инф. о '.$u->info['login'].'" href="inf.php?'.$u->info['id'].'"><img src="http://img.likebk.com/i/inf_'.$u->info['cityreg'].'.gif"></a> исключил из клана игрока <img src="http://img.likebk.com/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="http://img.likebk.com/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$usr['login'].'</a>['.$usr['level'].']<a target="_blank" title="Инф. о '.$usr['login'].'" href="inf.php?'.$usr['id'].'"><img src="http://img.likebk.com/i/inf_'.$usr['cityreg'].'.gif"></a>';
				mysql_query('INSERT INTO `clan_news` (`clan`,`time`,`ddmmyyyy`,`uid`,`ip`,`login`,`title`,`text`) VALUES (
				"'.$res['id'].'","'.time().'","'.date('d.m.Y').'","0","127.0.0.1","Администрация","Клановое сообщение","'.mysql_real_escape_string($txt).'"
				)');
			}
		}elseif($_POST['invite'] == "Назначить" && $u->info['clan_prava'] == 'glava') {
			$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['logingo']).'" AND `clan` = "'.$res['id'].'" AND `banned` = "0" LIMIT 1'));
			if(!isset($usr['id'])) {
				echo '<font color="#FF0000"><b>Игрок не найден в клане</b></font><br>';
			}elseif($u->info['money'] < $c_pr[2]) {
				echo '<font color="#FF0000"><b>У вас не достаточно кр. для назначения игрока на пост главы клана (Требуется: '.$c_pr[2].' кр.)</b></font><br>';
			}elseif($usr['clan_prava'] == 'galva') {
				echo '<font color="#FF0000"><b>Игрок уже является главой клана</b></font><br>';
			}else{
				mysql_query('UPDATE `users` SET `clan_prava` = "glava", `clan` = "'.$res['id'].'", `mod_zvanie` = "глава клана", `align` = "'.$res['align'].'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
				$u->info['money'] -= $c_pr[2];
				mysql_query('UPDATE `users` SET `clan_prava` = "2", `mod_zvanie` = "новичок", `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				$c_r .= '<font color="#FF0000"><b>Игрок &quot;'.$usr['login'].'&quot; был назначен главой клан за '.$c_pr[0].' кр.</b></font><br>'; 
				$txt = 'Игрок <img src="http://img.likebk.com/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="http://img.likebk.com/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$u->info['login'].'</a>['.$u->info['level'].']<a target="_blank" title="Инф. о '.$u->info['login'].'" href="inf.php?'.$u->info['id'].'"><img src="http://img.likebk.com/i/inf_'.$u->info['cityreg'].'.gif"></a> назначил игрока <img src="http://img.likebk.com/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="http://img.likebk.com/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$usr['login'].'</a>['.$usr['level'].']<a target="_blank" title="Инф. о '.$usr['login'].'" href="inf.php?'.$usr['id'].'"><img src="http://img.likebk.com/i/inf_'.$usr['cityreg'].'.gif"></a> на должность <b>Главы клана</b>';
				mysql_query('INSERT INTO `clan_news` (`clan`,`time`,`ddmmyyyy`,`uid`,`ip`,`login`,`title`,`text`) VALUES (
				"'.$res['id'].'","'.time().'","'.date('d.m.Y').'","0","127.0.0.1","Администрация","Клановое сообщение","'.mysql_real_escape_string($txt).'"
				)');
			}
		}elseif($_POST['invite'] == "Принять" && $tt[9][0] == 1) {
            $is_cl = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `users` WHERE `clan` = '".$res['id']."'"));
            $usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['logingo']).'" AND `clan` != "'.$res['id'].'" LIMIT 1'));
			if($is_cl[0] >= $lvl_prava[$res['level']][0]) {
                echo '<font color="#FF0000"><b>Достигнут лимит приглашений. Повысте уровень клана. ('.$is_cl[0].'/'.$lvl_prava[$res['level']][0].')</b></font><br>';
			}elseif($u->testAlign($usr['id'],$res['align']) != false) {
				echo '<font color="#FF0000"><b>У персонажа задержка на смену склонности еще '.$u->timeOut($u->testAlign($usr['id'],$res['align'])-time()).'.</b></font><br>';
			}elseif($u->testClan($usr['id'],$res['id']) != false) {
				echo '<font color="#FF0000"><b>У персонажа задержка на прием в кланы еще '.$u->timeOut($u->testClan($usr['id'],$res['id'])-time()).'.</b></font><br>';
			}elseif(!isset($usr['id'])) {
				echo '<font color="#FF0000"><b>Подходящий игрок не найден, либо не прошел проверку на чистоту</b></font><br>';
			}elseif($usr['clan_prava'] == 'galva') {
				echo '<font color="#FF0000"><b>Игрок уже является главой клана</b></font><br>';
			}elseif($u->info['money'] < $c_pr[0]) {
				echo '<font color="#FF0000"><b>У вас не достаточно кр. для приема игрока в клан (Требуется: '.$c_pr[0].' кр.)</b></font><br>';
			}elseif($usr['clan'] != '0') {
				//echo '<font color="#FF0000"><b>Персонаж уже находится в клане, либо имеет склонность</b></font><br>';
				echo '<font color="#FF0000"><b>Персонаж уже находится в клане</b></font><br>';
            }else{
				//$u->addAlignClan($usr['id'],$res['align'],$res['clan']);
				mysql_query('INSERT INTO `clan_invit` SET 
					`id_invit` = "'.$u->info['id'].'",
					`uid` = "'.$usr['id'].'",
					`clan_id` = "'.$res['id'].'",
					`money` = "'.$c_pr[0].'",
					`align` = "'.$res['align'].'"');
				echo '<font color="#FF0000"><b>Игроку &quot;'.$usr['login'].'&quot; отправлено приглашение на вступление в клан</b></font><br>'; 
				$txt_ekr = 'Вам предложили вступить в клан <font color=#003388><b>'.$res['name'].'</b></font>, для продолжения необходимо пройти в регистратуру кланов.';
				mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
					'1',
					'".$usr['city']."',
					'".$usr['room']."',
					'',
					'".$usr['login']."',
					'".$txt_ekr."',
					'-1',
					'6',
					'0')");
				/*mysql_query('UPDATE `users` SET `palpro` = "0",`clan_prava` = "2",`clan` = "'.$res['id'].'",`mod_zvanie` = "",`align` = "'.$res['align'].'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
				$u->info['money'] -= $c_pr[0];
				mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				echo '<font color="#FF0000"><b>Игрок &quot;'.$usr['login'].'&quot; был принят в клан за '.$c_pr[0].' кр.</b></font><br>'; 
				$txt = 'Игрок <img src="http://img.likebk.com/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="http://img.likebk.com/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$u->info['login'].'</a>['.$u->info['level'].']<a target="_blank" title="Инф. о '.$u->info['login'].'" href="inf.php?'.$u->info['id'].'"><img src="http://img.likebk.com/i/inf_'.$u->info['cityreg'].'.gif"></a> принял в клан игрока <img src="http://img.likebk.com/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="http://img.likebk.com/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$usr['login'].'</a>['.$usr['level'].']<a target="_blank" title="Инф. о '.$usr['login'].'" href="inf.php?'.$usr['id'].'"><img src="http://img.likebk.com/i/inf_'.$usr['cityreg'].'.gif"></a>';
				mysql_query('INSERT INTO `clan_news` (`clan`,`time`,`ddmmyyyy`,`uid`,`ip`,`login`,`title`,`text`) VALUES (
				"'.$res['id'].'","'.time().'","'.date('d.m.Y').'","0","127.0.0.1","Администрация","Клановое сообщение","'.mysql_real_escape_string($txt).'"
				)');*/
			}
		}
	}
	?>
    <? if($tt[9][0] > 0) { ?>
    <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
	<input style="width:144px;" value="Пригласить в клан" onClick="openMod('<b>Пригласить игрока в клан</b>','<form action=\'main.php?clan&control&priem\' method=\'post\'>Логин: <input type=\'text\' style=\'width:244px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'invite\' value=\'Принять\'></form>');" type="button" /> 
	(это вам обойдется в <?=$c_pr[0]?><b> кр.</b>)<br />
    (перед приемом в клан, персонаж должен пройти проверку у паладинов)<br />
    </div>
    <? } ?>
    <? if($tt[10][0] > 0) { ?>
    <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
    <input type="button" style="width:144px;" value="Выгнать из клана" onClick="openMod('<b>Выгнать игрока из клана</b>','<form action=\'main.php?clan&control&unpriem\' method=\'post\'>Логин: <input type=\'text\' style=\'width:244px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'invite\' value=\'Выгнать\'></form>');"> 
    (это вам обойдется в <?=$c_pr[1]?><b> кр.</b>)<br />
    </div>
    <? } ?>
    <? if($u->info['clan_prava'] == 'glava') { ?>
    <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
	<input style="width:144px;" value="Сменить главу клана" onClick="openMod('<b>Назначить главу клана</b>','<form action=\'main.php?clan&control&newglava\' method=\'post\'>Логин: <input type=\'text\' style=\'width:244px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'invite\' value=\'Назначить\'></form>');" type="button" /> (глава клана вправе сложить с себя полномочия, назначив главой клана другого персонажа)<br />
	</div>
    <? } ?>
    <? if($tt[11][0] > 0) { ?>
    <fieldset>
      <legend><span class="legtitle">Редактирование статуса персонажа</span></legend>
      <?
	  if(isset($_GET['saveuser']) && $tt[11][0] == 1) {
		 //[rp_login] => 0 [rp_titul] => 0 [rp_zvanie] => [rp_canals] => 
		 $c_r = '';
		 $usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.mysql_real_escape_string($_POST['rp_login']).'" AND `clan` = "'.$res['id'].'" LIMIT 1'));
		 if(isset($usr['id'])) {
			 if($usr['clan_prava'] != 'glava') {
			 	$tt = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `id` = "'.$usr['clan_prava'].'" LIMIT 1'));
				if($tt['prioritet'] < $utitl['prioritet']) {
					//новый титул
					if((int)$_POST['rp_titul'] > 0) {
						$tt_new = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `id` = "'.mysql_real_escape_string($_POST['rp_titul']).'" AND `clan` = "'.$res['id'].'" LIMIT 1'));
						if(isset($tt_new['id'])) {
							if($tt_new['prioritet'] < $utitl['prioritet']) {
								mysql_query('UPDATE `users` SET `clan_prava` = "'.$tt_new['id'].'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
								$c_r .= '<font color="#FF0000"><b>Игроку &quot;'.$usr['login'].'&quot; был присвоен титул &quot;'.$tt_new['name'].'&quot;</b></font><br>'; 
								if($tt_new['prioritet'] < $tt['prioritet']) {
									//понижен
									$txt = 'Игрок <img src="http://img.likebk.com/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="http://img.likebk.com/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$u->info['login'].'</a>['.$u->info['level'].']<a target="_blank" title="Инф. о '.$u->info['login'].'" href="inf.php?'.$u->info['id'].'"><img src="http://img.likebk.com/i/inf_'.$u->info['cityreg'].'.gif"></a> понизил титул игроку <img src="http://img.likebk.com/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="http://img.likebk.com/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$usr['login'].'</a>['.$usr['level'].']<a target="_blank" title="Инф. о '.$usr['login'].'" href="inf.php?'.$usr['id'].'"><img src="http://img.likebk.com/i/inf_'.$usr['cityreg'].'.gif"></a> до &quot;<b>'.$tt_new['name'].'</b>&quot;';
								}else{
									//присвоен
									$txt = 'Игрок <img src="http://img.likebk.com/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="http://img.likebk.com/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$u->info['login'].'</a>['.$u->info['level'].']<a target="_blank" title="Инф. о '.$u->info['login'].'" href="inf.php?'.$u->info['id'].'"><img src="http://img.likebk.com/i/inf_'.$u->info['cityreg'].'.gif"></a> присвоил титул &quot;<b>'.$tt_new['name'].'</b>&quot; игроку <img src="http://img.likebk.com/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom"><img src="http://img.likebk.com/i/clan/'.$res['name'].'.gif" style="vertical-align:bottom"><a href="javascript:void(0)">'.$usr['login'].'</a>['.$usr['level'].']<a target="_blank" title="Инф. о '.$usr['login'].'" href="inf.php?'.$usr['id'].'"><img src="http://img.likebk.com/i/inf_'.$usr['cityreg'].'.gif"></a>';
								}
								
								mysql_query('INSERT INTO `clan_news` (`clan`,`time`,`ddmmyyyy`,`uid`,`ip`,`login`,`title`,`text`) VALUES (
								"'.$res['id'].'","'.time().'","'.date('d.m.Y').'","0","127.0.0.1","Администрация","Клановое сообщение","'.mysql_real_escape_string($txt).'"
								)');
								
							}else{
								$c_r .= '<font color="#FF0000"><b>Вы не можете назначать титул старше вашего титула</b></font><br>'; 
							}
						}
					}
					mysql_query('UPDATE `users` SET `mod_zvanie` = "'.mysql_real_escape_string($_POST['rp_zvanie']).'",`ccanals` = "'.mysql_real_escape_string($_POST['rp_canals']).'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
					$c_r .= '<font color="#FF0000"><b>Информация успешно сохранена</b></font><br>';					
					
				}else{
					$c_r .= '<font color="#FF0000"><b>Игрок старше вас по званию, либо звания совпадают</b></font><br>'; 
				}
			 }else{
				$c_r .= '<font color="#FF0000"><b>Игрок старше вас по званию, либо звания совпадают</b></font><br>'; 
			 }
		 }else{
			 $c_r .= '<font color="#FF0000"><b>Игрок не состоит в клане '.$res['name'].'</b></font><br>';  
		 }
	  }
	  echo $c_r;
	  ?>
      <form method="post" action="main.php?clan&control&saveuser">
      <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
      <div style="display:inline-block;width:150px;">Логин:</div><select onchange="changeLogin(this);" style="width:211px;" name="rp_login">
      <option value="0" style="color:#CCCCCC">выберите логин</option>
	  <?
      $sp = mysql_query('SELECT `id`,`login`,`clan_prava`,`ccanals`,`mod_zvanie` FROM `users` WHERE `clan` = "'.$res['id'].'"');
	  while($pl = mysql_fetch_array($sp)) {
		  $cp = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `id` = "'.mysql_real_escape_string($pl['clan_prava']).'" LIMIT 1'));
		  if($pl['clan_prava'] == 'glava') {
			 $cp['name'] = 'глава клана'; 
		  }
		  echo '<option id="slg'.$pl['id'].'" value="'.$pl['id'].'" vtitul="'.$cp['name'].'" vzvanie="'.$pl['mod_zvanie'].'" vcanals="'.$pl['ccanals'].'">'.$pl['login'].'</option>';
	  }
	  ?></select>
      </div>
      <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
      <div style="display:inline-block;width:150px;">Титул:</div><input id="sn_titul" style="width:211px;" disabled="disabled" name="rp_canals" type="text" />
      </div>
      <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
      <div style="display:inline-block;width:150px;">Присвоить титул:</div><select style="width:211px;" id="rp_titul" name="rp_titul">
	  <option value="0" style="color:#CCCCCC">не менять</option>
	  <?
      $sp = mysql_query('SELECT * FROM `clan_tituls` WHERE `clan` = "'.$res['id'].'" AND `delete` = "0" LIMIT 25');
	  while($pl = mysql_fetch_array($sp)) {
		  echo '<option value="'.$pl['id'].'">'.$pl['name'].'</option>';
	  }
	  ?></select>
      </div>
      <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
      <div style="display:inline-block;width:150px;">Реликты</div>
      </div>
      <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
      <div style="display:inline-block;width:150px;">Звание в клане:</div><input style="width:211px;" id="sn_zvanie" name="rp_zvanie" type="text" />
      </div>
      <div>
      <div style="display:inline-block;width:150px;">Каналы чата:</div><input style="width:211px;" id="sn_canals" name="rp_canals" type="text" /><br />
      <small>(Перепешите через запятую номера доступных каналов. Например: 1,3,7. Доступные каналы: 1-9)</small> <input name="Отправить" type="submit" id="rp_save" value="Сохранить" />
      </div>
      </form>
    </fieldset>
      <form method="post" enctype="multipart/form-data" action="?clan&control&save_canals">
      <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-top:10px;padding-bottom:5px;">
      <div style="display:inline-block;width:150px;">Каналы чата:</div><input style="width:211px;" id="svb_canals" value="<?=$res['canals']?>" name="svb_canals" type="text" /> <input name="Отправить" type="submit" id="rp_save" value="Сохранить" /><br />
      <small>(Перепешите через запятую номера открытых каналов. Например: 2,4,8. Доступные каналы: 1-9)</small>
      </div>
      </form>
      <? } ?>
    <? if($tt[5][0] == 1) { ?>
    <? if($tt[7][0] > 0 && $res['money2'] > 0) { ?>
    <fieldset>
      <legend><span class="legtitle">Заказать изображение</span></legend>
      <form action="?clan&control&buy_imgae" method="post" enctype="multipart/form-data">
      	<?
		/* Обработка изображения и данных */
		
		if(isset($_GET['gdload'])) {
			echo '<b style="color:red">Изображение было успешно загружено на сервер! Воспользоваться им возможно в инвентаре, в разделе &quot;Галерея&quot;.</b><br>';
		}elseif(isset($_POST['img_load1type'])) {
			
		class upload {
		 
		protected function __construct() { }
		 
		static $save_path = 'clan_prw/';
		static $error = '';
		 
		static function saveimg($name,$max_mb = 2,$exts = 'jpg|png|jpeg|gif',$cnm = '') {
			if (isset($_FILES[$name])) {
				$f = &$_FILES[$name];
				if (($f['size'] <= $max_mb*1024*1024) && ($f['size'] > 0)) {
					if (
						(preg_match('/\.('.$exts.')$/i',$f['name'],$ext))&&
						(preg_match('/image/i',$f['type']))
					) {
		
						$ext[1] = strtolower($ext[1]);
						$fn = uniqid('f_',true).'_'.$cnm.'.'.$ext[1];
						$fn2 = uniqid('f_',true).'';
						if (move_uploaded_file($f['tmp_name'], self::$save_path . $fn)) {
							// система изменения размера , требуется Rimage
							//Rimage::resize(self::$save_path . $fn, self::$save_path . $fn2);
							//@unlink(self::$save_path . $fn); // удаление файла
							return array($fn2,$fn,self::$save_path . $fn);
						} else {
							self::$error = 'Ошибка загрузки файла';
						}
					} else {
						self::$error = 'Неверный тип файла. Допустимые типы : <b>'.$exts.'</b>';
					}
				} else {
					self::$error = 'Неверный размер файла. Максимальный размер файла <b>'.$max_mb.' МБ</b>';
				}
			} else {
				self::$error = 'Файл не найден';
			}
			return false;
		} // end saveimg
		 
		} // end class
			
			$data = array(
				'obraz' => $_FILES['load_image1'],
				'sex'	=> round((int)$_POST['img_load3type']),
				'w'		=> '',
				'h'		=> '',
				'type'	=> round((int)$_POST['img_load1type']),
				'animation'	=> round((int)$_POST['img_load2type'])
			);
			
			$ers = '';
			
			if($data['sex'] != 0 && $data['sex'] != 1) {
				$ers = 'Ошибка! Вы не выбрали пол кому будет доступно изображение!';
			}elseif($data['animation'] != 0 && $data['animation'] != 1) {
				$ers = 'Ошибка! Вы не выбрали тип изображения: Анимированное, не анимированное!';
			}elseif($data['type'] < 1 || $data['type'] > 18) {
				$ers = 'Ошибка! Вы не выбрали тип слота замещения изображения!';
			}
			
			if($res['id'] !=2) {
				//$ers = 'NO!';
			}
			
			$types = array(
				1  => array('Образ',120,220,100),
				2  => array('Заглушка (снизу)',120,40,15),
				3  => array('Заглушка (сверху)',120,20,5),
				4  => array('Шлем',60,60,25),
				5  => array('Наручи',60,40,25),
				6  => array('Левая рука',60,60,25),
				7  => array('Правая рука',60,60,25),
				8  => array('Броня',60,80,25),
				9  => array('Пояс',60,40,25),
				10 => array('Ботинки',60,40,25),
				11 => array('Поножи',60,80,25),
				12 => array('Перчатки',60,40,25),
				13 => array('Кольца №1',20,20,10),
				14 => array('Кулон',60,20,25),
				15 => array('Серьги',60,20,25),						
				16 => array('Заглушка под информацию о персонаже',244,287,5),						
				17 => array('Кольцо №2',20,20,10),
				18 => array('Кольцо №3',20,20,10)						
			);
			
			$data['price'] = $types[$data['type']][3];
				
				
			if($data['price'] > $res['money2']) {
				$ers = 'Ошибка! В казне клана недостаточно Евро-кредитов для приобретения данного изображения.';
			}
			
			if($ers != '') {
				echo '<b style="color:red">'.$ers.'</b><br>';
			}else{
				/* Сохраняем изображение */
				$imgname = md5(rand(0,1000000000000).'&'.rand(0,10000000).'&'.microtime());
				if($file = upload::saveimg('load_image1',0.35,'jpg|png|jpeg|gif',$imgname)) {
					$size = getimagesize ("http://likebk.com/clan_prw/".htmlspecialchars($file[1],NULL,'cp1251')."");
						
					$bag = 0;
												
					if($types[$data['type']][1] != $size[0] || $types[$data['type']][2] != $size[1]) {
						$bag = 1;
					}
										
					mysql_query('INSERT INTO `reimage` (`login`,`uid`,`time`,`src`,`clan`,`type`,`sex`,`animation`,`w`,`h`,`bag`) VALUES (
						"'.$u->info['login'].'",
						"'.$u->info['id'].'","'.time().'",
						"'.mysql_real_escape_string(htmlspecialchars($file[1],NULL,'cp1251')).'",
						"'.$u->info['clan'].'",
						"'.mysql_real_escape_string($data['type']).'",
						"'.mysql_real_escape_string($data['sex']).'",
						"'.mysql_real_escape_string($data['animation']).'",
						"'.mysql_real_escape_string((int)$size[0]).'",
						"'.mysql_real_escape_string((int)$size[1]).'",
						"'.$bag.'"
					)');
					
					$res['money2'] -= $data['price'];
					
					mysql_query('UPDATE `clan` SET `money2` = "'.$res['money2'].'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
					die('<meta http-equiv="refresh" content="0; URL=/main.php?clan&control&gdload">');
				}else{
					echo '<b style="color:red">'.upload::$error.'</b><br>';
				}
			}
		}
		
		?>
        <select name="img_load1type">
      	  <option value="0"><b>Выберите тип изображения</b></option>
      	  <option value="0"><b>Образ</b></option>
      	  <option value="1">- Образ [Размер: 120x220] (100 екр.)</option>
      	  <option value="2">- Заглушка (снизу) [Размер: 120x40] (15 екр.)</option>
      	  <option value="3">- Заглушка (сверху) [Размер: 120x20] (5 екр.)</option>
      	  <option value="0"><b>Слоты под обмундирование</b></option>
      	  <option value="4">- Шлем [Размер: 60x60] (25 екр.)</option>
      	  <option value="5">- Наручи [Размер: 60x40] (25 екр.)</option>
      	  <option value="6">- Левая рука [Размер: 60x60] (25 екр.)</option>
      	  <option value="7">- Правая рука [Размер: 60x60] (25 екр.)</option>
      	  <option value="8">- Броня [Размер: 60x80] (25 екр.)</option>
      	  <option value="9">- Пояс [Размер: 60x40] (25 екр.)</option>
      	  <option value="10">- Ботинки [Размер: 60x40] (25 екр.)</option>
      	  <option value="11">- Поножи [Размер: 60x80] (25 екр.)</option>
      	  <option value="12">- Перчатки [Размер: 60x40] (25 екр.)</option>
      	  <option value="13">- Кольца №1 [Размер: 20x20] (10 екр.)</option>
          <option value="17">- Кольца №2 [Размер: 20x20] (10 екр.)</option>
          <option value="18">- Кольца №3 [Размер: 20x20] (10 екр.)</option>
      	  <option value="14">- Кулон [Размер: 60x20] (25 екр.)</option>
      	  <option value="15">- Серьги [Размер: 60x20] (25 екр.)</option>
      	  <option value="16">Заглушка под информацию о персонаже [Размер: 244x287] (5 екр.)</option>
   	    </select><br />
      	<select name="img_load2type" id="img_load2type">
      	  <option value="0">Анимация (Отключена)</option>
      	  <option>Анимация (Включена)(СТОИМОСТЬ ИЗОБРАЖЕНИЯ УДВАИВАЕТСЯ)</option>
   	    </select><br />
      	<select name="img_load3type" id="img_load3type">
          <option value="-1">Выберите пол</option>
      	  <option value="0">Для мужчин</option>
      	  <option value="1">Для женщин</option>
   	    </select><br />
        <small style="color:red;">Размер изображения не должен привышать 350 кб!</small>
      	<br />
        <input type="file" name="load_image1" id="load_image1" /> <button type="submit">Отправить</button><br />
        <small style="color:red;">Внимание!</small>
        <small> Изображения нарушающие правила игры, <a href="#">правила публикации изображения</a>, либо содержащие элементы оскорбляющие достоинство других людей будут блокироваться без компенсации денежных средств и без возможности замены изображения на новое.</small>
      </form>      
    </fieldset>
    <? } ?>
    <? if($tt[7][0] > 0 && $u->info['clan'] == 17 || $u->info['clan'] == 1) { ?>
<!--     <fieldset>
      <legend><span class="legtitle">Заклятия</span></legend>
<?
/*$p['m1'] = 1;
$srok = array(15=>'15 минут',30=>'30 минут',60=>'один час',180=>'три часа',360=>'шесть часов',720=>'двенадцать часов',1440=>'одни сутки',4320=>'трое суток');
		
if(isset($_GET['usemod']))
{
	if(isset($_POST['usem1']))
	{
		include('moder/usem1.php');					
	}elseif(isset($_POST['teleport']))
	{
		include('moder/teleport.php');
	}
}*/
?>
<table>
<a href="#" onClick="openMod('<b>Заклятие молчания</b>','<form action=\'main.php?<? //echo 'clan=1&control&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Время заклятия: &nbsp; <select style=\'margin-left:2px;\' name=\'time\'><option value=\'5\'>5 минут</option><option value=\'30\'>30 минут</option><option value=\'60\'>1 час</option><option value=\'4320\'>3 суток</option></select> <input type=\'submit\' name=\'usem1\' value=\'Исп-ть\'></form>');"><img src="http://img.likebk.com/i/items/silence30.gif" title="Заклятие молчания" /></a>
&nbsp;
<a onClick="openMod('<b>Телепортация</b>','<form action=\'main.php?<? //echo 'clan=1&control&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\' value=\'<? echo $u->info['login']; ?>\'><br>Город: &nbsp; <select style=\'margin-left:2px;\' name=\'city\'><option value=\'capitalcity\'>capitalcity</option><option value=\'angelscity\'>angelscity</option><option value=\'demonscity\'>demonscity</option><option value=\'devilscity\'>devilscity</option><option value=\'suncity\'>suncity</option><option value=\'emeraldscity\'>emeraldscity</option><option value=\'sandcity\'>sandcity</option><option value=\'mooncity\'>mooncity</option><option value=\'eastcity\'>eastcity</option><option value=\'abandonedplain\'>abandonedplain</option><option value=\'dreamscity\'>dreamscity</option><option value=\'lowcity\'>devilscity</option><option value=\'oldcity\'>devilscity</option><option value=\'newcapitalcity\'>newcapital</option></select> <input type=\'submit\' name=\'teleport\' value=\'Исп-ть\'></form>');" href="#"><img src="http://img.likebk.com/i/items/teleport.gif" title="Телепортация" /></a></table>
    </fieldset> -->
    <? } ?>
    <fieldset>
      <legend><span class="legtitle">Казна клана</span></legend>
      <form method="post" action="?clan&control&give_money">
      Деньги в казне клана: <?=$res['money1']?> кр. <? if($res['money2'] > 0) { ?><br />
      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?=$res['money2']?> екр. <input type="button" value="Список операций" /><? } ?><br />
      <? if($tt[7][0] > 0) { ?>
      Забрать из казны: <input id="svb_give_money" name="svb_give_money" value="0" type="text" /> <input type="submit" value=">>" />
      <? } ?>
      </form>
      <? if($tt[6][0] > 0) { ?>
      <form method="post" action="?clan&control&take_money">
      <div style="border-top:1px solid #cac9c7;margin-top:5px;padding-top:5px;">
      Положить деньги в казну: <input id="svb_take_money" name="svb_take_money" value="0" type="text" /> <input type="submit" value=">>" />
      <small>(при себе: <?=$u->info['money']?>кр.)</small>
      </div>
      </form>
      <? } ?>
    </fieldset>
	<? } ?>
      <? if($tt[11][0] > 0 && $tt[3][0] == 1) { ?>
      <form method="post" action="?clan&control#vipiska">
      <div style="margin-top:5px;padding-top:5px;">
      Заказать выписку для хранилища: <small>(услуга стоит 1кр.)</small> <input id="svb_vipiska" name="svb_vipiska" value="<?=date('d.m.Y')?>" type="text" /> <input type="submit" value="Заказать" />
      </div>
      </form>
      <? } ?>
      <?php if(isset($_POST['svb_vipiska'])){
		$sees = '';
		$t = 0;
		$updates = mysql_query('UPDATE `users` SET `money` = `money` - 1 WHERE `id` = "'.$u->info['id'].'"');
		if($updates){
			$dsee['t1'] = strtotime($_POST['svb_vipiska'].' 00:00:00');
			$dsee['t2'] = strtotime($_POST['svb_vipiska'].' 23:59:59');
			$sp1 = mysql_query('SELECT * FROM `clan_operations` WHERE  `clan` = "'.$res['id'].'" AND `time` >= "'.$dsee['t1'].'" AND `time` <= "'.$dsee['t2'].'" ORDER BY `time` ASC LIMIT 10000');
			echo '<div id="vipiska"><hr/>';
			echo '<h3 style="color: #8f0000; text-align: left;">Выписка за '.$_POST['svb_vipiska'].'</h3>';
			echo '<hr/>';
			while($pl1 = mysql_fetch_array($sp1))
			{
				$t = 1;
				$pl1['text'] = ' Персонаж '.$pl1['text'].' ';
				if( $pl1['type'] == 1 ) {
					$pl1['text'] .= '<b>снял кредиты</b> с казны клана: '.$pl1['val'].' кр.';
				}elseif( $pl1['type'] == 2 ) {
					$pl1['text'] .= '<b>положил кредиты</b> в казну клана: '.$pl1['val'].' кр.';
				}elseif( $pl1['type'] == 5 ) {
					$pl1['text'] .= '<b>взял</b> предмет &quot;'.$pl1['val'].'&quot; из хранилища клана.';
				}elseif( $pl1['type'] == 4 ) {
					$pl1['text'] .= '<b>пожертвовал</b> предмет &quot;'.$pl1['val'].'&quot; в хранилище клана.';
				}elseif( $pl1['type'] == 7 ) {
					$pl1['text'] .= '<b>получил</b> предмет &quot;'.$pl1['val'].'&quot; из хранилища клана. (Самостоятельный выход)';
				}elseif( $pl1['type'] == 8 ) {
					$pl1['text'] .= '<b>получил</b> предмет &quot;'.$pl1['val'].'&quot; из хранилища клана. (Был изгнан из клана)';
				}elseif( $pl1['type'] == 3 ) {
					$pl1['text'] .= '<b>вернул</b> предмет &quot;'.$pl1['val'].'&quot; в хранилища клана.';
				} elseif( $pl1['type'] == 6 ) {
					$pl1['text'] .= '<b>изъял</b> предмет &quot;'.$pl1['val'].'&quot;.';
				} elseif( $pl1['type'] == 9 ) {
					$pl1['text'] .= '<b>вернул</b> предмет &quot;'.$pl1['val'].'&quot;. [Выход из клана (Возврат вещей не пренадлежащих персонажу)]';
				}else{
					$pl1['text'] .= '<u>Незивестная ошибка. Код: '.$pl1['val'].' / '.$pl1['type'].'</u>';
				}
				$dsee['dv'] .= '<small>'.date('d.m.Y H:i',$pl1['time']).' / <b style="color:green">Выписка клана</b>:</small>'.$pl1['text'].' '.$dseetext;
				$dsee['dv'] .= '<br>';
				$dseetext="";
			}
			if($t == 0) {
				echo '<font color="red"><b>Действий за <B>'.$_POST['svb_vipiska'].'</B> не найдено.</b></font><br><br></div>';
			}else{
				echo $dsee['dv'].'</div>';
			}
		}
	}?>
   </div> 
   <?
   }elseif(isset($_GET['gral'])) {
	   
	   if( isset($_GET['repadd'])) {
		 if( $u->rep['nagrada'] >= 1000 ) {
			 $u->rep['nagrada'] -= 1000;
			 mysql_query('UPDATE `rep` SET `nagrada` = `nagrada` - 1000 WHERE `id` = "'.$u->rep['id'].'" LIMIT 1');
			 $res['gral'] += 1000;
			 mysql_query('UPDATE `clan` SET `gral` = `gral` + 1000 WHERE `id` = "'.$res['id'].'" LIMIT 1');
			 echo '<br><br><font color="red">Грааль клана увеличена на 1000 ед.! Спасибо!</font>';
		 }else{
			 echo '<br><br><font color="red">Недостаточно репутации! Необходимо 1000 ед.!</font>';
		 }
	   }
	   
	  $glvl = 0;
	  $gexp = 1000000;
	  if( $res['gral'] >= 1000000 ) {
		 $glvl = 1; 
		 $gexp = '??';
	  }
	?>
    <br><br>
    
    <br><b>&bull; Уровень Грааля:</b> <?=$glvl?> ( <?=$res['gral']?> / <?=$gexp?>) <? if( $u->rep['nagrada'] > 1000 ) { ?><a href="/main.php?clan&gral&repadd=1">Пожертвовать 1000 репутации</a> (у Вас <?=$u->rep['nagrada']?> ед.) <? }else{ echo ' (Для пожертвования необходимо 1000 репутации. Недостаточно)'; }?>
    <br><br>
    <fieldset>
      <legend><span class="legtitle">Бонусы от Грааля</span></legend>
	<?
		if( $glvl == 0 ) {
			echo '<center>Вам необходимо набрать хотя бы 1 уровень Грааля!</center>';
		}else{
			
			$gitm = '';
			$gtxt = '';
			
			if( $glvl == 1 ) {
				
				if(isset($_GET['gtake'])) {
					
					if( $_GET['gtake'] == 1 ) { //Отвар когтей ПГ
						$itmx = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = 4468 AND `inShop` = 0 AND `delete` = 0 LIMIT 1'));
						$test = mysql_fetch_array(mysql_query('SELECT * FROM `actions` WHERE `vars` = "pg_'.date('d.m.Y').'_'.$u->info['id'].'" LIMIT 1'));
						if(isset($test['id'])) {
							$gtxt = 'Отвар можно взять один раз в сутки...';
						}elseif( $itmx[0] < 5 ) {
							$gtxt = 'Недостаточно Клыков ПГ! Необходимо 5 шт., а у Вас '.$itmx[0].' шт.!';
						}else{
							$additm = $u->addItem(10150,$u->info['id'],'|nosale=1|srok=86400|notransfer=1|sudba=1');
							mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = 4468 AND `inShop` = 0 AND `delete` = 0 LIMIT 5');
							$gtxt = 'Вы успешно обменяли 5 Клыков ПГ на Отвар Когтей Пг! Он находится у Вас в инвентаре!';
							mysql_query('INSERT INTO `actions` (`vars`) VALUES ("pg_'.date('d.m.Y').'_'.$u->info['id'].'")');
						}
					}elseif( $_GET['gtake'] == 2 ) { //Мягкая поступь на 30 мин за 1 грибочек
						$itmx = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = 2856 AND `inShop` = 0 AND `delete` = 0 LIMIT 1'));
						if( $itmx[0] < 1 ) {
							$gtxt = 'Недостаточно Грибочков! Необходимо 1 шт., а у Вас '.$itmx[0].' шт.!';
						}else{
							
							$post = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `name` LIKE "%Мягкая поступь%" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1'));
							if(!isset($post['id'])) {
								//$gtxt = 'На Вас нет каста Мягкой Поступи! Сначала обкастуйтесь!';
								mysql_query("
								
								INSERT INTO `eff_users` (
									`id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`,
									`user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`,
									`deactiveTime`, `deactiveLast`, `endbattle`, `mark`, `bs`, `endtime`, `endfx`
								) VALUES (
									311, ".$u->info['id'].", 'Мягкая Поступь [5]', 'add_speed_dungeon=60', 36, ".(time()-(86400*5 - 30*60)).", 0, '0',
									0, '0', 0, '', 1, -1, '0', 0, 1, '', 0, 0, 0, 0, 1, 0, 0, 0);
								
								");
							}else{	
								mysql_query('UPDATE `eff_users` SET `timeUse` = `timeUse` + 1800 WHERE `id` = "'.$post['id'].'" LIMIT 1');						
							}
							mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = 2856 AND `inShop` = 0 AND `delete` = 0 LIMIT 1');
							$gtxt = 'Вы успешно обменяли 1 грибочек на +30 минут мягкой поступи!';
						}
					}elseif( $_GET['gtake'] == 3 ) { //+50% к клановому опыту на 24 ч.
						$itmx = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = 3056 AND `inShop` = 0 AND `delete` = 0 LIMIT 1'));
						if( $itmx[0] < 10 ) {
							$gtxt = 'Недостаточно Золотых монет! Необходимо 10 шт., а у Вас '.$itmx[0].' шт.!';
						}else{
							if( $res['bonustime'] > time() ) {
								$gtxt = 'Нельзя использовать повторно! Следующий раз можно через '.$u->timeOut($res['bonustime']-time()).'!';
							}else{
								
								$res['bonustime'] = time()+86400;
								
								mysql_query('UPDATE `clan` SET `bonustime` = "'.$res['bonustime'].'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
								
								mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = 3056 AND `inShop` = 0 AND `delete` = 0 LIMIT 10');
								$gtxt = 'Вы успешно обменяли 10 Золотых монет на бонус +50% опыта на 24 часа!';
							}
						}
					}
				}
				
				if( $res['bonustime'] > 0 ) {
					$gtxt .= '<div><font color="green"><b>Активирован бонус +50% кланового опыта! Будет действовать еще '.$u->timeOut($res['bonustime']-time()).'!</b></font></div>';
				}
							
				$gitm .= '<a title="Обменять 5 Клыков ПГ на 1 Отвар когтей ПГ" href="/main.php?clan&gral&gtake=1"><img height="25" src="http://img.likebk.com/i/items/invoke_kar3_potpg.gif"></a> ';
					
				$gitm .= '<a title="Обменять 1 Грибочек на 30 минут Мягкой Поступи!" href="/main.php?clan&gral&gtake=2"><img height="25" src="http://img.likebk.com/i/items/invoke_movespeed_dungeon60_5.gif"></a> ';
			
				$gitm .= '<a title="Обменять 10 Золотых монет на +50% бонус получения кланового опыта" href="/main.php?clan&gral&gtake=3"><img height="25" src="http://img.likebk.com/i/items/new_reg.gif"></a> ';
			
			
			}
			
			if( $gtxt != '' ) {
				echo '<div style="color:red">'.$gtxt.'<br><br></div>';
			}
			echo $gitm;
			
		}
	?>
    </fieldset>    
	<?
   }elseif(isset($_GET['diplom']) && $tt[12][0] == 1) {
	
	if($tt[14][0] == 1){
		if(isset($_GET['clanwars'])) {
			//RadioGroup1
			$cln = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `name` = "'.mysql_real_escape_string($_POST['logingo']).' " OR `name` = " '.mysql_real_escape_string($_POST['logingo']).' " OR `name` = "'.mysql_real_escape_string($_POST['logingo']).'" OR `name` = " '.mysql_real_escape_string($_POST['logingo']).'" OR `name_mini` = "'.mysql_real_escape_string($_POST['logingo']).'" OR `name_rus` = "'.mysql_real_escape_string($_POST['logingo']).'" LIMIT 1'));
			if(isset($cln['id'])) {
				if($cln['id'] == $res['id']) {
					
					$rn = array(
					'<font color="#FF0000"><b>Остроумно, но здесь так делать нельзя :-)</b></font><br>',
					'<font color="#FF0000"><b>Это будет очень сложно сделать, Ваши сокланы против!</b></font><br>',
					'<font color="#FF0000"><b>Не уподобляйтесь большинству, защищайте интересы своего клана!</b></font><br>');					
					echo $rn[rand(0,2)];				
				}elseif($cln['join1'] == $res['join1'] && $res['join1'] > 0) {
					echo '<font color="#FF0000"><b>Вы состоите в союзе с этим кланом</b></font><br>';				
				}elseif($cln['join2'] == $res['join2'] && $res['join2'] > 0) {
					echo '<font color="#FF0000"><b>Вы состоите в альянсе с этим кланом</b></font><br>';		
				}else{
					$lwar = mysql_fetch_array(mysql_query('SELECT * FROM `clan_wars` WHERE `time_finish` > '.time().' AND ((`clan1` = "'.$cln['id'].'" AND `clan2` = "'.$res['id'].'") OR (`clan2` = "'.$cln['id'].'" AND `clan1` = "'.$res['id'].'")) LIMIT 1 '));
					if(!isset($lwar['id'])) {
						$mkr = 100+500; $tpcw = 1;
						if($_POST['RadioGroup1'] == 2) {
							$mkr = 300+500; $tpcw = 2;
						}
						/*if( true == true ) {
							echo '<font color="#FF0000"><b>Нельзя обьявить войну прямо сейчас</b></font><br>';
						}else*/if($mkr > $res['money1']) {
							echo '<font color="#FF0000"><b>В казне клана не достаточно средств</b></font><br>';
						}else{
							mysql_query('UPDATE `clan` SET `money1` = `money1` - '.$mkr.' WHERE `id` = "'.$res['id'].'" LIMIT 1');
							//
							mysql_query('INSERT INTO `clan_wars` (`clan1`,`clan2`,`time_start`,`time_finish`,`type`,`text`) VALUES ("'.$res['id'].'","'.$cln['id'].'","'.time().'","'.(time()+60*60*24*1).'","'.$tpcw.'","Война!")');
							if($res['join1'] > 0) {
							
								$sp1 = mysql_query('SELECT `clan` FROM `clan_join` WHERE `alians` = "'.$res['join1'].'" AND `clan` != "'.$res['id'].'" AND `time_start` > 0');
								while( $pl1 = mysql_fetch_array($sp1) ) {
									mysql_query('INSERT INTO `clan_wars` (`clan1`,`clan2`,`time_start`,`time_finish`,`type`,`text`) VALUES ("'.$pl1['clan'].'","'.$cln['id'].'","'.time().'","'.(time()+60*60*24*1).'","'.$tpcw.'","Война! (Союз)")');
								}
							
							}
							//
							mysql_query('INSERT INTO `clan_operations` (`clan`,`time`,`type`,`text`,`val`,`uid`) VALUES ("'.$res['id'].'","'.time().'","4","'.$u->info['login'].'","clanwar_'.$mkr.'_'.$cln['id'].'","'.$u->info['id'].'")');
							echo '<font color="#FF0000"><b>Вы успешно обьявили войну клану &quot;'.$cln['name'].'&quot; за '.$mkr.' кр.</b></font><br>';
						}
					}else{
						echo '<font color="#FF0000"><b>Вы уже ведете войну с данным кланом</b></font><br>';
					}
				}
			}else{
				echo '<font color="#FF0000"><b>Клан с таким названием не найден</b></font><br>';
			}
		}
	}
	
   ?>
    <br /><br />
    <fieldset>
      <legend><span class="legtitle">Клановые войны</span></legend>
      <? if($tt[14][0] == 1){ ?>
      <input onClick="openMod('<b>Объявить войну клану</b>','<form action=\'main.php?clan&diplom&clanwars\' method=\'post\'>Название клана: <input type=\'text\' style=\'width:244px;\' id=\'logingo\' name=\'logingo\'><br><label><input type=\'radio\' name=\'RadioGroup1\' value=\'1\' id=\'RadioGroup1_0\'>Обычная война (600 кр.)</label><br><span style=\'float:left\'><label><input type=\'radio\' name=\'RadioGroup1\' value=\'2\' id=\'RadioGroup1_1\'>Кровавая война (800кр.)</label></span><input style=\'float:right;\' type=\'submit\' name=\'invite\' value=\'Принять\'></form>');" type="submit" name="button" id="button" value="Начать войну" />
      <? } ?>
      <br />
      <div style="border:1px solid #CECECE;padding:10px;">
      <?
	  $ms = '';
	  $sp = mysql_query('SELECT * FROM `clan_wars` WHERE (`clan1` = "'.$res['id'].'" OR `clan2` = "'.$res['id'].'") AND `time_finish` > "'.time().'"');
	  while($pl = mysql_fetch_array($sp)) {
		  $cln1 = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$pl['clan1'].'" LIMIT 1'));
		  $cln2 = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$pl['clan2'].'" LIMIT 1'));
		  $ms .= '<div style="border:1px solid #CECECE;padding:10px;">Война между кланами <b><img style="vertical-align:bottom" src="http://img.likebk.com/i/clan/'.$cln1['name_mini'].'.gif">'.$cln1['name'].'</b> и <b><img style="vertical-align:bottom" src="http://img.likebk.com/i/clan/'.$cln2['name_mini'].'.gif">'.$cln2['name'].'</b>.<br>';
		  if($pl['text'] != '') {
			$ms .= 'Причина войны: <i>'.$pl['text'].'</i><br>';  
		  }
		  $ms .= 'Время войны: '.date('d.m.Y H:i',$pl['time_start']).' - '.date('d.m.Y H:i',$pl['time_finish']).'</div>';
	  }
	  if($ms == '') {
	  ?>
      	В данный момент Ваш клан не ведет войн.
      <?
	  }else{
		 echo $ms; 
	  }
	  ?>
      </div>
    </fieldset>
  <fieldset style="display:none">
    <legend><span class="legtitle">Союзы и альянсы</span></legend>
      <? $tt[13][0] = 0; if($tt[13][0] == 1) {
	  if(isset($_GET['joint']) && $tt[13][0] == 1) {
		  if($_GET['joint'] == 1) {
			 //вступление в союз
			  $nm = htmlspecialchars($_POST['logingo'],NULL,'cp1251');
			  $cnm = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `name` = "'.mysql_real_escape_string($nm).'" AND `type` = "1" LIMIT 1'));
			  if(isset($cnm['id'])) {
				$cnmz = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `alians` = "'.$cnm['id'].'" AND `clan` = "'.$res['id'].'" AND `time_end` = "0" AND `time_start` = "0" AND `type` = "1" LIMIT 1'));
				$test = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_join` WHERE `alians` = "'.$cnm['id'].'" LIMIT 1'));
				$test = $test[0];
				if( $test >= 3 ) {
					echo '<font color="#FF0000"><b>В союзе не может быть более 3 кланов!</b></font><br>';
				}elseif(isset($cnmz['id'])) {
					echo '<font color="#FF0000"><b>Ваш клан уже подал заявку в данный союз</b></font><br>';
				}elseif($res['join1'] > 0) {
					echo '<font color="#FF0000"><b>Ваш клан уже находится в союзе</b></font><br>'; 
				}else{
					mysql_query('DELETE FROM `clan_join` WHERE `clan` = "'.$res['id'].'"');
					mysql_query('UPDATE `clan` SET `join1` = "'.$cnm['id'].'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
					echo '<font color="#FF0000"><b>Вы успешно подали заявку в союз &quot;'.$cnm['name'].'&quot;</b></font><br>';
					mysql_query('INSERT INTO `clan_join` (`clan`,`alians`,`time`,`type`) VALUES ("'.$res['id'].'","'.$cnm['id'].'","'.time().'","1")');
				}
			  }else{
				 echo '<font color="#FF0000"><b>Альянс или союз с такиим названием не существует</b></font><br>'; 
			  }
		  }else{
			 //вступление в альянс
			  $nm = htmlspecialchars($_POST['logingo'],NULL,'cp1251');
			  $cnm = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `name` = "'.mysql_real_escape_string($nm).'" AND `type` = "2" LIMIT 1'));
			  if(isset($cnm['id'])) {
				$cnmz = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `alians` = "'.$cnm['id'].'" AND `clan` = "'.$res['id'].'" AND `time_end` = "0" AND `time_start` = "0" AND `type` = "2" LIMIT 1'));
				if(isset($cnmz['id'])) {
					echo '<font color="#FF0000"><b>Ваш клан уже подал заявку в данный альянс</b></font><br>';
				}elseif($res['join1'] == 0) {
					echo '<font color="#FF0000"><b>Для вступления в альянс требуется вступить в союз</b></font><br>'; 
				}elseif($res['join2'] > 0) {
					echo '<font color="#FF0000"><b>Ваш клан уже находится в альянсе</b></font><br>'; 
				}else{
					mysql_query('UPDATE `clan` SET `join2` = "'.$cnm['id'].'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
					echo '<font color="#FF0000"><b>Вы успешно подали заявку в альянс &quot;'.$cnm['name'].'&quot;</b></font><br>';
					mysql_query('INSERT INTO `clan_join` (`clan`,`alians`,`time`,`type`) VALUES ("'.$res['id'].'","'.$cnm['id'].'","'.time().'","2")');
				}
			  }else{
				 echo '<font color="#FF0000"><b>Альянс или союз с такиим названием не существует</b></font><br>'; 
			  }
		  }
	  }elseif(isset($_GET['newjoint']) && $tt[13][0] == 1) {
		if($_GET['newjoint'] == 1) {
			//союзы
			if($res['join1'] > 0) {
				echo '<font color="#FF0000"><b>Ваш клан уже состоит в союзе</b></font><br>';
			}else{
				$nm = htmlspecialchars($_POST['logingo'],NULL,'cp1251');
				if(str_replace(' ','',str_replace('	','',$nm)) == '') {
					echo '<font color="#FF0000"><b>Введите название союза</b></font><br>';
				}else{
					$cnm = mysql_fetch_array(mysql_query('SELECT `id` FROM `clan_joint` WHERE `name` = "'.mysql_real_escape_string($nm).'" LIMIT 1'));
					if(!isset($cnm['id'])) {
						mysql_query('DELETE FROM `clan_join` WHERE `clan` = "'.$res['id'].'"');
						mysql_query('INSERT INTO `clan_joint` (`time_open`,`name`,`type`,`clan_open`,`clan_glava`) VALUES ("'.time().'","'.mysql_real_escape_string($nm).'","1","'.$res['id'].'","'.$res['id'].'")');
						$id = mysql_insert_id();
						$res['join1'] = $id;
						mysql_query('INSERT INTO `clan_join` (`clan`,`alians`,`time`,`type`,`time_start`) VALUES ("'.$res['id'].'","'.$id.'","'.time().'","1","'.time().'")');
						mysql_query('UPDATE `clan` SET `join1` = "'.$id.'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
						echo '<font color="#FF0000"><b>Вы успешно создали союз &quot;'.$nm.'&quot;</b></font><br>';
					}else{
						echo '<font color="#FF0000"><b>Альянс или союз с такиим названием уже существует</b></font><br>';
					}
				}
			}
		}else{
			//альянсы
			if($res['join1'] == 0) {
				echo '<font color="#FF0000"><b>Ваш клан должен состоять в союзе</b></font><br>';
			}elseif($res['join2'] > 0) {
				echo '<font color="#FF0000"><b>Ваш клан уже состоит в альянсе</b></font><br>';
			}else{
				$nm = htmlspecialchars($_POST['logingo'],NULL,'cp1251');
				if(str_replace(' ','',str_replace('	','',$nm)) == '') {
					echo '<font color="#FF0000"><b>Введите название альянса</b></font><br>';
				}else{
					$cnm = mysql_fetch_array(mysql_query('SELECT `id` FROM `clan_joint` WHERE `name` = "'.mysql_real_escape_string($nm).'" LIMIT 1'));
					if(!isset($cnm['id'])) {
						mysql_query('INSERT INTO `clan_joint` (`time_open`,`name`,`type`,`clan_open`,`clan_glava`) VALUES ("'.time().'","'.mysql_real_escape_string($nm).'","2","'.$res['id'].'","'.$res['id'].'")');
						$id = mysql_insert_id();
						$res['join2'] = $id;
						mysql_query('INSERT INTO `clan_join` (`clan`,`alians`,`time`,`type`,`time_start`) VALUES ("'.$res['id'].'","'.$id.'","'.time().'","2","'.time().'")');
						mysql_query('UPDATE `clan` SET `join2` = "'.$id.'" WHERE `id` = "'.$res['id'].'" LIMIT 1');
						echo '<font color="#FF0000"><b>Вы успешно создали альянс &quot;'.$nm.'&quot;</b></font><br>';
					}else{
						echo '<font color="#FF0000"><b>Альянс или союз с такиим названием уже существует</b></font><br>';
					}
				}
			}
		}
	  }elseif(isset($_GET['cancel']) && $tt[13][0] == 1) {
		 $zvn = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `id` = "'.mysql_real_escape_string($_GET['cancel']).'" AND `time_start` = "0" AND `time_end` = "0" LIMIT 1')); 
		 if(!isset($zvn['id'])) {
			 echo '<font color="#FF0000"><b>Заявка на вступление не найдена</b></font><br>';
		 }else{
			 $rzv = '';
			if($zvn['clan'] == $res['id']) {
				//отмена присоединения
				$szu = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$zvn['alians'].'" LIMIT 1'));
				if($szu['type'] == 1) {
					mysql_query('UPDATE `clan` SET `join1` = 0 WHERE `id` = "'.$res['id'].'" LIMIT 1');
					$rzv = 'Клан <b><img style="vertical-align:bottom" src="http://img.likebk.com/i/clan/'.$res['name_mini'].'.gif">'.$res['name'].'</b> отказался от присоединения к союзу <b>'.$szu['name'].'</b>.';
				}else{
					mysql_query('UPDATE `clan` SET `join2` = 0 WHERE `id` = "'.$res['id'].'" LIMIT 1');
					$rzv = 'Клан <b><img style="vertical-align:bottom" src="http://img.likebk.com/i/clan/'.$res['name_mini'].'.gif">'.$res['name'].'</b> отказался от присоединения к альянсу <b>'.$szu['name'].'</b>.';
				}
			}elseif($zvn['alians'] == $res['join1']) {
				//отказ в присоединении к союзу
				$szu = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$zvn['alians'].'" LIMIT 1'));
				$zvy = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$zvn['clan'].'" LIMIT 1'));
				$rzv = 'Союз <b>'.$szu['name'].'</b> отказал клану <b><img style="vertical-align:bottom" src="http://img.likebk.com/i/clan/'.$zvy['name_mini'].'.gif">'.$zvy['name'].'</b> в присоединении.';
			}elseif($zvn['alians'] == $res['join2']) {
				//отказ в присоединении к альянсу
				$szu = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$zvn['alians'].'" LIMIT 1'));
				$zvy = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$zvn['clan'].'" LIMIT 1'));
				$rzv = 'Альянс <b>'.$szu['name'].'</b> отказал клану <b><img style="vertical-align:bottom" src="http://img.likebk.com/i/clan/'.$zvy['name_mini'].'.gif">'.$zvy['name'].'</b> в присоединении.';
			}
			if($rzv != '') {
				echo '<font color="#FF0000"><b>'.$rzv.'</b></font><br>';
				//mysql_query('UPDATE `clan_join` SET `time_end` = "'.time().'" WHERE `id` = "'.$zvn['id'].'"');
				mysql_query('DELETE FROM `clan_join` WHERE `id` = "'.$zvn['id'].'"');
			}
		 }
	  }elseif(isset($_GET['ok']) && $tt[13][0] == 1) {
		 $zvn = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `id` = "'.mysql_real_escape_string($_GET['ok']).'" AND `time_start` = "0" AND `time_end` = "0" LIMIT 1')); 
		 if(!isset($zvn['id'])) {
			 echo '<font color="#FF0000"><b>Заявка на вступление не найдена</b></font><br>';
		 }else{
			 $rzv = '';
			if($zvn['alians'] == $res['join1']) {
				//присоединение к союзу
				$szu = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$zvn['alians'].'" LIMIT 1'));
				$zvy = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$zvn['clan'].'" LIMIT 1'));
				$rzv = 'Союз <b>'.$szu['name'].'</b> принял клан <b><img style="vertical-align:bottom" src="http://img.likebk.com/i/clan/'.$zvy['name_mini'].'.gif">'.$zvy['name'].'</b>.';
				//mysql_query('UPDATE `clan_join` SET `time_end` = "'.time().'" WHERE `id` != "'.$zvn['id'].'" AND `clan` = "'.$szu['clan'].'" AND `type` = "1"');
				mysql_query('DELETE FROM `clan_join` WHERE `id` != "'.$zvn['id'].'" AND `clan` = "'.$szu['clan'].'" AND `type` = "1"');
				//mysql_query('INSERT INTO `clan_join` (`clan`,`alians`,`time`,`type`) VALUES ("'.$res['id'].'","'.$szu['id'].'","'.time().'","1")');
				mysql_query('UPDATE `clan` SET `join1` = "'.$zvn['alians'].'" WHERE `id` = "'.$szu['id'].'"');
			}elseif($zvn['alians'] == $res['join2']) {
				//присоединение к альянсу
				$szu = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$zvn['alians'].'" LIMIT 1'));
				$zvy = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$zvn['clan'].'" LIMIT 1'));
				$rzv = 'Альянс <b>'.$szu['name'].'</b> принял клан <b><img style="vertical-align:bottom" src="http://img.likebk.com/i/clan/'.$zvy['name_mini'].'.gif">'.$zvy['name'].'</b>.';
				//mysql_query('UPDATE `clan_join` SET `time_end` = "'.time().'" WHERE `id` != "'.$zvn['id'].'" AND `clan` = "'.$szu['clan'].'" AND `type` = "2" AND `time_end` = "0"');
				mysql_query('DELETE FROM `clan_join` WHERE `id` != "'.$zvn['id'].'" AND `clan` = "'.$szu['clan'].'" AND `type` = "2" AND `time_end` = "0"');
				//mysql_query('INSERT INTO `clan_join` (`clan`,`alians`,`time`,`type`) VALUES ("'.$res['id'].'","'.$szu['id'].'","'.time().'","2")');
				mysql_query('UPDATE `clan` SET `join2` = "'.$zvn['alians'].'" WHERE `id` = "'.$szu['id'].'"');
			}
			if($rzv != '') {
				echo '<font color="#FF0000"><b>'.$rzv.'</b></font><br>';
				mysql_query('UPDATE `clan_join` SET `time_start` = "'.time().'" WHERE `id` = "'.$zvn['id'].'"');
			}
		 }
	  }
	  ?>
      <? if($res['join1'] == 0 && $res['level'] > 0) { ?>
      <input type="submit" name="button" id="button" value="Создать союз" onClick="openMod('<b>Создать союз</b>','<form action=\'main.php?clan&diplom&newjoint=1\' method=\'post\'>Название: <input type=\'text\' style=\'width:244px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'invite\' value=\'Принять\'></form>');" />
      <input type="submit" name="button" id="button" value="Присоединиться к союзу" onClick="openMod('<b>Присоединиться к союзу</b>','<form action=\'main.php?clan&diplom&joint=1\' method=\'post\'>Название: <input type=\'text\' style=\'width:244px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'invite\' value=\'Принять\'></form>');" />
      <? }elseif( $res['join1'] > 0 ) {
		  
		  $j1 = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$res['join1'].'" LIMIT 1'));
		  $j1_j = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `alians` = "'.$res['join1'].'" AND `clan` = "'.$res['id'].'" LIMIT 1'));
		  if(isset($j1['id']) && $j1['clan_glava'] == $res['id'] && $u->info['clan_prava'] == 'glava') {
			  if(isset($_GET['endjoint'])) {
				  mysql_query('UPDATE `clan` SET `join1` = 0 WHERE `join1` = "'.$res['join1'].'"');
				  mysql_query('DELETE FROM `clan_join` WHERE `alians` = "'.$res['join1'].'"');
				  mysql_query('DELETE FROM `clan_joint` WHERE `id` = "'.$res['join1'].'"');
				  echo '<div><font color=red><b>Союз был расформирован!</b></font></div>'; 
			  }else{
			 ?>
			 <input type="submit" name="button" id="button" value="Распустить союз" onClick="location.href='main.php?clan&diplom&endjoint'">
			 <? 
			  }
		  }elseif(!isset($j1_j['id'])) {
			 mysql_query('UPDATE `clan` SET `join1` = 0 WHERE `join1` = "'.$res['join1'].'"');
		  }
		  
	  }
	  
	  $test1 = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `type` = 2 AND `clan` = "'.$res['id'].'" AND `alians` = "'.$res['join2'].'" LIMIT 1'));
	  if(!isset($test1['id'])) {
		 $res['join2'] = 0;
		 mysql_query('UPDATE `clan` SET `join2` = 0 WHERE `id` = "'.$res['id'].'" LIMIT 1'); 
	  }
	  
	  if($res['join2'] == 0 && $res['level'] > 0) { ?>
      <input type="submit" name="button" id="button" value="Присоединиться к альянсу" onClick="openMod('<b>Присоединиться к альянсу</b>','<form action=\'main.php?clan&diplom&joint=2\' method=\'post\'>Название: <input type=\'text\' style=\'width:244px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'invite\' value=\'Принять\'></form>');" />
      <input type="submit" name="button" id="button" value="Создать альянс" onClick="openMod('<b>Создать альянс</b>','<form action=\'main.php?clan&diplom&newjoint=2\' method=\'post\'>Название: <input type=\'text\' style=\'width:244px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'invite\' value=\'Принять\'></form>');" />      
      <br /><br /><? } ?><? }elseif( $res['join2'] > 0 ) {
		  
		  $j1 = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$res['join2'].'" LIMIT 1'));
		  $j1_j = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `alians` = "'.$res['join2'].'" AND `clan` = "'.$res['id'].'" LIMIT 1'));
		  if(isset($j1['id']) && $j1['clan_glava'] == $res['id'] && $u->info['clan_prava'] == 'glava') {
			  if(isset($_GET['endjoint2'])) {
				  mysql_query('UPDATE `clan` SET `join2` = 0 WHERE `join1` = "'.$res['join2'].'"');
				  mysql_query('DELETE FROM `clan_join` WHERE `alians` = "'.$res['join2'].'"');
				  mysql_query('DELETE FROM `clan_joint` WHERE `id` = "'.$res['join2'].'"');
				  echo '<div><font color=red><b>Альянс был расформирован!</b></font></div>'; 
			  }else{
			 ?>
			 <input type="submit" name="button" id="button" value="Распустить альянс" onClick="location.href='main.php?clan&diplom&endjoint2'">
			 <? 
			  }
		  }elseif(!isset($j1_j['id'])) {
			 mysql_query('UPDATE `clan` SET `join2` = 0 WHERE `join2` = "'.$res['join2'].'"');
		  }
		  
	  } ?>
      <div style="border:1px solid #CECECE;padding:10px;">
      	<? 
		$ms = '';
		
		//Собственные союзы и альянсы		
		if($res['join1'] > 0 && isset($res['join1pl']['id'])) {
			$j1 = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$res['join1'].'" LIMIT 1'));
			if(isset($j1['id'])) {
				$ms .= '<div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">';
				$ms .= 'Вы состоите в клановом союзе <b>'.$j1['name'].'</b>.';
				if( $j1['clan_glava'] != $res['id'] ) { 
					$ms .= ' <a href="main.php?clan&diplom&delclanme=1"><img title="Покинуть союз" width="13" height="13" src="http://img.likebk.com/i/clear.gif"></a>';
				}
				$ms .= '<Br>Состав союза: ';
				//$ms .= '<a href="javascript:void(0)"><img style="vertical-align:bottom" src="http://img.likebk.com/i/clan/'.$res['name_mini'].'.gif">'.$res['name'].'</a>';
				$i = 0;
				if( isset($_GET['delclanme']) ) {
					if( $j1['clan_glava'] != $res['id'] && ($u->info['clan_prava'] == 'glava' || $u->info['admin'] > 0) ) { 
						$dels = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `clan` = "'.$res['id'].'" AND `alians` = "'.$j1['id'].'" AND `time_end` = "0" AND `time_start` > 0 LIMIT 1'));
						if(isset($dels['id'])) {
							mysql_query('UPDATE `clan` SET `join1` = "0" WHERE `id` = "'.$res['id'].'" LIMIT 1');
							//mysql_query('UPDATE `clan_join` SET `time_end` = "'.time().'" WHERE `id` = "'.$dels['id'].'" LIMIT 1');
							mysql_query('DELETE FROM `clan_join` WHERE `id` = "'.$dels['id'].'" LIMIT 1');
							echo '<div><b><font color=red>Вы успешно покинули союз &quot;'.$j1['name'].'&quot;</font></b></div>';
							header('location: main.php?clan&diplom');
						}else{
							mysql_query('UPDATE `clan` SET `join1` = "0" WHERE `id` = "'.$res['id'].'" LIMIT 1');
							mysql_query('DELETE FROM `clan_join` WHERE `id` = "'.$dels['id'].'" LIMIT 1');
							echo '<div><b><font color=red>Вы успешно покинули союз &quot;'.$j1['name'].'&quot;</font></b></div>';
						
						}
					}else{
						echo '<div><b><font color=red>Вы не можете покинуть данный союз</font></b></div>';
					}
				}elseif( $j1['clan_glava'] == $res['id'] && ($u->info['clan_prava'] == 'glava' || $u->info['admin'] > 0) ) {
					if( isset($_GET['delclan']) ) {
						$delc = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.mysql_real_escape_string($_GET['delclan']).'" LIMIT 1'));
						$dels = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `clan` = "'.$delc['id'].'" AND `alians` = "'.$j1['id'].'" AND `time_end` = "0" AND `time_start` > 0 LIMIT 1'));
						
						if( isset($delc['id']) && isset($dels['id']) ) {
							if( $delc['id'] != $res['id'] ) {
								mysql_query('UPDATE `clan` SET `join1` = "0" WHERE `id` = "'.$delc['id'].'" LIMIT 1');
								//mysql_query('UPDATE `clan_join` SET `time_end` = "'.time().'" WHERE `id` = "'.$dels['id'].'" LIMIT 1');
								mysql_query('DELETE FROM `clan_join` WHERE `id` = "'.$dels['id'].'" LIMIT 1');
								echo '<div><b><font color=red>Клан &quot;'.$delc['name'].'&quot; был исключен из данного союза</font></b></div>';
								header('location: main.php?clan&diplom');
							}else{
								echo '<div><b><font color=red>Клан ответственный за союз не может покинуть данный союз</font></b></div>';
							}
						}else{
							if( $j1['id'] == $delc['join1'] ) {
								mysql_query('UPDATE `clan` SET `join1` = "0" WHERE `id` = "'.$delc['id'].'" LIMIT 1');
							}
							echo '<div><b><font color=red>Клан не состоит в данном союзе</font></b></div>';
						}
					}
				}
				$sp1 = mysql_query('SELECT `u`.*,`s`.* FROM `clan_join` AS `u` LEFT JOIN `clan` AS `s` ON `s`.`id` = `u`.`clan` WHERE `u`.`alians` = "'.$j1['id'].'" AND `u`.`time_end` = "0" AND `u`.`time_start` > 0');
				while($pl1 = mysql_fetch_array($sp1)) {
					if($i > 0) {
						$ms .= ',';
					}
					$ms .= ' <a href="javascript:void(0)"><img style="vertical-align:bottom" src="http://img.likebk.com/i/clan/'.$pl1['name_mini'].'.gif">'.$pl1['name'].'</a>';
					if( $j1['clan_glava'] == $res['id'] ) {
						if($res['id'] != $pl1['clan']) { 
							if($u->info['clan_prava'] == 'glava' || $u->info['admin'] > 0) {
								$ms .= ' <a title="Выгнать из союза" href="main.php?clan&diplom&delclan='.$pl1['clan'].'"><img width="13" height="13" src="http://img.likebk.com/i/clear.gif"></a>';
							}
						}
					}
					$i++;
				}
				if( $j1['clan_glava'] == $res['id'] && ($u->info['clan_prava'] == 'glava' || $u->info['admin'] > 0) ) {
					$ms .= '<br>Вы основатель союза, можете ограничить каналы союза чата:<br>';
					$cnls = '<i>выключено</i>';
					//$ms .= '<form method="post" action="?clan&diplom&savecanals='.$res['id'].'"><a style="display:inline-block;width:210px;" href="javascript:void(0)"><img src="http://img.likebk.com/i/clan/'.$res['name_mini'].'.gif">'.$res['name'].'</a> &nbsp; '.$cnls.' &nbsp; <input type="submit" value="сохранить"></form>';
					$sp1 = mysql_query('SELECT `u`.*,`s`.* FROM `clan_join` AS `u` LEFT JOIN `clan` AS `s` ON `s`.`id` = `u`.`clan` WHERE `u`.`alians` = "'.$j1['id'].'" AND `u`.`time_end` = "0" AND `u`.`time_start` > 0');
					while($pl1 = mysql_fetch_array($sp1)) {
						$ms .= '<form method="post" action="?clan&diplom&savecanals='.$pl1['id'].'"><a style="display:inline-block;width:210px;" href="javascript:void(0)"><img src="http://img.likebk.com/i/clan/'.$pl1['name_mini'].'.gif">'.$pl1['name'].'</a> &nbsp; '.$cnls.' &nbsp; <input type="submit" value="сохранить"></form>';
					}
				}
				//Перечисляем открытые каналы клана
				
				$ms .= '</div>';
			}
		}
		if($res['join2'] > 0 && isset($res['join2pl']['id'])) {			
			$j1 = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$res['join2'].'" LIMIT 1'));
			if(isset($j1['id'])) {
				
				if( isset($_GET['delclanme2']) ) {
					if( $j1['clan_glava'] != $res['id'] && ($u->info['clan_prava'] == 'glava' || $u->info['admin'] > 0) ) { 
						$dels = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `clan` = "'.$res['id'].'" AND `alians` = "'.$j1['id'].'" AND `time_end` = "0" AND `time_start` > 0 LIMIT 1'));
						if(isset($dels['id'])) {
							mysql_query('UPDATE `clan` SET `join2` = "0" WHERE `id` = "'.$res['id'].'" LIMIT 1');
							//mysql_query('UPDATE `clan_join` SET `time_end` = "'.time().'" WHERE `id` = "'.$dels['id'].'" LIMIT 1');
							mysql_query('DELETE FROM `clan_join` WHERE `id` = "'.$dels['id'].'" LIMIT 1');
							echo '<div><b><font color=red>Вы успешно покинули альянс &quot;'.$j1['name'].'&quot;</font></b></div>';
							header('location: main.php?clan&diplom');
						}else{
							mysql_query('UPDATE `clan` SET `join2` = "0" WHERE `id` = "'.$res['id'].'" LIMIT 1');
							mysql_query('DELETE FROM `clan_join` WHERE `id` = "'.$dels['id'].'" LIMIT 1');
							echo '<div><b><font color=red>Вы успешно покинули альянс &quot;'.$j1['name'].'&quot;</font></b></div>';
						
						}
					}else{
						echo '<div><b><font color=red>Вы не можете покинуть данный альянс</font></b></div>';
					}
				}elseif( $j1['clan_glava'] == $res['id'] && ($u->info['clan_prava'] == 'glava' || $u->info['admin'] > 0) ) {
					if( isset($_GET['delclan2']) ) {
						$delc = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.mysql_real_escape_string($_GET['delclan2']).'" LIMIT 1'));
						$dels = mysql_fetch_array(mysql_query('SELECT * FROM `clan_join` WHERE `clan` = "'.$delc['id'].'" AND `alians` = "'.$j1['id'].'" AND `time_end` = "0" AND `time_start` > 0 LIMIT 1'));
						
						if( isset($delc['id']) && isset($dels['id']) ) {
							if( $delc['id'] != $res['id'] ) {
								mysql_query('UPDATE `clan` SET `join2` = "0" WHERE `id` = "'.$delc['id'].'" LIMIT 1');
								//mysql_query('UPDATE `clan_join` SET `time_end` = "'.time().'" WHERE `id` = "'.$dels['id'].'" LIMIT 1');
								mysql_query('DELETE FROM `clan_join` WHERE `id` = "'.$dels['id'].'" LIMIT 1');
								echo '<div><b><font color=red>Клан &quot;'.$delc['name'].'&quot; был исключен из данного альянса</font></b></div>';
								header('location: main.php?clan&diplom');
							}else{
								echo '<div><b><font color=red>Клан ответственный за союз не может покинуть данный альянс</font></b></div>';
							}
						}else{
							if( $j1['id'] == $delc['join2'] ) {
								mysql_query('UPDATE `clan` SET `join2` = "0" WHERE `id` = "'.$delc['id'].'" LIMIT 1');
							}
							echo '<div><b><font color=red>Клан не состоит в данном альянсе</font></b></div>';
						}
					}
				}
				
				$ms .= '<div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">';
				$ms .= 'Вы состоите в клановом альянсе <b>'.$j1['name'].'</b>. ';
				if( $j1['clan_glava'] != $res['id'] ) { 
					$ms .= ' <a href="main.php?clan&diplom&delclanme2=1"><img title="Покинуть союз" width="13" height="13" src="http://img.likebk.com/i/clear.gif"></a><br>';
				}
				$ms .= 'Состав альянса: ';
				//$ms .= '<a href="javascript:void(0)"><img style="vertical-align:bottom" src="http://img.likebk.com/i/clan/'.$res['name_mini'].'.gif">'.$res['name'].'</a>';
				$sp1 = mysql_query('SELECT `u`.*,`s`.* FROM `clan_join` AS `u` LEFT JOIN `clan` AS `s` ON `s`.`id` = `u`.`clan` WHERE `u`.`alians` = "'.$j1['id'].'" AND `u`.`time_end` = "0" AND `u`.`time_start` > 0');
				$i = 0;
				while($pl1 = mysql_fetch_array($sp1)) {
					if($i > 0) {
						$ms .= ', ';	
					}
					$ms .= '<a href="javascript:void(0)"><img style="vertical-align:bottom" src="http://img.likebk.com/i/clan/'.$pl1['name_mini'].'.gif">'.$pl1['name'].'</a>';
					if( $j1['clan_glava'] == $res['id'] ) {
						if($res['id'] != $pl1['clan']) { 
							if($u->info['clan_prava'] == 'glava' || $u->info['admin'] > 0) {
								$ms .= ' <a title="Выгнать из альянса" href="main.php?clan&diplom&delclan2='.$pl1['clan'].'"><img width="13" height="13" src="http://img.likebk.com/i/clear.gif"></a>';
							}
						}
					}
					$i++;
				}
				if( $res['join2'] == $j1['clan_glava'] ) {
					$ms .= '<br>Вы основатель альянса.<br>';	
				}
				$ms .= '</div>';
			}
		}
		
		//Союзы и альянсы в которых состоит клан
		
		
		if($ms == '') {
		?>
        <center>В данный момент у вашего клана нет дипломатических отношений.</center>
        <? }else{ echo $ms; } ?>
      </div>
      <? if($tt[13][0] == 1) { ?>
      <br />
      <center>Заявки на союзы</center>
      <br />
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td width="50%" align="center" valign="top">
          	<div style="border:1px solid #CECECE;padding:10px;">
            	<a href="javascript:void(0)">Ваши заявки на установление союза</a>
                <br />
                <br />
                <?
				$ms = '';
				$sp = mysql_query('SELECT * FROM `clan_join` WHERE `clan` = "'.mysql_real_escape_string($res['id']).'" AND `time_start` = "0" AND `time_end` = "0" AND `type` = "1"');
				while($pl = mysql_fetch_array($sp)) {
					$suz = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$pl['alians'].'" LIMIT 1'));
					$ms .= '<div style="border-bottom:1px solid #cac9c7;text-align:left;margin-bottom:5px;padding-bottom:5px;">Вы подали заявку на вступление в союз <b>'.$suz['name'].'</b>.<br><div style="float:left;">Время подачи заявки: '.date('d.m.Y H:i',$pl['time']).'</div><a style="float:right;" href="?clan&diplom&cancel='.$pl['id'].'">Отменить</a><br></div>';
				}
				if($ms == '') {
				?>
                С Вами никто не подавал заявки
                <? }else{ echo $ms; } ?>
            </div>
          </td>
          <td align="center" valign="top">
          	<div style="border:1px solid #CECECE;padding:10px;">
            	<a href="javascript:void(0)">Заявки на установление союза с вами</a>
                <br />
                <br />
                <?
				$ms = '';
				$sp = mysql_query('SELECT * FROM `clan_join` WHERE `alians` = "'.mysql_real_escape_string($res['join1']).'" AND `time_start` = "0" AND `time_end` = "0" AND `type` = "1"');
				while($pl = mysql_fetch_array($sp)) {
					$suz = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$pl['alians'].'" LIMIT 1'));
					if( $suz['clan_glava'] == $res['id'] ) {
						$clz = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$pl['clan'].'" LIMIT 1'));
						$ms .= '<div style="border-bottom:1px solid #cac9c7;text-align:left;margin-bottom:5px;padding-bottom:5px;">Клан <a href="javascript:void(0)"><img style="vertical-align:bottom" src="http://img.likebk.com/i/clan/'.$clz['name_mini'].'.gif">'.$clz['name'].'</a> подал заявку на вступление в Ваш союз <b>'.$suz['name'].'</b>.<br><div style="float:left;">Время подачи заявки: '.date('d.m.Y H:i',$pl['time']).'</div><div style="float:right;"><a href="?clan&diplom&ok='.$pl['id'].'">Принять</a> &nbsp; <a href="?clan&diplom&cancel='.$pl['id'].'">Отказать</a></div><br></div>';
					}
				}
				if($ms == '') {
				?>
                С Вами никто не подавал заявки
                <? }else{ echo $ms; } ?>
            </div>
          </td>
        </tr>
      </table>
    <br />
    <center>Заявки на альянсы</center>     
    <br />
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td width="50%" align="center" valign="top">
          	<div style="border:1px solid #CECECE;padding:10px;">
            	<a href="javascript:void(0)">Ваши заявки на установление альянса</a>
                <br />
                <br />
                <?
				$ms = '';
				$sp = mysql_query('SELECT * FROM `clan_join` WHERE `clan` = "'.mysql_real_escape_string($res['id']).'" AND `time_start` = "0" AND `time_end` = "0" AND `type` = "2"');
				while($pl = mysql_fetch_array($sp)) {
					$suz = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$pl['alians'].'" LIMIT 1'));
					$ms .= '<div style="border-bottom:1px solid #cac9c7;text-align:left;margin-bottom:5px;padding-bottom:5px;">Вы подали заявку на вступление в альянс <b>'.$suz['name'].'</b>.<br><div style="float:left;">Время подачи заявки: '.date('d.m.Y H:i',$pl['time']).'</div><a style="float:right;" href="?clan&diplom&cancel='.$pl['id'].'">Отменить</a><br></div>';
				}
				if($ms == '') {
				?>
                С Вами никто не подавал заявки
                <? }else{ echo $ms; } ?>
            </div>
          </td>
          <td align="center" valign="top">
          	<div style="border:1px solid #CECECE;padding:10px;">
            	<a href="javascript:void(0)">Заявки на установление альянса с вами</a>
                <br />
                <br />
                <?
				$ms = '';
				$sp = mysql_query('SELECT * FROM `clan_join` WHERE `alians` = "'.mysql_real_escape_string($res['join2']).'" AND `time_start` = "0" AND `time_end` = "0" AND `type` = "2"');
				while($pl = mysql_fetch_array($sp)) {
					$suz = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$pl['alians'].'" LIMIT 1'));
					$clz = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$pl['clan'].'" LIMIT 1'));
					$ms .= '<div style="border-bottom:1px solid #cac9c7;text-align:left;margin-bottom:5px;padding-bottom:5px;">Клан <a href="javascript:void(0)"><img style="vertical-align:bottom" src="http://img.likebk.com/i/clan/'.$clz['name_mini'].'.gif">'.$clz['name'].'</a> подал заявку на вступление в Ваш альянс <b>'.$suz['name'].'</b>.<br><div style="float:left;">Время подачи заявки: '.date('d.m.Y H:i',$pl['time']).'</div><div style="float:right;"><a href="?clan&diplom&ok='.$pl['id'].'">Принять</a> &nbsp; <a href="?clan&diplom&cancel='.$pl['id'].'">Отказать</a></div><br></div>';
				}
				if($ms == '') {
				?>
                С Вами никто не подавал заявки
                <? }else{ echo $ms; } ?>
            </div>
          </td>
        </tr>
    </table>
	<? } ?>
    </fieldset>  
      <? }elseif(isset($_GET['ability']) && ($tt[15][0] == 1 || $u->info['admin'] > 0)) {
		  
			$r1['pos'] = 1; //позиция клана
			//
			$r1['pos'] = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `clan` WHERE `exp` >= "'.$res['exp'].'" ORDER BY `id` DESC LIMIT 1'));
			$r1['pos'] = $r1['pos'][0];
		  
		  ?>
        <br><br><fieldset style="border:1px dashed #eeeeee">
          <legend><span class="legtitle" title="Место в рейтинге: <?=$r1['pos']?>">Клановые абилки</span></legend>
<script>
function mod1() {
	top.win.add(
		'mod1panel',
		'Принять в клан &quot;<?=$clan['name']?>&quot; &nbsp;',
		'<center>Введите логин персонажа:<br><small>(можно щелкнуть по логину в чате)</small></center>',
		{
			'a1':'top.frames[\'main\'].mod1back(top.$(\'#mod1v1\').val());',
			'usewin':'top.chat.inObj = top.$(\'#mod1v1\');top.$(\'#mod1v1\').focus()',
			'd':'<center><input style="width:96%; margin:5px;" id="mod1v1" class="inpt2" type="text" value=""><div style="padding-bottom:4px;"><small>Стоимость приема в клан <b>100 КР.</b></small></div></center>'
		},
		3,
		1,
		'min-width:300px;'
	);
	top.chat.inObj = top.$('#mod1v1');
}
function mod1back( login ) {
	location.href='/main.php?clan&ability&addtoclan='+login;
}

function mod2() {
	top.win.add(
		'mod1panel',
		'Выгнать из клана &quot;<?=$clan['name']?>&quot; &nbsp;',
		'<center>Введите логин соклана:<br><small>(можно щелкнуть по логину в чате)</small></center>',
		{
			'a1':'top.frames[\'main\'].mod2back(top.$(\'#mod1v1\').val());',
			'usewin':'top.chat.inObj = top.$(\'#mod1v1\');top.$(\'#mod1v1\').focus()',
			'd':'<center><input style="width:96%; margin:5px;" id="mod1v1" class="inpt2" type="text" value=""></center>'
		},
		3,
		1,
		'min-width:300px;'
	);
	top.chat.inObj = top.$('#mod1v1');
}
function mod2back( login ) {
	location.href='/main.php?clan&ability&unclan='+login;
}

function mod3() {
	top.win.add(
		'mod1panel',
		'Изменить звание соклана &nbsp;',
		'<center>Введите логин соклана:<br><small>(можно щелкнуть по логину в чате)</small></center>',
		{
			'a1':'top.frames[\'main\'].mod3back(top.$(\'#mod1v1\').val(),top.$(\'#mod1v122\').val());',
			'usewin':'top.chat.inObj = top.$(\'#mod1v1\');',
			'd':'<center><input style="width:96%; margin:5px;" id="mod1v1" class="inpt2" type="text" value=""><br><b>Введите новое звание:</b><br><input style="width:96%; margin:5px;" id="mod1v122" class="inpt2" type="text" value=""></center>'
		},
		3,
		1,
		'min-width:300px;'
	);
	top.chat.inObj = top.$('#mod1v1');
}
function mod3back( login , val ) {
	location.href='/main.php?clan&ability&new_rang='+val+'&login_user='+login;
}

function mod4() {
	top.win.add(
		'mod1panel',
		'Сменить главу клана',
		'<center>Введите логин нового главы клана:<br><small>(можно щелкнуть по логину в чате)</small></center>',
		{
			'a1':'top.frames[\'main\'].mod4back(top.$(\'#mod1v1\').val());',
			'usewin':'top.chat.inObj = top.$(\'#mod1v1\');top.$(\'#mod1v1\').focus()',
			'd':'<center><input style="width:96%; margin:5px;" id="mod1v1" class="inpt2" type="text" value=""></center>'
		},
		3,
		1,
		'min-width:300px;'
	);
	top.chat.inObj = top.$('#mod1v1');
}
function mod4back( login ) {
	location.href='/main.php?clan&ability&new_glava='+login;
}

function mod9() {
	top.win.add(
		'mod1panel',
		'<center>Редактировать права</center>',
		'<center>Введите логин соклана:<br><small>(можно щелкнуть по логину в чате)</small></center>',
		{
			'a1':'top.frames[\'main\'].mod9back(top.$(\'#mod1v1\').val());',
			'usewin':'top.chat.inObj = top.$(\'#mod1v1\');top.$(\'#mod1v1\').focus()',
			'd':'<center><input style="width:96%; margin:5px;" id="mod1v1" class="inpt2" type="text" value=""></center>'
		},
		3,
		1,
		'min-width:300px;'
	);
	top.chat.inObj = top.$('#mod1v1');
}
function mod9back( login ) {
	location.href='/main.php?clan&ability&edit_prava='+login;
}

function mod5() {
	top.win.add(
		'mod1panel',
		'Покинуть клан &quot;<?=$clan['name']?>&quot; &nbsp;',
		'<center><br>Вы действительно хотите покинуть текущий клан?<br><br></center>',
		{
			'a1':'top.frames[\'main\'].mod5back();',
			'usewin':''
		},
		2,
		1,
		'min-width:300px;'
	);
}
function mod5back() {
	location.href='/main.php?clan&ability&unclanme=1';
}
</script>
<script>
function mod6() {
	top.win.add(
		'mod1panel',
		'Заклятие молчания',
		'<center>Введите логин:<br><small>(можно щелкнуть по логину в чате)</small></center>',
		{
			'a1':'top.frames[\'main\'].mod6back(top.$(\'#mod1v1\').val());',
			'usewin':'top.chat.inObj = top.$(\'#mod1v1\');top.$(\'#mod1v1\').focus()',
			'd':'<center><input style="width:96%; margin:5px;" id="mod1v1" class="inpt2" type="text" value=""></center>'
		},
		3,
		1,
		'min-width:300px;'
	);
	top.chat.inObj = top.$('#mod1v1');
}
function mod6back( login ) {
	location.href='/main.php?clan&ability&molch15add='+login;
}
function mod7() {
	top.win.add(
		'mod1panel',
		'Заклятие молчания',
		'<center>Введите логин:<br><small>(можно щелкнуть по логину в чате)</small></center>',
		{
			'a1':'top.frames[\'main\'].mod7back(top.$(\'#mod1v1\').val());',
			'usewin':'top.chat.inObj = top.$(\'#mod1v1\');top.$(\'#mod1v1\').focus()',
			'd':'<center><input style="width:96%; margin:5px;" id="mod1v1" class="inpt2" type="text" value=""></center>'
		},
		3,
		1,
		'min-width:300px;'
	);
	top.chat.inObj = top.$('#mod1v1');
}
function mod7back( login ) {
	location.href='/main.php?clan&ability&molch30add='+login;
}
function mod8() {
	top.win.add(
		'mod1panel',
		'Используем нападение',
		'<center>Введите логин:<br><small>(можно щелкнуть по логину в чате)</small></center>',
		{
			'a1':'top.frames[\'main\'].mod8back(top.$(\'#mod1v1\').val());',
			'usewin':'top.chat.inObj = top.$(\'#mod1v1\');top.$(\'#mod1v1\').focus()',
			'd':'<center><input style="width:96%; margin:5px;" id="mod1v1" class="inpt2" type="text" value=""></center>'
		},
		3,
		1,
		'min-width:300px;'
	);
	top.chat.inObj = top.$('#mod1v1');
}
function mod8back( login ) {
	location.href='/main.php?clan&ability&atckadd='+login;
}
function mod10() {
	top.win.add(
		'mod1panel',
		'Используем кровавое нападение',
		'<center>Введите логин:<br><small>(можно щелкнуть по логину в чате)</small></center>',
		{
			'a1':'top.frames[\'main\'].mod10back(top.$(\'#mod1v1\').val());',
			'usewin':'top.chat.inObj = top.$(\'#mod1v1\');top.$(\'#mod1v1\').focus()',
			'd':'<center><input style="width:96%; margin:5px;" id="mod1v1" class="inpt2" type="text" value=""></center>'
		},
		3,
		1,
		'min-width:300px;'
	);
	top.chat.inObj = top.$('#mod1v1');
}
function mod10back( login ) {
	location.href='/main.php?clan&ability&atckadd2='+login;
}
</script>
<script>
    function openMod(title,dat)
    {
        var d = document.getElementById('useMagic');
        if(d!=undefined)
        {
            document.getElementById('modtitle').innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="top">'+title+'</td><td width="30" valign="top"><div align="right"><a title="Закрыть окно" onClick="closeMod(); return false;" href="#">x</a></div></td></tr></table>';
            document.getElementById('moddata').innerHTML = dat;

            d.style.display = '';

        }
    }

    function closeMod()
    {
        var d = document.getElementById('useMagic');
        if(d!=undefined)
        {
            document.getElementById('modtitle').innerHTML = '';
            document.getElementById('moddata').innerHTML = '';
            d.style.display = 'none';
        }
    }
</script>
			<?
			// 
			$abil = array();
			//
			$clan_prava['pravo6'] = 1; //Разерешение использовать абилки
			//
			if( $r1['pos'] == 1) {
				$abil['exp'] = 20;
				$abil['stats'] = 5;
				$abil['amp'] = 10;
				$abil['hpmp'] = 100000;
				$abil['molch15'] = 1;
				$abil['molch30'] = 1;
				$abil['exit_btl'] = 5;
				$abil['hpvinos5'] = 20;
				$abil['hl11'] = 20;
				$abil['hl10'] = 20;
				$abil['hl9'] = 20;
				$abil['hl8'] = 30;
				$abil['hl7'] = 20;
				$abil['hl6'] = 20;
				$abil['hl5'] = 20;
				$abil['hl4'] = 20;
				$abil['hl3'] = 20;
				$abil['hl2'] = 30;
				$abil['hl1'] = 5;
			}elseif( $r1['pos'] == 2 ) {
				$abil['exp'] = 10;
				$abil['stats'] = 3;
				$abil['amp'] = 5;
				$abil['hpmp'] = 60000;
				$abil['molch15'] = 1;
				$abil['molch30'] = 1;
				$abil['exit_btl'] = 3;
				$abil['hpvinos5'] = 15;
				$abil['hl11'] = 15;
				$abil['hl10'] = 15;
				$abil['hl9'] = 15;
				$abil['hl8'] = 20;
				$abil['hl7'] = 15;
				$abil['hl6'] = 15;
				$abil['hl5'] = 15;
				$abil['hl4'] = 15;
				$abil['hl3'] = 15;
				$abil['hl2'] = 20;
				$abil['hl1'] = 3;
			}elseif( $r1['pos'] == 3 ) {
				$abil['exp'] = 5;
				$abil['stats'] = 1;
				$abil['amp'] = 3;
				$abil['hpmp'] = 40000;
				$abil['molch15'] = 1;
				$abil['molch30'] = 1;
				$abil['exit_btl'] = 1;
				$abil['hpvinos5'] = 10;
				$abil['hl11'] = 10;
				$abil['hl10'] = 10;
				$abil['hl9'] = 10;
				$abil['hl8'] = 15;
				$abil['hl7'] = 10;
				$abil['hl6'] = 10;
				$abil['hl5'] = 10;
				$abil['hl3'] = 10;
				$abil['hl4'] = 10;
				$abil['hl2'] = 15;
				$abil['hl1'] = 1;
			}elseif( $r1['pos'] == 4 ) {
				$abil['exp'] = 0;
				$abil['stats'] = 0;
				$abil['amp'] = 0;
				$abil['hpmp'] = 20000;
				$abil['molch15'] = 1;
				$abil['molch30'] = 0;
				$abil['exit_btl'] = 0;
				$abil['hpvinos5'] = 5;
				$abil['hl11'] = 5;
				$abil['hl10'] = 5;
				$abil['hl9'] = 5;
				$abil['hl8'] = 10;
				$abil['hl7'] = 5;
				$abil['hl6'] = 5;
				$abil['hl5'] = 5;
				$abil['hl4'] = 5;
				$abil['hl3'] = 5;
				$abil['hl2'] = 10;
				$abil['hl1'] = 0;
			}elseif( $r1['pos'] == 5 ) {
				$abil['exp'] = 0;
				$abil['stats'] = 0;
				$abil['amp'] = 0;
				$abil['hpmp'] = 10000;
				$abil['m1'] = 0;
				$abil['m2'] = 0;
				$abil['molch15'] = 0;
				$abil['molch30'] = 0;
				$abil['exit_btl'] = 0;
				$abil['hpvinos5'] = 1;
				$abil['hl11'] = 1;
				$abil['hl10'] = 1;
				$abil['hl9'] = 1;
				$abil['hl8'] = 3; 
				$abil['hl7'] = 1;
				$abil['hl6'] = 1;
				$abil['hl5'] = 1;
				$abil['hl4'] = 1;
				$abil['hl3'] = 1;
				$abil['hl2'] = 3;
				$abil['hl1'] = 0;
			}else{
				$abil['exp'] = 0;
				$abil['stats'] = 0;
				$abil['amp'] = 0;
				$abil['hpmp'] = 5000;
				$abil['m1'] = 0;
				$abil['m2'] = 0;
				$abil['molch15'] = 0;
				$abil['molch30'] = 0;
				$abil['exit_btl'] = 0;
				$abil['hpvinos5'] = 0;
				$abil['hl11'] = 1;
				$abil['hl10'] = 1;
				$abil['hl9'] = 0;
				$abil['hl8'] = 1;
				$abil['hl7'] = 0;
				$abil['hl6'] = 0;
				$abil['hl5'] = 0;
				$abil['hl4'] = 0;
				$abil['hl3'] = 0;
				$abil['hl2'] = 1;
				$abil['hl1'] = 0;
			}
			
			$abil['_hl9'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl9" LIMIT 1'));
			$abil['_hl9'] = 0 + $abil['_hl9'][0];
			$abil['hl9'] -= $abil['_hl9'];
			//
			$abil['_hl3'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl3" LIMIT 1'));
			$abil['_hl3'] = 0 + $abil['_hl3'][0];
			$abil['hl3'] -= $abil['_hl3'];
			//
			$abil['_hl4'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl4" LIMIT 1'));
			$abil['_hl4'] = 0 + $abil['_hl4'][0];
			$abil['hl4'] -= $abil['_hl4'];
			//
			$abil['_hl5'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl5" LIMIT 1'));
			$abil['_hl5'] = 0 + $abil['_hl5'][0];
			$abil['hl5'] -= $abil['_hl5'];
			//
			$abil['_hl6'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl6" LIMIT 1'));
			$abil['_hl6'] = 0 + $abil['_hl6'][0];
			$abil['hl6'] -= $abil['_hl6'];
			//
			$abil['_hl7'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl7" LIMIT 1'));
			$abil['_hl7'] = 0 + $abil['_hl7'][0];
			$abil['hl7'] -= $abil['_hl7'];
			//
		    $abil['_hl8'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl8" LIMIT 1'));
			$abil['_hl8'] = 0 + $abil['_hl8'][0];
			$abil['hl8'] -= $abil['_hl8'];
			//
			$abil['_hl2'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl2" LIMIT 1'));
			$abil['_hl2'] = 0 + $abil['_hl2'][0];
			$abil['hl2'] -= $abil['_hl2'];
			//
			$abil['_hl10'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl10" LIMIT 1'));
			$abil['_hl10'] = 0 + $abil['_hl10'][0];
			$abil['hl10'] -= $abil['_hl10'];
			//
			$abil['_hl11'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hl11" LIMIT 1'));
			$abil['_hl11'] = 0 + $abil['_hl11'][0];
			$abil['hl11'] -= $abil['_hl11'];
			//
			$abil['_molch15'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "molch15" LIMIT 1'));
			$abil['_molch15'] = 0 + $abil['_molch15'][0];
			$abil['molch15'] -= $abil['_molch15'];
			//
			$abil['_molch30'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "molch30" LIMIT 1'));
			$abil['_molch30'] = 0 + $abil['_molch30'][0];
			$abil['molch30'] -= $abil['_molch30'];
			//
			$abil['_exit_btl'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "exit_btl" LIMIT 1'));
			$abil['_exit_btl'] = 0 + $abil['_exit_btl'][0];
			$abil['exit_btl'] -= $abil['_exit_btl'];
			//
			$abil['_hpvinos5'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_ability` WHERE `date` = "'.date('d.m.Y').'" AND `clan` = "'.$u->info['clan'].'" AND `pravo` = "hpvinos5" LIMIT 1'));
			$abil['_hpvinos5'] = 0 + $abil['_hpvinos5'][0];
			$abil['hpvinos5'] -= $abil['_hpvinos5'];
			
			
			
			$html = '';
			$er = '';
		   if($u->info['clan']==$u->info['clan']) {			
			//сокрушение
			if( isset($_GET['hl9add']) && $abil['hl9'] > 0 ) {
				$abil['hl9']--;
				$additm = $u->addItem(994,$u->info['id']);
				if( $additm > 0 ) {
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES (
						"0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl9"
					)');
					if( $u->error != '' ) {
						$er = $u->error.'<br></b>(Осталось кастов: '.$abil['hl9'].' на сегодня)<b>';
					}else{
						$er = 'Вы ощутили силу каста &quot;<b>Сокрушение</b>&quot;.<br></b>(Осталось кастов: '.$abil['hl9'].' на сегодня)<b>';
					}
				}else{
					$er = 'Что-то пошло не так, каст не сработал...';
				}
			}
			if($abil['hl9'] > 0 ) {
				 if($u->info['battle'] > 0) {
				   $html .= '';
			   }else{
				$html .= '<img onclick="location.href=\'/main.php?clan&ability&hl9add\';" onMouseOver="top.hi(this,\'<b>Сокрушение</b> (Осталось: '.$abil['hl9'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/eff/spell_powerup10.gif">';
			}
		  }
			
			//защита от оружия
				if( isset($_GET['hl3add']) && $abil['hl3'] > 0 ) {
				$abil['hl3']--;
				$additm = $u->addItem(1001,$u->info['id']);
				if( $additm > 0 ) {
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES (
						"0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl3"
					)');
					if( $u->error != '' ) {
						$er = $u->error.'<br></b>(Осталось кастов: '.$abil['hl3'].' на сегодня)<b>';
					}else{
						$er = 'Вы ощутили силу каста &quot;<b>Защиты от оружия</b>&quot;.<br></b>(Осталось кастов: '.$abil['hl3'].' на сегодня)<b>';
					}
				}else{
					$er = 'Что-то пошло не так, каст не сработал...';
				}
			}
			if($abil['hl3'] > 0 ) {
				 if($u->info['battle'] > 0) {
				   $html .= '';
			   }else{
				$html .= '<img onclick="location.href=\'/main.php?clan&ability&hl3add\';" onMouseOver="top.hi(this,\'<b>Защита от оружия</b> (Осталось: '.$abil['hl3'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/spell_protect10.gif">';
			}
		}
		//жажда жизни +5
					//защита от оружия
				if( isset($_GET['hpvinos']) && $abil['hpvinos5'] > 0 ) {
				$abil['hpvinos5']--;
				$additm = $u->addItem(3102,$u->info['id']);
				if( $additm > 0 ) {
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES (
						"0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hpvinos5"
					)');
					if( $u->error != '' ) {
						$er = $u->error.'<br></b>(Осталось кастов: '.$abil['hpvinos5'].' на сегодня)<b>';
					}else{
						$er = 'Вы ощутили силу каста &quot;<b>Защиты от оружия</b>&quot;.<br></b>(Осталось кастов: '.$abil['hpvinos5'].' на сегодня)<b>';
					}
				}else{
					$er = 'Что-то пошло не так, каст не сработал...';
				}
			}
			if($abil['hpvinos5'] > 0 ) {
				 if($u->info['battle'] > 0) {
				   $html .= '';
			   }else{
				$html .= '<img onclick="location.href=\'/main.php?clan&ability&hpvinos\';" onMouseOver="top.hi(this,\'<b>Жажда Жизни +5</b> (Осталось: '.$abil['hpvinos5'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/spell_powerHPup5.gif">';
			}
		}
			//Магическое усиление
			if( isset($_GET['hl4add']) && $abil['hl4'] > 0 ) {
				$abil['hl4']--;
				$additm = $u->addItem(5123,$u->info['id']);
				if( $additm > 0 ) {
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES (
						"0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl4"
					)');
					if( $u->error != '' ) {
						$er = $u->error.'<br></b>(Осталось кастов: '.$abil['hl4'].' на сегодня)<b>';
					}else{
						$er = 'Вы ощутили силу каста &quot;<b>Магического усиления</b>&quot;.<br></b>(Осталось кастов: '.$abil['hl4'].' на сегодня)<b>';
					}
				}else{
					$er = 'Что-то пошло не так, каст не сработал...';

				}
			}
			if($abil['hl4'] > 0 ) {
				 if($u->info['battle'] > 0) {
				   $html .= '';
			   }else{
				$html .= '<img onclick="location.href=\'/main.php?clan&ability&hl4add\';" onMouseOver="top.hi(this,\'<b>Магическое усиление</b> (Осталось: '.$abil['hl4'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/invoke_spell_godintel100.gif">';
			}
		}
			//защита от магии
			if( isset($_GET['hl5add']) && $abil['hl5'] > 0 ) {
				$abil['hl5']--;
				$additm = $u->addItem(5122,$u->info['id']);
				if( $additm > 0 ) {
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES (
						"0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl5"
					)');
					if( $u->error != '' ) {
						$er = $u->error.'<br></b>(Осталось кастов: '.$abil['hl5'].' на сегодня)<b>';
					}else{
						$er = 'Вы ощутили силу каста &quot;<b>Защита от магии</b>&quot;.<br></b>(Осталось кастов: '.$abil['hl5'].' на сегодня)<b>';
					}
				}else{
					$er = 'Что-то пошло не так, каст не сработал...';
				}
			}
			if($abil['hl5'] > 0) {
               if($u->info['battle'] > 0) {
				   $html .= '';
			   }else{
				$html .= '<img onclick="location.href=\'/main.php?clan&ability&hl5add\';" onMouseOver="top.hi(this,\'<b>Защита от магии</b> (Осталось: '.$abil['hl5'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/magearmor.gif">';
			}
		}
			//Восстановление Энергии +120 ХП
			if( isset($_GET['hl8add']) && $abil['hl8'] > 0 ) {
				$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$u->info['battle'].'" LIMIT 1'));
				$bu = mysql_fetch_array(mysql_query('SELECT * FROM `spells` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				if($u->info['hpNow']>=$u->stats['hpAll']) {
					$er = 'Вам незачем восстанавливать Энергию';
				}elseif($u->info['tactic7'] < 2.50 ) {
					$er = 'Недостаточно духа!';
				}elseif($u->info['hpNow'] < 1) {
					$er = 'Вы погибли';
				}elseif(isset($bu['id'])) {
	                 $er = 'Нельзя использовать свиток каждый ход...';
				}elseif($battle['noeff'] > 0 ) {
					$er = 'Запрет на использования свитков восстановления';
				}else{
				$last_hod = mysql_fetch_array(mysql_query('SELECT `id_hod` FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
		        $last_hod = $last_hod['id_hod'];
				$mass = array('time'=> time(), 'battle' => $u->info['battle'],'id_hod' => ($last_hod+1), 'text'=> 'Персонаж: <img src=http://'.$c['img'].'/i/align/align'.$u->info['align'].'.gif><img src=http://'.$c['img'].'/i/clan/'.$u->info['clan'].'.gif><b>'.$u->info['login'].'</b> - <b><font color=red>Использовал клановое восстановление </font><font color=red> +120 HP</b></font>','type' => 1);
				mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$mass['text'].'","'.$mass['vars'].'","","","","","'.$mass['type'].'")');
				$abil['hl8']--;
				$u->info['hpNow'] = $u->info['hpNow']+= 120; $u->info['tactic7'] = $u->info['tactic7'] -= 2.50;
				mysql_query('INSERT INTO `spells` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`) VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","1")');
				mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl8")');
				mysql_query('UPDATE `stats` SET `hpNow` = "'.$u->info['hpNow'].'",`tactic7` = "'.$u->info['tactic7'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				$er = 'Успешно использован свиток "Восстановление Энергии +120"<br></b>(Осталось восстановлений: '.$abil['hl8'].' на сегодня)<b>';
			}
		}
			if($abil['hl8'] > 0 ) {
			  $html .= '<img onclick="location.href=\'/main.php?clan&ability&hl8add\';" onMouseOver="top.hi(this,\'<b>Восстановление Энергии +120</b> (Осталось: '.$abil['hl8'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/cureHP120.gif">';
			}
			//Восстановление Энергии +600 ХП
			if( isset($_GET['hl10add']) && $abil['hl10'] > 0 ) {
				$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$u->info['battle'].'" LIMIT 1'));
				$bu = mysql_fetch_array(mysql_query('SELECT * FROM `spells` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				if($u->info['hpNow']>=$u->stats['hpAll']) {
					$er = 'Вам незачем восстанавливать Энергию';
				}elseif($u->info['tactic7'] < 5 ) {
					$er = 'Недостаточно духа!';
				}elseif($u->info['hpNow'] < 1) {
					$er = 'Вы погибли';
				}elseif(isset($bu['id'])) {
	                 $er = 'Нельзя использовать свиток каждый ход...';
				}elseif($battle['noeff'] > 0 ) {
					$er = 'Запрет на использования свитков восстановления';
				}else{
					$last_hod = mysql_fetch_array(mysql_query('SELECT `id_hod` FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
		        $last_hod = $last_hod['id_hod'];
				$mass = array('time'=> time(), 'battle' => $u->info['battle'],'id_hod' => ($last_hod+1), 'text'=> 'Персонаж: <img src=http://'.$c['img'].'/i/align/align'.$u->info['align'].'.gif><img src=http://'.$c['img'].'/i/clan/'.$u->info['clan'].'.gif><b>'.$u->info['login'].'</b> - <b><font color=red>Использовал клановое восстановление </font><font color=red> +600 HP</b></font>','type' => 1);
				mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$mass['text'].'","'.$mass['vars'].'","","","","","'.$mass['type'].'")');
				$abil['hl10']--;
				$u->info['hpNow'] = $u->info['hpNow']+= 600; $u->info['tactic7'] = $u->info['tactic7'] -= 5;
				mysql_query('INSERT INTO `spells` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`) VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","1")');
				mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl10")');
				mysql_query('UPDATE `stats` SET `hpNow` = "'.$u->info['hpNow'].'",`tactic7` = "'.$u->info['tactic7'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				$er = 'Успешно использован свиток "Восстановление Энергии +600"<br></b>(Осталось восстановлений: '.$abil['hl10'].' на сегодня)<b>';
			}
		}
			if($abil['hl10'] > 0 ) {
			  $html .= '<img onclick="location.href=\'/main.php?clan&ability&hl10add\';" onMouseOver="top.hi(this,\'<b>Восстановление Энергии +600</b> (Осталось: '.$abil['hl10'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/cureHP600.gif">';
			}
		//Восстановление манны +250 МР
			if( isset($_GET['hl2add']) && $abil['hl2'] > 0 ) {
				$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$u->info['battle'].'" LIMIT 1'));
				$bu = mysql_fetch_array(mysql_query('SELECT * FROM `spells` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				if($u->info['mpNow']>=$u->stats['mpAll']) {
					$er = 'Вам незачем восстанавливать манну';
				}elseif($u->info['tactic7'] < 2.50 ) {
					$er = 'Недостаточно духа!';
				}elseif($u->info['hpNow'] < 1) {
					$er = 'Вы погибли';
				}elseif(isset($bu['id'])) {
	                 $er = 'Нельзя использовать свиток каждый ход...';
				}elseif($battle['noeff'] > 0 ) {
					$er = 'Запрет на использования свитков восстановления';
				}else{
				$abil['hl2']--;
				$last_hod = mysql_fetch_array(mysql_query('SELECT `id_hod` FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
		        $last_hod = $last_hod['id_hod'];
				$mass = array('time'=> time(), 'battle' => $u->info['battle'],'id_hod' => ($last_hod+1), 'text'=> 'Персонаж: <img src=http://'.$c['img'].'/i/align/align'.$u->info['align'].'.gif><img src=http://'.$c['img'].'/i/clan/'.$u->info['clan'].'.gif><b>'.$u->info['login'].'</b> - <b><font color=red>Использовал клановое восстановление </font><font color=red> +250 MP</b></font>','type' => 1);
				mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$mass['text'].'","'.$mass['vars'].'","","","","","'.$mass['type'].'")');
				$u->info['mpNow'] = $u->info['mpNow']+= 250; $u->info['tactic7'] = $u->info['tactic7'] -= 2.50;
				mysql_query('INSERT INTO `spells` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`) VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","1")');
				mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl2")');
				mysql_query('UPDATE `stats` SET `mpNow` = "'.$u->info['mpNow'].'",`tactic7` = "'.$u->info['tactic7'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				$er = 'Успешно использован свиток "Восстановление манны +250"<br></b>(Осталось восстановлений: '.$abil['hl2'].' на сегодня)<b>';
			}
		}
		if($abil['hl2'] > 0 ) {
				$html .= '<img onclick="location.href=\'/main.php?clan&ability&hl2add\';" onMouseOver="top.hi(this,\'<b>Восстановление манны +250</b> (Осталось: '.$abil['hl2'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/cureMana50.gif">';
			}
		//молча 15 минут
		if( isset($_GET['molch15add']) && $abil['molch15'] > 0 ) {
			$abil['molch15']--;
			$user = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_GET['molch15add']).'" LIMIT 1'));
			  if($u->info['login']==$user['login']) {
				$er = 'Вы не можете использовать молчанку на себя!';
			  }elseif($user['molch1'] > time()  ) {
				  $er = 'На персонаже уже есть заклятие молчания!';
			}elseif(!isset($user['id'])) {
				$er = 'Персонаж с логином &quot;'.htmlspecialchars($_GET['molch15add'],NULL,'cp1251').'&quot; не найден.';
			}else{
		   mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","molch15")');
		   mysql_query('UPDATE `users` SET `molch1` = "'.(time()+900).'" WHERE `login` = "'.mysql_real_escape_string($_GET['molch15add']).'" LIMIT 1 ');
			$er = 'Вы наказали молчанием персонажа <b> '.$u->microLogin($user['id'],1).'</b> сроком 15 минут <br> (Осталось: '.$abil['molch15'].' шт. на сегодня) ';
			$msg = '[img[items/silence15.gif]] Персонаж &quot;'.$u->info['login'].'&quot; наложил заклятие молчания на &quot;'.$user['login'].'&quot;, сроком 15 минут';
	        mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$msg."','".time()."','6','0','1')");
			
	}
		}
		if($u->info['battle'] > 0) {
				$html .= '';
		}elseif($abil['molch15'] > 0 ) {
				$html .= '<img onclick="mod6();" onMouseOver="top.hi(this,\'<b>Заклятие молчания</b> (Осталось: '.$abil['molch15'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/n/silence15.gif">';
			}
			//молча 30 минут
		if( isset($_GET['molch30add']) && $abil['molch30'] > 0 ) {
			$abil['molch30']--;
			$user = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_GET['molch30add']).'" LIMIT 1'));
			  if($u->info['login']==$user['login']) {
				$er = 'Вы не можете использовать молчанку на себя!';
			  }elseif($user['molch1'] > time()  ) {
				  $er = 'На персонаже уже есть заклятие молчания!';
			}elseif(!isset($user['id'])) {
				$er = 'Персонаж с логином &quot;'.htmlspecialchars($_GET['molch30add'],NULL,'cp1251').'&quot; не найден.';
			}else{
		   mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","molch30")');
		   mysql_query('UPDATE `users` SET `molch1` = "'.(time()+1800).'" WHERE `login` = "'.mysql_real_escape_string($_GET['molch30add']).'" LIMIT 1 ');
			$er = 'Вы наказали молчанием персонажа <b> '.$u->microLogin($user['id'],1).'</b> сроком 30 минут <br> (Осталось: '.$abil['molch30'].' шт. на сегодня) ';
			$msg = '[img[items/silence30.gif]] Персонаж &quot;'.$u->info['login'].'&quot; наложил заклятие молчания на &quot;'.$user['login'].'&quot;, сроком 30 минут';
	        mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`,`typeTime`) VALUES (1,'".$u->info['city']."','".$u->info['room']."','','','".$msg."','".time()."','6','0','1')");
			
	}
		}
		if($u->info['battle'] > 0) {
					$html .= '';
		}elseif($abil['molch30'] > 0 ) {
				$html .= '<img onclick="mod7();" onMouseOver="top.hi(this,\'<b>Заклятие молчания</b> (Осталось: '.$abil['molch30'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/n/silence30.gif">';
			}
			//выход из боя
		if( $u->stats['hpNow'] >= 1 && $u->info['admin'] == 0) {
			$u->error = '<font color=red><b>Вы должны погибнуть чтобы воспользоваться этим свитком...</b></font>';
		}elseif( isset($_GET['exit_battle']) && $abil['exit_btl'] > 0 ) {
			$abil['exit_btl']--;
			$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$u->info['battle'].'" LIMIT 1'));
			if( $battle['dn_id'] > 0 || $battle['izlom'] > 0 ) {
				$er = '<font color=red><b>Магия не действует в пещерах и подобных локациях...</b></font>';	
			}elseif( $battle['noinc'] == 1 ) {
				$er = '<font color=red><b>Бой изолирован и вы не можете его покинуть</b></font>';	
			}elseif( $battle['clone'] > 0 && $u->info['admin'] == 0 ) {
				$er = '<font color=red><b>Невозможно покинуть поединок с клоном</b></font>';
			}elseif($u->info['battle']==0) {
				$er = 'Использовать можно только в поединке!';
			}else{
				$last_hod = mysql_fetch_array(mysql_query('SELECT `id_hod` FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
					$last_hod = $last_hod['id_hod'];
					$mass = array('time'=> time(), 'battle' => $u->info['battle'],'id_hod' => ($last_hod+1), 'text'=> 'Персонаж: <img src=http://'.$c['img'].'/i/align/align'.$u->info['align'].'.gif><img src=http://'.$c['img'].'/i/clan/'.$u->info['clan'].'.gif><b>'.$u->info['login'].' - <font color=red>Сбежал с поля битвы... (с помощью кланового свитка)</b></font>','type' => 1);
					mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$mass['text'].'","'.$mass['vars'].'","","","","","'.$mass['type'].'")');
				
				mysql_query('INSERT INTO `users_noatack` (`uid`,`time`,`battle`) VALUES ("'.$u->info['id'].'","'.(time()+5*60).'","'.$u->info['battle'].'")');
				
				
				mysql_query('DELETE FROM `battle_rune_exp` WHERE `uid` = "'.$u->info['id'].'"');
				
				mysql_query('UPDATE `stats` SET `battle_yron` = 0, `battle_exp` = 0,`tactic1` = 0 , `tactic2` = 0 , `tactic3` = 0 , `tactic4` = 0 , `tactic5` = 0 , `tactic6` = 0 , `tactic7` = -1 , `last_pr` = 0 , `last_hp` = -1 , `team` = 0, `old_battle` = "'.$u->info['battle'].'" WHERE `id` = '.$u->info['id'].' LIMIT 1');
				mysql_query('UPDATE `users` SET `battle` = "0", `lose` = `lose` + 1 WHERE `id` = '.$u->info['id'].' LIMIT 1');
				mysql_query('DELETE FROM `eff_users` WHERE `v1` = "priem" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0');
				mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","exit_btl")');
				mysql_query('DELETE FROM `battle_users` WHERE `uid` = "'.$u->info['id'].'" AND `finish` = 0');
				$er = 'Вы сбежали с поля боя, ваши союзники насмехаются над вами...';
			}
		}
		if($abil['exit_btl'] > 0 ) {
				$html .= '<img onclick="location.href=\'/main.php?clan&ability&exit_battle\';" onMouseOver="top.hi(this,\'<b>Выход из боя</b> (Осталось: '.$abil['exit_btl'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/n/retreat.gif">';
			}

			//Восстановление манны +1000 МР
			if( isset($_GET['hl11add']) && $abil['hl11'] > 0 ) {
				$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$u->info['battle'].'" LIMIT 1'));
				$bu = mysql_fetch_array(mysql_query('SELECT * FROM `spells` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				if($u->info['tactic7'] < 5 ) {
					$er = 'Недостаточно духа!';
				}elseif($u->info['hpNow'] < 0) {
					$er = 'Вы умерли ...';
				}elseif($u->info['mpNow']>=$u->stats['mpAll']) {
					$er = 'Вам незачем восстанавливать манну';
				}elseif(isset($bu['id'])) {
	                 $er = 'Нельзя использовать свиток каждый ход...';
				}elseif($battle['noeff'] > 0 ) {
					$er = 'Запрет на использования свитков восстановления';
				}else{
					$last_hod = mysql_fetch_array(mysql_query('SELECT `id_hod` FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
		        $last_hod = $last_hod['id_hod'];
				$mass = array('time'=> time(), 'battle' => $u->info['battle'],'id_hod' => ($last_hod+1), 'text'=> 'Персонаж: <img src=http://'.$c['img'].'/i/align/align'.$u->info['align'].'.gif><img src=http://'.$c['img'].'/i/clan/'.$u->info['clan'].'.gif><b>'.$u->info['login'].'</b> - <b><font color=red>Использовал клановое восстановление </font><font color=red> +1000 MP</b></font>','type' => 1);
				mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$mass['text'].'","'.$mass['vars'].'","","","","","'.$mass['type'].'")');
				$abil['hl11']--;
				$u->info['mpNow'] = $u->info['mpNow']+= 1000; $u->info['tactic7'] = $u->info['tactic7'] -= 5;
				mysql_query('INSERT INTO `spells` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`) VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","1")');
				mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl11")');
				mysql_query('UPDATE `stats` SET `mpNow` = "'.$u->info['mpNow'].'",`tactic7` = "'.$u->info['tactic7'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				$er = 'Успешно использован свиток "Восстановление манны +1000"<br></b>(Осталось восстановлений: '.$abil['hl11'].' на сегодня)<b>';
			}
		}
			if($abil['hl11'] > 0 ) {
				$html .= '<img onclick="location.href=\'/main.php?clan&ability&hl11add\';" onMouseOver="top.hi(this,\'<b>Восстановление манны +1000</b> (Осталось: '.$abil['hl11'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/cureMana1000.gif">';
			}
			//лечени травм
			   if( isset($_GET['hl6add']) && $abil['hl6'] > 0 ) {
				   $abil['hl6']--;
				   mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES (
						"0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl6"
					)');
				 $travm = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid`="'.$u->info['id'].'" and `id_eff`="4" and `data` NOT LIKE "%|nelich=%" and `delete`="0" and `name` not like "%Неизлечимая травма%" LIMIT 1'));
                                    if($travm) {
										mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `id` = "'.$travm['id'].'" LIMIT 1');
										$er = 'Вы исцелились от "'.$travm['name'].'"</b><br>(Осталось лечений: '.$abil['hl6'].' на сегодня)';
									}else{
										$er = 'У вас нету травмы, или текущая травма Неизлечима';
									}
			}
			if($abil['hl6'] > 0 ) {
				 if($u->info['battle'] > 0) {
				   $html .= '';
			   }else{
				$html .= '<img onclick="location.href=\'/main.php?clan&ability&hl6add\';" onMouseOver="top.hi(this,\'<b>Лечени травм</b> (Осталось: '.$abil['hl6'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/pal_buttond.gif">';
			}
		}
			//уникальная тактика
			  if( isset($_GET['hl7add']) && $abil['hl7'] > 0 ) {
				 $bu = mysql_fetch_array(mysql_query('SELECT * FROM `tactic` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				 $trtct = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `battle_actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "use_cast_tactic" AND `btl` = "'.$u->info['battle'].'" AND `time` > "'.(time()-180).'" LIMIT 1'));
				if(isset($trtct['id'])) {
					$u->error = 'Задержка использования еще '.$u->timeOut($trtct['time']-time()+180);
				}elseif($u->info['battle'] == 0) {
					 $er = 'Использовать можно только в поединке!';
				}elseif(isset($bu['id'])) {
	                 $er = 'Нельзя использовать свиток каждый ход...';
				}else{
					mysql_query('INSERT INTO `battle_actions` (`uid`,`btl`,`time`,`vars`,`vals`) VALUES (
					"'.$u->info['id'].'","'.$u->info['battle'].'","'.time().'","use_cast_tactic",""
					)');
					$last_hod = mysql_fetch_array(mysql_query('SELECT `id_hod` FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
					$last_hod = $last_hod['id_hod'];
					$mass = array('time'=> time(), 'battle' => $u->info['battle'],'id_hod' => ($last_hod+1), 'text'=> 'Персонаж: <img src=http://'.$c['img'].'/i/align/align'.$u->info['align'].'.gif><img src=http://'.$c['img'].'/i/clan/'.$u->info['clan'].'.gif><b>'.$u->info['login'].'</b> - <b><font color=red>Использовал </font><font color=red> Уникальная тактика +1 (клановый свиток)</b></font>','type' => 1);
					mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$mass['text'].'","'.$mass['vars'].'","","","","","'.$mass['type'].'")');
					$abil['hl7']--;
					mysql_query('INSERT INTO `tactic` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`) VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","1")');
					   mysql_query('INSERT INTO `clan_ability` ( `item_id` , `date` , `clan` , `uid` , `time` , `pravo` ) VALUES ("0","'.date('d.m.Y').'","'.$u->info['clan'].'","'.$u->info['id'].'","'.time().'","hl7")');
				   mysql_query('UPDATE `stats` SET 
				   `tactic1` = `tactic1` + 1,
				   `tactic2` = `tactic2` + 1,
				   `tactic3` = `tactic3` + 1,
				   `tactic4` = `tactic4` + 1,
				   `tactic5` = `tactic5` + 1,
				   `tactic6` = `tactic6` + 1
				   WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				   $er = 'Вы использовали Уникальную тактику +1';
			   }
		}
			if($abil['hl7'] > 0 ) {
				$html .= '<img onclick="location.href=\'/main.php?clan&ability&hl7add\';" onMouseOver="top.hi(this,\'<b>Уникальная тактика</b> (Осталось: '.$abil['hl7'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/invoke_tactics5.gif">';
			}
			
			
			
		/////////////////
			//Колодцы 
			if( $abil['hpmp'] > 0 ) {
				$hplast = $abil['hpmp'];
				$mplast = $abil['hpmp'];
				//
				$hpcl = mysql_fetch_array(mysql_query('SELECT SUM(`val`) FROM `clan_ab` WHERE `var` = "hpvortex" AND `date` = "'.date('dmY').'" AND `clan` = "'.$clan['id'].'" LIMIT 1'));
				$hpcl = $hpcl[0];
				$mpcl = mysql_fetch_array(mysql_query('SELECT SUM(`val`) FROM `clan_ab` WHERE `var` = "mpvortex" AND `date` = "'.date('dmY').'" AND `clan` = "'.$clan['id'].'" LIMIT 1'));
				$mpcl = $mpcl[0];
				//
				$hplast -= $hpcl;
				$mplast -= $mpcl;
				//
				if(isset($_GET['hpvortex'])) {
					if($u->info['battle'] > 0) {
					$er = 'Невозможно использовать в поединке!';
				}
					elseif( $u->stats['hpNow'] >= $u->stats['hpAll'] ) {
						$er = 'Вам незачем восстанавливать здоровье (HP)';
					}elseif( $hplast > 0 ) {
						$heal = round($u->stats['hpAll']-$u->stats['hpNow']);
						if( $heal > $hplast ) {
							$heal = $hplast;
						}
						$u->stats['hpNow'] += $heal;
						$hplast -= $heal;
						//
						$er = 'Вы успешно восстановили '.$heal.' HP.';
						mysql_query('UPDATE `stats` SET `hpNow` = "'.$u->stats['hpNow'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						mysql_query('INSERT INTO `clan_ab` (`clan`,`var`,`val`,`uid`,`time`,`date`) VALUES (
							"'.$clan['id'].'","hpvortex","'.$heal.'","'.$u->info['id'].'","'.time().'","'.date('dmY').'"
						)');
						//
					}else{
						$er = 'Колодец исчерпал свои ресурсы, попробуйте завтра';
					}
				}
				//
				if(isset($_GET['mpvortex'])) {
					if($u->info['battle'] > 0) {
					$er = 'Невозможно использовать в поединке!';
				}else
					if( $u->stats['mpNow'] >= $u->stats['mpAll'] ) {
						$er = 'Вам незачем восстанавливать ману (MP)';
					}elseif( $mplast > 0 ) {
						$heal = round($u->stats['mpAll']-$u->stats['mpNow']);
						if( $heal > $mplast ) {
							$heal = $mplast;
						}
						$u->stats['mpNow'] += $heal;
						$mplast -= $heal;
						//
						$er = 'Вы успешно восстановили '.$heal.' MP.';
						mysql_query('UPDATE `stats` SET `mpNow` = "'.$u->stats['mpNow'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
						mysql_query('INSERT INTO `clan_ab` (`clan`,`var`,`val`,`uid`,`time`,`date`) VALUES (
							"'.$clan['id'].'","mpvortex","'.$heal.'","'.$u->info['id'].'","'.time().'","'.date('dmY').'"
						)');
						//
					}else{
						$er = 'Колодец исчерпал свои ресурсы, попробуйте завтра';
					}
				}
				//
			}
				
			
				?>
<script>
function abil1() {
	top.win.add(
		'abil1panel',
		'Помощь соклану &nbsp;',
		'<center><br>Введите логин соклана:<br><small>(Помогать можно только в нападениях)</small><br><br></center>',
		{
			'a1':'top.frames[\'main\'].abil1back(top.$(\'#abil1v1\').val());',
			'usewin':'top.chat.inObj = top.$(\'#abil1v1\');top.$(\'#abil1v1\').focus()',
			'd':'<center><input style="width:96%; margin:5px;" id="abil1v1" class="inpt2" type="text" value=""></center>'
		},
		3,
		1,
		'min-width:300px;'
	);
}
function abil1back( login ) {
	location.href='/main.php?clan&ability&brohelp='+login;
}
</script>
                <?
				
				//Помощь соклану и нападалки
				if(isset($_GET['brohelp'])) {
					$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `clan` = "'.$u->info['clan'].'" AND `login` = "'.mysql_real_escape_string($_GET['brohelp']).'" ORDER BY `id` ASC LIMIT 1'));
					$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$usr['battle'].'" LIMIT 1'));
					$b = mysql_fetch_array(mysql_query('SELECT `id`,`old_battle` FROM `stats` WHERE `id` = "'.$u->info['id'].'" AND `old_battle` > 0 LIMIT 1'));
					
					$usrst = mysql_fetch_array(mysql_query('SELECT `id`,`team` FROM `stats` WHERE `id` = "'.$usr['id'].'" LIMIT 1'));
					
					$noak = mysql_fetch_array(mysql_query('SELECT * FROM `users_noatack` WHERE `uid` = "'.$usr['id'].'" AND `time` > "'.time().'" ORDER BY `time` DESC LIMIT 1'));
					$noak2 = mysql_fetch_array(mysql_query('SELECT * FROM `users_noatack` WHERE `uid` = "'.$u->info['id'].'" AND `battle` = "'.$usr['battle'].'" LIMIT 1'));
					
					$mga1 = $u->testInbattle($usr,$battle,true);
					
					$ng = 0;
					
					$tma = array( 1 => 1 , 2 => 2 );
					$tma2 = array( 2 => 1 , 1 => 2 );
					$testHPa = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `bot` = 0 AND `hpNow` >= 1 AND `team` = '.$tma[$usrst['team']].' AND `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$battle['id'].'") LIMIT 1'));
					$testHPb = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `bot` = 0 AND `hpNow` >= 1 AND `team` = '.$tma2[$usrst['team']].' AND `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$battle['id'].'") LIMIT 1'));
					$testHPa = $testHPa[0];
					$testHPb = $testHPb[0];
					if( $testHPa <= $testHPb ) {
						$cln2 = mysql_fetch_array(mysql_query('SELECT `id`,`clan` FROM `users` WHERE `battle` = '.$battle['id'].' AND `clan` > 0 AND `id` IN (SELECT `id` FROM `stats` WHERE `team` = '.$tma[$usrst['team']].') LIMIT 1'));
						if(isset($cln2['id']) && $u->info['clan'] != $cln2['clan'] && $battle['cwar'] > 0) {
							$er = 'Нельзя вмешаться в бой т.к. здесь проходит противостояние двух кланов! Вы не состоите не в одном из них!';
							$ng = 1;
						}else{
							//$r = '-3';
						}
					}else{
						$er = 'Нельзя вмешаться в бой т.к. неравномерный баланс сил в этом поединке!';
						$ng = 1;
					}
					
					if( $battle['noatack'] > 0 ) {
						$er = 'Поединок защищен от нападения!'; 
						$ng = 1;
					}
					
					if( $battle['cwar'] > 0 ) {
						$er = 'Нельзя вмешиваться в клановые войны при помощи абилок!';
						$ng = 1;
					}
					
					if( $ng === 1 ) {
						//
					}elseif( $battle['noatack'] > 0 ) {
							$er = 'Поединок закрыт от нападения!';
					}elseif( $mga1 != '-1' ) {
							$er = $mga1;
					}elseif( isset($noak2['id']) ) {
							$er = 'Нельзя возвращаться в этот бой. Вы его покинули!';
					}elseif( isset($noak['id']) ) {
							$er = 'Нельзя нападать на персонажа еще '.$u->timeOut($noak['time']-time()).'.';
					}elseif($usr['battle'] == $b['old_battle']) {
			                $er = 'Невозможно вмешаться, вы уже были в этом поединке ;)';
					}elseif(isset($usr['id'])) {
						
						$itmart = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inOdet` > 0 AND `data` LIKE "%art=%" LIMIT 1'));
						$batlatest = mysql_fetch_array(mysql_query('SELECT `id`,`time_start` FROM `battle` WHERE `id` = "'.$usr['battle'].'" AND `team_win` = -1 LIMIT 1'));
						
						//unset($itmart);
												
						if( $u->info['battle'] > 0 ) {
							$er = 'Вы уже сражаетесь!';
						}elseif( $batlatest['id'] > 0 && ($u->info['room'] == 9 || $u->info['room'] == 323 || $u->info['room'] == 11 || $u->info['room'] == 213) && (
							(date('w',$batlatest['time_start']) == 2 && date('H',$batlatest['time_start']) >= 20 && date('H',$batlatest['time_start']) < 23) ||
							(date('w',$batlatest['time_start']) == 3 && date('H',$batlatest['time_start']) >= 18 && date('H',$batlatest['time_start']) <= 23) ||
							(date('w',$batlatest['time_start']) == 4 && date('H',$batlatest['time_start']) >= 20 && date('H',$batlatest['time_start']) < 23) ||
							(date('w',$batlatest['time_start']) == 5 && date('H',$batlatest['time_start']) >= 20 && date('H',$batlatest['time_start']) <= 23) ||
							(date('w',$batlatest['time_start']) == 6 && date('H',$batlatest['time_start']) >= 18 && date('H',$batlatest['time_start']) <= 23)
						) && true == false ) {
							$er = 'Нельзя нападать в артефактах во время комендантского часа!!!';
						}elseif( $usr['room'] != $u->info['room'] ) {
							$er = 'Вы должны находиться в одной комнате.';
						}elseif($battle['noinc'] == 1) {
							$er = 'Поединок защищен магией';
						}elseif( $usr['battle'] > 0 ) {
							$ubtl = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$usr['battle'].'" LIMIT 1'));
							if(!isset($ubtl['id'])) {
								$er = 'Поединок не найден!';
							}elseif($ubtl['team_win'] != -1) {
								$er = 'Поединок уже завершился!';
							}elseif($ubtl['razdel'] > 0 || $ubtl['dungeon'] > 0 || $ubtl['dn_id'] > 0 || $ubtl['izlom'] > 0){
								$er = 'Вмешиваться в турниры, пещерные бои и хаотичные поединки запрещено!';
							}else{
								//
								$usrst = mysql_fetch_array(mysql_query('SELECT `id`,`team` FROM `stats` WHERE `id` = "'.$usr['id'].'" LIMIT 1'));
								//Обновляем НР и МР игрокам
								if($u->info['level']<=7)
								{
									$u->info['tactic7'] = floor(10/$u->stats['hpAll']*$u->stats['hpNow']);
								}elseif($u->info['level']==8)
								{
									$u->info['tactic7'] = floor(20/$u->stats['hpAll']*$u->stats['hpNow']);
								}elseif($u->info['level']==9)
								{
									$u->info['tactic7'] = floor(30/$u->stats['hpAll']*$u->stats['hpNow']);
								}elseif($u->info['level']>=10)
								{
									$u->info['tactic7'] = floor(40/$u->stats['hpAll']*$u->stats['hpNow']);
								}
								//
								$u->info['tactic7'] += floor($u->stats['s7']/$u->stats['hpAll']*$u->stats['hpNow']);
								//
								// Бафф Зверя animal_bonus ---------------------------------
								if($u->info['animal'] > 0) {
									$a = mysql_fetch_array(mysql_query('SELECT * FROM `users_animal` WHERE `uid` = "'.$u->info['id'].'" AND `id` = "'.$u->info['animal'].'" AND `pet_in_cage` = "0" AND `delete` = "0" LIMIT 1'));
									if(isset($a['id'])) {
										if($a['eda']>=1) {
											$anl = mysql_fetch_array(mysql_query('SELECT `bonus` FROM `levels_animal` WHERE `type` = "'.$a['type'].'" AND `level` = "'.$a['level'].'" LIMIT 1'));
											$anl = $anl['bonus'];
											
											$tpa = array(1=>'cat',2=>'owl',3=>'wisp',4=>'demon',5=>'dog',6=>'pig',7=>'dragon');
											$tpa2 = array(1=>'Кота',2=>'Совы',3=>'Светляка',4=>'Чертяки',5=>'Пса',6=>'Свина',7=>'Дракона');
											$tpa3 = array(1=>'Кошачья Ловкость',2=>'Интуиция Совы',3=>'Сила Стихий',4=>'Демоническая Сила',5=>'Друг',6=>'Полная Броня',7=>'Инферно');
											
											mysql_query('INSERT INTO `eff_users` (`hod`,`v2`,`img2`,`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`v1`,`user_use`) VALUES ("-1","201","summon_pet_'.$tpa[$a['type']].'.gif",22,"'.$u->info['id'].'","'.$tpa3[$a['type']].' ['.$a['level'].']","'.$anl.'","0","77","priem","'.$u->info['id'].'")');
											
										}else{
											$u->send('',$u->info['room'],$u->info['city'],'',$u->info['login'],'<b>'.$a['name'].'</b> нуждается в еде...',time(),6,0,0,0,1);
										}
									}
								}
								//Духовность, спасение
								if( $u->stats['s7'] > 49 ) {
									mysql_query("
										INSERT INTO `eff_users` ( `id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`) VALUES
										( 22, '".$u->stats['id']."', 'Спасение', 'add_spasenie=1', 0, 77, 0, '".$u->stats['id']."', 0, 'priem', 324, 'preservation.gif', 1, -1, 'спасение', 0, 0, '', 0, 0, 0, 1, 0);
									");
								}					
								//
								mysql_query('UPDATE `users` SET `battle` = "'.$ubtl['id'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
								mysql_query('UPDATE `stats` SET `team` = "'.$usrst['team'].'",`tactic7` = "'.$u->info['tactic7'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
								//
								$u->info['battle'] = $usr['battle'];
								$u->info['team'] = $usrst['team'];

								$btxt = '';
								if( $u->info['align'] > 0 ) {
									$btxt = $btxt.'<img width=12 height=15 src=http://img.likebk.com/i/align/align'.$u->info['align'].'.gif >';
								}
								if( $u->info['align2'] > 0 ) {
									$btxt = $btxt.'<img width=12 height=15 src=http://img.likebk.com/i/align/align'.$u->info['align2'].'.gif >';
								}
								if( $u->info['clan'] > 0 ) {
									$btxt = $btxt.'<img width=24 height=15 src=http://img.likebk.com/i/clan/'.$u->info['clan'].'.gif >';
								}
								$btxt = $btxt.'<b>{u1}</b>['.$u->info['level'].']<a href=info/'.$u->info['id'].' target=_blank ><img width=12 height=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>';
								if( $u->info['sex'] == 1 ) {
									$btxt = $btxt.' вмешалась в поединок.';
								}else{
									$btxt = $btxt.' вмешался в поединок.';
								}
								$btxt .= ' (Помощь соклану <b>'.$usr['login'].'</b>['.$usr['level'].'] , ['.$testHPa.','.$testHPb.','.$mga1.','.$usr['battle'].','.$batlatest['id'].'])';

								$magic->inBattleLog($btxt,$usr);
								//
								$er = 'Вы успешно вмешались за соклана &quot;'.$usr['login'].'&quot;! (Страница обновится автоматически)';
							}
						}else{
							$er = 'Соклан не находится в поединке!';
						}
					}else{
						$er = 'Соклан с логином &quot;'.htmlspecialchars($_GET['brohelp']).'&quot; не найден.';
					}
				}
				
				if($u->info['battle'] > 0) {
					$html .= '';
				}else{
				$html .= '<img onclick="abil1();" onMouseOver="top.hi(this,\'<b>Помощь соклану</b> (Бесконечно)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/n/mirror.gif">';
			}
				if($u->info['battle'] > 0) {
					$html .= '';
				}elseif( $hplast < 1 ) {

					$html .= '<img class="pwqnovice" onMouseOver="top.hi(this,\'Абилка закончилась, попробуйте <b>позже</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" src="http://img.likebk.com/i/items/n/healvortex.gif">';
				}else{
					$html .= '<img onclick="location.href=\'/main.php?clan&ability&hpvortex\';" class="cp" onMouseOver="top.hi(this,\'Восстановить Здоровье (HP). Осталось: <b>'.$hplast.' HP</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" src="http://img.likebk.com/i/items/n/healvortex.gif">';
				}
			    if($u->info['battle'] > 0) {
					$html .= '';
				}elseif( $mplast < 1 ) {
					$html .= '<img class="pwqnovice" onMouseOver="top.hi(this,\'Абилка закончилась, попробуйте <b>позже</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" src="http://img.likebk.com/i/items/n/manavortex.gif">';
				}else{
					$html .= '<img onclick="location.href=\'/main.php?clan&ability&mpvortex\';" class="cp" onMouseOver="top.hi(this,\'Восстановить Ману (HP). Осталось: <b>'.$mplast.' MP</b>\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" src="http://img.likebk.com/i/items/n/manavortex.gif">';
				}
			}
			
					
			if($clan_prava['pravo6'] > 0) {
				$html == '';
			}elseif($clan_prava['pravo6'] == 0) {
				$html = 'У вашего клана нет абилок, или глава клана запретил вам их использовать ';
			}
			if($er != '') {
				echo '<div style="padding-bottom:10px;"><b><font color=red>'.$er.'</font></b></div>';
			}
			echo $html;
			unset($html);
			?>
        </fieldset>
   <? } elseif(isset($_GET['deposit'])) {
	
	$itmc = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `items_users` WHERE `uid` = "-21'.$res['id'].'" AND `delete` = 0 LIMIT 1'));
	$itmc = $itmc[0];
	$itms = mysql_fetch_array(mysql_query('SELECT `iu`.*,`im`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON `iu`.`item_id` = `im`.`id` WHERE `iu`.`uid` >= 0 AND `iu`.`delete` = "0"
		AND `iu`.`id` = "'.mysql_real_escape_string($_GET['ungive_itm']).'" LIMIT 1'));
	$ps = $u->lookStats($itms['data']);
	$ps['cl'] = explode('#', $ps['toclan']);
	$use_s = $ps['cl'][1];
	if(isset($_GET['ungive_itm']) && $ps['cl'][0] == $res['id'] && ($tt[14][0] == 1 || ($u->info['id'] == $use_s))) {
		$itm = mysql_fetch_array(mysql_query('SELECT `iu`.*,`im`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON `iu`.`item_id` = `im`.`id` WHERE `iu`.`uid` >= 0 AND `iu`.`delete` = "0"
		AND `iu`.`id` = "'.mysql_real_escape_string($_GET['ungive_itm']).'" LIMIT 1'));
		if(isset($itm['id'])) {
			$btlud = mysql_fetch_array(mysql_query('SELECT `id`,`battle` FROM `users` WHERE `id` = "'.$itm['uid'].'" LIMIT 1'));
			if( $u->testBattle($btlud['battle']) == true ) {
				echo '<font color="#FF0000"><b>Нельзя изымать предметы с персонажа в бою</b></font><br>';
			}else{
			 	echo $u->ungive_itm_cl($_GET['ungive_itm'], $u->info, $res['id']);
			}
		}
	} elseif(isset($_GET['take_itm']) && $tt[4][0] == 1) {
		$itm = mysql_fetch_array(mysql_query('SELECT `iu`.*,`im`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON `iu`.`item_id` = `im`.`id` WHERE `iu`.`uid`="-21'.$res['id'].'" AND `iu`.`delete`="0"
		AND `iu`.`id` = "'.mysql_real_escape_string($_GET['take_itm']).'" LIMIT 1'));
		if(isset($itm['id'])) {
		  echo $u->take_itm_cl($_GET['take_itm'], $u->info, $res['id']);
	    }
	} elseif(isset($_GET['give_itm'])) {
      $itm = mysql_fetch_array(mysql_query('SELECT `iu`.*,`im`.* FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON `iu`.`item_id` = `im`.`id` WHERE `iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `im`.`inslot` > 0 AND `iu`.`gift` = "" AND `iu`.`data` NOT LIKE "%frompisher=%"
		AND `iu`.`id` = "'.mysql_real_escape_string($_GET['give_itm']).'" LIMIT 1'));
		if($itmc >= $lvl_prava[$res['level']][5]) {
			echo '<font color="#FF0000"><b>Хранилище переполнено</b></font><br>';
		} elseif(isset($itm['id'])) {
		  echo $u->set_cl_item($_GET['give_itm'], $u->info, $res['id']);
		}
	}
	if($tt[4][0] == 1) {
		$itm_clan = $u->genInv(66, '(`iu`.`uid` = "-21'.$u->info['clan'].'" OR `iu`.`data` LIKE "%toclan='.$u->info['clan'].'#%") AND `iu`.`delete` = 0 AND `iu`.`inShop` = 0 ORDER BY `lastUPD` DESC');
	} else {
		$itm_clan[2] = '<br /><br /><center>У вас нет доступа к использованию хранилища</center>';
	}
	$itm_user = $u->genInv(65, '`iu`.`uid` = '.$u->info['id'].' AND `iu`.`delete` = 0 AND `iu`.`inOdet` = 0 AND `iu`.`inShop` = 0 AND `im`.`inslot` > 0 AND `iu`.`gift` = "" AND `iu`.`data` NOT LIKE "%frompisher=%" ORDER BY `lastUPD` DESC');
   
   ?>
   <div class="box visible">
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
         <td width="50%" valign="top">
    <fieldset style="margin:0;padding:0">
      <legend><span class="legtitle">Хранилище (предметов : <?=$itmc?>/<?=$lvl_prava[$res['level']][5]?>)</span></legend>
      <? if($itm_clan[2] != '') { ?>
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
	  <?=$itm_clan[2]?>
      </table>
      <? }else{ echo '<center><br />Хранилище клана пусто<br /><br /></center>'; } ?>
    </fieldset>
         </td>
         <td width="50%" valign="top">
    <fieldset style="margin:0;padding:0">
      <legend><span class="legtitle">Рюкзак</span></legend>
      <? if($itm_user[2] != '') { ?>
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
	  <?=$itm_user[2]?>
      </table>
      <? }else{ echo '<center><br />Рюкзак пуст<br /><br /></center>'; } ?>
    </fieldset>
         </td>
       </tr>
     </table>
   </div>
   <? }elseif(isset($_GET['titul']) && $tt[11][0]==1) { ?>
   <script>
   function editTitul(id) {
		if($('#edpnltitul'+id).css('display') == 'none') {
			$('#edpnltitul'+id).css({'display':''});
		}else{
			$('#edpnltitul'+id).css({'display':'none'});
		}
   }
   </script>
   <div class="box visible">
        <?
		if(isset($_POST['tituladd'])) {
			//Добавляем новый титул
			$tc = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_tituls` WHERE `clan` = "'.$res['id'].'" AND `delete` = "0" LIMIT 25'));
			if($tc[0] >= 20) {
				echo '<font color="#FF0000"><b>Нельзя добавлять более 25-ти титулов, для добавления нового сотрите старые</b></font><br>';
			}else{
				$nm = htmlspecialchars($_POST['tituladd'],NULL,'cp1251');
				if(str_replace(' ','',str_replace('	','',$nm)) == '') {
					echo '<font color="#FF0000"><b>Название титула не должно быть пустым</b></font><br>';
				}else{
					mysql_query('INSERT INTO `clan_tituls` (`prioritet`,`clan`,`user_add`,`time_add`,`name`) VALUES ("0","'.$res['id'].'","'.$u->info['id'].'","'.time().'","'.mysql_real_escape_string($nm).'")');
					echo '<font color="#FF0000"><b>Титул был успешно добавлен</b></font><br>';
				}
			}
		}elseif(isset($_GET['save'])) {
			//сохраняем титул
			$tc = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `clan` = "'.$res['id'].'" AND `id` = "'.mysql_real_escape_string($_GET['save']).'" AND `delete` = "0" LIMIT 1'));
			if(isset($tc['id'])) {
				$tc['info'] = htmlspecialchars($_POST['t_info'],NULL,'cp1251');
				$tc['prioritet'] = round((int)$_POST['t_prioritet']);
				if($tc['prioritet']>10000) {
					$tc['prioritet'] = 10000;
				}
				$i = 1;
				$tc['canals'] = '';
				while($i <= 9) {
					if($_POST['t_klan'.$i]) {
						$tc['canals'] .= '1';
					}else{
						$tc['canals'] .= '0';
					}
					$i++;
				}
				$i = 0;
				$tc['prava'] = '';
				while($i <= 20) {
					if($_POST['t_tr'.$i]) {
						$tc['prava'] .= '1';
					}else{
						$tc['prava'] .= '0';
					}
					$i++;
				}
				$_POST['colorsp'] = preg_replace('/[^a-zа-яё0-9]/i','',$_POST['colorsp']);
				mysql_query('UPDATE `clan_tituls` SET `prioritet` = "'.$tc['prioritet'].'",`info` = "'.mysql_real_escape_string($tc['info']).'", `color` = "'.mysql_real_escape_string($_POST['colorsp']).'", `canals` = "'.$tc['canals'].'", `prava` = "'.$tc['prava'].'" WHERE `id` = "'.$tc['id'].'" LIMIT 1');
				echo '<font color="#FF0000"><b>Титул был успешно сохранен</b></font><br>';
			}else{
				echo '<font color="#FF0000"><b>Титул не найден</b></font><br>';
			}
		}elseif(isset($_GET['delete'])) {
			$tc = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `clan` = "'.$res['id'].'" AND `id` = "'.mysql_real_escape_string($_GET['delete']).'" AND `delete` = "0" LIMIT 1'));
			if(isset($tc['id'])) {
				mysql_query('UPDATE `clan_tituls` SET `delete` = "'.$u->info['id'].'" WHERE `id` = "'.$tc['id'].'" LIMIT 1');
				echo '<font color="#FF0000"><b>Титул был удален</b></font><br>';
			}else{
				echo '<font color="#FF0000"><b>Титул не найден</b></font><br>';
			}
		}
?>
<div id="clrttl" style="display:none">
<br /><br />
<center><a onclick="ssclrttl()" href="javascript:void(0)">таблицей цветов - скрыть</a></center>
<br /><br />
<table width="100%" cellpadding="10" cellspacing="5">
  <tbody>
    <tr>
      <td>000000</td>
      <td>000033</td>
      <td>000066</td>
      <td>000099</td>
      <td>0000cc</td>
      <td>0000ff</td>
    </tr>
    <tr>
      <td bgcolor="#000000"></td>
      <td bgcolor="#000033"></td>
      <td bgcolor="#000066"></td>
      <td bgcolor="#000099"></td>
      <td bgcolor="#0000cc"></td>
      <td bgcolor="#0000ff"></td>
    </tr>
    <tr>
      <td>003300</td>
      <td>003333</td>
      <td>003366</td>
      <td>003399</td>
      <td>0033cc</td>
      <td>0033ff</td>
    </tr>
    <tr>
      <td bgcolor="#003300"></td>
      <td bgcolor="#003333"></td>
      <td bgcolor="#003366"></td>
      <td bgcolor="#003399"></td>
      <td bgcolor="#0033cc"></td>
      <td bgcolor="#0033ff"></td>
    </tr>
    <tr>
      <td>006600</td>
      <td>006633</td>
      <td>006666</td>
      <td>006699</td>
      <td>0066cc</td>
      <td>0066ff</td>
    </tr>
    <tr>
      <td bgcolor="#006600"></td>
      <td bgcolor="#006633"></td>
      <td bgcolor="#006666"></td>
      <td bgcolor="#006699"></td>
      <td bgcolor="#0066cc"></td>
      <td bgcolor="#0066ff"></td>
    </tr>
    <tr>
      <td>009900</td>
      <td>009933</td>
      <td>009966</td>
      <td>009999</td>
      <td>0099cc</td>
      <td>0099ff</td>
    </tr>
    <tr>
      <td bgcolor="#009900"></td>
      <td bgcolor="#009933"></td>
      <td bgcolor="#009966"></td>
      <td bgcolor="#009999"></td>
      <td bgcolor="#0099cc"></td>
      <td bgcolor="#0099ff"></td>
    </tr>
    <tr>
      <td>00cc00</td>
      <td>00cc33</td>
      <td>00cc66</td>
      <td>00cc99</td>
      <td>00cccc</td>
      <td>00ccff</td>
    </tr>
    <tr>
      <td bgcolor="#00cc00"></td>
      <td bgcolor="#00cc33"></td>
      <td bgcolor="#00cc66"></td>
      <td bgcolor="#00cc99"></td>
      <td bgcolor="#00cccc"></td>
      <td bgcolor="#00ccff"></td>
    </tr>
    <tr>
      <td>00ff00</td>
      <td>00ff33</td>
      <td>00ff66</td>
      <td>00ff99</td>
      <td>00ffcc</td>
      <td>00ffff</td>
    </tr>
    <tr>
      <td bgcolor="#00ff00"></td>
      <td bgcolor="#00ff33"></td>
      <td bgcolor="#00ff66"></td>
      <td bgcolor="#00ff99"></td>
      <td bgcolor="#00ffcc"></td>
      <td bgcolor="#00ffff"></td>
    </tr>
    <tr>
      <td>330000</td>
      <td>330033</td>
      <td>330066</td>
      <td>330099</td>
      <td>3300cc</td>
      <td>3300ff</td>
    </tr>
    <tr>
      <td bgcolor="#330000"></td>
      <td bgcolor="#330033"></td>
      <td bgcolor="#330066"></td>
      <td bgcolor="#330099"></td>
      <td bgcolor="#3300cc"></td>
      <td bgcolor="#3300ff"></td>
    </tr>
    <tr>
      <td>333300</td>
      <td>333333</td>
      <td>333366</td>
      <td>333399</td>
      <td>3333cc</td>
      <td>3333ff</td>
    </tr>
    <tr>
      <td bgcolor="#333300"></td>
      <td bgcolor="#333333"></td>
      <td bgcolor="#333366"></td>
      <td bgcolor="#333399"></td>
      <td bgcolor="#3333cc"></td>
      <td bgcolor="#3333ff"></td>
    </tr>
    <tr>

      <td>336600</td>
      <td>336633</td>
      <td>336666</td>
      <td>336699</td>
      <td>3366cc</td>
      <td>3366ff</td>
    </tr>
    <tr>
      <td bgcolor="#336600"></td>
      <td bgcolor="#336633"></td>
      <td bgcolor="#336666"></td>
      <td bgcolor="#336699"></td>
      <td bgcolor="#3366cc"></td>
      <td bgcolor="#3366ff"></td>
    </tr>
    <tr>
      <td>339900</td>
      <td>339933</td>
      <td>339966</td>
      <td>339999</td>
      <td>3399cc</td>
      <td>3399ff</td>
    </tr>
    <tr>
      <td bgcolor="#339900"></td>
      <td bgcolor="#339933"></td>
      <td bgcolor="#339966"></td>
      <td bgcolor="#339999"></td>
      <td bgcolor="#3399cc"></td>
      <td bgcolor="#3399ff"></td>
    </tr>
    <tr>
      <td>33cc00</td>
      <td>33cc33</td>
      <td>33cc66</td>
      <td>33cc99</td>
      <td>33cccc</td>
      <td>33ccff</td>
    </tr>
    <tr>
      <td bgcolor="#33cc00"></td>
      <td bgcolor="#33cc33"></td>
      <td bgcolor="#33cc66"></td>
      <td bgcolor="#33cc99"></td>
      <td bgcolor="#33cccc"></td>
      <td bgcolor="#33ccff"></td>
    </tr>
    <tr>
      <td>33ff00</td>
      <td>33ff33</td>
      <td>33ff66</td>
      <td>33ff99</td>
      <td>33ffcc</td>
      <td>33ffff</td>
    </tr>
    <tr>
      <td bgcolor="#33ff00"></td>
      <td bgcolor="#33ff33"></td>
      <td bgcolor="#33ff66"></td>
      <td bgcolor="#33ff99"></td>
      <td bgcolor="#33ffcc"></td>
      <td bgcolor="#33ffff"></td>
    </tr>
    <tr>
      <td>660000</td>
      <td>660033</td>
      <td>660066</td>
      <td>660099</td>
      <td>6600cc</td>
      <td>6600ff</td>
    </tr>
    <tr>
      <td bgcolor="#660000"></td>
      <td bgcolor="#660033"></td>
      <td bgcolor="#660066"></td>
      <td bgcolor="#660099"></td>
      <td bgcolor="#6600cc"></td>
      <td bgcolor="#6600ff"></td>
    </tr>
    <tr>
      <td>663300</td>
      <td>663333</td>
      <td>663366</td>
      <td>663399</td>
      <td>6633cc</td>
      <td>6633ff</td>
    </tr>
    <tr>
      <td bgcolor="#663300"></td>
      <td bgcolor="#663333"></td>
      <td bgcolor="#663366"></td>
      <td bgcolor="#663399"></td>
      <td bgcolor="#6633cc"></td>
      <td bgcolor="#6633ff"></td>
    </tr>
    <tr>
      <td>666600</td>
      <td>666633</td>
      <td>666666</td>
      <td>666699</td>
      <td>6666cc</td>
      <td>6666ff</td>
    </tr>
    <tr>
      <td bgcolor="#666600"></td>
      <td bgcolor="#666633"></td>
      <td bgcolor="#666666"></td>
      <td bgcolor="#666699"></td>
      <td bgcolor="#6666cc"></td>
      <td bgcolor="#6666ff"></td>
    </tr>
    <tr>
      <td>669900</td>
      <td>669933</td>
      <td>669966</td>
      <td>669999</td>
      <td>6699cc</td>
      <td>6699ff</td>
    </tr>
    <tr>
      <td bgcolor="#669900"></td>
      <td bgcolor="#669933"></td>
      <td bgcolor="#669966"></td>
      <td bgcolor="#669999"></td>
      <td bgcolor="#6699cc"></td>
      <td bgcolor="#6699ff"></td>
    </tr>
    <tr>
      <td>66cc00</td>
      <td>66cc33</td>
      <td>66cc66</td>
      <td>66cc99</td>
      <td>66cccc</td>
      <td>66ccff</td>
    </tr>
    <tr>
      <td bgcolor="#66cc00"></td>
      <td bgcolor="#66cc33"></td>
      <td bgcolor="#66cc66"></td>
      <td bgcolor="#66cc99"></td>
      <td bgcolor="#66cccc"></td>
      <td bgcolor="#66ccff"></td>
    </tr>
    <tr>
      <td>66ff00</td>
      <td>66ff33</td>
      <td>66ff66</td>
      <td>66ff99</td>
      <td>66ffcc</td>
      <td>66ffff</td>
    </tr>
    <tr>
      <td bgcolor="#66ff00"></td>
      <td bgcolor="#66ff33"></td>
      <td bgcolor="#66ff66"></td>
      <td bgcolor="#66ff99"></td>
      <td bgcolor="#66ffcc"></td>
      <td bgcolor="#66ffff"></td>
    </tr>
    <tr>
      <td>990000</td>
      <td>990033</td>
      <td>990066</td>
      <td>990099</td>
      <td>9900cc</td>
      <td>9900ff</td>
    </tr>
    <tr>
      <td bgcolor="#990000"></td>
      <td bgcolor="#990033"></td>
      <td bgcolor="#990066"></td>
      <td bgcolor="#990099"></td>
      <td bgcolor="#9900cc"></td>
      <td bgcolor="#9900ff"></td>
    </tr>
    <tr>
      <td>993300</td>
      <td>993333</td>
      <td>993366</td>
      <td>993399</td>
      <td>9933cc</td>
      <td>9933ff</td>
    </tr>
    <tr>
      <td bgcolor="#993300"></td>
      <td bgcolor="#993333"></td>
      <td bgcolor="#993366"></td>
      <td bgcolor="#993399"></td>
      <td bgcolor="#9933cc"></td>
      <td bgcolor="#9933ff"></td>
    </tr>
    <tr>
      <td>996600</td>
      <td>996633</td>
      <td>996666</td>
      <td>996699</td>
      <td>9966cc</td>
      <td>9966ff</td>
    </tr>
    <tr>
      <td bgcolor="#996600"></td>
      <td bgcolor="#996633"></td>
      <td bgcolor="#996666"></td>
      <td bgcolor="#996699"></td>
      <td bgcolor="#9966cc"></td>
      <td bgcolor="#9966ff"></td>
    </tr>
    <tr>
      <td>999900</td>
      <td>999933</td>
      <td>999966</td>
      <td>999999</td>
      <td>9999cc</td>
      <td>9999ff</td>
    </tr>
    <tr>
      <td bgcolor="#999900"></td>
      <td bgcolor="#999933"></td>
      <td bgcolor="#999966"></td>
      <td bgcolor="#999999"></td>
      <td bgcolor="#9999cc"></td>
      <td bgcolor="#9999ff"></td>
    </tr>
    <tr>
      <td>99cc00</td>
      <td>99cc33</td>
      <td>99cc66</td>
      <td>99cc99</td>
      <td>99cccc</td>
      <td>99ccff</td>
    </tr>
    <tr>
      <td bgcolor="#99cc00"></td>
      <td bgcolor="#99cc33"></td>
      <td bgcolor="#99cc66"></td>
      <td bgcolor="#99cc99"></td>
      <td bgcolor="#99cccc"></td>
      <td bgcolor="#99ccff"></td>
    </tr>
    <tr>
      <td>99ff00</td>
      <td>99ff33</td>
      <td>99ff66</td>
      <td>99ff99</td>
      <td>99ffcc</td>
      <td>99ffff</td>
    </tr>
    <tr>
      <td bgcolor="#99ff00"></td>
      <td bgcolor="#99ff33"></td>
      <td bgcolor="#99ff66"></td>
      <td bgcolor="#99ff99"></td>
      <td bgcolor="#99ffcc"></td>
      <td bgcolor="#99ffff"></td>
    </tr>
    <tr>
      <td>cc0000</td>
      <td>cc0033</td>
      <td>cc0066</td>
      <td>cc0099</td>
      <td>cc00cc</td>
      <td>cc00ff</td>
    </tr>
    <tr>
      <td bgcolor="#cc0000"></td>
      <td bgcolor="#cc0033"></td>
      <td bgcolor="#cc0066"></td>
      <td bgcolor="#cc0099"></td>
      <td bgcolor="#cc00cc"></td>
      <td bgcolor="#cc00ff"></td>
    </tr>
    <tr>
      <td>cc3300</td>
      <td>cc3333</td>
      <td>cc3366</td>
      <td>cc3399</td>
      <td>cc33cc</td>
      <td>cc33ff</td>
    </tr>
    <tr>
      <td bgcolor="#cc3300"></td>
      <td bgcolor="#cc3333"></td>
      <td bgcolor="#cc3366"></td>
      <td bgcolor="#cc3399"></td>
      <td bgcolor="#cc33cc"></td>
      <td bgcolor="#cc33ff"></td>
    </tr>
    <tr>
      <td>cc6600</td>
      <td>cc6633</td>
      <td>cc6666</td>
      <td>cc6699</td>
      <td>cc66cc</td>
      <td>cc66ff</td>
    </tr>
    <tr>
      <td bgcolor="#cc6600"></td>
      <td bgcolor="#cc6633"></td>
      <td bgcolor="#cc6666"></td>
      <td bgcolor="#cc6699"></td>
      <td bgcolor="#cc66cc"></td>
      <td bgcolor="#cc66ff"></td>
    </tr>
    <tr>
      <td>cc9900</td>
      <td>cc9933</td>
      <td>cc9966</td>
      <td>cc9999</td>
      <td>cc99cc</td>
      <td>cc99ff</td>
    </tr>
    <tr>
      <td bgcolor="#cc9900"></td>
      <td bgcolor="#cc9933"></td>
      <td bgcolor="#cc9966"></td>
      <td bgcolor="#cc9999"></td>
      <td bgcolor="#cc99cc"></td>
      <td bgcolor="#cc99ff"></td>
    </tr>
    <tr>
      <td>cccc00</td>
      <td>cccc33</td>
      <td>cccc66</td>
      <td>cccc99</td>
      <td>cccccc</td>
      <td>ccccff</td>
    </tr>
    <tr>
      <td bgcolor="#cccc00"></td>
      <td bgcolor="#cccc33"></td>
      <td bgcolor="#cccc66"></td>
      <td bgcolor="#cccc99"></td>
      <td bgcolor="#cccccc"></td>
      <td bgcolor="#ccccff"></td>
    </tr>
    <tr>
      <td>ccff00</td>
      <td>ccff33</td>
      <td>ccff66</td>
      <td>ccff99</td>
      <td>ccffcc</td>
      <td>ccffff</td>
    </tr>
    <tr>
      <td bgcolor="#ccff00"></td>
      <td bgcolor="#ccff33"></td>
      <td bgcolor="#ccff66"></td>
      <td bgcolor="#ccff99"></td>
      <td bgcolor="#ccffcc"></td>
      <td bgcolor="#ccffff"></td>
    </tr>
    <tr>
      <td>ff0000</td>
      <td>ff0033</td>
      <td>ff0066</td>
      <td>ff0099</td>
      <td>ff00cc</td>
      <td>ff00ff</td>
    </tr>
    <tr>
      <td bgcolor="#ff0000"></td>
      <td bgcolor="#ff0033"></td>
      <td bgcolor="#ff0066"></td>
      <td bgcolor="#ff0099"></td>
      <td bgcolor="#ff00cc"></td>
      <td bgcolor="#ff00ff"></td>
    </tr>
    <tr>
      <td>ff3300</td>
      <td>ff3333</td>
      <td>ff3366</td>
      <td>ff3399</td>
      <td>ff33cc</td>
      <td>ff33ff</td>
    </tr>
    <tr>
      <td bgcolor="#ff3300"></td>
      <td bgcolor="#ff3333"></td>
      <td bgcolor="#ff3366"></td>
      <td bgcolor="#ff3399"></td>
      <td bgcolor="#ff33cc"></td>
      <td bgcolor="#ff33ff"></td>
    </tr>
    <tr>
      <td>ff6600</td>
      <td>ff6633</td>
      <td>ff6666</td>
      <td>ff6699</td>
      <td>ff66cc</td>
      <td>ff66ff</td>
    </tr>
    <tr>
      <td bgcolor="#ff6600"></td>
      <td bgcolor="#ff6633"></td>
      <td bgcolor="#ff6666"></td>
      <td bgcolor="#ff6699"></td>
      <td bgcolor="#ff66cc"></td>
      <td bgcolor="#ff66ff"></td>
    </tr>
    <tr>
      <td>ff9900</td>
      <td>ff9933</td>
      <td>ff9966</td>
      <td>ff9999</td>
      <td>ff99cc</td>
      <td>ff99ff</td>
    </tr>
    <tr>
      <td bgcolor="#ff9900"></td>
      <td bgcolor="#ff9933"></td>
      <td bgcolor="#ff9966"></td>
      <td bgcolor="#ff9999"></td>
      <td bgcolor="#ff99cc"></td>
      <td bgcolor="#ff99ff"></td>
    </tr>
    <tr>
      <td>ffcc00</td>
      <td>ffcc33</td>
      <td>ffcc66</td>
      <td>ffcc99</td>
      <td>ffcccc</td>
      <td>ffccff</td>
    </tr>
    <tr>
      <td bgcolor="#ffcc00"></td>
      <td bgcolor="#ffcc33"></td>
      <td bgcolor="#ffcc66"></td>
      <td bgcolor="#ffcc99"></td>
      <td bgcolor="#ffcccc"></td>
      <td bgcolor="#ffccff"></td>
    </tr>
    <tr>
      <td>ffff00</td>
      <td>ffff33</td>
      <td>ffff66</td>
      <td>ffff99</td>
      <td>ffffcc</td>
      <td>ffffff</td>
    </tr>
    <tr>
      <td bgcolor="#ffff00"></td>
      <td bgcolor="#ffff33"></td>
      <td bgcolor="#ffff66"></td>
      <td bgcolor="#ffff99"></td>
      <td bgcolor="#ffffcc"></td>
      <td bgcolor="#ffffff"></td>
    </tr>
  </tbody>
</table>
</div>
<script>
function ssclrttl() {
	if($('#clrttl').css('display') == 'none') {
		$('#clrttl').css({'display':''});
	}else{
		$('#clrttl').css({'display':'none'});
	}
}
</script>
<?
		$i = 0;
		$sp = mysql_query('SELECT * FROM `clan_tituls` WHERE `clan` = "'.$res['id'].'" AND `delete` = "0" LIMIT 25');
		while($pl = mysql_fetch_array($sp)) {
		?>
		<div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
        
        <b style="color:#<?=$pl['color']?>">*</b> &nbsp; <a style="display:inline-block;width:250px;" onclick="editTitul(<?=$pl['id']?>)" href="javascript:void(0)"><?=$pl['name']?></a><font color="#999999"><i><?=$pl['info']?></i></font>
        <img src="http://img.likebk.com/i/clear.gif" title="Удалить титул" onclick="location='main.php?clan&titul&delete=<?=$pl['id']?>'" style="float:right;cursor:pointer;">
        <div id="edpnltitul<?=$pl['id']?>" style="display:none;margin:10px;border:1px solid #9e9e9e;padding:10px;">
           <form method="post" action="?clan&titul&save=<?=$pl['id']?>">
           <span style="float:right"><a onclick="editTitul(<?=$pl['id']?>)" href="javascript:void(0)">x</a></span>
                <center>Редактирование титула <a onclick="editTitul(<?=$pl['id']?>)" href="javascript:void(0)"><?=$pl['name']?></a></center><br>
                Описание: <input style="width:360px;" value="<?=$pl['info']?>" type="text" name="t_info"><br>
                Приоритет: <input style="text-align:center;width:50px;" value="<?=$pl['prioritet']?>" type="text" name="t_prioritet" /> <small>Чем выше значение, тем круче! :)</small><br />
                <br>
                Каналы чата: 
                <? $j = 1;
				while($j <= 9) {
						if($pl['canals'][$j-1] == 1) {
							$pl['check'] = 'checked';
						}else{
							$pl['check'] = '';
						}
				?> 
                <label for="t_klan<?=$j?>"><?=$j?></label>
                <input <?=$pl['check']?> type="checkbox" <?=$pl['check2']?> name="t_klan<?=$j?>" id="t_klan<?=$j?>">
                <? $j++; }
				echo '<br><br>';
				$j = 1;
				while($j < count($tt)) {
					if($tt[$j][1] != '0') {
						if($pl['prava'][$j] == 1) {
							$pl['check'] = 'checked';
						}else{
							$pl['check'] = '';
						}
						?>
                <input <?=$pl['check']?> type="checkbox" name="t_tr<?=$j?>" id="t_tr<?=$j?>">
                <label for="t_tr<?=$j?>"><?=$tt[$j][1]?></label><br>
                        <?
					}
					$j++;
				}
				?>
                <br>
                Картинка: *<br>
                Цвет: &nbsp; &nbsp; &nbsp; <div style="cursor:pointer;display:inline-block;width:20px;height:15px;background-color:#<?=$pl['color']?>">&nbsp;</div> #<input name="colorsp" maxlength="6" type="text" value="<?=$pl['color']?>" /><br />
                <small>(вы можете воспользовать <a onclick="ssclrttl()" href="javascript:void(0)">таблицей цветов - показать/скрыть</a>)</small><br />
       		 <br><br>
                <input type="submit" value="Сохранить">
          </form>
          </div>
        </div>
     <?
   		$i++;
		}

		if($i == 0) {
			echo 'В клане нет ни одного титула';
		}
		?>
        <input type="button" onclick="addNewTitul()" value="Добавить титул">
   </div>
   <? }elseif(isset($_GET['rules'])) { ?>
   <div  class="box visible">
    <fieldset style="border:1px dashed #eeeeee">
      <legend><span class="legtitle">Права персонажа &quot;<?=$u->info['login']?>&quot;</span></legend>
      <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
      Звание в клане: <b><?
      
	  if($u->info['clan_prava'] != 'glava') {
		echo $u->info['moder_zvanie'];  
	  }else{
		echo '<b style="color:#008097">глава клана</b>'; 
	  }
	  
	  ?></b>
      </div>
      <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
      Титул: <b><?=$utitl['name']?></b> &nbsp; - &nbsp; <font color="#999999"><?=$utitl['info']?></font>
      </div>
                <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
                Каналы чата: 
                <? $j = 1;
				while($j <= 9) {
					if($utitl['canals'][$j-1] == 1) {
                		$r .= '<a href="javascript:void(0)">klan-'.$j.'</a>, ';
					}
               	 	$j++;
				}
				echo rtrim($r,', ');
				?>
                </div>              
                <?
				$j = 1;
				while($j < count($tt)) {
					if($tt[$j][1] != '0') {
						if($utitl['prava'][$j] == 1) {
							$utitl['check'] = 'Да';
						}else{
							$utitl['check'] = 'Нет';
						}
						?>
                <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
                <div style="display:inline-block;width:410px;">&bull; <?=$tt[$j][1]?></div><?=$utitl['check']?>
                </div>
                        <?
					}
					$j++;
				}
				?>
                
    </fieldset>
   </div>
   <? }elseif(isset($_GET['info'])) {
		
   ?>   
   <div class="box visible">
    <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
    Название клана: <img src="http://img.likebk.com/i/clan/<?=$res['name_mini']?>.gif" style="vertical-align:bottom" width="24" height="15"><a href="javascript:void(0)"><?=$res['name']?></a> (<?=$res['name_mini']?>)
    </div>
    <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
    Уровень клана: <?=$res['level']?>
    </div>
    <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
    Опыт клана: <?=number_format($res['exp'], 0, ",", " ")?> / <?=number_format($lvl_exp[$res['level']+1], 0, ",", " ")?>
    <div style="width:200px;display:inline-block;border:1px solid #aeaeae">
    	<div style="width:<?=ceil(($res['exp']-$lvl_exp[$res['level']])/$lvl_exp[$res['level']+1]*200)?>px;display:inline-block;padding-left:4px;padding-right:4px;text-align:right;background-color:#E9F7E8;color:#1B3618">
        <b><?=ceil(($res['exp']-$lvl_exp[$res['level']])/$lvl_exp[$res['level']+1]*100)?>%</b>
        </div>
    </div>
    </div>
    <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
    <table width="500" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="220">Статистика кланового опыта:</td>
        <td width="100">&bull; За сегодня:</td>
        <td><b style="color:#0033a1"><?=$res['exp1']?></b></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&bull; За неделю:</td>
        <td><b style="color:#0033a1"><?=$res['exp2']?></b></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&bull; За месяц:</td>
        <td><b style="color:#0033a1"><?=$res['exp3']?></b></td>
      </tr>
    </table>
    </div>
    <div style="border-bottom:1px solid #cac9c7;margin-bottom:5px;padding-bottom:5px;">
    <table width="100%" border="0" style="border:1px solid #232323;" cellspacing="0" cellpadding="5">
  <tr>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;border-right:1px solid #232323;" bgcolor="#cccccc"><strong>Уровень</strong></td>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;border-right:1px solid #232323;" bgcolor="#cccccc"><strong>Игроки</strong></td>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;border-right:1px solid #232323;" bgcolor="#cccccc"><strong>Союз</strong></td>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;border-right:1px solid #232323;" bgcolor="#cccccc"><strong>Создать союз</strong></td>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;border-right:1px solid #232323;" bgcolor="#cccccc"><strong>Альянс</strong></td>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;border-right:1px solid #232323;" bgcolor="#cccccc"><strong>Создать альянс</strong></td>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;border-right:1px solid #232323;" bgcolor="#cccccc"><strong>Хранилище</strong></td>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;border-right:1px solid #232323;" bgcolor="#cccccc"><strong>Передач на игрока</strong></td>
    <td align="center" valign="middle" style="border-bottom:1px solid #232323;" bgcolor="#cccccc"><strong>Передач всего</strong></td>
  </tr>
  <?
  $i = 0;
  $yn = array('Нет','Да');
  while($i < count($lvl_prava)) {
	  $bgclr = '';
	  if($res['level'] >= $i) {
		 $bgclr = ' bgcolor="#8fd155"'; 
	  }
	  if($i < count($lvl_prava)-1) {
  ?>
  <tr<?=$bgclr?>>
    <td style="border-bottom:1px solid #232323;border-right:1px solid #232323;" align="center" valign="middle"><?=$i?></td>
    <td style="border-bottom:1px solid #232323;border-right:1px solid #232323;" align="center" valign="middle"><?=$lvl_prava[$i][0]?></td>
    <td style="border-bottom:1px solid #232323;border-right:1px solid #232323;" align="center" valign="middle"><?=$yn[$lvl_prava[$i][1]]?></td>
    <td style="border-bottom:1px solid #232323;border-right:1px solid #232323;" align="center" valign="middle"><?=$yn[$lvl_prava[$i][2]]?></td>
    <td style="border-bottom:1px solid #232323;border-right:1px solid #232323;" align="center" valign="middle"><?=$yn[$lvl_prava[$i][3]]?></td>
    <td style="border-bottom:1px solid #232323;border-right:1px solid #232323;" align="center" valign="middle"><?=$yn[$lvl_prava[$i][4]]?></td>
    <td style="border-bottom:1px solid #232323;border-right:1px solid #232323;" align="center" valign="middle"><?=$lvl_prava[$i][5]?></td>
    <td style="border-bottom:1px solid #232323;border-right:1px solid #232323;" align="center" valign="middle"><?=$lvl_prava[$i][6]?></td>
    <td style="border-bottom:1px solid #232323;" align="center" valign="middle"><?=$lvl_prava[$i][7]?></td>
  </tr>
  <?
	  }else{
		  
  ?>
  <tr<?=$bgclr?>>
    <td style="border-right:1px solid #232323;" align="center" valign="middle"><?=$i?></td>
    <td style="border-right:1px solid #232323;" align="center" valign="middle"><?=$lvl_prava[$i][0]?></td>
    <td style="border-right:1px solid #232323;" align="center" valign="middle"><?=$yn[$lvl_prava[$i][1]]?></td>
    <td style="border-right:1px solid #232323;" align="center" valign="middle"><?=$yn[$lvl_prava[$i][2]]?></td>
    <td style="border-right:1px solid #232323;" align="center" valign="middle"><?=$yn[$lvl_prava[$i][3]]?></td>
    <td style="border-right:1px solid #232323;" align="center" valign="middle"><?=$yn[$lvl_prava[$i][4]]?></td>
    <td style="border-right:1px solid #232323;" align="center" valign="middle"><?=$lvl_prava[$i][5]?></td>
    <td style="border-right:1px solid #232323;" align="center" valign="middle"><?=$lvl_prava[$i][6]?></td>
    <td align="center" valign="middle"><?=$lvl_prava[$i][7]?></td>
  </tr>
  <?
	  }
  $i++;
  }
  ?>
  </table>
    </div>
       <? $clan_inf = mysql_fetch_array(mysql_query('SELECT * FROM `clan_info` WHERE `id` = "'.$res['id'].'"')); 
    	if(!isset($clan_inf['id'])){
    		$clan_inf['info'] = '';
    		$clan_inf['deviz'] = '';
    		$upd = mysql_query('INSERT INTO `clan_info` (`id`,`info`, `deviz`) VALUES ("'.$res['id'].'", "", "")');
    	}
    	if(isset($_POST['clans_inf'])){
    		$upd = mysql_query('UPDATE `clan_info` SET `info`="'.mysql_real_escape_string($_POST['clan_info']).'", `deviz`="'.mysql_real_escape_string($_POST['clan_deviz']).'" WHERE `id` = "'.$res['id'].'" ');
    		if($upd){
    			echo '<b><font color=red>Информация о клане успешно обновлена.</font></b>';
    			$clan_inf = mysql_fetch_array(mysql_query('SELECT * FROM `clan_info` WHERE `id` = "'.$res['id'].'"')); 
    		}
    	}
    	?>
    <fieldset style="border: 1px solid white; padding: 18px 12px 18px 12px;margin-top:15px;">
    <legend style="font-weight:bold; color:#8F0000;">О клане</legend>
    <form method="post" action="">
    	<b>Девиз клана:</b><br>
    	<input class="form-control" name="clan_deviz" type="text" value="<?=$clan_inf['deviz']?>" size="104" maxlength="104" />
	    <br /><b>Описание клана:</b><br />
	    <textarea class="form-control" cols="104" name="clan_info" id="clan_info" rows="6"><?=$clan_inf['info']?></textarea>
	    <br>
	    <input name="clans_inf" type="submit" value="Сохранить">
    </form>
    </fieldset>
  </div>
   <? }elseif(isset($_GET['members'])) { ?>
   <div  class="box visible">
    <fieldset style="border:1px dashed #eeeeee">
      <legend align="center"><span class="legtitle"><img title="Приватно" onClick="top.chat.addto('klan','private')" style="vertical-align:bottom;cursor:pointer;" src="http://img.likebk.com/i/lock.gif" width="20" height="15"> Соклановцы</span></legend>
      <? if(!isset($_GET['online'])) { ?>
      <input onClick="location='main.php?clan&members&online'" type="button" value="Только online" style="float:right">
      <? }else{ ?>
      <input onClick="location='main.php?clan&members'" type="button" value="Показать всех" style="float:right">
      <? } ?>
      <br>
      <?
	  $sp = mysql_query('SELECT `id`,`battle`,`login`,`clan`,`level`,`room`,`cityreg`,`align`,`clan_prava`,`mod_zvanie`,`sex`,`city`,`online`,`banned` FROM `users` WHERE `clan` = "'.$res['id'].'"');
	  $r = '<br>'; $j = 0; $i = 0;
	  if($res['join1'] > 0 || $res['join2'] > 0) {
		 $r .= '<fieldset style="border:1px dashed #eeeeee;margin-top:5px;">
      <legend align="left"><span class="legtitle">Основной состав</span></legend>'; 
	  }
	  while($pl = mysql_fetch_array($sp)) {
		  if(!isset($_GET['online']) || $pl['online'] > time()-120) {
			  $pl['textcolor1'] = '';
			  if($pl['online'] > time()-120) {
				 $ico = '<img onClick="top.chat.addto(\''.$pl['login'].'\',\'private\')" src="http://img.likebk.com/i/lock.gif" width="20" height="15" style="cursor:pointer;vertical-align:bottom">'; 
				 $j++;
				 $jx++;
			  }else{
				  $pl['textcolor1'] = '#837f82';
				 $ico = '<img src="http://img.likebk.com/i/offline.gif" width="20" height="15" style="vertical-align:bottom">'; 
			  }		  
			  $zvn = $pl['mod_zvanie'];
			  $zvn = str_replace('[b]','<b>',$zvn);
			  $zvn = str_replace('[/b]','</b>',$zvn);
			  $zvn = str_replace('[i]','<i>',$zvn);
			  $zvn = str_replace('[/i]','</i>',$zvn);
			  $zvn = str_replace('[u]','<u>',$zvn);
			  $zvn = str_replace('[/u]','</u>',$zvn);
			  $zvn = str_replace('[c=','<font color="',$zvn);
			  $zvn = str_replace('=]','">',$zvn);
			  $zvn = str_replace('[/c]','</font>',$zvn);
			  if($pl['clan_prava'] == 'glava') {
				 if($zvn == 'Стажер' || $zvn == '') {
					 $zvn = '<b style="color:#008097">глава клана</b>';
				 }
				 $zvn = '<img style="vertical-align:top" src="http://img.likebk.com/i/clan/'.$res['name_mini'].'.gif" width="24" title="Глава клана">'.$zvn; 
			  }
			  $ttl = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `clan` = "'.$res['id'].'" AND `id` = "'.$pl['clan_prava'].'" LIMIT 1'));
			  if(isset($ttl['id'])) {
				 $zvn = '<font color="#'.$ttl['color'].'"><b>'.$ttl['name'].'</b></font> - '.$zvn; 
			  }
			  if($pl['online'] > time()-120) {
				  $rm = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`city` FROM `room` WHERE `id` = "'.$pl['room'].'" LIMIT 1'));
				  if(isset($rm['id'])) {
					 $zvn .= ' - <i>'.$rm['name'].'</i>'; 
				  }
			  }else{
				  $zvn .= ' - <i><font color="grey">персонаж сейчас не в клубе</font></i>';
			  }
			  if($pl['battle'] > 0) {
				$zvn .= ' <a href="logs.php?id='.$pl['battle'].'" target="_blank"><img width="20" height="20" style="vertical-align:bottom"src="http://img.likebk.com/i/fighttype0.gif" title="Открыть лог поединка"></a>';  
			  }
			$r .= '<div style="padding:5px;background-color:#efedee"><span style="display:inline-block;width:350px;">'.$ico.' &nbsp;&nbsp; &nbsp; <img src="http://img.likebk.com/i/align/align'.$pl['align'].'.gif" width="12" height="15" style="vertical-align:bottom"><img style="vertical-align:bottom" src="http://img.likebk.com/i/clan/'.$res['name_mini'].'.gif" width="24" height="15"><a onClick="top.chat.addto(\''.$pl['login'].'\',\'to\')" style="color:'.$pl['textcolor1'].'" href="javascript:void(0)">'.$pl['login'].'</a><font color="'.$pl['textcolor1'].'">['.$pl['level'].']<a href="http://likebk.com/inf.php?'.$pl['id'].'" title="Инф. о '.$pl['login'].'" target="_blank"><img src="http://img.likebk.com/i/inf_'.$pl['cityreg'].'.gif" width="12" height="11"></a></font></span>'.$zvn.'</div>';
		  }
		  $i++;
		  $ix++;
	  }
	  
	  if($res['join1'] > 0 || $res['join2'] > 0) {
	  	$r .= '</fieldset>';
	  }
	  $nacln = '';	  
	  if($res['join1'] > 0) {
	  	$clna = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$res['join1'].'" AND `type` = "1" AND `time_close` = "0" LIMIT 1'));
		$cn_sp = mysql_query('SELECT * FROM `clan_join` WHERE `alians` = "'.$clna['id'].'" AND `clan` != "'.$res['id'].'" AND `time_end` = "0" AND `time_start` > 0');
		while($cn_pl = mysql_fetch_array($cn_sp)) {
			/* ----------------------------------------------------------------------------------------------------------------------------- */
			  $nacln .= ' AND `clan` != "'.$cn_pl['clan'].'"';
			  $clnf = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$cn_pl['clan'].'" LIMIT 1'));
			  $sp = mysql_query('SELECT `id`,`battle`,`login`,`clan`,`level`,`room`,`cityreg`,`align`,`clan_prava`,`mod_zvanie`,`sex`,`city`,`online`,`banned` FROM `users` WHERE `clan` = "'.$cn_pl['clan'].'"');
			  $r .= '<fieldset style="border:1px dashed #eeeeee;margin-top:5px;">
      <legend align="left"><span class="legtitle">Состав &quot;'.$clna['name'].'&quot;</span></legend>';
			  $j = 0; $i = 0;
			  while($pl = mysql_fetch_array($sp)) {
				  if(!isset($_GET['online']) || $pl['online'] > time()-120) {
					  $pl['textcolor1'] = '';
					  if($pl['online'] > time()-120) {
						 $ico = '<img onClick="top.chat.addto(\''.$pl['login'].'\',\'private\')" src="http://img.likebk.com/i/lock.gif" width="20" height="15" style="cursor:pointer;vertical-align:bottom">'; 
						 $j++;
						 $jx++;
					  }else{
						  $pl['textcolor1'] = '#837f82';
						 $ico = '<img src="http://img.likebk.com/i/offline.gif" width="20" height="15" style="vertical-align:bottom">'; 
					  }		  
					  $zvn = $pl['mod_zvanie'];
					  $zvn = str_replace('[b]','<b>',$zvn);
					  $zvn = str_replace('[/b]','</b>',$zvn);
					  $zvn = str_replace('[i]','<i>',$zvn);
					  $zvn = str_replace('[/i]','</i>',$zvn);
					  $zvn = str_replace('[u]','<u>',$zvn);
					  $zvn = str_replace('[/u]','</u>',$zvn);
					  $zvn = str_replace('[c=','<font color="',$zvn);
					  $zvn = str_replace('=]','">',$zvn);
					  $zvn = str_replace('[/c]','</font>',$zvn);
					  if($pl['clan_prava'] == 'glava') {
						 if($zvn == 'Стажер' || $zvn == '') {
							 $zvn = '<b style="color:#008097">глава клана</b>';
						 }
						 $zvn = '<img style="vertical-align:top" src="http://img.likebk.com/i/clan/'.$clnf['name_mini'].'.gif" width="24" title="Глава клана">'.$zvn; 
					  }
					  $ttl = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `clan` = "'.$clnf['id'].'" AND `id` = "'.$pl['clan_prava'].'" LIMIT 1'));
					  if(isset($ttl['id'])) {
						 $zvn = '<font color="#'.$ttl['color'].'"><b>'.$ttl['name'].'</b></font> - '.$zvn; 
					  }
					  if($pl['online'] > time()-120) {
						  $rm = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`city` FROM `room` WHERE `id` = "'.$pl['room'].'" LIMIT 1'));
						  if(isset($rm['id'])) {
							 $zvn .= ' - <i>'.$rm['name'].'</i>'; 
						  }
					  }else{
						  $zvn .= ' - <i><font color="grey">персонаж сейчас не в клубе</font></i>';
					  }
					  if($pl['battle'] > 0) {
						$zvn .= ' <a href="logs.php?id='.$pl['battle'].'" target="_blank"><img width="20" height="20" style="vertical-align:bottom"src="http://img.likebk.com/i/fighttype0.gif" title="Открыть лог поединка"></a>';  
					  }
					$r .= '<div style="padding:5px;background-color:#efedee"><span style="display:inline-block;width:350px;">'.$ico.' &nbsp;&nbsp; &nbsp; <img src="http://img.likebk.com/i/align/align'.$pl['align'].'.gif" width="12" height="15" style="vertical-align:bottom"><img style="vertical-align:bottom" src="http://img.likebk.com/i/clan/'.$clnf['name_mini'].'.gif" width="24" height="15"><a onClick="top.chat.addto(\''.$pl['login'].'\',\'to\')" style="color:'.$pl['textcolor1'].'" href="javascript:void(0)">'.$pl['login'].'</a><font color="'.$pl['textcolor1'].'">['.$pl['level'].']<a href="http://likebk.com/inf.php?'.$pl['id'].'" title="Инф. о '.$pl['login'].'" target="_blank"><img src="http://img.likebk.com/i/inf_'.$pl['cityreg'].'.gif" width="12" height="11"></a></font></span>'.$zvn.'</div>';
				  }
				  $i++;
				  $ix++;
			  }
			  $r .= '</fieldset>';
			/* ----------------------------------------------------------------------------------------------------------------------------- */
		}
	  }
	  if($res['join2'] > 0) {
	  	$cn_sp0 = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$res['join2'].'" AND `type` = "2" AND `time_close` = "0" LIMIT 1'));
		$cn_sp = mysql_query('SELECT * FROM `clan_join` WHERE `alians` = "'.$cn_sp0['id'].'" AND `clan` != "'.$res['id'].'"'.$nacln.' AND `time_end` = "0" AND `time_start` > 0');
		while($cn_pl = mysql_fetch_array($cn_sp)) {
			/* ----------------------------------------------------------------------------------------------------------------------------- */
			  $clnf = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$cn_pl['clan'].'" LIMIT 1'));
			  $clna = mysql_fetch_array(mysql_query('SELECT * FROM `clan_joint` WHERE `id` = "'.$res['join2'].'" LIMIT 1'));
			  $sp = mysql_query('SELECT `id`,`battle`,`login`,`clan`,`level`,`room`,`cityreg`,`align`,`clan_prava`,`mod_zvanie`,`sex`,`city`,`online`,`banned` FROM `users` WHERE `clan` = "'.$cn_pl['clan'].'"');
			  $r .= '<fieldset style="border:1px dashed #eeeeee;margin-top:5px;">
      <legend align="left"><span class="legtitle">Состав &quot;'.$clna['name'].'&quot;</span></legend>';
			  $j = 0; $i = 0;
			  while($pl = mysql_fetch_array($sp)) {
				  if(!isset($_GET['online']) || $pl['online'] > time()-120) {
					  $pl['textcolor1'] = '';
					  if($pl['online'] > time()-120) {
						 $ico = '<img onClick="top.chat.addto(\''.$pl['login'].'\',\'private\')" src="http://img.likebk.com/i/lock.gif" width="20" height="15" style="cursor:pointer;vertical-align:bottom">'; 
						 $j++;
						 $jx++;
					  }else{
						  $pl['textcolor1'] = '#837f82';
						 $ico = '<img src="http://img.likebk.com/i/offline.gif" width="20" height="15" style="vertical-align:bottom">'; 
					  }		  
					  $zvn = $pl['mod_zvanie'];
					  $zvn = str_replace('[b]','<b>',$zvn);
					  $zvn = str_replace('[/b]','</b>',$zvn);
					  $zvn = str_replace('[i]','<i>',$zvn);
					  $zvn = str_replace('[/i]','</i>',$zvn);
					  $zvn = str_replace('[u]','<u>',$zvn);
					  $zvn = str_replace('[/u]','</u>',$zvn);
					  $zvn = str_replace('[c=','<font color="',$zvn);
					  $zvn = str_replace('=]','">',$zvn);
					  $zvn = str_replace('[/c]','</font>',$zvn);
					  if($pl['clan_prava'] == 'glava') {
						 if($zvn == 'Стажер' || $zvn == '') {
							 $zvn = '<b style="color:#008097">глава клана</b>';
						 }
						 $zvn = '<img style="vertical-align:top" src="http://img.likebk.com/i/clan/'.$clnf['name_mini'].'.gif" width="24" title="Глава клана">'.$zvn; 
					  }
					  $ttl = mysql_fetch_array(mysql_query('SELECT * FROM `clan_tituls` WHERE `clan` = "'.$clnf['id'].'" AND `id` = "'.$pl['clan_prava'].'" LIMIT 1'));
					  if(isset($ttl['id'])) {
						 $zvn = '<font color="#'.$ttl['color'].'"><b>'.$ttl['name'].'</b></font> - '.$zvn; 
					  }
					  if($pl['online'] > time()-120) {
						  $rm = mysql_fetch_array(mysql_query('SELECT `id`,`name`,`city` FROM `room` WHERE `id` = "'.$pl['room'].'" LIMIT 1'));
						  if(isset($rm['id'])) {
							 $zvn .= ' - <i>'.$rm['name'].'</i>'; 
						  }
					  }else{
						  $zvn .= ' - <i><font color="grey">персонаж сейчас не в клубе</font></i>';
					  }
					  if($pl['battle'] > 0) {
						$zvn .= ' <a href="logs.php?id='.$pl['battle'].'" target="_blank"><img width="20" height="20" style="vertical-align:bottom"src="http://img.likebk.com/i/fighttype0.gif" title="Открыть лог поединка"></a>';  
					  }
					$r .= '<div style="padding:5px;background-color:#efedee"><span style="display:inline-block;width:350px;">'.$ico.' &nbsp;&nbsp; &nbsp; <img src="http://img.likebk.com/i/align/align'.$pl['align'].'.gif" width="12" height="15" style="vertical-align:bottom"><img style="vertical-align:bottom" src="http://img.likebk.com/i/clan/'.$clnf['name_mini'].'.gif" width="24" height="15"><a onClick="top.chat.addto(\''.$pl['login'].'\',\'to\')" style="color:'.$pl['textcolor1'].'" href="javascript:void(0)">'.$pl['login'].'</a><font color="'.$pl['textcolor1'].'">['.$pl['level'].']<a href="http://likebk.com/inf.php?'.$pl['id'].'" title="Инф. о '.$pl['login'].'" target="_blank"><img src="http://img.likebk.com/i/inf_'.$pl['cityreg'].'.gif" width="12" height="11"></a></font></span>'.$zvn.'</div>';
				  }
				  $i++;
				  $ix++;
			  }
			  $r .= '</fieldset>';
			/* ----------------------------------------------------------------------------------------------------------------------------- */
		}
	  }
	  
	  $r .= '<br>Online: <a href="main.php?clan&members&online">'.$jx.'</a><br>Всего: <a href="main.php?clan&members">'.$ix.'</a><br><small>(список обновляется <s>в полночь</s>)</small>';
	  echo $r;
	  ?>
    </fieldset>
   </div>
  <? } ?>


</div><!-- .section -->