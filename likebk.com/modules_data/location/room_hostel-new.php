<?
 if(!defined('GAME')){ die(); }
session_start();
$sleep_mod = 0; 
$_SESSION['objaga'] = 'load ';
$hostel_option = array(
	'changelist' => array(
		'type' => 999,
		'room' => 214
	),
	'none' => array(
		'type' => 0,
		'room' => 214,
		'name' => '���������',
		'stage' => '����',
		'price' => 0,
		'partition' => ''
	),
	'base' => array(
		'type' => 1,
		't_name' => '����� � ���������',
		't_names' => '����� � ���������',
		'room' => 217,
		'name' => '���. ���� 1',
		'stage' => '�� 1 �����',
		'price' => 1,
		'tariff' => array('items'=>25, 'souvenirs'=>50, 'animal'=>0),
		'partition' => array(1=>'�������',2=>'���������',4=>'���',5=>'���������')
	),
	'advanced' => array(
		'type' => 2,
		't_name' => '����� � ���������',
		't_names' => '����� � ���������',
		'room' => 218,
		'name' => '���. ���� 2',
		'stage' => '�� 2 �����',
		'price' => 3,
		'tariff' => array('items'=>50, 'souvenirs'=>150, 'animal'=>0),
		'partition' => array(1=>'�������',2=>'���������',3=>'��������',4=>'���',5=>'���������')
	),
	'advanced2' => array(
		'type' => 3,
		't_name' => '����� �� ������',
		't_names' => '����� �� ������',
		'room' => 219,
		'name' => '���. ���� 3',
		'stage' => '�� 3 �����',
		'price' => 10,
		'tariff' => array('items'=>70, 'souvenirs'=>10000, 'animal'=>2),
		'partition' => array(1=>'�������',2=>'���������',3=>'��������',5=>'���������',4=>'���',5=>'���������')
	)
);
$sleep = $u->testAction('`vars` = "sleep" AND `uid` = "'.$u->info['id'].'" LIMIT 1', 1);

if( isset($sleep) AND $sleep[0]==0 AND ( isset($_GET['ajaxHostel']) AND $_GET['ajaxHostel'] == 1 OR  isset($_GET['ajax']) AND $_GET['ajax'] == 1) ){
	$hostel = mysql_fetch_array(mysql_query("SELECT * FROM `house` WHERE `owner` = '".mysql_real_escape_string($u->info['id'])."';"));

	if($hostel['partition'] == 2){
		if( isset($_GET['obj_add']) ){
			if($hostel['category'] == 1){
				$count = mysql_num_rows(mysql_query('SELECT `iu`.`item_id` FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE  	`iu`.`inShop` = "1" AND 	`iu`.`gift` = "" AND `iu`.`gtxt1` = "" AND `iu`.`gtxt2` = "" AND `iu`.`uid` = "'.$u->info['id'].'" AND `iu`.`delete` = "0" GROUP BY `im`.id,`iu`.item_id, `iu`.inGroup HAVING `iu`.inGroup > 0  UNION ALL SELECT `iu`.`item_id` FROM `items_users` AS `iu`  LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE  `iu`.inGroup=0 AND `iu`.`inShop` = "1" AND `iu`.`gift` = "" AND `iu`.`gtxt1` = "" AND `iu`.`gtxt2` = "" AND `iu`.`uid` = "'.$u->info['id'].'" AND `iu`.`delete` = "0" GROUP BY `iu`.id, `iu`.item_id'));
				$max = $hostel_option[$hostel['type']]['tariff']['items'];
			} elseif( $hostel['category'] == 2) {
				$count = mysql_num_rows(mysql_query('SELECT `iu`.`item_id` FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE  	`iu`.`inShop` = "1" AND 	`iu`.`gift` != "" AND `iu`.`uid` = "'.$u->info['id'].'" AND `iu`.`delete` = "0" GROUP BY `im`.id,`iu`.item_id, `iu`.inGroup HAVING `iu`.inGroup > 0  UNION ALL SELECT `iu`.`item_id` FROM `items_users` AS `iu`  LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE  `iu`.inGroup=0 AND `iu`.`inShop` = "1" AND `iu`.`gift` != "" AND `iu`.`uid` = "'.$u->info['id'].'" AND `iu`.`delete` = "0" GROUP BY `iu`.id, `iu`.item_id'));
				$max = $hostel_option[$hostel['type']]['tariff']['souvenirs'];
			}
			if( (int)$count < (int)$max ) {
				$u->obj_addItem($_GET['obj_add']);
			} else {
				exit('error');
			}
		}elseif(isset($_GET['obj_take'])){
			$u->obj_takeItem($_GET['obj_take']);
		}
	}
	die('ajaxHostel');
} elseif( isset($sleep) AND $sleep[0]==0 AND isset($_GET['room']) AND $_GET['room'] !='' AND (int)$_GET['room']>0 AND (int)$_GET['room']<10 AND !isset($_GET['to_sleep']) AND !isset($_GET['to_awake']) ){
	mysql_query('UPDATE `house` SET `partition` = "'.mysql_real_escape_string((int)$_GET['room']).'" WHERE `owner` = "'.mysql_real_escape_string($u->info['id']).'" LIMIT 1');
} elseif( isset($sleep) AND $sleep[0]==0 AND isset($_GET['category']) AND $_GET['category'] !='' AND (int)$_GET['category']>0 AND (int)$_GET['category']<10 ){
	mysql_query('UPDATE `house` SET `category` = "'.mysql_real_escape_string((int)$_GET['category']).'" WHERE `owner` = "'.mysql_real_escape_string($u->info['id']).'" LIMIT 1');
} elseif( isset($_GET['to_sleep']) and $_GET['to_sleep'] == '1' ){
	changeSleep(1);
} elseif( isset($_GET['to_awake']) AND $sleep['vars'] == 'sleep' ){
	changeSleep(2);
}
if( isset($sleep_mod) and !isset($sleep['id'])){
	$sleep_mod = 0;
} elseif( isset($sleep_mod) and isset($sleep['id'])){
	$sleep_mod = 1;
}
$hostel = mysql_fetch_array(mysql_query("SELECT * FROM `house` WHERE `owner` = '".mysql_real_escape_string($u->info['id'])."';"));
if( $sleep['vars'] == 'sleep' AND isset($hostel) && $hostel_option[$hostel['type']]['room'] != $u->room['id'] && $u->room['id'] != 214 ) changeSleep(2); // ���� ������� ���� � ������������ �����, �����������!!!
if( isset($_POST['savenotes']) AND $hostel['partition'] == '1' ) {
	saveNote();
}
if( isset($hostel) ) { #---��������� ������
	$hostel['balance'] = round(($hostel['weekcost']*(floor(($hostel['endtime']-time())/24/3600)))/7, 2);
	mysql_query("UPDATE `house` SET `balance` = '".$hostel['balance']."' WHERE `owner` = '".mysql_real_escape_string($u->info['id'])."';");
}
$result = array('filter'=>'', 'content'=>'', 'additional'=>'');

