<?
if($_COOKIE['login'] == '���������� �����' ) {
	error_reporting (1);
	ini_set('display_errors','On');
    setlocale(LC_CTYPE ,"ru_RU.CP1251");
}else{
	error_reporting (1);
	ini_set('display_errors','Off');
    setlocale(LC_CTYPE ,"ru_RU.CP1251");
}

$c = array();
/* ������������ ���� */

$c['title']  = '����������� ���� - ����������, ����������� ���������� ������ ����'; //�������� ����
$c['title2'] = ' - ����������, ����������� ������ ���� ����������� ��������� � �����!';
$c['title3']  = '���������� ����';
$c['name']   =  '���������� ����';
$c['keys']   = 'bk2,��2,2-bk,combatz, ����, ������, �������, ������,online, ��������, internet, RPG, fantasy, �������, ���, �����, �����, �����, ����, ����, �����, ������, ���, �����, �����, ��������, �����������, ����������� ����������, ������, ���, ����������, ���, ������, �����, ����, ����, games, ����, ����, �������, ����'; //�������� ����� META
$c['desc']   = '�������� RPG ������ ���� ����������� ���� � �����. ������ ������, �������� �������, ��� ����, ����� ���� ����� ������ � �����.'; //�������� META

//�������
$c['host']        = 'likebk.com';
$c['forum']       = 'forum.'.$c['host'];
$c['img']   	  = 'img.likebk.com';
$c['thiscity']    = 'capitalcity';
$c['capitalcity'] = $c['host'];
$c['abandonedplain'] = $c['host'];
$c['exit']		  = '<script>top.location="http://'.$c['host'].'/";</script><noscript><meta http-equiv="refresh" content="0; URL=http://'.$c['host'].'/"></noscript>';

//������
$c['shop_type1'] = 100; //� ���
$c['shop_type2'] = 100; //� �������
$c['ekrbonus']	 = 0; // ����� � % � ������� ���
$c['ekr2bonus']	 = 0; // ����� � % � ������� ���� ���
$c['exp2cp']     = 100; //��������� ����� +100% �� ��

//����������� ������ �2 ���� ������ , �2 ������ ������ , ���������� ������ , ���������� ���������� ��� � �������
$c['holiday'] = false;
if( date('m') > 1 ) {
//	$c['holiday'] = false;
}

$c['prcshp'] = 0.9; //����� � ��� , �������� 0.90
if( $c['prcshp'] > 1 ) { $c['prcshp'] = 1; }
if( $c['prcshp'] < 0.01 ) { $c['prcshp'] = 0.01; }

//��������� ��������� ������ � �����
$c['haotsanich'] = false;

//����
//$code = explode(' ',microtime());
//$code = $code[0].''.round($code[1]/rand(1,5));
$code = '1';
$c['counters']  = '';

$c['copyright'] = 'Copyright � '.date('Y').' ����������� ����';

$c['counters_noFrm']  = $c['counters'];

$c['level_ransfer'] = 4;
$c['znahar'] = 1;
?>