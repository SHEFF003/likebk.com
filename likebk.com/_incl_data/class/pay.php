<?php
class GameDealerClass {
	//������������
	public $c = array(
		/* MySQL ���� ������ */
			'db_name'		=>	'pay_operations', //������� � ������� ��������� ������
			'db_host'		=>	'localhost',
			'db_user'		=>	'bk2connect',
			'db_pass'		=>	'6OE7LHS1',
			'db_base'		=>	'bk2d12base',
		/* ��������� �������� */
			'ip_list'		=>	array('213.133.99.53'), //��������� ����� ������� (����������� IP)
			'key'			=>	'2c03e2f961fdc111a1b0e35f63e00453', //gamedealer key 2c03e2f961fdc111a1b0e35f63e00453 HjLyfzBGfhjkM01
			'id'			=>	'20101' //ID �������
	),
	$ip = '',
	$BACK = array(); //��������� ������� ���������� � �����
	
	//�������� �� ���-8 � ��������
	public function in($text) {
		return iconv("UTF-8","cp1251",$text);
	}
	
	//�������� �� �������� � ���-8
	public function out($text) {
		return iconv("cp1251","UTF-8",$text);
	}
	
	//��������� ������ � ���� ������
	public function add($type,$value,$money) {
		mysql_query('INSERT INTO `'.$this->c['db_name'].'` (`time`,`type`,`ip`,`value`,`money`,`project`) VALUES ("'.time().'","'.mysql_real_escape_string($type).'","'.$_SERVER['HTTP_X_REAL_IP'].'","'.mysql_real_escape_string($value).'","'.mysql_real_escape_string($money).'","'.mysql_real_escape_string($this->id).'")');
	}
	
	//������������ � ���� ������
	public function connect_db() {
		$db = mysql_connect($this->c['db_host'],$this->c['db_user'],$this->c['db_pass']) or die('������ ����������� � MySQL �������!');
		mysql_select_db($this->c['db_base'],$db) or die('������ ����������� � ���� ������!');
		mysql_query('SET NAMES cp1251');
	}
	
	public function output($a,$v = NULL) {
		$r = '';		
		$i = 0;
		while($i < count($a)) {
			$rn = '';
			$tb = '';
			if($v != NULL) {
				$rn = "\r\n";
				$tb = "	";
			}
			$r .= $rn.'<'.$a[$i][0].'>';
			if(!is_array($a[$i][1])) {
				$rn = '';
				$tb = '';
				$r .= $rn.$tb.($this->out($a[$i][1]));
			}else{
				if($i > 0) {
					$r .= $rn;
				}
				$r .= $tb.($this->output($a[$i][1],1));
			}
			$r .= $rn.'</'.$a[$i][0].'>';
			$i++;
		}
		return $r;
	}
	
	//���������� XML-����
	public function backInformation() {
		header('Content-Type: text/html/force-download');
		echo '<?xml version="1.0" encoding="UTF-8"?>';
		echo $this->output($this->BACK,1);
	}
	
	//�������� ������������� ���������
	public function test_accaunt($nick) {
		$r = false;
		$nick = mysql_fetch_array(mysql_query('SELECT `id` FROM `bank` WHERE `id` = "'.mysql_real_escape_string($nick).'" LIMIT 1'));
		if(isset($nick['id'])) {
			$r = true;
		}
		return $r;
	}
	
	//�������� ���� � ����� �� ������
	public function getBank($nick) {
		$nick = mysql_fetch_array(mysql_query('SELECT `id` FROM `users` WHERE `login` = "'.mysql_real_escape_string($nick).'" LIMIT 1'));
		$nick = mysql_fetch_array(mysql_query('SELECT `id` FROM `bank` WHERE `uid` = "'.mysql_real_escape_string($nick['id']).'" LIMIT 1'));
		return $nick['id'];
	}
	
	//����� ������
	public function bank_user($nick) {
		$nick = mysql_fetch_array(mysql_query('SELECT `id`,`uid FROM `bank` WHERE `id` = "'.mysql_real_escape_string($nick).'" LIMIT 1'));
		$nick = mysql_fetch_array(mysql_query('SELECT `id`,`login` FROM `users` WHERE `login` = "'.mysql_real_escape_string($nick['uid']).'" LIMIT 1'));
		return $nick['login'];
	}
	
