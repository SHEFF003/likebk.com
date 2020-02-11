<?php 
define('GAME',true);
include_once('../_incl_data/__config.php');
include_once('../_incl_data/class/__db_connect.php');
include_once('../_incl_data/class/__user.php');


function bonus_optom($a) { 
	  global $c;
      $bon = array("100", "90", "80", "70", "60", "50", "40", "30", "20", "10");
      $pro = array("10", "9", "8", "7", "6", "5", "4", "3", "2", "1");
      // $pro = array("20", "19", "18", "17", "16", "15", "14", "13", "12", "11");
      $i = 0;
      $pr = 0;
      while($i < 10){
        if($a >= $bon[$i]){
           $pr = $pro[$i];
          break;
        }
        $i++;
      }
	  $pr += $c['ekrbonus'];
      return (floor( ($a*$pr/100) *100)/100);
}
function bonus_nak($a,$id){
  $m = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$id.'"'));
  $nak = $m['moneyBuy'];
  $nak_bonus = 0;
  //alert(nak);
  $bon = array("3000", "2500", "2000", "1700", "1500", "1300", "1200", "1100", "1000", "900", "800", "700", "600", "500", "400", "300", "200", "100", "50", "10");
  $pro = array("30", "27", "25", "23", "21", "19", "17", "15", "13", "11", "10", "9", "8", "7", "6", "5", "4", "3", "2", "1");
  $i = 0;
  while($i < 20){
    if($nak >= $bon[$i]){
       $nak_bonus = $pro[$i];
      break;
    }
    $i++;
  }
  $pr = 0;
  if($nak_bonus == 0){
    $pr = 0;   
  }
  else{
    $pr = $nak_bonus;
  }
  return (floor( ($a*$pr/100) *100)/100);
}

$merchant_id = '28217';
$secret_word = 'z3saif6r';
function getIP() {
if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
   return $_SERVER['REMOTE_ADDR'];
}
if (!in_array(getIP(), array('136.243.38.147', '136.243.38.149', '136.243.38.150', '136.243.38.151', '136.243.38.189'))) {
    die("hacking attempt!");
}
$sign = md5($merchant_id.':'.$_POST['AMOUNT'].':'.$secret_word.':'.$_POST['MERCHANT_ORDER_ID']);
if ($sign != $_POST['SIGN']) {
    die('wrong sign');
}
$ins = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$_POST['MERCHANT_ORDER_ID'].'"'));
if($ins){
	$ekr = $_POST['us_count'];
	$bon_nak = bonus_nak($ekr, $ins['id']);    
	$bon_opt = bonus_optom($ekr);            
	$bon_nak = floor($bon_nak*100)/100;
	$bon_opt = floor($bon_opt*100)/100;

	$ekr = $ekr + $bon_nak + $bon_opt;

	if($ekr == 0){
		$ekr = $_POST['AMOUNT']/100;
	}
	
	$bank = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid` = "'.$ins['id'].'"'));
	if($bank){
    if($bank['moneyBuy'] == 0){
      $ekr += ($ekr*0.2);
      $ekr = floor($ekr*100)/100;
    }
		mysql_query('UPDATE `bank` SET `money2` = `money2` + '.$ekr.', `moneyBuy` = `moneyBuy` + '.$ekr.' WHERE `uid` = "'.$ins['id'].'"');
	}else{
		mysql_query('INSERT INTO `bank` SET `uid` = "'.$ins['id'].'", `pass`="passs", `money2` = '.$ekr.', `moneyBuy` = '.$ekr.'');		
	}
	$u->addDelo(777,$ins['id'],'Купил '.$ekr.' екр. за '.$_POST['AMOUNT'].' руб.',time(),  $ins['city'],'BillingPayment',$ekr,'');
  if($ins['referals'] != 0) {
      $refus = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$ins['referals'].'" LIMIT 1'));
      if(isset($refus['id'])){
        $refekr = $ekr*0.07;
        $refekr = floor($refekr*100)/100;
        $ekrref = mysql_query('UPDATE `bank` SET `money2` = `money2` + '.$refekr.', `referal_money` = `referal_money` + '.$refekr.' WHERE `uid` = "'.$refus['id'].'"');
        if($ekrref){
          $msgref = 'Ваш реферал '.$ins['login'].' пополнил счет. Вам зачислено '.$refekr.' екр.';
          mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES ('1','".$refus['city']."','".$refus['room']."','','".$refus['login']."','".$msgref."','-1','6','0')");
        }
      }
  }
}
else{
	die('Error');
}
//Так же, рекомендуется добавить проверку на сумму платежа и не была ли эта заявка уже оплачена или отменена
//Оплата прошла успешно, можно проводить операцию.
die('YES');
?>