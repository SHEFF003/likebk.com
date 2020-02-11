<?php

	header('Content-Type: text/html; charset=windows-1251');	
	define('GAME',true);
	include('_incl_data/__config.php');	
	include('_incl_data/class/__db_connect.php');
	
	/*$doc = new DOMDocument();
	$doc->loadHTMLFile("http://legbk.com/exp"); // путь к вашему файлу
	$table = $doc->getElementsByTagName('table');
	//$table = $doc->getElementById('exp');
	$data = array();
	$i = 0;
	foreach($table->item(0)->getElementsByTagName('tr') as $tr){
	    foreach($tr->getElementsByTagName('td') as $td){
	        $data[$i][] = htmlentities(utf8_decode($td->nodeValue), ENT_QUOTES, 'UTF-8');
	    }
	    $i++;
	}

	$j = 0;
	$coun = 1;
	for ($i=10; $i < count($data); $i++) { 
		//echo end($data[$i])."<br>";
		$exp = str_replace(" ","",end($data[$i]));
		$money = str_replace(" ","",$data[$i][count($data[$i]) - 3]);
		$app = str_replace(" ","",$data[$i][1]);
		$stat = str_replace(" ","",$data[$i][2]);
		$stat2 = str_replace(" ","",$data[$i][1]);
		$master = str_replace(" ","",$data[$i][count($data[$i]) - 6]);
		$vinos = str_replace(" ","",$data[$i][count($data[$i]) - 5]);
		if($app == 0 && $app != ''){
			if($i!=10){
				$j++;
			}
			$app2 = $app +$j;
		}
		else{
			$app2 = $j;
			
		}
		if($stat2 == 0){
			$stat2 = $stat;
		}
		else{
			$stat2 = $stat2;
		}
		//if($app == 0 && $app != ''){
		//echo $vinos."<br>";
	//}
		//echo $coun.")".$vinos." = ".$stat2." : ".$app." - ".$app2." = ".$exp." - ".$money."<br>";
		$coun++;
		//echo $app." = ".$exp." - ".$money."<br>";

		// if($exp != ''){
		// //('INSERT INTO `levels` (`nextLevel`,`exp`,`money`,`money_bonus1`,`money_bonus2`,`ability`,`skills`,`nskills`,`sskills`,`expBtlMax`,`hpRegen`,`mpRegen`,`money2`) VALUES ("0", "'.$test .'", "", "", "", "", "", "","", "", "", "", "")');
		// 	 mysql_query('INSERT INTO `levels` (`exp`) VALUES ("'.$exp .'")');
		// 	 $id_l = mysql_insert_id();
		// 	 mysql_query('UPDATE `levels` SET 
		// 	 	`money` = "'.$money.'", 
		// 	 	`nextLevel` = "'.$app2.'", 
		// 	 	`ability` = "'.$stat2.'", 
		// 	 	`skills` = "'.$master.'",
		// 	 	`vinosl` = "'.$vinos.'"  WHERE `upLevel` = "'.$id_l.'"');
		// }
	}*/
	/*$sp = mysql_query( 'SELECT * FROM `levels` ');
	while ($rec = mysql_fetch_array($sp)) {

	}*/
	$telvl2 = mysql_fetch_array(mysql_query('SELECT * FROM `levels` LIMIT 1000'));	
	//var_dump($telvl2);
	$echo = '';
	$cnfg = array(
		'lvl' => 0
	);
	$sp = mysql_query( 'SELECT * FROM `levels` ORDER BY `upLevel` ASC' );
	$ma = 0;
	$sa = 15;
	$vinos = array(
		0,
		1,
		1,
		1,
		1,
		1,
		1,
		1,
		1,
		2,
		3,
		5,
		30
	);
	$echo .= "<tbody>";
	while( $pl = mysql_fetch_array( $sp ) ) {
		/*if( $cnfg['lvl'] != $pl['nextLevel'] ) {
			$echo .= '<hr>';
			$cnfg['lvl'] = $pl['nextLevel'];
		}else{
			$echo .= '<br>';
		}
		$echo .= '[' . $pl['nextLevel'] . '] - ' . $pl['exp'] . '';
		$echo .= ','.$pl['upLevel'].' => '.$pl['exp'].'';*/
		if( $pl['skills'] > 0 ) {
			$pl['skills'] = '+'.$pl['skills'];
		}else{
			$pl['skills'] = '';
		}
		if($pl['upLevel'] != 1){
			$sa += $pl['ability'];
		}
		$sa = $sa+$pl['vinosl'];
		$ma += $pl['money'];
		$stl = '';
		$vi = '';
		if( $pl['vinosl'] > 0 ) {
			$vi = '+'.$pl['vinosl'];
		}
		if( $cnfg['lvl'] != $pl['nextLevel'] || $pl['upLevel'] == 0 ) {
			$stl = ' style="font-weight: bold; background-color:#F4E7CC"';
			$cnfg['lvl'] = $pl['nextLevel'];
			//if( $vinos[$pl['nextLevel']] > 0 ) {
				
			//}
		}
		if($pl['upLevel'] == 1){
			//$pl['ability'] = 3;
		}
		else{
			$pl['ability'] = $pl['ability'];
		}
		if($pl['money'] == 0){
			$mone = '';
		}
		else{
			$mone = '+'.$pl['money'].' кр.';
		}
		if($pl['ability'] == 0 || $pl['ability'] == ''){
			$abil = '';
		}
		else{
			$abil = '+'.$pl['ability'].' ('.$sa.')';
		}
		$echo .= ' <tr'.$stl.'>
    <td align="center" valign="middle">'.$pl['nextLevel'].'</td>
    
    <td align="center" valign="middle">'.$abil.'</td>
	<td align="center" valign="middle">'.$vi.'</td>	
    <td align="center" valign="middle">'.$pl['skills'].'</td>	
    <td align="center" valign="middle">'.$mone.'</td>
    <td align="center" valign="middle">'.number_format($pl['exp'],0,'',' ').'</td>
  </tr>';
	}
	$echo .= '</tbody>';
	
