<?php
header('Content-Type: text/html; charset=windows-1251');	

define('GAME',true);

include('_incl_data/__config.php');	
include('_incl_data/class/__db_connect.php');
include('_incl_data/class/__user.php');
?>

<script type="text/javascript" src="scripts/jquery.js"></script>
<link rel="stylesheet" href="styles/styles.css" type="text/css"/>
<title>LikeBK.com - ������ ������</title>
<style type="text/css">
	.head_tr{
		font-weight: bold; 
		background-color:#F4E7CC;
	}
	.psi_main_reg{
		background: url('../News/img/cont.gif');
	}
</style>
<div class="cont">
	<center>
		<div class="rgfrm">
		<table id="tbl" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td height="62"><table width="100%" height="62" border="0" cellpadding="0" cellspacing="0">
		      <tr>
		        <td width="129" class="psi_tlimg">&nbsp;</td>
		        <td align="center" class="psi_tline">
		        	<div class="psi_fix">
		<!--           	  <div class="psi_logo">&nbsp;</div> -->
		            </div>
		        </td>
		        <td width="129" class="psi_trimg">&nbsp;</td>
		      </tr>
		      </table></td>
		    </tr>
		  <tr>
		    <td>
		    <table class="psi_mainin" width="100%" border="0" cellspacing="0" cellpadding="0">
		      <tr>
		        <td width="23" class="psi_mleft">&nbsp;</td>
		        <td valign="top"  class="psi_main_reg">
	        		<h3>������ ������</h3>
			        <!-- main -->
			        <center>
						<table id="op_tbl" width="95%" border="1" cellspacing="0" cellpadding="0">
							<tbody>
								<tr class="head_tr">
									<td>�����</td>
									<td>�����</td>
								</tr>
						        <tr>
						        	<td>������������<br>(�������� ����)</td>
						        	<td><b>������������:</b><br>- ������� �����: +30</td>
						        </tr>
								<tr class="head_tr">
									<td>�����</td>
									<td>�����</td>
								</tr>
								<tr>
									<td>���� = 25</td>
									<td><b>���������� ����:</b><br>- ��. �������� ����� (%): +5</td>
								</tr>
						        <tr>
							        <td>���� = 50</td>
							        <td><b>���������� ����:</b><br>- ��. �������� ����� (%): +10</td>
						    	</tr>
						        <tr>
						        	<td>���� = 75</td>
						        	<td><b>���������� ����:</b><br>- ��. �������� ����� (%): +17</td>
						        </tr>
						        <tr>
						        	<td>���� = 100</td>
						        	<td><b>���������� ����:</b><br>- ��. �������� ����� (%): +25</td>
						        </tr>
						        <tr>
						        	<td>���� = 125</td>
						        	<td><b>���������� ����:</b><br>- ��. �������� ����� (%): +25<br>- ����������� ����: +10<br>- ������������ ����: +10</td>
						        </tr>
						        <tr>
						        	<td>���� = 150</td>
						        	<td><b>���������� ����:</b><br>- ��. �������� ����� (%): +30<br>- ����������� ����: +10<br>- ������������ ����: +10</td>
						        </tr>
						        <tr>
						        	<td>���� = 175</td>
						        	<td><b>���������� ����:</b><br>- ��. �������� ����� (%): +30<br>- ����������� ����: +15<br>- ������������ ����: +15</td>
						        </tr>
						        <tr class="head_tr">
						            <td>�����</td>
						            <td>�����</td>
						        </tr>
						        <tr>
						        	<td>�������� = 25</td>
						        	<td><b>�������� ������:</b><br>- ��. ����������� (%): +5</td>
						        </tr>
						        <tr>
						        	<td>�������� = 50</td>
						        	<td><b>�������� ������:</b><br>- ��. ����������� (%): +5<br>- ��. ������ ������������ ����� (%): +15<br>- ��. ����������� (%): +35</td>
						        </tr>
						        <tr>
						        	<td>�������� = 75</td>
						        	<td><b>�������� ������:</b><br>- ��. ����������� (%): +15<br>- ��. ������ ������������ ����� (%): +15<br>- ��. ����������� (%): +35</td>
						        </tr>
						        <tr>
						        	<td>�������� = 100</td>
						        	<td><b>�������� ������:</b><br>- ��. ����������� (%): +15<br>- ��. ������ ������������ ����� (%): +40<br>- ��. ����������� (%): +105</td>
						        </tr>
						        <tr>
						        	<td>�������� = 125</td>
						        	<td><b>�������� ������:</b><br>- ��. ����������� (%): +15<br>- ��. ������ ������������ ����� (%): +40<br>- ��. ����������� (%): +105<br>- ���. ��. ����������� (%): +5</td>
						        </tr>
						        <tr>
						        	<td>�������� = 150</td>
						        	<td><b>�������� ������:</b><br>- ��. ����������� (%): +20<br>- ��. ������ ������������ ����� (%): +40<br>- ��. ����������� (%): +115<br>- ���. ��. ����������� (%): +5</td>
						        </tr>
						        <tr>
						        	<td>�������� = 175</td>
						        	<td><b>�������� ������:</b><br>- ��. ����������� (%): +20<br>- ��. ������ ������������ ����� (%): +50<br>- ��. ����������� (%): +120<br>- ���. ��. ����������� (%): +7</td>
						        </tr>
						        <tr class="head_tr">
						            <td>�����</td>
						            <td>�����</td>
						        </tr>
						        <tr>
						        	<td>�������� = 25</td>
						        	<td><b>������������:</b><br>- ��. �������� ����. ����� (%): +10</td>
						        </tr>
						        <tr>
						        	<td>�������� = 50</td>
						        	<td><b>������������:</b><br>- ��. �������� ����. ����� (%): +10<br>- ��. ������������ ����� (%): +35<br>- ��. ������ ����������� (%): +15</td>
						        </tr>
						        <tr>
						        	<td>�������� = 75</td>
						        	<td><b>������������:</b><br>- ��. �������� ����. ����� (%): +25<br>- ��. ������������ ����� (%): +35<br>- ��. ������ ����������� (%): +15</td>
						        </tr>
						        <tr>
						        	<td>�������� = 100</td>
						        	<td><b>������������:</b><br>- ��. �������� ����. ����� (%): +25<br>- ��. ������������ ����� (%): +105<br>- ��. ������ ����������� (%): +45</td>
						        </tr>
						        <tr>
						        	<td>�������� = 125</td>
						        	<td><b>������������:</b><br>- ��. �������� ����. ����� (%): +25<br>- ��. ������������ ����� (%): +105<br>- ��. ������ ����������� (%): +45<br>- ���. ��. ����. �����: +5</td>
						        </tr>
						        <tr>
						        	<td>�������� = 150</td>
						        	<td><b>������������:</b><br>- ��. �������� ����. ����� (%): +30<br>- ��. ������������ ����� (%): +105<br>- ��. ������ ����������� (%): +45<br>- ���. ��. ����. �����: +5</td>
						        </tr>
						        <tr>
						        	<td>�������� = 175</td>
						        	<td><b>������������:</b><br>- ��. �������� ����. ����� (%): +30<br>- ��. ������������ ����� (%): +120<br>- ��. ������ ����������� (%): +45<br>- ���. ��. ����. �����: +7</td>
						        </tr>
						        <tr class="head_tr">
						            <td>�����</td>
						            <td>�����</td>
						        </tr>
						        <tr>
						        	<td>������������ = 25</td>
						        	<td><b>�������� ����:</b><br>- ������� �����: +50</td>
						        </tr>
						        <tr>
						        	<td>������������ = 50</td>
						        	<td><b>�������� ����:</b><br>- ������� �����: +100</td>
						        </tr>
						        <tr>
						        	<td>������������ = 75</td>
						        	<td><b>�������� ����:</b><br>- ������� �����: +175</td>
						        </tr>
						        <tr>
						        	<td>������������ = 100</td>
						        	<td><b>�������� ����:</b><br>- ������� �����: +250</td>
						        </tr>
						        <tr>
						        	<td>������������ = 125</td>
						        	<td><b>�������� ����:</b><br>- ������� �����: +250<br>- ������ �� �����: +25</td>
						        </tr>
						        <tr>
						        	<td>������������ = 150</td>
						        	<td><b>�������� ����:</b><br>- ������� �����: +350<br>- ������ �� �����: +50</td>
						        </tr>
						        <tr>
						        	<td>������������ = 175</td>
						        	<td><b>�������� ����:</b><br>- ������� �����: +400<br>- ������ �� �����: +100</td>
						        </tr>
								<tr class="head_tr">
						            <td>�����</td>
						            <td>�����</td>
						        </tr>
						        <tr>
						        	<td>��������� = 25</td>
						        	<td><b>�����:</b><br>- �������� ����� ������ (%): +5</td>
						        </tr>
						        <tr>
						        	<td>��������� = 50</td>
						        	<td><b>�����:</b><br>- �������� ����� ������ (%): +10</td>
						        </tr>
						        <tr>
						        	<td>��������� = 75</td>
						        	<td><b>�����:</b><br>- �������� ����� ������ (%): +17</td>
						        </tr>
						        <tr>
						        	<td>��������� = 100</td>
						        	<td><b>�����:</b><br>- �������� ����� ������ (%): +25</td>
						        </tr>
						        <tr>
						        	<td>��������� = 125</td>
						        	<td><b>�����:</b><br>- �������� ����� ������ (%): +35</td>
						        </tr>
						        <tr>
						        	<td>��������� = 150</td>
						        	<td><b>�����:</b><br>- �������� ����� ������ (%): +45</td>
						        </tr>
						        <tr>
						        	<td>��������� = 175</td>
						        	<td><b>�����:</b><br>- �������� ����� ������ (%): +60</td>
						        </tr>
						        <tr class="head_tr">
						            <td>�����</td>
						            <td>�����</td>
						        </tr>
						        <tr>
						        	<td>�������� = 25</td>
						        	<td><b>���� ��������:</b><br>- ������� ����: +50<br>- �������������� ���� (%): +100</td>
						        </tr>
						        <tr>
						        	<td>�������� = 50</td>
						        	<td><b>���� ��������:</b><br>- ������� ����: +100<br>- �������������� ���� (%): +200</td>
						        </tr>
						        <tr>
						        	<td>�������� = 75</td>
						        	<td><b>���� ��������:</b><br>- ������� ����: +175<br>- �������������� ���� (%): +350</td>
						        </tr>
						        <tr>
						        	<td>�������� = 100</td>
						        	<td><b>���� ��������:</b><br>- ������� ����: +250<br>- �������������� ���� (%): +500</td>
						        </tr>
						        <tr>
						        	<td>�������� = 125</td>
						        	<td><b>���� ��������:</b><br>- ������� ����: +250<br>- �������������� ���� (%): +500<br>- ���������� �� �����: +3</td>
						        </tr>
						        <tr>
						        	<td>�������� = 150</td>
						        	<td><b>���� ��������:</b><br>- ������� ����: +300<br>- �������������� ���� (%): +600<br>- ���������� �� �����: +3</td>
						        </tr>
						        <tr>
						        	<td>�������� = 175</td>
						        	<td><b>���� ��������:</b><br>- ������� ����: +350<br>- �������������� ���� (%): +700<br>- ���������� �� �����: +5</td>
						        </tr>
						        <tr class="head_tr">
						            <td>�����</td>
						            <td>�����</td>
						        </tr>
						        <!--<tr>
						        	<td>���������� = 25</td>
						        	<td><b>�������� ������:</b><br>- ����� ����� ������ ���� ��� ����� "���������� ������"</td>
						        </tr>-->
						        <tr>
						        	<td>���������� = 50</td>
						        	<td><b>�������� ���������:</b><br>- ����� ����� ������ ���� ��� ����� "���������� ������"<br>- ������ ��� �� ��������� ��� ��������� ����� "��������" <img src="http://img.<?= $c['host']?>/i/eff/preservation.gif"></td>
						        </tr>
						        <!--<tr>
						        	<td>���������� = 75</td>
						        	<td><b>���� ����:</b><br>- ����� ����� ������ ���� ��� ����� "���������� ������"<br>- ������ ��� �� ��������� ��� ��������� ����� "��������" <img src="http://img.<?//= $c['host']?><!--/i/eff/preservation.gif"><br>- ����������� � �������� ������ ����� ������ ���� ����</td>
						        </tr>
						        <tr>
						        	<td>���������� = 100</td>
						        	<td><b>��������:</b><br>- ����� ����� ������ ���� ��� ����� "���������� ������"<br>- ������ ��� �� ��������� ��� ��������� ����� "��������" <img src="http://img.<?//= $c['host']?><!--/i/eff/preservation.gif"><br>- ����������� � �������� ������ ����� ������ ���� ����<br>- ������ ������� ��� �� ���������� �������� ����������, ���������, �������� � ���� � ������� ���</td>
						        </tr>-->
							</tbody>
						</table>
			        </center>
					<!-- main -->	
		        </td>
		        <td width="23" class="psi_mright">&nbsp;</td>
		      </tr>
		      </table>
		    </td>
		    </tr>
		  <tr>
		    <td height="62"><table width="100%" height="62" border="0" cellpadding="0" cellspacing="0">
		      <tr>
		        <td width="129" class="psi_dlimg">&nbsp;</td>
		        <td class="psi_dline">&nbsp;</td>
		        <td width="129" class="psi_drimg">&nbsp;</td>
		      </tr>
		    </table></td>
		    </tr>
		</table>
		</div>
	<!-- test window -->
	</center>
</div>