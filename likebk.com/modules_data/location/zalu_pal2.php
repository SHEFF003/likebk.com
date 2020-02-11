<?
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='zalu_pal2')
{
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="250" valign="top">      
        <? $usee = $u->getInfoPers($u->info['id'],0); if($usee!=false){ echo $usee[0]; }else{ echo 'information is lost.'; } ?>
    </td>
    <td width="230" valign="top" style="padding-top:19px;"><? include('modules_data/stats_loc.php'); ?></td>
    <td valign="top"><div align="right">
      <table  border="0" cellpadding="0" cellspacing="0">
        <tr align="right" valign="top">
          <td>
                <? if($re!=''){ echo '<font color="red"><b>'.$re.'</b></font>'; } ?>
                <table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
                    <div style="position:relative; cursor: pointer;" id="ione">
                        <img src="http://img.likebk.com/i/images/300x225/club/navig1.jpg" alt="" name="img_ione" width="500" height="240" border="1" id="img_ione"/>
                        <div style="position:absolute; left:354px; top:115px; width:120px; height:35px; z-index:90;"><img src="http://img.likebk.com/i/images/300x225/map_halls.gif" width="120" height="35" class="aFilter" /></div>
                        <div style="position:absolute; left:52px; top:47px; width:123px; height:32px; z-index:90;"><img <? thisInfRm('1.180.0.16'); ?> onClick="location='main.php?loc=1.180.0.16';" src="http://img.likebk.com/i/images/300x225/map_demon3.gif" width="123" height="32" class="aFilter" /></div>   
						<div style="position:absolute; left:49px; top:141px; width:16px; height:18px; z-index:91;"><img src="http://img.likebk.com/i/images/300x225/fl1.gif" width="16" height="18" title="Вы находитесь в '<? echo $u->room['name']; ?>'"  /></div>
                      <div style="position:absolute; left:78px; top:24px; width:76px; height:18px; z-index:90;"><img src="http://img.likebk.com/i/images/300x225/map_zalu6.gif" width="76" height="18" class="aFilter"  /></div>	
                        <div style="position:absolute; left:17px; top:122px; width:79px; height:32px; z-index:90;"><img src="http://img.likebk.com/i/images/300x225/map_demon4.gif" width="78" height="33" class="aFilter"  /></div>
                      <div style="position:absolute; left:393px; top:170px; width:100px; height:35px; z-index:90;"><img onClick="alert('Проход через залы');" src="http://img.likebk.com/i/images/300x225/map_zalu7.gif" width="100" height="35" class="aFilter" /></div> 
                        <? echo $goline; ?>
                        <div id="snow"></div>
                    </div>
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
        <? $hgo = $u->testHome(); if(!isset($hgo['id'])){ ?><INPUT onclick="location.href='main.php?homeworld=<? echo $code; ?>';" class="btn" value="Возврат" type="button" name="combats2"><? } unset($hgo); ?>
          <INPUT id="forum" class="btn" onclick="window.open('http://<? echo $c['forum']; ?>/', 'forum', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Форум" type="button" name="forum">
        <br />
       <? echo $rowonmax; ?><BR>
        
      </div></td>
  </tr>
</table>
<?
}

?>