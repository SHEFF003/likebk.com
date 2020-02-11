<?php
session_start();
include "../dbinit.php";

$login = $admin_login;
$password = $admin_password;

if (isset($_SESSION['admin'])) { $print_form = "already_login"; }

if ($print_form != "already_login")
{
   if (!@$_POST)
{
      $print_form = 1;
}

   else

{
	$posted_admin_login = $_POST['login'];
	$posted_admin_password =  $_POST['password'];
	
	
	if ($posted_admin_login == $login && $posted_admin_password == $password)	
	{	 
		 $_SESSION['admin'] =  $posted_admin_login;    	          
		 $print_form = 0;
        }
        else
        {
	         $msg = "Вы ввели неправильный логин или пароль<br>";
		 $print_form = 1;
        }
}
}
   if ($print_form != 1 or $print_form == "already_login")
   {
	include "news.php"; 
   }
   else
   {
	?>
	<?=@$msg ?>
	<form action="<?=$_SERVER["PHP_SELF"] ?>" method="POST" name="admin_login">
	<input type="text" size=50 name="login" value="admin"><br />
	<input type="password" size=50 name="password" value=""><br />
	<input type="submit" name="" value="Войти"><br />
	<?php 
   }   
?>