<?php 
define('GAME',true);

include('../../_incl_data/__config.php');
include('../../_incl_data/class/__db_connect.php');
include('../../_incl_data/class/__user.php');

$it_main = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$_POST['itemid'].'"'));
?>
<table class="count_tbl plrun_<?php echo $_POST['id']?>" atr="plrun_<?php echo $_POST['id']?>" style="border-top:#A5A5A5 1px solid;" width="100%" border="0" cellspacing="0" cellpadding="0">
	<tbody>
		<tr>
			<td  bgcolor="#c8c8c8" width="160" align="center" style="border-right:#A5A5A5 1px solid; padding:5px;">
				<?php echo '<img src="http://'.$c['img'].'/i/items/'.$_POST['img'].'" style="margin-bottom:5px;">'?><br>
				<a href="javascript:void(0);" onClick="cancelItRun(<?php echo $_POST['id']?>)">Отменить</a>
			</td>
			<td  bgcolor="#c8c8c8" valign="top" align="left" style="padding-left:3px; padding-bottom:3px; padding-top:7px;">
				<div align="left">
					<a class="inv_name" ><?php echo $it_main['name']?></a>&nbsp;&nbsp; 
					(Масса: <?php echo $it_main['massa']?>) 
				</div>
			</td>
		</tr>
	</tbody>
</table>