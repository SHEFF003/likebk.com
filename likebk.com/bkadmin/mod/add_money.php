<?php 
$dbgo = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
mysql_select_db('like_mainbd',$dbgo);
mysql_query('SET NAMES cp1251');

include('../../_incl_data/__user.php');

$step = 1;
if(isset($_POST['login'])) {
	$_POST['login'] = htmlspecialchars($_POST['login'],NULL,'cp1251');
	$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['login']).'" LIMIT 1'));
	if(isset($usr['id'])) {
		$step = 2;
		if(isset($_POST['add_ekr'])) {
			if(is_numeric($_POST['add_ekr']) && $_POST['add_ekr'] > 0){
				if(isset($_POST['plus'])){
					$b = mysql_query('UPDATE `users` SET `money` = `money` + "'.mysql_real_escape_string($_POST['add_ekr']).'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
					if($b){
						echo '<script>location.href="http://likebk.com/bkadmin/index.php?mod=add_money&plus='.$_POST['add_ekr'].'"</script>';
					}
				}
				elseif(isset($_POST['minus'])){
					$b = mysql_query('UPDATE `users` SET `money` = `money` - "'.mysql_real_escape_string($_POST['add_ekr']).'" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
					if($b){
						echo '<script>location.href="http://likebk.com/bkadmin/index.php?mod=add_money&minus='.$_POST['add_ekr'].'"</script>';
					}
				}
			}else{
				$err = 'Неверная сумма';
			}
		}
	}
	else{
		$err = 'Не существует такого игрока';
	}
}
if($_GET['plus']){
	$err = 'Вы успешно пополнили баланс на '.$_GET['plus'].' кр.';
}elseif($_GET['minus']){
	$err = 'Вы успешно сняли со счета '.$_GET['minus'].' кр.';	
}
?>
<br>
<h3 style="text-align:left;">Пополнить кредиты игроку</h3>
<font color="red"><b><?= $err?></b></font>
<form class="rep_pass" method="post" action="http://likebk.com/bkadmin/index.php?mod=add_money">
<?
if($step == 1){ ?>
	Введите логин игрока:</br>
	<input class="inp_rep" onfocus="if ( 'Логин' == value ) { value = ''; } " onblur="if ( '' == value ) { value = 'Логин'; } " value="" maxlength="40" style="padding:3px" name="login" type="text" placeholder="Введите логин" class="inup" id="login">
    <input type="submit" class="btn_repa" value="Далее">
<? }elseif($step == 2){ ?>
    Логин игрока:<br>
    <input class="inp_rep" value="<?=$_POST['login']?>" disabled maxlength="40" style="padding:3px" type="text" class="inup">
    <input type="hidden" name="login" value="<?=$_POST['login']?>">
	<br>Введите кол-во кр:<br>
	<input class="inp_rep" name="add_ekr" maxlength="10" style="padding:3px" type="text" class="inup" placeholder="Введите кол-во кр."><br>
    <input type="submit" class="btn_repa" name="plus" value="Пополнить счет">
    <input type="submit" class="update" name="minus" value="Снять со счета">
<? } ?>
</form>
