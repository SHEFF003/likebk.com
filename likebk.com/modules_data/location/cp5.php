<?
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='cp5') {
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
                      <div style="position:relative; cursor: pointer; width: 590;" id="ione">
                        <img src="http://img.likebk.com/loca/cpnews/forest/cp_park5<? if( date('H') >= 22 || date('H') < 6 ) { echo '_night'; } ?>.jpg" id="img_ione" width="590" height="250"  border="1"/>
                        <div style="position: absolute; left: 15px; top: 189px; width: 32px; height: 40px; z-index: 92;">
                        
                        <div style="cursor: pointer; position: absolute; left: 301px; top: -66px; width: 74px; height: 63px; z-index: 91;">
                        <img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('forest/room2_b.png','forest/room2.png','1.180.0.413'); ?> src="http://<?php echo $c['img']?>/loca/cpnews/forest/room2.png" title="" class="aFilter" />
                        </div> 
                        
                        <div style="cursor: pointer; position: absolute; left: 36px; top: -49px; width: 74px; height: 63px; z-index: 91;">
                        <img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('forest/room4_b.png','forest/room4.png','1.180.0.418'); ?> src="http://<?php echo $c['img']?>/loca/cpnews/forest/room4.png" title="" class="aFilter" />
                        </div>
						
						
						<div style="cursor: pointer; position: absolute; left: 440px; top: -80px; width: 100px; height: 106px; z-index: 91;">
                        <img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('forest/colectionhome2.png','forest/colectionhome.png','1.180.0.424'); ?> src="http://<?php echo $c['img']?>/loca/cpnews/forest/colectionhome.png" title="" class="aFilter" />
                        </div>
						
                        
                        <?
							//if($u->info['login'] == "ScHoolboy") {
								//if($u->info['twink'] > 0) {
									?>
									<div style="cursor: pointer; position: absolute; left: 175px; top: -95px; width: 100px; height: 106px; z-index: 91;">
									<img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('forest/room5.png','forest/room5.png','1.180.0.428'); ?> src="http://<?php echo $c['img']?>/loca/cpnews/forest/room5.png" title="" class="aFilter" />
									</div>
									<?
								//}
							//}


						/*if( $u->info['admin'] > 0 ) {*/ ?>
                        <div style="cursor: pointer; position: absolute; left: 230px; top: -180px; width: 74px; height: 63px; z-index: 91;">
                        <? /* <a title="Парящая лавка" href="/main.php?loc=1.180.0.420"> */ ?>
                        	<img <? thisInfRm_cp(false,false,'1.180.0.420'); ?> oncontextmenu="return false;" ondragstart="return false" src="http://<?php echo $c['img']?>/flyrune.png" title="" class="aFilter" />
                        <? /* </a> */ ?>
                        </div>
                        <? /*}*/ ?>
                        
                        <? if( $u->info['admin'] > 0 && true == false ) { ?>
                                                
                        <div style="cursor: pointer; position: absolute; left: 380px; top: -63px; width: 74px; height: 63px; z-index: 91;">
                        <img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('forest/room3_b.png','forest/room3.png','1.180.0.414'); ?> src="http://<?php echo $c['img']?>/loca/cpnews/forest/room3.png" title="" class="aFilter" />
                        </div>
                                                
                        <div style="cursor: pointer; position: absolute; left: 162px; top: -51px; width: 74px; height: 63px; z-index: 91;">
                        <img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('forest/room1_b.png','forest/room1.png','1.180.0.xx'); ?> src="http://<?php echo $c['img']?>/loca/cpnews/forest/room1.png" title="" class="aFilter" />
                        </div>
                        
                        <? } ?>
                        
                        <img src="http://img.likebk.com/loca/cpnews/park/left_stop.png" width="32" height="40" title="Проход не существует" /></div>
                      <div style="position: absolute; left: 532px; top: 194px; width: 44px; height: 35px; z-index: 92;">
                        <img <? thisInfRm_cp('park/right_b.png','park/right.png','1.180.0.323'); ?> src="http://img.likebk.com/loca/cpnews/park/right.png" width="44" height="35" title="" class="aFilter" /></div>
                      
                      <div id="snow"></div>
                      <? echo $goline; ?>
                      <div id="buttons_on_image" style="cursor:pointer; position:absolute; bottom:5px; right:25px; font-weight:bold; color:#D8D8D8; font-size:10px;">
                       <?
                        //if($u->info['admin'] > 0){
                          echo '<a style="color:#D8D8D8; cursor:pointer;display: block; width: 55px; height: 15px;    position: absolute;top: 0px;left: -70px;" onclick="window.open(\'/help/cp4.html\', \'help\', \'height=500,width=800,location=no,menubar=no,status=no,toolbar=no,scrollbars=yes\')">Подсказка</a> &nbsp; ';
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