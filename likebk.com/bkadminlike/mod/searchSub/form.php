<?php 
$dbgo = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
mysql_select_db('like_mainbd',$dbgo);
mysql_query('SET NAMES cp1251');
/* $dbgo = mysql_connect('localhost','root','');
mysql_select_db('crazy',$dbgo);
mysql_query('SET NAMES cp1251');*/
 $info = array(
  'exp' => '���������� ���� (%)', 
  'align_bs' => '��������� ������',
  'nopryh' => '������ ���������', 
  'puti'=>'������ �����������',
  'align'=>'����������',
  'hpAll'=>'������� ����� (HP)',
  'mpAll'=>'������� ����',
  'enAll'=>'������� �������',
  'sex'=>'���',
  'lvl'=>'�������',
  's1'=>'����',
  's2'=>'��������',
  's3'=>'��������',
  's4'=>'������������',
  's5'=>'���������',
  's6'=>'��������',
  's7'=>'����������',
  's8'=>'����',
  's9'=>'������� ����',
  's10'=>'��������������',
  's11'=>'�������',
  'm1'=>'��. ������������ ����� (%)',
  'm2'=>'��. ������ ������������ ����� (%)',
  'm3'=>'��. �������� ����. ����� (%)',
  'm4'=>'��. ����������� (%)',
  'm5'=>'��. ������ ����������� (%)',
  'm6'=>'��. ���������� (%)',
  'm7'=>'��. ����������� (%)',
  'm8'=>'��. ����� ����� (%)',
  'm9'=>'��. ����� ������ ����� (%)',
  'm14'=>'��. ���. ������������ ����� (%)',
  'm15'=>'��. ���. ����������� (%)',
  'm16'=>'��. ���. ����������� (%)',
  'm17'=>'��. ���. ���������� (%)',
  'm18'=>'��. ���. ����� ����� (%)',
  'm19'=>'��. ���. ���������� ������ (%)',
  'm20'=>'��. ����� (%)',
  'a1'=>'���������� �������� ������,���������',
   'a2'=>'���������� �������� ��������,��������',
   'a3'=>'���������� �������� ��������,��������',
   'a4'=>'���������� �������� ������',
  'a5'=>'���������� �������� ����������� ��������',
  'a6'=>'���������� �������� ������',
  'a7'=>'���������� �������� ����������',
  'aall'=>'���������� �������� �������',
  'mall'=>'���������� �������� ������ ������',
  'm2all'=>'���������� �������� ������',
  'mg1'=>'���������� �������� ������ ����',
  'mg2'=>'���������� �������� ������ �������',
  'mg3'=>'���������� �������� ������ ����',
  'mg4'=>'���������� �������� ������ �����',
  'mg5'=>'���������� �������� ������ �����',
  'mg6'=>'���������� �������� ������ ����',
  'mg7'=>'���������� �������� ����� ������',
  'tj'=>'������� �����',
  'lh'=>'������ �����',
  'minAtack'=>'����������� ����',
  'maxAtack'=>'������������ ����',
  'm10'=>'��. �������� �����',
  'm11'=>'��. �������� ����� ������',
  'm11a'=>'��. �������� �����',
  'pa1'=>'��. �������� �������� �����',
  'pa2'=>'��. �������� �������� �����',
  'pa3'=>'��. �������� �������� �����',
  'pa4'=>'��. �������� ������� �����',
  'pm1'=>'��. �������� ����� ����',
  'pm2'=>'��. �������� ����� �������',
  'pm3'=>'��. �������� ����� ����',
  'pm4'=>'��. �������� ����� �����',
  'pm5'=>'��. �������� ����� �����',
  'pm6'=>'��. �������� ����� ����',
  'pm7'=>'��. �������� ����� �����',
  'za'=>'������ �� �����',
  'zm'=>'������ �� ����� ������',
  'zma'=>'������ �� �����',
  'za1'=>'������ �� �������� �����',
  'za2'=>'������ �� �������� �����',
  'za3'=>'������ �� ��������� �����',
  'za4'=>'������ �� �������� �����',
  'zm1'=>'������ �� ����� ����',
  'zm2'=>'������ �� ����� �������',
  'zm3'=>'������ �� ����� ����',
  'zm4'=>'������ �� ����� �����',
  'zm5'=>'������ �� ����� �����',
  'zm6'=>'������ �� ����� ����',
  'zm7'=>'������ �� ����� �����',
  'magic_cast'=>'�������������� ���� �� ���',
  'pza'=>'��������� ������ �� �����',
  'pzm'=>'��������� ������ �� �����',
  'pza1'=>'��������� ������ �� �������� �����',
  'min_heal_proc'=>'������ ������� (%)',
  'notravma'=>'������ �� �����',
  'yron_min'=>'����������� ����',
  'yron_max'=>'������������ ����',
  'zaproc'=>'������ �� ����� (%)',
  'zmproc'=>'������ �� ����� ������ (%)',
  'zm2proc'=>'������ �� ����� ������� (%)',
  'pza2'=>'��������� ������ �� �������� �����',
  'pza3'=>'��������� ������ �� ��������� �����',
  'pza4'=>'��������� ������ �� �������� �����',
  'pzm1'=>'��������� ������ �� ����� ����',
  'pzm2'=>'��������� ������ �� ����� �������',
  'pzm3'=>'��������� ������ �� ����� ����',
  'pzm4'=>'��������� ������ �� ����� �����',
  'pzm5'=>'��������� ������ �� ����� �����',
  'pzm6'=>'��������� ������ �� ����� ����',
  'pzm7'=>'��������� ������ �� ����� �����',
  'speedhp'=>'����������� �������� (%)',
  'speedmp'=>'����������� ���� (%)',
  'tya1'=>'������� �����',
  'tya2'=>'������� �����',
  'tya3'=>'�������� �����',
  'tya4'=>'������� �����',
  'tym1'=>'�������� �����',
  'mg2static_points'=>'������� ������ (������)',
  'tym2'=>'������������� �����',
  'tym3'=>'������� �����',
  'tym4'=>'�������� �����',
  'hpProc'=>'������� ����� (%)',
  'mpProc'=>'������� ���� (%)',
  'tym5'=>'����� �����',
  'tym6'=>'����� ����',
  'tym7'=>'����� �����',
  'min_use_mp'=>'��������� ������ ����',
  'pog'=>'���������� �����',
  'pog2'=>'���������� �����',
  'pog2p'=>'������� ���������� �����',
  'pog2mp'=>'���� ���������� �����',
  'maxves'=>'����������� ������',
  'bonusexp'=>'����������� ���������� ����',
  'speeden'=>'����������� ������� (%)',
  'yza' => '���������� ����������� ����� (%)',
  'yzm' => '���������� ����� ������ (%)',
  'yzma' => '���������� ����� (%)',
  'yza1' => '���������� �������� ����� (%)',
  'yza2' => '���������� �������� ����� (%)',
  'yza3' => '���������� ��������� ����� (%)',
  'yza4' => '���������� �������� ����� (%)',
  'yzm1' => '���������� ����� ���� (%)',
  'yzm2' => '���������� ����� ������� (%)',
  'yzm3' => '���������� ����� ���� (%)',
  'yzm4' => '���������� ����� ����� (%)',
  'yzm5' => '���������� ����� (%)',
  'yzm6' => '���������� ����� (%)',
  'yzm7' => '���������� ����� (%)',
  'rep'=> '��������� ������',
  'mib1' => '����������� ����� ������',
  'mab1' => '������������ ����� ������',
  'mib2'=>'����������� ����� �������',
  'mab2'=>'������������ ����� �������',
  'mib3'=>'����������� ����� �����',
  'mab3'=>'������������ ����� �����',
  'mib4'=>'����������� ����� ���',
  'mab4'=>'������������ ����� ���' ,
  'sudba'=>'������� ����� ������ ����� ������� � ������',
  'noremont'=>'������� �� �������� �������',
  'art'=>'��������',
  'complect'=>'��������',
  'mod_lvl'=>'mod_lvl',
  'timeRead'=>'timeRead',
  'usefromfile'=>'usefromfile',
  'nosale'=>'nosale',
  'notransfer'=>'notransfer',
  'nomodif'=>'nomodif',
  'musor'=>'musor',
  'onitm_text'=>'onitm_text',
  'nodelete'=>'nodelete',
  'oneType'=>'oneType',
  'useOnLogin'=>'useOnLogin',
  'onlyOne'=>'onlyOne',
  'srok'=>'srok',
  'pristrastie'=>'pristrastie',
  'nohaos'=>'nohaos',
  'free_stats'=>'free_stats',
  'zona'=>'zona'
); 
$items = array(
          'tr'  => array('sex','align','lvl','s1','s2','s3','s4','s5','s6','s7','s8','s9','s10','s11','a1','a2','a3','a4','a5','a6','a7','mg1','mg2','mg3','mg4','mg5','mg6','mg7','mall','m2all','aall','rep', 'align_bs'),
          'add' => array(
          'exp','enemy_am1','hod_minmana','yhod','noshock_voda',
          'yza','yzm','yzma','yza1','yza2','yza3','yza4','yzm1','yzm2','yzm3','yzm4','yzm5','yzm6','yzm7',
          'notuse_last_pr','yrn_mg_first','antishock','nopryh','speed_dungeon','naemnik','mg2static_points','yrnhealmpprocmg3','nousepriem','notactic','seeAllEff','100proboi1','pog2','pog2p','magic_cast','min_heal_proc','no_yv1','no_krit1','no_krit2','no_contr1','no_contr2','no_bl1','no_pr1','no_yv2','no_bl2','no_pr2','silver','pza','pza1','pza2','pza3','pza4','pzm','pzm1','pzm2','pzm3','pzm4','pzm5','pzm6','pzm7','notravma','min_zonb','min_zona','nokrit','pog','min_use_mp','za1proc','za2proc','za3proc','za4proc','zaproc','zmproc','zm1proc','zm2proc','zm3proc','zm4proc','shopSale','s1','s2','s3','s4','s5','s6','s7','s8','s9','s10','s11','aall','a1','a2','a3','a4','a5','a6','a7','m2all','mall','mg1','mg2','mg3','mg4','mg5','mg6','mg7','hpAll','hpVinos','mpVinos','mpAll','enAll','hpProc','mpProc','m1','m2','m3','m4','m5','m6','m7','m8','m9','m14','m15','m16','m17','m18','m19','m20','pa1','pa2','pa3','pa4','pm1','pm2','pm3','pm4','pm5','pm6','pm7','za','za1','za2','za3','za4','zma','zm','zm1','zm2','zm3','zm4','zm5','zm6','zm7','mib1','mab1','mib2','mab2','mib3','mab3','mib4','mab4','speedhp','speedmp','m10','m11','m11a','zona','zonb','maxves','minAtack','maxAtack','bonusexp','speeden'),
          'sv' => array('yron_min','yron_max','pza','pza1','pza2','pza3','pza4','pzm','pzm1','pzm2','pzm3','pzm4','pzm5','pzm6','pzm7','notravma','min_zonb','min_zona','nokrit','pog','min_use_mp','za1proc','za2proc','za3proc','za4proc','zaproc','zmproc','zm1proc','zm2proc','zm3proc','zm4proc','shopSale','s1','s2','s3','s4','s5','s6','s7','s8','s9','s10','s11','aall','a1','a2','a3','a4','a5','a6','a7','m2all','mall','mg1','mg2','mg3','mg4','mg5','mg6','mg7','hpAll','mpAll','enAll','m1','m2','m3','m4','m5','m6','m7','m8','m9','m14','m15','m16','m17','m18','m19','m20','pa1','pa2','pa3','pa4','pm1','pm2','pm3','pm4','pm5','pm6','pm7','za','za1','za2','za3','za4','zma','zm','zm1','zm2','zm3','zm4','zm5','zm6','zm7','mib1','mab1','mib2','mab2','mib3','mab3','mib4','mab4','speedhp','speedmp','m10','m11','zona','zonb','maxves','minAtack','maxAtack','speeden')
          );
  $id = $_POST['id_sub'];
  $sub_name = mysql_fetch_array(mysql_query('SELECT * FROM `items_main` WHERE `id` = "'.$id.'"'));
  $sub = mysql_fetch_array(mysql_query('SELECT * FROM `items_main_data` WHERE `items_id` = "'.$id.'"'));
  $stats = explode('|', $sub['data']);
  $td = lookStats($sub['data']);
