<?php
if(!defined('GAME')) { die(); }

if($_GET['go_away']) { header('location: main.php'); die(); }
if($u->info['battle'] != 0) { header('location: main.php'); die(); }

if(isset($_POST['clip76_'])) {
  $obj = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "4677" LIMIT 1'));
  if($u->count_items(877, $u->info['id'], 1) > 0) {
    if($u->count_items(882, $u->info['id'], 1) > 0) {
      if($u->count_items(902, $u->info['id'], 1) > 0) {
        if($u->count_items(903, $u->info['id'], 1) > 0) {
          if($u->count_items(881, $u->info['id'], 1) > 0) {
            if($u->count_items(878, $u->info['id'], 1) > 0) {
                $data = '|frompisher=12';
                $u->addItem(4677, $u->info['id'], $data, $obj);
                $u->deleteItemID(877, $u->info['id'], 1);
                $u->deleteItemID(882, $u->info['id'], 1);
                $u->deleteItemID(902, $u->info['id'], 1);
                $u->deleteItemID(903, $u->info['id'], 1);
                $u->deleteItemID(881, $u->info['id'], 1);
                $u->deleteItemID(878, $u->info['id'], 1);
                $err = '�� �������� ������ �����';
            } else {
              $err = "�� ������� �������� &quot;�������� �����&quot;"; 
            }
          } else {
            $err = "�� ������� �������� &quot;�������� �����&quot;"; 
          }
        } else {
          $err = "�� ������� �������� &quot;������������ ������&quot;"; 
        }
      } else {
        $err = "�� ������� �������� &quot;���� �������� ������&quot;"; 
      }
    } else {
      $err = "�� ������� �������� &quot;��������� ������&quot;"; 
    }
  } else {
    $err = "�� ������� �������� &quot;�����&quot;";
  }
} elseif(isset($_POST['clip80_'])) {
  $obj = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "4678" LIMIT 1'));
  if($u->count_items(895, $u->info['id'], 1) > 0) {
    if($u->count_items(889, $u->info['id'], 1) > 2) {
      if($u->count_items(906, $u->info['id'], 1) > 0) {
        if($u->count_items(908, $u->info['id'], 1) > 0) {
          if($u->count_items(888, $u->info['id'], 1) > 0) {
            if($u->count_items(909, $u->info['id'], 1) > 0) {
              if($u->count_items(905, $u->info['id'], 1) > 0) {
                $data = '|frompisher=12';
                $u->addItem(4678, $u->info['id'], $data, $obj);
                $u->deleteItemID(895, $u->info['id'], 1);
                $u->deleteItemID(889, $u->info['id'], 3);
                $u->deleteItemID(906, $u->info['id'], 1);
                $u->deleteItemID(908, $u->info['id'], 1);
                $u->deleteItemID(888, $u->info['id'], 1);
                $u->deleteItemID(909, $u->info['id'], 1);
                $u->deleteItemID(905, $u->info['id'], 1);
                $err = '�� �������� ������� �����';
              } else {
                $err = "�� ������� �������� &quot;���������&quot;"; 
              }
            } else {
              $err = "�� ������� �������� &quot;�������� ���������� �����&quot;"; 
            }
          } else {
            $err = "�� ������� �������� &quot;����� ���&quot;"; 
          }
        } else {
          $err = "�� ������� �������� &quot;������ ���������� ������&quot;"; 
        }
      } else {
        $err = "�� ������� �������� &quot;�������� ������ �������&quot;"; 
      }
    } else {
      $err = "�� ������� �������� &quot;������� �����&quot;"; 
    }
  } else {
    $err = "�� ������� �������� &quot;�������� �������&quot;";
  }
} elseif(isset($_POST['clip81_'])) {
  $obj = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "4679" LIMIT 1'));
  if($u->count_items(906, $u->info['id'], 1) > 0) {
    if($u->count_items(907, $u->info['id'], 1) > 0) {
      $data = '|frompisher=12';
      $u->addItem(4679, $u->info['id'], $data, $obj);
      $u->deleteItemID(906, $u->info['id'], 1);
      $u->deleteItemID(907, $u->info['id'], 1);
      $err = '�� �������� ��������� ��������� �����';
    } else {
      $err = "�� ������� �������� &quot;�������� ������������&quot;";
    }
  } else {
    $err = "�� ������� �������� &quot;�������� ������ �������&quot;";
  }
} elseif(isset($_POST['clip82_'])) {
  $obj = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "4680" LIMIT 1'));
  if($u->count_items(877, $u->info['id'], 1) > 0) {
    if($u->count_items(890, $u->info['id'], 1) > 0) {
      if($u->count_items(902, $u->info['id'], 1) > 0) {
        if($u->count_items(903, $u->info['id'], 1) > 0) {
          if($u->count_items(888, $u->info['id'], 1) > 0) {
            $data = '|frompisher=12';
            $u->addItem(4680, $u->info['id'], $data, $obj);
            $u->deleteItemID(877, $u->info['id'], 1);
            $u->deleteItemID(890, $u->info['id'], 1);
            $u->deleteItemID(902, $u->info['id'], 1);
            $u->deleteItemID(903, $u->info['id'], 1);
            $u->deleteItemID(888, $u->info['id'], 1);
            $err = '�� �������� ��������� ���������� �����';
          } else {
            $err = "�� ������� �������� &quot;����� ���&quot;"; 
          }
        } else {
          $err = "�� ������� �������� &quot;������������ ������&quot;"; 
        }
      } else {
        $err = "�� ������� �������� &quot;���� �������� ������&quot;"; 
      }
    } else {
      $err = "�� ������� �������� &quot;������� �������&quot;"; 
    }
  } else {
    $err = "�� ������� �������� &quot;�����&quot;";
  }
} elseif(isset($_POST['clip89_'])) {
  $obj = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "4681" LIMIT 1'));
  if($u->count_items(900, $u->info['id'], 1) > 0) {
    if($u->count_items(882, $u->info['id'], 1) > 0) {
      if($u->count_items(903, $u->info['id'], 1) > 0) {
        if($u->count_items(904, $u->info['id'], 1) > 0) {
          if($u->count_items(908, $u->info['id'], 1) > 0) {
            $data = '|frompisher=12';
            $u->addItem(4681, $u->info['id'], $data, $obj);
            $u->deleteItemID(900, $u->info['id'], 1);
            $u->deleteItemID(882, $u->info['id'], 1);
            $u->deleteItemID(903, $u->info['id'], 1);
            $u->deleteItemID(904, $u->info['id'], 1);
            $u->deleteItemID(908, $u->info['id'], 1);
            $err = '�� �������� ��������� ����������� ����';
          } else {
            $err = "�� ������� �������� &quot;������ ���������� ������&quot;"; 
          }
        } else {
          $err = "�� ������� �������� &quot;�������� ������&quot;"; 
        }
      } else {
        $err = "�� ������� �������� &quot;������������ ������&quot;"; 
      }
    } else {
      $err = "�� ������� �������� &quot;��������� ������&quot;"; 
    }
  } else {
    $err = "�� ������� �������� &quot;���� �������� ������&quot;";
  }
} elseif(isset($_POST['clip90_'])) {
  $obj = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "4682" LIMIT 1'));
  if($u->count_items(950, $u->info['id'], 1) > 0) {
    if($u->count_items(889, $u->info['id'], 1) > 0) {
      if($u->count_items(902, $u->info['id'], 1) > 0) {
        if($u->count_items(903, $u->info['id'], 1) > 0) {
          if($u->count_items(878, $u->info['id'], 1) > 0) {
            $data = '|frompisher=12';
            $u->addItem(4682, $u->info['id'], $data, $obj);
            $u->deleteItemID(950, $u->info['id'], 1);
            $u->deleteItemID(889, $u->info['id'], 1);
            $u->deleteItemID(902, $u->info['id'], 1);
            $u->deleteItemID(906, $u->info['id'], 1);
            $u->deleteItemID(878, $u->info['id'], 1);
            $err = '�� �������� ��������� ���������� ����';
          } else {
            $err = "�� ������� �������� &quot;�������� �����&quot;"; 
          }
        } else {
          $err = "�� ������� �������� &quot;������������ ������&quot;"; 
        }
      } else {
        $err = "�� ������� �������� &quot;���� �������� ������&quot;"; 
      }
    } else {
      $err = "�� ������� �������� &quot;������� �����&quot;"; 
    }
  } else {
    $err = "�� ������� �������� &quot;���� ������ �����&quot;";
  }
} elseif(isset($_POST['clip91_'])) {
  $obj = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "4683" LIMIT 1'));
  if($u->count_items(907, $u->info['id'], 1) > 0) {
    if($u->count_items(881, $u->info['id'], 1) > 0) {
      if($u->count_items(905, $u->info['id'], 1) > 0) {
        $data = '|frompisher=12';
        $u->addItem(4683, $u->info['id'], $data, $obj);
        $u->deleteItemID(907, $u->info['id'], 1);
        $u->deleteItemID(881, $u->info['id'], 1);
        $u->deleteItemID(905, $u->info['id'], 1);
        $err = '�� �������� ��������� ������� ���������';
      } else {
        $err = "�� ������� �������� &quot;���������&quot;";
      }
    } else {
      $err = "�� ������� �������� &quot;�������� �����&quot;";
    }
  } else {
    $err = "�� ������� �������� &quot;�������� ������������&quot;";
  }
} elseif(isset($_POST['clip92_'])) {
  $obj = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "4684" LIMIT 1'));
  if($u->count_items(907, $u->info['id'], 1) > 0) {
    if($u->count_items(881, $u->info['id'], 1) > 0) {
      if($u->count_items(905, $u->info['id'], 1) > 0) {
        $data = '|frompisher=12';
        $u->addItem(4684, $u->info['id'], $data, $obj);
        $u->deleteItemID(907, $u->info['id'], 1);
        $u->deleteItemID(881, $u->info['id'], 1);
        $u->deleteItemID(905, $u->info['id'], 1);
        $err = '�� �������� ��������� ����������';
      } else {
        $err = "�� ������� �������� &quot;���������&quot;";
      }
    } else {
      $err = "�� ������� �������� &quot;�������� �����&quot;";
    }
  } else {
    $err = "�� ������� �������� &quot;�������� ������������&quot;";
  }
} elseif(isset($_POST['clip93_'])) {
  $obj = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "4685" LIMIT 1'));
  if($u->count_items(901, $u->info['id'], 1) > 0) {
    if($u->count_items(889, $u->info['id'], 1) > 0) {
      if($u->count_items(890, $u->info['id'], 1) > 0) {
        $data = '|frompisher=12';
        $u->addItem(4685, $u->info['id'], $data, $obj);
        $u->deleteItemID(901, $u->info['id'], 1);
        $u->deleteItemID(889, $u->info['id'], 1);
        $u->deleteItemID(890, $u->info['id'], 1);
        $err = '�� �������� ���������� ������: ����������� ���� [1]';
      } else {
        $err = "�� ������� �������� &quot;������� �������&quot;";
      }
    } else {
      $err = "�� ������� �������� &quot;������� �����&quot;";
    }
  } else {
    $err = "�� ������� �������� &quot;�������� ������ �������&quot;";
  }
} elseif(isset($_POST['clip94_'])) {
  $obj = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "4686" LIMIT 1'));
  if($u->count_items(4685, $u->info['id'], 1) > 0) {
    if($u->count_items(4688, $u->info['id'], 1) > 0) {
      if($u->count_items(4689, $u->info['id'], 1) > 0) {
        if($u->count_items(4690, $u->info['id'], 1) > 0) {
          $data = '|frompisher=12';
          $u->addItem(4686, $u->info['id'], $data, $obj);
          $u->deleteItemID(4685, $u->info['id'], 1);
          $u->deleteItemID(4688, $u->info['id'], 1);
          $u->deleteItemID(4689, $u->info['id'], 1);
          $u->deleteItemID(4690, $u->info['id'], 1);
          $err = '�� �������� ���������� ������: ����������� ���� [2]';
        } else {
          $err = "�� ������� �������� &quot;���������� ��� �������&quot;";
        }
      } else {
        $err = "�� ������� �������� &quot;������ ��� �������&quot;";
      }
    } else {
      $err = "�� ������� �������� &quot;������� ��� �������&quot;";
    }
  } else {
    $err = "�� ������� �������� &quot;���������� ������: ����������� ���� [1]&quot;";
  }
}


