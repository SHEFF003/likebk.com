<?php

if(!defined('GAME')) { die(); }

if(isset($_GET['r'])) {
  $_GET['r'] = (int)$_GET['r'];
} else {
  $_GET['r'] = null;	
}

if($u->info['inTurnir'] > 0 && $u->info['inUser'] == 0 && $u->info['room'] == 318) {
  die('<script>location="main.php";</script>');
}

if($_GET['r'] == 4) {
	unset($_GET['r']);
}

if(($_GET['r'] == 9 || $_GET['r'] == 10) && $u->info['admin'] == 0) {
	unset($_GET['r']);
}

//$u->info['referals'] = mysql_fetch_array(mysql_query('SELECT COUNT(`id`) FROM `register_code` WHERE `uid` = "'.$u->info['id'].'" AND `time_finish` > 0 AND `end` = 0 LIMIT 1000'));			 
//$u->info['referals'] = $u->info['referals'][0];

include('_incl_data/class/__zv.php');

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://likebk.com/js/logs/bootstrap.min.js" type="text/javascript"></script>
<script src="http://likebk.com/js/logs/cookie.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/tooltip.css" />
<link href="http://likebk.com/css/bootstrap.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
  $(document).ready(function(){
      $('[rel="tooltip"]').tooltip();   
      $('[rel="tooltip"]').css('cursor','pointer');
  });
</script><script>
  function haotgo(event) {
	  var gox = event.clientX;
	  var goy = event.clientY;
	  $('#gox').val(gox);
	  $('#goy').val(goy);
  }
</script>
<script> var zv_Priem = 0; </script>

