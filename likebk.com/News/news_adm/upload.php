<?
function getex($filename) {
return end(explode(".", $filename));
}
if($_FILES['upload'])
{
if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name'])) )
{
$message = "�� �� ������� ����";
}
else if ($_FILES['upload']["size"] == 0 OR $_FILES['upload']["size"] > 2050000)
{
$message = "������ ����� �� ������������� ������";
}
else if (($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/png")  AND ($_FILES['upload']["type"] != "image/gif"))
{
$message = "����������� �������� ������ �������� JPG, GIF � PNG.";
}
else if (!is_uploaded_file($_FILES['upload']["tmp_name"]))
{
$message = "���-�� ����� �� ���. ����������� ��������� ���� ��� ���.";
}
else{
$name =rand(1, 1000).'-'.md5($_FILES['upload']['name']).'.'.getex($_FILES['upload']['name']);
move_uploaded_file($_FILES['upload']['tmp_name'], "../images/".$name);
$full_path = '/News/images/'.$name;
$message = "���� ".$_FILES['upload']['name']." ��������";
$size=@getimagesize('../images/'.$name);
if($size[0]<50 OR $size[1]<50){
unlink('../images/'.$name);
$message = "���� �� �������� ���������� ������������";
$full_path="";
}
}
$callback = $_REQUEST['CKEditorFuncNum'];
echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("'.$callback.'", "'.$full_path.'", "'.$message.'" );</script>';
}
?>