function getColor($id, $num) {
  global $u;
  $color = 'green';
  $ch = mysql_query("SELECT `id` FROM `items_users` WHERE `uid` = ".$u->info['id']." AND `delete` = 0 AND `item_id` = ".(int)$id." AND inShop = 0 AND inOdet = 0");
  if(mysql_num_rows($ch) < $num) { $color = 'red'; }
  return $color;
}

function getImg($id, $num) {
  global $u;
  $img = 'good.png';
  $ch = mysql_query("SELECT `id` FROM `items_users` WHERE `uid` = ".$u->info['id']." AND `delete` = 0 AND `item_id` = ".(int)$id." AND inShop = 0 AND inOdet = 0");
  if(mysql_num_rows($ch) < $num) { $img = 'i/clear.gif'; }
  return $img;
}

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="http://img.likebk.com/css/main.css" />
<meta content="text/html; charset=windows-1251" http-equiv="Content-type" />
<meta http-equiv="Cache-Control" content="no-cache, max-age=0, must-revalidate, no-store" />
<meta http-equiv="PRAGMA" content="NO-CACHE" />
<meta http-equiv="Expires" content="0" />
<style>
.row { cursor:pointer; }      
#answer1 {color: #003388; font-weight: bold; text-decoration: none; }
</style>
<script type="text/javascript">
function show(ele) {
  var srcElement = document.getElementById(ele);
  if(srcElement != null) {
    if(srcElement.style.display == "block") {
      srcElement.style.display= 'none';
    } else {
      srcElement.style.display='block';
    }
  }
}

