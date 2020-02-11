<?php
if ($isinclude == false) { Header("Location: news.php"); exit; }

?>
<html>
<head>
<title>Админ-Центр LikeBK | Добавление новости</title>
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
<!-- <a href="index.php">В админку</a> -->
<?php

$date = date("d.m.Y H:i:s");
echo "<center><h3>Добавление новости</h3></center>";

$phpself = $_SERVER["PHP_SELF"]."?do=add";
$print_form = 0;

    if (@$_POST)
    {
    	$post_name =  $_POST['name'];
    	$post_date =  $_POST['date'];
        $text = $_POST['addtext'];        
	/*$text = htmlspecialchars($text);
        $text = bb_to_html($text);
	$text = nl2br($text);*/
	if (strlen($text) > 40000)
	{
	    print "Максимальная дина сообщения 40000 символов.<br>\n"; 
            $print_form = 1;
	}
	elseif (strlen($text) <= 1)
	{
	    print "Минимальная дина сообщения 2 символа.<br>\n"; 
            $print_form = 1;
	}
        else
        {
	    $query = "INSERT INTO `newsNew` ( `date` , `text`, `name` ) 
	    VALUES (
   	    '$date', '$text', '$post_name'
	    );";
	    if (mysql_query($query))
	    {
	        print "<p><center>Новость успешно добавлена!<p>\n<a href=\"news.php?do=add\">Добавить ещё</a><br>\n
	        <a href=\"news.php\">В центр Управления новостями</a><br />\n";
$text_com2 = '<font color=red><b>Внимание!</b></font> В <i><a href=http://likebk.com/news target=_blank >новостную ленту</a></i> добавлена новая новость!';
mysql_query('INSERT INTO `chat` (`text`,`login`,`to`,`city`,`room`,`type`,`time`,`new`) VALUES ("'.$text_com2.'","","","capitalcity","9","2","'.time().'","1")');

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
    
    if ($print_form == 1){?>
		<script type="text/javascript" src="/News/news_adm/ckeditor/ckeditor.js"></script>
		<form name="addform" action="<?=$phpself ?>" method="POST">
			Название новости:<br><input type="text" name="name" value="<?=$row_name ?>"><p>
			Дата:<br><input type="date" name="date" value="<?=$row_date ?>"><p>
		<textarea name="addtext" cols=63 rows=10 value="" wrap="hard"><?=$row_text ?></textarea><br>
		<input type="submit" value="Добавить новость" /><br />
		<script type="text/javascript">
		CKEDITOR.replace( 'addtext');
		</script>
		</form>
<?php }                                       

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

?>
</body>
</html>  