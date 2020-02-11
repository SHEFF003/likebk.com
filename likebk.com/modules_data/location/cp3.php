<?
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='cp3') {
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
                <?
                if( $u->error != '' ) {
					if( $re != '' ) {
						$re .= '<br>';
					}
					$re .= $u->error;
				}
				if($re!=''){ echo '<font color="red"><b>'.$re.'</b></font>'; } ?>
                <table width="590" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
                      <div style="position:relative; width: 590;" id="ione">
                        <img oncontextmenu="return false;" ondragstart="return false" src="http://<?php echo $c['img']?>/loca/cpnews/shopStreet/cp_shopstreet<? if( date('H') >= 22 || date('H') < 6 ) { echo '_night'; } ?>.jpg" id="img_ione" width="590" height="250"  border="1"/>
                        <div style="cursor: pointer; position: absolute; left: 15px; top: 125px; width: 102px; height: 80px; z-index: 91;">
                        <img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('shopStreet/book_b.png','shopStreet/book.png','1.180.0.215'); ?> src="http://<?php echo $c['img']?>/loca/cpnews/shopStreet/book.png" width="102" height="80" title="" class="aFilter" />
                        </div>
                        <div style="cursor: pointer; position: absolute; right: 25px; top: 90px; width: 84px; height: 61px; z-index: 91;">
                        <img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('shopStreet/zoo_shop_b.png','shopStreet/zoo_shop.png','1.180.0.216'); ?> src="http://<?php echo $c['img']?>/loca/cpnews/shopStreet/zoo_shop.png" width="84" height="61" title="" class="aFilter" />
                        </div>
                        <div style="cursor: pointer; position: absolute; left: 245px; top: 138px; width: 74px; height: 63px; z-index: 91;">
                        <img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('shopStreet/portal_b.png','shopStreet/portal.png','1.180.0.321'); ?> src="http://<?php echo $c['img']?>/loca/cpnews/shopStreet/portal.png" width="74" height="63" title="" class="aFilter" />
                        </div>
                        <div style="cursor: pointer; position: absolute; left: 395px; top: 110px; width: 63px; height: 70px; z-index: 90;">
                        <img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('shopStreet/altar_b.png','shopStreet/altar.png','1.180.0.322'); ?> src="http://<?php echo $c['img']?>/loca/cpnews/shopStreet/altar.png" width="63" height="70" title="" class="aFilter" />
                        </div>
                        
                        <div style="cursor: pointer; position: absolute; right: 25px; top: 189px; width: 28px; height: 39px; z-index: 92;">
                          <img oncontextmenu="return false;" ondragstart="return false" src="http://<?php echo $c['img']?>/loca/cpnews/shopStreet/right_stop.png" width="28" height="39" title="Проход не существует" /></div>
                        <div style="cursor: pointer; position: absolute; left: 15px; top: 188px; width: 39px; height: 40px; z-index: 92;">
                          <img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('shopStreet/left_b.png','shopStreet/left.png','1.180.0.11'); ?> src="http://<?php echo $c['img']?>/loca/cpnews/shopStreet/left.png" width="39" height="40" title="" class="aFilter" /></div>
                        <div id="snow"></div>
                        <div style="cursor: pointer; position:absolute; top:3px; z-index:101; right:15px; width:80px;">
                          <? echo $goline; ?>
                        </div>
                        <div id="buttons_on_image" style="cursor:pointer; position:absolute; bottom:5px; right:25px; font-weight:bold; color:#D8D8D8; font-size:10px;">
                         <?
                         //if($u->info['admin'] > 0){
                          echo '<a style="color:#D8D8D8; cursor:pointer;display: block; width: 55px; height: 15px;    position: absolute;top: 0px;left: -70px;" onclick="window.open(\'/help/cp3.html\', \'help\', \'height=500,width=800,location=no,menubar=no,status=no,toolbar=no,scrollbars=yes\')">Подсказка</a> &nbsp; ';
                        //}
                           if( date('H') >= 22 || date('H') < 6 ) {
                              echo '<a style="color:#D8D8D8" style="cursor:pointer" onclick="top.useMagic(\'Нападение на персонажа\',\'night_atack\',\'pal_button8.gif\',1,\'main.php?nightatack=1\');">Напасть</a> &nbsp; ';
                            }
                          ?>
                           <a style="color:#D8D8D8" href="http://forum.likebk.com/" target="_blank">Форум</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </table>   
                <div style="display:none; height:0px " id="moveto"></div>     
              <div align="right" style="padding: 3px;"></div></td>
          <td>
              <!-- <br /><span class="menutop"><nobr>Комната для новичков</nobr></span>-->
          </td>
        </tr>
      </table>
      	<small>
        <HR>
       <? echo $rowonmax; ?><BR>
        
      </div></td>
  </tr>
</table>
<?
}

?>