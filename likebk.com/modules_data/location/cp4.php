<?
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='cp4') {
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
				if($re!=''){ echo '<font color="red"><b>'.$re.'</b></font>'; }

				$test = mysql_fetch_array(mysql_query('SELECT `id` FROM `ng_quest` WHERE `uid` = 2018 LIMIT 1'));

				?>
                <table width="590" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
                      <div style="position:relative; cursor: pointer; width: 590;" id="ione">
                        <img src="http://img.likebk.com/loca/cpnews/park/cp_park<? if( date('H') >= 22 || date('H') < 6 ) { echo '_night'; } ?>.jpg" id="img_ione" width="590" height="250"  border="1"/>
                      <div style="position: absolute; left: 120px; top: 120px; width: 112px; height: 104px; z-index: 91;">
                        <img <? thisInfRm_cp('park/obshag_b.png','park/obshag.png','1.180.0.214'); ?> src="http://img.likebk.com/loca/cpnews/park/obshag.png" width="112" height="104" title="" class="aFilter" />
                      </div>
                      <div style="position: absolute; left: 445px; top: 115px; width: 100px; height: 91px; z-index: 90;">
                      <img <? thisInfRm_cp('park/znahar_b.png','park/znahar.png','1.180.0.222'); ?> src="http://img.likebk.com/loca/cpnews/park/znahar.png" width="100" height="91" title="" class="aFilter" />
                      </div>
					  
					  <?
								/*if(!isset($test['id'])) {
								?>
								<div style="cursor: pointer; position: absolute; left: 0px; top: 110px; width: 100px; height: 106px; z-index: 91;">
									<img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm('1.180.0.429'); ?> width="120" height="120" src="http://<?php echo $c['img']?>/loca/ng/3.png" title="" class="aFilter" />
								</div>
								<?
							}else{
								?>
								<div style="cursor: pointer; position: absolute; left: 0px; top: 110px; width: 100px; height: 106px; z-index: 91;">
									<img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm('1.180.0.430'); ?> width="120" height="120" src="http://<?php echo $c['img']?>/loca/ng/4.png" title="" class="aFilter" />
								</div>
								<?
							}*/
							
					  
					  ?>
					  
                      <div style="position:absolute; left:265px; top:35px; width:117px; height:193px; z-index:94;">
                        <img <? thisInfRm_cp('park/hram_b.png','park/hram.png','3.180.0.271'); ?> src="http://img.likebk.com/loca/cpnews/park/hram.png" width="117" height="193" class="aFilter"></div>
                      <div style="position: absolute; left: 15px; top: 188px; width: 32px; height: 40px; z-index: 92;">
                        <img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('shopStreet/left_b.png','shopStreet/left.png','1.180.0.412'); ?> src="http://img.likebk.com/loca/cpnews/shopStreet/left.png" width="39" height="40" title="" class="aFilter" /></div>
                      <div style="position: absolute; left: 532px; top: 194px; width: 44px; height: 35px; z-index: 92;">
                        <img <? thisInfRm_cp('park/right_b.png','park/right.png','1.180.0.9'); ?> src="http://img.likebk.com/loca/cpnews/park/right.png" width="44" height="35" title="" class="aFilter" /></div>
                      
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
       <?
		echo $rowonmax;
	if($u->info['admin'] > 0) {
		if(isset($_GET['test_q'])) {
			$u->info['room'] = 430;
			mysql_query('UPDATE `users` SET `room` = '.$u->info['room'].' WHERE `id` = '.$u->info['id'].' LIMIT 1');
		}
		echo '<br><a href="?test_q">Тестировать квесты!</a>';
	}
	   ?><BR>
        
      </div></td>
  </tr>
</table>
<?
}

?>