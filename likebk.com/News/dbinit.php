<?php
    
    $admin_login = "admin"; //����� ��������������
    $admin_password = "adminlike.";   //������ ���������������
    
    $dbhost = "localhost";  //������ �� (� 90% ������� ��� localhost)
    $dbname = "like";       //�������� ��
    $dbuser = "like";       //������������ ��   
    $dbpass = "23wesdxc"; //������ ������������ ��
/*
    mysql_connect($dbhost, $dbuser, $dbpass);     //�� ��������!
    mysql_select_db($dbname);                     //�� ��������!*/

$dbgo = mysql_pconnect('localhost','like','23wesdxc');
mysql_select_db('like',$dbgo);
mysql_query('SET NAMES cp1251');
?>
