<?php
if(!defined('GAME'))
{
	die();
}

if($u->room['file'] == 'hip') {
	
	if(isset($_GET['loc']) && $_GET['loc'] == '1.180.0.412') {
		mysql_query('UPDATE `users` SET `room` = 412 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		header('location: /main.php');
		die();
	}
	
	include('_incl_data/class/dialog.class.php');
	
	$dialog->start(12);
	
	$dlg = mysql_fetch_array(mysql_query('SELECT * FROM `hip` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
	
	$qsts = array(
		1 	=> array( 'Выпивка для друга' ),
		2 	=> array( 'Новый тулуп' ),
		3 	=> array( 'Игрушка для сиротки' ),
		4 	=> array( 'Приближается Нечто…' ),
		5 	=> array( 'Дружеский турнир' ),
		6 	=> array( 'Битва с Тьмой' ),
		7 	=> array( 'Битва со Светом' ),
		8 	=> array( 'Коготь Предков' ),
		9 	=> array( 'Моя прелесть' ),
		10 	=> array( 'Корни Долголетия' ),
		11 	=> array( 'Валентайский Лук' ),
		12	=> array( 'Как за каменным забором' ),
		13 	=> array( 'Исчадие Хаоса' ),
		14 	=> array( 'Старый Ворон' ),
		15 	=> array( 'Паучьи Узы' ),
		16 	=> array( 'Дикое Дерево' )
	);
	
	if(!isset($dlg['id'])) {
		if(isset($_GET['coin1'])) {
			$cn1 = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `item_id` = "8028" AND `delete` = 0 AND `inShop` = 0 AND `inTransfer` = 0 AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
			$test = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `hip_day` WHERE `uid` = "'.$u->info['id'].'" AND `time` = "'.date('d.m.Y').'" LIMIT 1'));
			$test = 0 + $test[0];
			if( $u->rep['hip'] < 20000 && $test >= 1 ) {
				$error2 = 'Сегодня вы уже выполнили 1 задание!';
			}elseif( $u->rep['hip'] >= 20000 && $test >= 2 ) {
				$error2 = 'Сегодня вы уже выполнили 2 задания!';
			}elseif(isset($cn1['id'])) {
				$rndq = rand(1,count($qsts));	
				if( $rndq == 1 || $rndq == 6 || $rndq == 7 || $rndq == 15 || $rndq == 16 ) {
					$rndq = rand(2,5);
				}
				$error2 = 'Вы успешно заплатили &quot;Древняя Бронзовая Монета&quot; и получили новое задание &quot;'.$qsts[$rndq][0].'&quot;!';
				//mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$cn1['id'].'" LIMIT 1');
				mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$cn1['id'].'" LIMIT 1');
				mysql_query('INSERT INTO `hip` ( `uid`,`qid`,`time` ) VALUES ( "'.$u->info['id'].'","'.$rndq.'","'.time().'" )');
				mysql_query('INSERT INTO `hip_day` ( `uid`,`time` ) VALUES ( "'.$u->info['id'].'","'.date('d.m.Y').'" )');
				$dlg = mysql_fetch_array(mysql_query('SELECT * FROM `hip` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
			}else{
				$cn1 = mysql_fetch_array(mysql_query('SELECT * FROM `items_users_res` WHERE `item_id` = "8028" AND `delete` = 0 AND `inShop` = 0 AND `inTransfer` = 0 AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				$test = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `hip_day` WHERE `uid` = "'.$u->info['id'].'" AND `time` = "'.date('d.m.Y').'" LIMIT 1'));
				$test = 0 + $test[0];
				if( $u->rep['hip'] < 25000 && $test >= 1 ) {
					$error2 = 'Сегодня вы уже выполнили 1 задание!';
				}elseif( $u->rep['hip'] >= 25000 && $test >= 2 ) {
					$error2 = 'Сегодня вы уже выполнили 2 задания!';
				}elseif(isset($cn1['id'])) {
					$rndq = rand(1,count($qsts));	
					if( $rndq == 1 || $rndq == 6 || $rndq == 7 || $rndq == 15 || $rndq == 16 ) {
						$rndq = rand(2,5);
					}
					$error2 = 'Вы успешно заплатили &quot;Древняя Бронзовая Монета&quot; и получили новое задание &quot;'.$qsts[$rndq][0].'&quot;!';
					mysql_query('UPDATE `items_users_res` SET `delete` = "'.time().'" WHERE `id` = "'.$cn1['id'].'" LIMIT 1');
					mysql_query('INSERT INTO `hip` ( `uid`,`qid`,`time` ) VALUES ( "'.$u->info['id'].'","'.$rndq.'","'.time().'" )');
					mysql_query('INSERT INTO `hip_day` ( `uid`,`time` ) VALUES ( "'.$u->info['id'].'","'.date('d.m.Y').'" )');
					$dlg = mysql_fetch_array(mysql_query('SELECT * FROM `hip` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
				}else{
					$error2 = 'У вас нет предмета &quot;Древняя Бронзовая Монета&quot;!';
				}
			}
		}
	}
	if(isset($_GET['cancel1qst'])) {
		mysql_query('DELETE FROM `hip` WHERE `uid` = "'.$u->info['id'].'"');
		mysql_query('DELETE FROM `hip_kill` WHERE `uid` = "'.$u->info['id'].'"');
		$error2 = 'Вы отказались от всех заданий!';
		unset($dlg);
	}
	if(isset($dlg['id'])&& $dlg['start'] == 0 && isset($_GET['startqst'])) {
		$error2 = 'Задание &quot;'.$qsts[$dlg['qid']][0].'&quot; одобрено, можете начинать его выполнять!';
		$dlg['start'] = time();
		mysql_query('UPDATE `hip` SET `start` = "'.$dlg['start'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
	}
	if((isset($dlg['id']) && $dlg['finish'] > 0 ) || ( isset($_GET['adm1']) && $u->info['admin'] > 0 ) ) {
		$error2 = 'Задание &quot;'.$qsts[$dlg['qid']][0].'&quot; завершено, вы получили 100 хип-репутации, 50 кр. и Пропуск в пещеры!';
		$u->addItem(2412,$u->info['id'],'|sudba=1|nosale=1|notransfer=1');
		mysql_query('UPDATE `rep` SET `hip` = `hip` + 100 WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		$u->info['money'] += 50;
		mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
		mysql_query('DELETE FROM `hip` WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
		unset($dlg);
	}
	
	$r = 1;
	if( $_GET['r'] == 2 ) {
		$r = 2;
	}elseif( $_GET['r'] == 3 ) {
		$r = 3;
	}
	
	if($re!=''){ echo '<div align="right"><font color="red"><b>'.$re.'</b></font></div>'; } ?>
    <style>
	.pH3			{ COLOR: #8f0000;  FONT-FAMILY: Arial;  FONT-SIZE: 12pt;  FONT-WEIGHT: bold; }
	</style>
	<style>
    body {
        background-image: url(http://img.likebk.com/i/misc/showitems/dungeon.jpg);background-repeat:no-repeat;background-position:top right;
    }
    </style>
	<TABLE width="100%" cellspacing="0" cellpadding="0">
	<tr><td valign="top"><div align="center" class="pH3">Хижина Искателей Приключений</div>
	<?php
	echo '<b style="color:red">'.$error.'</b>';
	?>
	<td width="280" align="right" valign="top">
    <TABLE cellspacing="0" cellpadding="0"><TD width="100%">&nbsp;</TD><TD>
<table  border="0" cellpadding="0" cellspacing="0">
<tr align="right" valign="top">
<td>
<!-- -->
<? echo $goLis; ?>
<!-- -->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td nowrap="nowrap">
<table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
<tr>
<td bgcolor="#D3D3D3"><img src="http://img.likebk.com/i/move/links.gif" width="9" height="7" /></td>
<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.412&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.412',1); ?>">Мистический Лес</a></td>
</tr>
<tr>
<td bgcolor="#D3D3D3"><img src="http://img.likebk.com/i/move/links.gif" width="9" height="7" /></td>
<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.419&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.419',1); ?>">Лавка Седоборода</a></td>
</tr>
</table>
</td>
</tr>
</table>
</td></table>
</td></table>
<div>
  <INPUT TYPE="button" value="Обновить" onclick="location = '<? echo $_SERVER['REQUEST_URI']; ?>';"><BR>
	  </div>
<div style="line-height:17px;"></div>
	</td>
	</table>
    <?
	if( $r == 1 ) {
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="300" valign="top"><div align="left"><? echo $dialog->youInfo; ?></div></td>
        <td valign="top">
        <?
		if($error2!=''){ echo '<div align="left"><font color="red"><b>'.$error2.'</b></font></div><br>'; }
		if( !isset($dlg['id']) ) {
			//Квеста нет, нужна монетка
		?>
                Здравствуй, <b><?=$u->info['login']?></b>! Ты находишься в Хижине Искателей Приключений!
                Здесь можно выполнять различные задания и получать за них награду, для этого нужно сдать <b>Древняя Бронзовая Монета</b>.
                Монета выпадает в пещерах и её можно передавать, либо продавать другим игрокам или в магазин. У тебя есть монета для меня?
                <br><br>
                <a href="/main.php?r=1&coin1=1">&bull; Да, вот держи монету! (Получить новое задание)</a>
        <?
		}else{
			//Квест есть
			
			if( $dlg['qid'] == 2 ) {
				/*
				Новый тулуп (название задания / квеста).
				Шкура пещерного оленя 0/10 (894)
				*/
				if(!isset($_GET['finishqst'])) {
				?>
                Приветствую тебя путник, Мой старый тулуп совсем разваливается. Он перенёс в своё время много сражений, защищал меня от многих ударов судьбы.
                Но пора мне его обновить. Выручи меня. Говорят в старых пещерах этого мира обитают Олени, чья шкура прочнее стали. Принеси мне 10 таких шкур.
                Думаю этого мне хватит.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 894 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 10;
				if($x > $xmax) {
					$x = $xmax;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax && $x >= $xmax ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 894 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					echo '<div align="left"><font color="red"><b>Задание &quot;'.$qsts[$dlg['qid']][0].'&quot; было успешно выполнено!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    Вот спасибо тебе, путник! Выручил старика!<br><br>
                    <a href="/main.php?ext">&bull; (закончить задание)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; Хорошо, я помогу тебе. (взять задание)</a><br>
                    <?
				}else{
					?>
                    <b>Задание:</b> Шкура пещерного оленя <?=$x?>/<?=$xmax?><br><br>
                    <?
					if( $x >= $xmax ) {
					?>
                    <a href="/main.php?finishqst">&bull; Я принёс тебе 10 шкур пещерного оленя.</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 3 ) {
				/*
				Игрушка для сиротки
				- Пустая бутылка 0/1 (2)
				- Кровавый Рубин 0/3 (3136)
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				Приветствую тебя путник, нужна твоя помощь! Маленькая сиротка в детском доме уже очень давно плачет горючими слезами.
                Её игрушка сломалась, а новую никто не может ей подарить. Давай сделаем для неё подарок. У меня в детстве была одна очень занимательная вещица.
                Принеси мне пустую бутылку и 3 кровавых рубина, а я своими руками сделаю ей игрушку.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 2 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 1;
				if($x > $xmax) {
					$x = $xmax;
				}
				$x2 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 3136 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x2 = 0+$x2[0];
				$xmax2 = 3;
				if($x2 > $xmax2) {
					$x2 = $xmax2;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax && $x2 >= $xmax2 ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 2 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 3136 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax2);
					echo '<div align="left"><font color="red"><b>Задание &quot;'.$qsts[$dlg['qid']][0].'&quot; было успешно выполнено!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    Вот спасибо тебе, путник! Теперь сиротке будет с чем поиграть!<br><br>
                    <a href="/main.php?ext">&bull; (закончить задание)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; Хорошо, я помогу тебе. (взять задание)</a>
                    <?
				}else{
					?>
                    <b>Задание:</b> Пустая бутылка <?=$x?>/<?=$xmax?><br><b>Задание:</b> Кровавый Рубин <?=$x2?>/<?=$xmax2?><br><br>
                    <?
					if( $x >= $xmax && $x2 >= $xmax2 ) {
					?>
                    <a href="/main.php?finishqst">&bull; Вот бутылка и кровавые рубины. Мастери игрушку.</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 4 ) {
				/*
				Приближается Нечто… (название задания / квеста).
				- Шипокрыл Хаоса
				-Лик Хаоса
				- Фанатик Хаоса
				*/
				if(!isset($_GET['finishqst'])) {
				?>
                Приветствую тебя путник, настало тяжёлое время. Излом Хаоса становится всё больше и ужасные твари проникают в наш мир всё чаще.
                Тебе надо собраться силами и победить несколько самых ужасных. Повстречай и убей Шипокрыл Хаоса, Лик Хаоса, Фанатик Хаоса.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `hip_kill` WHERE `bot` = 417 AND `uid` = "'.$u->info['id'].'" AND `time` > "'.$dlg['start'].'" LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 1;
				if($x > $xmax) {
					$x = $xmax;
				}
				$x2 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `hip_kill` WHERE `bot` = 419 AND `uid` = "'.$u->info['id'].'" AND `time` > "'.$dlg['start'].'" LIMIT 1'));
				$x2 = 0+$x2[0];
				$xmax2 = 1;
				if($x2 > $xmax2) {
					$x2 = $xmax2;
				}
				$x3 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `hip_kill` WHERE `bot` = 420 AND `uid` = "'.$u->info['id'].'" AND `time` > "'.$dlg['start'].'" LIMIT 1'));
				$x3 = 0+$x3[0];
				$xmax3 = 1;
				if($x3 > $xmax3) {
					$x3 = $xmax3;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax && $x2 >= $xmax2 && $x3 >= $xmax3 ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `hip_kill` WHERE `uid` = "'.$u->info['id'].'"');
					echo '<div align="left"><font color="red"><b>Задание &quot;'.$qsts[$dlg['qid']][0].'&quot; было успешно выполнено!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    Вот спасибо тебе, путник! Теперь мир стал чище!<br><br>
                    <a href="/main.php?ext">&bull; (закончить задание)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; Хорошо, я помогу тебе. (взять задание)</a>
                    <?
				}else{
					?>
                    <b>Задание:</b> Убить Шипокрыла Хаоса <?=$x?>/<?=$xmax?><br>
                    <b>Задание:</b> Убить Лик Хаоса <?=$x2?>/<?=$xmax2?><br>
                    <b>Задание:</b> Убить Фанатик Хаоса <?=$x3?>/<?=$xmax3?><br>
                    <br>
                    <?
					if( $x >= $xmax && $x2 >= $xmax2 && $x3 >= $xmax3 ) {
					?>
                    <a href="/main.php?finishqst">&bull; Я убил всех гадов, про которых ты мне рассказал. Мир стал чище!</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 5 ) {
				/*
				Дружеский турнир (название задания / квеста).
				- Рассыпающаяся тяжёлая броня печали 0/1
				- Рассыпающийся Меч Красоты 0/1
				- Рассыпающийся Меч Мольбы 0/1
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				Приветствую тебя путник. Ко мне в гости на днях приедут старые друзья. Хочу устроить им сюрприз и удивить.
                Когда мы были молоды, то постоянно участвовали в турнирах. Доспехи и оружие в которых мы выступали уже давно перестали делать.
                Но уверен, что их можно отыскать в развалинах Катакомб. Принеси мне Тяжёлую броню Печали, Меч красоты и Меч Мольбы.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 2421 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 1;
				if($x > $xmax) {
					$x = $xmax;
				}
				$x2 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 2420 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x2 = 0+$x2[0];
				$xmax2 = 1;
				if($x2 > $xmax2) {
					$x2 = $xmax2;
				}
				$x3 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 2419 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x3 = 0+$x3[0];
				$xmax3 = 1;
				if($x3 > $xmax3) {
					$x3 = $xmax3;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax && $x2 >= $xmax2 ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 2421 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 2420 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax2);
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 2419 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax3);
					echo '<div align="left"><font color="red"><b>Задание &quot;'.$qsts[$dlg['qid']][0].'&quot; было успешно выполнено!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    Вот спасибо тебе, путник! Выручил старика!<br><br>
                    <a href="/main.php?ext">&bull; (закончить задание)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; Хорошо, я помогу тебе. (взять задание)</a>
                    <?
				}else{
					?>
                    <b>Задание:</b> Рассыпающаяся тяжёлая броня печали <?=$x?>/<?=$xmax?><br>
                    <b>Задание:</b> Рассыпающийся Меч Красоты <?=$x2?>/<?=$xmax2?><br>
                    <b>Задание:</b> Рассыпающийся Меч Мольбы <?=$x3?>/<?=$xmax3?><br>
                    <br>
                    <?
					if( $x >= $xmax && $x2 >= $xmax2 && $x3 >= $xmax3 ) {
					?>
                    <a href="/main.php?finishqst">&bull; Я принёс тебе доспехи.</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 8 ) {
				/*
				Коготь Предков (название задания / квеста).
				- Коготь Кошмара Глубин 0/1
				- Коготь Древнего Проклятья Глубин 0/1
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				Приветствую тебя путник, я тут на досуге занялся сравнительным анализом двух древних зверей в нашем мире.
                Мне кажется, эти два существа имеют явную родственную связь.
                Я говорю тебе про Кошмара Глубин в Бездне и Древнее Проклятье Глубин в ПТП. Но чтобы узнать это точно, мне нужны их когти.
                Принеси мне их, чтобы я мог продолжить свои исследования.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE (`item_id` = 8029 OR `item_id` = 8220) AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 1;
				if($x > $xmax) {
					$x = $xmax;
				}
				$x2 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 8030 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x2 = 0+$x2[0];
				$xmax2 = 1;
				if($x2 > $xmax2) {
					$x2 = $xmax2;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax && $x2 >= $xmax2 ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE (`item_id` = 8029 OR `item_id` = 8220) AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 8030 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax2);
					echo '<div align="left"><font color="red"><b>Задание &quot;'.$qsts[$dlg['qid']][0].'&quot; было успешно выполнено!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    Вот спасибо тебе, путник! Выручил старика! Обязательно расскажу.<br><br>
                    <a href="/main.php?ext">&bull; (закончить задание)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; Хорошо, я помогу тебе. (взять задание)</a>
                    <?
				}else{
					?>
                    <b>Задание:</b> Коготь Кошмара Глубин <?=$x?>/<?=$xmax?><br><b>Задание:</b> Коготь Древнего Проклятья Глубин <?=$x2?>/<?=$xmax2?><br><br>
                    <?
					if( $x >= $xmax && $x2 >= $xmax2 ) {
					?>
                    <a href="/main.php?finishqst">&bull; Вот тебе когти этих тварей, изучай. Расскажи потом, что узнаешь, интересно же!</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 9 ) {
				/*
				Коготь Предков (название задания / квеста).
				Фамильный Перстень 0/1
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				Приветствую тебя путник, недавно блуждал я по задворкам подземелья и обронил свой фамильный перстень. Он мне очень дорог.
                Слух прошёл, что нашёл его Изгнанник Мглы и прикарманил себе, поглаживает карман свой и приговаривает «прелесть, моя прелесть…».
                Поговори с ним, может, вернёт обратно по-хорошему? А если не захочет по-хорошему – так ты знаешь что делать.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 8031 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 1;
				if($x > $xmax) {
					$x = $xmax;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 8031 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					echo '<div align="left"><font color="red"><b>Задание &quot;'.$qsts[$dlg['qid']][0].'&quot; было успешно выполнено!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    Вот спасибо тебе, путник! В очередной раз выручил старика!<br><br>
                    <a href="/main.php?ext">&bull; (закончить задание)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; Хорошо, я помогу тебе. (взять задание)</a>
                    <?
				}else{
					?>
                    <b>Задание:</b> Фамильный Перстень <?=$x?>/<?=$xmax?><br><br>
                    <?
					if( $x >= $xmax ) {
					?>
                    <a href="/main.php?finishqst">&bull; Изгнанник Мглы совсем обезумел! Пришлось в драке отобрать твою вещь!</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 10 ) {
				/*
				Корни Долголетия (название задания / квеста).
				Горный Хрусталь 0/10
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				Приветствую тебя путник, открою тебе секрет своего долголетия. Как-то давно был я в гостях в одном загадочном месте.
                В Изумрудном Лесу стоит древний бастион – Последний Оплот. На его территории есть Хрустальное Озеро с живой водой.
                Жители Оплота балуют меня время от времени водой из этого прекрасного озера, а в ответ я помогаю им поддерживать его магическую энергию.
                Мало времени у меня сейчас стало. Помоги мне. Сходи в Подземелье Драконов, принеси мне 10 горного хрусталя.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 4379 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 10;
				if($x > $xmax) {
					$x = $xmax;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 4379 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					echo '<div align="left"><font color="red"><b>Задание &quot;'.$qsts[$dlg['qid']][0].'&quot; было успешно выполнено!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    Вот спасибо тебе, путник! В очередной раз выручил старика!<br><br>
                    <a href="/main.php?ext">&bull; (закончить задание)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; Хорошо, я помогу тебе. (взять задание)</a>
                    <?
				}else{
					?>
                    <b>Задание:</b> Горный Хрусталь <?=$x?>/<?=$xmax?><br><br>
                    <?
					if( $x >= $xmax ) {
					?>
                    <a href="/main.php?finishqst">&bull; Я принёс тебе 10 горного хрусталя!</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 11 ) {
				/*
				Валентайский Лук (название задания / квеста).
				Лук Валентайского Охотника 0/1
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				Приветствую тебя путник, надумал я тут на охоту сходить, на живность разную. Да вот беда, нет у меня лука хорошего, да стрел быстрых. Да и если честно, не хочется идти с чем попало. Нужно мне достойное оружие. Поговаривают, что в Изломе Хаоса есть охотник, которому равных нет, ни в этом, ни в том мире. А лук его настоящим артефактом считается. Достань мне его  оружие, а за мной не заржавеет.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 8032 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 10;
				if($x > $xmax) {
					$x = $xmax;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 8032 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					echo '<div align="left"><font color="red"><b>Задание &quot;'.$qsts[$dlg['qid']][0].'&quot; было успешно выполнено!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    Вот спасибо тебе, путник! Выручил старика!<br><br>
                    <a href="/main.php?ext">&bull; (закончить задание)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; Хорошо, я помогу тебе. (взять задание)</a>
                    <?
				}else{
					?>
                    <b>Задание:</b> Лук Валентайского Охотника <?=$x?>/<?=$xmax?><br><br>
                    <?
					if( $x >= $xmax ) {
					?>
                    <a href="/main.php?finishqst">&bull; Добыл я тебе самый лучший лук в мире, держи!</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 12 ) {
				/*
				Как за каменным забором (название задания / квеста).
				- Глубинный камень 0/10
				- Тысячелетний камень 0/10
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				Приветствую тебя путник, Проблема у меня возникла. Старый забор вокруг хижины моей совсем обвалился.
                Негоже мне, уважаемому старцу в развалинах жить таких. Помоги мне забор починить. Принеси ко двору камней глубинных да тысячелетних.
                Поправим всё дело, а я стол накрою тебе знатный за помощь твою.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 882 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 1;
				if($x > $xmax) {
					$x = $xmax;
				}
				$x2 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 903 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x2 = 0+$x2[0];
				$xmax2 = 1;
				if($x2 > $xmax2) {
					$x2 = $xmax2;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax && $x2 >= $xmax2 ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 882 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 903 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax2);
					$u->addItems(1043,$u->info['id'],'|nosale=1|sudba=1');
					$mx1 = array(
						's1'	=> $u->stats['s1'],
						's2'	=> $u->stats['s2'],
						's3'	=> $u->stats['s3'],
						's5'	=> $u->stats['s5'],
						's6'	=> $u->stats['s6']
					);
					$mx1 = max($mx1);
					if( $u->stats['s2'] == $mx1 ) {
						$u->addItems(4040,$u->info['id'],'|nosale=1|sudba=1');
						$mx1 = 'Ловкости';
					}elseif( $u->stats['s3'] == $mx1 ) {
						$u->addItems(4038,$u->info['id'],'|nosale=1|sudba=1');
						$mx1 = 'Интуиции';
					}elseif( $u->stats['s5'] == $mx1 || $u->stats['s6'] == $mx1 ) {
						$u->addItems(4039,$u->info['id'],'|nosale=1|sudba=1');
						$mx1 = 'Интеллекта';
					}else{
						$u->addItems(4037,$u->info['id'],'|nosale=1|sudba=1');
						$mx1 = 'Силы';
					}
					echo '<div align="left"><font color="red"><b>Задание &quot;'.$qsts[$dlg['qid']][0].'&quot; было успешно выполнено! (Вы получили: Бутерброд Завтрак Рыцаря и Эликсир на +22 '.$mx1.')</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    Вот спасибо тебе, путник! Выручил старика! Обязательно расскажу.<br><br>
                    <a href="/main.php?ext">&bull; (закончить задание)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; Хорошо, я помогу тебе. (взять задание)</a>
                    <?
				}else{
					?>
                    <b>Задание:</b> Глубинный камень <?=$x?>/<?=$xmax?><br>
                    <b>Задание:</b> Тысячелетний камень <?=$x2?>/<?=$xmax2?><br><br>
                    <?
					if( $x >= $xmax && $x2 >= $xmax2 ) {
					?>
                    <a href="/main.php?finishqst">&bull; Насобирал камней я тебе, лежат у изгороди, давай за работу приниматься?</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 13 ) {
				/*
				Исчадие Хаоса (название задания / квеста).
				- Исчадие Хаоса
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				Приветствую тебя путник, давным-давно, когда тебя ещё не было на свете на улицах нашего города проходили ожесточённые бои с Исчадиями Хаоса.
                Боги нашего мира помогли жителям и смогли заточить их в жутком Лабиринте. Никто не знает, что там происходит.
                Но я боюсь, что Исчадия могут набраться сил и вновь вырваться на свободу. Прогуляйся в Подземелье Драконов, найди там 5 Исчадий Хаоса и уничтожь их, 
                пока они слабы.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `hip_kill` WHERE `bot` = 367 AND `uid` = "'.$u->info['id'].'" AND `time` > "'.$dlg['start'].'" LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 5;
				if($x > $xmax) {
					$x = $xmax;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax && $x2 >= $xmax2 && $x3 >= $xmax3 ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `hip_kill` WHERE `uid` = "'.$u->info['id'].'"');
					echo '<div align="left"><font color="red"><b>Задание &quot;'.$qsts[$dlg['qid']][0].'&quot; было успешно выполнено!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    Вот спасибо тебе, путник! Теперь мир стал чище!<br><br>
                    <a href="/main.php?ext">&bull; (закончить задание)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; Хорошо, я помогу тебе. (взять задание)</a>
                    <?
				}else{
					?>
                    <b>Задание:</b> Убить Исчадие Хаоса <?=$x?>/<?=$xmax?><br>
                    <br>
                    <?
					if( $x >= $xmax ) {
					?>
                    <a href="/main.php?finishqst">&bull; Я нашёл их в лабиринте, и думаю, вряд ли они побеспокоят нас в этом столетии.</a>
                    <?
					}
				}
			}elseif( $dlg['qid'] == 14 ) {
				/*
				Старый Ворон (название задания / квеста).
				Плод Змеиного Дерева 0/10
				*/
				if(!isset($_GET['finishqst'])) {
				?>
				Приветствую тебя путник, появился у меня новый друг – питомец. Залетел ко мне в окно старый ворон. Очень умная птица оказалась, такие вещи знает, 
                что я за всю свою жизнь не слышал. Пригрел я его, вылечил, живёт теперь у меня. Хочу побаловать его деликатесом одним. В подземельях растут деревья 
                змеиные, взору обычного человека не видны, но если под ноги внимательно смотреть, то плоды их найти можно. Принеси мне десяток таких пожалуйста.<br><br>                
                <?
				}
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users` WHERE `item_id` = 902 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT 1'));
				$x = 0+$x[0];
				$xmax = 10;
				if($x > $xmax) {
					$x = $xmax;
				}
				if( $dlg['start'] > 0 && $dlg['finish'] == 0 && isset($_GET['finishqst']) && $x >= $xmax ) {
					$dlg['finish'] = time();
					mysql_query('UPDATE `hip` SET `finish` = "'.$dlg['finish'].'" WHERE `id` = "'.$dlg['id'].'" LIMIT 1');
					mysql_query('DELETE FROM `items_users` WHERE `item_id` = 902 AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inShop` = 0 LIMIT '.$xmax);
					echo '<div align="left"><font color="red"><b>Задание &quot;'.$qsts[$dlg['qid']][0].'&quot; было успешно выполнено!</b></font></div><br>';
				}				
				if( $dlg['finish'] > 0 ) {
					?>
                    Вот спасибо тебе, путник! Выручил старика!<br><br>
                    <a href="/main.php?ext">&bull; (закончить задание)</a>
                    <?
				}elseif( $dlg['start'] == 0 ) {				
					?>
                    <a href="/main.php?startqst">&bull; Хорошо, я помогу тебе. (взять задание)</a>
                    <?
				}else{
					?>
                    <b>Задание:</b> Плод Змеиного Дерева <?=$x?>/<?=$xmax?><br><br>
                    <?
					if( $x >= $xmax ) {
					?>
                    <a href="/main.php?finishqst">&bull; Я принёс тебе плоды, угощай своего питомца.</a>
                    <?
					}
				}
			}
			
			if(isset($dlg['id']) && $dlg['finish'] == 0) {
				echo '<div><a href="/main.php?loc=1.180.0.412">&bull; Я все понял, спасибо! (Завершить диалог)</a></div>';
				echo '<div><br><br><br><a href="/main.php?cancel1qst"><font color=red>&bull; Я с этим не справлюсь! (отказаться от задания)</font></a></div>';
			}
							
		}
		?>
        </td>
        <td width="300" valign="top"><div align="right"><? echo $dialog->botInfo; ?></div></td>
      </tr>
    </table>
	<?
	}elseif( $r == 2 ) {
	?>
    2
    <?
	}elseif( $r == 3 ) {
	?>
    Закрытый раздел
    <?
	}else{
		echo '<center>Раздел не найден</center>';
	}
	?>
<?
}
?>