<?php
if(!defined('GAME'))
{
	die();
}
if($u->room['file']=='denRussia')
{	
	
	$sid = 1206;

	$error = '';
	
	if(isset($_GET['buy'])){
		if($u->newAct($_GET['sd4'])==true)
		{
			$re = $u->buyItem($sid,(int)$_GET['buy'],(int)$_GET['x']);
		}
	}
	
	if($re!=''){ echo '<div align="right"><font color="red"><b>'.$re.'</b></font></div>'; } ?>
	<script type="text/javascript">
	function AddCount(name, txt){
		document.getElementById("hint4").innerHTML = '<table border=0 width=100% cellspacing=1 cellpadding=0 bgcolor="#CCC3AA"><tr><td align=center><B>Купить неск. штук</td><td width=20 align=right valign=top style="cursor: pointer" onclick="closehint3();"><BIG><B>x</TD></tr><tr><td colspan=2>'+
		'<form method=post><table border=0 width=100% cellspacing=0 cellpadding=0 bgcolor="#FFF6DD"><tr><INPUT TYPE="hidden" name="set" value="'+name+'"><td colspan=2 align=center><B><I>'+txt+'</td></tr><tr><td width=80% align=right>'+
		'Количество (шт.) <INPUT TYPE="text" NAME="count" id=count size=4></td><td width=20%>&nbsp;<INPUT TYPE="submit" value=" »» ">'+
		'</TD></TR></form></TABLE></td></tr></table>';
		document.getElementById("hint4").style.visibility = 'visible';
		document.getElementById("hint4").style.left = '100px';
		document.getElementById("hint4").style.top = '100px';
		document.getElementById("count").focus();
	}
	function closehint3() {
	document.getElementById('hint4').style.visibility='hidden';
	Hint3Name='';
	}	
	</script>
	<style type="text/css"> 
		.pH3{ 
			color: #8f0000;  
			font-family: Arial;  
			font-size: 12pt;  
			font-weight: bold; 
		}
	</style>
	<table width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top" colspan="2">
				<div style="margin-top: 5px;" align="center" class="pH3">6 месяцев likeBK!</div>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo '<b style="color:red">'.$error.'</b>';?>
			</td>
			<td align="right" valign="top">
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
												<td bgcolor="#D3D3D3" nowrap><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.9&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.9',1); ?>">Центральная площадь</a></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<br>
				<br>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" CELLSPACING="1" CELLPADDING="1" bgcolor="#a5a5a5">
					<?php
						//Выводим вещи в магазине для покупки
						$u->shopItems($sid);
					?>
				</table>
			</td>
		</tr>
	</table>
	<div id="textgo" style="visibility:hidden;"></div>
<?php }?>