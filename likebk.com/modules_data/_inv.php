<?

session_start();
if(!defined('GAME')) {
	die();
}


$cached = false; //����������� ���������

if(!isset($_GET['otdel'])) {
	$_GET['otdel'] = $_SESSION['otdel'];
}else{
	$_SESSION['otdel'] = $_GET['otdel']; // ��� �������.
}

if($u->info['admin'] > 0) {
	if(isset($_GET['clearinv23'])) {
		mysql_query('DELETE FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `item_id` IN (SELECT `id` FROM `items_main` WHERE `inRazdel` = 2 OR `inRazdel` = 3) ');
	}
}

if( !isset( $_GET['otdel'] ) || ( $_GET['otdel']<1 && $_GET['otdel']>6 ) ) {
	$_GET['otdel'] = 1; // ���� ������ �� ������.
	$_GET['paged'] = $_SESSION['paged'] = 0;
}

if( isset($_GET['otdel']) ) {
	if( !isset($_GET['paged']) && (isset($_GET['use_pid']) || isset($_GET['sid']) || isset($_GET['oid']) || isset($_GET['usecopr']) || isset($_GET['delcop'])) ) {
		$_GET['paged'] = $_SESSION['paged']; // use item and load old paging
	} elseif(isset($_GET['paged']) && $_GET['paged']!='') {
		$_SESSION['paged'] = $_GET['paged']; // ������ ����� ��������.
	} elseif(isset($_SESSION['paged']) && $_SESSION['paged']!='' && $_SESSION['otdel']==$_GET['otdel']) {
		$_GET['paged'] = $_SESSION['paged']; // ���� �������� ��� ������� � ������, ���������� � � �������.
	} else {
		$_GET['paged'] = $_SESSION['paged'] = 0;
	}
}

$_SESSION['otdel'] = $_GET['otdel']; // ��� �������.