?>  

<div class="left_form">
<div class="save"></div>
 <div id="content">

<div class="img"><img src='http://img.likebk.com/i/items/<?php echo $sub_name['img']?>'></div>
<h3 style="text-align: left;"><?php echo $sub_name['name'];?></h3>
<form  method="post" class="form-update">
<?php
    echo "<span style='font-weight: bold; font-size: 14px;'>����: </span>";
    echo "<div class='rows'><input class='form-control' type='text' name='price1' value='".$sub_name['price1']."'></div>";
  $res ='';
$t = $items['tr'];
$x = 0;
$res .="<h5 style='margin-top: 10px; margin-bottom: 10px;'>��������� �����������:</h5>";
while($x<count($t)){
  $n = $t[$x];
  if(isset($td['tr_'.$n],$info[$n])){
    $z = '+';
    if($td['tr_'.$n]<0){
      $z = '';
    }
    $res .= "<span style='font-weight: bold; font-size: 14px;'>".$info[$n]." :</span>";
    $res .= "<div class='rows'><input class='form-control' type='text' name='"."tr_".$n."' value='".$td['tr_'.$n]."'></div>";
  }
  $x++;
}
$t = $items['add'];
$x = 0;
$res .= "<h5 style='margin-top: 10px; margin-bottom: 10px;'>�������� ��������:</h5>";
while($x<count($t)){
  $n = $t[$x];
  if(isset($td['add_'.$n],$info[$n])){
    $z = '+';
    if($td['add_'.$n]<0){
      $z = '';
    }

    $res .= "<span style='font-weight: bold; font-size: 14px;'>".$info[$n]." :</span>";
    $res .= "<div class='rows'><input class='form-control' type='text' name='"."add_".$n."' value='".$td['add_'.$n]."'></div>";
  }
  $x++;
}
$t = $items['sv'];
$x = 0;
while($x<count($t)){
  $n = $t[$x];
  if(isset($td['sv_'.$n],$info[$n])){
    $z = '+';
    if($td['sv_'.$n]<0){
      $z = '';
    }
    $res .= "<span style='font-weight: bold; font-size: 14px;'>".$info[$n]." :</span>";
    $res .= "<div class='rows'><input class='form-control' type='text' name='"."sv_".$n."' value='".$td['sv_'.$n]."'></div>";
    }
  $x++;
}
$i = 0;
while ($i <= count($stats)) {
  $stats2[$i] = explode("=", $stats[$i]);   
  if($info[$stats2[$i][0]]){
    $res .= "<span style='font-weight: bold; font-size: 14px;'>".$info[$stats2[$i][0]]." :</span>";
    $res .= "<div class='rows'><input class='form-control' type='text' name='".$stats2[$i][0]."' value='".$stats2[$i][1]."'></div>";
    //$_POST[$info[$stats2[$i][0]]]=$stats2[$i][1];
  }
  $i++;
}
echo $res;
    echo "<div class='input_tr' style='none'></div>";
    echo "<div class='input_add' style='none'></div>";
    echo "<div class='input_sv' style='none'></div>";
    echo "<div class='input_hs' style='none'></div>";
?>
<br>
<input type='submit' value='��������' name='test' class='submit btn btn-default'>
</form>
<?php 
  function lookStats($m)
  {
    $ist = array();
    $di = explode('|',$m);
    $i = 0; $de = false;
    while($i<count($di))
    {
      $de = explode('=',$di[$i]);
      if(isset($de[0],$de[1]))
      {
        if(!isset($ist[$de[0]])) {
          $ist[$de[0]] = 0;
        }
        $ist[$de[0]] = $de[1];
      }
      $i++;
    }
    return $ist;
  }
?>
</div>
</div>
<script>
$('.submit').click(function(){
  var data   = '';
  $(this).parent().find('input').each(function(){
    data += this.name+'='+encodeURIComponent(this.value)+'&';
  });
  $.ajax({
    type: 'POST',
    url: '/bkadminlike/mod/searchSub/update.php?id='+<?php echo $id?>,
    data: data,
    success: function(data) {
      $('.save').html(data);
      $('#content').toggle();
    }
  });  
  return false;
});
</script>