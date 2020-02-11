<?php

define('GAME',true);


if(!isset($_GET['new'])) {
	die();
}

if(isset($_GET['r'])) {
  $_GET['r'] = (int)$_GET['r'];
} else {
  $_GET['r'] = null;	
}
include_once('_incl_data/__config.php');
include_once('_incl_data/class/__db_connect.php');
include_once('_incl_data/class/__user.php');
include('_incl_data/class/__zv.php');


?>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <script src="http://likebk.com/js/logs/bootstrap.min.js" type="text/javascript"></script>
 <link rel="stylesheet" type="text/css" href="css/tooltip.css" />
<link href="http://likebk.com/css/bootstrap.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
  $(document).ready(function(){
      $('[rel="tooltip"]').tooltip();   
      $('[rel="tooltip"]').css('cursor','pointer');
  });
</script>

<?php
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

$zv->zv_see=1;
//echo $zv->see();
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
<?php
//$zv->test(); //проверяем заявки
//$zv->test2();
//echo date('H:i:s');

?>