<style> 
.m { background: #99CCCC; text-align: center; }
.s { background: #BBDDDD; text-align: center; }
</style>
<TABLE width=100% cellspacing=1 cellpadding=3>
<TR><TD colspan=8 align=right>
<div style="float:left; margin-top: 10px">
  <? echo $zv->userInfo();
  echo '<script>top.lafstReg['.$u->info['id'].'] = 0; top.startHpRegen("main",'.$u->info['id'].','.(0+$u->stats['hpNow']).','.(0+$u->stats['hpAll']).','.(0+$u->stats['mpNow']).','.(0+$u->stats['mpAll']).','.(time()-$u->info['regHP']).','.(time()-$u->info['regMP']).','.(0+$u->rgd[0]).','.(0+$u->rgd[1]).',1);</script>';
  ?>
</div>
<div style="float:right; margin-bottom: 5px;">
	<? if($u->info['admin']>0) { ?>
    <INPUT onClick="location='/battle/application.php';" class="btn" style=" padding-top:3px; padding-bottom: 3px;" TYPE="button" name="tmp" value="����� ������">
    <? } ?>
  <INPUT onClick="location='main.php?zayvka&r=<? echo $_GET['r']; ?>&rnd=<? echo $code; ?>';" class="btnnew" style=" padding-top:3px; padding-bottom: 3px;" TYPE="button" name="tmp" value="��������">
    <!-- <INPUT class="btn btn-default btnnew btn-xs" TYPE=button value="����� �����" onClick="location.href='main.php?worldmap&rnd=<? //echo $code; ?>';">-->
    <!-- <INPUT class="btnnew" style="font-size: 13px; padding-top:3px; padding-bottom: 3px;" TYPE=button value="���������" style="background-color:#A9AFC0" onClick="window.open('/encicl/help/combats.html', 'help', 'height=300,width=500,location=no,menubar=no,status=no,toolbar=no,scrollbars=yes')"> -->
    <INPUT class="btnnew" style=" padding-top:3px; padding-bottom: 3px;" TYPE=button value="���������" onClick="location.href='main.php?rnd=<? echo $code; ?>';">
</div>

</td></tr>
<tr>
  <td width="5%" class="s" style="border-right: 1px solid #fff;"><strong>���: </strong></td>
<?php if($u->info['level'] < 1){ ?>
<td width="13%" style="border-right: 1px solid #fff;" class="<? if($_GET['r'] == 1) { echo 's'; } else { echo 'm'; } ?>"><a href="main.php?zayvka=1&r=1&rnd=<? echo $code; ?>">�������</a></td>
<?php } ?>
<td width="13%" style="border-right: 1px solid #fff;" class="<? if($_GET['r'] == 2) { echo 's'; } else { echo 'm'; } ?>"><a href="main.php?zayvka=1&r=2&rnd=<? echo $code; ?>">����������</a></td>
<td width="12%" class="<? if($_GET['r'] == 3) { echo 's'; } else { echo 'm'; } ?>"><a href="main.php?zayvka=1&r=3&rnd=<? //echo $code; ?>">����������</a></td>
<? /* <td width="12%" style="border-right: 1px solid #fff;" class="<? if($_GET['r'] == 4) { echo 's'; } else { echo 'm'; } ?>"><a href="main.php?zayvka=1&r=4&rnd=<? echo $code; ?>">���������</a></td>*/ ?>
<td width="12%" style="border-right: 1px solid #fff;" class="<? if($_GET['r'] == 5) { echo 's'; } else { echo 'm'; } ?>">
<? if( $u->info['boogeyman'] < time() && $u->info['id'] == 12345 && rand(0,100) < 10 ) {
	mysql_query('UPDATE `users` SET `boogeyman` = "'.(time()+86400).'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');	
?>
	<a href="https://xcombats.com/reg" onClick="top.location.href = top.location.href;" target="_blank">���������</a>
<? }else{ ?>
	<a href="main.php?zayvka=1&r=5&rnd=<? echo $code; ?>">���������</a>
<? } ?>

</td>
<td width="12%" class="<? if($_GET['r'] == 8) { echo 's'; } else { echo 'm'; } ?>"><a href="main.php?zayvka=1&r=8&rnd=<? echo $code; ?>">�������</a></td>
<td width="13%" style="border-right: 1px solid #fff;" class="<? if($_GET['r'] == 6) { echo 's'; } else { echo 'm'; } ?>"><a href="main.php?zayvka=1&r=6&rnd=<? echo $code; ?>">�������</a></td>
<td width="13%" class="<? if($_GET['r'] == 7) { echo 's'; } else { echo 'm'; } ?>"><a href="main.php?zayvka=1&r=7&rnd=<? echo $code; ?>">�����������</a></td>
<td width="13%" class="<? if($_GET['r'] == 9) { echo 's'; } else { echo 'm'; } ?>"><a href="main.php?zayvka=1&r=9&rnd=<? echo $code; ?>">��� 2.0</a></td>
<td width="13%" class="<? if($_GET['r'] == 10) { echo 's'; } else { echo 'm'; } ?>"><a href="main.php?zayvka=1&r=10&rnd=<? echo $code; ?>">����� 2.0</a></td>
</tr></tr></table>
<div style="padding:2px;">
<?
$zi = false;

if($u->info['battle'] == 0) {
  if(isset($_POST['add_new_zv'])) {
  $zv->add();
  } elseif(isset($_GET['bot']) && ( $u->info['level'] <= 7 || $u->info['admin'] > 0)) {
  $zv->addBot();
  } elseif(isset($_GET['add_group'])) {
  $zv->add();
  } elseif(isset($_GET['start_haot'])) {
  $zv->add();
  }
}

if($u->info['zv'] != 0) {
  $zi = mysql_fetch_array(mysql_query('SELECT * FROM `zayvki` WHERE `id`="'.$u->info['zv'].'" AND `city` = "'.$u->info['city'].'" AND `start` = "0" AND `cancel` = "0" AND (`time` > "'.(time()-60*60*2).'" OR `razdel` > 3) LIMIT 1'));
  if(!isset($zi['id'])) {
  $zi = false;
  $u->info['zv'] = 0;
  mysql_query('UPDATE `stats` SET `zv` = "0" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
  }
}

if($u->info['battle'] == 0) {
  if(isset($_POST['groupClick']) && !isset($zi['id'])) {
  $zg = mysql_fetch_array(mysql_query('SELECT * FROM `zayvki` WHERE `id` = "'.mysql_real_escape_string((int)$_POST['groupClick']).'" AND `cancel` = "0" AND `btl_id` = "0" AND `city` = "'.$u->info['city'].'" AND `razdel` = "4" AND `start` = "0" AND `time` > "'.(time()-60*60*2).'" LIMIT 1'));
  if(!isset($zg['id'])) {
    echo '<center><br /><br />������ �� ��������� ��� �� �������.</center>';
  } else {
    $tm_start = floor(($zg['time']+$zg['time_start']-time())/6)/10;
    $tm_start = $zv->rzv($tm_start);
    $tm1 = ''; $tm2 = '';
    $users = mysql_query('SELECT `u`.`id`, `u`.`login`, `u`.`level`, `u`.`align`, `u`.`clan`, `u`.`admin`, `st`.`team` FROM `users` AS `u` LEFT JOIN `stats` AS `st` ON `u`.`id` = `st`.`id` WHERE `st`.`zv` = "'.$zg['id'].'"');
    while($s = mysql_fetch_array($users)) {
    ${'tm'.$s['team']} .= '<b>'.$s['login'].'</b> ['.$s['level'].']<a href="inf.php?'.$s['id'].'" target="_blank"><img src="http://img.likebk.com/i/inf_capitalcity.gif" title="���. � '.$s['login'].'" /></a><br />';
    }         
    if($tm1 == '') {
    $tm1 = '������ ���� �� �������';
    } else {
    $tm1 = rtrim($tm1, '<br />');
    }
    if($tm2 == '') {
    $tm2 = '������ ���� �� �������';
    } else {
    $tm2 = rtrim($tm2, '<br />');
    }
    $sv1 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `zv` = "'.$zg['id'].'" AND `team` = "1" LIMIT 100'));
    $sv2 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stats` WHERE `zv` = "'.$zg['id'].'" AND `team` = "2" LIMIT 100'));
    $sv1 = $zg['tm1max']-$sv1[0];
    $sv2 = $zg['tm2max']-$sv2[0];
?></div>
<table style="margin-top:2px;" width="100%">
  <tr>
    <td> ��� �������� ����� <? echo $tm_start; ?> ���. </td>
    <td align="right">
    <!-- <input class="btnnew" type="button" value="�����" onclick="location.href='main.php?zayvka&r=<? //echo $_GET['r']; ?>&rnd=<? //echo $code; ?>';"> -->
    </td>
  </tr>
</table>
<h3 align="center">�� ���� ������� ������ ���������?</h3>
<table class="tbl_groop" align="center" cellspacing="4" cellpadding="1">
  <tr class="pdg">
    <td bgcolor="99CCCC" ><b>������ ����:</b><br />
      ������������ ���-��: <strong><? echo $zg['tm1max']; ?></strong><br />
      ����������� �� ������:<strong> <? echo $zg['min_lvl_1'].' - '.$zg['max_lvl_1']; ?></strong></td>
    <td bgcolor="99CCCC"><b>������ ���:</b><br />
      ������������ ���-��: <strong><? echo $zg['tm2max']; ?></strong><br />
      ����������� �� ������: <strong><? echo $zg['min_lvl_2'].' - '.$zg['max_lvl_2']; ?></strong> </td>
  </tr>
  <tr>
    <td align="center"><? echo $tm1; ?>
      <br />
    </td>
    <td align="center"><? echo $tm2; ?>
        <br />
    </td>
  </tr>
  <tr>
    <td align="center"><input class="btnnew" style="font-size: 13px;" title="�� ������ ������ �������� ����: <? echo $sv1; ?>" onclick="location='main.php?r=<? echo $_GET['r']; ?>&zayvka&btl_go=<? echo $zg['id']; ?>&tm1=<? echo $code; ?>'" type="submit" name="confirm1" value="� �� ����!" /></td>
    <td align="center"><input class="btnnew" style="font-size: 13px;" title="�� ������ ������ �������� ����: <? echo $sv2; ?>" onclick="location='main.php?r=<? echo $_GET['r']; ?>&zayvka&btl_go=<? echo $zg['id']; ?>&tm2=<? echo $code; ?>'" type="submit" name="confirm2" value="� �� ����!" /></td>
  </tr>
</table>
<?
  }
  } elseif(isset($_GET['cancelzv']) && !isset($_POST['add_new_zv'])) {
    $zv->cancelzv();
  } elseif(isset($_GET['startBattle']) && isset($zi['id']) && ($zi['razdel'] >= 1 || $zi['razdel'] <= 3 || $zi['razdel'] == 9)) {
    $zv->startBattle($zi['id']);
  } elseif($u->info['level'] > 7 && $_GET['r'] == 4  && !isset($zi['id']) && ($u->info['room'] == 4 || $u->info['room'] == 16 || $u->info['room'] == 375 || $u->info['room'] == 376)) {
    //����� ������ ������ ��� ���������� ���
    ?>
<div style="margin-top: 10px; margin-left: 10px; margin-right: 10px;">
    <input type="button" name="tmp" value="������ ������ �� ��������� ���" class="btnnew newgroup" style="float: left; padding-top:3px; padding-bottom: 3px;">
  <!-- <div style="float:right;">
    <INPUT onClick="location='main.php?zayvka&r=<? //echo $_GET['r']; ?>&rnd=<? //echo $code; ?>';" class="btnnew" style="font-size: 13px; padding-top:3px; padding-bottom: 3px;" TYPE="button" name="tmp" value="��������">
  </div> -->
</div>
<div style="clear: both"></div>
<form class="zv_form" style="display: none;" method="post" action="main.php?zayvka&r=<? echo $_GET['r']; ?>&add_group&rnd=<? echo $code; ?>">
<table style="margin-left: 15px;ss">
  <tr>
    <td><h3 style="text-align: left;">������ ������ �� ��������� ���</h3>
      ������ ��� �����
      <span style="width: 120px; display: inline-block;">
        <select class="form-control" name="startime">
            <option value="300">5 ����� </option>
          <option value="600">10 ����� </option>
          <option value="900">15 ����� </option>
          <option value="1200">20 ����� </option>
          <option value="1800">30 ����� </option>
        </select>
      </span>
      �������:
      <span style="width: 120px; display: inline-block;">
        <select class="form-control" name="timeout">
          <option value="1">1 ���.</option>
          <option value="2">2 ���.</option>
          <option value="3">3 ���.</option>
          <option value="4">4 ���.</option>
          <option value="5">5 ���.</option>
        </select>
      </span>
      <br />
      ���� �������: 
      <span class="spn_in" style="margin-top: 5px; width: 40px; display: inline-block;">
        <input class="form-control" type="text" name="nlogin1" size="3" maxlength="2" />
      </span>         �������
      <span style="width: 275px; display: inline-block;">
        <select class="form-control" name="levellogin1">
         <!-- <option value="0">����� </option>-->
          <option value="1">������ ����� � ���� </option>
          <option value="2">������ ���� ����� ������ </option>
          <option value="3">������ ����� ������ </option>
          <option value="4">�� ������ ���� ����� ��� �� ������� </option>
          <option value="5">�� ������ ���� ����� ��� �� ������� </option>
          <option value="6">��� ������� +/- 1 </option>
          <option value="99">��� ���� </option>
        </select>
      </span>
      <br />
      ����������: 
      <span class="spn_in" style="margin-top: 5px; width: 40px; display: inline-block;">
        <input class="form-control" type="text" name="nlogin2" size="3" maxlength="2" />
      </span>         �������
      <span style="width: 275px; display: inline-block;">
      <select class="form-control" name="levellogin2">
        <!--<option value="0">����� </option>-->
        <option value="1">������ ����� � ���� </option>
        <option value="2">������ ���� ����� ������ </option>
        <option value="3">������ ����� ������ </option>
        <option value="4">�� ������ ���� ����� ��� �� ������� </option>
        <option value="5">�� ������ ���� ����� ��� �� ������� </option>
        <option value="6">��� ������� +/- 1 </option>
        <option value="99">������ ���� </option>
      </select>
      </span>
      <br />
<!--       <input type="checkbox" name="k" value="1" />
      �������� ���<br /> -->
      <input type="checkbox" name="travma" />
      ��� ��� ������ (<font class="dsc">����������� ������� �������� ������������</font>)<br />
      <input type="checkbox" name="mut_clever" />
      ����������� ���� (<font class="dsc">����������� ���� ��� ��������� ����������</font>)<br />
      <?
		if( date('m') == 12 || date('m') == 1 || date('m') == 2 || $u->info['admin'] > 0 ) {
			//���������
			echo '<INPUT type="checkbox" name="otmorozok"> <img src="http://img.likebk.com/snow.gif" width="12" height="12"> ��� � ����������� (�� ��������� ������� ��������� ���������)<BR>';	
		}
	  ?>
      <!-- ��� �� <b>������</b>, ������: 
      <?
      // if($u->info['money3'] > 1) {
      //   echo '<input type="text" name="art_money3" autocomplete="off" size="3" /><br />';
      // } elseif($u->info['level'] < 4) {
      //   echo '<i style="color: Red;">��� �� ������ ���������� � 4 ������.</i><br />';
      // } else {
      //   echo '<i style="color: Red;">� ���, ������������ ������.</i><br />';
      // }
      ?> -->
      ����������� � ���
      <span class="spn_in" style="width: 275px; display: inline-block;">
        <input class="form-control"s type="text" name="cmt" maxlength="40" size="40" />
      </span>
    </td>
  </tr>
  <tr>
    <td><input class="btnnew" style="margin-top: 10px; padding-top:3px; padding-bottom: 3px;" type="submit" value="������ ��������! :)" name="open" />
    </td>
  </tr>
</table>
</form>
<?
  }
}
if(isset($_POST['btl_go'])) {
  $zv->go($_POST['btl_go']);
} elseif(isset($_GET['btl_go'])) {
  $zv->go($_GET['btl_go']);
}
if(($_GET['r'] == 5 || $_GET['r'] == 10)  && ($u->info['room'] == 4 || $u->info['room'] == 16 || $u->info['room'] == 375 || $u->info['room'] == 376) && $u->info['level']>7){
echo '<div style="margin:3px; margin-top: 10px; margin-bottom: 0px;float: right; display: inline;">
  <form action="" method="post">
    <label style="display: inline-block; font-weight: normal;">';
  if($_COOKIE["mylvl_cookie"] == 1){
      echo '<INPUT checked type="checkbox" id="mylvl" name="mylvl">';
  }else{
      echo '<INPUT type="checkbox" id="mylvl" name="mylvl">';
  }
    echo '�������� ������ ����� ������</label>';
echo '</form></div>';
echo '<span class="txt_haot"><!--��������� ��� - ������������� ����������, ��� ������ ����������� �������������. ��� �������� � ������, ���� ��������� ������ 4-� �������.--></span>
          <!-- ���-�� � ��������� ���� �������� ���������� <b>��������������</b> <a href="http://events.likebk.com/?page_id=1&paged=&st=25" target="_blank">���������</a>.<br> -->
              <INPUT onclick="$(\'#haot\').toggle(\'slow\'); return false;" TYPE=button name=tmp value="������ ������ �� ��������� ���" class="btnnew" style="margin:3px; margin-top: 10px; margin-bottom: 0px;">
              <form action="main.php?zayvka=1&r='.$_GET['r'].'&start_haot&rnd='.$code.'" method="post" style="margin:0px; padding:0px; margin-left: 15px;">
              <div style="display:none;" id="haot">
                      <FIELDSET>
                      <LEGEND><h3 class="h3_haot" style="">������ ������ �� ��������� ���</h3> </LEGEND>
                      ������ ���   �����
                      <span style="width: 120px; display: inline-block;">
                        <SELECT class="form-control" name="startime2">
                        <OPTION selected value="180">3 �����
                          <OPTION value="300">5 �����
                          <OPTION value="600">10 �����
                          <OPTION value="900">15 �����
                          <OPTION value="1200">20 �����
                          <OPTION value="1800">30 �����</OPTION>
                        </SELECT>
                      </span>
                      �������:
                      <span style="width: 120px; display: inline-block;">
                        <SELECT class="form-control" name="timeout">
                          <OPTION selected value="1">1 ���.
                          <OPTION value="2">2 ���.
                          <OPTION value="3">3 ���.
                          <OPTION value="4">4 ���.
                          <OPTION value="5">5 ���.</OPTION>
                        </SELECT>
                      </span>
                      �������:
                      <span style="width: 50px; display: inline-block;">
                        <SELECT class="form-control" name="countTm1max">
                          <OPTION selected value="6">6
                          <OPTION value="8">8
                          <OPTION value="10">10
                          <OPTION value="12">12
                          <OPTION value="14">14
                          <OPTION value="16">16
                          <OPTION value="18">18
                          <OPTION value="20">20</OPTION>
                        </SELECT>
                      </span>
                      <br>
                      ������ ������:   
                      <span style="width: 180px; display: inline-block;">
                        <SELECT class="form-control" name="levellogin1">
                          <!-- <OPTION value="0">����� -->
                          ';
                         if( $u->info['level'] < 13 ) {
							 echo '<OPTION selected value="3">������ �����   ������';
						 }
					 // if( $u->info['level'] < 13 ) {
					  	echo ' <OPTION value="6">��� ������� +/- 1</OPTION>';
					  //}
					  echo '  </SELECT>
                      </span>'.
                      // ��� ���:
                      // <span style="width: 120px; display: inline-block;">
                      //   <SELECT class="form-control" name="k">
                      //     <OPTION selected value="0">� �������
                      //     <OPTION value="1">��������</OPTION>
                      //   </SELECT>
                      // </span>
                      '<br>
                      <INPUT type="checkbox" name="travma">
                      ��� ���   ������ (����������� ������� ��������   ������������)<br>'.
                      //<INPUT type="checkbox" name="mut_clever">
                      //����������� ����   (����������� ���� ��� ��������� ����������)<BR>
                      //
                      '<INPUT checked type="checkbox" name="noeff">
                      ��� ��� ������� ������� HP, ������������ � �������������� MP<br>
                      <INPUT checked type="checkbox" name="noatack">
                      �������� �������� (� �������� ���������� ���������)<br>
                      <INPUT type="checkbox" name="arand">
                      ������ ������ (��������� ��������� ������������� �������)<br>';
      
						if( date('m') == 12 || date('m') == 1 || date('m') == 2 || $u->info['admin'] > 0 ) {
							//���������
							echo '<INPUT type="checkbox" name="otmorozok"> <img src="http://img.likebk.com/snow.gif" width="12" height="12"> ��� � ����������� (�� ��������� ������� ��������� ���������)<BR>';	
						}
	 
                      //<INPUT type="checkbox" name="kingfight">
                      //�������� �������� (<b>�� ��������� � ������� ���������</b>)<BR>
                      //<INPUT type="checkbox" name="nobot">
                      //�������� ��� �����<BR>
                      //<INPUT type="checkbox" name="fastfight">
                      //������� �������� (��� ������ �������� ��������� ������� ��� ������)<BR>
                      //';
                      if($u->info['level'] >= 12){
                        echo '<INPUT type="checkbox" name="noart">�������� ��� ����������<BR>';
                      }
                      if( $u->info['no_zv_key'] != true ) { 
                        echo '<img src="http://likebk.com/show_reg_img/security2.php?id='.time().'" width="70" height="20"> ��� �������������: <input style="width:40px;" type="text" value="" name="code21">';
                      }
                      //echo '<INPUT type="checkbox" name="mut_hidden">
                      //��������� ��� (�� �����   ����������� �� � ������, �� � ���. +5% �����)<br>
                      //����������� � ���
                      //<span style="width: 300px; display: inline-block;">
                      //<INPUT  class="form-control" maxLength="40" size="40" name="cmt"></span><br>'.
                                            //��� �� ������, ������: '.$mn.'
                      echo '<INPUT class="btnnew" style="margin-top: 5px;" value="������ ������" type="submit" name="open">
                      </FIELDSET>
                    </DIV>
              </div></form>';
}?>
<script>
  $("#mylvl").change(function(){
    var rnd = "<? echo $code; ?>";
      if(this.checked) {  
        //alert("test");
        set_cookie ( "mylvl_cookie", "1" );
        $.get("/getzv.php",
          {
            "r": 5,
            "mylvl": 1,
          }, function(html) {
            $("#tmstart").html(html);
          })
      } else {
         //alert("no");
         delete_cookie ( "mylvl_cookie", "0" );
       $.get("/getzv.php",
        {
          "r": 5,
          "mylvl": 0,
        }, function(html) {
          $("#tmstart").html(html);
        })
      }
  });
</script>
<?php echo '<div id="tmstart" style="margin-left: 10px;">';
if($zv->error != '') {
  echo '<font color="red"><b>'.$zv->error.'</b></font><br />';
}

if($test_s != '') {
  echo '<font color="red"><b>'.$test_s.'</b></font><br />';
}
?>

<table style="padding:2px;" width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td><? echo $zv->see(); ?></td>
  </tr>
  <tr>
    <td><? $zv->seeZv(); ?>
    </td>
  </tr>
</table><br />
</div>
      <?php if($_GET['r'] == 5 || $_GET['r'] == 10){?>
      <script>
        function update() {
          var mylvl;
          if($("#mylvl").is(":checked")) {
            mylvl = 1;
          }
          else{
            mylvl = 0;
          }
          $.get("/getzv.php",
          {
            "r": <?=$_GET['r']?>,
			"new": 1,
            "mylvl": mylvl,
          }, function(html) {
            $("#tmstart").html(html);
          })
        }
        setInterval(update, 45000);
      </script>
    <?php } ?>
<div align="right">
<? echo $c['counters']; ?>
</div>
<div id="update"></div>
<script type="text/javascript">
$(".newgroup").click(function(){
    // ���������� ������� ���� 
    $(".zv_form").toggle("slow"); 
  });  
</script>