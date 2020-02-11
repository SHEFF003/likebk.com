<?php
if(!defined('GAME'))
{
	die();
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://<?php echo $c['host']?>/js/logs/bootstrap.min.js" type="text/javascript"></script>
<link href="http://<?php echo $c['host']?>/css/tooltip.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
	$(document).ready(function(){
	    $('[rel="tooltip"]').tooltip();   
	    $('[rel="tooltip"]').css('cursor','pointer');
	});
</script>
<div style="padding-left: 10px;margin-top: 13px;">
<span style="font-size:13px;">
Сила: <strong><? echo $u->stats['s1']; ?></strong><br />
Ловкость: <strong><? echo $u->stats['s2']; ?></strong><br />
Интуиция: <strong><? echo $u->stats['s3']; ?></strong><br />
Выносливость: <strong><? echo $u->stats['s4']; ?></strong><br />
<? if($u->info['level'] > 3 || $u->stats['s5']!=0){ ?>Интеллект: <strong><? echo $u->stats['s5']; ?></strong><br /><? } ?>
<? if($u->info['level'] > 6 || $u->stats['s6']!=0){ ?>Мудрость: <strong><? echo $u->stats['s6']; ?></strong><br /><? } ?>
<? if($u->info['level'] > 9 || $u->stats['s7']!=0){ ?>Духовность: <strong><? echo $u->stats['s7']; ?></strong><br /><? } ?>
<? if($u->info['level'] > 13 || $u->stats['s8']!=0){ ?>Воля: <strong><? echo $u->stats['s8']; ?><br /></strong><? } ?>
<? if($u->info['level'] > 14 || $u->stats['s9']!=0){ ?>Свобода духа: <strong><? echo $u->stats['s9']; ?></strong><br /><? } ?>
<? if($u->info['level'] > 19 || $u->stats['s10']!=0){ ?>Божественный: <strong><? echo $u->stats['s10']; ?></strong><br /><? } ?>
<?
/*
Энергия:&nbsp;<? echo 0+$u->stats['s11']; ?> &nbsp; <small>[<?=round($u->info['enNow'],3)?>/<?=$u->stats['enAll']?>]</small><br />
*/
if($u->info['ability'] > 0) 
{ 
echo '<a href="main.php?skills=1&side=1">+ Способности</a><br />'; 
}
if($u->info['skills'] > 0 && $u->info['level'] > 0)
{ 
echo '&bull;&nbsp;<a href="main.php?skills=1&side=1">Обучение</a><br />'; 
} 
?>
&nbsp;<br />
Опыт: <strong><a rel="tooltip" title="Таблица опыта" href="http://<?php echo $c['host']?>/exp.php" target="_blank"><? echo number_format($u->info['exp'],0,'',' '); ?></a> (<?php echo $u->stats['levels']['exp']?>)</strong><br />
Уровень: <strong><? echo $u->info['level']; ?></strong><br />
Побед: <strong><? echo $u->info['win']; ?></strong><br />
Поражений: <strong><? echo $u->info['lose']; ?></strong><br />
Ничьих: <strong><? echo $u->info['nich']; ?></strong><br />
<? if($u->rep['rep3'] >= 0) { ?>
<!--Воинственность:&nbsp;<b><? echo ( $u->rep['rep3'] - $u->rep['rep3_buy'] ); ?></b><br /><? } ?>-->
Деньги: <strong><b><? echo $u->info['money']; ?></b>&nbsp;кр.</strong><br />
<? /*if($u->info['money3'] > 0) {*/ ?>
</span>
<div id="bonus">
	<div id="upda">
		Деньги: <strong style="color: #23527c"><b><? echo $u->bank['money2']; ?></b>&nbsp;екр.</strong><? /*}*/ ?> 
		<b><a style="display: inline-block; text-decoration: underline; font-size: 13px; color: #339900; cursor: pointer;" onClick="location='main.php?bill=1'">Пополнить баланс</a></b><br>
		<? if( $u->info['money5'] > 0 ) { ?>
        Деньги: <strong style="color: #23527c"><b><? echo $u->info['money5']; ?></b>&nbsp;Gold ekr.</strong>
        <? } ?>
    </div>
<?php

	if( date('m') == 4 && (date('d') < 30 && date('d') > 12) ) {
		$xya = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `pasha_x` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
		$xya = $xya[0]+0;
		
		echo '<div>Пасхальных яиц собрано: '.$xya.'</div>';
	}

	if( $u->info['level'] > 7 ) {
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
			if(round(date('w')) == 0 || round(date('w')) == 6 || $c['holiday'] == true) {
				$bonus *= 2;
			}
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
?>
</div>
<?php //if(date('Y-m-d') == '2016-10-06' || $u->info['id'] == 155){ ?>
<?php //if(date('Y-m-d') == '2016-10-06'){ ?>
	<div style="width: 175px; margin-left: 15px;text-align: center;">
	<div style="color: #8f0000;font-family: Arial;font-size: 14px;font-weight: bold;text-align: center;">Награда за ежедневное испытание!</div>
	<img style="cursor: pointer" onClick="location='main.php?dailybonus=1'" onMouseOver="top.hi(this,'Ежедневный бонус',event,0,1,1,1,'max-height:240px');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="/image/sunduk.png" width="70" />
	</div>
<? /*if( date('m') == '11' ) { ?>
	<div style="width: 175px; margin-left: 15px;text-align: center;">
	<div style="color: #8f0000;font-family: Arial;font-size: 14px;font-weight: bold;text-align: center;">Осенний Листопад!</div>
	<img style="cursor: pointer" onClick="location='main.php?newybonus=1'" onMouseOver="top.hi(this,'Осенний бонус',event,0,1,1,1,'max-height:220px');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="http://img.likebk.com/babaleto.png" width="60" />
	</div>
<? } ?>
<? 
if( ( date('m') == '02' || (date('m') == '01' && date('d') > 14)) ) { ?>
	<div style="width: 175px; margin-left: 15px;text-align: center;">
	<div style="color: #8f0000;font-family: Arial;font-size: 14px;font-weight: bold;text-align: center;">Зимнее обострение!</div>
	<img style="cursor: pointer" onClick="location='main.php?newybonus2=1'" onMouseOver="top.hi(this,'Зимний бонус',event,0,1,1,1,'max-height:220px');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="http://img.likebk.com/obostrenie.png" width="60" />
	</div>
<?
}
if( ( date('m') == '03' || (date('m') == '04' && date('d') <= 14) ) ) { ?>
	<div style="width: 175px; margin-left: 15px;text-align: center;">
	<div style="color: #8f0000;font-family: Arial;font-size: 14px;font-weight: bold;text-align: center;">Весенняя Оттепель</div>
	<img style="cursor: pointer" onClick="location='main.php?newybonus3=1'" onMouseOver="top.hi(this,'Весенний бонус',event,0,1,1,1,'max-height:220px');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="http://likebk.com/ottepel.png" width="60" />
	</div>
<?
}*/
/*if( ( date('m') == '05' || (date('m') == '04' && date('d') >= 22) ) ) { ?>
	<div style="width: 175px; margin-left: 15px;text-align: center;">
	<div style="color: #8f0000;font-family: Arial;font-size: 14px;font-weight: bold;text-align: center;">Майские праздники!</div>
	<img style="cursor: pointer" onClick="location='main.php?newybonus4=1'" onMouseOver="top.hi(this,'Майский бонус',event,0,1,1,1,'max-height:220px');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="http://img.likebk.com/1mai.png" width="60" />
	</div>
<?
}*/


	$d2 = round(date('m'));
	$sp = mysql_query('SELECT * FROM `a_quest` WHERE (`mm` <= "'.$d2.'" AND `mm2` >= "'.$d2.'") OR (`mm` > `mm2` AND `mm2` >= "'.$d2.'") OR (`mm` > `mm2` AND `mm` <= "'.$d2.'")  ORDER BY `mm` ASC , `dd` ASC');
	while( $pl = mysql_fetch_array($sp) ) {
		if( $pl['img1'] == '' ) {
			
		}elseif( ( ($pl['mm'] == $d2 && date('d') < $pl['dd']) || ($pl['mm2'] == $d2 && date('d') > $pl['dd2']) ) ) {
			
		}else{
?>
	<div style="width: 175px; margin-left: 15px;text-align: center;">
	<div style="color: #8f0000;font-family: Arial;font-size: 14px;font-weight: bold;text-align: center;" title="<?=$pl['dd'].'.'.$pl['mm'].' - '.$pl['dd2'].'.'.$pl['mm2']?>"><?=$pl['name']?></div>
	<img style="cursor: pointer" onClick="location='main.php?newybonus10=<?=$pl['id']?>'" onMouseOver="top.hi(this,'<?=$pl['name2']?>',event,0,1,1,1,'max-height:220px');" onMouseOut="top.hic();" onMouseDown="top.hic();" src="http://img.likebk.com/<?=$pl['img1']?>" width="60" />
	</div>
<?
		}
	}
	

?>
<?php //}?>
</div>
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