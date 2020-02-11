<?

session_start();
if(!defined('GAME')) {
	die();
}

/*if(isset($_COOKIE['newinv']) && isset($_GET['inv']) && $u->info['inUser'] == 0 && $u->info['twink'] == 0) {
	echo '<script>top._bk.mod.open(\'inventory\');</script>';
	die('. . .');
}*/

$cached = false; //Кэширование инвентаря

if(isset($_GET['takeitmbox'])) {
	$sp = mysql_query('SELECT * FROM `items_users_res` WHERE `item_id` = "'.mysql_real_escape_string($_GET['takeitmbox']).'" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0');
	while( $itm = mysql_fetch_array($sp) ) {					
		mysql_query('INSERT INTO `items_users` (`id`,`item_id`,`1price`,`2price`,`3price`,`4price`,`5price`,`uid`,`use_text`,`data`,`inOdet`,`inShop`,`inGroup`,`delete`,`iznosNOW`,`iznosMAX`,`gift`,`gtxt1`,`gtxt2`,`kolvo`,`geniration`,`magic_inc`,`maidin`,`lastUPD`,`timeOver`,`overType`,`secret_id`,`time_create`,`time_sleep`,`dn_delete`,`inTransfer`,`post_delivery`,`lbtl_`,`bexp`,`so`,`blvl`,`pok_itm`,`btl_zd`,`comsid`,`kamen`) VALUES ("'.$itm['id'].'","'.$itm['item_id'].'","'.$itm['1price'].'","'.$itm['2price'].'","'.$itm['3price'].'","'.$itm['4price'].'","'.$itm['5price'].'","'.$itm['uid'].'","'.$itm['use_text'].'","'.$itm['data'].'","'.$itm['inOdet'].'","'.$itm['inShop'].'","'.$itm['inGroup'].'","'.$itm['delete'].'","'.$itm['iznosNOW'].'","'.$itm['iznosMAX'].'","'.$itm['gift'].'","'.$itm['gtxt1'].'","'.$itm['gtxt2'].'","'.$itm['kolvo'].'","'.$itm['geniration'].'","'.$itm['magic_inc'].'","'.$itm['maidin'].'","'.$itm['lastUPD'].'","'.$itm['timeOver'].'","'.$itm['overType'].'","'.$itm['secret_id'].'","'.$itm['time_create'].'","'.$itm['time_sleep'].'","'.$itm['dn_delete'].'","'.$itm['inTransfer'].'","'.$itm['post_delivery'].'","'.$itm['lbtl_'].'","'.$itm['bexp'].'","'.$itm['so'].'","'.$itm['blvl'].'","'.$itm['pok_itm'].'","'.$itm['btl_zd'].'","'.$itm['comsid'].'","'.$itm['kamen'].'")');
		mysql_query('DELETE FROM `items_users_res` WHERE `id` = "'.$itm['id'].'" LIMIT 1');
		mysql_query('UPDATE `items_users` SET `lastUPD` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
	}
}

if(!isset($_GET['otdel'])) {
	$_GET['otdel'] = $_SESSION['otdel'];
}else{
	$_SESSION['otdel'] = $_GET['otdel']; // для отладки.
}

if($u->info['admin'] > 0) {
	if(isset($_GET['clearinv23'])) {
		mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `inRazdel` = 2 OR `inRazdel` = 3) ');
	}
}

if( !isset( $_GET['otdel'] ) || ( $_GET['otdel']<1 && $_GET['otdel']>6 ) ) {
	$_GET['otdel'] = 1; // Если раздел не указан.
	$_GET['paged'] = $_SESSION['paged'] = 0;
}

if(isset($_GET['groupall'])) {
	mysql_query('UPDATE `items_users` SET `inGroup` = 0 WHERE `uid` = "'.$u->info['id'].'" AND `inShop` = 0 AND `inTransfer` = 0 AND `delete` = 0 AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `group_max` > 0 AND `inRazdel` = "'.mysql_real_escape_string((int)$_GET['otdel']).'")');
	mysql_query('UPDATE `items_users` SET `inGroup` = 1 WHERE `uid` = "'.$u->info['id'].'" AND `iznosNOW` = 0 AND `data` LIKE "%nosale%" AND `inOdet` = 0 AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `group_max` > 0 AND `inRazdel` = "'.mysql_real_escape_string((int)$_GET['otdel']).'")');
	mysql_query('UPDATE `items_users` SET `inGroup` = 2 WHERE `uid` = "'.$u->info['id'].'" AND `iznosNOW` = 0 AND `data` LIKE "%sudba%" AND `inOdet` = 0 AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `group_max` > 0 AND `inRazdel` = "'.mysql_real_escape_string((int)$_GET['otdel']).'")');
	mysql_query('UPDATE `items_users` SET `inGroup` = 3 WHERE `uid` = "'.$u->info['id'].'" AND `iznosNOW` = 0 AND `data` LIKE "%frompisher%" AND `inOdet` = 0 AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `group_max` > 0 AND `inRazdel` = "'.mysql_real_escape_string((int)$_GET['otdel']).'")');
	mysql_query('UPDATE `items_users` SET `inGroup` = 4 WHERE `uid` = "'.$u->info['id'].'" AND `iznosNOW` = 0 AND `inGroup` = 0 AND `inOdet` = 0 AND `delete` = 0 AND `inTransfer` = 0 AND `inShop` = 0 AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `group_max` > 0 AND `inRazdel` = "'.mysql_real_escape_string((int)$_GET['otdel']).'")');

}

