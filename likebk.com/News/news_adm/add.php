<?php
if ($isinclude == false) { Header("Location: news.php"); exit; }

?>
<html>
<head>
<title>�����-����� LikeBK | ���������� �������</title>
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
<a href="news.php">����� ���������� ���������</a><br />
<!-- <a href="index.php">� �������</a> -->
<?php

$date = date("d.m.Y H:i:s");
echo "<center><h3>���������� �������</h3></center>";

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
	    print "������������ ���� ��������� 40000 ��������.<br>\n"; 
            $print_form = 1;
	}
	elseif (strlen($text) <= 1)
	{
	    print "����������� ���� ��������� 2 �������.<br>\n"; 
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
	        print "<p><center>������� ������� ���������!<p>\n<a href=\"news.php?do=add\">�������� ���</a><br>\n
	        <a href=\"news.php\">� ����� ���������� ���������</a><br />\n";
$text_com2 = '<font color=red><b>��������!</b></font> � <i><a href=http://likebk.com/news target=_blank >��������� �����</a></i> ��������� ����� �������!';
mysql_query('INSERT INTO `chat` (`text`,`login`,`to`,`city`,`room`,`type`,`time`,`new`) VALUES ("'.$text_com2.'","","","capitalcity","9","2","'.time().'","1")');

        }
            else
            {
                print "��������� ������:" . mysql_error() . "\n";
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
			�������� �������:<br><input type="text" name="name" value="<?=$row_name ?>"><p>
			����:<br><input type="date" name="date" value="<?=$row_date ?>"><p>
		<textarea name="addtext" cols=63 rows=10 value="" wrap="hard"><?=$row_text ?></textarea><br>
		<input type="submit" value="�������� �������" /><br />
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