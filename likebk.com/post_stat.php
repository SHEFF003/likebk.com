<?php
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__magic.php');
include('_incl_data/class/__user.php');

if( $u->info['admin'] == 0 ) {
	die();
}

$i = 0;
$all = 0;
$sp  = mysql_query('SELECT `id`,`timereg` FROM `users` WHERE `from` = "user1" AND `timereg` > 1498678909 ORDER BY `id` DESC');
while( $pl = mysql_fetch_array($sp) ) {
	$i++;
	$bnk = mysql_fetch_array(mysql_query('SELECT SUM(`moneyBuyReal`) FROM `bank` WHERE `uid` = "'.$pl['id'].'"'));
	$all += round($bnk[0]*70);
	echo $i.'. '.date('d.m.Y H:i:s',$pl['timereg']).' - '.$u->microLogin($pl['id'],1).' - ������: '.round($bnk[0]*70).' �. ('.$bnk[0].' ���.)<br>';
}
echo '<hr>';
$vip = 0;
echo '����� �������: <b>'.$all.' �.</b> ( ���� 20%: <b>'.round($all/100*20).' �.</b> )<br><br>�������� ���������: '.(round($all/100*20)-$vip).' �.'

?>