function updateHostel(){
	global $hostel, $hostel_option,$u, $err; 
	if( $hostel['action'] == 'changearenda' ){
		if($hostel['balance'] >= ($hostel_option[$_GET['changearenda']]['price']*2) ) {
			$endtime = time() + (($hostel['balance']-$hostel_option[$_GET['changearenda']]['price'])/$hostel_option[$_GET['changearenda']]['price'])*604800; 
			mysql_query("UPDATE `house` SET `starttime` = ".time().", `endtime` = ".$endtime.", `type` = '".mysql_real_escape_string($_GET['changearenda'])."', `weekcost` = '".$hostel_option[mysql_real_escape_string($_GET['changearenda'])]['price']."' WHERE `owner` = '".mysql_real_escape_string($u->info['id'])."';");
			$err = '<FONT COLOR=red><B>����� ����������� ��������� ����������� �������</B></FONT>';
			$hostel['type']=$_GET['changearenda'];
			$hostel['endtime'] = $endtime;
		}else{
			$err = '<FONT COLOR=red><B>�� ������� �� ������� '.( ($hostel_option[$_GET['changearenda']]['price']*2)-$hostel['balance'] ).' ��. ��� ����� ����������� ���������</B></FONT>';
		}
		unset($hostel['action']);
	} elseif( $hostel['action'] == 'newarenda' ){
		if($u->info['money']>=$hostel_option[$_GET['arenda']]['price']) {
			mysql_query("INSERT INTO `house`(`owner`,`type`,`starttime`,`endtime`,`balance`,`weekcost`) VALUES ('".mysql_real_escape_string($u->info['id'])."','".mysql_real_escape_string($_GET['arenda'])."','".time()."','".(time()+604800)."','".$hostel_option[$_GET['arenda']]['price']."','".$hostel_option[$_GET['arenda']]['price']."')");
			mysql_query("UPDATE `users` SET `money` = `money`-".$hostel_option[$_GET['arenda']]['price']." WHERE `id` = '".mysql_real_escape_string($u->info['id'])."';");
			$err = "<FONT COLOR=red><B>�� ���������� '".$hostel_option[$_GET['arenda']]['t_names']."' �� ".$hostel_option[$_GET['arenda']]['price']." ��.<BR></B></FONT><BR>";
		}else{
			$err = '<FONT COLOR=red><B>� ��� ������������ �����<BR></B></FONT><BR>';
		}
		$hostel = mysql_fetch_array(mysql_query("SELECT * FROM `house` WHERE `owner` = '".mysql_real_escape_string($u->info['id'])."';"));
	}
}
function changeSleep($sleep_action){
	global $hostel, $hostel_option, $u, $sleep, $sleep_mod;
	if( $sleep_action == 1 && $sleep['vars'] != 'sleep' ){
		mysql_query("UPDATE `eff_users` SET `sleeptime`=".time().",`deactiveLast` = ( `deactiveTime` - ".time()." ) WHERE `uid`='".mysql_real_escape_string($u->info['id'])."' AND `no_Ace` = 0 AND `delete` = 0");
		mysql_query('UPDATE `items_users` SET `time_sleep` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `delete` < 1001 AND `data` LIKE "%|sleep_moroz=1%"');
		mysql_query('DELETE FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND (`vars` = "sleep" OR `vars` = "unsleep")');
		$u->addAction(time(),'sleep',$u->info['city']);
		$sleep['vars']='sleep';
		$sleep_mod=1;
	} elseif( $sleep_action == 2 ){
		$sp = mysql_query('SELECT * FROM `items_users` WHERE `time_sleep` > 0 AND `uid` = "'.$u->info['id'].'" AND `delete` < 1001 AND `data` LIKE "%|sleep_moroz=1%"');
		while( $pl = mysql_fetch_array($sp) ) {
			$tm_add = time() - $pl['time_sleep'];
			mysql_query('UPDATE `items_users` SET `time_sleep` = "0",`time_create` = "'.($pl['time_create'] + $tm_add).'" WHERE `id` = "'.$pl['id'].'" LIMIT 1');
		}
		$sp = mysql_query('SELECT `id`,`deactiveTime`,`deactiveLast` FROM `eff_users` WHERE `v1` LIKE "pgb%" AND `delete` = "0" AND `deactiveTime` > 0 AND `uid` = "'.$u->info['id'].'" ORDER BY `timeUse` DESC');
		while($pl = mysql_fetch_array($sp)) {
			mysql_query("UPDATE `eff_users` SET `deactiveTime` = ".(time()+$pl['deactiveLast'])." WHERE `id`='".$pl['id']."' ");						
		}
		$sp = mysql_query('SELECT `id`,`sleeptime`,`timeUse` FROM `eff_users` WHERE `uid`="'.mysql_real_escape_string($u->info['id']).'" AND `no_Ace` = 0 AND `sleeptime` > 0 AND `delete` = 0');
		while($pl = mysql_fetch_array($sp)) {
			$timeUsen = time()-($pl['sleeptime']-$pl['timeUse']);
			mysql_query("UPDATE `eff_users` SET `timeUse`='".$timeUsen."',`sleeptime`='0',`delete`='0' WHERE `id`='".$pl['id']."' ");
		}
		mysql_query('UPDATE `actions` SET `vars` = "unsleep",`val` = "'.time().'" WHERE `id` = "'.$sleep['id'].'" LIMIT 1');
		mysql_query('DELETE FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND (`vars` = "sleep" OR `vars` = "unsleep")');
		$sleep['vars']='unsleep';
		$sleep_mod=0;
	}
	$sleep = $u->testAction('`vars` = "sleep" AND `uid` = "'.$u->info['id'].'" LIMIT 1', 1);
}

