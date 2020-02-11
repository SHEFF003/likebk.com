<?php
if(!defined('GAME'))
{
 die();
}

if($u->room['file']=='ab/altar_rune')
{
?>

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
	<div id="hint3" style="visibility:hidden"></div>
	<TABLE width="100%" cellspacing="0" cellpadding="0">
	<tr><td valign="top"><div align="center" class="pH3" style="padding: 10px;">Алтарь рун</div>
		<div id="run_plavka" style="padding-bottom: 7px; color: red; font-weight: bold;" align="left"><? if($re!=''){ echo '<font color="red"><b>'.$re.'</b></font>'; } ?></div>
	<td width="250" valign="top"><table align="right" cellpadding="0" cellspacing="0">
		<tr>
		  <!-- <td width="100%"></td> -->
		  <td><table  border="0" cellpadding="0" cellspacing="0">
			  <tr align="right" valign="top">
				<td><!-- -->
					<? echo $goLis; ?>
					<!-- -->
					<input style="margin-top: 8px;" type="button" value="Обновить" onClick="location='main.php';" />
					<input style="margin-top: 8px;" type="button" value="Вернуться" onClick="location='main.php?loc=3.180.0.271&rnd=<? echo $code; ?>';" />
				</td>
			  </tr>
		  </table></td>
		</tr>
	  </table>
	</td>
	</table>
	<div id="textgo" style="visibility:hidden;"></div>
<!--     	&nbsp; По всей видимости Алтарь рун был разрушен... <b>Лорд разрушитель</b> не дремлет... -->
    <?php $itmAll = ''; $itmAllSee = '';
	$itmAll = $u->genInv(12,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete` = "0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" ORDER BY `lastUPD` DESC');
	//$itmAll = $u->geninfRune(2,100);

	//$itmAllSee = $itmAll;
	if($itmAll[0]==0){
		$itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">ПУСТО (нет подходящих рун)</td></tr>';
	}else{
		$itmAllSee = $itmAll[2];
	}
	
	?>
<div id="relo_alt">
    <table class="altarRun" style="margin-top: 5px;" width="100%" border="0" cellspacing="0" cellpadding="10">
		<thead>
			<tr>
				<td>Выбранные руны для плавки</td>
				<td>Выберите руны для плавки</td>
			</tr>
		</thead>
		<tbody>
	   	  	<tr>
	    	    <td width="50%" valign="top">
		            <span id="use_item"><center>
		            	<span id="msg"><br /><br />Руны не выбраны</span>
		            </span>
		            <br /><br />
		            <!-- <input type="button" value="Растворить" onclick="location = '?r=<?//=$_GET['r'].'&rnd='.$code.'&itm=';?>'+urlras;" /></center> -->
		            <input class="plavka" type="button" value="Растворить" /></center>
		            <script type="text/javascript">
		            	$('.plavka').click(function(){
							var i = $('#use_item').find('.count_tbl').length;
							if(i == 3){
								var data = '';
								$('.count_tbl').each(function(i){
									data += 'name'+i+'='+$(this).attr('atr')+'&';
								});
								$.ajax({
									type: 'post',
									dataType: 'html',
									url: 'jx/plavka.php',
									data: data,
									success: function(data){
										$.get('jx/plavka_reload.php',function(data){
											$('#relo_alt').html(data);
										});
										$('#run_plavka').html(data);
										$('html, body').animate({scrollTop: 0},300);
										/*alert(data);
										location.reload();*/
									}
								});
							}
							else{
								alert("Для плавки рун надо 3 руны");
							}
						});
		            </script>
		            <fieldset>
				<b>Репутация: <? echo 0+$u->rep['rep1']; ?></b><span id="add_rep"></span><br><hr>
				<font color=red><b>Вы можете объединять 3 руны в 1, но с другими характеристиками.</b></font><br>
				<font color=red>Внимание!</font> Сплавленные руны, удаляются безвозвратно!
	            <br />
	            <br /><small>
	            </td>
	    	    <td valign="top" width="50%">
	            <!-- -->
	            <table width="100%" border="0" cellspacing="1" align="center" cellpadding="0" bgcolor="#A5A5A5">
	            <? if($u->info['invBlock']==0){ 
		            	echo $itmAllSee; 
		            }else{ 
		            	echo '<div align="center" style="padding:10px;background-color:#A5A5A5;">
		            	<form method="post" action="main.php?inv=1&otdel='.$_GET['otdel'].'&relockinvent">
		            		<b>Рюкзак закрыт.</b><br>
		            		<img title="Замок для рюкзака" src="http://img.real-combats.ru/i/items/box_lock.gif"> 
		            		Введите пароль: <input id="relockInv" name="relockInv" type="password">
		            		<input type="submit" value="Открыть">
		            	</form></div>'; } ?>
	            </table>
	            <!-- -->
	            </td>
	      </tr>
	    </tbody>
    </table>
</div>
<? } ?>
<script type="text/javascript">
	function takeItRun2(img,id,item_id,vl)
	{
		if(id!=urlras)
		{
			urlras = id;
			$('#msg').css('display', 'none');
			var i = $('#use_item').find('.count_tbl').length;
			if(i < 3){
				data = 'id='+id+'&itemid='+item_id+'&img='+img;
				$.ajax({
					type: 'post',
					url: 'jx/alt_rune.php',
					data: data,
					success: function(data){
						//alert("test");
						$('#use_item').prepend(data);
						$('.altarRun'+id).css('display', 'none');
						$('html, body').animate({scrollTop: 0},300);
					}
				});
			}
			else{
				alert("Для плавки необходимо 3 руны");
			}
			//document.getElementById('use_item').innerHTML += '<div class="us_i pl_run'+id+'"><img src="http://<?=$c['img'];?>/i/items/'+img+'" title="Предмет для разбивки"/><br><a href="javascript:void(0);" onClick="cancelItRun('+id+')">Отменить</a></div>';
			// document.getElementById('add_rep').innerHTML = ' + '+vl;
			
		}else{
			cancelItRun();
		}
	}
	function cancelItRun(id)
	{
		var co = $('.count_tbl').length;
		urlras = 0;
		$('.plrun_'+id).remove();
		if(co == 1){
			$('#msg').css('display', '');
		}
		//document.getElementById('use_item').innerHTML = 'Предмет не выбран';
		//document.getElementById('add_rep').innerHTML = '';
		$('.altarRun'+id).css('display', '');
	}
	urlras = 0;
</script>