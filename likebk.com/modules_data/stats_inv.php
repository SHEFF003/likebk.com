<?
if(!defined('GAME'))
{
	die();
}
function zago($v) {
	$r = round( (1-( pow(0.5, ($v/541.51) ) ))*100 , 2 );
	if( $r > 90 ) {
		$r = 90;
	}
	return $r;
}
$uShow = explode('|',$u->info['showmenu']);
if(isset($_GET['showmenu']))
{
	$_GET['showmenu'] = round($_GET['showmenu']);
	if($_GET['showmenu']>=1 && $_GET['showmenu']<=8)
	{
	 	if($uShow[$_GET['showmenu']-1]==0)
		{
			$uShow[$_GET['showmenu']-1] = 1;
		}else{
			$uShow[$_GET['showmenu']-1] = 0;
		}
		$u->info['showmenu'] = implode('|',$uShow);
		mysql_query('UPDATE `stats` SET `showmenu`="'.$u->info['showmenu'].'" WHERE `id`="'.$u->info['id'].'"');
	} 
}
?>
<style type="text/css">
.linestl1 {
	background-color: #E2E0E0;
	font-size: 10px;
	font-weight: bold;
}
</style>
<script>
function getLine(id,name,a,b,o,id2)
{
	var tss = '<td width="20"><img src="http://img.likebk.com/i/minus.gif" style="display:block;cursor:pointer;margin-bottom:3px;" title="Скрыть" class="btn-slide" onClick="location=\'main.php?inv=1&otdel=<? echo $_GET['otdel']; ?>&showmenu='+id2+'&rnd=<? echo $code; ?>\';"></td>';
	if(o==0)
	{
		tss ='<td width="20"><img src="http://img.likebk.com/i/plus.gif" style="display:block;cursor:pointer;margin-bottom:3px;" title="Показать" class="btn-slide" onClick="location=\'main.php?inv=1&otdel=<? echo $_GET['otdel']; ?>&showmenu='+id2+'&rnd=<? echo $code; ?>\';"></td>';
	}
	var sts01 = '<a href="main.php?inv=1&otdel=<? echo $_GET['otdel']; ?>&up='+id+'&rnd=<? echo $code; ?>"><img style="display:block;float:right; margin-bottom:3px;" src="http://img.likebk.com/i/3.gif"></a>';
	if(id==0)
	{
		sts01 = '<img style="display:block;float:right;margin-bottom:3px;" src="http://img.likebk.com/i/4.gif">';
	}
	var sts02 = '<a href="main.php?inv=1&otdel=<? echo $_GET['otdel']; ?>&down='+id+'&rnd=<? echo $code; ?>"><img style="display:block; margin-bottom:3px; float:right;" src="http://img.likebk.com/i/1.gif"></a>';
	if(id==7)
	{
		sts02 = '<img style="display:block;float:right;margin-bottom:3px;" src="http://img.likebk.com/i/2.gif">';
	}
	var sts2 = '<td width="40"><div style="float:right;">'+sts01+''+sts02+'</div></td>';
	document.write('<table class="mroinv" width="100%" border="0" cellspacing="2" cellpadding="0">'+
	'<tr>'+tss+
    '<td style="font-size:9px;"><span class="linestl1">&nbsp;'+name+'&nbsp;</span></td>'+sts2+'</tr>'+ 
	'</table>');
}

