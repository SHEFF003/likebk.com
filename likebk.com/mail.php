<?
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');

function e($t) {
	mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("core #'.date('d.m.Y').' %'.date('H:i:s').' (����������� ������): <b>'.mysql_real_escape_string($t).'</b>","capitalcity","LEL","6","1","-1")');
}
function send_mime_mail($name_from, // ��� �����������
	$email_from, // email �����������
	$name_to, // ��� ����������
	$email_to, // email ����������
	$data_charset, // ��������� ���������� ������
	$send_charset, // ��������� ������
	$subject, // ���� ������
	$body // ����� ������
	) {
	//
	$to = mime_header_encode($name_to, $data_charset, $send_charset)
		. ' <' . $email_to . '>';
	$subject = mime_header_encode($subject, $data_charset, $send_charset);
	$from =  mime_header_encode($name_from, $data_charset, $send_charset)
		.' <' . $email_from . '>';
	if($data_charset != $send_charset) {
		$body = iconv($data_charset, $send_charset, $body);
	}
	$headers = "From: $from\r\n";
	$headers .= "Content-type: text/html; charset=$send_charset\r\n";
			
	return mail($to, $subject, $body, $headers);
}
		
function mime_header_encode($str, $data_charset, $send_charset) {
	if($data_charset != $send_charset) {
		$str = iconv($data_charset, $send_charset, $str);
	}
	return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
}

if( isset($_GET['blockme']) && md5($_GET['blockme'].'no!') == $_GET['key'] ) {
	$test = mysql_fetch_array(mysql_query('SELECT * FROM `aaa_nosend` WHERE `mail` = "'.mysql_real_escape_string($_GET['blockme']).'" LIMIT 1'));
	if(!isset($test['id'])) {
		mysql_query('INSERT INTO `aaa_nosend` (`mail`,`time`) VALUES ("'.mysql_real_escape_string($_GET['blockme']).'","'.time().'") ');
		echo '�� ������� ���������� �� ��������!';
	}else{
		$test = mysql_fetch_array(mysql_query('SELECT * FROM `aaa_nosend` WHERE `mail` = "'.mysql_real_escape_string($_GET['blockme']).'" AND `type` = "1" LIMIT 1'));
		if(!isset($test['id'])) {
			mysql_query('INSERT INTO `aaa_nosend` (`mail`,`time`,`type`) VALUES ("'.mysql_real_escape_string($_GET['blockme']).'","'.time().'","1") ');
			echo '�� ������� ���������� �� ��������!';
		}else{
			mysql_query('UPDATE `aaa_nosend` SET `time` = "'.time().'" WHERE `id` = "'.$test['id'].'" LIMIT 1');
			echo '�� ��� ���� �������� �� �������� �� �����!';
		}
	}
}elseif( isset($_GET['look']) && md5($_GET['look'].'no!') == $_GET['key'] ) {
	$test = mysql_fetch_array(mysql_query('SELECT * FROM `aaa_send_count` WHERE `mail` = "'.mysql_real_escape_string($_GET['look']).'" AND `type` = "1" LIMIT 1'));
	if(!isset($test['id'])) {
		mysql_query('INSERT INTO `aaa_send_count` (`mail`,`time`,`type`) VALUES ("'.mysql_real_escape_string($_GET['look']).'","'.time().'","1") ');
	}
}

if( isset($_GET['gj']) ) {
	//
	//OLDBK BASE
	$mails	= '
	
	if(isset($_GET['test'])) {
		$mails = $_GET['test'];
	}
	
	$mails = 'dits@qip.ru';
	
	$j = explode(',',$mails);
	$i = (int)$_GET['i'];
	$k = (int)$_GET['k'];
	if( $k < 100 ) {
		$k = 100;
	}
	$p = 0;
	while( $i < count($j) ) {
		if( $i < $k ) {
			$mail = $j[$i];
			//
			$title	= 'Original Combats: ����-������������!';
			$text	= '��� ��!';
			$from	= '';
			$author	= '� ���������<br>������������� ����������� ����� &nbsp;<a href="http://likebk.com/" target="_blank">likebk.com</a>&nbsp;.';
			//
			$text .= '<br><img src="http://likebk.com/mail.php?look='.$mail.'&key='.md5($mail.'no!').'" width="0" height="0" style="width:0px;height:0px;"><br>'.$author;
			$text .= '<br><br><br>�� ������ ���������� �� ��������� �������� �����: <a target="_blank" href="http://likebk.com/mail.php?blockme='.$mail.'&key='.md5($mail.'no!').'">likebk.com</a>';
			//
			send_mime_mail('������ ���������� ����',
				'support@likebk.com',
				'',
				$j[$i],
				'CP1251',  // ���������, � ������� ��������� ������������ ������
				'KOI8-R', // ���������, � ������� ����� ���������� ������
				$title,
				$text
			);
			$il = $i;
			$p++;
		}
		$i++;
	}
	echo '���������� �����: '.$p.'';
	if( $p > 0 ) {
		echo '<script>setTimeout("location.href=\'/mail.php?gj=1&i='.($il+1).'&k='.($k+100).'\';",1000);</script>';
	}
}
?>