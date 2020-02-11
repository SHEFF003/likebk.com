<?
	$us = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$u->info['id'].'"'));

if(isset($_GET['alltype'])) {
	
	$x = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `items_users` WHERE `delete` = 0 AND `uid` = "'.$u->info['id'].'" AND `item_id` = "'.mysql_real_escape_string($_GET['alltype']).'" LIMIT 1'));
	$x = $x[0];
	if( $x > 0 ) {
		$itm = mysql_fetch_array(mysql_query('SELECT `id`,`name` FROM `items_main` WHERE `id` = "'.mysql_real_escape_string($_GET['alltype']).'" LIMIT 1'));
		mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `delete` = 0 AND `uid` = "'.$u->info['id'].'" AND `item_id` = "'.mysql_real_escape_string($_GET['alltype']).'"');
		mysql_query('UPDATE `rep` SET `nagrada` = `nagrada` + '.$x.' WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
	//	$u->rep['allrep'] += $x;
		$u->rep['nagrada'] += $x;
		$u->error = 'Вы успешно обменяли &quot;'.$itm['name'].' (x'.$x.')&quot; на '.$x.' репутации.';
	}else{
		$u->error = 'У вас нет таких предметов...';
	}
	if(isset($u->error)) {
		echo '<div><font color="red"><b>'.$u->error.'</b></font></div>';
	}
}

$itmAll = ''; $itmAllSee = '';
$itmAll = $u->genInv(666,'`iu`.`uid`="'.$u->info['id'].'" AND `ish`.`sid` = "609" AND `ish`.`r` = "6" AND `ish`.`kolvo` > "0" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" ORDER BY `lastUPD`  DESC');
//$itmAll = $u->geninfRune(2,100);

//$itmAllSee = $itmAll;
if($itmAll[0]==0){
	$itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">ПУСТО (нет подходящих вещей)</td></tr>';
}else{
	$itmAllSee = $itmAll[2];
}

?>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<style type="text/css">
	.altarRun thead td, .altPred thead td{
		background: #A5A5A5;
		text-align: center;
		font-weight: bold;
		border: 1px solid #696969;
		padding-top: 0px;
		padding-bottom: 0px;
	}
	.altarRun tbody td, .altPred tbody td{
		padding: 0px;
	}
	.us_i{
		margin-bottom: 5px;
	}
	.pH3			{ COLOR: #8f0000;  FONT-FAMILY: Arial;  FONT-SIZE: 12pt;  FONT-WEIGHT: bold; }
	.class_ {
		font-weight: bold;
		color: #C5C5C5;
		cursor:pointer;
	}
	.class_st {
		font-weight: bold;
		color: #659BA3;
		cursor:pointer;
	}
	.class__ {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #659BA3;
	}
	.class__st {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #659BA3;
		font-size: 10px;
	}
	.class_old {
		font-weight: bold;
		color: #919191;
		cursor:pointer;
	}
	.class__old {
		font-weight: bold;
		color: #FFFFFF;
		cursor:pointer;
		background-color: #838383;
		font-size: 10px;
	}
	
	</style>
<TABLE width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="2" valign="top">
			<div align="center" class="pH3" style="padding: 10px;"><h3>Пещерный вещи</h3></div>
		</td>		
	</tr>
	<tr>
		<td>
			<div id="run_plavka" style="padding-bottom: 7px; color: red; font-weight: bold;" align="left"><? if($re!=''){ echo '<font color="red"><b>'.$re.'</b></font>'; } ?></div>
		</td>
		<td width="200" valign="top">
			<input type='button' value='Обновить' onClick="location='main.php?cave_stuf=1'"/>
			<input type='button' onclick='location="main.php?rz=1"' value="Вернуться" />
		</td>
	</tr>
</table>
<div id="relo_alt">
	<table class="altarRun" style="margin-top: 5px;" width="100%" border="0" cellspacing="0" cellpadding="10">
		<thead>
			<tr>
				<td>Выбранные вещи</td>
				<td>Выберите вещи для сдачи</td>
			</tr>
		</thead>
		<tbody>
	   	  	<tr>
	    	    <td width="50%" valign="top">
		            <span id="use_item"><center>
		            	<span id="msg"><br /><br />Вещи не выбраны</span>
		            </span>
		            <br /><br />
		            <!-- <input type="button" value="Растворить" onclick="location = '?r=<?//=$_GET['r'].'&rnd='.$code.'&itm=';?>'+urlras;" /></center> -->
		            <input class="plavka" type="button" value="Сдать" /></center>
		            <script type="text/javascript">
		            	$('.plavka').click(function(){
							if (confirm('Вы действительно хотите сдать?')) {
								var i = $('#use_item').find('.count_tbl').length;
								var data = '';
								$('.count_tbl').each(function(i){
									data += 'name'+i+'='+$(this).attr('atr')+'&';
								});
								$.ajax({
									type: 'post',
									dataType: 'html',
									url: 'jx/cave/pl_cave.php',
									data: data,
									success: function(data){
										$.get('jx/cave/cave_reload.php',function(data){
											$('#relo_alt').html(data);
										});
										$('#run_plavka').html(data);
										$('html, body').animate({scrollTop: 0},300);
										/*alert(data);
										location.reload();*/
									}
								});
							}
						});
		            </script>
		            <fieldset>
				<b>Репутация: <? echo $u->rep['nagrada']; /*0+($u->rep['allrep']-$u->rep['allnurep']);*/ ?></b><span id="add_rep"></span> ед.<br><hr>
				<font color=red><b>Вы можете сдать пещерные вещи за 1 ед.</b></font><br>
				<font color=red>Внимание!</font> Вещи, удаляются безвозвратно!
	            <br />
	            <br /><small>
	            </td>
	    	    <td valign="top" width="50%">
	    	    	<table width="100%" border="0" cellspacing="1" align="center" cellpadding="0" bgcolor="#A5A5A5">
		            	<?php echo $itmAllSee;?>
		            </table>
	            </td>
	      </tr>
	    </tbody>
	</table>
</div>
<script type="text/javascript">
	function takeItRun2(img,id,item_id,vl)
	{
		if(id!=urlras)
		{
			urlras = id;
			$('#msg').css('display', 'none');
			var i = $('#use_item').find('.count_tbl').length;
			var rep = (i+1);
			data = 'id='+id+'&itemid='+item_id+'&img='+img;
			$.ajax({
				type: 'post',
				url: 'jx/cave/cavestuff.php',
				data: data,
				success: function(data){
					//alert("test");
					$('#use_item').prepend(data);
					$('.altarRun'+id).css('display', 'none');
					$('html, body').animate({scrollTop: 0},300);
				}
			});
			//document.getElementById('use_item').innerHTML += '<div class="us_i pl_run'+id+'"><img src="http://<?=$c['img'];?>/i/items/'+img+'" title="Предмет для разбивки"/><br><a href="javascript:void(0);" onClick="cancelItRun('+id+')">Отменить</a></div>';
			document.getElementById('add_rep').innerHTML = ' + '+rep;
			
		}else{
			cancelItRun();
		}
	}
	function cancelItRun(id)
	{
		var co = $('.count_tbl').length;
		urlras = 0;
		var rep = (co-1);
		$('.plrun_'+id).remove();
		document.getElementById('add_rep').innerHTML = '+'+rep;
		if(co == 1){
			$('#msg').css('display', '');
			document.getElementById('add_rep').innerHTML = '';
		}
		//document.getElementById('use_item').innerHTML = 'Предмет не выбран';
		//document.getElementById('add_rep').innerHTML = '';
		$('.altarRun'+id).css('display', '');
	}
	urlras = 0;
</script>