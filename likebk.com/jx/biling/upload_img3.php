<?php
defined('GAME', true);
// класс загрузки файлов 
$dbgo = mysql_connect('localhost','like','23wesdxc');
mysql_select_db('like',$dbgo);
mysql_query('SET NAMES cp1251');
/*$dbgo = mysql_connect('localhost','root','');
mysql_select_db('crazy',$dbgo);
mysql_query('SET NAMES cp1251');*/

$user = mysql_fetch_array(mysql_query('SELECT * FROM `users` WHERE `login`= "'.mysql_real_escape_string($_COOKIE['login']).'" AND `pass`= "'.mysql_real_escape_string($_COOKIE['pass']).'"'));
if(!isset($user['id'])) {
	die('Персонаж не найден!');
}

$obraz = 0;
$clan_img = 0;
//стоимость образа
$money2 = 0;

$money2 = 4.99;
$tfi2 = mysql_fetch_array(mysql_query('SELECT * FROM `free_buy` WHERE `type` = 2 AND `uid` = "'.$user['id'].'" LIMIT 1')); //подарки
if(isset($tfi2['id'])) {
	$money2 = 0;
}
  
$bank = mysql_fetch_array(mysql_query('SELECT * FROM `bank` WHERE `uid`= "'.$user['id'].'"'));
//print_r($_FILES);
if($bank['money2'] >= $money2){
  if(isset($_FILES)){
      $uploaddir = '../../clan_prw';
      //@mkdir("uploads", 0777);
      $uploadfile =$uploaddir."/".basename($_FILES['filename']['name']);
      //echo $uploadfile;
      //print_r($_FILES);
      
      if($_FILES['filename']['type'] != "image/gif") {
         echo "Загружать можно только GIF изображения";
         exit;
      }
      else{
          if($_FILES["filename"]["size"] > 400000)
          {
              echo ("Размер файла превышает 40 кб");
              exit;
          }
          else{
             // Проверяем загружен ли файл
              if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
              {
                  // Если файл загружен успешно, перемещаем его
                  // из временной директории в конечную
                  
                    if(move_uploaded_file($_FILES["filename"]["tmp_name"], $uploadfile)){
                      echo "Ваша заявка отправлена на модерацию";
					  if(isset($tfi2['id'])) {
						mysql_query('DELETE FROM `free_buy` WHERE `id` = "'.$tfi2['id'].'" LIMIT 1');
					  }
					  mysql_query('INSERT INTO `reimage`
                        ( `uid`,`login`,`src`,`type`,`clan`,`money2` ) VALUES
                        (
                          "'.$user['id'].'",
                          "'.mysql_real_escape_string($user['login']).'",
                          "'.$_FILES['filename']['name'].'",
                          "788",
                          "'.$clan_img.'",
                          "'.$money2.'"
                        )');
                      mysql_query('UPDATE `bank` SET `money2` = `money2` - '.$money2.' WHERE `uid` = "'.$user['id'].'" LIMIT 1');
                    }
									
             } else {
                echo("Ошибка загрузки смайлика!");
             }
         }
      }
  }
}else{
  echo "У Вас недостаточно средств.";
}
?>