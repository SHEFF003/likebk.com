<?php

###############################################
###############################################
##///////////////////////////////////////////##
##/////////  "Simple News" v.1.0  ///////////##
##//////////////  by Hast  //////////////////##
##///////////  Mysql Version  ///////////////##
##///////  Copyright � 2008 Hast  ///////////##
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
<title>�����-����� LikeBK NEWS</title>
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
        margin:0; /*�������� �������*/
        padding:0; /*�������� �������*/
        float: left;
        width:auto;/*������ ������ ���� ������ �� ���� � ����������� ������*/
        list-style:none; /*������� ������� ������*/
        font-size:13px; /*������ ������ ������*/
        font-family:Arial, Helvetica, sans-serif; /*������������� �����*/
        border-bottom: 2px solid #000;
    }
    
    ul#menu_news li {
        background:#c0c0c0; /*������ ���� ���� ��� �����������*/
        float:left; /*����������� �������� ������ �� ������ ����*/
    }
    
    ul#menu_news a {
          display:block; /*������������ ������ ���� ��� ������� ��������*/
          width:200px; /*������ ������ �����*/
          height:30px; /*� ������ �����*/
          text-align:center; /*������� �� ������*/
          line-height: 2.1em; /*����������� ��������*/
          text-decoration:none; /*������� ������������� � ������*/
          color:#fff; /*���� ������ ������ - �����*/
          border-right:#fff solid 1px; /*������ ������ ������� ����� (����� ����� � 1px)*/
    }
    
    ul#menu_news a:hover {
        color:#ccc; /*������ ������ ���� ��� ��������� ���������*/
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
echo "<li><a href=\"news.php?do=add\">�������� �������</a></li>";
echo "<li><a href=\"news.php#do=delete_checked\" OnClick=\" if (confirm('������� ���������� �������?')) { document.forms['delete_checked'].submit() }\">������� ���������</a></li>";
echo "<li><a href=\"logout.php\">�����</a></li>";
echo '</ul></div><div style="clear: both;"></div>';
// echo "<a href=\"admin.php\">� �������</a></center><p>\n";
#############################################################################################################################################
#############################################################################################################################################
    $query = "SELECT * FROM `newsNew` ORDER BY `id` DESC";
    $result = mysql_query($query);
                                        
    if (!$result)
    {
	  print "<center><img src=\"news.gif\"><br>������:" . mysql_error() . "<br></center>\n";
    }
    elseif (mysql_num_rows($result) == 0)
    {
	 print "<center><img src=\"news.gif\"><br>�������� ���<br></center>\n";
    }
    else
    {
	 $rows = array();
    echo "<form action=\"{$_SERVER["PHP_SELF"]}\" method=\"POST\" name=\"delete_checked\">\n";
     echo "<table class='adm_news' width=100%>";
     echo "<tr><td></td><td><b>��������</b></td><td><b>���� ����������</b></td><td><b>�����</b></td><td></td><td></td>";
	 while ($row = mysql_fetch_assoc($result)) 
	 {
	     echo "
         <tr>
            <td><input type=\"checkbox\" name=\"id_{$row['id']}\" value=\"{$row['id']}\"></td>
            <td>".$row['name']."</td>
            <td>".$row['date']."</td>
            <td>".$row['text']."</td>
            <td><a href=\"news.php?do=delete&new=".$row['id']."\" OnClick=\"return confirm('������� ��� �������?');\">�������</a></td>
            <td><a href=\"news.php?do=edit&new=".$row['id']."\">��������</a></td>
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