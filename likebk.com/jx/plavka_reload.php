<?php 
define('GAME',true);

include('../_incl_data/__config.php');
include('../_incl_data/class/__db_connect.php');
include('../_incl_data/class/__user.php');

	$itmAll = ''; $itmAllSee = '';
	$itmAll = $u->genInv(12,'`iu`.`uid`="'.$u->info['id'].'" AND `iu`.`delete` = "0" AND `iu`.`inOdet`="0" AND `iu`.`inShop`="0" ORDER BY `lastUPD` DESC');
	//$itmAll = $u->geninfRune(2,100);

	//$itmAllSee = $itmAll;
	if($itmAll[0]==0){
		$itmAllSee = '<tr><td align="center" bgcolor="#e2e0e0">����� (��� ���������� ���������)</td></tr>';
	}else{
		$itmAllSee = $itmAll[2];
	}?>
	<table class="altarRun" width="100%" border="0" cellspacing="0" cellpadding="10">
		<thead>
			<tr>
				<td>��������� ���� ��� ������</td>
				<td>�������� ���� ��� ������</td>
			</tr>
		</thead>
		<tbody>
	   	  	<tr>
	    	    <td width="50%" valign="top">
		            <span id="use_item"><center>
		            	<span id="msg"><br /><br />���� �� �������</span>
		            </span>
		            <br /><br />
		            <!-- <input type="button" value="����������" onclick="location = '?r=<?//=$_GET['r'].'&rnd='.$code.'&itm=';?>'+urlras;" /></center> -->
		            <input class="plavka" type="button" value="����������" /></center>
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
								alert("��� ������ ��� ���� 3 ����");
							}
						});
		            </script>
		            <fieldset>
				<b>���� ������: <? echo 0+$u->rep['rep1']; ?></b><span id="add_rep"></span><br><hr>
				<font color=red>��������!</font> ����������� ����, ��������� ������������!
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
		            		<b>������ ������.</b><br>
		            		<img title="����� ��� �������" src="http://img.real-combats.ru/i/items/box_lock.gif"> 
		            		������� ������: <input id="relockInv" name="relockInv" type="password">
		            		<input type="submit" value="�������">
		            	</form></div>'; } ?>
	            </table>
	            <!-- -->
	            </td>
	      </tr>
	    </tbody>
    </table>