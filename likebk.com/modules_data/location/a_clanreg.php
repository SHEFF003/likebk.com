<?
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='a_clanreg')
{
// ����� �������� ������ 
 
class upload {
 
protected function __construct() { }
 
static $save_path = 'clan_prw/';
static $error = '';
 
static function saveimg($name,$max_mb = 2,$exts = 'jpg|png|jpeg|gif',$cnm = '') {
    if (isset($_FILES[$name])) {
        $f = &$_FILES[$name];
        if (($f['size'] <= $max_mb*1024*1024) && ($f['size'] > 0)) {
            if (
                (preg_match('/\.('.$exts.')$/i',$f['name'],$ext))&&
                (preg_match('/image/i',$f['type']))
            ) {

				$ext[1] = strtolower($ext[1]);
                $fn = uniqid('f_',true).'.'.$ext[1];
                //$fn2 = uniqid('f_',true).'.gif';
                if (move_uploaded_file($f['tmp_name'], self::$save_path . $fn)) {
                    // ������� ��������� ������� , ��������� Rimage
                    //Rimage::resize(self::$save_path . $fn, self::$save_path . $fn2);
                    //@unlink(self::$save_path . $fn); // �������� �����
                    return array($fn, $fn);
                } else {
                    self::$error = '������ �������� �����';
                }
            } else {
                self::$error = '�������� ��� �����. ���������� ���� : <b>'.$exts.'</b>';
            }
        } else {
            self::$error = '�������� ������ �����. ������������ ������ ����� <b>'.$max_mb.' ��</b>';
        }
    } else {
        self::$error = '���� �� ������';
    }
    return false;
} // end saveimg
 
} // end class

$lzv = mysql_fetch_array(mysql_query('SELECT * FROM `_clan` WHERE `uid` = "'.$u->info['id'].'" AND `admin_time` = "0" LIMIT 1'));
$clan_invit = mysql_fetch_array(mysql_query('SELECT * FROM `clan_invit` WHERE `uid`="'.$u->info['id'].'"'));
$claninf = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$clan_invit['clan_id'].'"'));
$user_invit = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$clan_invit['id_invit'].'"'));
if(isset($_GET['no_invit']) && $_GET['no_invit'] == 1 && $u->info['align'] != 2){
	$ms = "�� �������� � ������ �� ���������� � ���� <font color=#003388><b>".$claninf['name']."</b></font>";
  	mysql_query('DELETE FROM `clan_invit` WHERE `uid` = "'.$clan_invit['uid'].'"');
  	$txt2 = '����� <font color=#003388><b>&quot;'.$u->info['login'].'&quot;</b></font> ������� ���� ����������� �� ���������� � ����.<br>'; 
    mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
          '1',
          '".$user_invit['city']."',
          '".$user_invit['room']."',
          '',
          '".$user_invit['login']."',
          '".$txt2."',
          '-1',
          '6',
          '0')");
    unset($_GET);
  header('location: main.php');
}elseif($u->testAlign($u->info['id'],$claninf['align']) != false && $u->info['align'] != 2) {
	echo '<font color="#FF0000"><b>� ��������� �������� �� ����� ���������� ��� '.$u->timeOut($u->testAlign($u->info['id'],$claninf['align'])-time()).'.</b></font><br>';
}elseif($u->testClan($u->info['id'],$claninf['id']) != false && $u->info['align'] != 2) {
	echo '<font color="#FF0000"><b>� ��������� �������� �� ����� � ����� ��� '.$u->timeOut($u->testClan($u->info['id'],$claninf['id'])-time()).'.</b></font><br>';
}elseif(isset($_GET['yes_invit']) && $_GET['yes_invit'] == 1 && $u->info['align'] != 2){
	//
	$cwar = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `clan_wars` WHERE (`clan1` = "'.$clan_invit['clan_id'].'" OR `clan2` = "'.$clan_invit['clan_id'].'") AND `time_finish` > "'.time().'" LIMIT 1'));
	$cwar[0] = 0;
	if( $cwar[0] > 0 ) {
		$txt2 = '����� <font color=#003388>������ �������� � ���� ���� ���� �����!</font><br>'; 
	}elseif( $u->testClan($u->info['id'],$claninf['id']) == false && $u->testAlign($u->info['id'],$claninf['align']) == false ) {
		$u->addAlignClan($u->info['id'],$claninf['align'],$claninf['clan']);
		//
		$upd = mysql_query('UPDATE `users` SET `palpro` = "0",`clan_prava` = "2",`clan` = "'.$clan_invit['clan_id'].'",`mod_zvanie` = "",`align` = "'.$clan_invit['align'].'" WHERE `id` = "'.$clan_invit['uid'].'" LIMIT 1');
		mysql_query('UPDATE `users` SET `money` = `money` - "'.$clan_invit['money'].'" WHERE `id` = "'.$clan_invit['id_invit'].'" LIMIT 1');
		$txt2 = '����� <font color=#003388><b>&quot;'.$u->info['login'].'&quot;</b></font> ������ ���� ����������� �� ���������� � ����. � ��� ������� <font color=#003388><b>'.$clan_invit['money'].' ��.</b></font><br>'; 
		mysql_query("INSERT INTO `chat` (`new`,`city`,`room`,`login`,`to`,`text`,`time`,`type`,`toChat`) VALUES (
			  '1',
			  '".$user_invit['city']."',
			  '".$user_invit['room']."',
			  '',
			  '".$user_invit['login']."',
			  '".$txt2."',
			  '-1',
			  '6',
			  '0')");
		$txt = '����� <img src="http://img.likebk.com/i/align/align'.$user_invit['align'].'.gif" style="vertical-align:bottom">
		<img src="http://img.likebk.com/i/clan/'.$claninf['name'].'.gif" style="vertical-align:bottom">
		<a href="javascript:void(0)">'.$user_invit['login'].'</a>['.$user_invit['level'].']
		<a target="_blank" title="���. � '.$user_invit['login'].'" href="inf.php?'.$user_invit['id'].'">
		<img src="http://img.likebk.com/i/inf_'.$user_invit['cityreg'].'.gif"></a> 
		������ � ���� ������ <img src="http://img.likebk.com/i/align/align'.$u->info['align'].'.gif" style="vertical-align:bottom">
		<img src="http://img.likebk.com/i/clan/'.$claninf['name'].'.gif" style="vertical-align:bottom">
		<a href="javascript:void(0)">'.$u->info['login'].'</a>['.$u->info['level'].']
		<a target="_blank" title="���. � '.$u->info['login'].'" href="inf.php?'.$u->info['id'].'">
		<img src="http://img.likebk.com/i/inf_'.$u->info['cityreg'].'.gif"></a>';
		mysql_query('INSERT INTO `clan_news` (`clan`,`time`,`ddmmyyyy`,`uid`,`ip`,`login`,`title`,`text`) VALUES (
		"'.$clan_invit['clan_id'].'","'.time().'","'.date('d.m.Y').'","0","127.0.0.1","�������������","�������� ���������","'.mysql_real_escape_string($txt).'"
		)');
		mysql_query('DELETE FROM `clan_invit` WHERE `id` = "'.$clan_invit['id'].'"');
		if($upd){
			mysql_query('INSERT INTO `align_time_block` (`uid`,`time`) VALUES ("'.$u->info['id'].'","'.time().'")');
		  $ms = "�� ������� ������ �� ���������� � ���� <font color=#003388><b>".$claninf['name']."</b></font>";
		  unset($_GET);
		  header('location: main.php');
		}
	}
}

