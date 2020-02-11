<?php
include('_incl_data/__config.php');
define('GAME',true);
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__magic.php');
include('_incl_data/class/__user.php');

if(isset($_GET['out'])) {
	mysql_query('DELETE FROM `users` WHERE `id` IN (SELECT `id` FROM `users` WHERE `inUser` > 0 AND `inTurnirnew` > 0)');
	mysql_query('UPDATE `users` SET `inTurnirnew` = 0 , `inUser` = 0 WHERE `inUser` > 0');
	mysql_query('UPDATE `turnirs` SET `status` = 0 , `time` = "'.(time()+60*60).'" , `users_in` = 0 , `count` = `count` + 1 , `step` = 0 , `winner` = -1 , `chat` = -1');
	mysql_query('UPDATE `turnirs` SET `time` = "'.(time()+1.5*60*60).'"  WHERE `type` = 2 LIMIT 1');
}

?>