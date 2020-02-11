<?php
    
    $admin_login = "admin"; //Логин Администратора
    $admin_password = "adminlike.";   //пароль Админнистратора
    
    $dbhost = "localhost";  //Сервер БД (в 90% случаев это localhost)
    $dbname = "like";       //название БД
    $dbuser = "like";       //пользователь БД   
    $dbpass = "23wesdxc"; //Пароль пользователя БД
/*
    mysql_connect($dbhost, $dbuser, $dbpass);     //Не Изменять!
    mysql_select_db($dbname);                     //Не Изменять!*/

$dbgo = mysql_pconnect('localhost','like','23wesdxc');
mysql_select_db('like',$dbgo);
mysql_query('SET NAMES cp1251');
?>