function showDiv (id)
{
	var block = document.getElementById('block_'+id);
	block.style.display = 'block';	
}
function hiddenDiv (id)
{
	var block = document.getElementById('block_'+id);
	block.style.display = 'none';	
}
<?
$rb = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `bank` WHERE `block` = 0 AND `uid` = "'.$u->info['id'].'"'));
?>
function bank_info() {
<? if(!isset($u->bank['id']) && $rb[0]==0){ ?>
	alert('У Вас нет активных счетов. \n\n На правах рекламы: Вы можете открыть счёт в Банке &laquo;<? echo $c['title3']; ?>&raquo;,'+
		' на Страшилкиной улице*\n\n* Мелким шрифтом: услуга платная.');
<?
}elseif($rb[0]>0){ 
?>
				var ddtpswBank = '<div><form action="main.php?inv=1&otdel=<? echo $_GET['otdel']; ?>&rnd=<? echo $code; ?>" method="post">'+
				        '<table style="border:1px solid #B1A996;" width="300" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#B1A996"><div align="center"><strong>Счёт в банке</strong><a href="javascript:void(0)" onclick="document.getElementById(\'chpassbank\').style.display=\'none\'" title="Закрыть окно" style="float:right;padding-right:5px;">x</a></div></td></tr><tr><td bgcolor="#DDD5C2" style="padding:5px;"><div align="center"><small>Выберите счёт и введите пароль<br />'+
                        '<select name="bank" id="bank">'+
						<?
                        $scet = mysql_query('SELECT `id` FROM `bank` WHERE `block` = "0" AND `uid` = "'.$u->info['id'].'"');
                        while ($num_scet = mysql_fetch_array($scet)) 
                        {
                       		 echo "'<option>".$u->getNum($num_scet['id'])."</option>'+";
                        }
						?>
                        '</select><input style="margin-left:5px;" type="password" name="bankpsw" id="bankpsw" /><label></label></small><input style="margin-left:3px;" type="submit" name="button" id="button" value=" ok " /></div></td></tr></table></form></div>';
						var ddtpsBankDiv = document.getElementById('chpassbank');
						if(ddtpsBankDiv!=undefined)
						{
							ddtpsBankDiv.style.display = '';
							ddtpsBankDiv.innerHTML = ddtpswBank;
						}
<?
}
?>
}
function save_com_can()
{
	var ddtpsBankDiv = document.getElementById('chpassbank');
	if(ddtpsBankDiv!=undefined)
	{
		ddtpsBankDiv.style.display = 'none';
		ddtpsBankDiv.innerHTML = '';
	}
}
function save_compl()
{
				var ddtpswBank = '<div><form action="main.php?inv=1&otdel=<? echo $_GET['otdel']; ?>&rnd=<? echo $code; ?>" method="post">'+
				        '<table style="border:1px solid #B1A996;" width="250" border="0" cellspacing="0" cellpadding="0"><tr><td bgcolor="#B1A996"><div align="center"><strong>Сохранить комплект</strong></div></td></tr><tr><td bgcolor="#DDD5C2" style="padding:5px;"><div align="center"><small>Введите название боевого комплекта:<br />'+
                        '<input style="width:90%;" type="text" name="compname" value="" id="compname" /><label></label></small><br><input style="margin-left:3px;cursor:pointer;" type="submit" name="button" id="button" value=" Сохранить " /><input style="margin-left:3px;cursor:pointer;" onClick="save_com_can();" type="button" value=" Отмена " /></div></td></tr></table></form></div>';
						var ddtpsBankDiv = document.getElementById('chpassbank');
						if(ddtpsBankDiv!=undefined)
						{
							ddtpsBankDiv.style.display = '';
							ddtpsBankDiv.innerHTML = ddtpswBank;
						}
}
function za_block(id) {
	if($('#za_block_'+id).css('display') == 'none') {
		$('#za_block_'+id).css('display','');
	}else{
		$('#za_block_'+id).css('display','none');
	}
}
</script>
<script src="http://<?php echo $c['host']?>/js/logs/bootstrap.min.js" type="text/javascript"></script>
<link href="http://<?php echo $c['host']?>/css/tooltip.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	$(document).ready(function(){
	    $('[rel="tooltip"]').tooltip();   
	    $('[rel="tooltip"]').css('cursor','pointer');
	});
