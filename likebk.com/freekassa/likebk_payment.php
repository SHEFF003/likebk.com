<?php 
define('GAME',true);
include_once('../_incl_data/__config.php');
include_once('../_incl_data/class/__db_connect.php');
include_once('../_incl_data/class/__user.php');

	$merchant_id = '28217';
	$secret_word = '3f0tfbt9';
	$order_id = $_POST['id_user'];
	$order_amount = $_POST['buyEkr']*100;
	$sign = md5($merchant_id.':'.$order_amount.':'.$secret_word.':'.$order_id);
?>
<!-- 
<center>
	<h3 style="color:#8F0000;">Покупка ЕКР</h3>
	<span style="font-size: 14px;">Вы хотите купить <b><?php //echo $_POST['buyEkr'];?></b> екр. за <b><?php //echo $_POST['buyEkr']*100;?></b> руб.</span><br>
	<form method='get' action='http://www.free-kassa.ru/merchant/cash.php'>
	    <input type='hidden' name='m' value='<?php //echo $merchant_id?>'>
	    <input type='hidden' name='oa' value='<?php //echo $order_amount?>'>
	    <input type='hidden' name='o' value='<?php //echo $order_id?>'>
	    <input type='hidden' name='s' value='<?php //echo $sign?>'>
	    <input type='hidden' name='lang' value='ru'>
	    <input type='hidden' name='us_login' value='<?php //echo $_POST["login_user"]?>'>
	    <input type='submit' style="display: none;" id="payment" class="btn btn-success btn2" name='pay' value='Оплатить'>
	</form>
</center> -->
<a href="//www.free-kassa.ru/"><img src="//www.free-kassa.ru/img/fk_btn/17.png"></a>
<?php header('Location: http://www.free-kassa.ru/merchant/cash.php?m='.$merchant_id.'&oa='.$order_amount.'&o='.$order_id.'&s='.$sign.'&us_count='.$_POST['buyEkr'].'&us_login='.$_POST["login_user"].' ')?>