function OpenDiv(vr) {
  var dg01 = document.getElementById(vr);
  if(dg01.style.display == '') {
    dg01.style.display = 'none'
  } else {
    dg01.style.display = ''
  }
}
</script>
<script type="text/javascript" src="http://img.likebk.com/js/inf.0.104.js?<?=mt_rand(1436,1293286936)/10000000000?>" charset="utf-8"></script>
</head>
<body leftmargin=5 topmargin=5 marginwidth=5 marginheight=5  bgcolor="#d7d7d7" onLoad="">
<div id=hint4 class=ahint></div>
<TABLE cellspacing=0 cellpadding=2 width=100%>
<TD style="width: 40%; vertical-align: top; ">
<TABLE cellspacing=0 cellpadding=2 style="width: 100%; ">
<tr><TD align=center><h4>���������� ������� ��������</h4></TD></tr>
<TR>
</TABLE>
</TD>
<TD style="width: 5%; vertical-align: top; ">&nbsp;</TD>
</TR>
</TABLE>
</html>
<? if($err != '') { echo "<center><b style='color: Red;'>".$err."</b></center>"; } ?>
<table width="100%">
<tr>
<td width="255" valign="top"><div align="left"><? $st = array(); $st2 = array(); $st = $u->getStats($u->info['id'],1); $st2 = $st[1]; $st = $st[0]; $rgd = $u->regen($u->info['id'],$st,1); $us = $u->getInfoPers($u->info['id'],1,$st); if($us!=false){ echo $us[0]; }else{ echo 'information is lost.'; } ?></div>
<div align="left"></div><div align="left"></div>
<div style="float: left">
<td valign="top"><br />
<div id="step1" style="margin-left: 20px;"></div>
<br /><br />
<table>
<tr>
<td>
<div id="answer1">
� <a href="#" onclick="OpenDiv('clip76')">������ �����</a><br />
<div id="clip76" style="display: none; color: black;">
 <p style="color:<?=getColor(877, 1)?>"> C���� <img src="http://img.likebk.com/<?=getImg(877, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(882, 1)?>"> ��������� ������ <img src="http://img.likebk.com/<?=getImg(882, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(902, 1)?>"> ���� �������� ������ <img src="http://img.likebk.com/<?=getImg(902, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(903, 1)?>"> ������������ ������ <img src="http://img.likebk.com/<?=getImg(903, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(881, 1)?>"> �������� ����� <img src="http://img.likebk.com/<?=getImg(881, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(878, 1)?>"> �������� ����� <img src="http://img.likebk.com/<?=getImg(878, 1)?>" width="13" height="13" /></p>
