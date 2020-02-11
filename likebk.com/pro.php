<?

include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');

$_GET['id'] = (int)$_GET['id'];

$i = 0;

$html = '';

$j = 3094215;

function testuser($id) {
	$r = -1;
	$f = file_get_contents('http://primebk.ru/inf.php?'.$id);
	if( $f == 'Ошибка. Персонаж не найден.' ) {
		$r = 0;
	}else{
		$r = 1;
	}
	return $r;
}


$test = testuser($_GET['id']);
if($test == 1) {
	mysql_query('INSERT INTO `pro_users` (`uid`) VALUES ("'.mysql_real_escape_string($_GET['id']).'")');
}

if(isset($_GET['hh'])) {
	echo 'user_id: '.$_GET['id'].' ['.$test.']<script>location.href="/pro.php?id='.($_GET['id']+1).'&hh"</script>';
}else{
	echo 'user_id: '.$_GET['id'].' ['.$test.']<script>location.href="/pro.php?id='.($_GET['id']-1).'"</script>';
}

?>