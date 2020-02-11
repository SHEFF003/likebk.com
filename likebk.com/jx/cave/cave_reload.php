<?php
 
define('GAME',true);

include('../../_incl_data/__config.php');
include('../../_incl_data/class/__db_connect.php');
include('../../_incl_data/class/__user.php');
	$us = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$u->info['id'].'"'));

$itmAll = ''; $itmAllSee = '';
$itmAll = $u->genInv(666,'`iu`.`uid`="'.$u->info['id'].'" AND `ish`.`sid` = "609" AND `ish`.`r` = "6" AND `ish`.`kolvo` > "0" AND `iu`.`delete`="0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" ORDER BY `lastUPD`  DESC');
//$itmAll = $u->geninfRune(2,100);

//$itmAllSee = $itmAll;
if($itmAll[0]==0){
	$itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">ПУСТО (нет подходящих вещей)</td></tr>';
}else{
	$itmAllSee = $itmAll[2];
}?>
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
					});
	            </script>
	            <fieldset>
			<b>Репутация: <? /*echo 0+($u->rep['allrep']-$u->rep['allnurep']);*/ echo $u->rep['nagrada']; ?></b><span id="add_rep"></span> ед.<br><hr>
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