<form action="" method="POST">
<input type="submit" name="clip76_" value="�������" />
</form>
</div>
    
� <a href="#" onclick="OpenDiv('clip80')">������� �����</a><br />
<div id="clip80" style="display: none; color: black;">
 <p style="color:<?=getColor(895, 1)?>"> �������� ������� <img src="http://img.likebk.com/<?=getImg(895, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(889, 3)?>"> ������� ����� (3 ��.) <img src="http://img.likebk.com/<?=getImg(889, 3)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(906, 1)?>"> �������� ������ ������� <img src="http://img.likebk.com/<?=getImg(906, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(908, 1)?>"> ������ ���������� ������ <img src="http://img.likebk.com/<?=getImg(908, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(888, 1)?>"> ����� ��� <img src="http://img.likebk.com/<?=getImg(888, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(909, 1)?>"> �������� ���������� ����� <img src="http://img.likebk.com/<?=getImg(909, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(905, 1)?>"> ��������� <img src="http://img.likebk.com/<?=getImg(905, 1)?>" width="13" height="13" /></p>
<form action="" method="POST">
<input type="submit" name="clip80_" value="�������" />
</form>
</div>

� <a href="#" onclick="OpenDiv('clip81')">��������� ��������� �����</a><br />
<div id="clip81"  style="display: none; color: black;">
 <p style="color:<?=getColor(906, 1)?>"> �������� ������ ������� <img src="http://img.likebk.com/<?=getImg(906, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(907, 1)?>"> �������� ������������ <img src="http://img.likebk.com/<?=getImg(907, 1)?>" width="13" height="13" /></p>