	//�������� ��������� ��������
	public function start_session() {
		
		$this->ip = $_SERVER['HTTP_X_REAL_IP'];		
		
		//������������ � ��
		$this->connect_db();
		
		//�������� ������ �������
		//$xml = file_get_contents('php://input');		
		
		//������� XML �������
		if(function_exists('simplexml_load_string')) {
			$xml = simplexml_load_string($xml);
		}else{			
			$this->BACK = array(array('gdanswer',array(array('status','-1'),array('desc','�� ������� ���������� ��������� �������'))));
			die($this->backInformation());
		}
		
		$this->id = $xml->projectid;
		
		if(!in_array($this->ip,$this->c['ip_list'])) {
			$this->BACK = array(array('gdanswer',array(array('status','-1'),array('desc','��� ������� � ������� IP'))));
			die($this->backInformation());
		}		
		
		//��������� ��������
		if($xml->method == 'check_balance') {
			//<sign>MD5(method+MD5(gdKey))</sign>
			
			$sign = md5($xml->method.md5($this->c['key']));
			
			if($sign == $xml->sign) {
				//������ ������
				$balance = 1000000;
				$this->BACK = array(array('gdanswer',array(array('status','1'),array('desc','������ ������: '.$balance),array('balance',$balance))));
				$this->add('4','check:'.$xml->nick.':1'.$r,0);
			}
			
		}elseif($xml->method	== 'check') {
			/*
			nick - ����� ���������	<sign>MD5(nick+method+MD5(gdKey))</sign>	*/
			
			$sign = md5($xml->nick.$xml->method.md5($this->c['key']));
			
			if($sign == $xml->sign) {
				$xml->nick = $this->in($xml->nick);
				if($this->test_accaunt($xml->nick) == true) {
					//�������� ������ � ��������� ��� ������� ������
					$this->BACK = array(array('gdanswer',array(array('status','1'),array('desc','���������� ���� ������'))));
					$this->add('3','check:'.$xml->nick.':1'.$r,0);
				}else{
					//�������� �� ������
					$this->BACK = array(array('gdanswer',array(array('status','-1'),array('desc','������ �� ���������. ���������� ���� �� ������.'))));
					$this->add('-1','�������� �� ������:pay:'.$xml->nick.':0',0);
				}
			}
		}elseif($xml->method == 'pay') {
			/* �������� ������ 
			nick - ����� �������� , projectid - id ������� , sign , amount - ������ , payid - id �������	*/
			
			$sign = md5($xml->nick.$xml->projectid.$xml->amount.$xml->payid.$xml->method.md5($this->c['key']));
			
			if($sign == $xml->sign) {
				$xml->nick = $this->in($xml->nick);
				if($this->test_accaunt($xml->nick) == true) {
					//�������� ������ � ��������� ��� ������� ������
					$bank = $this->test_accaunt($xml->nick);
					if($bank > 0) {
						mysql_query('UPDATE `bank` SET `money2` = `money2` + '.mysql_real_escape_string($xml->amount).' WHERE `id` = "'.mysql_real_escape_string($xml->nick).'" LIMIT 1');
						$this->BACK = array(array('gdanswer',array(array('status','1'),array('desc','������ ������ �������'),array('id',$this->c['id']))));
						$this->add('2','pay:'.$xml->nick.':'.$xml->projectid.':'.$xml->sign.':'.$xml->amount.':'.$xml->payid.':'.$bank['id'],$xml->amount);
						
						$user = mysql_fetch_array(mysql_query('SELECT `id`,`uid` FROM `bank` WHERE `id` = "'.mysql_real_escape_string($xml->nick).'" LIMIT 1'));
						$user = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`city`,`sex`,`room` FROM `users` WHERE `id` = "'.mysql_real_escape_string($user['uid']).'" LIMIT 1'));
						
						mysql_query('UPDATE `users` SET `catch` = `catch` + '.mysql_real_escape_string(floor($xml->amount)).' WHERE `id` = "'.mysql_real_escape_string($xml->nick).'" LIMIT 1');
						
						$r = '<span class=date>'.date('d.m.Y H:i').'</span> ������� <img src=http://img.likebk.com/i/align/align50.gif width=12 height=15 /><u><b>Enchanter</b> / �������������� ������</u> ��������: ';
						
						if($user['sex'] == 1) {
							$r .= '���������';
						}else{
							$r .= '���������';
						}
						
						$r .= ' <b>'.$user['login'].'</b>, �� ��� ���������� ���� �'.$bank.' ��������� '.$xml->amount.' Ekr. ���������� ��� �� �������!';
						
						mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$user['city']."','".$user['room']."','','".$user['login']."','".$r."','-1','5','0')");
						
					}else{
						$this->BACK = array(array('gdanswer',array(array('status','-1'),array('desc','� ������������ ����������� ����'),array('id',$this->c['id']))));
						$this->add('-1','� ��������� ����������� ����:pay:'.$xml->nick.':'.$xml->projectid.':'.$xml->sign.':'.$xml->amount.':'.$xml->payid.':'.$bank['id'],$xml->amount);
					}
				}else{
					//�������� �� ������
					$this->BACK = array(array('gdanswer',array(array('status','-1'),array('desc','������ �� ���������. �������� �� ������.'))));
					$this->add('-1','�������� �� ������:pay:'.$xml->nick.':0',0);
				}	
			}else{
				//������ ���������
				$this->BACK = array(array('gdanswer',array(array('status','-1'),array('desc','������ ���������'))));
				$this->add('-1','������ ���������:pay:'.$xml->nick.':0',0);
			}
		}elseif($xml->method == 'check_login') {
			/* �������� ��������
			nick - ����� �������� , projectid - id ������� , sign	*/
			$sign = md5($xml->nick.$xml->method.md5($this->c['key']));
			
			if($sign == $xml->sign) {
				$xml->nick = $this->in($xml->nick);
				if($this->test_accaunt($xml->nick) == true) {
					//�������� ������
					$this->BACK = array(array('gdanswer',array(array('status','1'),array('desc','���� ������'),array('addinfo',$this->bank_user($xml->nick)))));
					$this->add('1','check_login:'.$xml->nick.':1'.$r,0);
				}else{
					//�������� �� ������
					$this->BACK = array(array('gdanswer',array(array('status','-1'),array('desc','���� �� ������'))));
					$this->add('-1','�������� �� ������:check_login:'.$xml->nick.':0',0);
				}
			}else{
				//������ ���������
				$this->BACK = array(array('gdanswer',array(array('status','-1'),array('desc','������ ���������'))));
				$this->add('-1','������ ���������:pay:'.$xml->nick.':0',0);
			}
		}else{
			$this->BACK = array(array('gdanswer',array(array('status','-1'),array('desc','����������� ��� �������'))));
			$this->add('-1','����������� ��� �������:error_method:gamedealer',0);
		}
		
		//������� ����������
		/* ������ ���������� �������
			$this->BACK = array(
				array('gdanswer',array(array('status',-100),array('desc','�������� �������')))
			);
		*/
		
		//���������� ���������
		$this->backInformation();
	}
}

$pay = new GameDealerClass;
$pay->start_session();
?>