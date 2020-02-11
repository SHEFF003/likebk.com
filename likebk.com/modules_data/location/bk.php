<?
if(!defined('GAME')){
	die();
}

if($u->room['file']=='bk'){
?><script type="text/javascript" src="/js/jquery.locations.js"></script>
<link href="/css/fightclub.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="250" valign="top">      
        <? $usee = $u->getInfoPers($u->info['id'],0); if($usee!=false){ echo $usee[0]; }else{ echo 'information is lost.'; } ?>
    </td>
    <td width="230" valign="top" style="padding-top:19px;"><? include('modules_data/stats_loc.php'); ?></td>
    <td valign="top"><div align="right">
      <? if($u->error!=''){ echo '<font color="red"><b>'.$u->error.'</b></font>'; } ?>
      <table  border="0" cellpadding="0" cellspacing="0">
        <tr align="right" valign="top">
          <td>
                <? if($re!=''){ echo '<font color="red"><b>'.$re.'</b></font>'; } ?>
                <table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td id="ViewLocation"><?php
                    if($u->info['login'] == 'mZer0ne'){
					?><script><?php
					include('modules_data/location/fight-club.database.php');
					?>
					var json = <?php echo json_encode($Response); ?>;
					var tgo = <?php echo ($tmGo*10); ?>;
					var tgol = <?php echo ($tmGol*10); ?>;
					ViewLocation(json);
					</script><?php
					}else{
					?>
                      <div style="position:relative; cursor: pointer; width: 500;" id="ione"><img src="http://img.likebk.com/i/images/300x225/club/navig.jpg" id="img_ione" width="500" height="240"  border="1"/>
					 
                      <div style="position:absolute; left:241px; top:128px; width:16px; height:18px; z-index:90;"><img src="http://img.likebk.com/i/images/300x225/fl1.gif" width="16" height="18" title="Вы находитесь в '<? echo $u->room['name']; ?>'" /></div>
                      
                      <div style="position:absolute; left:164px; top:95px; width:176px; height:46px; z-index:90;"><img src="http://img.likebk.com/i/images/300x225/map_bk.png" width="176" height="46" title="" class="aFilter" /></div>
                      <!-- <div style="position:absolute; left:52px; top:35px; width:126px; height:64px; z-index:90;"><img <? //thisInfRm('1.180.0.7'); ?> onClick="location='main.php?loc=1.180.0.7';" src="http://img.likebk.com/i/images/300x225/zal1.png" width="126" height="64" class="aFilter" /></div>
                      <div style="position:absolute; left:345px; top:35px; width:125px; height:64px; z-index:90;"><img  <? //thisInfRm('1.180.0.5'); ?> onClick="location='main.php?loc=1.180.0.5';"  src="http://img.likebk.com/i/images/300x225/zal2.png" width="125" height="64" class="aFilter"  /></div>          
                      <div style="position:absolute; left:323px; top:150px; width:164px; height:64px; z-index:90;"><img <? //thisInfRm('1.180.0.2'); ?> onClick="location='main.php?loc=1.180.0.2';" src="http://img.likebk.com/i/images/300x225/zal3.png" width="164" height="64" title="" class="aFilter" /></div>
                      <div style="position:absolute; left:40px; top:147px; width:146px; height:64px; z-index:90;"><img  <? //thisInfRm('1.180.0.4'); ?> onClick="location='main.php?loc=1.180.0.4';"  src="http://img.likebk.com/i/images/300x225/zal4.png" width="146" height="64"  class="aFilter" /></div>
					           <div style="position:absolute; left:180px; top:147px; width:140px; height:61px; z-index:90;"><img <? //thisInfRm('1.180.0.9'); ?> onClick="location='main.php?loc=1.180.0.9';"  src="http://img.likebk.com/i/images/300x225/map_cp.png" width="140" height="61"  class="aFilter" /></div> -->
                      <div style="position:absolute; left:52px; top:35px; width:126px; height:64px; z-index:90;"><img <? thisInfRm('1.180.0.375'); ?> onClick="location='main.php?loc=1.180.0.375';" src="http://img.likebk.com/i/images/300x225/zal1.png" width="126" height="64" class="aFilter" /></div>
                      <div style="position:absolute; left:345px; top:35px; width:125px; height:64px; z-index:90;"><img  <? thisInfRm('1.180.0.16'); ?> onClick="location='main.php?loc=1.180.0.16';"  src="http://img.likebk.com/i/images/300x225/zal2.png" width="125" height="64" class="aFilter"  /></div>          
                      <div style="position:absolute; left:323px; top:150px; width:164px; height:64px; z-index:90;"><img <? thisInfRm('1.180.0.376'); ?> onClick="location='main.php?loc=1.180.0.376';" src="http://img.likebk.com/i/images/300x225/zal3.png" width="164" height="64" title="" class="aFilter" /></div>
                      <div style="position:absolute; left:40px; top:147px; width:146px; height:64px; z-index:90;"><img  <? thisInfRm('1.180.0.4'); ?> onClick="location='main.php?loc=1.180.0.4';"  src="http://img.likebk.com/i/images/300x225/zal4.png" width="146" height="64"  class="aFilter" /></div>
                     <div style="position:absolute; left:180px; top:147px; width:140px; height:61px; z-index:90;"><img <? thisInfRm('1.180.0.9'); ?> onClick="location='main.php?loc=1.180.0.9';"  src="http://img.likebk.com/i/images/300x225/map_cp.png" width="140" height="61"  class="aFilter" /></div>
					  <div id="snow"></div>
                      <? echo $goline; ?>
                    </div>
                    <?php } ?>
                    </td>
                  </tr>
                </table>   
              <div style="display:none; height:0px " id="moveto"></div>     
            </td>
          <td>
              <!-- <br /><span class="menutop"><nobr>Комната для новичков</nobr></span>-->
          </td>
        </tr>
      </table>
      	<small>
        <HR>
		    <INPUT onclick="location.href='main.php?homeworld=<? echo $code; ?>';" class="btn" value="Возврат" type="button" name="combats2">
      <!--<input <? //thisInfRm('1.180.0.225'); ?> onClick="location='main.php?loc=1.180.0.225';" class="btn" value="Казино" type="button" name="combats" /> -->
          <INPUT id="forum" class="btn" onclick="window.open('http://<? echo $c['forum']; ?>/', 'forum', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Форум" type="button" name="forum">
        <br />
        <? echo $rowonmax; ?><BR>
        
      </div></td>
  </tr>
</table>
<?php
}