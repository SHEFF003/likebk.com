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
					$b = mysql_query('UPDATE `bank` SET `money2` = `money2` + "'.mysql_real_escape_string($_POST['add_ekr']).'" WHERE `uid` = "'.$usr['id'].'" LIMIT 1');
					if($b){
						echo '<script>location.href="http://likebk.com/bkadminlike/index.php?mod=add_money2&plus='.$_POST['add_ekr'].'"</script>';
					}
				}
				elseif(isset($_POST['minus'])){
					$b = mysql_query('UPDATE `bank` SET `money2` = `money2` - "'.mysql_real_escape_string($_POST['add_ekr']).'" WHERE `uid` = "'.$usr['id'].'" LIMIT 1');
					if($b){
						echo '<script>location.href="http://likebk.com/bkadminlike/index.php?mod=add_money2&minus='.$_POST['add_ekr'].'"</script>';
					}
				}
			}else{
				$err = '�������� �����';
			}
		}
	}
	else{
		$err = '�� ���������� ������ ������';
	}
}
if($_GET['plus']){
	$err = '�� ������� ��������� ������ �� '.$_GET['plus'].' ���.';
}elseif($_GET['minus']){
	$err = '�� ������� ����� �� ����� '.$_GET['minus'].' ���.';	
}
?>
<br>
<h3 style="text-align:left;">��������� ����������� ������</h3>
<font color="red"><b><?= $err?></b></font>
<form class="rep_pass" method="post" action="http://likebk.com/bkadminlike/index.php?mod=add_money2">
<?
if($step == 1){ ?>
	������� ����� ������:</br>
	<input class="inp_rep" onfocus="if ( '�����' == value ) { value = ''; } " onblur="if ( '' == value ) { value = '�����'; } " value="" maxlength="40" style="padding:3px" name="login" type="text" placeholder="������� �����" class="inup" id="login">
    <input type="submit" class="btn_repa" value="�����">
<? }elseif($step == 2){ ?>
    ����� ������:<br>
    <input class="inp_rep" value="<?=$_POST['login']?>" disabled maxlength="40" style="padding:3px" type="text" class="inup">
    <input type="hidden" name="login" value="<?=$_POST['login']?>">
	<br>������� ���-�� ���:<br>
	<input class="inp_rep" name="add_ekr" maxlength="10" style="padding:3px" type="text" class="inup" placeholder="������� ���-�� ���."><br>
    <input type="submit" class="btn_repa" name="plus" value="��������� ����">
    <input type="submit" class="update" name="minus" value="����� �� �����">
<? } ?>
</form>
