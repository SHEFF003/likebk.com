<?
if(!defined('GAME')){
	die();
}

if($u->room['file']=='ab/hram'){
?><script type="text/javascript" src="/js/jquery.locations.js"></script>
<link href="/css/fightclub.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="250" valign="top">      
        <? $usee = $u->getInfoPers($u->info['id'],0); if($usee!=false){ echo $usee[0]; }else{ echo 'information is lost.'; } ?>
    </td>
    <td width="230" valign="top" style="padding-top:19px;"><? include('modules_data/stats_loc.php'); ?></td>
    <td valign="top">
      <div align="right">
      <? if($u->error!=''){ echo '<font color="red"><b>'.$u->error.'</b></font>'; } ?>
      <table  border="0" cellpadding="0" cellspacing="0">
        <tr align="right" valign="top">
          <td>
          <? if($re!=''){ echo '<font color="red"><b>'.$re.'</b></font>'; } ?>
                <table width="500" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td id="ViewLocation"><?php
                    if($u->info['login'] == 'mZer0ne'){
					}else{
					?>
              <div style="width:500px; height:268px; position:relative; background:url(http://<?php echo $c['img']?>/i/items/hram/hram.jpg) no-repeat;">
                <div style="position:absolute; left:410px; top:17px; width:80px; height:50px; z-index:90;">
                  <img <?php //thisInfRm('1.180.0.323'); ?> onClick="goLocal('main.php?loc=1.180.0.323','Западная окраина');" src="http://<?php echo $c['img']?>/i/items/hram/exit.png" width="80" height="50" onmouseover="this.src='http://<?php echo $c['img']?>/i/items/hram/exit2.png';top.hi(this,'<div align=right><b>Выйти из Храма Знаний</b></div>',event,0,1,1,1,'max-height:240px');" onmouseout="this.src='http://<?php echo $c['img']?>/i/items/hram/exit.png';top.hic();" style="cursor:pointer;">
                </div>
                <div style="position:absolute; left:10px; top:120px; width:160px; height:110px; z-index:90;">
                  <img <?php //thisInfRm('3.180.10.01'); ?> onClick="goLocal('main.php?loc=3.180.10.01','Алтарь вещей');" src="http://<?php echo $c['img']?>/i/items/hram/altar_sub.png" width="160" height="110" onmouseover="this.src='http://<?php echo $c['img']?>/i/items/hram/altar_sub2.png';top.hi(this,'<div align=right><b>Алтарь вещей</b></div>',event,0,1,1,1,'max-height:240px');" onmouseout="this.src='http://<?php echo $c['img']?>/i/items/hram/altar_sub.png';top.hic();" style="cursor:pointer;">
                </div>
                <div style="position:absolute; left:330px; top:120px; width:160px; height:110px; z-index:90;">
                  <img <?php //thisInfRm('3.180.10.02'); ?> onClick="goLocal('main.php?loc=3.180.10.02','Алтарь рун');" src="http://<?php echo $c['img']?>/i/items/hram/altar_rune.png" width="160" height="110" onmouseover="this.src='http://<?php echo $c['img']?>/i/items/hram/altar_rune2.png';top.hi(this,'<div align=right><b>Алтарь рун</b></div>',event,0,1,1,1,'max-height:240px');" onmouseout="this.src='http://<?php echo $c['img']?>/i/items/hram/altar_rune.png';top.hic();" style="cursor:pointer;">
                </div>
                <div style="position:absolute; left:180px; top:5px; width:135px; height:240px; z-index:90;">
                  <!-- <img src="http://<?php //echo $c['img']?>/i/items/hram/master.png" width="135" height="240" alt="Мастер Алтаря" title="Мастер Алтаря" onclick="" onmouseover="this.src='http://<?php //echo $c['img']?>/i/items/hram/master2.png';" onmouseout="this.src='http://<?php //echo $c['img']?>/i/items/hram/master.png';" style="cursor:pointer;"> -->
                  <img src="http://<?php echo $c['img']?>/i/items/hram/master.png" width="135" height="240">
                </div>
              </div>

					  <div id="snow"></div>
                      <div style="position:absolute;top:7px;z-index:101;right: 9px;width:80px;">
                        <? echo $goline; ?>
                      </div>
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
        <? echo $rowonmax; ?><BR>
        
      </div></td>
  </tr>
</table>
<?php
}