<?php
define('GAME',true);
die('Я тебя запомнил, дело об использовании багов отправлено паладинам!');
/*echo strtotime('now 00:00:00').'<br>';
echo date("Y-m-d H:i:s", strtotime('now 00:00:00'));*/

if(date('m') != 1 && date('m') != 2 && $u->info['admin'] == 0) {
	die();
}

include('../_incl_data/class/__db_connect.php');
include('../_incl_data/class/__user.php');

if( $u->info['dnow'] > 0 ) { die(); }

?>
<style type="text/css">
	#wrapper {
	    margin-bottom: 20px;
	    padding-top: 5px;
	}
	.button{
	     display: block;
	     width: 165px;
	     margin: 10px auto;
		 text-decoration:none; 
		 text-align:center; 
		 padding:5px 5px; 
		 border:solid 1px #007300; 
		 -webkit-border-radius:8px;
		 -moz-border-radius:8px; 
		 border-radius: 8px; 
		 font:16px Arial, Helvetica, sans-serif; 
		 font-weight:bold; 
		 color:#fff!important; 
		 background-color:#43a824; 
		 background-image: -moz-linear-gradient(top, #43a824 0%, #1a5707 100%); 
		 background-image: -webkit-linear-gradient(top, #43a824 0%, #1a5707 100%); 
		 background-image: -o-linear-gradient(top, #43a824 0%, #1a5707 100%); 
		 background-image: -ms-linear-gradient(top, #43a824 0% ,#1a5707 100%); 
		 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1a5707', endColorstr='#1a5707',GradientType=0 ); 
		 background-image: linear-gradient(top, #43a824 0% ,#1a5707 100%);   
		 -webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff; 
		 -moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 1px #ffffff;  
		 box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;    
	}
	.button:hover{
		color:#E5FFFF!important;
		opacity: 0.8; 
	}
</style>
<div style="float: right; width: 210px;">
  <INPUT type='button' value='Обновить' onclick='location="/main.php?newybonus2=1"';'>
&nbsp;<INPUT TYPE=button value="Вернуться" onclick='location="/main.php"'>
</div>
<div id="wrapper">
<div style="text-align: center; font-family: Arial; line-height: 24px;"><span style="font-size: 16px; font-weight: bold;">
  <h3 style="font-size: 24px; font-weight: bold; padding: 20px; padding-bottom: 0px; margin-bottom: 5px; text-align: center;">Зимнее обострение!</h3><br>
  <small style="font-weight:normal;font-size:14px;">(Срок проведения марафона с 20.01.2017 по 28.02.2017)</small><br>
За каждый час проведенный в игре, вы сможете забрать <img src="http://img.likebk.com/i/items/zima1.gif"> "<font color="#b40611">Снежинку</font>"! За каждый <font color="#b40611">хаотичный бой</font> вы получите <img src="http://img.likebk.com/i/items/zima2.gif"> &quot;<font color="#b40611">Сосульку</font>&quot;, а за каждый <font color="#b40611">пещерный бой</font>, с вероятностью в 10%, вы получите <img src="http://img.likebk.com/i/items/zima3.gif"> &quot;<font color="#b40611">Пломбир</font>&quot;! Собрав необходимое количество, наиболее активные игроки смогут поменять их на очень ценные призы, в числе которых <font color="#b40611"><img src="http://img.likebk.com/i/items/chek50.gif"> 10 чеков на получение екр</font>, а также <font color="#b40611"><img src="http://img.likebk.com/i/items/loto1b.jpg"> лотерейные билеты</font>, с призовым фондом <font color="#b40611" style="font-size:19px;">более 1300 екр</font>.
<?
echo '<span style="cursor:help;font-size:11pt;" onMouseOver="top.hi(this,\'3 приза по 100 екр.<br>10 призов по 50 екр.<br>30 призов по 10 екр.<br>200 призов по 1 екр.\',event,3,0,1,1,\'width:150px\')" onMouseOut="top.hic();" onMouseDown="top.hic();"><img src="http://likebk.com/qst.png"></span>';
?>
&nbsp; и многое другое! <br>Особо активные игроки получат дополнительное вознаграждение в виде значков достижений за скоростное выполнение марафона!<br>
Получить вышеперечисленные вещи вы можете в <font color="#b40611">&quot;Квестовом Магазине&quot;</font>, который находится в <font color="#b40611">&quot;Елке&quot;</font> на <font color="#b40611">&quot;Центральной Площади&quot;</font>.
<Br><Br><span style="font-size:18px;">Учавствуйте и побеждайте!</span>
</span>
</div>
</div>
<?php
echo '<div align="center">';
$o1 = mysql_fetch_array(mysql_query('SELECT * FROM `online` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
$o2 = mysql_fetch_array(mysql_query('SELECT * FROM `elka_quest` WHERE `uid` = "'.$u->info['id'].'" ORDER BY `id` DESC LIMIT 1'));

if(isset($_GET['takeitnowfastbig'])) {
	if( $o1['time_all'] - $o2['time_online'] >= 3600 ) {
		echo '<div><font color="red"><b>Вы успешно забрали новогодний бонус, предмет &quot;Снежинка&quot;!</b></font></div>';
		
		$u->addItem(6924,$u->info['id'],'|sudba='.$u->info['login'].'');
		
		mysql_query('INSERT INTO `elka_quest` (`uid`,`time`,`time_online`) VALUES (
			"'.$u->info['id'].'","'.time().'","'.$o1['time_all'].'"
		)');
		
		$o1 = mysql_fetch_array(mysql_query('SELECT * FROM `online` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
		$o2 = mysql_fetch_array(mysql_query('SELECT * FROM `elka_quest` WHERE `uid` = "'.$u->info['id'].'" ORDER BY `id` DESC LIMIT 1'));
		
	}else{
		echo '<div><font color="red"><b>Вам необходимо провести в онлайне еще '.$u->timeOut(( 3600 - ($o1['time_all'] - $o2['time_online']) )).'!</b></font></div>';
	}
}

if( $o1['time_all'] - $o2['time_online'] >= 3600 ) {
	echo '<a href="/main.php?newybonus2&takeitnowfastbig"><span class="button" style="pointer-events: none; cursor: default;">Забрать награду!</span></a>';
}else{
	echo 'Вам необходимо провести в онлайне еще '.$u->timeOut(( 3600 - ($o1['time_all'] - $o2['time_online']) )).'!';
	echo '<a href="/main.php?newybonus2&takeitnowfastbig"><span class="button" style="pointer-events: none; cursor: default;opacity: 0.2;">Забрать награду!</span></a>';
}		
echo '</div>';
?>