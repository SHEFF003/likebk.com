<?php

session_start();

if (!$_SESSION['admin']) { Header("Location: index.php"); exit; }

if (@$isinclude == false) { Header("Location: index.php"); exit; }

if (!isset($_GET['new'])) { Header("Location: index.php"); exit; }

?>
<html>
<head>
<title>Админ-Центр LikeBK | Редактирование новости</title>
<script type="text/javascript">
function insBB(oTag, cTag) {
var sel = document.selection.createRange();
if (sel.text > '') {
sel.text = oTag + sel.text + cTag;
} else {
document.addform.addtext.value = document.addform.addtext.value + oTag + cTag;
}
}
</script>
</head>
<body>
<a href="news.php">Центр Управления новостями</a><br />
<?php

$date = date("d.m.Y H:i:s");
echo "<center><h3>Редактирование новости</h3></center>";

$new_id = $_GET['new'];

	$query = "SELECT * FROM `newsNew` WHERE `id`='$new_id' LIMIT 1";
        $result = mysql_query($query);
        if (mysql_num_rows($result) != 1)
        {
            print "<p><center>Такой новости не существует!!<p>\n<a href=\"news.php\">В центр Управления новостями</a><br />\n"; exit;
	}
$phpself = $_SERVER["PHP_SELF"]."?do=edit&new=$new_id";
$print_form = 0;

    if (@$_POST)
    {
        $post_name =  $_POST['name'];
        $post_date =  $_POST['date'];
	$text = $_POST['addtext'];        
	/*$text = htmlspecialchars($text);
        $text = bb_to_html($text);
	$text = nl2br($text);*/
	if (strlen($text) > 5000)
	{
	    print "Максимальная дина сообщения 5000 символов.<br>\n"; 
            $print_form = 1;
	}
	elseif (strlen($text) <= 1)
	{
	    print "Минимальная дина сообщения 1 символов.<br>\n"; 
            $print_form = 1;
	}
        else
        {
	    $query = "UPDATE `newsNew` SET `name`='$post_name', `date`='$post_date', `text`='$text' WHERE `id`='$new_id'";
	    if (mysql_query($query))
	    {
	        print "<p><center>Новость редактирована успешно!<p>\n<a href=\"news.php\">В центр Управления новостями</a><br />\n";
            }
            else
            {
                print "Произошла ошибка:" . mysql_error() . "\n";
            }
         }
    }       
    else
    {
        $print_form = 1;
    }
    
    if ($print_form == 1)
    {
	$query = "SELECT * FROM `newsNew` WHERE `id`='$new_id'";
        $result = mysql_query($query);
        $row = mysql_fetch_assoc($result);
        $row_name = $row['name'];
        $row_date = $row['date'];
        $row_text = $row['text'];
	$row_text = str_replace("<br />", "", $row_text);	
	$row_text = html_to_bb($row_text);
	?>
<script type="text/javascript" src="/News/news_adm/ckeditor/ckeditor.js"></script>
<form name="addform" action="<?=$phpself ?>" method="POST">
	Название новости:<br><input type="text" name="name" value="<?=$row_name ?>"><p>
	Дата:<br><input type="text" name="date" value="<?=$row_date ?>"><p>
<textarea name="addtext" cols=63 rows=10 value="" wrap="hard"><?=$row_text ?></textarea><br>
<input type="submit" value="Сохранить" /><br />
<script type="text/javascript">
CKEDITOR.replace( 'addtext');
</script>
</form>
        <?php
    }    

      function bb_to_html($str)
    {
	$bbcode = array(
		  '[b]',
		  '[i]',
                  '[u]',
		  '[center]',
		  '[/b]',
                  '[/i]',
                  '[/u]',
		  '[/center]'
		  );
	
	$html = array(
		'<b>',
		'<i>',
                '<u>',
		'<center>',
		'</b>',
                '</i>',
                '</u>',
		'</center>'
		);
				  
	$str = str_replace($bbcode, $html, $str);
		
	$bbcode = array(
		  '/\[font=(.+?)\]/i',
		  '/\[color=(.+?)\]/i',
                  '/\[size=(.+?)\]/i',
                  '/\[url=(.+?)\]/i',
		  '/\[img\](.+?)\[\/img\]/i'
		  );

	$html = array(
		'<font face="$1">',
		'<font color="$1">',
                '<font size="$1">',
                '<a href="$1">',
                '<img src="$1">'
		);

	$str = preg_replace($bbcode, $html, $str);
 
	$bbcode = array(
		  '[/font]',
		  '[/color]',
                  '[/size]',
		  '[/url]'
		  );
	
	$html = array(
		'</font>',
		'</font>',
                '</font>',
		'</a>'
		);
				  
	$str = str_replace($bbcode, $html, $str); 
	
	return $str;    
    }
    
    function html_to_bb($str)
    {
    	$html = array(
		'<b>',
		'<i>',
                '<u>',
		'<center>',
		'</b>',
                '</i>',
                '</u>',
		'</center>'
		);

	$bbcode = array(
		  '[b]',
		  '[i]',
                  '[u]',
		  '[center]',
		  '[/b]',
                  '[/i]',
                  '[/u]',
		  '[/center]'
		  );
				  
	$str = str_replace($html, $bbcode, $str);
	
	$html = array(
                  '/<font face="(.+?)">/i',
		  '/<font color="(.+?)">/i',
                  '/<font size="(.+?)">/i',
                  '/<a href="(.+?)">/i',
                  '/<img src="(.+?)">/i',
		  );

	$bbcode = array(
		'[font=$1]',
		'[color=$1]',
		'[size=$1]',
                '[url=$1]',
                '[img]$1[/img]'
		);

	$str = preg_replace($html, $bbcode, $str);

	$html = array(
		'</font>',
		'</font>',
                '</font>',
		'</a>'
		);
		
        $bbcode = array(
		  '[/font]',
		  '[/color]',
                  '[/size]',
		  '[/url]'
		  );
				  
	$str = str_replace($html, $bbcode, $str);
 
	return $str;
    }    

?>
</body>
</html> 