<?php

$db = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
mysql_select_db('like_mainbd',$db);
mysql_query('SET NAMES cp1251');

$test = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`level` FROM `users` WHERE `login` = "LEL" LIMIT 1'));

print_r($test);

echo '<hr>';

$test = mysql_query('UPDATE `users` SET `online` = "' . time() . '" WHERE `id` = "' . $test['id'] . '" LIMIT 1');
echo 'Test 1: ';
if( $test ) {
	echo '<font color=green><b>OK</b></font>';
}else{
	echo '<font color=red><b>ERROR!</b></font>';
}

echo '<hr>';

$test = mysql_query('INSERT INTO `zayvki` ( `noeff` ) VALUES ( "" )');
echo 'Test 2: ';
if( $test ) {
	echo '<font color=green><b>OK</b></font>';
}else{
	echo '<font color=red><b>ERROR!</b></font>';
}

?>
