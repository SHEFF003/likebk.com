<?
if(!defined('GAME'))
{
	die();
}
$tattack = '';

if($u->room['file']=='cp')
{
	if(date("H")>=6 && date("H")<22) {
		$now = '';
	}else{
		$now = 'night';
	}
?>
<script>
<?
if(date("H")<6 || date("H")>=22) 
{
?>
function AtackNoWindow()
{
	var dt = document.getElementById('atackDiv');
	if(dt.style.display=='none')
	{
		dt.style.display = '';
	}else{
		dt.style.display = 'none';
	}
}
<?
}
?>
var no = 20; // snow number
var speed = 15; // smaller number moves the snow faster
var sp_rel = 1.4; //speed relevation
var snowflake1 = "http://img.likebk.com/i/itimeges/snow1.gif";
var snowflake2 = "http://img.likebk.com/i/itimeges/snow2.gif";
 
var i, doc_width, doc_height;

dx = new Array();
xp = new Array();
yp = new Array();
am = new Array();
stx = new Array();
sty = new Array();

Array.prototype.exists = function(el)
{
    for(var i=0;i<this.length;i++)
	if(this[i]==el)
	    return true;
    return false;	
}

var rooms = ['0','1'];

function SetVariable(c) {
	dx[c] = 0;                        // set coordinate variables
	am[c] = Math.random()*15;         // set amplitude variables
	xp[c] = Math.random()*(doc_width-35) + 0 + am[c];  // set position variables
	yp[c] = 0;
	stx[c] = 0.02 + Math.random()/10; // set step variables
	sty[c] = 0.7 + Math.random();     // set step variables
}

function DrawWeather(room) {
  
    doc_width = document.getElementById('img_ione').width;
    doc_height = document.getElementById('img_ione').height;
    
	var div = '';
	for (i = 0; i < no; ++ i) {  
		SetVariable(i);
		div += "<div id=\"dot"+ i +"\" style=\"POSITION: absolute; Z-INDEX: 30" + i +"; VISIBILITY: visible; TOP: " + 0 + "px; LEFT: " + 0 + "px;\"><img id=\"im"+ i +"\" src=\"" + (sty[i]<sp_rel ? snowflake2 : snowflake1 ) + "\" border=\"0\" alt=\"Снежинка\"></div>";
	}
	
	document.getElementById('snow').innerHTML = div;	
	return 1;
}

function WeatherBegin() {  // IE main animation function
    
    for (i = 0; i < no; ++ i) {  // iterate for every dot
        yp[i] += sty[i] < sp_rel ? sty[i]/2 : sty[i];
        if (yp[i] > doc_height-40) {
            SetVariable(i);
            var im = document.getElementById('im'+i);
            im.src = (sty[i] < sp_rel) ? snowflake2 : snowflake1;
        }
        dx[i] += stx[i];
        document.getElementById('dot'+i).style.top = yp[i];
        document.getElementById('dot'+i).style.left = xp[i] +  am[i]*Math.sin(dx[i]);
    }
    setTimeout('WeatherBegin()', speed);
}


</script>
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
                      <img src="http://img.likebk.com/i/images/300x225/capital/<? echo $now; ?>/city_capres1.jpg" alt="" name="img_ione" width="500" height="268" border="1" id="img_ione"/>
                      <div id="buttons_on_image" style="cursor:pointer; font-weight:bold; color:#D8D8D8; font-size:10px;">
                          <? echo $tattack; ?>
                          &nbsp;
                          <span onMouseMove="this.runtimeStyle.color = 'white';" onMouseOut="this.runtimeStyle.color = this.parentElement.style.color;" onclick="window.open('http://forum.<? echo $c['host']; ?>/', 'forum', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')">Форум</span> &nbsp;
                      </div>
                      <script language="javascript" type="text/javascript">
                        <!--
                        if(document.getElementById('ione'))
                        {
                            document.getElementById('ione').appendChild(document.getElementById('buttons_on_image'));
                            document.getElementById('buttons_on_image').style.position = 'absolute';
                            document.getElementById('buttons_on_image').style.bottom = '8px';
                            document.getElementById('buttons_on_image').style.right = '23px';
                        }else{
                            document.getElementById('buttons_on_image').style.display = 'none';
                        }
                        -->
                      </script>			
                        <div style="position:absolute; left:142px; top:17px; width:236px; height:157px; z-index:90;"><img <? thisInfRm('1.180.0.3'); ?> src="http://img.likebk.com/i/images/300x225/capital/2klub.gif" width="236" height="157"  class="aFilter" /></div>    
                                 
                        <div style="position:absolute; left:157px; top:135px; width:73px; height:47px; z-index:91;"><img  <? thisInfRm('1.180.0.10'); ?> src="http://img.likebk.com/i/images/300x225/capital/2shop.gif" width="73" height="47"  class="aFilter" /></div>
        
                        <div style="position:absolute; left:42px; top:125px; width:48px; height:36px; z-index:91;"><img   <? thisInfRm('1.180.0.x'); ?> src="http://img.likebk.com/i/images/300x225/Kep1.gif" width="70" height="60"  class="aFilter" /></div>
        
                        <div style="position:absolute; left:213px; top:140px; width:71px; height:45px; z-index:91;"><img  <? thisInfRm('1.180.0.x'); ?> src="http://img.likebk.com/i/images/300x225/capital/2remont.gif" width="71" height="45"  class="aFilter" /></div>
        
                        <div style="position:absolute; left:262px; top:168px; width:79px; height:88px; z-index:93;"><img  <? thisInfRm('1.180.0.x'); ?> src="http://img.likebk.com/i/images/300x225/Kep2.gif" width="70" height="60" /></div>
        
                        <div style="position:absolute; left:300px; top:130px; width:111px; height:72px; z-index:92;"><img <? thisInfRm('1.180.0.x'); ?> src="http://img.likebk.com/i/images/300x225/Kep3.gif" width="70" height="60" class="aFilter" /></div>
        
                        <div style="position:absolute; left:73px; top:135px; width:92px; height:62px; z-index:92;"><img  <? thisInfRm('1.180.0.x'); ?>  onclick="alert('Не работает. Находится на реконструкции.')"  onMouseOver="this.className='aFilterhover';" onMouseOut="this.className='aFilter';" src="http://img.likebk.com/i/images/300x225/Kep4.gif" width="70" height="60" class="aFilter" /></div>
                        
                        <!-- <div style="position:absolute; left:166px; top:149px; width:27px; height:55px; z-index:99;"><img  src="http://img.likebk.com/i/images/300x225/capital/2pm.gif" width="27" height="55" title="Памятник Мироздателю" /></div> -->
        
                        <!-- <div style="position:absolute; left:100px; top:146px; width:75px; height:90px; z-index:99;"><img src="http://img.likebk.com/i/images/300x225/capital/stellav.gif" width="75" height="90" title="Стела выбора" class="aFilter" /></div> -->
        
                        <div style="position:absolute; left:446px; top:153px; width:30px; height:54px; z-index:94;"><img <? thisInfRm('1.180.0.11'); ?> src="http://img.likebk.com/i/images/300x225/capital/2strelka.gif" width="30" height="54" title="Страшилкина улица" class="aFilter" /></div>
        
                        <div style="position:absolute; left:16px; top:155px; width:30px; height:54px; z-index:910;"><img  src="http://img.likebk.com/i/images/300x225/capital/3strelka.gif" width="30" height="53" title="Парк развлечений" /></div>
                        <div id="snow"></div>
                        <? echo $goline; ?>
                      </div>
                    </td>
                  </tr>
                </table> 
<?
if(date("H")<6 || date("H")>=22) 
{
?>
                <div align="center" id="atackDiv" style="display:none;">
                   <form method="post" action="main.php">
                   <table width="300" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><div style="width:300px; padding:3px; margin:7px; background-color:#CCCCCC; border:1px solid #575757;"> Введите логин жертвы:<br />
                            <input name="atack" type="text" id="atack" size="35" maxlength="30" />
                            <input type="submit" name="button" id="button" class="btn" value="OK" />
                      </div></td>
                    </tr>
                  </table>                 
                  </form>
                </div> 
<?
}
?>
              <div style="display:none; height:0px " id="moveto"></div>
              <div align="right" style="padding: 3px;"><small>&laquo;<? echo $c['title3']; ?>&raquo; приветствует Вас, <b><? echo $u->info['login']; ?></b>.<br />
              </small></div></td>
          <td>
              <!-- <br /><span class="menutop"><nobr>Комната для новичков</nobr></span>-->
          </td>
        </tr>
      </table>
      	<small>
        <HR>
        <? $hgo = $u->testHome(); if(!isset($hgo['id'])){ ?><INPUT onclick="location.href='main.php?homeworld=<? echo $code; ?>';" class="btn" value="Возврат" type="button" name="combats2"><? } unset($hgo); ?>
        <INPUT id="forum" class="btn" onclick="window.open('http://<? echo $c['forum']; ?>/', 'forum', 'location=yes,menubar=yes,status=yes,resizable=yes,toolbar=yes,scrollbars=yes,scrollbars=yes')" value="Форум" type="button" name="forum">
          <!-- <INPUT class="btn" onclick="window.open('/encicl/help/top1.html', 'help', 'height=300,width=500,location=no,menubar=no,status=no,toolbar=no,scrollbars=yes')" value="Подсказка" type="button"> -->
          <!-- <INPUT class="btn" value="Объекты" type="button"> -->
        <br />
       <? echo $rowonmax; ?><BR>
        
      </div></td>
  </tr>
</table>
<?
}

?>