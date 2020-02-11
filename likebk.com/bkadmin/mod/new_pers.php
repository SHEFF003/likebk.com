<style>
 #tbtets tr td{
     padding: 10px;
     padding-top: 5px;
     padding-bottom: 5px;
 }
</style>
<?php 
    if(!defined('GAME')){
       die();
    }
    $botbd = mysql_query('SELECT * FROM `users` WHERE `pass` != "saintlucia" AND `timereg` > "1463060212"  ORDER BY  `timereg` DESC ');
    
    echo "<h3 style='text-align:left;'>Все зарегистрированные игроки с момента запуска</h3>";
    $count = 1;
    echo "<table id='tbtets' border='1'><tr><td align='center'>";
    echo "№</td>
        <td>Логин</td>
        <td align='center'>Дата регистрации</td>
        <td align='center'>Онлайн</td></tr>";
    while($bot = mysql_fetch_array($botbd)){
        $result = '';
        if($bot['align']>0)
            {
                if($bot['align'] == "0.98"){
                    $bot['align'] = "1.98";
                }
                $us['team'] = '<img width="12" height="15" src="http://img.likebk.com/i/align/align'.$bot['align'].'.gif" />';
            }
        $room = mysql_query('SELECT * FROM `room` WHERE `id` = "'.$bot['room'].'"');
        if($nameroom = mysql_fetch_array($room)){
            $r = $nameroom['name'];
        }
        $result .= '<b class="CSSteam">'.$us['team']." ".$bot['login'].' ['.$bot['level'].']</b> ';
        $result .= '<a href="http://likebk.com/inf.php?'.$bot['id'].'" target="_blank"><img src="http://img.likebk.com/i/inf_capitalcity.gif" width="12" height="11"></a>';
        echo "<tr><td>".$count."</td>";
        echo "<td>".$result."</td>";
        echo "<td>".date('d.m.Y h:i:s', $bot['timereg'])."</td>";
        if($bot['online'] > (time() - 520)){
            $onl = "<font color='green'><b>Онлайн</b></font>";
        }else{
            $onl = 'Последний раз заходил: '.date('d.m.Y H:i',$bot['online']).'<img title="Время сервера" src="http://img.likebk.com/i/clok3_2.png">';
            $out = '';
            $time_still = time()-$bot['online'];
            $tmp = floor($time_still/2592000);
            $id=0;
            if ($tmp > 0) { 
                $id++;
                if ($id<3) {$out .= $tmp." мес. ";}
                $time_still = $time_still-$tmp*2592000;
            }
            $tmp = floor($time_still/604800);
            if ($tmp > 0) { 
            $id++;
            if ($id<3) {$out .= $tmp." нед. ";}
            $time_still = $time_still-$tmp*604800;
            }
            $tmp = floor($time_still/86400);
            if ($tmp > 0) { 
                $id++;
                if ($id<3) {$out .= $tmp." дн. ";}
                $time_still = $time_still-$tmp*86400;
            }
            $tmp = floor($time_still/3600);
            if ($tmp > 0) { 
                $id++;
                if ($id<3) {$out .= $tmp." ч. ";}
                $time_still = $time_still-$tmp*3600;
            }
            $tmp = floor($time_still/60);
            if ($tmp > 0) { 
                $id++;
                if ($id<3) {$out .= $tmp." мин. ";}
            }
            if($out=='')
            {
                $out = $time_still.' сек.';
            }
            $onl .= '<br>('.$out.' назад)';
        }
        echo "<td>".$onl."</td>";
        echo "</tr>";
        $count++;
    }
    echo "</table>";
    
?>