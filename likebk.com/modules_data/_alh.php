<?
if(!defined('GAME'))
{
	die();
}
include_once('../_incl_data/__config.php');
include_once('../_incl_data/class/__db_connect.php');
include_once('../_incl_data/class/__user.php');
function kursDolar(){
  $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req='.date('d/m/Y'));
  $kurs = $xml->Valute[9]->Value;
  $res = round(100/$kurs, 2);
  return $res;
}
?>

<SCRIPT>
var nlevel=0;
var from = Array('+', ' ', '#');
var to = Array('%2B', '+', '%23');

function w(login,id,align,klan,level,online,city,battle,dealer){
	var s='';
	if (online!="") {
		if (city!="") {
			s+='<IMG SRC=http://img.likebk.com/1x1.gif WIDTH=20 HEIGHT=15 ALT="В другом городе">';
		} else {
			s+='<a href="javascript:top.chat.addto(\''+login+'\',\'private\');"><IMG SRC=http://img.likebk.com/i/lock.gif WIDTH=20 HEIGHT=15 ALT="Приватно"></a>';
		}
		if (city!="") {
			s+='<img title="'+city+'" src="http://img.likebk.com/i/city_ico/'+city+'.gif" width=17 height=15>';
		}
		
		s+=' <IMG SRC=http://img.likebk.com/i/align/align50.gif WIDTH=12 HEIGHT=15> ';
		
		s+=' <IMG SRC=http://img.likebk.com/i/align/align'+align+'.gif WIDTH=12 HEIGHT=15>';

		if (klan!='') {s+='<A HREF="/encicl/klan/'+klan+'.html" target=_blank><IMG SRC="http://img.likebk.com/i/clan/'+klan+'.gif" WIDTH=24 HEIGHT=15 ALT=""></A>'}
		s+='<a href="javascript:top.chat.addto(\''+login+'\',\'to\');">'+login+'</a>['+level+']<a href=/inf.php?'+id+' target=_blank><IMG SRC=http://img.likebk.com/i/inf_capitalcity.gif WIDTH=12 HEIGHT=11 ALT="Информация о персонаже"></a>';
		if (city!="") {
			s+=" - нет в этом городе";
		} else {
			s+=' - '+online;
		}
	}
	else {
		s+='<IMG SRC="http://img.likebk.com/i/offline.gif" WIDTH=20 HEIGHT=15 BORDER=0 ALT="Нет в клубе">';
		if (city!="") {
			s+='<img title="'+city+'" src="http://img.likebk.com/i/city_ico/'+city+'.gif" width=17 height=15>';
		}
		if (align == "") align="0";
		s+=' <IMG SRC=http://img.likebk.com/i/align/align'+align+'.gif WIDTH=12 HEIGHT=15>';
		if (klan!='') {s+='<A HREF="http://<? echo $c['host']; ?>/encicl/clan/'+klan+'.html" target=_blank><IMG SRC="http://img.likebk.com/i/klan/'+klan+'.gif" WIDTH=24 HEIGHT=15 ALT=""></A>'}
		if (level) {
			if (nlevel==0) {
				nlevel=1; s="<BR>"+s;
			}
			s+='<FONT color=gray><b>'+login+'</b>['+level+']<a href=/inf.php?'+id+' target=_blank><IMG SRC=http://img.likebk.com/i/inf.gif WIDTH=12 HEIGHT=11 ALT="Информация о персонаже"></a> - Нет в клубе';
		} else {
			if (nlevel==1) {
				nlevel=2; s="<BR>"+s;
			}
			mlogin = login;
			for(var i=0;i<from.length;++i) while(mlogin.indexOf(from[i])>=0)  mlogin= mlogin.replace(from[i],to[i]);
			s+='<FONT color=gray><i>'+login+'</i> <a href=/inf.php?login='+mlogin+' target=_blank><IMG SRC=http://img.likebk.com/i/inf_.gif WIDTH=12 HEIGHT=11 ALT="Информация о персонаже"></a> - нет в этом городе';
		}
		s+='</FONT>';

	}
	document.write(s+'<BR>');
}
</SCRIPT>
	<div id="hint4" class="ahint"></div>
	<TABLE cellspacing="0" cellpadding="2" width="100%">
<TR>
<TD style="width: 40%; vertical-align: top; "><br />
<TABLE cellspacing="0" cellpadding="2" style="width: 100%; ">
  <TR>
<TD align="center"><h4>Алхимики</h4></TD>
</TR>
<TR>
<TD bgcolor=efeded nowrap><SCRIPT>
<?
$data = mysql_query("SELECT `dealer`,`id`, `login`, `align`, `level`, `battle`, `online`, `city`, (select `name` from `room` WHERE `id` = users.`room`) as `room` FROM `users` WHERE `dealer` = '1' order by online DESC, login asc;");
$i = 0;
while($a = mysql_fetch_array($data))
{
	if ($a['online']>(time()-120))
	{
		$online = $a['room'];
		$id = $a['id'];
		$level = $a['level'];
		$battle = $a['battle'];
	}elseif($a['online']<(time()-120))
	{
		$online = '';
		$id = '';
		$level = '';
		$battle = '';
	}
	//w(       login,          id,       align,        klan,   level,     online,   city,    battle){
	$citya = $a['city']; 
	if($a['city']==$u->info['city'])
	{
		$citya = '';
	}
	echo 'w("'.$a['login'].'","'.$id.'","'.$a['align'].'","","'.$level.'","'.$online.'","'.$citya.'","'.$battle.'","'.$a['dealer'].'");';
	$i++;
}
$pl = mysql_fetch_array(mysql_query('SELECT * FROM `bank_table` ORDER BY `time` DESC LIMIT 1'));

?>
</SCRIPT>
<TR>
<TD style="text-align: left; "><small>Курс покупки ЕвроКредитов: <b>1</b>ЕКР. = <b><?//=round($pl['cur'],2)?> </b><b>100</b> руб.<br>
  Курс обмена ЕвроКредитов: <b>1</b>ЕКР = <b>350КР</b><br>
  Продают еврокредиты и прочие платные услуги сервиса<BR>
  Вы можете отправить им личное сообщение, даже если Вы и Алхимик находитесь в разных городах</small></div></TD>
</TR>
</TABLE>

<br /><br />

<!--
<table>
      <tr>
        <td valign="top"><fieldset>
          <legend><b>Курс еврокредита к мировой валюте</b> </legend>
          <table width="100%" border="0" cellpadding="2" cellspacing="0">
            
            <tr>
              <td><small>Данные на <b><?=date('d.m.y H:i')?></b> без учета комиссий</small></td>
            </tr>
            
            <tr>
              <td><span><b>1</b>ЕКР = </span><span style="display:inline-block;width:100px"><b><?php echo kursDolar();?>$</b></span></td>
            </tr>
          </table>
        </fieldset></td>
  </tr>
</table>
-->

</TD>
<TD style="width: 5%; vertical-align: top; ">&nbsp;</TD>
<TD style="width: 25%; vertical-align: top; text-align: right; ">
	<INPUT type='button' value='Обновить' onclick='location="/main.php?alh&rnd=<?=$code?>"';'>
&nbsp;<INPUT TYPE=button value="Вернуться" onclick='location="/main.php"'></TD>
</TR>
</TABLE>
<DIV>
<? echo $c['counters']; ?>
</DIV>
