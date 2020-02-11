<?

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('telegramAPI.php');

if(mysql_query( 'INSERT INTO `input` ( `content`,`time`,`post`,`get`,`time_in`,`ip`,`ip_server` ) VALUES (
	"'.mysql_real_escape_string($_POST['content']).'",
	"'.time().'",
	"'.mysql_real_escape_string($_POST['post']).'",
	"'.mysql_real_escape_string($_POST['get']).'",
	"'.mysql_real_escape_string($_POST['time']).'",
	"'.mysql_real_escape_string($_POST['ip']).'",
	"'.mysql_real_escape_string($ipban).'" )
')) {
	//
	$api = new TelegramAPI;
	$api->start();
	//
}else{
	echo 'bad connect.';
}

$sid = mysql_insert_id();
?>