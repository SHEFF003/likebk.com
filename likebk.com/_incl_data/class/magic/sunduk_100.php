<?
if(!defined('GAME'))
{
	die();
}	
	if($tr['var_id'] != '') {
		 
		$io = '';

		$itmlid = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$this->info['id'].'" AND `delete` = 0 ORDER BY `id` DESC LIMIT 1'));
		$itmlid = $itmlid['id'];
		
		if( (int)date('Y') < 2020 || ( (int)date('m') == 1 && (int)date('d') < 10 ) )  {
			$no_open_itm = true;		
			$this->error = '������� �������� 10 ������ 2020! ;) (������ '.date('d.m.Y').')';
			if( $this->info['admin'] > 0 ) {
				$this->error .= '(���� '.(int)date('Y').' >= 2018 � ( '.(int)date('m').' > 1 ��� '.(int)date('d').' >= 10 ))';
			}
			$this->error = '';
		}elseif($tr['var_id'] == 5) {
			/*
				���� ��� ������ + ��� �������� �� ����� + ����� ����� 6 + ������� ����� �� ��
			*/
			
			//$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3);
			
			//$this->addItem(6844,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1);
			
			//$this->addItem(6849,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3);
			
			//$this->addItem(6851,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1);
			
			//$i = array( 911 , 1172 , 1173 , 2141 );
			//$i = $i[rand(0,count($i)-1)];
			//$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,2);
						
			//$this->addItem(6813,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,30);
			//$this->addItem(6816,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,30);
			
			//if( rand(0,100) < 31 ) {
			//	$this->addItem(3196,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,100);
			//}
			
			$this->addItem(994,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3102,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5123,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5122,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1001,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1460,$this->info['id'],'|nosale=1|sudba=1');
			
			$this->addItem(6819,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2139,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2418,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			//$this->addItem(873,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(872,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(871,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(870,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5108,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4702,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1043,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5106,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(5105,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(5104,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(3044,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4037,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4038,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4039,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4040,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5109,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5110,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			//$this->addItem(1461,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(1462,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(1463,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(3101,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');			
			
			//$this->addItem(6858,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$io .= '��� �������� ��������� � ��� � ���������! ������� � ������� ������ ����� �����������, � ��� �������� ��� �������!';
			
		}elseif($tr['var_id'] == 4) {
			/*
				������� ��� 5 (5084) 0/3
				 ��������� ��������� [1�.] 0\5
				 ��������� ���������� ��������� 0\3
				����� ���������������, ������� �������� 0\1
				���� �� ������ +50 ������ �� 3 ���� 0\2
				�������������� ������� 1500HP 0\30
				�������������� ������� 1500MP  0\30
				��������� ����� ���� ������� 30%
				����� ��� � ��� ������� � ���������
				������ ���� +10% �� 7 ���� �� ����������� � ��� ��� +100 � 500 ������� �������
			*/
			
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3);
			
			$this->addItem(6844,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1);
			
			//$this->addItem(6849,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3);
			
			//$this->addItem(6851,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1);
			
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,2);
						
			$this->addItem(6813,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,30);
			$this->addItem(6816,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,30);
			
			if( rand(0,100) < 31 ) {
				$this->addItem(3196,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,100);
			}
			
			$this->addItem(994,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3102,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5123,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5122,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1001,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1460,$this->info['id'],'|nosale=1|sudba=1');
			
			$this->addItem(6819,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2139,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2418,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			//$this->addItem(873,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(872,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(871,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(870,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5108,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4702,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1043,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5106,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5105,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5104,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(3044,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4037,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4038,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4039,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4040,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5109,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5110,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1461,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1462,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1463,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');			
			
			$this->addItem(6858,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$io .= '��� �������� ��������� � ��� � ���������! ������� � ������� ������ ����� �����������, � ��� �������� ��� �������!';
			
		}elseif($tr['var_id'] == 3) {
			/*
				������� ��� 5 (5084) 0/5
				 ��������� ��������� [2�.] 0\5
				 ��������� ���������� ��������� 0\1
				����� ���������������, ������� �������� 0\2
				���� �� ������ +50 ������ �� 3 ���� 0\2
				 ���� ��� �� 3 ���� 0\1, ����� ���� 0\1
				�������������� ������� 1500HP 0\40
				�������������� ������� 1500MP  0\40
				��������� ����� ���� ������� 50%
				����� ��� � ��� ������� � ���������
				������ ���� +20% �� 7 ���� �� ����������� � ��� ��� +100 � 500 ������� �������
			*/
			
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			
			$this->addItem(6844,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			
			$this->addItem(6849,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1);
			
			//$this->addItem(6851,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,2);
			
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,2);
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,2);
			
			//$this->addItem(6853,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1); //42 eff 475
			//$this->addItem(6854,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1); //43 eff 476
			
			$this->addItem(6813,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,40);
			$this->addItem(6816,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,40);
			
			if( rand(0,100) < 51 ) {
				$this->addItem(3196,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,100);
			}
			
			$this->addItem(994,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3102,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5123,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5122,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1001,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1460,$this->info['id'],'|nosale=1|sudba=1');
			
			$this->addItem(6819,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2139,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2418,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			//$this->addItem(873,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(872,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(871,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(870,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5108,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4702,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1043,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5106,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5105,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5104,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(3044,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4037,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4038,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4039,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4040,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5109,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5110,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1461,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1462,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1463,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');			
			
			$this->addItem(6857,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$io .= '��� �������� ��������� � ��� � ���������! ������� � ������� ������ ����� �����������, � ��� �������� ��� �������!';
			
		}elseif($tr['var_id'] == 2) {
			/*
				������� ��� 5 (5084) 0/5
				 ��������� ��������� [3�.] 0\5
				 ��������� ���������� ��������� 0\3
				����� ���������������, ������� �������� 0\3
				���� �� ������ +50 ������ �� 3 ���� 0\3
				 ���� ��� �� 3 ���� 0\1, ����� ���� 0\1
				�������������� ������� 1500HP 0\50
				�������������� ������� 1500MP  0\50
				��������� ����� ���� ������� 80%
				����� ��� � ��� ������� � ���������
				������ ���� +30% �� 7 ���� �� ����������� � ��� ��� +100 � 500 ������� �������
			*/
			
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			
			$this->addItem(6845,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			
			$this->addItem(6849,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3);
			
			$this->addItem(6851,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3);
			
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3);
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			
			//$this->addItem(6853,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1); //42 eff 475
			//$this->addItem(6854,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,1); //43 eff 476
			
			$this->addItem(6813,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,50);
			$this->addItem(6816,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,50);
			
			if( rand(0,100) < 81 ) {
				$this->addItem(3196,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,100);
			}
			
			$this->addItem(994,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3102,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5123,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5122,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1001,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1460,$this->info['id'],'|nosale=1|sudba=1');
			
			$this->addItem(6819,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2139,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2418,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			//$this->addItem(873,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(872,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(871,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(870,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5108,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4702,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1043,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5106,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5105,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5104,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(3044,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4037,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4038,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4039,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4040,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5109,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5110,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1461,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1462,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1463,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');			
			
			$this->addItem(6856,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');

			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$io .= '��� �������� ��������� � ��� � ���������! ������� � ������� ������ ����� �����������, � ��� �������� ��� �������!';
			
		}elseif($tr['var_id'] == 1) {
			/*
				������� ��� 5 (5084) 0/10 
				 ��������� ��������� [5�.] 0\10,
				 ��������� ���������� ��������� 0\10				 
				����� ���������������, ������� �������� 0\10
				���� �� ������ +50 ������ �� 3 ���� 0\5
				���� ��� �� 3 ���� 0\3, ����� ���� 0\3 2143 ? 2144
				�������������� ������� 1500HP 0\100
				�������������� ������� 1500MP  0\75				
				������� ����� ���� ������� 20%				
				����� ��� � ��� ������� � ���������				
				���� +100% �� 7 ����
			*/
			
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,10);
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,10);
			$this->addItem(5084,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,10);
			
			$this->addItem(6921,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,10);
			
			$this->addItem(6849,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,10);
			
			$this->addItem(6851,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,10);
			
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			$i = array( 911 , 1172 , 1173 , 2141 );
			$i = $i[rand(0,count($i)-1)];
			$this->addItem($i,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,5);
			
			//$this->addItem(6853,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3); //42 eff 475
			//$this->addItem(6854,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,3); //43 eff 476
			
			$this->addItem(6813,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,100);
			$this->addItem(6816,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,75);
			
			//if( rand(0,100) < 81 ) {
				$this->addItem(3198,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,100);
				$this->addItem(3196,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000',NULL,100);
			//}
			
			$this->addItem(994,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3102,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5123,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5122,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1001,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1460,$this->info['id'],'|nosale=1|sudba=1');
			
			$this->addItem(6819,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2139,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(3140,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(2418,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			//$this->addItem(873,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(872,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(871,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			//$this->addItem(870,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5108,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4702,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1043,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(5106,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5105,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5104,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(3044,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4037,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4038,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4039,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4040,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5109,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(5110,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(1461,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1462,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(1463,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');			
			
			$this->addItem(6855,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4514,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(4515,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			$this->addItem(6046,$this->info['id'],'|nosale=1|sudba=1|sro5k=5184000');
			
			$io .= '��� �������� ��������� � ��� � ���������! ������� � ������� ������ ����� �����������, � ��� �������� ��� �������!';
			
		}else{
			$no_open_itm = true;		
			$this->error = '� ������� ������ ���! �������� �������������, �� ��� �������! :)';
		}
		
		if( $no_open_itm != true ) {
			$sp50 = mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$this->info['id'].'" AND `delete` = 0 AND `id` > "'.$itmlid.'"');
			while( $pl50 = mysql_fetch_array($sp50) ) {
				$itmmz = mysql_fetch_array(mysql_query('SELECT `name` FROM `items_main` WHERE `id` = "'.$pl50['item_id'].'" LIMIT 1'));
				$itmlidtxt .= ', &quot;'.$itmmz['name'].' (0/'.ceil($pl50['iznosMAX']).')&quot;';
			}
			$itmlidtxt = ltrim($itmlidtxt,', ');
			$io = '������ ���� ��������: '.$itmlidtxt;
			unset($pl50,$sp50,$itmlidtxt,$itmlid);
		}
		
	}
	unset($i5,$i3,$i4);
?>