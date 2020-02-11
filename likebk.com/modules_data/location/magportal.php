<?
if( !defined('GAME') ) { die(); }
if( $u->room['file'] == 'magportal' ) {
    //if($u->info['admin'] == 1)
    if( $u->info['id'] == 33944649 && isset($_POST['p1']) ) {
		die('Пожизненный запрет похода в пещеры.');
	}elseif(isset($_POST['p1'])) {
		
		$tst = mysql_fetch_array(mysql_query('SELECT * FROM `dng_way` WHERE `uid` = "'.$u->info['id'].'" LIMIT 1'));
		
		if($u->info['id'] == 27211857 && ($_POST['p1'] == 'Потерянный Вход' || $_POST['p1'] == 'Туманные Низины') ) {
			unset($tst);
		}
		
		$tstno = array(
			5104553 => 1 , 18483096 => 1 , 18532879 => 1 , 27211857 => 1 , 60152772 => 1 , 21596721 => 1 , 15466598 => 1 , 3359024 => 1 , 117308950 => 1 , 502028 => 1
		);
		
		if(isset($tst['id']) && !isset($tstno[$u->info['id']])){
			die('Использование посторонних программ, выход через комм. отдел.');
		}elseif($_POST['p1'] == 'Подземелье Драконов') {
			mysql_query('UPDATE `users` SET `room` = "369" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			die('<script>location="main.php";</script>');
		}elseif($_POST['p1'] == 'Пещера Тысячи Проклятий') {
			mysql_query('UPDATE `users` SET `room` = "372" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			die('<script>location="main.php";</script>');
		}elseif($_POST['p1'] == 'Бездна') {
			mysql_query('UPDATE `users` SET `room` = "354" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			die('<script>location="main.php";</script>');
		}elseif($_POST['p1'] == 'Канализация' && $u->info['admin'] > 0) {
			mysql_query('UPDATE `users` SET `room` = "188" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			die('<script>location="main.php";</script>');
		}elseif($_POST['p1'] == 'Катакомбы') {
			mysql_query('UPDATE `users` SET `room` = "293" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			die('<script>location="main.php";</script>');
		}elseif($_POST['p1'] == 'catacombs_new' ) {
			mysql_query('UPDATE `users` SET `room` = "378" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			die('<script>location="main.php";</script>');
		}elseif($_POST['p1'] == 'Пещеры Мглы' && true == false) {
			mysql_query('UPDATE `users` SET `room` = "380" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			die('<script>location="main.php";</script>');
		}elseif($_POST['p1'] == 'Тестовая локация' && $u->info['admin'] > 0) {
			mysql_query('UPDATE `users` SET `room` = "383" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			die('<script>location="main.php";</script>');
		}elseif($_POST['p1'] == 'Грибница') {
			mysql_query('UPDATE `users` SET `room` = "18" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			die('<script>location="main.php";</script>');
		}elseif($_POST['p1'] == 'Туманные Низины') {
			mysql_query('UPDATE `users` SET `room` = "200" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			die('<script>location="main.php";</script>');
		}elseif($_POST['p1'] == 'Потерянный Вход') {
			mysql_query('UPDATE `users` SET `room` = "422" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			die('<script>location="main.php";</script>');
		}elseif($_POST['p1'] == 'Излом') {
			mysql_query('UPDATE `users` SET `room` = "269" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
			die('<script>location="main.php";</script>');
		}elseif($_POST['p1'] == 'Гора Легиона') {
			if( $u->info['level'] < 11 && $u->info['admin'] == 0 ) {
				echo '<div><font color=red><b>Пещера доступна с 11-го уровня!</b></font></div>';
			}else{
				mysql_query('UPDATE `users` SET `room` = "275" WHERE `id` = "'.$u->info['id'].'" LIMIT 1');
				die('<script>location="main.php";</script>');
			}
		}
    }
?>
<style>
body {
	background-color:#E2E2E2;
	background-image: url(http://img.likebk.com/i/misc/showitems/dungeon.jpg);
	background-repeat:no-repeat;background-position:top right;
}
#form1 label {
    padding:3px 0px;
    display:inline-block;
}
#form1 label > img {
    margin:0px 5px 0px 2px;
}
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div style="padding-left:0px;" align="center">
      <h3><? echo $u->room['name']; ?></h3>
    </div></td>
    <td width="200"><div align="right">
      <table cellspacing="0" cellpadding="0">
        <tr>
          <td width="100%">&nbsp;</td>
          <td><table  border="0" cellpadding="0" cellspacing="0">
              <tr align="right" valign="top">
                <td><!-- -->
                    <? echo $goLis; ?>
                    <!-- -->
                    <table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td nowrap="nowrap"><table width="100%"  border="0" cellpadding="0" cellspacing="1" bgcolor="#DEDEDE">
                            <tr>
                              <td bgcolor="#D3D3D3"><img src="http://img.likebk.com/i/move/links.gif" width="9" height="7" /></td>
                              <td bgcolor="#D3D3D3" nowrap="nowrap"><a href="#" id="greyText" class="menutop" onclick="location='main.php?loc=1.180.0.213&rnd=<? echo $code; ?>';" title="<? thisInfRm('1.180.0.213',1); ?>">Восточная окраина</a></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table></td>
              </tr>
          </table></td>
        </tr>
      </table>
      </div></td>
  </tr>
</table>

<form id="form1" name="form1" method="post" action="main.php?go_psh=1">
	<fieldset>
	<legend><B>Вы можете телепортироваться в любую из пещер:</B></legend>
	<table width="100%" border="0" cellspacing="0" cellpadding="10"> 
		<tr>
		<td>
		  <p>
			  <!-- <label>
			    <input type="radio" name="p1" value="Канализация" id="p1_5" />
			    <img src="http://img.likebk.com/i/city_ico2/dreamscity.gif" width="33" height="19" style="vertical-align:bottom" />Канализация</label>
			  <br/> -->
			  
			  <label>
			    <input name="p1" type="radio" id="p1_1" value="Бездна" />
			    <img src="http://img.likebk.com/i/city_ico2/angelscity.gif" width="33" height="19" style="vertical-align:bottom" />Бездна</label>
			  <br />
			  
			   <label>
			    <input name="p1" type="radio" id="p1_1" value="Туманные Низины" />
			    <img src="http://img.likebk.com/i/city_ico2/devilscity.gif" width="33" height="19" style="vertical-align:bottom" />Туманные Низины</label>
			  <br />
			  
			   <label>
			    <input name="p1" type="radio" id="p1_1" value="Потерянный Вход" />
			    <img src="http://img.likebk.com/i/city_ico2/emeraldscity.gif" width="33" height="19" style="vertical-align:bottom" />Потерянный Вход</label>
			  <br />
			  
			  <label>
			    <input name="p1" type="radio" id="p1_0" value="Пещера Тысячи Проклятий" />
			    <img src="http://img.likebk.com/i/city_ico2/mooncity.gif" width="33" height="19" style="vertical-align:bottom" />Пещера Тысячи Проклятий</label>
			  <br />
			  
			  <label>
			    <input name="p1" type="radio" id="p1_3" value="Катакомбы" />
			    <img src="http://img.likebk.com/i/city_ico2/demonscity.gif" width="33" height="19" style="vertical-align:bottom" />Катакомбы</label>
			  <br /><label>
			    <input type="radio" name="p1" value="Грибница" id="p1_11" />
			    <img src="http://img.likebk.com/i/city_ico2/suncity.gif" width="33" height="19" style="vertical-align:bottom" />Грибница</label>
				<br /> 
				
			  
			  <label>
			    <input name="p1" type="radio" id="p1_0" value="Подземелье Драконов" />
			    <img src="http://img.likebk.com/labaico.gif" width="33" height="19" style="vertical-align:bottom" />Подземелье Драконов</label>
			  <br /> 
			  <label>
			  	<input name="p1" type="radio" id="p1_3" value="Излом" />
			  	<img src="http://img.likebk.com/i/city_ico2/abandonedplain.gif" width="33" height="19" style="vertical-align:bottom" />Излом Хаоса</label>
			  <br /> 
		  	  <?
				$trres = 10000;
				$adres = 0;
				if(isset($_GET['addres'])) {
					$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `id` = "'.mysql_real_escape_string($_GET['resid']).'" AND `uid` = "'.$u->info['id'].'" AND `delete` = 0 LIMIT 1'));
					if(isset($itm['id'])) {
						$itm2 = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$itm['item_id'].'" LIMIT 1'));
						mysql_query('INSERT INTO `stroyka` ( `uid`,`time`,`item_id`,`x`,`zone` ) VALUES (
							"'.$u->info['id'].'","'.time().'","'.$itm['item_id'].'","1","psh13"
						)');
						mysql_query('UPDATE `items_users` SET `delete` = "'.time().'" WHERE `id` = "'.$itm['id'].'" LIMIT 1');
						echo '<div><font color=red><b>Вы успешно пожертвовали &quot;'.$itm2['name'].'&quot; на строительство!</b></font></div>';
					}else{
						echo '<div><font color=red><b>Ресурс не найден!</b></font></div>';
					}
				}
				$html = '';
				/*
				<a href="main.php?addres=13">пожертвовать ресурсы</a>
				*/
				$sp = mysql_fetch_array(mysql_query('SELECT * FROM `items_users` WHERE `delete` = "0" AND `item_id` IN ( SELECT `id` FROM `items_main` WHERE `type` = 32 ) AND `uid` = "'.$u->info['id'].'" ORDER BY RAND()'));
				if(isset($sp['id'])) {
					$itm = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$sp['item_id'].'" LIMIT 1'));
					$html .= '<a href="main.php?addres=13&resid='.$sp['id'].'">пожертвовать &quot;'.$itm['name'].'&quot;</a> (x1) <small><a href="main.php">Выбрать другой ресурс</a></small>';
				}else{
					$html .= '<i>у вас нет подходящих ресурсов</i>';
				}
				$adres = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `stroyka` WHERE `zone` = "psh13" LIMIT 1'));
				$adres = 0 + $adres[0];
			    if( $u->info['admin'] > 0 || $adres >= $trres ) { ?>
              <input type="radio" name="p1" value="Гора Легиона" id="p1_9" />
		  	  <img src="http://img.likebk.com/i/city_ico2/legion.gif" width="33" height="19" style="vertical-align:bottom" /> Гора Легиона</label>
              <?
              	}
				if( $adres < $trres ) {
			  ?>
               <p>
               &nbsp;&nbsp; &nbsp; <img src="http://img.likebk.com/i/city_ico2/legion.gif" width="33" height="19" style="vertical-align:bottom" /> Гора Легиона (Идет строительство: <?=$adres?>/<?=$trres?>, <?=$html?>)
			  </p>
			  <? } ?>
        </p>
		  <p style="margin-bottom:0px;"><input type="submit" name="button" id="button" value="Телепортироваться" /></p>
		</td>
		</tr>
	</table> 
	</fieldset>
	
	<br/><br/>
	<? if($u->info['admin'] > 0) { ?>
	<fieldset>
		<legend><b>Пещеры в работе (Только Админам)</b></legend>
		<table>
			<tr>
				<td>
					<label><input name="p1" type="radio" id="p1_3" value="catacombs_new" /><img src="http://img.likebk.com/i/city_ico2/demonscity.gif" width="33" height="19" style="vertical-align:bottom" />103: Катакомбы (Новые)</label><br /> 
	
					<label><input type="radio" name="p1" value="Грибница" id="p1_6" /><img src="http://img.likebk.com/i/city_ico2/suncity.gif" width="33" height="19" style="vertical-align:bottom" />104: Грибница (Sun City)</label><br />
					<label><input type="radio" name="p1" value="Пещеры Мглы" id="p1_2" /><img src="http://img.likebk.com/i/city_ico2/sandcity.gif" width="33" height="19" style="vertical-align:bottom" />105: Пещеры Мглы (Sand City)</label><br />
					<label><input disabled="disabled" type="radio" name="p1" value="Туманные Низины" id="p1_8" /><img src="http://img.likebk.com/i/city_ico2/devilscity.gif" width="33" height="19" style="vertical-align:bottom" />106: Туманные Низины (Devils City)</label><br />
					<label><input disabled="disabled" type="radio" name="p1" value="Сторожевая Башня" id="p1_7" /><img src="http://img.likebk.com/i/city_ico2/abandonedplain.gif" width="33" height="19" style="vertical-align:bottom" />107: Сторожевая Башня (Abandoned Plain)</label><br />
					<label><input disabled="disabled" type="radio" name="p1" value="Потерянный Вход" id="p1_4" /><img src="http://img.likebk.com/i/city_ico2/emeraldscity.gif" width="33" height="19" style="vertical-align:bottom" />108: Потерянный Вход (Emeralds City)</label><br />
					<label><br />
					<label><input disabled="disabled" type="radio" name="p1" value="Ледяная Пещера" id="p1_10" /><img src="http://img.likebk.com/i/city_ico2/snowcity.gif" width="33" height="19" style="vertical-align:bottom" />111: Ледяная Пещера (Snow City)</label><br/>
					<label><input type="radio" name="p1" value="Тестовая локация" id="p1_10" /><img src="http://img.likebk.com/i/city_ico2/abandonedplain.gif" width="33" height="19" style="vertical-align:bottom" />999: Тестовая локация</label><br/>
					<p style="margin-bottom:0px;"><input type="submit" name="button" id="button" value="Телепортироваться" /></p>
				</td>
			</tr>
		</table>
	</fieldset>
	<? } ?> 
</form>

<? } ?>