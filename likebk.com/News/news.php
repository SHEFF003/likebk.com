<?php 
header('Content-Type: text/html; charset=windows-1251');    
define('GAME',true);
include "dbinit.php";

$user = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login` = "'.mysql_real_escape_string($_COOKIE['login']).'" AND `pass` = "'.mysql_real_escape_string($_COOKIE['pass']).'" LIMIT 1'));
    
if(isset($user['id'])) {
	include('../_incl_data/class/__user.php');
	if( $user['align'] > 1 && $user['align'] < 2 ) {
		//$user['admin'] = 1;
	}
}
	
if(isset($user['id']) && $user['admin'] > 0 ) {
	if(isset($_GET['nws_moder'])) {
		if(isset($_GET['del'])) {
			mysql_query('UPDATE `micro_news` SET `delete` = "'.$user['id'].'" WHERE `id` = "'.mysql_real_escape_string($_GET['del']).'" LIMIT 1');
			header('location: /news?nws_moder');
			die();
		}elseif(isset($_GET['yes'])) {
			mysql_query('UPDATE `micro_news` SET `mod` = "'.$user['id'].'" WHERE `id` = "'.mysql_real_escape_string($_GET['yes']).'" LIMIT 1');
			header('location: /news?nws_moder');
			die();
		}
		echo '<a href="/news">Вернуться к новостям</a><hr>';
		$sp = mysql_query('SELECT * FROM `micro_news` WHERE `delete` = 0 AND `mod` = 0 ORDER BY `id` DESC');
		while( $pl = mysql_fetch_array($sp) ) {
			echo $u->microLogin($pl['uid'],1).' ['.date('d.m.Y H:i',$pl['time']).']<br><b><u>'.$pl['title'].'</u></b><br>'.$pl['text'].'<br><a href="/news?nws_moder&del='.$pl['id'].'">Удалить</a> &nbsp; &nbsp; <a href="/news?nws_moder&yes='.$pl['id'].'">Опубликовать</a><hr>';
		}
		die();
	}elseif(isset($_GET['delmini'])) {
		mysql_query('UPDATE `micro_news` SET `delete` = "'.$user['id'].'" WHERE `id` = "'.mysql_real_escape_string($_GET['delmini']).'" LIMIT 1');
		header('location: /news');
		die();
	}
}

if(isset($user['id'])) {
	if(isset($_POST['nws10_text'])) {
		$nws10 = mysql_fetch_array(mysql_query('SELECT * FROM `micro_news` WHERE `mod` = 0 AND `delete` = 0 AND `uid` = "'.$user['id'].'" LIMIT 1'));
		if(!isset($nws10['id'])) {
			$_POST['nws10_title'] = htmlspecialchars($_POST['nws10_title'],NULL,'cp1251');
			$_POST['nws10_text'] = htmlspecialchars($_POST['nws10_text'],NULL,'cp1251');
			mysql_query('INSERT INTO `micro_news` (`uid`,`time`,`title`,`text`) VALUES ("'.$user['id'].'","'.time().'","'.mysql_real_escape_string($_POST['nws10_title']).'","'.mysql_real_escape_string($_POST['nws10_text']).'")');
			header('location: /news');
			die();
		}
	}
}
	
$result = mysql_query('SELECT * FROM `newsNew`');

if (mysql_num_rows($result) == 0)
{
   print "<center><img src=\"news.gif\"><br>Новостей нет<br></center>";
}
else
{
    $tableName="newsNew";        
    $targetpage = "?page=";   
    $limit = 10; 
    
    $query = "SELECT COUNT(*) as num FROM ".$tableName."";
    $total_pages = mysql_fetch_array(mysql_query($query));
    $total_pages = $total_pages[num];
    
    $stages = 3;
    $page = mysql_escape_string($_GET['page']);
    if($page){
        $start = ($page - 1) * $limit; 
    }else{
        $start = 0; 
        }   
    
    // Get page data
    $query1 = "SELECT * FROM ".$tableName." ORDER BY `id` DESC LIMIT ".$start.", ".$limit."";
    $result = mysql_query($query1);
    
    // Initial page num setup
    if ($page == 0){$page = 1;}
    $prev = $page - 1;  
    $next = $page + 1;                          
    $lastpage = ceil($total_pages/$limit);      
    $LastPagem1 = $lastpage - 1;                    
    
    
    $paginate = '';
    if($lastpage > 1)
    {   
    

    
    
        $paginate .= "<div class='paginate'>";
        // Previous
        if ($page > 1){
            $paginate.= "<a href='".$targetpage.$prev."'>«</a>";
        }else{
            $paginate.= "<span class='disabled'>«</span>";   }
            

        
        // Pages    
        if ($lastpage < 7 + ($stages * 2))  // Not enough pages to breaking it up
        {   
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page){
                    $paginate.= "<span class='current'>".$counter."</span>";
                }else{
                    $paginate.= "<a href='".$targetpage.$counter."'>".$counter."</a>";}                    
            }
        }
        elseif($lastpage > 5 + ($stages * 2))   // Enough pages to hide a few?
        {
            // Beginning only hide later pages
            if($page < 1 + ($stages * 2))       
            {
                for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
                {
                    if ($counter == $page){
                        $paginate.= "<span class='current'>".$counter."</span>";
                    }else{
                        $paginate.= "<a href='".$targetpage.$counter."'>".$counter."</a>";}                    
                }
                $paginate.= "...";
                $paginate.= "<a href='".$targetpage.$LastPagem1."'>".$LastPagem1."</a>";
                $paginate.= "<a href='".$targetpage.$lastpage."'>".$lastpage."</a>";       
            }
            // Middle hide some front and some back
            elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
            {
                $paginate.= "<a href='".$targetpage1."'>1</a>";
                $paginate.= "<a href='".$targetpage2."'>2</a>";
                $paginate.= "...";
                for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
                {
                    if ($counter == $page){
                        $paginate.= "<span class='current'>".$counter."</span>";
                    }else{
                        $paginate.= "<a href='".$targetpage.$counter."'>".$counter."</a>";}                    
                }
                $paginate.= "...";
                $paginate.= "<a href='".$targetpage.$LastPagem1."'>".$LastPagem1."</a>";
                $paginate.= "<a href='".$targetpage.$lastpage."'>".$lastpage."</a>";       
            }
            // End only hide early pages
            else
            {
                $paginate.= "<a href='".$targetpage1."'>1</a>";
                $paginate.= "<a href='".$targetpage2."'>2</a>";
                $paginate.= "...";
                for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page){
                        $paginate.= "<span class='current'>".$counter."</span>";
                    }else{
                        $paginate.= "<a href='".$targetpage.$counter."'>".$counter."</a>";}                    
                }
            }
        }
                    
                // Next
        if ($page < $counter - 1){ 
            $paginate.= "<a href='".$targetpage.$next."'>»</a>";
        }else{
            $paginate.= "<span class='disabled'>»</span>";
            }
            
        $paginate.= "</div>";       
    
    
}?>
        <link rel="stylesheet" href="../styles/styles.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../styles/news.css">
        <SCRIPT type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></SCRIPT>
        <script src="../styles/js/popup_img.js"></script>
        <title>LikeBk Бойцовский Клуб - Новости</title>

    <script type="text/javascript">
        $(document).ready(function() { // Ждём загрузки страницы
            $("#new_head img.image").click(function(){   // Событие клика на маленькое изображение
                var img = $(this);  // Получаем изображение, на которое кликнули
                var src = img.attr('src'); // Достаем из этого изображения путь до картинки
                $("body").append("<div class='popup'>"+ //Добавляем в тело документа разметку всплывающего окна
                                 "<div class='popup_bg'></div>"+ // Блок, который будет служить фоном затемненным
                                 "<img src='"+src+"' class='popup_img' />"+ // Само увеличенное фото
                                 "</div>"); 
                $(".popup").fadeIn(800); // Медленно выводим изображение
                $(".popup_bg, .popup_img").click(function(){    // Событие клика на затемненный фон    
                    $(".popup").fadeOut(800);   // Медленно убираем всплывающее окно
                    setTimeout(function() { // Выставляем таймер
                      $(".popup").remove(); // Удаляем разметку всплывающего окна
                    }, 800);
                });
            });
        });
    </script>

<div class="cont">
    <center>
        <div class="rgfrm">
        <table id="tbl" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="62"><table width="100%" height="62" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="129" class="psi_tlimg">&nbsp;</td>
                <td align="center" class="psi_tline">
                    <div class="psi_fix">
        <!--              <div class="psi_logo">&nbsp;</div> -->
                    </div>
                </td>
                <td width="129" class="psi_trimg">&nbsp;</td>
              </tr>
              </table></td>
            </tr>
          <tr>
            <td>
            <table class="psi_mainin" width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="23" class="psi_mleft">&nbsp;</td>
                <td valign="top"  class="psi_main_reg">
                            <h3 style="font-size: 24px;">Новости</h3>
                <!-- main -->
                    <table style="float: left;" width="70%" cellspacing="0" cellpadding="0">
                        <tbody>
                        	<? while ($row = mysql_fetch_assoc($result)) 
                        	{?>
                                <tr>
                                    <td>
                                        <div id="new_head">
                                            <div id="title_new"></div>
                                            <div id="content_new">
                                                <h3><?=$row['name'];?></h3>
                                                <span><?=$row['date'];?></span>
                                                <div style="clear: both;"></div>
                                                <hr size="1" style="color:#000; background-color:#000;border-bottom: 1px solid #000;">
                                                <?=$row['text'];?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                        	<?}?>
                                <tr>
                                    <td>                    
                                        <center>
                                            <?php echo $paginate;?>
                                        </center>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                    <table style="float: right;" width="28%" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <div id="new_head" style="margin: 0; margin-right: 10px; width: 95%;">
                                    <?
									if( $user['admin'] > 0 ) {
										$x1 = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `micro_news` WHERE `delete` = 0 AND `mod` = 0 LIMIT 1'));
										$x1 = $x1[0];
										echo '<br><center><a href="/news?nws_moder">Модерация новостей: '.$x1.'</a></center><br>';	
									}
									?>
                                    <div id="title_new"></div>
                                    <div id="content_new">
                                        <h3 style="padding-bottom:8px;">Глас народа</h3>
                                        <?
										if(!isset($_GET['pgn'])) {
											$_GET['pgn'] = 1;
										}
										$pgx = 10; //новостей на странице
										$pgm = mysql_fetch_array(mysql_query('SELECT COUNT(*) FROM `micro_news` WHERE `mod` > 0 AND `delete` = 0 LIMIT 1'));
										$pgm = ceil( $pgm[0] / $pgx );
										$pgn = (round($_GET['pgn']) - 1) * $pgx; //текущая страница
										if( $pgn < 0 ) {
											$pgn = 0;
										}
										$sp = mysql_query('SELECT * FROM `micro_news` WHERE `mod` > 0 AND `delete` = 0 ORDER BY `id` DESC LIMIT '.$pgn.','.$pgx.'');
										while( $pl = mysql_fetch_array($sp) ) {
											$del = '';
											if( $user['admin'] > 0 ) {
												$del = '<a href="/news?delmini='.$pl['id'].'">Удалить</a>&nbsp;&nbsp;';
											}
											echo '<div style="padding-top:5px;padding-bottom:10px;border-top:1px solid #000">'.$del.'<b>'.$pl['title'].'</b><br><div style="text-align:justify">'.$pl['text'].'<br><small style="color: #c60304;">'.date('d.m.Y H:i',$pl['time']).'</small></div></div>';
										}
										echo '<center>Страницы: ';
										$i = 1;
										while( $i <= $pgm ) {
											if( $i == $_GET['pgn'] ) {
												echo '<u>['.$i.']</u> ';
											}else{
												echo '<a href="/news?pgn='.$i.'">['.$i.']</a> ';
											}
											$i++;
										}
										echo '</center>';
										?>
                                    </div>
                                </div>
                                <?
								if(isset($user['id'])) {
									$nws10 = mysql_fetch_array(mysql_query('SELECT * FROM `micro_news` WHERE `mod` = 0 AND `delete` = 0 AND `uid` = "'.$user['id'].'" LIMIT 1'));
								?>
 								<div id="new_head" style="margin: 0; margin-right: 10px; width: 95%;">
                                    <div id="title_new"></div>
                                    <div id="content_new">
                                        <?
										if(isset($nws10['id'])) {
											echo '<h3 style="padding-bottom:8px;">Новость ожидающая модерации:</h3>';
											echo '<div style="padding-top:10px;padding-bottom:10px;"><b>'.$nws10['title'].'</b><br><div style="text-align:justify">'.$nws10['text'].'</div></div>';
											echo '<u>Дата добавления: '.date('d.m.Y H:i',$nws10['time']).'</u>';
										}else{
										?>
                                        <form method="post" action="/news">
                                        <h3 style="padding-bottom:8px;">Предложить свою новость:</h3>
                                        <center>(Ограничение 200 символов)<br><br>
                                        Заголовок: <input name="nws10_title" type="text" style="width:244px;" maxlength="50"><br><br>
                                        Текст новости: <textarea name="nws10_text" style="width:244px; height:130px;" maxlength="200"></textarea></center><br>
                                        <center><input class="btnnew" type="submit" value="Предложить новость"></center> 
                                        </form>   
                                        <? } ?>                                    
                                    </div>
                                </div>
                                <?
								}
								?>
                                </td>
                        </tr>
                    </table>
                <!-- main -->   
                </td>
                <td width="23" class="psi_mright">&nbsp;</td>
              </tr>
              </table>
            </td>
            </tr>
          <tr>
            <td height="62"><table width="100%" height="62" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="129" class="psi_dlimg">&nbsp;</td>
                <td class="psi_dline">&nbsp;</td>
                <td width="129" class="psi_drimg">&nbsp;</td>
              </tr>
            </table></td>
            </tr>
        </table>
        </div>
    <!-- test window -->
    </center>
</div>
<?}?>