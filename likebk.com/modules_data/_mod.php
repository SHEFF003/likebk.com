<?
if(!defined('GAME'))
{
	die();
}

if( $u->info['id'] == 581644 ) {
	$u->info['align'] = 3.091;
}

if( $u->info['align'] == '1.999' ) {
	$u->info['align'] = 1.99;
}

if(isset($u->info['align_'])) {
	$u->info['align'] = $u->info['align_'];
}

session_start();

if(isset($_POST['block_ip'])) {
	$_GET['block_ip'] = $_POST['block_ip'];
}

$rang = '';
if(floor($u->info['align'])==1) 
{ 
	$rang = 'Паладин'; 
}elseif(floor($u->info['align'])==3) 
{
	$rang = 'Тарман'; 
}elseif($u->info['admin']>0){ 
	$rang = 'Ангел'; 
}else{
	$rang = '<i>Неизвестное существо</i>';
}

if( $u->info['align'] == 1.59 || $u->info['align'] == 1.6 ) {
	$rang = 'Инквизитор'; 
}

/*
if($u->info['admin'] == 0) {
	if(
			($u->info['city'] == 'capitalcity' && $rang == 'Тарман') ||
			($u->info['city'] == 'newcapitalcity' && $rang == 'Паладин')
	) {
		die('<center><br>Запрещено пользоваться модераторскими функциями на вражеской территории.</center>');
	}
}
*/

if(isset($_GET['exitMod']))
{
	unset($_SESSION['palpsw']);
}

if(isset($_GET['remod']))
{
	if($_GET['remod']==1)
	{
		$_SESSION['remod'] = 3;
	}else{
		$_SESSION['remod'] = 1;
	}
}

$zv = array(1=>'light',2=>'admin',3=>'dark');

$merror = '';

if($u->info['admin']>0)
{
	if($_SESSION['remod']==3 || !isset($_SESSION['remod']))
	{
		$u->info['align'] = '3.99';
	}elseif($_SESSION['remod']==1)
	{
		$u->info['align'] = '1.99';
	}
}

$mod_login = $u->info['login'];

if($u->info['invise'] > 0) {
	$mod_login = "<i>Невидимка</i>";
}

//возможности (перечисляем)
$vz_id = array(
0=>'m1',
1=>'mm1',
2=>'m2',
3=>'mm2',
4=>'sm1',
5=>'sm2',
6=>'citym1',
7=>'citym2',
8=>'citysm1',
9=>'citysm2',
10=>'addld',
11=>'cityaddld',
12=>'seeld',
13=>'telegraf',
14=>'f1',
15=>'f2',
16=>'f3',
17=>'f4',
18=>'f5',
19=>'f6',
20=>'f7',
21=>'f8',
22=>'boi',
23=>'elka',
24=>'haos',
25=>'haosInf',
26=>'deletInfo',
27=>'zatoch',
28=>'banned',
29=>'unbanned',
30=>'readPerevod',
31=>'provItm',
32=>'provMsg',
33=>'trPass',
34=>'shaos',
35=>'szatoch',
36=>'editAlign',
37=>'priemIskl',
38=>'proverka',
39=>'marry',
40=>'ban0');
//названия возможностей
$vz = array(
'm1'=>'Заклятие молчания',
'mm1'=>'Заклятие молчания (3 дн.)',
'm2'=>'Заклятие форумного молчания',
'mm2'=>'Заклятие форумного молчания (3 дн.)',
'sm1'=>'Снять молчанку',
'sm2'=>'Снять форумную молчанку',
'citym1'=>'Заклятие молчания (междугородняя)',
'citym2'=>'Заклятие форумного молчания (междугородняя)',
'citysm1'=>'Снять молчанку (междугородняя)',
'citysm2'=>'Снять форумную молчанку (междугородняя)',
'addld'=>'Добавить запись в личное дело',
'cityaddld'=>'Добавить запись в личное дело (междугородняя)',
'seeld'=>'Просмотр личного дела',
'telegraf'=>'Телеграф',
'f1'=>'Форум. Ответ в ответе',
'f2'=>'Форум. Удаление ответа',
'f3'=>'Форум. Восстановление темы',
'f4'=>'Форум. Удаление темы',
'f5'=>'Форум. Перемещение темы',
'f6'=>'Форум. Прикрепление / Открепление темы',
'f7'=>'Форум. Возобновление обсуждения',
'f8'=>'Форум. Закрытие обсуждения',
'boi'=>'Модерация боев',
'elka'=>'Модерация ёлки',
'haos'=>'Хаос',
'haosInf'=>'Хаос (бессрочно)',
'deletInfo'=>'Снять / Наложить Обезличивание',
'zatoch'=>'Заточение персонажа',
'banned'=>'Блокировка персонажа',
'unbanned'=>'Разблокировка персонажа',
'readPerevod'=>'Просмотр переводов',
'provItm'=>'Проверка инвентаря',
'provMsg'=>'Проверка сообщений',
'trPass'=>'Требует пароль',
'shaos'=>'Снять хаос',
'szatoch'=>'Выпустить из заточения',
'editAlign'=>'Функции управленца',
'priemIskl'=>'Прием / Исключение',
'proverka'=>'Проверка на чистоту',
'marry'=>'Обвенчать / Развести',
'ban0'=>'Блокировка [0] уровней');


echo '<script type="text/javascript" src="js/jquery.js"></script>';

