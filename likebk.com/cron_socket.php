<?
if(!isset($_GET['sec_server'])) {
	die('Я про это уже знаю ;)');
}

/*include_once ('socket.io.php');
$socketio = new SocketIO();
print_r( $socketio->send('likebk.com', 8090, 'message', 'CRON-1-'.date('d.m.Y H:i:s').'') );
echo 'ok.';*/

/*if( 
	//date('s') == 1 || //||
	date('s') == 5 || //||
	//date('s') == 10 || 
	//date('s') == 15 ||
	//date('s') == 20 ||
	//date('s') == 25 ||
	//date('s') == 30 //||
	date('s') == 35 //||
	//date('s') == 40 ||
	//date('s') == 45 ||
	//date('s') == 50 //||
	//date('s') == 55 
	|| isset($_GET['test'])
) {*/

		echo '@'.date('d.m.Y H:i:s').'@';
		//
		define('GAME',true);	
		include('_incl_data/__config.php');
		include('_incl_data/class/__db_connect.php');
		include('_incl_data/class/__user.php');
		include('_incl_data/class/__zv.php');
		//
		$zv->test(); //проверяем заявки
		//
//}

?>