<?php 
    if(!defined('GAME')){
       die();
    }
    $botbd = mysql_query('SELECT * FROM `users` WHERE `pass` = "saintlucia" ORDER BY `id` ASC');
    
    echo "<h3 style='text-align:left;'>Боты</h3>";
    $count = 1;
    while($bot = mysql_fetch_array($botbd)){
        $result = '';
        $align = '';
        if($bot['align']>0)
        {
            $align = '<img width="12" height="15" src="http://img.likebk.com/i/align/align'.$bot['align'].'.gif" />';
        }
        $room = mysql_query('SELECT * FROM `room` WHERE `id` = "'.$bot['room'].'"');
        if($nameroom = mysql_fetch_array($room)){
            $r = $nameroom['name'];
        }
        $result .= '<b class="CSSteam">'.$align." ".$bot['login'].' ['.$bot['level'].']</b> ';
        $result .= '<a href="http://likebk.com/inf.php?'.$bot['id'].'" target="_blank"><img src="http://img.likebk.com/i/inf_capitalcity.gif" width="12" height="11"></a>';
        echo "<p>".$count.") ".$result.' сейчас находится в '.$r."</p>";
        //$up = mysql_query('UPDATE `users` SET `room` = "4", `align` = "0" WHERE `id` = "'.$bot['id'].'" AND `pass` = "saintlucia" ');
        /*if($count <= 24){
            $up = mysql_query('UPDATE `users` SET `room` = "16", `align` = "1"  WHERE `id` = "'.$bot['id'].'" AND `pass` = "saintlucia" ');
        }
        elseif($count > 24 && $count <=48){
            $up = mysql_query('UPDATE `users` SET `room` = "375", `align` = "3"  WHERE `id` = "'.$bot['id'].'" AND `pass` = "saintlucia" ');
        }elseif($count > 48 && $count <=72){
            $up = mysql_query('UPDATE `users` SET `room` = "376", `align` = "7"  WHERE `id` = "'.$bot['id'].'" AND `pass` = "saintlucia" ');
        }
        else{
            $up = mysql_query('UPDATE `users` SET `room` = "4", `align` = "0"  WHERE `id` = "'.$bot['id'].'" AND `pass` = "saintlucia" ');
        }*/
        $count++;
    }
    
?>