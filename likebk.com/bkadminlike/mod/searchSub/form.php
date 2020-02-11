<?php 
$dbgo = mysql_connect('localhost','like_mainbd','8O8v3Z0c');
mysql_select_db('like_mainbd',$dbgo);
mysql_query('SET NAMES cp1251');
/* $dbgo = mysql_connect('localhost','root','');
mysql_select_db('crazy',$dbgo);
mysql_query('SET NAMES cp1251');*/
 $info = array(
  'exp' => 'Получаемый опыт (%)', 
  'align_bs' => 'Служитель закона',
  'nopryh' => 'Прямое поподание', 
  'puti'=>'Запрет перемещения',
  'align'=>'Склонность',
  'hpAll'=>'Уровень жизни (HP)',
  'mpAll'=>'Уровень маны',
  'enAll'=>'Уровень энергии',
  'sex'=>'Пол',
  'lvl'=>'Уровень',
  's1'=>'Сила',
  's2'=>'Ловкость',
  's3'=>'Интуиция',
  's4'=>'Выносливость',
  's5'=>'Интеллект',
  's6'=>'Мудрость',
  's7'=>'Духовность',
  's8'=>'Воля',
  's9'=>'Свобода духа',
  's10'=>'Божественность',
  's11'=>'Энергия',
  'm1'=>'Мф. критического удара (%)',
  'm2'=>'Мф. против критического удара (%)',
  'm3'=>'Мф. мощности крит. удара (%)',
  'm4'=>'Мф. увертывания (%)',
  'm5'=>'Мф. против увертывания (%)',
  'm6'=>'Мф. контрудара (%)',
  'm7'=>'Мф. парирования (%)',
  'm8'=>'Мф. блока щитом (%)',
  'm9'=>'Мф. удара сквозь броню (%)',
  'm14'=>'Мф. абс. критического удара (%)',
  'm15'=>'Мф. абс. увертывания (%)',
  'm16'=>'Мф. абс. парирования (%)',
  'm17'=>'Мф. абс. контрудара (%)',
  'm18'=>'Мф. абс. блока щитом (%)',
  'm19'=>'Мф. абс. магический промах (%)',
  'm20'=>'Мф. удача (%)',
  'a1'=>'Мастерство владения ножами,кинжалами',
   'a2'=>'Мастерство владения топорами,секирами',
   'a3'=>'Мастерство владения дубинами,молотами',
   'a4'=>'Мастерство владения мечами',
  'a5'=>'Мастерство владения магическими посохами',
  'a6'=>'Мастерство владения луками',
  'a7'=>'Мастерство владения арбалетами',
  'aall'=>'Мастерство владения оружием',
  'mall'=>'Мастерство владения магией стихий',
  'm2all'=>'Мастерство владения магией',
  'mg1'=>'Мастерство владения магией огня',
  'mg2'=>'Мастерство владения магией воздуха',
  'mg3'=>'Мастерство владения магией воды',
  'mg4'=>'Мастерство владения магией земли',
  'mg5'=>'Мастерство владения магией Света',
  'mg6'=>'Мастерство владения магией Тьмы',
  'mg7'=>'Мастерство владения серой магией',
  'tj'=>'Тяжелая броня',
  'lh'=>'Легкая броня',
  'minAtack'=>'Минимальный урон',
  'maxAtack'=>'Максимальный урон',
  'm10'=>'Мф. мощности урона',
  'm11'=>'Мф. мощности магии стихий',
  'm11a'=>'Мф. мощности магии',
  'pa1'=>'Мф. мощности колющего урона',
  'pa2'=>'Мф. мощности рубящего урона',
  'pa3'=>'Мф. мощности дробящий урона',
  'pa4'=>'Мф. мощности режущий урона',
  'pm1'=>'Мф. мощности магии огня',
  'pm2'=>'Мф. мощности магии воздуха',
  'pm3'=>'Мф. мощности магии воды',
  'pm4'=>'Мф. мощности магии земли',
  'pm5'=>'Мф. мощности магии Света',
  'pm6'=>'Мф. мощности магии Тьмы',
  'pm7'=>'Мф. мощности серой магии',
  'za'=>'Защита от урона',
  'zm'=>'Защита от магии стихий',
  'zma'=>'Защита от магии',
  'za1'=>'Защита от колющего урона',
  'za2'=>'Защита от рубящего урона',
  'za3'=>'Защита от дробящего урона',
  'za4'=>'Защита от режущего урона',
  'zm1'=>'Защита от магии огня',
  'zm2'=>'Защита от магии воздуха',
  'zm3'=>'Защита от магии воды',
  'zm4'=>'Защита от магии земли',
  'zm5'=>'Защита от магии Света',
  'zm6'=>'Защита от магии Тьмы',
  'zm7'=>'Защита от серой магии',
  'magic_cast'=>'Дополнительный каст за ход',
  'pza'=>'Понижение защиты от урона',
  'pzm'=>'Понижение защиты от магии',
  'pza1'=>'Понижение защиты от колющего урона',
  'min_heal_proc'=>'Эффект лечения (%)',
  'notravma'=>'Защита от травм',
  'yron_min'=>'Минимальный урон',
  'yron_max'=>'Максимальный урон',
  'zaproc'=>'Защита от урона (%)',
  'zmproc'=>'Защита от магии стихий (%)',
  'zm2proc'=>'Защита от магии Воздуха (%)',
  'pza2'=>'Понижение защиты от рубящего урона',
  'pza3'=>'Понижение защиты от дробящего урона',
  'pza4'=>'Понижение защиты от режущего урона',
  'pzm1'=>'Понижение защиты от магии огня',
  'pzm2'=>'Понижение защиты от магии воздуха',
  'pzm3'=>'Понижение защиты от магии воды',
  'pzm4'=>'Понижение защиты от магии земли',
  'pzm5'=>'Понижение защиты от магии Света',
  'pzm6'=>'Понижение защиты от магии Тьмы',
  'pzm7'=>'Понижение защиты от серой магии',
  'speedhp'=>'Регенерация здоровья (%)',
  'speedmp'=>'Регенерация маны (%)',
  'tya1'=>'Колющие атаки',
  'tya2'=>'Рубящие атаки',
  'tya3'=>'Дробящие атаки',
  'tya4'=>'Режущие атаки',
  'tym1'=>'Огненные атаки',
  'mg2static_points'=>'Уровень заряда (Воздух)',
  'tym2'=>'Электрические атаки',
  'tym3'=>'Ледяные атаки',
  'tym4'=>'Земляные атаки',
  'hpProc'=>'Уровень жизни (%)',
  'mpProc'=>'Уровень маны (%)',
  'tym5'=>'Атаки Света',
  'tym6'=>'Атаки Тьмы',
  'tym7'=>'Серые атаки',
  'min_use_mp'=>'Уменьшает расход маны',
  'pog'=>'Поглощение урона',
  'pog2'=>'Поглощение урона',
  'pog2p'=>'Процент поглощение урона',
  'pog2mp'=>'Цена поглощение урона',
  'maxves'=>'Увеличивает рюкзак',
  'bonusexp'=>'Увеличивает получаемый опыт',
  'speeden'=>'Регенерация энергии (%)',
  'yza' => 'Уязвимость физическому урона (%)',
  'yzm' => 'Уязвимость магии стихий (%)',
  'yzma' => 'Уязвимость магии (%)',
  'yza1' => 'Уязвимость колющему урона (%)',
  'yza2' => 'Уязвимость рубящему урона (%)',
  'yza3' => 'Уязвимость дробящему урона (%)',
  'yza4' => 'Уязвимость режущему урона (%)',
  'yzm1' => 'Уязвимость магии огня (%)',
  'yzm2' => 'Уязвимость магии воздуха (%)',
  'yzm3' => 'Уязвимость магии воды (%)',
  'yzm4' => 'Уязвимость магии земли (%)',
  'yzm5' => 'Уязвимость магии (%)',
  'yzm6' => 'Уязвимость магии (%)',
  'yzm7' => 'Уязвимость магии (%)',
  'rep'=> 'Репутация Рыцаря',
  'mib1' => 'Минимальная Броня головы',
  'mab1' => 'Максимальная Броня головы',
  'mib2'=>'Минимальная Броня корпуса',
  'mab2'=>'Максимальная Броня корпуса',
  'mib3'=>'Минимальная Броня пояса',
  'mab3'=>'Максимальная Броня пояса',
  'mib4'=>'Минимальная Броня ног',
  'mab4'=>'Максимальная Броня ног' ,
  'sudba'=>'Предмет будет связан общей судьбой с первым',
  'noremont'=>'Предмет не подлежит ремонту',
  'art'=>'Артефакт',
  'complect'=>'Комплект',
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
    echo "<span style='font-weight: bold; font-size: 14px;'>Цена: </span>";
    echo "<div class='rows'><input class='form-control' type='text' name='price1' value='".$sub_name['price1']."'></div>";
  $res ='';
$t = $items['tr'];
$x = 0;
$res .="<h5 style='margin-top: 10px; margin-bottom: 10px;'>Требуется минимальное:</h5>";
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
$res .= "<h5 style='margin-top: 10px; margin-bottom: 10px;'>Свойства предмета:</h5>";
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
<input type='submit' value='Изменить' name='test' class='submit btn btn-default'>
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