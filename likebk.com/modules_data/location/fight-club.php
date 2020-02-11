<?php
die();
include('modules_data/location/fight-club.database.php');
if(!defined('GAME')){
	die();
}
?><script type="text/javascript" src="/js/jquery.locations.js"></script>
<link href="/css/fightclub.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="250" valign="top"><?php
      $usee = $u->getInfoPers($u->info['id'],0);
	  if($usee!=false){
		  echo $usee[0];
	  }else{
		  echo 'information is lost.';
	  }
	?></td>
    <td width="230" valign="top" style="padding-top:19px;"><? include('modules_data/stats_loc.php'); ?></td>
    <td valign="top"><div align="right"><?php
    if($u->error!=''){
		echo '<font color="red"><b>'.$u->error.'</b></font>';
	}
	?><table  border="0" cellpadding="0" cellspacing="0">
        <tr align="right" valign="top">
          <td><?php
          if($re!=''){
			  echo '<font color="red"><b>'.$re.'</b></font>';
		  }
		  ?><table width="500" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td id="ViewLocation"><script type="text/javascript">
					var json = <?php echo json_encode($Response); ?>;
					var tgo = <?php echo ($tmGo*10); ?>;
					var tgol = <?php echo ($tmGol*10); ?>;
					ViewLocation(json);
					</script></td>
                  </tr>
                </table>   
              <div style="display:none; height:0px " id="moveto"></div>     
              </td>
        </tr>
      </table>
      	<small>
        <HR><div id="ajaxButtons"<?php
        $hgo = $u->testHome(); if(!isset($hgo['id'])){
			echo'<INPUT onclick="location.href=\'main.php?homeworld=' . $code . '\';" class="btn" value="Возврат" type="button" name="combats2">';
        }
        unset($hgo);
        ?><input <?php thisInfRm('1.180.0.225'); ?> onClick="location='main.php?loc=1.180.0.225';" class="btn" value="Казино" type="button" name="combats" />
          <INPUT id="forum" class="btn" onclick="window.open('http://<? echo $c['forum']; ?>/', 'forum', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Форум" type="button" name="forum">
        </div><br />
        <?php echo $rowonmax; ?><BR>
      </div></td>
  </tr>
</table>