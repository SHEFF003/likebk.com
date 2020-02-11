<?
if(!defined('GAME'))
{
	die();
}

if($u->room['file']=='cp') {
	$port1 = false;
	$test = mysql_fetch_array(mysql_query('SELECT * FROM `qst_portal` WHERE `time` > "'.time().'" LIMIT 1'));
	$keytest = md5($test['time']+$test['id'].'q');
	if(isset($_GET['sd5'])) {
		if(isset($test['id'])) {						
			if(isset($_GET['sd5']) && $_GET['sd5'] == $keytest) {
				if( $test['users'] == 1 ) {
					mysql_query('DELETE FROM `qst_portal` WHERE `id` = "'.$test['id'].'" LIMIT 1');
				}else{
					mysql_query('UPDATE `qst_portal` SET `users` = `users` - 1 WHERE `id` = "'.$test['id'].'" LIMIT 1');
				}
				mysql_query('UPDATE `stats` SET `x` = 0 , `y` = 0 ,`dnow` = "'.$test['dnow'].'" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				mysql_query('UPDATE `users` SET `room` = "360" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				mysql_query('INSERT INTO `qst_portal_go` (`uid`,`time`) VALUES (
					"'.$u->info['id'].'","'.(time()+3600).'"
				)');
				$u->error = 'Вы успешно вошли в портал!..';
				$port1 = true;
			}else{
				$u->error = 'У вас не получилось войти в портал!';
			}
		}else{
			$u->error = 'Портал уже закрылся!';
		}
	}
	
?>
<style type="text/css">
.aFilter2:hover {
    -webkit-filter: drop-shadow(0px 7px 7px rgba(255,255,255,1));
    filter: url(#drop-shadow);
    -ms-filter: "progid:DXImageTransform.Microsoft.Dropshadow(OffX=0, OffY=0, Color='#FFF')";
    filter: "progid:DXImageTransform.Microsoft.Dropshadow(OffX=0, OffY=0, Color='#FFF')";

}
</style>
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
                    <!-- <div style="position:relative; width: 590px;" id="ione">
                    	<img src="http://img.likebk.com/loca/cpnew/cplikebk<? //if( date('H') >= 22 || date('H') < 6 ) { echo '_night'; } ?>.jpg" id="img_ione" width="590" height="250"  border="1"/>
                    	<div style="cursor: pointer; position: absolute; left: 163px; top: 20px; width: 291px; height: 172px; z-index: 90;"><img <? //thisInfRm('1.180.0.3'); ?> src="http://img.likebk.com/loca/cpnew/bk.png" width="291" height="172" title="" class="aFilter" /></div>
                    	<div style="cursor: pointer; position: absolute; left: 32px; top: 130px; width: 84px; height: 82px; z-index: 90;"><img <? //thisInfRm('1.180.0.272'); ?> src="http://img.likebk.com/loca/cpnew/comission.png" width="84" height="82" title="" class="aFilter" /></div>	
                    	<div style="cursor: pointer; position: absolute; left: 93px; top: 153px; width: 104px; height: 77px; z-index: 90;"><img <? //thisInfRm('1.180.0.10'); ?> src="http://img.likebk.com/loca/cpnew/shop.png" width="104" height="77" title="" class="aFilter" /></div>	
                    	<div style="cursor: pointer; position: absolute; left: 179px; top: 133px; width: 93px; height: 73px; z-index: 90;"><img <? //thisInfRm('1.180.0.210'); ?> src="http://img.likebk.com/loca/cpnew/remont.png" width="93" height="73" title="" class="aFilter" /></div>
                    	<div style="cursor: pointer; position: absolute; left: 360px; top: 123px; width: 91px; height: 97px; z-index: 90;"><img <? //thisInfRm('1.180.0.13'); ?> src="http://img.likebk.com/loca/cpnew/berez.png" width="91" height="97" title="" class="aFilter" /></div>
                    	<div style="cursor: pointer; position: absolute; left: 450px; top: 95px; width: 90px; height: 108px; z-index: 89;"><img <? //thisInfRm('1.180.0.226'); ?> src="http://img.likebk.com/loca/cpnew/post.png" width="90" height="108" title="" class="aFilter" /></div>
                    	<div style="cursor: pointer; position: absolute; right: 0px; top: 150px; width: 60px; height: 80px; z-index: 91;"><img <? //thisInfRm('1.180.0.11'); ?> src="http://img.likebk.com/loca/cpnew/right_strasch.png" width="60" height="80" title="" class="aFilter" /></div>
                      	<div style="cursor: pointer; position: absolute; left: 7px; top: 155px; width: 66px; height: 75px; z-index: 91;"><img <? //thisInfRm('1.180.0.323'); ?> src="http://img.likebk.com/loca/cpnew/left_park.png" width="66" height="75" title="" class="aFilter" /></div>
                   </div> -->
                   <!-- <img onclick="goLocal('main.php?loc=3.180.10.01','Алтарь вещей');" src="http://img.likebk.com/i/items/hram/altar_sub.png" width="160" height="110" onmouseover="this.src='http://img.likebk.com/i/items/hram/altar_sub2.png';top.hi(this,'<div align=right><b>Алтарь вещей</b></div>',event,0,1,1,1,'max-height:240px');" onmouseout="this.src='http://img.likebk.com/i/items/hram/altar_sub.png';top.hic();" style="cursor:pointer;"> -->
                    <div style="position:relative; width: 590px;" id="ione">
                    	<?php if( date('H') >= 22 || date('H') < 6 ) { ?>
                    		<img oncontextmenu="return false;" ondragstart="return false" src="http://img.likebk.com/loca/cpnews/night/cplikebk_night.jpg" id="img_ione" width="590" height="250"  border="1"/>
	                    <?php }else{ ?>
                    		<img oncontextmenu="return false;" ondragstart="return false" src="http://img.likebk.com/loca/cpnews/day/cplikebk.jpg" id="img_ione" width="590" height="250"  border="1"/>
                    	<?php } ?>
                    	<!-- Бойцовский клуб -->
                    	<!-- onmouseover="this.src='http://img.likebk.com/loca/cpnews/';"  onmouseout="this.src='http://img.likebk.com/loca/cpnews/';" -->
                    	<div style="cursor: pointer; position: absolute; left: 163px; top: 20px; width: 304px; height: 168px; z-index: 90;">
                    		<img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('day/bk_b.png','day/bk.png','1.180.0.3'); ?> src="http://img.likebk.com/loca/cpnews/day/bk.png" width="304" height="168" title="" class="aFilter" /></div>
                    	<!-- Коммисионка -->
                    	<div style="cursor: pointer; position: absolute; left: 35px; top: 130px; width: 83px; height: 80px; z-index: 90;">
                    		<img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('day/commision_b.png','day/commision.png','1.180.0.272'); ?> src="http://img.likebk.com/loca/cpnews/day/commision.png" width="83" height="80" title="" class="aFilter" /></div>	
                    	<!-- Гос маг -->
                    	<div style="cursor: pointer; position: absolute; left: 95px; top: 155px; width: 97px; height: 70px; z-index: 90;">
                    		<img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('day/shop_b.png','day/shop.png','1.180.0.10'); ?> src="http://img.likebk.com/loca/cpnews/day/shop.png" width="97" height="70" title="" class="aFilter" /></div>	
                    	<!-- Мастерская -->
                    	<div style="cursor: pointer; position: absolute; left: 180px; top: 130px; width: 94px; height: 72px; z-index: 90;">
                    		<img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('day/remont_b.png','day/remont.png','1.180.0.210'); ?> src="http://img.likebk.com/loca/cpnews/day/remont.png" width="94" height="72" title="" class="aFilter" /></div>
                    	<!-- Березка -->
                    	<div style="cursor: pointer; position: absolute; left: 365px; top: 117px; width: 92px; height: 99px; z-index: 90;">
                    		<img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('day/berezka_b.png','day/berezka.png','1.180.0.13'); ?> src="http://img.likebk.com/loca/cpnews/day/berezka.png" width="92" height="99" title="" class="aFilter" /></div>
                    	<? /*if ( date('m') == '09' || date('m') == '08' ) { ?>
                        <!-- Шейла -->                    	
                        <div style="cursor: pointer; position: absolute; left: 316px; top: 172px; width: 30px; height: 48px; z-index: 90;">
                    		<a href="main.php?talk=4"><img onMouseOver="top.hi(this,'Поговорить с &quot;<b>Шейла</b>&quot;',event,2,1,1,1,'');" onMouseOut="top.hic();" oncontextmenu="return false;" ondragstart="return false" src="http://img.likebk.com/ab_iz_npc.gif" width="30" height="48" title="" class="aFilter" /></a></div>
                    	<? }*/ ?>
        				<? if( date('d.m') == '30.10' || date('d.m') == '31.10' || (date('m') == 11 && date('d') < 14) ) { /* Хэллоуин */ ?>
        				<div style="cursor:pointer;position: absolute; left: 198px; top: 189px; width: 32px; height: 43px; z-index: 91;"><img onclick="location.href='main.php?talk=5'" title="Диалог с светильником Джека" src="http://img.likebk.com/loca/cp11/sun_pmd.gif" width="32" height="43" class="aFilter" /></div>
        				<? }
						
						if( date('m') == 2 && date('d') > 21 ) {
						?>
                        <div style="cursor: pointer; position: absolute; left: 192px; top: 178px; width: 32px; height: 43px; z-index: 91;"><img onclick="location.href='/23ov.php'" title="Прорыв Общего Врага" src="http://img.likebk.com/23ov.gif" width="50" height="50" class="aFilter" /></div>
                        <?
						}
						
						if(isset($test['id'])) {						
							//if( $u->info['admin'] > 0 ) {
							?>
							<script>
							function anm1a() {
								$('#anm1').animate({'opacity':0.50},1000).animate({'opacity':0.8},1000);
								$('#anm2').animate({'opacity':1},500).animate({'opacity':0.25},1500);
							}
							function goport2() {
								$('#anm1').hide(1000);
								$('#anm2').hide(1500);
								setTimeout(function(){
									location.href = '/main.php';
								},3000);
							}
							</script>
							<div style="cursor: pointer; position: absolute; left: 162px; top: 158px; width: 32px; height: 43px; z-index: 92;"><img id="anm1" onclick="location.href='/main.php?goportalqst=<?=$test['id']?>&sd5=<?=$keytest?>'" title="Портал в другое измерение (Осталось: <?=$u->timeOut($test['time']-time())?>)" src="http://img.likebk.com/i/portal18_1.png" width="75" height="75" class="aFilter" /></div>
							<div style="cursor: pointer; position: absolute; left: 162px; top: 158px; width: 32px; height: 43px; z-index: 91;"><img id="anm2" src="http://img.likebk.com/i/portal18_0.png" width="75" height="75" class="aFilter" /></div>
							<script>
							anm1a();
							setInterval('anm1a()',2018);
							<? if( $port1 == true ) { ?>
							goport2();
							<? } ?>
							</script>
							<?
							//}
						}
						
						if( (date('m') == 4 && date('d') <= 5) ) {
						?>
                        <div style="cursor: pointer; position: absolute; left: 259px; top: 169px; width: 32px; height: 43px; z-index: 91;"><img onclick="location.href='/1ap.php'" title="Розыгрыш Рауля!" src="http://img.likebk.com/1ap.gif" width="60" height="60" class="aFilter" /></div>
                        <?
						}
												
						if( (date('m') == 3 && date('d') >= 6 && date('d') <= 13) ) {
						?>
                        <div style="cursor: pointer; position: absolute; left: 259px; top: 169px; width: 32px; height: 43px; z-index: 91;"><img onclick="location.href='/8mr.php'" title="Портал Кассандры" src="http://img.likebk.com/8mr.gif" width="50" height="50" class="aFilter" /></div>
                        <?
						}
						
						if( (date('m') == 12 && date('d') >= 20) || $u->info['admin'] > 0 ) {
							 //Стелла выбора
						?>
					  <div style="position: absolute; left: 335px; cursor: pointer; top: 171px; width: 32px; height: 43px; z-index: 92;"><img src="http://img.likebk.com/stellav.gif" width="50" height="60" title="Стелла Выбора" onclick="location.href='stella.php'" class="aFilter" /></div>
						<?
                         }
						
						if( $u->info['id'] == 12345 ) {
						?>
                      <div style="position: absolute; left: 222px; cursor: pointer; top: 150px; width: 32px; height: 43px; z-index: 105;"><a href="/happy.php"><img src="http://img.likebk.com/1y_2017_<?=$u->info['sex']?>.png" title="Празднование трехлетия ЛайкБК!
<? if($u->info['sex'] == 0) { echo 'Диалог с Кассией'; }else{ echo 'Диалог с Варианом'; } ?>" width="46" height="84" title="" class="aFilter" /></a></div>
                        <?
						}
						
						if( date('m') >= 2 || $u->info['id'] == 12345 ) {
						/*?>
                        <div style="position: absolute; left: 437px; cursor: pointer; top: 164px; width: 32px; height: 43px; z-index: 92;"><img <? thisInfRm('1.180.0.417'); ?> src="http://img.likebk.com/osenshop.png" width="50" height="64" title="" class="aFilter" /></div>
                        <?*/
						?>
                        <div style="position: absolute; left: 437px; cursor: pointer; top: 164px; width: 32px; height: 43px; z-index: 92;"><img <? thisInfRm('1.180.0.417'); ?> src="http://img.likebk.com/osenshop.png" width="50" height="64" title="" class="aFilter" /></div>
                        <?
						}
						
						
						
						if( date('m') == 12 || date('m') < 1 ) {
							 //Елка НГ
						?>
					  <div style="position: absolute; left: 256px; cursor: pointer; top: 146px; width: 32px; height: 43px; z-index: 91;"><img <? thisInfRm('1.180.0.208'); ?> src="http://img.likebk.com/newyear2014.png" width="60" height="90" title="" class="aFilter" /></div>
						<?
                         }
						
						 ?>
                         
                        
                      <!-- Почта -->
                    	<div style="cursor: pointer; position: absolute; left: 455px; top: 105px; width: 83px; height: 99px; z-index: 89;">
                    		<img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('day/post_b.png','day/post.png','1.180.0.226'); ?> src="http://img.likebk.com/loca/cpnews/day/post.png" width="83" height="99" title="" class="aFilter" /></div>
                    	<?php /*//if($u->info['id'] == 155){ ?>
                    	<div style="cursor: pointer;position: absolute;left: 247px;bottom: 27px;width: 70px;height: 57px;">
                    			<img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('day/fontan.png','day/fontan.png','1.180.0.1206'); ?> src="http://img.likebk.com/loca/cpnews/day/fontan.png" width="70" height="57" title="" class="aFilter2"/>
                    	</div>
                		<?php //} */
                		if( date('H') >= 22 || date('H') < 6 ) { ?>
                			<!-- вправо -->
	                    	<div style="cursor: pointer; position: absolute; right: 0px; top: 155px; width: 76px; height: 74px; z-index: 92;">
	                    		<img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('cp_str/right_b_night.png','cp_str/right_night.png','1.180.0.11'); ?> src="http://img.likebk.com/loca/cpnews/cp_str/right_night.png" width="76" height="74" title="" /></div>
	                      	<!-- влево -->
	                      	<div style="cursor: pointer; position: absolute; left: 4px; top: 155px; width: 69px; height: 74px; z-index: 92;">
	                      		<img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('cp_str/left_b_night.png','cp_str/left_night.png','1.180.0.323'); ?> src="http://img.likebk.com/loca/cpnews/cp_str/left_night.png" width="69" height="74" title="" /></div>
                		<?php }else{ ?>
	                    	<!-- вправо -->
	                    	<div style="cursor: pointer; position: absolute; right: 1px; top: 157px; width: 66px; height: 72px; z-index: 92;">
	                    		<img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('cp_str/right_b.png','cp_str/right.png','1.180.0.11'); ?> src="http://img.likebk.com/loca/cpnews/cp_str/right.png" width="66" height="72" title="" class="aFilter" /></div>
	                      	<!-- влево -->
	                      	<div style="cursor: pointer; position: absolute; left: 5px; top: 156px; width: 60px; height: 73px; z-index: 92;">
	                      		<img oncontextmenu="return false;" ondragstart="return false" <? thisInfRm_cp('cp_str/left_b.png','cp_str/left.png','1.180.0.323'); ?> src="http://img.likebk.com/loca/cpnews/cp_str/left.png" width="60" height="73" title="" class="aFilter" /></div>
                    	<?php }?>
                        <div id="snow"></div>
                    	<div style="cursor: pointer; position:absolute; top:3px; z-index:101; right:15px; width:80px;">
                      			<? echo $goline; ?>
                  		</div>
                  		<div id="buttons_on_image" style="cursor:pointer; position:absolute; bottom:-10px; right:55px; font-weight:bold; color:#D8D8D8; font-size:10px;">
                     	 <?
            //if($u->info['admin'] > 0){
            	echo '<a style="color:#fff; cursor:pointer;display: block; width: 55px; height: 15px;    position: absolute;top: 12px;left: -70px;" onclick="window.open(\'/help/cp.html\', \'help\', \'height=500,width=800,location=no,menubar=no,status=no,toolbar=no,scrollbars=yes\')">Подсказка</a> &nbsp; ';
            //}
						 //if( date('H') >= 22 || date('H') < 6 ) {
							 echo '<a style="color:#D8D8D8; cursor:pointer;display: block; width: 55px; height: 15px;" onclick="top.useMagic(\'Нападение на персонажа\',\'night_atack\',\'pal_button8.gif\',1,\'main.php?nightatack=1\');"></a> &nbsp; ';
						 //}
						 ?>
                         <!-- <a style="color:#D8D8D8" href="http://forum.likebk.com/" target="_blank">Форум</a> -->
                      </div>
                    </div>
                      <!-- -->
                      <?
					  //Праздничные здания
					  //if($u->info['admin'] > 0 ) {
						  //Хэллоуин
						  if( (date('m') == 11 && date('d') <= 6) || (date('m') == 10 && date('d') == 31) ) {
						?>
                        <?  
						  }
					  //}
					  ?>
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
        <?
		
		if( $c['exp2cp'] > 0 ) {
			
			$efft = mysql_fetch_array(mysql_query('SELECT * FROM `eff_users` WHERE `delete` = 0 AND `uid` = "'.$u->info['id'].'" AND `id_eff` = "507" LIMIT 1'));
			if(isset($efft['id'])) {
				
			}elseif(isset($_GET['addbonusexp'])) {
				mysql_query('INSERT INTO `eff_users` (`id_eff`,`uid`,`timeUse`,`data`,`overType`,`name`,`no_Ace`) VALUES ("507","'.$u->info['id'].'","'.time().'","add_exp2='.$c['exp2cp'].'","778","Летний бонус опыта","1")');
			}else{			
			?>Бонусные касты: 
            	<a href="/main.php?addbonusexp=1"><img style="vertical-align:middle" title="Получить дополнительный опыт +<?=$c['exp2cp']?>% на 3 часа!" src="http://img.likebk.com/i/eff/vesna.gif"></a>
            <?
			}
		}
		
		function testMonster( $mon , $type ) {
			$r = true;
			if(isset($mon['id'])) {
				//
				if($type == 'start') {
					//День недели
					if( $mon['start_day'] != -1 ) {
						if( ($mon['start_day'] < 7 && $mon['start_day'] != date('w')) || $mon['start_day'] != 7 ) {
							$r = false;
						}
					}
					//Число
					if( $mon['start_dd'] != -1 ) {
						if( $mon['start_dd'] != date('j') ) {
							$r = false;
						}
					}
					//месяц
					if( $mon['start_mm'] != -1 ) {
						if( $mon['start_mm'] != date('n') ) {
							$r = false;
						}
					}
					//час
					if( $mon['start_hh'] != -1 ) {
						if( $mon['start_hh'] != date('G') ) {
							$r = false;
						}
						if( $mon['start_min'] != -1 ) {
							if( $mon['start_min'] < (int)date('i') ) {
								$r = false;
							}
						}
					}
				}elseif($type == 'back') {
					//День недели
					if( $mon['back_day'] != -1 ) {
						if( ($mon['back_day'] < 7 && $mon['back_day'] != date('w')) || $mon['back_day'] != 7 ) {
							$r = false;
						}
					}
					//Число
					if( $mon['back_dd'] != -1 ) {
						if( $mon['back_dd'] != date('j') ) {
							$r = false;
						}
					}
					//месяц
					if( $mon['back_mm'] != -1 ) {
						if( $mon['back_mm'] != date('n') ) {
							$r = false;
						}
					}
					//час
					if( $mon['back_hh'] != -1 ) {
						if( $mon['back_hh'] != date('G') ) {
							$r = false;
						}
						if( $mon['back_min'] != -1 ) {
							if( $mon['back_min'] < (int)date('i') ) {
								$r = false;
							}
						}
					}
				}else{
					//что-то другое
					$r = false;
				}
				//
			}
			return $r;
		}

		// echo '<font color=red><b>Расписание атак монстров:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></font><br>';
		/*$sp = mysql_query('SELECT * FROM `aaa_monsters` ORDER BY `start_hh`');
		while( $pl = mysql_fetch_array($sp) ) {
			$btc = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `id` = "'.$pl['uid'].'" LIMIT 1'));
			if( isset($btc['id']) ) {
				if( testMonster($pl,'start') == true ) {
					echo '<a href="/inf.php?'.$btc['id'].'" target="_blank">'.$btc['login'].'</a> появится через <b>Уже был!</b><br>';
				}else{
					if( $pl['start_hh'] != -1 ) {
						if ($pl['start_mm'] == - 1 ) { 
							$pl['start_mm'] = '00';
						}
						echo '<a href="/inf.php?'.$btc['id'].'" target="_blank">'.$btc['login'].'</a> появится в '.$pl['start_hh'].':'.$pl['start_mm'].'<br>';
					}
				}
			}
		}*/
		echo '';
		
		if( date('m') == '01' || date('m') == '02' ) {
			$test = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `uid` = "'.$u->info['id'].'" AND `item_id` = "998" AND `delete` = 0 LIMIT 1'));
			if(!isset($test['id'])) {
				if(isset($_GET['takevarishki'])) {
					$i3 = $u->addItem(998,$u->info['id'],'|nosale=1|noremont=1');
					if($i3 > 0) {
						mysql_query('UPDATE `items_users` SET `gift` = "Администрация" WHERE `id` = "'.$i3.'" LIMIT 1');
					}
					echo '<font color="red"><b>Вы успешно забрали предмет &quot;Варежки&quot;. Он находится у вас в инвентаре.</b></font>';
				}else{
					echo '<br><br>Новогодний подарок:<br><a href="?takevarishki">Забрать варежки<br><img src="http://img.likebk.com/i/items/naruchi87.gif" style="padding-right:21px"></a>';
				}
			}
		}
		
		?>
        <HR>
       <? echo $rowonmax; ?><BR>
        
      </div></td>
  </tr>
</table>
<?

if(isset($_GET['showportal1']) && isset($keytest)) {
	echo "<script>$('#anm1').hide();$('#anm2').hide();$('#anm1').show(750);$('#anm2').show(1500);</script>";
}

}

?>