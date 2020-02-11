<?
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='zalu_pal3')
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
                          <!-- Зал тьмы -->
                    <div style="position:relative; cursor: pointer; width: 500;" id="ione"><img src="http://img.likebk.com/i/images/300x225/club/navig.jpg" id="img_ione" width="500" height="240"  border="1"/>
            <div style="position:absolute; left:139px; top:79px; width:16px; height:18px; z-index:90;"><img src="http://img.likebk.com/i/images/300x225/fl1.gif" width="16" height="18" title="Вы находитесь в '<? echo $u->room['name']; ?>'" /></div>
                    <div style="position:absolute; left:164px; top:95px; width:176px; height:46px; z-index:90;"><img <? thisInfRm('1.180.0.3'); ?> src="http://img.likebk.com/i/images/300x225/map_bk.png" width="176" height="46" title="" class="aFilter" /></div>
                    <div style="position:absolute; left:52px; top:35px; width:126px; height:64px; z-index:90;"><img src="http://img.likebk.com/i/images/300x225/zal1.png" width="126" height="64" title=""/></div>
                    <div style="position:absolute; left:345px; top:35px; width:125px; height:64px; z-index:90;"><img onClick="alert('Проход через Бойцовский клуб');" onMouseOver="this.className='aFilterhover';" onMouseOut="this.className='aFilter';" src="http://img.likebk.com/i/images/300x225/zal2.png" width="125" height="64" title="Проход через Бойцовский клуб" class="aFilter"  /></div>
                    <div style="position:absolute; left:323px; top:150px; width:164px; height:64px; z-index:90;"><img onClick="alert('Проход через Бойцовский клуб');" onMouseOver="this.className='aFilterhover';" onMouseOut="this.className='aFilter';" src="http://img.likebk.com/i/images/300x225/zal3.png" width="164" height="64" title="Проход через Бойцовский клуб" class="aFilter" /></div>
                    <div style="position:absolute; left:40px; top:147px; width:146px; height:64px; z-index:90;"><img onClick="alert('Проход через Бойцовский клуб');" onMouseOver="this.className='aFilterhover';" onMouseOut="this.className='aFilter';" src="http://img.likebk.com/i/images/300x225/zal4.png" width="146" height="64" title="Проход через Бойцовский клуб" class="aFilter" /></div>
                    <div style="position:absolute; left:180px; top:147px; width:140px; height:61px; z-index:90;"><img onClick="alert('Проход через Бойцовский клуб');" onMouseOver="this.className='aFilterhover';" onMouseOut="this.className='aFilter';" src="http://img.likebk.com/i/images/300x225/map_cp.png" width="140" height="61" title="Проход через Бойцовский клуб" class="aFilter" /></div>                        
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
          <INPUT onclick="location.href='main.php?zayvka=<? echo $code; ?>';" class="btn" value="Поединки" type="button" name="combats">
        <!-- <? //$hgo = $u->testHome(); if(!isset($hgo['id'])){ ?><INPUT onclick="location.href='main.php?homeworld=<? //echo $code; ?>';" class="btn" value="Возврат" type="button" name="combats2"><? //} unset($hgo); ?> -->
          <INPUT id="forum" class="btn" onclick="window.open('http://<? echo $c['forum']; ?>/', 'forum', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Форум" type="button" name="forum">
        <br />
       <? echo $rowonmax; ?><BR>
        
      </div></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top" style="padding-top:19px;">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
<?
}

?>