?>
<script type="text/javascript" src="scripts/jquery.js"></script>
<link rel="stylesheet" href="styles/styles.css" type="text/css"/>
<title>LikeBK.com - таблица опыта</title>
<style type="text/css">

</style>
<div class="cont">
	<center>
		<div class="rgfrm">
		<table id="tbl" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td height="62"><table width="100%" height="62" border="0" cellpadding="0" cellspacing="0">
		      <tr>
		        <td width="129" class="psi_tlimg">&nbsp;</td>
		        <td align="center" class="psi_tline">
		        	<div class="psi_fix">
		<!--           	  <div class="psi_logo">&nbsp;</div> -->
		            </div>
		        </td>
		        <td width="129" class="psi_trimg">&nbsp;</td>
		      </tr>
		      </table></td>
		    </tr>
		  <tr>
		    <td>
		    <table class="psi_mainin" width="100%" border="0" cellspacing="0" cellpadding="0">
		      <tr>
		        <td width="23" class="psi_mleft">&nbsp;</td>
		        <td valign="top"  class="psi_main_reg">
		        			<h3>Таблица опыта</h3>
		        <!-- main -->
		        <center>
			        <?php 
						echo '<table id="op_tbl" width="95%" border="1" cellspacing="0" cellpadding="0">
							<thead>
							<tr>
								<td rowspan="2" align="center" valign="middle">Ап/Ур.</td>
								<td colspan="4" align="center" valign="middle">Увеличение</td>
								<td rowspan="2" align="center" valign="middle">Опыт</td>
							</tr>
							<tr>
								
								<td align="center" valign="middle">Cтатов (Всего)</td>
								<td align="center" valign="middle">Выносливость</td>
								<td align="center" valign="middle">Мастерство</td>
								<td align="center" valign="middle">Кредиты</td>
								
							</tr>
							</thead>
						'.$echo.'
						</table>';
						unset( $echo, $cnfg );
			        ?>
		    	</center>
				<!-- main -->	
		        </td>
		        <td width="23" class="psi_mright">&nbsp;</td>
		      </tr>
		      </table>
		    </td>
		    </tr>
		  <tr>
		    <td height="62"><table width="100%" height="62" border="0" cellpadding="0" cellspacing="0">
		      <tr>
		        <td width="129" class="psi_dlimg">&nbsp;</td>
		        <td class="psi_dline">&nbsp;</td>
		        <td width="129" class="psi_drimg">&nbsp;</td>
		      </tr>
		    </table></td>
		    </tr>
		</table>
		</div>
	<!-- test window -->
	</center>
</div>