function changePets(){
	global $hostel, $hostel_option, $u, $cage1, $cage2, $pet;
	$pet = mysql_fetch_array(mysql_query("SELECT `id`, `sex`, `name`, `level`, `obraz` FROM `users_animal` WHERE `pet_in_cage` = '0' AND `uid` = '".mysql_real_escape_string($u->info['id'])."' AND `delete` = 0 LIMIT 1;"));
	if( $pet['id'] != $u->info['animal'] ) {
		$u->info['animal'] = $pet['id'];
		mysql_query('UPDATE `users` SET `animal` = "'.$pet['id'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	}
	if( isset($_GET['pet_id']) ) {
		$id = (int)$_GET['pet_id'];
		if( $_GET['pet_id'] < 0 ) {
			$id = -$id;
			//�������� ����� � ������
			$cageid = mysql_fetch_array(mysql_query("SELECT `id`,`name` FROM `users_animal` WHERE `pet_in_cage` = '0' AND `uid` = '".mysql_real_escape_string($u->info['id'])."' AND `id` = '".mysql_real_escape_string($id)."' LIMIT 1"));
			if( isset($cageid['id']) ) {
				$cageid1 = mysql_fetch_array(mysql_query("SELECT `id` FROM `users_animal` WHERE `pet_in_cage` = '1' AND `uid` = '".mysql_real_escape_string($u->info['id'])."' LIMIT 1"));
				if( isset($cageid1['id']) ) {
					$cageid2 = mysql_fetch_array(mysql_query("SELECT `id` FROM `users_animal` WHERE `pet_in_cage` = '2' AND `uid` = '".mysql_real_escape_string($u->info['id'])."' LIMIT 1"));
					if( isset($cageid2['id']) ) {
						mysql_query('UPDATE `users_animal` SET `pet_in_cage` = "0" WHERE `id` = "'.$cageid2['id'].'" LIMIT 1');
						mysql_query('UPDATE `users_animal` SET `pet_in_cage` = "2" WHERE `id` = "'.$cageid['id'].'" LIMIT 1');
					} else {
						mysql_query('UPDATE `users_animal` SET `pet_in_cage` = "2" WHERE `id` = "'.$cageid['id'].'" LIMIT 1');
					}
				} else {
					mysql_query('UPDATE `users_animal` SET `pet_in_cage` = "1" WHERE `id` = "'.$cageid['id'].'" LIMIT 1');
				}
				$u->error = '<FONT COLOR=red>�� ������� ��������� &quot;'.$cageid['name'].'&quot; � ���������!</FONT>';
			} else {
				$u->error = '<FONT COLOR=red><B>����� �� ������ � ���������!</B></FONT>';
			}
		} else {
			//�������� ����� �� ������
			$cageid = mysql_fetch_array(mysql_query("SELECT `id`,`name`,`pet_in_cage` FROM `users_animal` WHERE `pet_in_cage` > '0' AND `uid` = '".mysql_real_escape_string($u->info['id'])."' AND `id` = '".mysql_real_escape_string($id)."' LIMIT 1"));
			if( isset($cageid['id']) ) {
				if( $u->info['animal'] > 0 ) {
					mysql_query('UPDATE `users_animal` SET `pet_in_cage` = "'.$cageid['pet_in_cage'].'" WHERE `id` = "'.$u->info['animal'].'" LIMIT 1');
					mysql_query('UPDATE `users_animal` SET `pet_in_cage` = "0" WHERE `id` = "'.$cageid['id'].'" LIMIT 1');
				} else {
					mysql_query('UPDATE `users_animal` SET `pet_in_cage` = "0" WHERE `id` = "'.$cageid['id'].'" LIMIT 1');
				}
				$u->error = '<FONT COLOR=red>�� ������� ������� &quot;'.$cageid['name'].'&quot; �� ���������!</FONT>';
			} else {
				$u->error = '<FONT COLOR=red><B>����� �� ������ � ���������!</B></FONT>';
			}
		}
	}
	$pet = mysql_fetch_array(mysql_query("SELECT `id`, `sex`, `name`, `level`, `obraz` FROM `users_animal` WHERE `pet_in_cage` = '0' AND `uid` = '".mysql_real_escape_string($u->info['id'])."' AND `delete` = 0 LIMIT 1;"));
	if( $pet['id'] != $u->info['animal'] ) {
		mysql_query('UPDATE `users` SET `animal` = "'.$pet['id'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	}
	$cage1 = mysql_fetch_array(mysql_query("SELECT `id`, `sex`, `name`, `level`, `obraz`,`pet_in_cage` FROM `users_animal` WHERE `pet_in_cage` = '1' AND `uid` = '".mysql_real_escape_string($u->info['id'])."' AND `delete` = 0 LIMIT 1;"));
	$cage2 = mysql_fetch_array(mysql_query("SELECT `id`, `sex`, `name`, `level`, `obraz`,`pet_in_cage` FROM `users_animal` WHERE `pet_in_cage` = '2' AND `uid` = '".mysql_real_escape_string($u->info['id'])."' AND `delete` = 0 LIMIT 1;"));
	return array('pet' => $pet, 'cage1' => $cage1, 'cage2' => $cage2);
}

function saveNote() {
	global $hostel, $hostel_option, $u;
	$_POST['notes'] = str_replace(" \\n","\n",$_POST['notes']); 
	$simbolcount = strlen($_POST['notes']);
	if($simbolcount>10000) {
		$err = "<FONT COLOR=red><B>������� ����� ������... ����� �� ���������.<BR></B></FONT><BR>";
	} else {
		mysql_query("UPDATE `house` SET `notes` = '".mysql_real_escape_string($_POST['notes'])."' WHERE `owner` = '".mysql_real_escape_string($u->info['id'])."';");
		$hostel['notes'] = $_POST['notes'];
		$err = "<FONT COLOR=red><B>��������� (".$simbolcount.")<BR></B></FONT><BR>";
	}
	$hostel = mysql_fetch_array(mysql_query("SELECT * FROM `house` WHERE `owner` = '".mysql_real_escape_string($u->info['id'])."';"));
}
function hostel($id){
	global $hostel, $hostel_option, $u, $err;
	$filter = '<table cellpadding="0" cellspacing="0" style="padding:0px 16px 0px 8px;">
<tbody><tr><td>&nbsp;�������: ��� ����������. ��� ������������. ��� �������� ���������. ��� ������������� ����� � �������� ���������.</td>
</tr><tr><td align="right"><i>���������</i></td></tr></tbody></table>';
	$content = '';
	$additional = ''; 
	if($hostel['action'] == 'changelist'){ # ����� ������
		$content = "�� ������ ������� ���������� ���������:<br/><p><small>��� ����� ������ �� ����� ������� ������ ���� ����������� �����.<BR>����� ������, ���������� ������ �� ��������� ������ ���������.<BR>���������� �����, ��������� � �������� �� ����� ������ �� ������ ��������� ���������� �������� ��� ���������� ����������� ���������.<BR></small></p>".( $hostel['type'] != "base" ? "<hr align=\"left\" width=\"40%\"/>���������� <strong>����� � ���������</strong><BR>����: 1 ��. + 1 ��. � ������.<p style='padding-left:12px;margin: 5px 0px;'>&bull; ������ �������: 25 �����<BR>&bull; ��������: 50 ��.<BR>&bull; �����</p><A style='padding-left:12px;padding-bottom:6px' href=\"?changearenda=base&sd4=".$u->info['id']."\" onClick=\"return confirm('�� �������, ��� ������ ��������� 1 ��. �� ����� ���������?')\">������� ���������</A>" : '').( $hostel['type'] != "advanced" ? "<hr align=\"left\" width=\"40%\"/>���������� <strong>����� � ���������</strong><BR>����: 3 ��. + 3 ��. � ������.<p style='padding-left:12px;margin: 5px 0px;'>&bull; ������ �������: 40 �����<BR>&bull; ��������: 150 ��.<BR>&bull; �����</p><A style='padding-left:12px;padding-bottom:6px' href=\"?changearenda=advanced&sd4=".$u->info['id']."\" onClick=\"return confirm('�� �������, ��� ������ ��������� 3 ��. �� ����� ���������?')\">������� ���������</A>" : '').( $hostel['type'] != "advanced2" ? "<hr align=\"left\" width=\"40%\"/>���������� <strong>����� �� ������</strong><BR>����: 10 ��. + 10 ��. � ������.<p style='padding-left:12px;margin: 5px 0px;'>&bull; ������ �������: 70 �����<BR>&bull; ��������: 1000 ��.<BR>&bull; ���� ��� ��������: 2 <BR>&bull; �����</p><A style='padding-left:12px;padding-bottom:6px' href=\"?changearenda=advanced2&sd4=".$u->info['id']."\" onClick=\"return confirm('�� �������, ��� ������ ��������� 10 ��. �� ����� ���������?')\">������� ���������</A>" : '').'<br/>&nbsp;';
	} elseif($id == 0){ # ����� ������
		$content = '<div style="padding:8px 6px;"><strong>����� � ���������</strong><br/>����: 1 ��. + 1 ��. � ������.<br/><p style="padding-left:12px;margin: 5px 0px;">&bull; ������ �������: 25 �����<br/>&bull; ��������: 50 ��.<br/>&bull; �����</p><A style="padding-left:12px" href="?arenda=base&sd4='.$u->info['id'].'" onClick="return confirm(\'�� �������, ��� ������ ��������� 1 ��.?\')">����������</A><br/><hr align="left" width="40%"/><strong>����� � ���������</strong><br/>����: 3 ��. + 3 ��. � ������.<br/><p style="padding-left:12px;margin: 5px 0px;">&bull; ������ �������: 40 �����<br/>&bull; ��������: 150 ��.<br/>&bull; �����</p><A style="padding-left:12px" href="?arenda=advanced&sd4='.$u->info['id'].'" onClick="return confirm(\'�� �������, ��� ������ ��������� 3 ��.?\')">����������</A><br/><hr align="left" width="40%"/><strong>����� �� ������</strong><br/>����: 10 ��. + 10 ��. � ������.<br/><p style="padding-left:12px;margin: 5px 0px;">&bull; ������ �������: 70 �����<br/>&bull; ��������: 200 ��.<br/>&bull; ���� ��� ��������: 2 <br/>&bull; �����</p><A style="padding-left:12px;padding-bottom:6px" href="?arenda=advanced2&sd4='.$u->info['id'].'" onClick="return confirm(\'�� �������, ��� ������ ��������� 10 ��.?\')">����������</A><br/></div>';
	} else { # ������� ��������� ������
		$content = "�� ���������� �".$hostel_option[$hostel['type']]['t_name']."� ".$hostel_option[$hostel['type']]['stage']."
		<BR>������ ������: ".date('d.m.y H:i',$hostel['starttime'])."<BR>
		�������� ��: ".date("d.m.y H:i",$hostel['endtime']).' (������ '.$hostel['balance'].' ��.)'."
		<IMG id='button_payarenda' src=\"http://img.likebk.com/i/up.gif\" width=11 height=11 title=\"��������\" style=\"cursor:pointer\"><BR>���� � ������: ".$hostel['weekcost']." ��.<BR>&nbsp;&bull; ������ �������: ".$hostel_option[$hostel['type']]['tariff']['items']." �����<BR>&nbsp;&bull; ��������: ".$hostel_option[$hostel['type']]['tariff']['souvenirs']." ��.<BR>".($hostel_option[$hostel['type']]['tariff']['animal']>0 ? '&nbsp;&bull; ���� ��� ��������: '.$hostel_option[$hostel['type']]['tariff']['animal'].'<BR>' : '' )." &nbsp&bull; ����� <br/><p><A href=\"?closearenda=1&sd4=".$u->info['id']."\" onClick=\"return confirm('�� �������, ��� ������ ���������� ������?')\">���������� ������</A><BR><SMALL>��� ������ ������, ��� ���� �� ������� ����������� � ��� ���������.<BR>���� �������� ���������� ���. ���� � ��� ��� ���� ������ ��������, �� ����������� �� ����.<BR>������� ������� �� ������������.<BR>���� �� ������ �������� ������, �� ��� ���� ����������� � �� �� ������� ��������������� �������, ���� �� �������� ����.<BR></SMALL></p><p><A href=\"?changelist=1&sd4=".$u->info['id']."\">������� ������</A><BR><SMALL>��� ����� ������ �� ����� ������� ������ ���� ����������� �����.<BR>����� ������, ���������� ������ �� ��������� ������ ���������.<BR>���������� �����, ��������� � �������� �� ����� ������ �� ������ ��������� ���������� �������� ��� ���������� ����������� ���������.<BR></SMALL></p>";
		$content .= '  <div id="prompt-form-container" style="display: none;">
		    <form id="prompt-form">
		      <div id="prompt-message">������� �������� ����� �� ������? (1 ������ = '.$hostel['weekcost'].'��.)</div>
		      <input name="text" type="text" placeholder="0.00">
		      <input type="submit" value="���������">
		      <input type="button" name="cancel" value="������">
		    </form>
		  </div>';
	}
	// onClick=\"top.payarenda('".$hostel['owner']."','payarenda', '".$hostel['weekcost']."', '".$hostel['balance']."')\"
	return array('filter'=>$filter, 'content'=>$content, 'additional'=>$additional);
}

function partition($pid){
	global $hostel, $hostel_option, $u, $sleep, $category, $user_new_pers;
	$filter = '';
	$content = '';
	$additional = ''; 
	if( $hostel['partition'] == 0 OR $hostel['partition'] =='') $hostel['partition']  = 4; 
	# $hostel_option[$pid]['type'] - ���� � ������
	if( $hostel['partition'] == 1){ # �������
		$content = '<form method="post" name="F1" style="padding:2px 0px 2px 5px;">�� ���������� � ����� �������. ������, ��� �� ������ - �������� ������.<BR>
�� ������ �������� ������ ��� ������ ����� ������� �� ����� 10000 ��������.
<TEXTAREA rows=15 style="width: 90%;" name="notes">'.$hostel['notes'].'</TEXTAREA><BR>
<INPUT type="hidden" name="room" value="1">
<INPUT type="submit" name="savenotes" value="��������� �����"></form>';
	} else if( $hostel['partition'] == 2){ # ���������
		
		$text2 = '� �������';
		if( $hostel['category'] == 1 ){
			$text1 = '� �������';
			$count = mysql_num_rows(mysql_query('SELECT `iu`.`item_id` FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE  	`iu`.`inShop` = "1" AND 	`iu`.`gift` = "" AND `iu`.`gtxt1` = "" AND `iu`.`gtxt2` = "" AND `iu`.`uid` = "'.$u->info['id'].'" AND `iu`.`delete` = "0" GROUP BY `im`.id,`iu`.item_id, `iu`.inGroup HAVING `iu`.inGroup > 0  UNION ALL SELECT `iu`.`item_id` FROM `items_users` AS `iu`  LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE  `iu`.inGroup=0 AND `iu`.`inShop` = "1" AND `iu`.`gift` = "" AND `iu`.`gtxt1` = "" AND `iu`.`gtxt2` = "" AND `iu`.`uid` = "'.$u->info['id'].'" AND `iu`.`delete` = "0" GROUP BY `iu`.id, `iu`.item_id'));
			$chest = $u->genInv(7,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `im`.`type` != "28" AND `im`.`type` != "38" AND `im`.`type` != "39" AND `im`.`type` != "63" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="1" ORDER BY `lastUPD` DESC');
			$inventory = $u->genInv(8,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `im`.`type` != "28" AND `im`.`type` != "38" AND `im`.`type` != "39" AND `im`.`type` != "63" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" ORDER BY `lastUPD` DESC');
		} elseif( $hostel['category'] == 2 ){
			$text1 = '� ����������';
			$count = mysql_num_rows(mysql_query('SELECT `iu`.`item_id` FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE  	`iu`.`inShop` = "1" AND 	`iu`.`gift` != "" AND `iu`.`uid` = "'.$u->info['id'].'" AND `iu`.`delete` = "0" GROUP BY `im`.id,`iu`.item_id, `iu`.inGroup HAVING `iu`.inGroup > 0  UNION ALL SELECT `iu`.`item_id` FROM `items_users` AS `iu`  LEFT JOIN `items_main` AS `im` ON (`im`.`id` = `iu`.`item_id`) WHERE  `iu`.inGroup=0 AND `iu`.`inShop` = "1" AND `iu`.`gift` != "" AND `iu`.`uid` = "'.$u->info['id'].'" AND `iu`.`delete` = "0" GROUP BY `iu`.id, `iu`.item_id'));
			$chest = $u->genInv(10,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND (`im`.`type` = "28" OR `im`.`type` = "38" OR `im`.`type` = "39" OR `im`.`type` = "63") AND `iu`.`inOdet`="0" AND `iu`.`inShop`="1" ORDER BY `lastUPD` DESC');
			$inventory = $u->genInv(9,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND (`im`.`type` = "28" OR `im`.`type` = "38" OR `im`.`type` = "39" OR `im`.`type` = "63") AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" ORDER BY `lastUPD` DESC');
		}
		$additional = '<table width=100% cellpadding=0 cellspacing=0 valign=center><tr>
		<td class="add-btn'.( $hostel['category'] == 1 ? ' active' : '' ).'" align="center" valign="center"><a href="?'.( $hostel['category'] != 1 ? 'category=1&' : '' ).'rnd='.rand(0,999999999999).'" title="������"> ������ '.( $hostel['category'] == 1 ? '<span id="chestCount">[<span id="in_chest" style="padding: 0px 1px;">'.$count.'</span>/<span style="padding: 0px 1px;">'.$hostel_option[$hostel['type']]['tariff']['items'].'</span>]</span>' : '' ).'</a></td>
		<td class="add-btn'.( $hostel['category']  == 2 ? ' active' : '' ).'" align="center" valign="center"><a href="?'.( $hostel['category'] != 2 ? 'category=2&' : '' ).'rnd='.rand(0,999999999999).'" title="����� ��� ���������"> �������� '.( $hostel['category'] == 2 ? '<span id="giftCount">[<span id="in_chest" style="padding: 0px 1px;">'.$count.'</span>/<span style="padding: 0px 1px;">'.$hostel_option[$hostel['type']]['tariff']['souvenirs'].'</span>]</span>' : '' ).'</a></td>
		</tr></table>';
		
		$filter = '<table width="100%" cellpadding=0 cellspacing=0 valign=center><tr>
			<td width="50%" valign="center" style="border-left: 1px solid #a5a5a5; padding: 2px 5px; border-right: 1px solid #a5a5a5;">
				<table width="100%" cellpadding=0 cellspacing=0 valign=center>
					<tr>
						<td><font style="font-family: Arial, Tahoma, sans-serif; font-weight: bold;color: #003388;">'.$text1.':</font></td>
						<td align="right">
							<form id="line_filter1" style="display:inline; font-size:11px;" onsubmit="return false;" prc_adsf="true">
								�����: <div style="display:inline-block; position:relative; ">
								<input type="text" id="inp1FilterName"  placeholder="������� �������� ��������..." autofocus="autofocus" size="44" autocomplete="off">
								<img style="position:absolute; cursor:pointer; right: 2px; top: 3px; width: 12px; height: 12px;" onclick="document.getElementById(\'inp1FilterName\').value=\'\';" title="������ ������ (������� Esc)"  src="http://img.likebk.com/i/clear.gif">
								<input type="submit" style="display: none" id="inp1FilterName_submit" value="������" onclick="return false">
								<div class="autocomplete-suggestions" style="position: absolute; display: none;top: 15px; left:0px; margin:0px auto; right: 0px; max-height: 300px;"></div>
								</div>
							</form>
						</td>
					</tr>
				</table>
			</td>
			<td valign="top" valign="center" style="border-left: 1px solid #a5a5a5; padding: 2px 5px; border-right: 1px solid #a5a5a5;">
				<table width="100%" cellpadding=0 cellspacing=0 valign=center>
					<tr>
						<td><font style="font-family: Arial, Tahoma, sans-serif; font-weight: bold;color: #003388;">'.$text2.':</font></td>
						<td align="right">
							<form id="line_filter2" style="display:inline; font-size:11px;" onsubmit="return false;" prc_adsf="true">
								�����: <div style="display:inline-block; position:relative; ">
								<input type="text" id="inp2FilterName"  placeholder="������� �������� ��������..." autofocus="autofocus" size="44" autocomplete="off">
								<img style="position:absolute; cursor:pointer; right: 2px; top: 3px; width: 12px; height: 12px;" onclick="document.getElementById(\'inp2FilterName\').value=\'\';" title="������ ������ (������� Esc)"  src="http://img.likebk.com/i/clear.gif">
								<input type="submit" style="display: none" id="inp2FilterName_submit" value="������" onclick="return false">
								<div class="autocomplete-suggestions" style="position: absolute; display: none;top: 15px; left:0px; margin:0px auto; right: 0px; max-height: 300px;"></div>
								</div>
							</form>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr bgcolor="#a5a5a5">
			<td align="left" style="font-family: Arial, Tahoma, sans-serif; font-size:13px; padding:3px 0px 2px 5px">&nbsp;</td>
			<td align="right" style="font-family: Arial, Tahoma, sans-serif; font-size:13px; padding:3px 5px 2px 0px"><strong>&nbsp; �������: <span id="in_chest22">'.$u->info['transfers'].'</span>'.'</strong></td>
		</tr>
		</table>';

		$content = '<table width="100%" cellpadding=0 cellspacing=0 valign=center><tr>
			<td width="50%" valign="top"><div class="scrollStyle" style="border-left: 1px solid #a5a5a5; border-right: 1px solid #a5a5a5; height: 504px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(165, 165, 165); border-top-width: 2px; border-top-style: solid; border-top-color: rgb(165, 165, 165); overflow-y: auto; overflow-x: hidden;"><div '.( $chest[0] != 0 ? 'style="display:none;"': '' ).' id="chest_null"> �����</div><table id="chest" width="100%" cellpadding=0 cellspacing=0><tbody>'.$chest[2].'</tbody></table></div></td>
			<td valign="top" valign="top"><div class="scrollStyle" style="border-left: 1px solid #a5a5a5; border-right: 1px solid #a5a5a5; height: 504px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(165, 165, 165); border-top-width: 2px; border-top-style: solid; border-top-color: rgb(165, 165, 165); overflow-y: auto; overflow-x: hidden;"><div '.( $inventory[0] != 0 ? 'style="display:none;"': '' ).' id="inventory_null"> �����</div><table id="inventory" width="100%" cellpadding=0 cellspacing=0 ><tbody>'.$inventory[2].'</tbody></table></div></td>
		</tr></table>';
		
	} else if( $hostel['partition'] == 3) { # ��������
		$ar = changePets();
		$pet = $ar['pet'];
		$cage1 = $ar['cage1'];
		$cage2 = $ar['cage2'];
		$content = "<TABLE  style='padding:2px 0px 2px 5px;' width=100% cellpadding=0 cellspacing=0 valign=top>
			<TR style='padding-top: 10'>
				<TD>
					<table cellpadding=0 cellspacing=0><tr>";
						if( $cage1['pet_in_cage'] == 1 ) {
							$content  .= '<TD width=150 align=center><div><B>'.$cage1['name'].'</B> ['.$cage1['level'].']</div><A href="/main.php?pet_id='.$cage1['id'].'&sd4='.$u->info['id'].'&room=3&0.'.rand(0,9999999999999999).'" alt="��������"><IMG src="http://img.likebk.com/i/obraz/'.$cage1['sex'].'/'.$cage1['obraz'].'.gif" width=120 height=220></A></TD>';
						} else {
							$content  .= '<TD width=150 align=center><div><B>��������</B></div><BR><IMG src="http://img.likebk.com/i/obraz/0/null.gif" width=120 height=220></A></TD>';
						}
						if( $cage2['pet_in_cage'] == 2 ) {
							$content  .= '<TD width=150 align=center><div><B>'.$cage2['name'].'</B> ['.$cage2['level'].']</div><A href="/main.php?pet_id='.$cage2['id'].'&sd4='.$u->info['id'].'&room=3&0.'.rand(0,9999999999999999).'" alt="��������"><IMG src="http://img.likebk.com/i/obraz/'.$cage2['sex'].'/'.$cage2['obraz'].'.gif" width=120 height=220></A></TD>';
						} else {
							$content  .= '<TD width=150 align=center><div><B>��������</B></div><BR><IMG src="http://img.likebk.com/i/obraz/0/null.gif" width=120 height=220></A></TD>';
						}
				$content  .= "</tr></table>
				</TD>
				<TD>&nbsp;</TD>
				<TD width=150 align=center>";
						if(!$pet) {
							$content  .= '<div><B>��������</B></div><IMG src="http://img.likebk.com/i/obraz/0/null.gif" width=120 height=220>';
						} else {
							$content  .=  '<div><B>'.$pet['name'].'</B> ['.$pet['level'].']</div><A href="/main.php?pet_id=-'.$pet['id'].'&sd4='.$u->info['id'].'&room=3&0.'.rand(0,9999999999999999).'" alt="��������"><IMG src="http://img.likebk.com/i/obraz/'.$pet['sex'].'/'.$pet['obraz'].'.gif" width=120 height=220>';
						}
					$content  .= "</A>
				</TD>
			</TR>
		</TABLE><br/>";

	} else if( $hostel['partition'] == 4 ) { # ���

		if( $sleep['vars'] == 'sleep' ) $u->error = '<font>�� ����� ��� ������ ������������ � ������������ ���-����.</font>'; 
		$content = '<div style="padding:2px 0px 2px 5px;">�� ������ �������, ����� � ������� ����.<BR>'.'�� ����� ��� ��� ��������� ������� �� ��� ������������������. ��� �������� ���, ��������, ���������, ��� � �����.<BR>'.'��� �� ������ �� ��������� ��������� � ������������ ������ �������������<BR></div>';
		$filter = '<table width="100%" cellspacing="0" cellpadding="0" border="0"><tr>
				<td align="left">'.( $sleep['vars'] == 'sleep' ? "<DIV style='color: #FA0000'>" : '').'���������: <B>�� '.( $sleep['vars'] == 'sleep' ? '�����' : '�����������').'</B>'.( $sleep['vars'] == 'sleep' ? "</DIV>" : '').'</td>
				<td align="right"><a style="padding: 2px 15px;" href="?to_'.( $sleep['vars'] == 'sleep' ? 'awake' : 'sleep').'=1&sd4='.$u->info['id'].'&room=4&0.'.( rand(0,9999999999999999) ).'" >'.( $sleep['vars'] == 'sleep' ? '����������' : '������').'</a></td>
		</tr></table>';

} else if( $hostel['partition'] == 5 ) { # ��������

		$filter = "<h3>������ � �����������</h3>";
		$p_now = mysql_fetch_array(mysql_query('SELECT * FROM `users_twink` WHERE `uid` = "'.$u->info['id'].'" AND `twink` = "'.$u->info['twink'].'" LIMIT 1'));
		if(!isset($p_now['id'])) {
			mysql_query('INSERT INTO `users_twink` (
				`uid`,`twink`,`login`,`level`,`exp`,`upLevel`,`stats`,`time`,`ability`,`skills`,`sskills`,`nskills`,`priems`,`obraz`,`win`,`lose`,`nich`,`money1`
			) VALUES (
				"'.$u->info['id'].'","0","'.$u->info['login'].'","'.$u->info['level'].'",
				"'.$u->info['exp'].'","'.$u->info['upLevel'].'","'.$u->info['stats'].'","'.time().'",
				"'.$u->info['ability'].'","'.$u->info['skills'].'","'.$u->info['sskills'].'","'.$u->info['nskills'].'","'.$u->info['priems'].'",
				"'.$u->info['obraz'].'","'.$u->info['win'].'","'.$u->info['lose'].'","'.$u->info['nich'].'","'.$u->info['money'].'"
			) ');
			$p_now = mysql_fetch_array(mysql_query('SELECT * FROM `users_twink` WHERE `uid` = "'.$u->info['id'].'" AND `twink` = "'.$u->info['twink'].'" LIMIT 1'));
		} else {
			//��������� ������� ������
			$p_now['login'] = $u->info['login'];
			$p_now['align'] = $u->info['align'];
			$p_now['clan'] = $u->info['clan'];
			$p_now['level'] = $u->info['level'];
			$p_now['exp'] = $u->info['exp'];
			$p_now['upLevel'] = $u->info['upLevel'];
			$p_now['stats'] = $u->info['stats'];
			$p_now['time'] = time();
			$p_now['ability'] = $u->info['ability'];
			$p_now['skills'] = $u->info['skills'];
			$p_now['sskills'] = $u->info['sskills'];
			$p_now['nskills'] = $u->info['nskills'];
			$p_now['priems'] = $u->info['priems'];
			$p_now['obraz'] = $u->info['obraz'];
			$p_now['win'] = $u->info['win'];
			$p_now['lose'] = $u->info['lose'];
			$p_now['nich'] = $u->info['nich'];
			$p_now['money1'] = $u->info['money'];
			mysql_query('UPDATE `users_twink` SET
					`login` = "'.$u->info['login'].'",
					`level` = "'.$u->info['level'].'",
					`exp` = "'.$u->info['exp'].'",
					`upLevel` = "'.$u->info['upLevel'].'",
					`stats` = "'.$u->info['stats'].'",
					`time` = "'.$u->info['time'].'",
					`ability` = "'.$u->info['ability'].'",
					`skills` = "'.$u->info['skills'].'",
					`sskills` = "'.$u->info['sskills'].'",
					`nskills` = "'.$u->info['nskills'].'",
					`priems` = "'.$u->info['priems'].'",
					`obraz` = "'.$u->info['obraz'].'",
					`win` = "'.$u->info['win'].'",
					`lose` = "'.$u->info['lose'].'",
					`nich` = "'.$u->info['nich'].'",
					`align` = "'.$u->info['align'].'",
					`clan` = "'.$u->info['clan'].'",
					`stopexp` =  "'.$u->info['stopexp'].'"
				WHERE `id` = "'.$p_now['id'].'" LIMIT 1');
				if($p_now['twink'] > 0) {
					echo $u->info['money'];
					mysql_query('UPDATE `users_twink` SET `money1` = '.$u->info['money'].' WHERE `uid` = '.$u->info['id'].' AND `twink` > 0 LIMIT 1');
				}
				
		}
		if(isset($_GET['change_pers'])) {
			$p_sel = mysql_fetch_array(mysql_query('SELECT * FROM `users_twink` WHERE `uid` = "'.$u->info['id'].'" AND `id` = "'.mysql_real_escape_string($_GET['change_pers']).'" LIMIT 1'));
			if(isset($p_sel['id']) && $p_sel['id'] != $p_now['id']) {
				//������� �� ���������
				$test = mysql_fetch_array(mysql_query('SELECT `id`,`time`,`val` FROM `actions` WHERE `uid` = "'.$u->info['id'].'" AND `vals` = "twink'.$u->info['id'].'" LIMIT 1'));
				if(isset($test['id']) && ($test['time'] <= time()) && (date('d.m.Y') == $test['val'])) {
					$u->error = '<font color=red><b>����� ����� ������ �� ������� ������� :(</b></font>';
				}else{
					mysql_query('UPDATE `users` SET
							`money` = "'.$p_sel['money1'].'",
							`level` = "'.$p_sel['level'].'",
							`clan` = "'.$p_sel['clan'].'",
							`align` = "'.$p_sel['align'].'",
							`obraz` = "'.$p_sel['obraz'].'",
							`twink` = "'.$p_sel['twink'].'",
							`win` = "'.$p_sel['win'].'",
							`lose` = "'.$p_sel['lose'].'",
							`nich` = "'.$p_sel['nich'].'"
						WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					mysql_query('UPDATE `stats` SET
							`upLevel` = "'.$p_sel['upLevel'].'",
							`stats` = "'.$p_sel['stats'].'",			
							`ability` = "'.$p_sel['ability'].'",
							`skills` = "'.$p_sel['skills'].'",
							`sskills` = "'.$p_sel['sskills'].'",
							`nskills` = "'.$p_sel['nskills'].'",
							`priems` = "'.$p_sel['priems'].'",			
							`exp` = "'.$p_sel['exp'].'"
						WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					//if($p_sel['twink'] == 0) {
						//$u->addAction(time(),'twink'.$u->info['id'].'',$u->info['city']);
					//}
					if( $p_sel['twink'] > 0 ) {
						if(!isset($test['id'])) {
							mysql_query('INSERT INTO `actions` (`uid`,`time`,`city`,`room`,`ip`,`vals`,`val`) VALUES ("'.$u->info['id'].'","'.(time() + 3600).'","'.$u->info['city'].'","'.$u->info['room'].'","'.$u->info['ip'].'","twink'.$u->info['id'].'","'.date('d.m.Y').'")');
						}else{
							if($test['time'] <= time() && $test['val'] != date('d.m.Y')) {
								mysql_query('UPDATE `actions` SET `time` = '.(time() + 3600).', `val` = "'.date('d.m.Y').'" WHERE `id` = '.$test['id'].' LIMIT 1');
							}
						}
						//���������� �������� � ��������� ���������
						mysql_query('UPDATE `items_users` SET `uid` = "-91'.$u->info['id'].'" WHERE `uid` = "'.$u->info['id'].'"');
						mysql_query('UPDATE `items_users` SET `uid` = "'.$u->info['id'].'" WHERE `uid` = "-92'.$u->info['id'].'"');
					}else{
						//���������� ���� � ������
						mysql_query('UPDATE `items_users` SET `uid` = "-92'.$u->info['id'].'" WHERE `uid` = "'.$u->info['id'].'"');
						mysql_query('UPDATE `items_users` SET `uid` = "'.$u->info['id'].'" WHERE `uid` = "-91'.$u->info['id'].'"');
					}
					//mysql_query('UPDATE `items_users` SET `inOdet` = "0" WHERE `uid` = "'.$u->info['id'].'" OR `uid` = "-91'.$u->info['id'].'" OR `uid` = "-92'.$u->info['id'].'"');
					//
					mysql_query('UPDATE `items_users` SET `uid` = "'.$u->info['id'].'" WHERE (`uid` = "-91'.$u->info['id'].'" OR `uid` = "-92'.$u->info['id'].'") AND `inShop` = 1');
					//
					die('<script>location.href="main.php?room=5";</script>');
				}
			}else{
				$u->error = '<b><font color=red>�������� �� ����� ���� ������</font></b><br>';
			}
		} elseif(isset($_GET['add_new_chars']) && $user_new_pers == true ) {
			$p_count = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `users_twink` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
			$p_count = $p_count[0];
			if( $u->info['level'] < 11 ) {
				$u->error = '<b><font color=red>��������� ���� 12-�� ������ �� ����� ��������� ����� ����������</font></b>';
			}elseif( $p_count > 1 ) {
				$u->error = '<b><font color=red>�� �� ������ ��������� ����� ���� ����������</font></b><br>';
			} else {
				mysql_query('INSERT INTO `users_twink` (
						`uid`,`twink`,`login`,`level`,`exp`,`upLevel`,`stats`,`time`,`ability`,`skills`,`sskills`,`nskills`,`priems`,`obraz`
					) VALUES (
						"'.$u->info['id'].'","'.$p_count.'","'.$u->info['login'].'","8",
						"150000","56","s1=3|s2=3|s3=3|s4=7|rinv=40|m9=5|m6=10","'.time().'",
						"34","5","0","5","0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0|0",
						"0.gif"
					) ');
			}
		}
		$sp = mysql_query('SELECT * FROM `users_twink` WHERE `uid` = "'.$u->info['id'].'"');
		$content = '';
		while( $pl = mysql_fetch_array($sp) ) {
			if( $pl['id'] != $p_now['id'] ) {
				$content .= '<a href="main.php?room=5&change_pers='.$pl['id'].'">';
			}
			$content .= '<div style="';
			if( $pl['id'] == $p_now['id'] ) {
				$content .= 'border:5px solid black;';
			} else {
				$content .= 'border:5px solid #E2E0E0;';
			}
			$content .= 'position:relative;display:inline-block;width:120px;height:220px;background-image:url(\'http://img.likebk.com/i/obraz/'.$u->info['sex'].'/'.$pl['obraz'].'\')">';
			$content .= '<div align="center" style="position:absolute;bottom:0px;left:0px;width:114px;background-color:#E2E0E0;margin:3px;"><b>'.$pl['login'].'</b> ['.$pl['level'].']<img width="12" height="11" src="http://img.likebk.com/i/inf_capitalcity.gif"></div>';	
			$content .= '</div>';
			if( $pl['id'] != $p_now['id'] ) {
				$content .= '</a>';
			}
		}
		if( $user_new_pers == true && $u->info['admin'] > 0) {
			$count = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `users_twink` WHERE `uid` = '.$u->info['id'].' AND `twink` > 0 LIMIT 1'));
			$count = $count[0];//���-�� �������, ������ 1-�� ������� ������
			if($count < 1) {
				$content .= '<div style="';
				$content .= 'border:5px solid #E2E0E0;';
				$content .= 'position:relative;display:inline-block;width:120px;height:220px;background-image:url(\'http://img.likebk.com/chars/'.$u->info['sex'].'/0.png\')">';
				$content .= '<div align="center" style="position:absolute;bottom:0px;left:0px;width:114px;background-color:#E2E0E0;margin:3px;"><a href="?add_new_chars=1&room=5">�������� ���������</a></div>';	
				$content .= '</div>';
			}
		}
	}
	return array('filter'=>$filter, 'content'=>$content, 'additional'=>$additional);
}

if($_GET['changelist']==1 && $hostel['id']>0) {
	$hostel['action'] = 'changelist';
} elseif( isset($_GET['changearenda']) && ($_GET['changearenda'] == 'advanced2' OR $_GET['changearenda'] == 'advanced' OR $_GET['changearenda'] == 'base')  && $hostel['id']>0 ){
	$hostel['action'] = 'changearenda';
} elseif( isset($_GET['arenda']) && isset($hostel_option[$_GET['arenda']]) && $hostel_option[$_GET['arenda']]['type']>0){
	$hostel['action'] = 'newarenda';
}
if( isset($hostel['action']) AND $hostel['action'] != '' ){
	updateHostel();
}

//if( $u->info['admin'] > 0 ) { # ������
	$user_new_pers = true;
//} else {
//	$user_new_pers = false;
//}



if( !isset($hostel) && $u->room['id'] != 214 ) {
	$result['filter'] = '<font color="red">�� ������ �� ��������� �� ���� �����.</font><BR>';
} elseif( isset($hostel) && $hostel_option[$hostel['type']]['room'] != $u->room['id'] && $u->room['id'] != 214 ) {
	$result['filter'] = '<font color="red">�� ������ �� ��������� �� ���� �����.</font><BR>';
	$hostel_option[$hostel['type']]['type'] = false;
} elseif( isset($hostel) && $hostel_option[$hostel['type']]['room'] == $u->room['id'] && $u->room['id'] != 214 ){
	$result = partition( $hostel['type'] );
} elseif( $u->room['id'] == 214 ){
	if( isset($_GET['closearenda']) && (int)$_GET['closearenda']==1) { #---���������� ������
		mysql_query("UPDATE `items_users` SET `inShop` = '0' WHERE `uid` = '".mysql_real_escape_string($u->info['id'])."' AND `inShop` = '1';");
		mysql_query("DELETE FROM `house` WHERE `owner` = '".mysql_real_escape_string($u->info['id'])."';");
		$err = '<FONT COLOR=red><B>�� ���������� ���������� "'.$hostel_option[$hostel['type']]['t_name'].'"</B></FONT>';unset($hostel);
	}
	if(isset($hostel) && $hostel_option[$hostel['type']]['type'] > 0){
		/*if($_POST['payarenda']) { #---�������� ������
			if($_POST['payarenda']>=1) {
				if($u->info['money']>0 && (int)$_POST['payarenda']>0 && ((int)$_POST['payarenda']<=$u->info['money'])) {
					$paytime = ($_POST['payarenda']/$hostel['weekcost'])*604800;
					mysql_query("UPDATE `house`,`users` SET `house`.`endtime` = `house`.`endtime`+'".$paytime."', `house`.`balance` = `house`.`balance`+'".mysql_real_escape_string($_POST['payarenda'])."',`users`.`money`=`users`.`money`-'".mysql_real_escape_string($_POST['payarenda'])."' WHERE `house`.`owner` = `users`.`id` AND `house`.`owner` = '".mysql_real_escape_string($u->info['id'])."';");
					$err = '<FONT COLOR=red><B>�� �������� �� ���� '.htmlspecialchars($_POST['payarenda'],NULL,'cp1251').'.00 ��.</B></FONT>';
					$u->info['money'] -=$_POST['payarenda'];
					$hostel['balance'] +=$_POST['payarenda'];
					$hostel['endtime'] += $paytime;
				} else {
					$err = '<FONT COLOR=red><B>� ��� ������������ �����<BR></B></FONT><BR>';
				}
			} else {
				$err = '<FONT COLOR=red><B>����������� �����: 1��.<BR></B></FONT><BR>';
			}
		}*/
		if($_GET['payarenda']) { #---�������� ������
			if($_GET['payarenda']>=1) {
				if($u->info['money']>0 && (int)$_GET['payarenda']>0 && ((int)$_GET['payarenda']<=$u->info['money'])) {
					$paytime = ($_GET['payarenda']/$hostel['weekcost'])*604800;
					mysql_query("UPDATE `house`,`users` SET `house`.`endtime` = `house`.`endtime`+'".$paytime."', `house`.`balance` = `house`.`balance`+'".mysql_real_escape_string($_GET['payarenda'])."',`users`.`money`=`users`.`money`-'".mysql_real_escape_string($_GET['payarenda'])."' WHERE `house`.`owner` = `users`.`id` AND `house`.`owner` = '".mysql_real_escape_string($u->info['id'])."';");
					$err = '<FONT COLOR=red><B>�� �������� �� ���� '.htmlspecialchars($_GET['payarenda'],NULL,'cp1251').' ��.</B></FONT>';
					$u->info['money'] -=$_GET['payarenda'];
					$hostel['balance'] +=$_GET['payarenda'];
					$hostel['endtime'] += $paytime;
				} else {
					$err = '<FONT COLOR=red><B>� ��� ������������ �����<BR></B></FONT><BR>';
				}
			} else {
				$err = '<FONT COLOR=red><B>����������� �����: 1��.<BR></B></FONT><BR>';
			}
		}
		$result = hostel($hostel_option[$hostel['type']]['type']); 
	} else {
		$result = hostel(0); 
	}
}
?>
<style>
	#chest_null , #inventory_null  {text-align:center;}
	
	.scrollStyle .item table { border-bottom: 1px solid #A5A5A5; }
	.menuList {text-align: right;display:block;margin:6px 8px 20px 16px;position:relative;padding:3px 0px;border-right: 2px solid #a5a5a5;}
	.menuList:after { clear:both;content:'';position:absolute;z-index:-1;border-radius:5px;right:-5px;width:9px;height:9px;bottom:-8px;background: #a5a5a5;}
	.menuList:before { clear:both;content:'';position:absolute;z-index:-1;border-radius:5px;right:-5px;width:9px;height:9px;top:-8px;background: #a5a5a5;}
	.menuItem {display:block;padding-right: 9px;margin-top:2px;}
	.menuActive {position:relative;overflow: hidden;margin-top:2px;display: block;padding-right: 14px;}
	.menuActive:before {content:'';position:absolute;z-index:-1;transform: rotate(45deg);right:-5px;width:10px;height:10px;top:3px;background: #a5a5a5;}
	.pH3 { COLOR: #8f0000;  FONT-FAMILY: Arial;  FONT-SIZE: 12pt;  FONT-WEIGHT: bold; }
	.ahint { margin: 0px auto; left: 0px; right: 0px; top: 23%; }
	.add-btn {font-size: 12px;background: #C8C8C8;height:30px;box-sizing:border-box;border-bottom:1px solid #a5a5a5;vertical-align: middle;font-family: Arial, Tahoma, sans-serif;}
	.add-btn.active {background: #e2e0e1;border-left:1px solid #a5a5a5;border-right:1px solid #a5a5a5;border-bottom:0px;}
	.add-btn > a > span { color: #222; font-size:10px; font-weight: 400;}
</style>
<script type="text/javascript" src="js/jquery.1.11.js"></script>
<? if( $hostel['partition'] == 2){ ?>
<script type="text/javascript" src="js/jquery.cookie.1.4.1.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<? } ?>
<script>
<? if( $hostel['partition'] == 2){ ?>
$.cookie('invFilterByName1','');
$.cookie('invFilterByName2','');

$(document).ready(function () {
	
	function moveAnimate(element, newParent){
		element = $(element);
		newParent= $(newParent);
		var oldOffset = element.offset();
		element.appendTo(newParent);
		var newOffset = element.offset();
		var temp = element.clone().appendTo('#contentBox');
		temp.css('position', 'absolute').css('left', oldOffset.left).css('top', oldOffset.top).css('width', element.width()).css('zIndex', 250);
		element.hide();
		temp.animate( {
			'top': newOffset.top,
			'left':newOffset.left
		}, 'slow', function(){
			element.show();
			temp.remove();
		});
		var count_inventory = $('#inventory .item').length;
		var count_chest = $('#chest .item').length;
		if (parseInt(count_chest)==0) {
			$('#chest_null').show();
		} else {
			$('#chest_null').hide();
		}
		if (parseInt(count_inventory)==0) {
			$('#inventory_null').show();
		} else {
			$('#inventory_null').hide();
		}
	}

	function obj_recount(action){
		var count = parseInt($('#in_chest').text());
		var count22 = parseInt($('#in_chest22').text());
		if (action==1) {
			$('#in_chest').text(count+1);
			$('#in_chest22').text(count22-1);
		}
		if (action==2) {
			$('#in_chest').text(count-1);
			$('#in_chest22').text(count22-1);
		}
	}

	function obj_add(id, room, rnd, t){
		//if( parseInt($('#in_chest22').text()) > 0 ) {
			if (rnd=='' || rnd ==undefined || rnd =='undefined') {var rnd = 1;}
				var dataString = "ajaxHostel=1&obj_add="+id+"&room="+room+"&rnd="+rnd;
				$.ajax({
					type: "GET",
					dataType: 'html',
					data: dataString,
					url: "main.php",
					cache: false,
					success: function (data) {
						if (data=='error') {
							$("#errorMsg").html("<font color='red'>������ �� ����������!</font>");
						} else {
							$(t).attr('class','obj_take');
							$(t).text('� ������');
							t = $(t).parents('.item').first();
							obj_recount(1);
							moveAnimate(t, $('#chest').children('tbody'));
							setTimeout(UpdateItemList(), 200);
						}
					}
				}); 
		//} else {
		//	alert('����� ������� �� ������� ��������.');
		//}
	}

	function obj_take(id, room, rnd, t){
		//if( parseInt($('#in_chest22').text()) > 0 ) {
			$(t).text('<? 
			if( $hostel['category'] == 1 ){
				echo "� ������";
			} elseif($hostel['category'] == 2 ){
				echo "��� ������";
			} else echo "����-�� ��������";?>');
			
			t = $(t).parents('.item').first();
			if (rnd=='' || rnd ==undefined || rnd =='undefined') {var rnd = 1;}$.ajax({type: "GET",url: "main.php?ajax=1&obj_take="+id+"&room="+room+"&rnd="+rnd,cache: false,success: function () {
				obj_recount(2);
				moveAnimate(t, $('#inventory').children('tbody'));
				setTimeout(UpdateItemList(), 200);
			}});
		//} else {
		//	alert('����� ������� �� ������� ��������.');
		//}
	}

	function UpdateItemList(){
		var inv_names1 = []; // chest
		var inv_names2 = []; // inventory
		var items1 = $('#chest').find('a.inv_name');
		var items2 = $('#inventory').find('a.inv_name');
		$(items1).each(function(){ if($.inArray($(this).text(), inv_names1)<0) inv_names1.push($(this).text()); });
		$('#inp1FilterName').autocomplete({ lookup:inv_names1, onSelect: invFilterByName1 });
		$(items2).each(function(){ if($.inArray($(this).text(), inv_names2)<0) inv_names2.push($(this).text()); });
		$('#inp2FilterName').autocomplete({ lookup:inv_names2, onSelect: invFilterByName2 });
	}
	
	function invFilterByName1(){
		$.cookie('invFilterByName1', ''); 
		var val = $('#inp1FilterName').val();
		if (val == '') $('#chest').find("a.inv_name").parents('.item').stop().show();
		else {
			$.cookie('invFilterByName1', val);
			$('#chest').find("a.inv_name:not(:contains('" + val + "'))").parents('.item').stop().css('background-color', '').hide();
			$('#chest').find("a.inv_name:contains('" + val + "')").parents('.item').stop().show(); 
		}
	}
	
	function invFilterByName2(){
		$.cookie('invFilterByName2', ''); 
		var val = $('#inp2FilterName').val();
		if (val == '') $('#inventory').find("a.inv_name").parents('.item').stop().show();
		else {
			$.cookie('invFilterByName2', val);
			$('#inventory').find("a.inv_name:not(:contains('" + val + "'))").parents('.item').stop().css('background-color', '').hide();
			$('#inventory').find("a.inv_name:contains('" + val + "')").parents('.item').stop().show(); 
		}
	}
	
	UpdateItemList(); // �������� ���������.
	invFilterByName1Timer=null;
	invFilterByName2Timer=null;
	
	// ������������� ���������
	$('#line_filter1').submit(function (){ $('#inp1FilterName_submit').trigger('click'); });
	$('#line_filter2').submit(function (){ $('#inp2FilterName_submit').trigger('click'); });
	
	// ���� � ���������� ������ ��������� ������� ��� ������ ������ Up � Down, ������������� ������������� ���������.
	$('#inp1FilterName').keyup(function (e){ $('#inp1FilterName_submit').trigger('click'); });
	$('#inp2FilterName').keyup(function (e){ $('#inp2FilterName_submit').trigger('click'); });
	
	// ���������� ������� ����� �������� � ���������� ��� ��� �������� ���������\�������
	if ($.cookie('invFilterByName1')) { $('#inp1FilterName').val($.cookie('invFilterByName1')); invFilterByName1(); }
	if ($.cookie('invFilterByName2')) { $('#inp2FilterName').val($.cookie('invFilterByName2')); invFilterByName2(); }
	
	// �������������� � �������� ������� ��� ��������� ������.
	$('#line_filter1').click(function (){ window.clearInterval(invFilterByName1Timer); if($('#inp1FilterName').val()=='')invFilterByName1(); else invFilterByName1Timer=setTimeout(invFilterByName1, 200); return false;} );
	$('#line_filter2').click(function (){ window.clearInterval(invFilterByName2Timer); if($('#inp2FilterName').val()=='')invFilterByName2(); else invFilterByName2Timer=setTimeout(invFilterByName2, 200); return false;} );
	
	//$(document).keyup(function (e) {if (e.which == 13)invFilterByName1(); if (e.which == 27) { $('#textSearch').click(); } });

	$(document).on('click', '.obj_take', function(){
		var id = $(this).attr('rel');
		var room = $(this).attr('data-room');
		$(this).attr('class','obj_add');
		var rnd = $(this).attr('data-code');
		obj_take(id, room, rnd, $(this));
	});
	$(document).on('click', '.obj_add', function(){
		var id = $(this).attr('rel');
		var room = $(this).attr('data-room');
		var rnd = $(this).attr('data-code');
		obj_add(id, room, rnd, $(this));
	});
	
	function inventoryHeight() {
		var height = $('#contentBox').height();
		var heW = $(window).height(); 
		heW = heW-146; // 1060
		height = height-175; // 462
		var heMax = $(".scrollStyle").children('table').height(); 
		if (heMax > height) {
			if (heW <100) { heW = 100; }
			if (heW > height) {
				$(".scrollStyle").height(heW);	
			} else {
				$(".scrollStyle").height(height);
			}
		} else {
			$(".scrollStyle").height(heW);
		}
	//	console.log(heW+':heW, '+height+':height, '+heMax+':heMax');
	}
	$(window).ready(function(){
		inventoryHeight();
	});
	$(window).resize(function(){
		inventoryHeight();
	});
});
jQuery.expr[":"].contains = function (elem, i, match, array){ return (elem.textContent || elem.innerText || jQuery.text(elem) || "").toLowerCase().indexOf(match[3].toLowerCase()) >= 0; }
<? } ?>
var sd4 = "<?=$u->info['id'];?>";
</script>
<script type="text/javascript" language="javascript" src='http://img.likebk.com/js/commoninf.js'></script>
<script language="JavaScript" src="http://img.likebk.com/js/sl2.27.js"></script>
  <style>
    #prompt-form {
      display: inline-block;
      padding: 10px;
      width: 400px;
      border: 1px solid black;
      background: white;
      vertical-align: middle;
    }

    #prompt-form-container {
      position: fixed;
      top: 0;
      left: 0;
      z-index: 9999;
      width: 100%;
      height: 100%;
      text-align: center;
    }

    #prompt-form-container:before {
      display: inline-block;
      height: 100%;
      content: '';
      vertical-align: middle;
    }

    #prompt-form input[name="text"] {
      display: block;
      width: 90%;
	  margin: 10px auto;
      padding: 5px;
    }
  </style>
<div id="hint4 class=ahint"></div>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td align="left" valign="top">
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
				<?='<tr><td style="border-bottom:1px solid #a5a5a5; padding:2px 0px 2px 5px;" id="errorMsg">'.($err!='' ? $err : ($u->error!='' ? $u->error : '&nbsp;')).'</td></tr>';?>
				<tr>
					<td>
						<table bgcolor="#c8c8c8" width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td width="52%" style="border-left:1px solid #a5a5a5; border-bottom:1px solid #a5a5a5; padding:2px 0px 2px 5px;" align="left">
									<?php echo $u->microLogin($u->info['id'], 1)?>
								</td>
								<td style="<?=($result['additional'] == '' ? 'border-bottom:1px solid #a5a5a5;' : '')?>" align='center'><?=($result['additional'] !='' ? $result['additional'] : '')?></td>
								<td style="border-right:1px solid #a5a5a5; border-bottom:1px solid #a5a5a5; padding: 2px 15px 2px 0px;" align='right'>
									<h4 style="margin:0px;"><?= $u->room['name'];?></h4></td>
							</tr>
							<tr><td colspan="3" style="border:1px solid #a5a5a5; border-top:0px; padding:0px;" bgcolor="#e2e0e0"><?=$result['filter']?></td></tr>
						</table>
					</td>
				</tr>
				<tr><td style="border:1px solid #a5a5a5; border-top:0px; overflow:hidden; position:relative;" id="contentBox" bgcolor="#e2e0e0"><?=$result['content']?></td></tr>
			</table>
		</td>
		<td  width="280" align="right" valign="top">
			<?
			echo '<div style="padding-bottom:10px;">'.$goLis.'<table  border="0" cellpadding="0" cellspacing="1">';
			$roomGo = explode(',', $u->room['roomGo']);
			foreach($roomGo as $val) {
				$temp = $u->roomInfo($val, true);
				if( isset($temp['id']) ){ // ����������� �� ��������.
					echo '<tr><td bgcolor="#D3D3D3"><img src="http://img.likebk.com/i/move/links.gif" width="9" height="7" /></td>
					<td bgcolor="#D3D3D3" style="min-width:84px;" nowrap>'.'
					<a href="#" title="'.$temp['name'].'" id="greyText" class="menutop" onClick="';
					echo  "location='main.php?loc=".$temp['code']."&rnd=".$code.";'";
					echo '">'.$temp['name'].'</a></td></tr>';
				}
			}
			echo '</table></div>'; 
			if($u->info['room']=="214") { // ����
				echo '<p><B>������</B><br/>';
				if(isset($hostel) && $hostel_option[$hostel['type']]['t_name']){
					echo "�".$hostel_option[$hostel['type']]['t_name']."� ".$hostel_option[$hostel['type']]['stage'].".<br/><br/>";
				}
				 echo '<small>
      				<b>������: </b><b style="color: #339900">'.$u->info['money'].' ��.</b><br>
      				<b>�����������: </b><b style="color: #339900">'.$u->bank['money2'].' e��.</b><br>
      				</small>';
				// echo '</p><p>������: '.$u->info['money'].' ��.</p>';
			} else { // ����������� �� ������ ������
				if($hostel_option[$hostel['type']]['type'] != false) {
					echo '<div class="menuList" >';
					foreach ($hostel_option[$hostel['type']]['partition'] as $key=>$val){
						if($hostel['partition']!=$key){
							echo"<a class='menuItem' href='?room=".$key."&0.".$code."'><strong>".$val."</strong></a>";
						}else{
							echo"<B class='menuActive'>".$val."</B>";
						}
					}
					echo '</div>';
				}
			}
			?>
		</td>
	</tr>
</table>
<script type="text/javascript">
    // �������� �������������� DIV, ���������� ��� �������� 
    // (� ����� ����� �� � ���, � ����� � ���, ����� �� ��������������) 
    function showCover() {
      var coverDiv = document.createElement('div');
      coverDiv.id = 'cover-div';
      document.body.appendChild(coverDiv);
    }

    function hideCover() {
      document.body.removeChild(document.getElementById('cover-div'));
    }

    function showPrompt(text, callback) {
      showCover();
      var form = document.getElementById('prompt-form');
      var container = document.getElementById('prompt-form-container');
      document.getElementById('prompt-message').innerHTML = text;
      form.elements.text.value = '';

      function complete(value) {
        hideCover();
        container.style.display = 'none';
        document.onkeydown = null;
        callback(value);
      }

      form.onsubmit = function() {
        var value = form.elements.text.value;
        if (value == '') return false; // ������������ ������ submit

        complete(value);
        return false;
      };

      form.elements.cancel.onclick = function() {
        complete(null);
      };

      document.onkeydown = function(e) {
        if (e.keyCode == 27) { // escape
          complete(null);
        }
      };

      var lastElem = form.elements[form.elements.length - 1];
      var firstElem = form.elements[0];

      lastElem.onkeydown = function(e) {
        if (e.keyCode == 9 && !e.shiftKey) {
          firstElem.focus();
          return false;
        }
      };

      firstElem.onkeydown = function(e) {
        if (e.keyCode == 9 && e.shiftKey) {
          lastElem.focus();
          return false;
        }
      };


      container.style.display = 'block';
      form.elements.text.focus();
    }

    document.getElementById('button_payarenda').onclick = function() {
      showPrompt("������� �������� ����� �� ������?", function(value) {
      	if(value != null){
        	location.href="main.php?payarenda="+value;
        }
      });
    };
</script>