if( isset($_GET['delcop']) ) {
	mysql_query('DELETE FROM `complects_priem` WHERE `id` = "'.mysql_real_escape_string($_GET['delcop']).'" AND `uid` = "'.$u->info['id'].'" LIMIT 1');
} elseif( isset($_GET['usecopr']) ) {
	$cpr = mysql_fetch_array(mysql_query('SELECT * FROM `complects_priem` WHERE `id` = "'.mysql_real_escape_string($_GET['usecopr']).'" AND `uid` = "'.$u->info['id'].'" LIMIT 1'));
	if( isset($cpr['id']) ) {
		$u->info['priems'] = $cpr['priems'];
		mysql_query('UPDATE `stats` SET `priems` = "'.mysql_real_escape_string($cpr['priems']).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	}
}

//��������� ��������
if( isset($_POST['compname']) ) {
	$_POST['compname'] = htmlspecialchars($_POST['compname'],NULL,'cp1251');
	$_POST['compname'] = str_replace("'",'',$_POST['compname']);
	$_POST['compname'] = str_replace('"','',$_POST['compname']);
	$ptst = str_replace(' ','',$_POST['compname']);
	if( $ptst!='' ) {
		//��������� ��������
		$ptst = '';
		$sp = mysql_query('SELECT `inOdet`,`id` FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `inOdet` > 0 AND `inShop` = "0" ORDER BY `inOdet` ASC LIMIT 250');
		while ( $pl = mysql_fetch_array($sp) ) {
			$ptst .= $pl['inOdet'].'='.$pl['id'].'|';
		}
		$tcm = mysql_fetch_array(mysql_query('SELECT * FROM `save_com` WHERE `uid` = "'.$u->info['id'].'" AND `name` = "'.mysql_real_escape_string($_POST['compname']).'" AND `delete` = "0" LIMIT 1'));
		if( !isset($tcm['id']) ) {
			//��������� ����� ��������
			$ins = mysql_query('INSERT INTO `save_com` (`uid`,`time`,`name`,`val`,`type`) VALUES ("'.$u->info['id'].'","'.time().'","'.mysql_real_escape_string($_POST['compname']).'","'.$ptst.'","0")');
			if($ins) {
				$u->error = '�������� &quot;'.$_POST['compname'].'&quot; ��� ������� ��������';
			} else {
				$u->error = '�� ������� ��������� �������� �� ����������� ��������';	
			}
		}else{
			//�������� ������������
			$ins = mysql_query('UPDATE `save_com` SET `val` = "'.$ptst.'" WHERE `id` = "'.$tcm['id'].'" LIMIT 1');
			if($ins)
			{
				$u->error = '�������� &quot;'.$_POST['compname'].'&quot; ��� ������� �������';
			}else{
				$u->error = '�� ������� �������� �������� �� ����������� ��������';	
			}	
		}
		unset($ptst,$tcm,$inc);
	}
}elseif(isset($_GET['delc1'])) {
	$cmpl = mysql_query('UPDATE `save_com` SET `delete` = "'.time().'" WHERE `uid` = "'.$u->info['id'].'" AND `delete` = "0" AND `id` = "'.mysql_real_escape_string($_GET['delc1']).'" LIMIT 1');
	if($cmpl)
	{
		$u->error = '�������� ��� ������� ������';		
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

$pc = 3000;
$pg = round((int)@$_GET['paged']);
$pxc = $pg*$pc;
$nlim = '';
$pgs = mysql_fetch_array(mysql_query('SELECT COUNT(`iu`.`id`) FROM `items_users` AS `iu` LEFT JOIN `items_main` AS `im` ON `im`.`id` = `iu`.`item_id` WHERE `iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `im`.`inRazdel`="'.mysql_real_escape_string($_GET['otdel']).'" ORDER BY '.$filt.' LIMIT 1'));
$pgs = $pgs[0];
$page_look = '';
$inventorySortBox = '<div id="inventorySortBox">
	����������: <br/>
		<input type="button" onclick="inventoryAjax(\'main.php?inv=1&mAjax=true&boxsort=name&otdel=' . intval($_GET['otdel']) . '\');" value="��������" />
		<input type="button" onclick="inventoryAjax(\'main.php?inv=1&mAjax=true&boxsort=cost&otdel=' . intval($_GET['otdel']) . '\');" value="����" />
		<input type="button" onclick="inventoryAjax(\'main.php?inv=1&mAjax=true&boxsort=type&otdel=' . intval($_GET['otdel']) . '\');" value="����" />
</div>';

if(isset($_SESSION['paged']))$page_look = '<!-- PAGED SEE '.round((int)@$_SESSION['paged']).'-->'; else $page_look = '<!-- PAGED '.$_SESSION['paged'].' -->';
if($pgs > $pc) {
	$nlim = ' LIMIT '.$pxc.' , '.$pc.'';
	#$page_look .= '<table border=0 cellpadding=0 cellspacing=0 width=100% bgcolor="#A5A5A5"><tr><td width=99% align=center>';
	$page_look .= '<div style="padding:0px;">';
	$page_look .= '��������: ';
	$i = 1;
	echo '<style>.pgdas { display:inline-block;background-color:#dadada; padding:2px 4px 1px 4px; font-size:12px;} .pgdas1 { display:inline-block;background-color:#a5a5a5; padding:2px 4px 1px 4px;  font-size:12px;}
	.pgdas { background: #dadada;background: -moz-linear-gradient(top,  #dadada 50%, #a5a5a5 99%);background: -webkit-gradient(linear, left top, left bottom, color-stop(50%,#dadada), color-stop(99%,#a5a5a5));background: -webkit-linear-gradient(top,  #dadada 50%,#a5a5a5 99%);background: -o-linear-gradient(top,  #dadada 50%,#a5a5a5 99%);background: -ms-linear-gradient(top,  #dadada 50%,#a5a5a5 99%);background: linear-gradient(to bottom,  #dadada 50%,#a5a5a5 99%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#dadada\', endColorstr=\'#a5a5a5\',GradientType=0 );
}
	.pgdas1 { background: #a5a5a5;  }
	</style>';
	while($i <= ceil($pgs/$pc)) {
		if($i-1 == $pg) {
			$sep = 1;
		}else{
			$sep = '';
		}
		$page_look .= '<a class="pgdas'.$sep.'" href="javascript:void(0);" onclick="inventoryAjax(\'main.php?paged='.($i-1).'&inv&mAjax=true&otdel='.round($_GET['otdel']).'\');">'.$i.'</a> ';
			$i++;
	}
	$page_look .= '</div>';
#	$page_look .= '<td nowrap>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>';
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
		$itmAll = $u->genInv(1,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `name` LIKE "%'.addcslashes(mysql_real_escape_string($_POST['filter']), '%_').'%" ORDER BY `name` ASC');
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
		$itmAll = $u->genInv(1,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" AND `im`.`inRazdel`="'.mysql_real_escape_string($_GET['otdel']).'" ORDER BY '.$filt.''.$nlim);
	}
}

$itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">�����</td></tr>';
if($itmAll[0] > 0)
	$itmAllSee = $itmAll[2];
	
$showItems = '<table width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table class="tbl_inv" style="" width="100%" cellspacing="0" cellpadding="4" bgcolor="#d4d2d2">
      <tr>
        <td width="20%"  ' . (($_GET['otdel'] != 1) ? 'style=""' : 'style=""') .'  align=center bgcolor="' . (($_GET['otdel'] == 1) ? '#a5a5a5' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?inv=1&mAjax=true&otdel=1&rn=1.1\');">��������������</a></td>
        <td width="20%"  ' . (($_GET['otdel'] != 2) ? 'style=""' : 'style=""') .'  align=center bgcolor="' . (($_GET['otdel'] == 2) ? '#a5a5a5' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?inv=1&mAjax=true&otdel=2&rn=2.1\');">��������</a></td>
        <td width="20%" ' . (($_GET['otdel'] != 3) ? 'style=""' : 'style=""') .' align=center bgcolor="' . (($_GET['otdel'] == 3) ? '#a5a5a5' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?inv=1&mAjax=true&otdel=3&rn=3.1\');">��������</a></td>
        <td width="20%"  ' . (($_GET['otdel'] != 6) ? 'style=""' : 'style=""') .'  align=center bgcolor="' . (($_GET['otdel'] == 6) ? '#a5a5a5' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?inv=1&mAjax=true&otdel=6&rn=6.1\');">����</a></td>
        <td width="20%"  ' . (($_GET['otdel'] != 4) ? 'style=""' : 'style="" ') .'  align=center bgcolor="' . (($_GET['otdel'] == 4) ? '#a5a5a5' : '' ) .'"><a href="javascript:void(0);" onclick="inventoryAjax(\'main.php?inv=1&mAjax=true&otdel=4&rn=4.1\');">������</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" ><table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding-top:0px; border-left: 1px solid #A5A5A5; border-right: 1px solid #A5A5A5;" bgcolor="#a5a5a5">
      <tr>
        <td align="left" valign="middle" style="color:#2b2c2c; height: 18px;font-size:12px; padding:4px;"><b>�����: ' . (0+$u->aves['now']) . ' / ' . $u->aves['max'] . ' <!--, ���������: ' . $u->aves['items'] . '--></b></td>
		<td align="center" valign="middle" style="color:#2b2c2c; font-size:12px">' . $page_look . '</td>
		<td align="right" valign="middle" style="color:#2b2c2c; font-size:12px; position:relative;">
		<form id="line_filter" style="display:inline;" onsubmit="return false;" prc_adsf="true">
			����� �� �����: <div style="display:inline-block; position:relative; ">
			<input type="text" id="inpFilterName"  placeholder="������� �������� ��������..."  autofocus="autofocus" 	size="44" autocomplete="off">
			<img style="position:absolute; cursor:pointer; right: 2px; top: 3px; width: 12px; height: 12px;" onclick="document.getElementById(\'inpFilterName\').value=\'\';" title="������ ������ (������� Esc)"  src="http://img.likebk.com/i/clear.gif">
			<input type="submit" style="display: none" id="inpFilterName_submit" value="������" onclick="return false">
			<div class="autocomplete-suggestions" style="position: absolute; display: none;top: 15px; left:0px; margin:0px auto; right: 0px; font-size:12px; font-family: Tahoma; max-height: 300px; z-index: 9999;"></div>
			</div>
		</form>
		
			<input type="button" onclick="inventorySort(this);" style="margin:0px 2px;" value="����������" />
			'.$inventorySortBox.'
		</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" align="center">
		<div style="height:350px; border-bottom: 1px solid #A5A5A5;border-top: 1px solid #A5A5A5;" id="itmAllSee"><table width="100%" border="0" cellspacing="1" align="center" cellpadding="0" bgcolor="#A5A5A5">' . (( $u->info['invBlock'] == 0 ) ? $itmAllSee : '<div align="center" style="padding:10px;background-color:#A5A5A5;"><form method="post" action="main.php?inv=1&otdel='.$_GET['otdel'].'&relockinvent"><b>������ ������.</b><br><img title="����� ��� �������" src="http://img.likebk.com/i/items/box_lock.gif"> ������� ������: <input id="relockInv" name="relockInv" type="password"><input type="submit" value="�������"></form></div>' ) . '</table></div></td>
  </tr>
</table>
<script language="JavaScript">
	if($.cookie(\'invFilterByName\')) $("#ShowInventory").hide();
	$(document).ready(function (){ $("#ShowInventory").show(); });
</script>
';
if(isset($_GET['mAjax'])){
	exit($showItems);
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
	
	function UpdateItemList(){
		var inv_names = [];
		var items = $('a.inv_name');
		$(items).each(function(){ if($.inArray($(this).text(), inv_names)<0) inv_names.push($(this).text()); });
		$('#inpFilterName').autocomplete({ lookup:inv_names, onSelect: invFilterByName });
	}
	function invFilterByName(){
		$.cookie('invFilterByName', ''); 
		var val = $('#inpFilterName').val();
		if (val == '') $("a.inv_name").parent().parent().stop().show();
		else {
			$.cookie('invFilterByName', val);
			$("a.inv_name:not(:contains('" + val + "'))").parents('.item').stop().css('background-color', '').hide();
			$("a.inv_name:contains('" + val + "')").parents('.item').stop().show(); 
		}
	}
	
	function inventoryAjax(url){
		$('#ShowInventory').html('<div align="center" style="padding:10px;background-color:#d4d2d2;color:grey;"><b>��������...</b></div>');
		$.ajax({
			url: url,
			cache: false,
			dataType: 'html',
			success: function (html) {
				$('#ShowInventory').html(html);
				
				inventoryHeight();
				
				UpdateItemList();
			}
		});
	}
	
$(document).ready(function () {
	
	function UpdateItemList(){
		var inv_names = [];
		var items = $('a.inv_name');
		$(items).each(function(){ if($.inArray($(this).text(), inv_names)<0) inv_names.push($(this).text()); });
		$('#inpFilterName').autocomplete({ lookup:inv_names, onSelect: invFilterByName });
	}
	
	function invFilterByName(){
		$.cookie('invFilterByName', ''); 
		var val = $('#inpFilterName').val();
		if (val == '') $("a.inv_name").parent().parent().stop().show();
		else {
			$.cookie('invFilterByName', val);
			$("a.inv_name:not(:contains('" + val + "'))").parents('.item').stop().css('background-color', '').hide();
			$("a.inv_name:contains('" + val + "')").parents('.item').stop().show(); 
		}
	}
	
	UpdateItemList(); // �������� ���������.
	invFilterByNameTimer=null;
	
	// ������������� ���������
	$('#line_filter').submit(function (){ $('#inpFilterName_submit').trigger('click'); });
	
	// ���� � ���������� ������ ��������� ������� ��� ������ ������ Up � Down, ������������� ������������� ���������.
	$('#inpFilterName').keyup(function (e){ $('#inpFilterName_submit').trigger('click'); });
	
	// ���������� ������� ����� �������� � ���������� ��� ��� �������� ���������\�������
	if ($.cookie('invFilterByName')) { $('#inpFilterName').val($.cookie('invFilterByName')); invFilterByName(); }
	
	// �������������� � �������� ������� ��� ��������� ������.
	$('#line_filter').click(function (){ window.clearInterval(invFilterByNameTimer); if($('#inpFilterName').val()=='')invFilterByName(); else invFilterByNameTimer=setTimeout(invFilterByName, 200); return false;} );
	
	/*
	
	var inv_names = [];
	$('a.inv_name').each(function(){ if($.inArray($(this).text(), inv_names)<0) inv_names.push($(this).text()); });
	$('#inpFilterName').autocomplete({lookup:inv_names,onSelect: invFilterByName});
	$('#inpFilterName').focus();
	$(document).keyup(function (e) {if (e.which == 13)invFilterByName(); if (e.which == 27) { $('#textSearch').click(); } });
	$('#line_filter').submit(function (){$('#inpFilterName_submit').trigger('click');});
	function invFilterByName(){
		$.cookie('invFilterByName', ''); 
		var val = $('#inpFilterName').val();
		if (val == '') $("a.inv_name").parent().parent().stop().show();
		else {
			$.cookie('invFilterByName', val);
			$("a.inv_name:not(:contains('" + val + "'))").parents('.item').stop().css('background-color', '').hide();
			$("a.inv_name:contains('" + val + "')").parents('.item').stop().show(); 
		}
	}
	invFilterByNameTimer=null;
	$('#line_filter').click(function (){window.clearInterval(invFilterByNameTimer);if($('#inpFilterName').val()=='')invFilterByName();else invFilterByNameTimer=setTimeout(invFilterByName, 200);return false;});
	$('#inpFilterName').keyup(function (e){ $('#inpFilterName_submit').trigger('click'); });
	if ($.cookie('invFilterByName')) {$('#inpFilterName').val($.cookie('invFilterByName'));invFilterByName();}
	if ($.cookie('invFilterByName')) {$('#inpFilterName').val($.cookie('invFilterByName'));invFilterByName();}
	*/
});

jQuery.expr[":"].contains = function (elem, i, match, array){
	return (elem.textContent || elem.innerText || jQuery.text(elem) || "").toLowerCase().indexOf(match[3].toLowerCase()) >= 0;
}
 
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
			//	echo '<center><a href="/main.php?inv&remitem&otdel='.round((int)$_GET['otdel']).'">����� ���</a></center>';
			//}
			echo '<br>'.$u->info_remont();
			if( $u->info['inTurnir'] == 0 ) {
				/*$bns = mysql_fetch_array(mysql_query('SELECT `id`,`time` FROM `aaa_bonus` WHERE `uid` = "'.$u->info['id'].'" AND `time` > '.time().' LIMIT 1'));
				if(isset($bns['id'])) {
					$bns2 = '����� '.$u->timeOut($bns['time']-time());
					$bns1 = '0';
					$bns3 = '';
				}else{
					$bns2 = '';
					$bns1 = '';
					$bns3 = ' onclick="location.href=\'main.php?inv=1&takebns='.$u->info['nextAct'].'\'"';
				}
				if(isset($_GET['takebns']) && $u->newAct($_GET['takebns'])==true && !isset($bns['id'])) {
					$u->takeBonus();
					$bns2 = '<div style="width:112px" align="center">����� '.$u->timeOut( 2 * 3600 ).'</div>';
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
		$u->error = '���� �������� � ��� ��������� �������������';
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
		$u->error = '���� ���� � ��� ��������� �������������';
	}
}
if(isset($_GET['hpAllkol'])){
	$u->error = '�� ������� ������������ HP';
}
if(isset($_GET['mpAllkol'])){
	$u->error = '�� ������� ������������ MP';
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
				if ($id<3) {$out .= $tmp." ���. ";}
			}
			if($tmp2 > 0)
			{
				if($tmp2<0)
				{
					$tmp2 = 0;
				}
				$out .= $tmp2.' ���.';
			}
			return $out;
		}
		if(($u->info['align'] > 1 && $u->info['align'] < 2) || ($u->info['align'] > 3 && $u->info['align'] < 4) || $u->info['align'] == 7 || $u->info['align'] == 1 || $u->info['align'] == 3 || $u->info['admin'] == 1){
			$kolodec_hp = mysql_fetch_array(mysql_query('SELECT * FROM `a_kolodec` WHERE `uid` = "'.$u->info['id'].'" AND `type` = "0"'));?>
			<div align="center">
				<h3 style="padding-bottom: 5px; margin-bottom: 5px;"><img style="margin-right: 5px;" src="/images/healvortex.gif" /><span style="top: -5px;position: relative;">������� �����</span></h3>
				<div id="btn_kolodec">
				<?php 
					$timeout = timeout($kolodec_hp['time'] - time());
					if($vix < $max_hp ){
						if(!isset($kolodec_hp['id']) || $kolodec_hp['time'] < time()){
							echo '<a href="/main.php?inv=1&kolod_hp=1">������������ HP.</a>';
							echo '<br><small>�������� '.round($max_hp-$vix).' HP</small>';
						}else{
							echo '<a style="cursor: pointer;">�������������� �������� ����� <span id="timer">'.$timeout.'</span></a>';
						}
					}else{
						echo '<a style="filter: alpha(opacity=20); -moz-opacity: 0.20; -khtml-opacity: 0.20; opacity: 0.20;" href="">������������ HP.</a>';
						echo '<br><small>�������� '.round($max_hp-$vix).' HP</small>';
					}
					?>
				</div>
			</div>
			<?php 
				$kolodec_mp = mysql_fetch_array(mysql_query('SELECT * FROM `a_kolodec` WHERE `uid` = "'.$u->info['id'].'" AND `type` = "1"'));?>
			<div align="center">
				<h3 style="padding-bottom: 5px; margin-bottom: 5px;"><img style="margin-right: 5px;" src="/images/manavortex.gif" /><span style="top: -5px;position: relative;">������� ����</span></h3>
				<div id="btn_kolodec">
				<?php 
					$timeout = timeout($kolodec_mp['time'] - time());
					if($vix2 < $max_hp ){
						if(!isset($kolodec_mp['id']) || $kolodec_mp['time'] < time()){
							echo '<a href="/main.php?inv=1&kolod_mp=1">������������ MP.</a>';
							echo '<br><small>�������� '.round($max_hp-$vix2).' MP</small>';
						}else{
							echo '<a style="cursor: pointer;">�������������� �������� ����� <span id="timer">'.$timeout.'</span></a>';
						}
					}else{
						echo '<a style="filter: alpha(opacity=20); -moz-opacity: 0.20; -khtml-opacity: 0.20; opacity: 0.20;" href="">������������ MP.</a>';
						echo '<br><small>�������� '.round($max_hp-$vix2).' MP</small>';
					}
					?>
				</div>
			</div>
		<?php }?>
		</td>
	    <td width="400" valign="top" align="center"><? if( true == true || $u->info['inTurnir'] == 0) { include('stats_inv.php'); } else { include('stats_inv2.php'); } ?></td>    
		<td valign="top"  id="itmAll">
			<div style="z-index: 2; position: relative; width:100%; display:table; box-sizing: border-box; margin: 0px; padding: 7px 5px 3px 5px;">
				<div style="display:table-cell;"><!-- ������ �������� � ������--></div>
				<div style="display:table-cell; text-align: right;">
                	<? if($u->info['admin'] > 0) { ?>
                    <? if(!isset($_COOKIE['newinv'])) { ?>
                    <input class="btn" type="button" onclick="top.frames['main'].location='main.php?newinv'"  value="����� ���������" />
                    <? }else{ ?>
                    <input class="btn" type="button" onclick="top.frames['main'].location='main.php?oldinv'"  value="������ ���������" />
                    <? } ?>
                    <? } ?>
					<? if($u->info['twink'] == 0) { ?>
					<input class="btn" type="button" onclick="top.frames['main'].location='achiev.php'"  value="����������" />
					<?}
					if($u->info['admin'] > 0) {
					?>
                    <input class="btnnew" type="button" onclick="top.frames['main'].location='main.php?inv&clearinv23'"  value="�������� �������� � ��������" />
                    <?
					}
					if($u->info['animal'] != 0) {
						echo '<input class="btnnew" type="button" onclick="top.frames[\'main\'].location=\'main.php?pet=1&rnd='.$code.'\'" value="�����" />';
					}
					?><input class="btnnew" type="button" onclick="top.frames['main'].location='main.php?skills&amp;side=1&amp;rn=<? echo $code; ?>'"  value="������" /><?
					if ($u->info['inTurnir'] == 0) { ?><input class="btnnew" type="button" onclick="top.frames['main'].location='main.php?obraz&rnd=<? echo $code; ?>'" value="�����" /><? }
					$gl = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `reimage` WHERE ((`uid` = "'.$u->info['id'].'" AND `clan` = "0") OR (`clan` = "'.$u->info['clan'].'" AND `clan` > 0)) AND `good` > 0 AND `bad` = "0" LIMIT 1'));
					// if($gl[0] > 0) { ?>
					<!-- <input class="btnnew" type="button" onclick="top.frames['main'].location='main.php?galery&rnd=<? //echo $code; ?>'" value="�������" /> -->
					<? //} unset($gl); 
					// if ($u->info['inTurnir'] == 0) { ?><!--<input class="btnnew2" type="button" onclick="location.href='main.php?referals'" value="��������������" />--><? //}
					?><input class="btnnew" type="button" onclick="top.frames['main'].location='main.php'" value="���������" />
					<!--
					<input class="btnnew" type="button" onclick="top.frames['main'].location='main.php?anketa&amp;rn=<? echo $code; ?>'" value="������" />
					<input class="btnnew" type="button" onclick="top.frames['main'].location='main.php?act_trf=1&amp;rn=<? echo $code; ?>'" value="����� � ���������" />
					<input class="btnnew" type="button" style="font-weight:bold;" value="������������" onclick="top.frames['main'].location='main.php?security&amp;rn=<? echo $code; ?>'" />
					<input class="btnnew" type="button" style="background-color:#A9AFC0" onClick="alert('������ �����������');" value="���������" />
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