<form action="" method="POST">
<input type="submit" name="clip81_" value="�������" />
</form>
</div>

� <a href="#" onclick="OpenDiv('clip82')">��������� ���������� �����</a><br />
<div id="clip82" style="display: none; color: black;">
 <p style="color:<?=getColor(877, 1)?>"> ����� <img src="http://img.likebk.com/<?=getImg(877, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(890, 1)?>"> ������� ������� <img src="http://img.likebk.com/<?=getImg(890, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(902, 1)?>"> ���� �������� ������ <img src="http://img.likebk.com/<?=getImg(902, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(903, 1)?>"> ������������ ������ <img src="http://img.likebk.com/<?=getImg(903, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(888, 1)?>"> ����� ��� <img src="http://img.likebk.com/<?=getImg(888, 1)?>" width="13" height="13" /></p>
<form action="" method="POST">
<input type="submit" name="clip82_" value="�������" />
</form>
</div>

� <a href="#" onclick="OpenDiv('clip89')">��������� ����������� ����</a><br />
<div id="clip89" style="display: none; color: black;">
 <p style="color:<?=getColor(900, 1)?>"> ���� �������� ������ <img src="http://img.likebk.com/<?=getImg(900, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(882, 1)?>"> ��������� ������ <img src="http://img.likebk.com/<?=getImg(882, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(903, 1)?>"> ������������ ������ <img src="http://img.likebk.com/<?=getImg(903, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(904, 1)?>"> �������� ������ <img src="http://img.likebk.com/<?=getImg(904, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(908, 1)?>"> ������ ���������� ������ <img src="http://img.likebk.com/<?=getImg(908, 1)?>" width="13" height="13" /></p>
<form action="" method="POST">
 <input type="submit" name="clip89_" value="�������" />
</form>
</div>

� <a href="#" onclick="OpenDiv('clip90')">��������� ���������� ����</a><br />
<div id="clip90" style="display: none; color: black;">
 <p style="color:<?=getColor(950, 1)?>"> ���� ������ ����� <img src="http://img.likebk.com/<?=getImg(950, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(889, 1)?>"> ������� ����� <img src="http://img.likebk.com/<?=getImg(889, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(902, 1)?>"> ���� �������� ������ <img src="http://img.likebk.com/<?=getImg(902, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(903, 1)?>"> ������������ ������ <img src="http://img.likebk.com/<?=getImg(903, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(878, 1)?>"> �������� ����� <img src="http://img.likebk.com/<?=getImg(878, 1)?>" width="13" height="13" /></p>