if( isset($_GET['otdel']) ) {
	if( !isset($_GET['paged']) && (isset($_GET['use_pid']) || isset($_GET['sid']) || isset($_GET['oid']) || isset($_GET['usecopr']) || isset($_GET['delcop'])) ) {
		$_GET['paged'] = $_SESSION['paged']; // use item and load old paging
	} elseif(isset($_GET['paged']) && $_GET['paged']!='') {
		$_SESSION['paged'] = $_GET['paged']; // Задаем новую страницу.
	} elseif(isset($_SESSION['paged']) && $_SESSION['paged']!='' && $_SESSION['otdel']==$_GET['otdel']) {
		$_GET['paged'] = $_SESSION['paged']; // Если страница уже имеется в сессии, возвращаем её в текущую.
	} else {
		$_GET['paged'] = $_SESSION['paged'] = 0;
	}
}

$_SESSION['otdel'] = $_GET['otdel']; // для отладки.

if( isset($_GET['delcop']) ) {
	mysql_query('DELETE FROM `complects_priem` WHERE `id` = "'.mysql_real_escape_string($_GET['delcop']).'" AND `uid` = "'.$u->info['id'].'" LIMIT 1');
} elseif( isset($_GET['usecopr']) ) {
	$cpr = mysql_fetch_array(mysql_query('SELECT * FROM `complects_priem` WHERE `id` = "'.mysql_real_escape_string($_GET['usecopr']).'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
	if( isset($cpr['id']) ) {
		$u->info['priems'] = $cpr['priems'];
		mysql_query('UPDATE `stats` SET `priems` = "'.mysql_real_escape_string($cpr['priems']).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	}
}

//сохраняем комплект
if( isset($_POST['compname']) ) {
	$_POST['compname'] = htmlspecialchars($_POST['compname'],NULL,'cp1251');
	$_POST['compname'] = str_replace("'",'',$_POST['compname']);
	$_POST['compname'] = str_replace('"','',$_POST['compname']);
	$ptst = str_replace(' ','',$_POST['compname']);
	if( $ptst!='' ) {
		//Добавляем комплект
		$ptst = '';
		$sp = mysql_query('SELECT `inOdet`,`id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inOdet` > 0 AND `inShop` = "0" ORDER BY `inOdet` ASC LIMIT 250');
		while ( $pl = mysql_fetch_array($sp) ) {
			$ptst .= $pl['inOdet'].'='.$pl['id'].'|';
		}
		$tcm = mysql_fetch_array(mysql_query('SELECT * FROM `save_com` WHERE `uid` = "'.$u->info['id'].'" AND `name` = "'.mysql_real_escape_string($_POST['compname']).'" AND `delete` = "0" LIMIT 1'));
		if( !isset($tcm['id']) ) {
			//добавляем новый комплект
			$ins = mysql_query('INSERT INTO `save_com` (`uid`,`time`,`name`,`val`,`type`) VALUES ("'.$u->info['id'].'","'.time().'","'.mysql_real_escape_string($_POST['compname']).'","'.$ptst.'","0")');
			if($ins) {
				$u->error = 'Комплект &quot;'.$_POST['compname'].'&quot; был успешно сохранен';
			} else {
				$u->error = 'Не удалось сохранить комплект по техническим причинам';	
			}
		}else{
			//изменяем существующий
			$ins = mysql_query('UPDATE `save_com` SET `val` = "'.$ptst.'" WHERE `id` = "'.$tcm['id'].'" LIMIT 1');
			if($ins)
			{
				$u->error = 'Комплект &quot;'.$_POST['compname'].'&quot; был успешно изменен';
			}else{
				$u->error = 'Не удалось изменить комплект по техническим причинам';	
			}	
		}
		unset($ptst,$tcm,$inc);
	}
}elseif(isset($_GET['delc1'])) {
	$cmpl = mysql_query('UPDATE `save_com` SET `delete` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `id` = "'.mysql_real_escape_string($_GET['delc1']).'" LIMIT 1');
	if($cmpl)
	{
		$u->error = 'Комплект был успешно удален';		
	}
}
$filt='`iu`.`lastUPD` DESC';
if(isset($_GET['boxsort'])){
	switch($_GET['boxsort']){
		case'name':
			$filt='`im`.`name` ASC';
		break;
		case'cost':
			$filt='`im`.`price2` DESC, `im`.`price1` DESC';
		break;
		case'type':
			$filt='`im`.`inslot`';
		break;
	}
}
$_GET['filtergo'] = str_replace("'",'"',$_GET['filtergo']);
$filtgo = $_GET['filtergo'];
if( $filtgo != '' ) {
	$filtgo = ' AND `im`.`name` LIKE "%'.mysql_real_escape_string($filtgo).'%"';
}

//$pgs = mysql_fetch_array(mysql_query('SELECT COUNT(`iu`.`id`) FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON `im`.`id` = `iu`.`item_id` WHERE `iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `im`.`inRazdel`="'.mysql_real_escape_string($_GET['otdel']).'" '.$filtgo.' ORDER BY '.$filt.' LIMIT 1'));
//$pgs = $pgs[0];

$x = 0;
$gp = array();
$sp = (mysql_query('SELECT `iu`.`item_id`,`iu`.`inGroup` FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON `im`.`id` = `iu`.`item_id` WHERE `iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `im`.`inRazdel`="'.mysql_real_escape_string($_GET['otdel']).'" '.$filtgo.' ORDER BY '.$filt.''));
while( $pl = mysql_fetch_array($sp) ) {
	if(!isset($gp[$pl['item_id']][$pl['inGroup']]) || $pl['inGroup'] == 0) {
		$gp[$pl['item_id']][$pl['inGroup']]++;
		$x++;
	}
}
$pgs = $x;
unset($sp,$pl,$gp);

$pc = 15;
$pg = round((int)@$_GET['paged']);

if( $pg > ceil($pgs/$pc) ) {
	$pg = ceil($pgs/$pc)-1;
	if( $pg < 0 ) {
		$pg = 0;
	}
	$_GET['paged'] = $pg;
}

$pxc = $pg*$pc;
$nlim = '';

$page_look = '';
$inventorySortBox = '<div id="inventorySortBox">
	Сортировка: <br/>
		<input type="button" onclick="inventoryAjax(\'main.php?inv=1&mAjax=true&boxsort=name&otdel=' . intval($_GET['otdel']) . '\');" value="названию" />
		<input type="button" onclick="inventoryAjax(\'main.php?inv=1&mAjax=true&boxsort=cost&otdel=' . intval($_GET['otdel']) . '\');" value="цене" />
		<input type="button" onclick="inventoryAjax(\'main.php?inv=1&mAjax=true&boxsort=type&otdel=' . intval($_GET['otdel']) . '\');" value="типу" />
</div>';

if(isset($_SESSION['paged']))$page_look = '<!-- PAGED SEE '.round((int)@$_SESSION['paged']).'-->'; else $page_look = '<!-- PAGED '.$_SESSION['paged'].' -->';
	echo '<style>.pgdas { display:inline-block;background-color:#dadada; padding:2px 4px 1px 4px; font-size:12px;} .pgdas1 { display:inline-block;background-color:#a5a5a5; padding:2px 4px 1px 4px;  font-size:12px;}
	.pgdas { background: #dadada;background: -moz-linear-gradient(top,  #dadada 50%, #a5a5a5 99%);background: -webkit-gradient(linear, left top, left bottom, color-stop(50%,#dadada), color-stop(99%,#a5a5a5));background: -webkit-linear-gradient(top,  #dadada 50%,#a5a5a5 99%);background: -o-linear-gradient(top,  #dadada 50%,#a5a5a5 99%);background: -ms-linear-gradient(top,  #dadada 50%,#a5a5a5 99%);background: linear-gradient(to bottom,  #dadada 50%,#a5a5a5 99%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#dadada\', endColorstr=\'#a5a5a5\',GradientType=0 );
}
	.pgdas1 { background: #a5a5a5;  }
	</style>';
if($pgs > $pc) {
	$nlim = ' LIMIT '.$pxc.' , '.$pc.'';
	#$page_look .= '<table border=0 cellpadding=0 cellspacing=0 width=100% bgcolor="#A5A5A5"><tr><td width=99% align=center>';
	$page_look .= '<div style="padding:0px;">';
	if( $_GET['otdel'] != 1 ) {
		$page_look .= '<a class="pgdas'.$sep.'" href="/main.php?inv=1&groupall=1&otdel='.intval($_GET['otdel']).'">Группировать все предметы</a> &nbsp; ';
	}
	$page_look .= 'Страницы: ';
	$i = 1;
	while($i <= ceil($pgs/$pc)) {
		if($i-1 == $pg) {
			$sep = '';
		}else{
			$sep = '1';
		}
		$page_look .= '<a class="pgdas'.$sep.'" href="javascript:void(0);" onclick="inventoryAjax(\'main.php?paged='.($i-1).'&inv&mAjax=true&otdel='.round($_GET['otdel']).'\');">'.$i.'</a> ';
			$i++;
	}
	$page_look .= '</div>';
#	$page_look .= '<td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>';
}else{
	if( $_GET['otdel'] != 1 ) {
		$page_look .= '<a class="pgdas'.$sep.'" href="/main.php?inv=1&groupall=1&otdel='.intval($_GET['otdel']).'">Группировать все предметы</a> &nbsp; ';
	}
}

if( round((int)$_GET['otdel']) == 4 ) {
	$page_look .= '<div style="color:red;background-color:#FCC" align="center"><b>Ресурсы автоматически переносятся на склад каждые 30 минут.</b></div>';
}

$filt='`lastUPD` DESC';
if(isset($_GET['boxsort'])){
	switch($_GET['boxsort']){
		case'name':
			$filt='`name` ASC';
		break;
		case'cost':
			$filt='`price2` DESC, `price1` DESC';
		break;
		case'type':
			$filt='`inslot`';
		break;
	}
}


$itmAll = $itmAllSee = '';

if( isset($_GET['boxsort']) && $_GET['otdel']==5 ) {
	if($_POST['subfilter']) {
		$itmAll = $u->genInv(1,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `name` LIKE "%'.addcslashes(mysql_real_escape_string($_POST['filter']), '%_').'%" '.$filtgo.' ORDER BY `name` ASC');
	}
} else {
	if( $cached == true ) {
		$keyinv = mysql_fetch_array(mysql_query('SELECT SUM(`time_create`) , SUM(`id`) , SUM(`iznosNOW`) , SUM(`iznosMAX`) , COUNT(`id`) , SUM(`delete`) , SUM(`inOdet`)  , SUM(`lastUPD`) , SUM(`inGroup`) , SUM(`inShop`) , SUM(`inShop`) FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1'));
		$keyinv = md5($keyinv[0].$keyinv[1].$keyinv[2].$keyinv[3].$keyinv[4].$keyinv[5].$keyinv[6].$keyinv[7].$keyinv[8].$keyinv[9].$keyinv[10].$keyinv[11]);
		$keyinv2 = mysql_fetch_array(mysql_query('SELECT SUM(`time_create`) , SUM(`id`) , SUM(`iznosNOW`) , SUM(`iznosMAX`) , COUNT(`id`) , SUM(`delete`) , SUM(`inOdet`)  , SUM(`lastUPD`) , SUM(`inGroup`) , SUM(`inShop`) , SUM(`inShop`) FROM `items_users_res` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1'));
		$keyinv2 = md5($keyinv2[0].$keyinv2[1].$keyinv2[2].$keyinv2[3].$keyinv2[4].$keyinv2[5].$keyinv2[6].$keyinv2[7].$keyinv2[8].$keyinv2[9].$keyinv2[10].$keyinv2[11]);
		$keyinv .= $keyinv2;
		$keys = mysql_fetch_array(mysql_query('SELECT * FROM `cache_inv` WHERE `uid` = "'.$u->info['id'].'" AND `key` = "'.$keyinv.'" LIMIT 1'));
		if(!isset($keys['id'])) {
			$i = 0;
			while( $i <= 6 ) {
				if( file_exists('cache_inv/inv_'.$i.'_'.$u->info['id'].'_.html') == true ) {
					$u->delinv($i);
				}
				$i++;
			}
		}
		if( file_exists('cache_inv/inv_'.round((int)$_GET['otdel']).'_'.$u->info['id'].'_.html') == true ) {
			$cache = file_get_contents('cache_inv/inv_'.round((int)$_GET['otdel']).'_'.$u->info['id'].'_.html');	
			if( $u->info['admin'] > 0 ) {
				echo '<div><font color="#FF9900">cache_inv+inv_'.round((int)$_GET['otdel']).'_'.$u->info['id'].'_.'.$keyinv.'</font></div>';
			}
			$itmAll = unserialize($cache);
		}else{
			if( $u->info['admin'] > 0 ) {
				echo '<div><font color="green">cache_inv+inv_'.round((int)$_GET['otdel']).'_'.$u->info['id'].'_.'.$keyinv.'</font></div>';
			}
			$itmAll = $u->genInv(1,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `im`.`inRazdel`="'.mysql_real_escape_string($_GET['otdel']).'" ORDER BY '.$filt.''.$nlim);
			if( $u->info['noreal'] != 1 ) {
				//if( $u->info['id'] == 12345 ) {			
					$data = serialize($itmAll);
					$fp = fopen('cache_inv/inv_'.round((int)$_GET['otdel']).'_'.$u->info['id'].'_.html', "w");
					fwrite($fp, $data);
					fclose($fp);
					mysql_query('INSERT INTO `cache_inv` (`uid`,`key`) VALUES ("'.$u->info['id'].'","'.$keyinv.'")');
				//}
			}
		}
	}else{
		if( round((int)$_GET['otdel']) == 7 ) {
			$itmAll = array(0,false,'');
			
			$clr = array( 1=>'c8c8c8', 0=>'d4d4d4' ); $z = 0;
			$sort = '';
			if(isset($_GET['filtergo']) && $_GET['filtergo'] != '') {
				$_GET['filtergo'] = str_replace('"','',$_GET['filtergo']);
				$sort = '`name` LIKE "%'.mysql_real_escape_string($_GET['filtergo']).'%"';
			}
			if( $sort != '' ) {
				$sort = 'WHERE '.$sort;
			}
			$sp = mysql_query('SELECT * FROM `items_main` '.$sort.' ORDER BY `name` ASC');
			while( $pl = mysql_fetch_array($sp) ) {
				$x = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `items_users_res` WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = "'.$pl['id'].'" AND `delete` = 0 LIMIT 1'));
				$x = $x[0];
				if( $x > 0 ) {
					if( $z == 0 ) {
						$z = 1;
					}else{
						$z = 0;
					}
					$clrs = $clr[$z];
					$itmAll[0]++;
					//Левая часть
					$is1 = '<img src="http://img.likebk.com/i/items/'.$pl['img'].'">';
					$is1 .= '<br><br><a href="/main.php?inv&otdel=7&takeitmbox='.$pl['id'].'"><small>Забрать ресурс</small></a><br><br>';
					
					//Правая часть					
					if( $x > 1 ) {
						$pl['name'] .= ' (x'.$x.')';
					}
					$is2 = '<a href="/item/'.$pl['id'].'" target="_blank">'.$pl['name'].'</a>';
					$is2 .= ' &nbsp; (Масса: '.($pl['massa']*$x).')';
					if($pl['info'] != '' ){
						$is2 .= '<br><b>Описание:</b><br><small>'.$pl['info'].'</small>';
					}
					$is2 .= '<br><small style="color:brown">Ресурс будет доступен в течении 30 минут после перемещения в инвентарь, затем он переместится обратно на склад.</small>';
					
					$itmAll[2] .= '<tr bgcolor="'.$clrs.'"><td width="160" valign="middle" align="center" style="padding:5px;">'.$is1.'</td><td align="left" style="padding-left:3px; padding-bottom:3px; padding-top:7px;" valign="top">'.$is2.'</td></tr>';
				}
			}
			
		}else{
			$itmAll = $u->genInv(1,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `im`.`inRazdel`="'.mysql_real_escape_string($_GET['otdel']).'" '.$filtgo.' ORDER BY '.$filt.''.$nlim);
		}
	}
}

$itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">ПУСТО</td></tr>';
if($itmAll[0] > 0)
	$itmAllSee = $itmAll[2];
	
$showItems = '<table width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table class="tbl_inv" style="" width="100%" cellspacing="0" cellpadding="4" bgcolor="#d4d2d2">
      <tr>
        <td width="20%"  ' . (($_GET['otdel'] != 1) ? 'style=""' : 'style=""') .'  align=center bgcolor="' . (($_GET['otdel'] == 1) ? '#a5a5a5' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?inv=1&mAjax=true&otdel=1&rn=1.1\');">Обмундирование</a></td>
        <td width="20%"  ' . (($_GET['otdel'] != 2) ? 'style=""' : 'style=""') .'  align=center bgcolor="' . (($_GET['otdel'] == 2) ? '#a5a5a5' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?inv=1&mAjax=true&otdel=2&rn=2.1\');">Заклятия</a></td>
        <td width="20%" ' . (($_GET['otdel'] != 3) ? 'style=""' : 'style=""') .' align=center bgcolor="' . (($_GET['otdel'] == 3) ? '#a5a5a5' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?inv=1&mAjax=true&otdel=3&rn=3.1\');">Эликсиры</a></td>
        <td width="20%"  ' . (($_GET['otdel'] != 6) ? 'style=""' : 'style=""') .'  align=center bgcolor="' . (($_GET['otdel'] == 6) ? '#a5a5a5' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?inv=1&mAjax=true&otdel=6&rn=6.1\');">Руны</a></td>
        <td width="20%"  ' . (($_GET['otdel'] != 4) ? 'style=""' : 'style="" ') .'  align=center bgcolor="' . (($_GET['otdel'] == 4) ? '#a5a5a5' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?inv=1&mAjax=true&otdel=4&rn=4.1\');">Прочее</a></td>
		';
		
		//if( $u->info['admin'] > 0 ) {
			$showItems .= '<td width="20%"  ' . (($_GET['otdel'] != 7) ? 'style=""' : 'style="" ') .'  align=center bgcolor="' . (($_GET['otdel'] == 7) ? '#a5a5a5' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?inv=1&mAjax=true&otdel=7&rn=7.1\');">Склад</a></td>';
		//}
		
	  $showItems .= '</tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" ><table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding-top:0px; border-left: 1px solid #A5A5A5; border-right: 1px solid #A5A5A5;" bgcolor="#a5a5a5">
      <tr>
        <td align="left" valign="middle" style="color:#2b2c2c; height: 18px;font-size:12px; padding:4px;"><b>Масса: ' . (0+$u->aves['now']) . ' / ' . $u->aves['max'] . ' <!--, предметов: ' . $u->aves['items'] . '--></b></td>
		<td align="left" valign="middle" style="color:#2b2c2c; font-size:12px">&nbsp;</td>
		<td align="right" valign="middle" style="color:#2b2c2c; font-size:12px; position:relative;">
		<form id="line_filter" style="display:inline;" onsubmit="return false;" prc_adsf="true">
			Поиск по имени: <div style="display:inline-block; position:relative; ">
			<input type="text" id="inpFilterName"  placeholder="Введите название предмета..."  value=\''.($_GET['filtergo']).'\' autofocus="autofocus" 	size="44" autocomplete="off">
			<span style="position:relative">
				<img style="position:absolute; cursor:pointer; right: 5px; top: 3px; width: 12px; height: 12px;" onclick="document.getElementById(\'inpFilterName\').value=\'\';invf=\'\';" title="Убрать фильтр"  src="http://img.likebk.com/i/clear.gif">
			</span>
			<input onclick="filtergogogo(); return false;" type="button" value="Фильтр">
			<div class="autocomplete-suggestions" style="position: absolute; display: none;top: 15px; left:0px; margin:0px auto; right: 0px; font-size:12px; font-family: Tahoma; max-height: 300px; z-index: 9999;"></div>
			</div>
		</form>
		
			<input type="button" onclick="inventorySort(this);" style="margin:0px 2px;" value="Сортировка" />
			'.$inventorySortBox.'
		</td>
      </tr>
    </table></td>
  </tr>
  <tr><td bgcolor="#a5a5a5" align="left" valign="middle" style="color:#2b2c2c; font-size:12px">' . $page_look . '</td></tr>
  <tr>
    <td valign="top" align="center">
		<div style="height:350px; border-bottom: 1px solid #A5A5A5;border-top: 1px solid #A5A5A5;" id="itmAllSee"><table width="100%" border="0" cellspacing="1" align="center" cellpadding="0" bgcolor="#A5A5A5">' . (( $u->info['invBlock'] == 0 ) ? $itmAllSee : '<div align="center" style="padding:10px;background-color:#A5A5A5;"><form method="post" action="main.php?inv=1&otdel='.$_GET['otdel'].'&relockinvent"><b>Рюкзак закрыт.</b><br><img title="Замок для рюкзака" src="http://img.likebk.com/i/items/box_lock.gif"> Введите пароль: <input id="relockInv" name="relockInv" type="password"><input type="submit" value="Открыть"></form></div>' ) . '</table></div></td>
  </tr>
</table>
<script language="JavaScript">
	if($.cookie(\'invFilterByName\')) $("#ShowInventory").hide();
	$(document).ready(function (){ $("#ShowInventory").show(); });
</script>
';
if(isset($_GET['mAjax'])){
?>
<script>
var invr = <?=(0+intval($_GET['otdel']))?>;
var invp = <?=(0+intval($_GET['paged']))?>;
<?
if(isset($_GET['filtergo'])) {
?>
var invf = '<?=$_GET['filtergo']?>';
<?
}else{
	echo 'var invf = \'\';';
}
?>
</script>
<?
	exit($showItems);
}else{
	echo '<script>var invf = \'\';</script>';
}
?>
<script type="text/javascript" src="js/jquery.1.11.js"></script>
<script type="text/javascript" src="js/jquery.cookie.1.4.1.js"></script>
<script type="text/javascript" src="js/jquery.autocomplete.js"></script>
<script> 

$.cookie('invFilterByName','');
var UpdateItemList;
	function inventorySort(e){
		if ( $('#inventorySortBox').css('display') =='none') {
			$('#inventorySortBox').show();
			$(e).addClass('focus');
		} else {
			$('#inventorySortBox').hide();
			$(e).removeClass('focus');
		} 
	}
	function inventoryHeight() {
		var height = $('#itmAll').height();
		var heW = $(window).height();
		heW = heW-148; // 1060
		height = height-120; // 462
		var heMax = $("#itmAllSee").children('table').height();
		if (heMax > height) {
			if (heW > height) {
				$("#itmAllSee").height(heW);	
			} else {
				$("#itmAllSee").height(height);
			}
		} else {
			$("#itmAllSee").height(heMax);
		}
	}
	$(window).ready(function(){
		inventoryHeight();
	});
	$(window).resize(function(){
		inventoryHeight();
	});
	
	function seetext(id) {
		var id = document.getElementById('close_text_itm'+id);
		if(id.style.display == 'none') {
			id.style.display = '';
		}else{
			id.style.display = 'none';
		}
	}
	/*
	function UpdateItemList(){
		var inv_names = [];
		var items = $('a.inv_name');
		$(items).each(function(){ if($.inArray($(this).text(), inv_names)<0) inv_names.push($(this).text()); });
		$('#inpFilterName').autocomplete({ lookup:inv_names, onSelect: invFilterByName });
	}
	function invFilterByName(){
		$.cookie('invFilterByName', ''); 
		var val = $('#inpFilterName').val();
		if (val == '') {
			$("a.inv_name").parent().parent().stop().show();
		} else {
			$.cookie('invFilterByName', val);
			$("a.inv_name:not(:contains('" + val + "'))").parents('.item').stop().css('background-color', '').hide();
			$("a.inv_name:contains('" + val + "')").parents('.item').stop().show(); 
		}
	}*/
	
	function inventoryAjax(url){
		if( invf != undefined ) {
			if( invf != '' ) {
				url = url + '&filtergo='+invf;
			}
		}
		$('#ShowInventory').html('<div align="center" style="padding:10px;background-color:#d4d2d2;color:grey;"><b>Загрузка...</b></div>');
		$.ajax({
			url: url,
			cache: false,
			dataType: 'html',
			success: function (html) {
				$('#ShowInventory').html(html);
				
				inventoryHeight();
				
				//UpdateItemList();
			}
		});
	}
	
/*	
jQuery.expr[":"].contains = function (elem, i, match, array){
	return (elem.textContent || elem.innerText || jQuery.text(elem) || "").toLowerCase().indexOf(match[3].toLowerCase()) >= 0;
}
*/


			function str_replace ( search, replace, subject ) {	// Replace all occurrences of the search string with the replacement string
				// 
				// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
				// +   improved by: Gabriel Paderni
			
				if(!(replace instanceof Array)){
					replace=new Array(replace);
					if(search instanceof Array){//If search	is an array and replace	is a string, then this replacement string is used for every value of search
						while(search.length>replace.length){
							replace[replace.length]=replace[0];
						}
					}
				}
			
				if(!(search instanceof Array))search=new Array(search);
				while(search.length>replace.length){//If replace	has fewer values than search , then an empty string is used for the rest of replacement values
					replace[replace.length]='';
				}
			
				if(subject instanceof Array){//If subject is an array, then the search and replace is performed with every entry of subject , and the return value is an array as well.
					for(k in subject){
						subject[k]=str_replace(search,replace,subject[k]);
					}
					return subject;
				}
			
				for(var k=0; k<search.length; k++){
					var i = subject.indexOf(search[k]);
					while(i>-1){
						subject = subject.replace(search[k], replace[k]);
						i = subject.indexOf(search[k],i);
					}
				}
			
				return subject;
			
			}
			var invr = <?=(0+intval($_GET['otdel']))?>;
            var invp = <?=(0+intval($_GET['paged']))?>;
            function filtergogogo() {
                var flt = $('#inpFilterName').val();
                flt = str_replace('&','',flt);
                flt = str_replace('=','',flt);
                flt = str_replace('\\','',flt);
				invf = flt;
                inventoryAjax('main.php?inv=1&mAjax=true&boxsort=name&otdel='+invr+'&paged='+invp);
            }
			

function test() { alert(1); }
 
</script> 
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td id="firstitmAll" valign="top" align="left">
	        <div style="" align="center"><? $usee = $u->getInfoPers($u->info['id'],0,0,1); if($usee!=false){ echo $usee[0]; }else{ echo 'information is lost.'; } 
			//if($u->info['level']>1 && $u->info['inTurnir'] == 0) { 
				include('_incl_data/class/_cron_.php');
				$priem->seeMy(1);
			//}
			//if( $u->info['inTurnir'] > 0 ) {
			//	echo '<center><a href="/main.php?inv&remitem&otdel='.round((int)$_GET['otdel']).'">Снять все</a></center>';
			//}
			echo '<br>'.$u->info_remont();
			if( $u->info['inTurnir'] == 0 ) {
				/*$bns = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `aaa_bonus` WHERE `uid` = "'.$u->info['id'].'" AND `time` > '.time().' LIMIT 1'));
				if(isset($bns['id'])) {
					$bns2 = 'через '.$u->timeOut($bns['time']-time());
					$bns1 = '0';
					$bns3 = '';
				}else{
					$bns2 = '';
					$bns1 = '';
					$bns3 = ' onclick="location.href=\'main.php?inv=1&takebns='.$u->info['nextAct'].'\'"';
				}
				if(isset($_GET['takebns']) && $u->newAct($_GET['takebns'])==true && !isset($bns['id'])) {
					$u->takeBonus();
					$bns2 = '<div style="width:112px" align="center">через '.$u->timeOut( 2 * 3600 ).'</div>';
					$bns1 = '0';
					$bns3 = '';
				}
				?>
				<div align="center">
				<div class="on2gb"<?=$bns3?>>
				<div class="on1gb<?=$bns1?>">
					<small class="on1gbt<?=$bns1?>"><?=$bns2?></small>
				</div>
				</div>
				</div>
				<?*/
			}
			?>
		    </div> 
				<div align="center"><?php echo $c['counters']; ?></div> 
<?php
	$vix = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time`>='.strtotime('now 00:00:00').' AND `vars` = "hpKolodec_'.$u->info['id'].'" ',3);
	$vix = round($vix[0]);
	$vix2 = $u->testAction('`uid` = "'.$u->info['id'].'" AND `time`>='.strtotime('now 00:00:00').' AND `vars` = "mpKolodec_'.$u->info['id'].'" ',3);
	$vix2 = round($vix2[0]);
	if($u->info['vip'] == 1){
		$max_hp = 20000;
	}elseif($u->info['vip'] == 2){
		$max_hp = 50000;
	}else{
		$max_hp = 10000;
	}
?>
<?php 
if(isset($_GET['kolod_hp'])){
	if($u->stats['hpNow'] != $u->stats['hpAll']){
		$kolodec_hp = mysql_fetch_array(mysql_query('SELECT * FROM `a_kolodec` WHERE `uid` = "'.$u->info['id'].'" AND `type` = "0"'));
		if($vix < $max_hp){
			if(!isset($kolodec_hp['id'])){
				$in_kol = mysql_query('INSERT INTO `a_kolodec` (`uid`,`time`,`type`) VALUES ("'.$u->info['id'].'","'.(time()+300).'","0")');
				if($in_kol){
					//$_SESSION['timestamp'] = time()+300;
					$hpV = $u->stats['hpAll'] - $u->stats['hpNow'];
					if(($hpV + $vix) > $max_hp){
						$hpV = $max_hp - $vix;
					}
					mysql_query('UPDATE `stats` SET `hpNow` =`hpNow` + "'.$hpV.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					$u->addActionKol($u->info['id'], time(),'hpKolodec_'.$u->info['id'], $hpV);
					echo '<script>location.href="main.php?inv=1&hpAllkol"</script>';
				}
			}else{
				$in_kol = mysql_query('UPDATE `a_kolodec` SET `time`="'.(time()+300).'" WHERE `uid`="'.$u->info['id'].'" AND `type` = "0"');
				if($in_kol){
					//$_SESSION['timestamp'] = time()+300;
					$hpV = $u->stats['hpAll'] - $u->stats['hpNow'];
					if(($hpV + $vix) > $max_hp){
						$hpV = $max_hp - $vix;
					}
					mysql_query('UPDATE `stats` SET `hpNow` =`hpNow` + "'.$hpV.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					$u->addActionKol($u->info['id'], time(),'hpKolodec_'.$u->info['id'], $hpV);
					 echo '<script>location.href="main.php?inv=1&hpAllkol"</script>';
				}
			}
		}else{
			$u->error = '';
		}
	}else{
		$u->error = 'Ваше здоровье и так полностью восстановлено';
	}
}
if(isset($_GET['kolod_mp'])){
	if($u->stats['mpNow'] != $u->stats['mpAll']){
		$kolodec_mp = mysql_fetch_array(mysql_query('SELECT * FROM `a_kolodec` WHERE `uid` = "'.$u->info['id'].'" AND `type` = "1"'));
		if($vix2 < $max_hp){
			if(!isset($kolodec_mp['id'])){
				$in_kol = mysql_query('INSERT INTO `a_kolodec` (`uid`,`time`, `type`) VALUES ("'.$u->info['id'].'","'.(time()+300).'","1")');
				if($in_kol){
					//$_SESSION['timestamp'] = time()+300;
					$mpV = $u->stats['mpAll'] - $u->stats['mpNow'];
					if(($mpV + $vix2) > $max_hp){
						$mpV = $max_hp - $vix2;
					}
					mysql_query('UPDATE `stats` SET `mpNow` = `mpNow` + "'.$mpV.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					$u->addActionKol($u->info['id'], time(),'mpKolodec_'.$u->info['id'], $mpV);
					echo '<script>location.href="main.php?inv=1&mpAllkol"</script>';
				}
			}else{
				$in_kol = mysql_query('UPDATE `a_kolodec` SET `time`="'.(time()+300).'" WHERE `uid`="'.$u->info['id'].'" AND `type` = "1"');
				if($in_kol){
					//$_SESSION['timestamp'] = time()+300;
					$mpV = $u->stats['mpAll'] - $u->stats['mpNow'];
					if(($mpV + $vix2) > $max_hp){
						$mpV = $max_hp - $vix2;
					}
					mysql_query('UPDATE `stats` SET `mpNow` =`mpNow` + "'.$mpV.'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
					$u->addActionKol($u->info['id'], time(),'mpKolodec_'.$u->info['id'], $mpV);
					 echo '<script>location.href="main.php?inv=1&mpAllkol"</script>';
				}
			}
		}else{
			$u->error = '';
		}
	}else{
		$u->error = 'Ваше мана и так полностью восстановлено';
	}
}
if(isset($_GET['hpAllkol'])){
	$u->error = 'Вы успешно восстановили HP';
}
if(isset($_GET['mpAllkol'])){
	$u->error = 'Вы успешно восстановили MP';
}

		function timeOut($ttm)
		{
			$out = '';
			$time_still = $ttm;
			$tmp = floor($time_still/60);
			$tmp2 = floor($time_still%60);
			if ($tmp > 0) 
			{ 
				$id++;
				if ($id<3) {$out .= $tmp." мин. ";}
			}
			if($tmp2 > 0)
			{
				if($tmp2<0)
				{
					$tmp2 = 0;
				}
				$out .= $tmp2.' сек.';
			}
			return $out;
		}
		if(($u->info['align'] > 1 && $u->info['align'] < 2) || ($u->info['align'] > 3 && $u->info['align'] < 4) || $u->info['align'] == 7 || $u->info['align'] == 1 || $u->info['align'] == 3 || $u->info['admin'] == 1){
			$kolodec_hp = mysql_fetch_array(mysql_query('SELECT * FROM `a_kolodec` WHERE `uid` = "'.$u->info['id'].'" AND `type` = "0"'));?>
			<div align="center">
				<h3 style="padding-bottom: 5px; margin-bottom: 5px;"><img style="margin-right: 5px;" src="/images/healvortex.gif" /><span style="top: -5px;position: relative;">Колодец Жизни</span></h3>
				<div id="btn_kolodec">
				<?php 
					$timeout = timeout($kolodec_hp['time'] - time());
					if($vix < $max_hp ){
						if(!isset($kolodec_hp['id']) || $kolodec_hp['time'] < time()){
							echo '<a href="/main.php?inv=1&kolod_hp=1">Восстановить HP.</a>';
							echo '<br><small>Осталось '.round($max_hp-$vix).' HP</small>';
						}else{
							echo '<a style="cursor: pointer;">Восстановление возможно через <span id="timer">'.$timeout.'</span></a>';
						}
					}else{
						echo '<a style="filter: alpha(opacity=20); -moz-opacity: 0.20; -khtml-opacity: 0.20; opacity: 0.20;" href="">Восстановить HP.</a>';
						echo '<br><small>Осталось '.round($max_hp-$vix).' HP</small>';
					}
					?>
				</div>
			</div>
			<?php 
				$kolodec_mp = mysql_fetch_array(mysql_query('SELECT * FROM `a_kolodec` WHERE `uid` = "'.$u->info['id'].'" AND `type` = "1"'));?>
			<div align="center">
				<h3 style="padding-bottom: 5px; margin-bottom: 5px;"><img style="margin-right: 5px;" src="/images/manavortex.gif" /><span style="top: -5px;position: relative;">Колодец Маны</span></h3>
				<div id="btn_kolodec">
				<?php 
					$timeout = timeout($kolodec_mp['time'] - time());
					if($vix2 < $max_hp ){
						if(!isset($kolodec_mp['id']) || $kolodec_mp['time'] < time()){
							echo '<a href="/main.php?inv=1&kolod_mp=1">Восстановить MP.</a>';
							echo '<br><small>Осталось '.round($max_hp-$vix2).' MP</small>';
						}else{
							echo '<a style="cursor: pointer;">Восстановление возможно через <span id="timer">'.$timeout.'</span></a>';
						}
					}else{
						echo '<a style="filter: alpha(opacity=20); -moz-opacity: 0.20; -khtml-opacity: 0.20; opacity: 0.20;" href="">Восстановить MP.</a>';
						echo '<br><small>Осталось '.round($max_hp-$vix2).' MP</small>';
					}
					?>
				</div>
			</div>
		<?php }?>
		</td>
	    <td width="400" valign="top" align="center"><? if( true == true || $u->info['inTurnir'] == 0) { include('stats_inv.php'); } else { include('stats_inv2.php'); } ?></td>    
		<td valign="top"  id="itmAll">
			<div style="z-index: 2; position: relative; width:100%; display:table; box-sizing: border-box; margin: 0px; padding: 7px 5px 3px 5px;">
				<div style="display:table-cell;"><!-- Кнопки возврата и другие--></div>
				<div style="display:table-cell; text-align: right;">
                    <? if( $u->info['admin'] >= 0 ) { if(!isset($_COOKIE['newinv'])) { ?>
                    <input class="btn" type="button" onclick="top.frames['main'].location='main.php?newinv'"  value="Новый инвентарь" />
                    <? }else{ ?>
                    <input class="btn" type="button" onclick="top.frames['main'].location='main.php?oldinv'"  value="Старый инвентарь" />
                    <? } } ?>
                    <input class="btn" type="button" onclick="top.frames['main'].location='achiev.php'"  value="Достижения" />
					<?
					if($u->info['admin'] > 0) {
					?>
                    <input class="btnnew" type="button" onclick="top.frames['main'].location='main.php?inv&clearinv23'"  value="Очистить заклятия и эликсиры" />
                    <?
					}
					if($u->info['animal'] != 0) {
						echo '<input class="btnnew" type="button" onclick="top.frames[\'main\'].location=\'main.php?pet=1&rnd='.$code.'\'" value="Зверь" />';
					}
					?><input class="btnnew" type="button" onclick="top.frames['main'].location='main.php?skills&amp;side=1&amp;rn=<? echo $code; ?>'"  value="Умения" /><?
					if ($u->info['inTurnir'] == 0) { ?><input class="btnnew" type="button" onclick="top.frames['main'].location='main.php?obraz&rnd=<? echo $code; ?>'" value="Образ" /><? }
					$gl = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `reimage` WHERE ((`uid` = "'.$u->info['id'].'" AND `clan` = "0") OR (`clan` = "'.$u->info['clan'].'" AND `clan` > 0)) AND `good` > 0 AND `bad` = "0" LIMIT 1'));
					// if($gl[0] > 0) { ?>
					<!-- <input class="btnnew" type="button" onclick="top.frames['main'].location='main.php?galery&rnd=<? //echo $code; ?>'" value="Галерея" /> -->
					<? //} unset($gl); 
					// if ($u->info['inTurnir'] == 0) { ?><!--<input class="btnnew2" type="button" onclick="location.href='main.php?referals'" value="Наставничество" />--><? //}
					?><input class="btnnew" type="button" onclick="top.frames['main'].location='main.php'" value="Вернуться" />
					<!--
					<input class="btnnew" type="button" onclick="top.frames['main'].location='main.php?anketa&amp;rn=<? echo $code; ?>'" value="Анкета" />
					<input class="btnnew" type="button" onclick="top.frames['main'].location='main.php?act_trf=1&amp;rn=<? echo $code; ?>'" value="Отчет о переводах" />
					<input class="btnnew" type="button" style="font-weight:bold;" value="Безопасность" onclick="top.frames['main'].location='main.php?security&amp;rn=<? echo $code; ?>'" />
					<input class="btnnew" type="button" style="background-color:#A9AFC0" onClick="alert('Раздел отсутствует');" value="Подсказки" />
					-->
				</div>
			</div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" noresize="noresize">
				<? if( $u->error != '' )  { ?>
				<tr>
					<td>
						<div style="min-height:18px;padding:2px 4px;"><font color="#FF0000"><b><? echo $u->error; ?></b></font></div>
					</td>
				</tr>
				<? } ?> 
				<tr>
					<td id="ShowInventory"><?php echo $showItems; ?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>