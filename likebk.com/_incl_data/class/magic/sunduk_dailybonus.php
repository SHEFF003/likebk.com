<?php 
if(!defined('GAME'))
{
	die();
}
if($tr['var_id'] == 1) {
	//������ ������ �� �����
	$re = $this->addItem(5122, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//��� 0.1���
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	if($io == '') {
		$io = '������ ������ �� ����� + ��� �� 0.1 ���.';	
	}
}elseif($tr['var_id'] == 2) {
	//������ ������ �� ������
	$re = $this->addItem(1001, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//��� 0.1���
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//��� 0.1���
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	if($io == '') {
		$io = '������ ������ �� ����� + ��� �� 0.1 ���.(2��)';	
	}
}
elseif($tr['var_id'] == 3) {
	//����� ����� +5
	$re = $this->addItem(3102, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//��� 0.1���
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//��� 0.1���
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//��� 0.1���
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	if($io == '') {
		$io = '����� ����� +5 + ��� �� 0.1 ���.(3��)';	
	}
}
elseif($tr['var_id'] == 4) {
	//������ ������������
	$re = $this->addItem(2139, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//��� 0.1���
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//��� 0.1���
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//��� 0.1���
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//��� 0.1���
	$re = $this->addItem(5092, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	if($io == '') {
		$io = '������ ������������ + ��� �� 0.1 ���.(4��)';	
	}
}
elseif($tr['var_id'] == 5) {
	//������ ���������
	$re = $this->addItem(2140, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//��� 0.5���
	$re = $this->addItem(5094, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	if($io == '') {
		$io = '������ ��������� + ��� �� 0.5 ���.(1��)';	
	}
}
elseif($tr['var_id'] == 6) {
	//��������� �� �������
	$re = $this->addItem(5106, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//��� 0.2���
	$re = $this->addItem(5093, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//��� 0.2���
	$re = $this->addItem(5093, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	//��� 0.2���
	$re = $this->addItem(5093, $this->info['id'],'|sudba='.$this->info['login'].'|nosale=1',NULL,0);
	if( $re > 0 ) {
		mysql_query('UPDATE `items_users` SET `gift` = "�������������" WHERE `id` = "'.$re.'" LIMIT 1');
	}
	if($io == '') {
		$io = '��������� -The Best Friend + ��� �� 0.2 ���.(3��)';	
	}
}
?>