/* ����������� ����� */
if(isset($_POST['clan_name']) && $u->info['align'] != 2) {
	/*if($_POST['clan_align'] != 0) {
		$_POST['clan_align'] = 0;
	}*/
	
	$tr_money = 0;
	if($_POST['clan_align'] == 1) {
		$tr_money = 4000;
		$_POST['clan_align'] = 1;
	}elseif($_POST['clan_align'] == 3) {
		$tr_money = 4000;
		$_POST['clan_align'] = 3;
	}elseif($_POST['clan_align'] == 7) {
		$tr_money = 4000;
		$_POST['clan_align'] = 7;
	}else{
		$tr_money = 2000;
		$_POST['clan_align'] = 0;
	}
	if(false == true) {
		$re = '����������� ������ �������� �� ��������.';
	}elseif(isset($lzv['id'])) {
		$re = '�� ��� ������ ������ �� ����������� �����, �������� ������ �� �������������';
	}elseif($tr_money > $u->info['money']) {
		$re = '� ��� �� ������� �����, ��������� '.$tr_money.'��.';
	}/*elseif($u->info['palpro'] < time() && $u->info['admin'] == 0) {
		$re = '��� ���������� ������ �������� � ���������/��������';
	}*/elseif($u->info['clan'] > 0){
		$re = '�� �������� � ����� �� ������, ��������� �������� ���';
	}else{
		/* ������� ������ � ���� */
		$clan_name = substr(htmlspecialchars($_POST['clan_name2'],NULL,'cp1251'), 0, 30);
		$clan_name = str_replace('.','',$clan_name);
		$clan_name = str_replace(' ','',$clan_name);
		$clan_name = str_replace('	','',$clan_name);
		if($file = upload::saveimg('clan_img1',0.1,'gif',$clan_name)) {
			//if($file2 = upload::saveimg('clan_img2',0.5,'gif',$clan_name)) {
				if($tr_money < 0) {
					$tr_money = 0;
				}
				$u->info['money'] -= $tr_money;
				
				mysql_query('UPDATE `users` SET `money` = "'.$u->info['money'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				/*mysql_query('INSERT INTO `_clan` (`uid`,`time`,`city`,`name`,`name2`,`site`,`img1`,`img2`,`info`,`money`,`align`) VALUES (
					"'.$u->info['id'].'","'.time().'",
					"'.$u->info['city'].'",
					"'.mysql_real_escape_string(htmlspecialchars($_POST['clan_name'],NULL,'cp1251')).'",
					"'.mysql_real_escape_string(htmlspecialchars($_POST['clan_name2'],NULL,'cp1251')).'",
					"'.mysql_real_escape_string(htmlspecialchars($_POST['clan_site'],NULL,'cp1251')).'",
					"'.mysql_real_escape_string(htmlspecialchars($file[1],NULL,'cp1251')).'",'
				  "'.mysql_real_escape_string(htmlspecialchars($file2[1],NULL,'cp1251')).'",
					'"'.mysql_real_escape_string(str_replace("\r\n",'<br>',htmlspecialchars($_POST['clan_info'],NULL,'cp1251'))).'",
					"'.$tr_money.'",
					"'.mysql_real_escape_string(htmlspecialchars($_POST['clan_align'],NULL,'cp1251')).'"
				)');*/
        mysql_query('INSERT INTO `_clan` (`uid`,`time`,`city`,`name`,`name2`,`site`,`img1`,`img2`,`info`,`money`,`align`) VALUES (
          "'.$u->info['id'].'",
          "'.time().'",
          "'.$u->info['city'].'",
          "'.mysql_real_escape_string(htmlspecialchars($_POST['clan_name'],NULL,'cp1251')).'",
          "'.mysql_real_escape_string(htmlspecialchars($_POST['clan_name2'],NULL,'cp1251')).'",
          "'.mysql_real_escape_string(htmlspecialchars($_POST['clan_site'],NULL,'cp1251')).'",
          "'.mysql_real_escape_string(htmlspecialchars($file[1],NULL,'cp1251')).'",
          "",
          "'.mysql_real_escape_string(str_replace("\r\n",'<br>',htmlspecialchars($_POST['clan_info'],NULL,'cp1251'))).'",
          "'.$tr_money.'",
          "'.mysql_real_escape_string(htmlspecialchars($_POST['clan_align'],NULL,'cp1251')).'"
        )');
				$lzv = array(
					'id' => mysql_insert_id(),
					'name' => htmlspecialchars($_POST['clan_name'],NULL,'cp1251'),
					'time' => time()
				);
				$re = '�� ������� ������ ������ �� ����������� ����� &quot;'.htmlspecialchars($_POST['clan_name'],NULL,'cp1251').'&quot;. ('.$tr_money.'��.)';
			//}else{
			//	@unlink($file[2]); // �������� �����
			//	$re = '������� ������: '.upload::$error;
			//}
		}else{
			$re = '������ �����: '.upload::$error;
		}
	}
}

?>
<style>
body
{
	background-color:#E2E2E2;
	background-image: url(http://img.likebk.com/i/misc/showitems/dungeon.jpg);
	background-repeat:no-repeat;background-position:top right;
}
.form-control{
  width: 50%!important;
}
</style>
<link href="http://likebk.com/css/bootstrap.css" rel="stylesheet" type="text/css">
<div style="margin-left: 20px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div style="padding-left:0px;" align="center">
      <h3><? echo $u->room['name']; ?></h3>
    </div>
        <?
		if( $u->info['align'] == 2 ) {
			$re .= '<div>��������� ��������� ������������ �������� ������������ �����!</div>';
		}
		if($re != '') {
			echo '<font style="float:left" color="red"><b>'.$re.'</b></font>';
		}
		?>
    </td>
    <td width="200"><div align="right">
      <table cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%">&nbsp;</td>
          <td><table  border="0" cellpadding="0" cellspacing="0">
              <tr align="right" valign="top">
                <td><!-- -->
                    <? echo $goLis; ?>
                    <!-- -->
                    <table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td nowrap="nowrap"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
                            <tr>
                              <td bgcolor="#D3D3D3"><img src="http://img.likebk.com/i/move/links.gif" width="9" height="7" /></td>
                              <td bgcolor="#D3D3D3" nowrap="nowrap"><a href="javascript:void(0)" id="greyText" class="menutop" onClick="location='main.php?loc=1.180.0.11&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.11',1); ?>">����������� �����</a></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
              </tr>
          </table></td>
        </tr>
      </table>
      </div></td>
  </tr>
</table>
  <div><font color=red><?php echo $ms?></font></div>
  <?php if($u->info['clan']>0){
    $clans = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id`= "'.$u->info['clan'].'"'));
    echo "<center><font style='margin-right: 200px;' color=#000><b>�� ��� �������� � ����� �<span style='font-size: 15px; text-transform: uppercase;'>".$clans['name']."</span>� � �� ������ ������ ������ �� ����������� ������ �����. </b></font></center>";
    exit();
  }elseif(isset($clan_invit['id']) && (!isset($_GET['no_invit']) || !isset($_GET['no_invit']))){
      $claninf = mysql_fetch_array(mysql_query('SELECT * FROM `clan` WHERE `id` = "'.$clan_invit['clan_id'].'"'));
      $user_invit = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$clan_invit['id_invit'].'"'));
      /*echo '<fieldset style="width: 50%; border: 1px solid #8F0000; padding: 18px 12px 18px 12px;">
        <legend style="font-weight:bold; color:#8F0000;"></legend>';*/
      echo '����� <b>'.$user_invit['login'].'</b>
      <a href="http://likebk.com/inf.php?'.$user_invit['id'].'" target="_blank">
        <img style="vertical-align:baseline" width="12" height="11" src="http://img.likebk.com/i/inf_capitalcity.gif" title="���. � '.$user_invit['login'].'">
      </a> ���������� ��� �������� � ���� <font color=#003388><b>'.$claninf['name'].'</b></font>
      <a href="/clans_inf.php?'.$claninf['name'].'" title="'.$claninf['name'].'" target="_blank">
        <img style="vertical-align:baseline" width="12" height="11" src="http://img.likebk.com/i/inf_capitalcity.gif" title="���. � '.$claninf['name'].'"></a>:
        &nbsp; <input type="button" value="��������" onclick="location.href=\'?yes_invit=1\'">
        &nbsp;&nbsp;<font color="#cac9c7">|</font>&nbsp;&nbsp;<input type="button" value="��������" onclick="location.href=\'?no_invit=1\'">';
        // echo "</fieldset>";
      exit();
  }?>

<table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td>��� ����������� ������ ����� ���������� �����:<br />
    <!-- <br />&bull; <b>���� �����</b> (��������� �����, �����, �������������� ������ �����, ������� mail.ru <small>(������ ����)</small>) -->
    <!-- <br />&bull; <b>�������������� ��������� ����� (MiB , Mercenaries , Darkclan , Stalkers � �.�)- ���������!</b> (���� ������ ������������� �������� � ��������������) -->
    <br />&bull; <b>��������, ����� � �������� ����� ��� ������������</b>, ������� �� ����� ���������: ���������� ������� �� ��������� ����, �������������� �������� �� ��������� ����, ���������� ���� �������������� �������� ������� (������������� �������, �������������� ������������, ���������� ����������, �����, *������, ������������������ ������������, ������������� ������ ���� [�� �������, �����������, ������� �������������� � �.�.] � �.�.)
    <br />
    <br />&bull; <b>������ �����: </b>(������������ ����� � ����� ��������� � ����, �� ������, � ��� � �.�.):<br />
    &nbsp; &nbsp; &nbsp; - gif ��������<br />
    &nbsp; &nbsp; &nbsp; - ���������� ���<br />
    &nbsp; &nbsp; &nbsp; - ������ 24x15<br />
    &nbsp; &nbsp; &nbsp; - �� ����� ��� 32 �����<br />
    <!--<br /> &nbsp; &nbsp; &nbsp;
    ������� ������ ����� (��� ������������):<br />
    &nbsp; &nbsp; &nbsp; - gif ��������<br />
    &nbsp; &nbsp; &nbsp; - ���������� ���<br />
    &nbsp; &nbsp; &nbsp; - ������ 100x99<br />
    &nbsp; &nbsp; &nbsp; - ���������� ������ ���� ��������� � �����<br />-->
    <br />  
    &bull; ����� ������� ������, ������� ����� ����� ������ ������ �������� � ����������� (���������, ��������), � ���-�� �������� ������� ����.
    </td>
  </tr>
  <tr>
    <td><form action="main.php?go_psh=1" method="post" enctype="multipart/form-data" name="form1" id="form1">
      <br />
      <fieldset style="line-height:1.5em;">
        <legend><h3 style="padding-top: 10px; padding-bottom: 15px;">������ ������</h3></legend>
        <? if(!isset($lzv['id'])) { ?>
        �������� �����: <input class="form-control" name="clan_name" type="text" value="" size="50" maxlength="50" />
        <!-- <br /> -->
        ���������� ������������ (������ ���������� �����, ���� �����) 
        <input class="form-control" name="clan_name2" type="text" value="" size="30" maxlength="30" />
        <!-- <br /> -->
        <!-- ������ �� ����������� ���� �����: <input name="clan_site" type="text" value="http://" size="40" maxlength="80" />
        <br /> -->
        ������ �����: <input class="form-control" style="padding: 0px; width: 225px!important; height: 20px;" type="file" name="clan_img1" id="clan_img1" />
        <div id="fil_load"></div>
        <output id="list"></output>
		    <!-- <br /> -->
        <!-- ������� ������ <input type="file" name="clan_img2" id="clan_img2" /> -->
        <!-- <br /> -->
        ���������� �����: 
        <select class="form-control" name="clan_align">
          <option value="0">����� (2000 ��.)</option>
          <option value="7">����������� (4000 ��.)</option>
          <option value="3">������ (4000 ��.)</option>
          <option value="1">������� (4000 ��.)</option>
        </select>
        <!-- <br /> -->
        �������� ����� ��� ������������:<br />
        <textarea class="form-control" cols="104" name="clan_info" id="clan_info" rows="6"></textarea>
        <!-- <br /> -->
        <small style="color:red">� ������ ������ � ����������� (�� ����� �������) ������������ 90% �� ��������� �����.<br />
        ������������� � ����� �������� � ����������� ��� ���������� �������.</small>
        <br />
        <input type="submit" name="button" id="button" class="knopka" value="������ ������" />
        <? }else{ ?>
        <?=date('d.m.Y H:i',$lzv['time'])?> &nbsp; &nbsp; �� ��� ������ ������ �� ����������� ����� &quot;<b><?=$lzv['name']?></b>&quot;. �������� ������ �� ������������� �� �����.
        <? } ?>
      </fieldset>
    </form></td>
  </tr>
</table>
</div>
<p>
  <? } ?>
</p>
<script type="text/javascript">

//����� ������������ �����������
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          if($('#list').html() != ''){
            document.getElementById('list').remove();
            $('#fil_load').after('<output id="list"></output>');
          }
          var span = document.createElement('span');
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('clan_img1').addEventListener('change', handleFileSelect, false);
</script>