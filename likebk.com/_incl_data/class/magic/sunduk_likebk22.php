<?php 
if(!defined('GAME'))
{
	die();
}

if($tr['var_id'] == 1) {

//��������

	//5122
	$re = $this->addItem(1105,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//5123
	$re = $this->addItem(10126,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//����� �����
	$re = $this->addItem(10127,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//����� ����
	$re = $this->addItem(10128,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//������ ������������
	$re = $this->addItem(10129,$this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}

}
?>