<?
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='cp2') {
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
                    <?php if( date('H') >= 22 || date('H') < 6 ) {?>
                      <img ondragstart="return false" oncontextmenu="return false;" src="http://img.likebk.com/loca/cpnews/cp_str/cpstrlikebk_night.jpg" id="img_ione" width="590" height="250"  border="1"/>
                    <?php }else{?>
                      <img ondragstart="return false" oncontextmenu="return false;" src="http://img.likebk.com/loca/cpnews/cp_str/cpstrlikebk.jpg" id="img_ione" width="590" height="250"  border="1"/>
                    <?php }?>
                      <!-- <div style="position: absolute; left: 65px; top: 136px; width: 158px; height: 103px; z-index: 91;">
                      <img ondragstart="return false" oncontextmenu="return false;" <? //thisInfRm('1.180.0.214'); ?> src="http://img.likebk.com/loca/cp11/lmbrd_png.png" width="158" height="103" title="" class="aFilter" />
                      </div> -->
                      <div style="cursor: pointer; position: absolute; left: 45px; top: 99px; width: 151px; height: 132px; z-index: 90;">
                        <img ondragstart="return false" oncontextmenu="return false;" <? thisInfRm_cp('cp_str/posol_b.png','cp_str/posol.png','1.180.0.349'); ?> src="http://img.likebk.com/loca/cpnews/cp_str/posol.png" width="151" height="132" title="" class="aFilter" />
                      </div>
                      <div style="cursor: pointer; position: absolute; left: 255px; top: 3px; width: 113px; height: 228px; z-index: 90;">
                        <img ondragstart="return false" oncontextmenu="return false;" <? thisInfRm_cp('cp_str/bs_b.png','cp_str/bs.png','1.180.0.263'); ?> src="http://img.likebk.com/loca/cpnews/cp_str/bs.png" width="113" height="228" title="" class="aFilter" />
                      </div>
                      <div style="cursor: pointer; position: absolute; left: 390px; top: 141px; width: 133px; height: 88px; z-index: 91;">
                        <img ondragstart="return false" oncontextmenu="return false;" <? thisInfRm_cp('cp_str/flower_b.png','cp_str/flower.png','1.180.0.212'); ?> src="http://img.likebk.com/loca/cpnews/cp_str/flower.png" width="133" height="88" title="" class="aFilter" />
                      </div>
                    <?php if( date('H') >= 22 || date('H') < 6 ) {?>
                      <div style="cursor: pointer; position: absolute; right: 0px; top: 155px; width: 76px; height: 74px; z-index: 92;">
                        <img ondragstart="return false" oncontextmenu="return false;" <? thisInfRm_cp('cp_str/right_b_night.png','cp_str/right_night.png','1.180.0.213'); ?> src="http://img.likebk.com/loca/cpnews/cp_str/right_night.png" width="76" height="74" title="" /></div>
                      <div style="cursor: pointer; position: absolute; left: 4px; top: 155px; width: 69px; height: 74px; z-index: 92;">
                        <img ondragstart="return false" oncontextmenu="return false;" <? thisInfRm_cp('cp_str/left_b_night.png','cp_str/left_night.png','1.180.0.9'); ?> src="http://img.likebk.com/loca/cpnews/cp_str/left_night.png" width="69" height="74" title="" /></div>
                    <?php }else{?>
                      <div style="cursor: pointer; position: absolute; right: 1px; top: 157px; width: 66px; height: 72px; z-index: 92;">
                        <img ondragstart="return false" oncontextmenu="return false;" <? thisInfRm_cp('cp_str/right_b.png','cp_str/right.png','1.180.0.213'); ?> src="http://img.likebk.com/loca/cpnews/cp_str/right.png" width="66" height="72" title="" class="aFilter" /></div>
                      <div style="cursor: pointer; position: absolute; left: 5px; top: 156px; width: 60px; height: 73px; z-index: 92;">
                        <img ondragstart="return false" oncontextmenu="return false;" <? thisInfRm_cp('cp_str/left_b.png','cp_str/left.png','1.180.0.9'); ?> src="http://img.likebk.com/loca/cpnews/cp_str/left.png" width="60" height="73" title="" class="aFilter" /></div>
                    <?php }?>
                    <div id="snow"></div>
                      <div style="cursor: pointer; position:absolute; top:3px; z-index:101; right:15px; width:80px;">
                        <? echo $goline; ?>
                    </div>
                      <div id="buttons_on_image" style="cursor:pointer; position:absolute; bottom:5px; right:25px; font-weight:bold; color:#D8D8D8; font-size:10px;">
                       <?
                       //if($u->info['admin'] > 0){
                          echo '<a style="color:#D8D8D8; cursor:pointer;display: block; width: 55px; height: 15px;    position: absolute;top: 0px;left: -70px;" onclick="window.open(\'/help/cp2.html\', \'help\', \'height=500,width=800,location=no,menubar=no,status=no,toolbar=no,scrollbars=yes\')">Подсказка</a> &nbsp; ';
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