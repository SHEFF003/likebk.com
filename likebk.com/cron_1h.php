<?php

function getIP() {
   if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
   return $_SERVER['REMOTE_ADDR'];
}

/*if(getIP() != $_SERVER['SERVER_ADDR'] && getIP() != '127.0.0.1' && getIP() != '' && getIP() != '188.134.44.67') {
	die(getIP().'<br>'.$_SERVER['SERVER_ADDR']);
}*/

define('GAME',true);

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');

function send_chat($type,$from,$text,$time) {
	mysql_query('INSERT INTO `chat` (`typeTime`,`global`,`text`,`city`,`login`,`to`,`type`,`new`,`time`,`room`) VALUES ("1","0","'.mysql_real_escape_string($text).'","capitalcity","'.mysql_real_escape_string($from).'","","'.$type.'","1","'.mysql_real_escape_string($time).'","0")');
}

//send_chat(6,'�������������','<font color=red><b><u>��������!</u></b> � ��� �������� ������� ������� � ������� �������, �� ���������� ����������� ����������� ����! (��������� � ��������� �����)</font>',time());

$dh = array(
	2 => '� 20:00 �� 23:00',
	3 => '� 18:00 �� 00:00',
	4 => '� 20:00 �� 23:00',
	5 => '� 20:00 �� 00:00',
	6 => '� 18:00 �� 00:00'
);

if( 

	(date('w') == 2 && date('H') >= 20 && date('H') < 23) ||
 	(date('w') == 3 && date('H') >= 18 && date('H') <= 23) ||
 	(date('w') == 4 && date('H') >= 20 && date('H') < 23) ||
 	(date('w') == 5 && date('H') >= 20 && date('H') <= 23) ||
 	(date('w') == 6 && date('H') >= 18 && date('H') <= 23)
	
) {
	//send_chat(6,'�������������','<font color=red><b><u>��������!</u></b> �� ����������� �������, ������������ �����, ��������� � �������� �������� ��������� ������������� ��� �� ����������. �� ����� ��� �������� ��� ��������� � ���������� �� ������������� ������ ���������.',time());	
}elseif(isset($dh[(int)date('w')])) {
	//$dht = $dh[(int)date('w')];
	//echo 1;
	//send_chat(6,'','<font color=red><b><u>��������!</u></b> �� ����������� �������, ������������ �����, ��������� � �������� �������� ������ ����������� ������������� ��� '.$dht.' �� �������.',time());
}

//send_chat(6,'�������������','<font color=red><b><u>��������!</u></b> � ��� �������� ������� ���������, ���������� �� ������: <a href=http://forum.likebk.com/?read=40938 target=_blank >forum.likebk.com/?read=40938</font>',time());