<form action="" method="POST">
<input type="submit" name="clip90_" value="�������" />
</form>
</div>

� <a href="#" onclick="OpenDiv('clip91')">��������� ������� ���������</a><br />
<div id="clip91" style="display: none; color: black;">
 <p style="color:<?=getColor(907, 1)?>"> �������� ������������ <img src="http://img.likebk.com/<?=getImg(907, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(881, 1)?>"> �������� ����� <img src="http://img.likebk.com/<?=getImg(881, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(905, 1)?>"> ��������� <img src="http://img.likebk.com/<?=getImg(905, 1)?>" width="13" height="13" /></p>
<form action="" method="POST">
<input type="submit" name="clip91_" value="�������" />
</form>
</div>


� <a href="#" onclick="OpenDiv('clip92')">��������� ����������</a><br />
<div id="clip92" style="display: none; color: black;">
 <p style="color:<?=getColor(907, 1)?>"> �������� ������������ <img src="http://img.likebk.com/<?=getImg(907, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(881, 1)?>"> �������� ����� <img src="http://img.likebk.com/<?=getImg(881, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(905, 1)?>"> ��������� <img src="http://img.likebk.com/<?=getImg(905, 1)?>" width="13" height="13" /></p>
<form action="" method="POST">
<input type="submit" name="clip92_" value="�������" />
</form>
</div>


� <a href="#" onclick="OpenDiv('clip93')">���������� ������: ����������� ���� [1]</a><br />
<div id="clip93" style="display: none; color: black;">
 <p style="color:<?=getColor(901, 1)?>"> �������� ������ ������� <img src="http://img.likebk.com/<?=getImg(901, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(889, 1)?>"> ������� ����� <img src="http://img.likebk.com/<?=getImg(889, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(890, 1)?>"> ������� ������� <img src="http://img.likebk.com/<?=getImg(890, 1)?>" width="13" height="13" /></p>
<form action="" method="POST">
<input type="submit" name="clip93_" value="�������" />
</form>
</div>


� <a href="#" onclick="OpenDiv('clip94')">���������� ������: ����������� ���� [2]</a><br />
<div id="clip94" style="display: none; color: black;">
 <p style="color:<?=getColor(4685, 1)?>"> ���������� ������: ����������� ���� [1] <img src="http://img.likebk.com/<?=getImg(4685, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(4688, 1)?>"> ������� ��� ������� <img src="http://img.likebk.com/<?=getImg(4688, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(4689, 1)?>"> ������ ��� ������� <img src="http://img.likebk.com/<?=getImg(4689, 1)?>" width="13" height="13" /></p>
 <p style="color:<?=getColor(4690, 1)?>"> ���������� ��� ������� <img src="http://img.likebk.com/<?=getImg(4690, 1)?>" width="13" height="13" /></p>
<form action="" method="POST">
<input type="submit" name="clip94_" value="�������" />
</form>
</div>
    
� <a href="?go_away=1">����. (�����)</a>

</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </div>
            <div style="float:left">

                <td  width="120">
                    <table width="100" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <TABLE  border=0 cellSpacing=1 cellPadding=0 width="100%">
                                    <TBODY>
                                    <TR vAlign=top>
                                        <TD>
                                            <TABLE border=0 cellSpacing=0 cellPadding=0 width="100%">
                                                <TBODY>
                                                </TBODY></TABLE></TD>
                                        <TD><TABLE border=0 cellSpacing=0 cellPadding=0 width="100%"><TBODY>

                                        </TBODY></TABLE></TD></TR></TBODY></TABLE></TD>
                            </td>
                        </tr>
                    </table>
                </td>

</tr>
</table>
</div>
<TABLE width=100% align="right">
    <tr><td>
        <br />
        <br />
        <br />

    </TD></tr>
</TABLE>
</body>
</html>