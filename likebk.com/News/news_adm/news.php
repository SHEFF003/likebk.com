<?php

###############################################
###############################################
##///////////////////////////////////////////##
##/////////  "Simple News" v.1.0  ///////////##
##//////////////  by Hast  //////////////////##
##///////////  Mysql Version  ///////////////##
##///////  Copyright © 2008 Hast  ///////////##
##////////  hast4656@gmail.com  /////////////##
##///////////////////////////////////////////##
###############################################
###############################################

session_start();
if (!$_SESSION['admin']) { Header("Location: index.php"); exit; }
$isinclude = true;
include "../dbinit.php";

#############################################################################################################################################
#############################################################################################################################################
     if (isset($_GET['createtable']))
     {                               
         $done = 0;          
	 echo "<hr>";
	 echo "***Log:***<p>";
	                                                                                             
	 $query = "CREATE TABLE `newsNew` (                                                                  
                  `id` INT NOT NULL AUTO_INCREMENT ,
                  `date` VARCHAR( 30 ) NOT NULL ,
                  `text` VARCHAR( 5000 ) NOT NULL , 
                  PRIMARY KEY ( `id` ) 
                  );";
                   
     if (mysql_query($query)) { $done++; echo "*&nbsp;&nbsp;Table created successfull;<br>"; } else { echo "*<font color=\"red\">&nbsp;&nbsp;" . mysql_error() . ";</font><br>"; }
     
     if ($done == 1)
     {
        echo "<font color=\"green\"><b>Done!</b></font><p>***End Of Log***<p>\n"; exit;                             
     }
     else
     {  
	echo "<b>There are errors!</b><p>***End Of Log***<p>\n"; exit;
     } 
     }
#############################################################################################################################################
#############################################################################################################################################     
     if (@$_GET['do'] == "add")
     {
     include "add.php"; exit;
     }
     if (@$_GET['do'] == "edit")
     {
     include "edit.php"; exit;
     }
     if (@$_GET['do'] == "delete")
     {
     include "delete.php"; exit;
     }
#############################################################################################################################################
#############################################################################################################################################
     if (@$_POST)
     {
         $posts_id = $_POST;
	 //print_r($posts_id);
	 foreach($posts_id as $post_id)
         {
	     $query = "DELETE FROM `newsNew` WHERE `id`='$post_id'";
	     if (!mysql_query($query)) echo mysql_error();
	 
	 }
     }
#############################################################################################################################################
#############################################################################################################################################
$date = date("d.m.Y H:i:s");
//echo "<center><small>$date</small></center><p>\n";
?>
<html>
<head>
<title>Админ-Центр LikeBK NEWS</title>
</head>
<style type="text/css">
    body{
        padding: 0;
        margin: 0;
    }
    .menu_head{
        width: 100%;
        height: 30px;
        padding: 0;
        display: block;
        margin-bottom: 10px;
    }
    ul#menu_news {
        margin:0; /*обнуляем отступы*/
        padding:0; /*обнуляем отступы*/
        float: left;
        width:auto;/*задаем ширину авто исходя из типа и содержимого списка*/
        list-style:none; /*удаляем маркеры списка*/
        font-size:13px; /*задаем размер шрифта*/
        font-family:Arial, Helvetica, sans-serif; /*устанавливаем шрифт*/
        border-bottom: 2px solid #000;
    }
    
    ul#menu_news li {
        background:#c0c0c0; /*задаем цвет фона под изображение*/
        float:left; /*выравниваем элементы списка по левому краю*/
    }
    
    ul#menu_news a {
          display:block; /*представляем ссылки меню как блочные элементы*/
          width:200px; /*задаем размер блока*/
          height:30px; /*и высоту блока*/
          text-align:center; /*надпись по центру*/
          line-height: 2.1em; /*межстрочный интервал*/
          text-decoration:none; /*убираем подчеркивание у ссылок*/
          color:#fff; /*цвет текста ссылок - белый*/
          border-right:#fff solid 1px; /*бордюр правой стороны блока (белая линия в 1px)*/
    }
    
    ul#menu_news a:hover {
        color:#ccc; /*ссылка меняет цвет при наведении указателя*/
    }
    table.adm_news tr td{
        padding: 5px;
        border-bottom: 1px solid #000;
    }
</style>
<body>
<?php
#############################################################################################################################################
#############################################################################################################################################
echo '<div class="menu_head"><ul id="menu_news">';
echo "<li><a href=\"news.php?do=add\">Добавить новость</a></li>";
echo "<li><a href=\"news.php#do=delete_checked\" OnClick=\" if (confirm('Удалить выделенные новости?')) { document.forms['delete_checked'].submit() }\">Удалить отмеченые</a></li>";
echo "<li><a href=\"logout.php\">Выйти</a></li>";
echo '</ul></div><div style="clear: both;"></div>';
// echo "<a href=\"admin.php\">В админку</a></center><p>\n";
#############################################################################################################################################
#############################################################################################################################################
    $query = "SELECT * FROM `newsNew` ORDER BY `id` DESC";
    $result = mysql_query($query);
                                        
    if (!$result)
    {
	  print "<center><img src=\"news.gif\"><br>ошибка:" . mysql_error() . "<br></center>\n";
    }
    elseif (mysql_num_rows($result) == 0)
    {
	 print "<center><img src=\"news.gif\"><br>Новостей нет<br></center>\n";
    }
    else
    {
	 $rows = array();
    echo "<form action=\"{$_SERVER["PHP_SELF"]}\" method=\"POST\" name=\"delete_checked\">\n";
     echo "<table class='adm_news' width=100%>";
     echo "<tr><td></td><td><b>Название</b></td><td><b>Дата публикации</b></td><td><b>Текст</b></td><td></td><td></td>";
	 while ($row = mysql_fetch_assoc($result)) 
	 {
	     echo "
         <tr>
            <td><input type=\"checkbox\" name=\"id_{$row['id']}\" value=\"{$row['id']}\"></td>
            <td>".$row['name']."</td>
            <td>".$row['date']."</td>
            <td>".$row['text']."</td>
            <td><a href=\"news.php?do=delete&new=".$row['id']."\" OnClick=\"return confirm('Удалить эту новость?');\">Удалить</a></td>
            <td><a href=\"news.php?do=edit&new=".$row['id']."\">Изменить</a></td>
        </tr>";
	 }
         //$rows = array_reverse($rows);
        echo "</table>";
	 echo "</form>\n";
    }
#############################################################################################################################################
#############################################################################################################################################
?>
</body>
</html>