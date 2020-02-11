<?php
define('GAME',true);
setlocale(LC_CTYPE ,"ru_RU.CP1251");
include('../_incl_data/class/__db_connect.php');


$user = mysql_query('SELECT `id`,`align` FROM `users` WHERE `real` = 1 AND `banned` = 0');

while($pl = mysql_fetch_array($user)) {
	if($pl['align'] >= 1 && $pl['align'] < 2) {
		mysql_query('UPDATE `achiev` SET `a24` = `a24` + 1 WHERE `uid` = '.$pl['id'].' AND `a24lvl` < 3 LIMIT 1');
	}elseif($pl['align'] >= 3 && $pl['align'] < 4) {
		mysql_query('UPDATE `achiev` SET `a25` = `a25` + 1 WHERE `uid` = '.$pl['id'].' AND `a25lvl` < 3 LIMIT 1');
	}elseif($pl['align'] == 7) {
		mysql_query('UPDATE `achiev` SET `a26` = `a26` + 1 WHERE `uid` = '.$pl['id'].' AND `a26lvl` < 3 LIMIT 1');
	}
}

?>