</script>
<style>
.mroinv {
	/*background-color:#e2e2e2;border-top:1px solid #eeeeee;border-left:1px solid #eeeeee;border-right:1px solid #a0a0a0;border-bottom:1px solid #a0a0a0;*/
	background:url(http://img.likebk.com/i/back.gif) 0 2px;
}
.mroinv img {
	display:inline-block;
	border:0;
	padding-top:3px;
	padding-left:1px;
}
.dot {
	display:block;
	padding-bottom:2px;
    text-decoration: none; /* Убираем подчеркивание */
    border-bottom: 1px dotted #080808; /* Добавляем свою линию */
	cursor:pointer;
}
.dot:hover {
    border-bottom: 1px dotted #080808; /* Добавляем свою линию */
	background-color:#BEBEBE;
}
</style>
<div id="chpassbank" style="display:none; position:absolute; top:50px; left:250px;"></div>
<?php
	
	$rz0 = '';
	$rz1 = '';
	$rz2 = '';
	$rz3 = '';
	$rz4 = '';
	$rz5 = '';
	echo '
	<table width="100%" border="0" cellspacing="3" cellpadding="0">
	<tr><td>&nbsp;</td></tr>
	<tr>
    <td height="15">
	<small class="infsmal">
	<div style="/*padding:5px 5px 0px 5px;*/">';
	// href="http://likebk.com/library/TableExperience/"
	echo 'Опыт:&nbsp;<span style="float0:right"><b><a  rel="tooltip" title="Таблица опыта" href="http://'.$c['host'].'/exp.php" target="_blank">'.number_format($u->info['exp'],0,'',' ').'</a>('.$u->stats['levels']['exp'].')</b></span><br>';
	echo 'Бои:&nbsp;<span style="float0:right"><span rel="tooltip" title="Побед"><b>'.$u->info['win'].' <img width="7" height="7" title="Побед: '.$u->info['win'].'"
	src="http://img.likebk.com/i/ico/wins.gif" style="display:inline-block;" /></b></span> <span rel="tooltip" title="Поражений"><b>'.$u->info['lose'].' <img width="7" height="7" alt="Поражений: '.$u->info['lose'].'"
	src="http://img.likebk.com/i/ico/looses.gif" style="display:inline-block;" /></b></span> <span rel="tooltip" title="Ничьих"><b>'.$u->info['nich'].' <img width="7" height="7" alt="Ничьих: '.$u->info['nich'].'"
	src="http://img.likebk.com/i/ico/draw.gif" style="display:inline-block;" /></b></span></span><br />
	</div><div style="/*padding:0px 5px 5px 5px;*/">';
	echo 'Деньги:&nbsp;<b>'.$u->info['money'].' кр.</b><br />';
	$ekr = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `block` = "0" AND `uid` = "'.$u->info['id'].'"'));
	//echo 'Деньги:&nbsp;<b style="color: #23527c;">'.$ekr['money2'].' екр.</b><br />';
	//$u->stats['levels']['exp']
	//if($u->info['money3']>0) {
		//echo 'Валюта:&nbsp;<b>'.$u->info['money3'].'</b> $<br />';
	//}
	// if($u->info['level']>0)
	// {
	// 	echo'
	// 	<br>Банк:&nbsp;
	// 	';
	// 	if(!isset($u->bank['id']))
	// 	{ 
	// 		if($rb[0]>0)
	// 		{
	// 			echo '<a href="javascript:bank_info();">выбрать счёт</a>';
	// 		}else{
	// 			echo '<a href="javascript:bank_info();">информация</a>';
	// 		}
	// 	}else{
	// 		echo 'счет № <b>'.$u->bank['id'].'</b><br><b>'.$u->bank['money1'].'</b> кр. <b>'.$u->bank['money2'].'</b> екр. <img style="display:inline-block;cursor:pointer;" src="http://img.likebk.com/i/close_bank.gif" onClick="top.frames[\'main\'].location=\'main.php?inv=1&otdel='.$_GET['otdel'].'&bank_exit='.$code.'\';" title="Закончить работу со счётом" style="cursor:pointer">';
	// 	}
	// 	echo '<br>';
	echo "<div id='bonus'>";?>
		<div id="upda" style="">
			Деньги: <strong style="color: #23527c"><b><? echo $u->bank['money2']; ?></b>&nbsp;екр.</strong><? /*}*/ ?>
			<b><a style="display: inline-block; text-decoration: underline; font-size: 13px; color: #339900; cursor: pointer;" href="/main.php?bill=1">Пополнить баланс</a></b><br>
			<? if( $u->info['money5'] > 0 ) { ?>
            Деньги: <strong style="color: #23527c"><b><? echo $u->info['money5']; ?></b>&nbsp;Gold ekr.</strong>
            <? } ?>
        </div>
	<?php if( $u->info['level'] > 7 ) {
		$bonus = 0.02;
		$lev = ($u->info['level'] - 8);
		if($lev != 0){
			$bonus = $bonus + (0.01 * $lev);
		}
		if(round(date('w')) == 0 || round(date('w')) == 6 || $c['holiday'] == true) {
			$bonus *= 2;
		}
		$bns = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `aaa_bonus` WHERE `uid` = "'.$u->info['id'].'" AND `time` > '.time().' LIMIT 1'));
		if(isset($_GET['takebns']) && $u->newAct($_GET['takebns'])==true && !isset($bns['id'])) {
			$u->takeBonusNew($bonus);
			$bns = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `aaa_bonus` WHERE `uid` = "'.$u->info['id'].'" AND `time` > '.time().' LIMIT 1'));
		}
		if( $u->info['clan'] == 0 && ($u->info['align'] == 0 || $u->info['align'] == 2) ) {
			$bonus = array(
				0,0,0,0,0,0,0,0,8,12,16,20,24,24,24,24,24,24,24,24,24
			);
			$bonus = $bonus[$u->info['level']];
			if(isset($bns['id'])) {
				echo '<div class="txt_bonus">Ваш бонус '.$bonus.' кр.: </div>';
				echo '<button id="bonus_btn" style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" onclick="alert(\'Вы сможете взять бонус через '.$u->timeOut($bns['time']-time()).'\');" class="btnnew"> Через '.$u->timeOut($bns['time']-time()).' </button>';
			}else{
				echo '<div class="txt_bonus">Ваш бонус '.$bonus.' кр.: </div>';
				echo '<button id="bonus_btn" style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" class="btnnew" id="bonus_btn" onclick="btn_bon(); return false;">Получить!</button></div>';
			}
		}else{
			if(isset($bns['id'])) {
				echo '<div class="txt_bonus">Ваш бонус '.$bonus.' екр.: </div>';
				echo '<button id="bonus_btn" style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" onclick="alert(\'Вы сможете взять бонус через '.$u->timeOut($bns['time']-time()).'\');" class="btnnew"> Через '.$u->timeOut($bns['time']-time()).' </button>';
			}else{
				echo '<div class="txt_bonus">Ваш бонус '.$bonus.' екр.: </div>';
				echo '<button id="bonus_btn" style="width:120px; padding-left: 0px; padding-right: 0px; font-size: 12px; margin-top:5px;" class="btnnew" id="bonus_btn" onclick="btn_bon(); return false;">Получить!</button></div>';
			}
		}
	}
	echo "</div>";?>
<script type="text/javascript">
	function bonus() {
    	$.get("jx/bonus.php", function(html) {
        	$("#bonus").html(html);
      	})
  	}
  	//setInterval(bonus, 5000);
	function btn_bon(){
		var inf = "<?php echo $u->info['nextAct']?>";
		//alert(inf);
		$.get("jx/bonus.php?takebns="+inf+"&getb1w=3&msg=0", function(html) {
			$.get("jx/bonus.php?msg=1", function(html) {
				$('#bonus').html(html);
	        });
        });
	};
</script>	
	<?php echo '</div>';
	$prt = explode('|',$u->info['prmenu']);
	if(isset($_GET['up']))
	{
		$i = 0;
		if(isset($prt[$_GET['up']],$prt[$_GET['up']-1]))
		{
			$prt1 = $prt[intval($_GET['up'])];
			$prt[$_GET['up']] = $prt[$_GET['up']-1];
			$prt[$_GET['up']-1] = $prt1;
			$prtNew = implode('|',$prt);
			$u->info['prmenu'] = $prtNew;
			mysql_query('UPDATE `stats` SET `prmenu`="'.mysql_real_escape_string($u->info['prmenu']).'" WHERE `id`="'.$u->info['id'].'" LIMIT 1');
			$prt = explode('|',$u->info['prmenu']);
		}
	}elseif(isset($_GET['down']))
	{
		$i = 0;
		if(isset($prt[$_GET['down']],$prt[$_GET['down']+1]))
		{
			$prt1 = $prt[intval($_GET['down'])];
			$prt[$_GET['down']] = $prt[$_GET['down']+1];
			$prt[$_GET['down']+1] = $prt1;
			$prtNew = implode('|',$prt);
			$u->info['prmenu'] = $prtNew;
			mysql_query('UPDATE `stats` SET `prmenu`="'.mysql_real_escape_string($u->info['prmenu']).'" WHERE `id`="'.$u->info['id'].'" LIMIT 1');
			$prt = explode('|',$u->info['prmenu']);
		}
	}
	
	$i = 0;
	while($i<count($prt))
	{
		$prtpos[$prt[$i]] = $i;
		$i++;
	}
	
	$rz0 = '<script>getLine('.$prtpos[0].',"Характеристики ","0","0","'.$uShow[0].'",1);</script>';
	$rz0 .= '<font id="rz0">';
	if($uShow[0]==1){
		$rz0 .= '
		Сила: <b>'.$u->stats['s1'].'</b><br />
		Ловкость:&nbsp;<b>'.$u->stats['s2'].'</b><br />
		Интуиция:&nbsp;<b>'.$u->stats['s3'].'</b><br />
		Выносливость:&nbsp;<b>'.$u->stats['s4'].'</b><br />
		';
		if($u->info['level'] >= 4 || $u->stats['n5']!=0)
		{
			$rz0 .= '
			Интеллект:&nbsp;<b>'.$u->stats['s5'].'</b><br />
			';
		}
		if($u->info['level'] >= 7 || (@isset($u->stats['n6']) && @$u->stats['n6']>0))
		{
			$rz0 .= '
			Мудрость:&nbsp;<b>'.@$u->stats['s6'].'</b><br />
			';
		}
		if($u->info['level'] >= 10 || @$u->stats['s7']>0)
		{
			$rz0 .= '
			Духовность:&nbsp;<b>'.@$u->stats['s7'].'</b><br />
			';
		}
		/*if($u->info['level'] >= 14 || @$u->stats['s8']>0)
		{
			$rz0 .= '
			Воля:&nbsp;<b>'.@$u->stats['s8'].'</b><br />
			';
		}
		if($u->info['level'] >= 15 || @$u->stats['s9']>0)
		{
			$rz0 .= '
			Свобода духа:&nbsp;<b>'.@$u->stats['s9'].'</b><br />
			';
		}
		if($u->info['level'] >= 20 || @$u->stats['s10']>0)
		{
			$rz0 .= '
			Божественный:&nbsp;<b>'.@$u->stats['s10'].'</b><br />
			';
		}*/
			//$rz0 .= '
			//Энергия:&nbsp;<b>'.(0+$u->stats['s11']).'</b> &nbsp; <small>['.round($u->info['enNow'],3).'/'.$u->stats['enAll'].']</small><br />
			//';
		if($u->info['ability'] > 0)
		{ 
			$rz0 .= '&nbsp;<a href="main.php?skills=1&side=1">+ Способности</a>'; 
			if($u->info['skills'] != 0)
			{
				$rz0 .= '<br>';
			} 
		}

		if($u->info['skills'] > 0 && $u->info['level'] > 0)
		{ 
			$rz0 .= '&nbsp;&bull; <a href="main.php?skills=1&side=1">Обучение</a><br />'; 
		}
	}
	$rz0 .= '</font>';
	$rz1 = '<script>getLine('.$prtpos[1].',"Модификаторы ","0","0",'.$uShow[1].',2);</script>';
	if($uShow[1]==1)
	{
		$rz1 .= '<span class="dot">Урон: '.$u->inform('yron');
			$rz1 .= '</span><span class="dot">Мф. мощности урона: '.$u->inform('m10').'';
			$rz1 .= '</span><span class="dot">Мф. крит. удара: '.$u->inform('m1').'';
			if(@$u->stats['m3']!=0)
			{
				$rz1 .='
				</span>
				<nobr>
				<span class="dot">Мф. мощности крит. удара: '.$u->inform('m3').'';
			}
			$rz1 .= '
			</span></nobr>
			<span class="dot">Мф. против крит. удара: '.$u->inform('m2').'';
			$rz1 .= '</span>
			<span class="dot">Мф. увертывания: '.$u->inform('m4').'';
			$rz1 .= '</span>
			<nobr class="dot"><span>Мф. против увертывания: '.$u->inform('m5').'';
			$rz1 .= '</span></nobr>
			<span class="dot">Мф. пробоя брони: '.$u->inform('m9').'';
			$rz1 .= '</span>
			<span class="dot">Мф. контрудара: '.$u->inform('m6').'';
			$rz1 .='
			</span>
			<span class="dot">Мф. парирования: '.$u->inform('m7').'';
			$rz1 .= '</span>
			<span class="dot">Мф. блока щитом: '.$u->inform('m8').'';
			$rz1 .= '</span>';
		$rz1 .= '</nobr>';
		/*if($uShow[4]==1)
	{*/
			$rz1 .= '<span class="dot">'.ucfirst("Защита от урона").': ';
			$rz1 .= ''.$u->stats['za'].' ('.round(zago($u->stats['za'])).'%)</span>';
		
			/*$rz1 .= '<span class="dot">'.ucfirst("Защита от магии").': ';
			$rz1 .= ''.$u->stats['zma'].' ('.round(zago($u->stats['zma'])).'%)</span>';
*/
			$rz1 .= '<span class="dot">'.ucfirst("Защита от магии").': ';
			$rz1 .= ''.$u->stats['zm1'].' ('.round(zago($u->stats['zm1'])).'%)</span>';

			$rz1 .= '<span class="dot">'.ucfirst("Понижение защиты от магии").': ';
			$rz1 .= ''.$u->stats['pzm'].' ('.round(zago($u->stats['pzm'])).'%)</span>';
	//}
	}
	$rz2 ='<script>getLine('.$prtpos[2].',"Броня ","0","0",'.$uShow[2].',3);</script>';
	if($uShow[2]==1)
	{		
		$rz2 .= '
		<span class="dot">Броня головы: '.$u->stats['mib1'].'-'.$u->stats['mab1'].' ('.($u->stats['mib1']).'+d'.($u->stats['mab1']-($u->stats['mib1'])+1).')</span>
		<span class="dot">Броня корпуса: '.$u->stats['mib2'].'-'.$u->stats['mab2'].' ('.($u->stats['mib2']).'+d'.($u->stats['mab2']-($u->stats['mib2'])+1).')</span>
		<span class="dot">Броня пояса: '.$u->stats['mib3'].'-'.$u->stats['mab3'].' ('.($u->stats['mib3']).'+d'.($u->stats['mab3']-($u->stats['mib3'])+1).')</span>
		<span class="dot">Броня ног: '.$u->stats['mib4'].'-'.$u->stats['mab4'].' ('.($u->stats['mib4']).'+d'.($u->stats['mab4']-($u->stats['mib4'])+1).')</span>';
	}
	$rz3 = '<script>getLine('.$prtpos[3].',"Мощность ","0","0",'.$uShow[3].',4);</script>';
	if($uShow[3]==1)
	{
		$i = 1;
		while($i<=4)
		{
			$rz3 .= '<span class="dot">'.ucfirst(str_replace('Мф. мощности','Мощность ',$u->is['pa'.$i].': '));
			if($u->stats['pa'.$i]>0)
			{
				//$rz3 .= '+';
			}
			//$rz3 .= $u->stats['pa'.$i].'<br />';
			$rz3 .= $u->inform('pa'.$i).'</span>';
			$i++;
		}
		$i = 1;
		while($i<=7)
		{
			$rz3 .= '<span class="dot">'.ucfirst(str_replace('Мф. мощности ','Мощность ',$u->is['pm'.$i].': '));
			if($u->stats['pm'.$i]>0)
			{
				//$rz3 .= '+';
			}
			//$rz3 .= $u->stats['pm'.$i].'<br />';
			$rz3 .= $u->inform('pm'.$i).'</span>';
			$i++;
		}
	}
	
	$zi = array( //Предметы влияющие на зоны
		'n' => array(
			'','голова','грудь','живот','пояс','ноги'
		),
		1 => array( 1 , 8 , 9 , 52 ), //голова
		2 => array( 4 , 5 , 6 ), //грудь
		3 => array( 2 , 4 , 5 , 6 , 13 ), //живот
		4 => array( 7 , 16 , 10 , 11 , 12 ), //пояс
		5 => array( 17 )  //ноги
	);
		
	/*//$rz4 = '<script>getLine('.$prtpos[4].',"Защита: ","0","0",'.$uShow[4].',5);</script>';*/
	
	$rz5 = '<script>getLine('.$prtpos[5].',"Кнопки ","0","0",'.$uShow[5].',6);</script>';
	if($uShow[5]==1)
	{
		$rz5 .= '<center style="padding:5px;">';
		$rz5 .= '<input class="btnnew" style="padding:3px 15px 3px 15px;" type="button" name="snatvso" value="Снять всё" class="btn" onclick="top.frames[\'main\'].location=\'main.php?inv=1&remitem&otdel='.$_GET['otdel'].'\';"
		style="font-weight:bold;" />
		&nbsp;';
		$hgo = $u->testHome();
		if(!isset($hgo['id']))
		{
			$rz5 .=  '<input class="btnnew" style="padding:3px 15px 3px 15px;" type="button" value="Возврат" class="btn" onclick="top.frames[\'main\'].location=\'main.php?homeworld&rnd='.$code.'\';" style="font-weight:bold;width: 90px" />';
		}
		unset($hgo);
		$rz5 .= '</center>';
		$rz5 .=  '';
	}
	
	$rz6 ='<script>getLine('.$prtpos[6].',"Комплекты&nbsp;&nbsp;&nbsp;<a href=\"#\" onClick=\"save_compl();\">запомнить</a>&nbsp;","0","0",'.$uShow[6].',7);</script>';
	if($uShow[6]==1)
	{
		$rz6 .= '<div>';
		$sp = mysql_query('SELECT * FROM `save_com` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = "0" LIMIT 10');
		while($pl = mysql_fetch_array($sp))
		{
			$rz6 .= '<a href="?inv=1&delc1='.$pl['id'].'&otdel='.((int)$_GET['otdel']).'&rnd='.$code.'"><img src="http://img.likebk.com/i/close2.gif" title="Удалить комплект" width="9" height="9"></a> <small><a href="?inv=1&usec1='.$pl['id'].'&otdel='.((int)$_GET['otdel']).'&rnd='.$code.'">Надеть &quot;'.$pl['name'].'&quot;</a></small><br>';
		}
		$rz6 .= '</div>';
	}
	
	$rz7 ='<script>getLine('.$prtpos[7].',"Приемы &nbsp; &nbsp;<a href=\"/main.php?skills=1&rz=4&rnd='.$code.'\">настроить</a>&nbsp;","0","0",'.$uShow[7].',8);</script>';
	if($uShow[7]==1)
	{
		$rz6 .= '<div>';
		$sp = mysql_query('SELECT * FROM `complects_priem` WHERE `uid` = "'.$u->info['id'].'" LIMIT 10');
		$rz7 .= '<small>';
		while($pl = mysql_fetch_array($sp)) {
			$rz7 .= '<a onclick="if(confirm(\'Удалить набор  ?\')){location=\'main.php?inv=1&otdel='.round((int)$_GET['otdel']).'&delcop='.$pl['id'].'\'}" href="javascript:void(0)"><img src="http://'.$c['img'].'/i/close2.gif" width="9" height="9"></a> <a href="main.php?inv=1&otdel='.round((int)$_GET['otdel']).'&usecopr='.$pl['id'].'">Использовать &quot;'.$pl['name'].'&quot;</a><br>';
		}
		$rz7 .= '</small>';
		$rz6 .= '</div>';
	}
	
	$i = 0;
	while($i<count($prt))
	{
		if(isset(${'rz'.$prt[$i]}))
		{
			echo ${'rz'.$prt[$i]};
		}
		$i++;
	}
	
		//
		if(isset($_GET['svitki_auto'])) {
			if($u->info['autospell'] == 0) {
				$u->info['autospell'] = 1;
			}else{
				$u->info['autospell'] = 0;
			}
			mysql_query('UPDATE `users` SET `autospell` = "'.$u->info['autospell'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}elseif(isset($_GET['hide_plaw'])) {
			if($u->info['noplaw'] == 0) {
				$u->info['noplaw'] = 1;
			}else{
				$u->info['noplaw'] = 0;
			}
			mysql_query('UPDATE `users` SET `noplaw` = "'.$u->info['noplaw'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		}elseif(isset($_GET['noletoexp'])) {
			/*if($u->info['noletoexp'] == 0) {
				$u->info['noletoexp'] = 1;
			}else{
				$u->info['noletoexp'] = 0;
			}
			mysql_query('UPDATE `users` SET `noletoexp` = "'.$u->info['noletoexp'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');*/
		}
		
		if($u->info['autospell'] == 0) {
			$ch1 = '';
		}else{
			$ch1 = 'checked="checked"';
			$ch1s = 'style="font-weight:bold"';
		}
		
		if($u->info['noplaw'] == 0) {
			$ch3 = 'onclick="if(confirm(\'Вы дествительно хотите скрыть отображение плащей?\')) location.href=\'/main.php?inv&hide_plaw=1\';"';
		}else{
			$ch3 = 'checked="checked" onclick="location.href=\'/main.php?inv&hide_plaw=0\';"';
			$ch3s = 'style="font-weight:bold"';
		}
		
		if($u->info['noletoexp'] == 0) {
			$ch4 = 'onclick="if(confirm(\'Вы дествительно хотите отключить летний опыт?\')) location.href=\'/main.php?inv&noletoexp=1\';"';
		}else{
			$ch4 = 'checked="checked" onclick="location.href=\'/main.php?inv&noletoexp=0\';"';
			$ch4s = 'style="font-weight:bold"';
		}
		
		//
		echo '<br><label '.$ch1s.'><input type="checkbox" '.$ch1.' onclick="location.href=\'/main.php?inv&svitki_auto=1\';" /> Автопополнение свитков</label><br><label '.$ch3s.'><input type="checkbox" '.$ch3.' /> Спрятать плащи</label>';
		
		//echo '<br><label '.$ch4s.'><input type="checkbox" '.$ch4.' /> Отключить летний опыт</label>';

	
?>
</td>
</tr>
</table>