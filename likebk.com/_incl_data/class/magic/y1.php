<?php 
if(!defined('GAME'))
{
	die();
}
if($tr['var_id'] == 1) {
	//��� �� 100 ���
	$re = $this->addItem(4512,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1|notransfer=1',NULL,0);
	if( $re > 0 ) {
		mysql_query("INSERT INTO `users_ico` (`uid`, `time`, `text`, `img`, `endTime`, `bonus`, `href`, `type`, `x`) VALUES (".$this->info['id'].", ".time().", '<b>�����</b>`2017<br>�������� ��������!', 'pasha3.png', ".(time()+365*86400).", '', '#', 1, 1);");
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}

}elseif($tr['var_id'] == 2) {
	//��� �� 35 ���
	$re = $this->addItem(8017,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1|notransfer=1',NULL,0);
	if( $re > 0 ) {
		mysql_query("INSERT INTO `users_ico` (`uid`, `time`, `text`, `img`, `endTime`, `bonus`, `href`, `type`, `x`) VALUES (".$this->info['id'].", ".time().", '<b>�����</b>`2017<br>�������� ��������!', 'pasha2.png', ".(time()+365*86400).", '', '#', 1, 1);");
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}

}elseif($tr['var_id'] == 3) {
	//��� �� 20 ���
	mysql_query("INSERT INTO `users_ico` (`uid`, `time`, `text`, `img`, `endTime`, `bonus`, `href`, `type`, `x`) VALUES (".$this->info['id'].", ".time().", '<b>�����</b>`2017<br>�������� ��������!', 'pasha1.png', ".(time()+365*86400).", '', '#', 1, 1);");
	$re = $this->addItem(8018,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1|notransfer=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}

}elseif($tr['var_id'] == 4) {
	//��� �� 1 ���
	mysql_query("INSERT INTO `users_ico` (`uid`, `time`, `text`, `img`, `endTime`, `bonus`, `href`, `type`, `x`) VALUES (".$this->info['id'].", ".time().", '<b>�����</b>`2017<br>�������� ��������!', 'pasha1.png', ".(time()+365*86400).", '', '#', 1, 1);");
	$re = $this->addItem(5095,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1|notransfer=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}

}
?>