<?
function getIP() {
   if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
   return $_SERVER['REMOTE_ADDR'];
}

/*if( $_SERVER['HTTP_CF_CONNECTING_IP'] != $_SERVER['SERVER_ADDR'] && $_SERVER['HTTP_CF_CONNECTING_IP'] != '127.0.0.1' ) {	die('Hello pussy!');   }

if(getIP() != $_SERVER['SERVER_ADDR'] && getIP() != '127.0.0.1' && getIP() != '' && getIP() != '212.224.113.192') {
	die(getIP().'<br>'.$_SERVER['SERVER_ADDR']);
}*/

define('GAME',true);

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');

function e($t) {
	mysql_query('INSERT INTO `chat` (`text`,`city`,`to`,`type`,`new`,`time`) VALUES ("core #'.date('d.m.Y').' %'.date('H:i:s').' ( ритическа¤ ошибка): <b>'.mysql_real_escape_string($t).'</b>","capitalcity","LEL","6","1","-1")');
}

$rep = mysql_query('SELECT 
				`hip`,`hip_buy`,`add_slot`,`nu_sandcity`,`n_sandcity`,`id`,
				`dl1`,`id`,`repcapitalcity`,`repdemonscity`,`repangelscity`,`repabandonedplain`,
				`repdevilscity`,`repmooncity`,`repsuncity`,`repsandcity`,`repemeraldscity`,`repdreamscity`,`repizlom`,
				`n_capitalcity`,`n_demonscity`,`n_suncity`,`nu_demonscity`,`nu_angelscity`,`nu_abandonedplain`,
				`nu_capitalcity`,`nu_suncity`,`nu_emeraldscity`,`nu_dreamscity`,`add_stats`,`add_money`,`add_skills`,`add_skills2`,
				`rep1`,`rep2`,`rep3`,`rep3_buy`,`repdragonscity`,`n_dragonscity`,`nu_dragonscity`,`nu_devilscity`,`nagrada`,
				(`repcapitalcity`+`repdemonscity`+`repangelscity`+`repsuncity`+`repdreamscity`+`repabandonedplain`+`repsandcity`+`repemeraldscity`+`repdevilscity`) as allrep, 
				(`nu_capitalcity`+`nu_demonscity`+`nu_angelscity`+`nu_suncity`+`nu_dreamscity`+`nu_abandonedplain`+`nu_sandcity`+`nu_emeraldscity`+`nu_devilscity`) as allnurep
				FROM `rep`');
				
				
		while($pl = mysql_fetch_array($rep)) {
			if($pl['allrep']-$pl['allnurep'] < 0) {
			$usr = mysql_fetch_array(mysql_query('SELECT `login`,`level` FROM `users` WHERE `id` = '.$pl['id'].' LIMIT 1'));
			echo 'Персонаж: ['.$pl['id'].'] '.$usr['login'].'['.$usr['level'].'] - репутации: '.($pl['allrep']-$pl['allnurep']).' ед.<br>';
			//mysql_query('UPDATE `rep` SET `nagrada` = "0" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
			}
			
		}		
?>