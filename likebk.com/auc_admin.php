<?php
/*

	���� ��� ��������� ������.
	��������� ���������, ��������� ������, ��������� �����, ��������� �����, ��������� ��������, ��������� ��������� ���������

*/

define('GAME',true);

include('_incl_data/__config.php');
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');
include('_incl_data/class/bot.logic.php');


if( $u->info['admin'] > 0 ) {
	$html = '';
	$sp = mysql_query('SELECT `id`,`name`,`img` FROM `items_main`');
	while( $pl = mysql_fetch_array($sp) ) {
		$itm_b = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_auc_ban` WHERE `item_id` = "'.$pl['id'].'" LIMIT 1'));
		
		if(isset($_GET['block']) && $_GET['block'] == $pl['id']) {
			if(isset($itm_b['id'])) {
				mysql_query('DELETE FROM `items_auc_ban` WHERE `item_id` = "'.$pl['id'].'"');
			}else{
				$itm_b['id'] = true;
				mysql_query('INSERT INTO `items_auc_ban` (`item_id`,`val`) VALUES ("'.$pl['id'].'","1")');
			}
		}
		
		if(isset($itm_b['id'])) {
			//�������
			$html .= '<div style="background-color:red">';
		}	
		$html .= '<img src="http://img.likebk.com/i/items/'.$pl['img'].'" height="20"> &nbsp; #'.$pl['id'].' &nbsp; <b>'.$pl['name'].'</b> &nbsp; ';
		if(isset($itm_b['id'])) {
			//�������
			$html .= ' &nbsp; <a href="/auc_admin.php?block='.$pl['id'].'">��������������</a>';
		}else{
			//�� �������
			$html .= ' &nbsp; <a href="/auc_admin.php?block='.$pl['id'].'">�������������</a>';
		}
		if(isset($itm_b['id'])) {
			//�������
			$html .= '</div>';
		}
		$html .= '<hr>';
	}
	echo $html;
}
?>