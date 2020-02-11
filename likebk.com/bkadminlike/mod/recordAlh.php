<?php 
$dbgo = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
mysql_select_db('like_mainbd',$dbgo);
mysql_query('SET NAMES cp1251');

include('../../_incl_data/__user.php');

$step = 1;
if(isset($_POST['login'])) {
	$_POST['login'] = htmlspecialchars($_POST['login'],NULL,'cp1251');
	$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['login']).'" AND `dealer` > "0" LIMIT 1'));
	if(isset($usr['id'])) {
		$step = 2;
	}
	else{
		$err = 'Не существует такого Алхимика';
	}
}
if($_GET['plus']){
	$err = 'Вы успешно пополнили баланс на '.$_GET['plus'].' кр.';
}elseif($_GET['minus']){
	$err = 'Вы успешно сняли со счета '.$_GET['minus'].' кр.';	
}
?>
<br>
<style type="text/css">
	table#refs tr td{
		padding: 5px;
	}
</style>
<h3 style="text-align:left;">Просмотреть отчет</h3>
<font color="red"><b><?= $err?></b></font>
<form class="rep_pass" method="post" action="http://likebk.com/bkadminlike/index.php?mod=recordAlh">
<?
if($step == 1){ ?>
	Введите логин Алхимика:</br>
	<input class="inp_rep" onfocus="if ( 'Логин' == value ) { value = ''; } " onblur="if ( '' == value ) { value = 'Логин'; } " value="" maxlength="40" style="padding:3px" name="login" type="text" placeholder="Введите логин" class="inup" id="login">
    <input type="submit" class="btn_repa" value="Далее">
<? }elseif($step == 2){?>
	Введите логин Алхимика:</br>
	<input class="inp_rep" onfocus="if ( 'Логин' == value ) { value = ''; } " onblur="if ( '' == value ) { value = 'Логин'; } " value="" maxlength="40" style="padding:3px" name="login" type="text" placeholder="Введите логин" class="inup" id="login">
    <input type="submit" class="btn_repa" value="Далее"><br><br><br>
<?php echo '<h3 style="text-align:left;">Алхимик '.$_POST['login'].':</h3>';
	$users_delo =  mysql_query('SELECT * FROM `users_delo` WHERE `login` = "AlhimPayment" AND `text` LIKE "%'.$_POST['login'].'%" ORDER BY `time` DESC');
	$coun = 1;
	$sum = 0;
	echo "<table id='refs' border='1'><tr><td><b>№</b></td><td><b>Логин:</b></td><td><b>Купил:</b></td><td><b>Дата:</b></td></tr>";
	while($us_delo = mysql_fetch_array($users_delo)){
		$us = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$us_delo['uid'].'"'));
		$str = str_replace('у Алхимика '.$_POST['login'], '', $us_delo['text']);
		echo '<tr><td>'.$coun.'</td><td><b>'.$us['login'].'</b></td><td>'.$str.'</td><td>'.date('d.m.Y H:i', $us_delo['time']).'</td></tr>';
		$sum += $us_delo['moneyOut'];
		$coun++;
	}
	echo "</table>";
	echo '<br><b>Всего продал: '.$sum.' екр.</b>';
} ?>
</form>