<?php
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__magic.php');
include('_incl_data/class/__user.php');

if($u->info['admin'] == 0) {
	header('location: http://likebk.com/');
	die();
}

if(!isset($_GET['r'])) {
	$_GET['r'] = 1;
}

?>
<!doctype html>
<html>
<head>
<meta charset="windows-1251">
<title>�������� ������</title>
</head>

<body>
<?
if(isset($_GET['clan'])) {
	$clan = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.mysql_real_escape_string($_GET['clan']).'" LIMIT 1'));
	if(isset($clan['id'])) {
		if(isset($_POST['clan_name'])) {
			
			$_POST['clan_name'] = htmlspecialchars($_POST['clan_name']);
			$testclan = mysql_fetch_array(mysql_query('SELECT `id` FROM `clan` WHERE `name` = "'.mysql_real_escape_string($_POST['clan_name']).'" LIMIT 1'));
			if( isset($testclan['id']) && $testclan['id'] != $clan['id'] ) {
				echo '<div><b><font color="red">������ ��� ��� ������ ������ �'.$testclan['id'].'!</font></b></div>';
			}elseif( $_POST['clan_name'] == '' ) {
				echo '<div><b><font color="red">������ ��������� ������ �������� �����!</font></b></div>';
			}else{				
				if( $_FILES['newico']['size'] > 0 ) {
					//�������� ������
					class upload {					 
						protected function __construct() { }					 
						static $save_path = '../img.likebk.com/i/clan/';
						static $error = '';					 
						static function saveimg($name,$max_mb = 2,$exts = 'jpg|png|jpeg|gif',$cnm = '') {
							if (isset($_FILES[$name])) {
								$f = &$_FILES[$name];
								if (($f['size'] <= $max_mb*1024*1024) && ($f['size'] > 0)) {
									if (
										(preg_match('/\.('.$exts.')$/i',$f['name'],$ext))&&
										(preg_match('/image/i',$f['type']))
									) {						
										$ext[1] = strtolower($ext[1]);
										$fn = uniqid('f_',true).'.'.$ext[1];
										//$fn2 = uniqid('f_',true).'.gif';
										if (move_uploaded_file( $_FILES[$name]['tmp_name'] , self::$save_path . $cnm . '.gif')) {
											// ������� ��������� ������� , ��������� Rimage
											//Rimage::resize(self::$save_path . $fn, self::$save_path . $fn2);
											//@unlink(self::$save_path . $fn); // �������� �����
											return array($fn, $fn);
										} else {
											self::$error = '������ �������� ����� ('.self::$save_path.'<b>'.$cnm.'.gif</b>)';
										}
									} else {
										self::$error = '�������� ��� �����. ���������� ���� : <b>'.$exts.'</b>';
									}
								} else {
									self::$error = '�������� ������ �����. ������������ ������ ����� <b>'.$max_mb.' ��</b>';
								}
							} else {
								self::$error = '���� �� ������';
							}
							return false;
						} // end saveimg					 
					} // end class
					//
					unlink('../img.likebk.com/i/clan/'.$clan['id'].'.gif');
					unlink('../img.likebk.com/i/clan/'.$clan['name'].'.gif');
					if($file = upload::saveimg('newico',0.5,'gif',$clan['name'])) {
						if(copy( '../img.likebk.com/i/clan/'.$clan['name'].'.gif' , '../img.likebk.com/i/clan/'.$clan['id'].'.gif' )) {
							echo '<div><b><font color="green">����� ������ ������ ��������!</font></b></div>';
						}else{
							echo '<div><b><font color="red">������ ������ �������� ������: '.upload::$error.'</font></b></div>';
						}
					}else{
						echo '<div><b><font color="red">������ �������� ������: '.upload::$error.'</font></b></div>';
					}
					//
				}
				if( $_POST['clan_name'] != $clan['name'] ) {
					//�������� ������ �����
					$_POST['clan_name'] = htmlspecialchars($_POST['clan_name']);
					unlink('../img.likebk.com/i/clan/'.$_POST['clan_name'].'.gif');
					rename('../img.likebk.com/i/clan/'.$clan['name'].'.gif','../img.likebk.com/i/clan/'.$_POST['clan_name'].'.gif');
					$clan['name'] = $_POST['clan_name'];
					mysql_query('UPDATE `clan` SET 
					
					`name` = "'.mysql_real_escape_string($clan['name']).'",
					`name_rus` = "'.mysql_real_escape_string($clan['name']).'",
					`name_mini` = "'.mysql_real_escape_string($clan['name']).'"
					
					WHERE `id` = "'.$clan['id'].'" LIMIT 1');
				}
				echo '<div><b><font color="green">������ � ����� '.$clan['name'].' ���������!</font></b></div>';
			}
		}elseif( isset($_GET['align']) ) {
			echo '<div><b><font color="green">���������� ����� '.$clan['name'].' ��������!</font></b></div>';
			$clan['align'] = $_GET['align'];
			mysql_query('UPDATE `clan` SET `align` = "'.mysql_real_escape_string($clan['align']).'" WHERE `id` = "'.$clan['id'].'" LIMIT 1');
			mysql_query('UPDATE `users` SET `align` = "'.mysql_real_escape_string($clan['align']).'" WHERE `clan` = "'.$clan['id'].'"');
		}elseif( isset($_POST['newglava']) ) {
			$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.mysql_real_escape_string($_POST['newglava']).'" LIMIT 1'));
			if(isset($usr['id'])) {
				mysql_query('UPDATE `users` SET `clan_prava` = "2" WHERE `clan` = "'.$clan['id'].'" AND (`clan_prava` = "glava" OR `clan_prava` = "1")');
				mysql_query('UPDATE `users` SET `align` = "'.$clan['align'].'" , `clan` = "'.$clan['id'].'" , `clan_prava` = "glava" WHERE `id` = "'.$usr['id'].'" LIMIT 1');
				echo '<div><b><font color="green">�� ���� ����� ����� '.$clan['name'].' �������� �������� '.$usr['login'].' (id '.$usr['id'].')!</font></b></div>';
			}else{
				echo '<div><b><font color="red">�������� � ����� id �� ������!</font></b></div>';
			}
		}
		echo '<form action="/clan_editor.php?clan='.$clan['id'].'" method="post" enctype="multipart/form-data">���� �'.$clan['id'].' ( <img src="http://img.likebk.com/i/align/align'.$clan['align'].'.gif"><img src="http://img.likebk.com/i/clan/'.$clan['id'].'.gif"><b>'.$clan['name'].'</b> )<hr>��������: <input name="clan_name" maxlength="50" style="width:244px;" value="'.$clan['name'].'" type="text"><hr>������ �����: &nbsp; <img src="http://img.likebk.com/i/clan/'.$clan['id'].'.gif"> (<img src="http://img.likebk.com/i/clan/'.$clan['name'].'.gif">)';
		echo '<hr>����� ������: <input type="file" name="newico"><hr><input type="submit" value="��������� ������">';
		echo '</form>';
		echo '<hr><b>����� ���������� �����:</b><br>[ <a href="/clan_editor.php?clan='.$clan['id'].'&align=0">��� ����������</a> ]';
		echo '<br>[ <a href="/clan_editor.php?clan='.$clan['id'].'&align=1">�������</a> ]';
		echo '<br>[ <a href="/clan_editor.php?clan='.$clan['id'].'&align=3">������</a> ]';
		echo '<br>[ <a href="/clan_editor.php?clan='.$clan['id'].'&align=7">�����������</a> ]';
		echo '<hr><form method="post" action="/clan_editor.php?clan='.$clan['id'].'"><b>����� ����� �����:</b><br>������� id ���������: <input type="text" name="newglava" value=""><input type="submit" value="������� �����!"></form>';
	}else{
		echo '���� �'.$_GET['clan'].' �� ������! <a href="/clan_editor.php">���������</a>';
	}
}elseif( $_GET['r'] == 1 ) {
	$sp = mysql_query('SELECT * FROM `clan` ORDER BY `id` DESC');
	while( $pl = mysql_fetch_array($sp) ) {
		echo '<div>#'.$pl['id'].' &nbsp; <img src="http://img.likebk.com/i/clan/'.$pl['id'].'.gif"> (<img src="http://img.likebk.com/i/clan/'.$pl['name'].'.gif">)<b>'.$pl['name'].'</b>';
		echo ' &nbsp; <a href="/clan_editor.php?clan='.$pl['id'].'">��������</a>';
		echo '</div><hr>';
	}
}
?>
</body>
</html>