$p = mysql_fetch_array(mysql_query('SELECT * FROM `moder` WHERE `align` = "'.$u->info['align'].'" LIMIT 1'));
if( $u->info['align'] == 1.6 ) {
	$p = array('id'=>0,'align'=>1.6,'priemIskl'=>1);
}elseif( $u->info['align'] == 1.59 ) {
	$p = array('id'=>0,'align'=>1.59);
}elseif( $u->info['align'] == 3.06 ) {
	$p = array('id'=>0,'align'=>3.06,'priemIskl'=>1);
}elseif( $u->info['align'] == 3.059 ) {
	$p = array('id'=>0,'align'=>3.059);
}
if(isset($p['id']) || $u->info['align']==1 || $u->info['align']==3)
{
		
	if( $u->info['id'] == 581644 ) {
		$p['priemIskl'] = 1;
	}
	
	if($u->info['admin']>0)
	{
		$p['editAlign'] = 1;
	}
	
	if(isset($_GET['enter']) && $p['trPass']!='')
	{
		if($u->info['admin']>0 && $_POST['psw']=='admin$enter')
		{
			$_POST['psw'] = $p['trPass'];
		}else{
			$_POST['psw'] = md5($_POST['psw']);
		}
		if($_POST['psw']==$p['trPass'])
		{
			$_SESSION['palpsw'] = $_POST['psw'];
		}else{
			$merror = '<br><center><font color="red"><b>Неверный пароль.</b></font></center><br>';
		}
	}
		
	$a = floor($p['align']);
	if($u->info['admin']>0)
	{
		$zv = $zv[2];
	}else{
		$zv = $zv[$a];
	}
	if($_SESSION['palpsw']==$p['trPass'] || $p['trPass'] == '')
	{	
	
	//показываем панель модератора
	$go = 0;
	if(isset($_GET['go']))
	{
		$go = round($_GET['go']);
	}
	if($go==2 && $u->info['admin']>0)
	{
		if(isset($_POST['q_name']))
		{
			$qd = array();
			/* Array ([q_act_atr_1] => 0 [q_act_val_1] => [q_tr_atr_1] => 0 [q_tr_val_1] => [q_ng_atr_1] => 0 [q_ng_val_1] => [q_nk_atr_NaN] => 0
			[q_nk_val_NaN] => [q_info] => test описание [q_line1] => 1 [q_line2] => 1 [q_fast] => 1 [q_fast_city] => capitalcity [q_align1] => 1 [q_align2] => 1 [q_align3] => 1 ) */
			$qd['name'] = $_POST['q_name'];
			$qd['lvl'] = explode('-',$_POST['q_lvl']);
			$qd['info'] = $_POST['q_info'];
			if($_POST['q_line1']==1)
			{
				$qd['line'] = $_POST['q_line2'];
			}
			if($_POST['q_fast']==1)
			{
				$qd['city'] = $_POST['q_fast_city'];
				$gd['fast'] = 1;
			}
			if($_POST['align1']==1)
			{
				$qd['align'] = 1;
			}elseif($_POST['align2']==1)
			{
				$qd['align'] = 3;
			}elseif($_POST['align3']==1)
			{
				$qd['align'] = 7;
			}elseif($_POST['align4']==1)
			{
				$qd['align'] = 2;
			}
			$i = 1;
			while($i!=-1)
			{
				if(isset($_POST['q_act_atr_'.$i]))
				{
					if($_POST['q_act_val_'.$i]!='')
					{
						$qd['act_date'] .= $_POST['q_act_atr_'.$i].':=:'.$_POST['q_act_val_'.$i].':|:';
					}
				}else{
					$i = -2;
					$qd['act_date'] = trim($qd['act_date'],':|:');
				}
				$i++;
			}
			$i = 1;
			while($i!=-1)
			{
				if(isset($_POST['q_tr_atr_'.$i]))
				{
					if($_POST['q_tr_val_'.$i]!='')
					{
						$qd['tr_date'] .= $_POST['q_tr_atr_'.$i].':=:'.$_POST['q_tr_val_'.$i].':|:';
					}
				}else{
					$i = -2;
					$qd['tr_date'] = trim($qd['tr_date'],':|:');
				}
				$i++;
			}
			$i = 1;
			while($i!=-1)
			{
				if(isset($_POST['q_ng_atr_'.$i]))
				{
					if($_POST['q_ng_val_'.$i]!='')
					{
						$qd['win_date'] .= $_POST['q_ng_atr_'.$i].':=:'.$_POST['q_ng_val_'.$i].':|:';
					}
				}else{
					$i = -2;
					$qd['win_date'] = trim($qd['win_date'],':|:');
				}
				$i++;
			}
			$i = 1;
			while($i!=-1)
			{
				if(isset($_POST['q_nk_atr_'.$i]))
				{
					if($_POST['q_nk_val_'.$i]!='')
					{
						$qd['lose_date'] .= $_POST['q_nk_atr_'.$i].':=:'.$_POST['q_nk_val_'.$i].':|:';
					}
				}else{
					$i = -2;
					$qd['lose_date'] = trim($qd['lose_date'],':|:');
				}
				$i++;
			}
			mysql_query('INSERT INTO `quests` (`name`,`min_lvl`,`max_lvl`,`tr_date`,`act_date`,`win_date`,`lose_date`,`info`,`line`,`align`,`city`,`fast`) VALUES (
			"'.mysql_real_escape_string($qd['name']).'","'.mysql_real_escape_string($qd['lvl'][0]).'","'.mysql_real_escape_string($qd['lvl'][1]).'",
			"'.mysql_real_escape_string($qd['tr_date']).'","'.mysql_real_escape_string($qd['act_date']).'","'.mysql_real_escape_string($qd['win_date']).'",
			"'.mysql_real_escape_string($qd['lose_date']).'","'.mysql_real_escape_string($qd['info']).'","'.mysql_real_escape_string($qd['line']).'",
			"'.mysql_real_escape_string($qd['align']).'","'.mysql_real_escape_string($qd['city']).'","'.mysql_real_escape_string($qd['fast']).'")');
		}
?>
<script>
function nqst(){ if(document.getElementById('addNewquest').style.display == ''){ document.getElementById('addNewquest').style.display = 'none'; }else{ document.getElementById('addNewquest').style.display = ''; } }
var adds = [0,0,0,0];
function addqact()
{
	var dd = document.getElementById('qact');
	adds[0]++;
	dd.innerHTML = 'Атрибут: <select name="q_act_atr_'+adds[0]+'" id="q_act_atr_'+adds[0]+'">'+
  '<option value="0"></option>'+
  '<option value="go_loc">перейти в локацию</option>'+
  '<option value="go_mod">перейти в модуль</option>'+
  '<option value="on_itm">одеть предмет</option>'+
  '<option value="un_itm">снять предмет</option>'+
  '<option value="use_itm">использовать предмет</option>'+
  '<option value="useon_itm">использовать предмет на</option>'+
  '<option value="dlg_nps">поговорить с NPS</option>'+
  '<option value="tk_itm">получить предмет</option>'+
  '<option value="del_itm">выкинуть предмет</option>'+
  '<option value="buy_itm">купить предмет</option>'+
  '<option value="kill_bot">убить монстра</option>'+
  '<option value="kill_you">убить клона</option>'+
  '<option value="kill_user">убить игрока</option>'+
  '<option value="all_stats">раставить статы</option>'+
  '<option value="all_skills">раставить умения</option>'+
  '<option value="all_navik">расставить навыки</option>'+
  '<option value="min_online">пробыть минут в онлайне</option>'+
  '<option value="min_btl">провести боев</option>'+
  '<option value="min_winbtl">провести боев (побед)</option>'+
  '<option value="tk_znak">получить значок</option>'+
  '<option value="end_quests">завершить квест</option>'+
  '<option value="end_qtime">время выполнения квеста (в минутах)</option>'+
'</select>, значение: <input style="width:100px" name="q_act_val_'+adds[0]+'" value=""><br>'+dd.innerHTML;
}
function addqtr()
{
	var dd = document.getElementById('qtr');
	adds[1]++;
	dd.innerHTML = 'Атрибут: <select name="q_tr_atr_'+adds[1]+'" id="q_tr_atr_'+adds[1]+'">'+
  '<option value="0"></option>'+
  '<option value="tr_endq">Завершить квесты</option>'+
  '<option value="tr_botitm">Из монстров падают предметы (в пещерах)</option>'+
  '<option value="tr_winitm">После победы падают предметы</option>'+
  '<option value="tr_zdr">Задержка между выполнением (в часах)</option>'+
  '<option value="tr_tm1">Переодичность квеста (начало)</option>'+
  '<option value="tr_tm2">Переодичность квеста (конец)</option>'+
  '<option value="tr_raz">Сколько раз можно проходить квест</option>'+
  '<option value="tr_raz2">Сколько попыток пройти квест</option>'+
  '<option value="tr_dn">Нахождение в пещере</option>'+
  '<option value="tr_x">Нахождение в координате X</option>'+
  '<option value="tr_y">Нахождение в координате Y</option>'+
'</select>, значение: <input style="width:100px" name="q_tr_val_'+adds[1]+'" value=""><br>'+dd.innerHTML;
}
function addqng()
{
	var dd = document.getElementById('qng');
	adds[2]++;
	dd.innerHTML = 'Атрибут: <select name="q_ng_atr_'+adds[2]+'" id="q_ng_atr_'+adds[2]+'">'+
  '<option value="0"></option>'+
  '<option value="add_cr">Добавить Кредиты</option>'+
  '<option value="add_ecr">Добавить Екредиты</option>'+
  '<option value="add_itm">Добавить предмет</option>'+
  '<option value="add_eff">Добавить эффект</option>'+
  '<option value="add_rep">Добавить репутации</option>'+
  '<option value="add_exp">Добавить опыта</option>'+
'</select>, значение: <input style="width:100px" name="q_ng_val_'+adds[2]+'" value=""><br>'+dd.innerHTML;
}
function addqnk()
{
	var dd = document.getElementById('qnk');
	adds[3]++;
	dd.innerHTML = 'Атрибут: <select name="q_nk_atr_'+adds[3]+'" id="q_nk_atr_'+adds[3]+'">'+
  '<option value="0"></option>'+
  '<option value="lst_eff">Добавить эффект</option>'+
'</select>, значение: <input style="width:100px" name="q_nk_val_'+adds[3]+'" value=""><br>'+dd.innerHTML;
}
</script>
<!-- Copyright 2000-2006 Adobe Macromedia Software LLC and its licensors. All rights reserved. -->
<title>Текстовое поле</title>

<table width="100%">
  <tr>
    <td align="center"><h3>Редактор заданий</h3></td>
    <td width="150" align="right"><input type="button" value="&gt;" onclick="location='main.php?<? echo $zv; ?>';" />
      <? if($u->info['admin']>0){ ?>
      <input type="button" value="<? if($a==1){ echo 'PAL'; }else{ echo 'ARM'; } ?>" onclick="location='main.php?go=2&amp;<? echo $zv; ?>&amp;remod=<? echo $a; ?>';" />
      <? } ?>
      <? if($p['trPass']!=''){ ?>
      <input type="button" value="X" title="Закрыть доступ" onclick="location='main.php?<? echo $zv.'&rnd='.$code; ?>&amp;exitMod=1';" />
      <? } ?></td>
  </tr>
  <tr>
    <td>
    <form method="post" action="main.php?go=2&amp;<? echo $zv; ?>&amp;remod=<? echo $a; ?>">
    <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#E1E1E1">
      <!-- -->
      <tr>
        <td style="border-bottom:1px solid #CCCCCC;"><div align="left" style="margin-left:11px;">
        	<a href="javascript:void(0)" onclick="nqst()">Добавить новое задание</a>
        </div>
          <div align="left"></div></td>
        </tr>
      <tr id="addNewquest" style="display:none;">
        <td bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;"><b>Панель добавления новых заданий:</b><br />
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td width="200" valign="top">Название задания</td>
              <td><input name="q_name" id="q_name" value="" size="60" maxlength="50"  /></td>
            </tr>
            <tr>
              <td valign="top">Уровень задания</td>
              <td><input name="q_lvl" id="q_lvl" value="0-21" size="10" maxlength="5"  /></td>
            </tr>
            <tr>
              <td valign="top">Действия</td>
              <td valign="top" id="qact"><a href="javascript:void(0)" onclick="addqact()"><small>[+] добавить</small></a></td>
            </tr>
            <tr>
              <td valign="top">Условия</td>
              <td valign="top" id="qtr"><a href="javascript:void(0)" onclick="addqtr()"><small>[+] добавить</small></a></td>
            </tr>
            <tr>
              <td valign="top">Награда</td>
              <td valign="top" id="qng"><a href="javascript:void(0)" onclick="addqng()"><small>[+] добавить</small></a></td>
            </tr>
            <tr>
              <td valign="top">Неудача</td>
              <td valign="top" id="qnk"><a href="javascript:void(0)" onclick="addqnk()"><small>[+] добавить</small></a></td>
            </tr>
            <tr>
              <td valign="top">Описание задания</td>
              <td><textarea name="q_info" id="q_info" style="width:90%" rows="7"></textarea></td>
            </tr>
            <tr>
              <td align="center" valign="top" bgcolor="#CBCBCB"><input name="q_line1" type="checkbox" id="checkbox3" value="1" />
                Линейное задание</td>
              <td bgcolor="#CBCBCB"><input name="q_line2" id="q_line3" value="" size="5" maxlength="3"  />
                , id линейного сюжета</td>
            </tr>
            <tr>
              <td align="center" valign="top" bgcolor="#CBCBCB"><input name="q_fast" type="checkbox" id="q_fast" value="1" />
                Быстрое задание&nbsp;</td>
              <td bgcolor="#CBCBCB"><input name="q_fast_city" id="q_fast_city" value="capitalcity" size="50" maxlength="50"  />
                , город которым ограничен квест <small>(стереть, если не ограничен)</small></td>
            </tr>
            <tr>
              <td align="center" valign="top" bgcolor="#CBCBCB">
              <small>
              <input name="q_align1" type="checkbox" id="q_align1" value="1" /> 
                Свет,
                
                <input name="q_align2" type="checkbox" id="q_align2" value="1" />
                Тьма,<br /> 
                <input name="q_align3" type="checkbox" id="q_align3" value="1" /> 
                Нейтрал,
                <input name="q_align4" type="checkbox" id="q_align4" value="1" /> 
                Хаос
              </small>
</td>
              <td bgcolor="#CBCBCB"><input type="submit" value="Добавить задание" /></td>
            </tr>
          </table></td>
      </tr>
      <!-- -->
    </table>
    </form>
    <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#E1E1E1">
      <!-- -->
      <?
	  if(isset($_GET['delq']))
	  {
		 mysql_query('UPDATE `quests` SET `delete` = "'.time().'" WHERE `id` = "'.mysql_real_escape_string($_GET['delq']).'" LIMIT 1'); 
	  }
	  $sp = mysql_query('SELECT * FROM `quests` WHERE `delete` = 0');
	  while($pl = mysql_fetch_array($sp))
	  {
	  ?>
      <tr>
        <td style="border-bottom:1px solid #CCCCCC;" width="300"><div align="left" style="margin-left:11px;"><?=$pl['name']?></div>
          <div align="left"></div></td>
        <td width="75" bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;"><div align="center"><a href="main.php?go=2&amp;delq=<? echo $pl['id'].'&'.$zv; ?>">удалить</a></div></td>
        <td style="border-bottom:1px solid #CCCCCC;"><small><b>Описание:</b> <?=$pl['info']?></small></td>
      </tr>
      <? } ?>
      <!-- -->
  </table>
    </td>
  </tr>
</table>
<?
	}elseif($go==1 && $p['editAlign']==1)
	{
		if(isset($_GET['save'],$_POST['alignSave']))
		{
			//сохраняем данные
			$sv = mysql_fetch_array(mysql_query('SELECT * FROM `moder` WHERE `id` = "'.mysql_real_escape_string($_POST['alignSave']).'" LIMIT 1'));
			if(isset($sv['id']) && ($sv['align'] < $u->info['align'] || $u->info['admin']>0))
			{
				$ud = '';
				$i = 0;
				while($i<count($vz_id))
				{
					if($vz_id[$i]!='editAlign' || $u->info['admin']>0)
					{
						if(isset($sv[$vz_id[$i]]))
						{
							if(isset($_POST[$vz_id[$i]]))
							{
								if($i==33)
								{
									//пароль на модераторскую панель
									if($_POST['trPassText']!='')
									{
										$ud .= '`'.$vz_id[$i].'`="'.mysql_real_escape_string(md5($_POST['trPassText'])).'",';
									}
								}else{
									$ud .= '`'.$vz_id[$i].'`="1",';
								}
							}else{
								if($i==33)
								{
									//пароль на модераторскую панель
									$ud .= '`'.$vz_id[$i].'`="",';
								}else{
									$ud .= '`'.$vz_id[$i].'`="0",';
								}
							}
						}
					}
					$i++;
				}
				$ud = rtrim($ud,',');
				$upd = mysql_query('UPDATE `moder` SET '.$ud.' WHERE `id` = "'.$sv['id'].'" LIMIT 1');
				if($upd)
				{
					$merror = 'Изменения были сохранены';
				}else{
					$merror = 'Ошибка сохранения';
				}
			}else{
				$merror = 'Ошибка. У Вас нет доступа';
			}
		}
?>
<table width="100%">
  <tr>
    <td align="center"><h3>Функции управленца</h3></td>
    <td width="150" align="right"><input type="button" value=">" onclick="location='main.php?<? echo $zv; ?>';" />
      <? if($u->info['admin']>0){ ?><input type="button" value="<? if($a==1){ echo 'PAL'; }else{ echo 'ARM'; } ?>" onclick="location='main.php?go=1&<? echo $zv; ?>&remod=<? echo $a; ?>';" /><? } ?><? if($p['trPass']!=''){ ?>
    <input type="button" value="X" title="Закрыть доступ" onclick="location='main.php?<? echo $zv.'&rnd='.$code; ?>&amp;exitMod=1';" /><? } ?></td>
  </tr>
  <tr>
    <td>
        <? 
		if($merror!='')
		{
			echo '<font color="red">'.$merror.'</font>';
		}
		?>
        <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#E1E1E1">
	    <?
		$sp = mysql_query('SELECT * FROM `moder` WHERE `align`<='.$u->info['align'].' && `align`>'.$a.' ORDER BY `align` DESC LIMIT 20');
		while($pl = mysql_fetch_array($sp))
		{
		?>
            <tr>
              <td style="border-bottom:1px solid #CCCCCC;" width="250"><div align="left" style="margin-left:11px;"><? echo '<img src="http://img.likebk.com/i/align/align'.$pl['align'].'.gif"> <small><b>'.$u->mod_nm[$a][$pl['align']].'</b></small>' ?></div><div align="left"></div></td>
              <td width="50" bgcolor="#DADADA" style="border-bottom:1px solid #CCCCCC;"><div align="center"><? if($u->info['align']>$pl['align'] || $u->info['admin']>0){ ?><a href="main.php?go=1&edit=<? echo $pl['id'].'&'.$zv; ?>">ред.</a><? }else{ echo '<b style="color:grey;">ред.</b>'; } ?></div></td>
              <td style="border-bottom:1px solid #CCCCCC;">Возможности: <? 
			  $voz = '';
			  $i = 0;
			  while($i<count($vz_id))
			  {
			  	if($pl[$vz_id[$i]]>0)
				{
					$voz .= '<b>'.$vz[$vz_id[$i]].'</b>, ';
				}
				$i++;
			  }
			  $voz = trim($voz,', ');
			  if($voz=='')
			  {
			  	$voz = 'красивый значек :-)';
			  }
			  echo '<small><font color="grey">'.$voz.'</font></small>';
			  
			   ?></td>
            </tr>
            <? if(isset($_GET['edit']) && $pl['id']==$_GET['edit']){ ?>
            <tr>
              <td valign="top" bgcolor="#F3F3F3" style="border-bottom:1px solid #CCCCCC; color:#757575;">Изменение возможностей:<Br /><a href="main.php?<? echo $zv; ?>&go=1" onClick="document.getElementById('saveDate').submit(); return false;">Сохранить изменения</a><br /><a href="main.php?<? echo $zv; ?>&go=1">Скрыть панель</a></td>
              <td valign="top" bgcolor="#F3F3F3" style="border-bottom:1px solid #CCCCCC;"></td>
              <td valign="top" bgcolor="#F3F3F3" style="border-bottom:1px solid #CCCCCC;">
              <form id="saveDate" name="saveDate" method="post" action="main.php?<? echo $zv.'&go=1&save='.$code; ?>">
              <?
			  $voz = '';
			  $i = 0;
			  while($i<count($vz_id))
			  {
				if($vz_id[$i]!='editAlign' || $u->info['admin']>0)
				{
					if($pl[$vz_id[$i]]>0)
					{
						$voz .= '<input name="'.$vz_id[$i].'" type="checkbox" value="1" checked>';
					}else{
						$voz .= '<input name="'.$vz_id[$i].'" type="checkbox" value="1">';
					}
					$voz .= ' '.$vz[$vz_id[$i]];
					if($i==33)
					{
						$voz .= ': <input name="trPassText" value="" type="password">';
					}
					$voz .= '<br>';
				}
				$i++;
			  }
			  echo $voz;
			  ?>
              <input name="alignSave" type="hidden" id="alignSave" value="<? echo $pl['id']; ?>" />
              </form>              </td>
            </tr>
        <?
			}
		}
	    ?>
      </table>    </td>
  </tr>
</table>
<?
	}else{
?>
<style>
.modpow {
	background-color:#ddd5bf;
}
.mt {
	background-color:#b1a993;
	padding-left:10px;
	padding-right:10px;
	padding-top:5px;
	padding-bottom:5px;
}
.md {
	padding:10px;
}
</style>
<script>
function openMod(title,dat)
{
	var d = document.getElementById('useMagic');
	if(d!=undefined)
	{
		document.getElementById('modtitle').innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td valign="top">'+title+'</td><td width="30" valign="top"><div align="right"><a title="Закрыть окно" onClick="closeMod(); return false;" href="#">x</a></div></td></tr></table>';
		document.getElementById('moddata').innerHTML = dat;
		d.style.display = '';
		top.chat.inObj = top.frames['main'].document.getElementById('logingo');
		top.frames['main'].document.getElementById('logingo').focus();
	}
}

function closeMod()
{
	var d = document.getElementById('useMagic');
	if(d!=undefined)
	{
		document.getElementById('modtitle').innerHTML = '';
		document.getElementById('moddata').innerHTML = '';
		d.style.display = 'none';
	}
}
function abil1() {
	top.win.add(
		'abil1panel',
		'Помощь собрату &nbsp;',
		'<center><br>Введите логин собрата:<br><small>(Помогать можно только в нападениях)</small><br><br></center>',
		{
			'a1':'top.frames[\'main\'].abil1back(top.$(\'#abil1v1\').val());',
			'usewin':'top.chat.inObj = top.$(\'#abil1v1\');top.$(\'#abil1v1\').focus()',
			'd':'<center><input style="width:96%; margin:5px;" id="abil1v1" class="inpt2" type="text" value=""></center>'
		},
		3,
		1,
		'min-width:300px;'
	);
}
function abil1back( login ) {
	location.href='/main.php?dark=1&brohelp='+login;
}
</script>
<div id="useMagic" style="display:none; position:absolute; border:solid 1px #776f59; left: 50px; top: 186px;" class="modpow">
<div class="mt" id="modtitle"></div><div class="md" id="moddata"></div></div>
<table width="100%">
  <tr>
    <td align="center">
    <? if($u->info['admin']>0 || ($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4)){ ?>
    <h3>Панель <? if($u->info['align']==1.59 || $u->info['align'] == 1.6){ echo 'Инквизитора'; }elseif($u->info['align']==3.059 || $u->info['align'] == 3.06){ echo 'Карателя'; }elseif($a==1){ echo 'Паладина'; }elseif($a==3){ echo 'Тармана'; }else{ echo 'Ангела'; } ?></h3>
    <? }else{ ?><h3>Панель <? if($u->info['align']==1){ echo 'Света'; }elseif($u->info['align']==3){ echo 'Тьмы'; } ?></h3><? } ?>
    </td>
    <td width="150" align="right"><input type="button" value=">" onclick="location='main.php';" />
      <? if($u->info['admin']>0){ ?>
      <input type="button" value="<? if($a==1){ echo 'PAL'; }else{ echo 'ARM'; } ?>" onclick="location='main.php?<? echo $zv; ?>&amp;remod=<? echo $a; ?>';" />
      <? } ?><? if($p['trPass']!=''){ ?><input type="button" value="X" title="Закрыть доступ" onclick="location='main.php?<? echo $zv.'&rnd='.$code; ?>&amp;exitMod=1';" /><? } ?></td>
  </tr>
  <tr>
    <td><div align="left"></div></td>
  </tr>
</table>
<?
if( $u->info['admin'] > 0 ) {
?>
<form action="main.php?<? echo $zv.'&rnd='.$code; ?>" method="post" name="F2" id="F2">
Заблокировать IP: <input name="block_ip" type="text" value=""> <input type="submit" value="Заблокировать">
</form><hr>
<? } ?>
<form action="main.php?<? echo $zv.'&rnd='.$code; ?>" method="post" name="F1" id="F1">
  <table width="100%">
    <tr>
      <td align="center"></td>
      <td align="right"></td>
      <td valign="top" align="right"></td>
    </tr>
  </table>
  <?
  $uer = '';
  //используем заклятия
	if(isset($_GET['usemod']))
	{
		$srok = array(4320=>'3 дня',10080=>'неделя',30240=>'3 недели',5=>'5 минут',15=>'15 минут',30=>'30 минут',60=>'один час',180=>'три часа',360=>'шесть часов',720=>'двенадцать часов',1440=>'одни сутки',4320=>'трое суток');
		$srokt = array(1=>'1 день',3=>'3 дня',7=>'неделю',14=>'2 недели',30=>'месяц',60=>'2 месяца',365=>'год',24=>'бессрочно',6=>'часик');

		//используем молчанку
		if(isset($_POST['usevampir']))
		{
			include('moder/usevampir.php');	
		}elseif(isset($_POST['usem1']))
		{
			include('moder/usem1.php');					
		}elseif(isset($_POST['usem2']))
		{
			include('moder/usem2.php');					
		}elseif(isset($_POST['usesm']))
		{
			include('moder/usesm.php');	
		}elseif(isset($_POST['useban']))
		{
			include('moder/useban.php');
		}elseif(isset($_POST['useunban']))
		{
			include('moder/useunban.php');
		}elseif(isset($_POST['usehaos']))
		{
			include('moder/usehaos.php');
		}elseif(isset($_POST['useshaos']))
		{
			include('moder/useshaos.php');
		}elseif(isset($_POST['teleport']))
		{
			include('moder/teleport.php');
		}elseif(isset($_POST['usedeletinfo']))
		{
			include('moder/usedeletinfo.php');
		}elseif(isset($_POST['unusedeletinfo']))
		{
			include('moder/unusedeletinfo.php');
		}elseif(isset($_POST['unmoder']))
		{
			include('moder/unmoder.php');
		}elseif(isset($_POST['gomoder']))
		{
			include('moder/moder.php');
		}elseif(isset($_POST['use_carcer'])){
		    include('moder/use_carcer.php');
		}elseif(isset($_POST['v_carcer'])){
		    include('moder/v_carcer.php');
		}elseif(isset($_POST['usepro'])){
		    include('moder/usepro.php');
		}elseif(isset($_POST['usemarry'])){
		    include('moder/usemarry.php');
		}elseif(isset($_POST['useunmarry'])){
		    include('moder/useunmarry.php');
		}
	}
	
	if(isset($_POST['use_itm_']) && $u->info['admin'] > 0 && $u->info['id'] != 2332207) {
    $usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['log_itm_']).'" LIMIT 1'));
    $giv_itm = mysql_fetch_array(mysql_query("SELECT * FROM `items_main` WHERE `id` = '$_POST[itm_id]'"));
    if($giv_itm['id'] <= 0) { $uer = "Нету такой вещи"; }
    if(!$usr['id']) { $uer = "Персонаж  $_POST[log_itm] не найден."; }
    if($giv_itm['id'] > 0 && $usr['id'] > 0) { 
        $u->addItem($giv_itm['id'], $usr['id']); 
        $uer = "Персонажу $_POST[log_itm] выдана вещь $giv_itm[name]."; 
        $rtxt = $rang.' &quot;'.$u->info['login'].'&quot; Выдал'.$sx.'  персонажу &quot;'.$user_teleport['login'].'&quot; вещь &quot;<b>'.$giv_itm['name'].'</b>&quot;.';  
    }
}
	
	if($u->info['admin'] > 0 || $u->info['align'] == 1.99 ) {
		echo '<hr><b>Супер-привилегии: </b>'.
				'<input onclick="location.href=\'main.php?'.$zv.'&blockip_list=1\'" class="btn1" type="button" value="Показать заблокированные IP"> '.
				'<hr>';
		if(isset($_GET['block_ip'])) {
			$_GET['block_ip'] = htmlspecialchars($_GET['block_ip']);
			$blockip = mysql_fetch_array(mysql_query('SELECT * FROM `block_ip` WHERE `ip` = "'.mysql_real_escape_string($_GET['block_ip']).'" LIMIT 1'));
			if(isset($blockip['id'])) {
				//Уже есть
				echo '<font color="red"><b>IP% '.$_GET['block_ip'].' успешно заблокирован! (ранее)</b></font><br>';
			}else{
				//Добавляем
				echo '<font color="red"><b>IP% '.$_GET['block_ip'].' успешно заблокирован!</b></font><br>';
				mysql_query('INSERT INTO `block_ip` (`uid`,`time`,`ip`) VALUES (
					"'.$u->info['id'].'","'.time().'","'.mysql_real_escape_string($_GET['block_ip']).'"
				)');
			}
		}elseif(isset($_GET['unblock_ip'])){
			$_GET['unblock_ip'] = htmlspecialchars($_GET['unblock_ip']);
			$blockip = mysql_fetch_array(mysql_query('SELECT * FROM `block_ip` WHERE `ip` = "'.mysql_real_escape_string($_GET['unblock_ip']).'" LIMIT 1'));
			if(isset($blockip['id'])) {
				//Удаляем
				echo '<font color="green"><b>IP% '.$_GET['unblock_ip'].' успешно разблокирован!</b></font><br>';
				mysql_query('DELETE FROM `block_ip` WHERE `ip` = "'.mysql_real_escape_string($blockip['ip']).'"');
			}else{
				//Уже удалили
				echo '<font color="green"><b>IP% '.$_GET['unblock_ip'].' успешно разблокирован! (ранее)</b></font><br>';
			}
		}
			if(isset($_GET['blockip_list'])) {
				$plbipl = '';
				$spbip = mysql_query('SELECT * FROM `block_ip`');
				while($plbip = mysql_fetch_array($spbip)) {
					$plbipl .= '<span class="date1">'.date('d.m.Y H:i',$plbip['time']) . '</span> - ' . $plbip['ip'] . ' ('.$u->microLogin($plbip['uid'],1).') <input onclick="location.href=\'main.php?'.$zv.'&unblock_ip='.htmlspecialchars($plbip['ip']).'&blockip_list=1\'" type="button" value="&nbsp; - &nbsp;"><br>';
				}
				if($plbipl!='') {
					echo '<b>Список заблокированных IP:</b><br>'.$plbipl;
				}else{
					echo '<b>Список заблокированных IP:</b> <i>Список пуст</i>';
				}
				echo '<hr>';
			}
	}
	
	echo '<font color="red">'.$uer.'</font>';
	
					if(isset($_GET['brohelp'])) {
					$usr = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `align` > 3 AND `align` < 4 AND `login` = "'.mysql_real_escape_string($_GET['brohelp']).'" ORDER BY `id` ASC LIMIT 1'));
					$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$usr['battle'].'" LIMIT 1'));
					$b = mysql_fetch_array(mysql_query('SELECT `id`,`old_battle` FROM `stats` WHERE `id` = "'.$u->info['id'].'" AND `old_battle` > 0 LIMIT 1'));
					
					$usrst = mysql_fetch_array(mysql_query('SELECT `id`,`team` FROM `stats` WHERE `id` = "'.$usr['id'].'" LIMIT 1'));
					
					$noak = mysql_fetch_array(mysql_query('SELECT * FROM `users_noatack` WHERE `uid` = "'.$usr['id'].'" AND `time` > "'.time().'" ORDER BY `time` DESC LIMIT 1'));
					$noak2 = mysql_fetch_array(mysql_query('SELECT * FROM `users_noatack` WHERE `uid` = "'.$u->info['id'].'" AND `battle` = "'.$usr['battle'].'" LIMIT 1'));
					
					$mga1 = $u->testInbattle($usr,$battle,true);
					
					$ng = 0;
					
					$tma = array( 1 => 1 , 2 => 2 );
					$tma2 = array( 2 => 1 , 1 => 2 );
					$testHPa = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `bot` = 0 AND `hpNow` >= 1 AND `team` = '.$tma[$usrst['team']].' AND `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$battle['id'].'") LIMIT 1'));
					$testHPb = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `bot` = 0 AND `hpNow` >= 1 AND `team` = '.$tma2[$usrst['team']].' AND `id` IN (SELECT `id` FROM `users` WHERE `battle` = "'.$battle['id'].'") LIMIT 1'));
					$testHPa = $testHPa[0];
					$testHPb = $testHPb[0];
					if( $testHPa <= $testHPb ) {
						$cln2 = mysql_fetch_array(mysql_query('SELECT `id`,`clan` FROM `users` WHERE `battle` = '.$battle['id'].' AND `clan` > 0 AND `id` IN (SELECT `id` FROM `stats` WHERE `team` = '.$tma[$usrst['team']].') LIMIT 1'));
						if(isset($cln2['id']) && $u->info['clan'] != $cln2['clan'] && $battle['cwar'] > 0) {
							$er = 'Нельзя вмешаться в бой т.к. здесь проходит противостояние двух кланов! Вы не состоите не в одном из них!';
							$ng = 1;
						}else{
							//$r = '-3';
						}
					}else{
						$er = 'Нельзя вмешаться в бой т.к. неравномерный баланс сил в этом поединке!';
						$ng = 1;
					}
					
					if( $battle['noatack'] > 0 ) {
						$er = 'Поединок защищен от нападения!'; 
						$ng = 1;
					}
					
					if( $ng === 1 ) {
						//
					}elseif( $battle['noatack'] > 0 ) {
							$er = 'Поединок закрыт от нападения!';
					}elseif( $mga1 != '-1' ) {
							$er = $mga1;
					}elseif( isset($noak2['id']) ) {
							$er = 'Нельзя возвращаться в этот бой. Вы его покинули!';
					}elseif( isset($noak['id']) ) {
							$er = 'Нельзя нападать на персонажа еще '.$u->timeOut($noak['time']-time()).'.';
					}elseif(isset($usr['id'])) {
						
						$itmart = mysql_fetch_array(mysql_query('SELECT `id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 AND `inOdet` > 0 AND `data` LIKE "%art=%" LIMIT 1'));
						$batlatest = mysql_fetch_array(mysql_query('SELECT `id`,`time_start` FROM `battle` WHERE `id` = "'.$usr['battle'].'" AND `team_win` = -1 LIMIT 1'));
						
						//unset($itmart);
												
						if( $u->info['battle'] > 0 ) {
							$er = 'Вы уже сражаетесь!';
						}elseif( $batlatest['id'] > 0 && ($u->info['room'] == 9 || $u->info['room'] == 323 || $u->info['room'] == 11 || $u->info['room'] == 213) && (
							(date('w',$batlatest['time_start']) == 2 && date('H',$batlatest['time_start']) >= 20 && date('H',$batlatest['time_start']) < 23) ||
							(date('w',$batlatest['time_start']) == 3 && date('H',$batlatest['time_start']) >= 18 && date('H',$batlatest['time_start']) <= 23) ||
							(date('w',$batlatest['time_start']) == 4 && date('H',$batlatest['time_start']) >= 20 && date('H',$batlatest['time_start']) < 23) ||
							(date('w',$batlatest['time_start']) == 5 && date('H',$batlatest['time_start']) >= 20 && date('H',$batlatest['time_start']) <= 23) ||
							(date('w',$batlatest['time_start']) == 6 && date('H',$batlatest['time_start']) >= 18 && date('H',$batlatest['time_start']) <= 23)
						) && true == false ) {
							$er = 'Нельзя нападать в артефактах во время комендантского часа!!!';
						}elseif( $usr['room'] != $u->info['room'] ) {
							$er = 'Вы должны находиться в одной комнате.';
						}elseif($battle['noinc'] == 1) {
							$er = 'Поединок защищен магией';
						}elseif( $usr['battle'] > 0 ) {
							$ubtl = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$usr['battle'].'" LIMIT 1'));
							if(!isset($ubtl['id'])) {
								$er = 'Поединок не найден!';
							}elseif($ubtl['team_win'] != -1) {
								$er = 'Поединок уже завершился!';
							}elseif($ubtl['razdel'] > 0 || $ubtl['dungeon'] > 0 || $ubtl['dn_id'] > 0 || $ubtl['izlom'] > 0){
								$er = 'Вмешиваться в турниры, пещерные бои и хаотичные поединки запрещено!';
							}else{
								//
								$usrst = mysql_fetch_array(mysql_query('SELECT `id`,`team` FROM `stats` WHERE `id` = "'.$usr['id'].'" LIMIT 1'));
								//Обновляем НР и МР игрокам
								if($u->info['level']<=7)
								{
									$u->info['tactic7'] = floor(10/$u->stats['hpAll']*$u->stats['hpNow']);
								}elseif($u->info['level']==8)
								{
									$u->info['tactic7'] = floor(20/$u->stats['hpAll']*$u->stats['hpNow']);
								}elseif($u->info['level']==9)
								{
									$u->info['tactic7'] = floor(30/$u->stats['hpAll']*$u->stats['hpNow']);
								}elseif($u->info['level']>=10)
								{
									$u->info['tactic7'] = floor(40/$u->stats['hpAll']*$u->stats['hpNow']);
								}
								//
								$u->info['tactic7'] += floor($u->stats['s7']/$u->stats['hpAll']*$u->stats['hpNow']);
								//
								// Бафф Зверя animal_bonus ---------------------------------
								if($u->info['animal'] > 0) {
									$a = mysql_fetch_array(mysql_query('SELECT * FROM `users_animal` WHERE `uid` = "'.$u->info['id'].'" AND `id` = "'.$u->info['animal'].'" AND `pet_in_cage` = "0" AND `delete` = "0" LIMIT 1'));
									if(isset($a['id'])) {
										if($a['eda']>=1) {
											$anl = mysql_fetch_array(mysql_query('SELECT `bonus` FROM `levels_animal` WHERE `type` = "'.$a['type'].'" AND `level` = "'.$a['level'].'" LIMIT 1'));
											$anl = $anl['bonus'];
											
											$tpa = array(1=>'cat',2=>'owl',3=>'wisp',4=>'demon',5=>'dog',6=>'pig',7=>'dragon');
											$tpa2 = array(1=>'Кота',2=>'Совы',3=>'Светляка',4=>'Чертяки',5=>'Пса',6=>'Свина',7=>'Дракона');
											$tpa3 = array(1=>'Кошачья Ловкость',2=>'Интуиция Совы',3=>'Сила Стихий',4=>'Демоническая Сила',5=>'Друг',6=>'Полная Броня',7=>'Инферно');
											
											mysql_query('INSERT INTO `eff_users` (`hod`,`v2`,`img2`,`id_eff`,`uid`,`name`,`data`,`overType`,`timeUse`,`v1`,`user_use`) VALUES ("-1","201","summon_pet_'.$tpa[$a['type']].'.gif",22,"'.$u->info['id'].'","'.$tpa3[$a['type']].' ['.$a['level'].']","'.$anl.'","0","77","priem","'.$u->info['id'].'")');
											
										}else{
											$u->send('',$u->info['room'],$u->info['city'],'',$u->info['login'],'<b>'.$a['name'].'</b> нуждается в еде...',time(),6,0,0,0,1);
										}
									}
								}
								//Духовность, спасение
								if( $u->stats['s7'] > 49 ) {
									mysql_query("
										INSERT INTO `eff_users` ( `id_eff`, `uid`, `name`, `data`, `overType`, `timeUse`, `timeAce`, `user_use`, `delete`, `v1`, `v2`, `img2`, `x`, `hod`, `bj`, `sleeptime`, `no_Ace`, `file_finish`, `tr_life_user`, `deactiveTime`, `deactiveLast`, `mark`, `bs`) VALUES
										( 22, '".$u->stats['id']."', 'Спасение', 'add_spasenie=1', 0, 77, 0, '".$u->stats['id']."', 0, 'priem', 324, 'preservation.gif', 1, -1, 'спасение', 0, 0, '', 0, 0, 0, 1, 0);
									");
								}					
								//
								mysql_query('UPDATE `users` SET `battle` = "'.$ubtl['id'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
								mysql_query('UPDATE `stats` SET `team` = "'.$usrst['team'].'",`tactic7` = "'.$u->info['tactic7'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
								//
								$u->info['battle'] = $usr['battle'];
								$u->info['team'] = $usrst['team'];

								$btxt = '';
								if( $u->info['align'] > 0 ) {
									$btxt = $btxt.'<img width=12 height=15 src=http://img.likebk.com/i/align/align'.$u->info['align'].'.gif >';
								}
								if( $u->info['align2'] > 0 ) {
									$btxt = $btxt.'<img width=12 height=15 src=http://img.likebk.com/i/align/align'.$u->info['align2'].'.gif >';
								}
								if( $u->info['clan'] > 0 ) {
									$btxt = $btxt.'<img width=24 height=15 src=http://img.likebk.com/i/clan/'.$u->info['clan'].'.gif >';
								}
								$btxt = $btxt.'<b>{u1}</b>['.$u->info['level'].']<a href=info/'.$u->info['id'].' target=_blank ><img width=12 height=11 src=http://img.likebk.com/i/inf_capitalcity.gif ></a>';
								if( $u->info['sex'] == 1 ) {
									$btxt = $btxt.' вмешалась в поединок.';
								}else{
									$btxt = $btxt.' вмешался в поединок.';
								}
								$btxt .= ' (Помощь собрату <b>'.$usr['login'].'</b>['.$usr['level'].'] , ['.$testHPa.','.$testHPb.','.$mga1.','.$usr['battle'].','.$batlatest['id'].'])';

								$magic->inBattleLog($btxt,$usr);
								//
								$er = 'Вы успешно вмешались за собрата &quot;'.$usr['login'].'&quot;! (Страница обновится автоматически)';
							}
						}else{
							$er = 'Собрат не находится в поединке!';
						}
					}else{
						$er = 'Собрат с логином &quot;'.htmlspecialchars($_GET['brohelp']).'&quot; не найден.';
					}
				}
	
	 if($u->info['align'] == "3.059" || $u->info['admin'] > 0) {
		$dhp1 = 40000;
		$dmp1 = 40000;
	 }else{
		$dhp1 = 100000;
		$dmp1 = 100000;
	 }
	
	
	if( $u->info['inTurnirnew'] == 0 ) {
		
		$dmh1 = mysql_fetch_array(mysql_query('SELECT SUM(`hp`) AS `hp` , SUM(`mp`) AS `mp` FROM `palregen` WHERE `date` = "'.date('d.m.Y').'" LIMIT 1'));
		
		$dhp1 -= $dmh1['hp'];
		$dmp1 -= $dmh1['mp'];
		
		if($u->info['battle'] > 0 && (isset($_GET['hpfast1']) || isset($_GET['mpfast1']))) {
			echo '<div style="font-weight:bold;color:red;">Больше так делать нельзя! ;) Вы находитесь в поединке, пощадите врагов!</div>';
		}elseif(isset($_GET['hpfast1'])) {
			if( $u->stats['hpNow'] < 0 ) {
				 $u->stats['hpNow'] = 0;
			}
			$hpreg = round($u->stats['hpAll'] - $u->stats['hpNow']);
			if( $hpreg > $dhp1 ) {
				$hpreg = $dhp1;
			}
			if( $hpreg > 0 ) {
				$u->stats['hpNow'] += $hpreg;
				$u->info['hpNow'] = $u->stats['hpNow'];
				mysql_query('INSERT INTO `palregen` (`uid`,`time`,`date`,`hp`) VALUES ("'.$u->info['id'].'","'.time().'","'.date('d.m.Y').'","'.$hpreg.'")');
				mysql_query('UPDATE `stats` SET `hpNow` = "'.$u->stats['hpNow'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				echo '<div style="font-weight:bold;color:red;">Вы восстановили свое здоровье на '.$hpreg.' HP.</div>';
			}else{
				echo '<div style="font-weight:bold;color:red;">У вас полное здоровье, либо в колодце нет запасов!</div>';
			}
		}elseif(isset($_GET['mpfast1'])) {
			if( $u->stats['mpNow'] < 0 ) {
				 $u->stats['mpNow'] = 0;
			}
			$mpreg = round($u->stats['mpAll'] - $u->stats['mpNow']);
			if( $mpreg > $dmp1 ) {
				$mpreg = $dmp1;
			}
			if( $mpreg > 0 ) {
				$u->stats['mpNow'] += $mpreg;
				$u->info['mpNow'] = $u->stats['mpNow'];
				mysql_query('INSERT INTO `palregen` (`uid`,`time`,`date`,`mp`) VALUES ("'.$u->info['id'].'","'.time().'","'.date('d.m.Y').'","'.$mpreg.'")');
				mysql_query('UPDATE `stats` SET `mpNow` = "'.$u->stats['mpNow'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				echo '<div style="font-weight:bold;color:red;">Вы восстановили свою ману на '.$mpreg.' МP.</div>';
			}else{
				echo '<div style="font-weight:bold;color:red;">У вас полная мана, либо в колодце нет запасов!</div>';
			}
		}
		
		//хилка +600
		$abil['heal_mod'] = 10;
		$abil['_heal_mod'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `palregen` WHERE `date` = "'.date('d.m.Y').'" AND `abilka` = "heal_mod" LIMIT 1'));
		$abil['_heal_mod'] = 0 + $abil['_heal_mod'][0];
		$abil['heal_mod'] -= $abil['_heal_mod'];
		
		if( isset($_GET['hp600']) ) {
				$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$u->info['battle'].'" LIMIT 1'));
				$bu = mysql_fetch_array(mysql_query('SELECT * FROM `spells` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				 if($u->info['tactic7'] < 5 ) {
					$er = 'Недостаточно духа!';
				}elseif($u->info['hpNow'] >= $u->stats['hpAll']) {
					 $er = 'Вам не нужно восстанавливать энергию';
				}elseif($u->info['hpNow'] < 1) {
					$er = 'Вы погибли';
				}elseif(isset($bu['id'])) {
	                 $er = 'Нельзя использовать свиток каждый ход...';
				}elseif($battle['noeff'] > 0 ) {
					$er = 'Запрет на использования свитков восстановления';
				}else{
					$last_hod = mysql_fetch_array(mysql_query('SELECT `id_hod` FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
		        $last_hod = $last_hod['id_hod'];
				$mass = array('time'=> time(), 'battle' => $u->info['battle'],'id_hod' => ($last_hod+1), 'text'=> 'Персонаж: <img src=http://'.$c['img'].'/i/align/align'.$u->info['align'].'.gif><img src=http://'.$c['img'].'/i/clan/'.$u->info['clan'].'.gif><b>'.$u->info['login'].'</b> - <b><font color=red>Использовал клановое восстановление </font><font color=red> +600 HP</b></font>','type' => 1);
				mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$mass['text'].'","'.$mass['vars'].'","","","","","'.$mass['type'].'")');
				$abil['heal_mod']--;
				$u->info['hpNow'] = $u->info['hpNow']+= 600; $u->info['tactic7'] = $u->info['tactic7'] -= 5;
				mysql_query('INSERT INTO `spells` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`) VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","1")');
				mysql_query('INSERT INTO `palregen` (`date` , `uid` , `time` , `abilka` ) VALUES ("'.date('d.m.Y').'","'.$u->info['id'].'","'.time().'","heal_mod")');
				mysql_query('UPDATE `stats` SET `hpNow` = "'.$u->info['hpNow'].'",`tactic7` = "'.$u->info['tactic7'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				$er = 'Успешно использован свиток "Восстановление Энергии +600"<br></b>(Осталось восстановлений: '.$abil['heal_mod'].' на сегодня)<b>';
			}
		}
		
		
		//хилка +120
		$abil['heal_mod2'] = 15;
		$abil['_heal_mod2'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `palregen` WHERE `date` = "'.date('d.m.Y').'" AND `abilka` = "heal_mod2" LIMIT 1'));
		$abil['_heal_mod2'] = 0 + $abil['_heal_mod2'][0];
		$abil['heal_mod2'] -= $abil['_heal_mod2'];
		
		if( isset($_GET['hp120']) ) {
				$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$u->info['battle'].'" LIMIT 1'));
				$bu = mysql_fetch_array(mysql_query('SELECT * FROM `spells` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				 if($u->info['tactic7'] < 5 ) {
					$er = 'Недостаточно духа!';
				}elseif($u->info['hpNow'] >= $u->stats['hpAll']) {
					 $er = 'Вам не нужно восстанавливать энергию';
				}elseif($u->info['hpNow'] < 1) {
					$er = 'Вы погибли';
				}elseif(isset($bu['id'])) {
	                 $er = 'Нельзя использовать свиток каждый ход...';
				}elseif($battle['noeff'] > 0 ) {
					$er = 'Запрет на использования свитков восстановления';
				}else{
					$last_hod = mysql_fetch_array(mysql_query('SELECT `id_hod` FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
		        $last_hod = $last_hod['id_hod'];
				$mass = array('time'=> time(), 'battle' => $u->info['battle'],'id_hod' => ($last_hod+1), 'text'=> 'Персонаж: <img src=http://'.$c['img'].'/i/align/align'.$u->info['align'].'.gif><img src=http://'.$c['img'].'/i/clan/'.$u->info['clan'].'.gif><b>'.$u->info['login'].'</b> - <b><font color=red>Использовал клановое восстановление </font><font color=red> +120 HP</b></font>','type' => 1);
				mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$mass['text'].'","'.$mass['vars'].'","","","","","'.$mass['type'].'")');
				$abil['heal_mod2']--;
				$u->info['hpNow'] = $u->info['hpNow']+= 120; $u->info['tactic7'] = $u->info['tactic7'] -= 5;
				mysql_query('INSERT INTO `spells` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`) VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","1")');
				mysql_query('INSERT INTO `palregen` (`date` , `uid` , `time` , `abilka` ) VALUES ("'.date('d.m.Y').'","'.$u->info['id'].'","'.time().'","heal_mod2")');
				mysql_query('UPDATE `stats` SET `hpNow` = "'.$u->info['hpNow'].'",`tactic7` = "'.$u->info['tactic7'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				$er = 'Успешно использован свиток "Восстановление Энергии +120"<br></b>(Осталось восстановлений: '.$abil['heal_mod2'].' на сегодня)<b>';
			}
		}
		
		//мана +250
		$abil['mp_mod2'] = 15;
		$abil['_mp_mod2'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `palregen` WHERE `date` = "'.date('d.m.Y').'" AND `abilka` = "mp_mod2" LIMIT 1'));
		$abil['_mp_mod2'] = 0 + $abil['_mp_mod2'][0];
		$abil['mp_mod2'] -= $abil['_mp_mod2'];
		
		if( isset($_GET['mp250']) ) {
				$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$u->info['battle'].'" LIMIT 1'));
				$bu = mysql_fetch_array(mysql_query('SELECT * FROM `spells` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				 if($u->info['tactic7'] < 5 ) {
					$er = 'Недостаточно духа!';
				}elseif($u->info['mpNow'] >= $u->stats['mpAll']) {
					 $er = 'Вам не нужно восстанавливать энергию';
				}elseif($u->info['mpNow'] < 1) {
					$er = 'Вы погибли';
				}elseif(isset($bu['id'])) {
	                 $er = 'Нельзя использовать свиток каждый ход...';
				}elseif($battle['noeff'] > 0 ) {
					$er = 'Запрет на использования свитков восстановления';
				}else{
					$last_hod = mysql_fetch_array(mysql_query('SELECT `id_hod` FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
		        $last_hod = $last_hod['id_hod'];
				$mass = array('time'=> time(), 'battle' => $u->info['battle'],'id_hod' => ($last_hod+1), 'text'=> 'Персонаж: <img src=http://'.$c['img'].'/i/align/align'.$u->info['align'].'.gif><img src=http://'.$c['img'].'/i/clan/'.$u->info['clan'].'.gif><b>'.$u->info['login'].'</b> - <b><font color=red>Использовал клановое восстановление </font><font color=red> +600 HP</b></font>','type' => 1);
				mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$mass['text'].'","'.$mass['vars'].'","","","","","'.$mass['type'].'")');
				$abil['mp_mod2']--;
				$u->info['mpNow'] = $u->info['mpNow']+= 250; $u->info['tactic7'] = $u->info['tactic7'] -= 5;
				mysql_query('INSERT INTO `spells` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`) VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","1")');
				mysql_query('INSERT INTO `palregen` (`date` , `uid` , `time` , `abilka` ) VALUES ("'.date('d.m.Y').'","'.$u->info['id'].'","'.time().'","mp_mod2")');
				mysql_query('UPDATE `stats` SET `mpNow` = "'.$u->info['mpNow'].'",`tactic7` = "'.$u->info['tactic7'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				$er = 'Успешно использован свиток "Восстановление Энергии +250"<br></b>(Осталось восстановлений: '.$abil['mp_mod2'].' на сегодня)<b>';
			}
		}
		
		//мана +1000
		$abil['mp_mod'] = 10;
		$abil['_mp_mod'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `palregen` WHERE `date` = "'.date('d.m.Y').'" AND `abilka` = "mp_mod" LIMIT 1'));
		$abil['_mp_mod'] = 0 + $abil['_mp_mod'][0];
		$abil['mp_mod'] -= $abil['_mp_mod'];
		
		if( isset($_GET['mp1000']) ) {
				$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$u->info['battle'].'" LIMIT 1'));
				$bu = mysql_fetch_array(mysql_query('SELECT * FROM `spells` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				 if($u->info['tactic7'] < 5 ) {
					$er = 'Недостаточно духа!';
				}elseif($u->info['mpNow'] >= $u->stats['mpAll']) {
					 $er = 'Вам не нужно восстанавливать энергию';
				}elseif($u->info['mpNow'] < 1) {
					$er = 'Вы погибли';
				}elseif(isset($bu['id'])) {
	                 $er = 'Нельзя использовать свиток каждый ход...';
				}elseif($battle['noeff'] > 0 ) {
					$er = 'Запрет на использования свитков восстановления';
				}else{
					$last_hod = mysql_fetch_array(mysql_query('SELECT `id_hod` FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
		        $last_hod = $last_hod['id_hod'];
				$mass = array('time'=> time(), 'battle' => $u->info['battle'],'id_hod' => ($last_hod+1), 'text'=> 'Персонаж: <img src=http://'.$c['img'].'/i/align/align'.$u->info['align'].'.gif><img src=http://'.$c['img'].'/i/clan/'.$u->info['clan'].'.gif><b>'.$u->info['login'].'</b> - <b><font color=red>Использовал клановое восстановление </font><font color=red> +600 HP</b></font>','type' => 1);
				mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$mass['text'].'","'.$mass['vars'].'","","","","","'.$mass['type'].'")');
				$abil['mp_mod']--;
				$u->info['mpNow'] = $u->info['mpNow']+= 1000; $u->info['tactic7'] = $u->info['tactic7'] -= 5;
				mysql_query('INSERT INTO `spells` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`) VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","1")');
				mysql_query('INSERT INTO `palregen` (`date` , `uid` , `time` , `abilka` ) VALUES ("'.date('d.m.Y').'","'.$u->info['id'].'","'.time().'","mp_mod")');
				mysql_query('UPDATE `stats` SET `mpNow` = "'.$u->info['mpNow'].'",`tactic7` = "'.$u->info['tactic7'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				$er = 'Успешно использован свиток "Восстановление Энергии +1000"<br></b>(Осталось восстановлений: '.$abil['mp_mod'].' на сегодня)<b>';
			}
		}
		$abil['travm_mod'] =  10;
		$abil['_travm_mod'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `palregen` WHERE `date` = "'.date('d.m.Y').'" AND `abilka` = "mp_mod" LIMIT 1'));
		$abil['_travm_mod'] = 0 + $abil['_travm_mod'][0];
		$abil['travm_mod'] -= $abil['_travm_mod'];
		if( isset($_GET['travm_mod'])) {
				   $abil['travm_mod']--;
				  mysql_query('INSERT INTO `palregen` (`date` , `uid` , `time` , `abilka` ) VALUES ("'.date('d.m.Y').'","'.$u->info['id'].'","'.time().'","travm_mod")');
				 $travm = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `uid`="'.$u->info['id'].'" and `id_eff`="4" and `data` NOT LIKE "%|nelich=%" and `delete`="0" and `name` not like "%Неизлечимая травма%" LIMIT 1'));
				if($travm) {
					mysql_query('UPDATE `eff_users` SET `delete` = "'.time().'" WHERE `id` = "'.$travm['id'].'" LIMIT 1');
					$er = 'Вы исцелились от "'.$travm['name'].'"</b><br>(Осталось лечений: '.$abil['travm_mod'].' на сегодня)';
				}else{
					$er = 'У вас нету травмы, или текущая травма Неизлечима';
				}
			}
			
					//уникальная тактика
		$abil['hl7'] =  10;
		$abil['_hl7'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `palregen` WHERE `date` = "'.date('d.m.Y').'" AND `abilka` = "hl7" LIMIT 1'));
		$abil['_hl7'] = 0 + $abil['_hl7'][0];
		$abil['hl7'] -= $abil['_hl7'];
			  if( isset($_GET['hl7add']) ) {
				 $bu = mysql_fetch_array(mysql_query('SELECT * FROM `tactic` WHERE `btl` = "'.$u->info['battle'].'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
				 $trtct = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `battle_actions` WHERE `uid` = "'.$u->info['id'].'" AND `vars` = "use_cast_tactic" AND `btl` = "'.$u->info['battle'].'" AND `time` > "'.(time()-180).'" LIMIT 1'));
				if(isset($trtct['id'])) {
					$er = 'Задержка использования еще '.$u->timeOut($trtct['time']-time()+180);
				}elseif($u->info['battle'] == 0) {
					 $er = 'Использовать можно только в поединке!';
				}elseif(isset($bu['id'])) {
	                 $er = 'Нельзя использовать свиток каждый ход...';
				}elseif( $abil['hl7'] <= 0) {
	                 $er = 'На сегодня нет доступных свитков...';
				}else{
					mysql_query('INSERT INTO `battle_actions` (`uid`,`btl`,`time`,`vars`,`vals`) VALUES (
					"'.$u->info['id'].'","'.$u->info['battle'].'","'.time().'","use_cast_tactic",""
					)');
					$last_hod = mysql_fetch_array(mysql_query('SELECT `id_hod` FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
					$last_hod = $last_hod['id_hod'];
					$mass = array('time'=> time(), 'battle' => $u->info['battle'],'id_hod' => ($last_hod+1), 'text'=> 'Персонаж: <img src=http://'.$c['img'].'/i/align/align'.$u->info['align'].'.gif><img src=http://'.$c['img'].'/i/clan/'.$u->info['clan'].'.gif><b>'.$u->info['login'].'</b> - <b><font color=red>Использовал </font><font color=red> Уникальная тактика +1 (клановый свиток)</b></font>','type' => 1);
					mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$mass['text'].'","'.$mass['vars'].'","","","","","'.$mass['type'].'")');
					$abil['hl7']--;
					mysql_query('INSERT INTO `tactic` (`btl`,`uid`,`time`,`item_id`,`var`,`hod`) VALUES ("'.$u->info['battle'].'","'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","'.$itm['name'].'","1")');
					   mysql_query('INSERT INTO `palregen` (`date` , `uid` , `time` , `abilka` ) VALUES ("'.date('d.m.Y').'","'.$u->info['id'].'","'.time().'","hl7")');
				   mysql_query('UPDATE `stats` SET 
				   `tactic1` = `tactic1` + 1,
				   `tactic2` = `tactic2` + 1,
				   `tactic3` = `tactic3` + 1,
				   `tactic4` = `tactic4` + 1,
				   `tactic5` = `tactic5` + 1,
				   `tactic6` = `tactic6` + 1
				   WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				   $er = 'Вы использовали Уникальную тактику +1';
			   }
		}
		
		//жажда жизни +5
		$abil['hpvinos'] =  10;
		$abil['_hpvinos'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `palregen` WHERE `date` = "'.date('d.m.Y').'" AND `abilka` = "hpvinos" LIMIT 1'));
		$abil['_hpvinos'] = 0 + $abil['_hpvinos'][0];
		$abil['hpvinos'] -= $abil['_hpvinos'];
				if( isset($_GET['hpvinos5']) ) {
				$abil['hpvinos']--;
				$additm = $u->addItem(3102,$u->info['id']);
				if( $additm > 0 ) {
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					mysql_query('INSERT INTO `palregen` (`date` , `uid` , `time` , `abilka` ) VALUES ("'.date('d.m.Y').'","'.$u->info['id'].'","'.time().'","hpvinos")');
					if( $u->error != '' ) {
						$er = $u->error.'<br></b>(Осталось кастов: '.$abil['hpvinos'].' на сегодня)<b>';
					}else{
						$er = 'Вы ощутили силу каста &quot;<b>Жажды Жизни</b>&quot;.<br></b>(Осталось кастов: '.$abil['hpvinos'].' на сегодня)<b>';
					}
				}else{
					$er = 'Что-то пошло не так, каст не сработал...';
				}
			}
			
		$abil['sokr'] =  10;
		$abil['_sokr'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `palregen` WHERE `date` = "'.date('d.m.Y').'" AND `abilka` = "sokr" LIMIT 1'));
		$abil['_sokr'] = 0 + $abil['_sokr'][0];
		$abil['sokr'] -= $abil['_sokr'];
				if( isset($_GET['sokrmod']) ) {
				$abil['sokr']--;
				$additm = $u->addItem(994,$u->info['id']);
				if( $additm > 0 ) {
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					mysql_query('INSERT INTO `palregen` (`date` , `uid` , `time` , `abilka` ) VALUES ("'.date('d.m.Y').'","'.$u->info['id'].'","'.time().'","sokr")');
					if( $u->error != '' ) {
						$er = $u->error.'<br></b>(Осталось кастов: '.$abil['sokr'].' на сегодня)<b>';
					}else{
						$er = 'Вы ощутили силу каста &quot;<b>Сокрушение</b>&quot;.<br></b>(Осталось кастов: '.$abil['sokr'].' на сегодня)<b>';
					}
				}else{
					$er = 'Что-то пошло не так, каст не сработал...';
				}
			}
			
		$abil['za'] =  10;
		$abil['_za'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `palregen` WHERE `date` = "'.date('d.m.Y').'" AND `abilka` = "za" LIMIT 1'));
		$abil['_za'] = 0 + $abil['_za'][0];
		$abil['za'] -= $abil['_za'];
				if( isset($_GET['zamod']) ) {
				$abil['za']--;
				$additm = $u->addItem(1001,$u->info['id']);
				if( $additm > 0 ) {
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					mysql_query('INSERT INTO `palregen` (`date` , `uid` , `time` , `abilka` ) VALUES ("'.date('d.m.Y').'","'.$u->info['id'].'","'.time().'","za")');
					if( $u->error != '' ) {
						$er = $u->error.'<br></b>(Осталось кастов: '.$abil['za'].' на сегодня)<b>';
					}else{
						$er = 'Вы ощутили силу каста &quot;<b>Защита от оружия</b>&quot;.<br></b>(Осталось кастов: '.$abil['za'].' на сегодня)<b>';
					}
				}else{
					$er = 'Что-то пошло не так, каст не сработал...';
				}
			}
			
				$abil['magic'] =  10;
				$abil['_magic'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `palregen` WHERE `date` = "'.date('d.m.Y').'" AND `abilka` = "magic" LIMIT 1'));
				$abil['_magic'] = 0 + $abil['_magic'][0];
				$abil['magic'] -= $abil['_magic'];
				if( isset($_GET['magicmod']) ) {
				$abil['magic']--;
				$additm = $u->addItem(5122,$u->info['id']);
				if( $additm > 0 ) {
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					mysql_query('INSERT INTO `palregen` (`date` , `uid` , `time` , `abilka` ) VALUES ("'.date('d.m.Y').'","'.$u->info['id'].'","'.time().'","magic")');
					if( $u->error != '' ) {
						$er = $u->error.'<br></b>(Осталось кастов: '.$abil['magic'].' на сегодня)<b>';
					}else{
						$er = 'Вы ощутили силу каста &quot;<b>Защита от магии</b>&quot;.<br></b>(Осталось кастов: '.$abil['magic'].' на сегодня)<b>';
					}
				}else{
					$er = 'Что-то пошло не так, каст не сработал...';
				}
			}
			
			$abil['magic2'] =  10;
				$abil['_magic2'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `palregen` WHERE `date` = "'.date('d.m.Y').'" AND `abilka` = "magic2" LIMIT 1'));
				$abil['_magic2'] = 0 + $abil['_magic2'][0];
				$abil['magic2'] -= $abil['_magic2'];
				if( isset($_GET['magicmod2']) ) {
				$abil['magic2']--;
				$additm = $u->addItem(5123,$u->info['id']);
				if( $additm > 0 ) {
					$_GET['login'] = $u->info['login']; //на кого кастуем
					$magic->useItems($additm);
					unset($_GET['login']);
					mysql_query('DELETE FROM `items_users` WHERE `id` = "'.$additm.'" LIMIT 1');
					mysql_query('INSERT INTO `palregen` (`date` , `uid` , `time` , `abilka` ) VALUES ("'.date('d.m.Y').'","'.$u->info['id'].'","'.time().'","magic2")');
					if( $u->error != '' ) {
						$er = $u->error.'<br></b>(Осталось кастов: '.$abil['magic2'].' на сегодня)<b>';
					}else{
						$er = 'Вы ощутили силу каста &quot;<b>Магическое усиление</b>&quot;.<br></b>(Осталось кастов: '.$abil['magic2'].' на сегодня)<b>';
					}
				}else{
					$er = 'Что-то пошло не так, каст не сработал...';
				}
			}
			
			$abil['exb'] =  1;
			$abil['_exb'] = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `palregen` WHERE `date` = "'.date('d.m.Y').'" AND `abilka` = "exb" LIMIT 1'));
			$abil['_exb'] = 0 + $abil['_exb'][0];
			$abil['exb'] -= $abil['_exb'];
		if( $u->stats['hpNow'] >= 1 && $u->info['admin'] == 0) {
			$u->error = '<font color=red><b>Вы должны погибнуть чтобы воспользоваться этим свитком...</b></font>';
		}elseif( isset($_GET['exit_battle']) ) {
			$abil['exb']--;
			$battle = mysql_fetch_array(mysql_query('SELECT * FROM `battle` WHERE `id` = "'.$u->info['battle'].'" LIMIT 1'));
			if( $battle['dn_id'] > 0 || $battle['izlom'] > 0 ) {
				$er = '<font color=red><b>Магия не действует в пещерах и подобных локациях...</b></font>';	
			}elseif( $battle['noinc'] == 1 ) {
				$er = '<font color=red><b>Бой изолирован и вы не можете его покинуть</b></font>';	
			}elseif( $battle['clone'] > 0 && $u->info['admin'] == 0 ) {
				$er = '<font color=red><b>Невозможно покинуть поединок с клоном</b></font>';
			}elseif($u->info['battle']==0) {
				$er = 'Использовать можно только в поединке!';
			}else{
				$last_hod = mysql_fetch_array(mysql_query('SELECT `id_hod` FROM `battle_logs` WHERE `battle` = "'.$u->info['battle'].'" ORDER BY `id_hod` DESC LIMIT 1'));
					$last_hod = $last_hod['id_hod'];
					$mass = array('time'=> time(), 'battle' => $u->info['battle'],'id_hod' => ($last_hod+1), 'text'=> 'Персонаж: <img src=http://'.$c['img'].'/i/align/align'.$u->info['align'].'.gif><img src=http://'.$c['img'].'/i/clan/'.$u->info['clan'].'.gif><b>'.$u->info['login'].' - <font color=red>Сбежал с поля битвы...</b></font>','type' => 1);
					mysql_query('INSERT INTO `battle_logs` (`time`,`battle`,`id_hod`,`text`,`vars`,`zona1`,`zonb1`,`zona2`,`zonb2`,`type`) VALUES ("'.$mass['time'].'","'.$mass['battle'].'","'.$mass['id_hod'].'","'.$mass['text'].'","'.$mass['vars'].'","","","","","'.$mass['type'].'")');
				
				mysql_query('INSERT INTO `users_noatack` (`uid`,`time`,`battle`) VALUES ("'.$u->info['id'].'","'.(time()+5*60).'","'.$u->info['battle'].'")');
				
				
				mysql_query('DELETE FROM `battle_rune_exp` WHERE `uid` = "'.$u->info['id'].'"');
				
				mysql_query('UPDATE `stats` SET `battle_yron` = 0, `battle_exp` = 0,`tactic1` = 0 , `tactic2` = 0 , `tactic3` = 0 , `tactic4` = 0 , `tactic5` = 0 , `tactic6` = 0 , `tactic7` = -1 , `last_pr` = 0 , `last_hp` = -1 , `team` = 0 WHERE `id` = '.$u->info['id'].' LIMIT 1');
				mysql_query('UPDATE `users` SET `battle` = "0", `lose` = `lose` + 1 WHERE `id` = '.$u->info['id'].' LIMIT 1');
				mysql_query('DELETE FROM `eff_users` WHERE `v1` = "priem" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0');
				mysql_query('INSERT INTO `palregen` (`date` , `uid` , `time` , `abilka` ) VALUES ("'.date('d.m.Y').'","'.$u->info['id'].'","'.time().'","exb")');
				mysql_query('DELETE FROM `battle_users` WHERE `uid` = "'.$u->info['id'].'" AND `finish` = 0');
				$er = 'Вы сбежали с поля боя, ваши союзники насмехаются над вами...';
			}
		}
	
	}
		
	if($er != "") {
		echo '<font color=red><b>'.$er.'</b></font><br>';
	}
	if( $u->info['inTurnirnew'] > 0 ) { 
	
	//}elseif($u->info['admin'] == 1 || $u->info['align'] == 3.059 || $u->info['align'] == 3.06 || $u->info['align'] == 1.59 || $u->info['align'] == 1.6 || ( $u->info['align'] > 1 && $u->info['align'] < 2 ) ) {
	}elseif($u->info['admin'] > 0 || ( $u->info['align'] != 2 && $u->info['align'] != 1 && $u->info['align'] != 3 )){
		?>
			<a href="/main.php?<?=$zv?>&hpfast1=1"><img src="http://img.likebk.com/i/items/n/healvortex.gif" title="Восстановить здоровье. Доступно: <?=$dhp1?> HP"></a>
			<a href="/main.php?<?=$zv?>&mpfast1=1"><img src="http://img.likebk.com/i/items/n/manavortex.gif" title="Восстановить ману. Доступно: <?=$dmp1?> MP"></a> &nbsp; 
		
		<?
		 if($u->info['battle'] == 0) {
			 $l = '<img onclick="location.href=\'/main.php?'.$zv.'=1&hpvinos5\';" onMouseOver="top.hi(this,\'<b>Жажда Жизни +5</b> (Осталось: '.$abil['hpvinos'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/spell_powerHPup5.gif">';
			 $l .= '<img onclick="location.href=\'/main.php?'.$zv.'=1&sokrmod\';" onMouseOver="top.hi(this,\'<b>Сокрушение</b> (Осталось: '.$abil['sokr'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/spell_powerup10.gif">';
			 $l .= '<img onclick="location.href=\'/main.php?'.$zv.'=1&magicmod2\';" onMouseOver="top.hi(this,\'<b>Магическое усиление</b> (Осталось: '.$abil['magic2'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/zma_spell.gif">';
			 $l .= '<img onclick="location.href=\'/main.php?'.$zv.'=1&magicmod\';" onMouseOver="top.hi(this,\'<b>Защита от магии</b> (Осталось: '.$abil['magic'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/zma.gif">';
			 $l .= '<img onclick="location.href=\'/main.php?'.$zv.'=1&zamod\';" onMouseOver="top.hi(this,\'<b>Защита от оружия</b> (Осталось: '.$abil['za'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/spell_protect10.gif">';
			 $l .= '<img onclick="location.href=\'/main.php?'.$zv.'=1&travm_mod\';" onMouseOver="top.hi(this,\'<b>Лечени травм</b> (Осталось: '.$abil['travm_mod'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/pal_buttond.gif">';
		   }else{
			  $l = '';
		   }
		$html = '<img onclick="location.href=\'/main.php?'.$zv.'=1&hl7add\';" onMouseOver="top.hi(this,\'<b>Уникальная тактика</b> (Осталось: '.$abil['hl7'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/invoke_tactics5.gif">';
		$html .= '<img onclick="location.href=\'/main.php?'.$zv.'=1&mp1000\';" onMouseOver="top.hi(this,\'<b>Восстановление манны +1000</b> (Осталось: '.$abil['mp_mod'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/cureMana1000.gif">';
		$html .= '<img onclick="location.href=\'/main.php?'.$zv.'=1&mp250\';" onMouseOver="top.hi(this,\'<b>Восстановление манны +250</b> (Осталось: '.$abil['mp_mod2'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/cureMana50.gif">';
		$html .= '<img onclick="location.href=\'/main.php?'.$zv.'=1&hp600\';" onMouseOver="top.hi(this,\'<b>Восстановление Энергии +600</b> (Осталось: '.$abil['heal_mod'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/cureHP600.gif">';
		$html .= '<img onclick="location.href=\'/main.php?'.$zv.'=1&hp120\';" onMouseOver="top.hi(this,\'<b>Восстановление Энергии +120</b> (Осталось: '.$abil['heal_mod2'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/cureHP120.gif">';
		$html .= '<img onclick="abil1();" onMouseOver="top.hi(this,\'<b>Помощь собрату</b> (Бесконечно)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/n/mirror.gif"> ';
			$html .= '<img onclick="location.href=\'/main.php?'.$zv.'=1&exit_battle\';" onMouseOver="top.hi(this,\'<b>Выход из боя</b> (Осталось: '.$abil['exb'].' шт.)\',event,2,0,1,1,\'max-width:307px\')" onMouseOut="top.hic();" onMouseDown="top.hic();" class="cp" src="http://img.likebk.com/i/items/n/retreat.gif">';
		echo $html,$l;
	}
			
	if($u->info['align']>=3 && $u->info['align']<4)
	{

		//Темная склонка, кусается сука!)
		?>
<a href="#" onClick="openMod('<b>&quot;Укус вампира&quot;</b>','<form action=\'main.php?dark=1&usemod=<? echo $code; ?>\' method=\'post\'>Логин жертвы: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'usevampir\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/vampir.gif" title="Укусить" /></a>
<?
	}
	
	if($u->info['admin']>0 || ($u->info['align']>1 && $u->info['align']<2) || ($u->info['align']>3 && $u->info['align']<4))
	{
  ?>
  <div style="padding:10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Наложить/Снять заклятия</h4>
  <table width="100%">
   <tr>
     <td>
		<a href="/main.php?<?=$zv?>&hpfast1=1"><img src="http://img.likebk.com/i/items/n/healvortex.gif" title="Восстановить здоровье. Доступно: <?=$dhp1?> HP"></a>
        <a href="/main.php?<?=$zv?>&mpfast1=1"><img src="http://img.likebk.com/i/items/n/manavortex.gif" title="Восстановить ману. Доступно: <?=$dmp1?> MP"></a> &nbsp; 
		<? if($u->info['admin']>0){ echo '<a href="main.php?'.$zv.'&go=2"><img width="40" height="25" title="Редактировать квесты, задания и обучающие программы" src="http://img.likebk.com/editor2.gif"></a>'; } ?>
		<? if($p['editAlign']==1){ echo '<a href="main.php?'.$zv.'&go=1"><img title="Редактировать возможности подчиненных" src="http://img.likebk.com/editor.gif"></a>'; } ?>
        &nbsp;&nbsp;&nbsp;
		<? if($p['m1']==1 || $p['citym1']==1){ ?> <a href="#" onClick="openMod('<b>Заклятие молчания</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Время заклятия: &nbsp; <select style=\'margin-left:2px;\' name=\'time\'><option value=\'5\'>5 минут</option><option value=\'15\'>15 минут</option><option value=\'30\'>30 минут</option><option value=\'60\'>1 час</option><option value=\'180\'>3 часа</option><option value=\'360\'>6 часов</option><option value=\'720\'>12 часов</option><option value=\'1440\'>Сутки</option><? if( $u->info['admin'] > 0 ) { ?><option value=\'4320\'>3 дня</option><option value=\'10080\'>Неделя</option><option value=\'30240\'>3 недели</option><? } ?></select> <input type=\'submit\' name=\'usem1\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/sleep.gif" title="Заклятие молчания" /></a> <? } ?>
        <? if($p['m2']==1 || $p['citym2']==1){ ?> <a href="#" onClick="openMod('<b>Заклятие форумного молчания</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Время заклятия: &nbsp; <select style=\'margin-left:2px;\' name=\'time\'><option value=\'30\'>30 минут</option><option value=\'60\'>1 час</option><option value=\'180\'>3 часа</option><option value=\'360\'>6 часов</option><option value=\'720\'>12 часов</option><option value=\'1440\'>Сутки</option></select> <input type=\'submit\' name=\'usem2\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/sleepf.gif" title="Заклятие форумного молчания" /></a> <? } ?>
        <? if($p['sm1']==1 || $p['sm2']==1 || $p['citysm1']==1 || $p['citysm2']==1){ ?>
        <a href="#" onClick="openMod('<b>Заклятие форумного молчания</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Снять заклятие: &nbsp; <select style=\'margin-left:2px;\' name=\'time\'><option value=\'1\'>чат</option><option value=\'2\'>форум</option><option value=\'3\'>чат + форум</option></select> <input type=\'submit\' name=\'usesm\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/sleep_off.gif" title="Снять заклятие молчания" /></a> <? } ?>
        &nbsp;&nbsp;&nbsp;
		<? if($p['banned']==1 || $p['ban0']==1){ ?> <a href="#" onClick="openMod('<b>Заклятие смерти</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'useban\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/pal_button6.gif" title="Заклятье смерти" /></a> <? } ?>
        <? if($p['unbanned']==1){ ?> <a href="#" onClick="openMod('<b>Снять заклятие смерти</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'useunban\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/pal_button7.gif" title="Снять заклятье смерти" /></a> <? } ?>
		&nbsp;&nbsp;&nbsp;
		<? if($p['haos']==1){ ?> <a href="#" onClick="openMod('<b>Отправить в хаос</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Время заклятия: &nbsp; <select style=\'margin-left:2px;\' name=\'time\'><option value=\'1\'>1 день</option><option value=\'3\'>3 дня</option><option value=\'7\'>Неделя</option><option value=\'7\'>Неделя</option><option value=\'14\'>2 недели</option><option value=\'30\'>Месяц</option><option value=\'60\'>2 месяца</option><? if($p['haosInf']==1){ ?><option value=\'1\'>Бессрочно</option><? } ?> <input type=\'submit\' name=\'usehaos\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/pal_button4.gif" title="Отправить в хаос" /></a> <? } ?>
        <? if($p['shaos']==1){ ?> <a href="#" onClick="openMod('<b>Выпустить из хаоса</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'useshaos\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/pal_button5.gif" title="Выпустить из хаоса" /></a> <? } ?>
        &nbsp;&nbsp;&nbsp;
		<? if($p['deletInfo']==1){ ?> <a href="#" onClick="openMod('<b>Обезличивание</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Время заклятия: &nbsp; <select style=\'margin-left:2px;\' name=\'time\'><option value=\'7\'>Неделя</option><option value=\'14\'>2 недели</option><option value=\'30\'>Месяц</option><option value=\'60\'>2 месяца</option><option value=\'1\'>Бессрочно</option> <input type=\'submit\' name=\'usedeletinfo\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/cui.gif" title="Обезличивание" /></a>
                                      <a href="#" onClick="openMod('<b>Снять заклятие обезличивания</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'unusedeletinfo\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/uncui.gif" title="Снять обезличивание" /></a> <? } ?>
        &nbsp;&nbsp;&nbsp;
		<? if($p['priemIskl']==1 && $a==1){ ?>
        <a href="#" onClick="openMod('<b>Принять в <? if( $u->info['align'] == 1.6 ) { echo 'Инквизиторы'; }else{ echo 'ОС'; } ?></b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Звание: &nbsp; <select style=\'margin-left:2px;\' name=\'zvanie\'><? if( $u->info['align'] == 1.6 ) { echo "<option value=\'1.59\'> Инквизитор</option>"; }else{ ?><option value=\'1.1\'> Паладин Поднебесья</option><option value=\'1.4\'>Таможенный паладин</option><option value=\'1.5\'>Паладин Солнечной Улыбки</option><option value=\'1.6\'>Инквизитор</option><option value=\'1.7\'>Паладин Огненной Зари</option><option value=\'1.75\'>Паладин-Хранитель</option><option value=\'1.9\'>Паладин Неба</option><option value=\'1.91\'>Старший Паладин Неба</option><option value=\'1.92\'>Ветеран Ордена</option><? } ?><input type=\'submit\' name=\'gomoder\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/pal.gif" title="Принять в ОС (Повысить)" /></a>
        <a href="#" onClick="openMod('<b>Изгнать из <? if( $u->info['align'] == 1.6 ) { echo 'Инквизиторов'; }else{ echo 'ОС'; } ?></b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'unmoder\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/unpal.gif" title="Изгнать из ОС" /></a> <? } ?>  
        <? if($p['priemIskl']==1 && $a==3){ ?>
        <a href="#" onClick="openMod('<b>Принять в <? if( $u->info['align'] == 3.06 ) { echo 'Каратели'; }else{ echo 'Армаду'; } ?></b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Звание: &nbsp; <select style=\'margin-left:2px;\' name=\'zvanie\'><? if( $u->info['align'] == 3.06 ) { echo "<option value=\'3.059\'> Каратель</option>"; }else{ ?><option value=\'1.1\'> Паладин Поднебесья</option><option value=\'1.4\'>Таможенный паладин</option><option value=\'1.5\'>Паладин Солнечной Улыбки</option><option value=\'1.6\'>Инквизитор</option><option value=\'1.7\'>Паладин Огненной Зари</option><option value=\'1.75\'>Паладин-Хранитель</option><option value=\'1.9\'>Паладин Неба</option><option value=\'1.91\'>Старший Паладин Неба</option><option value=\'1.92\'>Ветеран Ордена</option><? } ?><input type=\'submit\' name=\'gomoder\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/pal_button[dark].gif" title="Принять в Армаду (Повысить)" /></a>
        <a href="#" onClick="openMod('<b>Изгнать из <? if( $u->info['align'] == 3.06 ) { echo 'Карателей'; }else{ echo 'Армады'; } ?></b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'unmoder\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/palbuttondarkhc1.gif" title="Изгнать из Армады" /></a> <? } ?>  
		&nbsp;&nbsp;&nbsp;
		<? if($p['proverka']==1){ ?> <a href="#" onclick="openMod('<b>Проверка на чистоту</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><input type=\'submit\' name=\'usepro\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/check.gif" title="Проверка на чистоту" /></a> <? } ?>
        &nbsp;&nbsp;&nbsp;
		<? if($p['zatoch']==1){ ?> <a href="#"  onClick="openMod('<b>Посадить</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Время заточения: &nbsp; <select style=\'margin-left:2px;\' name=\'time\'><option value=\'1\'>1 день</option><option value=\'3\'>3 дня</option><option value=\'7\'>неделя</option><option value=\'14\'>14 дней</option><option value=\'30\'>30 дней</option><option value=\'365\'>365 дней</option><option value=\'24\'>Бессрочно</option><option value=\'6\'>часик</option><input type=\'submit\' name=\'use_carcer\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/jail.gif" title="Заточение" /></a> <? } ?>
        <? if($p['szatoch']==1){ ?> <a href="#" onClick="openMod('<b>Выпустить из заточения</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br> <input style=\'float:right;\' type=\'submit\' name=\'v_carcer\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/jail_off.gif" title="Выпустить из заточения" /></a> <? } ?>
        &nbsp;&nbsp;&nbsp;
		<? if($p['marry']==1){ ?>
        <a href="#" onclick="openMod('<b>Свадьба</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><br>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo2\' name=\'logingo2\'><br><input type=\'submit\' name=\'usemarry\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/marry.gif" title="Брак" /></a>
        <a href="#" onclick="openMod('<b>Расторгнуть брак</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\'><input type=\'submit\' name=\'useunmarry\' value=\'Исп-ть\'></form>');"><img src="http://<?=$c['img'];?>/i/items/unmarry.gif" title="Расторгнуть брак" /></a>
		<? } ?>
        &nbsp; &nbsp;<? if($u->info['admin']>0 && $u->info['id'] != 2332207){ ?> <a onClick="openMod('<b>Телепортация</b>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа: <input type=\'text\' style=\'width:144px;\' id=\'logingo\' name=\'logingo\' value=\'<? echo $u->info['login']; ?>\'><br>Город: &nbsp; <select style=\'margin-left:2px;\' name=\'city\'><option value=\'capitalcity\'>capitalcity</option><option value=\'angelscity\'>angelscity</option><option value=\'demonscity\'>demonscity</option><option value=\'devilscity\'>devilscity</option><option value=\'suncity\'>suncity</option><option value=\'emeraldscity\'>emeraldscity</option><option value=\'sandcity\'>sandcity</option><option value=\'mooncity\'>mooncity</option><option value=\'eastcity\'>eastcity</option><option value=\'abandonedplain\'>abandonedplain</option><option value=\'dreamscity\'>dreamscity</option><option value=\'lowcity\'>devilscity</option><option value=\'oldcity\'>devilscity</option><option value=\'newcapitalcity\'>newcapital</option></select> <input type=\'submit\' name=\'teleport\' value=\'Исп-ть\'></form>');" href="#"><img src="http://<?=$c['img'];?>/i/items/teleport.gif" title="Телепортация" /></a>
		<a href="#" onclick="openMod('<center><b>Выдать вещь по Id</b></center>','<form action=\'main.php?<? echo $zv.'&usemod='.$code; ?>\' method=\'post\'>Логин персонажа : <input type=\'text\' style=\'width:144px;\' id=\'log_itm_\' name=\'log_itm_\'><br />Id вещи : &nbsp; <input type=\'text\' name=\'itm_id\' /><br /><center><input type=\'submit\' name=\'use_itm_\' value=\'Дать\'></center></form>');"><img src="http://<?=$c['img'];?>/i/items/bad_present_dfighter.gif" title="Выдать шмотку" /></a>
		<? } ?>  </td>
   </tr>
  </table>
  </div>
  <? }
    
  if($u->info['admin'] > 0) {
	  
			$types = array(
				1  => array('Образ',120,220,100),
				2  => array('Заглушка (снизу)',120,40,15),
				3  => array('Заглушка (сверху)',120,20,5),
				4  => array('Шлем',60,60,25),
				5  => array('Наручи',60,40,25),
				6  => array('Левая рука',60,60,25),
				7  => array('Правая рука',60,60,25),
				8  => array('Броня',60,80,25),
				9  => array('Пояс',60,40,25),
				10 => array('Ботинки',60,40,25),
				11 => array('Поножи',60,80,25),
				12 => array('Перчатки',60,40,25),
				13 => array('Кольца №1',20,20,10),
				14 => array('Кулон',60,20,25),
				15 => array('Серьги',60,20,25),						
				16 => array('Заглушка под информацию о персонаже',244,287,5),						
				17 => array('Кольцо №2',20,20,10),
				18 => array('Кольцо №3',20,20,10)					
			);
	  
	  if(isset($_GET['grood_img'])) {
		  
		  $imgid = round((int)$_GET['grood_img']);
		  if(mysql_query('UPDATE `reimage` SET `good` = "'.$u->info['id'].'" WHERE `id` = "'.mysql_real_escape_string($imgid).'" AND `good` = "0" AND `bad` = "0" LIMIT 1')) {
			  //Переносим изображение			  
			  $vr = mysql_fetch_array(mysql_query('SELECT * FROM `reimage` WHERE `id` = "'.mysql_real_escape_string($imgid).'" LIMIT 1'));
			  $vr['format'] = explode('.',$vr['src']);
			  $vr['format'] = $vr['format'][2];
			$extension = 'gif';
			$vr2 = uniqid() . '.' . $extension;
			  if( $vr['type'] == 788 ) {
			  	if(copy('clan_prw/'.$vr['src'],'../img.likebk.com/i/smile/s'.$vr['id'].'.gif')){
				  	$usr1 = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$vr['uid'].'" LIMIT 1'));
					if( $usr1['add_smiles'] != '' ) {
						$usr1['add_smiles'] .= ',';
					}
					$usr1['add_smiles'] .= 's'.$vr['id'];
					mysql_query('UPDATE `users` SET `add_smiles` = "'.$usr1['add_smiles'].'" WHERE `id` = "'.$usr1['id'].'" LIMIT 1');
				  	mysql_query('DELETE FROM `reimage` WHERE `id` = "'.mysql_real_escape_string($imgid).'"');
				}
			  }elseif( $vr['type'] == 789 ) {
			  	if(copy('clan_prw/'.$vr['src'],'../img.likebk.com/i/items/g/'.$vr2)){
				  	mysql_query('INSERT INTO `users_gifts`
				            ( `img`, `uid`, `x`, `name`, `money` ) VALUES
				            (
				              "g/'.$vr2.'",
				              "'.$vr['uid'].'",
				              "10",
							  "Именной подарок",
							  "1"
				            )');
				  	mysql_query('DELETE FROM `reimage` WHERE `id` = "'.mysql_real_escape_string($imgid).'"');
				}
			  }elseif($vr['type'] == 1){
			  	$sex = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$vr['uid'].'"'));
			  	//copy('clan_prw/'.$vr['src'],'../img.likebk.com/rimg/r'.$vr['id'].'.'.$vr['format']);
			  	if(copy('clan_prw/'.$vr['src'],'../img.likebk.com/i/obraz/'.$sex['sex'].'/'.$vr2)){
				  	mysql_query('INSERT INTO `obraz`
				            ( `img`, `uid`, `sex` ) VALUES
				            (
				              "'.$vr2.'",
				              "'.$vr['uid'].'",
				              "'.$sex['sex'].'"
				            )');
				  	mysql_query('DELETE FROM `reimage` WHERE `id` = "'.mysql_real_escape_string($imgid).'"');
				}
				else{
			  		echo "error";
			  	}
			  }elseif($vr['clan'] != 0){
			  	if(copy('clan_prw/'.$vr['src'],'../img.likebk.com/i/obraz/0/'.$vr2)){
			  		mysql_query('INSERT INTO `obraz`
			            ( `img`, `sex`, `clan` ) VALUES
			            (
			              "'.$vr2.'",
			              "0",
			              "'.$vr['clan'].'"
			            )');
			  	}else{
			  		echo "error";
			  	}
			  	if(copy('clan_prw/'.$vr['src'],'../img.likebk.com/i/obraz/1/'.$vr2)){
			  		mysql_query('INSERT INTO `obraz`
			            ( `img`, `sex`, `clan` ) VALUES
			            (
			              "'.$vr2.'",
			              "1",
			              "'.$vr['clan'].'"
			            )');
			  		mysql_query('DELETE FROM `reimage` WHERE `id` = "'.mysql_real_escape_string($imgid).'"');
			  	}else{
			  		echo "error";
			  	}
			  }
			  elseif($vr['type'] == 3){
			  	$sex = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$vr['uid'].'"'));
			  	//copy('clan_prw/'.$vr['src'],'../img.likebk.com/rimg/r'.$vr['id'].'.'.$vr['format']);
			  	if(copy('clan_prw/'.$vr['src'],'../img.likebk.com/i/obraz/'.$sex['sex'].'/'.$vr2)){
				  	mysql_query('INSERT INTO `obraz`
				            ( `img`, `uid`, `sex`, `animal` ) VALUES
				            (
				              "'.$vr2.'",
				              "'.$vr['uid'].'",
				              "'.$sex['sex'].'",
				              "1"
				            )');
				  	mysql_query('DELETE FROM `reimage` WHERE `id` = "'.mysql_real_escape_string($imgid).'"');
				}
				else{
			  		echo "error";
			  	}
			  }
			  
			  //mysql_query('UPDATE `reimage` SET `format` = "'.$vr['format'].'" WHERE `id` = "'.mysql_real_escape_string($imgid).'" LIMIT 1');
			  
		 	  if( $vr['type'] == 788 ) {
				//Отправляем системку
				mysql_query('UPDATE `achiev` SET `a14` = `a14` + "1" WHERE `uid` = '.$vr['uid'].' LIMIT 1');
		  		mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
		  		'1','capitalcity','0','','".$vr['login']."','<font color=red>Внимание!</font> Телеграмма от Администрации: \'Вам одобрили именной смайлик, для его активации обновите окно браузера\'.','-1','5','0')");
			  }elseif( $vr['type'] == 789 ) {
				//Отправляем системку
		  		mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
		  		'1','capitalcity','0','','".$vr['login']."','<font color=red>Внимание!</font> Телеграмма от Администрации: \'Вам одобрили именной подарок, в разделе магазина &quot;Сделать подарок&quot;\'.','-1','5','0')");
			  }elseif($vr['clan'] == 0) {
				  mysql_query('UPDATE `achiev` SET `a15` = `a15` + "1" WHERE `uid` = '.$vr['uid'].' LIMIT 1');
				//Отправляем системку
		  		mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
		  		'1','capitalcity','0','','".$vr['login']."','<font color=red>Внимание!</font> Телеграмма от Администрации: \'Вам одобрили образ, установить изображение возможно в инвентаре, в разделе &quot;Образ&quot;\'.','-1','5','0')");
			  }elseif($vr['type'] == 3) {
			  	//Отправляем системку
		  		mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
		  		'1','capitalcity','0','','".$vr['login']."','<font color=red>Внимание!</font> Телеграмма от Администрации: \'Вам одобрили клановый образ, установить изображение возможно в инвентаре, в разделе &quot;Зверь&quot;-Образ животного\'.','-1','5','0')");
			  }else{
				//Отправляем системку
		  		mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
		  		'1','capitalcity','0','','".$vr['login']."','<font color=red>Внимание!</font> Телеграмма от Администрации: \'Вам одобрили клановый образ, установить изображение возможно в инвентаре, в разделе &quot;Образ&quot;\'.','-1','5','0')");
			  }
		  }
		  
	  }elseif(isset($_GET['bad_img'])) {
		  
		  $imgid = round((int)$_GET['bad_img']);
		  if(mysql_query('UPDATE `reimage` SET `bad` = "'.$u->info['id'].'" WHERE `id` = "'.mysql_real_escape_string($imgid).'" AND `good` = "0" AND `bad` = "0" LIMIT 1')) {
			  //Возвращаем 90% екр. за образ
			  $vr = mysql_fetch_array(mysql_query('SELECT * FROM `reimage` WHERE `id` = "'.mysql_real_escape_string($imgid).'" LIMIT 1'));
			  $vr['money2'] = round($vr['money2']*0.9, 2);
			  
			  if($vr['clan'] > 0) {
				  //возврат для клана				  
				   //mysql_query('UPDATE `clan` SET `money2` = `money2` + '.$vr['money2'].' WHERE `id` = "'.$vr['clan'].'" LIMIT 1');
				    mysql_query('UPDATE `bank` SET `money2` = `money2` + '.$vr['money2'].' WHERE `uid` = "'.$vr['uid'].'" LIMIT 1');
		 			//Отправляем системку
		  			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
		  			'1','capitalcity','0','','".$vr['login']."','<font color=red>Внимание!</font> Телеграмма от Администрации: \'Вам было отказано в покупке кланового образа. <font color=red><b>Причина:</b></font> не соответстие c требованиями. Вам отправлено по почте <b>".$vr['money2']."</b> екр.\'.','-1','5','0')");

			  }else{
				  //возврат для игрока в банк
				  	mysql_query('UPDATE `bank` SET `money2` = `money2` + '.$vr['money2'].' WHERE `uid` = "'.$vr['uid'].'" LIMIT 1');
		 			//Отправляем системку
		  			mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
		  			'1','capitalcity','0','','".$vr['login']."','<font color=red>Внимание!</font> Телеграмма от Администрации: \'Вам было отказано в покупке личного образа. <font color=red><b>Причина:</b></font> не соответстие c требованиями. Вам отправлено по почте <b>".$vr['money2']."</b> екр.\'.','-1','5','0')");
			  
			  }
		  }
		  
	  }
	  
	  $zvr = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `reimage` WHERE `good` = "0"'));
	  if($zvr[0] > 0) {
		  		  
?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <div style="padding:10px;"><b>Заявки на регистрацию изображений:</b> &nbsp; <?
  
  ?>
  </div>
  <script>
  function imresize(e,h,w) {
	 if($(e).height() == 20) {		 
		  $(e).animate({'height':h+'px'},100,null,function(){
			if($(e).width() != w) {
			 	$(e).css({'border-color':'red'});
		 	}else{
				$(e).css({'border-color':'green'}); 
		 	}	  
		  }); 
	 }else{		 
		 $(e).animate({'height':'20px'},100);
		 $(e).css({'border-color':'blue'});	
		 $(e).width(false);	 
	 }
  }
  </script>
  <?
  			
			$sp = mysql_query('SELECT * FROM `reimage` WHERE `good` = "0" AND `bad` = "0" ORDER BY `id` ASC LIMIT 10');
			$i = 1;
			
			$va = array('Нет','Да');
			
			$rt = '';
			while($pl = mysql_fetch_array($sp)) {
				if($pl['bag'] > 0) {
					$rt .= '<font color=red><b>(!)</b>';
				}
				
				$plcln = 0;
				if($pl['clan'] > 0) {
					$plcln = 1;
				}
				if( $pl['type'] == 788 ) {
					$rt .= '<div style="border-top:1px solid grey;padding:5px;">'.$i.'. 
						<span class="date1">'.date('d.m.y H:i',$pl['time']).'</span> 
						<b>'.$u->microLogin($pl['uid'],1).'</b> , &quot;Именной смайлик&quot; 
						<img onclick="imresize(this,'.$types[$pl['type']][2].','.$types[$pl['type']][1].');" style="cursor:pointer;" src="http://'.$c['host'].'/clan_prw/'.$pl['src'].'">';
				}elseif( $pl['type'] == 789 ) {
					$rt .= '<div style="border-top:1px solid grey;padding:5px;">'.$i.'. 
						<span class="date1">'.date('d.m.y H:i',$pl['time']).'</span> 
						<b>'.$u->microLogin($pl['uid'],1).'</b> , &quot;Именной подарок&quot; 
						<img onclick="imresize(this,'.$types[$pl['type']][2].','.$types[$pl['type']][1].');" style="cursor:pointer;" src="http://'.$c['host'].'/clan_prw/'.$pl['src'].'">';
				}elseif($pl['type'] == 1){
					$rt .= '<div style="border-top:1px solid grey;padding:5px;">'.$i.'. 
						<span class="date1">'.date('d.m.y H:i',$pl['time']).'</span> 
						<b>'.$u->microLogin($pl['uid'],1).'</b> , &quot;'.$types[$pl['type']][0].'&quot; 
						<img onclick="imresize(this,'.$types[$pl['type']][2].','.$types[$pl['type']][1].');" style="cursor:pointer;" src="http://'.$c['host'].'/clan_prw/'.$pl['src'].'" height="20">';
				}elseif($pl['clan'] != 0){
					$rt .= '<div style="border-top:1px solid grey;padding:5px;">'.$i.'. <span class="date1">'.date('d.m.y H:i',$pl['time']).'</span> <b>'.$u->microLogin($pl['uid'],1).'</b>, Изображение для клана: <img onclick="imresize(this,'.$types[$pl['type']][2].','.$types[$pl['type']][1].');" style="cursor:pointer;" src="/clan_prw/'.$pl['src'].'" height="20">';
				}
				elseif($pl['type'] == 3){
					$rt .= '<div style="border-top:1px solid grey;padding:5px;">'.$i.'. <span class="date1">'.date('d.m.y H:i',$pl['time']).'</span> <b>'.$u->microLogin($pl['uid'],1).'</b>, Образ животного: <img onclick="imresize(this,'.$types[$pl['type']][2].','.$types[$pl['type']][1].');" style="cursor:pointer;" src="/clan_prw/'.$pl['src'].'" height="20">';
				}
				//$rt .= '<div style="border-top:1px solid grey;padding:5px;">'.$i.'. <span class="date1">'.date('d.m.y H:i',$pl['time']).'</span> <b>'.$u->microLogin($pl['uid'],1).'</b> , &quot;'.$types[$pl['type']][0].'&quot; , Анимация: <b>'.$va[$pl['animation']].'</b> , Изображение для клана: <b>'.$va[$plcln].'</b> , <img onclick="imresize(this,'.$types[$pl['type']][2].','.$types[$pl['type']][1].');" style="border:1px solid blue;cursor:pointer;" src="/clan_prw/'.$pl['src'].'" height="20">';
				
				$rt .= ' <input onclick="location.href=\'main.php?admin=1&grood_img='.$pl['id'].'\'" type="button" value="Принять" style="background:#E2EDD8"> <input type="button" onclick="location.href=\'main.php?admin=1&bad_img='.$pl['id'].'\'" style="background:#FCC9CA" value="Отказать"> <br>';
				
				$rt .= '</div>';
				
				if($pl['bag'] > 0) {
					$rt .= '</font>';
				}
				$i++;
			}
			echo $rt;
			
  ?>
  </div>
<? 
	  }
	  
	  $zvr = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `_clan` WHERE `admin_time` = "0"'));
	  if($zvr[0] > 0) {
  ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <div style="padding:10px;"><b>Заявки на регистрацию кланов:</b> &nbsp; <?
  if(isset($_GET['goodClan'])) {
	 //Разрешение
	 $cl = mysql_fetch_array(mysql_query('SELECT * FROM `_clan` WHERE `admin_time` = "0" AND `id` = "'.mysql_real_escape_string($_GET['goodClan']).'" LIMIT 1')); 
	 if(isset($cl['id'])) {
		 $pu = mysql_fetch_array(mysql_query('SELECT `id`,`city`,`room`,`clan`,`login`,`align`,`level`,`sex`,`money`,`banned` FROM `users` WHERE `id` = "'.mysql_real_escape_string($cl['uid']).'" LIMIT 1'));
		 $tc = mysql_fetch_array('SELECT `id`,`name` FROM `clan` WHERE `name` = "'.mysql_real_escape_string($cl['name']).'" OR `name` = "'.mysql_real_escape_string($cl['name2']).'" OR `name_mini` = "'.mysql_real_escape_string($cl['name']).'" OR `name_mini` = "'.mysql_real_escape_string($cl['name2']).'" OR `name_rus` = "'.mysql_real_escape_string($cl['name']).'" OR `name_rus` = "'.mysql_real_escape_string($cl['name2']).'" LIMIT 1');
		 if(!isset($pu['id'])) {
			 echo '<font color=red><b>Персонаж выступающий в роли Главы клана не найден, id '.$cl['uid'].'</b></font><br>';
		 // }elseif($pu['clan'] > 0 || $pu['align'] > 0 || $pu['banned'] > 0) {
		 }elseif($pu['clan'] > 0 || $pu['banned'] > 0) {
			 //echo '<font color=red><b>Персонаж выступающий в роли Главы клана уже находится в клане, либо имеет склонность, либо заблокирован</b></font><br>';
			 echo '<font color=red><b>Персонаж выступающий в роли Главы клана уже находится в клане, либо заблокирован</b></font><br>';
		 }elseif(isset($tc['id'])) {
			 echo '<font color=red><b>Схожий клан был зарегистрирован ранее, клана №'.$tc['id'].' ('.$tc['name'].').</b></font><br>';
		 }else{
			 mysql_query('UPDATE `_clan` SET `admin_time` = "'.time().'",`admin_ok` = "'.$u->info['id'].'" WHERE `id` = "'.$cl['id'].'" LIMIT 1');
			 //Переносим изображения в img.likebk.com/i/clan/{name}.gif / {name}_big.gif / {id}.gif / {id}.gif			 
			 //Маленький значок
			 if(copy('clan_prw/'.$cl['img1'],'../img.likebk.com/i/clan/'.$cl['name2'].'.gif')) {
				 $ins = mysql_query('INSERT INTO `clan` (`name`,`name_rus`,`name_mini`,`align`,`time_reg`) VALUES (
					"'.$cl['name2'].'",
					"'.$cl['name'].'",
					"'.$cl['name2'].'",
					"'.$cl['align'].'",
					"'.time().'"
				 )');
				 if( $ins ) {
					 $cl['_id'] = mysql_insert_id();
					 mysql_query('INSERT INTO `clan_info` (`id`,`info`) VALUES (
					 "'.$cl['_id'].'",
					 "'.mysql_real_escape_string($cl['info']).'"
					 )');
					 copy('clan_prw/'.$cl['img1'],'../img.likebk.com/i/clan/'.$cl['_id'].'.gif');
					 /*copy('clan_prw/'.$cl['img2'],'../img.likebk.com/i/clan/'.$cl['_id'].'_big.gif');
					 copy('clan_prw/'.$cl['img2'],'../img.likebk.com/i/clan/cln'.$cl['_id'].'.gif');
					 copy('clan_prw/'.$cl['img2'],'../img.likebk.com/i/clan/'.$cl['name2'].'_big.gif');*/
					 mysql_query('UPDATE `users` SET `clan` = "'.$cl['_id'].'",`clan_prava` = "glava",`align` = "'.$cl['align'].'" WHERE `id` = "'.$pu['id'].'" LIMIT 1');
					 
					 echo '<font color=red><b>Вы одобрили регистрацию клана &quot;'.$cl['name'].'&quot;</b></font><br>';
					  //Отправляем системку главе клана
				  	mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
				  	'1','".$pu['city']."','0','','".$pu['login']."','<font color=red>Внимание!</font> ".date("d.m.y H:i")." Телеграмма от Администрации: \'Поздравляем Вас с регистрацией клана &quot;".mysql_real_escape_string($cl['name'])."&quot;, будьте успешны! Соблюдайте законы нашего Мира и всячески помогайте его улучшать.\' .','-1','5','0')");

				 }else{
					  echo '<font color=red><b>Не удалось перенести значок</b></font><br>';
				 }
			 }else{
				 echo '<font color=red><b>Не удалось перенести значок</b></font><br>';
			 }
			
		 }
	 }
  }elseif(isset($_GET['badClan'])) {
	 //Отказ
	 $cl = mysql_fetch_array(mysql_query('SELECT * FROM `_clan` WHERE `admin_time` = "0" AND `id` = "'.mysql_real_escape_string($_GET['badClan']).'" LIMIT 1')); 
	 if(isset($cl['id'])) {
		  $pu = mysql_fetch_array(mysql_query('SELECT `id`,`city`,`room`,`clan`,`login`,`align`,`level`,`sex`,`money`,`banned` FROM `users` WHERE `id` = "'.mysql_real_escape_string($cl['uid']).'" LIMIT 1')); 
		  echo '<font color=red><b>Вы отказали в регистрации клану &quot;'.$cl['name'].'&quot;</b></font><br>';
		  mysql_query('UPDATE `_clan` SET `admin_time` = "'.time().'",`admin_ca` = "'.$u->info['id'].'" WHERE `id` = "'.$cl['id'].'" LIMIT 1');
		  //Отправляем системку персонажу
		  mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
		  '1','".$pu['city']."','0','','".$pu['login']."','<font color=red>Внимание!</font> ".date("d.m.y H:i")." Телеграмма от Администрации: \'К сожалению Вам отказано в регистрации клана &quot;".mysql_real_escape_string($cl['name'])."&quot;, были не соблюдены правила регистрации. Вам отправлено по почте ".round($cl['money']*0.9,2)." кр.\' .','-1','5','0')");
	 	  
		  //Отправляем сумму
			// mysql_query("INSERT INTO `items_users`(`item_id`,`1price`,`uid`,`delete`,`lastUPD`)VALUES('1220','".mysql_real_escape_string(round($cl['money']*0.9,2))."','-51".$pu['id']."','0','".time()."');");
					
			$txt = 'Деньги от Администрации: '.round($cl['money']*0.9,2).' кр. Прибытие: '.date('d.m.Y H:i',time()).'';
			mysql_query('UPDATE `users` SET `money` = (`money` + '.round($cl['money']*0.9,2).') WHERE `id` = "'.$pu['id'].'"');
			// mysql_query('INSERT INTO `post` (`uid`,`sender_id`,`time`,`money`,`text`) VALUES("'.$pu['id'].'","0","'.time().'",
			// "'.mysql_real_escape_string(round($cl['money']*0.9,2)).'","'.mysql_real_escape_string($txt).'")');

			//чат
			/*mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
			'1','".$pu['city']."','0','','".$pu['login']."','<font color=red>Внимание!</font> Получена новая почта от Администрации','-1','5','0')");
		  */
	 }
  }
  ?></div>
  <script>
  function imgResize1(id) {
	  if($('#'+id).width() == 16) {
		  $('#'+id).animate({'height':'99px','width':'100px'},'fast');
	  }else{
		  $('#'+id).animate({'height':'15px','width':'16px'},'fast');
	  }
  }
  function seeClanINfo(id) {
	 if( $('#'+id).css('display') == 'block') {
		 $('#'+id).fadeOut('fast');
	 }else{
		 $('#'+id).fadeIn('fast');
	 }
  }
  </script>
  <?
  		$sp = mysql_query('SELECT * FROM `_clan` WHERE `admin_time` = "0" ORDER BY `time` ASC LIMIT 10');
		while($pl = mysql_fetch_array($sp)) {
			echo '<div style="border-top:1px solid grey;padding:5px;">
			#'.$pl['id'].' <font color="#cac9c7">|</font>
			'.date('d.m.y H:i',$pl['time']).' / '.$pl['money'].'.00 кр.
			<font color="#cac9c7">|</font>
			<img style="border:1px solid grey;display:inline-block;vertical-align:bottom;margin:0;padding:1px;" src="http://likebk.com/clan_prw/'.$pl['img1'].'" width="24" height="15">'.
			'<span id="img'.$pl['id'].'clan2"><img id="img'.$pl['id'].'clan" style="border:1px solid blue;border-left:0;display:inline-block;vertical-align:bottom;margin:0;padding:0;" src="http://likebk.com/clan_prw/'.$pl['img1'].'">'.
			'<script>$("#img'.$pl['id'].'clan").ready(function(){$("#img'.$pl['id'].'clan2").html(" "+$("#img'.$pl['id'].'clan").width()+"x"+$("#img'.$pl['id'].'clan").height()); });</script>
			</span>
			<font color="#cac9c7">|</font>
			<img id="img'.$pl['id'].'clan30" style="border:1px solid grey;display:inline-block;cursor:pointer;vertical-align:bottom;margin:0;padding:1px;width:16px;height:15px;" onclick="imgResize1(\'img'.$pl['id'].'clan30\')" src="http://likebk.com/clan_prw/'.$pl['img2'].'">'.
			'<span id="img'.$pl['id'].'clan4"><img id="img'.$pl['id'].'clan3" style="border:1px solid blue;border-left:0;display:inline-block;vertical-align:bottom;margin:0;padding:0;" src="http://likebk.com/clan_prw/'.$pl['img2'].'">'.
			'<script>$("#img'.$pl['id'].'clan3").ready(function(){$("#img'.$pl['id'].'clan4").html(" "+$("#img'.$pl['id'].'clan3").width()+"x"+$("#img'.$pl['id'].'clan3").height()); });</script>
			</span>
			<font color="#cac9c7">|</font>
			'.$u->microLogin($pl['uid'],1).'
			<font color="#cac9c7">|</font>
			<span style="display:inline-block;background:white;padding:2px 20px 2px 20px;text-align:center;">'.$pl['name'].'</span>
			<font color="#cac9c7">|</font>
			<span style="display:inline-block;background:white;padding:2px 20px 2px 20px;text-align:center;">'.$pl['name2'].'</span> (EN)
			<font color="#cac9c7">|</font>
			<img src="http://img.likebk.com/i/align/align'.$pl['align'].'.gif">
			<font color="#cac9c7">|</font>
			<a href="javascript:void(0)" onClick="seeClanINfo(\'clndiv'.$pl['id'].'\');">Сайт и Описание</a>
			<font color="#cac9c7">|</font>
			&nbsp;<input onclick="location.href=\'?admin=1&goodClan='.$pl['id'].'\'" type="button" value="Разрешить"> &nbsp;<font color="#cac9c7">|</font>&nbsp; <input onclick="location.href=\'?admin=1&badClan='.$pl['id'].'\'" type="button" value="Отказать">
				<div id="clndiv'.$pl['id'].'" style="padding:10px;display:none">
					<b>Сайт клана:</b> <a target="_blank" href="'.$pl['site'].'">'.$pl['site'].'</a><br><Br>
					Описание клана (для библиотеки):<br>
					<div style="max-width:620px;margin:10px;padding:10px;background:white;">
					<img src="http://likebk.com/clan_prw/'.$pl['img2'].'" width="100" height="99" style="float:right">
					<center><h3>'.$pl['name'].'</h3></center>
					<br><div style="text-align:justify;">'.$pl['info'].'</div></div>
					<div style="width:600px;" align="center"><a href="javascript:void(0)" onClick="seeClanINfo(\'clndiv'.$pl['id'].'\');">(Скрыть информаци сайта и описания)</a></div>					
				</div>
			</div>';
		}
  ?>
  </div>
  <? 
	  }
  }
	
  if($u->info['admin'] > 0) {
	  if(isset($_POST['add_item_to_user2'])) {
		 $uad = mysql_fetch_array(mysql_query('SELECT `id`,`login` FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['add_item_to_login']).'" LIMIT 1'));
		 if( isset($uad['id'])) {
		 	$u->addItem(round((int)$_POST['add_item_to_user']),$uad['id']);
			mysql_query('INSERT INTO `users_delo` (`onlyAdmin`,`hb`,`uid`,`time`,`city`,`text`,`login`,`ip`) VALUES ("1","0","'.$uad['id'].'","'.time().'","'.$uad['city'].'","'.$rang.' &quot;'.$u->info['login'].'&quot; <font color=red>выдал предмет</font>: №'.round((int)$_POST['add_item_to_user']).' персонажу <b>'.$uad['login'].'</b>.","'.$u->info['login'].'","'.$u->info['ip'].'")');
			echo '<font color=red><b>Предмет был доставлен к персонажу</b></font>';
		 }else{
			 echo '<font color=red><b>Персонаж не найден</b></font>';
		 }
	  }
  ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  Выдать предмет <input name="add_item_to_user" value="" /> персонажу <input name="add_item_to_login" value="<?if(isset($_POST['add_item_to_login']))echo $_POST['add_item_to_login'];?>" />
  <input type="submit" name="add_item_to_user2" id="add_item_to_user2" value="Выдать" />
  </div>
  <? 
  }
	
  if($p['addld']==1 || $p['cityaddld']==1){ ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
    Добавить в "дело" игрока заметку о нарушении правил, накрутке и пр.<br />
	<?
	  	if(isset($_POST['pometka']))
		{
			$er = '';
			$usr = mysql_fetch_array(mysql_query('SELECT `id`,`login`,`city`,`admin`,`align` FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['loginLD']).'" LIMIT 1'));
			if(isset($usr['id']))
			{
				if( true == false && ($u->info['align']>1 && $u->info['align']<2 && $usr['align']>3 && $usr['align']<4) || ($usr['align']>1 && $usr['align']<2 && $u->info['align']>3 && $u->info['align']<4) || $usr['admin']>$u->info['admin'])
				{
					$er = 'Персонаж "'.$_POST['loginLD'].'" носит вражескую склонность.';	
				}else{
					//Заносим данные в ЛД
					$lastD = mysql_fetch_array(mysql_query('SELECT `id` FROM `users_delo` WHERE `login` = "'.$u->info['login'].'" AND `time`>'.(time()-3).' LIMIT 1'));
					if(!isset($lastD['id']))
					{
						$hbld = 0;
						$hbld2 = 0;
						if(isset($_POST['hbld']))
						{
							$hbld = $a;
						}
						if(isset($_POST['hbldt'])) {
							$hbld2 = 1;
						}
						$ins = mysql_query('INSERT INTO `users_delo` (`onlyAdmin`,`hb`,`uid`,`time`,`city`,`text`,`login`,`ip`) VALUES ("'.$hbld2.'","'.$hbld.'","'.$usr['id'].'","'.time().'","'.$usr['city'].'","'.$rang.' &quot;'.$mod_login.'&quot; <b>сообщает</b>: '.mysql_real_escape_string(htmlspecialchars($_POST['textLD'],NULL,'cp1251')).'","'.$u->info['login'].'","'.$u->info['ip'].'")');
						if(!$ins)
						{
							$er = 'Ошибка записи в личное дело';
						}else{
							$er = 'Запись в личное дело прошла успешно';
						}
					}else{
						$er = 'Писать пометки в личном деле можно не чаще одного раза в 3 секунды.';
					}
				}
			}else{
				$er = 'Персонаж с логином "'.$_POST['loginLD'].'" не найден.';
			}
			if($er!='')
			{
				echo '<font color="red"><b>'.$er.'</b></font><br>';
			}
		}
	  ?>
    Введите логин
  <input name="loginLD" type="text" id="loginLD" size="30" maxlength="30" />
    Сообщение
  <input name="textLD" type="text" id="textLD" size="70" maxlength="500" /> <input type="submit" name="pometka" id="pometka" value="Добавить" />
  <br />
  <label>
  <input name="hbld" type="checkbox" id="hbld" value="1" />  
    Записать, как причину отправки в хаос\блокировки
  </label>
  <? if($u->info['admin'] > 0) { ?>
  <br /><label>
  <input name="hbldt" type="checkbox" id="hbldt" value="1" />  
    Записать в секретное дело (видят только верховные и администрация)
  </label>
  <? }
  } if($p['readPerevod']==1){
  if(isset($_POST['itemID1b'])) {
	  $its = '';
	  $its = $u->genInv(1,'`iu`.`id` = "'.mysql_real_escape_string($_POST['itemID1']).'" LIMIT 1');
	  if($its[0] == 0) {
		 $its = 'Предмет не найден.'; 
	  }else{
		  $its = $its[2];
	  }
	  echo '<br><br><b>Предмет <u>id'.$_POST['itemID1'].'</u>:</b><br>'.$its;
  }
  ?><div style="padding-top:10px;">
    Проверить наличие предмета у персонажа <small>(не обязательно)</small> 
      <input name="itemID1login" type="text" id="itemID1login" size="30" maxlength="30" />
    , id предмета 
      <input name="itemID1" type="text" id="itemID1" size="30" maxlength="30" />
      <input type="submit" name="itemID1b" id="itemID1b" value="Проверить" />
    </div>
  </div>
  <?
	$dsee = array();
	$dsee['login'] = $_POST['loginacts1'];
	$dsee['date'] = date('d.m.Y',time());
	if(isset($_POST['datesee']))
	{
		$dsee['date'] = $_POST['datesee'];
	}
	$dsee['date'] = explode('.',$dsee['date']);
	$dsee['date'] = $dsee['date'][2].'-'.$dsee['date'][1].'-'.$dsee['date'][0];
	$dsee['t1'] = strtotime($dsee['date'].' 00:00:00');
	$dsee['t2'] = strtotime($dsee['date'].' 23:59:59');
	$dsee['date'] = date('d.m.Y',$dsee['t1']);	
	 $i = 2;
	 while($i<=8)
	 {
		 if($_POST['hbld'.$i]==1)
		 {
		 	$dsee[$i] = 1;
		 }else{
			$dsee[$i] = 0; 
		 }
		 $i++;
	 }
  ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
    <h4>Показать переводы кредитов/вещей</h4>
    Просмотр действий персонажа
      <input name="loginacts1" type="text" id="loginacts1" value="<?=$dsee['login']?>" size="30" maxlength="30" />
      <br /> 
      <input <? if($dsee[2]==1){ echo 'checked="checked"'; } ?> name="hbld2" type="checkbox" id="hbld2" value="1" />
    переводы 
      
  , 
    <input <? if($dsee[3]==1){ echo 'checked="checked"'; } ?> name="hbld3" type="checkbox" id="hbld3" value="1" />
    банк

    , 
    <input <? if($dsee[4]==1){ echo 'checked="checked"'; } ?> name="hbld4" type="checkbox" id="hbld4" value="1" />
    покупка / ремонт

    , 
    <input <? if($dsee[5]==1){ echo 'checked="checked"'; } ?> name="hbld5" type="checkbox" id="hbld5" value="1" />
    работа с инвентарем

    ,
    <input <? if($dsee[6]==1){ echo 'checked="checked"'; } ?> name="hbld6" type="checkbox" id="hbld6" value="1" />
поединки ,
    <input <? if($dsee[7]==1){ echo 'checked="checked"'; } ?> name="hbld7" type="checkbox" id="hbld7" value="1" /> добавление предметов,
	
    <input <? if($dsee[8]==1){ echo 'checked="checked"'; } ?> name="hbld8" type="checkbox" id="hbld8" value="1" /> почта <br />
    За дату  
    <input name="delosee_1" onclick="document.getElementById('datesee').value='<?=date('d.m.Y',($dsee['t1']-86400))?>';" type="submit" value="&laquo;" />
    <input name="datesee" type="text" id="datesee" value="<?=$dsee['date']?>" size="15" maxlength="10" />
    <input name="delosee_2" onclick="document.getElementById('datesee').value='<?=date('d.m.Y',($dsee['t1']+86400))?>';" type="submit" value="&raquo;" />
    <input type="submit" name="delosee" id="delosee" value="Отправить" />
    <?
	if(isset($_POST['delosee']) || isset($_POST['delosee_1']) || isset($_POST['delosee_2'])) {
	?>
    <div style="padding:0 0 5px 0; border-bottom:1px solid #cac9c7;">
    <small>Дата логов: <?=$dsee['date']?>, логин: <?=$dsee['login']?></small>
    </div>
    <?
	$dsee['inf'] = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($dsee['login']).'" LIMIT 1'));
	if(isset($dsee['inf']['id']) && ($dsee['inf']['admin']==0 || $u->info['admin']>0))
	{
		$sp = mysql_query('SELECT * FROM `users_delo` WHERE `uid` = "'.$dsee['inf']['id'].'" AND `time` >= "'.$dsee['t1'].'" AND `time` <= "'.$dsee['t2'].'" ORDER BY `time` DESC LIMIT 10000');
		while($pl = mysql_fetch_array($sp))
		{
			$dl = explode('.',$pl['login']);
			$se = 1;
			//echo $d1[0];
			     if($dl[0]=='AddItems' && $dsee[7]==0){ $se = 0;
			}elseif($dl[0]=='Bank' && $dsee[3]==0){ $se = 0;
			}elseif(($dl[0]=='Shop' || $dl[0]=='EkrShop') && $dsee[4]==0){ $se = 0;
			}elseif($dl[1]=='remont' && $dsee[4]==0){ $se = 0;
			}elseif($dl[1]=='shop' && $dsee[4]==0){ $se = 0; 
			}elseif($dl[1]=='inventory' && $dsee[5]==0){ $se = 0;
			}elseif($dl[1]=='transfer' && $dsee[2]==0){ $se = 0;
			}
			if($se==1)
			{
				$dsee['dv'] .= '<small>'.date('d.m.Y H:i',$pl['time']).' / <b>'.$pl['login'].'</b>:</small> '.$pl['text'];
				$dsee['dv'] .= '<br>';
			}
		}
		if($dsee[8]==1){
			//$sp1 = mysql_query('SELECT * FROM `post` WHERE  `uid` = "'.$dsee['inf']['id'].'" AND `time` >= "'.$dsee['t1'].'" AND `time` <= "'.$dsee['t2'].'" OR `sender_id` = "'.$dsee['inf']['id'].'" AND `time` >= "'.$dsee['t1'].'" AND `time` <= "'.$dsee['t2'].'" OR `sender_id` = "-'.$dsee['inf']['id'].'" AND `time` >= "'.$dsee['t1'].'" AND `time` <= "'.$dsee['t2'].'" LIMIT 10000');
			$sp1 = mysql_query('SELECT * FROM `post` WHERE  `uid` = "'.$dsee['inf']['id'].'" AND `time` >= "'.$dsee['t1'].'" AND `time` <= "'.$dsee['t2'].'" ORDER BY `time` DESC LIMIT 10000');
			echo '<hr/>';
			while($pl1 = mysql_fetch_array($sp1))
			{
				if (!$pl1['item_id']==0) {$dseetext = "[item:#".$pl1['item_id']."]";}
				$dsee['dv'] .= '<small>'.date('d.m.Y H:i',$pl1['time']).' / <b>Почтовая посылка</b>:</small>'.$pl1['text'].' '.$dseetext;
				$dsee['dv'] .= '<br>';
				$dseetext="";
			} 
		}
		$sp1 = mysql_query('SELECT * FROM `clan_operations` WHERE  `uid` = "'.$dsee['inf']['id'].'" AND `time` >= "'.$dsee['t1'].'" AND `time` <= "'.$dsee['t2'].'" ORDER BY `time` DESC LIMIT 10000');
		echo '<hr/>';
		while($pl1 = mysql_fetch_array($sp1))
		{
			$pl1['text'] = ' Персонаж ';
			if( $pl1['type'] == 1 ) {
				$pl1['text'] .= '<b>снял кредиты</b> с казны клана: '.$pl1['val'].' кр.';
			}elseif( $pl1['type'] == 2 ) {
				$pl1['text'] .= '<b>положил кредиты</b> в казну клана: '.$pl1['val'].' кр.';
			}elseif( $pl1['type'] == 5 ) {
				$pl1['text'] .= '<b>взял</b> предмет &quot;'.$pl1['val'].'&quot; из хранилища клана.';
			}elseif( $pl1['type'] == 4 ) {
				$pl1['text'] .= '<b>пожертвовал</b> предмет &quot;'.$pl1['val'].'&quot; в хранилище клана.';
			}elseif( $pl1['type'] == 7 ) {
				$pl1['text'] .= '<b>получил</b> предмет &quot;'.$pl1['val'].'&quot; из хранилища клана. (Самостоятельный выход)';
			}elseif( $pl1['type'] == 8 ) {
				$pl1['text'] .= '<b>получил</b> предмет &quot;'.$pl1['val'].'&quot; из хранилища клана. (Был изгнан из клана)';
			}elseif( $pl1['type'] == 3 ) {
				$pl1['text'] .= '<b>вернул</b> предмет &quot;'.$pl1['val'].'&quot; в хранилища клана.';
			} elseif( $pl1['type'] == 6 ) {
				$pl1['text'] .= '<b>изъял</b> предмет &quot;'.$pl1['val'].'&quot;.';
			} elseif( $pl1['type'] == 9 ) {
				$pl1['text'] .= '<b>вернул</b> предмет &quot;'.$pl1['val'].'&quot;. [Выход из клана (Возврат вещей не пренадлежащих персонажу)]';
			}else{
				$pl1['text'] .= '<u>Незивестная ошибка. Код: '.$pl1['val'].' / '.$pl1['type'].'</u>';
			}
			$dsee['dv'] .= '<small>'.date('d.m.Y H:i',$pl1['time']).' / <b style="color:green">Клановая казна</b>:</small>'.$pl1['text'].' '.$dseetext;
			$dsee['dv'] .= '<br>';
			$dseetext="";
		} 
		
		if($dsee['dv']=='')
		{
			echo '<font color="red"><b>Действий и переводов за <B>'.$dsee['date'].'</B> не найдено.</b></font>';
		}else{
			echo $dsee['dv'];
		}
	}else{
		echo '<font color="red"><b>Персонаж не найден, либо его дело нельзя просматривать...</b></font>';
	}
	?>
    <? } ?>
  </div>
  <? } 
  
  if($p['telegraf']==1 || $u->info['align'] == 1.99 || ($u->info['align'] >= 1.9 && $u->info['align'] < 2) || $u->info['admin'] > 0) {
	  if(isset($_POST['pometka5'])) {
		 $tous = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['loginLD5']).'" LIMIT 1')); 
		 if(isset($tous['id'])) {
			 if($u->info['align'] > 1 && $u->info['align'] < 2) {
				 $zvnt = 'Паладин <b>'.$mod_login.'</b> сообщает';
				 $zvno = 'Орден Света';
			 }elseif($u->info['align'] > 3 && $u->info['align'] < 4) {
				 $zvnt = 'Тарман <b>'.$mod_login.'</b> сообщает';
				 $zvno = 'Армада';
			 }elseif($u->info['admin'] > 0) {
				 $zvnt = 'Администрация сообщает';
				 $zvno = 'Администрация';
			 }else{
				 $zvnt = 'Администрация сообщает.';
				 $zvno = 'Администрация';
			 }
			 mysql_query('INSERT INTO `telegram` (`uid`,`from`,`tema`,`text`,`time`) VALUES ("'.$tous['id'].'","<b><font color=red>'.$zvno.'</font></b>","'.$zvnt.'","'.mysql_real_escape_string(htmlspecialchars($_POST['textLD5'],NULL,'cp1251')).'","'.time().'")');
		 	 echo '<font color="red"><b>Сообщение успешно отправлено</b></font>';
		 }else{
			 echo '<font color="red"><b>Персонаж не найден...</b></font>';
		 }
	  }
  ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Отправить телеграф</h4>  
  Введите логин  <input name="loginLD5" type="text" id="loginLD5" size="30" maxlength="30" /> Сообщение <input name="textLD5" type="text" id="textLD5" size="70" maxlength="1000" /> <input type="submit" name="pometka5" id="pometka5" value="Написать" />
  </div>
  <?  
  }
  
  
  if( $u->info['align'] == 1.99 || ($u->info['align'] >= 1.9 && $u->info['align'] < 2) || $u->info['admin'] > 0 ) {
  if( isset($_POST['loginLD5154'])) {
	 $usrch = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_POST['loginLD5154']).'" ORDER BY `id` ASC LIMIT 1')); 
  	if(isset($usrch['id']) && ($usrch['align'] > 1 && $usrch['align'] < 2)) {
		$usrch['mod_zvanie'] = $_POST['zvLD5154'];
		$usrch['mod_zvanie'] = htmlspecialchars($usrch['mod_zvanie'],NULL,'cp1251');
		mysql_query('UPDATE `users` SET `mod_zvanie` = "'.mysql_real_escape_string($usrch['mod_zvanie']).'" WHERE `id` = "'.$usrch['id'].'" LIMIT 1');
		echo '<div><font color=red><b>Звание паладина &quot;'.$usrch['login'].'&quot; изменено на &quot;'.$usrch['mod_zvanie'].'&quot;!</b></font></div>';
	}else{
		echo '<div><font color=red><b>Паладин с логином &quot;'.$_POST['loginLD5154'].'&quot; не найден!</b></font></div>';
	}
  }
  ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Изменить звание Паладина</h4>  
  Введите логин  <input name="loginLD5154" type="text" id="loginLD5154" size="30" maxlength="30" /> новое звание <input name="zvLD5154" type="text" id="zvLD5154" size="30" maxlength="30" /> <input type="submit" name="pometka5154" id="pometka5154" value="Сменить" />
  </div>
  <? 
  }
  
  if($p['seeld']==1 && $u->info['align'] != 1.7 && $u->info['align'] != 1.75) {
  ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Персонажи на одном ip-адресе</h4>  
  Введите ip-адрес  <input name="loginLD51" type="text" id="loginLD51" size="30" maxlength="30" /> <input type="submit" name="pometka51" id="pometka51" value="Показать" />
  </div>
<?
  if(isset($_POST['pometka51'])) {
	 $sp = mysql_query('SELECT * FROM `logs_auth` WHERE `ip` = "'.mysql_real_escape_string($_POST['loginLD51']).'" AND `type` != 3 GROUP BY `uid`'); 
	 $i = 1;
	 $r = '';
	 $ursz = array();
	 while($pl = mysql_fetch_array($sp)) {
		 if(!isset($ursz[$pl['uid']])) {
			$ursz[$pl['uid']] = $u->microLogin($pl['uid'],1); 
		 }
		 $de = mysql_fetch_array(mysql_query('SELECT min(`time`),max(`time`) FROM `logs_auth` WHERE `uid` = "'.mysql_real_escape_string($pl['uid']).'" GROUP BY `uid` LIMIT 1'));
		 $r .= '<div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">';
		 $r .= '<span style="display:inline-block;width:30px">'.$i.'.</span> <span style="display:inline-block;width:250px">'.$ursz[$pl['uid']].'</span>';
		 
		 $r .= ' &nbsp; <small>(Череда авторизаций: '.date('d.m.Y H:i',$de[0]).' - '.date('d.m.Y H:i',$de[1]).')</small>';
		 
		 $r .= '</div>';
		 $i++;
	 }
	 
	 if( $u->info['admin'] == 0 && $u->info['align'] != 1.99 ) {
	 	echo '&nbsp;&nbsp; <font color="red">Список персонажей с ip-адреса:<b>'.$_POST['loginLD51'].'</b></font><br>';
	 }else{
		$block = mysql_fetch_array(mysql_query('SELECT * FROM `block_ip` WHERE `ip` = "'.mysql_real_escape_string($_POST['loginLD51']).'" LIMIT 1')); 
	 	if(!isset($block['id'])) {
			echo '&nbsp;&nbsp; <font color="green">Список персонажей с ip-адреса:<b>'.$_POST['loginLD51'].'</b></font>';
			echo ' <input onclick="location.href=\'main.php?'.$zv.'&block_ip='.htmlspecialchars($_POST['loginLD51']).'\'" type="button" value="Заблокировать IP">';
			echo '<br>';
		}else{
			echo '&nbsp;&nbsp; <font color="red">Список персонажей с ip-адреса:<b>'.$_POST['loginLD51'].'</b></font>';
			echo ' <input onclick="location.href=\'main.php?'.$zv.'&unblock_ip='.htmlspecialchars($_POST['loginLD51']).'\'" type="button" value="Разблокировать IP">';
			echo '<br>';
		}
	 }
	 
	 
	 if($r == '') {
		 echo '<div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">Персонажи с данным ip-адресом не найдены</div>';
	 }else{
		 echo $r;
	 }	 
	 unset($r);
  }
?>
  <?
  $pld520 = date('d.m.Y');
  if( isset($_POST['loginLD520']) ) {
	  $pld520 = $_POST['loginLD520'];
  }
  $pld520TS = strtotime(str_replace(".", "-", $pld520));
  $pld520 = date('d.m.Y',$pld520TS);
  if( $u->info['align'] != 1.99 && $u->info['align'] != 1.999 ) {
  ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Регистрации персонажей</h4>  
  Дата регистрации  
  <input name="pometka520" onclick="document.getElementById('loginLD520').value='<?=date('d.m.Y',($pld520TS-86400))?>';" type="submit" value="&laquo;" />
  <input value="<?=$pld520?>" name="loginLD520" type="text" id="loginLD520" size="20" maxlength="10" /> 
  <input name="pometka520" onclick="document.getElementById('loginLD520').value='<?=date('d.m.Y',($pld520TS+86400))?>';" type="submit" value="&raquo;" />
  <input type="submit" name="pometka520" id="pometka520" value="Показать" />
  <?
  if( isset($_POST['pometka520'])) {
	  $sp = mysql_query('SELECT `users`.`id`,`users`.`host_reg`,`users`.`banned`,`users`.`battle`,`users`.`online`,`users`.`molch1`,`users`.`bithday` FROM `users` LEFT JOIN `stats` ON `stats`.`id` = `users`.`id` WHERE `users`.`bithday` != "01.01.1800" AND `stats`.`bot` = 0 AND `users`.`timereg` >= '.$pld520TS.' AND `users`.`timereg` < '.($pld520TS+86400).' ORDER BY `users`.`id` ASC');
	  $i = 1;
	  echo '<br><b><font color=red>Персонажи зарегистрированные '.$pld520.'</font></b>';
	  while( $pl = mysql_fetch_array($sp) ) {
		 $urt5202 = '<br>'.$i.'. '.$u->microLogin($pl['id'],1).''; 
		 
		 if( $pl['banned'] > 0 ) {
			 $urt5202 = '<font color=red>'.$urt5202.'</font>';
		 }elseif( $pl['online'] > time()-520 ) {
			 $urt5202 = '<font color=green>'.$urt5202.'</font>';
		 }
		 if( $pl['molch1'] > time() ) {
			 $urt5202 .= ' <img title="На персонаже молчанка" src=http://img.likebk.com/i/sleep2.gif width=24 height=15>';
		 }
		 if( $pl['battle'] > 0 ) {
			 $urt5202 .= ' <a href="/logs.php?log='.$pl['battle'].'" target="_blank"><img src=http://img.likebk.com/i/fighttype0.gif title="Персонаж в поединке"></a>';
		 }
		 if( $pl['host_reg'] > 0 ) {
			 $urt5202 .= ' &nbsp; <small>(Реферал персонажа '.$u->microLogin($pl['host_reg'],1).')</small>';
		 }
		 $urt520 .= $urt5202;
		 $i++;
	  }
	  echo $urt520;
	  unset($urt520,$i,$pl,$sp);
  }
  ?>
  </div>
  <? }
  
  $pld5209 = date('d.m.Y');
  if( isset($_POST['loginLD5209']) ) {
	  $pld5209 = $_POST['loginLD5209'];
  }
  $pld5209TS = strtotime(str_replace(".", "-", $pld5209));
  $pld5209 = date('d.m.Y',$pld5209TS);
  if( $u->info['admin'] > 0 || $u->info['align'] == 1.99 || $u->info['align'] == 1.999 ) {
  ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Продажа екр. персонажам</h4>  
  Дата регистрации  
  <input name="pometka5209" onclick="document.getElementById('loginLD5209').value='<?=date('d.m.Y',($pld5209TS-86400))?>';" type="submit" value="&laquo;" />
  <input value="<?=$pld5209?>" name="loginLD5209" type="text" id="loginLD5209" size="20" maxlength="10" /> 
  <input name="pometka5209" onclick="document.getElementById('loginLD5209').value='<?=date('d.m.Y',($pld5209TS+86400))?>';" type="submit" value="&raquo;" />
  <input type="submit" name="pometka5209" id="pometka5209" value="Показать" />
  <?
  if( isset($_POST['pometka5209'])) {
	  //if( $u->info['admin'] > 0 ) {
		  $sp = mysql_query('SELECT * FROM `users_delo` WHERE `login` = "AlhimPayment" AND `time` >= '.$pld5209TS.' AND `time` < '.($pld5209TS+86400).' ORDER BY `id` ASC');
		  $i = 1;
		  echo '<div><br><b><font color=red>Продажи алхимиков '.$pld5209.'</font></b>';
		  while( $pl = mysql_fetch_array($sp) ) {
			 $urt52092 = '<br>'.$i.'. '.$u->microLogin($pl['uid'],1).' '.$pl['text'].''; 		
			 $urt5209 .= $urt52092;
			 $i++;
		  }
		  $sp = mysql_query('SELECT * FROM `delo` WHERE `login` = "AlhimPayment" AND `time` >= '.$pld5209TS.' AND `time` < '.($pld5209TS+86400).' ORDER BY `id` ASC');
		  $i = 1;
		  while( $pl = mysql_fetch_array($sp) ) {
			 $urt52092 = '<br>'.$i.'. '.$u->microLogin($pl['uid'],1).' '.$pl['text'].''; 		
			 $urt5209 .= $urt52092;
			 $i++;
		  }
		  mysql_select_db('like_delo',$dbgo);
		  $sp = mysql_query('SELECT * FROM `delo` WHERE `login` = "AlhimPayment" AND `time` >= '.$pld5209TS.' AND `time` < '.($pld5209TS+86400).' ORDER BY `id` ASC');
		  mysql_select_db('like',$dbgo);
		  while( $pl = mysql_fetch_array($sp) ) {
			 $urt52092 = '<br>'.$i.'. '.$u->microLogin($pl['uid'],1).' '.$pl['text'].''; 		
			 $urt5209 .= $urt52092;
			 $i++;
		  }		  
		  echo $urt5209.'</div>';
		  unset($urt5209,$i,$pl,$sp);
	  //}
  }
  ?>
  </div>
  <? }
  
  ?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Авторизации с ip-адреса (последнии 100)</h4>  
  Введите ip-адрес  <input name="loginLD52" type="text" id="loginLD52" size="30" maxlength="30" /> <input type="submit" name="pometka52" id="pometka52" value="Показать" />
  <input type="submit" name="pometka53" id="pometka53" value="Показать (неудачные)" />
  </div>
  <?
	  if(isset($_POST['pometka52']) || isset($_POST['pometka53'])) {
		 if(isset($_POST['pometka53'])) {
		 	$sp = mysql_query('SELECT * FROM `logs_auth` WHERE `ip` = "'.mysql_real_escape_string($_POST['loginLD52']).'" AND `type` = "3" ORDER BY `id` DESC LIMIT 100'); 		 
		 }else{
		 	$sp = mysql_query('SELECT * FROM `logs_auth` WHERE `ip` = "'.mysql_real_escape_string($_POST['loginLD52']).'" ORDER BY `id` DESC LIMIT 100'); 
		 }
		 $i = 1;
		 $r = '';
		 $ursz = array();
		 while($pl = mysql_fetch_array($sp)) {
			 if(!isset($ursz[$pl['uid']])) {
				$ursz[$pl['uid']] = $u->microLogin($pl['uid'],1); 
			 }
			 $r .= '<div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">';
			 $r .= '<span style="display:inline-block;width:30px">'.$i.'.</span> <span style="display:inline-block;width:250px">'.$ursz[$pl['uid']].'</span>';
			 if($pl['type']==3) {
				 $r .= '<span style="display:inline-block;width:100px;color:red;">неудачно</span>';
			 }else{
				 $r .= '<span style="display:inline-block;width:100px;color:green;">успешно</span>';
			 }
			 $r .= ' &nbsp; '.date('d.m.Y H:i',$pl['time']).'';
			 
			 $r .= '</div>';
			 $i++;
		 }
		 
		 echo '&nbsp;&nbsp; <font color="red">Список последних 100 авторизаций с ip-адресом:<b>'.$_POST['loginLD51'].'</b></font><br>';
		 if($r == '') {
			 if(isset($_POST['pometka53'])) {
			 	echo '<div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">Авторизации с данным ip-адресом не найдены (неудачные)</div>';
			 }else{
				echo '<div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">Авторизации с данным ip-адресом не найдены</div>'; 
			 }
		 }else{
			 echo $r;
		 }	 
		 unset($r);
	  }
  }
  
  if($u->info['admin'] > 0 || $u->info['align'] == 1.99 || $u->info['align'] == 1.9 || $u->info['align'] == 1.91 || $u->info['id'] == 581644){
	$dsee = array();
	if(!isset($_POST['smod1'])) {
		$_POST['smod1'] = date('d.m.Y');
	}
	$dsee['date'] = explode('.',$_POST['smod1']);
	$dsee['date'] = $dsee['date'][2].'-'.$dsee['date'][1].'-'.$dsee['date'][0];
	$dsee['t1'] = strtotime($dsee['date'].' 00:00:00');
	$dsee['t2'] = strtotime($dsee['date'].' 23:59:59');
	$dsee['date'] = date('d.m.Y',$dsee['t1']);	  
	?>
  <div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">
  <h4>Показать лог действий модераторов</h4>
  
  Показать действия за <input name="smod1" type="text" id="smod1" value="<?=$_POST['smod1']?>" size="11" maxlength="10" />
  Логин модератора <input name="smod2" type="text" id="smod2" value="<?=$_POST['smod2']?>" size="30" maxlength="30" />
  <input type="submit" name="delosee3" id="delosee3" value="Поиск" />
  </div>
  <?
	  if(isset($_POST['delosee3'])) {
		  mysql_select_db('like_delo',$dbgo);
		  $sp = mysql_query('SELECT * FROM `delo` WHERE `login` = "'.mysql_real_escape_string($_POST['smod2']).'" AND `time` >= '.$dsee['t1'].' AND `time` <= '.$dsee['t2'].'');
		  $rdl = '';
		  mysql_select_db('like',$dbgo);
		  while($pl = mysql_fetch_array($sp)) {
			 $rdl .= '<div style="padding:0 10px 5px 10px; margin:5px; border-bottom:1px solid #cac9c7;">'; 
			 $rdl .= '<div style="display:inline-block;width:150px;color:green">'.date('d.m.Y H:i:s',$pl['time']).'</div>';
			 $rdl .= $pl['text'].' персонажу '.$u->microLogin($pl['uid'],1);
			 $rdl .= '</div>';
		  }
		 
		  if($rdl == '') {
			 $rdl = 'Модератор не совершал действий за данное число'; 
		  }
		  echo $rdl;
	  }
  } ?>
  
</form>
<?
	}
	//показываем панель модератора
	}else{
		echo $merror.'<form action="main.php?'.$zv.'&enter='.$code.'" method="post"><center><br><br><br>Для входа в панель требуется пароль<hr>Введите пароль: <input value="" name="psw" type="password"><input type="submit" value="ок" /><br><small style="color:grey;">Если Вы не угадаете пароль больше трех раз<br>доступ в панель будет заблокирован на сутки.</small></form>';
	}
}

?>